<?php
class Color
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	static $verbose = false;

	public function __construct($vals){
		if (is_array($vals)){
			$this->red = $vals['red'];
			$this->green = $vals['green'];
			$this->blue = $vals['blue'];
		}
		else if (!is_array($vals)){
			$val_array = explode($vals);
			
		}

	}
	// static function doc(){
	// 	return ();
	// }
}

$color_vals = array("red"=>"14", "green"=>"12", "blue"=>"8");

$color = new Color($color_vals);
// Color::__construct($color_vals);
var_dump($color);
?>
