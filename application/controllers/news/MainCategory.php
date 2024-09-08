<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MainCategory extends CI_Controller {
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
	
    public function mainCategoryNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(MAIN_CATEGORY_ALIAS, "can_add");
            if($isPermission){
                $this->load->view('header');
                $this->load->view('news/mainCategory/main_category_new');
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $mainCategorySlug = $this->input->post('main_category_slug');
                    $mainCategoryData = $this->DataModel->getData('main_category_slug = "'.$mainCategorySlug.'"', MAIN_CATEGORY_TABLE);
                    if($mainCategoryData !== null && isset($mainCategoryData['main_category_slug']) && $mainCategoryData['main_category_slug'] == $mainCategorySlug){
                        $this->session->set_userdata('session_main_category_new_main_category_slug', "$mainCategorySlug is already exits in database!");
                        redirect('new-main-category');
                    } else {
                        $newData = array(
                            'main_category_slug'=>$mainCategorySlug,
                            'main_category_name'=>$this->input->post('main_category_name'),
                            'main_category_show'=>$this->input->post('main_category_show'),
                            'main_category_status'=>$this->input->post('main_category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(MAIN_CATEGORY_TABLE, $newData);
                        if($newDataEntry){
                            redirect('view-main-category');  
                        }
                    }
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
    
    public function mainCategoryView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_main_category');
            }
            if(isset($_POST['submit_search'])){
                $searchMainCategory = $this->input->post('search_main_category');
                $this->session->set_userdata('session_main_category', $searchMainCategory);
            }
            $sessionMainCategory = $this->session->userdata('session_main_category');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_main_category_show');
                $this->session->unset_userdata('session_main_category_status');
                redirect('view-main-category');
            }
            
            $searchMainCategoryShow = $this->input->post('search_main_category_show');
            if($searchMainCategoryShow === 'true' or $searchMainCategoryShow == 'false'){
                $this->session->set_userdata('session_main_category_show', $searchMainCategoryShow);
            } else if($searchMainCategoryShow === 'all'){
                $this->session->unset_userdata('session_main_category_show');
            }
            $sessionMainCategoryShow = $this->session->userdata('session_main_category_show');
            
            
            $searchMainCategoryStatus = $this->input->post('search_main_category_status');
            if($searchMainCategoryStatus === 'publish' or $searchMainCategoryStatus == 'unpublish'){
                $this->session->set_userdata('session_main_category_status', $searchMainCategoryStatus);
            } else if($searchMainCategoryStatus === 'all'){
                $this->session->unset_userdata('session_main_category_status');
            }
            $sessionMainCategoryStatus = $this->session->userdata('session_main_category_status');
            
            $data = array();
            //get rows count
            $conditions['search_main_category'] = $sessionMainCategory;
            $conditions['search_main_category_show'] = $sessionMainCategoryShow;
            $conditions['search_main_category_status'] = $sessionMainCategoryStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewMainCategory($conditions, MAIN_CATEGORY_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-main-category');
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
            
            $mainCategory = $this->DataModel->viewMainCategory($conditions, MAIN_CATEGORY_TABLE);
            $data['countMainCategory'] = $this->DataModel->countMainCategory($conditions, MAIN_CATEGORY_TABLE);
            
            $data['viewMainCategory'] = array();
            if(is_array($mainCategory) || is_object($mainCategory)){
                foreach($mainCategory as $Row){
                    $dataArray = array();
                    $dataArray['main_category_id'] = $Row['main_category_id'];
                    $dataArray['main_category_slug'] = $Row['main_category_slug'];
                    $dataArray['main_category_name'] = $Row['main_category_name'];
                    $dataArray['main_category_show'] = $Row['main_category_show'];
                    $dataArray['main_category_status'] = $Row['main_category_status'];
                    $dataArray['countSubCategory'] = $this->DataModel->countData('main_category_id = '.$dataArray['main_category_id'], SUB_CATEGORY_TABLE);
                    array_push($data['viewMainCategory'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/mainCategory/main_category_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }

    public function mainCategoryEdit($mainCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(MAIN_CATEGORY_ALIAS, "can_edit");
            if($isPermission){
                $mainCategoryID = urlDecodes($mainCategoryID);
                if(ctype_digit($mainCategoryID)){
                    $data['mainCategoryData'] = $this->DataModel->getData('main_category_id = '.$mainCategoryID, MAIN_CATEGORY_TABLE);
                    if(!empty($data['mainCategoryData'])){
                        $this->load->view('header');
                        $this->load->view('news/mainCategory/main_category_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $mainCategorySlug = $this->input->post('main_category_slug');
                        $mainCategoryData = $this->DataModel->getData('main_category_slug = "'.$mainCategorySlug.'" And main_category_id != "'.$mainCategoryID.'"', MAIN_CATEGORY_TABLE);
                        if($mainCategoryData !== null && isset($mainCategoryData['main_category_slug']) && $mainCategoryData['main_category_slug'] == $mainCategorySlug){
                            $this->session->set_userdata('session_main_category_edit_main_category_slug', "$mainCategorySlug is already exits in database!");
                            redirect('edit-main-category/'.urlEncodes($mainCategoryID));
                        } else {
                            $editData = array(
                                'main_category_slug'=>$mainCategorySlug,
                                'main_category_name'=>$this->input->post('main_category_name'),
                                'main_category_show'=>$this->input->post('main_category_show'),
                                'main_category_status'=>$this->input->post('main_category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('main_category_id = '.$mainCategoryID, MAIN_CATEGORY_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-main-category');
                            }
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
    
    public function mainCategoryDelete($mainCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(MAIN_CATEGORY_ALIAS, "can_delete");
            if($isPermission){ 
                $mainCategoryID = urlDecodes($mainCategoryID);
                if(ctype_digit($mainCategoryID)){
                    $data['viewSubCategoryData'] = $this->DataModel->getData('main_category_id = '.$mainCategoryID, SUB_CATEGORY_TABLE);
                    if(!empty($data['viewSubCategoryData'])){
                        $this->session->set_userdata('session_main_category_delete', "You can't delete main category! Please delete sub category before deleting main category");
                        redirect($_SERVER['HTTP_REFERER']);
                    } else { 
                        $resultDataEntry = $this->DataModel->deleteData('main_category_id = '.$mainCategoryID, MAIN_CATEGORY_TABLE);
                        if($resultDataEntry){
                            redirect($_SERVER['HTTP_REFERER']);
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
}