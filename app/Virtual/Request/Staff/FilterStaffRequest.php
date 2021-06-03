<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Staff request",
 *      description="Filter Staff request body data",
 *      type="object",
 * )
 */

class FilterStaffRequest
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
     *      example="created_at"
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
     *      title="staff_fullname",
     *      description="Filter Staff Fullname",
     * )
     *
     * @var string
     */
    public $staff_fullname;
    
    
    /**
     * @OA\Property(
     *      title="email",
     *      description="Filter Staff Email",
     * )
     *
     * @var string
     */
    public $email;
    
    /**
     * @OA\Property(
     *      title="prodi_id",
     *      description="Filter Staff Prodi Id",
     * )
     *
     * @var integer
     */
    public $prodi_id;

    
}