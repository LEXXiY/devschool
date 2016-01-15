<?php

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

session_start();
if(!empty($_POST)) {
    $_SESSION['ads'][] = $_POST;
}

if(isset($_GET['del'])){
    unset($_SESSION['ads'][$_GET['del']]);
}

print_r($_SESSION);

$cities = array(
    '641780'=>'Новосибирск',
    '641490'=>'Барабинск',
    '641510'=>'Бердск',
    '641600'=>'Искитим',
    '641630'=>'Колывань',
    '641680'=>'Краснообск',
    '641710'=>'Куйбышев',
    '641760'=>'Мошково',
    '641790'=>'Обь',
    '641800'=>'Ордынское',
    '641970'=>'Черепаново',
);

$categories = array(
    'Транспорт' => array(
        '9'=>'Автомобили с пробегом',
        '109'=>'Новые автомобили',
        '14'=>'Мотоциклы и мототехника',
        '81'=>'Грузовики и спецтехника',
        '11'=>'Водный транспорт',
        '10'=>'Запчасти и аксессуары',
    ),
    'Недвижимость' => array(
        '24'=>'Квартиры',
        '23'=>'Комнаты',
        '25'=>'Дома, дачи, коттеджи',
        '26'=>'Земельные участки',
        '85'=>'Гаражи и машиноместа',
        '42'=>'Коммерческая недвижимость',
        '6'=>'Недвижимость за рубежом',
    ),
    'Работа' => array(
        '111'=>'Вакансии (поиск сотрудников)',
        '112'=>'Резюме (поиск работы)',
    ),
    'Услуги' => array(
        '114'=>'Предложения услуг',
        '115'=>'Запросы на услуги',
    ),
    'Личные вещи' => array(
        '27'=>'Одежда, обувь, аксессуары',
        '29'=>'Детская одежда и обувь',
        '30'=>'Товары для детей и игрушки',
        '28'=>'Часы и украшения',
        '88'=>'Красота и здоровье',
    ),
    'Для дома и дачи' => array(
        '21'=>'Бытовая техника',
        '20'=>'Мебель и интерьер',
        '87'=>'Посуда и товары для кухни',
        '82'=>'Продукты питания',
        '19'=>'Ремонт и строительство',
        '106'=>'Растения',
    ),
    'Бытовая электроника' => array(
        '32'=>'Аудио и видео',
        '97'=>'Игры, приставки и программы',
        '31'=>'Настольные компьютеры',
        '98'=>'Ноутбуки',
        '99'=>'Оргтехника и расходники',
        '96'=>'Планшеты и электронные книги',
        '84'=>'Телефоны',
        '101'=>'Товары для компьютера',
        '105'=>'Фототехника',
    ),
    'Хобби и отдых' => array(
        '33'=>'Билеты и путешествия',
        '34'=>'Велосипеды',
        '83'=>'Книги и журналы',
        '36'=>'Коллекционирование',
        '38'=>'Музыкальные инструменты',
        '102'=>'Охота и рыбалка',
        '39'=>'Спорт и отдых',
        '103'=>'Знакомства',
    ),
    'Животные' => array(
        '89'=>'Собаки',
        '90'=>'Кошки',
        '9'=>'Птицы',
        '92'=>'Аквариум',
        '93'=>'Другие животные',
        '94'=>'Товары для животных',
    ),
    'Для бизнеса' => array(
        '116'=>'Готовый бизнес',
        '40'=>'Оборудование для бизнеса',
    )
);

function all_cities($cities){
    foreach ($cities as $id=>$city){
        echo '<option data-coords=",," value="' . $id . '">' . $city . '</option>';
    }
}

