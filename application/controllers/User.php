<?php 
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('admin')){
            redirect('auth/login');
        }

        //cart count
        }

        public function count_cart(){
            $log = $this->session->userdata('admin');
            $user = $this->db->where('contact',$log)->get('account')->row();
            $order = $this->datawork->calling("orders",['ordered'=>false,'user_id'=>$user->id]);
            if(!empty($user) && !empty($order)){
            $order = $this->datawork->calling("orders",['ordered'=>false,'user_id'=>$user->id]);
            $oi = $this->db->where(['order_id'=>$order[0]->order_id,'ordered'=>false])->get('orderitem')->num_rows();
            if($oi > 0){
                return $oi;
            }
        }
            return 0;
        }

    public function cart(){
        $log = $this->session->userdata('admin');

        $user = $this->db->where('contact',$log)->get('account')->row();

        $order = $this->db->select('*')->from('orders')->join('coupons','orders.coupon=coupons.id','left')->where(['user_id'=>$user->id,'ordered'=>false])->get();
        $order = $order->result();
        
        $data['orderitem'] = $this->db->select("*")->from('orderitem')->join('items','orderitem.item_id=items.id','left')->where(['user_id'=>$user->id,'ordered'=>false])->get()->result(); 
        $data['order'] = $order;
        
        $this->load->view('public/header');
        $this->load->view('public/cart',$data);
        $this->load->view('public/footer');
    }
    public function myorder(){
        $log = $this->session->userdata('admin');

        $user = $this->db->where('contact',$log)->get('account')->row();

        // $order = $this->db->get_where('orders',['user_id'=>$user->id,'ordered'=>false])->row();
        $order = $this->db->select('*')->from('orders')->join('coupons','orders.coupon=coupons.id','left')->where(['user_id'=>$user->id,'ordered'=>true])->get();
        $order = $order->result();
        //select * from orders JOIN coupons ON orders.coupon = coupons.id WHERE user_id='' AND ordered=false
        
        $data['orderitem'] = $this->db->select("*")->from('orderitem')->join('items','orderitem.item_id=items.id','left')->get()->result(); 
        $data['order'] = $order;
        
        $this->load->view('public/header');
        $this->load->view('public/myorder',$data);
        $this->load->view('public/footer');
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
               redirect("user/cart");
            }
        }
    }
    public function removeitem($item_id=null){
        $this->db->delete('orderitem',['item_id'=>$item_id]);
        redirect('user/cart');
    }
    public function removeCart($item_id=null){
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
                    $orderitem = $this->db->where($cond)->get('orderitem')->row();

                    if(!empty($orderitem)){
                        if($orderitem->qty > 1){
                            $this->db->update("orderitem",["qty"=>$orderitem->qty-=1],$cond);
                        }    
                        else{
                            $this->removeitem($item_id);
                        }
                    }
                }
                
               redirect("user/cart");
            }
        }
    }


   

    public function addCoupon(){
        $log = $this->session->userdata('admin');
        $user = $this->db->where('contact',$log)->get('account')->row();

        $this->form_validation->set_rules('code','code','required');


        if($this->form_validation->run()){
             $code = $_POST['code'];
            if($this->datawork->checkdata('coupons',['code'=> $code])){
                $coupon = $this->db->get_where('coupons',['code'=> $code])->row();
                $order = $this->db->get_where('orders',['user_id'=>$user->id,'ordered'=>false])->row();
                $this->db->update('orders',['coupon'=>$coupon->id],['order_id'=>$order->order_id]);
            }
            else{
                echo "<script>alert('not found')</script>";
            }
            redirect('user/cart');

        }

    }
    public function RemoveCoupon(){
        $log = $this->session->userdata('admin');
        $user = $this->db->where('contact',$log)->get('account')->row();

        $order = $this->db->get_where('orders',['user_id'=>$user->id,'ordered'=>false])->row();
        $this->db->update('orders',['coupon'=>null],['order_id'=>$order->order_id]);
        
        redirect('user/cart');


    }
    public function checkout(){
        $log = $this->session->userdata('admin');
        $user = $this->db->where('contact',$log)->get('account')->row();

        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('contact','contact','required');
        $this->form_validation->set_rules('area','area','required');
        $this->form_validation->set_rules('city','city','required');
        $this->form_validation->set_rules('state','state','required');
        $this->form_validation->set_rules('pin_code','pin_code','required');


        if($this->form_validation->run()){
                $data = [
                    'name' => $_POST['name'],
                    'contact' => $_POST['contact'],
                    'area' => $_POST['area'],
                    'city' => $_POST['city'],
                    'state' => $_POST['state'],
                    'pin_code' => $_POST['pin_code'],
                ];

                $insert = $this->db->insert('address',$data);
                $last_id = $this->db->insert_id();

                
                $order = $this->db->update('orders',['address'=> $last_id],['user_id'=>$user->id,'ordered'=>false]);
                redirect('user/makePayment');
        

        }
        else{       
            $this->load->view('public/header');
            $this->load->view('public/checkout');
            $this->load->view('public/footer');
        }

    }
        public function  makePayment(){
            $log = $this->session->userdata('admin');
            $user = $this->db->where('contact',$log)->get('account')->row();

            $this->form_validation->set_rules('mode','mode','required');


            if($this->form_validation->run()){
                        if($_POST['mode']==1){
                            $order = $this->db->update('orders',['ordered'=> true],['user_id'=>$user->id,'ordered'=>false]);
                            $orderitem = $this->db->update('orderitem',['ordered'=> true],['user_id'=>$user->id,'ordered'=>false]); 
                            redirect('user/myorder');
                        }
            }
            else{
            $this->load->view('public/header');
            $this->load->view('public/payment');
            $this->load->view('public/footer');
        
        }
        }
    }

?>