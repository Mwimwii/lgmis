<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for action
 */
class _action extends DbTable
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
	public $ProgramCode;
	public $OucomeCode;
	public $OutputCode;
	public $ProjectCode;
	public $ActionCode;
	public $ActionName;
	public $ActionType;
	public $FinancialYear;
	public $MTEFBudget;
	public $SupplementaryBudget;
	public $ExpectedAnnualAchievement;
	public $ActionLocation;
	public $Latitude;
	public $Longitude;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = '_action';
		$this->TableName = 'action';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`action`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
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

		// ProgramCode
		$this->ProgramCode = new DbField('_action', 'action', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProgramCode->Nullable = FALSE; // NOT NULL field
		$this->ProgramCode->Required = TRUE; // Required field
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->Lookup = new Lookup('ProgramCode', 'la_program', FALSE, 'ProgramCode', ["ProgramName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// OucomeCode
		$this->OucomeCode = new DbField('_action', 'action', 'x_OucomeCode', 'OucomeCode', '`OucomeCode`', '`OucomeCode`', 3, 11, -1, FALSE, '`OucomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OucomeCode->IsForeignKey = TRUE; // Foreign key field
		$this->OucomeCode->Nullable = FALSE; // NOT NULL field
		$this->OucomeCode->Required = TRUE; // Required field
		$this->OucomeCode->Sortable = TRUE; // Allow sort
		$this->OucomeCode->Lookup = new Lookup('OucomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], [], [], [], [], [], [], '', '');
		$this->OucomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OucomeCode'] = &$this->OucomeCode;

		// OutputCode
		$this->OutputCode = new DbField('_action', 'action', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OutputCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutputCode->Nullable = FALSE; // NOT NULL field
		$this->OutputCode->Required = TRUE; // Required field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->Lookup = new Lookup('OutputCode', 'output', FALSE, 'OutputCode', ["OutputName","","",""], [], [], [], [], [], [], '', '');
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// ProjectCode
		$this->ProjectCode = new DbField('_action', 'action', 'x_ProjectCode', 'ProjectCode', '`ProjectCode`', '`ProjectCode`', 200, 23, -1, FALSE, '`ProjectCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProjectCode->Sortable = TRUE; // Allow sort
		$this->ProjectCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProjectCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProjectCode->Lookup = new Lookup('ProjectCode', 'project', FALSE, 'ProjectCode', ["ProjectName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProjectCode'] = &$this->ProjectCode;

		// ActionCode
		$this->ActionCode = new DbField('_action', 'action', 'x_ActionCode', 'ActionCode', '`ActionCode`', '`ActionCode`', 3, 11, -1, FALSE, '`ActionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ActionCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ActionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ActionCode->IsForeignKey = TRUE; // Foreign key field
		$this->ActionCode->Sortable = TRUE; // Allow sort
		$this->ActionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ActionCode'] = &$this->ActionCode;

		// ActionName
		$this->ActionName = new DbField('_action', 'action', 'x_ActionName', 'ActionName', '`ActionName`', '`ActionName`', 200, 255, -1, FALSE, '`ActionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActionName->Nullable = FALSE; // NOT NULL field
		$this->ActionName->Required = TRUE; // Required field
		$this->ActionName->Sortable = TRUE; // Allow sort
		$this->fields['ActionName'] = &$this->ActionName;

		// ActionType
		$this->ActionType = new DbField('_action', 'action', 'x_ActionType', 'ActionType', '`ActionType`', '`ActionType`', 200, 20, -1, FALSE, '`ActionType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ActionType->Nullable = FALSE; // NOT NULL field
		$this->ActionType->Required = TRUE; // Required field
		$this->ActionType->Sortable = TRUE; // Allow sort
		$this->ActionType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ActionType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ActionType->Lookup = new Lookup('ActionType', 'action_type', FALSE, 'ActionType', ["ActionType","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ActionType'] = &$this->ActionType;

		// FinancialYear
		$this->FinancialYear = new DbField('_action', 'action', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->IsPrimaryKey = TRUE; // Primary key field
		$this->FinancialYear->IsForeignKey = TRUE; // Foreign key field
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// MTEFBudget
		$this->MTEFBudget = new DbField('_action', 'action', 'x_MTEFBudget', 'MTEFBudget', '`MTEFBudget`', '`MTEFBudget`', 5, 22, -1, FALSE, '`MTEFBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MTEFBudget->Sortable = TRUE; // Allow sort
		$this->MTEFBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['MTEFBudget'] = &$this->MTEFBudget;

		// SupplementaryBudget
		$this->SupplementaryBudget = new DbField('_action', 'action', 'x_SupplementaryBudget', 'SupplementaryBudget', '`SupplementaryBudget`', '`SupplementaryBudget`', 5, 22, -1, FALSE, '`SupplementaryBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplementaryBudget->Sortable = TRUE; // Allow sort
		$this->SupplementaryBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SupplementaryBudget'] = &$this->SupplementaryBudget;

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement = new DbField('_action', 'action', 'x_ExpectedAnnualAchievement', 'ExpectedAnnualAchievement', '`ExpectedAnnualAchievement`', '`ExpectedAnnualAchievement`', 200, 255, -1, FALSE, '`ExpectedAnnualAchievement`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExpectedAnnualAchievement->Sortable = TRUE; // Allow sort
		$this->fields['ExpectedAnnualAchievement'] = &$this->ExpectedAnnualAchievement;

		// ActionLocation
		$this->ActionLocation = new DbField('_action', 'action', 'x_ActionLocation', 'ActionLocation', '`ActionLocation`', '`ActionLocation`', 200, 255, -1, FALSE, '`ActionLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActionLocation->Sortable = TRUE; // Allow sort
		$this->fields['ActionLocation'] = &$this->ActionLocation;

		// Latitude
		$this->Latitude = new DbField('_action', 'action', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 10, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// Longitude
		$this->Longitude = new DbField('_action', 'action', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 10, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// LACode
		$this->LACode = new DbField('_action', 'action', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_DepartmentCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('_action', 'action', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('_action', 'action', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->Nullable = FALSE; // NOT NULL field
		$this->SectionCode->Required = TRUE; // Required field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;
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
		if ($this->getCurrentMasterTable() == "output") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$masterFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OucomeCode->getSessionValue() != "")
				$masterFilter .= " AND `OutcomeCode`=" . QuotedValue($this->OucomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$masterFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutputCode->getSessionValue() != "")
				$masterFilter .= " AND `OutputCode`=" . QuotedValue($this->OutputCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$masterFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "output") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$detailFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OucomeCode->getSessionValue() != "")
				$detailFilter .= " AND `OucomeCode`=" . QuotedValue($this->OucomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$detailFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutputCode->getSessionValue() != "")
				$detailFilter .= " AND `OutputCode`=" . QuotedValue($this->OutputCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$detailFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_output()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `OutcomeCode`=@OutcomeCode@ AND `ProgramCode`=@ProgramCode@ AND `OutputCode`=@OutputCode@ AND `FinancialYear`=@FinancialYear@";
	}

	// Detail filter
	public function sqlDetailFilter_output()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `OucomeCode`=@OucomeCode@ AND `ProgramCode`=@ProgramCode@ AND `OutputCode`=@OutputCode@ AND `FinancialYear`=@FinancialYear@";
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
		if ($this->getCurrentDetailTable() == "detailed_action") {
			$detailUrl = $GLOBALS["detailed_action"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$detailUrl .= "&fk_OucomeCode=" . urlencode($this->OucomeCode->CurrentValue);
			$detailUrl .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$detailUrl .= "&fk_ActionCode=" . urlencode($this->ActionCode->CurrentValue);
			$detailUrl .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "_actionlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`action`";
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
			$this->ActionCode->setDbValue($conn->insert_ID());
			$rs['ActionCode'] = $this->ActionCode->DbValue;
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
			if (array_key_exists('ActionCode', $rs))
				AddFilter($where, QuotedName('ActionCode', $this->Dbid) . '=' . QuotedValue($rs['ActionCode'], $this->ActionCode->DataType, $this->Dbid));
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ProgramCode->DbValue = $row['ProgramCode'];
		$this->OucomeCode->DbValue = $row['OucomeCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->ProjectCode->DbValue = $row['ProjectCode'];
		$this->ActionCode->DbValue = $row['ActionCode'];
		$this->ActionName->DbValue = $row['ActionName'];
		$this->ActionType->DbValue = $row['ActionType'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->MTEFBudget->DbValue = $row['MTEFBudget'];
		$this->SupplementaryBudget->DbValue = $row['SupplementaryBudget'];
		$this->ExpectedAnnualAchievement->DbValue = $row['ExpectedAnnualAchievement'];
		$this->ActionLocation->DbValue = $row['ActionLocation'];
		$this->Latitude->DbValue = $row['Latitude'];
		$this->Longitude->DbValue = $row['Longitude'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ActionCode` = @ActionCode@ AND `FinancialYear` = @FinancialYear@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ActionCode', $row) ? $row['ActionCode'] : NULL;
		else
			$val = $this->ActionCode->OldValue !== NULL ? $this->ActionCode->OldValue : $this->ActionCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ActionCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "_actionlist.php";
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
		if ($pageName == "_actionview.php")
			return $Language->phrase("View");
		elseif ($pageName == "_actionedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "_actionadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "_actionlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_actionview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_actionview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "_actionadd.php?" . $this->getUrlParm($parm);
		else
			$url = "_actionadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_actionedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_actionedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("_actionadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_actionadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("_actiondelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "output" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$url .= "&fk_OutcomeCode=" . urlencode($this->OucomeCode->CurrentValue);
			$url .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$url .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$url .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ActionCode:" . JsonEncode($this->ActionCode->CurrentValue, "number");
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
		if ($this->ActionCode->CurrentValue != NULL) {
			$url .= "ActionCode=" . urlencode($this->ActionCode->CurrentValue);
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
			if (Param("ActionCode") !== NULL)
				$arKey[] = Param("ActionCode");
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
				if (!is_numeric($key[0])) // ActionCode
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
				$this->ActionCode->CurrentValue = $key[0];
			else
				$this->ActionCode->OldValue = $key[0];
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
		$this->ProgramCode->setDbValue($rs->fields('ProgramCode'));
		$this->OucomeCode->setDbValue($rs->fields('OucomeCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->ProjectCode->setDbValue($rs->fields('ProjectCode'));
		$this->ActionCode->setDbValue($rs->fields('ActionCode'));
		$this->ActionName->setDbValue($rs->fields('ActionName'));
		$this->ActionType->setDbValue($rs->fields('ActionType'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->MTEFBudget->setDbValue($rs->fields('MTEFBudget'));
		$this->SupplementaryBudget->setDbValue($rs->fields('SupplementaryBudget'));
		$this->ExpectedAnnualAchievement->setDbValue($rs->fields('ExpectedAnnualAchievement'));
		$this->ActionLocation->setDbValue($rs->fields('ActionLocation'));
		$this->Latitude->setDbValue($rs->fields('Latitude'));
		$this->Longitude->setDbValue($rs->fields('Longitude'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ProgramCode
		// OucomeCode
		// OutputCode
		// ProjectCode
		// ActionCode
		// ActionName
		// ActionType
		// FinancialYear
		// MTEFBudget
		// SupplementaryBudget
		// ExpectedAnnualAchievement
		// ActionLocation
		// Latitude
		// Longitude
		// LACode
		// DepartmentCode
		// SectionCode
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

		// OucomeCode
		$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
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

		// ProjectCode
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

		// ActionCode
		$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
		$this->ActionCode->ViewCustomAttributes = "";

		// ActionName
		$this->ActionName->ViewValue = $this->ActionName->CurrentValue;
		$this->ActionName->ViewCustomAttributes = "";

		// ActionType
		$curVal = strval($this->ActionType->CurrentValue);
		if ($curVal != "") {
			$this->ActionType->ViewValue = $this->ActionType->lookupCacheOption($curVal);
			if ($this->ActionType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ActionType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ActionType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ActionType->ViewValue = $this->ActionType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ActionType->ViewValue = $this->ActionType->CurrentValue;
				}
			}
		} else {
			$this->ActionType->ViewValue = NULL;
		}
		$this->ActionType->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewCustomAttributes = "";

		// MTEFBudget
		$this->MTEFBudget->ViewValue = $this->MTEFBudget->CurrentValue;
		$this->MTEFBudget->ViewValue = FormatNumber($this->MTEFBudget->ViewValue, 2, -2, -2, -2);
		$this->MTEFBudget->ViewCustomAttributes = "";

		// SupplementaryBudget
		$this->SupplementaryBudget->ViewValue = $this->SupplementaryBudget->CurrentValue;
		$this->SupplementaryBudget->ViewValue = FormatNumber($this->SupplementaryBudget->ViewValue, 2, -2, -2, -2);
		$this->SupplementaryBudget->ViewCustomAttributes = "";

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->ViewValue = $this->ExpectedAnnualAchievement->CurrentValue;
		$this->ExpectedAnnualAchievement->ViewCustomAttributes = "";

		// ActionLocation
		$this->ActionLocation->ViewValue = $this->ActionLocation->CurrentValue;
		$this->ActionLocation->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, 2, -2, -2, -2);
		$this->Latitude->ViewCustomAttributes = "";

		// Longitude
		$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, 2, -2, -2, -2);
		$this->Longitude->ViewCustomAttributes = "";

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

		// ProgramCode
		$this->ProgramCode->LinkCustomAttributes = "";
		$this->ProgramCode->HrefValue = "";
		$this->ProgramCode->TooltipValue = "";

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

		// ActionCode
		$this->ActionCode->LinkCustomAttributes = "";
		$this->ActionCode->HrefValue = "";
		$this->ActionCode->TooltipValue = "";

		// ActionName
		$this->ActionName->LinkCustomAttributes = "";
		$this->ActionName->HrefValue = "";
		$this->ActionName->TooltipValue = "";

		// ActionType
		$this->ActionType->LinkCustomAttributes = "";
		$this->ActionType->HrefValue = "";
		$this->ActionType->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

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

		// ActionLocation
		$this->ActionLocation->LinkCustomAttributes = "";
		$this->ActionLocation->HrefValue = "";
		$this->ActionLocation->TooltipValue = "";

		// Latitude
		$this->Latitude->LinkCustomAttributes = "";
		$this->Latitude->HrefValue = "";
		$this->Latitude->TooltipValue = "";

		// Longitude
		$this->Longitude->LinkCustomAttributes = "";
		$this->Longitude->HrefValue = "";
		$this->Longitude->TooltipValue = "";

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

		// ProgramCode
		$this->ProgramCode->EditAttrs["class"] = "form-control";
		$this->ProgramCode->EditCustomAttributes = "";
		if ($this->ProgramCode->getSessionValue() != "") {
			$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
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
		} else {
			$this->ProgramCode->EditValue = $this->ProgramCode->CurrentValue;
			$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());
		}

		// OucomeCode
		$this->OucomeCode->EditAttrs["class"] = "form-control";
		$this->OucomeCode->EditCustomAttributes = "";
		if ($this->OucomeCode->getSessionValue() != "") {
			$this->OucomeCode->CurrentValue = $this->OucomeCode->getSessionValue();
			$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
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
		} else {
			$this->OucomeCode->EditValue = $this->OucomeCode->CurrentValue;
			$this->OucomeCode->PlaceHolder = RemoveHtml($this->OucomeCode->caption());
		}

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";
		if ($this->OutputCode->getSessionValue() != "") {
			$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
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
		} else {
			$this->OutputCode->EditValue = $this->OutputCode->CurrentValue;
			$this->OutputCode->PlaceHolder = RemoveHtml($this->OutputCode->caption());
		}

		// ProjectCode
		$this->ProjectCode->EditAttrs["class"] = "form-control";
		$this->ProjectCode->EditCustomAttributes = "";

		// ActionCode
		$this->ActionCode->EditAttrs["class"] = "form-control";
		$this->ActionCode->EditCustomAttributes = "";
		$this->ActionCode->EditValue = $this->ActionCode->CurrentValue;
		$this->ActionCode->ViewCustomAttributes = "";

		// ActionName
		$this->ActionName->EditAttrs["class"] = "form-control";
		$this->ActionName->EditCustomAttributes = "";
		if (!$this->ActionName->Raw)
			$this->ActionName->CurrentValue = HtmlDecode($this->ActionName->CurrentValue);
		$this->ActionName->EditValue = $this->ActionName->CurrentValue;
		$this->ActionName->PlaceHolder = RemoveHtml($this->ActionName->caption());

		// ActionType
		$this->ActionType->EditAttrs["class"] = "form-control";
		$this->ActionType->EditCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

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

		// ActionLocation
		$this->ActionLocation->EditAttrs["class"] = "form-control";
		$this->ActionLocation->EditCustomAttributes = "";
		if (!$this->ActionLocation->Raw)
			$this->ActionLocation->CurrentValue = HtmlDecode($this->ActionLocation->CurrentValue);
		$this->ActionLocation->EditValue = $this->ActionLocation->CurrentValue;
		$this->ActionLocation->PlaceHolder = RemoveHtml($this->ActionLocation->caption());

		// Latitude
		$this->Latitude->EditAttrs["class"] = "form-control";
		$this->Latitude->EditCustomAttributes = "";
		$this->Latitude->EditValue = $this->Latitude->CurrentValue;
		$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
		if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
			$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -2, -2, -2);
		

		// Longitude
		$this->Longitude->EditAttrs["class"] = "form-control";
		$this->Longitude->EditCustomAttributes = "";
		$this->Longitude->EditValue = $this->Longitude->CurrentValue;
		$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
		if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
			$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->OucomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->ActionName);
					$doc->exportCaption($this->ActionType);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->ExpectedAnnualAchievement);
					$doc->exportCaption($this->ActionLocation);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
				} else {
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->OucomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->ActionName);
					$doc->exportCaption($this->ActionType);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->MTEFBudget);
					$doc->exportCaption($this->SupplementaryBudget);
					$doc->exportCaption($this->ExpectedAnnualAchievement);
					$doc->exportCaption($this->ActionLocation);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
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
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->OucomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->ActionName);
						$doc->exportField($this->ActionType);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->ExpectedAnnualAchievement);
						$doc->exportField($this->ActionLocation);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
					} else {
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->OucomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->ActionName);
						$doc->exportField($this->ActionType);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->MTEFBudget);
						$doc->exportField($this->SupplementaryBudget);
						$doc->exportField($this->ExpectedAnnualAchievement);
						$doc->exportField($this->ActionLocation);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
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