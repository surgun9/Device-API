<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BrowserVersion;
use AppBundle\Entity\Device;
use AppBundle\Form\Type\BrowserVersionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ApiBrowserVersionController extends FOSRestController
{
    /**
     * @param null $browserVersionId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($browserVersionId = null)
    {
        $browserVersionRepository = $this->getDoctrine()->getRepository('AppBundle:BrowserVersion');

        return $this->handleView(
            $this->view(
                null === $browserVersionId
                ? $browserVersionRepository->findAll()
                : $browserVersionRepository->find($browserVersionId), 200
            )
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $responseCode = 204;

        try {
            $browserVersion  = $this->processForm($request, new BrowserVersion(), 'POST');
            $em->persist($browserVersion);
            $em->flush();
        } catch (\Exception $e) {
            $responseCode = 500;
        }

        return $this->handleView(
            $this->view(null, $responseCode)
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param $browserVersionId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $browserVersionId)
    {
        $em = $this->getDoctrine()->getManager();
        $browserVersion = $em->getRepository('AppBundle:BrowserVersion')->find($browserVersionId);
        $responseCode = 403;
        if ($browserVersion instanceof BrowserVersion) {
            try {
//                var_dump($request->get('version')); die;
                $browserVersion = $this->processForm($request, $browserVersion);
                $em->merge($browserVersion);
                $em->flush();

                $responseCode = 204;
            } catch (\Exception $e) {
                $responseCode = 500;
            }
        }

        return $this->handleView(
            $this->view(null, $responseCode)
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param $browserVersionId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($browserVersionId)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:BrowserVersion');
        $responseCode = 403;

        $browserVersion = $repository ->find($browserVersionId);
        if ($browserVersion instanceof BrowserVersion) {
            $em->remove($browserVersion );
            $em->flush();
            $responseCode = 204;
        }

        return $this->handleView(
            $this->view(null, $responseCode)
        );
    }

    /**
     * @param Request|null $request
     * @param BrowserVersion|null $browserVersion
     * @param null $method
     * @return mixed
     */
    private function processForm(Request $request = null, BrowserVersion $browserVersion = null, $method = null)
    {
        $parameters = [];

        if (null !== $method) {
            $parameters['method'] = $method;
        }

        return $this->get('form.factory')
            ->create(new BrowserVersionType(), $browserVersion, $parameters)
            ->submit($request, false)
            ->getData();
    }
}
