<?php

namespace Cekurte\ComponentBundle\Connection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Events;
use Doctrine\DBAL\Event\ConnectionEventArgs;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Doctrine Connection Wrapper
 *
 * @author Dawid zulus Pakula <zulus@w3des.net>
 * @author João Paulo Cercal <sistemas@cekurte.com>
 *
 * @see http://stackoverflow.com/questions/6409167/symfony-2-multiple-and-dynamic-database-connection
 */
class DoctrineConnectionWrapper extends Connection
{
    /**
     * @var string
     */
    const SESSION_ACTIVE_DYNAMIC_CONNECTION = 'cekurte_dynamic_connection';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var bool
     */
    private $_isConnected = false;

    /**
     * @var array
     */
    private $_params = array();

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Force Switch database connection
     *
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbUser
     * @param string $dbPassword
     */
    public function forceSwitch($dbHost, $dbName, $dbUser, $dbPassword)
    {
        if ($this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONNECTION)) {
            $current = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONNECTION);
            if ($current['host'] === $dbHost and $current['dbname'] === $dbName) {
                return;
            }
        }

        $this->session->set(self::SESSION_ACTIVE_DYNAMIC_CONNECTION, array(
            'host'      => $dbHost,
            'dbname'    => $dbName,
            'user'      => $dbUser,
            'password'  => $dbPassword,
        ));

        if ($this->isConnected()) {
            $this->close();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getParams()
    {
        if ($this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONNECTION)) {

            $current = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONNECTION);

            $this->_params['host']      = $current['host'];
            $this->_params['dbname']    = $current['dbname'];
            $this->_params['user']      = $current['user'];
            $this->_params['password']  = $current['password'];
        }

        return $this->_params;
    }

    /**
     * {@inheritDoc}
     */
    public function connect()
    {
        if (!$this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONNECTION)) {
            throw new \InvalidArgumentException('You have to inject into valid context first');
        }

        if ($this->isConnected()) {
            return false;
        }

        $params = $this->getParams();

        $driverOptions = isset($params['driverOptions']) ? $params['driverOptions'] : array();

        $this->_conn = $this->_driver->connect($params, $params['user'], $params['password'], $driverOptions);

        $this->_isConnected = true;

        if ($this->_eventManager->hasListeners(Events::postConnect)) {
            $eventArgs = new ConnectionEventArgs($this);
            $this->_eventManager->dispatchEvent(Events::postConnect, $eventArgs);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isConnected()
    {
        return $this->_isConnected;
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        if ($this->isConnected()) {
            parent::close();
            $this->_isConnected = false;
        }
    }
}
