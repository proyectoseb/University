<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
// includes placehold
$yt_temp = JFactory::getApplication()->getTemplate();
include (JPATH_BASE . '/templates/'.$yt_temp.'/includes/placehold.php');

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>

<!-- Start K2 Item Layout -->
<div class="catItemView group<?php echo ucfirst($this->item->itemGroup); ?><?php echo ($this->item->featured) ? ' catItemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">

	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>

	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>
	
	  <!-- Item Image -->
	  <div class="catItemImageBlock
		    <?php if($this->item->params->get('catItemVideo') && !empty($this->item->video)): ?>
		    me-video
	  <?php endif; ?>
	  ">
		  
		    <a href="<?php echo $this->item->link; ?>" title="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
		    	
				<?php 
					//Create placeholder items images
				
					$src = $this->item->image;
					$src_pre= $this->item->imageLarge;
					if (!empty( $src)) {								
						$thumb_img = '<img src="'.$src.'" alt="'.$this->item->title.'" />';
					} else if ($is_placehold) {					
						$thumb_img = yt_placehold($placehold_size['listing'],$this->item->title,$this->item->title);
					}	
					echo $thumb_img;
				?>
			  
		    </a>
		    <a data-rel="prettyPhoto" href="<?php echo $src_pre; ?>" class="zoom_img"></a>
		    <div class="over-image"></div>
	  </div>
	 
	<div class="main-item">
	<div class="catItemHeader">
		

	  <?php if($this->item->params->get('catItemTitle')): ?>
	  <!-- Item title -->
	  <h3 class="catItemTitle">
			<?php //if(isset($this->item->editLink)): ?>
			<!-- Item edit link 
			<span class="catItemEditLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php //echo $this->item->editLink; ?>">
					<?php //echo JText::_('K2_EDIT_ITEM'); ?>
				</a>
			</span>
		    -->
			<?php //endif; ?>

	  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
			<a href="<?php echo $this->item->link; ?>">
	  		<?php echo $this->item->title; ?>
	  	</a>
	  	<?php else: ?>
	  	<?php echo $this->item->title; ?>
	  	<?php endif;
		?>

		    
		    
	  </h3>
	  <?php endif; ?>
		<aside class="article-aside">
			<dl class="article-info  muted">
				<dt></dt>
				<!-- Date created -->
				<?php if($this->item->params->get('catItemDateCreated')): ?>
					<dd class="create"><?php echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC1')); ?></dd>		
				<?php endif; ?>
		    
				<dd class="CommentsLink">
				      <!-- Anchor link to comments below -->
				      <span class="catItemCommentsLink">
					      <?php if(!empty($this->item->event->K2CommentsCounter)): ?>
						      <!-- K2 Plugins: K2CommentsCounter -->
						      <?php echo $this->item->event->K2CommentsCounter; ?>
					      <?php else: ?>
						      <?php if($this->item->numOfComments > 0): ?>
						      <a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
							    <i class="fa fa-comments"> </i><?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
						      </a>
						      <?php else: ?>
						      <a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
							    <i class="fa fa-comments"> </i><?php echo JText::_('K2_THE_FIRST_TO_COMMENT'); ?>
						      </a>
						      <?php endif; ?>
					      <?php endif; ?>
				      </span>
					      
			      </dd>
				<!-- Item Author -->
				<?php if($this->item->params->get('catItemAuthor')): ?>
				<dd class="catItemAuthor">
					
					<?php if(isset($this->item->author->link) && $this->item->author->link): ?>
						  <span><?php echo JText::_('K2_AUTHOR_ME').' '; ?></span>
						<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name ;?></a>
						<?php else: ?>
						<?php echo $this->item->author->name; ?>
					<?php endif; ?>
				</dd>
				<?php endif; ?>
				<?php if($this->item->params->get('catItemCategory')): ?>
				<dd class="catItemCategory">
					<!-- Item category name -->
					<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
					<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
				</dd>
				<?php endif; ?>
				<?php if($this->item->params->get('catItemHits')): ?>
			      <!-- Item Hits -->
			      <dd class="catItemHitsBlock">
				      <span class="catItemHits">
					      <i class="fa fa-eye"></i><b><?php echo $this->item->hits; ?></b> <?php echo JText::_('JGLOBAL_HITS'); ?> 
					      
				      </span>
			      </dd>
			      <?php endif; ?>
			</dl>
		</aside>
		
	
		
		
		
	
  </div>

  <!-- Plugins: AfterDisplayTitle -->
  <?php echo $this->item->event->AfterDisplayTitle; ?>

  <!-- K2 Plugins: K2AfterDisplayTitle -->
  <?php echo $this->item->event->K2AfterDisplayTitle; ?>
	  
	<?php if($this->item->params->get('catItemRating')): ?>
	<!-- Item Rating -->
	<div class="catItemRatingBlock">
		<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
		<div class="itemRatingForm">
			<ul class="itemRatingList">
				<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
			</ul>
			<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

  <div class="catItemBody">
	  
	  <!-- Plugins: BeforeDisplayContent -->
	  <?php echo $this->item->event->BeforeDisplayContent; ?>

	  <!-- K2 Plugins: K2BeforeDisplayContent -->
	  <?php echo $this->item->event->K2BeforeDisplayContent; ?>

	 

	  <?php if($this->item->params->get('catItemIntroText')): ?>
	  <!-- Item introtext -->
	  <div class="catItemIntroText">
	  	<?php echo $this->item->introtext; ?>
	  </div>
	  <?php endif; ?>

	  <div class="clr"></div>

	  <?php if($this->item->params->get('catItemExtraFields') && count($this->item->extra_fields)): ?>
	  <!-- Item extra fields -->
	  <div class="catItemExtraFields">
	  	
	  	<ul>
			<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
			<?php if($extraField->value != ''): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
				<?php if($extraField->type == 'header'): ?>
				
				<?php else: ?>
				
				<div class="catItemExtraFieldsValue"><?php echo $extraField->value; ?></div>
				<?php endif; ?>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
			</ul>
	    <div class="clr"></div>
	  </div>
	  <?php endif; ?>

	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>

	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>

	  <div class="clr"></div>
	  	<?php if ($this->item->params->get('catItemReadMore')): ?>
	<!-- Item "read more..." link -->
	<div class="catItemReadMore">
		<a class="k2ReadMore button" href="<?php echo $this->item->link; ?>">
			<?php echo JText::_('K2_READ_MORE'); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="clr"></div>

	<?php if($this->item->params->get('catItemDateModified')): ?>
	<!-- Item date modified -->
	<?php if($this->item->modified != $this->nullDate && $this->item->modified != $this->item->created ): ?>
	<span class="catItemDateModified">
		<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
	</span>
	<?php endif; ?>
	<?php endif; ?>
  </div>

  <?php if(
  $this->item->params->get('catItemHits') ||
  $this->item->params->get('catItemTags') ||
  $this->item->params->get('catItemAttachments')
  ): ?>
  <div class="catItemLinks">
	  <?php if($this->item->params->get('catItemTags') && count($this->item->tags)): ?>
	  <!-- Item tags -->
	  <div class="catItemTagsBlock">
		  <span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
		  <ul class="catItemTags">
		    <?php foreach ($this->item->tags as $tag): ?>
		    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
		    <?php endforeach; ?>
		  </ul>
		  <div class="clr"></div>
	  </div>
	  <?php endif; ?>

	  <?php if($this->item->params->get('catItemAttachments') && count($this->item->attachments)): ?>
	  <!-- Item attachments -->
	  <div class="catItemAttachmentsBlock">
		  <span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
		  <ul class="catItemAttachments">
		    <?php foreach ($this->item->attachments as $attachment): ?>
		    <li>
			    <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>">
			    	<?php echo $attachment->title ; ?>
			    </a>
			    <?php if($this->item->params->get('catItemAttachmentsCounter')): ?>
			    <span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
			    <?php endif; ?>
		    </li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>

		<div class="clr"></div>
  </div>
  <?php endif; ?>
	</div>
	<div class="clr"></div>

  

  <?php if($this->item->params->get('catItemImageGallery') && !empty($this->item->gallery)): ?>
  <!-- Item image gallery -->
  <div class="catItemImageGallery">
	  <h4><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h4>
	  <?php echo $this->item->gallery; ?>
  </div>
  <?php endif; ?>

  <div class="clr"></div>

  <!-- Plugins: AfterDisplay -->
  <?php echo $this->item->event->AfterDisplay; ?>

  <!-- K2 Plugins: K2AfterDisplay -->
  <?php echo $this->item->event->K2AfterDisplay; ?>

	<div class="clr"></div>
</div>
<!-- End K2 Item Layout -->
