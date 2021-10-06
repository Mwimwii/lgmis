<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for napsa
 */
class napsa extends DbTable
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
	public $Account_Number;
	public $FirstName;
	public $Surname;
	public $Other_Name;
	public $Year;
	public $Month;
	public $Sex;
	public $SSNO;
	public $NRC;
	public $PositionName;
	public $Date_Of_Birth;
	public $SalaryScale;
	public $PayrollPeriod;
	public $PayMonth;
	public $Rebased_Gross_Wage;
	public $Employer_Share;
	public $Employee_Share;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'napsa';
		$this->TableName = 'napsa';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`napsa`";
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

		// Account Number
		$this->Account_Number = new DbField('napsa', 'napsa', 'x_Account_Number', 'Account Number', '`Account Number`', '`Account Number`', 3, 11, -1, FALSE, '`Account Number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Account_Number->IsPrimaryKey = TRUE; // Primary key field
		$this->Account_Number->Nullable = FALSE; // NOT NULL field
		$this->Account_Number->Required = TRUE; // Required field
		$this->Account_Number->Sortable = TRUE; // Allow sort
		$this->Account_Number->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Account Number'] = &$this->Account_Number;

		// FirstName
		$this->FirstName = new DbField('napsa', 'napsa', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// Surname
		$this->Surname = new DbField('napsa', 'napsa', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// Other Name
		$this->Other_Name = new DbField('napsa', 'napsa', 'x_Other_Name', 'Other Name', '`Other Name`', '`Other Name`', 200, 100, -1, FALSE, '`Other Name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Other_Name->Sortable = TRUE; // Allow sort
		$this->fields['Other Name'] = &$this->Other_Name;

		// Year
		$this->Year = new DbField('napsa', 'napsa', 'x_Year', 'Year', '`Year`', '`Year`', 18, 4, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Nullable = FALSE; // NOT NULL field
		$this->Year->Required = TRUE; // Required field
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year'] = &$this->Year;

		// Month
		$this->Month = new DbField('napsa', 'napsa', 'x_Month', 'Month', '`Month`', '`Month`', 16, 2, -1, FALSE, '`Month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Month->Nullable = FALSE; // NOT NULL field
		$this->Month->Required = TRUE; // Required field
		$this->Month->Sortable = TRUE; // Allow sort
		$this->Month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Month'] = &$this->Month;

		// Sex
		$this->Sex = new DbField('napsa', 'napsa', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->fields['Sex'] = &$this->Sex;

		// SSNO
		$this->SSNO = new DbField('napsa', 'napsa', 'x_SSNO', 'SSNO', '`SSNO`', '`SSNO`', 200, 50, -1, FALSE, '`SSNO`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SSNO->Sortable = TRUE; // Allow sort
		$this->fields['SSNO'] = &$this->SSNO;

		// NRC
		$this->NRC = new DbField('napsa', 'napsa', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->fields['NRC'] = &$this->NRC;

		// PositionName
		$this->PositionName = new DbField('napsa', 'napsa', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->fields['PositionName'] = &$this->PositionName;

		// Date Of Birth
		$this->Date_Of_Birth = new DbField('napsa', 'napsa', 'x_Date_Of_Birth', 'Date Of Birth', '`Date Of Birth`', CastDateFieldForLike("`Date Of Birth`", 0, "DB"), 133, 10, 0, FALSE, '`Date Of Birth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Date_Of_Birth->Nullable = FALSE; // NOT NULL field
		$this->Date_Of_Birth->Required = TRUE; // Required field
		$this->Date_Of_Birth->Sortable = TRUE; // Allow sort
		$this->Date_Of_Birth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Date Of Birth'] = &$this->Date_Of_Birth;

		// SalaryScale
		$this->SalaryScale = new DbField('napsa', 'napsa', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 10, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('napsa', 'napsa', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->IsPrimaryKey = TRUE; // Primary key field
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// PayMonth
		$this->PayMonth = new DbField('napsa', 'napsa', 'x_PayMonth', 'PayMonth', '`PayMonth`', '`PayMonth`', 200, 25, -1, FALSE, '`PayMonth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayMonth->Nullable = FALSE; // NOT NULL field
		$this->PayMonth->Required = TRUE; // Required field
		$this->PayMonth->Sortable = TRUE; // Allow sort
		$this->fields['PayMonth'] = &$this->PayMonth;

		// Rebased Gross Wage
		$this->Rebased_Gross_Wage = new DbField('napsa', 'napsa', 'x_Rebased_Gross_Wage', 'Rebased Gross Wage', '`Rebased Gross Wage`', '`Rebased Gross Wage`', 5, 23, -1, FALSE, '`Rebased Gross Wage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rebased_Gross_Wage->Sortable = TRUE; // Allow sort
		$this->Rebased_Gross_Wage->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Rebased Gross Wage'] = &$this->Rebased_Gross_Wage;

		// Employer Share
		$this->Employer_Share = new DbField('napsa', 'napsa', 'x_Employer_Share', 'Employer Share', '`Employer Share`', '`Employer Share`', 5, 19, -1, FALSE, '`Employer Share`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Employer_Share->Nullable = FALSE; // NOT NULL field
		$this->Employer_Share->Sortable = TRUE; // Allow sort
		$this->Employer_Share->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Employer Share'] = &$this->Employer_Share;

		// Employee Share
		$this->Employee_Share = new DbField('napsa', 'napsa', 'x_Employee_Share', 'Employee Share', '`Employee Share`', '`Employee Share`', 5, 19, -1, FALSE, '`Employee Share`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Employee_Share->Nullable = FALSE; // NOT NULL field
		$this->Employee_Share->Sortable = TRUE; // Allow sort
		$this->Employee_Share->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Employee Share'] = &$this->Employee_Share;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`napsa`";
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
			if (array_key_exists('Account Number', $rs))
				AddFilter($where, QuotedName('Account Number', $this->Dbid) . '=' . QuotedValue($rs['Account Number'], $this->Account_Number->DataType, $this->Dbid));
			if (array_key_exists('PayrollPeriod', $rs))
				AddFilter($where, QuotedName('PayrollPeriod', $this->Dbid) . '=' . QuotedValue($rs['PayrollPeriod'], $this->PayrollPeriod->DataType, $this->Dbid));
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
		$this->Account_Number->DbValue = $row['Account Number'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->Surname->DbValue = $row['Surname'];
		$this->Other_Name->DbValue = $row['Other Name'];
		$this->Year->DbValue = $row['Year'];
		$this->Month->DbValue = $row['Month'];
		$this->Sex->DbValue = $row['Sex'];
		$this->SSNO->DbValue = $row['SSNO'];
		$this->NRC->DbValue = $row['NRC'];
		$this->PositionName->DbValue = $row['PositionName'];
		$this->Date_Of_Birth->DbValue = $row['Date Of Birth'];
		$this->SalaryScale->DbValue = $row['SalaryScale'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->PayMonth->DbValue = $row['PayMonth'];
		$this->Rebased_Gross_Wage->DbValue = $row['Rebased Gross Wage'];
		$this->Employer_Share->DbValue = $row['Employer Share'];
		$this->Employee_Share->DbValue = $row['Employee Share'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Account Number` = @Account_Number@ AND `PayrollPeriod` = @PayrollPeriod@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('Account Number', $row) ? $row['Account Number'] : NULL;
		else
			$val = $this->Account_Number->OldValue !== NULL ? $this->Account_Number->OldValue : $this->Account_Number->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Account_Number@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "napsalist.php";
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
		if ($pageName == "napsaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "napsaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "napsaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "napsalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("napsaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("napsaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "napsaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "napsaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("napsaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("napsaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("napsadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Account_Number:" . JsonEncode($this->Account_Number->CurrentValue, "number");
		$json .= ",PayrollPeriod:" . JsonEncode($this->PayrollPeriod->CurrentValue, "number");
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
		if ($this->Account_Number->CurrentValue != NULL) {
			$url .= "Account_Number=" . urlencode($this->Account_Number->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->PayrollPeriod->CurrentValue != NULL) {
			$url .= "&PayrollPeriod=" . urlencode($this->PayrollPeriod->CurrentValue);
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
			if (Param("Account_Number") !== NULL)
				$arKey[] = Param("Account_Number");
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
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // Account Number
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
				$this->Account_Number->CurrentValue = $key[0];
			else
				$this->Account_Number->OldValue = $key[0];
			if ($setCurrent)
				$this->PayrollPeriod->CurrentValue = $key[1];
			else
				$this->PayrollPeriod->OldValue = $key[1];
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
		$this->Account_Number->setDbValue($rs->fields('Account Number'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->Other_Name->setDbValue($rs->fields('Other Name'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->Month->setDbValue($rs->fields('Month'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->SSNO->setDbValue($rs->fields('SSNO'));
		$this->NRC->setDbValue($rs->fields('NRC'));
		$this->PositionName->setDbValue($rs->fields('PositionName'));
		$this->Date_Of_Birth->setDbValue($rs->fields('Date Of Birth'));
		$this->SalaryScale->setDbValue($rs->fields('SalaryScale'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->PayMonth->setDbValue($rs->fields('PayMonth'));
		$this->Rebased_Gross_Wage->setDbValue($rs->fields('Rebased Gross Wage'));
		$this->Employer_Share->setDbValue($rs->fields('Employer Share'));
		$this->Employee_Share->setDbValue($rs->fields('Employee Share'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Account Number
		// FirstName
		// Surname
		// Other Name
		// Year
		// Month
		// Sex
		// SSNO
		// NRC
		// PositionName
		// Date Of Birth
		// SalaryScale
		// PayrollPeriod
		// PayMonth
		// Rebased Gross Wage
		// Employer Share
		// Employee Share
		// Account Number

		$this->Account_Number->ViewValue = $this->Account_Number->CurrentValue;
		$this->Account_Number->ViewValue = FormatNumber($this->Account_Number->ViewValue, 0, -2, -2, -2);
		$this->Account_Number->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// Other Name
		$this->Other_Name->ViewValue = $this->Other_Name->CurrentValue;
		$this->Other_Name->ViewCustomAttributes = "";

		// Year
		$this->Year->ViewValue = $this->Year->CurrentValue;
		$this->Year->ViewValue = FormatNumber($this->Year->ViewValue, 0, -2, -2, -2);
		$this->Year->ViewCustomAttributes = "";

		// Month
		$this->Month->ViewValue = $this->Month->CurrentValue;
		$this->Month->ViewValue = FormatNumber($this->Month->ViewValue, 0, -2, -2, -2);
		$this->Month->ViewCustomAttributes = "";

		// Sex
		$this->Sex->ViewValue = $this->Sex->CurrentValue;
		$this->Sex->ViewCustomAttributes = "";

		// SSNO
		$this->SSNO->ViewValue = $this->SSNO->CurrentValue;
		$this->SSNO->ViewCustomAttributes = "";

		// NRC
		$this->NRC->ViewValue = $this->NRC->CurrentValue;
		$this->NRC->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
		$this->PositionName->ViewCustomAttributes = "";

		// Date Of Birth
		$this->Date_Of_Birth->ViewValue = $this->Date_Of_Birth->CurrentValue;
		$this->Date_Of_Birth->ViewValue = FormatDateTime($this->Date_Of_Birth->ViewValue, 0);
		$this->Date_Of_Birth->ViewCustomAttributes = "";

		// SalaryScale
		$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
		$this->SalaryScale->ViewCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->ViewValue = FormatNumber($this->PayrollPeriod->ViewValue, 0, -2, -2, -2);
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// PayMonth
		$this->PayMonth->ViewValue = $this->PayMonth->CurrentValue;
		$this->PayMonth->ViewCustomAttributes = "";

		// Rebased Gross Wage
		$this->Rebased_Gross_Wage->ViewValue = $this->Rebased_Gross_Wage->CurrentValue;
		$this->Rebased_Gross_Wage->ViewValue = FormatNumber($this->Rebased_Gross_Wage->ViewValue, 2, -2, -2, -2);
		$this->Rebased_Gross_Wage->ViewCustomAttributes = "";

		// Employer Share
		$this->Employer_Share->ViewValue = $this->Employer_Share->CurrentValue;
		$this->Employer_Share->ViewValue = FormatNumber($this->Employer_Share->ViewValue, 2, -2, -2, -2);
		$this->Employer_Share->ViewCustomAttributes = "";

		// Employee Share
		$this->Employee_Share->ViewValue = $this->Employee_Share->CurrentValue;
		$this->Employee_Share->ViewValue = FormatNumber($this->Employee_Share->ViewValue, 2, -2, -2, -2);
		$this->Employee_Share->ViewCustomAttributes = "";

		// Account Number
		$this->Account_Number->LinkCustomAttributes = "";
		$this->Account_Number->HrefValue = "";
		$this->Account_Number->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// Other Name
		$this->Other_Name->LinkCustomAttributes = "";
		$this->Other_Name->HrefValue = "";
		$this->Other_Name->TooltipValue = "";

		// Year
		$this->Year->LinkCustomAttributes = "";
		$this->Year->HrefValue = "";
		$this->Year->TooltipValue = "";

		// Month
		$this->Month->LinkCustomAttributes = "";
		$this->Month->HrefValue = "";
		$this->Month->TooltipValue = "";

		// Sex
		$this->Sex->LinkCustomAttributes = "";
		$this->Sex->HrefValue = "";
		$this->Sex->TooltipValue = "";

		// SSNO
		$this->SSNO->LinkCustomAttributes = "";
		$this->SSNO->HrefValue = "";
		$this->SSNO->TooltipValue = "";

		// NRC
		$this->NRC->LinkCustomAttributes = "";
		$this->NRC->HrefValue = "";
		$this->NRC->TooltipValue = "";

		// PositionName
		$this->PositionName->LinkCustomAttributes = "";
		$this->PositionName->HrefValue = "";
		$this->PositionName->TooltipValue = "";

		// Date Of Birth
		$this->Date_Of_Birth->LinkCustomAttributes = "";
		$this->Date_Of_Birth->HrefValue = "";
		$this->Date_Of_Birth->TooltipValue = "";

		// SalaryScale
		$this->SalaryScale->LinkCustomAttributes = "";
		$this->SalaryScale->HrefValue = "";
		$this->SalaryScale->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// PayMonth
		$this->PayMonth->LinkCustomAttributes = "";
		$this->PayMonth->HrefValue = "";
		$this->PayMonth->TooltipValue = "";

		// Rebased Gross Wage
		$this->Rebased_Gross_Wage->LinkCustomAttributes = "";
		$this->Rebased_Gross_Wage->HrefValue = "";
		$this->Rebased_Gross_Wage->TooltipValue = "";

		// Employer Share
		$this->Employer_Share->LinkCustomAttributes = "";
		$this->Employer_Share->HrefValue = "";
		$this->Employer_Share->TooltipValue = "";

		// Employee Share
		$this->Employee_Share->LinkCustomAttributes = "";
		$this->Employee_Share->HrefValue = "";
		$this->Employee_Share->TooltipValue = "";

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

		// Account Number
		$this->Account_Number->EditAttrs["class"] = "form-control";
		$this->Account_Number->EditCustomAttributes = "";
		$this->Account_Number->EditValue = $this->Account_Number->CurrentValue;
		$this->Account_Number->PlaceHolder = RemoveHtml($this->Account_Number->caption());

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// Other Name
		$this->Other_Name->EditAttrs["class"] = "form-control";
		$this->Other_Name->EditCustomAttributes = "";
		if (!$this->Other_Name->Raw)
			$this->Other_Name->CurrentValue = HtmlDecode($this->Other_Name->CurrentValue);
		$this->Other_Name->EditValue = $this->Other_Name->CurrentValue;
		$this->Other_Name->PlaceHolder = RemoveHtml($this->Other_Name->caption());

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		$this->Year->EditValue = $this->Year->CurrentValue;
		$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

		// Month
		$this->Month->EditAttrs["class"] = "form-control";
		$this->Month->EditCustomAttributes = "";
		$this->Month->EditValue = $this->Month->CurrentValue;
		$this->Month->PlaceHolder = RemoveHtml($this->Month->caption());

		// Sex
		$this->Sex->EditAttrs["class"] = "form-control";
		$this->Sex->EditCustomAttributes = "";
		if (!$this->Sex->Raw)
			$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
		$this->Sex->EditValue = $this->Sex->CurrentValue;
		$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

		// SSNO
		$this->SSNO->EditAttrs["class"] = "form-control";
		$this->SSNO->EditCustomAttributes = "";
		if (!$this->SSNO->Raw)
			$this->SSNO->CurrentValue = HtmlDecode($this->SSNO->CurrentValue);
		$this->SSNO->EditValue = $this->SSNO->CurrentValue;
		$this->SSNO->PlaceHolder = RemoveHtml($this->SSNO->caption());

		// NRC
		$this->NRC->EditAttrs["class"] = "form-control";
		$this->NRC->EditCustomAttributes = "";
		if (!$this->NRC->Raw)
			$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
		$this->NRC->EditValue = $this->NRC->CurrentValue;
		$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

		// PositionName
		$this->PositionName->EditAttrs["class"] = "form-control";
		$this->PositionName->EditCustomAttributes = "";
		if (!$this->PositionName->Raw)
			$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
		$this->PositionName->EditValue = $this->PositionName->CurrentValue;
		$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

		// Date Of Birth
		$this->Date_Of_Birth->EditAttrs["class"] = "form-control";
		$this->Date_Of_Birth->EditCustomAttributes = "";
		$this->Date_Of_Birth->EditValue = FormatDateTime($this->Date_Of_Birth->CurrentValue, 8);
		$this->Date_Of_Birth->PlaceHolder = RemoveHtml($this->Date_Of_Birth->caption());

		// SalaryScale
		$this->SalaryScale->EditAttrs["class"] = "form-control";
		$this->SalaryScale->EditCustomAttributes = "";
		if (!$this->SalaryScale->Raw)
			$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
		$this->SalaryScale->EditValue = $this->SalaryScale->CurrentValue;
		$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";
		$this->PayrollPeriod->EditValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->PlaceHolder = RemoveHtml($this->PayrollPeriod->caption());

		// PayMonth
		$this->PayMonth->EditAttrs["class"] = "form-control";
		$this->PayMonth->EditCustomAttributes = "";
		if (!$this->PayMonth->Raw)
			$this->PayMonth->CurrentValue = HtmlDecode($this->PayMonth->CurrentValue);
		$this->PayMonth->EditValue = $this->PayMonth->CurrentValue;
		$this->PayMonth->PlaceHolder = RemoveHtml($this->PayMonth->caption());

		// Rebased Gross Wage
		$this->Rebased_Gross_Wage->EditAttrs["class"] = "form-control";
		$this->Rebased_Gross_Wage->EditCustomAttributes = "";
		$this->Rebased_Gross_Wage->EditValue = $this->Rebased_Gross_Wage->CurrentValue;
		$this->Rebased_Gross_Wage->PlaceHolder = RemoveHtml($this->Rebased_Gross_Wage->caption());
		if (strval($this->Rebased_Gross_Wage->EditValue) != "" && is_numeric($this->Rebased_Gross_Wage->EditValue))
			$this->Rebased_Gross_Wage->EditValue = FormatNumber($this->Rebased_Gross_Wage->EditValue, -2, -2, -2, -2);
		

		// Employer Share
		$this->Employer_Share->EditAttrs["class"] = "form-control";
		$this->Employer_Share->EditCustomAttributes = "";
		$this->Employer_Share->EditValue = $this->Employer_Share->CurrentValue;
		$this->Employer_Share->PlaceHolder = RemoveHtml($this->Employer_Share->caption());
		if (strval($this->Employer_Share->EditValue) != "" && is_numeric($this->Employer_Share->EditValue))
			$this->Employer_Share->EditValue = FormatNumber($this->Employer_Share->EditValue, -2, -2, -2, -2);
		

		// Employee Share
		$this->Employee_Share->EditAttrs["class"] = "form-control";
		$this->Employee_Share->EditCustomAttributes = "";
		$this->Employee_Share->EditValue = $this->Employee_Share->CurrentValue;
		$this->Employee_Share->PlaceHolder = RemoveHtml($this->Employee_Share->caption());
		if (strval($this->Employee_Share->EditValue) != "" && is_numeric($this->Employee_Share->EditValue))
			$this->Employee_Share->EditValue = FormatNumber($this->Employee_Share->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->Account_Number);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->Other_Name);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->Month);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->SSNO);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->Date_Of_Birth);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->PayMonth);
					$doc->exportCaption($this->Rebased_Gross_Wage);
					$doc->exportCaption($this->Employer_Share);
					$doc->exportCaption($this->Employee_Share);
				} else {
					$doc->exportCaption($this->Account_Number);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->Other_Name);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->Month);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->SSNO);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->Date_Of_Birth);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->PayMonth);
					$doc->exportCaption($this->Rebased_Gross_Wage);
					$doc->exportCaption($this->Employer_Share);
					$doc->exportCaption($this->Employee_Share);
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
						$doc->exportField($this->Account_Number);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->Other_Name);
						$doc->exportField($this->Year);
						$doc->exportField($this->Month);
						$doc->exportField($this->Sex);
						$doc->exportField($this->SSNO);
						$doc->exportField($this->NRC);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->Date_Of_Birth);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->PayMonth);
						$doc->exportField($this->Rebased_Gross_Wage);
						$doc->exportField($this->Employer_Share);
						$doc->exportField($this->Employee_Share);
					} else {
						$doc->exportField($this->Account_Number);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->Other_Name);
						$doc->exportField($this->Year);
						$doc->exportField($this->Month);
						$doc->exportField($this->Sex);
						$doc->exportField($this->SSNO);
						$doc->exportField($this->NRC);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->Date_Of_Birth);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->PayMonth);
						$doc->exportField($this->Rebased_Gross_Wage);
						$doc->exportField($this->Employer_Share);
						$doc->exportField($this->Employee_Share);
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