<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for output
 */
class output extends DbTable
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
	public $DepartmentCode;
	public $SectionCode;
	public $OutcomeCode;
	public $ProgramCode;
	public $SubProgramCode;
	public $OutputCode;
	public $OutputType;
	public $OutputName;
	public $DeliveryDate;
	public $FinancialYear;
	public $OutputDescription;
	public $OutputMeansOfVerification;
	public $ResponsibleOfficer;
	public $Clients;
	public $Beneficiaries;
	public $OutputStatus;
	public $LockStatus;
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
		$this->TableVar = 'output';
		$this->TableName = 'output';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`output`";
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

		// LACode
		$this->LACode = new DbField('output', 'output', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_DepartmentCode","x_OutputCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('output', 'output', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode","x_OutcomeCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('output', 'output', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// OutcomeCode
		$this->OutcomeCode = new DbField('output', 'output', 'x_OutcomeCode', 'OutcomeCode', '`OutcomeCode`', '`OutcomeCode`', 3, 11, -1, FALSE, '`OutcomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutcomeCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutcomeCode->Nullable = FALSE; // NOT NULL field
		$this->OutcomeCode->Required = TRUE; // Required field
		$this->OutcomeCode->Sortable = TRUE; // Allow sort
		$this->OutcomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutcomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutcomeCode->Lookup = new Lookup('OutcomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], ["x_DepartmentCode"], ["x_OutputCode"], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->OutcomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutcomeCode'] = &$this->OutcomeCode;

		// ProgramCode
		$this->ProgramCode = new DbField('output', 'output', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProgramCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->Lookup = new Lookup('ProgramCode', 'la_program', FALSE, 'ProgramCode', ["ProgramName","","",""], [], ["x_SubProgramCode"], [], [], [], [], '', '');
		$this->ProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// SubProgramCode
		$this->SubProgramCode = new DbField('output', 'output', 'x_SubProgramCode', 'SubProgramCode', '`SubProgramCode`', '`SubProgramCode`', 3, 11, -1, FALSE, '`SubProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SubProgramCode->Sortable = TRUE; // Allow sort
		$this->SubProgramCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SubProgramCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SubProgramCode->Lookup = new Lookup('SubProgramCode', 'la_sub_program', FALSE, 'SubProgramCode', ["SubProgramName","","",""], ["x_ProgramCode"], [], ["ProgramCode"], ["x_ProgramCode"], [], [], '', '');
		$this->SubProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubProgramCode'] = &$this->SubProgramCode;

		// OutputCode
		$this->OutputCode = new DbField('output', 'output', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutputCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->OutputCode->IsPrimaryKey = TRUE; // Primary key field
		$this->OutputCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutputCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutputCode->Lookup = new Lookup('OutputCode', 'output', FALSE, 'OutputCode', ["OutputName","","",""], ["x_LACode","x_OutcomeCode"], [], ["OutcomeCode","OutcomeCode"], ["x_OutcomeCode","x_OutcomeCode"], [], [], '', '');
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// OutputType
		$this->OutputType = new DbField('output', 'output', 'x_OutputType', 'OutputType', '`OutputType`', '`OutputType`', 200, 15, -1, FALSE, '`OutputType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutputType->Sortable = TRUE; // Allow sort
		$this->OutputType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutputType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutputType->Lookup = new Lookup('OutputType', 'output_type', FALSE, 'OutputType', ["OutputType","","",""], [], [], [], [], [], [], '', '');
		$this->fields['OutputType'] = &$this->OutputType;

		// OutputName
		$this->OutputName = new DbField('output', 'output', 'x_OutputName', 'OutputName', '`OutputName`', '`OutputName`', 200, 255, -1, FALSE, '`OutputName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutputName->Nullable = FALSE; // NOT NULL field
		$this->OutputName->Required = TRUE; // Required field
		$this->OutputName->Sortable = TRUE; // Allow sort
		$this->fields['OutputName'] = &$this->OutputName;

		// DeliveryDate
		$this->DeliveryDate = new DbField('output', 'output', 'x_DeliveryDate', 'DeliveryDate', '`DeliveryDate`', CastDateFieldForLike("`DeliveryDate`", 0, "DB"), 133, 10, 0, FALSE, '`DeliveryDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeliveryDate->Sortable = TRUE; // Allow sort
		$this->DeliveryDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DeliveryDate'] = &$this->DeliveryDate;

		// FinancialYear
		$this->FinancialYear = new DbField('output', 'output', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->IsForeignKey = TRUE; // Foreign key field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// OutputDescription
		$this->OutputDescription = new DbField('output', 'output', 'x_OutputDescription', 'OutputDescription', '`OutputDescription`', '`OutputDescription`', 200, 255, -1, FALSE, '`OutputDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutputDescription->Sortable = TRUE; // Allow sort
		$this->fields['OutputDescription'] = &$this->OutputDescription;

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification = new DbField('output', 'output', 'x_OutputMeansOfVerification', 'OutputMeansOfVerification', '`OutputMeansOfVerification`', '`OutputMeansOfVerification`', 200, 255, -1, FALSE, '`OutputMeansOfVerification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutputMeansOfVerification->Sortable = TRUE; // Allow sort
		$this->fields['OutputMeansOfVerification'] = &$this->OutputMeansOfVerification;

		// ResponsibleOfficer
		$this->ResponsibleOfficer = new DbField('output', 'output', 'x_ResponsibleOfficer', 'ResponsibleOfficer', '`ResponsibleOfficer`', '`ResponsibleOfficer`', 200, 100, -1, FALSE, '`ResponsibleOfficer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ResponsibleOfficer->Sortable = TRUE; // Allow sort
		$this->fields['ResponsibleOfficer'] = &$this->ResponsibleOfficer;

		// Clients
		$this->Clients = new DbField('output', 'output', 'x_Clients', 'Clients', '`Clients`', '`Clients`', 200, 255, -1, FALSE, '`Clients`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Clients->Sortable = TRUE; // Allow sort
		$this->fields['Clients'] = &$this->Clients;

		// Beneficiaries
		$this->Beneficiaries = new DbField('output', 'output', 'x_Beneficiaries', 'Beneficiaries', '`Beneficiaries`', '`Beneficiaries`', 200, 255, -1, FALSE, '`Beneficiaries`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Beneficiaries->Sortable = TRUE; // Allow sort
		$this->fields['Beneficiaries'] = &$this->Beneficiaries;

		// OutputStatus
		$this->OutputStatus = new DbField('output', 'output', 'x_OutputStatus', 'OutputStatus', '`OutputStatus`', '`OutputStatus`', 3, 2, -1, FALSE, '`OutputStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutputStatus->Sortable = TRUE; // Allow sort
		$this->OutputStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutputStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutputStatus->Lookup = new Lookup('OutputStatus', 'progress_status', FALSE, 'ProgressCode', ["ProgressDescription","","",""], [], [], [], [], [], [], '', '');
		$this->fields['OutputStatus'] = &$this->OutputStatus;

		// LockStatus
		$this->LockStatus = new DbField('output', 'output', 'x_LockStatus', 'LockStatus', '`LockStatus`', '`LockStatus`', 3, 11, -1, FALSE, '`LockStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LockStatus->Sortable = TRUE; // Allow sort
		$this->LockStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LockStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LockStatus->Lookup = new Lookup('LockStatus', 'progress_status', FALSE, 'ProgressCode', ["ProgressDescription","","",""], [], [], [], [], [], [], '', '');
		$this->LockStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LockStatus'] = &$this->LockStatus;

		// TargetAmount
		$this->TargetAmount = new DbField('output', 'output', 'x_TargetAmount', 'TargetAmount', '`TargetAmount`', '`TargetAmount`', 5, 22, -1, FALSE, '`TargetAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TargetAmount->Sortable = TRUE; // Allow sort
		$this->TargetAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TargetAmount'] = &$this->TargetAmount;

		// ActualAmount
		$this->ActualAmount = new DbField('output', 'output', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// PercentAchieved
		$this->PercentAchieved = new DbField('output', 'output', 'x_PercentAchieved', 'PercentAchieved', '`PercentAchieved`', '`PercentAchieved`', 5, 22, -1, FALSE, '`PercentAchieved`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentMasterTable() == "outcome") {
			if ($this->OutcomeCode->getSessionValue() != "")
				$masterFilter .= "`OutcomeCode`=" . QuotedValue($this->OutcomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "outcome") {
			if ($this->OutcomeCode->getSessionValue() != "")
				$detailFilter .= "`OutcomeCode`=" . QuotedValue($this->OutcomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_outcome()
	{
		return "`OutcomeCode`=@OutcomeCode@ AND `LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@";
	}

	// Detail filter
	public function sqlDetailFilter_outcome()
	{
		return "`OutcomeCode`=@OutcomeCode@ AND `LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@";
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
		if ($this->getCurrentDetailTable() == "_action") {
			$detailUrl = $GLOBALS["_action"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$detailUrl .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$detailUrl .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$detailUrl .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "outputlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`output`";
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

		// Cascade Update detail table 'action'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['LACode']) && $rsold['LACode'] != $rs['LACode'])) { // Update detail field 'LACode'
			$cascadeUpdate = TRUE;
			$rscascade['LACode'] = $rs['LACode'];
		}
		if ($rsold && (isset($rs['DepartmentCode']) && $rsold['DepartmentCode'] != $rs['DepartmentCode'])) { // Update detail field 'DepartmentCode'
			$cascadeUpdate = TRUE;
			$rscascade['DepartmentCode'] = $rs['DepartmentCode'];
		}
		if ($rsold && (isset($rs['OutcomeCode']) && $rsold['OutcomeCode'] != $rs['OutcomeCode'])) { // Update detail field 'OucomeCode'
			$cascadeUpdate = TRUE;
			$rscascade['OucomeCode'] = $rs['OutcomeCode'];
		}
		if ($rsold && (isset($rs['ProgramCode']) && $rsold['ProgramCode'] != $rs['ProgramCode'])) { // Update detail field 'ProgramCode'
			$cascadeUpdate = TRUE;
			$rscascade['ProgramCode'] = $rs['ProgramCode'];
		}
		if ($rsold && (isset($rs['OutputCode']) && $rsold['OutputCode'] != $rs['OutputCode'])) { // Update detail field 'OutputCode'
			$cascadeUpdate = TRUE;
			$rscascade['OutputCode'] = $rs['OutputCode'];
		}
		if ($rsold && (isset($rs['FinancialYear']) && $rsold['FinancialYear'] != $rs['FinancialYear'])) { // Update detail field 'FinancialYear'
			$cascadeUpdate = TRUE;
			$rscascade['FinancialYear'] = $rs['FinancialYear'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["_action"]))
				$GLOBALS["_action"] = new _action();
			$rswrk = $GLOBALS["_action"]->loadRs("`LACode` = " . QuotedValue($rsold['LACode'], DATATYPE_STRING, 'DB') . " AND " . "`DepartmentCode` = " . QuotedValue($rsold['DepartmentCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`OucomeCode` = " . QuotedValue($rsold['OutcomeCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`ProgramCode` = " . QuotedValue($rsold['ProgramCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`OutputCode` = " . QuotedValue($rsold['OutputCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`FinancialYear` = " . QuotedValue($rsold['FinancialYear'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'ActionCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'FinancialYear';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["_action"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["_action"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["_action"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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

		// Cascade delete detail table 'action'
		if (!isset($GLOBALS["_action"]))
			$GLOBALS["_action"] = new _action();
		$rscascade = $GLOBALS["_action"]->loadRs("`LACode` = " . QuotedValue($rs['LACode'], DATATYPE_STRING, "DB") . " AND " . "`DepartmentCode` = " . QuotedValue($rs['DepartmentCode'], DATATYPE_NUMBER, "DB") . " AND " . "`OucomeCode` = " . QuotedValue($rs['OutcomeCode'], DATATYPE_NUMBER, "DB") . " AND " . "`ProgramCode` = " . QuotedValue($rs['ProgramCode'], DATATYPE_NUMBER, "DB") . " AND " . "`OutputCode` = " . QuotedValue($rs['OutputCode'], DATATYPE_NUMBER, "DB") . " AND " . "`FinancialYear` = " . QuotedValue($rs['FinancialYear'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["_action"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["_action"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["_action"]->Row_Deleted($dtlrow);
		}
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
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->OutcomeCode->DbValue = $row['OutcomeCode'];
		$this->ProgramCode->DbValue = $row['ProgramCode'];
		$this->SubProgramCode->DbValue = $row['SubProgramCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->OutputType->DbValue = $row['OutputType'];
		$this->OutputName->DbValue = $row['OutputName'];
		$this->DeliveryDate->DbValue = $row['DeliveryDate'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->OutputDescription->DbValue = $row['OutputDescription'];
		$this->OutputMeansOfVerification->DbValue = $row['OutputMeansOfVerification'];
		$this->ResponsibleOfficer->DbValue = $row['ResponsibleOfficer'];
		$this->Clients->DbValue = $row['Clients'];
		$this->Beneficiaries->DbValue = $row['Beneficiaries'];
		$this->OutputStatus->DbValue = $row['OutputStatus'];
		$this->LockStatus->DbValue = $row['LockStatus'];
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
			return "outputlist.php";
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
		if ($pageName == "outputview.php")
			return $Language->phrase("View");
		elseif ($pageName == "outputedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "outputadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "outputlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("outputview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outputview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "outputadd.php?" . $this->getUrlParm($parm);
		else
			$url = "outputadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("outputedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outputedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("outputadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outputadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("outputdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "outcome" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
		}
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
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->OutcomeCode->setDbValue($rs->fields('OutcomeCode'));
		$this->ProgramCode->setDbValue($rs->fields('ProgramCode'));
		$this->SubProgramCode->setDbValue($rs->fields('SubProgramCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->OutputType->setDbValue($rs->fields('OutputType'));
		$this->OutputName->setDbValue($rs->fields('OutputName'));
		$this->DeliveryDate->setDbValue($rs->fields('DeliveryDate'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->OutputDescription->setDbValue($rs->fields('OutputDescription'));
		$this->OutputMeansOfVerification->setDbValue($rs->fields('OutputMeansOfVerification'));
		$this->ResponsibleOfficer->setDbValue($rs->fields('ResponsibleOfficer'));
		$this->Clients->setDbValue($rs->fields('Clients'));
		$this->Beneficiaries->setDbValue($rs->fields('Beneficiaries'));
		$this->OutputStatus->setDbValue($rs->fields('OutputStatus'));
		$this->LockStatus->setDbValue($rs->fields('LockStatus'));
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
		// LACode
		// DepartmentCode
		// SectionCode
		// OutcomeCode
		// ProgramCode
		// SubProgramCode
		// OutputCode
		// OutputType
		// OutputName
		// DeliveryDate
		// FinancialYear
		// OutputDescription
		// OutputMeansOfVerification
		// ResponsibleOfficer
		// Clients
		// Beneficiaries
		// OutputStatus
		// LockStatus
		// TargetAmount
		// ActualAmount
		// PercentAchieved
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

		// OutcomeCode
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

		// OutputCode
		$arwrk = [];
		$arwrk[1] = $this->OutputName->CurrentValue;
		$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
		$this->OutputCode->ViewCustomAttributes = "";

		// OutputType
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

		// OutputName
		$this->OutputName->ViewValue = $this->OutputName->CurrentValue;
		$this->OutputName->ViewCustomAttributes = "";

		// DeliveryDate
		$this->DeliveryDate->ViewValue = $this->DeliveryDate->CurrentValue;
		$this->DeliveryDate->ViewValue = FormatDateTime($this->DeliveryDate->ViewValue, 0);
		$this->DeliveryDate->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewCustomAttributes = "";

		// OutputDescription
		$this->OutputDescription->ViewValue = $this->OutputDescription->CurrentValue;
		$this->OutputDescription->ViewCustomAttributes = "";

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification->ViewValue = $this->OutputMeansOfVerification->CurrentValue;
		$this->OutputMeansOfVerification->ViewCustomAttributes = "";

		// ResponsibleOfficer
		$this->ResponsibleOfficer->ViewValue = $this->ResponsibleOfficer->CurrentValue;
		$this->ResponsibleOfficer->ViewCustomAttributes = "";

		// Clients
		$this->Clients->ViewValue = $this->Clients->CurrentValue;
		$this->Clients->ViewCustomAttributes = "";

		// Beneficiaries
		$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
		$this->Beneficiaries->ViewCustomAttributes = "";

		// OutputStatus
		$curVal = strval($this->OutputStatus->CurrentValue);
		if ($curVal != "") {
			$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
			if ($this->OutputStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutputStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutputStatus->ViewValue = $this->OutputStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutputStatus->ViewValue = $this->OutputStatus->CurrentValue;
				}
			}
		} else {
			$this->OutputStatus->ViewValue = NULL;
		}
		$this->OutputStatus->ViewCustomAttributes = "";

		// LockStatus
		$curVal = strval($this->LockStatus->CurrentValue);
		if ($curVal != "") {
			$this->LockStatus->ViewValue = $this->LockStatus->lookupCacheOption($curVal);
			if ($this->LockStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->LockStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LockStatus->ViewValue = $this->LockStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LockStatus->ViewValue = $this->LockStatus->CurrentValue;
				}
			}
		} else {
			$this->LockStatus->ViewValue = NULL;
		}
		$this->LockStatus->ViewCustomAttributes = "";

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
		$this->PercentAchieved->ViewValue = FormatNumber($this->PercentAchieved->ViewValue, 2, -2, -2, -2);
		$this->PercentAchieved->ViewCustomAttributes = "";

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

		// OutcomeCode
		$this->OutcomeCode->LinkCustomAttributes = "";
		$this->OutcomeCode->HrefValue = "";
		$this->OutcomeCode->TooltipValue = "";

		// ProgramCode
		$this->ProgramCode->LinkCustomAttributes = "";
		$this->ProgramCode->HrefValue = "";
		$this->ProgramCode->TooltipValue = "";

		// SubProgramCode
		$this->SubProgramCode->LinkCustomAttributes = "";
		$this->SubProgramCode->HrefValue = "";
		$this->SubProgramCode->TooltipValue = "";

		// OutputCode
		$this->OutputCode->LinkCustomAttributes = "";
		$this->OutputCode->HrefValue = "";
		$this->OutputCode->TooltipValue = "";

		// OutputType
		$this->OutputType->LinkCustomAttributes = "";
		$this->OutputType->HrefValue = "";
		$this->OutputType->TooltipValue = "";

		// OutputName
		$this->OutputName->LinkCustomAttributes = "";
		$this->OutputName->HrefValue = "";
		$this->OutputName->TooltipValue = "";

		// DeliveryDate
		$this->DeliveryDate->LinkCustomAttributes = "";
		$this->DeliveryDate->HrefValue = "";
		$this->DeliveryDate->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// OutputDescription
		$this->OutputDescription->LinkCustomAttributes = "";
		$this->OutputDescription->HrefValue = "";
		$this->OutputDescription->TooltipValue = "";

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification->LinkCustomAttributes = "";
		$this->OutputMeansOfVerification->HrefValue = "";
		$this->OutputMeansOfVerification->TooltipValue = "";

		// ResponsibleOfficer
		$this->ResponsibleOfficer->LinkCustomAttributes = "";
		$this->ResponsibleOfficer->HrefValue = "";
		$this->ResponsibleOfficer->TooltipValue = "";

		// Clients
		$this->Clients->LinkCustomAttributes = "";
		$this->Clients->HrefValue = "";
		$this->Clients->TooltipValue = "";

		// Beneficiaries
		$this->Beneficiaries->LinkCustomAttributes = "";
		$this->Beneficiaries->HrefValue = "";
		$this->Beneficiaries->TooltipValue = "";

		// OutputStatus
		$this->OutputStatus->LinkCustomAttributes = "";
		$this->OutputStatus->HrefValue = "";
		$this->OutputStatus->TooltipValue = "";

		// LockStatus
		$this->LockStatus->LinkCustomAttributes = "";
		$this->LockStatus->HrefValue = "";
		$this->LockStatus->TooltipValue = "";

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

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if ($this->LACode->getSessionValue() != "") {
			$this->LACode->CurrentValue = $this->LACode->getSessionValue();
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
		} else {
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = $this->LACode->CurrentValue;
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
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

		// OutcomeCode
		$this->OutcomeCode->EditAttrs["class"] = "form-control";
		$this->OutcomeCode->EditCustomAttributes = "";
		if ($this->OutcomeCode->getSessionValue() != "") {
			$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
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
		} else {
		}

		// ProgramCode
		$this->ProgramCode->EditAttrs["class"] = "form-control";
		$this->ProgramCode->EditCustomAttributes = "";
		$this->ProgramCode->EditValue = $this->ProgramCode->CurrentValue;
		$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());

		// SubProgramCode
		$this->SubProgramCode->EditAttrs["class"] = "form-control";
		$this->SubProgramCode->EditCustomAttributes = "";

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";
		$arwrk = [];
		$arwrk[1] = $this->OutputName->CurrentValue;
		$this->OutputCode->EditValue = $this->OutputCode->displayValue($arwrk);
		$this->OutputCode->ViewCustomAttributes = "";

		// OutputType
		$this->OutputType->EditAttrs["class"] = "form-control";
		$this->OutputType->EditCustomAttributes = "";

		// OutputName
		$this->OutputName->EditAttrs["class"] = "form-control";
		$this->OutputName->EditCustomAttributes = "";
		$this->OutputName->EditValue = $this->OutputName->CurrentValue;
		$this->OutputName->PlaceHolder = RemoveHtml($this->OutputName->caption());

		// DeliveryDate
		$this->DeliveryDate->EditAttrs["class"] = "form-control";
		$this->DeliveryDate->EditCustomAttributes = "";
		$this->DeliveryDate->EditValue = FormatDateTime($this->DeliveryDate->CurrentValue, 8);
		$this->DeliveryDate->PlaceHolder = RemoveHtml($this->DeliveryDate->caption());

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

		// OutputDescription
		$this->OutputDescription->EditAttrs["class"] = "form-control";
		$this->OutputDescription->EditCustomAttributes = "";
		$this->OutputDescription->EditValue = $this->OutputDescription->CurrentValue;
		$this->OutputDescription->PlaceHolder = RemoveHtml($this->OutputDescription->caption());

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification->EditAttrs["class"] = "form-control";
		$this->OutputMeansOfVerification->EditCustomAttributes = "";
		$this->OutputMeansOfVerification->EditValue = $this->OutputMeansOfVerification->CurrentValue;
		$this->OutputMeansOfVerification->PlaceHolder = RemoveHtml($this->OutputMeansOfVerification->caption());

		// ResponsibleOfficer
		$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
		$this->ResponsibleOfficer->EditCustomAttributes = "";
		if (!$this->ResponsibleOfficer->Raw)
			$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
		$this->ResponsibleOfficer->EditValue = $this->ResponsibleOfficer->CurrentValue;
		$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

		// Clients
		$this->Clients->EditAttrs["class"] = "form-control";
		$this->Clients->EditCustomAttributes = "";
		$this->Clients->EditValue = $this->Clients->CurrentValue;
		$this->Clients->PlaceHolder = RemoveHtml($this->Clients->caption());

		// Beneficiaries
		$this->Beneficiaries->EditAttrs["class"] = "form-control";
		$this->Beneficiaries->EditCustomAttributes = "";
		$this->Beneficiaries->EditValue = $this->Beneficiaries->CurrentValue;
		$this->Beneficiaries->PlaceHolder = RemoveHtml($this->Beneficiaries->caption());

		// OutputStatus
		$this->OutputStatus->EditAttrs["class"] = "form-control";
		$this->OutputStatus->EditCustomAttributes = "";

		// LockStatus
		$this->LockStatus->EditAttrs["class"] = "form-control";
		$this->LockStatus->EditCustomAttributes = "";

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
			$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutputType);
					$doc->exportCaption($this->OutputName);
					$doc->exportCaption($this->DeliveryDate);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->OutputDescription);
					$doc->exportCaption($this->OutputMeansOfVerification);
					$doc->exportCaption($this->ResponsibleOfficer);
					$doc->exportCaption($this->Clients);
					$doc->exportCaption($this->Beneficiaries);
					$doc->exportCaption($this->OutputStatus);
					$doc->exportCaption($this->TargetAmount);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->PercentAchieved);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->OutputType);
					$doc->exportCaption($this->OutputName);
					$doc->exportCaption($this->DeliveryDate);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->OutputDescription);
					$doc->exportCaption($this->OutputMeansOfVerification);
					$doc->exportCaption($this->ResponsibleOfficer);
					$doc->exportCaption($this->Clients);
					$doc->exportCaption($this->Beneficiaries);
					$doc->exportCaption($this->OutputStatus);
					$doc->exportCaption($this->LockStatus);
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
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutputType);
						$doc->exportField($this->OutputName);
						$doc->exportField($this->DeliveryDate);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->OutputDescription);
						$doc->exportField($this->OutputMeansOfVerification);
						$doc->exportField($this->ResponsibleOfficer);
						$doc->exportField($this->Clients);
						$doc->exportField($this->Beneficiaries);
						$doc->exportField($this->OutputStatus);
						$doc->exportField($this->TargetAmount);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->PercentAchieved);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->OutputType);
						$doc->exportField($this->OutputName);
						$doc->exportField($this->DeliveryDate);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->OutputDescription);
						$doc->exportField($this->OutputMeansOfVerification);
						$doc->exportField($this->ResponsibleOfficer);
						$doc->exportField($this->Clients);
						$doc->exportField($this->Beneficiaries);
						$doc->exportField($this->OutputStatus);
						$doc->exportField($this->LockStatus);
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