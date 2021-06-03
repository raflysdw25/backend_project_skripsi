<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ProdiListResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="ProdiListResource"
     *      ),
     * )
     * 
     */

    class ProdiListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Prodi[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>