<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Lokasi Penyimpanan Request",
 *      description="Store Lokasi Penyimpanan Request body data",
 *      type="object",
 *      required={"lokasi_name", "total_capacity"}
 * )
 */

class StoreLokasiPenyimpananRequest
{
    /**
     * @OA\Property(
     *      title="lokasi_name",
     *      description="Lokasi Name",
     *      example="Lemari A"
     * )
     *
     * @var string
     */
    public $lokasi_name;
    
    /**
     * @OA\Property(
     *      title="total_capacity",
     *      description="Total Capacity",
     *      example=100
     * )
     *
     * @var integer
     */
    public $total_capacity;
    
    /**
     * @OA\Property(
     *      title="available_capacity",
     *      description="Available Capacity",
     *      example=100
     * )
     *
     * @var integer
     */
    public $available_capacity;
    
    /**
     * @OA\Property(
     *      title="stored_capacity",
     *      description="Store Capacity",
     *      example=100
     * )
     *
     * @var integer
     */
    public $stored_capacity;

    

    
}