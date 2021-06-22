<?php class M_cms extends CI_Model
{
    //General Function
    public function getGeneralListOrderedLimit($table, $field, $query, $limit)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($field, $query);
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query;
    }

    public function getGeneralListGroup($table, $group)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->group_by($group);

        $query = $this->db->get();

        return $query;
    }

    public function getGeneralListOrdered($table, $field, $query)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($field, $query);

        $query = $this->db->get();

        return $query;
    }

    public function getGeneralData($table, $field, $query)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $query);

        $query = $this->db->get();

        return $query;
    }

    public function getSpecificData($table, $field, $query, $field2, $query2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $query);
        $this->db->where($field2, $query2);

        $query = $this->db->get();

        return $query;
    }

    public function deleteGeneralData($table, $field, $query)
    {
        $this->db->where($field, $query);
        $query = $this->db->delete($table);

        return $query;
    }

    public function updateGeneralData($table, $field, $query, $data)
    {
        $this->db->where($field, $query);
        $query = $this->db->update($table, $data);

        return $query;
    }

    function insertGeneralData($table, $data)
    {
        $query = $this->db->insert($table, $data);

        return $query;
    }
    //End of General Function


    //------------------------------------------------------------------------------------------------------------------- LOGIN CMS
    function cms_login($email, $password)
    {

        $this->db->select('*');
        $this->db->from('s_user');
        $this->db->where('ID', $email);
        $this->db->where('PASS', $password);

        $query = $this->db->get();

        return $query;
    }

    function checkUsername($email)
    {

        $this->db->select('*');
        $this->db->from('s_user');
        $this->db->where('ID', $email);

        $query = $this->db->get();

        return $query;
    }

    function generateID()
    {
        $ads_id = $this->getiklanid();
        if ($ads_id == '0') {
            $last_ads_id = 1;
        } else {
            $last_ads_id = intval(substr($ads_id, -6)) + 1;
        }
        $new_ads_id = "DSH" . date("ym") . str_pad(strval($last_ads_id), 6, "0", STR_PAD_LEFT);
        return $new_ads_id;
    }

    public function changePassword($id, $hashPassword)
    {

        $data = array(
            'PASS'  => $hashPassword
        );

        $this->db->where('ID', $id);
        $this->db->update('s_user', $data);
    }
    //------------------------------------------------------------------------------------------------------------------- LOGIN CMS

    //------------------------------------------------------------------------------------------------------------------- USER
    public function select_user()
    {
        $this->db->select('*');
        $this->db->from('s_user');

        $query = $this->db->get();

        return $query;
    }

    public function singleUser($id)
    {

        $this->db->select('*');
        $this->db->from('s_user');
        $this->db->where('ID', $id);

        $query = $this->db->get();

        return $query;
    }

    public function updateUser($hidden_id, $name, $group, $status)
    {

        $data = array(
            'NAME'  => $name,
            'GROUP_ID' => $group,
            'STATUS' => $status
        );

        $this->db->where('ID', $hidden_id);
        $this->db->update('s_user', $data);
    }

    public function addUser($data)
    {
        $insert = $this->db->insert('s_user', $data);

        return $insert;
    }

    public function delete_user($recID, $name)
    {

        $this->db->where('ID', $recID);
        $this->db->delete($name);
    }


    //------------------------------------------------------------------------------------------------------------------- USER

    //------------------------------------------------------------------------------------------------------------------- GROUP
    public function select_group()
    {
        $this->db->select('*');
        $this->db->from('s_group');

        $query = $this->db->get();

        return $query;
    }

    public function singleGroup($id)
    {

        $this->db->select('*');
        $this->db->from('s_group');
        $this->db->where('ID', $id);

        $query = $this->db->get();

        return $query;
    }

    public function delete_group($recID, $name)
    {

        $this->db->where('ID', $recID);
        $this->db->delete($name);
    }

    public function delete_group_appl($recID, $name)
    {

        $this->db->where('GROUP_ID', $recID);
        $this->db->delete($name);
    }

    public function updateUserGroup($hidden_id, $name, $desc)
    {

        $data = array(
            'NAME'  => $name,
            'DESCRIPTION' => $desc
        );

        $this->db->where('ID', $hidden_id);
        $this->db->update('s_group', $data);
    }

    public function deleteGroupapp($hidden_id)
    {
        $this->db->where('GROUP_ID', $hidden_id);
        $this->db->delete('s_group_appl');
    }

    public function selectAppl()
    {
        $this->db->select('*');
        $this->db->from('s_appl');
        $query = $this->db->get();

        return $query;
    }

    public function InsertGroupAppl($hidden_id, $appl_id, $role)
    {
        $data = array(
            'GROUP_ID' => $hidden_id,
            'APPL_ID' => $appl_id,
            'ROLE' => $role
        );

        return  $this->db->insert('s_group_appl', $data);
    }

    public function addGroup($data)
    {
        $insert = $this->db->insert('s_group', $data);

        return $insert;
    }

    //------------------------------------------------------------------------------------------------------------------- GROUP

    //-------------------------------------------------------------------------------------------------------------------  BANNER
    function select_banner()
    {
        $this->db->select('*');
        $this->db->from('g_banner');

        $query = $this->db->get();

        return $query;
    }
    function select_banner_detail($id)
    {
        $this->db->where('REC_ID', $id);
        $this->db->where('TYPE', $type);
        $this->db->where('LINK_TYPE', $link_type);
        $this->db->where('LINKTO', $linkto);
        $this->db->where('BANNER_IMAGE', $banner_img);
        $this->db->where('ORDER_NO', $order_no);
        $this->db->where('FLAG', $flag);
        $this->db->where('DESCRIPTION', $description);
        $this->db->where('CREATED', $created);
        $this->db->where('UPDATED', $updated);
        $this->db->where('USER_ID', $user_id);
        return $this->db->get('g_banner');
    }
    function update_banner($banner)
    {


        $data = array(
            'CONTENT' => $banner,
            'UPDATED'  => date('Y-m-d h:i:s')

        );

        $this->db->replace('g_about', $data);
        $data = array('TYPE' => $type);
        $data = array('LINK_TYPE' => $link_type);
        $data = array('LINKTO' => $linkto);
        $data = array('BANNER_IMAGE' => $banner_img);
        $data = array('ORDER_NO' => $order_no);
        $data = array('FLAG' => $flag);
        $data = array('DESCRIPTION' => $description);
        $data = array('CREATED' => $created);
        $data = array('UPDATED' => $updated);
        $data = array('USER_ID' => $user_id);

        $this->db->where('REC_ID', $id);
    }
    //-------------------------------------------------------------------------------------------------------------------  BANNER

    //-------------------------------------------------------------------------------------------------------------------  ABOUT
    function select_about()
    {
        $this->db->select('*');
        $this->db->from('g_about');
        $this->db->where('REC_ID', '1');

        $query = $this->db->get();

        return $query;
    }
    function select_about_detail($id)
    {
        $this->db->where('REC_ID', $id);
        return $this->db->get('g_about');
    }
    function update_about($about)
    {
        return $this->db->query("update g_about set
                                    CONTENT='" . $about . "',
                                    UPDATED='" . date('Y-m-d h:i:s') . "'
                                    where REC_ID=1");
    }
    //-------------------------------------------------------------------------------------------------------------------  ABOUT

    //-------------------------------------------------------------------------------------------------------------------  TERMS
    function select_terms()
    {
        $this->db->select('*');
        $this->db->from('g_terms');

        $query = $this->db->get();

        return $query;
    }
    function select_terms_detail($id)
    {
        $this->db->where('REC_ID', $id);
        return $this->db->get('g_terms');
    }
    function update_terms($terms, $id)
    {
        $data = array(
            'CONTENT' => $terms

        );
        // $this->db->where('REC_ID', $id);
        $this->db->update('g_terms', $data);
    }
    //-------------------------------------------------------------------------------------------------------------------  TERMS

    //-------------------------------------------------------------------------------------------------------------------  FAQ
    function select_faq()
    {
        $this->db->select('*');
        $this->db->from('g_faq');

        $query = $this->db->get();

        return $query;
    }
    function select_faq_detail($id)
    {
        $this->db->where('REC_ID', $id);
        return $this->db->get('g_faq');
    }
    function update_faq($faq)
    {
        $data = array(
            'CONTENT' => $faq

        );

        $this->db->update('g_faq', $data);
    }
    //-------------------------------------------------------------------------------------------------------------------  FAQ

    //-------------------------------------------------------------------------------------------------------------------  PRIVACY
    function select_privacy()
    {
        $this->db->select('*');
        $this->db->from('g_privacy');
        $this->db->where('REC_ID', '1');

        $query = $this->db->get();

        return $query;
    }
    function select_privacy_detail($id)
    {
        $this->db->where('REC_ID', $id);
        return $this->db->get('g_privacy');
    }
    function update_privacy($privacy)
    {
        $data = array(
            'CONTENT' => $privacy

        );

        $this->db->update('g_privacy', $data);
    }
    //-------------------------------------------------------------------------------------------------------------------  PRIVACY

    //-------------------------------------------------------------------------------------------------------------------  MEMBER
    function select_member()
    {
        $this->db->select('*');
        $this->db->from('g_member');

        $query = $this->db->get();

        return $query;
    }

    function singleMember($id)
    {

        $this->db->select('*');
        $this->db->from('g_member');
        $this->db->where('ID', $id);

        $query = $this->db->get();

        return $query;
    }

    function updateMember($id, $email, $phone, $add1, $add2, $country, $province)
    {

        $data = array(

            'EMAIL'  => $email,
            'PHONE' => $phone,
            'ADDRESS' => $add1,
            'ADDRESS_2'  => $add2,
            'COUNTRY' => $country,
            'PROVINCE' => $province
        );

        $this->db->where('ID', $id);
        $this->db->update('g_member', $data);
    }

    function updatePass($id, $pass)
    {

        $hashPassword = sha1('abc123');


        $data = array(

            'PASSWORD' => $hashPassword
        );

        $this->db->where('ID', $id);
        $this->db->update('g_member', $data);
    }

    function delete_member($id, $email)
    {

        $this->db->where('ID', $id);
        $this->db->delete($email);
    }
    //-------------------------------------------------------------------------------------------------------------------  MEMBER

    //-------------------------------------------------------------------------------------------------------------------  CONTACT
    function select_contact()
    {
        $this->db->select('*');
        $this->db->from('g_contactus');

        $query = $this->db->get();

        return $query;
    }
    function select_contact_detail($id)
    {
        $this->db->where('REC_ID', $id);
        return $this->db->get('g_contactus');
    }
    function update_contact($id, $title, $desc)
    {
        $data = array(
            'TITLE' => $title,
            'DESCRIPTION' => $desc

        );
        $this->db->where('REC_ID', $id);
        $this->db->update('g_contactus', $data);
    }
    //-------------------------------------------------------------------------------------------------------------------  CONTACT

    //-------------------------------------------------------------------------------------------------------------------  ORDER
    function select_order()
    {
        $this->db->select('*');
        $this->db->from('v_g_order_master');
        $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function select_order_new()
    {
        $this->db->select('COUNT(*) as new_order');
        $this->db->from('v_g_order_master');
        $this->db->where('STATUS_ORDER', 'NEW ORDER');
        // $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function select_order_updated()
    {
        $this->db->select('COUNT(*) as updated_order');
        $this->db->from('v_g_order_master');
        $this->db->where('STATUS_ORDER', 'UPDATED');
        // $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function select_order_confirmed()
    {
        $this->db->select('COUNT(*) as confirmed_order');
        $this->db->from('v_g_order_master');
        $this->db->where('STATUS_ORDER', 'CONFIRMED');
        // $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function select_order_paid()
    {
        $this->db->select('COUNT(*) as paid_order');
        $this->db->from('v_g_order_master');
        $this->db->where('STATUS_ORDER', 'PAID');
        // $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function select_order_unview()
    {
        $this->db->select('COUNT(*) as unview_order');
        $this->db->from('v_g_order_master');
        $this->db->where('VIEW_FLAG', '0');
        // $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function singleOrder($orderNo)
    {

        $this->db->select('*');
        $this->db->from('v_g_order_master');
        $this->db->where('ORDER_NO', $orderNo);

        $query = $this->db->get();

        return $query;
    }

    function showProducts($orderNo)
    {

        $this->db->select('*');
        $this->db->from('g_order_detail');
        $this->db->where('ORDER_NO', $orderNo);

        $query = $this->db->get();

        return $query->result();
    }

    function updateOrderStatus($orderNo, $status, $importCost, $updated, $spc_instruction, $internal_notes)
    {

        $data = array(

            'STATUS'  => $status,
            'TOTAL_POSTAGE' => $importCost,
            'SPC_INSTRUCTION' => $spc_instruction,
            'INTERNAL_NOTES' => $internal_notes,
            'UPDATED' => $updated
        );

        $this->db->where('ORDER_NO', $orderNo);
        $this->db->update('g_order_master', $data);
    }

    function updateFinalPrice($prodID, $amount, $quantity)
    {

        $data = array(

            'FINAL_PRICE'  => $amount,
            'QUANTITY' => $quantity
        );

        $this->db->where('PROD_ID', $prodID);
        $this->db->update('g_order_detail', $data);
    }

    function singlePayment($id)
    {

        $this->db->select('*');
        $this->db->from('g_confirm_payment');
        $this->db->where('ORDER_ID', $id);

        $query = $this->db->get();

        return $query;
    }

    function confirmStatus($id)
    {
        $data = array(

            'STATUS'  => 'PAID'
        );

        $this->db->where('ORDER_NO', $id);
        $this->db->update('g_order_master', $data);
    }

    function getOrderMasterDataFromQuery($query)
    {

        $this->db->select('*');
        $this->db->from('v_g_order_master');
        $this->db->where('STATUS_ORDER', $query);
        $this->db->order_by('ORDER_DATE', 'DESC');

        $query = $this->db->get();

        return $query;
    }

    function updateFlagInvoce($orderNo)
    {
        $data = array(

            'FLAG'  => 1,
        );

        $this->db->where('ORDER_NO', $orderNo);
        $this->db->update('g_order_master', $data);
    }

    function delete_order_master($orderNo, $id)
    {

        $this->db->where('ORDER_NO', $orderNo);
        $this->db->delete($id);
    }

    function delete_order_detail($orderNo, $id)
    {

        $this->db->where('ORDER_NO', $orderNo);
        $this->db->delete($id);
    }


    //-------------------------------------------------------------------------------------------------------------------  ORDER

    //-------------------------------------------------------------------------------------------------------------------  MESSAGE
    function getOrderMessages($orderID)
    {

        $this->db->select('*');
        $this->db->from('g_message');
        $this->db->where('ORDER_ID', $orderID);

        $query = $this->db->get();

        return $query;
    }
    //-------------------------------------------------------------------------------------------------------------------  MESSAGE

    //-------------------------------------------------------------------------------------------------------------------  MARGIN & RATE
    function select_margin()
    {
        $this->db->select('*');
        $this->db->from('g_convert');

        $query = $this->db->get();

        return $query;
    }

    function select_rate()
    {
        $this->db->select('*');
        $this->db->from('g_rate');

        $query = $this->db->get();

        return $query;
    }

    function singleMargin($id)
    {

        $this->db->select('*');
        $this->db->from('g_convert');
        $this->db->where('REC_ID', $id);

        $query = $this->db->get();

        return $query;
    }

    function singleRate($id)
    {

        $this->db->select('*');
        $this->db->from('g_rate');
        $this->db->where('REC_ID', $id);

        $query = $this->db->get();

        return $query;
    }

    function updateMargin($recID, $id, $value, $updated, $description)
    {

        $data = array(

            'ID'  => $id,
            'VALUE' => $value,
            'UPDATED_TIME' => $updated,
            'DESCRIPTION' => $description
        );

        $this->db->where('REC_ID', $recID);
        $this->db->update('g_convert', $data);
    }

    function updateRate($recID, $id, $value, $updated, $description)
    {

        $data = array(

            'ID'  => $id,
            'VALUE' => $value,
            'UPDATED_TIME' => $updated,
            'DESCRIPTION' => $description
        );

        $this->db->where('REC_ID', $recID);
        $this->db->update('g_rate', $data);
    }

    function insert_margin($data)
    {
        $insert = $this->db->insert('g_convert', $data);

        return $insert;
    }

    function insert_rate($data)
    {
        $insert = $this->db->insert('g_rate', $data);

        return $insert;
    }

    function set_as_current($recID)
    {
        $data = array(

            'STATUS'  => 'CURRENT'
        );

        $this->db->where('REC_ID', $recID);
        $this->db->update('g_convert', $data);
    }

    function set_as_current_rate($recID)
    {
        $data = array(

            'STATUS'  => 'CURRENT'
        );

        $this->db->where('REC_ID', $recID);
        $this->db->update('g_rate', $data);
    }

    function delete_margin($recID, $id)
    {

        $this->db->where('REC_ID', $recID);
        $this->db->delete($id);
    }

    function delete_rate($recID, $id)
    {

        $this->db->where('REC_ID', $recID);
        $this->db->delete($id);
    }

    function updateStatus()
    {

        $data = array(
            'STATUS' => 'HISTORY'
        );

        $this->db->where('STATUS', 'CURRENT');
        $this->db->update('g_convert', $data);
    }

    function updateStatusRate()
    {

        $data = array(
            'STATUS' => 'HISTORY'
        );

        $this->db->where('STATUS', 'CURRENT');
        $this->db->update('g_rate', $data);
    }

    function updateCurrentStatus()
    {

        $data = array(
            'STATUS' => 'CURRENT'
        );

        $this->db->where('STATUS', 'HISTORY');
        $this->db->update('g_convert', $data);
    }
    //-------------------------------------------------------------------------------------------------------------------  MARGIN
}
