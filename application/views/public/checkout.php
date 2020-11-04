<div class="container mt-5">
    <div class="row">

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">Fill your Address Details</div>
                <div class="card-body">
                    <form action="<?= base_url('user/checkout');?>" method="post">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">contact</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">area</label>
                            <input type="text" name="area" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">city</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">state</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">pin_code</label>
                            <input type="text" name="pin_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
</div>