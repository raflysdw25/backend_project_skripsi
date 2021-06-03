<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LokasiPenyimpananListResource",
     *      description="Lokasi Penyimpanan Resource",
     *      @OA\Xml(
     *          name="LokasiPenyimpananListResource"
     *      ),
     * )
     * 
     */

    class LokasiPenyimpananListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\LokasiPenyimpanan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>