<?php
include_once ".links.php";
$title = "Welcome back";
include_once "includes/header.php";
if (!$user->isActive()) header("location: login");
?>


    <body class="d-flex align-items-center justify-content-center friendList">

    <div class="chat-body container p-3 bg-white rounded shadow">

        <div class="panel col-sm-12 m-auto">

            <div class="panel-heading p-2 d-flex align-items-center justify-content-between border-bottom">

                <div class="user d-flex align-items-baseline justify-content-between ">
                    <div class="avatar mr-3 ">
                        <?php
                        $admin = $user->_user($_SESSION["clientSession"]);
                        if (!empty($admin->profile_image)) {
                            ?>
                            <img src="<?= "browser/uploads/" . $admin->profile_image ?>" alt="user" id="user"
                                 class="rounded-circle">
                        <?php } else { ?>
                            <div class="default_pics d-flex align-items-center justify-content-center"> <?= $admin->name[0] ?></div>
                        <?php }
                        ?>
                        <i class="activity <?= $admin->status !== "offline" ? "active" : "offline" ?>"></i>
                    </div>
                    <div class="name font-18">
                        <span><?= !empty($admin->name) ? ucfirst(explode(" ", $admin->name)[0]) : "" ?></span>
                        <p class="text-muted font-12 mb-0">ID:  <?=$admin->u_id?></p>
                        <p class="status font-12 text-success"><?= $admin->status ?></p>
                    </div>
                </div>

                <button class="btn btn-danger" data-action="logout">Logout</button>
            </div>

            <div class="panel-body mt-3 m-auto">
                <div class="mb-4 form-group d-flex mt-4">
                    <input type="search" placeholder="Search for users" name="users" id="search_users"
                           class="form-control font-14 col-lg-11 col-sm-11 rounded-0">
                    <button class="btn btn-dark"><i class="ri-search-2-line"></i></button>
                </div>
                <ul class="list-group friend-list mt-5" id="user_list">
                    <?php
                    $user->users_html($user->getUsers());
                    ?>
                </ul>
            </div>

        </div>

    </div>

    </body>

<?php
include_once "includes/footer.php";