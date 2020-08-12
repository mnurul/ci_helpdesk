<?= $this->extend('detail_product/template'); ?>

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
                <h2 class="title font-weight-bold">Detail Product</h2>
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
                                    <label class="title-1" for="idcustomer">Id Customer</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="idcustomer" name="idcustomer" autofocus value="<?= ($_SERVER["REQUEST_METHOD"] == "POST" ? $idcustomer   : $product['idcustomer']) ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csproduct">Customer Product</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="csproduct" name="csproduct" required value="<?= ($_SERVER["REQUEST_METHOD"] == "POST" ? $csproduct   : $product['csproduct']) ?>">
                                </div>
                            </div>

                            <div class=" row">
                                <div class="col-75">
                                    <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-edit">Edit</button>
                                            <!-- <a href="/admin/edit_user/" class="btn btn-edit">Edit</a> -->
                                        </div>
                                        <div class="col">
                                            <!-- <form action="/admin/delete/" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                            </form> -->
                                            <!-- <a href="" class="btn btn-delete">Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-75">
                                <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                <div class="row">
                                    <div class="col">
                                        <!-- <button type="submit" class="btn btn-edit">Edit</button> -->
                                        <!-- <a href="/admin/edit_user/" class="btn btn-edit">Edit</a> -->
                                    </div>
                                    <div class="col">
                                        <?php ($_SERVER["REQUEST_METHOD"] == "POST" ? $idcustomer   : $product['idcustomer']) ?>
                                        <form action="/product/<?= ($_SERVER["REQUEST_METHOD"] == "POST" ? $idcustomer   : $product['idcustomer']); ?>" method="post" class="d-inline">
                                            <!-- Fitur keamanan ci4 buat form!-- -->
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                        </form>
                                        <!-- <a href="" class="btn btn-delete">Delete</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
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

<?= $this->endSection(); ?>