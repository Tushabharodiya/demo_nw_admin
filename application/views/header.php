<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="robots" content="noindex, nofollow" />
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>source/images/favicon.png">
    
    <title><?php echo TITLE; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>source/assets/css/style.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url(); ?>source/assets/css/theme.css?ver=3.1.3">
    
    <script src="<?php echo base_url();?>source/js/bootsjs/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" href="<?php echo base_url();?>source/tinymce/js/tinymce/tinymce.css">
</head>

<?php
    if($this->session->userdata('panelLog') == ""){
        redirect('login');
    } else if($this->session->userdata('panelLog') == "FALSE"){
        redirect('confirmOTP');
    }
?>  

<?php
    $mainCategoryAlias = $this->DataModel->userPermissionData(MAIN_CATEGORY_ALIAS);
    $subCategoryAlias = $this->DataModel->userPermissionData(SUB_CATEGORY_ALIAS);
    $blogAlias = $this->DataModel->userPermissionData(BLOG_ALIAS);
    $gameAlias = $this->DataModel->userPermissionData(GAME_ALIAS);
    $pageAlias = $this->DataModel->userPermissionData(PAGE_ALIAS);
    $blockAlias = $this->DataModel->userPermissionData(BLOCK_ALIAS);
    $contactAlias = $this->DataModel->userPermissionData(CONTACT_ALIAS);
?>

