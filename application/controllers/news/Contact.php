<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
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
	
    public function contactNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(CONTACT_ALIAS, "can_add");
            if($isPermission){
                $this->load->view('header');
                $this->load->view('news/contact/contact_new');
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $newData = array(
                        'contact_name'=>$this->input->post('contact_name'),
                        'contact_email'=>$this->input->post('contact_email'),
                        'contact_message'=>$this->input->post('contact_message'),
                        'contact_date'=>todayDate(),
                        'contact_status'=>$this->input->post('contact_status'),
                    );
                    $newDataEntry = $this->DataModel->insertData(CONTACT_TABLE, $newData);
                    if($newDataEntry){
                        redirect('view-contact');  
                    }
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
    
    public function contactView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_contact');
            }
            if(isset($_POST['submit_search'])){
                $searchContact = $this->input->post('search_contact');
                $this->session->set_userdata('session_contact', $searchContact);
            }
            $sessionContact = $this->session->userdata('session_contact');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_contact_status');
                redirect('view-contact');
            }
            
            $searchContactStatus = $this->input->post('search_contact_status');
            if($searchContactStatus === 'publish' or $searchContactStatus == 'unpublish'){
                $this->session->set_userdata('session_contact_status', $searchContactStatus);
            } else if($searchContactStatus === 'all'){
                $this->session->unset_userdata('session_contact_status');
            }
            $sessionContactStatus = $this->session->userdata('session_contact_status');
            
            $data = array();
            //get rows count
            $conditions['search_contact'] = $sessionContact;
            $conditions['search_contact_status'] = $sessionContactStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewContact($conditions, CONTACT_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-contact');
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
            
            $contact = $this->DataModel->viewContact($conditions, CONTACT_TABLE);
            $data['countContact'] = $this->DataModel->countContact($conditions, CONTACT_TABLE);
            
            $data['viewContact'] = array();
            if(is_array($contact) || is_object($contact)){
                foreach($contact as $Row){
                    $dataArray = array();
                    $dataArray['contact_id'] = $Row['contact_id'];
                    $dataArray['contact_name'] = $Row['contact_name'];
                    $dataArray['contact_email'] = $Row['contact_email'];
                    $dataArray['contact_message'] = $Row['contact_message'];
                    $dataArray['contact_date'] = $Row['contact_date'];
                    $dataArray['contact_status'] = $Row['contact_status'];
                    array_push($data['viewContact'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/contact/contact_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }

    public function contactEdit($contactID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(CONTACT_ALIAS, "can_edit");
            if($isPermission){
                $contactID = urlDecodes($contactID);
                if(ctype_digit($contactID)){
                    $data['contactData'] = $this->DataModel->getData('contact_id = '.$contactID, CONTACT_TABLE);
                    if(!empty($data['contactData'])){
                        $this->load->view('header');
                        $this->load->view('news/contact/contact_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $editData = array(
                            'contact_name'=>$this->input->post('contact_name'),
                            'contact_email'=>$this->input->post('contact_email'),
                            'contact_message'=>$this->input->post('contact_message'),
                            'contact_date'=>$this->input->post('contact_date'),
                            'contact_status'=>$this->input->post('contact_status'),
                        );
                        $editDataEntry = $this->DataModel->editData('contact_id = '.$contactID, CONTACT_TABLE, $editData);
                        if($editDataEntry){
                            redirect('view-contact');
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
    
    public function contactDelete($contactID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(CONTACT_ALIAS, "can_delete");
            if($isPermission){ 
                $contactID = urlDecodes($contactID);
                if(ctype_digit($contactID)){
                    $resultDataEntry = $this->DataModel->deleteData('contact_id = '.$contactID, CONTACT_TABLE);
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