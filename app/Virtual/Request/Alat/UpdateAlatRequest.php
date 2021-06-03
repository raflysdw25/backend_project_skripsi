<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Update Alat Request",
 *      description="Update Alat Request body data",
 *      type="object",
 *      required={"alat_name"}
 * )
 */

class UpdateAlatRequest
{
    /**
     * @OA\Property(
     *      title="alat_name",
     *      description="Alat Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $alat_name;
    
    /**
     * @OA\Property(
     *      title="jenis_alat_id",
     *      description="Jenis Alat ID",
     *      example=1
     * )
     *
     * @var integer
     */
    public $jenis_alat_id;

    /**
     * @OA\Property(
     *      title="alat_specs",
     *      description="Alat Name",
     * )
     *
     * @var string
     */
    public $alat_specs;

    /**
     * @OA\Property(
     *      title="asal_pengadaan_id",
     *      description="Asal Pengadaan ID",
     *      example=1
     * )
     *
     * @var integer
     */
    public $asal_pengadaan_id;

    /**
     * @OA\Property(
     *      title="alat_year",
     *      description="Alat Year",
     * )
     *
     * @var string
     */
    public $alat_year;
    
    /**
     * @OA\Property(
     *      title="supplier_id",
     *      description="Supplier ID",
     *      example=1
     * )
     *
     * @var integer
     */
    public $supplier_id;    

    

    
}