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


namespace Goteo\Model {
	

	class Newsletter extends \Goteo\Core\Model {

		public
		$id,
		$email;
	

		/*
		 *  
		 */
		public static function get ($id) {
			$sql = static::query("
                    SELECT
                        id,
                        email                     
                    FROM newsletter
                    
                    WHERE id = :id
                    ", array(':id' => $id));
			$newsletter = $sql->fetchObject(__CLASS__);

			return $newsletter;
		}

		public function validate (&$errors = array()) {
			if (empty($this->email))
				$errors[] = Text::_('Falta email');
		
			if (empty($errors))
				return true;
			else
				return false;
		}
	  public function save (&$errors = array()) {
           if (!$this->validate($errors)) return false;

            $fields = array(
                'id',
                'email'
            
                );

            $set = '';
            $values = array();

            foreach ($fields as $field) {
                if ($set != '') $set .= ", ";
                $set .= "`$field` = :$field ";
                $values[":$field"] = $this->$field;
            }

            try {
                $sql = "REPLACE INTO newsletter SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                return true;
            } catch(\PDOException $e) {
                $errors[] = Text::_("No se ha guardado correctamente. ") . $e->getMessage();
                return false;
            }
        }
        
        public function exist($email){
        	
        	$query = "SELECT email FROM newsletter WHERE email like '".$email."'";
        	
        	$result=mysql_query($query);
        	
        	if (mysql_num_rows($result) != 0)
        	{
        		
        		 return true;
        	}
        	 
        	else
        	{
        	
        		return false;
        	}
        	
        }

	}

}