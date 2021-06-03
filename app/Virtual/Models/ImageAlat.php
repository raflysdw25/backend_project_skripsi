<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="ImageAlat",
     *      description="ImageAlat Model",
     *      @OA\Xml(
     *          name="ImageAlat" 
     *      )
     * 
     * )
     * 
     */

     class ImageAlat{
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
         *      description="ID of Alat",
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
        private $alat_image_model;
        
        /**
         * @OA\Property(
         *      title="Image Data",
         *      description="Data of Image in base64 Format",
         * )
         *
         * @var string
         */
        private $image_data;

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