<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Lokasi Penyimpanan request",
 *      description="Filter Lokasi Penyimpanan request body data",
 *      type="object",
 * )
 */

class FilterLokasiPenyimpananRequest
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
     *      title="lokasi_name",
     *      description="Filter Nama Lokasi",
     * )
     *
     * @var string
     */
    public $lokasi_name;
    
    /**
     * @OA\Property(
     *      title="total_capacity",
     *      description="Filter Kapasitas Total",
     * )
     *
     * @var integer
     */
    public $total_capacity;
    
    /**
     * @OA\Property(
     *      title="available_capacity",
     *      description="Filter Kapasitas Tersedia",
     * )
     *
     * @var integer
     */
    public $available_capacity;

    
}