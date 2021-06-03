<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Page",
     *      description="Page Model",
     *      @OA\Xml(
     *          name="Page" 
     *      )
     * 
     * )
     * 
     */

     class Page{
         /**
         * @OA\Property(
         *     title="Current",
         *     description="Current Page",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
         private $current;

         /**
         * @OA\Property(
         *     title="Total Page",
         *     description="Total Page",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
         private $total;

         /**
         * @OA\Property(
         *     title="Size Page",
         *     description="Total Data display in Page",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
         private $size;

         /**
         * @OA\Property(
         *     title="Data Total",
         *     description="Total Data store in system",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
         private $data_total;
     }


?>