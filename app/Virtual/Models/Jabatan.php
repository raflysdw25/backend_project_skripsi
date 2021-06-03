<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Jabatan",
     *      description="Jabatan Model",
     *      @OA\Xml(
     *          name="Jabatan" 
     *      )
     * 
     * )
     * 
     */

     class Jabatan{
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
         *      title="Jabatan Name",
         *      description="Name of the new Jabatan",
         *      example="Kepala Lab"
         * )
         *
         * @var string
         */
        private $jabatan_name;


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