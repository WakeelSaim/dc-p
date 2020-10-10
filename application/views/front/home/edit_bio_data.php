


<div class ="container">
    
    
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
            <a class ="btn btn-info" href="<?php echo base_url('add-editExp'); ?>">Add New / Edit </a>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody>     
            <?php foreach ($experience as $e) { ?>
                <tr>
                    <td class="text-left"><span><?php echo $e->job_title; ?> <em>(<?php echo $e->exp_year_from . " - " . $e->exp_year_to; ?>)</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo $e->location; ?></em></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<!--End Display Experience -->


<!-- Start Display Education -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Education</h3>
        </div>
        <div class="col-sm">
            <a class ="btn btn-info" href="<?php echo base_url('add-editEdu'); ?>">Add New / Edit </a>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody>
            <?php foreach ($education as $ed) { ?>
                <tr>
                    <td  class="text-left"><span><?php echo $ed->degree_name; ?> <em>( <?php echo $ed->edu_year_from . " - " . $ed->edu_year_to; ?> )</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo $ed->institute_name; ?></em></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>   
<!-- End Display Education -->

<!-- Start Display Award -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Awards</h3>
        </div>
        <div class="col-sm">
            <a class ="btn btn-info" href="<?php echo base_url('add-editAward'); ?>">Add New / Edit </a>
        </div>
    </div>


    <table class="table table-bordered">

        <tbody> 
            <?php foreach ($awards as $aw) { ?>
                <tr>
                    <td class="text-left"><span><?php echo $aw->award_title . " by " . $aw->award_by; ?>  <em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $aw->year; ?> )</em></span></td
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<!-- End Display Award -->

   
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Specialization</h3>
        </div>
        <div class="col-sm">
            <a class ="btn btn-info" href="<?php echo base_url('add-editSp'); ?>">Add New / Edit </a>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody> 
            <?php foreach ($specialization as $sp) { ?>
                <tr>
                    <td class="text-left"><?php echo $sp->s_title; ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<!-- End Display Specialization -->


<!-- Start Display Time Schedule -->

<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Time Schedule</h3>
        </div>
        <div class="col-sm">
            <a class ="btn btn-info" href="<?php echo base_url('add-editTime'); ?>">Add New / Edit </a>
        </div>
    </div>


    <table class="table table-bordered">

        <tbody> 
            <?php foreach ($timescheduling as $ts) { ?>
                <tr>
                    <td class="text-left"><span><?php echo $ts->clinic_name; ?> <em>(<?php echo $ts->time_from . " - " . $ts->time_to; ?>)</em><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $ts->days; ?> </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span> <?php echo $ts->fees . "$"; ?> </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em> <?php echo $ts->address; ?></em></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
<!-- End Display Time Schedule -->



<!-- Add new Experience -->
<div id="addExperience" class="modal fade">
    <div class="modal-dialog">
        <form action="<?= base_url('addExp') ?>" method="post" id="exp_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Experience</h4>
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Job Title</label>
                    <input type="text" class="form-control" name="job_title" />
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" />
                    <label>Year<em>(From)</em></label>
                    <input type="text" class="form-control" name="exp_year_from"conkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                    <label>Year<em>(To)</em></label>
                    <input type="text" class="form-control" name="exp_year_to" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </form> 
    </div>
</div>

<!-- End Add Experience -->

<!-- Add new Education -->
<div id="addEducation" class="modal fade">
    <div class="modal-dialog">
        <form action="<?= base_url('addEdu') ?>" method="post" id="edu_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Education</h4>
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Degree</label>
                    <input type="text" class="form-control" name="degree_title" />
                    <label>Institute</label>
                    <input type="text" class="form-control" name="institute_name" />
                    <label>Year<em>(From)</em></label>
                    <input type="text" class="form-control" name="edu_year_from" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                    <label>Year<em>(To)</em></label>
                    <input type="text" class="form-control" name="edu_year_to" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </form> 
    </div>
</div>

<!-- End Add Education -->
      

<!-- Add new Award -->
<div id="addAward" class="modal fade">
    <div class="modal-dialog">
        <form action="<?= base_url('addAwrd') ?>" method="post" id="awrd_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Award</h4>
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Award</label>
                    <input type="text" class="form-control" name="award_title" />
                    <label>Award By</label>
                    <input type="text" class="form-control" name="award_by" />
                    <label>Year></label>
                    <input type="text" class="form-control" name="year" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </form> 
    </div>
</div>

<!-- End Add Award -->


<!-- Add new Specialization -->
<div id="addSpecialization" class="modal fade">
    <div class="modal-dialog">
        <form action="<?= base_url('addSp') ?>" method="post" id="sp_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Specialization</h4>
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Specialization</label>
                    <input type="text" class="form-control" name="s_title" />
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </form> 
    </div>
</div>

<!-- End Add Specialization -->

<!-- Add new Time Schedule -->
<div id="addTs" class="modal fade">
    <div class="modal-dialog">
        <form action="<?= base_url('addTime') ?>" method="post" id="ts_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Time Schedule</h4>
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Clinic Name</label>
                    <input type="text" class="form-control" name="clinic_name" />
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" />
                    <label>Day<small>(s) Like: Sunday, Monday etc.</small></label>
                    <input type="text" class="form-control" name="days" />
                    <label>fees<small>($)</small></label>
                    <input type="text" class="form-control" name="fees" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                    <label>Time<small> (From) (In 24 Hour format)</small></label>
                    <input type="text" class="form-control" name="time_from" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                    <label>Time<small> (To) (In 24 Hour format)</small></label>
                    <input type="text" class="form-control" name="time_to" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </form> 
    </div>
</div>
</div>
<!-- End Add Time Schedule -->


