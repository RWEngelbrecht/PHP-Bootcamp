<?php
class Matrix
{
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	protected $matrix = array();
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;

	static $verbose = false;

	public function __construct($arr = null) {
		if (isset($arr)) {
			if (isset($arr['preset'])) {
				$this->_preset = $arr['preset'];
			}
			if (isset($arr['scale'])){
				$this->_scale = $arr['scale'];
			}
			if (isset($arr['angle'])) {
				$this->_angle = $arr['angle'];
			}
			if (isset($arr['vtc'])) {
				$this->_vtc = $arr['vtc'];
			}
			if (isset($arr['fov'])) {
				$this->_fov = $arr['fov'];
			}
			if (isset($arr['ratio'])) {
				$this->_ratio = $arr['ratio'];
			}
			if (isset($arr['near'])) {
				$this->_near = $arr['near'];
			}
			if (isset($arr['far'])) {
				$this->_far = $arr['far'];
			}
			if (!$this->checkPreset())
				trigger_error("Oh no! Something went wrong!", E_USER_ERROR);
			$this->makeMatrix();
			if (Self::$verbose) {
				if ($this->_preset == Self::IDENTITY)
					print("Matrix IDENTITY instance constructed".PHP_EOL);
				else
					print("Matrix ".$this->_preset." preset instance constructed".PHP_EOL);
			}
			$this->makeMatrixType();
		}
	}

	private function checkPreset() {
		if (empty($this->_preset)) {
			return false;
		}
		if ($this->_preset == "SCALE" && empty($this->_scale)) {
			return false;
		}
		if (($this->_preset == Self::RX || $this->_preset == Self::RY
				|| $this->_preset == Self::RZ) && empty($this->_angle)) {
			return false;
		}
		if ($this->_preset == "TRANSLATION" && empty($this->_vtc)) {
			return false;
		}
		if ($this->_preset == "PROJECTION" &&
			(empty($this->_fov) || empty($this->_near) || empty($this->_far))) {
			return false;
		}
		return true;
	}

	private function makeMatrix() {
		for ($i = 0; $i < 16; $i++) {
			$this->matrix[$i] = 0;
		}
	}

	private function makeMatrixType() {
		if ($this->_preset == "IDENTITY")
			$this->makeIdentity(1);
		else if ($this->_preset == "SCALE")
			$this->makeIdentity($this->_scale);
		else if ($this->_preset == Self::RX)
			$this->makeRotX();
		else if ($this->_preset == Self::RY)
			$this->makeRotY();
		else if ($this->_preset == Self::RZ)
			$this->makeRotZ();
		else if ($this->_preset == "TRANSLATION")
			$this->makeTranslation();
		else if ($this->_preset == "PROJECTION")
			$this->makeProjection();
	}

	private function makeIdentity($scale) {
		$this->matrix[0] = $scale;
		$this->matrix[5] = $scale;
		$this->matrix[10] = $scale;
		$this->matrix[15] = 1;
	}

	private function makeRotX() {
		$this->makeIdentity(1);
		$this->matrix[5] = cos($this->_angle);
		$this->matrix[6] = -sin($this->_angle);
		$this->matrix[9] = sin($this->_angle);
		$this->matrix[10] = cos($this->_angle);
	}

	private function makeRotY() {
		$this->makeIdentity(1);
		$this->matrix[0] = cos($this->_angle);
		$this->matrix[2] = sin($this->_angle);
		$this->matrix[8] = -sin($this->_angle);
		$this->matrix[10] = cos($this->_angle);
	}

	private function makeRotZ() {
		$this->makeIdentity(1);
		$this->matrix[0] = cos($this->_angle);
		$this->matrix[1] = -sin($this->_angle);
		$this->matrix[4] = sin($this->_angle);
		$this->matrix[5] = cos($this->_angle);
	}

	private function makeTranslation() {
		$this->makeIdentity(1);
		$this->matrix[3] = $this->_vtc->__get('_x');
		$this->matrix[7] = $this->_vtc->__get('_y');
		$this->matrix[11] = $this->_vtc->__get('_z');
	}

	private function makeProjection() {
		$this->makeIdentity(1);
		$fov = $this->_fov;
		$ratio = $this->_ratio;
		$near = $this->_near;
		$far = $this->_far;
		$this->matrix[0] = (1 / tan($fov / 2)) / $ratio;
		$this->matrix[5] = 1 / tan($fov / 2);
		$this->matrix[10] = ($far + $near) * (1 / ($near - $far));
		$this->matrix[11] = -1;
		$this->matrix[14] = (2 * $far * $near) * (1 / ($near - $far));
		$this->matrix[15] = 0;
	}

	public function mult($rhs) {
		$mtxRet = array();
		$mtxA = $this->matrix;
		$mtxB = $rhs->matrix;
		for ($i = 0; $i < 16; $i += 4) {
			for ($j = 0; $j < 4; $j++) {
				$mtxRet[$j + $i] = 0;
				$mtxRet[$j + $i] += $mtxA[$i+0] * $mtxB[$j+0];
				$mtxRet[$j + $i] += $mtxA[$i+1] * $mtxB[$j+4];
				$mtxRet[$j + $i] += $mtxA[$i+2] * $mtxB[$j+8];
				$mtxRet[$j + $i] += $mtxA[$i+3] * $mtxB[$j+12];
			}
		}
		$matrice = new Matrix();
		$matrice->matrix = $mtxRet;
		return $matrice;
	}

	public function transformVertex($vtx) {
		$mtx = $this->matrix;
		$vtxX = $vtx->get_x();
		$vtxY = $vtx->get_y();
		$vtxZ = $vtx->get_z();
		$vtxW = $vtx->get_w();

		$retX = $mtx[0]*$vtxX + $mtx[1]*$vtxY + $mtx[2]*$vtxZ + $mtx[3]*$vtxW;
		$retY = $mtx[4]*$vtxX + $mtx[5]*$vtxY + $mtx[6]*$vtxZ + $mtx[7]*$vtxW;
		$retZ = $mtx[8]*$vtxX + $mtx[9]*$vtxY + $mtx[10]*$vtxZ + $mtx[11]*$vtxW;
		$retW = $mtx[12]*$vtxX + $mtx[13]*$vtxY + $mtx[14]*$vtxZ + $mtx[15]*$vtxW;
		$retArr = array('x'=>$retX, 'y'=>$retY, 'z'=>$retZ, 'w'=>$retW);
		$retVtx = new Vertex($retArr);
		return $retVtx;
	}

	function __destruct() {
		if (Self::$verbose == true) {
			print("Matrix instance destructed".PHP_EOL);
		}
	}

	function __toString(){
		$tab = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$tab .= "-----------------------------\n";
		$tab .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "w | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tabArr = array();
		for ($i = 0; $i < 16; $i++)
			$tabArr[$i] = $this->matrix[$i];
		return vsprintf($tab, $tabArr);
	}


	static function doc() {
		return file_get_contents('Matrix.doc.txt');
	}
}
?>
