# Instalação

Assumimos que você já tenha o binário do composer instalado ou o arquivo composer.phar, sendo assim, execute o seguinte comando:

```bash
$ composer require cekurte/componentbundle
```

Agora adicione o Bundle no seu Kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Cekurte\ComponentBundle\CekurteComponentBundle(),
        // ...
    );
}
```

[Voltar para o Index](index.md) - [Ver Exemplos](exemplos.md)