<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for outcome
 */
class outcome extends DbTable
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
	public $OutcomeCode;
	public $OutcomeName;
	public $StrategicObjectiveCode;
	public $LACode;
	public $DepartmentCode;
	public $ResultAreaCode;
	public $OutcomeKPI;
	public $Assumptions;
	public $ResponsibleOfficer;
	public $OutcomeStatus;
	public $LockStatus;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'outcome';
		$this->TableName = 'outcome';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`outcome`";
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

		// OutcomeCode
		$this->OutcomeCode = new DbField('outcome', 'outcome', 'x_OutcomeCode', 'OutcomeCode', '`OutcomeCode`', '`OutcomeCode`', 3, 11, -1, FALSE, '`OutcomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->OutcomeCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->OutcomeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->OutcomeCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutcomeCode->Sortable = TRUE; // Allow sort
		$this->OutcomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutcomeCode'] = &$this->OutcomeCode;

		// OutcomeName
		$this->OutcomeName = new DbField('outcome', 'outcome', 'x_OutcomeName', 'OutcomeName', '`OutcomeName`', '`OutcomeName`', 200, 255, -1, FALSE, '`OutcomeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutcomeName->Nullable = FALSE; // NOT NULL field
		$this->OutcomeName->Required = TRUE; // Required field
		$this->OutcomeName->Sortable = TRUE; // Allow sort
		$this->fields['OutcomeName'] = &$this->OutcomeName;

		// StrategicObjectiveCode
		$this->StrategicObjectiveCode = new DbField('outcome', 'outcome', 'x_StrategicObjectiveCode', 'StrategicObjectiveCode', '`StrategicObjectiveCode`', '`StrategicObjectiveCode`', 3, 11, -1, FALSE, '`StrategicObjectiveCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StrategicObjectiveCode->IsForeignKey = TRUE; // Foreign key field
		$this->StrategicObjectiveCode->Nullable = FALSE; // NOT NULL field
		$this->StrategicObjectiveCode->Required = TRUE; // Required field
		$this->StrategicObjectiveCode->Sortable = TRUE; // Allow sort
		$this->StrategicObjectiveCode->Lookup = new Lookup('StrategicObjectiveCode', 'strategic_objective', FALSE, 'StrategicObjectiveCode', ["StrategicObjectiveName","","",""], [], [], [], [], [], [], '', '');
		$this->StrategicObjectiveCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['StrategicObjectiveCode'] = &$this->StrategicObjectiveCode;

		// LACode
		$this->LACode = new DbField('outcome', 'outcome', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_DepartmentCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('outcome', 'outcome', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], [], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// ResultAreaCode
		$this->ResultAreaCode = new DbField('outcome', 'outcome', 'x_ResultAreaCode', 'ResultAreaCode', '`ResultAreaCode`', '`ResultAreaCode`', 3, 11, -1, FALSE, '`ResultAreaCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ResultAreaCode->Nullable = FALSE; // NOT NULL field
		$this->ResultAreaCode->Required = TRUE; // Required field
		$this->ResultAreaCode->Sortable = TRUE; // Allow sort
		$this->ResultAreaCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ResultAreaCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ResultAreaCode->Lookup = new Lookup('ResultAreaCode', 'result_area', FALSE, 'ResultAreaCode', ["ResultAreaName","","",""], [], [], [], [], [], [], '', '');
		$this->ResultAreaCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ResultAreaCode'] = &$this->ResultAreaCode;

		// OutcomeKPI
		$this->OutcomeKPI = new DbField('outcome', 'outcome', 'x_OutcomeKPI', 'OutcomeKPI', '`OutcomeKPI`', '`OutcomeKPI`', 200, 255, -1, FALSE, '`OutcomeKPI`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->OutcomeKPI->Sortable = TRUE; // Allow sort
		$this->fields['OutcomeKPI'] = &$this->OutcomeKPI;

		// Assumptions
		$this->Assumptions = new DbField('outcome', 'outcome', 'x_Assumptions', 'Assumptions', '`Assumptions`', '`Assumptions`', 200, 255, -1, FALSE, '`Assumptions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Assumptions->Required = TRUE; // Required field
		$this->Assumptions->Sortable = TRUE; // Allow sort
		$this->fields['Assumptions'] = &$this->Assumptions;

		// ResponsibleOfficer
		$this->ResponsibleOfficer = new DbField('outcome', 'outcome', 'x_ResponsibleOfficer', 'ResponsibleOfficer', '`ResponsibleOfficer`', '`ResponsibleOfficer`', 200, 100, -1, FALSE, '`ResponsibleOfficer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ResponsibleOfficer->Required = TRUE; // Required field
		$this->ResponsibleOfficer->Sortable = TRUE; // Allow sort
		$this->fields['ResponsibleOfficer'] = &$this->ResponsibleOfficer;

		// OutcomeStatus
		$this->OutcomeStatus = new DbField('outcome', 'outcome', 'x_OutcomeStatus', 'OutcomeStatus', '`OutcomeStatus`', '`OutcomeStatus`', 3, 2, -1, FALSE, '`OutcomeStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutcomeStatus->Sortable = TRUE; // Allow sort
		$this->OutcomeStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutcomeStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutcomeStatus->Lookup = new Lookup('OutcomeStatus', 'progress_status', FALSE, 'ProgressCode', ["ProgressDescription","","",""], [], [], [], [], [], [], '', '');
		$this->fields['OutcomeStatus'] = &$this->OutcomeStatus;

		// LockStatus
		$this->LockStatus = new DbField('outcome', 'outcome', 'x_LockStatus', 'LockStatus', '`LockStatus`', '`LockStatus`', 3, 11, -1, FALSE, '`LockStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LockStatus->Sortable = TRUE; // Allow sort
		$this->LockStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LockStatus'] = &$this->LockStatus;
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
		if ($this->getCurrentMasterTable() == "strategic_objective") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->StrategicObjectiveCode->getSessionValue() != "")
				$masterFilter .= " AND `StrategicObjectiveCode`=" . QuotedValue($this->StrategicObjectiveCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "strategic_objective") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->StrategicObjectiveCode->getSessionValue() != "")
				$detailFilter .= " AND `StrategicObjectiveCode`=" . QuotedValue($this->StrategicObjectiveCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_strategic_objective()
	{
		return "`LACode`='@LACode@' AND `StrategicObjectiveCode`=@StrategicObjectiveCode@";
	}

	// Detail filter
	public function sqlDetailFilter_strategic_objective()
	{
		return "`LACode`='@LACode@' AND `StrategicObjectiveCode`=@StrategicObjectiveCode@";
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
		if ($this->getCurrentDetailTable() == "output") {
			$detailUrl = $GLOBALS["output"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "outcomelist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`outcome`";
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
			$this->OutcomeCode->setDbValue($conn->insert_ID());
			$rs['OutcomeCode'] = $this->OutcomeCode->DbValue;
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

		// Cascade Update detail table 'output'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['OutcomeCode']) && $rsold['OutcomeCode'] != $rs['OutcomeCode'])) { // Update detail field 'OutcomeCode'
			$cascadeUpdate = TRUE;
			$rscascade['OutcomeCode'] = $rs['OutcomeCode'];
		}
		if ($rsold && (isset($rs['LACode']) && $rsold['LACode'] != $rs['LACode'])) { // Update detail field 'LACode'
			$cascadeUpdate = TRUE;
			$rscascade['LACode'] = $rs['LACode'];
		}
		if ($rsold && (isset($rs['DepartmentCode']) && $rsold['DepartmentCode'] != $rs['DepartmentCode'])) { // Update detail field 'DepartmentCode'
			$cascadeUpdate = TRUE;
			$rscascade['DepartmentCode'] = $rs['DepartmentCode'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["output"]))
				$GLOBALS["output"] = new output();
			$rswrk = $GLOBALS["output"]->loadRs("`OutcomeCode` = " . QuotedValue($rsold['OutcomeCode'], DATATYPE_NUMBER, 'DB') . " AND " . "`LACode` = " . QuotedValue($rsold['LACode'], DATATYPE_STRING, 'DB') . " AND " . "`DepartmentCode` = " . QuotedValue($rsold['DepartmentCode'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'OutputCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["output"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["output"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["output"]->Row_Updated($rsdtlold, $rsdtlnew);
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
			if (array_key_exists('OutcomeCode', $rs))
				AddFilter($where, QuotedName('OutcomeCode', $this->Dbid) . '=' . QuotedValue($rs['OutcomeCode'], $this->OutcomeCode->DataType, $this->Dbid));
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

		// Cascade delete detail table 'output'
		if (!isset($GLOBALS["output"]))
			$GLOBALS["output"] = new output();
		$rscascade = $GLOBALS["output"]->loadRs("`OutcomeCode` = " . QuotedValue($rs['OutcomeCode'], DATATYPE_NUMBER, "DB") . " AND " . "`LACode` = " . QuotedValue($rs['LACode'], DATATYPE_STRING, "DB") . " AND " . "`DepartmentCode` = " . QuotedValue($rs['DepartmentCode'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["output"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["output"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["output"]->Row_Deleted($dtlrow);
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
		$this->OutcomeCode->DbValue = $row['OutcomeCode'];
		$this->OutcomeName->DbValue = $row['OutcomeName'];
		$this->StrategicObjectiveCode->DbValue = $row['StrategicObjectiveCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->ResultAreaCode->DbValue = $row['ResultAreaCode'];
		$this->OutcomeKPI->DbValue = $row['OutcomeKPI'];
		$this->Assumptions->DbValue = $row['Assumptions'];
		$this->ResponsibleOfficer->DbValue = $row['ResponsibleOfficer'];
		$this->OutcomeStatus->DbValue = $row['OutcomeStatus'];
		$this->LockStatus->DbValue = $row['LockStatus'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`OutcomeCode` = @OutcomeCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('OutcomeCode', $row) ? $row['OutcomeCode'] : NULL;
		else
			$val = $this->OutcomeCode->OldValue !== NULL ? $this->OutcomeCode->OldValue : $this->OutcomeCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@OutcomeCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "outcomelist.php";
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
		if ($pageName == "outcomeview.php")
			return $Language->phrase("View");
		elseif ($pageName == "outcomeedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "outcomeadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "outcomelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("outcomeview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outcomeview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "outcomeadd.php?" . $this->getUrlParm($parm);
		else
			$url = "outcomeadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("outcomeedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outcomeedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("outcomeadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("outcomeadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("outcomedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "strategic_objective" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_StrategicObjectiveCode=" . urlencode($this->StrategicObjectiveCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "OutcomeCode:" . JsonEncode($this->OutcomeCode->CurrentValue, "number");
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
		if ($this->OutcomeCode->CurrentValue != NULL) {
			$url .= "OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
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
			if (Param("OutcomeCode") !== NULL)
				$arKeys[] = Param("OutcomeCode");
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
				$this->OutcomeCode->CurrentValue = $key;
			else
				$this->OutcomeCode->OldValue = $key;
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
		$this->OutcomeCode->setDbValue($rs->fields('OutcomeCode'));
		$this->OutcomeName->setDbValue($rs->fields('OutcomeName'));
		$this->StrategicObjectiveCode->setDbValue($rs->fields('StrategicObjectiveCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->ResultAreaCode->setDbValue($rs->fields('ResultAreaCode'));
		$this->OutcomeKPI->setDbValue($rs->fields('OutcomeKPI'));
		$this->Assumptions->setDbValue($rs->fields('Assumptions'));
		$this->ResponsibleOfficer->setDbValue($rs->fields('ResponsibleOfficer'));
		$this->OutcomeStatus->setDbValue($rs->fields('OutcomeStatus'));
		$this->LockStatus->setDbValue($rs->fields('LockStatus'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// OutcomeCode
		// OutcomeName
		// StrategicObjectiveCode
		// LACode
		// DepartmentCode
		// ResultAreaCode
		// OutcomeKPI
		// Assumptions
		// ResponsibleOfficer
		// OutcomeStatus
		// LockStatus
		// OutcomeCode

		$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
		$this->OutcomeCode->ViewCustomAttributes = "";

		// OutcomeName
		$this->OutcomeName->ViewValue = $this->OutcomeName->CurrentValue;
		$this->OutcomeName->ViewCustomAttributes = "";

		// StrategicObjectiveCode
		$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
		$curVal = strval($this->StrategicObjectiveCode->CurrentValue);
		if ($curVal != "") {
			$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->lookupCacheOption($curVal);
			if ($this->StrategicObjectiveCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`StrategicObjectiveCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->StrategicObjectiveCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
				}
			}
		} else {
			$this->StrategicObjectiveCode->ViewValue = NULL;
		}
		$this->StrategicObjectiveCode->ViewCustomAttributes = "";

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

		// ResultAreaCode
		$curVal = strval($this->ResultAreaCode->CurrentValue);
		if ($curVal != "") {
			$this->ResultAreaCode->ViewValue = $this->ResultAreaCode->lookupCacheOption($curVal);
			if ($this->ResultAreaCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ResultAreaCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ResultAreaCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ResultAreaCode->ViewValue = $this->ResultAreaCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ResultAreaCode->ViewValue = $this->ResultAreaCode->CurrentValue;
				}
			}
		} else {
			$this->ResultAreaCode->ViewValue = NULL;
		}
		$this->ResultAreaCode->ViewCustomAttributes = "";

		// OutcomeKPI
		$this->OutcomeKPI->ViewValue = $this->OutcomeKPI->CurrentValue;
		$this->OutcomeKPI->ViewCustomAttributes = "";

		// Assumptions
		$this->Assumptions->ViewValue = $this->Assumptions->CurrentValue;
		$this->Assumptions->ViewCustomAttributes = "";

		// ResponsibleOfficer
		$this->ResponsibleOfficer->ViewValue = $this->ResponsibleOfficer->CurrentValue;
		$this->ResponsibleOfficer->ViewCustomAttributes = "";

		// OutcomeStatus
		$curVal = strval($this->OutcomeStatus->CurrentValue);
		if ($curVal != "") {
			$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->lookupCacheOption($curVal);
			if ($this->OutcomeStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutcomeStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->CurrentValue;
				}
			}
		} else {
			$this->OutcomeStatus->ViewValue = NULL;
		}
		$this->OutcomeStatus->ViewCustomAttributes = "";

		// LockStatus
		$this->LockStatus->ViewValue = $this->LockStatus->CurrentValue;
		$this->LockStatus->ViewCustomAttributes = "";

		// OutcomeCode
		$this->OutcomeCode->LinkCustomAttributes = "";
		$this->OutcomeCode->HrefValue = "";
		$this->OutcomeCode->TooltipValue = "";

		// OutcomeName
		$this->OutcomeName->LinkCustomAttributes = "";
		$this->OutcomeName->HrefValue = "";
		$this->OutcomeName->TooltipValue = "";

		// StrategicObjectiveCode
		$this->StrategicObjectiveCode->LinkCustomAttributes = "";
		$this->StrategicObjectiveCode->HrefValue = "";
		$this->StrategicObjectiveCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// ResultAreaCode
		$this->ResultAreaCode->LinkCustomAttributes = "";
		$this->ResultAreaCode->HrefValue = "";
		$this->ResultAreaCode->TooltipValue = "";

		// OutcomeKPI
		$this->OutcomeKPI->LinkCustomAttributes = "";
		$this->OutcomeKPI->HrefValue = "";
		$this->OutcomeKPI->TooltipValue = "";

		// Assumptions
		$this->Assumptions->LinkCustomAttributes = "";
		$this->Assumptions->HrefValue = "";
		$this->Assumptions->TooltipValue = "";

		// ResponsibleOfficer
		$this->ResponsibleOfficer->LinkCustomAttributes = "";
		$this->ResponsibleOfficer->HrefValue = "";
		$this->ResponsibleOfficer->TooltipValue = "";

		// OutcomeStatus
		$this->OutcomeStatus->LinkCustomAttributes = "";
		$this->OutcomeStatus->HrefValue = "";
		$this->OutcomeStatus->TooltipValue = "";

		// LockStatus
		$this->LockStatus->LinkCustomAttributes = "";
		$this->LockStatus->HrefValue = "";
		$this->LockStatus->TooltipValue = "";

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

		// OutcomeCode
		$this->OutcomeCode->EditAttrs["class"] = "form-control";
		$this->OutcomeCode->EditCustomAttributes = "";
		$this->OutcomeCode->EditValue = $this->OutcomeCode->CurrentValue;
		$this->OutcomeCode->ViewCustomAttributes = "";

		// OutcomeName
		$this->OutcomeName->EditAttrs["class"] = "form-control";
		$this->OutcomeName->EditCustomAttributes = "";
		$this->OutcomeName->EditValue = $this->OutcomeName->CurrentValue;
		$this->OutcomeName->PlaceHolder = RemoveHtml($this->OutcomeName->caption());

		// StrategicObjectiveCode
		$this->StrategicObjectiveCode->EditAttrs["class"] = "form-control";
		$this->StrategicObjectiveCode->EditCustomAttributes = "";
		if ($this->StrategicObjectiveCode->getSessionValue() != "") {
			$this->StrategicObjectiveCode->CurrentValue = $this->StrategicObjectiveCode->getSessionValue();
			$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
			$curVal = strval($this->StrategicObjectiveCode->CurrentValue);
			if ($curVal != "") {
				$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->lookupCacheOption($curVal);
				if ($this->StrategicObjectiveCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StrategicObjectiveCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->StrategicObjectiveCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
					}
				}
			} else {
				$this->StrategicObjectiveCode->ViewValue = NULL;
			}
			$this->StrategicObjectiveCode->ViewCustomAttributes = "";
		} else {
			$this->StrategicObjectiveCode->EditValue = $this->StrategicObjectiveCode->CurrentValue;
			$this->StrategicObjectiveCode->PlaceHolder = RemoveHtml($this->StrategicObjectiveCode->caption());
		}

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

		// ResultAreaCode
		$this->ResultAreaCode->EditAttrs["class"] = "form-control";
		$this->ResultAreaCode->EditCustomAttributes = "";

		// OutcomeKPI
		$this->OutcomeKPI->EditAttrs["class"] = "form-control";
		$this->OutcomeKPI->EditCustomAttributes = "";
		$this->OutcomeKPI->EditValue = $this->OutcomeKPI->CurrentValue;
		$this->OutcomeKPI->PlaceHolder = RemoveHtml($this->OutcomeKPI->caption());

		// Assumptions
		$this->Assumptions->EditAttrs["class"] = "form-control";
		$this->Assumptions->EditCustomAttributes = "";
		$this->Assumptions->EditValue = $this->Assumptions->CurrentValue;
		$this->Assumptions->PlaceHolder = RemoveHtml($this->Assumptions->caption());

		// ResponsibleOfficer
		$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
		$this->ResponsibleOfficer->EditCustomAttributes = "";
		if (!$this->ResponsibleOfficer->Raw)
			$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
		$this->ResponsibleOfficer->EditValue = $this->ResponsibleOfficer->CurrentValue;
		$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

		// OutcomeStatus
		$this->OutcomeStatus->EditAttrs["class"] = "form-control";
		$this->OutcomeStatus->EditCustomAttributes = "";

		// LockStatus
		$this->LockStatus->EditAttrs["class"] = "form-control";
		$this->LockStatus->EditCustomAttributes = "";
		$this->LockStatus->EditValue = $this->LockStatus->CurrentValue;
		$this->LockStatus->PlaceHolder = RemoveHtml($this->LockStatus->caption());

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
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutcomeName);
					$doc->exportCaption($this->StrategicObjectiveCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->OutcomeKPI);
					$doc->exportCaption($this->Assumptions);
					$doc->exportCaption($this->ResponsibleOfficer);
					$doc->exportCaption($this->OutcomeStatus);
				} else {
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutcomeName);
					$doc->exportCaption($this->StrategicObjectiveCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->OutcomeKPI);
					$doc->exportCaption($this->Assumptions);
					$doc->exportCaption($this->ResponsibleOfficer);
					$doc->exportCaption($this->OutcomeStatus);
					$doc->exportCaption($this->LockStatus);
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
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutcomeName);
						$doc->exportField($this->StrategicObjectiveCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->OutcomeKPI);
						$doc->exportField($this->Assumptions);
						$doc->exportField($this->ResponsibleOfficer);
						$doc->exportField($this->OutcomeStatus);
					} else {
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutcomeName);
						$doc->exportField($this->StrategicObjectiveCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->OutcomeKPI);
						$doc->exportField($this->Assumptions);
						$doc->exportField($this->ResponsibleOfficer);
						$doc->exportField($this->OutcomeStatus);
						$doc->exportField($this->LockStatus);
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