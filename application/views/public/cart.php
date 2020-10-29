<div class="container mt-5">
    <div class="row">

        <div class="col-lg-9">
        <?php 
        $total = 0;
        $price = 0;
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
                            <a href="" class="btn btn-danger">-</a>
                            <span><?= $oi->qty;?></span>
                            <a href="<?= base_url('user/addToCart/'. $oi->id);?>" class="btn btn-success">+</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="" class="text-muted text-decoration-none my-auto small">Remove</a>
                </div>
                <div class="col">
                    <h2 class="font-weight-bold">₹<?= $amount = $oi->discount_price * $oi->qty; $total+=$amount;?>/-</h2>
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
            </ul>

            <form action="" class="mt-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Code">
                <span class="input-group-append">
                    <input type="submit" class="btn btn-danger">
                </span>
                </div>
            </form>
        </div>
    </div>
</div>