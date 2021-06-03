<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Alat request",
 *      description="Filter Alat request body data",
 *      type="object",
 * )
 */

class FilterAlatRequest
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
     *      title="alat_name",
     *      description="Filter Alat Name",
     * )
     *
     * @var string
     */
    public $alat_name;
    
    /**
     * @OA\Property(
     *      title="jenis_alat_id",
     *      description="Filter Jenis Alat",
     * )
     *
     * @var integer
     */
    public $jenis_alat_id;
    
    /**
     * @OA\Property(
     *      title="asal_pengadaan_id",
     *      description="Filter Jenis Alat",
     * )
     *
     * @var integer
     */
    public $asal_pengadaan_id;

    /**
     * @OA\Property(
     *      title="alat_year",
     *      description="Filter Alat Year",
     * )
     *
     * @var string
     */
    public $alat_year;

    
}