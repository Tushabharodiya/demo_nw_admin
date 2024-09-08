<?php
    $isMainCategoryAdd = checkPermission(MAIN_CATEGORY_ALIAS, "can_add");
    $isMainCategoryView = checkPermission(MAIN_CATEGORY_ALIAS, "can_view");
    $isMainCategoryEdit = checkPermission(MAIN_CATEGORY_ALIAS, "can_edit");
    $isMainCategoryDelete = checkPermission(MAIN_CATEGORY_ALIAS, "can_delete");
    $isSubCategoryView = checkPermission(SUB_CATEGORY_ALIAS, "can_view");
    
    $sessionMainCategory = $this->session->userdata('session_main_category');
    $sessionMainCategoryShow = $this->session->userdata('session_main_category_show');
    $sessionMainCategoryStatus = $this->session->userdata('session_main_category_status');
?>

<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">Main Category</h4>
                    <div class="nk-block-des text-soft">
                        <?php if($isMainCategoryView){ ?>
                            <p><?php echo "You have total $countMainCategory main categories."; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="<?php echo base_url(); ?>view-main-category" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <?php if($isMainCategoryView){ ?>
                                    <li>
                                        <div class="dropdown">
                                            <a href="<?php echo base_url(); ?>view-main-category" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="filter-wg dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                                <div class="dropdown-head">
                                                    <span class="sub-title dropdown-title">Filter Main Category</span>
                                                </div>
                                                <div class="dropdown-body dropdown-body-rg">
                                                    <div class="row gx-6 gy-3">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Show</label>
                                                                <select class="form-control form-select" id="search-show" name="search_main_category_show" data-placeholder="Select a show">
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryShow == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryShow == 'true')){
                                                                            $str.='selected';
                                                                    } ?> <option value="true"<?php echo $str; ?>>True</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryShow == 'false')){
                                                                            $str.='selected';
                                                                    } ?> <option value="false"<?php echo $str; ?>>False</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                <select class="form-control form-select" id="search-status" name="search_main_category_status" data-placeholder="Select a status">
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryStatus == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryStatus == 'publish')){
                                                                            $str.='selected';
                                                                    } ?> <option value="publish"<?php echo $str; ?>>Publish</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionMainCategoryStatus == 'unpublish')){
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
                                <?php if($isMainCategoryAdd){ ?>
                                    <li class="nk-block-tools-opt d-block d-sm-block">
                                        <a href="<?php echo base_url(); ?>new-main-category" class="btn btn-primary"><em class="icon ni ni-plus"></em></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($isMainCategoryView){ ?>
            <div class="nk-search-box mt-0">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="search_main_category" value="<?php if(!empty($sessionMainCategory)){ echo $sessionMainCategory; } ?>" placeholder="Search..." autocomplete="off">
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
        
        <?php if(!empty($this->session->userdata('session_main_category_delete'))){ ?>
            <div class="alert alert-danger alert-icon">
                <em class="icon ni ni-alert-circle"></em> 
                <?php echo $this->session->userdata('session_main_category_delete');?> <a href="<?php echo base_url('view-sub-category');?>" class="alert-link">sub category</a> <?php echo $this->session->unset_userdata('session_main_category_delete');?>
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
                                            <th class="nk-tb-col" width="25%"><span>Name</span></th>
                                            <th class="nk-tb-col" width="25%"><span>Slug</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Count</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Show</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Status</span></th>
                                            <th class="nk-tb-col text-end" width="10%"><span>Actions</span></th>
                                        </tr>
                                    </thead>
                                    <?php if($isMainCategoryView){ ?>
                                        <?php if(!empty($viewMainCategory)){ ?>
                                            <tbody>
                                                <?php foreach($viewMainCategory as $data){ ?>
                                                <tr class="tb-tnx-item">
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['main_category_id']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['main_category_name']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php 
                                                            $mainCategorySlug = strip_tags($data['main_category_slug']);
                                                            if(strlen($mainCategorySlug) > 30){
                                                                echo substr($mainCategorySlug, 0, 30);
                                                            } else {
                                                                echo $mainCategorySlug;
                                                            }
                                                        ?></span>
                                                        <?php if(strlen($mainCategorySlug) > 30){ ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#slugModal<?php echo $data['main_category_id'];?>" class="sub-text text-primary">Read More</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['countSubCategory']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $mainCategoryShow = '';
                                                            if($data['main_category_show'] == 'true'){
                                                                $mainCategoryShow.= '<span class="tb-status text-success">True</span>';
                                                            } else if($data['main_category_show'] == 'false'){
                                                                $mainCategoryShow.= '<span class="tb-status text-danger">False</span>';
                                                            }
                                                            echo $mainCategoryShow; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $mainCategoryStatus = '';
                                                            if($data['main_category_status'] == 'publish'){
                                                                $mainCategoryStatus.= '<span class="tb-status text-success">Publish</span>';
                                                            } else if($data['main_category_status'] == 'unpublish'){
                                                                $mainCategoryStatus.= '<span class="tb-status text-danger">Unpublish</span>';
                                                            }
                                                            echo $mainCategoryStatus; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <?php if($isSubCategoryView){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>view-sub-categories/<?php echo urlEncodes($data['main_category_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isMainCategoryEdit){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>edit-main-category/<?php echo urlEncodes($data['main_category_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <em class="icon ni ni-edit-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isMainCategoryDelete){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo urlEncodes($data['main_category_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <em class="icon ni ni-trash-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" tabindex="-1" id="slugModal<?php echo $data['main_category_id']; ?>">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Main Category Slug</h5>
                                                                <a href="<?php echo base_url(); ?>view-main-category" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['main_category_slug'];?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo $data['main_category_status'];?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="deleteModal<?php echo urlEncodes($data['main_category_id']);?>">
                                                    <div class="modal-dialog modal-dialog-top" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Main Category</h5>
                                                                <a href="<?php echo base_url(); ?>view-main-category" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete <?php echo $data['main_category_name'];?>?</p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><a href="<?php echo base_url(); ?>delete-main-category/<?php echo urlEncodes($data['main_category_id']); ?>" class="btn btn-sm btn-danger">Delete</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </tbody>
                                        <?php } else { ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">
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
                                                <td colspan="7">
                                                    <div class="nk-block-content text-center p-3">
                                                        <span class="sub-text">You don't have permission to show the main category's data</span>
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
            <?php if($isMainCategoryView){ ?>
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
    document.getElementById('search-status').addEventListener('change', function() {
        var selectedStatus = this.value;
        $.ajax({
            url: '<?= base_url('view-main-category'); ?>',
            type: 'POST',
            data: { search_main_category_status: selectedStatus },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>