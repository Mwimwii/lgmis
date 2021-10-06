<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for employment_trans
 */
class employment_trans extends DbTable
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
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $ToLACode;
	public $ToDept;
	public $ToSection;
	public $ActingPosition;
	public $DateOfTransaction;
	public $TransactionType;
	public $TransLetter;
	public $SalaryScale;
	public $TransStatus;
	public $TransReason;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'employment_trans';
		$this->TableName = 'employment_trans';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`employment_trans`";
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
		$this->EmployeeID = new DbField('employment_trans', 'employment_trans', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// ProvinceCode
		$this->ProvinceCode = new DbField('employment_trans', 'employment_trans', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 4, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('employment_trans', 'employment_trans', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('employment_trans', 'employment_trans', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('employment_trans', 'employment_trans', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// ToLACode
		$this->ToLACode = new DbField('employment_trans', 'employment_trans', 'x_ToLACode', 'ToLACode', '`ToLACode`', '`ToLACode`', 200, 10, -1, FALSE, '`ToLACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ToLACode->Sortable = TRUE; // Allow sort
		$this->fields['ToLACode'] = &$this->ToLACode;

		// ToDept
		$this->ToDept = new DbField('employment_trans', 'employment_trans', 'x_ToDept', 'ToDept', '`ToDept`', '`ToDept`', 3, 11, -1, FALSE, '`ToDept`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ToDept->Sortable = TRUE; // Allow sort
		$this->ToDept->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ToDept'] = &$this->ToDept;

		// ToSection
		$this->ToSection = new DbField('employment_trans', 'employment_trans', 'x_ToSection', 'ToSection', '`ToSection`', '`ToSection`', 3, 11, -1, FALSE, '`ToSection`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ToSection->Sortable = TRUE; // Allow sort
		$this->ToSection->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ToSection'] = &$this->ToSection;

		// ActingPosition
		$this->ActingPosition = new DbField('employment_trans', 'employment_trans', 'x_ActingPosition', 'ActingPosition', '`ActingPosition`', '`ActingPosition`', 3, 11, -1, FALSE, '`ActingPosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActingPosition->Nullable = FALSE; // NOT NULL field
		$this->ActingPosition->Required = TRUE; // Required field
		$this->ActingPosition->Sortable = TRUE; // Allow sort
		$this->ActingPosition->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ActingPosition'] = &$this->ActingPosition;

		// DateOfTransaction
		$this->DateOfTransaction = new DbField('employment_trans', 'employment_trans', 'x_DateOfTransaction', 'DateOfTransaction', '`DateOfTransaction`', CastDateFieldForLike("`DateOfTransaction`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfTransaction`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfTransaction->Nullable = FALSE; // NOT NULL field
		$this->DateOfTransaction->Required = TRUE; // Required field
		$this->DateOfTransaction->Sortable = TRUE; // Allow sort
		$this->DateOfTransaction->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfTransaction'] = &$this->DateOfTransaction;

		// TransactionType
		$this->TransactionType = new DbField('employment_trans', 'employment_trans', 'x_TransactionType', 'TransactionType', '`TransactionType`', '`TransactionType`', 3, 11, -1, FALSE, '`TransactionType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TransactionType->Nullable = FALSE; // NOT NULL field
		$this->TransactionType->Required = TRUE; // Required field
		$this->TransactionType->Sortable = TRUE; // Allow sort
		$this->TransactionType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TransactionType'] = &$this->TransactionType;

		// TransLetter
		$this->TransLetter = new DbField('employment_trans', 'employment_trans', 'x_TransLetter', 'TransLetter', '`TransLetter`', '`TransLetter`', 201, -1, -1, FALSE, '`TransLetter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->TransLetter->Sortable = TRUE; // Allow sort
		$this->fields['TransLetter'] = &$this->TransLetter;

		// SalaryScale
		$this->SalaryScale = new DbField('employment_trans', 'employment_trans', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 10, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// TransStatus
		$this->TransStatus = new DbField('employment_trans', 'employment_trans', 'x_TransStatus', 'TransStatus', '`TransStatus`', '`TransStatus`', 16, 3, -1, FALSE, '`TransStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TransStatus->Nullable = FALSE; // NOT NULL field
		$this->TransStatus->Required = TRUE; // Required field
		$this->TransStatus->Sortable = TRUE; // Allow sort
		$this->TransStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TransStatus'] = &$this->TransStatus;

		// TransReason
		$this->TransReason = new DbField('employment_trans', 'employment_trans', 'x_TransReason', 'TransReason', '`TransReason`', '`TransReason`', 200, 255, -1, FALSE, '`TransReason`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TransReason->Nullable = FALSE; // NOT NULL field
		$this->TransReason->Required = TRUE; // Required field
		$this->TransReason->Sortable = TRUE; // Allow sort
		$this->fields['TransReason'] = &$this->TransReason;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`employment_trans`";
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
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->ToLACode->DbValue = $row['ToLACode'];
		$this->ToDept->DbValue = $row['ToDept'];
		$this->ToSection->DbValue = $row['ToSection'];
		$this->ActingPosition->DbValue = $row['ActingPosition'];
		$this->DateOfTransaction->DbValue = $row['DateOfTransaction'];
		$this->TransactionType->DbValue = $row['TransactionType'];
		$this->TransLetter->DbValue = $row['TransLetter'];
		$this->SalaryScale->DbValue = $row['SalaryScale'];
		$this->TransStatus->DbValue = $row['TransStatus'];
		$this->TransReason->DbValue = $row['TransReason'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "employment_translist.php";
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
		if ($pageName == "employment_transview.php")
			return $Language->phrase("View");
		elseif ($pageName == "employment_transedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "employment_transadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "employment_translist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("employment_transview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("employment_transview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "employment_transadd.php?" . $this->getUrlParm($parm);
		else
			$url = "employment_transadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("employment_transedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("employment_transadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("employment_transdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->ToLACode->setDbValue($rs->fields('ToLACode'));
		$this->ToDept->setDbValue($rs->fields('ToDept'));
		$this->ToSection->setDbValue($rs->fields('ToSection'));
		$this->ActingPosition->setDbValue($rs->fields('ActingPosition'));
		$this->DateOfTransaction->setDbValue($rs->fields('DateOfTransaction'));
		$this->TransactionType->setDbValue($rs->fields('TransactionType'));
		$this->TransLetter->setDbValue($rs->fields('TransLetter'));
		$this->SalaryScale->setDbValue($rs->fields('SalaryScale'));
		$this->TransStatus->setDbValue($rs->fields('TransStatus'));
		$this->TransReason->setDbValue($rs->fields('TransReason'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ToLACode
		// ToDept
		// ToSection
		// ActingPosition
		// DateOfTransaction
		// TransactionType
		// TransLetter
		// SalaryScale
		// TransStatus
		// TransReason
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
		$this->ProvinceCode->ViewCustomAttributes = "";

		// LACode
		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewCustomAttributes = "";

		// DepartmentCode
		$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
		$this->DepartmentCode->ViewCustomAttributes = "";

		// SectionCode
		$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
		$this->SectionCode->ViewCustomAttributes = "";

		// ToLACode
		$this->ToLACode->ViewValue = $this->ToLACode->CurrentValue;
		$this->ToLACode->ViewCustomAttributes = "";

		// ToDept
		$this->ToDept->ViewValue = $this->ToDept->CurrentValue;
		$this->ToDept->ViewCustomAttributes = "";

		// ToSection
		$this->ToSection->ViewValue = $this->ToSection->CurrentValue;
		$this->ToSection->ViewCustomAttributes = "";

		// ActingPosition
		$this->ActingPosition->ViewValue = $this->ActingPosition->CurrentValue;
		$this->ActingPosition->ViewCustomAttributes = "";

		// DateOfTransaction
		$this->DateOfTransaction->ViewValue = $this->DateOfTransaction->CurrentValue;
		$this->DateOfTransaction->ViewValue = FormatDateTime($this->DateOfTransaction->ViewValue, 0);
		$this->DateOfTransaction->ViewCustomAttributes = "";

		// TransactionType
		$this->TransactionType->ViewValue = $this->TransactionType->CurrentValue;
		$this->TransactionType->ViewCustomAttributes = "";

		// TransLetter
		$this->TransLetter->ViewValue = $this->TransLetter->CurrentValue;
		$this->TransLetter->ViewCustomAttributes = "";

		// SalaryScale
		$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
		$this->SalaryScale->ViewCustomAttributes = "";

		// TransStatus
		$this->TransStatus->ViewValue = $this->TransStatus->CurrentValue;
		$this->TransStatus->ViewCustomAttributes = "";

		// TransReason
		$this->TransReason->ViewValue = $this->TransReason->CurrentValue;
		$this->TransReason->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// SectionCode
		$this->SectionCode->LinkCustomAttributes = "";
		$this->SectionCode->HrefValue = "";
		$this->SectionCode->TooltipValue = "";

		// ToLACode
		$this->ToLACode->LinkCustomAttributes = "";
		$this->ToLACode->HrefValue = "";
		$this->ToLACode->TooltipValue = "";

		// ToDept
		$this->ToDept->LinkCustomAttributes = "";
		$this->ToDept->HrefValue = "";
		$this->ToDept->TooltipValue = "";

		// ToSection
		$this->ToSection->LinkCustomAttributes = "";
		$this->ToSection->HrefValue = "";
		$this->ToSection->TooltipValue = "";

		// ActingPosition
		$this->ActingPosition->LinkCustomAttributes = "";
		$this->ActingPosition->HrefValue = "";
		$this->ActingPosition->TooltipValue = "";

		// DateOfTransaction
		$this->DateOfTransaction->LinkCustomAttributes = "";
		$this->DateOfTransaction->HrefValue = "";
		$this->DateOfTransaction->TooltipValue = "";

		// TransactionType
		$this->TransactionType->LinkCustomAttributes = "";
		$this->TransactionType->HrefValue = "";
		$this->TransactionType->TooltipValue = "";

		// TransLetter
		$this->TransLetter->LinkCustomAttributes = "";
		$this->TransLetter->HrefValue = "";
		$this->TransLetter->TooltipValue = "";

		// SalaryScale
		$this->SalaryScale->LinkCustomAttributes = "";
		$this->SalaryScale->HrefValue = "";
		$this->SalaryScale->TooltipValue = "";

		// TransStatus
		$this->TransStatus->LinkCustomAttributes = "";
		$this->TransStatus->HrefValue = "";
		$this->TransStatus->TooltipValue = "";

		// TransReason
		$this->TransReason->LinkCustomAttributes = "";
		$this->TransReason->HrefValue = "";
		$this->TransReason->TooltipValue = "";

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

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";
		$this->ProvinceCode->EditValue = $this->ProvinceCode->CurrentValue;
		$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if (!$this->LACode->Raw)
			$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";
		$this->DepartmentCode->EditValue = $this->DepartmentCode->CurrentValue;
		$this->DepartmentCode->PlaceHolder = RemoveHtml($this->DepartmentCode->caption());

		// SectionCode
		$this->SectionCode->EditAttrs["class"] = "form-control";
		$this->SectionCode->EditCustomAttributes = "";
		$this->SectionCode->EditValue = $this->SectionCode->CurrentValue;
		$this->SectionCode->PlaceHolder = RemoveHtml($this->SectionCode->caption());

		// ToLACode
		$this->ToLACode->EditAttrs["class"] = "form-control";
		$this->ToLACode->EditCustomAttributes = "";
		if (!$this->ToLACode->Raw)
			$this->ToLACode->CurrentValue = HtmlDecode($this->ToLACode->CurrentValue);
		$this->ToLACode->EditValue = $this->ToLACode->CurrentValue;
		$this->ToLACode->PlaceHolder = RemoveHtml($this->ToLACode->caption());

		// ToDept
		$this->ToDept->EditAttrs["class"] = "form-control";
		$this->ToDept->EditCustomAttributes = "";
		$this->ToDept->EditValue = $this->ToDept->CurrentValue;
		$this->ToDept->PlaceHolder = RemoveHtml($this->ToDept->caption());

		// ToSection
		$this->ToSection->EditAttrs["class"] = "form-control";
		$this->ToSection->EditCustomAttributes = "";
		$this->ToSection->EditValue = $this->ToSection->CurrentValue;
		$this->ToSection->PlaceHolder = RemoveHtml($this->ToSection->caption());

		// ActingPosition
		$this->ActingPosition->EditAttrs["class"] = "form-control";
		$this->ActingPosition->EditCustomAttributes = "";
		$this->ActingPosition->EditValue = $this->ActingPosition->CurrentValue;
		$this->ActingPosition->PlaceHolder = RemoveHtml($this->ActingPosition->caption());

		// DateOfTransaction
		$this->DateOfTransaction->EditAttrs["class"] = "form-control";
		$this->DateOfTransaction->EditCustomAttributes = "";
		$this->DateOfTransaction->EditValue = FormatDateTime($this->DateOfTransaction->CurrentValue, 8);
		$this->DateOfTransaction->PlaceHolder = RemoveHtml($this->DateOfTransaction->caption());

		// TransactionType
		$this->TransactionType->EditAttrs["class"] = "form-control";
		$this->TransactionType->EditCustomAttributes = "";
		$this->TransactionType->EditValue = $this->TransactionType->CurrentValue;
		$this->TransactionType->PlaceHolder = RemoveHtml($this->TransactionType->caption());

		// TransLetter
		$this->TransLetter->EditAttrs["class"] = "form-control";
		$this->TransLetter->EditCustomAttributes = "";
		$this->TransLetter->EditValue = $this->TransLetter->CurrentValue;
		$this->TransLetter->PlaceHolder = RemoveHtml($this->TransLetter->caption());

		// SalaryScale
		$this->SalaryScale->EditAttrs["class"] = "form-control";
		$this->SalaryScale->EditCustomAttributes = "";
		if (!$this->SalaryScale->Raw)
			$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
		$this->SalaryScale->EditValue = $this->SalaryScale->CurrentValue;
		$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());

		// TransStatus
		$this->TransStatus->EditAttrs["class"] = "form-control";
		$this->TransStatus->EditCustomAttributes = "";
		$this->TransStatus->EditValue = $this->TransStatus->CurrentValue;
		$this->TransStatus->PlaceHolder = RemoveHtml($this->TransStatus->caption());

		// TransReason
		$this->TransReason->EditAttrs["class"] = "form-control";
		$this->TransReason->EditCustomAttributes = "";
		if (!$this->TransReason->Raw)
			$this->TransReason->CurrentValue = HtmlDecode($this->TransReason->CurrentValue);
		$this->TransReason->EditValue = $this->TransReason->CurrentValue;
		$this->TransReason->PlaceHolder = RemoveHtml($this->TransReason->caption());

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
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ToLACode);
					$doc->exportCaption($this->ToDept);
					$doc->exportCaption($this->ToSection);
					$doc->exportCaption($this->ActingPosition);
					$doc->exportCaption($this->DateOfTransaction);
					$doc->exportCaption($this->TransactionType);
					$doc->exportCaption($this->TransLetter);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->TransStatus);
					$doc->exportCaption($this->TransReason);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ToLACode);
					$doc->exportCaption($this->ToDept);
					$doc->exportCaption($this->ToSection);
					$doc->exportCaption($this->ActingPosition);
					$doc->exportCaption($this->DateOfTransaction);
					$doc->exportCaption($this->TransactionType);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->TransStatus);
					$doc->exportCaption($this->TransReason);
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
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ToLACode);
						$doc->exportField($this->ToDept);
						$doc->exportField($this->ToSection);
						$doc->exportField($this->ActingPosition);
						$doc->exportField($this->DateOfTransaction);
						$doc->exportField($this->TransactionType);
						$doc->exportField($this->TransLetter);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->TransStatus);
						$doc->exportField($this->TransReason);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ToLACode);
						$doc->exportField($this->ToDept);
						$doc->exportField($this->ToSection);
						$doc->exportField($this->ActingPosition);
						$doc->exportField($this->DateOfTransaction);
						$doc->exportField($this->TransactionType);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->TransStatus);
						$doc->exportField($this->TransReason);
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