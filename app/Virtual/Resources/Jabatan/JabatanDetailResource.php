<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JabatanDetailResource",
     *      description="Jabatan Resource",
     *      @OA\Xml(
     *          name="JabatanDetailResource"
     *      ),
     * )
     * 
     */

    class JabatanDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Jabatan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Jabatan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Jabatan[]
         * 
         */
        private $data;
        
    }
?>