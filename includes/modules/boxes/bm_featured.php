<?php
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
  Featured Products V1.1
  Displays a list of featured products, selected from admin
  For use as an Infobox instead of the "Feature" Infobox  
*/

  class bm_featured {
    var $code = 'bm_featured';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function bm_featured() {
      $this->title = MODULE_BOXES_FEATURED_TITLE;
      $this->description = MODULE_BOXES_FEATURED_DESCRIPTION;

      if ( defined('MODULE_BOXES_FEATURED_STATUS') ) {
        $this->sort_order = MODULE_BOXES_FEATURED_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_FEATURED_STATUS == 'True');
        $this->pages = MODULE_BOXES_FEATURED_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_FEATURED_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $HTTP_GET_VARS, $languages_id, $currencies, $oscTemplate;

      if (!isset($HTTP_GET_VARS['products_id'])) {
          if ($random_product = tep_random_select("select p.products_id, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, pd.products_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id left join " . TABLE_FEATURED . " f on p.products_id = f.products_id where p.products_status = '1' and f.status = '1' order by rand() DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS)) {

		$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$random_product['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
		$product = tep_db_fetch_array($product_query);
		 
		  if (tep_not_null($random_product['specials_new_products_price'])) {
			$new_price = '<del class="fl_right">' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</del>';
			$new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
		  } else {
			$new_price = '<span class="productSpecialPrice">'.$currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])).'</span>';
		  }
		  
    	$p_id = $random_product['products_id'];
		$name_prod = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a></span>';
		$pic_prod = '<a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$p_id) . '" style="width:'.(BOX_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(BOX_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], (BOX_IMAGE_WIDTH), (BOX_IMAGE_HEIGHT), ' style="width:'.(BOX_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(BOX_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"').'';
		$p_desc =  mb_substr(strip_tags($product['products_description']), 0, MAX_DESCR_BOX, 'UTF-8').'...';
	
    	$p_details_text = '' .tep_draw_button2_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button2_bottom().'';

    	$p_buy_now_text = '' .tep_draw_button_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button_bottom().'';
		  
          $data = '<div class="infoBoxWrapper box2">' . tep_draw_box_wrapper_top() .
                  '  <div class="infoBoxHeading">' . tep_draw_box_title_top() . '<a href="' . tep_href_link(FILENAME_FEATURED) . '">' . MODULE_BOXES_FEATURED_BOX_TITLE . '</a>' . tep_draw_box_title_bottom() . '</div>' .
                  '  <div class="infoBoxContents hover">' . tep_draw_box_content_top() . 
				 
				  '		<div class="pic_padd wrapper_pic_div" style="width:'.(BOX_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(BOX_IMAGE_HEIGHT + PIC_MARG_H).'px;">'.$pic_prod.''.tep_draw_box_pic_top().''.tep_draw_box_pic_bottom().'</a></div>'. "\n".
				  '		<div class="box-padd">'. "\n".
				  
				  '			<div class="desc desc_padd">'.$p_desc.'</div>'. "\n".
 				  '			<div class="name name_padd">'.$name_prod.'</div>'. "\n".			
				  '			<div class="price price_padd"><b>'.PRICE. '</b>'.$new_price.'</div>'. "\n".
				//  '			<div class="button__padd cl_both">'.$p_details_text.''.$p_buy_now_text.'</div>'. "\n".
				  '		</div>'. "\n".				  			  
				 '' . tep_draw_box_content_bottom() . '</div>'. "\n".
          		 '' . tep_draw_box_wrapper_bottom() . '</div>';

          $oscTemplate->addBlock($data, $this->group);
		 
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_FEATURED_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Featured Module', 'MODULE_BOXES_FEATURED_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_FEATURED_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_FEATURED_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_FEATURED_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");
	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_FEATURED_STATUS', 'MODULE_BOXES_FEATURED_CONTENT_PLACEMENT', 'MODULE_BOXES_FEATURED_SORT_ORDER', 'MODULE_BOXES_FEATURED_DISPLAY_PAGES');
    }
  }
?>