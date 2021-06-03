<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store LaporanKerusakan Request",
 *      description="Store LaporanKerusakan Request body data",
 *      type="object",
 *      required={"nomor_induk", "barcode_alat", "chronology"}
 * )
 */

class StoreLaporanKerusakanRequest
{
    /**
     * @OA\Property(
     *      title="nomor_induk",
     *      description="Nim Mahasiswa",
     * )
     *
     * @var string
     */
    public $nomor_induk;
    
    
    /**
     * @OA\Property(
     *      title="barcode_alat",
     *      description="Barcode Alat",
     * )
     *
     * @var string
     */
    public $barcode_alat;
    
    /**
     * @OA\Property(
     *      title="chronology",
     *      description="Kronologi",
     * )
     *
     * @var string
     */
    public $chronology;

    

    
}