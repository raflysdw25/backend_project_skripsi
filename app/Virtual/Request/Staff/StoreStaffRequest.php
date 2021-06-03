<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Staff Request",
 *      description="Store Staff Request body data",
 *      type="object",
 *      required={"nip", "staff_fullname", "email", "phone_number"},
 * )
 */

class StoreStaffRequest
{
    /**
     * @OA\Property(
     *      title="nip",
     *      description="NIP Staff",
     *      example="12346789"
     * )
     *
     * @var string
     */
    public $nip;
    
    /**
     * @OA\Property(
     *      title="staff_fullname",
     *      description="Fullname Staff",
     *      example="Staff Nama"
     * )
     *
     * @var string
     */
    public $staff_fullname;
    
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email Staff",
     *      example="exampla@gmail.com"
     * )
     *
     * @var string
     */
    public $email;
    
    /**
     * @OA\Property(
     *      title="phone_number",
     *      description="Phone Number Staff",
     *      example="08118921013"
     * )
     *
     * @var string
     */
    public $phone_number;
    
    /**
     * @OA\Property(
     *      title="address",
     *      description="Address Staff",
     *      example=""
     * )
     *
     * @var string
     */
    public $address;
    
    /**
     * @OA\Property(
     *      title="prodi_id",
     *      description="Prodi ID Staff",
     *      
     * )
     *
     * @var integer
     */
    public $prodi_id;

    

    
}