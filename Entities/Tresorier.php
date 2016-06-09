<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:46
 */

class Tresorier {

    protected   $id,
                $email,
                $firstName,
                $lastName,
                $password,
                $level,
                $association;

    /**
     * Tresorier constructor.
     * @param $id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $password
     * @param $association
     */
    public function __construct($id, $email, $firstName, $lastName, $password, $level, $association)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->level = $level;
        $this->association = $association;
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
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param mixed $association
     */
    public function setAssociation($association)
    {
        $this->association = $association;
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




}