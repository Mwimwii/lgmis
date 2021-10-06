<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for market_property
 */
class market_property extends DbTable
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
	public $MarketItemNo;
	public $MarketNo;
	public $ItemName;
	public $ItemRef;
	public $ItemLength;
	public $ItemWidth;
	public $DefaultFees;
	public $LastUpdatedBy;
	public $LastUpdateDate;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'market_property';
		$this->TableName = 'market_property';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`market_property`";
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

		// MarketItemNo
		$this->MarketItemNo = new DbField('market_property', 'market_property', 'x_MarketItemNo', 'MarketItemNo', '`MarketItemNo`', '`MarketItemNo`', 3, 11, -1, FALSE, '`MarketItemNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->MarketItemNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->MarketItemNo->IsPrimaryKey = TRUE; // Primary key field
		$this->MarketItemNo->IsForeignKey = TRUE; // Foreign key field
		$this->MarketItemNo->Sortable = TRUE; // Allow sort
		$this->MarketItemNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MarketItemNo'] = &$this->MarketItemNo;

		// MarketNo
		$this->MarketNo = new DbField('market_property', 'market_property', 'x_MarketNo', 'MarketNo', '`MarketNo`', '`MarketNo`', 3, 11, -1, FALSE, '`MarketNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MarketNo->IsForeignKey = TRUE; // Foreign key field
		$this->MarketNo->Nullable = FALSE; // NOT NULL field
		$this->MarketNo->Required = TRUE; // Required field
		$this->MarketNo->Sortable = TRUE; // Allow sort
		$this->MarketNo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MarketNo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MarketNo->Lookup = new Lookup('MarketNo', 'market', FALSE, 'MarketNo', ["MarketName","","",""], [], [], [], [], [], [], '', '');
		$this->MarketNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MarketNo'] = &$this->MarketNo;

		// ItemName
		$this->ItemName = new DbField('market_property', 'market_property', 'x_ItemName', 'ItemName', '`ItemName`', '`ItemName`', 200, 255, -1, FALSE, '`ItemName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemName->Nullable = FALSE; // NOT NULL field
		$this->ItemName->Required = TRUE; // Required field
		$this->ItemName->Sortable = TRUE; // Allow sort
		$this->fields['ItemName'] = &$this->ItemName;

		// ItemRef
		$this->ItemRef = new DbField('market_property', 'market_property', 'x_ItemRef', 'ItemRef', '`ItemRef`', '`ItemRef`', 200, 25, -1, FALSE, '`ItemRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemRef->Sortable = TRUE; // Allow sort
		$this->fields['ItemRef'] = &$this->ItemRef;

		// ItemLength
		$this->ItemLength = new DbField('market_property', 'market_property', 'x_ItemLength', 'ItemLength', '`ItemLength`', '`ItemLength`', 5, 22, -1, FALSE, '`ItemLength`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemLength->Sortable = TRUE; // Allow sort
		$this->ItemLength->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ItemLength'] = &$this->ItemLength;

		// ItemWidth
		$this->ItemWidth = new DbField('market_property', 'market_property', 'x_ItemWidth', 'ItemWidth', '`ItemWidth`', '`ItemWidth`', 5, 22, -1, FALSE, '`ItemWidth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemWidth->Sortable = TRUE; // Allow sort
		$this->ItemWidth->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ItemWidth'] = &$this->ItemWidth;

		// DefaultFees
		$this->DefaultFees = new DbField('market_property', 'market_property', 'x_DefaultFees', 'DefaultFees', '`DefaultFees`', '`DefaultFees`', 5, 22, -1, FALSE, '`DefaultFees`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DefaultFees->Sortable = TRUE; // Allow sort
		$this->DefaultFees->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DefaultFees'] = &$this->DefaultFees;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('market_property', 'market_property', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('market_property', 'market_property', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdateDate->Sortable = TRUE; // Allow sort
		$this->LastUpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdateDate'] = &$this->LastUpdateDate;
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
		if ($this->getCurrentMasterTable() == "market") {
			if ($this->MarketNo->getSessionValue() != "")
				$masterFilter .= "`MarketNo`=" . QuotedValue($this->MarketNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "market") {
			if ($this->MarketNo->getSessionValue() != "")
				$detailFilter .= "`MarketNo`=" . QuotedValue($this->MarketNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_market()
	{
		return "`MarketNo`=@MarketNo@";
	}

	// Detail filter
	public function sqlDetailFilter_market()
	{
		return "`MarketNo`=@MarketNo@";
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
		if ($this->getCurrentDetailTable() == "market_trans") {
			$detailUrl = $GLOBALS["market_trans"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_MarketItemNo=" . urlencode($this->MarketItemNo->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "market_propertylist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`market_property`";
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
			$this->MarketItemNo->setDbValue($conn->insert_ID());
			$rs['MarketItemNo'] = $this->MarketItemNo->DbValue;
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
			if (array_key_exists('MarketItemNo', $rs))
				AddFilter($where, QuotedName('MarketItemNo', $this->Dbid) . '=' . QuotedValue($rs['MarketItemNo'], $this->MarketItemNo->DataType, $this->Dbid));
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
		$this->MarketItemNo->DbValue = $row['MarketItemNo'];
		$this->MarketNo->DbValue = $row['MarketNo'];
		$this->ItemName->DbValue = $row['ItemName'];
		$this->ItemRef->DbValue = $row['ItemRef'];
		$this->ItemLength->DbValue = $row['ItemLength'];
		$this->ItemWidth->DbValue = $row['ItemWidth'];
		$this->DefaultFees->DbValue = $row['DefaultFees'];
		$this->LastUpdatedBy->DbValue = $row['LastUpdatedBy'];
		$this->LastUpdateDate->DbValue = $row['LastUpdateDate'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`MarketItemNo` = @MarketItemNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('MarketItemNo', $row) ? $row['MarketItemNo'] : NULL;
		else
			$val = $this->MarketItemNo->OldValue !== NULL ? $this->MarketItemNo->OldValue : $this->MarketItemNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@MarketItemNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "market_propertylist.php";
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
		if ($pageName == "market_propertyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "market_propertyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "market_propertyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "market_propertylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("market_propertyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("market_propertyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "market_propertyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "market_propertyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("market_propertyedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("market_propertyedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("market_propertyadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("market_propertyadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("market_propertydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "market" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_MarketNo=" . urlencode($this->MarketNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "MarketItemNo:" . JsonEncode($this->MarketItemNo->CurrentValue, "number");
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
		if ($this->MarketItemNo->CurrentValue != NULL) {
			$url .= "MarketItemNo=" . urlencode($this->MarketItemNo->CurrentValue);
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
			if (Param("MarketItemNo") !== NULL)
				$arKeys[] = Param("MarketItemNo");
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
				$this->MarketItemNo->CurrentValue = $key;
			else
				$this->MarketItemNo->OldValue = $key;
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
		$this->MarketItemNo->setDbValue($rs->fields('MarketItemNo'));
		$this->MarketNo->setDbValue($rs->fields('MarketNo'));
		$this->ItemName->setDbValue($rs->fields('ItemName'));
		$this->ItemRef->setDbValue($rs->fields('ItemRef'));
		$this->ItemLength->setDbValue($rs->fields('ItemLength'));
		$this->ItemWidth->setDbValue($rs->fields('ItemWidth'));
		$this->DefaultFees->setDbValue($rs->fields('DefaultFees'));
		$this->LastUpdatedBy->setDbValue($rs->fields('LastUpdatedBy'));
		$this->LastUpdateDate->setDbValue($rs->fields('LastUpdateDate'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// MarketItemNo
		// MarketNo
		// ItemName
		// ItemRef
		// ItemLength
		// ItemWidth
		// DefaultFees
		// LastUpdatedBy
		// LastUpdateDate
		// MarketItemNo

		$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
		$this->MarketItemNo->ViewCustomAttributes = "";

		// MarketNo
		$curVal = strval($this->MarketNo->CurrentValue);
		if ($curVal != "") {
			$this->MarketNo->ViewValue = $this->MarketNo->lookupCacheOption($curVal);
			if ($this->MarketNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MarketNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->MarketNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MarketNo->ViewValue = $this->MarketNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MarketNo->ViewValue = $this->MarketNo->CurrentValue;
				}
			}
		} else {
			$this->MarketNo->ViewValue = NULL;
		}
		$this->MarketNo->ViewCustomAttributes = "";

		// ItemName
		$this->ItemName->ViewValue = $this->ItemName->CurrentValue;
		$this->ItemName->ViewCustomAttributes = "";

		// ItemRef
		$this->ItemRef->ViewValue = $this->ItemRef->CurrentValue;
		$this->ItemRef->ViewCustomAttributes = "";

		// ItemLength
		$this->ItemLength->ViewValue = $this->ItemLength->CurrentValue;
		$this->ItemLength->ViewValue = FormatNumber($this->ItemLength->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->ItemLength->ViewCustomAttributes = "";

		// ItemWidth
		$this->ItemWidth->ViewValue = $this->ItemWidth->CurrentValue;
		$this->ItemWidth->ViewValue = FormatNumber($this->ItemWidth->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->ItemWidth->ViewCustomAttributes = "";

		// DefaultFees
		$this->DefaultFees->ViewValue = $this->DefaultFees->CurrentValue;
		$this->DefaultFees->ViewValue = FormatNumber($this->DefaultFees->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->DefaultFees->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// MarketItemNo
		$this->MarketItemNo->LinkCustomAttributes = "";
		$this->MarketItemNo->HrefValue = "";
		$this->MarketItemNo->TooltipValue = "";

		// MarketNo
		$this->MarketNo->LinkCustomAttributes = "";
		$this->MarketNo->HrefValue = "";
		$this->MarketNo->TooltipValue = "";

		// ItemName
		$this->ItemName->LinkCustomAttributes = "";
		$this->ItemName->HrefValue = "";
		$this->ItemName->TooltipValue = "";

		// ItemRef
		$this->ItemRef->LinkCustomAttributes = "";
		$this->ItemRef->HrefValue = "";
		$this->ItemRef->TooltipValue = "";

		// ItemLength
		$this->ItemLength->LinkCustomAttributes = "";
		$this->ItemLength->HrefValue = "";
		$this->ItemLength->TooltipValue = "";

		// ItemWidth
		$this->ItemWidth->LinkCustomAttributes = "";
		$this->ItemWidth->HrefValue = "";
		$this->ItemWidth->TooltipValue = "";

		// DefaultFees
		$this->DefaultFees->LinkCustomAttributes = "";
		$this->DefaultFees->HrefValue = "";
		$this->DefaultFees->TooltipValue = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->LinkCustomAttributes = "";
		$this->LastUpdatedBy->HrefValue = "";
		$this->LastUpdatedBy->TooltipValue = "";

		// LastUpdateDate
		$this->LastUpdateDate->LinkCustomAttributes = "";
		$this->LastUpdateDate->HrefValue = "";
		$this->LastUpdateDate->TooltipValue = "";

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

		// MarketItemNo
		$this->MarketItemNo->EditAttrs["class"] = "form-control";
		$this->MarketItemNo->EditCustomAttributes = "";
		$this->MarketItemNo->EditValue = $this->MarketItemNo->CurrentValue;
		$this->MarketItemNo->ViewCustomAttributes = "";

		// MarketNo
		$this->MarketNo->EditAttrs["class"] = "form-control";
		$this->MarketNo->EditCustomAttributes = "";
		if ($this->MarketNo->getSessionValue() != "") {
			$this->MarketNo->CurrentValue = $this->MarketNo->getSessionValue();
			$curVal = strval($this->MarketNo->CurrentValue);
			if ($curVal != "") {
				$this->MarketNo->ViewValue = $this->MarketNo->lookupCacheOption($curVal);
				if ($this->MarketNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MarketNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MarketNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MarketNo->ViewValue = $this->MarketNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MarketNo->ViewValue = $this->MarketNo->CurrentValue;
					}
				}
			} else {
				$this->MarketNo->ViewValue = NULL;
			}
			$this->MarketNo->ViewCustomAttributes = "";
		} else {
		}

		// ItemName
		$this->ItemName->EditAttrs["class"] = "form-control";
		$this->ItemName->EditCustomAttributes = "";
		if (!$this->ItemName->Raw)
			$this->ItemName->CurrentValue = HtmlDecode($this->ItemName->CurrentValue);
		$this->ItemName->EditValue = $this->ItemName->CurrentValue;
		$this->ItemName->PlaceHolder = RemoveHtml($this->ItemName->caption());

		// ItemRef
		$this->ItemRef->EditAttrs["class"] = "form-control";
		$this->ItemRef->EditCustomAttributes = "";
		if (!$this->ItemRef->Raw)
			$this->ItemRef->CurrentValue = HtmlDecode($this->ItemRef->CurrentValue);
		$this->ItemRef->EditValue = $this->ItemRef->CurrentValue;
		$this->ItemRef->PlaceHolder = RemoveHtml($this->ItemRef->caption());

		// ItemLength
		$this->ItemLength->EditAttrs["class"] = "form-control";
		$this->ItemLength->EditCustomAttributes = "";
		$this->ItemLength->EditValue = $this->ItemLength->CurrentValue;
		$this->ItemLength->PlaceHolder = RemoveHtml($this->ItemLength->caption());
		if (strval($this->ItemLength->EditValue) != "" && is_numeric($this->ItemLength->EditValue))
			$this->ItemLength->EditValue = FormatNumber($this->ItemLength->EditValue, -2, -1, -2, 0);
		

		// ItemWidth
		$this->ItemWidth->EditAttrs["class"] = "form-control";
		$this->ItemWidth->EditCustomAttributes = "";
		$this->ItemWidth->EditValue = $this->ItemWidth->CurrentValue;
		$this->ItemWidth->PlaceHolder = RemoveHtml($this->ItemWidth->caption());
		if (strval($this->ItemWidth->EditValue) != "" && is_numeric($this->ItemWidth->EditValue))
			$this->ItemWidth->EditValue = FormatNumber($this->ItemWidth->EditValue, -2, -1, -2, 0);
		

		// DefaultFees
		$this->DefaultFees->EditAttrs["class"] = "form-control";
		$this->DefaultFees->EditCustomAttributes = "";
		$this->DefaultFees->EditValue = $this->DefaultFees->CurrentValue;
		$this->DefaultFees->PlaceHolder = RemoveHtml($this->DefaultFees->caption());
		if (strval($this->DefaultFees->EditValue) != "" && is_numeric($this->DefaultFees->EditValue))
			$this->DefaultFees->EditValue = FormatNumber($this->DefaultFees->EditValue, -2, -1, -2, 0);
		

		// LastUpdatedBy
		$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
		$this->LastUpdatedBy->EditCustomAttributes = "";
		if (!$this->LastUpdatedBy->Raw)
			$this->LastUpdatedBy->CurrentValue = HtmlDecode($this->LastUpdatedBy->CurrentValue);
		$this->LastUpdatedBy->EditValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

		// LastUpdateDate
		$this->LastUpdateDate->EditAttrs["class"] = "form-control";
		$this->LastUpdateDate->EditCustomAttributes = "";
		$this->LastUpdateDate->EditValue = FormatDateTime($this->LastUpdateDate->CurrentValue, 8);
		$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

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
					$doc->exportCaption($this->MarketItemNo);
					$doc->exportCaption($this->MarketNo);
					$doc->exportCaption($this->ItemName);
					$doc->exportCaption($this->ItemRef);
					$doc->exportCaption($this->ItemLength);
					$doc->exportCaption($this->ItemWidth);
					$doc->exportCaption($this->DefaultFees);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
				} else {
					$doc->exportCaption($this->MarketItemNo);
					$doc->exportCaption($this->MarketNo);
					$doc->exportCaption($this->ItemName);
					$doc->exportCaption($this->ItemRef);
					$doc->exportCaption($this->ItemLength);
					$doc->exportCaption($this->ItemWidth);
					$doc->exportCaption($this->DefaultFees);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
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
						$doc->exportField($this->MarketItemNo);
						$doc->exportField($this->MarketNo);
						$doc->exportField($this->ItemName);
						$doc->exportField($this->ItemRef);
						$doc->exportField($this->ItemLength);
						$doc->exportField($this->ItemWidth);
						$doc->exportField($this->DefaultFees);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
					} else {
						$doc->exportField($this->MarketItemNo);
						$doc->exportField($this->MarketNo);
						$doc->exportField($this->ItemName);
						$doc->exportField($this->ItemRef);
						$doc->exportField($this->ItemLength);
						$doc->exportField($this->ItemWidth);
						$doc->exportField($this->DefaultFees);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
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