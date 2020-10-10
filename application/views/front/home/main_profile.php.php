<main id="dc-main" class="dc-main dc-haslayout">
			<!-- About Welcome Start -->
			<!-- About Welcome Start -->
			<div class="dc-haslayout dc-main-section">
				<!-- User Listing Start-->
				<div class="container">
					<div class="row">
								<div class="dc-docsingle-header">
									<figure class="dc-docsingleimg">
										<img src="<?php echo base_url().$this->session->image; ?>" alt="img description">
										<figcaption>
											<span class="dc-featuredtag"><i class="fa fa-bolt"></i></span>
										</figcaption>
									</figure>
									<div class="dc-docsingle-content">
										<div class="dc-title">
											<a href="javascript:void(0)" class="dc-docstatus">Neurosurgeon</a>
											<h2><a href="javascript:void(0);"><?php echo $this->session->name; ?></a> <i class="fa fa-award dc-awardtooltip"><em>Medical Registration Verified</em></i> <i class="fa fa-check-circle dc-awardtooltip"><em>Medical Registration Verified</em></i></h2>
											<ul class="dc-docinfo">
												<li>
													<em></em>
												</li>
												<li>
													<span class="dc-stars"><span></span></span><em>2100 Feedback</em>
												</li>
											</ul>
											<a href="javascript:void(0);" class="dc-like"><i class="fa fa-heart"></i></a>
										</div>
										<div class="dc-description">
											<p><?php echo $bio_data->address; ?></p>
										</div>
										<div class="dc-btnarea">
											<a href="<?= base_url('edit_profile') ?>" class="dc-btn" >Edit Profile</a>
											
										</div>
									</div>
								</div>
								<div class="dc-docsingle-holder">
									<ul class="dc-navdocsingletab nav navbar-nav">
										
										<li class="nav-item">
											<a class="active" id="userdetails-tab" data-toggle="tab" href="#userdetails">User Details</a>
										</li>
										<li class="nav-item">
											<a id="timeschedule-tab" data-toggle="tab" href="#timeschedule">Time Schedule</a>
										</li>
										<li class="nav-item">
											<a id="feedback-tab" data-toggle="tab" href="#feedback">Feedback</a>
										</li>
										<li class="nav-item">
											<a id="articles-tab" data-toggle="tab" href="#articles">Articles</a>
										</li>
									</ul>
									<div class="tab-content dc-haslayout">
										<div class="dc-contentdoctab dc-userdetails-holder tab-pane fade active show" id="userdetails">
											<div class="dc-aboutdoc dc-aboutinfo">
												<div class="dc-infotitle">
													<h3>About "<?php echo $this->session->userdata('name'); ?>”</h3>
												</div>
												<div class="dc-description"><p><?php echo $bio_data->about; ?></p></div>
											</div>
											<div class="dc-experiencedoc dc-aboutinfo">
												<div class="dc-infotitle">
													<h3>Experience</h3>
												</div>
												<ul class="dc-expandedu">
                                                                                                    <?php foreach($experience as $e){ ?>
													<li><span><?php echo $e->job_title; ?> <em>( <?php echo $e->exp_year_from." - ".$e->exp_year_to; ?> )</em></span><em><?php echo $e->location; ?></em></li>
                                                                                                    <?php } ?>
												</ul>
											</div>
											<div class="dc-education-holder dc-aboutinfo">
												<div class="dc-infotitle">
													<h3>Education</h3>
												</div>
												<ul class="dc-expandedu">
                                                                                                    <?php foreach($education as $ed){ ?>
                                                                                                    <li><span><?php echo $ed->degree_name; ?> <em>( <?php echo $ed->edu_year_from." - ".$ed->edu_year_to; ?> )</em></span><em><?php echo $ed->institute_name; ?></em></li>
                                                                                                    <?php } ?>
												</ul>
											</div>
											<div class="dc-specializations dc-aboutinfo">
												<div class="dc-infotitle">
													<h3>Specializations</h3>
												</div>
												<ul class="dc-specializationslist">
                                                                                                    <?php foreach($specialization as $sp) { ?>
													<li><span><?php echo $sp->s_title; ?></span></li>
                                                                                                    <?php } ?>
												</ul>
											</div>
											<div class="dc-awards-holder dc-aboutinfo">
												<div class="dc-infotitle">
													<h3>Awards and Recognitions</h3>
												</div>
												<ul class="dc-expandedu">
                                                                                                    <?php foreach($awards as $aw){ ?>
													<li><span><?php echo $aw->award_title." by ".$aw->award_by; ?>  <em>( <?php echo $aw->year; ?> )</em></span></li>
                                                                                                    <?php } ?>
												</ul>
											</div>
											
											
										</div>
										<div class="dc-contentdoctab dc-timeschedule-holder tab-pane" id="timeschedule">
											<div class="dc-timeschedule">
												<div class="dc-searchresult-head">
													<div class="dc-title"><h4><?php echo $this->session->name; ?></h4></div>
													
												</div>
                                                                                                <div class="dc-experiencedoc dc-aboutinfo">
                                                                                                <div class="dc-infotitle">
                                                                                                    <h3>Time Schedule</h3>
                                                                                                </div>
                                                                                                <ul class="dc-expandedu">
                                                                                                    
                                                                                                    <?php foreach ($timescheduling as $ts) { ?>
                                                                                                            
                                                                                                                <li><span><?php echo $ts->clinic_name; ?> <em>(<?php echo $ts->time_from." - ".$ts->time_to; ?>)</em> <?php echo $ts->days; ?> </span> <span> <?php echo $ts->fees."$"; ?> </span> <em> <?php echo $ts->address; ?></em></li>
                                                                                                            
                                                                                                        <?php } ?>
                                                                                                   
                                                                                                </ul>
                                                                                            </div>
												
											</div>
											<div class="dc-shareprofile">
												<ul class="dc-simplesocialicons dc-socialiconsborder">
													<li class="dc-sharecontent"><span>Share Profile:</span></li>
													<li class="dc-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
													<li class="dc-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
													<li class="dc-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
													<li class="dc-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
													<li class="dc-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="dc-contentdoctab dc-feedback-holder tab-pane" id="feedback">
											<div class="dc-feedback">
												<div class="dc-searchresult-head">
													<div class="dc-title"><h4>Patient Feedback</h4></div>
													<div class="dc-rightarea">
														<div class="dc-select">
															<select>
																<option value="Sort By:">Sort By:</option>
																<option value="Sort By:">Last created on top</option>
																<option value="Sort By:">Last modified on top</option>
																<option value="Sort By:">Alphabetically (A-Z)</option>
																<option value="Sort By:">Alphabetically (Z-A)</option>
															</select>
														</div>
													</div>
												</div>
												<div class="dc-consultation-content dc-feedback-content">
													<div class="dc-consultation-details">
														<figure class="dc-consultation-img">
															<img src="images/feedback/img-01.jpg" alt="img description">
														</figure>
														<div class="dc-consultation-title">
															<h5><a href="javascript:void(0);">Visited For Dental Checkup (General)</a><em>Carolin Summerlin <i class="fa fa-check-circle"></i></em></h5>
															<span>Mar 27, 2019</span>
														</div>
														<div class="dc-description">
															<p>Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.<a href="javascript:void(0);">(more)</a></p>
															<a href="javascript:void(0);"><i class="ti-thumb-up"></i>I Recommend This Doctor</a>
														</div>
													</div>
													<div class="dc-consultation-details">
														<figure class="dc-consultation-img">
															<img src="images/feedback/img-02.jpg" alt="img description">
														</figure>
														<div class="dc-consultation-title">
															<h5><a href="javascript:void(0);">Visited For Conservative Dentistry</a><em>Charlene Trippe <i class="fa fa-check-circle"></i></em></h5>
															<span>Mar 27, 2019</span>
														</div>
														<div class="dc-description">
															<p>Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.<a href="javascript:void(0);">(more)</a></p>
															<a href="javascript:void(0);" class="dontrecommend"><i class="ti-thumb-up"></i>I Don’t Recommend</a>
														</div>
													</div>
													<div class="dc-consultation-details">
														<figure class="dc-consultation-img">
															<img src="images/feedback/img-03.jpg" alt="img description">
														</figure>
														<div class="dc-consultation-title">
															<h5><a href="javascript:void(0);">Visited For Teeth Sensitive to Hot and Cold</a><em>Mardell Buchan <i class="fa fa-check-circle"></i></em></h5>
															<span>Mar 27, 2019</span>
														</div>
														<div class="dc-description">
															<p>Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.<a href="javascript:void(0);">(more)</a></p>
															<a href="javascript:void(0);"><i class="ti-thumb-up"></i>I Recommend This Doctor</a>
														</div>
													</div>
													<div class="dc-consultation-details">
														<figure class="dc-consultation-img">
															<img src="images/feedback/img-04.jpg" alt="img description">
														</figure>
														<div class="dc-consultation-title">
															<h5><a href="javascript:void(0);">Visited For Dental Fillings</a><em>Angie Michell <i class="fa fa-check-circle"></i></em></h5>
															<span>Mar 27, 2019</span>
														</div>
														<div class="dc-description">
															<p>Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.<a href="javascript:void(0);">(more)</a></p>
															<a href="javascript:void(0);" class="dontrecommend"><i class="ti-thumb-up"></i>I Don’t Recommend</a>
														</div>
													</div>
													<div class="dc-consultation-details">
														<figure class="dc-consultation-img">
															<img src="images/feedback/img-05.jpg" alt="img description">
														</figure>
														<div class="dc-consultation-title">
															<h5><a href="javascript:void(0);">Visited For Toothache, Loose Teeth</a><em>Katheleen Friesen <i class="fa fa-check-circle"></i></em></h5>
															<span>Mar 27, 2019</span>
														</div>
														<div class="dc-description">
															<p>Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.<a href="javascript:void(0);">(more)</a></p>
															<a href="javascript:void(0);"><i class="ti-thumb-up"></i>I Don’t Recommend</a>
														</div>
													</div>
													<nav class="dc-pagination">
														<ul>
															<li class="dc-prevpage"><a href="javascrip:void(0);"><i class="lnr lnr-chevron-left"></i></a></li>
															<li><a href="javascrip:void(0);">1</a></li>
															<li><a href="javascrip:void(0);">2</a></li>
															<li><a href="javascrip:void(0);">3</a></li>
															<li><a href="javascrip:void(0);">4</a></li>
															<li><a href="javascrip:void(0);">...</a></li>
															<li><a href="javascrip:void(0);">50</a></li>
															<li class="dc-nextpage"><a href="javascrip:void(0);"><i class="lnr lnr-chevron-right"></i></a></li>
														</ul>
													</nav>
												</div>
											</div>
											<div class="dc-shareprofile">
												<ul class="dc-simplesocialicons dc-socialiconsborder">
													<li class="dc-sharecontent"><span>Share Profile:</span></li>
													<li class="dc-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
													<li class="dc-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
													<li class="dc-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
													<li class="dc-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
													<li class="dc-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="dc-contentdoctab dc-articles-holder tab-pane" id="articles">
											<div class="dc-articles">
												<div class="dc-searchresult-head">
													<div class="dc-title"><h4>Articles By “Dr. Tenisha”</h4></div>
													<div class="dc-rightarea">
														<div class="dc-select">
															<select>
																<option value="Sort By:">Sort By:</option>
																<option value="Sort By:">Last created on top</option>
																<option value="Sort By:">Last modified on top</option>
																<option value="Sort By:">Alphabetically (A-Z)</option>
																<option value="Sort By:">Alphabetically (Z-A)</option>
															</select>
														</div>
													</div>
												</div>
												<div class="dc-articleslist-content dc-articles-list">
													<div class="dc-article">
														<figure class="dc-articleimg">
															<img src="images/articles/img-04.jpg" alt="img description">
															<figcaption>
																<div class="dc-articlesdocinfo">
																	<img src="images/articles/user/img-01.jpg" alt="img description">
																	<span>Lincoln Claggett</span>
																</div>
															</figcaption>
														</figure>
														<div class="dc-articlecontent">
															<div class="dc-title">
																<a href="javascript:void(0);" class="dc-articleby">Business</a>
																<h3><a href="javascript:void(0);">Best Way to Stay Healthy and Boost Your Metabolism</a></h3>
																<span class="dc-datetime"><i class="ti-calendar"></i> Jun 27, 2019</span>
															</div>
															<ul class="dc-moreoptions">
																<li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
																<li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
																<li><a href="javascript:void(0);"><i class="ti-share"></i> Share</a></li>
															</ul>
														</div>
													</div>
													<div class="dc-article">
														<figure class="dc-articleimg">
															<img src="images/articles/img-05.jpg" alt="img description">
															<figcaption>
																<div class="dc-articlesdocinfo">
																	<img src="images/articles/user/img-02.jpg" alt="img description">
																	<span>Lincoln Claggett</span>
																</div>
															</figcaption>
														</figure>
														<div class="dc-articlecontent">
															<div class="dc-title">
																<a href="javascript:void(0);" class="dc-articleby">Medical</a>
																<h3><a href="javascript:void(0);">10 Tips, We Challenge You Won’t Get Tired Easily Even After Hard Work</a></h3>
																<span class="dc-datetime"><i class="ti-calendar"></i> Jun 27, 2019</span>
															</div>
															<ul class="dc-moreoptions">
																<li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
																<li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
																<li><a href="javascript:void(0);"><i class="ti-share"></i> Share</a></li>
															</ul>
														</div>
													</div>
													<div class="dc-article">
														<figure class="dc-articleimg">
															<img src="images/articles/img-06.jpg" alt="img description">
															<figcaption>
																<div class="dc-articlesdocinfo">
																	<img src="images/articles/user/img-03.jpg" alt="img description">
																	<span>Lincoln Claggett</span>
																</div>
															</figcaption>
														</figure>
														<div class="dc-articlecontent">
															<div class="dc-title">
																<a href="javascript:void(0);" class="dc-articleby">DIY, Freelancing</a>
																<h3><a href="javascript:void(0);">Always Keep Your First Aid Box Ready Near to You For Healthy Life</a></h3>
																<span class="dc-datetime"><i class="ti-calendar"></i> Jun 27, 2019</span>
															</div>
															<ul class="dc-moreoptions">
																<li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
																<li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
																<li><a href="javascript:void(0);"><i class="ti-share"></i> Share</a></li>
															</ul>
														</div>
													</div>
													<div class="dc-article">
														<figure class="dc-articleimg">
															<img src="images/articles/img-07.jpg" alt="img description">
															<figcaption>
																<div class="dc-articlesdocinfo">
																	<img src="images/articles/user/img-01.jpg" alt="img description">
																	<span>Lincoln Claggett</span>
																</div>
															</figcaption>
														</figure>
														<div class="dc-articlecontent">
															<div class="dc-title">
																<a href="javascript:void(0);" class="dc-articleby">Business, Lifestyle</a>
																<h3><a href="javascript:void(0);">There is only one happiness in this life, to love and be loved.</a></h3>
																<span class="dc-datetime"><i class="ti-calendar"></i> Jun 27, 2019</span>
															</div>
															<ul class="dc-moreoptions">
																<li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
																<li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
																<li><a href="javascript:void(0);"><i class="ti-share"></i> Share</a></li>
															</ul>
														</div>
													</div>
													<div class="dc-article">
														<figure class="dc-articleimg">
															<img src="images/articles/img-08.jpg" alt="img description">
															<figcaption>
																<div class="dc-articlesdocinfo">
																	<img src="images/articles/user/img-02.jpg" alt="img description">
																	<span>Lincoln Claggett</span>
																</div>
															</figcaption>
														</figure>
														<div class="dc-articlecontent">
															<div class="dc-title">
																<a href="javascript:void(0);" class="dc-articleby">Business, Lifestyle</a>
																<h3><a href="javascript:void(0);">A flower cannot blossom without sunshine, and man cannot live without health.</a></h3>
																<span class="dc-datetime"><i class="ti-calendar"></i> Jun 27, 2019</span>
															</div>
															<ul class="dc-moreoptions">
																<li><a href="javascript:void(0);"><i class="ti-heart"></i> 12,032</a></li>
																<li><a href="javascript:void(0);"><i class="ti-eye"></i> 1,26,558</a></li>
																<li><a href="javascript:void(0);"><i class="ti-share"></i> Share</a></li>
															</ul>
														</div>
													</div>
													<nav class="dc-pagination">
														<ul>
															<li class="dc-prevpage"><a href="javascrip:void(0);"><i class="lnr lnr-chevron-left"></i></a></li>
															<li><a href="javascrip:void(0);">1</a></li>
															<li><a href="javascrip:void(0);">2</a></li>
															<li><a href="javascrip:void(0);">3</a></li>
															<li><a href="javascrip:void(0);">4</a></li>
															<li><a href="javascrip:void(0);">...</a></li>
															<li><a href="javascrip:void(0);">50</a></li>
															<li class="dc-nextpage"><a href="javascrip:void(0);"><i class="lnr lnr-chevron-right"></i></a></li>
														</ul>
													</nav>
												</div>
											</div>
											<div class="dc-shareprofile">
												<ul class="dc-simplesocialicons dc-socialiconsborder">
													<li class="dc-sharecontent"><span>Share Profile:</span></li>
													<li class="dc-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
													<li class="dc-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
													<li class="dc-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
													<li class="dc-instagram"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
													<li class="dc-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							
							
						
					</div>
				</div>
				<!-- User Listing End-->
			</div>
			<!-- Emerging Clients End -->
			<!--Skills Start-->
			<section class="dc-haslayaout dc-footeraboutus dc-bgcolor">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="dc-widgetskills">
								<div class="dc-fwidgettitle">
									<h3>By Speciality</h3>
								</div>
								<ul class="dc-fwidgetcontent">
									<li><a href="javascript:void(0);">Allergy Specialist</a></li>
									<li><a href="javascript:void(0);">Andrologist</a></li>
									<li><a href="javascript:void(0);">Anesthetist</a></li>
									<li><a href="javascript:void(0);">Audiologist</a></li>
									<li><a href="javascript:void(0);">Dietitian/Nutritionist</a></li>
									<li class="dc-viewmore"><a href="javascript:void(0);">View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="dc-widgetskill">
								<div class="dc-fwidgettitle">
									<h3>Doctors In US</h3>
								</div>
								<ul class="dc-fwidgetcontent">
									<li><a href="javascript:void(0);">Laproscopic Surgeon</a></li>
									<li><a href="javascript:void(0);">Oral And Maxillofacial Surgeon</a></li>
									<li><a href="javascript:void(0);">Orthopedic Surgeon</a></li>
									<li><a href="javascript:void(0);">Pediatric Cardiac Surgeon</a></li>
									<li><a href="javascript:void(0);">Pediatric Orthopedic Surgeon</a></li>
									<li class="dc-viewmore"><a href="javascript:void(0);">View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="dc-footercol dc-widgetcategories">
								<div class="dc-fwidgettitle">
									<h3>By Categories</h3>
								</div>
								<ul class="dc-fwidgetcontent">
									<li><a href="javascript:void(0);">Cosmetic Surgeon</a></li>
									<li><a href="javascript:void(0);">Eye Specialist</a></li>
									<li><a href="javascript:void(0);">Gastroenterologist</a></li>
									<li><a href="javascript:void(0);">General Physician</a></li>
									<li><a href="javascript:void(0);">General Practitioner</a></li>
									<li class="dc-viewmore"><a href="javascript:void(0);">View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="dc-widgetbylocation">
								<div class="dc-fwidgettitle">
									<h3>By Location</h3>
								</div>
								<ul class="dc-fwidgetcontent">
									<li><a href="javascript:void(0);">Switzerland</a></li>
									<li><a href="javascript:void(0);">Canada</a></li>
									<li><a href="javascript:void(0);">Germany</a></li>
									<li><a href="javascript:void(0);">United Kingdom</a></li>
									<li><a href="javascript:void(0);">Japan</a></li>
									<li class="dc-viewmore"><a href="javascript:void(0);">View All</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--Skills End-->
		</main>