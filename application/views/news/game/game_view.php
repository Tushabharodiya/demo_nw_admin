<?php
    $isGameAdd = checkPermission(GAME_ALIAS, "can_add");
    $isGameView = checkPermission(GAME_ALIAS, "can_view");
    $isGameEdit = checkPermission(GAME_ALIAS, "can_edit");
    $isGameDelete = checkPermission(GAME_ALIAS, "can_delete");

    $sessionGame = $this->session->userdata('session_game');
    $sessionGameStatus = $this->session->userdata('session_game_status');
?>

<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">Game</h4>
                    <div class="nk-block-des text-soft">
                        <?php if($isGameView){ ?>
                            <p><?php echo "You have total $countGame games."; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="<?php echo base_url(); ?>view-game" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <?php if($isGameView){ ?>
                                    <li>
                                        <div class="dropdown">
                                            <a href="<?php echo base_url(); ?>view-game" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="filter-wg dropdown-menu dropdown-menu-md dropdown-menu-end">
                                                <div class="dropdown-head">
                                                    <span class="sub-title dropdown-title">Filter Game</span>
                                                </div>
                                                <div class="dropdown-body dropdown-body-rg">
                                                    <div class="row gx-6 gy-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                <select class="form-control form-select" id="search-status" name="search_game_status" data-placeholder="Select a status">
                                                                    <?php $str='';
                                                                        if(!empty($sessionGameStatus == 'all')){
                                                                            $str.='selected';
                                                                    } ?> <option value="all"<?php echo $str; ?>>All</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionGameStatus == 'publish')){
                                                                            $str.='selected';
                                                                    } ?> <option value="publish"<?php echo $str; ?>>Publish</option>
                                                                    <?php $str='';
                                                                        if(!empty($sessionGameStatus == 'unpublish')){
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
                                <?php if($isGameAdd){ ?>
                                    <li class="nk-block-tools-opt d-block d-sm-block">
                                        <a href="<?php echo base_url(); ?>new-game" class="btn btn-primary"><em class="icon ni ni-plus"></em></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($isGameView){ ?>
            <div class="nk-search-box mt-0">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="search_game" value="<?php if(!empty($sessionGame)){ echo $sessionGame; } ?>" placeholder="Search..." autocomplete="off">
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
                                            <th class="nk-tb-col" width="10%"><span>Icon</span></th>
                                            <th class="nk-tb-col" width="17%"><span>Slug</span></th>
                                            <th class="nk-tb-col" width="17%"><span>Name</span></th>
                                            <th class="nk-tb-col" width="10%"><span>View</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Play</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Date</span></th>
                                            <th class="nk-tb-col" width="6%"><span>Status</span></th>
                                            <th class="nk-tb-col text-end" width="10%"><span>Actions</span></th>
                                        </tr>
                                    </thead>
                                    <?php if($isGameView){ ?>
                                        <?php if(!empty($viewGame)){ ?>
                                            <tbody>
                                                <?php foreach($viewGame as $data){ ?>
                                                <tr class="tb-tnx-item">
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['game_id']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a class="gallery-image popup-image" href="<?php echo ICON_PATH . $data['game_icon']; ?>">
                                                            <img src="<?php echo ICON_PATH . $data['game_icon']; ?>" alt="" width="60" height="60">
                                                        </a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php 
                                                            $gameSlug = strip_tags($data['game_slug']);
                                                            if(strlen($gameSlug) > 20){
                                                                echo substr($gameSlug, 0, 20);
                                                            } else {
                                                                echo $gameSlug;
                                                            }
                                                        ?></span>
                                                        <?php if(strlen($gameSlug) > 20){ ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#slugModal<?php echo $data['game_id'];?>" class="sub-text text-primary">Read More</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php 
                                                            $gameName = strip_tags($data['game_name']);
                                                            if(strlen($gameName) > 20){
                                                                echo substr($gameName, 0, 20);
                                                            } else {
                                                                echo $gameName;
                                                            }
                                                        ?></span>
                                                        <?php if(strlen($gameName) > 20){ ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#nameModal<?php echo $data['game_id'];?>" class="sub-text text-primary">Read More</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['game_view']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['game_play']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['game_date']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $gameStatus = '';
                                                            if($data['game_status'] == 'publish'){
                                                                $gameStatus.= '<span class="tb-status text-success">Publish</span>';
                                                            } else if($data['game_status'] == 'unpublish'){
                                                                $gameStatus.= '<span class="tb-status text-danger">Unpublish</span>';
                                                            }
                                                            echo $gameStatus; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <?php if($isGameEdit){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>edit-game/<?php echo urlEncodes($data['game_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <em class="icon ni ni-edit-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isGameDelete){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo urlEncodes($data['game_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <em class="icon ni ni-trash-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" tabindex="-1" id="slugModal<?php echo $data['game_id']; ?>">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Game Slug</h5>
                                                                <a href="<?php echo base_url(); ?>view-slug" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['game_slug']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo $data['game_status']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="nameModal<?php echo $data['game_id']; ?>">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Game Name</h5>
                                                                <a href="<?php echo base_url(); ?>view-game" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['game_name']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo $data['game_status']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="deleteModal<?php echo urlEncodes($data['game_id']);?>">
                                                    <div class="modal-dialog modal-dialog-top" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Game</h5>
                                                                <a href="<?php echo base_url(); ?>view-game" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this game?</p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><a href="<?php echo base_url(); ?>delete-game/<?php echo urlEncodes($data['game_id']); ?>" class="btn btn-sm btn-danger">Delete</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </tbody>
                                        <?php } else { ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="9">
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
                                                <td colspan="9">
                                                    <div class="nk-block-content text-center p-3">
                                                        <span class="sub-text">You don't have permission to show the game's data</span>
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
            <?php if($isGameView){ ?>
                <ul class="pagination justify-content-center justify-content-md-center mt-3">
                    <?php echo $this->pagination->create_links(); ?>
                </ul>
            <?php } ?>
        </div>
        
    </div>
</div>

<script>
    document.getElementById('search-status').addEventListener('change', function() {
        var selectedStatus = this.value;
        $.ajax({
            url: '<?= base_url('view-game'); ?>',
            type: 'POST',
            data: { search_game_status: selectedStatus },
            success: function() {
                window.location.href=window.location.href;
            }
        });
    });
</script>