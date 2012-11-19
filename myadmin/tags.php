<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'setflag':
        tep_set_specials_status($HTTP_GET_VARS['id'], $HTTP_GET_VARS['flag']);

        tep_redirect(tep_href_link(FILENAME_TAGS, (isset($HTTP_GET_VARS['page']) ? 'page=' . $HTTP_GET_VARS['page'] . '&' : '') . 'sID=' . $HTTP_GET_VARS['id'], 'NONSSL'));
        break;
      case 'insert':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $products_price = tep_db_prepare_input($HTTP_POST_VARS['products_price']);
        $specials_price = tep_db_prepare_input($HTTP_POST_VARS['specials_price']);
        $expdate = tep_db_prepare_input($HTTP_POST_VARS['expdate']);

        if (substr($specials_price, -1) == '%') {
          $new_special_insert_query = tep_db_query("select products_id, products_price from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
          $new_special_insert = tep_db_fetch_array($new_special_insert_query);

          $products_price = $new_special_insert['products_price'];
          $specials_price = ($products_price - (($specials_price / 100) * $products_price));
        }

        $expires_date = '';
        if (tep_not_null($expdate)) {
          $expires_date = substr($expdate, 0, 4) . substr($expdate, 5, 2) . substr($expdate, 8, 2);
        }

        tep_db_query("insert into " . TABLE_SPECIALS . " (products_id, specials_new_products_price, specials_date_added, expires_date, status) values ('" . (int)$products_id . "', '" . tep_db_input($specials_price) . "', now(), " . (tep_not_null($expires_date) ? "'" . tep_db_input($expires_date) . "'" : 'null') . ", '1')");

        tep_redirect(tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page']));
        break;
      case 'update':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $tags_name = tep_db_prepare_input($HTTP_POST_VARS['tags_name']);
		
        $tags_arr=explode(",", $tags_name);
        foreach ($tags_arr as $tag) {
            $flag_tag=0;
            $flag_tag_product=0;
            $tag_id=null;
             $specials_query = tep_db_query("select p.tag_id from tags p where p.tag_text='".$tag."'" );
             while ($specials = tep_db_fetch_array($specials_query)) {
                $flag_tag=1;
                $tag_id=$specials['tag_id'];
                }
                if($flag_tag==0){
                    tep_db_query("insert into tags (tag_text) values ('".$tag."')");
                }
                 $specials_query = tep_db_query("select p.tag_id from tags p where p.tag_text='".$tag."'" );
                  while ($specials = tep_db_fetch_array($specials_query)) {
                        $tag_id=$specials['tag_id'];
                }
                 $tags_query = tep_db_query("select p.tag_id from products_tags p where p.tag_id='".$tag_id."' and p.products_id='".$products_id."'" );
                  while ($specials = tep_db_fetch_array($tags_query)) {
                        $flag_tag_product=1;
                }
                 if($flag_tag_product==0){
                    tep_db_query("insert into products_tags (products_id,tag_id) values ('".$products_id."','".$tag_id."')");
                }
          
        }

        //tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '" . tep_db_input($specials_price) . "', specials_last_modified = now(), expires_date = " . (tep_not_null($expires_date) ? "'" . tep_db_input($expires_date) . "'" : 'null') . " where specials_id = '" . (int)$specials_id . "'");

        tep_redirect(tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $specials_id));
        break;
      case 'deleteconfirm':
        $specials_id = tep_db_prepare_input($HTTP_GET_VARS['sID']);
		// Tag Cloud V1.0 (fix by Sesman 05.04/2012)  smarty delete the tags associated with this product... and  tags name associated with this product...
        $tag_query = tep_db_query("select tag_id from products_tags where products_id = '" . (int)$specials_id . "'");
	 	while ($tag = tep_db_fetch_array($tag_query)) {
			$tag_id = $tag['tag_id'];
			$other_prods = tep_db_query("select products_id from products_tags where tag_id = '" . $tag_id . "' and products_id <> '" .(int)$specials_id. "'");
			if (tep_db_num_rows($other_prods)<1) {
				tep_db_query("delete from tags where tag_id = '" . $tag_id . "'");
			}
        }
        tep_db_query("delete from products_tags where products_id = '" . (int)$specials_id . "'");
		// Tag Cloud V1.0 (fix by Sesman 05.04/2012)

        tep_redirect(tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page']));
        break;
    }
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo "TAGS"; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
    $form_action = 'insert';
    if ( ($action == 'edit') && isset($HTTP_GET_VARS['sID']) ) {
      $form_action = 'update';
      
      $product_query = tep_db_query("select p.products_id, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id  = '" . (int)$HTTP_GET_VARS['sID'] . "'");
      $product = tep_db_fetch_array($product_query);

      $sInfo = new objectInfo($product);
    } else {
      $sInfo = new objectInfo(array());

// create an array of products on special, which will be excluded from the pull down menu of products
// (when creating a new product on special)
      $specials_array = array();
      $specials_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS );
      while ($specials = tep_db_fetch_array($specials_query)) {
        $specials_array[] = $specials['products_id'];
      }
    }
