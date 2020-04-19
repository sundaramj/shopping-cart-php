<?php
$module_name = basename(dirname(dirname(__FILE__)));
$default_controller = 'default';
echo "<hr /><h1>DEBUG</h1><pre>";
print_r($default_controller);
echo "</pre>";
die();

return array(
'import' => array(
'application.modules.' . $module_name . '.models.*',
),

'modules' => array(
$module_name => array(
'defaultController' => $default_controller,
),
),

'components' => array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('admin/category/index'),
		),
'urlManager' => array(
'rules' => array(
$module_name . '/<action:\w+>/<id:\d+>' => $module_name . '/' . $default_controller . '/<action>',
$module_name . '/<action:\w+>' => $module_name . '/' . $default_controller . '/<action>',
),
),
),
);