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

function print_cart(){
	global $in_cart;
	$cart = '<table border="1"><tr>';
	$cart .= '<td>№</td>' . '<td><b>Наименование</b></td>' . '<td><b>Цена</b></td>' . '<td><b>Скидка</b></td>';
	$cart .= '<td><b>В заказе</b></td>' . '<td><b>На складе</b></td>' . '<td><b>Итого</b></td></tr>';
	static $total_goods = 0;
	static $total_cost = 0;
	static $count = 0;

	foreach($in_cart as $key => $val) {

		$item_price = $val['цена'];
		$in_order = $val['количество заказано'];
		$available = $val['осталось на складе'];
		$diskont = get_int($val['diskont']);
		$price = get_price( $item_price, $diskont, $in_order, $key );

		$cart .= '<tr><td>' . ++$count . '</td>';

		$cart .= '<td>' . $key . '</td>';

//		if( stock( $in_order, $available ) ) {

		$cart .= '<td>' . $item_price . '</td>';

		$cart .= '<td>' . $diskont . '0%</td>';

		$cart .= '<td>' . $in_order . '</td>';

		$cart .= '<td>' . $available . '</td>';

		$cart .= '<td>' . $price . '</td>';



		$cart .= '</tr>';

		$total_goods += $in_order;
		$total_cost += $price;

//		} else {
//			$cart .= '<td>К сожалению на складе только ' . $available . '</td><td>-</td><td>-</td></tr>';
//		}

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

function get_int($string){
	$int = preg_replace("/[^0-9]/", '', $string);
	return $int;
}