<?php if($this->session->userdata['theme_mode'] == "dark"){ ?>
<body class="nk-body bg-white npc-default has-aside dark-mode">
<?php } else { ?>
<body class="nk-body bg-white npc-default has-aside">
<?php } ?>
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-lg wide-xxl">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="<?php echo base_url(); ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php echo base_url(); ?>source/images/logo.png" srcset="<?php echo base_url(); ?>source/images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="<?php echo base_url(); ?>source/images/logo-dark.png" srcset="<?php echo base_url(); ?>source/images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <?php if(!empty($this->session->userdata['user_role'])){ ?> 
                                <?php if($this->session->userdata['user_role'] == "Super"){ ?>
                                    <div class="nk-header-menu">
                                        <ul class="nk-menu nk-menu-main">
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>dashboard" class="nk-menu-link">
                                                    <span class="nk-menu-text">Overview</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-user" class="nk-menu-link">
                                                    <span class="nk-menu-text">All User</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>login-history" class="nk-menu-link">
                                                    <span class="nk-menu-text">Login History</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-ip" class="nk-menu-link">
                                                    <span class="nk-menu-text">Allowed IP</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="<?php echo base_url(); ?>#" class="dropdown-toggle me-lg-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-block d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span><?php echo get_first_letters($this->session->userdata['user_name']); ?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php if($this->session->userdata != null){ ?> <?php echo $this->session->userdata['user_name']; ?> <?php } ?></span>
                                                        <span class="sub-text"><?php if($this->session->userdata != null){ ?> <?php echo $this->session->userdata['user_email']; ?> <?php } ?></span>
                                                    </div>
                                                    <?php if(!empty($this->session->userdata['user_role'])){ ?> 
                                                        <?php if($this->session->userdata['user_role'] == "Super"){ ?>
                                                            <div class="user-action">
                                                                <a class="btn btn-icon me-n2" href="<?php echo base_url(); ?>view-permission"><em class="icon ni ni-setting"></em></a>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(); ?>user-profile"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <?php if(!empty($this->session->userdata['user_role'])){ ?> 
                                                        <?php if($this->session->userdata['user_role'] == "Super"){ ?> 
                                                            <li><a href="<?php echo base_url(); ?>view-user"><em class="icon ni ni-user-list"></em><span>All User</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>login-history"><em class="icon ni ni-activity-alt"></em><span>Login History</span></a></li>
                                                            <li><a href="<?php echo base_url(); ?>view-ip"><em class="icon ni ni-map-pin"></em><span>Allowed IP</span></a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if($this->session->userdata['theme_mode'] == "dark"){ ?>
                                                        <li><a href="<?php echo base_url(); ?>dashboard/theme"><em class="icon ni ni-sun"></em><span>Light Mode</span></a></li>
                                                    <?php } else { ?>
                                                        <li><a href="<?php echo base_url(); ?>dashboard/theme"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                    <?php } ?>
                                                    <li><a href="<?php echo base_url(); ?>unset-session"><em class="icon ni ni-reload-alt"></em></em><span>Refresh</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(); ?>logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-lg-none">
                                        <a href="<?php echo base_url(); ?>#" class="toggle nk-quick-nav-icon me-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container wide-xxl">
                        <div class="nk-content-inner">
                            <div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
                                <div class="nk-sidebar-menu" data-simplebar>
                                    <ul class="nk-menu">
                                    <?php if(!empty($this->session->userdata['user_role'])){ ?> 
                                        <?php if($this->session->userdata['user_role'] == "Super"){ ?>  
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>dashboard" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                                    <span class="nk-menu-text">Dashboard</span>
                                                </a>
                                            </li>
                                            
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">News</h6>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-main-category" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-grid"></em></span>
                                                    <span class="nk-menu-text">Main Categories</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-sub-category" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-grid-plus"></em></span>
                                                    <span class="nk-menu-text">Sub Categories</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-blog" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-box-view"></em></span>
                                                    <span class="nk-menu-text">All Blogs</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-game" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-movie"></em></span>
                                                    <span class="nk-menu-text">Game</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-page" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                                                    <span class="nk-menu-text">Pages</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-block" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                                                    <span class="nk-menu-text">Blocks</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>view-contact" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                                                    <span class="nk-menu-text">Contact</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">Master</h6>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="<?php echo base_url(); ?>#" class="nk-menu-link nk-menu-toggle">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Settings</span>
                                                </a>
                                                <ul class="nk-menu-sub">
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-user" class="nk-menu-link"><span class="nk-menu-text">User Master</span></a>
                                                    </li>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-department" class="nk-menu-link"><span class="nk-menu-text">Department Master</span></a>
                                                    </li>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-permission" class="nk-menu-link"><span class="nk-menu-text">Permission Master</span></a>
                                                    </li>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-alias" class="nk-menu-link"><span class="nk-menu-text">Permission Alias</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="<?php echo base_url(); ?>dashboard" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                                    <span class="nk-menu-text">Dashboard</span>
                                                </a>
                                            </li>
                                            <?php if(!empty($mainCategoryAlias) or !empty($subCategoryAlias) or !empty($blogAlias) or !empty($gameAlias) or !empty($pageAlias) or !empty($blockAlias) or !empty($contactAlias)){ ?>
                                                <li class="nk-menu-heading">
                                                    <h6 class="overline-title text-primary-alt">News Site</h6>
                                                </li>
                                                <?php if(!empty($mainCategoryAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-main-category" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-grid"></em></span>
                                                            <span class="nk-menu-text">Main Category</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($subCategoryAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-sub-category" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-grid-plus"></em></span>
                                                            <span class="nk-menu-text">Sub Category</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($blogAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-blog" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-box-view"></em></span>
                                                            <span class="nk-menu-text">Blog</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($gameAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-game" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-movie"></em></span>
                                                            <span class="nk-menu-text">Game</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($pageAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-page" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-info"></em></span>
                                                            <span class="nk-menu-text">Pages</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($blockAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-block" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                                                            <span class="nk-menu-text">Blocks</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($contactAlias)){ ?>
                                                    <li class="nk-menu-item">
                                                        <a href="<?php echo base_url(); ?>view-contact" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                                                            <span class="nk-menu-text">Contact</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <div class="nk-aside-close">
                                    <a href="<?php echo base_url(); ?>#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
                                </div>
                            </div>
                            <div class="nk-content-body">