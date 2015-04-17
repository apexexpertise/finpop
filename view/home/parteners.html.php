<?php 
use Goteo\Library\Text;

$parteners = $this ['parteners'];

?>
<link rel="stylesheet" type="text/css"
	href="view/css/parteners/css/normalize.css" />
<link rel="stylesheet" type="text/css"
	href="view/css/parteners/css/demo.css" />
<link rel="stylesheet" type="text/css"
	href="view/css/parteners/css/component.css" />
<script src="view/css/parteners/js/modernizr.min.js"></script>
<section id="photostack-3" class="photostack animated ZoomIn">
	<h2
		style="font-family: Odin; text-transform: capitalize; font-size: 44px; font-weight: inherit; position: absolute; top: 38px; color: rgba(207, 207, 207, 0.78); text-shadow: 1px 1px white, -1px -1px #444; left: 45%;">Partenaires</h2>
	
	<div>
	<?php foreach ($parteners as $part) : ?>
		<figure>
			<a href="<?php echo $part->url?>" class="photostack-img"><img
				src="<?php echo SRC_URL."/image/".$part->image."/480/360"; ?>" alt="img05" /></a>
			<figcaption>
				<h2 class="photostack-title"><?php echo $part->name?></h2>
				<div class="photostack-back">
					<p>
						<?php echo $part->resume?>
					</p>
				</div>
			</figcaption>
		</figure>
		<?php  endforeach; ?>
	</div>
</section>
<script src="view/css/parteners/js/classie.js"></script>
<script src="view/css/parteners/js/photostack.js"></script>
<script>
			new Photostack( document.getElementById( 'photostack-3' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
</script>