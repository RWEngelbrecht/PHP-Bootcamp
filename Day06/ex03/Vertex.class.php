<?php
require_once 'Color.class.php';
class Vertex
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1;
	private $_color;
	static $verbose = false;

	public function __construct($xyzw) {
		$this->_x = $xyzw['x'];
		$this->_y = $xyzw['y'];
		$this->_z = $xyzw['z'];
		if (isset($xyzw['w']) && !empty($xyzw['w'])) {
			$this->_w = $xyzw['w'];
		}
		if (isset($xyzw['color']) && $xyzw['color'] instanceof Color) {
			$this->_color = $xyzw['color'];
		}
		else {
			$this->color = new Color(array('red'=>255, 'green'=>255, 'blue'=>255));
		}
		if (Self::$verbose == true) {
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue);
		}
	}

	function __destruct() {
		if (Self::$verbose == true)
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue);
	}

	function __toString() {
		if (Self::$verbose)
			return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->color->red, $this->color->green, $this->color->blue)));
		return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
	}

	public function get_x() {
		return $this->_x;
	}

	public function get_y() {
		return $this->_y;
	}

	public function get_z() {
		return $this->_z;
	}

	public function get_w() {
		return $this->_w;
	}

	public function get_color() {
		return $this->_color;
	}

	public function set_x($x) {
		return $this->_x = $x;
	}

	public function set_y($y) {
		return $this->_y = $y;
	}

	public function set_z($z) {
		return $this->_z = $z;
	}

	public function set_w($w) {
		return $this->_w = $w;
	}

	public function set_color($color) {
		return $this->_color = $color;
	}

	public static function doc() {
		$file = fopen("Vertex.doc.txt", 'r');
		while ($file && !feof($file)) {
			$line = fgets($file);
			echo $line;
		}
	}
}


?>
