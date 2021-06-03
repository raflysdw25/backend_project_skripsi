<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    protected function guard(){
        return Auth::guard();
    }

    /**
     * @OA\Post(
     * path="/api/admin/auth",
     * summary="Login Admin",
     * description="Login Admin by nip, and password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"nip","password"},
     *       @OA\Property(property="nip", type="string"),
     *       @OA\Property(property="password", type="string", format="password"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function login(Request $request){
        
        $validasi = Validator::make($request->all(), [
            "nip" => "required|string|max:16",
            "password" => "required|string"
        ]);

        if($validasi->fails()){
            return ResponseFormatter::error(null, $validasi->error(), 402);
        }

        $token_validity = (24*60);
        auth()->factory()->setTTL($token_validity);

        if(!$token = auth()->attempt($validasi->validate())){
            return ResponseFormatter::error(null, "Unauthorized Auth", 401);
        }

        return $this->responseWithToken($token);
    }

    /**
     * @OA\Post(
     *  path="/api/admin/auth/logout",
     *  summary="Logout Admin",
     *  description="Logout Admin",
     *  operationId="authLogout",
     *  tags={"Authentication"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",          
     *   ),
     * )          
     */
    public function signout(){
        Auth::logout();
        return response()->json([
            'response' => [
                'code' => 200,
                'status' => 'success',
                'message'=> 'User Logged Out'
            ], 
            'data' => null,
        ]);
    }

    protected function responseWithToken($token){
        
        $responseData = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'id' => Auth::user()->id,
            'user_active_period' => Auth::user()->start_active_period,
            'user_expire_period' => Auth::user()->end_active_period,
            'staff_model' => Auth::user()->staff_user,
            'jabatan_model' => Auth::user()->jabatan_user,
            
        ];

        return ResponseFormatter::success($responseData, 'User berhasil login', 200);
    }
}
