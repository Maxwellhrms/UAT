<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------
| JWT Secure Key
|--------------------------------------------------------------------------
*/
//$config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJss9';
// $config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg'; //old
/*
Author      : Shababu 
Description : These Key is Generated After Hasing The Epos@786 with sha256 ie hash('sha256','Epos@786)';
*/
$config['jwt_key'] = '8033d8944bdb25ba68a44c5fb0ad1d59d392f79eb3aa84af55412dff4ae88bcb'; //old


/*
|-----------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
*/
$config['jwt_algorithm'] = 'HS256';


/*
|-----------------------
| Token Request Header Name
|--------------------------------------------------------------------------
*/
$config['token_header'] = 'authorization';


/*
|-----------------------
| Token Expire Time

| https://www.tools4noobs.com/online_tools/hh_mm_ss_to_seconds/
|--------------------------------------------------------------------------
| ( 1 Day ) : 60 * 60 * 24 = 86400
| ( 1 Hour ) : 60 * 60     = 3600
| ( 1 Minute ) : 60        = 60
*/
// $config['token_expire_time'] = 3000000000000000;