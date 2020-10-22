<?php 
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('admin')){
            redirect('auth/login');
        }
    }

    public function cart(){
        echo "this is cart";
    }

    public function addToCart($item_id=null){
        $log = $this->session->userdata('admin');
        $user = $this->db->where('contact',$log)->get('account')->row();

        if($item_id != null){
            $item = $this->datawork->calling("items",["id"=>$item_id]);
            $item = $item[0];

            $order = $this->datawork->calling("orders",['ordered'=>false,'user_id'=>$user->id]);

            if(count($order) > 0){
                //if exist
            }
            else{
                //if not exist
            }
        }
    }
}
?>