<?php
include_once ".links.php";
$title = "Login";
include_once "includes/header.php";
if ($user->isActive()){ header("location: index");}
?>

<body class="d-flex align-items-center justify-content-center">

<div class="chat-body container">

    <div class="panel p-3 bg-white rounded shadow">

        <div class="panel-heading p-1 border-bottom">
            <h3 class="heading text-dark">Login</h3>
        </div>
        <br>

        <div class="panel-body mt-3">
            <form class="form-container" data-prevenDefault method="post" id="loginForm">

                <div class="form-group mb-4">
                    <label for="email" class="font-16">Email</label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control font-14">
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="font-16">Password</label>
                    <input type="password" placeholder="password" name="password" id="password" class="form-control font-14">
                </div>

                <button class="btn btn-dark btn-block" id="submitForm"> Continue to chat</button>
                <div class="text-center mt-4">
                    <a href="register" class="alert-link font-14">Don't have account yet?</a>
                </div>
            </form>
        </div>

    </div>

</div>

<?php include_once "includes/footer.php";
