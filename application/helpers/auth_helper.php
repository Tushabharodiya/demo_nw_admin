<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
    if( ! function_exists('timeZone')){
        function timeZone(){
            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("d/m/Y h:i:s A");
            return $timestamp;
        }
    }
    
    if( ! function_exists('todayDate')){
        function todayDate(){
            date_default_timezone_set('Asia/Kolkata');
            $todayDate = date("d/m/Y");
            return $todayDate;
        }
    }
    
    if( ! function_exists('checkAuth')){
        function checkAuth(){
            $ci =& get_instance();
            $ci->load->database();
            $ci->load->model('DataModel');
            if(!empty($ci->session->userdata['user_key'])){ 
                if($ci->session->userdata['auth_key'] == AUTH_KEY){
                    $userKey = $ci->session->userdata['user_key'];
                    $userRole = $ci->session->userdata['user_role'];
                    if($userRole == "Super"){
                        $userData = $ci->DataModel->getData('user_key = '.$userKey, SUPER_USER_TABLE);
                    } else {
                        $userData = $ci->DataModel->getData('user_key = '.$userKey, MASTER_USER_TABLE);
                    }
                    if($userData){
                        $isLogin = $userData['is_login'];
                    } else {
                        redirect('error');
                    }
                } else {
                    redirect('error');
                }
            } else {
                redirect('error');
            }
            return $isLogin;
        }
    }
    
    if( ! function_exists('urlEncodes')){
        function urlEncodes($dataID = 0){
            date_default_timezone_set("Asia/Kolkata");
            if($dataID != null){
                $uniqKey = 0710;
                $dateString = $uniqKey.''.date('iH').''.$dataID;
                $dataLength = strlen($dateString);
                $encodeArray = array();
                $arrayKey = array('0'=>'5846ca', '1'=>'c56da5', '2'=>'69adc4', '3'=>'a56f49', '4'=>'6adc26', '5'=>'5a89db', '6'=>'d5487c', '7'=>'ac56df', '8'=>'ac658c', '9'=>'75dca8');
                for($i = 0; $i < $dataLength; $i++){   
                    array_push($encodeArray, $arrayKey[$dateString[$i]]);
                }
                $encodeURL = implode("xe", $encodeArray); 
            } else {
                $encodeURL = null;
            }
            return $encodeURL;
        }
    }
    
    if( ! function_exists('urlDecodes')){
        function urlDecodes($dataURL = 0){
            date_default_timezone_set("Asia/Kolkata");
            if($dataURL != null or !empty($dataURL)){
                $dataArray = explode("xe", $dataURL);
                $dataLength = count($dataArray);
                $decodeArray = array();
                $arrayKey = array('0'=>'5846ca', '1'=>'c56da5', '2'=>'69adc4', '3'=>'a56f49', '4'=>'6adc26', '5'=>'5a89db', '6'=>'d5487c', '7'=>'ac56df', '8'=>'ac658c', '9'=>'75dca8');
                for($i = 0; $i < $dataLength; $i++){   
                    $dataKey = array_search($dataArray[$i], $arrayKey);
                    array_push($decodeArray, $dataKey);
                }
                $decodeURL = substr(implode("", $decodeArray), 7);
            } else {
                $decodeURL = null;
            }
            return $decodeURL;
        }
    }
    
    if( ! function_exists('checkPermission')){
        function checkPermission($dataAlias, $userRights){
            $ci =& get_instance();
            $ci->load->database();
            $ci->load->model('DataModel');
            $isLogin = checkAuth();
            if($isLogin == "True"){
                if($ci->session->userdata['user_role'] == "Super"){
                    $type = 1;
                } else {
                    $userData =  $ci->DataModel->getData('user_key = '.$ci->session->userdata['user_key'], MASTER_USER_TABLE);
                    $permissionData = $ci->DataModel->getPermissionData($userData['user_id'], $dataAlias, PERMISSION_USER_TABLE);
                    if($permissionData){
                        if($userRights == "can_add"){
                            $type = $permissionData['can_add'];
                        } else if($userRights == "can_view"){
                            $type = $permissionData['can_view'];
                        } else if($userRights == "can_edit"){
                            $type = $permissionData['can_edit'];
                        } else if($userRights == "can_delete"){
                            $type = $permissionData['can_delete'];
                        } else {
                            $type = 0;
                        }
                    } else {
                        $type = 0;
                    }
                }
                return $type;
            } else {
                redirect('logout');
            }
        }
    }

    if( ! function_exists('uniqueKey')){
        function uniqueKey(){
            date_default_timezone_set("Asia/Kolkata");
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 4; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $uniqueKey =  $randomString.''.strtolower(date('dmYhis'));
            return $uniqueKey;
        }
    }
    
    if( ! function_exists('slugFolder')){
        function slugFolder($filename){
            $slug = url_title(pathinfo($filename, PATHINFO_FILENAME), 'dash', TRUE);
            $slugFolder = DATA_PATH . $slug;

            if(!file_exists($slugFolder)){
                mkdir($slugFolder, 0755, true);
            }
    
            return $slugFolder;
        }
    }
    
    if( ! function_exists('extractZip')){
        function extractZip($filePath, $destination){
            require_once FCPATH . 'pclzip.lib.php';
            $pclzip = new PclZip($filePath);
            $extractFile = $pclzip->extract(PCLZIP_OPT_PATH, $destination);
            return $extractFile;
        }
    }
    
    if(!function_exists('deleteFolder')){
        function deleteFolder($dir){
            if(!is_dir($dir)){
                return false;
            }
    
            $items = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );
    
            foreach($items as $item){
                if($item->isDir()){
                    rmdir($item->getRealPath());
                } else {
                    unlink($item->getRealPath());
                }
            }
    
            rmdir($dir);
            return true;
        }
    }