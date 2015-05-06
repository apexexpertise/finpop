<?php
namespace Goteo\Model {

	use \Goteo\Model\Project\Media,
	\Goteo\Model\Image,
	\Goteo\Library\Text,
	\Goteo\Library\Message;

	class DeptRatio extends \Goteo\Core\Model {
		public
		$income_borrower,
		$month_income_borrower,
		$others_income,
		$credit_in_progress1,
		$credit_in_progress2,
		$credit_in_progress3,
		$credit_in_progress4,
		$credit_in_progress5,
		$credit_in_progress6,
		$paid_support,	
		$others_expenses;
		
		
		public function calculate () {
			if($this->others_income=="")
				$this->others_income="0";
			if($this->paid_support=="")
				$this->paid_support="0";
			if($this->others_expenses=="")
				$this->others_expenses="0";
			if($this->credit_in_progress1=="")
				$this->credit_in_progress1="0";
			if($this->credit_in_progress2=="")
				$this->credit_in_progress2="0";
			if($this->credit_in_progress3=="")
				$this->credit_in_progress3="0";
			if($this->credit_in_progress4=="")
				$this->credit_in_progress4="0";
			if($this->credit_in_progress5=="")
				$this->credit_in_progress5="0";
			if($this->credit_in_progress6=="")
				$this->credit_in_progress6="0";
			$total_income= (intval($this->income_borrower) * intval($this->month_income_borrower)+intval($this->others_income));
			$total_expenses=(
					intval($this->paid_support)+intval($this->others_expenses)+intval($this->credit_in_progress1)
					+intval($this->credit_in_progress2)+intval($this->credit_in_progress3)+intval($this->credit_in_progress4)+
					intval($this->credit_in_progress5)+intval($this->credit_in_progress6)) * intval($this->month_income_borrower);
			return (($total_expenses/ $total_income)* 100);
			
			
		}
		public static function get ($id) {
			return true;
		}
	
	public function save (&$errors = array()) {
		return true;
	}
	public static function delete () {
		return true;
	}
	public function validate (&$errors = array()) {
		return true;
	}
}
}
?>