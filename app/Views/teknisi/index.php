<?= $this->extend('teknisi/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <?php $uri = service('uri'); ?>

    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/teknisi/my_assigment" class="btn navbar <?= ($uri->getSegment(2) == 'my_assigment' ? 'active' : null) ?>">My Assigment</a>
    <a href=" <?= base_url(); ?>/teknisi/v_all_ticket" class="btn navbar <?= ($uri->getSegment(2) == 'v_all_ticket' ? 'active' : null) ?>">View My Tickets</a>
</div>


<div class=" content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-teknisi"><b>Welcome <?= session()->get('username'); ?></b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href="<?= base_url(); ?>/teknisi/change_password_t" class="">Change Password</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="padding-left:30px;margin-top:35px; ">
                    <h2 style="font-family:merriweather, serif; font-weight:600; line-height:50px;font-size:36px;text-align:center !important;color:#322F56;">Welcome to Helpdesk System</h2>
                    <img src="<?= base_url(); ?>/assets/visio-logo.png" alt="" style="display: block;margin-left: auto;margin-right: auto;">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="<?= base_url(); ?>/teknisi/my_assigment" class="<?= ($uri->getSegment(2) == 'my_assigment' ? 'active' : null) ?>">My Assigment</a>
        <a href="<?= base_url(); ?>/teknisi/v_all_ticket" class="<?= ($uri->getSegment(2) == 'v_all_ticket' ? 'active' : null) ?>">View My Tickets</a>
    </div>
</div>
<!-- <div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="#">Link 5</a>
        <a href="#">Link 6</a>
        <a href="#">Link 7</a>
    </div>
</div> -->


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