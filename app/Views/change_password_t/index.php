<?= $this->extend('change_password_t/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h6 class="t-customer"><b>Welcome <?= session()->get('username'); ?></b></h6>
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/login/logout">Logout</a>
                <a href="<?= base_url(); ?>/teknisi/">Back</a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Change Password</h2>
                <div class="card mt-3">
                    <div class="card-body">

                        <?php
                        // $this->session()->userdata('reset_email');
                        $pesan = session()->getFlashdata('pesan');
                        $logout = session()->getFlashdata('logout');
                        $inputs = session()->getFlashdata('inputs');
                        $errors = session()->getFlashdata('errors');
                        if (!empty($pesan)) { ?>
                            <div class="alert alert-danger alert-failed" role="alert">
                                <?= $pesan; ?>
                            </div>
                        <?php } elseif (!empty($logout)) { ?>
                            <div class="alert alert-danger alert-failed" role="alert">
                                <?= $logout; ?>
                            </div>
                        <?php  } elseif (!empty($errors)) { ?>
                            <div class="alert alert-danger alert-failed" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li style="margin-left: -10px;"><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php }
                        ?>


                        <form action="/Teknisi/update_password_t/" method="post">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="oldpassword">Old Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="oldpassword" name="oldpassword" autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="newpassword">New Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="newpassword" name="newpassword">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cpassword">Repeat New Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="cpassword" name="cpassword">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn btn-password">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<?= $this->endSection(); ?>