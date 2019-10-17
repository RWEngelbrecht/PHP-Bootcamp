<?php
class UnholyFactory
{
	private $absorbed= array();

	public function absorb($unit) {
		if (is_subclass_of($unit, 'Fighter'))
		{
			$type = $unit->__get('type');
			if (empty($this->absorbed)) {
				print("(Factory absorbed a fighter of type $type)".PHP_EOL);
				$this->absorbed[] = $type;
			}
			else if (in_array($type, $this->absorbed)) {
				print("(Factory already absorbed a fighter of type $type)".PHP_EOL);
			}
			else if (!in_array($type, $this->absorbed)) {
				print("(Factory absorbed a fighter of type $type)".PHP_EOL);
				$this->absorbed[] = $type;
			}
		}
		else {
			print("(Factory can't absorb this, it's not a fighter)".PHP_EOL);
		}
	}

	public function fabricate($unitType) {
		if (in_array($unitType, $this->absorbed)) {
			print("(Factory fabricates a fighter of type $unitType)".PHP_EOL);
			$unit = new Fighter($unitType);
			return $unit;
		}
		else if (!in_array($type, $this->absorbed)) {
			print("(Factory hasn't absorbed any fighter of type $unitType)".PHP_EOL);
		}
	}
}
?>
