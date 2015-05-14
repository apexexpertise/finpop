<?php
use Goteo\Library\Text,
    Goteo\Library\Feed;

$feed = $this['feed'];
$items = $this['items'];
?>
 <div class="title-admin">
<p >Activit&eacute;s Recentes </p>
		<hr/>
		</div>
<div class="widget feed">
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.scroll-pane').jScrollPane({showArrows: true});

            $('.hov').hover(
              function () {
                $(this).addClass($(this).attr('rel'));
              },
              function () {
                $(this).removeClass($(this).attr('rel'));
              }
            );

        });
        </script>
      	
     <p class="text-info">  Voir RSS par:
      
            <?php 
                foreach (Feed::_admin_types() as $id=>$cat) : ?>
            <a href="/admin/recent/?feed=<?php echo $id ?>" <?php echo ($feed == $id) ? 'class="'.$cat['color'].'"': 'class="hov" rel="'.$cat['color'].'"' ?>><?php echo $cat['label'] ?></a>
            <?php endforeach; ?>
          
        </p>

        <div class="scroll-pane">
            <?php foreach ($items as $item) :
                $odd = !$odd ? true : false;
                ?>
                <div class="well">  
                <blockquote>
                  <div class="content-pub"><strong><?php echo $item->html; ?></strong></div>    
 <span class="datepub"><small><?php echo Text::get('feed-timeago', $item->timeago); ?></small></span>
             
</blockquote>        
                    
            </div>
            <?php endforeach; ?>
        </div>
</div>

