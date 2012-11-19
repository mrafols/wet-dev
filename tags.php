<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TAG);
	$current_page = FILENAME_TAG;
 //	$tags_id= $HTTP_GET_VARS['id_tag'];
	$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TAG));
  

  require(DIR_WS_INCLUDES . 'template_top.php');
	
?>

<?php echo tep_draw_content_top();?>

<?php echo tep_draw_title_top();?>
<h1><?php echo HEADING_TITLE; ?></h1>
<?php echo tep_draw_title_bottom();?>


<?php

 $specials_query = tep_db_query("select p.tag_id,p.tag_text from tags p order by rand() " );

?>
<div class="contentContainer txtPage">
  <div class="contentPadd">
<?php
				echo '<ul id="stringball">';
           
          
             while ($specials = tep_db_fetch_array($specials_query)) {

                  $data.= '<li><a href="' . tep_href_link(FILENAME_TAG_PRODUCTS) .'?id_tag='.$specials['tag_id'].'">'.$specials['tag_text'].'</a>,</li>';
                }


			echo  $data;  // выведет 'ciao' 
			echo '</ul>
<script type="text/javascript">
$(function(){
	$("ul#stringball").stringball({
	});
});
</script>
			'
?>
  </div>
</div>

<?php echo tep_draw_content_bottom();?>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
