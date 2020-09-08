<?php 

class Order
{

    protected $_quantity;
    protected $_size;
    public $_product_id;
    public function __construct($product_id,$quantity,$size){
    $this->_product_id=$product_id;
    $this->_quantity=$quantity;
    $this->_size=$size;
    }

}

?>