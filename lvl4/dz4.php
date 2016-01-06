<?php
header('Content-Type: text/html; charset=utf-8');
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
	
	if ( array_key_exists('игрушка детская велосипед', $in_cart) && $in_cart['игрушка детская велосипед']['количество заказано'] >= 3 ) {
		echo '<span style="color:red">АКЦИЯ!</span><br/> Поздравляем вас, купив товар "игрушка детская велосипед" количеством более 3 штук, вы получаете скидку в 30%';
		$in_cart['игрушка детская велосипед']['diskont'] = 'diskont3';
	} else {
		echo 'Купив товар "игрушка детская велосипед" количеством более 3 штук вы получите скидку 30%!';
	}
	
	$cart = '<table border="1"><tr>';
	$cart .= '<td>№</td>' . '<td><b>Наименование</b></td>' . '<td><b>Цена</b></td>' . '<td><b>Скидка</b></td>';
	$cart .= '<td><b>В заказе</b></td>' . '<td><b>На складе</b></td>' . '<td><b>Итого</b></td></tr>';
	static $total_goods = 0;
	static $total_cost = 0;
	static $count = 0;

	foreach($in_cart as $key => $val) {

		$item_price = $val['цена'];
		$in_order = $val['количество заказано'];
		$in_stock = $val['осталось на складе'];
		$diskont = get_int($val['diskont']);
		$price = get_price( $item_price, $diskont, $in_order, $key, $in_stock );

		$cart .= '<tr><td>' . ++$count . '</td>';

		$cart .= '<td>' . $key . '</td>';

		$cart .= '<td>' . $item_price . '</td>';

		$cart .= '<td>' . $diskont . '0%</td>';

		$cart .= '<td>' . $in_order . '</td>';

		$cart .= '<td>' . $in_stock . '</td>';

		$cart .= '<td>' . $price . '</td>';

		$cart .= '</tr>';

		$total_goods += $in_order;
		$total_cost += $price;

	}
	
	$cart .= '</table>';
	$cart .= '<p>ИТОГО: ' . $count . ' наименования, ' . $total_goods . ' товаров, ' . 'на сумму ' . $total_cost;

	return $cart;
}

echo print_cart();

//TODO: get_profit (выгода от добора акционного товара), get_action (получать массив акционного товара и возвращать попадает ли товар под акцию или нет)

/* Helpers */

function diskont($diskont, $key = '', $goods){

	if ($key = 'игрушка детская велосипед' && $goods >= 3) return 1.3;

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

function get_price($price, $diskont=1, $in_order, $name, $in_stock){
	
	$available = ($in_order<=$in_stock) ? $in_order : $in_stock;
	
	if ($available > 0) {
		
		$get_diskont = diskont($diskont, $name, $available);

		return round($price / $get_diskont * $available, 2);
		
	} else {
		return 0;
	}

}

/* Library */

function get_int($string){
	$int = preg_replace("/[^0-9]/", '', $string);
	return $int;
}