<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for councillorship
 */
class councillorship extends DbTable
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
	public $EmployeeID;
	public $ProvinceCode;
	public $LACode;
	public $PoliticalParty;
	public $Occupation;
	public $PositionInCouncil;
	public $Committee;
	public $CommitteeRole;
	public $CouncilTerm;
	public $DateOfExit;
	public $Allowance;
	public $CouncillorTypeType;
	public $CouncillorshipStatus;
	public $ExitReason;
	public $RetirementType;
	public $CouncillorPhoto;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'councillorship';
		$this->TableName = 'councillorship';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`councillorship`";
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

		// EmployeeID
		$this->EmployeeID = new DbField('councillorship', 'councillorship', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->Lookup = new Lookup('EmployeeID', 'councillor', FALSE, 'EmployeeID', ["Surname","FirstName","NRC",""], [], [], [], [], [], [], '', '');
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// ProvinceCode
		$this->ProvinceCode = new DbField('councillorship', 'councillorship', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 4, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('councillorship', 'councillorship', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], [], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// PoliticalParty
		$this->PoliticalParty = new DbField('councillorship', 'councillorship', 'x_PoliticalParty', 'PoliticalParty', '`PoliticalParty`', '`PoliticalParty`', 200, 15, -1, FALSE, '`PoliticalParty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PoliticalParty->Sortable = TRUE; // Allow sort
		$this->PoliticalParty->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PoliticalParty->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PoliticalParty->Lookup = new Lookup('PoliticalParty', 'political_party', FALSE, 'PoliticalParty', ["PoliticalParty","","",""], [], [], [], [], [], [], '', '');
		$this->PoliticalParty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PoliticalParty'] = &$this->PoliticalParty;

		// Occupation
		$this->Occupation = new DbField('councillorship', 'councillorship', 'x_Occupation', 'Occupation', '`Occupation`', '`Occupation`', 16, 3, -1, FALSE, '`Occupation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Occupation->Sortable = TRUE; // Allow sort
		$this->Occupation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Occupation->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Occupation->Lookup = new Lookup('Occupation', 'occupation', FALSE, 'OccupationCode', ["OccupationName","","",""], [], [], [], [], [], [], '', '');
		$this->Occupation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Occupation'] = &$this->Occupation;

		// PositionInCouncil
		$this->PositionInCouncil = new DbField('councillorship', 'councillorship', 'x_PositionInCouncil', 'PositionInCouncil', '`PositionInCouncil`', '`PositionInCouncil`', 3, 11, -1, FALSE, '`PositionInCouncil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PositionInCouncil->IsPrimaryKey = TRUE; // Primary key field
		$this->PositionInCouncil->Nullable = FALSE; // NOT NULL field
		$this->PositionInCouncil->Required = TRUE; // Required field
		$this->PositionInCouncil->Sortable = TRUE; // Allow sort
		$this->PositionInCouncil->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PositionInCouncil->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PositionInCouncil->Lookup = new Lookup('PositionInCouncil', 'position_councillor', FALSE, 'PositionCode', ["PositionName","","",""], [], [], [], [], [], [], '', '');
		$this->PositionInCouncil->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PositionInCouncil'] = &$this->PositionInCouncil;

		// Committee
		$this->Committee = new DbField('councillorship', 'councillorship', 'x_Committee', 'Committee', '`Committee`', '`Committee`', 16, 3, -1, FALSE, '`Committee`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Committee->Sortable = TRUE; // Allow sort
		$this->Committee->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Committee->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Committee->Lookup = new Lookup('Committee', 'committee', FALSE, 'CommitteCode', ["CommitteeName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Committee'] = &$this->Committee;

		// CommitteeRole
		$this->CommitteeRole = new DbField('councillorship', 'councillorship', 'x_CommitteeRole', 'CommitteeRole', '`CommitteeRole`', '`CommitteeRole`', 3, 11, -1, FALSE, '`CommitteeRole`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CommitteeRole->Nullable = FALSE; // NOT NULL field
		$this->CommitteeRole->Required = TRUE; // Required field
		$this->CommitteeRole->Sortable = TRUE; // Allow sort
		$this->CommitteeRole->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CommitteeRole->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CommitteeRole->Lookup = new Lookup('CommitteeRole', 'committee_role', FALSE, 'CommitteeRole', ["CommitteeRoleDesc","","",""], [], [], [], [], [], [], '', '');
		$this->CommitteeRole->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CommitteeRole'] = &$this->CommitteeRole;

		// CouncilTerm
		$this->CouncilTerm = new DbField('councillorship', 'councillorship', 'x_CouncilTerm', 'CouncilTerm', '`CouncilTerm`', '`CouncilTerm`', 18, 4, -1, FALSE, '`CouncilTerm`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CouncilTerm->IsPrimaryKey = TRUE; // Primary key field
		$this->CouncilTerm->Nullable = FALSE; // NOT NULL field
		$this->CouncilTerm->Required = TRUE; // Required field
		$this->CouncilTerm->Sortable = TRUE; // Allow sort
		$this->CouncilTerm->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CouncilTerm->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CouncilTerm->Lookup = new Lookup('CouncilTerm', 'termcouncil_term', FALSE, 'TermStartYear', ["TermStartYear","TermYears","",""], [], [], [], [], [], [], '', '');
		$this->CouncilTerm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncilTerm'] = &$this->CouncilTerm;

		// DateOfExit
		$this->DateOfExit = new DbField('councillorship', 'councillorship', 'x_DateOfExit', 'DateOfExit', '`DateOfExit`', CastDateFieldForLike("`DateOfExit`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfExit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfExit->Sortable = TRUE; // Allow sort
		$this->DateOfExit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfExit'] = &$this->DateOfExit;

		// Allowance
		$this->Allowance = new DbField('councillorship', 'councillorship', 'x_Allowance', 'Allowance', '`Allowance`', '`Allowance`', 200, 10, -1, FALSE, '`Allowance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Allowance->Nullable = FALSE; // NOT NULL field
		$this->Allowance->Required = TRUE; // Required field
		$this->Allowance->Sortable = TRUE; // Allow sort
		$this->fields['Allowance'] = &$this->Allowance;

		// CouncillorTypeType
		$this->CouncillorTypeType = new DbField('councillorship', 'councillorship', 'x_CouncillorTypeType', 'CouncillorTypeType', '`CouncillorTypeType`', '`CouncillorTypeType`', 16, 3, -1, FALSE, '`CouncillorTypeType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CouncillorTypeType->Nullable = FALSE; // NOT NULL field
		$this->CouncillorTypeType->Required = TRUE; // Required field
		$this->CouncillorTypeType->Sortable = TRUE; // Allow sort
		$this->CouncillorTypeType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CouncillorTypeType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CouncillorTypeType->Lookup = new Lookup('CouncillorTypeType', 'councillor_type', FALSE, 'CouncillorType', ["CouncillorTYpeName","","",""], [], [], [], [], [], [], '', '');
		$this->CouncillorTypeType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncillorTypeType'] = &$this->CouncillorTypeType;

		// CouncillorshipStatus
		$this->CouncillorshipStatus = new DbField('councillorship', 'councillorship', 'x_CouncillorshipStatus', 'CouncillorshipStatus', '`CouncillorshipStatus`', '`CouncillorshipStatus`', 16, 3, -1, FALSE, '`CouncillorshipStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CouncillorshipStatus->Nullable = FALSE; // NOT NULL field
		$this->CouncillorshipStatus->Required = TRUE; // Required field
		$this->CouncillorshipStatus->Sortable = TRUE; // Allow sort
		$this->CouncillorshipStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CouncillorshipStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CouncillorshipStatus->Lookup = new Lookup('CouncillorshipStatus', 'councillorship_status', FALSE, 'CouncillorsipStatus', ["CouncillorshipStatusDesc","","",""], [], [], [], [], [], [], '', '');
		$this->CouncillorshipStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncillorshipStatus'] = &$this->CouncillorshipStatus;

		// ExitReason
		$this->ExitReason = new DbField('councillorship', 'councillorship', 'x_ExitReason', 'ExitReason', '`ExitReason`', '`ExitReason`', 16, 3, -1, FALSE, '`ExitReason`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ExitReason->Sortable = TRUE; // Allow sort
		$this->ExitReason->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ExitReason->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ExitReason->Lookup = new Lookup('ExitReason', 'councillorship_status', FALSE, 'CouncillorsipStatus', ["CouncillorshipStatusDesc","","",""], [], ["x_RetirementType"], [], [], [], [], '', '');
		$this->ExitReason->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ExitReason'] = &$this->ExitReason;

		// RetirementType
		$this->RetirementType = new DbField('councillorship', 'councillorship', 'x_RetirementType', 'RetirementType', '`RetirementType`', '`RetirementType`', 16, 4, -1, FALSE, '`RetirementType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RetirementType->Sortable = TRUE; // Allow sort
		$this->RetirementType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RetirementType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RetirementType->Lookup = new Lookup('RetirementType', 'retirement_type', FALSE, 'RetirementType', ["RetirementType","","",""], ["x_ExitReason"], [], ["ExitCode"], ["x_ExitCode"], [], [], '', '');
		$this->RetirementType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RetirementType'] = &$this->RetirementType;

		// CouncillorPhoto
		$this->CouncillorPhoto = new DbField('councillorship', 'councillorship', 'x_CouncillorPhoto', 'CouncillorPhoto', '`CouncillorPhoto`', '`CouncillorPhoto`', 205, 0, -1, TRUE, '`CouncillorPhoto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->CouncillorPhoto->Nullable = FALSE; // NOT NULL field
		$this->CouncillorPhoto->Required = TRUE; // Required field
		$this->CouncillorPhoto->Sortable = TRUE; // Allow sort
		$this->fields['CouncillorPhoto'] = &$this->CouncillorPhoto;
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
		if ($this->getCurrentMasterTable() == "councillor") {
			if ($this->EmployeeID->getSessionValue() != "")
				$masterFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->ProvinceCode->getSessionValue() != "")
				$masterFilter .= " AND `ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "councillor") {
			if ($this->EmployeeID->getSessionValue() != "")
				$detailFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "local_authority") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->ProvinceCode->getSessionValue() != "")
				$detailFilter .= " AND `ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_councillor()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Detail filter
	public function sqlDetailFilter_councillor()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Master filter
	public function sqlMasterFilter_local_authority()
	{
		return "`LACode`='@LACode@' AND `ProvinceCode`=@ProvinceCode@";
	}

	// Detail filter
	public function sqlDetailFilter_local_authority()
	{
		return "`LACode`='@LACode@' AND `ProvinceCode`=@ProvinceCode@";
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
		if ($this->getCurrentDetailTable() == "councillor_allowance") {
			$detailUrl = $GLOBALS["councillor_allowance"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "committee_appointed") {
			$detailUrl = $GLOBALS["committee_appointed"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "councillorshiplist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`councillorship`";
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
			$fldname = 'EmployeeID';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'LACode';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'PositionInCouncil';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'CouncilTerm';
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
			if (array_key_exists('EmployeeID', $rs))
				AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
			if (array_key_exists('LACode', $rs))
				AddFilter($where, QuotedName('LACode', $this->Dbid) . '=' . QuotedValue($rs['LACode'], $this->LACode->DataType, $this->Dbid));
			if (array_key_exists('PositionInCouncil', $rs))
				AddFilter($where, QuotedName('PositionInCouncil', $this->Dbid) . '=' . QuotedValue($rs['PositionInCouncil'], $this->PositionInCouncil->DataType, $this->Dbid));
			if (array_key_exists('CouncilTerm', $rs))
				AddFilter($where, QuotedName('CouncilTerm', $this->Dbid) . '=' . QuotedValue($rs['CouncilTerm'], $this->CouncilTerm->DataType, $this->Dbid));
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->PoliticalParty->DbValue = $row['PoliticalParty'];
		$this->Occupation->DbValue = $row['Occupation'];
		$this->PositionInCouncil->DbValue = $row['PositionInCouncil'];
		$this->Committee->DbValue = $row['Committee'];
		$this->CommitteeRole->DbValue = $row['CommitteeRole'];
		$this->CouncilTerm->DbValue = $row['CouncilTerm'];
		$this->DateOfExit->DbValue = $row['DateOfExit'];
		$this->Allowance->DbValue = $row['Allowance'];
		$this->CouncillorTypeType->DbValue = $row['CouncillorTypeType'];
		$this->CouncillorshipStatus->DbValue = $row['CouncillorshipStatus'];
		$this->ExitReason->DbValue = $row['ExitReason'];
		$this->RetirementType->DbValue = $row['RetirementType'];
		$this->CouncillorPhoto->Upload->DbValue = $row['CouncillorPhoto'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `LACode` = '@LACode@' AND `PositionInCouncil` = @PositionInCouncil@ AND `CouncilTerm` = @CouncilTerm@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('EmployeeID', $row) ? $row['EmployeeID'] : NULL;
		else
			$val = $this->EmployeeID->OldValue !== NULL ? $this->EmployeeID->OldValue : $this->EmployeeID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@EmployeeID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('LACode', $row) ? $row['LACode'] : NULL;
		else
			$val = $this->LACode->OldValue !== NULL ? $this->LACode->OldValue : $this->LACode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LACode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('PositionInCouncil', $row) ? $row['PositionInCouncil'] : NULL;
		else
			$val = $this->PositionInCouncil->OldValue !== NULL ? $this->PositionInCouncil->OldValue : $this->PositionInCouncil->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@PositionInCouncil@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('CouncilTerm', $row) ? $row['CouncilTerm'] : NULL;
		else
			$val = $this->CouncilTerm->OldValue !== NULL ? $this->CouncilTerm->OldValue : $this->CouncilTerm->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@CouncilTerm@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "councillorshiplist.php";
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
		if ($pageName == "councillorshipview.php")
			return $Language->phrase("View");
		elseif ($pageName == "councillorshipedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "councillorshipadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "councillorshiplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("councillorshipview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councillorshipview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "councillorshipadd.php?" . $this->getUrlParm($parm);
		else
			$url = "councillorshipadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("councillorshipedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councillorshipedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("councillorshipadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councillorshipadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("councillorshipdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "councillor" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "local_authority" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
		$json .= ",LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
		$json .= ",PositionInCouncil:" . JsonEncode($this->PositionInCouncil->CurrentValue, "number");
		$json .= ",CouncilTerm:" . JsonEncode($this->CouncilTerm->CurrentValue, "number");
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
		if ($this->EmployeeID->CurrentValue != NULL) {
			$url .= "EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "&LACode=" . urlencode($this->LACode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->PositionInCouncil->CurrentValue != NULL) {
			$url .= "&PositionInCouncil=" . urlencode($this->PositionInCouncil->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->CouncilTerm->CurrentValue != NULL) {
			$url .= "&CouncilTerm=" . urlencode($this->CouncilTerm->CurrentValue);
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
			if (Param("EmployeeID") !== NULL)
				$arKey[] = Param("EmployeeID");
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
			if (Param("PositionInCouncil") !== NULL)
				$arKey[] = Param("PositionInCouncil");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (Param("CouncilTerm") !== NULL)
				$arKey[] = Param("CouncilTerm");
			elseif (IsApi() && Key(3) !== NULL)
				$arKey[] = Key(3);
			elseif (IsApi() && Route(5) !== NULL)
				$arKey[] = Route(5);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 4)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // EmployeeID
					continue;
				if (!is_numeric($key[2])) // PositionInCouncil
					continue;
				if (!is_numeric($key[3])) // CouncilTerm
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
				$this->EmployeeID->CurrentValue = $key[0];
			else
				$this->EmployeeID->OldValue = $key[0];
			if ($setCurrent)
				$this->LACode->CurrentValue = $key[1];
			else
				$this->LACode->OldValue = $key[1];
			if ($setCurrent)
				$this->PositionInCouncil->CurrentValue = $key[2];
			else
				$this->PositionInCouncil->OldValue = $key[2];
			if ($setCurrent)
				$this->CouncilTerm->CurrentValue = $key[3];
			else
				$this->CouncilTerm->OldValue = $key[3];
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
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->PoliticalParty->setDbValue($rs->fields('PoliticalParty'));
		$this->Occupation->setDbValue($rs->fields('Occupation'));
		$this->PositionInCouncil->setDbValue($rs->fields('PositionInCouncil'));
		$this->Committee->setDbValue($rs->fields('Committee'));
		$this->CommitteeRole->setDbValue($rs->fields('CommitteeRole'));
		$this->CouncilTerm->setDbValue($rs->fields('CouncilTerm'));
		$this->DateOfExit->setDbValue($rs->fields('DateOfExit'));
		$this->Allowance->setDbValue($rs->fields('Allowance'));
		$this->CouncillorTypeType->setDbValue($rs->fields('CouncillorTypeType'));
		$this->CouncillorshipStatus->setDbValue($rs->fields('CouncillorshipStatus'));
		$this->ExitReason->setDbValue($rs->fields('ExitReason'));
		$this->RetirementType->setDbValue($rs->fields('RetirementType'));
		$this->CouncillorPhoto->Upload->DbValue = $rs->fields('CouncillorPhoto');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// ProvinceCode
		// LACode
		// PoliticalParty
		// Occupation
		// PositionInCouncil
		// Committee
		// CommitteeRole
		// CouncilTerm
		// DateOfExit
		// Allowance
		// CouncillorTypeType
		// CouncillorshipStatus
		// ExitReason
		// RetirementType
		// CouncillorPhoto
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$curVal = strval($this->EmployeeID->CurrentValue);
		if ($curVal != "") {
			$this->EmployeeID->ViewValue = $this->EmployeeID->lookupCacheOption($curVal);
			if ($this->EmployeeID->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`EmployeeID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->EmployeeID->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->EmployeeID->ViewValue = $this->EmployeeID->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
				}
			}
		} else {
			$this->EmployeeID->ViewValue = NULL;
		}
		$this->EmployeeID->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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

		// PoliticalParty
		$curVal = strval($this->PoliticalParty->CurrentValue);
		if ($curVal != "") {
			$this->PoliticalParty->ViewValue = $this->PoliticalParty->lookupCacheOption($curVal);
			if ($this->PoliticalParty->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PoliticalParty`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PoliticalParty->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PoliticalParty->ViewValue = $this->PoliticalParty->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PoliticalParty->ViewValue = $this->PoliticalParty->CurrentValue;
				}
			}
		} else {
			$this->PoliticalParty->ViewValue = NULL;
		}
		$this->PoliticalParty->ViewCustomAttributes = "";

		// Occupation
		$curVal = strval($this->Occupation->CurrentValue);
		if ($curVal != "") {
			$this->Occupation->ViewValue = $this->Occupation->lookupCacheOption($curVal);
			if ($this->Occupation->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OccupationCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Occupation->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Occupation->ViewValue = $this->Occupation->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Occupation->ViewValue = $this->Occupation->CurrentValue;
				}
			}
		} else {
			$this->Occupation->ViewValue = NULL;
		}
		$this->Occupation->ViewCustomAttributes = "";

		// PositionInCouncil
		$curVal = strval($this->PositionInCouncil->CurrentValue);
		if ($curVal != "") {
			$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
			if ($this->PositionInCouncil->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PositionInCouncil->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
				}
			}
		} else {
			$this->PositionInCouncil->ViewValue = NULL;
		}
		$this->PositionInCouncil->ViewCustomAttributes = "";

		// Committee
		$curVal = strval($this->Committee->CurrentValue);
		if ($curVal != "") {
			$this->Committee->ViewValue = $this->Committee->lookupCacheOption($curVal);
			if ($this->Committee->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CommitteCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Committee->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Committee->ViewValue = $this->Committee->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Committee->ViewValue = $this->Committee->CurrentValue;
				}
			}
		} else {
			$this->Committee->ViewValue = NULL;
		}
		$this->Committee->ViewCustomAttributes = "";

		// CommitteeRole
		$curVal = strval($this->CommitteeRole->CurrentValue);
		if ($curVal != "") {
			$this->CommitteeRole->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
			if ($this->CommitteeRole->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CommitteeRole`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CommitteeRole->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CommitteeRole->ViewValue = $this->CommitteeRole->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CommitteeRole->ViewValue = $this->CommitteeRole->CurrentValue;
				}
			}
		} else {
			$this->CommitteeRole->ViewValue = NULL;
		}
		$this->CommitteeRole->ViewCustomAttributes = "";

		// CouncilTerm
		$curVal = strval($this->CouncilTerm->CurrentValue);
		if ($curVal != "") {
			$this->CouncilTerm->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
			if ($this->CouncilTerm->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`TermStartYear`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncilTerm->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), Config("DEFAULT_DECIMAL_PRECISION"));
					$this->CouncilTerm->ViewValue = $this->CouncilTerm->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
				}
			}
		} else {
			$this->CouncilTerm->ViewValue = NULL;
		}
		$this->CouncilTerm->ViewCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
		$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
		$this->DateOfExit->ViewCustomAttributes = "";

		// Allowance
		$this->Allowance->ViewValue = $this->Allowance->CurrentValue;
		$this->Allowance->CellCssStyle .= "text-align: right;";
		$this->Allowance->ViewCustomAttributes = "";

		// CouncillorTypeType
		$curVal = strval($this->CouncillorTypeType->CurrentValue);
		if ($curVal != "") {
			$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->lookupCacheOption($curVal);
			if ($this->CouncillorTypeType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CouncillorType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncillorTypeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->CurrentValue;
				}
			}
		} else {
			$this->CouncillorTypeType->ViewValue = NULL;
		}
		$this->CouncillorTypeType->ViewCustomAttributes = "";

		// CouncillorshipStatus
		$curVal = strval($this->CouncillorshipStatus->CurrentValue);
		if ($curVal != "") {
			$this->CouncillorshipStatus->ViewValue = $this->CouncillorshipStatus->lookupCacheOption($curVal);
			if ($this->CouncillorshipStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncillorshipStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CouncillorshipStatus->ViewValue = $this->CouncillorshipStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncillorshipStatus->ViewValue = $this->CouncillorshipStatus->CurrentValue;
				}
			}
		} else {
			$this->CouncillorshipStatus->ViewValue = NULL;
		}
		$this->CouncillorshipStatus->ViewCustomAttributes = "";

		// ExitReason
		$curVal = strval($this->ExitReason->CurrentValue);
		if ($curVal != "") {
			$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
			if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ExitReason->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ExitReason->ViewValue = $this->ExitReason->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
				}
			}
		} else {
			$this->ExitReason->ViewValue = NULL;
		}
		$this->ExitReason->ViewCustomAttributes = "";

		// RetirementType
		$curVal = strval($this->RetirementType->CurrentValue);
		if ($curVal != "") {
			$this->RetirementType->ViewValue = $this->RetirementType->lookupCacheOption($curVal);
			if ($this->RetirementType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`RetirementType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->RetirementType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RetirementType->ViewValue = $this->RetirementType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RetirementType->ViewValue = $this->RetirementType->CurrentValue;
				}
			}
		} else {
			$this->RetirementType->ViewValue = NULL;
		}
		$this->RetirementType->ViewCustomAttributes = "";

		// CouncillorPhoto
		if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue;
			$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
		} else {
			$this->CouncillorPhoto->ViewValue = "";
		}
		$this->CouncillorPhoto->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// PoliticalParty
		$this->PoliticalParty->LinkCustomAttributes = "";
		$this->PoliticalParty->HrefValue = "";
		$this->PoliticalParty->TooltipValue = "";

		// Occupation
		$this->Occupation->LinkCustomAttributes = "";
		$this->Occupation->HrefValue = "";
		$this->Occupation->TooltipValue = "";

		// PositionInCouncil
		$this->PositionInCouncil->LinkCustomAttributes = "";
		$this->PositionInCouncil->HrefValue = "";
		$this->PositionInCouncil->TooltipValue = "";

		// Committee
		$this->Committee->LinkCustomAttributes = "";
		$this->Committee->HrefValue = "";
		$this->Committee->TooltipValue = "";

		// CommitteeRole
		$this->CommitteeRole->LinkCustomAttributes = "";
		$this->CommitteeRole->HrefValue = "";
		$this->CommitteeRole->TooltipValue = "";

		// CouncilTerm
		$this->CouncilTerm->LinkCustomAttributes = "";
		$this->CouncilTerm->HrefValue = "";
		$this->CouncilTerm->TooltipValue = "";

		// DateOfExit
		$this->DateOfExit->LinkCustomAttributes = "";
		$this->DateOfExit->HrefValue = "";
		$this->DateOfExit->TooltipValue = "";

		// Allowance
		$this->Allowance->LinkCustomAttributes = "";
		$this->Allowance->HrefValue = "";
		$this->Allowance->TooltipValue = "";

		// CouncillorTypeType
		$this->CouncillorTypeType->LinkCustomAttributes = "";
		$this->CouncillorTypeType->HrefValue = "";
		$this->CouncillorTypeType->TooltipValue = "";

		// CouncillorshipStatus
		$this->CouncillorshipStatus->LinkCustomAttributes = "";
		$this->CouncillorshipStatus->HrefValue = "";
		$this->CouncillorshipStatus->TooltipValue = "";

		// ExitReason
		$this->ExitReason->LinkCustomAttributes = "";
		$this->ExitReason->HrefValue = "";
		$this->ExitReason->TooltipValue = "";

		// RetirementType
		$this->RetirementType->LinkCustomAttributes = "";
		$this->RetirementType->HrefValue = "";
		$this->RetirementType->TooltipValue = "";

		// CouncillorPhoto
		$this->CouncillorPhoto->LinkCustomAttributes = "";
		if (!empty($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->HrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
			$this->CouncillorPhoto->LinkAttrs["target"] = "";
			if ($this->CouncillorPhoto->IsBlobImage && empty($this->CouncillorPhoto->LinkAttrs["target"]))
				$this->CouncillorPhoto->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->CouncillorPhoto->HrefValue = FullUrl($this->CouncillorPhoto->HrefValue, "href");
		} else {
			$this->CouncillorPhoto->HrefValue = "";
		}
		$this->CouncillorPhoto->ExportHrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
		$this->CouncillorPhoto->TooltipValue = "";

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

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";
		if ($this->ProvinceCode->getSessionValue() != "") {
			$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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
			$this->ProvinceCode->EditValue = $this->ProvinceCode->CurrentValue;
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());
		}

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// PoliticalParty
		$this->PoliticalParty->EditAttrs["class"] = "form-control";
		$this->PoliticalParty->EditCustomAttributes = "";

		// Occupation
		$this->Occupation->EditAttrs["class"] = "form-control";
		$this->Occupation->EditCustomAttributes = "";

		// PositionInCouncil
		$this->PositionInCouncil->EditAttrs["class"] = "form-control";
		$this->PositionInCouncil->EditCustomAttributes = "";

		// Committee
		$this->Committee->EditAttrs["class"] = "form-control";
		$this->Committee->EditCustomAttributes = "";

		// CommitteeRole
		$this->CommitteeRole->EditAttrs["class"] = "form-control";
		$this->CommitteeRole->EditCustomAttributes = "";

		// CouncilTerm
		$this->CouncilTerm->EditAttrs["class"] = "form-control";
		$this->CouncilTerm->EditCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->EditAttrs["class"] = "form-control";
		$this->DateOfExit->EditCustomAttributes = "";
		$this->DateOfExit->EditValue = FormatDateTime($this->DateOfExit->CurrentValue, 8);
		$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

		// Allowance
		$this->Allowance->EditAttrs["class"] = "form-control";
		$this->Allowance->EditCustomAttributes = "";
		if (!$this->Allowance->Raw)
			$this->Allowance->CurrentValue = HtmlDecode($this->Allowance->CurrentValue);
		$this->Allowance->EditValue = $this->Allowance->CurrentValue;
		$this->Allowance->PlaceHolder = RemoveHtml($this->Allowance->caption());

		// CouncillorTypeType
		$this->CouncillorTypeType->EditAttrs["class"] = "form-control";
		$this->CouncillorTypeType->EditCustomAttributes = "";

		// CouncillorshipStatus
		$this->CouncillorshipStatus->EditAttrs["class"] = "form-control";
		$this->CouncillorshipStatus->EditCustomAttributes = "";

		// ExitReason
		$this->ExitReason->EditAttrs["class"] = "form-control";
		$this->ExitReason->EditCustomAttributes = "";

		// RetirementType
		$this->RetirementType->EditAttrs["class"] = "form-control";
		$this->RetirementType->EditCustomAttributes = "";

		// CouncillorPhoto
		$this->CouncillorPhoto->EditAttrs["class"] = "form-control";
		$this->CouncillorPhoto->EditCustomAttributes = "";
		if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->EditValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue;
			$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
		} else {
			$this->CouncillorPhoto->EditValue = "";
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
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PoliticalParty);
					$doc->exportCaption($this->Occupation);
					$doc->exportCaption($this->PositionInCouncil);
					$doc->exportCaption($this->Committee);
					$doc->exportCaption($this->CommitteeRole);
					$doc->exportCaption($this->CouncilTerm);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->Allowance);
					$doc->exportCaption($this->CouncillorTypeType);
					$doc->exportCaption($this->ExitReason);
					$doc->exportCaption($this->CouncillorPhoto);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PoliticalParty);
					$doc->exportCaption($this->Occupation);
					$doc->exportCaption($this->PositionInCouncil);
					$doc->exportCaption($this->Committee);
					$doc->exportCaption($this->CommitteeRole);
					$doc->exportCaption($this->CouncilTerm);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->Allowance);
					$doc->exportCaption($this->CouncillorTypeType);
					$doc->exportCaption($this->ExitReason);
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
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->PoliticalParty);
						$doc->exportField($this->Occupation);
						$doc->exportField($this->PositionInCouncil);
						$doc->exportField($this->Committee);
						$doc->exportField($this->CommitteeRole);
						$doc->exportField($this->CouncilTerm);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->Allowance);
						$doc->exportField($this->CouncillorTypeType);
						$doc->exportField($this->ExitReason);
						$doc->exportField($this->CouncillorPhoto);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->PoliticalParty);
						$doc->exportField($this->Occupation);
						$doc->exportField($this->PositionInCouncil);
						$doc->exportField($this->Committee);
						$doc->exportField($this->CommitteeRole);
						$doc->exportField($this->CouncilTerm);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->Allowance);
						$doc->exportField($this->CouncillorTypeType);
						$doc->exportField($this->ExitReason);
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
		if ($fldparm == 'CouncillorPhoto') {
			$fldName = "CouncillorPhoto";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 4) {
			$this->EmployeeID->CurrentValue = $ar[0];
			$this->LACode->CurrentValue = $ar[1];
			$this->PositionInCouncil->CurrentValue = $ar[2];
			$this->CouncilTerm->CurrentValue = $ar[3];
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
		$table = 'councillorship';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'councillorship';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PositionInCouncil'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['CouncilTerm'];

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
		$table = 'councillorship';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['PositionInCouncil'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['CouncilTerm'];

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
		$table = 'councillorship';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['PositionInCouncil'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['CouncilTerm'];

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

	/*	$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
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
		"')  ");  } */
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
		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here
		$username = CurrentUserName(); 
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

	/*	$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");
			if ($fld->FldName == "Department") {
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
			if ($fld->FldName == "SectionCode") {
			if(($levelid <> -1) && ($sect["kountsect"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`SectionCode`  in   (select DISTINCT SectionCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}  */
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