<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Ruangan Request",
 *      description="Store Ruangan Request body data",
 *      type="object",
 *      required={"ruangan_name"}
 * )
 */

class StoreRuanganRequest
{
    /**
     * @OA\Property(
     *      title="ruangan_name",
     *      description="Ruangan Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $ruangan_name;
    
}