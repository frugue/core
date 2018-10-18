<?php
namespace Frugue\Core\Plugin\Directory\Model\Resource\Country;
use Magento\Directory\Model\AllowedCountries;
use Magento\Directory\Model\ResourceModel\Country\Collection as Sb;
use Magento\Store\Model\ScopeInterface as IScope;
use Magento\Store\Model\Store;
// 2018-05-13
final class Collection {
	/**
	 * 2018-05-13
	 * «Магазин frugue США будет обслуживать всех клиентов за исключением 28 стран Евросоюза.
	 * В корзине, в момент checkout'a, в бегунке со списком стран, не должно быть 28 стран ЕС.»:
	 * https://github.com/mage2pro/frugue.com/issues/4
	 * @see \Magento\Directory\Model\ResourceModel\Country\Collection::loadByStore()
	 * https://github.com/magento/magento2/blob/2.2.4/app/code/Magento/Directory/Model/ResourceModel/Country/Collection.php#L165-L181
	 * 2018-10-18
	 * "«Carrier with such method not found» for the US store":
	 * https://github.com/frugue/core/issues/45
	 * @see \Frugue\Core\Plugin\Sales\Model\Quote::afterGetAllAddresses()
	 * @param Sb $sb
	 * @param \Closure $f
	 * @param null|int|string|Store $s [optional]
	 * @return Sb
	 */
	function aroundLoadByStore(Sb $sb, \Closure $f, $s = null) {
		if ('us' !== df_store_code($s)) {
			$f($s);
		}
		else {
			$m = df_o(AllowedCountries::class); /** @var AllowedCountries $m */
			$sb->addFieldToFilter('country_id', ['in' => array_diff(
				$m->getAllowedCountries(IScope::SCOPE_STORE, $s), df_eu()
			)]);
		}
		return $sb;
	}
}