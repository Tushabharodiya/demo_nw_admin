<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Blog</h4>
                    <div class="nk-block-des text-soft">
                        <p>New Blog</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-blog" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form id="myForm" action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_id">Sub Category Name *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2"  name="sub_category_id" data-placeholder="Select a category" data-search="on" required>
                                        <option label="empty" value=""></option>
                                        <?php if(!empty($subCategoryData)){ ?>
                                            <?php foreach($subCategoryData as $data){ ?>
                                                <option value="<?php echo $data['sub_category_id']; ?>"><?php echo $data['sub_category_name']; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="">Empty</option>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_slug">Blog Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_slug" placeholder="Enter blog slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_blog_new_blog_slug'))){ ?> <?php echo $this->session->userdata('session_blog_new_blog_slug'); ?> <?php echo $this->session->unset_userdata('session_blog_new_blog_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image">Blog Image *</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-control form-file-input" id="file-uploader" name="blog_image" required>
                                        <label class="form-file-label" for="blog_image">Choose file</label>
                                        <div id="feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_canonical">Blog Canonical *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_canonical" placeholder="Enter blog canonical" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_created_by">Blog Created By *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_created_by" placeholder="Enter blog created by" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_title">Blog Title *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_title" placeholder="Enter blog title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_meta_title">Blog Meta Title *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_meta_title" placeholder="Enter blog meta title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="blog_description">Blog Description *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control tinymce-default" name="blog_description" placeholder="Enter blog description" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_meta_description">Blog Meta Description *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_meta_description" placeholder="Enter blog meta description" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_alt">Blog Image Alt *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_alt" placeholder="Enter blog image alt" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_credit">Blog Image Credit *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_credit" placeholder="Enter blog image credit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_credit_url">Blog Image Credit Url *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_credit_url" placeholder="Enter blog image credit url" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_index">Blog Index *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_index" data-placeholder="Select a index" required>
                                        <option value="index">Index</option>
                                        <option value="noindex">Noindex</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_follow">Blog Follow *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_follow" data-placeholder="Select a follow" required>
                                        <option value="follow">Follow</option>
                                        <option value="nofollow">Nofollow</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_status">Blog Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_status" data-placeholder="Select a status" required>
                                        <option value="publish">Publish</option>
                                        <option value="unpublish">Unpublish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary submitButton" id="submit-button" name="submit" value="Save Informations">
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
    const fileUploader = document.getElementById('file-uploader');
    const feedback = document.getElementById('feedback');
    const submitButton = document.getElementById('submit-button');

    fileUploader.addEventListener('change', (event) => {
        const file = event.target.files[0];
        
        if (file) {
            if (file.type === 'image/webp') {
                const img = new Image();
                img.src = URL.createObjectURL(file);
        
                img.onload = function () {
                    const width = this.width;
                    const height = this.height;
        
                    let msg = '';
        
                    if (width === 1000 && height === 500) {
                        msg = `<span style="color:green;">The image size is 1000x500. </span>`;
                        submitButton.style.display = 'block'; 
                    } else {
                        msg = `<span style="color:red;">The image size should be 1000x500. Actual size is ${width}x${height}. </span>`;
                        submitButton.style.display = 'none'; 
                    }
        
                    feedback.innerHTML = msg;
                };
            } else {
                feedback.innerHTML = `<span style="color:red;">The file must be a webp image. </span>`;
                submitButton.style.display = 'none'; 
            }
        }
    });
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