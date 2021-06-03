<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\ProdiResource;
use App\Http\Resources\ProdiCollection;




// Models
use App\Models\Prodi;

class ProdiController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }
    
    /**
     * @OA\Get(
     *     path="/api/admin/prodi",
     *     operationId="getAllProdi",
     *     tags={"Prodi"},
     *     summary="Return List of Prodi",
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
        $prodi = Prodi::orderBy('id', 'ASC')->get();

        return response()->json([
            "response" => [
                "code" => 200,
                "status" => "success",
                "mesasge" => "List Prodi Berhasil didapatkan"
            ],
            "data" => $prodi,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/prodi",
     *     operationId="getAllProdiByFilter",
     *     tags={"Prodi"},
     *     summary="Return List of Prodi by Filter",
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
     *          @OA\JsonContent(ref="#/components/schemas/FilterProdiRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/ProdiListResource"),
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
        
        $prodi = Prodi::orderBy($sortBy, $sortDirection);
        
        // $condition = [];
        if($request->has('prodi_name') && $request->prodi_name !== ''){
           
            $prodi->where('prodi_name', 'like', '%'.$request->prodi_name.'%');
        }

        if($request->has('id') && $request->id !== null){
            $prodi->where('id', '=', $request->id);
        }

        $collection = new ProdiCollection($prodi->paginate($paginate));
        
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
     *     path="/api/admin/prodi",
     *     operationId="createNewProdi",
     *     tags={"Prodi"},
     *     summary="Create New Prodi",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProdiRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/ProdiDetailResource"),
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
            'prodi_name' => 'required|string|unique:App\Models\Prodi,prodi_name'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $prodi = Prodi::create([            
            'prodi_name' => $request->prodi_name
        ]);
        if($prodi){
            return ResponseFormatter::success($prodi, 'Prodi berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Prodi gagal ditambahkan');
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
     *     path="/api/admin/prodi/{id}",
     *     operationId="getAllProdiById",
     *     tags={"Prodi"},
     *     summary="Get Prodi Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Prodi ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/ProdiDetailResource")
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
        $prodi = Prodi::find($id);
        if($prodi == null){
            return ResponseFormatter::error(null, 'Prodi tidak ditemukan', 404);

        }
        return ResponseFormatter::success(new ProdiResource($prodi), 'Prodi berhasil didapatkan', 200);
        
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
     *     path="/api/admin/prodi/{id}",
     *     operationId="updateExistedProdi",
     *     tags={"Prodi"},
     *     summary="Update Existed Prodi",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Prodi ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProdiRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/ProdiDetailResource"),
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
        $prodi = Prodi::find($id);
        if($prodi == null){
            return ResponseFormatter::error(null, 'Prodi tidak ditemukan', 404);
        }
        $validator = Validator::make($request->all(), [
            'prodi_name' => ['required', 'string', Rule::unique('App\Models\Prodi')->ignore($prodi->prodi_name, 'prodi_name') ]
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $prodi->update($request->only('prodi_name'));

        if($prodi){
            return ResponseFormatter::success($prodi, 'Prodi berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Prodi gagal diubah');
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
     *     path="/api/admin/prodi/{id}",
     *     operationId="deleteExistingProdi",
     *     tags={"Prodi"},
     *     summary="Delete Existed Prodi",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Prodi ID",
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
        $prodi = Prodi::find($id);
        if($prodi == null){
            return ResponseFormatter::error(null, 'Prodi tidak ditemukan', 404);
        }
        $prodi->delete();

        if($prodi){
            return ResponseFormatter::success(null, 'Prodi berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Prodi gagal dihapus');
        }
    }
}
