<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Laporan Kerusakan request",
 *      description="Filter Laporan Kerusakan request body data",
 *      type="object",
 * )
 */

class FilterLaporanKerusakanRequest
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
     *      title="report_date",
     *      description="Filter Tanggal Pelaporan",
     * )
     *
     * @var \DateTime
     */
    public $report_date;
    
    /**
     * @OA\Property(
     *      title="nomor_induk",
     *      description="Filter Nomor Induk",
     * )
     *
     * @var string
     */
    public $nomor_induk;
    
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
     *      title="chronology",
     *      description="Filter Kronologi",
     * )
     *
     * @var string
     */
    public $chronology;
    
    /**
     * @OA\Property(
     *      title="report_status",
     *      description="Filter Status Laporan",
     * )
     *
     * @var integer
     */
    public $report_status;

    
}