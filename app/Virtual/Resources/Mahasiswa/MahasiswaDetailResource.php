<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="MahasiswaDetailResource",
     *      description="Mahasiswa Resource",
     *      @OA\Xml(
     *          name="MahasiswaDetailResource"
     *      ),
     * )
     * 
     */

    class MahasiswaDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Mahasiswa Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Mahasiswa Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Mahasiswa[]
         * 
         */
        private $data;
        
    }
?>