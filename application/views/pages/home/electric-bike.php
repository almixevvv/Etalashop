<header data-component-container="heroComponent" data-hero-layer-opacity="opacity10" data-hero-layer-color="BLACK"  class="hero hero-large hero-homepage hero-cta " data-module="heroLarge">
	<img alt="banner" src="<?php echo base_url('assets/img/banner-top2.jpg');?>" style="width: 100%;" />
</header>
<?php
		$convert = 2053.63;
?>
<div class="content gutter">

	<!-- Electric Bike Placeholder -->
	<section class="product-push homepage" data-module="productpush, view360" style="padding: 0px;background: #fff;padding-top: 30px;">
		<!-- Category Part -->
			<div style="text-align: left;">
				<span style="color: #333;"><span class="fa fa-home"></span> Home </span>
				<span style="color: #333;"> -
					Bikes
				</span> -
				<span style="color: #333;">
					Electrical Bike
				</span>
			</div>
		<!-- End of Category Part -->

		<div class="row" style="padding: 15px;margin-bottom: 100px;">
			<div id="list-product-1">
				<div class="col-lg-2 col-md-2 col-sm-3-col-xs-12" style="padding: 2.5px;position: relative;min-height: 44rem; height: 33rem;" >
					<div class="well no-padding" style="padding: 10px;">
				        <div>
				            <ul class="nav nav-list nav-menu-list-style">
											<li style="text-align: left;">
												<label class="tree-toggle nav-header">
													Bikes
													<span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span>
												</label>
												<ul class="nav nav-list tree">
													<li>
														<a href="<?php echo base_url('product/electricbike'); ?>">&nbsp;<?php echo 'Electrical Bike'; ?></a>
													</li>
												</ul>
											</li>
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
				        </div>
				    </div>
				</div>

				<!-- SMALL DEVICE ONLY -->
				<div class="container" id="bike-label-small" >
					<div class="row">
						<?php foreach($dt['prslist'] as $data): ?>
							<!-- Convert the Price to IDR -->
							<?php $data['sellPrice'] = $data['sellPrice'] * 20.5363; ?>
							<div class="col-xs-6" style="margin-bottom: 1em; margin-top: 0.5em;">
								<div class="product-list" id="prod_<?php echo $data['id']; ?>" >
									<a href="<?php echo base_url();?>product_detail?id=<?php echo $data['id']; ?>" style="text-decoration: none;">
										<div>
											<img alt="product-img" src="http://img1.yiwugou.com/<?php echo $data['picture2']; ?>" style="height: 9em;object-fit: cover;" />
										</div>
										<p class="mt-2"><?php echo $data['title']; ?></p>
										<label>Estimated Price : </label>
										<?php if($data['sellPrice'] == 0): ?>
										<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Contact us for price"; ?></span>
										<?php elseif($data['sellPrice'] > 9999999): ?>
											<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Contact us for price"; ?></span>
												<?php else: ?>
												<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo number_format($data['sellPrice'], 2); ?></span>
										<?php endif; ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<!-- END OF SMALL DEVICE ONLY -->

				<div class="col-lg-10 col-md-5 col-sm-3 hide-mobile">
					<?php foreach($dt['prslist'] as $data): ?>
						<!-- Convert the Price to IDR -->
						<?php $data['sellPrice'] = $data['sellPrice'] * 20.5363; ?>
						<div class="col-lg-3 col-md-5 col-sm-3" style="padding: 2.5px; position: relative;" id="item-product-1">
							<div class="product-list" id="prod_<?php echo $data['id']; ?>" >
								<a href="<?php echo base_url();?>product_detail?id=<?php echo $data['id']; ?>" style="text-decoration: none;">
									<div>
										<img alt="product-img" src="http://img1.yiwugou.com/<?php echo $data['picture2']; ?>" style="width:150px;height:150px;object-fit: cover;" />
									</div>
									<p class="mt-2"><?php echo $data['title']; ?></p>
									<label>Price : </label>
									<?php if($data['sellPrice'] == 0): ?>
									<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Contact us for price"; ?></span>
									<?php elseif($data['sellPrice'] > 9999999): ?>
										<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo "Contact us for price"; ?></span>
											<?php else: ?>
											<span style="color: #f75c07;font-size: 14px;font-weight: bold;"> <?php echo number_format($data['sellPrice'], 2); ?></span>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</div>

<section class="style-news" style="padding: 0px;background: #fff;">
	<img alt="banner footer" src="<?php echo base_url('assets/img/banner-top-main.jpg');?>" style="width: 100%;" />
</section>
<script type="text/javascript">
	$(document).ready(function () {
	    size_li = $("#list-product-1 div#item-product-1").size();
	    x=12;
	    if(x >= size_li){ $('#btn-load-more-1').hide(); $('#div-loadmore-1').hide();}
	    $('#list-product-1 div#item-product-1:lt('+x+')').show();
	    $('#btn-load-more-1').click(function () {
		        x = (x+12 <= size_li) ? x+12 : size_li;
		        $('#list-product-1 div#item-product-1:lt('+x+')').show();
	        if(x <= size_li){
		    		$('#btn-load-more-1').hide();
		    		$('#div-loadmore-1').hide();
	        }
	    });
	    size_li2 = $("#list-product-2 div#item-product-2").size();
	    x2=4;
	    if(x2 >= size_li2){ $('#btn-load-more-2').hide(); $('#div-loadmore-2').hide();}
	    $('#list-product-2 div#item-product-2:lt('+x2+')').show();
	    $('#btn-load-more-2').click(function () {
		        x2 = (x2+4 <= size_li2) ? x2+4 : size_li2;
		        $('#list-product-2 div#item-product-2:lt('+x2+')').show();
	        if(x2 <= size_li2){
		    		$('#btn-load-more-2').hide();
		    		$('#div-loadmore-2').hide();
	        }
	    });

	    // $('#showLess').click(function () {
	    //     x=(x-4<0) ? 4 : x-4;
	    //     $('#list-product-1 div#item-product-1').not(':lt('+x+')').hide();
	    // });

	$('.tree-toggle').click(function () {	$(this).parent().children('ul.tree').toggle(200);
	});
	$(function(){
	$('.tree-toggle').parent().children('ul.tree').toggle(200);
	});

	});
</script>
