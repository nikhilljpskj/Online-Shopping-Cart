<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('authenticated')) {
			redirect('login');
			session_destroy();
		}
    }

public function index()
{
    $join_table = array(
        'products as p' => 'p.pro_id=pd.product_id',
        'category as c' => 'c.id=p.pgroup',
        'brand1 as b' => 'b.brand_id=p.brand_id',
        'sub_category as sc' => 'sc.id=p.pgroup_sub',
    );

    $results = $this->mcommon->join_records_all(
        ['p.pro_id AS id', 'c.category_name', 'p.product_code', 'sc.sub_category_name', 'pd.variation_name', 'b.brand_name', 'pd.qty', 'pd.price', 'p.product_name', 'pd.image', 'p.product_image'],
        'products_details as pd',
        $join_table,
        '',
        'pd.pro_details_id',
        'pd.pro_details_id DESC'
    );

    foreach ($results as $row) {
        if (empty($row->image) && !empty($row->product_image)) {
            $images = explode(',', $row->product_image);
            $row->image = $images[0];
        }

        if (empty($row->image) && empty($row->product_image)) {
            $row->image = 'no-image.png'; // provide a default image filename
        }
    }

    $view_data['results'] = $results;
    $view_data['page'] = 'masters/product/show';
    $this->load->view('template', $view_data);
}





    function resize_image($newWidth, $targetFile, $originalFile)
    {


        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;
            case 'image/jpg':
                $image_create_func = 'imagecreatefromjpg';
                $image_save_func = 'imagejpg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        $image_save_func($tmp, "$targetFile");
    }


public function add()
{
    $this->load->library('upload');

    $config['upload_path'] = './attachments/productimg/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size'] = 2048;
    $config['encrypt_name'] = TRUE;
    $this->upload->initialize($config);

    if (isset($_POST['submit'])) {

        $input_data = $this->input->post();

        $this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
        $this->form_validation->set_rules('pgroup', 'Category', 'required');
        $this->form_validation->set_rules('pgroup_sub', 'Sub Category', 'required');
        $this->form_validation->set_rules('product_code', 'Product Code', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');

        if ($this->form_validation->run() == true) {
            $this->db->trans_start();

            $image_paths = array();

            if ($this->upload->do_upload('product_image')) {
                $upload_data = $this->upload->data();
                $image_paths[] = $upload_data['file_name'];

                $newWidth = 612;
                $targetFile = $upload_data['full_path'];
                $this->resize_image($newWidth, $targetFile, $targetFile);
            } else {
                $this->session->set_flashdata('alert_danger', $this->upload->display_errors());
                redirect('product/add');
            }

            $insert_array = array(
                'brand_id' => $input_data['brand_id'],
                'pgroup' => $input_data['pgroup'],
                'pgroup_sub' => $input_data['pgroup_sub'],
                'product_code' => $input_data['product_code'],
                'product_name' => $input_data['product_name'],
                'product_desc' => $input_data['product_desc'],
                'p_created_date' => date('Y-m-d'),
                'created_by' => $this->session->userdata('id'),
                'updated_by' => $this->session->userdata('id'),
                'product_image' => implode(",", $image_paths),
            );

            $product_insert = $this->mcommon->common_insert('products', $insert_array);

            $length = count($input_data['product_price']);

            for ($i = 0; $i < $length; $i++) {

                $cover_pic = ""; 

                if ($_FILES['photo']['name'][$i]) {

                    $upload_path = './attachments/products/';
                    $upload_path_table = base_url() . 'attachments/products/';
                    $banner = $_FILES['photo']['name'][$i];
                    $bannerpath = $upload_path . $banner;
                    move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $bannerpath);
                    $this->resize_image($newWidth, $bannerpath, $bannerpath);

                    $cover_pic = $upload_path_table . $banner;
                }

                $insert_array_variation = array(
                    'product_id' => $product_insert,
                    'variation_name' => $input_data['variation_name'][$i],
                    'price' => $input_data['product_price'][$i],
                    'slash_price' => $input_data['slash_price'][$i],
                    'qty' => $input_data['product_qty'][$i],
                    'image' => $cover_pic,
                );

                $insert_unit = $this->mcommon->common_insert('products_details', $insert_array_variation);

                foreach ($input_data as $key => $value) {
                    if (is_numeric($key)) {
                        $attri_array = [
                            'product_id' => $product_insert,
                            'pro_details_id' => $insert_unit,
                            'attribute_id' => $key,
                            'attribute_value' => $value[$i],
                        ];
                        $this->mcommon->common_insert('product_attributes', $attri_array);
                    }
                }
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('alert_danger', 'Transaction failed. Please try again later.');
            } else {
                $this->session->set_flashdata('alert_success', 'Product added successfully!');
                redirect('product');
            }
        }
    }

    $view_data['brands'] = $this->mcommon->records_all('brand1', array('status' => '1'), 'brand_name ASC');
    $view_data['add'] = true;
    $view_data['form_url'] = 'product/add';
    $view_data['heading'] = 'Add Product';
    $view_data['page'] = 'masters/product/add';

    // Load the view
    $this->load->view('template', $view_data);
}




