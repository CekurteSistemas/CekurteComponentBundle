<?php

namespace Cekurte\ComponentBundle\Connection;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\DBAL\Events;
use Doctrine\DBAL\Event\ConnectionEventArgs;

/**
 * Doctrine Connection Wrapper
 *
 * @author Dawid zulus Pakula <zulus@w3des.net>
 * @see http://stackoverflow.com/questions/6409167/symfony-2-multiple-and-dynamic-database-connection
 */
class DoctrineConnectionWrapper extends Connection
{
    /**
     * @var string
     */
    const SESSION_ACTIVE_DYNAMIC_CONNECTION = 'active_dynamic_connection';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var bool
     */
    private $_isConnected = false;

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
     * @param $dbName
     * @param $dbUser
     * @param $dbPassword
     */
    public function forceSwitch($dbName, $dbUser, $dbPassword)
    {
        if ($this->session->has(self::SESSION_ACTIVE_DYNAMIC_CONNECTION)) {
            $current = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONNECTION);
            if ($current[0] === $dbName) {
                return;
            }
        }

        $this->session->set(self::SESSION_ACTIVE_DYNAMIC_CONNECTION, [
            $dbName,
            $dbUser,
            $dbPassword
        ]);

        if ($this->isConnected()) {
            $this->close();
        }
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
            return true;
        }

        $driverOptions = isset($params['driverOptions']) ? $params['driverOptions'] : array();

        $params = $this->getParams();
        $realParams = $this->session->get(self::SESSION_ACTIVE_DYNAMIC_CONNECTION);
        $params['dbname'] = $realParams[0];
        $params['user'] = $realParams[1];
        $params['password'] = $realParams[2];

        $this->_conn = $this->_driver->connect($params, $params['user'], $params['password'], $driverOptions);

        if ($this->_eventManager->hasListeners(Events::postConnect)) {
            $eventArgs = new ConnectionEventArgs($this);
            $this->_eventManager->dispatchEvent(Events::postConnect, $eventArgs);
        }

        $this->_isConnected = true;

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
