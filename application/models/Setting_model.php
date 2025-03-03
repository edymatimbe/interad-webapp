<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{

    function company()
    {
        return $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));
    }

    function get_user_id()
    {
        return $this->ion_auth->get_user_id();
    }

    public function get_billing($condition = null)
    {
        $this->db->select([
            'banner.title',
            'banner.path',
            'banner.video_duration',
            'banner.area_location',
            'banner.coordinates',
            'controller.status',
            'controller.cost',
            'controller.periodicity',
            'controller.init_date',
            'controller.final_date',
            'controller.multiplier',
            'controller.count_tax',
            'controller.code',
            'controller.created_at',
            'controller.id as controller_id',
            'banner.created_by as user_id' 
            
        ]);

        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }

        $this->db->join('banner', 'banner.id = controller.banner_id', 'LEFT');
        // $this->db->join('controller_tax', 'controller_tax.controller_id = controller.id', 'LEFT');
        // $this->db->where('banner.')
        $this->db->order_by('controller.id', 'DESC');
        return $this->db->get('controller')->result();
    }


    // public function campaign($condition = null)
    // {
    //     $this->db->select([
    //         'banner.title',
    //         'banner.path',
    //         'banner.video_duration',
    //         'banner.area_location',
    //         'controller.status',
    //         'controller.cost',
    //         'controller.periodicity',
    //         'controller.init_date',
    //         'controller.final_date',
    //         'controller.multiplier',
    //         'controller.code',
    //         'controller.id as controller_id',
    //         'banner.created_by as user_id',
    //         'controller_tax.location',
    //         'sum(controller_tax.views) as views',
    //         'sum(controller_tax.like) as likes',
    //         'sum(controller_tax.deslike) as deslikes'
    //     ]);

    //     if (is_array($condition) && $condition != null) {
    //         $this->db->where($condition);
    //     }

    //     $this->db->join('controller', 'controller.id = controller_tax.controller_id', 'LEFT');
    //     $this->db->join('tax', 'tax.id = controller_tax.tax_id', 'LEFT');
    //     $this->db->join('banner', 'banner.id = controller.banner_id', 'LEFT');
    //     $this->db->group_by('controller_tax.controller_id');
    //     return $this->db->get('controller_tax')->result();
    // }




   public function campaign($condition = null, $limit=null, $offset=null, $search=null)
    {
        $this->db->select([
            
            'banner.title',
            'banner.path',
            'banner.video_duration',
            'banner.area_location',
            'controller.status',
            'controller.cost',
            'controller.periodicity',
            'controller.init_date',
            'controller.final_date',
            'controller.multiplier',
            'controller.code',
            'controller.id as controller_id',
            'banner.created_by as user_id',
        ]);

        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }
        $this->db->where('controller.created_by', $this->ion_auth->get_user_id());
        $this->db->join('controller', 'controller.banner_id = banner.id', 'LEFT');


        if($search != null){
            $this->db->group_start();
			$this->db->like('banner.title', $search, 'both');
			$this->db->or_like('controller.code', $search, 'both');
			$this->db->or_like('controller.status', $search, 'both');
			// $this->db->or_like('product.description', $search, 'both');
			$this->db->group_end();
        }

      
        if($limit == null &&  $offset == null){
            return $this->db->get('banner')->result();
        }else{
            return $this->db->get('banner', $limit, $offset)->result();
        }
        
    }

    public function count_cards($condition = null, $search = null)
    {
        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }
        $this->db->where('controller.created_by', $this->ion_auth->get_user_id());
        $this->db->join('controller', 'controller.banner_id = banner.id', 'LEFT');
        
        if($search != null){
            $this->db->group_start();
			$this->db->like('banner.title', $search, 'both');
			$this->db->or_like('controller.code', $search, 'both');
			$this->db->or_like('controller.status', $search, 'both');
			// $this->db->or_like('product.description', $search, 'both');
			$this->db->group_end();
        }
        return $this->db->count_all('banner');
    }



    public function campaign_details($condition = null)
    {
        $this->db->select([
            
            'banner.title',
            'banner.path',
            'banner.video_duration',
            'banner.area_location',
            'controller.status',
            'controller.cost',
            'controller.periodicity',
            'controller.init_date',
            'controller.final_date',
            'controller.multiplier',
            'controller.code',
            'controller.id as controller_id',
            'banner.created_by as user_id',
            // 'controller_tax.location',
            // 'controller_tax.views',
            // 'sum(controller_tax.views) as views',
            // 'sum(controller_tax.like) as likes',
            // 'sum(controller_tax.deslike) as deslikes'
        ]);

        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }
        $this->db->where('controller.created_by', $this->ion_auth->get_user_id());
        $this->db->join('controller', 'controller.banner_id = banner.id', 'LEFT');

        // $this->db->join('controller_tax', 'controller_tax.controller_id = controller.id', 'LEFT');
        // // $this->db->join('tax', 'tax.id = controller_tax.tax_id', 'LEFT');
       
        // $this->db->group_by('controller_tax.controller_id');
        
        // $this->db->order_by('controller.id', 'DESC');
        return $this->db->get('banner')->row();
    }










    function controller_tax($condition = null){
        $this->db->select(['count(controller_tax.tax_id) as total_tax']);
        $this->db->select(['sum(controller_tax.like) as likes']);
        $this->db->select(['sum(controller_tax.deslike) as deslikes']);
        $this->db->select(['sum(controller_tax.views) as views']);

        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }
        
        return $this->db->get('controller_tax')->row();
    }


    public function get_tax($condition){
        $this->db->select([
            'tax.id as tax_id',
            'tax.name as own',
            'tax.registration',
            'tax.image',
            'brand.name as brand',
            'category.name as category'
        
        ]);
        
        if (is_array($condition) && $condition != null) {
            $this->db->where($condition);
        }

        $this->db->join('brand', 'brand.id = tax.brand_id', 'LEFT');
        $this->db->join('category', 'category.id = tax.category_id', 'LEFT');

        return $this->db->get('tax')->row();
    }


    
    function get_payment($condition = null)
    {
        $this->db->select(array(
            'payment.*',
            'controller.code',
            'controller.id as controller_id',
            'CONCAT(users.first_name, " ", users.last_name) AS customer',
            
          
            'payment_method.name as pay_method_name',
            'payment_method.id as pay_method',
            'payment_method.parent_id',
        ));
        $this->db->join('controller', 'controller.id = payment.controller_id', 'LEFT');
        $this->db->join('payment_method', 'payment_method.id = payment.method_id', 'LEFT');
        $this->db->join('users', 'users.id = payment.created_by', 'LEFT');
        if (is_array($condition)) {
            $this->db->where($condition);
        }
        $this->db->where('payment.active', 1);
        $this->db->order_by('payment.id', 'DESC');
        $result = $this->db->get('payment')->result();
        return $result;
    }

    
    
}
