<?php

use Entity\User;

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 5/12/2019
 * Time: 3:47 AM
 */
class PageModel extends CI_Model
{
    public function __construct()
    {

    }

    public function insert_contact_us($data)
    {
        $this->db->insert('contact_us',$data);
    }

    public function deleterecord($id){
        foreach($id as $page_id){
            $this->db->delete('pages', array('id' => $page_id));
        }
    }
}