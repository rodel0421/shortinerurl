<?php if($messages->count() > 0):?>
<style>
    
.news_tricker{
  /*  margin-top: -10px;
    margin-bottom: 5px;*/
}
.main-sidebar, .left-side {
    padding-top: 75px;
}
.main-header {
    max-height: 125px;
}
div.box-ticker {
    box-shadow: 0 1px 1px rgba(96,92,168,0.5);
    background-color: #FFF !important;
    min-height: 28px;
}
.tickercontainer { 
/*border: 1px solid #000;
background: #fff; */
width: 100%; 
height: 28px; 
margin: 0; 
padding: 0;
overflow: hidden;
}
.tickercontainer .mask { 
position: relative;
left: 0;
top: 4px;
width: 100%;
overflow: hidden;
}
ul.newsticker { 
position: relative;
left: 100%;
list-style-type: none;
margin: 0;
padding: 0;
}
ul.newsticker li {
float: left; 
margin: 0;
padding: 0;
}
ul.newsticker a {
white-space: nowrap;
padding: 0;
color: #ff0000;
font: bold 12px Verdana;
margin: 0 50px 0 0;
} 
ul.newsticker span {
margin: 0 10px 0 0;
} 
ul.newsticker .title {
white-space: nowrap;
padding: 0;
color: #888;
font: bold 12px Verdana;
margin: 0 50px 0 0;
} 
</style>
<div class="box-ticker noprint hidden-xs">
<div class="news_tricker">
<ul id="ticker">
    <li><span class='title'>Notice Board: </span></li>
    <?php foreach ($messages as $message): ?>
    <li><span><?= h($message->created) ?></span> <a href='<?= $this->Url->build(['plugin' => null,'controller'=>'Messages','action' => 'view',$message->id])?>' class='btnPreview'><?= h($message->title) ?></a></li>
    <?php endforeach;?>
</ul>
</div>
</div>
<script type="text/javascript"> 
    
$(function(){
    $("ul#ticker").liScroll();
});

//<![CDTA[
/*!
 * liScroll 1.0
 * Examples and documentation at: 
 * http://www.gcmingati.net/wordpress/wp-content/lab/jquery/newsticker/jq-liscroll/scrollanimate.html
 * 2007-2010 Gian Carlo Mingati
 * Version: 1.0.2.1 (22-APRIL-2011)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires:
 * jQuery v1.2.x or later
 * 
 */


jQuery.fn.liScroll = function(settings) {
		settings = jQuery.extend({
		travelocity: 0.07
		}, settings);		
		return this.each(function(){
				var $strip = jQuery(this);
				$strip.addClass("newsticker")
				var stripWidth = 1;
				$strip.find("li").each(function(i){
				stripWidth += jQuery(this, i).outerWidth(true); // thanks to Michael Haszprunar and Fabien Volpi
				});
				var $mask = $strip.wrap("<div class='mask'></div>");
				var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
				var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
				$strip.width(stripWidth);			
				var totalTravel = stripWidth+containerWidth;
				var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
				function scrollnews(spazio, tempo){
				$strip.animate({left: '-='+ spazio}, tempo, "linear", function(){$strip.css("left", containerWidth); scrollnews(totalTravel, defTiming);});
				}
				scrollnews(totalTravel, defTiming);				
				$strip.hover(function(){
				jQuery(this).stop();
				},
				function(){
				var offset = jQuery(this).offset();
				var residualSpace = offset.left + stripWidth;
				var residualTime = residualSpace/settings.travelocity;
				scrollnews(residualSpace, residualTime);
				});			
		});	
};
//]]>
</script>
<?php endif;?>