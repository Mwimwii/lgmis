<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for board_zone
 */
class board_zone extends DbTable
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
	public $BoardZone;
	public $BoardZoneDesc;
	public $IndividualCharge;
	public $AgentCharge;
	public $PeriodType;
	public $BoardType;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'board_zone';
		$this->TableName = 'board_zone';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`board_zone`";
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

		// BoardZone
		$this->BoardZone = new DbField('board_zone', 'board_zone', 'x_BoardZone', 'BoardZone', '`BoardZone`', '`BoardZone`', 3, 11, -1, FALSE, '`BoardZone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->BoardZone->IsAutoIncrement = TRUE; // Autoincrement field
		$this->BoardZone->IsPrimaryKey = TRUE; // Primary key field
		$this->BoardZone->Sortable = TRUE; // Allow sort
		$this->BoardZone->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BoardZone'] = &$this->BoardZone;

		// BoardZoneDesc
		$this->BoardZoneDesc = new DbField('board_zone', 'board_zone', 'x_BoardZoneDesc', 'BoardZoneDesc', '`BoardZoneDesc`', '`BoardZoneDesc`', 200, 255, -1, FALSE, '`BoardZoneDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardZoneDesc->Nullable = FALSE; // NOT NULL field
		$this->BoardZoneDesc->Required = TRUE; // Required field
		$this->BoardZoneDesc->Sortable = TRUE; // Allow sort
		$this->fields['BoardZoneDesc'] = &$this->BoardZoneDesc;

		// IndividualCharge
		$this->IndividualCharge = new DbField('board_zone', 'board_zone', 'x_IndividualCharge', 'IndividualCharge', '`IndividualCharge`', '`IndividualCharge`', 5, 22, -1, FALSE, '`IndividualCharge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IndividualCharge->Sortable = TRUE; // Allow sort
		$this->IndividualCharge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['IndividualCharge'] = &$this->IndividualCharge;

		// AgentCharge
		$this->AgentCharge = new DbField('board_zone', 'board_zone', 'x_AgentCharge', 'AgentCharge', '`AgentCharge`', '`AgentCharge`', 5, 22, -1, FALSE, '`AgentCharge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AgentCharge->Sortable = TRUE; // Allow sort
		$this->AgentCharge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AgentCharge'] = &$this->AgentCharge;

		// PeriodType
		$this->PeriodType = new DbField('board_zone', 'board_zone', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 16, 3, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->PeriodType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PeriodType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PeriodType->Lookup = new Lookup('PeriodType', 'period_type', FALSE, 'Period_Type', ["PeriodTypeName","PeriodLength","UnitOfMeasure",""], [], [], [], [], [], [], '', '');
		$this->PeriodType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PeriodType'] = &$this->PeriodType;

		// BoardType
		$this->BoardType = new DbField('board_zone', 'board_zone', 'x_BoardType', 'BoardType', '`BoardType`', '`BoardType`', 3, 11, -1, FALSE, '`BoardType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardType->Sortable = TRUE; // Allow sort
		$this->BoardType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BoardType'] = &$this->BoardType;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`board_zone`";
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
			$this->BoardZone->setDbValue($conn->insert_ID());
			$rs['BoardZone'] = $this->BoardZone->DbValue;
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
			if (array_key_exists('BoardZone', $rs))
				AddFilter($where, QuotedName('BoardZone', $this->Dbid) . '=' . QuotedValue($rs['BoardZone'], $this->BoardZone->DataType, $this->Dbid));
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
		$this->BoardZone->DbValue = $row['BoardZone'];
		$this->BoardZoneDesc->DbValue = $row['BoardZoneDesc'];
		$this->IndividualCharge->DbValue = $row['IndividualCharge'];
		$this->AgentCharge->DbValue = $row['AgentCharge'];
		$this->PeriodType->DbValue = $row['PeriodType'];
		$this->BoardType->DbValue = $row['BoardType'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`BoardZone` = @BoardZone@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('BoardZone', $row) ? $row['BoardZone'] : NULL;
		else
			$val = $this->BoardZone->OldValue !== NULL ? $this->BoardZone->OldValue : $this->BoardZone->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@BoardZone@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "board_zonelist.php";
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
		if ($pageName == "board_zoneview.php")
			return $Language->phrase("View");
		elseif ($pageName == "board_zoneedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "board_zoneadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "board_zonelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("board_zoneview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("board_zoneview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "board_zoneadd.php?" . $this->getUrlParm($parm);
		else
			$url = "board_zoneadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("board_zoneedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("board_zoneadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("board_zonedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "BoardZone:" . JsonEncode($this->BoardZone->CurrentValue, "number");
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
		if ($this->BoardZone->CurrentValue != NULL) {
			$url .= "BoardZone=" . urlencode($this->BoardZone->CurrentValue);
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
			if (Param("BoardZone") !== NULL)
				$arKeys[] = Param("BoardZone");
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
				$this->BoardZone->CurrentValue = $key;
			else
				$this->BoardZone->OldValue = $key;
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
		$this->BoardZone->setDbValue($rs->fields('BoardZone'));
		$this->BoardZoneDesc->setDbValue($rs->fields('BoardZoneDesc'));
		$this->IndividualCharge->setDbValue($rs->fields('IndividualCharge'));
		$this->AgentCharge->setDbValue($rs->fields('AgentCharge'));
		$this->PeriodType->setDbValue($rs->fields('PeriodType'));
		$this->BoardType->setDbValue($rs->fields('BoardType'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// BoardZone
		// BoardZoneDesc
		// IndividualCharge
		// AgentCharge
		// PeriodType
		// BoardType
		// BoardZone

		$this->BoardZone->ViewValue = $this->BoardZone->CurrentValue;
		$this->BoardZone->ViewCustomAttributes = "";

		// BoardZoneDesc
		$this->BoardZoneDesc->ViewValue = $this->BoardZoneDesc->CurrentValue;
		$this->BoardZoneDesc->ViewCustomAttributes = "";

		// IndividualCharge
		$this->IndividualCharge->ViewValue = $this->IndividualCharge->CurrentValue;
		$this->IndividualCharge->ViewValue = FormatNumber($this->IndividualCharge->ViewValue, 2, -2, -2, -2);
		$this->IndividualCharge->CellCssStyle .= "text-align: right;";
		$this->IndividualCharge->ViewCustomAttributes = "";

		// AgentCharge
		$this->AgentCharge->ViewValue = $this->AgentCharge->CurrentValue;
		$this->AgentCharge->ViewValue = FormatNumber($this->AgentCharge->ViewValue, 2, -2, -2, -2);
		$this->AgentCharge->CellCssStyle .= "text-align: right;";
		$this->AgentCharge->ViewCustomAttributes = "";

		// PeriodType
		$curVal = strval($this->PeriodType->CurrentValue);
		if ($curVal != "") {
			$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
				}
			}
		} else {
			$this->PeriodType->ViewValue = NULL;
		}
		$this->PeriodType->ViewCustomAttributes = "";

		// BoardType
		$this->BoardType->ViewValue = $this->BoardType->CurrentValue;
		$this->BoardType->ViewCustomAttributes = "";

		// BoardZone
		$this->BoardZone->LinkCustomAttributes = "";
		$this->BoardZone->HrefValue = "";
		$this->BoardZone->TooltipValue = "";

		// BoardZoneDesc
		$this->BoardZoneDesc->LinkCustomAttributes = "";
		$this->BoardZoneDesc->HrefValue = "";
		$this->BoardZoneDesc->TooltipValue = "";

		// IndividualCharge
		$this->IndividualCharge->LinkCustomAttributes = "";
		$this->IndividualCharge->HrefValue = "";
		$this->IndividualCharge->TooltipValue = "";

		// AgentCharge
		$this->AgentCharge->LinkCustomAttributes = "";
		$this->AgentCharge->HrefValue = "";
		$this->AgentCharge->TooltipValue = "";

		// PeriodType
		$this->PeriodType->LinkCustomAttributes = "";
		$this->PeriodType->HrefValue = "";
		$this->PeriodType->TooltipValue = "";

		// BoardType
		$this->BoardType->LinkCustomAttributes = "";
		$this->BoardType->HrefValue = "";
		$this->BoardType->TooltipValue = "";

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

		// BoardZone
		$this->BoardZone->EditAttrs["class"] = "form-control";
		$this->BoardZone->EditCustomAttributes = "";
		$this->BoardZone->EditValue = $this->BoardZone->CurrentValue;
		$this->BoardZone->ViewCustomAttributes = "";

		// BoardZoneDesc
		$this->BoardZoneDesc->EditAttrs["class"] = "form-control";
		$this->BoardZoneDesc->EditCustomAttributes = "";
		if (!$this->BoardZoneDesc->Raw)
			$this->BoardZoneDesc->CurrentValue = HtmlDecode($this->BoardZoneDesc->CurrentValue);
		$this->BoardZoneDesc->EditValue = $this->BoardZoneDesc->CurrentValue;
		$this->BoardZoneDesc->PlaceHolder = RemoveHtml($this->BoardZoneDesc->caption());

		// IndividualCharge
		$this->IndividualCharge->EditAttrs["class"] = "form-control";
		$this->IndividualCharge->EditCustomAttributes = "";
		$this->IndividualCharge->EditValue = $this->IndividualCharge->CurrentValue;
		$this->IndividualCharge->PlaceHolder = RemoveHtml($this->IndividualCharge->caption());
		if (strval($this->IndividualCharge->EditValue) != "" && is_numeric($this->IndividualCharge->EditValue))
			$this->IndividualCharge->EditValue = FormatNumber($this->IndividualCharge->EditValue, -2, -2, -2, -2);
		

		// AgentCharge
		$this->AgentCharge->EditAttrs["class"] = "form-control";
		$this->AgentCharge->EditCustomAttributes = "";
		$this->AgentCharge->EditValue = $this->AgentCharge->CurrentValue;
		$this->AgentCharge->PlaceHolder = RemoveHtml($this->AgentCharge->caption());
		if (strval($this->AgentCharge->EditValue) != "" && is_numeric($this->AgentCharge->EditValue))
			$this->AgentCharge->EditValue = FormatNumber($this->AgentCharge->EditValue, -2, -2, -2, -2);
		

		// PeriodType
		$this->PeriodType->EditAttrs["class"] = "form-control";
		$this->PeriodType->EditCustomAttributes = "";

		// BoardType
		$this->BoardType->EditAttrs["class"] = "form-control";
		$this->BoardType->EditCustomAttributes = "";
		$this->BoardType->EditValue = $this->BoardType->CurrentValue;
		$this->BoardType->PlaceHolder = RemoveHtml($this->BoardType->caption());

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
					$doc->exportCaption($this->BoardZone);
					$doc->exportCaption($this->BoardZoneDesc);
					$doc->exportCaption($this->IndividualCharge);
					$doc->exportCaption($this->AgentCharge);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->BoardType);
				} else {
					$doc->exportCaption($this->BoardZone);
					$doc->exportCaption($this->BoardZoneDesc);
					$doc->exportCaption($this->IndividualCharge);
					$doc->exportCaption($this->AgentCharge);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->BoardType);
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
						$doc->exportField($this->BoardZone);
						$doc->exportField($this->BoardZoneDesc);
						$doc->exportField($this->IndividualCharge);
						$doc->exportField($this->AgentCharge);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->BoardType);
					} else {
						$doc->exportField($this->BoardZone);
						$doc->exportField($this->BoardZoneDesc);
						$doc->exportField($this->IndividualCharge);
						$doc->exportField($this->AgentCharge);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->BoardType);
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