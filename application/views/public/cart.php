<div class="container mt-5">
    <div class="row">

        <div class="col-lg-9">
        <?php foreach($orderitem as $oi): ?>
            <div class="card">
                <div class="card-body">
                    <?= $oi->id;?>
                </div>
            </div>
        <?php endforeach;?>
        </div>

        <div class="col">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Total Amount</li>
                <li class="list-group-item list-group-item-action">Discount Amount</li>
            </ul>
        </div>
    </div>
</div>