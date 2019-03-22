<?php 

return [
//Data for database connexion
	'db' =>[
		'server'   =>  'localhost',
		'dbname'   =>  'blog_ecrivain',
		'dbuser'   =>  'root',
		'dbpass'   =>  '',
	],

//Allowed image extensions
	'image_extensions'   =>  [
					'gif',
					'jpg',
					'jpeg',
					'png',
					'webp',
					'raw',
					'bmp',
	],

//Setting for the site
	'site_settings'   =>  [
					'site_name',
					'site_email',
					'site_status',
					'comments_status',
					'site_close_msg',
					'episodes_in_home',
	],
];

