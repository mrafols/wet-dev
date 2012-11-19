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
if (($oscTemplate->hasBlocks('box_welcome')) || ($oscTemplate->hasBlocks('boxes_under_header')))	{
?>
    	<div class="row_2 ofh"> 
          <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?>"> 
                 <!-- <div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>">-->
<?php
											if ($oscTemplate->hasBlocks('boxes_under_header'))	{                  
													echo $oscTemplate->getBlocks('boxes_under_header');
													echo '<div class="cl_both"></div>';
											}
?>
                			<?php echo $oscTemplate->getBlocks('box_welcome'); ?>
 									<!--</div>-->
            </div>
		</div>        
<?php
}
?>                  
