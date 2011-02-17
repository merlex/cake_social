<?php
/**
 * Copyright 2011, Alexandr Merekin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Alexandr Merekin
 * @copyright Copyright 2011, Alexandr Merekin
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
//App::import('Helper', array('CakeSocial.Russian', 'CakeSocial.ShareThis'));
/**
 * Russian Helper
 *
 * Useful view helper for the Russian Social service
 *
 * @package default
 * @subpackage cake_social.views.helpers
 */
class CakeSocialHelper extends AppHelper {

/**
 * View helpers
 *
 * @var array
 */
	public $helpers = array('Html','CakeSocial.Russian', 'CakeSocial.ShareThis');
/**
 * Default Social Types
 *
 * @var array
 */
	protected $_defaultTypes = array(
		'twitter',
		'facebook',
	);

/**
 * Russian Social Media Types and share urls
 *
 * @var array
 */
	protected $_types = array(
            'yandex',
            'moikrug',
            'moimir',
            'odnoklassniki',
            'vkontakte',
	);

/**
 * Allowed styles
 *
 * @var array
 */
	protected $_styles = array(
		'large',
		'button',
	);

/**
 * Russian Helper
 *
 * @var RussianHelper
 */
	protected $_Russian;

/**
 * ShareThis Helper
 *
 * @var ShareThisHelper
 */
	protected $_ShareThis;

/**
 * Default options
 *
 * ### Options
 *
 * - `style` (string) Style type to use: (none) is default, 'large', or 'button'
 *
 * @var array
 */
	protected $_options = array(
		'publisher' => '',
		'buttonJs' => 'http://w.sharethis.com/button/buttons.js',
		'style' => '',
		'embeds' => 'true'
	);

/**
 * Constructor
 *
 * Takes options to configure instance variables
 *
 * ### Options
 *
 * @param array $options
 */
	public function __construct($options = array()) {
            $this->_options = array_merge($this->_options, $options);
            //$this->_ShareThis = new ShareThisHelper($this->_options);
            //$this->_Russian = new RussianHelper($this->_options);
	}

/**
 * Display the Russian widget
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
                if(in_array($type, $this->_types))
                {
                    $result .= $this->Russian->display(array($type),$options);
                }
                else
                {
                    $result .= $this->ShareThis->display(array($type),$options);
                }
            }
            return $result;
	}
}
