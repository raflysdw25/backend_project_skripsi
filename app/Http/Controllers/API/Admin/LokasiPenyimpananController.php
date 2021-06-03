<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\LokasiPenyimpananResource;
use App\Http\Resources\LokasiPenyimpananCollection;




// Models
use App\Models\LokasiPenyimpanan;

class LokasiPenyimpananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/admin/lokasi",
     *     operationId="getAllLokasi",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Return List of Lokasi",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",          
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function index()
    {
        $lokasi = LokasiPenyimpanan::orderBy('id', 'ASC')->get();

        return response()->json([
            "response" => [
                "code" => 200,
                "status" => "success",
                "message" => "List Lokasi Penyimpanan berhasil didapatkan"
            ], 
            "data" => $lokasi,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/lokasi",
     *     operationId="getAllLokasiPenyimpananByFilter",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Return List of Lokasi Penyimpanan by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterLokasiPenyimpananRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LokasiPenyimpananListResource"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function filter(Request $request){
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');

        $lokasi = LokasiPenyimpanan::orderBy($sortBy, $sortDirection);

        if($request->has('lokasi_name') && $request->lokasi_name !== ''){
            $lokasi->where('lokasi_name', 'like', '%'.$request->lokasi_name.'%');    
        }
        
        if($request->has('total_capacity') && $request->total_capacity !== null){
            $lokasi->where('total_capacity', '=', $request->total_capacity);    
        }
        
        if($request->has('available_capacity') && $request->available_capacity !== null){
            $lokasi->where('available_capacity', '=', $request->available_capacity);    
        }

        $collection = new LokasiPenyimpananCollection($lokasi->paginate($paginate));

        return $collection;
        
    }

    /**
     * @OA\Get(
     *     path="/api/admin/lokasi/available/{totalNeed}",
     *     operationId="getAllAvailabelLokasi",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Get List Available Lokasi",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="totalNeed",
     *        description="Jumlah Kapasitas yang dibutuhkan",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/LokasiPenyimpananDetailResource")
     *     ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function getAvailableLokasi($totalNeed)
    {
        $availableLokasi = LokasiPenyimpanan::where('available_capacity', '>' , $totalNeed)->get();

        return response()->json([
            "response" => [
                "code" => 200,
                "status" => "success",
                "message" => "List Lokasi Penyimpanan Tersedia berhasil didapatkan"
            ], 
            "data" => $availableLokasi,
        ], 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/admin/lokasi",
     *     operationId="createNewLokasiPenyimpanan",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Create New Lokasi Penyimpanan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLokasiPenyimpananRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LokasiPenyimpananDetailResource"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'lokasi_name' => 'required|string|unique:App\Models\LokasiPenyimpanan,lokasi_name',
            'total_capacity' => 'required|integer',
            'available_capacity' => 'nullable|integer',
            'stored_capacity' => 'nullable|integer'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, 
            $validator->errors(), 400);
        }

        $available_capacity = 0;
        // Set Default dari column Available Capacity
        if($request->available_capacity === null){
            $available_capacity = $request->total_capacity;
        }else{
            $available_capacity = $request->available_capacity;
        }

        // Set Default dari column store Capacity
        if($request->stored_capacity === null){
            $stored_capacity = 0;
        }else{
            $stored_capacity = $request->stored_capacity;
        }

        $lokasi = LokasiPenyimpanan::create([
            'lokasi_name' => $request->lokasi_name,
            'total_capacity' => $request->total_capacity,
            'available_capacity' => $available_capacity,
            'stored_capacity' => $stored_capacity 
        ]);

        if($lokasi){
            return ResponseFormatter::success($lokasi, 'Lokasi berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::success(null, 'Lokasi gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/admin/lokasi/{id}",
     *     operationId="getAllLokasiById",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Get Lokasi Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Lokasi ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/LokasiPenyimpananDetailResource")
     *     ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function show($id)
    {
        $lokasi = LokasiPenyimpanan::find($id);
        
        if($lokasi == null){
            return ResponseFormatter::error(null, 'Data Lokasi tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new LokasiPenyimpananResource($lokasi), 'Lokasi berhasil didapatkan', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *     path="/api/admin/lokasi/{id}",
     *     operationId="updateExistedLokasiPenyimpanan",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Update Existed Lokasi Penyimpanan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Lokasi Penyimpanan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLokasiPenyimpananRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LokasiPenyimpananDetailResource"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $lokasi = LokasiPenyimpanan::find($id);
        
        if($lokasi == null){
            return ResponseFormatter::error(null, 'Data Lokasi tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            'lokasi_name' => ['required', 'string', Rule::unique('App\Models\LokasiPenyimpanan')->ignore($lokasi->lokasi_name, 'lokasi_name')],
            'total_capacity' => 'required|integer',
            'available_capacity' => 'required|integer',
            'stored_capacity' => 'required|integer'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $lokasi->update($request->all());

        if($lokasi){
            return ResponseFormatter::success($lokasi, 'Lokasi berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Lokasi gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *     path="/api/admin/lokasi/{id}",
     *     operationId="deleteExistingLokasi Penyimpanan",
     *     tags={"Lokasi Penyimpanan"},
     *     summary="Delete Existed Lokasi Penyimpanan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Lokasi Penyimpanan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *     ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function destroy($id)
    {
        $lokasi = LokasiPenyimpanan::find($id);
        
        if($lokasi == null){
            return ResponseFormatter::error(null, 'Data Lokasi tidak ditemukan', 404);
        }

        $lokasi->delete();

        if($lokasi){
            return ResponseFormatter::success(null, "Lokasi berhasil dihapus");
        }else{
            return ResponseFormatter::error(null, "Lokasi gagal dihapus");
        }
    }
}
