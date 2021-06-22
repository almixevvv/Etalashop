<?php
    $convert = 20.5363;
?>

<header data-component-container="heroComponent" data-hero-layer-opacity="opacity10" data-hero-layer-color="BLACK"  class="hero hero-large hero-homepage hero-cta " data-module="heroLarge">
	<img alt="banner" src="<?php echo base_url('assets/img/banner-03.jpg');?>" style="width: 100%;" />
</header>
<div class="content gutter">

	<!-- Electric Bike Placeholder -->
	<section class="product-push homepage" data-module="productpush, view360" style="padding: 0px;background: #fff;padding-top: 30px;">
		<!-- Category Part -->
		<?php if($breadcrumb):?>
			<div style="text-align: left;">
				<span style="color: #333;"><span class="fa fa-home"></span> Home </span>
				<span style="color: #333;"> -
					<?php foreach($mainCategory->result() as $data): ?>
						<?php echo $data->NAME; ?>
					<?php endforeach; ?>
				</span> -
				<span style="color: #333;">
					<?php foreach($subCategory->result() as $data): ?>
						<?php echo $data->NAME; ?>
					<?php endforeach; ?>
				</span>
			</div>
		<?php endif; ?>
		<!-- End of Category Part -->

		<div class="row" style="padding: 15px;margin-bottom: 100px;">
			<div id="list-product-1">
				<div class="col-lg-2 col-md-2 col-sm-3-col-xs-12" id="side-panel" style="padding: 2.5px;position: relative;min-height: 800px; height: 100rem;" >
					<div class="well no-padding" style="padding: 10px;">
				        <div>
				            <ul class="nav nav-list nav-menu-list-style">
