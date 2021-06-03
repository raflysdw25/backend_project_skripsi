<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\AlatResource;
use App\Http\Resources\AlatCollection;



// Models
use App\Models\Alat;
use App\Models\DetailAlat;
use App\Models\LokasiPenyimpanan;

class AlatController extends Controller
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
     *     path="/api/admin/alat",
     *     operationId="getAllAlat",
     *     tags={"Alat"},
     *     summary="Return List of Alat",
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
        $alat = Alat::orderBy('id', 'ASC')->get();

        if($alat){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Alat Berhasil didapatkan"
                ],
                "data" => $alat,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "success",
                    "mesasge" => "List Alat Gagal didapatkan"
                ],
                "data" => null,
            ], 500);

        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/alat",
     *     operationId="getAllAlatByFilter",
     *     tags={"Alat"},
     *     summary="Return List of Alat by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AlatListResource"),
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

        // Filter: Nama Alat, Jenis Alat, Asal Pengadaan, Tahun Pengadaan
        $alat = Alat::with(['jenis_alat_model', 'asal_pengadaan_model'])->orderBy($sortBy, $sortDirection);

        if($request->has('alat_name') && $request->alat_name !== ''){
            $alat->where('alat_name', 'like', '%'.$request->alat_name.'%');
        }
        
        if($request->has('jenis_alat_id') && $request->jenis_alat_id !== null){
            $alat->where('jenis_alat_id', '=', $request->jenis_alat_id);
        }
        
        if($request->has('asal_pengadaan_id') && $request->asal_pengadaan_id !== null){
            $alat->where('asal_pengadaan_id', '=', $request->asal_pengadaan_id);

        }
        
        if($request->has('alat_year') && $request->alat_year !== ''){
            $alat->where('alat_year', 'like', '%'.$request->alat_year.'%');
        }

        $collection = new AlatCollection($alat->paginate($paginate));

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
     *     path="/api/admin/alat",
     *     operationId="createNewAlat",
     *     tags={"Alat"},
     *     summary="Create New Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AlatDetailResource"),
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
        // Request = alat_name, jenis_alat_id, alat_specs (nullable), asal_pengadaan_id, alat_year, supplier_id (nullable), alat_total, lokasi_id

        $validator = Validator::make($request->all(),[
            "alat_name" => 'required|string|unique:App\Models\Alat,alat_name',
            "jenis_alat_id" => 'required|integer|exists:App\Models\JenisAlat,id',
            "asal_pengadaan_id" => 'required|integer|exists:App\Models\AsalPengadaan,id',
            "alat_year" => 'required|string',
            "alat_total" => 'required|integer',
            "supplier_id" => 'nullable|integer|exists:App\Models\Supplier,id',
            "lokasi_id" => 'required|integer|exists:App\Models\LokasiPenyimpanan,id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $dataAlat = $request->except('lokasi_id');

        $alat = Alat::create($dataAlat);

        if($alat){
            // Assign total alat
            $total_alat = $request->alat_total;

            // Proses untuk membuat data detail alat baru
            for ($position = 1; $position <= $total_alat ; $position++) { 

                /* 
                    Barcode Combination : 
                    IDAlat_Urutan Alat Dimasukkan_3 huruf Nama Alat (CAPS)_Tahun
                    Contoh : 11ASU2017 -> Urutan Alat : Jumlah alat 
                */

                //Mendapatkan 3 huruf pertama nama alat dalam huruf kapital
                $alatName = strtoupper(substr($request->alat_name,0,3)); 

                //Assign Tahun Alat
                $alatYear = $request->alat_year; 

                // Buat Barcode Alat
                $newBarcode = $alat->id.''.$position.''.$alatName.''.$alatYear;
                
                // Tambah Data Detail Alat baru
                /* 
                    Default Status: 
                    Condition : 1 (Baik)
                    Available: 2 (Tersedia)
                */
                $detailAlat[] = new DetailAlat([
                    "barcode_alat" => $newBarcode,
                    "condition_status" => 2, //Default to Baik
                    "available_status" => 2, //Default to Tersedia
                    "lokasi_id" => $request->lokasi_id
                ]);

                
                // Kurangin available_capacity & tambah stored_capacity
                $lokasi = LokasiPenyimpanan::find($request->lokasi_id);
                $lokasi->decrement('available_capacity');
                $lokasi->increment('stored_capacity');
            }

            $alat->details()->saveMany($detailAlat);

            return ResponseFormatter::success($alat, 'Alat berhasil disimpan', 201);
        }else{
            return ResponseFormatter::error(null, 'Alat gagal ditambahkan'); 
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
     *     path="/api/admin/alat/{id}",
     *     operationId="getAllAlatById",
     *     tags={"Alat"},
     *     summary="Get Alat Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/AlatDetailResource")
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
        $alat = Alat::with(['supplier_model', 'details', 'jenis_alat_model', 'asal_pengadaan_model', 'images'])->find($id);

        if($alat == null){
            return ResponseFormatter::error(null, 'Alat tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new AlatResource($alat), 'Alat berhasil didapatkan', 200);
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
     *     path="/api/admin/alat/{id}",
     *     operationId="updateExistedAlat",
     *     tags={"Alat"},
     *     summary="Update Existed Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AlatDetailResource"),
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
        $alat = Alat::find($id);

        if($alat == null){
            return ResponseFormatter::error(null, 'Alat tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            "alat_name" => ['required', 'string', Rule::unique('App\Models\Alat')->ignore($alat->alat_name, 'alat_name')],
            "jenis_alat_id" => 'required|integer|exists:App\Models\JenisAlat,id',
            "asal_pengadaan_id" => 'required|integer|exists:App\Models\AsalPengadaan,id',
            "alat_year" => 'required|string',            
            "supplier_id" => 'nullable|integer|exists:App\Models\Supplier,id',           
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $alat->update([
            "alat_name" => $request->alat_name,
            "jenis_alat_id" => $request->jenis_alat_id,
            "asal_pengadaan_id" => $request->asal_pengadaan_id,
            "supplier_id" => $request->supplier_id,
            "alat_year" => $request->alat_year,
        ]);

        if($alat){
            return ResponseFormatter::success($alat, 'Alat berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Alat gagal diubah');
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
     *     path="/api/admin/alat/{id}",
     *     operationId="deleteExistingAlat",
     *     tags={"Alat"},
     *     summary="Delete Existed Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Alat ID",
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
        $alat = Alat::with(['details'])->find($id);

        if($alat == null){
            return ResponseFormatter::error(null, 'Alat tidak ditemukan', 404);
        }
        // Update Data Available dan Store Capacity di Lokasi Penyimpanan
        $detailAlat = $alat->details;

        
        foreach ($detailAlat as $detail) {
            $lokasi = LokasiPenyimpanan::find($detail->lokasi_id);
            $lokasi->increment('available_capacity');
            $lokasi->decrement('stored_capacity');
        }

        $alat->delete();

        if($alat){
            return ResponseFormatter::success(null, 'Alat berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Alat gagal dihapus');
        }
    }
}
