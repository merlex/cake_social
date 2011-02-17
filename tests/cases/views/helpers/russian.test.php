<?php
/**
 * Copyright 2010, Graham Weldon (http://grahamweldon.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Graham Weldon (http://grahamweldon.com)
 * @copyright Copyright 2010, Graham Weldon (http://grahamweldon.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Helper', array('CakeSocial.Russian', 'Html'));

/**
 * TheJsTestController class
 *
 * @package       cake_social
 * @subpackage    cake_social.tests.views.helpers
 */
class TheJsTestController extends Controller {

/**
 * name property
 *
 * @var string 'TheTest'
 */
	public $name = 'TheTest';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}

/**
 * TheView class
 *
 * @package       cake_social
 * @subpackage    cake_social.tests.views.helpers
 */
class TheView extends View {

/**
 * scripts method
 *
 * @return void
 */
	public function scripts() {
		return $this->__scripts;
	}
}

/**
 * Russian Test Case
 *
 * @package cake_social
 * @subpackage cake_social.tests.views.helpers
 * @author Graham Weldon (http://grahamweldon.com)
 */
class RussianHelperTestCase extends CakeTestCase {

/**
 * Start Test
 *
 * Setup class vars for testing
 *
 * @return void
 */
	public function startTest() {
		$this->Russian = new RussianHelper();
		$this->Russian->Html = new HtmlHelper();
		$this->View =& new TheView(new TheJsTestController());
		ClassRegistry::addObject('view', $this->View);
	}

/**
 * End Test
 *
 * Clean up after each test is run
 *
 * @return void
 */
	public function endTest() {
		unset($this->Russian);
		ClassRegistry::removeObject('view');
		unset($this->View);
	}

/**
 * testSocialType
 *
 * @return void
 */
	public function testSocialType() {
		$expected = '<span class="ru_test"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="" target="_blank"><span class="chicklets" style="background-image: url(/cake/cake_social/img/test.png);"></a></span>';
		$result = $this->Russian->socialType('test');
		$this->assertIdentical($expected, $result);
	}

/**
 * testSocialTypeStyleLarge
 *
 * @return void
 */
	public function testSocialTypeStyleLarge() {
		$expected = '<span class="ru_test_large"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="" target="_blank"><span class="ruLarge" style="background-image: url(/cake/cake_social/img/test_large.png);"></a></span>';
		$result = $this->Russian->socialType('test', array('style' => 'large'));
		$this->assertIdentical($expected, $result);
	}

/**
 * testSocialTypeStyleButton
 *
 * @return void
 */
	public function testSocialTypeStyleButton() {
		$expected = '<span class="ru_test_button"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="" target="_blank"><span class="ruButton" style="background-image: url(/cake/cake_social/img/test_button.png);"></a></span>';
		$result = $this->Russian->socialType('test', array('style' => 'button'));
		$this->assertIdentical($expected, $result);
	}

/**
 * testSocialType with a custom page
 *
 * @return void
 */
	public function testSocialTypeStyleCustomPage() {
		$expected = '<span class="ru_test"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="" target="_blank"><span class="chicklets" style="background-image: url(/cake/cake_social/img/test.png);"></a></span>';
		$result = $this->Russian->socialType(
			'test',
			array('url' => 'http://example.com', 'title' => 42));
		$this->assertIdentical($expected, $result);
	}

/**
 * testDefault
 *
 * @return void
 */
	public function testDefault() {
		$expected = '<span class="ru_vkontakte"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="http://vkontakte.ru/share.php?url=http://example.com&amp;title=42" target="_blank"><span class="chicklets" style="background-image: url(/cake/cake_social/img/vkontakte.png);"></a></span><span class="ru_odnoklassniki"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.surl=http://example.com&amp;title=42" target="_blank"><span class="chicklets" style="background-image: url(/cake/cake_social/img/odnoklassniki.png);"></a></span>';
		$result = $this->Russian->display();
		$this->assertIdentical($expected, $result);
	}

/**
 * testSingle
 *
 * @return void
 */
	public function testSingle() {
		$expected = '<span class="ru_vkontakte"><a style="text-decoration:none;color:#000000;display:inline;cursor:pointer;" class="ruButton" href="http://vkontakte.ru/share.php?url=http://example.com&amp;title=42" target="_blank"><span class="chicklets" style="background-image: url(/cake/cake_social/img/vkontakte.png);"></a></span>';
		$result = $this->Russian->display(array('vkontakte'),
			array('url' => 'http://example.com', 'title' => 42));
		$this->assertIdentical($expected, $result);
	}
}
