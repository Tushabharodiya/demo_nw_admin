<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Main Category</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Main Category</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-main-category" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_slug">Main Category Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="main_category_slug" value="<?php echo $mainCategoryData['main_category_slug']; ?>" placeholder="Enter main category slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_main_category_edit_main_category_slug'))){ ?> <?php echo $this->session->userdata('session_main_category_edit_main_category_slug'); ?> <?php echo $this->session->unset_userdata('session_main_category_edit_main_category_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_name">Main Category Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="main_category_name" value="<?php echo $mainCategoryData['main_category_name']; ?>" placeholder="Enter main category name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_show">Main Category Show *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="main_category_show" data-placeholder="Select a show" required>
                                        <option value="true"<?php if($mainCategoryData['main_category_show'] =="true"){ echo "selected"; } else { echo ""; } ?>>True</option>
                                        <option value="false"<?php if($mainCategoryData['main_category_show'] =="false"){ echo "selected"; } else { echo ""; } ?>>False</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_status">Main Category Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="main_category_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($mainCategoryData['main_category_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($mainCategoryData['main_category_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
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