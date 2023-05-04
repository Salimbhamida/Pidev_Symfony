<?php

namespace ContainerQCn5px3;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMeteoConceptHCaptcha_HcaptchaValueFetcherService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'meteo_concept_h_captcha.hcaptcha_value_fetcher' shared service.
     *
     * @return \MeteoConcept\HCaptchaBundle\Form\DataTransformer\HCaptchaValueFetcher
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'form'.\DIRECTORY_SEPARATOR.'DataTransformerInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'meteo-concept'.\DIRECTORY_SEPARATOR.'hcaptcha-bundle'.\DIRECTORY_SEPARATOR.'Form'.\DIRECTORY_SEPARATOR.'DataTransformer'.\DIRECTORY_SEPARATOR.'HCaptchaValueFetcher.php';

        return $container->services['meteo_concept_h_captcha.hcaptcha_value_fetcher'] = new \MeteoConcept\HCaptchaBundle\Form\DataTransformer\HCaptchaValueFetcher(($container->services['request_stack'] ?? ($container->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())));
    }
}