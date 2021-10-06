<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for nhis
 */
class nhis extends DbTable
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
	public $Emp_No_;
	public $Title;
	public $First_Name;
	public $Last_Name;
	public $Sex;
	public $NRC_No_;
	public $PayrollPeriod;
	public $DeductionName;
	public $Basic_Pay_This_Month;
	public $Employee_Contribution;
	public $Employer_Contribution;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'nhis';
		$this->TableName = 'nhis';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`nhis`";
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

		// Emp No.
		$this->Emp_No_ = new DbField('nhis', 'nhis', 'x_Emp_No_', 'Emp No.', '`Emp No.`', '`Emp No.`', 3, 11, -1, FALSE, '`Emp No.`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Emp_No_->Nullable = FALSE; // NOT NULL field
		$this->Emp_No_->Required = TRUE; // Required field
		$this->Emp_No_->Sortable = TRUE; // Allow sort
		$this->Emp_No_->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Emp No.'] = &$this->Emp_No_;

		// Title
		$this->Title = new DbField('nhis', 'nhis', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->fields['Title'] = &$this->Title;

		// First Name
		$this->First_Name = new DbField('nhis', 'nhis', 'x_First_Name', 'First Name', '`First Name`', '`First Name`', 200, 100, -1, FALSE, '`First Name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->First_Name->Nullable = FALSE; // NOT NULL field
		$this->First_Name->Required = TRUE; // Required field
		$this->First_Name->Sortable = TRUE; // Allow sort
		$this->fields['First Name'] = &$this->First_Name;

		// Last Name
		$this->Last_Name = new DbField('nhis', 'nhis', 'x_Last_Name', 'Last Name', '`Last Name`', '`Last Name`', 200, 100, -1, FALSE, '`Last Name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Last_Name->Nullable = FALSE; // NOT NULL field
		$this->Last_Name->Required = TRUE; // Required field
		$this->Last_Name->Sortable = TRUE; // Allow sort
		$this->fields['Last Name'] = &$this->Last_Name;

		// Sex
		$this->Sex = new DbField('nhis', 'nhis', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->fields['Sex'] = &$this->Sex;

		// NRC No.
		$this->NRC_No_ = new DbField('nhis', 'nhis', 'x_NRC_No_', 'NRC No.', '`NRC No.`', '`NRC No.`', 200, 13, -1, FALSE, '`NRC No.`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC_No_->Nullable = FALSE; // NOT NULL field
		$this->NRC_No_->Required = TRUE; // Required field
		$this->NRC_No_->Sortable = TRUE; // Allow sort
		$this->fields['NRC No.'] = &$this->NRC_No_;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('nhis', 'nhis', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// DeductionName
		$this->DeductionName = new DbField('nhis', 'nhis', 'x_DeductionName', 'DeductionName', '`DeductionName`', '`DeductionName`', 200, 255, -1, FALSE, '`DeductionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionName->Nullable = FALSE; // NOT NULL field
		$this->DeductionName->Required = TRUE; // Required field
		$this->DeductionName->Sortable = TRUE; // Allow sort
		$this->fields['DeductionName'] = &$this->DeductionName;

		// Basic Pay This Month
		$this->Basic_Pay_This_Month = new DbField('nhis', 'nhis', 'x_Basic_Pay_This_Month', 'Basic Pay This Month', '`Basic Pay This Month`', '`Basic Pay This Month`', 5, 22, -1, FALSE, '`Basic Pay This Month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Basic_Pay_This_Month->Nullable = FALSE; // NOT NULL field
		$this->Basic_Pay_This_Month->Required = TRUE; // Required field
		$this->Basic_Pay_This_Month->Sortable = TRUE; // Allow sort
		$this->Basic_Pay_This_Month->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Basic Pay This Month'] = &$this->Basic_Pay_This_Month;

		// Employee Contribution
		$this->Employee_Contribution = new DbField('nhis', 'nhis', 'x_Employee_Contribution', 'Employee Contribution', '`Employee Contribution`', '`Employee Contribution`', 5, 22, -1, FALSE, '`Employee Contribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Employee_Contribution->Nullable = FALSE; // NOT NULL field
		$this->Employee_Contribution->Sortable = TRUE; // Allow sort
		$this->Employee_Contribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Employee Contribution'] = &$this->Employee_Contribution;

		// Employer Contribution
		$this->Employer_Contribution = new DbField('nhis', 'nhis', 'x_Employer_Contribution', 'Employer Contribution', '`Employer Contribution`', '`Employer Contribution`', 5, 22, -1, FALSE, '`Employer Contribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Employer_Contribution->Nullable = FALSE; // NOT NULL field
		$this->Employer_Contribution->Sortable = TRUE; // Allow sort
		$this->Employer_Contribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Employer Contribution'] = &$this->Employer_Contribution;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`nhis`";
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
		$this->Emp_No_->DbValue = $row['Emp No.'];
		$this->Title->DbValue = $row['Title'];
		$this->First_Name->DbValue = $row['First Name'];
		$this->Last_Name->DbValue = $row['Last Name'];
		$this->Sex->DbValue = $row['Sex'];
		$this->NRC_No_->DbValue = $row['NRC No.'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->DeductionName->DbValue = $row['DeductionName'];
		$this->Basic_Pay_This_Month->DbValue = $row['Basic Pay This Month'];
		$this->Employee_Contribution->DbValue = $row['Employee Contribution'];
		$this->Employer_Contribution->DbValue = $row['Employer Contribution'];
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
			return "nhislist.php";
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
		if ($pageName == "nhisview.php")
			return $Language->phrase("View");
		elseif ($pageName == "nhisedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "nhisadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "nhislist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("nhisview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("nhisview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "nhisadd.php?" . $this->getUrlParm($parm);
		else
			$url = "nhisadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("nhisedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("nhisadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("nhisdelete.php", $this->getUrlParm());
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
		$this->Emp_No_->setDbValue($rs->fields('Emp No.'));
		$this->Title->setDbValue($rs->fields('Title'));
		$this->First_Name->setDbValue($rs->fields('First Name'));
		$this->Last_Name->setDbValue($rs->fields('Last Name'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->NRC_No_->setDbValue($rs->fields('NRC No.'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->DeductionName->setDbValue($rs->fields('DeductionName'));
		$this->Basic_Pay_This_Month->setDbValue($rs->fields('Basic Pay This Month'));
		$this->Employee_Contribution->setDbValue($rs->fields('Employee Contribution'));
		$this->Employer_Contribution->setDbValue($rs->fields('Employer Contribution'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Emp No.
		// Title
		// First Name
		// Last Name
		// Sex
		// NRC No.
		// PayrollPeriod
		// DeductionName
		// Basic Pay This Month
		// Employee Contribution
		// Employer Contribution
		// Emp No.

		$this->Emp_No_->ViewValue = $this->Emp_No_->CurrentValue;
		$this->Emp_No_->ViewValue = FormatNumber($this->Emp_No_->ViewValue, 0, -2, -2, -2);
		$this->Emp_No_->ViewCustomAttributes = "";

		// Title
		$this->Title->ViewValue = $this->Title->CurrentValue;
		$this->Title->ViewCustomAttributes = "";

		// First Name
		$this->First_Name->ViewValue = $this->First_Name->CurrentValue;
		$this->First_Name->ViewCustomAttributes = "";

		// Last Name
		$this->Last_Name->ViewValue = $this->Last_Name->CurrentValue;
		$this->Last_Name->ViewCustomAttributes = "";

		// Sex
		$this->Sex->ViewValue = $this->Sex->CurrentValue;
		$this->Sex->ViewCustomAttributes = "";

		// NRC No.
		$this->NRC_No_->ViewValue = $this->NRC_No_->CurrentValue;
		$this->NRC_No_->ViewCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->ViewValue = FormatNumber($this->PayrollPeriod->ViewValue, 0, -2, -2, -2);
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// DeductionName
		$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->ViewCustomAttributes = "";

		// Basic Pay This Month
		$this->Basic_Pay_This_Month->ViewValue = $this->Basic_Pay_This_Month->CurrentValue;
		$this->Basic_Pay_This_Month->ViewValue = FormatNumber($this->Basic_Pay_This_Month->ViewValue, 2, -2, -2, -2);
		$this->Basic_Pay_This_Month->ViewCustomAttributes = "";

		// Employee Contribution
		$this->Employee_Contribution->ViewValue = $this->Employee_Contribution->CurrentValue;
		$this->Employee_Contribution->ViewValue = FormatNumber($this->Employee_Contribution->ViewValue, 2, -2, -2, -2);
		$this->Employee_Contribution->ViewCustomAttributes = "";

		// Employer Contribution
		$this->Employer_Contribution->ViewValue = $this->Employer_Contribution->CurrentValue;
		$this->Employer_Contribution->ViewValue = FormatNumber($this->Employer_Contribution->ViewValue, 2, -2, -2, -2);
		$this->Employer_Contribution->ViewCustomAttributes = "";

		// Emp No.
		$this->Emp_No_->LinkCustomAttributes = "";
		$this->Emp_No_->HrefValue = "";
		$this->Emp_No_->TooltipValue = "";

		// Title
		$this->Title->LinkCustomAttributes = "";
		$this->Title->HrefValue = "";
		$this->Title->TooltipValue = "";

		// First Name
		$this->First_Name->LinkCustomAttributes = "";
		$this->First_Name->HrefValue = "";
		$this->First_Name->TooltipValue = "";

		// Last Name
		$this->Last_Name->LinkCustomAttributes = "";
		$this->Last_Name->HrefValue = "";
		$this->Last_Name->TooltipValue = "";

		// Sex
		$this->Sex->LinkCustomAttributes = "";
		$this->Sex->HrefValue = "";
		$this->Sex->TooltipValue = "";

		// NRC No.
		$this->NRC_No_->LinkCustomAttributes = "";
		$this->NRC_No_->HrefValue = "";
		$this->NRC_No_->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// DeductionName
		$this->DeductionName->LinkCustomAttributes = "";
		$this->DeductionName->HrefValue = "";
		$this->DeductionName->TooltipValue = "";

		// Basic Pay This Month
		$this->Basic_Pay_This_Month->LinkCustomAttributes = "";
		$this->Basic_Pay_This_Month->HrefValue = "";
		$this->Basic_Pay_This_Month->TooltipValue = "";

		// Employee Contribution
		$this->Employee_Contribution->LinkCustomAttributes = "";
		$this->Employee_Contribution->HrefValue = "";
		$this->Employee_Contribution->TooltipValue = "";

		// Employer Contribution
		$this->Employer_Contribution->LinkCustomAttributes = "";
		$this->Employer_Contribution->HrefValue = "";
		$this->Employer_Contribution->TooltipValue = "";

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

		// Emp No.
		$this->Emp_No_->EditAttrs["class"] = "form-control";
		$this->Emp_No_->EditCustomAttributes = "";
		$this->Emp_No_->EditValue = $this->Emp_No_->CurrentValue;
		$this->Emp_No_->PlaceHolder = RemoveHtml($this->Emp_No_->caption());

		// Title
		$this->Title->EditAttrs["class"] = "form-control";
		$this->Title->EditCustomAttributes = "";
		if (!$this->Title->Raw)
			$this->Title->CurrentValue = HtmlDecode($this->Title->CurrentValue);
		$this->Title->EditValue = $this->Title->CurrentValue;
		$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

		// First Name
		$this->First_Name->EditAttrs["class"] = "form-control";
		$this->First_Name->EditCustomAttributes = "";
		if (!$this->First_Name->Raw)
			$this->First_Name->CurrentValue = HtmlDecode($this->First_Name->CurrentValue);
		$this->First_Name->EditValue = $this->First_Name->CurrentValue;
		$this->First_Name->PlaceHolder = RemoveHtml($this->First_Name->caption());

		// Last Name
		$this->Last_Name->EditAttrs["class"] = "form-control";
		$this->Last_Name->EditCustomAttributes = "";
		if (!$this->Last_Name->Raw)
			$this->Last_Name->CurrentValue = HtmlDecode($this->Last_Name->CurrentValue);
		$this->Last_Name->EditValue = $this->Last_Name->CurrentValue;
		$this->Last_Name->PlaceHolder = RemoveHtml($this->Last_Name->caption());

		// Sex
		$this->Sex->EditAttrs["class"] = "form-control";
		$this->Sex->EditCustomAttributes = "";
		if (!$this->Sex->Raw)
			$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
		$this->Sex->EditValue = $this->Sex->CurrentValue;
		$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

		// NRC No.
		$this->NRC_No_->EditAttrs["class"] = "form-control";
		$this->NRC_No_->EditCustomAttributes = "";
		if (!$this->NRC_No_->Raw)
			$this->NRC_No_->CurrentValue = HtmlDecode($this->NRC_No_->CurrentValue);
		$this->NRC_No_->EditValue = $this->NRC_No_->CurrentValue;
		$this->NRC_No_->PlaceHolder = RemoveHtml($this->NRC_No_->caption());

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";
		$this->PayrollPeriod->EditValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->PlaceHolder = RemoveHtml($this->PayrollPeriod->caption());

		// DeductionName
		$this->DeductionName->EditAttrs["class"] = "form-control";
		$this->DeductionName->EditCustomAttributes = "";
		if (!$this->DeductionName->Raw)
			$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
		$this->DeductionName->EditValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

		// Basic Pay This Month
		$this->Basic_Pay_This_Month->EditAttrs["class"] = "form-control";
		$this->Basic_Pay_This_Month->EditCustomAttributes = "";
		$this->Basic_Pay_This_Month->EditValue = $this->Basic_Pay_This_Month->CurrentValue;
		$this->Basic_Pay_This_Month->PlaceHolder = RemoveHtml($this->Basic_Pay_This_Month->caption());
		if (strval($this->Basic_Pay_This_Month->EditValue) != "" && is_numeric($this->Basic_Pay_This_Month->EditValue))
			$this->Basic_Pay_This_Month->EditValue = FormatNumber($this->Basic_Pay_This_Month->EditValue, -2, -2, -2, -2);
		

		// Employee Contribution
		$this->Employee_Contribution->EditAttrs["class"] = "form-control";
		$this->Employee_Contribution->EditCustomAttributes = "";
		$this->Employee_Contribution->EditValue = $this->Employee_Contribution->CurrentValue;
		$this->Employee_Contribution->PlaceHolder = RemoveHtml($this->Employee_Contribution->caption());
		if (strval($this->Employee_Contribution->EditValue) != "" && is_numeric($this->Employee_Contribution->EditValue))
			$this->Employee_Contribution->EditValue = FormatNumber($this->Employee_Contribution->EditValue, -2, -2, -2, -2);
		

		// Employer Contribution
		$this->Employer_Contribution->EditAttrs["class"] = "form-control";
		$this->Employer_Contribution->EditCustomAttributes = "";
		$this->Employer_Contribution->EditValue = $this->Employer_Contribution->CurrentValue;
		$this->Employer_Contribution->PlaceHolder = RemoveHtml($this->Employer_Contribution->caption());
		if (strval($this->Employer_Contribution->EditValue) != "" && is_numeric($this->Employer_Contribution->EditValue))
			$this->Employer_Contribution->EditValue = FormatNumber($this->Employer_Contribution->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->Emp_No_);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->First_Name);
					$doc->exportCaption($this->Last_Name);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->NRC_No_);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->Basic_Pay_This_Month);
					$doc->exportCaption($this->Employee_Contribution);
					$doc->exportCaption($this->Employer_Contribution);
				} else {
					$doc->exportCaption($this->Emp_No_);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->First_Name);
					$doc->exportCaption($this->Last_Name);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->NRC_No_);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->Basic_Pay_This_Month);
					$doc->exportCaption($this->Employee_Contribution);
					$doc->exportCaption($this->Employer_Contribution);
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
						$doc->exportField($this->Emp_No_);
						$doc->exportField($this->Title);
						$doc->exportField($this->First_Name);
						$doc->exportField($this->Last_Name);
						$doc->exportField($this->Sex);
						$doc->exportField($this->NRC_No_);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->Basic_Pay_This_Month);
						$doc->exportField($this->Employee_Contribution);
						$doc->exportField($this->Employer_Contribution);
					} else {
						$doc->exportField($this->Emp_No_);
						$doc->exportField($this->Title);
						$doc->exportField($this->First_Name);
						$doc->exportField($this->Last_Name);
						$doc->exportField($this->Sex);
						$doc->exportField($this->NRC_No_);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->Basic_Pay_This_Month);
						$doc->exportField($this->Employee_Contribution);
						$doc->exportField($this->Employer_Contribution);
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