function all_categories($categories){
    foreach ($categories as $name=>$block_category){
        echo '<optgroup label="' . $name . '">';

        foreach ($block_category as $id=>$category){
            echo '<option value="' . $id . '">' . $category . '</option>';
        }

        echo '</optgroup>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

<div class="container col-sm-4 col-sm-offset-4">
    <form method="post" class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-5 col-sm-offset-1 radio-inline">
                <input type="radio" checked="" value="1" name="private">Частное лицо
            </label>
            <label class="col-sm-5  radio-inline">
                <input type="radio" value="0" name="private">Компания
            </label>
        </div>
        <div class="form-group">
            <label for="fld_seller_name" class="form-label col-sm-5"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="col-sm-7" value="" name="seller_name" id="fld_seller_name">
        </div>
        <div style="display: none;" id="your-manager" class="form-group">
            <label for="fld_manager" class="form-label col-sm-5"><b>Контактное лицо</b></label>
            <input type="text" class="col-sm-7" maxlength="40" value="" name="manager" id="fld_manager">
            <em class="f_r_g">&nbsp;&nbsp;необязательно</em>
        </div>
        <div class="form-group">
            <label for="fld_email" class="form-label col-sm-5">Электронная почта</label>
            <input type="text" class="col-sm-7" value="" name="email" id="fld_email">
        </div>
        <div class="form-group">
            <label class="form-label-checkbox col-sm-12" for="allow_mails">
                <input type="checkbox" value="1" name="allow_mails" id="allow_mails" class="form-input-checkbox">
                <span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span>
            </label>
        </div>
        <div class="form-group">
            <label id="fld_phone_label" for="fld_phone" class="form-label col-sm-5">Номер телефона</label>
            <input type="text" class="col-sm-7" value="" name="phone" id="fld_phone">
        </div>

        <div id="f_location_id" class="form-group form-row-required">
            <label for="region" class="form-label col-sm-5">Город</label>
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select col-sm-7">
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                <option selected="" data-coords=",," value="641780">Новосибирск</option>
                <?php
                    all_cities($cities);
                ?>
                <option id="select-region" value="0">Выбрать другой...</option>
            </select>
        </div>
        <div id="f_metro_id" class="form-group">
            <label for="subway" class="form-label col-sm-5">Метро</label>
            <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select col-sm-7">
                <option value="">-- Выберите станцию метро --</option>
                <option value="2028">Берёзовая роща</option>
                <option value="2018">Гагаринская</option>
                <option value="2017">Заельцовская</option>
                <option value="2029">Золотая Нива</option>
                <option value="2019">Красный проспект</option>
                <option value="2027">Маршала Покрышкина</option>
                <option value="2021">Октябрьская</option>
                <option value="2025">Площадь Гарина-Михайловского</option>
                <option value="2020">Площадь Ленина</option>
                <option value="2024">Площадь Маркса</option>
                <option value="2022">Речной вокзал</option>
                <option value="2026">Сибирская</option>
                <option value="2023">Студенческая</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fld_category_id" class="form-label col-sm-5">Категория</label>
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select col-sm-7">
                <option value="">-- Выберите категорию --</option>
                <?php
                    all_categories($categories);
                ?>
            </select>
        </div>

        <div id="f_title" class="form-group f_title">
            <label for="fld_title" class="form-label">Название объявления</label>
            <input type="text" maxlength="50" class="form-control" value="" name="title" id="fld_title">
        </div>
        <div class="form-group">
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label>
            <textarea maxlength="3000" name="description" id="fld_description" class="form-control"></textarea>
        </div>
        <div id="price_rw" class="form-group rl">
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label>
            <input type="text" maxlength="9" class="form-input-text-short" value="0" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>
            <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="/info/pravilnye_ceny?plain">
                <span>Правильно указывайте цену</span>
            </a>
        </div>

        <div id="f_images" class="form-group">
            <label for="fld_images" class="form-label"><span id="js-photo-label">Фотографии</span><span class="js-photo-count" style="display: none;"></span></label>
            <input type="file" value="image" id="fld_images" name="image" accept="image/*" class="form-input-file"> <span style="line-height:22px;color: gray; display: none;" id="fld_images_toomuch">Вы добавили максимально возможное количество фотографий</span> <span style="display: none;" id="fld_images_overhead"></span>
        </div>
        <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Отправить</button>
        </div>

    </form>
    <div class="row">
        <h2>Все объявления</h2>
        <?php
        if(array_key_exists('ads', $_SESSION) && !empty($_SESSION['ads'])){
            foreach ($_SESSION['ads'] as $id=>$value){
                $obid = $id;
                echo '<a href="?edit='. $obid . '">' . $value['title'] . '</a>|' . $value['price'] . '|' . $value['seller_name'] . '| <a href="?del=' . $obid . '">Удалить</a><br/>';
            }
        }
        ?>
    </div>
    </div>

</body>
</html>