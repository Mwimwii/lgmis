<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for paye_summary_view
 */
class paye_summary_view extends DbTable
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
	public $DepartmentName;
	public $SectionName;
	public $EmployeeID;
	public $EmployeeNames;
	public $NRC;
	public $EmploymentTypeDesc;
	public $Year;
	public $MonthShort;
	public $PayrollPeriod;
	public $GrossIncome;
	public $TaxableIncome;
	public $PAYE;
	public $TaxCredit;
	public $Adjustment;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'paye_summary_view';
		$this->TableName = 'paye_summary_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`paye_summary_view`";
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
		$this->LocalAuthority = new DbField('paye_summary_view', 'paye_summary_view', 'x_LocalAuthority', 'LocalAuthority', '`LocalAuthority`', '`LocalAuthority`', 200, 40, -1, FALSE, '`LocalAuthority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LocalAuthority->Nullable = FALSE; // NOT NULL field
		$this->LocalAuthority->Required = TRUE; // Required field
		$this->LocalAuthority->Sortable = TRUE; // Allow sort
		$this->fields['LocalAuthority'] = &$this->LocalAuthority;

		// DepartmentName
		$this->DepartmentName = new DbField('paye_summary_view', 'paye_summary_view', 'x_DepartmentName', 'DepartmentName', '`DepartmentName`', '`DepartmentName`', 200, 255, -1, FALSE, '`DepartmentName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentName->Nullable = FALSE; // NOT NULL field
		$this->DepartmentName->Required = TRUE; // Required field
		$this->DepartmentName->Sortable = TRUE; // Allow sort
		$this->fields['DepartmentName'] = &$this->DepartmentName;

		// SectionName
		$this->SectionName = new DbField('paye_summary_view', 'paye_summary_view', 'x_SectionName', 'SectionName', '`SectionName`', '`SectionName`', 200, 255, -1, FALSE, '`SectionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionName->Nullable = FALSE; // NOT NULL field
		$this->SectionName->Required = TRUE; // Required field
		$this->SectionName->Sortable = TRUE; // Allow sort
		$this->fields['SectionName'] = &$this->SectionName;

		// EmployeeID
		$this->EmployeeID = new DbField('paye_summary_view', 'paye_summary_view', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// EmployeeNames
		$this->EmployeeNames = new DbField('paye_summary_view', 'paye_summary_view', 'x_EmployeeNames', 'EmployeeNames', '`EmployeeNames`', '`EmployeeNames`', 201, 302, -1, FALSE, '`EmployeeNames`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->EmployeeNames->Nullable = FALSE; // NOT NULL field
		$this->EmployeeNames->Required = TRUE; // Required field
		$this->EmployeeNames->Sortable = TRUE; // Allow sort
		$this->fields['EmployeeNames'] = &$this->EmployeeNames;

		// NRC
		$this->NRC = new DbField('paye_summary_view', 'paye_summary_view', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->fields['NRC'] = &$this->NRC;

		// EmploymentTypeDesc
		$this->EmploymentTypeDesc = new DbField('paye_summary_view', 'paye_summary_view', 'x_EmploymentTypeDesc', 'EmploymentTypeDesc', '`EmploymentTypeDesc`', '`EmploymentTypeDesc`', 200, 255, -1, FALSE, '`EmploymentTypeDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmploymentTypeDesc->Nullable = FALSE; // NOT NULL field
		$this->EmploymentTypeDesc->Required = TRUE; // Required field
		$this->EmploymentTypeDesc->Sortable = TRUE; // Allow sort
		$this->fields['EmploymentTypeDesc'] = &$this->EmploymentTypeDesc;

		// Year
		$this->Year = new DbField('paye_summary_view', 'paye_summary_view', 'x_Year', 'Year', '`Year`', '`Year`', 18, 4, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Nullable = FALSE; // NOT NULL field
		$this->Year->Required = TRUE; // Required field
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year'] = &$this->Year;

		// MonthShort
		$this->MonthShort = new DbField('paye_summary_view', 'paye_summary_view', 'x_MonthShort', 'MonthShort', '`MonthShort`', '`MonthShort`', 200, 4, -1, FALSE, '`MonthShort`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MonthShort->Nullable = FALSE; // NOT NULL field
		$this->MonthShort->Required = TRUE; // Required field
		$this->MonthShort->Sortable = TRUE; // Allow sort
		$this->fields['MonthShort'] = &$this->MonthShort;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('paye_summary_view', 'paye_summary_view', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// GrossIncome
		$this->GrossIncome = new DbField('paye_summary_view', 'paye_summary_view', 'x_GrossIncome', 'GrossIncome', '`GrossIncome`', '`GrossIncome`', 5, 23, -1, FALSE, '`GrossIncome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->GrossIncome->Sortable = TRUE; // Allow sort
		$this->GrossIncome->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['GrossIncome'] = &$this->GrossIncome;

		// TaxableIncome
		$this->TaxableIncome = new DbField('paye_summary_view', 'paye_summary_view', 'x_TaxableIncome', 'TaxableIncome', '`TaxableIncome`', '`TaxableIncome`', 5, 23, -1, FALSE, '`TaxableIncome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TaxableIncome->Sortable = TRUE; // Allow sort
		$this->TaxableIncome->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TaxableIncome'] = &$this->TaxableIncome;

		// PAYE
		$this->PAYE = new DbField('paye_summary_view', 'paye_summary_view', 'x_PAYE', 'PAYE', '`PAYE`', '`PAYE`', 131, 32, -1, FALSE, '`PAYE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PAYE->Sortable = TRUE; // Allow sort
		$this->PAYE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PAYE'] = &$this->PAYE;

		// TaxCredit
		$this->TaxCredit = new DbField('paye_summary_view', 'paye_summary_view', 'x_TaxCredit', 'TaxCredit', '`TaxCredit`', '`TaxCredit`', 5, 23, -1, FALSE, '`TaxCredit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TaxCredit->Sortable = TRUE; // Allow sort
		$this->TaxCredit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TaxCredit'] = &$this->TaxCredit;

		// Adjustment
		$this->Adjustment = new DbField('paye_summary_view', 'paye_summary_view', 'x_Adjustment', 'Adjustment', '`Adjustment`', '`Adjustment`', 3, 1, -1, FALSE, '`Adjustment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Adjustment->Nullable = FALSE; // NOT NULL field
		$this->Adjustment->Sortable = TRUE; // Allow sort
		$this->Adjustment->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Adjustment'] = &$this->Adjustment;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`paye_summary_view`";
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
		$this->LocalAuthority->DbValue = $row['LocalAuthority'];
		$this->DepartmentName->DbValue = $row['DepartmentName'];
		$this->SectionName->DbValue = $row['SectionName'];
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->EmployeeNames->DbValue = $row['EmployeeNames'];
		$this->NRC->DbValue = $row['NRC'];
		$this->EmploymentTypeDesc->DbValue = $row['EmploymentTypeDesc'];
		$this->Year->DbValue = $row['Year'];
		$this->MonthShort->DbValue = $row['MonthShort'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->GrossIncome->DbValue = $row['GrossIncome'];
		$this->TaxableIncome->DbValue = $row['TaxableIncome'];
		$this->PAYE->DbValue = $row['PAYE'];
		$this->TaxCredit->DbValue = $row['TaxCredit'];
		$this->Adjustment->DbValue = $row['Adjustment'];
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
			return "paye_summary_viewlist.php";
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
		if ($pageName == "paye_summary_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "paye_summary_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "paye_summary_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "paye_summary_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("paye_summary_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("paye_summary_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "paye_summary_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "paye_summary_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("paye_summary_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("paye_summary_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("paye_summary_viewdelete.php", $this->getUrlParm());
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
		$this->LocalAuthority->setDbValue($rs->fields('LocalAuthority'));
		$this->DepartmentName->setDbValue($rs->fields('DepartmentName'));
		$this->SectionName->setDbValue($rs->fields('SectionName'));
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->EmployeeNames->setDbValue($rs->fields('EmployeeNames'));
		$this->NRC->setDbValue($rs->fields('NRC'));
		$this->EmploymentTypeDesc->setDbValue($rs->fields('EmploymentTypeDesc'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->MonthShort->setDbValue($rs->fields('MonthShort'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->GrossIncome->setDbValue($rs->fields('GrossIncome'));
		$this->TaxableIncome->setDbValue($rs->fields('TaxableIncome'));
		$this->PAYE->setDbValue($rs->fields('PAYE'));
		$this->TaxCredit->setDbValue($rs->fields('TaxCredit'));
		$this->Adjustment->setDbValue($rs->fields('Adjustment'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LocalAuthority
		// DepartmentName
		// SectionName
		// EmployeeID
		// EmployeeNames
		// NRC
		// EmploymentTypeDesc
		// Year
		// MonthShort
		// PayrollPeriod
		// GrossIncome
		// TaxableIncome
		// PAYE
		// TaxCredit
		// Adjustment
		// LocalAuthority

		$this->LocalAuthority->ViewValue = $this->LocalAuthority->CurrentValue;
		$this->LocalAuthority->ViewCustomAttributes = "";

		// DepartmentName
		$this->DepartmentName->ViewValue = $this->DepartmentName->CurrentValue;
		$this->DepartmentName->ViewCustomAttributes = "";

		// SectionName
		$this->SectionName->ViewValue = $this->SectionName->CurrentValue;
		$this->SectionName->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// EmployeeNames
		$this->EmployeeNames->ViewValue = $this->EmployeeNames->CurrentValue;
		$this->EmployeeNames->ViewCustomAttributes = "";

		// NRC
		$this->NRC->ViewValue = $this->NRC->CurrentValue;
		$this->NRC->ViewCustomAttributes = "";

		// EmploymentTypeDesc
		$this->EmploymentTypeDesc->ViewValue = $this->EmploymentTypeDesc->CurrentValue;
		$this->EmploymentTypeDesc->ViewCustomAttributes = "";

		// Year
		$this->Year->ViewValue = $this->Year->CurrentValue;
		$this->Year->ViewValue = FormatNumber($this->Year->ViewValue, 0, -2, -2, -2);
		$this->Year->ViewCustomAttributes = "";

		// MonthShort
		$this->MonthShort->ViewValue = $this->MonthShort->CurrentValue;
		$this->MonthShort->ViewCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->ViewValue = FormatNumber($this->PayrollPeriod->ViewValue, 0, -2, -2, -2);
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// GrossIncome
		$this->GrossIncome->ViewValue = $this->GrossIncome->CurrentValue;
		$this->GrossIncome->ViewValue = FormatNumber($this->GrossIncome->ViewValue, 2, -2, -2, -2);
		$this->GrossIncome->ViewCustomAttributes = "";

		// TaxableIncome
		$this->TaxableIncome->ViewValue = $this->TaxableIncome->CurrentValue;
		$this->TaxableIncome->ViewValue = FormatNumber($this->TaxableIncome->ViewValue, 2, -2, -2, -2);
		$this->TaxableIncome->ViewCustomAttributes = "";

		// PAYE
		$this->PAYE->ViewValue = $this->PAYE->CurrentValue;
		$this->PAYE->ViewValue = FormatNumber($this->PAYE->ViewValue, 2, -2, -2, -2);
		$this->PAYE->ViewCustomAttributes = "";

		// TaxCredit
		$this->TaxCredit->ViewValue = $this->TaxCredit->CurrentValue;
		$this->TaxCredit->ViewValue = FormatNumber($this->TaxCredit->ViewValue, 2, -2, -2, -2);
		$this->TaxCredit->ViewCustomAttributes = "";

		// Adjustment
		$this->Adjustment->ViewValue = $this->Adjustment->CurrentValue;
		$this->Adjustment->ViewValue = FormatNumber($this->Adjustment->ViewValue, 0, -2, -2, -2);
		$this->Adjustment->ViewCustomAttributes = "";

		// LocalAuthority
		$this->LocalAuthority->LinkCustomAttributes = "";
		$this->LocalAuthority->HrefValue = "";
		$this->LocalAuthority->TooltipValue = "";

		// DepartmentName
		$this->DepartmentName->LinkCustomAttributes = "";
		$this->DepartmentName->HrefValue = "";
		$this->DepartmentName->TooltipValue = "";

		// SectionName
		$this->SectionName->LinkCustomAttributes = "";
		$this->SectionName->HrefValue = "";
		$this->SectionName->TooltipValue = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// EmployeeNames
		$this->EmployeeNames->LinkCustomAttributes = "";
		$this->EmployeeNames->HrefValue = "";
		$this->EmployeeNames->TooltipValue = "";

		// NRC
		$this->NRC->LinkCustomAttributes = "";
		$this->NRC->HrefValue = "";
		$this->NRC->TooltipValue = "";

		// EmploymentTypeDesc
		$this->EmploymentTypeDesc->LinkCustomAttributes = "";
		$this->EmploymentTypeDesc->HrefValue = "";
		$this->EmploymentTypeDesc->TooltipValue = "";

		// Year
		$this->Year->LinkCustomAttributes = "";
		$this->Year->HrefValue = "";
		$this->Year->TooltipValue = "";

		// MonthShort
		$this->MonthShort->LinkCustomAttributes = "";
		$this->MonthShort->HrefValue = "";
		$this->MonthShort->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// GrossIncome
		$this->GrossIncome->LinkCustomAttributes = "";
		$this->GrossIncome->HrefValue = "";
		$this->GrossIncome->TooltipValue = "";

		// TaxableIncome
		$this->TaxableIncome->LinkCustomAttributes = "";
		$this->TaxableIncome->HrefValue = "";
		$this->TaxableIncome->TooltipValue = "";

		// PAYE
		$this->PAYE->LinkCustomAttributes = "";
		$this->PAYE->HrefValue = "";
		$this->PAYE->TooltipValue = "";

		// TaxCredit
		$this->TaxCredit->LinkCustomAttributes = "";
		$this->TaxCredit->HrefValue = "";
		$this->TaxCredit->TooltipValue = "";

		// Adjustment
		$this->Adjustment->LinkCustomAttributes = "";
		$this->Adjustment->HrefValue = "";
		$this->Adjustment->TooltipValue = "";

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
		if (!$this->LocalAuthority->Raw)
			$this->LocalAuthority->CurrentValue = HtmlDecode($this->LocalAuthority->CurrentValue);
		$this->LocalAuthority->EditValue = $this->LocalAuthority->CurrentValue;
		$this->LocalAuthority->PlaceHolder = RemoveHtml($this->LocalAuthority->caption());

		// DepartmentName
		$this->DepartmentName->EditAttrs["class"] = "form-control";
		$this->DepartmentName->EditCustomAttributes = "";
		if (!$this->DepartmentName->Raw)
			$this->DepartmentName->CurrentValue = HtmlDecode($this->DepartmentName->CurrentValue);
		$this->DepartmentName->EditValue = $this->DepartmentName->CurrentValue;
		$this->DepartmentName->PlaceHolder = RemoveHtml($this->DepartmentName->caption());

		// SectionName
		$this->SectionName->EditAttrs["class"] = "form-control";
		$this->SectionName->EditCustomAttributes = "";
		if (!$this->SectionName->Raw)
			$this->SectionName->CurrentValue = HtmlDecode($this->SectionName->CurrentValue);
		$this->SectionName->EditValue = $this->SectionName->CurrentValue;
		$this->SectionName->PlaceHolder = RemoveHtml($this->SectionName->caption());

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// EmployeeNames
		$this->EmployeeNames->EditAttrs["class"] = "form-control";
		$this->EmployeeNames->EditCustomAttributes = "";
		$this->EmployeeNames->EditValue = $this->EmployeeNames->CurrentValue;
		$this->EmployeeNames->PlaceHolder = RemoveHtml($this->EmployeeNames->caption());

		// NRC
		$this->NRC->EditAttrs["class"] = "form-control";
		$this->NRC->EditCustomAttributes = "";
		if (!$this->NRC->Raw)
			$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
		$this->NRC->EditValue = $this->NRC->CurrentValue;
		$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

		// EmploymentTypeDesc
		$this->EmploymentTypeDesc->EditAttrs["class"] = "form-control";
		$this->EmploymentTypeDesc->EditCustomAttributes = "";
		if (!$this->EmploymentTypeDesc->Raw)
			$this->EmploymentTypeDesc->CurrentValue = HtmlDecode($this->EmploymentTypeDesc->CurrentValue);
		$this->EmploymentTypeDesc->EditValue = $this->EmploymentTypeDesc->CurrentValue;
		$this->EmploymentTypeDesc->PlaceHolder = RemoveHtml($this->EmploymentTypeDesc->caption());

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		$this->Year->EditValue = $this->Year->CurrentValue;
		$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

		// MonthShort
		$this->MonthShort->EditAttrs["class"] = "form-control";
		$this->MonthShort->EditCustomAttributes = "";
		if (!$this->MonthShort->Raw)
			$this->MonthShort->CurrentValue = HtmlDecode($this->MonthShort->CurrentValue);
		$this->MonthShort->EditValue = $this->MonthShort->CurrentValue;
		$this->MonthShort->PlaceHolder = RemoveHtml($this->MonthShort->caption());

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";
		$this->PayrollPeriod->EditValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->PlaceHolder = RemoveHtml($this->PayrollPeriod->caption());

		// GrossIncome
		$this->GrossIncome->EditAttrs["class"] = "form-control";
		$this->GrossIncome->EditCustomAttributes = "";
		$this->GrossIncome->EditValue = $this->GrossIncome->CurrentValue;
		$this->GrossIncome->PlaceHolder = RemoveHtml($this->GrossIncome->caption());
		if (strval($this->GrossIncome->EditValue) != "" && is_numeric($this->GrossIncome->EditValue))
			$this->GrossIncome->EditValue = FormatNumber($this->GrossIncome->EditValue, -2, -2, -2, -2);
		

		// TaxableIncome
		$this->TaxableIncome->EditAttrs["class"] = "form-control";
		$this->TaxableIncome->EditCustomAttributes = "";
		$this->TaxableIncome->EditValue = $this->TaxableIncome->CurrentValue;
		$this->TaxableIncome->PlaceHolder = RemoveHtml($this->TaxableIncome->caption());
		if (strval($this->TaxableIncome->EditValue) != "" && is_numeric($this->TaxableIncome->EditValue))
			$this->TaxableIncome->EditValue = FormatNumber($this->TaxableIncome->EditValue, -2, -2, -2, -2);
		

		// PAYE
		$this->PAYE->EditAttrs["class"] = "form-control";
		$this->PAYE->EditCustomAttributes = "";
		$this->PAYE->EditValue = $this->PAYE->CurrentValue;
		$this->PAYE->PlaceHolder = RemoveHtml($this->PAYE->caption());
		if (strval($this->PAYE->EditValue) != "" && is_numeric($this->PAYE->EditValue))
			$this->PAYE->EditValue = FormatNumber($this->PAYE->EditValue, -2, -2, -2, -2);
		

		// TaxCredit
		$this->TaxCredit->EditAttrs["class"] = "form-control";
		$this->TaxCredit->EditCustomAttributes = "";
		$this->TaxCredit->EditValue = $this->TaxCredit->CurrentValue;
		$this->TaxCredit->PlaceHolder = RemoveHtml($this->TaxCredit->caption());
		if (strval($this->TaxCredit->EditValue) != "" && is_numeric($this->TaxCredit->EditValue))
			$this->TaxCredit->EditValue = FormatNumber($this->TaxCredit->EditValue, -2, -2, -2, -2);
		

		// Adjustment
		$this->Adjustment->EditAttrs["class"] = "form-control";
		$this->Adjustment->EditCustomAttributes = "";
		$this->Adjustment->EditValue = $this->Adjustment->CurrentValue;
		$this->Adjustment->PlaceHolder = RemoveHtml($this->Adjustment->caption());

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
					$doc->exportCaption($this->DepartmentName);
					$doc->exportCaption($this->SectionName);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->EmployeeNames);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->EmploymentTypeDesc);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->MonthShort);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->GrossIncome);
					$doc->exportCaption($this->TaxableIncome);
					$doc->exportCaption($this->PAYE);
					$doc->exportCaption($this->TaxCredit);
					$doc->exportCaption($this->Adjustment);
				} else {
					$doc->exportCaption($this->LocalAuthority);
					$doc->exportCaption($this->DepartmentName);
					$doc->exportCaption($this->SectionName);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->EmploymentTypeDesc);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->MonthShort);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->GrossIncome);
					$doc->exportCaption($this->TaxableIncome);
					$doc->exportCaption($this->PAYE);
					$doc->exportCaption($this->TaxCredit);
					$doc->exportCaption($this->Adjustment);
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
						$doc->exportField($this->DepartmentName);
						$doc->exportField($this->SectionName);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->EmployeeNames);
						$doc->exportField($this->NRC);
						$doc->exportField($this->EmploymentTypeDesc);
						$doc->exportField($this->Year);
						$doc->exportField($this->MonthShort);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->GrossIncome);
						$doc->exportField($this->TaxableIncome);
						$doc->exportField($this->PAYE);
						$doc->exportField($this->TaxCredit);
						$doc->exportField($this->Adjustment);
					} else {
						$doc->exportField($this->LocalAuthority);
						$doc->exportField($this->DepartmentName);
						$doc->exportField($this->SectionName);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->NRC);
						$doc->exportField($this->EmploymentTypeDesc);
						$doc->exportField($this->Year);
						$doc->exportField($this->MonthShort);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->GrossIncome);
						$doc->exportField($this->TaxableIncome);
						$doc->exportField($this->PAYE);
						$doc->exportField($this->TaxCredit);
						$doc->exportField($this->Adjustment);
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