<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for project
 */
class project extends DbTable
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
	public $ProjectCode;
	public $ProjectName;
	public $ProjectType;
	public $ProjectSector;
	public $Contractors;
	public $Projectdescription;
	public $PlannedStartDate;
	public $PlannedEndDate;
	public $ActualStartDate;
	public $ActualEndDate;
	public $Budget;
	public $ExpenditureTodate;
	public $FundsReleased;
	public $FundingSource;
	public $ProjectDocs;
	public $ProgressStatus;
	public $OutstandingTasks;
	public $LastUpdated;
	public $CommnentsOnStatus;
	public $MoreDocs;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'project';
		$this->TableName = 'project';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`project`";
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
		$this->ProvinceCode = new DbField('project', 'project', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('project', 'project', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('project', 'project', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('project', 'project', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->IsForeignKey = TRUE; // Foreign key field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// ProjectCode
		$this->ProjectCode = new DbField('project', 'project', 'x_ProjectCode', 'ProjectCode', '`ProjectCode`', '`ProjectCode`', 200, 23, -1, FALSE, '`ProjectCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProjectCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ProjectCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProjectCode->Nullable = FALSE; // NOT NULL field
		$this->ProjectCode->Required = TRUE; // Required field
		$this->ProjectCode->Sortable = TRUE; // Allow sort
		$this->fields['ProjectCode'] = &$this->ProjectCode;

		// ProjectName
		$this->ProjectName = new DbField('project', 'project', 'x_ProjectName', 'ProjectName', '`ProjectName`', '`ProjectName`', 200, 255, -1, FALSE, '`ProjectName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProjectName->Nullable = FALSE; // NOT NULL field
		$this->ProjectName->Required = TRUE; // Required field
		$this->ProjectName->Sortable = TRUE; // Allow sort
		$this->fields['ProjectName'] = &$this->ProjectName;

		// ProjectType
		$this->ProjectType = new DbField('project', 'project', 'x_ProjectType', 'ProjectType', '`ProjectType`', '`ProjectType`', 3, 11, -1, FALSE, '`ProjectType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProjectType->Nullable = FALSE; // NOT NULL field
		$this->ProjectType->Required = TRUE; // Required field
		$this->ProjectType->Sortable = TRUE; // Allow sort
		$this->ProjectType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProjectType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProjectType->Lookup = new Lookup('ProjectType', 'project_type', FALSE, 'ProjectType', ["ProjectTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ProjectType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProjectType'] = &$this->ProjectType;

		// ProjectSector
		$this->ProjectSector = new DbField('project', 'project', 'x_ProjectSector', 'ProjectSector', '`ProjectSector`', '`ProjectSector`', 3, 11, -1, FALSE, '`ProjectSector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProjectSector->Nullable = FALSE; // NOT NULL field
		$this->ProjectSector->Required = TRUE; // Required field
		$this->ProjectSector->Sortable = TRUE; // Allow sort
		$this->ProjectSector->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProjectSector->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProjectSector->Lookup = new Lookup('ProjectSector', 'project_sector', FALSE, 'ProjectSector', ["ProjectSectorDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ProjectSector->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProjectSector'] = &$this->ProjectSector;

		// Contractors
		$this->Contractors = new DbField('project', 'project', 'x_Contractors', 'Contractors', '`Contractors`', '`Contractors`', 200, 255, -1, FALSE, '`Contractors`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Contractors->Sortable = TRUE; // Allow sort
		$this->fields['Contractors'] = &$this->Contractors;

		// Projectdescription
		$this->Projectdescription = new DbField('project', 'project', 'x_Projectdescription', 'Projectdescription', '`Projectdescription`', '`Projectdescription`', 201, 16777215, -1, FALSE, '`Projectdescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Projectdescription->Sortable = TRUE; // Allow sort
		$this->fields['Projectdescription'] = &$this->Projectdescription;

		// PlannedStartDate
		$this->PlannedStartDate = new DbField('project', 'project', 'x_PlannedStartDate', 'PlannedStartDate', '`PlannedStartDate`', CastDateFieldForLike("`PlannedStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedStartDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedStartDate->Required = TRUE; // Required field
		$this->PlannedStartDate->Sortable = TRUE; // Allow sort
		$this->PlannedStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedStartDate'] = &$this->PlannedStartDate;

		// PlannedEndDate
		$this->PlannedEndDate = new DbField('project', 'project', 'x_PlannedEndDate', 'PlannedEndDate', '`PlannedEndDate`', CastDateFieldForLike("`PlannedEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedEndDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedEndDate->Required = TRUE; // Required field
		$this->PlannedEndDate->Sortable = TRUE; // Allow sort
		$this->PlannedEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedEndDate'] = &$this->PlannedEndDate;

		// ActualStartDate
		$this->ActualStartDate = new DbField('project', 'project', 'x_ActualStartDate', 'ActualStartDate', '`ActualStartDate`', CastDateFieldForLike("`ActualStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualStartDate->Sortable = TRUE; // Allow sort
		$this->ActualStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualStartDate'] = &$this->ActualStartDate;

		// ActualEndDate
		$this->ActualEndDate = new DbField('project', 'project', 'x_ActualEndDate', 'ActualEndDate', '`ActualEndDate`', CastDateFieldForLike("`ActualEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualEndDate->Sortable = TRUE; // Allow sort
		$this->ActualEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualEndDate'] = &$this->ActualEndDate;

		// Budget
		$this->Budget = new DbField('project', 'project', 'x_Budget', 'Budget', '`Budget`', '`Budget`', 5, 22, -1, FALSE, '`Budget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Budget->Nullable = FALSE; // NOT NULL field
		$this->Budget->Required = TRUE; // Required field
		$this->Budget->Sortable = TRUE; // Allow sort
		$this->Budget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Budget'] = &$this->Budget;

		// ExpenditureTodate
		$this->ExpenditureTodate = new DbField('project', 'project', 'x_ExpenditureTodate', 'ExpenditureTodate', '`ExpenditureTodate`', '`ExpenditureTodate`', 5, 22, -1, FALSE, '`ExpenditureTodate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExpenditureTodate->Sortable = TRUE; // Allow sort
		$this->ExpenditureTodate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ExpenditureTodate'] = &$this->ExpenditureTodate;

		// FundsReleased
		$this->FundsReleased = new DbField('project', 'project', 'x_FundsReleased', 'FundsReleased', '`FundsReleased`', '`FundsReleased`', 5, 22, -1, FALSE, '`FundsReleased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FundsReleased->Sortable = TRUE; // Allow sort
		$this->FundsReleased->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['FundsReleased'] = &$this->FundsReleased;

		// FundingSource
		$this->FundingSource = new DbField('project', 'project', 'x_FundingSource', 'FundingSource', '`FundingSource`', '`FundingSource`', 200, 50, -1, FALSE, '`FundingSource`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FundingSource->Sortable = TRUE; // Allow sort
		$this->FundingSource->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FundingSource->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FundingSource->Lookup = new Lookup('FundingSource', 'funding_source', FALSE, 'FundingSource', ["FundingSource","","",""], [], [], [], [], [], [], '', '');
		$this->fields['FundingSource'] = &$this->FundingSource;

		// ProjectDocs
		$this->ProjectDocs = new DbField('project', 'project', 'x_ProjectDocs', 'ProjectDocs', '`ProjectDocs`', '`ProjectDocs`', 205, 0, -1, TRUE, '`ProjectDocs`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->ProjectDocs->Sortable = TRUE; // Allow sort
		$this->fields['ProjectDocs'] = &$this->ProjectDocs;

		// ProgressStatus
		$this->ProgressStatus = new DbField('project', 'project', 'x_ProgressStatus', 'ProgressStatus', '`ProgressStatus`', '`ProgressStatus`', 3, 11, -1, FALSE, '`ProgressStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProgressStatus->Sortable = TRUE; // Allow sort
		$this->ProgressStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProgressStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProgressStatus->Lookup = new Lookup('ProgressStatus', 'project_status', FALSE, 'ProjectStatusCode', ["ProjectStatusDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ProgressStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProgressStatus'] = &$this->ProgressStatus;

		// OutstandingTasks
		$this->OutstandingTasks = new DbField('project', 'project', 'x_OutstandingTasks', 'OutstandingTasks', '`OutstandingTasks`', '`OutstandingTasks`', 200, 255, -1, FALSE, '`OutstandingTasks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutstandingTasks->Sortable = TRUE; // Allow sort
		$this->fields['OutstandingTasks'] = &$this->OutstandingTasks;

		// LastUpdated
		$this->LastUpdated = new DbField('project', 'project', 'x_LastUpdated', 'LastUpdated', '`LastUpdated`', CastDateFieldForLike("`LastUpdated`", 0, "DB"), 133, 10, 0, FALSE, '`LastUpdated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdated->Sortable = TRUE; // Allow sort
		$this->LastUpdated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdated'] = &$this->LastUpdated;

		// CommnentsOnStatus
		$this->CommnentsOnStatus = new DbField('project', 'project', 'x_CommnentsOnStatus', 'CommnentsOnStatus', '`CommnentsOnStatus`', '`CommnentsOnStatus`', 201, 16777215, -1, FALSE, '`CommnentsOnStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->CommnentsOnStatus->Sortable = TRUE; // Allow sort
		$this->fields['CommnentsOnStatus'] = &$this->CommnentsOnStatus;

		// MoreDocs
		$this->MoreDocs = new DbField('project', 'project', 'x_MoreDocs', 'MoreDocs', '`MoreDocs`', '`MoreDocs`', 205, 0, -1, TRUE, '`MoreDocs`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->MoreDocs->Sortable = TRUE; // Allow sort
		$this->fields['MoreDocs'] = &$this->MoreDocs;
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
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->ProvinceCode->getSessionValue() != "")
				$masterFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
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
			if ($this->ProvinceCode->getSessionValue() != "")
				$detailFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_local_authority()
	{
		return "`ProvinceCode`=@ProvinceCode@ AND `LACode`='@LACode@'";
	}

	// Detail filter
	public function sqlDetailFilter_local_authority()
	{
		return "`ProvinceCode`=@ProvinceCode@ AND `LACode`='@LACode@'";
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
		if ($this->getCurrentDetailTable() == "activity") {
			$detailUrl = $GLOBALS["activity"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_SectionCode=" . urlencode($this->SectionCode->CurrentValue);
			$detailUrl .= "&fk_ProjectCode=" . urlencode($this->ProjectCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "projectlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`project`";
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
			$fldname = 'ProjectCode';
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
			if (array_key_exists('ProjectCode', $rs))
				AddFilter($where, QuotedName('ProjectCode', $this->Dbid) . '=' . QuotedValue($rs['ProjectCode'], $this->ProjectCode->DataType, $this->Dbid));
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
		$this->ProjectCode->DbValue = $row['ProjectCode'];
		$this->ProjectName->DbValue = $row['ProjectName'];
		$this->ProjectType->DbValue = $row['ProjectType'];
		$this->ProjectSector->DbValue = $row['ProjectSector'];
		$this->Contractors->DbValue = $row['Contractors'];
		$this->Projectdescription->DbValue = $row['Projectdescription'];
		$this->PlannedStartDate->DbValue = $row['PlannedStartDate'];
		$this->PlannedEndDate->DbValue = $row['PlannedEndDate'];
		$this->ActualStartDate->DbValue = $row['ActualStartDate'];
		$this->ActualEndDate->DbValue = $row['ActualEndDate'];
		$this->Budget->DbValue = $row['Budget'];
		$this->ExpenditureTodate->DbValue = $row['ExpenditureTodate'];
		$this->FundsReleased->DbValue = $row['FundsReleased'];
		$this->FundingSource->DbValue = $row['FundingSource'];
		$this->ProjectDocs->Upload->DbValue = $row['ProjectDocs'];
		$this->ProgressStatus->DbValue = $row['ProgressStatus'];
		$this->OutstandingTasks->DbValue = $row['OutstandingTasks'];
		$this->LastUpdated->DbValue = $row['LastUpdated'];
		$this->CommnentsOnStatus->DbValue = $row['CommnentsOnStatus'];
		$this->MoreDocs->Upload->DbValue = $row['MoreDocs'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ProjectCode` = '@ProjectCode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ProjectCode', $row) ? $row['ProjectCode'] : NULL;
		else
			$val = $this->ProjectCode->OldValue !== NULL ? $this->ProjectCode->OldValue : $this->ProjectCode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ProjectCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "projectlist.php";
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
		if ($pageName == "projectview.php")
			return $Language->phrase("View");
		elseif ($pageName == "projectedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "projectadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "projectlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("projectview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("projectview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "projectadd.php?" . $this->getUrlParm($parm);
		else
			$url = "projectadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("projectedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("projectedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("projectadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("projectadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("projectdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "local_authority" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ProjectCode:" . JsonEncode($this->ProjectCode->CurrentValue, "string");
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
		if ($this->ProjectCode->CurrentValue != NULL) {
			$url .= "ProjectCode=" . urlencode($this->ProjectCode->CurrentValue);
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
			if (Param("ProjectCode") !== NULL)
				$arKeys[] = Param("ProjectCode");
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
				$this->ProjectCode->CurrentValue = $key;
			else
				$this->ProjectCode->OldValue = $key;
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
		$this->ProjectCode->setDbValue($rs->fields('ProjectCode'));
		$this->ProjectName->setDbValue($rs->fields('ProjectName'));
		$this->ProjectType->setDbValue($rs->fields('ProjectType'));
		$this->ProjectSector->setDbValue($rs->fields('ProjectSector'));
		$this->Contractors->setDbValue($rs->fields('Contractors'));
		$this->Projectdescription->setDbValue($rs->fields('Projectdescription'));
		$this->PlannedStartDate->setDbValue($rs->fields('PlannedStartDate'));
		$this->PlannedEndDate->setDbValue($rs->fields('PlannedEndDate'));
		$this->ActualStartDate->setDbValue($rs->fields('ActualStartDate'));
		$this->ActualEndDate->setDbValue($rs->fields('ActualEndDate'));
		$this->Budget->setDbValue($rs->fields('Budget'));
		$this->ExpenditureTodate->setDbValue($rs->fields('ExpenditureTodate'));
		$this->FundsReleased->setDbValue($rs->fields('FundsReleased'));
		$this->FundingSource->setDbValue($rs->fields('FundingSource'));
		$this->ProjectDocs->Upload->DbValue = $rs->fields('ProjectDocs');
		$this->ProgressStatus->setDbValue($rs->fields('ProgressStatus'));
		$this->OutstandingTasks->setDbValue($rs->fields('OutstandingTasks'));
		$this->LastUpdated->setDbValue($rs->fields('LastUpdated'));
		$this->CommnentsOnStatus->setDbValue($rs->fields('CommnentsOnStatus'));
		$this->MoreDocs->Upload->DbValue = $rs->fields('MoreDocs');
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
		// ProjectCode
		// ProjectName
		// ProjectType
		// ProjectSector
		// Contractors
		// Projectdescription
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Budget
		// ExpenditureTodate
		// FundsReleased
		// FundingSource
		// ProjectDocs
		// ProgressStatus
		// OutstandingTasks
		// LastUpdated
		// CommnentsOnStatus
		// MoreDocs
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
		$this->ProjectCode->ViewCustomAttributes = "";

		// ProjectName
		$this->ProjectName->ViewValue = $this->ProjectName->CurrentValue;
		$this->ProjectName->ViewCustomAttributes = "";

		// ProjectType
		$curVal = strval($this->ProjectType->CurrentValue);
		if ($curVal != "") {
			$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
			if ($this->ProjectType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProjectType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProjectType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProjectType->ViewValue = $this->ProjectType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProjectType->ViewValue = $this->ProjectType->CurrentValue;
				}
			}
		} else {
			$this->ProjectType->ViewValue = NULL;
		}
		$this->ProjectType->ViewCustomAttributes = "";

		// ProjectSector
		$curVal = strval($this->ProjectSector->CurrentValue);
		if ($curVal != "") {
			$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
			if ($this->ProjectSector->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProjectSector`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProjectSector->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProjectSector->ViewValue = $this->ProjectSector->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProjectSector->ViewValue = $this->ProjectSector->CurrentValue;
				}
			}
		} else {
			$this->ProjectSector->ViewValue = NULL;
		}
		$this->ProjectSector->ViewCustomAttributes = "";

		// Contractors
		$this->Contractors->ViewValue = $this->Contractors->CurrentValue;
		$this->Contractors->ViewCustomAttributes = "";

		// Projectdescription
		$this->Projectdescription->ViewValue = $this->Projectdescription->CurrentValue;
		$this->Projectdescription->ViewCustomAttributes = "";

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

		// Budget
		$this->Budget->ViewValue = $this->Budget->CurrentValue;
		$this->Budget->ViewValue = FormatNumber($this->Budget->ViewValue, 2, -2, -2, -2);
		$this->Budget->CellCssStyle .= "text-align: right;";
		$this->Budget->ViewCustomAttributes = "";

		// ExpenditureTodate
		$this->ExpenditureTodate->ViewValue = $this->ExpenditureTodate->CurrentValue;
		$this->ExpenditureTodate->ViewValue = FormatNumber($this->ExpenditureTodate->ViewValue, 2, -2, -2, -2);
		$this->ExpenditureTodate->CellCssStyle .= "text-align: right;";
		$this->ExpenditureTodate->ViewCustomAttributes = "";

		// FundsReleased
		$this->FundsReleased->ViewValue = $this->FundsReleased->CurrentValue;
		$this->FundsReleased->ViewValue = FormatNumber($this->FundsReleased->ViewValue, 2, -2, -2, -2);
		$this->FundsReleased->CellCssStyle .= "text-align: right;";
		$this->FundsReleased->ViewCustomAttributes = "";

		// FundingSource
		$curVal = strval($this->FundingSource->CurrentValue);
		if ($curVal != "") {
			$this->FundingSource->ViewValue = $this->FundingSource->lookupCacheOption($curVal);
			if ($this->FundingSource->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`FundingSource`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->FundingSource->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FundingSource->ViewValue = $this->FundingSource->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FundingSource->ViewValue = $this->FundingSource->CurrentValue;
				}
			}
		} else {
			$this->FundingSource->ViewValue = NULL;
		}
		$this->FundingSource->ViewCustomAttributes = "";

		// ProjectDocs
		if (!EmptyValue($this->ProjectDocs->Upload->DbValue)) {
			$this->ProjectDocs->ViewValue = $this->ProjectCode->CurrentValue;
			$this->ProjectDocs->IsBlobImage = IsImageFile(ContentExtension($this->ProjectDocs->Upload->DbValue));
		} else {
			$this->ProjectDocs->ViewValue = "";
		}
		$this->ProjectDocs->ViewCustomAttributes = "";

		// ProgressStatus
		$curVal = strval($this->ProgressStatus->CurrentValue);
		if ($curVal != "") {
			$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
			if ($this->ProgressStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProjectStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProgressStatus->ViewValue = $this->ProgressStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProgressStatus->ViewValue = $this->ProgressStatus->CurrentValue;
				}
			}
		} else {
			$this->ProgressStatus->ViewValue = NULL;
		}
		$this->ProgressStatus->ViewCustomAttributes = "";

		// OutstandingTasks
		$this->OutstandingTasks->ViewValue = $this->OutstandingTasks->CurrentValue;
		$this->OutstandingTasks->ViewCustomAttributes = "";

		// LastUpdated
		$this->LastUpdated->ViewValue = $this->LastUpdated->CurrentValue;
		$this->LastUpdated->ViewValue = FormatDateTime($this->LastUpdated->ViewValue, 0);
		$this->LastUpdated->ViewCustomAttributes = "";

		// CommnentsOnStatus
		$this->CommnentsOnStatus->ViewValue = $this->CommnentsOnStatus->CurrentValue;
		$this->CommnentsOnStatus->ViewCustomAttributes = "";

		// MoreDocs
		if (!EmptyValue($this->MoreDocs->Upload->DbValue)) {
			$this->MoreDocs->ViewValue = $this->ProjectCode->CurrentValue;
			$this->MoreDocs->IsBlobImage = IsImageFile(ContentExtension($this->MoreDocs->Upload->DbValue));
		} else {
			$this->MoreDocs->ViewValue = "";
		}
		$this->MoreDocs->ViewCustomAttributes = "";

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

		// ProjectCode
		$this->ProjectCode->LinkCustomAttributes = "";
		$this->ProjectCode->HrefValue = "";
		$this->ProjectCode->TooltipValue = "";

		// ProjectName
		$this->ProjectName->LinkCustomAttributes = "";
		$this->ProjectName->HrefValue = "";
		$this->ProjectName->TooltipValue = "";

		// ProjectType
		$this->ProjectType->LinkCustomAttributes = "";
		$this->ProjectType->HrefValue = "";
		$this->ProjectType->TooltipValue = "";

		// ProjectSector
		$this->ProjectSector->LinkCustomAttributes = "";
		$this->ProjectSector->HrefValue = "";
		$this->ProjectSector->TooltipValue = "";

		// Contractors
		$this->Contractors->LinkCustomAttributes = "";
		$this->Contractors->HrefValue = "";
		$this->Contractors->TooltipValue = "";

		// Projectdescription
		$this->Projectdescription->LinkCustomAttributes = "";
		$this->Projectdescription->HrefValue = "";
		$this->Projectdescription->TooltipValue = "";

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

		// Budget
		$this->Budget->LinkCustomAttributes = "";
		$this->Budget->HrefValue = "";
		$this->Budget->TooltipValue = "";

		// ExpenditureTodate
		$this->ExpenditureTodate->LinkCustomAttributes = "";
		$this->ExpenditureTodate->HrefValue = "";
		$this->ExpenditureTodate->TooltipValue = "";

		// FundsReleased
		$this->FundsReleased->LinkCustomAttributes = "";
		$this->FundsReleased->HrefValue = "";
		$this->FundsReleased->TooltipValue = "";

		// FundingSource
		$this->FundingSource->LinkCustomAttributes = "";
		$this->FundingSource->HrefValue = "";
		$this->FundingSource->TooltipValue = "";

		// ProjectDocs
		$this->ProjectDocs->LinkCustomAttributes = "";
		if (!empty($this->ProjectDocs->Upload->DbValue)) {
			$this->ProjectDocs->HrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);
			$this->ProjectDocs->LinkAttrs["target"] = "";
			if ($this->ProjectDocs->IsBlobImage && empty($this->ProjectDocs->LinkAttrs["target"]))
				$this->ProjectDocs->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->ProjectDocs->HrefValue = FullUrl($this->ProjectDocs->HrefValue, "href");
		} else {
			$this->ProjectDocs->HrefValue = "";
		}
		$this->ProjectDocs->ExportHrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);
		$this->ProjectDocs->TooltipValue = "";

		// ProgressStatus
		$this->ProgressStatus->LinkCustomAttributes = "";
		$this->ProgressStatus->HrefValue = "";
		$this->ProgressStatus->TooltipValue = "";

		// OutstandingTasks
		$this->OutstandingTasks->LinkCustomAttributes = "";
		$this->OutstandingTasks->HrefValue = "";
		$this->OutstandingTasks->TooltipValue = "";

		// LastUpdated
		$this->LastUpdated->LinkCustomAttributes = "";
		$this->LastUpdated->HrefValue = "";
		$this->LastUpdated->TooltipValue = "";

		// CommnentsOnStatus
		$this->CommnentsOnStatus->LinkCustomAttributes = "";
		$this->CommnentsOnStatus->HrefValue = "";
		$this->CommnentsOnStatus->TooltipValue = "";

		// MoreDocs
		$this->MoreDocs->LinkCustomAttributes = "";
		if (!empty($this->MoreDocs->Upload->DbValue)) {
			$this->MoreDocs->HrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
			$this->MoreDocs->LinkAttrs["target"] = "";
			if ($this->MoreDocs->IsBlobImage && empty($this->MoreDocs->LinkAttrs["target"]))
				$this->MoreDocs->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->MoreDocs->HrefValue = FullUrl($this->MoreDocs->HrefValue, "href");
		} else {
			$this->MoreDocs->HrefValue = "";
		}
		$this->MoreDocs->ExportHrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
		$this->MoreDocs->TooltipValue = "";

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

		// ProjectName
		$this->ProjectName->EditAttrs["class"] = "form-control";
		$this->ProjectName->EditCustomAttributes = "";
		if (!$this->ProjectName->Raw)
			$this->ProjectName->CurrentValue = HtmlDecode($this->ProjectName->CurrentValue);
		$this->ProjectName->EditValue = $this->ProjectName->CurrentValue;
		$this->ProjectName->PlaceHolder = RemoveHtml($this->ProjectName->caption());

		// ProjectType
		$this->ProjectType->EditAttrs["class"] = "form-control";
		$this->ProjectType->EditCustomAttributes = "";

		// ProjectSector
		$this->ProjectSector->EditAttrs["class"] = "form-control";
		$this->ProjectSector->EditCustomAttributes = "";

		// Contractors
		$this->Contractors->EditAttrs["class"] = "form-control";
		$this->Contractors->EditCustomAttributes = "";
		$this->Contractors->EditValue = $this->Contractors->CurrentValue;
		$this->Contractors->PlaceHolder = RemoveHtml($this->Contractors->caption());

		// Projectdescription
		$this->Projectdescription->EditAttrs["class"] = "form-control";
		$this->Projectdescription->EditCustomAttributes = "";
		$this->Projectdescription->EditValue = $this->Projectdescription->CurrentValue;
		$this->Projectdescription->PlaceHolder = RemoveHtml($this->Projectdescription->caption());

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

		// Budget
		$this->Budget->EditAttrs["class"] = "form-control";
		$this->Budget->EditCustomAttributes = "";
		$this->Budget->EditValue = $this->Budget->CurrentValue;
		$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());
		if (strval($this->Budget->EditValue) != "" && is_numeric($this->Budget->EditValue))
			$this->Budget->EditValue = FormatNumber($this->Budget->EditValue, -2, -2, -2, -2);
		

		// ExpenditureTodate
		$this->ExpenditureTodate->EditAttrs["class"] = "form-control";
		$this->ExpenditureTodate->EditCustomAttributes = "";
		$this->ExpenditureTodate->EditValue = $this->ExpenditureTodate->CurrentValue;
		$this->ExpenditureTodate->PlaceHolder = RemoveHtml($this->ExpenditureTodate->caption());
		if (strval($this->ExpenditureTodate->EditValue) != "" && is_numeric($this->ExpenditureTodate->EditValue))
			$this->ExpenditureTodate->EditValue = FormatNumber($this->ExpenditureTodate->EditValue, -2, -2, -2, -2);
		

		// FundsReleased
		$this->FundsReleased->EditAttrs["class"] = "form-control";
		$this->FundsReleased->EditCustomAttributes = "";
		$this->FundsReleased->EditValue = $this->FundsReleased->CurrentValue;
		$this->FundsReleased->PlaceHolder = RemoveHtml($this->FundsReleased->caption());
		if (strval($this->FundsReleased->EditValue) != "" && is_numeric($this->FundsReleased->EditValue))
			$this->FundsReleased->EditValue = FormatNumber($this->FundsReleased->EditValue, -2, -2, -2, -2);
		

		// FundingSource
		$this->FundingSource->EditAttrs["class"] = "form-control";
		$this->FundingSource->EditCustomAttributes = "";

		// ProjectDocs
		$this->ProjectDocs->EditAttrs["class"] = "form-control";
		$this->ProjectDocs->EditCustomAttributes = "";
		if (!EmptyValue($this->ProjectDocs->Upload->DbValue)) {
			$this->ProjectDocs->EditValue = $this->ProjectCode->CurrentValue;
			$this->ProjectDocs->IsBlobImage = IsImageFile(ContentExtension($this->ProjectDocs->Upload->DbValue));
		} else {
			$this->ProjectDocs->EditValue = "";
		}

		// ProgressStatus
		$this->ProgressStatus->EditAttrs["class"] = "form-control";
		$this->ProgressStatus->EditCustomAttributes = "";

		// OutstandingTasks
		$this->OutstandingTasks->EditAttrs["class"] = "form-control";
		$this->OutstandingTasks->EditCustomAttributes = "";
		$this->OutstandingTasks->EditValue = $this->OutstandingTasks->CurrentValue;
		$this->OutstandingTasks->PlaceHolder = RemoveHtml($this->OutstandingTasks->caption());

		// LastUpdated
		$this->LastUpdated->EditAttrs["class"] = "form-control";
		$this->LastUpdated->EditCustomAttributes = "";
		$this->LastUpdated->EditValue = FormatDateTime($this->LastUpdated->CurrentValue, 8);
		$this->LastUpdated->PlaceHolder = RemoveHtml($this->LastUpdated->caption());

		// CommnentsOnStatus
		$this->CommnentsOnStatus->EditAttrs["class"] = "form-control";
		$this->CommnentsOnStatus->EditCustomAttributes = "";
		$this->CommnentsOnStatus->EditValue = $this->CommnentsOnStatus->CurrentValue;
		$this->CommnentsOnStatus->PlaceHolder = RemoveHtml($this->CommnentsOnStatus->caption());

		// MoreDocs
		$this->MoreDocs->EditAttrs["class"] = "form-control";
		$this->MoreDocs->EditCustomAttributes = "";
		if (!EmptyValue($this->MoreDocs->Upload->DbValue)) {
			$this->MoreDocs->EditValue = $this->ProjectCode->CurrentValue;
			$this->MoreDocs->IsBlobImage = IsImageFile(ContentExtension($this->MoreDocs->Upload->DbValue));
		} else {
			$this->MoreDocs->EditValue = "";
		}

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
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ProjectName);
					$doc->exportCaption($this->ProjectType);
					$doc->exportCaption($this->ProjectSector);
					$doc->exportCaption($this->Contractors);
					$doc->exportCaption($this->Projectdescription);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Budget);
					$doc->exportCaption($this->ExpenditureTodate);
					$doc->exportCaption($this->FundsReleased);
					$doc->exportCaption($this->FundingSource);
					$doc->exportCaption($this->ProjectDocs);
					$doc->exportCaption($this->ProgressStatus);
					$doc->exportCaption($this->OutstandingTasks);
					$doc->exportCaption($this->LastUpdated);
					$doc->exportCaption($this->CommnentsOnStatus);
					$doc->exportCaption($this->MoreDocs);
				} else {
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProjectCode);
					$doc->exportCaption($this->ProjectName);
					$doc->exportCaption($this->ProjectType);
					$doc->exportCaption($this->ProjectSector);
					$doc->exportCaption($this->Contractors);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Budget);
					$doc->exportCaption($this->ExpenditureTodate);
					$doc->exportCaption($this->FundsReleased);
					$doc->exportCaption($this->FundingSource);
					$doc->exportCaption($this->ProgressStatus);
					$doc->exportCaption($this->OutstandingTasks);
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
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ProjectName);
						$doc->exportField($this->ProjectType);
						$doc->exportField($this->ProjectSector);
						$doc->exportField($this->Contractors);
						$doc->exportField($this->Projectdescription);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Budget);
						$doc->exportField($this->ExpenditureTodate);
						$doc->exportField($this->FundsReleased);
						$doc->exportField($this->FundingSource);
						$doc->exportField($this->ProjectDocs);
						$doc->exportField($this->ProgressStatus);
						$doc->exportField($this->OutstandingTasks);
						$doc->exportField($this->LastUpdated);
						$doc->exportField($this->CommnentsOnStatus);
						$doc->exportField($this->MoreDocs);
					} else {
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProjectCode);
						$doc->exportField($this->ProjectName);
						$doc->exportField($this->ProjectType);
						$doc->exportField($this->ProjectSector);
						$doc->exportField($this->Contractors);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Budget);
						$doc->exportField($this->ExpenditureTodate);
						$doc->exportField($this->FundsReleased);
						$doc->exportField($this->FundingSource);
						$doc->exportField($this->ProgressStatus);
						$doc->exportField($this->OutstandingTasks);
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
		if ($fldparm == 'ProjectDocs') {
			$fldName = "ProjectDocs";
		} elseif ($fldparm == 'MoreDocs') {
			$fldName = "MoreDocs";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->ProjectCode->CurrentValue = $ar[0];
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'project';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'project';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ProjectCode'];

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
		$table = 'project';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ProjectCode'];

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
		$table = 'project';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ProjectCode'];

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
		if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT security_matrix.ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }

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
		and musers.username = '" . $username .  "')  ");  } 
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

		$pstart = strtotime($rsnew["PlannedStartDate"]);  
		$pend = strtotime($rsnew["PlannedEndDate"]);
		if ($pend < $pstart) {

			// Return error 
			$this->CancelMessage =  "Planned start date should not be later than planned end date " ;
			 return FALSE;     
		 }
		$astart = strtotime($rsnew["ActualStartDate"]);  
		$aend = strtotime($rsnew["ActualEndDate"]);
		if ($aend < $astart) {

			// Return error
			$this->CancelMessage =  "Actual start date should not be later than actual end date " ;
			 return FALSE;     
		 } 
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

		$pstart = strtotime($rsnew["PlannedStartDate"]);  
		$pend = strtotime($rsnew["PlannedEndDate"]);
		if ($pstart === NULL) {
		    $pstart = strtotime($rsold["PlannedStartDate"]);
		    }
		if ($pend === NULL) {
		    $pend = strtotime($rsold["PlannedEndDate"]);
		    }
		if ($pend < $pstart) {

			// Return error if start date date later that end date
			$this->CancelMessage =  "Planned start date should not be later than planned end date " ;
			 return FALSE;     
		 }
		$astart = strtotime($rsnew["ActualStartDate"]);  
		$aend = strtotime($rsnew["ActualEndDate"]);
		if ($astart === NULL) {
		    $astart = strtotime($rsold["ActualStartDate"]);
		    }
		if ($aend === NULL) {
		    $aend = strtotime($rsold["ActualEndDate"]);
		    }
		if ($aend < $astart) {

			// Return error if start date date later that end date
			$this->CancelMessage =  "Actual start date should not be later than actual end date " ;
			 return FALSE;     
		 } 
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

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	/*	$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if ($fld->Name == "ProvinceCode") {
			if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT ProvinceCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set lookup filter for local authority
		$la = executeRow("select count(security_matrix.LACode)as kountla 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.LACode is not null  
		and musers.username = '" . $username .     "'  ");
		if ($fld->Name == "LACode") {
			if(($levelid <> -1) && ($la["kountla"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`LACode`  in   (select DISTINCT security_matrix.LACode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set filter for departments in LA	
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");
			if ($fld->Name == "Department") {
			if(($levelid <> -1) && ($dept["kountdept"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`DepartmentCode`  in   (select DISTINCT DepartmentCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set filter for sections
		$sect = executeRow("select count(security_matrix.SectionCode)as kountsect 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.SectionCode is not null  
		and musers.username = '" . $username .     "'  ");
			if ($fld->Name == "SectionCode") {
			if(($levelid <> -1) && ($sect["kountsect"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`SectionCode`  in   (select DISTINCT SectionCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			} 
		} */
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