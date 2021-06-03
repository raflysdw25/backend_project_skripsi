<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Asal Pengadaan request",
 *      description="Filter Asal Pengadaan request body data",
 *      type="object",
 * )
 */

class FilterAsalPengadaanRequest
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
     *      title="id",
     *      description="Filter Asal Pengadaan ID",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="asal_pengadaan_name",
     *      description="Filter Asal Pengadaan Name",
     * )
     *
     * @var string
     */
    public $asal_pengadaan_name;

    
}