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
class RussianHelper extends AppHelper {

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
		'vkontakte',
		'odnoklassniki',
	);

/**
 * Russian Social Media Types and share urls
 *
 * @var array
 */
	protected $_types = array(
            'yandex'=>'http://my.ya.ru/posts_add_link.xml?URL=%s&title=%s',
            'moikrug'=>'http://moikrug.ru/share?url=%s&title=%s',
            'moimir'=>'http://connect.mail.ru/share?url=%s&title=%s',
            'odnoklassniki'=>'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.surl=%s&title=%s',
            'vkontakte'=>'http://vkontakte.ru/share.php?url=%s&title=%s',
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
 * - `sharethis` (boolean) Include the 'sharethis' button with the social type set. Default: true
 * - `publisher` (string) Your publisher ID obtained from [ShareThis](http://sharethis.com)
 * - `buttonJs` (string) URL to the Javascript for the ShareThis button
 * - `style` (string) Style type to use: (none) is default, 'large', or 'button'
 *
 * @var array
 */
	protected $_options = array(
		'style' => '',
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
                    $result .= $this->socialType($type,$options);
            }
            $this->_scripts($options);
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
            $innerText = '';
            $attributes = array('class'=>'ru_'.$type);
            if (in_array($options['style'], $this->_styles)) {
                    $attributes['class'] .= '_'.$options['style'];
            }
            if (!empty($options['url'])) {
                $url = $this->url($options['url'], true);
            }
            else
            {
                $url = $this->url(null, true);
            }
            if (!empty($options['title'])) {
                $title = $options['title'];
            }
            else
            {
                $title = Configure::read('title');
            }
            $innerText = $this->Html->tag('a',
                    $this->Html->tag('span',
                                     null,
                                     array('class'=>(!empty($options['style'])?('ru'.ucfirst($options['style'])):('chicklets')),
                                           'style'=>'background-image: url('.$this->Html->url('/cake_social/img/'.str_replace('ru_', '', $attributes['class']).'.png').');'
                                          )),
                    array(
                    'style'=>'text-decoration:none;color:#000000;display:inline-block;cursor:pointer;',
                    'class'=>'ruButton',
                    'href'=>  isset($this->_types[$type])?sprintf($this->_types[$type], $url, $title):'',
                    'target'=>'_blank'
                    )
                );
            return $this->Html->tag('span', $innerText, $attributes);
	}

/**
 * Generate required Javascript
 *
 * @param array $options Options
 * @return void
 */
	public function _scripts($options = array()) {
            $this->Html->css('/cake_social/css/cake_social',null, array('inline' => false));
        }
}
