<?php

namespace Src\models;
use Src\helpers\Helpers;

class BookingModel {

	private $bookingData;
    private $helper;

	function __construct() {
		$string = file_get_contents(dirname(__DIR__) . '/../scripts/bookings.json');
		$this->bookingData = json_decode($string, true);
        $this->helper = new Helpers();
	}

	public function getBookings() {
		return $this->bookingData;
	}

	public function bookClient($client) {
		$bookings = $this->getBookings();

		$client['id'] = end($bookings)['id'] + 1;
		$bookings[] = $client;

		$this->helper->putJson($bookings, 'bookings');

		return $client;
	}
}