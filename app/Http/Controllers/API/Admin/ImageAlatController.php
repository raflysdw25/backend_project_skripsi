<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\ImageAlatResource;
use App\Http\Resources\ImageAlatCollection;




// Models
use App\Models\ImageAlat;

class ImageAlatController extends Controller
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
    public function index()
    {
        

    }

    /**
     * @OA\Get(
     *     path="/api/admin/image-alat/get-by-alat-id/{alatId}",
     *     operationId="getAllImageAlat",
     *     tags={"Image Alat"},
     *     summary="Return List of Image Alat By Id",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="alatId",
     *        description="Alat ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
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
    public function getImageByAlatId($alatId)
    {
        $imageAlat = ImageAlat::where('alat_id', '=', $alatId)->orderBy('id', 'ASC')->get();

        if($imageAlat){
            // return response()->json([
            //     "response" => [
            //         "code" => 200,
            //         "status" => "success",
            //         "mesasge" => "List Image Alat Berhasil didapatkan"
            //     ],
            //     "data" => $imageAlat,
            // ], 200);
            return ResponseFormatter::success($imageAlat, 'List Image Alat berhasil didapatkan', 200);
        }else{
            // return response()->json([
            //     "response" => [
            //         "code" => 500,
            //         "status" => "success",
            //         "mesasge" => "List Image Alat Gagal didapatkan"
            //     ],
            //     "data" => null,
            // ], 500);
            return ResponseFormatter::error(null, 'List Image Alat gagal didapatkan', 500);
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
     *     path="/api/admin/image-alat",
     *     operationId="createNewImageAlat",
     *     tags={"Image Alat"},
     *     summary="Create New ImageAlat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreImageAlatRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/ImageAlatListResource"),
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
            "alat_id" => "required|integer|exists:App\Models\Alat,id",
            "image_data_list" => "required|array"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(),422);
        }

        $imageList = [];
        $imageDataList = $request->image_data_list;
        
        for ($position=0; $position < count($request->image_data_list); $position++) {
            $imageAlat = new ImageAlat(); 
            $imageAlat->alat_id = $request->alat_id;
            $imageAlat->image_data = $imageDataList[$position];
            
            $imageAlat->save();
        }

        // return ResponseFormatter::success(new ImageAlatResource($imageAlat), 'Image Alat berhasil dibuat', 201);

        // $imageAlat = ImageAlat::createMany($imageList);

        if($imageAlat){
            return ResponseFormatter::success($imageAlat, 'Image Alat berhasil dibuat', 201);
        }else{
            return ResponseFormatter::error(null,'Image Alat gagal dibuat', 500);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *     path="/api/admin/image-alat/{id}",
     *     operationId="deleteExistingImageAlat",
     *     tags={"Image Alat"},
     *     summary="Delete Existed Image Alat",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Image Alat ID",
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
        $imageAlat = ImageAlat::find($id);
        if($imageAlat == null){
            return ResponseFormatter::error(null, 'Image Alat tidak ditemukan', 404);
        }
        
        $imageAlat->delete();

        if($imageAlat){
            return ResponseFormatter::success(null, 'Image Alat berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'Image Alat gagal dihapus');
        }
    }
}
