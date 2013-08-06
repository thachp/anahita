<?php

/** 
 * LICENSE: ##LICENSE##
 * 
 * @category   Anahita
 * @package    Com_Config
 * @subpackage View
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */

/**
 * Config View
 *
 * @category   Anahita
 * @package    Com_Config
 * @subpackage View
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.anahitapolis.com
 */
class ComConfigViewConfigHtml extends ComBaseViewHtml
{
    public function display()
    {        
        $config  = $this->_state->config;
        $edits   = $this->getService('repos://admin/plugins', 
                    array('resources'=>'plugins'))
                    ->getQuery()
                    ->columns(array('element AS value','name AS text'))
                    ->folder('editors')->published(true)
                   ->fetchRows();
        ;
        $lists = array();
        // SITE SETTINGS
        $lists['offline'] = JHTML::_('select.booleanlist', 'offline', 'class="inputbox"', $config->offline);
        if (!$config->editor) {
            $config->editor = '';
        }
        // build the html select list
        $lists['editor'] 		= JHTML::_('select.genericlist',  $edits, 'editor', 'class="inputbox" size="1"', 'value', 'text', $config->editor);
        $listLimit 				= array (JHTML::_('select.option', 5, 5), JHTML::_('select.option', 10, 10), JHTML::_('select.option', 15, 15), JHTML::_('select.option', 20, 20), JHTML::_('select.option', 25, 25), JHTML::_('select.option', 30, 30), JHTML::_('select.option', 50, 50), JHTML::_('select.option', 100, 100),);
        $lists['list_limit'] 	= JHTML::_('select.genericlist',  $listLimit, 'list_limit', 'class="inputbox" size="1"', 'value', 'text', ($config->list_limit ? $config->list_limit : 50));

        /*
         jimport('joomla.language.help');
        $helpsites 				= array ();
        $helpsites 				= JHelp::createSiteList(JPATH_BASE.DS.'help'.DS.'helpsites-15.xml', $config->helpurl);
        array_unshift($helpsites, JHTML::_('select.option', '', JText::_('local')));
        $lists['helpsites'] 	= JHTML::_('select.genericlist',  $helpsites, 'helpurl', ' class="inputbox"', 'value', 'text', $config->helpurl);
        */

        // DEBUG
        $lists['debug'] 		= JHTML::_('select.booleanlist', 'debug', 'class="inputbox"', $config->debug);
        $lists['debug_lang'] 	= JHTML::_('select.booleanlist', 'debug_lang', 'class="inputbox"', $config->debug_lang);

        // DATABASE SETTINGS

        // SERVER SETTINGS        
        $errors 				= array (JHTML::_('select.option', -1, JText::_('System Default')), JHTML::_('select.option', 0, JText::_('None')), JHTML::_('select.option', E_ERROR | E_WARNING | E_PARSE, JText::_('Simple')), JHTML::_('select.option', E_ALL, JText::_('Maximum')));
        $lists['xmlrpc_server'] = JHTML::_('select.booleanlist', 'xmlrpc_server', 'class="inputbox"', $config->xmlrpc_server);
        $lists['error_reporting'] = JHTML::_('select.genericlist',  $errors, 'error_reporting', 'class="inputbox" size="1"', 'value', 'text', $config->error_reporting);
        $lists['enable_ftp'] 	= JHTML::_('select.booleanlist', 'ftp_enable', 'class="inputbox"', intval($config->ftp_enable));

        $forceSSL = array(
                JHTML::_('select.option', 0, JText::_('None')),
                JHTML::_('select.option', 1, JText::_('Administrator Only')),
                JHTML::_('select.option', 2, JText::_('Entire Site')),
        );
        $lists['force_ssl'] = JHTML::_('select.genericlist', $forceSSL, 'force_ssl', 'class="inputbox" size="1"', 'value', 'text', @$config->force_ssl);
        
        
        // MAIL SETTINGS
        $mailer = array (
                JHTML::_('select.option', 'mail', JText::_('PHP mail function')),
                JHTML::_('select.option', 'sendmail', JText::_('Sendmail')),
                JHTML::_('select.option', 'smtp', JText::_('SMTP Server')));
        $lists['mailer'] = JHTML::_('select.genericlist',  $mailer, 'mailer', 'class="inputbox" size="1"', 'value', 'text', $config->mailer);
        $smtpsecure = array (
                JHTML::_('select.option', 'none', JText::_('None')),
                JHTML::_('select.option', 'ssl', 'SSL'),
                JHTML::_('select.option', 'tls', 'TLS'));
        $lists['smtpsecure'] = JHTML::_('select.genericlist',  $smtpsecure, 'smtpsecure', 'class="inputbox" size="1"', 'value', 'text', (isset($config->smtpsecure) ? $config->smtpsecure : ''));
        $lists['smtpauth'] = JHTML::_('select.booleanlist', 'smtpauth', 'class="inputbox"', $config->smtpauth);
        
        // CACHE SETTINGS
        $lists['caching'] = JHTML::_('select.booleanlist', 'caching', 'class="inputbox"', $config->caching);
        jimport('joomla.cache.cache');
        $stores = JCache::getStores();
        $options = array();
        foreach($stores as $store) {
            $options[] = JHTML::_('select.option', $store, JText::_(ucfirst($store)) );
        }
        $lists['cache_handlers'] = JHTML::_('select.genericlist',  $options, 'cache_handler', 'class="inputbox" size="1"', 'value', 'text', $config->cache_handler);
        
        // MEMCACHE SETTINGS
        if (!empty($config->memcache_settings) && !is_array($config->memcache_settings)) {
            $config->memcache_settings = unserialize(stripslashes($config->memcache_settings));
        }
        $lists['memcache_persist'] = JHTML::_('select.booleanlist', 'memcache_settings[persistent]', 'class="inputbox"', @$config->memcache_settings['persistent']);
        $lists['memcache_compress'] = JHTML::_('select.booleanlist', 'memcache_settings[compression]', 'class="inputbox"', @$config->memcache_settings['compression']);        
        
        // SEO SETTINGS        
        $lists['sef_rewrite'] 	= JHTML::_('select.booleanlist', 'sef_rewrite', 'class="inputbox"', $config->sef_rewrite);        
                
        // SESSION SETTINGS
        $stores = JSession::getStores();
        $options = array();
        foreach($stores as $store) {
            $options[] = JHTML::_('select.option', $store, JText::_(ucfirst($store)) );
        }
        $lists['session_handlers'] = JHTML::_('select.genericlist',  $options, 'session_handler', 'class="inputbox" size="1"', 'value', 'text', $config->session_handler);
        $this->lists = $lists;
        return parent::display();
    }
}
?>