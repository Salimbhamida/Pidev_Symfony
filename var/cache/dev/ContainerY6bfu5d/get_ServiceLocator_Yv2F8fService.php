<?php

namespace ContainerY6bfu5d;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Yv2F8fService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.yv2_F8f' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.yv2_F8f'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'category' => ['privates', '.errored..service_locator.yv2_F8f.App\\Entity\\Categories', NULL, 'Cannot autowire service ".service_locator.yv2_F8f": it references class "App\\Entity\\Categories" but no such service exists.'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'category' => 'App\\Entity\\Categories',
            'entityManager' => '?',
        ]);
    }
}