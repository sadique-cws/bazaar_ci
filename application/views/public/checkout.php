<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9">
            <?php if(!empty($addresses)): ?>

                <form action="<?= base_url('user/exist_address');?>" method="post">
                <div class="form-group">
                    <select name="address_id" id="" class="form-control" onchange="this.form.submit();">
                            <option value="" disabled selected>Choose your address</option>
                            <?php
                            
                            foreach($addresses as $ad): ?>

                                    <option value="<?= $ad->id;?>"><?= $ad->name . " (" . $ad->contact . ")" . " -- ". $ad->area . ", " . $ad->city ." (". $ad->state . ")" . " - " . $ad->pin_code;?> </option>
                            <?php endforeach;?>
                    </select>
                </div>
            </form>



            <?php endif; ?>
            <div class="card">
                <div class="card-header">Fill your Address Details</div>
                <div class="card-body">
                    <form action="<?= base_url('user/checkout');?>" method="post">
                    <div class="row">
                        
                    <div class="form-group col">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">contact</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        
                    <div class="form-group col">
                            <label for="">area</label>
                            <input type="text" name="area" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">city</label>
                            <select name="city" class="form-control">
                                <option>Purnea</option>
                                <option>Patna</option>
                                <option>Bhagalpur</option>
                                <option>Gaya</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="">state</label>
                            <select name="state" class="form-control">
                                <option>Bihar</option>
                                <option>Jharkhand</option>
                                <option>J&K</option>
                                <option>UP</option>
                                <option>MP</option>
                                <option>AP</option>
                                <option>AP2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">pin_code</label>
                            <input type="text" name="pin_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="Make Payment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
</div>