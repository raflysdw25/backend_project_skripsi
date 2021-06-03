<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Supplier request",
 *      description="Filter Supplier request body data",
 *      type="object",
 * )
 */

class FilterSupplierRequest
{
    /**
     * @OA\Property(
     *      title="page_size",
     *      description="Page Size of Filter",
     *      example=5
     * )
     *
     * @var integer
     */
    public $page_size;

    /**
     * @OA\Property(
     *      title="sort_by",
     *      description="Sort Filter By Attributes",
     *      example="id"
     * )
     *
     * @var string
     */
    public $sort_by;
    
    /**
     * @OA\Property(
     *      title="sort_direction",
     *      description="Sort Direction of Filter",
     *      example="ASC"
     * )
     *
     * @var string
     */
    public $sort_direction;

    /**
     * @OA\Property(
     *      title="supplier_name",
     *      description="Filter supplier Name",
     * )
     *
     * @var string
     */
    public $supplier_name;
    
    
    /**
     * @OA\Property(
     *      title="supplier_address",
     *      description="Filter supplier Name",
     * )
     *
     * @var string
     */
    public $supplier_address;
    
    /**
     * @OA\Property(
     *      title="person_in_charge",
     *      description="Filter supplier person in charge",
     * )
     *
     * @var string
     */
    public $person_in_charge;

    
}