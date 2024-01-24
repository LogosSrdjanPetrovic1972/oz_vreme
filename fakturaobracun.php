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
* @file         fakturaobracun.php
* @package       
* @subpackage   
*
* @description  Obračun faktura
*
* @history      12.11.2011. ; srdjanp ; Initial revision
*
*/
include_once('./header.php');
?>
              <!-- MAIN CONTENT START -->
              <h2><?=$GLOBALS["sectiontitle"];?></h2>
<?
$internal = false;

if (isset($_POST["internal"])) $internal = true; 

if (isset($_POST["rule"])) {
  $rule = 0;
  $correct = true;
  for ($i=0; $i<count($_POST['rule']); $i++) {
    if ($i == 0) $rule = (int) $_POST['rule'][$i];
    if ($rule != (int) $_POST['rule'][$i]) {
      $correct = false;
      break;
    }
  }
  if ($correct) {
    $IDContract = (int) $_POST['IDContract'];
    $query = mysql_query(sprintf("SELECT SUM(net) AS net_sum FROM oszcontractitem$_currentyear WHERE IDContract = %d", $IDContract)) or die(mysql_error());
    $res = mysql_fetch_array($query);
    $net_sum = $res['net_sum'];
    $query = mysql_query(sprintf("SELECT * FROM oszinvoiceruledef WHERE IDInvoiceRule = %d ORDER BY sort", $rule)) or die(mysql_error());
    // dump(sprintf("SELECT * FROM oszinvoiceruledef WHERE IDInvoiceRule = %d ORDER BY sort", $rule));
    $rules = array();
    //$rules[0] = array();
    // name, sort, invoice, report, operator, input, inputVal, inputY, operatorY, inputZ, contributesum, inputnet, control
    $rules[0] = array(
      'name'      =>  'Neto zarada zadrugara',
      'sort'      =>  0,
      'invoice'   =>  1,
      'report'    =>  1,
      'operator'  =>  '',
      'input'     =>  0,
      'inputVal'  =>  $net_sum,
      'inputY'    =>  0,
      'operatorY' =>  '',
      'inputZ'    =>  0,
      'contribute' => 0,
      'inputnet'  =>  1,
      'control'   =>  0
    );
    $contribute = 0;
    while ($res = mysql_fetch_array($query)) {
      $rules[$res['ID']] = array(
        'name'      =>  $res["name"],
        'sort'      =>  $res["sort"],
        'invoice'   =>  $res["invoice"],
        'report'    =>  $res["report"],
        'operator'  =>  $res["operator"],
        'input'     =>  $res["input"],
        'inputVal'  =>  $res["inputVal"],
        'inputY'    =>  $res["inputY"],
        'operatorY' =>  $res["operatorY"],
        'inputZ'    =>  $res["inputZ"],
        'contribute'    =>  $res["contributesum"],
        'inputnet'  =>  $res["inputnet"],
        'control'   =>  $res["control"]
      );
      if ($res["inputnet"] == 1) {                              // use neto as input parameter
        if ($res["inputY"] == 0) {                              // only one operation
          switch ($res["operator"]) {
            case "%":                                           // calculate percent
              $rules[$res['ID']]['result'] = $rules[$res['ID']]['inputVal'] * $rules[0]['inputVal'] / 100 ;
              break;
            case "*":
              $rules[$res['ID']]['result'] = $rules[0]['inputVal'] * $rules[$res['ID']]['inputVal'];
              break;
            case "+":
              $rules[$res['ID']]['result'] = $rules[0]['inputVal'] + $rules[$res['ID']]['inputVal'];
              break;
            case "-":
              $rules[$res['ID']]['result'] = $rules[0]['inputVal'] - $rules[$res['ID']]['inputVal'];
              break;
            case "/":
              $rules[$res['ID']]['result'] = $rules[0]['inputVal'] / $rules[$res['ID']]['inputVal'];
              break;
            default:
              $rules[$res['ID']]['result'] = 0.0;
              break;
          }
        } else {                                                // more then one operation
          // currently we have only two supported calculation
          if ($res["input"] > 0 && $res["inputY"] > 0 && $res["inputZ"] > 0) {        // one operant
            $rules[$res['ID']]['result'] = $rules[0]['inputVal'] + $rules[$res["input"]]['result'] + $rules[$res["inputY"]]['result'] + $rules[$res["inputZ"]]['result'];
          }
          if ($res["input"] > 0 && $res["inputY"] > 0 && $res["inputZ"] == 0) {        // one operant
            $rules[$res['ID']]['result'] = $rules[0]['inputVal'] + $rules[$res["input"]]['result'] + $rules[$res["inputY"]]['result'];
          }
        }
      } else {                                                  // do not use neto as input parameter
        if ($res["input"] > 0 && $res["inputY"] == 0 && $res["inputZ"] == 0) {        // one operant
          switch ($res["operator"]) {
            case "%":                                           // calculate percent
              $rules[$res['ID']]['result'] = $rules[$res['ID']]['inputVal'] * $rules[$res["input"]]['result'] / 100;
              break;
            case "*":
              $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] * $rules[$res['ID']]['inputVal'];
              break;
            case "+":
              $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] + $rules[$res['ID']]['inputVal'];
              break;
            case "-":
              $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] - $rules[$res['ID']]['inputVal'];
              break;
            case "/":
              $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] / $rules[$res['ID']]['inputVal'];
              break;
            default:
              $rules[$res['ID']]['result'] = 0.0;
              break;
          }
        } elseif ($res["input"] > 0 && $res["inputY"] > 0 && $res["inputZ"] == 0) {   // two operants
            switch ($res["operator"]) {
              case "%":                                                       // calculate percent
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] * $rules[$res["inputY"]]['result'] / 100;
                break;
              case "*":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] * $rules[$res["inputY"]]['result'];
                break;
              case "+":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] + $rules[$res["inputY"]]['result'];
                break;
              case "-":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] - $rules[$res["inputY"]]['result'];
                break;
              case "/":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] / $rules[$res["inputY"]]['result'];
                break;
              default:
                $rules[$res['ID']]['result'] = 0.0;
                break;
            }
          } elseif ($res["input"] > 0 && $res["inputY"] > 0 && $res["inputZ"] > 0) {  // three operants
            switch ($res["operatorY"]) {
              case "*":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] * $rules[$res["inputY"]]['result'];
                switch ($res["operatorY"]) {
                  case "*":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] * $rules[$res["inputZ"]]['result'];
                    break;
                  case "+":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] + $rules[$res["inputZ"]]['result'];
                    break;
                  case "-":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] - $rules[$res["inputZ"]]['result'];
                    break;
                  case "/":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] / $rules[$res["inputZ"]]['result'];
                    break;
                  default:
                    $rules[$res['ID']]['result'] = 0.0;
                    break;
                }
                break;
              case "+":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] + $rules[$res["inputY"]]['result'];
                switch ($res["operatorY"]) {
                  case "*":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] * $rules[$res["inputZ"]]['result'];
                    break;
                  case "+":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] + $rules[$res["inputZ"]]['result'];
                    break;
                  case "-":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] - $rules[$res["inputZ"]]['result'];
                    break;
                  case "/":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] / $rules[$res["inputZ"]]['result'];
                    break;
                  default:
                    $rules[$res['ID']]['result'] = 0.0;
                    break;
                }
                break;
              case "-":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] - $rules[$res["inputY"]]['result'];
                switch ($res["operatorY"]) {
                  case "*":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] * $rules[$res["inputZ"]]['result'];
                    break;
                  case "+":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] + $rules[$res["inputZ"]]['result'];
                    break;
                  case "-":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] - $rules[$res["inputZ"]]['result'];
                    break;
                  case "/":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] / $rules[$res["inputZ"]]['result'];
                    break;
                  default:
                    $rules[$res['ID']]['result'] = 0.0;
                    break;
                }
                break;
              case "/":
                $rules[$res['ID']]['result'] = $rules[$res["input"]]['result'] / $rules[$res["inputY"]]['result'];
                switch ($res["operatorY"]) {
                  case "*":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] * $rules[$res["inputZ"]]['result'];
                    break;
                  case "+":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] + $rules[$res["inputZ"]]['result'];
                    break;
                  case "-":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] - $rules[$res["inputZ"]]['result'];
                    break;
                  case "/":
                    $rules[$res['ID']]['result'] = $rules[$res['ID']]['result'] / $rules[$res["inputZ"]]['result'];
                    break;
                  default:
                    $rules[$res['ID']]['result'] = 0.0;
                    break;
                }
                break;
              default:
                $rules[$res['ID']]['result'] = 0.0;
                break;
            }
        }
      }
      if ($rules[$res['ID']]['contribute']) $contribute += $rules[$res['ID']]['result'];
    }
    //dump($contribute);
    //dump($rules);
    
    $query = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE IDContract = %d", $IDContract)) or die(mysql_error());
    $res = mysql_fetch_array($query);
    $IDInvoice = 0;
    if (isset($res["ID"])) $IDInvoice = $res["ID"]; 
    if ($IDInvoice > 0) {
      // clean previous billing
      $query = mysql_query(sprintf("DELETE FROM oszinvoicecontractitem$_currentyear WHERE IDInvoice = %d", $IDInvoice)) or die(mysql_error());
      $query = mysql_query(sprintf("DELETE FROM oszinvoiceitem$_currentyear WHERE IDInvoice = %d", $IDInvoice)) or die(mysql_error());
      $sql = "UPDATE oszinvoice$_currentyear SET date='%s', net=%f, tax=%f, contribute=%f, claimsum=%f, cooperative=%f, sum=%f, rule=%d WHERE ID=%d";
      mysql_query(sprintf($sql,
        _input_date_to_db_date($_POST["date"]),
        $net_sum,
        $rules[$GLOBALS["age"][$rule]["tax"]]['result'],
        $contribute,
        $rules[$GLOBALS["age"][$rule]["claimsum"]]['result'],
        $rules[$GLOBALS["age"][$rule]["cooperative"]]['result'],
        $rules[$GLOBALS["age"][$rule]["sum"]]['result'],
        $rule,
        $IDInvoice
      )) or die(mysql_error());
    } else {
      $query    = mysql_query("SELECT MAX(ID) AS last_id FROM oszinvoice$_currentyear") or die(mysql_error());
      $res      = mysql_fetch_array($query);
      $last_id  = $res["last_id"];
      $sql = "INSERT INTO oszinvoice$_currentyear (ID,IDContract,date,net,tax,contribute,claimsum,cooperative,sum,rule) VALUES (%d,%d,'%s',%f,%f,%f,%f,%f,%f,%d)";
      mysql_query(sprintf($sql,
        $last_id + 1,
        $IDContract,
        _input_date_to_db_date($_POST["date"]),
        $net_sum,
        $rules[$GLOBALS["age"][$rule]["tax"]]['result'],
        $contribute,
        $rules[$GLOBALS["age"][$rule]["claimsum"]]['result'],
        $rules[$GLOBALS["age"][$rule]["cooperative"]]['result'],
        $rules[$GLOBALS["age"][$rule]["sum"]]['result'],
        $rule
      )) or die(mysql_error());
      $IDInvoice = $last_id + 1;
    }
    $sql = "INSERT INTO oszinvoiceitem$_currentyear (IDInvoice, IDInvoiceruledef, net, value) VALUES (%d, %d, %d, %f)";
    foreach($rules as $key => $value) {
      mysql_query(sprintf($sql,
        $IDInvoice,
        $key,
        ($key == 0) ? 1 : 0,
        ($key == 0) ? $rules[$key]['inputVal'] : $rules[$key]['result']
      )) or die(mysql_error());
    }
    $query = mysql_query(sprintf("SELECT * FROM oszcontractitem$_currentyear WHERE IDContract = %d", $IDContract)) or die(mysql_error());
    $sql = "INSERT INTO oszinvoicecontractitem$_currentyear (IDInvoice,IDContract,IDMember,net,value,pio,health,insurance,bruto) VALUES (%d,%d,%d,%f,%f,%f,%f,%f,%f)";
    while ($res = mysql_fetch_array($query)) {
      mysql_query(sprintf($sql, 
        $IDInvoice, 
        $IDContract,
        $res["IDMember"],
        $res["net"],
        $res["net"] * $GLOBALS["age"][$rule]['transform'],
        $res["net"] * $GLOBALS["age"][$rule]['pio'],
        $res["net"] * $GLOBALS["age"][$rule]['health'],
        $res["net"] * $GLOBALS["age"][$rule]['insurance'],
        $res["net"] * $GLOBALS["age"][$rule]['bruto']
      )) or die(mysql_error());
    }
    echo '<h3>Obračun je uspešno izvršen</h3>';
    $query    = mysql_query(sprintf("SELECT C.ID, C.IDEmployer, C.contractdate, E.name, E.address, E.phone, E.mobile, E.fax, P.name as place FROM oszcontract$_currentyear AS C 
                LEFT JOIN oszemployer AS E ON C.IDEmployer = E.ID 
                LEFT JOIN oszplace AS P ON E.IDPlace = P.ID
                WHERE C.ID=%d", $IDContract)) or die(mysql_error());
    $contract = mysql_fetch_array($query);    
    $query    = mysql_query(sprintf("SELECT * FROM oszinvoice$_currentyear WHERE ID=%d", $IDInvoice)) or die(mysql_error());
    $invoice  = mysql_fetch_array($query);
    $query    = mysql_query(sprintf("SELECT ICI.ID, ICI.IDMember, ICI.net, ICI.bruto as value, M.surname, M.name 
                FROM oszinvoicecontractitem$_currentyear AS ICI 
                LEFT JOIN oszmember$_currentyear AS M
                ON ICI.IDMember = M.ID
                WHERE ICI.IDInvoice=%d ORDER BY M.surname, M.name", $IDInvoice)) or die(mysql_error());
?>
    <table cellpadding="0" cellspacing="0" border="0" class="table_edit" width="100%"> 
      <tr>
        <th width="40%">Faktura broj : </th>
        <td width="60%"><?=$IDInvoice;?> / <?=$_currentyear;?></td>
      </tr>
      <tr>
        <th>Datum fakture : </th>
        <td><?=_db_date_to_date($invoice["date"]);?></td>
      </tr>
      <tr>
        <th width="40%">Ugovor broj : </th>
        <td width="60%"><?=$IDContract;?> / <?=$_currentyear;?></td>
      </tr>
      <tr>
        <th>Datum ugovora : </th>
        <td><?=_db_date_to_date($contract["contractdate"]);?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <th>Poslodavac : </th>
        <td><?=$contract["name"];?></td>
      </tr>
      <tr>
        <th>Adresa : </th>
        <td><?=$contract["address"];?></td>
      </tr>
      <tr>
        <th>Sedište : </th>
        <td><?=$contract["place"];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <th>Neto zarada zadrugara : </th>
        <td><?=number_format($invoice["net"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Porez na zaradu : </th>
        <td><?=number_format($invoice["tax"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Doprinosi za socijalno osiguranje : </th>
        <td><?=number_format($invoice["contribute"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Svega za refundaciju : </th>
        <td><?=number_format($invoice["claimsum"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Članski doprinos : </th>
        <td><?=number_format($invoice["cooperative"], 2, '.', '');?></td>
      </tr>
      <tr>
        <th>Ukupno za uplatu : </th>
        <td><?=number_format($invoice["sum"], 2, '.', '');?></td>
      </tr>
      <tr>
        <td colspan="2">
          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
              <td style="border:0px none;" align="center"><a href="./pdffaktura.php?IDInvoice=<?=$IDInvoice;?>" target="_blank">Štampa fakture<br /><img src="./images/form/pdf.jpg" alt="Štampa fakture" title="Štampa fakture" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfugovor.php?IDContract=<?=$IDContract;?>" target="_blank">Štampa ugovora<br /><img src="./images/form/pdf.jpg" alt="Štampa ugovora" title="Štampa ugovora" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfugovorlist.php?IDContract=<?=$IDContract;?>" target="_blank">Spisak uz ugovor<br /><img src="./images/form/pdf.jpg" alt="Spisak uz ugovor" title="Spisak uz ugovor" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pdfisplatalist.php?IDContract=<?=$IDContract;?>" target="_blank">Spisak za isplatu<br /><img src="./images/form/pdf.jpg" alt="Spisak za isplatu" title="Spisak za isplatu" /></a></td>
              <td style="border:0px none;" align="center"><a href="./pregledobracun.php?IDInvoice=<?=$IDInvoice;?>" target="_blank">Pregled obračuna<br /><img src="./images/form/bill.jpg" alt="Pregled obračuna" title="Pregled obračuna" /></a></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <h3>Spisak zadrugara : </h3>
    <table cellpadding="0" cellspacing="0" border="0" class="table_browse" width="100%">
      <tr>
        <th>Prezime i ime</th>
        <th>Neto iznos</th>
        <th>Iznos obračuna</th>
      </tr>
<?
  $neto = 0;
  $suma = 0; 
  while ($res = mysql_fetch_array($query)) { 
    $neto += $res["net"];
    $suma += $res["value"];
?>
      <tr>
        <td><?=$res["surname"];?> <?=$res["name"];?></td>
        <td align="right"><?=number_format($res["net"], 2, '.', '');?></td>
        <td align="right"><?=number_format($res["value"], 2, '.', '');?></td>
      </tr>
<? } ?>      
      <tr>
        <th align="right">UKUPNO : </th>
        <td align="right"><?=number_format($neto, 2, '.', '');?></td>
        <td align="right"><?=number_format($suma, 2, '.', '');?></td>
      </tr>
    </table>
<?    
  } else echo '<h3>Obračun nije dozvoljen!<br />Na jednoj fakturi moraju biti svi iste definicije obračuna!</h3>';
} else echo '<h3>Podaci za obračun nisu dostupni!</h3>'; 
?>              
              <!-- MAIN CONTENT END -->
<?php
include_once('./footer.php');
?>
