<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for business
 */
class business extends DbTable
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
	public $BusinessID;
	public $PACRANo;
	public $TPIN;
	public $BusinessName;
	public $ClientID;
	public $BusinessSector;
	public $BusinessType;
	public $Location;
	public $Turnover;
	public $Branches;
	public $NewImprovements;
	public $Longitude;
	public $Latitude;
	public $DateOpened;
	public $BusinessDesc;
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
		$this->TableVar = 'business';
		$this->TableName = 'business';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`business`";
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

		// BusinessID
		$this->BusinessID = new DbField('business', 'business', 'x_BusinessID', 'BusinessID', '`BusinessID`', '`BusinessID`', 3, 11, -1, FALSE, '`BusinessID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->BusinessID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->BusinessID->IsPrimaryKey = TRUE; // Primary key field
		$this->BusinessID->IsForeignKey = TRUE; // Foreign key field
		$this->BusinessID->Sortable = TRUE; // Allow sort
		$this->BusinessID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BusinessID'] = &$this->BusinessID;

		// PACRANo
		$this->PACRANo = new DbField('business', 'business', 'x_PACRANo', 'PACRANo', '`PACRANo`', '`PACRANo`', 3, 11, -1, FALSE, '`PACRANo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PACRANo->Nullable = FALSE; // NOT NULL field
		$this->PACRANo->Required = TRUE; // Required field
		$this->PACRANo->Sortable = TRUE; // Allow sort
		$this->PACRANo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PACRANo'] = &$this->PACRANo;

		// TPIN
		$this->TPIN = new DbField('business', 'business', 'x_TPIN', 'TPIN', '`TPIN`', '`TPIN`', 3, 11, -1, FALSE, '`TPIN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TPIN->Sortable = TRUE; // Allow sort
		$this->TPIN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TPIN'] = &$this->TPIN;

		// BusinessName
		$this->BusinessName = new DbField('business', 'business', 'x_BusinessName', 'BusinessName', '`BusinessName`', '`BusinessName`', 200, 255, -1, FALSE, '`BusinessName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BusinessName->Sortable = TRUE; // Allow sort
		$this->fields['BusinessName'] = &$this->BusinessName;

		// ClientID
		$this->ClientID = new DbField('business', 'business', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->ClientID->Lookup = new Lookup('ClientID', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientID","",""], [], [], [], [], [], [], '', '');
		$this->fields['ClientID'] = &$this->ClientID;

		// BusinessSector
		$this->BusinessSector = new DbField('business', 'business', 'x_BusinessSector', 'BusinessSector', '`BusinessSector`', '`BusinessSector`', 16, 3, -1, FALSE, '`BusinessSector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BusinessSector->Sortable = TRUE; // Allow sort
		$this->BusinessSector->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BusinessSector'] = &$this->BusinessSector;

		// BusinessType
		$this->BusinessType = new DbField('business', 'business', 'x_BusinessType', 'BusinessType', '`BusinessType`', '`BusinessType`', 16, 1, -1, FALSE, '`BusinessType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BusinessType->Sortable = TRUE; // Allow sort
		$this->BusinessType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BusinessType'] = &$this->BusinessType;

		// Location
		$this->Location = new DbField('business', 'business', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// Turnover
		$this->Turnover = new DbField('business', 'business', 'x_Turnover', 'Turnover', '`Turnover`', '`Turnover`', 5, 22, -1, FALSE, '`Turnover`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Turnover->Sortable = TRUE; // Allow sort
		$this->Turnover->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Turnover'] = &$this->Turnover;

		// Branches
		$this->Branches = new DbField('business', 'business', 'x_Branches', 'Branches', '`Branches`', '`Branches`', 200, 255, -1, FALSE, '`Branches`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Branches->Sortable = TRUE; // Allow sort
		$this->fields['Branches'] = &$this->Branches;

		// NewImprovements
		$this->NewImprovements = new DbField('business', 'business', 'x_NewImprovements', 'NewImprovements', '`NewImprovements`', '`NewImprovements`', 200, 255, -1, FALSE, '`NewImprovements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->NewImprovements->Sortable = TRUE; // Allow sort
		$this->fields['NewImprovements'] = &$this->NewImprovements;

		// Longitude
		$this->Longitude = new DbField('business', 'business', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 12, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// Latitude
		$this->Latitude = new DbField('business', 'business', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 12, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// DateOpened
		$this->DateOpened = new DbField('business', 'business', 'x_DateOpened', 'DateOpened', '`DateOpened`', CastDateFieldForLike("`DateOpened`", 0, "DB"), 133, 10, 0, FALSE, '`DateOpened`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOpened->Sortable = TRUE; // Allow sort
		$this->DateOpened->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOpened'] = &$this->DateOpened;

		// BusinessDesc
		$this->BusinessDesc = new DbField('business', 'business', 'x_BusinessDesc', 'BusinessDesc', '`BusinessDesc`', '`BusinessDesc`', 200, 255, -1, FALSE, '`BusinessDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->BusinessDesc->Sortable = TRUE; // Allow sort
		$this->fields['BusinessDesc'] = &$this->BusinessDesc;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('business', 'business', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('business', 'business', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentDetailTable() == "licence_account") {
			$detailUrl = $GLOBALS["licence_account"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_BusinessID=" . urlencode($this->BusinessID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "businesslist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`business`";
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
			$this->BusinessID->setDbValue($conn->insert_ID());
			$rs['BusinessID'] = $this->BusinessID->DbValue;
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

		// Cascade Update detail table 'licence_account'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['BusinessID']) && $rsold['BusinessID'] != $rs['BusinessID'])) { // Update detail field 'BusinessNo'
			$cascadeUpdate = TRUE;
			$rscascade['BusinessNo'] = $rs['BusinessID'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["licence_account"]))
				$GLOBALS["licence_account"] = new licence_account();
			$rswrk = $GLOBALS["licence_account"]->loadRs("`BusinessNo` = " . QuotedValue($rsold['BusinessID'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'LicenceNo';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["licence_account"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["licence_account"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["licence_account"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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
			if (array_key_exists('BusinessID', $rs))
				AddFilter($where, QuotedName('BusinessID', $this->Dbid) . '=' . QuotedValue($rs['BusinessID'], $this->BusinessID->DataType, $this->Dbid));
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

		// Cascade delete detail table 'licence_account'
		if (!isset($GLOBALS["licence_account"]))
			$GLOBALS["licence_account"] = new licence_account();
		$rscascade = $GLOBALS["licence_account"]->loadRs("`BusinessNo` = " . QuotedValue($rs['BusinessID'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["licence_account"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["licence_account"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["licence_account"]->Row_Deleted($dtlrow);
		}
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
		$this->BusinessID->DbValue = $row['BusinessID'];
		$this->PACRANo->DbValue = $row['PACRANo'];
		$this->TPIN->DbValue = $row['TPIN'];
		$this->BusinessName->DbValue = $row['BusinessName'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->BusinessSector->DbValue = $row['BusinessSector'];
		$this->BusinessType->DbValue = $row['BusinessType'];
		$this->Location->DbValue = $row['Location'];
		$this->Turnover->DbValue = $row['Turnover'];
		$this->Branches->DbValue = $row['Branches'];
		$this->NewImprovements->DbValue = $row['NewImprovements'];
		$this->Longitude->DbValue = $row['Longitude'];
		$this->Latitude->DbValue = $row['Latitude'];
		$this->DateOpened->DbValue = $row['DateOpened'];
		$this->BusinessDesc->DbValue = $row['BusinessDesc'];
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
		return "`BusinessID` = @BusinessID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('BusinessID', $row) ? $row['BusinessID'] : NULL;
		else
			$val = $this->BusinessID->OldValue !== NULL ? $this->BusinessID->OldValue : $this->BusinessID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@BusinessID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "businesslist.php";
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
		if ($pageName == "businessview.php")
			return $Language->phrase("View");
		elseif ($pageName == "businessedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "businessadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "businesslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("businessview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("businessview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "businessadd.php?" . $this->getUrlParm($parm);
		else
			$url = "businessadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("businessedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("businessedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("businessadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("businessadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("businessdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "BusinessID:" . JsonEncode($this->BusinessID->CurrentValue, "number");
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
		if ($this->BusinessID->CurrentValue != NULL) {
			$url .= "BusinessID=" . urlencode($this->BusinessID->CurrentValue);
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
			if (Param("BusinessID") !== NULL)
				$arKeys[] = Param("BusinessID");
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
				$this->BusinessID->CurrentValue = $key;
			else
				$this->BusinessID->OldValue = $key;
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
		$this->BusinessID->setDbValue($rs->fields('BusinessID'));
		$this->PACRANo->setDbValue($rs->fields('PACRANo'));
		$this->TPIN->setDbValue($rs->fields('TPIN'));
		$this->BusinessName->setDbValue($rs->fields('BusinessName'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->BusinessSector->setDbValue($rs->fields('BusinessSector'));
		$this->BusinessType->setDbValue($rs->fields('BusinessType'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->Turnover->setDbValue($rs->fields('Turnover'));
		$this->Branches->setDbValue($rs->fields('Branches'));
		$this->NewImprovements->setDbValue($rs->fields('NewImprovements'));
		$this->Longitude->setDbValue($rs->fields('Longitude'));
		$this->Latitude->setDbValue($rs->fields('Latitude'));
		$this->DateOpened->setDbValue($rs->fields('DateOpened'));
		$this->BusinessDesc->setDbValue($rs->fields('BusinessDesc'));
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
		// BusinessID
		// PACRANo
		// TPIN
		// BusinessName
		// ClientID
		// BusinessSector
		// BusinessType
		// Location
		// Turnover
		// Branches
		// NewImprovements
		// Longitude
		// Latitude
		// DateOpened
		// BusinessDesc
		// LastUpdatedBy
		// LastUpdateDate
		// BusinessID

		$this->BusinessID->ViewValue = $this->BusinessID->CurrentValue;
		$this->BusinessID->ViewCustomAttributes = "";

		// PACRANo
		$this->PACRANo->ViewValue = $this->PACRANo->CurrentValue;
		$this->PACRANo->ViewCustomAttributes = "";

		// TPIN
		$this->TPIN->ViewValue = $this->TPIN->CurrentValue;
		$this->TPIN->ViewCustomAttributes = "";

		// BusinessName
		$this->BusinessName->ViewValue = $this->BusinessName->CurrentValue;
		$this->BusinessName->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$curVal = strval($this->ClientID->CurrentValue);
		if ($curVal != "") {
			$this->ClientID->ViewValue = $this->ClientID->lookupCacheOption($curVal);
			if ($this->ClientID->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ClientID->ViewValue = $this->ClientID->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
				}
			}
		} else {
			$this->ClientID->ViewValue = NULL;
		}
		$this->ClientID->ViewCustomAttributes = "";

		// BusinessSector
		$this->BusinessSector->ViewValue = $this->BusinessSector->CurrentValue;
		$this->BusinessSector->ViewCustomAttributes = "";

		// BusinessType
		$this->BusinessType->ViewValue = $this->BusinessType->CurrentValue;
		$this->BusinessType->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// Turnover
		$this->Turnover->ViewValue = $this->Turnover->CurrentValue;
		$this->Turnover->ViewValue = FormatNumber($this->Turnover->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Turnover->ViewCustomAttributes = "";

		// Branches
		$this->Branches->ViewValue = $this->Branches->CurrentValue;
		$this->Branches->ViewCustomAttributes = "";

		// NewImprovements
		$this->NewImprovements->ViewValue = $this->NewImprovements->CurrentValue;
		$this->NewImprovements->ViewCustomAttributes = "";

		// Longitude
		$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Longitude->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Latitude->ViewCustomAttributes = "";

		// DateOpened
		$this->DateOpened->ViewValue = $this->DateOpened->CurrentValue;
		$this->DateOpened->ViewValue = FormatDateTime($this->DateOpened->ViewValue, 0);
		$this->DateOpened->ViewCustomAttributes = "";

		// BusinessDesc
		$this->BusinessDesc->ViewValue = $this->BusinessDesc->CurrentValue;
		$this->BusinessDesc->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// BusinessID
		$this->BusinessID->LinkCustomAttributes = "";
		$this->BusinessID->HrefValue = "";
		$this->BusinessID->TooltipValue = "";

		// PACRANo
		$this->PACRANo->LinkCustomAttributes = "";
		$this->PACRANo->HrefValue = "";
		$this->PACRANo->TooltipValue = "";

		// TPIN
		$this->TPIN->LinkCustomAttributes = "";
		$this->TPIN->HrefValue = "";
		$this->TPIN->TooltipValue = "";

		// BusinessName
		$this->BusinessName->LinkCustomAttributes = "";
		$this->BusinessName->HrefValue = "";
		$this->BusinessName->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// BusinessSector
		$this->BusinessSector->LinkCustomAttributes = "";
		$this->BusinessSector->HrefValue = "";
		$this->BusinessSector->TooltipValue = "";

		// BusinessType
		$this->BusinessType->LinkCustomAttributes = "";
		$this->BusinessType->HrefValue = "";
		$this->BusinessType->TooltipValue = "";

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// Turnover
		$this->Turnover->LinkCustomAttributes = "";
		$this->Turnover->HrefValue = "";
		$this->Turnover->TooltipValue = "";

		// Branches
		$this->Branches->LinkCustomAttributes = "";
		$this->Branches->HrefValue = "";
		$this->Branches->TooltipValue = "";

		// NewImprovements
		$this->NewImprovements->LinkCustomAttributes = "";
		$this->NewImprovements->HrefValue = "";
		$this->NewImprovements->TooltipValue = "";

		// Longitude
		$this->Longitude->LinkCustomAttributes = "";
		$this->Longitude->HrefValue = "";
		$this->Longitude->TooltipValue = "";

		// Latitude
		$this->Latitude->LinkCustomAttributes = "";
		$this->Latitude->HrefValue = "";
		$this->Latitude->TooltipValue = "";

		// DateOpened
		$this->DateOpened->LinkCustomAttributes = "";
		$this->DateOpened->HrefValue = "";
		$this->DateOpened->TooltipValue = "";

		// BusinessDesc
		$this->BusinessDesc->LinkCustomAttributes = "";
		$this->BusinessDesc->HrefValue = "";
		$this->BusinessDesc->TooltipValue = "";

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

		// BusinessID
		$this->BusinessID->EditAttrs["class"] = "form-control";
		$this->BusinessID->EditCustomAttributes = "";
		$this->BusinessID->EditValue = $this->BusinessID->CurrentValue;
		$this->BusinessID->ViewCustomAttributes = "";

		// PACRANo
		$this->PACRANo->EditAttrs["class"] = "form-control";
		$this->PACRANo->EditCustomAttributes = "";
		$this->PACRANo->EditValue = $this->PACRANo->CurrentValue;
		$this->PACRANo->PlaceHolder = RemoveHtml($this->PACRANo->caption());

		// TPIN
		$this->TPIN->EditAttrs["class"] = "form-control";
		$this->TPIN->EditCustomAttributes = "";
		$this->TPIN->EditValue = $this->TPIN->CurrentValue;
		$this->TPIN->PlaceHolder = RemoveHtml($this->TPIN->caption());

		// BusinessName
		$this->BusinessName->EditAttrs["class"] = "form-control";
		$this->BusinessName->EditCustomAttributes = "";
		if (!$this->BusinessName->Raw)
			$this->BusinessName->CurrentValue = HtmlDecode($this->BusinessName->CurrentValue);
		$this->BusinessName->EditValue = $this->BusinessName->CurrentValue;
		$this->BusinessName->PlaceHolder = RemoveHtml($this->BusinessName->caption());

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// BusinessSector
		$this->BusinessSector->EditAttrs["class"] = "form-control";
		$this->BusinessSector->EditCustomAttributes = "";
		$this->BusinessSector->EditValue = $this->BusinessSector->CurrentValue;
		$this->BusinessSector->PlaceHolder = RemoveHtml($this->BusinessSector->caption());

		// BusinessType
		$this->BusinessType->EditAttrs["class"] = "form-control";
		$this->BusinessType->EditCustomAttributes = "";
		$this->BusinessType->EditValue = $this->BusinessType->CurrentValue;
		$this->BusinessType->PlaceHolder = RemoveHtml($this->BusinessType->caption());

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (!$this->Location->Raw)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// Turnover
		$this->Turnover->EditAttrs["class"] = "form-control";
		$this->Turnover->EditCustomAttributes = "";
		$this->Turnover->EditValue = $this->Turnover->CurrentValue;
		$this->Turnover->PlaceHolder = RemoveHtml($this->Turnover->caption());
		if (strval($this->Turnover->EditValue) != "" && is_numeric($this->Turnover->EditValue))
			$this->Turnover->EditValue = FormatNumber($this->Turnover->EditValue, -2, -1, -2, 0);
		

		// Branches
		$this->Branches->EditAttrs["class"] = "form-control";
		$this->Branches->EditCustomAttributes = "";
		if (!$this->Branches->Raw)
			$this->Branches->CurrentValue = HtmlDecode($this->Branches->CurrentValue);
		$this->Branches->EditValue = $this->Branches->CurrentValue;
		$this->Branches->PlaceHolder = RemoveHtml($this->Branches->caption());

		// NewImprovements
		$this->NewImprovements->EditAttrs["class"] = "form-control";
		$this->NewImprovements->EditCustomAttributes = "";
		$this->NewImprovements->EditValue = $this->NewImprovements->CurrentValue;
		$this->NewImprovements->PlaceHolder = RemoveHtml($this->NewImprovements->caption());

		// Longitude
		$this->Longitude->EditAttrs["class"] = "form-control";
		$this->Longitude->EditCustomAttributes = "";
		$this->Longitude->EditValue = $this->Longitude->CurrentValue;
		$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
		if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
			$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
		

		// Latitude
		$this->Latitude->EditAttrs["class"] = "form-control";
		$this->Latitude->EditCustomAttributes = "";
		$this->Latitude->EditValue = $this->Latitude->CurrentValue;
		$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
		if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
			$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
		

		// DateOpened
		$this->DateOpened->EditAttrs["class"] = "form-control";
		$this->DateOpened->EditCustomAttributes = "";
		$this->DateOpened->EditValue = FormatDateTime($this->DateOpened->CurrentValue, 8);
		$this->DateOpened->PlaceHolder = RemoveHtml($this->DateOpened->caption());

		// BusinessDesc
		$this->BusinessDesc->EditAttrs["class"] = "form-control";
		$this->BusinessDesc->EditCustomAttributes = "";
		$this->BusinessDesc->EditValue = $this->BusinessDesc->CurrentValue;
		$this->BusinessDesc->PlaceHolder = RemoveHtml($this->BusinessDesc->caption());

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
					$doc->exportCaption($this->BusinessID);
					$doc->exportCaption($this->PACRANo);
					$doc->exportCaption($this->TPIN);
					$doc->exportCaption($this->BusinessName);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BusinessSector);
					$doc->exportCaption($this->BusinessType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->Turnover);
					$doc->exportCaption($this->Branches);
					$doc->exportCaption($this->NewImprovements);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->DateOpened);
					$doc->exportCaption($this->BusinessDesc);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
				} else {
					$doc->exportCaption($this->BusinessID);
					$doc->exportCaption($this->PACRANo);
					$doc->exportCaption($this->TPIN);
					$doc->exportCaption($this->BusinessName);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BusinessSector);
					$doc->exportCaption($this->BusinessType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->Turnover);
					$doc->exportCaption($this->Branches);
					$doc->exportCaption($this->NewImprovements);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->DateOpened);
					$doc->exportCaption($this->BusinessDesc);
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
						$doc->exportField($this->BusinessID);
						$doc->exportField($this->PACRANo);
						$doc->exportField($this->TPIN);
						$doc->exportField($this->BusinessName);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BusinessSector);
						$doc->exportField($this->BusinessType);
						$doc->exportField($this->Location);
						$doc->exportField($this->Turnover);
						$doc->exportField($this->Branches);
						$doc->exportField($this->NewImprovements);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->DateOpened);
						$doc->exportField($this->BusinessDesc);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
					} else {
						$doc->exportField($this->BusinessID);
						$doc->exportField($this->PACRANo);
						$doc->exportField($this->TPIN);
						$doc->exportField($this->BusinessName);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BusinessSector);
						$doc->exportField($this->BusinessType);
						$doc->exportField($this->Location);
						$doc->exportField($this->Turnover);
						$doc->exportField($this->Branches);
						$doc->exportField($this->NewImprovements);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->DateOpened);
						$doc->exportField($this->BusinessDesc);
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