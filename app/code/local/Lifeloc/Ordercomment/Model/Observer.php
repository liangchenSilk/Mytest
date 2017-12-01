<?php
class Lifeloc_Ordercomment_Model_Observer{
	public function orderComment($observer) {
		$order = $observer->getEvent()->getOrder();
		$order->addStatusHistoryComment("my test");
		$order->save();
	}
}
