<?php
include_once ".links.php";
$title = "Let's get started";
include_once "includes/header.php";
if ($user->isActive()){ header("location: index");}

?>


    <body class="flex flex-items-center flex-content-center max-h">

    <div class="chat-body container">

        <div class="panel col-lg-6 m-auto">
            <div class="alert" data-notify="alert"> </div>

            <div class="p-3 rounded shadow bg-white pb-0">
            <div class="panel-heading p-1 border-bottom text-enter">
                <h3 class="heading text-dark">Register</h3>
            </div>

            <div class="panel-body mt-3">

                <form class="form-container" data-prevenDefault method="post" id="registerForm">

                    <br>

                    <div class="form-group mb-4">
                        <label for="name" class="font-16">Full Name</label>
                        <input type="text" name="fullName" placeholder="Full name" id="name" class="form-control font-14 p-2" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="email" class="font-16">Email</label>
                        <input type="email" placeholder="Email" name="email" id="email" class="form-control font-14" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" class="font-16">Password</label>
                        <input type="password" placeholder="password" name="password" id="password" class="form-control font-14" required>
                    </div>

                    <button class="btn btn-dark btn-block" id="signUp"> Let's get started</button>
                </form>
                <div class="text-center mt-4">
                        <a href="login" class="link font-14">Already a member?</a>
                    </div>
            </div>
            </div>
        </div>

    </div>

<?php include_once "includes/footer.php";