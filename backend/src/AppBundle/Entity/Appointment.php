<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Appointment {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeslot", type="datetime")
     */
    private $timeslot;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="firstVisit", type="boolean")
     */
    private $firstVisit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="praxis_confirmed", type="boolean")
     */
    private $praxisConfirmed;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="user_confirmed", type="boolean")
     */
    private $userConfirmed;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isBlocker", type="boolean")
     */
    private $isBlocker = false;
        
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="street", type="string")
     */
    private $street;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="city", type="string", length=20)
     */
    private $city;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="zip", type="string", length=6)
     */
    private $zip;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;
    
    /**
     *
     * @var array
     * 
     * @ORM\Column(name="services", type="json_array")
     */
    private $services;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    //private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    //private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    //private $deleted;
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
     /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Appointment
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Set timeslot
     *
     * @param \Datetime $timeslot
     *
     * @return Appointment
     */
    public function setTimeslot(\Datetime $timeslot) {
        $this->timeslot = $timeslot;

        return $this;
    }

    /**
     * Get timeslot
     *
     * @return \Datetime
     */
    public function getTimeslot() {
        return $this->timeslot;
    }

   

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstVisit
     *
     * @param boolean $firstVisit
     *
     * @return Appointment
     */
    public function setFirstVisit($firstVisit) {
        $this->firstVisit = $firstVisit;

        return $this;
    }

    /**
     * Get firstVisit
     *
     * @return boolean
     */
    public function getFirstVisit() {
        return $this->firstVisit;
    }

    public function getIsBlocker() {
        return $this->isBlocker;
    }

    public function setIsBlocker($isBlocker) {
        $this->isBlocker = $isBlocker;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getUpdated() {
        return $this->updated;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setCreated(\DateTime $created) {
        $this->created = $created;
    }

    public function setUpdated(\DateTime $updated) {
        $this->updated = $updated;
    }

    public function setDeleted(\DateTime $deleted) {
        $this->deleted = $deleted;
    }
    
    public function getPraxisConfirmed() {
        return $this->praxisConfirmed;
    }

    public function getUserConfirmed() {
        return $this->userConfirmed;
    }

    public function setPraxisConfirmed($praxisConfirmed) {
        $this->praxisConfirmed = $praxisConfirmed;
    }

    public function setUserConfirmed($userConfirmed) {
        $this->userConfirmed = $userConfirmed;
    }

    
    /**
     * Triggered on insert

     * @ORM\PrePersist
     */
    public function onPrePersist() {
        $this->created = new \DateTime("now");
    }

    /**
     * Triggered on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate() {
        $this->updated = new \DateTime("now");
    }

    /**
     * Triggered on update

     * @ORM\PreRemove
     */
    public function onPreRemove() {
        $this->deleted = new \DateTime("now");
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Appointment
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Appointment
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Appointment
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Appointment
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Appointment
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Appointment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Appointment
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set services
     *
     * @param array $services
     *
     * @return Appointment
     */
    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }
}
