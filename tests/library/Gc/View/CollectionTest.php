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

namespace Gc\View;

use Gc\Test\PHPUnit\Framework\TestCase;
use Gc\DocumentType\Model as DocumentTypeModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:07.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class CollectionTest extends TestCase
{
    /**
     * @var Collection
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
        $this->object = new Collection;

        $model = Model::fromArray(
            array(
                'name' => 'name-collection-test',
                'identifier' => 'identifier-collection-test',
                'description' => 'description-collection-test',
                'content' => 'content-collection-test'
            )
        );

        $model->save();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInit()
    {
        $this->object->init(1);
        $this->assertEquals(1, $this->object->getDocumentTypeId());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetViewsWithDocumentType()
    {
        $this->object->init(1000);
        $views = $this->object->getAll();
        $this->assertEquals(0, count($views));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetViews()
    {
        $this->object->init(null);
        $views = $this->object->getAll();
        $this->assertTrue(count($views) > 0);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetSelect()
    {
        $this->object->init(null);
        $views = $this->object->getSelect();
        $this->assertTrue(count($views) > 0);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testAddElement()
    {
        $model = Model::fromIdentifier('identifier-collection-test');
        $this->object->addElement($model);
        $this->assertEquals(1, count($this->object->getElements()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testClearElements()
    {
        $model = Model::fromIdentifier('identifier-collection-test');
        $this->object->addElement($model);
        $this->object->clearElements();
        $this->assertEquals(0, count($this->object->getElements()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetElements()
    {
        $model = Model::fromIdentifier('identifier-collection-test');
        $this->object->addElement($model);
        $this->assertEquals(1, count($this->object->getElements()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSave()
    {
        $model        = Model::fromIdentifier('identifier-collection-test');
        $documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document type name',
                'description' => 'Document type description',
                'defaultview_id' => $model->getId(),
                'icon_id' => 1,
                'user_id' => 1,
            )
        );

        $documentType->save();
        $this->object->init($documentType->getId());
        $this->object->addElement($model);

        $this->assertTrue($this->object->save());
        $documentType->delete();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSaveFailed()
    {
        $this->object->init(0);
        $this->assertFalse($this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDelete()
    {
        $model        = Model::fromIdentifier('identifier-collection-test');
        $documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document type name',
                'description' => 'Document type description',
                'defaultview_id' => $model->getId(),
                'icon_id' => 1,
                'user_id' => 1,
            )
        );

        $documentType->save();
        $this->object->init($documentType->getId());
        $this->object->addElement($model);
        $this->object->save();

        $this->assertTrue($this->object->delete());
        $documentType->delete();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteFailed()
    {
        $this->object->init(0);
        $this->assertFalse($this->object->delete());
    }
}
