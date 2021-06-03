<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="PeminjamanDetailResource",
     *      description="Peminjaman Resource",
     *      @OA\Xml(
     *          name="PeminjamanDetailResource"
     *      ),
     * )
     * 
     */

    class PeminjamanDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Peminjaman[]
         * 
         */
        private $data;
        
    }
?>