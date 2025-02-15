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
 * @see Zend_Tool_Project_Context_Filesystem_File
 */
require_once 'Zend/Tool/Project/Context/Filesystem/File.php';

/**
 * This class is the front most class for utilizing Zend_Tool_Project.
 *
 * A profile is a hierarchical set of resources that keep track of
 * items within a specific project.
 *
 * @category   Zend
 *
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Tool_Project_Context_Zf_LayoutScriptFile extends Zend_Tool_Project_Context_Filesystem_File
{
    /**
     * @var string
     */
    protected $_filesystemName = 'layout.phtml';

    /**
     * @var string
     */
    protected $_layoutName = null;

    /**
     * getName().
     *
     * @return string
     */
    public function getName()
    {
        return 'LayoutScriptFile';
    }

    /**
     * init().
     *
     * @return Zend_Tool_Project_Context_Zf_ViewScriptFile
     */
    public function init()
    {
        if ($layoutName = $this->_resource->getAttribute('layoutName')) {
            $this->_layoutName = $layoutName;
        } else {
            throw new Exception('Either a forActionName or scriptName is required.');
        }

        parent::init();

        return $this;
    }

    /**
     * getPersistentAttributes().
     *
     * @return unknown
     */
    public function getPersistentAttributes()
    {
        $attributes = [];

        if ($this->_layoutName) {
            $attributes['layoutName'] = $this->_layoutName;
        }

        return $attributes;
    }

    /**
     * getContents().
     *
     * @return string
     */
    public function getContents()
    {
        $contents = <<<EOS
<?php echo \$this->layout()->content; ?>
EOS;

        return $contents;
    }
}
