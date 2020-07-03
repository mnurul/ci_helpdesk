<?= $this->extend('change_password/template'); ?>

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
            <h6 class="t-customer"><b>Welcome Customer</b></h6>
            <div class="topnav" id="myTopnav">
                <img src="<?= base_url(); ?>/assets/home-user-1.png" class="logo" alt="" loading="lazy">
                <a href="#contact">Logout</a>
                <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="" class="">Change Password</a>
                <a href="<?= base_url(); ?>/user/create_ticket" class="">Create Tickets</a>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Change Password</h2>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="/action_page.php">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="new-password">New Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="new-password" name="new-password" autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="r-new-password">Repeat New Password</label>
                                </div>
                                <div class="col-75">
                                    <input type="password" id="r-new-password" name="r-new-password">
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