<?php
/**
 * @version		mod_xtrmcookie_advertising.php, build date : 12 jun. 2018
 * @package		Xtrm-Addons
 * @subpackage	mod_xtrmcookie_advertising
 * @copyright	Copyright (C) 2015+ XtrmAddons.COM. All rights reserved.
 * @license		https://www.gnu.org/licenses/lgpl-3.0.html GNU/GPL
 * Xtrm-Addons! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */


/** No direct access */
defined('_JEXEC') or die;

// The following line loads the MooTools JavaScript Library.
JHtml::_('behavior.framework', true);
JHTML::_('behavior.modal');

// Add cookie support for JQuery
JFactory::getDocument()->addScript(JURI::base(true).'/media/mod_xtrmcookie_advertising/js/jquery.cookie.min.js');

// Check for cookie
$config 	= JFactory::getConfig();
$name		= $config->get('sitename');
$cookieName = md5('xtrmcookie_advertising:'.$name);
$show		= JFactory::getApplication('site')->input->cookie->getBool($cookieName);

// Set button for cgu
$linkTitle = $params->get('btn_text_cgu');
if(empty($linkTitle))
{
	$linkTitle = JText::_('MOD_XTRMCOOKIE_ADVERTISING_TEXT_BTN_TEXT_CGU');
}

// Set validate button
$btnTitle = $params->get('btn_text_validate');
if(empty($btnTitle))
{
	$btnTitle = JText::_('MOD_XTRMCOOKIE_ADVERTISING_TEXT_BTN_TEXT_VALIDATE');
}

// Add script ?>
<?php if(empty($show) || $params->get('display')) : ?>
<script>
jQuery(document).ready(function($) {
	var xCookieAdvertising = $('#xCookieAdvertising');
	jQuery('body').append(xCookieAdvertising);

	jQuery('.acceptCGU').click(function(){
		jQuery.cookie('<?php echo $cookieName; ?>', 1);
		xCookieAdvertising.remove();
	});
});
</script>

<?php 
// Create link to cgu
require_once JPATH_BASE.'/components/com_content/helpers/route.php';
$uri      = JUri::getInstance();
$base     = $uri->toString(array('scheme', 'host', 'port'));
$link     = $base . JRoute::_(ContentHelperRoute::getArticleRoute($params->get('id_article')), false);
$link    .= strpos($link, '?') === true ? '&' : '?';
$link    .= 'tmpl=component';

// Create style
$style   = array();
$style[] = 'position:fixed';
$style[] = 'z-index:2000';
$style[] = $params->get('position').':0';
$style[] = 'left:0';
$style[] = 'margin:0';
$style[] = 'padding:0';
$style[] = 'width:100%';
$style[] = 'background:#333';
$style   = implode(';', $style);
?>

<div id="xCookieAdvertising" class="rt-block" style="<?php echo $style; ?>">
	<div class="rt-block" style="padding:0">
		<?php echo $params->get('description'); ?>
		<a class="btn modal" rel="{handler: 'iframe', size: {x:800, y:500}}" href="<?php echo $link; ?>"><?php echo $linkTitle; ?></a>
		<button type="button" class="btn btn-primary acceptCGU" style="float:right"><?php echo $btnTitle; ?></button>
	</div>
</div>
<?php endif; ?>