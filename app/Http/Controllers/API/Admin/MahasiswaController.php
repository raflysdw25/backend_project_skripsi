<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


// Resource and Collection
use App\Http\Resources\MahasiswaResource;
use App\Http\Resources\MahasiswaCollection;


// Model
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
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
     *     path="/api/admin/mahasiswa",
     *     operationId="getAllMahasiswa",
     *     tags={"Mahasiswa"},
     *     summary="Return List of Mahasiswa",
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
        $mahasiswa = Mahasiswa::with(['mahasiswa_prodi'])->orderBy('created_at', 'ASC')->get();

        if($mahasiswa){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Mahasiswa Berhasil didapatkan"
                ],
                "data" => $mahasiswa,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "success",
                    "mesasge" => "List Mahasiswa Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/mahasiswa",
     *     operationId="getAllMahasiswaByFilter",
     *     tags={"Mahasiswa"},
     *     summary="Return List of Mahasiswa by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="page",
     *        description="Page",
     *        required=false,
     *        in="query",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterMahasiswaRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/MahasiswaListResource"),
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
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'ASC');

        $mahasiswa = Mahasiswa::with(['mahasiswa_prodi'])->orderBy($sortBy,$sortDirection);

        
        // Filter berdasarkan nip
        if($request->has('nim') && $request->nim !== ''){
            $mahasiswa->where('nim', 'like', '%'.$request->nim.'%');
        }
        
        // Filter berdasarkan nama mahasiswa
        if($request->has('mahasiswa_fullname') && $request->mahasiswa_fullname !== ''){
            $mahasiswa->where('mahasiswa_fullname', 'like', '%'.$request->mahasiswa_fullname.'%');
        }
        
        // Filter berdasarkan prodi id
        if($request->has('prodi_id') && $request->prodi_id !== null){
            $mahasiswa->where('prodi_id', '=', $request->prodi_id);
        }
        
        // Filter berdasarkan email
        if($request->has('email') && $request->email !== ''){
            $mahasiswa->where('email', 'like', '%'.$request->email.'%');
        }

        

        $collection = new MahasiswaCollection($mahasiswa->paginate($paginate));
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
     *     path="/api/admin/mahasiswa",
     *     operationId="createNewMahasiswa",
     *     tags={"Mahasiswa"},
     *     summary="Create New Mahasiswa",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMahasiswaRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/MahasiswaDetailResource"),
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
            'nim' => 'required|string|unique:App\Models\Mahasiswa,nim',
            'mahasiswa_fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'register_year' => 'required|string',
            'address'=> 'nullable|string',
            'prodi_id' => 'nullable|integer|exists:App\Models\Prodi,id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 404);
        }

        $mahasiswa = Mahasiswa::create($request->all());
        if($mahasiswa){
            return ResponseFormatter::success($mahasiswa, 'Mahasiswa berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Mahasiswa gagal ditambahkan', 500);
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
     *     path="/api/admin/mahasiswa/{nim}",
     *     operationId="getAllMahasiswaByNim",
     *     tags={"Mahasiswa"},
     *     summary="Get Mahasiswa Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nim",
     *        description="Mahasiswa NIM",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/MahasiswaDetailResource")
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
    public function show($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        if($mahasiswa == null){
            return ResponseFormatter::error(null, 'Mahasiswa tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new MahasiswaResource($mahasiswa), 'Mahasiswa ditemukan', 200);
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
     *     path="/api/admin/mahasiswa/{nim}",
     *     operationId="updateExistedMahasiswa",
     *     tags={"Mahasiswa"},
     *     summary="Update Existed Mahasiswa",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nim",
     *        description="Mahasiswa NIM",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMahasiswaRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/MahasiswaDetailResource"),
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
    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        if($mahasiswa == null){
            return ResponseFormatter::error(null, 'Mahasiswa tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(), [
            'nim' => ['required', 'string', Rule::unique('App\Models\Mahasiswa')->ignore($mahasiswa->nim, 'nim')],
            'mahasiswa_fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'register_year' => 'required|integer',
            'address'=> 'nullable|string',
            'prodi_id' => 'nullable|integer|exists:App\Models\Prodi, id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $mahasiswa->update($request->all());

        if($mahasiswa){
            return ResponseFormatter::success(new MahasiswaResource($mahasiswa), 'Mahasiswa berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Mahasiswa gagal diubah');
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
     *     path="/api/admin/mahasiswa/{nim}",
     *     operationId="deleteExistingMahasiswa",
     *     tags={"Mahasiswa"},
     *     summary="Delete Existed Mahasiswa",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nim",
     *        description="Mahasiswa NIM",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
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
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        if($mahasiswa == null){
            return ResponseFormatter::error(null, 'Mahasiswa tidak ditemukan', 404);
        }

        $mahasiswa->delete();
        if($mahasiswa){
            return ResponseFormatter::success(null, 'Mahasiswa berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Mahasiswa gagal dihapus', 500);
        }
    }
}
