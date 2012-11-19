<?php
/*
  sql_setup_related_products.php
  SQL Setup Utility For Optional Related Products, Ver 4.0

  Copyright (c) 2007 Anita Cross (http://www.callofthewildphoto.com/)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $contrib = 'Related Products';
  $filename = FILENAME_RELATED_PRODUCTS;

  function install_ORP_to_sql($gid = 0) {
    $old_table_name = tep_db_fetch_array(tep_db_query("SHOW TABLES LIKE 'products_options_products'"));
    if (tep_not_null($old_table_name)) {
      tep_db_query("RENAME TABLE products_options_products TO products_related_products");
    }
    $insert_relationship_table = "CREATE TABLE IF NOT EXISTS `products_related_products` (
      `pop_id` int(11) NOT NULL auto_increment,
      `pop_products_id_master` int(11) NOT NULL default '0',
      `pop_products_id_slave` int(11) NOT NULL default '0',
      `pop_order_id` smallint(6) NOT NULL default '0',
      PRIMARY KEY  (`pop_id`)
    ) TYPE=MyISAM;";
    tep_db_query($insert_relationship_table);
    if (!$gid) {
      tep_db_query("INSERT INTO `configuration_group` VALUES ( '', 'Related Products', 'Optional Related Products module', '999', '1' )");
      $set_group_id = tep_db_insert_id();
    } else {
      $set_group_id = $gid;
    }
    tep_db_query("INSERT INTO `configuration`
                  VALUES ('', 'Current Version', 'RELATED_PRODUCTS_VERSION_INSTALLED', '4.0', 'This key is used by the SQL install to automatically update your database during upgrades. It is read only.', " . $set_group_id . ", '0', NULL, now(), NULL , 'tep_version_readonly('),
                         ('', 'Display Thumbnail Images', 'RELATED_PRODUCTS_SHOW_THUMBS', 'True', 'Show Product Image', " . $set_group_id . ", '1', NULL, now(), NULL , 'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Display Product Name', 'RELATED_PRODUCTS_SHOW_NAME', 'True', 'Show Product Name', " . $set_group_id . ", 2, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Display Product Model', 'RELATED_PRODUCTS_SHOW_MODEL', 'False', 'Show Product Model', " . $set_group_id . ", 3, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Display Price', 'RELATED_PRODUCTS_SHOW_PRICE', 'True', 'Show Product Price', " . $set_group_id . ", 4, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Display Quantity Available', 'RELATED_PRODUCTS_SHOW_QUANTITY', 'False', 'Show Product Quantity', " . $set_group_id . ", 5, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Display Buy Now Button', 'RELATED_PRODUCTS_SHOW_BUY_NOW', 'False', 'Show Buy Now Button', " . $set_group_id . ", 6, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Split Display Into Rows','RELATED_PRODUCTS_USE_ROWS','False','Set this option to True to display Related Products in multiple rows.'," . $set_group_id . ", 7,NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Define Number of Items Per Row','RELATED_PRODUCTS_PER_ROW','3','Maximum number of items to display per row when Split Display Into Rows is set to True.'," . $set_group_id . ", 8,NULL, now(),NULL,''),
                         ('', 'Define Number of Items to Display', 'RELATED_PRODUCTS_MAX_DISP', '0', 'Maximum number of Related Products to display. 0 is unlimited.', " . $set_group_id . ", 9, NULL, now(),NULL,''),
                         ('', 'Use Random Display Order', 'RELATED_PRODUCTS_RANDOMIZE', 'False', 'Adds random sort order to products displayed. Recommended if maximum number of products is set.', " . $set_group_id . ", 10, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Admin Display: Maximum Rows', 'RELATED_PRODUCTS_MAX_ROW_LISTS_OPTIONS', '10', 'Sets the maximum number of rows to display per page.', " . $set_group_id . ", 11, NULL, now(),NULL,''),
                         ('', 'Admin Display: Drop-Down List Maximum Length', 'RELATED_PRODUCTS_MAX_NAME_LENGTH', '25', 'Sets the maximum length (in characters) of product name displayed in drop-down lists. Enter \'0\' to set this option to false.', " . $set_group_id . ", 12, NULL, now(),NULL,''),
                         ('', 'Admin Display: Display List Maximum Length', 'RELATED_PRODUCTS_MAX_DISPLAY_LENGTH', '0', 'Sets the maximum length (in characters) of product name displayed in list. Enter \'0\' to set this option to false.', " . $set_group_id . ", 13, NULL, now(),NULL,''),
                         ('', 'Admin Display: Use Product Model', 'RELATED_PRODUCTS_ADMIN_USE_MODEL', 'False', 'Uses Product Model in lists. When Product Name is also selected, Product Model is displayed first.', " . $set_group_id . ", 14, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Admin Display: Use Product Name', 'RELATED_PRODUCTS_ADMIN_USE_NAME', 'True', 'Uses Product Name in lists. When Product Model is also selected, Product Model is displayed first.', " . $set_group_id . ", 15, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Admin Display: Combine Model and Name separator', 'RELATED_PRODUCTS_ADMIN_MODEL_SEPARATOR', ': ', 'Enter the characters you would like to separate Model from Name, when using both. Leave empty if only using Model.', " . $set_group_id . ", 16, NULL, now(),NULL,''),
                         ('', 'Admin Function: Use Delete Confirmation', 'RELATED_PRODUCTS_CONFIRM_DELETE', 'True', 'When set to True, a confirmation box will pop-up when deleting an association. Set to False to Delete without confirmation.', " . $set_group_id . ", 17, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
                         ('', 'Admin Function: Combine Insert with Inherit', 'RELATED_PRODUCTS_INSERT_AND_INHERIT', 'True', 'When set to True, clicking on Inherit will also Insert the product association. When False, Inherit works as before.', " . $set_group_id . ", 18, NULL, now(),NULL,'tep_cfg_select_option(array(\'True\', \'False\'),')
                        ");
  }

  function get_group_id($config_title) {
    $group_id_array = tep_db_fetch_array(tep_db_query("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title like '". $config_title . "'"));
    if (sizeof($group_id_array <= 1)) {
      return $group_id_array['configuration_group_id'];
    }
    remove_group_id($contrib);
    return 0;
  }

  function remove_keys($gid) {
    if (tep_not_null($gid)) {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . (int)$gid . "'");
    } else {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", keys()) . "')");
    }
  }

  function remove_group_id($title) {
      tep_db_query("delete from " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = '" . $title . "'");
  }

  function remove_table() {
      tep_db_query("DROP TABLE IF EXISTS `products_related_products`");
  }

  function keys() {
    $keys = array();
    $keys[] = 'RELATED_PRODUCTS_VERSION_INSTALLED';
    $keys[] = 'MODULE_RELATED_PRODUCTS_SHOW_THUMBS';
    $keys[] = 'RELATED_PRODUCTS_SHOW_THUMBS';
    $keys[] = 'RELATED_PRODUCTS_SHOW_NAME';
    $keys[] = 'RELATED_PRODUCTS_SHOW_MODEL';
    $keys[] = 'RELATED_PRODUCTS_SHOW_PRICE';
    $keys[] = 'RELATED_PRODUCTS_SHOW_QUANTITY';
    $keys[] = 'RELATED_PRODUCTS_SHOW_BUY_NOW';
    $keys[] = 'RELATED_PRODUCTS_USE_ROWS';
    $keys[] = 'RELATED_PRODUCTS_PER_ROW';
    $keys[] = 'RELATED_PRODUCTS_MAX_DISP';
    $keys[] = 'RELATED_PRODUCTS_RANDOMIZE';
    $keys[] = 'RELATED_PRODUCTS_MAX_ROW_LISTS_OPTIONS';
    $keys[] = 'RELATED_PRODUCTS_MAX_NAME_LENGTH';
    $keys[] = 'RELATED_PRODUCTS_MAX_DISPLAY_LENGTH';
    $keys[] = 'RELATED_PRODUCTS_ADMIN_USE_MODEL';
    $keys[] = 'RELATED_PRODUCTS_ADMIN_USE_NAME';
    $keys[] = 'RELATED_PRODUCTS_ADMIN_MODEL_SEPARATOR';
    $keys[] = 'RELATED_PRODUCTS_CONFIRM_DELETE';
    $keys[] = 'RELATED_PRODUCTS_INSERT_AND_INHERIT';
    return $keys;
  }

  switch ($HTTP_GET_VARS['install']) {
    case ('new'):
      install_ORP_to_sql();
      tep_redirect(tep_href_link($filename));
      break;
    case ('remove'):
      $group_id = get_group_id($contrib);
      remove_keys($group_id);
      remove_group_id($contrib);
      remove_table();
      tep_redirect(tep_href_link($filename));
      break;
    case ('upgrade'):
      $group_id = get_group_id($contrib);
      remove_keys($group_id);
      install_ORP_to_sql($group_id);
      tep_redirect(tep_href_link($filename));
      break;
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<style>
.intro_section {padding:20px 20px 0px 20px;}
.intro_section p {width:590px;}
.intro_section b {font-size:.8em;font-weight:bold;color:#900;}
.setup_section {width:600px;border:solid 1px black;margin:10px;padding:3px 3px 10px 3px;}
.setup_section p {margin:10px;padding:3px}
</style>
<span class="pageHeading"><?php echo HEADING_TITLE_ORP; ?></span>
<form name="new_install" action="<?php echo tep_href_link('sql_setup_related_products.php'); ?>" method="get">
              <div class="setup_section">
                <span class="pageHeading"><?php echo SECTION_TITLE_NEW_INSTALL; ?></span>
<p><?php echo SECTION_DESCRIPTION_NEW_INSTALL; ?></p>
                <p><?php echo tep_draw_hidden_field('install', 'new') . tep_image_submit('button_new_install_sql.gif', IMAGE_BUTTON_NEW_INSTALL_SQL); ?></p>
</div>
</form>

<form name="update_install" action="<?php echo tep_href_link('sql_setup_related_products.php'); ?>" method="get">
              <div class="setup_section">
                <span class="pageHeading"><?php echo SECTION_TITLE_UPGRADE; ?></span>
<p><?php echo SECTION_DESCRIPTION_UPGRADE; ?></p>
                <p><?php echo tep_draw_hidden_field('install', 'upgrade') . tep_image_submit('button_upgrade_sql.gif', IMAGE_BUTTON_UPGRADE_SQL); ?></p>
</div>
            </form>
            
<form name="update_install" action="<?php echo tep_href_link('sql_setup_related_products.php'); ?>" method="get">
              <div class="setup_section">
                <span class="pageHeading"><?php echo SECTION_TITLE_REMOVE; ?></span>
<p><?php echo SECTION_DESCRIPTION_REMOVE; ?></p>
                <p><?php $param = 'onclick="var x=confirm(\''. TEXT_CONFIRM_REMOVE_SQL . '\')"';
                          echo tep_draw_hidden_field('install', 'remove')
                             . tep_image_submit('button_remove_sql.gif', IMAGE_BUTTON_REMOVE_SQL, $param); ?></p>
</div>
            </form>                  
<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>