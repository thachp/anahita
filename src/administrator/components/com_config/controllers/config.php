<?php

/** 
 * LICENSE: ##LICENSE##
 * 
 * @category   Anahita
 * @package    Com_Config
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id$
 * @link       http://www.anahitapolis.com
 */

/**
 * Config Controller
 * 
 * @category   Anahita
 * @package    Com_Config
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.anahitapolis.com
 */
class ComConfigControllerConfig extends ComBaseControllerResource
{	
    /**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     *
     * @return void
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
    
        $this->registerActionAlias('apply', 'post');
        $this->registerActionAlias('save',  'post');
    }
        
    /**
     * Returns a config
     * 
     * @param KCommandContext $context
     */
    protected function _actionRead(KCommandContext $context)
    {
        $this->config = new ComConfigModelConfig(JPATH_ROOT);
    }
    
    /**
     * Save the config file
     * 
     * @param KCommandContext $context
     */
    protected function _actionPost(KCommandContext $context)
    {
        $data   = KConfig::unbox($context->data);
        $keys   = 
        'offline sitename editor sef_rewrite log_path debug
        debug_lang caching cachetime cache_handler lifetime session_handler
        error_reporting force_ssl dbtype host user db dbprefix mailer mailfrom fromname sendmail
        smtpsecure smtpport smtpuser smtppass smtphost';
        $keys   = array_map('trim', explode(' ', $keys));        
        $keys   = array_combine($keys, $keys);
        //only get data with keys
        $data   = array_intersect_key($data, $keys);
        $config = new ComConfigModelConfig(JPATH_ROOT);
        $this->_config = $config;        
        $config->set($data);
        $context->response->setRedirect($context->request->getReferrer());
    }
    
    /**
     * Save the config in destruct
     * 
     * @return void
     */
    public function __destruct()
    {
        if ( $this->_config ) {
            $this->_config->save();   
        }
    }
}