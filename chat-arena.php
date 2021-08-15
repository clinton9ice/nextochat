<?php
include_once ".links.php";
$title = "Chatting room";
include_once "includes/header.php";
if (!$user->isActive()) header("location: login");
$id = substr($_GET["user"],0,7);

//Get the client information
$client = $user->_user($id);

//Check if the client has an image
$img = !empty($client->profile_image) ? '<img src="' . $client->profile_image. '" alt="name" class="avatar">' :
    '<div class="default_pics d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                  ' . $client->email[0] . '
               </div>';

?>
<body class="d-flex chat-board align-items-center justify-content-center">

<div class="container rounded shadow">

    <div class="panel m-auto chat-panel">

        <!--        Chat header-->
        <div class="panel-heading p-3 bg-white d-flex align-items-center justify-content-between">
            <div class="left-el d-flex align-items-center">
                <button class="btn btn-sm" data-prev>
                    <i class="ri-arrow-left-line"></i>
                </button>
                <div class="user ml-3 d-flex align-items-baseline justify-content-between ">
                    <div class="avatar mr-3">
                        <?=$img?>
                        <i class="activity <?= $client->status == "active" ? "active" : "offline" ?>"></i>
                    </div>
                    <div class="name font-18">
                        <span><?=  ucfirst(explode(" ", $client->name)[0])?></span>
                        <p class="status font-12 text-muted m-0"><?= $client->status ?></p>
                    </div>
                </div>
            </div>
            <div class="more dropdown">
                <button class="ellipse-md rounded-circle btn btn-sm d-flex align-items-center" data-target="dropdown"><i class="ri-more-2-fill"></i></button>
                <ul class="dropdown-menu">
                   <li class="dropdown-item"><a href="profile?id=<?=$client->u_id ?>" class="link">View Profile</a></li>
                   <li class="dropdown-item"><a href="#" data-preventDefault data-action="block" class="link text-danger">Block</a></li>
                   <li class="dropdown-item"><a href="report?id=<?=$client->u_id ?>" class="link text-muted">Report</a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body mt-3 m-auto message-body chat-body">

            <div class="message-container" id="message_field">
                <div class="text-center text-muted">No conversation Yet</div>
            </div>

            <div class="chat-field pt-3">
                <form method="post" data-prevenDefault="true" class="form-container" id="chat_room">
                    <div class="form-group m-0 d-flex">
                        <input type="text" name="receiver" value="<?=$id.crypt($id, 123)?>" hidden>
                        <input type="text" name="sender" value="<?=$_SESSION["clientSession"].crypt($id, 123)?>" hidden>
                        <textarea name="msg" placeholder="What's on your mind" class="form-control col-sm-11 col-md- col-lg-11" id="textarea"></textarea>
                        <button class="btn btn-dark" id="send_msg">
                            <i class="ri-send-plane-2-line"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

</body>
<?php
include_once "includes/footer.php";