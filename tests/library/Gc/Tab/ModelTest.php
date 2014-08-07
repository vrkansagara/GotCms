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

namespace Gc\Tab;

use Gc\Test\PHPUnit\Framework\TestCase;
use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\Registry;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModelTest extends TestCase
{
    /**
     * @var Model
     */
    protected $object;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var LayoutModel
     */
    protected $layout;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View Name',
                'identifier' => 'View identifier',
                'description' => 'View Description',
                'content' => 'View Content'
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'Layout Name',
                'identifier' => 'Layout identifier',
                'description' => 'Layout Description',
                'content' => 'Layout Content'
            )
        );
        $this->layout->save();

        $this->user = UserModel::fromArray(
            array(
                'lastname' => 'User test',
                'firstname' => 'User test',
                'email' => 'pierre.rambaud86@gmail.com',
                'login' => 'test',
                'user_acl_role_id' => 1,
            )
        );

        $this->user->setPassword('test');
        $this->user->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document Type Name',
                'description' => 'Document Type description',
                'icon_id' => 1,
                'defaultview_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );

        $this->documentType->save();

        $this->object = Model::fromArray(
            array(
                'name' => 'TabTest',
                'description' => 'TabTest',
                'sort_order' => 1,
                'document_type_id' => $this->documentType->getId(),
            )
        );
        $this->object->save();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testLoad()
    {
        $this->assertInstanceOf(
            'Gc\Tab\Model',
            $this->object->load($this->object->getId(), $this->object->getDocumentTypeId())
        );
    }

    /**
     * Test
     *
     * @return void
     */
    public function testLoadWithWrongValues()
    {
        $this->assertFalse($this->object->load('undefined'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSave()
    {
        $this->assertInternalType('integer', (int) $this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSaveWithWrongValues()
    {
        $configuration = Registry::get('Application')->getConfig();
        if ($configuration['db']['driver'] == 'pdo_mysql') {
            $this->markTestSkipped('Mysql does not thrown exception.');
        }

        $this->setExpectedException('\Gc\Exception');
        $this->object->setDocumentTypeId('undefined');
        $this->assertFalse($this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDelete()
    {
        $this->assertTrue($this->object->delete());
        //Code coverage
        $model = new Model();
        $this->assertFalse($model->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteWithWrongValues()
    {
        $configuration = Registry::get('Application')->getConfig();
        if ($configuration['db']['driver'] == 'pdo_mysql') {
            $this->markTestSkipped('Mysql does not thrown exception.');
        }

        $this->setExpectedException('\Gc\Exception');
        $model = new Model();
        $model->setId('undefined');
        $this->assertFalse($model->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromArray()
    {
        $this->assertInstanceOf('Gc\Tab\Model', Model::fromArray($this->object->getData()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromId()
    {
        $this->assertInstanceOf('Gc\Tab\Model', Model::fromId($this->object->getId()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromIdWithWrongValues()
    {
        $this->assertFalse(Model::fromId('undefined'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetDocumentType()
    {
        $this->assertInstanceOf('Gc\DocumentType\Model', $this->object->getDocumentType());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetProperties()
    {
        $this->assertInternalType('array', $this->object->getProperties());
    }
}
