<?php if(!defined("BASEPATH")) exit("Hack Attempt");

	class ContentLoad extends CI_Controller {

		public function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');

			$this->load->model('M_product', 'product');
			$this->load->library('incube');
		}

		public function autoloadHome() {

			$output = '';
			
			$industryID = $this->input->post('id');
			$currentCounter = $this->input->post('counter');

			//HOW TO GET JSON DATA
			if($industryID == null) {
				$json = file_get_contents("http://kikikuku.com/API/home?key=c549303dcef12a687e9077a21e1a51fb67851efb&pageSize=12&page=".$this->input->post('start')."");
			} else {
				$json = file_get_contents("http://kikikuku.com/API/categoryProduct?key=c549303dcef12a687e9077a21e1a51fb67851efb&pageSize=12&category=".$industryID."&page=".$this->input->post('start')."");
			}

			$obj = json_decode($json, true);

			//COUNTER TO DISPLAY MANUAL LOAD
			$currentCounter 	= $this->input->post('counter');

			foreach($obj['item'] as $list) {

				//FILL THE TEMPLATE WITH OUTPUT DATA
				if(is_numeric($list['PRICE'])) {
					$output .= '
						<div class="custom-product-list" >
							<div class="card product-list" id="prod_'.$list['ID'].'">
								<a href="'.base_url('product_detail?id='.$list['ID']).'" style="text-decoration: none;">
									<div class="d-flex justify-content-center">
										<img alt="'.$list['TITLE'].'" class="product-image" src="'.$list['PICTURE'].'" 
										onerror="this.onerror=null;this.src='.'\''.base_url('assets/images/no-image-icon.png').' \''.'" />
									</div>
									<p class="product-title mt-2">'.ucwords(mb_strimwidth($list['TITLE'], 0, 35, "...")).'</p>
									<label class="product-label">Estimated Price</label></br>
									<span class="product-price">IDR '.number_format($list['PRICE'], 2, '.', ',').'</span>	
								</a>
							</div>
						</div>';
				} else {
					$output .= '
					<div class="custom-product-list" >
						<div class="card product-list" id="prod_'.$list['ID'].'">
							<a href="'.base_url('product_detail?id='.$list['ID']).'" style="text-decoration: none;">
								<div class="d-flex justify-content-center">
									<img alt="'.$list['TITLE'].'" class="product-image" src="'.$list['PICTURE'].'" 
									onerror="this.onerror=null;this.src='.'\''.base_url('assets/images/no-image-icon.png').' \''.'" />
								</div>
								<p class="product-title mt-2">'.ucwords(mb_strimwidth($list['TITLE'], 0, 35, "...")).'</p>
								<label class="product-label">Estimated Price</label></br>
								<span class="product-price">'.$list['PRICE'].'</span>	
							</a>
						</div>
					</div>';
				}
			}

			if($currentCounter >= 4) {
				$output .= '<button onclick="manualLoad()" class="load-more-content" type="button" >Load More</button>';
			}

			//ECHO THE FINAL GROUP OF OUTPUT
			echo $output;

		}

		// public function loadDetails() {

		// 	$id 		= $this->input->get('id');
		// 	$curQty 	= $this->input->get('qty');
		// 	$curPrice	= $this->input->get('price');
			
		// 	$finalUrl 	= 'http://en.yiwugo.com/ywg/productdetail.html?account=Wien.suh@gmail.com&productId='.$id;

		// 	$json 		= file_get_contents($finalUrl);
        // 	$obj        = json_decode($json, true);

        // 	//Match the Price
        // 	if($obj['detail']['sdiProductsPriceList'] != null) {
        // 		echo 'saatnya berhitung';

        // 		foreach($obj['detail']['sdiProductsPriceList'] as $price) {
        			
		// 		}
				
        // 	} else {
        // 		echo $curPrice;
        // 	}

		// }

		public function autoloadSearch() {

			$output = '';

			$searchQuery 		= $this->input->post('query');
			$currentCounter 	= $this->input->post('counter');
			$page 				= $this->input->post('start');

			$json = file_get_contents("http://kikikuku.com/API/search?key=c549303dcef12a687e9077a21e1a51fb67851efb&pageSize=12&query=".$searchQuery."&page=".$page);
			$obj = json_decode($json, true);

			//COUNTER TO DISPLAY MANUAL LOAD
			$currentCounter 	= $this->input->post('counter');

			foreach($obj['item'] as $list) {

				//FILL THE TEMPLATE WITH OUTPUT DATA
				if(is_numeric($list['PRICE'])) {
					$output .= '
						<div class="custom-product-list" >
							<div class="card product-list" id="prod_'.$list['ID'].'">
								<a href="'.base_url('product_detail?id='.$list['ID']).'" style="text-decoration: none;">
									<div class="d-flex justify-content-center">
										<img alt="'.$list['TITLE'].'" class="product-image" src="'.$list['PICTURE'].'" 
										onerror="this.onerror=null;this.src='.'\''.base_url('assets/images/no-image-icon.png').' \''.'" />
									</div>
									<p class="product-title mt-2">'.ucwords(mb_strimwidth($list['TITLE'], 0, 35, "...")).'</p>
									<label class="product-label">Estimated Price</label></br>
									<span class="product-price">IDR '.number_format($list['PRICE'], 2, '.', ',').'</span>	
								</a>
							</div>
						</div>';
				} else {
					$output .= '
					<div class="custom-product-list" >
						<div class="card product-list" id="prod_'.$list['ID'].'">
							<a href="'.base_url('product_detail?id='.$list['ID']).'" style="text-decoration: none;">
								<div class="d-flex justify-content-center">
									<img alt="'.$list['TITLE'].'" class="product-image" src="'.$list['PICTURE'].'" 
									onerror="this.onerror=null;this.src='.'\''.base_url('assets/images/no-image-icon.png').' \''.'" />
								</div>
								<p class="product-title mt-2">'.ucwords(mb_strimwidth($list['TITLE'], 0, 35, "...")).'</p>
								<label class="product-label">Estimated Price</label></br>
								<span class="product-price">'.$list['PRICE'].'</span>	
							</a>
						</div>
					</div>';
				}
			}

			if($currentCounter >= 4) {
				$output .= '<button onclick="manualLoad()" class="load-more-content" type="button" >Load More</button>';
			}

			//ECHO THE FINAL GROUP OF OUTPUT
			echo $output;


		}


	}
