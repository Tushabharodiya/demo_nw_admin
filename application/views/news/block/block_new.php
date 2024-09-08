<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Block</h4>
                    <div class="nk-block-des text-soft">
                        <p>New Block</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-block" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form id="myForm" action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_one">Block One *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_one" placeholder="Enter block one" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_two">Block Two *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_two" placeholder="Enter block two" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_three">Block Three *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_three" placeholder="Enter block three" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_four">Block Four *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_four" placeholder="Enter block four" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_five">Block Five *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control textarea-block" name="block_five" placeholder="Enter block five" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="block_status">Block Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="block_status" data-placeholder="Select a status" required>
                                        <option value="publish">Publish</option>
                                        <option value="unpublish">Unpublish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary submitButton" name="submit" value="Save Informations">
                                <div class="loadingButton">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span>Save Informations</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        const form = this;
        if (form.checkValidity()) {
            document.querySelector('.submitButton').style.display = 'none';
            document.querySelector('.loadingButton').style.display = 'block';
        } else {
            event.preventDefault();
        }
    });
</script>