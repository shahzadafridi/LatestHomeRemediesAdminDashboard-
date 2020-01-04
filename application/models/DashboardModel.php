<?php

class DashboardModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        
    }

    /*Number of User Count */
    public function numberofusers(){
        $numberofusers = $this->db->count_all_results('users');
    return $numberofusers; 
    }

    /*Number of Categories Count */
    public function numberofcategories(){
        $numberofcategories = $this->db->count_all_results('categories');
        return $numberofcategories;
    }

    /*Number of Categories Count */
    public function numberofsubcategories(){
        $numberofsubcategories = $this->db->count_all_results('sub_categories');
        return $numberofsubcategories;
    }

    /*Number of Blogs Count */
    public function numberofblogs(){
        $numberofblogs = $this->db->count_all_results('blogs');
    return $numberofblogs;
    }

    /*Number of Remedies Count */
    public function numberofremedies(){
        $numberofremedies = $this->db->count_all_results('remedies');
    return $numberofremedies;
    }

    /*Number of Health Tips Count */
    public function numberofrtips(){
        $numberoftips = $this->db->count_all_results('health_tips');
        return $numberoftips;
    }

    /*Number of Health Tips Count */
    public function numberofVideos()
    {
        $numberoftips = $this->db->count_all_results('videos');
        return $numberoftips;

    }
        /*Visitor Count Store In database */
    // public function updatesitorcount(){
    //     $this->db->where('id','1');
    //     $this->db->select('visitor_count');
    //     $count = $this->db->get('visitor')->row();

    //     $this->db->where('id', '1');
    //     $this->db->set('visitor_count', ($count->visitor_count + 1));
    //     $this->db->update('visitor');
    // }
}