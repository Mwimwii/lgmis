<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for monthly_run
 */
class monthly_run extends DbTable
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
	public $LACode;
	public $PeriodCode;
	public $RunDate;
	public $RunType;
	public $Description;
	public $Year;
	public $RunMonth;
	public $PayrollCode;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'monthly_run';
		$this->TableName = 'monthly_run';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`monthly_run`";
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

		// LACode
		$this->LACode = new DbField('monthly_run', 'monthly_run', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// PeriodCode
		$this->PeriodCode = new DbField('monthly_run', 'monthly_run', 'x_PeriodCode', 'PeriodCode', '`PeriodCode`', '`PeriodCode`', 3, 11, -1, FALSE, '`PeriodCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PeriodCode->IsPrimaryKey = TRUE; // Primary key field
		$this->PeriodCode->IsForeignKey = TRUE; // Foreign key field
		$this->PeriodCode->Nullable = FALSE; // NOT NULL field
		$this->PeriodCode->Required = TRUE; // Required field
		$this->PeriodCode->Sortable = TRUE; // Allow sort
		$this->PeriodCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PeriodCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PeriodCode->Lookup = new Lookup('PeriodCode', 'payroll_period', FALSE, 'PeriodCode', ["RunDescription","FiscalYear","RunMonth",""], [], [], [], [], ["FiscalYear","RunMonth"], ["x_Year","x_RunMonth"], '', '');
		$this->PeriodCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PeriodCode'] = &$this->PeriodCode;

		// RunDate
		$this->RunDate = new DbField('monthly_run', 'monthly_run', 'x_RunDate', 'RunDate', '`RunDate`', CastDateFieldForLike("`RunDate`", 0, "DB"), 135, 19, 0, FALSE, '`RunDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RunDate->Sortable = TRUE; // Allow sort
		$this->RunDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['RunDate'] = &$this->RunDate;

		// RunType
		$this->RunType = new DbField('monthly_run', 'monthly_run', 'x_RunType', 'RunType', '`RunType`', '`RunType`', 200, 12, -1, FALSE, '`RunType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RunType->Sortable = TRUE; // Allow sort
		$this->fields['RunType'] = &$this->RunType;

		// Description
		$this->Description = new DbField('monthly_run', 'monthly_run', 'x_Description', 'Description', '`Description`', '`Description`', 200, 200, -1, FALSE, '`Description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// Year
		$this->Year = new DbField('monthly_run', 'monthly_run', 'x_Year', 'Year', '`Year`', '`Year`', 18, 4, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Year->IsForeignKey = TRUE; // Foreign key field
		$this->Year->Nullable = FALSE; // NOT NULL field
		$this->Year->Required = TRUE; // Required field
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Year->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Year->Lookup = new Lookup('Year', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year'] = &$this->Year;

		// RunMonth
		$this->RunMonth = new DbField('monthly_run', 'monthly_run', 'x_RunMonth', 'RunMonth', '`RunMonth`', '`RunMonth`', 16, 2, -1, FALSE, '`RunMonth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RunMonth->IsForeignKey = TRUE; // Foreign key field
		$this->RunMonth->Nullable = FALSE; // NOT NULL field
		$this->RunMonth->Required = TRUE; // Required field
		$this->RunMonth->Sortable = TRUE; // Allow sort
		$this->RunMonth->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RunMonth->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RunMonth->Lookup = new Lookup('RunMonth', 'month_ref', FALSE, 'MonthCode', ["MonthShort","","",""], [], [], [], [], [], [], '', '');
		$this->RunMonth->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RunMonth'] = &$this->RunMonth;

		// PayrollCode
		$this->PayrollCode = new DbField('monthly_run', 'monthly_run', 'x_PayrollCode', 'PayrollCode', '`PayrollCode`', '`PayrollCode`', 3, 11, -1, FALSE, '`PayrollCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollCode->Nullable = FALSE; // NOT NULL field
		$this->PayrollCode->Required = TRUE; // Required field
		$this->PayrollCode->Sortable = TRUE; // Allow sort
		$this->PayrollCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollCode'] = &$this->PayrollCode;
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
		if ($this->getCurrentMasterTable() == "payroll_period") {
			if ($this->PeriodCode->getSessionValue() != "")
				$masterFilter .= "`PeriodCode`=" . QuotedValue($this->PeriodCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->Year->getSessionValue() != "")
				$masterFilter .= " AND `FiscalYear`=" . QuotedValue($this->Year->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->RunMonth->getSessionValue() != "")
				$masterFilter .= " AND `RunMonth`=" . QuotedValue($this->RunMonth->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "payroll_period") {
			if ($this->PeriodCode->getSessionValue() != "")
				$detailFilter .= "`PeriodCode`=" . QuotedValue($this->PeriodCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->Year->getSessionValue() != "")
				$detailFilter .= " AND `Year`=" . QuotedValue($this->Year->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->RunMonth->getSessionValue() != "")
				$detailFilter .= " AND `RunMonth`=" . QuotedValue($this->RunMonth->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_payroll_period()
	{
		return "`PeriodCode`=@PeriodCode@ AND `FiscalYear`=@FiscalYear@ AND `RunMonth`=@RunMonth@";
	}

	// Detail filter
	public function sqlDetailFilter_payroll_period()
	{
		return "`PeriodCode`=@PeriodCode@ AND `Year`=@Year@ AND `RunMonth`=@RunMonth@";
	}

	// Master filter
	public function sqlMasterFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
	}

	// Detail filter
	public function sqlDetailFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`monthly_run`";
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
			$fldname = 'LACode';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'PeriodCode';
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
			if (array_key_exists('LACode', $rs))
				AddFilter($where, QuotedName('LACode', $this->Dbid) . '=' . QuotedValue($rs['LACode'], $this->LACode->DataType, $this->Dbid));
			if (array_key_exists('PeriodCode', $rs))
				AddFilter($where, QuotedName('PeriodCode', $this->Dbid) . '=' . QuotedValue($rs['PeriodCode'], $this->PeriodCode->DataType, $this->Dbid));
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
		$this->LACode->DbValue = $row['LACode'];
		$this->PeriodCode->DbValue = $row['PeriodCode'];
		$this->RunDate->DbValue = $row['RunDate'];
		$this->RunType->DbValue = $row['RunType'];
		$this->Description->DbValue = $row['Description'];
		$this->Year->DbValue = $row['Year'];
		$this->RunMonth->DbValue = $row['RunMonth'];
		$this->PayrollCode->DbValue = $row['PayrollCode'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`LACode` = '@LACode@' AND `PeriodCode` = @PeriodCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('LACode', $row) ? $row['LACode'] : NULL;
		else
			$val = $this->LACode->OldValue !== NULL ? $this->LACode->OldValue : $this->LACode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LACode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('PeriodCode', $row) ? $row['PeriodCode'] : NULL;
		else
			$val = $this->PeriodCode->OldValue !== NULL ? $this->PeriodCode->OldValue : $this->PeriodCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@PeriodCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "monthly_runlist.php";
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
		if ($pageName == "monthly_runview.php")
			return $Language->phrase("View");
		elseif ($pageName == "monthly_runedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "monthly_runadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "monthly_runlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("monthly_runview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("monthly_runview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "monthly_runadd.php?" . $this->getUrlParm($parm);
		else
			$url = "monthly_runadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("monthly_runedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("monthly_runadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("monthly_rundelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "payroll_period" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_PeriodCode=" . urlencode($this->PeriodCode->CurrentValue);
			$url .= "&fk_FiscalYear=" . urlencode($this->Year->CurrentValue);
			$url .= "&fk_RunMonth=" . urlencode($this->RunMonth->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "local_authority" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
		$json .= ",PeriodCode:" . JsonEncode($this->PeriodCode->CurrentValue, "number");
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
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "LACode=" . urlencode($this->LACode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->PeriodCode->CurrentValue != NULL) {
			$url .= "&PeriodCode=" . urlencode($this->PeriodCode->CurrentValue);
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
			if (Param("LACode") !== NULL)
				$arKey[] = Param("LACode");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("PeriodCode") !== NULL)
				$arKey[] = Param("PeriodCode");
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
				if (!is_numeric($key[1])) // PeriodCode
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
				$this->LACode->CurrentValue = $key[0];
			else
				$this->LACode->OldValue = $key[0];
			if ($setCurrent)
				$this->PeriodCode->CurrentValue = $key[1];
			else
				$this->PeriodCode->OldValue = $key[1];
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
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->PeriodCode->setDbValue($rs->fields('PeriodCode'));
		$this->RunDate->setDbValue($rs->fields('RunDate'));
		$this->RunType->setDbValue($rs->fields('RunType'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->RunMonth->setDbValue($rs->fields('RunMonth'));
		$this->PayrollCode->setDbValue($rs->fields('PayrollCode'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LACode
		// PeriodCode
		// RunDate
		// RunType
		// Description
		// Year
		// RunMonth
		// PayrollCode
		// LACode

		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$curVal = strval($this->LACode->CurrentValue);
		if ($curVal != "") {
			$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
			if ($this->LACode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LACode->ViewValue = $this->LACode->CurrentValue;
				}
			}
		} else {
			$this->LACode->ViewValue = NULL;
		}
		$this->LACode->ViewCustomAttributes = "";

		// PeriodCode
		$curVal = strval($this->PeriodCode->CurrentValue);
		if ($curVal != "") {
			$this->PeriodCode->ViewValue = $this->PeriodCode->lookupCacheOption($curVal);
			if ($this->PeriodCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PeriodCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->PeriodCode->ViewValue = $this->PeriodCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PeriodCode->ViewValue = $this->PeriodCode->CurrentValue;
				}
			}
		} else {
			$this->PeriodCode->ViewValue = NULL;
		}
		$this->PeriodCode->ViewCustomAttributes = "";

		// RunDate
		$this->RunDate->ViewValue = $this->RunDate->CurrentValue;
		$this->RunDate->ViewValue = FormatDateTime($this->RunDate->ViewValue, 0);
		$this->RunDate->ViewCustomAttributes = "";

		// RunType
		$this->RunType->ViewValue = $this->RunType->CurrentValue;
		$this->RunType->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// Year
		$curVal = strval($this->Year->CurrentValue);
		if ($curVal != "") {
			$this->Year->ViewValue = $this->Year->lookupCacheOption($curVal);
			if ($this->Year->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Year->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Year->ViewValue = $this->Year->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Year->ViewValue = $this->Year->CurrentValue;
				}
			}
		} else {
			$this->Year->ViewValue = NULL;
		}
		$this->Year->ViewCustomAttributes = "";

		// RunMonth
		$curVal = strval($this->RunMonth->CurrentValue);
		if ($curVal != "") {
			$this->RunMonth->ViewValue = $this->RunMonth->lookupCacheOption($curVal);
			if ($this->RunMonth->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MonthCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->RunMonth->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RunMonth->ViewValue = $this->RunMonth->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RunMonth->ViewValue = $this->RunMonth->CurrentValue;
				}
			}
		} else {
			$this->RunMonth->ViewValue = NULL;
		}
		$this->RunMonth->ViewCustomAttributes = "";

		// PayrollCode
		$this->PayrollCode->ViewValue = $this->PayrollCode->CurrentValue;
		$this->PayrollCode->ViewValue = FormatNumber($this->PayrollCode->ViewValue, 0, -2, -2, -2);
		$this->PayrollCode->ViewCustomAttributes = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// PeriodCode
		$this->PeriodCode->LinkCustomAttributes = "";
		$this->PeriodCode->HrefValue = "";
		$this->PeriodCode->TooltipValue = "";

		// RunDate
		$this->RunDate->LinkCustomAttributes = "";
		$this->RunDate->HrefValue = "";
		$this->RunDate->TooltipValue = "";

		// RunType
		$this->RunType->LinkCustomAttributes = "";
		$this->RunType->HrefValue = "";
		$this->RunType->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// Year
		$this->Year->LinkCustomAttributes = "";
		$this->Year->HrefValue = "";
		$this->Year->TooltipValue = "";

		// RunMonth
		$this->RunMonth->LinkCustomAttributes = "";
		$this->RunMonth->HrefValue = "";
		$this->RunMonth->TooltipValue = "";

		// PayrollCode
		$this->PayrollCode->LinkCustomAttributes = "";
		$this->PayrollCode->HrefValue = "";
		$this->PayrollCode->TooltipValue = "";

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

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if (!$this->LACode->Raw)
			$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// PeriodCode
		$this->PeriodCode->EditAttrs["class"] = "form-control";
		$this->PeriodCode->EditCustomAttributes = "";

		// RunDate
		$this->RunDate->EditAttrs["class"] = "form-control";
		$this->RunDate->EditCustomAttributes = "";
		$this->RunDate->EditValue = FormatDateTime($this->RunDate->CurrentValue, 8);
		$this->RunDate->PlaceHolder = RemoveHtml($this->RunDate->caption());

		// RunType
		$this->RunType->EditAttrs["class"] = "form-control";
		$this->RunType->EditCustomAttributes = "";
		if (!$this->RunType->Raw)
			$this->RunType->CurrentValue = HtmlDecode($this->RunType->CurrentValue);
		$this->RunType->EditValue = $this->RunType->CurrentValue;
		$this->RunType->PlaceHolder = RemoveHtml($this->RunType->caption());

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		if (!$this->Description->Raw)
			$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		if ($this->Year->getSessionValue() != "") {
			$this->Year->CurrentValue = $this->Year->getSessionValue();
			$curVal = strval($this->Year->CurrentValue);
			if ($curVal != "") {
				$this->Year->ViewValue = $this->Year->lookupCacheOption($curVal);
				if ($this->Year->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Year->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Year->ViewValue = $this->Year->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Year->ViewValue = $this->Year->CurrentValue;
					}
				}
			} else {
				$this->Year->ViewValue = NULL;
			}
			$this->Year->ViewCustomAttributes = "";
		} else {
		}

		// RunMonth
		$this->RunMonth->EditAttrs["class"] = "form-control";
		$this->RunMonth->EditCustomAttributes = "";
		if ($this->RunMonth->getSessionValue() != "") {
			$this->RunMonth->CurrentValue = $this->RunMonth->getSessionValue();
			$curVal = strval($this->RunMonth->CurrentValue);
			if ($curVal != "") {
				$this->RunMonth->ViewValue = $this->RunMonth->lookupCacheOption($curVal);
				if ($this->RunMonth->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MonthCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RunMonth->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RunMonth->ViewValue = $this->RunMonth->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RunMonth->ViewValue = $this->RunMonth->CurrentValue;
					}
				}
			} else {
				$this->RunMonth->ViewValue = NULL;
			}
			$this->RunMonth->ViewCustomAttributes = "";
		} else {
		}

		// PayrollCode
		$this->PayrollCode->EditAttrs["class"] = "form-control";
		$this->PayrollCode->EditCustomAttributes = "";
		$this->PayrollCode->EditValue = $this->PayrollCode->CurrentValue;
		$this->PayrollCode->PlaceHolder = RemoveHtml($this->PayrollCode->caption());

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
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PeriodCode);
					$doc->exportCaption($this->RunDate);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->RunMonth);
					$doc->exportCaption($this->PayrollCode);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PeriodCode);
					$doc->exportCaption($this->RunDate);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->RunMonth);
					$doc->exportCaption($this->PayrollCode);
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
						$doc->exportField($this->LACode);
						$doc->exportField($this->PeriodCode);
						$doc->exportField($this->RunDate);
						$doc->exportField($this->Description);
						$doc->exportField($this->Year);
						$doc->exportField($this->RunMonth);
						$doc->exportField($this->PayrollCode);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->PeriodCode);
						$doc->exportField($this->RunDate);
						$doc->exportField($this->Description);
						$doc->exportField($this->Year);
						$doc->exportField($this->RunMonth);
						$doc->exportField($this->PayrollCode);
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
		$table = 'monthly_run';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'monthly_run';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PeriodCode'];

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
		$table = 'monthly_run';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['PeriodCode'];

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
		$table = 'monthly_run';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PeriodCode'];

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
		$lcode = $rsnew["LACode"];
		$yr = $rsnew["Year"];
		$mon = $rsnew["RunMonth"];
		$dt = $rsnew["RunDate"];

		//die(strval($lcode));
		execute("INSERT INTO `leave_accrued_trans` (
	  `Year`,  `RunMonth`,  `EmployeeID`,  LACode, `LeaveTypeCode`,  `LeaveAccrued`,
	   `LastAccrualDate`)
	  	select '" . $yr . "','" . $mon . "', `employment`.`EmployeeID`
		, `employment`.`LACode` , `leave_accrual_ref`.`LeaveTypeCode`
		, `leave_accrual_ref`.`AnnualEntitled` /12, curdate()
		FROM
		.`salary_scale`
		INNER JOIN `employment` 
			ON (`salary_scale`.`SalaryScale` = `employment`.`SalaryScale`)
		INNER JOIN `leave_accrual_ref` 
			ON (`salary_scale`.`Division` = `leave_accrual_ref`.`Division`)
			WHERE LACode = '" . $lcode . "'	AND EmploymentStatus = 1");

	// add new employees into leave record
		execute("insert into leave_record(EmployeeID,LeaveTypeCode)
		select employeeid,1 from employment where employeeid not in
		(select employeeid from leave_record)");
		execute("Update leave_record, salary_scale, employment, leave_accrual_ref set
		leave_record.OpeningBalance = leave_record.OpeningBalance + leave_record.LeaveAccrued,
		leave_record.LeaveAccrued = `leave_accrual_ref`.`AnnualEntitled` /12,
		leave_record.LastAccrualDate = current_date()
		where employment.EmployeeId = leave_record.EmployeeID
		and leave_accrual_ref.LeaveTypeCode = leave_record.LeaveTypeCode
		and `salary_scale`.`SalaryScale` = `employment`.`SalaryScale`
		and `salary_scale`.`Division` = `leave_accrual_ref`.`Division`
		and LACode = '" . $lcode . "'	AND EmploymentStatus = 1");

		//get calculated incomes
		execute("INSERT INTO `employee_income` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,   `IncomeCode`,  `Income`, Taxable)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`income_type`.`IncomeCode`,
		`income_type`.`IncomeBasicRate` * `employment`.`BasicMonthlySalary` AS Income, income_type.Taxable
		FROM `employment`, salary_scale, income_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() <= `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND INSTR(income_type.`Division`,salary_scale.Division) > 0
		AND IF(income_type.JobIncluded IS NOT NULL, FIND_IN_SET(position_ref.JobCode,income_type.JobIncluded) > 0 ,TRUE)
		AND IF(income_type.JobExcluded IS NOT NULL, FIND_IN_SET(position_ref.JobCode,income_type.JobExcluded) = 0 ,TRUE)
		AND income_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND income_type.`IncomeAmount` = 0
		AND income_type.`IncomeBasicRate` > 0");

		//get fixed incomes; Only pick for current period set to 1 ie Yes
		execute("INSERT INTO `employee_income` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,   `IncomeCode`,  `Income`, Taxable)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`income_type`.`IncomeCode`,`income_type`.`IncomeAmount` AS Income, income_type.Taxable
		FROM `employment`, salary_scale, income_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND INSTR(income_type.`Division`,salary_scale.Division) > 0
		AND IF(income_type.JobIncluded IS NOT NULL, FIND_IN_SET(position_ref.JobCode,income_type.JobIncluded) > 0 ,TRUE)
		AND IF(income_type.JobExcluded IS NOT NULL, FIND_IN_SET(position_ref.JobCode,income_type.JobExcluded) = 0 ,TRUE)
		AND income_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1   
		AND income_type.`IncomeAmount` > 0
		AND income_type.`IncomeBasicRate` = 0");

		// get claimed incomes
		execute("INSERT INTO `employee_income` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,   `IncomeCode`,  `Income`, `Remarks`, Taxable)
		SELECT   `EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `IncomeCode`,  `Income`,  `Remarks`,Taxable
		FROM `emp_income_claim`, payroll_period  WHERE emp_income_claim.`PayrollPeriod` = payroll_period.`PeriodCode`
		AND payroll_period.`CurrentPeriod` = 1");

	//get calculated deductions except tax exempt ones
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `DeductionCode`,  `DeductionAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionBasicRate` * `employment`.`BasicMonthlySalary` AS Deduction
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND deduction_type.TaxExempt <> 1
		AND FIND_IN_SET(salary_scale.Division, deduction_type.`Division`) > 0
		AND FIND_IN_SET(deduction_type.`DeductionCode`, employment.`ThirdParties`) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` = 0
		AND deduction_type.`DeductionBasicRate` > 0
		AND deduction_type.`DeductionCode` <> 9002");

	//get tax exempt deductions such pensions
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `DeductionCode`,  `DeductionAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionBasicRate` * `employment`.`BasicMonthlySalary` AS Deduction
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND FIND_IN_SET(deduction_type.`DeductionCode`, employment.`ThirdParties`) > 0
		AND deduction_type.TaxExempt = 1
		AND deduction_type.`DeductionCode` <> '9002'
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` = 0
		AND deduction_type.`DeductionBasicRate` > 0");

	//NAPSA on gross pay, NAPSA is not tax exempt
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `DeductionCode`,  `DeductionAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionBasicRate` * SUM(`employee_income`.`income`) AS Deduction
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period, employee_income, income_type
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND FIND_IN_SET(deduction_type.`DeductionCode`, employment.`ThirdParties`) > 0
		AND deduction_type.`DeductionCode` = '9002'
		AND employee_income.IncomeCode = income_type.IncomeCode
		AND income_type.Taxable = 1
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` = 0
		AND deduction_type.`DeductionBasicRate` > 0
		AND employment.`EmployeeID` = employee_income.`EmployeeID`
		AND payroll_period.`PeriodCode` = employee_income.`PayrollPeriod`
		GROUP BY employee_income.employeeID, employee_income.`PayrollPeriod`");

	//get fixed deductions
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `DeductionCode`,  `DeductionAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionAmount` AS Deduction
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND deduction_type.TaxExempt <> 1
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` > 0
		AND deduction_type.`DeductionBasicRate` = 0");

		//tax exempt
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `DeductionCode`,  `DeductionAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionAmount` AS Deduction
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND FIND_IN_SET(deduction_type.`DeductionCode`, employment.`ThirdParties`) > 0
		AND deduction_type.TaxExempt = 1
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` > 0
		AND deduction_type.`DeductionBasicRate` = 0");

		//get claimed deductions
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `StartDate`,  `Enddate`,  `DeductionCode`,  `DeductionAmount`,
		`Remarks`)
		SELECT    `EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `StartDate`,  `Enddate`,  `DeductionCode`,  `DeductionAmount`,  `Remarks`
		FROM 	`emp_deduction_claim`, payroll_period  WHERE `emp_deduction_claim`.`PayrollPeriod` = payroll_period.`PeriodCode` 
		AND payroll_period.`CurrentPeriod` = 1");

		//get PAYE
		$paye = executeRows("Select * from paye_rates");
		$nr = sizeof($paye);
		$prevbandval = 0;
		for ($i=0; $i<count($paye); $i++) {
			$payemax = $paye[$i]["MaximumIncome"];
			$payemin = $paye[$i]["MinimumIncome"];
			$rate = $paye[$i]["PAYERate"];
			$payeband = $paye[$i]["band"];
			$bandval = ($payemax - $payemin);
			$taxval = ($payemax - $payemin) * $rate;
			if ($payemax > $payemin) {
			$prevbandval = $bandval; // keep previous band for final calculation 
			}

			//die(strval($bandval));
		execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`, `DeductionCode`,  `DeductionAmount`,
		`Remarks`, DeductionBand)
		SELECT   `EmployeeID`,  `PaidPosition`, `PayrollDate`,   `PayrollPeriod`,    '9001', 
		IF((SUM(TotalIncome) - SUM(TaxExemptAmt)- '" . $payemin . "') > '" . $bandval . "', '" . $taxval . "',
		((SUM(TotalIncome) - SUM(TaxExemptAmt)- $payemin) * $rate)) AS DeductionAmount,
		 (SUM(TotalIncome) - SUM(TaxExemptAmt)) AS Remarks, '" . $payeband . "'
		FROM taxable_income_view
		GROUP BY `EmployeeID`,     `PayrollPeriod`  HAVING DeductionAmount > 0");

	/*	if ($payemax== $payemin){
		 execute("INSERT INTO `employee_deduction` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`, `DeductionCode`,  `DeductionAmount`,
		`Remarks`, DeductionBand)
		SELECT   `EmployeeID`,  `PaidPosition`, `PayrollDate`,   `PayrollPeriod`,    '9001', 
		IF((SUM(TotalIncome) - SUM(TaxExemptAmt) - '" . $payemax . "') > '" . $prevbandval . "' , (SUM(TotalIncome) - SUM(TaxExemptAmt) - '" . $payemax . "')
		 * '" . $rate  . "',0) as DeductionAmount,
		 SUM(`TotalIncome`) AS Remarks, '" . $payeband . "' 
		FROM taxable_income_view
		GROUP BY `EmployeeID`,     `PayrollPeriod` HAVING DeductionAmount > 0"); 
			} */
		} // end for loop
		//get calculated obligations
		execute("INSERT INTO `employee_obligation` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `ObligationCode`,  `ObligationAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`EmployerContributionRate` * `employment`.`BasicMonthlySalary` AS Obligation
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.TaxExempt <> 1
		AND deduction_type.`DeductionCode` <> '9002'
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`EmployerContributionRate` > 0");
		execute("INSERT INTO `employee_obligation` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `ObligationCode`,  `ObligationAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`DeductionBasicRate` * SUM(`employee_income`.`income`) AS Obligation
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period, employee_income
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND FIND_IN_SET(deduction_type.`DeductionCode`, employment.`ThirdParties`) > 0
		AND deduction_type.TaxExempt = 1
		AND deduction_type.`DeductionCode` = '9002'
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`DeductionAmount` = 0
		AND deduction_type.`DeductionBasicRate` > 0
		AND employment.`EmployeeID` = employee_income.`EmployeeID`
		AND payroll_period.`PeriodCode` = employee_income.`PayrollPeriod`
		GROUP BY employee_income.employeeID, employee_income.`PayrollPeriod`");
	//get fixed obligations
		execute("INSERT INTO `employee_obligation` (
		`EmployeeID`,  `PaidPosition`,  `PayrollDate`,  `PayrollPeriod`,  `ObligationCode`,  `ObligationAmount`)
		SELECT`employment`.`EmployeeID`, `employment`.`SubstantivePosition`, CURRENT_DATE(),payroll_period.`PeriodCode`,
		`deduction_type`.`DeductionCode`,`deduction_type`.`EmployerContributionAmount` AS Obligation
		FROM `employment`, salary_scale, deduction_type , position_ref, payroll_period
		WHERE employment.`EmploymentStatus` IN (1,4)
		AND employment.`SubstantivePosition` = position_ref.`PositionCode`
		AND CURRENT_DATE() < `employment`.`DateOfExit`
		AND LAST_DAY(STR_TO_DATE(CONCAT('01-',payroll_period.RunMonth,'-', payroll_period.FiscalYear),'%d-%m-%Y')) >= `employment`.`DateOfCurrentAppointment` 
		AND employment.`SalaryScale` = salary_scale.`SalaryScale`
		AND INSTR(deduction_type.`Division`,salary_scale.Division) > 0
		AND deduction_type.Application = 1
		AND payroll_period.`CurrentPeriod` = 1
		AND deduction_type.`EmployerContributionAmount` > 0");
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
		$period = $rs["PeriodCode"];
		//die(strval($period));
		$cur = executeScalar("select CurrentPeriod from payroll_period where PeriodCode = '" . $period . "'");
		if($cur == 1) {
		execute("DELETE FROM employee_income WHERE PayrollPeriod in (select PeriodCode from payroll_period where CurrentPeriod =1)");
		execute("DELETE FROM employee_deduction WHERE PayrollPeriod in (select PeriodCode from payroll_period where CurrentPeriod =1)");
		execute("DELETE FROM employee_obligation WHERE PayrollPeriod in (select PeriodCode from payroll_period where CurrentPeriod =1)");
		execute("UPDATE leave_record SET leave_record.LeaveAccrued = 0");
		}
		if($cur == 0) {
		 $this->CancelMessage =  "Payroll period must be current, sey to yes for any transactions to pass." ;
		 return FALSE;
		 }
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