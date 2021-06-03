<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Jabatan Request",
 *      description="Store Jabatan Request body data",
 *      type="object",
 *      required={"jabatan_name"}
 * )
 */

class StoreJabatanRequest
{
    /**
     * @OA\Property(
     *      title="jabatan_name",
     *      description="Jabatan Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $jabatan_name;

    

    
}