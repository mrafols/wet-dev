<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_MANUFACTURERS);
  $current_page = FILENAME_MANUFACTURERS;
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_MANUFACTURERS));

  require(DIR_WS_INCLUDES . 'template_top.php');
?>

<?php echo tep_draw_content_top();?>

<?php echo tep_draw_title_top();?>
<h1><?php echo HEADING_TITLE; ?></h1>
<?php echo tep_draw_title_bottom();?>

<div class="contentContainer">
<?php
//if (isset($HTTP_GET_VARS['manufacturers_id'])) {
	$manufacturers_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, COUNT(*) as total from " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS . " p where m.manufacturers_id = p.manufacturers_id GROUP BY manufacturers_id order by manufacturers_name");	
	
	if ($number_of_rows = tep_db_num_rows($manufacturers_query)) {
		$manufacturers_list = '<ul style="list-style: none; margin: 0; padding: 0;">';
		while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
			$manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN_PAGE) ? substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN_PAGE) . '..' : $manufacturers['manufacturers_name']);
			if (tep_not_null($manufacturers['manufacturers_image'])) {
			$manufacturers_image =  tep_image(DIR_WS_IMAGES . $manufacturers['manufacturers_image'], $manufacturers['manufacturers_name'], '', '', '');
			}else{
			$manufacturers_image = '';
			}
			if	($manufacturers['total'] > 1)	{
				$text_info	= TEXT_INFO_S;	
			}else{
				$text_info	= TEXT_INFO;
			}
				if (isset($HTTP_GET_VARS['manufacturers_id']) && ($HTTP_GET_VARS['manufacturers_id'] == $manufacturers['manufacturers_id'])) $manufacturers_name = '<strong>' . $manufacturers_name .'</strong>';
				$manufacturers_list .= '<li class="manufacturers_logo">'.$manufacturers_image.'<a class="fl_left" href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id']) . '">' . $manufacturers_name .'</a><a class="fl_right" href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id']) . '">'.$manufacturers['total'].' '.$text_info.'</a></li>';
			}		  
				$manufacturers_list .= '</ul>'; 
				$content = $manufacturers_list;				
	  }
//}
?>
  <div class="contentPadd txtPage">
    <?php echo $content; ?>
  <div class="buttonSet">
    <span class="fl_right"><?php echo tep_draw_button_top();?><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', tep_href_link(FILENAME_DEFAULT)); ?><?php echo tep_draw_button_bottom();?></span>
  </div>

</div>
</div>

<?php echo tep_draw_content_bottom();?>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
