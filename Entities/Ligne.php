<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:46
 */

class Ligne {

    protected   $id,
                $bordereau,
                $date,
                $motif,
                $departure,
                $arrival,
                $km,
                $ch,
                $peage,
                $repas,
                $hebergement;

    /**
     * Ligne constructor.
     * @param $id
     * @param $bordereau
     * @param $date
     * @param $motif
     * @param $departure
     * @param $arrival
     * @param $km
     * @param $ch
     * @param $peage
     * @param $repas
     * @param $hebergement
     */
    public function __construct($id, $bordereau, $date, $motif, $departure, $arrival, $km, $ch, $peage, $repas, $hebergement)
    {
        $this->id = $id;
        $this->bordereau = $bordereau;
        $this->date = $date;
        $this->motif = $motif;
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->km = $km;
        $this->ch = $ch;
        $this->peage = $peage;
        $this->repas = $repas;
        $this->hebergement = $hebergement;
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
    public function getBordereau()
    {
        return $this->bordereau;
    }

    /**
     * @param mixed $bordereau
     */
    public function setBordereau($bordereau)
    {
        $this->bordereau = $bordereau;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param mixed $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * @return mixed
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * @param mixed $km
     */
    public function setKm($km)
    {
        $this->km = $km;
    }

    /**
     * @return mixed
     */
    public function getPeage()
    {
        return $this->peage;
    }

    /**
     * @param mixed $peage
     */
    public function setPeage($peage)
    {
        $this->peage = $peage;
    }

    /**
     * @return mixed
     */
    public function getRepas()
    {
        return $this->repas;
    }

    /**
     * @param mixed $repas
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;
    }

    /**
     * @return mixed
     */
    public function getHebergement()
    {
        return $this->hebergement;
    }

    /**
     * @param mixed $hebergement
     */
    public function setHebergement($hebergement)
    {
        $this->hebergement = $hebergement;
    }

    /**
     * @return mixed
     */
    public function getCh()
    {
        return $this->ch;
    }

    /**
     * @param mixed $ch
     */
    public function setCh($ch)
    {
        $this->ch = $ch;
    }


}