<?php
class Fighter
{
	private $unitType;

	public function __construct($type) {
		if (!strstr($type, "crippled")) {
			$this->unitType = $type;
		}
		else {
			trigger_error("UnholyFactory would not accept \"$type\"", E_USER_ERROR);
		}

	}

	public function __get($var) {
		if ($var == "type") {
			return $this->unitType;
		}
	}

	public function fight($target) {
		if ($this->unitType == "foot soldier") {
			print("* draws his sword and runs towards $target *".PHP_EOL);
		}
		else if ($this->unitType == "archer") {
			print("* shoots arrows at $target *".PHP_EOL);
		}
		else if ($this->unitType == "assassin") {
			print("* creeps behind $target and stabs at it *".PHP_EOL);
		}
	}
}
?>
