<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="LokasiPenyimpanan",
     *      description="Lokasi Penyimpanan Model",
     *      @OA\Xml(
     *          name="Lokasi Penyimpanan" 
     *      )
     * 
     * )
     * 
     */

     class LokasiPenyimpanan{
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
         *      title="Lokasi Penyimpanan Name",
         *      description="Name of the new Lokasi Penyimpanan",
         *      example="Lemari A"
         * )
         *
         * @var string
         */
        private $lokasi_name;
        
        /**
         * @OA\Property(
         *      title="Total Capacity",
         *      description="Total Capacity of the new Lokasi Penyimpanan",
         *      example=100
         * )
         *
         * @var integer
         */
        private $total_capacity;
        
        /**
         * @OA\Property(
         *      title="Available Capacity",
         *      description="Available Capacity of the new Lokasi Penyimpanan",
         *      example=100
         * )
         *
         * @var integer
         */
        private $available_capacity;
        
        /**
         * @OA\Property(
         *      title="Store Capacity",
         *      description="Store Capacity of the new Lokasi Penyimpanan",
         *      example=100
         * )
         *
         * @var integer
         */
        private $stored_capacity;
        
        /**
         * @OA\Property(
         *      title="Path QR Code",
         *      description="Path QR Code of the new Lokasi Penyimpanan",
         * )
         *
         * @var string
         */
        private $path_qrcode;


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