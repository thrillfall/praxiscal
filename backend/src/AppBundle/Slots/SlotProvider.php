<?php

namespace AppBundle\Slots;

use \Symfony\Component\DependencyInjection\ContainerAware;

class SlotProvider extends ContainerAware {

    public function __construct() {
        
    }

    /**
     * 
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function getSlotsByRange(\DateTime $from, \DateTime $to) {
        $baseDate = new \DateTime('+ ' . $this->getTimeShift());
        $baseDate = ($from > $baseDate) ? $from : $baseDate;
        
        $slots = [];
        do {
            if (in_array($baseDate->format('l'), $this->getAvailableDays())) {
                foreach ($this->getAvailableHours() as $hour) {
                    $currentDay = clone $baseDate;
                    $slots[] = $currentDay->setTime($hour,0);
                }
            }
        } while ($baseDate->modify('+1 day') <= $to);

        return $slots;
    }

    public function getAvailableDays() {
        return ['Friday'];
    }

    public function getAvailableHours() {
        return ['08', '14'];
    }

    protected function getTimeShift() {
        return "2 weeks";
    }

}
