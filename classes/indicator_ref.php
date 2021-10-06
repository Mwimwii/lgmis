<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for indicator_ref
 */
class indicator_ref extends DbTable
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
	public $indicator_code;
	public $indicator_name;
	public $indicator_desc;
	public $is_key;
	public $formula_ref;
	public $direction;
	public $target;
	public $indicator_measure;
	public $indicator_frequency;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'indicator_ref';
		$this->TableName = 'indicator_ref';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`indicator_ref`";
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

		// indicator_code
		$this->indicator_code = new DbField('indicator_ref', 'indicator_ref', 'x_indicator_code', 'indicator_code', '`indicator_code`', '`indicator_code`', 3, 11, -1, FALSE, '`indicator_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->indicator_code->Nullable = FALSE; // NOT NULL field
		$this->indicator_code->Sortable = TRUE; // Allow sort
		$this->indicator_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['indicator_code'] = &$this->indicator_code;

		// indicator_name
		$this->indicator_name = new DbField('indicator_ref', 'indicator_ref', 'x_indicator_name', 'indicator_name', '`indicator_name`', '`indicator_name`', 200, 100, -1, FALSE, '`indicator_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->indicator_name->Sortable = TRUE; // Allow sort
		$this->fields['indicator_name'] = &$this->indicator_name;

		// indicator_desc
		$this->indicator_desc = new DbField('indicator_ref', 'indicator_ref', 'x_indicator_desc', 'indicator_desc', '`indicator_desc`', '`indicator_desc`', 200, 255, -1, FALSE, '`indicator_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->indicator_desc->Sortable = TRUE; // Allow sort
		$this->fields['indicator_desc'] = &$this->indicator_desc;

		// is_key
		$this->is_key = new DbField('indicator_ref', 'indicator_ref', 'x_is_key', 'is_key', '`is_key`', '`is_key`', 3, 1, -1, FALSE, '`is_key`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->is_key->Sortable = TRUE; // Allow sort
		$this->is_key->DataType = DATATYPE_BIT;
		$this->fields['is_key'] = &$this->is_key;

		// formula_ref
		$this->formula_ref = new DbField('indicator_ref', 'indicator_ref', 'x_formula_ref', 'formula_ref', '`formula_ref`', '`formula_ref`', 200, 255, -1, FALSE, '`formula_ref`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->formula_ref->Sortable = TRUE; // Allow sort
		$this->fields['formula_ref'] = &$this->formula_ref;

		// direction
		$this->direction = new DbField('indicator_ref', 'indicator_ref', 'x_direction', 'direction', '`direction`', '`direction`', 200, 15, -1, FALSE, '`direction`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->direction->Sortable = TRUE; // Allow sort
		$this->direction->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->direction->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->direction->Lookup = new Lookup('direction', 'indicator_direction', FALSE, 'indicator_direction', ["indicator_direction","","",""], [], [], [], [], [], [], '', '');
		$this->fields['direction'] = &$this->direction;

		// target
		$this->target = new DbField('indicator_ref', 'indicator_ref', 'x_target', 'target', '`target`', '`target`', 3, 11, -1, FALSE, '`target`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->target->Sortable = TRUE; // Allow sort
		$this->target->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['target'] = &$this->target;

		// indicator_measure
		$this->indicator_measure = new DbField('indicator_ref', 'indicator_ref', 'x_indicator_measure', 'indicator_measure', '`indicator_measure`', '`indicator_measure`', 200, 15, -1, FALSE, '`indicator_measure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->indicator_measure->Sortable = TRUE; // Allow sort
		$this->indicator_measure->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->indicator_measure->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->indicator_measure->Lookup = new Lookup('indicator_measure', 'indicator_measure', FALSE, 'Indicator_measure', ["measure_desc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['indicator_measure'] = &$this->indicator_measure;

		// indicator_frequency
		$this->indicator_frequency = new DbField('indicator_ref', 'indicator_ref', 'x_indicator_frequency', 'indicator_frequency', '`indicator_frequency`', '`indicator_frequency`', 200, 20, -1, FALSE, '`indicator_frequency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->indicator_frequency->Sortable = TRUE; // Allow sort
		$this->indicator_frequency->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->indicator_frequency->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->indicator_frequency->Lookup = new Lookup('indicator_frequency', 'indicator_frequency', FALSE, 'indicator_frequency', ["frequency_desc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['indicator_frequency'] = &$this->indicator_frequency;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`indicator_ref`";
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
		$this->indicator_code->DbValue = $row['indicator_code'];
		$this->indicator_name->DbValue = $row['indicator_name'];
		$this->indicator_desc->DbValue = $row['indicator_desc'];
		$this->is_key->DbValue = $row['is_key'];
		$this->formula_ref->DbValue = $row['formula_ref'];
		$this->direction->DbValue = $row['direction'];
		$this->target->DbValue = $row['target'];
		$this->indicator_measure->DbValue = $row['indicator_measure'];
		$this->indicator_frequency->DbValue = $row['indicator_frequency'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "indicator_reflist.php";
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
		if ($pageName == "indicator_refview.php")
			return $Language->phrase("View");
		elseif ($pageName == "indicator_refedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "indicator_refadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "indicator_reflist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("indicator_refview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("indicator_refview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "indicator_refadd.php?" . $this->getUrlParm($parm);
		else
			$url = "indicator_refadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("indicator_refedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("indicator_refadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("indicator_refdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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
		$this->indicator_code->setDbValue($rs->fields('indicator_code'));
		$this->indicator_name->setDbValue($rs->fields('indicator_name'));
		$this->indicator_desc->setDbValue($rs->fields('indicator_desc'));
		$this->is_key->setDbValue($rs->fields('is_key'));
		$this->formula_ref->setDbValue($rs->fields('formula_ref'));
		$this->direction->setDbValue($rs->fields('direction'));
		$this->target->setDbValue($rs->fields('target'));
		$this->indicator_measure->setDbValue($rs->fields('indicator_measure'));
		$this->indicator_frequency->setDbValue($rs->fields('indicator_frequency'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// indicator_code
		// indicator_name
		// indicator_desc
		// is_key
		// formula_ref
		// direction
		// target
		// indicator_measure
		// indicator_frequency
		// indicator_code

		$this->indicator_code->ViewValue = $this->indicator_code->CurrentValue;
		$this->indicator_code->ViewCustomAttributes = "";

		// indicator_name
		$this->indicator_name->ViewValue = $this->indicator_name->CurrentValue;
		$this->indicator_name->ViewCustomAttributes = "";

		// indicator_desc
		$this->indicator_desc->ViewValue = $this->indicator_desc->CurrentValue;
		$this->indicator_desc->ViewCustomAttributes = "";

		// is_key
		$this->is_key->ViewValue = $this->is_key->CurrentValue;
		$this->is_key->ViewCustomAttributes = "";

		// formula_ref
		$this->formula_ref->ViewValue = $this->formula_ref->CurrentValue;
		$this->formula_ref->ViewCustomAttributes = "";

		// direction
		$curVal = strval($this->direction->CurrentValue);
		if ($curVal != "") {
			$this->direction->ViewValue = $this->direction->lookupCacheOption($curVal);
			if ($this->direction->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`indicator_direction`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->direction->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->direction->ViewValue = $this->direction->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->direction->ViewValue = $this->direction->CurrentValue;
				}
			}
		} else {
			$this->direction->ViewValue = NULL;
		}
		$this->direction->ViewCustomAttributes = "";

		// target
		$this->target->ViewValue = $this->target->CurrentValue;
		$this->target->ViewCustomAttributes = "";

		// indicator_measure
		$curVal = strval($this->indicator_measure->CurrentValue);
		if ($curVal != "") {
			$this->indicator_measure->ViewValue = $this->indicator_measure->lookupCacheOption($curVal);
			if ($this->indicator_measure->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Indicator_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->indicator_measure->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->indicator_measure->ViewValue = $this->indicator_measure->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->indicator_measure->ViewValue = $this->indicator_measure->CurrentValue;
				}
			}
		} else {
			$this->indicator_measure->ViewValue = NULL;
		}
		$this->indicator_measure->ViewCustomAttributes = "";

		// indicator_frequency
		$curVal = strval($this->indicator_frequency->CurrentValue);
		if ($curVal != "") {
			$this->indicator_frequency->ViewValue = $this->indicator_frequency->lookupCacheOption($curVal);
			if ($this->indicator_frequency->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`indicator_frequency`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->indicator_frequency->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->indicator_frequency->ViewValue = $this->indicator_frequency->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->indicator_frequency->ViewValue = $this->indicator_frequency->CurrentValue;
				}
			}
		} else {
			$this->indicator_frequency->ViewValue = NULL;
		}
		$this->indicator_frequency->ViewCustomAttributes = "";

		// indicator_code
		$this->indicator_code->LinkCustomAttributes = "";
		$this->indicator_code->HrefValue = "";
		$this->indicator_code->TooltipValue = "";

		// indicator_name
		$this->indicator_name->LinkCustomAttributes = "";
		$this->indicator_name->HrefValue = "";
		$this->indicator_name->TooltipValue = "";

		// indicator_desc
		$this->indicator_desc->LinkCustomAttributes = "";
		$this->indicator_desc->HrefValue = "";
		$this->indicator_desc->TooltipValue = "";

		// is_key
		$this->is_key->LinkCustomAttributes = "";
		$this->is_key->HrefValue = "";
		$this->is_key->TooltipValue = "";

		// formula_ref
		$this->formula_ref->LinkCustomAttributes = "";
		$this->formula_ref->HrefValue = "";
		$this->formula_ref->TooltipValue = "";

		// direction
		$this->direction->LinkCustomAttributes = "";
		$this->direction->HrefValue = "";
		$this->direction->TooltipValue = "";

		// target
		$this->target->LinkCustomAttributes = "";
		$this->target->HrefValue = "";
		$this->target->TooltipValue = "";

		// indicator_measure
		$this->indicator_measure->LinkCustomAttributes = "";
		$this->indicator_measure->HrefValue = "";
		$this->indicator_measure->TooltipValue = "";

		// indicator_frequency
		$this->indicator_frequency->LinkCustomAttributes = "";
		$this->indicator_frequency->HrefValue = "";
		$this->indicator_frequency->TooltipValue = "";

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

		// indicator_code
		$this->indicator_code->EditAttrs["class"] = "form-control";
		$this->indicator_code->EditCustomAttributes = "";
		$this->indicator_code->EditValue = $this->indicator_code->CurrentValue;
		$this->indicator_code->PlaceHolder = RemoveHtml($this->indicator_code->caption());

		// indicator_name
		$this->indicator_name->EditAttrs["class"] = "form-control";
		$this->indicator_name->EditCustomAttributes = "";
		if (!$this->indicator_name->Raw)
			$this->indicator_name->CurrentValue = HtmlDecode($this->indicator_name->CurrentValue);
		$this->indicator_name->EditValue = $this->indicator_name->CurrentValue;
		$this->indicator_name->PlaceHolder = RemoveHtml($this->indicator_name->caption());

		// indicator_desc
		$this->indicator_desc->EditAttrs["class"] = "form-control";
		$this->indicator_desc->EditCustomAttributes = "";
		if (!$this->indicator_desc->Raw)
			$this->indicator_desc->CurrentValue = HtmlDecode($this->indicator_desc->CurrentValue);
		$this->indicator_desc->EditValue = $this->indicator_desc->CurrentValue;
		$this->indicator_desc->PlaceHolder = RemoveHtml($this->indicator_desc->caption());

		// is_key
		$this->is_key->EditAttrs["class"] = "form-control";
		$this->is_key->EditCustomAttributes = "";
		$this->is_key->EditValue = $this->is_key->CurrentValue;
		$this->is_key->PlaceHolder = RemoveHtml($this->is_key->caption());

		// formula_ref
		$this->formula_ref->EditAttrs["class"] = "form-control";
		$this->formula_ref->EditCustomAttributes = "";
		if (!$this->formula_ref->Raw)
			$this->formula_ref->CurrentValue = HtmlDecode($this->formula_ref->CurrentValue);
		$this->formula_ref->EditValue = $this->formula_ref->CurrentValue;
		$this->formula_ref->PlaceHolder = RemoveHtml($this->formula_ref->caption());

		// direction
		$this->direction->EditAttrs["class"] = "form-control";
		$this->direction->EditCustomAttributes = "";

		// target
		$this->target->EditAttrs["class"] = "form-control";
		$this->target->EditCustomAttributes = "";
		$this->target->EditValue = $this->target->CurrentValue;
		$this->target->PlaceHolder = RemoveHtml($this->target->caption());

		// indicator_measure
		$this->indicator_measure->EditAttrs["class"] = "form-control";
		$this->indicator_measure->EditCustomAttributes = "";

		// indicator_frequency
		$this->indicator_frequency->EditAttrs["class"] = "form-control";
		$this->indicator_frequency->EditCustomAttributes = "";

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
					$doc->exportCaption($this->indicator_code);
					$doc->exportCaption($this->indicator_name);
					$doc->exportCaption($this->indicator_desc);
					$doc->exportCaption($this->formula_ref);
					$doc->exportCaption($this->direction);
					$doc->exportCaption($this->target);
					$doc->exportCaption($this->indicator_measure);
					$doc->exportCaption($this->indicator_frequency);
				} else {
					$doc->exportCaption($this->indicator_code);
					$doc->exportCaption($this->indicator_name);
					$doc->exportCaption($this->indicator_desc);
					$doc->exportCaption($this->formula_ref);
					$doc->exportCaption($this->direction);
					$doc->exportCaption($this->target);
					$doc->exportCaption($this->indicator_measure);
					$doc->exportCaption($this->indicator_frequency);
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
						$doc->exportField($this->indicator_code);
						$doc->exportField($this->indicator_name);
						$doc->exportField($this->indicator_desc);
						$doc->exportField($this->formula_ref);
						$doc->exportField($this->direction);
						$doc->exportField($this->target);
						$doc->exportField($this->indicator_measure);
						$doc->exportField($this->indicator_frequency);
					} else {
						$doc->exportField($this->indicator_code);
						$doc->exportField($this->indicator_name);
						$doc->exportField($this->indicator_desc);
						$doc->exportField($this->formula_ref);
						$doc->exportField($this->direction);
						$doc->exportField($this->target);
						$doc->exportField($this->indicator_measure);
						$doc->exportField($this->indicator_frequency);
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