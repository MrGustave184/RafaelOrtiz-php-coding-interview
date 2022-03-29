<?php

namespace Src\helpers;
use Src\models\DogModel;

class DiscountHelper {
    private function validateDiscount($dogs) {
        $ages = [];

        foreach($dogs as $dog) {
            $ages[] = $dog['age'];
        }

        if (count($ages) > 0) {
            $avg = array_sum($ages) / count($ages);
        }

        return $avg < 10; 
    }

    public function applyDiscount($booking) {
        $dogModel = new DogModel();
        $dogs = $dogModel->getDogsByClientId($booking['clientid']);

        if($this->validateDiscount($dogs)) {
            $booking['price'] = $booking['price'] - ($booking['price'] * 0.10);
        }

        return $booking;
    }
}