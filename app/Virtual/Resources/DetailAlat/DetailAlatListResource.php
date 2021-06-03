<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="DetailAlatListResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="DetailAlatListResource"
     *      ),
     * )
     * 
     */

    class DetailAlatListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result DetailAlat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\DetailAlat[]
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