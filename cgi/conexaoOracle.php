<?php
/*
$_host   = 'petz002-scan1.br1.ocm.s7134749.oraclecloudatcustomer.com';
$_owner  = "petz_espelho";
$_passwd = "Esp2015pEtz";
$_sid      = "PTIDCP.br1.ocm.s7134749.oraclecloudatcustomer.com";
*/
$_host   = '192.168.200.90';
$_owner  = "petz_espelho";
$_passwd = "Esp2015pEtz";
$_sid      = "DBZANHML";

$tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=".$_host.")(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=".$_sid.")))";

try{
    $conn = new PDO("oci:dbname=".$tns,$_owner,$_passwd);    
}catch(PDOException $e)
{
    echo ($e->getMessage());
}

/*
Conexão via OCI
$conn = ocilogon($_owner, $_passwd,$teste,"AL32UTF8",0);

if (!$conn) {
    $e = oci_error(); // coleta o erro e mostra na tela
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/


