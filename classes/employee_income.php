<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for employee_income
 */
class employee_income extends DbTable
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
	public $EmployeeID;
	public $PaidPosition;
	public $PayrollDate;
	public $PayrollPeriod;
	public $StartDate;
	public $EndDate;
	public $IncomeCode;
	public $Income;
	public $Remarks;
	public $Taxable;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'employee_income';
		$this->TableName = 'employee_income';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`employee_income`";
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

		// EmployeeID
		$this->EmployeeID = new DbField('employee_income', 'employee_income', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// PaidPosition
		$this->PaidPosition = new DbField('employee_income', 'employee_income', 'x_PaidPosition', 'PaidPosition', '`PaidPosition`', '`PaidPosition`', 200, 255, -1, FALSE, '`PaidPosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaidPosition->Sortable = TRUE; // Allow sort
		$this->PaidPosition->Lookup = new Lookup('PaidPosition', 'position_ref', FALSE, 'PositionCode', ["PositionName","","",""], [], [], [], [], [], [], '', '');
		$this->PaidPosition->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PaidPosition'] = &$this->PaidPosition;

		// PayrollDate
		$this->PayrollDate = new DbField('employee_income', 'employee_income', 'x_PayrollDate', 'PayrollDate', '`PayrollDate`', CastDateFieldForLike("`PayrollDate`", 0, "DB"), 135, 19, 0, FALSE, '`PayrollDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollDate->Sortable = TRUE; // Allow sort
		$this->PayrollDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PayrollDate'] = &$this->PayrollDate;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('employee_income', 'employee_income', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->IsPrimaryKey = TRUE; // Primary key field
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// StartDate
		$this->StartDate = new DbField('employee_income', 'employee_income', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('employee_income', 'employee_income', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// IncomeCode
		$this->IncomeCode = new DbField('employee_income', 'employee_income', 'x_IncomeCode', 'IncomeCode', '`IncomeCode`', '`IncomeCode`', 200, 15, -1, FALSE, '`IncomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->IncomeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->IncomeCode->Nullable = FALSE; // NOT NULL field
		$this->IncomeCode->Required = TRUE; // Required field
		$this->IncomeCode->Sortable = TRUE; // Allow sort
		$this->IncomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->IncomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->IncomeCode->Lookup = new Lookup('IncomeCode', 'income_type', FALSE, 'IncomeCode', ["IncomeName","IncomeAmount","IncomeBasicRate",""], [], [], [], [], [], [], '', '');
		$this->fields['IncomeCode'] = &$this->IncomeCode;

		// Income
		$this->Income = new DbField('employee_income', 'employee_income', 'x_Income', 'Income', '`Income`', '`Income`', 5, 22, -1, FALSE, '`Income`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Income->Nullable = FALSE; // NOT NULL field
		$this->Income->Sortable = TRUE; // Allow sort
		$this->Income->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Income'] = &$this->Income;

		// Remarks
		$this->Remarks = new DbField('employee_income', 'employee_income', 'x_Remarks', 'Remarks', '`Remarks`', '`Remarks`', 200, 255, -1, FALSE, '`Remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Remarks->Sortable = TRUE; // Allow sort
		$this->Remarks->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Remarks'] = &$this->Remarks;

		// Taxable
		$this->Taxable = new DbField('employee_income', 'employee_income', 'x_Taxable', 'Taxable', '`Taxable`', '`Taxable`', 16, 1, -1, FALSE, '`Taxable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Taxable->Sortable = TRUE; // Allow sort
		$this->Taxable->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Taxable'] = &$this->Taxable;
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
		if ($this->getCurrentMasterTable() == "employment") {
			if ($this->EmployeeID->getSessionValue() != "")
				$masterFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "employment") {
			if ($this->EmployeeID->getSessionValue() != "")
				$detailFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_employment()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Detail filter
	public function sqlDetailFilter_employment()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`employee_income`";
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
			if (array_key_exists('EmployeeID', $rs))
				AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
			if (array_key_exists('PayrollPeriod', $rs))
				AddFilter($where, QuotedName('PayrollPeriod', $this->Dbid) . '=' . QuotedValue($rs['PayrollPeriod'], $this->PayrollPeriod->DataType, $this->Dbid));
			if (array_key_exists('IncomeCode', $rs))
				AddFilter($where, QuotedName('IncomeCode', $this->Dbid) . '=' . QuotedValue($rs['IncomeCode'], $this->IncomeCode->DataType, $this->Dbid));
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->PaidPosition->DbValue = $row['PaidPosition'];
		$this->PayrollDate->DbValue = $row['PayrollDate'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
		$this->IncomeCode->DbValue = $row['IncomeCode'];
		$this->Income->DbValue = $row['Income'];
		$this->Remarks->DbValue = $row['Remarks'];
		$this->Taxable->DbValue = $row['Taxable'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `PayrollPeriod` = @PayrollPeriod@ AND `IncomeCode` = '@IncomeCode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('EmployeeID', $row) ? $row['EmployeeID'] : NULL;
		else
			$val = $this->EmployeeID->OldValue !== NULL ? $this->EmployeeID->OldValue : $this->EmployeeID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@EmployeeID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			$val = array_key_exists('IncomeCode', $row) ? $row['IncomeCode'] : NULL;
		else
			$val = $this->IncomeCode->OldValue !== NULL ? $this->IncomeCode->OldValue : $this->IncomeCode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@IncomeCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "employee_incomelist.php";
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
		if ($pageName == "employee_incomeview.php")
			return $Language->phrase("View");
		elseif ($pageName == "employee_incomeedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "employee_incomeadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "employee_incomelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("employee_incomeview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("employee_incomeview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "employee_incomeadd.php?" . $this->getUrlParm($parm);
		else
			$url = "employee_incomeadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("employee_incomeedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("employee_incomeadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("employee_incomedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "employment" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
		$json .= ",PayrollPeriod:" . JsonEncode($this->PayrollPeriod->CurrentValue, "number");
		$json .= ",IncomeCode:" . JsonEncode($this->IncomeCode->CurrentValue, "string");
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
		if ($this->EmployeeID->CurrentValue != NULL) {
			$url .= "EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->PayrollPeriod->CurrentValue != NULL) {
			$url .= "&PayrollPeriod=" . urlencode($this->PayrollPeriod->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->IncomeCode->CurrentValue != NULL) {
			$url .= "&IncomeCode=" . urlencode($this->IncomeCode->CurrentValue);
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
			if (Param("EmployeeID") !== NULL)
				$arKey[] = Param("EmployeeID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("PayrollPeriod") !== NULL)
				$arKey[] = Param("PayrollPeriod");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (Param("IncomeCode") !== NULL)
				$arKey[] = Param("IncomeCode");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 3)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // EmployeeID
					continue;
				if (!is_numeric($key[1])) // PayrollPeriod
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
				$this->EmployeeID->CurrentValue = $key[0];
			else
				$this->EmployeeID->OldValue = $key[0];
			if ($setCurrent)
				$this->PayrollPeriod->CurrentValue = $key[1];
			else
				$this->PayrollPeriod->OldValue = $key[1];
			if ($setCurrent)
				$this->IncomeCode->CurrentValue = $key[2];
			else
				$this->IncomeCode->OldValue = $key[2];
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
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->PaidPosition->setDbValue($rs->fields('PaidPosition'));
		$this->PayrollDate->setDbValue($rs->fields('PayrollDate'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
		$this->IncomeCode->setDbValue($rs->fields('IncomeCode'));
		$this->Income->setDbValue($rs->fields('Income'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
		$this->Taxable->setDbValue($rs->fields('Taxable'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// PaidPosition
		// PayrollDate
		// PayrollPeriod
		// StartDate
		// EndDate
		// IncomeCode
		// Income
		// Remarks
		// Taxable
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// PaidPosition
		$this->PaidPosition->ViewValue = $this->PaidPosition->CurrentValue;
		$curVal = strval($this->PaidPosition->CurrentValue);
		if ($curVal != "") {
			$this->PaidPosition->ViewValue = $this->PaidPosition->lookupCacheOption($curVal);
			if ($this->PaidPosition->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PaidPosition->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PaidPosition->ViewValue = $this->PaidPosition->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PaidPosition->ViewValue = $this->PaidPosition->CurrentValue;
				}
			}
		} else {
			$this->PaidPosition->ViewValue = NULL;
		}
		$this->PaidPosition->ViewCustomAttributes = "";

		// PayrollDate
		$this->PayrollDate->ViewValue = $this->PayrollDate->CurrentValue;
		$this->PayrollDate->ViewValue = FormatDateTime($this->PayrollDate->ViewValue, 0);
		$this->PayrollDate->ViewCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->ViewValue = FormatNumber($this->PayrollPeriod->ViewValue, 0, -2, -2, -2);
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// EndDate
		$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
		$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
		$this->EndDate->ViewCustomAttributes = "";

		// IncomeCode
		$curVal = strval($this->IncomeCode->CurrentValue);
		if ($curVal != "") {
			$this->IncomeCode->ViewValue = $this->IncomeCode->lookupCacheOption($curVal);
			if ($this->IncomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->IncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2);
					$arwrk[3] = FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2);
					$this->IncomeCode->ViewValue = $this->IncomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
				}
			}
		} else {
			$this->IncomeCode->ViewValue = NULL;
		}
		$this->IncomeCode->ViewCustomAttributes = "";

		// Income
		$this->Income->ViewValue = $this->Income->CurrentValue;
		$this->Income->ViewValue = FormatNumber($this->Income->ViewValue, 2, -2, -2, -2);
		$this->Income->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->ViewCustomAttributes = "";

		// Taxable
		$this->Taxable->ViewValue = $this->Taxable->CurrentValue;
		$this->Taxable->ViewValue = FormatNumber($this->Taxable->ViewValue, 0, -2, -2, -2);
		$this->Taxable->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// PaidPosition
		$this->PaidPosition->LinkCustomAttributes = "";
		$this->PaidPosition->HrefValue = "";
		$this->PaidPosition->TooltipValue = "";

		// PayrollDate
		$this->PayrollDate->LinkCustomAttributes = "";
		$this->PayrollDate->HrefValue = "";
		$this->PayrollDate->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// EndDate
		$this->EndDate->LinkCustomAttributes = "";
		$this->EndDate->HrefValue = "";
		$this->EndDate->TooltipValue = "";

		// IncomeCode
		$this->IncomeCode->LinkCustomAttributes = "";
		$this->IncomeCode->HrefValue = "";
		$this->IncomeCode->TooltipValue = "";

		// Income
		$this->Income->LinkCustomAttributes = "";
		$this->Income->HrefValue = "";
		$this->Income->TooltipValue = "";

		// Remarks
		$this->Remarks->LinkCustomAttributes = "";
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

		// Taxable
		$this->Taxable->LinkCustomAttributes = "";
		$this->Taxable->HrefValue = "";
		$this->Taxable->TooltipValue = "";

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

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// PaidPosition
		$this->PaidPosition->EditAttrs["class"] = "form-control";
		$this->PaidPosition->EditCustomAttributes = "";
		if (!$this->PaidPosition->Raw)
			$this->PaidPosition->CurrentValue = HtmlDecode($this->PaidPosition->CurrentValue);
		$this->PaidPosition->EditValue = $this->PaidPosition->CurrentValue;
		$this->PaidPosition->PlaceHolder = RemoveHtml($this->PaidPosition->caption());

		// PayrollDate
		$this->PayrollDate->EditAttrs["class"] = "form-control";
		$this->PayrollDate->EditCustomAttributes = "";
		$this->PayrollDate->EditValue = FormatDateTime($this->PayrollDate->CurrentValue, 8);
		$this->PayrollDate->PlaceHolder = RemoveHtml($this->PayrollDate->caption());

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";
		$this->PayrollPeriod->EditValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->PlaceHolder = RemoveHtml($this->PayrollPeriod->caption());

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

		// IncomeCode
		$this->IncomeCode->EditAttrs["class"] = "form-control";
		$this->IncomeCode->EditCustomAttributes = "";

		// Income
		$this->Income->EditAttrs["class"] = "form-control";
		$this->Income->EditCustomAttributes = "";
		$this->Income->EditValue = $this->Income->CurrentValue;
		$this->Income->PlaceHolder = RemoveHtml($this->Income->caption());
		if (strval($this->Income->EditValue) != "" && is_numeric($this->Income->EditValue))
			$this->Income->EditValue = FormatNumber($this->Income->EditValue, -2, -2, -2, -2);
		

		// Remarks
		$this->Remarks->EditAttrs["class"] = "form-control";
		$this->Remarks->EditCustomAttributes = "";
		$this->Remarks->EditValue = $this->Remarks->CurrentValue;
		$this->Remarks->PlaceHolder = RemoveHtml($this->Remarks->caption());

		// Taxable
		$this->Taxable->EditAttrs["class"] = "form-control";
		$this->Taxable->EditCustomAttributes = "";
		$this->Taxable->EditValue = $this->Taxable->CurrentValue;
		$this->Taxable->PlaceHolder = RemoveHtml($this->Taxable->caption());

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
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->PaidPosition);
					$doc->exportCaption($this->PayrollDate);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->Income);
					$doc->exportCaption($this->Remarks);
					$doc->exportCaption($this->Taxable);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->PaidPosition);
					$doc->exportCaption($this->PayrollDate);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->Income);
					$doc->exportCaption($this->Remarks);
					$doc->exportCaption($this->Taxable);
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
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->PaidPosition);
						$doc->exportField($this->PayrollDate);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->Income);
						$doc->exportField($this->Remarks);
						$doc->exportField($this->Taxable);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->PaidPosition);
						$doc->exportField($this->PayrollDate);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->Income);
						$doc->exportField($this->Remarks);
						$doc->exportField($this->Taxable);
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
		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();

		//set filter for province
		$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT security_matrix.ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }

		//set filter for local authority
		$la = executeRow("select count(security_matrix.LACode)as kountla 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.LACode is not null  
		and musers.username = '" . $username .     "'  ");
		if(($levelid <> -1) && ($la["kountla"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   (select DISTINCT security_matrix.LACode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }

		//set filter for departments in LA	
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid <> -1) && ($dept["kountdept"] > 0)) {
		AddFilter($filter,"`DepartmentCode`  in   (select DISTINCT security_matrix.DepartmentCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }

		//set filter for sections
		$sect = executeRow("select count(security_matrix.SectionCode)as kountsect 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.SectionCode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid <> -1) && ($sect["kountsect"] > 0)) {
		AddFilter($filter,"`SectionCode`  in   (select DISTINCT security_matrix.SectionCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
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