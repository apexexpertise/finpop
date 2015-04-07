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

use Goteo\Library\Text; ?>
<div class="project-menu container">
    <ul class="nav nav-tabs">
        <?php
        foreach (array(
            'home'        => '<i class="fa fa-cogs margin-right" style="font-size: 16px;position: relative;top: 1px;"></i>'.Text::get('project-menu-home'),
            'needs'       => '<i class="fa fa-eur margin-right" style="font-size: 16px;position: relative;top: 1px;"></i>'.Text::get('project-menu-needs'),
            'supporters'  => '<i class="fa fa-users margin-right" style="font-size: 16px;position: relative;top: 1px;"></i>'.Text::get('project-menu-supporters').' <span class="badge pull-right margin-left">'.$this['supporters'].'</span>',
            'messages'    => '<i class="fa fa-envelope-o margin-right" style="font-size: 16px;position: relative;top: 1px;"></i>'.Text::get('project-menu-messages').' <span class="badge pull-right margin-left">'.$this['messages'].'</span>',
            'updates'     => '<i class="fa fa-newspaper-o margin-right" style="font-size: 16px;position: relative;top: 1px;"></i>'.Text::get('project-menu-updates').' <span class="badge pull-right margin-left">'.$this['updates'].'</span>'
        ) as $id => $show): ?>        
        <li class="<?php echo $id ?><?php if ($this['show'] == $id) echo ' activated' ?>">
        	<a href="/project/<?php echo htmlspecialchars($this['project']->id) ?>/<?php echo $id ?>"><?php echo $show ?></a>
        </li>
        <?php endforeach ?>        
    </ul>
</div>
