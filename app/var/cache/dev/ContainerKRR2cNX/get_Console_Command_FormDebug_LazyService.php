<?php

namespace ContainerKRR2cNX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Console_Command_FormDebug_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.console.command.form_debug.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/LazyCommand.php';

        return $container->privates['.console.command.form_debug.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('debug:form', [], 'Display form type information', false, #[\Closure(name: 'console.command.form_debug', class: 'Symfony\\Component\\Form\\Command\\DebugCommand')] fn (): \Symfony\Component\Form\Command\DebugCommand => ($container->privates['console.command.form_debug'] ?? $container->load('getConsole_Command_FormDebugService')));
    }
}
