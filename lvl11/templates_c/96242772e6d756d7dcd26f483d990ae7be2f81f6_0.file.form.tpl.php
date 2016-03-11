<?php
/* Smarty version 3.1.30-dev/28, created on 2016-03-01 11:12:30
  from "/home/ubuntu/workspace/lvl10/templates/form.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/28',
  'unifunc' => 'content_56d5791e844255_85194390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96242772e6d756d7dcd26f483d990ae7be2f81f6' => 
    array (
      0 => '/home/ubuntu/workspace/lvl10/templates/form.tpl',
      1 => 1456041987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56d5791e844255_85194390 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once '/home/ubuntu/workspace/lvl10/libs/plugins/function.html_options.php';
?>
<div class="container col-sm-4 col-sm-offset-4">

    <div class="row">
        <form method="post" class="form-horizontal" action="<?php if (isset($_GET['edit'])) {?>?action=update<?php }?>">
            <div class="form-group">

                <label class="col-sm-5 col-sm-offset-1 radio-inline">
                    <input type="radio"  value="1" name="forma"<?php if ($_smarty_tpl->tpl_vars['formParam']->value['forma'] == 1) {?> checked="checked"<?php }?> >Частное лицо
                </label>
                <label class="col-sm-5  radio-inline">
                    <input type="radio"  value="0" name="forma" <?php if ($_smarty_tpl->tpl_vars['formParam']->value['forma'] == 0) {?> checked="checked"<?php }?>>Компания
                </label>
            </div>

            <div class="form-group">
                <label for="fld_seller_name" class="form-label col-sm-5"><b id="your-name">Ваше имя</b></label>
                <input type="text" maxlength="40" class="col-sm-7" value="<?php echo $_smarty_tpl->tpl_vars['formParam']->value['seller_name'];?>
" name="seller_name" id="fld_seller_name">
            </div>

            <div class="form-group">
                <label for="fld_email" class="form-label col-sm-5">Электронная почта</label>
                <input type="text" class="col-sm-7" value="<?php echo $_smarty_tpl->tpl_vars['formParam']->value['email'];?>
" name="email" id="fld_email">
            </div>

            <div class="form-group">
                <label class="col-sm-12" for="allow_mails">
                    <input type="checkbox" name="newsletter" value="1" id="allow_mails" <?php if ($_smarty_tpl->tpl_vars['formParam']->value['newsletter'] == 1) {?> checked="checked"<?php }?>>
                    <span>Я не хочу получать вопросы по объявлению по e-mail</span>
                </label>
            </div>

            <div class="form-group">
                <label for="fld_phone" class="form-label col-sm-5">Номер телефона</label>
                <input type="text" class="col-sm-7" value="<?php echo $_smarty_tpl->tpl_vars['formParam']->value['phone'];?>
" name="phone" id="fld_phone">
            </div>

            <div id="f_location_id" class="form-group">
                <label for="region" class="form-label col-sm-5">Город</label>

                <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select col-sm-7">
                    <option value="">-- Выберите город --</option>
                    <option class="opt-group" disabled="disabled">-- Города --</option>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['cities']->value,'selected'=>$_smarty_tpl->tpl_vars['formParam']->value['location_id']),$_smarty_tpl);?>

                    <option id="select-region" value="0">Выбрать другой...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fld_category_id" class="form-label col-sm-5">Категория</label>

                <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select col-sm-7">
                    <option value="">-- Выберите категорию --</option>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['categories']->value,'selected'=>$_smarty_tpl->tpl_vars['formParam']->value['category_id']),$_smarty_tpl);?>

                </select>
            </div>

            <div id="f_title" class="form-group f_title">
                <label for="fld_title" class="form-label">Название объявления</label>
                <input type="text" maxlength="50" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['formParam']->value['title'];?>
" name="title" id="fld_title">
            </div>

            <div class="form-group">
                <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label>
                <textarea maxlength="3000" name="description" id="fld_description" class="form-control"><?php echo $_smarty_tpl->tpl_vars['formParam']->value['description'];?>
</textarea>
            </div>

            <div id="price_rw" class="form-group rl">
                <label id="price_lbl" for="fld_price" class="form-label">Цена</label>
                <input type="text" maxlength="9" class="form-input-text-short" value="<?php echo $_smarty_tpl->tpl_vars['formParam']->value['price'];?>
" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>
            </div>
            <input type="hidden" name="id" value="<?php if (isset($_GET['edit'])) {
echo $_GET['edit'];
}?>"/>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Отправить</button>
            </div>

        </form>
    </div><?php }
}
