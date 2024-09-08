<?php
    $isBlogAdd = checkPermission(BLOG_ALIAS, "can_add");
    $isBlogView = checkPermission(BLOG_ALIAS, "can_view");
    $isBlogEdit = checkPermission(BLOG_ALIAS, "can_edit");
    $isBlogDelete = checkPermission(BLOG_ALIAS, "can_delete");

    $sessionBlog = $this->session->userdata('session_blog');
    $sessionBlogIndex = $this->session->userdata('session_blog_index');
    $sessionBlogFollow = $this->session->userdata('session_blog_follow');
    $sessionBlogStatus = $this->session->userdata('session_blog_status');
?>

<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">Blog</h4>
                    <div class="nk-block-des text-soft">
                        <?php if($isBlogView){ ?>
                            <p><?php echo "You have total $countBlog blogs."; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="<?php echo base_url(); ?>view-blog" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <?php if($isBlogView){ ?>
                                    <li>
                                        <div class="dropdown">
                                            <a href="<?php echo base_url(); ?>view-blog" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="filter-wg dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                                <div class="dropdown-head">
                                                    <span class="sub-title dropdown-title">Filter Blog</span>
                                                </div>
                                                <div class="dropdown-body dropdown-body-rg">
                                                    <div class="row gx-6 gy-3">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Index</label>
                                                                <select class="form-control form-select" id="search-index" name="search_blog_index" data-placeholder="Select a index">
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogIndex == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogIndex == 'index')){
                                                                            $str.='selected';
                                                                    } ?> <option value="index"<?php echo $str; ?>>Index</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogIndex == 'noindex')){
                                                                            $str.='selected';
                                                                    } ?> <option value="noindex"<?php echo $str; ?>>Noindex</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Follow</label>
                                                                <select class="form-control form-select" id="search-follow" name="search_blog_follow" data-placeholder="Select a follow">
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogFollow == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogFollow == 'follow')){
                                                                            $str.='selected';
                                                                    } ?> <option value="follow"<?php echo $str; ?>>Follow</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogFollow == 'nofollow')){
                                                                            $str.='selected';
                                                                    } ?> <option value="nofollow"<?php echo $str; ?>>Nofollow</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                <select class="form-control form-select" id="search-status" name="search_blog_status" data-placeholder="Select a status">
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogStatus == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogStatus == 'publish')){
                                                                            $str.='selected';
                                                                    } ?> <option value="publish"<?php echo $str; ?>>Publish</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionBlogStatus == 'unpublish')){
                                                                            $str.='selected';
                                                                    } ?> <option value="unpublish"<?php echo $str; ?>>Unpublish</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                                                    <div class="dropdown-foot between">
                                                        <input type="submit" class="btn btn-sm btn-dim btn-secondary" name="reset_filter" value="Reset Filter">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if($isBlogAdd){ ?>
                                    <li class="nk-block-tools-opt d-block d-sm-block">
                                        <a href="<?php echo base_url(); ?>new-blog" class="btn btn-primary"><em class="icon ni ni-plus"></em></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($isBlogView){ ?>
            <div class="nk-search-box mt-0">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="search_blog" value="<?php if(!empty($sessionBlog)){ echo $sessionBlog; } ?>" placeholder="Search..." autocomplete="off">
                            <div class="form-icon form-icon-right">
                                <em class="icon ni ni-search"></em>
                            </div>
                            <input type="submit" class="btn btn-sm btn-info d-none" name="submit_search" value="Filter">
                            <input type="submit" class="btn btn-sm btn-secondary d-none" name="reset_search" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
        
       <div class="nk-block">
            <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                    <div class="card-inner p-0">
                        <div class="nk-tb-list nk-tb-ulist">
                            <div class="table-responsive">
                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th class="nk-tb-col" width="10%"><span>ID</span></th>
                                            <th class="nk-tb-col" width="12%"><span>Image</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Category</span></th>
                                            <th class="nk-tb-col" width="20%"><span>Description</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Created By</span></th>
                                            <th class="nk-tb-col" width="9%"><span>Date</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Status</span></th>
                                            <th class="nk-tb-col text-end" width="9%"><span>Actions</span></th>
                                        </tr>
                                    </thead>
                                    <?php if($isBlogView){ ?>
                                        <?php if(!empty($viewBlog)){ ?>
                                            <tbody>
                                                <?php foreach($viewBlog as $data){ ?>
                                                <tr class="tb-tnx-item">
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['blog_id']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a class="gallery-image popup-image" href="<?php echo IMAGE_PATH . $data['blog_image']; ?>">
                                                            <img src="<?php echo THUMBNAIL_PATH . $data['blog_thumbnail']; ?>" alt="" width="100" height="50">
                                                        </a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['subCategoryData']['sub_category_name']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php 
                                                            $blogDescription = strip_tags($data['blog_description']);
                                                            if(strlen($blogDescription) > 50){
                                                                echo substr($blogDescription, 0, 50);
                                                            } else {
                                                                echo $blogDescription;
                                                            }
                                                        ?></span>
                                                        <?php if(strlen($blogDescription) > 50){ ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#descriptionModal<?php echo $data['blog_id'];?>" class="sub-text text-primary">Read More</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['blog_created_by']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['blog_date']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $blogStatus = '';
                                                            if($data['blog_status'] == 'publish'){
                                                                $blogStatus.= '<span class="tb-status text-success">Publish</span>';
                                                            } else if($data['blog_status'] == 'unpublish'){
                                                                $blogStatus.= '<span class="tb-status text-danger">Unpublish</span>';
                                                            }
                                                            echo $blogStatus; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <?php if($isBlogView){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#infoModal<?php echo urlEncodes($data['blog_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Info">
                                                                        <em class="icon ni ni-eye-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isBlogEdit){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>edit-blog/<?php echo urlEncodes($data['blog_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <em class="icon ni ni-edit-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isBlogDelete){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo urlEncodes($data['blog_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <em class="icon ni ni-trash-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" tabindex="-1" id="descriptionModal<?php echo $data['blog_id']; ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Blog Description</h5>
                                                                <a href="<?php echo base_url(); ?>view-blog" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="blog"><p>
                                                                    <?php 
                                                                        echo str_replace(array(
                                                                            "#[block_one]#",
                                                                            "#[block_two]#",
                                                                            "#[block_three]#",
                                                                            "#[block_four]#",
                                                                            "#[block_five]#"
                                                                        ),array(
                                                                            empty($allowedIP) ? '<div id="stobtus1">' . $blockData['block_one'] . '</div>' : '', 
                                                                            empty($allowedIP) ? '<div id="stobtus1">' . $blockData['block_two'] . '</div>' : '',
                                                                            empty($allowedIP) ? '<div id="stobtus1">' . $blockData['block_three'] . '</div>' : '',
                                                                            empty($allowedIP) ? '<div id="stobtus1">' . $blockData['block_four'] . '</div>' : '',
                                                                            empty($allowedIP) ? '<div id="stobtus1">' . $blockData['block_five'] . '</div>' : ''
                                                                        ),$data['blog_description']); 
                                                                    ?>
                                                                </p></div>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo $data['blog_status']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="infoModal<?php echo urlEncodes($data['blog_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Blog Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-blog" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="nk-block">
                                                                    <div class="project">
                                                                        <div class="project-head">
                                                                            <a role="link" aria-disabled="true" class="project-title">
                                                                                <div class="user-avatar sq bg-light">
                                                                                        <img src="<?php echo THUMBNAIL_PATH . $data['blog_thumbnail']; ?>" width="40" height="40">
                                                                                    </div>
                                                                                <div class="project-info">
                                                                                    <h6 class="title"><?php echo isset($data['subCategoryData']['sub_category_name']) && !empty($data['subCategoryData']['sub_category_name']) ? $data['subCategoryData']['sub_category_name'] : '-'; ?></h6>
                                                                                    <span class="sub-text"><?php echo $data['blog_created_by']; ?></span>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="project-details">
                                                                            <p><span class="data-value">Blog ID : </span><span class="data-label"><?php echo isset($data['blog_id']) && !empty($data['blog_id']) ? $data['blog_id'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Slug : </span><span class="data-label"><?php echo isset($data['blog_slug']) && !empty($data['blog_slug']) ? $data['blog_slug'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Canonical : </span><span class="data-label"><?php echo isset($data['blog_canonical']) && !empty($data['blog_canonical']) ? $data['blog_canonical'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Title : </span><span class="data-label"><?php echo isset($data['blog_title']) && !empty($data['blog_title']) ? $data['blog_title'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Meta Title : </span><span class="data-label"><?php echo isset($data['blog_meta_title']) && !empty($data['blog_meta_title']) ? $data['blog_meta_title'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Meta Description : </span><span class="data-label"><?php echo isset($data['blog_meta_description']) && !empty($data['blog_meta_description']) ? $data['blog_meta_description'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Image Alt : </span><span class="data-label"><?php echo isset($data['blog_image_alt']) && !empty($data['blog_image_alt']) ? $data['blog_image_alt'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Image Credit : </span><span class="data-label"><?php echo isset($data['blog_image_credit']) && !empty($data['blog_image_credit']) ? $data['blog_image_credit'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Image Credit Url : </span><span class="data-label"><?php echo isset($data['blog_image_credit_url']) && !empty($data['blog_image_credit_url']) ? $data['blog_image_credit_url'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Date : </span><span class="data-label"><?php echo isset($data['blog_date']) && !empty($data['blog_date']) ? $data['blog_date'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog View : </span><span class="data-label"><?php echo isset($data['blog_view']) && !empty($data['blog_view']) ? $data['blog_view'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Comment : </span><span class="data-label"><?php echo isset($data['blog_comment']) && !empty($data['blog_comment']) ? $data['blog_comment'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Index : </span><span class="data-label"><?php echo isset($data['blog_index']) && !empty($data['blog_index']) ? $data['blog_index'] : '-'; ?></span></p>
                                                                            <p><span class="data-value">Blog Follow : </span><span class="data-label"><?php echo isset($data['blog_follow']) && !empty($data['blog_follow']) ? $data['blog_follow'] : '-'; ?></span></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['blog_status']) && !empty($data['blog_status']) ? $data['blog_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="deleteModal<?php echo urlEncodes($data['blog_id']);?>">
                                                    <div class="modal-dialog modal-dialog-top" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Blog</h5>
                                                                <a href="<?php echo base_url(); ?>view-blog" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this blog?</p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><a href="<?php echo base_url(); ?>delete-blog/<?php echo urlEncodes($data['blog_id']); ?>" class="btn btn-sm btn-danger">Delete</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </tbody>
                                        <?php } else { ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="8">
                                                        <div class="nk-block-content text-center p-3">
                                                            <span class="sub-text">No data available in table</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="8">
                                                    <div class="nk-block-content text-center p-3">
                                                        <span class="sub-text">You don't have permission to show the blog's data</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($isBlogView){ ?>
                <ul class="pagination justify-content-center justify-content-md-center mt-3">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            <?php } ?>
        </div>
        
    </div>
</div>

<script type="application/javascript">
    $(window).bind("load", function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    });
</script>

<script>
    document.getElementById('search-index').addEventListener('change', function() {
        var selectedIndex = this.value;
        $.ajax({
            url: '<?= base_url('view-blog'); ?>',
            type: 'POST',
            data: { search_blog_index: selectedIndex },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>

<script>
    document.getElementById('search-follow').addEventListener('change', function() {
        var selectedFollow = this.value;
        $.ajax({
            url: '<?= base_url('view-blog'); ?>',
            type: 'POST',
            data: { search_blog_follow: selectedFollow },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>

<script>
    document.getElementById('search-status').addEventListener('change', function() {
        var selectedStatus = this.value;
        $.ajax({
            url: '<?= base_url('view-blog'); ?>',
            type: 'POST',
            data: { search_blog_status: selectedStatus },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>