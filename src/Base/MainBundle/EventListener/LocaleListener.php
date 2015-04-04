<?php
namespace Base\MainBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LocaleListener.
 */
class LocaleListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'lt')
    {
        $this->defaultLocale = 'lt';
    }

    /**
     * Process kernel request.
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // Try to see if the locale has been set as a _locale routing parameter.
        if ($locale = $request->getSession()->get('_locale')) {
            if ($locale == 'lt_LT') {
                $locale = $this->defaultLocale;
            }

            $request->getSession()->set('_locale', $locale);
            $request->setLocale($locale);
        } else {
            // If no explicit locale has been set on this request, use one from the session.
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
            $request->getSession()->set('_locale', $this->defaultLocale);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            // Must be registered before the default Locale listener.
            KernelEvents::REQUEST => [['onKernelRequest', 17]],
        ];
    }
}
