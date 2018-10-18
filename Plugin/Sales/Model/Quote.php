<?php
namespace Frugue\Core\Plugin\Sales\Model;
use Magento\Quote\Model\Quote as Sb;
use Magento\Quote\Model\Quote\Address as A;
use Magento\Quote\Model\ResourceModel\Quote\Address\Collection as AC;
// 2018-10-18
final class Quote {
	/**
	 * 2018-10-18
	 * 1) "«Carrier with such method not found» for the US store":
	 * https://github.com/frugue/core/issues/45
	 * 2) «Магазин frugue США будет обслуживать всех клиентов за исключением 28 стран Евросоюза.
	 * В корзине, в момент checkout'a, в бегунке со списком стран, не должно быть 28 стран ЕС.»:
	 * https://github.com/mage2pro/frugue.com/issues/4
	 * @see Sb::getAddressesCollection()
	 * https://github.com/magento/magento2/blob/2.1.9/app/code/Magento/Quote/Model/Quote.php#L1088-L1105
	 *	public function getAddressesCollection() {
	 *		if (null === $this->_addresses) {
	 *			$this->_addresses =
	 * 				$this->_quoteAddressFactory->create()->getCollection()->setQuoteFilter($this->getId())
	 * 			;
	 *			if ($this->getId()) {
	 *				foreach ($this->_addresses as $address) {
	 *					$address->setQuote($this);
	 *				}
	 *			}
	 *		}
	 *		return $this->_addresses;
	 *	}
	 * @param Sb $sb
	 * @param AC $r
	 * @return AC
	 * @return Sb
	 */
	function afterGetAddressesCollection(Sb $sb, AC $r) {
		if ('us' === $sb->getStore()->getCode()) {
			foreach(df_filter($r, function(A $a) {return
				'shipping' === $a->getAddressType() && df_eu($a->getCountryId())
			;}) as $a) {
				/** @var A $a */
				$r->removeItemByKey($a->getId());
			}
		}
		return $r;
	}

	/**
	 * 2018-10-18
	 * 1) "«Carrier with such method not found» for the US store":
	 * https://github.com/frugue/core/issues/45
	 * 2) «Магазин frugue США будет обслуживать всех клиентов за исключением 28 стран Евросоюза.
	 * В корзине, в момент checkout'a, в бегунке со списком стран, не должно быть 28 стран ЕС.»:
	 * https://github.com/mage2pro/frugue.com/issues/4
	 * @see Sb::getShippingAddress()
	 * https://github.com/magento/magento2/blob/2.1.9/app/code/Magento/Quote/Model/Quote.php#L1088-L1105
	 *	public function getShippingAddress() {
	 *		return $this->_getAddressByType(Address::TYPE_SHIPPING);
	 *	}
	 * @param Sb $sb
	 * @param \Closure $f
	 * @return A
	 * @return Sb
	 */
	function aroundGetShippingAddress(Sb $sb, \Closure $f) {
		$r = df_find($sb->getAddressesCollection(), function(A $a) {return
			!$a->isDeleted() && 'shipping' === $a->getAddressType()
		;}); /** @var A|null */
		if (!$r) {
			$r = df_new_omd(A::class, $sb->getBillingAddress()->getData());
			$r->unsetData('address_id');
			$r->setAddressType('shipping');
			$sb->addAddress($r);
		}
		return $r;
	}
}