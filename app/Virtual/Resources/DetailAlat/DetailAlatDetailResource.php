<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="DetailAlatDetailResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="DetailAlatDetailResource"
     *      ),
     * )
     * 
     */

    class DetailAlatDetailResource{
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
         * @var \App\Virtual\Models\DetailAlat[]
         * 
         */
        private $data;
        
    }
?>