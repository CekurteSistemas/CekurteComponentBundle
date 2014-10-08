# Exemplos

Agora vamos ver alguns exemplos práticos.

- Doctrine Connection Dynamic:

```yml
# app/config/config.yml

# ...
# Doctrine Configuration
doctrine:
    dbal:
        default_connection: default
        connections:
            default:
                driver:   "%database_driver%"
                host:     "%database_host%"
                port:     "%database_port%"
                dbname:   "%database_name%"
                user:     "%database_user%"
                password: "%database_password%"
                charset:  UTF8
            dynamic:
                driver:   "%database_driver%"
                host:     "%database_host%"
                port:     "%database_port%"
                dbname:   "%database_name%"
                user:     "%database_user%"
                password: "%database_password%"
                charset:  UTF8
                wrapper_class: 'Cekurte\ComponentBundle\Connection\DoctrineConnectionWrapper'
    orm:
        auto_generate_proxy_classes: "%kernel.debug%"
        default_entity_manager: default
        entity_managers:
            default:
                connection: default
                mappings:
                    YourFirstBundle: ~
                    YourSecondBundle: ~
            dynamic:
                connection: dynamic
                mappings:
                    YourFirstBundle: ~
                    YourSecondBundle: ~
# ...
```


```php

$this->get('doctrine.dbal.dynamic_connection')->forceSwitch('database-name', 'database-user', 'database-password');

$results = $this
    ->get('doctrine')
    ->getManager('dynamic')
    ->getRepository('YourBundle:YourEntity')
    ->findAll()
;

```

[Voltar para a Instalação](instalacao.md) - [Ir para o Index](index.md)