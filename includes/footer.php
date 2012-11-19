<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require(DIR_WS_INCLUDES . 'counter.php');
?>



        <div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>">
            <div class="footer">
<?php 
    if (($oscTemplate->hasBlocks('boxes_footer')))	{
		echo $oscTemplate->getBlocks('boxes_footer'); ?>
<?php 
	}
?> 
                <!--<div class="cl_both"></div>-->
                <p><?php echo FOOTER_TEXT_BODY; ?><b>&nbsp; <a href="<?php echo tep_href_link('privacy.php')?>"><?php echo ITEM_INFORMATION_PRIVACY?></a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo tep_href_link('conditions.php')?>"><?php echo ITEM_INFORMATION_CONDITIONS?></a></b><?php if ($current_page == FILENAME_DEFAULT){?>  <!-- {%FOOTER_LINK} --><?php } ?></p>	
            </div>   
</div>
<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
        	<div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>" style="text-align: center; padding-bottom: 20px;">
          		<?php echo tep_display_banner('static', $banner); ?>
        	</div>
<?php
  }
?>
			</div>
<script type="text/javascript">
$('.productListTable tr:nth-child(even)').addClass('alt');
</script>
