<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for market_trans
 */
class market_trans extends DbTable
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
	public $TransNo;
	public $MarketItemNo;
	public $DateHired;
	public $MartketeerName;
	public $MartketeerID;
	public $AmountDue;
	public $AmountPaid;
	public $ReceiptNo;
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
		$this->TableVar = 'market_trans';
		$this->TableName = 'market_trans';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`market_trans`";
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

		// TransNo
		$this->TransNo = new DbField('market_trans', 'market_trans', 'x_TransNo', 'TransNo', '`TransNo`', '`TransNo`', 3, 11, -1, FALSE, '`TransNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->TransNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->TransNo->IsPrimaryKey = TRUE; // Primary key field
		$this->TransNo->Sortable = TRUE; // Allow sort
		$this->TransNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TransNo'] = &$this->TransNo;

		// MarketItemNo
		$this->MarketItemNo = new DbField('market_trans', 'market_trans', 'x_MarketItemNo', 'MarketItemNo', '`MarketItemNo`', '`MarketItemNo`', 3, 11, -1, FALSE, '`MarketItemNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MarketItemNo->IsForeignKey = TRUE; // Foreign key field
		$this->MarketItemNo->Nullable = FALSE; // NOT NULL field
		$this->MarketItemNo->Required = TRUE; // Required field
		$this->MarketItemNo->Sortable = TRUE; // Allow sort
		$this->MarketItemNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MarketItemNo'] = &$this->MarketItemNo;

		// DateHired
		$this->DateHired = new DbField('market_trans', 'market_trans', 'x_DateHired', 'DateHired', '`DateHired`', CastDateFieldForLike("`DateHired`", 0, "DB"), 135, 19, 0, FALSE, '`DateHired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateHired->Sortable = TRUE; // Allow sort
		$this->DateHired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateHired'] = &$this->DateHired;

		// MartketeerName
		$this->MartketeerName = new DbField('market_trans', 'market_trans', 'x_MartketeerName', 'MartketeerName', '`MartketeerName`', '`MartketeerName`', 200, 255, -1, FALSE, '`MartketeerName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MartketeerName->Nullable = FALSE; // NOT NULL field
		$this->MartketeerName->Required = TRUE; // Required field
		$this->MartketeerName->Sortable = TRUE; // Allow sort
		$this->fields['MartketeerName'] = &$this->MartketeerName;

		// MartketeerID
		$this->MartketeerID = new DbField('market_trans', 'market_trans', 'x_MartketeerID', 'MartketeerID', '`MartketeerID`', '`MartketeerID`', 200, 13, -1, FALSE, '`MartketeerID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MartketeerID->Sortable = TRUE; // Allow sort
		$this->fields['MartketeerID'] = &$this->MartketeerID;

		// AmountDue
		$this->AmountDue = new DbField('market_trans', 'market_trans', 'x_AmountDue', 'AmountDue', '`AmountDue`', '`AmountDue`', 5, 22, -1, FALSE, '`AmountDue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountDue->Sortable = TRUE; // Allow sort
		$this->AmountDue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountDue'] = &$this->AmountDue;

		// AmountPaid
		$this->AmountPaid = new DbField('market_trans', 'market_trans', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// ReceiptNo
		$this->ReceiptNo = new DbField('market_trans', 'market_trans', 'x_ReceiptNo', 'ReceiptNo', '`ReceiptNo`', '`ReceiptNo`', 200, 25, -1, FALSE, '`ReceiptNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiptNo->Sortable = TRUE; // Allow sort
		$this->fields['ReceiptNo'] = &$this->ReceiptNo;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('market_trans', 'market_trans', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('market_trans', 'market_trans', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentMasterTable() == "market_property") {
			if ($this->MarketItemNo->getSessionValue() != "")
				$masterFilter .= "`MarketItemNo`=" . QuotedValue($this->MarketItemNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "market_property") {
			if ($this->MarketItemNo->getSessionValue() != "")
				$detailFilter .= "`MarketItemNo`=" . QuotedValue($this->MarketItemNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_market_property()
	{
		return "`MarketItemNo`=@MarketItemNo@";
	}

	// Detail filter
	public function sqlDetailFilter_market_property()
	{
		return "`MarketItemNo`=@MarketItemNo@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`market_trans`";
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
			$this->TransNo->setDbValue($conn->insert_ID());
			$rs['TransNo'] = $this->TransNo->DbValue;
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
			if (array_key_exists('TransNo', $rs))
				AddFilter($where, QuotedName('TransNo', $this->Dbid) . '=' . QuotedValue($rs['TransNo'], $this->TransNo->DataType, $this->Dbid));
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
		$this->TransNo->DbValue = $row['TransNo'];
		$this->MarketItemNo->DbValue = $row['MarketItemNo'];
		$this->DateHired->DbValue = $row['DateHired'];
		$this->MartketeerName->DbValue = $row['MartketeerName'];
		$this->MartketeerID->DbValue = $row['MartketeerID'];
		$this->AmountDue->DbValue = $row['AmountDue'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->ReceiptNo->DbValue = $row['ReceiptNo'];
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
		return "`TransNo` = @TransNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('TransNo', $row) ? $row['TransNo'] : NULL;
		else
			$val = $this->TransNo->OldValue !== NULL ? $this->TransNo->OldValue : $this->TransNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@TransNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "market_translist.php";
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
		if ($pageName == "market_transview.php")
			return $Language->phrase("View");
		elseif ($pageName == "market_transedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "market_transadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "market_translist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("market_transview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("market_transview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "market_transadd.php?" . $this->getUrlParm($parm);
		else
			$url = "market_transadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("market_transedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("market_transadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("market_transdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "market_property" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_MarketItemNo=" . urlencode($this->MarketItemNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "TransNo:" . JsonEncode($this->TransNo->CurrentValue, "number");
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
		if ($this->TransNo->CurrentValue != NULL) {
			$url .= "TransNo=" . urlencode($this->TransNo->CurrentValue);
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
			if (Param("TransNo") !== NULL)
				$arKeys[] = Param("TransNo");
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
				$this->TransNo->CurrentValue = $key;
			else
				$this->TransNo->OldValue = $key;
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
		$this->TransNo->setDbValue($rs->fields('TransNo'));
		$this->MarketItemNo->setDbValue($rs->fields('MarketItemNo'));
		$this->DateHired->setDbValue($rs->fields('DateHired'));
		$this->MartketeerName->setDbValue($rs->fields('MartketeerName'));
		$this->MartketeerID->setDbValue($rs->fields('MartketeerID'));
		$this->AmountDue->setDbValue($rs->fields('AmountDue'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->ReceiptNo->setDbValue($rs->fields('ReceiptNo'));
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
		// TransNo
		// MarketItemNo
		// DateHired
		// MartketeerName
		// MartketeerID
		// AmountDue
		// AmountPaid
		// ReceiptNo
		// LastUpdatedBy
		// LastUpdateDate
		// TransNo

		$this->TransNo->ViewValue = $this->TransNo->CurrentValue;
		$this->TransNo->ViewCustomAttributes = "";

		// MarketItemNo
		$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
		$this->MarketItemNo->ViewCustomAttributes = "";

		// DateHired
		$this->DateHired->ViewValue = $this->DateHired->CurrentValue;
		$this->DateHired->ViewValue = FormatDateTime($this->DateHired->ViewValue, 0);
		$this->DateHired->ViewCustomAttributes = "";

		// MartketeerName
		$this->MartketeerName->ViewValue = $this->MartketeerName->CurrentValue;
		$this->MartketeerName->ViewCustomAttributes = "";

		// MartketeerID
		$this->MartketeerID->ViewValue = $this->MartketeerID->CurrentValue;
		$this->MartketeerID->ViewCustomAttributes = "";

		// AmountDue
		$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->AmountDue->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->AmountPaid->ViewCustomAttributes = "";

		// ReceiptNo
		$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// TransNo
		$this->TransNo->LinkCustomAttributes = "";
		$this->TransNo->HrefValue = "";
		$this->TransNo->TooltipValue = "";

		// MarketItemNo
		$this->MarketItemNo->LinkCustomAttributes = "";
		$this->MarketItemNo->HrefValue = "";
		$this->MarketItemNo->TooltipValue = "";

		// DateHired
		$this->DateHired->LinkCustomAttributes = "";
		$this->DateHired->HrefValue = "";
		$this->DateHired->TooltipValue = "";

		// MartketeerName
		$this->MartketeerName->LinkCustomAttributes = "";
		$this->MartketeerName->HrefValue = "";
		$this->MartketeerName->TooltipValue = "";

		// MartketeerID
		$this->MartketeerID->LinkCustomAttributes = "";
		$this->MartketeerID->HrefValue = "";
		$this->MartketeerID->TooltipValue = "";

		// AmountDue
		$this->AmountDue->LinkCustomAttributes = "";
		$this->AmountDue->HrefValue = "";
		$this->AmountDue->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// ReceiptNo
		$this->ReceiptNo->LinkCustomAttributes = "";
		$this->ReceiptNo->HrefValue = "";
		$this->ReceiptNo->TooltipValue = "";

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

		// TransNo
		$this->TransNo->EditAttrs["class"] = "form-control";
		$this->TransNo->EditCustomAttributes = "";
		$this->TransNo->EditValue = $this->TransNo->CurrentValue;
		$this->TransNo->ViewCustomAttributes = "";

		// MarketItemNo
		$this->MarketItemNo->EditAttrs["class"] = "form-control";
		$this->MarketItemNo->EditCustomAttributes = "";
		if ($this->MarketItemNo->getSessionValue() != "") {
			$this->MarketItemNo->CurrentValue = $this->MarketItemNo->getSessionValue();
			$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
			$this->MarketItemNo->ViewCustomAttributes = "";
		} else {
			$this->MarketItemNo->EditValue = $this->MarketItemNo->CurrentValue;
			$this->MarketItemNo->PlaceHolder = RemoveHtml($this->MarketItemNo->caption());
		}

		// DateHired
		$this->DateHired->EditAttrs["class"] = "form-control";
		$this->DateHired->EditCustomAttributes = "";
		$this->DateHired->EditValue = FormatDateTime($this->DateHired->CurrentValue, 8);
		$this->DateHired->PlaceHolder = RemoveHtml($this->DateHired->caption());

		// MartketeerName
		$this->MartketeerName->EditAttrs["class"] = "form-control";
		$this->MartketeerName->EditCustomAttributes = "";
		if (!$this->MartketeerName->Raw)
			$this->MartketeerName->CurrentValue = HtmlDecode($this->MartketeerName->CurrentValue);
		$this->MartketeerName->EditValue = $this->MartketeerName->CurrentValue;
		$this->MartketeerName->PlaceHolder = RemoveHtml($this->MartketeerName->caption());

		// MartketeerID
		$this->MartketeerID->EditAttrs["class"] = "form-control";
		$this->MartketeerID->EditCustomAttributes = "";
		if (!$this->MartketeerID->Raw)
			$this->MartketeerID->CurrentValue = HtmlDecode($this->MartketeerID->CurrentValue);
		$this->MartketeerID->EditValue = $this->MartketeerID->CurrentValue;
		$this->MartketeerID->PlaceHolder = RemoveHtml($this->MartketeerID->caption());

		// AmountDue
		$this->AmountDue->EditAttrs["class"] = "form-control";
		$this->AmountDue->EditCustomAttributes = "";
		$this->AmountDue->EditValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());
		if (strval($this->AmountDue->EditValue) != "" && is_numeric($this->AmountDue->EditValue))
			$this->AmountDue->EditValue = FormatNumber($this->AmountDue->EditValue, -2, -1, -2, 0);
		

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
		

		// ReceiptNo
		$this->ReceiptNo->EditAttrs["class"] = "form-control";
		$this->ReceiptNo->EditCustomAttributes = "";
		if (!$this->ReceiptNo->Raw)
			$this->ReceiptNo->CurrentValue = HtmlDecode($this->ReceiptNo->CurrentValue);
		$this->ReceiptNo->EditValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

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
					$doc->exportCaption($this->TransNo);
					$doc->exportCaption($this->MarketItemNo);
					$doc->exportCaption($this->DateHired);
					$doc->exportCaption($this->MartketeerName);
					$doc->exportCaption($this->MartketeerID);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->ReceiptNo);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
				} else {
					$doc->exportCaption($this->TransNo);
					$doc->exportCaption($this->MarketItemNo);
					$doc->exportCaption($this->DateHired);
					$doc->exportCaption($this->MartketeerName);
					$doc->exportCaption($this->MartketeerID);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->ReceiptNo);
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
						$doc->exportField($this->TransNo);
						$doc->exportField($this->MarketItemNo);
						$doc->exportField($this->DateHired);
						$doc->exportField($this->MartketeerName);
						$doc->exportField($this->MartketeerID);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->ReceiptNo);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
					} else {
						$doc->exportField($this->TransNo);
						$doc->exportField($this->MarketItemNo);
						$doc->exportField($this->DateHired);
						$doc->exportField($this->MartketeerName);
						$doc->exportField($this->MartketeerID);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->ReceiptNo);
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