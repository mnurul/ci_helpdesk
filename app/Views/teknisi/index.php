<?= $this->extend('teknisi/template'); ?>

<?= $this->section('content'); ?>

<div class="sidebar">
    <h6 class="t-ticket"><b>My Tickets</b></h6>
    <br>
    <a href="<?= base_url(); ?>/teknisi/my_assigment" class="active btn navbar">My Assigment</a>
    <a href="<?= base_url(); ?>/teknisi/v_all_ticket" class="btn navbar">View All Tickets</a>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <h6 class="t-teknisi"><b>Welcome Teknisi</b></h6>
                <div class="topnav" id="myTopnav">
                    <img src="<?= base_url(); ?>/assets/home-teknisi.png" class="logo" alt="" loading="lazy">
                    <a href="<?= base_url(); ?>/login/logout">Logout</a>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <div style="padding-left:30px;margin-top:15px; ">
                    <h2>Helpdesk System</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui obcaecati rem quisquam repellat itaque suscipit, quae est laboriosam eos et quos enim cumque provident, ullam ducimus culpa, ab ipsum sapiente.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="dropup">
    <button class="dropbtn">My Tickets</button>
    <div class="dropup-content">
        <a href="<?= base_url(); ?>/teknisi/my_assigment">My Assigment</a>
        <a href="<?= base_url(); ?>/teknisi/v_all_ticket">View All Tickets</a>
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