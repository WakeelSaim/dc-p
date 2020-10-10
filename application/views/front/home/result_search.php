<div class="dc-haslayout dc-main-section">
    <!-- User Listing Start-->
    <div class="container">
        <div class="row">
            <div id="dc-twocolumns" class="dc-twocolumns dc-haslayout">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 float-left">
                    <div class="dc-searchresult-holder">
                        <div class="dc-searchresult-head">
                            <div class="dc-title"><h4><?php echo $no_result; ?> matches found for:<strong> <?php echo $query; ?></strong></h4></div>
                            
                        </div>
                        <div class="dc-searchresult-grid dc-searchresult-list">
                            <?php foreach($result as $r) { ?>
                            <div class="dc-docpostholder">
                                <figure class="dc-docpostimg">
                                    <img class="img-fluid" width="144" height="144"  src=<?php echo base_url().$r->image_path; ?> alt="img description">
                                    <figcaption>
                                        <span class="dc-featuredtag"><i class="fa fa-bolt"></i></span>
                                    </figcaption>
                                </figure>
                                <div class="dc-docpostcontent">
                                    <div class="dc-title">
                                        <h3><a href="<?php echo base_url('profile/').$r->id; ?>"><?php echo $r->first_name." ".$r->last_name; ?> </a> <i class="fa fa-award dc-awardtooltip"><em>Medical Registration Verified</em></i> <i class="fa fa-check-circle dc-awardtooltip"><em>Medical Registration Verified</em></i></h3>
                                        <ul class="dc-docinfo">
                                            <li>
                                                <em>MBBS, MCPS, MSc (Immunology)</em>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="dc-doclocation dc-doclocationvtwo">
                                        <span><i class="ti-direction-alt"></i> Manchester, UK</span>
                                        <span><i class="ti-calendar"></i> Mo, Tu, <em class="dc-dayon">We</em>, Th, Fr, Sa</span>
                                        <div class="dc-btnarea">
                                            <a href="javascript:void(0);" class="dc-btn">Book Now</a>
                                            <a href="javascript:void(0);" class="dc-like"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- User Listing End-->
    </div>

</div>
<!-- Emerging Clients End -->
