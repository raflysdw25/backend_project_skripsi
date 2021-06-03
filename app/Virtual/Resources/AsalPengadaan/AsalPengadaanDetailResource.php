<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AsalPengadaanDetailResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="AsalPengadaanDetailResource"
     *      ),
     * )
     * 
     */

    class AsalPengadaanDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\AsalPengadaan[]
         * 
         */
        private $data;
        
    }
?>