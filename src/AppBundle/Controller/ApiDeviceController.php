<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ApiDeviceController extends FOSRestController
{

    /**
     * @param null $deviceId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDevicesAction($deviceId = null)
    {
        /** @var Device $deviceRepository */
        $deviceRepository = $this->getDoctrine()->getRepository('AppBundle:Device');

        return $this->handleView(
            $this->view(
                null === $deviceId
                ? $deviceRepository->findAll()
                : $deviceRepository->find($deviceId), 200
            )
        );
    }

}
