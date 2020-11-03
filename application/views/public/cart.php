<div class="container mt-5">
    <div class="row">

        <div class="col-lg-9">
        <?php 
        $total = 0;
        $price = 0;

        if($order[0]->coupon != null){
            $total -=  $order[0]->amount;
        }
        foreach($orderitem as $oi): ?>
            <div class="card mb-2">
            <div class="row">
                <div class="col-lg-2">
                    <img src="<?= base_url('assets/'. $oi->image);?>" alt="" class="card-img-top">
                </div>
                <div class="col">
                    <div class="card-body">
                        <?= $oi->title;?>

                        <div class="div">
                            <a href="<?= base_url('user/removecart/'. $oi->id);?>" class="btn btn-danger"><i class="fas fa-minus"></i></a>
                            <span><?= $oi->qty;?></span>
                            <a href="<?= base_url('user/addToCart/'. $oi->id);?>" class="btn btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <a href="<?= base_url('user/removeitem/'.$oi->id);?>" class="text-muted text-decoration-none my-auto small"> <i class="fas fa-trash"></i> Remove</a>
                </div>
                <div class="col mt-3">
                    <h2 class=" h4 font-weight-bold">₹<?= $amount = $oi->discount_price * $oi->qty; $total+=$amount;?>/- <i class="fas fa-tag"></i></h2>
                    <h6 class="small text-muted"><del>₹<?= $p = $oi->price * $oi->qty; $price += $p?>/-</del></h6>
                </div>
            </div>
               
            </div>
        <?php endforeach;?>
        </div>

        <div class="col">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Total Amount <span class="float-right font-weight-bolder">₹<?= $total;?>/-</span></li>
                <li class="list-group-item list-group-item-action bg-success text-white">Saving Amount <span class="float-right font-weight-bolder">₹<?= $price - $total;?>/-</span></li>
           <?php if($order[0]->coupon!=null):?>
               <li class="list-group-item list-group-item-action bg-primary text-white">Coupon Discount  <span class="float-right font-weight-bolder">₹<?= $order[0]->amount;?>/-</span></li>
           <?php endif;?></ul>

            <form action="<?= base_url('user/addCoupon');?>" class="mt-4" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="code" placeholder="Enter Code">
                    <span class="input-group-append">
                        <input type="submit" class="btn btn-danger" value="Apply">
                    </span>
                </div>
            </form>
            <?php if($order[0]->coupon!=null):?>
           
            <h6 class="mt-3"><a href="<?= base_url('user/RemoveCoupon');?>">X</a> <strong><?= $order[0]->code;?></strong> Applied</h6>
            <?php endif;?>


            <a href="<?= base_url('user/checkout');?>" class="btn btn-warning mt-3 btn-block btn-lg">Checkout <i class="fas fa-arrow-right"></i></a>
            <a href="" class="btn btn-info mt-3 btn-block btn-lg"><i class="fas fa-arrow-left"></i> Shopping More</a>
            

        </div>
    </div>
</div>