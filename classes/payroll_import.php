<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for payroll_import
 */
class payroll_import extends DbTable
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
	public $FileNumber;
	public $Surname;
	public $FirstName;
	public $DOB;
	public $DateEmployed;
	public $nrc;
	public $napsa;
	public $LeaveDays;
	public $sex;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'payroll_import';
		$this->TableName = 'payroll_import';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`payroll_import`";
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

		// FileNumber
		$this->FileNumber = new DbField('payroll_import', 'payroll_import', 'x_FileNumber', 'FileNumber', '`FileNumber`', '`FileNumber`', 200, 25, -1, FALSE, '`FileNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FileNumber->Nullable = FALSE; // NOT NULL field
		$this->FileNumber->Required = TRUE; // Required field
		$this->FileNumber->Sortable = TRUE; // Allow sort
		$this->fields['FileNumber'] = &$this->FileNumber;

		// Surname
		$this->Surname = new DbField('payroll_import', 'payroll_import', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 50, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new DbField('payroll_import', 'payroll_import', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 50, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// DOB
		$this->DOB = new DbField('payroll_import', 'payroll_import', 'x_DOB', 'DOB', '`DOB`', '`DOB`', 200, 50, -1, FALSE, '`DOB`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DOB->Sortable = TRUE; // Allow sort
		$this->fields['DOB'] = &$this->DOB;

		// DateEmployed
		$this->DateEmployed = new DbField('payroll_import', 'payroll_import', 'x_DateEmployed', 'DateEmployed', '`DateEmployed`', '`DateEmployed`', 200, 50, -1, FALSE, '`DateEmployed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateEmployed->Sortable = TRUE; // Allow sort
		$this->fields['DateEmployed'] = &$this->DateEmployed;

		// nrc
		$this->nrc = new DbField('payroll_import', 'payroll_import', 'x_nrc', 'nrc', '`nrc`', '`nrc`', 200, 20, -1, FALSE, '`nrc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nrc->Sortable = TRUE; // Allow sort
		$this->fields['nrc'] = &$this->nrc;

		// napsa
		$this->napsa = new DbField('payroll_import', 'payroll_import', 'x_napsa', 'napsa', '`napsa`', '`napsa`', 200, 20, -1, FALSE, '`napsa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->napsa->Sortable = TRUE; // Allow sort
		$this->fields['napsa'] = &$this->napsa;

		// LeaveDays
		$this->LeaveDays = new DbField('payroll_import', 'payroll_import', 'x_LeaveDays', 'LeaveDays', '`LeaveDays`', '`LeaveDays`', 200, 20, -1, FALSE, '`LeaveDays`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LeaveDays->Sortable = TRUE; // Allow sort
		$this->LeaveDays->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LeaveDays'] = &$this->LeaveDays;

		// sex
		$this->sex = new DbField('payroll_import', 'payroll_import', 'x_sex', 'sex', '`sex`', '`sex`', 200, 10, -1, FALSE, '`sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sex->Sortable = TRUE; // Allow sort
		$this->fields['sex'] = &$this->sex;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`payroll_import`";
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
		$this->FileNumber->DbValue = $row['FileNumber'];
		$this->Surname->DbValue = $row['Surname'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->DOB->DbValue = $row['DOB'];
		$this->DateEmployed->DbValue = $row['DateEmployed'];
		$this->nrc->DbValue = $row['nrc'];
		$this->napsa->DbValue = $row['napsa'];
		$this->LeaveDays->DbValue = $row['LeaveDays'];
		$this->sex->DbValue = $row['sex'];
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
			return "payroll_importlist.php";
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
		if ($pageName == "payroll_importview.php")
			return $Language->phrase("View");
		elseif ($pageName == "payroll_importedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "payroll_importadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "payroll_importlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("payroll_importview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("payroll_importview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "payroll_importadd.php?" . $this->getUrlParm($parm);
		else
			$url = "payroll_importadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("payroll_importedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("payroll_importadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("payroll_importdelete.php", $this->getUrlParm());
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
		$this->FileNumber->setDbValue($rs->fields('FileNumber'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->DOB->setDbValue($rs->fields('DOB'));
		$this->DateEmployed->setDbValue($rs->fields('DateEmployed'));
		$this->nrc->setDbValue($rs->fields('nrc'));
		$this->napsa->setDbValue($rs->fields('napsa'));
		$this->LeaveDays->setDbValue($rs->fields('LeaveDays'));
		$this->sex->setDbValue($rs->fields('sex'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// FileNumber
		// Surname
		// FirstName
		// DOB
		// DateEmployed
		// nrc
		// napsa
		// LeaveDays
		// sex
		// FileNumber

		$this->FileNumber->ViewValue = $this->FileNumber->CurrentValue;
		$this->FileNumber->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// DOB
		$this->DOB->ViewValue = $this->DOB->CurrentValue;
		$this->DOB->ViewCustomAttributes = "";

		// DateEmployed
		$this->DateEmployed->ViewValue = $this->DateEmployed->CurrentValue;
		$this->DateEmployed->ViewCustomAttributes = "";

		// nrc
		$this->nrc->ViewValue = $this->nrc->CurrentValue;
		$this->nrc->ViewCustomAttributes = "";

		// napsa
		$this->napsa->ViewValue = $this->napsa->CurrentValue;
		$this->napsa->ViewCustomAttributes = "";

		// LeaveDays
		$this->LeaveDays->ViewValue = $this->LeaveDays->CurrentValue;
		$this->LeaveDays->ViewCustomAttributes = "";

		// sex
		$this->sex->ViewValue = $this->sex->CurrentValue;
		$this->sex->ViewCustomAttributes = "";

		// FileNumber
		$this->FileNumber->LinkCustomAttributes = "";
		$this->FileNumber->HrefValue = "";
		$this->FileNumber->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// DOB
		$this->DOB->LinkCustomAttributes = "";
		$this->DOB->HrefValue = "";
		$this->DOB->TooltipValue = "";

		// DateEmployed
		$this->DateEmployed->LinkCustomAttributes = "";
		$this->DateEmployed->HrefValue = "";
		$this->DateEmployed->TooltipValue = "";

		// nrc
		$this->nrc->LinkCustomAttributes = "";
		$this->nrc->HrefValue = "";
		$this->nrc->TooltipValue = "";

		// napsa
		$this->napsa->LinkCustomAttributes = "";
		$this->napsa->HrefValue = "";
		$this->napsa->TooltipValue = "";

		// LeaveDays
		$this->LeaveDays->LinkCustomAttributes = "";
		$this->LeaveDays->HrefValue = "";
		$this->LeaveDays->TooltipValue = "";

		// sex
		$this->sex->LinkCustomAttributes = "";
		$this->sex->HrefValue = "";
		$this->sex->TooltipValue = "";

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

		// FileNumber
		$this->FileNumber->EditAttrs["class"] = "form-control";
		$this->FileNumber->EditCustomAttributes = "";
		if (!$this->FileNumber->Raw)
			$this->FileNumber->CurrentValue = HtmlDecode($this->FileNumber->CurrentValue);
		$this->FileNumber->EditValue = $this->FileNumber->CurrentValue;
		$this->FileNumber->PlaceHolder = RemoveHtml($this->FileNumber->caption());

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// DOB
		$this->DOB->EditAttrs["class"] = "form-control";
		$this->DOB->EditCustomAttributes = "";
		if (!$this->DOB->Raw)
			$this->DOB->CurrentValue = HtmlDecode($this->DOB->CurrentValue);
		$this->DOB->EditValue = $this->DOB->CurrentValue;
		$this->DOB->PlaceHolder = RemoveHtml($this->DOB->caption());

		// DateEmployed
		$this->DateEmployed->EditAttrs["class"] = "form-control";
		$this->DateEmployed->EditCustomAttributes = "";
		if (!$this->DateEmployed->Raw)
			$this->DateEmployed->CurrentValue = HtmlDecode($this->DateEmployed->CurrentValue);
		$this->DateEmployed->EditValue = $this->DateEmployed->CurrentValue;
		$this->DateEmployed->PlaceHolder = RemoveHtml($this->DateEmployed->caption());

		// nrc
		$this->nrc->EditAttrs["class"] = "form-control";
		$this->nrc->EditCustomAttributes = "";
		if (!$this->nrc->Raw)
			$this->nrc->CurrentValue = HtmlDecode($this->nrc->CurrentValue);
		$this->nrc->EditValue = $this->nrc->CurrentValue;
		$this->nrc->PlaceHolder = RemoveHtml($this->nrc->caption());

		// napsa
		$this->napsa->EditAttrs["class"] = "form-control";
		$this->napsa->EditCustomAttributes = "";
		if (!$this->napsa->Raw)
			$this->napsa->CurrentValue = HtmlDecode($this->napsa->CurrentValue);
		$this->napsa->EditValue = $this->napsa->CurrentValue;
		$this->napsa->PlaceHolder = RemoveHtml($this->napsa->caption());

		// LeaveDays
		$this->LeaveDays->EditAttrs["class"] = "form-control";
		$this->LeaveDays->EditCustomAttributes = "";
		if (!$this->LeaveDays->Raw)
			$this->LeaveDays->CurrentValue = HtmlDecode($this->LeaveDays->CurrentValue);
		$this->LeaveDays->EditValue = $this->LeaveDays->CurrentValue;
		$this->LeaveDays->PlaceHolder = RemoveHtml($this->LeaveDays->caption());

		// sex
		$this->sex->EditAttrs["class"] = "form-control";
		$this->sex->EditCustomAttributes = "";
		if (!$this->sex->Raw)
			$this->sex->CurrentValue = HtmlDecode($this->sex->CurrentValue);
		$this->sex->EditValue = $this->sex->CurrentValue;
		$this->sex->PlaceHolder = RemoveHtml($this->sex->caption());

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
					$doc->exportCaption($this->FileNumber);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->DOB);
					$doc->exportCaption($this->DateEmployed);
					$doc->exportCaption($this->nrc);
					$doc->exportCaption($this->napsa);
					$doc->exportCaption($this->LeaveDays);
					$doc->exportCaption($this->sex);
				} else {
					$doc->exportCaption($this->FileNumber);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->DOB);
					$doc->exportCaption($this->DateEmployed);
					$doc->exportCaption($this->nrc);
					$doc->exportCaption($this->napsa);
					$doc->exportCaption($this->LeaveDays);
					$doc->exportCaption($this->sex);
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
						$doc->exportField($this->FileNumber);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->DOB);
						$doc->exportField($this->DateEmployed);
						$doc->exportField($this->nrc);
						$doc->exportField($this->napsa);
						$doc->exportField($this->LeaveDays);
						$doc->exportField($this->sex);
					} else {
						$doc->exportField($this->FileNumber);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->DOB);
						$doc->exportField($this->DateEmployed);
						$doc->exportField($this->nrc);
						$doc->exportField($this->napsa);
						$doc->exportField($this->LeaveDays);
						$doc->exportField($this->sex);
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