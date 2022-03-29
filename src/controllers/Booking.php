<?php

namespace Src\controllers;

use Src\models\BookingModel;
use Src\helpers\DiscountHelper;

class Booking {

	private function getBookingModel(): BookingModel {
		return new BookingModel();
	}

	public function getBookings() {
		return $this->getBookingModel()->getBookings();
	}

    public function bookClient($client) {

        $discountHelper = new DiscountHelper();
        $client = $discountHelper->applyDiscount($client);

        return $this->getBookingModel()->bookClient($client);
    }
}