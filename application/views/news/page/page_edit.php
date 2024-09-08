<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Page</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Page</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-page" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="page_about">Page About *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control tinymce-default" name="page_about" placeholder="Enter page about" required><?php echo $pageData['page_about']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="page_privacy">Page Privacy *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control tinymce-default" name="page_privacy" placeholder="Enter page privacy" required><?php echo $pageData['page_privacy']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="page_terms">Page Terms *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control tinymce-default" name="page_terms" placeholder="Enter page terms" required><?php echo $pageData['page_terms']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="page_status">Page Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="page_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($pageData['page_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($pageData['page_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
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