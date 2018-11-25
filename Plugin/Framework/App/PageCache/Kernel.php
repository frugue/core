<?php
namespace Frugue\Core\Plugin\Framework\App\PageCache;
use Magento\Framework\App\PageCache\Kernel as Sb;
use Magento\Framework\App\Response\Http as R;
// 2018-10-24
final class Kernel {
	/**
	 * 2018-10-24
	 * @see \Magento\Framework\App\PageCache\Kernel::process()
	 * @param Sb $sb
	 * @param R $r
	 * @return R[]
	 */
	function beforeProcess(Sb $sb, R $r) {
		$html = $r->getBody();
		if (false !== stripos($html, "</body>") && df_is_home()) {
			preg_match_all('~<\s*\blink\b[^>]*\/>~is', $html, $links);
			if ($links && isset($links[0]) && $links[0]) {
				$isHome = df_is_home(); /** @var bool $isHome */
				foreach ($links[0] as $l) {
					if (false === strpos($l, 'rel="icon"')) {
						$html = str_replace($l, '', $html);
						if (!$isHome || !df_contains($l,
								'Amasty_Shopby'
								,'Df_Catalog'
								,'mage/calendar'
								,'newsletter_popup'
								,'TemplateMonster_CountdownTimer'
								,'TemplateMonster_FeaturedProduct'
								,'TemplateMonster_LayoutSwitcher'
								,'TemplateMonster_Parallax'
								,'TemplateMonster_ShopByBrand'
							)) {
							$html = str_ireplace("</body>", "$l</body>", $html);
						}
					}
				}
			}
			preg_match_all('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', $html, $s);
			if ($s and isset($s[0]) and $s[0]) {
				$html = preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $html);
				$s[0] = array_filter($s[0], function($v) {return !df_contains($v,
					'Df_Core'
				);});
				$s = implode("", $s[0]);
				$html = str_ireplace("</body>", "$s</body>", $html);
			}
			$r->setBody($html);
		}
		return [$r];
	}
}