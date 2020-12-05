<?php
define ("DB_USER", "sa");
define ("DB_PASSWORD", "Mykeyin@123");
define ("DB_DATABASE", "document");
define ("DB_HOST", "localhost");
define ("TITLE", "Document");
define ("URL", "/document/");
$conn=mssql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Could not connect to MsSQL server.');
mssql_select_db(DB_DATABASE);
?>
