<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

     function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function single_record($table_name, $id)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('id', $id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    public function select_ponum_data($po_no)
    {
        $this->db->select('*');
        $this->db->from('sales_order');
        $this->db->join('customer', 'customer.id = sales_order.customer');
        $this->db->where('po_no', $po_no);
        $query = $this->db->get();
        return $query->result();
    }

    public function show_table($table_name)
    {
         $this->db->select('*');
         $this->db->from($table_name);
         $this->db->order_by('name', 'asc');
         $query = $this->db->get();
        return $query->result();
    }

        public function show_table1($table_name)
    {
         $this->db->select('*');
         $this->db->from($table_name);
         $query = $this->db->get();
        return $query->result();
    }

    public function insert_product_qty($mydata)
    {
        $this->db->insert('total_product_qty', $mydata);
    }

    public function store_item($data, $table_name)
    {
        $this->db->insert($table_name, $data);
    }
    public function update_item($name, $table_name, $id)
    {
        $this->db->query("update " . $table_name . " set name ='" . $name . "'where id='" . $id . "'");
    }
    public function create_finished_product($data)
    {
        $this->db->insert('finished_products', $data);
    }
    public function create_raw_material($data)
    {
        $this->db->insert('rawproducts', $data);
    }

    public function create_customer($data)
    {
        $this->db->insert('customer', $data);
    }

    public function getUsers($postData = null)
    {

        $response = array();
        $table_name = '';
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (name like '%" . $searchValue . "%' ) ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get($table_name)->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '') $this->db->where($searchQuery);
        $records = $this->db->get('gsm')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '') $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('gsm')->result();

        print_r($records);
        exit();

        $data = array();

        foreach ($records as $record) {
            $data[] = array(
                "id" => $record->username,
                "name" => $record->name
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    public function upload_images($data)
    {
        $this->db->insert('pono_images', $data);
    }
    public function create_sales_order($data)
    {
        $this->db->insert('sales_order', $data['sales_order']);
        $so_id = $this->db->insert_id();
        foreach ($data['products'] as $key => $product) {
			 
            $query = $this->db->query('select pd.variation_name,p.product_name,p.product_code FROM products_details as pd LEFT JOIN products as p ON (pd.product_id = p.pro_id)  WHERE pd.pro_details_id =' . $product['product_id'])->row();
            $product['so_id'] = $so_id;
            $product['product_name'] = $query->variation_name .'/'.$query->product_name .'/'.$query->product_code;
            $product['pending_qty'] = $product['po_qty'];

            $this->db->insert('sales_order_items', $product);
        }
    }
    public function assign_process($data)
    {
        $this->db->insert('delivery_assign', $data);
    }
    public function production_assign_process($data)
    {
        $this->db->insert('production_assign', $data);
    }
    public function packing_process($data)
    {
        $product_id = $data["product_id"];
        $so_id = $data["so_id"];
        $this->db->insert('box_shedule', $data);
        $this->db->query("UPDATE sales_order_items SET status='2' WHERE product_id='" . $product_id . "' AND so_id='" . $so_id . "'");
    }
    public function add_dispatch_process($data)
    {
        $dc_no = $data["dc_no"];
        $dc_items = $this->db->query("SELECT * FROM delivery_challan_items WHERE dc_no='" . $dc_no . "'")->result();
        foreach ($dc_items as $item) {
            $this->db->query("UPDATE sales_order_items SET status='6' WHERE product_id=" . $item->product_id . " AND so_id=" . $item->so_id);
        }
        $this->db->insert('dispatch', $data);
    }

    public function add_loading_challan_process($data)
    {
        $dc_id = $data["dc_id"];
        $dc_items = $this->db->query("SELECT * FROM delivery_challan_items WHERE dc_no='" . $dc_id . "'")->result();
        foreach ($dc_items as $item) {
            $this->db->query("UPDATE sales_order_items SET status='4' WHERE product_id=" . $item->product_id . " AND so_id=" . $item->so_id);
            $this->db->query("UPDATE delivery_challan_items SET isLoaded = 1 WHERE dc_no='" . $dc_id . "'");
        }
    }

    public function getCustomerDetails($id)
    {
       return $this->db->query('select * from customer where id =' . $id)->row();
    }

    public function packing_weight_update_process($id, $weight)
    {
        $this->db->where('id', $id);
        $this->db->update('box_shedule', ["box_weight" => $weight]);
    }
    public function delivery_challan_process()
    {
        $this->db->query("INSERT INTO delivery_challan SET dc_date = NOW()");
        $dc_no = $this->db->insert_id();

        $pending_deliveries = $this->db->query("SELECT box_shedule.id, box_shedule.po_no, box_shedule.so_id, box_shedule.product_id, box_shedule.box_qty, box_shedule.box_weight FROM box_shedule LEFT JOIN sales_order ON sales_order.id = box_shedule.so_id WHERE box_shedule.box_weight > 0 AND box_shedule.dc_id = 0")->result();

        foreach ($pending_deliveries as $item) {
            $id = $item->id;
            $data = (array) $item;
            $data["dc_no"] = $dc_no;
            $this->db->insert('delivery_challan_items', $data);

            $this->db->query("UPDATE box_shedule SET dc_id = $dc_no WHERE id = $id");
            $this->db->query("UPDATE sales_order_items SET status='3' WHERE product_id='" . $data['product_id'] . "' AND so_id='" . $data['so_id'] . "'");
        }
    }

    public function po_image_update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('sales_order', $data);
    }

    public function add_loading_deliveries_process($data)
    {
        $dc_no = $data["dc_no"];
        $dc_items = $this->db->query("SELECT * FROM delivery_challan_items WHERE dc_no='" . $dc_no . "'")->result();
        foreach ($dc_items as $item) {
            $this->db->query("UPDATE sales_order_items SET status='5' WHERE product_id=" . $item->product_id . " AND so_id=" . $item->so_id);
        }
        $this->db->insert('loading_deliveries', $data);
    }

    public function update_loading_deliveries_process($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('loading_deliveries', $data);
    }

    public function getWorkLoadDetails($id)
    {
       return $this->db->query('select * from sales_order_items where product_id =' . $id.' and pending_qty > 0')->result_array();
    }
     public function create_work_order_item($data)
    {
        
        $this->db->insert('work_orders_item', $data);
    }
      public function create_work_order_material_issue($data)
    {
        $this->db->insert('work_order_material_issue', $data);
    }
    public function create_work_order_cutting($data)
    {
        $this->db->insert('work_order_cutting', $data);
    }
    public function create_work_order_printing($data)
    {
        $this->db->insert('work_order_printing', $data);
    }
    public function create_work_order_diecutting($data)
    {
        $this->db->insert('work_order_diecutting', $data);
    }

}
