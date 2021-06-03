<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Peminjaman request",
 *      description="Filter Peminjaman request body data",
 *      type="object",
 * )
 */

class FilterPeminjamanRequest
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
     *      title="created_at",
     *      description="Filter Waktu Peminjaman",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    public $created_at;
    
    /**
     * @OA\Property(
     *      title="expected_return_date",
     *      description="Filter Waktu Pengembalian",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    public $expected_return_date;
    
    /**
     * @OA\Property(
     *      title="nomor_induk",
     *      description="Filter Nomor Induk Peminjam",
     * )
     *
     * @var string
     */
    public $nomor_induk;
    
    /**
     * @OA\Property(
     *      title="pjm_status",
     *      description="Filter Status Peminjaman",
     * )
     *
     * @var integer
     */
    public $pjm_status;

    
}