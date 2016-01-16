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

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    
    $forma = ($_SESSION['ads'][$id]['forma']) ? $_SESSION['ads'][$id]['forma'] : '';
    $seller_name = ($_SESSION['ads'][$id]['seller_name']) ? $_SESSION['ads'][$id]['seller_name'] : '';
    $email = ($_SESSION['ads'][$id]['email']) ? $_SESSION['ads'][$id]['email'] : '';
    $allow_mails = ( isset($_SESSION['ads'][$id]['allow_mails']) ) ? $_SESSION['ads'][$id]['allow_mails'] : '';
    $phone = ($_SESSION['ads'][$id]['phone']) ? $_SESSION['ads'][$id]['phone'] : '';
    $location_id = ($_SESSION['ads'][$id]['location_id']) ? $_SESSION['ads'][$id]['location_id'] : '';
    $category_id = ($_SESSION['ads'][$id]['category_id']) ? $_SESSION['ads'][$id]['category_id'] : '';
    $title = ($_SESSION['ads'][$id]['title']) ? $_SESSION['ads'][$id]['title'] : '';
    $description = ($_SESSION['ads'][$id]['description']) ? $_SESSION['ads'][$id]['description'] : '';
    $price = ($_SESSION['ads'][$id]['price']) ? $_SESSION['ads'][$id]['price'] : '';
    
}
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

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

function all_cities($city_id=''){
    global $cities;
    foreach ($cities as $id=>$city){
        if($city_id == $id) $selected = 'selected=""';
        echo '<option data-coords=",,"' . $selected . ' value="' . $id . '">' . $city . '</option>';
    }
}

function all_categories($category_id=''){
    global $categories;
    foreach ($categories as $name=>$block_category){
        echo '<optgroup label="' . $name . '">';

        foreach ($block_category as $id=>$category){
             if($category_id == $id) $selected = 'selected=""';
            echo '<option'. $selected .' value="' . $id . '">' . $category . '</option>';
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
                <input type="radio" <?php if(isset($forma)===1) echo 'checked=""'; ?> value="1" name="forma">Частное лицо
            </label>
            <label class="col-sm-5  radio-inline">
                <input type="radio" <?php if(isset($forma)===0) echo 'checked=""'; ?> value="0" name="forma">Компания
            </label>
        </div>
        
        <div class="form-group">
            <label for="fld_seller_name" class="form-label col-sm-5"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="col-sm-7" value="<?php $seller_name; ?>" name="seller_name" id="fld_seller_name">
        </div>

        <div class="form-group">
            <label for="fld_email" class="form-label col-sm-5">Электронная почта</label>
            <input type="text" class="col-sm-7" value="<?php $email; ?>" name="email" id="fld_email">
        </div>
        
        <div class="form-group">
            <label class="form-label-checkbox col-sm-12" for="allow_mails">
                <input type="checkbox" value="<?php if(isset($allow_mails)) $allow_mails; ?>" name="allow_mails" id="allow_mails" class="form-input-checkbox">
                <span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span>
            </label>
        </div>
        
        <div class="form-group">
            <label id="fld_phone_label" for="fld_phone" class="form-label col-sm-5">Номер телефона</label>
            <input type="text" class="col-sm-7" value="<?php $phone; ?>" name="phone" id="fld_phone">
        </div>

        <div id="f_location_id" class="form-group form-row-required">
            <label for="region" class="form-label col-sm-5">Город</label>
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select col-sm-7">
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>

                <?php
                    all_cities($location_id);
                ?>
                
                <option id="select-region" value="0">Выбрать другой...</option>
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
            <input type="text" maxlength="50" class="form-control" value="<?php $title; ?>" name="title" id="fld_title">
        </div>
        
        <div class="form-group">
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label>
            <textarea maxlength="3000" name="description" id="fld_description" class="form-control"><?php $description; ?></textarea>
        </div>
        
        <div id="price_rw" class="form-group rl">
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label>
            <input type="text" maxlength="9" class="form-input-text-short" value="<?php $price; ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>
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