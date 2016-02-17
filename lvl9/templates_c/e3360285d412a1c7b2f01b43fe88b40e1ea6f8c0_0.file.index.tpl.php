<?php
/* Smarty version 3.1.30-dev/28, created on 2016-02-17 18:44:54
  from "/home/ubuntu/workspace/lvl9/templates/index.tpl" */

if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/28',
  'unifunc' => 'content_56c4bfa62e9f09_51233351',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3360285d412a1c7b2f01b43fe88b40e1ea6f8c0' => 
    array (
      0 => '/home/ubuntu/workspace/lvl9/templates/index.tpl',
      1 => 1455734151,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form.tpl' => 1,
  ),
),false)) {
function content_56c4bfa62e9f09_51233351 ($_smarty_tpl) {
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The best site on the world!</title>
	<link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<?php $_smarty_tpl->_subTemplateRender("file:form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="clearfix"></div>
	<?php if (!empty($_smarty_tpl->tpl_vars['allads']->value)) {?>
		<div class="row">
			<h2>Все объявления:</h2>
			<ul>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allads']->value, 'i', false, 'id');
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
$__foreach_i_0_saved = $_smarty_tpl->tpl_vars['i'];
?>
				<li><a style="border-bottom:1px solid orange" href="?edit=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
</a>|<?php echo $_smarty_tpl->tpl_vars['i']->value['price'];?>
|<?php echo $_smarty_tpl->tpl_vars['i']->value['seller_name'];?>
|<a href="?del=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Удалить</a></li>
			<?php
$_smarty_tpl->tpl_vars['i'] = $__foreach_i_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
			</ul>
		</div>
	<?php }?>

	</div>
</body>
</html><?php }
}
