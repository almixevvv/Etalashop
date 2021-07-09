<?php

use function PHPSTORM_META\map;

if (!defined("BASEPATH")) exit("Hack Attempt");

class Seeding extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function index()
    {
        echo 'test';
    }

    public function seedProducts()
    {
        $faker = Faker\Factory::create('en_US');
        $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));

        try {
            $this->db->trans_start();

            for ($i = 0; $i < 10; $i++) {

                echo $i;

                // $rowID = $faker->md5;


                // $injectMaster = array(
                //     'PRODUCT_ID'        => substr($rowID, 0, 10),
                //     'PRODUCT_NAME'      => ucwords($faker->bs),
                //     'SKU'               => $faker->numerify('SKU-#####-####-##'),
                //     'CATEGORY'          => (string) $this->seedCategory(),
                //     'CREATED'           => date('Y-m-d h:i:s'),
                //     'STATUS'            => 'ACTIVE',
                //     'USER_ID'           => 'ADMIN',
                //     'PRODUCT_DETAIL'    => '<p>' . $faker->realText(190, 2) . '</p>'
                // );

                // $injectImage = array(
                //     'PRODUCT_ID'        => substr($rowID, 0, 10),
                //     'IMAGES1'           => substr($faker->picsum('./assets/uploads/products', 400, 400, true), 26),
                //     'IMAGES2'           => substr($faker->picsum('./assets/uploads/products', 400, 400, true), 26),
                //     'IMAGES3'           => substr($faker->picsum('./assets/uploads/products', 400, 400, true), 26),
                //     'IMAGES4'           => substr($faker->picsum('./assets/uploads/products', 400, 400, true), 26),
                //     'CREATED'           => date('Y-m-d h:i:s')
                // );

                // $this->cms->insertGeneralData('g_product_master', $injectMaster);
                // $this->cms->insertGeneralData('g_product_images', $injectImage);

                // $qtyAmmount = rand(2, 5);

                // for ($j = 0; $j < $qtyAmmount; $j++) {

                //     $qtyMin = rand(1, 100);
                //     $qtyMax = rand(1, 100);

                //     if ($qtyMin > $qtyMax) {
                //         $tmpQty = $qtyMin;

                //         $qtyMin = $qtyMax;
                //         $qtyMin = $tmpQty;
                //     }

                //     $injectQuantity = array(
                //         'PRODUCT_ID'        => substr($rowID, 0, 10),
                //         'QUANTITY_MIN'      => $qtyMin,
                //         'QUANTITY_MAX'      => $qtyMax,
                //         'QUANTITY_PRICE'    => $faker->randomNumber('4', true),
                //         'CREATED'           => date('Y-m-d h:i:s')
                //     );

                //     $this->cms->insertGeneralData('g_product_quantity', $injectQuantity);
                // }

                // $this->db->trans_complete();

                // if ($this->db->trans_status() === FALSE) {
                //     $this->db->trans_rollback();
                //     throw new Exception('Insert error.');
                // } else {
                //     $this->db->trans_commit();

                //     echo json_encode(array(
                //         'total_data'    => $i,
                //         'status'        => 200,
                //         'message'       => 'finish process'
                //     ));
                // }
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }

        // use the factory to create a Faker\Generator instance
        // $faker = Faker\Factory::create();

        // generate data by accessing properties
        // echo $faker->name;
    }

    public function seedCategory()
    {

        $this->db->select('*');
        $this->db->from('m_category');
        $this->db->where('PARENT !=', '0');
        $this->db->order_by('RAND()');
        $this->db->limit('1');

        $queryCategory = $this->db->get();

        return $queryCategory->row()->LINK;
    }
}
