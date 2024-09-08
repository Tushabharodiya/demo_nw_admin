<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {
    function __construct() {
		parent::__construct();
	}
	
	// ======================================================== //
    /* Extra Functions */
    // ======================================================== //
	function countData($where, $table){
		$this->db->select('*');
		if($where){
		    $this->db->where($where);
		}
		$this->db->from($table);
		$result = $this->db->count_all_results();
		return $result;
	}

	// ======================================================== //
    /* Common Functions */
    // ======================================================== //
	function insertData($table, $data){
		$result = $this->db->insert($table, $data);
		if($result)
			return $this->db->insert_id();
		else
			return false;
	}
	
	function getData($where, $table){
		$this->db->select('*');
		$this->db->from($table);
		if($where){ $this->db->where($where); }
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
	function viewData($order, $where, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order);
		if($order){ $this->db->order_by($order); }
		if($where){ $this->db->where($where); }
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function viewGroupData($order, $where, $group, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order);
		if($order){ $this->db->order_by($order); }
		if($where){ $this->db->where($where); }
		if($group){ $this->db->group_by($group); }
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function editData($where, $table, $editData){
		$this->db->where($where);
        $result = $this->db->update($table, $editData);
		if($result)
			return  true;
		else
			return false;
	}
	
	function deleteData($where, $table){
		$this->db->where($where);
		$result = $this->db->delete($table);
		if($result)
			return true;
		else
			return false;
	}
    
    // ======================================================== //
    /* Master Functions */
    // ======================================================== //
    // Permission Functions
    function getPermissionData($userID, $alias, $table){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('user_id', $userID);
		$this->db->where('permission_alias', $alias);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
    function viewNotDepartmentData($order, $departmentID, $whereArray, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order);
		if($order){ $this->db->order_by($order); }
		if($departmentID){ $this->db->where('department_id', $departmentID); }
		if($whereArray){ $this->db->where_not_in('permission_id', $whereArray); }
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function viewNotUserData($order, $userID, $whereArray, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order);
		if($order){ $this->db->order_by($order); }
		if($userID){ $this->db->where('user_id', $userID); }
		if($whereArray){ $this->db->where_not_in('permission_id', $whereArray); }
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
    function getDepartmentPermissionData($rightsID, $departmentID, $permissionID, $table){
		$this->db->select('*');
		$this->db->from($table);
		if($rightsID){ $this->db->where('rights_id', $rightsID); }
		if($departmentID){ $this->db->where('department_id', $departmentID); }
		if($permissionID){ $this->db->where('permission_id', $permissionID); }
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
	function getUserPermissionData($rightsID, $userID, $permissionID, $table){
		$this->db->select('*');
		$this->db->from($table);
		if($rightsID){ $this->db->where('rights_id', $rightsID); }
		if($userID){ $this->db->where('user_id', $userID); }
		if($permissionID){ $this->db->where('permission_id', $permissionID); }
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
	function deleteUserData($departmentID, $permissionID, $table){
		$this->db->where($departmentID);
		$this->db->where($permissionID);
		$result = $this->db->delete($table);
		if($result)
			return true;
		else
			return false;
	}
	
	function editUserData($userID, $departmentID, $permissionID, $table, $editData){
		$this->db->where($userID);
		$this->db->where($departmentID);
		$this->db->where($permissionID);
        $result = $this->db->update($table, $editData);
		if($result)
			return  true;
		else
			return false;
	}
	
	function userPermissionData($aliasName){
        $this->db->select('*');
		$this->db->from(PERMISSION_USER_TABLE);
		$this->db->where('user_id',$this->session->userdata['user_id']); 
		$this->db->where('permission_alias',$aliasName); 
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
    }
    
    function viewLoginActivityData($userID, $table){
	    $this->db->select('*');
		$this->db->from($table);
		if($userID){ $this->db->where($userID); }
		$this->db->where('user_role !=', 'Super');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	// ======================================================== //
    /* News Functions */
    // ======================================================== //
	// Main Category Functions
	function viewMainCategory($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('main_category_id','DESC');
		if(!empty($params['search_main_category'])){
            $searchMainCategory = $params['search_main_category'];
            $likeArr = array('main_category_name' => $searchMainCategory);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_main_category_show'])){
            $searchMainCategoryShow = $params['search_main_category_show'];
            $this->db->where('main_category_show', $searchMainCategoryShow);
        }
        if(!empty($params['search_main_category_status'])){
            $searchMainCategoryStatus = $params['search_main_category_status'];
            $this->db->where('main_category_status', $searchMainCategoryStatus);
        }
        if(array_key_exists("main_category_id",$params)){
            $this->db->where('main_category_id',$params['main_category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countMainCategory($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('main_category_id','DESC');
		if(!empty($params['search_main_category'])){
            $searchMainCategory = $params['search_main_category'];
            $likeArr = array('main_category_name' => $searchMainCategory);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_main_category_show'])){
            $searchMainCategoryShow = $params['search_main_category_show'];
            $this->db->where('main_category_show', $searchMainCategoryShow);
        }
        if(!empty($params['search_main_category_status'])){
            $searchMainCategoryStatus = $params['search_main_category_status'];
            $this->db->where('main_category_status', $searchMainCategoryStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Sub Category Functions
	function viewSubCategory($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('sub_category_id','DESC');
		$this->db->join(MAIN_CATEGORY_TABLE, SUB_CATEGORY_TABLE . '.main_category_id = ' . MAIN_CATEGORY_TABLE . '.main_category_id');
		if(!empty($params['search_sub_category'])){
            $searchSubCategory = $params['search_sub_category'];
            $likeArr = array(MAIN_CATEGORY_TABLE . '.main_category_name' => $searchSubCategory, 'sub_category_name' => $searchSubCategory);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_sub_category_status'])){
            $searchSubCategoryStatus = $params['search_sub_category_status'];
            $this->db->where('sub_category_status', $searchSubCategoryStatus);
        }
        if(array_key_exists("sub_category_id",$params)){
            $this->db->where('sub_category_id',$params['sub_category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countSubCategory($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('sub_category_id','DESC');
		$this->db->join(MAIN_CATEGORY_TABLE, SUB_CATEGORY_TABLE . '.main_category_id = ' . MAIN_CATEGORY_TABLE . '.main_category_id');
		if(!empty($params['search_sub_category'])){
            $searchSubCategory = $params['search_sub_category'];
            $likeArr = array(MAIN_CATEGORY_TABLE . '.main_category_name' => $searchSubCategory, 'sub_category_name' => $searchSubCategory);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_sub_category_status'])){
            $searchSubCategoryStatus = $params['search_sub_category_status'];
            $this->db->where('sub_category_status', $searchSubCategoryStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Sub Categories Functions
	function viewSubCategories($params, $where, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('sub_category_id','DESC');
		$this->db->join(MAIN_CATEGORY_TABLE, SUB_CATEGORY_TABLE . '.main_category_id = ' . MAIN_CATEGORY_TABLE . '.main_category_id');
		if(!empty($params['search_sub_categories'])){
            $searchSubCategories = $params['search_sub_categories'];
            $likeArr = array(MAIN_CATEGORY_TABLE . '.main_category_name' => $searchSubCategories, 'sub_category_name' => $searchSubCategories);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_sub_categories_status'])){
            $searchSubCategoriesStatus = $params['search_sub_categories_status'];
            $this->db->where('sub_category_status', $searchSubCategoriesStatus);
        }
        $this->db->where(MAIN_CATEGORY_TABLE . '.main_category_id', $where);
        if(array_key_exists("sub_category_id",$params)){
            $this->db->where('sub_category_id',$params['sub_category_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countSubCategories($params, $where, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('sub_category_id','DESC');
		$this->db->join(MAIN_CATEGORY_TABLE, SUB_CATEGORY_TABLE . '.main_category_id = ' . MAIN_CATEGORY_TABLE . '.main_category_id');
		if(!empty($params['search_sub_categories'])){
            $searchSubCategories = $params['search_sub_categories'];
            $likeArr = array(MAIN_CATEGORY_TABLE . '.main_category_name' => $searchSubCategories, 'sub_category_name' => $searchSubCategories);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_sub_categories_status'])){
            $searchSubCategoriesStatus = $params['search_sub_categories_status'];
            $this->db->where('sub_category_status', $searchSubCategoriesStatus);
        }
        $this->db->where(MAIN_CATEGORY_TABLE . '.main_category_id', $where);
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Blog Functions
	function viewBlog($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('blog_id','DESC');
		$this->db->join(SUB_CATEGORY_TABLE, BLOG_TABLE . '.sub_category_id = ' . SUB_CATEGORY_TABLE . '.sub_category_id');
		if(!empty($params['search_blog'])){
            $searchBlog = $params['search_blog'];
            $likeArr = array(SUB_CATEGORY_TABLE . '.sub_category_name' => $searchBlog, 'blog_title' => $searchBlog, 'blog_description' => $searchBlog, 'blog_created_by' => $searchBlog, 'blog_date' => $searchBlog, 'blog_view' => $searchBlog, 'blog_comment' => $searchBlog);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_blog_index'])){
            $searchBlogIndex = $params['search_blog_index'];
            $this->db->where('blog_index', $searchBlogIndex);
        }
        if(!empty($params['search_blog_follow'])){
            $searchBlogFollow = $params['search_blog_follow'];
            $this->db->where('blog_follow', $searchBlogFollow);
        }
        if(!empty($params['search_blog_status'])){
            $searchBlogStatus = $params['search_blog_status'];
            $this->db->where('blog_status', $searchBlogStatus);
        }
        if(array_key_exists("blog_id",$params)){
            $this->db->where('blog_id',$params['blog_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countBlog($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('blog_id','DESC');
		$this->db->join(SUB_CATEGORY_TABLE, BLOG_TABLE . '.sub_category_id = ' . SUB_CATEGORY_TABLE . '.sub_category_id');
		if(!empty($params['search_blog'])){
            $searchBlog = $params['search_blog'];
            $likeArr = array(SUB_CATEGORY_TABLE . '.sub_category_name' => $searchBlog, 'blog_title' => $searchBlog, 'blog_description' => $searchBlog, 'blog_created_by' => $searchBlog, 'blog_date' => $searchBlog, 'blog_view' => $searchBlog, 'blog_comment' => $searchBlog);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_blog_index'])){
            $searchBlogIndex = $params['search_blog_index'];
            $this->db->where('blog_index', $searchBlogIndex);
        }
        if(!empty($params['search_blog_follow'])){
            $searchBlogFollow = $params['search_blog_follow'];
            $this->db->where('blog_follow', $searchBlogFollow);
        }
        if(!empty($params['search_blog_status'])){
            $searchBlogStatus = $params['search_blog_status'];
            $this->db->where('blog_status', $searchBlogStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Blogs Functions
	function viewBlogs($params, $where, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('blog_id','DESC');
		$this->db->join(SUB_CATEGORY_TABLE, BLOG_TABLE . '.sub_category_id = ' . SUB_CATEGORY_TABLE . '.sub_category_id');
		if(!empty($params['search_blogs'])){
            $searchBlogs = $params['search_blogs'];
            $likeArr = array(SUB_CATEGORY_TABLE . '.sub_category_name' => $searchBlogs, 'blog_title' => $searchBlogs, 'blog_description' => $searchBlogs, 'blog_created_by' => $searchBlogs, 'blog_date' => $searchBlogs, 'blog_view' => $searchBlogs, 'blog_comment' => $searchBlogs);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_blogs_index'])){
            $searchBlogsIndex = $params['search_blogs_index'];
            $this->db->where('blog_index', $searchBlogsIndex);
        }
        if(!empty($params['search_blogs_follow'])){
            $searchBlogsFollow = $params['search_blogs_follow'];
            $this->db->where('blog_follow', $searchBlogsFollow);
        }
        if(!empty($params['search_blogs_status'])){
            $searchBlogsStatus = $params['search_blogs_status'];
            $this->db->where('blog_status', $searchBlogsStatus);
        }
        $this->db->where(SUB_CATEGORY_TABLE . '.sub_category_id', $where);
        if(array_key_exists("blog_id",$params)){
            $this->db->where('blog_id',$params['blog_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countBlogs($params, $where, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('blog_id','DESC');
		$this->db->join(SUB_CATEGORY_TABLE, BLOG_TABLE . '.sub_category_id = ' . SUB_CATEGORY_TABLE . '.sub_category_id');
		if(!empty($params['search_blogs'])){
            $searchBlogs = $params['search_blogs'];
            $likeArr = array(SUB_CATEGORY_TABLE . '.sub_category_name' => $searchBlogs, 'blog_title' => $searchBlogs, 'blog_description' => $searchBlogs, 'blog_created_by' => $searchBlogs, 'blog_date' => $searchBlogs, 'blog_view' => $searchBlogs, 'blog_comment' => $searchBlogs);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_blogs_index'])){
            $searchBlogsIndex = $params['search_blogs_index'];
            $this->db->where('blog_index', $searchBlogsIndex);
        }
        if(!empty($params['search_blogs_follow'])){
            $searchBlogsFollow = $params['search_blogs_follow'];
            $this->db->where('blog_follow', $searchBlogsFollow);
        }
        if(!empty($params['search_blogs_status'])){
            $searchBlogsStatus = $params['search_blogs_status'];
            $this->db->where('blog_status', $searchBlogsStatus);
        }
        $this->db->where(SUB_CATEGORY_TABLE . '.sub_category_id', $where);
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Game Functions
	function viewGame($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('game_id','DESC');
		if(!empty($params['search_game'])){
            $searchGame = $params['search_game'];
            $likeArr = array('game_slug' => $searchGame, 'game_name' => $searchGame, 'game_view' => $searchGame, 'game_play' => $searchGame, 'game_date' => $searchGame);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_game_status'])){
            $searchGameStatus = $params['search_game_status'];
            $this->db->where('game_status', $searchGameStatus);
        }
        if(array_key_exists("game_id",$params)){
            $this->db->where('game_id',$params['game_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countGame($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('game_id','DESC');
		if(!empty($params['search_game'])){
            $searchGame = $params['search_game'];
            $likeArr = array('game_slug' => $searchGame, 'game_name' => $searchGame, 'game_view' => $searchGame, 'game_play' => $searchGame, 'game_date' => $searchGame);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_game_status'])){
            $searchGameStatus = $params['search_game_status'];
            $this->db->where('game_status', $searchGameStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Page Functions
	function viewPage($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('page_id','DESC');
		if(!empty($params['search_page'])){
            $searchPage = $params['search_page'];
            $likeArr = array('page_about' => $searchPage, 'page_privacy' => $searchPage, 'page_terms' => $searchPage);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_page_status'])){
            $searchPageStatus = $params['search_page_status'];
            $this->db->where('page_status', $searchPageStatus);
        }
        if(array_key_exists("page_id",$params)){
            $this->db->where('page_id',$params['page_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countPage($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('page_id','DESC');
		if(!empty($params['search_page'])){
            $searchPage = $params['search_page'];
            $likeArr = array('page_about' => $searchPage, 'page_privacy' => $searchPage, 'page_terms' => $searchPage);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_page_status'])){
            $searchPageStatus = $params['search_page_status'];
            $this->db->where('page_status', $searchPageStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// Contact Functions
	function viewContact($params, $table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('contact_id','DESC');
		if(!empty($params['search_contact'])){
            $searchContact = $params['search_contact'];
            $likeArr = array('contact_name' => $searchContact, 'contact_email' => $searchContact, 'contact_website' => $searchContact, 'contact_message' => $searchContact);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_contact_status'])){
            $searchContactStatus = $params['search_contact_status'];
            $this->db->where('contact_status', $searchContactStatus);
        }
        if(array_key_exists("contact_id",$params)){
            $this->db->where('contact_id',$params['contact_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
    }
    
	function countContact($params, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('contact_id','DESC');
		if(!empty($params['search_contact'])){
            $searchContact = $params['search_contact'];
            $likeArr = array('contact_name' => $searchContact, 'contact_email' => $searchContact, 'contact_website' => $searchContact, 'contact_message' => $searchContact);
            $this->db->group_start();
            $this->db->or_like($likeArr);
            $this->db->group_end();
        }
        if(!empty($params['search_contact_status'])){
            $searchContactStatus = $params['search_contact_status'];
            $this->db->where('contact_status', $searchContactStatus);
        }
		$result = $this->db->count_all_results();
		return $result;
	}
}