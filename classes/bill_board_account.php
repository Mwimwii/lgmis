<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for bill_board_account
 */
class bill_board_account extends DbTable
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
	public $AccountNo;
	public $BillBoardNo;
	public $ClientID;
	public $BalanceBF;
	public $CurrentDemand;
	public $VAT;
	public $AmountPaid;
	public $BillPeriod;
	public $PeriodType;
	public $BillYear;
	public $StartDate;
	public $EndDate;
	public $LastUpdatedBy;
	public $LastUpdateDate;
	public $ClientSerNo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'bill_board_account';
		$this->TableName = 'bill_board_account';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`bill_board_account`";
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

		// AccountNo
		$this->AccountNo = new DbField('bill_board_account', 'bill_board_account', 'x_AccountNo', 'AccountNo', '`AccountNo`', '`AccountNo`', 3, 11, -1, FALSE, '`AccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->AccountNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->AccountNo->IsPrimaryKey = TRUE; // Primary key field
		$this->AccountNo->Sortable = TRUE; // Allow sort
		$this->AccountNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountNo'] = &$this->AccountNo;

		// BillBoardNo
		$this->BillBoardNo = new DbField('bill_board_account', 'bill_board_account', 'x_BillBoardNo', 'BillBoardNo', '`BillBoardNo`', '`BillBoardNo`', 3, 11, -1, FALSE, '`BillBoardNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillBoardNo->IsForeignKey = TRUE; // Foreign key field
		$this->BillBoardNo->Nullable = FALSE; // NOT NULL field
		$this->BillBoardNo->Required = TRUE; // Required field
		$this->BillBoardNo->Sortable = TRUE; // Allow sort
		$this->BillBoardNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillBoardNo'] = &$this->BillBoardNo;

		// ClientID
		$this->ClientID = new DbField('bill_board_account', 'bill_board_account', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// BalanceBF
		$this->BalanceBF = new DbField('bill_board_account', 'bill_board_account', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 22, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// CurrentDemand
		$this->CurrentDemand = new DbField('bill_board_account', 'bill_board_account', 'x_CurrentDemand', 'CurrentDemand', '`CurrentDemand`', '`CurrentDemand`', 5, 22, -1, FALSE, '`CurrentDemand`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CurrentDemand->Sortable = TRUE; // Allow sort
		$this->CurrentDemand->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['CurrentDemand'] = &$this->CurrentDemand;

		// VAT
		$this->VAT = new DbField('bill_board_account', 'bill_board_account', 'x_VAT', 'VAT', '`VAT`', '`VAT`', 5, 22, -1, FALSE, '`VAT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VAT->Sortable = TRUE; // Allow sort
		$this->VAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VAT'] = &$this->VAT;

		// AmountPaid
		$this->AmountPaid = new DbField('bill_board_account', 'bill_board_account', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// BillPeriod
		$this->BillPeriod = new DbField('bill_board_account', 'bill_board_account', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 1, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// PeriodType
		$this->PeriodType = new DbField('bill_board_account', 'bill_board_account', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 200, 1, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->PeriodType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PeriodType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PeriodType->Lookup = new Lookup('PeriodType', 'period_type', FALSE, 'Period_Type', ["PeriodTypeName","PeriodLength","UnitOfMeasure",""], [], [], [], [], [], [], '', '');
		$this->PeriodType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PeriodType'] = &$this->PeriodType;

		// BillYear
		$this->BillYear = new DbField('bill_board_account', 'bill_board_account', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// StartDate
		$this->StartDate = new DbField('bill_board_account', 'bill_board_account', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('bill_board_account', 'bill_board_account', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('bill_board_account', 'bill_board_account', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('bill_board_account', 'bill_board_account', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdateDate->Sortable = TRUE; // Allow sort
		$this->LastUpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdateDate'] = &$this->LastUpdateDate;

		// ClientSerNo
		$this->ClientSerNo = new DbField('bill_board_account', 'bill_board_account', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;
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
		if ($this->getCurrentMasterTable() == "bill_board") {
			if ($this->BillBoardNo->getSessionValue() != "")
				$masterFilter .= "`BillBoardNo`=" . QuotedValue($this->BillBoardNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "bill_board") {
			if ($this->BillBoardNo->getSessionValue() != "")
				$detailFilter .= "`BillBoardNo`=" . QuotedValue($this->BillBoardNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_bill_board()
	{
		return "`BillBoardNo`=@BillBoardNo@";
	}

	// Detail filter
	public function sqlDetailFilter_bill_board()
	{
		return "`BillBoardNo`=@BillBoardNo@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`bill_board_account`";
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
			$this->AccountNo->setDbValue($conn->insert_ID());
			$rs['AccountNo'] = $this->AccountNo->DbValue;
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
			if (array_key_exists('AccountNo', $rs))
				AddFilter($where, QuotedName('AccountNo', $this->Dbid) . '=' . QuotedValue($rs['AccountNo'], $this->AccountNo->DataType, $this->Dbid));
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
		$this->AccountNo->DbValue = $row['AccountNo'];
		$this->BillBoardNo->DbValue = $row['BillBoardNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->CurrentDemand->DbValue = $row['CurrentDemand'];
		$this->VAT->DbValue = $row['VAT'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->PeriodType->DbValue = $row['PeriodType'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
		$this->LastUpdatedBy->DbValue = $row['LastUpdatedBy'];
		$this->LastUpdateDate->DbValue = $row['LastUpdateDate'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`AccountNo` = @AccountNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('AccountNo', $row) ? $row['AccountNo'] : NULL;
		else
			$val = $this->AccountNo->OldValue !== NULL ? $this->AccountNo->OldValue : $this->AccountNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@AccountNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "bill_board_accountlist.php";
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
		if ($pageName == "bill_board_accountview.php")
			return $Language->phrase("View");
		elseif ($pageName == "bill_board_accountedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "bill_board_accountadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "bill_board_accountlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("bill_board_accountview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("bill_board_accountview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "bill_board_accountadd.php?" . $this->getUrlParm($parm);
		else
			$url = "bill_board_accountadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("bill_board_accountedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("bill_board_accountadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("bill_board_accountdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "bill_board" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_BillBoardNo=" . urlencode($this->BillBoardNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "AccountNo:" . JsonEncode($this->AccountNo->CurrentValue, "number");
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
		if ($this->AccountNo->CurrentValue != NULL) {
			$url .= "AccountNo=" . urlencode($this->AccountNo->CurrentValue);
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
			if (Param("AccountNo") !== NULL)
				$arKeys[] = Param("AccountNo");
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
				$this->AccountNo->CurrentValue = $key;
			else
				$this->AccountNo->OldValue = $key;
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
		$this->AccountNo->setDbValue($rs->fields('AccountNo'));
		$this->BillBoardNo->setDbValue($rs->fields('BillBoardNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->CurrentDemand->setDbValue($rs->fields('CurrentDemand'));
		$this->VAT->setDbValue($rs->fields('VAT'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->PeriodType->setDbValue($rs->fields('PeriodType'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
		$this->LastUpdatedBy->setDbValue($rs->fields('LastUpdatedBy'));
		$this->LastUpdateDate->setDbValue($rs->fields('LastUpdateDate'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// AccountNo
		// BillBoardNo
		// ClientID
		// BalanceBF
		// CurrentDemand
		// VAT
		// AmountPaid
		// BillPeriod
		// PeriodType
		// BillYear
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate
		// ClientSerNo
		// AccountNo

		$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
		$this->AccountNo->ViewCustomAttributes = "";

		// BillBoardNo
		$this->BillBoardNo->ViewValue = $this->BillBoardNo->CurrentValue;
		$this->BillBoardNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// BalanceBF
		$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
		$this->BalanceBF->CellCssStyle .= "text-align: right;";
		$this->BalanceBF->ViewCustomAttributes = "";

		// CurrentDemand
		$this->CurrentDemand->ViewValue = $this->CurrentDemand->CurrentValue;
		$this->CurrentDemand->ViewValue = FormatNumber($this->CurrentDemand->ViewValue, 2, -2, -2, -2);
		$this->CurrentDemand->CellCssStyle .= "text-align: right;";
		$this->CurrentDemand->ViewCustomAttributes = "";

		// VAT
		$this->VAT->ViewValue = $this->VAT->CurrentValue;
		$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
		$this->VAT->CellCssStyle .= "text-align: right;";
		$this->VAT->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->CellCssStyle .= "text-align: right;";
		$this->AmountPaid->ViewCustomAttributes = "";

		// BillPeriod
		$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->ViewCustomAttributes = "";

		// PeriodType
		$curVal = strval($this->PeriodType->CurrentValue);
		if ($curVal != "") {
			$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$arwrk[3] = $rswrk->fields('df3');
					$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
				}
			}
		} else {
			$this->PeriodType->ViewValue = NULL;
		}
		$this->PeriodType->ViewCustomAttributes = "";

		// BillYear
		$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
		$this->BillYear->ViewCustomAttributes = "";

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

		// ClientSerNo
		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewCustomAttributes = "";

		// AccountNo
		$this->AccountNo->LinkCustomAttributes = "";
		$this->AccountNo->HrefValue = "";
		$this->AccountNo->TooltipValue = "";

		// BillBoardNo
		$this->BillBoardNo->LinkCustomAttributes = "";
		$this->BillBoardNo->HrefValue = "";
		$this->BillBoardNo->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// BalanceBF
		$this->BalanceBF->LinkCustomAttributes = "";
		$this->BalanceBF->HrefValue = "";
		$this->BalanceBF->TooltipValue = "";

		// CurrentDemand
		$this->CurrentDemand->LinkCustomAttributes = "";
		$this->CurrentDemand->HrefValue = "";
		$this->CurrentDemand->TooltipValue = "";

		// VAT
		$this->VAT->LinkCustomAttributes = "";
		$this->VAT->HrefValue = "";
		$this->VAT->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// BillPeriod
		$this->BillPeriod->LinkCustomAttributes = "";
		$this->BillPeriod->HrefValue = "";
		$this->BillPeriod->TooltipValue = "";

		// PeriodType
		$this->PeriodType->LinkCustomAttributes = "";
		$this->PeriodType->HrefValue = "";
		$this->PeriodType->TooltipValue = "";

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

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

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

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

		// AccountNo
		$this->AccountNo->EditAttrs["class"] = "form-control";
		$this->AccountNo->EditCustomAttributes = "";
		$this->AccountNo->EditValue = $this->AccountNo->CurrentValue;
		$this->AccountNo->ViewCustomAttributes = "";

		// BillBoardNo
		$this->BillBoardNo->EditAttrs["class"] = "form-control";
		$this->BillBoardNo->EditCustomAttributes = "";
		if ($this->BillBoardNo->getSessionValue() != "") {
			$this->BillBoardNo->CurrentValue = $this->BillBoardNo->getSessionValue();
			$this->BillBoardNo->ViewValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->ViewCustomAttributes = "";
		} else {
			$this->BillBoardNo->EditValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->PlaceHolder = RemoveHtml($this->BillBoardNo->caption());
		}

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// BalanceBF
		$this->BalanceBF->EditAttrs["class"] = "form-control";
		$this->BalanceBF->EditCustomAttributes = "";
		$this->BalanceBF->EditValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
		if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
			$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, -2, -2, -2);
		

		// CurrentDemand
		$this->CurrentDemand->EditAttrs["class"] = "form-control";
		$this->CurrentDemand->EditCustomAttributes = "";
		$this->CurrentDemand->EditValue = $this->CurrentDemand->CurrentValue;
		$this->CurrentDemand->PlaceHolder = RemoveHtml($this->CurrentDemand->caption());
		if (strval($this->CurrentDemand->EditValue) != "" && is_numeric($this->CurrentDemand->EditValue))
			$this->CurrentDemand->EditValue = FormatNumber($this->CurrentDemand->EditValue, -2, -2, -2, -2);
		

		// VAT
		$this->VAT->EditAttrs["class"] = "form-control";
		$this->VAT->EditCustomAttributes = "";
		$this->VAT->EditValue = $this->VAT->CurrentValue;
		$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());
		if (strval($this->VAT->EditValue) != "" && is_numeric($this->VAT->EditValue))
			$this->VAT->EditValue = FormatNumber($this->VAT->EditValue, -2, -2, -2, -2);
		

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
		

		// BillPeriod
		$this->BillPeriod->EditAttrs["class"] = "form-control";
		$this->BillPeriod->EditCustomAttributes = "";
		$this->BillPeriod->EditValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

		// PeriodType
		$this->PeriodType->EditAttrs["class"] = "form-control";
		$this->PeriodType->EditCustomAttributes = "";

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";
		$this->BillYear->EditValue = $this->BillYear->CurrentValue;
		$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

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

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

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
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->BillBoardNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->LastUpdatedBy);
				} else {
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->BillBoardNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->LastUpdatedBy);
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
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->BillBoardNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->LastUpdatedBy);
					} else {
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->BillBoardNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->LastUpdatedBy);
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