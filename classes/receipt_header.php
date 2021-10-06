<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for receipt_header
 */
class receipt_header extends DbTable
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
	public $ChargeGroup;
	public $ClientSerNo;
	public $ClientID;
	public $ClientPostalAddress;
	public $ClientPhysicalAddress;
	public $ClientEmail;
	public $ReceiptPrefix;
	public $AccountBased;
	public $Cashier;
	public $ReceiptNo;
	public $ReceiptDate;
	public $PaymentMethod;
	public $PaidBy;
	public $TotalDue;
	public $AmountTendered;
	public $Change;
	public $ClientMessage;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'receipt_header';
		$this->TableName = 'receipt_header';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`receipt_header`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 1; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ChargeGroup
		$this->ChargeGroup = new DbField('receipt_header', 'receipt_header', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 200, 2, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChargeGroup->IsForeignKey = TRUE; // Foreign key field
		$this->ChargeGroup->Nullable = FALSE; // NOT NULL field
		$this->ChargeGroup->Required = TRUE; // Required field
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChargeGroup->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChargeGroup->Lookup = new Lookup('ChargeGroup', 'charge_group', FALSE, 'ChargeGroup', ["ChargeGroupDesc","ChargeGroup","",""], [], ["receipt x_ChargeCode"], [], [], ["ChargeGroup","Account"], ["x_ReceiptPrefix","x_AccountBased"], '`ChargeGroupDesc` ASC', '');
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// ClientSerNo
		$this->ClientSerNo = new DbField('receipt_header', 'receipt_header', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Nullable = FALSE; // NOT NULL field
		$this->ClientSerNo->Required = TRUE; // Required field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientSerNo","",""], [], [], [], [], ["ClientID","PostalAddress","PhysicalAddress","Email","ClientName"], ["x_ClientID","x_ClientPostalAddress","x_ClientPhysicalAddress","x_ClientEmail","x_PaidBy"], '', '');
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientID
		$this->ClientID = new DbField('receipt_header', 'receipt_header', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// ClientPostalAddress
		$this->ClientPostalAddress = new DbField('receipt_header', 'receipt_header', 'x_ClientPostalAddress', 'ClientPostalAddress', '`ClientPostalAddress`', '`ClientPostalAddress`', 200, 255, -1, FALSE, '`ClientPostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientPostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['ClientPostalAddress'] = &$this->ClientPostalAddress;

		// ClientPhysicalAddress
		$this->ClientPhysicalAddress = new DbField('receipt_header', 'receipt_header', 'x_ClientPhysicalAddress', 'ClientPhysicalAddress', '`ClientPhysicalAddress`', '`ClientPhysicalAddress`', 200, 255, -1, FALSE, '`ClientPhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientPhysicalAddress->Sortable = TRUE; // Allow sort
		$this->fields['ClientPhysicalAddress'] = &$this->ClientPhysicalAddress;

		// ClientEmail
		$this->ClientEmail = new DbField('receipt_header', 'receipt_header', 'x_ClientEmail', 'ClientEmail', '`ClientEmail`', '`ClientEmail`', 200, 255, -1, FALSE, '`ClientEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientEmail->Sortable = TRUE; // Allow sort
		$this->fields['ClientEmail'] = &$this->ClientEmail;

		// ReceiptPrefix
		$this->ReceiptPrefix = new DbField('receipt_header', 'receipt_header', 'x_ReceiptPrefix', 'ReceiptPrefix', '`ReceiptPrefix`', '`ReceiptPrefix`', 200, 4, -1, FALSE, '`ReceiptPrefix`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiptPrefix->Nullable = FALSE; // NOT NULL field
		$this->ReceiptPrefix->Required = TRUE; // Required field
		$this->ReceiptPrefix->Sortable = TRUE; // Allow sort
		$this->fields['ReceiptPrefix'] = &$this->ReceiptPrefix;

		// AccountBased
		$this->AccountBased = new DbField('receipt_header', 'receipt_header', 'x_AccountBased', 'AccountBased', '`AccountBased`', '`AccountBased`', 16, 1, -1, FALSE, '`AccountBased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->AccountBased->Nullable = FALSE; // NOT NULL field
		$this->AccountBased->Required = TRUE; // Required field
		$this->AccountBased->Sortable = TRUE; // Allow sort
		$this->AccountBased->Lookup = new Lookup('AccountBased', 'yesno', FALSE, 'ChoiceCode', ["YesNo","","",""], [], [], [], [], [], [], '', '');
		$this->AccountBased->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AccountBased'] = &$this->AccountBased;

		// Cashier
		$this->Cashier = new DbField('receipt_header', 'receipt_header', 'x_Cashier', 'Cashier', '`Cashier`', '`Cashier`', 200, 255, -1, FALSE, '`Cashier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Cashier->Nullable = FALSE; // NOT NULL field
		$this->Cashier->Sortable = TRUE; // Allow sort
		$this->fields['Cashier'] = &$this->Cashier;

		// ReceiptNo
		$this->ReceiptNo = new DbField('receipt_header', 'receipt_header', 'x_ReceiptNo', 'ReceiptNo', '`ReceiptNo`', '`ReceiptNo`', 3, 11, -1, FALSE, '`ReceiptNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ReceiptNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ReceiptNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ReceiptNo->IsForeignKey = TRUE; // Foreign key field
		$this->ReceiptNo->Sortable = TRUE; // Allow sort
		$this->ReceiptNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReceiptNo'] = &$this->ReceiptNo;

		// ReceiptDate
		$this->ReceiptDate = new DbField('receipt_header', 'receipt_header', 'x_ReceiptDate', 'ReceiptDate', '`ReceiptDate`', CastDateFieldForLike("`ReceiptDate`", 7, "DB"), 135, 19, 7, FALSE, '`ReceiptDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiptDate->Sortable = TRUE; // Allow sort
		$this->ReceiptDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['ReceiptDate'] = &$this->ReceiptDate;

		// PaymentMethod
		$this->PaymentMethod = new DbField('receipt_header', 'receipt_header', 'x_PaymentMethod', 'PaymentMethod', '`PaymentMethod`', '`PaymentMethod`', 200, 2, -1, FALSE, '`PaymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PaymentMethod->IsForeignKey = TRUE; // Foreign key field
		$this->PaymentMethod->Nullable = FALSE; // NOT NULL field
		$this->PaymentMethod->Required = TRUE; // Required field
		$this->PaymentMethod->Sortable = TRUE; // Allow sort
		$this->PaymentMethod->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PaymentMethod->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PaymentMethod->Lookup = new Lookup('PaymentMethod', 'payment_method', FALSE, 'PaymentMethod', ["PaymentDesc","PaymentMethod","",""], [], [], [], [], [], [], '', '');
		$this->fields['PaymentMethod'] = &$this->PaymentMethod;

		// PaidBy
		$this->PaidBy = new DbField('receipt_header', 'receipt_header', 'x_PaidBy', 'PaidBy', '`PaidBy`', '`PaidBy`', 200, 80, -1, FALSE, '`PaidBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaidBy->Sortable = TRUE; // Allow sort
		$this->fields['PaidBy'] = &$this->PaidBy;

		// TotalDue
		$this->TotalDue = new DbField('receipt_header', 'receipt_header', 'x_TotalDue', 'TotalDue', '`TotalDue`', '`TotalDue`', 5, 22, -1, FALSE, '`TotalDue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TotalDue->Sortable = TRUE; // Allow sort
		$this->TotalDue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TotalDue'] = &$this->TotalDue;

		// AmountTendered
		$this->AmountTendered = new DbField('receipt_header', 'receipt_header', 'x_AmountTendered', 'AmountTendered', '`AmountTendered`', '`AmountTendered`', 5, 22, -1, FALSE, '`AmountTendered`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountTendered->Sortable = TRUE; // Allow sort
		$this->AmountTendered->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountTendered'] = &$this->AmountTendered;

		// Change
		$this->Change = new DbField('receipt_header', 'receipt_header', 'x_Change', 'Change', '`Change`', '`Change`', 5, 22, -1, FALSE, '`Change`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Change->Sortable = TRUE; // Allow sort
		$this->Change->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Change'] = &$this->Change;

		// ClientMessage
		$this->ClientMessage = new DbField('receipt_header', 'receipt_header', 'x_ClientMessage', 'ClientMessage', '`ClientMessage`', '`ClientMessage`', 200, 255, -1, FALSE, '`ClientMessage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientMessage->Sortable = TRUE; // Allow sort
		$this->fields['ClientMessage'] = &$this->ClientMessage;
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
		if ($this->getCurrentDetailTable() == "receipt") {
			$detailUrl = $GLOBALS["receipt"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
			$detailUrl .= "&fk_ReceiptNo=" . urlencode($this->ReceiptNo->CurrentValue);
			$detailUrl .= "&fk_PaymentMethod=" . urlencode($this->PaymentMethod->CurrentValue);
			$detailUrl .= "&fk_ChargeGroup=" . urlencode($this->ChargeGroup->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "receipt_headerlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`receipt_header`";
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
			$this->ReceiptNo->setDbValue($conn->insert_ID());
			$rs['ReceiptNo'] = $this->ReceiptNo->DbValue;
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

		// Cascade Update detail table 'receipt'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['ClientSerNo']) && $rsold['ClientSerNo'] != $rs['ClientSerNo'])) { // Update detail field 'ClientSerNo'
			$cascadeUpdate = TRUE;
			$rscascade['ClientSerNo'] = $rs['ClientSerNo'];
		}
		if ($rsold && (isset($rs['ReceiptNo']) && $rsold['ReceiptNo'] != $rs['ReceiptNo'])) { // Update detail field 'ReceiptNo'
			$cascadeUpdate = TRUE;
			$rscascade['ReceiptNo'] = $rs['ReceiptNo'];
		}
		if ($rsold && (isset($rs['PaymentMethod']) && $rsold['PaymentMethod'] != $rs['PaymentMethod'])) { // Update detail field 'PaymentMethod'
			$cascadeUpdate = TRUE;
			$rscascade['PaymentMethod'] = $rs['PaymentMethod'];
		}
		if ($rsold && (isset($rs['ChargeGroup']) && $rsold['ChargeGroup'] != $rs['ChargeGroup'])) { // Update detail field 'ChargeGroup'
			$cascadeUpdate = TRUE;
			$rscascade['ChargeGroup'] = $rs['ChargeGroup'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["receipt"]))
				$GLOBALS["receipt"] = new receipt();
			$rswrk = $GLOBALS["receipt"]->loadRs("`ClientSerNo` = " . QuotedValue($rsold['ClientSerNo'], DATATYPE_NUMBER, 'DB') . " AND " . "`ReceiptNo` = " . QuotedValue($rsold['ReceiptNo'], DATATYPE_NUMBER, 'DB') . " AND " . "`PaymentMethod` = " . QuotedValue($rsold['PaymentMethod'], DATATYPE_STRING, 'DB') . " AND " . "`ChargeGroup` = " . QuotedValue($rsold['ChargeGroup'], DATATYPE_STRING, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'ClientSerNo';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'ChargeCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'ItemID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'ReceiptNo';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["receipt"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["receipt"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["receipt"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ReceiptNo';
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
			if (array_key_exists('ReceiptNo', $rs))
				AddFilter($where, QuotedName('ReceiptNo', $this->Dbid) . '=' . QuotedValue($rs['ReceiptNo'], $this->ReceiptNo->DataType, $this->Dbid));
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

		// Cascade delete detail table 'receipt'
		if (!isset($GLOBALS["receipt"]))
			$GLOBALS["receipt"] = new receipt();
		$rscascade = $GLOBALS["receipt"]->loadRs("`ClientSerNo` = " . QuotedValue($rs['ClientSerNo'], DATATYPE_NUMBER, "DB") . " AND " . "`ReceiptNo` = " . QuotedValue($rs['ReceiptNo'], DATATYPE_NUMBER, "DB") . " AND " . "`PaymentMethod` = " . QuotedValue($rs['PaymentMethod'], DATATYPE_STRING, "DB") . " AND " . "`ChargeGroup` = " . QuotedValue($rs['ChargeGroup'], DATATYPE_STRING, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["receipt"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["receipt"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["receipt"]->Row_Deleted($dtlrow);
		}
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
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->ClientPostalAddress->DbValue = $row['ClientPostalAddress'];
		$this->ClientPhysicalAddress->DbValue = $row['ClientPhysicalAddress'];
		$this->ClientEmail->DbValue = $row['ClientEmail'];
		$this->ReceiptPrefix->DbValue = $row['ReceiptPrefix'];
		$this->AccountBased->DbValue = $row['AccountBased'];
		$this->Cashier->DbValue = $row['Cashier'];
		$this->ReceiptNo->DbValue = $row['ReceiptNo'];
		$this->ReceiptDate->DbValue = $row['ReceiptDate'];
		$this->PaymentMethod->DbValue = $row['PaymentMethod'];
		$this->PaidBy->DbValue = $row['PaidBy'];
		$this->TotalDue->DbValue = $row['TotalDue'];
		$this->AmountTendered->DbValue = $row['AmountTendered'];
		$this->Change->DbValue = $row['Change'];
		$this->ClientMessage->DbValue = $row['ClientMessage'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ReceiptNo` = @ReceiptNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ReceiptNo', $row) ? $row['ReceiptNo'] : NULL;
		else
			$val = $this->ReceiptNo->OldValue !== NULL ? $this->ReceiptNo->OldValue : $this->ReceiptNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ReceiptNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "receipt_headerlist.php";
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
		if ($pageName == "receipt_headerview.php")
			return $Language->phrase("View");
		elseif ($pageName == "receipt_headeredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "receipt_headeradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "receipt_headerlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("receipt_headerview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("receipt_headerview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "receipt_headeradd.php?" . $this->getUrlParm($parm);
		else
			$url = "receipt_headeradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("receipt_headeredit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("receipt_headeredit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("receipt_headeradd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("receipt_headeradd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("receipt_headerdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ReceiptNo:" . JsonEncode($this->ReceiptNo->CurrentValue, "number");
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
		if ($this->ReceiptNo->CurrentValue != NULL) {
			$url .= "ReceiptNo=" . urlencode($this->ReceiptNo->CurrentValue);
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
			if (Param("ReceiptNo") !== NULL)
				$arKeys[] = Param("ReceiptNo");
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
				$this->ReceiptNo->CurrentValue = $key;
			else
				$this->ReceiptNo->OldValue = $key;
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
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->ClientPostalAddress->setDbValue($rs->fields('ClientPostalAddress'));
		$this->ClientPhysicalAddress->setDbValue($rs->fields('ClientPhysicalAddress'));
		$this->ClientEmail->setDbValue($rs->fields('ClientEmail'));
		$this->ReceiptPrefix->setDbValue($rs->fields('ReceiptPrefix'));
		$this->AccountBased->setDbValue($rs->fields('AccountBased'));
		$this->Cashier->setDbValue($rs->fields('Cashier'));
		$this->ReceiptNo->setDbValue($rs->fields('ReceiptNo'));
		$this->ReceiptDate->setDbValue($rs->fields('ReceiptDate'));
		$this->PaymentMethod->setDbValue($rs->fields('PaymentMethod'));
		$this->PaidBy->setDbValue($rs->fields('PaidBy'));
		$this->TotalDue->setDbValue($rs->fields('TotalDue'));
		$this->AmountTendered->setDbValue($rs->fields('AmountTendered'));
		$this->Change->setDbValue($rs->fields('Change'));
		$this->ClientMessage->setDbValue($rs->fields('ClientMessage'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ChargeGroup
		// ClientSerNo
		// ClientID
		// ClientPostalAddress
		// ClientPhysicalAddress
		// ClientEmail
		// ReceiptPrefix
		// AccountBased
		// Cashier
		// ReceiptNo
		// ReceiptDate
		// PaymentMethod
		// PaidBy
		// TotalDue
		// AmountTendered
		// Change
		// ClientMessage
		// ChargeGroup

		$curVal = strval($this->ChargeGroup->CurrentValue);
		if ($curVal != "") {
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeGroup`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				}
			}
		} else {
			$this->ChargeGroup->ViewValue = NULL;
		}
		$this->ChargeGroup->ViewCustomAttributes = "";

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

		// ClientPostalAddress
		$this->ClientPostalAddress->ViewValue = $this->ClientPostalAddress->CurrentValue;
		$this->ClientPostalAddress->ViewCustomAttributes = "";

		// ClientPhysicalAddress
		$this->ClientPhysicalAddress->ViewValue = $this->ClientPhysicalAddress->CurrentValue;
		$this->ClientPhysicalAddress->ViewCustomAttributes = "";

		// ClientEmail
		$this->ClientEmail->ViewValue = $this->ClientEmail->CurrentValue;
		$this->ClientEmail->ViewCustomAttributes = "";

		// ReceiptPrefix
		$this->ReceiptPrefix->ViewValue = $this->ReceiptPrefix->CurrentValue;
		$this->ReceiptPrefix->ViewCustomAttributes = "";

		// AccountBased
		$curVal = strval($this->AccountBased->CurrentValue);
		if ($curVal != "") {
			$this->AccountBased->ViewValue = $this->AccountBased->lookupCacheOption($curVal);
			if ($this->AccountBased->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AccountBased->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AccountBased->ViewValue = $this->AccountBased->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountBased->ViewValue = $this->AccountBased->CurrentValue;
				}
			}
		} else {
			$this->AccountBased->ViewValue = NULL;
		}
		$this->AccountBased->ViewCustomAttributes = "";

		// Cashier
		$this->Cashier->ViewValue = $this->Cashier->CurrentValue;
		$this->Cashier->ViewCustomAttributes = "";

		// ReceiptNo
		$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->ViewCustomAttributes = "";

		// ReceiptDate
		$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
		$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 7);
		$this->ReceiptDate->ViewCustomAttributes = "";

		// PaymentMethod
		$curVal = strval($this->PaymentMethod->CurrentValue);
		if ($curVal != "") {
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
				}
			}
		} else {
			$this->PaymentMethod->ViewValue = NULL;
		}
		$this->PaymentMethod->ViewCustomAttributes = "";

		// PaidBy
		$this->PaidBy->ViewValue = $this->PaidBy->CurrentValue;
		$this->PaidBy->ViewCustomAttributes = "";

		// TotalDue
		$this->TotalDue->ViewValue = $this->TotalDue->CurrentValue;
		$this->TotalDue->ViewValue = FormatNumber($this->TotalDue->ViewValue, 2, -2, -2, -2);
		$this->TotalDue->ViewCustomAttributes = "";

		// AmountTendered
		$this->AmountTendered->ViewValue = $this->AmountTendered->CurrentValue;
		$this->AmountTendered->ViewValue = FormatNumber($this->AmountTendered->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->AmountTendered->ViewCustomAttributes = "";

		// Change
		$this->Change->ViewValue = $this->Change->CurrentValue;
		$this->Change->ViewValue = FormatNumber($this->Change->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Change->ViewCustomAttributes = "";

		// ClientMessage
		$this->ClientMessage->ViewValue = $this->ClientMessage->CurrentValue;
		$this->ClientMessage->ViewCustomAttributes = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// ClientPostalAddress
		$this->ClientPostalAddress->LinkCustomAttributes = "";
		$this->ClientPostalAddress->HrefValue = "";
		$this->ClientPostalAddress->TooltipValue = "";

		// ClientPhysicalAddress
		$this->ClientPhysicalAddress->LinkCustomAttributes = "";
		$this->ClientPhysicalAddress->HrefValue = "";
		$this->ClientPhysicalAddress->TooltipValue = "";

		// ClientEmail
		$this->ClientEmail->LinkCustomAttributes = "";
		$this->ClientEmail->HrefValue = "";
		$this->ClientEmail->TooltipValue = "";

		// ReceiptPrefix
		$this->ReceiptPrefix->LinkCustomAttributes = "";
		$this->ReceiptPrefix->HrefValue = "";
		$this->ReceiptPrefix->TooltipValue = "";

		// AccountBased
		$this->AccountBased->LinkCustomAttributes = "";
		$this->AccountBased->HrefValue = "";
		$this->AccountBased->TooltipValue = "";

		// Cashier
		$this->Cashier->LinkCustomAttributes = "";
		$this->Cashier->HrefValue = "";
		$this->Cashier->TooltipValue = "";

		// ReceiptNo
		$this->ReceiptNo->LinkCustomAttributes = "";
		$this->ReceiptNo->HrefValue = "";
		$this->ReceiptNo->TooltipValue = "";

		// ReceiptDate
		$this->ReceiptDate->LinkCustomAttributes = "";
		$this->ReceiptDate->HrefValue = "";
		$this->ReceiptDate->TooltipValue = "";

		// PaymentMethod
		$this->PaymentMethod->LinkCustomAttributes = "";
		$this->PaymentMethod->HrefValue = "";
		$this->PaymentMethod->TooltipValue = "";

		// PaidBy
		$this->PaidBy->LinkCustomAttributes = "";
		$this->PaidBy->HrefValue = "";
		$this->PaidBy->TooltipValue = "";

		// TotalDue
		$this->TotalDue->LinkCustomAttributes = "";
		$this->TotalDue->HrefValue = "";
		$this->TotalDue->TooltipValue = "";

		// AmountTendered
		$this->AmountTendered->LinkCustomAttributes = "";
		$this->AmountTendered->HrefValue = "";
		$this->AmountTendered->TooltipValue = "";

		// Change
		$this->Change->LinkCustomAttributes = "";
		$this->Change->HrefValue = "";
		$this->Change->TooltipValue = "";

		// ClientMessage
		$this->ClientMessage->LinkCustomAttributes = "";
		$this->ClientMessage->HrefValue = "";
		$this->ClientMessage->TooltipValue = "";

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

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// ClientPostalAddress
		$this->ClientPostalAddress->EditAttrs["class"] = "form-control";
		$this->ClientPostalAddress->EditCustomAttributes = "";
		if (!$this->ClientPostalAddress->Raw)
			$this->ClientPostalAddress->CurrentValue = HtmlDecode($this->ClientPostalAddress->CurrentValue);
		$this->ClientPostalAddress->EditValue = $this->ClientPostalAddress->CurrentValue;
		$this->ClientPostalAddress->PlaceHolder = RemoveHtml($this->ClientPostalAddress->caption());

		// ClientPhysicalAddress
		$this->ClientPhysicalAddress->EditAttrs["class"] = "form-control";
		$this->ClientPhysicalAddress->EditCustomAttributes = "";
		if (!$this->ClientPhysicalAddress->Raw)
			$this->ClientPhysicalAddress->CurrentValue = HtmlDecode($this->ClientPhysicalAddress->CurrentValue);
		$this->ClientPhysicalAddress->EditValue = $this->ClientPhysicalAddress->CurrentValue;
		$this->ClientPhysicalAddress->PlaceHolder = RemoveHtml($this->ClientPhysicalAddress->caption());

		// ClientEmail
		$this->ClientEmail->EditAttrs["class"] = "form-control";
		$this->ClientEmail->EditCustomAttributes = "";
		if (!$this->ClientEmail->Raw)
			$this->ClientEmail->CurrentValue = HtmlDecode($this->ClientEmail->CurrentValue);
		$this->ClientEmail->EditValue = $this->ClientEmail->CurrentValue;
		$this->ClientEmail->PlaceHolder = RemoveHtml($this->ClientEmail->caption());

		// ReceiptPrefix
		$this->ReceiptPrefix->EditAttrs["class"] = "form-control";
		$this->ReceiptPrefix->EditCustomAttributes = "";
		if (!$this->ReceiptPrefix->Raw)
			$this->ReceiptPrefix->CurrentValue = HtmlDecode($this->ReceiptPrefix->CurrentValue);
		$this->ReceiptPrefix->EditValue = $this->ReceiptPrefix->CurrentValue;
		$this->ReceiptPrefix->PlaceHolder = RemoveHtml($this->ReceiptPrefix->caption());

		// AccountBased
		$this->AccountBased->EditAttrs["class"] = "form-control";
		$this->AccountBased->EditCustomAttributes = "";
		$curVal = strval($this->AccountBased->CurrentValue);
		if ($curVal != "") {
			$this->AccountBased->EditValue = $this->AccountBased->lookupCacheOption($curVal);
			if ($this->AccountBased->EditValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AccountBased->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AccountBased->EditValue = $this->AccountBased->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountBased->EditValue = $this->AccountBased->CurrentValue;
				}
			}
		} else {
			$this->AccountBased->EditValue = NULL;
		}
		$this->AccountBased->ViewCustomAttributes = "";

		// Cashier
		// ReceiptNo

		$this->ReceiptNo->EditAttrs["class"] = "form-control";
		$this->ReceiptNo->EditCustomAttributes = "";
		$this->ReceiptNo->EditValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->ViewCustomAttributes = "";

		// ReceiptDate
		// PaymentMethod

		$this->PaymentMethod->EditAttrs["class"] = "form-control";
		$this->PaymentMethod->EditCustomAttributes = "";

		// PaidBy
		$this->PaidBy->EditAttrs["class"] = "form-control";
		$this->PaidBy->EditCustomAttributes = "";
		if (!$this->PaidBy->Raw)
			$this->PaidBy->CurrentValue = HtmlDecode($this->PaidBy->CurrentValue);
		$this->PaidBy->EditValue = $this->PaidBy->CurrentValue;
		$this->PaidBy->PlaceHolder = RemoveHtml($this->PaidBy->caption());

		// TotalDue
		$this->TotalDue->EditAttrs["class"] = "form-control";
		$this->TotalDue->EditCustomAttributes = "";
		$this->TotalDue->EditValue = $this->TotalDue->CurrentValue;
		$this->TotalDue->PlaceHolder = RemoveHtml($this->TotalDue->caption());
		if (strval($this->TotalDue->EditValue) != "" && is_numeric($this->TotalDue->EditValue))
			$this->TotalDue->EditValue = FormatNumber($this->TotalDue->EditValue, -2, -2, -2, -2);
		

		// AmountTendered
		$this->AmountTendered->EditAttrs["class"] = "form-control";
		$this->AmountTendered->EditCustomAttributes = "";
		$this->AmountTendered->EditValue = $this->AmountTendered->CurrentValue;
		$this->AmountTendered->PlaceHolder = RemoveHtml($this->AmountTendered->caption());
		if (strval($this->AmountTendered->EditValue) != "" && is_numeric($this->AmountTendered->EditValue))
			$this->AmountTendered->EditValue = FormatNumber($this->AmountTendered->EditValue, -2, -1, -2, 0);
		

		// Change
		$this->Change->EditAttrs["class"] = "form-control";
		$this->Change->EditCustomAttributes = "";
		$this->Change->EditValue = $this->Change->CurrentValue;
		$this->Change->PlaceHolder = RemoveHtml($this->Change->caption());
		if (strval($this->Change->EditValue) != "" && is_numeric($this->Change->EditValue))
			$this->Change->EditValue = FormatNumber($this->Change->EditValue, -2, -1, -2, 0);
		

		// ClientMessage
		$this->ClientMessage->EditAttrs["class"] = "form-control";
		$this->ClientMessage->EditCustomAttributes = "";
		if (!$this->ClientMessage->Raw)
			$this->ClientMessage->CurrentValue = HtmlDecode($this->ClientMessage->CurrentValue);
		$this->ClientMessage->EditValue = $this->ClientMessage->CurrentValue;
		$this->ClientMessage->PlaceHolder = RemoveHtml($this->ClientMessage->caption());

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
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->ClientPostalAddress);
					$doc->exportCaption($this->ClientPhysicalAddress);
					$doc->exportCaption($this->ClientEmail);
					$doc->exportCaption($this->ReceiptPrefix);
					$doc->exportCaption($this->AccountBased);
					$doc->exportCaption($this->Cashier);
					$doc->exportCaption($this->ReceiptNo);
					$doc->exportCaption($this->ReceiptDate);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->PaidBy);
					$doc->exportCaption($this->TotalDue);
					$doc->exportCaption($this->AmountTendered);
					$doc->exportCaption($this->Change);
					$doc->exportCaption($this->ClientMessage);
				} else {
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->ClientPostalAddress);
					$doc->exportCaption($this->ClientPhysicalAddress);
					$doc->exportCaption($this->ClientEmail);
					$doc->exportCaption($this->ReceiptPrefix);
					$doc->exportCaption($this->AccountBased);
					$doc->exportCaption($this->Cashier);
					$doc->exportCaption($this->ReceiptNo);
					$doc->exportCaption($this->ReceiptDate);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->PaidBy);
					$doc->exportCaption($this->TotalDue);
					$doc->exportCaption($this->AmountTendered);
					$doc->exportCaption($this->Change);
					$doc->exportCaption($this->ClientMessage);
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
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->ClientPostalAddress);
						$doc->exportField($this->ClientPhysicalAddress);
						$doc->exportField($this->ClientEmail);
						$doc->exportField($this->ReceiptPrefix);
						$doc->exportField($this->AccountBased);
						$doc->exportField($this->Cashier);
						$doc->exportField($this->ReceiptNo);
						$doc->exportField($this->ReceiptDate);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->PaidBy);
						$doc->exportField($this->TotalDue);
						$doc->exportField($this->AmountTendered);
						$doc->exportField($this->Change);
						$doc->exportField($this->ClientMessage);
					} else {
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->ClientPostalAddress);
						$doc->exportField($this->ClientPhysicalAddress);
						$doc->exportField($this->ClientEmail);
						$doc->exportField($this->ReceiptPrefix);
						$doc->exportField($this->AccountBased);
						$doc->exportField($this->Cashier);
						$doc->exportField($this->ReceiptNo);
						$doc->exportField($this->ReceiptDate);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->PaidBy);
						$doc->exportField($this->TotalDue);
						$doc->exportField($this->AmountTendered);
						$doc->exportField($this->Change);
						$doc->exportField($this->ClientMessage);
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
		$table = 'receipt_header';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'receipt_header';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ReceiptNo'];

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
		$table = 'receipt_header';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ReceiptNo'];

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
		$table = 'receipt_header';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ReceiptNo'];

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

		$levelid = CurrentUserLevel();
		if ($levelid <> -1 ) {
		if ($rsnew["AmountTendered"] <= 0) {
			$this->CancelMessage =  "Zero or negative amounts should not be received. Please correct." ;
			 return FALSE;
			 }
			 }
		if ($rsnew["AmountTendered"] < $rsnew["TotalDue"]) {
			$this->CancelMessage =  "Amount Tendered less than Amount Due. Please correct." ;
			 return FALSE;
			 }  
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		    //echo "Row Inserted";
			$ReceiptNoNow = $rsnew["ReceiptNo"];

			//header("location: print_receipt.php?ReceiptNo=$ReceiptNoNow");
			//$conn = mysqli_connect("localhost", "root", "", "ladb");

			$sum = '';
			$Total = 0;
			echo '
			<!-- ****************** RECEIPT *************************** -->
			<div id="receipt" style="width: 30%; border: 2px black dotted; margin: auto; padding: 20 0; margin-top: 140px;">
				<center><img src="logo.png" style="width: 160px;">
				<h2 style="font-family: arial;"> PAYMENT RECEIPT </h2> ';
			$date = date('l jS \of F Y h:i:s A');
			$sql_item_detailb = "select  a.ClientSerNo,a.Quantity,c.ClientName,b.PaidBy, a.ReceiptNo,b.Cashier, d.ChargeDesc as ItemName,e.ChargeGroupDesc as ChargeType, format(a.UnitCost,2) as AmountDue, a.AmountPaid as  AmountPaid, b.AmountTendered as AmountTendered,  b.change 
			from receipt as a
			inner join receipt_header as b on a.ReceiptNo=b.ReceiptNo
			left outer join client as c on a.ClientSerNo=c.ClientSerNo
			left outer join charges as d on a.ChargeCode=d.ChargeCode
			left outer join charge_group as e on b.ChargeGroup=e.ChargeGroup
			where  a.ReceiptNo like $ReceiptNoNow";
			    $counter = 0;

				//$results = mysqli_query($conn, $sql_item_detailb ) or die(mysqli_error($conn));
				$rows = ExecuteRows($sql_item_detailb);

				//if($results->fetch_row() > 0){
				//foreach ($results as $row){

				foreach ($rows as $row){
					$counter++;
					$ClientSerNo=$row["ClientSerNo"];
					$ClientName=$row["ClientName"]; 
					$PaidBy=$row["PaidBy"];
					$ReceiptNo=$row["ReceiptNo"];
					$Cashier=$row["Cashier"];
					$ItemName=$row["ItemName"];
					$ChargeType=$row["ChargeType"];
					$AmountDue=$row["AmountDue"];
					$AmountTendered=$row["AmountTendered"];
					$AmountPaid=$row["AmountPaid"];
					$change=$row["change"];
					$Quantity=$row["Quantity"];
					$Total = $Total + $AmountPaid;
					$TotalFormat=number_format($Total, 2, '.', ' ');
					$ChangeDif = $AmountTendered - $Total;
					$ChangeDif=number_format($ChangeDif, 2, '.', ' ');
				    $AmountPaid=number_format($AmountPaid, 2, '.', ' ');
				    $AmountTendered=number_format($AmountTendered, 2, '.', ' ');
			if ($counter == 1){
				echo '<h4 style="font-family: arial;">'.$ClientName.'</h4></center>
				<center><table style="margin: auto;">
				<tr>
					<th style="text-align: left; font-family: arial;">Item Name</th> <th style="text-align: left; font-family: arial;">Qty</th> <th style="text-align: left; font-family: arial;">Amount Paid</th>
				</tr>';
			}
			echo '<tr>
					<td style="font-family: arial;">'.$ItemName.'</td> <td style="text-align: center; font-family: arial;">'.$Quantity.'</td><td style="font-family: arial;">K '.$AmountPaid.'</td>
				</tr>';
				} //end of foreach

			//} //end of if statement
			$Total=number_format($Total, 2, '.', ' ');
			echo '
				</table>
				<br>
			    <div style="width: fit-content; margin: auto;">
			    	<span style="font-family: arial;">______________________________________________</span><br>
			    	<span style="font-family: arial;"><b>TOTAL:</b> K'. $Total.'</b></span><br>
			    	<span style="font-family: arial;"><b>AMOUNT TENDERED:</b> K'. $AmountTendered.'</span><br>
			    	<span style="font-family: arial;"><b>CHANGE:</b> K '. $ChangeDif.'</span><br><br>
			    	<span style="font-family: arial;">=========================================</span><br>
			    	<span style="font-family: arial;"><b>PAID BY:</b> '.$PaidBy.'</span><br>
			    	<span style="font-family: arial;"><b>CASHIER:</b> '.$Cashier.' </span><br>
			    	<span style="font-family: arial;">=========================================</span><br>
			    </div>
			    	<center><i><b style="font-family: arial;">Thank you for making payments</b></i><br>
			        <span style="font-family: arial;">'.$date.'</span><br>
			</div>
			<script type="text/javascript">

			function print_div(div){
				var restorepage = document.body.innerHTML;
				var printDiv = document.getElementById("receipt").innerHTML;
				document.body.innerHTML = printDiv;
				window.print();
				document.body.innerHTML = restorepage;
			}
			setTimeout("print_div()",1000);
			message = "Finished Printing";
			setTimeout("alert(message)",3000);
			redirectTo = "receipt_headeradd.php?showdetail=receipt";
			setTimeout("location.href = redirectTo",5000);
			</script> ';
			exit();
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