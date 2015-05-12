<?php 
use Goteo\Library\Text;

$news = $this['news'];

?>
<script type="text/javascript"
	src="<?php echo SRC_URL ?>/view/js/jquery.sky.carousel.min.js"></script>
<link type="text/css"
	href="<?php echo SRC_URL ?>/view/css/sky.carousel.css" rel="stylesheet"
	media="all" />
	
<div class="content-press">	
<div class="row clearfix">
<h2 style="font-family: Open Sans Semibold;text-align:center;color:white;font-size: 36px;">Dans la presse</h2><hr style="height: 3px; width: 88px; color: #0387f3; background-color: #0387f3;"></hr></div>

<div id="presskit" class="sky-carousel">
	<div class="sky-carousel-wrapper">
		<ul class="sky-carousel-container">
	<?php foreach ($news as $new) : ?>
	
	<li style=" background-image:url('view/css/owlcarrousel/img/presskit.png');" class="past">
	
	<img src="<?php echo SRC_URL."/image/".$new->logo."/250/250"; ?>" alt="" />
				<div class="sc-content">
				<h2><?php echo $new->title?></h2>
			    <p><?php echo $new->description?></p>
				</div></li>
			<?php  endforeach; ?>
		</ul>
	</div>
</div></div>
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