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

function print_cart($in_cart){
	$cart = '<table border="1"><tr><td><b>Наименование</b></td><td><b>Количество (на складе)</b></td><td><b>Цена</b></td><td><b>Итого</b></td></tr>';
	$total_goods = 0;
	$total_cost = 0;

	foreach($in_cart as $key => $val) {
		$cart .= '<tr><td>' . $key . '</td>';
		$cart .= '<td>' . stock($val['количество заказано'], $val['осталось на складе']) . '</td>';
		$cart .= '<td>' . $val['цена'] . '</td>';
		$cart .= '<td>';

		if (stock($val['количество заказано'], $val['осталось на складе'])>=$val['количество заказано']) {
			if ($key == 'игрушка детская велосипед' && stock($val['количество заказано'], $val['осталось на складе']) >= 3) {
				$cart .= round($val['цена'] / 1.3 * $val['количество заказано']);
			} else {
				$cart .= round($val['цена'] / diskont($val['diskont']) * $val['количество заказано']);
			}
		} else {
			echo '-';
		}

		$total_goods += $val['количество заказано'];
		$total_cost += $val['количество заказано'] * $val['цена'];

	}
	$cart .= '</table>';
	$cart .= '<p>ИТОГО: ' . count($in_cart) . ' наименования, ' . $total_goods . ' товаров<br/>';
	$cart .= 'На сумму ' . $total_cost . '';

	return $cart;
}

echo print_cart($in_cart);

/* Helpers */

function stock($stock, $available){

	if($stock>$available) return 'На складе ' . $available;

	if($stock<=$available) return $stock;

}

function diskont($diskont){

	$diskont = preg_replace("/[^0-9]/", '', $diskont);

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

/* Library */
function print_arr($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}