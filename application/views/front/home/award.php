

<div class ="container">
    
    <a class ="btn btn-info" href="<?php echo base_url('edit_bio'); ?>"> Back </a>
    <?php if ($this->session->flashdata('deleted')) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('deleted'); ?>
            </div>
    <?php } ?>
    <?php if ($this->session->flashdata('n_deleted')) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('n_deleted'); ?>
            </div>
    <?php } ?>
    <?php if ($this->session->flashdata('updated_success')) { ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('updated_success'); ?>
            </div>
    <?php } ?>
    <?php if ($this->session->flashdata('insert_success')) { ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('insert_success'); ?>
            </div>
    <?php } ?>
    <?php if ($this->session->flashdata('n_updated_success')) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('n_updated_success'); ?>
            </div>
    <?php } ?>

    <?php if ($this->session->flashdata('data_error')) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('data_error'); ?>
            </div>
    <?php } ?>

    
    
    <!-- Start Display Award -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Awards</h3>
        </div>
        <div class="col-sm">
            <button type="button" data-toggle="modal" data-target="#addAward" class ="btn btn-info">Add New </button>
        </div>
    </div>


    <table class="table table-bordered">

        <tbody> 
            <?php foreach ($awards as $aw) { ?>
                <tr>
                    <td width="80%" class="text-left"><span><?php echo $aw->award_title . " by " . $aw->award_by; ?>  <em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $aw->year; ?> )</em></span></td><td width ="20%" class="text-right"><a class="btn btn-primary text-white" href="<?php echo base_url('editAwrd/') . $aw->awrd_id; ?>">Edit</a><a class="btn btn-danger text-white" href="<?php echo base_url('delAwrd/') . $aw->awrd_id; ?>">Delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<!-- End Display Award -->
<!--Start Add Awards -->
<div class="dc-haslayout dc-main-section">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                <div class="dc-registerformhold">
                    <div class="dc-registerformmain">
                        <div class="dc-registerhead">
                            <div class="dc-title">
                                <h3>Add Awards</h3>
                            </div>
                        </div>
                        <div class="dc-joinforms">
                            <?php if(isset($awx->awrd_id)){ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('updAwrd') ?>"  enctype="multipart/form-data">
<?php }else{ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('addAwrd') ?>"  enctype="multipart/form-data">
<?php } ?>
                                <fieldset class="dc-registerformgroup">
                                    <input type="hidden" name ="awrd_id" value="<?php if(isset($awx->awrd_id)){ echo $awx->awrd_id;} ?>">
                                    <div >
                                        <h5 class="font-weight-normal" >Award Title</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="award_title" value="<?php if(isset($awx->award_title)){ echo $awx->award_title;} ?>" >
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="font-weight-normal" >Award By</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name="award_by" value="<?php if(isset($awx->award_by)){ echo $awx->award_by;} ?>">
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="font-weight-normal">Year </h5>
                                        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="year"   class="form-control" placeholder="Year From" value="<?php if(isset($awx->year)){ echo $awx->year;} ?>">
                                    </div>
                                    
                                </fieldset>
                                <div class="dc-checkboxholder">
                                    <button class="dc-btn"><?php if(isset($awx->awrd_id)){ echo "Update";}else{ echo "Add"; } ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End  Add Award -->

</div>

