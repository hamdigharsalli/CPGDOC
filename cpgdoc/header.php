<!DOCTYPE html>
<head>

    <meta charset="UTF-8">
    <title>الهيكل التنظيمي لشركة فسفاط قفصة</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
    <link rel="icon" type="image/x-icon" href="assets/logo.ico">
    
    
    <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="assets/css/char/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/char/jquery.orgchart.css">
    <link rel="stylesheet" href="assets/css/char/style.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<!-- Navigation Bar-->
<?php if($page){$page=$page;}else{$page="";}?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Org CPG V1.0</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page=="actuel" ? 'class="active"' : ''; ?>><a href="organigramme_actuel">Organigramme actuel</a></li>
                <li <?php echo $page=="prevu" ? 'class="active"' : ''; ?>><a href="organigramme_prevu">Organigramme prévu</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span
                            class="glyphicon glyphicon-user"></span>&nbsp;
                        <?php echo $_SESSION['login']; ?>
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a>
                        </li>
                        <?php if($_SESSION['login']=="admin"){?><li <?php echo $page=="register" ? 'class="active"' : ''; ?>><a href="inscriptiopn" 
                       name="btn-login">Devenir membre
                    </a></li><?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
