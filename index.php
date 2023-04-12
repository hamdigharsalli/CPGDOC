<?php
ob_start();
session_start();
$page= "base";
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}
// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
//require_once 'header.php';
?>
<!DOCTYPE html>
<head>

    <meta charset="UTF-8">
    <title>Recherche documentaire</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">


    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css"/>

    <script type="text/javascript" src="assets/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="assets/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="assets/js/jszip.min.js"></script>
    <script type="text/javascript" src="assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="assets/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="assets/js/buttons.print.min.js"></script>




    <link rel="stylesheet" href="assets/css/char/style.css">
    <link rel="stylesheet" href="style.css">

      <!-- Import Font -->
  <link rel="stylesheet" href="assets/font.css">

  <!-- CSS Style -->
  <style>

    /* using font */
    header, .text .regular, .text .regular h3, .content { font-family: 'JF Flat Regular',Sans-Serif; } /* regular */
    b {
        font-weight: bold;
        color: #117a8b !important;
    }
    table.dataTable thead .sorting { background: url('assets/images/sort_both.png') no-repeat center right; }
    table.dataTable thead .sorting_asc { background: url('assets/images/sort_asc.png') no-repeat center right; }
    table.dataTable thead .sorting_desc { background: url('assets/images/sort_desc.png') no-repeat center right; }

    table.dataTable thead .sorting_asc_disabled { background: url('assets/images/sort_asc_disabled.png') no-repeat center right; }
    table.dataTable thead .sorting_desc_disabled { background: url('assets/images/sort_desc_disabled.png') no-repeat center right; }
  </style>

    <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="assets/css/custom.min.css">

</head>
<body>

<!-- Navigation Bar-->
<?php if($page){$page=$page;}else{$page="";}?>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <a href="../" class="navbar-brand">CPG Doc V1.1</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="basedoc">Base documentaire</a>
                </li>


            </ul>

            <ul class="nav navbar-nav ml-auto">
                <?php if($_SESSION['login']=="admin"){?><li <?php echo $page=="register" ? 'class="active"' : ''; ?>><li class="nav-item">
                    <a class="nav-link" href="inscription" name="btn-login">Devenir membre</a>
                </li><?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['login']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout" title="Déconnection" style="color: #fff;">Déconnexion</a>
                </li>
            </ul>

        </div>
    </div>
</div>





        <script>
            $("#search_text").val("");

        </script>
        <div class="container-fluid">

            <h2 align="center">Recherche documentaire CPG</h2><br />


            <!-- Avec un bouton à droite -->
            <div class="input-group">
                <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Saisissez des termes à rechercher séparés par des espaces">
                <span class="input-group-btn">
           <button class="btn btn-primary" id="subsearch" type="button"><span class="glyphicon glyphicon-search"></span> Recherche</button>
                    </span>
            </div>
            <br />
            <div id="result" style="background-color: #ffffff;padding-top: 5px;padding-left: 5px;padding-right: 5px;"></div>
        </div>
        <div style="clear:both"></div>
        <br/>



<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(e) {
            if (e.keyCode == 13) {
                var search = $('#search_text').val();
                if(search != '')
                {
                    load_data(search);
                }
                else
                {
                    load_data();
                }
            }
        });
        $('#subsearch').click(function(){
            var search = $('#search_text').val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        });
    });
</script>
</body>
</html>
