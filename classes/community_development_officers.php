<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for community_development_officers
 */
class community_development_officers extends DbTable
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
	public $LOCAL_AUTHORITY;
	public $FULL_NAME;
	public $SEX;
	public $DATE_OF_BIRTH;
	public $POSITION_NAME;
	public $DATE_OF_FIRST_APPOINTMENT;
	public $LENGTH_OF_STAY;
	public $ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS;
	public $LGSC_REMARKS;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'community_development_officers';
		$this->TableName = 'community_development_officers';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`community_development_officers`";
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

		// LOCAL AUTHORITY
		$this->LOCAL_AUTHORITY = new DbField('community_development_officers', 'community_development_officers', 'x_LOCAL_AUTHORITY', 'LOCAL AUTHORITY', '`LOCAL AUTHORITY`', '`LOCAL AUTHORITY`', 200, 40, -1, FALSE, '`LOCAL AUTHORITY`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LOCAL_AUTHORITY->Nullable = FALSE; // NOT NULL field
		$this->LOCAL_AUTHORITY->Required = TRUE; // Required field
		$this->LOCAL_AUTHORITY->Sortable = TRUE; // Allow sort
		$this->fields['LOCAL AUTHORITY'] = &$this->LOCAL_AUTHORITY;

		// FULL NAME
		$this->FULL_NAME = new DbField('community_development_officers', 'community_development_officers', 'x_FULL_NAME', 'FULL NAME', '`FULL NAME`', '`FULL NAME`', 200, 201, -1, FALSE, '`FULL NAME`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FULL_NAME->Nullable = FALSE; // NOT NULL field
		$this->FULL_NAME->Required = TRUE; // Required field
		$this->FULL_NAME->Sortable = TRUE; // Allow sort
		$this->fields['FULL NAME'] = &$this->FULL_NAME;

		// SEX
		$this->SEX = new DbField('community_development_officers', 'community_development_officers', 'x_SEX', 'SEX', '`SEX`', '`SEX`', 200, 6, -1, FALSE, '`SEX`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SEX->Nullable = FALSE; // NOT NULL field
		$this->SEX->Required = TRUE; // Required field
		$this->SEX->Sortable = TRUE; // Allow sort
		$this->fields['SEX'] = &$this->SEX;

		// DATE OF BIRTH
		$this->DATE_OF_BIRTH = new DbField('community_development_officers', 'community_development_officers', 'x_DATE_OF_BIRTH', 'DATE OF BIRTH', '`DATE OF BIRTH`', CastDateFieldForLike("`DATE OF BIRTH`", 0, "DB"), 133, 10, 0, FALSE, '`DATE OF BIRTH`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DATE_OF_BIRTH->Nullable = FALSE; // NOT NULL field
		$this->DATE_OF_BIRTH->Required = TRUE; // Required field
		$this->DATE_OF_BIRTH->Sortable = TRUE; // Allow sort
		$this->DATE_OF_BIRTH->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DATE OF BIRTH'] = &$this->DATE_OF_BIRTH;

		// POSITION NAME
		$this->POSITION_NAME = new DbField('community_development_officers', 'community_development_officers', 'x_POSITION_NAME', 'POSITION NAME', '`POSITION NAME`', '`POSITION NAME`', 200, 255, -1, FALSE, '`POSITION NAME`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->POSITION_NAME->Nullable = FALSE; // NOT NULL field
		$this->POSITION_NAME->Required = TRUE; // Required field
		$this->POSITION_NAME->Sortable = TRUE; // Allow sort
		$this->fields['POSITION NAME'] = &$this->POSITION_NAME;

		// DATE OF FIRST APPOINTMENT
		$this->DATE_OF_FIRST_APPOINTMENT = new DbField('community_development_officers', 'community_development_officers', 'x_DATE_OF_FIRST_APPOINTMENT', 'DATE OF FIRST APPOINTMENT', '`DATE OF FIRST APPOINTMENT`', CastDateFieldForLike("`DATE OF FIRST APPOINTMENT`", 0, "DB"), 133, 10, 0, FALSE, '`DATE OF FIRST APPOINTMENT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DATE_OF_FIRST_APPOINTMENT->Nullable = FALSE; // NOT NULL field
		$this->DATE_OF_FIRST_APPOINTMENT->Required = TRUE; // Required field
		$this->DATE_OF_FIRST_APPOINTMENT->Sortable = TRUE; // Allow sort
		$this->DATE_OF_FIRST_APPOINTMENT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DATE OF FIRST APPOINTMENT'] = &$this->DATE_OF_FIRST_APPOINTMENT;

		// LENGTH OF STAY
		$this->LENGTH_OF_STAY = new DbField('community_development_officers', 'community_development_officers', 'x_LENGTH_OF_STAY', 'LENGTH OF STAY', '`LENGTH OF STAY`', '`LENGTH OF STAY`', 200, 12, -1, FALSE, '`LENGTH OF STAY`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LENGTH_OF_STAY->Sortable = TRUE; // Allow sort
		$this->fields['LENGTH OF STAY'] = &$this->LENGTH_OF_STAY;

		// ACADEMIC AND PROFESSIONAL QUALIFICATIONS
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS = new DbField('community_development_officers', 'community_development_officers', 'x_ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS', 'ACADEMIC AND PROFESSIONAL QUALIFICATIONS', '`ACADEMIC AND PROFESSIONAL QUALIFICATIONS`', '`ACADEMIC AND PROFESSIONAL QUALIFICATIONS`', 201, 357, -1, FALSE, '`ACADEMIC AND PROFESSIONAL QUALIFICATIONS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->Sortable = TRUE; // Allow sort
		$this->fields['ACADEMIC AND PROFESSIONAL QUALIFICATIONS'] = &$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS;

		// LGSC REMARKS
		$this->LGSC_REMARKS = new DbField('community_development_officers', 'community_development_officers', 'x_LGSC_REMARKS', 'LGSC REMARKS', '`LGSC REMARKS`', '`LGSC REMARKS`', 201, 16777215, -1, FALSE, '`LGSC REMARKS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->LGSC_REMARKS->Sortable = TRUE; // Allow sort
		$this->fields['LGSC REMARKS'] = &$this->LGSC_REMARKS;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`community_development_officers`";
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
		$this->LOCAL_AUTHORITY->DbValue = $row['LOCAL AUTHORITY'];
		$this->FULL_NAME->DbValue = $row['FULL NAME'];
		$this->SEX->DbValue = $row['SEX'];
		$this->DATE_OF_BIRTH->DbValue = $row['DATE OF BIRTH'];
		$this->POSITION_NAME->DbValue = $row['POSITION NAME'];
		$this->DATE_OF_FIRST_APPOINTMENT->DbValue = $row['DATE OF FIRST APPOINTMENT'];
		$this->LENGTH_OF_STAY->DbValue = $row['LENGTH OF STAY'];
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->DbValue = $row['ACADEMIC AND PROFESSIONAL QUALIFICATIONS'];
		$this->LGSC_REMARKS->DbValue = $row['LGSC REMARKS'];
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
			return "community_development_officerslist.php";
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
		if ($pageName == "community_development_officersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "community_development_officersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "community_development_officersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "community_development_officerslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("community_development_officersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("community_development_officersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "community_development_officersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "community_development_officersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("community_development_officersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("community_development_officersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("community_development_officersdelete.php", $this->getUrlParm());
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
		$this->LOCAL_AUTHORITY->setDbValue($rs->fields('LOCAL AUTHORITY'));
		$this->FULL_NAME->setDbValue($rs->fields('FULL NAME'));
		$this->SEX->setDbValue($rs->fields('SEX'));
		$this->DATE_OF_BIRTH->setDbValue($rs->fields('DATE OF BIRTH'));
		$this->POSITION_NAME->setDbValue($rs->fields('POSITION NAME'));
		$this->DATE_OF_FIRST_APPOINTMENT->setDbValue($rs->fields('DATE OF FIRST APPOINTMENT'));
		$this->LENGTH_OF_STAY->setDbValue($rs->fields('LENGTH OF STAY'));
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->setDbValue($rs->fields('ACADEMIC AND PROFESSIONAL QUALIFICATIONS'));
		$this->LGSC_REMARKS->setDbValue($rs->fields('LGSC REMARKS'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LOCAL AUTHORITY
		// FULL NAME
		// SEX
		// DATE OF BIRTH
		// POSITION NAME
		// DATE OF FIRST APPOINTMENT
		// LENGTH OF STAY
		// ACADEMIC AND PROFESSIONAL QUALIFICATIONS
		// LGSC REMARKS
		// LOCAL AUTHORITY

		$this->LOCAL_AUTHORITY->ViewValue = $this->LOCAL_AUTHORITY->CurrentValue;
		$this->LOCAL_AUTHORITY->ViewCustomAttributes = "";

		// FULL NAME
		$this->FULL_NAME->ViewValue = $this->FULL_NAME->CurrentValue;
		$this->FULL_NAME->ViewCustomAttributes = "";

		// SEX
		$this->SEX->ViewValue = $this->SEX->CurrentValue;
		$this->SEX->ViewCustomAttributes = "";

		// DATE OF BIRTH
		$this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
		$this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 0);
		$this->DATE_OF_BIRTH->ViewCustomAttributes = "";

		// POSITION NAME
		$this->POSITION_NAME->ViewValue = $this->POSITION_NAME->CurrentValue;
		$this->POSITION_NAME->ViewCustomAttributes = "";

		// DATE OF FIRST APPOINTMENT
		$this->DATE_OF_FIRST_APPOINTMENT->ViewValue = $this->DATE_OF_FIRST_APPOINTMENT->CurrentValue;
		$this->DATE_OF_FIRST_APPOINTMENT->ViewValue = FormatDateTime($this->DATE_OF_FIRST_APPOINTMENT->ViewValue, 0);
		$this->DATE_OF_FIRST_APPOINTMENT->ViewCustomAttributes = "";

		// LENGTH OF STAY
		$this->LENGTH_OF_STAY->ViewValue = $this->LENGTH_OF_STAY->CurrentValue;
		$this->LENGTH_OF_STAY->ViewCustomAttributes = "";

		// ACADEMIC AND PROFESSIONAL QUALIFICATIONS
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->ViewValue = $this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->CurrentValue;
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->ViewCustomAttributes = "";

		// LGSC REMARKS
		$this->LGSC_REMARKS->ViewValue = $this->LGSC_REMARKS->CurrentValue;
		$this->LGSC_REMARKS->ViewCustomAttributes = "";

		// LOCAL AUTHORITY
		$this->LOCAL_AUTHORITY->LinkCustomAttributes = "";
		$this->LOCAL_AUTHORITY->HrefValue = "";
		$this->LOCAL_AUTHORITY->TooltipValue = "";

		// FULL NAME
		$this->FULL_NAME->LinkCustomAttributes = "";
		$this->FULL_NAME->HrefValue = "";
		$this->FULL_NAME->TooltipValue = "";

		// SEX
		$this->SEX->LinkCustomAttributes = "";
		$this->SEX->HrefValue = "";
		$this->SEX->TooltipValue = "";

		// DATE OF BIRTH
		$this->DATE_OF_BIRTH->LinkCustomAttributes = "";
		$this->DATE_OF_BIRTH->HrefValue = "";
		$this->DATE_OF_BIRTH->TooltipValue = "";

		// POSITION NAME
		$this->POSITION_NAME->LinkCustomAttributes = "";
		$this->POSITION_NAME->HrefValue = "";
		$this->POSITION_NAME->TooltipValue = "";

		// DATE OF FIRST APPOINTMENT
		$this->DATE_OF_FIRST_APPOINTMENT->LinkCustomAttributes = "";
		$this->DATE_OF_FIRST_APPOINTMENT->HrefValue = "";
		$this->DATE_OF_FIRST_APPOINTMENT->TooltipValue = "";

		// LENGTH OF STAY
		$this->LENGTH_OF_STAY->LinkCustomAttributes = "";
		$this->LENGTH_OF_STAY->HrefValue = "";
		$this->LENGTH_OF_STAY->TooltipValue = "";

		// ACADEMIC AND PROFESSIONAL QUALIFICATIONS
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->LinkCustomAttributes = "";
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->HrefValue = "";
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->TooltipValue = "";

		// LGSC REMARKS
		$this->LGSC_REMARKS->LinkCustomAttributes = "";
		$this->LGSC_REMARKS->HrefValue = "";
		$this->LGSC_REMARKS->TooltipValue = "";

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

		// LOCAL AUTHORITY
		$this->LOCAL_AUTHORITY->EditAttrs["class"] = "form-control";
		$this->LOCAL_AUTHORITY->EditCustomAttributes = "";
		if (!$this->LOCAL_AUTHORITY->Raw)
			$this->LOCAL_AUTHORITY->CurrentValue = HtmlDecode($this->LOCAL_AUTHORITY->CurrentValue);
		$this->LOCAL_AUTHORITY->EditValue = $this->LOCAL_AUTHORITY->CurrentValue;
		$this->LOCAL_AUTHORITY->PlaceHolder = RemoveHtml($this->LOCAL_AUTHORITY->caption());

		// FULL NAME
		$this->FULL_NAME->EditAttrs["class"] = "form-control";
		$this->FULL_NAME->EditCustomAttributes = "";
		if (!$this->FULL_NAME->Raw)
			$this->FULL_NAME->CurrentValue = HtmlDecode($this->FULL_NAME->CurrentValue);
		$this->FULL_NAME->EditValue = $this->FULL_NAME->CurrentValue;
		$this->FULL_NAME->PlaceHolder = RemoveHtml($this->FULL_NAME->caption());

		// SEX
		$this->SEX->EditAttrs["class"] = "form-control";
		$this->SEX->EditCustomAttributes = "";
		if (!$this->SEX->Raw)
			$this->SEX->CurrentValue = HtmlDecode($this->SEX->CurrentValue);
		$this->SEX->EditValue = $this->SEX->CurrentValue;
		$this->SEX->PlaceHolder = RemoveHtml($this->SEX->caption());

		// DATE OF BIRTH
		$this->DATE_OF_BIRTH->EditAttrs["class"] = "form-control";
		$this->DATE_OF_BIRTH->EditCustomAttributes = "";
		$this->DATE_OF_BIRTH->EditValue = FormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 8);
		$this->DATE_OF_BIRTH->PlaceHolder = RemoveHtml($this->DATE_OF_BIRTH->caption());

		// POSITION NAME
		$this->POSITION_NAME->EditAttrs["class"] = "form-control";
		$this->POSITION_NAME->EditCustomAttributes = "";
		if (!$this->POSITION_NAME->Raw)
			$this->POSITION_NAME->CurrentValue = HtmlDecode($this->POSITION_NAME->CurrentValue);
		$this->POSITION_NAME->EditValue = $this->POSITION_NAME->CurrentValue;
		$this->POSITION_NAME->PlaceHolder = RemoveHtml($this->POSITION_NAME->caption());

		// DATE OF FIRST APPOINTMENT
		$this->DATE_OF_FIRST_APPOINTMENT->EditAttrs["class"] = "form-control";
		$this->DATE_OF_FIRST_APPOINTMENT->EditCustomAttributes = "";
		$this->DATE_OF_FIRST_APPOINTMENT->EditValue = FormatDateTime($this->DATE_OF_FIRST_APPOINTMENT->CurrentValue, 8);
		$this->DATE_OF_FIRST_APPOINTMENT->PlaceHolder = RemoveHtml($this->DATE_OF_FIRST_APPOINTMENT->caption());

		// LENGTH OF STAY
		$this->LENGTH_OF_STAY->EditAttrs["class"] = "form-control";
		$this->LENGTH_OF_STAY->EditCustomAttributes = "";
		if (!$this->LENGTH_OF_STAY->Raw)
			$this->LENGTH_OF_STAY->CurrentValue = HtmlDecode($this->LENGTH_OF_STAY->CurrentValue);
		$this->LENGTH_OF_STAY->EditValue = $this->LENGTH_OF_STAY->CurrentValue;
		$this->LENGTH_OF_STAY->PlaceHolder = RemoveHtml($this->LENGTH_OF_STAY->caption());

		// ACADEMIC AND PROFESSIONAL QUALIFICATIONS
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->EditAttrs["class"] = "form-control";
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->EditCustomAttributes = "";
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->EditValue = $this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->CurrentValue;
		$this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->PlaceHolder = RemoveHtml($this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS->caption());

		// LGSC REMARKS
		$this->LGSC_REMARKS->EditAttrs["class"] = "form-control";
		$this->LGSC_REMARKS->EditCustomAttributes = "";
		$this->LGSC_REMARKS->EditValue = $this->LGSC_REMARKS->CurrentValue;
		$this->LGSC_REMARKS->PlaceHolder = RemoveHtml($this->LGSC_REMARKS->caption());

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
					$doc->exportCaption($this->LOCAL_AUTHORITY);
					$doc->exportCaption($this->FULL_NAME);
					$doc->exportCaption($this->SEX);
					$doc->exportCaption($this->DATE_OF_BIRTH);
					$doc->exportCaption($this->POSITION_NAME);
					$doc->exportCaption($this->DATE_OF_FIRST_APPOINTMENT);
					$doc->exportCaption($this->LENGTH_OF_STAY);
					$doc->exportCaption($this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS);
					$doc->exportCaption($this->LGSC_REMARKS);
				} else {
					$doc->exportCaption($this->LOCAL_AUTHORITY);
					$doc->exportCaption($this->FULL_NAME);
					$doc->exportCaption($this->SEX);
					$doc->exportCaption($this->DATE_OF_BIRTH);
					$doc->exportCaption($this->POSITION_NAME);
					$doc->exportCaption($this->DATE_OF_FIRST_APPOINTMENT);
					$doc->exportCaption($this->LENGTH_OF_STAY);
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
						$doc->exportField($this->LOCAL_AUTHORITY);
						$doc->exportField($this->FULL_NAME);
						$doc->exportField($this->SEX);
						$doc->exportField($this->DATE_OF_BIRTH);
						$doc->exportField($this->POSITION_NAME);
						$doc->exportField($this->DATE_OF_FIRST_APPOINTMENT);
						$doc->exportField($this->LENGTH_OF_STAY);
						$doc->exportField($this->ACADEMIC_AND_PROFESSIONAL_QUALIFICATIONS);
						$doc->exportField($this->LGSC_REMARKS);
					} else {
						$doc->exportField($this->LOCAL_AUTHORITY);
						$doc->exportField($this->FULL_NAME);
						$doc->exportField($this->SEX);
						$doc->exportField($this->DATE_OF_BIRTH);
						$doc->exportField($this->POSITION_NAME);
						$doc->exportField($this->DATE_OF_FIRST_APPOINTMENT);
						$doc->exportField($this->LENGTH_OF_STAY);
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