<?php

namespace ContainerY6bfu5d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_GFHHwHBService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.gFHHwHB' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.gFHHwHB'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'category' => ['privates', '.errored..service_locator.gFHHwHB.App\\Entity\\Categories', NULL, 'Cannot autowire service ".service_locator.gFHHwHB": it references class "App\\Entity\\Categories" but no such service exists.'],
        ], [
            'category' => 'App\\Entity\\Categories',
        ]);
    }
}
