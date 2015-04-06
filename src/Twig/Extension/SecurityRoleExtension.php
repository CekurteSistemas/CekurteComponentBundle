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

use Cekurte\ComponentBundle\DependencyInjection\ContainerAware\SecurityContainerAwareTrait;

/**
 * SecurityRole Extension
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SecurityRoleExtension extends RouteInfoExtension
{
    use SecurityContainerAwareTrait;

    /**
     * @var string
     */
    const ROLE_PREFIX = 'ROLE';

    /**
     * @var string
     */
    const ROLE_SEPARATOR = '_';

    /**
     * Get the security role name used by Admin user.
     *
     * @return string
     */
    protected function getSecurityRoleAdmin()
    {
        return self::ROLE_PREFIX . self::ROLE_SEPARATOR . 'ADMIN';
    }

    /**
     * Get a specific role suffix.
     *
     * @param  string $role
     * @return string
     */
    protected function getSpecificRoleSuffix($role)
    {
        return (empty($role) or 'LIST' === strtoupper($role))
            ? ''
            : self::ROLE_SEPARATOR . strtoupper($role)
        ;
    }

    /**
     * Get a specific role formatted.
     *
     * @param  string $role
     * @return string
     */
    protected function getSpecificRoleFormatted($role)
    {
        return ''
            . self::ROLE_PREFIX
            . self::ROLE_SEPARATOR
            . str_replace('\\', '', strtoupper($this->getBundleName()))
            . self::ROLE_SEPARATOR
            . strtoupper($this->getControllerName())
            . $this->getSpecificRoleSuffix($role)
        ;
    }

    /**
     * Checks if the user has permission to perform the action.
     *
     * @param string      $specificRole
     * @param string|null $genericRole
     *
     * @return bool
     */
    protected function isGranted($specificRole = 'LIST', $genericRole = null)
    {
        $securityContext = $this->getSecurityContext();

        if ($securityContext->isGranted(is_null($genericRole) ? $this->getSecurityRoleAdmin() : $genericRole)) {
            return true;
        }

        if ($securityContext->isGranted($this->getSpecificRoleFormatted($specificRole))) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'cekurte_is_granted' => new \Twig_Function_Method($this, 'isGranted'),
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'cekurte_security_role_extension';
    }
}
