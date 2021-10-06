<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for payflexi_netpay_schedule_2
 */
class payflexi_netpay_schedule_2 extends DbTable
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
	public $EmployeeID;
	public $FirstName;
	public $Middle_Name;
	public $Surname;
	public $ORIGINATING_ACCT_NO;
	public $DEST_SORT_CODE;
	public $DEST_ACCT_NO;
	public $GrossPay;
	public $TotalDeductions;
	public $NARRATION;
	public $REF;
	public $AMOUNT;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'payflexi_netpay_schedule_2';
		$this->TableName = 'payflexi_netpay_schedule_2';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`payflexi_netpay_schedule_2`";
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

		// EmployeeID
		$this->EmployeeID = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// FirstName
		$this->FirstName = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// Middle Name
		$this->Middle_Name = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_Middle_Name', 'Middle Name', '`Middle Name`', '`Middle Name`', 200, 100, -1, FALSE, '`Middle Name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Middle_Name->Sortable = TRUE; // Allow sort
		$this->fields['Middle Name'] = &$this->Middle_Name;

		// Surname
		$this->Surname = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// ORIGINATING ACCT NO
		$this->ORIGINATING_ACCT_NO = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_ORIGINATING_ACCT_NO', 'ORIGINATING ACCT NO', '`ORIGINATING ACCT NO`', '`ORIGINATING ACCT NO`', 200, 12, -1, FALSE, '`ORIGINATING ACCT NO`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ORIGINATING_ACCT_NO->Nullable = FALSE; // NOT NULL field
		$this->ORIGINATING_ACCT_NO->Required = TRUE; // Required field
		$this->ORIGINATING_ACCT_NO->Sortable = TRUE; // Allow sort
		$this->fields['ORIGINATING ACCT NO'] = &$this->ORIGINATING_ACCT_NO;

		// DEST SORT CODE
		$this->DEST_SORT_CODE = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_DEST_SORT_CODE', 'DEST SORT CODE', '`DEST SORT CODE`', '`DEST SORT CODE`', 200, 8, -1, FALSE, '`DEST SORT CODE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DEST_SORT_CODE->Sortable = TRUE; // Allow sort
		$this->fields['DEST SORT CODE'] = &$this->DEST_SORT_CODE;

		// DEST ACCT NO
		$this->DEST_ACCT_NO = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_DEST_ACCT_NO', 'DEST ACCT NO', '`DEST ACCT NO`', '`DEST ACCT NO`', 200, 13, -1, FALSE, '`DEST ACCT NO`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DEST_ACCT_NO->Sortable = TRUE; // Allow sort
		$this->fields['DEST ACCT NO'] = &$this->DEST_ACCT_NO;

		// GrossPay
		$this->GrossPay = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_GrossPay', 'GrossPay', '`GrossPay`', '`GrossPay`', 5, 23, -1, FALSE, '`GrossPay`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->GrossPay->Sortable = TRUE; // Allow sort
		$this->GrossPay->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['GrossPay'] = &$this->GrossPay;

		// TotalDeductions
		$this->TotalDeductions = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_TotalDeductions', 'TotalDeductions', '`TotalDeductions`', '`TotalDeductions`', 5, 23, -1, FALSE, '`TotalDeductions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TotalDeductions->Sortable = TRUE; // Allow sort
		$this->TotalDeductions->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TotalDeductions'] = &$this->TotalDeductions;

		// NARRATION
		$this->NARRATION = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_NARRATION', 'NARRATION', '`NARRATION`', '`NARRATION`', 200, 113, -1, FALSE, '`NARRATION`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NARRATION->Nullable = FALSE; // NOT NULL field
		$this->NARRATION->Required = TRUE; // Required field
		$this->NARRATION->Sortable = TRUE; // Allow sort
		$this->fields['NARRATION'] = &$this->NARRATION;

		// REF
		$this->REF = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_REF', 'REF', '`REF`', '`REF`', 200, 19, -1, FALSE, '`REF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->REF->Nullable = FALSE; // NOT NULL field
		$this->REF->Required = TRUE; // Required field
		$this->REF->Sortable = TRUE; // Allow sort
		$this->fields['REF'] = &$this->REF;

		// AMOUNT
		$this->AMOUNT = new DbField('payflexi_netpay_schedule_2', 'payflexi_netpay_schedule_2', 'x_AMOUNT', 'AMOUNT', '`AMOUNT`', '`AMOUNT`', 5, 23, -1, FALSE, '`AMOUNT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AMOUNT->Sortable = TRUE; // Allow sort
		$this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AMOUNT'] = &$this->AMOUNT;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`payflexi_netpay_schedule_2`";
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->Middle_Name->DbValue = $row['Middle Name'];
		$this->Surname->DbValue = $row['Surname'];
		$this->ORIGINATING_ACCT_NO->DbValue = $row['ORIGINATING ACCT NO'];
		$this->DEST_SORT_CODE->DbValue = $row['DEST SORT CODE'];
		$this->DEST_ACCT_NO->DbValue = $row['DEST ACCT NO'];
		$this->GrossPay->DbValue = $row['GrossPay'];
		$this->TotalDeductions->DbValue = $row['TotalDeductions'];
		$this->NARRATION->DbValue = $row['NARRATION'];
		$this->REF->DbValue = $row['REF'];
		$this->AMOUNT->DbValue = $row['AMOUNT'];
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
			return "payflexi_netpay_schedule_2list.php";
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
		if ($pageName == "payflexi_netpay_schedule_2view.php")
			return $Language->phrase("View");
		elseif ($pageName == "payflexi_netpay_schedule_2edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "payflexi_netpay_schedule_2add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "payflexi_netpay_schedule_2list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("payflexi_netpay_schedule_2view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("payflexi_netpay_schedule_2view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "payflexi_netpay_schedule_2add.php?" . $this->getUrlParm($parm);
		else
			$url = "payflexi_netpay_schedule_2add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("payflexi_netpay_schedule_2edit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("payflexi_netpay_schedule_2add.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("payflexi_netpay_schedule_2delete.php", $this->getUrlParm());
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
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->Middle_Name->setDbValue($rs->fields('Middle Name'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->ORIGINATING_ACCT_NO->setDbValue($rs->fields('ORIGINATING ACCT NO'));
		$this->DEST_SORT_CODE->setDbValue($rs->fields('DEST SORT CODE'));
		$this->DEST_ACCT_NO->setDbValue($rs->fields('DEST ACCT NO'));
		$this->GrossPay->setDbValue($rs->fields('GrossPay'));
		$this->TotalDeductions->setDbValue($rs->fields('TotalDeductions'));
		$this->NARRATION->setDbValue($rs->fields('NARRATION'));
		$this->REF->setDbValue($rs->fields('REF'));
		$this->AMOUNT->setDbValue($rs->fields('AMOUNT'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// FirstName
		// Middle Name
		// Surname
		// ORIGINATING ACCT NO
		// DEST SORT CODE
		// DEST ACCT NO
		// GrossPay
		// TotalDeductions
		// NARRATION
		// REF
		// AMOUNT
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// Middle Name
		$this->Middle_Name->ViewValue = $this->Middle_Name->CurrentValue;
		$this->Middle_Name->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// ORIGINATING ACCT NO
		$this->ORIGINATING_ACCT_NO->ViewValue = $this->ORIGINATING_ACCT_NO->CurrentValue;
		$this->ORIGINATING_ACCT_NO->ViewCustomAttributes = "";

		// DEST SORT CODE
		$this->DEST_SORT_CODE->ViewValue = $this->DEST_SORT_CODE->CurrentValue;
		$this->DEST_SORT_CODE->ViewCustomAttributes = "";

		// DEST ACCT NO
		$this->DEST_ACCT_NO->ViewValue = $this->DEST_ACCT_NO->CurrentValue;
		$this->DEST_ACCT_NO->ViewCustomAttributes = "";

		// GrossPay
		$this->GrossPay->ViewValue = $this->GrossPay->CurrentValue;
		$this->GrossPay->ViewValue = FormatNumber($this->GrossPay->ViewValue, 2, -2, -2, -2);
		$this->GrossPay->ViewCustomAttributes = "";

		// TotalDeductions
		$this->TotalDeductions->ViewValue = $this->TotalDeductions->CurrentValue;
		$this->TotalDeductions->ViewValue = FormatNumber($this->TotalDeductions->ViewValue, 2, -2, -2, -2);
		$this->TotalDeductions->ViewCustomAttributes = "";

		// NARRATION
		$this->NARRATION->ViewValue = $this->NARRATION->CurrentValue;
		$this->NARRATION->ViewCustomAttributes = "";

		// REF
		$this->REF->ViewValue = $this->REF->CurrentValue;
		$this->REF->ViewCustomAttributes = "";

		// AMOUNT
		$this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
		$this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
		$this->AMOUNT->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// Middle Name
		$this->Middle_Name->LinkCustomAttributes = "";
		$this->Middle_Name->HrefValue = "";
		$this->Middle_Name->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// ORIGINATING ACCT NO
		$this->ORIGINATING_ACCT_NO->LinkCustomAttributes = "";
		$this->ORIGINATING_ACCT_NO->HrefValue = "";
		$this->ORIGINATING_ACCT_NO->TooltipValue = "";

		// DEST SORT CODE
		$this->DEST_SORT_CODE->LinkCustomAttributes = "";
		$this->DEST_SORT_CODE->HrefValue = "";
		$this->DEST_SORT_CODE->TooltipValue = "";

		// DEST ACCT NO
		$this->DEST_ACCT_NO->LinkCustomAttributes = "";
		$this->DEST_ACCT_NO->HrefValue = "";
		$this->DEST_ACCT_NO->TooltipValue = "";

		// GrossPay
		$this->GrossPay->LinkCustomAttributes = "";
		$this->GrossPay->HrefValue = "";
		$this->GrossPay->TooltipValue = "";

		// TotalDeductions
		$this->TotalDeductions->LinkCustomAttributes = "";
		$this->TotalDeductions->HrefValue = "";
		$this->TotalDeductions->TooltipValue = "";

		// NARRATION
		$this->NARRATION->LinkCustomAttributes = "";
		$this->NARRATION->HrefValue = "";
		$this->NARRATION->TooltipValue = "";

		// REF
		$this->REF->LinkCustomAttributes = "";
		$this->REF->HrefValue = "";
		$this->REF->TooltipValue = "";

		// AMOUNT
		$this->AMOUNT->LinkCustomAttributes = "";
		$this->AMOUNT->HrefValue = "";
		$this->AMOUNT->TooltipValue = "";

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

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// Middle Name
		$this->Middle_Name->EditAttrs["class"] = "form-control";
		$this->Middle_Name->EditCustomAttributes = "";
		if (!$this->Middle_Name->Raw)
			$this->Middle_Name->CurrentValue = HtmlDecode($this->Middle_Name->CurrentValue);
		$this->Middle_Name->EditValue = $this->Middle_Name->CurrentValue;
		$this->Middle_Name->PlaceHolder = RemoveHtml($this->Middle_Name->caption());

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// ORIGINATING ACCT NO
		$this->ORIGINATING_ACCT_NO->EditAttrs["class"] = "form-control";
		$this->ORIGINATING_ACCT_NO->EditCustomAttributes = "";
		if (!$this->ORIGINATING_ACCT_NO->Raw)
			$this->ORIGINATING_ACCT_NO->CurrentValue = HtmlDecode($this->ORIGINATING_ACCT_NO->CurrentValue);
		$this->ORIGINATING_ACCT_NO->EditValue = $this->ORIGINATING_ACCT_NO->CurrentValue;
		$this->ORIGINATING_ACCT_NO->PlaceHolder = RemoveHtml($this->ORIGINATING_ACCT_NO->caption());

		// DEST SORT CODE
		$this->DEST_SORT_CODE->EditAttrs["class"] = "form-control";
		$this->DEST_SORT_CODE->EditCustomAttributes = "";
		if (!$this->DEST_SORT_CODE->Raw)
			$this->DEST_SORT_CODE->CurrentValue = HtmlDecode($this->DEST_SORT_CODE->CurrentValue);
		$this->DEST_SORT_CODE->EditValue = $this->DEST_SORT_CODE->CurrentValue;
		$this->DEST_SORT_CODE->PlaceHolder = RemoveHtml($this->DEST_SORT_CODE->caption());

		// DEST ACCT NO
		$this->DEST_ACCT_NO->EditAttrs["class"] = "form-control";
		$this->DEST_ACCT_NO->EditCustomAttributes = "";
		if (!$this->DEST_ACCT_NO->Raw)
			$this->DEST_ACCT_NO->CurrentValue = HtmlDecode($this->DEST_ACCT_NO->CurrentValue);
		$this->DEST_ACCT_NO->EditValue = $this->DEST_ACCT_NO->CurrentValue;
		$this->DEST_ACCT_NO->PlaceHolder = RemoveHtml($this->DEST_ACCT_NO->caption());

		// GrossPay
		$this->GrossPay->EditAttrs["class"] = "form-control";
		$this->GrossPay->EditCustomAttributes = "";
		$this->GrossPay->EditValue = $this->GrossPay->CurrentValue;
		$this->GrossPay->PlaceHolder = RemoveHtml($this->GrossPay->caption());
		if (strval($this->GrossPay->EditValue) != "" && is_numeric($this->GrossPay->EditValue))
			$this->GrossPay->EditValue = FormatNumber($this->GrossPay->EditValue, -2, -2, -2, -2);
		

		// TotalDeductions
		$this->TotalDeductions->EditAttrs["class"] = "form-control";
		$this->TotalDeductions->EditCustomAttributes = "";
		$this->TotalDeductions->EditValue = $this->TotalDeductions->CurrentValue;
		$this->TotalDeductions->PlaceHolder = RemoveHtml($this->TotalDeductions->caption());
		if (strval($this->TotalDeductions->EditValue) != "" && is_numeric($this->TotalDeductions->EditValue))
			$this->TotalDeductions->EditValue = FormatNumber($this->TotalDeductions->EditValue, -2, -2, -2, -2);
		

		// NARRATION
		$this->NARRATION->EditAttrs["class"] = "form-control";
		$this->NARRATION->EditCustomAttributes = "";
		if (!$this->NARRATION->Raw)
			$this->NARRATION->CurrentValue = HtmlDecode($this->NARRATION->CurrentValue);
		$this->NARRATION->EditValue = $this->NARRATION->CurrentValue;
		$this->NARRATION->PlaceHolder = RemoveHtml($this->NARRATION->caption());

		// REF
		$this->REF->EditAttrs["class"] = "form-control";
		$this->REF->EditCustomAttributes = "";
		if (!$this->REF->Raw)
			$this->REF->CurrentValue = HtmlDecode($this->REF->CurrentValue);
		$this->REF->EditValue = $this->REF->CurrentValue;
		$this->REF->PlaceHolder = RemoveHtml($this->REF->caption());

		// AMOUNT
		$this->AMOUNT->EditAttrs["class"] = "form-control";
		$this->AMOUNT->EditCustomAttributes = "";
		$this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
		$this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
		if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue))
			$this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->Middle_Name);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->ORIGINATING_ACCT_NO);
					$doc->exportCaption($this->DEST_SORT_CODE);
					$doc->exportCaption($this->DEST_ACCT_NO);
					$doc->exportCaption($this->GrossPay);
					$doc->exportCaption($this->TotalDeductions);
					$doc->exportCaption($this->NARRATION);
					$doc->exportCaption($this->REF);
					$doc->exportCaption($this->AMOUNT);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->Middle_Name);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->ORIGINATING_ACCT_NO);
					$doc->exportCaption($this->DEST_SORT_CODE);
					$doc->exportCaption($this->DEST_ACCT_NO);
					$doc->exportCaption($this->GrossPay);
					$doc->exportCaption($this->TotalDeductions);
					$doc->exportCaption($this->NARRATION);
					$doc->exportCaption($this->REF);
					$doc->exportCaption($this->AMOUNT);
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
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->Middle_Name);
						$doc->exportField($this->Surname);
						$doc->exportField($this->ORIGINATING_ACCT_NO);
						$doc->exportField($this->DEST_SORT_CODE);
						$doc->exportField($this->DEST_ACCT_NO);
						$doc->exportField($this->GrossPay);
						$doc->exportField($this->TotalDeductions);
						$doc->exportField($this->NARRATION);
						$doc->exportField($this->REF);
						$doc->exportField($this->AMOUNT);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->Middle_Name);
						$doc->exportField($this->Surname);
						$doc->exportField($this->ORIGINATING_ACCT_NO);
						$doc->exportField($this->DEST_SORT_CODE);
						$doc->exportField($this->DEST_ACCT_NO);
						$doc->exportField($this->GrossPay);
						$doc->exportField($this->TotalDeductions);
						$doc->exportField($this->NARRATION);
						$doc->exportField($this->REF);
						$doc->exportField($this->AMOUNT);
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