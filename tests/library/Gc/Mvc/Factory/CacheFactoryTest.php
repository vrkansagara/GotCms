<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\Mvc\Factory;

use Gc\Test\PHPUnit\Framework\TestCase;
use Mockery;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @group    Gc
 * @category Gc_Tests
 * @package  Library
 */
class CacheFactoryTest extends TestCase
{
    /**
     * @var CacheListener
     */
    protected $object;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->config = Mockery::mock('Gc\Core\Config');
        $this->config->shouldReceive('getValue')->once()->with('cache_lifetime')->andReturn(100);
        $this->serviceLocator = Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator->shouldReceive('get')->with('CoreConfig')->andReturn($this->config);

        $this->object = new CacheFactory();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCreateServiceWithFileSystem()
    {
        $this->config->shouldReceive('getValue')->once()->with('cache_handler')->andReturn('nothing');
        $instance = $this->object->createService($this->serviceLocator);
        $this->assertInstanceOf('Zend\Cache\Storage\Adapter\AbstractAdapter', $instance);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCreateServiceWithFileApc()
    {
        $this->config->shouldReceive('getValue')->once()->with('cache_handler')->andReturn('apc');
        try {
            $instance = $this->object->createService($this->serviceLocator);
            $this->assertInstanceOf('Zend\Cache\Storage\Adapter\AbstractAdapter', $instance);
        } catch (\Zend\Cache\Exception\ExtensionNotLoadedException $e) {
            //don't care
        }
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCreateServiceWithFileMemcached()
    {
        $this->config->shouldReceive('getValue')->once()->with('cache_handler')->andReturn('memcached');
        $this->config->shouldReceive('getValue')->once()->with('site_name')->andReturn('GotCms');
        try {
            $instance = $this->object->createService($this->serviceLocator);
            $this->assertInstanceOf('Zend\Cache\Storage\Adapter\AbstractAdapter', $instance);
        } catch (\Zend\Cache\Exception\ExtensionNotLoadedException $e) {
            //don't care
        }
    }
}
