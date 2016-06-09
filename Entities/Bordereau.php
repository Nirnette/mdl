<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:46
 */


class Bordereau {

    protected   $id,
                $demandeur,
                $lines,
                $adherents,
                $locked,
                $association;

    /**
     * Bordereau constructor.
     * @param $id
     * @param $demandeur
     * @param $association
     * @param $locked
     */
    public function __construct($id, $demandeur, $association, $locked)
    {
        $this->id = $id;
        $this->demandeur = $demandeur;
        $this->lines = array();
        $this->adherents = array();
        $this->association = $association;
        $this->locked = $locked;
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
    public function getDemandeur()
    {
        return $this->demandeur;
    }

    /**
     * @param mixed $demandeur
     */
    public function setDemandeur($demandeur)
    {
        $this->demandeur = $demandeur;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->lines;
    }

    public function getLine($id){

        foreach ($this->lines as $line)
        {
            if ($line['id'] == $id)
            {
                return $line;
            }
        }

        return null;
    }


    /**
     * @param mixed $lines
     */
    public function setLines($lines)
    {
        $this->lines = $lines;
    }

    public function addLine($line)
    {
        $this->lines[] = $line;
    }

    /**
     * @return mixed
     */
    public function getAdherents()
    {
        return $this->adherents;
    }

    /**
     * @param mixed $adherents
     */
    public function setAdherents($adherents)
    {
        $this->adherents = $adherents;
    }

    public function addAdherent($adherent)
    {
        $this->adherents[] = $adherent;

        return $this->adherents;

    }

    /**
     * @return mixed
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param mixed $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    public function isLocked()
    {
        if ($this->locked == true)
        {
            return true;
        }

        return false;
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