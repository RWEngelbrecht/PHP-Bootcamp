<?php
class Jaime extends Lannister
{
	public function sleeps($per) {
		if ($per instanceof Sansa)
			return "Let's do this.";
		else if ($per instanceof Cersei)
			return "With pleasure, but only in a tower in Winterfell, then.";
		else if ($per instanceof Tyrion)
			return "Not even if I'm drunk !";
	}
}
?>
