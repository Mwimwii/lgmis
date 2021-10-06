<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Program Budget Allocation
 */
class Program_Budget_Allocation extends ReportTable
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
	public $ShowGroupHeaderAsRow = TRUE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;
	public $Chart1;

	// Fields
	public $AccountGroupName;
	public $AccountName;
	public $ProgramName;
	public $SubProgramName;
	public $LACode;
	public $FinancialYear;
	public $AccountCode;
	public $BudgetEstimate;
	public $ActualAmount;
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
		$this->TableVar = 'Program_Budget_Allocation';
		$this->TableName = 'Program Budget Allocation';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`program_budget_view`";
		$this->ReportSourceTable = 'program_budget_view'; // Report source table
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

		// AccountGroupName
		$this->AccountGroupName = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_AccountGroupName', 'AccountGroupName', '`AccountGroupName`', '`AccountGroupName`', 200, 255, -1, FALSE, '`AccountGroupName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountGroupName->Sortable = TRUE; // Allow sort
		$this->AccountGroupName->SourceTableVar = 'program_budget_view';
		$this->fields['AccountGroupName'] = &$this->AccountGroupName;

		// AccountName
		$this->AccountName = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_AccountName', 'AccountName', '`AccountName`', '`AccountName`', 200, 255, -1, FALSE, '`AccountName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountName->Nullable = FALSE; // NOT NULL field
		$this->AccountName->Required = TRUE; // Required field
		$this->AccountName->Sortable = TRUE; // Allow sort
		$this->AccountName->SourceTableVar = 'program_budget_view';
		$this->fields['AccountName'] = &$this->AccountName;

		// ProgramName
		$this->ProgramName = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_ProgramName', 'ProgramName', '`ProgramName`', '`ProgramName`', 200, 255, -1, FALSE, '`ProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramName->GroupingFieldId = 2;
		$this->ProgramName->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->ProgramName->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->ProgramName->GroupByType = "";
		$this->ProgramName->GroupInterval = "0";
		$this->ProgramName->GroupSql = "";
		$this->ProgramName->Nullable = FALSE; // NOT NULL field
		$this->ProgramName->Required = TRUE; // Required field
		$this->ProgramName->Sortable = TRUE; // Allow sort
		$this->ProgramName->SourceTableVar = 'program_budget_view';
		$this->fields['ProgramName'] = &$this->ProgramName;

		// SubProgramName
		$this->SubProgramName = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_SubProgramName', 'SubProgramName', '`SubProgramName`', '`SubProgramName`', 200, 255, -1, FALSE, '`SubProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubProgramName->GroupingFieldId = 3;
		$this->SubProgramName->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->SubProgramName->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->SubProgramName->GroupByType = "";
		$this->SubProgramName->GroupInterval = "0";
		$this->SubProgramName->GroupSql = "";
		$this->SubProgramName->Nullable = FALSE; // NOT NULL field
		$this->SubProgramName->Required = TRUE; // Required field
		$this->SubProgramName->Sortable = TRUE; // Allow sort
		$this->SubProgramName->SourceTableVar = 'program_budget_view';
		$this->fields['SubProgramName'] = &$this->SubProgramName;

		// LACode
		$this->LACode = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', TRUE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '`LAName` ASC', '');
		$this->LACode->SourceTableVar = 'program_budget_view';
		$this->fields['LACode'] = &$this->LACode;

		// FinancialYear
		$this->FinancialYear = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->FinancialYear->SourceTableVar = 'program_budget_view';
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// AccountCode
		$this->AccountCode = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_AccountCode', 'AccountCode', '`AccountCode`', '`AccountCode`', 200, 25, -1, FALSE, '`AccountCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountCode->Nullable = FALSE; // NOT NULL field
		$this->AccountCode->Required = TRUE; // Required field
		$this->AccountCode->Sortable = TRUE; // Allow sort
		$this->AccountCode->SourceTableVar = 'program_budget_view';
		$this->fields['AccountCode'] = &$this->AccountCode;

		// BudgetEstimate
		$this->BudgetEstimate = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', '`BudgetEstimate`', 5, 22, -1, FALSE, '`BudgetEstimate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BudgetEstimate->Nullable = FALSE; // NOT NULL field
		$this->BudgetEstimate->Sortable = TRUE; // Allow sort
		$this->BudgetEstimate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->BudgetEstimate->SourceTableVar = 'program_budget_view';
		$this->fields['BudgetEstimate'] = &$this->BudgetEstimate;

		// ActualAmount
		$this->ActualAmount = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->ActualAmount->SourceTableVar = 'program_budget_view';
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// DepartmentCode
		$this->DepartmentCode = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->DepartmentCode->SourceTableVar = 'program_budget_view';
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->SectionCode->SourceTableVar = 'program_budget_view';
		$this->fields['SectionCode'] = &$this->SectionCode;

		// OutputCode
		$this->OutputCode = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->OutputCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->OutputCode->IsPrimaryKey = TRUE; // Primary key field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->OutputCode->SourceTableVar = 'program_budget_view';
		$this->fields['OutputCode'] = &$this->OutputCode;

		// OutputName
		$this->OutputName = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_OutputName', 'OutputName', '`OutputName`', '`OutputName`', 200, 255, -1, FALSE, '`OutputName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputName->Nullable = FALSE; // NOT NULL field
		$this->OutputName->Required = TRUE; // Required field
		$this->OutputName->Sortable = TRUE; // Allow sort
		$this->OutputName->SourceTableVar = 'program_budget_view';
		$this->fields['OutputName'] = &$this->OutputName;

		// UnitOfMeasure
		$this->UnitOfMeasure = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 10, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->UnitOfMeasure->SourceTableVar = 'program_budget_view';
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// Quantity
		$this->Quantity = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_Quantity', 'Quantity', '`Quantity`', '`Quantity`', 5, 22, -1, FALSE, '`Quantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Quantity->Nullable = FALSE; // NOT NULL field
		$this->Quantity->Required = TRUE; // Required field
		$this->Quantity->Sortable = TRUE; // Allow sort
		$this->Quantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->Quantity->SourceTableVar = 'program_budget_view';
		$this->fields['Quantity'] = &$this->Quantity;

		// PeriodType
		$this->PeriodType = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 200, 1, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->PeriodType->SourceTableVar = 'program_budget_view';
		$this->fields['PeriodType'] = &$this->PeriodType;

		// PeriodLength
		$this->PeriodLength = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_PeriodLength', 'PeriodLength', '`PeriodLength`', '`PeriodLength`', 5, 22, -1, FALSE, '`PeriodLength`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PeriodLength->Sortable = TRUE; // Allow sort
		$this->PeriodLength->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->PeriodLength->SourceTableVar = 'program_budget_view';
		$this->fields['PeriodLength'] = &$this->PeriodLength;

		// Frequency
		$this->Frequency = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_Frequency', 'Frequency', '`Frequency`', '`Frequency`', 5, 22, -1, FALSE, '`Frequency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Frequency->Nullable = FALSE; // NOT NULL field
		$this->Frequency->Sortable = TRUE; // Allow sort
		$this->Frequency->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->Frequency->SourceTableVar = 'program_budget_view';
		$this->fields['Frequency'] = &$this->Frequency;

		// UnitCost
		$this->UnitCost = new ReportField('Program_Budget_Allocation', 'Program Budget Allocation', 'x_UnitCost', 'UnitCost', '`UnitCost`', '`UnitCost`', 5, 22, -1, FALSE, '`UnitCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitCost->Nullable = FALSE; // NOT NULL field
		$this->UnitCost->Required = TRUE; // Required field
		$this->UnitCost->Sortable = TRUE; // Allow sort
		$this->UnitCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->UnitCost->SourceTableVar = 'program_budget_view';
		$this->fields['UnitCost'] = &$this->UnitCost;

		// Chart1
		$this->Chart1 = new DbChart($this, 'Chart1', 'Chart1', 'AccountGroupName', 'BudgetEstimate', 1005, '', 0, 'SUM', 600, 500);
		$this->Chart1->SortType = 0;
		$this->Chart1->SortSequence = "";
		$this->Chart1->SqlSelect = "SELECT `AccountGroupName`, '', SUM(`BudgetEstimate`) FROM ";
		$this->Chart1->SqlGroupBy = "`AccountGroupName`";
		$this->Chart1->SqlOrderBy = "";
		$this->Chart1->SeriesDateType = "";
		$this->Chart1->ID = "Program_Budget_Allocation_Chart1"; // Chart ID
		$this->Chart1->setParameters([
			["type", "1005"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart1->setParameters([
			["caption", $this->Chart1->caption()],
			["xaxisname", $this->Chart1->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart1->setParameter("yaxisname", $this->Chart1->yAxisName()); // Y axis name
		$this->Chart1->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "1"]
		]); // Show names / Show values / Show hover
		$this->Chart1->setParameter("alpha", "50"); // Chart alpha
		$this->Chart1->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart1->setParameters([["options.legend.display",true],["options.legend.position","right"],["options.legend.fullWidth",false],["options.legend.reverse",false],["options.legend.labels.boxWidth",3],["options.legend.labels.usePointStyle",false],["options.title.display",false],["options.tooltips.enabled",false],["options.tooltips.intersect",false],["options.tooltips.displayColors",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["scale.gridLines.offsetGridLines",false]]);
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
		$firstGroupField = &$this->ProgramName;
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
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`BudgetEstimate`) AS `sum_budgetestimate`, SUM(`ActualAmount`) AS `sum_actualamount` FROM " . $this->getSqlFrom();
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->ProgramName;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->SubProgramName;
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`AccountGroupName` ASC,`AccountName` ASC";
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