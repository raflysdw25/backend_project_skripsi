<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\RuanganResource;
use App\Http\Resources\RuanganCollection;




// Models
use App\Models\Ruangan;

class RuanganController extends Controller
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
     *     path="/api/admin/ruangan",
     *     operationId="getAllRuangan",
     *     tags={"Ruangan"},
     *     summary="Return List of Ruangan",
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
        $ruangan = Ruangan::orderBy('id', 'ASC')->get();

        if($ruangan){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Ruangan Berhasil didapatkan"
                ],
                "data" => $ruangan,
            ], 200); 
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Ruangan Gagal didapatkan"
                ],
                "data" => null,
            ], 500); 
        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/ruangan",
     *     operationId="getAllRuanganByFilter",
     *     tags={"Ruangan"},
     *     summary="Return List of Ruangan by Filter",
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
     *          @OA\JsonContent(ref="#/components/schemas/FilterRuanganRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/RuanganListResource"),
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

        $ruangan = Ruangan::orderBy($sortBy, $sortDirection);

        if($request->has('ruangan_name') && $request->ruangan_name !== ''){
            $ruangan->where('ruangan_name', 'like', '%'.$request->ruangan_name.'%');
        }

        if($request->has('id') && $request->id !== null){
            $ruangan->where('id', '=', $request->id);
        }

        $collection = new RuanganCollection($ruangan->paginate($paginate));

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
     *     path="/api/admin/ruangan",
     *     operationId="createNewRuangan",
     *     tags={"Ruangan"},
     *     summary="Create New Ruangan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreRuanganRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/RuanganDetailResource"),
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
            'ruangan_name' => 'required|string|unique:App\Models\Ruangan,ruangan_name'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $ruangan = Ruangan::create([            
            'ruangan_name' => $request->ruangan_name
        ]);

        if($ruangan){
            return ResponseFormatter::success($ruangan, 'Ruangan berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Ruangan gagal ditambahkan');
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
     *     path="/api/admin/ruangan/{id}",
     *     operationId="getAllRuanganById",
     *     tags={"Ruangan"},
     *     summary="Get Ruangan Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Ruangan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/RuanganDetailResource")
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
        $ruangan = Ruangan::find($id);
        if($ruangan == null){
            return ResponseFormatter::error(null, 'Ruangan tidak ditemukan', 404);

        }
        return ResponseFormatter::success(new RuanganResource($ruangan), 'Ruangan berhasil didapatkan', 200);
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
     *     path="/api/admin/ruangan/{id}",
     *     operationId="updateExistedRuangan",
     *     tags={"Ruangan"},
     *     summary="Update Existed Ruangan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Ruangan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreRuanganRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/RuanganDetailResource"),
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
        $ruangan = Ruangan::find($id);
        if($ruangan == null){
            return ResponseFormatter::error(null, 'Ruangan tidak ditemukan', 404);

        }

        $validator = Validator::make($request->all(), [
            'ruangan_name' => ['required', 'string', Rule::unique('App\Models\Ruangan')->ignore($ruangan->ruangan_name, 'ruangan_name') ]
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $ruangan->update($request->only('ruangan_name'));

        if($ruangan){
            return ResponseFormatter::success($ruangan, 'Ruangan berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Ruangan gagal diubah');
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
     *     path="/api/admin/ruangan/{id}",
     *     operationId="deleteExistingRuangan",
     *     tags={"Ruangan"},
     *     summary="Delete Existed Ruangan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Ruangan ID",
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
        $ruangan = Ruangan::find($id);
        if($ruangan == null){
            return ResponseFormatter::error(null, 'Ruangan tidak ditemukan', 404);
        }

        if($ruangan){
            return ResponseFormatter::success(null, 'Ruangan berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Ruangan gagal dihapus');
        }
    }
}
