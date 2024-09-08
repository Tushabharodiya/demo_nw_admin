<?php
    $isBlockAdd = checkPermission(BLOCK_ALIAS, "can_add");
    $isBlockView = checkPermission(BLOCK_ALIAS, "can_view");
    $isBlockEdit = checkPermission(BLOCK_ALIAS, "can_edit");
    $isBlockDelete = checkPermission(BLOCK_ALIAS, "can_delete");
?>

<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">News Block</h4>
                    <div class="nk-block-des text-soft">
                        <?php if($isBlockView){ ?>
                            <p><?php echo "You have total $countBlock news blocks."; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="<?php echo base_url(); ?>view-block" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <?php if($isBlockAdd){ ?>
                                    <li class="nk-block-tools-opt d-block d-sm-block">
                                        <a href="<?php echo base_url(); ?>new-block" class="btn btn-primary"><em class="icon ni ni-plus"></em></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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
                                            <th class="nk-tb-col" width="15%"><span>Block One</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Block Two</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Block Three</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Block Four</span></th>
                                            <th class="nk-tb-col" width="15%"><span>Block Five</span></th>
                                            <th class="nk-tb-col" width="10%"><span>Status</span></th>
                                            <th class="nk-tb-col text-end" width="5%"><span>Actions</span></th>
                                        </tr>
                                    </thead>
                                    <?php if($isBlockView){ ?>
                                        <?php if(!empty($viewBlock)){ ?>
                                            <tbody>
                                                <?php foreach($viewBlock as $data){ ?>
                                                <tr class="tb-tnx-item">
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><?php echo $data['block_id']; ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#blockOneModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-dim btn-sm btn-primary">View One</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#blockTwoModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-dim btn-sm btn-secondary">View Two</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#blockThreeModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-dim btn-sm btn-success">View Three</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#blockFourModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-dim btn-sm btn-danger">View Four</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="sub-text"><a data-bs-toggle="modal" data-bs-target="#blockFiveModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-dim btn-sm btn-info">View Five</a></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span><?php 
                                                            $blockStatus = '';
                                                            if($data['block_status'] == 'publish'){
                                                                $blockStatus.= '<span class="tb-status text-success">Publish</span>';
                                                            } else if($data['block_status'] == 'unpublish'){
                                                                $blockStatus.= '<span class="tb-status text-danger">Unpublish</span>';
                                                            }
                                                            echo $blockStatus; 
                                                        ?></span>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <?php if($isBlockEdit){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a href="<?php echo base_url(); ?>edit-block/<?php echo urlEncodes($data['block_id']); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <em class="icon ni ni-edit-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if($isBlockDelete){ ?>
                                                                <li class="nk-tb-action">
                                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo urlEncodes($data['block_id']);?>" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <em class="icon ni ni-trash-fill"></em>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" tabindex="-1" id="blockOneModal<?php echo urlEncodes($data['block_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block One Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['block_one']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['block_status']) && !empty($data['block_status']) ? $data['block_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="blockTwoModal<?php echo urlEncodes($data['block_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block Two Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['block_two']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['block_status']) && !empty($data['block_status']) ? $data['block_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="blockThreeModal<?php echo urlEncodes($data['block_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block Three Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['block_three']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['block_status']) && !empty($data['block_status']) ? $data['block_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="blockFourModal<?php echo urlEncodes($data['block_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block Four Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['block_four']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['block_status']) && !empty($data['block_status']) ? $data['block_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="blockFiveModal<?php echo urlEncodes($data['block_id']); ?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block Five Info</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $data['block_five']; ?></p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><?php echo isset($data['block_status']) && !empty($data['block_status']) ? $data['block_status'] : '-'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1" id="deleteModal<?php echo urlEncodes($data['block_id']);?>">
                                                    <div class="modal-dialog modal-dialog-top" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Block</h5>
                                                                <a href="<?php echo base_url(); ?>view-block" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this block?</p>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <span class="sub-text"><a href="<?php echo base_url(); ?>delete-block/<?php echo urlEncodes($data['block_id']); ?>" class="btn btn-sm btn-danger">Delete</a></span>
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
                                                        <span class="sub-text">You don't have permission to show the block's data</span>
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
        </div>
        
    </div>
</div>