<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store DetailAlat Request",
 *      description="Store DetailAlat Request body data",
 *      type="object",
 *      required={"jabatan_name"}
 * )
 */

class StoreDetailAlatRequest
{
    /**
     * @OA\Property(
     *      title="alat_id",
     *      description="Alat ID",
     * )
     *
     * @var integer
     */
    public $alat_id;

    /**
     * @OA\Property(
     *      title="lokasi_id",
     *      description="Lokasi ID",
     * )
     *
     * @var integer
     */
    public $lokasi_id;
    
    /**
     * @OA\Property(
     *      title="total_alat",
     *      description="Jumlah Alat",
     * )
     *
     * @var integer
     */
    public $total_alat;

    

    
}