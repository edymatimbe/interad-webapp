<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
/**
 * @package Contact :  CodeIgniter Multi Language Loader
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Multi Language Loader Hook
 */

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        // load language helper
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            // difine all language files
            $ci->lang->load('general',$siteLang);
            $ci->lang->load('home',$siteLang);
            $ci->lang->load('sidebar',$siteLang);
            $ci->lang->load('cart',$siteLang);
            $ci->lang->load('form_validation',$siteLang);
        } else {
            // default language files
            $ci->lang->load('general','portuguese');
            $ci->lang->load('home','portuguese');
            $ci->lang->load('home','portuguese');
            $ci->lang->load('sidebar','portuguese');
            $ci->lang->load('cart','portuguese');
			$ci->lang->load('form_validation','portuguese');
		}
    }
}
