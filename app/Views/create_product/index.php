<?php

use Config\Validation;
?>
<?= $this->extend('create_product/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h6 class="t-customer"><b>Welcome Customer</b></h6> -->
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/admin/list_product">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Create Product</h2>
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
                                    <label class="title-1" for="idcustomer">Customers</label>
                                </div>
                                <div class="col-75">
                                    <select id="idcustomer" name="idcustomer" style="height: 45px !important;">
                                        <?php foreach ($product as $p) : ?>
                                            <option value=""></option>
                                            <option value="<?= $p['idcustomer']; ?>"><?= $p['csnama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csproduct">Product</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" class="auto-save form-control" id="csproduct" name="csproduct" style="color: black;" required>
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
</script>

<?= $this->endSection(); ?>