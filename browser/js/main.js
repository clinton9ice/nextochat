$(document).ready(function () {
        let body = $("body"),
            listContainer = body.find("#user_list"),
            msg_container = body.find("#message_field");

        //Clear any error message on input focus
        $("input").on("focus", (e) => {
            $("#notify").addClass("hide");
        });

        class Request {
            constructor(url, method = "GET", dataType = "Json") {
                this.url = url;
                this.method = method;
                this.dataType = dataType
            }

            send(data, onSuccess, error) {
                $.ajax({
                    url: this.url,
                    method: this.method,
                    dataType: this.dataType,
                    data: data,
                    success: onSuccess,
                    error: error
                })
            }
        }

        function empty(param) {
            return param == "" || param == null;
        }

        function validEmail(email) {
            let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regex.test(email);
        }

        function notify(message, className) {
            let notify = $("body").find("#notify");
            body.append(`
            <div class="alert p-2 bg-${className} active position-fixed  text-white font-14 notification-status" id="notify">
                ${message}
            </div>
            `);
            if (notify.length > 0) {
                notify.remove();
            }
        }

        $("[data-prevenDefault]").on("submit", function (e) {
            e.preventDefault();
        });

        function scrollDown() {
            $(msg_container).animate({
                scrollTop: msg_container.prop("scrollHeight")
            }, 100);
        }

        function Register() {
            let register = document.querySelector("#registerForm");
            $("#signUp").on("click", function () {
                let form = new FormData(register),
                    data = {
                        register_request: form.get("fullName"),
                        email: form.get("email"),
                        password: form.get("password")
                    }
                if (!empty(data.register_request) && !empty(data.email) && !empty(data.password)) {
                    //Check if the provided email has a valid format
                    if (validEmail(data.email)) {
                        //Clear Error message
                        $("#notify").removeClass("active")

                        //Create connection from database
                        let conn = new Request("module/connection", "POST");
                        conn.send(data, function (e) {
                            //Check if the request was sent successfully
                            if (e.success) {
                                notify("Registered", "success")
                                setTimeout(() => {
                                    location.reload()
                                }, 2000)
                            } else if (e.error) notify(e.error, "danger");
                        });
                    } else notify("Wrong email format", "danger");
                } else {
                    notify("Sorry but all fields are required", "danger")
                }
            });
        }

        function Login() {
            $("#submitForm").on("click", function () {

                // Create a formData
                let f = new FormData(document.querySelector("#loginForm")),
                    data = {login_request: f.get("email"), password: f.get("password")}

                if (!empty(data.login_request) && !empty(data.password)) {
                    if (validEmail(data.login_request)) {
                        let server = new Request("module/connection", "POST");
                        server.send(data, (e) => {
                            if (e.success) location.reload(false);
                            else if (e.error) notify(e.error, "danger");
                        });
                    } else {
                        notify("Wrong email address", "danger")
                    }
                } else notify("Empty fields", "danger");
            });
        }

        function Logout() {
            $("[data-action='logout']").on("click", function () {

                if (confirm("Are you sure you want to logout?")) {
                    let request = new Request("module/connection");
                    request.send({exit_request: ""}, (e) => {
                        if (e.success) location.reload();
                    });
                }
            })
        }

        //Stop realtime chat update on mouseenter
        msg_container.on("mouseenter", function () {
            msg_container.addClass("focused")
        })
        //Resume realtime chat update on mouseleave
        msg_container.on("mouseleave", function () {
            setTimeout(() => {
                msg_container.removeClass("focused");
            }, 4000);
        })


        function Chat_arena() {

            //History back
            $("[data-prev]").on("click", function () {
                window.history.back();
            });

            //Open the more option modal
            $("[data-target='dropdown']").on("click", function () {
                $(this).siblings(".dropdown-menu").fadeToggle(200);
            })

            //Get chats
            if (body.hasClass("chat-board")) {
                //message outbox
                let data = new FormData(document.querySelector("#chat_room")),
                    info = {fetch_sender_messages: data.get("sender"), receiver: data.get("receiver")}
                if (!empty(info.fetch_sender_messages) && !empty(info.receiver)) {
                    setInterval(function () {
                        //create connection for fetching dynamic messages
                        let connection = new Request("module/connection", "POST", "html");
                        connection.send(info, function (e) {
                            if (!empty(e)) {
                                msg_container.html(e);
                            }
                        });
                        if (!msg_container.hasClass("focused")) {
                            scrollDown();
                        }
                    }, 500)
                }

            }

            //Send message
            let textarea = body.find("#textarea"),
                send_button = body.find("#send_msg");

            send_button.on("click", function () {
                let value = textarea.val().trim();
                if (!empty(value)) {
                    //Create connection
                    let connection = new Request("module/connection", "POST");
                    //Fetch form data
                    let data = new FormData(document.querySelector("#chat_room"));
                    //Send the form information
                    connection.send(
                        {
                            send_message_request: data.get("msg"),
                            sender: data.get("sender"),
                            receiver: data.get("receiver")
                        },
                        function (e) {
                            if (e.success) {
                                textarea.val("");
                                scrollDown();
                            }
                        })
                }
            });
        }


        function users() {
            let request = new Request("module/connection", "GET", "html");
            request.send("users", (e) => {
                if (!empty(e) && body.hasClass("friendList")) {
                    //Get users dynamically
                    setInterval(function () {
                        let server = new Request("module/connection", "GET", "html");
                        server.send("users", function (e) {
                            if (!empty(e) && !$("#search_users").hasClass("typing")) {
                                listContainer.html(e);
                            }
                        });
                    }, 1000)
                }
            });

        }

        function search() {
            let search_input = body.find("#search_users");

            search_input.on("keyup", function () {
                let value = $(this).val().trim();
                let request = new Request("module/connection", "post", "html");
                request.send("search_request=" + value, function (e) {
                    search_input.removeClass("typing");
                    if (!empty(e)) {
                        search_input.addClass("typing");
                        listContainer.html(e);
                    }
                })
            })
        }

        Login();
        Register();
        Logout();
        Chat_arena();
        search();
        users();
    }
)
;