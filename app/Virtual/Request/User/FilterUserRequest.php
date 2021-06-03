<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter User request",
 *      description="Filter User request body data",
 *      type="object",
 * )
 */

class FilterUserRequest
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
     *      title="nip",
     *      description="Filter NIP",
     * )
     *
     * @var string
     */
    public $nip;
    
    
    
    /**
     * @OA\Property(
     *      title="jabatan_id",
     *      description="Filter Staff Prodi Id",
     * )
     *
     * @var integer
     */
    public $jabatan_id;

    
}