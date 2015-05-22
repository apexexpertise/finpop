<?php

/*
 * Copyright (C) 2012 Platoniq y FundaciÃ³n Fuentes Abiertas (see README for details)
 * This file is part of Goteo.
 *
 * Goteo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Goteo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Goteo. If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */
namespace Goteo\Controller {

	use Goteo\Core\View, 
	Goteo\Core\Redirection, 
	Goteo\Core\Error, 
	Goteo\Library\Message, 
	Goteo\Model,
	Goteo\Library\Text;
	
	class Newsletter {
		
	   public function index() {
	   	$url='/newsletter/';
	   	$model = 'Goteo\Model\Newsletter';
	   	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   	
	   		$newsletter = new Model\Newsletter(array(	   				
	   				'email' => $_POST['email'],		
	   		));
	   		$email=$_POST['email'];
	   		if(isset($_POST['email'])){
	   		if(!$newsletter->exist($email)){
	   			
	     	 $newsletter->save($errors);
                        
              $message = 'Pour valider votre inscription à la newsletter de MonSite.fr, <a href="http://www.monsite.fr/inscription.php?tru=1&amp;email='.$email.'">cliquez ici</a>.';
              $objet = "Inscription à la newsletter de FinPop.fr" ;  
              $headers .= 'From: amal.sghaier.if@gmail.com' . "\r\n";
              mail($_POST['email'], $objet, $message, $headers);
             // throw new Redirection($url);
                       
	   		}

		}}
	   
	  
	} }
	
}
   