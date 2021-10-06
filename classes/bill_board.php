<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for bill_board
 */
class bill_board extends DbTable
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
	public $BillBoardNo;
	public $BoardStandNo;
	public $ClientSerNo;
	public $ClientID;
	public $BoardLength;
	public $BoardWidth;
	public $BoardSize;
	public $BoardType;
	public $BoardLocation;
	public $BoardStatus;
	public $ExemptCode;
	public $StreetAddress;
	public $Longitude;
	public $Latitude;
	public $Incumberance;
	public $StartDate;
	public $EndDate;
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
		$this->TableVar = 'bill_board';
		$this->TableName = 'bill_board';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`bill_board`";
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

		// BillBoardNo
		$this->BillBoardNo = new DbField('bill_board', 'bill_board', 'x_BillBoardNo', 'BillBoardNo', '`BillBoardNo`', '`BillBoardNo`', 3, 11, -1, FALSE, '`BillBoardNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->BillBoardNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->BillBoardNo->IsPrimaryKey = TRUE; // Primary key field
		$this->BillBoardNo->IsForeignKey = TRUE; // Foreign key field
		$this->BillBoardNo->Sortable = TRUE; // Allow sort
		$this->BillBoardNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillBoardNo'] = &$this->BillBoardNo;

		// BoardStandNo
		$this->BoardStandNo = new DbField('bill_board', 'bill_board', 'x_BoardStandNo', 'BoardStandNo', '`BoardStandNo`', '`BoardStandNo`', 200, 255, -1, FALSE, '`BoardStandNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardStandNo->Sortable = TRUE; // Allow sort
		$this->fields['BoardStandNo'] = &$this->BoardStandNo;

		// ClientSerNo
		$this->ClientSerNo = new DbField('bill_board', 'bill_board', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientSerNo","ClientID",""], [], [], [], [], [], [], '', '');
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientID
		$this->ClientID = new DbField('bill_board', 'bill_board', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// BoardLength
		$this->BoardLength = new DbField('bill_board', 'bill_board', 'x_BoardLength', 'BoardLength', '`BoardLength`', '`BoardLength`', 5, 22, -1, FALSE, '`BoardLength`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardLength->Sortable = TRUE; // Allow sort
		$this->BoardLength->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BoardLength'] = &$this->BoardLength;

		// BoardWidth
		$this->BoardWidth = new DbField('bill_board', 'bill_board', 'x_BoardWidth', 'BoardWidth', '`BoardWidth`', '`BoardWidth`', 5, 22, -1, FALSE, '`BoardWidth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardWidth->Sortable = TRUE; // Allow sort
		$this->BoardWidth->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BoardWidth'] = &$this->BoardWidth;

		// BoardSize
		$this->BoardSize = new DbField('bill_board', 'bill_board', 'x_BoardSize', 'BoardSize', '`BoardSize`', '`BoardSize`', 5, 22, -1, FALSE, '`BoardSize`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardSize->Sortable = TRUE; // Allow sort
		$this->BoardSize->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BoardSize'] = &$this->BoardSize;

		// BoardType
		$this->BoardType = new DbField('bill_board', 'bill_board', 'x_BoardType', 'BoardType', '`BoardType`', '`BoardType`', 16, 1, -1, FALSE, '`BoardType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BoardType->Sortable = TRUE; // Allow sort
		$this->BoardType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BoardType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BoardType->Lookup = new Lookup('BoardType', 'board_type', FALSE, 'BoardType', ["BoardTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->BoardType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BoardType'] = &$this->BoardType;

		// BoardLocation
		$this->BoardLocation = new DbField('bill_board', 'bill_board', 'x_BoardLocation', 'BoardLocation', '`BoardLocation`', '`BoardLocation`', 200, 255, -1, FALSE, '`BoardLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardLocation->Sortable = TRUE; // Allow sort
		$this->fields['BoardLocation'] = &$this->BoardLocation;

		// BoardStatus
		$this->BoardStatus = new DbField('bill_board', 'bill_board', 'x_BoardStatus', 'BoardStatus', '`BoardStatus`', '`BoardStatus`', 16, 1, -1, FALSE, '`BoardStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoardStatus->Sortable = TRUE; // Allow sort
		$this->BoardStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BoardStatus'] = &$this->BoardStatus;

		// ExemptCode
		$this->ExemptCode = new DbField('bill_board', 'bill_board', 'x_ExemptCode', 'ExemptCode', '`ExemptCode`', '`ExemptCode`', 16, 1, -1, FALSE, '`ExemptCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExemptCode->Sortable = TRUE; // Allow sort
		$this->ExemptCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ExemptCode'] = &$this->ExemptCode;

		// StreetAddress
		$this->StreetAddress = new DbField('bill_board', 'bill_board', 'x_StreetAddress', 'StreetAddress', '`StreetAddress`', '`StreetAddress`', 200, 255, -1, FALSE, '`StreetAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StreetAddress->Sortable = TRUE; // Allow sort
		$this->fields['StreetAddress'] = &$this->StreetAddress;

		// Longitude
		$this->Longitude = new DbField('bill_board', 'bill_board', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 12, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// Latitude
		$this->Latitude = new DbField('bill_board', 'bill_board', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 12, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// Incumberance
		$this->Incumberance = new DbField('bill_board', 'bill_board', 'x_Incumberance', 'Incumberance', '`Incumberance`', '`Incumberance`', 200, 1, -1, FALSE, '`Incumberance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Incumberance->Sortable = TRUE; // Allow sort
		$this->fields['Incumberance'] = &$this->Incumberance;

		// StartDate
		$this->StartDate = new DbField('bill_board', 'bill_board', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('bill_board', 'bill_board', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('bill_board', 'bill_board', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('bill_board', 'bill_board', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientSerNo->getSessionValue() != "")
				$masterFilter .= "`ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientSerNo->getSessionValue() != "")
				$detailFilter .= "`ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_client()
	{
		return "`ClientSerNo`=@ClientSerNo@";
	}

	// Detail filter
	public function sqlDetailFilter_client()
	{
		return "`ClientSerNo`=@ClientSerNo@";
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
		if ($this->getCurrentDetailTable() == "bill_board_account") {
			$detailUrl = $GLOBALS["bill_board_account"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_BillBoardNo=" . urlencode($this->BillBoardNo->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "bill_boardlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`bill_board`";
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
			$this->BillBoardNo->setDbValue($conn->insert_ID());
			$rs['BillBoardNo'] = $this->BillBoardNo->DbValue;
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
			if (array_key_exists('BillBoardNo', $rs))
				AddFilter($where, QuotedName('BillBoardNo', $this->Dbid) . '=' . QuotedValue($rs['BillBoardNo'], $this->BillBoardNo->DataType, $this->Dbid));
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
		$this->BillBoardNo->DbValue = $row['BillBoardNo'];
		$this->BoardStandNo->DbValue = $row['BoardStandNo'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->BoardLength->DbValue = $row['BoardLength'];
		$this->BoardWidth->DbValue = $row['BoardWidth'];
		$this->BoardSize->DbValue = $row['BoardSize'];
		$this->BoardType->DbValue = $row['BoardType'];
		$this->BoardLocation->DbValue = $row['BoardLocation'];
		$this->BoardStatus->DbValue = $row['BoardStatus'];
		$this->ExemptCode->DbValue = $row['ExemptCode'];
		$this->StreetAddress->DbValue = $row['StreetAddress'];
		$this->Longitude->DbValue = $row['Longitude'];
		$this->Latitude->DbValue = $row['Latitude'];
		$this->Incumberance->DbValue = $row['Incumberance'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
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
		return "`BillBoardNo` = @BillBoardNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('BillBoardNo', $row) ? $row['BillBoardNo'] : NULL;
		else
			$val = $this->BillBoardNo->OldValue !== NULL ? $this->BillBoardNo->OldValue : $this->BillBoardNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@BillBoardNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "bill_boardlist.php";
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
		if ($pageName == "bill_boardview.php")
			return $Language->phrase("View");
		elseif ($pageName == "bill_boardedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "bill_boardadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "bill_boardlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("bill_boardview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bill_boardview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "bill_boardadd.php?" . $this->getUrlParm($parm);
		else
			$url = "bill_boardadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("bill_boardedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bill_boardedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("bill_boardadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bill_boardadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("bill_boarddelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "client" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "BillBoardNo:" . JsonEncode($this->BillBoardNo->CurrentValue, "number");
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
		if ($this->BillBoardNo->CurrentValue != NULL) {
			$url .= "BillBoardNo=" . urlencode($this->BillBoardNo->CurrentValue);
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
			if (Param("BillBoardNo") !== NULL)
				$arKeys[] = Param("BillBoardNo");
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
				$this->BillBoardNo->CurrentValue = $key;
			else
				$this->BillBoardNo->OldValue = $key;
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
		$this->BillBoardNo->setDbValue($rs->fields('BillBoardNo'));
		$this->BoardStandNo->setDbValue($rs->fields('BoardStandNo'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->BoardLength->setDbValue($rs->fields('BoardLength'));
		$this->BoardWidth->setDbValue($rs->fields('BoardWidth'));
		$this->BoardSize->setDbValue($rs->fields('BoardSize'));
		$this->BoardType->setDbValue($rs->fields('BoardType'));
		$this->BoardLocation->setDbValue($rs->fields('BoardLocation'));
		$this->BoardStatus->setDbValue($rs->fields('BoardStatus'));
		$this->ExemptCode->setDbValue($rs->fields('ExemptCode'));
		$this->StreetAddress->setDbValue($rs->fields('StreetAddress'));
		$this->Longitude->setDbValue($rs->fields('Longitude'));
		$this->Latitude->setDbValue($rs->fields('Latitude'));
		$this->Incumberance->setDbValue($rs->fields('Incumberance'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
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
		// BillBoardNo
		// BoardStandNo
		// ClientSerNo
		// ClientID
		// BoardLength
		// BoardWidth
		// BoardSize
		// BoardType
		// BoardLocation
		// BoardStatus
		// ExemptCode
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate
		// BillBoardNo

		$this->BillBoardNo->ViewValue = $this->BillBoardNo->CurrentValue;
		$this->BillBoardNo->ViewCustomAttributes = "";

		// BoardStandNo
		$this->BoardStandNo->ViewValue = $this->BoardStandNo->CurrentValue;
		$this->BoardStandNo->ViewCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$curVal = strval($this->ClientSerNo->CurrentValue);
		if ($curVal != "") {
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
			if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
				}
			}
		} else {
			$this->ClientSerNo->ViewValue = NULL;
		}
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// BoardLength
		$this->BoardLength->ViewValue = $this->BoardLength->CurrentValue;
		$this->BoardLength->ViewValue = FormatNumber($this->BoardLength->ViewValue, 2, -2, -2, -2);
		$this->BoardLength->CellCssStyle .= "text-align: right;";
		$this->BoardLength->ViewCustomAttributes = "";

		// BoardWidth
		$this->BoardWidth->ViewValue = $this->BoardWidth->CurrentValue;
		$this->BoardWidth->ViewValue = FormatNumber($this->BoardWidth->ViewValue, 2, -2, -2, -2);
		$this->BoardWidth->CellCssStyle .= "text-align: right;";
		$this->BoardWidth->ViewCustomAttributes = "";

		// BoardSize
		$this->BoardSize->ViewValue = $this->BoardSize->CurrentValue;
		$this->BoardSize->ViewValue = FormatNumber($this->BoardSize->ViewValue, 2, -2, -2, -2);
		$this->BoardSize->CellCssStyle .= "text-align: right;";
		$this->BoardSize->ViewCustomAttributes = "";

		// BoardType
		$curVal = strval($this->BoardType->CurrentValue);
		if ($curVal != "") {
			$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
			if ($this->BoardType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`BoardType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BoardType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BoardType->ViewValue = $this->BoardType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BoardType->ViewValue = $this->BoardType->CurrentValue;
				}
			}
		} else {
			$this->BoardType->ViewValue = NULL;
		}
		$this->BoardType->ViewCustomAttributes = "";

		// BoardLocation
		$this->BoardLocation->ViewValue = $this->BoardLocation->CurrentValue;
		$this->BoardLocation->ViewCustomAttributes = "";

		// BoardStatus
		$this->BoardStatus->ViewValue = $this->BoardStatus->CurrentValue;
		$this->BoardStatus->ViewCustomAttributes = "";

		// ExemptCode
		$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->ViewCustomAttributes = "";

		// StreetAddress
		$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
		$this->StreetAddress->ViewCustomAttributes = "";

		// Longitude
		$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Longitude->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Latitude->ViewCustomAttributes = "";

		// Incumberance
		$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
		$this->Incumberance->ViewCustomAttributes = "";

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// EndDate
		$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
		$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
		$this->EndDate->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// BillBoardNo
		$this->BillBoardNo->LinkCustomAttributes = "";
		$this->BillBoardNo->HrefValue = "";
		$this->BillBoardNo->TooltipValue = "";

		// BoardStandNo
		$this->BoardStandNo->LinkCustomAttributes = "";
		$this->BoardStandNo->HrefValue = "";
		$this->BoardStandNo->TooltipValue = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// BoardLength
		$this->BoardLength->LinkCustomAttributes = "";
		$this->BoardLength->HrefValue = "";
		$this->BoardLength->TooltipValue = "";

		// BoardWidth
		$this->BoardWidth->LinkCustomAttributes = "";
		$this->BoardWidth->HrefValue = "";
		$this->BoardWidth->TooltipValue = "";

		// BoardSize
		$this->BoardSize->LinkCustomAttributes = "";
		$this->BoardSize->HrefValue = "";
		$this->BoardSize->TooltipValue = "";

		// BoardType
		$this->BoardType->LinkCustomAttributes = "";
		$this->BoardType->HrefValue = "";
		$this->BoardType->TooltipValue = "";

		// BoardLocation
		$this->BoardLocation->LinkCustomAttributes = "";
		$this->BoardLocation->HrefValue = "";
		$this->BoardLocation->TooltipValue = "";

		// BoardStatus
		$this->BoardStatus->LinkCustomAttributes = "";
		$this->BoardStatus->HrefValue = "";
		$this->BoardStatus->TooltipValue = "";

		// ExemptCode
		$this->ExemptCode->LinkCustomAttributes = "";
		$this->ExemptCode->HrefValue = "";
		$this->ExemptCode->TooltipValue = "";

		// StreetAddress
		$this->StreetAddress->LinkCustomAttributes = "";
		$this->StreetAddress->HrefValue = "";
		$this->StreetAddress->TooltipValue = "";

		// Longitude
		$this->Longitude->LinkCustomAttributes = "";
		$this->Longitude->HrefValue = "";
		$this->Longitude->TooltipValue = "";

		// Latitude
		$this->Latitude->LinkCustomAttributes = "";
		$this->Latitude->HrefValue = "";
		$this->Latitude->TooltipValue = "";

		// Incumberance
		$this->Incumberance->LinkCustomAttributes = "";
		$this->Incumberance->HrefValue = "";
		$this->Incumberance->TooltipValue = "";

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// EndDate
		$this->EndDate->LinkCustomAttributes = "";
		$this->EndDate->HrefValue = "";
		$this->EndDate->TooltipValue = "";

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

		// BillBoardNo
		$this->BillBoardNo->EditAttrs["class"] = "form-control";
		$this->BillBoardNo->EditCustomAttributes = "";
		$this->BillBoardNo->EditValue = $this->BillBoardNo->CurrentValue;
		$this->BillBoardNo->ViewCustomAttributes = "";

		// BoardStandNo
		$this->BoardStandNo->EditAttrs["class"] = "form-control";
		$this->BoardStandNo->EditCustomAttributes = "";
		if (!$this->BoardStandNo->Raw)
			$this->BoardStandNo->CurrentValue = HtmlDecode($this->BoardStandNo->CurrentValue);
		$this->BoardStandNo->EditValue = $this->BoardStandNo->CurrentValue;
		$this->BoardStandNo->PlaceHolder = RemoveHtml($this->BoardStandNo->caption());

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		if ($this->ClientSerNo->getSessionValue() != "") {
			$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
					}
				}
			} else {
				$this->ClientSerNo->ViewValue = NULL;
			}
			$this->ClientSerNo->ViewCustomAttributes = "";
		} else {
			$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
			$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
		}

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// BoardLength
		$this->BoardLength->EditAttrs["class"] = "form-control";
		$this->BoardLength->EditCustomAttributes = "";
		$this->BoardLength->EditValue = $this->BoardLength->CurrentValue;
		$this->BoardLength->PlaceHolder = RemoveHtml($this->BoardLength->caption());
		if (strval($this->BoardLength->EditValue) != "" && is_numeric($this->BoardLength->EditValue))
			$this->BoardLength->EditValue = FormatNumber($this->BoardLength->EditValue, -2, -2, -2, -2);
		

		// BoardWidth
		$this->BoardWidth->EditAttrs["class"] = "form-control";
		$this->BoardWidth->EditCustomAttributes = "";
		$this->BoardWidth->EditValue = $this->BoardWidth->CurrentValue;
		$this->BoardWidth->PlaceHolder = RemoveHtml($this->BoardWidth->caption());
		if (strval($this->BoardWidth->EditValue) != "" && is_numeric($this->BoardWidth->EditValue))
			$this->BoardWidth->EditValue = FormatNumber($this->BoardWidth->EditValue, -2, -2, -2, -2);
		

		// BoardSize
		$this->BoardSize->EditAttrs["class"] = "form-control";
		$this->BoardSize->EditCustomAttributes = "";
		$this->BoardSize->EditValue = $this->BoardSize->CurrentValue;
		$this->BoardSize->PlaceHolder = RemoveHtml($this->BoardSize->caption());
		if (strval($this->BoardSize->EditValue) != "" && is_numeric($this->BoardSize->EditValue))
			$this->BoardSize->EditValue = FormatNumber($this->BoardSize->EditValue, -2, -2, -2, -2);
		

		// BoardType
		$this->BoardType->EditAttrs["class"] = "form-control";
		$this->BoardType->EditCustomAttributes = "";

		// BoardLocation
		$this->BoardLocation->EditAttrs["class"] = "form-control";
		$this->BoardLocation->EditCustomAttributes = "";
		if (!$this->BoardLocation->Raw)
			$this->BoardLocation->CurrentValue = HtmlDecode($this->BoardLocation->CurrentValue);
		$this->BoardLocation->EditValue = $this->BoardLocation->CurrentValue;
		$this->BoardLocation->PlaceHolder = RemoveHtml($this->BoardLocation->caption());

		// BoardStatus
		$this->BoardStatus->EditAttrs["class"] = "form-control";
		$this->BoardStatus->EditCustomAttributes = "";
		$this->BoardStatus->EditValue = $this->BoardStatus->CurrentValue;
		$this->BoardStatus->PlaceHolder = RemoveHtml($this->BoardStatus->caption());

		// ExemptCode
		$this->ExemptCode->EditAttrs["class"] = "form-control";
		$this->ExemptCode->EditCustomAttributes = "";
		$this->ExemptCode->EditValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

		// StreetAddress
		$this->StreetAddress->EditAttrs["class"] = "form-control";
		$this->StreetAddress->EditCustomAttributes = "";
		if (!$this->StreetAddress->Raw)
			$this->StreetAddress->CurrentValue = HtmlDecode($this->StreetAddress->CurrentValue);
		$this->StreetAddress->EditValue = $this->StreetAddress->CurrentValue;
		$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

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
		

		// Incumberance
		$this->Incumberance->EditAttrs["class"] = "form-control";
		$this->Incumberance->EditCustomAttributes = "";
		if (!$this->Incumberance->Raw)
			$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
		$this->Incumberance->EditValue = $this->Incumberance->CurrentValue;
		$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

		// StartDate
		$this->StartDate->EditAttrs["class"] = "form-control";
		$this->StartDate->EditCustomAttributes = "";
		$this->StartDate->EditValue = FormatDateTime($this->StartDate->CurrentValue, 8);
		$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

		// EndDate
		$this->EndDate->EditAttrs["class"] = "form-control";
		$this->EndDate->EditCustomAttributes = "";
		$this->EndDate->EditValue = FormatDateTime($this->EndDate->CurrentValue, 8);
		$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

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
					$doc->exportCaption($this->BillBoardNo);
					$doc->exportCaption($this->BoardStandNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BoardLength);
					$doc->exportCaption($this->BoardWidth);
					$doc->exportCaption($this->BoardSize);
					$doc->exportCaption($this->BoardType);
					$doc->exportCaption($this->BoardLocation);
					$doc->exportCaption($this->BoardStatus);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->StreetAddress);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Incumberance);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
				} else {
					$doc->exportCaption($this->BillBoardNo);
					$doc->exportCaption($this->BoardStandNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BoardLength);
					$doc->exportCaption($this->BoardWidth);
					$doc->exportCaption($this->BoardSize);
					$doc->exportCaption($this->BoardType);
					$doc->exportCaption($this->BoardLocation);
					$doc->exportCaption($this->BoardStatus);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->StreetAddress);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Incumberance);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
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
						$doc->exportField($this->BillBoardNo);
						$doc->exportField($this->BoardStandNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BoardLength);
						$doc->exportField($this->BoardWidth);
						$doc->exportField($this->BoardSize);
						$doc->exportField($this->BoardType);
						$doc->exportField($this->BoardLocation);
						$doc->exportField($this->BoardStatus);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->StreetAddress);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Incumberance);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
					} else {
						$doc->exportField($this->BillBoardNo);
						$doc->exportField($this->BoardStandNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BoardLength);
						$doc->exportField($this->BoardWidth);
						$doc->exportField($this->BoardSize);
						$doc->exportField($this->BoardType);
						$doc->exportField($this->BoardLocation);
						$doc->exportField($this->BoardStatus);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->StreetAddress);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Incumberance);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
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