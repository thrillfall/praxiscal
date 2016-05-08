<?php

namespace AppBundle\Entity;

class Slot {
    
    /** @var \DateTime */
    private $timestamp;
    
    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTime $timestamp) {
        $this->timestamp = $timestamp;
        return $this;
    }
    
}
