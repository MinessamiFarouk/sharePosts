<?php require APP_ROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this from to register with us.</p>
                <form action="<?php echo URL_ROOT; ?>/users/register" method="Post">
                    <div class="form-group">
                        <label for="name">Name : <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email : <sup>*</sup></label>
                        <input type="Email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password : <sup>*</sup></label>
                        <input type="text" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Confirm Password : <sup>*</sup></label>
                        <input type="text" name="password_confirm" class="form-control form-control-lg <?php echo (!empty($data['password_confirm_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password_confirm']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_confirm_err']; ?></span>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-light btn-block">Have an Account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>