<?php
class House
{
	public function introduce() {
		$house = $this->getHouseName();
		$seat = $this->getHouseSeat();
		$motto = $this->getHouseMotto();
		print("House $house of $seat : \"$motto\"".PHP_EOL);
	}
}
?>
