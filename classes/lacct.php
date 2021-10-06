<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for lacct
 */
class lacct extends DbTable
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
	public $LACode;
	public $Code;
	public $Details;
	public $Approved_Budget;
	public $Budget;
	public $Q1;
	public $Q2;
	public $Q3;
	public $Q4;
	public $Q1_Q4;
	public $Percent;
	public $Balance;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'lacct';
		$this->TableName = 'lacct';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`lacct`";
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
		$this->LACode = new DbField('lacct', 'lacct', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 3, 4, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LACode'] = &$this->LACode;

		// Code
		$this->Code = new DbField('lacct', 'lacct', 'x_Code', 'Code', '`Code`', '`Code`', 5, 22, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Sortable = TRUE; // Allow sort
		$this->Code->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Code'] = &$this->Code;

		// Details
		$this->Details = new DbField('lacct', 'lacct', 'x_Details', 'Details', '`Details`', '`Details`', 200, 255, -1, FALSE, '`Details`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Details->Sortable = TRUE; // Allow sort
		$this->fields['Details'] = &$this->Details;

		// Approved Budget
		$this->Approved_Budget = new DbField('lacct', 'lacct', 'x_Approved_Budget', 'Approved Budget', '`Approved Budget`', '`Approved Budget`', 5, 22, -1, FALSE, '`Approved Budget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Approved_Budget->Sortable = TRUE; // Allow sort
		$this->Approved_Budget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Approved Budget'] = &$this->Approved_Budget;

		// Budget
		$this->Budget = new DbField('lacct', 'lacct', 'x_Budget', 'Budget', '`Budget`', '`Budget`', 5, 22, -1, FALSE, '`Budget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Budget->Sortable = TRUE; // Allow sort
		$this->Budget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Budget'] = &$this->Budget;

		// Q1
		$this->Q1 = new DbField('lacct', 'lacct', 'x_Q1', 'Q1', '`Q1`', '`Q1`', 5, 22, -1, FALSE, '`Q1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Q1->Sortable = TRUE; // Allow sort
		$this->Q1->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Q1'] = &$this->Q1;

		// Q2
		$this->Q2 = new DbField('lacct', 'lacct', 'x_Q2', 'Q2', '`Q2`', '`Q2`', 5, 22, -1, FALSE, '`Q2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Q2->Sortable = TRUE; // Allow sort
		$this->Q2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Q2'] = &$this->Q2;

		// Q3
		$this->Q3 = new DbField('lacct', 'lacct', 'x_Q3', 'Q3', '`Q3`', '`Q3`', 5, 22, -1, FALSE, '`Q3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Q3->Sortable = TRUE; // Allow sort
		$this->Q3->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Q3'] = &$this->Q3;

		// Q4
		$this->Q4 = new DbField('lacct', 'lacct', 'x_Q4', 'Q4', '`Q4`', '`Q4`', 5, 22, -1, FALSE, '`Q4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Q4->Sortable = TRUE; // Allow sort
		$this->Q4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Q4'] = &$this->Q4;

		// Q1-Q4
		$this->Q1_Q4 = new DbField('lacct', 'lacct', 'x_Q1_Q4', 'Q1-Q4', '`Q1-Q4`', '`Q1-Q4`', 5, 22, -1, FALSE, '`Q1-Q4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Q1_Q4->Sortable = TRUE; // Allow sort
		$this->Q1_Q4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Q1-Q4'] = &$this->Q1_Q4;

		// Percent
		$this->Percent = new DbField('lacct', 'lacct', 'x_Percent', 'Percent', '`Percent`', '`Percent`', 5, 22, -1, FALSE, '`Percent`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Percent->Sortable = TRUE; // Allow sort
		$this->Percent->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Percent'] = &$this->Percent;

		// Balance
		$this->Balance = new DbField('lacct', 'lacct', 'x_Balance', 'Balance', '`Balance`', '`Balance`', 5, 22, -1, FALSE, '`Balance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Balance->Sortable = TRUE; // Allow sort
		$this->Balance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Balance'] = &$this->Balance;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`lacct`";
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
		$this->LACode->DbValue = $row['LACode'];
		$this->Code->DbValue = $row['Code'];
		$this->Details->DbValue = $row['Details'];
		$this->Approved_Budget->DbValue = $row['Approved Budget'];
		$this->Budget->DbValue = $row['Budget'];
		$this->Q1->DbValue = $row['Q1'];
		$this->Q2->DbValue = $row['Q2'];
		$this->Q3->DbValue = $row['Q3'];
		$this->Q4->DbValue = $row['Q4'];
		$this->Q1_Q4->DbValue = $row['Q1-Q4'];
		$this->Percent->DbValue = $row['Percent'];
		$this->Balance->DbValue = $row['Balance'];
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
			return "lacctlist.php";
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
		if ($pageName == "lacctview.php")
			return $Language->phrase("View");
		elseif ($pageName == "lacctedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "lacctadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "lacctlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("lacctview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("lacctview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "lacctadd.php?" . $this->getUrlParm($parm);
		else
			$url = "lacctadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("lacctedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("lacctadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("lacctdelete.php", $this->getUrlParm());
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
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->Details->setDbValue($rs->fields('Details'));
		$this->Approved_Budget->setDbValue($rs->fields('Approved Budget'));
		$this->Budget->setDbValue($rs->fields('Budget'));
		$this->Q1->setDbValue($rs->fields('Q1'));
		$this->Q2->setDbValue($rs->fields('Q2'));
		$this->Q3->setDbValue($rs->fields('Q3'));
		$this->Q4->setDbValue($rs->fields('Q4'));
		$this->Q1_Q4->setDbValue($rs->fields('Q1-Q4'));
		$this->Percent->setDbValue($rs->fields('Percent'));
		$this->Balance->setDbValue($rs->fields('Balance'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LACode
		// Code
		// Details
		// Approved Budget
		// Budget
		// Q1
		// Q2
		// Q3
		// Q4
		// Q1-Q4
		// Percent
		// Balance
		// LACode

		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewValue = FormatNumber($this->LACode->ViewValue, 0, -2, -2, -2);
		$this->LACode->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->ViewValue = FormatNumber($this->Code->ViewValue, 2, -2, -2, -2);
		$this->Code->ViewCustomAttributes = "";

		// Details
		$this->Details->ViewValue = $this->Details->CurrentValue;
		$this->Details->ViewCustomAttributes = "";

		// Approved Budget
		$this->Approved_Budget->ViewValue = $this->Approved_Budget->CurrentValue;
		$this->Approved_Budget->ViewValue = FormatNumber($this->Approved_Budget->ViewValue, 2, -2, -2, -2);
		$this->Approved_Budget->ViewCustomAttributes = "";

		// Budget
		$this->Budget->ViewValue = $this->Budget->CurrentValue;
		$this->Budget->ViewValue = FormatNumber($this->Budget->ViewValue, 2, -2, -2, -2);
		$this->Budget->ViewCustomAttributes = "";

		// Q1
		$this->Q1->ViewValue = $this->Q1->CurrentValue;
		$this->Q1->ViewValue = FormatNumber($this->Q1->ViewValue, 2, -2, -2, -2);
		$this->Q1->ViewCustomAttributes = "";

		// Q2
		$this->Q2->ViewValue = $this->Q2->CurrentValue;
		$this->Q2->ViewValue = FormatNumber($this->Q2->ViewValue, 2, -2, -2, -2);
		$this->Q2->ViewCustomAttributes = "";

		// Q3
		$this->Q3->ViewValue = $this->Q3->CurrentValue;
		$this->Q3->ViewValue = FormatNumber($this->Q3->ViewValue, 2, -2, -2, -2);
		$this->Q3->ViewCustomAttributes = "";

		// Q4
		$this->Q4->ViewValue = $this->Q4->CurrentValue;
		$this->Q4->ViewValue = FormatNumber($this->Q4->ViewValue, 2, -2, -2, -2);
		$this->Q4->ViewCustomAttributes = "";

		// Q1-Q4
		$this->Q1_Q4->ViewValue = $this->Q1_Q4->CurrentValue;
		$this->Q1_Q4->ViewValue = FormatNumber($this->Q1_Q4->ViewValue, 2, -2, -2, -2);
		$this->Q1_Q4->ViewCustomAttributes = "";

		// Percent
		$this->Percent->ViewValue = $this->Percent->CurrentValue;
		$this->Percent->ViewValue = FormatNumber($this->Percent->ViewValue, 2, -2, -2, -2);
		$this->Percent->ViewCustomAttributes = "";

		// Balance
		$this->Balance->ViewValue = $this->Balance->CurrentValue;
		$this->Balance->ViewValue = FormatNumber($this->Balance->ViewValue, 2, -2, -2, -2);
		$this->Balance->ViewCustomAttributes = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// Details
		$this->Details->LinkCustomAttributes = "";
		$this->Details->HrefValue = "";
		$this->Details->TooltipValue = "";

		// Approved Budget
		$this->Approved_Budget->LinkCustomAttributes = "";
		$this->Approved_Budget->HrefValue = "";
		$this->Approved_Budget->TooltipValue = "";

		// Budget
		$this->Budget->LinkCustomAttributes = "";
		$this->Budget->HrefValue = "";
		$this->Budget->TooltipValue = "";

		// Q1
		$this->Q1->LinkCustomAttributes = "";
		$this->Q1->HrefValue = "";
		$this->Q1->TooltipValue = "";

		// Q2
		$this->Q2->LinkCustomAttributes = "";
		$this->Q2->HrefValue = "";
		$this->Q2->TooltipValue = "";

		// Q3
		$this->Q3->LinkCustomAttributes = "";
		$this->Q3->HrefValue = "";
		$this->Q3->TooltipValue = "";

		// Q4
		$this->Q4->LinkCustomAttributes = "";
		$this->Q4->HrefValue = "";
		$this->Q4->TooltipValue = "";

		// Q1-Q4
		$this->Q1_Q4->LinkCustomAttributes = "";
		$this->Q1_Q4->HrefValue = "";
		$this->Q1_Q4->TooltipValue = "";

		// Percent
		$this->Percent->LinkCustomAttributes = "";
		$this->Percent->HrefValue = "";
		$this->Percent->TooltipValue = "";

		// Balance
		$this->Balance->LinkCustomAttributes = "";
		$this->Balance->HrefValue = "";
		$this->Balance->TooltipValue = "";

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
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());
		if (strval($this->Code->EditValue) != "" && is_numeric($this->Code->EditValue))
			$this->Code->EditValue = FormatNumber($this->Code->EditValue, -2, -2, -2, -2);
		

		// Details
		$this->Details->EditAttrs["class"] = "form-control";
		$this->Details->EditCustomAttributes = "";
		if (!$this->Details->Raw)
			$this->Details->CurrentValue = HtmlDecode($this->Details->CurrentValue);
		$this->Details->EditValue = $this->Details->CurrentValue;
		$this->Details->PlaceHolder = RemoveHtml($this->Details->caption());

		// Approved Budget
		$this->Approved_Budget->EditAttrs["class"] = "form-control";
		$this->Approved_Budget->EditCustomAttributes = "";
		$this->Approved_Budget->EditValue = $this->Approved_Budget->CurrentValue;
		$this->Approved_Budget->PlaceHolder = RemoveHtml($this->Approved_Budget->caption());
		if (strval($this->Approved_Budget->EditValue) != "" && is_numeric($this->Approved_Budget->EditValue))
			$this->Approved_Budget->EditValue = FormatNumber($this->Approved_Budget->EditValue, -2, -2, -2, -2);
		

		// Budget
		$this->Budget->EditAttrs["class"] = "form-control";
		$this->Budget->EditCustomAttributes = "";
		$this->Budget->EditValue = $this->Budget->CurrentValue;
		$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());
		if (strval($this->Budget->EditValue) != "" && is_numeric($this->Budget->EditValue))
			$this->Budget->EditValue = FormatNumber($this->Budget->EditValue, -2, -2, -2, -2);
		

		// Q1
		$this->Q1->EditAttrs["class"] = "form-control";
		$this->Q1->EditCustomAttributes = "";
		$this->Q1->EditValue = $this->Q1->CurrentValue;
		$this->Q1->PlaceHolder = RemoveHtml($this->Q1->caption());
		if (strval($this->Q1->EditValue) != "" && is_numeric($this->Q1->EditValue))
			$this->Q1->EditValue = FormatNumber($this->Q1->EditValue, -2, -2, -2, -2);
		

		// Q2
		$this->Q2->EditAttrs["class"] = "form-control";
		$this->Q2->EditCustomAttributes = "";
		$this->Q2->EditValue = $this->Q2->CurrentValue;
		$this->Q2->PlaceHolder = RemoveHtml($this->Q2->caption());
		if (strval($this->Q2->EditValue) != "" && is_numeric($this->Q2->EditValue))
			$this->Q2->EditValue = FormatNumber($this->Q2->EditValue, -2, -2, -2, -2);
		

		// Q3
		$this->Q3->EditAttrs["class"] = "form-control";
		$this->Q3->EditCustomAttributes = "";
		$this->Q3->EditValue = $this->Q3->CurrentValue;
		$this->Q3->PlaceHolder = RemoveHtml($this->Q3->caption());
		if (strval($this->Q3->EditValue) != "" && is_numeric($this->Q3->EditValue))
			$this->Q3->EditValue = FormatNumber($this->Q3->EditValue, -2, -2, -2, -2);
		

		// Q4
		$this->Q4->EditAttrs["class"] = "form-control";
		$this->Q4->EditCustomAttributes = "";
		$this->Q4->EditValue = $this->Q4->CurrentValue;
		$this->Q4->PlaceHolder = RemoveHtml($this->Q4->caption());
		if (strval($this->Q4->EditValue) != "" && is_numeric($this->Q4->EditValue))
			$this->Q4->EditValue = FormatNumber($this->Q4->EditValue, -2, -2, -2, -2);
		

		// Q1-Q4
		$this->Q1_Q4->EditAttrs["class"] = "form-control";
		$this->Q1_Q4->EditCustomAttributes = "";
		$this->Q1_Q4->EditValue = $this->Q1_Q4->CurrentValue;
		$this->Q1_Q4->PlaceHolder = RemoveHtml($this->Q1_Q4->caption());
		if (strval($this->Q1_Q4->EditValue) != "" && is_numeric($this->Q1_Q4->EditValue))
			$this->Q1_Q4->EditValue = FormatNumber($this->Q1_Q4->EditValue, -2, -2, -2, -2);
		

		// Percent
		$this->Percent->EditAttrs["class"] = "form-control";
		$this->Percent->EditCustomAttributes = "";
		$this->Percent->EditValue = $this->Percent->CurrentValue;
		$this->Percent->PlaceHolder = RemoveHtml($this->Percent->caption());
		if (strval($this->Percent->EditValue) != "" && is_numeric($this->Percent->EditValue))
			$this->Percent->EditValue = FormatNumber($this->Percent->EditValue, -2, -2, -2, -2);
		

		// Balance
		$this->Balance->EditAttrs["class"] = "form-control";
		$this->Balance->EditCustomAttributes = "";
		$this->Balance->EditValue = $this->Balance->CurrentValue;
		$this->Balance->PlaceHolder = RemoveHtml($this->Balance->caption());
		if (strval($this->Balance->EditValue) != "" && is_numeric($this->Balance->EditValue))
			$this->Balance->EditValue = FormatNumber($this->Balance->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->Details);
					$doc->exportCaption($this->Approved_Budget);
					$doc->exportCaption($this->Budget);
					$doc->exportCaption($this->Q1);
					$doc->exportCaption($this->Q2);
					$doc->exportCaption($this->Q3);
					$doc->exportCaption($this->Q4);
					$doc->exportCaption($this->Q1_Q4);
					$doc->exportCaption($this->Percent);
					$doc->exportCaption($this->Balance);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->Details);
					$doc->exportCaption($this->Approved_Budget);
					$doc->exportCaption($this->Budget);
					$doc->exportCaption($this->Q1);
					$doc->exportCaption($this->Q2);
					$doc->exportCaption($this->Q3);
					$doc->exportCaption($this->Q4);
					$doc->exportCaption($this->Q1_Q4);
					$doc->exportCaption($this->Percent);
					$doc->exportCaption($this->Balance);
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
						$doc->exportField($this->Code);
						$doc->exportField($this->Details);
						$doc->exportField($this->Approved_Budget);
						$doc->exportField($this->Budget);
						$doc->exportField($this->Q1);
						$doc->exportField($this->Q2);
						$doc->exportField($this->Q3);
						$doc->exportField($this->Q4);
						$doc->exportField($this->Q1_Q4);
						$doc->exportField($this->Percent);
						$doc->exportField($this->Balance);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->Code);
						$doc->exportField($this->Details);
						$doc->exportField($this->Approved_Budget);
						$doc->exportField($this->Budget);
						$doc->exportField($this->Q1);
						$doc->exportField($this->Q2);
						$doc->exportField($this->Q3);
						$doc->exportField($this->Q4);
						$doc->exportField($this->Q1_Q4);
						$doc->exportField($this->Percent);
						$doc->exportField($this->Balance);
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