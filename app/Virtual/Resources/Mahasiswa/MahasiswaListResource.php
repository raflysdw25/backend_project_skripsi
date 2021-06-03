<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="MahasiswaListResource",
     *      description="Mahasiswa Resource",
     *      @OA\Xml(
     *          name="MahasiswaListResource"
     *      ),
     * )
     * 
     */

    class MahasiswaListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Mahasiswa Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Mahasiswa[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Mahasiswa Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>