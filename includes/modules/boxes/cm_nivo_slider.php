<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2011 osCommerce

  Released under the GNU General Public License
*/

  class cm_nivo_slider {
    var $code = 'cm_nivo_slider';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_nivo_slider() {
      $this->title = MODULE_BOXES_NIVO_SLIDER_TITLE;
      $this->description = MODULE_BOXES_NIVO_SLIDER_DESCRIPTION;
      $this->box_title = MODULE_BOXES_NIVO_SLIDER_BOX_TITLE;

      if ( defined('MODULE_BOXES_NIVO_SLIDER_STATUS') ) {
        $this->sort_order = MODULE_BOXES_NIVO_SLIDER_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_NIVO_SLIDER_STATUS == 'True');
        $this->pages = MODULE_BOXES_NIVO_SLIDER_DISPLAY_PAGES;
				$this->group = ((MODULE_BOXES_NIVO_SLIDER_CONTENT_PLACEMENT == 'Content Top Set Block') ? 'box_top_content_set' : 'box_bottom_content_set');
      }
    }

    function execute() {
	  global $oscTemplate;
	  $data = '';
	  $execute = false;
	  
	// select banners_group to be used
	  $new_banner_search = tep_build_banners_group(BANNER_SLIDER);
	  $sql = "select banners_id from " . TABLE_BANNERS . " where status = 1 " . $new_banner_search; // " order by banners_sort_order";
	  $banners_query = tep_db_query($sql);
	// if no active banner in the specified banner group then the box will not show
	  $banner_cnt = 0;
	  while ($banners_all = tep_db_fetch_array($banners_query)) {
		$banner_cnt++;
		$banner = tep_banner_exists('dynamic', BANNER_SLIDER);
		$data1 .= ''.tep_display_banner('static', $banners_all['banners_id']).'';
		$execute = true;		
	  }
	   $data .= '
		<script type="text/javascript">
		$(window).load(function() {
		  $(\'#slider\').nivoSlider ({
				effect:\''.EFFECT_NIVO.'\', 
				slices:'.SLICES_NIVO.',
				boxCols: '.BOX_COLS.',
				boxRows: '.BOX_ROWS.',				
				animSpeed:'.SDELAY_NIVO.',
				pauseTime:'.DELAY_NIVO.',
				startSlide:'.START_SLIDE.', //Set starting Slide (0 index)
				directionNav:'.NAVIGATION_NIVO.', //Next & Prev
				directionNavHide:'.DIRECTIONNAVHIDE.', //Only show on hover
				controlNav:'.CONTROLNAV_NIVO.', //1,2,3...
				controlNavThumbs:false, //Use thumbnails for Control Nav
				controlNavThumbsFromRel:false, //Use image rel for thumbs
				controlNavThumbsSearch: \'.jpg\', //Replace this with...
				controlNavThumbsReplace: \'_thumb.jpg\', //...this in thumb Image src
				keyboardNav:true, //Use left & right arrows
				pauseOnHover:'.HOVERPAUSE_NIVO.', //Stop animation while hovering
				manualAdvance:false, //Force manual transitions
				captionOpacity:0.8, //Universal caption opacity
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){}, //Triggers after all slides have been shown
				prevText: \''.PREV_NIVO.'\',
				nextText: \''.NEXT_NIVO.'\'
			});
		});

		</script>
	   	<div class="nivoSlider_wrapper"><div id="slider" class="nivoSlider">'.$data1.'</div></div>';
	  	  
	  if($execute){
      	$oscTemplate->addBlock($data, $this->group);
	  }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_NIVO_SLIDER_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Content Coin Slider Module', 'MODULE_BOXES_NIVO_SLIDER_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_NIVO_SLIDER_CONTENT_PLACEMENT', 'Content Top Set Block', 'The module should be loaded in the Content Top Set Block or Content Bottom Set Block only', '6', '1', 'tep_cfg_select_option(array(\'Content Top Set Block\', \'Content Bottom Set Block\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_NIVO_SLIDER_SORT_ORDER', '9020', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_NIVO_SLIDER_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_NIVO_SLIDER_STATUS', 'MODULE_BOXES_NIVO_SLIDER_CONTENT_PLACEMENT', 'MODULE_BOXES_NIVO_SLIDER_SORT_ORDER', 'MODULE_BOXES_NIVO_SLIDER_DISPLAY_PAGES');
    }
  }
  // code by Seaman
?>