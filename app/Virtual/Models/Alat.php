<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Alat",
     *      description="Alat Model",
     *      @OA\Xml(
     *          name="Alat" 
     *      )
     * 
     * )
     * 
     */

     class Alat{
         /**
         * @OA\Property(
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $id;

        /**
         * @OA\Property(
         *      title="Alat Name",
         *      description="Name of the new Alat",
         *      example="Alat Test"
         * )
         *
         * @var string
         */
        private $alat_name;
        
        /**
         * @OA\Property(
         *      title="Jenis Alat Id",
         *      description="ID of the Jenis Alat",
         *      example=1
         * )
         *
         * @var integer
         */
        private $jenis_alat_id;
        
        /**
         * @OA\Property(
         *      title="Jenis Alat Model",
         *      description="Model of the Jenis Alat",
         * )
         *
         * @var App\Virtual\Models\JenisAlat
         */
        private $jenis_alat_model;
        
        /**
         * @OA\Property(
         *      title="Spek Alat",
         *      description="Spesification of the Alat",
         * )
         *
         * @var string
         */
        private $alat_specs;

        /**
         * @OA\Property(
         *      title="Asal Pengadaan Id",
         *      description="ID of the Asal Pengadaan",
         * )
         *
         * @var integer
         */
        private $asal_pengadaan_id;
        
        /**
         * @OA\Property(
         *      title="Asal Pengadaan Model",
         *      description="Model of the Asal Pengadaan",
         * )
         *
         * @var App\Virtual\Models\AsalPengadaan
         */
        private $asal_pengadaan_model;

        /**
         * @OA\Property(
         *      title="Alat Year",
         *      description="Year of the Alat",
         *      example="2021"
         * )
         *
         * @var string
         */
        private $alat_year;

        /**
         * @OA\Property(
         *      title="Supplier Id",
         *      description="ID of the Supplier",
         *      example=1
         * )
         *
         * @var integer
         */
        private $supplier_id;
        
        /**
         * @OA\Property(
         *      title="Supplier Model",
         *      description="Model of the Supplier",
         * )
         *
         * @var App\Virtual\Models\Supplier
         */
        private $supplier_model;

        /**
         * @OA\Property(
         *      title="Alat Total",
         *      description="Total of the Alat",
         *      example=1
         * )
         *
         * @var integer
         */
        private $alat_total;


        /**
         * @OA\Property(
         *      title="Created Date",
         *      description="Date of data been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $created_at;


        /**
         * @OA\Property(
         *     title="Updated at",
         *     description="Updated at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $updated_at;
       
        /**
         * @OA\Property(
         *     title="Deleted at",
         *     description="Deleted at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $deleted_at;
     }


?>