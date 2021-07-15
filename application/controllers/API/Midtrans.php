<?php if (!defined("BASEPATH")) exit("Hack Attempt");

class Midtrans extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('incube');
    }

    public function createSnap()
    {
        $salt = sha1($this->incube->generateID('10'));

        Midtrans\Config::$serverKey = SERVER_KEY;
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        Midtrans\Config::$paymentIdempotencyKey = $salt;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );

        $snapToken = Midtrans\Snap::getSnapToken($params);

        echo $snapToken;

        // $faker = Faker\Factory::create('en_US');
        // $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    }
}
