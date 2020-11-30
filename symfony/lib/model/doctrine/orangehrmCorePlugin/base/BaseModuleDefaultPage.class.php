<?php

/**
 * BaseModuleDefaultPage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                $id                         Type: integer, primary key
 * @property int                $module_id                  Type: integer
 * @property int                $user_role_id               Type: integer
 * @property string             $action                     Type: string(255)
 * @property string             $enable_class               Type: string(100)
 * @property int                $priority                   Type: integer(4), default "0"
 * @property UserRole           $UserRole                   
 * @property Module             $Module                     
 *  
 * @method int                  getId()                     Type: integer, primary key
 * @method int                  getModuleId()               Type: integer
 * @method int                  getUserRoleId()             Type: integer
 * @method string               getAction()                 Type: string(255)
 * @method string               getEnableClass()            Type: string(100)
 * @method int                  getPriority()               Type: integer(4), default "0"
 * @method UserRole             getUserRole()               
 * @method Module               getModule()                 
 *  
 * @method ModuleDefaultPage    setId(int $val)             Type: integer, primary key
 * @method ModuleDefaultPage    setModuleId(int $val)       Type: integer
 * @method ModuleDefaultPage    setUserRoleId(int $val)     Type: integer
 * @method ModuleDefaultPage    setAction(string $val)      Type: string(255)
 * @method ModuleDefaultPage    setEnableClass(string $val) Type: string(100)
 * @method ModuleDefaultPage    setPriority(int $val)       Type: integer(4), default "0"
 * @method ModuleDefaultPage    setUserRole(UserRole $val)  
 * @method ModuleDefaultPage    setModule(Module $val)      
 *  
 * @package    orangehrm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseModuleDefaultPage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ohrm_module_default_page');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('module_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('user_role_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('action', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('enable_class', 'string', 100, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 100,
             ));
        $this->hasColumn('priority', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UserRole', array(
             'local' => 'user_role_id',
             'foreign' => 'id'));

        $this->hasOne('Module', array(
             'local' => 'module_id',
             'foreign' => 'id'));
    }
}