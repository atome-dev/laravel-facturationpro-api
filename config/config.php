<?php

/*
 * You can place your custom package configuration in here or declare de constants in the .env file.
 */
return [
	'url'  => env('FACTURATION_PRO_API_URL', 'https://www.facturation.pro'),
	'id'   => env('FACTURATION_PRO_API_ID', ''),
    'key'  => env('FACTURATION_PRO_API_KEY', ''),
    'firm' => env('FACTURATION_PRO_API_FIRM', ''),
    'ua'   => env('FACTURATION_PRO_API_USER_AGENT', ''),
];
