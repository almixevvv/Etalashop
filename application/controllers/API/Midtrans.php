<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Midtrans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
        header('Content-Type: application/json');

        $this->load->library('incube');
    }

    public function index()
    {
        echo 'kemari';
    }

    public function createSnap()
    {

        //1. Ambil data detail cart user
        $hashEmail  = sha1($this->input->post('txt-email'));
        $carts      = $this->carts->displayCart($hashEmail);

        $subtotal    = 0;
        $totalWeight = 0;

        //1.1 Validasi apa bener ada data aktif
        if ($carts->num_rows() == 0) {
            echo json_encode(array(
                'status'    => 'invalid',
                'code'      => 204,
                'message'   => 'no active cart items'
            ));

            return;
        }
        //EoL 1.1

        //EoL 1

        //2. Hitung total belanja dari item ini

        foreach ($carts->result() as $items) {
            //2.1. Calculate the item price
            $subtotal     = $subtotal + ($items->PRODUCT_PRICE == null ? 0 : $items->PRODUCT_PRICE);
            //EoL 1.1

            //2.2 Calculate the item weight
            $curWeight   = $items->WEIGHT * $items->PRODUCT_QUANTITY;
            $totalWeight = $totalWeight + $curWeight;
            //EoL 2.2

            //2.3 Calculate the weight cost 
            $weightPrice = $totalWeight * WEIGHT_PRICE;
            //EoL 2.3
        }

        $totalPrice = $subtotal + $weightPrice;
        //EoL 2

        //3. Setup variabel Midtrans
        $salt = sha1($this->incube->generateID('10'));

        $transDetails = array(
            'order_id'      => $salt,
            'gross_amount'  => (int) $totalPrice
        );

        foreach ($carts->result() as $item) {
            $arrDetails[] = array(
                'id'        => $item->PRODUCT_ID,
                'price'     => (int) ($item->PRODUCT_PRICE / $item->PRODUCT_QUANTITY),
                'quantity'  => (int) $item->PRODUCT_QUANTITY,
                'name'      => $item->PRODUCT_NAME
            );
        }

        $postage = array(
            'id'        => 'postage',
            'price'     => (int) $weightPrice,
            'quantity'  => 1,
            'name'      => 'Total Postage'
        );

        array_push($arrDetails, $postage);

        //3.1 Kalau misalnya user pilih Shipping sama kayak data dia register
        if ($this->input->post('clear-data') == null) {

            // 3.1 Ambil data dari database
            $userQuery = $this->api->getGeneralData('g_member', 'REC_ID', $this->input->post('id-user'));

            //3.1.1 Validasi data user
            if ($userQuery->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'invalid',
                    'code'      => 204,
                    'message'   => 'no member data found',
                    'test'      => $this->db->last_query()
                ));

                return;
            }
            //3.1.1

            // Optional
            $billing_address = array(
                'first_name'    => $userQuery->row()->FIRST_NAME,
                'last_name'     => $userQuery->row()->LAST_NAME,
                'address'       => $userQuery->row()->ADDRESS . ' ' . $userQuery->row()->ADDRESS_2,
                'city'          => $userQuery->row()->PROVINCE,
                'postal_code'   => $userQuery->row()->ZIP,
                'phone'         => $userQuery->row()->PHONE,
                'country_code'  => 'IDN'
            );

            // Optional
            $shipping_address = array(
                'first_name'    => $userQuery->row()->FIRST_NAME,
                'last_name'     => $userQuery->row()->LAST_NAME,
                'address'       => $userQuery->row()->ADDRESS . ' ' . $userQuery->row()->ADDRESS_2,
                'city'          => $userQuery->row()->PROVINCE,
                'postal_code'   => $userQuery->row()->ZIP,
                'phone'         => $userQuery->row()->PHONE,
                'country_code'  => 'IDN'
            );

            // Optional
            $customer_details = array(
                'first_name'        => $userQuery->row()->FIRST_NAME,
                'last_name'         => $userQuery->row()->LAST_NAME,
                'email'             => $userQuery->row()->EMAIL,
                'phone'             => $userQuery->row()->PHONE,
                'billing_address'   => $billing_address,
                'shipping_address'  => $shipping_address
            );
        }

        //3.2 Kalo misalnya ga dipilih, ambil data dari form
        else {

            // 3.2 Ambil data dari database
            $userQuery = $this->api->getGeneralData('g_member', 'REC_ID', $this->input->post('id-user'));

            //3.2.2 Validasi data user
            if ($userQuery->num_rows() == 0) {
                echo json_encode(array(
                    'status'    => 'invalid',
                    'code'      => 204,
                    'message'   => 'no member data found'
                ));

                return;
            }
            //3.2.2

            // Optional
            $billing_address = array(
                'first_name'    => $userQuery->row()->FIRST_NAME,
                'last_name'     => $userQuery->row()->LAST_NAME,
                'address'       => $userQuery->row()->ADDRESS . ' ' . $userQuery->row()->ADDRESS_2,
                'city'          => $userQuery->row()->PROVINCE,
                'postal_code'   => $userQuery->row()->ZIP,
                'phone'         => $userQuery->row()->PHONE,
                'country_code'  => 'IDN'
            );

            // Optional
            $shipping_address = array(
                'first_name'    => $this->input->post('txt-name'),
                'last_name'     => '',
                'address'       => $this->input->post('txt-address-1') .  ' ' . $this->input->post('txt-address-2'),
                'city'          => $this->input->post('txt-state'),
                'postal_code'   => $this->input->post('txt-zip'),
                'phone'         => $this->input->post('txt-phone'),
                'country_code'  => 'IDN'
            );

            // Optional
            $customer_details = array(
                'first_name'        => $userQuery->row()->FIRST_NAME,
                'last_name'         => $userQuery->row()->LAST_NAME,
                'email'             => $userQuery->row()->EMAIL,
                'phone'             => $userQuery->row()->PHONE,
                'billing_address'   => $billing_address,
                'shipping_address'  => $shipping_address
            );
        }
        //EoL 3.2

        //EoL 3

        $channelsQuery = $this->api->getGeneralData('g_payment_channel', 'STATUS', 'ACTIVE');

        $channelArr = array();

        foreach ($channelsQuery->result() as $channel) {
            array_push($channelArr, $channel->CHANNEL_NAME);
        }

        // Fill transaction details
        $transaction = array(
            'enabled_payments'      => $channelArr,
            'transaction_details'   => $transDetails,
            'customer_details'      => $customer_details,
            'item_details'          => $arrDetails,
        );

        Midtrans\Config::$serverKey = SERVER_KEY;
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        Midtrans\Config::$paymentIdempotencyKey = $salt;

        try {
            $snapToken = Midtrans\Snap::getSnapToken($transaction);

            echo json_encode(array(
                'status'        => 'success',
                'code'          => 200,
                'message'       => $snapToken
            ));
        } catch (Exception $ex) {

            echo json_encode(array(
                'status'        => 'api_error',
                'code'          => 504,
                'message'       => $ex->getMessage(),
            ));

            return;
        }
    }

    public function temporary()
    {

        for ($i = 0; $i < 20; $i++) {
            $randomSalt = md5(uniqid(rand(), true));
            $salt = substr($randomSalt, 0, 20);

            echo "'" . $salt . "'";
            echo '<br>';
        }
    }
}
