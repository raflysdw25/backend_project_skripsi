<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SupplierListResource",
     *      description="Supplier Resource",
     *      @OA\Xml(
     *          name="SupplierListResource"
     *      ),
     * )
     * 
     */

    class SupplierListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Supplier Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Supplier[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Supplier Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>