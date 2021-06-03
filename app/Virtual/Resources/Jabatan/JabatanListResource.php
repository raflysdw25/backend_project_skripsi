<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JabatanListResource",
     *      description="Jabatan Resource",
     *      @OA\Xml(
     *          name="JabatanListResource"
     *      ),
     * )
     * 
     */

    class JabatanListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Jabatan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Jabatan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Jabatan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>