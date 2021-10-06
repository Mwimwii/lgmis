<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for economic_class_budget_view
 */
class economic_class_budget_view extends DbTable
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
	public $LAName;
	public $AccountGroupCode;
	public $AccountGroupName;
	public $AccountCode;
	public $AccountName;
	public $FinancialYear;
	public $BudgetEstimate;
	public $ApprovedBudget;
	public $ActualAmount;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'economic_class_budget_view';
		$this->TableName = 'economic_class_budget_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`economic_class_budget_view`";
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
		$this->LACode = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->fields['LACode'] = &$this->LACode;

		// LAName
		$this->LAName = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->fields['LAName'] = &$this->LAName;

		// AccountGroupCode
		$this->AccountGroupCode = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_AccountGroupCode', 'AccountGroupCode', '`AccountGroupCode`', '`AccountGroupCode`', 3, 11, -1, FALSE, '`AccountGroupCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountGroupCode->Sortable = TRUE; // Allow sort
		$this->AccountGroupCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountGroupCode'] = &$this->AccountGroupCode;

		// AccountGroupName
		$this->AccountGroupName = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_AccountGroupName', 'AccountGroupName', '`AccountGroupName`', '`AccountGroupName`', 200, 255, -1, FALSE, '`AccountGroupName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountGroupName->Sortable = TRUE; // Allow sort
		$this->fields['AccountGroupName'] = &$this->AccountGroupName;

		// AccountCode
		$this->AccountCode = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_AccountCode', 'AccountCode', '`AccountCode`', '`AccountCode`', 200, 25, -1, FALSE, '`AccountCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountCode->Nullable = FALSE; // NOT NULL field
		$this->AccountCode->Required = TRUE; // Required field
		$this->AccountCode->Sortable = TRUE; // Allow sort
		$this->fields['AccountCode'] = &$this->AccountCode;

		// AccountName
		$this->AccountName = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_AccountName', 'AccountName', '`AccountName`', '`AccountName`', 200, 255, -1, FALSE, '`AccountName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AccountName->Nullable = FALSE; // NOT NULL field
		$this->AccountName->Required = TRUE; // Required field
		$this->AccountName->Sortable = TRUE; // Allow sort
		$this->fields['AccountName'] = &$this->AccountName;

		// FinancialYear
		$this->FinancialYear = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// BudgetEstimate
		$this->BudgetEstimate = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', '`BudgetEstimate`', 5, 23, -1, FALSE, '`BudgetEstimate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BudgetEstimate->Sortable = TRUE; // Allow sort
		$this->BudgetEstimate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BudgetEstimate'] = &$this->BudgetEstimate;

		// ApprovedBudget
		$this->ApprovedBudget = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_ApprovedBudget', 'ApprovedBudget', '`ApprovedBudget`', '`ApprovedBudget`', 5, 23, -1, FALSE, '`ApprovedBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ApprovedBudget->Sortable = TRUE; // Allow sort
		$this->ApprovedBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ApprovedBudget'] = &$this->ApprovedBudget;

		// ActualAmount
		$this->ActualAmount = new DbField('economic_class_budget_view', 'economic_class_budget_view', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 23, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ActualAmount'] = &$this->ActualAmount;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`economic_class_budget_view`";
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
		$this->LAName->DbValue = $row['LAName'];
		$this->AccountGroupCode->DbValue = $row['AccountGroupCode'];
		$this->AccountGroupName->DbValue = $row['AccountGroupName'];
		$this->AccountCode->DbValue = $row['AccountCode'];
		$this->AccountName->DbValue = $row['AccountName'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->BudgetEstimate->DbValue = $row['BudgetEstimate'];
		$this->ApprovedBudget->DbValue = $row['ApprovedBudget'];
		$this->ActualAmount->DbValue = $row['ActualAmount'];
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
			return "economic_class_budget_viewlist.php";
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
		if ($pageName == "economic_class_budget_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "economic_class_budget_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "economic_class_budget_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "economic_class_budget_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("economic_class_budget_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("economic_class_budget_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "economic_class_budget_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "economic_class_budget_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("economic_class_budget_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("economic_class_budget_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("economic_class_budget_viewdelete.php", $this->getUrlParm());
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
		$this->LAName->setDbValue($rs->fields('LAName'));
		$this->AccountGroupCode->setDbValue($rs->fields('AccountGroupCode'));
		$this->AccountGroupName->setDbValue($rs->fields('AccountGroupName'));
		$this->AccountCode->setDbValue($rs->fields('AccountCode'));
		$this->AccountName->setDbValue($rs->fields('AccountName'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->BudgetEstimate->setDbValue($rs->fields('BudgetEstimate'));
		$this->ApprovedBudget->setDbValue($rs->fields('ApprovedBudget'));
		$this->ActualAmount->setDbValue($rs->fields('ActualAmount'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LACode
		// LAName
		// AccountGroupCode
		// AccountGroupName
		// AccountCode
		// AccountName
		// FinancialYear
		// BudgetEstimate
		// ApprovedBudget
		// ActualAmount
		// LACode

		$this->LACode->ViewValue = $this->LACode->CurrentValue;
		$this->LACode->ViewCustomAttributes = "";

		// LAName
		$this->LAName->ViewValue = $this->LAName->CurrentValue;
		$this->LAName->ViewCustomAttributes = "";

		// AccountGroupCode
		$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
		$this->AccountGroupCode->ViewValue = FormatNumber($this->AccountGroupCode->ViewValue, 0, -2, -2, -2);
		$this->AccountGroupCode->ViewCustomAttributes = "";

		// AccountGroupName
		$this->AccountGroupName->ViewValue = $this->AccountGroupName->CurrentValue;
		$this->AccountGroupName->ViewCustomAttributes = "";

		// AccountCode
		$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
		$this->AccountCode->ViewCustomAttributes = "";

		// AccountName
		$this->AccountName->ViewValue = $this->AccountName->CurrentValue;
		$this->AccountName->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewValue = FormatNumber($this->FinancialYear->ViewValue, 0, -2, -2, -2);
		$this->FinancialYear->ViewCustomAttributes = "";

		// BudgetEstimate
		$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
		$this->BudgetEstimate->ViewCustomAttributes = "";

		// ApprovedBudget
		$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
		$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
		$this->ApprovedBudget->ViewCustomAttributes = "";

		// ActualAmount
		$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
		$this->ActualAmount->ViewCustomAttributes = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// LAName
		$this->LAName->LinkCustomAttributes = "";
		$this->LAName->HrefValue = "";
		$this->LAName->TooltipValue = "";

		// AccountGroupCode
		$this->AccountGroupCode->LinkCustomAttributes = "";
		$this->AccountGroupCode->HrefValue = "";
		$this->AccountGroupCode->TooltipValue = "";

		// AccountGroupName
		$this->AccountGroupName->LinkCustomAttributes = "";
		$this->AccountGroupName->HrefValue = "";
		$this->AccountGroupName->TooltipValue = "";

		// AccountCode
		$this->AccountCode->LinkCustomAttributes = "";
		$this->AccountCode->HrefValue = "";
		$this->AccountCode->TooltipValue = "";

		// AccountName
		$this->AccountName->LinkCustomAttributes = "";
		$this->AccountName->HrefValue = "";
		$this->AccountName->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// BudgetEstimate
		$this->BudgetEstimate->LinkCustomAttributes = "";
		$this->BudgetEstimate->HrefValue = "";
		$this->BudgetEstimate->TooltipValue = "";

		// ApprovedBudget
		$this->ApprovedBudget->LinkCustomAttributes = "";
		$this->ApprovedBudget->HrefValue = "";
		$this->ApprovedBudget->TooltipValue = "";

		// ActualAmount
		$this->ActualAmount->LinkCustomAttributes = "";
		$this->ActualAmount->HrefValue = "";
		$this->ActualAmount->TooltipValue = "";

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

		// AccountGroupCode
		$this->AccountGroupCode->EditAttrs["class"] = "form-control";
		$this->AccountGroupCode->EditCustomAttributes = "";
		$this->AccountGroupCode->EditValue = $this->AccountGroupCode->CurrentValue;
		$this->AccountGroupCode->PlaceHolder = RemoveHtml($this->AccountGroupCode->caption());

		// AccountGroupName
		$this->AccountGroupName->EditAttrs["class"] = "form-control";
		$this->AccountGroupName->EditCustomAttributes = "";
		if (!$this->AccountGroupName->Raw)
			$this->AccountGroupName->CurrentValue = HtmlDecode($this->AccountGroupName->CurrentValue);
		$this->AccountGroupName->EditValue = $this->AccountGroupName->CurrentValue;
		$this->AccountGroupName->PlaceHolder = RemoveHtml($this->AccountGroupName->caption());

		// AccountCode
		$this->AccountCode->EditAttrs["class"] = "form-control";
		$this->AccountCode->EditCustomAttributes = "";
		if (!$this->AccountCode->Raw)
			$this->AccountCode->CurrentValue = HtmlDecode($this->AccountCode->CurrentValue);
		$this->AccountCode->EditValue = $this->AccountCode->CurrentValue;
		$this->AccountCode->PlaceHolder = RemoveHtml($this->AccountCode->caption());

		// AccountName
		$this->AccountName->EditAttrs["class"] = "form-control";
		$this->AccountName->EditCustomAttributes = "";
		if (!$this->AccountName->Raw)
			$this->AccountName->CurrentValue = HtmlDecode($this->AccountName->CurrentValue);
		$this->AccountName->EditValue = $this->AccountName->CurrentValue;
		$this->AccountName->PlaceHolder = RemoveHtml($this->AccountName->caption());

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

		// BudgetEstimate
		$this->BudgetEstimate->EditAttrs["class"] = "form-control";
		$this->BudgetEstimate->EditCustomAttributes = "";
		$this->BudgetEstimate->EditValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
		if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue))
			$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
		

		// ApprovedBudget
		$this->ApprovedBudget->EditAttrs["class"] = "form-control";
		$this->ApprovedBudget->EditCustomAttributes = "";
		$this->ApprovedBudget->EditValue = $this->ApprovedBudget->CurrentValue;
		$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
		if (strval($this->ApprovedBudget->EditValue) != "" && is_numeric($this->ApprovedBudget->EditValue))
			$this->ApprovedBudget->EditValue = FormatNumber($this->ApprovedBudget->EditValue, -2, -2, -2, -2);
		

		// ActualAmount
		$this->ActualAmount->EditAttrs["class"] = "form-control";
		$this->ActualAmount->EditCustomAttributes = "";
		$this->ActualAmount->EditValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
		if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
			$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->AccountGroupCode);
					$doc->exportCaption($this->AccountGroupName);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->AccountName);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->ApprovedBudget);
					$doc->exportCaption($this->ActualAmount);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->AccountGroupCode);
					$doc->exportCaption($this->AccountGroupName);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->AccountName);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->ApprovedBudget);
					$doc->exportCaption($this->ActualAmount);
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
						$doc->exportField($this->LAName);
						$doc->exportField($this->AccountGroupCode);
						$doc->exportField($this->AccountGroupName);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->AccountName);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->ApprovedBudget);
						$doc->exportField($this->ActualAmount);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->LAName);
						$doc->exportField($this->AccountGroupCode);
						$doc->exportField($this->AccountGroupName);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->AccountName);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->ApprovedBudget);
						$doc->exportField($this->ActualAmount);
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
		$row = executeRow("select * from musers where username = '" . $username . "'");
		$prv = $row["ProvinceCode"];
		$la = $row["LACode"];
		if(isset($la)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   ( '" . $la .  	"')  ");  }

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