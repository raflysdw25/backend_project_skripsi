<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Peminjaman Request",
 *      description="Store Peminjaman Request body data",
 *      type="object",
 * )
 */

class StorePeminjamanRequest
{
    /**
     * @OA\Property(
     *      title="nim_mahasiswa",
     *      description="NIM Mahasiswa",
     *      example=""
     * )
     *
     * @var string
     */
    public $nim_mahasiswa;

    

    
}