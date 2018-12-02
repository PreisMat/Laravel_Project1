<?php

	return array(
	"base_url"	=>"localhost:8000/config/oauth.php",
	"providers" =>array(
	"OpenID"	=>array ("enabled" => true),
	"Facebook"  =>array(
		"enabled"=>TRUE,
		"keys" => array("id" =>"APP_ID", "secret"
		=>"APP_SECRET"),
		"scope" => "email",
		)
	)
);