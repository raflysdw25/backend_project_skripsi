<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="RuanganListResource",
     *      description="Ruangan Resource",
     *      @OA\Xml(
     *          name="RuanganListResource"
     *      ),
     * )
     * 
     */

    class RuanganListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Ruangan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>