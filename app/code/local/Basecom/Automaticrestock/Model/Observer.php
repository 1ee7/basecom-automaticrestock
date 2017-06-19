<?php

class Basecom_Automaticrestock_Model_Observer {

    public function restockOnManualQuantityChange($observer) {
        $product = $observer->getProduct();
        $stockData = $product->getStockData();

        if ( $product && $stockData['qty'] && intval($stockData['qty']) > 0 ) {
            $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getEntityId());
            $stock->setData('is_in_stock', 1);
            $stock->save();
        }
    }
}