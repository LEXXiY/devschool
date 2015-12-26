<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 24.12.2015
 * Time: 20:36
 */
$date = range(0, 5);

for ($i=0; $i<count($date); $i++)
{
    $date[$i] = rand(1350979861, time());
    echo date('d.m.Y', $date[$i])."<br/>";
}

foreach ($date as $value)
{
    $day[] = date('d', $value);
    $month[] = date('n', $value);
}

/* Хреновая версия */

//for ($k=0; $k<count($date); $k++)
//{
//    $getday = compareMin($day[$k], $day[$k+1]);
//
//    $getmonth = compareMax($month[$k], $month[$k+1]);
//}
//
//function compareMin($a, $b)
//{
//    if ($a < $b){
//        return $a;
//    } else {
//        return $b;
//    }
//}
//
//function compareMax($a, $b)
//{
//    if ($a > $b){
//        return $a;
//    } else {
//        return $b;
//    }
//}
/* Конец хреновой версия */

/* Обдуманная версия */

$days = min($day);

$months = max($month);

/* Конец обдуманной версия */

echo "Наименьший день - ".$days."<br/>";

echo "Наибольший месяц - ".$months."<br/>";

asort($date);

$selected = array_pop($date);

echo "Выбранная дата ".date('d.m.y H:i:s', $selected)."<br/>";

date_default_timezone_set('America/New_York');

$range = time()-date($selected);

echo "В Нью Йорке ".date('d.m.y H:i:s', $selected). "<br/>";

//aprint($date);

/* Library */

function aprint($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}