<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FEATURED_PRODUCTS);
  $current_page = FILENAME_FEATURED_PRODUCTS;
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_FEATURED_PRODUCTS));

  require(DIR_WS_INCLUDES . 'template_top.php');  
?>

<?php echo tep_draw_content_top();?>

<?php echo tep_draw_title_top();?>
<h1><?php echo HEADING_TITLE; ?></h1>
<?php echo tep_draw_title_bottom();?>

<?php
	$featured_products_array = array();
	$featured_products_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name
   from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id
   left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'
   left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
   left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
   where p.products_status = '1' and f.status = '1' order by p.products_date_added DESC, pd.products_name";
   $featured_products_split = new splitPageResults($featured_products_query_raw, MAX_DISPLAY_FEATURED_PRODUCTS);

	if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

<?php echo tep_draw_result1_top(); ?> 
               
        <div class="cl_both result_top_padd ofh">
        	<div class="fl_left result_left"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED_PRODUCTS); ?></div>
            <div class="fl_right result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
        </div>

<?php echo tep_draw_result1_bottom(); ?> 

<?php
  }
?>

<?php
 if ($featured_products_split->number_of_rows > 0) {
?>

<div class="contentContainer page_new_product">
  <div class="contentPadd">

<?php
    $featured_query = tep_db_query($featured_products_split->sql_query);
	
	  $row = 0;
	  $col = 0;
	  
	  $col_items = 0; //(MAX_DISPLAY_NEW_PRODUCTS_LIST_PER_ROW - 1);
	  $col_width = (int)(100 / ($col_items + 1)).'%';
	  
	
	  $featured_prods_content = '<div class="prods_table">';
	
   while ($featured = tep_db_fetch_array($featured_query)) {

		if (($col === 0) && ($row != 0)) {
		  $featured_prods_content .= '<div class="prods_hseparator">'.tep_draw_separator('spacer.gif', '1', '1').'</div>'; 
		} 
		if ($col === 0) {
		  $featured_prods_content .= '';
	   }else {
		   $featured_prods_content .= ''; // <td class="prods_vseparator">'.tep_draw_separator('spacer.gif', '1', '1').'
	   }	
 	  $product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$featured['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
      $product = tep_db_fetch_array($product_query);

       	$p_desc =  mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_PRODS_NEW, 'UTF-8').'...';
        $p_id = $product['products_id'];
		$p_pic = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured['products_id']) . '" style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $featured['products_image'], $featured['products_name'], (SMALL_IMAGE_WIDTH), (SMALL_IMAGE_HEIGHT), ' style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"') . '';
		$p_name = '<span class="name"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured['products_id']) . '">' .$featured['products_name'] . '</a></span>';
		
		$p_data = '<span>' . TEXT_DATE_ADDED . '</span> ' . tep_date_long($featured['products_date_added']) . '';
		$p_manufacturers = '<span>' . TEXT_MANUFACTURER . '</span> ' . $featured['manufacturers_name'] . '';
 
      if ($new_price = tep_get_products_special_price($featured['products_id'])) {
        $products_price = '<span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($featured['products_tax_class_id'])) . '</span> <del>' . $currencies->display_price($featured['products_price'], tep_get_tax_rate($featured['products_tax_class_id'])) . '</del>';
				$sale	= '<div class="sale"></div>';
      } else {
        $products_price = '<span class="productSpecialPrice">' .$currencies->display_price($featured['products_price'], tep_get_tax_rate($featured['products_tax_class_id'])).'</span>';
				$sale	= '';
      }
	  
	  $p_price = $products_price;
	
	  $p_details_text = '' .tep_draw_button2_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button2_bottom().'';
	  $p_buy_now_text = '' .tep_draw_button_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button_bottom().'';
	  
	  $button_posipion = '' . $p_details_text.''.$p_buy_now_text . '';
// *************************************
// style="width:'.$col_width.'"
    $featured_prods_content .= '<div class="contentInfoBlock hover">

	<div class="prods_content decks">
		<div class="forecastle">
		<ol class="masthead">
			  <li class="port_side left_side4"><div class="pic_padd wrapper_pic_div" style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic.''.tep_draw_prod_pic_top().''.tep_draw_prod_pic_bottom().'</a></div></li>
			  <li class="starboard_side bak4">
			  		<div class="info">
						<div class="data data_padd">'.$p_data.'</div>
						<h2 class="name name2_padd">'.$p_name.'</h2>
						<div class="manuf manuf_padd">'.$p_manufacturers.'</div>
						<h2 class="price price2_padd"><b>'.PRICE. '</b>'.$products_price.'</h2>
						<div class="desc desc2_padd">'.$p_desc.'</div>
						<div class="button button2__padd">'.$button_posipion.'</div>
					</div>
			  </li>
		</ol>
		</div>	
	</div>'.$sale.'
	</div>';

	$count_color ++;
    $col ++;
	
    if ($col > $col_items) {
      $featured_prods_content .= '';
	  $row ++;
      $col = 0;
    }else{
		$featured_prods_content .= '</div>';	
	}
  }

  $featured_prods_content .= '</div>';
  echo $featured_prods_content;


?>
  </div>
</div>

<?php
  } else {
?>

    <div>
      <?php echo TEXT_NO_NEW_PRODUCTS; ?>
    </div>

<?php
  }
?>


<?php
  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

<?php echo tep_draw_result2_top(); ?>

        <div class="cl_both result_top_padd ofh">
        	<div class="fl_left result_left"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED_PRODUCTS); ?></div>
            <div class="fl_right result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
        </div>
 		
<?php echo tep_draw_result2_bottom(); ?>        

<?php
  }
?>

<?php echo tep_draw_content_bottom();?>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>