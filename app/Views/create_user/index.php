<?= $this->extend('create_user/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/admin/my_request" class="active btn navbar">My Request</a>
    <a href="<?= base_url(); ?>/admin/my_assigment_a" class=" btn navbar">My Assigment</a>
    <a href="<?= base_url(); ?>/admin/my_resolution" class=" btn navbar">My Resolution</a>
    <a href="<?= base_url(); ?>/admin/w_for_close" class=" btn navbar">Waiting for Close</a>
    <a href="<?= base_url(); ?>/admin/v_all_ticket_a" class=" btn navbar">View All Tickets</a>
    <a href="<?= base_url(); ?>/admin/popular_solution" class=" btn navbar">Popular Solution</a>
    <a href="#contact" class=" btn navbar">Search Tickets</a>
    <h6 class="t-view-report"><b>View Report</b></h6>
    <br>
    <a href="<?= base_url(); ?>/admin/pivot_table_a" class="active btn navbar">Pivot Table</a>
    <a href="<?= base_url(); ?>/admin/sla_chart_a" class="btn navbar">SLA Chart</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-admin"><b>Welcome Admin</b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-manager.png" class="logo" alt="" loading="lazy">
                    <a href="#contact">Logout</a>
                    <a href="#contact">Change Status Tickets</a>
                    <a href="<?= base_url(); ?>/admin/create_project">Create Projects</a>
                    <a href="<?= base_url(); ?>/admin/create_user">Create User</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">Create User</h2>
                    <div class="card mt-3">
                        <div class="card-body">
                            <form action="/action_page.php">
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="id-user">Id User</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="id-user" name="id-user">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="username">Username</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="username" name="username">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="password">Password</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="password" id="password" name="password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="level">Level</label>
                                    </div>
                                    <div class="col-75">
                                        <select id="level" name="level" style="padding-top: -30px !important;">
                                            <option value=""></option>
                                            <option value="Level">Level</option>
                                            <option value="Level">Level</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="fullname">Fullname</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="fullname" name="fullname">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="email">Email</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="email" id="email" name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="telp">Telp</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="telp" name="telp">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="email-code">Email Code</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="email-code" name="email-code">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="time">Time</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="time" name="time">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="confirmed">Confirmed</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="confirmed" name="confirmed">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label class="title-1" for="ip">Ip</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="ip" name="ip">
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


<!-- <div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="#">My Request</a>
        <a href="#">My Assigment</a>
        <a href="#">My Resolution</a>
        <a href="#">Waiting for Close</a>
        <a href="#">View All Tickets</a>
        <a href="#">Popular Solution</a>
        <a href="#">Search Tickets</a>
    </div>
</div>
<div class="dropup">
    <button class="dropbtn">View Report</button>
    <div class="dropup-content">
        <a href="#">Pivot Table</a>
        <a href="#">SLA Chart</a>
    </div>
</div> -->
<div class="dropup">
    <div class="col-6" style="bottom: 0; margin-left:170px;margin-bottom:-40px !important">
        <button class="dropbtn">View Report</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/manager/pivot_table">Pivot Table</a>
            <a href="<?= base_url(); ?>/manager/sla_chart">SLA Chart</a>
        </div>
    </div>
    <div class="col-6" style="margin-left:-15px;">

        <button class="dropbtn">My Tickets</button>
        <div class="dropup-content">
            <a href="#">My Request</a>
            <a href="#">My Assigment</a>
            <a href="#">My Resolution</a>
            <a href="#">Waiting for Close</a>
            <a href="#">View All Tickets</a>
            <a href="#">Popular Solution</a>
            <a href="#">Search Tickets</a>
        </div>
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