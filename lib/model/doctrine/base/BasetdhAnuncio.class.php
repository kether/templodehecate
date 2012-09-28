<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhAnuncio', 'doctrine');

/**
 * BasetdhAnuncio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $activo
 * @property string $nombre
 * @property string $descripcion
 * @property string $url
 * @property integer $vistas
 * @property integer $clicks
 * @property boolean $temporal
 * @property boolean $es_flash
 * @property boolean $es_codigo
 * @property string $codigo
 * @property timestamp $desde
 * @property timestamp $hasta
 * @property integer $tipo_id
 * @property tdhAnuncioTipo $Tipo
 * @property tdhAnuncioPago $Pago
 * 
 * @method integer        getId()          Returns the current record's "id" value
 * @method boolean        getActivo()      Returns the current record's "activo" value
 * @method string         getNombre()      Returns the current record's "nombre" value
 * @method string         getDescripcion() Returns the current record's "descripcion" value
 * @method string         getUrl()         Returns the current record's "url" value
 * @method integer        getVistas()      Returns the current record's "vistas" value
 * @method integer        getClicks()      Returns the current record's "clicks" value
 * @method boolean        getTemporal()    Returns the current record's "temporal" value
 * @method boolean        getEsFlash()     Returns the current record's "es_flash" value
 * @method boolean        getEsCodigo()    Returns the current record's "es_codigo" value
 * @method string         getCodigo()      Returns the current record's "codigo" value
 * @method timestamp      getDesde()       Returns the current record's "desde" value
 * @method timestamp      getHasta()       Returns the current record's "hasta" value
 * @method integer        getTipoId()      Returns the current record's "tipo_id" value
 * @method tdhAnuncioTipo getTipo()        Returns the current record's "Tipo" value
 * @method tdhAnuncioPago getPago()        Returns the current record's "Pago" value
 * @method tdhAnuncio     setId()          Sets the current record's "id" value
 * @method tdhAnuncio     setActivo()      Sets the current record's "activo" value
 * @method tdhAnuncio     setNombre()      Sets the current record's "nombre" value
 * @method tdhAnuncio     setDescripcion() Sets the current record's "descripcion" value
 * @method tdhAnuncio     setUrl()         Sets the current record's "url" value
 * @method tdhAnuncio     setVistas()      Sets the current record's "vistas" value
 * @method tdhAnuncio     setClicks()      Sets the current record's "clicks" value
 * @method tdhAnuncio     setTemporal()    Sets the current record's "temporal" value
 * @method tdhAnuncio     setEsFlash()     Sets the current record's "es_flash" value
 * @method tdhAnuncio     setEsCodigo()    Sets the current record's "es_codigo" value
 * @method tdhAnuncio     setCodigo()      Sets the current record's "codigo" value
 * @method tdhAnuncio     setDesde()       Sets the current record's "desde" value
 * @method tdhAnuncio     setHasta()       Sets the current record's "hasta" value
 * @method tdhAnuncio     setTipoId()      Sets the current record's "tipo_id" value
 * @method tdhAnuncio     setTipo()        Sets the current record's "Tipo" value
 * @method tdhAnuncio     setPago()        Sets the current record's "Pago" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhAnuncio extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_anuncio');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));
        $this->hasColumn('nombre', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('descripcion', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('vistas', 'integer', 3, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 3,
             ));
        $this->hasColumn('clicks', 'integer', 3, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 3,
             ));
        $this->hasColumn('temporal', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('es_flash', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('es_codigo', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('codigo', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000,
             ));
        $this->hasColumn('desde', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('hasta', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('tdhAnuncioTipo as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('tdhAnuncioPago as Pago', array(
             'local' => 'id',
             'foreign' => 'anuncio_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'nombre',
             ),
             'canUpdate' => true,
             'unique' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}