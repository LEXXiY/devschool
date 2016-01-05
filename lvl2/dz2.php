<?php
/**
 * Created by PhpStorm.
 * User: a.evseev
 * Date: 29.12.2015
 * Time: 16:35
 */

echo '<h2>Задание 1</h2>';
$name = 'Алексей';
$age = '31';
echo 'Меня зовут ' . $name . '<br/>';
echo 'Мне ' . $age . ' лет';
unset($name);
unset($age);

echo '<h2>Задание 2</h2>';

define("CITY", "Москва");

if(defined('CITY')) echo CITY;

define('CITY', 'Самара');

if(define('CITY', 'Самара')){
    echo CITY;
}else{
    echo '<br/>Не удалось переопределить константу CITY';
}

echo '<h2>Задание 3</h2>';

$book = [
        "title"=>"PHP. Объекты, шаблоны и методики программирования",
        "author"=>"Мэт Зандстра",
        "pages"=>560
    ];
echo "Недавно я прочитал книгу '{$book['title']}', написанную автором {$book['author']}, я осилил все {$book['pages']} страниц, мне она очень понравилась";

echo '<h2>Задание 4</h2>';



$book1 = [
    "title"=>"PHP. Объекты, шаблоны и методики программирования",
    "author"=>"Мэт Зандстра",
    "pages"=>560
];
$book2 = [
    "title"=>"JavaScript. Подробное руководство",
    "author"=>"Дэвид Флэнаган",
    "pages"=>992
];
$books = array($book1, $book2);
//print_r($books);
$pages_sum =  $books[0]['pages']+$books[1]['pages'];
echo "Недавно я прочитал книги '{$books[0]['title']}' и '{$books[1]['title']}', написанные соответственно авторами {$books[0]['author']} и {$books[1]['author']}, я осилил в сумме {$pages_sum} страниц, не ожидал от себя такого";