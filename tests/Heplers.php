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

class Heplers extends TestCase
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

        $options = configure_options($options, function (OptionsResolver $resolver) {
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

        $this->assertEquals($options, $this->options);
    }

    public function testConfigureOptionsInvalidOptionsException()
    {
        $options = [
            'host' => 'smtp.example.org',
            'username' => 'user',
            'password' => 'password',
            'port' => '25',
        ];
        new EmailStub($options);
        $this->expectException(InvalidOptionsException::class);
    }
}

class EmailStub
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
