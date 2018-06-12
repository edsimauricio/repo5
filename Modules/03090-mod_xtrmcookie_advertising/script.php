<?php
/**
 * @version		script.php, build date : 12 jun. 2018
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

/** Check to ensure this file is included in Joomla! */
defined('_JEXEC') or die;



/**
 * Script file of Xtrm-Addons component.
 * 
 * @link        http://www.xtrmaddons.com/ for the latest version
 * @author	   	XtrmAddons.COM <contact[at]xtrmaddons.com>
 * @copyright	XtrmAddons.COM <contact[at]xtrmaddons.com> - distributed under the GNU
 * @package		Xtrm-Addons
 * @subpackage	mod_xtrmcookie_advertising
 * 
 * @access 		public
 * @since		3.1.01.00.150804 - 04 aug. 2015
 * @version 	3.1.01.00.150804 - 04 aug. 2015
 */
class mod_xtrmcookie_advertisingInstallerScript
{
    /**
     * Method to install the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.150804 - 04 aug. 2015
 	 * @version 3.1.01.00.150804 - 04 aug. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return 	void
     */
    public function install($parent)
    {	
    	echo '<p>'.JText::_('MOD_XTRMCOOKIE_ADVERTISING_INSTALL_SUCCESS').'</p>';
    }
 
    /**
     * Method to uninstall the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.150804 - 04 aug. 2015
 	 * @version 3.1.01.00.150804 - 04 aug. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return void
     */
    public function uninstall($parent) 
    {	
    	echo '<p>'.JText::_('MOD_XTRMCOOKIE_ADVERTISING_UNINSTALL_SUCCESS').'</p>';
    }
	
    /**
     * Method to update the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.150804 - 04 aug. 2015
 	 * @version 3.1.01.00.150804 - 04 aug. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return void
     */
    public function update($parent) 
    {   
    	$this->cleanUpdatesSites();
    	echo '<p>'.JText::sprintf('MOD_XTRMCOOKIE_ADVERTISING_UPDATE_SUCCESS', $parent->get('manifest')->version).'</p>';
    }
	
    /**
     * Method to run after an install/update/uninstall method.
     * 
     * @access	public
 	 * @since	3.1.01.00.150804 - 04 aug. 2015
 	 * @version 3.1.01.00.150804 - 04 aug. 2015
 	 * 
     * @param	string	$type	is the type of change (install, update or discover_install)
     * @param	object	$parent	is the class calling this method
     *
     * @return void
     */
    public function postflight($type, $parent) 
    {
    	echo '<p>'.JText::_('MOD_XTRMCOOKIE_ADVERTISING_THIRD_PARTY').'</p>';
    }
 
    /**
     * Method to clean updates site liste.
     * 
     * @access	public
 	 * @since	3.1.01.00.150804 - 04 aug. 2015
 	 * @version 3.1.01.00.150804 - 04 aug. 2015
 	 * 
     * @param	object	$parent	The class calling this method.
     *
     * @return void
     */
    public function cleanUpdatesSites()
    {		
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		 
		$query->select($db->q('update_site_id'))
		->from($db->qn('#__update_sites'))
		->where($db->qn('location').' LIKE '.$db->q('%03090-mod_xtrmcookie_advertising%'))
		->order('update_site_id DESC');
		 
		$id    = $db->setQuery($query)->loadResult();
		$query = $db->getQuery(true);
		 
		$query->delete($db->qn('#__update_sites'))
		->where($db->qn('location').' LIKE '.$db->q('%03090-mod_xtrmcookie_advertising%'))
		->where($db->qn('update_site_id').' != '.$db->q($id));
		 
		$db->setQuery($query)->execute();
    }
}
?>