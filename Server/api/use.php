<?php
class User {
    private $firstName;
    private $lastName;
    private $telephoneNumber;
    // between 1 and 5
    private $rating;
    private $nbRatings = 0;
    private $email;

    public function __construct($firstName, $lastName, $telephoneNumber, $rating, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->telephoneNumber = $telephoneNumber;
        $this->rating = $rating;
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getTelephoneNumber() {
        return $this->telephoneNumber;
    }

    public function setTelephoneNumber($telephoneNumber) {
        $this->telephoneNumber = $telephoneNumber;
    }

    public function getRating() {
        return $this->rating;
    }

    public function addRating($rating) {
        $this->nbRatings++;
        $this->rating += ($rating - $this->rating) / $this->nbRatings;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNbRatings() {
        return $this->nbRatings;
    }

    public function getUserDetails() {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'telephoneNumber' => $this->telephoneNumber,
            'rating' => $this->rating,
            'email' => $this->email
        ];
    }
}
