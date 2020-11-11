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
        $this->load->view('admin/dashboard',$this->data);
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


    // private function uploadImage($image){
    //     $config['upload_path']          = './assets/';
    //     $config['allowed_types']        = 'gif|jpg|png';

    //     $this->load->library("upload",$config);

    //     if(!$this->upload->do_upload()){
    //         $this->data['error'] = $this->upload->display_errors();
    //         print_r($this->data['error']);
    //         return false;
    //     }
    //     else{
    //         $data = [
    //             'img_name' => $image,
    //         ];

    //         $this->db->insert("photos",$data);
    //         return true;
    //     }
    // }


    public function addProduct(){

        $this->form_validation->set_rules("title",'title',"required");
        $this->form_validation->set_rules("price",'price',"required");
        $this->form_validation->set_rules("discount_price",'discount_price',"required");
        $this->form_validation->set_rules("brand",'brand',"required");
        $this->form_validation->set_rules("category",'category',"required");
        $this->form_validation->set_rules("model",'model',"required");
        $this->form_validation->set_rules("description",'description',"required");


        if($this->form_validation->run()){

            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['image']['name']);
            
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['image']['name']= $files['image']['name'][$i];
               
                $this->upload->initialize($this->config_image());
                $this->upload->do_upload();
                print_r($this->upload->display_errors());
                // print_r($this->upload->do_upload());
                $dataInfo[] = $this->upload->data();
                
                for($x=0;$x<count($dataInfo);$x++){
                    // print_r($dataInfo);
                    $data = [
                        'img_name' => $dataInfo[$x]['file_name'],
                    ];
                    
                    $this->db->insert("photos",$data);
                }

            }


            
                // redirect('admin/index');
        }
        else{
            $this->load->view('admin/header');
            $this->load->view('admin/add_product',$this->data);
            $this->load->view('admin/footer');
        }
    }
    
    private function config_image(){
        $config = array();
        $config['upload_path']          = './assets/';
        $config['allowed_types']        = 'gif|jpg|png';
        return $config;
    }

    
}
?>