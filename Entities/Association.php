<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:47
 */

class Association {

    protected   $id,
                $name,
                $manager,
                $ligue;

    /**
     * Association constructor.
     * @param $id
     * @param $name
     * @param $manager
     * @param $ligue
     */
    public function __construct($id, $name, $manager, $ligue)
    {
        $this->id = $id;
        $this->name = $name;
        $this->manager = $manager;
        $this->ligue = $ligue;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return mixed
     */
    public function getLigue()
    {
        return $this->ligue;
    }

    /**
     * @param mixed $ligue
     */
    public function setLigue($ligue)
    {
        $this->ligue = $ligue;
    }



}