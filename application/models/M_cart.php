<?php class M_cart extends CI_Model
{

    function generateID()
    {
        $ads_id = $this->getiklanid();
        if ($ads_id == '0') {
            $last_ads_id = 1;
        } else {
            $last_ads_id = intval(substr($ads_id, -6)) + 1;
        }
        $new_ads_id = "KKU" . date("ym") . str_pad(strval($last_ads_id), 6, "0", STR_PAD_LEFT);
        return $new_ads_id;
    }

    function getiklanid()
    {
        $this->db->from('g_order_master');
        $this->db->order_by("ORDER_NO", "DESC");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $ads_id = $query->first_row()->ORDER_NO;
            return $ads_id;
        } else {
            $ads_id = '0';
            return $ads_id;
        }
    }

    function displayCart($email)
    {

        $this->db->select('*');
        $this->db->from('g_cart');
        $this->db->where('CART_ID', $email);
        $this->db->where('CART_FLAG', '0');
        $this->db->order_by('REC_ID', 'ASC');

        $query = $this->db->get();

        return $query;
    }

    function updateCartContents($productID, $productBuyer, $updateArray)
    {

        $this->db->set($updateArray);
        $this->db->where('PRODUCT_BUYER', $productBuyer);
        $this->db->where('PRODUCT_ID', $productID);

        $query = $this->db->update('g_cart');

        return $query;
    }

    function updateCartFlag($productID, $productBuyer)
    {

        $this->db->set('CART_FLAG', '1');
        $this->db->where('CART_ID', $productBuyer);
        $this->db->where('PRODUCT_ID', $productID);

        $query = $this->db->update('g_cart');

        return $query;
    }

    function deleteItem($productID, $productBuyer)
    {

        $this->db->where('PRODUCT_BUYER', $productBuyer);
        $this->db->where('PRODUCT_ID', $productID);

        $query = $this->db->delete('g_cart');

        return $query;
    }

    function getItemInfo($prodID, $buyerEmail)
    {

        $this->db->select('*');
        $this->db->from('g_cart');
        $this->db->where('PRODUCT_ID', $prodID);
        $this->db->where('PRODUCT_BUYER', $buyerEmail);

        $query = $this->db->get();

        return $query;
    }

    function updateCartQuantity($quantity, $productBuyer, $productID)
    {

        $this->db->set($quantity);
        $this->db->where('PRODUCT_BUYER', $productBuyer);
        $this->db->where('PRODUCT_ID', $productID);

        $query = $this->db->update('g_cart');

        return $query;
    }

    function insertCartData($data)
    {

        $query =  $this->db->insert('g_cart', $data);

        return $query;
    }

    function insertMasterData($data)
    {

        $query = $this->db->insert('g_order_master', $data);

        return $query;
    }

    function insertOrderDetail($data)
    {

        $query =  $this->db->insert('g_order_detail', $data);

        return $query;
    }

    function insertPO($data)
    {
        $this->db->set('ORDER_DATE', 'NOW()', FALSE);
        $this->db->set('UPDATED', 'NOW()', FALSE);
        $insert = $this->db->insert('g_order_master', $data);

        return $insert;
    }

    function insertDetailPO($data)
    {
        $insert = $this->db->insert('g_order_detail', $data);

        return $insert;
    }

    function deleteCarts($id)
    {

        $this->db->where('REC_ID', $id);
        $this->db->delete('g_cart');

        return true;
    }

    function deleteCartsAPI($cartID, $productID)
    {

        $this->db->where('CART_ID', $cartID);
        $this->db->where('PRODUCT_ID', $productID);

        $query = $this->db->delete('g_cart');

        return $query;
    }

    function getUserDetails($email)
    {
        $this->db->select('*');
        $this->db->from('g_member');
        $this->db->where('EMAIL', $email);

        $query = $this->db->get();

        return $query;
    }
}
