<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Asal Pengadaan Request",
 *      description="Store Asal Pengadaan Request body data",
 *      type="object",
 *      required={"asal_pengadaan_name"}
 * )
 */

class StoreAsalPengadaanRequest
{
    /**
     * @OA\Property(
     *      title="asal_pengadaan_name",
     *      description="Asal Pengadaan Name",
     * )
     *
     * @var string
     */
    public $asal_pengadaan_name;

    

    
}