<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 *
 * INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)

values ('Enable Tag Module', 'MODULE_BOXES_TAG_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());# 1 row(s) affected.



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)
values ('Content Placement', 'MODULE_BOXES_TAG_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now());# 1 row(s) affected.



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)
values ('Sort Order', 'MODULE_BOXES_TAG_SORT_ORDER', '4080', 'Sort order of display. Lowest is displayed first.', '6', '0', now());# 1 row(s) affected.
 *
 *
 * buscar en la base de datos este registro y editarlo agregandole en el configuration_value un ;(punto y coma) deguido del modulo bm_tag.php
 *
 *
 * INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_BOXES_INSTALLED', 'bm_categories.php;bm_manufacturers.php;bm_search.php;bm_whats_new.php;bm_information.php;bm_shopping_cart.php;bm_manufacturer_info.php;bm_order_history.php;bm_best_sellers.php;bm_product_notifications.php;bm_product_social_bookmarks.php;bm_specials.php;bm_reviews.php;bm_languages.php;bm_currencies.php', 'List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());

 */

  class bm_tag {
    var $code = 'bm_tag';
    var $group = 'boxes';
    var $title;
    var $description='show tags';
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function bm_tag() {
      $this->title = MODULE_BOXES_TAG_TITLE;
      $this->description = MODULE_BOXES_TAG_DESCRIPTION;

      if ( defined('MODULE_BOXES_TAG_STATUS') ) {
           
        $this->sort_order = MODULE_BOXES_TAG_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_TAG_STATUS == 'True');
        $this->pages = MODULE_BOXES_TAG_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_TAG_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $HTTP_GET_VARS, $languages_id, $currencies, $oscTemplate;

            $data = '<div class="infoBoxWrapper box6">' . tep_draw_box_wrapper_top() . '
                    <div class="infoBoxHeading">' . tep_draw_box_title_top() . '<a href="' . tep_href_link(FILENAME_TAG) . '">'.MODULE_BOXES_TAG_BOX_TITLE.'</a>' . tep_draw_box_title_bottom() . '</div>
                    <div class="infoBoxContents">' . tep_draw_box_content_top() . '

<ul id="stringball">';
            
           $specials_query = tep_db_query("select p.tag_id,p.tag_text from tags p order by tag_text limit " . MODULE_BOXES_TAG_MAX_RANDOM_SELECT_TAGS );
             while ($specials = tep_db_fetch_array($specials_query)) {

                  $data.= '<li><a href="' . tep_href_link(FILENAME_TAG_PRODUCTS) .'?id_tag='.$specials['tag_id'].'">'.$specials['tag_text'].'</a></li>';
                }

	$data.='</ul>

<script type="text/javascript">
$(function(){
	$("ul#stringball").stringball({
		camd:900,
		radi:220,
		speed:1
	});
});
</script>
                    ' . tep_draw_box_content_bottom() . '</div>
					' . tep_draw_box_wrapper_bottom() . '</div>';

          $oscTemplate->addBlock($data, $this->group);
      
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_TAG_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Specials Module', 'MODULE_BOXES_TAG_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_TAG_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_TAG_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_TAG_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_TAG_STATUS', 'MODULE_BOXES_TAG_CONTENT_PLACEMENT', 'MODULE_BOXES_TAG_SORT_ORDER', 'MODULE_BOXES_TAG_DISPLAY_PAGES');
    }
  }
?>
