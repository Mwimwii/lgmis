<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for council_resolution
 */
class council_resolution extends DbTable
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
	public $MinuteNumber;
	public $Subject;
	public $Resolutionccategory;
	public $LACode;
	public $ResolutionNo;
	public $Resolution;
	public $Responsibility;
	public $ActionDate;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'council_resolution';
		$this->TableName = 'council_resolution';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`council_resolution`";
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
		$this->MeetingNo = new DbField('council_resolution', 'council_resolution', 'x_MeetingNo', 'MeetingNo', '`MeetingNo`', '`MeetingNo`', 3, 11, -1, FALSE, '`MeetingNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MeetingNo->IsForeignKey = TRUE; // Foreign key field
		$this->MeetingNo->Nullable = FALSE; // NOT NULL field
		$this->MeetingNo->Required = TRUE; // Required field
		$this->MeetingNo->Sortable = TRUE; // Allow sort
		$this->MeetingNo->Lookup = new Lookup('MeetingNo', 'council_meeting', FALSE, 'MeetingNo', ["MeetingNo","ActualDate","",""], [], [], [], [], [], [], '', '');
		$this->MeetingNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeetingNo'] = &$this->MeetingNo;

		// MinuteNumber
		$this->MinuteNumber = new DbField('council_resolution', 'council_resolution', 'x_MinuteNumber', 'MinuteNumber', '`MinuteNumber`', '`MinuteNumber`', 200, 50, -1, FALSE, '`MinuteNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MinuteNumber->Nullable = FALSE; // NOT NULL field
		$this->MinuteNumber->Required = TRUE; // Required field
		$this->MinuteNumber->Sortable = TRUE; // Allow sort
		$this->fields['MinuteNumber'] = &$this->MinuteNumber;

		// Subject
		$this->Subject = new DbField('council_resolution', 'council_resolution', 'x_Subject', 'Subject', '`Subject`', '`Subject`', 201, 16777215, -1, FALSE, '`Subject`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Subject->Nullable = FALSE; // NOT NULL field
		$this->Subject->Required = TRUE; // Required field
		$this->Subject->Sortable = TRUE; // Allow sort
		$this->fields['Subject'] = &$this->Subject;

		// Resolutionccategory
		$this->Resolutionccategory = new DbField('council_resolution', 'council_resolution', 'x_Resolutionccategory', 'Resolutionccategory', '`Resolutionccategory`', '`Resolutionccategory`', 3, 11, -1, FALSE, '`Resolutionccategory`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Resolutionccategory->Nullable = FALSE; // NOT NULL field
		$this->Resolutionccategory->Required = TRUE; // Required field
		$this->Resolutionccategory->Sortable = TRUE; // Allow sort
		$this->Resolutionccategory->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Resolutionccategory->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Resolutionccategory->Lookup = new Lookup('Resolutionccategory', 'resolution_category', FALSE, 'ResolutionCategoryCode', ["ResolutionCategoryName","","",""], [], [], [], [], [], [], '', '');
		$this->Resolutionccategory->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Resolutionccategory'] = &$this->Resolutionccategory;

		// LACode
		$this->LACode = new DbField('council_resolution', 'council_resolution', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// ResolutionNo
		$this->ResolutionNo = new DbField('council_resolution', 'council_resolution', 'x_ResolutionNo', 'ResolutionNo', '`ResolutionNo`', '`ResolutionNo`', 3, 11, -1, FALSE, '`ResolutionNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ResolutionNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ResolutionNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ResolutionNo->Sortable = TRUE; // Allow sort
		$this->ResolutionNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ResolutionNo'] = &$this->ResolutionNo;

		// Resolution
		$this->Resolution = new DbField('council_resolution', 'council_resolution', 'x_Resolution', 'Resolution', '`Resolution`', '`Resolution`', 201, -1, -1, FALSE, '`Resolution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Resolution->Sortable = TRUE; // Allow sort
		$this->fields['Resolution'] = &$this->Resolution;

		// Responsibility
		$this->Responsibility = new DbField('council_resolution', 'council_resolution', 'x_Responsibility', 'Responsibility', '`Responsibility`', '`Responsibility`', 200, 255, -1, FALSE, '`Responsibility`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Responsibility->Nullable = FALSE; // NOT NULL field
		$this->Responsibility->Required = TRUE; // Required field
		$this->Responsibility->Sortable = TRUE; // Allow sort
		$this->fields['Responsibility'] = &$this->Responsibility;

		// ActionDate
		$this->ActionDate = new DbField('council_resolution', 'council_resolution', 'x_ActionDate', 'ActionDate', '`ActionDate`', CastDateFieldForLike("`ActionDate`", 0, "DB"), 135, 19, 0, FALSE, '`ActionDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActionDate->Nullable = FALSE; // NOT NULL field
		$this->ActionDate->Required = TRUE; // Required field
		$this->ActionDate->Sortable = TRUE; // Allow sort
		$this->ActionDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActionDate'] = &$this->ActionDate;
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
		if ($this->getCurrentMasterTable() == "council_meeting") {
			if ($this->MeetingNo->getSessionValue() != "")
				$masterFilter .= "`MeetingNo`=" . QuotedValue($this->MeetingNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "council_meeting") {
			if ($this->MeetingNo->getSessionValue() != "")
				$detailFilter .= "`MeetingNo`=" . QuotedValue($this->MeetingNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
	public function sqlMasterFilter_council_meeting()
	{
		return "`MeetingNo`=@MeetingNo@ AND `LACode`='@LACode@'";
	}

	// Detail filter
	public function sqlDetailFilter_council_meeting()
	{
		return "`MeetingNo`=@MeetingNo@ AND `LACode`='@LACode@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`council_resolution`";
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
			$this->ResolutionNo->setDbValue($conn->insert_ID());
			$rs['ResolutionNo'] = $this->ResolutionNo->DbValue;
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
			$fldname = 'ResolutionNo';
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
			if (array_key_exists('ResolutionNo', $rs))
				AddFilter($where, QuotedName('ResolutionNo', $this->Dbid) . '=' . QuotedValue($rs['ResolutionNo'], $this->ResolutionNo->DataType, $this->Dbid));
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
		$this->MinuteNumber->DbValue = $row['MinuteNumber'];
		$this->Subject->DbValue = $row['Subject'];
		$this->Resolutionccategory->DbValue = $row['Resolutionccategory'];
		$this->LACode->DbValue = $row['LACode'];
		$this->ResolutionNo->DbValue = $row['ResolutionNo'];
		$this->Resolution->DbValue = $row['Resolution'];
		$this->Responsibility->DbValue = $row['Responsibility'];
		$this->ActionDate->DbValue = $row['ActionDate'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ResolutionNo` = @ResolutionNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ResolutionNo', $row) ? $row['ResolutionNo'] : NULL;
		else
			$val = $this->ResolutionNo->OldValue !== NULL ? $this->ResolutionNo->OldValue : $this->ResolutionNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ResolutionNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "council_resolutionlist.php";
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
		if ($pageName == "council_resolutionview.php")
			return $Language->phrase("View");
		elseif ($pageName == "council_resolutionedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "council_resolutionadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "council_resolutionlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("council_resolutionview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("council_resolutionview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "council_resolutionadd.php?" . $this->getUrlParm($parm);
		else
			$url = "council_resolutionadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("council_resolutionedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("council_resolutionadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("council_resolutiondelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "council_meeting" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_MeetingNo=" . urlencode($this->MeetingNo->CurrentValue);
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ResolutionNo:" . JsonEncode($this->ResolutionNo->CurrentValue, "number");
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
		if ($this->ResolutionNo->CurrentValue != NULL) {
			$url .= "ResolutionNo=" . urlencode($this->ResolutionNo->CurrentValue);
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
			if (Param("ResolutionNo") !== NULL)
				$arKeys[] = Param("ResolutionNo");
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
				$this->ResolutionNo->CurrentValue = $key;
			else
				$this->ResolutionNo->OldValue = $key;
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
		$this->MinuteNumber->setDbValue($rs->fields('MinuteNumber'));
		$this->Subject->setDbValue($rs->fields('Subject'));
		$this->Resolutionccategory->setDbValue($rs->fields('Resolutionccategory'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->ResolutionNo->setDbValue($rs->fields('ResolutionNo'));
		$this->Resolution->setDbValue($rs->fields('Resolution'));
		$this->Responsibility->setDbValue($rs->fields('Responsibility'));
		$this->ActionDate->setDbValue($rs->fields('ActionDate'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// MeetingNo
		// MinuteNumber
		// Subject
		// Resolutionccategory
		// LACode
		// ResolutionNo
		// Resolution
		// Responsibility
		// ActionDate
		// MeetingNo

		$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
		$curVal = strval($this->MeetingNo->CurrentValue);
		if ($curVal != "") {
			$this->MeetingNo->ViewValue = $this->MeetingNo->lookupCacheOption($curVal);
			if ($this->MeetingNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MeetingNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->MeetingNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
					$this->MeetingNo->ViewValue = $this->MeetingNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
				}
			}
		} else {
			$this->MeetingNo->ViewValue = NULL;
		}
		$this->MeetingNo->ViewCustomAttributes = "";

		// MinuteNumber
		$this->MinuteNumber->ViewValue = $this->MinuteNumber->CurrentValue;
		$this->MinuteNumber->ViewCustomAttributes = "";

		// Subject
		$this->Subject->ViewValue = $this->Subject->CurrentValue;
		$this->Subject->ViewCustomAttributes = "";

		// Resolutionccategory
		$curVal = strval($this->Resolutionccategory->CurrentValue);
		if ($curVal != "") {
			$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->lookupCacheOption($curVal);
			if ($this->Resolutionccategory->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ResolutionCategoryCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Resolutionccategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->CurrentValue;
				}
			}
		} else {
			$this->Resolutionccategory->ViewValue = NULL;
		}
		$this->Resolutionccategory->ViewCustomAttributes = "";

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

		// ResolutionNo
		$this->ResolutionNo->ViewValue = $this->ResolutionNo->CurrentValue;
		$this->ResolutionNo->ViewCustomAttributes = "";

		// Resolution
		$this->Resolution->ViewValue = $this->Resolution->CurrentValue;
		$this->Resolution->ViewCustomAttributes = "";

		// Responsibility
		$this->Responsibility->ViewValue = $this->Responsibility->CurrentValue;
		$this->Responsibility->ViewCustomAttributes = "";

		// ActionDate
		$this->ActionDate->ViewValue = $this->ActionDate->CurrentValue;
		$this->ActionDate->ViewValue = FormatDateTime($this->ActionDate->ViewValue, 0);
		$this->ActionDate->ViewCustomAttributes = "";

		// MeetingNo
		$this->MeetingNo->LinkCustomAttributes = "";
		$this->MeetingNo->HrefValue = "";
		$this->MeetingNo->TooltipValue = "";

		// MinuteNumber
		$this->MinuteNumber->LinkCustomAttributes = "";
		$this->MinuteNumber->HrefValue = "";
		$this->MinuteNumber->TooltipValue = "";

		// Subject
		$this->Subject->LinkCustomAttributes = "";
		$this->Subject->HrefValue = "";
		$this->Subject->TooltipValue = "";

		// Resolutionccategory
		$this->Resolutionccategory->LinkCustomAttributes = "";
		$this->Resolutionccategory->HrefValue = "";
		$this->Resolutionccategory->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// ResolutionNo
		$this->ResolutionNo->LinkCustomAttributes = "";
		$this->ResolutionNo->HrefValue = "";
		$this->ResolutionNo->TooltipValue = "";

		// Resolution
		$this->Resolution->LinkCustomAttributes = "";
		$this->Resolution->HrefValue = "";
		$this->Resolution->TooltipValue = "";

		// Responsibility
		$this->Responsibility->LinkCustomAttributes = "";
		$this->Responsibility->HrefValue = "";
		$this->Responsibility->TooltipValue = "";

		// ActionDate
		$this->ActionDate->LinkCustomAttributes = "";
		$this->ActionDate->HrefValue = "";
		$this->ActionDate->TooltipValue = "";

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
		if ($this->MeetingNo->getSessionValue() != "") {
			$this->MeetingNo->CurrentValue = $this->MeetingNo->getSessionValue();
			$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
			$curVal = strval($this->MeetingNo->CurrentValue);
			if ($curVal != "") {
				$this->MeetingNo->ViewValue = $this->MeetingNo->lookupCacheOption($curVal);
				if ($this->MeetingNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MeetingNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeetingNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
						$this->MeetingNo->ViewValue = $this->MeetingNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
					}
				}
			} else {
				$this->MeetingNo->ViewValue = NULL;
			}
			$this->MeetingNo->ViewCustomAttributes = "";
		} else {
			$this->MeetingNo->EditValue = $this->MeetingNo->CurrentValue;
			$this->MeetingNo->PlaceHolder = RemoveHtml($this->MeetingNo->caption());
		}

		// MinuteNumber
		$this->MinuteNumber->EditAttrs["class"] = "form-control";
		$this->MinuteNumber->EditCustomAttributes = "";
		if (!$this->MinuteNumber->Raw)
			$this->MinuteNumber->CurrentValue = HtmlDecode($this->MinuteNumber->CurrentValue);
		$this->MinuteNumber->EditValue = $this->MinuteNumber->CurrentValue;
		$this->MinuteNumber->PlaceHolder = RemoveHtml($this->MinuteNumber->caption());

		// Subject
		$this->Subject->EditAttrs["class"] = "form-control";
		$this->Subject->EditCustomAttributes = "";
		$this->Subject->EditValue = $this->Subject->CurrentValue;
		$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

		// Resolutionccategory
		$this->Resolutionccategory->EditAttrs["class"] = "form-control";
		$this->Resolutionccategory->EditCustomAttributes = "";

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

		// ResolutionNo
		$this->ResolutionNo->EditAttrs["class"] = "form-control";
		$this->ResolutionNo->EditCustomAttributes = "";
		$this->ResolutionNo->EditValue = $this->ResolutionNo->CurrentValue;
		$this->ResolutionNo->ViewCustomAttributes = "";

		// Resolution
		$this->Resolution->EditAttrs["class"] = "form-control";
		$this->Resolution->EditCustomAttributes = "";
		$this->Resolution->EditValue = $this->Resolution->CurrentValue;
		$this->Resolution->PlaceHolder = RemoveHtml($this->Resolution->caption());

		// Responsibility
		$this->Responsibility->EditAttrs["class"] = "form-control";
		$this->Responsibility->EditCustomAttributes = "";
		if (!$this->Responsibility->Raw)
			$this->Responsibility->CurrentValue = HtmlDecode($this->Responsibility->CurrentValue);
		$this->Responsibility->EditValue = $this->Responsibility->CurrentValue;
		$this->Responsibility->PlaceHolder = RemoveHtml($this->Responsibility->caption());

		// ActionDate
		$this->ActionDate->EditAttrs["class"] = "form-control";
		$this->ActionDate->EditCustomAttributes = "";
		$this->ActionDate->EditValue = FormatDateTime($this->ActionDate->CurrentValue, 8);
		$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

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
					$doc->exportCaption($this->MinuteNumber);
					$doc->exportCaption($this->Subject);
					$doc->exportCaption($this->Resolutionccategory);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->ResolutionNo);
					$doc->exportCaption($this->Resolution);
					$doc->exportCaption($this->Responsibility);
					$doc->exportCaption($this->ActionDate);
				} else {
					$doc->exportCaption($this->MeetingNo);
					$doc->exportCaption($this->MinuteNumber);
					$doc->exportCaption($this->Resolutionccategory);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->ResolutionNo);
					$doc->exportCaption($this->Responsibility);
					$doc->exportCaption($this->ActionDate);
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
						$doc->exportField($this->MinuteNumber);
						$doc->exportField($this->Subject);
						$doc->exportField($this->Resolutionccategory);
						$doc->exportField($this->LACode);
						$doc->exportField($this->ResolutionNo);
						$doc->exportField($this->Resolution);
						$doc->exportField($this->Responsibility);
						$doc->exportField($this->ActionDate);
					} else {
						$doc->exportField($this->MeetingNo);
						$doc->exportField($this->MinuteNumber);
						$doc->exportField($this->Resolutionccategory);
						$doc->exportField($this->LACode);
						$doc->exportField($this->ResolutionNo);
						$doc->exportField($this->Responsibility);
						$doc->exportField($this->ActionDate);
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
		$table = 'council_resolution';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'council_resolution';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ResolutionNo'];

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
		$table = 'council_resolution';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ResolutionNo'];

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
		$table = 'council_resolution';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ResolutionNo'];

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