<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The best site on the world!</title>
	<link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	{include file='form.tpl'}
	<div class="clearfix"></div>
	{if !empty($data)}
		<div class="row">
			<h2>Все объявления:</h2>
			<ul>
			{foreach from=$data key=id item=i}
				<li><a style="border-bottom:1px solid orange" href="?edit={$id}">{$i.title}</a>|{$i.price}|{$i.seller_name}|<a href="?del={$id}">Удалить</a></li>
			{/foreach}
			</ul>
		</div>
	{/if}

	</div>
</body>
</html>