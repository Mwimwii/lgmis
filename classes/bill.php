<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for bill
 */
class bill extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $ClientSerNo;
	public $ChargeCode;
	public $ChargeGroup;
	public $ClientID;
	public $AccountNo;
	public $ChargeRef;
	public $BillYear;
	public $BillPeriod;
	public $StartDate;
	public $EndDate;
	public $BalanceBF;
	public $AmountDue;
	public $VAT;
	public $SalesTax;
	public $AmountPaid;
	public $ReferenceNo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'bill';
		$this->TableName = 'bill';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`bill`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ClientSerNo
		$this->ClientSerNo = new DbField('bill', 'bill', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->Nullable = FALSE; // NOT NULL field
		$this->ClientSerNo->Required = TRUE; // Required field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientSerNo","",""], [], [], [], [], [], [], '', '');
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ChargeCode
		$this->ChargeCode = new DbField('bill', 'bill', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 3, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeCode->Nullable = FALSE; // NOT NULL field
		$this->ChargeCode->Required = TRUE; // Required field
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->Lookup = new Lookup('ChargeCode', 'charges', FALSE, 'ChargeCode', ["ChargeDesc","ChargeCode","",""], [], [], [], [], [], [], '', '');
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;

		// ChargeGroup
		$this->ChargeGroup = new DbField('bill', 'bill', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 200, 50, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeGroup->Nullable = FALSE; // NOT NULL field
		$this->ChargeGroup->Required = TRUE; // Required field
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->Lookup = new Lookup('ChargeGroup', 'charge_group', FALSE, 'ChargeGroup', ["ChargeGroupDesc","ChargeGroup","",""], [], [], [], [], [], [], '', '');
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// ClientID
		$this->ClientID = new DbField('bill', 'bill', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// AccountNo
		$this->AccountNo = new DbField('bill', 'bill', 'x_AccountNo', 'AccountNo', '`AccountNo`', '`AccountNo`', 200, 25, -1, FALSE, '`AccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountNo->Sortable = TRUE; // Allow sort
		$this->fields['AccountNo'] = &$this->AccountNo;

		// ChargeRef
		$this->ChargeRef = new DbField('bill', 'bill', 'x_ChargeRef', 'ChargeRef', '`ChargeRef`', '`ChargeRef`', 200, 13, -1, FALSE, '`ChargeRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeRef->Nullable = FALSE; // NOT NULL field
		$this->ChargeRef->Required = TRUE; // Required field
		$this->ChargeRef->Sortable = TRUE; // Allow sort
		$this->fields['ChargeRef'] = &$this->ChargeRef;

		// BillYear
		$this->BillYear = new DbField('bill', 'bill', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillYear->Nullable = FALSE; // NOT NULL field
		$this->BillYear->Required = TRUE; // Required field
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->Lookup = new Lookup('BillYear', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// BillPeriod
		$this->BillPeriod = new DbField('bill', 'bill', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 3, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->Nullable = FALSE; // NOT NULL field
		$this->BillPeriod->Required = TRUE; // Required field
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->Lookup = new Lookup('BillPeriod', 'halfyear_ref', FALSE, 'HalfYear', ["HalfYear","","",""], [], [], [], [], [], [], '', '');
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// StartDate
		$this->StartDate = new DbField('bill', 'bill', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('bill', 'bill', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// BalanceBF
		$this->BalanceBF = new DbField('bill', 'bill', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 22, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// AmountDue
		$this->AmountDue = new DbField('bill', 'bill', 'x_AmountDue', 'AmountDue', '`AmountDue`', '`AmountDue`', 5, 22, -1, FALSE, '`AmountDue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountDue->Sortable = TRUE; // Allow sort
		$this->AmountDue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountDue'] = &$this->AmountDue;

		// VAT
		$this->VAT = new DbField('bill', 'bill', 'x_VAT', 'VAT', '`VAT`', '`VAT`', 5, 22, -1, FALSE, '`VAT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VAT->Sortable = TRUE; // Allow sort
		$this->VAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VAT'] = &$this->VAT;

		// SalesTax
		$this->SalesTax = new DbField('bill', 'bill', 'x_SalesTax', 'SalesTax', '`SalesTax`', '`SalesTax`', 5, 22, -1, FALSE, '`SalesTax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalesTax->Sortable = TRUE; // Allow sort
		$this->SalesTax->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SalesTax'] = &$this->SalesTax;

		// AmountPaid
		$this->AmountPaid = new DbField('bill', 'bill', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// ReferenceNo
		$this->ReferenceNo = new DbField('bill', 'bill', 'x_ReferenceNo', 'ReferenceNo', '`ReferenceNo`', '`ReferenceNo`', 3, 11, -1, FALSE, '`ReferenceNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ReferenceNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ReferenceNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ReferenceNo->Sortable = TRUE; // Allow sort
		$this->ReferenceNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReferenceNo'] = &$this->ReferenceNo;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`bill`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ReferenceNo->setDbValue($conn->insert_ID());
			$rs['ReferenceNo'] = $this->ReferenceNo->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ReferenceNo', $rs))
				AddFilter($where, QuotedName('ReferenceNo', $this->Dbid) . '=' . QuotedValue($rs['ReferenceNo'], $this->ReferenceNo->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ChargeCode->DbValue = $row['ChargeCode'];
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->AccountNo->DbValue = $row['AccountNo'];
		$this->ChargeRef->DbValue = $row['ChargeRef'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->AmountDue->DbValue = $row['AmountDue'];
		$this->VAT->DbValue = $row['VAT'];
		$this->SalesTax->DbValue = $row['SalesTax'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->ReferenceNo->DbValue = $row['ReferenceNo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ReferenceNo` = @ReferenceNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ReferenceNo', $row) ? $row['ReferenceNo'] : NULL;
		else
			$val = $this->ReferenceNo->OldValue !== NULL ? $this->ReferenceNo->OldValue : $this->ReferenceNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ReferenceNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "billlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "billview.php")
			return $Language->phrase("View");
		elseif ($pageName == "billedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "billadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "billlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("billview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("billview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "billadd.php?" . $this->getUrlParm($parm);
		else
			$url = "billadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("billedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("billadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("billdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ReferenceNo:" . JsonEncode($this->ReferenceNo->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->ReferenceNo->CurrentValue != NULL) {
			$url .= "ReferenceNo=" . urlencode($this->ReferenceNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ReferenceNo") !== NULL)
				$arKeys[] = Param("ReferenceNo");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->ReferenceNo->CurrentValue = $key;
			else
				$this->ReferenceNo->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->AccountNo->setDbValue($rs->fields('AccountNo'));
		$this->ChargeRef->setDbValue($rs->fields('ChargeRef'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->AmountDue->setDbValue($rs->fields('AmountDue'));
		$this->VAT->setDbValue($rs->fields('VAT'));
		$this->SalesTax->setDbValue($rs->fields('SalesTax'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->ReferenceNo->setDbValue($rs->fields('ReferenceNo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ClientSerNo
		// ChargeCode
		// ChargeGroup
		// ClientID
		// AccountNo
		// ChargeRef
		// BillYear
		// BillPeriod
		// StartDate
		// EndDate
		// BalanceBF
		// AmountDue
		// VAT
		// SalesTax
		// AmountPaid
		// ReferenceNo
		// ClientSerNo

		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$curVal = strval($this->ClientSerNo->CurrentValue);
		if ($curVal != "") {
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
			if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
				}
			}
		} else {
			$this->ClientSerNo->ViewValue = NULL;
		}
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ChargeCode
		$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
		$curVal = strval($this->ChargeCode->CurrentValue);
		if ($curVal != "") {
			$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
			if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
				}
			}
		} else {
			$this->ChargeCode->ViewValue = NULL;
		}
		$this->ChargeCode->ViewCustomAttributes = "";

		// ChargeGroup
		$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
		$curVal = strval($this->ChargeGroup->CurrentValue);
		if ($curVal != "") {
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeGroup`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				}
			}
		} else {
			$this->ChargeGroup->ViewValue = NULL;
		}
		$this->ChargeGroup->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// AccountNo
		$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
		$this->AccountNo->ViewCustomAttributes = "";

		// ChargeRef
		$this->ChargeRef->ViewValue = $this->ChargeRef->CurrentValue;
		$this->ChargeRef->ViewCustomAttributes = "";

		// BillYear
		$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
		$curVal = strval($this->BillYear->CurrentValue);
		if ($curVal != "") {
			$this->BillYear->ViewValue = $this->BillYear->lookupCacheOption($curVal);
			if ($this->BillYear->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BillYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BillYear->ViewValue = $this->BillYear->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
				}
			}
		} else {
			$this->BillYear->ViewValue = NULL;
		}
		$this->BillYear->ViewCustomAttributes = "";

		// BillPeriod
		$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
		$curVal = strval($this->BillPeriod->CurrentValue);
		if ($curVal != "") {
			$this->BillPeriod->ViewValue = $this->BillPeriod->lookupCacheOption($curVal);
			if ($this->BillPeriod->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`HalfYear`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BillPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BillPeriod->ViewValue = $this->BillPeriod->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
				}
			}
		} else {
			$this->BillPeriod->ViewValue = NULL;
		}
		$this->BillPeriod->ViewCustomAttributes = "";

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// EndDate
		$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
		$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
		$this->EndDate->ViewCustomAttributes = "";

		// BalanceBF
		$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
		$this->BalanceBF->CellCssStyle .= "text-align: right;";
		$this->BalanceBF->ViewCustomAttributes = "";

		// AmountDue
		$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, 2, -2, -2, -2);
		$this->AmountDue->CellCssStyle .= "text-align: right;";
		$this->AmountDue->ViewCustomAttributes = "";

		// VAT
		$this->VAT->ViewValue = $this->VAT->CurrentValue;
		$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
		$this->VAT->CellCssStyle .= "text-align: right;";
		$this->VAT->ViewCustomAttributes = "";

		// SalesTax
		$this->SalesTax->ViewValue = $this->SalesTax->CurrentValue;
		$this->SalesTax->ViewValue = FormatNumber($this->SalesTax->ViewValue, 2, -2, -2, -2);
		$this->SalesTax->CellCssStyle .= "text-align: right;";
		$this->SalesTax->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->CellCssStyle .= "text-align: right;";
		$this->AmountPaid->ViewCustomAttributes = "";

		// ReferenceNo
		$this->ReferenceNo->ViewValue = $this->ReferenceNo->CurrentValue;
		$this->ReferenceNo->ViewCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// AccountNo
		$this->AccountNo->LinkCustomAttributes = "";
		$this->AccountNo->HrefValue = "";
		$this->AccountNo->TooltipValue = "";

		// ChargeRef
		$this->ChargeRef->LinkCustomAttributes = "";
		$this->ChargeRef->HrefValue = "";
		$this->ChargeRef->TooltipValue = "";

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

		// BillPeriod
		$this->BillPeriod->LinkCustomAttributes = "";
		$this->BillPeriod->HrefValue = "";
		$this->BillPeriod->TooltipValue = "";

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// EndDate
		$this->EndDate->LinkCustomAttributes = "";
		$this->EndDate->HrefValue = "";
		$this->EndDate->TooltipValue = "";

		// BalanceBF
		$this->BalanceBF->LinkCustomAttributes = "";
		$this->BalanceBF->HrefValue = "";
		$this->BalanceBF->TooltipValue = "";

		// AmountDue
		$this->AmountDue->LinkCustomAttributes = "";
		$this->AmountDue->HrefValue = "";
		$this->AmountDue->TooltipValue = "";

		// VAT
		$this->VAT->LinkCustomAttributes = "";
		$this->VAT->HrefValue = "";
		$this->VAT->TooltipValue = "";

		// SalesTax
		$this->SalesTax->LinkCustomAttributes = "";
		$this->SalesTax->HrefValue = "";
		$this->SalesTax->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// ReferenceNo
		$this->ReferenceNo->LinkCustomAttributes = "";
		$this->ReferenceNo->HrefValue = "";
		$this->ReferenceNo->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";
		if (!$this->ChargeGroup->Raw)
			$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
		$this->ChargeGroup->EditValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// AccountNo
		$this->AccountNo->EditAttrs["class"] = "form-control";
		$this->AccountNo->EditCustomAttributes = "";
		if (!$this->AccountNo->Raw)
			$this->AccountNo->CurrentValue = HtmlDecode($this->AccountNo->CurrentValue);
		$this->AccountNo->EditValue = $this->AccountNo->CurrentValue;
		$this->AccountNo->PlaceHolder = RemoveHtml($this->AccountNo->caption());

		// ChargeRef
		$this->ChargeRef->EditAttrs["class"] = "form-control";
		$this->ChargeRef->EditCustomAttributes = "";
		if (!$this->ChargeRef->Raw)
			$this->ChargeRef->CurrentValue = HtmlDecode($this->ChargeRef->CurrentValue);
		$this->ChargeRef->EditValue = $this->ChargeRef->CurrentValue;
		$this->ChargeRef->PlaceHolder = RemoveHtml($this->ChargeRef->caption());

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";
		$this->BillYear->EditValue = $this->BillYear->CurrentValue;
		$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

		// BillPeriod
		$this->BillPeriod->EditAttrs["class"] = "form-control";
		$this->BillPeriod->EditCustomAttributes = "";
		$this->BillPeriod->EditValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

		// StartDate
		$this->StartDate->EditAttrs["class"] = "form-control";
		$this->StartDate->EditCustomAttributes = "";
		$this->StartDate->EditValue = FormatDateTime($this->StartDate->CurrentValue, 8);
		$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

		// EndDate
		$this->EndDate->EditAttrs["class"] = "form-control";
		$this->EndDate->EditCustomAttributes = "";
		$this->EndDate->EditValue = FormatDateTime($this->EndDate->CurrentValue, 8);
		$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

		// BalanceBF
		$this->BalanceBF->EditAttrs["class"] = "form-control";
		$this->BalanceBF->EditCustomAttributes = "";
		$this->BalanceBF->EditValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
		if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
			$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, -2, -2, -2);
		

		// AmountDue
		$this->AmountDue->EditAttrs["class"] = "form-control";
		$this->AmountDue->EditCustomAttributes = "";
		$this->AmountDue->EditValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());
		if (strval($this->AmountDue->EditValue) != "" && is_numeric($this->AmountDue->EditValue))
			$this->AmountDue->EditValue = FormatNumber($this->AmountDue->EditValue, -2, -2, -2, -2);
		

		// VAT
		$this->VAT->EditAttrs["class"] = "form-control";
		$this->VAT->EditCustomAttributes = "";
		$this->VAT->EditValue = $this->VAT->CurrentValue;
		$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());
		if (strval($this->VAT->EditValue) != "" && is_numeric($this->VAT->EditValue))
			$this->VAT->EditValue = FormatNumber($this->VAT->EditValue, -2, -2, -2, -2);
		

		// SalesTax
		$this->SalesTax->EditAttrs["class"] = "form-control";
		$this->SalesTax->EditCustomAttributes = "";
		$this->SalesTax->EditValue = $this->SalesTax->CurrentValue;
		$this->SalesTax->PlaceHolder = RemoveHtml($this->SalesTax->caption());
		if (strval($this->SalesTax->EditValue) != "" && is_numeric($this->SalesTax->EditValue))
			$this->SalesTax->EditValue = FormatNumber($this->SalesTax->EditValue, -2, -2, -2, -2);
		

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
		

		// ReferenceNo
		$this->ReferenceNo->EditAttrs["class"] = "form-control";
		$this->ReferenceNo->EditCustomAttributes = "";
		$this->ReferenceNo->EditValue = $this->ReferenceNo->CurrentValue;
		$this->ReferenceNo->ViewCustomAttributes = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->ChargeRef);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->SalesTax);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->ReferenceNo);
				} else {
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->ChargeRef);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->SalesTax);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->ReferenceNo);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->ChargeRef);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->VAT);
						$doc->exportField($this->SalesTax);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->ReferenceNo);
					} else {
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->ChargeRef);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->VAT);
						$doc->exportField($this->SalesTax);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->ReferenceNo);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>