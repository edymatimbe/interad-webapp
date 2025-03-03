<?php 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
/**
 * @package Contact :  CodeIgniter Multi Language Switcher
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Multi Language Switcher Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }

    // create language Switcher method
    public function index($language = "") { 
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);        
        redirect($_SERVER['HTTP_REFERER']);        
    }
}
