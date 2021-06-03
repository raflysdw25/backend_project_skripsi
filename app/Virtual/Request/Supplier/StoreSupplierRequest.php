<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Supplier Request",
 *      description="Store Supplier Request body data",
 *      type="object",
 *      required={"supplier_name", "supplier_phone", "person_in_charge"}
 * )
 */

class StoreSupplierRequest
{
    /**
     * @OA\Property(
     *      title="supplier_name",
     *      description="Supplier Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $supplier_name;
    
    /**
     * @OA\Property(
     *      title="supplier_phone",
     *      description="Supplier Phone",
     *      example=""
     * )
     *
     * @var string
     */
    public $supplier_phone;
    
    /**
     * @OA\Property(
     *      title="person_in_charge",
     *      description="Person In Charge",
     *      example=""
     * )
     *
     * @var string
     */
    public $person_in_charge;
    
    /**
     * @OA\Property(
     *      title="supplier_email",
     *      description="Supplier email",
     *      example=""
     * )
     *
     * @var string
     */
    public $supplier_email;
    
    
    /**
     * @OA\Property(
     *      title="supplier_address",
     *      description="Supplier address",
     *      example=""
     * )
     *
     * @var string
     */
    public $supplier_address;

    

    
}