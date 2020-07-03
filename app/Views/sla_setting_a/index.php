<?= $this->extend('sla_setting_a/template'); ?>

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
                <a href="<?= base_url(); ?>/admin/sla_chart_a">Back</a>
                <!-- <a href="<?= base_url(); ?>/user/v_ticket_status">View Ticket Status</a>
                <a href="<?= base_url(); ?>/user/change_password" class="">Change Password</a>
                <a href="" class="">Create Tickets</a> -->
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
            </div>
            <div style="padding-left:30px;margin-top:15px; ">
                <h2 class="title font-weight-bold">SLA Setting</h2>
                <div class="card1 mt-3 mb-5">
                    <div class="card-body">
                        <a href="<?= base_url(); ?>/admin/add_sla" class="a-user">Create SLA</a>
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for " title="Type in a name">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">SLA Level</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">SLA</h5>
                                    <a href="<?= base_url(); ?>/admin/detail_sla" class=" btn-assign">Edit</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">SLA Level</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">SLA</h5>
                                    <a href="<?= base_url(); ?>/admin/detail_sla" class=" btn-assign">Edit</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">SLA Level</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">SLA</h5>
                                    <a href="<?= base_url(); ?>/admin/detail_sla" class=" btn-assign">Edit</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">SLA Level</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">SLA</h5>
                                    <a href="<?= base_url(); ?>/admin/detail_sla" class=" btn-assign">Edit</a>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <h6 class="card-subtitle st-ticket text-muted">SLA Level</h6>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                    <h5 class="card-title text">SLA</h5>
                                    <a href="<?= base_url(); ?>/admin/detail_sla" class=" btn-assign">Edit</a>
                                </div>
                            </div>

                        </div>
                        <div class="pagination justify-content-center ">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a class="active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
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