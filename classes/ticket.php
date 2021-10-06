<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for ticket
 */
class ticket extends DbTable
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
	public $Subject;
	public $TicketReportDate;
	public $IncidentDate;
	public $IncidentTime;
	public $TicketDescription;
	public $TicketCategory;
	public $TicketType;
	public $ReportedBy;
	public $TicketStatus;
	public $TicketNumber;
	public $ReporterEmail;
	public $ReporterMobile;
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $DeptSection;
	public $TicketLevel;
	public $AllocatedTo;
	public $EscalatedTo;
	public $TicketSolution;
	public $Evidence;
	public $SeverityLevel;
	public $Days;
	public $DataLastUpdated;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ticket';
		$this->TableName = 'ticket';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`ticket`";
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

		// Subject
		$this->Subject = new DbField('ticket', 'ticket', 'x_Subject', 'Subject', '`Subject`', '`Subject`', 200, 255, -1, FALSE, '`Subject`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Subject->Nullable = FALSE; // NOT NULL field
		$this->Subject->Required = TRUE; // Required field
		$this->Subject->Sortable = TRUE; // Allow sort
		$this->fields['Subject'] = &$this->Subject;

		// TicketReportDate
		$this->TicketReportDate = new DbField('ticket', 'ticket', 'x_TicketReportDate', 'TicketReportDate', '`TicketReportDate`', CastDateFieldForLike("`TicketReportDate`", 0, "DB"), 135, 19, 0, FALSE, '`TicketReportDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TicketReportDate->Sortable = TRUE; // Allow sort
		$this->TicketReportDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['TicketReportDate'] = &$this->TicketReportDate;

		// IncidentDate
		$this->IncidentDate = new DbField('ticket', 'ticket', 'x_IncidentDate', 'IncidentDate', '`IncidentDate`', CastDateFieldForLike("`IncidentDate`", 0, "DB"), 133, 10, 0, FALSE, '`IncidentDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncidentDate->Sortable = TRUE; // Allow sort
		$this->IncidentDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['IncidentDate'] = &$this->IncidentDate;

		// IncidentTime
		$this->IncidentTime = new DbField('ticket', 'ticket', 'x_IncidentTime', 'IncidentTime', '`IncidentTime`', CastDateFieldForLike("`IncidentTime`", 4, "DB"), 134, 10, 4, FALSE, '`IncidentTime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncidentTime->Nullable = FALSE; // NOT NULL field
		$this->IncidentTime->Required = TRUE; // Required field
		$this->IncidentTime->Sortable = TRUE; // Allow sort
		$this->IncidentTime->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['IncidentTime'] = &$this->IncidentTime;

		// TicketDescription
		$this->TicketDescription = new DbField('ticket', 'ticket', 'x_TicketDescription', 'TicketDescription', '`TicketDescription`', '`TicketDescription`', 201, 65535, -1, FALSE, '`TicketDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->TicketDescription->Sortable = TRUE; // Allow sort
		$this->fields['TicketDescription'] = &$this->TicketDescription;

		// TicketCategory
		$this->TicketCategory = new DbField('ticket', 'ticket', 'x_TicketCategory', 'TicketCategory', '`TicketCategory`', '`TicketCategory`', 3, 11, -1, FALSE, '`TicketCategory`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TicketCategory->Nullable = FALSE; // NOT NULL field
		$this->TicketCategory->Required = TRUE; // Required field
		$this->TicketCategory->Sortable = TRUE; // Allow sort
		$this->TicketCategory->Lookup = new Lookup('TicketCategory', 'ticket_category_ref', FALSE, 'TicketCategory', ["TicketCategoryName","","",""], [], ["x_TicketType"], [], [], [], [], '', '');
		$this->TicketCategory->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TicketCategory'] = &$this->TicketCategory;

		// TicketType
		$this->TicketType = new DbField('ticket', 'ticket', 'x_TicketType', 'TicketType', '`TicketType`', '`TicketType`', 16, 3, -1, FALSE, '`TicketType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->TicketType->Nullable = FALSE; // NOT NULL field
		$this->TicketType->Required = TRUE; // Required field
		$this->TicketType->Sortable = TRUE; // Allow sort
		$this->TicketType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->TicketType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->TicketType->Lookup = new Lookup('TicketType', 'ticket_type', FALSE, 'TicketType', ["TicketTypeDesc","","",""], ["x_TicketCategory"], [], ["TicketCategory"], ["x_TicketCategory"], [], [], '', '');
		$this->TicketType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TicketType'] = &$this->TicketType;

		// ReportedBy
		$this->ReportedBy = new DbField('ticket', 'ticket', 'x_ReportedBy', 'ReportedBy', '`ReportedBy`', '`ReportedBy`', 3, 11, -1, FALSE, '`ReportedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ReportedBy->Nullable = FALSE; // NOT NULL field
		$this->ReportedBy->Required = TRUE; // Required field
		$this->ReportedBy->Sortable = TRUE; // Allow sort
		$this->ReportedBy->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ReportedBy->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ReportedBy->Lookup = new Lookup('ReportedBy', 'musers', FALSE, 'UserCode', ["LastName","FirstName","EmployeeID",""], [], [], [], [], [], [], '', '');
		$this->ReportedBy->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReportedBy'] = &$this->ReportedBy;

		// TicketStatus
		$this->TicketStatus = new DbField('ticket', 'ticket', 'x_TicketStatus', 'TicketStatus', '`TicketStatus`', '`TicketStatus`', 16, 3, -1, FALSE, '`TicketStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->TicketStatus->Sortable = TRUE; // Allow sort
		$this->TicketStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->TicketStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->TicketStatus->Lookup = new Lookup('TicketStatus', 'ticket_status', FALSE, 'StatusCode', ["TicketStatus","","",""], [], [], [], [], [], [], '', '');
		$this->TicketStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TicketStatus'] = &$this->TicketStatus;

		// TicketNumber
		$this->TicketNumber = new DbField('ticket', 'ticket', 'x_TicketNumber', 'TicketNumber', '`TicketNumber`', '`TicketNumber`', 3, 11, -1, FALSE, '`TicketNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->TicketNumber->IsAutoIncrement = TRUE; // Autoincrement field
		$this->TicketNumber->IsPrimaryKey = TRUE; // Primary key field
		$this->TicketNumber->IsForeignKey = TRUE; // Foreign key field
		$this->TicketNumber->Sortable = TRUE; // Allow sort
		$this->TicketNumber->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TicketNumber'] = &$this->TicketNumber;

		// ReporterEmail
		$this->ReporterEmail = new DbField('ticket', 'ticket', 'x_ReporterEmail', 'ReporterEmail', '`ReporterEmail`', '`ReporterEmail`', 200, 255, -1, FALSE, '`ReporterEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReporterEmail->Sortable = TRUE; // Allow sort
		$this->ReporterEmail->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['ReporterEmail'] = &$this->ReporterEmail;

		// ReporterMobile
		$this->ReporterMobile = new DbField('ticket', 'ticket', 'x_ReporterMobile', 'ReporterMobile', '`ReporterMobile`', '`ReporterMobile`', 200, 255, -1, FALSE, '`ReporterMobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReporterMobile->Sortable = TRUE; // Allow sort
		$this->fields['ReporterMobile'] = &$this->ReporterMobile;

		// ProvinceCode
		$this->ProvinceCode = new DbField('ticket', 'ticket', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('ticket', 'ticket', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('ticket', 'ticket', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_DeptSection"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// DeptSection
		$this->DeptSection = new DbField('ticket', 'ticket', 'x_DeptSection', 'DeptSection', '`DeptSection`', '`DeptSection`', 3, 11, -1, FALSE, '`DeptSection`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DeptSection->Sortable = TRUE; // Allow sort
		$this->DeptSection->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DeptSection->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DeptSection->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DeptSection'] = &$this->DeptSection;

		// TicketLevel
		$this->TicketLevel = new DbField('ticket', 'ticket', 'x_TicketLevel', 'TicketLevel', '`TicketLevel`', '`TicketLevel`', 16, 3, -1, FALSE, '`TicketLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TicketLevel->Sortable = TRUE; // Allow sort
		$this->TicketLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TicketLevel'] = &$this->TicketLevel;

		// AllocatedTo
		$this->AllocatedTo = new DbField('ticket', 'ticket', 'x_AllocatedTo', 'AllocatedTo', '`AllocatedTo`', '`AllocatedTo`', 3, 11, -1, FALSE, '`AllocatedTo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AllocatedTo->Sortable = TRUE; // Allow sort
		$this->AllocatedTo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AllocatedTo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AllocatedTo->Lookup = new Lookup('AllocatedTo', 'service_provider', FALSE, 'ServiceProviderID', ["SPName","","",""], [], [], [], [], [], [], '', '');
		$this->AllocatedTo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AllocatedTo'] = &$this->AllocatedTo;

		// EscalatedTo
		$this->EscalatedTo = new DbField('ticket', 'ticket', 'x_EscalatedTo', 'EscalatedTo', '`EscalatedTo`', '`EscalatedTo`', 3, 11, -1, FALSE, '`EscalatedTo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->EscalatedTo->Sortable = TRUE; // Allow sort
		$this->EscalatedTo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->EscalatedTo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->EscalatedTo->Lookup = new Lookup('EscalatedTo', 'service_provider', FALSE, 'ServiceProviderID', ["SPName","","",""], [], [], [], [], [], [], '', '');
		$this->EscalatedTo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EscalatedTo'] = &$this->EscalatedTo;

		// TicketSolution
		$this->TicketSolution = new DbField('ticket', 'ticket', 'x_TicketSolution', 'TicketSolution', '`TicketSolution`', '`TicketSolution`', 200, 255, -1, FALSE, '`TicketSolution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->TicketSolution->Sortable = TRUE; // Allow sort
		$this->fields['TicketSolution'] = &$this->TicketSolution;

		// Evidence
		$this->Evidence = new DbField('ticket', 'ticket', 'x_Evidence', 'Evidence', '`Evidence`', '`Evidence`', 205, 0, -1, TRUE, '`Evidence`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->Evidence->Sortable = TRUE; // Allow sort
		$this->fields['Evidence'] = &$this->Evidence;

		// SeverityLevel
		$this->SeverityLevel = new DbField('ticket', 'ticket', 'x_SeverityLevel', 'SeverityLevel', '`SeverityLevel`', '`SeverityLevel`', 3, 11, -1, FALSE, '`SeverityLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SeverityLevel->Sortable = TRUE; // Allow sort
		$this->SeverityLevel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SeverityLevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SeverityLevel->Lookup = new Lookup('SeverityLevel', 'severity_level', FALSE, 'SeverityLevelCode', ["SeverityLevel","","",""], [], [], [], [], [], [], '', '');
		$this->SeverityLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SeverityLevel'] = &$this->SeverityLevel;

		// Days
		$this->Days = new DbField('ticket', 'ticket', 'x_Days', 'Days', '`Days`', '`Days`', 5, 22, -1, FALSE, '`Days`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Days->Sortable = TRUE; // Allow sort
		$this->Days->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Days'] = &$this->Days;

		// DataLastUpdated
		$this->DataLastUpdated = new DbField('ticket', 'ticket', 'x_DataLastUpdated', 'DataLastUpdated', '`DataLastUpdated`', CastDateFieldForLike("`DataLastUpdated`", 0, "DB"), 133, 10, 0, FALSE, '`DataLastUpdated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DataLastUpdated->Sortable = TRUE; // Allow sort
		$this->DataLastUpdated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DataLastUpdated'] = &$this->DataLastUpdated;
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
		if ($this->getCurrentDetailTable() == "ticketmessage") {
			$detailUrl = $GLOBALS["ticketmessage"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_TicketNumber=" . urlencode($this->TicketNumber->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "ticketlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ticket`";
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
			$this->TicketNumber->setDbValue($conn->insert_ID());
			$rs['TicketNumber'] = $this->TicketNumber->DbValue;
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
			if (array_key_exists('TicketNumber', $rs))
				AddFilter($where, QuotedName('TicketNumber', $this->Dbid) . '=' . QuotedValue($rs['TicketNumber'], $this->TicketNumber->DataType, $this->Dbid));
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
		$this->Subject->DbValue = $row['Subject'];
		$this->TicketReportDate->DbValue = $row['TicketReportDate'];
		$this->IncidentDate->DbValue = $row['IncidentDate'];
		$this->IncidentTime->DbValue = $row['IncidentTime'];
		$this->TicketDescription->DbValue = $row['TicketDescription'];
		$this->TicketCategory->DbValue = $row['TicketCategory'];
		$this->TicketType->DbValue = $row['TicketType'];
		$this->ReportedBy->DbValue = $row['ReportedBy'];
		$this->TicketStatus->DbValue = $row['TicketStatus'];
		$this->TicketNumber->DbValue = $row['TicketNumber'];
		$this->ReporterEmail->DbValue = $row['ReporterEmail'];
		$this->ReporterMobile->DbValue = $row['ReporterMobile'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->DeptSection->DbValue = $row['DeptSection'];
		$this->TicketLevel->DbValue = $row['TicketLevel'];
		$this->AllocatedTo->DbValue = $row['AllocatedTo'];
		$this->EscalatedTo->DbValue = $row['EscalatedTo'];
		$this->TicketSolution->DbValue = $row['TicketSolution'];
		$this->Evidence->Upload->DbValue = $row['Evidence'];
		$this->SeverityLevel->DbValue = $row['SeverityLevel'];
		$this->Days->DbValue = $row['Days'];
		$this->DataLastUpdated->DbValue = $row['DataLastUpdated'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`TicketNumber` = @TicketNumber@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('TicketNumber', $row) ? $row['TicketNumber'] : NULL;
		else
			$val = $this->TicketNumber->OldValue !== NULL ? $this->TicketNumber->OldValue : $this->TicketNumber->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@TicketNumber@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "ticketlist.php";
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
		if ($pageName == "ticketview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ticketedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ticketadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ticketlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ticketview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ticketview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ticketadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ticketadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ticketedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ticketedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("ticketadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ticketadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("ticketdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "TicketNumber:" . JsonEncode($this->TicketNumber->CurrentValue, "number");
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
		if ($this->TicketNumber->CurrentValue != NULL) {
			$url .= "TicketNumber=" . urlencode($this->TicketNumber->CurrentValue);
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
			if (Param("TicketNumber") !== NULL)
				$arKeys[] = Param("TicketNumber");
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
				$this->TicketNumber->CurrentValue = $key;
			else
				$this->TicketNumber->OldValue = $key;
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
		$this->Subject->setDbValue($rs->fields('Subject'));
		$this->TicketReportDate->setDbValue($rs->fields('TicketReportDate'));
		$this->IncidentDate->setDbValue($rs->fields('IncidentDate'));
		$this->IncidentTime->setDbValue($rs->fields('IncidentTime'));
		$this->TicketDescription->setDbValue($rs->fields('TicketDescription'));
		$this->TicketCategory->setDbValue($rs->fields('TicketCategory'));
		$this->TicketType->setDbValue($rs->fields('TicketType'));
		$this->ReportedBy->setDbValue($rs->fields('ReportedBy'));
		$this->TicketStatus->setDbValue($rs->fields('TicketStatus'));
		$this->TicketNumber->setDbValue($rs->fields('TicketNumber'));
		$this->ReporterEmail->setDbValue($rs->fields('ReporterEmail'));
		$this->ReporterMobile->setDbValue($rs->fields('ReporterMobile'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->DeptSection->setDbValue($rs->fields('DeptSection'));
		$this->TicketLevel->setDbValue($rs->fields('TicketLevel'));
		$this->AllocatedTo->setDbValue($rs->fields('AllocatedTo'));
		$this->EscalatedTo->setDbValue($rs->fields('EscalatedTo'));
		$this->TicketSolution->setDbValue($rs->fields('TicketSolution'));
		$this->Evidence->Upload->DbValue = $rs->fields('Evidence');
		$this->SeverityLevel->setDbValue($rs->fields('SeverityLevel'));
		$this->Days->setDbValue($rs->fields('Days'));
		$this->DataLastUpdated->setDbValue($rs->fields('DataLastUpdated'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Subject
		// TicketReportDate
		// IncidentDate
		// IncidentTime
		// TicketDescription
		// TicketCategory
		// TicketType
		// ReportedBy
		// TicketStatus
		// TicketNumber
		// ReporterEmail
		// ReporterMobile
		// ProvinceCode
		// LACode
		// DepartmentCode
		// DeptSection
		// TicketLevel
		// AllocatedTo
		// EscalatedTo
		// TicketSolution
		// Evidence
		// SeverityLevel
		// Days
		// DataLastUpdated
		// Subject

		$this->Subject->ViewValue = $this->Subject->CurrentValue;
		$this->Subject->ViewCustomAttributes = "";

		// TicketReportDate
		$this->TicketReportDate->ViewValue = $this->TicketReportDate->CurrentValue;
		$this->TicketReportDate->ViewValue = FormatDateTime($this->TicketReportDate->ViewValue, 0);
		$this->TicketReportDate->ViewCustomAttributes = "";

		// IncidentDate
		$this->IncidentDate->ViewValue = $this->IncidentDate->CurrentValue;
		$this->IncidentDate->ViewValue = FormatDateTime($this->IncidentDate->ViewValue, 0);
		$this->IncidentDate->ViewCustomAttributes = "";

		// IncidentTime
		$this->IncidentTime->ViewValue = $this->IncidentTime->CurrentValue;
		$this->IncidentTime->ViewValue = FormatDateTime($this->IncidentTime->ViewValue, 4);
		$this->IncidentTime->ViewCustomAttributes = "";

		// TicketDescription
		$this->TicketDescription->ViewValue = $this->TicketDescription->CurrentValue;
		$this->TicketDescription->ViewCustomAttributes = "";

		// TicketCategory
		$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
		$curVal = strval($this->TicketCategory->CurrentValue);
		if ($curVal != "") {
			$this->TicketCategory->ViewValue = $this->TicketCategory->lookupCacheOption($curVal);
			if ($this->TicketCategory->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->TicketCategory->ViewValue = $this->TicketCategory->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
				}
			}
		} else {
			$this->TicketCategory->ViewValue = NULL;
		}
		$this->TicketCategory->ViewCustomAttributes = "";

		// TicketType
		$curVal = strval($this->TicketType->CurrentValue);
		if ($curVal != "") {
			$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
			if ($this->TicketType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`TicketType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->TicketType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->TicketType->ViewValue = $this->TicketType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TicketType->ViewValue = $this->TicketType->CurrentValue;
				}
			}
		} else {
			$this->TicketType->ViewValue = NULL;
		}
		$this->TicketType->ViewCustomAttributes = "";

		// ReportedBy
		$curVal = strval($this->ReportedBy->CurrentValue);
		if ($curVal != "") {
			$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
			if ($this->ReportedBy->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`UserCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ReportedBy->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ReportedBy->ViewValue = $this->ReportedBy->CurrentValue;
				}
			}
		} else {
			$this->ReportedBy->ViewValue = NULL;
		}
		$this->ReportedBy->ViewCustomAttributes = "";

		// TicketStatus
		$curVal = strval($this->TicketStatus->CurrentValue);
		if ($curVal != "") {
			$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
			if ($this->TicketStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`StatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->TicketStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->TicketStatus->ViewValue = $this->TicketStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TicketStatus->ViewValue = $this->TicketStatus->CurrentValue;
				}
			}
		} else {
			$this->TicketStatus->ViewValue = NULL;
		}
		$this->TicketStatus->ViewCustomAttributes = "";

		// TicketNumber
		$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
		$this->TicketNumber->ViewCustomAttributes = "";

		// ReporterEmail
		$this->ReporterEmail->ViewValue = $this->ReporterEmail->CurrentValue;
		$this->ReporterEmail->ViewCustomAttributes = "";

		// ReporterMobile
		$this->ReporterMobile->ViewValue = $this->ReporterMobile->CurrentValue;
		$this->ReporterMobile->ViewCustomAttributes = "";

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

		// DeptSection
		$this->DeptSection->ViewCustomAttributes = "";

		// TicketLevel
		$this->TicketLevel->ViewValue = $this->TicketLevel->CurrentValue;
		$this->TicketLevel->ViewCustomAttributes = "";

		// AllocatedTo
		$curVal = strval($this->AllocatedTo->CurrentValue);
		if ($curVal != "") {
			$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
			if ($this->AllocatedTo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AllocatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AllocatedTo->ViewValue = $this->AllocatedTo->CurrentValue;
				}
			}
		} else {
			$this->AllocatedTo->ViewValue = NULL;
		}
		$this->AllocatedTo->ViewCustomAttributes = "";

		// EscalatedTo
		$curVal = strval($this->EscalatedTo->CurrentValue);
		if ($curVal != "") {
			$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
			if ($this->EscalatedTo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->EscalatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->EscalatedTo->ViewValue = $this->EscalatedTo->CurrentValue;
				}
			}
		} else {
			$this->EscalatedTo->ViewValue = NULL;
		}
		$this->EscalatedTo->ViewCustomAttributes = "";

		// TicketSolution
		$this->TicketSolution->ViewValue = $this->TicketSolution->CurrentValue;
		$this->TicketSolution->ViewCustomAttributes = "";

		// Evidence
		if (!EmptyValue($this->Evidence->Upload->DbValue)) {
			$this->Evidence->ViewValue = $this->TicketNumber->CurrentValue;
			$this->Evidence->IsBlobImage = IsImageFile(ContentExtension($this->Evidence->Upload->DbValue));
		} else {
			$this->Evidence->ViewValue = "";
		}
		$this->Evidence->ViewCustomAttributes = "";

		// SeverityLevel
		$curVal = strval($this->SeverityLevel->CurrentValue);
		if ($curVal != "") {
			$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
			if ($this->SeverityLevel->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SeverityLevelCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SeverityLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SeverityLevel->ViewValue = $this->SeverityLevel->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SeverityLevel->ViewValue = $this->SeverityLevel->CurrentValue;
				}
			}
		} else {
			$this->SeverityLevel->ViewValue = NULL;
		}
		$this->SeverityLevel->ViewCustomAttributes = "";

		// Days
		$this->Days->ViewValue = $this->Days->CurrentValue;
		$this->Days->ViewValue = FormatNumber($this->Days->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Days->ViewCustomAttributes = "";

		// DataLastUpdated
		$this->DataLastUpdated->ViewValue = $this->DataLastUpdated->CurrentValue;
		$this->DataLastUpdated->ViewValue = FormatDateTime($this->DataLastUpdated->ViewValue, 0);
		$this->DataLastUpdated->ViewCustomAttributes = "";

		// Subject
		$this->Subject->LinkCustomAttributes = "";
		$this->Subject->HrefValue = "";
		$this->Subject->TooltipValue = "";

		// TicketReportDate
		$this->TicketReportDate->LinkCustomAttributes = "";
		$this->TicketReportDate->HrefValue = "";
		$this->TicketReportDate->TooltipValue = "";

		// IncidentDate
		$this->IncidentDate->LinkCustomAttributes = "";
		$this->IncidentDate->HrefValue = "";
		$this->IncidentDate->TooltipValue = "";

		// IncidentTime
		$this->IncidentTime->LinkCustomAttributes = "";
		$this->IncidentTime->HrefValue = "";
		$this->IncidentTime->TooltipValue = "";

		// TicketDescription
		$this->TicketDescription->LinkCustomAttributes = "";
		$this->TicketDescription->HrefValue = "";
		$this->TicketDescription->TooltipValue = "";

		// TicketCategory
		$this->TicketCategory->LinkCustomAttributes = "";
		$this->TicketCategory->HrefValue = "";
		$this->TicketCategory->TooltipValue = "";

		// TicketType
		$this->TicketType->LinkCustomAttributes = "";
		$this->TicketType->HrefValue = "";
		$this->TicketType->TooltipValue = "";

		// ReportedBy
		$this->ReportedBy->LinkCustomAttributes = "";
		$this->ReportedBy->HrefValue = "";
		$this->ReportedBy->TooltipValue = "";

		// TicketStatus
		$this->TicketStatus->LinkCustomAttributes = "";
		$this->TicketStatus->HrefValue = "";
		$this->TicketStatus->TooltipValue = "";

		// TicketNumber
		$this->TicketNumber->LinkCustomAttributes = "";
		$this->TicketNumber->HrefValue = "";
		$this->TicketNumber->TooltipValue = "";

		// ReporterEmail
		$this->ReporterEmail->LinkCustomAttributes = "";
		$this->ReporterEmail->HrefValue = "";
		$this->ReporterEmail->TooltipValue = "";

		// ReporterMobile
		$this->ReporterMobile->LinkCustomAttributes = "";
		$this->ReporterMobile->HrefValue = "";
		$this->ReporterMobile->TooltipValue = "";

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

		// DeptSection
		$this->DeptSection->LinkCustomAttributes = "";
		$this->DeptSection->HrefValue = "";
		$this->DeptSection->TooltipValue = "";

		// TicketLevel
		$this->TicketLevel->LinkCustomAttributes = "";
		$this->TicketLevel->HrefValue = "";
		$this->TicketLevel->TooltipValue = "";

		// AllocatedTo
		$this->AllocatedTo->LinkCustomAttributes = "";
		$this->AllocatedTo->HrefValue = "";
		$this->AllocatedTo->TooltipValue = "";

		// EscalatedTo
		$this->EscalatedTo->LinkCustomAttributes = "";
		$this->EscalatedTo->HrefValue = "";
		$this->EscalatedTo->TooltipValue = "";

		// TicketSolution
		$this->TicketSolution->LinkCustomAttributes = "";
		$this->TicketSolution->HrefValue = "";
		$this->TicketSolution->TooltipValue = "";

		// Evidence
		$this->Evidence->LinkCustomAttributes = "";
		if (!empty($this->Evidence->Upload->DbValue)) {
			$this->Evidence->HrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);
			$this->Evidence->LinkAttrs["target"] = "";
			if ($this->Evidence->IsBlobImage && empty($this->Evidence->LinkAttrs["target"]))
				$this->Evidence->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->Evidence->HrefValue = FullUrl($this->Evidence->HrefValue, "href");
		} else {
			$this->Evidence->HrefValue = "";
		}
		$this->Evidence->ExportHrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);
		$this->Evidence->TooltipValue = "";

		// SeverityLevel
		$this->SeverityLevel->LinkCustomAttributes = "";
		$this->SeverityLevel->HrefValue = "";
		$this->SeverityLevel->TooltipValue = "";

		// Days
		$this->Days->LinkCustomAttributes = "";
		$this->Days->HrefValue = "";
		$this->Days->TooltipValue = "";

		// DataLastUpdated
		$this->DataLastUpdated->LinkCustomAttributes = "";
		$this->DataLastUpdated->HrefValue = "";
		$this->DataLastUpdated->TooltipValue = "";

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

		// Subject
		$this->Subject->EditAttrs["class"] = "form-control";
		$this->Subject->EditCustomAttributes = "";
		if (!$this->Subject->Raw)
			$this->Subject->CurrentValue = HtmlDecode($this->Subject->CurrentValue);
		$this->Subject->EditValue = $this->Subject->CurrentValue;
		$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

		// TicketReportDate
		$this->TicketReportDate->EditAttrs["class"] = "form-control";
		$this->TicketReportDate->EditCustomAttributes = "";
		$this->TicketReportDate->EditValue = FormatDateTime($this->TicketReportDate->CurrentValue, 8);
		$this->TicketReportDate->PlaceHolder = RemoveHtml($this->TicketReportDate->caption());

		// IncidentDate
		$this->IncidentDate->EditAttrs["class"] = "form-control";
		$this->IncidentDate->EditCustomAttributes = "";
		$this->IncidentDate->EditValue = FormatDateTime($this->IncidentDate->CurrentValue, 8);
		$this->IncidentDate->PlaceHolder = RemoveHtml($this->IncidentDate->caption());

		// IncidentTime
		$this->IncidentTime->EditAttrs["class"] = "form-control";
		$this->IncidentTime->EditCustomAttributes = "";
		$this->IncidentTime->EditValue = $this->IncidentTime->CurrentValue;
		$this->IncidentTime->PlaceHolder = RemoveHtml($this->IncidentTime->caption());

		// TicketDescription
		$this->TicketDescription->EditAttrs["class"] = "form-control";
		$this->TicketDescription->EditCustomAttributes = "";
		$this->TicketDescription->EditValue = $this->TicketDescription->CurrentValue;
		$this->TicketDescription->PlaceHolder = RemoveHtml($this->TicketDescription->caption());

		// TicketCategory
		$this->TicketCategory->EditAttrs["class"] = "form-control";
		$this->TicketCategory->EditCustomAttributes = "";
		$this->TicketCategory->EditValue = $this->TicketCategory->CurrentValue;
		$this->TicketCategory->PlaceHolder = RemoveHtml($this->TicketCategory->caption());

		// TicketType
		$this->TicketType->EditAttrs["class"] = "form-control";
		$this->TicketType->EditCustomAttributes = "";

		// ReportedBy
		$this->ReportedBy->EditAttrs["class"] = "form-control";
		$this->ReportedBy->EditCustomAttributes = "";

		// TicketStatus
		$this->TicketStatus->EditAttrs["class"] = "form-control";
		$this->TicketStatus->EditCustomAttributes = "";

		// TicketNumber
		$this->TicketNumber->EditAttrs["class"] = "form-control";
		$this->TicketNumber->EditCustomAttributes = "";
		$this->TicketNumber->EditValue = $this->TicketNumber->CurrentValue;
		$this->TicketNumber->ViewCustomAttributes = "";

		// ReporterEmail
		$this->ReporterEmail->EditAttrs["class"] = "form-control";
		$this->ReporterEmail->EditCustomAttributes = "";
		if (!$this->ReporterEmail->Raw)
			$this->ReporterEmail->CurrentValue = HtmlDecode($this->ReporterEmail->CurrentValue);
		$this->ReporterEmail->EditValue = $this->ReporterEmail->CurrentValue;
		$this->ReporterEmail->PlaceHolder = RemoveHtml($this->ReporterEmail->caption());

		// ReporterMobile
		$this->ReporterMobile->EditAttrs["class"] = "form-control";
		$this->ReporterMobile->EditCustomAttributes = "";
		if (!$this->ReporterMobile->Raw)
			$this->ReporterMobile->CurrentValue = HtmlDecode($this->ReporterMobile->CurrentValue);
		$this->ReporterMobile->EditValue = $this->ReporterMobile->CurrentValue;
		$this->ReporterMobile->PlaceHolder = RemoveHtml($this->ReporterMobile->caption());

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";

		// DeptSection
		$this->DeptSection->EditAttrs["class"] = "form-control";
		$this->DeptSection->EditCustomAttributes = "";

		// TicketLevel
		$this->TicketLevel->EditAttrs["class"] = "form-control";
		$this->TicketLevel->EditCustomAttributes = "";
		$this->TicketLevel->EditValue = $this->TicketLevel->CurrentValue;
		$this->TicketLevel->PlaceHolder = RemoveHtml($this->TicketLevel->caption());

		// AllocatedTo
		$this->AllocatedTo->EditAttrs["class"] = "form-control";
		$this->AllocatedTo->EditCustomAttributes = "";

		// EscalatedTo
		$this->EscalatedTo->EditAttrs["class"] = "form-control";
		$this->EscalatedTo->EditCustomAttributes = "";

		// TicketSolution
		$this->TicketSolution->EditAttrs["class"] = "form-control";
		$this->TicketSolution->EditCustomAttributes = "";
		$this->TicketSolution->EditValue = $this->TicketSolution->CurrentValue;
		$this->TicketSolution->PlaceHolder = RemoveHtml($this->TicketSolution->caption());

		// Evidence
		$this->Evidence->EditAttrs["class"] = "form-control";
		$this->Evidence->EditCustomAttributes = "";
		if (!EmptyValue($this->Evidence->Upload->DbValue)) {
			$this->Evidence->EditValue = $this->TicketNumber->CurrentValue;
			$this->Evidence->IsBlobImage = IsImageFile(ContentExtension($this->Evidence->Upload->DbValue));
		} else {
			$this->Evidence->EditValue = "";
		}

		// SeverityLevel
		$this->SeverityLevel->EditAttrs["class"] = "form-control";
		$this->SeverityLevel->EditCustomAttributes = "";

		// Days
		$this->Days->EditAttrs["class"] = "form-control";
		$this->Days->EditCustomAttributes = "";
		$this->Days->EditValue = $this->Days->CurrentValue;
		$this->Days->PlaceHolder = RemoveHtml($this->Days->caption());
		if (strval($this->Days->EditValue) != "" && is_numeric($this->Days->EditValue))
			$this->Days->EditValue = FormatNumber($this->Days->EditValue, -2, -1, -2, 0);
		

		// DataLastUpdated
		$this->DataLastUpdated->EditAttrs["class"] = "form-control";
		$this->DataLastUpdated->EditCustomAttributes = "";
		$this->DataLastUpdated->EditValue = FormatDateTime($this->DataLastUpdated->CurrentValue, 8);
		$this->DataLastUpdated->PlaceHolder = RemoveHtml($this->DataLastUpdated->caption());

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
					$doc->exportCaption($this->Subject);
					$doc->exportCaption($this->TicketReportDate);
					$doc->exportCaption($this->IncidentDate);
					$doc->exportCaption($this->IncidentTime);
					$doc->exportCaption($this->TicketDescription);
					$doc->exportCaption($this->TicketCategory);
					$doc->exportCaption($this->TicketType);
					$doc->exportCaption($this->ReportedBy);
					$doc->exportCaption($this->TicketStatus);
					$doc->exportCaption($this->TicketNumber);
					$doc->exportCaption($this->ReporterEmail);
					$doc->exportCaption($this->ReporterMobile);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->DeptSection);
					$doc->exportCaption($this->TicketLevel);
					$doc->exportCaption($this->AllocatedTo);
					$doc->exportCaption($this->EscalatedTo);
					$doc->exportCaption($this->TicketSolution);
					$doc->exportCaption($this->Evidence);
					$doc->exportCaption($this->SeverityLevel);
					$doc->exportCaption($this->Days);
					$doc->exportCaption($this->DataLastUpdated);
				} else {
					$doc->exportCaption($this->Subject);
					$doc->exportCaption($this->TicketReportDate);
					$doc->exportCaption($this->IncidentDate);
					$doc->exportCaption($this->IncidentTime);
					$doc->exportCaption($this->TicketCategory);
					$doc->exportCaption($this->TicketType);
					$doc->exportCaption($this->ReportedBy);
					$doc->exportCaption($this->TicketStatus);
					$doc->exportCaption($this->TicketNumber);
					$doc->exportCaption($this->ReporterEmail);
					$doc->exportCaption($this->ReporterMobile);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->DeptSection);
					$doc->exportCaption($this->TicketLevel);
					$doc->exportCaption($this->AllocatedTo);
					$doc->exportCaption($this->EscalatedTo);
					$doc->exportCaption($this->TicketSolution);
					$doc->exportCaption($this->SeverityLevel);
					$doc->exportCaption($this->Days);
					$doc->exportCaption($this->DataLastUpdated);
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
						$doc->exportField($this->Subject);
						$doc->exportField($this->TicketReportDate);
						$doc->exportField($this->IncidentDate);
						$doc->exportField($this->IncidentTime);
						$doc->exportField($this->TicketDescription);
						$doc->exportField($this->TicketCategory);
						$doc->exportField($this->TicketType);
						$doc->exportField($this->ReportedBy);
						$doc->exportField($this->TicketStatus);
						$doc->exportField($this->TicketNumber);
						$doc->exportField($this->ReporterEmail);
						$doc->exportField($this->ReporterMobile);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->DeptSection);
						$doc->exportField($this->TicketLevel);
						$doc->exportField($this->AllocatedTo);
						$doc->exportField($this->EscalatedTo);
						$doc->exportField($this->TicketSolution);
						$doc->exportField($this->Evidence);
						$doc->exportField($this->SeverityLevel);
						$doc->exportField($this->Days);
						$doc->exportField($this->DataLastUpdated);
					} else {
						$doc->exportField($this->Subject);
						$doc->exportField($this->TicketReportDate);
						$doc->exportField($this->IncidentDate);
						$doc->exportField($this->IncidentTime);
						$doc->exportField($this->TicketCategory);
						$doc->exportField($this->TicketType);
						$doc->exportField($this->ReportedBy);
						$doc->exportField($this->TicketStatus);
						$doc->exportField($this->TicketNumber);
						$doc->exportField($this->ReporterEmail);
						$doc->exportField($this->ReporterMobile);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->DeptSection);
						$doc->exportField($this->TicketLevel);
						$doc->exportField($this->AllocatedTo);
						$doc->exportField($this->EscalatedTo);
						$doc->exportField($this->TicketSolution);
						$doc->exportField($this->SeverityLevel);
						$doc->exportField($this->Days);
						$doc->exportField($this->DataLastUpdated);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'Evidence') {
			$fldName = "Evidence";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->TicketNumber->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
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