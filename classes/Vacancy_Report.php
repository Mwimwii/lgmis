<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Vacancy Report
 */
class Vacancy_Report extends ReportTable
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
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;

	// Fields
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $PositionCode;
	public $SalaryScale;
	public $PositionName;
	public $RequisiteQualification;
	public $FieldQualified;
	public $DepartmentName;
	public $SectionName;
	public $CouncilType;
	public $EmploymentStatus;
	public $MonthsVacant;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Vacancy_Report';
		$this->TableName = 'Vacancy Report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`vacancy_view`";
		$this->ReportSourceTable = 'vacancy_view'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// ProvinceCode
		$this->ProvinceCode = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->GroupingFieldId = 1;
		$this->ProvinceCode->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->ProvinceCode->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->ProvinceCode->GroupByType = "";
		$this->ProvinceCode->GroupInterval = "0";
		$this->ProvinceCode->GroupSql = "";
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], [], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->ProvinceCode->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->ProvinceCode->SourceTableVar = 'vacancy_view';
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->GroupingFieldId = 2;
		$this->LACode->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->LACode->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->LACode->GroupByType = "";
		$this->LACode->GroupInterval = "0";
		$this->LACode->GroupSql = "";
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->LACode->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->LACode->SourceTableVar = 'vacancy_view';
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->GroupingFieldId = 3;
		$this->DepartmentCode->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->DepartmentCode->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->DepartmentCode->GroupByType = "";
		$this->DepartmentCode->GroupInterval = "0";
		$this->DepartmentCode->GroupSql = "";
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], [], [], [], [], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->DepartmentCode->SourceTableVar = 'vacancy_view';
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->GroupingFieldId = 4;
		$this->SectionCode->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->SectionCode->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->SectionCode->GroupByType = "";
		$this->SectionCode->GroupInterval = "0";
		$this->SectionCode->GroupSql = "";
		$this->SectionCode->Nullable = FALSE; // NOT NULL field
		$this->SectionCode->Required = TRUE; // Required field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], [], [], [], [], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->SectionCode->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->SectionCode->SourceTableVar = 'vacancy_view';
		$this->fields['SectionCode'] = &$this->SectionCode;

		// PositionCode
		$this->PositionCode = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_PositionCode', 'PositionCode', '`PositionCode`', '`PositionCode`', 3, 11, -1, FALSE, '`PositionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PositionCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->PositionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->PositionCode->Sortable = TRUE; // Allow sort
		$this->PositionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PositionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PositionCode->Lookup = new Lookup('PositionCode', 'position_ref', FALSE, 'PositionCode', ["PositionName","PositionCode","",""], [], [], [], [], [], [], '', '');
		$this->PositionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->PositionCode->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->PositionCode->SourceTableVar = 'vacancy_view';
		$this->fields['PositionCode'] = &$this->PositionCode;

		// SalaryScale
		$this->SalaryScale = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 13, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->SalaryScale->SourceTableVar = 'vacancy_view';
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// PositionName
		$this->PositionName = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->PositionName->SourceTableVar = 'vacancy_view';
		$this->fields['PositionName'] = &$this->PositionName;

		// RequisiteQualification
		$this->RequisiteQualification = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_RequisiteQualification', 'RequisiteQualification', '`RequisiteQualification`', '`RequisiteQualification`', 200, 40, -1, FALSE, '`RequisiteQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RequisiteQualification->Sortable = TRUE; // Allow sort
		$this->RequisiteQualification->SourceTableVar = 'vacancy_view';
		$this->fields['RequisiteQualification'] = &$this->RequisiteQualification;

		// FieldQualified
		$this->FieldQualified = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_FieldQualified', 'FieldQualified', '`FieldQualified`', '`FieldQualified`', 2, 5, -1, FALSE, '`FieldQualified`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FieldQualified->Sortable = TRUE; // Allow sort
		$this->FieldQualified->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->FieldQualified->SourceTableVar = 'vacancy_view';
		$this->fields['FieldQualified'] = &$this->FieldQualified;

		// DepartmentName
		$this->DepartmentName = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_DepartmentName', 'DepartmentName', '`DepartmentName`', '`DepartmentName`', 200, 255, -1, FALSE, '`DepartmentName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentName->Nullable = FALSE; // NOT NULL field
		$this->DepartmentName->Required = TRUE; // Required field
		$this->DepartmentName->Sortable = TRUE; // Allow sort
		$this->DepartmentName->SourceTableVar = 'vacancy_view';
		$this->fields['DepartmentName'] = &$this->DepartmentName;

		// SectionName
		$this->SectionName = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_SectionName', 'SectionName', '`SectionName`', '`SectionName`', 200, 255, -1, FALSE, '`SectionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionName->Nullable = FALSE; // NOT NULL field
		$this->SectionName->Required = TRUE; // Required field
		$this->SectionName->Sortable = TRUE; // Allow sort
		$this->SectionName->SourceTableVar = 'vacancy_view';
		$this->fields['SectionName'] = &$this->SectionName;

		// CouncilType
		$this->CouncilType = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_CouncilType', 'CouncilType', '`CouncilType`', '`CouncilType`', 16, 3, -1, FALSE, '`CouncilType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CouncilType->Sortable = TRUE; // Allow sort
		$this->CouncilType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->CouncilType->SourceTableVar = 'vacancy_view';
		$this->fields['CouncilType'] = &$this->CouncilType;

		// EmploymentStatus
		$this->EmploymentStatus = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_EmploymentStatus', 'EmploymentStatus', '`EmploymentStatus`', '`EmploymentStatus`', 16, 3, -1, FALSE, '`EmploymentStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmploymentStatus->Sortable = TRUE; // Allow sort
		$this->EmploymentStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->EmploymentStatus->SourceTableVar = 'vacancy_view';
		$this->fields['EmploymentStatus'] = &$this->EmploymentStatus;

		// MonthsVacant
		$this->MonthsVacant = new ReportField('Vacancy_Report', 'Vacancy Report', 'x_MonthsVacant', 'MonthsVacant', '`MonthsVacant`', '`MonthsVacant`', 20, 21, -1, FALSE, '`MonthsVacant`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MonthsVacant->Sortable = TRUE; // Allow sort
		$this->MonthsVacant->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->MonthsVacant->SourceTableVar = 'vacancy_view';
		$this->fields['MonthsVacant'] = &$this->MonthsVacant;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
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
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
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
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
	}

	// Detail filter
	public function sqlDetailFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->ProvinceCode;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix != "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix != "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount != "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->ProvinceCode->ViewValue = GetDropDownDisplayValue($this->ProvinceCode->CurrentValue, "", 0);
		$this->LACode->ViewValue = GetDropDownDisplayValue($this->LACode->CurrentValue, "", 0);
		$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->ViewValue = GetDropDownDisplayValue($this->SectionCode->CurrentValue, "", 0);
		$this->PositionCode->ViewValue = GetDropDownDisplayValue($this->PositionCode->CurrentValue, "", 0);
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`vacancy_view`";
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->ProvinceCode;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->LACode;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->DepartmentCode;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->SectionCode;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		return "SELECT " . $select . " FROM " . $this->getSqlFrom();
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
			return "";
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
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "local_authority" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
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
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
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

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
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