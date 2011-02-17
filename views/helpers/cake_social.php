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

/**
 * CakeSocial Helper
 *
 * Useful view helper for the Social service
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
 * Russian Social Media Types
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
	}

/**
 * Display share widget
 *
 * @param array $types Social Media types
 * @param array $options Display options
 * @return string Html for the CakeSocial widget
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
