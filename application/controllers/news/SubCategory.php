<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory extends CI_Controller {
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
	
    public function subCategoryNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(SUB_CATEGORY_ALIAS, "can_add");
            if($isPermission){
                $data['mainCategoryData'] = $this->DataModel->viewData(null, null, MAIN_CATEGORY_TABLE);
                $this->load->view('header');
                $this->load->view('news/subCategory/sub_category_new', $data);
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $subCategorySlug = $this->input->post('sub_category_slug');
                    $subCategoryData = $this->DataModel->getData('sub_category_slug = "'.$subCategorySlug.'"', SUB_CATEGORY_TABLE);
                    if($subCategoryData !== null && isset($subCategoryData['sub_category_slug']) && $subCategoryData['sub_category_slug'] == $subCategorySlug){
                        $this->session->set_userdata('session_sub_category_new_sub_category_slug', "$subCategorySlug is already exits in database!");
                        redirect('new-sub-category');
                    } else {
                        $newData = array(
                            'main_category_id'=>$this->input->post('main_category_id'),
                            'sub_category_slug'=>$subCategorySlug,
                            'sub_category_name'=>$this->input->post('sub_category_name'),
                            'sub_category_status'=>$this->input->post('sub_category_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(SUB_CATEGORY_TABLE, $newData);
                        if($newDataEntry){
                            redirect('view-sub-category');  
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
    
    public function subCategoryView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_sub_category');
            }
            if(isset($_POST['submit_search'])){
                $searchSubCategory = $this->input->post('search_sub_category');
                $this->session->set_userdata('session_sub_category', $searchSubCategory);
            }
            $sessionSubCategory = $this->session->userdata('session_sub_category');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_sub_category_status');
                redirect('view-sub-category');
            }
            
            $searchSubCategoryStatus = $this->input->post('search_sub_category_status');
            if($searchSubCategoryStatus === 'publish' or $searchSubCategoryStatus == 'unpublish'){
                $this->session->set_userdata('session_sub_category_status', $searchSubCategoryStatus);
            } else if($searchSubCategoryStatus === 'all'){
                $this->session->unset_userdata('session_sub_category_status');
            }
            $sessionSubCategoryStatus = $this->session->userdata('session_sub_category_status');
            
            $data = array();
            //get rows count
            $conditions['search_sub_category'] = $sessionSubCategory;
            $conditions['search_sub_category_status'] = $sessionSubCategoryStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewSubCategory($conditions, SUB_CATEGORY_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-sub-category');
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
            
            $subCategory = $this->DataModel->viewSubCategory($conditions, SUB_CATEGORY_TABLE);
            $data['countSubCategory'] = $this->DataModel->countSubCategory($conditions, SUB_CATEGORY_TABLE);
            
            $data['viewSubCategory'] = array();
            if(is_array($subCategory) || is_object($subCategory)){
                foreach($subCategory as $Row){
                    $dataArray = array();
                    $dataArray['sub_category_id'] = $Row['sub_category_id'];
                    $dataArray['main_category_id'] = $Row['main_category_id'];
                    $dataArray['sub_category_slug'] = $Row['sub_category_slug'];
                    $dataArray['sub_category_name'] = $Row['sub_category_name'];
                    $dataArray['sub_category_status'] = $Row['sub_category_status'];
                    $dataArray['mainCategoryData'] = $this->DataModel->getData('main_category_id = '.$dataArray['main_category_id'], MAIN_CATEGORY_TABLE);
                    $dataArray['countBlog'] = $this->DataModel->countData('sub_category_id = '.$dataArray['sub_category_id'], BLOG_TABLE);
                    array_push($data['viewSubCategory'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/subCategory/sub_category_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }
    
    public function subCategoriesView($mainCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $mainCategoryID = urlDecodes($mainCategoryID);
            if(ctype_digit($mainCategoryID)){
                if(isset($_POST['reset_search'])){
                    $this->session->unset_userdata('session_sub_categories');
                }
                if(isset($_POST['submit_search'])){
                    $searchSubCategories = $this->input->post('search_sub_categories');
                    $this->session->set_userdata('session_sub_categories', $searchSubCategories);
                }
                $sessionSubCategories = $this->session->userdata('session_sub_categories');
                
                if(isset($_POST['reset_filter'])){
                    $this->session->unset_userdata('session_sub_categories_status');
                    redirect('view-sub-categories/'.urlEncodes($mainCategoryID));
                }
                
                $searchSubCategoriesStatus = $this->input->post('search_sub_categories_status');
                if($searchSubCategoriesStatus === 'publish' or $searchSubCategoriesStatus == 'unpublish'){
                    $this->session->set_userdata('session_sub_categories_status', $searchSubCategoriesStatus);
                } else if($searchSubCategoriesStatus === 'all'){
                    $this->session->unset_userdata('session_sub_categories_status');
                }
                $sessionSubCategoriesStatus = $this->session->userdata('session_sub_categories_status');
                
                $data = array();
                //get rows count
                $conditions['search_sub_categories'] = $sessionSubCategories;
                $conditions['search_sub_categories_status'] = $sessionSubCategoriesStatus;
                $conditions['returnType'] = 'count';
                
                $totalRec = $this->DataModel->viewSubCategories($conditions, $mainCategoryID, SUB_CATEGORY_TABLE);
        
                //pagination config
                $config['base_url']    = site_url('view-sub-categories/'.urlEncodes($mainCategoryID));
                $config['uri_segment'] = 3;
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
                $page = $this->uri->segment(3);
                $offset = !$page?0:$page;
                
                //get rows
                $conditions['returnType'] = '';
                $conditions['start'] = $offset;
                $conditions['limit'] = 10;
                
                $subCategories = $this->DataModel->viewSubCategories($conditions, $mainCategoryID, SUB_CATEGORY_TABLE);
                $data['countSubCategories'] = $this->DataModel->countSubCategories($conditions, $mainCategoryID, SUB_CATEGORY_TABLE);
                
                $data['viewSubCategories'] = array();
                if(is_array($subCategories) || is_object($subCategories)){
                    foreach($subCategories as $Row){
                        $dataArray = array();
                        $dataArray['sub_category_id'] = $Row['sub_category_id'];
                        $dataArray['main_category_id'] = $Row['main_category_id'];
                        $dataArray['sub_category_slug'] = $Row['sub_category_slug'];
                        $dataArray['sub_category_name'] = $Row['sub_category_name'];
                        $dataArray['sub_category_status'] = $Row['sub_category_status'];
                        $dataArray['mainCategoryData'] = $this->DataModel->getData('main_category_id = '.$dataArray['main_category_id'], MAIN_CATEGORY_TABLE);
                        $dataArray['countBlog'] = $this->DataModel->countData('sub_category_id = '.$dataArray['sub_category_id'], BLOG_TABLE);
                        array_push($data['viewSubCategories'], $dataArray);
                    }
                }
                $this->load->view('header');
                $this->load->view('news/subCategory/sub_categories_view', $data);
                $this->load->view('footer');
            } else {
                redirect('error');
            }
        } else {
            redirect('logout');
        }
    }

    public function subCategoryEdit($subCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(SUB_CATEGORY_ALIAS, "can_edit");
            if($isPermission){
                $subCategoryID = urlDecodes($subCategoryID);
                if(ctype_digit($subCategoryID)){
                    $data['subCategoryData'] = $this->DataModel->getData('sub_category_id = '.$subCategoryID, SUB_CATEGORY_TABLE);
                    
                    $data['viewMainCategory'] = $this->DataModel->viewData(null, null, MAIN_CATEGORY_TABLE);
                    $mainCategoryID = $data['subCategoryData']['main_category_id'];
                    $data['mainCategoryData'] = $this->DataModel->getData('main_category_id = '.$mainCategoryID, MAIN_CATEGORY_TABLE);
                    
                    if(!empty($data['subCategoryData'])){
                        $this->load->view('header');
                        $this->load->view('news/subCategory/sub_category_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $subCategorySlug = $this->input->post('sub_category_slug');
                        $subCategoryData = $this->DataModel->getData('sub_category_slug = "'.$subCategorySlug.'" And sub_category_id != "'.$subCategoryID.'"', SUB_CATEGORY_TABLE);
                        if($subCategoryData !== null && isset($subCategoryData['sub_category_slug']) && $subCategoryData['sub_category_slug'] == $subCategorySlug){
                            $this->session->set_userdata('session_sub_category_edit_sub_category_slug', "$subCategorySlug is already exits in database!");
                            redirect('edit-sub-category/'.urlEncodes($subCategoryID));
                        } else {
                            $editData = array(
                                'main_category_id'=>$this->input->post('main_category_id'),
                                'sub_category_slug'=>$subCategorySlug,
                                'sub_category_name'=>$this->input->post('sub_category_name'),
                                'sub_category_status'=>$this->input->post('sub_category_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('sub_category_id = '.$subCategoryID, SUB_CATEGORY_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-sub-category');
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
    
    public function subCategoryDelete($subCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(SUB_CATEGORY_ALIAS, "can_delete");
            if($isPermission){ 
                $subCategoryID = urlDecodes($subCategoryID);
                if(ctype_digit($subCategoryID)){
                    $data['viewBlogData'] = $this->DataModel->getData('sub_category_id = '.$subCategoryID, BLOG_TABLE);
                    if(!empty($data['viewBlogData'])){
                        $this->session->set_userdata('session_sub_category_delete', "You can't delete sub category! Please delete blog before deleting sub category");
                        redirect($_SERVER['HTTP_REFERER']);
                    } else { 
                        $resultDataEntry = $this->DataModel->deleteData('sub_category_id = '.$subCategoryID, SUB_CATEGORY_TABLE);
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