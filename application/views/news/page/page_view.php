<?php
    $isPageAdd = checkPermission(PAGE_ALIAS, "can_add");
    $isPageView = checkPermission(PAGE_ALIAS, "can_view");
    $isPageEdit = checkPermission(PAGE_ALIAS, "can_edit");
    $isPageDelete = checkPermission(PAGE_ALIAS, "can_delete");

    $sessionPage = $this->session->userdata('session_page');
    $sessionPageStatus = $this->session->userdata('session_page_status');
?>

<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">News Page</h4>
                    <div class="nk-block-des text-soft">
                        <?php if($isPageView){ ?>
                            <p><?php echo "You have total $countPage news pages."; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="<?php echo base_url(); ?>view-page" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <?php if($isPageView){ ?>
                                    <li>
                                        <div class="dropdown">
                                            <a href="<?php echo base_url(); ?>view-page" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="filter-wg dropdown-menu dropdown-menu-md dropdown-menu-end">
                                                <div class="dropdown-head">
                                                    <span class="sub-title dropdown-title">Filter Page</span>
                                                </div>
                                                <div class="dropdown-body dropdown-body-rg">
                                                    <div class="row gx-6 gy-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                <select class="form-control form-select" id="search-status" name="search_page_status" data-placeholder="Select a status">
                                                                    <?php $str='';
                                                                        if(!empty($sessionPageStatus == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionPageStatus == 'publish')){
                                                                            $str.='selected';
                                                                    } ?> <option value="publish"<?php echo $str; ?>>Publish</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionPageStatus == 'unpublish')){
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
                                <?php if($isPageAdd){ ?>
                                    <li class="nk-block-tools-opt d-block d-sm-block">
                                        <a href="<?php echo base_url(); ?>new-page" class="btn btn-primary"><em class="icon ni ni-plus"></em></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($isPageView){ ?>
            <div class="nk-search-box mt-0">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="search_page" value="<?php if(!empty($sessionPage)){ echo $sessionPage; } ?>" placeholder="Search..." autocomplete="off">
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
                                            <th class="nk-tb-col" width="25%"><span>About</span></th>
                                            <th class="nk-tb-col" width="25%"><span>Privacy</span></th>
                                            <th class="nk-tb-col" width="25%"><span>Terms</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Status</span></th>
                                            <th class="nk-tb-col text-end" width="5%"><span>Actions</span></th>
                                        </tr>
                                    </thead>
                                    <?php if($isPageView){ ?>
                                        <?php if(!empty($viewPage)){ ?>
                                            <tbody>
                                                <?php foreach($viewPage as $data){ ?>
                                                <tr class="tb-tnx-item">
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['page_id']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#aboutModal<?php echo urlEncodes($data['page_id']);?>" class="btn btn-dim btn-sm btn-primary">View About</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#privacyModal<?php echo urlEncodes($data['page_id']);?>" class="btn btn-dim btn-sm btn-secondary">View Privacy</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#termsModal<?php echo urlEncodes($data['page_id']);?>" class="btn btn-dim btn-sm btn-info">View Terms</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $pageStatus = '';
                                                            if($data['page_status'] == 'publish'){
                                                                $pageStatus.= '<span class="tb-status text-success">Publish</span>';
                                                            } else if($data['page_status'] == 'unpublish'){
                                                                $pageStatus.= '<span class="tb-status text-danger">Unpublish</span>';
                                                            }
                                                            echo $pageStatus; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <?php if($isPageEdit){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>edit-page/<?php echo urlEncodes($data['page_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <em class="icon ni ni-edit-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isPageDelete){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo urlEncodes($data['page_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <em class="icon ni ni-trash-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" tabindex="-1" id="aboutModal<?php echo urlEncodes($data['page_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">About Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-page" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['page_about']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['page_status']) && !empty($data['page_status']) ? $data['page_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="privacyModal<?php echo urlEncodes($data['page_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Privacy Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-page" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['page_privacy']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['page_status']) && !empty($data['page_status']) ? $data['page_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="termsModal<?php echo urlEncodes($data['page_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Terms Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-page" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['page_terms']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['page_status']) && !empty($data['page_status']) ? $data['page_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="deleteModal<?php echo urlEncodes($data['page_id']);?>">
                                                    <div class="modal-dialog modal-dialog-top" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Page</h5>
                                                                <a href="<?php echo base_url(); ?>view-page" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this page?</p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><a href="<?php echo base_url(); ?>delete-page/<?php echo urlEncodes($data['page_id']); ?>" class="btn btn-sm btn-danger">Delete</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </tbody>
                                        <?php } else { ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
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
                                                <td colspan="6">
                                                    <div class="nk-block-content text-center p-3">
                                                        <span class="sub-text">You don't have permission to show the page's data</span>
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
            <?php if($isPageView){ ?>
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
            url: '<?= base_url('view-page'); ?>',
            type: 'POST',
            data: { search_page_status: selectedStatus },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>