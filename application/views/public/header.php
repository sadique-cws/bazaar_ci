<?php 

$ci = &get_instance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazaar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand " href="#">
        <img src="<?= base_url('assets/logo.png');?>" class="w-100">
    </a>

    <form class=" mx-auto">
    <div class="input-group">
      <input class="form-control border border-muted border-right-0" type="search" size="50" placeholder="Search" aria-label="Search">
     <span class="input-group-append">
      <button class="btn bg-white border border-muted border-left-0 my-2 my-sm-0" type="submit">
        <i class="fas fa-search"></i>
      </button>
     </span>
      </div>
       </form>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    
      
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('user/cart');?>" tabindex="-1" aria-disabled="true"> <i class="fas fa-shopping-cart"></i> Carts <sup><span class="badge badge-danger badge-pill"><?= $ci->count_cart();?></span></sup></a>
      </li>
      <?php if($this->session->userdata('admin')):?>
      <li class="nav-item  ml-2">
        <a class="btn btn-danger" href="<?= base_url('auth/logout');?>" tabindex="-1" aria-disabled="true"><i class="fas fa-power-off"></i></a>
      </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="btn btn-danger" href="<?= base_url('auth/login');?>" tabindex="-1" aria-disabled="true">Login</a>
        </li>
        
      <?php endif;?>
    </ul>
    
  </div>
  </div>
</nav>
    
    <br>
    <br>