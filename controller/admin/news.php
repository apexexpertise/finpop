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
		Goteo\Library\Text,
		Goteo\Library\Feed,
        Goteo\Model;

    class News {

        public static function process ($action = 'list', $id = null) {

            $model = 'Goteo\Model\News';
            $url = '/admin/news';

            $errors = array();

            switch ($action) {
                case 'add':
                    return new View(
                        'view/admin/index.html.php',
                        array(
                            'folder' => 'base',
                            'file' => 'edit',
                            'data' => (object) array('order' => $model::next()),
                            'form' => array(
                                'action' => "$url/edit/",
                                'submit' => array(
                                'class'=> 'btn btn-primary',
                                'style'=> 'float:right',
                                    'name' => 'update',
                                    'label' => 'Ajouter'
                                ),
                                'fields' => array (
                                    'id' => array(
                                        'label' => '',
                                        'name' => 'id',
                                        'type' => 'hidden'

                                    ),
                                    'title' => array(
                                        'label' => 'Notice',
                                        'name' => 'title',
                                        'type' => 'text',
                                        'class'=> 'form-control',
                                        'properties' => 'size="100" maxlength="100"'
                                    ),
                                    'description' => array(
                                        'label' => 'Description',
                                        'name' => 'description',
                                        'type' => 'textarea',
                                        'class'=> 'form-control',
                                        'properties' => 'cols="100" rows="2"'
                                    ),
                                    'logo' => array(
                                    		'label' => Text::_('Logo'),
                                    		'name' => 'logo',
                                    		'class'=> 'form-control',
                                    		'type' => 'image'
                                    ),
                                    'url' => array(
                                        'label' => 'Lien',
                                        'name' => 'url',
                                        'type' => 'text',
                                        'class'=> 'form-control',
                                        'properties' => 'size=100'
                                    ),
                                    'order' => array(
                                        'label' => 'Position',
                                        'name' => 'order',
                                        'class'=> 'form-control',
                                        'type' => 'text'
                                    )
                                )

                            )
                        )
                    );

                    break;
                case 'edit':

                    // gestionar post
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
                        // instancia
                        $item = new $model(array(
                            'id'          => $_POST['id'],
                            'title'       => $_POST['title'],
                            'description' => $_POST['description'],
                            'logo'        => $_POST['logo'],
                            'url'         => $_POST['url'],
                            'order'       => $_POST['order']
                        ));

                        // tratar si quitan la imagen
                        $current = $_POST['logo']; // la actual
                        if (isset($_POST['logo-' . $current .  '-remove'])) {
                        	$image = Model\Image::get($current);
                        	$image->remove('news');
                        	$item->logo = '';
                        	$removed = true;
                        }
                      
                        
                        // tratar la imagen y ponerla en la propiedad image
                        if(!empty($_FILES['logo']['name'])) {
                        	$item->logo = $_FILES['logo'];
                        }
                        
                        
                        
                        if ($item->save($errors)) {

                            if (empty($_POST['id'])) {
                                // Evento Feed
                                $log = new Feed();
                                $log->populate('nueva micronoticia (admin)', '/admin/news', \vsprintf('El admin %s ha %s la micronoticia "%s"', array(
                                    Feed::item('user', $_SESSION['user']->name, $_SESSION['user']->id),
                                    Feed::item('relevant', 'Publicado'),
                                    Feed::item('news', $_POST['title'], '#news'.$item->id)
                                )));
                                $log->doAdmin('admin');
                                unset($log);
                            }

                            throw new Redirection($url);
                        } else {
                            Message::Error(implode('<br />', $errors));
                        }
                    } else {
                        $item = $model::get($id);
                    }

                    return new View(
                        'view/admin/index.html.php',
                        array(
                            'folder' => 'base',
                            'file' => 'edit',
                            'data' => $item,
                            'form' => array(
                                'action' => "$url/edit/$id",
                                'submit' => array(
                                	'class'=> 'btn btn-primary',
                                	'style'=> 'float:right',
                                    'name' => 'update',
                                    'label' => Text::get('regular-save')
                                ),
                                'fields' => array (
                                    'id' => array(
                                        'label' => '',
                                        'name' => 'id',
                                        'type' => 'hidden'

                                    ),
                                    'title' => array(
                                        'label' => 'Noticia',
                                        'name' => 'title',
                                        'type' => 'text',
                                    		'class'=> 'form-control',
                                        'properties' => 'size="100"  maxlength="80"'
                                    ),
                                    'description' => array(
                                        'label' => 'Entradilla',
                                        'name' => 'description',
                                        'type' => 'textarea',
                                    	'class'=> 'form-control',
                                        'properties' => 'cols="100" rows="2"'
                                    ),
                                    'logo' => array(
                                	    'label' => Text::_('Logo'),
                                		'name' => 'logo',
                                    		'class'=> 'form-control',
                                		'type' => 'image'
                                    		
                                		),
                                    'url' => array(
                                        'label' => 'Enlace',
                                        'name' => 'url',
                                        'type' => 'text',
                                    		'class'=> 'form-control',
                                        'properties' => 'size=100'
                                    ),
                                    'order' => array(
                                        'label' => 'Posición',
                                        'name' => 'order',
                                    		'class'=> 'form-control',
                                        'type' => 'text'
                                    )
                                )

                            )
                        )
                    );

                    break;
                case 'up':
                    $model::up($id);
                    break;
                case 'down':
                    $model::down($id);
                    break;
                case 'remove':
                    $tempData = $model::get($id);
                    if ($model::delete($id)) {
                        // Evento Feed
                        $log = new Feed();
                        $log->populate('micronoticia quitada (admin)', '/admin/news',
                            \vsprintf('El admin %s ha %s la micronoticia "%s"', array(
                                Feed::item('user', $_SESSION['user']->name, $_SESSION['user']->id),
                                Feed::item('relevant', 'Quitado'),
                                Feed::item('blog', $tempData->title)
                        )));
                        $log->doAdmin('admin');
                        unset($log);

                        throw new Redirection($url);
                    }
                    break;
            }

            return new View(
                'view/admin/index.html.php',
                array(
                	'name'=>'Journaux',
                    'folder' => 'base',
                    'file' => 'list',
                    'model' => 'news',
                    'addbutton' => 'Nouveau journal',
                    'data' => $model::getAll(false,true),
                    'columns' => array(
                        'edit' => '',
                        'title' => 'Nom',
                    	'description' => 'Description',
                        'logo' => 'Logo',             
//                        'url' => 'Enlace',
                         'order' => 'Position',
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
