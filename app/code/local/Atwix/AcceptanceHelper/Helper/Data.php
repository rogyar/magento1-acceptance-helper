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
}