<!-- 								<li style="text-align: left;">
									<label class="tree-toggle nav-header">
										Bikes
										<span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span>
									</label>
										<ul class="nav nav-list tree">
											<li>
												<a href="<?php echo base_url('product/electricbike'); ?>">&nbsp;<?php echo 'Electrical Bike'; ?></a>
											</li>
										</ul>
								</li> -->
				                <?php
							       $sql_cats = "SELECT A.ID, A.NAME, (SELECT COUNT(ID) FROM `m_category` WHERE `m_category`.PARENT = A.ID) as TOTAL_SUB
							          							 FROM `m_category` as A WHERE A.`PARENT`='0' AND A.`LEVEL`='0' ORDER BY A.`ORDER_NO` ASC";
							          	$query_cats = $this->db->query($sql_cats);
							          	foreach ($query_cats->result() as $rsc):
						        		?>
				                <li style="text-align: left;">
													<label class="tree-toggle nav-header">
														<?php echo ucfirst(strtolower($rsc->NAME));?>
				                		<?php if($rsc->TOTAL_SUB > 0):?>
															<span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span>
														<?php endif; ?>
				                	</label>
				                  <?php if($rsc->TOTAL_SUB > 0): ?>
														<ul class="nav nav-list tree">
				                    	<?php
						                    $sql_subcats = "SELECT *
																								FROM `m_category`
																								WHERE `PARENT`='".$rsc->ID."' AND `LEVEL`='1'
																								ORDER BY `ORDER_NO` ASC";

						                  	$query_subcats = $this->db->query($sql_subcats);
						                  	foreach ($query_subcats->result() as $sub_rsc):
						                	?>
				                    	<li>
																<a href="<?php echo base_url('home?category='.$rsc->ID.'&id='.ucfirst(strtolower($sub_rsc->LINK)) );?>">&nbsp;<?php echo ucfirst(strtolower($sub_rsc->NAME));?></a>
															</li>
				            			<?php endforeach; ?>
				                    </ul>
				            		<?php endif; ?>
				                </li>
				            	<?php endforeach; ?>
				            </ul>
				            <br/>
				            <a class="content-to-hide" href="<?php echo base_url('product/electricbike'); ?>"><img alt="banner" src="<?php echo base_url('assets/img/banner_bike.jpg');?>" style="width: 100%;" /></a>
				        </div>
				    </div>
				</div>

				<!-- SMALL DEVICE ONLY -->
				<div class="container" id="bike-label-small" style="margin-top: 3em;">

					<!-- ELECTRIC BIKE PART -->
					<!-- ONLY SHOW IN HOME -->
					<?php if(!$breadcrumb):?>
					<div class="row">
						<center>
							<div class="col-xs-12">
								<label style="padding: 1rem;font-size: 14px;">ELECTRIC BIKES</label>
							</div>
						</center>
					</div>
					<div class="row">
						<?php foreach($electric['prslist'] as $data): ?>
							<!-- Convert the Price to IDR -->
							<?php $data['sellPrice'] = ($data['sellPrice'] * $convert) * $margin; ?>
							<div class="col-xs-6" style="margin-bottom: 1em; margin-top: 0.5em;">
								<div class="product-list" id="prod_<?php echo $data['id']; ?>" >
									<a href="<?php echo base_url();?>product_detail?id=<?php echo $data['id']; ?>" style="text-decoration: none;">
										<div>
											<img alt="product-img" src="http://img1.yiwugou.com/<?php echo $data['picture2']; ?>" style="height: 9em;object-fit: cover;" />
										</div>
										<p class="mt-2"><?php echo $data['title']; ?></p>
										<label>Estimated Price : </label>
										<?php if($data['sellPrice'] == 0): ?>
										<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Price Negotiable"; ?></span>
										<?php elseif($data['sellPrice'] > 9999999): ?>
											<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Price Negotiable"; ?></span>
												<?php else: ?>
												<span style="color: #f75c07;font-size: 14px;font-weight: bold;">IDR <?php echo number_format($data['sellPrice'], 2); ?></span>
										<?php endif; ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<!-- END OF ELECTRIC BIKE PART -->

					<!-- OTHER PRODUCT PART -->
					<!-- ONLY SHOW IN HOME -->
					<?php if(!$breadcrumb):?>
					<div class="row">
						<center>
							<div class="col-xs-12">
								<label style="padding: 1rem;font-size: 14px;">OTHER PRODUCTS</label>
							</div>
						</center>
					</div>
					<?php endif; ?>

					<div class="row">
						<div id="load_dataMobile">
						</div>
						<div class="row" style="margin-top: 1em;">
							<div class="col-12">
								<center>
									<div id="load_data_message" class="lds-roller" style="margin-top: 1em;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
								</center>
							</div>
						</div>
					</div>
					<!-- END OF OTHER PRODUCT PART -->
				</div>
				<!-- END OF SMALL DEVICE ONLY -->

				<!-- ELECTRIC BIKE PART -->
					<!-- ONLY SHOW IN HOME -->
					<?php if(!$breadcrumb):?>
					<div class="col-lg-2 hide-mobile" style="padding-left: 0!important; padding-right: 0!important;">
			        <label style="padding: 1rem;font-size: 14px; margin-left: -4em;">ELECTRIC BIKES</label>
			    </div>
					<div class="col-lg-10 col-md-5 col-sm-3 hide-mobile">
						<?php foreach($electric['prslist'] as $data): ?>
							<!-- Convert the Price to IDR -->
							<?php $data['sellPrice'] = ($data['sellPrice'] * $convert) * $margin; ?>
							<div class="col-lg-3 col-md-5 col-sm-3" style="padding: 2.5px; position: relative;" id="item-product-1">
								<div class="product-list" id="prod_<?php echo $data['id']; ?>" >
									<a href="<?php echo base_url();?>product_detail?id=<?php echo $data['id']; ?>" style="text-decoration: none;">
										<div>
											<img alt="product-img" src="http://img1.yiwugou.com/<?php echo $data['picture2']; ?>" style="width:150px;height:150px;object-fit: cover;" />
										</div>
										<p class="mt-2"><?php echo $data['title']; ?></p>
										<label>Estimated Price : </label>
										<?php if($data['sellPrice'] == 0): ?>
										<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Price Negotiable"; ?></span>
											<?php elseif($data['sellPrice'] > 9999999): ?>
											<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Price Negotiable"; ?></span>
												<?php else: ?>
												<span style="color: #f75c07;font-size: 14px;font-weight: bold;">IDR <?php echo number_format($data['sellPrice'], 2); ?></span>
										<?php endif; ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				<!-- END OF ELECTRIC BIKE PART -->

				<!-- OTHER ITEMS PART -->
				<!-- ONLY SHOW IN HOME -->
				<?php if(!$breadcrumb):?>
				<div class="col-lg-2 hide-mobile" style="padding-left: 0!important; padding-right: 0!important; margin-top: 1em;">
			  	<label style="padding: 1rem;font-size: 14px; margin-left: -4rem;">OTHER PRODUCTS</label>
			  </div>
				<?php endif; ?>

				<!-- CONTENT LOADER PLACEHOLDER -->
				<div class="col-lg-10 col-md-5 col-sm-3 hide-mobile">
					<div id="load_data"></div>
					<div class="row" style="margin-top: 1em;">
						<div class="col-lg-12">
							<center class="load_more_holder">
                <div id="load_data_message" class="lds-roller" style="margin-top: 1em;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
							</center>
						</div>
					</div>
				</div>
				<!-- END OF AUTOLOAD CONTENT -->

			</div>
		</div>
	</section>
</div>

<section class="style-news" style="padding: 0px;background: #fff;">
	<img alt="banner footer" src="<?php echo base_url('assets/img/banner-top-main.jpg');?>" style="width: 100%;" />
</section>
