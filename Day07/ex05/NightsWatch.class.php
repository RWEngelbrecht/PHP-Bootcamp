<?php
class NightsWatch implements IFighter
{
	private $recruits = array();

	public function recruit($per) {
		$this->recruits[] = $per;
	}
	public function fight() {
		foreach ($this->recruits as $rec) {
			if (method_exists(get_class($rec), 'fight'))
				$rec->fight();
		}
	}
}
?>
