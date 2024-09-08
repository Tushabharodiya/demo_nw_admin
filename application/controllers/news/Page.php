<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
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
	
    public function pageNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(PAGE_ALIAS, "can_add");
            if($isPermission){
                $this->load->view('header');
                $this->load->view('news/page/page_new');
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $newData = array(
                        'page_about'=>$this->input->post('page_about'),
                        'page_privacy'=>$this->input->post('page_privacy'),
                        'page_terms'=>$this->input->post('page_terms'),
                    );
                    $newDataEntry = $this->DataModel->insertData(PAGE_TABLE, $newData);
                    if($newDataEntry){
                        redirect('view-page');  
                    }
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
    
    public function pageView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_page');
            }
            if(isset($_POST['submit_search'])){
                $searchPage = $this->input->post('search_page');
                $this->session->set_userdata('session_page', $searchPage);
            }
            $sessionPage = $this->session->userdata('session_page');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_page_status');
                redirect('view-page');
            }
            
            $searchPageStatus = $this->input->post('search_page_status');
            if($searchPageStatus === 'publish' or $searchPageStatus == 'unpublish'){
                $this->session->set_userdata('session_page_status', $searchPageStatus);
            } else if($searchPageStatus === 'all'){
                $this->session->unset_userdata('session_page_status');
            }
            $sessionPageStatus = $this->session->userdata('session_page_status');
            
            $data = array();
            //get rows count
            $conditions['search_page'] = $sessionPage;
            $conditions['search_page_status'] = $sessionPageStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewPage($conditions, PAGE_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-page');
            $config['uri_segment'] = 2;
            $config['total_rows']  = $totalRec;
            $config['per_page']    = 10;
            
            //styling
            $config['num_tag_open'] = '<li class="page-item page-link">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active page-item"><a href="javascript:void(0);" class="page-link" >';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_link'] = '&raquo';
            $config['prev_link'] = '&laquo';
            $config['next_tag_open'] = '<li class="pg-next page-item page-link">';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="pg-prev page-item page-link">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="page-item page-link">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item page-link">';
            $config['last_tag_close'] = '</li>';
            
            //initialize pagination library
            $this->pagination->initialize($config);
            
            //define offset
            $page = $this->uri->segment(2);
            $offset = !$page?0:$page;
            
            //get rows
            $conditions['returnType'] = '';
            $conditions['start'] = $offset;
            $conditions['limit'] = 10;
            
            $page = $this->DataModel->viewPage($conditions, PAGE_TABLE);
            $data['countPage'] = $this->DataModel->countPage($conditions, PAGE_TABLE);
            
            $data['viewPage'] = array();
            if(is_array($page) || is_object($page)){
                foreach($page as $Row){
                    $dataArray = array();
                    $dataArray['page_id'] = $Row['page_id'];
                    $dataArray['page_about'] = $Row['page_about'];
                    $dataArray['page_privacy'] = $Row['page_privacy'];
                    $dataArray['page_terms'] = $Row['page_terms'];
                    $dataArray['page_status'] = $Row['page_status'];
                    array_push($data['viewPage'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/page/page_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }

    public function pageEdit($pageID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(PAGE_ALIAS, "can_edit");
            if($isPermission){
                $pageID = urlDecodes($pageID);
                if(ctype_digit($pageID)){
                    $data['pageData'] = $this->DataModel->getData('page_id = '.$pageID, PAGE_TABLE);
                    if(!empty($data['pageData'])){
                        $this->load->view('header');
                        $this->load->view('news/page/page_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $editData = array(
                            'page_about'=>$this->input->post('page_about'),
                            'page_privacy'=>$this->input->post('page_privacy'),
                            'page_terms'=>$this->input->post('page_terms'),
                            'page_status'=>$this->input->post('page_status'),
                        );
                        $editDataEntry = $this->DataModel->editData('page_id = '.$pageID, PAGE_TABLE, $editData);
                        if($editDataEntry){
                            redirect('view-page');
                        }
                    }
                } else {
                    redirect('error');
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
    
    public function pageDelete($pageID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(PAGE_ALIAS, "can_delete");
            if($isPermission){ 
                $pageID = urlDecodes($pageID);
                if(ctype_digit($pageID)){
                    $resultDataEntry = $this->DataModel->deleteData('page_id = '.$pageID, PAGE_TABLE);
                    if($resultDataEntry){
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    redirect('error');
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
}