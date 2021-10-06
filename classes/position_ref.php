<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for position_ref
 */
class position_ref extends DbTable
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
	public $PositionCode;
	public $PositionName;
	public $RequisiteQualification;
	public $JobCode;
	public $SalaryScale;
	public $ProvinceCode;
	public $LACode;
	public $CouncilType;
	public $DepartmentCode;
	public $SectionCode;
	public $FieldQualified;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'position_ref';
		$this->TableName = 'position_ref';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`position_ref`";
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

		// PositionCode
		$this->PositionCode = new DbField('position_ref', 'position_ref', 'x_PositionCode', 'PositionCode', '`PositionCode`', '`PositionCode`', 3, 11, -1, FALSE, '`PositionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->PositionCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->PositionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->PositionCode->IsForeignKey = TRUE; // Foreign key field
		$this->PositionCode->Sortable = TRUE; // Allow sort
		$this->PositionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PositionCode'] = &$this->PositionCode;

		// PositionName
		$this->PositionName = new DbField('position_ref', 'position_ref', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->fields['PositionName'] = &$this->PositionName;

		// RequisiteQualification
		$this->RequisiteQualification = new DbField('position_ref', 'position_ref', 'x_RequisiteQualification', 'RequisiteQualification', '`RequisiteQualification`', '`RequisiteQualification`', 200, 40, -1, FALSE, '`RequisiteQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RequisiteQualification->Sortable = TRUE; // Allow sort
		$this->RequisiteQualification->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RequisiteQualification->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RequisiteQualification->Lookup = new Lookup('RequisiteQualification', 'qualifications_professional', FALSE, 'ProfessionalQualifications', ["ProfessionalQualifications","","",""], [], [], [], [], [], [], '', '');
		$this->fields['RequisiteQualification'] = &$this->RequisiteQualification;

		// JobCode
		$this->JobCode = new DbField('position_ref', 'position_ref', 'x_JobCode', 'JobCode', '`JobCode`', '`JobCode`', 3, 11, -1, FALSE, '`JobCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->JobCode->Sortable = TRUE; // Allow sort
		$this->JobCode->Lookup = new Lookup('JobCode', 'job', FALSE, 'JobCode', ["JobName","","",""], [], [], [], [], ["JobName","SalaryScale"], ["x_PositionName","x_SalaryScale"], '', '');
		$this->JobCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['JobCode'] = &$this->JobCode;

		// SalaryScale
		$this->SalaryScale = new DbField('position_ref', 'position_ref', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 13, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SalaryScale->IsForeignKey = TRUE; // Foreign key field
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->SalaryScale->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SalaryScale->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SalaryScale->Lookup = new Lookup('SalaryScale', 'salary_scale', FALSE, 'SalaryScale', ["SalaryScale","","",""], [], [], [], [], [], [], '', '');
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// ProvinceCode
		$this->ProvinceCode = new DbField('position_ref', 'position_ref', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('position_ref', 'position_ref', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// CouncilType
		$this->CouncilType = new DbField('position_ref', 'position_ref', 'x_CouncilType', 'CouncilType', '`CouncilType`', '`CouncilType`', 16, 3, -1, FALSE, '`CouncilType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CouncilType->Sortable = TRUE; // Allow sort
		$this->CouncilType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CouncilType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CouncilType->Lookup = new Lookup('CouncilType', 'council_type', FALSE, 'CouncilType', ["CouncilTYpeName","","",""], [], [], [], [], [], [], '', '');
		$this->CouncilType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncilType'] = &$this->CouncilType;

		// DepartmentCode
		$this->DepartmentCode = new DbField('position_ref', 'position_ref', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","DepartmentCode","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('position_ref', 'position_ref', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->IsForeignKey = TRUE; // Foreign key field
		$this->SectionCode->Nullable = FALSE; // NOT NULL field
		$this->SectionCode->Required = TRUE; // Required field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","SectionCode","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// FieldQualified
		$this->FieldQualified = new DbField('position_ref', 'position_ref', 'x_FieldQualified', 'FieldQualified', '`FieldQualified`', '`FieldQualified`', 2, 5, -1, FALSE, '`FieldQualified`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FieldQualified->Sortable = TRUE; // Allow sort
		$this->FieldQualified->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FieldQualified'] = &$this->FieldQualified;
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
		if ($this->getCurrentMasterTable() == "dept_section") {
			if ($this->SectionCode->getSessionValue() != "")
				$masterFilter .= "`SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "dept_section") {
			if ($this->SectionCode->getSessionValue() != "")
				$detailFilter .= "`SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_dept_section()
	{
		return "`SectionCode`=@SectionCode@";
	}

	// Detail filter
	public function sqlDetailFilter_dept_section()
	{
		return "`SectionCode`=@SectionCode@";
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "employment") {
			$detailUrl = $GLOBALS["employment"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_PositionCode=" . urlencode($this->PositionCode->CurrentValue);
			$detailUrl .= "&fk_SectionCode=" . urlencode($this->SectionCode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$detailUrl .= "&fk_SalaryScale=" . urlencode($this->SalaryScale->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "position_reflist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`position_ref`";
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
			$this->PositionCode->setDbValue($conn->insert_ID());
			$rs['PositionCode'] = $this->PositionCode->DbValue;
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

		// Cascade Update detail table 'employment'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['PositionCode']) && $rsold['PositionCode'] != $rs['PositionCode'])) { // Update detail field 'SubstantivePosition'
			$cascadeUpdate = TRUE;
			$rscascade['SubstantivePosition'] = $rs['PositionCode'];
		}
		if ($rsold && (isset($rs['SectionCode']) && $rsold['SectionCode'] != $rs['SectionCode'])) { // Update detail field 'SectionCode'
			$cascadeUpdate = TRUE;
			$rscascade['SectionCode'] = $rs['SectionCode'];
		}
		if ($rsold && (isset($rs['DepartmentCode']) && $rsold['DepartmentCode'] != $rs['DepartmentCode'])) { // Update detail field 'DepartmentCode'
			$cascadeUpdate = TRUE;
			$rscascade['DepartmentCode'] = $rs['DepartmentCode'];
		}
		if ($rsold && (isset($rs['LACode']) && $rsold['LACode'] != $rs['LACode'])) { // Update detail field 'LACode'
			$cascadeUpdate = TRUE;
			$rscascade['LACode'] = $rs['LACode'];
		}
		if ($rsold && (isset($rs['ProvinceCode']) && $rsold['ProvinceCode'] != $rs['ProvinceCode'])) { // Update detail field 'ProvinceCode'
			$cascadeUpdate = TRUE;
			$rscascade['ProvinceCode'] = $rs['ProvinceCode'];
		}
		if ($rsold && (isset($rs['SalaryScale']) && $rsold['SalaryScale'] != $rs['SalaryScale'])) { // Update detail field 'SalaryScale'
			$cascadeUpdate = TRUE;
			$rscascade['SalaryScale'] = $rs['SalaryScale'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["employment"]))
				$GLOBALS["employment"] = new employment();
			$rswrk = $GLOBALS["employment"]->loadRs("`SubstantivePosition` = " . QuotedValue($rsold['PositionCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`SectionCode` = " . QuotedValue($rsold['SectionCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`DepartmentCode` = " . QuotedValue($rsold['DepartmentCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`LACode` = " . QuotedValue($rsold['LACode'], DATATYPE_STRING, 'DB') . " AND " . "`ProvinceCode` = " . QuotedValue($rsold['ProvinceCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`SalaryScale` = " . QuotedValue($rsold['SalaryScale'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'EmployeeID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'SubstantivePosition';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["employment"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["employment"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["employment"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'PositionCode';
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
			if (array_key_exists('PositionCode', $rs))
				AddFilter($where, QuotedName('PositionCode', $this->Dbid) . '=' . QuotedValue($rs['PositionCode'], $this->PositionCode->DataType, $this->Dbid));
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

		// Cascade delete detail table 'employment'
		if (!isset($GLOBALS["employment"]))
			$GLOBALS["employment"] = new employment();
		$rscascade = $GLOBALS["employment"]->loadRs("`SubstantivePosition` = " . QuotedValue($rs['PositionCode'], DATATYPE_NUMBER, "DB") . " AND " . "`SectionCode` = " . QuotedValue($rs['SectionCode'], DATATYPE_NUMBER, "DB") . " AND " . "`DepartmentCode` = " . QuotedValue($rs['DepartmentCode'], DATATYPE_NUMBER, "DB") . " AND " . "`LACode` = " . QuotedValue($rs['LACode'], DATATYPE_STRING, "DB") . " AND " . "`ProvinceCode` = " . QuotedValue($rs['ProvinceCode'], DATATYPE_NUMBER, "DB") . " AND " . "`SalaryScale` = " . QuotedValue($rs['SalaryScale'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["employment"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["employment"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["employment"]->Row_Deleted($dtlrow);
		}
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
		$this->PositionCode->DbValue = $row['PositionCode'];
		$this->PositionName->DbValue = $row['PositionName'];
		$this->RequisiteQualification->DbValue = $row['RequisiteQualification'];
		$this->JobCode->DbValue = $row['JobCode'];
		$this->SalaryScale->DbValue = $row['SalaryScale'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->CouncilType->DbValue = $row['CouncilType'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->FieldQualified->DbValue = $row['FieldQualified'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`PositionCode` = @PositionCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('PositionCode', $row) ? $row['PositionCode'] : NULL;
		else
			$val = $this->PositionCode->OldValue !== NULL ? $this->PositionCode->OldValue : $this->PositionCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@PositionCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "position_reflist.php";
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
		if ($pageName == "position_refview.php")
			return $Language->phrase("View");
		elseif ($pageName == "position_refedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "position_refadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "position_reflist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("position_refview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("position_refview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "position_refadd.php?" . $this->getUrlParm($parm);
		else
			$url = "position_refadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("position_refedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("position_refedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("position_refadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("position_refadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("position_refdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "dept_section" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_SectionCode=" . urlencode($this->SectionCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "PositionCode:" . JsonEncode($this->PositionCode->CurrentValue, "number");
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
		if ($this->PositionCode->CurrentValue != NULL) {
			$url .= "PositionCode=" . urlencode($this->PositionCode->CurrentValue);
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
			if (Param("PositionCode") !== NULL)
				$arKeys[] = Param("PositionCode");
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
				$this->PositionCode->CurrentValue = $key;
			else
				$this->PositionCode->OldValue = $key;
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
		$this->PositionCode->setDbValue($rs->fields('PositionCode'));
		$this->PositionName->setDbValue($rs->fields('PositionName'));
		$this->RequisiteQualification->setDbValue($rs->fields('RequisiteQualification'));
		$this->JobCode->setDbValue($rs->fields('JobCode'));
		$this->SalaryScale->setDbValue($rs->fields('SalaryScale'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->CouncilType->setDbValue($rs->fields('CouncilType'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->FieldQualified->setDbValue($rs->fields('FieldQualified'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// PositionCode
		// PositionName
		// RequisiteQualification
		// JobCode
		// SalaryScale
		// ProvinceCode
		// LACode
		// CouncilType
		// DepartmentCode
		// SectionCode
		// FieldQualified
		// PositionCode

		$this->PositionCode->ViewValue = $this->PositionCode->CurrentValue;
		$this->PositionCode->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
		$this->PositionName->ViewCustomAttributes = "";

		// RequisiteQualification
		$curVal = strval($this->RequisiteQualification->CurrentValue);
		if ($curVal != "") {
			$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->lookupCacheOption($curVal);
			if ($this->RequisiteQualification->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->RequisiteQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->CurrentValue;
				}
			}
		} else {
			$this->RequisiteQualification->ViewValue = NULL;
		}
		$this->RequisiteQualification->ViewCustomAttributes = "";

		// JobCode
		$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
		$curVal = strval($this->JobCode->CurrentValue);
		if ($curVal != "") {
			$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			if ($this->JobCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`JobCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->JobCode->ViewValue = $this->JobCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
				}
			}
		} else {
			$this->JobCode->ViewValue = NULL;
		}
		$this->JobCode->ViewCustomAttributes = "";

		// SalaryScale
		$curVal = strval($this->SalaryScale->CurrentValue);
		if ($curVal != "") {
			$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
			if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
				}
			}
		} else {
			$this->SalaryScale->ViewValue = NULL;
		}
		$this->SalaryScale->ViewCustomAttributes = "";

		// ProvinceCode
		$curVal = strval($this->ProvinceCode->CurrentValue);
		if ($curVal != "") {
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
				}
			}
		} else {
			$this->ProvinceCode->ViewValue = NULL;
		}
		$this->ProvinceCode->ViewCustomAttributes = "";

		// LACode
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

		// CouncilType
		$curVal = strval($this->CouncilType->CurrentValue);
		if ($curVal != "") {
			$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
			if ($this->CouncilType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CouncilType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncilType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CouncilType->ViewValue = $this->CouncilType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
				}
			}
		} else {
			$this->CouncilType->ViewValue = NULL;
		}
		$this->CouncilType->ViewCustomAttributes = "";

		// DepartmentCode
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
					$arwrk[2] = $rswrk->fields('df2');
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// FieldQualified
		$this->FieldQualified->ViewValue = $this->FieldQualified->CurrentValue;
		$this->FieldQualified->ViewCustomAttributes = "";

		// PositionCode
		$this->PositionCode->LinkCustomAttributes = "";
		$this->PositionCode->HrefValue = "";
		$this->PositionCode->TooltipValue = "";

		// PositionName
		$this->PositionName->LinkCustomAttributes = "";
		$this->PositionName->HrefValue = "";
		$this->PositionName->TooltipValue = "";

		// RequisiteQualification
		$this->RequisiteQualification->LinkCustomAttributes = "";
		$this->RequisiteQualification->HrefValue = "";
		$this->RequisiteQualification->TooltipValue = "";

		// JobCode
		$this->JobCode->LinkCustomAttributes = "";
		$this->JobCode->HrefValue = "";
		$this->JobCode->TooltipValue = "";

		// SalaryScale
		$this->SalaryScale->LinkCustomAttributes = "";
		$this->SalaryScale->HrefValue = "";
		$this->SalaryScale->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// CouncilType
		$this->CouncilType->LinkCustomAttributes = "";
		$this->CouncilType->HrefValue = "";
		$this->CouncilType->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// SectionCode
		$this->SectionCode->LinkCustomAttributes = "";
		$this->SectionCode->HrefValue = "";
		$this->SectionCode->TooltipValue = "";

		// FieldQualified
		$this->FieldQualified->LinkCustomAttributes = "";
		$this->FieldQualified->HrefValue = "";
		$this->FieldQualified->TooltipValue = "";

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

		// PositionCode
		$this->PositionCode->EditAttrs["class"] = "form-control";
		$this->PositionCode->EditCustomAttributes = "";
		$this->PositionCode->EditValue = $this->PositionCode->CurrentValue;
		$this->PositionCode->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->EditAttrs["class"] = "form-control";
		$this->PositionName->EditCustomAttributes = "";
		if (!$this->PositionName->Raw)
			$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
		$this->PositionName->EditValue = $this->PositionName->CurrentValue;
		$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

		// RequisiteQualification
		$this->RequisiteQualification->EditAttrs["class"] = "form-control";
		$this->RequisiteQualification->EditCustomAttributes = "";

		// JobCode
		$this->JobCode->EditAttrs["class"] = "form-control";
		$this->JobCode->EditCustomAttributes = "";
		$this->JobCode->EditValue = $this->JobCode->CurrentValue;
		$this->JobCode->PlaceHolder = RemoveHtml($this->JobCode->caption());

		// SalaryScale
		$this->SalaryScale->EditAttrs["class"] = "form-control";
		$this->SalaryScale->EditCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// CouncilType
		$this->CouncilType->EditAttrs["class"] = "form-control";
		$this->CouncilType->EditCustomAttributes = "";

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";

		// SectionCode
		$this->SectionCode->EditAttrs["class"] = "form-control";
		$this->SectionCode->EditCustomAttributes = "";
		if ($this->SectionCode->getSessionValue() != "") {
			$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
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
						$arwrk[2] = $rswrk->fields('df2');
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
		} else {
		}

		// FieldQualified
		$this->FieldQualified->EditAttrs["class"] = "form-control";
		$this->FieldQualified->EditCustomAttributes = "";
		$this->FieldQualified->EditValue = $this->FieldQualified->CurrentValue;
		$this->FieldQualified->PlaceHolder = RemoveHtml($this->FieldQualified->caption());

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
					$doc->exportCaption($this->PositionCode);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->RequisiteQualification);
					$doc->exportCaption($this->JobCode);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->FieldQualified);
				} else {
					$doc->exportCaption($this->PositionCode);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->RequisiteQualification);
					$doc->exportCaption($this->JobCode);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->CouncilType);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->FieldQualified);
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
						$doc->exportField($this->PositionCode);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->RequisiteQualification);
						$doc->exportField($this->JobCode);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->FieldQualified);
					} else {
						$doc->exportField($this->PositionCode);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->RequisiteQualification);
						$doc->exportField($this->JobCode);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->CouncilType);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->FieldQualified);
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
		$table = 'position_ref';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'position_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PositionCode'];

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
		$table = 'position_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['PositionCode'];

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
		$table = 'position_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PositionCode'];

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