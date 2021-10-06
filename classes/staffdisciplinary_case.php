<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for staffdisciplinary_case
 */
class staffdisciplinary_case extends DbTable
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
	public $CaseNo;
	public $OffenseCode;
	public $CaseDescription;
	public $ActionTaken;
	public $OffenseDate;
	public $ActionDate;
	public $PenaltyQuantity;
	public $UnitOfMeasure;
	public $DateOfAppealLetter;
	public $DateAppealReceived;
	public $DateConcluded;
	public $AppealStatus;
	public $DiciplinaryHearing;
	public $AppealNotes;
	public $LastUpdate;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'staffdisciplinary_case';
		$this->TableName = 'staffdisciplinary_case';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`staffdisciplinary_case`";
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
		$this->EmployeeID = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// CaseNo
		$this->CaseNo = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_CaseNo', 'CaseNo', '`CaseNo`', '`CaseNo`', 3, 11, -1, FALSE, '`CaseNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->CaseNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->CaseNo->IsPrimaryKey = TRUE; // Primary key field
		$this->CaseNo->IsForeignKey = TRUE; // Foreign key field
		$this->CaseNo->Sortable = TRUE; // Allow sort
		$this->CaseNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CaseNo'] = &$this->CaseNo;

		// OffenseCode
		$this->OffenseCode = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_OffenseCode', 'OffenseCode', '`OffenseCode`', '`OffenseCode`', 3, 11, -1, FALSE, '`OffenseCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->OffenseCode->IsPrimaryKey = TRUE; // Primary key field
		$this->OffenseCode->IsForeignKey = TRUE; // Foreign key field
		$this->OffenseCode->Nullable = FALSE; // NOT NULL field
		$this->OffenseCode->Required = TRUE; // Required field
		$this->OffenseCode->Sortable = TRUE; // Allow sort
		$this->OffenseCode->Lookup = new Lookup('OffenseCode', 'offense_penalty', FALSE, 'OffenseCode', ["OffenseName","Frequency","",""], [], [], [], [], ["OffenseName","AppropriateAction"], ["x_CaseDescription","x_ActionTaken"], '', '');
		$this->OffenseCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OffenseCode'] = &$this->OffenseCode;

		// CaseDescription
		$this->CaseDescription = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_CaseDescription', 'CaseDescription', '`CaseDescription`', '`CaseDescription`', 201, 16777215, -1, FALSE, '`CaseDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->CaseDescription->Sortable = TRUE; // Allow sort
		$this->fields['CaseDescription'] = &$this->CaseDescription;

		// ActionTaken
		$this->ActionTaken = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_ActionTaken', 'ActionTaken', '`ActionTaken`', '`ActionTaken`', 16, 3, -1, FALSE, '`ActionTaken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ActionTaken->Sortable = TRUE; // Allow sort
		$this->ActionTaken->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ActionTaken->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ActionTaken->Lookup = new Lookup('ActionTaken', 'disciplinary_action_ref', FALSE, 'ActionCode', ["ActionDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ActionTaken->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ActionTaken'] = &$this->ActionTaken;

		// OffenseDate
		$this->OffenseDate = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_OffenseDate', 'OffenseDate', '`OffenseDate`', CastDateFieldForLike("`OffenseDate`", 0, "DB"), 133, 10, 0, FALSE, '`OffenseDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OffenseDate->Nullable = FALSE; // NOT NULL field
		$this->OffenseDate->Required = TRUE; // Required field
		$this->OffenseDate->Sortable = TRUE; // Allow sort
		$this->OffenseDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['OffenseDate'] = &$this->OffenseDate;

		// ActionDate
		$this->ActionDate = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_ActionDate', 'ActionDate', '`ActionDate`', CastDateFieldForLike("`ActionDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActionDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActionDate->Sortable = TRUE; // Allow sort
		$this->ActionDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActionDate'] = &$this->ActionDate;

		// PenaltyQuantity
		$this->PenaltyQuantity = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_PenaltyQuantity', 'PenaltyQuantity', '`PenaltyQuantity`', '`PenaltyQuantity`', 5, 22, -1, FALSE, '`PenaltyQuantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PenaltyQuantity->Sortable = TRUE; // Allow sort
		$this->PenaltyQuantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PenaltyQuantity'] = &$this->PenaltyQuantity;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 10, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->UnitOfMeasure->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UnitOfMeasure->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->UnitOfMeasure->Lookup = new Lookup('UnitOfMeasure', 'unit_of_measure', FALSE, 'Unit_of_measure', ["Unit_of_measure","","",""], [], [], [], [], [], [], '', '');
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// DateOfAppealLetter
		$this->DateOfAppealLetter = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_DateOfAppealLetter', 'DateOfAppealLetter', '`DateOfAppealLetter`', CastDateFieldForLike("`DateOfAppealLetter`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfAppealLetter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfAppealLetter->Sortable = TRUE; // Allow sort
		$this->DateOfAppealLetter->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfAppealLetter'] = &$this->DateOfAppealLetter;

		// DateAppealReceived
		$this->DateAppealReceived = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_DateAppealReceived', 'DateAppealReceived', '`DateAppealReceived`', CastDateFieldForLike("`DateAppealReceived`", 0, "DB"), 133, 10, 0, FALSE, '`DateAppealReceived`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateAppealReceived->Sortable = TRUE; // Allow sort
		$this->DateAppealReceived->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateAppealReceived'] = &$this->DateAppealReceived;

		// DateConcluded
		$this->DateConcluded = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_DateConcluded', 'DateConcluded', '`DateConcluded`', CastDateFieldForLike("`DateConcluded`", 0, "DB"), 133, 10, 0, FALSE, '`DateConcluded`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateConcluded->Sortable = TRUE; // Allow sort
		$this->DateConcluded->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateConcluded'] = &$this->DateConcluded;

		// AppealStatus
		$this->AppealStatus = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_AppealStatus', 'AppealStatus', '`AppealStatus`', '`AppealStatus`', 3, 11, -1, FALSE, '`AppealStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AppealStatus->Sortable = TRUE; // Allow sort
		$this->AppealStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AppealStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AppealStatus->Lookup = new Lookup('AppealStatus', 'appeal_status', FALSE, 'AppealStatusCode', ["AppealStatus","","",""], [], [], [], [], [], [], '', '');
		$this->AppealStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AppealStatus'] = &$this->AppealStatus;

		// DiciplinaryHearing
		$this->DiciplinaryHearing = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_DiciplinaryHearing', 'DiciplinaryHearing', '`DiciplinaryHearing`', '`DiciplinaryHearing`', 201, 16777215, -1, FALSE, '`DiciplinaryHearing`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->DiciplinaryHearing->Sortable = TRUE; // Allow sort
		$this->fields['DiciplinaryHearing'] = &$this->DiciplinaryHearing;

		// AppealNotes
		$this->AppealNotes = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_AppealNotes', 'AppealNotes', '`AppealNotes`', '`AppealNotes`', 201, 16777215, -1, FALSE, '`AppealNotes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->AppealNotes->Sortable = TRUE; // Allow sort
		$this->fields['AppealNotes'] = &$this->AppealNotes;

		// LastUpdate
		$this->LastUpdate = new DbField('staffdisciplinary_case', 'staffdisciplinary_case', 'x_LastUpdate', 'LastUpdate', '`LastUpdate`', CastDateFieldForLike("`LastUpdate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdate->Sortable = TRUE; // Allow sort
		$this->LastUpdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdate'] = &$this->LastUpdate;
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
		if ($this->getCurrentMasterTable() == "staff") {
			if ($this->EmployeeID->getSessionValue() != "")
				$masterFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "staff") {
			if ($this->EmployeeID->getSessionValue() != "")
				$detailFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_staff()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Detail filter
	public function sqlDetailFilter_staff()
	{
		return "`EmployeeID`=@EmployeeID@";
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
		if ($this->getCurrentDetailTable() == "staffdisciplinary_appeal") {
			$detailUrl = $GLOBALS["staffdisciplinary_appeal"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
			$detailUrl .= "&fk_CaseNo=" . urlencode($this->CaseNo->CurrentValue);
			$detailUrl .= "&fk_OffenseCode=" . urlencode($this->OffenseCode->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "staffdisciplinary_action") {
			$detailUrl = $GLOBALS["staffdisciplinary_action"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
			$detailUrl .= "&fk_CaseNo=" . urlencode($this->CaseNo->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "staffdisciplinary_caselist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`staffdisciplinary_case`";
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
			$this->CaseNo->setDbValue($conn->insert_ID());
			$rs['CaseNo'] = $this->CaseNo->DbValue;
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
			$fldname = 'CaseNo';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'OffenseCode';
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
			if (array_key_exists('CaseNo', $rs))
				AddFilter($where, QuotedName('CaseNo', $this->Dbid) . '=' . QuotedValue($rs['CaseNo'], $this->CaseNo->DataType, $this->Dbid));
			if (array_key_exists('OffenseCode', $rs))
				AddFilter($where, QuotedName('OffenseCode', $this->Dbid) . '=' . QuotedValue($rs['OffenseCode'], $this->OffenseCode->DataType, $this->Dbid));
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
		$this->CaseNo->DbValue = $row['CaseNo'];
		$this->OffenseCode->DbValue = $row['OffenseCode'];
		$this->CaseDescription->DbValue = $row['CaseDescription'];
		$this->ActionTaken->DbValue = $row['ActionTaken'];
		$this->OffenseDate->DbValue = $row['OffenseDate'];
		$this->ActionDate->DbValue = $row['ActionDate'];
		$this->PenaltyQuantity->DbValue = $row['PenaltyQuantity'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->DateOfAppealLetter->DbValue = $row['DateOfAppealLetter'];
		$this->DateAppealReceived->DbValue = $row['DateAppealReceived'];
		$this->DateConcluded->DbValue = $row['DateConcluded'];
		$this->AppealStatus->DbValue = $row['AppealStatus'];
		$this->DiciplinaryHearing->DbValue = $row['DiciplinaryHearing'];
		$this->AppealNotes->DbValue = $row['AppealNotes'];
		$this->LastUpdate->DbValue = $row['LastUpdate'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `CaseNo` = @CaseNo@ AND `OffenseCode` = @OffenseCode@";
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
			$val = array_key_exists('CaseNo', $row) ? $row['CaseNo'] : NULL;
		else
			$val = $this->CaseNo->OldValue !== NULL ? $this->CaseNo->OldValue : $this->CaseNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@CaseNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('OffenseCode', $row) ? $row['OffenseCode'] : NULL;
		else
			$val = $this->OffenseCode->OldValue !== NULL ? $this->OffenseCode->OldValue : $this->OffenseCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@OffenseCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "staffdisciplinary_caselist.php";
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
		if ($pageName == "staffdisciplinary_caseview.php")
			return $Language->phrase("View");
		elseif ($pageName == "staffdisciplinary_caseedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "staffdisciplinary_caseadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "staffdisciplinary_caselist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("staffdisciplinary_caseview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("staffdisciplinary_caseview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "staffdisciplinary_caseadd.php?" . $this->getUrlParm($parm);
		else
			$url = "staffdisciplinary_caseadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("staffdisciplinary_caseedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("staffdisciplinary_caseedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("staffdisciplinary_caseadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("staffdisciplinary_caseadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("staffdisciplinary_casedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "staff" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
		$json .= ",CaseNo:" . JsonEncode($this->CaseNo->CurrentValue, "number");
		$json .= ",OffenseCode:" . JsonEncode($this->OffenseCode->CurrentValue, "number");
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
		if ($this->CaseNo->CurrentValue != NULL) {
			$url .= "&CaseNo=" . urlencode($this->CaseNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->OffenseCode->CurrentValue != NULL) {
			$url .= "&OffenseCode=" . urlencode($this->OffenseCode->CurrentValue);
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
			if (Param("CaseNo") !== NULL)
				$arKey[] = Param("CaseNo");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (Param("OffenseCode") !== NULL)
				$arKey[] = Param("OffenseCode");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 3)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // EmployeeID
					continue;
				if (!is_numeric($key[1])) // CaseNo
					continue;
				if (!is_numeric($key[2])) // OffenseCode
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
				$this->CaseNo->CurrentValue = $key[1];
			else
				$this->CaseNo->OldValue = $key[1];
			if ($setCurrent)
				$this->OffenseCode->CurrentValue = $key[2];
			else
				$this->OffenseCode->OldValue = $key[2];
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
		$this->CaseNo->setDbValue($rs->fields('CaseNo'));
		$this->OffenseCode->setDbValue($rs->fields('OffenseCode'));
		$this->CaseDescription->setDbValue($rs->fields('CaseDescription'));
		$this->ActionTaken->setDbValue($rs->fields('ActionTaken'));
		$this->OffenseDate->setDbValue($rs->fields('OffenseDate'));
		$this->ActionDate->setDbValue($rs->fields('ActionDate'));
		$this->PenaltyQuantity->setDbValue($rs->fields('PenaltyQuantity'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->DateOfAppealLetter->setDbValue($rs->fields('DateOfAppealLetter'));
		$this->DateAppealReceived->setDbValue($rs->fields('DateAppealReceived'));
		$this->DateConcluded->setDbValue($rs->fields('DateConcluded'));
		$this->AppealStatus->setDbValue($rs->fields('AppealStatus'));
		$this->DiciplinaryHearing->setDbValue($rs->fields('DiciplinaryHearing'));
		$this->AppealNotes->setDbValue($rs->fields('AppealNotes'));
		$this->LastUpdate->setDbValue($rs->fields('LastUpdate'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// CaseNo
		// OffenseCode
		// CaseDescription
		// ActionTaken
		// OffenseDate
		// ActionDate
		// PenaltyQuantity
		// UnitOfMeasure
		// DateOfAppealLetter
		// DateAppealReceived
		// DateConcluded
		// AppealStatus
		// DiciplinaryHearing
		// AppealNotes
		// LastUpdate
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// CaseNo
		$this->CaseNo->ViewValue = $this->CaseNo->CurrentValue;
		$this->CaseNo->ViewCustomAttributes = "";

		// OffenseCode
		$curVal = strval($this->OffenseCode->CurrentValue);
		if ($curVal != "") {
			$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
			if ($this->OffenseCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OffenseCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OffenseCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OffenseCode->ViewValue = $this->OffenseCode->CurrentValue;
				}
			}
		} else {
			$this->OffenseCode->ViewValue = NULL;
		}
		$this->OffenseCode->ViewCustomAttributes = "";

		// CaseDescription
		$this->CaseDescription->ViewValue = $this->CaseDescription->CurrentValue;
		$this->CaseDescription->ViewCustomAttributes = "";

		// ActionTaken
		$curVal = strval($this->ActionTaken->CurrentValue);
		if ($curVal != "") {
			$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
			if ($this->ActionTaken->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ActionTaken->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ActionTaken->ViewValue = $this->ActionTaken->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ActionTaken->ViewValue = $this->ActionTaken->CurrentValue;
				}
			}
		} else {
			$this->ActionTaken->ViewValue = NULL;
		}
		$this->ActionTaken->ViewCustomAttributes = "";

		// OffenseDate
		$this->OffenseDate->ViewValue = $this->OffenseDate->CurrentValue;
		$this->OffenseDate->ViewValue = FormatDateTime($this->OffenseDate->ViewValue, 0);
		$this->OffenseDate->ViewCustomAttributes = "";

		// ActionDate
		$this->ActionDate->ViewValue = $this->ActionDate->CurrentValue;
		$this->ActionDate->ViewValue = FormatDateTime($this->ActionDate->ViewValue, 0);
		$this->ActionDate->ViewCustomAttributes = "";

		// PenaltyQuantity
		$this->PenaltyQuantity->ViewValue = $this->PenaltyQuantity->CurrentValue;
		$this->PenaltyQuantity->ViewValue = FormatNumber($this->PenaltyQuantity->ViewValue, 0, -2, -2, -2);
		$this->PenaltyQuantity->ViewCustomAttributes = "";

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

		// DateOfAppealLetter
		$this->DateOfAppealLetter->ViewValue = $this->DateOfAppealLetter->CurrentValue;
		$this->DateOfAppealLetter->ViewValue = FormatDateTime($this->DateOfAppealLetter->ViewValue, 0);
		$this->DateOfAppealLetter->ViewCustomAttributes = "";

		// DateAppealReceived
		$this->DateAppealReceived->ViewValue = $this->DateAppealReceived->CurrentValue;
		$this->DateAppealReceived->ViewValue = FormatDateTime($this->DateAppealReceived->ViewValue, 0);
		$this->DateAppealReceived->ViewCustomAttributes = "";

		// DateConcluded
		$this->DateConcluded->ViewValue = $this->DateConcluded->CurrentValue;
		$this->DateConcluded->ViewValue = FormatDateTime($this->DateConcluded->ViewValue, 0);
		$this->DateConcluded->ViewCustomAttributes = "";

		// AppealStatus
		$curVal = strval($this->AppealStatus->CurrentValue);
		if ($curVal != "") {
			$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
			if ($this->AppealStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AppealStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AppealStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AppealStatus->ViewValue = $this->AppealStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AppealStatus->ViewValue = $this->AppealStatus->CurrentValue;
				}
			}
		} else {
			$this->AppealStatus->ViewValue = NULL;
		}
		$this->AppealStatus->ViewCustomAttributes = "";

		// DiciplinaryHearing
		$this->DiciplinaryHearing->ViewValue = $this->DiciplinaryHearing->CurrentValue;
		$this->DiciplinaryHearing->ViewCustomAttributes = "";

		// AppealNotes
		$this->AppealNotes->ViewValue = $this->AppealNotes->CurrentValue;
		$this->AppealNotes->ViewCustomAttributes = "";

		// LastUpdate
		$this->LastUpdate->ViewValue = $this->LastUpdate->CurrentValue;
		$this->LastUpdate->ViewValue = FormatDateTime($this->LastUpdate->ViewValue, 0);
		$this->LastUpdate->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// CaseNo
		$this->CaseNo->LinkCustomAttributes = "";
		$this->CaseNo->HrefValue = "";
		$this->CaseNo->TooltipValue = "";

		// OffenseCode
		$this->OffenseCode->LinkCustomAttributes = "";
		$this->OffenseCode->HrefValue = "";
		$this->OffenseCode->TooltipValue = "";

		// CaseDescription
		$this->CaseDescription->LinkCustomAttributes = "";
		$this->CaseDescription->HrefValue = "";
		$this->CaseDescription->TooltipValue = "";

		// ActionTaken
		$this->ActionTaken->LinkCustomAttributes = "";
		$this->ActionTaken->HrefValue = "";
		$this->ActionTaken->TooltipValue = "";

		// OffenseDate
		$this->OffenseDate->LinkCustomAttributes = "";
		$this->OffenseDate->HrefValue = "";
		$this->OffenseDate->TooltipValue = "";

		// ActionDate
		$this->ActionDate->LinkCustomAttributes = "";
		$this->ActionDate->HrefValue = "";
		$this->ActionDate->TooltipValue = "";

		// PenaltyQuantity
		$this->PenaltyQuantity->LinkCustomAttributes = "";
		$this->PenaltyQuantity->HrefValue = "";
		$this->PenaltyQuantity->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// DateOfAppealLetter
		$this->DateOfAppealLetter->LinkCustomAttributes = "";
		$this->DateOfAppealLetter->HrefValue = "";
		$this->DateOfAppealLetter->TooltipValue = "";

		// DateAppealReceived
		$this->DateAppealReceived->LinkCustomAttributes = "";
		$this->DateAppealReceived->HrefValue = "";
		$this->DateAppealReceived->TooltipValue = "";

		// DateConcluded
		$this->DateConcluded->LinkCustomAttributes = "";
		$this->DateConcluded->HrefValue = "";
		$this->DateConcluded->TooltipValue = "";

		// AppealStatus
		$this->AppealStatus->LinkCustomAttributes = "";
		$this->AppealStatus->HrefValue = "";
		$this->AppealStatus->TooltipValue = "";

		// DiciplinaryHearing
		$this->DiciplinaryHearing->LinkCustomAttributes = "";
		$this->DiciplinaryHearing->HrefValue = "";
		$this->DiciplinaryHearing->TooltipValue = "";

		// AppealNotes
		$this->AppealNotes->LinkCustomAttributes = "";
		$this->AppealNotes->HrefValue = "";
		$this->AppealNotes->TooltipValue = "";

		// LastUpdate
		$this->LastUpdate->LinkCustomAttributes = "";
		$this->LastUpdate->HrefValue = "";
		$this->LastUpdate->TooltipValue = "";

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

		// CaseNo
		$this->CaseNo->EditAttrs["class"] = "form-control";
		$this->CaseNo->EditCustomAttributes = "";
		$this->CaseNo->EditValue = $this->CaseNo->CurrentValue;
		$this->CaseNo->ViewCustomAttributes = "";

		// OffenseCode
		$this->OffenseCode->EditCustomAttributes = "";

		// CaseDescription
		$this->CaseDescription->EditAttrs["class"] = "form-control";
		$this->CaseDescription->EditCustomAttributes = "";
		$this->CaseDescription->EditValue = $this->CaseDescription->CurrentValue;
		$this->CaseDescription->PlaceHolder = RemoveHtml($this->CaseDescription->caption());

		// ActionTaken
		$this->ActionTaken->EditAttrs["class"] = "form-control";
		$this->ActionTaken->EditCustomAttributes = "";

		// OffenseDate
		$this->OffenseDate->EditAttrs["class"] = "form-control";
		$this->OffenseDate->EditCustomAttributes = "";
		$this->OffenseDate->EditValue = FormatDateTime($this->OffenseDate->CurrentValue, 8);
		$this->OffenseDate->PlaceHolder = RemoveHtml($this->OffenseDate->caption());

		// ActionDate
		$this->ActionDate->EditAttrs["class"] = "form-control";
		$this->ActionDate->EditCustomAttributes = "";
		$this->ActionDate->EditValue = FormatDateTime($this->ActionDate->CurrentValue, 8);
		$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

		// PenaltyQuantity
		$this->PenaltyQuantity->EditAttrs["class"] = "form-control";
		$this->PenaltyQuantity->EditCustomAttributes = "";
		$this->PenaltyQuantity->EditValue = $this->PenaltyQuantity->CurrentValue;
		$this->PenaltyQuantity->PlaceHolder = RemoveHtml($this->PenaltyQuantity->caption());
		if (strval($this->PenaltyQuantity->EditValue) != "" && is_numeric($this->PenaltyQuantity->EditValue))
			$this->PenaltyQuantity->EditValue = FormatNumber($this->PenaltyQuantity->EditValue, -2, -2, -2, -2);
		

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";

		// DateOfAppealLetter
		$this->DateOfAppealLetter->EditAttrs["class"] = "form-control";
		$this->DateOfAppealLetter->EditCustomAttributes = "";
		$this->DateOfAppealLetter->EditValue = FormatDateTime($this->DateOfAppealLetter->CurrentValue, 8);
		$this->DateOfAppealLetter->PlaceHolder = RemoveHtml($this->DateOfAppealLetter->caption());

		// DateAppealReceived
		$this->DateAppealReceived->EditAttrs["class"] = "form-control";
		$this->DateAppealReceived->EditCustomAttributes = "";
		$this->DateAppealReceived->EditValue = FormatDateTime($this->DateAppealReceived->CurrentValue, 8);
		$this->DateAppealReceived->PlaceHolder = RemoveHtml($this->DateAppealReceived->caption());

		// DateConcluded
		$this->DateConcluded->EditAttrs["class"] = "form-control";
		$this->DateConcluded->EditCustomAttributes = "";
		$this->DateConcluded->EditValue = FormatDateTime($this->DateConcluded->CurrentValue, 8);
		$this->DateConcluded->PlaceHolder = RemoveHtml($this->DateConcluded->caption());

		// AppealStatus
		$this->AppealStatus->EditAttrs["class"] = "form-control";
		$this->AppealStatus->EditCustomAttributes = "";

		// DiciplinaryHearing
		$this->DiciplinaryHearing->EditAttrs["class"] = "form-control";
		$this->DiciplinaryHearing->EditCustomAttributes = "";
		$this->DiciplinaryHearing->EditValue = $this->DiciplinaryHearing->CurrentValue;
		$this->DiciplinaryHearing->PlaceHolder = RemoveHtml($this->DiciplinaryHearing->caption());

		// AppealNotes
		$this->AppealNotes->EditAttrs["class"] = "form-control";
		$this->AppealNotes->EditCustomAttributes = "";
		$this->AppealNotes->EditValue = $this->AppealNotes->CurrentValue;
		$this->AppealNotes->PlaceHolder = RemoveHtml($this->AppealNotes->caption());

		// LastUpdate
		$this->LastUpdate->EditAttrs["class"] = "form-control";
		$this->LastUpdate->EditCustomAttributes = "";
		$this->LastUpdate->EditValue = FormatDateTime($this->LastUpdate->CurrentValue, 8);
		$this->LastUpdate->PlaceHolder = RemoveHtml($this->LastUpdate->caption());

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
					$doc->exportCaption($this->CaseNo);
					$doc->exportCaption($this->OffenseCode);
					$doc->exportCaption($this->CaseDescription);
					$doc->exportCaption($this->ActionTaken);
					$doc->exportCaption($this->OffenseDate);
					$doc->exportCaption($this->ActionDate);
					$doc->exportCaption($this->DateOfAppealLetter);
					$doc->exportCaption($this->DateAppealReceived);
					$doc->exportCaption($this->DateConcluded);
					$doc->exportCaption($this->AppealStatus);
					$doc->exportCaption($this->DiciplinaryHearing);
					$doc->exportCaption($this->AppealNotes);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->CaseNo);
					$doc->exportCaption($this->OffenseCode);
					$doc->exportCaption($this->ActionTaken);
					$doc->exportCaption($this->OffenseDate);
					$doc->exportCaption($this->ActionDate);
					$doc->exportCaption($this->DateOfAppealLetter);
					$doc->exportCaption($this->DateAppealReceived);
					$doc->exportCaption($this->DateConcluded);
					$doc->exportCaption($this->AppealStatus);
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
						$doc->exportField($this->CaseNo);
						$doc->exportField($this->OffenseCode);
						$doc->exportField($this->CaseDescription);
						$doc->exportField($this->ActionTaken);
						$doc->exportField($this->OffenseDate);
						$doc->exportField($this->ActionDate);
						$doc->exportField($this->DateOfAppealLetter);
						$doc->exportField($this->DateAppealReceived);
						$doc->exportField($this->DateConcluded);
						$doc->exportField($this->AppealStatus);
						$doc->exportField($this->DiciplinaryHearing);
						$doc->exportField($this->AppealNotes);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->CaseNo);
						$doc->exportField($this->OffenseCode);
						$doc->exportField($this->ActionTaken);
						$doc->exportField($this->OffenseDate);
						$doc->exportField($this->ActionDate);
						$doc->exportField($this->DateOfAppealLetter);
						$doc->exportField($this->DateAppealReceived);
						$doc->exportField($this->DateConcluded);
						$doc->exportField($this->AppealStatus);
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
		$table = 'staffdisciplinary_case';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'staffdisciplinary_case';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['CaseNo'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['OffenseCode'];

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
		$table = 'staffdisciplinary_case';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['CaseNo'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['OffenseCode'];

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
		$table = 'staffdisciplinary_case';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['CaseNo'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['OffenseCode'];

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