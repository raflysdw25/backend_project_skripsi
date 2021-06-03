<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store User Request",
 *      description="Store User Request body data",
 *      type="object",
 *      required={"nip", "start_active_period", "end_active_period", "jabatan_id" },
 * )
 */

class StoreUserRequest
{
    /**
     * @OA\Property(
     *      title="nip",
     *      description="NIP User",
     *      example="12346789"
     * )
     *
     * @var string
     */
    public $nip;
    
    
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email User",
     *      example="exampla@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Start Active Period",
     *      description="User been activated",
     *      example="2020-01-27 17:50:45",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    private $start_active_period;
    /**
     * @OA\Property(
     *      title="End Active Period",
     *      description="User been activated",
     *      example="2020-01-27 17:50:45",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    private $end_active_period;
    
    
    /**
     * @OA\Property(
     *      title="jabatan_id",
     *      description="Jabatan ID User",
     * )
     *
     * @var integer
     */
    public $jabatan_id;

    

    
}