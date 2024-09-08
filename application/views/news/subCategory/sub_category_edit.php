<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Sub Category</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Sub Category</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-sub-category" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_id">Main Category Name *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="main_category_id" data-placeholder="Select a category" data-search="on" required>
                                        <?php foreach($viewMainCategory as $data){
                                            $selected = $data['main_category_id'] == $mainCategoryData['main_category_id'] ? 'selected' : '';
                                            echo '<option value="'.$data['main_category_id'].'" '.$selected.'>'.$data['main_category_name'].'</option>'; 
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_slug">Sub Category Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="sub_category_slug" value="<?php echo $subCategoryData['sub_category_slug']; ?>" placeholder="Enter sub category slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_sub_category_edit_sub_category_slug'))){ ?> <?php echo $this->session->userdata('session_sub_category_edit_sub_category_slug'); ?> <?php echo $this->session->unset_userdata('session_sub_category_edit_sub_category_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_name">Sub Category Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="sub_category_name" value="<?php echo $subCategoryData['sub_category_name']; ?>" placeholder="Enter sub category name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_status">Sub Category Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="sub_category_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($subCategoryData['sub_category_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($subCategoryData['sub_category_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Update">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script>
    setTimeout(function() {
        $('.text-danger').fadeOut('fast');
    }, 2000); 
</script>