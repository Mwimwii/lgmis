<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for contractor
 */
class contractor extends DbTable
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
	public $ContractorRef;
	public $ProvinceCode;
	public $LACode;
	public $ContractorName;
	public $TradingName;
	public $ZambianContrator;
	public $ContractorType;
	public $BusinessType;
	public $BusinessSector;
	public $BusinessDesc;
	public $PostalAddress;
	public $Town;
	public $PhysicaAddress;
	public $_Email;
	public $Telephone;
	public $Mobile;
	public $Fax;
	public $Country;
	public $ContactPerson;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'contractor';
		$this->TableName = 'contractor';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`contractor`";
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

		// ContractorRef
		$this->ContractorRef = new DbField('contractor', 'contractor', 'x_ContractorRef', 'ContractorRef', '`ContractorRef`', '`ContractorRef`', 3, 10, -1, FALSE, '`ContractorRef`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ContractorRef->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ContractorRef->IsPrimaryKey = TRUE; // Primary key field
		$this->ContractorRef->Sortable = TRUE; // Allow sort
		$this->ContractorRef->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractorRef'] = &$this->ContractorRef;

		// ProvinceCode
		$this->ProvinceCode = new DbField('contractor', 'contractor', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('contractor', 'contractor', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], [], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// ContractorName
		$this->ContractorName = new DbField('contractor', 'contractor', 'x_ContractorName', 'ContractorName', '`ContractorName`', '`ContractorName`', 200, 255, -1, FALSE, '`ContractorName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractorName->Nullable = FALSE; // NOT NULL field
		$this->ContractorName->Required = TRUE; // Required field
		$this->ContractorName->Sortable = TRUE; // Allow sort
		$this->fields['ContractorName'] = &$this->ContractorName;

		// TradingName
		$this->TradingName = new DbField('contractor', 'contractor', 'x_TradingName', 'TradingName', '`TradingName`', '`TradingName`', 200, 255, -1, FALSE, '`TradingName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TradingName->Sortable = TRUE; // Allow sort
		$this->fields['TradingName'] = &$this->TradingName;

		// ZambianContrator
		$this->ZambianContrator = new DbField('contractor', 'contractor', 'x_ZambianContrator', 'ZambianContrator', '`ZambianContrator`', '`ZambianContrator`', 16, 1, -1, FALSE, '`ZambianContrator`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ZambianContrator->Nullable = FALSE; // NOT NULL field
		$this->ZambianContrator->Sortable = TRUE; // Allow sort
		$this->ZambianContrator->DataType = DATATYPE_BOOLEAN;
		$this->ZambianContrator->Lookup = new Lookup('ZambianContrator', 'contractor', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ZambianContrator->OptionCount = 2;
		$this->ZambianContrator->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['ZambianContrator'] = &$this->ZambianContrator;

		// ContractorType
		$this->ContractorType = new DbField('contractor', 'contractor', 'x_ContractorType', 'ContractorType', '`ContractorType`', '`ContractorType`', 17, 3, -1, FALSE, '`ContractorType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ContractorType->Nullable = FALSE; // NOT NULL field
		$this->ContractorType->Required = TRUE; // Required field
		$this->ContractorType->Sortable = TRUE; // Allow sort
		$this->ContractorType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ContractorType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ContractorType->Lookup = new Lookup('ContractorType', 'contractor_type', FALSE, 'ContractorTypeCode', ["ContractortypeName","","",""], [], [], [], [], [], [], '', '');
		$this->ContractorType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractorType'] = &$this->ContractorType;

		// BusinessType
		$this->BusinessType = new DbField('contractor', 'contractor', 'x_BusinessType', 'BusinessType', '`BusinessType`', '`BusinessType`', 17, 3, -1, FALSE, '`BusinessType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BusinessType->Nullable = FALSE; // NOT NULL field
		$this->BusinessType->Required = TRUE; // Required field
		$this->BusinessType->Sortable = TRUE; // Allow sort
		$this->BusinessType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BusinessType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BusinessType->Lookup = new Lookup('BusinessType', 'business_type_contracts', FALSE, 'business_type_code', ["business_type_name","","",""], [], [], [], [], [], [], '', '');
		$this->BusinessType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BusinessType'] = &$this->BusinessType;

		// BusinessSector
		$this->BusinessSector = new DbField('contractor', 'contractor', 'x_BusinessSector', 'BusinessSector', '`BusinessSector`', '`BusinessSector`', 2, 5, -1, FALSE, '`BusinessSector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BusinessSector->Nullable = FALSE; // NOT NULL field
		$this->BusinessSector->Required = TRUE; // Required field
		$this->BusinessSector->Sortable = TRUE; // Allow sort
		$this->BusinessSector->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BusinessSector->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BusinessSector->Lookup = new Lookup('BusinessSector', 'business_sector', FALSE, 'business_sector_code', ["business_sector_name","","",""], [], [], [], [], [], [], '', '');
		$this->BusinessSector->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BusinessSector'] = &$this->BusinessSector;

		// BusinessDesc
		$this->BusinessDesc = new DbField('contractor', 'contractor', 'x_BusinessDesc', 'BusinessDesc', '`BusinessDesc`', '`BusinessDesc`', 200, 255, -1, FALSE, '`BusinessDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->BusinessDesc->Sortable = TRUE; // Allow sort
		$this->fields['BusinessDesc'] = &$this->BusinessDesc;

		// PostalAddress
		$this->PostalAddress = new DbField('contractor', 'contractor', 'x_PostalAddress', 'PostalAddress', '`PostalAddress`', '`PostalAddress`', 200, 255, -1, FALSE, '`PostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->PostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PostalAddress'] = &$this->PostalAddress;

		// Town
		$this->Town = new DbField('contractor', 'contractor', 'x_Town', 'Town', '`Town`', '`Town`', 200, 70, -1, FALSE, '`Town`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Town->Sortable = TRUE; // Allow sort
		$this->fields['Town'] = &$this->Town;

		// PhysicaAddress
		$this->PhysicaAddress = new DbField('contractor', 'contractor', 'x_PhysicaAddress', 'PhysicaAddress', '`PhysicaAddress`', '`PhysicaAddress`', 200, 100, -1, FALSE, '`PhysicaAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->PhysicaAddress->Sortable = TRUE; // Allow sort
		$this->fields['PhysicaAddress'] = &$this->PhysicaAddress;

		// Email
		$this->_Email = new DbField('contractor', 'contractor', 'x__Email', 'Email', '`Email`', '`Email`', 200, 255, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Telephone
		$this->Telephone = new DbField('contractor', 'contractor', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 20, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('contractor', 'contractor', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Fax
		$this->Fax = new DbField('contractor', 'contractor', 'x_Fax', 'Fax', '`Fax`', '`Fax`', 200, 20, -1, FALSE, '`Fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fax->Sortable = TRUE; // Allow sort
		$this->fields['Fax'] = &$this->Fax;

		// Country
		$this->Country = new DbField('contractor', 'contractor', 'x_Country', 'Country', '`Country`', '`Country`', 200, 50, -1, FALSE, '`Country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Country->Sortable = TRUE; // Allow sort
		$this->Country->Lookup = new Lookup('Country', 'country', FALSE, 'CountryName', ["CountryName","","",""], [], [], [], [], [], [], '`CountryName` ASC', '');
		$this->fields['Country'] = &$this->Country;

		// ContactPerson
		$this->ContactPerson = new DbField('contractor', 'contractor', 'x_ContactPerson', 'ContactPerson', '`ContactPerson`', '`ContactPerson`', 200, 255, -1, FALSE, '`ContactPerson`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactPerson->Sortable = TRUE; // Allow sort
		$this->fields['ContactPerson'] = &$this->ContactPerson;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`contractor`";
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
			$this->ContractorRef->setDbValue($conn->insert_ID());
			$rs['ContractorRef'] = $this->ContractorRef->DbValue;
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
			if (array_key_exists('ContractorRef', $rs))
				AddFilter($where, QuotedName('ContractorRef', $this->Dbid) . '=' . QuotedValue($rs['ContractorRef'], $this->ContractorRef->DataType, $this->Dbid));
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
		$this->ContractorRef->DbValue = $row['ContractorRef'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->ContractorName->DbValue = $row['ContractorName'];
		$this->TradingName->DbValue = $row['TradingName'];
		$this->ZambianContrator->DbValue = $row['ZambianContrator'];
		$this->ContractorType->DbValue = $row['ContractorType'];
		$this->BusinessType->DbValue = $row['BusinessType'];
		$this->BusinessSector->DbValue = $row['BusinessSector'];
		$this->BusinessDesc->DbValue = $row['BusinessDesc'];
		$this->PostalAddress->DbValue = $row['PostalAddress'];
		$this->Town->DbValue = $row['Town'];
		$this->PhysicaAddress->DbValue = $row['PhysicaAddress'];
		$this->_Email->DbValue = $row['Email'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->Fax->DbValue = $row['Fax'];
		$this->Country->DbValue = $row['Country'];
		$this->ContactPerson->DbValue = $row['ContactPerson'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ContractorRef` = @ContractorRef@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ContractorRef', $row) ? $row['ContractorRef'] : NULL;
		else
			$val = $this->ContractorRef->OldValue !== NULL ? $this->ContractorRef->OldValue : $this->ContractorRef->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ContractorRef@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "contractorlist.php";
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
		if ($pageName == "contractorview.php")
			return $Language->phrase("View");
		elseif ($pageName == "contractoredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "contractoradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "contractorlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("contractorview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("contractorview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "contractoradd.php?" . $this->getUrlParm($parm);
		else
			$url = "contractoradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("contractoredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("contractoradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("contractordelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ContractorRef:" . JsonEncode($this->ContractorRef->CurrentValue, "number");
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
		if ($this->ContractorRef->CurrentValue != NULL) {
			$url .= "ContractorRef=" . urlencode($this->ContractorRef->CurrentValue);
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
			if (Param("ContractorRef") !== NULL)
				$arKeys[] = Param("ContractorRef");
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
				$this->ContractorRef->CurrentValue = $key;
			else
				$this->ContractorRef->OldValue = $key;
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
		$this->ContractorRef->setDbValue($rs->fields('ContractorRef'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->ContractorName->setDbValue($rs->fields('ContractorName'));
		$this->TradingName->setDbValue($rs->fields('TradingName'));
		$this->ZambianContrator->setDbValue($rs->fields('ZambianContrator'));
		$this->ContractorType->setDbValue($rs->fields('ContractorType'));
		$this->BusinessType->setDbValue($rs->fields('BusinessType'));
		$this->BusinessSector->setDbValue($rs->fields('BusinessSector'));
		$this->BusinessDesc->setDbValue($rs->fields('BusinessDesc'));
		$this->PostalAddress->setDbValue($rs->fields('PostalAddress'));
		$this->Town->setDbValue($rs->fields('Town'));
		$this->PhysicaAddress->setDbValue($rs->fields('PhysicaAddress'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->Fax->setDbValue($rs->fields('Fax'));
		$this->Country->setDbValue($rs->fields('Country'));
		$this->ContactPerson->setDbValue($rs->fields('ContactPerson'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ContractorRef
		// ProvinceCode
		// LACode
		// ContractorName
		// TradingName
		// ZambianContrator
		// ContractorType
		// BusinessType
		// BusinessSector
		// BusinessDesc
		// PostalAddress
		// Town
		// PhysicaAddress
		// Email
		// Telephone
		// Mobile
		// Fax
		// Country
		// ContactPerson
		// ContractorRef

		$this->ContractorRef->ViewValue = $this->ContractorRef->CurrentValue;
		$this->ContractorRef->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
		$curVal = strval($this->ProvinceCode->CurrentValue);
		if ($curVal != "") {
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
				}
			}
		} else {
			$this->ProvinceCode->ViewValue = NULL;
		}
		$this->ProvinceCode->ViewCustomAttributes = "";

		// LACode
		$curVal = strval($this->LACode->CurrentValue);
		if ($curVal != "") {
			$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
			if ($this->LACode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LACode->ViewValue = $this->LACode->CurrentValue;
				}
			}
		} else {
			$this->LACode->ViewValue = NULL;
		}
		$this->LACode->ViewCustomAttributes = "";

		// ContractorName
		$this->ContractorName->ViewValue = $this->ContractorName->CurrentValue;
		$this->ContractorName->ViewCustomAttributes = "";

		// TradingName
		$this->TradingName->ViewValue = $this->TradingName->CurrentValue;
		$this->TradingName->ViewCustomAttributes = "";

		// ZambianContrator
		if (ConvertToBool($this->ZambianContrator->CurrentValue)) {
			$this->ZambianContrator->ViewValue = $this->ZambianContrator->tagCaption(1) != "" ? $this->ZambianContrator->tagCaption(1) : "Yes";
		} else {
			$this->ZambianContrator->ViewValue = $this->ZambianContrator->tagCaption(2) != "" ? $this->ZambianContrator->tagCaption(2) : "No";
		}
		$this->ZambianContrator->ViewCustomAttributes = "";

		// ContractorType
		$curVal = strval($this->ContractorType->CurrentValue);
		if ($curVal != "") {
			$this->ContractorType->ViewValue = $this->ContractorType->lookupCacheOption($curVal);
			if ($this->ContractorType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ContractorTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ContractorType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ContractorType->ViewValue = $this->ContractorType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ContractorType->ViewValue = $this->ContractorType->CurrentValue;
				}
			}
		} else {
			$this->ContractorType->ViewValue = NULL;
		}
		$this->ContractorType->ViewCustomAttributes = "";

		// BusinessType
		$curVal = strval($this->BusinessType->CurrentValue);
		if ($curVal != "") {
			$this->BusinessType->ViewValue = $this->BusinessType->lookupCacheOption($curVal);
			if ($this->BusinessType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`business_type_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BusinessType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BusinessType->ViewValue = $this->BusinessType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BusinessType->ViewValue = $this->BusinessType->CurrentValue;
				}
			}
		} else {
			$this->BusinessType->ViewValue = NULL;
		}
		$this->BusinessType->ViewCustomAttributes = "";

		// BusinessSector
		$curVal = strval($this->BusinessSector->CurrentValue);
		if ($curVal != "") {
			$this->BusinessSector->ViewValue = $this->BusinessSector->lookupCacheOption($curVal);
			if ($this->BusinessSector->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`business_sector_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->BusinessSector->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BusinessSector->ViewValue = $this->BusinessSector->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BusinessSector->ViewValue = $this->BusinessSector->CurrentValue;
				}
			}
		} else {
			$this->BusinessSector->ViewValue = NULL;
		}
		$this->BusinessSector->ViewCustomAttributes = "";

		// BusinessDesc
		$this->BusinessDesc->ViewValue = $this->BusinessDesc->CurrentValue;
		$this->BusinessDesc->ViewCustomAttributes = "";

		// PostalAddress
		$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->ViewCustomAttributes = "";

		// Town
		$this->Town->ViewValue = $this->Town->CurrentValue;
		$this->Town->ViewCustomAttributes = "";

		// PhysicaAddress
		$this->PhysicaAddress->ViewValue = $this->PhysicaAddress->CurrentValue;
		$this->PhysicaAddress->ViewCustomAttributes = "";

		// Email
		$this->_Email->ViewValue = $this->_Email->CurrentValue;
		$this->_Email->ViewCustomAttributes = "";

		// Telephone
		$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
		$this->Telephone->ViewCustomAttributes = "";

		// Mobile
		$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
		$this->Mobile->ViewCustomAttributes = "";

		// Fax
		$this->Fax->ViewValue = $this->Fax->CurrentValue;
		$this->Fax->ViewCustomAttributes = "";

		// Country
		$this->Country->ViewValue = $this->Country->CurrentValue;
		$curVal = strval($this->Country->CurrentValue);
		if ($curVal != "") {
			$this->Country->ViewValue = $this->Country->lookupCacheOption($curVal);
			if ($this->Country->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CountryName`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Country->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Country->ViewValue = $this->Country->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Country->ViewValue = $this->Country->CurrentValue;
				}
			}
		} else {
			$this->Country->ViewValue = NULL;
		}
		$this->Country->ViewCustomAttributes = "";

		// ContactPerson
		$this->ContactPerson->ViewValue = $this->ContactPerson->CurrentValue;
		$this->ContactPerson->ViewCustomAttributes = "";

		// ContractorRef
		$this->ContractorRef->LinkCustomAttributes = "";
		$this->ContractorRef->HrefValue = "";
		$this->ContractorRef->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// ContractorName
		$this->ContractorName->LinkCustomAttributes = "";
		$this->ContractorName->HrefValue = "";
		$this->ContractorName->TooltipValue = "";

		// TradingName
		$this->TradingName->LinkCustomAttributes = "";
		$this->TradingName->HrefValue = "";
		$this->TradingName->TooltipValue = "";

		// ZambianContrator
		$this->ZambianContrator->LinkCustomAttributes = "";
		$this->ZambianContrator->HrefValue = "";
		$this->ZambianContrator->TooltipValue = "";

		// ContractorType
		$this->ContractorType->LinkCustomAttributes = "";
		$this->ContractorType->HrefValue = "";
		$this->ContractorType->TooltipValue = "";

		// BusinessType
		$this->BusinessType->LinkCustomAttributes = "";
		$this->BusinessType->HrefValue = "";
		$this->BusinessType->TooltipValue = "";

		// BusinessSector
		$this->BusinessSector->LinkCustomAttributes = "";
		$this->BusinessSector->HrefValue = "";
		$this->BusinessSector->TooltipValue = "";

		// BusinessDesc
		$this->BusinessDesc->LinkCustomAttributes = "";
		$this->BusinessDesc->HrefValue = "";
		$this->BusinessDesc->TooltipValue = "";

		// PostalAddress
		$this->PostalAddress->LinkCustomAttributes = "";
		$this->PostalAddress->HrefValue = "";
		$this->PostalAddress->TooltipValue = "";

		// Town
		$this->Town->LinkCustomAttributes = "";
		$this->Town->HrefValue = "";
		$this->Town->TooltipValue = "";

		// PhysicaAddress
		$this->PhysicaAddress->LinkCustomAttributes = "";
		$this->PhysicaAddress->HrefValue = "";
		$this->PhysicaAddress->TooltipValue = "";

		// Email
		$this->_Email->LinkCustomAttributes = "";
		$this->_Email->HrefValue = "";
		$this->_Email->TooltipValue = "";

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

		// Country
		$this->Country->LinkCustomAttributes = "";
		$this->Country->HrefValue = "";
		$this->Country->TooltipValue = "";

		// ContactPerson
		$this->ContactPerson->LinkCustomAttributes = "";
		$this->ContactPerson->HrefValue = "";
		$this->ContactPerson->TooltipValue = "";

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

		// ContractorRef
		$this->ContractorRef->EditAttrs["class"] = "form-control";
		$this->ContractorRef->EditCustomAttributes = "";
		$this->ContractorRef->EditValue = $this->ContractorRef->CurrentValue;
		$this->ContractorRef->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";
		$this->ProvinceCode->EditValue = $this->ProvinceCode->CurrentValue;
		$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// ContractorName
		$this->ContractorName->EditAttrs["class"] = "form-control";
		$this->ContractorName->EditCustomAttributes = "";
		if (!$this->ContractorName->Raw)
			$this->ContractorName->CurrentValue = HtmlDecode($this->ContractorName->CurrentValue);
		$this->ContractorName->EditValue = $this->ContractorName->CurrentValue;
		$this->ContractorName->PlaceHolder = RemoveHtml($this->ContractorName->caption());

		// TradingName
		$this->TradingName->EditAttrs["class"] = "form-control";
		$this->TradingName->EditCustomAttributes = "";
		if (!$this->TradingName->Raw)
			$this->TradingName->CurrentValue = HtmlDecode($this->TradingName->CurrentValue);
		$this->TradingName->EditValue = $this->TradingName->CurrentValue;
		$this->TradingName->PlaceHolder = RemoveHtml($this->TradingName->caption());

		// ZambianContrator
		$this->ZambianContrator->EditCustomAttributes = "";
		$this->ZambianContrator->EditValue = $this->ZambianContrator->options(FALSE);

		// ContractorType
		$this->ContractorType->EditAttrs["class"] = "form-control";
		$this->ContractorType->EditCustomAttributes = "";

		// BusinessType
		$this->BusinessType->EditAttrs["class"] = "form-control";
		$this->BusinessType->EditCustomAttributes = "";

		// BusinessSector
		$this->BusinessSector->EditAttrs["class"] = "form-control";
		$this->BusinessSector->EditCustomAttributes = "";

		// BusinessDesc
		$this->BusinessDesc->EditAttrs["class"] = "form-control";
		$this->BusinessDesc->EditCustomAttributes = "";
		$this->BusinessDesc->EditValue = $this->BusinessDesc->CurrentValue;
		$this->BusinessDesc->PlaceHolder = RemoveHtml($this->BusinessDesc->caption());

		// PostalAddress
		$this->PostalAddress->EditAttrs["class"] = "form-control";
		$this->PostalAddress->EditCustomAttributes = "";
		$this->PostalAddress->EditValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

		// Town
		$this->Town->EditAttrs["class"] = "form-control";
		$this->Town->EditCustomAttributes = "";
		if (!$this->Town->Raw)
			$this->Town->CurrentValue = HtmlDecode($this->Town->CurrentValue);
		$this->Town->EditValue = $this->Town->CurrentValue;
		$this->Town->PlaceHolder = RemoveHtml($this->Town->caption());

		// PhysicaAddress
		$this->PhysicaAddress->EditAttrs["class"] = "form-control";
		$this->PhysicaAddress->EditCustomAttributes = "";
		$this->PhysicaAddress->EditValue = $this->PhysicaAddress->CurrentValue;
		$this->PhysicaAddress->PlaceHolder = RemoveHtml($this->PhysicaAddress->caption());

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

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

		// Country
		$this->Country->EditAttrs["class"] = "form-control";
		$this->Country->EditCustomAttributes = "";
		if (!$this->Country->Raw)
			$this->Country->CurrentValue = HtmlDecode($this->Country->CurrentValue);
		$this->Country->EditValue = $this->Country->CurrentValue;
		$this->Country->PlaceHolder = RemoveHtml($this->Country->caption());

		// ContactPerson
		$this->ContactPerson->EditAttrs["class"] = "form-control";
		$this->ContactPerson->EditCustomAttributes = "";
		if (!$this->ContactPerson->Raw)
			$this->ContactPerson->CurrentValue = HtmlDecode($this->ContactPerson->CurrentValue);
		$this->ContactPerson->EditValue = $this->ContactPerson->CurrentValue;
		$this->ContactPerson->PlaceHolder = RemoveHtml($this->ContactPerson->caption());

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
					$doc->exportCaption($this->ContractorRef);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->ContractorName);
					$doc->exportCaption($this->TradingName);
					$doc->exportCaption($this->ZambianContrator);
					$doc->exportCaption($this->ContractorType);
					$doc->exportCaption($this->BusinessType);
					$doc->exportCaption($this->BusinessSector);
					$doc->exportCaption($this->BusinessDesc);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->Town);
					$doc->exportCaption($this->PhysicaAddress);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->ContactPerson);
				} else {
					$doc->exportCaption($this->ContractorRef);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->ContractorName);
					$doc->exportCaption($this->TradingName);
					$doc->exportCaption($this->ZambianContrator);
					$doc->exportCaption($this->ContractorType);
					$doc->exportCaption($this->BusinessType);
					$doc->exportCaption($this->BusinessSector);
					$doc->exportCaption($this->BusinessDesc);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->Town);
					$doc->exportCaption($this->PhysicaAddress);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->ContactPerson);
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
						$doc->exportField($this->ContractorRef);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->ContractorName);
						$doc->exportField($this->TradingName);
						$doc->exportField($this->ZambianContrator);
						$doc->exportField($this->ContractorType);
						$doc->exportField($this->BusinessType);
						$doc->exportField($this->BusinessSector);
						$doc->exportField($this->BusinessDesc);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->Town);
						$doc->exportField($this->PhysicaAddress);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->Country);
						$doc->exportField($this->ContactPerson);
					} else {
						$doc->exportField($this->ContractorRef);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->ContractorName);
						$doc->exportField($this->TradingName);
						$doc->exportField($this->ZambianContrator);
						$doc->exportField($this->ContractorType);
						$doc->exportField($this->BusinessType);
						$doc->exportField($this->BusinessSector);
						$doc->exportField($this->BusinessDesc);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->Town);
						$doc->exportField($this->PhysicaAddress);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->Country);
						$doc->exportField($this->ContactPerson);
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