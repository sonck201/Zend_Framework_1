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

/**
 * @see Zend_Gdata_Extension
 */
require_once 'Zend/Gdata/Extension.php';

/**
 * @category   Zend
 */
class Zend_Gdata_Analytics_Extension_TableId extends Zend_Gdata_Extension
{
    protected $_rootNamespace = 'ga';
    protected $_rootElement = 'tableId';
    protected $_value = null;

    /**
     * Constructs a new Zend_Gdata_Calendar_Extension_Timezone object.
     *
     * @param string $value (optional) The text content of the element.
     */
    public function __construct($value = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Analytics::$namespaces);
        parent::__construct();
        $this->_value = $value;
    }

    /**
     * Retrieves a DOMElement which corresponds to this element and all
     * child properties.  This is used to build an entry back into a DOM
     * and eventually XML text for sending to the server upon updates, or
     * for application storage/persistence.
     *
     * @param DOMDocument $doc The DOMDocument used to construct DOMElements
     * @param mixed $majorVersion
     * @param mixed|null $minorVersion
     *
     * @return DOMElement The DOMElement representing this element and all
     *                    child properties.
     */
    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_value != null) {
            $element->setAttribute('value', $this->_value);
        }

        return $element;
    }

    /**
     * Given a DOMNode representing an attribute, tries to map the data into
     * instance members.  If no mapping is defined, the name and value are
     * stored in an array.
     *
     * @param DOMNode $attribute The DOMNode attribute needed to be handled
     * @param mixed $child
     */
    protected function takeChildFromDOM($child)
    {
        $this->_value = $child->nodeValue;
    }

    /**
     * Get the value for this element's value attribute.
     *
     * @return string The value associated with this attribute.
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Set the value for this element's value attribute.
     *
     * @param string $value The desired value for this attribute.
     *
     * @return Zend_Gdata_Calendar_Extension_Timezone The element being modified.
     */
    public function setValue($value)
    {
        $this->_value = $value;

        return $this;
    }

    /**
     * Magic toString method allows using this directly via echo
     * Works best in PHP >= 4.2.0.
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
