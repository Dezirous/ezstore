<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url();?>" />
	<title><?php echo 'EZStore | '.ucwords($this->uri->segment(1)); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png">
	<link rel="stylesheet" type="text/css" href="<?php echo 'dist/bootswatch/' . (empty($this->config->item('theme')) ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css' ?>"/>

	<?php if ($this->input->cookie('debug') == 'true' || $this->input->get('debug') == 'true') : ?>
		<!-- bower:css -->
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css" />
		<link rel="stylesheet" href="bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" />
		<link rel="stylesheet" href="bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.css" />
		<link rel="stylesheet" href="bower_components/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-select/dist/css/bootstrap-select.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/dist/bootstrap-table.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css" />
		<link rel="stylesheet" href="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css" />
		<!-- endbower -->
		<!-- start css template tags -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.autocomplete.css"/>
		<link rel="stylesheet" type="text/css" href="css/invoice.css"/>
		<link rel="stylesheet" type="text/css" href="css/ospos_print.css"/>
		<link rel="stylesheet" type="text/css" href="css/ospos.css"/>
		<link rel="stylesheet" type="text/css" href="css/popupbox.css"/>
		<link rel="stylesheet" type="text/css" href="css/receipt.css"/>
		<link rel="stylesheet" type="text/css" href="css/register.css"/>
		<link rel="stylesheet" type="text/css" href="css/reports.css"/>
		<!-- end css template tags -->
		<!-- bower:js -->
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/jquery-form/src/jquery.form.js"></script>
		<script src="bower_components/jquery-validate/dist/jquery.validate.js"></script>
		<script src="bower_components/jquery-ui/jquery-ui.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
		<script src="bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
		<script src="bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
		<script src="bower_components/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		<script src="bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js"></script>
		<script src="bower_components/moment/moment.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="bower_components/es6-promise/es6-promise.js"></script>
		<script src="bower_components/file-saver/dist/FileSaver.min.js"></script>
		<script src="bower_components/html2canvas/build/html2canvas.js"></script>
		<script src="bower_components/jspdf/dist/jspdf.debug.js"></script>
		<script src="bower_components/jspdf-autotable/dist/jspdf.plugin.autotable.js"></script>
		<script src="bower_components/tableExport.jquery.plugin/tableExport.js"></script>
		<script src="bower_components/chartist/dist/chartist.min.js"></script>
		<script src="bower_components/chartist-plugin-pointlabels/dist/chartist-plugin-pointlabels.min.js"></script>
		<script src="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
		<script src="bower_components/chartist-plugin-barlabels/dist/chartist-plugin-barlabels.min.js"></script>
		<script src="bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
		<script src="bower_components/js-cookie/src/js.cookie.js"></script>
		<script src="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
		<script src="bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
		<!-- endbower -->
		<!-- start js template tags -->
		<script type="text/javascript" src="js/clipboard.min.js"></script>
		<script type="text/javascript" src="js/imgpreview.full.jquery.js"></script>
		<script type="text/javascript" src="js/manage_tables.js"></script>
		<script type="text/javascript" src="js/nominatim.autocomplete.js"></script>
		<!-- end js template tags -->
	<?php else : ?>
		<!--[if lte IE 8]>
		<link rel="stylesheet" media="print" href="dist/print.css" type="text/css" />
		<![endif]-->
		<!-- start mincss template tags -->
		<link rel="stylesheet" type="text/css" href="dist/jquery-ui/jquery-ui.min.css"/>
		<link rel="stylesheet" type="text/css" href="dist/opensourcepos.min.css?rel=88e63d8098"/>
		<!-- end mincss template tags -->

		<!-- Tweaks to the UI for a particular theme should drop here  -->
	<?php if ($this->config->item('theme') != 'flatly' && file_exists($_SERVER['DOCUMENT_ROOT'] . '/public/css/' . $this->config->item('theme') . '.css')) { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo 'css/' . $this->config->item('theme') . '.css' ?>"/>
	<?php } ?>

		<!-- start minjs template tags -->
		<script type="text/javascript" src="dist/opensourcepos.min.js?rel=5dfe5e6402"></script>
		<!-- end minjs template tags -->
	<?php endif; ?>

	<?php $this->load->view('partial/header_js'); ?>
	<?php $this->load->view('partial/lang_lines'); ?>

	<style type="text/css">
    	
        a:hover{
            text-decoration: none;
            
        }
		main {
            
            <?php switch ($this->uri->segment(2)) {
            case "receipt":
            case "complete":
            break; ?>
                padding: 5px;
            <?php default: ?>
                height:100%;
                width: 100%;
                margin: 0px;
                padding: 0px;
                display: grid;
                grid-template-columns: 80px auto 170px;
                grid-template-rows: 45px auto 50px;
            <?php  } ?>
        }
        .sidebar {
            
            grid-row: 1 / span 3;
            padding: 0px;
            margin: 0px;
            height: 100vh;
            text-align: center;
            overflow-x: hidden;
        }
        .sidebar-icon {
            width: 35px;
            height: 35px;
            margin: 10px 0px 0px 0px;
        }
        .sidebar-link-text{
            display: inline;
            padding: 0px;
            margin: 0px 0px 50px 0px;
            font-size: 1em;
            color: #ffffff;
        }
        .navbar > a{
            color: #ffffff;
        }
        .sidebar > a{
            color: #ffffff;
        }
        .page {            
            grid-column: 2 / span 2;
        	height: calc(100vh - 100px);
        	padding: 10px;
            margin-top: 15px;
        	overflow-x: hidden;
        }
        .footer {
        	grid-column: 2 / span 2;
            padding: 10px;
        }
        .company {
            font-size: 24px;
            font-weight: bold;
            text-align: left;
            border: 0;
            padding: 5px 0px 0px 5px;
            color: #fff;
        }
        .user {
            font-weight: bold;
            text-align: right;
            border: 0;
            padding: 5px 5px 0px 0px;
            color: #fff;
        }
        ::-webkit-scrollbar {
            width: 7px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888; 
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }
        
        @media (max-width: 700px) {
            
            .sidebar-link-text{
                font-size: 10px;
            }
            .sidebar-icon{
                width: 25px;
                height: 25px;
            }
        }
        
        .btn, .panel {
            border-radius: 4px;
        }
        
	</style>
