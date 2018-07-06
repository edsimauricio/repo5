<?php
/**
 * @version		mod_xtrmtotop.php
 * @package		Xtrm-Addons
 * @subpackage	mod_xtrmtotop
 * @copyright	Copyright (C) 2015+ XtrmAddons.COM. All rights reserved.
 * @license		License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL, see LICENSE.php
 */

/** Check to ensure this file is included in Joomla! */
defined('_JEXEC') or die();

JFactory::getDocument()->addScript(JURI::base(true).'/media/mod_xtrmtotop/js/jquery.totop.min.js');

$p = new stdClass();
$keys = array('right', 'bottom', 'width', 'height', 'border', 'borderRadius', 'background', 'backgroundImage');

foreach($keys as $key)
{
	$v = $params->get($key);
	
	if(!empty($v))
	{
		$p->$key = $v;
	}
}

$p = json_encode($p);

$script  = '$(document).ready(function() {'.PHP_EOL
. 'var xst = new XtrmScrollTop('.$p.');'.PHP_EOL
. '});'.PHP_EOL;

JFactory::getDocument()->addScriptDeclaration($script);
?>