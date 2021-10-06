<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for local_authority
 */
class local_authority extends DbTable
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
	public $LACode;
	public $LAName;
	public $CouncilType;
	public $ProvinceCode;
	public $Created;
	public $OpeningDate;
	public $ClosedDate;
	public $OrgUnitLevel;
	public $Mandate;
	public $Strategy;
	public $Clients;
	public $Beneficiaries;
	public $ExecutiveAuthority;
	public $ControllingOfficer;
	public $Comment;
	public $LastUpdated;
	public $LastUserId;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'local_authority';
		$this->TableName = 'local_authority';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`local_authority`";
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
		$this->LACode = new DbField('local_authority', 'local_authority', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LACode'] = &$this->LACode;

		// LAName
		$this->LAName = new DbField('local_authority', 'local_authority', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->fields['LAName'] = &$this->LAName;

		// CouncilType
		$this->CouncilType = new DbField('local_authority', 'local_authority', 'x_CouncilType', 'CouncilType', '`CouncilType`', '`CouncilType`', 16, 3, -1, FALSE, '`CouncilType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CouncilType->Required = TRUE; // Required field
		$this->CouncilType->Sortable = TRUE; // Allow sort
		$this->CouncilType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CouncilType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CouncilType->Lookup = new Lookup('CouncilType', 'la_type', FALSE, 'LAType', ["LATypeName","","",""], [], [], [], [], [], [], '', '');
		$this->CouncilType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncilType'] = &$this->CouncilType;

		// ProvinceCode
		$this->ProvinceCode = new DbField('local_authority', 'local_authority', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 17, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], [], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// Created
		$this->Created = new DbField('local_authority', 'local_authority', 'x_Created', 'Created', '`Created`', CastDateFieldForLike("`Created`", 0, "DB"), 135, 19, 0, FALSE, '`Created`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Created->Sortable = TRUE; // Allow sort
		$this->Created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Created'] = &$this->Created;

		// OpeningDate
		$this->OpeningDate = new DbField('local_authority', 'local_authority', 'x_OpeningDate', 'OpeningDate', '`OpeningDate`', CastDateFieldForLike("`OpeningDate`", 0, "DB"), 133, 10, 0, FALSE, '`OpeningDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OpeningDate->Sortable = TRUE; // Allow sort
		$this->OpeningDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['OpeningDate'] = &$this->OpeningDate;

		// ClosedDate
		$this->ClosedDate = new DbField('local_authority', 'local_authority', 'x_ClosedDate', 'ClosedDate', '`ClosedDate`', CastDateFieldForLike("`ClosedDate`", 0, "DB"), 133, 10, 0, FALSE, '`ClosedDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClosedDate->Sortable = TRUE; // Allow sort
		$this->ClosedDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ClosedDate'] = &$this->ClosedDate;

		// OrgUnitLevel
		$this->OrgUnitLevel = new DbField('local_authority', 'local_authority', 'x_OrgUnitLevel', 'OrgUnitLevel', '`OrgUnitLevel`', '`OrgUnitLevel`', 16, 3, -1, FALSE, '`OrgUnitLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OrgUnitLevel->Nullable = FALSE; // NOT NULL field
		$this->OrgUnitLevel->Required = TRUE; // Required field
		$this->OrgUnitLevel->Sortable = TRUE; // Allow sort
		$this->OrgUnitLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OrgUnitLevel'] = &$this->OrgUnitLevel;

		// Mandate
		$this->Mandate = new DbField('local_authority', 'local_authority', 'x_Mandate', 'Mandate', '`Mandate`', '`Mandate`', 201, 65535, -1, FALSE, '`Mandate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Mandate->Nullable = FALSE; // NOT NULL field
		$this->Mandate->Required = TRUE; // Required field
		$this->Mandate->Sortable = TRUE; // Allow sort
		$this->fields['Mandate'] = &$this->Mandate;

		// Strategy
		$this->Strategy = new DbField('local_authority', 'local_authority', 'x_Strategy', 'Strategy', '`Strategy`', '`Strategy`', 201, 65535, -1, FALSE, '`Strategy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Strategy->Sortable = TRUE; // Allow sort
		$this->fields['Strategy'] = &$this->Strategy;

		// Clients
		$this->Clients = new DbField('local_authority', 'local_authority', 'x_Clients', 'Clients', '`Clients`', '`Clients`', 200, 255, -1, FALSE, '`Clients`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Clients->Nullable = FALSE; // NOT NULL field
		$this->Clients->Required = TRUE; // Required field
		$this->Clients->Sortable = TRUE; // Allow sort
		$this->fields['Clients'] = &$this->Clients;

		// Beneficiaries
		$this->Beneficiaries = new DbField('local_authority', 'local_authority', 'x_Beneficiaries', 'Beneficiaries', '`Beneficiaries`', '`Beneficiaries`', 200, 255, -1, FALSE, '`Beneficiaries`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Beneficiaries->Nullable = FALSE; // NOT NULL field
		$this->Beneficiaries->Required = TRUE; // Required field
		$this->Beneficiaries->Sortable = TRUE; // Allow sort
		$this->fields['Beneficiaries'] = &$this->Beneficiaries;

		// ExecutiveAuthority
		$this->ExecutiveAuthority = new DbField('local_authority', 'local_authority', 'x_ExecutiveAuthority', 'ExecutiveAuthority', '`ExecutiveAuthority`', '`ExecutiveAuthority`', 200, 255, -1, FALSE, '`ExecutiveAuthority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExecutiveAuthority->Nullable = FALSE; // NOT NULL field
		$this->ExecutiveAuthority->Required = TRUE; // Required field
		$this->ExecutiveAuthority->Sortable = TRUE; // Allow sort
		$this->fields['ExecutiveAuthority'] = &$this->ExecutiveAuthority;

		// ControllingOfficer
		$this->ControllingOfficer = new DbField('local_authority', 'local_authority', 'x_ControllingOfficer', 'ControllingOfficer', '`ControllingOfficer`', '`ControllingOfficer`', 200, 255, -1, FALSE, '`ControllingOfficer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ControllingOfficer->Nullable = FALSE; // NOT NULL field
		$this->ControllingOfficer->Required = TRUE; // Required field
		$this->ControllingOfficer->Sortable = TRUE; // Allow sort
		$this->fields['ControllingOfficer'] = &$this->ControllingOfficer;

		// Comment
		$this->Comment = new DbField('local_authority', 'local_authority', 'x_Comment', 'Comment', '`Comment`', '`Comment`', 200, 255, -1, FALSE, '`Comment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Comment->Sortable = TRUE; // Allow sort
		$this->fields['Comment'] = &$this->Comment;

		// LastUpdated
		$this->LastUpdated = new DbField('local_authority', 'local_authority', 'x_LastUpdated', 'LastUpdated', '`LastUpdated`', CastDateFieldForLike("`LastUpdated`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdated->Sortable = TRUE; // Allow sort
		$this->LastUpdated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdated'] = &$this->LastUpdated;

		// LastUserId
		$this->LastUserId = new DbField('local_authority', 'local_authority', 'x_LastUserId', 'LastUserId', '`LastUserId`', '`LastUserId`', 200, 40, -1, FALSE, '`LastUserId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUserId->Sortable = TRUE; // Allow sort
		$this->fields['LastUserId'] = &$this->LastUserId;
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
		if ($this->getCurrentMasterTable() == "province") {
			if ($this->ProvinceCode->getSessionValue() != "")
				$masterFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "province") {
			if ($this->ProvinceCode->getSessionValue() != "")
				$detailFilter .= "`ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_province()
	{
		return "`ProvinceCode`=@ProvinceCode@";
	}

	// Detail filter
	public function sqlDetailFilter_province()
	{
		return "`ProvinceCode`=@ProvinceCode@";
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
		if ($this->getCurrentDetailTable() == "department") {
			$detailUrl = $GLOBALS["department"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "council_meeting") {
			$detailUrl = $GLOBALS["council_meeting"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "asset") {
			$detailUrl = $GLOBALS["asset"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "ward") {
			$detailUrl = $GLOBALS["ward"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "budget_actual") {
			$detailUrl = $GLOBALS["budget_actual"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "councillorship") {
			$detailUrl = $GLOBALS["councillorship"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "monthly_run") {
			$detailUrl = $GLOBALS["monthly_run"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "project") {
			$detailUrl = $GLOBALS["project"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "la_bank_account") {
			$detailUrl = $GLOBALS["la_bank_account"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "strategic_objective") {
			$detailUrl = $GLOBALS["strategic_objective"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "local_authoritylist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`local_authority`";
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
			$fldname = 'LACode';
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
			if (array_key_exists('LACode', $rs))
				AddFilter($where, QuotedName('LACode', $this->Dbid) . '=' . QuotedValue($rs['LACode'], $this->LACode->DataType, $this->Dbid));
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
		$this->LACode->DbValue = $row['LACode'];
		$this->LAName->DbValue = $row['LAName'];
		$this->CouncilType->DbValue = $row['CouncilType'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->Created->DbValue = $row['Created'];
		$this->OpeningDate->DbValue = $row['OpeningDate'];
		$this->ClosedDate->DbValue = $row['ClosedDate'];
		$this->OrgUnitLevel->DbValue = $row['OrgUnitLevel'];
		$this->Mandate->DbValue = $row['Mandate'];
		$this->Strategy->DbValue = $row['Strategy'];
		$this->Clients->DbValue = $row['Clients'];
		$this->Beneficiaries->DbValue = $row['Beneficiaries'];
		$this->ExecutiveAuthority->DbValue = $row['ExecutiveAuthority'];
		$this->ControllingOfficer->DbValue = $row['ControllingOfficer'];
		$this->Comment->DbValue = $row['Comment'];
		$this->LastUpdated->DbValue = $row['LastUpdated'];
		$this->LastUserId->DbValue = $row['LastUserId'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`LACode` = '@LACode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "local_authoritylist.php";
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
		if ($pageName == "local_authorityview.php")
			return $Language->phrase("View");
		elseif ($pageName == "local_authorityedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "local_authorityadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "local_authoritylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("local_authorityview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("local_authorityview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "local_authorityadd.php?" . $this->getUrlParm($parm);
		else
			$url = "local_authorityadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("local_authorityedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("local_authorityedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("local_authorityadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("local_authorityadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("local_authoritydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "province" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
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
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "LACode=" . urlencode($this->LACode->CurrentValue);
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
			if (Param("LACode") !== NULL)
				$arKeys[] = Param("LACode");
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
				$this->LACode->CurrentValue = $key;
			else
				$this->LACode->OldValue = $key;
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
		$this->LAName->setDbValue($rs->fields('LAName'));
		$this->CouncilType->setDbValue($rs->fields('CouncilType'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->Created->setDbValue($rs->fields('Created'));
		$this->OpeningDate->setDbValue($rs->fields('OpeningDate'));
		$this->ClosedDate->setDbValue($rs->fields('ClosedDate'));
		$this->OrgUnitLevel->setDbValue($rs->fields('OrgUnitLevel'));
		$this->Mandate->setDbValue($rs->fields('Mandate'));
		$this->Strategy->setDbValue($rs->fields('Strategy'));
		$this->Clients->setDbValue($rs->fields('Clients'));
		$this->Beneficiaries->setDbValue($rs->fields('Beneficiaries'));
		$this->ExecutiveAuthority->setDbValue($rs->fields('ExecutiveAuthority'));
		$this->ControllingOfficer->setDbValue($rs->fields('ControllingOfficer'));
		$this->Comment->setDbValue($rs->fields('Comment'));
		$this->LastUpdated->setDbValue($rs->fields('LastUpdated'));
		$this->LastUserId->setDbValue($rs->fields('LastUserId'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LACode
		// LAName
		// CouncilType
		// ProvinceCode
		// Created
		// OpeningDate
		// ClosedDate
		// OrgUnitLevel
		// Mandate
		// Strategy
		// Clients
		// Beneficiaries
		// ExecutiveAuthority
		// ControllingOfficer
		// Comment
		// LastUpdated
		// LastUserId
		// LACode

		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewCustomAttributes = "";

		// LAName
		$this->LAName->ViewValue = $this->LAName->CurrentValue;
		$this->LAName->ViewCustomAttributes = "";

		// CouncilType
		$curVal = strval($this->CouncilType->CurrentValue);
		if ($curVal != "") {
			$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
			if ($this->CouncilType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LAType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncilType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CouncilType->ViewValue = $this->CouncilType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
				}
			}
		} else {
			$this->CouncilType->ViewValue = NULL;
		}
		$this->CouncilType->ViewCustomAttributes = "";

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

		// Created
		$this->Created->ViewValue = $this->Created->CurrentValue;
		$this->Created->ViewValue = FormatDateTime($this->Created->ViewValue, 0);
		$this->Created->ViewCustomAttributes = "";

		// OpeningDate
		$this->OpeningDate->ViewValue = $this->OpeningDate->CurrentValue;
		$this->OpeningDate->ViewValue = FormatDateTime($this->OpeningDate->ViewValue, 0);
		$this->OpeningDate->ViewCustomAttributes = "";

		// ClosedDate
		$this->ClosedDate->ViewValue = $this->ClosedDate->CurrentValue;
		$this->ClosedDate->ViewValue = FormatDateTime($this->ClosedDate->ViewValue, 0);
		$this->ClosedDate->ViewCustomAttributes = "";

		// OrgUnitLevel
		$this->OrgUnitLevel->ViewValue = $this->OrgUnitLevel->CurrentValue;
		$this->OrgUnitLevel->ViewCustomAttributes = "";

		// Mandate
		$this->Mandate->ViewValue = $this->Mandate->CurrentValue;
		$this->Mandate->ViewCustomAttributes = "";

		// Strategy
		$this->Strategy->ViewValue = $this->Strategy->CurrentValue;
		$this->Strategy->ViewCustomAttributes = "";

		// Clients
		$this->Clients->ViewValue = $this->Clients->CurrentValue;
		$this->Clients->ViewCustomAttributes = "";

		// Beneficiaries
		$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
		$this->Beneficiaries->ViewCustomAttributes = "";

		// ExecutiveAuthority
		$this->ExecutiveAuthority->ViewValue = $this->ExecutiveAuthority->CurrentValue;
		$this->ExecutiveAuthority->ViewCustomAttributes = "";

		// ControllingOfficer
		$this->ControllingOfficer->ViewValue = $this->ControllingOfficer->CurrentValue;
		$this->ControllingOfficer->ViewCustomAttributes = "";

		// Comment
		$this->Comment->ViewValue = $this->Comment->CurrentValue;
		$this->Comment->ViewCustomAttributes = "";

		// LastUpdated
		$this->LastUpdated->ViewValue = $this->LastUpdated->CurrentValue;
		$this->LastUpdated->ViewValue = FormatDateTime($this->LastUpdated->ViewValue, 0);
		$this->LastUpdated->ViewCustomAttributes = "";

		// LastUserId
		$this->LastUserId->ViewValue = $this->LastUserId->CurrentValue;
		$this->LastUserId->ViewCustomAttributes = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// LAName
		$this->LAName->LinkCustomAttributes = "";
		$this->LAName->HrefValue = "";
		$this->LAName->TooltipValue = "";

		// CouncilType
		$this->CouncilType->LinkCustomAttributes = "";
		$this->CouncilType->HrefValue = "";
		$this->CouncilType->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// Created
		$this->Created->LinkCustomAttributes = "";
		$this->Created->HrefValue = "";
		$this->Created->TooltipValue = "";

		// OpeningDate
		$this->OpeningDate->LinkCustomAttributes = "";
		$this->OpeningDate->HrefValue = "";
		$this->OpeningDate->TooltipValue = "";

		// ClosedDate
		$this->ClosedDate->LinkCustomAttributes = "";
		$this->ClosedDate->HrefValue = "";
		$this->ClosedDate->TooltipValue = "";

		// OrgUnitLevel
		$this->OrgUnitLevel->LinkCustomAttributes = "";
		$this->OrgUnitLevel->HrefValue = "";
		$this->OrgUnitLevel->TooltipValue = "";

		// Mandate
		$this->Mandate->LinkCustomAttributes = "";
		$this->Mandate->HrefValue = "";
		$this->Mandate->TooltipValue = "";

		// Strategy
		$this->Strategy->LinkCustomAttributes = "";
		$this->Strategy->HrefValue = "";
		$this->Strategy->TooltipValue = "";

		// Clients
		$this->Clients->LinkCustomAttributes = "";
		$this->Clients->HrefValue = "";
		$this->Clients->TooltipValue = "";

		// Beneficiaries
		$this->Beneficiaries->LinkCustomAttributes = "";
		$this->Beneficiaries->HrefValue = "";
		$this->Beneficiaries->TooltipValue = "";

		// ExecutiveAuthority
		$this->ExecutiveAuthority->LinkCustomAttributes = "";
		$this->ExecutiveAuthority->HrefValue = "";
		$this->ExecutiveAuthority->TooltipValue = "";

		// ControllingOfficer
		$this->ControllingOfficer->LinkCustomAttributes = "";
		$this->ControllingOfficer->HrefValue = "";
		$this->ControllingOfficer->TooltipValue = "";

		// Comment
		$this->Comment->LinkCustomAttributes = "";
		$this->Comment->HrefValue = "";
		$this->Comment->TooltipValue = "";

		// LastUpdated
		$this->LastUpdated->LinkCustomAttributes = "";
		$this->LastUpdated->HrefValue = "";
		$this->LastUpdated->TooltipValue = "";

		// LastUserId
		$this->LastUserId->LinkCustomAttributes = "";
		$this->LastUserId->HrefValue = "";
		$this->LastUserId->TooltipValue = "";

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
		if (!$this->LACode->Raw)
			$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// LAName
		$this->LAName->EditAttrs["class"] = "form-control";
		$this->LAName->EditCustomAttributes = "";
		if (!$this->LAName->Raw)
			$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
		$this->LAName->EditValue = $this->LAName->CurrentValue;
		$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

		// CouncilType
		$this->CouncilType->EditAttrs["class"] = "form-control";
		$this->CouncilType->EditCustomAttributes = "";

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

		// Created
		$this->Created->EditAttrs["class"] = "form-control";
		$this->Created->EditCustomAttributes = "";
		$this->Created->EditValue = FormatDateTime($this->Created->CurrentValue, 8);
		$this->Created->PlaceHolder = RemoveHtml($this->Created->caption());

		// OpeningDate
		$this->OpeningDate->EditAttrs["class"] = "form-control";
		$this->OpeningDate->EditCustomAttributes = "";
		$this->OpeningDate->EditValue = FormatDateTime($this->OpeningDate->CurrentValue, 8);
		$this->OpeningDate->PlaceHolder = RemoveHtml($this->OpeningDate->caption());

		// ClosedDate
		$this->ClosedDate->EditAttrs["class"] = "form-control";
		$this->ClosedDate->EditCustomAttributes = "";
		$this->ClosedDate->EditValue = FormatDateTime($this->ClosedDate->CurrentValue, 8);
		$this->ClosedDate->PlaceHolder = RemoveHtml($this->ClosedDate->caption());

		// OrgUnitLevel
		$this->OrgUnitLevel->EditAttrs["class"] = "form-control";
		$this->OrgUnitLevel->EditCustomAttributes = "";
		$this->OrgUnitLevel->EditValue = $this->OrgUnitLevel->CurrentValue;
		$this->OrgUnitLevel->PlaceHolder = RemoveHtml($this->OrgUnitLevel->caption());

		// Mandate
		$this->Mandate->EditAttrs["class"] = "form-control";
		$this->Mandate->EditCustomAttributes = "";
		$this->Mandate->EditValue = $this->Mandate->CurrentValue;
		$this->Mandate->PlaceHolder = RemoveHtml($this->Mandate->caption());

		// Strategy
		$this->Strategy->EditAttrs["class"] = "form-control";
		$this->Strategy->EditCustomAttributes = "";
		$this->Strategy->EditValue = $this->Strategy->CurrentValue;
		$this->Strategy->PlaceHolder = RemoveHtml($this->Strategy->caption());

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

		// ExecutiveAuthority
		$this->ExecutiveAuthority->EditAttrs["class"] = "form-control";
		$this->ExecutiveAuthority->EditCustomAttributes = "";
		if (!$this->ExecutiveAuthority->Raw)
			$this->ExecutiveAuthority->CurrentValue = HtmlDecode($this->ExecutiveAuthority->CurrentValue);
		$this->ExecutiveAuthority->EditValue = $this->ExecutiveAuthority->CurrentValue;
		$this->ExecutiveAuthority->PlaceHolder = RemoveHtml($this->ExecutiveAuthority->caption());

		// ControllingOfficer
		$this->ControllingOfficer->EditAttrs["class"] = "form-control";
		$this->ControllingOfficer->EditCustomAttributes = "";
		if (!$this->ControllingOfficer->Raw)
			$this->ControllingOfficer->CurrentValue = HtmlDecode($this->ControllingOfficer->CurrentValue);
		$this->ControllingOfficer->EditValue = $this->ControllingOfficer->CurrentValue;
		$this->ControllingOfficer->PlaceHolder = RemoveHtml($this->ControllingOfficer->caption());

		// Comment
		$this->Comment->EditAttrs["class"] = "form-control";
		$this->Comment->EditCustomAttributes = "";
		$this->Comment->EditValue = $this->Comment->CurrentValue;
		$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

		// LastUpdated
		// LastUserId

		$this->LastUserId->EditAttrs["class"] = "form-control";
		$this->LastUserId->EditCustomAttributes = "";
		if (!$this->LastUserId->Raw)
			$this->LastUserId->CurrentValue = HtmlDecode($this->LastUserId->CurrentValue);
		$this->LastUserId->EditValue = $this->LastUserId->CurrentValue;
		$this->LastUserId->PlaceHolder = RemoveHtml($this->LastUserId->caption());

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
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->CouncilType);
					$doc->exportCaption($this->Mandate);
					$doc->exportCaption($this->Strategy);
					$doc->exportCaption($this->Clients);
					$doc->exportCaption($this->Beneficiaries);
					$doc->exportCaption($this->ExecutiveAuthority);
					$doc->exportCaption($this->ControllingOfficer);
					$doc->exportCaption($this->Comment);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->CouncilType);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->Clients);
					$doc->exportCaption($this->Beneficiaries);
					$doc->exportCaption($this->ExecutiveAuthority);
					$doc->exportCaption($this->ControllingOfficer);
					$doc->exportCaption($this->Comment);
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
						$doc->exportField($this->LAName);
						$doc->exportField($this->CouncilType);
						$doc->exportField($this->Mandate);
						$doc->exportField($this->Strategy);
						$doc->exportField($this->Clients);
						$doc->exportField($this->Beneficiaries);
						$doc->exportField($this->ExecutiveAuthority);
						$doc->exportField($this->ControllingOfficer);
						$doc->exportField($this->Comment);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->LAName);
						$doc->exportField($this->CouncilType);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->Clients);
						$doc->exportField($this->Beneficiaries);
						$doc->exportField($this->ExecutiveAuthority);
						$doc->exportField($this->ControllingOfficer);
						$doc->exportField($this->Comment);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'local_authority';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'local_authority';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];

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
		$table = 'local_authority';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['LACode'];

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
		$table = 'local_authority';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['LACode'];

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
		$dept = executeRow("select count(security_matrix.LAcode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.LAcode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid >= 0) && ($dept["kountdept"] > 0)) {
		AddFilter($filter,"`LACode`  in   (select security_matrix.LAcode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
		elseif ($levelid >= 0)  {AddFilter($filter,"`LAcode`  
		in   (SELECT DISTINCT local_authority.`LAcode`
		FROM security_matrix, local_authority, musers                            
		WHERE security_matrix.usercode = musers.usercode 
		AND security_matrix.ProvinceCode = local_authority.ProvinceCode 
		AND musers.username = '" . $username .  
		"')  "); 
		}      
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