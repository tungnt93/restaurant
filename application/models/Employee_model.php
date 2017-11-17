<?php
Class Employee_model extends MY_Model
{
    var $table = 'employee';

    function get_employee_by_department($department_id){
        $sql = 'SELECT employee.*
				FROM employee
				INNER JOIN department
				ON employee.department_id=department.id
				WHERE department.parent_id ='.$department_id;
        $result = $this->db->query($sql);
        return $result->result();
    }
}