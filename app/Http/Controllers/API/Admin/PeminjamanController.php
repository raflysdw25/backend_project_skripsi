<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\PeminjamanResource;
use App\Http\Resources\PeminjamanCollection;




// Models
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    protected $user;
    protected $isAuthorize;
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = auth()->user();
        // $this->isAuthorize = $this->user->jabatan_user->jabatan_name !== 'Kepala Laboratorium';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/peminjaman",
     *     operationId="getAllPeminjamanByFilter",
     *     tags={"Peminjaman"},
     *     summary="Return List of Peminjaman by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterPeminjamanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/PeminjamanListResource"),
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
        $sortDirection = $request->input('sort_direction', 'DESC');

        $peminjaman = Peminjaman::with(['mahasiswa_peminjam_model', 'staff_peminjam_model', 'staff_in_charge_model', 'ruangan_model', 'detail_peminjaman_model'])->orderBy($sortBy, $sortDirection);

        // Created At, Expected Return Date, Nomor Induk, Peminjaman Status
        if($request->has('created_at') && $request->created_at != null){
            $peminjaman->where('created_at', '=', $request->created_at);
        }
        
        if($request->has('expected_return_date') && $request->expected_return_date != null){
            $peminjaman->where('expected_return_date', '=', $request->expected_return_date);
        }
        
        if($request->has('nomor_induk') && $request->nomor_induk != ''){
            $peminjaman->where('nim_mahasiswa', 'like','%'.$request->nomor_induk.'%')->orWhere('nip_staff', 'like', '%'.$request->nomor_induk.'%');
        }
        
        if($request->has('pjm_status') && $request->pjm_status != null){
            $peminjaman->where('pjm_status', '=', $request->pjm_status);
        }

        $collection = new PeminjamanCollection($peminjaman->paginate($paginate));

        return $collection;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @OA\Put(
     *     path="/api/admin/peminjaman/approve-action/{peminjamanid}",
     *     operationId="Approve Action Peminjaman",
     *     tags={"Peminjaman"},
     *     summary="Approve Action Peminjaman ",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="peminjamanid",
     *        description="Peminjaman ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(
     *              required={"is_approved"},
     *              @OA\Property(property="is_approved",type="boolean"),
     * @OA\Property(property="pjm_notes",type="string"),
     *          ) 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/PeminjamanDetailResource"),
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
    public function approveAction(Request $request, $id)
    {
        // Atur agar approveAction hanya bisa dilakukan oleh user dengan Jabatan Kepala Laboratorium / Super Admin
        // if(!$this->isAuthorize){
        //     return ResponseFormatter::error(null, 'User Unauthorized to access this data', 401);
        // }
        // PJM Status Only change to 3 (Ditolak) & 4 (Belum Kembali)
        $peminjaman = Peminjaman::find($id);
        if($peminjaman == null){
            return ResponseFormatter::error(null,'Peminjaman tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            "is_approved" => "required|boolean",
            "pjm_notes" => "string",
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $isApproved = $request->is_approved;
        $statusPeminjaman = $isApproved ? 4 : 3;

        $peminjaman->update([
            "pjm_status" => $statusPeminjaman,
            "pjm_notes" => $request->pjm_notes,
        ]);

        if($peminjaman){
            return ResponseFormatter::success($peminjaman, 'Persetujuan peminjaman berhasil dilakukan', 200);
        }else{
            return ResponseFormatter::error(null,'Persetujuan peminjaman gagal dilakukan', 500);
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
     *     path="/api/admin/peminjaman/{id}",
     *     operationId="deleteExistingPeminjaman",
     *     tags={"Peminjaman"},
     *     summary="Delete Existed Peminjaman",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Peminjaman ID",
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
        $peminjaman = Peminjaman::find($id);

        if($peminjaman == null){
            return ResponseFormatter::error(null, 'Peminjaman tidak ditemukan', 404);
        }

        $peminjaman->delete();
        if($peminjaman){
            return ResponseFormatter::error(null, 'Peminjaman berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null,'Peminjaman gagal dihapus', 500);
        }
    }
}
