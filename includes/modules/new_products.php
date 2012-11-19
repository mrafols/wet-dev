<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
?>
<?php
if ($current_page == FILENAME_DEFAULT){
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("select p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS_MODUL_FIRST_PAGE);
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS_MODUL_FIRST_PAGE);
  }
}else{
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("select p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS_MODUL);
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS_MODUL);
  }
}
  $col = 0;
  $row = 0;
  
  if ($current_page != FILENAME_DEFAULT)	{  
  $col_items = (MAX_DISPLAY_NEW_PRODUCTS_MODUL_PER_ROW - 1);
  }else{
  $col_items = (MAX_DISPLAY_NEW_PRODUCTS_MODUL_PER_ROW_FIRST_PAGE - 1);
  }
  $new_prods_content .= '<div class="prods_content prods_table">';
  while ($new_products = tep_db_fetch_array($new_products_query)) {
	if (($col === 0) && ($row != 0)) {
	  $new_prods_content .= '<ul class="row_separator"><li class="prods_hseparator">'.tep_draw_separator('spacer.gif', '1', '1').'</li></ul>';
	} 
	if ($col === 0) {
      $new_prods_content .= '<ul class="row_new_products_name row_new_products_block" id="row-'.$row.'">';
   }else {
	   $new_prods_content .= '<li class="prods_vseparator equal-height_new_products_block">'.tep_draw_separator('spacer.gif', '1', '1').''; 
   }
// *************************************
			if	(IMG_HOVER_EFFECT == 'style-1')	{
				$img_effect = 'first';
				$img_effect_width = PRODS_BLOCK_NEW_PRODUCT_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-2')	{
				$img_effect = 'tenth';
				$img_effect_width = PRODS_BLOCK_NEW_PRODUCT_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-3')	{
				$img_effect = 'fifth';	
				$img_effect_width = PRODS_BLOCK_NEW_PRODUCT_WIDTH - PIC_MARG_W;	
			}   
// *************************************
		$p_id = $new_products['products_id'];	
		$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$p_id . "' and language_id = '" . (int)$languages_id . "'");
		$product = tep_db_fetch_array($product_query);
		  
	  $p_pic = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id) . '" style="width:'.(NEW_PRODS_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(NEW_PRODS_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], (NEW_PRODS_MODUL_IMAGE_WIDTH), (NEW_PRODS_MODUL_IMAGE_HEIGHT), ' style="width:'.(NEW_PRODS_MODUL_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(NEW_PRODS_MODUL_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"') . '';
	  
	  $p_name = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id) . '">' . $new_products['products_name'] . '</a></span>';
	  
		if	(MAX_DESCR_NEW_PRODUCTS_MODUL !=0)	{
	  $p_desc =  '<div class="desc desc_padd">'.mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_NEW_PRODUCTS_MODUL, 'UTF-8').'...</div>';
		}else{
 		$p_desc = '';			
		}
	  $p_price = '<span class="productSpecialPrice">' . $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</span>';
// *************************************  
	  $p_details_text = '' .tep_draw_button2_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button2_bottom().'';
	  $p_buy_now_text = '' .tep_draw_button_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button_bottom().'';
// *************************************
// *************************************

    $new_prods_content .= '<li style="width:'.PRODS_BLOCK_NEW_PRODUCT_WIDTH.'px;" class="wrapper_prods equal-height_new_products_block hover">'. "\n".
				 
				  '<div class="border_prods">'. "\n".
								
					'		<div class="pic_padd wrapper_pic_div" style="width:'.(NEW_PRODS_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(NEW_PRODS_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic.'</a></div>'. "\n". //'.tep_draw_prod_new_products_modul_pic_top().''.tep_draw_prod_new_products_modul_pic_bottom().'
          ''.$sale.''. "\n".	
				  '		<div class="prods_padd">'.
					'						<div class="name name_padd equal-height_new_products_name">'.$p_name.'</div>'. "\n".
					'			  		'.$p_desc.''. "\n".				  				  	 
					'						<div class="price price_padd '.$extra.'"><b>'.PRICE. '</b>'.$p_price.'</div>'. "\n".
				  '		</div>'. "\n".
				  '		<div class="button__padd">'.$p_buy_now_text.' '.$p_details_text.'</div>'. "\n".					  
																								
				  '</div>'. "\n";			  
					
    $col ++;
    if ($col > $col_items) {
      	$new_prods_content .= '</ul>';
	  	$row ++;
      	$col = 0;
    }else{
		$new_prods_content .= '</li>';	
	}
  }

  $new_prods_content .= '</div>';
 /* if ($current_page == FILENAME_DEFAULT)	{
  }else{*/
?>

<?php
		//	if ($current_page != FILENAME_DEFAULT)	{
?>
<?php echo tep_draw_title_top();?>
<h1 class="cl_both "><?php echo sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')); ?></h1>
<?php echo tep_draw_title_bottom();
 /* }*/
?>
<div class="contentContainer page_un">
  <div class="contentPadd">
    <?php echo $new_prods_content; ?>
  </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){ 				
			 var row_list_new_products_name = $('.row_new_products_name');
			 row_list_new_products_name.each(function(){
				 new equalHeights_new_products_name($('#' + $(this).attr("id")));
			  });			 			 			  			  			  			  			   
			 var row_list_new_products_block = $('.row_new_products_block');
			 row_list_new_products_block.each(function(){
				 new equalHeights_new_products_block($('#' + $(this).attr("id")));
			  });			  			 			 			  			  			  			  			   
        })
</script>
  
<?php
 // }
?>
