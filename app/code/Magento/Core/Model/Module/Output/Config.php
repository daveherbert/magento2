<?php
/**
 * Module Output Config Model
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Core\Model\Module\Output;


class Config implements \Magento\Module\Output\ConfigInterface
{
    /**
     * XPath in the configuration where module statuses are stored
     */
    const XML_PATH_MODULE_OUTPUT_STATUS = 'advanced/modules_disable_output/%s';

    /**
     * @var \Magento\Core\Model\Store\ConfigInterface
     */
    protected $_storeConfig;

    /**
     * @param \Magento\Core\Model\Store\ConfigInterface $storeConfig
     */
    public function __construct(\Magento\Core\Model\Store\ConfigInterface $storeConfig)
    {
        $this->_storeConfig =  $storeConfig;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled($moduleName)
    {
        return $this->getFlag(sprintf(self::XML_PATH_MODULE_OUTPUT_STATUS, $moduleName));
    }

    /**
     * @inheritdoc
     */
    public function getFlag($path)
    {
        return $this->_storeConfig->getConfigFlag($path);
    }
}
