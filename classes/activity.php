<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for activity
 */
class activity extends DbTable
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
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $ProgrammeCode;
	public $OucomeCode;
	public $OutputCode;
	public $ProjectCode;
	public $ActivityCode;
	public $FinancialYear;
	public $ActivityName;
	public $MTEFBudget;
	public $SupplementaryBudget;
	public $ExpectedAnnualAchievement;
	public $ActivityLocation;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'activity';
		$this->TableName = 'activity';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`activity`";
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

		// ProvinceCode
		$this->ProvinceCode = new DbField('activity', 'activity', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('activity', 'activity', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('activity', 'activity', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode","x_OucomeCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('activity', 'activity', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->IsForeignKey = TRUE; // Foreign key field
		$this->SectionCode->Nullable = FALSE; // NOT NULL field
		$this->SectionCode->Required = TRUE; // Required field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// ProgrammeCode
		$this->ProgrammeCode = new DbField('activity', 'activity', 'x_ProgrammeCode', 'ProgrammeCode', '`ProgrammeCode`', '`ProgrammeCode`', 200, 11, -1, FALSE, '`ProgrammeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgrammeCode->Nullable = FALSE; // NOT NULL field
		$this->ProgrammeCode->Required = TRUE; // Required field
		$this->ProgrammeCode->Sortable = TRUE; // Allow sort
		$this->ProgrammeCode->Lookup = new Lookup('ProgrammeCode', 'programme_ref', FALSE, 'ProgRefCode', ["ProgrammeName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProgrammeCode'] = &$this->ProgrammeCode;

		// OucomeCode
		$this->OucomeCode = new DbField('activity', 'activity', 'x_OucomeCode', 'OucomeCode', '`OucomeCode`', '`OucomeCode`', 3, 11, -1, FALSE, '`OucomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OucomeCode->Nullable = FALSE; // NOT NULL field
		$this->OucomeCode->Required = TRUE; // Required field
		$this->OucomeCode->Sortable = TRUE; // Allow sort
		$this->OucomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OucomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OucomeCode->Lookup = new Lookup('OucomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], ["x_DepartmentCode"], ["x_OutputCode"], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->OucomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OucomeCode'] = &$this->OucomeCode;

		// OutputCode
		$this->OutputCode = new DbField('activity', 'activity', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutputCode->Nullable = FALSE; // NOT NULL field
		$this->OutputCode->Required = TRUE; // Required field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutputCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutputCode->Lookup = new Lookup('OutputCode', 'output', FALSE, 'OutputCode', ["OutputName","","",""], ["x_OucomeCode"], [], ["OutcomeCode"], ["x_OutcomeCode"], [], [], '', '');
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// ProjectCode
		$this->ProjectCode = new DbField('activity', 'activity', 'x_ProjectCode', 'ProjectCode', '`ProjectCode`', '`ProjectCode`', 200, 23, -1, FALSE, '`ProjectCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProjectCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProjectCode->Sortable = TRUE; // Allow sort
		$this->ProjectCode->Lookup = new Lookup('ProjectCode', 'project', FALSE, 'ProjectCode', ["ProjectName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProjectCode'] = &$this->ProjectCode;

		// ActivityCode
		$this->ActivityCode = new DbField('activity', 'activity', 'x_ActivityCode', 'ActivityCode', '`ActivityCode`', '`ActivityCode`', 3, 11, -1, FALSE, '`ActivityCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActivityCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ActivityCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ActivityCode->Sortable = TRUE; // Allow sort
		$this->fields['ActivityCode'] = &$this->ActivityCode;

		// FinancialYear
		$this->FinancialYear = new DbField('activity', 'activity', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FinancialYear->IsPrimaryKey = TRUE; // Primary key field
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FinancialYear->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FinancialYear->Lookup = new Lookup('FinancialYear', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// ActivityName
		$this->ActivityName = new DbField('activity', 'activity', 'x_ActivityName', 'ActivityName', '`ActivityName`', '`ActivityName`', 200, 255, -1, FALSE, '`ActivityName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ActivityName->Nullable = FALSE; // NOT NULL field
		$this->ActivityName->Required = TRUE; // Required field
		$this->ActivityName->Sortable = TRUE; // Allow sort
		$this->fields['ActivityName'] = &$this->ActivityName;

		// MTEFBudget
		$this->MTEFBudget = new DbField('activity', 'activity', 'x_MTEFBudget', 'MTEFBudget', '`MTEFBudget`', '`MTEFBudget`', 5, 22, -1, FALSE, '`MTEFBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MTEFBudget->Sortable = TRUE; // Allow sort
		$this->MTEFBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['MTEFBudget'] = &$this->MTEFBudget;

		// SupplementaryBudget
		$this->SupplementaryBudget = new DbField('activity', 'activity', 'x_SupplementaryBudget', 'SupplementaryBudget', '`SupplementaryBudget`', '`SupplementaryBudget`', 5, 22, -1, FALSE, '`SupplementaryBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplementaryBudget->Required = TRUE; // Required field
		$this->SupplementaryBudget->Sortable = TRUE; // Allow sort
		$this->SupplementaryBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SupplementaryBudget'] = &$this->SupplementaryBudget;

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement = new DbField('activity', 'activity', 'x_ExpectedAnnualAchievement', 'ExpectedAnnualAchievement', '`ExpectedAnnualAchievement`', '`ExpectedAnnualAchievement`', 200, 255, -1, FALSE, '`ExpectedAnnualAchievement`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExpectedAnnualAchievement->Sortable = TRUE; // Allow sort
		$this->fields['ExpectedAnnualAchievement'] = &$this->ExpectedAnnualAchievement;

		// ActivityLocation
		$this->ActivityLocation = new DbField('activity', 'activity', 'x_ActivityLocation', 'ActivityLocation', '`ActivityLocation`', '`ActivityLocation`', 200, 255, -1, FALSE, '`ActivityLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActivityLocation->Sortable = TRUE; // Allow sort
		$this->fields['ActivityLocation'] = &$this->ActivityLocation;
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
		if ($this->getCurrentMasterTable() == "project") {
			if ($this->ProvinceCode->getSessionValue() != "")
				$masterFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$masterFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SectionCode->getSessionValue() != "")
				$masterFilter .= " AND `SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProjectCode->getSessionValue() != "")
				$masterFilter .= " AND `ProjectCode`=" . QuotedValue($this->ProjectCode->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "project") {
			if ($this->ProvinceCode->getSessionValue() != "")
				$detailFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$detailFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SectionCode->getSessionValue() != "")
				$detailFilter .= " AND `SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProjectCode->getSessionValue() != "")
				$detailFilter .= " AND `ProjectCode`=" . QuotedValue($this->ProjectCode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_project()
	{
		return "`ProvinceCode`=@ProvinceCode@ AND `LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `SectionCode`=@SectionCode@ AND `ProjectCode`='@ProjectCode@'";
	}

	// Detail filter
	public function sqlDetailFilter_project()
	{
		return "`ProvinceCode`=@ProvinceCode@ AND `LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `SectionCode`=@SectionCode@ AND `ProjectCode`='@ProjectCode@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`activity`";
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
			$this->ActivityCode->setDbValue($conn->insert_ID());
			$rs['ActivityCode'] = $this->ActivityCode->DbValue;
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
			$fldname = 'ActivityCode';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'FinancialYear';
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
			if (array_key_exists('ActivityCode', $rs))
				AddFilter($where, QuotedName('ActivityCode', $this->Dbid) . '=' . QuotedValue($rs['ActivityCode'], $this->ActivityCode->DataType, $this->Dbid));
			if (array_key_exists('FinancialYear', $rs))
				AddFilter($where, QuotedName('FinancialYear', $this->Dbid) . '=' . QuotedValue($rs['FinancialYear'], $this->FinancialYear->DataType, $this->Dbid));
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
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->ProgrammeCode->DbValue = $row['ProgrammeCode'];
		$this->OucomeCode->DbValue = $row['OucomeCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->ProjectCode->DbValue = $row['ProjectCode'];
		$this->ActivityCode->DbValue = $row['ActivityCode'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->ActivityName->DbValue = $row['ActivityName'];
		$this->MTEFBudget->DbValue = $row['MTEFBudget'];
		$this->SupplementaryBudget->DbValue = $row['SupplementaryBudget'];
		$this->ExpectedAnnualAchievement->DbValue = $row['ExpectedAnnualAchievement'];
		$this->ActivityLocation->DbValue = $row['ActivityLocation'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ActivityCode` = @ActivityCode@ AND `FinancialYear` = @FinancialYear@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ActivityCode', $row) ? $row['ActivityCode'] : NULL;
		else
			$val = $this->ActivityCode->OldValue !== NULL ? $this->ActivityCode->OldValue : $this->ActivityCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ActivityCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('FinancialYear', $row) ? $row['FinancialYear'] : NULL;
		else
			$val = $this->FinancialYear->OldValue !== NULL ? $this->FinancialYear->OldValue : $this->FinancialYear->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@FinancialYear@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "activitylist.php";
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
		if ($pageName == "activityview.php")
			return $Language->phrase("View");
		elseif ($pageName == "activityedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "activityadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "activitylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("activityview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("activityview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "activityadd.php?" . $this->getUrlParm($parm);
		else
			$url = "activityadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("activityedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("activityadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("activitydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "project" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$url .= "&fk_SectionCode=" . urlencode($this->SectionCode->CurrentValue);
			$url .= "&fk_ProjectCode=" . urlencode($this->ProjectCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ActivityCode:" . JsonEncode($this->ActivityCode->CurrentValue, "number");
		$json .= ",FinancialYear:" . JsonEncode($this->FinancialYear->CurrentValue, "number");
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
		if ($this->ActivityCode->CurrentValue != NULL) {
			$url .= "ActivityCode=" . urlencode($this->ActivityCode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->FinancialYear->CurrentValue != NULL) {
			$url .= "&FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
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
			if (Param("ActivityCode") !== NULL)
				$arKey[] = Param("ActivityCode");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("FinancialYear") !== NULL)
				$arKey[] = Param("FinancialYear");
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
				if (!is_numeric($key[0])) // ActivityCode
					continue;
				if (!is_numeric($key[1])) // FinancialYear
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
				$this->ActivityCode->CurrentValue = $key[0];
			else
				$this->ActivityCode->OldValue = $key[0];
			if ($setCurrent)
				$this->FinancialYear->CurrentValue = $key[1];
			else
				$this->FinancialYear->OldValue = $key[1];
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
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->ProgrammeCode->setDbValue($rs->fields('ProgrammeCode'));
		$this->OucomeCode->setDbValue($rs->fields('OucomeCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->ProjectCode->setDbValue($rs->fields('ProjectCode'));
		$this->ActivityCode->setDbValue($rs->fields('ActivityCode'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->ActivityName->setDbValue($rs->fields('ActivityName'));
		$this->MTEFBudget->setDbValue($rs->fields('MTEFBudget'));
		$this->SupplementaryBudget->setDbValue($rs->fields('SupplementaryBudget'));
		$this->ExpectedAnnualAchievement->setDbValue($rs->fields('ExpectedAnnualAchievement'));
		$this->ActivityLocation->setDbValue($rs->fields('ActivityLocation'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ProgrammeCode
		// OucomeCode
		// OutputCode
		// ProjectCode
		// ActivityCode
		// FinancialYear
		// ActivityName
		// MTEFBudget
		// SupplementaryBudget
		// ExpectedAnnualAchievement
		// ActivityLocation
		// ProvinceCode

		$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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

		// ProgrammeCode
		$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->CurrentValue;
		$curVal = strval($this->ProgrammeCode->CurrentValue);
		if ($curVal != "") {
			$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->lookupCacheOption($curVal);
			if ($this->ProgrammeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgRefCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ProgrammeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->CurrentValue;
				}
			}
		} else {
			$this->ProgrammeCode->ViewValue = NULL;
		}
		$this->ProgrammeCode->ViewCustomAttributes = "";

		// OucomeCode
		$curVal = strval($this->OucomeCode->CurrentValue);
		if ($curVal != "") {
			$this->OucomeCode->ViewValue = $this->OucomeCode->lookupCacheOption($curVal);
			if ($this->OucomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OucomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OucomeCode->ViewValue = $this->OucomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
				}
			}
		} else {
			$this->OucomeCode->ViewValue = NULL;
		}
		$this->OucomeCode->ViewCustomAttributes = "";

		// OutputCode
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

		// ProjectCode
		$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
		$curVal = strval($this->ProjectCode->CurrentValue);
		if ($curVal != "") {
			$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
			if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
				}
			}
		} else {
			$this->ProjectCode->ViewValue = NULL;
		}
		$this->ProjectCode->ViewCustomAttributes = "";

		// ActivityCode
		$this->ActivityCode->ViewValue = $this->ActivityCode->CurrentValue;
		$this->ActivityCode->ViewCustomAttributes = "";

		// FinancialYear
		$curVal = strval($this->FinancialYear->CurrentValue);
		if ($curVal != "") {
			$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
			if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
				}
			}
		} else {
			$this->FinancialYear->ViewValue = NULL;
		}
		$this->FinancialYear->ViewCustomAttributes = "";

		// ActivityName
		$this->ActivityName->ViewValue = $this->ActivityName->CurrentValue;
		$this->ActivityName->ViewCustomAttributes = "";

		// MTEFBudget
		$this->MTEFBudget->ViewValue = $this->MTEFBudget->CurrentValue;
		$this->MTEFBudget->ViewValue = FormatNumber($this->MTEFBudget->ViewValue, 2, -2, -2, -2);
		$this->MTEFBudget->CellCssStyle .= "text-align: right;";
		$this->MTEFBudget->ViewCustomAttributes = "";

		// SupplementaryBudget
		$this->SupplementaryBudget->ViewValue = $this->SupplementaryBudget->CurrentValue;
		$this->SupplementaryBudget->ViewValue = FormatNumber($this->SupplementaryBudget->ViewValue, 2, -2, -2, -2);
		$this->SupplementaryBudget->CellCssStyle .= "text-align: right;";
		$this->SupplementaryBudget->ViewCustomAttributes = "";

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->ViewValue = $this->ExpectedAnnualAchievement->CurrentValue;
		$this->ExpectedAnnualAchievement->ViewCustomAttributes = "";

		// ActivityLocation
		$this->ActivityLocation->ViewValue = $this->ActivityLocation->CurrentValue;
		$this->ActivityLocation->ViewCustomAttributes = "";

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

		// ProgrammeCode
		$this->ProgrammeCode->LinkCustomAttributes = "";
		$this->ProgrammeCode->HrefValue = "";
		$this->ProgrammeCode->TooltipValue = "";

		// OucomeCode
		$this->OucomeCode->LinkCustomAttributes = "";
		$this->OucomeCode->HrefValue = "";
		$this->OucomeCode->TooltipValue = "";

		// OutputCode
		$this->OutputCode->LinkCustomAttributes = "";
		$this->OutputCode->HrefValue = "";
		$this->OutputCode->TooltipValue = "";

		// ProjectCode
		$this->ProjectCode->LinkCustomAttributes = "";
		$this->ProjectCode->HrefValue = "";
		$this->ProjectCode->TooltipValue = "";

		// ActivityCode
		$this->ActivityCode->LinkCustomAttributes = "";
		$this->ActivityCode->HrefValue = "";
		$this->ActivityCode->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// ActivityName
		$this->ActivityName->LinkCustomAttributes = "";
		$this->ActivityName->HrefValue = "";
		$this->ActivityName->TooltipValue = "";

		// MTEFBudget
		$this->MTEFBudget->LinkCustomAttributes = "";
		$this->MTEFBudget->HrefValue = "";
		$this->MTEFBudget->TooltipValue = "";

		// SupplementaryBudget
		$this->SupplementaryBudget->LinkCustomAttributes = "";
		$this->SupplementaryBudget->HrefValue = "";
		$this->SupplementaryBudget->TooltipValue = "";

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->LinkCustomAttributes = "";
		$this->ExpectedAnnualAchievement->HrefValue = "";
		$this->ExpectedAnnualAchievement->TooltipValue = "";

		// ActivityLocation
		$this->ActivityLocation->LinkCustomAttributes = "";
		$this->ActivityLocation->HrefValue = "";
		$this->ActivityLocation->TooltipValue = "";

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

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";
		if ($this->ProvinceCode->getSessionValue() != "") {
			$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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
		} else {
			$this->ProvinceCode->EditValue = $this->ProvinceCode->CurrentValue;
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());
		}

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if ($this->LACode->getSessionValue() != "") {
			$this->LACode->CurrentValue = $this->LACode->getSessionValue();
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
		} else {
		}

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";
		if ($this->DepartmentCode->getSessionValue() != "") {
			$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
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
		} else {
		}

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

		// ProgrammeCode
		$this->ProgrammeCode->EditAttrs["class"] = "form-control";
		$this->ProgrammeCode->EditCustomAttributes = "";
		if (!$this->ProgrammeCode->Raw)
			$this->ProgrammeCode->CurrentValue = HtmlDecode($this->ProgrammeCode->CurrentValue);
		$this->ProgrammeCode->EditValue = $this->ProgrammeCode->CurrentValue;
		$this->ProgrammeCode->PlaceHolder = RemoveHtml($this->ProgrammeCode->caption());

		// OucomeCode
		$this->OucomeCode->EditAttrs["class"] = "form-control";
		$this->OucomeCode->EditCustomAttributes = "";

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";

		// ProjectCode
		$this->ProjectCode->EditAttrs["class"] = "form-control";
		$this->ProjectCode->EditCustomAttributes = "";
		if ($this->ProjectCode->getSessionValue() != "") {
			$this->ProjectCode->CurrentValue = $this->ProjectCode->getSessionValue();
			$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
			$curVal = strval($this->ProjectCode->CurrentValue);
			if ($curVal != "") {
				$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
					}
				}
			} else {
				$this->ProjectCode->ViewValue = NULL;
			}
			$this->ProjectCode->ViewCustomAttributes = "";
		} else {
			if (!$this->ProjectCode->Raw)
				$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->EditValue = $this->ProjectCode->CurrentValue;
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());
		}

		// ActivityCode
		$this->ActivityCode->EditAttrs["class"] = "form-control";
		$this->ActivityCode->EditCustomAttributes = "";
		$this->ActivityCode->EditValue = $this->ActivityCode->CurrentValue;
		$this->ActivityCode->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";

		// ActivityName
		$this->ActivityName->EditAttrs["class"] = "form-control";
		$this->ActivityName->EditCustomAttributes = "";
		$this->ActivityName->EditValue = $this->ActivityName->CurrentValue;
		$this->ActivityName->PlaceHolder = RemoveHtml($this->ActivityName->caption());

		// MTEFBudget
		$this->MTEFBudget->EditAttrs["class"] = "form-control";
		$this->MTEFBudget->EditCustomAttributes = "";
		$this->MTEFBudget->EditValue = $this->MTEFBudget->CurrentValue;
		$this->MTEFBudget->PlaceHolder = RemoveHtml($this->MTEFBudget->caption());
		if (strval($this->MTEFBudget->EditValue) != "" && is_numeric($this->MTEFBudget->EditValue))
			$this->MTEFBudget->EditValue = FormatNumber($this->MTEFBudget->EditValue, -2, -2, -2, -2);
		

		// SupplementaryBudget
		$this->SupplementaryBudget->EditAttrs["class"] = "form-control";
		$this->SupplementaryBudget->EditCustomAttributes = "";
		$this->SupplementaryBudget->EditValue = $this->SupplementaryBudget->CurrentValue;
		$this->SupplementaryBudget->PlaceHolder = RemoveHtml($this->SupplementaryBudget->caption());
		if (strval($this->SupplementaryBudget->EditValue) != "" && is_numeric($this->SupplementaryBudget->EditValue))
			$this->SupplementaryBudget->EditValue = FormatNumber($this->SupplementaryBudget->EditValue, -2, -2, -2, -2);
		

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->EditAttrs["class"] = "form-control";
		$this->ExpectedAnnualAchievement->EditCustomAttributes = "";
		if (!$this->ExpectedAnnualAchievement->Raw)
			$this->ExpectedAnnualAchievement->CurrentValue = HtmlDecode($this->ExpectedAnnualAchievement->CurrentValue);
		$this->ExpectedAnnualAchievement->EditValue = $this->ExpectedAnnualAchievement->CurrentValue;
		$this->ExpectedAnnualAchievement->PlaceHolder = RemoveHtml($this->ExpectedAnnualAchievement->caption());

		// ActivityLocation
		$this->ActivityLocation->EditAttrs["class"] = "form-control";
		$this->ActivityLocation->EditCustomAttributes = "";
		if (!$this->ActivityLocation->Raw)
			$this->ActivityLocation->CurrentValue = HtmlDecode($this->ActivityLocation->CurrentValue);
		$this->ActivityLocation->EditValue = $this->ActivityLocation->CurrentValue;
		$this->ActivityLocation->PlaceHolder = RemoveHtml($this->ActivityLocation->caption());

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
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProgrammeCode);
					$doc->exportCaption($this->OucomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ActivityCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->ActivityName);
					$doc->exportCaption($this->SupplementaryBudget);
					$doc->exportCaption($this->ExpectedAnnualAchievement);
					$doc->exportCaption($this->ActivityLocation);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProgrammeCode);
					$doc->exportCaption($this->OucomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ActivityCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->ActivityName);
					$doc->exportCaption($this->MTEFBudget);
					$doc->exportCaption($this->SupplementaryBudget);
					$doc->exportCaption($this->ExpectedAnnualAchievement);
					$doc->exportCaption($this->ActivityLocation);
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
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProgrammeCode);
						$doc->exportField($this->OucomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ActivityCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->ActivityName);
						$doc->exportField($this->SupplementaryBudget);
						$doc->exportField($this->ExpectedAnnualAchievement);
						$doc->exportField($this->ActivityLocation);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProgrammeCode);
						$doc->exportField($this->OucomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ActivityCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->ActivityName);
						$doc->exportField($this->MTEFBudget);
						$doc->exportField($this->SupplementaryBudget);
						$doc->exportField($this->ExpectedAnnualAchievement);
						$doc->exportField($this->ActivityLocation);
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
		$table = 'activity';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'activity';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ActivityCode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['FinancialYear'];

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
		$table = 'activity';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ActivityCode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['FinancialYear'];

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
		$table = 'activity';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ActivityCode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['FinancialYear'];

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
		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();

		//set filter for province
		$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");

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