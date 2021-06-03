<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Prodi Request",
 *      description="Store Prodi Request body data",
 *      type="object",
 *      required={"prodi_name"}
 * )
 */

class StoreProdiRequest
{
    /**
     * @OA\Property(
     *      title="prodi_name",
     *      description="Prodi Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $prodi_name;

    

    
}