<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Detail Alat request",
 *      description="Filter Detail Alat request body data",
 *      type="object",
 * )
 */

class FilterDetailAlatRequest
{
    /**
     * @OA\Property(
     *      title="page_size",
     *      description="Page Size of Filter",
     *      example=5
     * )
     *
     * @var integer
     */
    public $page_size;

    /**
     * @OA\Property(
     *      title="sort_by",
     *      description="Sort Filter By Attributes",
     *      example="id"
     * )
     *
     * @var string
     */
    public $sort_by;
    
    /**
     * @OA\Property(
     *      title="sort_direction",
     *      description="Sort Direction of Filter",
     *      example="ASC"
     * )
     *
     * @var string
     */
    public $sort_direction;

    /**
     * @OA\Property(
     *      title="barcode_alat",
     *      description="Filter Barcode Alat",
     * )
     *
     * @var string
     */
    public $barcode_alat;
    
    /**
     * @OA\Property(
     *      title="condition_status",
     *      description="Filter Kondisi Alat",
     * )
     *
     * @var integer
     */
    public $condition_status;
    
    /**
     * @OA\Property(
     *      title="available_status",
     *      description="Filter Ketersediaan Alat",
     * )
     *
     * @var integer
     */
    public $available_status;
    
    /**
     * @OA\Property(
     *      title="lokasi_id",
     *      description="Filter Lokasi Penyimpanan",
     * )
     *
     * @var integer
     */
    public $lokasi_id;

    
}