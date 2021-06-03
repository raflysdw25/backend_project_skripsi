<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LokasiPenyimpananDetailResource",
     *      description="Lokasi Penyimpanan Resource",
     *      @OA\Xml(
     *          name="LokasiPenyimpananDetailResource"
     *      ),
     * )
     * 
     */

    class LokasiPenyimpananDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\LokasiPenyimpanan[]
         * 
         */
        private $data;
        
    }
?>