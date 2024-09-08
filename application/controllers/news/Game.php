<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {
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
	
    public function gameNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(GAME_ALIAS, "can_add");
            if($isPermission){
                $this->load->view('header');
                $this->load->view('news/game/game_new');
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $gameSlug = $this->input->post('game_slug');
                    $gameData = $this->DataModel->getData('game_slug = "'.$gameSlug.'"', GAME_TABLE);
                    if($gameData !== null && isset($gameData['game_slug']) && $gameData['game_slug'] == $gameSlug){
                        $this->session->set_userdata('session_game_new_game_slug', "$gameSlug is already exits in database!");
                        redirect('new-game');
                    } else {
                        if(!empty($_FILES['game_icon']['name'])){
                            $config['upload_path'] = ICON_PATH;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
    						$config['file_name'] = uniqueKey();
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('game_icon')){
                                $uploadData = $this->upload->data();
                                $gameIcon = $uploadData['file_name'];
                            } else {
                                $gameIcon = '';
                            }
                        } else {
                            $gameIcon = '';
                        }
                        
                        if(!empty($_FILES['game_data']['name'])){
                            $config['upload_path'] = DATA_PATH;
                            $config['allowed_types'] = 'zip';
    						$config['file_name'] = uniqueKey();
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('game_data')){
                                $uploadData = $this->upload->data();
                                $filePath = $uploadData['full_path'];
                                $slugFolder = slugFolder($gameSlug);
                                $extractData = extractZip($filePath, $slugFolder);
                                $fileName = $extractData[0]['filename'];
                                $gameData = str_replace("../","",$slugFolder);
                                unlink($filePath); 
                            } else {
                                $gameData = '';
                            }
                        } else {
                            $gameData = '';
                        }
    			                    
                        $newData = array(
                            'game_slug'=>$gameSlug,
                            'game_name'=>$this->input->post('game_name'),
                            'game_icon'=>$gameIcon,
                            'game_data'=>$gameData,
                            'game_view'=>$this->input->post('game_view'),
                            'game_play'=>$this->input->post('game_play'),
                            'game_date'=>$this->input->post('game_date'),
                            'game_status'=>$this->input->post('game_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(GAME_TABLE, $newData);
                        if($newDataEntry){
                            redirect('view-game');  
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
    
    public function gameView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_game');
            }
            if(isset($_POST['submit_search'])){
                $searchGame = $this->input->post('search_game');
                $this->session->set_userdata('session_game', $searchGame);
            }
            $sessionGame = $this->session->userdata('session_game');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_game_status');
                redirect('view-game');
            }
            
            $searchGameStatus = $this->input->post('search_game_status');
            if($searchGameStatus === 'publish' or $searchGameStatus == 'unpublish'){
                $this->session->set_userdata('session_game_status', $searchGameStatus);
            } else if($searchGameStatus === 'all'){
                $this->session->unset_userdata('session_game_status');
            }
            $sessionGameStatus = $this->session->userdata('session_game_status');
            
            $data = array();
            //get rows count
            $conditions['search_game'] = $sessionGame;
            $conditions['search_game_status'] = $sessionGameStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewGame($conditions, GAME_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-game');
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
            
            $game = $this->DataModel->viewGame($conditions, GAME_TABLE);
            $data['countGame'] = $this->DataModel->countGame($conditions, GAME_TABLE);
            
            $data['viewGame'] = array();
            if(is_array($game) || is_object($game)){
                foreach($game as $Row){
                    $dataArray = array();
                    $dataArray['game_id'] = $Row['game_id'];
                    $dataArray['game_slug'] = $Row['game_slug'];
                    $dataArray['game_name'] = $Row['game_name'];
                    $dataArray['game_icon'] = $Row['game_icon'];
                    $dataArray['game_view'] = $Row['game_view'];
                    $dataArray['game_play'] = $Row['game_play'];
                    $dataArray['game_date'] = $Row['game_date'];
                    $dataArray['game_status'] = $Row['game_status'];
                    array_push($data['viewGame'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/game/game_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }
    
    public function gameEdit($gameID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(GAME_ALIAS, "can_edit");
            if($isPermission){
                $gameID = urlDecodes($gameID);
                if(ctype_digit($gameID)){
                    $data['gameData'] = $this->DataModel->getData('game_id = '.$gameID, GAME_TABLE);
                    
                    if(!empty($data['gameData'])){
                        $this->load->view('header');
                        $this->load->view('news/game/game_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $gameSlug = $this->input->post('game_slug');
                        $gameData = $this->DataModel->getData('game_slug = "'.$gameSlug.'" And game_id != "'.$gameID.'"', GAME_TABLE);
                        if($gameData !== null && isset($gameData['game_slug']) && $gameData['game_slug'] == $gameSlug){
                            $this->session->set_userdata('session_game_edit_game_slug', "$gameSlug is already exits in database!");
                            redirect('edit-game/'.urlEncodes($gameID));
                        } else {
    		                if(!empty($_FILES['game_icon']['name'])){
                                $config['upload_path'] = ICON_PATH;
                                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                                $config['file_name'] = uniqueKey();
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                if($this->upload->do_upload('game_icon')){
                                    if(!empty($data['gameData']['game_icon'])){
                                        $iconPath = ICON_PATH.$data['gameData']['game_icon'];
                                        if(file_exists($iconPath)){
                                            unlink($iconPath);
                                        }
                                    }
                                    $uploadData = $this->upload->data();
                                    $gameIcon = $uploadData['file_name'];
                                } else {
                                    $gameIcon = $data['gameData']['game_icon'];
                                }
                            } else {
                                $gameIcon = $data['gameData']['game_icon'];
                            }
                            
                            if(!empty($_FILES['game_data']['name'])){
                                $config['upload_path'] = DATA_PATH;
                                $config['allowed_types'] = 'zip';
        						$config['file_name'] = uniqueKey();
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                if($this->upload->do_upload('game_data')){
                                    if(!empty($data['gameData']['game_data'])){
                                        $dataPath = DATA_PATH.$data['gameData']['game_slug'];
                                        deleteFolder($dataPath);
                                    }
                                    $uploadData = $this->upload->data();
                                    $filePath = $uploadData['full_path'];
                                    $slugFolder = slugFolder($gameSlug);
                                    $extractData = extractZip($filePath, $slugFolder);
                                    $fileName = $extractData[0]['filename'];
                                    $gameData = str_replace("../","",$slugFolder);
                                    unlink($filePath); 
                                } else {
                                    $gameData = $data['gameData']['game_data'];
                                }
                            } else {
                                $oldSlugFolder = slugFolder($data['gameData']['game_slug']);
                                $newSlugFolder = slugFolder($gameSlug);
                                if($oldSlugFolder !== $newSlugFolder){
                                    if(is_dir($oldSlugFolder)){
                                        rename($oldSlugFolder, $newSlugFolder);
                                    }
                                }
                                $gameData = str_replace("../", "", $newSlugFolder);
                            }
    			                
                            $editData = array(
                                'game_slug'=>$gameSlug,
                                'game_name'=>$this->input->post('game_name'),
                                'game_icon'=>$gameIcon,
                                'game_data'=>$gameData,
                                'game_view'=>$this->input->post('game_view'),
                                'game_play'=>$this->input->post('game_play'),
                                'game_date'=>$this->input->post('game_date'),
                                'game_status'=>$this->input->post('game_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('game_id = '.$gameID, GAME_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-game');
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
    
    public function gameDelete($gameID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){ 
            $isPermission = checkPermission(GAME_ALIAS, "can_delete");
            if($isPermission){ 
                $gameID = urlDecodes($gameID);
                if(ctype_digit($gameID)){
                    $data['gameData'] = $this->DataModel->getData('game_id = '.$gameID, GAME_TABLE);
                    if(!empty($data['gameData']['game_icon'])){
                        $iconPath = unlink(ICON_PATH.$data['gameData']['game_icon']);
                        if(file_exists($iconPath)){
                            unlink($iconPath);
                        }
                    }
                    if(!empty($data['gameData']['game_data'])){
                        $dataPath = DATA_PATH.$data['gameData']['game_slug'];
                        deleteFolder($dataPath);
                    }
                    $resultDataEntry = $this->DataModel->deleteData('game_id = '.$gameID, GAME_TABLE);
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