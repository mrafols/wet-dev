<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $categories_products = tep_db_fetch_array($categories_products_query);
    if ($categories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);
?>

<?php
  if ($category_depth == 'nested') {
  $current_page = FILENAME_CATEGORIES_NESTED;
  require(DIR_WS_INCLUDES . 'template_top.php');
  
  include(FILENAME_CATEGORIES_NESTED); 
?>

<?php
  } elseif ($category_depth == 'products' || isset($HTTP_GET_VARS['manufacturers_id'])) {
  $current_page = FILENAME_CATEGORIES_LISTING;
  require(DIR_WS_INCLUDES . 'template_top.php');

  include(FILENAME_CATEGORIES_LISTING);
?>  

<?php
  } else { // default page
  $current_page = FILENAME_DEFAULT;
  require(DIR_WS_INCLUDES . 'template_top.php');

?>
<?php  if	( (NEW_PRODUCTS_MODULE_DISPLAY_FIRST_PAGE == 'true') || (NEW_PRODUCTS_MODULE_DISPLAY_FIRST_PAGE == 'true')) { ?>
<?php ?>	
<?php } ?>

<div class="none">
<?php echo tep_draw_title_top();?>
<h1><?php echo HEADING_TITLE; ?></h1>
<?php echo tep_draw_title_bottom();?><br />
</div>


<?php
if	(NEW_PRODUCTS_MODULE_DISPLAY_FIRST_PAGE == 'true')	{
	echo tep_draw_content_top();
	include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
	echo tep_draw_content_bottom();
}
if	(FEATURED_MODUL_DISPLAY_FIRST_PAGE == 'true')	{
	echo tep_draw_content_top();
	include(DIR_WS_MODULES . FILENAME_FEATURED); 
	echo tep_draw_content_bottom();
}
    include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS);
?>
<?php  if	( (NEW_PRODUCTS_MODULE_DISPLAY_FIRST_PAGE == 'true') || (NEW_PRODUCTS_MODULE_DISPLAY_FIRST_PAGE == 'true')) { ?>
<?php ?>	
<?php } ?>


<?php
  }

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
