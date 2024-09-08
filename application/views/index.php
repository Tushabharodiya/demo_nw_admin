<?php
    $isMainCategoryTotalView = checkPermission(MAIN_CATEGORY_TOTAL_ALIAS, "can_view");
    $isMainCategoryTotalEdit = checkPermission(MAIN_CATEGORY_TOTAL_ALIAS, "can_edit");
    $isMainCategoryPublishView = checkPermission(MAIN_CATEGORY_PUBLISH_ALIAS, "can_view");
    $isMainCategoryPublishEdit = checkPermission(MAIN_CATEGORY_PUBLISH_ALIAS, "can_edit");
    $isMainCategoryUnpublishView = checkPermission(MAIN_CATEGORY_UNPUBLISH_ALIAS, "can_view");
    $isMainCategoryUnpublishEdit = checkPermission(MAIN_CATEGORY_UNPUBLISH_ALIAS, "can_edit");
    
    $isSubCategoryTotalView = checkPermission(SUB_CATEGORY_TOTAL_ALIAS, "can_view");
    $isSubCategoryTotalEdit = checkPermission(SUB_CATEGORY_TOTAL_ALIAS, "can_edit");
    $isSubCategoryPublishView = checkPermission(SUB_CATEGORY_PUBLISH_ALIAS, "can_view");
    $isSubCategoryPublishEdit = checkPermission(SUB_CATEGORY_PUBLISH_ALIAS, "can_edit");
    $isSubCategoryUnpublishView = checkPermission(SUB_CATEGORY_UNPUBLISH_ALIAS, "can_view");
    $isSubCategoryUnpublishEdit = checkPermission(SUB_CATEGORY_UNPUBLISH_ALIAS, "can_edit");
    
    $isBlogTotalView = checkPermission(BLOG_TOTAL_ALIAS, "can_view");
    $isBlogTotalEdit = checkPermission(BLOG_TOTAL_ALIAS, "can_edit");
    $isBlogPublishView = checkPermission(BLOG_PUBLISH_ALIAS, "can_view");
    $isBlogPublishEdit = checkPermission(BLOG_PUBLISH_ALIAS, "can_edit");
    $isBlogUnpublishView = checkPermission(BLOG_UNPUBLISH_ALIAS, "can_view");
    $isBlogUnpublishEdit = checkPermission(BLOG_UNPUBLISH_ALIAS, "can_edit");
    
    $isContactTotalView = checkPermission(CONTACT_TOTAL_ALIAS, "can_view");
    $isContactTotalEdit = checkPermission(CONTACT_TOTAL_ALIAS, "can_edit");
    $isContactPublishView = checkPermission(CONTACT_PUBLISH_ALIAS, "can_view");
    $isContactPublishEdit = checkPermission(CONTACT_PUBLISH_ALIAS, "can_edit");
    $isContactUnpublishView = checkPermission(CONTACT_UNPUBLISH_ALIAS, "can_view");
    $isContactUnpublishEdit = checkPermission(CONTACT_UNPUBLISH_ALIAS, "can_edit");
?>

