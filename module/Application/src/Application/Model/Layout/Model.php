<?php

namespace Application\Model\Layout;

use Es\Db\AbstractTable,
    Es\Component\IterableInterface;

class Model extends AbstractTable implements IterableInterface
{
    protected $_name = 'layouts';

    /**
    * @param integer $id
    * @return Model
    */
    public function init($id = NULL)
    {
        $this->setId($id);

        return $this;
    }

    /**
    * @param array $layout
    * @return Model
    */
    static function fromArray(Array $array)
    {
        $layout_table = new Model();
        $layout->setData($array);

        return $layout;
    }


    /**
    * @param integer $id
    * @return Model
    */
    static function fromId($id)
    {
        $layout_table = new Model();
        $select = $layout_table->select()
                ->where('id = ?', $id);
        $row = $layout_table->fetchRow($select);
        if(!empty($row))
        {
            return $row->setData($row->toArray());
        }
        else
        {
            return FALSE;
        }
    }

    /**
    * @return unknown_type
    */
    public function save()
    {
        $array_save = array('name' => $this->getName(),
            'identifier' => $this->getIdentifier(),
            'description' => $this->getDescription(),
            'content' => $this->getContent(),
            'updated_at' => new \Zend\Db\Expr('NOW()')
        );

        try
        {
            $id = $this->getId();
            if(empty($id))
            {
                $array_save['created_at'] = new \Zend\Db\Expr('NOW()');
                $this->setId($this->insert($array_save));
            }
            else
            {
                $this->update($array_save, sprintf('id = %d', $id));
            }

            return $this->getId();
        }
        catch (Exception $e)
        {
            /**
            * TODO(Make Es_Error)
            */
            Es_Error::set(get_class($this), $e);
        }

        return FALSE;
    }

    public function delete()
    {
        $id = $this->getId();
        if(!empty($id))
        {
            if(parent::delete('id = '.$id))
            {
                unset($this);
                return TRUE;
            }
        }

        return FALSE;
    }

    /*
    * Es_Interface Methods
    */
    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getParent()
    */
    public function getParent()
    {
        return FALSE;
    }

    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getChildren()
    */
    public function getChildren()
    {
        return FALSE;
    }

    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getId()
    */
    public function getId()
    {
        return $this->getData('id');
    }

    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getIterableId()
    */
    public function getIterableId()
    {
        return 'layout-'.$this->getId();
    }

    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getName()
    */
    public function getName()
    {
        return $this->getData('name');
    }

    /* (non-PHPdoc)
    * @see include/Es/Interface/Es_Interface_Iterable#getUrl()
    */
    public function getUrl()
    {
        return 'javascript:loadController(\''.Zend_Controller_Action_HelperBroker::getStaticHelper('url')->url(array('controller'=>'development','action'=>'edit')).'/type/layout/id/'.$this->getId().'\')';
    }

    public function getIcon()
    {
        return 'file';
    }
}
