<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for resolution_view
 */
class resolution_view extends DbTable
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
	public $ProvinceCode;
	public $LACode;
	public $LAName;
	public $MeetingNo;
	public $MeetingRef;
	public $MeetingType;
	public $ActualDate;
	public $MeetingTypeName;
	public $ResolutionNo;
	public $Resolution;
	public $Responsibility;
	public $ActionDate;
	public $ResolutionCategoryName;
	public $MinuteNumber;
	public $Subject;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'resolution_view';
		$this->TableName = 'resolution_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`resolution_view`";
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
		$this->ProvinceCode = new DbField('resolution_view', 'resolution_view', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 17, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], [], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('resolution_view', 'resolution_view', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->fields['LACode'] = &$this->LACode;

		// LAName
		$this->LAName = new DbField('resolution_view', 'resolution_view', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->fields['LAName'] = &$this->LAName;

		// MeetingNo
		$this->MeetingNo = new DbField('resolution_view', 'resolution_view', 'x_MeetingNo', 'MeetingNo', '`MeetingNo`', '`MeetingNo`', 3, 11, -1, FALSE, '`MeetingNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->MeetingNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->MeetingNo->IsPrimaryKey = TRUE; // Primary key field
		$this->MeetingNo->Sortable = TRUE; // Allow sort
		$this->MeetingNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeetingNo'] = &$this->MeetingNo;

		// MeetingRef
		$this->MeetingRef = new DbField('resolution_view', 'resolution_view', 'x_MeetingRef', 'MeetingRef', '`MeetingRef`', '`MeetingRef`', 200, 20, -1, FALSE, '`MeetingRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MeetingRef->Sortable = TRUE; // Allow sort
		$this->fields['MeetingRef'] = &$this->MeetingRef;

		// MeetingType
		$this->MeetingType = new DbField('resolution_view', 'resolution_view', 'x_MeetingType', 'MeetingType', '`MeetingType`', '`MeetingType`', 16, 4, -1, FALSE, '`MeetingType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MeetingType->Nullable = FALSE; // NOT NULL field
		$this->MeetingType->Required = TRUE; // Required field
		$this->MeetingType->Sortable = TRUE; // Allow sort
		$this->MeetingType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeetingType'] = &$this->MeetingType;

		// ActualDate
		$this->ActualDate = new DbField('resolution_view', 'resolution_view', 'x_ActualDate', 'ActualDate', '`ActualDate`', CastDateFieldForLike("`ActualDate`", 0, "DB"), 135, 19, 0, FALSE, '`ActualDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualDate->Required = TRUE; // Required field
		$this->ActualDate->Sortable = TRUE; // Allow sort
		$this->ActualDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualDate'] = &$this->ActualDate;

		// MeetingTypeName
		$this->MeetingTypeName = new DbField('resolution_view', 'resolution_view', 'x_MeetingTypeName', 'MeetingTypeName', '`MeetingTypeName`', '`MeetingTypeName`', 200, 255, -1, FALSE, '`MeetingTypeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MeetingTypeName->Nullable = FALSE; // NOT NULL field
		$this->MeetingTypeName->Required = TRUE; // Required field
		$this->MeetingTypeName->Sortable = TRUE; // Allow sort
		$this->fields['MeetingTypeName'] = &$this->MeetingTypeName;

		// ResolutionNo
		$this->ResolutionNo = new DbField('resolution_view', 'resolution_view', 'x_ResolutionNo', 'ResolutionNo', '`ResolutionNo`', '`ResolutionNo`', 3, 11, -1, FALSE, '`ResolutionNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ResolutionNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ResolutionNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ResolutionNo->Sortable = TRUE; // Allow sort
		$this->ResolutionNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ResolutionNo'] = &$this->ResolutionNo;

		// Resolution
		$this->Resolution = new DbField('resolution_view', 'resolution_view', 'x_Resolution', 'Resolution', '`Resolution`', '`Resolution`', 201, -1, -1, FALSE, '`Resolution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Resolution->Sortable = TRUE; // Allow sort
		$this->fields['Resolution'] = &$this->Resolution;

		// Responsibility
		$this->Responsibility = new DbField('resolution_view', 'resolution_view', 'x_Responsibility', 'Responsibility', '`Responsibility`', '`Responsibility`', 200, 255, -1, FALSE, '`Responsibility`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Responsibility->Nullable = FALSE; // NOT NULL field
		$this->Responsibility->Required = TRUE; // Required field
		$this->Responsibility->Sortable = TRUE; // Allow sort
		$this->fields['Responsibility'] = &$this->Responsibility;

		// ActionDate
		$this->ActionDate = new DbField('resolution_view', 'resolution_view', 'x_ActionDate', 'ActionDate', '`ActionDate`', CastDateFieldForLike("`ActionDate`", 0, "DB"), 135, 19, 0, FALSE, '`ActionDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActionDate->Nullable = FALSE; // NOT NULL field
		$this->ActionDate->Required = TRUE; // Required field
		$this->ActionDate->Sortable = TRUE; // Allow sort
		$this->ActionDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActionDate'] = &$this->ActionDate;

		// ResolutionCategoryName
		$this->ResolutionCategoryName = new DbField('resolution_view', 'resolution_view', 'x_ResolutionCategoryName', 'ResolutionCategoryName', '`ResolutionCategoryName`', '`ResolutionCategoryName`', 200, 255, -1, FALSE, '`ResolutionCategoryName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ResolutionCategoryName->Nullable = FALSE; // NOT NULL field
		$this->ResolutionCategoryName->Required = TRUE; // Required field
		$this->ResolutionCategoryName->Sortable = TRUE; // Allow sort
		$this->fields['ResolutionCategoryName'] = &$this->ResolutionCategoryName;

		// MinuteNumber
		$this->MinuteNumber = new DbField('resolution_view', 'resolution_view', 'x_MinuteNumber', 'MinuteNumber', '`MinuteNumber`', '`MinuteNumber`', 200, 50, -1, FALSE, '`MinuteNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MinuteNumber->Nullable = FALSE; // NOT NULL field
		$this->MinuteNumber->Required = TRUE; // Required field
		$this->MinuteNumber->Sortable = TRUE; // Allow sort
		$this->fields['MinuteNumber'] = &$this->MinuteNumber;

		// Subject
		$this->Subject = new DbField('resolution_view', 'resolution_view', 'x_Subject', 'Subject', '`Subject`', '`Subject`', 201, 16777215, -1, FALSE, '`Subject`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Subject->Nullable = FALSE; // NOT NULL field
		$this->Subject->Required = TRUE; // Required field
		$this->Subject->Sortable = TRUE; // Allow sort
		$this->fields['Subject'] = &$this->Subject;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`resolution_view`";
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

			// Get insert id if necessary
			$this->ResolutionNo->setDbValue($conn->insert_ID());
			$rs['ResolutionNo'] = $this->ResolutionNo->DbValue;
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
			if (array_key_exists('ProvinceCode', $rs))
				AddFilter($where, QuotedName('ProvinceCode', $this->Dbid) . '=' . QuotedValue($rs['ProvinceCode'], $this->ProvinceCode->DataType, $this->Dbid));
			if (array_key_exists('LACode', $rs))
				AddFilter($where, QuotedName('LACode', $this->Dbid) . '=' . QuotedValue($rs['LACode'], $this->LACode->DataType, $this->Dbid));
			if (array_key_exists('MeetingNo', $rs))
				AddFilter($where, QuotedName('MeetingNo', $this->Dbid) . '=' . QuotedValue($rs['MeetingNo'], $this->MeetingNo->DataType, $this->Dbid));
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
		$this->LAName->DbValue = $row['LAName'];
		$this->MeetingNo->DbValue = $row['MeetingNo'];
		$this->MeetingRef->DbValue = $row['MeetingRef'];
		$this->MeetingType->DbValue = $row['MeetingType'];
		$this->ActualDate->DbValue = $row['ActualDate'];
		$this->MeetingTypeName->DbValue = $row['MeetingTypeName'];
		$this->ResolutionNo->DbValue = $row['ResolutionNo'];
		$this->Resolution->DbValue = $row['Resolution'];
		$this->Responsibility->DbValue = $row['Responsibility'];
		$this->ActionDate->DbValue = $row['ActionDate'];
		$this->ResolutionCategoryName->DbValue = $row['ResolutionCategoryName'];
		$this->MinuteNumber->DbValue = $row['MinuteNumber'];
		$this->Subject->DbValue = $row['Subject'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ProvinceCode` = @ProvinceCode@ AND `LACode` = '@LACode@' AND `MeetingNo` = @MeetingNo@ AND `ResolutionNo` = @ResolutionNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ProvinceCode', $row) ? $row['ProvinceCode'] : NULL;
		else
			$val = $this->ProvinceCode->OldValue !== NULL ? $this->ProvinceCode->OldValue : $this->ProvinceCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ProvinceCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('LACode', $row) ? $row['LACode'] : NULL;
		else
			$val = $this->LACode->OldValue !== NULL ? $this->LACode->OldValue : $this->LACode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LACode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "resolution_viewlist.php";
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
		if ($pageName == "resolution_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "resolution_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "resolution_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "resolution_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("resolution_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("resolution_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "resolution_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "resolution_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("resolution_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("resolution_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("resolution_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ProvinceCode:" . JsonEncode($this->ProvinceCode->CurrentValue, "number");
		$json .= ",LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
		$json .= ",MeetingNo:" . JsonEncode($this->MeetingNo->CurrentValue, "number");
		$json .= ",ResolutionNo:" . JsonEncode($this->ResolutionNo->CurrentValue, "number");
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
		if ($this->ProvinceCode->CurrentValue != NULL) {
			$url .= "ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "&LACode=" . urlencode($this->LACode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->MeetingNo->CurrentValue != NULL) {
			$url .= "&MeetingNo=" . urlencode($this->MeetingNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->ResolutionNo->CurrentValue != NULL) {
			$url .= "&ResolutionNo=" . urlencode($this->ResolutionNo->CurrentValue);
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
			if (Param("ProvinceCode") !== NULL)
				$arKey[] = Param("ProvinceCode");
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
			if (Param("MeetingNo") !== NULL)
				$arKey[] = Param("MeetingNo");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ResolutionNo") !== NULL)
				$arKey[] = Param("ResolutionNo");
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
				if (!is_numeric($key[0])) // ProvinceCode
					continue;
				if (!is_numeric($key[2])) // MeetingNo
					continue;
				if (!is_numeric($key[3])) // ResolutionNo
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
				$this->ProvinceCode->CurrentValue = $key[0];
			else
				$this->ProvinceCode->OldValue = $key[0];
			if ($setCurrent)
				$this->LACode->CurrentValue = $key[1];
			else
				$this->LACode->OldValue = $key[1];
			if ($setCurrent)
				$this->MeetingNo->CurrentValue = $key[2];
			else
				$this->MeetingNo->OldValue = $key[2];
			if ($setCurrent)
				$this->ResolutionNo->CurrentValue = $key[3];
			else
				$this->ResolutionNo->OldValue = $key[3];
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
		$this->LAName->setDbValue($rs->fields('LAName'));
		$this->MeetingNo->setDbValue($rs->fields('MeetingNo'));
		$this->MeetingRef->setDbValue($rs->fields('MeetingRef'));
		$this->MeetingType->setDbValue($rs->fields('MeetingType'));
		$this->ActualDate->setDbValue($rs->fields('ActualDate'));
		$this->MeetingTypeName->setDbValue($rs->fields('MeetingTypeName'));
		$this->ResolutionNo->setDbValue($rs->fields('ResolutionNo'));
		$this->Resolution->setDbValue($rs->fields('Resolution'));
		$this->Responsibility->setDbValue($rs->fields('Responsibility'));
		$this->ActionDate->setDbValue($rs->fields('ActionDate'));
		$this->ResolutionCategoryName->setDbValue($rs->fields('ResolutionCategoryName'));
		$this->MinuteNumber->setDbValue($rs->fields('MinuteNumber'));
		$this->Subject->setDbValue($rs->fields('Subject'));
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
		// LAName
		// MeetingNo
		// MeetingRef
		// MeetingType
		// ActualDate
		// MeetingTypeName
		// ResolutionNo
		// Resolution
		// Responsibility
		// ActionDate
		// ResolutionCategoryName
		// MinuteNumber
		// Subject
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
		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewCustomAttributes = "";

		// LAName
		$this->LAName->ViewValue = $this->LAName->CurrentValue;
		$this->LAName->ViewCustomAttributes = "";

		// MeetingNo
		$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
		$this->MeetingNo->ViewCustomAttributes = "";

		// MeetingRef
		$this->MeetingRef->ViewValue = $this->MeetingRef->CurrentValue;
		$this->MeetingRef->ViewCustomAttributes = "";

		// MeetingType
		$this->MeetingType->ViewValue = $this->MeetingType->CurrentValue;
		$this->MeetingType->ViewCustomAttributes = "";

		// ActualDate
		$this->ActualDate->ViewValue = $this->ActualDate->CurrentValue;
		$this->ActualDate->ViewValue = FormatDateTime($this->ActualDate->ViewValue, 0);
		$this->ActualDate->ViewCustomAttributes = "";

		// MeetingTypeName
		$this->MeetingTypeName->ViewValue = $this->MeetingTypeName->CurrentValue;
		$this->MeetingTypeName->ViewCustomAttributes = "";

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

		// ResolutionCategoryName
		$this->ResolutionCategoryName->ViewValue = $this->ResolutionCategoryName->CurrentValue;
		$this->ResolutionCategoryName->ViewCustomAttributes = "";

		// MinuteNumber
		$this->MinuteNumber->ViewValue = $this->MinuteNumber->CurrentValue;
		$this->MinuteNumber->ViewCustomAttributes = "";

		// Subject
		$this->Subject->ViewValue = $this->Subject->CurrentValue;
		$this->Subject->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// LAName
		$this->LAName->LinkCustomAttributes = "";
		$this->LAName->HrefValue = "";
		$this->LAName->TooltipValue = "";

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

		// ActualDate
		$this->ActualDate->LinkCustomAttributes = "";
		$this->ActualDate->HrefValue = "";
		$this->ActualDate->TooltipValue = "";

		// MeetingTypeName
		$this->MeetingTypeName->LinkCustomAttributes = "";
		$this->MeetingTypeName->HrefValue = "";
		$this->MeetingTypeName->TooltipValue = "";

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

		// ResolutionCategoryName
		$this->ResolutionCategoryName->LinkCustomAttributes = "";
		$this->ResolutionCategoryName->HrefValue = "";
		$this->ResolutionCategoryName->TooltipValue = "";

		// MinuteNumber
		$this->MinuteNumber->LinkCustomAttributes = "";
		$this->MinuteNumber->HrefValue = "";
		$this->MinuteNumber->TooltipValue = "";

		// Subject
		$this->Subject->LinkCustomAttributes = "";
		$this->Subject->HrefValue = "";
		$this->Subject->TooltipValue = "";

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
		$this->MeetingType->EditValue = $this->MeetingType->CurrentValue;
		$this->MeetingType->PlaceHolder = RemoveHtml($this->MeetingType->caption());

		// ActualDate
		$this->ActualDate->EditAttrs["class"] = "form-control";
		$this->ActualDate->EditCustomAttributes = "";
		$this->ActualDate->EditValue = FormatDateTime($this->ActualDate->CurrentValue, 8);
		$this->ActualDate->PlaceHolder = RemoveHtml($this->ActualDate->caption());

		// MeetingTypeName
		$this->MeetingTypeName->EditAttrs["class"] = "form-control";
		$this->MeetingTypeName->EditCustomAttributes = "";
		if (!$this->MeetingTypeName->Raw)
			$this->MeetingTypeName->CurrentValue = HtmlDecode($this->MeetingTypeName->CurrentValue);
		$this->MeetingTypeName->EditValue = $this->MeetingTypeName->CurrentValue;
		$this->MeetingTypeName->PlaceHolder = RemoveHtml($this->MeetingTypeName->caption());

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

		// ResolutionCategoryName
		$this->ResolutionCategoryName->EditAttrs["class"] = "form-control";
		$this->ResolutionCategoryName->EditCustomAttributes = "";
		if (!$this->ResolutionCategoryName->Raw)
			$this->ResolutionCategoryName->CurrentValue = HtmlDecode($this->ResolutionCategoryName->CurrentValue);
		$this->ResolutionCategoryName->EditValue = $this->ResolutionCategoryName->CurrentValue;
		$this->ResolutionCategoryName->PlaceHolder = RemoveHtml($this->ResolutionCategoryName->caption());

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
		if (!$this->Subject->Raw)
			$this->Subject->CurrentValue = HtmlDecode($this->Subject->CurrentValue);
		$this->Subject->EditValue = $this->Subject->CurrentValue;
		$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

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
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->MeetingNo);
					$doc->exportCaption($this->MeetingRef);
					$doc->exportCaption($this->MeetingType);
					$doc->exportCaption($this->ActualDate);
					$doc->exportCaption($this->MeetingTypeName);
					$doc->exportCaption($this->ResolutionNo);
					$doc->exportCaption($this->Resolution);
					$doc->exportCaption($this->Responsibility);
					$doc->exportCaption($this->ActionDate);
					$doc->exportCaption($this->ResolutionCategoryName);
					$doc->exportCaption($this->MinuteNumber);
					$doc->exportCaption($this->Subject);
				} else {
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->MeetingNo);
					$doc->exportCaption($this->MeetingRef);
					$doc->exportCaption($this->MeetingType);
					$doc->exportCaption($this->ActualDate);
					$doc->exportCaption($this->MeetingTypeName);
					$doc->exportCaption($this->ResolutionNo);
					$doc->exportCaption($this->Responsibility);
					$doc->exportCaption($this->ActionDate);
					$doc->exportCaption($this->ResolutionCategoryName);
					$doc->exportCaption($this->MinuteNumber);
					$doc->exportCaption($this->Subject);
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
						$doc->exportField($this->LAName);
						$doc->exportField($this->MeetingNo);
						$doc->exportField($this->MeetingRef);
						$doc->exportField($this->MeetingType);
						$doc->exportField($this->ActualDate);
						$doc->exportField($this->MeetingTypeName);
						$doc->exportField($this->ResolutionNo);
						$doc->exportField($this->Resolution);
						$doc->exportField($this->Responsibility);
						$doc->exportField($this->ActionDate);
						$doc->exportField($this->ResolutionCategoryName);
						$doc->exportField($this->MinuteNumber);
						$doc->exportField($this->Subject);
					} else {
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->LAName);
						$doc->exportField($this->MeetingNo);
						$doc->exportField($this->MeetingRef);
						$doc->exportField($this->MeetingType);
						$doc->exportField($this->ActualDate);
						$doc->exportField($this->MeetingTypeName);
						$doc->exportField($this->ResolutionNo);
						$doc->exportField($this->Responsibility);
						$doc->exportField($this->ActionDate);
						$doc->exportField($this->ResolutionCategoryName);
						$doc->exportField($this->MinuteNumber);
						$doc->exportField($this->Subject);
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