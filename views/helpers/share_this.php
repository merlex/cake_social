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

/**
 * ShareThis Helper
 *
 * Useful view helper for the ShareThis service
 *
 * @package default
 * @subpackage cake_social.views.helpers
 */
class ShareThisHelper extends AppHelper {

/**
 * View helpers
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Default Social Types
 *
 * @var array
 */
	protected $_defaultTypes = array(
		'twitter',
		'facebook',
		'ybuzz',
		'gbuzz',
		'email',
	);

/**
 * Social Media Types
 *
 * @var array
 */
	protected $_types = array(
		'aim',
		'bebo', 'blinklist', 'blogger', 'businessweek',
		'care2', 'current',
		'dealsplus', 'delicious', 'digg', 'dilgo',
		'facebook', 'fark', 'faves', 'fresqui', 'friendfeed', 'funp',
		'google_bmarks',
		'kirsty',
		'linkedin',
		'meaneame', 'messenger', 'mister_wong', 'mixx', 'myspace',
		'n4g', 'newsvine',
		'oknotizie',
		'propeller',
		'reddit',
		'simpy', 'slashdot', 'sonico', 'sphinn', 'stumbleupon',
		'technorati', 'twackle', 'twine', 'twitter',
		'windows_live',
		'xanga',
		'yahoo_bmarks', 'ybuzz', 'yigg',
	);
/**
 * Russian Social Media Types
 *
 * @var array
 */
	protected $_rutypes = array(
		'yaru','moikrug', 'moimir', 'odnoklassniki', 'vkontakte',
	);

/**
 * Allowed styles
 *
 * @var array
 */
	protected $_styles = array(
		'large',
		'button',
		'vcount',
		'hcount',
	);

/**
 * Default options
 *
 * ### Options
 *
 * - `sharethis` (boolean) Include the 'sharethis' button with the social type set. Default: true
 * - `publisher` (string) Your publisher ID obtained from [ShareThis](http://sharethis.com)
 * - `buttonJs` (string) URL to the Javascript for the ShareThis button
 * - `style` (string) Style type to use: (none) is default, 'large', or 'button'
 *
 * @var array
 */
	protected $_options = array(
		'sharethis' => true,
		'publisher' => '',
		'buttonJs' => array('http://w.sharethis.com/button/buttons.js','http://yandex.st/share/share.js'),
		'style' => '',
		'embeds' => 'true'
	);

/**
 * Constructor
 *
 * Takes options to configure instance variables like publisher
 *
 * ### Options
 *
 * - `publisher` (string) Publisher key from [ShareThis](http://sharethis.com)
 *
 * @param array $options 
 */
	public function __construct($options = array()) {
		$this->_options = array_merge($this->_options, $options);
	}

/**
 * Display the ShareThis widget
 *
 * @param array $types Social Media types (See ShareThisHelper::$_types)
 * @param array $options Display options (See ShareThisHelper::$_options)
 * @return string Html for the ShareThis widget
 */
	public function display($types = array(), $options = array()) {
		if (is_array($types)) {
			if (empty($types)) {
				$types = $this->_defaultTypes;
			}
		} else {
			$types = array();
		}

		$options = array_merge($this->_options, $options);
		$result = '';
		foreach ($types as $type) {
			$result .= $this->socialType($type);
		}
		if ($options['sharethis']) {
			$result .= $this->socialType('sharethis');
		}
		$this->_scripts($options);
		$this->_ya_scripts($types);
		return $result;
	}

/**
 * Generate a single social type span element
 *
 * @param string $type Social type key (See ShareThisHelper::$_types)
 * @return string Social Type HTML
 */
	public function socialType($type, $options = array()) {
		$options = array_merge($this->_options, $options);
                if(in_array($type, $this->_rutypes))
                {
                    $attributes = array('class' => 'ya_' . $type,'id' => 'ya_' . $type);
                }
                else
                {
                    $attributes = array('class' => 'st_' . $type);
                }
		if (in_array($options['style'], $this->_styles)) {
			$attributes['class'] .= '_' . $options['style'];
		}
		if (!empty($options['url'])) {
			$attributes['st_url'] = $this->url($options['url'], true);
		}
		if (!empty($options['title'])) {
			$attributes['st_title'] = $options['title'];
		}
		return $this->Html->tag('span', '', $attributes);
	}

/**
 * Generate required Javascript
 *
 * @param array $options Options
 * @return void
 */
	public function _scripts($options = array()) {
		$options = array_merge($this->_options, $options);
		$this->Html->script($options['buttonJs'], array('inline' => false));
		$this->Html->ScriptBlock(sprintf(
			'stLight.options({publisher:\'%s\', embeds:%s});', $options['publisher'], $options['embeds']
		), array('inline' => false));
	}
/**
 * Generate required Javascript
 *
 * @param array $types Types
 * @return void
 */
	public function _ya_scripts($types = array()) {
                if(is_array($types)&&count($types))
                {
                    $src = '';
                    foreach ($types as $type)
                    {
                        if(in_array($type, $this->_rutypes))
                        {
                            $src .= sprintf(
                                    'Ya.share({element: \'ya_%s\',elementStyle: {\'quickServices\': [\'%s\']},onready: function(instance) {$(\'#ya_%s .b-share__handle\').first().remove();}});', $type, $type, $type
                            );
                        }
                    }
                    if($src)
                    {
                        $this->Html->ScriptBlock($src, array('inline' => false));
                    }
                }
	}
}
