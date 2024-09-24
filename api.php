<?php

$api = new Route;
$api->run('/api/register',		 			'register@register_data', 					'post');
$api->run('/api/register_update',			'register@register_update_data', 			'post');
$api->run('/api/logout',		 			'register@logout', 							'post');
$api->run('/api/login',			 			'register@login', 							'post');
$api->run('/api/register_product',			'register@register_product_data',  			'post');
$api->run('/api/register_product_update',	'register@register_product_update_data',   	'post');
$api->run('/api/forgot_pass',				'register@forgot_pass',		    			'post');
$api->run('/api/send_appeal',				'home@send_appeal',							'post');
$api->run('/api/send_call',					'home@send_call',							'post');
$api->run('/api/order',						'order@order_',								'post');
$api->run('/api/order2',					'order@order_2',							'post');
$api->run('/api/order_wait_faktura',		'order@order_wait_faktura',				    'post');
$api->run('/api/delete_order',				'order@delete_order',						'post');
$api->run('/api/payment_order',				'order@payment_order',						'post');
$api->run('/api/send_courier',				'courier_service@send_courier',				'post');
$api->run('/api/payment/([0-9]+)',			'payment@api',		                		'post|get');
$api->run('/api/payment_tl/([0-9]+)',		'payment@api_tl',		               		'post|get');
$api->run('/api/delivery',			        'payment@delivery',		               		'post|get');
$api->run('/api/delivery_tl',			    'payment@delivery_tl',		            	'post|get');
$api->run('/api/payment_status(.*)',	    'payment@payment_success',		        	'post|get');
