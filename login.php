<?php
include_once ".links.php";
$title = "Login";
include_once "includes/header.php";
if ($user->isActive()){ header("location: index");}
?>

<body class="flex flex-items-center flex-content-center max-h">

<div class="chat-body container">

    <div class=" m-auto col-lg-6">

        <div class="alert" data-notify="alert"> </div>
    <div class="panel bg-white p-3 rounded">

        <div class="panel-heading p-1 border-bottom">
            <h3 class="heading text-dark">Login</h3>
        </div>
        <br>

        <div class="panel-body mt-3">
            <form class="form-container" data-preventDefault="true" method="post" id="loginForm">

                <div class="form-group mb-4">
                    <label for="email" class="font-16">Email</label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control font-14">
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="font-16">Password</label>
                    <input type="password" placeholder="password" name="password" id="password" class="form-control font-14">
                </div>

                <button class="btn btn-dark btn-block" id="submitForm"> Proceed to chat</button>
            </form>
            <div class="text-center mt-4">
                    <a href="register" class="link font-14">Don't have account yet?</a>
            </div>
        </div>
    </div>
    </div>

</div>

<?php include_once "includes/footer.php";
