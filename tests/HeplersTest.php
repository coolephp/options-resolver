<?php

/*
 * This file is part of the coolephp/options-resolver.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coolephp\OptionsResolver\Tests;

use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeplersTest extends TestCase
{
    public function testConfigureOptions()
    {
        $options = [
            'host' => 'smtp.example.org',
            'username' => 'user',
            'password' => 'password',
            'port' => 25,
        ];
        $emailStub = new EmailStub($options);
        $this->assertEquals($options, $emailStub->getOptions());

        $resolvedOptions = configure_options($options, function (OptionsResolver $resolver) {
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
        });
        $this->assertEquals($options, $resolvedOptions);

        $resolvedOptions = configure_options($options, function (OptionsResolver $resolver) {
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
        }, self::class);
        $this->assertEquals($options, $resolvedOptions);

        $resolvedOptions = configure_options($options, function (OptionsResolver $resolver) {
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
        }, function () {
            return $this;
        });
        $this->assertEquals($options, $resolvedOptions);

        $resolvedOptions = configure_options($options, function (OptionsResolver $resolver) {
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
        $this->assertEquals($options, $resolvedOptions);
    }

    public function testConfigureOptionsInvalidOptionsException()
    {
        $this->expectException(InvalidOptionsException::class);

        new EmailStub([
            'host' => 'smtp.example.org',
            'username' => 'user',
            'password' => 'password',
            'port' => '25',
        ]);
    }
}

class EmailStub
{
    private $options;

    /**
     * EmailStub constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions(array $options): void
    {
        $this->options = configure_options($options, function (OptionsResolver $resolver) {
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
        });
    }
}
