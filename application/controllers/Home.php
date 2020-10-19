<?php 


class Home extends CI_Controller{
    private $data;
    public function __construct(){
        parent::__construct();
        $this->data['category'] = $this->datawork->calling('category');
    }
    public function commanView($data){
        $this->load->view('public/header');
        $this->load->view('public/home',$data);
        $this->load->view('public/footer');
    }
    public function index(){
        $this->data['product'] = $this->datawork->calling("items");
       $this->commanView($this->data);
    }

    public function category(){
        $this->commanView($this->data);
    }

    public function product(){
        $this->load->view('public/header');
        $this->load->view('public/product',$this->data);
        $this->load->view('public/footer');
    }
    public function search(){
        $this->commanView($this->data);
    }

    
}
?>