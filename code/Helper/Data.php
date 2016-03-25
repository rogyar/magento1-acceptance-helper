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
}
