<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for income_type
 */
class income_type extends DbTable
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
	public $IncomeCode;
	public $IncomeName;
	public $IncomeDescription;
	public $Division;
	public $IncomeAmount;
	public $IncomeBasicRate;
	public $BaseIncomeCode;
	public $Taxable;
	public $AccountNo;
	public $JobIncluded;
	public $Application;
	public $JobExcluded;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'income_type';
		$this->TableName = 'income_type';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`income_type`";
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

		// IncomeCode
		$this->IncomeCode = new DbField('income_type', 'income_type', 'x_IncomeCode', 'IncomeCode', '`IncomeCode`', '`IncomeCode`', 3, 11, -1, FALSE, '`IncomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->IncomeCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->IncomeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->IncomeCode->Sortable = TRUE; // Allow sort
		$this->fields['IncomeCode'] = &$this->IncomeCode;

		// IncomeName
		$this->IncomeName = new DbField('income_type', 'income_type', 'x_IncomeName', 'IncomeName', '`IncomeName`', '`IncomeName`', 200, 255, -1, FALSE, '`IncomeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncomeName->Nullable = FALSE; // NOT NULL field
		$this->IncomeName->Required = TRUE; // Required field
		$this->IncomeName->Sortable = TRUE; // Allow sort
		$this->fields['IncomeName'] = &$this->IncomeName;

		// IncomeDescription
		$this->IncomeDescription = new DbField('income_type', 'income_type', 'x_IncomeDescription', 'IncomeDescription', '`IncomeDescription`', '`IncomeDescription`', 200, 255, -1, FALSE, '`IncomeDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncomeDescription->Sortable = TRUE; // Allow sort
		$this->fields['IncomeDescription'] = &$this->IncomeDescription;

		// Division
		$this->Division = new DbField('income_type', 'income_type', 'x_Division', 'Division', '`Division`', '`Division`', 200, 100, -1, FALSE, '`Division`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Division->Sortable = TRUE; // Allow sort
		$this->Division->Lookup = new Lookup('Division', 'division', FALSE, 'Division', ["Division","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Division'] = &$this->Division;

		// IncomeAmount
		$this->IncomeAmount = new DbField('income_type', 'income_type', 'x_IncomeAmount', 'IncomeAmount', '`IncomeAmount`', '`IncomeAmount`', 5, 22, -1, FALSE, '`IncomeAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncomeAmount->Sortable = TRUE; // Allow sort
		$this->IncomeAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['IncomeAmount'] = &$this->IncomeAmount;

		// IncomeBasicRate
		$this->IncomeBasicRate = new DbField('income_type', 'income_type', 'x_IncomeBasicRate', 'IncomeBasicRate', '`IncomeBasicRate`', '`IncomeBasicRate`', 5, 22, -1, FALSE, '`IncomeBasicRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IncomeBasicRate->Sortable = TRUE; // Allow sort
		$this->IncomeBasicRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['IncomeBasicRate'] = &$this->IncomeBasicRate;

		// BaseIncomeCode
		$this->BaseIncomeCode = new DbField('income_type', 'income_type', 'x_BaseIncomeCode', 'BaseIncomeCode', '`BaseIncomeCode`', '`BaseIncomeCode`', 200, 15, -1, FALSE, '`BaseIncomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BaseIncomeCode->Sortable = TRUE; // Allow sort
		$this->BaseIncomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BaseIncomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BaseIncomeCode->Lookup = new Lookup('BaseIncomeCode', 'income_type', FALSE, 'IncomeCode', ["IncomeName","IncomeCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['BaseIncomeCode'] = &$this->BaseIncomeCode;

		// Taxable
		$this->Taxable = new DbField('income_type', 'income_type', 'x_Taxable', 'Taxable', '`Taxable`', '`Taxable`', 16, 1, -1, FALSE, '`Taxable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Taxable->Nullable = FALSE; // NOT NULL field
		$this->Taxable->Sortable = TRUE; // Allow sort
		$this->Taxable->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Taxable->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Taxable->Lookup = new Lookup('Taxable', 'yesno', FALSE, 'ChoiceCode', ["YesNo","","",""], [], [], [], [], [], [], '', '');
		$this->Taxable->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Taxable'] = &$this->Taxable;

		// AccountNo
		$this->AccountNo = new DbField('income_type', 'income_type', 'x_AccountNo', 'AccountNo', '`AccountNo`', '`AccountNo`', 200, 25, -1, FALSE, '`AccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AccountNo->Sortable = TRUE; // Allow sort
		$this->AccountNo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AccountNo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AccountNo->Lookup = new Lookup('AccountNo', 'account_ref', FALSE, 'AccountCode', ["AccountName","AccountCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['AccountNo'] = &$this->AccountNo;

		// JobIncluded
		$this->JobIncluded = new DbField('income_type', 'income_type', 'x_JobIncluded', 'JobIncluded', '`JobIncluded`', '`JobIncluded`', 200, 255, -1, FALSE, '`JobIncluded`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->JobIncluded->Sortable = TRUE; // Allow sort
		$this->JobIncluded->Lookup = new Lookup('JobIncluded', 'job', FALSE, 'JobCode', ["JobName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['JobIncluded'] = &$this->JobIncluded;

		// Application
		$this->Application = new DbField('income_type', 'income_type', 'x_Application', 'Application', '`Application`', '`Application`', 16, 3, -1, FALSE, '`Application`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Application->Sortable = TRUE; // Allow sort
		$this->Application->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Application->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Application->Lookup = new Lookup('Application', 'means_of_application', FALSE, 'ChoiceCode', ["Application","","",""], [], [], [], [], [], [], '', '');
		$this->Application->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Application'] = &$this->Application;

		// JobExcluded
		$this->JobExcluded = new DbField('income_type', 'income_type', 'x_JobExcluded', 'JobExcluded', '`JobExcluded`', '`JobExcluded`', 200, 255, -1, FALSE, '`JobExcluded`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->JobExcluded->Sortable = TRUE; // Allow sort
		$this->JobExcluded->Lookup = new Lookup('JobExcluded', 'job', FALSE, 'JobCode', ["JobName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['JobExcluded'] = &$this->JobExcluded;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`income_type`";
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
			$this->IncomeCode->setDbValue($conn->insert_ID());
			$rs['IncomeCode'] = $this->IncomeCode->DbValue;
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
			if (array_key_exists('IncomeCode', $rs))
				AddFilter($where, QuotedName('IncomeCode', $this->Dbid) . '=' . QuotedValue($rs['IncomeCode'], $this->IncomeCode->DataType, $this->Dbid));
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
		$this->IncomeCode->DbValue = $row['IncomeCode'];
		$this->IncomeName->DbValue = $row['IncomeName'];
		$this->IncomeDescription->DbValue = $row['IncomeDescription'];
		$this->Division->DbValue = $row['Division'];
		$this->IncomeAmount->DbValue = $row['IncomeAmount'];
		$this->IncomeBasicRate->DbValue = $row['IncomeBasicRate'];
		$this->BaseIncomeCode->DbValue = $row['BaseIncomeCode'];
		$this->Taxable->DbValue = $row['Taxable'];
		$this->AccountNo->DbValue = $row['AccountNo'];
		$this->JobIncluded->DbValue = $row['JobIncluded'];
		$this->Application->DbValue = $row['Application'];
		$this->JobExcluded->DbValue = $row['JobExcluded'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`IncomeCode` = @IncomeCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('IncomeCode', $row) ? $row['IncomeCode'] : NULL;
		else
			$val = $this->IncomeCode->OldValue !== NULL ? $this->IncomeCode->OldValue : $this->IncomeCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@IncomeCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "income_typelist.php";
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
		if ($pageName == "income_typeview.php")
			return $Language->phrase("View");
		elseif ($pageName == "income_typeedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "income_typeadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "income_typelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("income_typeview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("income_typeview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "income_typeadd.php?" . $this->getUrlParm($parm);
		else
			$url = "income_typeadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("income_typeedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("income_typeadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("income_typedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "IncomeCode:" . JsonEncode($this->IncomeCode->CurrentValue, "number");
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
		if ($this->IncomeCode->CurrentValue != NULL) {
			$url .= "IncomeCode=" . urlencode($this->IncomeCode->CurrentValue);
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
			if (Param("IncomeCode") !== NULL)
				$arKeys[] = Param("IncomeCode");
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
				$this->IncomeCode->CurrentValue = $key;
			else
				$this->IncomeCode->OldValue = $key;
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
		$this->IncomeCode->setDbValue($rs->fields('IncomeCode'));
		$this->IncomeName->setDbValue($rs->fields('IncomeName'));
		$this->IncomeDescription->setDbValue($rs->fields('IncomeDescription'));
		$this->Division->setDbValue($rs->fields('Division'));
		$this->IncomeAmount->setDbValue($rs->fields('IncomeAmount'));
		$this->IncomeBasicRate->setDbValue($rs->fields('IncomeBasicRate'));
		$this->BaseIncomeCode->setDbValue($rs->fields('BaseIncomeCode'));
		$this->Taxable->setDbValue($rs->fields('Taxable'));
		$this->AccountNo->setDbValue($rs->fields('AccountNo'));
		$this->JobIncluded->setDbValue($rs->fields('JobIncluded'));
		$this->Application->setDbValue($rs->fields('Application'));
		$this->JobExcluded->setDbValue($rs->fields('JobExcluded'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// IncomeCode
		// IncomeName
		// IncomeDescription
		// Division
		// IncomeAmount
		// IncomeBasicRate
		// BaseIncomeCode
		// Taxable
		// AccountNo
		// JobIncluded
		// Application
		// JobExcluded
		// IncomeCode

		$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
		$this->IncomeCode->ViewCustomAttributes = "";

		// IncomeName
		$this->IncomeName->ViewValue = $this->IncomeName->CurrentValue;
		$this->IncomeName->ViewCustomAttributes = "";

		// IncomeDescription
		$this->IncomeDescription->ViewValue = $this->IncomeDescription->CurrentValue;
		$this->IncomeDescription->ViewCustomAttributes = "";

		// Division
		$curVal = strval($this->Division->CurrentValue);
		if ($curVal != "") {
			$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			if ($this->Division->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Division->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Division->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Division->ViewValue->add($this->Division->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->Division->ViewValue = $this->Division->CurrentValue;
				}
			}
		} else {
			$this->Division->ViewValue = NULL;
		}
		$this->Division->ViewCustomAttributes = "";

		// IncomeAmount
		$this->IncomeAmount->ViewValue = $this->IncomeAmount->CurrentValue;
		$this->IncomeAmount->ViewValue = FormatNumber($this->IncomeAmount->ViewValue, 2, -2, -2, -2);
		$this->IncomeAmount->ViewCustomAttributes = "";

		// IncomeBasicRate
		$this->IncomeBasicRate->ViewValue = $this->IncomeBasicRate->CurrentValue;
		$this->IncomeBasicRate->ViewValue = FormatNumber($this->IncomeBasicRate->ViewValue, 2, -2, -2, -2);
		$this->IncomeBasicRate->ViewCustomAttributes = "";

		// BaseIncomeCode
		$curVal = strval($this->BaseIncomeCode->CurrentValue);
		if ($curVal != "") {
			$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			if ($this->BaseIncomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->CurrentValue;
				}
			}
		} else {
			$this->BaseIncomeCode->ViewValue = NULL;
		}
		$this->BaseIncomeCode->ViewCustomAttributes = "";

		// Taxable
		$curVal = strval($this->Taxable->CurrentValue);
		if ($curVal != "") {
			$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
			if ($this->Taxable->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Taxable->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Taxable->ViewValue = $this->Taxable->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Taxable->ViewValue = $this->Taxable->CurrentValue;
				}
			}
		} else {
			$this->Taxable->ViewValue = NULL;
		}
		$this->Taxable->ViewCustomAttributes = "";

		// AccountNo
		$curVal = strval($this->AccountNo->CurrentValue);
		if ($curVal != "") {
			$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			if ($this->AccountNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->AccountNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
				}
			}
		} else {
			$this->AccountNo->ViewValue = NULL;
		}
		$this->AccountNo->ViewCustomAttributes = "";

		// JobIncluded
		$curVal = strval($this->JobIncluded->CurrentValue);
		if ($curVal != "") {
			$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
			if ($this->JobIncluded->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->JobIncluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobIncluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->JobIncluded->ViewValue = $this->JobIncluded->CurrentValue;
				}
			}
		} else {
			$this->JobIncluded->ViewValue = NULL;
		}
		$this->JobIncluded->ViewCustomAttributes = "";

		// Application
		$curVal = strval($this->Application->CurrentValue);
		if ($curVal != "") {
			$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			if ($this->Application->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Application->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Application->ViewValue = $this->Application->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Application->ViewValue = $this->Application->CurrentValue;
				}
			}
		} else {
			$this->Application->ViewValue = NULL;
		}
		$this->Application->ViewCustomAttributes = "";

		// JobExcluded
		$curVal = strval($this->JobExcluded->CurrentValue);
		if ($curVal != "") {
			$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
			if ($this->JobExcluded->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->JobExcluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobExcluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->JobExcluded->ViewValue = $this->JobExcluded->CurrentValue;
				}
			}
		} else {
			$this->JobExcluded->ViewValue = NULL;
		}
		$this->JobExcluded->ViewCustomAttributes = "";

		// IncomeCode
		$this->IncomeCode->LinkCustomAttributes = "";
		$this->IncomeCode->HrefValue = "";
		$this->IncomeCode->TooltipValue = "";

		// IncomeName
		$this->IncomeName->LinkCustomAttributes = "";
		$this->IncomeName->HrefValue = "";
		$this->IncomeName->TooltipValue = "";

		// IncomeDescription
		$this->IncomeDescription->LinkCustomAttributes = "";
		$this->IncomeDescription->HrefValue = "";
		$this->IncomeDescription->TooltipValue = "";

		// Division
		$this->Division->LinkCustomAttributes = "";
		$this->Division->HrefValue = "";
		$this->Division->TooltipValue = "";

		// IncomeAmount
		$this->IncomeAmount->LinkCustomAttributes = "";
		$this->IncomeAmount->HrefValue = "";
		$this->IncomeAmount->TooltipValue = "";

		// IncomeBasicRate
		$this->IncomeBasicRate->LinkCustomAttributes = "";
		$this->IncomeBasicRate->HrefValue = "";
		$this->IncomeBasicRate->TooltipValue = "";

		// BaseIncomeCode
		$this->BaseIncomeCode->LinkCustomAttributes = "";
		$this->BaseIncomeCode->HrefValue = "";
		$this->BaseIncomeCode->TooltipValue = "";

		// Taxable
		$this->Taxable->LinkCustomAttributes = "";
		$this->Taxable->HrefValue = "";
		$this->Taxable->TooltipValue = "";

		// AccountNo
		$this->AccountNo->LinkCustomAttributes = "";
		$this->AccountNo->HrefValue = "";
		$this->AccountNo->TooltipValue = "";

		// JobIncluded
		$this->JobIncluded->LinkCustomAttributes = "";
		$this->JobIncluded->HrefValue = "";
		$this->JobIncluded->TooltipValue = "";

		// Application
		$this->Application->LinkCustomAttributes = "";
		$this->Application->HrefValue = "";
		$this->Application->TooltipValue = "";

		// JobExcluded
		$this->JobExcluded->LinkCustomAttributes = "";
		$this->JobExcluded->HrefValue = "";
		$this->JobExcluded->TooltipValue = "";

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

		// IncomeCode
		$this->IncomeCode->EditAttrs["class"] = "form-control";
		$this->IncomeCode->EditCustomAttributes = "";
		$this->IncomeCode->EditValue = $this->IncomeCode->CurrentValue;
		$this->IncomeCode->ViewCustomAttributes = "";

		// IncomeName
		$this->IncomeName->EditAttrs["class"] = "form-control";
		$this->IncomeName->EditCustomAttributes = "";
		if (!$this->IncomeName->Raw)
			$this->IncomeName->CurrentValue = HtmlDecode($this->IncomeName->CurrentValue);
		$this->IncomeName->EditValue = $this->IncomeName->CurrentValue;
		$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

		// IncomeDescription
		$this->IncomeDescription->EditAttrs["class"] = "form-control";
		$this->IncomeDescription->EditCustomAttributes = "";
		if (!$this->IncomeDescription->Raw)
			$this->IncomeDescription->CurrentValue = HtmlDecode($this->IncomeDescription->CurrentValue);
		$this->IncomeDescription->EditValue = $this->IncomeDescription->CurrentValue;
		$this->IncomeDescription->PlaceHolder = RemoveHtml($this->IncomeDescription->caption());

		// Division
		$this->Division->EditCustomAttributes = "";

		// IncomeAmount
		$this->IncomeAmount->EditAttrs["class"] = "form-control";
		$this->IncomeAmount->EditCustomAttributes = "";
		$this->IncomeAmount->EditValue = $this->IncomeAmount->CurrentValue;
		$this->IncomeAmount->PlaceHolder = RemoveHtml($this->IncomeAmount->caption());
		if (strval($this->IncomeAmount->EditValue) != "" && is_numeric($this->IncomeAmount->EditValue))
			$this->IncomeAmount->EditValue = FormatNumber($this->IncomeAmount->EditValue, -2, -2, -2, -2);
		

		// IncomeBasicRate
		$this->IncomeBasicRate->EditAttrs["class"] = "form-control";
		$this->IncomeBasicRate->EditCustomAttributes = "";
		$this->IncomeBasicRate->EditValue = $this->IncomeBasicRate->CurrentValue;
		$this->IncomeBasicRate->PlaceHolder = RemoveHtml($this->IncomeBasicRate->caption());
		if (strval($this->IncomeBasicRate->EditValue) != "" && is_numeric($this->IncomeBasicRate->EditValue))
			$this->IncomeBasicRate->EditValue = FormatNumber($this->IncomeBasicRate->EditValue, -2, -2, -2, -2);
		

		// BaseIncomeCode
		$this->BaseIncomeCode->EditAttrs["class"] = "form-control";
		$this->BaseIncomeCode->EditCustomAttributes = "";

		// Taxable
		$this->Taxable->EditAttrs["class"] = "form-control";
		$this->Taxable->EditCustomAttributes = "";

		// AccountNo
		$this->AccountNo->EditAttrs["class"] = "form-control";
		$this->AccountNo->EditCustomAttributes = "";

		// JobIncluded
		$this->JobIncluded->EditCustomAttributes = "";

		// Application
		$this->Application->EditAttrs["class"] = "form-control";
		$this->Application->EditCustomAttributes = "";

		// JobExcluded
		$this->JobExcluded->EditCustomAttributes = "";

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
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->IncomeName);
					$doc->exportCaption($this->IncomeDescription);
					$doc->exportCaption($this->Division);
					$doc->exportCaption($this->IncomeAmount);
					$doc->exportCaption($this->IncomeBasicRate);
					$doc->exportCaption($this->BaseIncomeCode);
					$doc->exportCaption($this->Taxable);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->JobIncluded);
					$doc->exportCaption($this->Application);
					$doc->exportCaption($this->JobExcluded);
				} else {
					$doc->exportCaption($this->IncomeCode);
					$doc->exportCaption($this->IncomeName);
					$doc->exportCaption($this->IncomeDescription);
					$doc->exportCaption($this->Division);
					$doc->exportCaption($this->IncomeAmount);
					$doc->exportCaption($this->IncomeBasicRate);
					$doc->exportCaption($this->BaseIncomeCode);
					$doc->exportCaption($this->Taxable);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->JobIncluded);
					$doc->exportCaption($this->Application);
					$doc->exportCaption($this->JobExcluded);
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
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->IncomeName);
						$doc->exportField($this->IncomeDescription);
						$doc->exportField($this->Division);
						$doc->exportField($this->IncomeAmount);
						$doc->exportField($this->IncomeBasicRate);
						$doc->exportField($this->BaseIncomeCode);
						$doc->exportField($this->Taxable);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->JobIncluded);
						$doc->exportField($this->Application);
						$doc->exportField($this->JobExcluded);
					} else {
						$doc->exportField($this->IncomeCode);
						$doc->exportField($this->IncomeName);
						$doc->exportField($this->IncomeDescription);
						$doc->exportField($this->Division);
						$doc->exportField($this->IncomeAmount);
						$doc->exportField($this->IncomeBasicRate);
						$doc->exportField($this->BaseIncomeCode);
						$doc->exportField($this->Taxable);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->JobIncluded);
						$doc->exportField($this->Application);
						$doc->exportField($this->JobExcluded);
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