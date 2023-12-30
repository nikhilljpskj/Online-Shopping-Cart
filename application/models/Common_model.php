<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [record_counts description]
     * @param  [type] $user_id [users id]
     * @return [INT]   user's id [description]
     * @author Gopinath Murugesan
     */

    public function record_counts($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_record_counts($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_record_counts_other($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_row($table, $constraint_array = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function specific_row_value($table, $constraint_array = '', $get_field)
    {
        
        
        $this->db->select($get_field);
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        
        return $result[$get_field];
    }

    public function records_all($table, $constraint_array = '', $order_by = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }
        $results = $this->db->get()->result();
        return $results;
    }

    public function specific_fields_records_all($table, $constraint_array = '', $get_field_array = '')
    {
        if (!empty($get_field_array)) {
            $this->db->select($get_field_array);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function common_insert($table, $data)
    {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function common_edit($table, $data, $where_array)
    {
        $this->db->trans_start();
        $this->db->update($table, $data, $where_array);
        $this->db->trans_complete();
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }

    public function common_delete($table, $where_array)
    {
        $this->db->delete($table, $where_array);
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function in_array_rec($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_rec($needle, $item, $strict))) {
                return true;
            }
        }
        return 0;
    }

    public function last_record($table, $pm_key, $date_column)
    {
        $query = $this->db->query("SELECT * FROM $table ORDER BY $pm_key DESC LIMIT 1");
        $result = $query->result_array();
        return $result;
    }

    public function common_table_last_updated($table, $pm_key, $date_column)
    {
        $this->db->select($date_column);
        $this->db->from($table);
        $this->db->order_by($pm_key, 'desc');
        $this->db->limit('1');
        $result = $this->db->get()->row_array();
        return $this->time_elapsed_string($result[$date_column]);
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function clean_url($string)
    {
        $url = strtolower($string);
        $url = str_replace(array("'", '"'), '', $url);
        $url = str_replace(array(' ', '+', '!', '&', '-', '/', '.'), '-', $url);
        $url = str_replace("?", "", $url);
        $url = str_replace("---", "-", $url);
        $url = str_replace("--", "-", $url);
        return $url;
    }

    public function sendEmailWithTemplate($email_array)
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $from_email_address = $this->dbvars->app_email;
        $from_email_name = $this->dbvars->app_name;
        $to_email_address = $email_array['to_email'];
        $email_subject = $email_array['subject'];
        $email_message = $email_array['message'];

        // Set to, from, message, etc.
        $this->email->from($from_email_address, $from_email_name);
        $this->email->to($to_email_address);
        $this->email->subject($email_subject);
        $this->email->message($email_message);
        $this->email->send();

        if (isset($email_array['cc'])) {
            $email_cc = $email_array['cc'];
            $this->email->cc($email_cc);
        }
        if (isset($email_array['bcc'])) {
            $email_bcc = $email_array['bcc'];
            $this->email->cc($email_bcc);
        }

        echo $this->email->print_debugger();
        $result = $this->email->send();
    }
    //  Dropdown Menu Simple
    /**
     * @param $get_field - mention only two params like KEY & VALUE
    - If you want CONCAT two or more fields in the Key OR Value section. pass like that
    - array( CONCAT(user_firstname, '.', user_surname) AS Key, fieldName as Value)
     */
    public function Dropdown($table, $get_field, $constraint_array = '', $groupBy = '', $orderby = '', $limit = '', $optionType = '', $joinArr = '')
    {

        $this->db->select($get_field);

        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if (!empty($constraint_array)) {
            foreach ($joinArr as $tableName => $condition) {
                $this->db->join($tableName, $condition, '=');
            }
        }

        $results = $this->db->get()->result();

        $options = array();

        if ($optionType == '') {
            $options[''] = "-- Select --";
        }

        foreach ($results as $item) {
            $options[$item->Key] = $item->Value;
        }
        return $options;
    }

    public function dataUpdate($table, $field, $where, $trans_set = '')
    {
        $this->db->set("$field", "$field+1", false);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($trans_set != '') {
            foreach ($trans_set as $row => $val) {
                $val_array[] = $val;
            }
            $this->db->where_in('naming_series_id', $val_array);
        }
        $this->db->update($table);
        return $result = $this->db->affected_rows();
    }

    public function validate_vendor($table, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $result = 2;
            return $result;
        }
    }

    // Generate Naming Series
    public function generateSeries($naming, $transaction_id)
    {
        //This can be deleted after changing naming series to array form
        $naming_avoid = $naming;
        if (!is_array($naming)) {
            $naming = array('0' => $naming);
        }
        //End of delete
        foreach ($naming as $key) {
            $naminglist[$key] = explode('_', $key);
        }
        foreach ($naminglist as $row => $val) {
            $namingtest1[$row] = $val[0];
            $namingtest2[$row] = $val[1];
        }
        foreach ($namingtest1 as $row => $val) {
            $const_array = array(
                'naming_series_id' => $val,
                'transaction_id' => $transaction_id,
            );
            $currentValue = $this->specific_row_value('set_naming_series', $const_array, 'current_value');
            $prefixLength = $this->specific_row_value('set_naming_series', $const_array, 'prefix_id');
            $result[$row] = $namingtest2[$row] . '/' . str_pad($currentValue, $prefixLength, 0, STR_PAD_LEFT);
        }
        //This can be deleted after changing naming series to array form
        if (!is_array($naming_avoid)) {
            foreach ($result as $key => $value) {
                $inter = $value;
            }
            return $inter;
        }
        //End of delete
        return $result;
    }

    public function join_records_all($fields, $table, $joinArr, $constraint_array = '', $groupBy = '', $orderby = '', $limitValue = '', $distinct = '')
    {
        $this->db->select(implode(',', $fields), false);
        $this->db->from($table);
        foreach ($joinArr as $tableName => $condition) {
            $this->db->join($tableName, $condition, 'left');
        }
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if ($limitValue != '') {
            $this->db->limit($limitValue);
        }
        if ($distinct != '') {
            $this->db->limit($limitValue);
        }

        $results = $this->db->get()->result();
        return $results;
    }

    public function validate_insert($table, $qr_code, $data)
    {
        $this->db->where('qr_code', $qr_code);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $this->db->insert($table, $data);
        }
    }

    public function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }
    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand(-2147482448, 2147483647);

        // Make sure the random user_id isn't already in use
        $query = $this->db->where('user_id', $random_unique_int)
            ->get_where('users');

        if ($query->num_rows() > 0) {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }

    public function get_product_details($product_id)
    {

        $this->db->select(
            "pd.*, 
                (
                    SELECT 
                        GROUP_CONCAT(a.attributes_name SEPARATOR '|') 
                    FROM product_attributes as pa
                    LEFT JOIN 
                        attributes as a ON a.id=pa.attribute_id 
                    WHERE pa.pro_details_id=pd.pro_details_id
                ) as attributes_name ,
                (
                    SELECT 
                        GROUP_CONCAT(pa.attribute_id  SEPARATOR '|') 
                    FROM product_attributes as pa
                    LEFT JOIN 
                        attributes as a ON a.id=pa.attribute_id 
                    WHERE pa.pro_details_id=pd.pro_details_id
                ) as attribute_id,
                (
                    SELECT 
                        GROUP_CONCAT(pa.attribute_value  SEPARATOR '|') 
                    FROM product_attributes as pa
                    LEFT JOIN 
                        attributes as a ON a.id=pa.attribute_id 
                    WHERE pa.pro_details_id=pd.pro_details_id
                ) as attribute_value",
            FALSE
        );

        $this->db->from('products_details as pd');
        $this->db->where("pd.product_id", $product_id);
        $results = $this->db->get()->result();

        return $results;
    }
    public function get_productslist($data)
    {
        if (!empty($data['group_product_ids'])) {
            $get_productids =  $this->specific_row_value('group_products', ['id' => $data['group_product_ids']], 'pro_details_ids');
        }

        $this->db->select(
            "pd.*,p.product_code,p.product_name, 
        (
            SELECT 
                GROUP_CONCAT(a.attributes_name SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attributes_name ,
        (
            SELECT 
                GROUP_CONCAT(pa.attribute_id  SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attribute_id,
        (
            SELECT 
                GROUP_CONCAT(pa.attribute_value  SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attribute_value",
            FALSE
        );

        $this->db->from('products_details as pd');
        $this->db->join("products as p", "p.pro_id=pd.product_id");

        if (!empty($data['group_product_ids'])) {
            $this->db->where_in("pd.pro_details_id", explode(',', $get_productids));
        }
        if (!empty($data['brand_id'])) {
            $this->db->where("p.brand_id", $data['brand_id']);
        }
        if (!empty($data['category_id'])) {
            $this->db->where("p.pgroup", $data['category_id']);
        }
        if (!empty($data['subcategory_id'])) {
            $this->db->where("p.pgroup_sub", $data['subcategory_id']);
        }
        if (!empty($data['attribute'])) {
            $this->db->where("pd.pro_details_id", $data['attribute']);
        }

        $this->db->group_by("pd.pro_details_id");

        $results = $this->db->get()->result();
        //var_dump($results);

        return $results;
    }

public function get_order_details($order_id)
{
    $this->db->select(
        "pd.*, oi.qty AS order_qty, oi.price AS order_price, 
        (
            SELECT 
                GROUP_CONCAT(a.attributes_name SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attributes_name ,
        (
            SELECT 
                GROUP_CONCAT(pa.attribute_id  SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attribute_id,
        (
            SELECT 
                GROUP_CONCAT(pa.attribute_value  SEPARATOR '|') 
            FROM product_attributes as pa
            LEFT JOIN 
                attributes as a ON a.id=pa.attribute_id 
            WHERE pa.pro_details_id=pd.pro_details_id
        ) as attribute_value,
        oi.group_name,oi.product_name", FALSE
    );

    $this->db->from('order_items as oi');
    $this->db->join("products_details as pd", "pd.pro_details_id=oi.variation_id", 'left');
    $this->db->where("oi.order_id", $order_id);
    $results = $this->db->get()->result();

    return $results;
}





        public function get_records($table, $pro_details_ids) {
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in('pro_details_id',$pro_details_ids);
        $query = $this->db->get();
        return $query->result_array(); 
    }


public function fetchProductsByGroupCode($groupCname, $companyId)
{
    $this->db->select('pd.variation_name, pd.price, pd.slash_price, pd.image');
    $this->db->from('group_products gp');
    $this->db->join('products_details pd', 'FIND_IN_SET(pd.pro_details_id, gp.pro_details_ids) > 0', 'inner');
    $this->db->where('gp.group_name', $groupCname);

    // Check the user's country in the company_address table
    $this->db->join('company_address ca', 'ca.company_id = ' . $companyId, 'left');

    // Add condition to show slash_price only for users from "India"
    $this->db->select('(CASE WHEN ca.country = "India" THEN pd.slash_price ELSE pd.price END) AS final_price', FALSE);

    // Add GROUP BY clause to ensure distinct rows for each group
    $this->db->group_by('pd.variation_name, pd.price, pd.slash_price, pd.image');

    $query = $this->db->get();
    return $query->result();
}











public function get_single_value($table, $field, $conditions)
{
    $this->db->select($field);
    $this->db->from($table);
    $this->db->where($conditions);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->$field;
    } else {
        return null;
    }
}


public function get_user_level($user_id)
{
    $this->db->select('user_level');
    $this->db->where('id', $user_id);
    $query = $this->db->get('company');

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->user_level;
    } else {
        return 0; 
    }
}


    public function get_sizes_by_pro_details_id($proDetailsId) {
    // Fetch sizes from your database based on pro_details_id
    $this->db->select('attribute_value');
    $this->db->where('pro_details_id', $proDetailsId);
    $this->db->where('attribute_name', 'size');
    $query = $this->db->get('product_attributes'); // Adjust this based on your actual table name

    return $query->result_array();
    }


    public function getShippingAddresses($company_id) {
    $this->db->where('company_id', $company_id);
    $this->db->where('address_type', 'Shipping Address');
    $query = $this->db->get('company_address');

    return $query->result();
    }


    // public function getAttributeNames($pgroup_sub)
    // {
    //     // Assuming 'attributes' is your table name
    //     $attributes = $this->db->get_where('attributes', ['sub_category_id' => $pgroup_sub])->result_array();
    //     return array_column($attributes, 'attributes_name');
    // }

    // public function fetchAttributesForProduct($pgroup_sub)
    // {
    //     // Assuming 'attributes' is your table name
    //     $attributes = $this->db->get_where('attributes', ['sub_category_id' => $pgroup_sub])->result_array();
    //     return array_column($attributes, 'attributes_name');
    // }


public function getProductAttributes($product_id)
{
    $this->db->select('attribute_id, attribute_value, pro_details_id');
    $this->db->from('product_attributes');
    $this->db->where('product_id', $product_id);
    $query = $this->db->get();

    return $query->result();
}




    public function getProductDetails($productId) {
        $this->db->select('variation_name, image');
        $this->db->from('products_details');
        $this->db->where('pro_details_id', $productId);
        $query = $this->db->get();

        return $query->row_array();
    }


    
public function addToCart($proDetailsId, $qty, $userId, $productName) {
    $data = array(
        'user_id' => $userId,
        'variation_id' => $proDetailsId,
        'qty' => $qty,
        'product_name' => $productName  
    );

    $this->db->insert('cart', $data);
}




    public function getProductName($proId) {
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('pro_id', $proId);
        $query = $this->db->get();

        $result = $query->row_array();

        return ($result) ? $result['product_name'] : '';
    }

    public function getProductDetailsList($product_id)
    {
        $this->db->select('pro_details_id, variation_name');
        $this->db->from('products_details');
        $this->db->where('product_id', $product_id); // Add this line to filter by product_id
        $query = $this->db->get();

        return $query->result();
    }





    public function getProDetailsId($productId)
    {
        $this->db->select('product_id');
        $this->db->from('product_attributes');
        $this->db->where('pro_details_id', $productId);
        $query = $this->db->get();

        return $query->row('pro_details_id');
    }

    public function getProductId($pro_details_id)
{
    $this->db->select('product_id');
    $this->db->from('products_details');
    $this->db->where('pro_details_id', $pro_details_id);
    $query = $this->db->get();

    return $query->row('product_id');
}








}
