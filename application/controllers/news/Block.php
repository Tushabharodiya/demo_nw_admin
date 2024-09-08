<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends CI_Controller {
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
	
    public function blockNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(BLOCK_ALIAS, "can_add");
            if($isPermission){
                $this->load->view('header');
                $this->load->view('news/block/block_new');
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $newData = array(
                        'block_one'=>$this->input->post('block_one'),
                        'block_two'=>$this->input->post('block_two'),
                        'block_three'=>$this->input->post('block_three'),
                        'block_four'=>$this->input->post('block_four'),
                        'block_five'=>$this->input->post('block_five'),
                        'block_status'=>$this->input->post('block_status'),
                    );
                    $newDataEntry = $this->DataModel->insertData(BLOCK_TABLE, $newData);
                    if($newDataEntry){
                        redirect('view-block');  
                    }
                }
            } else {
                redirect('permission-denied');
            }
        } else {
            redirect('logout');
        }
    }
    
    public function blockView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $block = $this->DataModel->viewData(null, null, BLOCK_TABLE);
            $data['countBlock'] = $this->DataModel->countData(null, BLOCK_TABLE);
            
            $data['viewBlock'] = array();
            if(is_array($block) || is_object($block)){
                foreach($block as $Row){
                    $dataArray = array();
                    $dataArray['block_id'] = $Row['block_id'];
                    $dataArray['block_one'] = $Row['block_one'];
                    $dataArray['block_two'] = $Row['block_two'];
                    $dataArray['block_three'] = $Row['block_three'];
                    $dataArray['block_four'] = $Row['block_four'];
                    $dataArray['block_five'] = $Row['block_five'];
                    $dataArray['block_status'] = $Row['block_status'];
                    array_push($data['viewBlock'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/block/block_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }

    public function blockEdit($blockID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(BLOCK_ALIAS, "can_edit");
            if($isPermission){
                $blockID = urlDecodes($blockID);
                if(ctype_digit($blockID)){
                    $data['blockData'] = $this->DataModel->getData('block_id = '.$blockID, BLOCK_TABLE);
                    if(!empty($data['blockData'])){
                        $this->load->view('header');
                        $this->load->view('news/block/block_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $editData = array(
                            'block_one'=>$this->input->post('block_one'),
                            'block_two'=>$this->input->post('block_two'),
                            'block_three'=>$this->input->post('block_three'),
                            'block_four'=>$this->input->post('block_four'),
                            'block_five'=>$this->input->post('block_five'),
                            'block_status'=>$this->input->post('block_status'),
                        );
                        $editDataEntry = $this->DataModel->editData('block_id = '.$blockID, BLOCK_TABLE, $editData);
                        if($editDataEntry){
                            redirect('view-block');
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
    
    public function blockDelete($blockID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(BLOCK_ALIAS, "can_delete");
            if($isPermission){ 
                $blockID = urlDecodes($blockID);
                if(ctype_digit($blockID)){
                    $resultDataEntry = $this->DataModel->deleteData('block_id = '.$blockID, BLOCK_TABLE);
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