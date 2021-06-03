<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Jenis Alat Request",
 *      description="Store Jenis Alat Request body data",
 *      type="object",
 *      required={"jenis_name"}
 * )
 */

class StoreJenisAlatRequest
{
    /**
     * @OA\Property(
     *      title="jenis_name",
     *      description="Jenis Alat Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $jenis_name;
    
    /**
     * @OA\Property(
     *      title="spec_attributes",
     *      description="Jenis Alat Spesifikasi",
     *      example=""
     * )
     *
     * @var string
     */
    public $spec_attributes;

    

    
}