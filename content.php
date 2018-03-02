<article id="post-<?php the_ID();?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php trungkien_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php trungkien_entry_header(); ?>
		<?php trungkien_entry_meta(); ?>
	</div>
	<div class="entry-content">
		<?php trungkien_entry_content(); ?>
		<?php ( is_single() ? trungkien_entry_tag() : '' ); ?>
	</div>
</article>