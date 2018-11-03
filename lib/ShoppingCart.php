<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/27/18
 * Time: 9:24 AM
 */

include_once 'CartItem.php';

define('SHOPPING_CART',"ShoppingCart");

class ShoppingCart
{
    private $cartList = array();

    function __construct()
    {

    }

    function push(CartItem $item)
    {
        array_push($this->cartList,$item);
    }

    function pop()
    {
        if(count($this->cartList) > 0)
        {
            $ret = $this->cartList[count($this->cartList) - 1];
            array_pop($this->cartList);
            return $ret;
        }
        return null;
    }

    function clear()
    {
        $this->cartList = array();
    }

    function deleteItem($index)
    {
        if(count($this->cartList) > $index)
        {
            unset($this->cartList, $index);
        }
    }

    function getCartItems()
    {
        return $this->cartList;
    }

    function isEmpty()
    {
        return count($this->cartList) == 0;
    }
}