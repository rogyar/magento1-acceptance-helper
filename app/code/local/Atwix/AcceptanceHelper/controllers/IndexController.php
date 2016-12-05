<?php

/* TODO: implement token that will be used on each request and validated by comparison with a predefined config value */

class Atwix_AcceptanceHelper_IndexController extends Mage_Core_Controller_Front_Action
{
    const SUCCESS_MESSAGE = '<h4 style="color: green">All operations were completed successfully</h4>';
    const FAIL_MESSAGE = '<h4 style="color: red">There was error processing your request: %s</h4>';

    /** @var  Atwix_AcceptanceHelper_Helper_Data */
    protected $generalHelper;

    /** @var  Atwix_AcceptanceHelper_Helper_Product */
    protected $productHelper;


    public function _construct()
    {
        $this->generalHelper = Mage::helper('atwix_acceptancehelper');
        $this->productHelper = Mage::helper('atwix_acceptancehelper/product');
        parent::_construct();
    }

    /**
     * Initialises cache cleaning
     */
    public function clearcacheAction()
    {
        $this->generalHelper->clearCache();
        $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
    }

    /**
     * Initialises user removing by provided email
     */
    public function removecustomerAction()
    {
        $customerEmail = $this->getRequest()->getParam('email');
        if (empty($customerEmail)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'No customer email specified'));
            return $this;
        }

        if (!$this->generalHelper->removeCustomer($customerEmail)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'Customer with provided email cannot be found'));
            return $this;
        }

        $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
        return $this;
    }

    /**
     * Initialises new test product creation
     */
    public function createproductAction()
    {
        if (($opStatus = $this->productHelper->createProduct()) === true) {
            $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
        }
        if ($opStatus < 0) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'The product already exists'));
        }
    }

    /**
     * Initialises test product removing
     */
    public function removeproductAction()
    {
        $this->productHelper->removeProduct();
        $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
    }
    
    /**
     * Initialises subscriber removing by provided email
     */
    public function removesubscribtionAction()
    {
        $subscriberEmail = $this->getRequest()->getParam('email');
        if (empty($subscriberEmail)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'No customer email specified'));
            return $this;
        }

        if (!$this->generalHelper->removeSubscriber($subscriberEmail)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'Customer with provided email cannot be found'));
            return $this;
        }

        $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
        return $this;
    }

    /**
     * Initialises order removing by provided number
     */
    public function removeorderAction()
    {
        $orderNumber = $this->getRequest()->getParam('order');
        if (empty($orderNumber)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'No order number specified'));
            return $this;
        }

        if (!$this->generalHelper->removeOrderByNumber($orderNumber)) {
            $this->getResponse()->setBody(sprintf(self::FAIL_MESSAGE, 'Order with  ' .$orderNumber. ' number cannot be found'));
            return $this;
        }

        $this->getResponse()->setBody(self::SUCCESS_MESSAGE);
        return $this;
    }
}
