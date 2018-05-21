<?php
/* Smarty version 3.1.32, created on 2018-05-20 19:17:26
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b01ada66499a0_17781665',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ee6d1d4da2a86e09bdf12a71ebf44ff86dfbcce' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/search.tpl',
      1 => 1526724753,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
),false)) {
function content_5b01ada66499a0_17781665 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>User Profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="smarty/templates/style.css">
<?php echo '<script'; ?>

	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>

	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</head>
<body>

	<?php $_smarty_tpl->assign('uType',$_smarty_tpl->smarty->registered_objects['user'][0]->getType(array(),$_smarty_tpl));?>
 
	<?php $_smarty_tpl->assign('uName',$_smarty_tpl->smarty->registered_objects['user'][0]->getName(array(),$_smarty_tpl));?>


	<?php $_smarty_tpl->_subTemplateRender("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			<h4>Search Results for <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
's <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['string']->value;?>
: </h4>
			<?php if ($_smarty_tpl->tpl_vars['objects']->value != NULL) {?>
			<table class="table table-responsive">
				<tbody>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['objects']->value, 'object');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['object']->value) {
?>
					<tr>
						<?php if ($_smarty_tpl->tpl_vars['key']->value == "Song") {?>
						<td><a href="song.php?id=<?php echo $_smarty_tpl->tpl_vars['object']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['object']->value->getName();?>
</a></td>
						<?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "Musician") {?>
						<td><a href="profile.php?id=<?php echo $_smarty_tpl->tpl_vars['object']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['object']->value->getName();?>
</a></td>
						<?php }?>
						<td><?php echo $_smarty_tpl->tpl_vars['object']->value->getGenre();?>
</td>
					</tr>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</tbody>
			</table>
			<?php } else { ?>
			<p>No <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 found for <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['string']->value;?>
 .</p> 
			<?php }?>

		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

<?php }
}