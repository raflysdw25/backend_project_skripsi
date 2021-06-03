<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ImageAlatListResource",
     *      description="ImageAlat Resource",
     *      @OA\Xml(
     *          name="AlatListResource"
     *      ),
     * )
     * 
     */

    class ImageAlatListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result ImageAlat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\ImageAlat[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Image Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>