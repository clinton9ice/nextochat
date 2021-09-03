<?php
include_once ".links.php";
$title = "NexChat - Appliaction";
include_once "includes/header.php";
if (!$user->isActive()) header("location: login");
$client = $user->_user($_SESSION["clientSession"]);
?>

<body class="flex chat-page">

    <aside class="left-main-nav" data-template-nav>

        <div class="aside-list flex flex-column flex-item-center">

            <div class="logo mobile-6-off">
            </div>

            <ul class="nav flex flex-column flex-item-center border-bottom-0">

                <li class="nav-items active">
                    <a href="#" data-preventDefault class="link font-18">
                        <i class="ri-home-2-line icon"></i>
                        <p class="title">Chat room</p>
                    </a>
                </li>

                <li class="nav-items ">
                    <a href="#" data-preventDefault class="link font-18">
                        <i class="ri-group-line icon"></i>
                        <p class="title">Group</p>
                    </a>
                </li>

                <li class="nav-items ">
                    <a href="#" data-preventDefault class="link font-18">
                        <i class="ri-user-add-line icon"></i>
                        <p class="title">Find friends</p>
                    </a>
                </li>

                <li class="nav-items ">
                    <a href="#" data-preventDefault class="link font-18">
                        <i class="ri-settings-2-line icon"></i>
                        <p class="title">Settings</p>
                    </a>
                </li>

                <li class="nav-items mobile-4-off">
                    <a href="#" data-preventDefault class="link font-18">
                        <i class="ri-question-line icon"></i>
                        <p class="title">Help</p>
                    </a>
                </li>

                <li class="nav-items mobile-6-off">
                    <a data-action="logout" class="text-danger link font-18">
                        <i class="ri-login-box-line icon"></i>
                        <p class="title">Logout</p>
                    </a>
                </li>
            </ul>

            <div class="toggle-btn mobile-6-off align-items-center justify-content-center" data-wrap="left-settings">
                <a class="ri-arrow-left-s-line"></a>
            </div>

            <div class="wrapper-btn mobile-6-off" data-wrap="right-menu">
                <button type="button" class="btn bg-transparent font-12 text-muted border" style="white-space: normal">
                    <a title="Toggle right menu" class="ri-menu-5-line"></a>
                </button>
            </div>
        </div>

    </aside>

    <div class="container main-box flex flex-item-center">

        <div class="left-menu box menus visible sm-menu-active" data-wrapper="true" id="left-settings">

            <nav class="nav box-item flex flex-item-center">
                <div class="search-container box-item form-group mt-3 mb-4">
                    <div class="flex ml-1 search-block">
                        <input type="text" class="form-control flex font-14 bg-transparent border-0" placeholder="Search for friends">
                        <button class="search btn bg-transparent">
                            <i class="ri-search-2-line"></i>
                        </button>
                    </div>
                </div>

                <ul class="d-flex flex-content-around align-items-center menu-tabs" data-tabs="left-menu-tabs">
                    <li class="list-item tab-item font-16 active"><a href="#" title="Chats" data-preventDefault="true">Chats</a>
                    </li>
                    <li class="list-item tab-item font-14 "><a href="#" title="Friends list" data-preventDefault="true">Friends</a>
                    </li>
                    <li class="list-item tab-item font-14"><a href="#" title="groups" data-preventDefault="true">Groups</a></li>
                </ul>

            </nav>

                 <div class="box-panels bg-white" data-tab-pages>

                <div class="panel" data-page="chats" data-status="active" style="display: block;">
                    <div class="empty-alert d-none">No Chats available</div>

                    <a data-id ="1122334455" class="panel-item d-non flex flex-item-center justify-content-between">

                        <div class="user-details flex flex-item-center">
                            <div class="img-c">
                                <img src="browser/img/medicalert-uk-uXB-7la5vqA-unsplash.jpg" alt="user" loading="lazy" data-list-image>
                            </div>

                            <div class="texts ml-3">
                                <h4 class="name font-16 mb-2" data-label="name">John doe</h4>
                                <p class="chat font-12 mb-0 text-muted">Hello worldm Lorem ipsum dolor sit amet,
                                    consectetur
                                    adipisicing elit. Dolorum, <similique class=""></similique>
                                </p>
                            </div>
                        </div>
                        
                        <span class="time font-11 text-success" data-status="online">online</span>
                    </a>

                    <a data-id="0912332322" class="panel-item d-non flex flex-content-between flex-item-center ">
                        <div class="user-details flex flex-item-center col-sm-8">
                            <div class="img-c">
                            </div>
                            <div class="texts ml-3">
                                <h4 class="name font-16 mb-2" data-label="name">Cynthia doe</h4>
                                <p class="chat font-12 mb-0 text-muted">You: Hi</p>
                            </div>
                        </div>
                        <span class="time  font-11" data-status="offline">3:15pm</span>
                    </a>
                </div>

                <div class="panel" data-page="friends" data-status="not-active">
                    <div class="empty-alert">You have no friends yet</div>

                    <a href="#" class="panel-item row flex-item-center f-l d-none">
                        <div class="user-details flex flex-item-center col-sm-8">
                            <div class="img-c">
                                <img src="browser/img/medicalert-uk-uXB-7la5vqA-unsplash.jpg" alt="user" loading="lazy">
                                <div class="active-state"></div>
                            </div>
                            <div class="texts ml-3">
                                <h4 class="name font-16 mb-1">Chinedu</h4>
                                <p class="time font-12 mb-0 text-muted">12 mins ago</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="panel" data-page="groups" data-status="not-active">
                    <div class="empty-alert">Groups empty</div>
                </div>
            </div>

        </div>

        <div class="message-body box" id="msg-bd">

            <nav class="nav box-item flex flex-item-center flex-content-between p-2">

                <div class="flex flex-item-baseline profile-details">

                <a href="#" data-preventDefault="true" data-remove="parent" data-action="msg-bd" class="ri-arrow-left-line return-arrow-btn"></a>

                    <div class="avatar mr-3 ml-2">
                        <img src="#" alt="User" data-image="visitor">
                        <div class="default_img d-none" data-default_profile></div>
                    </div>

                    <div class="properties">
                        <h3  class="tab-title font-20" data-name="visitor"></h3>
                        <p class="status font-10" data-status="visitor"></p>
                    </div>
                </div>

                <div class="btn-group">
                    <button class=" bg-transparent btn rounded flex-content-center" id="vd-chat">
                        <a class="ri-vidicon-line" data-type="video-chat-icon"></a>
                    </button>

                    <button class=" bg-transparent btn rounded flex-content-center" id="v-chat">
                        <a class="ri-phone-line" data-type="voice-call-icon"></a>
                    </button>

                    <button class=" bg-transparent btn rounded flex-content-center" data-toggle="dropdown">
                        <a class="ri-more-2-line" data-type="more-option"></a>
                    </button>

                    <ul class="dropdown-menu">
                        <li class="dropdown-item">view profile</li>
                        <li class="dropdown-item">mute</li>
                        <li class="dropdown-item text-danger">block</li>
                        <li class="dropdown-item">unfriend</li>
                        <li class="dropdown-item">close right menu</li>
                    </ul>
                </div>

            </nav>

            <div class="chat-body bg-light d-none">
                <!--                The sender is a person from another device-->
                <div class="sender cons">
                    <div class="msg-group  flex-item-end flex">
                        <img src="browser/img/medicalert-uk-uXB-7la5vqA-unsplash.jpg" alt="" class="chat-img mr-2">
                        <div class="message bg-whit">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur,
                            quasi. lorem300
                        </div>
                    </div>
                    <p class="time mb-1 ml-5 pl-3 text-left text-muted">12:00AM</p>
                </div>

                <div class="you cons">
                    <div class="msg-group">
                        <div class="message ">Lorem ipsum dolor sit amet. lorem200</div>
                        <div class="flex flex-item-center pl-1">
                            <p class="mb-0 mr-2 text-muted"><i class="ri-check-double-line"></i></p>
                            <p class="time mb-0 text-left text-muted">2:10PM</p>
                        </div>
                    </div>

                </div>

                <div class="sender cons flex align-items-center">
                    <div>
                        <div class="msg-group  flex-item-end flex">
                            <img src="browser/img/medicalert-uk-uXB-7la5vqA-unsplash.jpg" alt="" class="chat-img mr-2">

                            <div class="message bg-whit">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Pariatur,
                                quasi. lorem300
                            </div>
                        </div>
                        <p class="time mb-1 ml-5 pl-3 text-left text-muted">4:30PM</p>
                    </div>
                </div>

                <div class="you cons">
                    <div class="msg-group">
                        <div class="message ">Lorem ipsum dolor sit amet. Lorem ipsum dolor
                            sit amet, consectetur adipisicing elit. Ad atque doloribus ducimus
                            et fugit, laboriosam necessitatibus officiis temporibus! Accusantium
                            beatae cum doloremque ea esse eum ex
                        </div>
                        <div class="flex flex-item-center pl-1">
                            <p class="mb-0 mr-2 text-muted"><i class="ri-check-double-line"></i></p>
                            <p class="time mb-0 text-left text-muted">2:10PM</p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="chat-form">
                <div class="form-control bg-light">
                    <form data-prevenDefault="true" class="form flex align-items-center" method="post" id="">
                        <textarea name="textarea" id="textarea" class="input-group textarea" placeholder="Type message here"></textarea>
                       
                        <button type="button" class="btn bg-transparent text-muted" id="pop-document">
                            <a class="ri-attachment-line"></a>
                        </button>

                        <button type="button" class="btn btn-primary" id="send-msg">
                            <a class="ri-send-plane-line"></a>
                        </button>
                    </form>
                </div>
            </div>

            <div class="empty-msg-bd text-center flex flex-column flex-content-center " id="_empty_msg_container">
                <h3 class="text-muted font-25">Start a conversation</h3>
            </div>

        </div>

        <div class="right-menu box menus visible" id="right-menu" data-wrapper="true">
            <nav class="nav box-item flex flex-item-center">

                <!--            <div class="collapse-menu-container menu-icon" data-wrapper>-->
                <!--                <i class="ri-arrow-left-s-line"></i>-->
                <!--            </div>-->

            </nav>

            <!--        <div class="box-item profile-container pt-4 flex m-auto flex-column flex-item-center text-center">-->
            <!---->
            <!--            <div class="user-image img-circle mb-2">-->
            <!--                <img src="browser/img/barna-bartis-2x3vfVxwR7o-unsplash.jpg" alt="user">-->
            <!--            </div>-->
            <!---->
            <!--            <div class="info">-->
            <!--                <div class="name mb-1 font-20"></div>-->
            <!--                <p class="state font-10 mb-2 text--->
            <!--">-->
            <!--</p>-->
            <!--                <div class="btn-group">-->
            <!--                    <button class="btn btn-light border btn-sm mr-2">-->
            <!--                        <a href="#" class="link">Edit</a>-->
            <!--                    </button>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

            <div class="box-item pt-4 files-container">

                <h4 class="font-16 mb-4 text-muted pl-2">Files</h4>

                <ul class="media-section">
                    <li class="media-item flex flex-content-between flex-item-center p-2 rounded">
                        <a href="#" class="media-link flex flex-item-center">
                            <div class="icon docs">
                                <i class="ri-file-4-line"></i>
                            </div>

                            <div class="description ml-2">
                                <h4 class="name mb-0 font-14 text-dark">Document</h4>
                                <p class="total mb-0 font-12 text-muted">12 files, 12mb</p>
                            </div>
                        </a>

                        <i class="ri-arrow-right-s-line text-secondary"></i>
                    </li>
                    <li class="media-item flex flex-content-between flex-item-center p-2 rounded">
                        <a href="#" class="media-link flex flex-item-center">
                            <div class="icon ph">
                                <i class="ri-image-2-line"></i>
                            </div>

                            <div class="description ml-2">
                                <h4 class="name mb-0 font-14 text-dark">Photos</h4>
                                <p class="total mb-0 font-12 text-muted">5 files, 200kb</p>
                            </div>
                        </a>

                        <i class="ri-arrow-right-s-line text-secondary"></i>
                    </li>
                    <li class="media-item flex flex-content-between flex-item-center p-2 rounded">
                        <a href="#" class="media-link flex flex-item-center">
                            <div class="icon vid">
                                <i class="ri-movie-line"></i>
                            </div>

                            <div class="description ml-2">
                                <h4 class="name mb-0 font-14 text-dark">Videos</h4>
                                <p class="total mb-0 font-12 text-muted">0</p>
                            </div>
                        </a>

                        <i class="ri-arrow-right-s-line text-secondary"></i>
                    </li>
                    <li class="media-item flex flex-content-between flex-item-center p-2 rounded">
                        <a href="#" class="media-link flex flex-item-center">
                            <div class="icon ot">
                                <i class="ri-folder-2-line"></i>
                            </div>

                            <div class="description ml-2">
                                <h4 class="name mb-0 font-14 text-dark">Others</h4>
                                <p class="total mb-0 font-12 text-muted">0</p>
                            </div>
                        </a>

                        <i class="ri-arrow-right-s-line text-secondary"></i>
                    </li>
                </ul>

            </div>

        </div>

    </div>

    <?php include_once "includes/footer.php"; ?>