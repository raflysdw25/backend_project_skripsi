<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Image Alat Request",
 *      description="Store Image Alat Request body data",
 *      type="object",
 *      required={"image_data_list", "alat_id"}
 * )
 */

class StoreImageAlatRequest
{
    /**
     * @OA\Property(
     *      title="alat_id",
     *      description="ImageAlat Name",
     * )
     *
     * @var integer
     */
    public $alat_id;

    /**
     * @OA\Property(
     *      title="image_data_list",
     *      description="Image Alat List",
     *      @OA\Items(
     *          
     *      )
     * )
     *
     * @var array
     */
    public $image_data_list;   

    
}