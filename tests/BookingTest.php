<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\controllers\Booking;
use Src\helpers\DiscountHelper;

class BookingTest extends TestCase {

	private $booking;

	/**
	 * Setting default data
	 * @throws \Exception
	 */
	public function setUp(): void {
		parent::setUp();
		$this->booking = new Booking();
	}

	/** @test */
	public function getBookings() {
		$results = $this->booking->getBookings();

		$this->assertIsArray($results);
		$this->assertIsNotObject($results);

		$this->assertEquals($results[0]['id'], 1);
		$this->assertEquals($results[0]['clientid'], 1);
		$this->assertEquals($results[0]['price'], 200);
		$this->assertEquals($results[0]['checkindate'], '2021-08-04 15:00:00');
		$this->assertEquals($results[0]['checkoutdate'], '2021-08-11 15:00:00');
	}

	/** @test */
    public function canBookClients() {
        $bookings = $this->booking->getBookings();

        $newBooking = [
            "clientid" => 5,
            "price" => 300,
            "checkindate" => "2021-08-04 15:00:00",
            "checkoutdate" => "2021-08-11 15:00:00"
        ];

        $newBooking['id'] = end($bookings)['id'] + 1;

		$this->booking->bookClient($newBooking);
        $bookings = $this->booking->getBookings();

		$this->assertIsArray($bookings);
		$this->assertIsNotObject($bookings);
    }

	/** @test */
    public function clientCanReceiveDiscountIfApplicable() {
        // given client with 1 or more dogs
        $newBooking = [
            "clientid" => 1,
            "price" => 300,
            "checkindate" => "2021-08-04 15:00:00",
            "checkoutdate" => "2021-08-11 15:00:00"
        ];

        $discountHelper = new DiscountHelper();
        $result = $discountHelper->applyDiscount($newBooking);

        
        // var_dump($result);
        // die;
        // when applicable for discount
        // then price should match with 10% less
    }
}