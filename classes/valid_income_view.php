<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for valid_income_view
 */
class valid_income_view extends DbTable
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
	public $SubstantivePosition;
	public $PositionName;
	public $DateOfCurrentAppointment;
	public $DateOfExit;
	public $IncomeCode;
	public $IncomeName;
	public $BasicMonthlySalary;
	public $incomeAmount;
	public $Division;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'valid_income_view';
		$this->TableName = 'valid_income_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`valid_income_view`";
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
		$this->EmployeeID = new DbField('valid_income_view', 'valid_income_view', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// SubstantivePosition
		$this->SubstantivePosition = new DbField('valid_income_view', 'valid_income_view', 'x_SubstantivePosition', 'SubstantivePosition', '`SubstantivePosition`', '`SubstantivePosition`', 3, 11, -1, FALSE, '`SubstantivePosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubstantivePosition->IsPrimaryKey = TRUE; // Primary key field
		$this->SubstantivePosition->Nullable = FALSE; // NOT NULL field
		$this->SubstantivePosition->Required = TRUE; // Required field
		$this->SubstantivePosition->Sortable = TRUE; // Allow sort
		$this->SubstantivePosition->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubstantivePosition'] = &$this->SubstantivePosition;

		// PositionName
		$this->PositionName = new DbField('valid_income_view', 'valid_income_view', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->fields['PositionName'] = &$this->PositionName;

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment = new DbField('valid_income_view', 'valid_income_view', 'x_DateOfCurrentAppointment', 'DateOfCurrentAppointment', '`DateOfCurrentAppointment`', CastDateFieldForLike("`DateOfCurrentAppointment`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfCurrentAppointment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfCurrentAppointment->Nullable = FALSE; // NOT NULL field
		$this->DateOfCurrentAppointment->Required = TRUE; // Required field
		$this->DateOfCurrentAppointment->Sortable = TRUE; // Allow sort
		$this->DateOfCurrentAppointment->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfCurrentAppointment'] = &$this->DateOfCurrentAppointment;

		// DateOfExit
		$this->DateOfExit = new DbField('valid_income_view', 'valid_income_view', 'x_DateOfExit', 'DateOfExit', '`DateOfExit`', CastDateFieldForLike("`DateOfExit`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfExit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfExit->Sortable = TRUE; // Allow sort
		$this->DateOfExit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfExit'] = &$this->DateOfExit;

		// IncomeCode
		$this->IncomeCode = new DbField('valid_income_view', 'valid_income_view', 'x_IncomeCode', 'IncomeCode', '`IncomeCode`', '`IncomeCode`', 3, 11, -1, FALSE, '`IncomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->IncomeCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->IncomeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->IncomeCode->Sortable = TRUE; // Allow sort
		$this->IncomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IncomeCode'] = &$this->IncomeCode;

		// IncomeName
		$this->IncomeName = new DbField('valid_income_view', 'valid_income_view', 'x_IncomeName', 'IncomeName', '`IncomeName`', '`IncomeName`', 200, 255, -1, FALSE, '`IncomeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncomeName->Nullable = FALSE; // NOT NULL field
		$this->IncomeName->Required = TRUE; // Required field
		$this->IncomeName->Sortable = TRUE; // Allow sort
		$this->fields['IncomeName'] = &$this->IncomeName;

		// BasicMonthlySalary
		$this->BasicMonthlySalary = new DbField('valid_income_view', 'valid_income_view', 'x_BasicMonthlySalary', 'BasicMonthlySalary', '`BasicMonthlySalary`', '`BasicMonthlySalary`', 5, 22, -1, FALSE, '`BasicMonthlySalary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BasicMonthlySalary->Nullable = FALSE; // NOT NULL field
		$this->BasicMonthlySalary->Required = TRUE; // Required field
		$this->BasicMonthlySalary->Sortable = TRUE; // Allow sort
		$this->BasicMonthlySalary->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BasicMonthlySalary'] = &$this->BasicMonthlySalary;

		// incomeAmount
		$this->incomeAmount = new DbField('valid_income_view', 'valid_income_view', 'x_incomeAmount', 'incomeAmount', '`incomeAmount`', '`incomeAmount`', 5, 23, -1, FALSE, '`incomeAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->incomeAmount->Sortable = TRUE; // Allow sort
		$this->incomeAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['incomeAmount'] = &$this->incomeAmount;

		// Division
		$this->Division = new DbField('valid_income_view', 'valid_income_view', 'x_Division', 'Division', '`Division`', '`Division`', 16, 3, -1, FALSE, '`Division`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Division->Nullable = FALSE; // NOT NULL field
		$this->Division->Sortable = TRUE; // Allow sort
		$this->Division->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Division'] = &$this->Division;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`valid_income_view`";
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
			$this->IncomeCode->setDbValue($conn->insert_ID());
			$rs['IncomeCode'] = $this->IncomeCode->DbValue;
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
			if (array_key_exists('SubstantivePosition', $rs))
				AddFilter($where, QuotedName('SubstantivePosition', $this->Dbid) . '=' . QuotedValue($rs['SubstantivePosition'], $this->SubstantivePosition->DataType, $this->Dbid));
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
		$this->SubstantivePosition->DbValue = $row['SubstantivePosition'];
		$this->PositionName->DbValue = $row['PositionName'];
		$this->DateOfCurrentAppointment->DbValue = $row['DateOfCurrentAppointment'];
		$this->DateOfExit->DbValue = $row['DateOfExit'];
		$this->IncomeCode->DbValue = $row['IncomeCode'];
		$this->IncomeName->DbValue = $row['IncomeName'];
		$this->BasicMonthlySalary->DbValue = $row['BasicMonthlySalary'];
		$this->incomeAmount->DbValue = $row['incomeAmount'];
		$this->Division->DbValue = $row['Division'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `SubstantivePosition` = @SubstantivePosition@ AND `IncomeCode` = @IncomeCode@";
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
			$val = array_key_exists('SubstantivePosition', $row) ? $row['SubstantivePosition'] : NULL;
		else
			$val = $this->SubstantivePosition->OldValue !== NULL ? $this->SubstantivePosition->OldValue : $this->SubstantivePosition->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@SubstantivePosition@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('IncomeCode', $row) ? $row['IncomeCode'] : NULL;
		else
			$val = $this->IncomeCode->OldValue !== NULL ? $this->IncomeCode->OldValue : $this->IncomeCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
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
			return "valid_income_viewlist.php";
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
		if ($pageName == "valid_income_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "valid_income_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "valid_income_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "valid_income_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("valid_income_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("valid_income_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "valid_income_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "valid_income_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("valid_income_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("valid_income_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("valid_income_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
		$json .= ",SubstantivePosition:" . JsonEncode($this->SubstantivePosition->CurrentValue, "number");
		$json .= ",IncomeCode:" . JsonEncode($this->IncomeCode->CurrentValue, "number");
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
		if ($this->SubstantivePosition->CurrentValue != NULL) {
			$url .= "&SubstantivePosition=" . urlencode($this->SubstantivePosition->CurrentValue);
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
			if (Param("SubstantivePosition") !== NULL)
				$arKey[] = Param("SubstantivePosition");
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
				if (!is_numeric($key[1])) // SubstantivePosition
					continue;
				if (!is_numeric($key[2])) // IncomeCode
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
				$this->SubstantivePosition->CurrentValue = $key[1];
			else
				$this->SubstantivePosition->OldValue = $key[1];
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
		$this->SubstantivePosition->setDbValue($rs->fields('SubstantivePosition'));
		$this->PositionName->setDbValue($rs->fields('PositionName'));
		$this->DateOfCurrentAppointment->setDbValue($rs->fields('DateOfCurrentAppointment'));
		$this->DateOfExit->setDbValue($rs->fields('DateOfExit'));
		$this->IncomeCode->setDbValue($rs->fields('IncomeCode'));
		$this->IncomeName->setDbValue($rs->fields('IncomeName'));
		$this->BasicMonthlySalary->setDbValue($rs->fields('BasicMonthlySalary'));
		$this->incomeAmount->setDbValue($rs->fields('incomeAmount'));
		$this->Division->setDbValue($rs->fields('Division'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// SubstantivePosition
		// PositionName
		// DateOfCurrentAppointment
		// DateOfExit
		// IncomeCode
		// IncomeName
		// BasicMonthlySalary
		// incomeAmount
		// Division
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// SubstantivePosition
		$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
		$this->SubstantivePosition->ViewValue = FormatNumber($this->SubstantivePosition->ViewValue, 0, -2, -2, -2);
		$this->SubstantivePosition->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
		$this->PositionName->ViewCustomAttributes = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
		$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
		$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
		$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
		$this->DateOfExit->ViewCustomAttributes = "";

		// IncomeCode
		$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
		$this->IncomeCode->ViewCustomAttributes = "";

		// IncomeName
		$this->IncomeName->ViewValue = $this->IncomeName->CurrentValue;
		$this->IncomeName->ViewCustomAttributes = "";

		// BasicMonthlySalary
		$this->BasicMonthlySalary->ViewValue = $this->BasicMonthlySalary->CurrentValue;
		$this->BasicMonthlySalary->ViewValue = FormatNumber($this->BasicMonthlySalary->ViewValue, 2, -2, -2, -2);
		$this->BasicMonthlySalary->ViewCustomAttributes = "";

		// incomeAmount
		$this->incomeAmount->ViewValue = $this->incomeAmount->CurrentValue;
		$this->incomeAmount->ViewValue = FormatNumber($this->incomeAmount->ViewValue, 2, -2, -2, -2);
		$this->incomeAmount->ViewCustomAttributes = "";

		// Division
		$this->Division->ViewValue = $this->Division->CurrentValue;
		$this->Division->ViewValue = FormatNumber($this->Division->ViewValue, 0, -2, -2, -2);
		$this->Division->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// SubstantivePosition
		$this->SubstantivePosition->LinkCustomAttributes = "";
		$this->SubstantivePosition->HrefValue = "";
		$this->SubstantivePosition->TooltipValue = "";

		// PositionName
		$this->PositionName->LinkCustomAttributes = "";
		$this->PositionName->HrefValue = "";
		$this->PositionName->TooltipValue = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
		$this->DateOfCurrentAppointment->HrefValue = "";
		$this->DateOfCurrentAppointment->TooltipValue = "";

		// DateOfExit
		$this->DateOfExit->LinkCustomAttributes = "";
		$this->DateOfExit->HrefValue = "";
		$this->DateOfExit->TooltipValue = "";

		// IncomeCode
		$this->IncomeCode->LinkCustomAttributes = "";
		$this->IncomeCode->HrefValue = "";
		$this->IncomeCode->TooltipValue = "";

		// IncomeName
		$this->IncomeName->LinkCustomAttributes = "";
		$this->IncomeName->HrefValue = "";
		$this->IncomeName->TooltipValue = "";

		// BasicMonthlySalary
		$this->BasicMonthlySalary->LinkCustomAttributes = "";
		$this->BasicMonthlySalary->HrefValue = "";
		$this->BasicMonthlySalary->TooltipValue = "";

		// incomeAmount
		$this->incomeAmount->LinkCustomAttributes = "";
		$this->incomeAmount->HrefValue = "";
		$this->incomeAmount->TooltipValue = "";

		// Division
		$this->Division->LinkCustomAttributes = "";
		$this->Division->HrefValue = "";
		$this->Division->TooltipValue = "";

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

		// SubstantivePosition
		$this->SubstantivePosition->EditAttrs["class"] = "form-control";
		$this->SubstantivePosition->EditCustomAttributes = "";
		$this->SubstantivePosition->EditValue = $this->SubstantivePosition->CurrentValue;
		$this->SubstantivePosition->PlaceHolder = RemoveHtml($this->SubstantivePosition->caption());

		// PositionName
		$this->PositionName->EditAttrs["class"] = "form-control";
		$this->PositionName->EditCustomAttributes = "";
		if (!$this->PositionName->Raw)
			$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
		$this->PositionName->EditValue = $this->PositionName->CurrentValue;
		$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
		$this->DateOfCurrentAppointment->EditCustomAttributes = "";
		$this->DateOfCurrentAppointment->EditValue = FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8);
		$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

		// DateOfExit
		$this->DateOfExit->EditAttrs["class"] = "form-control";
		$this->DateOfExit->EditCustomAttributes = "";
		$this->DateOfExit->EditValue = FormatDateTime($this->DateOfExit->CurrentValue, 8);
		$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

		// IncomeCode
		$this->IncomeCode->EditAttrs["class"] = "form-control";
		$this->IncomeCode->EditCustomAttributes = "";
		$this->IncomeCode->EditValue = $this->IncomeCode->CurrentValue;
		$this->IncomeCode->ViewCustomAttributes = "";

		// IncomeName
		$this->IncomeName->EditAttrs["class"] = "form-control";
		$this->IncomeName->EditCustomAttributes = "";
		if (!$this->IncomeName->Raw)
			$this->IncomeName->CurrentValue = HtmlDecode($this->IncomeName->CurrentValue);
		$this->IncomeName->EditValue = $this->IncomeName->CurrentValue;
		$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

		// BasicMonthlySalary
		$this->BasicMonthlySalary->EditAttrs["class"] = "form-control";
		$this->BasicMonthlySalary->EditCustomAttributes = "";
		$this->BasicMonthlySalary->EditValue = $this->BasicMonthlySalary->CurrentValue;
		$this->BasicMonthlySalary->PlaceHolder = RemoveHtml($this->BasicMonthlySalary->caption());
		if (strval($this->BasicMonthlySalary->EditValue) != "" && is_numeric($this->BasicMonthlySalary->EditValue))
			$this->BasicMonthlySalary->EditValue = FormatNumber($this->BasicMonthlySalary->EditValue, -2, -2, -2, -2);
		

		// incomeAmount
		$this->incomeAmount->EditAttrs["class"] = "form-control";
		$this->incomeAmount->EditCustomAttributes = "";
		$this->incomeAmount->EditValue = $this->incomeAmount->CurrentValue;
		$this->incomeAmount->PlaceHolder = RemoveHtml($this->incomeAmount->caption());
		if (strval($this->incomeAmount->EditValue) != "" && is_numeric($this->incomeAmount->EditValue))
			$this->incomeAmount->EditValue = FormatNumber($this->incomeAmount->EditValue, -2, -2, -2, -2);
		

		// Division
		$this->Division->EditAttrs["class"] = "form-control";
		$this->Division->EditCustomAttributes = "";
		$this->Division->EditValue = $this->Division->CurrentValue;
		$this->Division->PlaceHolder = RemoveHtml($this->Division->caption());

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
					$doc->exportCaption($this->SubstantivePosition);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->IncomeName);
					$doc->exportCaption($this->BasicMonthlySalary);
					$doc->exportCaption($this->incomeAmount);
					$doc->exportCaption($this->Division);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->SubstantivePosition);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->IncomeName);
					$doc->exportCaption($this->BasicMonthlySalary);
					$doc->exportCaption($this->incomeAmount);
					$doc->exportCaption($this->Division);
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
						$doc->exportField($this->SubstantivePosition);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->IncomeName);
						$doc->exportField($this->BasicMonthlySalary);
						$doc->exportField($this->incomeAmount);
						$doc->exportField($this->Division);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->SubstantivePosition);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->IncomeName);
						$doc->exportField($this->BasicMonthlySalary);
						$doc->exportField($this->incomeAmount);
						$doc->exportField($this->Division);
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