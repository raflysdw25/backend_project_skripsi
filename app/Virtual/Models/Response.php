<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Response",
     *      description="Response Model",
     *      @OA\Xml(
     *          name="Response" 
     *      )
     * 
     * )
     * 
     */

     class Response{
         /**
         * @OA\Property(
         *     title="Code",
         *     description="Code Response",
         *     format="int64",
         *     example=200
         * )
         *
         * @var integer
         */
         private $code;

         /**
         * @OA\Property(
         *     title="Status Response",
         *     description="Status Response",
         *     example="success"
         * )
         *
         * @var string
         */
         private $status;

        /**
         * @OA\Property(
         *     title="Message Response",
         *     description="Message Response",
         *     example="Response Berhasil"
         * )
         *
         * @var string
         */
        private $message;
     }


?>