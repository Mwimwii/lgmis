<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for print_bill_view
 */
class print_bill_view extends DbTable
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
	public $ValuationNo;
	public $PropertyNo;
	public $ClientSerNo;
	public $PropertyGroup;
	public $Location;
	public $PropertyUse;
	public $RateableValue;
	public $ReferenceNo;
	public $ChargeCode;
	public $ChargeGroup;
	public $ClientID;
	public $BillYear;
	public $BillPeriod;
	public $StartDate;
	public $EndDate;
	public $BalanceBF;
	public $AmountDue;
	public $VAT;
	public $SalesTax;
	public $AmountPaid;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'print_bill_view';
		$this->TableName = 'print_bill_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`print_bill_view`";
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
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ValuationNo
		$this->ValuationNo = new DbField('print_bill_view', 'print_bill_view', 'x_ValuationNo', 'ValuationNo', '`ValuationNo`', '`ValuationNo`', 3, 11, -1, FALSE, '`ValuationNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ValuationNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ValuationNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ValuationNo->Sortable = TRUE; // Allow sort
		$this->ValuationNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ValuationNo'] = &$this->ValuationNo;

		// PropertyNo
		$this->PropertyNo = new DbField('print_bill_view', 'print_bill_view', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 200, 255, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Nullable = FALSE; // NOT NULL field
		$this->PropertyNo->Required = TRUE; // Required field
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// ClientSerNo
		$this->ClientSerNo = new DbField('print_bill_view', 'print_bill_view', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->Nullable = FALSE; // NOT NULL field
		$this->ClientSerNo->Required = TRUE; // Required field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// PropertyGroup
		$this->PropertyGroup = new DbField('print_bill_view', 'print_bill_view', 'x_PropertyGroup', 'PropertyGroup', '`PropertyGroup`', '`PropertyGroup`', 16, 3, -1, FALSE, '`PropertyGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyGroup->Sortable = TRUE; // Allow sort
		$this->PropertyGroup->Lookup = new Lookup('PropertyGroup', 'property_group', FALSE, 'PropertyGroup', ["PropertyGroupDesc","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyGroup'] = &$this->PropertyGroup;

		// Location
		$this->Location = new DbField('print_bill_view', 'print_bill_view', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Location->Nullable = FALSE; // NOT NULL field
		$this->Location->Required = TRUE; // Required field
		$this->Location->Sortable = TRUE; // Allow sort
		$this->Location->Lookup = new Lookup('Location', 'property_zone', FALSE, 'AreaName', ["AreaName","","",""], [], [], [], [], [], [], '`AreaName` ASC', '');
		$this->fields['Location'] = &$this->Location;

		// PropertyUse
		$this->PropertyUse = new DbField('print_bill_view', 'print_bill_view', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 4, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->PropertyUse->Nullable = FALSE; // NOT NULL field
		$this->PropertyUse->Required = TRUE; // Required field
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->PropertyUse->Lookup = new Lookup('PropertyUse', 'property_use', FALSE, 'PropertyUse', ["UseDesc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// RateableValue
		$this->RateableValue = new DbField('print_bill_view', 'print_bill_view', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// ReferenceNo
		$this->ReferenceNo = new DbField('print_bill_view', 'print_bill_view', 'x_ReferenceNo', 'ReferenceNo', '`ReferenceNo`', '`ReferenceNo`', 3, 11, -1, FALSE, '`ReferenceNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ReferenceNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ReferenceNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ReferenceNo->Sortable = TRUE; // Allow sort
		$this->ReferenceNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReferenceNo'] = &$this->ReferenceNo;

		// ChargeCode
		$this->ChargeCode = new DbField('print_bill_view', 'print_bill_view', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 3, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeCode->Nullable = FALSE; // NOT NULL field
		$this->ChargeCode->Required = TRUE; // Required field
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->Lookup = new Lookup('ChargeCode', 'charges', FALSE, 'ChargeCode', ["ChargeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;

		// ChargeGroup
		$this->ChargeGroup = new DbField('print_bill_view', 'print_bill_view', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 200, 50, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ChargeGroup->Nullable = FALSE; // NOT NULL field
		$this->ChargeGroup->Required = TRUE; // Required field
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->Lookup = new Lookup('ChargeGroup', 'charge_group', FALSE, 'ChargeGroup', ["ChargeGroupDesc","ChargeGroup","",""], [], [], [], [], [], [], '', '');
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// ClientID
		$this->ClientID = new DbField('print_bill_view', 'print_bill_view', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// BillYear
		$this->BillYear = new DbField('print_bill_view', 'print_bill_view', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BillYear->Nullable = FALSE; // NOT NULL field
		$this->BillYear->Required = TRUE; // Required field
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BillYear->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BillYear->Lookup = new Lookup('BillYear', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// BillPeriod
		$this->BillPeriod = new DbField('print_bill_view', 'print_bill_view', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 3, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->Nullable = FALSE; // NOT NULL field
		$this->BillPeriod->Required = TRUE; // Required field
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// StartDate
		$this->StartDate = new DbField('print_bill_view', 'print_bill_view', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('print_bill_view', 'print_bill_view', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// BalanceBF
		$this->BalanceBF = new DbField('print_bill_view', 'print_bill_view', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 22, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// AmountDue
		$this->AmountDue = new DbField('print_bill_view', 'print_bill_view', 'x_AmountDue', 'AmountDue', '`AmountDue`', '`AmountDue`', 5, 22, -1, FALSE, '`AmountDue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountDue->Sortable = TRUE; // Allow sort
		$this->AmountDue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountDue'] = &$this->AmountDue;

		// VAT
		$this->VAT = new DbField('print_bill_view', 'print_bill_view', 'x_VAT', 'VAT', '`VAT`', '`VAT`', 5, 22, -1, FALSE, '`VAT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VAT->Sortable = TRUE; // Allow sort
		$this->VAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VAT'] = &$this->VAT;

		// SalesTax
		$this->SalesTax = new DbField('print_bill_view', 'print_bill_view', 'x_SalesTax', 'SalesTax', '`SalesTax`', '`SalesTax`', 5, 22, -1, FALSE, '`SalesTax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalesTax->Sortable = TRUE; // Allow sort
		$this->SalesTax->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SalesTax'] = &$this->SalesTax;

		// AmountPaid
		$this->AmountPaid = new DbField('print_bill_view', 'print_bill_view', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`print_bill_view`";
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
			$this->ValuationNo->setDbValue($conn->insert_ID());
			$rs['ValuationNo'] = $this->ValuationNo->DbValue;

			// Get insert id if necessary
			$this->ReferenceNo->setDbValue($conn->insert_ID());
			$rs['ReferenceNo'] = $this->ReferenceNo->DbValue;
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
			if (array_key_exists('ValuationNo', $rs))
				AddFilter($where, QuotedName('ValuationNo', $this->Dbid) . '=' . QuotedValue($rs['ValuationNo'], $this->ValuationNo->DataType, $this->Dbid));
			if (array_key_exists('ReferenceNo', $rs))
				AddFilter($where, QuotedName('ReferenceNo', $this->Dbid) . '=' . QuotedValue($rs['ReferenceNo'], $this->ReferenceNo->DataType, $this->Dbid));
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
		$this->ValuationNo->DbValue = $row['ValuationNo'];
		$this->PropertyNo->DbValue = $row['PropertyNo'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->PropertyGroup->DbValue = $row['PropertyGroup'];
		$this->Location->DbValue = $row['Location'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->RateableValue->DbValue = $row['RateableValue'];
		$this->ReferenceNo->DbValue = $row['ReferenceNo'];
		$this->ChargeCode->DbValue = $row['ChargeCode'];
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->AmountDue->DbValue = $row['AmountDue'];
		$this->VAT->DbValue = $row['VAT'];
		$this->SalesTax->DbValue = $row['SalesTax'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ValuationNo` = @ValuationNo@ AND `ReferenceNo` = @ReferenceNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
		if (is_array($row))
			$val = array_key_exists('ReferenceNo', $row) ? $row['ReferenceNo'] : NULL;
		else
			$val = $this->ReferenceNo->OldValue !== NULL ? $this->ReferenceNo->OldValue : $this->ReferenceNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ReferenceNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "print_bill_viewlist.php";
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
		if ($pageName == "print_bill_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "print_bill_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "print_bill_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "print_bill_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("print_bill_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("print_bill_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "print_bill_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "print_bill_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("print_bill_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("print_bill_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("print_bill_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ValuationNo:" . JsonEncode($this->ValuationNo->CurrentValue, "number");
		$json .= ",ReferenceNo:" . JsonEncode($this->ReferenceNo->CurrentValue, "number");
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
		if ($this->ValuationNo->CurrentValue != NULL) {
			$url .= "ValuationNo=" . urlencode($this->ValuationNo->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->ReferenceNo->CurrentValue != NULL) {
			$url .= "&ReferenceNo=" . urlencode($this->ReferenceNo->CurrentValue);
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
			if (Param("ValuationNo") !== NULL)
				$arKey[] = Param("ValuationNo");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("ReferenceNo") !== NULL)
				$arKey[] = Param("ReferenceNo");
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
				if (!is_numeric($key[0])) // ValuationNo
					continue;
				if (!is_numeric($key[1])) // ReferenceNo
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
				$this->ValuationNo->CurrentValue = $key[0];
			else
				$this->ValuationNo->OldValue = $key[0];
			if ($setCurrent)
				$this->ReferenceNo->CurrentValue = $key[1];
			else
				$this->ReferenceNo->OldValue = $key[1];
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
		$this->ValuationNo->setDbValue($rs->fields('ValuationNo'));
		$this->PropertyNo->setDbValue($rs->fields('PropertyNo'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->PropertyGroup->setDbValue($rs->fields('PropertyGroup'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->RateableValue->setDbValue($rs->fields('RateableValue'));
		$this->ReferenceNo->setDbValue($rs->fields('ReferenceNo'));
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->AmountDue->setDbValue($rs->fields('AmountDue'));
		$this->VAT->setDbValue($rs->fields('VAT'));
		$this->SalesTax->setDbValue($rs->fields('SalesTax'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ValuationNo
		// PropertyNo
		// ClientSerNo
		// PropertyGroup
		// Location
		// PropertyUse
		// RateableValue
		// ReferenceNo
		// ChargeCode
		// ChargeGroup
		// ClientID
		// BillYear
		// BillPeriod
		// StartDate
		// EndDate
		// BalanceBF
		// AmountDue
		// VAT
		// SalesTax
		// AmountPaid
		// ValuationNo

		$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->ViewCustomAttributes = "";

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

		// PropertyGroup
		$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
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

		// Location
		$curVal = strval($this->Location->CurrentValue);
		if ($curVal != "") {
			$this->Location->ViewValue = $this->Location->lookupCacheOption($curVal);
			if ($this->Location->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Location->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Location->ViewValue->add($this->Location->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->Location->ViewValue = $this->Location->CurrentValue;
				}
			}
		} else {
			$this->Location->ViewValue = NULL;
		}
		$this->Location->ViewCustomAttributes = "";

		// PropertyUse
		$curVal = strval($this->PropertyUse->CurrentValue);
		if ($curVal != "") {
			$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->PropertyUse->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyUse->ViewValue->add($this->PropertyUse->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
				}
			}
		} else {
			$this->PropertyUse->ViewValue = NULL;
		}
		$this->PropertyUse->ViewCustomAttributes = "";

		// RateableValue
		$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
		$this->RateableValue->ViewCustomAttributes = "";

		// ReferenceNo
		$this->ReferenceNo->ViewValue = $this->ReferenceNo->CurrentValue;
		$this->ReferenceNo->ViewCustomAttributes = "";

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

		// ChargeGroup
		$curVal = strval($this->ChargeGroup->CurrentValue);
		if ($curVal != "") {
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`ChargeGroup`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ChargeGroup->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ChargeGroup->ViewValue->add($this->ChargeGroup->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				}
			}
		} else {
			$this->ChargeGroup->ViewValue = NULL;
		}
		$this->ChargeGroup->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

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

		// BillPeriod
		$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
		$this->BillPeriod->ViewCustomAttributes = "";

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// EndDate
		$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
		$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
		$this->EndDate->ViewCustomAttributes = "";

		// BalanceBF
		$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
		$this->BalanceBF->ViewCustomAttributes = "";

		// AmountDue
		$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, 2, -2, -2, -2);
		$this->AmountDue->ViewCustomAttributes = "";

		// VAT
		$this->VAT->ViewValue = $this->VAT->CurrentValue;
		$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
		$this->VAT->ViewCustomAttributes = "";

		// SalesTax
		$this->SalesTax->ViewValue = $this->SalesTax->CurrentValue;
		$this->SalesTax->ViewValue = FormatNumber($this->SalesTax->ViewValue, 2, -2, -2, -2);
		$this->SalesTax->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->ViewCustomAttributes = "";

		// ValuationNo
		$this->ValuationNo->LinkCustomAttributes = "";
		$this->ValuationNo->HrefValue = "";
		$this->ValuationNo->TooltipValue = "";

		// PropertyNo
		$this->PropertyNo->LinkCustomAttributes = "";
		$this->PropertyNo->HrefValue = "";
		$this->PropertyNo->TooltipValue = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// PropertyGroup
		$this->PropertyGroup->LinkCustomAttributes = "";
		$this->PropertyGroup->HrefValue = "";
		$this->PropertyGroup->TooltipValue = "";

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

		// RateableValue
		$this->RateableValue->LinkCustomAttributes = "";
		$this->RateableValue->HrefValue = "";
		$this->RateableValue->TooltipValue = "";

		// ReferenceNo
		$this->ReferenceNo->LinkCustomAttributes = "";
		$this->ReferenceNo->HrefValue = "";
		$this->ReferenceNo->TooltipValue = "";

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// BillYear
		$this->BillYear->LinkCustomAttributes = "";
		$this->BillYear->HrefValue = "";
		$this->BillYear->TooltipValue = "";

		// BillPeriod
		$this->BillPeriod->LinkCustomAttributes = "";
		$this->BillPeriod->HrefValue = "";
		$this->BillPeriod->TooltipValue = "";

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// EndDate
		$this->EndDate->LinkCustomAttributes = "";
		$this->EndDate->HrefValue = "";
		$this->EndDate->TooltipValue = "";

		// BalanceBF
		$this->BalanceBF->LinkCustomAttributes = "";
		$this->BalanceBF->HrefValue = "";
		$this->BalanceBF->TooltipValue = "";

		// AmountDue
		$this->AmountDue->LinkCustomAttributes = "";
		$this->AmountDue->HrefValue = "";
		$this->AmountDue->TooltipValue = "";

		// VAT
		$this->VAT->LinkCustomAttributes = "";
		$this->VAT->HrefValue = "";
		$this->VAT->TooltipValue = "";

		// SalesTax
		$this->SalesTax->LinkCustomAttributes = "";
		$this->SalesTax->HrefValue = "";
		$this->SalesTax->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

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

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

		// PropertyGroup
		$this->PropertyGroup->EditAttrs["class"] = "form-control";
		$this->PropertyGroup->EditCustomAttributes = "";
		$this->PropertyGroup->EditValue = $this->PropertyGroup->CurrentValue;
		$this->PropertyGroup->PlaceHolder = RemoveHtml($this->PropertyGroup->caption());

		// Location
		$this->Location->EditCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->EditCustomAttributes = "";

		// RateableValue
		$this->RateableValue->EditAttrs["class"] = "form-control";
		$this->RateableValue->EditCustomAttributes = "";
		$this->RateableValue->EditValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
		if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
			$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -2, -2, -2);
		

		// ReferenceNo
		$this->ReferenceNo->EditAttrs["class"] = "form-control";
		$this->ReferenceNo->EditCustomAttributes = "";
		$this->ReferenceNo->EditValue = $this->ReferenceNo->CurrentValue;
		$this->ReferenceNo->ViewCustomAttributes = "";

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

		// ChargeGroup
		$this->ChargeGroup->EditCustomAttributes = "";

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// BillYear
		$this->BillYear->EditAttrs["class"] = "form-control";
		$this->BillYear->EditCustomAttributes = "";

		// BillPeriod
		$this->BillPeriod->EditAttrs["class"] = "form-control";
		$this->BillPeriod->EditCustomAttributes = "";
		$this->BillPeriod->EditValue = $this->BillPeriod->CurrentValue;
		$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

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

		// BalanceBF
		$this->BalanceBF->EditAttrs["class"] = "form-control";
		$this->BalanceBF->EditCustomAttributes = "";
		$this->BalanceBF->EditValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
		if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
			$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, -2, -2, -2);
		

		// AmountDue
		$this->AmountDue->EditAttrs["class"] = "form-control";
		$this->AmountDue->EditCustomAttributes = "";
		$this->AmountDue->EditValue = $this->AmountDue->CurrentValue;
		$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());
		if (strval($this->AmountDue->EditValue) != "" && is_numeric($this->AmountDue->EditValue))
			$this->AmountDue->EditValue = FormatNumber($this->AmountDue->EditValue, -2, -2, -2, -2);
		

		// VAT
		$this->VAT->EditAttrs["class"] = "form-control";
		$this->VAT->EditCustomAttributes = "";
		$this->VAT->EditValue = $this->VAT->CurrentValue;
		$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());
		if (strval($this->VAT->EditValue) != "" && is_numeric($this->VAT->EditValue))
			$this->VAT->EditValue = FormatNumber($this->VAT->EditValue, -2, -2, -2, -2);
		

		// SalesTax
		$this->SalesTax->EditAttrs["class"] = "form-control";
		$this->SalesTax->EditCustomAttributes = "";
		$this->SalesTax->EditValue = $this->SalesTax->CurrentValue;
		$this->SalesTax->PlaceHolder = RemoveHtml($this->SalesTax->caption());
		if (strval($this->SalesTax->EditValue) != "" && is_numeric($this->SalesTax->EditValue))
			$this->SalesTax->EditValue = FormatNumber($this->SalesTax->EditValue, -2, -2, -2, -2);
		

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->ReferenceNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->SalesTax);
					$doc->exportCaption($this->AmountPaid);
				} else {
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->ReferenceNo);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountDue);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->SalesTax);
					$doc->exportCaption($this->AmountPaid);
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
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->ReferenceNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->VAT);
						$doc->exportField($this->SalesTax);
						$doc->exportField($this->AmountPaid);
					} else {
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->ReferenceNo);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountDue);
						$doc->exportField($this->VAT);
						$doc->exportField($this->SalesTax);
						$doc->exportField($this->AmountPaid);
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