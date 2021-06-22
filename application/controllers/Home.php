<?php if (!defined("BASEPATH")) exit("Hack Attempt");
class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		// $this->output->enable_profiler(TRUE);

		$this->load->model('M_pages', 'pages');
		$this->load->model('M_home', 'home');
		$this->load->model('M_product', 'product');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{

		//GET THE MARGIN PARAMETER
		$marginParameter = $this->product->getMarginPrice();

		//GET PARENT CATEGORY TITLE
		$data['categories'] = $this->M_category->getParentCategory();

		$industryID = $this->input->get('id');

		$randomPage = mt_rand(1, 100);
		$queryArray = array(
			'cpage'	=> $randomPage
		);

		$productList = $this->incube->getProductList($queryArray);

		//Get the category
		$mainCategory = $this->input->get('category');
		$subCategory = $this->input->get('id');

		if ($mainCategory != null && $subCategory != null) {
			$data['mainCategory'] 	= $this->home->getMainCategory($mainCategory);
			$data['subCategory'] 	= $this->home->getSubcategory($subCategory);
			$data['breadcrumb'] 	= true;
			$data['bikePart'] 		= false;
			$data['margin'] 		= $marginParameter;
			$data['productList'] 	= $productList;
		} else {
			$data['breadcrumb'] 	= false;
			$data['bikePart'] 		= true;
			$data['margin'] 		= $marginParameter;
			$data['productList'] 	= $productList;
		}

		$data['sectionName'] = 'Home';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('pages/home/home', $data);
		// $this->load->view('pages/home/autoload-desktop');
		$this->load->view('templates/footer', $data);
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
		$data['categories'] = $this->M_category->getParentCategory();
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
