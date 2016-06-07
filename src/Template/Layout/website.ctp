<!DOCTYPE html>
<!--
Name: Mazba's Cake
Version: 1.6
Author: Mazba Kamal
Website: http://www.soft-bd.com/
Contact: mazba.cse@gmail.com
Follow: www.twitter.com/mazba_kamal
Like: www.facebook.com/mazbakamal
License: You must have a valid license purchased only from softbd
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>
        MISC CASE :
        <?= $this->fetch('title'); ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="<?= $this->request->webroot; ?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="<?= $this->request->webroot; ?>assets/global/css/components-rounded.css" id="style_components"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>assets/admin/layout4/css/themes/default.css" rel="stylesheet"
          type="text/css" id="style_color"/>
    <link href="<?= $this->request->webroot; ?>assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $this->request->webroot; ?>css/common.css" rel="stylesheet" type="text/css"/>

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>

<!--    jquery -->

    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo ppage-sidebar-closed-hide-logo website">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?php echo $this->request->webroot; ?>">
                    <h3 style="color: white; font-weight: bold"><?= __('MISC Case Application Panel') ?></h3>
                </a>

    <!--            <div class="menu-toggler sidebar-toggler"></div>-->
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">

                <!-- BEGIN TOP NAVIGATION MENU -->
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix"></div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <?= $this->Flash->render() ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="loader">
        <img src="<?php echo $this->request->webroot; ?>assets/global/img/loading-spinner-default.gif">
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->

    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery-migrate.min.js"
            type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"
            type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"
            type="text/javascript"></script>
    <script
        src="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery.blockui.min.js"
            type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/uniform/jquery.uniform.js"
            type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
            type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= $this->request->webroot; ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="<?= $this->request->webroot; ?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
    <script src="<?php echo $this->request->webroot; ?>assets/global/plugins/select2/select2.min.js" type="text/javascript"></script>
    <link href="<?php echo $this->request->webroot; ?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>



    <script src="<?= $this->request->webroot; ?>js/sys_mcake.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
    });
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>