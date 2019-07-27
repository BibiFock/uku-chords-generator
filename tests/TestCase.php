<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTest;

abstract class TestCase extends BaseTest
{
    protected static function getProtectedMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
