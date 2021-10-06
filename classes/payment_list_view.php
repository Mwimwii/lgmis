<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for payment_list_view
 */
class payment_list_view extends DbTable
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
	public $PropertyNo;
	public $ClientName;
	public $PropertyUse;
	public $LandExtentInHA;
	public $LandValue;
	public $ImprovementsValue;
	public $RateableValue;
	public $ChargeCode;
	public $ChargeGroup;
	public $BalanceBF;
	public $CurrentDemand;
	public $VAT;
	public $AmountPaid;
	public $BillPeriod;
	public $BillYear;
	public $StartDate;
	public $EndDate;
	public $ChargeDesc;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'payment_list_view';
		$this->TableName = 'payment_list_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`payment_list_view`";
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

		// PropertyNo
		$this->PropertyNo = new DbField('payment_list_view', 'payment_list_view', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 200, 255, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Nullable = FALSE; // NOT NULL field
		$this->PropertyNo->Required = TRUE; // Required field
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// ClientName
		$this->ClientName = new DbField('payment_list_view', 'payment_list_view', 'x_ClientName', 'ClientName', '`ClientName`', '`ClientName`', 200, 255, -1, FALSE, '`ClientName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientName->Nullable = FALSE; // NOT NULL field
		$this->ClientName->Required = TRUE; // Required field
		$this->ClientName->Sortable = TRUE; // Allow sort
		$this->fields['ClientName'] = &$this->ClientName;

		// PropertyUse
		$this->PropertyUse = new DbField('payment_list_view', 'payment_list_view', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 4, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyUse->Nullable = FALSE; // NOT NULL field
		$this->PropertyUse->Required = TRUE; // Required field
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// LandExtentInHA
		$this->LandExtentInHA = new DbField('payment_list_view', 'payment_list_view', 'x_LandExtentInHA', 'LandExtentInHA', '`LandExtentInHA`', '`LandExtentInHA`', 5, 22, -1, FALSE, '`LandExtentInHA`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandExtentInHA->Sortable = TRUE; // Allow sort
		$this->LandExtentInHA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandExtentInHA'] = &$this->LandExtentInHA;

		// LandValue
		$this->LandValue = new DbField('payment_list_view', 'payment_list_view', 'x_LandValue', 'LandValue', '`LandValue`', '`LandValue`', 5, 22, -1, FALSE, '`LandValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandValue->Sortable = TRUE; // Allow sort
		$this->LandValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandValue'] = &$this->LandValue;

		// ImprovementsValue
		$this->ImprovementsValue = new DbField('payment_list_view', 'payment_list_view', 'x_ImprovementsValue', 'ImprovementsValue', '`ImprovementsValue`', '`ImprovementsValue`', 5, 22, -1, FALSE, '`ImprovementsValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ImprovementsValue->Sortable = TRUE; // Allow sort
		$this->ImprovementsValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ImprovementsValue'] = &$this->ImprovementsValue;

		// RateableValue
		$this->RateableValue = new DbField('payment_list_view', 'payment_list_view', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// ChargeCode
		$this->ChargeCode = new DbField('payment_list_view', 'payment_list_view', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 11, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;

		// ChargeGroup
		$this->ChargeGroup = new DbField('payment_list_view', 'payment_list_view', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 3, 11, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// BalanceBF
		$this->BalanceBF = new DbField('payment_list_view', 'payment_list_view', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 22, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// CurrentDemand
		$this->CurrentDemand = new DbField('payment_list_view', 'payment_list_view', 'x_CurrentDemand', 'CurrentDemand', '`CurrentDemand`', '`CurrentDemand`', 5, 22, -1, FALSE, '`CurrentDemand`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CurrentDemand->Sortable = TRUE; // Allow sort
		$this->CurrentDemand->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['CurrentDemand'] = &$this->CurrentDemand;

		// VAT
		$this->VAT = new DbField('payment_list_view', 'payment_list_view', 'x_VAT', 'VAT', '`VAT`', '`VAT`', 5, 22, -1, FALSE, '`VAT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VAT->Sortable = TRUE; // Allow sort
		$this->VAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VAT'] = &$this->VAT;

		// AmountPaid
		$this->AmountPaid = new DbField('payment_list_view', 'payment_list_view', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 22, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// BillPeriod
		$this->BillPeriod = new DbField('payment_list_view', 'payment_list_view', 'x_BillPeriod', 'BillPeriod', '`BillPeriod`', '`BillPeriod`', 16, 1, -1, FALSE, '`BillPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillPeriod->Sortable = TRUE; // Allow sort
		$this->BillPeriod->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['BillPeriod'] = &$this->BillPeriod;

		// BillYear
		$this->BillYear = new DbField('payment_list_view', 'payment_list_view', 'x_BillYear', 'BillYear', '`BillYear`', '`BillYear`', 18, 4, -1, FALSE, '`BillYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BillYear->Sortable = TRUE; // Allow sort
		$this->BillYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BillYear'] = &$this->BillYear;

		// StartDate
		$this->StartDate = new DbField('payment_list_view', 'payment_list_view', 'x_StartDate', 'StartDate', '`StartDate`', CastDateFieldForLike("`StartDate`", 0, "DB"), 133, 10, 0, FALSE, '`StartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartDate->Sortable = TRUE; // Allow sort
		$this->StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartDate'] = &$this->StartDate;

		// EndDate
		$this->EndDate = new DbField('payment_list_view', 'payment_list_view', 'x_EndDate', 'EndDate', '`EndDate`', CastDateFieldForLike("`EndDate`", 0, "DB"), 133, 10, 0, FALSE, '`EndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EndDate->Sortable = TRUE; // Allow sort
		$this->EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EndDate'] = &$this->EndDate;

		// ChargeDesc
		$this->ChargeDesc = new DbField('payment_list_view', 'payment_list_view', 'x_ChargeDesc', 'ChargeDesc', '`ChargeDesc`', '`ChargeDesc`', 200, 255, -1, FALSE, '`ChargeDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeDesc->Nullable = FALSE; // NOT NULL field
		$this->ChargeDesc->Required = TRUE; // Required field
		$this->ChargeDesc->Sortable = TRUE; // Allow sort
		$this->fields['ChargeDesc'] = &$this->ChargeDesc;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`payment_list_view`";
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
		$this->PropertyNo->DbValue = $row['PropertyNo'];
		$this->ClientName->DbValue = $row['ClientName'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->LandExtentInHA->DbValue = $row['LandExtentInHA'];
		$this->LandValue->DbValue = $row['LandValue'];
		$this->ImprovementsValue->DbValue = $row['ImprovementsValue'];
		$this->RateableValue->DbValue = $row['RateableValue'];
		$this->ChargeCode->DbValue = $row['ChargeCode'];
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->CurrentDemand->DbValue = $row['CurrentDemand'];
		$this->VAT->DbValue = $row['VAT'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->BillPeriod->DbValue = $row['BillPeriod'];
		$this->BillYear->DbValue = $row['BillYear'];
		$this->StartDate->DbValue = $row['StartDate'];
		$this->EndDate->DbValue = $row['EndDate'];
		$this->ChargeDesc->DbValue = $row['ChargeDesc'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "payment_list_viewlist.php";
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
		if ($pageName == "payment_list_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "payment_list_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "payment_list_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "payment_list_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("payment_list_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("payment_list_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "payment_list_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "payment_list_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("payment_list_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("payment_list_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("payment_list_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
		$this->PropertyNo->setDbValue($rs->fields('PropertyNo'));
		$this->ClientName->setDbValue($rs->fields('ClientName'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->LandExtentInHA->setDbValue($rs->fields('LandExtentInHA'));
		$this->LandValue->setDbValue($rs->fields('LandValue'));
		$this->ImprovementsValue->setDbValue($rs->fields('ImprovementsValue'));
		$this->RateableValue->setDbValue($rs->fields('RateableValue'));
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->CurrentDemand->setDbValue($rs->fields('CurrentDemand'));
		$this->VAT->setDbValue($rs->fields('VAT'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->BillPeriod->setDbValue($rs->fields('BillPeriod'));
		$this->BillYear->setDbValue($rs->fields('BillYear'));
		$this->StartDate->setDbValue($rs->fields('StartDate'));
		$this->EndDate->setDbValue($rs->fields('EndDate'));
		$this->ChargeDesc->setDbValue($rs->fields('ChargeDesc'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// PropertyNo
		// ClientName
		// PropertyUse
		// LandExtentInHA
		// LandValue
		// ImprovementsValue
		// RateableValue
		// ChargeCode
		// ChargeGroup
		// BalanceBF
		// CurrentDemand
		// VAT
		// AmountPaid
		// BillPeriod
		// BillYear
		// StartDate
		// EndDate
		// ChargeDesc
		// PropertyNo

		$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->ViewCustomAttributes = "";

		// ClientName
		$this->ClientName->ViewValue = $this->ClientName->CurrentValue;
		$this->ClientName->ViewCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->ViewCustomAttributes = "";

		// LandExtentInHA
		$this->LandExtentInHA->ViewValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->ViewValue = FormatNumber($this->LandExtentInHA->ViewValue, 2, -2, -2, -2);
		$this->LandExtentInHA->ViewCustomAttributes = "";

		// LandValue
		$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
		$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
		$this->LandValue->ViewCustomAttributes = "";

		// ImprovementsValue
		$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
		$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, 2, -2, -2, -2);
		$this->ImprovementsValue->ViewCustomAttributes = "";

		// RateableValue
		$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
		$this->RateableValue->ViewCustomAttributes = "";

		// ChargeCode
		$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->ViewCustomAttributes = "";

		// ChargeGroup
		$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->ViewCustomAttributes = "";

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

		// StartDate
		$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
		$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
		$this->StartDate->ViewCustomAttributes = "";

		// EndDate
		$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
		$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
		$this->EndDate->ViewCustomAttributes = "";

		// ChargeDesc
		$this->ChargeDesc->ViewValue = $this->ChargeDesc->CurrentValue;
		$this->ChargeDesc->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->LinkCustomAttributes = "";
		$this->PropertyNo->HrefValue = "";
		$this->PropertyNo->TooltipValue = "";

		// ClientName
		$this->ClientName->LinkCustomAttributes = "";
		$this->ClientName->HrefValue = "";
		$this->ClientName->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

		// LandExtentInHA
		$this->LandExtentInHA->LinkCustomAttributes = "";
		$this->LandExtentInHA->HrefValue = "";
		$this->LandExtentInHA->TooltipValue = "";

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

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

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

		// StartDate
		$this->StartDate->LinkCustomAttributes = "";
		$this->StartDate->HrefValue = "";
		$this->StartDate->TooltipValue = "";

		// EndDate
		$this->EndDate->LinkCustomAttributes = "";
		$this->EndDate->HrefValue = "";
		$this->EndDate->TooltipValue = "";

		// ChargeDesc
		$this->ChargeDesc->LinkCustomAttributes = "";
		$this->ChargeDesc->HrefValue = "";
		$this->ChargeDesc->TooltipValue = "";

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

		// PropertyNo
		$this->PropertyNo->EditAttrs["class"] = "form-control";
		$this->PropertyNo->EditCustomAttributes = "";
		if (!$this->PropertyNo->Raw)
			$this->PropertyNo->CurrentValue = HtmlDecode($this->PropertyNo->CurrentValue);
		$this->PropertyNo->EditValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

		// ClientName
		$this->ClientName->EditAttrs["class"] = "form-control";
		$this->ClientName->EditCustomAttributes = "";
		if (!$this->ClientName->Raw)
			$this->ClientName->CurrentValue = HtmlDecode($this->ClientName->CurrentValue);
		$this->ClientName->EditValue = $this->ClientName->CurrentValue;
		$this->ClientName->PlaceHolder = RemoveHtml($this->ClientName->caption());

		// PropertyUse
		$this->PropertyUse->EditAttrs["class"] = "form-control";
		$this->PropertyUse->EditCustomAttributes = "";
		if (!$this->PropertyUse->Raw)
			$this->PropertyUse->CurrentValue = HtmlDecode($this->PropertyUse->CurrentValue);
		$this->PropertyUse->EditValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->PlaceHolder = RemoveHtml($this->PropertyUse->caption());

		// LandExtentInHA
		$this->LandExtentInHA->EditAttrs["class"] = "form-control";
		$this->LandExtentInHA->EditCustomAttributes = "";
		$this->LandExtentInHA->EditValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());
		if (strval($this->LandExtentInHA->EditValue) != "" && is_numeric($this->LandExtentInHA->EditValue))
			$this->LandExtentInHA->EditValue = FormatNumber($this->LandExtentInHA->EditValue, -2, -2, -2, -2);
		

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
			$this->ImprovementsValue->EditValue = FormatNumber($this->ImprovementsValue->EditValue, -2, -2, -2, -2);
		

		// RateableValue
		$this->RateableValue->EditAttrs["class"] = "form-control";
		$this->RateableValue->EditCustomAttributes = "";
		$this->RateableValue->EditValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
		if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
			$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -2, -2, -2);
		

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";
		$this->ChargeGroup->EditValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

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

		// ChargeDesc
		$this->ChargeDesc->EditAttrs["class"] = "form-control";
		$this->ChargeDesc->EditCustomAttributes = "";
		if (!$this->ChargeDesc->Raw)
			$this->ChargeDesc->CurrentValue = HtmlDecode($this->ChargeDesc->CurrentValue);
		$this->ChargeDesc->EditValue = $this->ChargeDesc->CurrentValue;
		$this->ChargeDesc->PlaceHolder = RemoveHtml($this->ChargeDesc->caption());

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
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->ChargeDesc);
				} else {
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->CurrentDemand);
					$doc->exportCaption($this->VAT);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->BillPeriod);
					$doc->exportCaption($this->BillYear);
					$doc->exportCaption($this->StartDate);
					$doc->exportCaption($this->EndDate);
					$doc->exportCaption($this->ChargeDesc);
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
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->ChargeDesc);
					} else {
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->CurrentDemand);
						$doc->exportField($this->VAT);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->BillPeriod);
						$doc->exportField($this->BillYear);
						$doc->exportField($this->StartDate);
						$doc->exportField($this->EndDate);
						$doc->exportField($this->ChargeDesc);
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