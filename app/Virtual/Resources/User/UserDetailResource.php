<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="UserDetailResource",
     *      description="User Resource",
     *      @OA\Xml(
     *          name="UserDetailResource"
     *      ),
     * )
     * 
     */

    class UserDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Staff Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\User[]
         * 
         */
        private $data;
        
    }
?>