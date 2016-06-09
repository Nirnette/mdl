<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:46
 */

class adherent {

    protected   $id,
                $licenceNumber,
                $firstName,
                $lastName,
                $association;

    /**
     * adherent constructor.
     * @param $id
     * @param $licenceNumber
     * @param $firstName
     * @param $lastName
     * @param $association
     */
    public function __construct($id, $licenceNumber, $firstName, $lastName, $association)
    {
        $this->id = $id;
        $this->licenceNumber = $licenceNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
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
    public function getLicenceNumber()
    {
        return $this->licenceNumber;
    }

    /**
     * @param mixed $licenceNumber
     */
    public function setLicenceNumber($licenceNumber)
    {
        $this->licenceNumber = $licenceNumber;
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


}