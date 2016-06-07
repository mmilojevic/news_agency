<!-- 
                                AVAILABLE HEADER CLASSES

                                Default nav height: 96px
                                .header-md 		= 70px nav height
                                .header-sm 		= 60px nav height

                                .noborder 		= remove bottom border (only with transparent use)
                                .transparent	= transparent header
                                .translucent	= translucent header
                                .sticky			= sticky header
                                .static			= static header
                                .dark			= dark header
                                .bottom			= header on bottom
                                
                                shadow-before-1 = shadow 1 header top
                                shadow-after-1 	= shadow 1 header bottom
                                shadow-before-2 = shadow 2 header top
                                shadow-after-2 	= shadow 2 header bottom
                                shadow-before-3 = shadow 3 header top
                                shadow-after-3 	= shadow 3 header bottom

                                .clearfix		= required for mobile menu, do not remove!

                                Example Usage:  class="clearfix sticky header-sm transparent noborder"
-->
<div id="header" class="sticky 
     clearfix header-md noshadow">

    <!-- TOP NAV -->
    <header id="topNav">
        <div class="container">

            <!-- Mobile Menu Button -->
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Logo -->
            <a class="logo pull-left" href="<?= WWW_PATH ?>">
                <img src="<?= IMG_PATH ?>logo_light_new.png" alt="" />
            </a>

            <!-- 
                    Top Nav 
                    
                    AVAILABLE CLASSES:
                    submenu-dark = dark sub menu
            -->
            <div class="navbar-collapse pull-right nav-main-collapse collapse">
                <nav class="nav-main">

                    <!--
                            NOTE
                            
                            For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
                            Direct Link Example: 

                            <li>
                                    <a href="#">HOME</a>
                            </li>
                    -->
                    <ul id="topMain" class="nav nav-pills nav-main">
                        <?php if (CurrentUser::logged()): ?>
                            <li><a class="account" href="<?= WWW_PATH ?>internal/myPosts">MY POSTS</a></li>
                            <li><a class="login" href="<?= WWW_PATH ?>access/logout" >LOGOUT</a></li>
                        <?php else: ?>
                            <li class="">
                                <a class="login-button" href="<?= WWW_PATH ?>access/login">
                                    LOGIN
                                </a>
                            </li>
                            <li class="">
                                <a class="register-button" href="<?= WWW_PATH ?>access/register">
                                    REGISTER
                                </a>
                            </li>
                        <?php endif; ?>
                        
                    </ul>

                </nav>
            </div>

        </div>
    </header>
    <!-- /Top Nav -->

</div>
