<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for program_budget_view
 */
class program_budget_view extends DbTable
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
	public $ProgramName;
	public $SubProgramName;
	public $LACode;
	public $FinancialYear;
	public $AccountCode;
	public $ActualAmount;
	public $AccountName;
	public $AccountGroupName;
	public $BudgetEstimate;
	public $DepartmentCode;
	public $SectionCode;
	public $OutputCode;
	public $OutputName;
	public $UnitOfMeasure;
	public $Quantity;
	public $PeriodType;
	public $PeriodLength;
	public $Frequency;
	public $UnitCost;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'program_budget_view';
		$this->TableName = 'program_budget_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`program_budget_view`";
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

		// ProgramName
		$this->ProgramName = new DbField('program_budget_view', 'program_budget_view', 'x_ProgramName', 'ProgramName', '`ProgramName`', '`ProgramName`', 200, 255, -1, FALSE, '`ProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramName->Nullable = FALSE; // NOT NULL field
		$this->ProgramName->Required = TRUE; // Required field
		$this->ProgramName->Sortable = TRUE; // Allow sort
		$this->fields['ProgramName'] = &$this->ProgramName;

		// SubProgramName
		$this->SubProgramName = new DbField('program_budget_view', 'program_budget_view', 'x_SubProgramName', 'SubProgramName', '`SubProgramName`', '`SubProgramName`', 200, 255, -1, FALSE, '`SubProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubProgramName->Nullable = FALSE; // NOT NULL field
		$this->SubProgramName->Required = TRUE; // Required field
		$this->SubProgramName->Sortable = TRUE; // Allow sort
		$this->fields['SubProgramName'] = &$this->SubProgramName;

		// LACode
		$this->LACode = new DbField('program_budget_view', 'program_budget_view', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->fields['LACode'] = &$this->LACode;

		// FinancialYear
		$this->FinancialYear = new DbField('program_budget_view', 'program_budget_view', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// AccountCode
		$this->AccountCode = new DbField('program_budget_view', 'program_budget_view', 'x_AccountCode', 'AccountCode', '`AccountCode`', '`AccountCode`', 200, 25, -1, FALSE, '`AccountCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountCode->Nullable = FALSE; // NOT NULL field
		$this->AccountCode->Required = TRUE; // Required field
		$this->AccountCode->Sortable = TRUE; // Allow sort
		$this->fields['AccountCode'] = &$this->AccountCode;

		// ActualAmount
		$this->ActualAmount = new DbField('program_budget_view', 'program_budget_view', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// AccountName
		$this->AccountName = new DbField('program_budget_view', 'program_budget_view', 'x_AccountName', 'AccountName', '`AccountName`', '`AccountName`', 200, 255, -1, FALSE, '`AccountName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountName->Nullable = FALSE; // NOT NULL field
		$this->AccountName->Required = TRUE; // Required field
		$this->AccountName->Sortable = TRUE; // Allow sort
		$this->fields['AccountName'] = &$this->AccountName;

		// AccountGroupName
		$this->AccountGroupName = new DbField('program_budget_view', 'program_budget_view', 'x_AccountGroupName', 'AccountGroupName', '`AccountGroupName`', '`AccountGroupName`', 200, 255, -1, FALSE, '`AccountGroupName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountGroupName->Sortable = TRUE; // Allow sort
		$this->fields['AccountGroupName'] = &$this->AccountGroupName;

		// BudgetEstimate
		$this->BudgetEstimate = new DbField('program_budget_view', 'program_budget_view', 'x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', '`BudgetEstimate`', 5, 22, -1, FALSE, '`BudgetEstimate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BudgetEstimate->Nullable = FALSE; // NOT NULL field
		$this->BudgetEstimate->Sortable = TRUE; // Allow sort
		$this->BudgetEstimate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BudgetEstimate'] = &$this->BudgetEstimate;

		// DepartmentCode
		$this->DepartmentCode = new DbField('program_budget_view', 'program_budget_view', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('program_budget_view', 'program_budget_view', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// OutputCode
		$this->OutputCode = new DbField('program_budget_view', 'program_budget_view', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->OutputCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->OutputCode->IsPrimaryKey = TRUE; // Primary key field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// OutputName
		$this->OutputName = new DbField('program_budget_view', 'program_budget_view', 'x_OutputName', 'OutputName', '`OutputName`', '`OutputName`', 200, 255, -1, FALSE, '`OutputName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputName->Nullable = FALSE; // NOT NULL field
		$this->OutputName->Required = TRUE; // Required field
		$this->OutputName->Sortable = TRUE; // Allow sort
		$this->fields['OutputName'] = &$this->OutputName;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('program_budget_view', 'program_budget_view', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 10, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// Quantity
		$this->Quantity = new DbField('program_budget_view', 'program_budget_view', 'x_Quantity', 'Quantity', '`Quantity`', '`Quantity`', 5, 22, -1, FALSE, '`Quantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Quantity->Nullable = FALSE; // NOT NULL field
		$this->Quantity->Required = TRUE; // Required field
		$this->Quantity->Sortable = TRUE; // Allow sort
		$this->Quantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Quantity'] = &$this->Quantity;

		// PeriodType
		$this->PeriodType = new DbField('program_budget_view', 'program_budget_view', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 200, 1, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->fields['PeriodType'] = &$this->PeriodType;

		// PeriodLength
		$this->PeriodLength = new DbField('program_budget_view', 'program_budget_view', 'x_PeriodLength', 'PeriodLength', '`PeriodLength`', '`PeriodLength`', 5, 22, -1, FALSE, '`PeriodLength`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PeriodLength->Sortable = TRUE; // Allow sort
		$this->PeriodLength->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PeriodLength'] = &$this->PeriodLength;

		// Frequency
		$this->Frequency = new DbField('program_budget_view', 'program_budget_view', 'x_Frequency', 'Frequency', '`Frequency`', '`Frequency`', 5, 22, -1, FALSE, '`Frequency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Frequency->Nullable = FALSE; // NOT NULL field
		$this->Frequency->Sortable = TRUE; // Allow sort
		$this->Frequency->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Frequency'] = &$this->Frequency;

		// UnitCost
		$this->UnitCost = new DbField('program_budget_view', 'program_budget_view', 'x_UnitCost', 'UnitCost', '`UnitCost`', '`UnitCost`', 5, 22, -1, FALSE, '`UnitCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitCost->Nullable = FALSE; // NOT NULL field
		$this->UnitCost->Required = TRUE; // Required field
		$this->UnitCost->Sortable = TRUE; // Allow sort
		$this->UnitCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['UnitCost'] = &$this->UnitCost;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`program_budget_view`";
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
			$this->OutputCode->setDbValue($conn->insert_ID());
			$rs['OutputCode'] = $this->OutputCode->DbValue;
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
			if (array_key_exists('OutputCode', $rs))
				AddFilter($where, QuotedName('OutputCode', $this->Dbid) . '=' . QuotedValue($rs['OutputCode'], $this->OutputCode->DataType, $this->Dbid));
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
		$this->ProgramName->DbValue = $row['ProgramName'];
		$this->SubProgramName->DbValue = $row['SubProgramName'];
		$this->LACode->DbValue = $row['LACode'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->AccountCode->DbValue = $row['AccountCode'];
		$this->ActualAmount->DbValue = $row['ActualAmount'];
		$this->AccountName->DbValue = $row['AccountName'];
		$this->AccountGroupName->DbValue = $row['AccountGroupName'];
		$this->BudgetEstimate->DbValue = $row['BudgetEstimate'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->OutputName->DbValue = $row['OutputName'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->Quantity->DbValue = $row['Quantity'];
		$this->PeriodType->DbValue = $row['PeriodType'];
		$this->PeriodLength->DbValue = $row['PeriodLength'];
		$this->Frequency->DbValue = $row['Frequency'];
		$this->UnitCost->DbValue = $row['UnitCost'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`OutputCode` = @OutputCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('OutputCode', $row) ? $row['OutputCode'] : NULL;
		else
			$val = $this->OutputCode->OldValue !== NULL ? $this->OutputCode->OldValue : $this->OutputCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@OutputCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "program_budget_viewlist.php";
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
		if ($pageName == "program_budget_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "program_budget_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "program_budget_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "program_budget_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("program_budget_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("program_budget_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "program_budget_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "program_budget_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("program_budget_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("program_budget_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("program_budget_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "OutputCode:" . JsonEncode($this->OutputCode->CurrentValue, "number");
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
		if ($this->OutputCode->CurrentValue != NULL) {
			$url .= "OutputCode=" . urlencode($this->OutputCode->CurrentValue);
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
			if (Param("OutputCode") !== NULL)
				$arKeys[] = Param("OutputCode");
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
				if (!is_numeric($key))
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
				$this->OutputCode->CurrentValue = $key;
			else
				$this->OutputCode->OldValue = $key;
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
		$this->ProgramName->setDbValue($rs->fields('ProgramName'));
		$this->SubProgramName->setDbValue($rs->fields('SubProgramName'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->AccountCode->setDbValue($rs->fields('AccountCode'));
		$this->ActualAmount->setDbValue($rs->fields('ActualAmount'));
		$this->AccountName->setDbValue($rs->fields('AccountName'));
		$this->AccountGroupName->setDbValue($rs->fields('AccountGroupName'));
		$this->BudgetEstimate->setDbValue($rs->fields('BudgetEstimate'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->OutputName->setDbValue($rs->fields('OutputName'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->Quantity->setDbValue($rs->fields('Quantity'));
		$this->PeriodType->setDbValue($rs->fields('PeriodType'));
		$this->PeriodLength->setDbValue($rs->fields('PeriodLength'));
		$this->Frequency->setDbValue($rs->fields('Frequency'));
		$this->UnitCost->setDbValue($rs->fields('UnitCost'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ProgramName
		// SubProgramName
		// LACode
		// FinancialYear
		// AccountCode
		// ActualAmount
		// AccountName
		// AccountGroupName
		// BudgetEstimate
		// DepartmentCode
		// SectionCode
		// OutputCode
		// OutputName
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// ProgramName

		$this->ProgramName->ViewValue = $this->ProgramName->CurrentValue;
		$this->ProgramName->ViewCustomAttributes = "";

		// SubProgramName
		$this->SubProgramName->ViewValue = $this->SubProgramName->CurrentValue;
		$this->SubProgramName->ViewCustomAttributes = "";

		// LACode
		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewValue = FormatNumber($this->FinancialYear->ViewValue, 0, -2, -2, -2);
		$this->FinancialYear->ViewCustomAttributes = "";

		// AccountCode
		$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
		$this->AccountCode->ViewCustomAttributes = "";

		// ActualAmount
		$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
		$this->ActualAmount->ViewCustomAttributes = "";

		// AccountName
		$this->AccountName->ViewValue = $this->AccountName->CurrentValue;
		$this->AccountName->ViewCustomAttributes = "";

		// AccountGroupName
		$this->AccountGroupName->ViewValue = $this->AccountGroupName->CurrentValue;
		$this->AccountGroupName->ViewCustomAttributes = "";

		// BudgetEstimate
		$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
		$this->BudgetEstimate->ViewCustomAttributes = "";

		// DepartmentCode
		$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
		$this->DepartmentCode->ViewValue = FormatNumber($this->DepartmentCode->ViewValue, 0, -2, -2, -2);
		$this->DepartmentCode->ViewCustomAttributes = "";

		// SectionCode
		$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
		$this->SectionCode->ViewValue = FormatNumber($this->SectionCode->ViewValue, 0, -2, -2, -2);
		$this->SectionCode->ViewCustomAttributes = "";

		// OutputCode
		$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
		$this->OutputCode->ViewCustomAttributes = "";

		// OutputName
		$this->OutputName->ViewValue = $this->OutputName->CurrentValue;
		$this->OutputName->ViewCustomAttributes = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// Quantity
		$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
		$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
		$this->Quantity->ViewCustomAttributes = "";

		// PeriodType
		$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
		$this->PeriodType->ViewCustomAttributes = "";

		// PeriodLength
		$this->PeriodLength->ViewValue = $this->PeriodLength->CurrentValue;
		$this->PeriodLength->ViewValue = FormatNumber($this->PeriodLength->ViewValue, 2, -2, -2, -2);
		$this->PeriodLength->ViewCustomAttributes = "";

		// Frequency
		$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
		$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, 2, -2, -2, -2);
		$this->Frequency->ViewCustomAttributes = "";

		// UnitCost
		$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
		$this->UnitCost->ViewCustomAttributes = "";

		// ProgramName
		$this->ProgramName->LinkCustomAttributes = "";
		$this->ProgramName->HrefValue = "";
		$this->ProgramName->TooltipValue = "";

		// SubProgramName
		$this->SubProgramName->LinkCustomAttributes = "";
		$this->SubProgramName->HrefValue = "";
		$this->SubProgramName->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// AccountCode
		$this->AccountCode->LinkCustomAttributes = "";
		$this->AccountCode->HrefValue = "";
		$this->AccountCode->TooltipValue = "";

		// ActualAmount
		$this->ActualAmount->LinkCustomAttributes = "";
		$this->ActualAmount->HrefValue = "";
		$this->ActualAmount->TooltipValue = "";

		// AccountName
		$this->AccountName->LinkCustomAttributes = "";
		$this->AccountName->HrefValue = "";
		$this->AccountName->TooltipValue = "";

		// AccountGroupName
		$this->AccountGroupName->LinkCustomAttributes = "";
		$this->AccountGroupName->HrefValue = "";
		$this->AccountGroupName->TooltipValue = "";

		// BudgetEstimate
		$this->BudgetEstimate->LinkCustomAttributes = "";
		$this->BudgetEstimate->HrefValue = "";
		$this->BudgetEstimate->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// SectionCode
		$this->SectionCode->LinkCustomAttributes = "";
		$this->SectionCode->HrefValue = "";
		$this->SectionCode->TooltipValue = "";

		// OutputCode
		$this->OutputCode->LinkCustomAttributes = "";
		$this->OutputCode->HrefValue = "";
		$this->OutputCode->TooltipValue = "";

		// OutputName
		$this->OutputName->LinkCustomAttributes = "";
		$this->OutputName->HrefValue = "";
		$this->OutputName->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// Quantity
		$this->Quantity->LinkCustomAttributes = "";
		$this->Quantity->HrefValue = "";
		$this->Quantity->TooltipValue = "";

		// PeriodType
		$this->PeriodType->LinkCustomAttributes = "";
		$this->PeriodType->HrefValue = "";
		$this->PeriodType->TooltipValue = "";

		// PeriodLength
		$this->PeriodLength->LinkCustomAttributes = "";
		$this->PeriodLength->HrefValue = "";
		$this->PeriodLength->TooltipValue = "";

		// Frequency
		$this->Frequency->LinkCustomAttributes = "";
		$this->Frequency->HrefValue = "";
		$this->Frequency->TooltipValue = "";

		// UnitCost
		$this->UnitCost->LinkCustomAttributes = "";
		$this->UnitCost->HrefValue = "";
		$this->UnitCost->TooltipValue = "";

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

		// ProgramName
		$this->ProgramName->EditAttrs["class"] = "form-control";
		$this->ProgramName->EditCustomAttributes = "";
		if (!$this->ProgramName->Raw)
			$this->ProgramName->CurrentValue = HtmlDecode($this->ProgramName->CurrentValue);
		$this->ProgramName->EditValue = $this->ProgramName->CurrentValue;
		$this->ProgramName->PlaceHolder = RemoveHtml($this->ProgramName->caption());

		// SubProgramName
		$this->SubProgramName->EditAttrs["class"] = "form-control";
		$this->SubProgramName->EditCustomAttributes = "";
		if (!$this->SubProgramName->Raw)
			$this->SubProgramName->CurrentValue = HtmlDecode($this->SubProgramName->CurrentValue);
		$this->SubProgramName->EditValue = $this->SubProgramName->CurrentValue;
		$this->SubProgramName->PlaceHolder = RemoveHtml($this->SubProgramName->caption());

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if (!$this->LACode->Raw)
			$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

		// AccountCode
		$this->AccountCode->EditAttrs["class"] = "form-control";
		$this->AccountCode->EditCustomAttributes = "";
		if (!$this->AccountCode->Raw)
			$this->AccountCode->CurrentValue = HtmlDecode($this->AccountCode->CurrentValue);
		$this->AccountCode->EditValue = $this->AccountCode->CurrentValue;
		$this->AccountCode->PlaceHolder = RemoveHtml($this->AccountCode->caption());

		// ActualAmount
		$this->ActualAmount->EditAttrs["class"] = "form-control";
		$this->ActualAmount->EditCustomAttributes = "";
		$this->ActualAmount->EditValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
		if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
			$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
		

		// AccountName
		$this->AccountName->EditAttrs["class"] = "form-control";
		$this->AccountName->EditCustomAttributes = "";
		if (!$this->AccountName->Raw)
			$this->AccountName->CurrentValue = HtmlDecode($this->AccountName->CurrentValue);
		$this->AccountName->EditValue = $this->AccountName->CurrentValue;
		$this->AccountName->PlaceHolder = RemoveHtml($this->AccountName->caption());

		// AccountGroupName
		$this->AccountGroupName->EditAttrs["class"] = "form-control";
		$this->AccountGroupName->EditCustomAttributes = "";
		if (!$this->AccountGroupName->Raw)
			$this->AccountGroupName->CurrentValue = HtmlDecode($this->AccountGroupName->CurrentValue);
		$this->AccountGroupName->EditValue = $this->AccountGroupName->CurrentValue;
		$this->AccountGroupName->PlaceHolder = RemoveHtml($this->AccountGroupName->caption());

		// BudgetEstimate
		$this->BudgetEstimate->EditAttrs["class"] = "form-control";
		$this->BudgetEstimate->EditCustomAttributes = "";
		$this->BudgetEstimate->EditValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
		if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue))
			$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
		

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

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";
		$this->OutputCode->EditValue = $this->OutputCode->CurrentValue;
		$this->OutputCode->ViewCustomAttributes = "";

		// OutputName
		$this->OutputName->EditAttrs["class"] = "form-control";
		$this->OutputName->EditCustomAttributes = "";
		if (!$this->OutputName->Raw)
			$this->OutputName->CurrentValue = HtmlDecode($this->OutputName->CurrentValue);
		$this->OutputName->EditValue = $this->OutputName->CurrentValue;
		$this->OutputName->PlaceHolder = RemoveHtml($this->OutputName->caption());

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";
		if (!$this->UnitOfMeasure->Raw)
			$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
		$this->UnitOfMeasure->EditValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

		// Quantity
		$this->Quantity->EditAttrs["class"] = "form-control";
		$this->Quantity->EditCustomAttributes = "";
		$this->Quantity->EditValue = $this->Quantity->CurrentValue;
		$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
		if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue))
			$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
		

		// PeriodType
		$this->PeriodType->EditAttrs["class"] = "form-control";
		$this->PeriodType->EditCustomAttributes = "";
		if (!$this->PeriodType->Raw)
			$this->PeriodType->CurrentValue = HtmlDecode($this->PeriodType->CurrentValue);
		$this->PeriodType->EditValue = $this->PeriodType->CurrentValue;
		$this->PeriodType->PlaceHolder = RemoveHtml($this->PeriodType->caption());

		// PeriodLength
		$this->PeriodLength->EditAttrs["class"] = "form-control";
		$this->PeriodLength->EditCustomAttributes = "";
		$this->PeriodLength->EditValue = $this->PeriodLength->CurrentValue;
		$this->PeriodLength->PlaceHolder = RemoveHtml($this->PeriodLength->caption());
		if (strval($this->PeriodLength->EditValue) != "" && is_numeric($this->PeriodLength->EditValue))
			$this->PeriodLength->EditValue = FormatNumber($this->PeriodLength->EditValue, -2, -2, -2, -2);
		

		// Frequency
		$this->Frequency->EditAttrs["class"] = "form-control";
		$this->Frequency->EditCustomAttributes = "";
		$this->Frequency->EditValue = $this->Frequency->CurrentValue;
		$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
		if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue))
			$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -2, -2, -2);
		

		// UnitCost
		$this->UnitCost->EditAttrs["class"] = "form-control";
		$this->UnitCost->EditCustomAttributes = "";
		$this->UnitCost->EditValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
		if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue))
			$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->ProgramName);
					$doc->exportCaption($this->SubProgramName);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->AccountName);
					$doc->exportCaption($this->AccountGroupName);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutputName);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->PeriodLength);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->UnitCost);
				} else {
					$doc->exportCaption($this->ProgramName);
					$doc->exportCaption($this->SubProgramName);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->AccountName);
					$doc->exportCaption($this->AccountGroupName);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutputName);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->PeriodLength);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->UnitCost);
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
						$doc->exportField($this->ProgramName);
						$doc->exportField($this->SubProgramName);
						$doc->exportField($this->LACode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->AccountName);
						$doc->exportField($this->AccountGroupName);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutputName);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->PeriodLength);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->UnitCost);
					} else {
						$doc->exportField($this->ProgramName);
						$doc->exportField($this->SubProgramName);
						$doc->exportField($this->LACode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->AccountName);
						$doc->exportField($this->AccountGroupName);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutputName);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->PeriodLength);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->UnitCost);
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
		$userid = CurrentUserID();
		$row = executeRow("select * from musers where username = '" . $username . "'");
		$prv = $row["ProvinceCode"];
		$la = $row["LACode"];
		if(isset($la)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   ( '" . $la .  	"')  ");  }

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