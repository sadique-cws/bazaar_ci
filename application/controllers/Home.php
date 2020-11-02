<?php 


class Home extends CI_Controller{
    private $data;

    public function __construct(){
        parent::__construct();
        $this->data['category'] = $this->datawork->calling('category');
    }
    public function count_cart(){
        $log = $this->session->userdata('admin');
        $user = $this->db->where('contact',$log)->get('account')->row();
        if(!empty($user)){
        $order = $this->datawork->calling("orders",['ordered'=>false,'user_id'=>$user->id]);
        $oi = $this->db->where(['order_id'=>$order[0]->order_id,'ordered'=>false])->get('orderitem')->num_rows();
        if($oi > 0){
            return $oi;
        }
    }
        return 0;
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

    public function category($id){
        $this->data['product'] = $this->datawork->calling("category",["id"=>$id]);
        $this->commanView($this->data);
    }

    public function product($id){
        $this->data['product'] = $this->db->where(["id"=>$id])->get("items")->row();
        $this->load->view('public/header');
        $this->load->view('public/product',$this->data);
        $this->load->view('public/footer');
    }
    public function search(){
        $this->commanView($this->data);
    }

    
}
?>