<?= $this->extend('login/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 " style="margin-top: 80px;">
            <img src="<?= base_url(); ?>/assets/image1.png" class="logo" alt=""></>
            <h1 class="title font-weight-bold">Sign in</h1>
            <!-- <form action="">
                <div class="form-group">
                    <label class="title-1" for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label class="title-1" for="Password">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Password">
                </div>
                <div>

                    <a href="http://"><label class="title-2">Lupa Password</label></a>
                </div>
                <button type="submit" class="btn btn-login">Masuk Akun Saya</button>
            </form> -->

            <form action="/action_page.php">
                <div class="row">
                    <div class="form-group">
                        <div class="col-25">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="username" name="username" placeholder="Username" autofocus>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-25">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <a href="http://"><label>Lupa Password</label></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <button type="submit" class="btn btn-login">Masuk Akun Saya</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>