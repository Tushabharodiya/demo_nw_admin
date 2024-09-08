<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Blog</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Blog</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-blog" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="sub_category_id">Sub Category Name *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="sub_category_id" data-placeholder="Select a category" data-search="on" required>
                                        <?php foreach($viewSubCategory as $data){
                                            $selected = $data['sub_category_id'] == $subCategoryData['sub_category_id'] ? 'selected' : '';
                                            echo '<option value="'.$data['sub_category_id'].'" '.$selected.'>'.$data['sub_category_name'].'</option>'; 
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_slug">Blog Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_slug" value="<?php echo $blogData['blog_slug']; ?>" placeholder="Enter blog slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_blog_edit_blog_slug'))){ ?> <?php echo $this->session->userdata('session_blog_edit_blog_slug'); ?> <?php echo $this->session->unset_userdata('session_blog_edit_blog_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image">Blog Image *</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-control form-file-input" id="file-uploader" name="blog_image" value="<?php echo $blogData['blog_image']; ?>">
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
                                    <input type="text" class="form-control" name="blog_canonical" value="<?php echo $blogData['blog_canonical']; ?>" placeholder="Enter blog canonical" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_created_by">Blog Created By *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_created_by" value="<?php echo $blogData['blog_created_by']; ?>" placeholder="Enter blog created by" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_title">Blog Title *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_title" value="<?php echo $blogData['blog_title']; ?>" placeholder="Enter blog title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_meta_title">Blog Meta Title *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_meta_title" value="<?php echo $blogData['blog_meta_title']; ?>" placeholder="Enter blog meta title" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <label class="form-label" for="blog_description">Blog Description *</label>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                        <div class="card card-bordered">
                                            <div class="btn btn-sm clipboard-init" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to block" data-clipboard-target="#blockOne" data-clip-success="Copied" data-clip-text="One"><span class="clipboard-text">One</span></div>
                                            <input type="hidden" class="prettyprint lang-html" id="blockOne" value="<?php echo "#[block_one]#"; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                        <div class="card card-bordered">
                                            <div class="btn btn-sm clipboard-init" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to block" data-clipboard-target="#blockTwo" data-clip-success="Copied" data-clip-text="Two"><span class="clipboard-text">Two</span></div>
                                            <input type="hidden" class="prettyprint lang-html" id="blockTwo" value="<?php echo "#[block_two]#"; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                        <div class="card card-bordered">
                                            <div class="btn btn-sm clipboard-init" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to block" data-clipboard-target="#blockThree" data-clip-success="Copied" data-clip-text="Three"><span class="clipboard-text">Three</span></div>
                                            <input type="hidden" class="prettyprint lang-html" id="blockThree" value="<?php echo "#[block_three]#"; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                        <div class="card card-bordered">
                                            <div class="btn btn-sm clipboard-init" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to block" data-clipboard-target="#blockFour" data-clip-success="Copied" data-clip-text="Four"><span class="clipboard-text">Four</span></div>
                                            <input type="hidden" class="prettyprint lang-html" id="blockFour" value="<?php echo "#[block_four]#"; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-1">
                                        <div class="card card-bordered">
                                            <div class="btn btn-sm clipboard-init" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to block" data-clipboard-target="#blockFive" data-clip-success="Copied" data-clip-text="Five"><span class="clipboard-text">Five</span></div>
                                            <input type="hidden" class="prettyprint lang-html" id="blockFive" value="<?php echo "#[block_five]#"; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-control-wrap">
                                    <textarea class="form-control tinymce-default" name="blog_description" placeholder="Enter blog description" required><?php echo $blogData['blog_description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_meta_description">Blog Meta Description *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_meta_description" value="<?php echo $blogData['blog_meta_description']; ?>" placeholder="Enter blog meta description" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_alt">Blog Image Alt *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_alt" value="<?php echo $blogData['blog_image_alt']; ?>" placeholder="Enter blog image alt" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_credit">Blog Image Credit *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_credit" value="<?php echo $blogData['blog_image_credit']; ?>" placeholder="Enter blog image credit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_image_credit_url">Blog Image Credit Url *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="blog_image_credit_url" value="<?php echo $blogData['blog_image_credit_url']; ?>" placeholder="Enter blog image credit url" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_date">Blog Date *</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="blog_date" value="<?php echo $blogData['blog_date']; ?>" placeholder="Enter blog date" data-date-format="dd/mm/yyyy" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_view">Blog View *</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="blog_view" value="<?php echo $blogData['blog_view']; ?>" placeholder="Enter blog view" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_comment">Blog Comment *</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="blog_comment" value="<?php echo $blogData['blog_comment']; ?>" placeholder="Enter blog comment" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_index">Blog Index *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_index" data-placeholder="Select a index" required>
                                        <option value="index"<?php if($blogData['blog_index'] =="index"){ echo "selected"; } else { echo ""; } ?>>Index</option>
                                        <option value="noindex"<?php if($blogData['blog_index'] =="noindex"){ echo "selected"; } else { echo ""; } ?>>Noindex</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_follow">Blog Follow *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_follow" data-placeholder="Select a follow" required>
                                        <option value="follow"<?php if($blogData['blog_follow'] =="follow"){ echo "selected"; } else { echo ""; } ?>>Follow</option>
                                        <option value="nofollow"<?php if($blogData['blog_follow'] =="nofollow"){ echo "selected"; } else { echo ""; } ?>>Nofollow</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="blog_status">Blog Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="blog_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($blogData['blog_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($blogData['blog_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="submit-button" name="submit" value="Update">
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