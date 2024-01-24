<?php
/* $Id$ */
/**
*
* @author         $Author$
* @version        $Revision$
* @lastrevision   $Date$
* @modifiedby     $LastChangedBy$
* @lastmodified   $LastChangedDate$
*
*/
/**
*
* EDOTPLUS 
*
* @project      EZADRUGA web portal
* @copyright    (C)2011 by Srđan Petrović@edotplus. All rights reserved.
* @license      Edotplus applications are not free software. For usage, distribution, using,
*               changing or copying any part of the code you need to have exclusive permission
*               by Srdjan Petrovic. Any violation of those rules will be considered as
*               intellectual property theft!
*
* @file         c_db.inc
* @package      include 
* @subpackage   
*
* @description  Database connection ASCII
*
* @important    The inc extensions is used for security reasons
*                Configure server to prevent view the content of the inc file
*                !!! For correct work database must be created !!!
*
* @history      04.11.2011. ; srdjanp ; Initial revision
*
*/
defined('_EDOTPLUS_ALLOW') or die('Access is forbidden!');

class c_Db {
  public $_conn;
  
  public function __construct($getConnection = true) {
    if ($getConnection)
      $this->_conn = $this->getConnection();
    else
      $this->_conn = $this->justConnect();
  }
  
  public function __destruct() {
    mysql_close($this->_conn);
  }
  
  private function justConnect()
  {
    $conn = mysql_connect($GLOBALS["connect"], $GLOBALS["username"], $GLOBALS["password"]) or die(mysql_error());
    mysql_select_db($GLOBALS["database"]);
  	return $conn;
  }
  
  public function _checkDBExist($db = '')
  {
    $return = false;
    $sql    = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s'";
    $query  = mysql_query(sprintf($sql, $db)) or die(mysql_error());
    $result = mysql_fetch_array($query);
    
    if (isset($result['SCHEMA_NAME']) && $result['SCHEMA_NAME'] == $db)
      $return = true;
    return $return;
  }
  
  public function _openYear($year = '', $drop = false) {
    $return = true;
    
    $return = $this->createTableMember($year, $drop);
    if ($return)
      $return = $this->createTableContract($year, $drop);
    else
      return false;
    if ($return)
      $return = $this->createTableContractItem($year, $drop);
    else
      return false;
      
    if ($return)
      $return = $this->createTableContractRuleItem($year, $drop);
    else
      return false;
    if ($return)
      $return = $this->createTableDocument($year, $drop);
    else
      return false;

    if ($return)
      $return = $this->createTableInvoice($year, $drop);
    else
      return false;

    if ($return)
      $return = $this->createTableInvoiceItem($year, $drop);
    else
      return false;

    if ($return)
      $return = $this->createTableInvoiceContractItem($year, $drop);
    
    //if ($return)
    //  $return = $this->_recreateOther($drop);
    
    return $return;
  }

  public function _createTableMenu() {
    return $this->createTableMenu();
  }

  public function _insertDefaultMenu() {
    return $this->insertDefaultMenu();
  }
  
  public function _insertDefaultMemberBasis() {
    return $this->insertDefaultMemberBasis();
  }

  public function _createTableCooperative($drop = false) {
    return $this->createTableCooperative($drop);
  }
  
  public function _insertDefaultEmployer() {
    return $this->insertDefaultEmployer();
  }

  public function _createTableMember() {
    return $this->createTableMember();
  }
  
  public function _createTableDocument() {
    return $this->createTableDocument();
  }

  public function _createTableContractItem() {
    return $this->createTableContractItem();
  }

  public function _createTableContract() {
    return $this->createTableContract();
  }
  
  private function getConnection($db = null) {
    
  	// $conn = mysql_pconnect($GLOBALS["connect"], $GLOBALS["username"], $GLOBALS["password"]) or die(mysql_error());
    $conn = mysql_connect($GLOBALS["connect"], $GLOBALS["username"], $GLOBALS["password"]) or die(mysql_error());
  	mysql_select_db($GLOBALS["database"],$conn) 
  	  or die(mysql_error());
  	
  	return $conn;
  }
  
