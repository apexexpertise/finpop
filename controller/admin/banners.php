<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *  This file is part of Goteo.
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

namespace Goteo\Controller\Admin {

    use Goteo\Core\View,
        Goteo\Core\Redirection,
        Goteo\Core\Error,
		Goteo\Library\Message,
		Goteo\Library\Feed,
		Goteo\Library\Text,
        Goteo\Model;
    

    class Banners {

        public static function process ($action = 'list', $id = null, $filters = array(), $flag = null) {

            $errors = array();

            $node = isset($_SESSION['admin_node']) ? $_SESSION['admin_node'] : \GOTEO_NODE;
            $model = 'Goteo\Model\banner';
            $url = '/admin/banners';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // objeto
                $banner = new Model\Banner(array(
                    'id' => $_POST['id'],
                    'node' => $node,
                    'project' => $_POST['project'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'url' => $_POST['url'],
                    'order' => $_POST['order'],
                    'active' => $_POST['active']
                ));

                // imagen
                if(!empty($_FILES['image']['name'])) {
                    $banner->image = $_FILES['image'];
                } else {
                    $banner->image = $_POST['prev_image'];
                }

				if ($banner->save($errors)) {
                    Message::Info('Datos guardados');
                    if ($_POST['action'] == 'add') {
                        $projectData = Model\Project::getMini($_POST['project']);

                        // Evento Feed 
                        $log = new Feed();
                        $log->setTarget($projectData->id);
                        $log->populate('nouvelle banni&egrave;re du projet pr&eacute;sent&eacute; sur la couverture (admin)', '/admin/promote',
                            \vsprintf('El admin %s ha %s', array(
                            Feed::item('user', $_SESSION['user']->name, $_SESSION['user']->id),
                            Feed::item('relevant', 'Publicado un banner', '/')
                        )));
                        $log->doAdmin('admin');
                        unset($log);
                    }

                    throw new Redirection('/admin/banners');
				}
				else {
                    Message::Error(implode('<br />', $errors));
                    
                    switch ($_POST['action']) {
                      case 'add':
                            return new View(
                                'view/admin/index.html.php',
                                array(
                                    'folder' => 'banners',
                                    'file' => 'edit',
                                    'banner' => $banner,
                                    'status' => $status
                                )
                            );
                            break;
                            
                         
                        	
                    }
				}
			}

            switch ($action) {
                case 'active':
                    $set = $flag == 'on' ? true : false;
                    Model\Banner::setActive($id, $set);
                    throw new Redirection('/admin/banners');
                    break;
                case 'up':
                    Model\Banner::up($id, $node);
                    throw new Redirection('/admin/banners');
                    break;
                case 'down':
                    Model\Banner::down($id, $node);
                    throw new Redirection('/admin/banners');
                    break;
                case 'remove':
                    if (Model\Banner::delete($id)) {
                        Message::Info('Banner quitado correctamente');
                    } else {
                        Message::Error('No se ha podido quitar el banner');
                    }
                    throw new Redirection('/admin/banners');
                    break;
                    
                    
                    
                    
                case 'add':
                    // siguiente orden
                    $next = Model\Banner::next($node);

                    return new View(
                        'view/admin/index.html.php',
                        array(
                            'folder' => 'banners',
                            'file' => 'edit',
                            'action' => 'add',
                            'banner' => (object) array('order' => $next),
                            'status' => $status
                        )
                    );  
                    break; 
                    
                    
                case 'edit':
                    
                	

                    if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])) {
                    	 
                    	// instancia
                    	$item = new $model(array(
                    			'id' => $_POST['id'],
                    			
                    			'project' => $_POST['project'],
                    			'active' => $_POST['active'],
                    			'node' => $_POST['node'],
                    			'image' => $_POST['image'],
                    			'title' => $_POST['title'],
                    			'order' => $_POST['order'],
                    			'description' => $_POST['description'],
                    			'url'=> $_POST['url']
                    			
                    	));
                    	
                    	
                    	
                    	// tratar si quitan la imagen
                    	$current = $_POST['image']; // la actual
                    	if (isset($_POST['image-' . $current .  '-remove'])) {
                    		$image = Model\Image::get($current);
                    		$image->remove('banner');
                    		$item->image = '';
                    		$removed = true;
                    	}
                    
                    	// tratar la imagen y ponerla en la propiedad image
                    	if(!empty($_FILES['image']['name'])) {
                    		$item->image = $_FILES['image'];
                    	}
                    
                    	if ($item->save($errors)) {
                    		Message::Info(Text::_('Datos grabados correctamente'));
                    		throw new Redirection($url);
                    	} else {
                    		Message::Error(Text::_('No se ha grabado correctamente. ') . implode(', ', $errors));
                    	}
                    } else {
                  	$item = $model::get($id,null);
                    }
                    
                     
                     
                    return new View(
                    
                    		'view/admin/index.html.php',
                    
                    		array('folder' => 'base',
                    				'file' => 'edit',
                    				'data' => $item,
                    				'form' => array(
                    						'action' => "$url/edit/$id",
                    						'submit' => array(
                    								'name' => 'update',
                    								'label' => Text::get('regular-save')
                    
                    						),
                    						'fields' => array (
                    								'id' => array(
                    										'label' => '',
                    										'name' => 'id',
                    										'type' => 'hidden'
                    
                    								),
                    								'node' => array(
                    										'label' => '',
                    										'name' => 'node',
                    										'type' => 'hidden'
                    
                    								),
                    								'description' => array(
                    										'label' => Text::_('Description'),
                    										'name' => 'description',
                    										'type' => 'textarea'
                    								),
                    								'title' => array(
                    										'label' => Text::_('Titre du projet'),
                    										'name' => 'title',
                    										'type' => 'text'
                    								),
                    								'url' => array(
                    										'label' => Text::_('lien'),
                    										'name' => 'url',
                    										'type' => 'text',
                    										'properties' => 'size=100'
                    										
                    										
                    								),
                    								
                    								'order' => array(
                    										'label' => Text::_('Ordre de baniiere'),
                    										'name' => 'order',
                    										'type' => 'text'
                    										),
                    								
                    								'active' => array(
                    										'label' => Text::_('statut de banniere'),
                    										'name' => 'active',
                    										'type' => 'text'
                    								),
                    								'image' => array(
                    										'label' => Text::_('image banniere'),
                    										'name' => 'image',
                    										'type' => 'image'
                    								),
                    								
                    						)
                    
                    				)
                    		)
                    );
                    
                    break;
                   
                   
            }
            
            
            
            
            
            


       //  $bannered = Model\Banner::getAll(false, $node);

        return new View(
                'view/admin/index.html.php',
                array( 
                    'folder' => 'base',
                    'file' => 'list',
                    'model' => 'banner',
                    'addbutton' => 'Nouvelle Banniere',
                    'data' => model\banner::getAll(),
                    'columns' => array(
                        'edit' => '',
                        'title' => 'titre',
                     'active' => 'etat',
                        'order' => 'ordre',             
                //     'url' => 'Enlace',
                         'image' => 'image',
                         'up' => '',
                         'down' => '',
                      //  'translate' => '',
                          'remove' => ''
                    ),
                 'url' => "$url"
                )
            );
            
        }

    }

}