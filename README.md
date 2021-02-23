# options-resolver

> Elegant verification class initialization options and configuration. - 优雅的校验类初始化选项、配置。

[![Tests](https://github.com/coolephp/options-resolver/workflows/Tests/badge.svg)](https://github.com/coolephp/options-resolver/actions)
[![Check & fix styling](https://github.com/coolephp/options-resolver/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/coolephp/options-resolver/actions)
[![codecov](https://codecov.io/gh/coolephp/options-resolver/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/coolephp/options-resolver)
[![Latest Stable Version](https://poser.pugx.org/coolephp/options-resolver/v)](//packagist.org/packages/coolephp/options-resolver)
[![Total Downloads](https://poser.pugx.org/coolephp/options-resolver/downloads)](//packagist.org/packages/coolephp/options-resolver)
[![License](https://poser.pugx.org/coolephp/options-resolver/license)](//packagist.org/packages/coolephp/options-resolver)

## Requirement

* PHP >= 7.2

## Installation

``` bash
$ composer require coolephp/options-resolver -vvv
```

## Usage

``` php
use Symfony\Component\OptionsResolver\OptionsResolver;

class Email
{
    private $options;

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Email constructor.
     */
    public function __construct(array $options = [])
    {
        configure_options($options, function (OptionsResolver $resolver) {
            $resolver->setDefaults([
                'host' => 'smtp.example.org',
                'username' => 'user',
                'password' => 'password',
                'port' => 25,
            ]);
            $resolver->setRequired(['host', 'username', 'password', 'port']);
            $resolver->setAllowedTypes('host', 'string');
            $resolver->setAllowedTypes('username', 'string');
            $resolver->setAllowedTypes('password', 'string');
            $resolver->setAllowedTypes('port', 'int');
        }, $this);
    }
}
```

## Testing

``` bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [guanguans](https://github.com/guanguans)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
