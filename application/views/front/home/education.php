

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

    
    
    <!-- Start Display Education -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Education</h3>
        </div>
        <div class="col-sm">
            <button type="button" data-toggle="modal" data-target="#addEducation" class ="btn btn-info">Add New </button>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody>
            <?php foreach ($education as $ed) { ?>
                <tr>
                    <td width="80%" class="text-left"><span><?php echo $ed->degree_name; ?> <em>( <?php echo $ed->edu_year_from . " - " . $ed->edu_year_to; ?> )</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo $ed->institute_name; ?></em></td><td width ="20%" class="text-right"><a class="btn btn-primary text-white" href="<?php echo base_url('editEdu/') . $ed->edu_id; ?>">Edit</a><a class="btn btn-danger text-white" href="<?php echo base_url('delEdu/') . $ed->edu_id; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>   
<!-- End Display Education -->
<!--Start Add Education -->
<div class="dc-haslayout dc-main-section">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                <div class="dc-registerformhold">
                    <div class="dc-registerformmain">
                        <div class="dc-registerhead">
                            <div class="dc-title">
                                <h3>Add Education</h3>
                            </div>
                        </div>
                        <div class="dc-joinforms">
                            <?php if(isset($edx->edu_id)){ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('updEdu') ?>"  enctype="multipart/form-data">
<?php }else{ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('addEdu') ?>"  enctype="multipart/form-data">
<?php } ?>
                                <fieldset class="dc-registerformgroup">
                                    <input type="hidden" name ="edu_id" value="<?php if(isset($edx->edu_id)){ echo $edx->edu_id;} ?>">
                                    <div >
                                        <h5 class="font-weight-normal" >Degree Name</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="degree_name" value="<?php if(isset($edx->degree_name)){ echo $edx->degree_name;} ?>" >
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="font-weight-normal" >Institute Name</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name="institute_name" value="<?php if(isset($edx->institute_name)){ echo $edx->institute_name;} ?>">
                                        </span>
                                    </div>
                                    <div class="form-group  form-group-half">
                                        <h5 class="font-weight-normal">Year (From) </h5>
                                        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="edu_year_from"   class="form-control" placeholder="Year From" value="<?php if(isset($edx->edu_year_from)){ echo $edx->edu_year_from;} ?>">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <h5 class="font-weight-normal">Year (To) </h5>
                                        <input type="text"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="edu_year_to" class="form-control" placeholder="Year To"  value="<?php if(isset($edx->edu_year_to)){ echo $edx->edu_year_to;} ?>" >
                                    </div>
                                </fieldset>
                                <div class="dc-checkboxholder">
                                    <button class="dc-btn"><?php if(isset($edx->edu_id)){ echo "Update";}else{ echo "Add"; } ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End  Add Education -->

</div>