<?php

/* TODO: implement token that will be used on each request and validated by comparison with a predefined config value */

class Atwix_AcceptanceHelper_IndexController extends Mage_Core_Controller_Front_Action
{
    const SUCCESS_MESSAGE = '<h4 style="color: green">All operations were completed successfully</h4>';
    const FAIL_MESSAGE = '<h4 style="color: red">There was error processing your request: %s</h4>';

    /** @var  Atwix_AcceptanceHelper_Helper_Data */
    protected $generalHelper;


    public function _construct()
    {
        $this->generalHelper = Mage::helper('atwix_acceptancehelper');
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
}
