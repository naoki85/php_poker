# ポーカー
## 仕様
![画面設計](https://github.com/naoki85/poker/tree/master/for_wiki/window.png)<br />
<br />
画面の目標は上図です。余裕がある方は自分の理想を目指してください。<br />
<br />
1. ジョーカーを抜いた52枚のカードを使用します。
2. 52枚のカードからランダムに5枚のカードを手札とし、画面に表示させてください。
3. 下図のように役判定もしてください。（役判定については後述します。）

![画面設計](https://github.com/naoki85/poker/tree/master/for_wiki/window_2.png)<br />

## 素材
* トランプ画像 => image_trump/
gif画像とpng画像があります。お好きな方を利用してください。

* 役判定クラス => poker.php
後述します。

## 提出方法
確認します。

## 役判定クラスについて
`poker.php`内の`getYaku`メソッドを呼ぶことで現在の手札の役を判定します。<br />
ただし、以下の条件があります。<br />
* カード1枚1枚に、連想配列で`number`（数字）と`mark`（マーク）をもたせてください。<br />

```php
// 例：スペードの10
"number" => 10, "mark" => spades
/*
マークは揃っていれば何でもいいですが、悩むのが面倒な方は、
スペード => spades
ハート	=> hearts
ダイヤ	=> diams
クラブ	=> clubs
としましょう。
*/
```

* 5枚の手札は連想配列で以下のようにし、これを`poker.php`内の`getYaku`メソッドに渡してください。
（手札はそのときそのときで変わります。）

```php
// 手札
$myHand = array(
	array("number" => 12, "mark" => "clubs"),
	array("number" =>  7, "mark" => "hearts"),
	array("number" =>  1, "mark" => "spades"),
	array("number" =>  8, "mark" => "spades"),
	array("number" =>  6, "mark" => "hearts"),
	);
```