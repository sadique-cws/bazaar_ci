<?php 


class Admin extends CI_Controller{
    private $data;
    public function __construct(){
        parent::__construct();
        $this->data['category'] = $this->datawork->calling('category');
    }
   
    public function index(){
        // $this->data['product'] = $this->datawork->calling("items");
        $this->load->view('admin/header');
        $this->load->view('admin/dasboard',$this->data);
        $this->load->view('admin/footer');
    }

    public function category(){
        $this->load->view('admin/header');
        $this->load->view('admin/product',$this->data);
        $this->load->view('admin/footer');
    }

    public function product(){
        $this->load->view('admin/header');
        $this->load->view('admin/product',$this->data);
        $this->load->view('admin/footer');
    }

    public function addProduct(){
        $this->form_validation->set_rules("title",'title',"required");
        $this->form_validation->set_rules("price",'price',"required");
        $this->form_validation->set_rules("discount_price",'discount_price',"required");
        $this->form_validation->set_rules("brand",'brand',"required");
        $this->form_validation->set_rules("category",'category',"required");
        $this->form_validation->set_rules("model",'model',"required");
        $this->form_validation->set_rules("description",'description',"required");


        if($this->form_validation->run()){
                $data = [
                    'title' => $_POST['title'],
                    'price' => $_POST['price'],
                    'discount_price' => $_POST['discount_price'],
                    'brand' => $_POST['brand'],
                    'model' => $_POST['model'],
                    'category' => $_POST['category'],
                    'image' => $_FILES['image']['name'],
                    'description' => $_POST['description']
                ];
                $this->db->insert("items",$data);
                redirect('admin/index');
        }
        else{
            $this->load->view('admin/header');
            $this->load->view('admin/add_product',$this->data);
            $this->load->view('admin/footer');
        }
    }
    

    
}
?>