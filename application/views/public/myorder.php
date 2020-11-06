<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h1>My Orders</h1>
        </div>
        <div class="col-lg-9">
        <?php 
        $total = 0;
        $price = 0;
        if(!empty($order)):
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
                            <span>Qty: <?= $oi->qty;?></span>
                        </div>
                    </div>
                </div>
               
                <div class="col mt-3">
                    <h2 class=" h4 font-weight-bold">₹<?= $amount = $oi->discount_price * $oi->qty; $total+=$amount;?>/- <i class="fas fa-tag"></i></h2>
                    <h6 class="small text-muted"><del>₹<?= $p = $oi->price * $oi->qty; $price += $p?>/-</del></h6>
                </div>
            </div>
               
            </div>
        <?php endforeach; else: echo "no more orders"; endif;?>
        </div>

     </div>
</div>