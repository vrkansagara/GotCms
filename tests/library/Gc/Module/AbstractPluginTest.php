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

namespace Gc\Module;

use Gc\Test\PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-28 at 20:43:01.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractPluginTest extends TestCase
{
    /**
     * @var AbstractPlugin
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
        $this->object = $this->getMockForAbstractClass('Gc\Module\AbstractPlugin');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSetParams()
    {
        $this->assertInstanceOf('Gc\Module\AbstractPlugin', $this->object->setParams(array('key' => 'value')));
        $this->assertEquals('value', $this->object->getParam('key'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSetParam()
    {
        $this->assertInstanceOf('Gc\Module\AbstractPlugin', $this->object->setParam('key', 'value'));
        $this->assertEquals('value', $this->object->getParam('key'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetParam()
    {
        $this->assertInstanceOf('Gc\Module\AbstractPlugin', $this->object->setParam('key', 'value'));
        $this->assertEquals('value', $this->object->getParam('key'));
        $this->assertNull($this->object->getParam('key2'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testRender()
    {
        $this->assertEquals('Render view' . PHP_EOL, $this->object->addPath(__DIR__ . '/_files')->render('view.phtml'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testAddPath()
    {
        $this->assertInstanceOf('Gc\Module\AbstractPlugin', $this->object->addPath(__DIR__));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Request', $this->object->getRequest());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', $this->object->getResponse());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testPlugin()
    {
        $this->assertInstanceOf('Zend\Mvc\Controller\Plugin\Redirect', $this->object->plugin('redirect'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCall()
    {
        $this->assertInstanceOf('Zend\Mvc\Controller\Plugin\Redirect', $this->object->redirect());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testCallWithIsCallablePlugin()
    {
        $this->assertInstanceOf('Zend\Mvc\Controller\Plugin\Params', $this->object->params());
    }
}
