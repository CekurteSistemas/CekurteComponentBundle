<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Twig\Extension;

use Cekurte\ComponentBundle\DependencyInjection\ContainerAware\RequestContainerAwareTrait;

/**
 * Route Information Extension
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class RouteInfoExtension extends AbstractContainerAwareExtension
{
    use RequestContainerAwareTrait;

    /**
     * Get the bundle name
     *
     * @return string
     */
    protected function getBundleName()
    {
        $pattern = "/(.*)Bundle/";
        $matches = array();
        preg_match($pattern, $this->getRequest()->get('_controller'), $matches);
        return empty($matches) ? null : $matches[1];
    }

    /**
     * Get the controller name
     *
     * @return string
     */
    protected function getControllerName()
    {
        $pattern = "/Controller\\\([a-zA-Z]*)Controller/";
        $matches = array();
        preg_match($pattern, $this->getRequest()->get('_controller'), $matches);
        return empty($matches) ? null : $matches[1];
    }

    /**
     * Get the action name
     *
     * @return string
     */
    protected function getActionName()
    {
        $pattern = "/::([a-zA-Z]*)Action/";
        $matches = array();
        preg_match($pattern, $this->getRequest()->get('_controller'), $matches);
        return empty($matches) ? null : $matches[1];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'cekurte_bundle_name'     => new \Twig_Function_Method($this, 'getBundleName'),
            'cekurte_controller_name' => new \Twig_Function_Method($this, 'getControllerName'),
            'cekurte_action_name'     => new \Twig_Function_Method($this, 'getActionName'),
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'cekurte_route_info_extension';
    }
}
