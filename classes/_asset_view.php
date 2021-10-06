<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for asset_view
 */
class _asset_view extends DbTable
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
	public $ProvinceCode;
	public $ProvinceName;
	public $LACode;
	public $LAName;
	public $DepartmentCode;
	public $AssetTypeCode;
	public $AssetTypeName;
	public $Supplier;
	public $PurchasePrice;
	public $CurrencyCode;
	public $ConditionDesc;
	public $DateOfPurchase;
	public $AssetCapacity;
	public $UnitOfMeasure;
	public $AssetDescription;
	public $DateOfLastRevaluation;
	public $NewValue;
	public $NameOfValuer;
	public $BookValue;
	public $LastDepreciationDate;
	public $LastDepreciationAmount;
	public $DepreciationRate;
	public $CumulativeDepreciation;
	public $AssetStatus;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = '_asset_view';
		$this->TableName = 'asset_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`asset_view`";
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

		// ProvinceCode
		$this->ProvinceCode = new DbField('_asset_view', 'asset_view', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 17, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsPrimaryKey = TRUE; // Primary key field
		$this->ProvinceCode->Nullable = FALSE; // NOT NULL field
		$this->ProvinceCode->Required = TRUE; // Required field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// ProvinceName
		$this->ProvinceName = new DbField('_asset_view', 'asset_view', 'x_ProvinceName', 'ProvinceName', '`ProvinceName`', '`ProvinceName`', 200, 40, -1, FALSE, '`ProvinceName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceName->Nullable = FALSE; // NOT NULL field
		$this->ProvinceName->Required = TRUE; // Required field
		$this->ProvinceName->Sortable = TRUE; // Allow sort
		$this->fields['ProvinceName'] = &$this->ProvinceName;

		// LACode
		$this->LACode = new DbField('_asset_view', 'asset_view', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsPrimaryKey = TRUE; // Primary key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// LAName
		$this->LAName = new DbField('_asset_view', 'asset_view', 'x_LAName', 'LAName', '`LAName`', '`LAName`', 200, 40, -1, FALSE, '`LAName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LAName->Nullable = FALSE; // NOT NULL field
		$this->LAName->Required = TRUE; // Required field
		$this->LAName->Sortable = TRUE; // Allow sort
		$this->fields['LAName'] = &$this->LAName;

		// DepartmentCode
		$this->DepartmentCode = new DbField('_asset_view', 'asset_view', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], [], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// AssetTypeCode
		$this->AssetTypeCode = new DbField('_asset_view', 'asset_view', 'x_AssetTypeCode', 'AssetTypeCode', '`AssetTypeCode`', '`AssetTypeCode`', 2, 5, -1, FALSE, '`AssetTypeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssetTypeCode->Sortable = TRUE; // Allow sort
		$this->AssetTypeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AssetTypeCode'] = &$this->AssetTypeCode;

		// AssetTypeName
		$this->AssetTypeName = new DbField('_asset_view', 'asset_view', 'x_AssetTypeName', 'AssetTypeName', '`AssetTypeName`', '`AssetTypeName`', 200, 40, -1, FALSE, '`AssetTypeName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssetTypeName->Nullable = FALSE; // NOT NULL field
		$this->AssetTypeName->Required = TRUE; // Required field
		$this->AssetTypeName->Sortable = TRUE; // Allow sort
		$this->fields['AssetTypeName'] = &$this->AssetTypeName;

		// Supplier
		$this->Supplier = new DbField('_asset_view', 'asset_view', 'x_Supplier', 'Supplier', '`Supplier`', '`Supplier`', 200, 255, -1, FALSE, '`Supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Supplier->Sortable = TRUE; // Allow sort
		$this->fields['Supplier'] = &$this->Supplier;

		// PurchasePrice
		$this->PurchasePrice = new DbField('_asset_view', 'asset_view', 'x_PurchasePrice', 'PurchasePrice', '`PurchasePrice`', '`PurchasePrice`', 131, 19, -1, FALSE, '`PurchasePrice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PurchasePrice->Sortable = TRUE; // Allow sort
		$this->PurchasePrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['PurchasePrice'] = &$this->PurchasePrice;

		// CurrencyCode
		$this->CurrencyCode = new DbField('_asset_view', 'asset_view', 'x_CurrencyCode', 'CurrencyCode', '`CurrencyCode`', '`CurrencyCode`', 200, 6, -1, FALSE, '`CurrencyCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CurrencyCode->Sortable = TRUE; // Allow sort
		$this->fields['CurrencyCode'] = &$this->CurrencyCode;

		// ConditionDesc
		$this->ConditionDesc = new DbField('_asset_view', 'asset_view', 'x_ConditionDesc', 'ConditionDesc', '`ConditionDesc`', '`ConditionDesc`', 200, 255, -1, FALSE, '`ConditionDesc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ConditionDesc->Sortable = TRUE; // Allow sort
		$this->fields['ConditionDesc'] = &$this->ConditionDesc;

		// DateOfPurchase
		$this->DateOfPurchase = new DbField('_asset_view', 'asset_view', 'x_DateOfPurchase', 'DateOfPurchase', '`DateOfPurchase`', CastDateFieldForLike("`DateOfPurchase`", 0, "DB"), 135, 19, 0, FALSE, '`DateOfPurchase`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfPurchase->Sortable = TRUE; // Allow sort
		$this->DateOfPurchase->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfPurchase'] = &$this->DateOfPurchase;

		// AssetCapacity
		$this->AssetCapacity = new DbField('_asset_view', 'asset_view', 'x_AssetCapacity', 'AssetCapacity', '`AssetCapacity`', '`AssetCapacity`', 5, 22, -1, FALSE, '`AssetCapacity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssetCapacity->Sortable = TRUE; // Allow sort
		$this->AssetCapacity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AssetCapacity'] = &$this->AssetCapacity;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('_asset_view', 'asset_view', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 10, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// AssetDescription
		$this->AssetDescription = new DbField('_asset_view', 'asset_view', 'x_AssetDescription', 'AssetDescription', '`AssetDescription`', '`AssetDescription`', 200, 60, -1, FALSE, '`AssetDescription`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssetDescription->Sortable = TRUE; // Allow sort
		$this->fields['AssetDescription'] = &$this->AssetDescription;

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation = new DbField('_asset_view', 'asset_view', 'x_DateOfLastRevaluation', 'DateOfLastRevaluation', '`DateOfLastRevaluation`', CastDateFieldForLike("`DateOfLastRevaluation`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfLastRevaluation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfLastRevaluation->Sortable = TRUE; // Allow sort
		$this->DateOfLastRevaluation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfLastRevaluation'] = &$this->DateOfLastRevaluation;

		// NewValue
		$this->NewValue = new DbField('_asset_view', 'asset_view', 'x_NewValue', 'NewValue', '`NewValue`', '`NewValue`', 5, 22, -1, FALSE, '`NewValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewValue->Sortable = TRUE; // Allow sort
		$this->NewValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['NewValue'] = &$this->NewValue;

		// NameOfValuer
		$this->NameOfValuer = new DbField('_asset_view', 'asset_view', 'x_NameOfValuer', 'NameOfValuer', '`NameOfValuer`', '`NameOfValuer`', 200, 255, -1, FALSE, '`NameOfValuer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NameOfValuer->Sortable = TRUE; // Allow sort
		$this->fields['NameOfValuer'] = &$this->NameOfValuer;

		// BookValue
		$this->BookValue = new DbField('_asset_view', 'asset_view', 'x_BookValue', 'BookValue', '`BookValue`', '`BookValue`', 5, 22, -1, FALSE, '`BookValue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BookValue->Sortable = TRUE; // Allow sort
		$this->BookValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BookValue'] = &$this->BookValue;

		// LastDepreciationDate
		$this->LastDepreciationDate = new DbField('_asset_view', 'asset_view', 'x_LastDepreciationDate', 'LastDepreciationDate', '`LastDepreciationDate`', CastDateFieldForLike("`LastDepreciationDate`", 0, "DB"), 133, 10, 0, FALSE, '`LastDepreciationDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastDepreciationDate->Sortable = TRUE; // Allow sort
		$this->LastDepreciationDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastDepreciationDate'] = &$this->LastDepreciationDate;

		// LastDepreciationAmount
		$this->LastDepreciationAmount = new DbField('_asset_view', 'asset_view', 'x_LastDepreciationAmount', 'LastDepreciationAmount', '`LastDepreciationAmount`', '`LastDepreciationAmount`', 5, 22, -1, FALSE, '`LastDepreciationAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastDepreciationAmount->Sortable = TRUE; // Allow sort
		$this->LastDepreciationAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['LastDepreciationAmount'] = &$this->LastDepreciationAmount;

		// DepreciationRate
		$this->DepreciationRate = new DbField('_asset_view', 'asset_view', 'x_DepreciationRate', 'DepreciationRate', '`DepreciationRate`', '`DepreciationRate`', 5, 22, -1, FALSE, '`DepreciationRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepreciationRate->Sortable = TRUE; // Allow sort
		$this->DepreciationRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DepreciationRate'] = &$this->DepreciationRate;

		// CumulativeDepreciation
		$this->CumulativeDepreciation = new DbField('_asset_view', 'asset_view', 'x_CumulativeDepreciation', 'CumulativeDepreciation', '`CumulativeDepreciation`', '`CumulativeDepreciation`', 5, 22, -1, FALSE, '`CumulativeDepreciation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CumulativeDepreciation->Sortable = TRUE; // Allow sort
		$this->CumulativeDepreciation->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['CumulativeDepreciation'] = &$this->CumulativeDepreciation;

		// AssetStatus
		$this->AssetStatus = new DbField('_asset_view', 'asset_view', 'x_AssetStatus', 'AssetStatus', '`AssetStatus`', '`AssetStatus`', 200, 255, -1, FALSE, '`AssetStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssetStatus->Nullable = FALSE; // NOT NULL field
		$this->AssetStatus->Required = TRUE; // Required field
		$this->AssetStatus->Sortable = TRUE; // Allow sort
		$this->fields['AssetStatus'] = &$this->AssetStatus;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`asset_view`";
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
			if (array_key_exists('ProvinceCode', $rs))
				AddFilter($where, QuotedName('ProvinceCode', $this->Dbid) . '=' . QuotedValue($rs['ProvinceCode'], $this->ProvinceCode->DataType, $this->Dbid));
			if (array_key_exists('LACode', $rs))
				AddFilter($where, QuotedName('LACode', $this->Dbid) . '=' . QuotedValue($rs['LACode'], $this->LACode->DataType, $this->Dbid));
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
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->ProvinceName->DbValue = $row['ProvinceName'];
		$this->LACode->DbValue = $row['LACode'];
		$this->LAName->DbValue = $row['LAName'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->AssetTypeCode->DbValue = $row['AssetTypeCode'];
		$this->AssetTypeName->DbValue = $row['AssetTypeName'];
		$this->Supplier->DbValue = $row['Supplier'];
		$this->PurchasePrice->DbValue = $row['PurchasePrice'];
		$this->CurrencyCode->DbValue = $row['CurrencyCode'];
		$this->ConditionDesc->DbValue = $row['ConditionDesc'];
		$this->DateOfPurchase->DbValue = $row['DateOfPurchase'];
		$this->AssetCapacity->DbValue = $row['AssetCapacity'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->AssetDescription->DbValue = $row['AssetDescription'];
		$this->DateOfLastRevaluation->DbValue = $row['DateOfLastRevaluation'];
		$this->NewValue->DbValue = $row['NewValue'];
		$this->NameOfValuer->DbValue = $row['NameOfValuer'];
		$this->BookValue->DbValue = $row['BookValue'];
		$this->LastDepreciationDate->DbValue = $row['LastDepreciationDate'];
		$this->LastDepreciationAmount->DbValue = $row['LastDepreciationAmount'];
		$this->DepreciationRate->DbValue = $row['DepreciationRate'];
		$this->CumulativeDepreciation->DbValue = $row['CumulativeDepreciation'];
		$this->AssetStatus->DbValue = $row['AssetStatus'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ProvinceCode` = @ProvinceCode@ AND `LACode` = '@LACode@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ProvinceCode', $row) ? $row['ProvinceCode'] : NULL;
		else
			$val = $this->ProvinceCode->OldValue !== NULL ? $this->ProvinceCode->OldValue : $this->ProvinceCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ProvinceCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('LACode', $row) ? $row['LACode'] : NULL;
		else
			$val = $this->LACode->OldValue !== NULL ? $this->LACode->OldValue : $this->LACode->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LACode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "_asset_viewlist.php";
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
		if ($pageName == "_asset_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "_asset_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "_asset_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "_asset_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("_asset_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("_asset_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "_asset_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "_asset_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("_asset_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("_asset_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("_asset_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ProvinceCode:" . JsonEncode($this->ProvinceCode->CurrentValue, "number");
		$json .= ",LACode:" . JsonEncode($this->LACode->CurrentValue, "string");
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
		if ($this->ProvinceCode->CurrentValue != NULL) {
			$url .= "ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->LACode->CurrentValue != NULL) {
			$url .= "&LACode=" . urlencode($this->LACode->CurrentValue);
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
			if (Param("ProvinceCode") !== NULL)
				$arKey[] = Param("ProvinceCode");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("LACode") !== NULL)
				$arKey[] = Param("LACode");
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
				if (!is_numeric($key[0])) // ProvinceCode
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
				$this->ProvinceCode->CurrentValue = $key[0];
			else
				$this->ProvinceCode->OldValue = $key[0];
			if ($setCurrent)
				$this->LACode->CurrentValue = $key[1];
			else
				$this->LACode->OldValue = $key[1];
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
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->ProvinceName->setDbValue($rs->fields('ProvinceName'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->LAName->setDbValue($rs->fields('LAName'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->AssetTypeCode->setDbValue($rs->fields('AssetTypeCode'));
		$this->AssetTypeName->setDbValue($rs->fields('AssetTypeName'));
		$this->Supplier->setDbValue($rs->fields('Supplier'));
		$this->PurchasePrice->setDbValue($rs->fields('PurchasePrice'));
		$this->CurrencyCode->setDbValue($rs->fields('CurrencyCode'));
		$this->ConditionDesc->setDbValue($rs->fields('ConditionDesc'));
		$this->DateOfPurchase->setDbValue($rs->fields('DateOfPurchase'));
		$this->AssetCapacity->setDbValue($rs->fields('AssetCapacity'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->AssetDescription->setDbValue($rs->fields('AssetDescription'));
		$this->DateOfLastRevaluation->setDbValue($rs->fields('DateOfLastRevaluation'));
		$this->NewValue->setDbValue($rs->fields('NewValue'));
		$this->NameOfValuer->setDbValue($rs->fields('NameOfValuer'));
		$this->BookValue->setDbValue($rs->fields('BookValue'));
		$this->LastDepreciationDate->setDbValue($rs->fields('LastDepreciationDate'));
		$this->LastDepreciationAmount->setDbValue($rs->fields('LastDepreciationAmount'));
		$this->DepreciationRate->setDbValue($rs->fields('DepreciationRate'));
		$this->CumulativeDepreciation->setDbValue($rs->fields('CumulativeDepreciation'));
		$this->AssetStatus->setDbValue($rs->fields('AssetStatus'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ProvinceCode
		// ProvinceName
		// LACode
		// LAName
		// DepartmentCode
		// AssetTypeCode
		// AssetTypeName
		// Supplier
		// PurchasePrice
		// CurrencyCode
		// ConditionDesc
		// DateOfPurchase
		// AssetCapacity
		// UnitOfMeasure
		// AssetDescription
		// DateOfLastRevaluation
		// NewValue
		// NameOfValuer
		// BookValue
		// LastDepreciationDate
		// LastDepreciationAmount
		// DepreciationRate
		// CumulativeDepreciation
		// AssetStatus
		// ProvinceCode

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

		// ProvinceName
		$this->ProvinceName->ViewValue = $this->ProvinceName->CurrentValue;
		$this->ProvinceName->ViewCustomAttributes = "";

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

		// LAName
		$this->LAName->ViewValue = $this->LAName->CurrentValue;
		$this->LAName->ViewCustomAttributes = "";

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

		// AssetTypeCode
		$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->CurrentValue;
		$this->AssetTypeCode->ViewCustomAttributes = "";

		// AssetTypeName
		$this->AssetTypeName->ViewValue = $this->AssetTypeName->CurrentValue;
		$this->AssetTypeName->ViewCustomAttributes = "";

		// Supplier
		$this->Supplier->ViewValue = $this->Supplier->CurrentValue;
		$this->Supplier->ViewCustomAttributes = "";

		// PurchasePrice
		$this->PurchasePrice->ViewValue = $this->PurchasePrice->CurrentValue;
		$this->PurchasePrice->ViewValue = FormatNumber($this->PurchasePrice->ViewValue, 0, -2, -2, -2);
		$this->PurchasePrice->CellCssStyle .= "text-align: right;";
		$this->PurchasePrice->ViewCustomAttributes = "";

		// CurrencyCode
		$this->CurrencyCode->ViewValue = $this->CurrencyCode->CurrentValue;
		$this->CurrencyCode->ViewCustomAttributes = "";

		// ConditionDesc
		$this->ConditionDesc->ViewValue = $this->ConditionDesc->CurrentValue;
		$this->ConditionDesc->ViewCustomAttributes = "";

		// DateOfPurchase
		$this->DateOfPurchase->ViewValue = $this->DateOfPurchase->CurrentValue;
		$this->DateOfPurchase->ViewValue = FormatDateTime($this->DateOfPurchase->ViewValue, 0);
		$this->DateOfPurchase->ViewCustomAttributes = "";

		// AssetCapacity
		$this->AssetCapacity->ViewValue = $this->AssetCapacity->CurrentValue;
		$this->AssetCapacity->ViewValue = FormatNumber($this->AssetCapacity->ViewValue, 2, -2, -2, -2);
		$this->AssetCapacity->ViewCustomAttributes = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// AssetDescription
		$this->AssetDescription->ViewValue = $this->AssetDescription->CurrentValue;
		$this->AssetDescription->ViewCustomAttributes = "";

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation->ViewValue = $this->DateOfLastRevaluation->CurrentValue;
		$this->DateOfLastRevaluation->ViewValue = FormatDateTime($this->DateOfLastRevaluation->ViewValue, 0);
		$this->DateOfLastRevaluation->ViewCustomAttributes = "";

		// NewValue
		$this->NewValue->ViewValue = $this->NewValue->CurrentValue;
		$this->NewValue->ViewValue = FormatNumber($this->NewValue->ViewValue, 2, -2, -2, -2);
		$this->NewValue->CellCssStyle .= "text-align: right;";
		$this->NewValue->ViewCustomAttributes = "";

		// NameOfValuer
		$this->NameOfValuer->ViewValue = $this->NameOfValuer->CurrentValue;
		$this->NameOfValuer->ViewCustomAttributes = "";

		// BookValue
		$this->BookValue->ViewValue = $this->BookValue->CurrentValue;
		$this->BookValue->ViewValue = FormatNumber($this->BookValue->ViewValue, 2, -2, -2, -2);
		$this->BookValue->ViewCustomAttributes = "";

		// LastDepreciationDate
		$this->LastDepreciationDate->ViewValue = $this->LastDepreciationDate->CurrentValue;
		$this->LastDepreciationDate->ViewValue = FormatDateTime($this->LastDepreciationDate->ViewValue, 0);
		$this->LastDepreciationDate->ViewCustomAttributes = "";

		// LastDepreciationAmount
		$this->LastDepreciationAmount->ViewValue = $this->LastDepreciationAmount->CurrentValue;
		$this->LastDepreciationAmount->ViewValue = FormatNumber($this->LastDepreciationAmount->ViewValue, 2, -2, -2, -2);
		$this->LastDepreciationAmount->CellCssStyle .= "text-align: right;";
		$this->LastDepreciationAmount->ViewCustomAttributes = "";

		// DepreciationRate
		$this->DepreciationRate->ViewValue = $this->DepreciationRate->CurrentValue;
		$this->DepreciationRate->ViewValue = FormatNumber($this->DepreciationRate->ViewValue, 2, -2, -2, -2);
		$this->DepreciationRate->CellCssStyle .= "text-align: right;";
		$this->DepreciationRate->ViewCustomAttributes = "";

		// CumulativeDepreciation
		$this->CumulativeDepreciation->ViewValue = $this->CumulativeDepreciation->CurrentValue;
		$this->CumulativeDepreciation->ViewValue = FormatNumber($this->CumulativeDepreciation->ViewValue, 2, -2, -2, -2);
		$this->CumulativeDepreciation->CellCssStyle .= "text-align: right;";
		$this->CumulativeDepreciation->ViewCustomAttributes = "";

		// AssetStatus
		$this->AssetStatus->ViewValue = $this->AssetStatus->CurrentValue;
		$this->AssetStatus->ViewCustomAttributes = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// ProvinceName
		$this->ProvinceName->LinkCustomAttributes = "";
		$this->ProvinceName->HrefValue = "";
		$this->ProvinceName->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// LAName
		$this->LAName->LinkCustomAttributes = "";
		$this->LAName->HrefValue = "";
		$this->LAName->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// AssetTypeCode
		$this->AssetTypeCode->LinkCustomAttributes = "";
		$this->AssetTypeCode->HrefValue = "";
		$this->AssetTypeCode->TooltipValue = "";

		// AssetTypeName
		$this->AssetTypeName->LinkCustomAttributes = "";
		$this->AssetTypeName->HrefValue = "";
		$this->AssetTypeName->TooltipValue = "";

		// Supplier
		$this->Supplier->LinkCustomAttributes = "";
		$this->Supplier->HrefValue = "";
		$this->Supplier->TooltipValue = "";

		// PurchasePrice
		$this->PurchasePrice->LinkCustomAttributes = "";
		$this->PurchasePrice->HrefValue = "";
		$this->PurchasePrice->TooltipValue = "";

		// CurrencyCode
		$this->CurrencyCode->LinkCustomAttributes = "";
		$this->CurrencyCode->HrefValue = "";
		$this->CurrencyCode->TooltipValue = "";

		// ConditionDesc
		$this->ConditionDesc->LinkCustomAttributes = "";
		$this->ConditionDesc->HrefValue = "";
		$this->ConditionDesc->TooltipValue = "";

		// DateOfPurchase
		$this->DateOfPurchase->LinkCustomAttributes = "";
		$this->DateOfPurchase->HrefValue = "";
		$this->DateOfPurchase->TooltipValue = "";

		// AssetCapacity
		$this->AssetCapacity->LinkCustomAttributes = "";
		$this->AssetCapacity->HrefValue = "";
		$this->AssetCapacity->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// AssetDescription
		$this->AssetDescription->LinkCustomAttributes = "";
		$this->AssetDescription->HrefValue = "";
		$this->AssetDescription->TooltipValue = "";

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation->LinkCustomAttributes = "";
		$this->DateOfLastRevaluation->HrefValue = "";
		$this->DateOfLastRevaluation->TooltipValue = "";

		// NewValue
		$this->NewValue->LinkCustomAttributes = "";
		$this->NewValue->HrefValue = "";
		$this->NewValue->TooltipValue = "";

		// NameOfValuer
		$this->NameOfValuer->LinkCustomAttributes = "";
		$this->NameOfValuer->HrefValue = "";
		$this->NameOfValuer->TooltipValue = "";

		// BookValue
		$this->BookValue->LinkCustomAttributes = "";
		$this->BookValue->HrefValue = "";
		$this->BookValue->TooltipValue = "";

		// LastDepreciationDate
		$this->LastDepreciationDate->LinkCustomAttributes = "";
		$this->LastDepreciationDate->HrefValue = "";
		$this->LastDepreciationDate->TooltipValue = "";

		// LastDepreciationAmount
		$this->LastDepreciationAmount->LinkCustomAttributes = "";
		$this->LastDepreciationAmount->HrefValue = "";
		$this->LastDepreciationAmount->TooltipValue = "";

		// DepreciationRate
		$this->DepreciationRate->LinkCustomAttributes = "";
		$this->DepreciationRate->HrefValue = "";
		$this->DepreciationRate->TooltipValue = "";

		// CumulativeDepreciation
		$this->CumulativeDepreciation->LinkCustomAttributes = "";
		$this->CumulativeDepreciation->HrefValue = "";
		$this->CumulativeDepreciation->TooltipValue = "";

		// AssetStatus
		$this->AssetStatus->LinkCustomAttributes = "";
		$this->AssetStatus->HrefValue = "";
		$this->AssetStatus->TooltipValue = "";

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

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";

		// ProvinceName
		$this->ProvinceName->EditAttrs["class"] = "form-control";
		$this->ProvinceName->EditCustomAttributes = "";
		if (!$this->ProvinceName->Raw)
			$this->ProvinceName->CurrentValue = HtmlDecode($this->ProvinceName->CurrentValue);
		$this->ProvinceName->EditValue = $this->ProvinceName->CurrentValue;
		$this->ProvinceName->PlaceHolder = RemoveHtml($this->ProvinceName->caption());

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// LAName
		$this->LAName->EditAttrs["class"] = "form-control";
		$this->LAName->EditCustomAttributes = "";
		if (!$this->LAName->Raw)
			$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
		$this->LAName->EditValue = $this->LAName->CurrentValue;
		$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";

		// AssetTypeCode
		$this->AssetTypeCode->EditAttrs["class"] = "form-control";
		$this->AssetTypeCode->EditCustomAttributes = "";
		$this->AssetTypeCode->EditValue = $this->AssetTypeCode->CurrentValue;
		$this->AssetTypeCode->PlaceHolder = RemoveHtml($this->AssetTypeCode->caption());

		// AssetTypeName
		$this->AssetTypeName->EditAttrs["class"] = "form-control";
		$this->AssetTypeName->EditCustomAttributes = "";
		if (!$this->AssetTypeName->Raw)
			$this->AssetTypeName->CurrentValue = HtmlDecode($this->AssetTypeName->CurrentValue);
		$this->AssetTypeName->EditValue = $this->AssetTypeName->CurrentValue;
		$this->AssetTypeName->PlaceHolder = RemoveHtml($this->AssetTypeName->caption());

		// Supplier
		$this->Supplier->EditAttrs["class"] = "form-control";
		$this->Supplier->EditCustomAttributes = "";
		if (!$this->Supplier->Raw)
			$this->Supplier->CurrentValue = HtmlDecode($this->Supplier->CurrentValue);
		$this->Supplier->EditValue = $this->Supplier->CurrentValue;
		$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

		// PurchasePrice
		$this->PurchasePrice->EditAttrs["class"] = "form-control";
		$this->PurchasePrice->EditCustomAttributes = "";
		$this->PurchasePrice->EditValue = $this->PurchasePrice->CurrentValue;
		$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());
		if (strval($this->PurchasePrice->EditValue) != "" && is_numeric($this->PurchasePrice->EditValue))
			$this->PurchasePrice->EditValue = FormatNumber($this->PurchasePrice->EditValue, -2, -2, -2, -2);
		

		// CurrencyCode
		$this->CurrencyCode->EditAttrs["class"] = "form-control";
		$this->CurrencyCode->EditCustomAttributes = "";
		if (!$this->CurrencyCode->Raw)
			$this->CurrencyCode->CurrentValue = HtmlDecode($this->CurrencyCode->CurrentValue);
		$this->CurrencyCode->EditValue = $this->CurrencyCode->CurrentValue;
		$this->CurrencyCode->PlaceHolder = RemoveHtml($this->CurrencyCode->caption());

		// ConditionDesc
		$this->ConditionDesc->EditAttrs["class"] = "form-control";
		$this->ConditionDesc->EditCustomAttributes = "";
		if (!$this->ConditionDesc->Raw)
			$this->ConditionDesc->CurrentValue = HtmlDecode($this->ConditionDesc->CurrentValue);
		$this->ConditionDesc->EditValue = $this->ConditionDesc->CurrentValue;
		$this->ConditionDesc->PlaceHolder = RemoveHtml($this->ConditionDesc->caption());

		// DateOfPurchase
		$this->DateOfPurchase->EditAttrs["class"] = "form-control";
		$this->DateOfPurchase->EditCustomAttributes = "";
		$this->DateOfPurchase->EditValue = FormatDateTime($this->DateOfPurchase->CurrentValue, 8);
		$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

		// AssetCapacity
		$this->AssetCapacity->EditAttrs["class"] = "form-control";
		$this->AssetCapacity->EditCustomAttributes = "";
		$this->AssetCapacity->EditValue = $this->AssetCapacity->CurrentValue;
		$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());
		if (strval($this->AssetCapacity->EditValue) != "" && is_numeric($this->AssetCapacity->EditValue))
			$this->AssetCapacity->EditValue = FormatNumber($this->AssetCapacity->EditValue, -2, -2, -2, -2);
		

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";
		if (!$this->UnitOfMeasure->Raw)
			$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
		$this->UnitOfMeasure->EditValue = $this->UnitOfMeasure->CurrentValue;
		$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

		// AssetDescription
		$this->AssetDescription->EditAttrs["class"] = "form-control";
		$this->AssetDescription->EditCustomAttributes = "";
		if (!$this->AssetDescription->Raw)
			$this->AssetDescription->CurrentValue = HtmlDecode($this->AssetDescription->CurrentValue);
		$this->AssetDescription->EditValue = $this->AssetDescription->CurrentValue;
		$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
		$this->DateOfLastRevaluation->EditCustomAttributes = "";
		$this->DateOfLastRevaluation->EditValue = FormatDateTime($this->DateOfLastRevaluation->CurrentValue, 8);
		$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

		// NewValue
		$this->NewValue->EditAttrs["class"] = "form-control";
		$this->NewValue->EditCustomAttributes = "";
		$this->NewValue->EditValue = $this->NewValue->CurrentValue;
		$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());
		if (strval($this->NewValue->EditValue) != "" && is_numeric($this->NewValue->EditValue))
			$this->NewValue->EditValue = FormatNumber($this->NewValue->EditValue, -2, -2, -2, -2);
		

		// NameOfValuer
		$this->NameOfValuer->EditAttrs["class"] = "form-control";
		$this->NameOfValuer->EditCustomAttributes = "";
		if (!$this->NameOfValuer->Raw)
			$this->NameOfValuer->CurrentValue = HtmlDecode($this->NameOfValuer->CurrentValue);
		$this->NameOfValuer->EditValue = $this->NameOfValuer->CurrentValue;
		$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

		// BookValue
		$this->BookValue->EditAttrs["class"] = "form-control";
		$this->BookValue->EditCustomAttributes = "";
		$this->BookValue->EditValue = $this->BookValue->CurrentValue;
		$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());
		if (strval($this->BookValue->EditValue) != "" && is_numeric($this->BookValue->EditValue))
			$this->BookValue->EditValue = FormatNumber($this->BookValue->EditValue, -2, -2, -2, -2);
		

		// LastDepreciationDate
		$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
		$this->LastDepreciationDate->EditCustomAttributes = "";
		$this->LastDepreciationDate->EditValue = FormatDateTime($this->LastDepreciationDate->CurrentValue, 8);
		$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

		// LastDepreciationAmount
		$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
		$this->LastDepreciationAmount->EditCustomAttributes = "";
		$this->LastDepreciationAmount->EditValue = $this->LastDepreciationAmount->CurrentValue;
		$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());
		if (strval($this->LastDepreciationAmount->EditValue) != "" && is_numeric($this->LastDepreciationAmount->EditValue))
			$this->LastDepreciationAmount->EditValue = FormatNumber($this->LastDepreciationAmount->EditValue, -2, -2, -2, -2);
		

		// DepreciationRate
		$this->DepreciationRate->EditAttrs["class"] = "form-control";
		$this->DepreciationRate->EditCustomAttributes = "";
		$this->DepreciationRate->EditValue = $this->DepreciationRate->CurrentValue;
		$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());
		if (strval($this->DepreciationRate->EditValue) != "" && is_numeric($this->DepreciationRate->EditValue))
			$this->DepreciationRate->EditValue = FormatNumber($this->DepreciationRate->EditValue, -2, -2, -2, -2);
		

		// CumulativeDepreciation
		$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
		$this->CumulativeDepreciation->EditCustomAttributes = "";
		$this->CumulativeDepreciation->EditValue = $this->CumulativeDepreciation->CurrentValue;
		$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());
		if (strval($this->CumulativeDepreciation->EditValue) != "" && is_numeric($this->CumulativeDepreciation->EditValue))
			$this->CumulativeDepreciation->EditValue = FormatNumber($this->CumulativeDepreciation->EditValue, -2, -2, -2, -2);
		

		// AssetStatus
		$this->AssetStatus->EditAttrs["class"] = "form-control";
		$this->AssetStatus->EditCustomAttributes = "";
		if (!$this->AssetStatus->Raw)
			$this->AssetStatus->CurrentValue = HtmlDecode($this->AssetStatus->CurrentValue);
		$this->AssetStatus->EditValue = $this->AssetStatus->CurrentValue;
		$this->AssetStatus->PlaceHolder = RemoveHtml($this->AssetStatus->caption());

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
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->ProvinceName);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->AssetTypeCode);
					$doc->exportCaption($this->AssetTypeName);
					$doc->exportCaption($this->Supplier);
					$doc->exportCaption($this->PurchasePrice);
					$doc->exportCaption($this->CurrencyCode);
					$doc->exportCaption($this->ConditionDesc);
					$doc->exportCaption($this->DateOfPurchase);
					$doc->exportCaption($this->AssetCapacity);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AssetDescription);
					$doc->exportCaption($this->DateOfLastRevaluation);
					$doc->exportCaption($this->NewValue);
					$doc->exportCaption($this->NameOfValuer);
					$doc->exportCaption($this->BookValue);
					$doc->exportCaption($this->LastDepreciationDate);
					$doc->exportCaption($this->LastDepreciationAmount);
					$doc->exportCaption($this->DepreciationRate);
					$doc->exportCaption($this->CumulativeDepreciation);
					$doc->exportCaption($this->AssetStatus);
				} else {
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->ProvinceName);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->LAName);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->AssetTypeCode);
					$doc->exportCaption($this->AssetTypeName);
					$doc->exportCaption($this->Supplier);
					$doc->exportCaption($this->PurchasePrice);
					$doc->exportCaption($this->CurrencyCode);
					$doc->exportCaption($this->ConditionDesc);
					$doc->exportCaption($this->DateOfPurchase);
					$doc->exportCaption($this->AssetCapacity);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->AssetDescription);
					$doc->exportCaption($this->DateOfLastRevaluation);
					$doc->exportCaption($this->NewValue);
					$doc->exportCaption($this->NameOfValuer);
					$doc->exportCaption($this->BookValue);
					$doc->exportCaption($this->LastDepreciationDate);
					$doc->exportCaption($this->LastDepreciationAmount);
					$doc->exportCaption($this->DepreciationRate);
					$doc->exportCaption($this->CumulativeDepreciation);
					$doc->exportCaption($this->AssetStatus);
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
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->ProvinceName);
						$doc->exportField($this->LACode);
						$doc->exportField($this->LAName);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->AssetTypeCode);
						$doc->exportField($this->AssetTypeName);
						$doc->exportField($this->Supplier);
						$doc->exportField($this->PurchasePrice);
						$doc->exportField($this->CurrencyCode);
						$doc->exportField($this->ConditionDesc);
						$doc->exportField($this->DateOfPurchase);
						$doc->exportField($this->AssetCapacity);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AssetDescription);
						$doc->exportField($this->DateOfLastRevaluation);
						$doc->exportField($this->NewValue);
						$doc->exportField($this->NameOfValuer);
						$doc->exportField($this->BookValue);
						$doc->exportField($this->LastDepreciationDate);
						$doc->exportField($this->LastDepreciationAmount);
						$doc->exportField($this->DepreciationRate);
						$doc->exportField($this->CumulativeDepreciation);
						$doc->exportField($this->AssetStatus);
					} else {
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->ProvinceName);
						$doc->exportField($this->LACode);
						$doc->exportField($this->LAName);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->AssetTypeCode);
						$doc->exportField($this->AssetTypeName);
						$doc->exportField($this->Supplier);
						$doc->exportField($this->PurchasePrice);
						$doc->exportField($this->CurrencyCode);
						$doc->exportField($this->ConditionDesc);
						$doc->exportField($this->DateOfPurchase);
						$doc->exportField($this->AssetCapacity);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->AssetDescription);
						$doc->exportField($this->DateOfLastRevaluation);
						$doc->exportField($this->NewValue);
						$doc->exportField($this->NameOfValuer);
						$doc->exportField($this->BookValue);
						$doc->exportField($this->LastDepreciationDate);
						$doc->exportField($this->LastDepreciationAmount);
						$doc->exportField($this->DepreciationRate);
						$doc->exportField($this->CumulativeDepreciation);
						$doc->exportField($this->AssetStatus);
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