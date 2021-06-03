<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Supplier",
     *      description="Supplier Model",
     *      @OA\Xml(
     *          name="Supplier" 
     *      )
     * 
     * )
     * 
     */

     class Supplier{
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
         *      title="Supplier Name",
         *      description="Name of the new supplier",
         *      example="PT. A"
         * )
         *
         * @var string
         */
        private $supplier_name;
        
        
        /**
         * @OA\Property(
         *      title="Supplier phone",
         *      description="Phone of the new supplier",
         *      example="08121888090190"
         * )
         *
         * @var string
         */
        private $supplier_phone;
        
        /**
         * @OA\Property(
         *      title="Person In Charge",
         *      description="PIC of the new supplier",
         *      example="PIC A"
         * )
         *
         * @var string
         */
        private $person_in_charge;

        /**
         * @OA\Property(
         *      title="Supplier email",
         *      description="Email of the new supplier",
         *      example="example@gmail.com"
         * )
         *
         * @var string
         */
        private $supplier_email;
        
        /**
         * @OA\Property(
         *      title="Supplier address",
         *      description="Address of the new supplier",
         *      example="Jl. Supplier A"
         * )
         *
         * @var string
         */
        private $supplier_address;


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