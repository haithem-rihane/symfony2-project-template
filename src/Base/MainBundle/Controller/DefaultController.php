<?php

namespace Base\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="base_main_default_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/lang/{locale}.html", name="change_locale")
     * @Method("GET")
     * @Template()
     */
    public function localeLtAction($locale, Request $request)
    {
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);
        return $this->redirect($this->get('request')->headers->get('referer'));
    }

}
