<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Jenis Alat request",
 *      description="Filter Jenis Alat request body data",
 *      type="object",
 * )
 */

class FilterJenisAlatRequest
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
     *      title="jenis_name",
     *      description="Filter Jenis Alat Name",
     * )
     *
     * @var string
     */
    public $jenis_name;
    
    /**
     * @OA\Property(
     *      title="spec_attributes",
     *      description="Filter Jenis Alat Spek",
     * )
     *
     * @var string
     */
    public $spec_attributes;

    
}