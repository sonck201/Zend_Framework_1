<?php
/**
 * Zend Framework.
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 *
 * @version    $Id$
 */
if (extension_loaded('soap')) {
    /**
     * @category   Zend
     */
    class Zend_Soap_Client_Common extends SoapClient
    {
        /**
         * doRequest() pre-processing method.
         *
         * @var callback
         */
        protected $_doRequestCallback;

        /**
         * Common Soap Client constructor.
         *
         * @param callback $doRequestMethod
         * @param string $wsdl
         * @param array $options
         * @param mixed $doRequestCallback
         */
        public function __construct($doRequestCallback, $wsdl, $options)
        {
            $this->_doRequestCallback = $doRequestCallback;

            parent::__construct($wsdl, $options);
        }

        /**
         * Performs SOAP request over HTTP.
         * Overridden to implement different transport layers, perform additional XML processing or other purpose.
         *
         * @param string $request
         * @param string $location
         * @param string $action
         * @param int $version
         * @param int $one_way
         *
         * @return mixed
         */
        public function __doRequest($request, $location, $action, $version, $one_way = null)
        {
            if ($one_way === null) {
                return call_user_func($this->_doRequestCallback, $this, $request, $location, $action, $version);
            } else {
                return call_user_func($this->_doRequestCallback, $this, $request, $location, $action, $version, $one_way);
            }
        }
    }
} // end if (extension_loaded('soap')
