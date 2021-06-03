<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\JabatanResource;
use App\Http\Resources\JabatanCollection;




// Models
use App\Models\Jabatan;

class JabatanController extends Controller
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
     *     path="/api/admin/jabatan",
     *     operationId="getAllJabatan",
     *     tags={"Jabatan"},
     *     summary="Return List of Jabatan",
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
        $jabatan = Jabatan::orderBy('id', 'ASC')->whereNotIn('id',[1])->get();

        if($jabatan){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Jabatan Berhasil didapatkan"
                ],
                "data" => $jabatan,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Jabatan Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }    
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/jabatan",
     *     operationId="getAllJabatanByFilter",
     *     tags={"Jabatan"},
     *     summary="Return List of Jabatan by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterJabatanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JabatanListResource"),
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
        
        $jabatan = Jabatan::orderBy($sortBy, $sortDirection)->whereNotIn('id', [1]);
       
        if($request->has('jabatan_name') && $request->jabatan_name !== ''){
            $jabatan->where('jabatan_name', 'like', '%'.$request->jabatan_name.'%');
        }

        if($request->has('id') && $request->id !== null){
            $jabatan->where('id', '=', $request->id);
        }
        
        $collection = new JabatanCollection($jabatan->paginate($paginate));
        
        return $collection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/admin/jabatan",
     *     operationId="createNewJabatan",
     *     tags={"Jabatan"},
     *     summary="Create New Jabatan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreJabatanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JabatanDetailResource"),
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
            'jabatan_name' => 'required|string|unique:App\Models\Jabatan,jabatan_name'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $jabatan = Jabatan::create([            
            'jabatan_name' => $request->jabatan_name
        ]);
        if($jabatan){
            return ResponseFormatter::success($jabatan, 'Jabatan berhasil ditambahkan', 200);
        }else{
            return ResponseFormatter::error(null, 'Jabatan gagal ditambahkan');
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
     *     path="/api/admin/jabatan/{id}",
     *     operationId="getAllJabatanById",
     *     tags={"Jabatan"},
     *     summary="Get Jabatan Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jabatan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/JabatanDetailResource")
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
        $jabatan = Jabatan::find($id);
        if($jabatan == null){
            return ResponseFormatter::error(null, 'Jabatan tidak ditemukan', 404);
        }
        return ResponseFormatter::success(new JabatanResource($jabatan), 'Jabatan berhasil didapatkan', 200);
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
     *     path="/api/admin/jabatan/{id}",
     *     operationId="updateExistedJabatan",
     *     tags={"Jabatan"},
     *     summary="Update Existed Jabatan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jabatan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreJabatanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/JabatanDetailResource"),
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
    public function update(Request $request, Jabatan $jabatan)
    {
        $validator = Validator::make($request->all(), [
            'jabatan_name' => ['required', 'string', Rule::unique('App\Models\Jabatan')->ignore($jabatan->jabatan_name, 'jabatan_name')],
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $jabatan->update($request->only('jabatan_name'));

        if($jabatan){
            return ResponseFormatter::success($jabatan, 'Jabatan berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Jabatan gagal diubah');
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
     *     path="/api/admin/jabatan/{id}",
     *     operationId="deleteExistingJabatan",
     *     tags={"Jabatan"},
     *     summary="Delete Existed Jabatan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Jabatan ID",
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

        $jabatan = Jabatan::find($id);
        if($jabatan == null){
            return ResponseFormatter::error(null, 'Jabatan tidak ditemukan', 404);
        }
        
        $jabatan->delete();

        if($jabatan){
            return ResponseFormatter::success(null, 'Jabatan berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Jabatan gagal dihapus');
        }
    }
}
