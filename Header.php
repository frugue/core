<?php
namespace Dfe\Frugue;
use Magento\Framework\View\Element\AbstractBlock as _P;
// 2018-05-12
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class Header extends _P {
	/**
	 * 2018-05-12
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
	final protected function _toHtml() {return df_tag('div', 'header-info dfe-frugue-header',
		df_tag('div', 'container',
			'<i class="icon-truck"></i>Need EU shipping? Please <a href="javascript:void(0)"><strong>switch to our EU store</strong></a>.'
			. ' Frugue USA <a href="javascript:void(0)">does not ship to EU</a>.')
	) . df_style_inline_hide('.rd-navbar .header-info');}
}