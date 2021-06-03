<?php

namespace App\Http\Controllers\API\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

// Model
use App\Models\Mahasiswa;
use App\Models\Staff;
use App\Models\Peminjaman;
use App\Models\LaporanKerusakan;
use App\Models\Ruangan;
use App\Models\Alat;
use App\Models\DetailAlat;
use App\Models\LokasiPenyimpanan;

// Resource
use App\Http\Resources\MahasiswaResource;
use App\Http\Resources\StaffResource;
// use App\Http\Resources\PeminjamanResource;
use App\Http\Resources\LaporanKerusakanResource;
use App\Http\Resources\RuanganResource;
use App\Http\Resources\AlatResource;
use App\Http\Resources\DetailAlatResource;
use App\Http\Resources\LokasiPenyimpananResource;

class PeminjamController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/peminjaman/add-mahasiswa",
     *     operationId="createNewMahasiswa",
     *     tags={"Peminjam"},
     *     summary="Create New Mahasiswa",
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
    public function addNewMahasiswa(Request $request)
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
            return ResponseFormatter::success(new MahasiswaResource($mahasiswa), 'Mahasiswa berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Mahasiswa gagal ditambahkan', 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/peminjaman/add-laporan-kerusakan",
     *     operationId="createNewLaporanKerusakan",
     *     tags={"Peminjam"},
     *     summary="Create New LaporanKerusakan",
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLaporanKerusakanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LaporanKerusakanDetailResource"),
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
    public function addNewLaporanKerusakan(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string",
            "barcode_alat" => "required|string|exists:App\Models\DetailAlat,barcode_alat",
            "chronology" => "required|string",
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->erros(), 400);
        }
        
        $nip_staff = '';
        $nim_mahasiswa = '';
        $mahasiswa = Mahasiswa::find($request->nomor_induk);
        if($mahasiswa == null){
            $staff = Staff::find($request->nomor_induk);
            if($staff == null){
                return ResponseFormatter::error(null, 'Pelapor tidak ditemukan', 404);
            }else{
                $nip_staff = $request->nomor_induk;
            }
        }else{
           $nim_mahasiswa = $request->nomor_induk;
        } 

        $laporan = LaporanKerusakan::create([
            "nim_mahasiswa" => $nim_mahasiswa,
            "nip_staff" => $nip_staff,
            "barcode_alat" => $request->barcode_alat,
            "chronology" => $request->chronology,
            "report_status" => 1,
            "report_date" => Carbon::now()
        ]);

        $laporan->barcode_alat_rusak()->update([
            "condition_status" => 1,
            "available_status" => 1,
        ]);

        if($laporan){
            return ResponseFormatter::success(new LaporanKerusakanResource($laporan), 'Laporan kerusakan berhasil dibuat', 201);
        }else{
            return ResponseFormatter::error(null, 'Laporan Kerusakan gagal dibuat', 500);
        }
        
        
    }

    // Untuk mendapatkan data mahasiswa atau staff untuk peminjaman
    public function getDataPeminjam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $mahasiswa = Mahasiswa::find($request->nomor_induk);
        if($mahasiswa == null){
            $staff = Staff::find($request->nomor_induk);
            if($staff == null){
                return ResponseFormatter::error(null, 'Peminjaman tidak ditemukan', 404);
            }else{
                return ResponseFormatter::success(new StaffResource($staff), 'Peminjaman berhasil ditemukan', 200);
            }
        }else{
            return ResponseFormatter::success(new MahasiswaResource($mahasiswa), 'Peminjaman berhasil ditemukan', 200);
        }
    }

    //Untuk dapet data peminjaman terbaru
    public function getRecentPeminjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $recentPeminjaman = Peminjaman::where('pjm_status', '=', 4)->where('nip_staff', '=', $request->nomor_induk)->orWhere('nim_mahassiwa', '=', $request->nomor_induk)->get(); 

        if($recentPeminjaman){
            return ResponseFormatter::success($recentPeminjaman[0], 'Peminjaman terbaru berhasil didapatkan', );
        }
    }
}
