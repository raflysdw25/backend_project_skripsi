<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

// Resource
use App\Http\Resources\StaffLaboratoriumResource;
use App\Http\Resources\StaffLaboratoriumCollection;




// Models
use App\Models\User;



class StaffLaboratoriumController extends Controller
{
    protected $user;
    protected $isAuthorize;
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = auth()->user();
        // $this->isAuthorize = $this->user->jabatan_user->jabatan_name !== 'Kepala Laboratorium' && $this->user->jabatan_user->jabatan_name !== 'Super Admin';
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/admin/user",
     *     operationId="getAllUser",
     *     tags={"User"},
     *     summary="Return List of User",
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
        // if($this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }

        $user = User::with(['jabatan_user', 'staff_user'])->orderBy('id', 'ASC')->whereNotIn('id', [1])->get();

        if($user){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List User Berhasil didapatkan"
                ],
                "data" => $user,
            ], 200);
        }

    }

    // Filter
    /**
     * @OA\Post(
     *     path="/api/admin/filter/user",
     *     operationId="getAllUserByFilter",
     *     tags={"User"},
     *     summary="Return List of User by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterUserRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserListResource"),
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
        // if(!$this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }

        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');
        
        $user = User::with(['jabatan_user', 'staff_user'])
                ->orderBy($sortBy, $sortDirection);                
        
        // Filter
        $condition = 0;

        if($request->has('nip') && $request->nip !== ""){
            $user->where('nip', 'like', '%'.$request->nip.'%');
        }

        if($request->has('jabatan_id') && $request->jabatan_id !== null){    
            $user->where('jabatan_id', '=', $request->jabatan_id);
        }   


        $collection = new StaffLaboratoriumCollection($user->whereNotIn('id',[1])->paginate($paginate));
        
        // return $collection;
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
     *     path="/api/admin/user",
     *     operationId="createNewUser",
     *     tags={"User"},
     *     summary="Create New User",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserListResource"),
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
        // if(!$this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }
        // $request->start_active_period = Carbon::now();
        $request->end_active_period = Carbon::tomorrow();
        $validator = Validator::make($request->all(), [
            'nip' => ['required', 'exists:App\Models\Staff,nip', 'string'],
            'email' => ['email'],
            'start_active_period' => ['date'],
            'end_active_period' => ['date'],
            'jabatan_id' => 'required|integer|exists:App\Models\Jabatan,id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $user = User::create([
            "nip" => $request->nip,
            "email" => $request->email,
            "start_active_period" => $request->start_active_period,
            "end_active_period" => $request->end_active_period,
            "jabatan_id" => $request->jabatan_id,
        ]);

        if($user){
            return ResponseFormatter::success($user, 'User berhasil ditambahkan', 200);
        }else{
            return ResponseFormatter::error(null, 'User gagal ditambahkan');
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
     *     path="/api/admin/user/{id}",
     *     operationId="getAllUserById",
     *     tags={"User"},
     *     summary="Get User Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="User ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/UserDetailResource")
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
        // if(!$this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new StaffLaboratoriumResource($user), 'User berhasil didapatkan', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *     path="/api/admin/user/{id}",
     *     operationId="deleteExistingUser",
     *     tags={"User"},
     *     summary="Delete Existed User",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="User ID",
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
        // if(!$this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        $user->delete();
        if($user){
            return ResponseFormatter::success(null, 'User berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'User gagal dihapus', 500);
        }
    }
}
