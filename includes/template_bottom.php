<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
?>
                
<?php 
            if (($oscTemplate->hasBlocks('box_bottom_content_set')))	{
?>
				<?php echo $oscTemplate->getBlocks('box_bottom_content_set'); ?>
<?php
			}
?>

			</div>

			 <!-- bodyContent //-->
           
<?php
  if (($oscTemplate->hasBlocks('boxes_column_left'))) {
?>
                <div id="columnLeft" class="grid_<?php echo $oscTemplate->getGridColumnWidth(); ?> <?php echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'pull_' . $oscTemplate->getGridContentWidth() : ''); ?>">
                  <div><?php echo $oscTemplate->getBlocks('boxes_column_left'); ?></div>
                </div>
<?php 
}
?>

<?php
  if ($oscTemplate->hasBlocks('boxes_column_right')) {
?>

                <div id="columnRight" class="grid_<?php echo $oscTemplate->getGridColumnWidth(); ?>">
                  <div><?php echo $oscTemplate->getBlocks('boxes_column_right'); ?></div>
                </div>

<?php
  }
?>
    		
    		
    </div>    
</div>    
<!--	 bodyWrapper //-->	                  
        <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?> row_5">
<?php 
            if (($oscTemplate->hasBlocks('boxes_above_footer')))	{
?>                                
			<div class="boxes_above_footer"><?php echo $oscTemplate->getBlocks('boxes_above_footer'); ?></div>
<?php
			}
?>
			<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        </div>
        
       
    
	
</div>

	<?php echo $oscTemplate->getBlocks('footer_scripts'); ?>
    <!--[if lt IE 9]>
      <link href="css/ie_style.css" rel="stylesheet" type="text/css" />
    <![endif]-->
  <script type="text/javascript" src="ext/js/imagepreloader.js"></script>
  <script type="text/javascript">
		preloadImages([
		//	'images/user_menu.gif',
			'images/bg_list.png',
			'images/hover_bg.png',
			'images/nivo-nav.png',
		// 'images/nivo-nav.png',									
			'images/menu_item-act.gif',
			'images/wrapper_pic.png',
			'images/wrapper_pic-act.png']);
	</script>
</body>
</html>
