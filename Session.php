<?php
namespace Frugue\Core;
# 2021-10-28 "Improve the custom session data handling interface": https://github.com/mage2pro/core/issues/163
final class Session extends \Df\Customer\SessionBase {
	/**
	 * 2018-04-13, 2021-10-28
	 * @used-by \Frugue\Store\Plugin\Framework\App\FrontControllerInterface::aroundDispatch()
	 * @param string $v [optional]
	 * @return $this|string
	 */
	function country($v = DF_N) {return df_prop($this, $v, []);}

	/**
	 * 2018-04-13, 2021-10-28
	 * @used-by \Frugue\Store\Plugin\Framework\App\FrontControllerInterface::aroundDispatch()
	 * @param bool|string $v [optional]
	 * @return $this|bool
	 */
	function redirected($v = DF_N) {return df_prop($this, $v, []);}
}