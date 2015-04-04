<?php

namespace Base\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * Loads default template.
     *
     * @Route("/", name="base_main_default_index")
     * @Template()
     *
     * @return mixed
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * To change locale.
     *
     * @param string  $locale
     * @param Request $request
     *
     * @Route("/lang/{locale}.html", name="change_locale")
     * @Method("GET")
     * @Template()
     *
     * @return mixed
     */
    public function localeUpdateAction($locale, Request $request)
    {
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);

        return $this->redirect($this->get('request')->headers->get('referer'));
    }
}
