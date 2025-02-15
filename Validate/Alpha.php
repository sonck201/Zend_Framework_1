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
 * @see Zend_Validate_Abstract
 */
require_once 'Zend/Validate/Abstract.php';

/**
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Alpha extends Zend_Validate_Abstract
{
    const INVALID = 'alphaInvalid';
    const NOT_ALPHA = 'notAlpha';
    const STRING_EMPTY = 'alphaStringEmpty';

    /**
     * Whether to allow white space characters; off by default.
     *
     * @var bool
     *
     * @deprecated
     */
    public $allowWhiteSpace;

    /**
     * Alphabetic filter used for validation.
     *
     * @var Zend_Filter_Alpha
     */
    protected static $_filter = null;

    /**
     * Validation failure message template definitions.
     *
     * @var array
     */
    protected $_messageTemplates = [
        self::INVALID => 'Invalid type given. String expected',
        self::NOT_ALPHA => "'%value%' contains non alphabetic characters",
        self::STRING_EMPTY => "'%value%' is an empty string",
    ];

    /**
     * Sets default option values for this instance.
     *
     * @param bool|Zend_Config $allowWhiteSpace
     */
    public function __construct($allowWhiteSpace = false)
    {
        if ($allowWhiteSpace instanceof Zend_Config) {
            $allowWhiteSpace = $allowWhiteSpace->toArray();
        }

        if (is_array($allowWhiteSpace)) {
            if (array_key_exists('allowWhiteSpace', $allowWhiteSpace)) {
                $allowWhiteSpace = $allowWhiteSpace['allowWhiteSpace'];
            } else {
                $allowWhiteSpace = false;
            }
        }

        $this->allowWhiteSpace = (bool) $allowWhiteSpace;
    }

    /**
     * Returns the allowWhiteSpace option.
     *
     * @return bool
     */
    public function getAllowWhiteSpace()
    {
        return $this->allowWhiteSpace;
    }

    /**
     * Sets the allowWhiteSpace option.
     *
     * @param bool $allowWhiteSpace
     *
     * @return Zend_Filter_Alpha Provides a fluent interface
     */
    public function setAllowWhiteSpace($allowWhiteSpace)
    {
        $this->allowWhiteSpace = (bool) $allowWhiteSpace;

        return $this;
    }

    /**
     * Defined by Zend_Validate_Interface.
     *
     * Returns true if and only if $value contains only alphabetic characters
     *
     * @param string $value
     *
     * @return bool
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            $this->_error(self::INVALID);

            return false;
        }

        $this->_setValue($value);

        if ('' === $value) {
            $this->_error(self::STRING_EMPTY);

            return false;
        }

        if (null === self::$_filter) {
            /**
             * @see Zend_Filter_Alpha
             */
            require_once 'Zend/Filter/Alpha.php';
            self::$_filter = new Zend_Filter_Alpha();
        }

        self::$_filter->allowWhiteSpace = $this->allowWhiteSpace;

        if ($value !== self::$_filter->filter($value)) {
            $this->_error(self::NOT_ALPHA);

            return false;
        }

        return true;
    }
}
