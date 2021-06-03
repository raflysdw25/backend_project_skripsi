<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierCollection;




// Models
use App\Models\Supplier;

class SupplierController extends Controller
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
     *     path="/api/admin/supplier",
     *     operationId="getAllSupplier",
     *     tags={"Supplier"},
     *     summary="Return List of Supplier",
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
        $supplier = Supplier::orderBy('id', 'ASC')->get();

        if($supplier){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Supplier Berhasil didapatkan"
                ],
                "data" => $supplier,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 404,
                    "status" => "failed",
                    "mesasge" => "List Supplier Gagal didapatkan"
                ],
                "data" => null,
            ], 404);
        }
    }


    /**
     * @OA\Post(
     *     path="/api/admin/filter/supplier",
     *     operationId="getAllSupplierByFilter",
     *     tags={"Supplier"},
     *     summary="Return List of Supplier by Filter",
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
     *          @OA\JsonContent(ref="#/components/schemas/FilterSupplierRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SupplierListResource"),
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
        
        $supplier = Supplier::orderBy($sortBy, $sortDirection);

        if($request->has('supplier_name') && $request->supplier_name !== ""){
            $supplier->where('supplier_name', 'like' ,'%'.$request->supplier_name.'%');
        }
                
        if($request->has('supplier_address') && $request->supplier_address !== null){
            $supplier->where('supplier_address', 'like' ,'%'.$request->supplier_address.'%');
        }
        
        if($request->has('person_in_charge') && $request->person_in_charge !== ""){
            $supplier->where('person_in_charge', 'like' ,'%'.$request->person_in_charge.'%');
        }
        $collection = new SupplierCollection($supplier->paginate($paginate));

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
     *     path="/api/admin/supplier",
     *     operationId="createNewSupplier",
     *     tags={"Supplier"},
     *     summary="Create New Supplier",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSupplierRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SupplierDetailResource"),
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
            "supplier_name" => 'required|string|unique:App\Models\Supplier,supplier_name',
            "supplier_phone" => 'required|string',
            "person_in_charge" => 'required|string',            
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $supplier = Supplier::create([
            "supplier_name" => $request->supplier_name,
            "supplier_phone" => $request->supplier_phone,
            "person_in_charge" => $request->person_in_charge,
            "supplier_email" => $request->supplier_email,
            "supplier_address" => $request->supplier_address,
        ]);

        if($supplier){
            return ResponseFormatter::success($supplier, 'Supplier berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Supplier gagal ditambahkan', 500);
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
     *     path="/api/admin/supplier/{id}",
     *     operationId="getAllSupplierById",
     *     tags={"Supplier"},
     *     summary="Get Supplier Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Supplier ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/SupplierDetailResource")
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
        $supplier = Supplier::find($id);

        if($supplier == null){
            return ResponseFormatter::error(null, 'Supplier tidak ditemukan', 404);
        }

        return ResponseFormatter::success($supplier, 'Supplier berhasil ditemukan', 200);
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
     *     path="/api/admin/supplier/{id}",
     *     operationId="updateExistedSupplier",
     *     tags={"Supplier"},
     *     summary="Update Existed Supplier",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Supplier ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSupplierRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SupplierDetailResource"),
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
        $supplier = Supplier::find($id);

        if($supplier == null){
            return ResponseFormatter::error(null, 'Supplier tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(), [
            "supplier_name" => ['required', 'string', Rule::unique('App\Models\Supplier')->ignore($supplier->supplier_name, 'supplier_name')],
            "supplier_phone" => 'required|string',
            "person_in_charge" => 'required|string',            
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->fails(), 400);
        }

        $supplier->update($request->all());

        if($supplier){
            return ResponseFormatter::success($supplier, 'Supplier berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Supplier gagal diubah', 500);
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
     *     path="/api/admin/supplier/{id}",
     *     operationId="deleteExistingSupplier",
     *     tags={"Supplier"},
     *     summary="Delete Existed Supplier",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Supplier ID",
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
        $supplier = Supplier::find($id);

        if($supplier == null){
            return ResponseFormatter::error(null, 'Supplier tidak ditemukan', 404);
        }

        $supplier->delete();

        if($supplier){
            return ResponseFormatter::success(null, 'Supplier berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Supplier gagal dihapus', 500);
        }
    }
}
