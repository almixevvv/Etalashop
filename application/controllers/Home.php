<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		// $this->output->enable_profiler(TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tmp()
	{
		$curl = curl_init();

		$data = array(
			'cpage'	=> mt_rand(1, 100)
		);

		$urlEndpoint = 'http://app.yiwugo.com/product/2016product/onetest.htm?password=wien.suh@gmail.com';
		$params = array(
			'key'	=> $data
		);

		$finalUrl = $urlEndpoint . '&' . http_build_query($params);

		echo $finalUrl;

		curl_setopt_array($curl, array(
			CURLOPT_URL => $finalUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
	}

	public function index()
	{

		//GET THE MARGIN PARAMETER
		$marginParameter = $this->product->getMarginPrice();

		//GET PARENT CATEGORY TITLE
		$tmp['categories'] = $this->category->getParentCategory();

		$industryID = $this->input->get('id');

		$randomPage = mt_rand(1, 100);
		$queryArray = array(
			'cpage'	=> $randomPage
		);

		// $productList = $this->incube->getProductList($queryArray);
		$queryProduct = $this->api->getGeneralListGroup('v_g_products', 'PRODUCT_ID');

		foreach ($queryProduct->result() as $data) {

			$calculateFinalPrice = ($data->QUANTITY_PRICE == null ? 'Price Negotiable' : 'IDR ' . number_format($data->QUANTITY_PRICE, 2, '.', ','));

			$result[] = array(
				'ID'                => $data->PRODUCT_ID,
				'TITLE'             => $data->PRODUCT_NAME,
				'PICTURE'           => (strpos($data->IMAGES1, 'http') === false ? base_url('assets/uploads/products/' . $data->IMAGES1) : $data->IMAGES1),
				'ORIGINAL_PRICE'    => $calculateFinalPrice,
				'START_QUANTITY'    => $data->QUANTITY_MIN,
				'PRICE'             => $calculateFinalPrice
			);
		}

		// //Get the category
		$mainCategory = $this->input->get('category');
		$subCategory = $this->input->get('id');

		if ($mainCategory != null && $subCategory != null) {
			$tmp['mainCategory'] 	= $this->home->getMainCategory($mainCategory);
			$tmp['subCategory'] 	= $this->home->getSubcategory($subCategory);
			$tmp['breadcrumb'] 		= true;
			$tmp['bikePart'] 		= false;
			$tmp['margin'] 			= $marginParameter;
			$tmp['productList'] 	= $result;
		} else {
			$tmp['breadcrumb'] 		= false;
			$tmp['bikePart'] 		= true;
			$tmp['margin'] 			= $marginParameter;
			$tmp['productList'] 	= $result;
		}

		$tmp['sectionName'] = 'Home';

		$this->load->view('templates/header', $tmp);
		$this->load->view('templates/navbar', $tmp);
		$this->load->view('pages/home/home', $tmp);
		$this->load->view('pages/home/autoload-desktop');
		$this->load->view('templates/footer', $tmp);
	}

	/* TMP ELECTRIC BIKE */
	public function searchBike()
	{

		$page = 'electric-bike';

		$randomPage = mt_rand(1, 500);

		$url = file_get_contents("https://en.yiwugo.com/ywg/productlist.html?account=Wien.suh@gmail.com&q=electric%20bicycle&pageSize=12&cpage=" . $randomPage);
		$objectBike = json_decode($url, true);

		// FOR DEBUGGING PURPOSE ONLY
		// foreach($obj['prslist'] as $list) {
		// 	echo $list['productDetail']['id']."</br>";
		// 	echo $list['productDetail']['userId']."</br>";
		// 	echo $list['productDetail']['productDetailVO']['title']."</br>"."</br>";
		// }

		//Sidebar Category
		$data['dt'] = $objectBike;
		$data['perpage'] = 18;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('pages/home/' . $page, $data);
		$this->load->view('pages/home/autoload-mobile');
		$this->load->view('pages/home/autoload-desktop');
		$this->load->view('templates/footer', $data);
	}

	/* TMP ELECTRIC BIKE */

	public function search()
	{

		$searchQuery = $this->input->get('query');

		$data['sectionName'] = 'Search Result for ' . ucwords($searchQuery);

		//GET PARENT CATEGORY TITLE
		$data['categories'] = $this->category->getParentCategory();
		$data['searchQuery'] = $searchQuery;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('pages/home/search-result', $data);
		$this->load->view('pages/home/autoload-search');
		$this->load->view('templates/footer', $data);
	}

	public function AboutUs()
	{

		$page = 'about/aboutus';

		$data['sectionName'] = 'About Us';
		$data['about'] = $this->pages->AboutUs();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer.php');
	}

	public function howto()
	{

		$page = 'how-to/how-to';

		$data['sectionName'] = 'How To Shop';
		$data['howto'] = $this->pages->HowTo();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function contactus()
	{

		$page = 'contact/contact-us';

		$data['contactus'] = $this->pages->ContactUs();
		$data['sectionName'] = 'Contact';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer.php');
	}

	public function faq()
	{

		$page = 'faq/faq';

		$data['sectionName'] = 'FAQ';
		$data['faq'] = $this->pages->Faq();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer.php');
	}

	public function terms()
	{

		$page = 'terms/terms';

		$data['sectionName'] = 'Terms & Conditions';
		$data['terms'] = $this->pages->Terms();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer.php');
	}

	public function legal()
	{

		$page = 'V_legal';

		$data['sectionName'] = 'Legal';
		$data['legal'] = $this->pages->Legal();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function privacy()
	{

		$page = 'privacy/privacy';

		$data['sectionName'] = 'Privacy Policy';
		$data['privacy'] = $this->pages->Privacy();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}
}
