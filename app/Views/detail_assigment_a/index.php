<?= $this->extend('detail_assigment_a/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h6 class="t-customer"><b>Welcome Customer</b></h6> -->
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/admin/my_assigment_a">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Detail My Assigment</h2>
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
                        <form action="/admin/proses_assigment/<?= $ticket['id']; ?>" method="post">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idcustomer" hidden>Id Customer</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="idcustomer" name="idcustomer" autofocus value=" <?= $ticket['idcustomer']; ?>" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csnama">Nama Customer</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="csnama" name="csnama" autofocus value=" <?= $ticket['csnama']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csproduct">Product</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="csproduct" name="csproduct" value=" <?= $ticket['csproduct']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="wperiod">Waranty Period</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="wperiod" name="wperiod" value=" <?= $ticket['warantyperiod']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cperiod">Contract Period</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="cperiod" name="cperiod" value="<?= $ticket['contractperiod']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="rdate">Report Date</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="rdate" name="rdate" value="<?= $ticket['reportdate']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="rby">Report By</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="rby" name="rby" value="<?= $ticket['reportby']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="psummary">Problem Summary</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="psummary" name="psummary" value="<?= $ticket['problemsummary']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="pdetail">Problem Detail</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="pdetail" name="pdetail" style="height:200px" value="<?= $ticket['problemdetail']; ?>"><?= $ticket['problemdetail']; ?></textarea> </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="idsla">SLA</label>
                                </div>
                                <div class="col-75">
                                    <select id="idsla" name="idsla" style="height:45px !important">
                                        <option value="">Select SLA</option>
                                        <?php foreach ($sla as $s) : ?>
                                            <option value="<?= $s['idsla']; ?>"><?= $s['namasla']; ?></option>
                                            <!-- <option value="Product">Product</option> -->
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="ticketstatus">Ticket Status</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="ticketstatus" name="ticketstatus" value="Assigned">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="assigne">SLA</label>
                                </div>
                                <div class="col-75">
                                    <select id="assigne" name="assigne" style="height:45px !important">
                                        <option value="">Select Teknisi</option>
                                        <?php foreach ($teknisi as $t) : ?>
                                            <option value="<?= $t['iduser']; ?>"><?= $t['username']; ?></option>
                                            <!-- <option value="Product">Product</option> -->
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-edit">Assigne</button>
                                            <!-- <a href="/admin/edit_user/<?= $ticket['id']; ?>" class="btn btn-edit">Edit</a> -->
                                        </div>
                                    </div>
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

<?= $this->endSection(); ?>