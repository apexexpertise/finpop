<?php
use Goteo\Library\Text,
    Goteo\Library\Feed;

$feed = $this['feed'];
$items = $this['items'];
?>
<p style="padding-left:20px;color:#555555;font-family:Myriad Pro Regular;;font-size:29px;">Historiques </p>
		<hr style="width:2000px;margin-top:25px;"/>
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
        <h3 class="title">Activit&eacute; r&eacute;cente</h3>
        Voir RSS par:

        <p class="categories">
            <?php 
                foreach (Feed::_admin_types() as $id=>$cat) : ?>
            <a href="/admin/recent/?feed=<?php echo $id ?>" <?php echo ($feed == $id) ? 'class="'.$cat['color'].'"': 'class="hov" rel="'.$cat['color'].'"' ?>><?php echo $cat['label'] ?></a>
            <?php endforeach; ?>
        </p>

        <div class="scroll-pane">
            <?php foreach ($items as $item) :
                $odd = !$odd ? true : false;
                ?>
            <div class="subitem<?php if ($odd) echo ' odd';?>">
               <span class="datepub"><?php echo Text::get('feed-timeago', $item->timeago); ?></span>
               <div class="content-pub"><?php echo $item->html; ?></div>
            </div>
            <?php endforeach; ?>
        </div>

</div>
