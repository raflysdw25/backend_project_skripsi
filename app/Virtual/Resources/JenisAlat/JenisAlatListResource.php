<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JenisAlatListResource",
     *      description="JenisAlat Resource",
     *      @OA\Xml(
     *          name="JenisAlatListResource"
     *      ),
     * )
     * 
     */

    class JenisAlatListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Jenis Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\JenisAlat[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Jenis Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>