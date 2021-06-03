<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LaporanKerusakanListResource",
     *      description="LaporanKerusakan Resource",
     *      @OA\Xml(
     *          name="AlatListResource"
     *      ),
     * )
     * 
     */

    class LaporanKerusakanListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result LaporanKerusakan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\LaporanKerusakan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page LaporanKerusakan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>