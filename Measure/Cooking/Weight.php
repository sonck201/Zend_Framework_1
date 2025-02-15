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
 * @category  Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 *
 * @version   $Id$
 */

/**
 * Implement needed classes.
 */
require_once 'Zend/Measure/Abstract.php';
require_once 'Zend/Locale.php';

/**
 * Class for handling cooking weight conversions.
 *
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Measure_Cooking_Weight extends Zend_Measure_Abstract
{
    const STANDARD = 'GRAM';

    const HALF_STICK = 'HALF_STICK';
    const STICK = 'STICK';
    const CUP = 'CUP';
    const GRAM = 'GRAM';
    const OUNCE = 'OUNCE';
    const POUND = 'POUND';
    const TEASPOON = 'TEASPOON';
    const TEASPOON_US = 'TEASPOON_US';
    const TABLESPOON = 'TABLESPOON';
    const TABLESPOON_US = 'TABLESPOON_US';

    /**
     * Calculations for all cooking weight units.
     *
     * @var array
     */
    protected $_units = [
        'HALF_STICK' => [['' => '453.59237', '/' => '8'],                    'half stk'],
        'STICK' => [['' => '453.59237', '/' => '4'],                    'stk'],
        'CUP' => [['' => '453.59237', '/' => '2'],                    'c'],
        'GRAM' => ['1',                                                   'g'],
        'OUNCE' => [['' => '453.59237', '/' => '16'],                   'oz'],
        'POUND' => ['453.59237',                                           'lb'],
        'TEASPOON' => [['' => '1.2503332', '' => '453.59237', '/' => '128'], 'tsp'],
        'TEASPOON_US' => [['' => '453.59237', '/' => '96'],                   'tsp'],
        'TABLESPOON' => [['' => '1.2503332', '' => '453.59237', '/' => '32'],  'tbsp'],
        'TABLESPOON_US' => [['' => '453.59237', '/' => '32'],                   'tbsp'],
        'STANDARD' => 'GRAM',
    ];
}
