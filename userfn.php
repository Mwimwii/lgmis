<?php
namespace PHPMaker2020\lgmis20;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$val = date("Y|m", $lastmonth);
	$wrk = $FldExpression . " BETWEEN " .
		QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
		" AND " .
		QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
	return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0) {
	return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions
// Database Connecting event
function Database_Connecting(&$info) {

	// Example:
	//var_dump($info);
	//if ($info["id"] == "DB" && CurrentUserIP() == "127.0.0.1") { // Testing on local PC
	//	$info["host"] = "locahost";
	//	$info["user"] = "root";
	//	$info["pass"] = "";
	//}

}

// Database Connected event
function Database_Connected(&$conn) {

	// Example:
	//if ($conn->info["id"] == "DB")
	//	$conn->Execute("Your SQL");

}

function MenuItem_Adding($item) {

	//var_dump($item);
	// Return FALSE if menu item not allowed

	$username = CurrentUserName();  
	$levelid = CurrentUserLevel();
	if ($item->Text == "Manage Users") {    
		return ($levelid == -1 || $levelid == 100); //allow administrator and LA_admin
	} elseif ($item->Text == "Human Resources") {              
		return ($levelid == 2 || $levelid == -1);
	} elseif ($item->Text == "Organisation Structure") {              
		return ($levelid == -1);
	} elseif ($item->Text == "Support") {              
		return ($levelid >= -2 );
	} elseif ($item->Text == "Revenue Management") {              
		return ($levelid == 3 );
	} elseif ($item->Text == "Reference data") {    
		return ($levelid == -1 );
	} elseif ($item->Text == "Cashier Menu") {    
		return ($levelid == 4 || $levelid == -1) ;
	} elseif ($item->Text == "Plan and Budget") {    
		return ($levelid == -1 || $levelid == 3) ;
	} elseif ($item->Text == "Council Affairs") {    
		return ($levelid == 7 || $levelid == -1) ;
	} elseif ($item->Text == "Council Projects") {    
		return ($levelid == 8 || $levelid == -1) ;
	} elseif ($item->Text == "Reports Menu") {    
		return ($levelid == 2) ;  
	}else {
		return TRUE;
	}
	return TRUE;
}

function Menu_Rendering($menu) {

	// Change menu items here
	//if ($menu->Id == "menu") { // Sidebar menu

}

function Menu_Rendered($menu) {

	// Clean up here
}

// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew) {

	//var_dump($rsnew);
	return TRUE;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row) {

	//echo "PersonalData Downloading";
}

// Personal Data Deleted event
function PersonalData_Deleted($row) {

	//echo "PersonalData Deleted";
}
$API_ACTIONS["getRatesAccounts"] = function(Request $request, Response $response) {
	$client = Param("ClientSerNo"); // Get the input value from $_GET or $_POST
	$chargegrp = Param("ChargeGroup");
	if ($client !== NULL && $chargegrp == "RT")
		WriteJson(ExecuteRows("SELECT *  FROM property_lookup_view
		WHERE  ClientSerNo = " . AdjustSql($client)));

	/* SELECT AccountNo,  ValuationNo,   ClientID,  ChargeCode,
		BalanceBF, CurrentDemand,VAT, AmountPaid, BillPeriod, property_account.BillYear
  		 FROM property_account, halfyear_ref WHERE property_account.BillYear = halfyear_ref.BillYear  
		AND property_account.BillPeriod = halfyear_ref.HalfYear AND ClientSerNo = */
	if ($client !== NULL && $chargegrp == "BB")
		WriteJson(ExecuteRows("SELECT AccountNo,  BillBoardNo,  ClientID,  ChargeCode,
		BalanceBF, CurrentDemand,VAT, AmountPaid, BillPeriod, bill_board_account.BillYear
  		 FROM bill_board_account, halfyear_ref WHERE bill_board_account.BillYear = halfyear_ref.BillYear  
		AND bill_board_account.BillPeriod = halfyear_ref.HalfYear AND ClientSerNo = " . AdjustSql($client)));
	if ($client !== NULL  && $chargegrp == "LC")
		WriteJson(ExecuteRows("SELECT LicenceNo,  BusinessNo,  ClientID,  ChargeCode,
		BalanceBF, CurrentDemand,VAT, AmountPaid, BillPeriod, licence_account.BillYear
  		 FROM licence_account, halfyear_ref WHERE licence_account.BillYear = halfyear_ref.BillYear  
		AND licence_account.BillPeriod = halfyear_ref.HalfYear AND ClientSerNo = " . AdjustSql($client)));
}
?>