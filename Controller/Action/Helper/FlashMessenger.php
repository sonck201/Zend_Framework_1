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
 */

/**
 * @see Zend_Session
 */
require_once 'Zend/Session.php';

/**
 * @see Zend_Controller_Action_Helper_Abstract
 */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Flash Messenger - implement session-based messages.
 *
 * @uses       Zend_Controller_Action_Helper_Abstract
 *
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 *
 * @version    $Id$
 */
class Zend_Controller_Action_Helper_FlashMessenger extends Zend_Controller_Action_Helper_Abstract implements IteratorAggregate, Countable
{
    /**
     * $_messages - Messages from previous request.
     *
     * @var array
     */
    protected static $_messages = [];

    /**
     * $_session - Zend_Session storage object.
     *
     * @var Zend_Session
     */
    protected static $_session = null;

    /**
     * $_messageAdded - Wether a message has been previously added.
     *
     * @var bool
     */
    protected static $_messageAdded = false;

    /**
     * $_namespace - Instance namespace, default is 'default'.
     *
     * @var string
     */
    protected $_namespace = 'default';

    /**
     * __construct() - Instance constructor, needed to get iterators, etc.
     *
     * @param string $namespace
     *
     * @return void
     */
    public function __construct()
    {
        if (!self::$_session instanceof Zend_Session_Namespace) {
            self::$_session = new Zend_Session_Namespace($this->getName());
            foreach (self::$_session as $namespace => $messages) {
                self::$_messages[$namespace] = $messages;
                unset(self::$_session->{$namespace});
            }
        }
    }

    /**
     * postDispatch() - runs after action is dispatched, in this
     * case, it is resetting the namespace in case we have forwarded to a different
     * action, Flashmessage will be 'clean' (default namespace).
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger Provides a fluent interface
     */
    public function postDispatch()
    {
        $this->resetNamespace();

        return $this;
    }

    /**
     * setNamespace() - change the namespace messages are added to, useful for
     * per action controller messaging between requests.
     *
     * @param string $namespace
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger Provides a fluent interface
     */
    public function setNamespace($namespace = 'default')
    {
        $this->_namespace = $namespace;

        return $this;
    }

    /**
     * getNamespace() - return the current namepsace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     * resetNamespace() - reset the namespace to the default.
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger Provides a fluent interface
     */
    public function resetNamespace()
    {
        $this->setNamespace();

        return $this;
    }

    /**
     * addMessage() - Add a message to flash message.
     *
     * @param string $message
     * @param mixed|null $namespace
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger Provides a fluent interface
     */
    public function addMessage($message, $namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if (self::$_messageAdded === false) {
            self::$_session->setExpirationHops(1, null, true);
        }

        if (!is_array(self::$_session->{$namespace})) {
            self::$_session->{$namespace} = [];
        }

        self::$_session->{$namespace}[] = $message;
        self::$_messageAdded = true;

        return $this;
    }

    /**
     * hasMessages() - Wether a specific namespace has messages.
     *
     * @return bool
     *
     * @param mixed|null $namespace
     */
    public function hasMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        return isset(self::$_messages[$namespace]);
    }

    /**
     * getMessages() - Get messages from a specific namespace.
     *
     * @return array
     *
     * @param mixed|null $namespace
     */
    public function getMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasMessages($namespace)) {
            return self::$_messages[$namespace];
        }

        return [];
    }

    /**
     * Clear all messages from the previous request & current namespace.
     *
     * @return bool True if messages were cleared, false if none existed
     *
     * @param mixed|null $namespace
     */
    public function clearMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasMessages($namespace)) {
            unset(self::$_messages[$namespace]);

            return true;
        }

        return false;
    }

    /**
     * hasCurrentMessages() - check to see if messages have been added to current
     * namespace within this request.
     *
     * @return bool
     *
     * @param mixed|null $namespace
     */
    public function hasCurrentMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        return isset(self::$_session->{$namespace});
    }

    /**
     * getCurrentMessages() - get messages that have been added to the current
     * namespace within this request.
     *
     * @return array
     *
     * @param mixed|null $namespace
     */
    public function getCurrentMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasCurrentMessages($namespace)) {
            return self::$_session->{$namespace};
        }

        return [];
    }

    /**
     * clear messages from the current request & current namespace.
     *
     * @return bool
     *
     * @param mixed|null $namespace
     */
    public function clearCurrentMessages($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasCurrentMessages($namespace)) {
            unset(self::$_session->{$namespace});

            return true;
        }

        return false;
    }

    /**
     * getIterator() - complete the IteratorAggregate interface, for iterating.
     *
     * @return ArrayObject
     *
     * @param mixed|null $namespace
     */
    public function getIterator($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasMessages($namespace)) {
            return new ArrayObject($this->getMessages($namespace));
        }

        return new ArrayObject();
    }

    /**
     * count() - Complete the countable interface.
     *
     * @return int
     *
     * @param mixed|null $namespace
     */
    public function count($namespace = null)
    {
        if (!is_string($namespace) || $namespace == '') {
            $namespace = $this->getNamespace();
        }

        if ($this->hasMessages($namespace)) {
            return count($this->getMessages($namespace));
        }

        return 0;
    }

    /**
     * Strategy pattern: proxy to addMessage().
     *
     * @param string $message
     * @param mixed|null $namespace
     *
     * @return void
     */
    public function direct($message, $namespace = null)
    {
        return $this->addMessage($message, $namespace);
    }
}
