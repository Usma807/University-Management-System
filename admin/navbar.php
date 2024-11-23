<?php

session_start();

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$user_id = $_SESSION['id'];

if($user_id == ""){
    header("Location: index.php");
}if($user_id != ""){
    $data = $db->retrieve("admins/{$user_id}");
    $data = json_decode($data, 1);
    
    if($data != null){
        $name = $data['name'];
        $surname = $data['surname'];
        $email = $data['email'];
        $password = $data['password'];       
    }
}

?>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <svg class="logo-abbr" width="50" height="50" viewbox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect class="svg-logo-rect" width="50" height="50" rx="6" fill="#EB8153"></rect>
					<path class="svg-logo-path" d="M17.5158 25.8619L19.8088 25.2475L14.8746 11.1774C14.5189 9.84988 15.8701 9.0998 16.8205 9.75055L33.0924 22.2055C33.7045 22.5589 33.8512 24.0717 32.6444 24.3951L30.3514 25.0095L35.2856 39.0796C35.6973 40.1334 34.4431 41.2455 33.3397 40.5064L17.0678 28.0515C16.2057 27.2477 16.5504 26.1205 17.5158 25.8619ZM18.685 14.2955L22.2224 24.6007L29.4633 22.6605L18.685 14.2955ZM31.4751 35.9615L27.8171 25.6886L20.5762 27.6288L31.4751 35.9615Z" fill="white"></path>
				</svg>
                <h4 class="brand-title">E-Pedagog</h4>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="input-group search-area right d-lg-inline-flex d-none">
                                <input type="text" class="form-control" placeholder="Elementlarni qidiring..">
                                <div class="input-group-append">
                                    <span class="input-group-text">
										<a href="javascript:void(0)">
											<i class="flaticon-381-search-2"></i>
										</a>
									</span>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right main-notification">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dz-fullscreen" href="#">
                                    <svg id="icon-full" viewbox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path></svg>
                                    <svg id="icon-minimize" width="20" height="20" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize"><path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3" style="stroke-dasharray: 37, 57; stroke-dashoffset: 0;"></path></svg>
                                </a>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span><?php echo $name." ".$surname; ?></span>
                                        <small><?php echo $email; ?></small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Asosiy Menu</li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-144-layout"></i>
                            <span class="nav-text">Panel</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="home.php">Bosh Sahifa</a></li>
                            <li><a href="profile.php">Profil sozlamalari</a></li>
                            <li><a href="set-values.php">Baholash tizimi</a></li>
                            <li><a href="results.php">O'zlashtirishlar</a></li>
                        </ul>

                    </li>
                    <li class="nav-label">Boshqaruv</li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Adminlar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="admins.php">Adminlar ro'yxati</a></li>
                            <li><a href="add-admin.php">Admin qo'shish</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Foydalanuvchilar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="users.php">Foydalanuvchilar ro'yxati</a></li>
                            <li><a href="add-user.php">Foydalanuvchi qo'shish</a></li>
                            <li><a href="rating-users.php">Foydalanuvchilarni baholash</a></li>
                            <li><a href="rated-results.php">Foydalanuvchilar natijalari</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Darslar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="lessons.php">Darslar ro'yxati</a></li>
                            <li><a href="add-lesson.php">Dars qo'shish</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Rejalar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="plans.php">Rejalar ro'yxati</a></li>
                            <li><a href="add-plan.php">Reja qo'shish</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Elementlar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="elements.php">Elementlar ro'yxati</a></li>
                            <li><a href="add-element.php">Element qo'shish</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Detallar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="details.php">Detallar ro'yxati</a></li>
                            <li><a href="add-detail.php">Detal qo'shish</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Topshiriqlar</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="exercises.php">Topshiriqlar ro'yxati</a></li>
                            <li><a href="add-exercise.php">Topshiriq qo'shish</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Mustaqil & Amaliy</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="mt.php">Mustaqil ta'lim</a></li>
                            <li><a href="rate-mt.php">MT ni baholash</a></li>
                            <li><a href="mt-results.php">MT natijalari</a></li>
                            <li><a href="ai.php">Amaliy ish</a></li>
                            <li><a href="rate-ai.php">AI ni baholash</a></li>
                            <li><a href="ai-results.php">AI natijalari</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-077-menu-1"></i>
                            <span class="nav-text">Yakuniy nazorat</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="yn-quizzes.php">Testlar ro'yxati</a></li>
                            <li><a href="add-yn-quiz.php">Test qo'shish</a></li>
                            <li><a href="yn-results.php">YN natijalari</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <div class="content-body">