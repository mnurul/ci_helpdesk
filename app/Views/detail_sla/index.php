<?= $this->extend('detail_sla/template'); ?>

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
                <a href="<?= base_url(); ?>/admin/sla_setting_a">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">Detail SLA</h2>
                <div class="card mt-3 mb-5">
                    <div class="card-body">
                        <form action="/action_page.php">
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="sla-level">SLA Level</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="sla-level" name="sla-level">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="sla">SLA</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="sla" name="sla">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="response-time">Response Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="response-time" name="response-time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="resultion-time">Resultion Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="resultion-time" name="resultion-time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label class="title-1" for="sla-w-time">SLA Warning Time</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="sla-w-time" name="sla-w-time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-75">
                                    <!-- <button type="submit" class="btn-ticket">Submit</button> -->
                                    <div class="row">
                                        <div class="col">
                                            <a href="" class="btn btn-edit">Edit</a>
                                        </div>
                                        <div class="col">
                                            <a href="" class="btn btn-delete">Delete</a>
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