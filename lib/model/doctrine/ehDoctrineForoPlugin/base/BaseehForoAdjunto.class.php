<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehForoAdjunto', 'doctrine');

/**
 * BaseehForoAdjunto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $mensaje_id
 * @property integer $tipo_id
 * @property string $nombre
 * @property string $nombre_fichero
 * @property integer $numero_descargas
 * @property ehForoMensaje $Mensaje
 * @property ehForoAdjuntoTipo $Tipo
 * 
 * @method integer           getId()               Returns the current record's "id" value
 * @method integer           getMensajeId()        Returns the current record's "mensaje_id" value
 * @method integer           getTipoId()           Returns the current record's "tipo_id" value
 * @method string            getNombre()           Returns the current record's "nombre" value
 * @method string            getNombreFichero()    Returns the current record's "nombre_fichero" value
 * @method integer           getNumeroDescargas()  Returns the current record's "numero_descargas" value
 * @method ehForoMensaje     getMensaje()          Returns the current record's "Mensaje" value
 * @method ehForoAdjuntoTipo getTipo()             Returns the current record's "Tipo" value
 * @method ehForoAdjunto     setId()               Sets the current record's "id" value
 * @method ehForoAdjunto     setMensajeId()        Sets the current record's "mensaje_id" value
 * @method ehForoAdjunto     setTipoId()           Sets the current record's "tipo_id" value
 * @method ehForoAdjunto     setNombre()           Sets the current record's "nombre" value
 * @method ehForoAdjunto     setNombreFichero()    Sets the current record's "nombre_fichero" value
 * @method ehForoAdjunto     setNumeroDescargas()  Sets the current record's "numero_descargas" value
 * @method ehForoAdjunto     setMensaje()          Sets the current record's "Mensaje" value
 * @method ehForoAdjunto     setTipo()             Sets the current record's "Tipo" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehForoAdjunto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_foro_adjunto');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('mensaje_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('nombre_fichero', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('numero_descargas', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehForoMensaje as Mensaje', array(
             'local' => 'mensaje_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehForoAdjuntoTipo as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}