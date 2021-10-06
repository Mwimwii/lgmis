<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for property_no_use
 */
class property_no_use extends DbTable
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
	public $ClientID;
	public $PropertyGroup;
	public $PropertyType;
	public $Location;
	public $PropertyStatus;
	public $PropertyUse;
	public $LandExtentInHA;
	public $LandValue;
	public $ImprovementsValue;
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

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'property_no_use';
		$this->TableName = 'property_no_use';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`property_no_use`";
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

		// ValuationNo
		$this->ValuationNo = new DbField('property_no_use', 'property_no_use', 'x_ValuationNo', 'ValuationNo', '`ValuationNo`', '`ValuationNo`', 3, 11, -1, FALSE, '`ValuationNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ValuationNo->Nullable = FALSE; // NOT NULL field
		$this->ValuationNo->Sortable = TRUE; // Allow sort
		$this->ValuationNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ValuationNo'] = &$this->ValuationNo;

		// PropertyNo
		$this->PropertyNo = new DbField('property_no_use', 'property_no_use', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 200, 255, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// ClientSerNo
		$this->ClientSerNo = new DbField('property_no_use', 'property_no_use', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientID
		$this->ClientID = new DbField('property_no_use', 'property_no_use', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// PropertyGroup
		$this->PropertyGroup = new DbField('property_no_use', 'property_no_use', 'x_PropertyGroup', 'PropertyGroup', '`PropertyGroup`', '`PropertyGroup`', 16, 3, -1, FALSE, '`PropertyGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyGroup->Sortable = TRUE; // Allow sort
		$this->PropertyGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyGroup'] = &$this->PropertyGroup;

		// PropertyType
		$this->PropertyType = new DbField('property_no_use', 'property_no_use', 'x_PropertyType', 'PropertyType', '`PropertyType`', '`PropertyType`', 16, 1, -1, FALSE, '`PropertyType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->PropertyType->Sortable = TRUE; // Allow sort
		$this->PropertyType->DataType = DATATYPE_BOOLEAN;
		$this->PropertyType->Lookup = new Lookup('PropertyType', 'property_no_use', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyType->OptionCount = 2;
		$this->PropertyType->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['PropertyType'] = &$this->PropertyType;

		// Location
		$this->Location = new DbField('property_no_use', 'property_no_use', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// PropertyStatus
		$this->PropertyStatus = new DbField('property_no_use', 'property_no_use', 'x_PropertyStatus', 'PropertyStatus', '`PropertyStatus`', '`PropertyStatus`', 16, 1, -1, FALSE, '`PropertyStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->PropertyStatus->Sortable = TRUE; // Allow sort
		$this->PropertyStatus->DataType = DATATYPE_BOOLEAN;
		$this->PropertyStatus->Lookup = new Lookup('PropertyStatus', 'property_no_use', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->PropertyStatus->OptionCount = 2;
		$this->PropertyStatus->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['PropertyStatus'] = &$this->PropertyStatus;

		// PropertyUse
		$this->PropertyUse = new DbField('property_no_use', 'property_no_use', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 4, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// LandExtentInHA
		$this->LandExtentInHA = new DbField('property_no_use', 'property_no_use', 'x_LandExtentInHA', 'LandExtentInHA', '`LandExtentInHA`', '`LandExtentInHA`', 5, 22, -1, FALSE, '`LandExtentInHA`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandExtentInHA->Sortable = TRUE; // Allow sort
		$this->LandExtentInHA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandExtentInHA'] = &$this->LandExtentInHA;

		// LandValue
		$this->LandValue = new DbField('property_no_use', 'property_no_use', 'x_LandValue', 'LandValue', '`LandValue`', '`LandValue`', 5, 22, -1, FALSE, '`LandValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LandValue->Sortable = TRUE; // Allow sort
		$this->LandValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LandValue'] = &$this->LandValue;

		// ImprovementsValue
		$this->ImprovementsValue = new DbField('property_no_use', 'property_no_use', 'x_ImprovementsValue', 'ImprovementsValue', '`ImprovementsValue`', '`ImprovementsValue`', 5, 22, -1, FALSE, '`ImprovementsValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ImprovementsValue->Sortable = TRUE; // Allow sort
		$this->ImprovementsValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ImprovementsValue'] = &$this->ImprovementsValue;

		// RateableValue
		$this->RateableValue = new DbField('property_no_use', 'property_no_use', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// SupplementaryValue
		$this->SupplementaryValue = new DbField('property_no_use', 'property_no_use', 'x_SupplementaryValue', 'SupplementaryValue', '`SupplementaryValue`', '`SupplementaryValue`', 5, 22, -1, FALSE, '`SupplementaryValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupplementaryValue->Sortable = TRUE; // Allow sort
		$this->SupplementaryValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SupplementaryValue'] = &$this->SupplementaryValue;

		// ExemptCode
		$this->ExemptCode = new DbField('property_no_use', 'property_no_use', 'x_ExemptCode', 'ExemptCode', '`ExemptCode`', '`ExemptCode`', 200, 15, -1, FALSE, '`ExemptCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExemptCode->Sortable = TRUE; // Allow sort
		$this->fields['ExemptCode'] = &$this->ExemptCode;

		// Improvements
		$this->Improvements = new DbField('property_no_use', 'property_no_use', 'x_Improvements', 'Improvements', '`Improvements`', '`Improvements`', 200, 255, -1, FALSE, '`Improvements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Improvements->Sortable = TRUE; // Allow sort
		$this->fields['Improvements'] = &$this->Improvements;

		// StreetAddress
		$this->StreetAddress = new DbField('property_no_use', 'property_no_use', 'x_StreetAddress', 'StreetAddress', '`StreetAddress`', '`StreetAddress`', 200, 255, -1, FALSE, '`StreetAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StreetAddress->Sortable = TRUE; // Allow sort
		$this->fields['StreetAddress'] = &$this->StreetAddress;

		// Longitude
		$this->Longitude = new DbField('property_no_use', 'property_no_use', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 12, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// Latitude
		$this->Latitude = new DbField('property_no_use', 'property_no_use', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 12, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// Incumberance
		$this->Incumberance = new DbField('property_no_use', 'property_no_use', 'x_Incumberance', 'Incumberance', '`Incumberance`', '`Incumberance`', 200, 1, -1, FALSE, '`Incumberance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Incumberance->Sortable = TRUE; // Allow sort
		$this->fields['Incumberance'] = &$this->Incumberance;

		// SubDivisionOf
		$this->SubDivisionOf = new DbField('property_no_use', 'property_no_use', 'x_SubDivisionOf', 'SubDivisionOf', '`SubDivisionOf`', '`SubDivisionOf`', 3, 11, -1, FALSE, '`SubDivisionOf`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubDivisionOf->Sortable = TRUE; // Allow sort
		$this->SubDivisionOf->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubDivisionOf'] = &$this->SubDivisionOf;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('property_no_use', 'property_no_use', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('property_no_use', 'property_no_use', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdateDate->Sortable = TRUE; // Allow sort
		$this->LastUpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdateDate'] = &$this->LastUpdateDate;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property_no_use`";
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
		$this->ValuationNo->DbValue = $row['ValuationNo'];
		$this->PropertyNo->DbValue = $row['PropertyNo'];
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->PropertyGroup->DbValue = $row['PropertyGroup'];
		$this->PropertyType->DbValue = $row['PropertyType'];
		$this->Location->DbValue = $row['Location'];
		$this->PropertyStatus->DbValue = $row['PropertyStatus'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->LandExtentInHA->DbValue = $row['LandExtentInHA'];
		$this->LandValue->DbValue = $row['LandValue'];
		$this->ImprovementsValue->DbValue = $row['ImprovementsValue'];
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
			return "property_no_uselist.php";
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
		if ($pageName == "property_no_useview.php")
			return $Language->phrase("View");
		elseif ($pageName == "property_no_useedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "property_no_useadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "property_no_uselist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("property_no_useview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("property_no_useview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "property_no_useadd.php?" . $this->getUrlParm($parm);
		else
			$url = "property_no_useadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("property_no_useedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("property_no_useadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("property_no_usedelete.php", $this->getUrlParm());
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
		$this->ValuationNo->setDbValue($rs->fields('ValuationNo'));
		$this->PropertyNo->setDbValue($rs->fields('PropertyNo'));
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->PropertyGroup->setDbValue($rs->fields('PropertyGroup'));
		$this->PropertyType->setDbValue($rs->fields('PropertyType'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->PropertyStatus->setDbValue($rs->fields('PropertyStatus'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->LandExtentInHA->setDbValue($rs->fields('LandExtentInHA'));
		$this->LandValue->setDbValue($rs->fields('LandValue'));
		$this->ImprovementsValue->setDbValue($rs->fields('ImprovementsValue'));
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
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// PropertyStatus
		// PropertyUse
		// LandExtentInHA
		// LandValue
		// ImprovementsValue
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

		$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewValue = FormatNumber($this->ValuationNo->ViewValue, 0, -2, -2, -2);
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->ViewCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewValue = FormatNumber($this->ClientSerNo->ViewValue, 0, -2, -2, -2);
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// PropertyGroup
		$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
		$this->PropertyGroup->ViewValue = FormatNumber($this->PropertyGroup->ViewValue, 0, -2, -2, -2);
		$this->PropertyGroup->ViewCustomAttributes = "";

		// PropertyType
		if (ConvertToBool($this->PropertyType->CurrentValue)) {
			$this->PropertyType->ViewValue = $this->PropertyType->tagCaption(1) != "" ? $this->PropertyType->tagCaption(1) : "Yes";
		} else {
			$this->PropertyType->ViewValue = $this->PropertyType->tagCaption(2) != "" ? $this->PropertyType->tagCaption(2) : "No";
		}
		$this->PropertyType->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// PropertyStatus
		if (ConvertToBool($this->PropertyStatus->CurrentValue)) {
			$this->PropertyStatus->ViewValue = $this->PropertyStatus->tagCaption(1) != "" ? $this->PropertyStatus->tagCaption(1) : "Yes";
		} else {
			$this->PropertyStatus->ViewValue = $this->PropertyStatus->tagCaption(2) != "" ? $this->PropertyStatus->tagCaption(2) : "No";
		}
		$this->PropertyStatus->ViewCustomAttributes = "";

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

		// SupplementaryValue
		$this->SupplementaryValue->ViewValue = $this->SupplementaryValue->CurrentValue;
		$this->SupplementaryValue->ViewValue = FormatNumber($this->SupplementaryValue->ViewValue, 2, -2, -2, -2);
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
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, 2, -2, -2, -2);
		$this->Longitude->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, 2, -2, -2, -2);
		$this->Latitude->ViewCustomAttributes = "";

		// Incumberance
		$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
		$this->Incumberance->ViewCustomAttributes = "";

		// SubDivisionOf
		$this->SubDivisionOf->ViewValue = $this->SubDivisionOf->CurrentValue;
		$this->SubDivisionOf->ViewValue = FormatNumber($this->SubDivisionOf->ViewValue, 0, -2, -2, -2);
		$this->SubDivisionOf->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

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
		$this->ValuationNo->PlaceHolder = RemoveHtml($this->ValuationNo->caption());

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
		$this->PropertyGroup->EditValue = $this->PropertyGroup->CurrentValue;
		$this->PropertyGroup->PlaceHolder = RemoveHtml($this->PropertyGroup->caption());

		// PropertyType
		$this->PropertyType->EditCustomAttributes = "";
		$this->PropertyType->EditValue = $this->PropertyType->options(FALSE);

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (!$this->Location->Raw)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// PropertyStatus
		$this->PropertyStatus->EditCustomAttributes = "";
		$this->PropertyStatus->EditValue = $this->PropertyStatus->options(FALSE);

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
		if (!$this->Improvements->Raw)
			$this->Improvements->CurrentValue = HtmlDecode($this->Improvements->CurrentValue);
		$this->Improvements->EditValue = $this->Improvements->CurrentValue;
		$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

		// StreetAddress
		$this->StreetAddress->EditAttrs["class"] = "form-control";
		$this->StreetAddress->EditCustomAttributes = "";
		if (!$this->StreetAddress->Raw)
			$this->StreetAddress->CurrentValue = HtmlDecode($this->StreetAddress->CurrentValue);
		$this->StreetAddress->EditValue = $this->StreetAddress->CurrentValue;
		$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

		// Longitude
		$this->Longitude->EditAttrs["class"] = "form-control";
		$this->Longitude->EditCustomAttributes = "";
		$this->Longitude->EditValue = $this->Longitude->CurrentValue;
		$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
		if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
			$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -2, -2, -2);
		

		// Latitude
		$this->Latitude->EditAttrs["class"] = "form-control";
		$this->Latitude->EditCustomAttributes = "";
		$this->Latitude->EditValue = $this->Latitude->CurrentValue;
		$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
		if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
			$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyStatus);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
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
				} else {
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PropertyStatus);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->LandExtentInHA);
					$doc->exportCaption($this->LandValue);
					$doc->exportCaption($this->ImprovementsValue);
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
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyStatus);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
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
					} else {
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->PropertyStatus);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->LandExtentInHA);
						$doc->exportField($this->LandValue);
						$doc->exportField($this->ImprovementsValue);
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