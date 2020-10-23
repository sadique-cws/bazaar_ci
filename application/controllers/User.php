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

            if(count($item) > 0){
                $item = $item[0];
                $order = $this->datawork->calling("orders",['ordered'=>false,'user_id'=>$user->id]);
                if(count($order) > 0){
                    //if exist
                    $cond = ["ordered"=>false,"user_id"=>$user->id,"order_id"=>$order[0]->order_id,"item_id"=>$item_id];
                    $orderitem = $this->db->where($cond)->get('orderitem')->result();

                    if(count($orderitem) > 0){
                        $this->db->update("orderitem",["qty"=>$orderitem[0]->qty+=1],$cond);
                    }
                    else{
                        $this->db->insert("orderitem",$cond);
                    }
                }
                else{
                    //if not exist
                    $order = $this->db->insert("orders",["ordered"=>false,"user_id"=>$user->id]);
                    echo $last_id = $this->db->insert_id();

                    $orderitem = $this->db->insert("orderitem",["ordered"=>false,"user_id"=>$user->id,"order_id"=>$last_id,'item_id'=>$item_id]);

                }
               // redirect("user/cart");
            }
        }
    }
}
?>