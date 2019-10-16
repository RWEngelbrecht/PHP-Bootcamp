<?php
class Color
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	static $verbose = false;

	public function __construct($vals){
		if (is_array($vals) && isset($vals['red']) && isset($vals['green']) && isset($vals['blue'])) {
			$this->red = intval($vals['red']);
			$this->green = intval($vals['green']);
			$this->blue = intval($vals['blue']);
		}
		else if (isset($vals['rgb'])){
			$rgb = intval($vals['rgb']);
			$this->red = $rgb / 65281 % 255;
			$this->green = $rgb / 256 % 256;
			$this->blue = $rgb % 256;
		}
		if (Self::$verbose == true){
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
		}
	}

	function __destruct(){
		if (Self::$verbose == true)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
	}

	function __toString(){
		return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )", array($this->red, $this->green, $this->blue)));
	}

	public function add($Color){
		return (new Color(array('red'=>$this->red + $Color->red, 'green'=>$this->green + $Color->green, 'blue'=>$this->blue + $Color->blue)));
	}

	public function sub($Color){
		return (new Color(array('red'=>$this->red - $Color->red, 'green'=>$this->green - $Color->green, 'blue'=>$this->blue - $Color->blue)));
	}

	public function mult($f){
		return (new Color(array('red'=>$this->red * $f, 'green'=>$this->green * $f, 'blue'=>$this->blue * $f)));
	}

	public static function doc(){
		$file = fopen("../ex00/Color.doc.txt", 'r');
		while ($file && !feof($file)) {
			$line = fgets($file);
			echo $line;
		}
		echo "\n";
	}
}
?>
