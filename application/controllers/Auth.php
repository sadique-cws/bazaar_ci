<?php 


class Auth extends CI_Controller{
    
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


    public function login(){
        $this->form_validation->set_rules('contact','contact','required');
        $this->form_validation->set_rules('password','password','required');

        if($this->form_validation->run()){
            $data = [
                'contact' => $_POST['contact'],
                'password' => sha1($_POST['password'])
            ];

            if($this->datawork->checkdata("account",$data)){
                $this->session->set_userdata("admin",$_POST['contact']);
                redirect("home/index");
            }
            else{
                echo "<script>alert('username and password ')</script>";
                redirect("auth/login");

            }
        }
        else{
            $this->load->view("public/header");
            $this->load->view("auth/login");
            $this->load->view("public/footer");
        }
    }
    public function signup(){

        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('contact','contact','required');
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('password','password','required');

        if($this->form_validation->run()){
            $data = [
                'name' => $_POST['name'],
                'contact' => $_POST['contact'],
                'email' => $_POST['email'],
                'password' => sha1($_POST['password'])
            ];

            if($this->db->insert('account',$data)){
                redirect("auth/signup");
            }
        }
        else{
            $this->load->view("public/header");
            $this->load->view("auth/signup");
            $this->load->view("public/footer");
        }
    }

    public function logout(){
        $this->session->unset_userdata('admin');
        redirect('home/index');
    }
}
?>
