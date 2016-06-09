<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:45
 */

class Demandeur{

    protected   $firstName,
                $lastName,
                $email,
                $password,
                $id,
                $level,
                $adress,
                $town,
                $postalCode;

    /**
     * Demandeur constructor.
     * @param $id
     * @param $lastName
     * @param $firstName
     * @param $email
     * @param $password
     * @param $level
     * @param $adress
     * @param $town
     * @param $postalCode
     */
    public function __construct($id, $lastName, $firstName, $email, $password, $level, $adress, $town, $postalCode)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->level = $level;
        $this->adress = $adress;
        $this->town = $town;
        $this->postalCode = $postalCode;
    }


    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }



}

