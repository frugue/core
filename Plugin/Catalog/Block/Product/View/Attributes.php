<?php
namespace Frugue\Core\Plugin\Catalog\Block\Product\View;
use Magento\Catalog\Block\Product\View\Attributes as Sb;
// 2018-04-08
final class Attributes {
	/**
	 * 2018-04-08 https://www.upwork.com/ab/f/contracts/19688421
	 * @see \Magento\Catalog\Block\Product\View\Attributes::getAdditionalData()
	 * https://github.com/magento/magento2/blob/2.1.9/app/code/Magento/Catalog/Block/Product/View/Attributes.php#L69-L105
	 * @param Sb $sb
	 * @param array(string => array(string => string)) $r
	 * @return array(string => array(string => string))
	 */
	function afterGetAdditionalData(Sb $sb, array $r) {return array_filter($r, function(array $a) {return
		(string)__('N/A') !== (string)$a['value']
	;});}
}