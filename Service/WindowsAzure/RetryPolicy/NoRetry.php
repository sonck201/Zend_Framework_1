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
 * @version    $Id$
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @see Zend_Service_WindowsAzure_RetryPolicy_RetryPolicyAbstract
 */
require_once 'Zend/Service/WindowsAzure/RetryPolicy/RetryPolicyAbstract.php';

/**
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_WindowsAzure_RetryPolicy_NoRetry extends Zend_Service_WindowsAzure_RetryPolicy_RetryPolicyAbstract
{
    /**
     * Execute function under retry policy.
     *
     * @param string|array $function Function to execute
     * @param array $parameters Parameters for function call
     *
     * @return mixed
     */
    public function execute($function, $parameters = [])
    {
        $returnValue = null;

        try {
            $returnValue = call_user_func_array($function, $parameters);

            return $returnValue;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
