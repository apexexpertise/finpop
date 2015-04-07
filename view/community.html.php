<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Library\Text,
    Goteo\Core\View;

include 'view/prologue.html.php';
include 'view/header.html.php';
?>
<div id="sub-header" style="padding: 160px;background: url('../view/css/images/activity_bg.jpg');background-repeat: no-repeat;background-size: cover;">
</div>
<div class="container">
	    <?php if ($this['show'] == 'activity') : /* ahora el feed*/ ?>
	    	<div class="row clearfix">
				<div class="col-md-12 column">
	        		<?php echo new View('view/community/feed.html.php', $this) ?>
	        	</div>
	        </div>
	    <?php /* Hasta aqui el feed*/ else : /*a ahora sharemates global*/ ?>
	        <div class="row clearfix">
				<div class="col-md-8 column">
	           		 <?php echo new View('view/community/sharemates.html.php', $this) ?>
	       		 </div>
	       		<div class="col-md-4 column">
	            	<?php echo new View('view/community/investors.html.php', $this) ?>
	        	</div>
	        </div>
	    <?php /* Hasta qui sharemates global */ endif; ?>
</div>
<?php include 'view/footer.html.php' ?>
<?php include 'view/epilogue.html.php' ?>