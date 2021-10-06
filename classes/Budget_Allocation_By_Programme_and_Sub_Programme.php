<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Budget Allocation By Programme and Sub Programme
 */
class Budget_Allocation_By_Programme_and_Sub_Programme extends CrosstabTable
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
	public $LACode;
	public $LAName;
	public $ProgramCode;
	public $ProgramName;
	public $ProgramPurpose;
	public $SubProgramCode;
	public $SubProgramName;
	public $FinancialYear;
	public $BudgetEstimate;
	public $ApprovedBudget;
	public $ActualAmount;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Budget_Allocation_By_Programme_and_Sub_Programme';
		$this->TableName = 'Budget Allocation By Programme and Sub Programme';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`budget_allocate_prog_view`";
		$this->ReportSourceTable = 'budget_allocate_prog_view'; // Report source table
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

		// LACode
		$this->LACode = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['LACode'] = &$this->LACode;

		// LAName
		$this->LAName = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->GroupingFieldId = 1;
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->LAName->Lookup = new Lookup('LAName', 'budget_allocate_prog_view', TRUE, 'LAName', ["LAName","","",""], [], [], [], [], [], [], '`LAName` ASC', '');
		$this->LAName->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['LAName'] = &$this->LAName;

		// ProgramCode
		$this->ProgramCode = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramCode->Nullable = FALSE; // NOT NULL field
		$this->ProgramCode->Required = TRUE; // Required field
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->ProgramCode->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// ProgramName
		$this->ProgramName = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_ProgramName', 'ProgramName', '`ProgramName`', '`ProgramName`', 200, 255, -1, FALSE, '`ProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramName->GroupingFieldId = 2;
		$this->ProgramName->Nullable = FALSE; // NOT NULL field
		$this->ProgramName->Required = TRUE; // Required field
		$this->ProgramName->Sortable = TRUE; // Allow sort
		$this->ProgramName->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['ProgramName'] = &$this->ProgramName;

		// ProgramPurpose
		$this->ProgramPurpose = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_ProgramPurpose', 'ProgramPurpose', '`ProgramPurpose`', '`ProgramPurpose`', 200, 255, -1, FALSE, '`ProgramPurpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramPurpose->Nullable = FALSE; // NOT NULL field
		$this->ProgramPurpose->Required = TRUE; // Required field
		$this->ProgramPurpose->Sortable = TRUE; // Allow sort
		$this->ProgramPurpose->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['ProgramPurpose'] = &$this->ProgramPurpose;

		// SubProgramCode
		$this->SubProgramCode = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_SubProgramCode', 'SubProgramCode', '`SubProgramCode`', '`SubProgramCode`', 3, 11, -1, FALSE, '`SubProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubProgramCode->Nullable = FALSE; // NOT NULL field
		$this->SubProgramCode->Sortable = TRUE; // Allow sort
		$this->SubProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->SubProgramCode->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['SubProgramCode'] = &$this->SubProgramCode;

		// SubProgramName
		$this->SubProgramName = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_SubProgramName', 'SubProgramName', '`SubProgramName`', '`SubProgramName`', 200, 255, -1, FALSE, '`SubProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubProgramName->GroupingFieldId = 3;
		$this->SubProgramName->Nullable = FALSE; // NOT NULL field
		$this->SubProgramName->Required = TRUE; // Required field
		$this->SubProgramName->Sortable = TRUE; // Allow sort
		$this->SubProgramName->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['SubProgramName'] = &$this->SubProgramName;

		// FinancialYear
		$this->FinancialYear = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->FinancialYear->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// BudgetEstimate
		$this->BudgetEstimate = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', '`BudgetEstimate`', 5, 23, -1, FALSE, '`BudgetEstimate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BudgetEstimate->Sortable = TRUE; // Allow sort
		$this->BudgetEstimate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->BudgetEstimate->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['BudgetEstimate'] = &$this->BudgetEstimate;

		// ApprovedBudget
		$this->ApprovedBudget = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_ApprovedBudget', 'ApprovedBudget', '`ApprovedBudget`', '`ApprovedBudget`', 5, 23, -1, FALSE, '`ApprovedBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ApprovedBudget->Sortable = TRUE; // Allow sort
		$this->ApprovedBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->ApprovedBudget->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['ApprovedBudget'] = &$this->ApprovedBudget;

		// ActualAmount
		$this->ActualAmount = new ReportField('Budget_Allocation_By_Programme_and_Sub_Programme', 'Budget Allocation By Programme and Sub Programme', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 23, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->ActualAmount->SourceTableVar = 'budget_allocate_prog_view';
		$this->fields['ActualAmount'] = &$this->ActualAmount;
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
		$firstGroupField = &$this->LAName;
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

	// Crosstab properties
	private $_sqlSelectAggregate = "";
	private $_sqlGroupByAggregate = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Group By Aggregate
	public function getSqlGroupByAggregate()
	{
		return ($this->_sqlGroupByAggregate != "") ? $this->_sqlGroupByAggregate : "";
	}
	public function setSqlGroupByAggregate($v)
	{
		$this->_sqlGroupByAggregate = $v;
	}

	// Table level SQL
	private $_columnField = "";
	private $_columnDateType = "";
	private $_columnCaptions = "";
	private $_columnNames = "";
	private $_columnValues = "";
	private $_sqlDistinctSelect = "";
	private $_sqlDistinctWhere = "";
	private $_sqlDistinctOrderBy = "";
	public $Columns;
	public $ColumnCount;
	public $Col;
	public $DistinctColumnFields = "";
	private $_columnLoaded = FALSE;

	// Column field
	public function getColumnField()
	{
		return ($this->_columnField != "") ? $this->_columnField : "`FinancialYear`";
	}
	public function setColumnField($v)
	{
		$this->_columnField = $v;
	}

	// Column date type
	public function getColumnDateType()
	{
		return ($this->_columnDateType != "") ? $this->_columnDateType : "";
	}
	public function setColumnDateType($v)
	{
		$this->_columnDateType = $v;
	}

	// Column captions
	public function getColumnCaptions()
	{
		global $Language;
		return ($this->_columnCaptions != "") ? $this->_columnCaptions : "";
	}
	public function setColumnCaptions($v)
	{
		$this->_columnCaptions = $v;
	}

	// Column names
	public function getColumnNames()
	{
		return ($this->_columnNames != "") ? $this->_columnNames : "";
	}
	public function setColumnNames($v)
	{
		$this->_columnNames = $v;
	}

	// Column values
	public function getColumnValues()
	{
		return ($this->_columnValues != "") ? $this->_columnValues : "";
	}
	public function setColumnValues($v)
	{
		$this->_columnValues = $v;
	}

	// Select Distinct
	public function getSqlDistinctSelect()
	{
		return ($this->_sqlDistinctSelect != "") ? $this->_sqlDistinctSelect : "SELECT DISTINCT `FinancialYear` FROM `budget_allocate_prog_view`";
	}
	public function setSqlDistinctSelect($v)
	{
		$this->_sqlDistinctSelect = $v;
	}

	// Distinct Where
	public function getSqlDistinctWhere()
	{
		$where = ($this->_sqlDistinctWhere != "") ? $this->_sqlDistinctWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlDistinctWhere($v)
	{
		$this->_sqlDistinctWhere = $v;
	}

	// Distinct Order By
	public function getSqlDistinctOrderBy()
	{
		return ($this->_sqlDistinctOrderBy != "") ? $this->_sqlDistinctOrderBy : "`FinancialYear` ASC";
	}
	public function setSqlDistinctOrderBy($v)
	{
		$this->_sqlDistinctOrderBy = $v;
	}

	// Load column values
	public function loadColumnValues($filter = "")
	{
		global $Language;

		// Data already loaded, return
		if ($this->_columnLoaded)
			return;
		$conn = $this->getConnection();

		// Build SQL
		$sql = BuildReportSql($this->getSqlDistinctSelect(), $this->getSqlDistinctWhere(), "", "", $this->getSqlDistinctOrderBy(), $filter, "");

		// Load recordset
		$rscol = $conn->execute($sql);

		// Get distinct column count
		$this->ColumnCount = ($rscol) ? $rscol->recordCount() : 0;

/* Uncomment to show phrase
		if ($this->ColumnCount == 0) {
			if ($rscol)
				$rscol->close();
			echo "<p>" . $Language->phrase("NoDistinctColVals") . $sql . "</p>";
			exit();
		}
*/
		$this->Columns = Init2DArray($this->ColumnCount + 1, 4, NULL);
		$colcnt = 0;
		while ($rscol && !$rscol->EOF) {
			if ($rscol->fields[0] === NULL) {
				$wrkValue = Config("NULL_VALUE");
				$wrkCaption = $Language->phrase("NullLabel");
			} elseif (strval($rscol->fields[0]) == "") {
				$wrkValue = EMPTY_VALUE;
				$wrkCaption = $Language->phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Columns[$colcnt] = new CrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->moveNext();
		}
		if ($rscol)
			$rscol->close();

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$groupCount = 3;
		$this->SummaryFields[0] = new SummaryField('x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', 'SUM');
		$this->SummaryFields[0]->SummaryCaption = $Language->phrase("RptSum");
		$this->SummaryFields[0]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = 0;

		// Update crosstab SQL
		$sqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($i = 1; $i <= $this->ColumnCount; $i++) {
				$fld = CrosstabFieldExpression($smry->SummaryType, $smry->Expression, $this->getColumnField(), $this->getColumnDateType(), $this->Columns[$i]->Value, "", "C" . $is . $i, $this->Dbid);
				if ($sqlFlds != "")
					$sqlFlds .= ", ";
				$sqlFlds .= $fld;
			}
		}
		$this->DistinctColumnFields = $sqlFlds ?: "NULL"; // In case ColumnCount = 0
		$this->_columnLoaded = TRUE;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->LAName->ViewValue = $this->LAName->CurrentValue;
		$this->ProgramName->ViewValue = $this->ProgramName->CurrentValue;
		$this->SubProgramName->ViewValue = $this->SubProgramName->CurrentValue;
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`budget_allocate_prog_view`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT `LAName`, `ProgramName`, `SubProgramName`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
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
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "`LAName`, `ProgramName`, `SubProgramName`";
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