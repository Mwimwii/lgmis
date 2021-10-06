<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for council_meeting
 */
class council_meeting extends DbTable
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
	public $MeetingNo;
	public $MeetingRef;
	public $MeetingType;
	public $LACode;
	public $PlannedDate;
	public $ActualDate;
	public $DateAuthorisedByPLGO;
	public $Attendance;
	public $ChairedBy;
	public $Minutes;
	public $MinutesUploaded;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'council_meeting';
		$this->TableName = 'council_meeting';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`council_meeting`";
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

		// MeetingNo
		$this->MeetingNo = new DbField('council_meeting', 'council_meeting', 'x_MeetingNo', 'MeetingNo', '`MeetingNo`', '`MeetingNo`', 3, 11, -1, FALSE, '`MeetingNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->MeetingNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->MeetingNo->IsPrimaryKey = TRUE; // Primary key field
		$this->MeetingNo->IsForeignKey = TRUE; // Foreign key field
		$this->MeetingNo->Sortable = TRUE; // Allow sort
		$this->MeetingNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeetingNo'] = &$this->MeetingNo;

		// MeetingRef
		$this->MeetingRef = new DbField('council_meeting', 'council_meeting', 'x_MeetingRef', 'MeetingRef', '`MeetingRef`', '`MeetingRef`', 200, 20, -1, FALSE, '`MeetingRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MeetingRef->Sortable = TRUE; // Allow sort
		$this->fields['MeetingRef'] = &$this->MeetingRef;

		// MeetingType
		$this->MeetingType = new DbField('council_meeting', 'council_meeting', 'x_MeetingType', 'MeetingType', '`MeetingType`', '`MeetingType`', 16, 4, -1, FALSE, '`MeetingType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MeetingType->Nullable = FALSE; // NOT NULL field
		$this->MeetingType->Required = TRUE; // Required field
		$this->MeetingType->Sortable = TRUE; // Allow sort
		$this->MeetingType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MeetingType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MeetingType->Lookup = new Lookup('MeetingType', 'council_meeting_type', FALSE, 'MeetingType', ["MeetingTypeName","","",""], [], [], [], [], [], [], '', '');
		$this->MeetingType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeetingType'] = &$this->MeetingType;

		// LACode
		$this->LACode = new DbField('council_meeting', 'council_meeting', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// PlannedDate
		$this->PlannedDate = new DbField('council_meeting', 'council_meeting', 'x_PlannedDate', 'PlannedDate', '`PlannedDate`', CastDateFieldForLike("`PlannedDate`", 0, "DB"), 135, 19, 0, FALSE, '`PlannedDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedDate->Required = TRUE; // Required field
		$this->PlannedDate->Sortable = TRUE; // Allow sort
		$this->PlannedDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedDate'] = &$this->PlannedDate;

		// ActualDate
		$this->ActualDate = new DbField('council_meeting', 'council_meeting', 'x_ActualDate', 'ActualDate', '`ActualDate`', CastDateFieldForLike("`ActualDate`", 0, "DB"), 135, 19, 0, FALSE, '`ActualDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualDate->Sortable = TRUE; // Allow sort
		$this->ActualDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualDate'] = &$this->ActualDate;

		// DateAuthorisedByPLGO
		$this->DateAuthorisedByPLGO = new DbField('council_meeting', 'council_meeting', 'x_DateAuthorisedByPLGO', 'DateAuthorisedByPLGO', '`DateAuthorisedByPLGO`', CastDateFieldForLike("`DateAuthorisedByPLGO`", 0, "DB"), 135, 19, 0, FALSE, '`DateAuthorisedByPLGO`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateAuthorisedByPLGO->Sortable = TRUE; // Allow sort
		$this->DateAuthorisedByPLGO->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateAuthorisedByPLGO'] = &$this->DateAuthorisedByPLGO;

		// Attendance
		$this->Attendance = new DbField('council_meeting', 'council_meeting', 'x_Attendance', 'Attendance', '`Attendance`', '`Attendance`', 200, 255, -1, FALSE, '`Attendance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Attendance->Sortable = TRUE; // Allow sort
		$this->fields['Attendance'] = &$this->Attendance;

		// ChairedBy
		$this->ChairedBy = new DbField('council_meeting', 'council_meeting', 'x_ChairedBy', 'ChairedBy', '`ChairedBy`', '`ChairedBy`', 200, 255, -1, FALSE, '`ChairedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChairedBy->Sortable = TRUE; // Allow sort
		$this->fields['ChairedBy'] = &$this->ChairedBy;

		// Minutes
		$this->Minutes = new DbField('council_meeting', 'council_meeting', 'x_Minutes', 'Minutes', '`Minutes`', '`Minutes`', 201, -1, -1, FALSE, '`Minutes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Minutes->Sortable = TRUE; // Allow sort
		$this->fields['Minutes'] = &$this->Minutes;

		// MinutesUploaded
		$this->MinutesUploaded = new DbField('council_meeting', 'council_meeting', 'x_MinutesUploaded', 'MinutesUploaded', '`MinutesUploaded`', '`MinutesUploaded`', 205, 0, -1, TRUE, '`MinutesUploaded`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->MinutesUploaded->Sortable = TRUE; // Allow sort
		$this->fields['MinutesUploaded'] = &$this->MinutesUploaded;
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
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
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
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
	}

	// Detail filter
	public function sqlDetailFilter_local_authority()
	{
		return "`LACode`='@LACode@'";
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
		if ($this->getCurrentDetailTable() == "council_resolution") {
			$detailUrl = $GLOBALS["council_resolution"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_MeetingNo=" . urlencode($this->MeetingNo->CurrentValue);
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "council_meetinglist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`council_meeting`";
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
			$this->MeetingNo->setDbValue($conn->insert_ID());
			$rs['MeetingNo'] = $this->MeetingNo->DbValue;
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
			$fldname = 'MeetingNo';
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
			if (array_key_exists('MeetingNo', $rs))
				AddFilter($where, QuotedName('MeetingNo', $this->Dbid) . '=' . QuotedValue($rs['MeetingNo'], $this->MeetingNo->DataType, $this->Dbid));
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
		$this->MeetingNo->DbValue = $row['MeetingNo'];
		$this->MeetingRef->DbValue = $row['MeetingRef'];
		$this->MeetingType->DbValue = $row['MeetingType'];
		$this->LACode->DbValue = $row['LACode'];
		$this->PlannedDate->DbValue = $row['PlannedDate'];
		$this->ActualDate->DbValue = $row['ActualDate'];
		$this->DateAuthorisedByPLGO->DbValue = $row['DateAuthorisedByPLGO'];
		$this->Attendance->DbValue = $row['Attendance'];
		$this->ChairedBy->DbValue = $row['ChairedBy'];
		$this->Minutes->DbValue = $row['Minutes'];
		$this->MinutesUploaded->Upload->DbValue = $row['MinutesUploaded'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`MeetingNo` = @MeetingNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('MeetingNo', $row) ? $row['MeetingNo'] : NULL;
		else
			$val = $this->MeetingNo->OldValue !== NULL ? $this->MeetingNo->OldValue : $this->MeetingNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@MeetingNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "council_meetinglist.php";
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
		if ($pageName == "council_meetingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "council_meetingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "council_meetingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "council_meetinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("council_meetingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("council_meetingview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "council_meetingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "council_meetingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("council_meetingedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("council_meetingedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("council_meetingadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("council_meetingadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("council_meetingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "local_authority" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "MeetingNo:" . JsonEncode($this->MeetingNo->CurrentValue, "number");
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
		if ($this->MeetingNo->CurrentValue != NULL) {
			$url .= "MeetingNo=" . urlencode($this->MeetingNo->CurrentValue);
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
			if (Param("MeetingNo") !== NULL)
				$arKeys[] = Param("MeetingNo");
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
				$this->MeetingNo->CurrentValue = $key;
			else
				$this->MeetingNo->OldValue = $key;
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
		$this->MeetingNo->setDbValue($rs->fields('MeetingNo'));
		$this->MeetingRef->setDbValue($rs->fields('MeetingRef'));
		$this->MeetingType->setDbValue($rs->fields('MeetingType'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->PlannedDate->setDbValue($rs->fields('PlannedDate'));
		$this->ActualDate->setDbValue($rs->fields('ActualDate'));
		$this->DateAuthorisedByPLGO->setDbValue($rs->fields('DateAuthorisedByPLGO'));
		$this->Attendance->setDbValue($rs->fields('Attendance'));
		$this->ChairedBy->setDbValue($rs->fields('ChairedBy'));
		$this->Minutes->setDbValue($rs->fields('Minutes'));
		$this->MinutesUploaded->Upload->DbValue = $rs->fields('MinutesUploaded');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// MeetingNo
		// MeetingRef
		// MeetingType
		// LACode
		// PlannedDate
		// ActualDate
		// DateAuthorisedByPLGO
		// Attendance
		// ChairedBy
		// Minutes
		// MinutesUploaded
		// MeetingNo

		$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
		$this->MeetingNo->ViewCustomAttributes = "";

		// MeetingRef
		$this->MeetingRef->ViewValue = $this->MeetingRef->CurrentValue;
		$this->MeetingRef->ViewCustomAttributes = "";

		// MeetingType
		$curVal = strval($this->MeetingType->CurrentValue);
		if ($curVal != "") {
			$this->MeetingType->ViewValue = $this->MeetingType->lookupCacheOption($curVal);
			if ($this->MeetingType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MeetingType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->MeetingType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MeetingType->ViewValue = $this->MeetingType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MeetingType->ViewValue = $this->MeetingType->CurrentValue;
				}
			}
		} else {
			$this->MeetingType->ViewValue = NULL;
		}
		$this->MeetingType->ViewCustomAttributes = "";

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

		// PlannedDate
		$this->PlannedDate->ViewValue = $this->PlannedDate->CurrentValue;
		$this->PlannedDate->ViewValue = FormatDateTime($this->PlannedDate->ViewValue, 0);
		$this->PlannedDate->ViewCustomAttributes = "";

		// ActualDate
		$this->ActualDate->ViewValue = $this->ActualDate->CurrentValue;
		$this->ActualDate->ViewValue = FormatDateTime($this->ActualDate->ViewValue, 0);
		$this->ActualDate->ViewCustomAttributes = "";

		// DateAuthorisedByPLGO
		$this->DateAuthorisedByPLGO->ViewValue = $this->DateAuthorisedByPLGO->CurrentValue;
		$this->DateAuthorisedByPLGO->ViewValue = FormatDateTime($this->DateAuthorisedByPLGO->ViewValue, 0);
		$this->DateAuthorisedByPLGO->ViewCustomAttributes = "";

		// Attendance
		$this->Attendance->ViewValue = $this->Attendance->CurrentValue;
		$this->Attendance->ViewCustomAttributes = "";

		// ChairedBy
		$this->ChairedBy->ViewValue = $this->ChairedBy->CurrentValue;
		$this->ChairedBy->ViewCustomAttributes = "";

		// Minutes
		$this->Minutes->ViewValue = $this->Minutes->CurrentValue;
		$this->Minutes->ViewCustomAttributes = "";

		// MinutesUploaded
		if (!EmptyValue($this->MinutesUploaded->Upload->DbValue)) {
			$this->MinutesUploaded->ViewValue = $this->MeetingNo->CurrentValue;
			$this->MinutesUploaded->IsBlobImage = IsImageFile(ContentExtension($this->MinutesUploaded->Upload->DbValue));
		} else {
			$this->MinutesUploaded->ViewValue = "";
		}
		$this->MinutesUploaded->ViewCustomAttributes = "";

		// MeetingNo
		$this->MeetingNo->LinkCustomAttributes = "";
		$this->MeetingNo->HrefValue = "";
		$this->MeetingNo->TooltipValue = "";

		// MeetingRef
		$this->MeetingRef->LinkCustomAttributes = "";
		$this->MeetingRef->HrefValue = "";
		$this->MeetingRef->TooltipValue = "";

		// MeetingType
		$this->MeetingType->LinkCustomAttributes = "";
		$this->MeetingType->HrefValue = "";
		$this->MeetingType->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// PlannedDate
		$this->PlannedDate->LinkCustomAttributes = "";
		$this->PlannedDate->HrefValue = "";
		$this->PlannedDate->TooltipValue = "";

		// ActualDate
		$this->ActualDate->LinkCustomAttributes = "";
		$this->ActualDate->HrefValue = "";
		$this->ActualDate->TooltipValue = "";

		// DateAuthorisedByPLGO
		$this->DateAuthorisedByPLGO->LinkCustomAttributes = "";
		$this->DateAuthorisedByPLGO->HrefValue = "";
		$this->DateAuthorisedByPLGO->TooltipValue = "";

		// Attendance
		$this->Attendance->LinkCustomAttributes = "";
		$this->Attendance->HrefValue = "";
		$this->Attendance->TooltipValue = "";

		// ChairedBy
		$this->ChairedBy->LinkCustomAttributes = "";
		$this->ChairedBy->HrefValue = "";
		$this->ChairedBy->TooltipValue = "";

		// Minutes
		$this->Minutes->LinkCustomAttributes = "";
		$this->Minutes->HrefValue = "";
		$this->Minutes->TooltipValue = "";

		// MinutesUploaded
		$this->MinutesUploaded->LinkCustomAttributes = "";
		if (!empty($this->MinutesUploaded->Upload->DbValue)) {
			$this->MinutesUploaded->HrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
			$this->MinutesUploaded->LinkAttrs["target"] = "";
			if ($this->MinutesUploaded->IsBlobImage && empty($this->MinutesUploaded->LinkAttrs["target"]))
				$this->MinutesUploaded->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->MinutesUploaded->HrefValue = FullUrl($this->MinutesUploaded->HrefValue, "href");
		} else {
			$this->MinutesUploaded->HrefValue = "";
		}
		$this->MinutesUploaded->ExportHrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
		$this->MinutesUploaded->TooltipValue = "";

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

		// MeetingNo
		$this->MeetingNo->EditAttrs["class"] = "form-control";
		$this->MeetingNo->EditCustomAttributes = "";
		$this->MeetingNo->EditValue = $this->MeetingNo->CurrentValue;
		$this->MeetingNo->ViewCustomAttributes = "";

		// MeetingRef
		$this->MeetingRef->EditAttrs["class"] = "form-control";
		$this->MeetingRef->EditCustomAttributes = "";
		if (!$this->MeetingRef->Raw)
			$this->MeetingRef->CurrentValue = HtmlDecode($this->MeetingRef->CurrentValue);
		$this->MeetingRef->EditValue = $this->MeetingRef->CurrentValue;
		$this->MeetingRef->PlaceHolder = RemoveHtml($this->MeetingRef->caption());

		// MeetingType
		$this->MeetingType->EditAttrs["class"] = "form-control";
		$this->MeetingType->EditCustomAttributes = "";

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

		// PlannedDate
		$this->PlannedDate->EditAttrs["class"] = "form-control";
		$this->PlannedDate->EditCustomAttributes = "";
		$this->PlannedDate->EditValue = FormatDateTime($this->PlannedDate->CurrentValue, 8);
		$this->PlannedDate->PlaceHolder = RemoveHtml($this->PlannedDate->caption());

		// ActualDate
		$this->ActualDate->EditAttrs["class"] = "form-control";
		$this->ActualDate->EditCustomAttributes = "";
		$this->ActualDate->EditValue = FormatDateTime($this->ActualDate->CurrentValue, 8);
		$this->ActualDate->PlaceHolder = RemoveHtml($this->ActualDate->caption());

		// DateAuthorisedByPLGO
		$this->DateAuthorisedByPLGO->EditAttrs["class"] = "form-control";
		$this->DateAuthorisedByPLGO->EditCustomAttributes = "";
		$this->DateAuthorisedByPLGO->EditValue = FormatDateTime($this->DateAuthorisedByPLGO->CurrentValue, 8);
		$this->DateAuthorisedByPLGO->PlaceHolder = RemoveHtml($this->DateAuthorisedByPLGO->caption());

		// Attendance
		$this->Attendance->EditAttrs["class"] = "form-control";
		$this->Attendance->EditCustomAttributes = "";
		if (!$this->Attendance->Raw)
			$this->Attendance->CurrentValue = HtmlDecode($this->Attendance->CurrentValue);
		$this->Attendance->EditValue = $this->Attendance->CurrentValue;
		$this->Attendance->PlaceHolder = RemoveHtml($this->Attendance->caption());

		// ChairedBy
		$this->ChairedBy->EditAttrs["class"] = "form-control";
		$this->ChairedBy->EditCustomAttributes = "";
		if (!$this->ChairedBy->Raw)
			$this->ChairedBy->CurrentValue = HtmlDecode($this->ChairedBy->CurrentValue);
		$this->ChairedBy->EditValue = $this->ChairedBy->CurrentValue;
		$this->ChairedBy->PlaceHolder = RemoveHtml($this->ChairedBy->caption());

		// Minutes
		$this->Minutes->EditAttrs["class"] = "form-control";
		$this->Minutes->EditCustomAttributes = "";
		$this->Minutes->EditValue = $this->Minutes->CurrentValue;
		$this->Minutes->PlaceHolder = RemoveHtml($this->Minutes->caption());

		// MinutesUploaded
		$this->MinutesUploaded->EditAttrs["class"] = "form-control";
		$this->MinutesUploaded->EditCustomAttributes = "";
		if (!EmptyValue($this->MinutesUploaded->Upload->DbValue)) {
			$this->MinutesUploaded->EditValue = $this->MeetingNo->CurrentValue;
			$this->MinutesUploaded->IsBlobImage = IsImageFile(ContentExtension($this->MinutesUploaded->Upload->DbValue));
		} else {
			$this->MinutesUploaded->EditValue = "";
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
					$doc->exportCaption($this->MeetingNo);
					$doc->exportCaption($this->MeetingRef);
					$doc->exportCaption($this->MeetingType);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PlannedDate);
					$doc->exportCaption($this->ActualDate);
					$doc->exportCaption($this->Attendance);
					$doc->exportCaption($this->ChairedBy);
					$doc->exportCaption($this->Minutes);
					$doc->exportCaption($this->MinutesUploaded);
				} else {
					$doc->exportCaption($this->MeetingNo);
					$doc->exportCaption($this->MeetingRef);
					$doc->exportCaption($this->MeetingType);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->PlannedDate);
					$doc->exportCaption($this->ActualDate);
					$doc->exportCaption($this->Attendance);
					$doc->exportCaption($this->ChairedBy);
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
						$doc->exportField($this->MeetingNo);
						$doc->exportField($this->MeetingRef);
						$doc->exportField($this->MeetingType);
						$doc->exportField($this->LACode);
						$doc->exportField($this->PlannedDate);
						$doc->exportField($this->ActualDate);
						$doc->exportField($this->Attendance);
						$doc->exportField($this->ChairedBy);
						$doc->exportField($this->Minutes);
						$doc->exportField($this->MinutesUploaded);
					} else {
						$doc->exportField($this->MeetingNo);
						$doc->exportField($this->MeetingRef);
						$doc->exportField($this->MeetingType);
						$doc->exportField($this->LACode);
						$doc->exportField($this->PlannedDate);
						$doc->exportField($this->ActualDate);
						$doc->exportField($this->Attendance);
						$doc->exportField($this->ChairedBy);
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
		if ($fldparm == 'MinutesUploaded') {
			$fldName = "MinutesUploaded";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->MeetingNo->CurrentValue = $ar[0];
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
		$table = 'council_meeting';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'council_meeting';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['MeetingNo'];

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
		$table = 'council_meeting';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['MeetingNo'];

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
		$table = 'council_meeting';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['MeetingNo'];

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

	/*	$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
	*/	
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

	/*	//set filter for departments in LA	
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid <> -1) && ($dept["kountdept"] > 0)) {
		AddFilter($filter,"`DepartmentCode`  in   (select DISTINCT DepartmentCode
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
		AddFilter($filter,"`SectionCode`  in   (select DISTINCT SectionCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
	*/
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