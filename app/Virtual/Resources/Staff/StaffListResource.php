<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="StaffListResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="StaffListResource"
     *      ),
     * )
     * 
     */

    class StaffListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Staff Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Staff[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Staff Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>