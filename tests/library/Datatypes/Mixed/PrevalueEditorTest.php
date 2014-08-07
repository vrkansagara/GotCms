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
 * @package  Datatypes
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Datatypes\Mixed;

use Gc\Test\PHPUnit\Framework\TestCase;
use Gc\Datatype\Model as DatatypeModel;
use Gc\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:42:12.
 *
 * @group Datatypes
 * @category Gc_Tests
 * @package  Datatypes
 */
class PrevalueEditorTest extends TestCase
{
    /**
     * @var PrevalueEditor
     */
    protected $object;

    /**
     * @var DatatypeModel
     */
    protected $datatype;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->datatype = DatatypeModel::fromArray(
            array(
                'name' => 'MixedTest',
                'prevalue_value' =>
                    'a:1:{s:9:"datatypes";a:1:{i:0;a:3:{s:4:"name";' .
                    's:10:"Textstring";s:5:"label";s:4:"Test";s:6:"config";' .
                    'a:1:{s:6:"length";s:0:"";}}}}',
                'model' => 'Mixed',
            )
        );
        $this->datatype->save();
        $datatype    = new Datatype();
        $application = Registry::get('Application');
        $datatype->setRequest($application->getServiceManager()->get('Request'));
        $datatype->setRouter($application->getServiceManager()->get('Router'));
        $datatype->setHelperManager($application->getServiceManager()->get('viewhelpermanager'));
        $datatype->setDatatypesList($application->getServiceManager()->get('DatatypesList'));
        $datatype->load($this->datatype);
        $this->object = $datatype->getPrevalueEditor();
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSave()
    {
        $post = $this->object->getRequest()->getPost();
        $post->set('add-model', 'Textstring');
        $post->set(
            'datatypes',
            array(
                1 => array(
                    'name' => 'Textstring',
                    'label' => 'TextstringTest',
                    'length' => 25,
                ),
            )
        );
        $this->assertNull($this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testLoad()
    {
        $this->assertInternalType('string', $this->object->load());
    }
}
