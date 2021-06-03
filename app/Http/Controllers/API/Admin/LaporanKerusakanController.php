<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

// Resource
use App\Http\Resources\LaporanKerusakanResource;
use App\Http\Resources\LaporanKerusakanCollection;




// Models
use App\Models\LaporanKerusakan;

class LaporanKerusakanController extends Controller
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
     *     path="/api/admin/laporan",
     *     operationId="getAllLaporanKerusakanAlat",
     *     tags={"Laporan Kerusakan Alat"},
     *     summary="Return List of Laporan Kerusakan Alat",
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
        $laporan = LaporanKerusakan::orderBy('id', 'ASC')->get();

        if($laporan){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Laporan Kerusakan Berhasil didapatkan"
                ],
                "data" => $laporan,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Laporan Kerusakan Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }    
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/laporan",
     *     operationId="getAllLaporanKerusakanByFilter",
     *     tags={"Laporan Kerusakan Alat"},
     *     summary="Return List of Laporan Kerusakan by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterLaporanKerusakanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LaporanKerusakanListResource"),
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

        $laporan = LaporanKerusakan::with(['barcode_alat_rusak.alat_model', 'mahasiswa_lapor_model', 'staff_lapor_model'])->orderBy($sortBy,$sortDirection);

        if($request->has('report_date') && $request->report_date != null){
            $laporan->where('report_date','=',$request->report_date);
        }
        
        if($request->has('report_status') && $request->report_status != null){
            $laporan->where('report_status','=',$request->report_status);
        }
        
        if($request->has('barcode_alat') && $request->barcode_alat != null){
            $laporan->where('barcode_alat','like','%'.$request->barcode_alat.'%');
        }
        
        if($request->has('chronology') && $request->chronology != null){
            $laporan->where('chronology','like','%'.$request->chronology.'%');
        }

        if($request->has('nomor_induk') && $request->nomor_induk != ''){
            $laporan->where('nim_mahasiswa', 'like', '%'.$request->nomor_induk.'%')->orWhere('nim_mahasiswa', 'like', '%'.$request->nomor_induk.'%');
        }

        $collection = new LaporanKerusakanCollection($laporan->paginate($paginate));

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

    // Tindakan Laporan
    /**
     * @OA\Put(
     *     path="/api/admin/laporan/report-action/{laporanId}",
     *     operationId="ActionToLaporanKerusakan",
     *     tags={"Laporan Kerusakan Alat"},
     *     summary="Tindakan terhadap Laporan Kerusakan ",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="laporanId",
     *        description="Laporan Kerusakan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(
     *              required={"action"},
    *               @OA\Property(property="action",type="integer"),
    *               @OA\Property(property="report_notes",type="string"),
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
    public function reportAction(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "action" => "required|integer",            
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->erros(), 422);
        }

        $laporan = LaporanKerusakan::with(['barcode_alat_rusak'])->find($id);

        if($laporan == null){
            return ResponseFormatter::error(null, 'Laporan tidak ditemukan', 404);
        }

        if($laporan->report_action != null){
            return ResponseFormatter::error(null, 'Laporan sudah ditindaklanjuti', 404);
        }

        /* 
            Ubah Available & Condition Status Detail Alat berdasarkan Action Laporan Kerusakan 

            Action : 2
            Condition : 5, Available: 3
            Action : 3
            Condition : 6, Available: 3
        */
        $reportAction = $request->action;
        $availableStatus = 3;
        
        if($reportAction == 2){
            $conditionStatus = 5;
        }else if($reportAction == 3){
            $conditionStatus = 6;
        }

        $laporan->barcode_alat_rusak()->update([
            "condition_status" => $conditionStatus,
            "available_status" => $availableStatus
        ]);

        $laporan->update([
           "report_action" => Carbon::now(),
           "report_status" => $reportAction,
           "report_notes" => $request->report_notes, 
        ]);
        

        if($laporan){
            return ResponseFormatter::success($laporan, 'Tindakan berhasil dilakukan', 200);
        }else{
            return ResponseFormatter::error(null, 'Tindakan gagal dilakukan', 500);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = LaporanKerusakan::find($id);

        if($laporan == null){
            return ResponseFormatter::error(null, 'Laporan tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new LaporanKerusakanResource($laporan), 'Laporan berhasil didapatkan', 200);
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
     *     path="/api/admin/laporan/{id}",
     *     operationId="deleteExistingLaporanKerusakanAlat",
     *     tags={"Laporan Kerusakan Alat"},
     *     summary="Delete Existed Laporan Kerusakan Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Laporan Kerusakan Alat ID",
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
        $laporan = LaporanKerusakan::find($id);

        if($laporan == null){
            return ResponseFormatter::error(null, 'Laporan tidak ditemukan', 404);
        }

        $laporan->delete();
        if($laporan){
            return ResponseFormatter::success(null, 'Laporan berhasil dihapus', 200);
        }else{
            return ResponsFormatter::error(null, 'Laporan gagal dihapus', 500);
        }
    }
}
