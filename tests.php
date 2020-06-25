<?php
require 'functions.php';
use Josantonius\Session\Session;
Session::init(3600);

/**
 * Unit Test
 */
class UnitTest extends \PHPUnit\Framework\TestCase
{
	
	public function testDisplayFamilyInfoDefault()
	{
		$family_info = displayFamilyInfo();
		$this->assertEquals($family_info, '');
	}

	public function testDisplayFamilyInfo()
	{
		Session::set('mum', 1);
		Session::set('dad', 1);
		Session::set('children', 1);
		Session::set('adapt_children', 1);
		Session::set('cat', 1);
		Session::set('dog', 1);
		Session::set('goldfish', 1);
		Session::set('count', 7);
		Session::set('cost', 727);

		$expected = '<h2>Family</h2><ul><li>Mum: 1</li><li>Dad: 1</li><li>Children: 1</li><li>Adapt Children: 1</li><li>Cats: 1</li><li>Dogs: 1</li><li>Goldfish: 1</li><li><b>Total Members</b>: 7</li><li><b>Monthly Food Costs</b>: 727 $ </li></ul>';
        $this->expectOutputString($expected);
        $family_info = displayFamilyInfo();
	}
}
