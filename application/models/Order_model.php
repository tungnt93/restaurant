<?php
Class Order_model extends MY_Model
{
    var $table = '_order';

    function get_order_undo($type){
        $sql = 'SELECT _order.*
				FROM _order
				INNER JOIN product
				ON _order.product_id = product.id
				WHERE product.type = '.$type.' AND (_order.status = 2 OR _order.status = 4) LIMIT 0,4';
        $result = $this->db->query($sql);
        return $result->result();
    }

    function get_order($type){
        $sql = 'SELECT _order.*
				FROM _order
				INNER JOIN product
				ON _order.product_id = product.id
				WHERE product.type = '.$type.' AND (_order.status = 1 OR _order.status = 3)';
        $result = $this->db->query($sql);
        return $result->result();
    }
}
