<?php

class BoundCheckLessThanPredicateAdd extends Handler {

	use ScalarAddressMode, QuaternaryOperator, MayEmitError;

	public function changesOperand($i) {
		return ($i == 4 || $i == 5);
	}
	
	public function getOperandType($i) {
		switch($i) {
			case 1: return "U32";		// index
			case 2: return "U32";		// dimension (i.e. the limit)
			case 3: return "U32";		// offset
			case 4: return "I32";		// predicate
			case 5: return "U32";		// result (index + offset)
		}
	}
	
	protected function getActionOnUnitData() {
		$lines = array();
		$lines[] = "res = op1 + op3;";
		$lines[] = "if(UNEXPECTED(!(op1 < op2))) {";
		$lines[] = 		"op4 = FALSE;";
		$lines[] = "}";
		return $lines;
	}
}

?>