<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for leave_record
 */
class leave_record extends DbTable
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
	public $EmployeeID;
	public $LeaveTypeCode;
	public $EffectiveDate;
	public $OpeningBalance;
	public $LeaveAccrued;
	public $LastAccrualDate;
	public $LeaveTaken;
	public $LeaveCommuted;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'leave_record';
		$this->TableName = 'leave_record';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`leave_record`";
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
		$this->EmployeeID = new DbField('leave_record', 'leave_record', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// LeaveTypeCode
		$this->LeaveTypeCode = new DbField('leave_record', 'leave_record', 'x_LeaveTypeCode', 'LeaveTypeCode', '`LeaveTypeCode`', '`LeaveTypeCode`', 16, 4, -1, FALSE, '`LeaveTypeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LeaveTypeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->LeaveTypeCode->Nullable = FALSE; // NOT NULL field
		$this->LeaveTypeCode->Required = TRUE; // Required field
		$this->LeaveTypeCode->Sortable = TRUE; // Allow sort
		$this->LeaveTypeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LeaveTypeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LeaveTypeCode->Lookup = new Lookup('LeaveTypeCode', 'leave_type', FALSE, 'LeaveTypeCode', ["LeaveTypeName","","",""], [], [], [], [], [], [], '', '');
		$this->LeaveTypeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LeaveTypeCode'] = &$this->LeaveTypeCode;

		// EffectiveDate
		$this->EffectiveDate = new DbField('leave_record', 'leave_record', 'x_EffectiveDate', 'EffectiveDate', '`EffectiveDate`', CastDateFieldForLike("`EffectiveDate`", 0, "DB"), 133, 10, 0, FALSE, '`EffectiveDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EffectiveDate->Sortable = TRUE; // Allow sort
		$this->EffectiveDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EffectiveDate'] = &$this->EffectiveDate;

		// OpeningBalance
		$this->OpeningBalance = new DbField('leave_record', 'leave_record', 'x_OpeningBalance', 'OpeningBalance', '`OpeningBalance`', '`OpeningBalance`', 5, 22, -1, FALSE, '`OpeningBalance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OpeningBalance->Sortable = TRUE; // Allow sort
		$this->OpeningBalance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['OpeningBalance'] = &$this->OpeningBalance;

		// LeaveAccrued
		$this->LeaveAccrued = new DbField('leave_record', 'leave_record', 'x_LeaveAccrued', 'LeaveAccrued', '`LeaveAccrued`', '`LeaveAccrued`', 5, 22, -1, FALSE, '`LeaveAccrued`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LeaveAccrued->Sortable = TRUE; // Allow sort
		$this->LeaveAccrued->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LeaveAccrued'] = &$this->LeaveAccrued;

		// LastAccrualDate
		$this->LastAccrualDate = new DbField('leave_record', 'leave_record', 'x_LastAccrualDate', 'LastAccrualDate', '`LastAccrualDate`', CastDateFieldForLike("`LastAccrualDate`", 0, "DB"), 133, 10, 0, FALSE, '`LastAccrualDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastAccrualDate->Sortable = TRUE; // Allow sort
		$this->LastAccrualDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastAccrualDate'] = &$this->LastAccrualDate;

		// LeaveTaken
		$this->LeaveTaken = new DbField('leave_record', 'leave_record', 'x_LeaveTaken', 'LeaveTaken', '`LeaveTaken`', '`LeaveTaken`', 5, 22, -1, FALSE, '`LeaveTaken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LeaveTaken->Sortable = TRUE; // Allow sort
		$this->LeaveTaken->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LeaveTaken'] = &$this->LeaveTaken;

		// LeaveCommuted
		$this->LeaveCommuted = new DbField('leave_record', 'leave_record', 'x_LeaveCommuted', 'LeaveCommuted', '`LeaveCommuted`', '`LeaveCommuted`', 5, 22, -1, FALSE, '`LeaveCommuted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LeaveCommuted->Sortable = TRUE; // Allow sort
		$this->LeaveCommuted->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LeaveCommuted'] = &$this->LeaveCommuted;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`leave_record`";
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
			$fldname = 'EmployeeID';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'LeaveTypeCode';
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
			if (array_key_exists('EmployeeID', $rs))
				AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
			if (array_key_exists('LeaveTypeCode', $rs))
				AddFilter($where, QuotedName('LeaveTypeCode', $this->Dbid) . '=' . QuotedValue($rs['LeaveTypeCode'], $this->LeaveTypeCode->DataType, $this->Dbid));
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->LeaveTypeCode->DbValue = $row['LeaveTypeCode'];
		$this->EffectiveDate->DbValue = $row['EffectiveDate'];
		$this->OpeningBalance->DbValue = $row['OpeningBalance'];
		$this->LeaveAccrued->DbValue = $row['LeaveAccrued'];
		$this->LastAccrualDate->DbValue = $row['LastAccrualDate'];
		$this->LeaveTaken->DbValue = $row['LeaveTaken'];
		$this->LeaveCommuted->DbValue = $row['LeaveCommuted'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `LeaveTypeCode` = @LeaveTypeCode@";
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
			$val = array_key_exists('LeaveTypeCode', $row) ? $row['LeaveTypeCode'] : NULL;
		else
			$val = $this->LeaveTypeCode->OldValue !== NULL ? $this->LeaveTypeCode->OldValue : $this->LeaveTypeCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LeaveTypeCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "leave_recordlist.php";
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
		if ($pageName == "leave_recordview.php")
			return $Language->phrase("View");
		elseif ($pageName == "leave_recordedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "leave_recordadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "leave_recordlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("leave_recordview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("leave_recordview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "leave_recordadd.php?" . $this->getUrlParm($parm);
		else
			$url = "leave_recordadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("leave_recordedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("leave_recordadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("leave_recorddelete.php", $this->getUrlParm());
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
		$json .= ",LeaveTypeCode:" . JsonEncode($this->LeaveTypeCode->CurrentValue, "number");
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
		if ($this->LeaveTypeCode->CurrentValue != NULL) {
			$url .= "&LeaveTypeCode=" . urlencode($this->LeaveTypeCode->CurrentValue);
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
			if (Param("LeaveTypeCode") !== NULL)
				$arKey[] = Param("LeaveTypeCode");
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
				if (!is_numeric($key[0])) // EmployeeID
					continue;
				if (!is_numeric($key[1])) // LeaveTypeCode
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
				$this->LeaveTypeCode->CurrentValue = $key[1];
			else
				$this->LeaveTypeCode->OldValue = $key[1];
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
		$this->LeaveTypeCode->setDbValue($rs->fields('LeaveTypeCode'));
		$this->EffectiveDate->setDbValue($rs->fields('EffectiveDate'));
		$this->OpeningBalance->setDbValue($rs->fields('OpeningBalance'));
		$this->LeaveAccrued->setDbValue($rs->fields('LeaveAccrued'));
		$this->LastAccrualDate->setDbValue($rs->fields('LastAccrualDate'));
		$this->LeaveTaken->setDbValue($rs->fields('LeaveTaken'));
		$this->LeaveCommuted->setDbValue($rs->fields('LeaveCommuted'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// LeaveTypeCode
		// EffectiveDate
		// OpeningBalance
		// LeaveAccrued
		// LastAccrualDate
		// LeaveTaken

		$this->LeaveTaken->CellCssStyle = "white-space: nowrap;";

		// LeaveCommuted
		$this->LeaveCommuted->CellCssStyle = "white-space: nowrap;";

		// EmployeeID
		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// LeaveTypeCode
		$curVal = strval($this->LeaveTypeCode->CurrentValue);
		if ($curVal != "") {
			$this->LeaveTypeCode->ViewValue = $this->LeaveTypeCode->lookupCacheOption($curVal);
			if ($this->LeaveTypeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LeaveTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->LeaveTypeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LeaveTypeCode->ViewValue = $this->LeaveTypeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LeaveTypeCode->ViewValue = $this->LeaveTypeCode->CurrentValue;
				}
			}
		} else {
			$this->LeaveTypeCode->ViewValue = NULL;
		}
		$this->LeaveTypeCode->ViewCustomAttributes = "";

		// EffectiveDate
		$this->EffectiveDate->ViewValue = $this->EffectiveDate->CurrentValue;
		$this->EffectiveDate->ViewValue = FormatDateTime($this->EffectiveDate->ViewValue, 0);
		$this->EffectiveDate->ViewCustomAttributes = "";

		// OpeningBalance
		$this->OpeningBalance->ViewValue = $this->OpeningBalance->CurrentValue;
		$this->OpeningBalance->ViewValue = FormatNumber($this->OpeningBalance->ViewValue, 2, -2, -2, -2);
		$this->OpeningBalance->CellCssStyle .= "text-align: right;";
		$this->OpeningBalance->ViewCustomAttributes = "";

		// LeaveAccrued
		$this->LeaveAccrued->ViewValue = $this->LeaveAccrued->CurrentValue;
		$this->LeaveAccrued->ViewValue = FormatNumber($this->LeaveAccrued->ViewValue, 2, -1, -2, -2);
		$this->LeaveAccrued->CellCssStyle .= "text-align: right;";
		$this->LeaveAccrued->ViewCustomAttributes = "";

		// LastAccrualDate
		$this->LastAccrualDate->ViewValue = $this->LastAccrualDate->CurrentValue;
		$this->LastAccrualDate->ViewValue = FormatDateTime($this->LastAccrualDate->ViewValue, 0);
		$this->LastAccrualDate->ViewCustomAttributes = "";

		// LeaveTaken
		$this->LeaveTaken->ViewValue = $this->LeaveTaken->CurrentValue;
		$this->LeaveTaken->ViewValue = FormatNumber($this->LeaveTaken->ViewValue, 2, -2, -2, -2);
		$this->LeaveTaken->ViewCustomAttributes = "";

		// LeaveCommuted
		$this->LeaveCommuted->ViewValue = $this->LeaveCommuted->CurrentValue;
		$this->LeaveCommuted->ViewValue = FormatNumber($this->LeaveCommuted->ViewValue, 2, -2, -2, -2);
		$this->LeaveCommuted->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// LeaveTypeCode
		$this->LeaveTypeCode->LinkCustomAttributes = "";
		$this->LeaveTypeCode->HrefValue = "";
		$this->LeaveTypeCode->TooltipValue = "";

		// EffectiveDate
		$this->EffectiveDate->LinkCustomAttributes = "";
		$this->EffectiveDate->HrefValue = "";
		$this->EffectiveDate->TooltipValue = "";

		// OpeningBalance
		$this->OpeningBalance->LinkCustomAttributes = "";
		$this->OpeningBalance->HrefValue = "";
		$this->OpeningBalance->TooltipValue = "";

		// LeaveAccrued
		$this->LeaveAccrued->LinkCustomAttributes = "";
		$this->LeaveAccrued->HrefValue = "";
		$this->LeaveAccrued->TooltipValue = "";

		// LastAccrualDate
		$this->LastAccrualDate->LinkCustomAttributes = "";
		$this->LastAccrualDate->HrefValue = "";
		$this->LastAccrualDate->TooltipValue = "";

		// LeaveTaken
		$this->LeaveTaken->LinkCustomAttributes = "";
		$this->LeaveTaken->HrefValue = "";
		$this->LeaveTaken->TooltipValue = "";

		// LeaveCommuted
		$this->LeaveCommuted->LinkCustomAttributes = "";
		$this->LeaveCommuted->HrefValue = "";
		$this->LeaveCommuted->TooltipValue = "";

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

		// LeaveTypeCode
		$this->LeaveTypeCode->EditAttrs["class"] = "form-control";
		$this->LeaveTypeCode->EditCustomAttributes = "";

		// EffectiveDate
		$this->EffectiveDate->EditAttrs["class"] = "form-control";
		$this->EffectiveDate->EditCustomAttributes = "";
		$this->EffectiveDate->EditValue = FormatDateTime($this->EffectiveDate->CurrentValue, 8);
		$this->EffectiveDate->PlaceHolder = RemoveHtml($this->EffectiveDate->caption());

		// OpeningBalance
		$this->OpeningBalance->EditAttrs["class"] = "form-control";
		$this->OpeningBalance->EditCustomAttributes = "";
		$this->OpeningBalance->EditValue = $this->OpeningBalance->CurrentValue;
		$this->OpeningBalance->PlaceHolder = RemoveHtml($this->OpeningBalance->caption());
		if (strval($this->OpeningBalance->EditValue) != "" && is_numeric($this->OpeningBalance->EditValue))
			$this->OpeningBalance->EditValue = FormatNumber($this->OpeningBalance->EditValue, -2, -2, -2, -2);
		

		// LeaveAccrued
		$this->LeaveAccrued->EditAttrs["class"] = "form-control";
		$this->LeaveAccrued->EditCustomAttributes = "";
		$this->LeaveAccrued->EditValue = $this->LeaveAccrued->CurrentValue;
		$this->LeaveAccrued->PlaceHolder = RemoveHtml($this->LeaveAccrued->caption());
		if (strval($this->LeaveAccrued->EditValue) != "" && is_numeric($this->LeaveAccrued->EditValue))
			$this->LeaveAccrued->EditValue = FormatNumber($this->LeaveAccrued->EditValue, -2, -1, -2, -2);
		

		// LastAccrualDate
		$this->LastAccrualDate->EditAttrs["class"] = "form-control";
		$this->LastAccrualDate->EditCustomAttributes = "";
		$this->LastAccrualDate->EditValue = FormatDateTime($this->LastAccrualDate->CurrentValue, 8);
		$this->LastAccrualDate->PlaceHolder = RemoveHtml($this->LastAccrualDate->caption());

		// LeaveTaken
		$this->LeaveTaken->EditAttrs["class"] = "form-control";
		$this->LeaveTaken->EditCustomAttributes = "";
		$this->LeaveTaken->EditValue = $this->LeaveTaken->CurrentValue;
		$this->LeaveTaken->PlaceHolder = RemoveHtml($this->LeaveTaken->caption());
		if (strval($this->LeaveTaken->EditValue) != "" && is_numeric($this->LeaveTaken->EditValue))
			$this->LeaveTaken->EditValue = FormatNumber($this->LeaveTaken->EditValue, -2, -2, -2, -2);
		

		// LeaveCommuted
		$this->LeaveCommuted->EditAttrs["class"] = "form-control";
		$this->LeaveCommuted->EditCustomAttributes = "";
		$this->LeaveCommuted->EditValue = $this->LeaveCommuted->CurrentValue;
		$this->LeaveCommuted->PlaceHolder = RemoveHtml($this->LeaveCommuted->caption());
		if (strval($this->LeaveCommuted->EditValue) != "" && is_numeric($this->LeaveCommuted->EditValue))
			$this->LeaveCommuted->EditValue = FormatNumber($this->LeaveCommuted->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->LeaveTypeCode);
					$doc->exportCaption($this->EffectiveDate);
					$doc->exportCaption($this->OpeningBalance);
					$doc->exportCaption($this->LeaveAccrued);
					$doc->exportCaption($this->LastAccrualDate);
					$doc->exportCaption($this->LeaveTaken);
					$doc->exportCaption($this->LeaveCommuted);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->LeaveTypeCode);
					$doc->exportCaption($this->EffectiveDate);
					$doc->exportCaption($this->OpeningBalance);
					$doc->exportCaption($this->LeaveAccrued);
					$doc->exportCaption($this->LastAccrualDate);
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
						$doc->exportField($this->LeaveTypeCode);
						$doc->exportField($this->EffectiveDate);
						$doc->exportField($this->OpeningBalance);
						$doc->exportField($this->LeaveAccrued);
						$doc->exportField($this->LastAccrualDate);
						$doc->exportField($this->LeaveTaken);
						$doc->exportField($this->LeaveCommuted);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->LeaveTypeCode);
						$doc->exportField($this->EffectiveDate);
						$doc->exportField($this->OpeningBalance);
						$doc->exportField($this->LeaveAccrued);
						$doc->exportField($this->LastAccrualDate);
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
		$table = 'leave_record';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'leave_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LeaveTypeCode'];

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
		$table = 'leave_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['LeaveTypeCode'];

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
		$table = 'leave_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LeaveTypeCode'];

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

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	/*	if ($fld->FldName == "LeaveTypeCode") {
			AddFilter($filter,"`LeaveTypeCode`  in   (select DISTINCT LeaveTypeCode
			from leave_type where leave_type.Accrued = 1)  ");
			}  */
	}
	// Row Rendering event
	function Row_Rendering() {
		// Enter your code here
	}
	// Row Rendered event
	function Row_Rendered() {
		// To view properties of field class, use:
		//var_dump($this-><FieldName>);
			if (CurrentPageID() == "add") {
			$this->LeaveAccrued->Visible = False;
			$this->LastAccrualDate->Visible = False;
			$this->LeaveTaken->Visible = False;
			$this->LaeveCommuted->Visible = False;
			}	
	}
	// User ID Filtering event
	function UserID_Filtering(&$filter) {
		// Enter your code here
	}
}
?>