<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 27.12.2015
 * Time: 10:29
 */

$ini_string = '
[игрушка мягкая мишка белый]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';

[одежда детская куртка синяя синтепон]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';

[игрушка детская велосипед]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';

';

$in_cart = parse_ini_string($ini_string, true);
print_arr($in_cart);

function print_cart(){
	global $in_cart;
	$cart = '<table border="1"><tr><td><b>Наименование</b></td><td><b>Количество</b></td><td><b>Цена</b></td><td><b>Итого</b></td></tr>';
	static $total_goods = 0;
	static $total_cost = 0;
	static $count = 0;

	foreach($in_cart as $key => $val) {



		$cart .= '<tr><td>' . $key . '</td>';

		if( stock( $val['количество заказано'], $val['осталось на складе'] ) ) {

			$cart .= '<td>';

			$cart .= $val['количество заказано'];

			$cart .= '</td>';
			$cart .= '<td>' . $val['цена'] . '</td>';
			$cart .= '<td>';

			$price = get_price( $val['цена'], $val['diskont'], $val['количество заказано'], $key );

			$cart .= $price;

			$cart .= '</td></tr>';

			$count++;
			$total_goods += $val['количество заказано'];
			$total_cost += $price;

		} else {
			$cart .= '<td>К сожалению на складе только ' . $val['осталось на складе']. '</td><td>-</td><td>-</td></tr>';
		}

	}
	$cart .= '</table>';
	$cart .= '<p>ИТОГО: ' . $count . ' наименования, ' . $total_goods . ' товаров, ' . 'на сумму ' . $total_cost;

	return $cart;
}

echo print_cart();

/* Helpers */

function stock($order, $available){

	if($order<=$available) return true;

	if($order>$available) return false;

}

function diskont($diskont, $key = '', $available){

	if ($key = 'игрушка детская велосипед' && $available >= 3) return 1.3;

	$diskont = get_int($diskont);

	if ($diskont == 0) return 1;

	switch ($diskont){
		case 1:
			return 1.1;
			break;
		case 2:
			return 1.2;
			break;
	}
}

function get_price($price, $diskont=1, $available, $name){

		return round($price / diskont($diskont, $name, $available) * $available, 2);

}

/* Library */
function print_arr($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function get_int($string){
	$int = preg_replace("/[^0-9]/", '', $string);
	return $int;
}