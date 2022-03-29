<?php

namespace Src\controllers;

use Src\helpers\Helpers;
use Src\models\ClientModel;

class Client {

	private function getClientModel(): ClientModel {
		return new ClientModel();
	}

	public function getClients() {
		return $this->getClientModel()->getClients();
	}

	public function createClient($client) {
        if (!filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException();
        }

		return $this->getClientModel()->createClient($client);
	}

	public function updateClient($client) {
		return $this->getClientModel()->updateClient($client);
	}

	public function getClientById($id) {
		return $this->getClientModel()->getClientById($id);
	}
}