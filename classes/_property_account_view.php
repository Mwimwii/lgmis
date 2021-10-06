<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for property_account_view
 */
class _property_account_view extends DbTable
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
	public $ClientSerNo;
	public $ClientName;
	public $PostalAddress;
	public $PhysicalAddress;
	public $Mobile;
	public $ValuationNo;
	public $PropertyNo;
	public $Location;
	public $LandValue;
	public $ImprovementsValue;
	public $RateableValue;
	public $SupplementaryValue;
	public $Improvements;
	public $LandExtentInHA;
	public $BalanceBF;
	public $CurrentDemand;
	public $VAT;
	public $AmountPaid;
	public $BillPeriod;
	public $BillYear;
	public $AmountDue;
	public $ChargeCode;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = '_property_account_view';
		$this->TableName = 'property_account_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`property_account_view`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "landscape"; // Page orientation (PDF only)
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

		// ClientSerNo
		$this->ClientSerNo = new DbField('_property_account_view', 'property_account_view', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ClientSerNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ClientSerNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientName
		$this->ClientName = new DbField('_property_account_view', 'property_account_view', 'x_ClientName', 'ClientName', '`ClientName`', '`ClientName`', 200, 255, -1, FALSE, '`ClientName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientName->Nullable = FALSE; // NOT NULL field
		$this->ClientName->Required = TRUE; // Required field
		$this->ClientName->Sortable = TRUE; // Allow sort
		$this->fields['ClientName'] = &$this->ClientName;

		// PostalAddress
		$this->PostalAddress = new DbField('_property_account_view', 'property_account_view', 'x_PostalAddress', 'PostalAddress', '`PostalAddress`', '`PostalAddress`', 200, 255, -1, FALSE, '`PostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PostalAddress'] = &$this->PostalAddress;

		// PhysicalAddress
		$this->PhysicalAddress = new DbField('_property_account_view', 'property_account_view', 'x_PhysicalAddress', 'PhysicalAddress', '`PhysicalAddress`', '`PhysicalAddress`', 200, 255, -1, FALSE, '`PhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PhysicalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PhysicalAddress'] = &$this->PhysicalAddress;

		// Mobile
		$this->Mobile = new DbField('_property_account_view', 'property_account_view', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// ValuationNo
		$this->ValuationNo = new DbField('_property_account_view', 'property_account_view', 'x_ValuationNo', 'ValuationNo', '`ValuationNo`', '`ValuationNo`', 3, 11, -1, FALSE, '`ValuationNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ValuationNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ValuationNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ValuationNo->IsForeignKey = TRUE; // Foreign key field
		$this->ValuationNo->Sortable = TRUE; // Allow sort
		$this->ValuationNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ValuationNo'] = &$this->ValuationNo;

		// PropertyNo
		$this->PropertyNo = new DbField('_property_account_view', 'property_account_view', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 200, 255, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Nullable = FALSE; // NOT NULL field
		$this->PropertyNo->Required = TRUE; // Required field
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// Location
		$this->Location = new DbField('_property_account_view', 'property_account_view', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Nullable = FALSE; // NOT NULL field
		$this->Location->Required = TRUE; // Required field
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// LandValue
		$this->LandValue = new DbField('_property_account_view', 'property_account_view', 'x_LandValue', 'LandValue', '`LandValue`', '`LandValue`', 5, 22, -1, FALSE, '`LandValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandValue->Sortable = TRUE; // Allow sort
		$this->LandValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandValue'] = &$this->LandValue;

		// ImprovementsValue
		$this->ImprovementsValue = new DbField('_property_account_view', 'property_account_view', 'x_ImprovementsValue', 'ImprovementsValue', '`ImprovementsValue`', '`ImprovementsValue`', 5, 22, -1, FALSE, '`ImprovementsValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ImprovementsValue->Sortable = TRUE; // Allow sort
		$this->ImprovementsValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ImprovementsValue'] = &$this->ImprovementsValue;

		// RateableValue
		$this->RateableValue = new DbField('_property_account_view', 'property_account_view', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// SupplementaryValue
		$this->SupplementaryValue = new DbField('_property_account_view', 'property_account_view', 'x_SupplementaryValue', 'SupplementaryValue', '`SupplementaryValue`', '`SupplementaryValue`', 5, 22, -1, FALSE, '`SupplementaryValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplementaryValue->Sortable = TRUE; // Allow sort
		$this->SupplementaryValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SupplementaryValue'] = &$this->SupplementaryValue;

		// Improvements
		$this->Improvements = new DbField('_property_account_view', 'property_account_view', 'x_Improvements', 'Improvements', '`Improvements`', '`Improvements`', 200, 255, -1, FALSE, '`Improvements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Improvements->Nullable = FALSE; // NOT NULL field
		$this->Improvements->Required = TRUE; // Required field
		$this->Improvements->Sortable = TRUE; // Allow sort
		$this->fields['Improvements'] = &$this->Improvements;

		// LandExtentInHA
		$this->LandExtentInHA = new DbField('_property_account_view', 'property_account_view', 'x_LandExtentInHA', 'LandExtentInHA', '`LandExtentInHA`', '`LandExtentInHA`', 5, 22, -1, FALSE, '`LandExtentInHA`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandExtentInHA->Sortable = TRUE; // Allow sort
		$this->LandExtentInHA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandExtentInHA'] = &$this->LandExtentInHA;

		// BalanceBF
		$this->BalanceBF = new DbField('_property_account_view', 'property_account_view', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 22, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// CurrentDemand
		$this->CurrentDemand = new DbField('_property_account_view', 'property_account_view', 'x_CurrentDemand', 'CurrentDemand', '`CurrentDemand`', '`CurrentDemand`', 5, 22, -1, FALSE, '`CurrentDemand`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CurrentDemand->Sortable = TRUE; // Allow sort
		$this->CurrentDemand->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['CurrentDemand'] = &$this->CurrentDemand;

		// VAT
		$this->VAT = new DbField('_property_account_view', 'property_account_view', 'x_VAT', 'VAT', '`VAT`', '`VAT`', 5, 22, -1, FALSE, '`VAT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VAT->Sortable = TRUE; // Allow sort
		$this->VAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VAT'] = &$this->VAT;

		// AmountPaid
		$this->AmountPaid = new DbField('_property_account_view', 'property_account_view', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// BillPeriod
		$this->BillPeriod = new DbField('_property_account_view', 'property_account_view', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 1, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->IsForeignKey = TRUE; // Foreign key field
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// BillYear
		$this->BillYear = new DbField('_property_account_view', 'property_account_view', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillYear->IsForeignKey = TRUE; // Foreign key field
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// AmountDue
		$this->AmountDue = new DbField('_property_account_view', 'property_account_view', 'x_AmountDue', 'AmountDue', '`AmountDue`', '`AmountDue`', 5, 23, -1, FALSE, '`AmountDue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountDue->Sortable = TRUE; // Allow sort
		$this->AmountDue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountDue'] = &$this->AmountDue;

		// ChargeCode
		$this->ChargeCode = new DbField('_property_account_view', 'property_account_view', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 11, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeCode->IsForeignKey = TRUE; // Foreign key field
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;
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
		if ($this->getCurrentDetailTable() == "receipts_view") {
			$detailUrl = $GLOBALS["receipts_view"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_BillYear=" . urlencode($this->BillYear->CurrentValue);
			$detailUrl .= "&fk_BillPeriod=" . urlencode($this->BillPeriod->CurrentValue);
			$detailUrl .= "&fk_ValuationNo=" . urlencode($this->ValuationNo->CurrentValue);
			$detailUrl .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
			$detailUrl .= "&fk_ChargeCode=" . urlencode($this->ChargeCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "_property_account_viewlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property_account_view`";
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
			$this->ClientSerNo->setDbValue($conn->insert_ID());
			$rs['ClientSerNo'] = $this->ClientSerNo->DbValue;

			// Get insert id if necessary
			$this->ValuationNo->setDbValue($conn->insert_ID());
			$rs['ValuationNo'] = $this->ValuationNo->DbValue;
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
			if (array_key_exists('ClientSerNo', $rs))
				AddFilter($where, QuotedName('ClientSerNo', $this->Dbid) . '=' . QuotedValue($rs['ClientSerNo'], $this->ClientSerNo->DataType, $this->Dbid));
			if (array_key_exists('ValuationNo', $rs))
				AddFilter($where, QuotedName('ValuationNo', $this->Dbid) . '=' . QuotedValue($rs['ValuationNo'], $this->ValuationNo->DataType, $this->Dbid));
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
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientName->DbValue = $row['ClientName'];
		$this->PostalAddress->DbValue = $row['PostalAddress'];
		$this->PhysicalAddress->DbValue = $row['PhysicalAddress'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->ValuationNo->DbValue = $row['ValuationNo'];
		$this->PropertyNo->DbValue = $row['PropertyNo'];
		$this->Location->DbValue = $row['Location'];
		$this->LandValue->DbValue = $row['LandValue'];
		$this->ImprovementsValue->DbValue = $row['ImprovementsValue'];
		$this->RateableValue->DbValue = $row['RateableValue'];
		$this->SupplementaryValue->DbValue = $row['SupplementaryValue'];
		$this->Improvements->DbValue = $row['Improvements'];
		$this->LandExtentInHA->DbValue = $row['LandExtentInHA'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->CurrentDemand->DbValue = $row['CurrentDemand'];
		$this->VAT->DbValue = $row['VAT'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->AmountDue->DbValue = $row['AmountDue'];
		$this->ChargeCode->DbValue = $row['ChargeCode'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ClientSerNo` = @ClientSerNo@ AND `ValuationNo` = @ValuationNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			$val = array_key_exists('ValuationNo', $row) ? $row['ValuationNo'] : NULL;
		else
			$val = $this->ValuationNo->OldValue !== NULL ? $this->ValuationNo->OldValue : $this->ValuationNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ValuationNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "_property_account_viewlist.php";
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
		if ($pageName == "_property_account_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "_property_account_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "_property_account_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "_property_account_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_property_account_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_property_account_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "_property_account_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "_property_account_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_property_account_viewedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_property_account_viewedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("_property_account_viewadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_property_account_viewadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("_property_account_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ClientSerNo:" . JsonEncode($this->ClientSerNo->CurrentValue, "number");
		$json .= ",ValuationNo:" . JsonEncode($this->ValuationNo->CurrentValue, "number");
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
		if ($this->ClientSerNo->CurrentValue != NULL) {
			$url .= "ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->ValuationNo->CurrentValue != NULL) {
			$url .= "&ValuationNo=" . urlencode($this->ValuationNo->CurrentValue);
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
			if (Param("ClientSerNo") !== NULL)
				$arKey[] = Param("ClientSerNo");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ValuationNo") !== NULL)
				$arKey[] = Param("ValuationNo");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // ClientSerNo
					continue;
				if (!is_numeric($key[1])) // ValuationNo
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
				$this->ClientSerNo->CurrentValue = $key[0];
			else
				$this->ClientSerNo->OldValue = $key[0];
			if ($setCurrent)
				$this->ValuationNo->CurrentValue = $key[1];
			else
				$this->ValuationNo->OldValue = $key[1];
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
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientName->setDbValue($rs->fields('ClientName'));
		$this->PostalAddress->setDbValue($rs->fields('PostalAddress'));
		$this->PhysicalAddress->setDbValue($rs->fields('PhysicalAddress'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->ValuationNo->setDbValue($rs->fields('ValuationNo'));
		$this->PropertyNo->setDbValue($rs->fields('PropertyNo'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->LandValue->setDbValue($rs->fields('LandValue'));
		$this->ImprovementsValue->setDbValue($rs->fields('ImprovementsValue'));
		$this->RateableValue->setDbValue($rs->fields('RateableValue'));
		$this->SupplementaryValue->setDbValue($rs->fields('SupplementaryValue'));
		$this->Improvements->setDbValue($rs->fields('Improvements'));
		$this->LandExtentInHA->setDbValue($rs->fields('LandExtentInHA'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->CurrentDemand->setDbValue($rs->fields('CurrentDemand'));
		$this->VAT->setDbValue($rs->fields('VAT'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->AmountDue->setDbValue($rs->fields('AmountDue'));
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ClientSerNo
		// ClientName
		// PostalAddress
		// PhysicalAddress
		// Mobile
		// ValuationNo
		// PropertyNo
		// Location
		// LandValue
		// ImprovementsValue
		// RateableValue
		// SupplementaryValue
		// Improvements
		// LandExtentInHA
		// BalanceBF
		// CurrentDemand
		// VAT
		// AmountPaid
		// BillPeriod
		// BillYear
		// AmountDue
		// ChargeCode
		// ClientSerNo

		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientName
		$this->ClientName->ViewValue = $this->ClientName->CurrentValue;
		$this->ClientName->ViewCustomAttributes = "";

		// PostalAddress
		$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->ViewCustomAttributes = "";

		// PhysicalAddress
		$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->CurrentValue;
		$this->PhysicalAddress->ViewCustomAttributes = "";

		// Mobile
		$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
		$this->Mobile->ViewCustomAttributes = "";

		// ValuationNo
		$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// LandValue
		$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
		$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
		$this->LandValue->ViewCustomAttributes = "";

		// ImprovementsValue
		$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
		$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->ImprovementsValue->ViewCustomAttributes = "";

		// RateableValue
		$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
		$this->RateableValue->ViewCustomAttributes = "";

		// SupplementaryValue
		$this->SupplementaryValue->ViewValue = $this->SupplementaryValue->CurrentValue;
		$this->SupplementaryValue->ViewValue = FormatNumber($this->SupplementaryValue->ViewValue, 2, -2, -2, -2);
		$this->SupplementaryValue->ViewCustomAttributes = "";

		// Improvements
		$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
		$this->Improvements->ViewCustomAttributes = "";

		// LandExtentInHA
		$this->LandExtentInHA->ViewValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->ViewValue = FormatNumber($this->LandExtentInHA->ViewValue, 2, -2, -2, -2);
		$this->LandExtentInHA->ViewCustomAttributes = "";

		// BalanceBF
		$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
		$this->BalanceBF->ViewCustomAttributes = "";

		// CurrentDemand
		$this->CurrentDemand->ViewValue = $this->CurrentDemand->CurrentValue;
		$this->CurrentDemand->ViewValue = FormatNumber($this->CurrentDemand->ViewValue, 2, -2, -2, -2);
		$this->CurrentDemand->ViewCustomAttributes = "";

		// VAT
		$this->VAT->ViewValue = $this->VAT->CurrentValue;
		$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
		$this->VAT->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->ViewCustomAttributes = "";

		// BillPeriod
		$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->ViewCustomAttributes = "";

		// BillYear
		$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
		$this->BillYear->ViewCustomAttributes = "";

		// AmountDue
		$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, 2, -2, -2, -2);
		$this->AmountDue->ViewCustomAttributes = "";

		// ChargeCode
		$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->ViewValue = FormatNumber($this->ChargeCode->ViewValue, 0, -2, -2, -2);
		$this->ChargeCode->ViewCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ClientName
		$this->ClientName->LinkCustomAttributes = "";
		$this->ClientName->HrefValue = "";
		$this->ClientName->TooltipValue = "";

		// PostalAddress
		$this->PostalAddress->LinkCustomAttributes = "";
		$this->PostalAddress->HrefValue = "";
		$this->PostalAddress->TooltipValue = "";

		// PhysicalAddress
		$this->PhysicalAddress->LinkCustomAttributes = "";
		$this->PhysicalAddress->HrefValue = "";
		$this->PhysicalAddress->TooltipValue = "";

		// Mobile
		$this->Mobile->LinkCustomAttributes = "";
		$this->Mobile->HrefValue = "";
		$this->Mobile->TooltipValue = "";

		// ValuationNo
		$this->ValuationNo->LinkCustomAttributes = "";
		$this->ValuationNo->HrefValue = "";
		$this->ValuationNo->TooltipValue = "";

		// PropertyNo
		$this->PropertyNo->LinkCustomAttributes = "";
		$this->PropertyNo->HrefValue = "";
		$this->PropertyNo->TooltipValue = "";

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// LandValue
		$this->LandValue->LinkCustomAttributes = "";
		$this->LandValue->HrefValue = "";
		$this->LandValue->TooltipValue = "";

		// ImprovementsValue
		$this->ImprovementsValue->LinkCustomAttributes = "";
		$this->ImprovementsValue->HrefValue = "";
		$this->ImprovementsValue->TooltipValue = "";

		// RateableValue
		$this->RateableValue->LinkCustomAttributes = "";
		$this->RateableValue->HrefValue = "";
		$this->RateableValue->TooltipValue = "";

		// SupplementaryValue
		$this->SupplementaryValue->LinkCustomAttributes = "";
		$this->SupplementaryValue->HrefValue = "";
		$this->SupplementaryValue->TooltipValue = "";

		// Improvements
		$this->Improvements->LinkCustomAttributes = "";
		$this->Improvements->HrefValue = "";
		$this->Improvements->TooltipValue = "";

		// LandExtentInHA
		$this->LandExtentInHA->LinkCustomAttributes = "";
		$this->LandExtentInHA->HrefValue = "";
		$this->LandExtentInHA->TooltipValue = "";

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

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

		// AmountDue
		$this->AmountDue->LinkCustomAttributes = "";
		$this->AmountDue->HrefValue = "";
		$this->AmountDue->TooltipValue = "";

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

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

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientName
		$this->ClientName->EditAttrs["class"] = "form-control";
		$this->ClientName->EditCustomAttributes = "";
		if (!$this->ClientName->Raw)
			$this->ClientName->CurrentValue = HtmlDecode($this->ClientName->CurrentValue);
		$this->ClientName->EditValue = $this->ClientName->CurrentValue;
		$this->ClientName->PlaceHolder = RemoveHtml($this->ClientName->caption());

		// PostalAddress
		$this->PostalAddress->EditAttrs["class"] = "form-control";
		$this->PostalAddress->EditCustomAttributes = "";
		if (!$this->PostalAddress->Raw)
			$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
		$this->PostalAddress->EditValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

		// PhysicalAddress
		$this->PhysicalAddress->EditAttrs["class"] = "form-control";
		$this->PhysicalAddress->EditCustomAttributes = "";
		if (!$this->PhysicalAddress->Raw)
			$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
		$this->PhysicalAddress->EditValue = $this->PhysicalAddress->CurrentValue;
		$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

		// Mobile
		$this->Mobile->EditAttrs["class"] = "form-control";
		$this->Mobile->EditCustomAttributes = "";
		if (!$this->Mobile->Raw)
			$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
		$this->Mobile->EditValue = $this->Mobile->CurrentValue;
		$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

		// ValuationNo
		$this->ValuationNo->EditAttrs["class"] = "form-control";
		$this->ValuationNo->EditCustomAttributes = "";
		$this->ValuationNo->EditValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->EditAttrs["class"] = "form-control";
		$this->PropertyNo->EditCustomAttributes = "";
		if (!$this->PropertyNo->Raw)
			$this->PropertyNo->CurrentValue = HtmlDecode($this->PropertyNo->CurrentValue);
		$this->PropertyNo->EditValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (!$this->Location->Raw)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// LandValue
		$this->LandValue->EditAttrs["class"] = "form-control";
		$this->LandValue->EditCustomAttributes = "";
		$this->LandValue->EditValue = $this->LandValue->CurrentValue;
		$this->LandValue->PlaceHolder = RemoveHtml($this->LandValue->caption());
		if (strval($this->LandValue->EditValue) != "" && is_numeric($this->LandValue->EditValue))
			$this->LandValue->EditValue = FormatNumber($this->LandValue->EditValue, -2, -2, -2, -2);
		

		// ImprovementsValue
		$this->ImprovementsValue->EditAttrs["class"] = "form-control";
		$this->ImprovementsValue->EditCustomAttributes = "";
		$this->ImprovementsValue->EditValue = $this->ImprovementsValue->CurrentValue;
		$this->ImprovementsValue->PlaceHolder = RemoveHtml($this->ImprovementsValue->caption());
		if (strval($this->ImprovementsValue->EditValue) != "" && is_numeric($this->ImprovementsValue->EditValue))
			$this->ImprovementsValue->EditValue = FormatNumber($this->ImprovementsValue->EditValue, -2, -1, -2, 0);
		

		// RateableValue
		$this->RateableValue->EditAttrs["class"] = "form-control";
		$this->RateableValue->EditCustomAttributes = "";
		$this->RateableValue->EditValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
		if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
			$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -2, -2, -2);
		

		// SupplementaryValue
		$this->SupplementaryValue->EditAttrs["class"] = "form-control";
		$this->SupplementaryValue->EditCustomAttributes = "";
		$this->SupplementaryValue->EditValue = $this->SupplementaryValue->CurrentValue;
		$this->SupplementaryValue->PlaceHolder = RemoveHtml($this->SupplementaryValue->caption());
		if (strval($this->SupplementaryValue->EditValue) != "" && is_numeric($this->SupplementaryValue->EditValue))
			$this->SupplementaryValue->EditValue = FormatNumber($this->SupplementaryValue->EditValue, -2, -2, -2, -2);
		

		// Improvements
		$this->Improvements->EditAttrs["class"] = "form-control";
		$this->Improvements->EditCustomAttributes = "";
		if (!$this->Improvements->Raw)
			$this->Improvements->CurrentValue = HtmlDecode($this->Improvements->CurrentValue);
		$this->Improvements->EditValue = $this->Improvements->CurrentValue;
		$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

		// LandExtentInHA
		$this->LandExtentInHA->EditAttrs["class"] = "form-control";
		$this->LandExtentInHA->EditCustomAttributes = "";
		$this->LandExtentInHA->EditValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());
		if (strval($this->LandExtentInHA->EditValue) != "" && is_numeric($this->LandExtentInHA->EditValue))
			$this->LandExtentInHA->EditValue = FormatNumber($this->LandExtentInHA->EditValue, -2, -2, -2, -2);
		

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

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";
		$this->BillYear->EditValue = $this->BillYear->CurrentValue;
		$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

		// AmountDue
		$this->AmountDue->EditAttrs["class"] = "form-control";
		$this->AmountDue->EditCustomAttributes = "";
		$this->AmountDue->EditValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());
		if (strval($this->AmountDue->EditValue) != "" && is_numeric($this->AmountDue->EditValue))
			$this->AmountDue->EditValue = FormatNumber($this->AmountDue->EditValue, -2, -2, -2, -2);
		

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->BalanceBF->CurrentValue))
				$this->BalanceBF->Total += $this->BalanceBF->CurrentValue; // Accumulate total
			if (is_numeric($this->CurrentDemand->CurrentValue))
				$this->CurrentDemand->Total += $this->CurrentDemand->CurrentValue; // Accumulate total
			if (is_numeric($this->VAT->CurrentValue))
				$this->VAT->Total += $this->VAT->CurrentValue; // Accumulate total
			if (is_numeric($this->AmountPaid->CurrentValue))
				$this->AmountPaid->Total += $this->AmountPaid->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->BalanceBF->CurrentValue = $this->BalanceBF->Total;
			$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
			$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
			$this->BalanceBF->ViewCustomAttributes = "";
			$this->BalanceBF->HrefValue = ""; // Clear href value
			$this->CurrentDemand->CurrentValue = $this->CurrentDemand->Total;
			$this->CurrentDemand->ViewValue = $this->CurrentDemand->CurrentValue;
			$this->CurrentDemand->ViewValue = FormatNumber($this->CurrentDemand->ViewValue, 2, -2, -2, -2);
			$this->CurrentDemand->ViewCustomAttributes = "";
			$this->CurrentDemand->HrefValue = ""; // Clear href value
			$this->VAT->CurrentValue = $this->VAT->Total;
			$this->VAT->ViewValue = $this->VAT->CurrentValue;
			$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
			$this->VAT->ViewCustomAttributes = "";
			$this->VAT->HrefValue = ""; // Clear href value
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
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->SupplementaryValue);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->ChargeCode);
				} else {
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->SupplementaryValue);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->ChargeCode);
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
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->Location);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->SupplementaryValue);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->ChargeCode);
					} else {
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->Location);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->SupplementaryValue);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->ChargeCode);
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
				$doc->exportAggregate($this->ClientSerNo, '');
				$doc->exportAggregate($this->ClientName, '');
				$doc->exportAggregate($this->PostalAddress, '');
				$doc->exportAggregate($this->PhysicalAddress, '');
				$doc->exportAggregate($this->Mobile, '');
				$doc->exportAggregate($this->ValuationNo, '');
				$doc->exportAggregate($this->PropertyNo, '');
				$doc->exportAggregate($this->Location, '');
				$doc->exportAggregate($this->LandValue, '');
				$doc->exportAggregate($this->ImprovementsValue, '');
				$doc->exportAggregate($this->RateableValue, '');
				$doc->exportAggregate($this->SupplementaryValue, '');
				$doc->exportAggregate($this->Improvements, '');
				$doc->exportAggregate($this->LandExtentInHA, '');
				$doc->exportAggregate($this->BalanceBF, 'TOTAL');
				$doc->exportAggregate($this->CurrentDemand, 'TOTAL');
				$doc->exportAggregate($this->VAT, 'TOTAL');
				$doc->exportAggregate($this->AmountPaid, 'TOTAL');
				$doc->exportAggregate($this->BillPeriod, '');
				$doc->exportAggregate($this->BillYear, '');
				$doc->exportAggregate($this->AmountDue, '');
				$doc->exportAggregate($this->ChargeCode, '');
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