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
var_dump($in_cart);

function print_cart(){
	global $in_cart;
	
	if ( array_key_exists('игрушка детская велосипед', $in_cart) ) {
		
		if( get_available($in_cart['игрушка детская велосипед']['количество заказано'], $in_cart['игрушка детская велосипед']['осталось на складе']) >= 3 ) {
			
			echo '<p>Поздравляем вас с участием в акции, вы купили товар "игрушка детская велосипед" в количестве более 3 штук, и получаете скидку в 30%</p>';
			$in_cart['игрушка детская велосипед']['diskont'] = 'diskont3';
			
		} else {
			echo 'Купив товар "игрушка детская велосипед" количеством более 3 штук вы получите скидку 30%!';
		}
		
		$action_profit = get_profit($in_cart['игрушка детская велосипед']['количество заказано'], $in_cart['игрушка детская велосипед']['осталось на складе'], $in_cart['игрушка детская велосипед']['цена']);
	} 
	
	$cart = '<table border="1"><tr>';
	$cart .= '<td>№</td>' . '<td><b>Наименование</b></td>' . '<td><b>Цена</b></td>' . '<td><b>Скидка</b></td>';
	$cart .= '<td><b>В заказе</b></td>' . '<td><b>На складе</b></td>' . '<td><b>Итого со скидкой</b></td></tr>';
	
	static $total_goods = 0;
	static $total_cost = 0;
	static $count = 0;
	static $total_profit = 0;

	foreach($in_cart as $key => $val) {

		$item_price = $val['цена'];
		$in_order = $val['количество заказано'];
		$in_stock = $val['осталось на складе'];
		$diskont = get_int($val['diskont']);
		$show_diskont = ($diskont>0) ? $diskont.'0%' : '0%'; //красивое число скидки в таблице
		$price = get_price( $item_price, $diskont, $in_order, $key, $in_stock );

		$cart .= '<tr><td>' . ++$count . '</td>';

		$cart .= '<td>' . $key . '</td>';

		$cart .= '<td>' . $item_price . '</td>';

		$cart .= '<td>' . $show_diskont . '</td>';

		$cart .= '<td>' . $in_order . '</td>';

		$cart .= '<td>' . $in_stock . '</td>';

		$cart .= '<td>' . $price[0] . '</td>';

		$cart .= '</tr>';

		$total_goods += get_available($in_order, $in_stock);
		$total_cost += $price[0];
		$total_profit += $price[1]-$price[0];

	}
	
	$cart .= '</table>';
	
	$cart .= $action_profit;
	
	$cart .= '<table style="border:1px solid gray;background:lightgray"><tr><td>ИТОГО в заказе:</td><td> - ' . $count . ' наименования,<br/>';
	$cart .= '- ' . $total_goods . ' товаров,<br/> - ' . $total_cost . ' сумма к оплате,<br/> - ' . $total_profit . ' сэкономлено на скидках</td></tr></table>';
	
	return $cart;
}

echo print_cart();

//TODO: get_profit (выгода от добора акционного товара), get_action (получать массив акционного товара и возвращать попадает ли товар под акцию или нет)

/* Helpers */


function diskont($diskont, $key = '', $goods){

	if ($diskont == 0) return 1;

	switch ($diskont){
		case 1:
			return 1.1;
			break;
		case 2:
			return 1.2;
			break;
		case 3:
			return 1.3;
			break;
	}
}

function get_price($price, $diskont=1, $in_order, $name, $in_stock){
	
	$available = get_available($in_order, $in_stock);
	
	if ($available > 0) {
		
		$get_diskont = diskont($diskont, $name, $available);

		return array(round($price / $get_diskont * $available, 2), round($price * $available, 2));
		
	} else {
		return array('Товара нет в наличии');
	}

}

function get_available($in_order, $in_stock){
	return ($in_order<=$in_stock) ? $in_order : $in_stock;
}

function get_profit($in_order, $in_stock, $price){
	if ($in_stock >= 3 && $in_order < 3 ) {
		return '<p style="border:1px dotted orange;color:orange">Добавив в корзину еще ' . (3-$in_order) . ' товар "игрушка детская велосипед" вы получите скидку 30% и сэкономите ' . round (3 * $price / 1.3 - $in_order*$price) . '$.</p>';
	}
}

/* Library */

function get_int($string){
	$int = preg_replace("/[^0-9]/", '', $string);
	return $int;
}