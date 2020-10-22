<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <?= form_open("auth/login");?>
                    
                    <div class="form-group">
                        <label for="" class="m-0 p-0">contact</label>
                        <input type="text" class="form-control" name="contact">
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="m-0 p-0">password</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="send">
                    </div>

                    <?= form_close();?>
                    <a href="<?= base_url('auth/signup');?>" class="small text-muted">Create an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>