<?php

$_SESSION['ads']['']

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

function
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
        <!--div id="f_district_id" class="form-group">
            <select title="Выберите район города" name="district_id" id="fld_district_id" class="form-input-select" style="display: none;">
                <option value="">-- Выберите район города --</option>
            </select>
        </div>
        <div id="f_road_id" class="form-group">
            <select title="Выберите направление" name="road_id" id="fld_road_id" class="form-input-select" style="display: none;">
                <option value="">-- Выберите направление --</option>
                <option value="56">Бердское шоссе</option>
                <option value="57">Гусинобродское шоссе</option>
                <option value="53">Дачное шоссе</option>
                <option value="55">Краснояровское шоссе</option>
                <option value="54">Мочищенское шоссе</option>
                <option value="52">Ордынское  шоссе</option>
                <option value="58">Советское шоссе</option>
            </select>
        </div-->

        <div class="form-group">
            <label for="fld_category_id" class="form-label col-sm-5">Категория</label>
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select col-sm-7">
                <option value="">-- Выберите категорию --</option>
                <optgroup label="Транспорт">
                    <option value="9">Автомобили с пробегом</option>
                    <option value="109">Новые автомобили</option>
                    <option value="14">Мотоциклы и мототехника</option>
                    <option value="81">Грузовики и спецтехника</option>
                    <option value="11">Водный транспорт</option>
                    <option value="10">Запчасти и аксессуары</option>
                </optgroup>
                <optgroup label="Недвижимость">
                    <option value="24">Квартиры</option>
                    <option value="23">Комнаты</option>
                    <option value="25">Дома, дачи, коттеджи</option>
                    <option value="26">Земельные участки</option>
                    <option value="85">Гаражи и машиноместа</option>
                    <option value="42">Коммерческая недвижимость</option>
                    <option value="86">Недвижимость за рубежом</option>
                </optgroup>
                <optgroup label="Работа">
                    <option value="111">Вакансии (поиск сотрудников)</option>
                    <option value="112">Резюме (поиск работы)</option>
                </optgroup>
                <optgroup label="Услуги">
                    <option value="114">Предложения услуг</option>
                    <option value="115">Запросы на услуги</option>
                </optgroup>
                <optgroup label="Личные вещи">
                    <option value="27">Одежда, обувь, аксессуары</option>
                    <option value="29">Детская одежда и обувь</option>
                    <option value="30">Товары для детей и игрушки</option>
                    <option value="28">Часы и украшения</option>
                    <option value="88">Красота и здоровье</option>
                </optgroup>
                <optgroup label="Для дома и дачи">
                    <option value="21">Бытовая техника</option>
                    <option value="20">Мебель и интерьер</option>
                    <option value="87">Посуда и товары для кухни</option>
                    <option value="82">Продукты питания</option>
                    <option value="19">Ремонт и строительство</option>
                    <option value="106">Растения</option>
                </optgroup>
                <optgroup label="Бытовая электроника">
                    <option value="32">Аудио и видео</option>
                    <option value="97">Игры, приставки и программы</option>
                    <option value="31">Настольные компьютеры</option>
                    <option value="98">Ноутбуки</option>
                    <option value="99">Оргтехника и расходники</option>
                    <option value="96">Планшеты и электронные книги</option>
                    <option value="84">Телефоны</option>
                    <option value="101">Товары для компьютера</option>
                    <option value="105">Фототехника</option>
                </optgroup>
                <optgroup label="Хобби и отдых">
                    <option value="33">Билеты и путешествия</option>
                    <option value="34">Велосипеды</option>
                    <option value="83">Книги и журналы</option>
                    <option value="36">Коллекционирование</option>
                    <option value="38">Музыкальные инструменты</option>
                    <option value="102">Охота и рыбалка</option>
                    <option value="39">Спорт и отдых</option>
                    <option value="103">Знакомства</option>
                </optgroup>
                <optgroup label="Животные">
                    <option value="89">Собаки</option>
                    <option value="90">Кошки</option>
                    <option value="91">Птицы</option>
                    <option value="92">Аквариум</option>
                    <option value="93">Другие животные</option>
                    <option value="94">Товары для животных</option>
                </optgroup>
                <optgroup label="Для бизнеса">
                    <option value="116">Готовый бизнес</option>
                    <option value="40">Оборудование для бизнеса</option>
                </optgroup>
            </select>
        </div>

        <!--div style="display: none;" id="params" class="form-group form-row-required">
            <label class="form-label ">
                Выберите параметры
            </label>
            <div class="form-params params" id="filters"></div>
        </div-->
        <!--div id="f_map" class="form-group form-row-required hidden">
            <label class="form-label c-2">Укажите местоположение объекта на&nbsp;карте</label>
            <div class="b-address-map j-address-map disabled">
                <div class="wrapper">
                    <div class="map" id="address-map"></div>
                    <div class="overlay">
                        <div class="modal">Сначала <span class="fill-in pseudo-link">укажите адрес</span></div>
                    </div>
                </div>
                <div class="result c-2 hidden">
                    <div class="map-success">
                        Маркер указывает на: <span class="address-line"></span>.
                        <span class="confirm pseudo-link hidden">Это верный адрес</span>
                    </div>
                    <div class="map-error">Мы не смогли автоматически определить адрес.</div>
                </div>
                <input type="hidden" disabled="disabled" value="" class="j-address-latitude" name="coords[lat]">
                <input type="hidden" disabled="disabled" value="" class="j-address-longitude" name="coords[lng]">
                <input type="hidden" disabled="disabled" value="" class="j-address-zoom" name="coords[zoom]">
            </div>
        </div-->
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
        <div style="display: none; margin-top: 0px;" class="form-row-indented images" id="files">
            <div style="display: none;" id="progress"> <table><tbody><tr><td> <div><div></div></div> </td></tr></tbody></table> </div> </div>

        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span>
                <button type="button" class="btn btn-success">Отправить</button>
            </div>
        </div>
    </form>
    </div>

</body>
</html>