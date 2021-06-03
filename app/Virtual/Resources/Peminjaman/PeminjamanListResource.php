<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="PeminjamanListResource",
     *      description="Peminjaman Resource",
     *      @OA\Xml(
     *          name="PeminjamanListResource"
     *      ),
     * )
     * 
     */

    class PeminjamanListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Peminjaman[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>