<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for third_party
 */
class third_party extends DbTable
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
	public $ThirdPartyName;
	public $DateOfEngagement;
	public $DeductionCode;
	public $DeductionRate;
	public $DeductionAmount;
	public $DeductionLimit;
	public $EmployerContribution;
	public $DeductionDescription;
	public $PostalAddress;
	public $PhysicalAddress;
	public $TownOrVillage;
	public $Telephone;
	public $Mobile;
	public $Fax;
	public $_Email;
	public $BankBranchCode;
	public $BankAccountNo;
	public $PaymentMethod;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'third_party';
		$this->TableName = 'third_party';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`third_party`";
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

		// ThirdPartyName
		$this->ThirdPartyName = new DbField('third_party', 'third_party', 'x_ThirdPartyName', 'ThirdPartyName', '`ThirdPartyName`', '`ThirdPartyName`', 200, 100, -1, FALSE, '`ThirdPartyName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ThirdPartyName->Nullable = FALSE; // NOT NULL field
		$this->ThirdPartyName->Required = TRUE; // Required field
		$this->ThirdPartyName->Sortable = TRUE; // Allow sort
		$this->fields['ThirdPartyName'] = &$this->ThirdPartyName;

		// DateOfEngagement
		$this->DateOfEngagement = new DbField('third_party', 'third_party', 'x_DateOfEngagement', 'DateOfEngagement', '`DateOfEngagement`', CastDateFieldForLike("`DateOfEngagement`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfEngagement`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfEngagement->Nullable = FALSE; // NOT NULL field
		$this->DateOfEngagement->Required = TRUE; // Required field
		$this->DateOfEngagement->Sortable = TRUE; // Allow sort
		$this->DateOfEngagement->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfEngagement'] = &$this->DateOfEngagement;

		// DeductionCode
		$this->DeductionCode = new DbField('third_party', 'third_party', 'x_DeductionCode', 'DeductionCode', '`DeductionCode`', '`DeductionCode`', 3, 11, -1, FALSE, '`DeductionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DeductionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->DeductionCode->Nullable = FALSE; // NOT NULL field
		$this->DeductionCode->Required = TRUE; // Required field
		$this->DeductionCode->Sortable = TRUE; // Allow sort
		$this->DeductionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DeductionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DeductionCode->Lookup = new Lookup('DeductionCode', 'deduction_type', FALSE, 'DeductionCode', ["DeductionName","","",""], [], [], [], [], ["DeductionBasicRate","DeductionAmount","MaximumAmount","EmployerContributionRate","DeductionDescription"], ["x_DeductionRate","x_DeductionAmount","x_DeductionLimit","x_EmployerContribution","x_DeductionDescription"], '', '');
		$this->fields['DeductionCode'] = &$this->DeductionCode;

		// DeductionRate
		$this->DeductionRate = new DbField('third_party', 'third_party', 'x_DeductionRate', 'DeductionRate', '`DeductionRate`', '`DeductionRate`', 5, 22, -1, FALSE, '`DeductionRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionRate->Sortable = TRUE; // Allow sort
		$this->DeductionRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DeductionRate'] = &$this->DeductionRate;

		// DeductionAmount
		$this->DeductionAmount = new DbField('third_party', 'third_party', 'x_DeductionAmount', 'DeductionAmount', '`DeductionAmount`', '`DeductionAmount`', 5, 22, -1, FALSE, '`DeductionAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionAmount->Sortable = TRUE; // Allow sort
		$this->DeductionAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DeductionAmount'] = &$this->DeductionAmount;

		// DeductionLimit
		$this->DeductionLimit = new DbField('third_party', 'third_party', 'x_DeductionLimit', 'DeductionLimit', '`DeductionLimit`', '`DeductionLimit`', 5, 22, -1, FALSE, '`DeductionLimit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionLimit->Sortable = TRUE; // Allow sort
		$this->DeductionLimit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DeductionLimit'] = &$this->DeductionLimit;

		// EmployerContribution
		$this->EmployerContribution = new DbField('third_party', 'third_party', 'x_EmployerContribution', 'EmployerContribution', '`EmployerContribution`', '`EmployerContribution`', 5, 22, -1, FALSE, '`EmployerContribution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployerContribution->Sortable = TRUE; // Allow sort
		$this->EmployerContribution->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EmployerContribution'] = &$this->EmployerContribution;

		// DeductionDescription
		$this->DeductionDescription = new DbField('third_party', 'third_party', 'x_DeductionDescription', 'DeductionDescription', '`DeductionDescription`', '`DeductionDescription`', 200, 255, -1, FALSE, '`DeductionDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionDescription->Sortable = TRUE; // Allow sort
		$this->fields['DeductionDescription'] = &$this->DeductionDescription;

		// PostalAddress
		$this->PostalAddress = new DbField('third_party', 'third_party', 'x_PostalAddress', 'PostalAddress', '`PostalAddress`', '`PostalAddress`', 200, 255, -1, FALSE, '`PostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PostalAddress'] = &$this->PostalAddress;

		// PhysicalAddress
		$this->PhysicalAddress = new DbField('third_party', 'third_party', 'x_PhysicalAddress', 'PhysicalAddress', '`PhysicalAddress`', '`PhysicalAddress`', 200, 255, -1, FALSE, '`PhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PhysicalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PhysicalAddress'] = &$this->PhysicalAddress;

		// TownOrVillage
		$this->TownOrVillage = new DbField('third_party', 'third_party', 'x_TownOrVillage', 'TownOrVillage', '`TownOrVillage`', '`TownOrVillage`', 200, 255, -1, FALSE, '`TownOrVillage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TownOrVillage->Sortable = TRUE; // Allow sort
		$this->fields['TownOrVillage'] = &$this->TownOrVillage;

		// Telephone
		$this->Telephone = new DbField('third_party', 'third_party', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 255, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('third_party', 'third_party', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Fax
		$this->Fax = new DbField('third_party', 'third_party', 'x_Fax', 'Fax', '`Fax`', '`Fax`', 200, 20, -1, FALSE, '`Fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fax->Sortable = TRUE; // Allow sort
		$this->fields['Fax'] = &$this->Fax;

		// Email
		$this->_Email = new DbField('third_party', 'third_party', 'x__Email', 'Email', '`Email`', '`Email`', 200, 255, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// BankBranchCode
		$this->BankBranchCode = new DbField('third_party', 'third_party', 'x_BankBranchCode', 'BankBranchCode', '`BankBranchCode`', '`BankBranchCode`', 200, 8, -1, FALSE, '`BankBranchCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BankBranchCode->Sortable = TRUE; // Allow sort
		$this->BankBranchCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BankBranchCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BankBranchCode->Lookup = new Lookup('BankBranchCode', 'bank_branch', FALSE, 'BranchCode', ["BranchName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['BankBranchCode'] = &$this->BankBranchCode;

		// BankAccountNo
		$this->BankAccountNo = new DbField('third_party', 'third_party', 'x_BankAccountNo', 'BankAccountNo', '`BankAccountNo`', '`BankAccountNo`', 200, 13, -1, FALSE, '`BankAccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BankAccountNo->Sortable = TRUE; // Allow sort
		$this->fields['BankAccountNo'] = &$this->BankAccountNo;

		// PaymentMethod
		$this->PaymentMethod = new DbField('third_party', 'third_party', 'x_PaymentMethod', 'PaymentMethod', '`PaymentMethod`', '`PaymentMethod`', 200, 1, -1, FALSE, '`PaymentMethod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PaymentMethod->Sortable = TRUE; // Allow sort
		$this->PaymentMethod->Lookup = new Lookup('PaymentMethod', 'payment_method', FALSE, 'PaymentMethod', ["PaymentDesc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PaymentMethod'] = &$this->PaymentMethod;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`third_party`";
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
			if (array_key_exists('DeductionCode', $rs))
				AddFilter($where, QuotedName('DeductionCode', $this->Dbid) . '=' . QuotedValue($rs['DeductionCode'], $this->DeductionCode->DataType, $this->Dbid));
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
		$this->ThirdPartyName->DbValue = $row['ThirdPartyName'];
		$this->DateOfEngagement->DbValue = $row['DateOfEngagement'];
		$this->DeductionCode->DbValue = $row['DeductionCode'];
		$this->DeductionRate->DbValue = $row['DeductionRate'];
		$this->DeductionAmount->DbValue = $row['DeductionAmount'];
		$this->DeductionLimit->DbValue = $row['DeductionLimit'];
		$this->EmployerContribution->DbValue = $row['EmployerContribution'];
		$this->DeductionDescription->DbValue = $row['DeductionDescription'];
		$this->PostalAddress->DbValue = $row['PostalAddress'];
		$this->PhysicalAddress->DbValue = $row['PhysicalAddress'];
		$this->TownOrVillage->DbValue = $row['TownOrVillage'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->Fax->DbValue = $row['Fax'];
		$this->_Email->DbValue = $row['Email'];
		$this->BankBranchCode->DbValue = $row['BankBranchCode'];
		$this->BankAccountNo->DbValue = $row['BankAccountNo'];
		$this->PaymentMethod->DbValue = $row['PaymentMethod'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`DeductionCode` = @DeductionCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('DeductionCode', $row) ? $row['DeductionCode'] : NULL;
		else
			$val = $this->DeductionCode->OldValue !== NULL ? $this->DeductionCode->OldValue : $this->DeductionCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@DeductionCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "third_partylist.php";
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
		if ($pageName == "third_partyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "third_partyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "third_partyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "third_partylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("third_partyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("third_partyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "third_partyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "third_partyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("third_partyedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("third_partyadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("third_partydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "DeductionCode:" . JsonEncode($this->DeductionCode->CurrentValue, "number");
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
		if ($this->DeductionCode->CurrentValue != NULL) {
			$url .= "DeductionCode=" . urlencode($this->DeductionCode->CurrentValue);
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
			if (Param("DeductionCode") !== NULL)
				$arKeys[] = Param("DeductionCode");
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
				$this->DeductionCode->CurrentValue = $key;
			else
				$this->DeductionCode->OldValue = $key;
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
		$this->ThirdPartyName->setDbValue($rs->fields('ThirdPartyName'));
		$this->DateOfEngagement->setDbValue($rs->fields('DateOfEngagement'));
		$this->DeductionCode->setDbValue($rs->fields('DeductionCode'));
		$this->DeductionRate->setDbValue($rs->fields('DeductionRate'));
		$this->DeductionAmount->setDbValue($rs->fields('DeductionAmount'));
		$this->DeductionLimit->setDbValue($rs->fields('DeductionLimit'));
		$this->EmployerContribution->setDbValue($rs->fields('EmployerContribution'));
		$this->DeductionDescription->setDbValue($rs->fields('DeductionDescription'));
		$this->PostalAddress->setDbValue($rs->fields('PostalAddress'));
		$this->PhysicalAddress->setDbValue($rs->fields('PhysicalAddress'));
		$this->TownOrVillage->setDbValue($rs->fields('TownOrVillage'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->Fax->setDbValue($rs->fields('Fax'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->BankBranchCode->setDbValue($rs->fields('BankBranchCode'));
		$this->BankAccountNo->setDbValue($rs->fields('BankAccountNo'));
		$this->PaymentMethod->setDbValue($rs->fields('PaymentMethod'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ThirdPartyName
		// DateOfEngagement
		// DeductionCode
		// DeductionRate
		// DeductionAmount
		// DeductionLimit
		// EmployerContribution
		// DeductionDescription
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// BankBranchCode
		// BankAccountNo
		// PaymentMethod
		// ThirdPartyName

		$this->ThirdPartyName->ViewValue = $this->ThirdPartyName->CurrentValue;
		$this->ThirdPartyName->ViewCustomAttributes = "";

		// DateOfEngagement
		$this->DateOfEngagement->ViewValue = $this->DateOfEngagement->CurrentValue;
		$this->DateOfEngagement->ViewValue = FormatDateTime($this->DateOfEngagement->ViewValue, 0);
		$this->DateOfEngagement->ViewCustomAttributes = "";

		// DeductionCode
		$curVal = strval($this->DeductionCode->CurrentValue);
		if ($curVal != "") {
			$this->DeductionCode->ViewValue = $this->DeductionCode->lookupCacheOption($curVal);
			if ($this->DeductionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`DeductionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->DeductionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->DeductionCode->ViewValue = $this->DeductionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
				}
			}
		} else {
			$this->DeductionCode->ViewValue = NULL;
		}
		$this->DeductionCode->ViewCustomAttributes = "";

		// DeductionRate
		$this->DeductionRate->ViewValue = $this->DeductionRate->CurrentValue;
		$this->DeductionRate->ViewValue = FormatNumber($this->DeductionRate->ViewValue, 2, -2, -2, -2);
		$this->DeductionRate->ViewCustomAttributes = "";

		// DeductionAmount
		$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
		$this->DeductionAmount->ViewCustomAttributes = "";

		// DeductionLimit
		$this->DeductionLimit->ViewValue = $this->DeductionLimit->CurrentValue;
		$this->DeductionLimit->ViewValue = FormatNumber($this->DeductionLimit->ViewValue, 2, -2, -2, -2);
		$this->DeductionLimit->ViewCustomAttributes = "";

		// EmployerContribution
		$this->EmployerContribution->ViewValue = $this->EmployerContribution->CurrentValue;
		$this->EmployerContribution->ViewValue = FormatNumber($this->EmployerContribution->ViewValue, 2, -2, -2, -2);
		$this->EmployerContribution->ViewCustomAttributes = "";

		// DeductionDescription
		$this->DeductionDescription->ViewValue = $this->DeductionDescription->CurrentValue;
		$this->DeductionDescription->ViewCustomAttributes = "";

		// PostalAddress
		$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->ViewCustomAttributes = "";

		// PhysicalAddress
		$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->CurrentValue;
		$this->PhysicalAddress->ViewCustomAttributes = "";

		// TownOrVillage
		$this->TownOrVillage->ViewValue = $this->TownOrVillage->CurrentValue;
		$this->TownOrVillage->ViewCustomAttributes = "";

		// Telephone
		$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
		$this->Telephone->ViewCustomAttributes = "";

		// Mobile
		$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
		$this->Mobile->ViewCustomAttributes = "";

		// Fax
		$this->Fax->ViewValue = $this->Fax->CurrentValue;
		$this->Fax->ViewCustomAttributes = "";

		// Email
		$this->_Email->ViewValue = $this->_Email->CurrentValue;
		$this->_Email->ViewCustomAttributes = "";

		// BankBranchCode
		$curVal = strval($this->BankBranchCode->CurrentValue);
		if ($curVal != "") {
			$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			if ($this->BankBranchCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
				}
			}
		} else {
			$this->BankBranchCode->ViewValue = NULL;
		}
		$this->BankBranchCode->ViewCustomAttributes = "";

		// BankAccountNo
		$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
		$this->BankAccountNo->ViewCustomAttributes = "";

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

		// ThirdPartyName
		$this->ThirdPartyName->LinkCustomAttributes = "";
		$this->ThirdPartyName->HrefValue = "";
		$this->ThirdPartyName->TooltipValue = "";

		// DateOfEngagement
		$this->DateOfEngagement->LinkCustomAttributes = "";
		$this->DateOfEngagement->HrefValue = "";
		$this->DateOfEngagement->TooltipValue = "";

		// DeductionCode
		$this->DeductionCode->LinkCustomAttributes = "";
		$this->DeductionCode->HrefValue = "";
		$this->DeductionCode->TooltipValue = "";

		// DeductionRate
		$this->DeductionRate->LinkCustomAttributes = "";
		$this->DeductionRate->HrefValue = "";
		$this->DeductionRate->TooltipValue = "";

		// DeductionAmount
		$this->DeductionAmount->LinkCustomAttributes = "";
		$this->DeductionAmount->HrefValue = "";
		$this->DeductionAmount->TooltipValue = "";

		// DeductionLimit
		$this->DeductionLimit->LinkCustomAttributes = "";
		$this->DeductionLimit->HrefValue = "";
		$this->DeductionLimit->TooltipValue = "";

		// EmployerContribution
		$this->EmployerContribution->LinkCustomAttributes = "";
		$this->EmployerContribution->HrefValue = "";
		$this->EmployerContribution->TooltipValue = "";

		// DeductionDescription
		$this->DeductionDescription->LinkCustomAttributes = "";
		$this->DeductionDescription->HrefValue = "";
		$this->DeductionDescription->TooltipValue = "";

		// PostalAddress
		$this->PostalAddress->LinkCustomAttributes = "";
		$this->PostalAddress->HrefValue = "";
		$this->PostalAddress->TooltipValue = "";

		// PhysicalAddress
		$this->PhysicalAddress->LinkCustomAttributes = "";
		$this->PhysicalAddress->HrefValue = "";
		$this->PhysicalAddress->TooltipValue = "";

		// TownOrVillage
		$this->TownOrVillage->LinkCustomAttributes = "";
		$this->TownOrVillage->HrefValue = "";
		$this->TownOrVillage->TooltipValue = "";

		// Telephone
		$this->Telephone->LinkCustomAttributes = "";
		$this->Telephone->HrefValue = "";
		$this->Telephone->TooltipValue = "";

		// Mobile
		$this->Mobile->LinkCustomAttributes = "";
		$this->Mobile->HrefValue = "";
		$this->Mobile->TooltipValue = "";

		// Fax
		$this->Fax->LinkCustomAttributes = "";
		$this->Fax->HrefValue = "";
		$this->Fax->TooltipValue = "";

		// Email
		$this->_Email->LinkCustomAttributes = "";
		$this->_Email->HrefValue = "";
		$this->_Email->TooltipValue = "";

		// BankBranchCode
		$this->BankBranchCode->LinkCustomAttributes = "";
		$this->BankBranchCode->HrefValue = "";
		$this->BankBranchCode->TooltipValue = "";

		// BankAccountNo
		$this->BankAccountNo->LinkCustomAttributes = "";
		$this->BankAccountNo->HrefValue = "";
		$this->BankAccountNo->TooltipValue = "";

		// PaymentMethod
		$this->PaymentMethod->LinkCustomAttributes = "";
		$this->PaymentMethod->HrefValue = "";
		$this->PaymentMethod->TooltipValue = "";

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

		// ThirdPartyName
		$this->ThirdPartyName->EditAttrs["class"] = "form-control";
		$this->ThirdPartyName->EditCustomAttributes = "";
		if (!$this->ThirdPartyName->Raw)
			$this->ThirdPartyName->CurrentValue = HtmlDecode($this->ThirdPartyName->CurrentValue);
		$this->ThirdPartyName->EditValue = $this->ThirdPartyName->CurrentValue;
		$this->ThirdPartyName->PlaceHolder = RemoveHtml($this->ThirdPartyName->caption());

		// DateOfEngagement
		$this->DateOfEngagement->EditAttrs["class"] = "form-control";
		$this->DateOfEngagement->EditCustomAttributes = "";
		$this->DateOfEngagement->EditValue = FormatDateTime($this->DateOfEngagement->CurrentValue, 8);
		$this->DateOfEngagement->PlaceHolder = RemoveHtml($this->DateOfEngagement->caption());

		// DeductionCode
		$this->DeductionCode->EditAttrs["class"] = "form-control";
		$this->DeductionCode->EditCustomAttributes = "";

		// DeductionRate
		$this->DeductionRate->EditAttrs["class"] = "form-control";
		$this->DeductionRate->EditCustomAttributes = "";
		$this->DeductionRate->EditValue = $this->DeductionRate->CurrentValue;
		$this->DeductionRate->PlaceHolder = RemoveHtml($this->DeductionRate->caption());
		if (strval($this->DeductionRate->EditValue) != "" && is_numeric($this->DeductionRate->EditValue))
			$this->DeductionRate->EditValue = FormatNumber($this->DeductionRate->EditValue, -2, -2, -2, -2);
		

		// DeductionAmount
		$this->DeductionAmount->EditAttrs["class"] = "form-control";
		$this->DeductionAmount->EditCustomAttributes = "";
		$this->DeductionAmount->EditValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
		if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue))
			$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
		

		// DeductionLimit
		$this->DeductionLimit->EditAttrs["class"] = "form-control";
		$this->DeductionLimit->EditCustomAttributes = "";
		$this->DeductionLimit->EditValue = $this->DeductionLimit->CurrentValue;
		$this->DeductionLimit->PlaceHolder = RemoveHtml($this->DeductionLimit->caption());
		if (strval($this->DeductionLimit->EditValue) != "" && is_numeric($this->DeductionLimit->EditValue))
			$this->DeductionLimit->EditValue = FormatNumber($this->DeductionLimit->EditValue, -2, -2, -2, -2);
		

		// EmployerContribution
		$this->EmployerContribution->EditAttrs["class"] = "form-control";
		$this->EmployerContribution->EditCustomAttributes = "";
		$this->EmployerContribution->EditValue = $this->EmployerContribution->CurrentValue;
		$this->EmployerContribution->PlaceHolder = RemoveHtml($this->EmployerContribution->caption());
		if (strval($this->EmployerContribution->EditValue) != "" && is_numeric($this->EmployerContribution->EditValue))
			$this->EmployerContribution->EditValue = FormatNumber($this->EmployerContribution->EditValue, -2, -2, -2, -2);
		

		// DeductionDescription
		$this->DeductionDescription->EditAttrs["class"] = "form-control";
		$this->DeductionDescription->EditCustomAttributes = "";
		if (!$this->DeductionDescription->Raw)
			$this->DeductionDescription->CurrentValue = HtmlDecode($this->DeductionDescription->CurrentValue);
		$this->DeductionDescription->EditValue = $this->DeductionDescription->CurrentValue;
		$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

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

		// TownOrVillage
		$this->TownOrVillage->EditAttrs["class"] = "form-control";
		$this->TownOrVillage->EditCustomAttributes = "";
		if (!$this->TownOrVillage->Raw)
			$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
		$this->TownOrVillage->EditValue = $this->TownOrVillage->CurrentValue;
		$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

		// Telephone
		$this->Telephone->EditAttrs["class"] = "form-control";
		$this->Telephone->EditCustomAttributes = "";
		if (!$this->Telephone->Raw)
			$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
		$this->Telephone->EditValue = $this->Telephone->CurrentValue;
		$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

		// Mobile
		$this->Mobile->EditAttrs["class"] = "form-control";
		$this->Mobile->EditCustomAttributes = "";
		if (!$this->Mobile->Raw)
			$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
		$this->Mobile->EditValue = $this->Mobile->CurrentValue;
		$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

		// Fax
		$this->Fax->EditAttrs["class"] = "form-control";
		$this->Fax->EditCustomAttributes = "";
		if (!$this->Fax->Raw)
			$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
		$this->Fax->EditValue = $this->Fax->CurrentValue;
		$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

		// BankBranchCode
		$this->BankBranchCode->EditAttrs["class"] = "form-control";
		$this->BankBranchCode->EditCustomAttributes = "";

		// BankAccountNo
		$this->BankAccountNo->EditAttrs["class"] = "form-control";
		$this->BankAccountNo->EditCustomAttributes = "";
		if (!$this->BankAccountNo->Raw)
			$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
		$this->BankAccountNo->EditValue = $this->BankAccountNo->CurrentValue;
		$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

		// PaymentMethod
		$this->PaymentMethod->EditAttrs["class"] = "form-control";
		$this->PaymentMethod->EditCustomAttributes = "";
		if (!$this->PaymentMethod->Raw)
			$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
		$this->PaymentMethod->EditValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

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
					$doc->exportCaption($this->ThirdPartyName);
					$doc->exportCaption($this->DateOfEngagement);
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionRate);
					$doc->exportCaption($this->DeductionAmount);
					$doc->exportCaption($this->DeductionLimit);
					$doc->exportCaption($this->EmployerContribution);
					$doc->exportCaption($this->DeductionDescription);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->BankBranchCode);
					$doc->exportCaption($this->BankAccountNo);
					$doc->exportCaption($this->PaymentMethod);
				} else {
					$doc->exportCaption($this->ThirdPartyName);
					$doc->exportCaption($this->DateOfEngagement);
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionRate);
					$doc->exportCaption($this->DeductionAmount);
					$doc->exportCaption($this->DeductionLimit);
					$doc->exportCaption($this->EmployerContribution);
					$doc->exportCaption($this->DeductionDescription);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->BankBranchCode);
					$doc->exportCaption($this->BankAccountNo);
					$doc->exportCaption($this->PaymentMethod);
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
						$doc->exportField($this->ThirdPartyName);
						$doc->exportField($this->DateOfEngagement);
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionRate);
						$doc->exportField($this->DeductionAmount);
						$doc->exportField($this->DeductionLimit);
						$doc->exportField($this->EmployerContribution);
						$doc->exportField($this->DeductionDescription);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
						$doc->exportField($this->BankBranchCode);
						$doc->exportField($this->BankAccountNo);
						$doc->exportField($this->PaymentMethod);
					} else {
						$doc->exportField($this->ThirdPartyName);
						$doc->exportField($this->DateOfEngagement);
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionRate);
						$doc->exportField($this->DeductionAmount);
						$doc->exportField($this->DeductionLimit);
						$doc->exportField($this->EmployerContribution);
						$doc->exportField($this->DeductionDescription);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
						$doc->exportField($this->BankBranchCode);
						$doc->exportField($this->BankAccountNo);
						$doc->exportField($this->PaymentMethod);
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