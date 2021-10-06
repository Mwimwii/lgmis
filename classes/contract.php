<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for contract
 */
class contract extends DbTable
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
	public $ProjectCode;
	public $ContractNo;
	public $ContractName;
	public $ContractType;
	public $ContractSum;
	public $RevisedContractSum;
	public $ContractorRef;
	public $SigningDate;
	public $PlannedStartDate;
	public $PlannedEndDate;
	public $ActualStartDate;
	public $ActualEndDate;
	public $Duration;
	public $UnitOfMeasure;
	public $AdvancePaymentAmount;
	public $AdvancePaymentdate;
	public $ContractStatus;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'contract';
		$this->TableName = 'contract';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`contract`";
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
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// LACode
		$this->LACode = new DbField('contract', 'contract', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_DepartmentCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('contract', 'contract', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('contract', 'contract', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// ProjectCode
		$this->ProjectCode = new DbField('contract', 'contract', 'x_ProjectCode', 'ProjectCode', '`ProjectCode`', '`ProjectCode`', 200, 23, -1, FALSE, '`ProjectCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProjectCode->Sortable = TRUE; // Allow sort
		$this->ProjectCode->Lookup = new Lookup('ProjectCode', 'project', FALSE, 'ProjectCode', ["ProjectName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProjectCode'] = &$this->ProjectCode;

		// ContractNo
		$this->ContractNo = new DbField('contract', 'contract', 'x_ContractNo', 'ContractNo', '`ContractNo`', '`ContractNo`', 200, 25, -1, FALSE, '`ContractNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ContractNo->IsForeignKey = TRUE; // Foreign key field
		$this->ContractNo->Nullable = FALSE; // NOT NULL field
		$this->ContractNo->Required = TRUE; // Required field
		$this->ContractNo->Sortable = TRUE; // Allow sort
		$this->fields['ContractNo'] = &$this->ContractNo;

		// ContractName
		$this->ContractName = new DbField('contract', 'contract', 'x_ContractName', 'ContractName', '`ContractName`', '`ContractName`', 200, 255, -1, FALSE, '`ContractName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractName->Nullable = FALSE; // NOT NULL field
		$this->ContractName->Required = TRUE; // Required field
		$this->ContractName->Sortable = TRUE; // Allow sort
		$this->fields['ContractName'] = &$this->ContractName;

		// ContractType
		$this->ContractType = new DbField('contract', 'contract', 'x_ContractType', 'ContractType', '`ContractType`', '`ContractType`', 16, 3, -1, FALSE, '`ContractType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ContractType->Sortable = TRUE; // Allow sort
		$this->ContractType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ContractType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ContractType->Lookup = new Lookup('ContractType', 'contract_type', FALSE, 'ContractType', ["ContractTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ContractType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractType'] = &$this->ContractType;

		// ContractSum
		$this->ContractSum = new DbField('contract', 'contract', 'x_ContractSum', 'ContractSum', '`ContractSum`', '`ContractSum`', 5, 22, -1, FALSE, '`ContractSum`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractSum->Nullable = FALSE; // NOT NULL field
		$this->ContractSum->Required = TRUE; // Required field
		$this->ContractSum->Sortable = TRUE; // Allow sort
		$this->ContractSum->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ContractSum'] = &$this->ContractSum;

		// RevisedContractSum
		$this->RevisedContractSum = new DbField('contract', 'contract', 'x_RevisedContractSum', 'RevisedContractSum', '`RevisedContractSum`', '`RevisedContractSum`', 5, 22, -1, FALSE, '`RevisedContractSum`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RevisedContractSum->Nullable = FALSE; // NOT NULL field
		$this->RevisedContractSum->Required = TRUE; // Required field
		$this->RevisedContractSum->Sortable = TRUE; // Allow sort
		$this->RevisedContractSum->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RevisedContractSum'] = &$this->RevisedContractSum;

		// ContractorRef
		$this->ContractorRef = new DbField('contract', 'contract', 'x_ContractorRef', 'ContractorRef', '`ContractorRef`', '`ContractorRef`', 3, 11, -1, FALSE, '`ContractorRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ContractorRef->Nullable = FALSE; // NOT NULL field
		$this->ContractorRef->Required = TRUE; // Required field
		$this->ContractorRef->Sortable = TRUE; // Allow sort
		$this->ContractorRef->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ContractorRef->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ContractorRef->Lookup = new Lookup('ContractorRef', 'contractor', FALSE, 'ContractorRef', ["ContractorName","","",""], [], [], [], [], [], [], '', '');
		$this->ContractorRef->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractorRef'] = &$this->ContractorRef;

		// SigningDate
		$this->SigningDate = new DbField('contract', 'contract', 'x_SigningDate', 'SigningDate', '`SigningDate`', CastDateFieldForLike("`SigningDate`", 0, "DB"), 133, 10, 0, FALSE, '`SigningDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SigningDate->Sortable = TRUE; // Allow sort
		$this->SigningDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['SigningDate'] = &$this->SigningDate;

		// PlannedStartDate
		$this->PlannedStartDate = new DbField('contract', 'contract', 'x_PlannedStartDate', 'PlannedStartDate', '`PlannedStartDate`', CastDateFieldForLike("`PlannedStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedStartDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedStartDate->Required = TRUE; // Required field
		$this->PlannedStartDate->Sortable = TRUE; // Allow sort
		$this->PlannedStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedStartDate'] = &$this->PlannedStartDate;

		// PlannedEndDate
		$this->PlannedEndDate = new DbField('contract', 'contract', 'x_PlannedEndDate', 'PlannedEndDate', '`PlannedEndDate`', CastDateFieldForLike("`PlannedEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedEndDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedEndDate->Required = TRUE; // Required field
		$this->PlannedEndDate->Sortable = TRUE; // Allow sort
		$this->PlannedEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedEndDate'] = &$this->PlannedEndDate;

		// ActualStartDate
		$this->ActualStartDate = new DbField('contract', 'contract', 'x_ActualStartDate', 'ActualStartDate', '`ActualStartDate`', CastDateFieldForLike("`ActualStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualStartDate->Sortable = TRUE; // Allow sort
		$this->ActualStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualStartDate'] = &$this->ActualStartDate;

		// ActualEndDate
		$this->ActualEndDate = new DbField('contract', 'contract', 'x_ActualEndDate', 'ActualEndDate', '`ActualEndDate`', CastDateFieldForLike("`ActualEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualEndDate->Sortable = TRUE; // Allow sort
		$this->ActualEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualEndDate'] = &$this->ActualEndDate;

		// Duration
		$this->Duration = new DbField('contract', 'contract', 'x_Duration', 'Duration', '`Duration`', '`Duration`', 5, 22, -1, FALSE, '`Duration`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Duration->Sortable = TRUE; // Allow sort
		$this->Duration->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Duration'] = &$this->Duration;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('contract', 'contract', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 20, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->UnitOfMeasure->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UnitOfMeasure->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->UnitOfMeasure->Lookup = new Lookup('UnitOfMeasure', 'time_measure', FALSE, 'Unit_of_measure', ["Unit_of_measure","","",""], [], [], [], [], [], [], '', '');
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// AdvancePaymentAmount
		$this->AdvancePaymentAmount = new DbField('contract', 'contract', 'x_AdvancePaymentAmount', 'AdvancePaymentAmount', '`AdvancePaymentAmount`', '`AdvancePaymentAmount`', 5, 22, -1, FALSE, '`AdvancePaymentAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AdvancePaymentAmount->Sortable = TRUE; // Allow sort
		$this->AdvancePaymentAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AdvancePaymentAmount'] = &$this->AdvancePaymentAmount;

		// AdvancePaymentdate
		$this->AdvancePaymentdate = new DbField('contract', 'contract', 'x_AdvancePaymentdate', 'AdvancePaymentdate', '`AdvancePaymentdate`', CastDateFieldForLike("`AdvancePaymentdate`", 0, "DB"), 133, 10, 0, FALSE, '`AdvancePaymentdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AdvancePaymentdate->Sortable = TRUE; // Allow sort
		$this->AdvancePaymentdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['AdvancePaymentdate'] = &$this->AdvancePaymentdate;

		// ContractStatus
		$this->ContractStatus = new DbField('contract', 'contract', 'x_ContractStatus', 'ContractStatus', '`ContractStatus`', '`ContractStatus`', 16, 3, -1, FALSE, '`ContractStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ContractStatus->Sortable = TRUE; // Allow sort
		$this->ContractStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ContractStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ContractStatus->Lookup = new Lookup('ContractStatus', 'contract_status', FALSE, 'ContractStatus', ["ContractStatusDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ContractStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractStatus'] = &$this->ContractStatus;
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
		if ($this->getCurrentDetailTable() == "contract_variation") {
			$detailUrl = $GLOBALS["contract_variation"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ContractNo=" . urlencode($this->ContractNo->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "ipc_tracking") {
			$detailUrl = $GLOBALS["ipc_tracking"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ContractNo=" . urlencode($this->ContractNo->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "contractlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`contract`";
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
			if (array_key_exists('ContractNo', $rs))
				AddFilter($where, QuotedName('ContractNo', $this->Dbid) . '=' . QuotedValue($rs['ContractNo'], $this->ContractNo->DataType, $this->Dbid));
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
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->ProjectCode->DbValue = $row['ProjectCode'];
		$this->ContractNo->DbValue = $row['ContractNo'];
		$this->ContractName->DbValue = $row['ContractName'];
		$this->ContractType->DbValue = $row['ContractType'];
		$this->ContractSum->DbValue = $row['ContractSum'];
		$this->RevisedContractSum->DbValue = $row['RevisedContractSum'];
		$this->ContractorRef->DbValue = $row['ContractorRef'];
		$this->SigningDate->DbValue = $row['SigningDate'];
		$this->PlannedStartDate->DbValue = $row['PlannedStartDate'];
		$this->PlannedEndDate->DbValue = $row['PlannedEndDate'];
		$this->ActualStartDate->DbValue = $row['ActualStartDate'];
		$this->ActualEndDate->DbValue = $row['ActualEndDate'];
		$this->Duration->DbValue = $row['Duration'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->AdvancePaymentAmount->DbValue = $row['AdvancePaymentAmount'];
		$this->AdvancePaymentdate->DbValue = $row['AdvancePaymentdate'];
		$this->ContractStatus->DbValue = $row['ContractStatus'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ContractNo` = '@ContractNo@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ContractNo', $row) ? $row['ContractNo'] : NULL;
		else
			$val = $this->ContractNo->OldValue !== NULL ? $this->ContractNo->OldValue : $this->ContractNo->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ContractNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "contractlist.php";
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
		if ($pageName == "contractview.php")
			return $Language->phrase("View");
		elseif ($pageName == "contractedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "contractadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "contractlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("contractview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("contractview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "contractadd.php?" . $this->getUrlParm($parm);
		else
			$url = "contractadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("contractedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("contractedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("contractadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("contractadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("contractdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ContractNo:" . JsonEncode($this->ContractNo->CurrentValue, "string");
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
		if ($this->ContractNo->CurrentValue != NULL) {
			$url .= "ContractNo=" . urlencode($this->ContractNo->CurrentValue);
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
			if (Param("ContractNo") !== NULL)
				$arKeys[] = Param("ContractNo");
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
				$this->ContractNo->CurrentValue = $key;
			else
				$this->ContractNo->OldValue = $key;
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
		$this->ProjectCode->setDbValue($rs->fields('ProjectCode'));
		$this->ContractNo->setDbValue($rs->fields('ContractNo'));
		$this->ContractName->setDbValue($rs->fields('ContractName'));
		$this->ContractType->setDbValue($rs->fields('ContractType'));
		$this->ContractSum->setDbValue($rs->fields('ContractSum'));
		$this->RevisedContractSum->setDbValue($rs->fields('RevisedContractSum'));
		$this->ContractorRef->setDbValue($rs->fields('ContractorRef'));
		$this->SigningDate->setDbValue($rs->fields('SigningDate'));
		$this->PlannedStartDate->setDbValue($rs->fields('PlannedStartDate'));
		$this->PlannedEndDate->setDbValue($rs->fields('PlannedEndDate'));
		$this->ActualStartDate->setDbValue($rs->fields('ActualStartDate'));
		$this->ActualEndDate->setDbValue($rs->fields('ActualEndDate'));
		$this->Duration->setDbValue($rs->fields('Duration'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->AdvancePaymentAmount->setDbValue($rs->fields('AdvancePaymentAmount'));
		$this->AdvancePaymentdate->setDbValue($rs->fields('AdvancePaymentdate'));
		$this->ContractStatus->setDbValue($rs->fields('ContractStatus'));
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
		// ProjectCode
		// ContractNo
		// ContractName
		// ContractType
		// ContractSum
		// RevisedContractSum
		// ContractorRef
		// SigningDate
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Duration
		// UnitOfMeasure
		// AdvancePaymentAmount
		// AdvancePaymentdate
		// ContractStatus
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

		// ContractNo
		$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
		$this->ContractNo->ViewCustomAttributes = "";

		// ContractName
		$this->ContractName->ViewValue = $this->ContractName->CurrentValue;
		$this->ContractName->ViewCustomAttributes = "";

		// ContractType
		$curVal = strval($this->ContractType->CurrentValue);
		if ($curVal != "") {
			$this->ContractType->ViewValue = $this->ContractType->lookupCacheOption($curVal);
			if ($this->ContractType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ContractType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ContractType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ContractType->ViewValue = $this->ContractType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
				}
			}
		} else {
			$this->ContractType->ViewValue = NULL;
		}
		$this->ContractType->ViewCustomAttributes = "";

		// ContractSum
		$this->ContractSum->ViewValue = $this->ContractSum->CurrentValue;
		$this->ContractSum->ViewValue = FormatNumber($this->ContractSum->ViewValue, 2, -2, -2, -2);
		$this->ContractSum->CellCssStyle .= "text-align: right;";
		$this->ContractSum->ViewCustomAttributes = "";

		// RevisedContractSum
		$this->RevisedContractSum->ViewValue = $this->RevisedContractSum->CurrentValue;
		$this->RevisedContractSum->ViewValue = FormatNumber($this->RevisedContractSum->ViewValue, 2, -2, -2, -2);
		$this->RevisedContractSum->CellCssStyle .= "text-align: right;";
		$this->RevisedContractSum->ViewCustomAttributes = "";

		// ContractorRef
		$curVal = strval($this->ContractorRef->CurrentValue);
		if ($curVal != "") {
			$this->ContractorRef->ViewValue = $this->ContractorRef->lookupCacheOption($curVal);
			if ($this->ContractorRef->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ContractorRef`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ContractorRef->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ContractorRef->ViewValue = $this->ContractorRef->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ContractorRef->ViewValue = $this->ContractorRef->CurrentValue;
				}
			}
		} else {
			$this->ContractorRef->ViewValue = NULL;
		}
		$this->ContractorRef->ViewCustomAttributes = "";

		// SigningDate
		$this->SigningDate->ViewValue = $this->SigningDate->CurrentValue;
		$this->SigningDate->ViewValue = FormatDateTime($this->SigningDate->ViewValue, 0);
		$this->SigningDate->ViewCustomAttributes = "";

		// PlannedStartDate
		$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
		$this->PlannedStartDate->ViewCustomAttributes = "";

		// PlannedEndDate
		$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
		$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 0);
		$this->PlannedEndDate->ViewCustomAttributes = "";

		// ActualStartDate
		$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
		$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
		$this->ActualStartDate->ViewCustomAttributes = "";

		// ActualEndDate
		$this->ActualEndDate->ViewValue = $this->ActualEndDate->CurrentValue;
		$this->ActualEndDate->ViewValue = FormatDateTime($this->ActualEndDate->ViewValue, 0);
		$this->ActualEndDate->ViewCustomAttributes = "";

		// Duration
		$this->Duration->ViewValue = $this->Duration->CurrentValue;
		$this->Duration->ViewValue = FormatNumber($this->Duration->ViewValue, 2, -2, -2, -2);
		$this->Duration->ViewCustomAttributes = "";

		// UnitOfMeasure
		$curVal = strval($this->UnitOfMeasure->CurrentValue);
		if ($curVal != "") {
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
				}
			}
		} else {
			$this->UnitOfMeasure->ViewValue = NULL;
		}
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// AdvancePaymentAmount
		$this->AdvancePaymentAmount->ViewValue = $this->AdvancePaymentAmount->CurrentValue;
		$this->AdvancePaymentAmount->ViewValue = FormatNumber($this->AdvancePaymentAmount->ViewValue, 2, -2, -2, -2);
		$this->AdvancePaymentAmount->CellCssStyle .= "text-align: right;";
		$this->AdvancePaymentAmount->ViewCustomAttributes = "";

		// AdvancePaymentdate
		$this->AdvancePaymentdate->ViewValue = $this->AdvancePaymentdate->CurrentValue;
		$this->AdvancePaymentdate->ViewValue = FormatDateTime($this->AdvancePaymentdate->ViewValue, 0);
		$this->AdvancePaymentdate->ViewCustomAttributes = "";

		// ContractStatus
		$curVal = strval($this->ContractStatus->CurrentValue);
		if ($curVal != "") {
			$this->ContractStatus->ViewValue = $this->ContractStatus->lookupCacheOption($curVal);
			if ($this->ContractStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ContractStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ContractStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ContractStatus->ViewValue = $this->ContractStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ContractStatus->ViewValue = $this->ContractStatus->CurrentValue;
				}
			}
		} else {
			$this->ContractStatus->ViewValue = NULL;
		}
		$this->ContractStatus->ViewCustomAttributes = "";

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

		// ProjectCode
		$this->ProjectCode->LinkCustomAttributes = "";
		$this->ProjectCode->HrefValue = "";
		$this->ProjectCode->TooltipValue = "";

		// ContractNo
		$this->ContractNo->LinkCustomAttributes = "";
		$this->ContractNo->HrefValue = "";
		$this->ContractNo->TooltipValue = "";

		// ContractName
		$this->ContractName->LinkCustomAttributes = "";
		$this->ContractName->HrefValue = "";
		$this->ContractName->TooltipValue = "";

		// ContractType
		$this->ContractType->LinkCustomAttributes = "";
		$this->ContractType->HrefValue = "";
		$this->ContractType->TooltipValue = "";

		// ContractSum
		$this->ContractSum->LinkCustomAttributes = "";
		$this->ContractSum->HrefValue = "";
		$this->ContractSum->TooltipValue = "";

		// RevisedContractSum
		$this->RevisedContractSum->LinkCustomAttributes = "";
		$this->RevisedContractSum->HrefValue = "";
		$this->RevisedContractSum->TooltipValue = "";

		// ContractorRef
		$this->ContractorRef->LinkCustomAttributes = "";
		$this->ContractorRef->HrefValue = "";
		$this->ContractorRef->TooltipValue = "";

		// SigningDate
		$this->SigningDate->LinkCustomAttributes = "";
		$this->SigningDate->HrefValue = "";
		$this->SigningDate->TooltipValue = "";

		// PlannedStartDate
		$this->PlannedStartDate->LinkCustomAttributes = "";
		$this->PlannedStartDate->HrefValue = "";
		$this->PlannedStartDate->TooltipValue = "";

		// PlannedEndDate
		$this->PlannedEndDate->LinkCustomAttributes = "";
		$this->PlannedEndDate->HrefValue = "";
		$this->PlannedEndDate->TooltipValue = "";

		// ActualStartDate
		$this->ActualStartDate->LinkCustomAttributes = "";
		$this->ActualStartDate->HrefValue = "";
		$this->ActualStartDate->TooltipValue = "";

		// ActualEndDate
		$this->ActualEndDate->LinkCustomAttributes = "";
		$this->ActualEndDate->HrefValue = "";
		$this->ActualEndDate->TooltipValue = "";

		// Duration
		$this->Duration->LinkCustomAttributes = "";
		$this->Duration->HrefValue = "";
		$this->Duration->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// AdvancePaymentAmount
		$this->AdvancePaymentAmount->LinkCustomAttributes = "";
		$this->AdvancePaymentAmount->HrefValue = "";
		$this->AdvancePaymentAmount->TooltipValue = "";

		// AdvancePaymentdate
		$this->AdvancePaymentdate->LinkCustomAttributes = "";
		$this->AdvancePaymentdate->HrefValue = "";
		$this->AdvancePaymentdate->TooltipValue = "";

		// ContractStatus
		$this->ContractStatus->LinkCustomAttributes = "";
		$this->ContractStatus->HrefValue = "";
		$this->ContractStatus->TooltipValue = "";

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

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";

		// SectionCode
		$this->SectionCode->EditAttrs["class"] = "form-control";
		$this->SectionCode->EditCustomAttributes = "";

		// ProjectCode
		$this->ProjectCode->EditAttrs["class"] = "form-control";
		$this->ProjectCode->EditCustomAttributes = "";
		if (!$this->ProjectCode->Raw)
			$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
		$this->ProjectCode->EditValue = $this->ProjectCode->CurrentValue;
		$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

		// ContractNo
		$this->ContractNo->EditAttrs["class"] = "form-control";
		$this->ContractNo->EditCustomAttributes = "";
		if (!$this->ContractNo->Raw)
			$this->ContractNo->CurrentValue = HtmlDecode($this->ContractNo->CurrentValue);
		$this->ContractNo->EditValue = $this->ContractNo->CurrentValue;
		$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());

		// ContractName
		$this->ContractName->EditAttrs["class"] = "form-control";
		$this->ContractName->EditCustomAttributes = "";
		if (!$this->ContractName->Raw)
			$this->ContractName->CurrentValue = HtmlDecode($this->ContractName->CurrentValue);
		$this->ContractName->EditValue = $this->ContractName->CurrentValue;
		$this->ContractName->PlaceHolder = RemoveHtml($this->ContractName->caption());

		// ContractType
		$this->ContractType->EditAttrs["class"] = "form-control";
		$this->ContractType->EditCustomAttributes = "";

		// ContractSum
		$this->ContractSum->EditAttrs["class"] = "form-control";
		$this->ContractSum->EditCustomAttributes = "";
		$this->ContractSum->EditValue = $this->ContractSum->CurrentValue;
		$this->ContractSum->PlaceHolder = RemoveHtml($this->ContractSum->caption());
		if (strval($this->ContractSum->EditValue) != "" && is_numeric($this->ContractSum->EditValue))
			$this->ContractSum->EditValue = FormatNumber($this->ContractSum->EditValue, -2, -2, -2, -2);
		

		// RevisedContractSum
		$this->RevisedContractSum->EditAttrs["class"] = "form-control";
		$this->RevisedContractSum->EditCustomAttributes = "";
		$this->RevisedContractSum->EditValue = $this->RevisedContractSum->CurrentValue;
		$this->RevisedContractSum->PlaceHolder = RemoveHtml($this->RevisedContractSum->caption());
		if (strval($this->RevisedContractSum->EditValue) != "" && is_numeric($this->RevisedContractSum->EditValue))
			$this->RevisedContractSum->EditValue = FormatNumber($this->RevisedContractSum->EditValue, -2, -2, -2, -2);
		

		// ContractorRef
		$this->ContractorRef->EditAttrs["class"] = "form-control";
		$this->ContractorRef->EditCustomAttributes = "";

		// SigningDate
		$this->SigningDate->EditAttrs["class"] = "form-control";
		$this->SigningDate->EditCustomAttributes = "";
		$this->SigningDate->EditValue = FormatDateTime($this->SigningDate->CurrentValue, 8);
		$this->SigningDate->PlaceHolder = RemoveHtml($this->SigningDate->caption());

		// PlannedStartDate
		$this->PlannedStartDate->EditAttrs["class"] = "form-control";
		$this->PlannedStartDate->EditCustomAttributes = "";
		$this->PlannedStartDate->EditValue = FormatDateTime($this->PlannedStartDate->CurrentValue, 8);
		$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

		// PlannedEndDate
		$this->PlannedEndDate->EditAttrs["class"] = "form-control";
		$this->PlannedEndDate->EditCustomAttributes = "";
		$this->PlannedEndDate->EditValue = FormatDateTime($this->PlannedEndDate->CurrentValue, 8);
		$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

		// ActualStartDate
		$this->ActualStartDate->EditAttrs["class"] = "form-control";
		$this->ActualStartDate->EditCustomAttributes = "";
		$this->ActualStartDate->EditValue = FormatDateTime($this->ActualStartDate->CurrentValue, 8);
		$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

		// ActualEndDate
		$this->ActualEndDate->EditAttrs["class"] = "form-control";
		$this->ActualEndDate->EditCustomAttributes = "";
		$this->ActualEndDate->EditValue = FormatDateTime($this->ActualEndDate->CurrentValue, 8);
		$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

		// Duration
		$this->Duration->EditAttrs["class"] = "form-control";
		$this->Duration->EditCustomAttributes = "";
		$this->Duration->EditValue = $this->Duration->CurrentValue;
		$this->Duration->PlaceHolder = RemoveHtml($this->Duration->caption());
		if (strval($this->Duration->EditValue) != "" && is_numeric($this->Duration->EditValue))
			$this->Duration->EditValue = FormatNumber($this->Duration->EditValue, -2, -2, -2, -2);
		

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";

		// AdvancePaymentAmount
		$this->AdvancePaymentAmount->EditAttrs["class"] = "form-control";
		$this->AdvancePaymentAmount->EditCustomAttributes = "";
		$this->AdvancePaymentAmount->EditValue = $this->AdvancePaymentAmount->CurrentValue;
		$this->AdvancePaymentAmount->PlaceHolder = RemoveHtml($this->AdvancePaymentAmount->caption());
		if (strval($this->AdvancePaymentAmount->EditValue) != "" && is_numeric($this->AdvancePaymentAmount->EditValue))
			$this->AdvancePaymentAmount->EditValue = FormatNumber($this->AdvancePaymentAmount->EditValue, -2, -2, -2, -2);
		

		// AdvancePaymentdate
		$this->AdvancePaymentdate->EditAttrs["class"] = "form-control";
		$this->AdvancePaymentdate->EditCustomAttributes = "";
		$this->AdvancePaymentdate->EditValue = FormatDateTime($this->AdvancePaymentdate->CurrentValue, 8);
		$this->AdvancePaymentdate->PlaceHolder = RemoveHtml($this->AdvancePaymentdate->caption());

		// ContractStatus
		$this->ContractStatus->EditAttrs["class"] = "form-control";
		$this->ContractStatus->EditCustomAttributes = "";

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
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ContractNo);
					$doc->exportCaption($this->ContractName);
					$doc->exportCaption($this->ContractType);
					$doc->exportCaption($this->ContractSum);
					$doc->exportCaption($this->RevisedContractSum);
					$doc->exportCaption($this->ContractorRef);
					$doc->exportCaption($this->SigningDate);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Duration);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AdvancePaymentAmount);
					$doc->exportCaption($this->AdvancePaymentdate);
					$doc->exportCaption($this->ContractStatus);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ContractNo);
					$doc->exportCaption($this->ContractName);
					$doc->exportCaption($this->ContractType);
					$doc->exportCaption($this->ContractSum);
					$doc->exportCaption($this->RevisedContractSum);
					$doc->exportCaption($this->ContractorRef);
					$doc->exportCaption($this->SigningDate);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Duration);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AdvancePaymentAmount);
					$doc->exportCaption($this->AdvancePaymentdate);
					$doc->exportCaption($this->ContractStatus);
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
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ContractNo);
						$doc->exportField($this->ContractName);
						$doc->exportField($this->ContractType);
						$doc->exportField($this->ContractSum);
						$doc->exportField($this->RevisedContractSum);
						$doc->exportField($this->ContractorRef);
						$doc->exportField($this->SigningDate);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Duration);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AdvancePaymentAmount);
						$doc->exportField($this->AdvancePaymentdate);
						$doc->exportField($this->ContractStatus);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ContractNo);
						$doc->exportField($this->ContractName);
						$doc->exportField($this->ContractType);
						$doc->exportField($this->ContractSum);
						$doc->exportField($this->RevisedContractSum);
						$doc->exportField($this->ContractorRef);
						$doc->exportField($this->SigningDate);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Duration);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AdvancePaymentAmount);
						$doc->exportField($this->AdvancePaymentdate);
						$doc->exportField($this->ContractStatus);
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