?>
      <tr><form name="new_special" <?php echo 'action="' . tep_href_link(FILENAME_TAGS, tep_get_all_get_params(array('action', 'info', 'sID')) . 'action=' . $form_action, 'NONSSL') . '"'; ?> method="post"><?php if ($form_action == 'update') echo tep_draw_hidden_field('products_id', $HTTP_GET_VARS['sID']); ?>
        <td><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>

              <td class="main"><strong><?php echo 'Producto :'; ?>&nbsp;</strong></td>
            <td class="main"><?php echo (isset($sInfo->products_name)) ? $sInfo->products_name  : tep_draw_products_pull_down('products_id', 'style="font-size:10px"'); ?></td>
          </tr>

        </table>

        </td>
      </tr>
       <?php $tags="";
          $tags_query = tep_db_query("select t.tag_text from tags t,products_tags p where p.tag_id=t.tag_id and p.products_id='".$sInfo->products_id."'" );
                  while ($specials = tep_db_fetch_array($tags_query)) {
                        $tags.=$specials['tag_text'].",";
                }
                $tags=substr($tags, 0, -1);
                ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
               
          <tr>

            <td class="main"><br /><?php echo 'Tags'; ?> <br /><?php echo tep_draw_input_field('tags_name');?></td>
          <script type="text/javascript">
 var t='<?php echo $tags?>';
              
              document.new_special.tags_name.value = t;
</script>

            <td class="smallText" align="right" valign="top"><br /><?php echo tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . (isset($HTTP_GET_VARS['sID']) ? '&sID=' . $HTTP_GET_VARS['sID'] : ''))); ?></td>
          </tr>
           <tr>
                    <td class="main" ><strong>Tags Notes:</strong></td>
                </tr>
                <tr>
                    <td class="main" ><strong>*</strong>Enter tags (Product keywords) followed by a comma for example: Blue, Large,</td>
                </tr>
        </table></td>
      </form></tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo "Producto"; ?></td>
                 <td class="dataTableHeadingContent" align="right"><?php echo "Acción"; ?>&nbsp;</td>
              </tr>
<?php
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price , p.products_model , p.products_date_added from " . TABLE_PRODUCTS . " p,  " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'  order by pd.products_name";
    $specials_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $specials_query_raw, $specials_query_numrows);
    $specials_query = tep_db_query($specials_query_raw);
    while ($specials = tep_db_fetch_array($specials_query)) {
      if ((!isset($HTTP_GET_VARS['sID']) || (isset($HTTP_GET_VARS['sID']) && ($HTTP_GET_VARS['sID'] == $specials['products_id']))) && !isset($sInfo)) {
        $products_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$specials['products_id'] . "'");
        $products = tep_db_fetch_array($products_query);
        $sInfo_array = array_merge($specials, $products);
        $sInfo = new objectInfo($sInfo_array);
      }

      if (isset($sInfo) && is_object($sInfo) && ($specials['products_id'] == $sInfo->products_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $sInfo->products_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $specials['products_id']) . '\'">' . "\n";
      }
?>
                <td  class="dataTableContent"><?php echo $specials['products_name']; ?></td>

                <td class="dataTableContent" align="right"><?php if (isset($sInfo) && is_object($sInfo) && ($specials['products_id'] == $sInfo->products_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
      </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $specials_split->display_count($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
                    <td class="smallText" align="right"><?php echo $specials_split->display_links($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<strong>Delete</strong>');

      $contents = array('form' => tep_draw_form('specials', FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $sInfo->products_id . '&action=deleteconfirm'));
      $contents[] = array('text' => 'It erases all the tags associated with this product and delete tags name associated with this product');
      $contents[] = array('text' => '<br /><strong>' . $sInfo->products_name . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $sInfo->products_id)));
      break;
    default:
      if (is_object($sInfo)) {
          $tags="";
          $tags_query = tep_db_query("select t.tag_text from tags t,products_tags p where p.tag_id=t.tag_id and p.products_id='".$sInfo->products_id."'" );
                  while ($specials = tep_db_fetch_array($tags_query)) {
                        $tags.=$specials['tag_text'].",";
                }
        $heading[] = array('text' => '<strong>' . $sInfo->products_name . '</strong>');

        $contents[] = array('align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $sInfo->products_id . '&action=edit')) . tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link(FILENAME_TAGS, 'page=' . $HTTP_GET_VARS['page'] . '&sID=' . $sInfo->products_id . '&action=delete')));
        $contents[] = array('text' => '<br />Release Date ' . tep_date_short($sInfo->products_date_added));
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_info_image($sInfo->products_image, $sInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));
        $contents[] = array('text' => '<br />Precio ' . $currencies->format($sInfo->products_price));

        $contents[] = array('text' => '<br />Tags : <strong>' . $tags . '</strong>');
      }
      break;
  }
  
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
}
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
