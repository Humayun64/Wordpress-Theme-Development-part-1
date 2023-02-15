<?php 


add_shortcode('gallery', 'make_gallery');

function make_gallery($attr, $content){

	$att = shortcode_atts(array(
		'ids' => ''
	), $attr);

	extract($att);

	$idd = explode(',', $ids);


	ob_start(); ?>
	<div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
		<ul class="slides">
			<?php foreach($idd as $id) : ?>

				<?php $image = wp_get_attachment_image_src($id, 'full'); ?>


				<li><img src="<?php echo $image[0]; ?>" /></li>
			<?php endforeach; ?>
		</ul>
	</div>
 
	<?php return ob_get_clean();
}