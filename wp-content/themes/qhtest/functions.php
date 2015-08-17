<?php
//Do uu tien mac dinh la 10
//Wordpress chi cho add_action mac dinh 1 paramter
add_action('qh_right', function($klq, $clq){
	echo 'Cot ben trai';
	$a = array('a', 'b', 'c');
	foreach ($a as $value) {
		echo $value;
	}
	echo $clq . $klq;
	echo '<br/>';
}, 11, 2);

add_action('qh_right', function($klq){
	echo 'Cot ben tren' . $klq;
	echo '<br/>';
});

add_action('qh_right', function(){
	echo 'Day la quang cao duoc dat';
	echo '<br/>';
}, 9);

// function in_quang_cao()
// {
// 	echo 'Day la poster';
// }

// class QHTest
// {
// 	public function __construct()
// 	{
// 		add_action('qh_left', array($this, 'in_quang_cao'));
// 	}
// 	public function in_quang_cao()
// 	{
// 		echo 'Day la poster';
// 	}
// }

// $qhtest = new QHTest();

/* add_action('qh_title', function(){
	echo 'Demo page';
}); */
//add filter do uu tien 10
/* add_filter('qh_title', function($data){
	return '<p>' . $data . '</p>';
});

add_filter('qh_title', function($data){
	return '<div  class="deptrai">' . $data . '</div>';
}, 11);

add_filter('qh_title', function($data){
	return $data . '<p>day la uu tien 12</p>';
}, 12); */

add_action('qh_left', function(){
	//$colors = array('red', 'blue', 'green');
	$colors = apply_filters('qh_colors', array('red', 'blue', 'green'));
	$colors[1] = str_replace('blue', 'yellow', $colors[1]);
	echo implode(' ', $colors);
});

add_filter('qh_colors', function($data){
	$data[] = 'White';
	$data[] = 'Pink';
	$data[1] = 'blue';
	return $data;
});

//doi so dau tien cua filter la luon luon gia tri tra ve cua filter trc no hoac la tham so dau tien cua filter truyenv vao
add_filter('qh_title', function($a, $b){
	return '<p>' . $a . $b . '</p>';
}, 10, 2);
add_filter('qh_title', function($a, $b){
	return '<div class="ab">' . $a . '</div>';
}, 11, 2);

