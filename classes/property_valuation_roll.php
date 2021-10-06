<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for property_valuation_roll
 */
class property_valuation_roll extends DbTable
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
	public $StandNo;
	public $ClientID;
	public $PropertyGroup;
	public $PropertyType;
	public $Location;
	public $RollStatus;
	public $UseCode;
	public $AreaOfLand;
	public $AreaCode;
	public $SiteNumber;
	public $RateableValue;
	public $NewRateableValue;
	public $ExemptCode;
	public $Improvements;
	public $NewImprovements;
	public $Longitude;
	public $Latitude;
	public $PropertyPhoto;
	public $DateEvaluated;
	public $Objections;
	public $DateEntered;
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
		$this->TableVar = 'property_valuation_roll';
		$this->TableName = 'property_valuation_roll';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`property_valuation_roll`";
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
		$this->ValuationNo = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_ValuationNo', 'ValuationNo', '`ValuationNo`', '`ValuationNo`', 3, 11, -1, FALSE, '`ValuationNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ValuationNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ValuationNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ValuationNo->Sortable = TRUE; // Allow sort
		$this->ValuationNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ValuationNo'] = &$this->ValuationNo;

		// PropertyNo
		$this->PropertyNo = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_PropertyNo', 'PropertyNo', '`PropertyNo`', '`PropertyNo`', 3, 11, -1, FALSE, '`PropertyNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyNo->Nullable = FALSE; // NOT NULL field
		$this->PropertyNo->Required = TRUE; // Required field
		$this->PropertyNo->Sortable = TRUE; // Allow sort
		$this->PropertyNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyNo'] = &$this->PropertyNo;

		// StandNo
		$this->StandNo = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_StandNo', 'StandNo', '`StandNo`', '`StandNo`', 200, 255, -1, FALSE, '`StandNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StandNo->Sortable = TRUE; // Allow sort
		$this->fields['StandNo'] = &$this->StandNo;

		// ClientID
		$this->ClientID = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// PropertyGroup
		$this->PropertyGroup = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_PropertyGroup', 'PropertyGroup', '`PropertyGroup`', '`PropertyGroup`', 16, 3, -1, FALSE, '`PropertyGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyGroup->Sortable = TRUE; // Allow sort
		$this->PropertyGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyGroup'] = &$this->PropertyGroup;

		// PropertyType
		$this->PropertyType = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_PropertyType', 'PropertyType', '`PropertyType`', '`PropertyType`', 16, 1, -1, FALSE, '`PropertyType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyType->Sortable = TRUE; // Allow sort
		$this->PropertyType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PropertyType'] = &$this->PropertyType;

		// Location
		$this->Location = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_Location', 'Location', '`Location`', '`Location`', 200, 255, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// RollStatus
		$this->RollStatus = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_RollStatus', 'RollStatus', '`RollStatus`', '`RollStatus`', 16, 1, -1, FALSE, '`RollStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RollStatus->Sortable = TRUE; // Allow sort
		$this->RollStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RollStatus'] = &$this->RollStatus;

		// UseCode
		$this->UseCode = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_UseCode', 'UseCode', '`UseCode`', '`UseCode`', 16, 3, -1, FALSE, '`UseCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UseCode->Sortable = TRUE; // Allow sort
		$this->UseCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UseCode'] = &$this->UseCode;

		// AreaOfLand
		$this->AreaOfLand = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_AreaOfLand', 'AreaOfLand', '`AreaOfLand`', '`AreaOfLand`', 5, 22, -1, FALSE, '`AreaOfLand`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AreaOfLand->Sortable = TRUE; // Allow sort
		$this->AreaOfLand->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AreaOfLand'] = &$this->AreaOfLand;

		// AreaCode
		$this->AreaCode = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_AreaCode', 'AreaCode', '`AreaCode`', '`AreaCode`', 200, 3, -1, FALSE, '`AreaCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AreaCode->Sortable = TRUE; // Allow sort
		$this->fields['AreaCode'] = &$this->AreaCode;

		// SiteNumber
		$this->SiteNumber = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_SiteNumber', 'SiteNumber', '`SiteNumber`', '`SiteNumber`', 2, 5, -1, FALSE, '`SiteNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SiteNumber->Sortable = TRUE; // Allow sort
		$this->SiteNumber->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SiteNumber'] = &$this->SiteNumber;

		// RateableValue
		$this->RateableValue = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_RateableValue', 'RateableValue', '`RateableValue`', '`RateableValue`', 5, 22, -1, FALSE, '`RateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RateableValue->Sortable = TRUE; // Allow sort
		$this->RateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RateableValue'] = &$this->RateableValue;

		// NewRateableValue
		$this->NewRateableValue = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_NewRateableValue', 'NewRateableValue', '`NewRateableValue`', '`NewRateableValue`', 5, 22, -1, FALSE, '`NewRateableValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewRateableValue->Sortable = TRUE; // Allow sort
		$this->NewRateableValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['NewRateableValue'] = &$this->NewRateableValue;

		// ExemptCode
		$this->ExemptCode = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_ExemptCode', 'ExemptCode', '`ExemptCode`', '`ExemptCode`', 16, 1, -1, FALSE, '`ExemptCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExemptCode->Sortable = TRUE; // Allow sort
		$this->ExemptCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ExemptCode'] = &$this->ExemptCode;

		// Improvements
		$this->Improvements = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_Improvements', 'Improvements', '`Improvements`', '`Improvements`', 200, 255, -1, FALSE, '`Improvements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Improvements->Sortable = TRUE; // Allow sort
		$this->fields['Improvements'] = &$this->Improvements;

		// NewImprovements
		$this->NewImprovements = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_NewImprovements', 'NewImprovements', '`NewImprovements`', '`NewImprovements`', 200, 255, -1, FALSE, '`NewImprovements`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewImprovements->Sortable = TRUE; // Allow sort
		$this->fields['NewImprovements'] = &$this->NewImprovements;

		// Longitude
		$this->Longitude = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_Longitude', 'Longitude', '`Longitude`', '`Longitude`', 131, 12, -1, FALSE, '`Longitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Longitude->Sortable = TRUE; // Allow sort
		$this->Longitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Longitude'] = &$this->Longitude;

		// Latitude
		$this->Latitude = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_Latitude', 'Latitude', '`Latitude`', '`Latitude`', 131, 12, -1, FALSE, '`Latitude`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Latitude->Sortable = TRUE; // Allow sort
		$this->Latitude->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Latitude'] = &$this->Latitude;

		// PropertyPhoto
		$this->PropertyPhoto = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_PropertyPhoto', 'PropertyPhoto', '`PropertyPhoto`', '`PropertyPhoto`', 205, 0, -1, TRUE, '`PropertyPhoto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->PropertyPhoto->Sortable = TRUE; // Allow sort
		$this->fields['PropertyPhoto'] = &$this->PropertyPhoto;

		// DateEvaluated
		$this->DateEvaluated = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_DateEvaluated', 'DateEvaluated', '`DateEvaluated`', CastDateFieldForLike("`DateEvaluated`", 0, "DB"), 133, 10, 0, FALSE, '`DateEvaluated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateEvaluated->Sortable = TRUE; // Allow sort
		$this->DateEvaluated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateEvaluated'] = &$this->DateEvaluated;

		// Objections
		$this->Objections = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_Objections', 'Objections', '`Objections`', '`Objections`', 201, 16777215, -1, FALSE, '`Objections`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Objections->Sortable = TRUE; // Allow sort
		$this->fields['Objections'] = &$this->Objections;

		// DateEntered
		$this->DateEntered = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_DateEntered', 'DateEntered', '`DateEntered`', CastDateFieldForLike("`DateEntered`", 0, "DB"), 133, 10, 0, FALSE, '`DateEntered`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateEntered->Sortable = TRUE; // Allow sort
		$this->DateEntered->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateEntered'] = &$this->DateEntered;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('property_valuation_roll', 'property_valuation_roll', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property_valuation_roll`";
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
		$this->ValuationNo->DbValue = $row['ValuationNo'];
		$this->PropertyNo->DbValue = $row['PropertyNo'];
		$this->StandNo->DbValue = $row['StandNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->PropertyGroup->DbValue = $row['PropertyGroup'];
		$this->PropertyType->DbValue = $row['PropertyType'];
		$this->Location->DbValue = $row['Location'];
		$this->RollStatus->DbValue = $row['RollStatus'];
		$this->UseCode->DbValue = $row['UseCode'];
		$this->AreaOfLand->DbValue = $row['AreaOfLand'];
		$this->AreaCode->DbValue = $row['AreaCode'];
		$this->SiteNumber->DbValue = $row['SiteNumber'];
		$this->RateableValue->DbValue = $row['RateableValue'];
		$this->NewRateableValue->DbValue = $row['NewRateableValue'];
		$this->ExemptCode->DbValue = $row['ExemptCode'];
		$this->Improvements->DbValue = $row['Improvements'];
		$this->NewImprovements->DbValue = $row['NewImprovements'];
		$this->Longitude->DbValue = $row['Longitude'];
		$this->Latitude->DbValue = $row['Latitude'];
		$this->PropertyPhoto->Upload->DbValue = $row['PropertyPhoto'];
		$this->DateEvaluated->DbValue = $row['DateEvaluated'];
		$this->Objections->DbValue = $row['Objections'];
		$this->DateEntered->DbValue = $row['DateEntered'];
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
			return "property_valuation_rolllist.php";
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
		if ($pageName == "property_valuation_rollview.php")
			return $Language->phrase("View");
		elseif ($pageName == "property_valuation_rolledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "property_valuation_rolladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "property_valuation_rolllist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("property_valuation_rollview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("property_valuation_rollview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "property_valuation_rolladd.php?" . $this->getUrlParm($parm);
		else
			$url = "property_valuation_rolladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("property_valuation_rolledit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("property_valuation_rolladd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("property_valuation_rolldelete.php", $this->getUrlParm());
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
		$this->ValuationNo->setDbValue($rs->fields('ValuationNo'));
		$this->PropertyNo->setDbValue($rs->fields('PropertyNo'));
		$this->StandNo->setDbValue($rs->fields('StandNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->PropertyGroup->setDbValue($rs->fields('PropertyGroup'));
		$this->PropertyType->setDbValue($rs->fields('PropertyType'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->RollStatus->setDbValue($rs->fields('RollStatus'));
		$this->UseCode->setDbValue($rs->fields('UseCode'));
		$this->AreaOfLand->setDbValue($rs->fields('AreaOfLand'));
		$this->AreaCode->setDbValue($rs->fields('AreaCode'));
		$this->SiteNumber->setDbValue($rs->fields('SiteNumber'));
		$this->RateableValue->setDbValue($rs->fields('RateableValue'));
		$this->NewRateableValue->setDbValue($rs->fields('NewRateableValue'));
		$this->ExemptCode->setDbValue($rs->fields('ExemptCode'));
		$this->Improvements->setDbValue($rs->fields('Improvements'));
		$this->NewImprovements->setDbValue($rs->fields('NewImprovements'));
		$this->Longitude->setDbValue($rs->fields('Longitude'));
		$this->Latitude->setDbValue($rs->fields('Latitude'));
		$this->PropertyPhoto->Upload->DbValue = $rs->fields('PropertyPhoto');
		$this->DateEvaluated->setDbValue($rs->fields('DateEvaluated'));
		$this->Objections->setDbValue($rs->fields('Objections'));
		$this->DateEntered->setDbValue($rs->fields('DateEntered'));
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
		// StandNo
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// RollStatus
		// UseCode
		// AreaOfLand
		// AreaCode
		// SiteNumber
		// RateableValue
		// NewRateableValue
		// ExemptCode
		// Improvements
		// NewImprovements
		// Longitude
		// Latitude
		// PropertyPhoto
		// DateEvaluated
		// Objections
		// DateEntered
		// LastUpdatedBy
		// LastUpdateDate
		// ValuationNo

		$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->ViewCustomAttributes = "";

		// StandNo
		$this->StandNo->ViewValue = $this->StandNo->CurrentValue;
		$this->StandNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// PropertyGroup
		$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
		$this->PropertyGroup->ViewCustomAttributes = "";

		// PropertyType
		$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
		$this->PropertyType->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// RollStatus
		$this->RollStatus->ViewValue = $this->RollStatus->CurrentValue;
		$this->RollStatus->ViewCustomAttributes = "";

		// UseCode
		$this->UseCode->ViewValue = $this->UseCode->CurrentValue;
		$this->UseCode->ViewCustomAttributes = "";

		// AreaOfLand
		$this->AreaOfLand->ViewValue = $this->AreaOfLand->CurrentValue;
		$this->AreaOfLand->ViewValue = FormatNumber($this->AreaOfLand->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->AreaOfLand->ViewCustomAttributes = "";

		// AreaCode
		$this->AreaCode->ViewValue = $this->AreaCode->CurrentValue;
		$this->AreaCode->ViewCustomAttributes = "";

		// SiteNumber
		$this->SiteNumber->ViewValue = $this->SiteNumber->CurrentValue;
		$this->SiteNumber->ViewCustomAttributes = "";

		// RateableValue
		$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->RateableValue->ViewCustomAttributes = "";

		// NewRateableValue
		$this->NewRateableValue->ViewValue = $this->NewRateableValue->CurrentValue;
		$this->NewRateableValue->ViewValue = FormatNumber($this->NewRateableValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->NewRateableValue->ViewCustomAttributes = "";

		// ExemptCode
		$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->ViewCustomAttributes = "";

		// Improvements
		$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
		$this->Improvements->ViewCustomAttributes = "";

		// NewImprovements
		$this->NewImprovements->ViewValue = $this->NewImprovements->CurrentValue;
		$this->NewImprovements->ViewCustomAttributes = "";

		// Longitude
		$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
		$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Longitude->ViewCustomAttributes = "";

		// Latitude
		$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
		$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Latitude->ViewCustomAttributes = "";

		// PropertyPhoto
		if (!EmptyValue($this->PropertyPhoto->Upload->DbValue)) {
			$this->PropertyPhoto->ViewValue = $this->ValuationNo->CurrentValue;
			$this->PropertyPhoto->IsBlobImage = IsImageFile(ContentExtension($this->PropertyPhoto->Upload->DbValue));
		} else {
			$this->PropertyPhoto->ViewValue = "";
		}
		$this->PropertyPhoto->ViewCustomAttributes = "";

		// DateEvaluated
		$this->DateEvaluated->ViewValue = $this->DateEvaluated->CurrentValue;
		$this->DateEvaluated->ViewValue = FormatDateTime($this->DateEvaluated->ViewValue, 0);
		$this->DateEvaluated->ViewCustomAttributes = "";

		// Objections
		$this->Objections->ViewValue = $this->Objections->CurrentValue;
		$this->Objections->ViewCustomAttributes = "";

		// DateEntered
		$this->DateEntered->ViewValue = $this->DateEntered->CurrentValue;
		$this->DateEntered->ViewValue = FormatDateTime($this->DateEntered->ViewValue, 0);
		$this->DateEntered->ViewCustomAttributes = "";

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

		// StandNo
		$this->StandNo->LinkCustomAttributes = "";
		$this->StandNo->HrefValue = "";
		$this->StandNo->TooltipValue = "";

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

		// RollStatus
		$this->RollStatus->LinkCustomAttributes = "";
		$this->RollStatus->HrefValue = "";
		$this->RollStatus->TooltipValue = "";

		// UseCode
		$this->UseCode->LinkCustomAttributes = "";
		$this->UseCode->HrefValue = "";
		$this->UseCode->TooltipValue = "";

		// AreaOfLand
		$this->AreaOfLand->LinkCustomAttributes = "";
		$this->AreaOfLand->HrefValue = "";
		$this->AreaOfLand->TooltipValue = "";

		// AreaCode
		$this->AreaCode->LinkCustomAttributes = "";
		$this->AreaCode->HrefValue = "";
		$this->AreaCode->TooltipValue = "";

		// SiteNumber
		$this->SiteNumber->LinkCustomAttributes = "";
		$this->SiteNumber->HrefValue = "";
		$this->SiteNumber->TooltipValue = "";

		// RateableValue
		$this->RateableValue->LinkCustomAttributes = "";
		$this->RateableValue->HrefValue = "";
		$this->RateableValue->TooltipValue = "";

		// NewRateableValue
		$this->NewRateableValue->LinkCustomAttributes = "";
		$this->NewRateableValue->HrefValue = "";
		$this->NewRateableValue->TooltipValue = "";

		// ExemptCode
		$this->ExemptCode->LinkCustomAttributes = "";
		$this->ExemptCode->HrefValue = "";
		$this->ExemptCode->TooltipValue = "";

		// Improvements
		$this->Improvements->LinkCustomAttributes = "";
		$this->Improvements->HrefValue = "";
		$this->Improvements->TooltipValue = "";

		// NewImprovements
		$this->NewImprovements->LinkCustomAttributes = "";
		$this->NewImprovements->HrefValue = "";
		$this->NewImprovements->TooltipValue = "";

		// Longitude
		$this->Longitude->LinkCustomAttributes = "";
		$this->Longitude->HrefValue = "";
		$this->Longitude->TooltipValue = "";

		// Latitude
		$this->Latitude->LinkCustomAttributes = "";
		$this->Latitude->HrefValue = "";
		$this->Latitude->TooltipValue = "";

		// PropertyPhoto
		$this->PropertyPhoto->LinkCustomAttributes = "";
		if (!empty($this->PropertyPhoto->Upload->DbValue)) {
			$this->PropertyPhoto->HrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);
			$this->PropertyPhoto->LinkAttrs["target"] = "";
			if ($this->PropertyPhoto->IsBlobImage && empty($this->PropertyPhoto->LinkAttrs["target"]))
				$this->PropertyPhoto->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->PropertyPhoto->HrefValue = FullUrl($this->PropertyPhoto->HrefValue, "href");
		} else {
			$this->PropertyPhoto->HrefValue = "";
		}
		$this->PropertyPhoto->ExportHrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);
		$this->PropertyPhoto->TooltipValue = "";

		// DateEvaluated
		$this->DateEvaluated->LinkCustomAttributes = "";
		$this->DateEvaluated->HrefValue = "";
		$this->DateEvaluated->TooltipValue = "";

		// Objections
		$this->Objections->LinkCustomAttributes = "";
		$this->Objections->HrefValue = "";
		$this->Objections->TooltipValue = "";

		// DateEntered
		$this->DateEntered->LinkCustomAttributes = "";
		$this->DateEntered->HrefValue = "";
		$this->DateEntered->TooltipValue = "";

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
		$this->ValuationNo->ViewCustomAttributes = "";

		// PropertyNo
		$this->PropertyNo->EditAttrs["class"] = "form-control";
		$this->PropertyNo->EditCustomAttributes = "";
		$this->PropertyNo->EditValue = $this->PropertyNo->CurrentValue;
		$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

		// StandNo
		$this->StandNo->EditAttrs["class"] = "form-control";
		$this->StandNo->EditCustomAttributes = "";
		if (!$this->StandNo->Raw)
			$this->StandNo->CurrentValue = HtmlDecode($this->StandNo->CurrentValue);
		$this->StandNo->EditValue = $this->StandNo->CurrentValue;
		$this->StandNo->PlaceHolder = RemoveHtml($this->StandNo->caption());

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
		$this->PropertyType->EditAttrs["class"] = "form-control";
		$this->PropertyType->EditCustomAttributes = "";
		$this->PropertyType->EditValue = $this->PropertyType->CurrentValue;
		$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (!$this->Location->Raw)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// RollStatus
		$this->RollStatus->EditAttrs["class"] = "form-control";
		$this->RollStatus->EditCustomAttributes = "";
		$this->RollStatus->EditValue = $this->RollStatus->CurrentValue;
		$this->RollStatus->PlaceHolder = RemoveHtml($this->RollStatus->caption());

		// UseCode
		$this->UseCode->EditAttrs["class"] = "form-control";
		$this->UseCode->EditCustomAttributes = "";
		$this->UseCode->EditValue = $this->UseCode->CurrentValue;
		$this->UseCode->PlaceHolder = RemoveHtml($this->UseCode->caption());

		// AreaOfLand
		$this->AreaOfLand->EditAttrs["class"] = "form-control";
		$this->AreaOfLand->EditCustomAttributes = "";
		$this->AreaOfLand->EditValue = $this->AreaOfLand->CurrentValue;
		$this->AreaOfLand->PlaceHolder = RemoveHtml($this->AreaOfLand->caption());
		if (strval($this->AreaOfLand->EditValue) != "" && is_numeric($this->AreaOfLand->EditValue))
			$this->AreaOfLand->EditValue = FormatNumber($this->AreaOfLand->EditValue, -2, -1, -2, 0);
		

		// AreaCode
		$this->AreaCode->EditAttrs["class"] = "form-control";
		$this->AreaCode->EditCustomAttributes = "";
		if (!$this->AreaCode->Raw)
			$this->AreaCode->CurrentValue = HtmlDecode($this->AreaCode->CurrentValue);
		$this->AreaCode->EditValue = $this->AreaCode->CurrentValue;
		$this->AreaCode->PlaceHolder = RemoveHtml($this->AreaCode->caption());

		// SiteNumber
		$this->SiteNumber->EditAttrs["class"] = "form-control";
		$this->SiteNumber->EditCustomAttributes = "";
		$this->SiteNumber->EditValue = $this->SiteNumber->CurrentValue;
		$this->SiteNumber->PlaceHolder = RemoveHtml($this->SiteNumber->caption());

		// RateableValue
		$this->RateableValue->EditAttrs["class"] = "form-control";
		$this->RateableValue->EditCustomAttributes = "";
		$this->RateableValue->EditValue = $this->RateableValue->CurrentValue;
		$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
		if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
			$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -1, -2, 0);
		

		// NewRateableValue
		$this->NewRateableValue->EditAttrs["class"] = "form-control";
		$this->NewRateableValue->EditCustomAttributes = "";
		$this->NewRateableValue->EditValue = $this->NewRateableValue->CurrentValue;
		$this->NewRateableValue->PlaceHolder = RemoveHtml($this->NewRateableValue->caption());
		if (strval($this->NewRateableValue->EditValue) != "" && is_numeric($this->NewRateableValue->EditValue))
			$this->NewRateableValue->EditValue = FormatNumber($this->NewRateableValue->EditValue, -2, -1, -2, 0);
		

		// ExemptCode
		$this->ExemptCode->EditAttrs["class"] = "form-control";
		$this->ExemptCode->EditCustomAttributes = "";
		$this->ExemptCode->EditValue = $this->ExemptCode->CurrentValue;
		$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

		// Improvements
		$this->Improvements->EditAttrs["class"] = "form-control";
		$this->Improvements->EditCustomAttributes = "";
		if (!$this->Improvements->Raw)
			$this->Improvements->CurrentValue = HtmlDecode($this->Improvements->CurrentValue);
		$this->Improvements->EditValue = $this->Improvements->CurrentValue;
		$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

		// NewImprovements
		$this->NewImprovements->EditAttrs["class"] = "form-control";
		$this->NewImprovements->EditCustomAttributes = "";
		if (!$this->NewImprovements->Raw)
			$this->NewImprovements->CurrentValue = HtmlDecode($this->NewImprovements->CurrentValue);
		$this->NewImprovements->EditValue = $this->NewImprovements->CurrentValue;
		$this->NewImprovements->PlaceHolder = RemoveHtml($this->NewImprovements->caption());

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
		

		// PropertyPhoto
		$this->PropertyPhoto->EditAttrs["class"] = "form-control";
		$this->PropertyPhoto->EditCustomAttributes = "";
		if (!EmptyValue($this->PropertyPhoto->Upload->DbValue)) {
			$this->PropertyPhoto->EditValue = $this->ValuationNo->CurrentValue;
			$this->PropertyPhoto->IsBlobImage = IsImageFile(ContentExtension($this->PropertyPhoto->Upload->DbValue));
		} else {
			$this->PropertyPhoto->EditValue = "";
		}

		// DateEvaluated
		$this->DateEvaluated->EditAttrs["class"] = "form-control";
		$this->DateEvaluated->EditCustomAttributes = "";
		$this->DateEvaluated->EditValue = FormatDateTime($this->DateEvaluated->CurrentValue, 8);
		$this->DateEvaluated->PlaceHolder = RemoveHtml($this->DateEvaluated->caption());

		// Objections
		$this->Objections->EditAttrs["class"] = "form-control";
		$this->Objections->EditCustomAttributes = "";
		$this->Objections->EditValue = $this->Objections->CurrentValue;
		$this->Objections->PlaceHolder = RemoveHtml($this->Objections->caption());

		// DateEntered
		$this->DateEntered->EditAttrs["class"] = "form-control";
		$this->DateEntered->EditCustomAttributes = "";
		$this->DateEntered->EditValue = FormatDateTime($this->DateEntered->CurrentValue, 8);
		$this->DateEntered->PlaceHolder = RemoveHtml($this->DateEntered->caption());

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
					$doc->exportCaption($this->StandNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->RollStatus);
					$doc->exportCaption($this->UseCode);
					$doc->exportCaption($this->AreaOfLand);
					$doc->exportCaption($this->AreaCode);
					$doc->exportCaption($this->SiteNumber);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->NewRateableValue);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->NewImprovements);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->PropertyPhoto);
					$doc->exportCaption($this->DateEvaluated);
					$doc->exportCaption($this->Objections);
					$doc->exportCaption($this->DateEntered);
					$doc->exportCaption($this->LastUpdatedBy);
					$doc->exportCaption($this->LastUpdateDate);
				} else {
					$doc->exportCaption($this->ValuationNo);
					$doc->exportCaption($this->PropertyNo);
					$doc->exportCaption($this->StandNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->PropertyGroup);
					$doc->exportCaption($this->PropertyType);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->RollStatus);
					$doc->exportCaption($this->UseCode);
					$doc->exportCaption($this->AreaOfLand);
					$doc->exportCaption($this->AreaCode);
					$doc->exportCaption($this->SiteNumber);
					$doc->exportCaption($this->RateableValue);
					$doc->exportCaption($this->NewRateableValue);
					$doc->exportCaption($this->ExemptCode);
					$doc->exportCaption($this->Improvements);
					$doc->exportCaption($this->NewImprovements);
					$doc->exportCaption($this->Longitude);
					$doc->exportCaption($this->Latitude);
					$doc->exportCaption($this->DateEvaluated);
					$doc->exportCaption($this->DateEntered);
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
						$doc->exportField($this->StandNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->RollStatus);
						$doc->exportField($this->UseCode);
						$doc->exportField($this->AreaOfLand);
						$doc->exportField($this->AreaCode);
						$doc->exportField($this->SiteNumber);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->NewRateableValue);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->NewImprovements);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->PropertyPhoto);
						$doc->exportField($this->DateEvaluated);
						$doc->exportField($this->Objections);
						$doc->exportField($this->DateEntered);
						$doc->exportField($this->LastUpdatedBy);
						$doc->exportField($this->LastUpdateDate);
					} else {
						$doc->exportField($this->ValuationNo);
						$doc->exportField($this->PropertyNo);
						$doc->exportField($this->StandNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->PropertyGroup);
						$doc->exportField($this->PropertyType);
						$doc->exportField($this->Location);
						$doc->exportField($this->RollStatus);
						$doc->exportField($this->UseCode);
						$doc->exportField($this->AreaOfLand);
						$doc->exportField($this->AreaCode);
						$doc->exportField($this->SiteNumber);
						$doc->exportField($this->RateableValue);
						$doc->exportField($this->NewRateableValue);
						$doc->exportField($this->ExemptCode);
						$doc->exportField($this->Improvements);
						$doc->exportField($this->NewImprovements);
						$doc->exportField($this->Longitude);
						$doc->exportField($this->Latitude);
						$doc->exportField($this->DateEvaluated);
						$doc->exportField($this->DateEntered);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'PropertyPhoto') {
			$fldName = "PropertyPhoto";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->ValuationNo->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
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