<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Game</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Game</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-game" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_slug">Game Slug *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="game_slug" value="<?php echo $gameData['game_slug']; ?>" placeholder="Enter game slug" required>
                                    <span class="text-danger"><?php if(!empty($this->session->userdata('session_game_edit_game_slug'))){ ?> <?php echo $this->session->userdata('session_game_edit_game_slug'); ?> <?php echo $this->session->unset_userdata('session_game_edit_game_slug'); ?> <?php } ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_name">Game Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="game_name" value="<?php echo $gameData['game_name']; ?>" placeholder="Enter game name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_icon">Game Icon *</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-control form-file-input" name="game_icon" value="<?php echo $gameData['game_icon']; ?>">
                                        <label class="form-file-label" for="game_icon">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_data">Game Data *</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-control form-file-input" name="game_data" value="<?php echo $gameData['game_data']; ?>">
                                        <label class="form-file-label" for="game_data">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_view">Game View *</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="game_view" value="<?php echo $gameData['game_view']; ?>" placeholder="Enter game view" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_play">Game Play *</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" name="game_play" value="<?php echo $gameData['game_play']; ?>" placeholder="Enter game play" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_date">Game Date *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control date-picker" name="game_date" value="<?php echo $gameData['game_date']; ?>" placeholder="Enter game date" data-date-format="dd/mm/yyyy" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="game_status">Game Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="game_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($gameData['game_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($gameData['game_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
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

<script>
    setTimeout(function() {
        $('.text-danger').fadeOut('fast');
    }, 2000); 
</script>