

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

   <!-- Start Display Specialization -->
   
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h3>Specialization</h3>
        </div>
        <div class="col-sm">
            <button type="button" data-toggle="modal" data-target="#addSpecialization" class ="btn btn-info">Add New </button>
        </div>
    </div>


    <table class="table table-bordered">
        <tbody> 
            <?php foreach ($specialization as $sp) { ?>
                <tr>
                    <td width="80%" class="text-left"><span><?php echo $sp->s_title; ?> </td><td width ="20%" class="text-right"><a class="btn btn-primary text-white" href="<?php echo base_url('editSp/') . $sp->sp_id; ?>">Edit</a><a class="btn btn-danger text-white" href="<?php echo base_url('delSp/') . $sp->sp_id; ?>">Delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<!-- End Display Specialization -->

<!--Start Add Specialization -->
<div class="dc-haslayout dc-main-section">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                <div class="dc-registerformhold">
                    <div class="dc-registerformmain">
                        <div class="dc-registerhead">
                            <div class="dc-title">
                                <h3>Add Specialization</h3>
                            </div>
                        </div>
                        <div class="dc-joinforms">
                            <?php if(isset($spx->sp_id)){ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('updSp') ?>"  enctype="multipart/form-data">
<?php }else{ ?>
	<form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('addSp') ?>"  enctype="multipart/form-data">
<?php } ?>
                                <fieldset class="dc-registerformgroup">
                                    <input type="hidden" name ="sp_id" value="<?php if(isset($spx->sp_id)){ echo $spx->sp_id;} ?>">
                                    <div >
                                        <h5 class="font-weight-normal" >Specialization</h5>
                                        <span class="">
                                            <input type="text" class="form-control" name ="s_title" value="<?php if(isset($spx->s_title)){ echo $spx->s_title;} ?>" >
                                        </span>
                                    </div>
                                    
                                </fieldset>
                                <div class="dc-checkboxholder">
                                    <button class="dc-btn"><?php if(isset($spx->sp_id)){ echo "Update";}else{ echo "Add"; } ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End  Add Specialization -->

</div>