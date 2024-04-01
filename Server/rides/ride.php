<?php
class Ride {
    private $users;
    private $joinedUsers;
    private $maxPlaces;
    private $currentPlaces;
    private $departureDate;
    private $departureTime;
    private $price;

    public function __construct($maxPlaces, $departureDate, $departureTime, $price) {
        $this->users = [];
        $this->joinedUsers = [];
        $this->maxPlaces = $maxPlaces;
        $this->currentPlaces = 0;
        $this->departureDate = $departureDate;
        $this->departureTime = $departureTime;
        $this->price = $price;
    }

    // Add a user to the ride
    public function addUser($user) {
        $this->users[] = $user;
    }

    // Get the number of available places in the ride
    public function getAvailablePlaces() {
        return $this->maxPlaces - $this->currentPlaces;
    }

    // Join a user to the ride
    public function joinRide($user) {
        if ($this->currentPlaces < $this->maxPlaces) {
            $this->joinedUsers[] = $user;
            $this->currentPlaces++;
            return true;
        }
        return false;
    }

    // Get the details of the ride
    public function getRideDetails() {
        return [
            'users' => $this->users,
            'joinedUsers' => $this->joinedUsers,
            'maxPlaces' => $this->maxPlaces,
            'currentPlaces' => $this->currentPlaces,
            'departureDate' => $this->departureDate,
            'departureTime' => $this->departureTime,
            'price' => $this->price
        ];
    }
}
