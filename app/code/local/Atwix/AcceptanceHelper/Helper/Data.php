<?php

class Atwix_AcceptanceHelper_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Cleans entire store cache
     */
    public function clearCache()
    {
        Mage::app()->cleanCache(); // Clean Magento caches
        Mage::app()->getCacheInstance()->flush(); // Clean cache storage
    }

    /**
     * Attempts to find customer by email. If customer has been found - removes it
     * 
     * @param string $customerEmail
     * @return bool
     * @throws Exception
     */
    public function removeCustomer($customerEmail)
    {
        $customer = Mage::getModel('customer/customer');
        $customer->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $customer->loadByEmail($customerEmail);
        if ($customer->getId()) {
            Mage::register('isSecureArea', true);
            $customer->delete();
            return true;
            
        } else {
            return false;
        }
    }

    /**
     * Attempts to find subscriber by email. If subscriber has been found - removes it
     *
     * @param string $subscriberEmail
     * @return bool
     * @throws Exception
     */
    public function removeSubscriber($subscriberEmail)
    {
        $subscriber = Mage::getModel('newsletter/subscriber');
        $subscriber->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $subscriber->loadByEmail($subscriberEmail);
        if ($subscriber->getId()) {
            Mage::register('isSecureArea', true);
            $subscriber->delete();
            return true;

        } else {
            return false;
        }
    }

    /**
     * Attempts to find order by number. If order has been found - removes it
     *
     * @param $orderNumber
     * @return bool
     */
    public function removeOrderByNumber($orderNumber)
    {

        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($orderNumber);
        if($order->getID())
        {
            Mage::register('isSecureArea', true);
            $order->delete();
            return true;

        } else {
            return false;
        }
    }

}
