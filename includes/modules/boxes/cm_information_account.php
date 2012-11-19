<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class cm_information_account {
    var $code = 'cm_information_account';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_information_account() {
      $this->title = MODULE_BOXES_INFORMATION_ACCOUNT_TITLE;
      $this->description = MODULE_BOXES_INFORMATION_ACCOUNT_DESCRIPTION;

      if ( defined('MODULE_BOXES_INFORMATION_ACCOUNT_STATUS') ) {
        $this->sort_order = MODULE_BOXES_INFORMATION_ACCOUNT_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_INFORMATION_ACCOUNT_STATUS == 'True');
        $this->pages = MODULE_BOXES_INFORMATION_ACCOUNT_DISPLAY_PAGES;
        $this->group = 'boxes_footer';
      }
    }

    function execute() {
      global $oscTemplate, $current_page;
	    $button_act1 = $button_act2 = $button_act3 = $button_act4 = "0";
		if ( ($current_page == (FILENAME_LOGIN)) || ($current_page == (FILENAME_LOGOFF)) ){
		$button_act1 = " act";
		$button_act2 = $button_act3 = $button_act4 = "";
		}
		if (($current_page == (FILENAME_CREATE_ACCOUNT))
			|| ($current_page == (FILENAME_CREATE_ACCOUNT_SUCCESS))
			|| ($current_page == (FILENAME_ACCOUNT))
			|| ($current_page == (FILENAME_ACCOUNT_PASSWORD))
			|| ($current_page == (FILENAME_ACCOUNT_NOTIFICATIONS))
			|| ($current_page == (FILENAME_ACCOUNT_NEWSLETTERS))
			|| ($current_page == (FILENAME_ACCOUNT_HISTORY))
			|| ($current_page == (FILENAME_ACCOUNT_HISTORY_INFO))
			|| ($current_page == (FILENAME_ACCOUNT_EDIT)))
		{
		$button_act2 = " act";
		$button_act1 = $button_act3 = $button_act4 = "";
		}								
		if ($current_page == (FILENAME_SHIPPING))	{
		$button_act3 = " act";
		$button_act1 = $button_act2 = $button_act4 = "";		
		}
    if ($current_page == (FILENAME_TALLAS)) {
    $button_act4 = " act";
    $button_act1 = $button_act2 = $button_act3 = "";  
    }
	  
if (tep_session_is_registered('customer_id')) { 

$login_link = tep_href_link('logoff.php');
$login_title= MODULE_BOXES_INFORMATION_ACCOUNT_BOX_TITLE_LOGOFF;
} else{ 
$login_link = tep_href_link('login.php');
$login_title= MODULE_BOXES_INFORMATION_ACCOUNT_BOX_TITLE_LOGIN;
} 			  
if (tep_session_is_registered('customer_id')) { 

$acc_link = tep_href_link('account.php');
$acc_title= MODULE_BOXES_INFORMATION_ACCOUNT_BOX_MY_ACCOUNT;
} else{ 
$acc_link = tep_href_link('create_account.php');
$acc_title= MODULE_BOXES_INFORMATION_ACCOUNT_BOX_CREATE_ACCOUNT;
} 
      $data = '<div class="Footer_BoxWrapper fl_left">' . 
              '  <h4 class="Footer_BoxHeading">' . MODULE_BOXES_INFORMATION_ACCOUNT_BOX_TITLE . '</h4>' .
			  '  <ul class="information">' .
              '    <li class="'.$button_act1.'">'. tep_draw_box_list_top() . '<a href="' . $login_link . '">' . $login_title . '</a>' . tep_draw_box_list_bottom() . '</li>' .
			  '    <li class="'.$button_act2.'">'. tep_draw_box_list_top() . '<a href="' . $acc_link . '">' . $acc_title . '</a>' . tep_draw_box_list_bottom() . '</li>' .
              '    <li class="'.$button_act3.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_SHIPPING) . '">' . MODULE_BOXES_INFORMATION_ACCOUNT_BOX_SHIPPING . '</a>' . tep_draw_box_list_bottom() . '</li>' .
              '    <li class="'.$button_act4.'">' . tep_draw_box_list_top() . '<a href="' . tep_href_link(FILENAME_TALLAS) . '">' . MODULE_BOXES_INFORMATION_ACCOUNT_BOX_TALLAS . '</a>' . tep_draw_box_list_bottom() . '</li>' .
			  '  </ul>' .
              '</div>';

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_INFORMATION_ACCOUNT_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Information Module', 'MODULE_BOXES_INFORMATION_ACCOUNT_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_INFORMATION_ACCOUNT_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_INFORMATION_ACCOUNT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_INFORMATION_ACCOUNT_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_INFORMATION_ACCOUNT_STATUS', 'MODULE_BOXES_INFORMATION_ACCOUNT_CONTENT_PLACEMENT', 'MODULE_BOXES_INFORMATION_ACCOUNT_SORT_ORDER', 'MODULE_BOXES_INFORMATION_ACCOUNT_DISPLAY_PAGES');
    }
  }
?>
