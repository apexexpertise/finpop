<?php

/*
 * Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
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
	Goteo\Model;
	
	class Deptratio extends \Goteo\Core\Controller{
		
	   public function index() {
	   	$url='/deptratio/';
	   	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   	
	   		// instancia
	   		$deptratio = new Model\Deptratio(array(
	   				
	   				'income_borrower' => $_POST['income_borrower'],
	   				'month_income_borrower' => $_POST['month_income_borrower'],
	   				'others_income'=> $_POST['others_income'],
	   				'credit_in_progress1'=> $_POST['credit_in_progress1'],
	   				'credit_in_progress2'=> $_POST['credit_in_progress2'],
	   				'credit_in_progress3'=> $_POST['credit_in_progress3'],
	   				'credit_in_progress4'=> $_POST['credit_in_progress4'],
	   				'credit_in_progress5'=> $_POST['credit_in_progress5'],
	   				'credit_in_progress6'=> $_POST['credit_in_progress6'],
	   				'paid_support'=> $_POST['paid_support'],
	   				'others_expenses'=> $_POST['others_expenses']
	   		));
	   		$resultat=$deptratio->calculate();
	   		if($resultat <= 33)
	   			$message="Vous pouvez pr&ecirc;ter de l&apos;argent";
	   		else 
	   			$message="Vous &ecirc;tes endett&eacute;";
	   	
	   		
			return new View ( 'view/deptratio/count.html.php', array ( 'folder' => 'deptratio',
                            'file' => 'edit',
                            'action' => $_POST['action'],
                            'deptratio' => $deptratio,
							'resultat' => $resultat,
                            'message' => $message) );
		}
	   
	   else {
	   
	   		
	   	
	   
			return new View ( 'view/deptratio/count.html.php', array ( 'folder' => 'deptratio',
                            'file' => 'edit',
                            'action' => 'edit',
                            'deptratio' => $deptratio,
                            'resultat' => $resultat) );
		}
	} }
	
}
   
