<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
// if( defined('FEATURED_PRODUCTS_DISPLAY') AND FEATURED_PRODUCTS_DISPLAY == 'true' ) {

  $featured_products_category_id =  (isset($new_products_category_id))?$new_products_category_id:'0';
  $cat_name_query = tep_db_query('SELECT `categories_name` FROM ' . TABLE_CATEGORIES_DESCRIPTION . " WHERE `categories_id` = '" . $featured_products_category_id . "' limit 1");
  $cat_name_fetch = tep_db_fetch_array($cat_name_query);
  $cat_name = $cat_name_fetch['categories_name'];
  $info_box_contents = array();

  list($usec, $sec) = explode(' ', microtime());
  srand( (float) $sec + ((float) $usec * 100000) );
  $mtm= rand();
  	
  if ( (!isset($featured_products_category_id)) || ($featured_products_category_id == '0') ) {
    $title = '<a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . TABLE_HEADING_FEATURED_PRODUCTS . '</a>';

    // Phocea Optimize featured query
    // Ben: Option to only show featured products on sale
    $query = 'SELECT p.products_id, p.products_image, p.products_tax_class_id, IF (s.status, s.specials_new_products_price, NULL) AS specials_new_products_price, p.products_price, pd.products_name ';

	if ( defined('FEATURED_MODUL_SPECIALS_ONLY') AND FEATURED_MODUL_SPECIALS_ONLY == 'true' ) {
      $query .= 'FROM ' . TABLE_SPECIALS . ' s LEFT JOIN ' . TABLE_PRODUCTS . ' p ON s.products_id = p.products_id ';
	} else {
      $query .= 'FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_SPECIALS . ' s ON p.products_id = s.products_id ';
	}
  if ($current_page != FILENAME_DEFAULT)	{ 
    $query .= 'LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "'
    LEFT JOIN " . TABLE_FEATURED . " f ON p.products_id = f.products_id
    WHERE p.products_status = '1' AND f.status = '1' order by rand($mtm) DESC limit " . MAX_DISPLAY_FEATURED_MODUL;
  }else{
    $query .= 'LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "'
    LEFT JOIN " . TABLE_FEATURED . " f ON p.products_id = f.products_id
    WHERE p.products_status = '1' AND f.status = '1' order by rand($mtm) DESC limit " . MAX_DISPLAY_FEATURED_MODUL_FIRST_PAGE;
  }
    $featured_products_query = tep_db_query( $query );	
  } else {
    $title = sprintf(TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY, $cat_name);
    $subcategories_array = array();
    tep_get_subcategories($subcategories_array, $featured_products_category_id);
    $featured_products_category_id_list = tep_array_values_to_string($subcategories_array);
    if ($featured_products_category_id_list == '') {
      $featured_products_category_id_list .= $featured_products_category_id;
    } else {
      $featured_products_category_id_list .= ',' . $featured_products_category_id;
    }

	if ( defined('FEATURED_MODUL_SUB_CATEGORIES') AND FEATURED_MODUL_SUB_CATEGORIES == 'true') {
      // current catID as starting value
      $cats[] = $new_products_category_id; 
      // put cat-IDs of all cats nested in current branch into $cats array, 
      // go through all subbranches
      for($i=0; $i<count($cats); $i++) {
        $categorie_query = tep_db_query('SELECT `categories_id` FROM ' . TABLE_CATEGORIES . " WHERE parent_id = '" . (int)$cats[$i] . "'"); 
        while ($categorie = tep_db_fetch_array($categorie_query)) {
          $cats[] = $categorie['categories_id'];
        }
	    // sort out doubles
        $cats = array_unique($cats);
      }
      $catIdSql = implode(', ', $cats);
	} else {
      $catIdSql = $featured_products_category_id_list;
	}

    // Phocea Optimize featured query
	$query = 'SELECT distinct p.products_id, p.products_image, p.products_tax_class_id, IF (s.status, s.specials_new_products_price, NULL) AS specials_new_products_price, p.products_price, pd.products_name
    FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c using(products_id)
    LEFT JOIN ' . TABLE_CATEGORIES . ' c USING (categories_id)
    LEFT JOIN ' . TABLE_FEATURED . ' f ON p.products_id = f.products_id
    LEFT JOIN ' . TABLE_SPECIALS . ' s ON p.products_id = s.products_id
    LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "' 
    where c.categories_id IN(" . $catIdSql . ") AND p.products_status = '1' AND f.status = '1' ";

	if ( defined('FEATURED_MODUL_SPECIALS_ONLY') AND FEATURED_MODUL_SPECIALS_ONLY == 'true' ) {
		$query .= " AND s.status = '1' ";
	}
  if ($current_page != FILENAME_DEFAULT)	{ 	
	$query .= 'ORDER BY rand(' . $mtm . ') DESC LIMIT ' . MAX_DISPLAY_FEATURED_MODUL;
  }else{
	$query .= 'ORDER BY rand(' . $mtm . ') DESC LIMIT ' . MAX_DISPLAY_FEATURED_MODUL_FIRST_PAGE;
  }
    $featured_products_query = tep_db_query( $query );
}

  $num_featured_products = tep_db_num_rows($featured_products_query);

  if ($num_featured_products > 0) {
  $col_featured = 0;
  $row_featured = 0;
  
  if ($current_page != FILENAME_DEFAULT)	{  
  $col_items_featured = (FEATURED_MODUL_PER_ROW - 1);
  }else{
  $col_items_featured = (FEATURED_MODUL_PER_ROW_FIRST_PAGE - 1);
  }
  $featured_prods_content .= '<div class="prods_content prods_table">';

    while ($featured_products = tep_db_fetch_array($featured_products_query)) {
	if (($col_featured === 0) && ($row_featured != 0)) {
	  $featured_prods_content .= '<ul class="row_separator"><li class="prods_hseparator">'.tep_draw_separator('spacer.gif', '1', '1').'</li></ul>';
	} 
	if ($col_featured === 0) {
      $featured_prods_content .= '<ul class="row_featured_name row_featured_block" id="row_featured-'.$row_featured.'">';
   }else {
	   $featured_prods_content .= '<li class="prods_vseparator equal-height_featured_block">'.tep_draw_separator('spacer.gif', '1', '1').''; 
   }
// *************************************
			if	(IMG_HOVER_EFFECT == 'style-1')	{
				$img_effect = 'first';
				$img_effect_width = PRODS_BLOCK_FEATURED_MODUL_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-2')	{
				$img_effect = 'tenth';
				$img_effect_width = PRODS_BLOCK_FEATURED_MODUL_WIDTH - PIC_MARG_W;	
			}
			if	(IMG_HOVER_EFFECT == 'style-3')	{
				$img_effect = 'fifth';	
				$img_effect_width = PRODS_BLOCK_FEATURED_MODUL_WIDTH - PIC_MARG_W;	
			}   
// *************************************
    $counter++;
	  $p_id = $featured_products['products_id'];
		
		$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$featured_products['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $product = tep_db_fetch_array($product_query);
		
		if	(MAX_DESCR_FEATURED_MODUL !=0)	{
		$p_desc =  '<div class="desc desc_padd">'.mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_FEATURED_MODUL, 'UTF-8').'...</div>';
		}else{
		$p_desc =  '';	
		}
	  $p_pic = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '" style="width:'.(FEATURED_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(FEATURED_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], (FEATURED_MODUL_IMAGE_WIDTH), (FEATURED_MODUL_IMAGE_HEIGHT), ' style="width:'.(FEATURED_MODUL_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(FEATURED_MODUL_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"') . '';
	  	  
	  $p_name = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . $featured_products['products_name'] . '</a></span>';
		if (tep_not_null($featured_products['specials_new_products_price'])) {
	 $p_price = $lc_text = '<span class="productSpecialPrice un" style="float:right;">' . $currencies->display_price($featured_products['specials_new_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>
<del>' .  $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</del>';
		$extra = '';
		$sale	= '<div class="sale"></div>';
		} else {
	 $p_price = $lc_text = '<span class="productSpecialPrice">' . $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
	 $extra = 'extra';
	 $sale	= '';
		}
// *************************************  
	  $p_details_text = '' .tep_draw_button2_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button2_bottom().'';
	  $p_buy_now_text = '' .tep_draw_button_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button_bottom().'';
// *************************************	  
    $featured_prods_content .= '<li style="width:'.PRODS_BLOCK_FEATURED_MODUL_WIDTH.'px;" class="wrapper_prods equal-height_featured_block hover">'.
				  
				  '<div class="border_prods">'. "\n".
					
								
					'		<div class="pic_padd wrapper_pic_div" style="width:'.(FEATURED_MODUL_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(FEATURED_MODUL_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$p_pic.'</a></div>'. "\n". //'.tep_draw_prod_feature_modul_pic_top().''.tep_draw_prod_feature_modul_pic_bottom().'
          ''.$sale.''. "\n".	
				  '		<div class="prods_padd">'.
					'						<div class="name name_padd equal-height_featured_name">'.$p_name.'</div>'. "\n".
					'			  		'.$p_desc.''. "\n".				  				  	 
					'						<div class="price price_padd '.$extra.'"><b>'.PRICE. '</b>'.$p_price.'</div>'. "\n".
					'						<div class="button__padd">'.$p_buy_now_text.'</div>'. "\n".	
				  '		</div>'. "\n".				  
																								
				  '</div>'. "\n";			  
				  
					

    $col_featured ++;
    if ($col_featured > $col_items_featured) {
      	$featured_prods_content .= '</ul>';
	  	$row_featured ++;
      	$col_featured = 0;
    }else{
		$featured_prods_content .= '</li>';	
	}
  }

  $featured_prods_content .= '</ul></div>';
  
?>
<?php
//if	($current_page != FILENAME_DEFAULT)	{
 echo tep_draw_title_top();?>
<h1 class="cl_both "><?php echo $title; ?></h1>
<?php echo tep_draw_title_bottom();
//}
?>
<div class="contentContainer page_un">
  <div class="contentPadd">
    <?php echo $featured_prods_content; ?>
  </div>
</div>  
<?php
// }
?>
<?php
  }
?>

<script type="text/javascript">
        $(document).ready(function(){ 
			 var row_list_featured_name = $('.row_featured_name');
			 row_list_featured_name.each(function(){
				 new equalHeights_featured_name($('#' + $(this).attr("id")));
			  });
			 var row_list_featured_block = $('.row_featured_block');
			 row_list_featured_block.each(function(){
				 new equalHeights_featured_block($('#' + $(this).attr("id")));
			  });			  			 			 			  			  			  			  			   			  			 			 			  			  			  			  			   			 
        })
</script>
