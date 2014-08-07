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

namespace Gc\Test\PHPUnit\Controller;

use Gc\Test\PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-14 at 08:46:46.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractHttpControllerTestCaseTest extends TestCase
{
    /**
     * @var AbstractHttpControllerTestCase
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
        $this->object = $this->getMockForAbstractClass('Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInit()
    {
        $this->assertNull($this->object->init());
        $this->object->tearDown();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testTearDown()
    {
        $this->object->init();
        $this->assertNull($this->object->tearDown());
    }
}
