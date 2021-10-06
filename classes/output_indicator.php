<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for output_indicator
 */
class output_indicator extends DbTable
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
	public $IndicatorNo;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $OutputCode;
	public $OutcomeCode;
	public $OutputType;
	public $ProgramCode;
	public $SubProgramCode;
	public $FinancialYear;
	public $OutputIndicatorName;
	public $TargetAmount;
	public $ActualAmount;
	public $PercentAchieved;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'output_indicator';
		$this->TableName = 'output_indicator';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`output_indicator`";
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

		// IndicatorNo
		$this->IndicatorNo = new DbField('output_indicator', 'output_indicator', 'x_IndicatorNo', 'IndicatorNo', '`IndicatorNo`', '`IndicatorNo`', 3, 11, -1, FALSE, '`IndicatorNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->IndicatorNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->IndicatorNo->IsPrimaryKey = TRUE; // Primary key field
		$this->IndicatorNo->Sortable = TRUE; // Allow sort
		$this->IndicatorNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IndicatorNo'] = &$this->IndicatorNo;

		// LACode
		$this->LACode = new DbField('output_indicator', 'output_indicator', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('output_indicator', 'output_indicator', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], [], [], [], [], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('output_indicator', 'output_indicator', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], [], [], [], [], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// OutputCode
		$this->OutputCode = new DbField('output_indicator', 'output_indicator', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputCode->Nullable = FALSE; // NOT NULL field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->Lookup = new Lookup('OutputCode', 'output', FALSE, 'OutputCode', ["OutputName","","",""], [], [], [], [], [], [], '', '');
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// OutcomeCode
		$this->OutcomeCode = new DbField('output_indicator', 'output_indicator', 'x_OutcomeCode', 'OutcomeCode', '`OutcomeCode`', '`OutcomeCode`', 3, 11, -1, FALSE, '`OutcomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutcomeCode->Nullable = FALSE; // NOT NULL field
		$this->OutcomeCode->Required = TRUE; // Required field
		$this->OutcomeCode->Sortable = TRUE; // Allow sort
		$this->OutcomeCode->Lookup = new Lookup('OutcomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], [], [], [], [], [], [], '', '');
		$this->OutcomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutcomeCode'] = &$this->OutcomeCode;

		// OutputType
		$this->OutputType = new DbField('output_indicator', 'output_indicator', 'x_OutputType', 'OutputType', '`OutputType`', '`OutputType`', 200, 15, -1, FALSE, '`OutputType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputType->Sortable = TRUE; // Allow sort
		$this->OutputType->Lookup = new Lookup('OutputType', 'output_type', FALSE, 'OutputType', ["OutputType","","",""], [], [], [], [], [], [], '', '');
		$this->fields['OutputType'] = &$this->OutputType;

		// ProgramCode
		$this->ProgramCode = new DbField('output_indicator', 'output_indicator', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->Lookup = new Lookup('ProgramCode', 'la_program', FALSE, 'ProgramCode', ["ProgramName","","",""], [], [], [], [], [], [], '', '');
		$this->ProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// SubProgramCode
		$this->SubProgramCode = new DbField('output_indicator', 'output_indicator', 'x_SubProgramCode', 'SubProgramCode', '`SubProgramCode`', '`SubProgramCode`', 3, 11, -1, FALSE, '`SubProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubProgramCode->Sortable = TRUE; // Allow sort
		$this->SubProgramCode->Lookup = new Lookup('SubProgramCode', 'la_sub_program', FALSE, 'SubProgramCode', ["SubProgramName","","",""], [], [], [], [], [], [], '', '');
		$this->SubProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubProgramCode'] = &$this->SubProgramCode;

		// FinancialYear
		$this->FinancialYear = new DbField('output_indicator', 'output_indicator', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// OutputIndicatorName
		$this->OutputIndicatorName = new DbField('output_indicator', 'output_indicator', 'x_OutputIndicatorName', 'OutputIndicatorName', '`OutputIndicatorName`', '`OutputIndicatorName`', 200, 255, -1, FALSE, '`OutputIndicatorName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutputIndicatorName->Sortable = TRUE; // Allow sort
		$this->fields['OutputIndicatorName'] = &$this->OutputIndicatorName;

		// TargetAmount
		$this->TargetAmount = new DbField('output_indicator', 'output_indicator', 'x_TargetAmount', 'TargetAmount', '`TargetAmount`', '`TargetAmount`', 5, 22, -1, FALSE, '`TargetAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TargetAmount->Sortable = TRUE; // Allow sort
		$this->TargetAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TargetAmount'] = &$this->TargetAmount;

		// ActualAmount
		$this->ActualAmount = new DbField('output_indicator', 'output_indicator', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// PercentAchieved
		$this->PercentAchieved = new DbField('output_indicator', 'output_indicator', 'x_PercentAchieved', 'PercentAchieved', '`PercentAchieved`', '`PercentAchieved`', 5, 22, -1, FALSE, '`PercentAchieved`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PercentAchieved->Sortable = TRUE; // Allow sort
		$this->PercentAchieved->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PercentAchieved'] = &$this->PercentAchieved;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`output_indicator`";
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
			$this->IndicatorNo->setDbValue($conn->insert_ID());
			$rs['IndicatorNo'] = $this->IndicatorNo->DbValue;
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
			if (array_key_exists('IndicatorNo', $rs))
				AddFilter($where, QuotedName('IndicatorNo', $this->Dbid) . '=' . QuotedValue($rs['IndicatorNo'], $this->IndicatorNo->DataType, $this->Dbid));
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
		$this->IndicatorNo->DbValue = $row['IndicatorNo'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->OutcomeCode->DbValue = $row['OutcomeCode'];
		$this->OutputType->DbValue = $row['OutputType'];
		$this->ProgramCode->DbValue = $row['ProgramCode'];
		$this->SubProgramCode->DbValue = $row['SubProgramCode'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->OutputIndicatorName->DbValue = $row['OutputIndicatorName'];
		$this->TargetAmount->DbValue = $row['TargetAmount'];
		$this->ActualAmount->DbValue = $row['ActualAmount'];
		$this->PercentAchieved->DbValue = $row['PercentAchieved'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`IndicatorNo` = @IndicatorNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('IndicatorNo', $row) ? $row['IndicatorNo'] : NULL;
		else
			$val = $this->IndicatorNo->OldValue !== NULL ? $this->IndicatorNo->OldValue : $this->IndicatorNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@IndicatorNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "output_indicatorlist.php";
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
		if ($pageName == "output_indicatorview.php")
			return $Language->phrase("View");
		elseif ($pageName == "output_indicatoredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "output_indicatoradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "output_indicatorlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("output_indicatorview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("output_indicatorview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "output_indicatoradd.php?" . $this->getUrlParm($parm);
		else
			$url = "output_indicatoradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("output_indicatoredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("output_indicatoradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("output_indicatordelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "IndicatorNo:" . JsonEncode($this->IndicatorNo->CurrentValue, "number");
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
		if ($this->IndicatorNo->CurrentValue != NULL) {
			$url .= "IndicatorNo=" . urlencode($this->IndicatorNo->CurrentValue);
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
			if (Param("IndicatorNo") !== NULL)
				$arKeys[] = Param("IndicatorNo");
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
				$this->IndicatorNo->CurrentValue = $key;
			else
				$this->IndicatorNo->OldValue = $key;
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
		$this->IndicatorNo->setDbValue($rs->fields('IndicatorNo'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->OutcomeCode->setDbValue($rs->fields('OutcomeCode'));
		$this->OutputType->setDbValue($rs->fields('OutputType'));
		$this->ProgramCode->setDbValue($rs->fields('ProgramCode'));
		$this->SubProgramCode->setDbValue($rs->fields('SubProgramCode'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->OutputIndicatorName->setDbValue($rs->fields('OutputIndicatorName'));
		$this->TargetAmount->setDbValue($rs->fields('TargetAmount'));
		$this->ActualAmount->setDbValue($rs->fields('ActualAmount'));
		$this->PercentAchieved->setDbValue($rs->fields('PercentAchieved'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// IndicatorNo
		// LACode
		// DepartmentCode
		// SectionCode
		// OutputCode
		// OutcomeCode
		// OutputType
		// ProgramCode
		// SubProgramCode
		// FinancialYear
		// OutputIndicatorName
		// TargetAmount
		// ActualAmount
		// PercentAchieved
		// IndicatorNo

		$this->IndicatorNo->ViewValue = $this->IndicatorNo->CurrentValue;
		$this->IndicatorNo->ViewCustomAttributes = "";

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

		// DepartmentCode
		$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
		$curVal = strval($this->DepartmentCode->CurrentValue);
		if ($curVal != "") {
			$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
				}
			}
		} else {
			$this->DepartmentCode->ViewValue = NULL;
		}
		$this->DepartmentCode->ViewCustomAttributes = "";

		// SectionCode
		$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
		$curVal = strval($this->SectionCode->CurrentValue);
		if ($curVal != "") {
			$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			if ($this->SectionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
				}
			}
		} else {
			$this->SectionCode->ViewValue = NULL;
		}
		$this->SectionCode->ViewCustomAttributes = "";

		// OutputCode
		$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
		$curVal = strval($this->OutputCode->CurrentValue);
		if ($curVal != "") {
			$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
			if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
				}
			}
		} else {
			$this->OutputCode->ViewValue = NULL;
		}
		$this->OutputCode->ViewCustomAttributes = "";

		// OutcomeCode
		$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
		$curVal = strval($this->OutcomeCode->CurrentValue);
		if ($curVal != "") {
			$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
			if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
				}
			}
		} else {
			$this->OutcomeCode->ViewValue = NULL;
		}
		$this->OutcomeCode->ViewCustomAttributes = "";

		// OutputType
		$this->OutputType->ViewValue = $this->OutputType->CurrentValue;
		$curVal = strval($this->OutputType->CurrentValue);
		if ($curVal != "") {
			$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
			if ($this->OutputType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutputType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->OutputType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutputType->ViewValue = $this->OutputType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutputType->ViewValue = $this->OutputType->CurrentValue;
				}
			}
		} else {
			$this->OutputType->ViewValue = NULL;
		}
		$this->OutputType->ViewCustomAttributes = "";

		// ProgramCode
		$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
		$curVal = strval($this->ProgramCode->CurrentValue);
		if ($curVal != "") {
			$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
			if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
				}
			}
		} else {
			$this->ProgramCode->ViewValue = NULL;
		}
		$this->ProgramCode->ViewCustomAttributes = "";

		// SubProgramCode
		$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
		$curVal = strval($this->SubProgramCode->CurrentValue);
		if ($curVal != "") {
			$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
			if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
				}
			}
		} else {
			$this->SubProgramCode->ViewValue = NULL;
		}
		$this->SubProgramCode->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewCustomAttributes = "";

		// OutputIndicatorName
		$this->OutputIndicatorName->ViewValue = $this->OutputIndicatorName->CurrentValue;
		$this->OutputIndicatorName->ViewCustomAttributes = "";

		// TargetAmount
		$this->TargetAmount->ViewValue = $this->TargetAmount->CurrentValue;
		$this->TargetAmount->ViewValue = FormatNumber($this->TargetAmount->ViewValue, 2, -2, -2, -2);
		$this->TargetAmount->ViewCustomAttributes = "";

		// ActualAmount
		$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
		$this->ActualAmount->ViewCustomAttributes = "";

		// PercentAchieved
		$this->PercentAchieved->ViewValue = $this->PercentAchieved->CurrentValue;
		$this->PercentAchieved->ViewValue = FormatPercent($this->PercentAchieved->ViewValue, 2, -2, -2, -2);
		$this->PercentAchieved->ViewCustomAttributes = "";

		// IndicatorNo
		$this->IndicatorNo->LinkCustomAttributes = "";
		$this->IndicatorNo->HrefValue = "";
		$this->IndicatorNo->TooltipValue = "";

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

		// OutputCode
		$this->OutputCode->LinkCustomAttributes = "";
		$this->OutputCode->HrefValue = "";
		$this->OutputCode->TooltipValue = "";

		// OutcomeCode
		$this->OutcomeCode->LinkCustomAttributes = "";
		$this->OutcomeCode->HrefValue = "";
		$this->OutcomeCode->TooltipValue = "";

		// OutputType
		$this->OutputType->LinkCustomAttributes = "";
		$this->OutputType->HrefValue = "";
		$this->OutputType->TooltipValue = "";

		// ProgramCode
		$this->ProgramCode->LinkCustomAttributes = "";
		$this->ProgramCode->HrefValue = "";
		$this->ProgramCode->TooltipValue = "";

		// SubProgramCode
		$this->SubProgramCode->LinkCustomAttributes = "";
		$this->SubProgramCode->HrefValue = "";
		$this->SubProgramCode->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// OutputIndicatorName
		$this->OutputIndicatorName->LinkCustomAttributes = "";
		$this->OutputIndicatorName->HrefValue = "";
		$this->OutputIndicatorName->TooltipValue = "";

		// TargetAmount
		$this->TargetAmount->LinkCustomAttributes = "";
		$this->TargetAmount->HrefValue = "";
		$this->TargetAmount->TooltipValue = "";

		// ActualAmount
		$this->ActualAmount->LinkCustomAttributes = "";
		$this->ActualAmount->HrefValue = "";
		$this->ActualAmount->TooltipValue = "";

		// PercentAchieved
		$this->PercentAchieved->LinkCustomAttributes = "";
		$this->PercentAchieved->HrefValue = "";
		$this->PercentAchieved->TooltipValue = "";

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

		// IndicatorNo
		$this->IndicatorNo->EditAttrs["class"] = "form-control";
		$this->IndicatorNo->EditCustomAttributes = "";
		$this->IndicatorNo->EditValue = $this->IndicatorNo->CurrentValue;
		$this->IndicatorNo->ViewCustomAttributes = "";

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

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";
		$this->OutputCode->EditValue = $this->OutputCode->CurrentValue;
		$this->OutputCode->PlaceHolder = RemoveHtml($this->OutputCode->caption());

		// OutcomeCode
		$this->OutcomeCode->EditAttrs["class"] = "form-control";
		$this->OutcomeCode->EditCustomAttributes = "";
		$this->OutcomeCode->EditValue = $this->OutcomeCode->CurrentValue;
		$this->OutcomeCode->PlaceHolder = RemoveHtml($this->OutcomeCode->caption());

		// OutputType
		$this->OutputType->EditAttrs["class"] = "form-control";
		$this->OutputType->EditCustomAttributes = "";
		if (!$this->OutputType->Raw)
			$this->OutputType->CurrentValue = HtmlDecode($this->OutputType->CurrentValue);
		$this->OutputType->EditValue = $this->OutputType->CurrentValue;
		$this->OutputType->PlaceHolder = RemoveHtml($this->OutputType->caption());

		// ProgramCode
		$this->ProgramCode->EditAttrs["class"] = "form-control";
		$this->ProgramCode->EditCustomAttributes = "";
		$this->ProgramCode->EditValue = $this->ProgramCode->CurrentValue;
		$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());

		// SubProgramCode
		$this->SubProgramCode->EditAttrs["class"] = "form-control";
		$this->SubProgramCode->EditCustomAttributes = "";
		$this->SubProgramCode->EditValue = $this->SubProgramCode->CurrentValue;
		$this->SubProgramCode->PlaceHolder = RemoveHtml($this->SubProgramCode->caption());

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

		// OutputIndicatorName
		$this->OutputIndicatorName->EditAttrs["class"] = "form-control";
		$this->OutputIndicatorName->EditCustomAttributes = "";
		$this->OutputIndicatorName->EditValue = $this->OutputIndicatorName->CurrentValue;
		$this->OutputIndicatorName->PlaceHolder = RemoveHtml($this->OutputIndicatorName->caption());

		// TargetAmount
		$this->TargetAmount->EditAttrs["class"] = "form-control";
		$this->TargetAmount->EditCustomAttributes = "";
		$this->TargetAmount->EditValue = $this->TargetAmount->CurrentValue;
		$this->TargetAmount->PlaceHolder = RemoveHtml($this->TargetAmount->caption());
		if (strval($this->TargetAmount->EditValue) != "" && is_numeric($this->TargetAmount->EditValue))
			$this->TargetAmount->EditValue = FormatNumber($this->TargetAmount->EditValue, -2, -2, -2, -2);
		

		// ActualAmount
		$this->ActualAmount->EditAttrs["class"] = "form-control";
		$this->ActualAmount->EditCustomAttributes = "";
		$this->ActualAmount->EditValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
		if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
			$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
		

		// PercentAchieved
		$this->PercentAchieved->EditAttrs["class"] = "form-control";
		$this->PercentAchieved->EditCustomAttributes = "";
		$this->PercentAchieved->EditValue = $this->PercentAchieved->CurrentValue;
		$this->PercentAchieved->PlaceHolder = RemoveHtml($this->PercentAchieved->caption());
		if (strval($this->PercentAchieved->EditValue) != "" && is_numeric($this->PercentAchieved->EditValue))
			$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -1, -2, 0);
		

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
					$doc->exportCaption($this->IndicatorNo);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputType);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->OutputIndicatorName);
					$doc->exportCaption($this->TargetAmount);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->PercentAchieved);
				} else {
					$doc->exportCaption($this->IndicatorNo);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputType);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->OutputIndicatorName);
					$doc->exportCaption($this->TargetAmount);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->PercentAchieved);
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
						$doc->exportField($this->IndicatorNo);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputType);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->OutputIndicatorName);
						$doc->exportField($this->TargetAmount);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->PercentAchieved);
					} else {
						$doc->exportField($this->IndicatorNo);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputType);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->OutputIndicatorName);
						$doc->exportField($this->TargetAmount);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->PercentAchieved);
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
		if ($levelid <> -1) {
			$row = executeRow("select * from musers where username = '" . $username . "'");
			$prv = $row["ProvinceCode"];
			$la = $row["LACode"];
			}

		//$sec = $row["SectionCode"];
		//die(strval($prv));
	//	if(isset($prv)) {				//levelid -1 is for admin
	//	AddFilter($filter,"`ProvinceCode`  in   ( '" . $prv .  	"')  ");  }

		if(isset($la)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   ( '" . $la .  	"')  ");  }

		//if(isset($hf)) {				//levelid -1 is for admin
		//AddFilter($filter,"`FacilityUID`  in   ( '" . $hf .  	"')  ");  }  
		//set filter for province

	/*	$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");  */

	/*	if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT security_matrix.ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  } */
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