<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index(){
		$isLogin = checkAuth();
        if($isLogin == "True"){
            $data['mainCategoryCount'] = $this->DataModel->countData(null, MAIN_CATEGORY_TABLE);
            $data['mainCategoryPublishCount'] = $this->DataModel->countData('(main_category_status="publish")', MAIN_CATEGORY_TABLE);
            $data['mainCategoryUnpublishCount'] = $this->DataModel->countData('(main_category_status="unpublish")', MAIN_CATEGORY_TABLE);
            
            $data['subCategoryCount'] = $this->DataModel->countData(null, SUB_CATEGORY_TABLE);
            $data['subCategoryPublishCount'] = $this->DataModel->countData('(sub_category_status="publish")', SUB_CATEGORY_TABLE);
            $data['subCategoryUnpublishCount'] = $this->DataModel->countData('(sub_category_status="unpublish")', SUB_CATEGORY_TABLE);
            
            $data['blogCount'] = $this->DataModel->countData(null, BLOG_TABLE);
            $data['blogPublishCount'] = $this->DataModel->countData('(blog_status="publish")', BLOG_TABLE);
            $data['blogUnpublishCount'] = $this->DataModel->countData('(blog_status="unpublish")', BLOG_TABLE);
            
            $data['gameCount'] = $this->DataModel->countData(null, GAME_TABLE);
            $data['gamePublishCount'] = $this->DataModel->countData('(game_status="publish")', GAME_TABLE);
            $data['gameUnpublishCount'] = $this->DataModel->countData('(game_status="unpublish")', GAME_TABLE);
            
            $data['contactCount'] = $this->DataModel->countData(null, CONTACT_TABLE);
            $data['contactPublishCount'] = $this->DataModel->countData('(contact_status="publish")', CONTACT_TABLE);
            $data['contactUnpublishCount'] = $this->DataModel->countData('(contact_status="unpublish")', CONTACT_TABLE);
             
            $data['viewActiveLogin'] = $this->DataModel->viewData(null, '(is_login="True")', MASTER_USER_TABLE);
			$this->load->view('header');
			$this->load->view('index', $data);
			$this->load->view('footer');
        } else {
            redirect('logout');
        }
	}
	
	public function theme(){
		$isLogin = checkAuth();
        if($isLogin == "True"){
            if($this->session->userdata['theme_mode'] == "light"){
               	$this->session->set_userdata('theme_mode', "dark");
            } else {
                $this->session->set_userdata('theme_mode', "light");
            }
			redirect('dashboard');
        } else {
            redirect('logout');
        }
	}
}
