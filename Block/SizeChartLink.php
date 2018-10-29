<?php
namespace Frugue\Core\Block;
use Magento\Framework\View\Element\AbstractBlock as _P;
/**
 * 2018-10-29
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * «Add a bra size chart to product pages»: https://github.com/frugue/core/issues/46
 * @used-by vendor/frugue/core/view/frontend/layout/catalog_product_view.xml
 */
class SizeChartLink extends _P {
	/**
	 * 2018-10-29
	 * @override
	 * @see _P::_toHtml()
	 * @used-by _P::toHtml():
	 *		$html = $this->_loadCache();
	 *		if ($html === false) {
	 *			if ($this->hasData('translate_inline')) {
	 *				$this->inlineTranslation->suspend($this->getData('translate_inline'));
	 *			}
	 *			$this->_beforeToHtml();
	 *			$html = $this->_toHtml();
	 *			$this->_saveCache($html);
	 *			if ($this->hasData('translate_inline')) {
	 *				$this->inlineTranslation->resume();
	 *			}
	 *		}
	 *		$html = $this->_afterToHtml($html);
	 * https://github.com/magento/magento2/blob/2.2.0/lib/internal/Magento/Framework/View/Element/AbstractBlock.php#L643-L689
	 * @return string
	 */
	final protected function _toHtml() {return df_tag('a', [
		'class' => 'frugue-size-conversion-chart-link', 'href' => df_url_frontend('size-conversion-chart')
	], __('Size conversion chart'));}
}