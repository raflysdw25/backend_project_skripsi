<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Staff",
     *      description="Staff Model",
     *      @OA\Xml(
     *          name="Staff" 
     *      )
     * 
     * )
     * 
     */

     class Staff{
         /**
         * @OA\Property(
         *     title="NIP",
         *     description="Nomor Induk Pegawai Staff",
         *     example="123456789"
         * )
         *
         * @var string
         */
        private $nip;

        /**
         * @OA\Property(
         *      title="Staff Name",
         *      description="Name of the Staff",
         *      example="Muhammad Rafly Sadewa"
         * )
         *
         * @var string
         */
        private $staff_fullname;
        
        /**
         * @OA\Property(
         *      title="Email",
         *      description="Email of the Staff",
         *      example="example@gmail.com"
         * )
         *
         * @var string
         */
        private $email;
        
        /**
         * @OA\Property(
         *      title="Phone Number",
         *      description="Phone Number of the Staff",
         *      example="081288131231"
         * )
         *
         * @var string
         */
        private $phone_number;
        
        /**
         * @OA\Property(
         *      title="Address",
         *      description="Address of the Staff",
         *      example="081288131231"
         * )
         *
         * @var string
         */
        private $address;
        
        /**
         * @OA\Property(
         *      title="Prodi ID",
         *      description="Prodi ID of the Staff",
         * )
         *
         * @var integer
         */
        private $prodi_id;
        
        
        /**
         * @OA\Property(
         *      title="Prodi Model",
         *      description="Prodi Model",
         * )
         * 
         * @var \App\Virtual\Models\Prodi
         * 
         */
        private $prodi_model;


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