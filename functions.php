<?php
require __DIR__ . '/vendor/autoload.php';
use Josantonius\Session\Session;
Session::init(3600);

function displayFamilyInfo() {
	require 'constants.php';
	if( !Session::get('count') ) {
		echo ' ';
		return;
	}

	if( Session::get('count') ) {
		echo '<h2>Family</h2>';

		echo '<ul>';
		for ($key=0; $key < 7; $key++) {
			if (Session::get($session_keys[$key])) {
				echo '<li>' . $messages_prefix[$key] . ': ' . Session::get($session_keys[$key]) . '</li>';
			}
		}

		echo '<li><b>Total Members</b>: ' . Session::get('count') . '</li>';
		echo '<li><b>Monthly Food Costs</b>: ' . Session::get('cost') . ' $ </li>';

		echo '</ul>';
	}
}

function setChildren($sesstion_key){
	if( ! Session::get($sesstion_key) ) {
		Session::set($sesstion_key, 1);
		Session::set('cost', Session::get('cost') + 150);
	} else {
		Session::set($sesstion_key, Session::get($sesstion_key) + 1);
		Session::set('cost', Session::get('cost') + 100);
	}
	Session::set('count', Session::get('count') + 1);
}

?>