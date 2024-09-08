<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Sub Category</h4>
                    <div class="nk-block-des text-soft">
                        <p>New Sub Category</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-sub-category" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form id="myForm" action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="main_category_id">Main Category Name *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2"  name="main_category_id" data-placeholder="Select a category" data-search="on" required>
                                        <option label="empty" value=""></option>
                                        <?php if(!empty($mainCategoryData)){ ?>
                                            <?php foreach($mainCategoryData as $data){ ?>
                                                <option value="<?php echo $data['main_category_id']; ?>"><?php echo $data['main_category_name']; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="">Empty</option>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_slug">Sub Category Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="sub_category_slug" placeholder="Enter sub category slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_sub_category_new_sub_category_slug'))){ ?> <?php echo $this->session->userdata('session_sub_category_new_sub_category_slug'); ?> <?php echo $this->session->unset_userdata('session_sub_category_new_sub_category_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_name">Sub Category Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="sub_category_name" placeholder="Enter sub category name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_status">Sub Category Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="sub_category_status" data-placeholder="Select a status" required>
                                        <option value="publish">Publish</option>
                                        <option value="unpublish">Unpublish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary submitButton" name="submit" value="Save Informations">
                                <div class="loadingButton">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span>Save Informations</span>
                                    </button>
                                </div>
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

<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        const form = this;
        if (form.checkValidity()) {
            document.querySelector('.submitButton').style.display = 'none';
            document.querySelector('.loadingButton').style.display = 'block';
        } else {
            event.preventDefault();
        }
    });
</script>