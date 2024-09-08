<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
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
	
    public function blogNew(){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(BLOG_ALIAS, "can_add");
            if($isPermission){
                $data['subCategoryData'] = $this->DataModel->viewData(null, null, SUB_CATEGORY_TABLE);
                $this->load->view('header');
                $this->load->view('news/blog/blog_new', $data);
                $this->load->view('footer'); 
                if($this->input->post('submit')){
                    $blogSlug = $this->input->post('blog_slug');
                    $blogData = $this->DataModel->getData('blog_slug = "'.$blogSlug.'"', BLOG_TABLE);
                    if($blogData !== null && isset($blogData['blog_slug']) && $blogData['blog_slug'] == $blogSlug){
                        $this->session->set_userdata('session_blog_new_blog_slug', "$blogSlug is already exits in database!");
                        redirect('new-blog');
                    } else {
                        if(!empty($_FILES['blog_image']['name'])){
                            $uploadPath = IMAGE_PATH;
                            $allowedTypes = ['webp'];
                        
                            $fileName = $_FILES['blog_image']['name'];
                            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                            $uniqueKey = uniqueKey();
                            $uploadFile = $uploadPath . $uniqueKey . '.' . $fileType;
                        
                            if(move_uploaded_file($_FILES['blog_image']['tmp_name'], $uploadFile)){
                                $blogImage = $uniqueKey . '.' . $fileType;
                        
                                $sourcePath = $uploadPath . $blogImage;
                                $thumbnailPath = THUMBNAIL_PATH;
                                $thumbnailImage = $thumbnailPath . 'thumb_' . $blogImage;
                        
                                list($width, $height) = getimagesize($sourcePath);
                        
                                $newWidth = 380;
                                $newHeight = 190;
                        
                                $ratioOrig = $width / $height;
                        
                                if($newWidth / $newHeight > $ratioOrig){
                                    $newWidth = $newHeight * $ratioOrig;
                                } else {
                                    $newHeight = $newWidth / $ratioOrig;
                                }
                        
                                $newThumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
                        
                                $sourceImage = imagecreatefromwebp($sourcePath);
    
                                imagecopyresampled($newThumbnailImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                                imagewebp($newThumbnailImage, $thumbnailImage, 50);
                        
                                imagedestroy($newThumbnailImage);
                                imagedestroy($sourceImage);
                        
                                $blogThumbnail = 'thumb_' . $blogImage;
                            } else {
                                $blogImage = '';
                                $blogThumbnail = '';
                            }
                        } else {
                            $blogImage = '';
                            $blogThumbnail = '';
                        }
    
                        $newData = array(
                            'sub_category_id'=>$this->input->post('sub_category_id'),
                            'blog_slug'=>$blogSlug,
                            'blog_image'=>$blogImage,
                            'blog_thumbnail'=>$blogThumbnail,
                            'blog_canonical'=>$this->input->post('blog_canonical'),
                            'blog_created_by'=>$this->input->post('blog_created_by'),
                            'blog_title'=>$this->input->post('blog_title'),
                            'blog_meta_title'=>$this->input->post('blog_meta_title'),
                            'blog_description'=>$this->input->post('blog_description'),
                            'blog_meta_description'=>$this->input->post('blog_meta_description'),
                            'blog_image_alt'=>$this->input->post('blog_image_alt'),
                            'blog_image_credit'=>$this->input->post('blog_image_credit'),
                            'blog_image_credit_url'=>$this->input->post('blog_image_credit_url'),
                            'blog_date'=>todayDate(),
                            'blog_view'=>rand(1, 1000),
                            'blog_comment'=>rand(1, 1000),
                            'blog_index'=>$this->input->post('blog_index'),
                            'blog_follow'=>$this->input->post('blog_follow'),
                            'blog_status'=>$this->input->post('blog_status'),
                        );
                        $newDataEntry = $this->DataModel->insertData(BLOG_TABLE, $newData);
                        if($newDataEntry){
                            redirect('view-blog');  
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
    
    public function blogView(){
        $isLogin = checkAuth();
        if($isLogin == "True"){

            if(isset($_POST['reset_search'])){
                $this->session->unset_userdata('session_blog');
            }
            if(isset($_POST['submit_search'])){
                $searchBlog = $this->input->post('search_blog');
                $this->session->set_userdata('session_blog', $searchBlog);
            }
            $sessionBlog = $this->session->userdata('session_blog');
            
            if(isset($_POST['reset_filter'])){
                $this->session->unset_userdata('session_blog_index');
                $this->session->unset_userdata('session_blog_follow');
                $this->session->unset_userdata('session_blog_status');
                redirect('view-blog');
            }
            
            $searchBlogIndex = $this->input->post('search_blog_index');
            if($searchBlogIndex === 'index' or $searchBlogIndex == 'noindex'){
                $this->session->set_userdata('session_blog_index', $searchBlogIndex);
            } else if($searchBlogIndex === 'all'){
                $this->session->unset_userdata('session_blog_index');
            }
            $sessionBlogIndex = $this->session->userdata('session_blog_index');
            
            $searchBlogFollow = $this->input->post('search_blog_follow');
            if($searchBlogFollow === 'follow' or $searchBlogFollow == 'nofollow'){
                $this->session->set_userdata('session_blog_follow', $searchBlogFollow);
            } else if($searchBlogFollow === 'all'){
                $this->session->unset_userdata('session_blog_follow');
            }
            $sessionBlogFollow = $this->session->userdata('session_blog_follow');
            
            $searchBlogStatus = $this->input->post('search_blog_status');
            if($searchBlogStatus === 'publish' or $searchBlogStatus == 'unpublish'){
                $this->session->set_userdata('session_blog_status', $searchBlogStatus);
            } else if($searchBlogStatus === 'all'){
                $this->session->unset_userdata('session_blog_status');
            }
            $sessionBlogStatus = $this->session->userdata('session_blog_status');
            
            $data = array();
            //get rows count
            $conditions['search_blog'] = $sessionBlog;
            $conditions['search_blog_index'] = $sessionBlogIndex;
            $conditions['search_blog_follow'] = $sessionBlogFollow;
            $conditions['search_blog_status'] = $sessionBlogStatus;
            $conditions['returnType'] = 'count';
            
            $totalRec = $this->DataModel->viewBlog($conditions, BLOG_TABLE);
    
            //pagination config
            $config['base_url']    = site_url('view-blog');
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
            
            $blog = $this->DataModel->viewBlog($conditions, BLOG_TABLE);
            $data['countBlog'] = $this->DataModel->countBlog($conditions, BLOG_TABLE);
            $data['blockData'] = $this->DataModel->getData(null, BLOCK_TABLE);
            
            $data['viewBlog'] = array();
            if(is_array($blog) || is_object($blog)){
                foreach($blog as $Row){
                    $dataArray = array();
                    $dataArray['blog_id'] = $Row['blog_id'];
                    $dataArray['sub_category_id'] = $Row['sub_category_id'];
                    $dataArray['blog_slug'] = $Row['blog_slug'];
                    $dataArray['blog_image'] = $Row['blog_image'];
                    $dataArray['blog_thumbnail'] = $Row['blog_thumbnail'];
                    $dataArray['blog_canonical'] = $Row['blog_canonical'];
                    $dataArray['blog_created_by'] = $Row['blog_created_by'];
                    $dataArray['blog_title'] = $Row['blog_title'];
                    $dataArray['blog_meta_title'] = $Row['blog_meta_title'];
                    $dataArray['blog_description'] = $Row['blog_description'];
                    $dataArray['blog_meta_description'] = $Row['blog_meta_description'];
                    $dataArray['blog_image_alt'] = $Row['blog_image_alt'];
                    $dataArray['blog_image_credit'] = $Row['blog_image_credit'];
                    $dataArray['blog_image_credit_url'] = $Row['blog_image_credit_url'];
                    $dataArray['blog_date'] = $Row['blog_date'];
                    $dataArray['blog_view'] = $Row['blog_view'];
                    $dataArray['blog_comment'] = $Row['blog_comment'];
                    $dataArray['blog_index'] = $Row['blog_index'];
                    $dataArray['blog_follow'] = $Row['blog_follow'];
                    $dataArray['blog_status'] = $Row['blog_status'];
                    $dataArray['subCategoryData'] = $this->DataModel->getData('sub_category_id = '.$dataArray['sub_category_id'], SUB_CATEGORY_TABLE);
                    array_push($data['viewBlog'], $dataArray);
                }
            }
            $this->load->view('header');
            $this->load->view('news/blog/blog_view', $data);
            $this->load->view('footer');
        } else {
            redirect('logout');
        }
    }
    
    public function blogsView($subCategoryID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $subCategoryID = urlDecodes($subCategoryID);
            if(ctype_digit($subCategoryID)){
                if(isset($_POST['reset_search'])){
                    $this->session->unset_userdata('session_blogs');
                }
                if(isset($_POST['submit_search'])){
                    $searchBlogs = $this->input->post('search_blogs');
                    $this->session->set_userdata('session_blogs', $searchBlogs);
                }
                $sessionBlogs = $this->session->userdata('session_blogs');
                
                if(isset($_POST['reset_filter'])){
                    $this->session->unset_userdata('session_blogs_index');
                    $this->session->unset_userdata('session_blogs_follow');
                    $this->session->unset_userdata('session_blogs_status');
                    redirect('view-blogs/'.urlEncodes($subCategoryID));
                }
                
                $searchBlogsIndex = $this->input->post('search_blogs_index');
                if($searchBlogsIndex === 'index' or $searchBlogsIndex == 'noindex'){
                    $this->session->set_userdata('session_blogs_index', $searchBlogsIndex);
                } else if($searchBlogsIndex === 'all'){
                    $this->session->unset_userdata('session_blogs_index');
                }
                $sessionBlogsIndex = $this->session->userdata('session_blogs_index');
                
                $searchBlogsFollow = $this->input->post('search_blogs_follow');
                if($searchBlogsFollow === 'follow' or $searchBlogsFollow == 'nofollow'){
                    $this->session->set_userdata('session_blogs_follow', $searchBlogsFollow);
                } else if($searchBlogsFollow === 'all'){
                    $this->session->unset_userdata('session_blogs_follow');
                }
                $sessionBlogsFollow = $this->session->userdata('session_blogs_follow');
                
                $searchBlogsStatus = $this->input->post('search_blogs_status');
                if($searchBlogsStatus === 'publish' or $searchBlogsStatus == 'unpublish'){
                    $this->session->set_userdata('session_blogs_status', $searchBlogsStatus);
                } else if($searchBlogsStatus === 'all'){
                    $this->session->unset_userdata('session_blogs_status');
                }
                $sessionBlogsStatus = $this->session->userdata('session_blogs_status');
                
                $data = array();
                //get rows count
                $conditions['search_blogs'] = $sessionBlogs;
                $conditions['search_blogs_index'] = $sessionBlogsIndex;
                $conditions['search_blogs_follow'] = $sessionBlogsFollow;
                $conditions['search_blogs_status'] = $sessionBlogsStatus;
                $conditions['returnType'] = 'count';
                
                $totalRec = $this->DataModel->viewBlogs($conditions, $subCategoryID, BLOG_TABLE);
        
                //pagination config
                $config['base_url']    = site_url('view-blogs/'.urlEncodes($subCategoryID));
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
                
                $blogs = $this->DataModel->viewBlogs($conditions, $subCategoryID, BLOG_TABLE);
                $data['countBlogs'] = $this->DataModel->countBlogs($conditions, $subCategoryID, BLOG_TABLE);
                $data['blockData'] = $this->DataModel->getData(null, BLOCK_TABLE);
                
                $data['viewBlogs'] = array();
                if(is_array($blogs) || is_object($blogs)){
                    foreach($blogs as $Row){
                        $dataArray = array();
                        $dataArray['blog_id'] = $Row['blog_id'];
                        $dataArray['sub_category_id'] = $Row['sub_category_id'];
                        $dataArray['blog_slug'] = $Row['blog_slug'];
                        $dataArray['blog_image'] = $Row['blog_image'];
                        $dataArray['blog_thumbnail'] = $Row['blog_thumbnail'];
                        $dataArray['blog_canonical'] = $Row['blog_canonical'];
                        $dataArray['blog_created_by'] = $Row['blog_created_by'];
                        $dataArray['blog_title'] = $Row['blog_title'];
                        $dataArray['blog_meta_title'] = $Row['blog_meta_title'];
                        $dataArray['blog_description'] = $Row['blog_description'];
                        $dataArray['blog_meta_description'] = $Row['blog_meta_description'];
                        $dataArray['blog_image_alt'] = $Row['blog_image_alt'];
                        $dataArray['blog_image_credit'] = $Row['blog_image_credit'];
                        $dataArray['blog_image_credit_url'] = $Row['blog_image_credit_url'];
                        $dataArray['blog_date'] = $Row['blog_date'];
                        $dataArray['blog_view'] = $Row['blog_view'];
                        $dataArray['blog_comment'] = $Row['blog_comment'];
                        $dataArray['blog_index'] = $Row['blog_index'];
                        $dataArray['blog_follow'] = $Row['blog_follow'];
                        $dataArray['blog_status'] = $Row['blog_status'];
                        $dataArray['subCategoryData'] = $this->DataModel->getData('sub_category_id = '.$dataArray['sub_category_id'], SUB_CATEGORY_TABLE);
                        array_push($data['viewBlogs'], $dataArray);
                    }
                }
                $this->load->view('header');
                $this->load->view('news/blog/blogs_view', $data);
                $this->load->view('footer');
            } else {
                redirect('error');
            }
        } else {
            redirect('logout');
        }
    }

    public function blogEdit($blogID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){
            $isPermission = checkPermission(BLOG_ALIAS, "can_edit");
            if($isPermission){
                $blogID = urlDecodes($blogID);
                if(ctype_digit($blogID)){
                    $data['blogData'] = $this->DataModel->getData('blog_id = '.$blogID, BLOG_TABLE);
                    
                    $data['viewSubCategory'] = $this->DataModel->viewData(null, null, SUB_CATEGORY_TABLE);
                    $subCategoryID = $data['blogData']['sub_category_id'];
                    $data['subCategoryData'] = $this->DataModel->getData('sub_category_id = '.$subCategoryID, SUB_CATEGORY_TABLE);

                    if(!empty($data['blogData'])){
                        $this->load->view('header');
                        $this->load->view('news/blog/blog_edit', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('error');
                    }
                    if($this->input->post('submit')){
                        $blogSlug = $this->input->post('blog_slug');
                        $blogData = $this->DataModel->getData('blog_slug = "'.$blogSlug.'" And blog_id != "'.$blogID.'"', BLOG_TABLE);
                        if($blogData !== null && isset($blogData['blog_slug']) && $blogData['blog_slug'] == $blogSlug){
                            $this->session->set_userdata('session_blog_edit_blog_slug', "$blogSlug is already exits in database!");
                            redirect('edit-blog/'.urlEncodes($blogID));
                        } else {
                            if(!empty($_FILES['blog_image']['name'])){
                                $uploadPath = IMAGE_PATH;
                                $allowedTypes = ['webp'];
                                
                                $fileInfo = pathinfo($_FILES['blog_image']['name']);
                                $fileType = strtolower($fileInfo['extension']);
                            
                                $fileName = uniqueKey() . '.' . $fileType;
                                $uploadFile = $uploadPath . $fileName;
                        
                                if(move_uploaded_file($_FILES['blog_image']['tmp_name'], $uploadFile)){
                                    if(!empty($data['blogData']['blog_image'])){
                                        $oldImagePath = IMAGE_PATH . $data['blogData']['blog_image'];
                                        $oldThumbnailPath = THUMBNAIL_PATH . 'thumb_' . $data['blogData']['blog_image'];
                        
                                        if(file_exists($oldImagePath)){
                                            unlink($oldImagePath);
                                        }
                        
                                        if(file_exists($oldThumbnailPath)){
                                            unlink($oldThumbnailPath);
                                        }
                                    }
                        
                                    list($width, $height) = getimagesize($uploadFile);
                        
                                    $newWidth = 380;
                                    $newHeight = 190;
                        
                                    $sourceImage = imagecreatefromwebp($uploadFile);
                                          
                                    $newThumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
                                    imagecopyresampled($newThumbnailImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        
                                    $thumbnailImage = THUMBNAIL_PATH . 'thumb_' . $fileName;
                        
                                    imagewebp($newThumbnailImage, $thumbnailImage, 50);
                                           
                                    imagedestroy($sourceImage);
                                    imagedestroy($newThumbnailImage);
                        
                                    $blogImage = $fileName;
                                    $blogThumbnail = 'thumb_' . $fileName;
                                } else {
                                    $blogImage = $data['blogData']['blog_image'];
                                    $blogThumbnail = $data['blogData']['blog_thumbnail'];
                                }
                            } else {
                                $blogImage = $data['blogData']['blog_image'];
                                $blogThumbnail = $data['blogData']['blog_thumbnail'];
                            }
    
                            $editData = array(
                                'sub_category_id'=>$this->input->post('sub_category_id'),
                                'blog_slug'=>$blogSlug,
                                'blog_image'=>$blogImage,
                                'blog_thumbnail'=>$blogThumbnail,
                                'blog_canonical'=>$this->input->post('blog_canonical'),
                                'blog_created_by'=>$this->input->post('blog_created_by'),
                                'blog_title'=>$this->input->post('blog_title'),
                                'blog_meta_title'=>$this->input->post('blog_meta_title'),
                                'blog_description'=>$this->input->post('blog_description'),
                                'blog_meta_description'=>$this->input->post('blog_meta_description'),
                                'blog_image_alt'=>$this->input->post('blog_image_alt'),
                                'blog_image_credit'=>$this->input->post('blog_image_credit'),
                                'blog_image_credit_url'=>$this->input->post('blog_image_credit_url'),
                                'blog_date'=>$this->input->post('blog_date'),
                                'blog_view'=>$this->input->post('blog_view'),
                                'blog_comment'=>$this->input->post('blog_comment'),
                                'blog_index'=>$this->input->post('blog_index'),
                                'blog_follow'=>$this->input->post('blog_follow'),
                                'blog_status'=>$this->input->post('blog_status'),
                            );
                            $editDataEntry = $this->DataModel->editData('blog_id = '.$blogID, BLOG_TABLE, $editData);
                            if($editDataEntry){
                                redirect('view-blog');
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
    
    public function blogDelete($blogID = 0){
        $isLogin = checkAuth();
        if($isLogin == "True"){ 
            $isPermission = checkPermission(BLOG_ALIAS, "can_delete");
            if($isPermission){ 
                $blogID = urlDecodes($blogID);
                if(ctype_digit($blogID)){
                    $data['blogData'] = $this->DataModel->getData('blog_id = '.$blogID, BLOG_TABLE);
                    if(!empty($data['blogData']['blog_image'])){
                        $imagePath = IMAGE_PATH . $data['blogData']['blog_image'];
                        $thumbnailPath = THUMBNAIL_PATH.'thumb_' . $data['blogData']['blog_image'];
                        
                        if(file_exists($imagePath)){
                            unlink($imagePath);
                        }
            
                        if(file_exists($thumbnailPath)){
                            unlink($thumbnailPath);
                        }
                    } 
                    $resultDataEntry = $this->DataModel->deleteData('blog_id = '.$blogID, BLOG_TABLE);
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