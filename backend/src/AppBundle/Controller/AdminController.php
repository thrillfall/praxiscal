<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Appointment;
use AppBundle\Form\AppointmentType;
use FOS\RestBundle\View\View;

class AdminController extends Controller
{
    /**
    * @Route("/api/admin/appointments", name="list appoinments", methods="GET")
    */
    public function getAppointments(Request $request)
    {
        $allAppointments = $this->getDoctrine()->getRepository('AppBundle:Appointment')->findAll();
        return ['appointments' => $allAppointments];        
    }
    
}
