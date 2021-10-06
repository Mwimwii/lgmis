<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for account_sub_group
 */
class account_sub_group extends DbTable
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
	public $AccountType;
	public $AccountGroupCode;
	public $AccountSubGroupCode;
	public $AccountSubGroupName;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'account_sub_group';
		$this->TableName = 'account_sub_group';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`account_sub_group`";
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
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// AccountType
		$this->AccountType = new DbField('account_sub_group', 'account_sub_group', 'x_AccountType', 'AccountType', '`AccountType`', '`AccountType`', 3, 11, -1, FALSE, '`AccountType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountType->IsForeignKey = TRUE; // Foreign key field
		$this->AccountType->Nullable = FALSE; // NOT NULL field
		$this->AccountType->Required = TRUE; // Required field
		$this->AccountType->Sortable = TRUE; // Allow sort
		$this->AccountType->Lookup = new Lookup('AccountType', 'account_type', FALSE, 'AccountTypeCode', ["AccountType","","",""], [], [], [], [], [], [], '', '');
		$this->AccountType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountType'] = &$this->AccountType;

		// AccountGroupCode
		$this->AccountGroupCode = new DbField('account_sub_group', 'account_sub_group', 'x_AccountGroupCode', 'AccountGroupCode', '`AccountGroupCode`', '`AccountGroupCode`', 3, 11, -1, FALSE, '`AccountGroupCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountGroupCode->IsForeignKey = TRUE; // Foreign key field
		$this->AccountGroupCode->Nullable = FALSE; // NOT NULL field
		$this->AccountGroupCode->Required = TRUE; // Required field
		$this->AccountGroupCode->Sortable = TRUE; // Allow sort
		$this->AccountGroupCode->Lookup = new Lookup('AccountGroupCode', 'accountgroup', FALSE, 'AccountGroupCode', ["AccountGroupName","","",""], [], [], [], [], [], [], '', '');
		$this->AccountGroupCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountGroupCode'] = &$this->AccountGroupCode;

		// AccountSubGroupCode
		$this->AccountSubGroupCode = new DbField('account_sub_group', 'account_sub_group', 'x_AccountSubGroupCode', 'AccountSubGroupCode', '`AccountSubGroupCode`', '`AccountSubGroupCode`', 3, 11, -1, FALSE, '`AccountSubGroupCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountSubGroupCode->IsForeignKey = TRUE; // Foreign key field
		$this->AccountSubGroupCode->Nullable = FALSE; // NOT NULL field
		$this->AccountSubGroupCode->Required = TRUE; // Required field
		$this->AccountSubGroupCode->Sortable = TRUE; // Allow sort
		$this->AccountSubGroupCode->Lookup = new Lookup('AccountSubGroupCode', 'account_sub_group', FALSE, 'AccountSubGroupCode', ["AccountSubGroupName","","",""], [], [], [], [], [], [], '', '');
		$this->AccountSubGroupCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountSubGroupCode'] = &$this->AccountSubGroupCode;

		// AccountSubGroupName
		$this->AccountSubGroupName = new DbField('account_sub_group', 'account_sub_group', 'x_AccountSubGroupName', 'AccountSubGroupName', '`AccountSubGroupName`', '`AccountSubGroupName`', 200, 255, -1, FALSE, '`AccountSubGroupName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountSubGroupName->Nullable = FALSE; // NOT NULL field
		$this->AccountSubGroupName->Required = TRUE; // Required field
		$this->AccountSubGroupName->Sortable = TRUE; // Allow sort
		$this->fields['AccountSubGroupName'] = &$this->AccountSubGroupName;
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
		if ($this->getCurrentMasterTable() == "accountgroup") {
			if ($this->AccountType->getSessionValue() != "")
				$masterFilter .= "`AccountType`=" . QuotedValue($this->AccountType->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->AccountGroupCode->getSessionValue() != "")
				$masterFilter .= " AND `AccountGroupCode`=" . QuotedValue($this->AccountGroupCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "accountgroup") {
			if ($this->AccountType->getSessionValue() != "")
				$detailFilter .= "`AccountType`=" . QuotedValue($this->AccountType->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->AccountGroupCode->getSessionValue() != "")
				$detailFilter .= " AND `AccountGroupCode`=" . QuotedValue($this->AccountGroupCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_accountgroup()
	{
		return "`AccountType`=@AccountType@ AND `AccountGroupCode`=@AccountGroupCode@";
	}

	// Detail filter
	public function sqlDetailFilter_accountgroup()
	{
		return "`AccountType`=@AccountType@ AND `AccountGroupCode`=@AccountGroupCode@";
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
		if ($this->getCurrentDetailTable() == "_account_ref_master") {
			$detailUrl = $GLOBALS["_account_ref_master"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_AccountType=" . urlencode($this->AccountType->CurrentValue);
			$detailUrl .= "&fk_AccountGroupCode=" . urlencode($this->AccountGroupCode->CurrentValue);
			$detailUrl .= "&fk_AccountSubGroupCode=" . urlencode($this->AccountSubGroupCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "account_sub_grouplist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`account_sub_group`";
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
		$this->AccountType->DbValue = $row['AccountType'];
		$this->AccountGroupCode->DbValue = $row['AccountGroupCode'];
		$this->AccountSubGroupCode->DbValue = $row['AccountSubGroupCode'];
		$this->AccountSubGroupName->DbValue = $row['AccountSubGroupName'];
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
			return "account_sub_grouplist.php";
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
		if ($pageName == "account_sub_groupview.php")
			return $Language->phrase("View");
		elseif ($pageName == "account_sub_groupedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "account_sub_groupadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "account_sub_grouplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("account_sub_groupview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("account_sub_groupview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "account_sub_groupadd.php?" . $this->getUrlParm($parm);
		else
			$url = "account_sub_groupadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("account_sub_groupedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("account_sub_groupadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("account_sub_groupdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "accountgroup" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_AccountType=" . urlencode($this->AccountType->CurrentValue);
			$url .= "&fk_AccountGroupCode=" . urlencode($this->AccountGroupCode->CurrentValue);
		}
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
		$this->AccountType->setDbValue($rs->fields('AccountType'));
		$this->AccountGroupCode->setDbValue($rs->fields('AccountGroupCode'));
		$this->AccountSubGroupCode->setDbValue($rs->fields('AccountSubGroupCode'));
		$this->AccountSubGroupName->setDbValue($rs->fields('AccountSubGroupName'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// AccountType
		// AccountGroupCode
		// AccountSubGroupCode
		// AccountSubGroupName
		// AccountType

		$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
		$curVal = strval($this->AccountType->CurrentValue);
		if ($curVal != "") {
			$this->AccountType->ViewValue = $this->AccountType->lookupCacheOption($curVal);
			if ($this->AccountType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AccountType->ViewValue = $this->AccountType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
				}
			}
		} else {
			$this->AccountType->ViewValue = NULL;
		}
		$this->AccountType->ViewCustomAttributes = "";

		// AccountGroupCode
		$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
		$curVal = strval($this->AccountGroupCode->CurrentValue);
		if ($curVal != "") {
			$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->lookupCacheOption($curVal);
			if ($this->AccountGroupCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
				}
			}
		} else {
			$this->AccountGroupCode->ViewValue = NULL;
		}
		$this->AccountGroupCode->ViewCustomAttributes = "";

		// AccountSubGroupCode
		$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
		$arwrk = [];
		$arwrk[1] = $this->AccountSubGroupName->CurrentValue;
		$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->displayValue($arwrk);
		$this->AccountSubGroupCode->ViewCustomAttributes = "";

		// AccountSubGroupName
		$this->AccountSubGroupName->ViewValue = $this->AccountSubGroupName->CurrentValue;
		$this->AccountSubGroupName->ViewCustomAttributes = "";

		// AccountType
		$this->AccountType->LinkCustomAttributes = "";
		$this->AccountType->HrefValue = "";
		$this->AccountType->TooltipValue = "";

		// AccountGroupCode
		$this->AccountGroupCode->LinkCustomAttributes = "";
		$this->AccountGroupCode->HrefValue = "";
		$this->AccountGroupCode->TooltipValue = "";

		// AccountSubGroupCode
		$this->AccountSubGroupCode->LinkCustomAttributes = "";
		$this->AccountSubGroupCode->HrefValue = "";
		$this->AccountSubGroupCode->TooltipValue = "";

		// AccountSubGroupName
		$this->AccountSubGroupName->LinkCustomAttributes = "";
		$this->AccountSubGroupName->HrefValue = "";
		$this->AccountSubGroupName->TooltipValue = "";

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

		// AccountType
		$this->AccountType->EditAttrs["class"] = "form-control";
		$this->AccountType->EditCustomAttributes = "";
		if ($this->AccountType->getSessionValue() != "") {
			$this->AccountType->CurrentValue = $this->AccountType->getSessionValue();
			$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
			$curVal = strval($this->AccountType->CurrentValue);
			if ($curVal != "") {
				$this->AccountType->ViewValue = $this->AccountType->lookupCacheOption($curVal);
				if ($this->AccountType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountType->ViewValue = $this->AccountType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
					}
				}
			} else {
				$this->AccountType->ViewValue = NULL;
			}
			$this->AccountType->ViewCustomAttributes = "";
		} else {
			$this->AccountType->EditValue = $this->AccountType->CurrentValue;
			$this->AccountType->PlaceHolder = RemoveHtml($this->AccountType->caption());
		}

		// AccountGroupCode
		$this->AccountGroupCode->EditAttrs["class"] = "form-control";
		$this->AccountGroupCode->EditCustomAttributes = "";
		if ($this->AccountGroupCode->getSessionValue() != "") {
			$this->AccountGroupCode->CurrentValue = $this->AccountGroupCode->getSessionValue();
			$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
			$curVal = strval($this->AccountGroupCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->lookupCacheOption($curVal);
				if ($this->AccountGroupCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
					}
				}
			} else {
				$this->AccountGroupCode->ViewValue = NULL;
			}
			$this->AccountGroupCode->ViewCustomAttributes = "";
		} else {
			$this->AccountGroupCode->EditValue = $this->AccountGroupCode->CurrentValue;
			$this->AccountGroupCode->PlaceHolder = RemoveHtml($this->AccountGroupCode->caption());
		}

		// AccountSubGroupCode
		$this->AccountSubGroupCode->EditAttrs["class"] = "form-control";
		$this->AccountSubGroupCode->EditCustomAttributes = "";
		$this->AccountSubGroupCode->EditValue = $this->AccountSubGroupCode->CurrentValue;
		$this->AccountSubGroupCode->PlaceHolder = RemoveHtml($this->AccountSubGroupCode->caption());

		// AccountSubGroupName
		$this->AccountSubGroupName->EditAttrs["class"] = "form-control";
		$this->AccountSubGroupName->EditCustomAttributes = "";
		if (!$this->AccountSubGroupName->Raw)
			$this->AccountSubGroupName->CurrentValue = HtmlDecode($this->AccountSubGroupName->CurrentValue);
		$this->AccountSubGroupName->EditValue = $this->AccountSubGroupName->CurrentValue;
		$this->AccountSubGroupName->PlaceHolder = RemoveHtml($this->AccountSubGroupName->caption());

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
					$doc->exportCaption($this->AccountType);
					$doc->exportCaption($this->AccountGroupCode);
					$doc->exportCaption($this->AccountSubGroupCode);
					$doc->exportCaption($this->AccountSubGroupName);
				} else {
					$doc->exportCaption($this->AccountType);
					$doc->exportCaption($this->AccountGroupCode);
					$doc->exportCaption($this->AccountSubGroupCode);
					$doc->exportCaption($this->AccountSubGroupName);
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
						$doc->exportField($this->AccountType);
						$doc->exportField($this->AccountGroupCode);
						$doc->exportField($this->AccountSubGroupCode);
						$doc->exportField($this->AccountSubGroupName);
					} else {
						$doc->exportField($this->AccountType);
						$doc->exportField($this->AccountGroupCode);
						$doc->exportField($this->AccountSubGroupCode);
						$doc->exportField($this->AccountSubGroupName);
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