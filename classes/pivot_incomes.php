<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for pivot_incomes
 */
class pivot_incomes extends DbTable
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
	public $FirstName;
	public $MiddleName;
	public $Surname;
	public $NRC;
	public $Basic_Salary;
	public $Housing_Allowance;
	public $Transport_Allowance;
	public $Education_Allowance;
	public $Rural_Hardship_Allowance;
	public $Acting_Allowance;
	public $Ration_Allowance;
	public $StandBy_Allowance;
	public $In_Leu_of_Excess_hours_Allowance;
	public $Overtime;
	public $Settling_in_allowance;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'pivot_incomes';
		$this->TableName = 'pivot_incomes';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`pivot_incomes`";
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
		$this->EmployeeID = new DbField('pivot_incomes', 'pivot_incomes', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// FirstName
		$this->FirstName = new DbField('pivot_incomes', 'pivot_incomes', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('pivot_incomes', 'pivot_incomes', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Surname
		$this->Surname = new DbField('pivot_incomes', 'pivot_incomes', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// NRC
		$this->NRC = new DbField('pivot_incomes', 'pivot_incomes', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->fields['NRC'] = &$this->NRC;

		// Basic Salary
		$this->Basic_Salary = new DbField('pivot_incomes', 'pivot_incomes', 'x_Basic_Salary', 'Basic Salary', '`Basic Salary`', '`Basic Salary`', 5, 23, -1, FALSE, '`Basic Salary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Basic_Salary->Sortable = TRUE; // Allow sort
		$this->Basic_Salary->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Basic Salary'] = &$this->Basic_Salary;

		// Housing Allowance
		$this->Housing_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Housing_Allowance', 'Housing Allowance', '`Housing Allowance`', '`Housing Allowance`', 5, 23, -1, FALSE, '`Housing Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Housing_Allowance->Sortable = TRUE; // Allow sort
		$this->Housing_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Housing Allowance'] = &$this->Housing_Allowance;

		// Transport Allowance
		$this->Transport_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Transport_Allowance', 'Transport Allowance', '`Transport Allowance`', '`Transport Allowance`', 5, 23, -1, FALSE, '`Transport Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Transport_Allowance->Sortable = TRUE; // Allow sort
		$this->Transport_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Transport Allowance'] = &$this->Transport_Allowance;

		// Education Allowance
		$this->Education_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Education_Allowance', 'Education Allowance', '`Education Allowance`', '`Education Allowance`', 5, 23, -1, FALSE, '`Education Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Education_Allowance->Sortable = TRUE; // Allow sort
		$this->Education_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Education Allowance'] = &$this->Education_Allowance;

		// Rural Hardship Allowance
		$this->Rural_Hardship_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Rural_Hardship_Allowance', 'Rural Hardship Allowance', '`Rural Hardship Allowance`', '`Rural Hardship Allowance`', 5, 23, -1, FALSE, '`Rural Hardship Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rural_Hardship_Allowance->Sortable = TRUE; // Allow sort
		$this->Rural_Hardship_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Rural Hardship Allowance'] = &$this->Rural_Hardship_Allowance;

		// Acting Allowance
		$this->Acting_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Acting_Allowance', 'Acting Allowance', '`Acting Allowance`', '`Acting Allowance`', 5, 23, -1, FALSE, '`Acting Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Acting_Allowance->Sortable = TRUE; // Allow sort
		$this->Acting_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Acting Allowance'] = &$this->Acting_Allowance;

		// Ration Allowance
		$this->Ration_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Ration_Allowance', 'Ration Allowance', '`Ration Allowance`', '`Ration Allowance`', 5, 23, -1, FALSE, '`Ration Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Ration_Allowance->Sortable = TRUE; // Allow sort
		$this->Ration_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Ration Allowance'] = &$this->Ration_Allowance;

		// StandBy Allowance
		$this->StandBy_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_StandBy_Allowance', 'StandBy Allowance', '`StandBy Allowance`', '`StandBy Allowance`', 5, 23, -1, FALSE, '`StandBy Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StandBy_Allowance->Sortable = TRUE; // Allow sort
		$this->StandBy_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['StandBy Allowance'] = &$this->StandBy_Allowance;

		// In Leu of Excess hours Allowance
		$this->In_Leu_of_Excess_hours_Allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_In_Leu_of_Excess_hours_Allowance', 'In Leu of Excess hours Allowance', '`In Leu of Excess hours Allowance`', '`In Leu of Excess hours Allowance`', 5, 23, -1, FALSE, '`In Leu of Excess hours Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->In_Leu_of_Excess_hours_Allowance->Sortable = TRUE; // Allow sort
		$this->In_Leu_of_Excess_hours_Allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['In Leu of Excess hours Allowance'] = &$this->In_Leu_of_Excess_hours_Allowance;

		// Overtime
		$this->Overtime = new DbField('pivot_incomes', 'pivot_incomes', 'x_Overtime', 'Overtime', '`Overtime`', '`Overtime`', 5, 23, -1, FALSE, '`Overtime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Overtime->Sortable = TRUE; // Allow sort
		$this->Overtime->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Overtime'] = &$this->Overtime;

		// Settling in allowance
		$this->Settling_in_allowance = new DbField('pivot_incomes', 'pivot_incomes', 'x_Settling_in_allowance', 'Settling in allowance', '`Settling in allowance`', '`Settling in allowance`', 5, 23, -1, FALSE, '`Settling in allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Settling_in_allowance->Sortable = TRUE; // Allow sort
		$this->Settling_in_allowance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Settling in allowance'] = &$this->Settling_in_allowance;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`pivot_incomes`";
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
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->Surname->DbValue = $row['Surname'];
		$this->NRC->DbValue = $row['NRC'];
		$this->Basic_Salary->DbValue = $row['Basic Salary'];
		$this->Housing_Allowance->DbValue = $row['Housing Allowance'];
		$this->Transport_Allowance->DbValue = $row['Transport Allowance'];
		$this->Education_Allowance->DbValue = $row['Education Allowance'];
		$this->Rural_Hardship_Allowance->DbValue = $row['Rural Hardship Allowance'];
		$this->Acting_Allowance->DbValue = $row['Acting Allowance'];
		$this->Ration_Allowance->DbValue = $row['Ration Allowance'];
		$this->StandBy_Allowance->DbValue = $row['StandBy Allowance'];
		$this->In_Leu_of_Excess_hours_Allowance->DbValue = $row['In Leu of Excess hours Allowance'];
		$this->Overtime->DbValue = $row['Overtime'];
		$this->Settling_in_allowance->DbValue = $row['Settling in allowance'];
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
			return "pivot_incomeslist.php";
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
		if ($pageName == "pivot_incomesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "pivot_incomesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "pivot_incomesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "pivot_incomeslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("pivot_incomesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("pivot_incomesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "pivot_incomesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "pivot_incomesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("pivot_incomesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("pivot_incomesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("pivot_incomesdelete.php", $this->getUrlParm());
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
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->NRC->setDbValue($rs->fields('NRC'));
		$this->Basic_Salary->setDbValue($rs->fields('Basic Salary'));
		$this->Housing_Allowance->setDbValue($rs->fields('Housing Allowance'));
		$this->Transport_Allowance->setDbValue($rs->fields('Transport Allowance'));
		$this->Education_Allowance->setDbValue($rs->fields('Education Allowance'));
		$this->Rural_Hardship_Allowance->setDbValue($rs->fields('Rural Hardship Allowance'));
		$this->Acting_Allowance->setDbValue($rs->fields('Acting Allowance'));
		$this->Ration_Allowance->setDbValue($rs->fields('Ration Allowance'));
		$this->StandBy_Allowance->setDbValue($rs->fields('StandBy Allowance'));
		$this->In_Leu_of_Excess_hours_Allowance->setDbValue($rs->fields('In Leu of Excess hours Allowance'));
		$this->Overtime->setDbValue($rs->fields('Overtime'));
		$this->Settling_in_allowance->setDbValue($rs->fields('Settling in allowance'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// FirstName
		// MiddleName
		// Surname
		// NRC
		// Basic Salary
		// Housing Allowance
		// Transport Allowance
		// Education Allowance
		// Rural Hardship Allowance
		// Acting Allowance
		// Ration Allowance
		// StandBy Allowance
		// In Leu of Excess hours Allowance
		// Overtime
		// Settling in allowance
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// NRC
		$this->NRC->ViewValue = $this->NRC->CurrentValue;
		$this->NRC->ViewCustomAttributes = "";

		// Basic Salary
		$this->Basic_Salary->ViewValue = $this->Basic_Salary->CurrentValue;
		$this->Basic_Salary->ViewValue = FormatNumber($this->Basic_Salary->ViewValue, 2, -2, -2, -2);
		$this->Basic_Salary->ViewCustomAttributes = "";

		// Housing Allowance
		$this->Housing_Allowance->ViewValue = $this->Housing_Allowance->CurrentValue;
		$this->Housing_Allowance->ViewValue = FormatNumber($this->Housing_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Housing_Allowance->ViewCustomAttributes = "";

		// Transport Allowance
		$this->Transport_Allowance->ViewValue = $this->Transport_Allowance->CurrentValue;
		$this->Transport_Allowance->ViewValue = FormatNumber($this->Transport_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Transport_Allowance->ViewCustomAttributes = "";

		// Education Allowance
		$this->Education_Allowance->ViewValue = $this->Education_Allowance->CurrentValue;
		$this->Education_Allowance->ViewValue = FormatNumber($this->Education_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Education_Allowance->ViewCustomAttributes = "";

		// Rural Hardship Allowance
		$this->Rural_Hardship_Allowance->ViewValue = $this->Rural_Hardship_Allowance->CurrentValue;
		$this->Rural_Hardship_Allowance->ViewValue = FormatNumber($this->Rural_Hardship_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Rural_Hardship_Allowance->ViewCustomAttributes = "";

		// Acting Allowance
		$this->Acting_Allowance->ViewValue = $this->Acting_Allowance->CurrentValue;
		$this->Acting_Allowance->ViewValue = FormatNumber($this->Acting_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Acting_Allowance->ViewCustomAttributes = "";

		// Ration Allowance
		$this->Ration_Allowance->ViewValue = $this->Ration_Allowance->CurrentValue;
		$this->Ration_Allowance->ViewValue = FormatNumber($this->Ration_Allowance->ViewValue, 2, -2, -2, -2);
		$this->Ration_Allowance->ViewCustomAttributes = "";

		// StandBy Allowance
		$this->StandBy_Allowance->ViewValue = $this->StandBy_Allowance->CurrentValue;
		$this->StandBy_Allowance->ViewValue = FormatNumber($this->StandBy_Allowance->ViewValue, 2, -2, -2, -2);
		$this->StandBy_Allowance->ViewCustomAttributes = "";

		// In Leu of Excess hours Allowance
		$this->In_Leu_of_Excess_hours_Allowance->ViewValue = $this->In_Leu_of_Excess_hours_Allowance->CurrentValue;
		$this->In_Leu_of_Excess_hours_Allowance->ViewValue = FormatNumber($this->In_Leu_of_Excess_hours_Allowance->ViewValue, 2, -2, -2, -2);
		$this->In_Leu_of_Excess_hours_Allowance->ViewCustomAttributes = "";

		// Overtime
		$this->Overtime->ViewValue = $this->Overtime->CurrentValue;
		$this->Overtime->ViewValue = FormatNumber($this->Overtime->ViewValue, 2, -2, -2, -2);
		$this->Overtime->ViewCustomAttributes = "";

		// Settling in allowance
		$this->Settling_in_allowance->ViewValue = $this->Settling_in_allowance->CurrentValue;
		$this->Settling_in_allowance->ViewValue = FormatNumber($this->Settling_in_allowance->ViewValue, 2, -2, -2, -2);
		$this->Settling_in_allowance->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// MiddleName
		$this->MiddleName->LinkCustomAttributes = "";
		$this->MiddleName->HrefValue = "";
		$this->MiddleName->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// NRC
		$this->NRC->LinkCustomAttributes = "";
		$this->NRC->HrefValue = "";
		$this->NRC->TooltipValue = "";

		// Basic Salary
		$this->Basic_Salary->LinkCustomAttributes = "";
		$this->Basic_Salary->HrefValue = "";
		$this->Basic_Salary->TooltipValue = "";

		// Housing Allowance
		$this->Housing_Allowance->LinkCustomAttributes = "";
		$this->Housing_Allowance->HrefValue = "";
		$this->Housing_Allowance->TooltipValue = "";

		// Transport Allowance
		$this->Transport_Allowance->LinkCustomAttributes = "";
		$this->Transport_Allowance->HrefValue = "";
		$this->Transport_Allowance->TooltipValue = "";

		// Education Allowance
		$this->Education_Allowance->LinkCustomAttributes = "";
		$this->Education_Allowance->HrefValue = "";
		$this->Education_Allowance->TooltipValue = "";

		// Rural Hardship Allowance
		$this->Rural_Hardship_Allowance->LinkCustomAttributes = "";
		$this->Rural_Hardship_Allowance->HrefValue = "";
		$this->Rural_Hardship_Allowance->TooltipValue = "";

		// Acting Allowance
		$this->Acting_Allowance->LinkCustomAttributes = "";
		$this->Acting_Allowance->HrefValue = "";
		$this->Acting_Allowance->TooltipValue = "";

		// Ration Allowance
		$this->Ration_Allowance->LinkCustomAttributes = "";
		$this->Ration_Allowance->HrefValue = "";
		$this->Ration_Allowance->TooltipValue = "";

		// StandBy Allowance
		$this->StandBy_Allowance->LinkCustomAttributes = "";
		$this->StandBy_Allowance->HrefValue = "";
		$this->StandBy_Allowance->TooltipValue = "";

		// In Leu of Excess hours Allowance
		$this->In_Leu_of_Excess_hours_Allowance->LinkCustomAttributes = "";
		$this->In_Leu_of_Excess_hours_Allowance->HrefValue = "";
		$this->In_Leu_of_Excess_hours_Allowance->TooltipValue = "";

		// Overtime
		$this->Overtime->LinkCustomAttributes = "";
		$this->Overtime->HrefValue = "";
		$this->Overtime->TooltipValue = "";

		// Settling in allowance
		$this->Settling_in_allowance->LinkCustomAttributes = "";
		$this->Settling_in_allowance->HrefValue = "";
		$this->Settling_in_allowance->TooltipValue = "";

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

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// NRC
		$this->NRC->EditAttrs["class"] = "form-control";
		$this->NRC->EditCustomAttributes = "";
		if (!$this->NRC->Raw)
			$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
		$this->NRC->EditValue = $this->NRC->CurrentValue;
		$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

		// Basic Salary
		$this->Basic_Salary->EditAttrs["class"] = "form-control";
		$this->Basic_Salary->EditCustomAttributes = "";
		$this->Basic_Salary->EditValue = $this->Basic_Salary->CurrentValue;
		$this->Basic_Salary->PlaceHolder = RemoveHtml($this->Basic_Salary->caption());
		if (strval($this->Basic_Salary->EditValue) != "" && is_numeric($this->Basic_Salary->EditValue))
			$this->Basic_Salary->EditValue = FormatNumber($this->Basic_Salary->EditValue, -2, -2, -2, -2);
		

		// Housing Allowance
		$this->Housing_Allowance->EditAttrs["class"] = "form-control";
		$this->Housing_Allowance->EditCustomAttributes = "";
		$this->Housing_Allowance->EditValue = $this->Housing_Allowance->CurrentValue;
		$this->Housing_Allowance->PlaceHolder = RemoveHtml($this->Housing_Allowance->caption());
		if (strval($this->Housing_Allowance->EditValue) != "" && is_numeric($this->Housing_Allowance->EditValue))
			$this->Housing_Allowance->EditValue = FormatNumber($this->Housing_Allowance->EditValue, -2, -2, -2, -2);
		

		// Transport Allowance
		$this->Transport_Allowance->EditAttrs["class"] = "form-control";
		$this->Transport_Allowance->EditCustomAttributes = "";
		$this->Transport_Allowance->EditValue = $this->Transport_Allowance->CurrentValue;
		$this->Transport_Allowance->PlaceHolder = RemoveHtml($this->Transport_Allowance->caption());
		if (strval($this->Transport_Allowance->EditValue) != "" && is_numeric($this->Transport_Allowance->EditValue))
			$this->Transport_Allowance->EditValue = FormatNumber($this->Transport_Allowance->EditValue, -2, -2, -2, -2);
		

		// Education Allowance
		$this->Education_Allowance->EditAttrs["class"] = "form-control";
		$this->Education_Allowance->EditCustomAttributes = "";
		$this->Education_Allowance->EditValue = $this->Education_Allowance->CurrentValue;
		$this->Education_Allowance->PlaceHolder = RemoveHtml($this->Education_Allowance->caption());
		if (strval($this->Education_Allowance->EditValue) != "" && is_numeric($this->Education_Allowance->EditValue))
			$this->Education_Allowance->EditValue = FormatNumber($this->Education_Allowance->EditValue, -2, -2, -2, -2);
		

		// Rural Hardship Allowance
		$this->Rural_Hardship_Allowance->EditAttrs["class"] = "form-control";
		$this->Rural_Hardship_Allowance->EditCustomAttributes = "";
		$this->Rural_Hardship_Allowance->EditValue = $this->Rural_Hardship_Allowance->CurrentValue;
		$this->Rural_Hardship_Allowance->PlaceHolder = RemoveHtml($this->Rural_Hardship_Allowance->caption());
		if (strval($this->Rural_Hardship_Allowance->EditValue) != "" && is_numeric($this->Rural_Hardship_Allowance->EditValue))
			$this->Rural_Hardship_Allowance->EditValue = FormatNumber($this->Rural_Hardship_Allowance->EditValue, -2, -2, -2, -2);
		

		// Acting Allowance
		$this->Acting_Allowance->EditAttrs["class"] = "form-control";
		$this->Acting_Allowance->EditCustomAttributes = "";
		$this->Acting_Allowance->EditValue = $this->Acting_Allowance->CurrentValue;
		$this->Acting_Allowance->PlaceHolder = RemoveHtml($this->Acting_Allowance->caption());
		if (strval($this->Acting_Allowance->EditValue) != "" && is_numeric($this->Acting_Allowance->EditValue))
			$this->Acting_Allowance->EditValue = FormatNumber($this->Acting_Allowance->EditValue, -2, -2, -2, -2);
		

		// Ration Allowance
		$this->Ration_Allowance->EditAttrs["class"] = "form-control";
		$this->Ration_Allowance->EditCustomAttributes = "";
		$this->Ration_Allowance->EditValue = $this->Ration_Allowance->CurrentValue;
		$this->Ration_Allowance->PlaceHolder = RemoveHtml($this->Ration_Allowance->caption());
		if (strval($this->Ration_Allowance->EditValue) != "" && is_numeric($this->Ration_Allowance->EditValue))
			$this->Ration_Allowance->EditValue = FormatNumber($this->Ration_Allowance->EditValue, -2, -2, -2, -2);
		

		// StandBy Allowance
		$this->StandBy_Allowance->EditAttrs["class"] = "form-control";
		$this->StandBy_Allowance->EditCustomAttributes = "";
		$this->StandBy_Allowance->EditValue = $this->StandBy_Allowance->CurrentValue;
		$this->StandBy_Allowance->PlaceHolder = RemoveHtml($this->StandBy_Allowance->caption());
		if (strval($this->StandBy_Allowance->EditValue) != "" && is_numeric($this->StandBy_Allowance->EditValue))
			$this->StandBy_Allowance->EditValue = FormatNumber($this->StandBy_Allowance->EditValue, -2, -2, -2, -2);
		

		// In Leu of Excess hours Allowance
		$this->In_Leu_of_Excess_hours_Allowance->EditAttrs["class"] = "form-control";
		$this->In_Leu_of_Excess_hours_Allowance->EditCustomAttributes = "";
		$this->In_Leu_of_Excess_hours_Allowance->EditValue = $this->In_Leu_of_Excess_hours_Allowance->CurrentValue;
		$this->In_Leu_of_Excess_hours_Allowance->PlaceHolder = RemoveHtml($this->In_Leu_of_Excess_hours_Allowance->caption());
		if (strval($this->In_Leu_of_Excess_hours_Allowance->EditValue) != "" && is_numeric($this->In_Leu_of_Excess_hours_Allowance->EditValue))
			$this->In_Leu_of_Excess_hours_Allowance->EditValue = FormatNumber($this->In_Leu_of_Excess_hours_Allowance->EditValue, -2, -2, -2, -2);
		

		// Overtime
		$this->Overtime->EditAttrs["class"] = "form-control";
		$this->Overtime->EditCustomAttributes = "";
		$this->Overtime->EditValue = $this->Overtime->CurrentValue;
		$this->Overtime->PlaceHolder = RemoveHtml($this->Overtime->caption());
		if (strval($this->Overtime->EditValue) != "" && is_numeric($this->Overtime->EditValue))
			$this->Overtime->EditValue = FormatNumber($this->Overtime->EditValue, -2, -2, -2, -2);
		

		// Settling in allowance
		$this->Settling_in_allowance->EditAttrs["class"] = "form-control";
		$this->Settling_in_allowance->EditCustomAttributes = "";
		$this->Settling_in_allowance->EditValue = $this->Settling_in_allowance->CurrentValue;
		$this->Settling_in_allowance->PlaceHolder = RemoveHtml($this->Settling_in_allowance->caption());
		if (strval($this->Settling_in_allowance->EditValue) != "" && is_numeric($this->Settling_in_allowance->EditValue))
			$this->Settling_in_allowance->EditValue = FormatNumber($this->Settling_in_allowance->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->Basic_Salary);
					$doc->exportCaption($this->Housing_Allowance);
					$doc->exportCaption($this->Transport_Allowance);
					$doc->exportCaption($this->Education_Allowance);
					$doc->exportCaption($this->Rural_Hardship_Allowance);
					$doc->exportCaption($this->Acting_Allowance);
					$doc->exportCaption($this->Ration_Allowance);
					$doc->exportCaption($this->StandBy_Allowance);
					$doc->exportCaption($this->In_Leu_of_Excess_hours_Allowance);
					$doc->exportCaption($this->Overtime);
					$doc->exportCaption($this->Settling_in_allowance);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->Basic_Salary);
					$doc->exportCaption($this->Housing_Allowance);
					$doc->exportCaption($this->Transport_Allowance);
					$doc->exportCaption($this->Education_Allowance);
					$doc->exportCaption($this->Rural_Hardship_Allowance);
					$doc->exportCaption($this->Acting_Allowance);
					$doc->exportCaption($this->Ration_Allowance);
					$doc->exportCaption($this->StandBy_Allowance);
					$doc->exportCaption($this->In_Leu_of_Excess_hours_Allowance);
					$doc->exportCaption($this->Overtime);
					$doc->exportCaption($this->Settling_in_allowance);
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
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->NRC);
						$doc->exportField($this->Basic_Salary);
						$doc->exportField($this->Housing_Allowance);
						$doc->exportField($this->Transport_Allowance);
						$doc->exportField($this->Education_Allowance);
						$doc->exportField($this->Rural_Hardship_Allowance);
						$doc->exportField($this->Acting_Allowance);
						$doc->exportField($this->Ration_Allowance);
						$doc->exportField($this->StandBy_Allowance);
						$doc->exportField($this->In_Leu_of_Excess_hours_Allowance);
						$doc->exportField($this->Overtime);
						$doc->exportField($this->Settling_in_allowance);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->NRC);
						$doc->exportField($this->Basic_Salary);
						$doc->exportField($this->Housing_Allowance);
						$doc->exportField($this->Transport_Allowance);
						$doc->exportField($this->Education_Allowance);
						$doc->exportField($this->Rural_Hardship_Allowance);
						$doc->exportField($this->Acting_Allowance);
						$doc->exportField($this->Ration_Allowance);
						$doc->exportField($this->StandBy_Allowance);
						$doc->exportField($this->In_Leu_of_Excess_hours_Allowance);
						$doc->exportField($this->Overtime);
						$doc->exportField($this->Settling_in_allowance);
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