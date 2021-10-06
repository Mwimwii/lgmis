<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Programme Outputs
 */
class Programme_Outputs extends ReportTable
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

	// Fields
	public $ProgramCode;
	public $ProgramName;
	public $ProgramPurpose;
	public $LAName;
	public $LACode;
	public $Mandate;
	public $OutputName;
	public $OutputType;
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
		$this->TableVar = 'Programme_Outputs';
		$this->TableName = 'Programme Outputs';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`program_output_view`";
		$this->ReportSourceTable = 'program_output_view'; // Report source table
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

		// ProgramCode
		$this->ProgramCode = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ProgramCode->Nullable = FALSE; // NOT NULL field
		$this->ProgramCode->Required = TRUE; // Required field
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->ProgramCode->SourceTableVar = 'program_output_view';
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// ProgramName
		$this->ProgramName = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_ProgramName', 'ProgramName', '`ProgramName`', '`ProgramName`', 200, 255, -1, FALSE, '`ProgramName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramName->Nullable = FALSE; // NOT NULL field
		$this->ProgramName->Required = TRUE; // Required field
		$this->ProgramName->Sortable = TRUE; // Allow sort
		$this->ProgramName->SourceTableVar = 'program_output_view';
		$this->fields['ProgramName'] = &$this->ProgramName;

		// ProgramPurpose
		$this->ProgramPurpose = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_ProgramPurpose', 'ProgramPurpose', '`ProgramPurpose`', '`ProgramPurpose`', 200, 255, -1, FALSE, '`ProgramPurpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramPurpose->GroupingFieldId = 2;
		$this->ProgramPurpose->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->ProgramPurpose->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->ProgramPurpose->GroupByType = "";
		$this->ProgramPurpose->GroupInterval = "0";
		$this->ProgramPurpose->GroupSql = "";
		$this->ProgramPurpose->Nullable = FALSE; // NOT NULL field
		$this->ProgramPurpose->Required = TRUE; // Required field
		$this->ProgramPurpose->Sortable = TRUE; // Allow sort
		$this->ProgramPurpose->SourceTableVar = 'program_output_view';
		$this->fields['ProgramPurpose'] = &$this->ProgramPurpose;

		// LAName
		$this->LAName = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->GroupingFieldId = 1;
		$this->LAName->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->LAName->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->LAName->GroupByType = "";
		$this->LAName->GroupInterval = "0";
		$this->LAName->GroupSql = "";
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->LAName->SourceTableVar = 'program_output_view';
		$this->fields['LAName'] = &$this->LAName;

		// LACode
		$this->LACode = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->SourceTableVar = 'program_output_view';
		$this->fields['LACode'] = &$this->LACode;

		// Mandate
		$this->Mandate = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_Mandate', 'Mandate', '`Mandate`', '`Mandate`', 201, 65535, -1, FALSE, '`Mandate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Mandate->Nullable = FALSE; // NOT NULL field
		$this->Mandate->Required = TRUE; // Required field
		$this->Mandate->Sortable = TRUE; // Allow sort
		$this->Mandate->SourceTableVar = 'program_output_view';
		$this->fields['Mandate'] = &$this->Mandate;

		// OutputName
		$this->OutputName = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_OutputName', 'OutputName', '`OutputName`', '`OutputName`', 200, 255, -1, FALSE, '`OutputName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputName->Nullable = FALSE; // NOT NULL field
		$this->OutputName->Required = TRUE; // Required field
		$this->OutputName->Sortable = TRUE; // Allow sort
		$this->OutputName->SourceTableVar = 'program_output_view';
		$this->fields['OutputName'] = &$this->OutputName;

		// OutputType
		$this->OutputType = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_OutputType', 'OutputType', '`OutputType`', '`OutputType`', 200, 15, -1, FALSE, '`OutputType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputType->Sortable = TRUE; // Allow sort
		$this->OutputType->SourceTableVar = 'program_output_view';
		$this->fields['OutputType'] = &$this->OutputType;

		// FinancialYear
		$this->FinancialYear = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->FinancialYear->SourceTableVar = 'program_output_view';
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// OutputIndicatorName
		$this->OutputIndicatorName = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_OutputIndicatorName', 'OutputIndicatorName', '`OutputIndicatorName`', '`OutputIndicatorName`', 200, 255, -1, FALSE, '`OutputIndicatorName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputIndicatorName->Sortable = TRUE; // Allow sort
		$this->OutputIndicatorName->SourceTableVar = 'program_output_view';
		$this->fields['OutputIndicatorName'] = &$this->OutputIndicatorName;

		// TargetAmount
		$this->TargetAmount = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_TargetAmount', 'TargetAmount', '`TargetAmount`', '`TargetAmount`', 5, 22, -1, FALSE, '`TargetAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TargetAmount->Sortable = TRUE; // Allow sort
		$this->TargetAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->TargetAmount->SourceTableVar = 'program_output_view';
		$this->fields['TargetAmount'] = &$this->TargetAmount;

		// ActualAmount
		$this->ActualAmount = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->ActualAmount->SourceTableVar = 'program_output_view';
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// PercentAchieved
		$this->PercentAchieved = new ReportField('Programme_Outputs', 'Programme Outputs', 'x_PercentAchieved', 'PercentAchieved', '`PercentAchieved`', '`PercentAchieved`', 5, 22, -1, FALSE, '`PercentAchieved`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PercentAchieved->Sortable = TRUE; // Allow sort
		$this->PercentAchieved->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->PercentAchieved->SourceTableVar = 'program_output_view';
		$this->fields['PercentAchieved'] = &$this->PercentAchieved;
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

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`TargetAmount`) AS `sum_targetamount`, SUM(`ActualAmount`) AS `sum_actualamount`, AVG(`PercentAchieved`) AS `avg_percentachieved` FROM " . $this->getSqlFrom();
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`program_output_view`";
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
		$groupField = &$this->LAName;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->ProgramPurpose;
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
		return "`ProgramCode` = @ProgramCode@ AND `LACode` = '@LACode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ProgramCode', $row) ? $row['ProgramCode'] : NULL;
		else
			$val = $this->ProgramCode->OldValue !== NULL ? $this->ProgramCode->OldValue : $this->ProgramCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ProgramCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('LACode', $row) ? $row['LACode'] : NULL;
		else
			$val = $this->LACode->OldValue !== NULL ? $this->LACode->OldValue : $this->LACode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LACode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
		$json .= "ProgramCode:" . JsonEncode($this->ProgramCode->CurrentValue, "number");
		$json .= ",LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
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
		if ($this->ProgramCode->CurrentValue != NULL) {
			$url .= "ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "&LACode=" . urlencode($this->LACode->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("ProgramCode") !== NULL)
				$arKey[] = Param("ProgramCode");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("LACode") !== NULL)
				$arKey[] = Param("LACode");
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
				if (!is_numeric($key[0])) // ProgramCode
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
				$this->ProgramCode->CurrentValue = $key[0];
			else
				$this->ProgramCode->OldValue = $key[0];
			if ($setCurrent)
				$this->LACode->CurrentValue = $key[1];
			else
				$this->LACode->OldValue = $key[1];
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