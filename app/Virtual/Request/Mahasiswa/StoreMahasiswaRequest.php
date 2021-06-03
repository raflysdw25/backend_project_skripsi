<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Mahasiswa Request",
 *      description="Store Mahasiswa Request body data",
 *      type="object",
 *      required={"nim", "mahasiswa_fullname", "email", "phone_number"},
 * )
 */

class StoreMahasiswaRequest
{
    /**
     * @OA\Property(
     *      title="nim",
     *      description="NIM Mahasiswa",
     *      example="12346789"
     * )
     *
     * @var string
     */
    public $nim;
    
    /**
     * @OA\Property(
     *      title="mahasiswa_fullname",
     *      description="Fullname Mahasiswa",
     *      example="Mahasiswa Nama"
     * )
     *
     * @var string
     */
    public $mahasiswa_fullname;
    
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email Mahasiswa",
     *      example="exampla@gmail.com"
     * )
     *
     * @var string
     */
    public $email;
    
    /**
     * @OA\Property(
     *      title="phone_number",
     *      description="Phone Number Mahasiswa",
     *      example="08118921013"
     * )
     *
     * @var string
     */
    public $phone_number;
    
    /**
     * @OA\Property(
     *      title="register_year",
     *      description="Register Year Mahasiswa",
     *      example="2017"
     * )
     *
     * @var string
     */
    public $register_year;
    
    /**
     * @OA\Property(
     *      title="address",
     *      description="Address Mahasiswa",
     *      example=""
     * )
     *
     * @var string
     */
    public $address;
    
    /**
     * @OA\Property(
     *      title="prodi_id",
     *      description="Prodi ID Mahasiswa",
     *      
     * )
     *
     * @var integer
     */
    public $prodi_id;

    

    
}