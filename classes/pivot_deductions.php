<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for pivot_deductions
 */
class pivot_deductions extends DbTable
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
	public $PAYE;
	public $NAPSA;
	public $Advance_Recovery;
	public $Union_Contribution;
	public $Funeral_Scheme;
	public $Loan_recovery;
	public $LASF;
	public $Personal_Levy;
	public $House_Rent;
	public $Fire_Union_Contribution;
	public $OVERPAYMENT_Recovery;
	public $NHIS;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'pivot_deductions';
		$this->TableName = 'pivot_deductions';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`pivot_deductions`";
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
		$this->EmployeeID = new DbField('pivot_deductions', 'pivot_deductions', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// PAYE
		$this->PAYE = new DbField('pivot_deductions', 'pivot_deductions', 'x_PAYE', 'PAYE', '`PAYE`', '`PAYE`', 5, 23, -1, FALSE, '`PAYE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PAYE->Sortable = TRUE; // Allow sort
		$this->PAYE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PAYE'] = &$this->PAYE;

		// NAPSA
		$this->NAPSA = new DbField('pivot_deductions', 'pivot_deductions', 'x_NAPSA', 'NAPSA', '`NAPSA`', '`NAPSA`', 5, 23, -1, FALSE, '`NAPSA`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NAPSA->Sortable = TRUE; // Allow sort
		$this->NAPSA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['NAPSA'] = &$this->NAPSA;

		// Advance Recovery
		$this->Advance_Recovery = new DbField('pivot_deductions', 'pivot_deductions', 'x_Advance_Recovery', 'Advance Recovery', '`Advance Recovery`', '`Advance Recovery`', 5, 23, -1, FALSE, '`Advance Recovery`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Advance_Recovery->Sortable = TRUE; // Allow sort
		$this->Advance_Recovery->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Advance Recovery'] = &$this->Advance_Recovery;

		// Union Contribution
		$this->Union_Contribution = new DbField('pivot_deductions', 'pivot_deductions', 'x_Union_Contribution', 'Union Contribution', '`Union Contribution`', '`Union Contribution`', 5, 23, -1, FALSE, '`Union Contribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Union_Contribution->Sortable = TRUE; // Allow sort
		$this->Union_Contribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Union Contribution'] = &$this->Union_Contribution;

		// Funeral Scheme
		$this->Funeral_Scheme = new DbField('pivot_deductions', 'pivot_deductions', 'x_Funeral_Scheme', 'Funeral Scheme', '`Funeral Scheme`', '`Funeral Scheme`', 5, 23, -1, FALSE, '`Funeral Scheme`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Funeral_Scheme->Sortable = TRUE; // Allow sort
		$this->Funeral_Scheme->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Funeral Scheme'] = &$this->Funeral_Scheme;

		// Loan recovery
		$this->Loan_recovery = new DbField('pivot_deductions', 'pivot_deductions', 'x_Loan_recovery', 'Loan recovery', '`Loan recovery`', '`Loan recovery`', 5, 23, -1, FALSE, '`Loan recovery`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Loan_recovery->Sortable = TRUE; // Allow sort
		$this->Loan_recovery->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Loan recovery'] = &$this->Loan_recovery;

		// LASF
		$this->LASF = new DbField('pivot_deductions', 'pivot_deductions', 'x_LASF', 'LASF', '`LASF`', '`LASF`', 5, 23, -1, FALSE, '`LASF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LASF->Sortable = TRUE; // Allow sort
		$this->LASF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LASF'] = &$this->LASF;

		// Personal Levy
		$this->Personal_Levy = new DbField('pivot_deductions', 'pivot_deductions', 'x_Personal_Levy', 'Personal Levy', '`Personal Levy`', '`Personal Levy`', 5, 23, -1, FALSE, '`Personal Levy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Personal_Levy->Sortable = TRUE; // Allow sort
		$this->Personal_Levy->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Personal Levy'] = &$this->Personal_Levy;

		// House Rent
		$this->House_Rent = new DbField('pivot_deductions', 'pivot_deductions', 'x_House_Rent', 'House Rent', '`House Rent`', '`House Rent`', 5, 23, -1, FALSE, '`House Rent`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->House_Rent->Sortable = TRUE; // Allow sort
		$this->House_Rent->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['House Rent'] = &$this->House_Rent;

		// Fire Union Contribution
		$this->Fire_Union_Contribution = new DbField('pivot_deductions', 'pivot_deductions', 'x_Fire_Union_Contribution', 'Fire Union Contribution', '`Fire Union Contribution`', '`Fire Union Contribution`', 5, 23, -1, FALSE, '`Fire Union Contribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fire_Union_Contribution->Sortable = TRUE; // Allow sort
		$this->Fire_Union_Contribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Fire Union Contribution'] = &$this->Fire_Union_Contribution;

		// OVERPAYMENT Recovery
		$this->OVERPAYMENT_Recovery = new DbField('pivot_deductions', 'pivot_deductions', 'x_OVERPAYMENT_Recovery', 'OVERPAYMENT Recovery', '`OVERPAYMENT Recovery`', '`OVERPAYMENT Recovery`', 5, 23, -1, FALSE, '`OVERPAYMENT Recovery`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OVERPAYMENT_Recovery->Sortable = TRUE; // Allow sort
		$this->OVERPAYMENT_Recovery->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['OVERPAYMENT Recovery'] = &$this->OVERPAYMENT_Recovery;

		// NHIS
		$this->NHIS = new DbField('pivot_deductions', 'pivot_deductions', 'x_NHIS', 'NHIS', '`NHIS`', '`NHIS`', 5, 23, -1, FALSE, '`NHIS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NHIS->Sortable = TRUE; // Allow sort
		$this->NHIS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['NHIS'] = &$this->NHIS;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`pivot_deductions`";
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
		$this->PAYE->DbValue = $row['PAYE'];
		$this->NAPSA->DbValue = $row['NAPSA'];
		$this->Advance_Recovery->DbValue = $row['Advance Recovery'];
		$this->Union_Contribution->DbValue = $row['Union Contribution'];
		$this->Funeral_Scheme->DbValue = $row['Funeral Scheme'];
		$this->Loan_recovery->DbValue = $row['Loan recovery'];
		$this->LASF->DbValue = $row['LASF'];
		$this->Personal_Levy->DbValue = $row['Personal Levy'];
		$this->House_Rent->DbValue = $row['House Rent'];
		$this->Fire_Union_Contribution->DbValue = $row['Fire Union Contribution'];
		$this->OVERPAYMENT_Recovery->DbValue = $row['OVERPAYMENT Recovery'];
		$this->NHIS->DbValue = $row['NHIS'];
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
			return "pivot_deductionslist.php";
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
		if ($pageName == "pivot_deductionsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "pivot_deductionsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "pivot_deductionsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "pivot_deductionslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("pivot_deductionsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("pivot_deductionsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "pivot_deductionsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "pivot_deductionsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("pivot_deductionsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("pivot_deductionsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("pivot_deductionsdelete.php", $this->getUrlParm());
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
		$this->PAYE->setDbValue($rs->fields('PAYE'));
		$this->NAPSA->setDbValue($rs->fields('NAPSA'));
		$this->Advance_Recovery->setDbValue($rs->fields('Advance Recovery'));
		$this->Union_Contribution->setDbValue($rs->fields('Union Contribution'));
		$this->Funeral_Scheme->setDbValue($rs->fields('Funeral Scheme'));
		$this->Loan_recovery->setDbValue($rs->fields('Loan recovery'));
		$this->LASF->setDbValue($rs->fields('LASF'));
		$this->Personal_Levy->setDbValue($rs->fields('Personal Levy'));
		$this->House_Rent->setDbValue($rs->fields('House Rent'));
		$this->Fire_Union_Contribution->setDbValue($rs->fields('Fire Union Contribution'));
		$this->OVERPAYMENT_Recovery->setDbValue($rs->fields('OVERPAYMENT Recovery'));
		$this->NHIS->setDbValue($rs->fields('NHIS'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// PAYE
		// NAPSA
		// Advance Recovery
		// Union Contribution
		// Funeral Scheme
		// Loan recovery
		// LASF
		// Personal Levy
		// House Rent
		// Fire Union Contribution
		// OVERPAYMENT Recovery
		// NHIS
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// PAYE
		$this->PAYE->ViewValue = $this->PAYE->CurrentValue;
		$this->PAYE->ViewValue = FormatNumber($this->PAYE->ViewValue, 2, -2, -2, -2);
		$this->PAYE->ViewCustomAttributes = "";

		// NAPSA
		$this->NAPSA->ViewValue = $this->NAPSA->CurrentValue;
		$this->NAPSA->ViewValue = FormatNumber($this->NAPSA->ViewValue, 2, -2, -2, -2);
		$this->NAPSA->ViewCustomAttributes = "";

		// Advance Recovery
		$this->Advance_Recovery->ViewValue = $this->Advance_Recovery->CurrentValue;
		$this->Advance_Recovery->ViewValue = FormatNumber($this->Advance_Recovery->ViewValue, 2, -2, -2, -2);
		$this->Advance_Recovery->ViewCustomAttributes = "";

		// Union Contribution
		$this->Union_Contribution->ViewValue = $this->Union_Contribution->CurrentValue;
		$this->Union_Contribution->ViewValue = FormatNumber($this->Union_Contribution->ViewValue, 2, -2, -2, -2);
		$this->Union_Contribution->ViewCustomAttributes = "";

		// Funeral Scheme
		$this->Funeral_Scheme->ViewValue = $this->Funeral_Scheme->CurrentValue;
		$this->Funeral_Scheme->ViewValue = FormatNumber($this->Funeral_Scheme->ViewValue, 2, -2, -2, -2);
		$this->Funeral_Scheme->ViewCustomAttributes = "";

		// Loan recovery
		$this->Loan_recovery->ViewValue = $this->Loan_recovery->CurrentValue;
		$this->Loan_recovery->ViewValue = FormatNumber($this->Loan_recovery->ViewValue, 2, -2, -2, -2);
		$this->Loan_recovery->ViewCustomAttributes = "";

		// LASF
		$this->LASF->ViewValue = $this->LASF->CurrentValue;
		$this->LASF->ViewValue = FormatNumber($this->LASF->ViewValue, 2, -2, -2, -2);
		$this->LASF->ViewCustomAttributes = "";

		// Personal Levy
		$this->Personal_Levy->ViewValue = $this->Personal_Levy->CurrentValue;
		$this->Personal_Levy->ViewValue = FormatNumber($this->Personal_Levy->ViewValue, 2, -2, -2, -2);
		$this->Personal_Levy->ViewCustomAttributes = "";

		// House Rent
		$this->House_Rent->ViewValue = $this->House_Rent->CurrentValue;
		$this->House_Rent->ViewValue = FormatNumber($this->House_Rent->ViewValue, 2, -2, -2, -2);
		$this->House_Rent->ViewCustomAttributes = "";

		// Fire Union Contribution
		$this->Fire_Union_Contribution->ViewValue = $this->Fire_Union_Contribution->CurrentValue;
		$this->Fire_Union_Contribution->ViewValue = FormatNumber($this->Fire_Union_Contribution->ViewValue, 2, -2, -2, -2);
		$this->Fire_Union_Contribution->ViewCustomAttributes = "";

		// OVERPAYMENT Recovery
		$this->OVERPAYMENT_Recovery->ViewValue = $this->OVERPAYMENT_Recovery->CurrentValue;
		$this->OVERPAYMENT_Recovery->ViewValue = FormatNumber($this->OVERPAYMENT_Recovery->ViewValue, 2, -2, -2, -2);
		$this->OVERPAYMENT_Recovery->ViewCustomAttributes = "";

		// NHIS
		$this->NHIS->ViewValue = $this->NHIS->CurrentValue;
		$this->NHIS->ViewValue = FormatNumber($this->NHIS->ViewValue, 2, -2, -2, -2);
		$this->NHIS->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// PAYE
		$this->PAYE->LinkCustomAttributes = "";
		$this->PAYE->HrefValue = "";
		$this->PAYE->TooltipValue = "";

		// NAPSA
		$this->NAPSA->LinkCustomAttributes = "";
		$this->NAPSA->HrefValue = "";
		$this->NAPSA->TooltipValue = "";

		// Advance Recovery
		$this->Advance_Recovery->LinkCustomAttributes = "";
		$this->Advance_Recovery->HrefValue = "";
		$this->Advance_Recovery->TooltipValue = "";

		// Union Contribution
		$this->Union_Contribution->LinkCustomAttributes = "";
		$this->Union_Contribution->HrefValue = "";
		$this->Union_Contribution->TooltipValue = "";

		// Funeral Scheme
		$this->Funeral_Scheme->LinkCustomAttributes = "";
		$this->Funeral_Scheme->HrefValue = "";
		$this->Funeral_Scheme->TooltipValue = "";

		// Loan recovery
		$this->Loan_recovery->LinkCustomAttributes = "";
		$this->Loan_recovery->HrefValue = "";
		$this->Loan_recovery->TooltipValue = "";

		// LASF
		$this->LASF->LinkCustomAttributes = "";
		$this->LASF->HrefValue = "";
		$this->LASF->TooltipValue = "";

		// Personal Levy
		$this->Personal_Levy->LinkCustomAttributes = "";
		$this->Personal_Levy->HrefValue = "";
		$this->Personal_Levy->TooltipValue = "";

		// House Rent
		$this->House_Rent->LinkCustomAttributes = "";
		$this->House_Rent->HrefValue = "";
		$this->House_Rent->TooltipValue = "";

		// Fire Union Contribution
		$this->Fire_Union_Contribution->LinkCustomAttributes = "";
		$this->Fire_Union_Contribution->HrefValue = "";
		$this->Fire_Union_Contribution->TooltipValue = "";

		// OVERPAYMENT Recovery
		$this->OVERPAYMENT_Recovery->LinkCustomAttributes = "";
		$this->OVERPAYMENT_Recovery->HrefValue = "";
		$this->OVERPAYMENT_Recovery->TooltipValue = "";

		// NHIS
		$this->NHIS->LinkCustomAttributes = "";
		$this->NHIS->HrefValue = "";
		$this->NHIS->TooltipValue = "";

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

		// PAYE
		$this->PAYE->EditAttrs["class"] = "form-control";
		$this->PAYE->EditCustomAttributes = "";
		$this->PAYE->EditValue = $this->PAYE->CurrentValue;
		$this->PAYE->PlaceHolder = RemoveHtml($this->PAYE->caption());
		if (strval($this->PAYE->EditValue) != "" && is_numeric($this->PAYE->EditValue))
			$this->PAYE->EditValue = FormatNumber($this->PAYE->EditValue, -2, -2, -2, -2);
		

		// NAPSA
		$this->NAPSA->EditAttrs["class"] = "form-control";
		$this->NAPSA->EditCustomAttributes = "";
		$this->NAPSA->EditValue = $this->NAPSA->CurrentValue;
		$this->NAPSA->PlaceHolder = RemoveHtml($this->NAPSA->caption());
		if (strval($this->NAPSA->EditValue) != "" && is_numeric($this->NAPSA->EditValue))
			$this->NAPSA->EditValue = FormatNumber($this->NAPSA->EditValue, -2, -2, -2, -2);
		

		// Advance Recovery
		$this->Advance_Recovery->EditAttrs["class"] = "form-control";
		$this->Advance_Recovery->EditCustomAttributes = "";
		$this->Advance_Recovery->EditValue = $this->Advance_Recovery->CurrentValue;
		$this->Advance_Recovery->PlaceHolder = RemoveHtml($this->Advance_Recovery->caption());
		if (strval($this->Advance_Recovery->EditValue) != "" && is_numeric($this->Advance_Recovery->EditValue))
			$this->Advance_Recovery->EditValue = FormatNumber($this->Advance_Recovery->EditValue, -2, -2, -2, -2);
		

		// Union Contribution
		$this->Union_Contribution->EditAttrs["class"] = "form-control";
		$this->Union_Contribution->EditCustomAttributes = "";
		$this->Union_Contribution->EditValue = $this->Union_Contribution->CurrentValue;
		$this->Union_Contribution->PlaceHolder = RemoveHtml($this->Union_Contribution->caption());
		if (strval($this->Union_Contribution->EditValue) != "" && is_numeric($this->Union_Contribution->EditValue))
			$this->Union_Contribution->EditValue = FormatNumber($this->Union_Contribution->EditValue, -2, -2, -2, -2);
		

		// Funeral Scheme
		$this->Funeral_Scheme->EditAttrs["class"] = "form-control";
		$this->Funeral_Scheme->EditCustomAttributes = "";
		$this->Funeral_Scheme->EditValue = $this->Funeral_Scheme->CurrentValue;
		$this->Funeral_Scheme->PlaceHolder = RemoveHtml($this->Funeral_Scheme->caption());
		if (strval($this->Funeral_Scheme->EditValue) != "" && is_numeric($this->Funeral_Scheme->EditValue))
			$this->Funeral_Scheme->EditValue = FormatNumber($this->Funeral_Scheme->EditValue, -2, -2, -2, -2);
		

		// Loan recovery
		$this->Loan_recovery->EditAttrs["class"] = "form-control";
		$this->Loan_recovery->EditCustomAttributes = "";
		$this->Loan_recovery->EditValue = $this->Loan_recovery->CurrentValue;
		$this->Loan_recovery->PlaceHolder = RemoveHtml($this->Loan_recovery->caption());
		if (strval($this->Loan_recovery->EditValue) != "" && is_numeric($this->Loan_recovery->EditValue))
			$this->Loan_recovery->EditValue = FormatNumber($this->Loan_recovery->EditValue, -2, -2, -2, -2);
		

		// LASF
		$this->LASF->EditAttrs["class"] = "form-control";
		$this->LASF->EditCustomAttributes = "";
		$this->LASF->EditValue = $this->LASF->CurrentValue;
		$this->LASF->PlaceHolder = RemoveHtml($this->LASF->caption());
		if (strval($this->LASF->EditValue) != "" && is_numeric($this->LASF->EditValue))
			$this->LASF->EditValue = FormatNumber($this->LASF->EditValue, -2, -2, -2, -2);
		

		// Personal Levy
		$this->Personal_Levy->EditAttrs["class"] = "form-control";
		$this->Personal_Levy->EditCustomAttributes = "";
		$this->Personal_Levy->EditValue = $this->Personal_Levy->CurrentValue;
		$this->Personal_Levy->PlaceHolder = RemoveHtml($this->Personal_Levy->caption());
		if (strval($this->Personal_Levy->EditValue) != "" && is_numeric($this->Personal_Levy->EditValue))
			$this->Personal_Levy->EditValue = FormatNumber($this->Personal_Levy->EditValue, -2, -2, -2, -2);
		

		// House Rent
		$this->House_Rent->EditAttrs["class"] = "form-control";
		$this->House_Rent->EditCustomAttributes = "";
		$this->House_Rent->EditValue = $this->House_Rent->CurrentValue;
		$this->House_Rent->PlaceHolder = RemoveHtml($this->House_Rent->caption());
		if (strval($this->House_Rent->EditValue) != "" && is_numeric($this->House_Rent->EditValue))
			$this->House_Rent->EditValue = FormatNumber($this->House_Rent->EditValue, -2, -2, -2, -2);
		

		// Fire Union Contribution
		$this->Fire_Union_Contribution->EditAttrs["class"] = "form-control";
		$this->Fire_Union_Contribution->EditCustomAttributes = "";
		$this->Fire_Union_Contribution->EditValue = $this->Fire_Union_Contribution->CurrentValue;
		$this->Fire_Union_Contribution->PlaceHolder = RemoveHtml($this->Fire_Union_Contribution->caption());
		if (strval($this->Fire_Union_Contribution->EditValue) != "" && is_numeric($this->Fire_Union_Contribution->EditValue))
			$this->Fire_Union_Contribution->EditValue = FormatNumber($this->Fire_Union_Contribution->EditValue, -2, -2, -2, -2);
		

		// OVERPAYMENT Recovery
		$this->OVERPAYMENT_Recovery->EditAttrs["class"] = "form-control";
		$this->OVERPAYMENT_Recovery->EditCustomAttributes = "";
		$this->OVERPAYMENT_Recovery->EditValue = $this->OVERPAYMENT_Recovery->CurrentValue;
		$this->OVERPAYMENT_Recovery->PlaceHolder = RemoveHtml($this->OVERPAYMENT_Recovery->caption());
		if (strval($this->OVERPAYMENT_Recovery->EditValue) != "" && is_numeric($this->OVERPAYMENT_Recovery->EditValue))
			$this->OVERPAYMENT_Recovery->EditValue = FormatNumber($this->OVERPAYMENT_Recovery->EditValue, -2, -2, -2, -2);
		

		// NHIS
		$this->NHIS->EditAttrs["class"] = "form-control";
		$this->NHIS->EditCustomAttributes = "";
		$this->NHIS->EditValue = $this->NHIS->CurrentValue;
		$this->NHIS->PlaceHolder = RemoveHtml($this->NHIS->caption());
		if (strval($this->NHIS->EditValue) != "" && is_numeric($this->NHIS->EditValue))
			$this->NHIS->EditValue = FormatNumber($this->NHIS->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->PAYE);
					$doc->exportCaption($this->NAPSA);
					$doc->exportCaption($this->Advance_Recovery);
					$doc->exportCaption($this->Union_Contribution);
					$doc->exportCaption($this->Funeral_Scheme);
					$doc->exportCaption($this->Loan_recovery);
					$doc->exportCaption($this->LASF);
					$doc->exportCaption($this->Personal_Levy);
					$doc->exportCaption($this->House_Rent);
					$doc->exportCaption($this->Fire_Union_Contribution);
					$doc->exportCaption($this->OVERPAYMENT_Recovery);
					$doc->exportCaption($this->NHIS);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->PAYE);
					$doc->exportCaption($this->NAPSA);
					$doc->exportCaption($this->Advance_Recovery);
					$doc->exportCaption($this->Union_Contribution);
					$doc->exportCaption($this->Funeral_Scheme);
					$doc->exportCaption($this->Loan_recovery);
					$doc->exportCaption($this->LASF);
					$doc->exportCaption($this->Personal_Levy);
					$doc->exportCaption($this->House_Rent);
					$doc->exportCaption($this->Fire_Union_Contribution);
					$doc->exportCaption($this->OVERPAYMENT_Recovery);
					$doc->exportCaption($this->NHIS);
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
						$doc->exportField($this->PAYE);
						$doc->exportField($this->NAPSA);
						$doc->exportField($this->Advance_Recovery);
						$doc->exportField($this->Union_Contribution);
						$doc->exportField($this->Funeral_Scheme);
						$doc->exportField($this->Loan_recovery);
						$doc->exportField($this->LASF);
						$doc->exportField($this->Personal_Levy);
						$doc->exportField($this->House_Rent);
						$doc->exportField($this->Fire_Union_Contribution);
						$doc->exportField($this->OVERPAYMENT_Recovery);
						$doc->exportField($this->NHIS);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->PAYE);
						$doc->exportField($this->NAPSA);
						$doc->exportField($this->Advance_Recovery);
						$doc->exportField($this->Union_Contribution);
						$doc->exportField($this->Funeral_Scheme);
						$doc->exportField($this->Loan_recovery);
						$doc->exportField($this->LASF);
						$doc->exportField($this->Personal_Levy);
						$doc->exportField($this->House_Rent);
						$doc->exportField($this->Fire_Union_Contribution);
						$doc->exportField($this->OVERPAYMENT_Recovery);
						$doc->exportField($this->NHIS);
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