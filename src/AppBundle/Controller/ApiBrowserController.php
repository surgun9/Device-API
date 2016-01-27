<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ApiBrowserController extends FOSRestController
{

    /**
     * @param null $browserId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBrowsersAction($browserId = null)
    {
        /** @var Device $deviceRepository */
        $browserRepository = $this->getDoctrine()->getRepository('AppBundle:Browser');

        return $this->handleView(
            $this->view(
                null === $browserId
                ? $browserRepository->findAll()
                : $browserRepository->find($browserId), 200
            )
        );
    }

}
