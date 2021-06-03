<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\DetailAlatResource;
use App\Http\Resources\DetailAlatCollection;




// Models
use App\Models\Alat;
use App\Models\DetailAlat;
use App\Models\LokasiPenyimpanan;

class DetailAlatController extends Controller
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
     *     path="/api/admin/detail-alat",
     *     operationId="getAllDetailAlat",
     *     tags={"Detail Alat"},
     *     summary="Return List of Detail Alat",
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
        $detailAlat = DetailAlat::orderBy('id', 'ASC')->get();

        if($detailAlat){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Detail Alat Berhasil didapatkan"
                ],
                "data" => $detailAlat,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "success",
                    "mesasge" => "List Detail Alat Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/detail-alat/{alatId}",
     *     operationId="getAllDetailAlatByFilter",
     *     tags={"Detail Alat"},
     *     summary="Return List of Detail Alat by Filter",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *        name="alatId",
     *        description="Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterDetailAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/DetailAlatListResource"),
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
    public function filter(Request $request, $alatId)
    {
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');

        $detailAlat = DetailAlat::where('alat_id','=',$alatId)->orderBy($sortBy, $sortDirection);

        // Barcode Alat, Kondisi Alat, Ketersediaan Alat, Lokasi Penyimpanan
        if($request->has('barcode_alat') && $request->barcode_alat != ''){
            $detailAlat->where('barcode_alat', 'like', '%'.$request->barcode_alat.'%');
        }
        
        if($request->has('condition_status') && $request->condition_status != null){
            $detailAlat->where('condition_status', '=', $request->condition_status);
        }
        
        if($request->has('available_status') && $request->available_status != null){
            $detailAlat->where('available_status', '=', $request->available_status);
        }

        $collection = new DetailAlatCollection($detailAlat->paginate($paginate));

        return $collection;
        
    }

    /**
     * @OA\Get(
     *     path="/api/admin/detail-alat/get-by-alat-id/{alatId}",
     *     operationId="getAllDetailAlatByAlatId",
     *     tags={"Detail Alat"},
     *     summary="Get Detail Alat by Alat Id Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="alatId",
     *        description="Detail Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/DetailAlatDetailResource")
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
    public function getByAlatId($alat_id){
        $detailAlat = DetailAlat::with(['alat_model', 'lokasi_model'])->where('alat_id', '=', $alat_id)->orderBy('id', 'ASC')->get();
        

        if($detailAlat){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Detail Alat Berdasarkan Alat ID Berhasil didapatkan"
                ],
                "data" => $detailAlat,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "success",
                    "mesasge" => "List Detail Alat Berdasarkan Alat ID Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/admin/detail-alat",
     *     operationId="createNewDetailAlat",
     *     tags={"Detail Alat"},
     *     summary="Create New Detail Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreDetailAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/DetailAlatDetailResource"),
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
            "alat_id" => 'required|integer|exists:App\Models\Alat,id',
            "lokasi_id" => 'required|integer|exists:App\Models\LokasiPenyimpanan,id',
            "total_alat" => "required|integer"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }
        
        
        $totalInsertedAlat = $request->total_alat;
        $alat = Alat::with(['details'])->find($request->alat_id);
        
        for ($position=1; $position < $totalInsertedAlat ; $position++) { 
             /* 
                    Barcode Combination : 
                    IDAlat_Urutan Alat Dimasukkan_3 huruf Nama Alat (CAPS)_Tahun
                    Contoh : 11ASU2017 -> Urutan Alat : Jumlah alat 
                */

                //Mendapatkan 3 huruf pertama nama alat dalam huruf kapital
                $alatName = strtoupper(substr($alat->alat_name,0,3)); 

                //Assign Tahun Alat
                $alatYear = $alat->alat_year; 
                $newPosition = $alat->alat_total + $position;

                // Buat Barcode Alat
                $newBarcode = $alat->id.''.$newPosition.''.$alatName.''.$alatYear;
                
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

                $alat->increment('alat_total');
        }

        // $createDetail = DetailAlat::createMany($detailAlat);
        $alat->details()->saveMany($detailAlat);
        if($createDetail){
            return ResponseFormatter::success($createDetail, 'Detail Alat baru berhasil dibuat', 201);
        }else{
            return ResponseFormatter::error(null, 'Detail Alat baru gagal dibuat', 500);
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
     *     path="/api/admin/detail-alat/{id}",
     *     operationId="getAllDetailAlatById",
     *     tags={"Detail Alat"},
     *     summary="Get Detail Alat Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Detail Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/DetailAlatDetailResource")
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
        $detailAlat = DetailAlat::find($id);
        if($detailAlat == null){
            return ResponseFormatter::error(null, 'Detail Alat tidak ditemukan', 404);
        }
        return ResponseFormatter::success(new DetailAlatResource($detailAlat), 'Detail Alat berhasil didapatkan', 200);
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

    // Change Status
    /**
     * @OA\Put(
     *     path="/api/admin/detail-alat/update-condition/{id}",
     *     operationId="update Condition Detail Alat",
     *     tags={"Detail Alat"},
     *     summary="Update  Condition Detail Alat ",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Detail Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(
     *              required={"condition_status"},
     *              @OA\Property(property="condition_status",type="integer"),
     *          ) 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/DetailAlatDetailResource"),
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
    public function updateConditionStatus(Request $request, $id){

        $validator = Validator::make($request->all(), [
            "condition_status" => 'required|integer'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $detailAlat = DetailAlat::find($id);
        if($detailAlat == null){
            return ResponseFormatter::error(null, 'Detail Alat tidak ditemukan', 404);
        }

        $availableStatus = null;
        if($request->condition_status == 2){
            $availableStatus = 2;
        }else{
            $availableStatus = 3;
        }

        $detailAlat->update([
            "condition_status" => $request->condition_status,
            "available_status" => $availableStatus
        ]);

        if($detailAlat){
            return ResponseFormatter::success($detailAlat, 'Status Kondisi Detail Alat berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Status Kondisi Detail Alat gagal diubah', 500);
        }

    }

    /**
     * @OA\Put(
     *     path="/api/admin/detail-alat/update-available/{id}",
     *     operationId="update Available Status Detail Alat",
     *     tags={"Detail Alat"},
     *     summary="Update  Available Status Detail Alat ",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Detail Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(
     *              required={"available_status"},
     *              @OA\Property(property="available_status",type="integer"),
     *          ) 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/DetailAlatDetailResource"),
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

    public function updateAvailableStatus(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "available_status" => 'required|integer'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $detailAlat = DetailAlat::find($id);
        if($detailAlat == null){
            return ResponseFormatter::error(null, 'Detail Alat tidak ditemukan', 404);
        }

        $detailAlat->update([
            'available_status' => $request->available_status
        ]);

        if($detailAlat){
            return ResponseFormatter::success($detailAlat, 'Status Ketersediaan Detail Alat berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Status Ketersediaan Detail Alat gagal diubah', 500);
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
     *     path="/api/admin/detail-alat/{id}",
     *     operationId="deleteExistingDetailAlat",
     *     tags={"Detail Alat"},
     *     summary="Delete Existed DetailAlat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="DetailAlat ID",
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
        $detailAlat = DetailAlat::with(['alat_model'])->find($id);
        if($detailAlat == null){
            return ResponseFormatter::error(null, 'Detail Alat tidak ditemukan', 404);
        }

        $detailAlat->alat_model->decrement('alat_total');
        $lokasi = $detailAlat->lokasi_model;
        $lokasi->increment('available_capacity');
        $lokasi->decrement('stored_capacity');

        $detailAlat->delete();

        if($detailAlat){
            return ResponseFormatter::success(null, 'Detail Alat berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Detail Alat gagal dihapus');
        }
    }
}
