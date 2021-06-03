<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\JenisAlatResource;
use App\Http\Resources\JenisAlatCollection;




// Models
use App\Models\JenisAlat;

class JenisAlatController extends Controller
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
     *     path="/api/admin/jenis",
     *     operationId="getAllJenis Alat",
     *     tags={"Jenis Alat"},
     *     summary="Return List of Jenis Alat",
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
        $jenis_alat = JenisAlat::orderBy('id', 'ASC')->get();

        if($jenis_alat){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Jenis Alat Berhasil didapatkan"
                ],
                "data" => $jenis_alat,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 404,
                    "status" => "success",
                    "mesasge" => "List Jenis Alat Gagal didapatkan"
                ],
                "data" => null,
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/jenis",
     *     operationId="getAllJenisAlatByFilter",
     *     tags={"Jenis Alat"},
     *     summary="Return List of Jenis Alat by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="page",
     *        description="Page List",
     *        required=false,
     *        in="query",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterJenisAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JenisAlatListResource"),
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

        $jenis_alat = JenisAlat::orderBy($sortBy, $sortDirection);

        if($request->has('jenis_name') && $request->jenis_name !== ''){
            $jenis_alat->where('jenis_name', 'like', '%'.$request->jenis_name.'%');
        }
        
        if($request->has('spec_attributes') && ($request->spec_attributes !== null || $request->spec_attributes !== '')){
            $jenis_alat->where('spec_attributes', 'like', '%'.$request->spec_attributes.'%');
        }

        $collection = new JenisAlatCollection($jenis_alat->paginate($paginate));

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
     *     path="/api/admin/jenis",
     *     operationId="createNewJenisAlat",
     *     tags={"Jenis Alat"},
     *     summary="Create New Jenis Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreJenisAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JenisAlatDetailResource"),
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
            'jenis_name' => 'required|string|unique:App\Models\JenisAlat,jenis_name',
            'spec_attributes' => 'nullable|string'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $jenis_alat = JenisAlat::create([
            'jenis_name' => $request->jenis_name,
            'spec_attributes' => $request->spec_attributes
        ]);

        if($jenis_alat){
            return ResponseFormatter::success($jenis_alat, 'Jenis Alat berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error($jenis_alat, 'Jenis Alat gagal ditambahkan', 500);
            
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
     *     path="/api/admin/jenis/{id}",
     *     operationId="getAllJenisAlatById",
     *     tags={"Jenis Alat"},
     *     summary="Get Jenis Alat Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jenis Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/JenisAlatDetailResource")
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
        $jenis_alat = JenisAlat::find($id);

        if($jenis_alat == null){
            return ResponseFormatter::error(null, 'Jenis Alat tidak didapatkan', 404);
        }

        return ResponseFormatter::success($jenis_alat, 'Jenis Alat didapatkan', 200);
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
     *     path="/api/admin/jenis/{id}",
     *     operationId="updateExistedJenisAlat",
     *     tags={"Jenis Alat"},
     *     summary="Update Existed Jenis Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jenis Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreJenisAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JenisAlatDetailResource"),
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
        $jenis_alat = JenisAlat::find($id);
        if($jenis_alat == null){
            return ResponseFormatter::error(null, 'Jenis Alat tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(), [
            'jenis_name' => ['required', 'string', Rule::unique('App\Models\JenisAlat')->ignore($jenis_alat->jenis_name, 'jenis_name')],
            'spec_attributes' => 'nullable|string'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 404);
        }

        $jenis_alat->update($request->all());

        if($jenis_alat){
            return ResponseFormatter::success($jenis_alat,'Jenis Alat berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Jenis Alat gagal diubah', 500);
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
     *     path="/api/admin/jenis/{id}",
     *     operationId="deleteExistingJenisAlat",
     *     tags={"Jenis Alat"},
     *     summary="Delete Existed Jenis Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jenis Alat ID",
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
        $jenis_alat = JenisAlat::find($id);
        if($jenis_alat == null){
            return ResponseFormatter::error(null, 'Jenis Alat tidak didapatkan', 404);
        }

        $jenis_alat->delete();

        if($jenis_alat){
            return ResponseFormatter::success(null, 'Jenis Alat berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Jenis Alat gagal dihapus', 500);   
        }
    }
}
