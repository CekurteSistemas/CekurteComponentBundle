<?php

namespace Cekurte\ComponentBundle\Translation;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Cekurte\ComponentBundle\Util\ContainerAware;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

/**
 * Custom Translator domain
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class Translator extends ContainerAware implements ContainerAwareInterface
{
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var string
     */
    protected $domain;

    /**
     * Construct
     *
     * @param Translator $translator
     */
    public function __construct(SymfonyTranslator $translator, $domain)
    {
        $this->translator   = $translator;
        $this->domain       = $domain;
    }

    /**
     * Translate a message
     *
     * @param  string $message
     *
     * @return string
     */
    public function trans($message)
    {
        return $this->translator->trans($message, array(), $this->domain);
    }
}
