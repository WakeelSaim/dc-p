<div class="dc-haslayout dc-main-section">
                            <?php foreach($record As $r){
                                    $fn = $r->first_name;
                                    $ln = $r->last_name;
                                    $dob = $r->dob;
                                    $address = $r->address;
                                    $ccode = $r->country_code;
                                    $country = $r->country;
                                    $contact_no = $r->contact_no;
                                    $gender = $r->gender;
                                    $about = $r->about;
                                    $join_as = $r->join_as;
                                    $image_path = $r->image_path;
                            } ?>
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                                        <div class="dc-registerformhold">
                                            <div class="dc-registerformmain">
                                                <div class="dc-registerhead">
                                                    <div class="dc-title">
                                                        <h3>Edit Profile</h3>
                                                    </div>

                                                </div>
                                                <div class="dc-joinforms">


                                                    <form class="dc-formtheme dc-formregister" method="post" action="<?= base_url('edited') ?>"  enctype="multipart/form-data">

                                                        <fieldset class="dc-registerformgroup">
                                                            <div class="row">
                                                                <div class="col-lg-4"></div>
                                                                <div class="col-lg-4">
                                                                    <img class="rounded-circle z-depth-2" alt="100x100" src="<?php echo base_url() . $image_path; ?>" data-holder-rendered="true" width="200" height="200">
                                                                </div>
                                                                <div class="col-lg-4"></div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4"></div>
                                                                <div class="col-lg-4">
                                                                    <label for="exampleFormControlFile1">Upload Picture</label>
                                                                    <input type="file" class="form-control-file" id="img" name="img">
                                                                </div>
                                                                <div class="col-lg-4"></div>
                                                            </div>
                                                            <?php if ($this->session->flashdata('image_error')) { ?>

                                                                <div class="alert alert-danger" role="alert">
                                                                    <?= $this->session->flashdata('image_error') ?>
                                                                </div>
                                                            <?php } ?>

                                                        </fieldset>
                                                        <fieldset class="dc-registerformgroup">
                                                            <div class="form-group  form-group-half">
                                                                <h5 class="font-weight-normal">First Name</h5>
                                                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value=" <?php echo $fn; ?> ">
                                                            </div>
                                                            <div class="form-group form-group-half">
                                                                <h5 class="font-weight-normal">Last Name</h5>
                                                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value=" <?php echo $ln ?> ">
                                                            </div>
                                                        </fieldset>
                                                        <fieldset class="dc-registerformgroup">
                                                            <div class="form-group form-group-half">
                                                                <h5 class="font-weight-normal">Date of birth</h5>
                                                                <input placeholder="Date of Birth" class="form-control" type="text" onfocus="(this.type='date')" id="date" name = "dob" value="<?php echo $dob; ?>" >
                                                            </div>
                                                            <div class="form-group form-group-half">
                                                                <h5 class="font-weight-normal">Gender</h5>	
                                                                <span class="dc-select">
                                                                    <select name="gender" value="  ">
                                                                        <option value="male" <?php if ($gender == 'male') {  echo "SELECTED";} ?>>Male</option>
                                                                        <option value="female" <?php if ($gender == 'female') { echo "SELECTED"; } ?>>Female</option>
                                                                    </select>
                                                                </span>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset class="dc-registerformgroup">
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <h5 class="font-weight-normal">Country</h5>
                                                                        <span class="dc-select">
                                                                            <select class="form-control" style="height:50px;" name="country" required>
                                                                                <option value="PAK">Pakistan</option><?php foreach ($dropdown as $row): ?>
                                                                                    <option value="<?php echo $row->nicename; ?>" <?php if ($row->nicename == $country) {echo "SELECTED";    } ?>><?php echo $row->nicename; ?></option><?php endforeach; ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <h5 class="font-weight-normal">Country Code</h5>
                                                                        <span class="dc-select">
                                                                            <select class="form-control" style="height:50px;" name="country_code" required>
                                                                                <option value="PAK">Pakistan +92</option><?php foreach ($dropdown as $row): ?>
                                                                                    <option value="<?php echo $row->iso; ?>" <?php if ($row->iso == $ccode) { echo "SELECTED";} ?>><?php echo $row->nicename . "         +" . $row->phonecode; ?></option><?php endforeach; ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <h5 class="font-weight-normal">Contact No</h5>
                                                                        <span class="">
                                                                            <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="contact_no" class="form-control" placeholder="Contact No"/ value="<?php echo $contact_no; ?>">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <h5 class="font-weight-normal">Start as :</h5>
                                                                <ul class="dc-startoption">
                                                                    <li>
                                                                        <span class="dc-radio">
                                                                            <input id="dc-hospital" type="radio" name="typejoin" value="hospital" <?php if ($join_as == "hospital") {    echo "checked";} ?>  >
                                                                            <label for="dc-hospital">Hospital</label>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="dc-radio">
                                                                            <input id="dc-doctor" type="radio" name="typejoin" value="doctor" <?php if ($join_as == "doctor") {    echo "checked";} ?>>
                                                                            <label for="dc-doctor">Doctor</label>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="dc-radio">
                                                                            <input id="dc-regularuser" type="radio" name="typejoin" value="regular_user" <?php if ($join_as == "regular_user") {    echo "checked";} ?>>
                                                                            <label for="dc-regularuser">Regular User</label>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                <div>
                                                                    <h5 class="font-weight-normal">Address</h5>
                                                                    <input type="text" name="address" class="form-control" value = "<?php echo $address; ?>">
                                                                </div>
                                                                <div> 
                                                                    <h5 class="font-weight-normal">About yourself</h5>
                                                                    <textarea name="about" rows="10" cols="30" class="form-control"><?php echo $about; ?>
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <fieldset class="dc-registerformgroup">
                                                            <div class="form-group  form-group-half">
                                                                <div class="dc-checkboxholder">
                                                                    <button class="dc-btn">Update</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-half">
                                                                <div class="dc-checkboxholder">
                                                                    <a href="<?= base_url('edit_bio') ?>" name ="edit" class="dc-btn">Edit or Add new details</a>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        
                                                        
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>		
                            </div>
                        </div>