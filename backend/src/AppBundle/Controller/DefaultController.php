<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Appointment;
use AppBundle\Form\AppointmentType;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends FOSRestController
{
   /**
    * @Route("/api/slots/{from}/{to}", name="get available slotes", methods="GET")
    * @ParamConverter("from", options={"format": "U"})
    * @ParamConverter("to", options={"format": "U"})
    */
    public function allAvailableSlots(\DateTime $from, \DateTime $to)
    {
        $slotProvider = new \AppBundle\Slots\SlotProvider();
        return $slotProvider->getSlotsByRange($from, $to);        
    }
    
    /**
     * @param type $id
     * @Route("/api/appointments/{id}", name="get single appoinment", methods="GET")
     */
    public function getAppointment($id)
    {
        /** @var Appointment $appointment*/
        $appointment = $this->getDoctrine()->getRepository('AppBundle:Appointment')->findOneById($id);
        return ['appoinment' => ['id' => $appointment->getId(), 'userConfirmed' => $appointment->getUserConfirmed()]];        
    }
            

    /**
    * @Route("/api/appointments", name="create appoinment", methods="POST")
    */
    public function addAppointement(Request $request)
    {
        $appointment = new Appointment();       
        $appointmentType = new AppointmentType($appointment);
        $form = $this->createForm($appointmentType, $appointment);
        //file_put_contents('/tmp/log.log', var_export("\nRequest: ", true), FILE_APPEND);
        //file_put_contents('/tmp/log.log', var_export($request, true), FILE_APPEND);
        $form->submit($request->request->all());        
        
        if (!$form->isValid()){
            $errors = (string) $form->getErrors(true, false);
            file_put_contents('/tmp/log.log', var_export("\nerrorstring: ".$errors, true), FILE_APPEND);
            return View::create(['error' => $form->getErrorsAsString()], 400);
        }
        
        $appointment->setIsBlocker(false);            
        file_put_contents('/tmp/log.log', var_export($appointment, true), FILE_APPEND);
            
        $em = $this->getDoctrine()->getManager();
        $em->persist($appointment);
        $em->flush();

        return ['appointment' => $appointment];
    }
    
    /**
     * 
     * @param type $id
     * @Route("/api/appointments/{id}/confirm", name="register appoinment", methods="PUT")
     */
    public function userConfirmAppointement($id)
    {
        /** @var Appointment $appointment*/
        $appointment = $this->getDoctrine()->getRepository('AppBundle:Appointment')->findOneById($id);
        $appointment->setUserConfirmed(true);
        $em = $this->getDoctrine()->getManager();        
        $em->flush();
        
        return ['appoinment' => ['id' => $appointment->getId(), 'userConfirmed' => $appointment->getUserConfirmed()]];
        
    }
}
