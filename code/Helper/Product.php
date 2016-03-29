<?php

class Atwix_AcceptanceHelper_Helper_Product extends Mage_Core_Helper_Abstract
{
    protected $productDetails = array(
        'sku' => 'atwix-test-product-codecept',
        'website_ids' => array(1),
        'attribute_set_id' => 4,
        'weight' => 1.00,
        'url_key' => 'atwix-test-product-codecept',
        'name' => 'atwix-test-product-codecept',
        'status' => 1,
        'visibility' => Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
        'price' => '10.00',
        'tax_class_id' => 4,
        'description' => 'Created via shell script for the codeception tests. 
            Product for the testing web store functionality',
        'short_description' => 'Only for the testing purposes',
        'stock_data' => array(
            'use_config_manage_stock' => 0,
            'manage_stock' => 1,
            'min_sale_qty' => 1,
            'max_sale_qty' => 2,
            'is_in_stock' => 1,
            'qty' => '999'
        )
    );

    /**
     * Creates a new product with the data from $productDetails
     *
     * @return bool|int
     * @throws Exception
     */
    public function createProduct()
    {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product');

        if ($product->getIdBySku($this->productDetails['sku'])) {
            return -1;
        }

        $product->addData($this->productDetails);
        $product->save();

        return true;
    }
    
    public function removeProduct()
    {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $this->productDetails['sku']);

        if ($product) {
            $product->delete();
        }
    }
}
