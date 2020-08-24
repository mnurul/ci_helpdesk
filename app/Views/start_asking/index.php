<?= $this->extend('start_asking/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h6 class="t-customer"><b>Welcome <?= session()->get('username'); ?></b></h6>
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                <a href="<?= base_url(); ?>/login/logout">Logout</a>
                <a href=" <?= base_url(); ?>/user/">Back </a> <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <!-- <a href="<?= base_url(); ?>/user/create_ticket" class="">Create Tickets</a> -->
                <a href="<?= base_url(); ?>/user/start_asking" class="">Start Asking</a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Start Asking</h2>
                <div class="card bg-card mt-3 mb-5">
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
                        <div class="row">
                            <div class="column">
                                <form action="" class="form-container" method="POST">
                                    <textarea type="password" id="admininput" name="admininput" class="admininput" placeholder="Chat with Me" autofocus></textarea>
                                    <textarea type="password" id="userinput" name="userinput" class="userinput" placeholder="Chat with My Admin" autofocus></textarea>
                                    <button type="submit" class="btn btn-send">Send</button>
                                    <!-- <input type="reset" value="Refresh" class="btn btn-refresh"> -->
                                    <button type="reset" class="btn btn-refresh">Refresh</button>
                                    <!-- <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted"></h6>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-2 st-date text-muted"></h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text"></h5>
                                    <a href="#" class="btn btn-status"></a>
                                </div> -->
                                </form>
                            </div>
                        </div><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5f3cbc7b1e7ade5df4421a6f/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->


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