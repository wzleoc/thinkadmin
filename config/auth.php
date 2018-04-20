<?php
return [
	// 用户管理映射列表
	'admin/admin/index' => [
		'admin/admin/getdata'
	],
	'admin/admin/create' => [
		'admin/admin/store'
	],
	'admin/admin/edit' => [
		'admin/admin/update'
	],
	// 角色管理映射列表
	'admin/role/index' => [
		'admin/role/getroledata',
	],
	'admin/role/create' => [
		'admin/role/store'
	],
	'admin/role/edit'  => [
		'admin/role/update'
	],
	// 菜单管理映射列表
	'admin/menu/edit'  => [
		'admin/menu/update'
	]
];

?>