<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AlatDetailResource",
     *      description="Alat Resource",
     *      @OA\Xml(
     *          name="AlatDetailResource"
     *      ),
     * )
     * 
     */

    class AlatDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Alat[]
         * 
         */
        private $data;
        
    }
?>