<?php
#################################################################################################################################
#    _________ __                                ____  __.                      __                 __  .__                      #
#   /   _____//  |_  ____ ___________    ____   |    |/ _|____   ____   _______/  |______    _____/  |_|__| ____   _______  __  #
#   \_____  \\   __\/ __ \\____ \__  \  /    \  |      < /  _ \ /    \ /  ___/\   __\__  \  /    \   __\  |/    \ /  _ \  \/ /  #
#   /        \|  | \  ___/|  |_> > __ \|   |  \ |    |  (  <_> )   |  \\___ \  |  |  / __ \|   |  \  | |  |   |  (  <_> )   /   #
#  /_______  /|__|  \___  >   __(____  /___|  / |____|__ \____/|___|  /____  > |__| (____  /___|  /__| |__|___|  /\____/ \_/    #
#          \/           \/|__|       \/     \/          \/          \/     \/            \/     \/             \/               #
#################################################################################################################################

class complexNumber {
	public $a, $b;
	private $ta, $tb;

	public function __construct($a, $b) {
		$this->a = $a;
		$this->b = $b;
	}

	public function getNumber() {
		return $this->a.'*i+'.$this->b;
	}

	public function add($number) {
		if(is_numeric($number))
			$this->b += $number;
		elseif(@get_class($number) == get_class($this)) {
			$this->a += $number->a;
			$this->b += $number->b;
		}
	}

	public function subtract($number) {
		if(is_numeric($number))
			$this->b -= $number;
		elseif(@get_class($number) == get_class($this)) {
			$this->a -= $number->a;
			$this->b -= $number->b;
		}
	}

	public function multiply($number) {
		if(is_numeric($number)) {
			$this->a *= $number;
			$this->b *= $number;
		} elseif(@get_class($number) == get_class($this)) {
			$this->ta = $this->b*$number->a + $number->b*$this->a;
			$this->tb = $this->b*$number->b - $this->a*$number->a;
			$this->a = $this->ta;
			$this->b = $this->tb;
		}
	}

	public function divide($number) {
		if(is_numeric($number)) {
			$this->a /= $number;
			$this->b /= $number;
		} elseif(@get_class($number) == get_class($this)) {
			$this->ta = ($this->a*$number->b - $this->b*$number->a) / ($number->a*$number->a + $number->b*$number->b);
			$this->tb = ($this->b*$number->b + $this->a*$number->a) / ($number->a*$number->a + $number->b*$number->b);
			$this->a = $this->ta;
			$this->b = $this->tb;
		}
	}

	public function absolute() {
		return sqrt($this->a*$this->a + $this->b*$this->b);
	}

	public function argument() {
		if($this->b > 0)
			return atan($this->a/$this->b);
		elseif($this->b < 0 and $this->a > 0)
			return atan($this->a/$this->b) + M_PI;
		elseif($this->a < 0 and $this->b < 0)
			return atan($this->a/$this->b) - M_PI;
	}

	public function root($n, $k = 0) {
		$arg = $this->argument();
		$mod = $this->absolute();
		$r = $this->nRoot($mod, $n);
		$t = ($arg + 2*M_PI*$k)/$n;
		$this->tb = $r*cos($t);
		$this->ta = $r*sin($t);
		$this->a = $this->ta;
		$this->b = $this->tb;
	}

	protected function nRoot($from, $n) {
		$k = sqrt($from) * $n/2;
		while(substr(exp($k, $n), strlen(intval($from)) + 3) != substr($from, strlen(intval($from)) + 3)) $k = 1/$n*round(($n-1)*$k + $from/exp($k, $n-1));
		return $k;
	}

	public function power($exponent) {
		if(is_numeric($exponent)) {
			if($exponent == 1) return;
			if($exponent == 0) {
				$this->a = 0;
				$this->b = 1;
				return;
			}
			$frac = $exponent-intval($exponent);
			if($frac == 0 and $exponent > 1)
				for($i = 1;$i < $exponent;$i++) $this->multiply($this);
			elseif($frac == 0 and $exponent < 0) {
				eval('$one = new '.get_class($this).'(0, 1);'); // Aaa!!!
				$one->divide($this->power(abs($exponent)));
			} else {
				$frac = substr($frac, strlen(intval($exponent))+1);
				eval('$copy = new'.get_class($this).'('.$this->a.', '.$this->b.');'); // Aaa!!!
				eval('$one = new '.get_class($this).'(0, 1);'); // Aaa!!!
				for($i = 1;$i < $exponent*'1'.str_repeat('0', strlen($frac));$i++) $this->multiply($copy);
				$copy->root('1'.str_repeat('0', strlen($frac)));
				$one->divide($copy);
				$this->a = $one->a;
				$this->b = $one->b;
			}
		}
	}
}
?>
