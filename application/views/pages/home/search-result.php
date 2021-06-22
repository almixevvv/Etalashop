<div class="main-container" style="margin-top: 8em;">

	<div class="row" style="width: 100%; margin-left: 0!important; margin-right: 0!important;">

		<!-- COMPONENT LEFT PART -->
		<div class="custom-column-left header-desktop">
			<div class="accordion" id="main-accordion">
			<?php foreach($categories->result() as $data): ?>
			<div class="card">
				<div class="card-header" data-toggle="collapse" data-target="#collapse-<?php echo $data->ID; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $data->ID; ?>" id="heading-<?php echo $data->ID; ?>" style="padding: 0!important;">
					<p class=" categoryCardContainer">
						<span class="categoryCardTitle">
							<label style="font-size: 11px;"><?php echo $data->DESCRIPTION; ?></label>
						</span>
						<span class="float-right caret-container">
							<i class="fas fa-chevron-down"></i>
						</span>
					</p>
				</div>
				<div id="collapse-<?php echo $data->ID; ?>" class="collapse" aria-labelledby="heading-<?php echo $data->ID; ?>" data-parent="#main-accordion">
					<div class="card-body">
						<ul>
							<?php $categoryQuery = $this->M_category->getChildCategory($data->ID); ?>

							<?php foreach($categoryQuery->result() as $list): ?>
								<li class="category-list">
									<a href="<?php echo base_url('home?category='.$data->ID.'&id='.ucfirst(strtolower($list->LINK)) );?>">&nbsp;<?php echo ucfirst(strtolower($list->NAME));?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endforeach; ?>

			<div class="card">
				<span id="banner-sidebar">
					<img alt="Side Banner" src="<?php echo base_url('assets/images/banner_bike.jpg');?>" style="width: 100%;" />
				</span>
			</div>

			</div>
		</div>

		<!-- COMPONENT RIGHT PART -->
		<div class="custom-column-right">

			<div class="row mb-4">
				<div class="col-5">
					<span>Displaying Search Result for: </span><?php echo ucwords($this->input->get('query')); ?>
				</div>
			</div>

			<div class="row" id="product-main-list">

			</div>

			<div class="row" id="loader-icon">

				<div class="col-12 col-md-12 col-lg-12 col-xl-12">
					<div class="d-flex justify-content-center">
						<div class="lds-roller pt-4 pb-5">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>
