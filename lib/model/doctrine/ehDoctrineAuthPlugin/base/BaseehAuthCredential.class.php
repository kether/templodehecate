<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehAuthCredential', 'doctrine');

/**
 * BaseehAuthCredential
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $ehAuthCredentialUser
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method Doctrine_Collection getUsers()                Returns the current record's "Users" collection
 * @method Doctrine_Collection getEhAuthCredentialUser() Returns the current record's "ehAuthCredentialUser" collection
 * @method ehAuthCredential    setId()                   Sets the current record's "id" value
 * @method ehAuthCredential    setName()                 Sets the current record's "name" value
 * @method ehAuthCredential    setDescription()          Sets the current record's "description" value
 * @method ehAuthCredential    setUsers()                Sets the current record's "Users" collection
 * @method ehAuthCredential    setEhAuthCredentialUser() Sets the current record's "ehAuthCredentialUser" collection
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehAuthCredential extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_auth_credential');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 128,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ehAuthUser as Users', array(
             'refClass' => 'ehAuthCredentialUser',
             'local' => 'credential_id',
             'foreign' => 'user_id'));

        $this->hasMany('ehAuthCredentialUser', array(
             'local' => 'id',
             'foreign' => 'credential_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}