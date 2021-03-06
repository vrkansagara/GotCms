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
 * @package  Modules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */
namespace Backup\Controller;

use Backup\Module;
use Gc\Event\StaticEventManager;
use Gc\Registry;
use Gc\Module\Model as ModuleModel;
use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-30 at 08:29:30.
 *
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();
        ModuleModel::install(Registry::get('Application')->getServiceManager()->get('CustomModules'), 'Backup');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
        StaticEventManager::resetInstance();
        ModuleModel::uninstall(
            Registry::get('Application')->getServiceManager()->get('CustomModules')->getModule('Backup'),
            ModuleModel::fromName('Backup')
        );
        parent::tearDown();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/module/backup');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDownloadDatabaseAction()
    {
        $this->dispatch(
            '/admin/module/backup/download-database',
            'POST',
            array('what' => 'structureonly')
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/download-database');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDownloadDatabaseWithEmptyWhatShouldRedirect()
    {
        $this->dispatch(
            '/admin/module/backup/download-database',
            'POST',
            array('what' => '')
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/download-database');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDownloadFilesAction()
    {
        $this->dispatch('/admin/module/backup/download-files');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/download-files');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDownloadContentAction()
    {
        $this->dispatch(
            '/admin/module/backup/download-content',
            'POST',
            array('what' => array('documents'))
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/download-content');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDownloadContentActionWithEmptyWhatShouldRedirect()
    {
        $this->dispatch(
            '/admin/module/backup/download-content',
            'POST',
            array('what' => array())
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/download-content');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUploadWithXml()
    {
        $_FILES = array(
            'upload' => array(
                'name' =>  'test.xml',
                'type' => 'text/xml',
                'size' => 8,
                'tmp_name' => __DIR__ . '/_files/test.xml',
                'error' => UPLOAD_ERR_OK,
            )
        );

        $this->dispatch('/admin/module/backup/upload-content');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/upload-content');
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUploadActionWithEmptyFilesData()
    {
        $_FILES = array('upload' => array());
        $this->dispatch('/admin/module/backup/upload-content');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Backup');
        $this->assertControllerName('BackupController');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('module/backup/upload-content');
    }
}
