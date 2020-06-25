<?php
require __DIR__ . '/vendor/autoload.php';
use Josantonius\Session\Session;
Session::init(3600);

require 'constants.php';
require 'functions.php';

if( isset( $_REQUEST['control'] ) ) {
	if( $_REQUEST['control'] == 'reset' ) {
		Session::destroy();
		return;
	}

	if( !Session::get('count') )
		Session::set('count', 0);

	for ($key=0; $key < 2; $key++) { 
		if( $_REQUEST['control'] == $request_types[$key] ) {
			if( Session::get($session_keys[$key]) ) {
				echo 'ERROR: The family already has a ' . $session_keys[$key] . ' (No support for modern families yet. :))';
			} else {
				Session::set($session_keys[$key], 1);
				Session::set('count', Session::get('count') + 1);
				Session::set('cost', Session::get('cost') + $monthly_fee[$key]);
			}
		}
	}

	if( $_REQUEST['control'] == 'add_child' ) {
		if( ! Session::get('dad') || ! Session::get('mum') ) {
			echo 'ERROR: No child without a mum and a dad.';
		} else {
			setChildren('children');
		}
	}

	if( $_REQUEST['control'] == 'add_adapt_child' ) {
		if( ! Session::get('mum') ) {
			echo 'ERROR: No child without a mum.';
		} else {
			setChildren('adapt_children');
		}
	}

	for ($key=4; $key < 7; $key++) { 
		if( $_REQUEST['control'] == $request_types[$key] ) {
			if( ! Session::get('mum') && ! Session::get('dad') ) {
				echo 'ERROR: No ' . $session_keys[$key] . ' without a mum or a dad.';
			} else {
				if( ! Session::get($session_keys[$key]) ) {
					Session::set($session_keys[$key], 1);
				} else {
					Session::set($session_keys[$key], Session::get($session_keys[$key]) + 1);
				}

				Session::set('count', Session::get('count') + 1);
				Session::set('cost', Session::get('cost') + $monthly_fee[$key]);
			}
		}
	}

	return;
}

if( isset( $_REQUEST['refresh'] ) ) {
	echo displayFamilyInfo();
	return;
}
?>

<html>
<head>
	<title>Family Simulator</title>
</head>
<body>
<h1>Family Simulator</h1>
<form>
<input type="submit" name="add_mum" value="Add Mum" />
<input type="submit" name="add_dad" value="Add Dad" />
<input type="submit" name="add_child" value="Add Child" />
<input type="submit" name="add_adapt_child" value="Add Adapt Child" />
<input type="submit" name="add_cat" value="Add Cat" />
<input type="submit" name="add_dog" value="Add Dog" />
<input type="submit" name="add_goldfish" value="Add Goldfish" />
<input type="submit" name="reset" value="Reset" />
</form>

<div>
	<?php echo displayFamilyInfo() ?>
</div>


<script src="jquery-1.12.4.min.js"></script>
<script src="app.js"></script>
</body>
</html>

