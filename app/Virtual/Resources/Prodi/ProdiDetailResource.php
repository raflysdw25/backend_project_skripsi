<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ProdiDetailResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="ProdiDetailResource"
     *      ),
     * )
     * 
     */

    class ProdiDetailResource{
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
         * @var \App\Virtual\Models\Prodi[]
         * 
         */
        private $data;
        
    }
?>