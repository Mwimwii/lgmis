<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for paye_final
 */
class paye_final extends DbTable
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
	public $EmployeeID;
	public $FirstName;
	public $MiddleName;
	public $Surname;
	public $ID_TYPE;
	public $ID_NUMBER;
	public $NAMES;
	public $NATURE;
	public $GROSS;
	public $TAXABLE;
	public $TAX_CREDIT;
	public $SocialSecurityNo;
	public $RunDescription;
	public $DeductionCode;
	public $DeductionName;
	public $TAX_DEDUCTED;
	public $PayrollPeriod;
	public $PositionName;
	public $ADJUSTIMENT;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'paye_final';
		$this->TableName = 'paye_final';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`paye_final`";
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

		// EmployeeID
		$this->EmployeeID = new DbField('paye_final', 'paye_final', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// FirstName
		$this->FirstName = new DbField('paye_final', 'paye_final', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('paye_final', 'paye_final', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Surname
		$this->Surname = new DbField('paye_final', 'paye_final', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// ID TYPE
		$this->ID_TYPE = new DbField('paye_final', 'paye_final', 'x_ID_TYPE', 'ID TYPE', '`ID TYPE`', '`ID TYPE`', 200, 3, -1, FALSE, '`ID TYPE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_TYPE->Nullable = FALSE; // NOT NULL field
		$this->ID_TYPE->Required = TRUE; // Required field
		$this->ID_TYPE->Sortable = TRUE; // Allow sort
		$this->fields['ID TYPE'] = &$this->ID_TYPE;

		// ID NUMBER
		$this->ID_NUMBER = new DbField('paye_final', 'paye_final', 'x_ID_NUMBER', 'ID NUMBER', '`ID NUMBER`', '`ID NUMBER`', 200, 13, -1, FALSE, '`ID NUMBER`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_NUMBER->Nullable = FALSE; // NOT NULL field
		$this->ID_NUMBER->Required = TRUE; // Required field
		$this->ID_NUMBER->Sortable = TRUE; // Allow sort
		$this->fields['ID NUMBER'] = &$this->ID_NUMBER;

		// NAMES
		$this->NAMES = new DbField('paye_final', 'paye_final', 'x_NAMES', 'NAMES', '`NAMES`', '`NAMES`', 201, 302, -1, FALSE, '`NAMES`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->NAMES->Sortable = TRUE; // Allow sort
		$this->fields['NAMES'] = &$this->NAMES;

		// NATURE
		$this->NATURE = new DbField('paye_final', 'paye_final', 'x_NATURE', 'NATURE', '`NATURE`', '`NATURE`', 200, 255, -1, FALSE, '`NATURE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NATURE->Nullable = FALSE; // NOT NULL field
		$this->NATURE->Required = TRUE; // Required field
		$this->NATURE->Sortable = TRUE; // Allow sort
		$this->fields['NATURE'] = &$this->NATURE;

		// GROSS
		$this->GROSS = new DbField('paye_final', 'paye_final', 'x_GROSS', 'GROSS', '`GROSS`', '`GROSS`', 5, 23, -1, FALSE, '`GROSS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->GROSS->Sortable = TRUE; // Allow sort
		$this->GROSS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['GROSS'] = &$this->GROSS;

		// TAXABLE
		$this->TAXABLE = new DbField('paye_final', 'paye_final', 'x_TAXABLE', 'TAXABLE', '`TAXABLE`', '`TAXABLE`', 5, 23, -1, FALSE, '`TAXABLE`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TAXABLE->Sortable = TRUE; // Allow sort
		$this->TAXABLE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TAXABLE'] = &$this->TAXABLE;

		// TAX CREDIT
		$this->TAX_CREDIT = new DbField('paye_final', 'paye_final', 'x_TAX_CREDIT', 'TAX CREDIT', '`TAX CREDIT`', '`TAX CREDIT`', 200, 4, -1, FALSE, '`TAX CREDIT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TAX_CREDIT->Nullable = FALSE; // NOT NULL field
		$this->TAX_CREDIT->Required = TRUE; // Required field
		$this->TAX_CREDIT->Sortable = TRUE; // Allow sort
		$this->fields['TAX CREDIT'] = &$this->TAX_CREDIT;

		// SocialSecurityNo
		$this->SocialSecurityNo = new DbField('paye_final', 'paye_final', 'x_SocialSecurityNo', 'SocialSecurityNo', '`SocialSecurityNo`', '`SocialSecurityNo`', 200, 50, -1, FALSE, '`SocialSecurityNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SocialSecurityNo->Sortable = TRUE; // Allow sort
		$this->fields['SocialSecurityNo'] = &$this->SocialSecurityNo;

		// RunDescription
		$this->RunDescription = new DbField('paye_final', 'paye_final', 'x_RunDescription', 'RunDescription', '`RunDescription`', '`RunDescription`', 200, 255, -1, FALSE, '`RunDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RunDescription->Sortable = TRUE; // Allow sort
		$this->fields['RunDescription'] = &$this->RunDescription;

		// DeductionCode
		$this->DeductionCode = new DbField('paye_final', 'paye_final', 'x_DeductionCode', 'DeductionCode', '`DeductionCode`', '`DeductionCode`', 200, 15, -1, FALSE, '`DeductionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionCode->Nullable = FALSE; // NOT NULL field
		$this->DeductionCode->Required = TRUE; // Required field
		$this->DeductionCode->Sortable = TRUE; // Allow sort
		$this->fields['DeductionCode'] = &$this->DeductionCode;

		// DeductionName
		$this->DeductionName = new DbField('paye_final', 'paye_final', 'x_DeductionName', 'DeductionName', '`DeductionName`', '`DeductionName`', 200, 255, -1, FALSE, '`DeductionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeductionName->Nullable = FALSE; // NOT NULL field
		$this->DeductionName->Required = TRUE; // Required field
		$this->DeductionName->Sortable = TRUE; // Allow sort
		$this->fields['DeductionName'] = &$this->DeductionName;

		// TAX DEDUCTED
		$this->TAX_DEDUCTED = new DbField('paye_final', 'paye_final', 'x_TAX_DEDUCTED', 'TAX DEDUCTED', '`TAX DEDUCTED`', '`TAX DEDUCTED`', 201, 417, -1, FALSE, '`TAX DEDUCTED`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->TAX_DEDUCTED->Sortable = TRUE; // Allow sort
		$this->fields['TAX DEDUCTED'] = &$this->TAX_DEDUCTED;

		// PayrollPeriod
		$this->PayrollPeriod = new DbField('paye_final', 'paye_final', 'x_PayrollPeriod', 'PayrollPeriod', '`PayrollPeriod`', '`PayrollPeriod`', 3, 11, -1, FALSE, '`PayrollPeriod`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollPeriod->Nullable = FALSE; // NOT NULL field
		$this->PayrollPeriod->Required = TRUE; // Required field
		$this->PayrollPeriod->Sortable = TRUE; // Allow sort
		$this->PayrollPeriod->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollPeriod'] = &$this->PayrollPeriod;

		// PositionName
		$this->PositionName = new DbField('paye_final', 'paye_final', 'x_PositionName', 'PositionName', '`PositionName`', '`PositionName`', 200, 255, -1, FALSE, '`PositionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionName->Nullable = FALSE; // NOT NULL field
		$this->PositionName->Required = TRUE; // Required field
		$this->PositionName->Sortable = TRUE; // Allow sort
		$this->fields['PositionName'] = &$this->PositionName;

		// ADJUSTIMENT
		$this->ADJUSTIMENT = new DbField('paye_final', 'paye_final', 'x_ADJUSTIMENT', 'ADJUSTIMENT', '`ADJUSTIMENT`', '`ADJUSTIMENT`', 200, 1, -1, FALSE, '`ADJUSTIMENT`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ADJUSTIMENT->Nullable = FALSE; // NOT NULL field
		$this->ADJUSTIMENT->Required = TRUE; // Required field
		$this->ADJUSTIMENT->Sortable = TRUE; // Allow sort
		$this->fields['ADJUSTIMENT'] = &$this->ADJUSTIMENT;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`paye_final`";
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->Surname->DbValue = $row['Surname'];
		$this->ID_TYPE->DbValue = $row['ID TYPE'];
		$this->ID_NUMBER->DbValue = $row['ID NUMBER'];
		$this->NAMES->DbValue = $row['NAMES'];
		$this->NATURE->DbValue = $row['NATURE'];
		$this->GROSS->DbValue = $row['GROSS'];
		$this->TAXABLE->DbValue = $row['TAXABLE'];
		$this->TAX_CREDIT->DbValue = $row['TAX CREDIT'];
		$this->SocialSecurityNo->DbValue = $row['SocialSecurityNo'];
		$this->RunDescription->DbValue = $row['RunDescription'];
		$this->DeductionCode->DbValue = $row['DeductionCode'];
		$this->DeductionName->DbValue = $row['DeductionName'];
		$this->TAX_DEDUCTED->DbValue = $row['TAX DEDUCTED'];
		$this->PayrollPeriod->DbValue = $row['PayrollPeriod'];
		$this->PositionName->DbValue = $row['PositionName'];
		$this->ADJUSTIMENT->DbValue = $row['ADJUSTIMENT'];
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
			return "paye_finallist.php";
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
		if ($pageName == "paye_finalview.php")
			return $Language->phrase("View");
		elseif ($pageName == "paye_finaledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "paye_finaladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "paye_finallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("paye_finalview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("paye_finalview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "paye_finaladd.php?" . $this->getUrlParm($parm);
		else
			$url = "paye_finaladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("paye_finaledit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("paye_finaladd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("paye_finaldelete.php", $this->getUrlParm());
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
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->ID_TYPE->setDbValue($rs->fields('ID TYPE'));
		$this->ID_NUMBER->setDbValue($rs->fields('ID NUMBER'));
		$this->NAMES->setDbValue($rs->fields('NAMES'));
		$this->NATURE->setDbValue($rs->fields('NATURE'));
		$this->GROSS->setDbValue($rs->fields('GROSS'));
		$this->TAXABLE->setDbValue($rs->fields('TAXABLE'));
		$this->TAX_CREDIT->setDbValue($rs->fields('TAX CREDIT'));
		$this->SocialSecurityNo->setDbValue($rs->fields('SocialSecurityNo'));
		$this->RunDescription->setDbValue($rs->fields('RunDescription'));
		$this->DeductionCode->setDbValue($rs->fields('DeductionCode'));
		$this->DeductionName->setDbValue($rs->fields('DeductionName'));
		$this->TAX_DEDUCTED->setDbValue($rs->fields('TAX DEDUCTED'));
		$this->PayrollPeriod->setDbValue($rs->fields('PayrollPeriod'));
		$this->PositionName->setDbValue($rs->fields('PositionName'));
		$this->ADJUSTIMENT->setDbValue($rs->fields('ADJUSTIMENT'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// FirstName
		// MiddleName
		// Surname
		// ID TYPE
		// ID NUMBER
		// NAMES
		// NATURE
		// GROSS
		// TAXABLE
		// TAX CREDIT
		// SocialSecurityNo
		// RunDescription
		// DeductionCode
		// DeductionName
		// TAX DEDUCTED
		// PayrollPeriod
		// PositionName
		// ADJUSTIMENT
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// ID TYPE
		$this->ID_TYPE->ViewValue = $this->ID_TYPE->CurrentValue;
		$this->ID_TYPE->ViewCustomAttributes = "";

		// ID NUMBER
		$this->ID_NUMBER->ViewValue = $this->ID_NUMBER->CurrentValue;
		$this->ID_NUMBER->ViewCustomAttributes = "";

		// NAMES
		$this->NAMES->ViewValue = $this->NAMES->CurrentValue;
		$this->NAMES->ViewCustomAttributes = "";

		// NATURE
		$this->NATURE->ViewValue = $this->NATURE->CurrentValue;
		$this->NATURE->ViewCustomAttributes = "";

		// GROSS
		$this->GROSS->ViewValue = $this->GROSS->CurrentValue;
		$this->GROSS->ViewValue = FormatNumber($this->GROSS->ViewValue, 2, -2, -2, -2);
		$this->GROSS->ViewCustomAttributes = "";

		// TAXABLE
		$this->TAXABLE->ViewValue = $this->TAXABLE->CurrentValue;
		$this->TAXABLE->ViewValue = FormatNumber($this->TAXABLE->ViewValue, 2, -2, -2, -2);
		$this->TAXABLE->ViewCustomAttributes = "";

		// TAX CREDIT
		$this->TAX_CREDIT->ViewValue = $this->TAX_CREDIT->CurrentValue;
		$this->TAX_CREDIT->ViewCustomAttributes = "";

		// SocialSecurityNo
		$this->SocialSecurityNo->ViewValue = $this->SocialSecurityNo->CurrentValue;
		$this->SocialSecurityNo->ViewCustomAttributes = "";

		// RunDescription
		$this->RunDescription->ViewValue = $this->RunDescription->CurrentValue;
		$this->RunDescription->ViewCustomAttributes = "";

		// DeductionCode
		$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
		$this->DeductionCode->ViewCustomAttributes = "";

		// DeductionName
		$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->ViewCustomAttributes = "";

		// TAX DEDUCTED
		$this->TAX_DEDUCTED->ViewValue = $this->TAX_DEDUCTED->CurrentValue;
		$this->TAX_DEDUCTED->ViewCustomAttributes = "";

		// PayrollPeriod
		$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->ViewValue = FormatNumber($this->PayrollPeriod->ViewValue, 0, -2, -2, -2);
		$this->PayrollPeriod->ViewCustomAttributes = "";

		// PositionName
		$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
		$this->PositionName->ViewCustomAttributes = "";

		// ADJUSTIMENT
		$this->ADJUSTIMENT->ViewValue = $this->ADJUSTIMENT->CurrentValue;
		$this->ADJUSTIMENT->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// MiddleName
		$this->MiddleName->LinkCustomAttributes = "";
		$this->MiddleName->HrefValue = "";
		$this->MiddleName->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// ID TYPE
		$this->ID_TYPE->LinkCustomAttributes = "";
		$this->ID_TYPE->HrefValue = "";
		$this->ID_TYPE->TooltipValue = "";

		// ID NUMBER
		$this->ID_NUMBER->LinkCustomAttributes = "";
		$this->ID_NUMBER->HrefValue = "";
		$this->ID_NUMBER->TooltipValue = "";

		// NAMES
		$this->NAMES->LinkCustomAttributes = "";
		$this->NAMES->HrefValue = "";
		$this->NAMES->TooltipValue = "";

		// NATURE
		$this->NATURE->LinkCustomAttributes = "";
		$this->NATURE->HrefValue = "";
		$this->NATURE->TooltipValue = "";

		// GROSS
		$this->GROSS->LinkCustomAttributes = "";
		$this->GROSS->HrefValue = "";
		$this->GROSS->TooltipValue = "";

		// TAXABLE
		$this->TAXABLE->LinkCustomAttributes = "";
		$this->TAXABLE->HrefValue = "";
		$this->TAXABLE->TooltipValue = "";

		// TAX CREDIT
		$this->TAX_CREDIT->LinkCustomAttributes = "";
		$this->TAX_CREDIT->HrefValue = "";
		$this->TAX_CREDIT->TooltipValue = "";

		// SocialSecurityNo
		$this->SocialSecurityNo->LinkCustomAttributes = "";
		$this->SocialSecurityNo->HrefValue = "";
		$this->SocialSecurityNo->TooltipValue = "";

		// RunDescription
		$this->RunDescription->LinkCustomAttributes = "";
		$this->RunDescription->HrefValue = "";
		$this->RunDescription->TooltipValue = "";

		// DeductionCode
		$this->DeductionCode->LinkCustomAttributes = "";
		$this->DeductionCode->HrefValue = "";
		$this->DeductionCode->TooltipValue = "";

		// DeductionName
		$this->DeductionName->LinkCustomAttributes = "";
		$this->DeductionName->HrefValue = "";
		$this->DeductionName->TooltipValue = "";

		// TAX DEDUCTED
		$this->TAX_DEDUCTED->LinkCustomAttributes = "";
		$this->TAX_DEDUCTED->HrefValue = "";
		$this->TAX_DEDUCTED->TooltipValue = "";

		// PayrollPeriod
		$this->PayrollPeriod->LinkCustomAttributes = "";
		$this->PayrollPeriod->HrefValue = "";
		$this->PayrollPeriod->TooltipValue = "";

		// PositionName
		$this->PositionName->LinkCustomAttributes = "";
		$this->PositionName->HrefValue = "";
		$this->PositionName->TooltipValue = "";

		// ADJUSTIMENT
		$this->ADJUSTIMENT->LinkCustomAttributes = "";
		$this->ADJUSTIMENT->HrefValue = "";
		$this->ADJUSTIMENT->TooltipValue = "";

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

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// MiddleName
		$this->MiddleName->EditAttrs["class"] = "form-control";
		$this->MiddleName->EditCustomAttributes = "";
		if (!$this->MiddleName->Raw)
			$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
		$this->MiddleName->EditValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

		// ID TYPE
		$this->ID_TYPE->EditAttrs["class"] = "form-control";
		$this->ID_TYPE->EditCustomAttributes = "";
		if (!$this->ID_TYPE->Raw)
			$this->ID_TYPE->CurrentValue = HtmlDecode($this->ID_TYPE->CurrentValue);
		$this->ID_TYPE->EditValue = $this->ID_TYPE->CurrentValue;
		$this->ID_TYPE->PlaceHolder = RemoveHtml($this->ID_TYPE->caption());

		// ID NUMBER
		$this->ID_NUMBER->EditAttrs["class"] = "form-control";
		$this->ID_NUMBER->EditCustomAttributes = "";
		if (!$this->ID_NUMBER->Raw)
			$this->ID_NUMBER->CurrentValue = HtmlDecode($this->ID_NUMBER->CurrentValue);
		$this->ID_NUMBER->EditValue = $this->ID_NUMBER->CurrentValue;
		$this->ID_NUMBER->PlaceHolder = RemoveHtml($this->ID_NUMBER->caption());

		// NAMES
		$this->NAMES->EditAttrs["class"] = "form-control";
		$this->NAMES->EditCustomAttributes = "";
		$this->NAMES->EditValue = $this->NAMES->CurrentValue;
		$this->NAMES->PlaceHolder = RemoveHtml($this->NAMES->caption());

		// NATURE
		$this->NATURE->EditAttrs["class"] = "form-control";
		$this->NATURE->EditCustomAttributes = "";
		if (!$this->NATURE->Raw)
			$this->NATURE->CurrentValue = HtmlDecode($this->NATURE->CurrentValue);
		$this->NATURE->EditValue = $this->NATURE->CurrentValue;
		$this->NATURE->PlaceHolder = RemoveHtml($this->NATURE->caption());

		// GROSS
		$this->GROSS->EditAttrs["class"] = "form-control";
		$this->GROSS->EditCustomAttributes = "";
		$this->GROSS->EditValue = $this->GROSS->CurrentValue;
		$this->GROSS->PlaceHolder = RemoveHtml($this->GROSS->caption());
		if (strval($this->GROSS->EditValue) != "" && is_numeric($this->GROSS->EditValue))
			$this->GROSS->EditValue = FormatNumber($this->GROSS->EditValue, -2, -2, -2, -2);
		

		// TAXABLE
		$this->TAXABLE->EditAttrs["class"] = "form-control";
		$this->TAXABLE->EditCustomAttributes = "";
		$this->TAXABLE->EditValue = $this->TAXABLE->CurrentValue;
		$this->TAXABLE->PlaceHolder = RemoveHtml($this->TAXABLE->caption());
		if (strval($this->TAXABLE->EditValue) != "" && is_numeric($this->TAXABLE->EditValue))
			$this->TAXABLE->EditValue = FormatNumber($this->TAXABLE->EditValue, -2, -2, -2, -2);
		

		// TAX CREDIT
		$this->TAX_CREDIT->EditAttrs["class"] = "form-control";
		$this->TAX_CREDIT->EditCustomAttributes = "";
		if (!$this->TAX_CREDIT->Raw)
			$this->TAX_CREDIT->CurrentValue = HtmlDecode($this->TAX_CREDIT->CurrentValue);
		$this->TAX_CREDIT->EditValue = $this->TAX_CREDIT->CurrentValue;
		$this->TAX_CREDIT->PlaceHolder = RemoveHtml($this->TAX_CREDIT->caption());

		// SocialSecurityNo
		$this->SocialSecurityNo->EditAttrs["class"] = "form-control";
		$this->SocialSecurityNo->EditCustomAttributes = "";
		if (!$this->SocialSecurityNo->Raw)
			$this->SocialSecurityNo->CurrentValue = HtmlDecode($this->SocialSecurityNo->CurrentValue);
		$this->SocialSecurityNo->EditValue = $this->SocialSecurityNo->CurrentValue;
		$this->SocialSecurityNo->PlaceHolder = RemoveHtml($this->SocialSecurityNo->caption());

		// RunDescription
		$this->RunDescription->EditAttrs["class"] = "form-control";
		$this->RunDescription->EditCustomAttributes = "";
		if (!$this->RunDescription->Raw)
			$this->RunDescription->CurrentValue = HtmlDecode($this->RunDescription->CurrentValue);
		$this->RunDescription->EditValue = $this->RunDescription->CurrentValue;
		$this->RunDescription->PlaceHolder = RemoveHtml($this->RunDescription->caption());

		// DeductionCode
		$this->DeductionCode->EditAttrs["class"] = "form-control";
		$this->DeductionCode->EditCustomAttributes = "";
		if (!$this->DeductionCode->Raw)
			$this->DeductionCode->CurrentValue = HtmlDecode($this->DeductionCode->CurrentValue);
		$this->DeductionCode->EditValue = $this->DeductionCode->CurrentValue;
		$this->DeductionCode->PlaceHolder = RemoveHtml($this->DeductionCode->caption());

		// DeductionName
		$this->DeductionName->EditAttrs["class"] = "form-control";
		$this->DeductionName->EditCustomAttributes = "";
		if (!$this->DeductionName->Raw)
			$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
		$this->DeductionName->EditValue = $this->DeductionName->CurrentValue;
		$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

		// TAX DEDUCTED
		$this->TAX_DEDUCTED->EditAttrs["class"] = "form-control";
		$this->TAX_DEDUCTED->EditCustomAttributes = "";
		$this->TAX_DEDUCTED->EditValue = $this->TAX_DEDUCTED->CurrentValue;
		$this->TAX_DEDUCTED->PlaceHolder = RemoveHtml($this->TAX_DEDUCTED->caption());

		// PayrollPeriod
		$this->PayrollPeriod->EditAttrs["class"] = "form-control";
		$this->PayrollPeriod->EditCustomAttributes = "";
		$this->PayrollPeriod->EditValue = $this->PayrollPeriod->CurrentValue;
		$this->PayrollPeriod->PlaceHolder = RemoveHtml($this->PayrollPeriod->caption());

		// PositionName
		$this->PositionName->EditAttrs["class"] = "form-control";
		$this->PositionName->EditCustomAttributes = "";
		if (!$this->PositionName->Raw)
			$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
		$this->PositionName->EditValue = $this->PositionName->CurrentValue;
		$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

		// ADJUSTIMENT
		$this->ADJUSTIMENT->EditAttrs["class"] = "form-control";
		$this->ADJUSTIMENT->EditCustomAttributes = "";
		if (!$this->ADJUSTIMENT->Raw)
			$this->ADJUSTIMENT->CurrentValue = HtmlDecode($this->ADJUSTIMENT->CurrentValue);
		$this->ADJUSTIMENT->EditValue = $this->ADJUSTIMENT->CurrentValue;
		$this->ADJUSTIMENT->PlaceHolder = RemoveHtml($this->ADJUSTIMENT->caption());

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
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->ID_TYPE);
					$doc->exportCaption($this->ID_NUMBER);
					$doc->exportCaption($this->NAMES);
					$doc->exportCaption($this->NATURE);
					$doc->exportCaption($this->GROSS);
					$doc->exportCaption($this->TAXABLE);
					$doc->exportCaption($this->TAX_CREDIT);
					$doc->exportCaption($this->SocialSecurityNo);
					$doc->exportCaption($this->RunDescription);
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->TAX_DEDUCTED);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->ADJUSTIMENT);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->ID_TYPE);
					$doc->exportCaption($this->ID_NUMBER);
					$doc->exportCaption($this->NATURE);
					$doc->exportCaption($this->GROSS);
					$doc->exportCaption($this->TAXABLE);
					$doc->exportCaption($this->TAX_CREDIT);
					$doc->exportCaption($this->SocialSecurityNo);
					$doc->exportCaption($this->RunDescription);
					$doc->exportCaption($this->DeductionCode);
					$doc->exportCaption($this->DeductionName);
					$doc->exportCaption($this->PayrollPeriod);
					$doc->exportCaption($this->PositionName);
					$doc->exportCaption($this->ADJUSTIMENT);
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
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->ID_TYPE);
						$doc->exportField($this->ID_NUMBER);
						$doc->exportField($this->NAMES);
						$doc->exportField($this->NATURE);
						$doc->exportField($this->GROSS);
						$doc->exportField($this->TAXABLE);
						$doc->exportField($this->TAX_CREDIT);
						$doc->exportField($this->SocialSecurityNo);
						$doc->exportField($this->RunDescription);
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->TAX_DEDUCTED);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->ADJUSTIMENT);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->ID_TYPE);
						$doc->exportField($this->ID_NUMBER);
						$doc->exportField($this->NATURE);
						$doc->exportField($this->GROSS);
						$doc->exportField($this->TAXABLE);
						$doc->exportField($this->TAX_CREDIT);
						$doc->exportField($this->SocialSecurityNo);
						$doc->exportField($this->RunDescription);
						$doc->exportField($this->DeductionCode);
						$doc->exportField($this->DeductionName);
						$doc->exportField($this->PayrollPeriod);
						$doc->exportField($this->PositionName);
						$doc->exportField($this->ADJUSTIMENT);
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