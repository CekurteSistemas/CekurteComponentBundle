<?php

namespace Cekurte\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use Symfony\Component\Form\Form;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\ORM\Query;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Cekurte\ComponentBundle\Util\MasterContainerAware;

/**
 * Custom of Symfony Controller.
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
abstract class Controller extends SymfonyController
{
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * {@inherited}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = new MasterContainerAware($container);
    }

    /**
     * Atalho para retornar a paginação de registros.
     *
     * @param Query $query
     * @param int $page
     * @param int $resultsPerPage
     *
     * @return PaginationInterface
     */
    public function getPagination(Query $query, $page, $resultsPerPage = null)
    {
        if ($resultsPerPage === null) {
            $resultsPerPage = $this->container->getParameter('paginator_number_results_per_page');
        }

        return $this->get('knp_paginator')->paginate($query, $page, $resultsPerPage);
    }

    /**
     * Cria um formulário para deletar um registro da base de dados.
     *
     * @return Form
     */
    public function createDeleteForm()
    {
        return $this->createFormBuilder()->add('id', 'hidden')->getForm();
    }
}
