<?php 
use Goteo\Library\Text;

$news = $this['news'];

?>
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/jquery.sky.carousel.min.js"></script>
<link type="text/css"
	href="<?php echo SRC_URL ?>/view/css/sky.carousel.css" rel="stylesheet"
	media="all" />
<h2 style="padding: 15px 74px 24px; text-align: center;">
	<i class="fa fa-newspaper-o fa-2x"
		style="vertical-align: middle; padding-right: 22px;"></i>Dans la presse
</h2>

<div id="presskit" class="sky-carousel">
	<div class="sky-carousel-wrapper">
		<ul class="sky-carousel-container">
	<?php foreach ($news as $new) : ?>
	<li><img src="<?php echo SRC_URL."/image/".$new->logo."/280/280"; ?>" alt="" />
				<div class="sc-content">
				<h2><?php echo $new->title?></h2>
					<p><?php echo $new->description?></p>
				</div></li>
			<?php  endforeach; ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$('#presskit').carousel({
		itemWidth: 300, // The width of your view/css/images.
		itemHeight: 450, // The height of your view/css/images.
		distance:20,
		autoSlideshow:true,
		selectByClick:true,
		enableMouseWheel:false,
		topMargin:120
	});
	
	</script>