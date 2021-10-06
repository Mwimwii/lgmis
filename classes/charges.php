<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for charges
 */
class charges extends DbTable
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
	public $ChargeCode;
	public $ChargeDesc;
	public $Fee;
	public $ChargeType;
	public $Frequency;
	public $Installment;
	public $DepartmentCode;
	public $GLAccount;
	public $ChargeGroup;
	public $UnitOfMeasure;
	public $Factor;
	public $PeriodType;
	public $ClearedChargeCode;
	public $PropertyUse;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'charges';
		$this->TableName = 'charges';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`charges`";
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

		// ChargeCode
		$this->ChargeCode = new DbField('charges', 'charges', 'x_ChargeCode', 'ChargeCode', '`ChargeCode`', '`ChargeCode`', 3, 11, -1, FALSE, '`ChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ChargeCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ChargeCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ChargeCode->Sortable = TRUE; // Allow sort
		$this->ChargeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeCode'] = &$this->ChargeCode;

		// ChargeDesc
		$this->ChargeDesc = new DbField('charges', 'charges', 'x_ChargeDesc', 'ChargeDesc', '`ChargeDesc`', '`ChargeDesc`', 200, 255, -1, FALSE, '`ChargeDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeDesc->Nullable = FALSE; // NOT NULL field
		$this->ChargeDesc->Required = TRUE; // Required field
		$this->ChargeDesc->Sortable = TRUE; // Allow sort
		$this->fields['ChargeDesc'] = &$this->ChargeDesc;

		// Fee
		$this->Fee = new DbField('charges', 'charges', 'x_Fee', 'Fee', '`Fee`', '`Fee`', 5, 22, -1, FALSE, '`Fee`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fee->Sortable = TRUE; // Allow sort
		$this->Fee->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Fee'] = &$this->Fee;

		// ChargeType
		$this->ChargeType = new DbField('charges', 'charges', 'x_ChargeType', 'ChargeType', '`ChargeType`', '`ChargeType`', 2, 5, -1, FALSE, '`ChargeType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChargeType->Sortable = TRUE; // Allow sort
		$this->ChargeType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChargeType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChargeType->Lookup = new Lookup('ChargeType', 'charge_type', FALSE, 'ChargeType', ["ChargeTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ChargeType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeType'] = &$this->ChargeType;

		// Frequency
		$this->Frequency = new DbField('charges', 'charges', 'x_Frequency', 'Frequency', '`Frequency`', '`Frequency`', 5, 22, -1, FALSE, '`Frequency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Frequency->Sortable = TRUE; // Allow sort
		$this->Frequency->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Frequency'] = &$this->Frequency;

		// Installment
		$this->Installment = new DbField('charges', 'charges', 'x_Installment', 'Installment', '`Installment`', '`Installment`', 16, 1, -1, FALSE, '`Installment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Installment->Sortable = TRUE; // Allow sort
		$this->Installment->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Installment->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Installment->Lookup = new Lookup('Installment', 'yesno', FALSE, 'ChoiceCode', ["YesNo","","",""], [], [], [], [], [], [], '', '');
		$this->Installment->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Installment'] = &$this->Installment;

		// DepartmentCode
		$this->DepartmentCode = new DbField('charges', 'charges', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], [], [], [], [], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// GLAccount
		$this->GLAccount = new DbField('charges', 'charges', 'x_GLAccount', 'GLAccount', '`GLAccount`', '`GLAccount`', 200, 50, -1, FALSE, '`GLAccount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->GLAccount->Sortable = TRUE; // Allow sort
		$this->GLAccount->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->GLAccount->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->GLAccount->Lookup = new Lookup('GLAccount', 'account_ref', FALSE, 'AccountCode', ["AccountName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['GLAccount'] = &$this->GLAccount;

		// ChargeGroup
		$this->ChargeGroup = new DbField('charges', 'charges', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 200, 2, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChargeGroup->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChargeGroup->Lookup = new Lookup('ChargeGroup', 'charge_group', FALSE, 'ChargeGroup', ["ChargeGroupDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ChargeGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('charges', 'charges', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 30, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->UnitOfMeasure->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UnitOfMeasure->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->UnitOfMeasure->Lookup = new Lookup('UnitOfMeasure', 'rms_measures', FALSE, 'UnitOfMeasure', ["UnitOfMeasure","","",""], [], [], [], [], [], [], '', '');
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// Factor
		$this->Factor = new DbField('charges', 'charges', 'x_Factor', 'Factor', '`Factor`', '`Factor`', 5, 22, -1, FALSE, '`Factor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Factor->Sortable = TRUE; // Allow sort
		$this->Factor->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Factor'] = &$this->Factor;

		// PeriodType
		$this->PeriodType = new DbField('charges', 'charges', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 200, 2, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->PeriodType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PeriodType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PeriodType->Lookup = new Lookup('PeriodType', 'period_type', FALSE, 'Period_Type', ["PeriodTypeName","PeriodLength","UnitOfMeasure",""], [], [], [], [], [], [], '', '');
		$this->fields['PeriodType'] = &$this->PeriodType;

		// ClearedChargeCode
		$this->ClearedChargeCode = new DbField('charges', 'charges', 'x_ClearedChargeCode', 'ClearedChargeCode', '`ClearedChargeCode`', '`ClearedChargeCode`', 200, 200, -1, FALSE, '`ClearedChargeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ClearedChargeCode->Sortable = TRUE; // Allow sort
		$this->ClearedChargeCode->Lookup = new Lookup('ClearedChargeCode', 'charges', FALSE, 'ChargeCode', ["ChargeDesc","ChargeCode","Fee",""], [], [], [], [], [], [], '', '');
		$this->fields['ClearedChargeCode'] = &$this->ClearedChargeCode;

		// PropertyUse
		$this->PropertyUse = new DbField('charges', 'charges', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 4, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->PropertyUse->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PropertyUse->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PropertyUse->Lookup = new Lookup('PropertyUse', 'property_use', FALSE, 'PropertyUse', ["UseDesc","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PropertyUse'] = &$this->PropertyUse;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`charges`";
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
			$this->ChargeCode->setDbValue($conn->insert_ID());
			$rs['ChargeCode'] = $this->ChargeCode->DbValue;
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
			if (array_key_exists('ChargeCode', $rs))
				AddFilter($where, QuotedName('ChargeCode', $this->Dbid) . '=' . QuotedValue($rs['ChargeCode'], $this->ChargeCode->DataType, $this->Dbid));
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
		$this->ChargeCode->DbValue = $row['ChargeCode'];
		$this->ChargeDesc->DbValue = $row['ChargeDesc'];
		$this->Fee->DbValue = $row['Fee'];
		$this->ChargeType->DbValue = $row['ChargeType'];
		$this->Frequency->DbValue = $row['Frequency'];
		$this->Installment->DbValue = $row['Installment'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->GLAccount->DbValue = $row['GLAccount'];
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->Factor->DbValue = $row['Factor'];
		$this->PeriodType->DbValue = $row['PeriodType'];
		$this->ClearedChargeCode->DbValue = $row['ClearedChargeCode'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ChargeCode` = @ChargeCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "chargeslist.php";
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
		if ($pageName == "chargesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "chargesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "chargesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "chargeslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("chargesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("chargesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "chargesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "chargesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("chargesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("chargesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("chargesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ChargeCode:" . JsonEncode($this->ChargeCode->CurrentValue, "number");
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
		if ($this->ChargeCode->CurrentValue != NULL) {
			$url .= "ChargeCode=" . urlencode($this->ChargeCode->CurrentValue);
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
			if (Param("ChargeCode") !== NULL)
				$arKeys[] = Param("ChargeCode");
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
				$this->ChargeCode->CurrentValue = $key;
			else
				$this->ChargeCode->OldValue = $key;
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
		$this->ChargeCode->setDbValue($rs->fields('ChargeCode'));
		$this->ChargeDesc->setDbValue($rs->fields('ChargeDesc'));
		$this->Fee->setDbValue($rs->fields('Fee'));
		$this->ChargeType->setDbValue($rs->fields('ChargeType'));
		$this->Frequency->setDbValue($rs->fields('Frequency'));
		$this->Installment->setDbValue($rs->fields('Installment'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->GLAccount->setDbValue($rs->fields('GLAccount'));
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->Factor->setDbValue($rs->fields('Factor'));
		$this->PeriodType->setDbValue($rs->fields('PeriodType'));
		$this->ClearedChargeCode->setDbValue($rs->fields('ClearedChargeCode'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ChargeCode
		// ChargeDesc
		// Fee
		// ChargeType
		// Frequency
		// Installment
		// DepartmentCode
		// GLAccount
		// ChargeGroup
		// UnitOfMeasure
		// Factor
		// PeriodType
		// ClearedChargeCode
		// PropertyUse
		// ChargeCode

		$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->ViewCustomAttributes = "";

		// ChargeDesc
		$this->ChargeDesc->ViewValue = $this->ChargeDesc->CurrentValue;
		$this->ChargeDesc->ViewCustomAttributes = "";

		// Fee
		$this->Fee->ViewValue = $this->Fee->CurrentValue;
		$this->Fee->ViewValue = FormatNumber($this->Fee->ViewValue, 2, -2, -2, -2);
		$this->Fee->CellCssStyle .= "text-align: right;";
		$this->Fee->ViewCustomAttributes = "";

		// ChargeType
		$curVal = strval($this->ChargeType->CurrentValue);
		if ($curVal != "") {
			$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
			if ($this->ChargeType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ChargeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeType->ViewValue = $this->ChargeType->CurrentValue;
				}
			}
		} else {
			$this->ChargeType->ViewValue = NULL;
		}
		$this->ChargeType->ViewCustomAttributes = "";

		// Frequency
		$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
		$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Frequency->ViewCustomAttributes = "";

		// Installment
		$curVal = strval($this->Installment->CurrentValue);
		if ($curVal != "") {
			$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
			if ($this->Installment->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Installment->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Installment->ViewValue = $this->Installment->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Installment->ViewValue = $this->Installment->CurrentValue;
				}
			}
		} else {
			$this->Installment->ViewValue = NULL;
		}
		$this->Installment->ViewCustomAttributes = "";

		// DepartmentCode
		$curVal = strval($this->DepartmentCode->CurrentValue);
		if ($curVal != "") {
			$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
				}
			}
		} else {
			$this->DepartmentCode->ViewValue = NULL;
		}
		$this->DepartmentCode->ViewCustomAttributes = "";

		// GLAccount
		$curVal = strval($this->GLAccount->CurrentValue);
		if ($curVal != "") {
			$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
			if ($this->GLAccount->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->GLAccount->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->GLAccount->ViewValue = $this->GLAccount->CurrentValue;
				}
			}
		} else {
			$this->GLAccount->ViewValue = NULL;
		}
		$this->GLAccount->ViewCustomAttributes = "";

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

		// UnitOfMeasure
		$curVal = strval($this->UnitOfMeasure->CurrentValue);
		if ($curVal != "") {
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`UnitOfMeasure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
				}
			}
		} else {
			$this->UnitOfMeasure->ViewValue = NULL;
		}
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// Factor
		$this->Factor->ViewValue = $this->Factor->CurrentValue;
		$this->Factor->ViewValue = FormatNumber($this->Factor->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Factor->ViewCustomAttributes = "";

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

		// ClearedChargeCode
		$curVal = strval($this->ClearedChargeCode->CurrentValue);
		if ($curVal != "") {
			$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
			if ($this->ClearedChargeCode->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ClearedChargeCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2);
						$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->CurrentValue;
				}
			}
		} else {
			$this->ClearedChargeCode->ViewValue = NULL;
		}
		$this->ClearedChargeCode->ViewCustomAttributes = "";

		// PropertyUse
		$curVal = strval($this->PropertyUse->CurrentValue);
		if ($curVal != "") {
			$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PropertyUse`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PropertyUse->ViewValue = $this->PropertyUse->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
				}
			}
		} else {
			$this->PropertyUse->ViewValue = NULL;
		}
		$this->PropertyUse->ViewCustomAttributes = "";

		// ChargeCode
		$this->ChargeCode->LinkCustomAttributes = "";
		$this->ChargeCode->HrefValue = "";
		$this->ChargeCode->TooltipValue = "";

		// ChargeDesc
		$this->ChargeDesc->LinkCustomAttributes = "";
		$this->ChargeDesc->HrefValue = "";
		$this->ChargeDesc->TooltipValue = "";

		// Fee
		$this->Fee->LinkCustomAttributes = "";
		$this->Fee->HrefValue = "";
		$this->Fee->TooltipValue = "";

		// ChargeType
		$this->ChargeType->LinkCustomAttributes = "";
		$this->ChargeType->HrefValue = "";
		$this->ChargeType->TooltipValue = "";

		// Frequency
		$this->Frequency->LinkCustomAttributes = "";
		$this->Frequency->HrefValue = "";
		$this->Frequency->TooltipValue = "";

		// Installment
		$this->Installment->LinkCustomAttributes = "";
		$this->Installment->HrefValue = "";
		$this->Installment->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// GLAccount
		$this->GLAccount->LinkCustomAttributes = "";
		$this->GLAccount->HrefValue = "";
		$this->GLAccount->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// Factor
		$this->Factor->LinkCustomAttributes = "";
		$this->Factor->HrefValue = "";
		$this->Factor->TooltipValue = "";

		// PeriodType
		$this->PeriodType->LinkCustomAttributes = "";
		$this->PeriodType->HrefValue = "";
		$this->PeriodType->TooltipValue = "";

		// ClearedChargeCode
		$this->ClearedChargeCode->LinkCustomAttributes = "";
		$this->ClearedChargeCode->HrefValue = "";
		$this->ClearedChargeCode->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

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

		// ChargeCode
		$this->ChargeCode->EditAttrs["class"] = "form-control";
		$this->ChargeCode->EditCustomAttributes = "";
		$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
		$this->ChargeCode->ViewCustomAttributes = "";

		// ChargeDesc
		$this->ChargeDesc->EditAttrs["class"] = "form-control";
		$this->ChargeDesc->EditCustomAttributes = "";
		if (!$this->ChargeDesc->Raw)
			$this->ChargeDesc->CurrentValue = HtmlDecode($this->ChargeDesc->CurrentValue);
		$this->ChargeDesc->EditValue = $this->ChargeDesc->CurrentValue;
		$this->ChargeDesc->PlaceHolder = RemoveHtml($this->ChargeDesc->caption());

		// Fee
		$this->Fee->EditAttrs["class"] = "form-control";
		$this->Fee->EditCustomAttributes = "";
		$this->Fee->EditValue = $this->Fee->CurrentValue;
		$this->Fee->PlaceHolder = RemoveHtml($this->Fee->caption());
		if (strval($this->Fee->EditValue) != "" && is_numeric($this->Fee->EditValue))
			$this->Fee->EditValue = FormatNumber($this->Fee->EditValue, -2, -2, -2, -2);
		

		// ChargeType
		$this->ChargeType->EditAttrs["class"] = "form-control";
		$this->ChargeType->EditCustomAttributes = "";

		// Frequency
		$this->Frequency->EditAttrs["class"] = "form-control";
		$this->Frequency->EditCustomAttributes = "";
		$this->Frequency->EditValue = $this->Frequency->CurrentValue;
		$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
		if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue))
			$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
		

		// Installment
		$this->Installment->EditAttrs["class"] = "form-control";
		$this->Installment->EditCustomAttributes = "";

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";

		// GLAccount
		$this->GLAccount->EditAttrs["class"] = "form-control";
		$this->GLAccount->EditCustomAttributes = "";

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";

		// Factor
		$this->Factor->EditAttrs["class"] = "form-control";
		$this->Factor->EditCustomAttributes = "";
		$this->Factor->EditValue = $this->Factor->CurrentValue;
		$this->Factor->PlaceHolder = RemoveHtml($this->Factor->caption());
		if (strval($this->Factor->EditValue) != "" && is_numeric($this->Factor->EditValue))
			$this->Factor->EditValue = FormatNumber($this->Factor->EditValue, -2, -1, -2, 0);
		

		// PeriodType
		$this->PeriodType->EditAttrs["class"] = "form-control";
		$this->PeriodType->EditCustomAttributes = "";

		// ClearedChargeCode
		$this->ClearedChargeCode->EditCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->EditAttrs["class"] = "form-control";
		$this->PropertyUse->EditCustomAttributes = "";

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
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeDesc);
					$doc->exportCaption($this->Fee);
					$doc->exportCaption($this->ChargeType);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->Installment);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->GLAccount);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Factor);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->ClearedChargeCode);
					$doc->exportCaption($this->PropertyUse);
				} else {
					$doc->exportCaption($this->ChargeCode);
					$doc->exportCaption($this->ChargeDesc);
					$doc->exportCaption($this->Fee);
					$doc->exportCaption($this->ChargeType);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->Installment);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->GLAccount);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Factor);
					$doc->exportCaption($this->PeriodType);
					$doc->exportCaption($this->ClearedChargeCode);
					$doc->exportCaption($this->PropertyUse);
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
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeDesc);
						$doc->exportField($this->Fee);
						$doc->exportField($this->ChargeType);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->Installment);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->GLAccount);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Factor);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->ClearedChargeCode);
						$doc->exportField($this->PropertyUse);
					} else {
						$doc->exportField($this->ChargeCode);
						$doc->exportField($this->ChargeDesc);
						$doc->exportField($this->Fee);
						$doc->exportField($this->ChargeType);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->Installment);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->GLAccount);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Factor);
						$doc->exportField($this->PeriodType);
						$doc->exportField($this->ClearedChargeCode);
						$doc->exportField($this->PropertyUse);
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