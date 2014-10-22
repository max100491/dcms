<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();


function headerChange(position, start, end){
	direction = x < position ? "down":"up";
	switch(direction){
		case "down":
			if (start <= position && position <= end){
					clearTimeout(timer);
					timer = setTimeout(function(){
						$('header').animate({backgroundColor:"rgba(0,0,0,0.3)"},animTime);
						$('#logo').animate({height:'50px',marginTop:0},animTime);
						$('.btn-toolbar').animate({marginTop:10},animTime)
					},animTime);
			};
		break;
		case "up":
			if (start <= position && position <= end){
				clearTimeout(timer);
				timer = setTimeout(function(){
					$('header').animate({backgroundColor:"rgba(0,0,0,0)"},animTime);
					$('#logo').animate({height:'95px'},animTime);
				},animTime);
			}
		break;
	}
	return false;
}