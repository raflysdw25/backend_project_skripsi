<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


// Resource and Collection
use App\Http\Resources\StaffResource;
use App\Http\Resources\StaffCollection;


// Model
use App\Models\Staff;

class StaffController extends Controller
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
     *     path="/api/admin/staff",
     *     operationId="getAllStaff",
     *     tags={"Staff"},
     *     summary="Return List of Staff",
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

        $staff = Staff::with(['staff_prodi'])->whereNotIn('nip',['admin'])->orderBy('created_at', 'ASC')->get();

        if($staff){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Staff Berhasil didapatkan"
                ],
                "data" => $staff,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Staff Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }
    
    /**
     * @OA\Post(
     *     path="/api/admin/filter/staff",
     *     operationId="getAllStaffByFilter",
     *     tags={"Staff"},
     *     summary="Return List of Staff by Filter",
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
     *          @OA\JsonContent(ref="#/components/schemas/FilterStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffListResource"),
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

        $staff = Staff::with(['staff_prodi'])->orderBy($sortBy,$sortDirection);

        
        // Filter berdasarkan nip
        if($request->has('nip') && $request->nip !== ''){
            $staff->where('nip', 'like', '%'.$request->nip.'%');
        }
        
        // Filter berdasarkan nama staff
        if($request->has('staff_fullname') && $request->staff_fullname !== ''){
            $staff->where('staff_fullname', 'like', '%'.$request->staff_fullname.'%');
        }
        
        // Filter berdasarkan prodi id
        if($request->has('prodi_id') && $request->prodi_id !== null){
            $staff->where('prodi_id', '=', $request->prodi_id);
        }
        
        // Filter berdasarkan email
        if($request->has('email') && $request->email !== ''){
            $staff->where('email', 'like', '%'.$request->email.'%');
        }

        

        $collection = new StaffCollection($staff->whereNotIn('nip', ['admin'])->paginate($paginate));
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
     *     path="/api/admin/staff",
     *     operationId="createNewStaff",
     *     tags={"Staff"},
     *     summary="Create New Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffDetailResource"),
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
            'nip' => 'required|unique:App\Models\Staff,nip',
            'staff_fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'prodi_id' => 'nullable|integer|exists:App\Models\Prodi,id',            
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $staff = Staff::create($request->all());
        if($staff){
            return ResponseFormatter::success($staff, 'Staff berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Staff gagal ditambahkan');
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
     *     path="/api/admin/staff/{nip}",
     *     operationId="getAllStaffByNip",
     *     tags={"Staff"},
     *     summary="Get Staff Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/StaffDetailResource")
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
    public function show($nip)
    {
        try {
            $staff = Staff::findOrFail($nip);
            return ResponseFormatter::success(new StaffResource($staff), 'Staff berhasil didapatkan', 200);
            //code...
        } catch (ModelNotFoundException $exception) {
            //throw $th;
            return ResponseFormatter::error(null, $exception->getMessage());
        }
        
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
     *     path="/api/admin/staff/{nip}",
     *     operationId="updateExistedStaff",
     *     tags={"Staff"},
     *     summary="Update Existed Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffDetailResource"),
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
    public function update(Request $request, Staff $staff)
    {
        $validator = Validator::make($request->all(), [
            'nip' => ['required', Rule::unique('App\Models\Staff')->ignore($staff->nip, 'nip')],
            'staff_fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'prodi_id' => 'integer'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }


        $staff->update($request->all());
        if($staff){
            return ResponseFormatter::success($staff, 'Staff berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Staff gagal diubah');
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
     *     path="/api/admin/staff/{nip}",
     *     operationId="deleteExistingStaff",
     *     tags={"Staff"},
     *     summary="Delete Existed Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
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
    public function destroy(Staff $staff)
    {
        $staff->delete();

        if($staff){
            return ResponseFormatter::success(null, 'Staff berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Staff gagal dihapus');
        }
    }
}
