<div class="nk-content-wrap">
    <div class="nk-block nk-block-lg">
        
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="title nk-block-title">Contact</h4>
                    <div class="nk-block-des text-soft">
                        <p>Edit Contact</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="<?php echo base_url(); ?>view-contact" class="btn btn-outline-light bg-white d-block d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div>
        
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="" method="post" class="form-validate is-alter" enctype="multipart/form-data">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_name">Contact Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="contact_name" value="<?php echo $contactData['contact_name']; ?>" placeholder="Enter contact name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_email">Contact Email *</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" name="contact_email" value="<?php echo $contactData['contact_email']; ?>" placeholder="Enter contact email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_message">Contact Message *</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="contact_message" placeholder="Enter contact message" required><?php echo $contactData['contact_message']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_date">Contact Date *</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" name="contact_date" value="<?php echo $contactData['contact_date']; ?>" placeholder="Enter contact date" data-date-format="dd/mm/yyyy" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact_status">Contact Status *</label>
                                <div class="form-control-wrap">
                                    <select class="form-control form-select js-select2" name="contact_status" data-placeholder="Select a status" required>
                                        <option value="publish"<?php if($contactData['contact_status'] =="publish"){ echo "selected"; } else { echo ""; } ?>>Publish</option>
                                        <option value="unpublish"<?php if($contactData['contact_status'] =="unpublish"){ echo "selected"; } else { echo ""; } ?>>Unpublish</option> 
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