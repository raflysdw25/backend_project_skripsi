<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="RuanganDetailResource",
     *      description="Ruangan Resource",
     *      @OA\Xml(
     *          name="RuanganDetailResource"
     *      ),
     * )
     * 
     */

    class RuanganDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Ruangan[]
         * 
         */
        private $data;
        
    }
?>