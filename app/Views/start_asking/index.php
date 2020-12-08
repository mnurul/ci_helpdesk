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

                            <div id="List" class="scrollit">
                                <table width="800" border="0" align="center">
                                    <tr>
                                        <td height="192" width="100%" colspan="2" valign="bottom">
                                            <table width="100%" border="0" id="tampilchat" cellpadding="2" cellspacing="2">
                                                <tr>
                                                    <td valign="top" width="10%">

                                                    </td>
                                                    <td valign="top" align="">
                                                        <div id="ConR">

                                                            <div id="ConRspasi">Ada yang bisa saya bantu?</div>
                                                        </div>
                                                    </td>
                                                    <td width="10%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><input required name="tanya" autofocus placeholder="Keyword : edc" type="text" class="tanya" id="tanya" size="50" style="width:99%" onKeyUp="inputKeyUp(event)"></td>
                                        <td width="20%"><input type="button" name="button" onClick="cek()" id="button" value="Kirim" title="Klik tombol untuk mengirim pesan "><input type="button" name="button" id="button1" value="Refresh" onclick="refreshbox()" title="Klik tombol untuk merefresh"></td>
                                    </tr>
                                </table>
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#tanya").autocomplete({
            source: "<?= base_url(); ?>/User/auto",
            select: function(event, ui) {
                // Set selection
                $('#tanya').val(ui.item.label); // display the selected text
                return false;
            }

        });
    });
</script>

<script>
    function inputKeyUp(e) {
        e.which = e.which || e.keyCode;
        if (e.which == 13) {
            // submit
            cek();
        }
    }

    function cek() {
        var tanya = document.getElementById('tanya').value;
        var letak = 'right';
        historichat(tanya, letak)


        $.post("<?= base_url(); ?>/User/tanyajawab?tanya=" + tanya, $("form").serialize(), function(hasil) {

            data = hasil.split("|");
            var letak = '';
            var kata = data[0];

            historichatadmin(kata, letak);
            document.getElementById('tanya').value = '';
        });
    }

    function historichat(kata, letak) {

        if (window.matchMedia('(max-width: 600px)').matches) {
            // do functionality on screens smaller than 600px
            $('#tampilchat tr:last').after('<tr ><td width="10%"></td><td valign="top" style="padding-right: 450px !important;" align=\"' + letak + '\"><div id="ConR" ><div id="ConRspasi" >' + kata + '</div></div></td><td width="10%"  valign="top"><h5 style="font-family:Merriweather-700, serif;font-style: normal;font-weight: 700; font-size: 28px;line-height: 34px; color: #244295;margin-left:-915px !important">Me</h5></td></tr>');
        } else {
            $('#tampilchat tr:last').after('<tr><td width="10%"></td><td valign="top" align=\"' + letak + '\"><div id="ConR"><div id="ConRspasi" style="font-size:15px;">' + kata + '</div></div></td><td width="10%" valign="top"><h5 style="font-family:Merriweather-700, serif;font-style: normal;font-weight: 700; font-size: 28px;line-height: 34px; color: #244295;">Me</h5></td></tr>');
        }
    }

    function historichatadmin(kata, letak) {
        if (window.matchMedia('(max-width: 600px)').matches) {
            $('#tampilchat tr:last').after('<tr><td valign="top"><h5 style="font-family:Merriweather-700, serif;font-style: normal;font-weight: 700; font-size: 28px;line-height: 34px; color: #244295;">Admin</h5></td><td  valign="top" style="padding-right: 450px !important;" align=\"' + letak + '\"><div id="ConR" style="height:75px !important;"><div id="ConRspasi">' + kata + '</div></div></td><td></td></tr>');
        } else {
            $('#tampilchat tr:last').after('<tr ><td  valign="top" ><h5 style="font-family:Merriweather-700, serif;font-style: normal;font-weight: 700; font-size: 28px;line-height: 34px; color: #244295;">Admin</h5></td><td valign="top" align=\"' + letak + '\"><div id="ConR" style="height:75px !important;"><div id="ConRspasi" style="font-size:15px;">' + kata + '</div></div></td><td></td></tr>');
        }
    }


    function refreshbox() {
        window.open("<?php echo base_url(); ?>/user/start_asking", "_self");
    }
</script>

<?= $this->endSection(); ?>