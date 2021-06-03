<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="DetailAlat",
     *      description="Detail Alat Model",
     *      @OA\Xml(
     *          name="DetailAlat" 
     *      )
     * 
     * )
     * 
     */

     class DetailAlat{
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
         *      title="Alat ID",
         *      description="ID of the Alat",
         *      example=1
         * )
         *
         * @var integer
         */
        private $alat_id;
        
        /**
         * @OA\Property(
         *      title="Alat Model",
         *      description="Model of Alat",
         * )
         *
         * @var App\Virtual\Models\Alat
         */
        private $alat_model;
        
        /**
         * @OA\Property(
         *      title="Barcode Alat",
         *      description="Barcode Alat",
         *      example="ABC123"
         * )
         *
         * @var string
         */
        private $barcode_alat;

        /**
         * @OA\Property(
         *      title="Condition Status",
         *      description="Condition Status",
         *      example=1
         * )
         *
         * @var integer
         */
        private $condition_status;
        
        /**
         * @OA\Property(
         *      title="Available Status",
         *      description="Available Status",
         *      example=1
         * )
         *
         * @var integer
         */
        private $available_status;

        /**
         * @OA\Property(
         *      title="Lokasi ID",
         *      description="ID of the Lokasi",
         *      example=1
         * )
         *
         * @var integer
         */
        private $lokasi_id;
        
        /**
         * @OA\Property(
         *      title="Lokasi Model",
         *      description="Model of Lokasi",
         * )
         *
         * @var App\Virtual\Models\LokasiPenyimpanan
         */
        private $lokasi_model;
        

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