<?php
namespace Frugue\Core\Plugin\Swatches\Helper;
use Magento\Swatches\Helper\Media as Sb;
// 2019-03-27
final class Media {
	/**
	 * 2019-03-27
	 * «Upgrade Magento 2 from 2.1.9 to 2.3.0»: https://www.upwork.com/ab/f/contracts/21810726
	 * Magento > 2.1 forces swatches dimensions from the therme's etc/view.xml file.
	 * We want to preserve different swatches dimensions for the frontend product list and product view pages,
	 * so we need this plugin.
	 * @see \Magento\Swatches\Helper\Media::getImageConfig()
	 * https://github.com/magento/magento2/blob/2.3.0/app/code/Magento/Swatches/Helper/Media.php#L252-L267
	 * @param Sb $sb
	 * @param array(string => array(string => string)) $r
	 * @return array(string => array(string => string))
	 */
	function afterGetImageConfig(Sb $sb, array $r) {
		$size = df_is_catalog_product_list() ? 22 : (
			df_is_catalog_product_view() ? 46 : null
		); /** @var int|null $size */
		;
		return df_extend($r, !$size ? [] : array_combine(
			['swatch_image', 'swatch_thumb', 'swatch_image_base', 'swatch_thumb_base']
			,array_fill(0, 4, ['height' => $size, 'width' => $size])
		));
	}
}