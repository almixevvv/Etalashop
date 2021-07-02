<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class API extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        header('Content-Type: application/json');

        $this->load->model('M_api', 'api');
        date_default_timezone_set('Asia/Jakarta');
    }

    //Only Run if member table is broken
    public function generateMemberRECID()
    {
        $queryMember = $this->api->getGeneralList('g_member');

        foreach ($queryMember->result() as $members) {

            $randomSalt = md5(uniqid(rand(), true));
            $salt = substr($randomSalt, 0, 10);

            $queryUpdate = array(
                'REC_ID'    => $salt
            );

            $queryUpdateMember = $this->api->updateGeneralData('g_member', 'ID', $members->ID, $queryUpdate);
        }
    }

    public function generatePID()
    {
        $apiKey = $this->input->get('key');
        if (isset($apiKey)) {

            if ($apiKey != API_KEY) {

                $msg = array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid api key',
                );
            } else {
                $randomSalt = md5(uniqid(rand(), true));
                $salt = substr($randomSalt, 0, 10);

                $msg = array(
                    'status'    => 'ok',
                    'code'      => 200,
                    'message'   => $salt,
                );
            }
        } else {
            $msg = array(
                'status'    => 'ok',
                'code'      => 204,
                'message'   => 'incomplete api parameter',
            );
        }

        echo json_encode($msg);
    }

    public function index()
    {
        $apiKey = $this->input->get('key');
        if (isset($apiKey)) {

            if ($apiKey != API_KEY) {

                $msg = array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid api key',
                );
            }
        } else {
            $msg = array(
                'status'    => 'ok',
                'code'      => 204,
                'message'   => 'incomplete api parameter',
            );
        }

        echo json_encode($msg);
    }

    public function getProductDetail()
    {
        $queryProduct = $this->api->getGeneralData('v_g_products', 'PRODUCT_ID', $this->input->get('id'));

        $tmpData = json_encode($queryProduct->result());

        echo $tmpData;
    }

    public function getAllCategories()
    {
        $queryProduct = $this->api->getGeneralData('m_category', 'PARENT !=', '0');

        foreach ($queryProduct->result() as $rows) {
            $tmpData[] = array(
                'value' => $rows->LINK,
                'data'  => $rows->NAME
            );
        }

        $tmpData = json_encode($tmpData);

        echo $tmpData;
    }

    public function home()
    {
        $apiKey = $this->input->get('key');
        if (isset($apiKey)) {
            if ($apiKey != API_KEY) {
                $msg = array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid api key',
                );
            } else {

                $curPage   = $this->input->get('page');
                $listSize  = $this->input->get('pageSize');

                $queryProduct = $this->api->getGeneralListGroup('v_g_products', 'PRODUCT_ID');

                if ($queryProduct->num_rows() > 0) {
                    foreach ($queryProduct->result() as $data) {

                        $calculateFinalPrice = ($data->QUANTITY_PRICE == null ? 'Price Negotiable' : number_format($data->QUANTITY_PRICE, 2, '.', ','));

                        $result[] = array(
                            'ID'                => $data->PRODUCT_ID,
                            'TITLE'             => $data->PRODUCT_NAME,
                            'PICTURE'           => (strpos($data->IMAGES1, 'http') === false ? base_url('assets/uploads/products/' . $data->IMAGES1) : $data->IMAGES1),
                            'ORIGINAL_PRICE'    => $calculateFinalPrice,
                            'START_QUANTITY'    => $data->QUANTITY_MIN,
                            'PRICE'             => $calculateFinalPrice
                        );
                    }

                    $encodeResult = json_encode($result);

                    $msg = array(
                        'status'      => 'ok',
                        'code'        => 200,
                        'item'        => json_decode($encodeResult)
                    );
                } else {
                    $msg = array(
                        'status'    => 'ok',
                        'code'      => 200,
                        'item'      => [],
                        'message'   => 'no records found',
                    );
                }
            }
        } else {
            $msg = array(
                'status'    => 'ok',
                'code'      => 204,
                'message'   => 'incomplete api parameter',
            );
        }

        echo json_encode($msg);
    }

    public function product()
    {
        $apiKey = $this->input->get('key');
        if (isset($apiKey)) {
            if ($apiKey != API_KEY) {
                $msg = array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid api key',
                );
            } else {

                $productID = $this->input->get('id');

                if (isset($productID)) {

                    $queryProduct = $this->cms->getGeneralData('v_g_products', 'PRODUCT_ID', $productID);

                    if ($queryProduct->num_rows() == 0) {
                        $msg = array(
                            'status'    => 'ok',
                            'code'      => 204,
                            'message'   => 'invalid product id'
                        );
                    } else {

                        $productArr = array();

                        $productArr['TITLE']    = $queryProduct->row()->PRODUCT_NAME;
                        $productArr['MATRIC']   = 'Pcs';
                        $productArr['DETAILS']  = $queryProduct->row()->PRODUCT_DETAIL;

                        $counter = 0;

                        if ($queryProduct->num_rows() > 1) {
                            foreach ($queryProduct->result() as $prices) {
                                $productArr['PRICE'][$counter]['PRICE']             = ($prices->QUANTITY_PRICE == null ? 'Price Negotiable' : strval($prices->QUANTITY_PRICE));
                                $productArr['PRICE'][$counter]['STARTING_QUANTITY'] = ($prices->QUANTITY_MIN == 0 ? 1 : $prices->QUANTITY_MIN);
                                $productArr['PRICE'][$counter]['ENDING_QUANTITY']   = ($prices->QUANTITY_MAX == 999 ? 'Above ' . $prices->QUANTITY_MIN : $prices->QUANTITY_MAX);
                                $productArr['PRICE'][$counter]['FLAG']              = ($queryProduct->num_rows() == 0 ? 'No EXW Price' : 'EXW Price Exist');

                                $counter++;
                            }
                        } else {
                            $productArr['PRICE'][$counter]['PRICE']             = ($queryProduct->row()->QUANTITY_PRICE == null ? 'Price Negotiable' : $queryProduct->row()->QUANTITY_PRICE);
                            $productArr['PRICE'][$counter]['STARTING_QUANTITY'] = ($queryProduct->row()->QUANTITY_MIN == 0 ? 1 : $queryProduct->row()->QUANTITY_MIN);
                            $productArr['PRICE'][$counter]['ENDING_QUANTITY']   = ($queryProduct->row()->QUANTITY_MAX == 999 ? 'Above ' . $queryProduct->row()->QUANTITY_MIN + 1 : $queryProduct->row()->QUANTITY_MAX);
                            $productArr['PRICE'][$counter]['FLAG']              = ($queryProduct->num_rows() == 1 ? 'No EXW Price' : 'EXW Price Exist');
                        }


                        $productArr['PICTURE_LIST'][]['PICTURE'] = $queryProduct->row()->IMAGES1;
                        $productArr['PICTURE_LIST'][]['PICTURE'] = $queryProduct->row()->IMAGES2;
                        $productArr['PICTURE_LIST'][]['PICTURE'] = $queryProduct->row()->IMAGES3;
                        $productArr['PICTURE_LIST'][]['PICTURE'] = $queryProduct->row()->IMAGES3;

                        if ($queryProduct->row()->IMAGES1 != null) {
                            $productArr['MAIN_PICTURE'] = $queryProduct->row()->IMAGES1;
                        } else if ($queryProduct->row()->IMAGES2 != null) {
                            $productArr['MAIN_PICTURE'] = $queryProduct->row()->IMAGES2;
                        } else if ($queryProduct->row()->IMAGES3 != null) {
                            $productArr['MAIN_PICTURE'] = $queryProduct->row()->IMAGES3;
                        } else if ($queryProduct->row()->IMAGES4 != null) {
                            $productArr['MAIN_PICTURE'] = $queryProduct->row()->IMAGES4;
                        }

                        $msg = array(
                            'status'            => 'ok',
                            'code'              => 200,
                            'productID'         => $productID,
                            'minimumOrder'      => ($queryProduct->row()->QUANTITY_MIN == 0 ? 1 : $queryProduct->row()->QUANTITY_MIN),
                            'startingPrice'     => ($queryProduct->row()->QUANTITY_PRICE == null ? 'Price Negotiable' : $queryProduct->row()->QUANTITY_PRICE),
                            'matrics'           => 'Pcs',
                            'estimated_weight'  => '10 Kg',
                            'item'              => $productArr,
                            'query'             => $this->db->last_query()
                        );

                        // $productForApp['PRICE'][$counter]['PRICE'] = 'Price Negotiable';
                        // $productForApp['PRICE'][$counter]['STARTING_QUANTITY'] = '1';
                        // $productForApp['PRICE'][$counter]['ENDING_QUANTITY'] = '';
                        // $productForApp['PRICE'][$counter]['FLAG'] = 'No EXW Price';

                        // $productForApp['PICTURE_LIST'][]['PICTURE'] = $newPath . $obj['detail']['productForApp']['picture'];
                        // $productForApp['MAIN_PICTURE'] = $newPath . $obj['detail']['productForApp']['picture'];


                    }
                } else {
                    $msg = array(
                        'status'    => 'ok',
                        'code'      => 204,
                        'message'   => 'incomplete parameter, id is missing'
                    );
                }
            }
        } else {
            $msg = array(
                'status'    => 'ok',
                'code'      => 204,
                'message'   => 'incomplete api parameter'
            );
        }

        echo json_encode($msg);
    }
}
