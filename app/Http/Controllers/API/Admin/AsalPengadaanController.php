<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\AsalPengadaanResource;
use App\Http\Resources\AsalPengadaanCollection;




// Models
use App\Models\AsalPengadaan;

class AsalPengadaanController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/admin/asal",
     *     operationId="getAllAsalPengadaan",
     *     tags={"Asal Pengadaan"},
     *     summary="Return List of Asal Pengadaan",
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
        $asal_pengadaan = AsalPengadaan::orderBy('id', 'ASC')->get();

        return response()->json([
            "response" => [
                "code" => 200,
                "status" => "success",
                "mesasge" => "List AsalPengadaan Berhasil didapatkan"
            ],
            "data" => $asal_pengadaan,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/asal",
     *     operationId="getAllAsalPengadaanByFilter",
     *     tags={"Asal Pengadaan"},
     *     summary="Return List of Asal Pengadaan by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterAsalPengadaanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AsalPengadaanListResource"),
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

    public function filter(Request $request)
    {
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');
        
        $asal_pengadaan = AsalPengadaan::orderBy($sortBy, $sortDirection);
        
        
        if($request->has('asal_pengadaan_name') && $request->asal_pengadaan_name !== ''){
            $asal_pengadaan->where('asal_pengadaan_name', 'like' , '%'.$request->asal_pengadaan_name.'%');
        }

        if($request->has('id') && $request->id !== null){
            $asal_pengadaan->where('id', '=', $request->id);
        }

        $collection = new AsalPengadaanCollection($asal_pengadaan->paginate($paginate));
        
        return $collection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/admin/asal",
     *     operationId="createNewAsalPengadaan",
     *     tags={"Asal Pengadaan"},
     *     summary="Create New Asal Pengadaan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreAsalPengadaanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AsalPengadaanDetailResource"),
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
        $validator = Validator::make($request->all(), [
            'asal_pengadaan_name' => 'required|string|unique:App\Models\AsalPengadaan,asal_pengadaan_name'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $asal_pengadaan = AsalPengadaan::create([            
            'asal_pengadaan_name' => $request->asal_pengadaan_name
        ]);
        if($asal_pengadaan){
            return ResponseFormatter::success($asal_pengadaan, 'Asal Pengadaan berhasil ditambahkan', 200);
        }else{
            return ResponseFormatter::error(null, 'Asal Pengadaan gagal ditambahkan');
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
     *     path="/api/admin/asal/{id}",
     *     operationId="getAllAsalPengadaanById",
     *     tags={"Asal Pengadaan"},
     *     summary="Get Asal Pengadaan Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Asal Pengadaan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/AsalPengadaanDetailResource")
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
        $asal_pengadaan = AsalPengadaan::findOrFail($id);
        return ResponseFormatter::success(new AsalPengadaanResource($asal_pengadaan), 'Asal pengadaan berhasil didapatkan', 200);
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
     *     path="/api/admin/asal/{id}",
     *     operationId="updateExistedAsalPengadaan",
     *     tags={"Asal Pengadaan"},
     *     summary="Update Existed Asal Pengadaan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Asal Pengadaan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreAsalPengadaanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AsalPengadaanDetailResource"),
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
        $asal_pengadaan = AsalPengadaan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'asal_pengadaan_name' => ['required', 'string', Rule::unique('App\Models\AsalPengadaan')->ignore($asal_pengadaan->asal_pengadaan_name, 'asal_pengadaan_name') ]
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $asal_pengadaan->update($request->only('asal_pengadaan_name'));

        if($asal_pengadaan){
            return ResponseFormatter::success($asal_pengadaan, 'Asal Pengadaan berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Asal Pengadaan gagal diubah');
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
     *     path="/api/admin/asal/{id}",
     *     operationId="deleteExistingAsalPengadaan",
     *     tags={"Asal Pengadaan"},
     *     summary="Delete Existed Asal Pengadaan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Asal Pengadaan ID",
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
        $asal_pengadaan = AsalPengadaan::findOrFail($id);
        $asal_pengadaan->delete();

        if($asal_pengadaan){
            return ResponseFormatter::success(null, 'Asal Pengadaan berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Asal Pengadaan gagal dihapus');
        }
    }
}
