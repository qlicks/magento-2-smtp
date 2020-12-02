<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Smtp
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Smtp\Controller\Adminhtml\Smtp\Sync;

use Magento\Backend\App\Action\Context;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Mageplaza\Smtp\Helper\EmailMarketing;

/**
 * Class EstimateCustomer
 * @package Mageplaza\Smtp\Controller\Adminhtml\Smtp\Sync
 */
class EstimateCustomer extends AbstractEstimate
{
    /**
     * @var CustomerCollectionFactory
     */
    protected $customerCollectionFactory;

    /**
     * EstimateCustomer constructor.
     *
     * @param Context $context
     * @param CustomerCollectionFactory $customerCollectionFactory
     * @param EmailMarketing $emailMarketing
     */
    public function __construct(
        Context $context,
        CustomerCollectionFactory $customerCollectionFactory,
        EmailMarketing $emailMarketing
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;

        parent::__construct($context, $emailMarketing);
    }

    /**
     * @return \Magento\Customer\Model\ResourceModel\Customer\Collection|\Magento\Framework\Data\Collection\AbstractDb|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function prepareCollection()
    {
        return $this->customerCollectionFactory->create()
            ->addFieldToFilter('mp_smtp_is_synced', ['null' => 1]);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getZeroMessage()
    {
        return __('No customers to synchronize.');
    }
}
