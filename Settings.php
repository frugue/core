<?php
namespace Dfe\Frugue;
// 2018-05-13
/** @method static Settings s() */
final class Settings extends \Df\Shipping\Settings {
	/**
	 * 2018-05-13
	 * @override
	 * @see \Df\Shipping\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'dfe_frugue/shipping';}
}