<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AsalPengadaanListResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="AsalPengadaanListResource"
     *      ),
     * )
     * 
     */

    class AsalPengadaanListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result AsalPengadaan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\AsalPengadaan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Asal Pengadaan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>