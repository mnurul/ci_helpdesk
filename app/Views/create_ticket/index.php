<?= $this->extend('create_ticket/template'); ?>

<?= $this->section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">
            <h6 class="t-customer"><b>Welcome <?= session()->get('idcustomer'); ?></b></h6>
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/login/logout">Logout</a>
                <a href="<?= base_url(); ?>/user/">Back</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Create Ticket</h2>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="/action_page.php" method="post">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="customers">Customers</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="customers" name="customers" value="<?= $csnama['csnama']; ?>" autofocus required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="csproduct">Customers Product</label>
                                </div>
                                <div class="col-75">
                                    <select id="csproduct" name="csproduct" style="height:45px !important">
                                        <option value="">Select Product</option>
                                        <?php foreach ($namaProject as $np) : ?>
                                            <option value="<?= $np['idproject']; ?>"><?= $np['namaproject']; ?></option>
                                            <!-- <option value="Product">Product</option> -->
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="wperiod">Waranty Period</label>
                                </div>
                                <div class="col-75">
                                    <select id="wperiod" disabled name="wperiod" style="height:45px !important;color:black !important;">
                                        <option value=""></option>
                                        <?php foreach ($namaProject as $np) : ?>
                                            <option value="<?= $np['idproject']; ?>" disabled style="color:black !important;"><?= $np['uatend']; ?> until <?= date('Y-m-d', strtotime("+2 years", strtotime($np['uatend'])))  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cperiod">Contract Period</label>
                                </div>
                                <div class="col-75">
                                    <select id="cperiod" disabled name="cperiod" style="height:45px !important;color:black !important;">
                                        <option value=""></option>
                                        <?php foreach ($namaProject as $np) : ?>
                                            <option value="<?= $np['idproject']; ?>" disabled style="color:black !important;"><?= $np['billstartdate']; ?> until <?= date('Y-m-d', strtotime("+1 years", strtotime($np['billstartdate'])))  ?></option>
                                            <!-- <option value="Product">Product</option> -->
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="wperiod">Waranty Period</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="wperiod" name="wperiod" value="<?= $getUatEnd; ?>" required>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="cperiod">Contract Period</label>
                                </div>
                                <div class="col-75">
                                    <?php foreach ($namaProject as $np) : ?>

                                        <input type="text" id="cperiod" name="cperiod" value="<?= $np['billstartdate']; ?> until " required>
                                    <?php endforeach; ?>

                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label for="subject">Subject</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit">
                            </div>
                            <button type="submit" class="btn btn-ticket">Masuk Akun Saya</button> -->
                        </form>
                    </div>
                </div>
                <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <!-- <form action="/action_page.php"> -->
                        <div class="row">
                            <div class="col-25">
                                <label class="title-1" for="rdate">Reported Date</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="rdate" name="rdate" value="<?= $rdate; ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label class="title-1" for="r-by">Reported By</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="r-by" name="r-by">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label class="title-1" for="p-summary">Problem Summary</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="p-summary" name="p-summary" placeholder="Problem Summary">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label class="title-1" for="p-detail">Problem Detail</label>
                            </div>
                            <div class="col-75">
                                <textarea id="p-detail" name="p-detail" placeholder="Describe your problem" style="height:200px"></textarea> </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <button type="submit" class="btn btn-ticket">Submit</button>
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