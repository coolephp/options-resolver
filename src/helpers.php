<?php

/*
 * This file is part of the coolephp/options-resolver.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Symfony\Component\OptionsResolver\OptionsResolver;

if (! function_exists('configure_options')) {
    /**
     * Configuration options.
     *
     * @param \Closure $closure
     * @param null     $object
     *
     * @return array
     */
    function configure_options(array $options, Closure $closure, $object = null)
    {
        $resolver = new OptionsResolver();
        $closure($resolver);
        if ($object instanceof Closure) {
            return $object()->options = $resolver->resolve($options);
        }
        if (is_object($object)) {
            return $object->options = $resolver->resolve($options);
        }
        if (is_string($object) && class_exists($object)) {
            $object = new $object();

            return $object->options = $resolver->resolve($options);
        }

        return $resolver->resolve($options);
    }
}
