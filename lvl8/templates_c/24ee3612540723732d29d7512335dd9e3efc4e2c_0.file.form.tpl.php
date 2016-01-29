<?php
/* Smarty version 3.1.30-dev/28, created on 2016-01-29 22:46:40
  from "D:\webserver\htdocs\devschool\lvl8\templates\form.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/28',
  'unifunc' => 'content_56abddc0ba2c62_50597704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24ee3612540723732d29d7512335dd9e3efc4e2c' => 
    array (
      0 => 'D:\\webserver\\htdocs\\devschool\\lvl8\\templates\\form.tpl',
      1 => 1454101763,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56abddc0ba2c62_50597704 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'D:\\webserver\\htdocs\\devschool\\lvl8\\libs\\plugins\\function.html_options.php';
?>
<form method="post" class="form-horizontal" action="<?php if (isset($_GET['edit'])) {?>?action=update<?php }?>">
    <div class="form-group">

        <label class="col-sm-5 col-sm-offset-1 radio-inline">
            <input type="radio" value="1" name="forma">Частное лицо
        </label>
        <label class="col-sm-5  radio-inline">
            <input type="radio"  value="0" name="forma">Компания
        </label>
    </div>

    <div class="form-group">
        <label for="fld_seller_name" class="form-label col-sm-5"><b id="your-name">Ваше имя</b></label>
        <input type="text" maxlength="40" class="col-sm-7" value="" name="seller_name" id="fld_seller_name">
    </div>

    <div class="form-group">
        <label for="fld_email" class="form-label col-sm-5">Электронная почта</label>
        <input type="text" class="col-sm-7" value="" name="email" id="fld_email">
    </div>

    <div class="form-group">
        <label class="col-sm-12" for="allow_mails">
            <input type="checkbox" name="newsletter" value="1" id="allow_mails">
            <span>Я не хочу получать вопросы по объявлению по e-mail</span>
        </label>
    </div>

    <div class="form-group">
        <label for="fld_phone" class="form-label col-sm-5">Номер телефона</label>
        <input type="text" class="col-sm-7" value="" name="phone" id="fld_phone">
    </div>

    <div id="f_location_id" class="form-group">
        <label for="region" class="form-label col-sm-5">Город</label>



        <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select col-sm-7">
            <option value="">-- Выберите город --</option>
            <option class="opt-group" disabled="disabled">-- Города --</option>
            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['cities']->value,'selected'=>$_smarty_tpl->tpl_vars['current_city']->value),$_smarty_tpl);?>

            <option id="select-region" value="0">Выбрать другой...</option>
        </select>
    </div>

    <div class="form-group">
        <label for="fld_category_id" class="form-label col-sm-5">Категория</label>

        <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select col-sm-7">
            <option value="">-- Выберите категорию --</option>
            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['all_category']->value,'selected'=>$_smarty_tpl->tpl_vars['current_category']->value),$_smarty_tpl);?>

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
        <input type="text" maxlength="9" class="form-input-text-short" value="" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>
    </div>
    <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) {
echo $_GET['id'];
}?>"/>
    <div class="col-sm-12">
        <button type="submit" class="btn btn-success">Отправить</button>
    </div>

</form><?php }
}
