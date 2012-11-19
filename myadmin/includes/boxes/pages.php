<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_PAGES);

  $configuration2_groups_query = tep_db_query("select configuration2_group_id as cg2ID, configuration2_group_title as cg2Title from " . TABLE_CONFIGURATION2_GROUP . " where visible = '1' order by sort_order");
  while ($configuration2_groups = tep_db_fetch_array($configuration2_groups_query)) {
    $cl_box_groups[sizeof($cl_box_groups)-1]['apps'][] = array(
      'code' => FILENAME_CONFIGURATION2,
      'title' => $configuration2_groups['cg2Title'],
      'link' => tep_href_link(FILENAME_CONFIGURATION2, 'gID=' . $configuration2_groups['cg2ID'])
    );
  }
?>
