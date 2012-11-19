<?php

/*
  $Id: optional_related_products.php, ver 1.0 02/05/2007 Exp $

  Copyright (c) 2007 Anita Cross (http://www.callofthewildphoto.com/)

  Part of Contribution: Optional Related Products Ver 4.0

  Based on code from Optional Relate Products, ver 2.0 05/01/2005
  Copyright (c) 2004-2005 Daniel Bahna (daniel.bahna@gmail.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

  $orderBy = 'ORDER BY ';
  $orderBy .= (RELATED_PRODUCTS_RANDOMIZE)?'rand()':'pop_order_id, pop_id';
  $orderBy .= (RELATED_PRODUCTS_MAX_DISP)?' limit ' . RELATED_PRODUCTS_MAX_DISP:'';
  $attributes = "
         SELECT
         pop_products_id_slave,
         products_name,
         products_model,
         products_price,
         products_quantity,
         products_tax_class_id,
         products_image
         FROM " .
         TABLE_PRODUCTS_RELATED_PRODUCTS . ", " .
         TABLE_PRODUCTS_DESCRIPTION . " pa, ".
         TABLE_PRODUCTS . " pb
         WHERE pop_products_id_slave = pa.products_id
         AND pa.products_id = pb.products_id
         AND language_id = '" . (int)$languages_id . "'
         AND pop_products_id_master = '".$HTTP_GET_VARS['products_id']."'
         AND products_status='1' " . $orderBy;
  $attribute_query = tep_db_query($attributes);
  $col_slave = 0;
  $row_slave = 0;
  $col_items_slave = (RELATED_PRODUCTS_PER_ROW - 1);

  if (mysql_num_rows($attribute_query)>0) {
?>

<?php
    $slave_prods_content .= '<div class="prods_content prods_table">';

    while ($attributes_values = tep_db_fetch_array($attribute_query)) {
	  $p_id_slave = '' . $attributes_values['pop_products_id_slave'] . '';		
	  $p_name_slave = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id_slave) . '">' . $attributes_values['products_name'] . '</a></span>';
	  $p_model_slave = '' . $attributes_values['products_model'] . '';
	  $p_qty_slave = '' . $attributes_values['products_quantity'] . '';

		
	if (($col_slave === 0) && ($row_slave != 0)) {
	  $slave_prods_content .= '<ul class="row_separator"><li class="prods_hseparator">'.tep_draw_separator('spacer.gif', '1', '1').'</li></ul>'. "\n";
	} 
	if ($col_slave === 0) {
      $slave_prods_content .= '<ul class="row_slave_name row_slave_block" id="row_slave-'.$row_slave.'">';
   }else {
	   $slave_prods_content .= '<li class="prods_vseparator equal-height_slave_block">'.tep_draw_separator('spacer.gif', '1', '1').''; 
   }
// *************************************
			if	(IMG_HOVER_EFFECT == 'style-1')	{
				$img_effect = 'first';
				$img_effect_width = PRODS_BLOCK_RELATED_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-2')	{
				$img_effect = 'tenth';
				$img_effect_width = PRODS_BLOCK_RELATED_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-3')	{
				$img_effect = 'fifth';	
				$img_effect_width = PRODS_BLOCK_RELATED_WIDTH - PIC_MARG_W;	
			}   
// *************************************
	 
	  $p_pic = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id_slave) . '" style="width:'.(RELATED_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(RELATED_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $attributes_values['products_image'], $attributes_values['products_name'], (RELATED_MODUL_IMAGE_WIDTH), (RELATED_MODUL_IMAGE_HEIGHT), ' style="width:'.(RELATED_MODUL_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(RELATED_MODUL_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"') . '';
	
   	  if ($new_price = tep_get_products_special_price($attributes_values['pop_products_id_slave'])) {
      $products_price = '<span class="productSpecialPrice" style="float:right;">' . $currencies->display_price($new_price, tep_get_tax_rate($attributes_values['products_tax_class_id'])) . '</span> <del>' . $currencies->display_price($attributes_values['products_price'], tep_get_tax_rate($attributes_values['products_tax_class_id'])) . '</del>';
				$sale	= '<div class="sale"></div>';
	 			$extra = '';				
// *************************************		
      } else {
// *************************************		  
        $products_price = '<span class="productSpecialPrice">'.$currencies->display_price($attributes_values['products_price'], tep_get_tax_rate($attributes_values['products_tax_class_id']).'').'</span>';
	 			$extra = 'extra';				
				$sale	= '';
      }
	  $p_price_slave = $products_price;
	
//  $p_desc =  mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_MODUL_RELATED_PRODS, 'UTF-8').'...';
	
// *************************************  
	  $p_buy_now_text = '' .tep_draw_button_top() . '<a href="'
						. tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))
						. 'action=rp_buy_now&rp_products_id=' . $p_id_slave) . '" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_RP_BUY_NOW .'</span></a>' . tep_draw_button_bottom().'';
// *************************************
      if (RELATED_PRODUCTS_SHOW_THUMBS == 'True') {
        $slave_prods_pic = '<div class="pic_padd wrapper_pic_div" style="width:'.(RELATED_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(RELATED_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic_slave.''.tep_draw_prod_related_pic_top().''.tep_draw_prod_related_pic_bottom().'</a></div>' . "\n";
		
      }
      $caption = '';
      if (RELATED_PRODUCTS_SHOW_NAME == 'True') {
        $p_name = '<div class="name name_padd equal-height_slave_name">' . $p_name_slave . '</div>' . "\n";
      } 
	  if (RELATED_PRODUCTS_SHOW_MODEL == 'True') {
        $p_model =  '<div class="desc desc_padd">' . $p_model_slave . '</div>' . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_PRICE == 'True') {
        $p_price = '<div class="price price_padd '.$extra.'""><b>'.PRICE. '</b>'.$p_price_slave.'</div>' . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_QUANTITY == 'True') {
        $p_desc = '<div class="desc desc_padd">' . sprintf(RELATED_PRODUCTS_QUANTITY_TEXT, $p_qty_slave) . '</div>' . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_BUY_NOW== 'True') {
        $p_buy_now_text = '<div class="button__padd">' . $p_buy_now_text . '</div>';
      }
	  
    $slave_prods_content .= '<li style="width:'.PRODS_BLOCK_RELATED_WIDTH.'px;" class="wrapper_prods equal-height_slave_block hover">'.
				  
				  '<div class="border_prods">'. "\n".
					'		<div class="pic_padd wrapper_pic_div" style="width:'.(RELATED_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(RELATED_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic.'</a></div>'. "\n". //'.tep_draw_prod_related_pic_top().''.tep_draw_prod_related_pic_bottom().'
          ''.$sale.''. "\n".	
				  '		<div class="prods_padd">'.
					'						'.$p_name.''. "\n".
					'			  		'.$p_desc.''. "\n".	
				//	'			  		'.$p_model.''. "\n".								  				  	 
					'						'.$p_price.''. "\n".
					'						'.$p_buy_now_text.''. "\n".	
				  '		</div>'. "\n".				  
																								
				  '</div>'. "\n";			  
				 

    $col_slave ++;
    if ($col_slave > $col_items_slave) {
      	$slave_prods_content .= '</ul>';
	  	$row_slave ++;
      	$col_slave = 0;
    }else{
		$slave_prods_content .= '</li>';	
	}
  }

  $slave_prods_content .= '</div>';
?>
<?php echo tep_draw_content_top();?>
<?php echo tep_draw_title_top();?>
<h1 class="cl_both "><?php echo TEXT_RELATED_PRODUCTS ?></h1>
<?php echo tep_draw_title_bottom();?>
<div class="contentContainer">
  <div class="contentPadd">
    <?php echo $slave_prods_content; ?>
  </div>
</div>
<?php echo tep_draw_content_bottom();?>
<?php
}
?>
<script type="text/javascript">
        $(document).ready(function(){ 			
			 var row_list_slave_name = $('.row_slave_name');
			 row_list_slave_name.each(function(){
				 new equalHeights_slave_name($('#' + $(this).attr("id")));
			  });			 			 			  			  			  			  			   
			 var row_list_slave_block = $('.row_slave_block');
			 row_list_slave_block.each(function(){
				 new equalHeights_slave_block($('#' + $(this).attr("id")));
			  });			  			 			 			  			  			  			  			   
        })
</script>
