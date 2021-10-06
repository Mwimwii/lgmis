<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for payroll_schedule_view
 */
class _payroll_schedule_view extends DbTable
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
	public $LocalAuthority;
	public $PayrollPeriod;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $PositionName;
	public $pCode;
	public $pName;
	public $Amount;
	public $PaymentMethod;
	public $BankBranchCode;
	public $BankAccountNo;
	public $ThirdPartyPayMethod;
	public $ThirdPartyBank;
	public $ThirdPartyAccount;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = '_payroll_schedule_view';
		$this->TableName = 'payroll_schedule_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`payroll_schedule_view`";
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

		// LocalAuthority
		$this->LocalAuthority = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_LocalAuthority', 'LocalAuthority', '`LocalAuthority`', '`LocalAuthority`', 200, 40, -1, FALSE, '`LocalAuthority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LocalAuthority->Nullable = FALSE; // NOT NULL field
		$this->LocalAuthority->Required = TRUE; // Required field
		$this->LocalAuthority->Sortable = TRUE; // Allow sort
		$this->LocalAuthority->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LocalAuthority->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LocalAuthority->Lookup = new Lookup('LocalAuthority', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['LocalAuthority'] = &$this->LocalAuthority;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PayrollPeriod->IsPrimaryKey = TRUE; // Primary key field
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PayrollPeriod->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PayrollPeriod->Lookup = new Lookup('PayrollPeriod', 'payroll_period', FALSE, 'PeriodCode', ["FiscalYear","RunMonth","RunDescription",""], [], [], [], [], [], [], '', '');
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// Title
		$this->Title = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// PositionName
		$this->PositionName = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->fields['PositionName'] = &$this->PositionName;

		// pCode
		$this->pCode = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_pCode', 'pCode', '`pCode`', '`pCode`', 200, 15, -1, FALSE, '`pCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pCode->IsPrimaryKey = TRUE; // Primary key field
		$this->pCode->Nullable = FALSE; // NOT NULL field
		$this->pCode->Required = TRUE; // Required field
		$this->pCode->Sortable = TRUE; // Allow sort
		$this->fields['pCode'] = &$this->pCode;

		// pName
		$this->pName = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_pName', 'pName', '`pName`', '`pName`', 200, 255, -1, FALSE, '`pName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pName->Nullable = FALSE; // NOT NULL field
		$this->pName->Required = TRUE; // Required field
		$this->pName->Sortable = TRUE; // Allow sort
		$this->fields['pName'] = &$this->pName;

		// Amount
		$this->Amount = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_Amount', 'Amount', '`Amount`', '`Amount`', 5, 22, -1, FALSE, '`Amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Amount->Nullable = FALSE; // NOT NULL field
		$this->Amount->Sortable = TRUE; // Allow sort
		$this->Amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Amount'] = &$this->Amount;

		// PaymentMethod
		$this->PaymentMethod = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_PaymentMethod', 'PaymentMethod', '`PaymentMethod`', '`PaymentMethod`', 200, 1, -1, FALSE, '`PaymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentMethod->Sortable = TRUE; // Allow sort
		$this->fields['PaymentMethod'] = &$this->PaymentMethod;

		// BankBranchCode
		$this->BankBranchCode = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_BankBranchCode', 'BankBranchCode', '`BankBranchCode`', '`BankBranchCode`', 200, 8, -1, FALSE, '`BankBranchCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankBranchCode->Sortable = TRUE; // Allow sort
		$this->fields['BankBranchCode'] = &$this->BankBranchCode;

		// BankAccountNo
		$this->BankAccountNo = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_BankAccountNo', 'BankAccountNo', '`BankAccountNo`', '`BankAccountNo`', 200, 13, -1, FALSE, '`BankAccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankAccountNo->Sortable = TRUE; // Allow sort
		$this->fields['BankAccountNo'] = &$this->BankAccountNo;

		// ThirdPartyPayMethod
		$this->ThirdPartyPayMethod = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_ThirdPartyPayMethod', 'ThirdPartyPayMethod', '`ThirdPartyPayMethod`', '`ThirdPartyPayMethod`', 200, 1, -1, FALSE, '`ThirdPartyPayMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ThirdPartyPayMethod->Sortable = TRUE; // Allow sort
		$this->fields['ThirdPartyPayMethod'] = &$this->ThirdPartyPayMethod;

		// ThirdPartyBank
		$this->ThirdPartyBank = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_ThirdPartyBank', 'ThirdPartyBank', '`ThirdPartyBank`', '`ThirdPartyBank`', 200, 8, -1, FALSE, '`ThirdPartyBank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ThirdPartyBank->Sortable = TRUE; // Allow sort
		$this->fields['ThirdPartyBank'] = &$this->ThirdPartyBank;

		// ThirdPartyAccount
		$this->ThirdPartyAccount = new DbField('_payroll_schedule_view', 'payroll_schedule_view', 'x_ThirdPartyAccount', 'ThirdPartyAccount', '`ThirdPartyAccount`', '`ThirdPartyAccount`', 200, 13, -1, FALSE, '`ThirdPartyAccount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ThirdPartyAccount->Sortable = TRUE; // Allow sort
		$this->fields['ThirdPartyAccount'] = &$this->ThirdPartyAccount;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`payroll_schedule_view`";
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
			if (array_key_exists('PayrollPeriod', $rs))
				AddFilter($where, QuotedName('PayrollPeriod', $this->Dbid) . '=' . QuotedValue($rs['PayrollPeriod'], $this->PayrollPeriod->DataType, $this->Dbid));
			if (array_key_exists('pCode', $rs))
				AddFilter($where, QuotedName('pCode', $this->Dbid) . '=' . QuotedValue($rs['pCode'], $this->pCode->DataType, $this->Dbid));
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
		$this->LocalAuthority->DbValue = $row['LocalAuthority'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->Title->DbValue = $row['Title'];
		$this->Surname->DbValue = $row['Surname'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->PositionName->DbValue = $row['PositionName'];
		$this->pCode->DbValue = $row['pCode'];
		$this->pName->DbValue = $row['pName'];
		$this->Amount->DbValue = $row['Amount'];
		$this->PaymentMethod->DbValue = $row['PaymentMethod'];
		$this->BankBranchCode->DbValue = $row['BankBranchCode'];
		$this->BankAccountNo->DbValue = $row['BankAccountNo'];
		$this->ThirdPartyPayMethod->DbValue = $row['ThirdPartyPayMethod'];
		$this->ThirdPartyBank->DbValue = $row['ThirdPartyBank'];
		$this->ThirdPartyAccount->DbValue = $row['ThirdPartyAccount'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`PayrollPeriod` = @PayrollPeriod@ AND `pCode` = '@pCode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('PayrollPeriod', $row) ? $row['PayrollPeriod'] : NULL;
		else
			$val = $this->PayrollPeriod->OldValue !== NULL ? $this->PayrollPeriod->OldValue : $this->PayrollPeriod->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@PayrollPeriod@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('pCode', $row) ? $row['pCode'] : NULL;
		else
			$val = $this->pCode->OldValue !== NULL ? $this->pCode->OldValue : $this->pCode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@pCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "_payroll_schedule_viewlist.php";
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
		if ($pageName == "_payroll_schedule_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "_payroll_schedule_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "_payroll_schedule_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "_payroll_schedule_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_payroll_schedule_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_payroll_schedule_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "_payroll_schedule_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "_payroll_schedule_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("_payroll_schedule_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("_payroll_schedule_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("_payroll_schedule_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "PayrollPeriod:" . JsonEncode($this->PayrollPeriod->CurrentValue, "number");
		$json .= ",pCode:" . JsonEncode($this->pCode->CurrentValue, "string");
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
		if ($this->PayrollPeriod->CurrentValue != NULL) {
			$url .= "PayrollPeriod=" . urlencode($this->PayrollPeriod->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->pCode->CurrentValue != NULL) {
			$url .= "&pCode=" . urlencode($this->pCode->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("PayrollPeriod") !== NULL)
				$arKey[] = Param("PayrollPeriod");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("pCode") !== NULL)
				$arKey[] = Param("pCode");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // PayrollPeriod
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
				$this->PayrollPeriod->CurrentValue = $key[0];
			else
				$this->PayrollPeriod->OldValue = $key[0];
			if ($setCurrent)
				$this->pCode->CurrentValue = $key[1];
			else
				$this->pCode->OldValue = $key[1];
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
		$this->LocalAuthority->setDbValue($rs->fields('LocalAuthority'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->Title->setDbValue($rs->fields('Title'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->PositionName->setDbValue($rs->fields('PositionName'));
		$this->pCode->setDbValue($rs->fields('pCode'));
		$this->pName->setDbValue($rs->fields('pName'));
		$this->Amount->setDbValue($rs->fields('Amount'));
		$this->PaymentMethod->setDbValue($rs->fields('PaymentMethod'));
		$this->BankBranchCode->setDbValue($rs->fields('BankBranchCode'));
		$this->BankAccountNo->setDbValue($rs->fields('BankAccountNo'));
		$this->ThirdPartyPayMethod->setDbValue($rs->fields('ThirdPartyPayMethod'));
		$this->ThirdPartyBank->setDbValue($rs->fields('ThirdPartyBank'));
		$this->ThirdPartyAccount->setDbValue($rs->fields('ThirdPartyAccount'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LocalAuthority
		// PayrollPeriod
		// Title
		// Surname
		// FirstName
		// MiddleName
		// PositionName
		// pCode
		// pName
		// Amount
		// PaymentMethod
		// BankBranchCode
		// BankAccountNo
		// ThirdPartyPayMethod
		// ThirdPartyBank
		// ThirdPartyAccount
		// LocalAuthority

		$curVal = strval($this->LocalAuthority->CurrentValue);
		if ($curVal != "") {
			$this->LocalAuthority->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
			if ($this->LocalAuthority->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->LocalAuthority->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LocalAuthority->ViewValue = $this->LocalAuthority->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LocalAuthority->ViewValue = $this->LocalAuthority->CurrentValue;
				}
			}
		} else {
			$this->LocalAuthority->ViewValue = NULL;
		}
		$this->LocalAuthority->ViewCustomAttributes = "";

		// PayrollPeriod
		$curVal = strval($this->PayrollPeriod->CurrentValue);
		if ($curVal != "") {
			$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
			if ($this->PayrollPeriod->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
				}
			}
		} else {
			$this->PayrollPeriod->ViewValue = NULL;
		}
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// Title
		$this->Title->ViewValue = $this->Title->CurrentValue;
		$this->Title->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
		$this->PositionName->ViewCustomAttributes = "";

		// pCode
		$this->pCode->ViewValue = $this->pCode->CurrentValue;
		$this->pCode->ViewCustomAttributes = "";

		// pName
		$this->pName->ViewValue = $this->pName->CurrentValue;
		$this->pName->ViewCustomAttributes = "";

		// Amount
		$this->Amount->ViewValue = $this->Amount->CurrentValue;
		$this->Amount->ViewValue = FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
		$this->Amount->ViewCustomAttributes = "";

		// PaymentMethod
		$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentMethod->ViewCustomAttributes = "";

		// BankBranchCode
		$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
		$this->BankBranchCode->ViewCustomAttributes = "";

		// BankAccountNo
		$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
		$this->BankAccountNo->ViewCustomAttributes = "";

		// ThirdPartyPayMethod
		$this->ThirdPartyPayMethod->ViewValue = $this->ThirdPartyPayMethod->CurrentValue;
		$this->ThirdPartyPayMethod->ViewCustomAttributes = "";

		// ThirdPartyBank
		$this->ThirdPartyBank->ViewValue = $this->ThirdPartyBank->CurrentValue;
		$this->ThirdPartyBank->ViewCustomAttributes = "";

		// ThirdPartyAccount
		$this->ThirdPartyAccount->ViewValue = $this->ThirdPartyAccount->CurrentValue;
		$this->ThirdPartyAccount->ViewCustomAttributes = "";

		// LocalAuthority
		$this->LocalAuthority->LinkCustomAttributes = "";
		$this->LocalAuthority->HrefValue = "";
		$this->LocalAuthority->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// Title
		$this->Title->LinkCustomAttributes = "";
		$this->Title->HrefValue = "";
		$this->Title->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// MiddleName
		$this->MiddleName->LinkCustomAttributes = "";
		$this->MiddleName->HrefValue = "";
		$this->MiddleName->TooltipValue = "";

		// PositionName
		$this->PositionName->LinkCustomAttributes = "";
		$this->PositionName->HrefValue = "";
		$this->PositionName->TooltipValue = "";

		// pCode
		$this->pCode->LinkCustomAttributes = "";
		$this->pCode->HrefValue = "";
		$this->pCode->TooltipValue = "";

		// pName
		$this->pName->LinkCustomAttributes = "";
		$this->pName->HrefValue = "";
		$this->pName->TooltipValue = "";

		// Amount
		$this->Amount->LinkCustomAttributes = "";
		$this->Amount->HrefValue = "";
		$this->Amount->TooltipValue = "";

		// PaymentMethod
		$this->PaymentMethod->LinkCustomAttributes = "";
		$this->PaymentMethod->HrefValue = "";
		$this->PaymentMethod->TooltipValue = "";

		// BankBranchCode
		$this->BankBranchCode->LinkCustomAttributes = "";
		$this->BankBranchCode->HrefValue = "";
		$this->BankBranchCode->TooltipValue = "";

		// BankAccountNo
		$this->BankAccountNo->LinkCustomAttributes = "";
		$this->BankAccountNo->HrefValue = "";
		$this->BankAccountNo->TooltipValue = "";

		// ThirdPartyPayMethod
		$this->ThirdPartyPayMethod->LinkCustomAttributes = "";
		$this->ThirdPartyPayMethod->HrefValue = "";
		$this->ThirdPartyPayMethod->TooltipValue = "";

		// ThirdPartyBank
		$this->ThirdPartyBank->LinkCustomAttributes = "";
		$this->ThirdPartyBank->HrefValue = "";
		$this->ThirdPartyBank->TooltipValue = "";

		// ThirdPartyAccount
		$this->ThirdPartyAccount->LinkCustomAttributes = "";
		$this->ThirdPartyAccount->HrefValue = "";
		$this->ThirdPartyAccount->TooltipValue = "";

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

		// LocalAuthority
		$this->LocalAuthority->EditAttrs["class"] = "form-control";
		$this->LocalAuthority->EditCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";

		// Title
		$this->Title->EditAttrs["class"] = "form-control";
		$this->Title->EditCustomAttributes = "";
		if (!$this->Title->Raw)
			$this->Title->CurrentValue = HtmlDecode($this->Title->CurrentValue);
		$this->Title->EditValue = $this->Title->CurrentValue;
		$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// MiddleName
		$this->MiddleName->EditAttrs["class"] = "form-control";
		$this->MiddleName->EditCustomAttributes = "";
		if (!$this->MiddleName->Raw)
			$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
		$this->MiddleName->EditValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

		// PositionName
		$this->PositionName->EditAttrs["class"] = "form-control";
		$this->PositionName->EditCustomAttributes = "";
		if (!$this->PositionName->Raw)
			$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
		$this->PositionName->EditValue = $this->PositionName->CurrentValue;
		$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

		// pCode
		$this->pCode->EditAttrs["class"] = "form-control";
		$this->pCode->EditCustomAttributes = "";
		if (!$this->pCode->Raw)
			$this->pCode->CurrentValue = HtmlDecode($this->pCode->CurrentValue);
		$this->pCode->EditValue = $this->pCode->CurrentValue;
		$this->pCode->PlaceHolder = RemoveHtml($this->pCode->caption());

		// pName
		$this->pName->EditAttrs["class"] = "form-control";
		$this->pName->EditCustomAttributes = "";
		if (!$this->pName->Raw)
			$this->pName->CurrentValue = HtmlDecode($this->pName->CurrentValue);
		$this->pName->EditValue = $this->pName->CurrentValue;
		$this->pName->PlaceHolder = RemoveHtml($this->pName->caption());

		// Amount
		$this->Amount->EditAttrs["class"] = "form-control";
		$this->Amount->EditCustomAttributes = "";
		$this->Amount->EditValue = $this->Amount->CurrentValue;
		$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());
		if (strval($this->Amount->EditValue) != "" && is_numeric($this->Amount->EditValue))
			$this->Amount->EditValue = FormatNumber($this->Amount->EditValue, -2, -2, -2, -2);
		

		// PaymentMethod
		$this->PaymentMethod->EditAttrs["class"] = "form-control";
		$this->PaymentMethod->EditCustomAttributes = "";
		if (!$this->PaymentMethod->Raw)
			$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
		$this->PaymentMethod->EditValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

		// BankBranchCode
		$this->BankBranchCode->EditAttrs["class"] = "form-control";
		$this->BankBranchCode->EditCustomAttributes = "";
		if (!$this->BankBranchCode->Raw)
			$this->BankBranchCode->CurrentValue = HtmlDecode($this->BankBranchCode->CurrentValue);
		$this->BankBranchCode->EditValue = $this->BankBranchCode->CurrentValue;
		$this->BankBranchCode->PlaceHolder = RemoveHtml($this->BankBranchCode->caption());

		// BankAccountNo
		$this->BankAccountNo->EditAttrs["class"] = "form-control";
		$this->BankAccountNo->EditCustomAttributes = "";
		if (!$this->BankAccountNo->Raw)
			$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
		$this->BankAccountNo->EditValue = $this->BankAccountNo->CurrentValue;
		$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

		// ThirdPartyPayMethod
		$this->ThirdPartyPayMethod->EditAttrs["class"] = "form-control";
		$this->ThirdPartyPayMethod->EditCustomAttributes = "";
		if (!$this->ThirdPartyPayMethod->Raw)
			$this->ThirdPartyPayMethod->CurrentValue = HtmlDecode($this->ThirdPartyPayMethod->CurrentValue);
		$this->ThirdPartyPayMethod->EditValue = $this->ThirdPartyPayMethod->CurrentValue;
		$this->ThirdPartyPayMethod->PlaceHolder = RemoveHtml($this->ThirdPartyPayMethod->caption());

		// ThirdPartyBank
		$this->ThirdPartyBank->EditAttrs["class"] = "form-control";
		$this->ThirdPartyBank->EditCustomAttributes = "";
		if (!$this->ThirdPartyBank->Raw)
			$this->ThirdPartyBank->CurrentValue = HtmlDecode($this->ThirdPartyBank->CurrentValue);
		$this->ThirdPartyBank->EditValue = $this->ThirdPartyBank->CurrentValue;
		$this->ThirdPartyBank->PlaceHolder = RemoveHtml($this->ThirdPartyBank->caption());

		// ThirdPartyAccount
		$this->ThirdPartyAccount->EditAttrs["class"] = "form-control";
		$this->ThirdPartyAccount->EditCustomAttributes = "";
		if (!$this->ThirdPartyAccount->Raw)
			$this->ThirdPartyAccount->CurrentValue = HtmlDecode($this->ThirdPartyAccount->CurrentValue);
		$this->ThirdPartyAccount->EditValue = $this->ThirdPartyAccount->CurrentValue;
		$this->ThirdPartyAccount->PlaceHolder = RemoveHtml($this->ThirdPartyAccount->caption());

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
					$doc->exportCaption($this->LocalAuthority);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->pCode);
					$doc->exportCaption($this->pName);
					$doc->exportCaption($this->Amount);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->BankBranchCode);
					$doc->exportCaption($this->BankAccountNo);
					$doc->exportCaption($this->ThirdPartyPayMethod);
					$doc->exportCaption($this->ThirdPartyBank);
					$doc->exportCaption($this->ThirdPartyAccount);
				} else {
					$doc->exportCaption($this->LocalAuthority);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->pCode);
					$doc->exportCaption($this->pName);
					$doc->exportCaption($this->Amount);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->BankBranchCode);
					$doc->exportCaption($this->BankAccountNo);
					$doc->exportCaption($this->ThirdPartyPayMethod);
					$doc->exportCaption($this->ThirdPartyBank);
					$doc->exportCaption($this->ThirdPartyAccount);
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
						$doc->exportField($this->LocalAuthority);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->pCode);
						$doc->exportField($this->pName);
						$doc->exportField($this->Amount);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->BankBranchCode);
						$doc->exportField($this->BankAccountNo);
						$doc->exportField($this->ThirdPartyPayMethod);
						$doc->exportField($this->ThirdPartyBank);
						$doc->exportField($this->ThirdPartyAccount);
					} else {
						$doc->exportField($this->LocalAuthority);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->pCode);
						$doc->exportField($this->pName);
						$doc->exportField($this->Amount);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->BankBranchCode);
						$doc->exportField($this->BankAccountNo);
						$doc->exportField($this->ThirdPartyPayMethod);
						$doc->exportField($this->ThirdPartyBank);
						$doc->exportField($this->ThirdPartyAccount);
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