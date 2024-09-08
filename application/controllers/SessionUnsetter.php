<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SessionUnsetter extends CI_Controller {
    function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('auth_key') != AUTH_KEY){ 
            redirect('login');
        }
	}
	
	public function index(){
        $this->load->view('header');
        $this->load->view('error');
        $this->load->view('footer');
    }
	
	public function unsetSession(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $this->session->unset_userdata('session_main_category');
            $this->session->unset_userdata('session_main_category_show');
            $this->session->unset_userdata('session_main_category_status');
            
            $this->session->unset_userdata('session_sub_category');
            $this->session->unset_userdata('session_sub_category_status');
            
            $this->session->unset_userdata('session_sub_categories');
            $this->session->unset_userdata('session_sub_categories_status');
            
            $this->session->unset_userdata('session_blog');
            $this->session->unset_userdata('session_blog_index');
            $this->session->unset_userdata('session_blog_follow');
            $this->session->unset_userdata('session_blog_status');
            
            $this->session->unset_userdata('session_game');
            $this->session->unset_userdata('session_game_status');
            
            $this->session->unset_userdata('session_blogs');
            $this->session->unset_userdata('session_blogs_index');
            $this->session->unset_userdata('session_blogs_follow');
            $this->session->unset_userdata('session_blogs_status');
            
            $this->session->unset_userdata('session_page');
            $this->session->unset_userdata('session_page_status');
            
            $this->session->unset_userdata('session_contact');
            $this->session->unset_userdata('session_contact_status');

            redirect('dashboard');
        } else {
            redirect('logout');
        }
    }
    
}