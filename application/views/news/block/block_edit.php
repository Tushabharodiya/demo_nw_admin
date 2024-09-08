<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Block</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Block</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-block" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_one">Block One *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_one" placeholder="Enter block one" required><?php echo $blockData['block_one']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_two">Block Two *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_two" placeholder="Enter block two" required><?php echo $blockData['block_two']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_three">Block Three *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_three" placeholder="Enter block three" required><?php echo $blockData['block_three']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_four">Block Four *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_four" placeholder="Enter block four" required><?php echo $blockData['block_four']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_five">Block Five *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_five" placeholder="Enter block five" required><?php echo $blockData['block_five']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_status">Block Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="block_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($blockData['block_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($blockData['block_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
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