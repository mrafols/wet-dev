<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class cm_information_our_offers {
    var $code = 'cm_information_our_offers';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_information_our_offers() {
      $this->title = MODULE_BOXES_INFORMATION_OUR_OFFERS_TITLE;
      $this->description = MODULE_BOXES_INFORMATION_OUR_OFFERS_DESCRIPTION;

      if ( defined('MODULE_BOXES_INFORMATION_OUR_OFFERS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_INFORMATION_OUR_OFFERS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_INFORMATION_OUR_OFFERS_STATUS == 'True');
        $this->pages = MODULE_BOXES_INFORMATION_OUR_OFFERS_DISPLAY_PAGES;
        $this->group = 'boxes_footer';
      }
    }

    function execute() {
      global $oscTemplate, $current_page;
	    $button_act1 = $button_act2 = $button_act3 = $button_act4 = $button_act5 = "";
		if ($current_page == FILENAME_PRODUCTS_NEW)	{
		$button_act1 = " act";
		$button_act2 = $button_act3 = $button_act4 = $button_act5 = "";
		}
		if ($current_page == FILENAME_TOPSELLERS_PRODUCTS)	{
		$button_act2 = " act";
		$button_act2 = $button_act3 = $button_act4 = $button_act5 = "";
		}
		if ($current_page == FILENAME_SPECIALS)	{
		$button_act3 = " act";
		$button_act2 = $button_act1 = $button_act4 = $button_act5 = "";
		}
		if ($current_page == FILENAME_MANUFACTURERS)	{
		$button_act4 = " act";
		$button_act2 = $button_act3 = $button_act1 = $button_act5 = "";
		}
		if ($current_page == FILENAME_SUPPLIERS)	{
		$button_act5 = " act";
		$button_act2 = $button_act3 = $button_act4 = $button_act1 = "";
		}
      $data = '<div class="Footer_BoxWrapper fl_left">' . 
              '  <h4 class="Footer_BoxHeading">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_TITLE . '</h4>' .
			  '  <ul class="information">' .
    //          '    <li class="'.$button_act1.'">'. tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW) . '">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_PRODUCTS_NEW . '</a>' . tep_draw_box_list_bottom() . '</li>' .
              '    <li class="'.$button_act2.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_TOPSELLERS_PRODUCTS) . '">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_BESTSELLERS . '</a>' . tep_draw_box_list_bottom() . '</li>' .
              '    <li class="'.$button_act3.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_SPECIALS) . '">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_SPECIALS . '</a>' . tep_draw_box_list_bottom() . '</li>' .
              '    <li class="'.$button_act4.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_MANUFACTURERS) . '">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_MANUFACTURERS . '</a>' . tep_draw_box_list_bottom() . '</li>'.
              '    <li class="'.$button_act5.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_SUPPLIERS) . '">' . MODULE_BOXES_INFORMATION_OUR_OFFERS_BOX_SUPPLIERS . '</a>' . tep_draw_box_list_bottom() . '</li>'.
			  '  </ul>' .
              '</div>';

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_INFORMATION_OUR_OFFERS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Information Module', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_INFORMATION_OUR_OFFERS_STATUS', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_CONTENT_PLACEMENT', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_SORT_ORDER', 'MODULE_BOXES_INFORMATION_OUR_OFFERS_DISPLAY_PAGES');
    }
  }
?>
