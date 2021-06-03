<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JenisAlatDetailResource",
     *      description="Jenis Alat Resource",
     *      @OA\Xml(
     *          name="JenisAlatDetailResource"
     *      ),
     * )
     * 
     */

    class JenisAlatDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Jenis Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Jenis Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\JenisAlat[]
         * 
         */
        private $data;
        
    }
?>