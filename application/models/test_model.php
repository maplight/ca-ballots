<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 7/21/16
 * Time: 11:24 AM
 */

class Test_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();

    }

    function get_last_ten_contributions()
    {
        $query = $this->db->get('contributions', 10);
        return $query->result();
    }


}