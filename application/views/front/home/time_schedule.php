

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

    
    
    <!-- Start Display Time Schedule -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Time Schedule</h3>
        </div>
        <div class="col-sm">
            <button type="button" data-toggle="modal" data-target="#addTs" class ="btn btn-info">Add New </button>
        </div>
    </div>


    <table class="table table-bordered">

        <tbody> 
            <?php foreach ($timescheduling as $ts) { ?>
                <tr>
                    <td width="80%" class="text-left"><span><?php echo $ts->clinic_name; ?> <em>(<?php echo $ts->time_from . " - " . $ts->time_to; ?>)</em><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $ts->days; ?> </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span> <?php echo $ts->fees . "$"; ?> </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em> <?php echo $ts->address; ?></em></td><td width="20%" class="text-right"><a class="btn btn-primary text-white" href="<?php echo base_url('editTime/') . $ts->t_id; ?>">Edit</a><a class="btn btn-danger text-white" href="<?php echo base_url('delTime/') . $ts->t_id; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
<!-- End Display Time Schedule -->
<!--Start Add Time Scheduling -->
<div class="dc-haslayout dc-main-section">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                <div class="dc-registerformhold">
                    <div class="dc-registerformmain">
                        <div class="dc-registerhead">
                            <div class="dc-title">
                                <h3>Add Time Scheduling</h3>
                            </div>
                        </div>
                        <div class="dc-joinforms">
                        <?php if(isset($tx->t_id)){ ?>
                                <form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('updTime') ?>"  enctype="multipart/form-data">
                        <?php }else{ ?>
                                <form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('addTime') ?>"  enctype="multipart/form-data">
                        <?php } ?>
                                <fieldset class="dc-registerformgroup">
                                    <input type="hidden" name ="t_id" value="<?php if(isset($t_id)){ echo $t_id;} ?>">
                                    <div >
                                        <h5 class="font-weight-normal" >Clinic/Hospital Name</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="clinic_name" value="<?php if(isset($tx->clinic_name)){ echo $tx->clinic_name;} ?>" >
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="font-weight-normal" >Address</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name="address" value="<?php if(isset($tx->address)){ echo $tx->address;} ?>">
                                        </span>
                                    </div>
                                    <div >
                                        <h5 class="font-weight-normal" >Day(s) <small>Like: Friday, Saturday etc</small></h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="days" value="<?php if(isset($tx->days)){ echo $tx->days;} ?>" >
                                        </span>
                                    </div>
                                    <div >
                                        <h5 class="font-weight-normal" >Fees ($)</h5>
                                        <span class="">
                                            <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" name ="fees" value="<?php if(isset($tx->fees)){ echo $tx->fees;} ?>" >
                                        </span>
                                    </div>
                                    <div class="form-group  form-group-half">
                                        <h5 class="font-weight-normal">Time (From)<small>In 24 Hours</small> </h5>
                                        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="time_from"   class="form-control" placeholder="" value="<?php if(isset($tx->time_from)){ echo $tx->time_from;} ?>">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <h5 class="font-weight-normal">Time (To)<small>In 24 Hours</small> </h5>
                                        <input type="text"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="time_to" class="form-control" placeholder=""  value="<?php if(isset($tx->time_to)){ echo $tx->time_to;} ?>" >
                                    </div>
                                </fieldset>
                                <div class="dc-checkboxholder">
                                    <button class="dc-btn"><?php if(isset($tx->t_id)){ echo "Update";}else{ echo "Add"; } ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End  Add Time Scheduling -->


</div>
