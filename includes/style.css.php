<style type="text/css">
.nivoSlider_wrapper {
	width: <?php echo NIVO_SLAIDER_WIDTH;?>px; height: <?php echo NIVO_SLAIDER_HEIGHT;?>px; /* Set the size */
}
#screenshot img								{ width:<?php echo SUPERFISH_IMAGE_WIDTH;?>px;height:<?php echo SUPERFISH_IMAGE_HEIGHT;?>px;}
#screenshotCategory img				{ width:<?php echo LIST_IMAGE_WIDTH;?>px;height:<?php echo LIST_IMAGE_HEIGHT;?>px;}
</style>
<?php
if	(BANNER_TITLE_NIVO == 'false')	{
?>
<style type="text/css">
	.nivo-caption 					{display:none !important;}
</style>
<?php	
}else{
?>
<style type="text/css">
	.nivo-controlNav				{bottom:50px !important;}
</style>
<?php	
}
?>