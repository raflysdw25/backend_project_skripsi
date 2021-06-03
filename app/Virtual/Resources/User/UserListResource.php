<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="UserListResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="UserListResource"
     *      ),
     * )
     * 
     */

    class UserListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Staff Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\User[]
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