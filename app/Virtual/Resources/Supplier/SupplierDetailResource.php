<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SupplierDetailResource",
     *      description="Supplier Resource",
     *      @OA\Xml(
     *          name="SupplierDetailResource"
     *      ),
     * )
     * 
     */

    class SupplierDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Supplier Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Supplier Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Supplier[]
         * 
         */
        private $data;
        
    }
?>