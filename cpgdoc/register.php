<?php
ob_start();
session_start();
$page= "register";
if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}
include_once 'dbconnect.php';

?>

<!DOCTYPE html>
<head>

    <meta charset="UTF-8">
    <title>Recherche documentaire</title>

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">


    <style>

        /* using font */
        header, .text .regular, .text .regular h3, .content { font-family: 'JF Flat Regular',Sans-Serif; } /* regular */

    </style>

    <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="assets/css/custom.min.css">
</head>
<body>

<!-- Navigation Bar-->
<?php if($page){$page=$page;}else{$page="";}?>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <a href="../" class="navbar-brand">CPG Doc V1.0</a>
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


<?php
if (isset($_POST['signup'])) {

    $uname = trim($_POST['uname']); // get posted data and remove whitespace
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);

    // hash password with SHA256;
    $password = hash('sha256', $upass);

    // check email exist or not
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // if email is not found add user


        $stmts = $conn->prepare("INSERT INTO users(username,email,password) VALUES(?, ?, ?)");
        $stmts->bind_param("sss", $uname, $email, $password);
        $res = $stmts->execute();//get result
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: basedoc");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used";
    }

}
?>




<div class="container">

    <div id="login-form">
        <form method="post" autocomplete="off">
            <div class="row">
                <div class="col">

                </div>
                <div class="col-6">

                <div class="form-group">
                    <h2 class="">Devenir membre</h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                if (isset($errMSG)) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="uname" class="form-control" placeholder="Entrez votre login" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Entrez votre Email" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Entrez votre mot de passe"
                               required/>
                    </div>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" id="TOS" value="This"><a href="#"> Je suis d'accord avec
                             conditions d'utilisation</a></label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg">Inscription</button>
                </div>

                <div class="form-group">
                    <hr/>
                </div>


            </div>
                <div class="col">

                </div>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