</head>

<body>
    <main>
        <?php switch ($this->uri->segment(2)) {
            case "receipt":
            case "complete":
                break;
            default: ?>
            <div class="sidebar print_hide navbar navbar-inverse">
                <div class="sidebar-link navbar">
                    <a class="sidebar-item" href="<?php echo base_url(); ?>" title="EZStore">
                        <img class="sidebar-icon" src="<?php echo base_url() . 'images/logo-light.png'; ?>" border="0" alt="Module Icon"/>
                    </a>
                </div>
                <?php foreach($allowed_modules as $module): ?>
                    <div class="sidebar-link">
                        <a class="sidebar-item" href="<?php echo site_url("$module->module_id"); ?>" title="<?php echo $this->lang->line("module_" . $module->module_id); ?>">
                            <img class="sidebar-icon" src="<?php echo base_url() . 'images/menubar/' . $module->module_id . '.png'; ?>" border="0" alt="Module Icon"/>
                            <br><span class="sidebar-link-text"><?php echo $this->lang->line("module_" . $module->module_id) ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
                <div class="sidebar-link"><br></div>
            </div>
            
            <div class="navbar print_hide navbar-inverse company">
                <a href="javascript:void(0);"><?php echo $this->config->item('company'); ?></a>
            </div>
            
            <div class="navbar print_hide navbar-inverse user">
                <?php echo anchor('home/change_password/'.$user_info->person_id, $user_info->first_name . ' - ' . $user_info->role, array('class' => 'modal-dlg', 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('employees_change_password'))); ?><br>
                <a href="javascript:void(0);" id="logout"><?php echo $this->lang->line('login_logout');?></a>
                <?php echo ($this->input->get('debug') == 'true' ? $this->session->userdata('session_sha1') : ''); ?>
            </div>

            <div class="page">

        <?php } ?>