<?php
/**
 * ポーカーのルール判定クラス
 */
class Poker
{
	private $poker;
	private $state = 0;
	private $name = array(
		0 => "ロイヤルストレートフラッシュ",
		1 => "ストレートフラッシュ",
		2 => "フォーカード",
		3 => "フルハウス",
		4 => "フラッシュ",
		5 => "ストレート",
		6 => "スリーカード",
		7 => "ツーペア",
		8 => "ブタ"
	);

	/**
	* 役の名前を返却
	* @param Array $cards
	* @return string
	*/
	public function getYaku($cards) {
		$result = $this->judge($cards);
		$yaku = $this->getName($result);
		return $yaku;
	}

	/**
	* 役の名前を取得
	* @param int
	* @return string
	*/
	private function getName($state) {
		return $this->name[$state];
	}

	/**
	 * 役の判定
	 * @param Array $card
	 * @return int
	 */
	private function judge($cards) {
		if ($this->isRoyal($cards)) {
			return 0;
		}
		if ($this->isStraightFlash($cards)) {
			return 1;
		}
		if ($this->isFour($cards)) {
			return 2;
		}
		if ($this->isFullHouse($cards)) {
			return 3;
		}
		if ($this->isSameMark($cards)) {
			return 4;
		}
		if ($this->isStraight($cards)) {
			return 5;
		}
		if ($this->isThree($cards)) {
			return 6;
		}
		if ($this->isPair($cards)) {
			return 7;
		}
		return 8;
	}

	/**
	* ロイヤルストレートフラッシュ判定
	*/
	private function isRoyal($cards) {
		$state = false;
		$royal = array(1, 10, 11, 12 ,13);
		if($this->isSameMark($cards)) {
			foreach($cards as $card) {
				if(in_array($card["number"], $royal)) {
					$state = true;
				} else {
					$state = false;
					break;
				}
			}
		}
		return $state;
	}

	/**
	* ストレートフラッシュ判定
	*/
	private function isStraightFlash($cards) {
		return ($this->isStraight($cards) && $this->isSameMark($cards));
	}

	/**
	* フォーカード判定
	*/
	private function isFour($cards) {
		$state = $this->searchPair($cards);
		rsort($state);
		if (array_shift($state) == 4) {
			return true;
		}
		return false;
	}

	/**
	* フルハウス判定
	*/
	private function isFullhouse($cards) {
		$state = $this->searchPair($cards);
		rsort($state);
		if (array_shift($state) == 3 && array_shift($state) == 2) {
			return true;
		}
		return false;
	}

	/**
	* スリーカード判定
	*/
	private function isThree($cards) {
		$state = $this->searchPair($cards);
		rsort($state);
		if (array_shift($state) == 3) {
			return true;
		}
		return false;
	}

	/**
	* ツーペア判定
	*/
	private function isPair($cards) {
		$state = $this->searchPair($cards);
		rsort($state);
		if (array_shift($state) == 2) {
			if (array_shift($state) == 2) {
				return true;
			}
		}
		return false;
	}

	/**
	* 同じマークがあるか判定
	*/
	private function isSameMark($cards) {
		$state = true;
		$mark = "";
		foreach ($cards as $card) {
			if ($mark !== "" && $mark !== $card["mark"]) {
				$state = false;
				break;
			}
			$mark = $card["mark"];
		}
	return $state;
	}

	/**
	* ストレート判定
	*/
	private function isStraight($cards) {
		$numbers = array();
		foreach ($cards as $card) {
			$numbers[] = $card["number"];
		}
		$last = 0;
		sort($numbers);
		$state= true;
		foreach ($numbers as $number) {
			if ($last !== 0 && $number-$last != 1) {
				$state = false;
				break;
			}
			$last = $number;
		}
		return $state;
	}

	/**
	 * ペアを数え上げる
	 */
	private function searchPair($cards) {
		$state = array();
		foreach ($cards as $card) {
			if (! isset($state[$card["number"]])) {
				$state[$card["number"]] = 0;
			}
			$state[$card["number"]]++;
		}
		return $state;
	}
}