<div class="nk-content-wrap">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Hello, <?php if($this->session->userdata != null){ ?> <?php echo $this->session->userdata['user_name']; ?> <?php } ?></h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to our dashboard. Manage your account.</p>
                </div>
            </div>
        </div>
    </div>
   
    <div class="nk-block">
        <?php if(!empty($isMainCategoryTotalView) or !empty($isMainCategoryPublishView) or !empty($isMainCategoryUnpublishView) or 
            !empty($isSubCategoryTotalView) or !empty($isSubCategoryPublishView) or !empty($isSubCategoryUnpublishView) or 
            !empty($isBlogTotalView) or !empty($isBlogPublishView) or !empty($isBlogUnpublishView) or
            !empty($isContactTotalView) or !empty($isContactPublishView) or !empty($isContactUnpublishView)){ ?>
            <div class="row g-gs">
                <?php if(!empty($isMainCategoryTotalView) or !empty($isMainCategoryPublishView) or !empty($isMainCategoryUnpublishView)){ ?>
                    <div class="col-md-6">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Main Category</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Main Category"></em>
                                    </div>
                                </div>
                                <div class="example-alerts">
                                    <div class="row gy-4">
                                        <?php if($isMainCategoryTotalView){ ?>
                                            <div class="col-md-4">
                                                <?php if($mainCategoryCount != null){ ?>
                                                    <?php if($isMainCategoryTotalEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-main-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-primary text-center">
                                                                    <input type="hidden" name="search_main_category_status" value="all">
                                                                    <h6><span class="count text-primary"><?php if($mainCategoryCount != null){ echo $mainCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-primary" value="Total">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-primary text-center">
                                                                <h6><span class="count text-primary"><?php if($mainCategoryCount != null){ echo $mainCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-primary text-center">
                                                            <h6><span class="text-primary"><?php if($mainCategoryCount != null){ echo $mainCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isMainCategoryPublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($mainCategoryPublishCount != null){ ?>
                                                    <?php if($isMainCategoryPublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-main-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-success text-center">
                                                                    <input type="hidden" name="search_main_category_status" value="publish">
                                                                    <h6><span class="count text-success"><?php if($mainCategoryPublishCount != null){ echo $mainCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-success" value="Publish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-success text-center">
                                                                <h6><span class="count text-success"><?php if($mainCategoryPublishCount != null){ echo $mainCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-success text-center">
                                                            <h6><span class="text-success"><?php if($mainCategoryPublishCount != null){ echo $mainCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isMainCategoryUnpublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($mainCategoryUnpublishCount != null){ ?>
                                                    <?php if($isMainCategoryUnpublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-main-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-danger text-center">
                                                                    <input type="hidden" name="search_main_category_status" value="unpublish">
                                                                    <h6><span class="count text-danger"><?php if($mainCategoryUnpublishCount != null){ echo $mainCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-danger" value="Unpublish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-danger text-center">
                                                                <h6><span class="count text-danger"><?php if($mainCategoryUnpublishCount != null){ echo $mainCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-danger text-center">
                                                            <h6><span class="text-danger"><?php if($mainCategoryUnpublishCount != null){ echo $mainCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($isSubCategoryTotalView) or !empty($isSubCategoryPublishView) or !empty($isSubCategoryUnpublishView)){ ?>
                    <div class="col-md-6">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Sub Category</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Sub Category"></em>
                                    </div>
                                </div>
                                <div class="example-alerts">
                                    <div class="row gy-4">
                                        <?php if($isSubCategoryTotalView){ ?>
                                            <div class="col-md-4">
                                                <?php if($subCategoryCount != null){ ?>
                                                    <?php if($isSubCategoryTotalEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-sub-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-primary text-center">
                                                                    <input type="hidden" name="search_sub_category_status" value="all">
                                                                    <h6><span class="count text-primary"><?php if($subCategoryCount != null){ echo $subCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-primary" value="Total">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-primary text-center">
                                                                <h6><span class="count text-primary"><?php if($subCategoryCount != null){ echo $subCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-primary text-center">
                                                            <h6><span class="text-primary"><?php if($subCategoryCount != null){ echo $subCategoryCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isSubCategoryPublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($subCategoryPublishCount != null){ ?>
                                                    <?php if($isSubCategoryPublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-sub-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-success text-center">
                                                                    <input type="hidden" name="search_sub_category_status" value="publish">
                                                                    <h6><span class="count text-success"><?php if($subCategoryPublishCount != null){ echo $subCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-success" value="Publish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-success text-center">
                                                                <h6><span class="count text-success"><?php if($subCategoryPublishCount != null){ echo $subCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-success text-center">
                                                            <h6><span class="text-success"><?php if($subCategoryPublishCount != null){ echo $subCategoryPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isSubCategoryUnpublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($subCategoryUnpublishCount != null){ ?>
                                                    <?php if($isSubCategoryUnpublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-sub-category'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-danger text-center">
                                                                    <input type="hidden" name="search_sub_category_status" value="unpublish">
                                                                    <h6><span class="count text-danger"><?php if($subCategoryUnpublishCount != null){ echo $subCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-danger" value="Unpublish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-danger text-center">
                                                                <h6><span class="count text-danger"><?php if($subCategoryUnpublishCount != null){ echo $subCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-danger text-center">
                                                            <h6><span class="text-danger"><?php if($subCategoryUnpublishCount != null){ echo $subCategoryUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($isBlogTotalView) or !empty($isBlogPublishView) or !empty($isBlogUnpublishView)){ ?>
                    <div class="col-md-6">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Blog</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Blog"></em>
                                    </div>
                                </div>
                                <div class="example-alerts">
                                    <div class="row gy-4">
                                        <?php if($isBlogTotalView){ ?>
                                            <div class="col-md-4">
                                                <?php if($blogCount != null){ ?>
                                                    <?php if($isBlogTotalEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-blog'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-primary text-center">
                                                                    <input type="hidden" name="search_blog_status" value="all">
                                                                    <h6><span class="count text-primary"><?php if($blogCount != null){ echo $blogCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-primary" value="Total">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-primary text-center">
                                                                <h6><span class="count text-primary"><?php if($blogCount != null){ echo $blogCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-primary text-center">
                                                            <h6><span class="text-primary"><?php if($blogCount != null){ echo $blogCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isBlogPublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($blogPublishCount != null){ ?>
                                                    <?php if($isBlogPublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-blog'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-success text-center">
                                                                    <input type="hidden" name="search_blog_status" value="publish">
                                                                    <h6><span class="count text-success"><?php if($blogPublishCount != null){ echo $blogPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-success" value="Publish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-success text-center">
                                                                <h6><span class="count text-success"><?php if($blogPublishCount != null){ echo $blogPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-success text-center">
                                                            <h6><span class="text-success"><?php if($blogPublishCount != null){ echo $blogPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isBlogUnpublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($blogUnpublishCount != null){ ?>
                                                    <?php if($isBlogUnpublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-blog'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-danger text-center">
                                                                    <input type="hidden" name="search_blog_status" value="unpublish">
                                                                    <h6><span class="count text-danger"><?php if($blogUnpublishCount != null){ echo $blogUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-danger" value="Unpublish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-danger text-center">
                                                                <h6><span class="count text-danger"><?php if($blogUnpublishCount != null){ echo $blogUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-danger text-center">
                                                            <h6><span class="text-danger"><?php if($blogUnpublishCount != null){ echo $blogUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($isContactTotalView) or !empty($isContactPublishView) or !empty($isContactUnpublishView)){ ?>
                    <div class="col-md-6">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Contact</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Contact"></em>
                                    </div>
                                </div>
                                <div class="example-alerts">
                                    <div class="row gy-4">
                                        <?php if($isContactTotalView){ ?>
                                            <div class="col-md-4">
                                                <?php if($contactCount != null){ ?>
                                                    <?php if($isContactTotalEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-contact'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-primary text-center">
                                                                    <input type="hidden" name="search_contact_status" value="all">
                                                                    <h6><span class="count text-primary"><?php if($contactCount != null){ echo $contactCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-primary" value="Total">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-primary text-center">
                                                                <h6><span class="count text-primary"><?php if($contactCount != null){ echo $contactCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-primary text-center">
                                                            <h6><span class="text-primary"><?php if($contactCount != null){ echo $contactCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-primary">Total</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isContactPublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($contactPublishCount != null){ ?>
                                                    <?php if($isContactPublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-contact'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-success text-center">
                                                                    <input type="hidden" name="search_contact_status" value="publish">
                                                                    <h6><span class="count text-success"><?php if($contactPublishCount != null){ echo $contactPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-success" value="Publish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-success text-center">
                                                                <h6><span class="count text-success"><?php if($contactPublishCount != null){ echo $contactPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-success text-center">
                                                            <h6><span class="text-success"><?php if($contactPublishCount != null){ echo $contactPublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-success">Publish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($isContactUnpublishView){ ?>
                                            <div class="col-md-4">
                                                <?php if($contactUnpublishCount != null){ ?>
                                                    <?php if($isContactUnpublishEdit){ ?>
                                                        <form method="post" action="<?php echo site_url('view-contact'); ?>">
                                                            <div class="example-alert">
                                                                <div class="alert alert-danger text-center">
                                                                    <input type="hidden" name="search_contact_status" value="unpublish">
                                                                    <h6><span class="count text-danger"><?php if($contactUnpublishCount != null){ echo $contactUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                    <input type="submit" class="btn btn-sm btn-dim btn-danger" value="Unpublish">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="example-alert">
                                                            <div class="alert alert-danger text-center">
                                                                <h6><span class="count text-danger"><?php if($contactUnpublishCount != null){ echo $contactUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                                <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="example-alert">
                                                        <div class="alert alert-danger text-center">
                                                            <h6><span class="text-danger"><?php if($contactUnpublishCount != null){ echo $contactUnpublishCount; ?> <?php } else { ?> 0 <?php } ?></span></h6>
                                                            <span class="btn btn-sm btn-dim btn-danger">Unpublish</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                     <div class="nk-block-content text-center p-3">
                        <div class="gm-err-content">
                            <div class="gm-err-icon"><img src="https://maps.gstatic.com/mapfiles/api-3/images/icon_error.png" alt="" draggable="false" style="user-select: none;"></div>
                            <div class="gm-err-title">You don't have permission to show the dashboard's data.</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <?php if(!empty($this->session->userdata['user_role'])){ ?>
        <?php if($this->session->userdata['user_role'] == "Super"){ ?>
            <div class="nk-block">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <h6 class="card-title">Active Sessions</h6>
                            <div class="card-action">
                                <a href="<?php echo base_url(); ?>view-user" class="link link-sm">See All Users<em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-tranx">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th width="10%"><span>#</span></th>
                                    <th width="20%"><span>Name</span></th>
                                    <th width="25%"><span>Email</span></th>
                                    <th width="15%"><span>Role</span></th>
                                    <th width="19%"><span>Login</span></th>
                                    <th width="6%"><span>Is Login</span></th>
                                    <th width="5%"><span>Logout</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($viewActiveLogin as $data){ ?>
                                <tr class="tb-tnx-item">
                                    <td>
                                        <a href="<?php echo base_url(); ?>"><span><?php echo $data['user_id']; ?></span></a>
                                    </td>
                                    <td>
                                        <span><?php echo $data['user_name']; ?></span>
                                    </td>
                                    <td>
                                        <span><?php echo $data['user_email']; ?></span>
                                    </td>
                                    <td>
                                        <span><?php echo $data['user_role']; ?></span>
                                    </td>
                                    <td>
                                       <span><?php echo $data['user_login']; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot bg-success"><?php echo $data['is_login']; ?></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>user-logout/<?php echo urlEncodes($data['user_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout">
                                            <em class="icon ni ni-signout"></em>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
</div>

<script>
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 500,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>