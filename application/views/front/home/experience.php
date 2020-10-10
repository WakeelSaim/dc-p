


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




<!--Start Display Experience -->
   
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Experience</h3>
        </div>
        <div class="col-sm">
            <button type="button" data-toggle="modal" data-target="#addExperience" class ="btn btn-info">Add New </button>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody>     
            <?php foreach ($experience as $e) { ?>
                <tr>
                    <td width="80%" class="text-left"><span><?php echo $e->job_title; ?> <em>(<?php echo $e->exp_year_from . " - " . $e->exp_year_to; ?>)</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo $e->location; ?></em></td><td width ="20%" class="text-right"><a class="btn btn-primary text-white" href="<?php echo base_url('editExp/') . $e->exp_id; ?>"  >Edit</a><a class="btn btn-danger text-white" href="<?php echo base_url('delExp/') . $e->exp_id; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<!--End Display Experience -->
<!--Start Add Experience -->
<div class="dc-haslayout dc-main-section">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                <div class="dc-registerformhold">
                    <div class="dc-registerformmain">
                        <div class="dc-registerhead">
                            <div class="dc-title">
                                <h3>Add Experience</h3>
                            </div>
                        </div>
                        <div class="dc-joinforms">
                            <?php if(isset($ex->exp_id)){ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('updExp') ?>"  enctype="multipart/form-data">
<?php }else{ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('addExp') ?>"  enctype="multipart/form-data">
<?php } ?>
                                <fieldset class="dc-registerformgroup">
                                    <input type="hidden" name ="exp_id" value="<?php if(isset($ex->exp_id)){ echo $ex->exp_id;} ?>">
                                    <div >
                                        <h5 class="font-weight-normal" >Job Title</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="job_title" value="<?php if(isset($ex->job_title)){ echo $ex->job_title;} ?>" >
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="font-weight-normal" >Location</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name="location" value="<?php if(isset($ex->location)){ echo $ex->location;} ?>">
                                        </span>
                                    </div>
                                    <div class="form-group  form-group-half">
                                        <h5 class="font-weight-normal">Year (From) </h5>
                                        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="exp_year_from"   class="form-control" placeholder="Year From" value="<?php if(isset($ex->exp_year_from)){ echo $ex->exp_year_from;} ?>">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <h5 class="font-weight-normal">Year (To) </h5>
                                        <input type="text"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="exp_year_to" class="form-control" placeholder="Year To"  value="<?php if(isset($ex->exp_year_to)){ echo $ex->exp_year_to;} ?>" >
                                    </div>
                                </fieldset>
                                <div class="dc-checkboxholder">
                                    <button class="dc-btn"><?php if(isset($ex->exp_id)){ echo "Update";}else{ echo "Add";} ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End  Add Experience -->
</div>