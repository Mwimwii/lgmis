<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for deduction_type
 */
class deduction_type extends DbTable
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
	public $DeductionCode;
	public $DeductionName;
	public $DeductionDescription;
	public $Division;
	public $DeductionAmount;
	public $DeductionBasicRate;
	public $RemittedTo;
	public $AccountNo;
	public $BaseIncomeCode;
	public $BaseDeductionCode;
	public $TaxExempt;
	public $JobCode;
	public $MinimumAmount;
	public $MaximumAmount;
	public $EmployerContributionRate;
	public $EmployerContributionAmount;
	public $Application;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'deduction_type';
		$this->TableName = 'deduction_type';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`deduction_type`";
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

		// DeductionCode
		$this->DeductionCode = new DbField('deduction_type', 'deduction_type', 'x_DeductionCode', 'DeductionCode', '`DeductionCode`', '`DeductionCode`', 3, 11, -1, FALSE, '`DeductionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->DeductionCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->DeductionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->DeductionCode->Sortable = TRUE; // Allow sort
		$this->fields['DeductionCode'] = &$this->DeductionCode;

		// DeductionName
		$this->DeductionName = new DbField('deduction_type', 'deduction_type', 'x_DeductionName', 'DeductionName', '`DeductionName`', '`DeductionName`', 200, 255, -1, FALSE, '`DeductionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionName->Nullable = FALSE; // NOT NULL field
		$this->DeductionName->Required = TRUE; // Required field
		$this->DeductionName->Sortable = TRUE; // Allow sort
		$this->fields['DeductionName'] = &$this->DeductionName;

		// DeductionDescription
		$this->DeductionDescription = new DbField('deduction_type', 'deduction_type', 'x_DeductionDescription', 'DeductionDescription', '`DeductionDescription`', '`DeductionDescription`', 200, 255, -1, FALSE, '`DeductionDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->DeductionDescription->Sortable = TRUE; // Allow sort
		$this->fields['DeductionDescription'] = &$this->DeductionDescription;

		// Division
		$this->Division = new DbField('deduction_type', 'deduction_type', 'x_Division', 'Division', '`Division`', '`Division`', 200, 100, -1, FALSE, '`Division`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Division->Sortable = TRUE; // Allow sort
		$this->Division->Lookup = new Lookup('Division', 'division', FALSE, 'Division', ["Division","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Division'] = &$this->Division;

		// DeductionAmount
		$this->DeductionAmount = new DbField('deduction_type', 'deduction_type', 'x_DeductionAmount', 'DeductionAmount', '`DeductionAmount`', '`DeductionAmount`', 5, 22, -1, FALSE, '`DeductionAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionAmount->Sortable = TRUE; // Allow sort
		$this->DeductionAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DeductionAmount'] = &$this->DeductionAmount;

		// DeductionBasicRate
		$this->DeductionBasicRate = new DbField('deduction_type', 'deduction_type', 'x_DeductionBasicRate', 'DeductionBasicRate', '`DeductionBasicRate`', '`DeductionBasicRate`', 5, 22, -1, FALSE, '`DeductionBasicRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionBasicRate->Sortable = TRUE; // Allow sort
		$this->DeductionBasicRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DeductionBasicRate'] = &$this->DeductionBasicRate;

		// RemittedTo
		$this->RemittedTo = new DbField('deduction_type', 'deduction_type', 'x_RemittedTo', 'RemittedTo', '`RemittedTo`', '`RemittedTo`', 200, 255, -1, FALSE, '`RemittedTo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RemittedTo->Sortable = TRUE; // Allow sort
		$this->fields['RemittedTo'] = &$this->RemittedTo;

		// AccountNo
		$this->AccountNo = new DbField('deduction_type', 'deduction_type', 'x_AccountNo', 'AccountNo', '`AccountNo`', '`AccountNo`', 200, 25, -1, FALSE, '`AccountNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AccountNo->Sortable = TRUE; // Allow sort
		$this->AccountNo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AccountNo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AccountNo->Lookup = new Lookup('AccountNo', 'account_ref', FALSE, 'AccountCode', ["AccountName","AccountCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['AccountNo'] = &$this->AccountNo;

		// BaseIncomeCode
		$this->BaseIncomeCode = new DbField('deduction_type', 'deduction_type', 'x_BaseIncomeCode', 'BaseIncomeCode', '`BaseIncomeCode`', '`BaseIncomeCode`', 200, 15, -1, FALSE, '`BaseIncomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BaseIncomeCode->Sortable = TRUE; // Allow sort
		$this->BaseIncomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BaseIncomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BaseIncomeCode->Lookup = new Lookup('BaseIncomeCode', 'income_type', FALSE, 'IncomeCode', ["IncomeName","IncomeCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['BaseIncomeCode'] = &$this->BaseIncomeCode;

		// BaseDeductionCode
		$this->BaseDeductionCode = new DbField('deduction_type', 'deduction_type', 'x_BaseDeductionCode', 'BaseDeductionCode', '`BaseDeductionCode`', '`BaseDeductionCode`', 200, 15, -1, FALSE, '`BaseDeductionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BaseDeductionCode->Sortable = TRUE; // Allow sort
		$this->BaseDeductionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BaseDeductionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BaseDeductionCode->Lookup = new Lookup('BaseDeductionCode', 'deduction_type', FALSE, 'DeductionCode', ["DeductionName","DeductionCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['BaseDeductionCode'] = &$this->BaseDeductionCode;

		// TaxExempt
		$this->TaxExempt = new DbField('deduction_type', 'deduction_type', 'x_TaxExempt', 'TaxExempt', '`TaxExempt`', '`TaxExempt`', 16, 1, -1, FALSE, '`TaxExempt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->TaxExempt->Sortable = TRUE; // Allow sort
		$this->TaxExempt->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->TaxExempt->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->TaxExempt->Lookup = new Lookup('TaxExempt', 'yesno', FALSE, 'ChoiceCode', ["YesNo","","",""], [], [], [], [], [], [], '', '');
		$this->TaxExempt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TaxExempt'] = &$this->TaxExempt;

		// JobCode
		$this->JobCode = new DbField('deduction_type', 'deduction_type', 'x_JobCode', 'JobCode', '`JobCode`', '`JobCode`', 200, 255, -1, FALSE, '`JobCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->JobCode->Sortable = TRUE; // Allow sort
		$this->JobCode->Lookup = new Lookup('JobCode', 'job', FALSE, 'JobCode', ["JobName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['JobCode'] = &$this->JobCode;

		// MinimumAmount
		$this->MinimumAmount = new DbField('deduction_type', 'deduction_type', 'x_MinimumAmount', 'MinimumAmount', '`MinimumAmount`', '`MinimumAmount`', 5, 22, -1, FALSE, '`MinimumAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MinimumAmount->Sortable = TRUE; // Allow sort
		$this->MinimumAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['MinimumAmount'] = &$this->MinimumAmount;

		// MaximumAmount
		$this->MaximumAmount = new DbField('deduction_type', 'deduction_type', 'x_MaximumAmount', 'MaximumAmount', '`MaximumAmount`', '`MaximumAmount`', 5, 22, -1, FALSE, '`MaximumAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MaximumAmount->Sortable = TRUE; // Allow sort
		$this->MaximumAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['MaximumAmount'] = &$this->MaximumAmount;

		// EmployerContributionRate
		$this->EmployerContributionRate = new DbField('deduction_type', 'deduction_type', 'x_EmployerContributionRate', 'EmployerContributionRate', '`EmployerContributionRate`', '`EmployerContributionRate`', 5, 22, -1, FALSE, '`EmployerContributionRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployerContributionRate->Sortable = TRUE; // Allow sort
		$this->EmployerContributionRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EmployerContributionRate'] = &$this->EmployerContributionRate;

		// EmployerContributionAmount
		$this->EmployerContributionAmount = new DbField('deduction_type', 'deduction_type', 'x_EmployerContributionAmount', 'EmployerContributionAmount', '`EmployerContributionAmount`', '`EmployerContributionAmount`', 5, 22, -1, FALSE, '`EmployerContributionAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployerContributionAmount->Sortable = TRUE; // Allow sort
		$this->EmployerContributionAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EmployerContributionAmount'] = &$this->EmployerContributionAmount;

		// Application
		$this->Application = new DbField('deduction_type', 'deduction_type', 'x_Application', 'Application', '`Application`', '`Application`', 16, 3, -1, FALSE, '`Application`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Application->Sortable = TRUE; // Allow sort
		$this->Application->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Application->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Application->Lookup = new Lookup('Application', 'means_of_application', FALSE, 'ChoiceCode', ["Application","","",""], [], [], [], [], [], [], '', '');
		$this->Application->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Application'] = &$this->Application;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`deduction_type`";
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
			$this->DeductionCode->setDbValue($conn->insert_ID());
			$rs['DeductionCode'] = $this->DeductionCode->DbValue;
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
		$this->DeductionCode->DbValue = $row['DeductionCode'];
		$this->DeductionName->DbValue = $row['DeductionName'];
		$this->DeductionDescription->DbValue = $row['DeductionDescription'];
		$this->Division->DbValue = $row['Division'];
		$this->DeductionAmount->DbValue = $row['DeductionAmount'];
		$this->DeductionBasicRate->DbValue = $row['DeductionBasicRate'];
		$this->RemittedTo->DbValue = $row['RemittedTo'];
		$this->AccountNo->DbValue = $row['AccountNo'];
		$this->BaseIncomeCode->DbValue = $row['BaseIncomeCode'];
		$this->BaseDeductionCode->DbValue = $row['BaseDeductionCode'];
		$this->TaxExempt->DbValue = $row['TaxExempt'];
		$this->JobCode->DbValue = $row['JobCode'];
		$this->MinimumAmount->DbValue = $row['MinimumAmount'];
		$this->MaximumAmount->DbValue = $row['MaximumAmount'];
		$this->EmployerContributionRate->DbValue = $row['EmployerContributionRate'];
		$this->EmployerContributionAmount->DbValue = $row['EmployerContributionAmount'];
		$this->Application->DbValue = $row['Application'];
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
			return "deduction_typelist.php";
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
		if ($pageName == "deduction_typeview.php")
			return $Language->phrase("View");
		elseif ($pageName == "deduction_typeedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "deduction_typeadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "deduction_typelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("deduction_typeview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("deduction_typeview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "deduction_typeadd.php?" . $this->getUrlParm($parm);
		else
			$url = "deduction_typeadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("deduction_typeedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("deduction_typeadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("deduction_typedelete.php", $this->getUrlParm());
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
		$this->DeductionCode->setDbValue($rs->fields('DeductionCode'));
		$this->DeductionName->setDbValue($rs->fields('DeductionName'));
		$this->DeductionDescription->setDbValue($rs->fields('DeductionDescription'));
		$this->Division->setDbValue($rs->fields('Division'));
		$this->DeductionAmount->setDbValue($rs->fields('DeductionAmount'));
		$this->DeductionBasicRate->setDbValue($rs->fields('DeductionBasicRate'));
		$this->RemittedTo->setDbValue($rs->fields('RemittedTo'));
		$this->AccountNo->setDbValue($rs->fields('AccountNo'));
		$this->BaseIncomeCode->setDbValue($rs->fields('BaseIncomeCode'));
		$this->BaseDeductionCode->setDbValue($rs->fields('BaseDeductionCode'));
		$this->TaxExempt->setDbValue($rs->fields('TaxExempt'));
		$this->JobCode->setDbValue($rs->fields('JobCode'));
		$this->MinimumAmount->setDbValue($rs->fields('MinimumAmount'));
		$this->MaximumAmount->setDbValue($rs->fields('MaximumAmount'));
		$this->EmployerContributionRate->setDbValue($rs->fields('EmployerContributionRate'));
		$this->EmployerContributionAmount->setDbValue($rs->fields('EmployerContributionAmount'));
		$this->Application->setDbValue($rs->fields('Application'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// DeductionCode
		// DeductionName
		// DeductionDescription
		// Division
		// DeductionAmount
		// DeductionBasicRate
		// RemittedTo
		// AccountNo
		// BaseIncomeCode
		// BaseDeductionCode
		// TaxExempt
		// JobCode
		// MinimumAmount
		// MaximumAmount
		// EmployerContributionRate
		// EmployerContributionAmount
		// Application
		// DeductionCode

		$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
		$this->DeductionCode->ViewCustomAttributes = "";

		// DeductionName
		$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->ViewCustomAttributes = "";

		// DeductionDescription
		$this->DeductionDescription->ViewValue = $this->DeductionDescription->CurrentValue;
		$this->DeductionDescription->ViewCustomAttributes = "";

		// Division
		$curVal = strval($this->Division->CurrentValue);
		if ($curVal != "") {
			$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			if ($this->Division->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Division->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Division->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Division->ViewValue->add($this->Division->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->Division->ViewValue = $this->Division->CurrentValue;
				}
			}
		} else {
			$this->Division->ViewValue = NULL;
		}
		$this->Division->ViewCustomAttributes = "";

		// DeductionAmount
		$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
		$this->DeductionAmount->ViewCustomAttributes = "";

		// DeductionBasicRate
		$this->DeductionBasicRate->ViewValue = $this->DeductionBasicRate->CurrentValue;
		$this->DeductionBasicRate->ViewValue = FormatNumber($this->DeductionBasicRate->ViewValue, 2, -2, -2, -2);
		$this->DeductionBasicRate->ViewCustomAttributes = "";

		// RemittedTo
		$this->RemittedTo->ViewValue = $this->RemittedTo->CurrentValue;
		$this->RemittedTo->ViewCustomAttributes = "";

		// AccountNo
		$curVal = strval($this->AccountNo->CurrentValue);
		if ($curVal != "") {
			$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			if ($this->AccountNo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->AccountNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
				}
			}
		} else {
			$this->AccountNo->ViewValue = NULL;
		}
		$this->AccountNo->ViewCustomAttributes = "";

		// BaseIncomeCode
		$curVal = strval($this->BaseIncomeCode->CurrentValue);
		if ($curVal != "") {
			$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			if ($this->BaseIncomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->CurrentValue;
				}
			}
		} else {
			$this->BaseIncomeCode->ViewValue = NULL;
		}
		$this->BaseIncomeCode->ViewCustomAttributes = "";

		// BaseDeductionCode
		$curVal = strval($this->BaseDeductionCode->CurrentValue);
		if ($curVal != "") {
			$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
			if ($this->BaseDeductionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`DeductionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->CurrentValue;
				}
			}
		} else {
			$this->BaseDeductionCode->ViewValue = NULL;
		}
		$this->BaseDeductionCode->ViewCustomAttributes = "";

		// TaxExempt
		$curVal = strval($this->TaxExempt->CurrentValue);
		if ($curVal != "") {
			$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
			if ($this->TaxExempt->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->TaxExempt->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->TaxExempt->ViewValue = $this->TaxExempt->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TaxExempt->ViewValue = $this->TaxExempt->CurrentValue;
				}
			}
		} else {
			$this->TaxExempt->ViewValue = NULL;
		}
		$this->TaxExempt->ViewCustomAttributes = "";

		// JobCode
		$curVal = strval($this->JobCode->CurrentValue);
		if ($curVal != "") {
			$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			if ($this->JobCode->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
				}
			}
		} else {
			$this->JobCode->ViewValue = NULL;
		}
		$this->JobCode->ViewCustomAttributes = "";

		// MinimumAmount
		$this->MinimumAmount->ViewValue = $this->MinimumAmount->CurrentValue;
		$this->MinimumAmount->ViewValue = FormatNumber($this->MinimumAmount->ViewValue, 2, -2, -2, -2);
		$this->MinimumAmount->ViewCustomAttributes = "";

		// MaximumAmount
		$this->MaximumAmount->ViewValue = $this->MaximumAmount->CurrentValue;
		$this->MaximumAmount->ViewValue = FormatNumber($this->MaximumAmount->ViewValue, 2, -2, -2, -2);
		$this->MaximumAmount->ViewCustomAttributes = "";

		// EmployerContributionRate
		$this->EmployerContributionRate->ViewValue = $this->EmployerContributionRate->CurrentValue;
		$this->EmployerContributionRate->ViewValue = FormatNumber($this->EmployerContributionRate->ViewValue, 2, -2, -2, -2);
		$this->EmployerContributionRate->ViewCustomAttributes = "";

		// EmployerContributionAmount
		$this->EmployerContributionAmount->ViewValue = $this->EmployerContributionAmount->CurrentValue;
		$this->EmployerContributionAmount->ViewValue = FormatNumber($this->EmployerContributionAmount->ViewValue, 2, -2, -2, -2);
		$this->EmployerContributionAmount->ViewCustomAttributes = "";

		// Application
		$curVal = strval($this->Application->CurrentValue);
		if ($curVal != "") {
			$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			if ($this->Application->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Application->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Application->ViewValue = $this->Application->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Application->ViewValue = $this->Application->CurrentValue;
				}
			}
		} else {
			$this->Application->ViewValue = NULL;
		}
		$this->Application->ViewCustomAttributes = "";

		// DeductionCode
		$this->DeductionCode->LinkCustomAttributes = "";
		$this->DeductionCode->HrefValue = "";
		$this->DeductionCode->TooltipValue = "";

		// DeductionName
		$this->DeductionName->LinkCustomAttributes = "";
		$this->DeductionName->HrefValue = "";
		$this->DeductionName->TooltipValue = "";

		// DeductionDescription
		$this->DeductionDescription->LinkCustomAttributes = "";
		$this->DeductionDescription->HrefValue = "";
		$this->DeductionDescription->TooltipValue = "";

		// Division
		$this->Division->LinkCustomAttributes = "";
		$this->Division->HrefValue = "";
		$this->Division->TooltipValue = "";

		// DeductionAmount
		$this->DeductionAmount->LinkCustomAttributes = "";
		$this->DeductionAmount->HrefValue = "";
		$this->DeductionAmount->TooltipValue = "";

		// DeductionBasicRate
		$this->DeductionBasicRate->LinkCustomAttributes = "";
		$this->DeductionBasicRate->HrefValue = "";
		$this->DeductionBasicRate->TooltipValue = "";

		// RemittedTo
		$this->RemittedTo->LinkCustomAttributes = "";
		$this->RemittedTo->HrefValue = "";
		$this->RemittedTo->TooltipValue = "";

		// AccountNo
		$this->AccountNo->LinkCustomAttributes = "";
		$this->AccountNo->HrefValue = "";
		$this->AccountNo->TooltipValue = "";

		// BaseIncomeCode
		$this->BaseIncomeCode->LinkCustomAttributes = "";
		$this->BaseIncomeCode->HrefValue = "";
		$this->BaseIncomeCode->TooltipValue = "";

		// BaseDeductionCode
		$this->BaseDeductionCode->LinkCustomAttributes = "";
		$this->BaseDeductionCode->HrefValue = "";
		$this->BaseDeductionCode->TooltipValue = "";

		// TaxExempt
		$this->TaxExempt->LinkCustomAttributes = "";
		$this->TaxExempt->HrefValue = "";
		$this->TaxExempt->TooltipValue = "";

		// JobCode
		$this->JobCode->LinkCustomAttributes = "";
		$this->JobCode->HrefValue = "";
		$this->JobCode->TooltipValue = "";

		// MinimumAmount
		$this->MinimumAmount->LinkCustomAttributes = "";
		$this->MinimumAmount->HrefValue = "";
		$this->MinimumAmount->TooltipValue = "";

		// MaximumAmount
		$this->MaximumAmount->LinkCustomAttributes = "";
		$this->MaximumAmount->HrefValue = "";
		$this->MaximumAmount->TooltipValue = "";

		// EmployerContributionRate
		$this->EmployerContributionRate->LinkCustomAttributes = "";
		$this->EmployerContributionRate->HrefValue = "";
		$this->EmployerContributionRate->TooltipValue = "";

		// EmployerContributionAmount
		$this->EmployerContributionAmount->LinkCustomAttributes = "";
		$this->EmployerContributionAmount->HrefValue = "";
		$this->EmployerContributionAmount->TooltipValue = "";

		// Application
		$this->Application->LinkCustomAttributes = "";
		$this->Application->HrefValue = "";
		$this->Application->TooltipValue = "";

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

		// DeductionCode
		$this->DeductionCode->EditAttrs["class"] = "form-control";
		$this->DeductionCode->EditCustomAttributes = "";
		$this->DeductionCode->EditValue = $this->DeductionCode->CurrentValue;
		$this->DeductionCode->ViewCustomAttributes = "";

		// DeductionName
		$this->DeductionName->EditAttrs["class"] = "form-control";
		$this->DeductionName->EditCustomAttributes = "";
		if (!$this->DeductionName->Raw)
			$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
		$this->DeductionName->EditValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

		// DeductionDescription
		$this->DeductionDescription->EditAttrs["class"] = "form-control";
		$this->DeductionDescription->EditCustomAttributes = "";
		$this->DeductionDescription->EditValue = $this->DeductionDescription->CurrentValue;
		$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

		// Division
		$this->Division->EditCustomAttributes = "";

		// DeductionAmount
		$this->DeductionAmount->EditAttrs["class"] = "form-control";
		$this->DeductionAmount->EditCustomAttributes = "";
		$this->DeductionAmount->EditValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
		if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue))
			$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
		

		// DeductionBasicRate
		$this->DeductionBasicRate->EditAttrs["class"] = "form-control";
		$this->DeductionBasicRate->EditCustomAttributes = "";
		$this->DeductionBasicRate->EditValue = $this->DeductionBasicRate->CurrentValue;
		$this->DeductionBasicRate->PlaceHolder = RemoveHtml($this->DeductionBasicRate->caption());
		if (strval($this->DeductionBasicRate->EditValue) != "" && is_numeric($this->DeductionBasicRate->EditValue))
			$this->DeductionBasicRate->EditValue = FormatNumber($this->DeductionBasicRate->EditValue, -2, -2, -2, -2);
		

		// RemittedTo
		$this->RemittedTo->EditAttrs["class"] = "form-control";
		$this->RemittedTo->EditCustomAttributes = "";
		if (!$this->RemittedTo->Raw)
			$this->RemittedTo->CurrentValue = HtmlDecode($this->RemittedTo->CurrentValue);
		$this->RemittedTo->EditValue = $this->RemittedTo->CurrentValue;
		$this->RemittedTo->PlaceHolder = RemoveHtml($this->RemittedTo->caption());

		// AccountNo
		$this->AccountNo->EditAttrs["class"] = "form-control";
		$this->AccountNo->EditCustomAttributes = "";

		// BaseIncomeCode
		$this->BaseIncomeCode->EditAttrs["class"] = "form-control";
		$this->BaseIncomeCode->EditCustomAttributes = "";

		// BaseDeductionCode
		$this->BaseDeductionCode->EditAttrs["class"] = "form-control";
		$this->BaseDeductionCode->EditCustomAttributes = "";

		// TaxExempt
		$this->TaxExempt->EditAttrs["class"] = "form-control";
		$this->TaxExempt->EditCustomAttributes = "";

		// JobCode
		$this->JobCode->EditCustomAttributes = "";

		// MinimumAmount
		$this->MinimumAmount->EditAttrs["class"] = "form-control";
		$this->MinimumAmount->EditCustomAttributes = "";
		$this->MinimumAmount->EditValue = $this->MinimumAmount->CurrentValue;
		$this->MinimumAmount->PlaceHolder = RemoveHtml($this->MinimumAmount->caption());
		if (strval($this->MinimumAmount->EditValue) != "" && is_numeric($this->MinimumAmount->EditValue))
			$this->MinimumAmount->EditValue = FormatNumber($this->MinimumAmount->EditValue, -2, -2, -2, -2);
		

		// MaximumAmount
		$this->MaximumAmount->EditAttrs["class"] = "form-control";
		$this->MaximumAmount->EditCustomAttributes = "";
		$this->MaximumAmount->EditValue = $this->MaximumAmount->CurrentValue;
		$this->MaximumAmount->PlaceHolder = RemoveHtml($this->MaximumAmount->caption());
		if (strval($this->MaximumAmount->EditValue) != "" && is_numeric($this->MaximumAmount->EditValue))
			$this->MaximumAmount->EditValue = FormatNumber($this->MaximumAmount->EditValue, -2, -2, -2, -2);
		

		// EmployerContributionRate
		$this->EmployerContributionRate->EditAttrs["class"] = "form-control";
		$this->EmployerContributionRate->EditCustomAttributes = "";
		$this->EmployerContributionRate->EditValue = $this->EmployerContributionRate->CurrentValue;
		$this->EmployerContributionRate->PlaceHolder = RemoveHtml($this->EmployerContributionRate->caption());
		if (strval($this->EmployerContributionRate->EditValue) != "" && is_numeric($this->EmployerContributionRate->EditValue))
			$this->EmployerContributionRate->EditValue = FormatNumber($this->EmployerContributionRate->EditValue, -2, -2, -2, -2);
		

		// EmployerContributionAmount
		$this->EmployerContributionAmount->EditAttrs["class"] = "form-control";
		$this->EmployerContributionAmount->EditCustomAttributes = "";
		$this->EmployerContributionAmount->EditValue = $this->EmployerContributionAmount->CurrentValue;
		$this->EmployerContributionAmount->PlaceHolder = RemoveHtml($this->EmployerContributionAmount->caption());
		if (strval($this->EmployerContributionAmount->EditValue) != "" && is_numeric($this->EmployerContributionAmount->EditValue))
			$this->EmployerContributionAmount->EditValue = FormatNumber($this->EmployerContributionAmount->EditValue, -2, -2, -2, -2);
		

		// Application
		$this->Application->EditAttrs["class"] = "form-control";
		$this->Application->EditCustomAttributes = "";

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
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->DeductionDescription);
					$doc->exportCaption($this->Division);
					$doc->exportCaption($this->DeductionAmount);
					$doc->exportCaption($this->DeductionBasicRate);
					$doc->exportCaption($this->RemittedTo);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->BaseIncomeCode);
					$doc->exportCaption($this->BaseDeductionCode);
					$doc->exportCaption($this->TaxExempt);
					$doc->exportCaption($this->JobCode);
					$doc->exportCaption($this->MinimumAmount);
					$doc->exportCaption($this->MaximumAmount);
					$doc->exportCaption($this->EmployerContributionRate);
					$doc->exportCaption($this->EmployerContributionAmount);
					$doc->exportCaption($this->Application);
				} else {
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->DeductionDescription);
					$doc->exportCaption($this->Division);
					$doc->exportCaption($this->DeductionAmount);
					$doc->exportCaption($this->DeductionBasicRate);
					$doc->exportCaption($this->RemittedTo);
					$doc->exportCaption($this->AccountNo);
					$doc->exportCaption($this->BaseIncomeCode);
					$doc->exportCaption($this->BaseDeductionCode);
					$doc->exportCaption($this->TaxExempt);
					$doc->exportCaption($this->JobCode);
					$doc->exportCaption($this->MinimumAmount);
					$doc->exportCaption($this->MaximumAmount);
					$doc->exportCaption($this->EmployerContributionRate);
					$doc->exportCaption($this->EmployerContributionAmount);
					$doc->exportCaption($this->Application);
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
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->DeductionDescription);
						$doc->exportField($this->Division);
						$doc->exportField($this->DeductionAmount);
						$doc->exportField($this->DeductionBasicRate);
						$doc->exportField($this->RemittedTo);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->BaseIncomeCode);
						$doc->exportField($this->BaseDeductionCode);
						$doc->exportField($this->TaxExempt);
						$doc->exportField($this->JobCode);
						$doc->exportField($this->MinimumAmount);
						$doc->exportField($this->MaximumAmount);
						$doc->exportField($this->EmployerContributionRate);
						$doc->exportField($this->EmployerContributionAmount);
						$doc->exportField($this->Application);
					} else {
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->DeductionDescription);
						$doc->exportField($this->Division);
						$doc->exportField($this->DeductionAmount);
						$doc->exportField($this->DeductionBasicRate);
						$doc->exportField($this->RemittedTo);
						$doc->exportField($this->AccountNo);
						$doc->exportField($this->BaseIncomeCode);
						$doc->exportField($this->BaseDeductionCode);
						$doc->exportField($this->TaxExempt);
						$doc->exportField($this->JobCode);
						$doc->exportField($this->MinimumAmount);
						$doc->exportField($this->MaximumAmount);
						$doc->exportField($this->EmployerContributionRate);
						$doc->exportField($this->EmployerContributionAmount);
						$doc->exportField($this->Application);
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