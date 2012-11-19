<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TAG_PRODUCTS);
 	$tags_id= $HTTP_GET_VARS['id_tag'];
	$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TAG));
  

  require(DIR_WS_INCLUDES . 'template_top.php');
	
?>

<?php echo tep_draw_content_top();?>

<?php echo tep_draw_title_top();?>
<h1><?php echo HEADING_TITLE; ?></h1>
<?php echo tep_draw_title_bottom();?>


<?php


  $specials_query_raw = "select p.products_id, pd.products_name, pd.products_description, p.products_price, p.products_tax_class_id, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, products_tags s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.tag_id=".$tags_id." ";
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<?php echo tep_draw_result1_top(); ?> 
               
        <div class="cl_both result_top_padd ofh">
        	<div class="fl_left result_left"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></div>
            <div class="fl_right result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
        </div>

<?php echo tep_draw_result1_bottom(); ?> 

<?php
  }
?>
<div class="contentContainer page_new_product">
  <div class="contentPadd">


<?php
	  $row = 0;
	  $col = 0;
	  
	  $col_items = 0; //(MAX_DISPLAY_NEW_PRODUCTS_LIST_PER_ROW - 1);
	  $col_width = (int)(100 / ($col_items + 1)).'%';
	  
	
	  $tag_prods_content = '<div class="prods_table">';
		
    $specials_query = tep_db_query($specials_split->sql_query);
    while ($specials = tep_db_fetch_array($specials_query)) {
		if (($col === 0) && ($row != 0)) {
		  $tag_prods_content .= '<div class="prods_hseparator">'.tep_draw_separator('spacer.gif', '1', '1').'</div>'; 
		} 
		if ($col === 0) {
		  $tag_prods_content .= '';
	   }else {
		   $tag_prods_content .= ''; // <td class="prods_vseparator">'.tep_draw_separator('spacer.gif', '1', '1').'
	   }
		$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$specials['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $product = tep_db_fetch_array($product_query);
		$p_id = $specials['products_id'];
		$p_desc =  mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_PRODS_NEW, 'UTF-8').'...';
				
		$p_name = '<span class="name"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' .$specials['products_name'] . '</a></span>';
		
		$p_pic = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '" style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $specials['products_image'], $specials['products_name'], (SMALL_IMAGE_WIDTH), (SMALL_IMAGE_HEIGHT), ' style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"') . '';

	//	$p_price = '<span class="productSpecialPrice">' . $currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span>';
		
   	  if ($new_price = tep_get_products_special_price($p_id)) {
      $products_price = '<span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($specials['products_tax_class_id'])) . '</span> <del>' . $currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</del>';
			$sale	= '<div class="sale"></div>';
// *************************************		
      } else {
// *************************************		  
        $products_price = '<span class="productSpecialPrice">'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id']).'').'</span>';
				$sale	= '';
      }
	  
	  $p_price = $products_price;
		
		$p_buy_now_text = '' .tep_draw_button_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button_bottom().'';
		
    $tag_prods_content .= '<div class="contentInfoBlock hover">

	<div class="prods_content decks">
		<div class="forecastle">
		<ol class="masthead">
			  <li class="port_side left_side4"><div class="pic_padd wrapper_pic_div" style="width:'.(SMALL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(SMALL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic.''.tep_draw_prod_pic_top().''.tep_draw_prod_pic_bottom().'</a></div></li>
			  <li class="starboard_side bak4">
			  		<div class="info">
						<h2 class="name name2_padd">'.$p_name.'</h2>
						<h2 class="price price2_padd"><b>'.PRICE. '</b>'.$p_price.'</h2>						
						<div class="desc desc2_padd">'.$p_desc.'</div>						
						<div class="button button2__padd">'.$p_buy_now_text.'</div>
					</div>
			  </li>
		</ol>
		</div>	
	</div>
	</div>';

	$count_color ++;
    $col ++;
	
    if ($col > $col_items) {
      $tag_prods_content .= '';
	  $row ++;
      $col = 0;
    }else{
		$tag_prods_content .= '</div>';	
	}
  }

  $tag_prods_content .= '</div>';
  echo $tag_prods_content;
?>
  </div>
</div>

<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

<?php echo tep_draw_result2_top(); ?> 
       
        <div class="cl_both result_bottom_padd ofh">
        	<div class="fl_left result_left"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></div>
            <div class="fl_right result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
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
