<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehAuthCredentialUser', 'doctrine');

/**
 * BaseehAuthCredentialUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $credential_id
 * @property ehAuthUser $User
 * @property ehAuthCredential $Credential
 * 
 * @method integer              getUserId()        Returns the current record's "user_id" value
 * @method integer              getCredentialId()  Returns the current record's "credential_id" value
 * @method ehAuthUser           getUser()          Returns the current record's "User" value
 * @method ehAuthCredential     getCredential()    Returns the current record's "Credential" value
 * @method ehAuthCredentialUser setUserId()        Sets the current record's "user_id" value
 * @method ehAuthCredentialUser setCredentialId()  Sets the current record's "credential_id" value
 * @method ehAuthCredentialUser setUser()          Sets the current record's "User" value
 * @method ehAuthCredentialUser setCredential()    Sets the current record's "Credential" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehAuthCredentialUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_auth_credential_user');
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('credential_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehAuthUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehAuthCredential as Credential', array(
             'local' => 'credential_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}