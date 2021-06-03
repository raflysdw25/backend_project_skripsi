<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LaporanKerusakanDetailResource",
     *      description="LaporanKerusakan Resource",
     *      @OA\Xml(
     *          name="AlatDetailResource"
     *      ),
     * )
     * 
     */

    class LaporanKerusakanDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response LaporanKerusakan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data LaporanKerusakan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\LaporanKerusakan[]
         * 
         */
        private $data;
        
    }
?>