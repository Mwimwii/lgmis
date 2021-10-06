<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for receipts_view
 */
class receipts_view extends DbTable
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
	public $ReceiptNo;
	public $ClientSerNo;
	public $ChargeCode;
	public $ReceiptDate;
	public $ItemID;
	public $UnitCost;
	public $Quantity;
	public $UnitOfMeasure;
	public $AmountPaid;
	public $PaymentMethod;
	public $PaymentRef;
	public $CashierNo;
	public $BillPeriod;
	public $BillYear;
	public $PaymentFor;
	public $AdditionalInformation;
	public $ChargeGroup;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'receipts_view';
		$this->TableName = 'receipts_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`receipts_view`";
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

		// ReceiptNo
		$this->ReceiptNo = new DbField('receipts_view', 'receipts_view', 'x_ReceiptNo', 'ReceiptNo', '`ReceiptNo`', '`ReceiptNo`', 3, 11, -1, FALSE, '`ReceiptNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiptNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ReceiptNo->Nullable = FALSE; // NOT NULL field
		$this->ReceiptNo->Required = TRUE; // Required field
		$this->ReceiptNo->Sortable = TRUE; // Allow sort
		$this->ReceiptNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReceiptNo'] = &$this->ReceiptNo;

		// ClientSerNo
		$this->ClientSerNo = new DbField('receipts_view', 'receipts_view', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Nullable = FALSE; // NOT NULL field
		$this->ClientSerNo->Required = TRUE; // Required field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientSerNo","",""], [], [], [], [], [], [], '', '');
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ChargeCode
		$this->ChargeCode = new DbField('receipts_view', 'receipts_view', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 3, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ChargeCode->IsForeignKey = TRUE; // Foreign key field
		$this->ChargeCode->Nullable = FALSE; // NOT NULL field
		$this->ChargeCode->Required = TRUE; // Required field
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->Lookup = new Lookup('ChargeCode', 'charges', FALSE, 'ChargeCode', ["ChargeDesc","ChargeCode","",""], [], [], [], [], [], [], '', '');
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;

		// ReceiptDate
		$this->ReceiptDate = new DbField('receipts_view', 'receipts_view', 'x_ReceiptDate', 'ReceiptDate', '`ReceiptDate`', CastDateFieldForLike("`ReceiptDate`", 0, "DB"), 135, 19, 0, FALSE, '`ReceiptDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiptDate->Sortable = TRUE; // Allow sort
		$this->ReceiptDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ReceiptDate'] = &$this->ReceiptDate;

		// ItemID
		$this->ItemID = new DbField('receipts_view', 'receipts_view', 'x_ItemID', 'ItemID', '`ItemID`', '`ItemID`', 200, 50, -1, FALSE, '`ItemID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemID->IsPrimaryKey = TRUE; // Primary key field
		$this->ItemID->IsForeignKey = TRUE; // Foreign key field
		$this->ItemID->Nullable = FALSE; // NOT NULL field
		$this->ItemID->Required = TRUE; // Required field
		$this->ItemID->Sortable = TRUE; // Allow sort
		$this->fields['ItemID'] = &$this->ItemID;

		// UnitCost
		$this->UnitCost = new DbField('receipts_view', 'receipts_view', 'x_UnitCost', 'UnitCost', '`UnitCost`', '`UnitCost`', 5, 22, -1, FALSE, '`UnitCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitCost->Sortable = TRUE; // Allow sort
		$this->UnitCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['UnitCost'] = &$this->UnitCost;

		// Quantity
		$this->Quantity = new DbField('receipts_view', 'receipts_view', 'x_Quantity', 'Quantity', '`Quantity`', '`Quantity`', 5, 22, -1, FALSE, '`Quantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Quantity->Sortable = TRUE; // Allow sort
		$this->Quantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Quantity'] = &$this->Quantity;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('receipts_view', 'receipts_view', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 20, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// AmountPaid
		$this->AmountPaid = new DbField('receipts_view', 'receipts_view', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// PaymentMethod
		$this->PaymentMethod = new DbField('receipts_view', 'receipts_view', 'x_PaymentMethod', 'PaymentMethod', '`PaymentMethod`', '`PaymentMethod`', 200, 2, -1, FALSE, '`PaymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentMethod->Nullable = FALSE; // NOT NULL field
		$this->PaymentMethod->Required = TRUE; // Required field
		$this->PaymentMethod->Sortable = TRUE; // Allow sort
		$this->PaymentMethod->Lookup = new Lookup('PaymentMethod', 'payment_method', FALSE, 'PaymentMethod', ["PaymentDesc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PaymentMethod'] = &$this->PaymentMethod;

		// PaymentRef
		$this->PaymentRef = new DbField('receipts_view', 'receipts_view', 'x_PaymentRef', 'PaymentRef', '`PaymentRef`', '`PaymentRef`', 200, 255, -1, FALSE, '`PaymentRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentRef->Sortable = TRUE; // Allow sort
		$this->fields['PaymentRef'] = &$this->PaymentRef;

		// CashierNo
		$this->CashierNo = new DbField('receipts_view', 'receipts_view', 'x_CashierNo', 'CashierNo', '`CashierNo`', '`CashierNo`', 200, 255, -1, FALSE, '`CashierNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CashierNo->Sortable = TRUE; // Allow sort
		$this->fields['CashierNo'] = &$this->CashierNo;

		// BillPeriod
		$this->BillPeriod = new DbField('receipts_view', 'receipts_view', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 3, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->IsForeignKey = TRUE; // Foreign key field
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// BillYear
		$this->BillYear = new DbField('receipts_view', 'receipts_view', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillYear->IsForeignKey = TRUE; // Foreign key field
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// PaymentFor
		$this->PaymentFor = new DbField('receipts_view', 'receipts_view', 'x_PaymentFor', 'PaymentFor', '`PaymentFor`', '`PaymentFor`', 200, 50, -1, FALSE, '`PaymentFor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentFor->Sortable = TRUE; // Allow sort
		$this->fields['PaymentFor'] = &$this->PaymentFor;

		// AdditionalInformation
		$this->AdditionalInformation = new DbField('receipts_view', 'receipts_view', 'x_AdditionalInformation', 'AdditionalInformation', '`AdditionalInformation`', '`AdditionalInformation`', 201, 16777215, -1, FALSE, '`AdditionalInformation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->AdditionalInformation->Sortable = TRUE; // Allow sort
		$this->fields['AdditionalInformation'] = &$this->AdditionalInformation;

		// ChargeGroup
		$this->ChargeGroup = new DbField('receipts_view', 'receipts_view', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 200, 2, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeGroup->Nullable = FALSE; // NOT NULL field
		$this->ChargeGroup->Required = TRUE; // Required field
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;
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
		if ($this->getCurrentMasterTable() == "_property_account_view") {
			if ($this->BillYear->getSessionValue() != "")
				$masterFilter .= "`BillYear`=" . QuotedValue($this->BillYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->BillPeriod->getSessionValue() != "")
				$masterFilter .= " AND `BillPeriod`=" . QuotedValue($this->BillPeriod->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ItemID->getSessionValue() != "")
				$masterFilter .= " AND `ValuationNo`=" . QuotedValue($this->ItemID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ClientSerNo->getSessionValue() != "")
				$masterFilter .= " AND `ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ChargeCode->getSessionValue() != "")
				$masterFilter .= " AND `ChargeCode`=" . QuotedValue($this->ChargeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "_property_account_view") {
			if ($this->BillYear->getSessionValue() != "")
				$detailFilter .= "`BillYear`=" . QuotedValue($this->BillYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->BillPeriod->getSessionValue() != "")
				$detailFilter .= " AND `BillPeriod`=" . QuotedValue($this->BillPeriod->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ItemID->getSessionValue() != "")
				$detailFilter .= " AND `ItemID`=" . QuotedValue($this->ItemID->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->ClientSerNo->getSessionValue() != "")
				$detailFilter .= " AND `ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ChargeCode->getSessionValue() != "")
				$detailFilter .= " AND `ChargeCode`=" . QuotedValue($this->ChargeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter__property_account_view()
	{
		return "`BillYear`=@BillYear@ AND `BillPeriod`=@BillPeriod@ AND `ValuationNo`=@ValuationNo@ AND `ClientSerNo`=@ClientSerNo@ AND `ChargeCode`=@ChargeCode@";
	}

	// Detail filter
	public function sqlDetailFilter__property_account_view()
	{
		return "`BillYear`=@BillYear@ AND `BillPeriod`=@BillPeriod@ AND `ItemID`='@ItemID@' AND `ClientSerNo`=@ClientSerNo@ AND `ChargeCode`=@ChargeCode@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`receipts_view`";
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
			if (array_key_exists('ReceiptNo', $rs))
				AddFilter($where, QuotedName('ReceiptNo', $this->Dbid) . '=' . QuotedValue($rs['ReceiptNo'], $this->ReceiptNo->DataType, $this->Dbid));
			if (array_key_exists('ClientSerNo', $rs))
				AddFilter($where, QuotedName('ClientSerNo', $this->Dbid) . '=' . QuotedValue($rs['ClientSerNo'], $this->ClientSerNo->DataType, $this->Dbid));
			if (array_key_exists('ChargeCode', $rs))
				AddFilter($where, QuotedName('ChargeCode', $this->Dbid) . '=' . QuotedValue($rs['ChargeCode'], $this->ChargeCode->DataType, $this->Dbid));
			if (array_key_exists('ItemID', $rs))
				AddFilter($where, QuotedName('ItemID', $this->Dbid) . '=' . QuotedValue($rs['ItemID'], $this->ItemID->DataType, $this->Dbid));
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
		$this->ReceiptNo->DbValue = $row['ReceiptNo'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ChargeCode->DbValue = $row['ChargeCode'];
		$this->ReceiptDate->DbValue = $row['ReceiptDate'];
		$this->ItemID->DbValue = $row['ItemID'];
		$this->UnitCost->DbValue = $row['UnitCost'];
		$this->Quantity->DbValue = $row['Quantity'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->PaymentMethod->DbValue = $row['PaymentMethod'];
		$this->PaymentRef->DbValue = $row['PaymentRef'];
		$this->CashierNo->DbValue = $row['CashierNo'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->PaymentFor->DbValue = $row['PaymentFor'];
		$this->AdditionalInformation->DbValue = $row['AdditionalInformation'];
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ReceiptNo` = @ReceiptNo@ AND `ClientSerNo` = @ClientSerNo@ AND `ChargeCode` = @ChargeCode@ AND `ItemID` = '@ItemID@'";
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
		if (is_array($row))
			$val = array_key_exists('ClientSerNo', $row) ? $row['ClientSerNo'] : NULL;
		else
			$val = $this->ClientSerNo->OldValue !== NULL ? $this->ClientSerNo->OldValue : $this->ClientSerNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ClientSerNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('ChargeCode', $row) ? $row['ChargeCode'] : NULL;
		else
			$val = $this->ChargeCode->OldValue !== NULL ? $this->ChargeCode->OldValue : $this->ChargeCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ChargeCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('ItemID', $row) ? $row['ItemID'] : NULL;
		else
			$val = $this->ItemID->OldValue !== NULL ? $this->ItemID->OldValue : $this->ItemID->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ItemID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "receipts_viewlist.php";
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
		if ($pageName == "receipts_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "receipts_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "receipts_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "receipts_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("receipts_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("receipts_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "receipts_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "receipts_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("receipts_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("receipts_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("receipts_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "_property_account_view" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_BillYear=" . urlencode($this->BillYear->CurrentValue);
			$url .= "&fk_BillPeriod=" . urlencode($this->BillPeriod->CurrentValue);
			$url .= "&fk_ValuationNo=" . urlencode($this->ItemID->CurrentValue);
			$url .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
			$url .= "&fk_ChargeCode=" . urlencode($this->ChargeCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ReceiptNo:" . JsonEncode($this->ReceiptNo->CurrentValue, "number");
		$json .= ",ClientSerNo:" . JsonEncode($this->ClientSerNo->CurrentValue, "number");
		$json .= ",ChargeCode:" . JsonEncode($this->ChargeCode->CurrentValue, "number");
		$json .= ",ItemID:" . JsonEncode($this->ItemID->CurrentValue, "string");
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
		if ($this->ClientSerNo->CurrentValue != NULL) {
			$url .= "&ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->ChargeCode->CurrentValue != NULL) {
			$url .= "&ChargeCode=" . urlencode($this->ChargeCode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->ItemID->CurrentValue != NULL) {
			$url .= "&ItemID=" . urlencode($this->ItemID->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("ReceiptNo") !== NULL)
				$arKey[] = Param("ReceiptNo");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ClientSerNo") !== NULL)
				$arKey[] = Param("ClientSerNo");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ChargeCode") !== NULL)
				$arKey[] = Param("ChargeCode");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ItemID") !== NULL)
				$arKey[] = Param("ItemID");
			elseif (IsApi() && Key(3) !== NULL)
				$arKey[] = Key(3);
			elseif (IsApi() && Route(5) !== NULL)
				$arKey[] = Route(5);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 4)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // ReceiptNo
					continue;
				if (!is_numeric($key[1])) // ClientSerNo
					continue;
				if (!is_numeric($key[2])) // ChargeCode
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
				$this->ReceiptNo->CurrentValue = $key[0];
			else
				$this->ReceiptNo->OldValue = $key[0];
			if ($setCurrent)
				$this->ClientSerNo->CurrentValue = $key[1];
			else
				$this->ClientSerNo->OldValue = $key[1];
			if ($setCurrent)
				$this->ChargeCode->CurrentValue = $key[2];
			else
				$this->ChargeCode->OldValue = $key[2];
			if ($setCurrent)
				$this->ItemID->CurrentValue = $key[3];
			else
				$this->ItemID->OldValue = $key[3];
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
		$this->ReceiptNo->setDbValue($rs->fields('ReceiptNo'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
		$this->ReceiptDate->setDbValue($rs->fields('ReceiptDate'));
		$this->ItemID->setDbValue($rs->fields('ItemID'));
		$this->UnitCost->setDbValue($rs->fields('UnitCost'));
		$this->Quantity->setDbValue($rs->fields('Quantity'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->PaymentMethod->setDbValue($rs->fields('PaymentMethod'));
		$this->PaymentRef->setDbValue($rs->fields('PaymentRef'));
		$this->CashierNo->setDbValue($rs->fields('CashierNo'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->PaymentFor->setDbValue($rs->fields('PaymentFor'));
		$this->AdditionalInformation->setDbValue($rs->fields('AdditionalInformation'));
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ReceiptNo
		// ClientSerNo
		// ChargeCode
		// ReceiptDate
		// ItemID
		// UnitCost
		// Quantity
		// UnitOfMeasure
		// AmountPaid
		// PaymentMethod
		// PaymentRef
		// CashierNo
		// BillPeriod
		// BillYear
		// PaymentFor
		// AdditionalInformation
		// ChargeGroup
		// ReceiptNo

		$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->ViewCustomAttributes = "";

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

		// ChargeCode
		$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
		$curVal = strval($this->ChargeCode->CurrentValue);
		if ($curVal != "") {
			$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
			if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
				}
			}
		} else {
			$this->ChargeCode->ViewValue = NULL;
		}
		$this->ChargeCode->ViewCustomAttributes = "";

		// ReceiptDate
		$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
		$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 0);
		$this->ReceiptDate->ViewCustomAttributes = "";

		// ItemID
		$this->ItemID->ViewValue = $this->ItemID->CurrentValue;
		$this->ItemID->ViewCustomAttributes = "";

		// UnitCost
		$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
		$this->UnitCost->ViewCustomAttributes = "";

		// Quantity
		$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
		$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
		$this->Quantity->ViewCustomAttributes = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->ViewCustomAttributes = "";

		// PaymentMethod
		$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
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

		// PaymentRef
		$this->PaymentRef->ViewValue = $this->PaymentRef->CurrentValue;
		$this->PaymentRef->ViewCustomAttributes = "";

		// CashierNo
		$this->CashierNo->ViewValue = $this->CashierNo->CurrentValue;
		$this->CashierNo->ViewCustomAttributes = "";

		// BillPeriod
		$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->ViewCustomAttributes = "";

		// BillYear
		$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
		$this->BillYear->ViewCustomAttributes = "";

		// PaymentFor
		$this->PaymentFor->ViewValue = $this->PaymentFor->CurrentValue;
		$this->PaymentFor->ViewCustomAttributes = "";

		// AdditionalInformation
		$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->ViewCustomAttributes = "";

		// ChargeGroup
		$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->ViewCustomAttributes = "";

		// ReceiptNo
		$this->ReceiptNo->LinkCustomAttributes = "";
		$this->ReceiptNo->HrefValue = "";
		$this->ReceiptNo->TooltipValue = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

		// ReceiptDate
		$this->ReceiptDate->LinkCustomAttributes = "";
		$this->ReceiptDate->HrefValue = "";
		$this->ReceiptDate->TooltipValue = "";

		// ItemID
		$this->ItemID->LinkCustomAttributes = "";
		$this->ItemID->HrefValue = "";
		$this->ItemID->TooltipValue = "";

		// UnitCost
		$this->UnitCost->LinkCustomAttributes = "";
		$this->UnitCost->HrefValue = "";
		$this->UnitCost->TooltipValue = "";

		// Quantity
		$this->Quantity->LinkCustomAttributes = "";
		$this->Quantity->HrefValue = "";
		$this->Quantity->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// PaymentMethod
		$this->PaymentMethod->LinkCustomAttributes = "";
		$this->PaymentMethod->HrefValue = "";
		$this->PaymentMethod->TooltipValue = "";

		// PaymentRef
		$this->PaymentRef->LinkCustomAttributes = "";
		$this->PaymentRef->HrefValue = "";
		$this->PaymentRef->TooltipValue = "";

		// CashierNo
		$this->CashierNo->LinkCustomAttributes = "";
		$this->CashierNo->HrefValue = "";
		$this->CashierNo->TooltipValue = "";

		// BillPeriod
		$this->BillPeriod->LinkCustomAttributes = "";
		$this->BillPeriod->HrefValue = "";
		$this->BillPeriod->TooltipValue = "";

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

		// PaymentFor
		$this->PaymentFor->LinkCustomAttributes = "";
		$this->PaymentFor->HrefValue = "";
		$this->PaymentFor->TooltipValue = "";

		// AdditionalInformation
		$this->AdditionalInformation->LinkCustomAttributes = "";
		$this->AdditionalInformation->HrefValue = "";
		$this->AdditionalInformation->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

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

		// ReceiptNo
		$this->ReceiptNo->EditAttrs["class"] = "form-control";
		$this->ReceiptNo->EditCustomAttributes = "";
		$this->ReceiptNo->EditValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

		// ReceiptDate
		$this->ReceiptDate->EditAttrs["class"] = "form-control";
		$this->ReceiptDate->EditCustomAttributes = "";
		$this->ReceiptDate->EditValue = FormatDateTime($this->ReceiptDate->CurrentValue, 8);
		$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

		// ItemID
		$this->ItemID->EditAttrs["class"] = "form-control";
		$this->ItemID->EditCustomAttributes = "";
		if (!$this->ItemID->Raw)
			$this->ItemID->CurrentValue = HtmlDecode($this->ItemID->CurrentValue);
		$this->ItemID->EditValue = $this->ItemID->CurrentValue;
		$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());

		// UnitCost
		$this->UnitCost->EditAttrs["class"] = "form-control";
		$this->UnitCost->EditCustomAttributes = "";
		$this->UnitCost->EditValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
		if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue))
			$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
		

		// Quantity
		$this->Quantity->EditAttrs["class"] = "form-control";
		$this->Quantity->EditCustomAttributes = "";
		$this->Quantity->EditValue = $this->Quantity->CurrentValue;
		$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
		if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue))
			$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
		

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";
		if (!$this->UnitOfMeasure->Raw)
			$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
		$this->UnitOfMeasure->EditValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
		

		// PaymentMethod
		$this->PaymentMethod->EditAttrs["class"] = "form-control";
		$this->PaymentMethod->EditCustomAttributes = "";
		if (!$this->PaymentMethod->Raw)
			$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
		$this->PaymentMethod->EditValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

		// PaymentRef
		$this->PaymentRef->EditAttrs["class"] = "form-control";
		$this->PaymentRef->EditCustomAttributes = "";
		if (!$this->PaymentRef->Raw)
			$this->PaymentRef->CurrentValue = HtmlDecode($this->PaymentRef->CurrentValue);
		$this->PaymentRef->EditValue = $this->PaymentRef->CurrentValue;
		$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

		// CashierNo
		$this->CashierNo->EditAttrs["class"] = "form-control";
		$this->CashierNo->EditCustomAttributes = "";
		if (!$this->CashierNo->Raw)
			$this->CashierNo->CurrentValue = HtmlDecode($this->CashierNo->CurrentValue);
		$this->CashierNo->EditValue = $this->CashierNo->CurrentValue;
		$this->CashierNo->PlaceHolder = RemoveHtml($this->CashierNo->caption());

		// BillPeriod
		$this->BillPeriod->EditAttrs["class"] = "form-control";
		$this->BillPeriod->EditCustomAttributes = "";
		if ($this->BillPeriod->getSessionValue() != "") {
			$this->BillPeriod->CurrentValue = $this->BillPeriod->getSessionValue();
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewCustomAttributes = "";
		} else {
			$this->BillPeriod->EditValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());
		}

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";
		if ($this->BillYear->getSessionValue() != "") {
			$this->BillYear->CurrentValue = $this->BillYear->getSessionValue();
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";
		} else {
			$this->BillYear->EditValue = $this->BillYear->CurrentValue;
			$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());
		}

		// PaymentFor
		$this->PaymentFor->EditAttrs["class"] = "form-control";
		$this->PaymentFor->EditCustomAttributes = "";
		if (!$this->PaymentFor->Raw)
			$this->PaymentFor->CurrentValue = HtmlDecode($this->PaymentFor->CurrentValue);
		$this->PaymentFor->EditValue = $this->PaymentFor->CurrentValue;
		$this->PaymentFor->PlaceHolder = RemoveHtml($this->PaymentFor->caption());

		// AdditionalInformation
		$this->AdditionalInformation->EditAttrs["class"] = "form-control";
		$this->AdditionalInformation->EditCustomAttributes = "";
		$this->AdditionalInformation->EditValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";
		if (!$this->ChargeGroup->Raw)
			$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
		$this->ChargeGroup->EditValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->AmountPaid->CurrentValue))
				$this->AmountPaid->Total += $this->AmountPaid->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->AmountPaid->CurrentValue = $this->AmountPaid->Total;
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->ViewCustomAttributes = "";
			$this->AmountPaid->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->ReceiptNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ReceiptDate);
					$doc->exportCaption($this->ItemID);
					$doc->exportCaption($this->UnitCost);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->PaymentRef);
					$doc->exportCaption($this->CashierNo);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->PaymentFor);
					$doc->exportCaption($this->AdditionalInformation);
					$doc->exportCaption($this->ChargeGroup);
				} else {
					$doc->exportCaption($this->ReceiptNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ReceiptDate);
					$doc->exportCaption($this->ItemID);
					$doc->exportCaption($this->UnitCost);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->PaymentMethod);
					$doc->exportCaption($this->PaymentRef);
					$doc->exportCaption($this->CashierNo);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->PaymentFor);
					$doc->exportCaption($this->ChargeGroup);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ReceiptNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ReceiptDate);
						$doc->exportField($this->ItemID);
						$doc->exportField($this->UnitCost);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->PaymentRef);
						$doc->exportField($this->CashierNo);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->PaymentFor);
						$doc->exportField($this->AdditionalInformation);
						$doc->exportField($this->ChargeGroup);
					} else {
						$doc->exportField($this->ReceiptNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ReceiptDate);
						$doc->exportField($this->ItemID);
						$doc->exportField($this->UnitCost);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->PaymentMethod);
						$doc->exportField($this->PaymentRef);
						$doc->exportField($this->CashierNo);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->PaymentFor);
						$doc->exportField($this->ChargeGroup);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->ReceiptNo, '');
				$doc->exportAggregate($this->ClientSerNo, '');
				$doc->exportAggregate($this->ChargeCode, '');
				$doc->exportAggregate($this->ReceiptDate, '');
				$doc->exportAggregate($this->ItemID, '');
				$doc->exportAggregate($this->UnitCost, '');
				$doc->exportAggregate($this->Quantity, '');
				$doc->exportAggregate($this->UnitOfMeasure, '');
				$doc->exportAggregate($this->AmountPaid, 'TOTAL');
				$doc->exportAggregate($this->PaymentMethod, '');
				$doc->exportAggregate($this->PaymentRef, '');
				$doc->exportAggregate($this->CashierNo, '');
				$doc->exportAggregate($this->BillPeriod, '');
				$doc->exportAggregate($this->BillYear, '');
				$doc->exportAggregate($this->PaymentFor, '');
				$doc->exportAggregate($this->ChargeGroup, '');
				$doc->endExportRow();
			}
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