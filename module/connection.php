<?php
include_once "../config/config.php";
include_once "../modal/user.php";

//Default encrypted id length is 7 digits

use application\validation\Validation;

$users = new user();

if (isset($_POST["register_request"])) {
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        //Filter the user provided information
        $info = ["name" => Validation::sanitize(strtolower($_POST["register_request"])),
            "email" => Validation::sanitize(strtolower($_POST["email"])), "password" => Validation::sanitize($_POST["password"])];
        //Check if new email has been registered
        if (!$users->emailExists($info["email"])) {
            //Register user
            echo $users->register_user($info) ? json_encode(["success" => "Registration successful"]) : json_encode(["error" => "Something went wrong"]);
        } else echo json_encode(["error" => "This account already exists"]);
    } else echo json_encode(["error" => "Wrong email format"]);
}

if (isset($_POST["login_request"])) {
    if (filter_var($_POST["login_request"], FILTER_VALIDATE_EMAIL)) {
        //Sanitize the inputs
        $data = ["email" => $users->Validate()::sanitize(strtolower($_POST["login_request"])), "password" => $users->Validate()::sanitize($_POST["password"])];
        if ($users->emailExists($data["email"])) {
            if (!$users->isActive()) {
                echo json_encode($users->login($data));
            } else {
                echo json_encode(["error" => "You are logged in already"]);
            }
        } else echo json_encode(["error" => "<strong>" . $data["email"] . " </strong>does not exist"]);
    } else echo json_encode(["error" => "Wrong email format"]);
}

if (isset($_GET["exit_request"]) && $users->isActive()) {
    echo $users->logout() ? json_encode(["success" => "exit"]) : "";
}

if (isset($_REQUEST["users"])) {
    if ($users->Session()->SessionExist("clientSession") && $users->Cookie()->CookieExist("clientCookie")) {
        if (!empty($users->getUsers()) && is_array($users->getUsers())) {
            $users->users_html($users->getUsers());
        } else {
            echo "<li class='list-group-item'>No user found</li>";
        }
    }
}

if (isset($_POST["search_request"])) {
    $search_term = $users->Validate()::sanitize($_POST["search_request"]);
    if (!empty($search_term)) {
        if ($users->Session()->SessionExist("clientSession")) {
            $response = "";
            if (is_array($users->search($search_term)) and !empty($users->search($search_term))) {
                $users->users_html($users->search($search_term));
            } else {
                $response .= "<div class='text-muted text-center'> No User Found For  \"" . $search_term . "\" </div>";
            }
            echo $response;
        }
    }
}

if (isset($_POST["send_message_request"])) {
    //Check if the user is logged in before proceeding
    if ($users->Session()->SessionExist("clientSession")) {
        //Check the inputs provided by the user and filter them
        if (!empty($_POST["sender"]) && !empty($_POST["receiver"]) && $users->Validate()::number($_POST["receiver"]) && $users->Validate()::number($_POST["sender"]) ){
            //filter and group data
            $data = ["sender"=>$users->Validate()::sanitize(substr($_POST["sender"], 0, 7)),
                "receiver"=>$users->Validate()::sanitize(substr($_POST["receiver"],0,7)),
                "messages"=>$users->Validate()::sanitize($_POST["send_message_request"])];

            if (!empty($_POST["send_message_request"])){
                if ($users->sendMessage($data)) echo json_encode(["success"=>true]);
            }
        }

    }
}

if (isset($_POST["fetch_sender_messages"])){
    if (!empty($_POST["fetch_sender_messages"]) and !empty($_POST["receiver"])){
        $list = ["receiver"=> $users->Validate()::sanitize(substr($_POST["receiver"],0,7)), "sender"=>$users->Validate()::sanitize(substr($_POST["fetch_sender_messages"],0,7))];
        $messages = $users->fetchMessages($list);
        $profile_img = $users->_user($list["receiver"])->profile_image;

        //Check to know if the receiver has an image
        $receiver_image = $img = !empty($profile_img) ? '<img src="' . $profile_img . '" alt="name" class="avatar">' :
            '<div class="default_pics d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                  ' .$users->_user($list["receiver"])->email[0] . '
               </div>';

        if (is_array($messages)){

            foreach ($messages as $dm){
                $group = "";
                if ($dm["sender_id"] == $_SESSION["clientSession"]){
                    $group .=' <div class="sender item">
                            <p class="description">
                             '.$dm["message"].'
                            </p>
                </div>';
                }
                else{
                    $group .= ' <div class="receiver d-flex align-items-end item">
                    <div class="image">
                        '.$receiver_image.'
                    </div>

                    <p class="description">
                       '.$dm["message"].'
                    </p>
                </div>';
                }
                echo $group;
            }

        }else{
            echo "No messages yet ";
        }

    }
    else{
        echo "You have no chats yet";
    }

}
