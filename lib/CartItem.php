<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/27/18
 * Time: 9:34 AM
 */

class CartItem
{
    public $productId = 0;
    public $count = 0;
    public $amount = 0;
    public $cost = 0.0;

    function __construct($productId, $count, $amount, $cost)
    {
        $this->productId = $productId;
        $this->count = $count;
        $this->amount = $amount;
        $this->cost = $cost;
    }

    function  toUrlParams()
    {
        return "productId=$this->productId,count=$this->count,amount=$this->amount,cost=$this->cost";
    }

}