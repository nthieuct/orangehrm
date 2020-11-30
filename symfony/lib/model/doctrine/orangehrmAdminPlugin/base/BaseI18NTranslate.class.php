<?php

/**
 * BaseI18NTranslate
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int             $id                                    Type: integer, primary key
 * @property int             $langStringId                          Type: integer
 * @property int             $languageId                            Type: integer
 * @property string          $value                                 Type: string
 * @property bool            $translated                            Type: boolean
 * @property bool            $customized                            Type: boolean
 * @property string          $modifiedAt                            Type: datetime, Date and time in ISO-8601 format (YYYY-MM-DD HH:MI)
 * @property I18NLangString  $I18NLangString                        
 * @property I18NLanguage    $I18NLanguage                          
 *  
 * @method int               getId()                                Type: integer, primary key
 * @method int               getLangstringid()                      Type: integer
 * @method int               getLanguageid()                        Type: integer
 * @method string            getValue()                             Type: string
 * @method bool              getTranslated()                        Type: boolean
 * @method bool              getCustomized()                        Type: boolean
 * @method string            getModifiedat()                        Type: datetime, Date and time in ISO-8601 format (YYYY-MM-DD HH:MI)
 * @method I18NLangString    getI18NLangString()                    
 * @method I18NLanguage      getI18NLanguage()                      
 *  
 * @method I18NTranslate     setId(int $val)                        Type: integer, primary key
 * @method I18NTranslate     setLangstringid(int $val)              Type: integer
 * @method I18NTranslate     setLanguageid(int $val)                Type: integer
 * @method I18NTranslate     setValue(string $val)                  Type: string
 * @method I18NTranslate     setTranslated(bool $val)               Type: boolean
 * @method I18NTranslate     setCustomized(bool $val)               Type: boolean
 * @method I18NTranslate     setModifiedat(string $val)             Type: datetime, Date and time in ISO-8601 format (YYYY-MM-DD HH:MI)
 * @method I18NTranslate     setI18NLangString(I18NLangString $val) 
 * @method I18NTranslate     setI18NLanguage(I18NLanguage $val)     
 *  
 * @package    orangehrm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseI18NTranslate extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ohrm_i18n_translate');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('lang_string_id as langStringId', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('language_id as languageId', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('value', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('translated', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('customized', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('modified_at as modifiedAt', 'datetime', null, array(
             'type' => 'datetime',
             ));


        $this->index('translateUniqueId', array(
             'fields' => 
             array(
              0 => 'lang_string_id',
              1 => 'language_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('I18NLangString', array(
             'local' => 'langStringId',
             'foreign' => 'id'));

        $this->hasOne('I18NLanguage', array(
             'local' => 'languageId',
             'foreign' => 'id'));
    }
}