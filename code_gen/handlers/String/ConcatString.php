<?php

class ConcatString extends Handler {

	use ArrayAddressMode, BinaryOperator, ResizeResult;
	
	public function getOperandType($i) {
		switch($i) {
			case 1: return $this->operandType;
			case 2: return "U32";
			case 3: return "U08";
		}
	}
	
	public function getOperandAddressMode($i) {
		switch($i) {
			case 1: return "ARR";
			case 2: return "CON";
			case 3: return "ARR";
		}
	}
	
	public function getActionOnUnitData() {
		$lines[] = "res_ptr += qb_resize_array(cxt, local_storage, op2, *res_count_ptr + op1_count);";
		$lines[] = "memcpy(res_ptr + *res_count_ptr, op1_ptr, op1_count);";
		$lines[] = "*res_count_ptr += op1_count;";
		return $lines;
	}
}

?>