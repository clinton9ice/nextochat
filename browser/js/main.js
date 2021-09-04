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
                       </div>`;
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
        $("#loader").remove();
      }, 2000);
    }
  });

  //Clear any error message on input focus
  $("input").on("focus", (e) => {
    $("#notify").addClass("hide");
  });

  function data(e, i = "") {
    return $(`[data-${e}='${i}']`);
  }

  //Default actions
  data("action", "slide").on("click", function () {
    $(this).parent().find("[data-display='active']").toggleClass("active");
  });

  class Request {
    constructor(url, method = "GET", dataType = "Json") {
      this.url = url;
      this.method = method;
      this.dataType = dataType;
    }

    send(data, onSuccess, error) {
      $.ajax({
        url: this.url,
        method: this.method,
        dataType: this.dataType,
        data: data,
        success: onSuccess,
        error: error,
      });
    }
  }

  function empty(param) {
    return param == "" || param == null;
  }

  function validEmail(email) {
    let regex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
  }

  function notify(message, className) {
    let notify = $("body").find("[data-notify]");
    
 
    if (notify.length > 0) {
      notify.html("");

      if (notify.attr("data-notify") === "alert") {
        notify.addClass(className)
        notify.text(message)
      }
    }

  }

  //Prevent Default actions
  $("[data-preventDefault]").on("click", function (e) {
    return $(this).attr("data-preventDefault") != false ?
      e.preventDefault() :
      false;
  });

  //Stop propagation
  $("[data-propagation]").on("click", function (e) {
    return e.stopPropagation();
  });

  $(window).on("click", function () {
    if ($(modal).hasClass("active")) {
      modal.removeClass("active");
    }

    //Dropdown
    let display = $(".dropdown-menu").css("display");
    if (display !== "none") {
      $(".dropdown-menu").animate(400, "slow").css("display", "none");
    }
  });

  //Fold
  $("[data-wrap]").on("click", function () {
    let ev = $(this).attr("data-wrap");

    if (!empty(ev)) {
      //Fetch the target value from the attribute name
      let wrap_container = body.find("#" + ev);

      if (wrap_container.length > 0) {
        wrap_container.hasAttr("data-wrapper") ?
          wrap_container.toggleClass("visible") :
          wrap_container.slideToggle(300);
      }
    }
  });

  //Data dropdown Events
  $("[data-dropdown]").on("click", function () {
    let ev = $(this).parent(".dropdown").find(".dropdown-menu");
    if ($(this).attr("data-dropdown") == "" || $(this).attr("data-dropdown")) {
      ev.fadeToggle();
    } else {
      ev.toggleClass("active");
    }
  });



  function scrollDown() {
    $(msg_container).animate({
        scrollTop: msg_container.prop("scrollHeight"),
      },
      100
    );
  }

  function register_page() {
    let register = document.querySelector("#registerForm");

    $("#signUp").on("click", function () {
      let form = new FormData(register),
        data = {
          register_request: form.get("fullName"),
          email: form.get("email"),
          password: form.get("password"),
        };
      if (
        !empty(data.register_request) &&
        !empty(data.email) &&
        !empty(data.password)
      ) {
        //Check if the provided email has a valid format
        if (validEmail(data.email)) {
          //Clear Error message
          $("#notify").removeClass("active");

          //Create connection from database
          let conn = new Request("module/connection", "POST");
          conn.send(data, function (e) {
            //Check if the request was sent successfully
            if (e.success) {
              notify("Registered", "success");
              setTimeout(() => {
                location.reload();
              }, 2000);
            } else if (e.error) notify(e.error, "danger");
          });
        } else notify("Wrong email format", "alert-danger");
      } else {
        notify("Sorry but all fields are required", "alert-danger");
      }
    });

  }

  function login_page() {
    $("#submitForm").on("click", function () {
      // Create a formData
      let f = new FormData(document.querySelector("#loginForm")),
        data = {
          login_request: f.get("email"),
          password: f.get("password")
        };

      if (!empty(data.login_request) && !empty(data.password)) {
        if (validEmail(data.login_request)) {
          let server = new Request("module/connection", "POST");
          server.send(data, (e) => {
            if (e.success) {
              location.reload(false);
            } else if (e.error) notify(e.error, "alert-danger");
          });
        } else {
          notify("Wrong email address", "alert-danger");
        }
      } else notify("Empty fields", "alert-danger");
    });
  }

  function logout_cmd() {
    $("[data-action='logout']").on("click", function () {
      swal({
        title: "Are you sure you want to log out ?",
        icon: "warning",
        buttons: ["Cancel", "Proceed"],
        dangerMode: true,
      }).then(function (e) {
        if (e) {
          localStorage.removeItem("visitors")
          let request = new Request("module/connection");
          request.send("exit_request", (e) => {
            if (e.success) {
              location.reload();
            }
          });
        }
      });
    });
  }

  function Main() {

    function left_nav() {
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
          });
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
            }, 1000);
          }
        });
      }

      search();
      users();
    }

    function tab_pages(parent, pagesClass, id, customClass = false) {
      let p = body.find(parent),
        p_pages = p.children(pagesClass);

      p_pages.each(function (e) {
        e++;

        if (customClass !== true) {
          //Hide all the pages
          $(this).hide();
          $(this).attr("data-status", "not-active");

          //Display only the page that matches the current id
          if (e === id) {
            if ($(this).attr("data-status") === "not-active") {
              $(this).attr("data-status", "active");
              $(this).fadeIn();
            }
          }
        }

      });
    }

    function tabs(parent_tab, tab_links = ".tab-item", tab_class = "active") {
      let tab_parent = $(parent_tab);
      let tab_item = tab_parent.children(tab_links);

      tab_item.each(function (e) {
        e++;

        $(this).on("click", function () {
          tab_item.removeClass("active");
          $(this).addClass(tab_class);
          tab_pages("[data-tab-pages]", "[data-page]", e);
        });
      });
    }

    tabs("[data-tabs='left-menu-tabs']");

    function chat_nav() {
      //Video call service
      $("#vd-chat").on("click", () => {
        swal({
          title: "Service Not Available",
          text: "Sorry But Video chat is not available for now",
          dangerMode: true,
        });
      });

      //Voice call service
      $("#v-chat").on("click", () => {
        swal({
          title: "Service Not Available",
          text: "Sorry But Voice call is not available for now",
          dangerMode: true,
        });
      });

      //more option
      $("#more-from-header").on("click", function (e) {
        e.preventDefault();
        modal.addClass("active");
      });
    }

    //Check for chat page
    if (body.hasClass("chat-page")) {


      /*========== Users =============*/

      function active_chat() {

        /*Check each of the chats to know which one was clicked,
          then add it to the main message box */

        $("[data-page='chats']").children(".panel-item").each(function () {

          //Fetch active visitor id
          let visitor_id = Number(localStorage.getItem("visitors"));

          //Remove all list active classes
          $(this).removeClass("active");

          //Display only the page that matches the current chat id
          if (visitor_id == Number($(this).attr("data-id")) && Number.isInteger(visitor_id)) {
            $(this).addClass("active");

            let tmp_nav = body.find("[data-template-nav]");

            let msg_body = body.find("#msg-bd")

            //Make the message body available for the selected user
            let empty_msg_container = body.find("#_empty_msg_container");

            //Turn of the default empty container if any user has been selected
            empty_msg_container.addClass("d-none")

            //Get the message header
            let visitor_name = msg_body.find("[data-name='visitor']"),
              status = msg_body.find("[data-status='visitor']"),
              visitor_header_img = msg_body.find("[data-image='visitor']"),
              default_img = body.find("[data-default_profile]")

            //Update visitor name and status
            let $this_name = $(this).find("[data-label='name']").text();
            visitor_name.html($this_name);

            let state = $(this).find("[data-status]").attr("data-status") == "online" ? "active" : "offline";
            status.text(state);

            let chat_list_img = $(this).find("[data-list-image]");

            if (chat_list_img.length > 0) {

              //Hide the default user icon
              default_img.addClass("d-none");

              //Show the user image
              visitor_header_img.removeClass("d-none");

              chat_list_img = chat_list_img.attr("src");

              if (chat_list_img !== "" || chat_list_img !== undefined) {
                visitor_header_img.attr("src", chat_list_img).attr("alt", "User: " + $this_name)
              }
            } else {
              visitor_header_img.addClass("d-none");
              default_img.html($this_name.substr(0, 1).toLocaleUpperCase());
              default_img.removeClass("d-none");
            }



            //Check if there is any selected member on a mobile
            let bw_width = Math.ceil($(document).innerWidth());

            if (bw_width <= 600) {

              //Hide the template nav and show the chat body with the current user
              tmp_nav.addClass("d-none");
              $("#left-settings").hide()
              msg_body.show();

            } else {
              tmp_nav.removeClass("d-none");
            }

          }

        });

      }

      let chat_page = $("[data-page='chats']").on("click", ".panel-item", function () {

        let id = Number($(this).attr("data-id"));
        //Set current user
        Number.isInteger(id) ? localStorage.setItem("visitors", id) : "";

        if (isNaN(id)) {
          swal({
            title: "Something Went Wrong",
            dangerMode: true
          }).then(() => {
            localStorage.removeItem("visitors");
            location.reload(true);
          })
        }

        active_chat();
      });


      //Return chat list
      $("[data-action]").on("click", function () {
        let ev = $(this).attr("data-remove"),
          target = $(this).attr("data-action");

        if (ev === "parent") {
          //Turn off the textarea
          $(this).parents("#" + target).fadeOut();
          localStorage.removeItem("visitors");
          $(".panel-item").removeClass("active")

          //Fade to user chats
          $("#left-settings").fadeIn();

        }

      });

      active_chat();


      /******************** */

      /*Get the id values from both you and visitor to fetch and update 
        conversations automatically
      */

      /*********************/

      //Get the send button and textarea from the chat body
      let textarea = body.find("#textarea"),
        send_button = body.find("#send-msg");

      //Append emojis to the chat input
      $("#textarea").emojioneArea({
        tonesStyle: "radio",
        search: false,
        searchPosition: "bottom",
        attributes: {
          spellcheck: true,
          autocomplete: "on",
          autocorrect: "on",
        },
      });

      send_button.on("click", function () {
        let value = $("#textarea").val();
        if (!empty(value)) {
          //Create connection
          let connection = new Request("module/connection", "POST");
          //Fetch form data
          let data = new FormData(document.querySelector("#msg_input"));
          console.log(data.get("textarea"));
          //Send the form information
          // connection.send(
          //   {
          //     send_message_request: data.get("msg"),
          //     sender: data.get("sender"),
          //     receiver: data.get("receiver"),
          //   },
          //   function (e) {
          //     if (e.success) {
          //       textarea.val("");
          //       scrollDown();
          //     }
          //   }
          // );
        }
      });

    }

    chat_nav();
    left_nav();
  }

  loader(body);
  register_page();
  login_page();
  logout_cmd();
  Main();
});