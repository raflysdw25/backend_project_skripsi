<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Ruangan",
     *      description="Ruangan Model",
     *      @OA\Xml(
     *          name="Ruangan" 
     *      )
     * 
     * )
     * 
     */

     class Ruangan{
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
         *      title="Ruangan Name",
         *      description="Name of the new ruangan",
         *      example="Teknik Manajemen"
         * )
         *
         * @var string
         */
        private $ruangan_name;


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