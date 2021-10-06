<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for halfyear_ref
 */
class halfyear_ref extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $HalfYear;
	public $BillYear;
	public $PropertyGroup;
	public $StartDate;
	public $Enddate;
	public $ID;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'halfyear_ref';
		$this->TableName = 'halfyear_ref';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`halfyear_ref`";
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

		// HalfYear
		$this->HalfYear = new DbField('halfyear_ref', 'halfyear_ref', 'x_HalfYear', 'HalfYear', '`HalfYear`', '`HalfYear`', 16, 4, -1, FALSE, '`HalfYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->HalfYear->Nullable = FALSE; // NOT NULL field
		$this->HalfYear->Required = TRUE; // Required field
		$this->HalfYear->Sortable = TRUE; // Allow sort
		$this->HalfYear->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->HalfYear->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->HalfYear->Lookup = new Lookup('HalfYear', 'halfyear_ref', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->HalfYear->OptionCount = 2;
		$this->HalfYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['HalfYear'] = &$this->HalfYear;

		// BillYear
		$this->BillYear = new DbField('halfyear_ref', 'halfyear_ref', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BillYear->Nullable = FALSE; // NOT NULL field
		$this->BillYear->Required = TRUE; // Required field
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BillYear->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BillYear->Lookup = new Lookup('BillYear', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// PropertyGroup
		$this->PropertyGroup = new DbField('halfyear_ref', 'halfyear_ref', 'x_PropertyGroup', 'PropertyGroup', '`PropertyGroup`', '`PropertyGroup`', 16, 2, -1, FALSE, '`PropertyGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PropertyGroup->Nullable = FALSE; // NOT NULL field
		$this->PropertyGroup->Sortable = TRUE; // Allow sort
		$this->PropertyGroup->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PropertyGroup->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PropertyGroup->Lookup = new Lookup('PropertyGroup', 'property_group', FALSE, 'PropertyGroup', ["PropertyGroupDesc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PropertyGroup'] = &$this->PropertyGroup;

		// StartDate
		$this->StartDate = new DbField('halfyear_ref', 'halfyear_ref', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// Enddate
		$this->Enddate = new DbField('halfyear_ref', 'halfyear_ref', 'x_Enddate', 'Enddate', '`Enddate`', CastDateFieldForLike("`Enddate`", 0, "DB"), 133, 10, 0, FALSE, '`Enddate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Enddate->Sortable = TRUE; // Allow sort
		$this->Enddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Enddate'] = &$this->Enddate;

		// ID
		$this->ID = new DbField('halfyear_ref', 'halfyear_ref', 'x_ID', 'ID', '`ID`', '`ID`', 3, 2, -1, FALSE, '`ID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`halfyear_ref`";
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
			$this->ID->setDbValue($conn->insert_ID());
			$rs['ID'] = $this->ID->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID', $rs))
				AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->HalfYear->DbValue = $row['HalfYear'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->PropertyGroup->DbValue = $row['PropertyGroup'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->Enddate->DbValue = $row['Enddate'];
		$this->ID->DbValue = $row['ID'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID` = @ID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ID', $row) ? $row['ID'] : NULL;
		else
			$val = $this->ID->OldValue !== NULL ? $this->ID->OldValue : $this->ID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "halfyear_reflist.php";
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
		if ($pageName == "halfyear_refview.php")
			return $Language->phrase("View");
		elseif ($pageName == "halfyear_refedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "halfyear_refadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "halfyear_reflist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("halfyear_refview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("halfyear_refview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "halfyear_refadd.php?" . $this->getUrlParm($parm);
		else
			$url = "halfyear_refadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("halfyear_refedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("halfyear_refadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("halfyear_refdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
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
		if ($this->ID->CurrentValue != NULL) {
			$url .= "ID=" . urlencode($this->ID->CurrentValue);
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
			if (Param("ID") !== NULL)
				$arKeys[] = Param("ID");
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
				$this->ID->CurrentValue = $key;
			else
				$this->ID->OldValue = $key;
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
		$this->HalfYear->setDbValue($rs->fields('HalfYear'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->PropertyGroup->setDbValue($rs->fields('PropertyGroup'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->Enddate->setDbValue($rs->fields('Enddate'));
		$this->ID->setDbValue($rs->fields('ID'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// HalfYear
		// BillYear
		// PropertyGroup
		// StartDate
		// Enddate
		// ID
		// HalfYear

		if (strval($this->HalfYear->CurrentValue) != "") {
			$this->HalfYear->ViewValue = $this->HalfYear->optionCaption($this->HalfYear->CurrentValue);
		} else {
			$this->HalfYear->ViewValue = NULL;
		}
		$this->HalfYear->ViewCustomAttributes = "";

		// BillYear
		$curVal = strval($this->BillYear->CurrentValue);
		if ($curVal != "") {
			$this->BillYear->ViewValue = $this->BillYear->lookupCacheOption($curVal);
			if ($this->BillYear->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BillYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BillYear->ViewValue = $this->BillYear->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
				}
			}
		} else {
			$this->BillYear->ViewValue = NULL;
		}
		$this->BillYear->ViewCustomAttributes = "";

		// PropertyGroup
		$curVal = strval($this->PropertyGroup->CurrentValue);
		if ($curVal != "") {
			$this->PropertyGroup->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
			if ($this->PropertyGroup->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PropertyGroup`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PropertyGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PropertyGroup->ViewValue = $this->PropertyGroup->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
				}
			}
		} else {
			$this->PropertyGroup->ViewValue = NULL;
		}
		$this->PropertyGroup->ViewCustomAttributes = "";

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// Enddate
		$this->Enddate->ViewValue = $this->Enddate->CurrentValue;
		$this->Enddate->ViewValue = FormatDateTime($this->Enddate->ViewValue, 0);
		$this->Enddate->ViewCustomAttributes = "";

		// ID
		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// HalfYear
		$this->HalfYear->LinkCustomAttributes = "";
		$this->HalfYear->HrefValue = "";
		$this->HalfYear->TooltipValue = "";

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

		// PropertyGroup
		$this->PropertyGroup->LinkCustomAttributes = "";
		$this->PropertyGroup->HrefValue = "";
		$this->PropertyGroup->TooltipValue = "";

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// Enddate
		$this->Enddate->LinkCustomAttributes = "";
		$this->Enddate->HrefValue = "";
		$this->Enddate->TooltipValue = "";

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

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

		// HalfYear
		$this->HalfYear->EditAttrs["class"] = "form-control";
		$this->HalfYear->EditCustomAttributes = "";
		$this->HalfYear->EditValue = $this->HalfYear->options(TRUE);

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";

		// PropertyGroup
		$this->PropertyGroup->EditAttrs["class"] = "form-control";
		$this->PropertyGroup->EditCustomAttributes = "";

		// StartDate
		$this->StartDate->EditAttrs["class"] = "form-control";
		$this->StartDate->EditCustomAttributes = "";
		$this->StartDate->EditValue = FormatDateTime($this->StartDate->CurrentValue, 8);
		$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

		// Enddate
		$this->Enddate->EditAttrs["class"] = "form-control";
		$this->Enddate->EditCustomAttributes = "";
		$this->Enddate->EditValue = FormatDateTime($this->Enddate->CurrentValue, 8);
		$this->Enddate->PlaceHolder = RemoveHtml($this->Enddate->caption());

		// ID
		$this->ID->EditAttrs["class"] = "form-control";
		$this->ID->EditCustomAttributes = "";
		$this->ID->EditValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->HalfYear);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->Enddate);
					$doc->exportCaption($this->ID);
				} else {
					$doc->exportCaption($this->HalfYear);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->Enddate);
					$doc->exportCaption($this->ID);
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
						$doc->exportField($this->HalfYear);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->Enddate);
						$doc->exportField($this->ID);
					} else {
						$doc->exportField($this->HalfYear);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->Enddate);
						$doc->exportField($this->ID);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'halfyear_ref';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'halfyear_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ID'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'halfyear_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ID'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'halfyear_ref';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ID'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
		$half = $rsnew["HalfYear"];
		$halflast = $rsold["HalfYear"];
		$billyr = $rsnew["BillYear"];
		$billyrlast = $rsold["BillYear"];
		$grp = $rsnew["PropertyGroup"];
		execute("truncate table bill");
		if($grp == '1') {
			$kount = executeScalar("select count(*) from property_account where PropertyGroup = '" . $grp . "'");
		if (isset($kount)){
		execute("INSERT INTO `property_account` (`ValuationNo`,  `ClientSerNo`,  `ClientID`,  `ChargeCode`,
		  `ChargeGroup`,  `BalanceBF`,  `CurrentDemand`,  `VAT`,  `AmountPaid`,  `BillPeriod`,  `PeriodType`,  `BillYear`,
		   `StartDate`,  `EndDate`)
		   SELECT  `property`.`ValuationNo`,  `property_account`.`ClientSerNo`,
		   `property_account`.`ClientID`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,
		   (`property_account`.`BalanceBF` + `property_account`.`CurrentDemand` + `property_account`.`VAT` - `property_account`.`AmountPaid`) AS BalanceBF,
		  (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		  0 AS VAT, 0 AS AmountPaid,
		  `halfyear_ref`.HalfYear AS BillPeriod,  'H' AS PeriodType,  `halfyear_ref`.`BillYear`,
		  `halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`  
		  FROM   `halfyear_ref`, property, property_use, `property_account`	  
		  WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		  AND `property_account`.ValuationNo = property.`ValuationNo`
		  AND `property_account`.BillYear = IF(`halfyear_ref`.HalfYear=2, `halfyear_ref`.`BillYear`,`halfyear_ref`.`BillYear` -1 )
		  AND `property_account`.BillPeriod = IF(`halfyear_ref`.HalfYear = 2,`halfyear_ref`.HalfYear - 1 , `halfyear_ref`.`HalfYear` + 1)
		  AND property.`RateableValue` > 0 AND property.ExemptCode IS NULL");
		  execute("INSERT INTO `bill` (
		   `ReferenceNo`,  `ChargeCode`,  `ChargeGroup`,  `ClientID`,  `ClientSerNo`,  
		    `AccountNo`,  `ChargeRef`,  `BillYear`,  `BillPeriod`,  `StartDate`,  `EndDate`,
		      `BalanceBF`,  `AmountDue`,  `VAT`,    `AmountPaid`)
		      SELECT  `property`.`ValuationNo`, 46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,`property_account`.`ClientID`, `property_account`.`ClientSerNo`,
		      `property_account`.`AccountNo`,'H' AS ChargeRef, `halfyear_ref`.`BillYear`, `halfyear_ref`.HalfYear AS BillPeriod,`halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`,
		      (`property_account`.`BalanceBF` + `property_account`.`CurrentDemand` + `property_account`.`VAT` - `property_account`.`AmountPaid`) AS BalanceBF,
		      (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		      0 AS VAT, 0 AS AmountPaid   
		      FROM   `halfyear_ref`, property, property_use, `property_account`
		      WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		      AND `property_account`.ValuationNo = property.`ValuationNo`
		      AND `property_account`.BillYear = IF(`halfyear_ref`.HalfYear=2, `halfyear_ref`.`BillYear`,`halfyear_ref`.`BillYear` -1 ) 
		      AND `property_account`.BillPeriod = IF(`halfyear_ref`.HalfYear = 2,`halfyear_ref`.HalfYear - 1, `halfyear_ref`.`HalfYear` + 1)
		      AND property.`RateableValue` > 0 AND property.ExemptCode is null");
		  }
		else
		{execute("INSERT INTO `property_account` (`ValuationNo`,  `ClientSerNo`,  `ClientID`,  `ChargeCode`,
		  `ChargeGroup`,  `BalanceBF`,  `CurrentDemand`,  `VAT`,  `AmountPaid`,  `BillPeriod`,  `PeriodType`,  `BillYear`,
		   `StartDate`,  `EndDate`)
		   SELECT  `property`.`ValuationNo`,  `property`.`ClientSerNo`,
		   `property`.`ClientID`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,
		   0 AS BalanceBF,
		   (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		   0 AS VAT, 0 AS AmountPaid,
		   `halfyear_ref`.HalfYear AS BillPeriod,  'H' AS PeriodType,  `halfyear_ref`.`BillYear`,
		   `halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`  FROM   `halfyear_ref`, property, property_use
		   WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		   AND property.`RateableValue` > 0 AND property.ExemptCode is null");
		   execute("INSERT INTO `bill` (
	  `ReferenceNo`,  `ChargeCode`,  `ChargeGroup`,  `ClientID`,  `ClientSerNo`,  
	  `AccountNo`,  `ChargeRef`,  `BillYear`,  `BillPeriod`,  `StartDate`,  `EndDate`,
	  `BalanceBF`,  `AmountDue`,  `VAT`,    `AmountPaid`)
	SELECT  `property`.`ValuationNo`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`, `property`.`ClientID`, `property`.`ClientSerNo`,
		  0 AS `AccountNo`,'H' AS ChargeRef,  `halfyear_ref`.`BillYear`, `halfyear_ref`.HalfYear AS BillPeriod,`halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`,
		   0 AS BalanceBF,  (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy` AS CurrentDemand,
		   0 AS VAT, 0 AS AmountPaid 
		     FROM   `halfyear_ref`, property, property_use
		   WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		   AND property.`RateableValue` > 0 AND property.ExemptCode is null");
		   }
		 }
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
		$half = $rsnew["HalfYear"];
		$halflast = $rsold["HalfYear"];
		$billyr = $rsnew["BillYear"];
		$billyrlast = $rsold["BillYear"];
		$grp = $rsnew["PropertyGroup"];

	//die(strval($grp));
		execute("truncate table bill");
		if($grp == '1') {
			$kount = executeScalar("SELECT COUNT(*) FROM property, property_account WHERE property.`ValuationNo` = property_account.`ValuationNo`
			AND property.PropertyGroup = '" . $grp . "'");
		if ($kount > 0){
		execute("INSERT INTO `property_account` (`ValuationNo`,  `ClientSerNo`,  `ClientID`,  `ChargeCode`,
		  `ChargeGroup`,  `BalanceBF`,  `CurrentDemand`,  `VAT`,  `AmountPaid`,  `BillPeriod`,  `PeriodType`,  `BillYear`,
		   `StartDate`,  `EndDate`)
		   SELECT  `property`.`ValuationNo`,  `property_account`.`ClientSerNo`,
		   `property_account`.`ClientID`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,
		   (`property_account`.`BalanceBF` + `property_account`.`CurrentDemand` + `property_account`.`VAT` - `property_account`.`AmountPaid`) AS BalanceBF,
		  (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		  0 AS VAT, 0 AS AmountPaid,
		  `halfyear_ref`.HalfYear AS BillPeriod,  'H' AS PeriodType,  `halfyear_ref`.`BillYear`,
		  `halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`  
		  FROM   `halfyear_ref`, property, property_use, `property_account`	  
		  WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		  AND `property_account`.ValuationNo = property.`ValuationNo`
		  AND `property_account`.BillYear = IF(`halfyear_ref`.HalfYear=2, `halfyear_ref`.`BillYear`,`halfyear_ref`.`BillYear` -1 )
		  AND `property_account`.BillPeriod = IF(`halfyear_ref`.HalfYear = 2,`halfyear_ref`.HalfYear -1 , `halfyear_ref`.`HalfYear` + 1)
		  AND property.`RateableValue` > 0 AND property.ExemptCode IS NULL");
		  execute("INSERT INTO `bill` (
		   `ReferenceNo`,  `ChargeCode`,  `ChargeGroup`,  `ClientID`,  `ClientSerNo`,  
		    `AccountNo`,  `ChargeRef`,  `BillYear`,  `BillPeriod`,  `StartDate`,  `EndDate`,
		      `BalanceBF`,  `AmountDue`,  `VAT`,    `AmountPaid`)
		      SELECT  `property_account`.`ValuationNo`, 46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,`property_account`.`ClientID`, `property_account`.`ClientSerNo`,
		      `property_account`.`AccountNo`,'H' AS ChargeRef, `halfyear_ref`.`BillYear`, `halfyear_ref`.HalfYear AS BillPeriod,`halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`,
		      (`property_account`.`BalanceBF` + `property_account`.`CurrentDemand` + `property_account`.`VAT` - `property_account`.`AmountPaid`) AS BalanceBF,
		      (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		      0 AS VAT, 0 AS AmountPaid   
		      FROM   `halfyear_ref`, property, property_use, `property_account`
		      WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		      AND `property_account`.ValuationNo = property.`ValuationNo`
		      AND `property_account`.BillYear = IF(`halfyear_ref`.HalfYear=2, `halfyear_ref`.`BillYear`,`halfyear_ref`.`BillYear` -1 ) 
		      AND `property_account`.BillPeriod = IF(`halfyear_ref`.HalfYear = 2,`halfyear_ref`.HalfYear - 1, `halfyear_ref`.`HalfYear` + 1)
		      AND property.`RateableValue` > 0 AND property.ExemptCode is null");
		  }
		else
		{execute("INSERT INTO `property_account` (`ValuationNo`,  `ClientSerNo`,  `ClientID`,  `ChargeCode`,
		  `ChargeGroup`,  `BalanceBF`,  `CurrentDemand`,  `VAT`,  `AmountPaid`,  `BillPeriod`,  `PeriodType`,  `BillYear`,
		   `StartDate`,  `EndDate`)
		   SELECT  `property`.`ValuationNo`,  `property`.`ClientSerNo`,
		   `property`.`ClientID`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`,
		   0 AS BalanceBF,
		   (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		   0 AS VAT, 0 AS AmountPaid,
		   `halfyear_ref`.HalfYear AS BillPeriod,  'H' AS PeriodType,  `halfyear_ref`.`BillYear`,
		   `halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`  FROM   `halfyear_ref`, property, property_use
		   WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		   AND 	property.`RateableValue` > 0 AND property.ExemptCode is null");
		   execute("INSERT INTO `bill` (
	  `ReferenceNo`,  `ChargeCode`,  `ChargeGroup`,  `ClientID`,  `ClientSerNo`,  
	  `AccountNo`,  `ChargeRef`,  `BillYear`,  `BillPeriod`,  `StartDate`,  `EndDate`,
	  `BalanceBF`,  `AmountDue`,  `VAT`,    `AmountPaid`)
	SELECT  `property`.`ValuationNo`,  46 AS ChargeCode,  `halfyear_ref`.`PropertyGroup`, `property`.`ClientID`, `property`.`ClientSerNo`,
		  0 AS `AccountNo`,'H' AS ChargeRef,  `halfyear_ref`.`BillYear`, `halfyear_ref`.HalfYear AS BillPeriod,`halfyear_ref`.`StartDate`,  `halfyear_ref`.`EndDate`,
		   0 AS BalanceBF,  (`property`.`RateableValue` + `property`.`SupplementaryValue`) * property_use.`RatesLevy`/2 AS CurrentDemand,
		   0 AS VAT, 0 AS AmountPaid 
		     FROM   `halfyear_ref`, property, property_use
		   WHERE  `property`.`PropertyUse` = property_use.PropertyUse AND property.`PropertyGroup` = `halfyear_ref`.`PropertyGroup`
		   AND property.`RateableValue` > 0 AND property.ExemptCode is null");
		   }
		 }
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