<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for property
 */
class property extends DbTable
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
	public $ClientSerNo;
	public $ClientID;
	public $PropertyGroup;
	public $PropertyType;
	public $Location;
	public $PropertyStatus;
	public $PropertyUse;
	public $LandExtentInHA;
	public $RateableValue;
	public $SupplementaryValue;
	public $ExemptCode;
	public $Improvements;
	public $StreetAddress;
	public $Longitude;
	public $Latitude;
	public $Incumberance;
	public $SubDivisionOf;
	public $LastUpdatedBy;
	public $LastUpdateDate;
	public $ValuationNo;
	public $LandValue;
	public $ImprovementsValue;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'property';
		$this->TableName = 'property';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`property`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
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

		// PropertyNo
		$this->PropertyNo = new DbField('property', 'property', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 200, 255, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Nullable = FALSE; // NOT NULL field
		$this->PropertyNo->Required = TRUE; // Required field
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// ClientSerNo
		$this->ClientSerNo = new DbField('property', 'property', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Nullable = FALSE; // NOT NULL field
		$this->ClientSerNo->Required = TRUE; // Required field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->Lookup = new Lookup('ClientSerNo', 'client', FALSE, 'ClientSerNo', ["ClientName","ClientID","",""], [], [], [], [], ["ClientID"], ["x_ClientID"], '', '');
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientID
		$this->ClientID = new DbField('property', 'property', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->ClientID->Lookup = new Lookup('ClientID', 'client', FALSE, 'ClientID', ["ClientName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ClientID'] = &$this->ClientID;

		// PropertyGroup
		$this->PropertyGroup = new DbField('property', 'property', 'x_PropertyGroup', 'PropertyGroup', '`PropertyGroup`', '`PropertyGroup`', 16, 3, -1, FALSE, '`PropertyGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PropertyGroup->Sortable = TRUE; // Allow sort
		$this->PropertyGroup->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PropertyGroup->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PropertyGroup->Lookup = new Lookup('PropertyGroup', 'property_group', FALSE, 'PropertyGroup', ["PropertyGroupDesc","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyGroup'] = &$this->PropertyGroup;

		// PropertyType
		$this->PropertyType = new DbField('property', 'property', 'x_PropertyType', 'PropertyType', '`PropertyType`', '`PropertyType`', 16, 1, -1, FALSE, '`PropertyType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyType->Sortable = TRUE; // Allow sort
		$this->PropertyType->Lookup = new Lookup('PropertyType', 'property_type', FALSE, 'PropertyType', ["PropertyTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyType'] = &$this->PropertyType;

		// Location
		$this->Location = new DbField('property', 'property', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Location->Nullable = FALSE; // NOT NULL field
		$this->Location->Required = TRUE; // Required field
		$this->Location->Sortable = TRUE; // Allow sort
		$this->Location->Lookup = new Lookup('Location', 'property_zone', FALSE, 'AreaName', ["AreaName","","",""], [], [], [], [], [], [], '`AreaName` ASC', '');
		$this->fields['Location'] = &$this->Location;

		// PropertyStatus
		$this->PropertyStatus = new DbField('property', 'property', 'x_PropertyStatus', 'PropertyStatus', '`PropertyStatus`', '`PropertyStatus`', 16, 1, -1, FALSE, '`PropertyStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyStatus->Sortable = TRUE; // Allow sort
		$this->PropertyStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyStatus'] = &$this->PropertyStatus;

		// PropertyUse
		$this->PropertyUse = new DbField('property', 'property', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 4, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->PropertyUse->Nullable = FALSE; // NOT NULL field
		$this->PropertyUse->Required = TRUE; // Required field
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->PropertyUse->Lookup = new Lookup('PropertyUse', 'property_use', FALSE, 'PropertyUse', ["UseDesc","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyUse->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// LandExtentInHA
		$this->LandExtentInHA = new DbField('property', 'property', 'x_LandExtentInHA', 'LandExtentInHA', '`LandExtentInHA`', '`LandExtentInHA`', 5, 22, -1, FALSE, '`LandExtentInHA`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandExtentInHA->Sortable = TRUE; // Allow sort
		$this->LandExtentInHA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandExtentInHA'] = &$this->LandExtentInHA;

		// RateableValue
		$this->RateableValue = new DbField('property', 'property', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// SupplementaryValue
		$this->SupplementaryValue = new DbField('property', 'property', 'x_SupplementaryValue', 'SupplementaryValue', '`SupplementaryValue`', '`SupplementaryValue`', 5, 22, -1, FALSE, '`SupplementaryValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplementaryValue->Sortable = TRUE; // Allow sort
		$this->SupplementaryValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SupplementaryValue'] = &$this->SupplementaryValue;

		// ExemptCode
		$this->ExemptCode = new DbField('property', 'property', 'x_ExemptCode', 'ExemptCode', '`ExemptCode`', '`ExemptCode`', 200, 15, -1, FALSE, '`ExemptCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExemptCode->Sortable = TRUE; // Allow sort
		$this->ExemptCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ExemptCode'] = &$this->ExemptCode;

		// Improvements
		$this->Improvements = new DbField('property', 'property', 'x_Improvements', 'Improvements', '`Improvements`', '`Improvements`', 200, 255, -1, FALSE, '`Improvements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Improvements->Nullable = FALSE; // NOT NULL field
		$this->Improvements->Required = TRUE; // Required field
		$this->Improvements->Sortable = TRUE; // Allow sort
		$this->fields['Improvements'] = &$this->Improvements;

		// StreetAddress
		$this->StreetAddress = new DbField('property', 'property', 'x_StreetAddress', 'StreetAddress', '`StreetAddress`', '`StreetAddress`', 200, 255, -1, FALSE, '`StreetAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->StreetAddress->Sortable = TRUE; // Allow sort
		$this->fields['StreetAddress'] = &$this->StreetAddress;

		// Longitude
		$this->Longitude = new DbField('property', 'property', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 12, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// Latitude
		$this->Latitude = new DbField('property', 'property', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 12, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// Incumberance
		$this->Incumberance = new DbField('property', 'property', 'x_Incumberance', 'Incumberance', '`Incumberance`', '`Incumberance`', 200, 1, -1, FALSE, '`Incumberance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Incumberance->Sortable = TRUE; // Allow sort
		$this->fields['Incumberance'] = &$this->Incumberance;

		// SubDivisionOf
		$this->SubDivisionOf = new DbField('property', 'property', 'x_SubDivisionOf', 'SubDivisionOf', '`SubDivisionOf`', '`SubDivisionOf`', 3, 11, -1, FALSE, '`SubDivisionOf`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubDivisionOf->Sortable = TRUE; // Allow sort
		$this->SubDivisionOf->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubDivisionOf'] = &$this->SubDivisionOf;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('property', 'property', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('property', 'property', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdateDate->Sortable = TRUE; // Allow sort
		$this->LastUpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdateDate'] = &$this->LastUpdateDate;

		// ValuationNo
		$this->ValuationNo = new DbField('property', 'property', 'x_ValuationNo', 'ValuationNo', '`ValuationNo`', '`ValuationNo`', 3, 11, -1, FALSE, '`ValuationNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ValuationNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ValuationNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ValuationNo->Sortable = TRUE; // Allow sort
		$this->ValuationNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ValuationNo'] = &$this->ValuationNo;

		// LandValue
		$this->LandValue = new DbField('property', 'property', 'x_LandValue', 'LandValue', '`LandValue`', '`LandValue`', 5, 22, -1, FALSE, '`LandValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandValue->Sortable = TRUE; // Allow sort
		$this->LandValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandValue'] = &$this->LandValue;

		// ImprovementsValue
		$this->ImprovementsValue = new DbField('property', 'property', 'x_ImprovementsValue', 'ImprovementsValue', '`ImprovementsValue`', '`ImprovementsValue`', 5, 22, -1, FALSE, '`ImprovementsValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ImprovementsValue->Sortable = TRUE; // Allow sort
		$this->ImprovementsValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ImprovementsValue'] = &$this->ImprovementsValue;
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
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientSerNo->getSessionValue() != "")
				$masterFilter .= "`ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientSerNo->getSessionValue() != "")
				$detailFilter .= "`ClientSerNo`=" . QuotedValue($this->ClientSerNo->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_client()
	{
		return "`ClientSerNo`=@ClientSerNo@";
	}

	// Detail filter
	public function sqlDetailFilter_client()
	{
		return "`ClientSerNo`=@ClientSerNo@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property`";
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
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->PropertyGroup->DbValue = $row['PropertyGroup'];
		$this->PropertyType->DbValue = $row['PropertyType'];
		$this->Location->DbValue = $row['Location'];
		$this->PropertyStatus->DbValue = $row['PropertyStatus'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->LandExtentInHA->DbValue = $row['LandExtentInHA'];
		$this->RateableValue->DbValue = $row['RateableValue'];
		$this->SupplementaryValue->DbValue = $row['SupplementaryValue'];
		$this->ExemptCode->DbValue = $row['ExemptCode'];
		$this->Improvements->DbValue = $row['Improvements'];
		$this->StreetAddress->DbValue = $row['StreetAddress'];
		$this->Longitude->DbValue = $row['Longitude'];
		$this->Latitude->DbValue = $row['Latitude'];
		$this->Incumberance->DbValue = $row['Incumberance'];
		$this->SubDivisionOf->DbValue = $row['SubDivisionOf'];
		$this->LastUpdatedBy->DbValue = $row['LastUpdatedBy'];
		$this->LastUpdateDate->DbValue = $row['LastUpdateDate'];
		$this->ValuationNo->DbValue = $row['ValuationNo'];
		$this->LandValue->DbValue = $row['LandValue'];
		$this->ImprovementsValue->DbValue = $row['ImprovementsValue'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ValuationNo` = @ValuationNo@";
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
			return "propertylist.php";
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
		if ($pageName == "propertyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "propertyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "propertyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "propertylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("propertyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("propertyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "propertyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "propertyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("propertyedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("propertyadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("propertydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "client" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ValuationNo:" . JsonEncode($this->ValuationNo->CurrentValue, "number");
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
			if (Param("ValuationNo") !== NULL)
				$arKeys[] = Param("ValuationNo");
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
				$this->ValuationNo->CurrentValue = $key;
			else
				$this->ValuationNo->OldValue = $key;
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
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->PropertyGroup->setDbValue($rs->fields('PropertyGroup'));
		$this->PropertyType->setDbValue($rs->fields('PropertyType'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->PropertyStatus->setDbValue($rs->fields('PropertyStatus'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->LandExtentInHA->setDbValue($rs->fields('LandExtentInHA'));
		$this->RateableValue->setDbValue($rs->fields('RateableValue'));
		$this->SupplementaryValue->setDbValue($rs->fields('SupplementaryValue'));
		$this->ExemptCode->setDbValue($rs->fields('ExemptCode'));
		$this->Improvements->setDbValue($rs->fields('Improvements'));
		$this->StreetAddress->setDbValue($rs->fields('StreetAddress'));
		$this->Longitude->setDbValue($rs->fields('Longitude'));
		$this->Latitude->setDbValue($rs->fields('Latitude'));
		$this->Incumberance->setDbValue($rs->fields('Incumberance'));
		$this->SubDivisionOf->setDbValue($rs->fields('SubDivisionOf'));
		$this->LastUpdatedBy->setDbValue($rs->fields('LastUpdatedBy'));
		$this->LastUpdateDate->setDbValue($rs->fields('LastUpdateDate'));
		$this->ValuationNo->setDbValue($rs->fields('ValuationNo'));
		$this->LandValue->setDbValue($rs->fields('LandValue'));
		$this->ImprovementsValue->setDbValue($rs->fields('ImprovementsValue'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// PropertyNo
		// ClientSerNo
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// PropertyStatus
		// PropertyUse
		// LandExtentInHA
		// RateableValue
		// SupplementaryValue
		// ExemptCode
		// Improvements
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// SubDivisionOf
		// LastUpdatedBy
		// LastUpdateDate
		// ValuationNo
		// LandValue
		// ImprovementsValue
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
		$curVal = strval($this->ClientID->CurrentValue);
		if ($curVal != "") {
			$this->ClientID->ViewValue = $this->ClientID->lookupCacheOption($curVal);
			if ($this->ClientID->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ClientID`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ClientID->ViewValue = $this->ClientID->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
				}
			}
		} else {
			$this->ClientID->ViewValue = NULL;
		}
		$this->ClientID->ViewCustomAttributes = "";

		// PropertyGroup
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

		// PropertyType
		$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
		$curVal = strval($this->PropertyType->CurrentValue);
		if ($curVal != "") {
			$this->PropertyType->ViewValue = $this->PropertyType->lookupCacheOption($curVal);
			if ($this->PropertyType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PropertyType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PropertyType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PropertyType->ViewValue = $this->PropertyType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
				}
			}
		} else {
			$this->PropertyType->ViewValue = NULL;
		}
		$this->PropertyType->ViewCustomAttributes = "";

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

		// PropertyStatus
		$this->PropertyStatus->ViewValue = $this->PropertyStatus->CurrentValue;
		$this->PropertyStatus->ViewCustomAttributes = "";

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

		// LandExtentInHA
		$this->LandExtentInHA->ViewValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->ViewValue = FormatNumber($this->LandExtentInHA->ViewValue, 4, -2, -2, -2);
		$this->LandExtentInHA->CellCssStyle .= "text-align: right;";
		$this->LandExtentInHA->ViewCustomAttributes = "";

		// RateableValue
		$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
		$this->RateableValue->CellCssStyle .= "text-align: right;";
		$this->RateableValue->ViewCustomAttributes = "";

		// SupplementaryValue
		$this->SupplementaryValue->ViewValue = $this->SupplementaryValue->CurrentValue;
		$this->SupplementaryValue->ViewValue = FormatNumber($this->SupplementaryValue->ViewValue, 2, -2, -2, -2);
		$this->SupplementaryValue->CellCssStyle .= "text-align: right;";
		$this->SupplementaryValue->ViewCustomAttributes = "";

		// ExemptCode
		$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->ViewCustomAttributes = "";

		// Improvements
		$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
		$this->Improvements->ViewCustomAttributes = "";

		// StreetAddress
		$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
		$this->StreetAddress->ViewCustomAttributes = "";

		// Longitude
		$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Longitude->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Latitude->ViewCustomAttributes = "";

		// Incumberance
		$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
		$this->Incumberance->ViewCustomAttributes = "";

		// SubDivisionOf
		$this->SubDivisionOf->ViewValue = $this->SubDivisionOf->CurrentValue;
		$this->SubDivisionOf->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// ValuationNo
		$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

		// LandValue
		$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
		$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
		$this->LandValue->ViewCustomAttributes = "";

		// ImprovementsValue
		$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
		$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, 2, -2, -2, -2);
		$this->ImprovementsValue->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->LinkCustomAttributes = "";
		$this->PropertyNo->HrefValue = "";
		$this->PropertyNo->TooltipValue = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// PropertyGroup
		$this->PropertyGroup->LinkCustomAttributes = "";
		$this->PropertyGroup->HrefValue = "";
		$this->PropertyGroup->TooltipValue = "";

		// PropertyType
		$this->PropertyType->LinkCustomAttributes = "";
		$this->PropertyType->HrefValue = "";
		$this->PropertyType->TooltipValue = "";

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// PropertyStatus
		$this->PropertyStatus->LinkCustomAttributes = "";
		$this->PropertyStatus->HrefValue = "";
		$this->PropertyStatus->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

		// LandExtentInHA
		$this->LandExtentInHA->LinkCustomAttributes = "";
		$this->LandExtentInHA->HrefValue = "";
		$this->LandExtentInHA->TooltipValue = "";

		// RateableValue
		$this->RateableValue->LinkCustomAttributes = "";
		$this->RateableValue->HrefValue = "";
		$this->RateableValue->TooltipValue = "";

		// SupplementaryValue
		$this->SupplementaryValue->LinkCustomAttributes = "";
		$this->SupplementaryValue->HrefValue = "";
		$this->SupplementaryValue->TooltipValue = "";

		// ExemptCode
		$this->ExemptCode->LinkCustomAttributes = "";
		$this->ExemptCode->HrefValue = "";
		$this->ExemptCode->TooltipValue = "";

		// Improvements
		$this->Improvements->LinkCustomAttributes = "";
		$this->Improvements->HrefValue = "";
		$this->Improvements->TooltipValue = "";

		// StreetAddress
		$this->StreetAddress->LinkCustomAttributes = "";
		$this->StreetAddress->HrefValue = "";
		$this->StreetAddress->TooltipValue = "";

		// Longitude
		$this->Longitude->LinkCustomAttributes = "";
		$this->Longitude->HrefValue = "";
		$this->Longitude->TooltipValue = "";

		// Latitude
		$this->Latitude->LinkCustomAttributes = "";
		$this->Latitude->HrefValue = "";
		$this->Latitude->TooltipValue = "";

		// Incumberance
		$this->Incumberance->LinkCustomAttributes = "";
		$this->Incumberance->HrefValue = "";
		$this->Incumberance->TooltipValue = "";

		// SubDivisionOf
		$this->SubDivisionOf->LinkCustomAttributes = "";
		$this->SubDivisionOf->HrefValue = "";
		$this->SubDivisionOf->TooltipValue = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->LinkCustomAttributes = "";
		$this->LastUpdatedBy->HrefValue = "";
		$this->LastUpdatedBy->TooltipValue = "";

		// LastUpdateDate
		$this->LastUpdateDate->LinkCustomAttributes = "";
		$this->LastUpdateDate->HrefValue = "";
		$this->LastUpdateDate->TooltipValue = "";

		// ValuationNo
		$this->ValuationNo->LinkCustomAttributes = "";
		$this->ValuationNo->HrefValue = "";
		$this->ValuationNo->TooltipValue = "";

		// LandValue
		$this->LandValue->LinkCustomAttributes = "";
		$this->LandValue->HrefValue = "";
		$this->LandValue->TooltipValue = "";

		// ImprovementsValue
		$this->ImprovementsValue->LinkCustomAttributes = "";
		$this->ImprovementsValue->HrefValue = "";
		$this->ImprovementsValue->TooltipValue = "";

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

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		if ($this->ClientSerNo->getSessionValue() != "") {
			$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
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
		} else {
			$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
			$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
		}

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// PropertyGroup
		$this->PropertyGroup->EditAttrs["class"] = "form-control";
		$this->PropertyGroup->EditCustomAttributes = "";

		// PropertyType
		$this->PropertyType->EditAttrs["class"] = "form-control";
		$this->PropertyType->EditCustomAttributes = "";
		$this->PropertyType->EditValue = $this->PropertyType->CurrentValue;
		$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

		// Location
		$this->Location->EditCustomAttributes = "";

		// PropertyStatus
		$this->PropertyStatus->EditAttrs["class"] = "form-control";
		$this->PropertyStatus->EditCustomAttributes = "";
		$this->PropertyStatus->EditValue = $this->PropertyStatus->CurrentValue;
		$this->PropertyStatus->PlaceHolder = RemoveHtml($this->PropertyStatus->caption());

		// PropertyUse
		$this->PropertyUse->EditCustomAttributes = "";

		// LandExtentInHA
		$this->LandExtentInHA->EditAttrs["class"] = "form-control";
		$this->LandExtentInHA->EditCustomAttributes = "";
		$this->LandExtentInHA->EditValue = $this->LandExtentInHA->CurrentValue;
		$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());
		if (strval($this->LandExtentInHA->EditValue) != "" && is_numeric($this->LandExtentInHA->EditValue))
			$this->LandExtentInHA->EditValue = FormatNumber($this->LandExtentInHA->EditValue, -2, -2, -2, -2);
		

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
		

		// ExemptCode
		$this->ExemptCode->EditAttrs["class"] = "form-control";
		$this->ExemptCode->EditCustomAttributes = "";
		if (!$this->ExemptCode->Raw)
			$this->ExemptCode->CurrentValue = HtmlDecode($this->ExemptCode->CurrentValue);
		$this->ExemptCode->EditValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

		// Improvements
		$this->Improvements->EditAttrs["class"] = "form-control";
		$this->Improvements->EditCustomAttributes = "";
		$this->Improvements->EditValue = $this->Improvements->CurrentValue;
		$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

		// StreetAddress
		$this->StreetAddress->EditAttrs["class"] = "form-control";
		$this->StreetAddress->EditCustomAttributes = "";
		$this->StreetAddress->EditValue = $this->StreetAddress->CurrentValue;
		$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

		// Longitude
		$this->Longitude->EditAttrs["class"] = "form-control";
		$this->Longitude->EditCustomAttributes = "";
		$this->Longitude->EditValue = $this->Longitude->CurrentValue;
		$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
		if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
			$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
		

		// Latitude
		$this->Latitude->EditAttrs["class"] = "form-control";
		$this->Latitude->EditCustomAttributes = "";
		$this->Latitude->EditValue = $this->Latitude->CurrentValue;
		$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
		if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
			$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
		

		// Incumberance
		$this->Incumberance->EditAttrs["class"] = "form-control";
		$this->Incumberance->EditCustomAttributes = "";
		if (!$this->Incumberance->Raw)
			$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
		$this->Incumberance->EditValue = $this->Incumberance->CurrentValue;
		$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

		// SubDivisionOf
		$this->SubDivisionOf->EditAttrs["class"] = "form-control";
		$this->SubDivisionOf->EditCustomAttributes = "";
		$this->SubDivisionOf->EditValue = $this->SubDivisionOf->CurrentValue;
		$this->SubDivisionOf->PlaceHolder = RemoveHtml($this->SubDivisionOf->caption());

		// LastUpdatedBy
		$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
		$this->LastUpdatedBy->EditCustomAttributes = "";
		if (!$this->LastUpdatedBy->Raw)
			$this->LastUpdatedBy->CurrentValue = HtmlDecode($this->LastUpdatedBy->CurrentValue);
		$this->LastUpdatedBy->EditValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

		// LastUpdateDate
		$this->LastUpdateDate->EditAttrs["class"] = "form-control";
		$this->LastUpdateDate->EditCustomAttributes = "";
		$this->LastUpdateDate->EditValue = FormatDateTime($this->LastUpdateDate->CurrentValue, 8);
		$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

		// ValuationNo
		$this->ValuationNo->EditAttrs["class"] = "form-control";
		$this->ValuationNo->EditCustomAttributes = "";
		$this->ValuationNo->EditValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyStatus);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->SupplementaryValue);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->StreetAddress);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Incumberance);
					$doc->exportCaption($this->SubDivisionOf);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
				} else {
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyStatus);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->SupplementaryValue);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->StreetAddress);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->Incumberance);
					$doc->exportCaption($this->SubDivisionOf);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
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
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyStatus);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->SupplementaryValue);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->StreetAddress);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Incumberance);
						$doc->exportField($this->SubDivisionOf);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
					} else {
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyStatus);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->SupplementaryValue);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->StreetAddress);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->Incumberance);
						$doc->exportField($this->SubDivisionOf);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
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