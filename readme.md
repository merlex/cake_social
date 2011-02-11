## CakeSocial CakePHP Plugin ##

The CakeSocial plugin for CakePHP allows for simple integration of social media into your CakePHP application.

### Supported ###

- Social link sharing and publicising for Twitter, Facebook, MySpace, Slashdot, Reddit and more. (total 44 social networks, uses [ShareThis](http://sharethis.com) service for access to social network's API)
- Social link sharing and publicising for 5 Russian social networks: Moikrug, Odnoklassniki, Moimir, Vkontakte, Yandex. (uses social network's API)

## CakePHP Version ##

This plugin is built for CakePHP 1.3 and above.

Upgrade from CakePHP 1.2 to CakePHP 1.3 takes about 5 minutes, checkout the awesome [migration guide](http://book.cakephp.org/view/1561/Migrating-from-CakePHP-1-2-to-1-3).

## Installation ##

### Downloading an archive ###

If you downloaded a tar.gz, tar.bz2 or zip file, extract the contents of the archive to your applications `/plugins` directory.

The result will be a `cake_social` directory under your `plugins` directory.

### Using a git submodule ###

Navigate to the root of your application, and add the CakeSocial plugin as a submodule with the following git command:

	git submodule add http://github.com/merlex/cake_social.git plugins/cake_social
	git submodule init
	git submodule update

## Usage ##

The simplest method of usage is to include each helper you want to use on your AppController class.

If you do not have one already, create the file `app_controller.php` in the root of your application, and add the following:

	<?php
	App::import('Helper', 'CakeSocial.CakeSocial');

	class AppController extends Controller {
		public $helpers = array(
			'CakeSocial.CakeSocial' => array(
				'publisher' => 'my-publisher-id',
			),
			'Session'
		);
	}

Now you can just display the widget on any page with the following CakePHP view code:

	echo $this->CakeSocial->display();

        or

	echo $this->CakeSocial->display(array('twitter','vkontakte','odnoklassniki','moikrug','yandex','moimir'));

Simple!

Note: The CakeSocial helper doesn't require the Session helper, its just included to show that other helpers go in there also, and to help copy+paste help vampires who after migrating to CakePHP 1.3, will get SessionHelper errors if they don't include it.

## Comments, Suggestions, and other... ##

I'd be more than thrilled to hear anyones experiences with this CakeSocial plugin.

If you have suggestions, enhancement requests, or bugs, please let me know.

## Contributors ##

* Predominant (Graham Weldon) [Website](http://grahamweldon.com)
* jose_zap (José Lorenzo Rodríguez)
* real34 (Pierre Martin) [Website](http://www.pierre-martin.fr)
