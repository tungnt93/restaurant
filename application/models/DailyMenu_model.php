<?php
Class DailyMenu_model extends MY_Model
{
    var $table = 'daily_menu';

    function get_daily_menu($date){
        $sql = 'SELECT daily_menu.*, product.*
				FROM daily_menu
				INNER JOIN product
				ON daily_menu.product_id = product.id
				WHERE daily_menu.date = "'.$date.'"
				ORDER BY catalog_id';
//        pre($sql);
        $result = $this->db->query($sql);
        return $result->result();
    }
}