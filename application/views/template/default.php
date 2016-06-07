
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
                <link rel="shortcut icon" href="<?= IMG_PATH ?>new.ico" />
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<meta name="keywords" content="tenderi, srbija, nabavke" />
		<meta name="description" content="Tenderi iz Srbije i regiona." />
		<meta name="Author" content="Ivan Antonijevic" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- CORE CSS -->
		<link href="<?= PLUGIN_PATH ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="<?= CSS_PATH ?>essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?= CSS_PATH ?>layout.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="<?= CSS_PATH ?>header-1.css" rel="stylesheet" type="text/css" />
                <link href="<?= PLUGIN_PATH ?>toastr/toastr.css" rel="stylesheet" type="text/css" />
		<link href="<?= CSS_PATH ?>darkblue.css" rel="stylesheet" type="text/css" id="color_scheme" />
                
                <?php 
                //custom css-es
                if (isset($csses)):
                foreach($csses as $css): 
                ?>
                <link href="<?php echo $css; ?>" rel="stylesheet">
                <?php 
                endforeach;
                endif; 
                ?>

                <?php $this->load->view('common/jsConstants');?>
        </head>

	<!--
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/boxed_background/1.jpg"
	-->
	<body class="smoothscroll enable-animation">

		<!-- wrapper -->
		<div id="wrapper">
                        <!-- HEADER -->
                        <?php $this->load->view('common/default/header') ?>
                        <!-- HEADER-->
                        
                        <!-- 
                        PAGE HEADER 

                        CLASSES:
                                .page-header-xs	= 20px margins
                                .page-header-md	= 50px margins
                                .page-header-lg	= 80px margins
                                .page-header-xlg= 130px margins
                                .dark			= dark page header

                                .shadow-before-1 	= shadow 1 header top
                                .shadow-after-1 	= shadow 1 header bottom
                                .shadow-before-2 	= shadow 2 header top
                                .shadow-after-2 	= shadow 2 header bottom
                                .shadow-before-3 	= shadow 3 header top
                                .shadow-after-3 	= shadow 3 header bottom
                        -->
                        <section class="page-header dark page-header-xs">
                                <div class="container">

                                        <h1><?= $page_title?></h1>

                                        <!-- breadcrumbs 
                                        <ol class="breadcrumb">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Pages</a></li>
                                                <li class="active">Search Result</li>
                                        </ol> 
                                        /breadcrumbs -->

                                </div>
                        </section>
                        <!-- /PAGE HEADER -->

                        <?php foreach ($pages as $page): ?>
                            <?php $this->load->view($page) ?>
                        <?php endforeach; ?>
			<!-- FOOTER -->
                        <?php $this->load->view('common/default/footer') ?>
                        <!-- /FOOTER -->

		</div>
		<!-- /wrapper -->


		<!-- SCROLL TO TOP -->
		<a href="#" id="toTop"></a>


		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript" src="<?= PLUGIN_PATH ?>jquery/jquery-2.1.4.min.js"></script>

		<!-- SCRIPTS -->
                <script type="text/javascript" src="<?= PLUGIN_PATH ?>form.validate/jquery.validation.min.js"></script>
                <script type="text/javascript" src="<?= PLUGIN_PATH ?>toastr/toastr.js"></script>
                <script type="text/javascript" src="<?= PLUGIN_PATH ?>handlebars/handlebars-v3.0.3.js"></script>
                <script type="text/javascript" src="<?= PLUGIN_PATH ?>jquery-block-ui/jqueryblockui.min.js"></script>
                <script type="text/javascript" src="<?= JS_PATH ?>addon.js"></script>
                <script type="text/javascript" src="<?= JS_PATH ?>functions.js"></script>
                <script type="text/javascript" src="<?= PLUGIN_PATH ?>custom.fle_upload.js"></script>
                <?php 
                if (isset($jscripts)):
                foreach($jscripts as $js): ?>
                <script type="text/javascript" src="<?php echo $js; ?>"></script>
                <?php 
                endforeach; 
                endif; ?>


                <?php if (isset($initializes)): ?>
                <script type="text/javascript">
                    $(function(){
                <?php foreach($initializes as $init => $init_data): 
                        $init_string = implode(',', $init_data);
                        ?>
                        <?= $init?>.initialize(<?= $init_string ?>);
                <?php endforeach; ?>
                    });
                </script>
                <?php endif; ?>
		
	</body>
</html>
