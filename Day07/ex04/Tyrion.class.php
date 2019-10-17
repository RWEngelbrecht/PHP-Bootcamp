<?php
class Tyrion extends Lannister
{
	public function sleeps($per) {
		if ($per instanceof Sansa)
			return "Let's do this.";
		else if ($per instanceof Jaime
					|| $per instanceof Cersei)
			return "Not even if I'm drunk !";
	}
}
?>
