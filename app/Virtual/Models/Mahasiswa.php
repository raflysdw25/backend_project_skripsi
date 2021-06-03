<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Mahasiswa",
     *      description="Mahasiswa Model",
     *      @OA\Xml(
     *          name="Mahasiswa" 
     *      )
     * 
     * )
     * 
     */

     class Mahasiswa{
         /**
         * @OA\Property(
         *     title="NIM",
         *     description="Nomor Induk Mahasiswa",
         *     example="123456789"
         * )
         *
         * @var string
         */
        private $nim;

        /**
         * @OA\Property(
         *      title="Mahasiswa Name",
         *      description="Name of the Mahasiswa",
         *      example="Muhammad Rafly Sadewa"
         * )
         *
         * @var string
         */
        private $mahasiswa_fullname;
        
        /**
         * @OA\Property(
         *      title="Email",
         *      description="Email of the Mahasiswa",
         *      example="example@gmail.com"
         * )
         *
         * @var string
         */
        private $email;
        
        /**
         * @OA\Property(
         *      title="Phone Number",
         *      description="Phone Number of the Mahasiswa",
         *      example="081288131231"
         * )
         *
         * @var string
         */
        private $phone_number;
        
        /**
         * @OA\Property(
         *      title="Address",
         *      description="Address of the Mahasiswa",
         *      example="081288131231"
         * )
         *
         * @var string
         */
        private $address;
        
        /**
         * @OA\Property(
         *      title="Register Year",
         *      description="Register Year of the Mahasiswa",
         * )
         *
         * @var string
         */
        private $register_year;
        
        /**
         * @OA\Property(
         *      title="Prodi ID",
         *      description="Prodi ID of the Mahasiswa",
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