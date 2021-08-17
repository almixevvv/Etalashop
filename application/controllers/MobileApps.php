<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class MobileApps extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        header('Content-Type: application/json');

        $this->load->model('M_api', 'api');
        date_default_timezone_set('Asia/Jakarta');
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

    /*
    *   BASIC SECTION
    */
    public function home()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            $this->db->select('*')
                ->from('g_product_master')
                ->order_by('RAND()')
                ->limit($this->input->get('pageSize'));

            $queryProduct = $this->db->get();

            foreach ($queryProduct->result() as $result) {

                $this->db->select('*')
                    ->from('g_product_quantity')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID)
                    ->order_by('QUANTITY_MIN')
                    ->limit(1);

                $queryQuantity = $this->db->get();

                $this->db->select('*')
                    ->from('g_product_images')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID);

                $queryImages = $this->db->get();

                $productList[] = array(
                    'ID'                => $result->PRODUCT_ID,
                    'TITLE'             => $result->PRODUCT_NAME,
                    'PICTURE'           => base_url('assets/uploads/products/' . $queryImages->row()->IMAGES1),
                    'START_QUANTITY'    => $queryQuantity->row()->QUANTITY_MIN,
                    'PRICE'             => $queryQuantity->row()->QUANTITY_PRICE
                );
            }

            $productList = json_encode($productList);

            echo json_encode(array(
                'status'    => 'ok',
                'code'      => 200,
                'message'   => $queryProduct->num_rows() . ' products list found',
                'data'      => json_decode($productList)
            ));
        } else {
            echo json_encode($checkPermission);
        }
    }

    public function search()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            $this->db->select('*')
                ->from('g_product_master')
                ->like('PRODUCT_NAME', $this->input->get('query'));

            $querySearch = $this->db->get();

            if ($querySearch->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid product id',
                    'data'      => (object) []
                ));

                return;
            }

            foreach ($querySearch->result() as $result) {

                $this->db->select('*')
                    ->from('g_product_quantity')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID)
                    ->order_by('QUANTITY_MIN')
                    ->limit(1);

                $queryQuantity = $this->db->get();

                $this->db->select('*')
                    ->from('g_product_images')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID);

                $queryImages = $this->db->get();

                $productList[] = array(
                    'ID'                => $result->PRODUCT_ID,
                    'TITLE'             => $result->PRODUCT_NAME,
                    'PICTURE'           => base_url('assets/uploads/products/' . $queryImages->row()->IMAGES1),
                    'START_QUANTITY'    => $queryQuantity->row()->QUANTITY_MIN,
                    'PRICE'             => $queryQuantity->row()->QUANTITY_PRICE
                );
            }

            $productList = json_encode($productList);

            echo json_encode(array(
                'status'    => 'ok',
                'pageSize'  => $querySearch->num_rows(),
                'code'      => 200,
                'message'   => json_decode($productList),
            ));
        } else {
            echo json_encode($checkPermission);
        }
    }

    public function categoryProduct()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            $this->db->select('*')
                ->from('g_product_master')
                ->where('CATEGORY', $this->input->get('category'));

            $queryCategory = $this->db->get();

            $this->db->select('*')
                ->from('m_category')
                ->where('LINK', $this->input->get('category'));

            $queryCategoryList = $this->db->get();

            if ($queryCategory->num_rows() == 0) {

                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'no product found',
                    'data'      => (object) []
                ));

                return;
            }

            if ($queryCategoryList->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid category id',
                    'data'      => (object) []
                ));

                return;
            }

            foreach ($queryCategory->result() as $result) {

                $this->db->select('*')
                    ->from('g_product_quantity')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID)
                    ->order_by('QUANTITY_MIN')
                    ->limit(1);

                $queryQuantity = $this->db->get();

                $this->db->select('*')
                    ->from('g_product_images')
                    ->where('PRODUCT_ID', $result->PRODUCT_ID);

                $queryImages = $this->db->get();

                $productList[] = array(
                    'ID'                => $result->PRODUCT_ID,
                    'TITLE'             => $result->PRODUCT_NAME,
                    'PICTURE'           => base_url('assets/uploads/products/' . $queryImages->row()->IMAGES1),
                    'START_QUANTITY'    => $queryQuantity->row()->QUANTITY_MIN,
                    'PRICE'             => $queryQuantity->row()->QUANTITY_PRICE
                );
            }

            $productList = json_encode($productList);

            echo json_encode(array(
                'status'    => 'ok',
                'code'      => 200,
                'message'   => $queryCategory->num_rows() . ' products list found',
                'data'      => json_decode($productList)
            ));
        } else {
            echo json_encode($checkPermission);
        }
    }

    public function product()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            $queryProduct = $this->api->getGeneralData('v_g_products', 'PRODUCT_ID', $this->input->get('id'));

            if ($queryProduct->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid product id',
                ));

                return;
            } else {
                $productData  = $queryProduct->result();

                $msg = array(
                    'status'    => 'ok',
                    'code'      => 200,
                    'message'   => $productData,
                );
            }

            echo json_encode($msg);
        } else {
            echo json_encode($checkPermission);
        }
    }

    public function category()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            $parentArray    = array();
            $parent         = $this->category->getParentCategory();
            $parentCounter  = 0;

            if ($this->input->get('category') == null || $this->input->get('category') == '') {
                $parent = $this->category->getParentCategory();
            } else {
                $parent = $this->category->getSingleCategory($this->input->get('category'));
            }

            foreach ($parent->result() as $parents) {

                $childArray     = array();

                $childCounter     = 0;
                $childs         = $this->category->getChildCategory($parents->ID);

                foreach ($childs->result() as $child) {

                    $childName  = $child->NAME;
                    $childID    = $child->LINK;

                    $childArray[$childCounter] = array(
                        'CHILD_NAME'    => $childName,
                        'CHILD_ID'      => $childID
                    );

                    $childCounter++;
                    $detailDecode = json_encode($childArray);
                }

                $parentArray[$parentCounter] = array(
                    'NAME'          => $parents->NAME,
                    'ID'            => $parents->ID,
                    'PARENT'        => $parents->PARENT,
                    'PICTURE'       => $parents->PICTURE,
                    'CHILD'         => json_decode($detailDecode)
                );

                $parentCounter++;
            }

            $json = json_encode($parentArray);

            echo json_encode(array(
                'status'    => 'ok',
                'code'      => 200,
                'data'      => json_decode($json)
            ));
        } else {
            echo json_encode($checkPermission);
        }
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

    /*
    *   ACCOUNT SECTION 
    */

    public function messages()
    {

        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {


            $orderID            = $this->input->get('id');
            $messageData        = $this->profile->getOrderMessages($orderID);
            $messageSender      = $this->profile->getMessageSender($orderID);
            $counter            = 0;

            if ($messageSender->num_rows() == 0) {

                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid order id',
                    'data'      => (object) []
                ));

                return;
            }

            foreach ($messageSender->result() as $detail) {

                if ($messageData->num_rows() == 0) {

                    echo json_encode(array(
                        'status'    => 'ok',
                        'code'      => 204,
                        'message'   => 'no message history',
                        'data'      => (object) []
                    ));

                    return;
                }

                foreach ($messageData->result() as $data) {

                    $message[$counter] = array(
                        'SENDER'            => $data->SENDER_ID,
                        'MESSAGE'           => $data->MESSAGE,
                        'MESSAGE_TIME'      => $data->MESSAGE_TIME,
                        'USER_READ_FLAG'    => $data->USER_READ_FLAG,
                        'ADMIN_READ_FLAG'   => $data->ADMIN_READ_FLAG
                    );

                    $counter++;
                }

                $encode = json_encode($message);

                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 200,
                    'message'   => 'message exist',
                    'data'      => array(
                        'SENDER_EMAIL'  => $detail->MEMBER_EMAIL,
                        'MESSAGE_DATA'  => json_decode($encode)
                    )
                ));
            }
        } else {
            echo json_encode($checkPermission);
        }
    }

    public function sendMessage()
    {
        $checkPermission = $this->incube->basicAuth();

        $checkPermission = json_decode($checkPermission);

        if ($checkPermission->code == 200) {

            if (strlen($this->input->post('orderID')) == 0 || $this->input->post('orderID') == '') {
                echo json_encode(array(
                    'status'    => 'error',
                    'code'      => 400,
                    'message'   => 'incomplete parameter, missing orderID',
                    'data'      => (object) []
                ));

                return;
            }

            if (strlen($this->input->post('message')) == 0 || $this->input->post('message') == '') {
                echo json_encode(array(
                    'status'    => 'error',
                    'code'      => 400,
                    'message'   => 'incomplete parameter, message cannot be empty',
                    'data'      => (object) []
                ));

                return;
            }


            $this->db->select('*')
                ->from('g_order_master')
                ->where('ORDER_ID', $this->input->post('orderID'));

            $queryOrderID = $this->db->get();

            if ($queryOrderID->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 204,
                    'message'   => 'invalid order id',
                    'data'      => (object) []
                ));

                return;
            }


            $data = array(
                'SENDER_ID'             => 'CUSTOMER',
                'ORDER_ID'              => $this->input->post('orderID'),
                'MESSAGE'               => $this->input->post('message'),
                'MESSAGE_TIME'          => date('Y-m-d H:m:s'),
                'USER_READ_FLAG'        => '0',
                'ADMIN_READ_FLAG'       => '1'
            );

            if ($this->profile->sendMessages($data)) {
                echo json_encode(array(
                    'status'    => 'ok',
                    'code'      => 200,
                    'message'   => 'message sent',
                    'data'      => (object) []
                ));
            } else {
                echo json_encode(array(
                    'status'    => 'error',
                    'code'      => 500,
                    'message'   => 'query error',
                    'data'      => (object) []
                ));
            }
        } else {
            echo json_encode($checkPermission);
        }
    }
}
