<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Mahasiswa request",
 *      description="Filter Mahasiswa request body data",
 *      type="object",
 * )
 */

class FilterMahasiswaRequest
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
     *      title="nim",
     *      description="Filter NIM",
     * )
     *
     * @var string
     */
    public $nim;
    
    /**
     * @OA\Property(
     *      title="mahasiswa_fullname",
     *      description="Filter Mahasiswa Fullname",
     * )
     *
     * @var string
     */
    public $mahasiswa_fullname;
    
    
    /**
     * @OA\Property(
     *      title="email",
     *      description="Filter Mahasiswa Email",
     * )
     *
     * @var string
     */
    public $email;
    
    /**
     * @OA\Property(
     *      title="prodi_id",
     *      description="Filter Mahasiswa Prodi Id",
     * )
     *
     * @var integer
     */
    public $prodi_id;

    
}