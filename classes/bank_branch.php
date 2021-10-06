<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for bank_branch
 */
class bank_branch extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $BranchCode;
	public $BranchName;
	public $BankCode;
	public $AreaCode;
	public $BranchNo;
	public $BranchAddress;
	public $BranchTel;
	public $BranchEmail;
	public $BranchFax;
	public $SWIFT;
	public $IBAN;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'bank_branch';
		$this->TableName = 'bank_branch';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`bank_branch`";
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

		// BranchCode
		$this->BranchCode = new DbField('bank_branch', 'bank_branch', 'x_BranchCode', 'BranchCode', '`BranchCode`', '`BranchCode`', 200, 8, -1, FALSE, '`BranchCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchCode->IsPrimaryKey = TRUE; // Primary key field
		$this->BranchCode->Nullable = FALSE; // NOT NULL field
		$this->BranchCode->Required = TRUE; // Required field
		$this->BranchCode->Sortable = TRUE; // Allow sort
		$this->fields['BranchCode'] = &$this->BranchCode;

		// BranchName
		$this->BranchName = new DbField('bank_branch', 'bank_branch', 'x_BranchName', 'BranchName', '`BranchName`', '`BranchName`', 200, 70, -1, FALSE, '`BranchName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchName->Nullable = FALSE; // NOT NULL field
		$this->BranchName->Required = TRUE; // Required field
		$this->BranchName->Sortable = TRUE; // Allow sort
		$this->fields['BranchName'] = &$this->BranchName;

		// BankCode
		$this->BankCode = new DbField('bank_branch', 'bank_branch', 'x_BankCode', 'BankCode', '`BankCode`', '`BankCode`', 200, 4, -1, FALSE, '`BankCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankCode->IsForeignKey = TRUE; // Foreign key field
		$this->BankCode->Nullable = FALSE; // NOT NULL field
		$this->BankCode->Required = TRUE; // Required field
		$this->BankCode->Sortable = TRUE; // Allow sort
		$this->fields['BankCode'] = &$this->BankCode;

		// AreaCode
		$this->AreaCode = new DbField('bank_branch', 'bank_branch', 'x_AreaCode', 'AreaCode', '`AreaCode`', '`AreaCode`', 200, 2, -1, FALSE, '`AreaCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AreaCode->Nullable = FALSE; // NOT NULL field
		$this->AreaCode->Required = TRUE; // Required field
		$this->AreaCode->Sortable = TRUE; // Allow sort
		$this->fields['AreaCode'] = &$this->AreaCode;

		// BranchNo
		$this->BranchNo = new DbField('bank_branch', 'bank_branch', 'x_BranchNo', 'BranchNo', '`BranchNo`', '`BranchNo`', 200, 4, -1, FALSE, '`BranchNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchNo->Nullable = FALSE; // NOT NULL field
		$this->BranchNo->Required = TRUE; // Required field
		$this->BranchNo->Sortable = TRUE; // Allow sort
		$this->fields['BranchNo'] = &$this->BranchNo;

		// BranchAddress
		$this->BranchAddress = new DbField('bank_branch', 'bank_branch', 'x_BranchAddress', 'BranchAddress', '`BranchAddress`', '`BranchAddress`', 200, 255, -1, FALSE, '`BranchAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchAddress->Sortable = TRUE; // Allow sort
		$this->fields['BranchAddress'] = &$this->BranchAddress;

		// BranchTel
		$this->BranchTel = new DbField('bank_branch', 'bank_branch', 'x_BranchTel', 'BranchTel', '`BranchTel`', '`BranchTel`', 200, 100, -1, FALSE, '`BranchTel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchTel->Sortable = TRUE; // Allow sort
		$this->fields['BranchTel'] = &$this->BranchTel;

		// BranchEmail
		$this->BranchEmail = new DbField('bank_branch', 'bank_branch', 'x_BranchEmail', 'BranchEmail', '`BranchEmail`', '`BranchEmail`', 200, 100, -1, FALSE, '`BranchEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchEmail->Sortable = TRUE; // Allow sort
		$this->fields['BranchEmail'] = &$this->BranchEmail;

		// BranchFax
		$this->BranchFax = new DbField('bank_branch', 'bank_branch', 'x_BranchFax', 'BranchFax', '`BranchFax`', '`BranchFax`', 200, 100, -1, FALSE, '`BranchFax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BranchFax->Sortable = TRUE; // Allow sort
		$this->fields['BranchFax'] = &$this->BranchFax;

		// SWIFT
		$this->SWIFT = new DbField('bank_branch', 'bank_branch', 'x_SWIFT', 'SWIFT', '`SWIFT`', '`SWIFT`', 200, 100, -1, FALSE, '`SWIFT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SWIFT->Sortable = TRUE; // Allow sort
		$this->fields['SWIFT'] = &$this->SWIFT;

		// IBAN
		$this->IBAN = new DbField('bank_branch', 'bank_branch', 'x_IBAN', 'IBAN', '`IBAN`', '`IBAN`', 200, 100, -1, FALSE, '`IBAN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IBAN->Sortable = TRUE; // Allow sort
		$this->fields['IBAN'] = &$this->IBAN;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "bank") {
			if ($this->BankCode->getSessionValue() != "")
				$masterFilter .= "`BankCode`=" . QuotedValue($this->BankCode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "bank") {
			if ($this->BankCode->getSessionValue() != "")
				$detailFilter .= "`BankCode`=" . QuotedValue($this->BankCode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_bank()
	{
		return "`BankCode`='@BankCode@'";
	}

	// Detail filter
	public function sqlDetailFilter_bank()
	{
		return "`BankCode`='@BankCode@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`bank_branch`";
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
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'BranchCode';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('BranchCode', $rs))
				AddFilter($where, QuotedName('BranchCode', $this->Dbid) . '=' . QuotedValue($rs['BranchCode'], $this->BranchCode->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->BranchCode->DbValue = $row['BranchCode'];
		$this->BranchName->DbValue = $row['BranchName'];
		$this->BankCode->DbValue = $row['BankCode'];
		$this->AreaCode->DbValue = $row['AreaCode'];
		$this->BranchNo->DbValue = $row['BranchNo'];
		$this->BranchAddress->DbValue = $row['BranchAddress'];
		$this->BranchTel->DbValue = $row['BranchTel'];
		$this->BranchEmail->DbValue = $row['BranchEmail'];
		$this->BranchFax->DbValue = $row['BranchFax'];
		$this->SWIFT->DbValue = $row['SWIFT'];
		$this->IBAN->DbValue = $row['IBAN'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`BranchCode` = '@BranchCode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('BranchCode', $row) ? $row['BranchCode'] : NULL;
		else
			$val = $this->BranchCode->OldValue !== NULL ? $this->BranchCode->OldValue : $this->BranchCode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@BranchCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "bank_branchlist.php";
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
		if ($pageName == "bank_branchview.php")
			return $Language->phrase("View");
		elseif ($pageName == "bank_branchedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "bank_branchadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "bank_branchlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("bank_branchview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bank_branchview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "bank_branchadd.php?" . $this->getUrlParm($parm);
		else
			$url = "bank_branchadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("bank_branchedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("bank_branchadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("bank_branchdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "bank" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_BankCode=" . urlencode($this->BankCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "BranchCode:" . JsonEncode($this->BranchCode->CurrentValue, "string");
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
		if ($this->BranchCode->CurrentValue != NULL) {
			$url .= "BranchCode=" . urlencode($this->BranchCode->CurrentValue);
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
			if (Param("BranchCode") !== NULL)
				$arKeys[] = Param("BranchCode");
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
				$this->BranchCode->CurrentValue = $key;
			else
				$this->BranchCode->OldValue = $key;
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
		$this->BranchCode->setDbValue($rs->fields('BranchCode'));
		$this->BranchName->setDbValue($rs->fields('BranchName'));
		$this->BankCode->setDbValue($rs->fields('BankCode'));
		$this->AreaCode->setDbValue($rs->fields('AreaCode'));
		$this->BranchNo->setDbValue($rs->fields('BranchNo'));
		$this->BranchAddress->setDbValue($rs->fields('BranchAddress'));
		$this->BranchTel->setDbValue($rs->fields('BranchTel'));
		$this->BranchEmail->setDbValue($rs->fields('BranchEmail'));
		$this->BranchFax->setDbValue($rs->fields('BranchFax'));
		$this->SWIFT->setDbValue($rs->fields('SWIFT'));
		$this->IBAN->setDbValue($rs->fields('IBAN'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// BranchCode
		// BranchName
		// BankCode
		// AreaCode
		// BranchNo
		// BranchAddress
		// BranchTel
		// BranchEmail
		// BranchFax
		// SWIFT
		// IBAN
		// BranchCode

		$this->BranchCode->ViewValue = $this->BranchCode->CurrentValue;
		$this->BranchCode->ViewCustomAttributes = "";

		// BranchName
		$this->BranchName->ViewValue = $this->BranchName->CurrentValue;
		$this->BranchName->ViewCustomAttributes = "";

		// BankCode
		$this->BankCode->ViewValue = $this->BankCode->CurrentValue;
		$this->BankCode->ViewCustomAttributes = "";

		// AreaCode
		$this->AreaCode->ViewValue = $this->AreaCode->CurrentValue;
		$this->AreaCode->ViewCustomAttributes = "";

		// BranchNo
		$this->BranchNo->ViewValue = $this->BranchNo->CurrentValue;
		$this->BranchNo->ViewCustomAttributes = "";

		// BranchAddress
		$this->BranchAddress->ViewValue = $this->BranchAddress->CurrentValue;
		$this->BranchAddress->ViewCustomAttributes = "";

		// BranchTel
		$this->BranchTel->ViewValue = $this->BranchTel->CurrentValue;
		$this->BranchTel->ViewCustomAttributes = "";

		// BranchEmail
		$this->BranchEmail->ViewValue = $this->BranchEmail->CurrentValue;
		$this->BranchEmail->ViewCustomAttributes = "";

		// BranchFax
		$this->BranchFax->ViewValue = $this->BranchFax->CurrentValue;
		$this->BranchFax->ViewCustomAttributes = "";

		// SWIFT
		$this->SWIFT->ViewValue = $this->SWIFT->CurrentValue;
		$this->SWIFT->ViewCustomAttributes = "";

		// IBAN
		$this->IBAN->ViewValue = $this->IBAN->CurrentValue;
		$this->IBAN->ViewCustomAttributes = "";

		// BranchCode
		$this->BranchCode->LinkCustomAttributes = "";
		$this->BranchCode->HrefValue = "";
		$this->BranchCode->TooltipValue = "";

		// BranchName
		$this->BranchName->LinkCustomAttributes = "";
		$this->BranchName->HrefValue = "";
		$this->BranchName->TooltipValue = "";

		// BankCode
		$this->BankCode->LinkCustomAttributes = "";
		$this->BankCode->HrefValue = "";
		$this->BankCode->TooltipValue = "";

		// AreaCode
		$this->AreaCode->LinkCustomAttributes = "";
		$this->AreaCode->HrefValue = "";
		$this->AreaCode->TooltipValue = "";

		// BranchNo
		$this->BranchNo->LinkCustomAttributes = "";
		$this->BranchNo->HrefValue = "";
		$this->BranchNo->TooltipValue = "";

		// BranchAddress
		$this->BranchAddress->LinkCustomAttributes = "";
		$this->BranchAddress->HrefValue = "";
		$this->BranchAddress->TooltipValue = "";

		// BranchTel
		$this->BranchTel->LinkCustomAttributes = "";
		$this->BranchTel->HrefValue = "";
		$this->BranchTel->TooltipValue = "";

		// BranchEmail
		$this->BranchEmail->LinkCustomAttributes = "";
		$this->BranchEmail->HrefValue = "";
		$this->BranchEmail->TooltipValue = "";

		// BranchFax
		$this->BranchFax->LinkCustomAttributes = "";
		$this->BranchFax->HrefValue = "";
		$this->BranchFax->TooltipValue = "";

		// SWIFT
		$this->SWIFT->LinkCustomAttributes = "";
		$this->SWIFT->HrefValue = "";
		$this->SWIFT->TooltipValue = "";

		// IBAN
		$this->IBAN->LinkCustomAttributes = "";
		$this->IBAN->HrefValue = "";
		$this->IBAN->TooltipValue = "";

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

		// BranchCode
		$this->BranchCode->EditAttrs["class"] = "form-control";
		$this->BranchCode->EditCustomAttributes = "";
		if (!$this->BranchCode->Raw)
			$this->BranchCode->CurrentValue = HtmlDecode($this->BranchCode->CurrentValue);
		$this->BranchCode->EditValue = $this->BranchCode->CurrentValue;
		$this->BranchCode->PlaceHolder = RemoveHtml($this->BranchCode->caption());

		// BranchName
		$this->BranchName->EditAttrs["class"] = "form-control";
		$this->BranchName->EditCustomAttributes = "";
		if (!$this->BranchName->Raw)
			$this->BranchName->CurrentValue = HtmlDecode($this->BranchName->CurrentValue);
		$this->BranchName->EditValue = $this->BranchName->CurrentValue;
		$this->BranchName->PlaceHolder = RemoveHtml($this->BranchName->caption());

		// BankCode
		$this->BankCode->EditAttrs["class"] = "form-control";
		$this->BankCode->EditCustomAttributes = "";
		if ($this->BankCode->getSessionValue() != "") {
			$this->BankCode->CurrentValue = $this->BankCode->getSessionValue();
			$this->BankCode->ViewValue = $this->BankCode->CurrentValue;
			$this->BankCode->ViewCustomAttributes = "";
		} else {
			if (!$this->BankCode->Raw)
				$this->BankCode->CurrentValue = HtmlDecode($this->BankCode->CurrentValue);
			$this->BankCode->EditValue = $this->BankCode->CurrentValue;
			$this->BankCode->PlaceHolder = RemoveHtml($this->BankCode->caption());
		}

		// AreaCode
		$this->AreaCode->EditAttrs["class"] = "form-control";
		$this->AreaCode->EditCustomAttributes = "";
		if (!$this->AreaCode->Raw)
			$this->AreaCode->CurrentValue = HtmlDecode($this->AreaCode->CurrentValue);
		$this->AreaCode->EditValue = $this->AreaCode->CurrentValue;
		$this->AreaCode->PlaceHolder = RemoveHtml($this->AreaCode->caption());

		// BranchNo
		$this->BranchNo->EditAttrs["class"] = "form-control";
		$this->BranchNo->EditCustomAttributes = "";
		if (!$this->BranchNo->Raw)
			$this->BranchNo->CurrentValue = HtmlDecode($this->BranchNo->CurrentValue);
		$this->BranchNo->EditValue = $this->BranchNo->CurrentValue;
		$this->BranchNo->PlaceHolder = RemoveHtml($this->BranchNo->caption());

		// BranchAddress
		$this->BranchAddress->EditAttrs["class"] = "form-control";
		$this->BranchAddress->EditCustomAttributes = "";
		if (!$this->BranchAddress->Raw)
			$this->BranchAddress->CurrentValue = HtmlDecode($this->BranchAddress->CurrentValue);
		$this->BranchAddress->EditValue = $this->BranchAddress->CurrentValue;
		$this->BranchAddress->PlaceHolder = RemoveHtml($this->BranchAddress->caption());

		// BranchTel
		$this->BranchTel->EditAttrs["class"] = "form-control";
		$this->BranchTel->EditCustomAttributes = "";
		if (!$this->BranchTel->Raw)
			$this->BranchTel->CurrentValue = HtmlDecode($this->BranchTel->CurrentValue);
		$this->BranchTel->EditValue = $this->BranchTel->CurrentValue;
		$this->BranchTel->PlaceHolder = RemoveHtml($this->BranchTel->caption());

		// BranchEmail
		$this->BranchEmail->EditAttrs["class"] = "form-control";
		$this->BranchEmail->EditCustomAttributes = "";
		if (!$this->BranchEmail->Raw)
			$this->BranchEmail->CurrentValue = HtmlDecode($this->BranchEmail->CurrentValue);
		$this->BranchEmail->EditValue = $this->BranchEmail->CurrentValue;
		$this->BranchEmail->PlaceHolder = RemoveHtml($this->BranchEmail->caption());

		// BranchFax
		$this->BranchFax->EditAttrs["class"] = "form-control";
		$this->BranchFax->EditCustomAttributes = "";
		if (!$this->BranchFax->Raw)
			$this->BranchFax->CurrentValue = HtmlDecode($this->BranchFax->CurrentValue);
		$this->BranchFax->EditValue = $this->BranchFax->CurrentValue;
		$this->BranchFax->PlaceHolder = RemoveHtml($this->BranchFax->caption());

		// SWIFT
		$this->SWIFT->EditAttrs["class"] = "form-control";
		$this->SWIFT->EditCustomAttributes = "";
		if (!$this->SWIFT->Raw)
			$this->SWIFT->CurrentValue = HtmlDecode($this->SWIFT->CurrentValue);
		$this->SWIFT->EditValue = $this->SWIFT->CurrentValue;
		$this->SWIFT->PlaceHolder = RemoveHtml($this->SWIFT->caption());

		// IBAN
		$this->IBAN->EditAttrs["class"] = "form-control";
		$this->IBAN->EditCustomAttributes = "";
		if (!$this->IBAN->Raw)
			$this->IBAN->CurrentValue = HtmlDecode($this->IBAN->CurrentValue);
		$this->IBAN->EditValue = $this->IBAN->CurrentValue;
		$this->IBAN->PlaceHolder = RemoveHtml($this->IBAN->caption());

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
					$doc->exportCaption($this->BranchCode);
					$doc->exportCaption($this->BranchName);
					$doc->exportCaption($this->BankCode);
					$doc->exportCaption($this->AreaCode);
					$doc->exportCaption($this->BranchNo);
					$doc->exportCaption($this->BranchAddress);
					$doc->exportCaption($this->BranchTel);
					$doc->exportCaption($this->BranchEmail);
					$doc->exportCaption($this->BranchFax);
					$doc->exportCaption($this->SWIFT);
					$doc->exportCaption($this->IBAN);
				} else {
					$doc->exportCaption($this->BranchCode);
					$doc->exportCaption($this->BranchName);
					$doc->exportCaption($this->BankCode);
					$doc->exportCaption($this->AreaCode);
					$doc->exportCaption($this->BranchNo);
					$doc->exportCaption($this->BranchAddress);
					$doc->exportCaption($this->BranchTel);
					$doc->exportCaption($this->BranchEmail);
					$doc->exportCaption($this->BranchFax);
					$doc->exportCaption($this->SWIFT);
					$doc->exportCaption($this->IBAN);
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
						$doc->exportField($this->BranchCode);
						$doc->exportField($this->BranchName);
						$doc->exportField($this->BankCode);
						$doc->exportField($this->AreaCode);
						$doc->exportField($this->BranchNo);
						$doc->exportField($this->BranchAddress);
						$doc->exportField($this->BranchTel);
						$doc->exportField($this->BranchEmail);
						$doc->exportField($this->BranchFax);
						$doc->exportField($this->SWIFT);
						$doc->exportField($this->IBAN);
					} else {
						$doc->exportField($this->BranchCode);
						$doc->exportField($this->BranchName);
						$doc->exportField($this->BankCode);
						$doc->exportField($this->AreaCode);
						$doc->exportField($this->BranchNo);
						$doc->exportField($this->BranchAddress);
						$doc->exportField($this->BranchTel);
						$doc->exportField($this->BranchEmail);
						$doc->exportField($this->BranchFax);
						$doc->exportField($this->SWIFT);
						$doc->exportField($this->IBAN);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'bank_branch';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'bank_branch';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['BranchCode'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'bank_branch';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['BranchCode'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'bank_branch';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['BranchCode'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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