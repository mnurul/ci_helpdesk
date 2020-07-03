<?= $this->extend('sla_chart_a/template'); ?>

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
                    <a href="<?= base_url(); ?>/admin/change_status">Change Status Tickets</a>
                    <a href="<?= base_url(); ?>/admin/create_project">Create Projects</a>
                    <a href="<?= base_url(); ?>/admin/create_user">Create User</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="margin-top:15px; ">
                    <h2 class="title font-weight-bold">SLA Chart</h2>
                    <a href="<?= base_url(); ?>/admin/sla_setting_a" class="a-user">SLA Setting</a>
                    <div class="container mt-3">
                        <div class="row mb-2" style="height:300px">
                            <div class="col card card1 mr-2">
                                <h1>Diagram satu</h1>
                            </div>
                            <div class="col card card2">
                                <h1>Diagram dua</h1>
                            </div>
                        </div>
                        <div class="row" style="height:300px">
                            <div class="col card">
                                <h1>Diagram tiga</h1>
                            </div>
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
        <button class="dropbtn">My Tickets</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/admin/pivot_table_a">Pivot Table</a>
            <a href="<?= base_url(); ?>/admin/sla_chart_a">SLA Chart</a>
        </div>
    </div>
    <div class="col-6" style="margin-left:-15px;">
        <button class="dropbtn">My Ticket</button>
        <div class="dropup-content">
            <a href="<?= base_url(); ?>/admin/my_request">My Request</a>
            <a href="<?= base_url(); ?>/admin/my_assigment_a">My Assigment</a>
            <a href="<?= base_url(); ?>/admin/my_resolution">My Resolution</a>
            <a href="<?= base_url(); ?>/admin/w_for_close">Waiting for Close</a>
            <a href="<?= base_url(); ?>/admin/v_all_ticket_a">View All Tickets</a>
            <a href="<?= base_url(); ?>/admin/popular_solution">Popular Solution</a>
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