<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for standard_rate
 */
class standard_rate extends DbTable
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
	public $account_id;
	public $moimp_code;
	public $account_code;
	public $period_code;
	public $level_code;
	public $destination_code;
	public $amount;
	public $currency_Code;
	public $last_user;
	public $last_update;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'standard_rate';
		$this->TableName = 'standard_rate';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`standard_rate`";
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

		// account_id
		$this->account_id = new DbField('standard_rate', 'standard_rate', 'x_account_id', 'account_id', '`account_id`', '`account_id`', 3, 11, -1, FALSE, '`account_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->account_id->Nullable = FALSE; // NOT NULL field
		$this->account_id->Required = TRUE; // Required field
		$this->account_id->Sortable = TRUE; // Allow sort
		$this->account_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['account_id'] = &$this->account_id;

		// moimp_code
		$this->moimp_code = new DbField('standard_rate', 'standard_rate', 'x_moimp_code', 'moimp_code', '`moimp_code`', '`moimp_code`', 3, 11, -1, FALSE, '`moimp_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->moimp_code->Nullable = FALSE; // NOT NULL field
		$this->moimp_code->Required = TRUE; // Required field
		$this->moimp_code->Sortable = TRUE; // Allow sort
		$this->moimp_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['moimp_code'] = &$this->moimp_code;

		// account_code
		$this->account_code = new DbField('standard_rate', 'standard_rate', 'x_account_code', 'account_code', '`account_code`', '`account_code`', 200, 40, -1, FALSE, '`account_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->account_code->Nullable = FALSE; // NOT NULL field
		$this->account_code->Required = TRUE; // Required field
		$this->account_code->Sortable = TRUE; // Allow sort
		$this->fields['account_code'] = &$this->account_code;

		// period_code
		$this->period_code = new DbField('standard_rate', 'standard_rate', 'x_period_code', 'period_code', '`period_code`', '`period_code`', 3, 11, -1, FALSE, '`period_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->period_code->Nullable = FALSE; // NOT NULL field
		$this->period_code->Required = TRUE; // Required field
		$this->period_code->Sortable = TRUE; // Allow sort
		$this->period_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['period_code'] = &$this->period_code;

		// level_code
		$this->level_code = new DbField('standard_rate', 'standard_rate', 'x_level_code', 'level_code', '`level_code`', '`level_code`', 3, 11, -1, FALSE, '`level_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->level_code->Nullable = FALSE; // NOT NULL field
		$this->level_code->Required = TRUE; // Required field
		$this->level_code->Sortable = TRUE; // Allow sort
		$this->level_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['level_code'] = &$this->level_code;

		// destination_code
		$this->destination_code = new DbField('standard_rate', 'standard_rate', 'x_destination_code', 'destination_code', '`destination_code`', '`destination_code`', 3, 11, -1, FALSE, '`destination_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->destination_code->Nullable = FALSE; // NOT NULL field
		$this->destination_code->Required = TRUE; // Required field
		$this->destination_code->Sortable = TRUE; // Allow sort
		$this->destination_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['destination_code'] = &$this->destination_code;

		// amount
		$this->amount = new DbField('standard_rate', 'standard_rate', 'x_amount', 'amount', '`amount`', '`amount`', 4, 12, -1, FALSE, '`amount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->amount->Sortable = TRUE; // Allow sort
		$this->amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['amount'] = &$this->amount;

		// currency_Code
		$this->currency_Code = new DbField('standard_rate', 'standard_rate', 'x_currency_Code', 'currency_Code', '`currency_Code`', '`currency_Code`', 200, 5, -1, FALSE, '`currency_Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->currency_Code->Sortable = TRUE; // Allow sort
		$this->fields['currency_Code'] = &$this->currency_Code;

		// last_user
		$this->last_user = new DbField('standard_rate', 'standard_rate', 'x_last_user', 'last_user', '`last_user`', '`last_user`', 200, 15, -1, FALSE, '`last_user`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->last_user->Sortable = TRUE; // Allow sort
		$this->fields['last_user'] = &$this->last_user;

		// last_update
		$this->last_update = new DbField('standard_rate', 'standard_rate', 'x_last_update', 'last_update', '`last_update`', CastDateFieldForLike("`last_update`", 0, "DB"), 135, 19, 0, FALSE, '`last_update`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->last_update->Sortable = TRUE; // Allow sort
		$this->last_update->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['last_update'] = &$this->last_update;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`standard_rate`";
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
		$this->account_id->DbValue = $row['account_id'];
		$this->moimp_code->DbValue = $row['moimp_code'];
		$this->account_code->DbValue = $row['account_code'];
		$this->period_code->DbValue = $row['period_code'];
		$this->level_code->DbValue = $row['level_code'];
		$this->destination_code->DbValue = $row['destination_code'];
		$this->amount->DbValue = $row['amount'];
		$this->currency_Code->DbValue = $row['currency_Code'];
		$this->last_user->DbValue = $row['last_user'];
		$this->last_update->DbValue = $row['last_update'];
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
			return "standard_ratelist.php";
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
		if ($pageName == "standard_rateview.php")
			return $Language->phrase("View");
		elseif ($pageName == "standard_rateedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "standard_rateadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "standard_ratelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("standard_rateview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("standard_rateview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "standard_rateadd.php?" . $this->getUrlParm($parm);
		else
			$url = "standard_rateadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("standard_rateedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("standard_rateadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("standard_ratedelete.php", $this->getUrlParm());
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
		$this->account_id->setDbValue($rs->fields('account_id'));
		$this->moimp_code->setDbValue($rs->fields('moimp_code'));
		$this->account_code->setDbValue($rs->fields('account_code'));
		$this->period_code->setDbValue($rs->fields('period_code'));
		$this->level_code->setDbValue($rs->fields('level_code'));
		$this->destination_code->setDbValue($rs->fields('destination_code'));
		$this->amount->setDbValue($rs->fields('amount'));
		$this->currency_Code->setDbValue($rs->fields('currency_Code'));
		$this->last_user->setDbValue($rs->fields('last_user'));
		$this->last_update->setDbValue($rs->fields('last_update'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// account_id
		// moimp_code
		// account_code
		// period_code
		// level_code
		// destination_code
		// amount
		// currency_Code
		// last_user
		// last_update
		// account_id

		$this->account_id->ViewValue = $this->account_id->CurrentValue;
		$this->account_id->ViewCustomAttributes = "";

		// moimp_code
		$this->moimp_code->ViewValue = $this->moimp_code->CurrentValue;
		$this->moimp_code->ViewCustomAttributes = "";

		// account_code
		$this->account_code->ViewValue = $this->account_code->CurrentValue;
		$this->account_code->ViewCustomAttributes = "";

		// period_code
		$this->period_code->ViewValue = $this->period_code->CurrentValue;
		$this->period_code->ViewCustomAttributes = "";

		// level_code
		$this->level_code->ViewValue = $this->level_code->CurrentValue;
		$this->level_code->ViewCustomAttributes = "";

		// destination_code
		$this->destination_code->ViewValue = $this->destination_code->CurrentValue;
		$this->destination_code->ViewCustomAttributes = "";

		// amount
		$this->amount->ViewValue = $this->amount->CurrentValue;
		$this->amount->ViewValue = FormatNumber($this->amount->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->amount->ViewCustomAttributes = "";

		// currency_Code
		$this->currency_Code->ViewValue = $this->currency_Code->CurrentValue;
		$this->currency_Code->ViewCustomAttributes = "";

		// last_user
		$this->last_user->ViewValue = $this->last_user->CurrentValue;
		$this->last_user->ViewCustomAttributes = "";

		// last_update
		$this->last_update->ViewValue = $this->last_update->CurrentValue;
		$this->last_update->ViewValue = FormatDateTime($this->last_update->ViewValue, 0);
		$this->last_update->ViewCustomAttributes = "";

		// account_id
		$this->account_id->LinkCustomAttributes = "";
		$this->account_id->HrefValue = "";
		$this->account_id->TooltipValue = "";

		// moimp_code
		$this->moimp_code->LinkCustomAttributes = "";
		$this->moimp_code->HrefValue = "";
		$this->moimp_code->TooltipValue = "";

		// account_code
		$this->account_code->LinkCustomAttributes = "";
		$this->account_code->HrefValue = "";
		$this->account_code->TooltipValue = "";

		// period_code
		$this->period_code->LinkCustomAttributes = "";
		$this->period_code->HrefValue = "";
		$this->period_code->TooltipValue = "";

		// level_code
		$this->level_code->LinkCustomAttributes = "";
		$this->level_code->HrefValue = "";
		$this->level_code->TooltipValue = "";

		// destination_code
		$this->destination_code->LinkCustomAttributes = "";
		$this->destination_code->HrefValue = "";
		$this->destination_code->TooltipValue = "";

		// amount
		$this->amount->LinkCustomAttributes = "";
		$this->amount->HrefValue = "";
		$this->amount->TooltipValue = "";

		// currency_Code
		$this->currency_Code->LinkCustomAttributes = "";
		$this->currency_Code->HrefValue = "";
		$this->currency_Code->TooltipValue = "";

		// last_user
		$this->last_user->LinkCustomAttributes = "";
		$this->last_user->HrefValue = "";
		$this->last_user->TooltipValue = "";

		// last_update
		$this->last_update->LinkCustomAttributes = "";
		$this->last_update->HrefValue = "";
		$this->last_update->TooltipValue = "";

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

		// account_id
		$this->account_id->EditAttrs["class"] = "form-control";
		$this->account_id->EditCustomAttributes = "";
		$this->account_id->EditValue = $this->account_id->CurrentValue;
		$this->account_id->PlaceHolder = RemoveHtml($this->account_id->caption());

		// moimp_code
		$this->moimp_code->EditAttrs["class"] = "form-control";
		$this->moimp_code->EditCustomAttributes = "";
		$this->moimp_code->EditValue = $this->moimp_code->CurrentValue;
		$this->moimp_code->PlaceHolder = RemoveHtml($this->moimp_code->caption());

		// account_code
		$this->account_code->EditAttrs["class"] = "form-control";
		$this->account_code->EditCustomAttributes = "";
		if (!$this->account_code->Raw)
			$this->account_code->CurrentValue = HtmlDecode($this->account_code->CurrentValue);
		$this->account_code->EditValue = $this->account_code->CurrentValue;
		$this->account_code->PlaceHolder = RemoveHtml($this->account_code->caption());

		// period_code
		$this->period_code->EditAttrs["class"] = "form-control";
		$this->period_code->EditCustomAttributes = "";
		$this->period_code->EditValue = $this->period_code->CurrentValue;
		$this->period_code->PlaceHolder = RemoveHtml($this->period_code->caption());

		// level_code
		$this->level_code->EditAttrs["class"] = "form-control";
		$this->level_code->EditCustomAttributes = "";
		$this->level_code->EditValue = $this->level_code->CurrentValue;
		$this->level_code->PlaceHolder = RemoveHtml($this->level_code->caption());

		// destination_code
		$this->destination_code->EditAttrs["class"] = "form-control";
		$this->destination_code->EditCustomAttributes = "";
		$this->destination_code->EditValue = $this->destination_code->CurrentValue;
		$this->destination_code->PlaceHolder = RemoveHtml($this->destination_code->caption());

		// amount
		$this->amount->EditAttrs["class"] = "form-control";
		$this->amount->EditCustomAttributes = "";
		$this->amount->EditValue = $this->amount->CurrentValue;
		$this->amount->PlaceHolder = RemoveHtml($this->amount->caption());
		if (strval($this->amount->EditValue) != "" && is_numeric($this->amount->EditValue))
			$this->amount->EditValue = FormatNumber($this->amount->EditValue, -2, -1, -2, 0);
		

		// currency_Code
		$this->currency_Code->EditAttrs["class"] = "form-control";
		$this->currency_Code->EditCustomAttributes = "";
		if (!$this->currency_Code->Raw)
			$this->currency_Code->CurrentValue = HtmlDecode($this->currency_Code->CurrentValue);
		$this->currency_Code->EditValue = $this->currency_Code->CurrentValue;
		$this->currency_Code->PlaceHolder = RemoveHtml($this->currency_Code->caption());

		// last_user
		$this->last_user->EditAttrs["class"] = "form-control";
		$this->last_user->EditCustomAttributes = "";
		if (!$this->last_user->Raw)
			$this->last_user->CurrentValue = HtmlDecode($this->last_user->CurrentValue);
		$this->last_user->EditValue = $this->last_user->CurrentValue;
		$this->last_user->PlaceHolder = RemoveHtml($this->last_user->caption());

		// last_update
		$this->last_update->EditAttrs["class"] = "form-control";
		$this->last_update->EditCustomAttributes = "";
		$this->last_update->EditValue = FormatDateTime($this->last_update->CurrentValue, 8);
		$this->last_update->PlaceHolder = RemoveHtml($this->last_update->caption());

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
					$doc->exportCaption($this->account_id);
					$doc->exportCaption($this->moimp_code);
					$doc->exportCaption($this->account_code);
					$doc->exportCaption($this->period_code);
					$doc->exportCaption($this->level_code);
					$doc->exportCaption($this->destination_code);
					$doc->exportCaption($this->amount);
					$doc->exportCaption($this->currency_Code);
					$doc->exportCaption($this->last_user);
					$doc->exportCaption($this->last_update);
				} else {
					$doc->exportCaption($this->account_id);
					$doc->exportCaption($this->moimp_code);
					$doc->exportCaption($this->account_code);
					$doc->exportCaption($this->period_code);
					$doc->exportCaption($this->level_code);
					$doc->exportCaption($this->destination_code);
					$doc->exportCaption($this->amount);
					$doc->exportCaption($this->currency_Code);
					$doc->exportCaption($this->last_user);
					$doc->exportCaption($this->last_update);
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
						$doc->exportField($this->account_id);
						$doc->exportField($this->moimp_code);
						$doc->exportField($this->account_code);
						$doc->exportField($this->period_code);
						$doc->exportField($this->level_code);
						$doc->exportField($this->destination_code);
						$doc->exportField($this->amount);
						$doc->exportField($this->currency_Code);
						$doc->exportField($this->last_user);
						$doc->exportField($this->last_update);
					} else {
						$doc->exportField($this->account_id);
						$doc->exportField($this->moimp_code);
						$doc->exportField($this->account_code);
						$doc->exportField($this->period_code);
						$doc->exportField($this->level_code);
						$doc->exportField($this->destination_code);
						$doc->exportField($this->amount);
						$doc->exportField($this->currency_Code);
						$doc->exportField($this->last_user);
						$doc->exportField($this->last_update);
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