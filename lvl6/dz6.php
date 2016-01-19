<?php

require_once('data.php');
require_once('lib.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

session_start();
if( !empty($_POST) ) {
    
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    if(isset($_GET['action']) && $_GET['action']=='update' && isset($_SESSION['ads'][$id])){
        
        $_SESSION['ads'][$id] = prepareAd($_POST);

    } else {
        
        $_SESSION['ads'][] = prepareAd($_POST);
        
    }
    
} elseif( isset($_GET['del']) ){
    
    unset($_SESSION['ads'][$_GET['del']]);
    
} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $id = $_GET['edit'];
   
    $edit_form = prepareAd($_SESSION['ads'][$id]);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

<div class="container col-sm-4 col-sm-offset-4">
    <form method="post" class="form-horizontal" action="<?php if(isset($_GET['edit']) ) echo '?action=update'; ?>">
        <div class="form-group">

            <label class="col-sm-5 col-sm-offset-1 radio-inline">
                <input type="radio" <?php if(isset($edit_form['forma']) && $edit_form['forma'] === 1) echo 'checked="checked"'; ?> value="1" name="forma">Частное лицо
            </label>
            <label class="col-sm-5  radio-inline">
                <input type="radio" <?php if(isset($edit_form['forma']) && $edit_form['forma'] === 0) echo 'checked="checked"'; ?> value="0" name="forma">Компания
            </label>
        </div>
        
        <div class="form-group">
            <label for="fld_seller_name" class="form-label col-sm-5"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="col-sm-7" value="<?php if(isset($edit_form['seller_name'])) echo $edit_form['seller_name']; ?>" name="seller_name" id="fld_seller_name">
        </div>

        <div class="form-group">
            <label for="fld_email" class="form-label col-sm-5">Электронная почта</label>
            <input type="text" class="col-sm-7" value="<?php if(isset($edit_form['email']))  echo $edit_form['email']; ?>" name="email" id="fld_email">
        </div>
        
        <div class="form-group">
            <label class="col-sm-12" for="allow_mails">
                <input type="checkbox" name="newsletter" value="1" <?php if(isset($edit_form['newsletter']) && $edit_form['newsletter'] === 1) echo 'checked="checked"'; ?> id="allow_mails">
                <span>Я не хочу получать вопросы по объявлению по e-mail</span>
            </label>
        </div>
        
        <div class="form-group">
            <label for="fld_phone" class="form-label col-sm-5">Номер телефона</label>
            <input type="text" class="col-sm-7" value="<?php if(isset($edit_form['phone'])) echo $edit_form['phone']; ?>" name="phone" id="fld_phone">
        </div>

        <div id="f_location_id" class="form-group">
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
                    all_categories($category_id);
                ?>
            </select>
        </div>

        <div id="f_title" class="form-group f_title">
            <label for="fld_title" class="form-label">Название объявления</label>
            <input type="text" maxlength="50" class="form-control" value="<?php if(isset($edit_form['title'])) echo $edit_form['title']; ?>" name="title" id="fld_title">
        </div>
        
        <div class="form-group">
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label>
            <textarea maxlength="3000" name="description" id="fld_description" class="form-control"><?php if(isset($edit_form['description'])) echo $edit_form['description']; ?></textarea>
        </div>
        
        <div id="price_rw" class="form-group rl">
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label>
            <input type="text" maxlength="9" class="form-input-text-short" value="<?php if(isset($edit_form['price'])) echo $edit_form['price']; ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>
        </div>
        <input type="hidden" name="id" value="<?php if(isset($_GET['edit'])) echo $_GET['edit']?>"/>
        <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Отправить</button>
        </div>

    </form>
    <div class="row">
        <h2>Все объявления</h2>
        <?php
        if(array_key_exists('ads', $_SESSION) && !empty($_SESSION['ads'])){
            foreach ($_SESSION['ads'] as $id=>$value){
                echo '<a style="border-bottom:1px solid orange" href="?edit='. $id . '">' . $value['title'] . '</a>|' . $value['price'] . '|' . $value['seller_name'] . '| <a href="?del=' . $id . '">Удалить</a><br/>';
            }
        }
        ?>
    </div>
    </div>

</body>
</html>