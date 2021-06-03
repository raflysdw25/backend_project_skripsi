<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ImageAlatDetailResource",
     *      description="ImageAlat Resource",
     *      @OA\Xml(
     *          name="AlatDetailResource"
     *      ),
     * )
     * 
     */

    class ImageAlatDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response ImageAlat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data ImageAlat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\ImageAlat[]
         * 
         */
        private $data;
        
    }
?>