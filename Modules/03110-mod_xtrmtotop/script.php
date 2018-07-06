<?php
/**
 * @version		script.php
 * @package		Xtrm-Addons
 * @subpackage	mod_xtrmtotop
 * @copyright	Copyright (C) 2015+ XtrmAddons.COM. All rights reserved.
 * @license		License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL, see LICENSE.php
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
 * @subpackage	mod_xtrmtotop
 * 
 * @access 		public
 * @since		3.1.01.00.151014 - 14 oct. 2015
 * @version 	3.1.01.00.151014 - 14 oct. 2015
 */
class mod_xtrmtotopInstallerScript
{
    /**
     * Method to install the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.151014 - 14 oct. 2015
 	 * @version 3.1.01.00.151014 - 14 oct. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return 	void
     */
    public function install($parent)
    {	
    	echo '<p>'.JText::_('MOD_XTRMTOTOP_INSTALL_SUCCESS').'</p>';
    }
 
    /**
     * Method to uninstall the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.151014 - 14 oct. 2015
 	 * @version 3.1.01.00.151014 - 14 oct. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return void
     */
    public function uninstall($parent) 
    {	
    	echo '<p>'.JText::_('MOD_XTRMTOTOP_UNINSTALL_SUCCESS').'</p>';
    }
	
    /**
     * Method to update the component.
     * 
     * @access	public
 	 * @since	3.1.01.00.151014 - 14 oct. 2015
 	 * @version 3.1.01.00.151014 - 14 oct. 2015
 	 * 
     * @param	object	$parent	is the class calling this method.
     *
     * @return void
     */
    public function update($parent) 
    {   
    	$this->cleanUpdatesSites();
    	echo '<p>'.JText::sprintf('MOD_XTRMTOTOP_UPDATE_SUCCESS', $parent->get('manifest')->version).'</p>';
    }
	
    /**
     * Method to run after an install/update/uninstall method.
     * 
     * @access	public
 	 * @since	3.1.01.00.151014 - 14 oct. 2015
 	 * @version 3.1.01.00.151014 - 14 oct. 2015
 	 * 
     * @param	string	$type	is the type of change (install, update or discover_install)
     * @param	object	$parent	is the class calling this method
     *
     * @return void
     */
    public function postflight($type, $parent) 
    {
        
    }
 
    /**
     * Method to clean updates site liste.
     * 
     * @access	public
 	 * @since	3.1.01.00.151014 - 14 oct. 2015
 	 * @version 3.1.01.00.151014 - 14 oct. 2015
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
		->where($db->qn('location').' LIKE '.$db->q('%03110-mod_xtrmtotop%'))
		->order('update_site_id DESC');
		 
		$id    = $db->setQuery($query)->loadResult();
		$query = $db->getQuery(true);
		 
		$query->delete($db->qn('#__update_sites'))
		->where($db->qn('location').' LIKE '.$db->q('%03110-mod_xtrmtotop%'))
		->where($db->qn('update_site_id').' != '.$db->q($id));
		 
		$db->setQuery($query)->execute();
    }
}
?>