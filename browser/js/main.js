$(document).ready(function () {

        let body = $("body"),
            msg_container = body.find("#message_field"),
            modal = body.find("#nexto-overlay");

        function loader(parent) {
            let html = `<div class="loader-blocks" id="loader">
                       <div class="loader">
                              <svg class="circle-outer" viewBox="0 0 86 86">
                                <circle class="back" cx="43" cy="43" r="40"></circle>
                                <circle class="front" cx="43" cy="43" r="40"></circle>
                                <circle class="new" cx="43" cy="43" r="40"></circle>
                              </svg>
                              <svg class="circle-middle" viewBox="0 0 60 60">
                                <circle class="back" cx="30" cy="30" r="27"></circle>
                                <circle class="front" cx="30" cy="30" r="27"></circle>
                              </svg>
                              <svg class="circle-inner" viewBox="0 0 34 34">
                                <circle class="back" cx="17" cy="17" r="14"></circle>
                                <circle class="front" cx="17" cy="17" r="14"></circle>
                              </svg>
                              <div class="text" data-text="loading..."></div>               
                        </div>
                       </div>`
            parent.append(html);
        }

        //Has Attribute handler
        $.fn.hasAttr = function (name) {
            return this.attr(name) !== undefined;
        };

        //Check if the window has completely loaded
        $(window).on("load", function () {
            //remove the loader if it exists
            if (body.find("#loader").length > 0) {
                setTimeout(() => {
                    $("#loader").remove()
                }, 2000)
            }
        })

        //Clear any error message on input focus
        $("input").on("focus", (e) => {
            $("#notify").addClass("hide");
        });

        function data(e, i = "") {
            return $(`[data-${e}='${i}']`);
        }

        //Default actions
        data("action", "slide").on("click", function () {
            $(this).parent().find("[data-display='active']").toggleClass("active")
        })

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

        //Prevent Default actions
        $("[data-prevenDefault]").on("click", function (e) {
            e.preventDefault();
        });

        //Stop propagation
        $("[data-propagation]").on("click", function (e) {
            e.stopPropagation();
        })

        $(window).on("click", function () {
            if ($(modal).hasClass("active")) {
                modal.removeClass("active");
            }

            //Dropdown
            let display = $(".dropdown-menu").css("display");
            if (display !== "none") {
                $(".dropdown-menu").animate(400, "slow").css("display", "none")
            }
        });

        //Fold
        $("[data-wrap]").on("click", function () {

            let ev = $(this).attr("data-wrap");

            if (!empty(ev)) {
                // ev.toggleClass("hide")
                //Fetch the target container from the attribute name
                let wrap_container = body.find("#" + ev)

                if (wrap_container.length > 0) {
                    wrap_container.hasAttr("data-wrapper")?
                        wrap_container.toggleClass("visible")
                        : wrap_container.slideToggle(300);
                }
            }
        });

        //Data dropdown Events
        $("[data-dropdown]").on("click", function () {
            let ev = $(this).parent(".dropdown").find(".dropdown-menu")
            if ($(this).attr("data-dropdown") == "" || $(this).attr("data-dropdown")) {
                ev.fadeToggle();
            } else {
                ev.toggleClass("active")
            }
        })


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
                        loader(body);
                        server.send(data, (e) => {
                            if (e.success){
                                location.reload(false);
                            }
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
                swal({
                    title: "Are you sure to sign out",
                    icon: "warning",
                    buttons: ["Cancel", "I'm sure"],
                    dangerMode: true,
                }).then(function (e) {
                    if (e) {
                        let request = new Request("module/connection");
                        request.send({exit_request: ""}, (e) => {
                            if (e.success) {
                                swal({
                                    text: "You have successfully logged out...",
                                    icon: "success"
                                }).then(() => {
                                    location.reload();
                                })

                            }

                        });
                    }
                })

            })
        }

        function Chat_arena() {

            function header() {

                //Video call service
                $("#vd-chat").on("click", () => {
                    swal({
                        title: "Service Not Available",
                        text: "Sorry But Video chat is not available for now",
                        dangerMode: true
                    });
                });

                //Voice call service
                $("#v-chat").on("click", () => {
                    swal({
                        title: "Service Not Available",
                        text: "Sorry But Voice call is not available for now",
                        dangerMode: true
                    });
                })

                //more option
                $("#more-from-header").on("click", function (e) {
                    e.preventDefault();
                    modal.addClass("active")
                });


            }

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

            //Send message
            let textarea = body.find("#textarea"),
                send_button = body.find("#send-msg");

            //Append emojis
            $("#textarea").emojioneArea({
                tonesStyle: "radio",
                search: false,
                searchPosition: "bottom",
                attributes: {
                    spellcheck: true,
                    autocomplete: "on",
                    autocorrect: "on",
                }
            });

            send_button.on("click", function () {
                let value = $("#textarea").val();
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

            header()
        }

        function leftSettings() {

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

            search();
            users();
        }


        loader(body);
        Register();
        Login();
        leftSettings()
        Chat_arena();
        Logout();
    }
);