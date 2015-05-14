<?php
use Goteo\Library\Text,
    Goteo\Model\Invest;

$filters = $this['filters'];

$emails = Invest::emails(true);
?>
<div class="container">
		<div class="row">
		<div class="col-md-12 column">
 <div class="title-admin">
<p>R&eacute;compenses  </p>
		<hr />
		</div>
<div class="widget board">
    <h3 class="title">Filtres</h3>
    <form id="filter-form" action="/admin/rewards" method="get">
        <div class="form-group col-lg-4">
            <label for="projects-filter">Projet</label><br />
            <select id="projects-filter" name="project" onchange="document.getElementById('filter-form').submit();" class="form-control">
                <option value="">Tous les projets</option>
            <?php foreach ($this['projects'] as $itemId=>$itemName) : ?>
                <option value="<?php echo $itemId; ?>"<?php if ($filters['project'] === (string) $itemId) echo ' selected="selected"';?>><?php echo $itemName; ?></option>
            <?php endforeach; ?>
            </select>
      
       
            <label for="name-filter">Alias/Email d'utilisateur:</label><br />
            <input type="text" id ="name-filter" name="name" value ="<?php echo $filters['name']?>" class="form-control" />

            <label for="status-filter">Affichage par la r&eacute;compense d'&eacute;tat:</label><br />
            <select id="status-filter" name="status"class="form-control">
                <option value="">Tous</option>
            <?php foreach ($this['status'] as $statusId=>$statusName) : ?>
                <option value="<?php echo $statusId; ?>"<?php if ($filters['status'] == $statusId) echo ' selected="selected"';?>><?php echo $statusName; ?></option>
            <?php endforeach; ?>
            </select>
       
            <input type="submit" value="Filtrer" class="btn btn-primary" style="margin-top:10px;float:right;"/>
        </div>
    </form>
    <br clear="both" />
    <a href="/admin/rewards/?reset=filters">Retirer les filtres</a>
</div>

<div class="widget board">
<?php if ($filters['filtered'] != 'yes') : ?>
    <p>Vous avez besoin de mettre des filtres, trop de dossiers!</p>
<?php elseif (!empty($this['list'])) : ?>
    <table class="table table-hover">
        <thead>
            <tr class="active">
                <th></th>
                <th>Coofinanceur</th>
                <th>Projet</th>
                <th>R&eacute;componse</th>
                <th>&eacute;tat</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['list'] as $reward) : ?>
            <tr>
                <td><a href="/admin/rewards/edit/<?php echo $reward->invest ?>" >[Modifier]</a></td>
                <td><a href="/admin/users/manage/<?php echo $reward->user ?>" target="_blank" title="<?php echo $reward->name; ?>"><?php echo $reward->email; ?></a></td>
                <td><a href="/admin/projects/?name=<?php echo $this['projects'][$reward->project] ?>" target="_blank"><?php echo Text::recorta($this['projects'][$reward->project], 20); if (!empty($invest->campaign)) echo '<br />('.$this['calls'][$invest->campaign].')'; ?></a></td>
                <td><?php echo $reward->reward_name ?></td>
                <?php if (!$reward->fulfilled) : ?>
                    <td style="color: red;" >Pente</td>
                    <td><a href="<?php echo "/admin/rewards/fulfill/{$reward->invest}"; ?>">[Marque accomplie]</a></td>
                <?php else : ?>
                    <td style="color: green;" >Compliment</td>
                    <td><a href="<?php echo "/admin/rewards/unfill/{$reward->invest}"; ?>">[Marque pente]</a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
<?php else : ?>
    <p>Aucune contribution qui r&eacute;pondent le filtre.</p>
<?php endif;?>
</div>
</div>
</div>
</div>