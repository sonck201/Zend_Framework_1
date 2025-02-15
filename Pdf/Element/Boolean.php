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

/** Zend_Pdf_Element */
require_once 'Zend/Pdf/Element.php';

/**
 * PDF file 'boolean' element implementation.
 *
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Pdf_Element_Boolean extends Zend_Pdf_Element
{
    /**
     * Object value.
     *
     * @var bool
     */
    public $value;

    /**
     * Object constructor.
     *
     * @param bool $val
     *
     * @throws Zend_Pdf_Exception
     */
    public function __construct($val)
    {
        if (!is_bool($val)) {
            require_once 'Zend/Pdf/Exception.php';
            throw new Zend_Pdf_Exception('Argument must be boolean.');
        }

        $this->value = $val;
    }

    /**
     * Return type of the element.
     *
     * @return int
     */
    public function getType()
    {
        return Zend_Pdf_Element::TYPE_BOOL;
    }

    /**
     * Return object as string.
     *
     * @param Zend_Pdf_Factory $factory
     *
     * @return string
     */
    public function toString($factory = null)
    {
        return $this->value ? 'true' : 'false';
    }
}
