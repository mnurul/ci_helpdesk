<?php

use Config\Validation;
?>
<?= $this->extend('create_user/template'); ?>

<?= $this->section('content'); ?>

<!-- <div class="container">
    <div class="row">
        <div class="col ">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="margin-left: auto;">
                        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="#">Features</a>
                        <a class="nav-item nav-link" href="#">Pricing</a>
                        <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </div>
                </div>
            </nav>
        </div>

        
    </div>

</div> -->

<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h6 class="t-customer"><b>Welcome Customer</b></h6> -->
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/admin/list_user">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Create User</h2>
                <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <?php
                        $pesan = session()->getFlashdata('pesan');
                        $failed = session()->getFlashdata('failed');
                        $inputs = session()->getFlashdata('inputs');
                        $errors = session()->getFlashdata('errors');
                        if (!empty($pesan)) { ?>
                            <div class="alert alert-success alert-pesan" role="alert">
                                <?= $pesan; ?>
                            </div>
                        <?php } elseif (!empty($failed)) { ?>
                            <div class="alert alert-danger alert-failed" role="alert">
                                <?= $failed; ?>
                            </div>
                        <?php } elseif (!empty($errors)) { ?>
                            <div class="alert alert-danger alert-error" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li style="margin-left: -10px;"><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php }
                        ?>
                        <form action="" method="post">

                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="iduser">Id User</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="iduser" name="iduser" placeholder="Last <?= ($_SERVER["REQUEST_METHOD"] == "POST" ? null   : $builder) ?>" value="<?= ($_SERVER["REQUEST_METHOD"] == "POST" ? $iduser   : null) ?>" autofocus required>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="username">Username</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="username" name="username" required value="<?= $username; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="password">Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="password" name="password" class="auto-save form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="level">Level</label>
                                </div>
                                <div class="col-75">
                                    <select id="level" name="level" onclick="myFunction()" class="auto-save" style="height: 45px !important;">
                                        <option value="<?= $level; ?>"><?= $level; ?></option>
                                        <option value="customer">Customer</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idcustomer">Customer</label>
                                </div>
                                <div class="col-75">
                                    <select id="idcustomer" name="idcustomer" class="auto-save" style="height: 45px !important;">
                                        <option value="<?= $level; ?>"><?= $level; ?></option>

                                        <?php foreach ($product as $p) : ?>
                                            <option value=""></option>
                                            <option value="<?= $p['idcustomer']; ?>"><?= $p['csnama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="fullname">Fullname</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="fullname" name="fullname" required value="<?= $fullname; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="email">Email</label>
                                </div>
                                <div class="col-75">
                                    <input type="email" class="auto-save form-control" id="email" name="email" required value="<?= $email; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="telp">Telp</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="telp" name="telp" required value="<?= $telp; ?>">
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="emailcode">Email Code</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="emailcode" name="emailcode">
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="time">Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="time" name="time" required value="">
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="confirmed">Confirmed</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="confirmed" name="confirmed">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="ip">Ip</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="ip" name="ip" required value="<?= $ip; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn-ticket">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <form action="/action_page.php">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="n-ticket">No Ticket</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="n-ticket" name="n-ticket">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="r-date">Reported Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="r-date" name="r-date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="p-summary">Problem Summary</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="p-summary" name="p-summary" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="date">Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="date" name="date" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="teknisi">Teknisi</label>
                                </div>
                                <div class="col-75">
                                    <select id="teknisi" name="teknisi" style="padding-top: -30px !important;">
                                        <option value=""></option>
                                        <option value="Teknisi">Teknisi</option>
                                        <option value="Teknisi">Teknisi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <button type="submit" class="btn btn-ticket">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
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

<script>
    $('.auto-save').savy('load');

    // you can pass a function to be called when savy is finished loading.
    $('.auto-save').savy('load', function() {
        console.log("All data from savy are loaded");
    });



    $('.auto-save').savy('destroy');

    // you can pass a function to be called when savy is destroyed.
    $('.auto-save').savy('destroy', function() {
        console.log("All data from savy are destroyed");
    });

    // $('.auto-save').savy('load', function() {
    //     console.log("All data from savy are loaded");
    // });

    // $('.auto-save').savy('destroy', function() {
    //     console.log("All data from savy are destroyed");
    // });
</script>

<?= $this->endSection(); ?>