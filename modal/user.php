<?php
include_once root . "/config/Database.php";
include_once root . "/Classes/Session.inc";
include_once root . "/Classes/Cookies.inc";
include_once root . "/Classes/Validation.inc";

use application\validation\Validation;

class user extends Database
{

    public function emailExists($param): bool
    {
        $database = $this->getConnect()->query("SELECT email FROM users");
        if ($database->num_rows > 0) {
            while ($row = $database->fetch_object()) {
                if ($row->email === $param) {
                    return true;
                }
            }
        }
        return false;
    }

    public function Validate(): Validation
    {
        return new Validation();
    }

    public function getUsers()
    {
        $u_id = $this->Session()->getSession("clientSession");
        $result = $this->getConnect()->query("SELECT id,u_id,name,email,profile_image,status FROM users WHERE NOT u_id =" . $u_id) or die("Something went wrong " . $this->getConnect()->error);
        if ($result->num_rows > 1) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return "";
    }

    public function _user($id)
    {
        $stmt = $this->getConnect()->prepare("SELECT * FROM users WHERE u_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    public function register_user($data): bool
    {
        $query = $this->getConnect()->prepare('INSERT INTO users(u_id,name,email,password,profile_image,created) VALUES (?,?,?,?,?,?)');
        $u_id = substr(rand(7, time()), 0, 7);
        $time = time();
        $pass = password_hash($data["password"], PASSWORD_DEFAULT);
        $query->bind_param("isssss", $u_id, $data["name"], $data["email"], $pass, $data["image"], $time);
        return $query->execute();
    }

    public function login($data): array
    {
        $res = $this->getConnect()->prepare("SELECT id, u_id, name, email,password FROM users WHERE email = ?");
        $res->bind_param("s", $data["email"]);
        $res->execute();
        $res->bind_result($id, $unique_id, $Name, $Email, $pass);
        if ($res->fetch()) {
            if (password_verify($data["password"], $pass)) {
                $res->close();
                $this->Session()->setSession("clientSession", $unique_id);
                $this->Cookie()->SetCookie("clientCookie", password_hash($unique_id, PASSWORD_BCRYPT));
                $this->onlineStatus("active");
                return array("success" => 1);
            }
            return array("error" => "wrong password");
        }
        return array("error" => "Wrong password or email");
    }

    public function logout(): bool
    {
        $state = false;
        if (!$state) {
            $this->Cookie()->RemoveCookie("clientCookie");
            $this->Session()->SessionExist("clientSession");
            $state = true;
            $this->onlineStatus("offline");
        }
        return $state;
    }

    public function isActive(): bool
    {
        return $this->Cookie()->CookieExist("clientCookie") && $this->Session()->SessionExist("clientSession");
    }

    public function onlineStatus($state): bool
    {
        $id = $this->Session()->getSession("clientSession");
        $stmt = $this->getConnect()->prepare("UPDATE users SET status=? WHERE u_id = ?");
        $stmt->bind_param("si", $state, $id);
        return $stmt->execute();
    }

    public function users_html($sql)
    {
        foreach ($sql as $rows) {
            //get last message
            $msg = array();
            foreach ($this->lastMessage($rows["u_id"]) as $last_msg) {
                $msg = array_merge($msg,$last_msg);
            }
            $text = "No conversation yet";
            if (!empty($msg)){
                //Show if the last message came from you
                $text = ($msg["receiver_id"] != $_SESSION["clientSession"])? "You: ".$msg["message"] : $msg["message"];
            }

            //Check if there was an image
            $img = !empty($rows["profile_image"]) ? '<img src="' . $rows["profile_image"] . '" alt="name" class="avatar">' :
                '<div class="default_pics d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                  ' . $rows["email"][0] . '
               </div>';

            //Check the status of the user
            $userStatus = $rows["status"] == "active" ? "active" : "offline";

            $response = '<li class="list-group-item">
                                <a href="chat-arena?user=' . $rows["u_id"].crypt($rows["u_id"], 1235). '" class="d-flex align-items-start">
                                <div class="image rounded-circle">
                                  ' . $img . '
                                </div>
                               
                                <div class="message col-sm-7">
                                    <h4 class="name font-16 text-dark">
                                    ' . ucfirst($rows["name"]) . '
                                     </h4>
                                    <p class="message font-10 text-muted">
                                         '.$text.'
                                    </p>
                                </div>
                                
                                <div class="status ' . $userStatus . '"></div>
                                </a>
                            </li>';

            echo $response;
        }
    }

    public function search($data)
    {
        $d = "%" . $data . "%";
        $id = $this->Session()->getSession("clientSession");
        $stmt = $this->getConnect()->prepare("SELECT u_id, name, email, profile_image, status FROM users WHERE name  LIKE  ? AND NOT u_id = ?");
        $stmt->bind_param("si", $d, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sendMessage($data): bool
    {
        $stmt = $this->getConnect()->prepare("INSERT INTO messages(sender_id, receiver_id, message) VALUES(?,?,?)");
        $stmt->bind_param("sss", $data["sender"], $data["receiver"], $data["messages"]);
        return $stmt->execute();
    }

    public function fetchMessages($data){
        $stmt = "SELECT * FROM messages WHERE  sender_id = ? and receiver_id = ? or receiver_id =? and sender_id = ? ORDER BY msg_id ";
        $query = $this->getConnect()->prepare($stmt);
        $query->bind_param("ssss", $data["sender"], $data["receiver"], $data["sender"], $data["receiver"]);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function lastMessage($id){
        $stmt = "SELECT * FROM messages WHERE sender_id = ? AND receiver_id = ? OR sender_id =? AND receiver_id = ? ORDER BY msg_id DESC LIMIT 1";
        $query = $this->getConnect()->prepare($stmt);
        $sender = $_SESSION["clientSession"];
        $query->bind_param("ssss", $sender, $id, $id, $sender);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}