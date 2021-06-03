<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AlatListResource",
     *      description="Alat Resource",
     *      @OA\Xml(
     *          name="AlatListResource"
     *      ),
     * )
     * 
     */

    class AlatListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Alat[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>