  private function createTableInvoice($year = '', $drop = false) {
    
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoice$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoice$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoice", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoice (";
    }
    $sql .= "`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `IDContract` int(11) NOT NULL DEFAULT '0',
        `date` date NOT NULL,
        `net` DOUBLE NOT NULL DEFAULT '0.0',
        `tax` DOUBLE NOT NULL DEFAULT '0.0',
        `contribute` DOUBLE NOT NULL DEFAULT '0.0',
        `claimsum` DOUBLE NOT NULL DEFAULT '0.0',
        `cooperative` DOUBLE NOT NULL DEFAULT '0.0',
        `sum` DOUBLE NOT NULL DEFAULT '0.0',
        `rule` TINYINT NOT NULL DEFAULT '0',
        KEY (IDContract)
        ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    return true;
  }

  private function createTableInvoiceItem($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoiceItem$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoiceItem$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoiceItem", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoiceItem (";
    }
    $sql .= "`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `IDInvoice` INT NOT NULL DEFAULT '0',
        `IDInvoiceRuleDef` INT NOT NULL DEFAULT '0',
        `net` TINYINT NOT NULL DEFAULT '0',
        `value` DOUBLE NOT NULL DEFAULT '0.0',
        KEY (IDInvoice),
        KEY (IDInvoiceRuleDef)
        ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    return true;
  }
  
  private function createTableInvoiceContractItem($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoiceContractItem$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoiceContractItem$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZInvoiceContractItem", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZInvoiceContractItem (";
    }
    $sql .= "`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `IDInvoice` INT NOT NULL DEFAULT '0',
        `IDContract` INT NOT NULL DEFAULT '0',
        `IDMember` INT NOT NULL DEFAULT '0',
        `net` DOUBLE NOT NULL DEFAULT '0.0',
        `value` DOUBLE NOT NULL DEFAULT '0.0',
        `pio` DOUBLE NOT NULL DEFAULT '0.0',
        `health` DOUBLE NOT NULL DEFAULT '0.0',
        `insurance` DOUBLE NOT NULL DEFAULT '0.0',
        `bruto` DOUBLE NOT NULL DEFAULT '0.0',
        KEY (IDInvoice),
        KEY (IDContract),
        KEY (IDMember)
        ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    return true;
  }

  private function createTableContract($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContract$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContract$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContract", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContract (";
    }
    $sql .= " ID INT NOT NULL AUTO_INCREMENT,
      IDEmployer INT NOT NULL,
      contractnumber INT,
      contractdate DATE DEFAULT NULL,
      contractfrom DATE DEFAULT NULL,
      contractto DATE DEFAULT NULL,
      hours VARCHAR(5) DEFAULT NULL,
      jobdescription TEXT DEFAULT NULL,
      net DOUBLE NOT NULL DEFAULT '0.0',
      tax DOUBLE NOT NULL DEFAULT '0.0',
      contribute DOUBLE NOT NULL DEFAULT '0.0',
      claimsum DOUBLE NOT NULL DEFAULT '0.0',
      sum DOUBLE NOT NULL DEFAULT '0.0',
      rule TINYINT NOT NULL DEFAULT '0',
      PRIMARY KEY (ID),
      KEY (IDEmployer)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }
  
  private function createTableContractItem($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContractItem$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContractItem$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContractItem", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContractItem (";
    }
    $sql .= " ID INT NOT NULL AUTO_INCREMENT,
      IDContract INT NOT NULL,
      IDMember INT NOT NULL,
      net DOUBLE,
      contractfrom DATE DEFAULT NULL,
      contractto DATE DEFAULT NULL,
      hours VARCHAR(5) DEFAULT NULL,
      value DOUBLE NOT NULL DEFAULT '0.0',
      pio DOUBLE NOT NULL DEFAULT '0.0',
      health DOUBLE NOT NULL DEFAULT '0.0',
      insurance DOUBLE NOT NULL DEFAULT '0.0',
      bruto DOUBLE NOT NULL DEFAULT '0.0',
      PRIMARY KEY (ID),
      KEY (IDContract,IDMember)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }
  
  private function createTableContractRuleItem($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContractRuleItem$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContractRuleItem$year (";
    } else {
      if ($drop) 
         mysql_query("DROP TABLE IF EXISTS OSZContractRuleItem", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZContractRuleItem (";
    }
    $sql .= "`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `IDContract` INT NOT NULL DEFAULT '0',
        `IDInvoiceRuleDef` INT NOT NULL DEFAULT '0',
        `net` TINYINT NOT NULL DEFAULT '0',
        `value` DOUBLE NOT NULL DEFAULT '0.0',
        KEY (IDContract),
        KEY (IDInvoiceRuleDef)
        ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    return true;
  }
  
 
  private function createTableMenu() {
    /* create table menu */
    $sql = "CREATE TABLE IF NOT EXISTS OSZMenu (
      ID SMALLINT NOT NULL AUTO_INCREMENT,
      title VARCHAR(70) NOT NULL,
      link VARCHAR(255) NOT NULL,
      root SMALLINT NOT NULL DEFAULT 0,
      sort TINYINT,
      PRIMARY KEY (ID),
      KEY (title),
      KEY (root),
      KEY (link)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }

  private function insertDefaultMenu() {
    mysql_query("DROP TABLE IF EXISTS OSZMenu", $this->_conn) or die(mysql_error());
    $this->createTableMenu();
    
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Osnovni podaci', 'osnovnipodaci.php', 0, 1)") or die(mysql_error());           // 1
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Obračun', 'obracun.php', 0, 2)") or die(mysql_error());                        // 2
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Izveštaji', 'izvestaj.php', 0, 3)") or die(mysql_error());                     // 3
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Podešavanja', 'podesavanja.php', 0, 4)") or die(mysql_error());                // 4
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Pomoć', 'pomoc.php', 0, 5)") or die(mysql_error());                            // 5

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Knjiga zadrugara', 'zadrugar.php', 1, 1)") or die(mysql_error());              // 6
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Knjiga zadrugara - Unos', 'zadrugarunos.php', 6, 1)") or die(mysql_error());   // 7
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Kartica zadrugara', 'zadrugarkartica.php', 6, 2)") or die(mysql_error());      // 8

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Podaci zadruge', 'oszpodaci.php', 1, 2)") or die(mysql_error());               // 9

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Poslodavac', 'poslodavac.php', 1, 3)") or die(mysql_error());                  // 10
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Poslodavac - Unos', 'poslodavacunos.php', 10, 1)") or die(mysql_error());      // 11
    
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Unos ugovora', 'ugovorunos.php', 2, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Obračun faktura', 'faktura.php', 2, 2)") or die(mysql_error());

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Knjiga ugovora', 'knjigaugovor.php', 3, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Knjiga faktura', 'knjigafaktura.php', 3, 2)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Kartica zadrugara', 'karticazadrugar.php', 3, 3)") or die(mysql_error());

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Parametri obračuna', 'parametarobracun.php', 4, 1)") or die(mysql_error());

    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Evidencija zadrugara', 'pomoczadrugar.php', 5, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Evidencija ugovora', 'pomocugovor.php', 5, 2)") or die(mysql_error());
    
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Unos ugovora - neto zarade', 'zaradaunos.php', 12, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Knjiga ugovora - pregled', 'pregledugovor.php', 14, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Mesta', 'mesto.php', 1, 4)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Osnov članstva', 'osnov.php', 1, 5)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Mesta - unos', 'mestounos.php', 23, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Osnov članstva - Unos', 'osnovunos.php', 23, 2)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Otvori godinu', 'otvorigodinu.php', 4, 3)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Tekuća godina', 'tekucagodina.php', 4, 4)") or die(mysql_error());
//28
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Definicija obračuna - Unos', 'parametarunos.php', 17, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Parametri štampe', 'parametarstampa.php', 4, 2)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Parametri štampe - Unos', 'parametarstampaunos.php', 29, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Blanko ugovor', 'blankougovor.php', 3, 4)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Obračun fakture', 'fakturaracun.php', 13, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Faktura', 'fakturaobracun.php', 13, 2)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Pregled fakture', 'pregledfaktura.php', 15, 1)") or die(mysql_error());
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Pregled obračuna', 'pregledobracun.php', 15, 2)") or die(mysql_error());
//37    
    mysql_query("INSERT INTO OSZMenu (title, link, root,sort) VALUES ('Parametri evidencije', 'evidencija.php', 4, 5)") or die(mysql_error());
    return true;
  }
  
  private function createTableMemberBasis() {
    /* create table osnov članstva */
    $sql = "CREATE TABLE IF NOT EXISTS OSZMemberBasis (
      ID TINYINT NOT NULL AUTO_INCREMENT,
      name VARCHAR(70) NOT NULL,
      PRIMARY KEY (ID),
      KEY (name)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }

  private function insertDefaultMemberBasis() {
    mysql_query("DROP TABLE IF EXISTS OSZMemberBasis", $this->_conn) or die(mysql_error());
    $this->createTableMemberBasis();
    
    mysql_query("INSERT INTO OSZMemberBasis (name) VALUES ('Student')") or die(mysql_error());
    mysql_query("INSERT INTO OSZMemberBasis (name) VALUES ('Učenik')") or die(mysql_error());
    mysql_query("INSERT INTO OSZMemberBasis (name) VALUES ('Nezaposlen')") or die(mysql_error());
    mysql_query("INSERT INTO OSZMemberBasis (name) VALUES ('Posebni uslovi')") or die(mysql_error());
    
    return true;
  }
  
  private function createTableDocument($year = '', $drop = false) {
    
    if ($year != '' && (int)$year > 2000) {
      if ($drop)
        mysql_query("DROP TABLE IF EXISTS OSZDocument$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZDocument$year (";
    } else {
      if ($drop)
        mysql_query("DROP TABLE IF EXISTS OSZDocument", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZDocument (";
    }
    $sql .= "IDMember INT NOT NULL,
      document VARCHAR(20) NOT NULL,
      publisher VARCHAR(70) NOT NULL,
      KEY (IDMember)
    ) ENGINE=MyISAM ";

    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }

  private function createTableMember($year = '', $drop = false) {
    if ($year != '' && (int)$year > 2000) {
      if ($drop)
        mysql_query("DROP TABLE IF EXISTS OSZMember$year", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZMember$year (";
    } else {
      if ($drop)
        mysql_query("DROP TABLE IF EXISTS OSZMember", $this->_conn) or die(mysql_error());
      $sql = "CREATE TABLE IF NOT EXISTS OSZMember (";
    }
    /* create table poslodavac */
    $sql .= "ID INT NOT NULL AUTO_INCREMENT,
      name VARCHAR(70) NOT NULL,
      surname VARCHAR(70) NOT NULL,
      parent VARCHAR(70),
      jmbr VARCHAR(13),
      idnumber VARCHAR(15),
      mup VARCHAR(70),
      birthday DATE,
      birthplace VARCHAR(70),
      address VARCHAR(255),
      IDAddressPlace SMALLINT,
      occupation VARCHAR(255),
      specialkno VARCHAR(255),
      healthinsur TINYINT(1),
      memberother TINYINT(1),
      IDMemberBasis TINYINT,
      phone VARCHAR(20),
      mobile VARCHAR(20),
      email VARCHAR(255),
      IDEmployer SMALLINT,
      memberdate DATE,
      PRIMARY KEY (ID),
      KEY (name),
      KEY (surname),
      KEY (name, surname),
      KEY (birthplace),
      KEY (IDAddressPlace),
      KEY (IDEmployer)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }

  private function createTableCooperative($drop = false) {
    if ($drop)
      mysql_query("DROP TABLE IF EXISTS OSZCooperative", $this->_conn) or die(mysql_error());
    /* create table poslodavac */
    $sql = "CREATE TABLE IF NOT EXISTS OSZCooperative (
      ID SMALLINT NOT NULL AUTO_INCREMENT,
      name VARCHAR(255) NOT NULL,
      short VARCHAR(50) DEFAULT NULL,
      shortest VARCHAR(20) DEFAULT NULL,
      address VARCHAR(255) DEFAULT NULL,
      IDPlace SMALLINT DEFAULT 0,
      phone VARCHAR(20) DEFAULT NULL,
      mobile VARCHAR(20) DEFAULT NULL,
      fax VARCHAR(20) DEFAULT NULL,
      email VARCHAR(255) DEFAULT NULL,
      url VARCHAR(255) DEFAULT NULL,
      account VARCHAR(255) DEFAULT NULL,
      reference VARCHAR(255) DEFAULT NULL,
      pib VARCHAR(20) DEFAULT NULL,
      idnumber VARCHAR(20) DEFAULT NULL,
      activity VARCHAR(20) DEFAULT NULL,
      currentyear VARCHAR(4) DEFAULT NULL,
      contracthours TINYINT DEFAULT 0,
      memberhours TINYINT DEFAULT 0,
      PRIMARY KEY (ID),
      KEY (name),
      KEY (IDPlace)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }
  
  
  private function createTableEmployer() {
    /* create table poslodavac */
    $sql = "CREATE TABLE IF NOT EXISTS OSZEmployer (
      ID SMALLINT NOT NULL AUTO_INCREMENT,
      name VARCHAR(255) NOT NULL,
      address VARCHAR(255),
      IDPlace SMALLINT,
      phone VARCHAR(20),
      mobile VARCHAR(20),
      fax VARCHAR(20),
      email VARCHAR(255),
      url VARCHAR(255),
      account VARCHAR(255),
      pib VARCHAR(20),
      idnumber VARCHAR(20),
      PRIMARY KEY (ID),
      KEY (name),
      KEY (IDPlace)
    ) ENGINE=MyISAM
    ";
    mysql_query($sql, $this->_conn) or die(mysql_error());
    
    return true;
  }
  
  private function insertDefaultEmployer() {
    mysql_query("DROP TABLE IF EXISTS OSZEmployer", $this->_conn) or die(mysql_error());
    $this->createTableEmployer();
    
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('ALEX-TRAVEL')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('BOKI')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('BOLNICA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('DEUS')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('ELDON')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GOŠA FOM')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GALIJA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GOŠA INSTITUT')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GRACIJA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('HLADNJAČA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('INSTITUT ZA POVRTARSTVO')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('JAVNO KOMUNALNO PREDUZEĆE')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('JRDNP')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('KATASTAR')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('KC')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('KK')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('KLANICA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('KRAJSER')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('MLINPEK')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GOŠA MONTAŽA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('MZ')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('NIK')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('OPEKA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('POLJOPRIVREDA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('GOŠA ŠINSKA VOZILA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('SPIRALOGRAF')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('STR ŠUMADIJA')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('TIME')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('VETERINARSKA APOTEKA SVETI VRAČI')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('VOĆAR')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('ŽIVINARSTVO')") or die(mysql_error());
    mysql_query("INSERT INTO OSZEmployer (name) VALUES ('ZZ')") or die(mysql_error());
  }

  public function _insertDefaultPlace() {
      mysql_query('DROP TABLE IF EXISTS OSZPlace') or die(mysql_error());
      mysql_query('CREATE TABLE IF NOT EXISTS OSZPlace (
            ID SMALLINT NOT NULL AUTO_INCREMENT,
            name VARCHAR(70) NOT NULL,
            post VARCHAR(5),
            phone VARCHAR(5),
            PRIMARY KEY (ID),
            KEY (name)
          ) ENGINE=MyISAM;') or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Aleksandrovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Aleksinac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Arilje', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bajina Bašta', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Banja Koviljača', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Batajnica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Batočina', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bela Palanka', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Beograd', '11000', '011')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Blace', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bogatić', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Boljevac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bor', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bosilegrad', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Despotovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Dimitrovgrad', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Donji Milanovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Gornji Milanovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ivanjica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Jagodina', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kladovo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Knić', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Knjaževac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kragujevac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kraljevo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kruševac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kuršumlija', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kučevo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Lajkovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Lapovo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Lazarevac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Lebane', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Leposavić', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Leskovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ljig', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Loznica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Lučani', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Majdanpek', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Mali Zvornik', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Merošina', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Mionica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Mladenovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Negotin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Niš', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Nova Varoš', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Novi Pazar', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Obrenovac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Osečina', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Paraćin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Petrovac na Mlavi', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Pirot', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Požarevac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Požega', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Prijepolje', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Prokuplje', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Raška', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Sjenica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Smederevo', '26000', '026')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Smederevska Palanka', '11420', '026')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Sokobanja', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Surdulica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Svilajnac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Svrljig', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Topola', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Trstenik', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ub', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Užice', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Valjevo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Varvarin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Velika Plana', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Veliko Gradište', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vladimirci', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vladičin Han', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vlasotince', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vranje', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vrnjačka banja', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Zaječar', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Zemun', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Zubin potok', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Šabac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Žagubica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ćićevac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ćuprija', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Čajetina', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Čačak', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Apatin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bač', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bačka Palanka', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bačka Topola', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bela Crkva', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Bečej', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Inđija', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Jaša Tomić', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kanjiža', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kikinda', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kovačica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kovin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Kula', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Novi Kneževac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Novi Sad', '21000', '021')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Odžaci', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Palić', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Pančevo', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Pećinci', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Plandište', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Ruma', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Sombor', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Srbobran', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Sremska Mitrovica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Stara Pazova', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Subotica', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Temerin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Titel', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vrbas', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Vršac', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Zrenjanin', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Šid', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Žabalj', '', '')") or die(mysql_error());
      mysql_query("INSERT INTO OSZPlace (name, post, phone) VALUES ('Žitište', '', '')") or die(mysql_error());    
    return true;
  }
  
  public function _recreateOther($drop = false) {
    if ($drop) {
      mysql_query('DROP TABLE IF EXISTS OSZInvoiceRule') or die(mysql_error());
      mysql_query('DROP TABLE IF EXISTS OSZInvoiceRuleDef') or die(mysql_error());
      mysql_query('DROP TABLE IF EXISTS OSZInvoiceRulePrt') or die(mysql_error());
      mysql_query('DROP TABLE IF EXISTS OSZPrint') or die(mysql_error());
      mysql_query('DROP TABLE IF EXISTS OSZPrintItem') or die(mysql_error());
      mysql_query('DROP TABLE IF EXISTS OSZYear') or die(mysql_error());
    }
    
    mysql_query("CREATE TABLE IF NOT EXISTS `OSZInvoiceRule` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `age` tinyint(4) NOT NULL,
      `agerule` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
      PRIMARY KEY (`ID`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3") or die(mysql_error());
    
    if ($drop) {  
      mysql_query("INSERT INTO `OSZInvoiceRule` (`ID`, `name`, `age`, `agerule`) VALUES (1, 'Definicija obračuna do 26 godina', 26, '<=')") or die(mysql_error());
      mysql_query("INSERT INTO `OSZInvoiceRule` (`ID`, `name`, `age`, `agerule`) VALUES (2, 'Definicija obračuna za starije od 26 godina', 26, '>')") or die(mysql_error());
    }

    mysql_query("CREATE TABLE IF NOT EXISTS `OSZInvoiceRuleDef` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `IDInvoiceRule` int(11) NOT NULL,
      `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `sort` tinyint(4) NOT NULL DEFAULT '0',
      `invoice` tinyint(4) NOT NULL DEFAULT '0',
      `report` tinyint(4) NOT NULL DEFAULT '0',
      `operator` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
      `input` int(11) NOT NULL DEFAULT '0',
      `inputVal` double NOT NULL DEFAULT '0',
      `inputY` int(11) NOT NULL DEFAULT '0',
      `operatorY` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
      `inputZ` int(11) NOT NULL DEFAULT '0',
      `contributesum` tinyint(4) NOT NULL DEFAULT '0',
      `inputnet` tinyint(4) NOT NULL DEFAULT '0',
      `control` tinyint(4) NOT NULL DEFAULT '0',
      PRIMARY KEY (`ID`),
      KEY `IDInvoiceRule` (`IDInvoiceRule`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28") or die(mysql_error());

    if ($drop) {
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (1, 1, 'Prihod (ugovorena naknada)', 1, 0, 0, '*', 0, 1.106195, 0, '', 0, 0, 1, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (2, 1, 'Normirani troškovi', 2, 0, 1, '%', 1, 20, 0, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (3, 1, 'Oporezivi prihod', 3, 0, 1, '-', 1, 0, 2, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (4, 1, 'Porez na dohodak građana', 4, 0, 1, '%', 3, 20, 0, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (5, 1, 'Umanjenje poreza', 5, 0, 1, '%', 4, 40, 0, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (6, 1, 'Porez za uplatu', 6, 1, 1, '-', 4, 0, 5, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (7, 1, 'Doprinosi za PIO na teret isplatioca prihoda', 7, 1, 1, '%', 1, 4, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (8, 1, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 8, 1, 1, '%', 1, 2, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (9, 1, 'Svega za refundaciju/Iznos za isplatu', 9, 1, 1, '+', 6, 0, 7, '+', 8, 0, 1, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (10, 1, 'Članski doprinos', 10, 1, 0, '%', 0, 10, 0, '', 0, 0, 1, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (11, 1, 'Ukupno za uplatu', 11, 1, 0, '+', 9, 0, 10, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (12, 1, 'Kontrola Neto na Bruto', 12, 0, 0, '*', 0, 1.272566, 0, '', 0, 0, 1, 1)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (13, 2, 'Osnovica za obračun poreza', 1, 0, 0, '*', 0, 1.426534, 0, '', 0, 0, 1, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (14, 2, 'Za PIO na teret zaposlenog', 2, 0, 1, '%', 13, 11, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (15, 2, 'Za zdravstveno osiguranje na teret zaposlenog', 3, 0, 1, '%', 13, 6.15, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (16, 2, 'Za osiguranje od slučaja nezaposlenosti', 4, 0, 1, '%', 13, 0.75, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (17, 2, 'Na teret zaposlenog', 5, 0, 1, '+', 14, 0, 15, '+', 16, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (18, 2, 'Za PIO na teret poslodavca', 6, 0, 1, '%', 13, 11, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (19, 2, 'Za zdravstveno osiguranje na teret poslodavca', 7, 0, 1, '%', 13, 6.15, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (20, 2, 'Za osiguranje od nezaposlenosti na teret poslodavca', 8, 0, 1, '%', 13, 0.75, 0, '', 0, 1, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (21, 2, 'Na teret poslodavca', 9, 0, 1, '+', 18, 0, 19, '+', 20, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (22, 2, 'Ukupno plaćen porez', 10, 1, 1, '%', 13, 12, 0, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (23, 2, 'Doprinosi za socijalno osiguranje', 11, 1, 0, '+', 17, 0, 21, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (24, 2, 'Članski doprinos', 12, 1, 0, '%', 0, 10, 0, '', 0, 0, 1, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (25, 2, 'Ukupno za uplatu', 14, 1, 0, '+', 27, 0, 24, '', 0, 0, 0, 0)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (26, 2, 'Kontrola Neto na Bruto', 15, 0, 0, '*', 0, 1.781882, 0, '', 0, 0, 1, 1)") or die(mysql_error());    
      mysql_query("INSERT INTO `OSZInvoiceRuleDef` (`ID`, `IDInvoiceRule`, `name`, `sort`, `invoice`, `report`, `operator`, `input`, `inputVal`, `inputY`, `operatorY`, `inputZ`, `contributesum`, `inputnet`, `control`) VALUES (27, 2, 'Svega za refundaciju', 13, 1, 0, '+', 22, 0, 23, '', 0, 0, 1, 0)") or die(mysql_error());    
    }

    mysql_query("CREATE TABLE IF NOT EXISTS `OSZInvoiceRulePrt` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `IDInvoiceRule` int(11) NOT NULL DEFAULT '0',
      `invoice` tinyint(4) NOT NULL DEFAULT '0',
      `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `net` tinyint(4) NOT NULL DEFAULT '0',
      `sort` tinyint(4) NOT NULL DEFAULT '0',
      `inputA` int(11) NOT NULL DEFAULT '0',
      `inputAOper` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
      `inputB` int(11) NOT NULL DEFAULT '0',
      `inputBOper` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
      `inputC` int(11) NOT NULL DEFAULT '0',
      `inputASrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
      `inputBSrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
      `inputCSrc` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
      PRIMARY KEY (`ID`),
      KEY `IDInvoiceRule` (`IDInvoiceRule`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16") or die(mysql_error());

    if ($drop) {
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (1, 1, 1, 'Neto zarada zadrugara', 1, 1, 1, '', 0, '', 0, 'ugo', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (2, 1, 1, 'Porez na zaradu', 0, 2, 6, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (3, 1, 1, 'Doprinosi za socijalno osiguranje', 0, 3, 7, '+', 8, '', 0, 'def', 'def', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (4, 1, 1, 'Svega za refundaciju', 0, 4, 1, '+', 2, '+', 3, 'prt', 'prt', 'prt')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (5, 1, 1, 'Članski doprinos', 0, 5, 10, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (6, 1, 1, 'Ukupno za uplatu', 0, 6, 4, '+', 5, '', 0, 'prt', 'prt', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (7, 1, 0, 'Prihod (ugovorena naknada)', 0, 1, 1, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (8, 1, 0, 'Normirani troškovi (1. x 20%)', 0, 2, 2, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (9, 1, 0, 'Oporezivi prihod (1. - 2)', 0, 3, 3, '-', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (10, 1, 0, 'Porez na dohodak građana', 0, 4, 4, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (11, 1, 0, 'Umanjenje poreza (4. x 40%)', 0, 5, 5, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (12, 1, 0, 'Porez za uplatu (4. - 5)', 0, 6, 6, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (13, 1, 0, 'Iznos za isplatu (1. - 6. - 7)', 0, 7, 9, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (14, 1, 0, 'Doprinos za PIO na teret isplatioca prihoda', 0, 8, 7, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
        mysql_query("INSERT INTO `OSZInvoiceRulePrt` (`ID`, `IDInvoiceRule`, `invoice`, `name`, `net`, `sort`, `inputA`, `inputAOper`, `inputB`, `inputBOper`, `inputC`, `inputASrc`, `inputBSrc`, `inputCSrc`) VALUES (15, 1, 0, 'Doprinos za zdravstveno osiguranje na teret isplatioca prihoda', 0, 9, 8, '', 0, '', 0, 'def', '', '')") or die(mysql_error());
    }
    
    mysql_query("CREATE TABLE IF NOT EXISTS `OSZPrint` (
      `IDPrint` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `contract` tinyint(4) NOT NULL DEFAULT '0',
      PRIMARY KEY (`IDPrint`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2") or die(mysql_error());
    
    if ($drop)
      mysql_query("INSERT INTO `OSZPrint` (`IDPrint`, `name`, `contract`) VALUES (1, 'Ugovor', 1)") or die(mysql_error());


    mysql_query("CREATE TABLE IF NOT EXISTS `OSZPrintItem` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `IDPrint` int(11) NOT NULL DEFAULT '0',
      `sort` tinyint(4) NOT NULL DEFAULT '0',
      `text` text COLLATE utf8_unicode_ci NOT NULL,
      `align` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
      `font` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Arial',
      `fontsize` tinyint(4) NOT NULL DEFAULT '0',
      `style` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
      `ln` tinyint(4) NOT NULL DEFAULT '0',
      PRIMARY KEY (`ID`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19") or die(mysql_error());

    if ($drop) {
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (1, 1, 1, 'U G O V O R', 'C', 'arial', 14, 'B', 5)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (2, 1, 2, 'I OBAVEZE ČLANOVA ZADRUGE', 'C', 'arial', 11, '', 2)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (3, 1, 3, '1.Da poverene poslove svesno, marljivo i kvalitetno obavlja u ugovorenom roku;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (4, 1, 4, '2.Da se pridržavaju važećeg radnog reda i drugih pravila ponašanja i pravila radne discipline kod naručioca;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (5, 1, 5, '3.Da se staraju o pravilnoj upotrebi sredstava za rad i alata kojima se služe u toku rada;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (6, 1, 6, '4.Da lično obavljaju poverene poslove i da pre polaska na posao potpišu ovaj ugovor;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (7, 1, 7, '5.Da nakon obavljenog posla ovaj ugovor overe kod naručioca i dostave u zadrugu najkasnije u roku od dva dana.', 'L', 'arial', 9, '', 5)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (8, 1, 9, 'II OBAVEZE NARUČIOCA POSLA', 'C', 'arial', 11, '', 2)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (9, 1, 9, '1.Da na rad primi samo one članove zadruge koje je na posao uputila zadruga;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (10, 1, 10, '2.Da članovima zadruge poverava samo poslove koji su predvidjeni Zakonom o zadrugama i Zakonom o zadrugama;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (11, 1, 11, '3.Da članovima zadruge obezbedi zaštitu na radu u skladu sa Zakonom o zaštiti na radu;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (12, 1, 12, '4.Da Zadrugu i inspekciju rada obavesti o bilo kakvoj nesreći na poslu koju doživi član Zadruge u skladu sa zakonom;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (13, 1, 13, '5.Da Zadruzi nadoknadi štetu koju pretrpi njen član u toku rada, po opštim načelima odgovornosti za štetu;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (14, 1, 14, '6.Da članovima zadruge nakon završetka posla overi ovaj ugovor i razduži ih sa preuzetim alatom i sredstvima za rad;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (15, 1, 15, '7.Da zadruzi isplati iznos uvećan za ______ nakon ispostavljanja fakture u zakonskom roku.', 'L', 'arial', 9, '', 5)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (16, 1, 16, 'III OBAVEZE ZADRUGE', 'C', 'arial', 11, '', 2)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (17, 1, 17, '1.Da u slučaju eventualnog napuštanja posla, od strane upućenih članova, na rad pošalje nove svoje članove radi blagovremenog završetka posla;', 'L', 'arial', 9, '', 1)") or die(mysql_error());
      mysql_query("INSERT INTO `OSZPrintItem` (`ID`, `IDPrint`, `sort`, `text`, `align`, `font`, `fontsize`, `style`, `ln`) VALUES (18, 1, 18, '2.Da članu zadruge isplati neto iznos, zarađen po ovom ugovoru najkasnije u roku od 15 dana od dana kad po ovom ugovoru bude uplaćeno Zadruzi.', 'L', 'arial', 9, '', 1)") or die(mysql_error());
    }

    mysql_query("CREATE TABLE IF NOT EXISTS `OSZYear` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
      PRIMARY KEY (`ID`)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3") or die(mysql_error());
    
    if ($drop) {
      mysql_query("INSERT INTO `OSZYear` (`ID`, `year`) VALUES (1, '2010')") or die(mysql_error());
      mysql_query("INSERT INTO `OSZYear` (`ID`, `year`) VALUES (2, '2011')") or die(mysql_error());
    }
    
    return true;
  }
}
?>