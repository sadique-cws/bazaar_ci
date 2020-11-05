<div class="container-fluid p-0 mt-3">
    <div class="row no-gutters">
        <div class="col-lg-2" style="position:fixed;height:95vh;overflow-y:scroll">
            <?php include_once(APPPATH."views/public/side.php");?>
        </div>
        <div class="col-lg-10  p-4" style="position:absolute;right:0">
        
            <div class="row">
            <?php foreach($product as $item):?>
                <div class="col-lg-2">
                    <div class="card border-0">
                        <a href="<?= base_url('home/product/'.$item->id);?>" class="stretched-link">
                            <img src="<?= base_url('assets/'.$item->image);?>" class="w-100 border border-muted" style="object-fit:cover;height:150px;" alt="">
                        </a>
                        <div class="card-body pt-1">
                         <h2 class="h6 mb-1 text-capitalize font-weight-bold text-theme text-truncate"><?= $item->title;?></h2>
                            <p class="small m-0 text-muted"><?= $item->cat_title;?></p>
                            <h2 class="h4 d-inline"> 
                                <span class="font-weight-bolder">₹<?= $item->discount_price;?> </span>
                            
                        </h2>
                        <small class="small text-muted"><del>₹<?= $item->price;?>/-</del></small>
                           
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</div>