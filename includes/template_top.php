<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $oscTemplate->buildBlocks();

  if (!$oscTemplate->hasBlocks('boxes_column_left')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }

  if (!$oscTemplate->hasBlocks('boxes_column_right')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo tep_output_string_protected($oscTemplate->getTitle()); ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="ext/jquery/ui/redmond/jquery-ui-1.8.6-osc.css" />
<link rel="icon" type="image/png" href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG.DIR_WS_ICONS; ?>favicon.ico" />
<script type="text/javascript" src="ext/jquery/jquery-1.4.3.min.js"></script>	<!--  -->
<script type="text/javascript" src="ext/jquery/ui/jquery-ui-1.8.6.min.js"></script>

<?php
  if (tep_not_null(JQUERY_DATEPICKER_I18N_CODE)) {
?>
<script type="text/javascript" src="ext/jquery/ui/i18n/jquery.ui.datepicker-<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>.js"></script>
<script type="text/javascript">
$.datepicker.setDefaults($.datepicker.regional['<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>']);
</script>
<?php
  }
?>
<script type="text/javascript" src="ext/jquery/bxGallery/jquery.bxGallery.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="ext/jquery/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="ext/jquery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
 	<script type="text/javascript" src="ext/js/xeasyTooltipIMG.js"></script>
<script type="text/javascript" src="ext/jquery/jquery.equalheights.js"></script>
<script type="text/javascript" src="ext/jquery/jquery.nivo.slider.js"></script>
	<script type="text/javascript" src="ext/jquery/jqtransformplugin/jquery.jqtransform.js" ></script>
	<script type="text/javascript" src="ext/jquery/jquery.stringball.js"></script>

<link rel="stylesheet" type="text/css" href="ext/960gs/<?php echo ((stripos(HTML_PARAMS, 'dir="rtl"') !== false) ? 'rtl_' : ''); ?>960_24_col.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/constants.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_boxes.css"/>
<link rel="stylesheet" type="text/css" href="css/css3.css" />
<link rel="stylesheet" type="text/css" href="css/buttons.css" />
<link rel="stylesheet" type="text/css" href="css/nivo-slider.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/animations.css" />
<link rel="stylesheet" href="css/stringball.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cantarell:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="ext/js/js.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.custom_select form').jqTransform({imgPath:'jqtransformplugin/img/'});
		}); 
</script>

<?php require(DIR_WS_INCLUDES . 'pie_css.php');?>
<!--[if lt IE 8]>
   <div style=' clear: both; text-align:center; position: relative;'>
     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg"  alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
    </a>
  </div>
<![endif]-->
<?php echo $oscTemplate->getBlocks('header_tags'); ?>
<?php require(DIR_WS_INCLUDES . 'style.css.php');?>
</head>
<body>
<?php
			if ($current_page == FILENAME_DEFAULT)	{ $index_page = 'index';}else{$index_page = '';}
?>

<p id="back-top"><a href="#top"><span><?php echo BACK_TO_TOP;?></span></a></p>
<!-- bodyWrapper  -->
<div id="bodyWrapper" class="bg_body">
<div class="wrapper <?php echo $index_page;?>">
<a class="logo" href="<?php echo tep_href_link(FILENAME_DEFAULT);?>"><?php echo tep_image(DIR_WS_IMAGES.'store_logo.jpg', STORE_NAME, '', '', '')?></a>
	 
<?php
            if ($oscTemplate->hasBlocks('boxes_header'))	{
?>
                <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?> row_1"> 
                      <div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
               </div>
<?php
			}
?>
                                                 
 <?php
		 if ($oscTemplate->hasBlocks('boxes_menu'))	{
?>
		
      <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?> row_3"> 
            <div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>"><?php	echo $oscTemplate->getBlocks('boxes_menu');?></div>
     </div>
		
<?php 
		}
?>            
		<?php require(DIR_WS_INCLUDES . 'extra_row.php');?>                               
 
	            
        <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?> row_4">
        	
          	<div id="bodyContent" class="grid_<?php echo $oscTemplate->getGridContentWidth(); ?> <?php echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'push_' . $oscTemplate->getGridColumnWidth() : ''); ?> ">


<?php 
            if (($oscTemplate->hasBlocks('box_top_content_set')))	{
?>
				<?php echo $oscTemplate->getBlocks('box_top_content_set'); ?>
<?php
			}
?>
<?php        
			if (($current_page != FILENAME_DEFAULT) )	{
?>               
					<div class="breadcrumb"><div><?php echo '&nbsp;&nbsp;' . $breadcrumb->trail(' &raquo; '); ?></div></div>
<?php
			}
?>
