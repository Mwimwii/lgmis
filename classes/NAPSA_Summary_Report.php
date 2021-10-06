<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for NAPSA Summary Report
 */
class NAPSA_Summary_Report extends ReportTable
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
	public $LocalAuthority;
	public $DepartmentName;
	public $SectionName;
	public $EmployeeID;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $DateOfBirth;
	public $NRC;
	public $SocialSecurityNo;
	public $PayrollPeriod;
	public $MonthShort;
	public $Year;
	public $GrossIncome;
	public $EmployeeContribution;
	public $EmployerContribution;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'NAPSA_Summary_Report';
		$this->TableName = 'NAPSA Summary Report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`napsa_summary_view`";
		$this->ReportSourceTable = 'napsa_summary_view'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "landscape"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// LocalAuthority
		$this->LocalAuthority = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_LocalAuthority', 'LocalAuthority', '`LocalAuthority`', '`LocalAuthority`', 200, 40, -1, FALSE, '`LocalAuthority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LocalAuthority->GroupingFieldId = 1;
		$this->LocalAuthority->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->LocalAuthority->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->LocalAuthority->GroupByType = "";
		$this->LocalAuthority->GroupInterval = "0";
		$this->LocalAuthority->GroupSql = "";
		$this->LocalAuthority->Nullable = FALSE; // NOT NULL field
		$this->LocalAuthority->Required = TRUE; // Required field
		$this->LocalAuthority->Sortable = TRUE; // Allow sort
		$this->LocalAuthority->SourceTableVar = 'napsa_summary_view';
		$this->fields['LocalAuthority'] = &$this->LocalAuthority;

		// DepartmentName
		$this->DepartmentName = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_DepartmentName', 'DepartmentName', '`DepartmentName`', '`DepartmentName`', 200, 255, -1, FALSE, '`DepartmentName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentName->GroupingFieldId = 2;
		$this->DepartmentName->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->DepartmentName->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->DepartmentName->GroupByType = "";
		$this->DepartmentName->GroupInterval = "0";
		$this->DepartmentName->GroupSql = "";
		$this->DepartmentName->Nullable = FALSE; // NOT NULL field
		$this->DepartmentName->Required = TRUE; // Required field
		$this->DepartmentName->Sortable = TRUE; // Allow sort
		$this->DepartmentName->SourceTableVar = 'napsa_summary_view';
		$this->fields['DepartmentName'] = &$this->DepartmentName;

		// SectionName
		$this->SectionName = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_SectionName', 'SectionName', '`SectionName`', '`SectionName`', 200, 255, -1, FALSE, '`SectionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionName->GroupingFieldId = 3;
		$this->SectionName->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->SectionName->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->SectionName->GroupByType = "";
		$this->SectionName->GroupInterval = "0";
		$this->SectionName->GroupSql = "";
		$this->SectionName->Nullable = FALSE; // NOT NULL field
		$this->SectionName->Required = TRUE; // Required field
		$this->SectionName->Sortable = TRUE; // Allow sort
		$this->SectionName->SourceTableVar = 'napsa_summary_view';
		$this->fields['SectionName'] = &$this->SectionName;

		// EmployeeID
		$this->EmployeeID = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->EmployeeID->SourceTableVar = 'napsa_summary_view';
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// Surname
		$this->Surname = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->Surname->SourceTableVar = 'napsa_summary_view';
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->FirstName->SourceTableVar = 'napsa_summary_view';
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->MiddleName->SourceTableVar = 'napsa_summary_view';
		$this->fields['MiddleName'] = &$this->MiddleName;

		// DateOfBirth
		$this->DateOfBirth = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Nullable = FALSE; // NOT NULL field
		$this->DateOfBirth->Required = TRUE; // Required field
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->DateOfBirth->SourceTableVar = 'napsa_summary_view';
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// NRC
		$this->NRC = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->NRC->SourceTableVar = 'napsa_summary_view';
		$this->fields['NRC'] = &$this->NRC;

		// SocialSecurityNo
		$this->SocialSecurityNo = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_SocialSecurityNo', 'SocialSecurityNo', '`SocialSecurityNo`', '`SocialSecurityNo`', 200, 50, -1, FALSE, '`SocialSecurityNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SocialSecurityNo->Sortable = TRUE; // Allow sort
		$this->SocialSecurityNo->SourceTableVar = 'napsa_summary_view';
		$this->fields['SocialSecurityNo'] = &$this->SocialSecurityNo;

		// PayrollPeriod
		$this->PayrollPeriod = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->GroupingFieldId = 4;
		$this->PayrollPeriod->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->PayrollPeriod->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->PayrollPeriod->GroupByType = "";
		$this->PayrollPeriod->GroupInterval = "0";
		$this->PayrollPeriod->GroupSql = "";
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->PayrollPeriod->SourceTableVar = 'napsa_summary_view';
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// MonthShort
		$this->MonthShort = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_MonthShort', 'MonthShort', '`MonthShort`', '`MonthShort`', 200, 4, -1, FALSE, '`MonthShort`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MonthShort->Nullable = FALSE; // NOT NULL field
		$this->MonthShort->Required = TRUE; // Required field
		$this->MonthShort->Sortable = TRUE; // Allow sort
		$this->MonthShort->SourceTableVar = 'napsa_summary_view';
		$this->fields['MonthShort'] = &$this->MonthShort;

		// Year
		$this->Year = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_Year', 'Year', '`Year`', '`Year`', 18, 4, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Nullable = FALSE; // NOT NULL field
		$this->Year->Required = TRUE; // Required field
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->Year->SourceTableVar = 'napsa_summary_view';
		$this->fields['Year'] = &$this->Year;

		// GrossIncome
		$this->GrossIncome = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_GrossIncome', 'GrossIncome', '`GrossIncome`', '`GrossIncome`', 5, 23, -1, FALSE, '`GrossIncome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->GrossIncome->Sortable = TRUE; // Allow sort
		$this->GrossIncome->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->GrossIncome->SourceTableVar = 'napsa_summary_view';
		$this->fields['GrossIncome'] = &$this->GrossIncome;

		// EmployeeContribution
		$this->EmployeeContribution = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_EmployeeContribution', 'EmployeeContribution', '`EmployeeContribution`', '`EmployeeContribution`', 131, 32, -1, FALSE, '`EmployeeContribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeContribution->Sortable = TRUE; // Allow sort
		$this->EmployeeContribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->EmployeeContribution->SourceTableVar = 'napsa_summary_view';
		$this->fields['EmployeeContribution'] = &$this->EmployeeContribution;

		// EmployerContribution
		$this->EmployerContribution = new ReportField('NAPSA_Summary_Report', 'NAPSA Summary Report', 'x_EmployerContribution', 'EmployerContribution', '`EmployerContribution`', '`EmployerContribution`', 131, 32, -1, FALSE, '`EmployerContribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployerContribution->Sortable = TRUE; // Allow sort
		$this->EmployerContribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->EmployerContribution->SourceTableVar = 'napsa_summary_view';
		$this->fields['EmployerContribution'] = &$this->EmployerContribution;
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

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->LocalAuthority;
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
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`GrossIncome`) AS `sum_grossincome`, SUM(`EmployeeContribution`) AS `sum_employeecontribution`, SUM(`EmployerContribution`) AS `sum_employercontribution` FROM " . $this->getSqlFrom();
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
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`napsa_summary_view`";
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
		$groupField = &$this->LocalAuthority;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->DepartmentName;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->SectionName;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->PayrollPeriod;
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