public function edit($id)
{
    if (isset($_POST['submit'])) {
        $brand_id = $this->input->post('brand_id');
        $pgroup = $this->input->post('pgroup');
        $pgroup_sub = $this->input->post('pgroup_sub');
        $product_code = $this->input->post('product_code');
        $product_name = $this->input->post('product_name');
        $product_desc = $this->input->post('product_desc');
        $product_price = $this->input->post('product_price');
        $slash_price = $this->input->post('slash_price');
        $product_qty = $this->input->post('product_qty');
        $pro_details_id = $this->input->post('pro_details_id');
        $old_img = $this->input->post('old_img');
        $variation_name = $this->input->post('variation_name');

        // Set validation Rules
        $this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
        $this->form_validation->set_rules('pgroup', 'PRODUCT Category', 'required');
        $this->form_validation->set_rules('pgroup_sub', 'PRODUCT Sub Category', 'required');
        $this->form_validation->set_rules('product_code', 'product Code', 'required');
        $this->form_validation->set_rules('product_name', 'product Name', 'required');

        // Check if the validation returns no error
        if ($this->form_validation->run() == true) {
            // Handle product image upload (if a new image is provided)
            if ($_FILES['product_image']['name']) {
                $directory_path = './attachments/productimg/';
                if (!is_dir($directory_path)) {
                    mkdir($directory_path, 0777, true);
                }

                $config['upload_path'] = $directory_path;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('product_image')) {
                    $upload_data = $this->upload->data();
                    $new_product_image = $upload_data['file_name'];
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Prepare the product data array
            $update_array = array(
                'brand_id' => $brand_id,
                'pgroup' => $pgroup,
                'pgroup_sub' => $pgroup_sub,
                'product_code' => $product_code,
                'product_name' => $product_name,
                'product_desc' => $product_desc,
                'updated_by' => $this->session->userdata('id'),
            );

            // Include the new product image path in the update_array (if provided)
            if (isset($new_product_image)) {
                $update_array['product_image'] = $new_product_image;
            }

            // Update the product data in the 'products' table
            $update = $this->mcommon->common_edit('products', $update_array, array('pro_id' => $id));

            $clength = count($product_price);
            $elength = count($pro_details_id);

            $this->mcommon->common_delete('product_attributes', array('product_id' => $id));

            for ($i = 0; $i < $clength; $i++) {

                if ($i < $elength) {
                    if ($_FILES['photo']['name'][$i]) {
                        $directory_path = './attachments/products/';
                        if (!is_dir($directory_path)) {
                            mkdir($directory_path, 0777, true);
                        }

                        $config['upload_path'] = $directory_path;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);

                        // Handle multiple file uploads
                        $files = $_FILES['photo'];
                        $_FILES['userfile']['name'] = $files['name'][$i];
                        $_FILES['userfile']['type'] = $files['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['error'][$i];
                        $_FILES['userfile']['size'] = $files['size'][$i];

                        if ($this->upload->do_upload('userfile')) {
                            $upload_data = $this->upload->data();
                            $cover_pic = $upload_data['file_name'];
                        } else {
                            echo $this->upload->display_errors();
                        }
                    } else {
                        $cover_pic = $old_img[$i];
                    }

                    $product_details_data = array(
                        'variation_name' => $variation_name[$i],
                        'price' => $product_price[$i],
                        'slash_price' => $slash_price[$i],
                        'qty' => $product_qty[$i],
                        'image' => $cover_pic,
                    );
                    $this->mcommon->common_edit('products_details', $product_details_data, array('pro_details_id' => $pro_details_id[$i]));

                    foreach ($_POST as $key => $value) {
                        $attri_array = [];
                        if (is_numeric($key)) {
                            $attri_array = array(
                                'product_id' => $id,
                                'pro_details_id' => $pro_details_id[$i],
                                'attribute_id' => $key,
                                'attribute_value' => $value[$i],
                            );
                            $this->mcommon->common_insert('product_attributes', $attri_array);
                        }
                    }
                } else {
                    if ($_FILES['photo']['name'][$i]) {
                        $directory_path = './attachments/products/';
                        if (!is_dir($directory_path)) {
                            mkdir($directory_path, 0777, true);
                        }

                        $config['upload_path'] = $directory_path;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = 2048;
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('photo')) {
                            $upload_data = $this->upload->data();
                            $cover_pic = $upload_data['file_name'];
                        } else {
                            echo $this->upload->display_errors();
                        }
                    } else {
                        $cover_pic = "";
                    }
                    if (!empty($product_price[$i]) && !empty($product_qty[$i])) {
                        $insert_array1 = array(
                            'product_id' => $id,
                            'variation_name' => $variation_name[$i],
                            'price' => $product_price[$i],
                            'slash_price' => $slash_price[$i],
                            'qty' => $product_qty[$i],
                            'image' => $cover_pic,
                        );

                        $insert_unit = $this->mcommon->common_insert('products_details', $insert_array1);
                        foreach ($_POST as $key => $value) {
                            $attri_array = [];
                            if (is_numeric($key)) {
                                $attri_array = array(
                                    'product_id' => $id,
                                    'pro_details_id' => $insert_unit,
                                    'attribute_id' => $key,
                                    'attribute_value' => $value[$i],
                                );
                                $this->mcommon->common_insert('product_attributes', $attri_array);
                            }
                        }
                    }
                }
            }

            if ($update > 0) {
                $this->session->set_flashdata('alert_success', 'Product updated successfully!');
                redirect('product');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
    }

    $view_data['default'] = $this->mcommon->records_all('products', array('pro_id' => $id));
    $view_data['brands'] = $this->mcommon->records_all('brand1', array('status' => '1'), 'brand_name ASC');
    $view_data['category'] = $this->mcommon->records_all('category', ['status' => 1]);
    $view_data['sub_category'] = $this->mcommon->records_all('sub_category', ['status' => 1]);
    $view_data['product_details'] = $this->mcommon->get_product_details($id);

    $view_data['add'] = false;
    $view_data['form_url'] = 'product/edit/' . $id;
    $view_data['heading'] = 'Edit Product';
    $view_data['page'] = 'masters/product/edit';
    $this->load->view('template', $view_data);
}




    public function view($id)
    {
        $view_data['default'] = $this->mcommon->specific_row('products', array('pro_id' => $id));
        $view_data['category'] = $this->product_group();

        $data = array(
            'title' => 'View Products',
            'content' => $this->load->view('seller/product/product/view', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);
    }

    public function delete($id)
    {
        $current_status = $this->mcommon->specific_row_value('products_tbl', array('pro_id' => $id), 'is_active');
        $change_status = ($current_status == 1) ? 0 : 1;
        $delete = $this->mcommon->common_edit('products_tbl', array('is_active' => $change_status), array('pro_id' => $id));

        return $delete;
    }
    public function get_category()
    {

        $brand_id = $this->input->post("brand_id");
        $results = $this->mcommon->records_all('category', ['status' => 1, 'brand_id' => $brand_id], 'category_name ASC');

        echo json_encode($results);
    }
    public function get_subcategory()
    {

        $category_id = $this->input->post("category_id");
        $results = $this->mcommon->records_all('sub_category', ['status' => 1, 'category_id' => $category_id], 'sub_category_name ASC');

        echo json_encode($results);
    }
    public function get_attributes()
    {
        $sub_category_id = $this->input->post('sub_category_id');

        $this->db->select('a.id,a.attributes_name as attributes_name');
        $this->db->from('attributes as a');
        $this->db->where('a.sub_category_id', $sub_category_id);
        $this->db->where('a.status', 1);
        $this->db->order_by('a.attributes_name', 'ASC');
        $querys = $this->db->get()->result();

        echo json_encode($querys);
    }
}
