<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for client
 */
class client extends DbTable
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
	public $ClientSerNo;
	public $ClientID;
	public $ClientType;
	public $IdentityType;
	public $PrivilegeCode;
	public $ClientName;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $Sex;
	public $MaritalStatus;
	public $DateOfBirth;
	public $PostalAddress;
	public $PhysicalAddress;
	public $TownOrVillage;
	public $Telephone;
	public $Mobile;
	public $Fax;
	public $_Email;
	public $NextOfKin;
	public $RelationshipCode;
	public $NextOfKinMobile;
	public $NextOfKinEmail;
	public $AdditionalInformation;
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
		$this->TableVar = 'client';
		$this->TableName = 'client';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`client`";
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
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ClientSerNo
		$this->ClientSerNo = new DbField('client', 'client', 'x_ClientSerNo', 'ClientSerNo', '`ClientSerNo`', '`ClientSerNo`', 3, 11, -1, FALSE, '`ClientSerNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ClientSerNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ClientSerNo->IsPrimaryKey = TRUE; // Primary key field
		$this->ClientSerNo->IsForeignKey = TRUE; // Foreign key field
		$this->ClientSerNo->Sortable = TRUE; // Allow sort
		$this->ClientSerNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientSerNo'] = &$this->ClientSerNo;

		// ClientID
		$this->ClientID = new DbField('client', 'client', 'x_ClientID', 'ClientID', '`ClientID`', '`ClientID`', 200, 13, -1, FALSE, '`ClientID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientID->Nullable = FALSE; // NOT NULL field
		$this->ClientID->Sortable = TRUE; // Allow sort
		$this->fields['ClientID'] = &$this->ClientID;

		// ClientType
		$this->ClientType = new DbField('client', 'client', 'x_ClientType', 'ClientType', '`ClientType`', '`ClientType`', 16, 3, -1, FALSE, '`ClientType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ClientType->Sortable = TRUE; // Allow sort
		$this->ClientType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ClientType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ClientType->Lookup = new Lookup('ClientType', 'client_type', FALSE, 'ClientType', ["ClientTypeTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->ClientType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientType'] = &$this->ClientType;

		// IdentityType
		$this->IdentityType = new DbField('client', 'client', 'x_IdentityType', 'IdentityType', '`IdentityType`', '`IdentityType`', 16, 1, -1, FALSE, '`IdentityType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->IdentityType->Sortable = TRUE; // Allow sort
		$this->IdentityType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->IdentityType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->IdentityType->Lookup = new Lookup('IdentityType', 'id_type', FALSE, 'IDType', ["IDTypeName","","",""], [], [], [], [], [], [], '', '');
		$this->IdentityType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IdentityType'] = &$this->IdentityType;

		// PrivilegeCode
		$this->PrivilegeCode = new DbField('client', 'client', 'x_PrivilegeCode', 'PrivilegeCode', '`PrivilegeCode`', '`PrivilegeCode`', 16, 1, -1, FALSE, '`PrivilegeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PrivilegeCode->Sortable = TRUE; // Allow sort
		$this->PrivilegeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PrivilegeCode'] = &$this->PrivilegeCode;

		// ClientName
		$this->ClientName = new DbField('client', 'client', 'x_ClientName', 'ClientName', '`ClientName`', '`ClientName`', 200, 255, -1, FALSE, '`ClientName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientName->Nullable = FALSE; // NOT NULL field
		$this->ClientName->Required = TRUE; // Required field
		$this->ClientName->Sortable = TRUE; // Allow sort
		$this->fields['ClientName'] = &$this->ClientName;

		// Title
		$this->Title = new DbField('client', 'client', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->Title->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Title->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Title->Lookup = new Lookup('Title', 'title_ref', FALSE, 'Title', ["Title","Sex","",""], [], [], [], [], ["Sex"], ["x_Sex"], '', '');
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new DbField('client', 'client', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 255, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new DbField('client', 'client', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 255, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('client', 'client', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Sex
		$this->Sex = new DbField('client', 'client', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->Sex->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Sex->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Sex->Lookup = new Lookup('Sex', 'sex', FALSE, 'Sex', ["Sex","","",""], [], [], [], [], [], [], '', '');
		$this->Sex->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Sex'] = &$this->Sex;

		// MaritalStatus
		$this->MaritalStatus = new DbField('client', 'client', 'x_MaritalStatus', 'MaritalStatus', '`MaritalStatus`', '`MaritalStatus`', 16, 3, -1, FALSE, '`MaritalStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MaritalStatus->Sortable = TRUE; // Allow sort
		$this->MaritalStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MaritalStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MaritalStatus->Lookup = new Lookup('MaritalStatus', 'marital_status', FALSE, 'MaritalStatusCode', ["MaritalStatus","","",""], [], [], [], [], [], [], '', '');
		$this->MaritalStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MaritalStatus'] = &$this->MaritalStatus;

		// DateOfBirth
		$this->DateOfBirth = new DbField('client', 'client', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// PostalAddress
		$this->PostalAddress = new DbField('client', 'client', 'x_PostalAddress', 'PostalAddress', '`PostalAddress`', '`PostalAddress`', 200, 255, -1, FALSE, '`PostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->PostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PostalAddress'] = &$this->PostalAddress;

		// PhysicalAddress
		$this->PhysicalAddress = new DbField('client', 'client', 'x_PhysicalAddress', 'PhysicalAddress', '`PhysicalAddress`', '`PhysicalAddress`', 200, 255, -1, FALSE, '`PhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->PhysicalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PhysicalAddress'] = &$this->PhysicalAddress;

		// TownOrVillage
		$this->TownOrVillage = new DbField('client', 'client', 'x_TownOrVillage', 'TownOrVillage', '`TownOrVillage`', '`TownOrVillage`', 200, 255, -1, FALSE, '`TownOrVillage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TownOrVillage->Sortable = TRUE; // Allow sort
		$this->fields['TownOrVillage'] = &$this->TownOrVillage;

		// Telephone
		$this->Telephone = new DbField('client', 'client', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 255, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('client', 'client', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Fax
		$this->Fax = new DbField('client', 'client', 'x_Fax', 'Fax', '`Fax`', '`Fax`', 200, 20, -1, FALSE, '`Fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fax->Sortable = TRUE; // Allow sort
		$this->fields['Fax'] = &$this->Fax;

		// Email
		$this->_Email = new DbField('client', 'client', 'x__Email', 'Email', '`Email`', '`Email`', 200, 255, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->_Email->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['Email'] = &$this->_Email;

		// NextOfKin
		$this->NextOfKin = new DbField('client', 'client', 'x_NextOfKin', 'NextOfKin', '`NextOfKin`', '`NextOfKin`', 200, 255, -1, FALSE, '`NextOfKin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKin->Sortable = TRUE; // Allow sort
		$this->fields['NextOfKin'] = &$this->NextOfKin;

		// RelationshipCode
		$this->RelationshipCode = new DbField('client', 'client', 'x_RelationshipCode', 'RelationshipCode', '`RelationshipCode`', '`RelationshipCode`', 16, 3, -1, FALSE, '`RelationshipCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RelationshipCode->Sortable = TRUE; // Allow sort
		$this->RelationshipCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RelationshipCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RelationshipCode->Lookup = new Lookup('RelationshipCode', 'relationship', FALSE, 'RelationshipCode', ["Relationship","","",""], [], [], [], [], [], [], '', '');
		$this->RelationshipCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RelationshipCode'] = &$this->RelationshipCode;

		// NextOfKinMobile
		$this->NextOfKinMobile = new DbField('client', 'client', 'x_NextOfKinMobile', 'NextOfKinMobile', '`NextOfKinMobile`', '`NextOfKinMobile`', 200, 255, -1, FALSE, '`NextOfKinMobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKinMobile->Sortable = TRUE; // Allow sort
		$this->fields['NextOfKinMobile'] = &$this->NextOfKinMobile;

		// NextOfKinEmail
		$this->NextOfKinEmail = new DbField('client', 'client', 'x_NextOfKinEmail', 'NextOfKinEmail', '`NextOfKinEmail`', '`NextOfKinEmail`', 200, 255, -1, FALSE, '`NextOfKinEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKinEmail->Sortable = TRUE; // Allow sort
		$this->NextOfKinEmail->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['NextOfKinEmail'] = &$this->NextOfKinEmail;

		// AdditionalInformation
		$this->AdditionalInformation = new DbField('client', 'client', 'x_AdditionalInformation', 'AdditionalInformation', '`AdditionalInformation`', '`AdditionalInformation`', 201, 16777215, -1, FALSE, '`AdditionalInformation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->AdditionalInformation->Sortable = TRUE; // Allow sort
		$this->fields['AdditionalInformation'] = &$this->AdditionalInformation;

		// LastUpdatedBy
		$this->LastUpdatedBy = new DbField('client', 'client', 'x_LastUpdatedBy', 'LastUpdatedBy', '`LastUpdatedBy`', '`LastUpdatedBy`', 200, 100, -1, FALSE, '`LastUpdatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdatedBy->Sortable = TRUE; // Allow sort
		$this->fields['LastUpdatedBy'] = &$this->LastUpdatedBy;

		// LastUpdateDate
		$this->LastUpdateDate = new DbField('client', 'client', 'x_LastUpdateDate', 'LastUpdateDate', '`LastUpdateDate`', CastDateFieldForLike("`LastUpdateDate`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "property") {
			$detailUrl = $GLOBALS["property"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "bill_board") {
			$detailUrl = $GLOBALS["bill_board"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "property_lookup_view") {
			$detailUrl = $GLOBALS["property_lookup_view"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "clientlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`client`";
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
			$this->ClientSerNo->setDbValue($conn->insert_ID());
			$rs['ClientSerNo'] = $this->ClientSerNo->DbValue;
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

		// Cascade Update detail table 'property'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['ClientSerNo']) && $rsold['ClientSerNo'] != $rs['ClientSerNo'])) { // Update detail field 'ClientSerNo'
			$cascadeUpdate = TRUE;
			$rscascade['ClientSerNo'] = $rs['ClientSerNo'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["property"]))
				$GLOBALS["property"] = new property();
			$rswrk = $GLOBALS["property"]->loadRs("`ClientSerNo` = " . QuotedValue($rsold['ClientSerNo'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'ValuationNo';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["property"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["property"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["property"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'bill_board'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['ClientSerNo']) && $rsold['ClientSerNo'] != $rs['ClientSerNo'])) { // Update detail field 'ClientSerNo'
			$cascadeUpdate = TRUE;
			$rscascade['ClientSerNo'] = $rs['ClientSerNo'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["bill_board"]))
				$GLOBALS["bill_board"] = new bill_board();
			$rswrk = $GLOBALS["bill_board"]->loadRs("`ClientSerNo` = " . QuotedValue($rsold['ClientSerNo'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'BillBoardNo';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["bill_board"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["bill_board"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["bill_board"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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
			if (array_key_exists('ClientSerNo', $rs))
				AddFilter($where, QuotedName('ClientSerNo', $this->Dbid) . '=' . QuotedValue($rs['ClientSerNo'], $this->ClientSerNo->DataType, $this->Dbid));
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

		// Cascade delete detail table 'property'
		if (!isset($GLOBALS["property"]))
			$GLOBALS["property"] = new property();
		$rscascade = $GLOBALS["property"]->loadRs("`ClientSerNo` = " . QuotedValue($rs['ClientSerNo'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["property"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["property"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["property"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'bill_board'
		if (!isset($GLOBALS["bill_board"]))
			$GLOBALS["bill_board"] = new bill_board();
		$rscascade = $GLOBALS["bill_board"]->loadRs("`ClientSerNo` = " . QuotedValue($rs['ClientSerNo'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["bill_board"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["bill_board"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["bill_board"]->Row_Deleted($dtlrow);
		}
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
		$this->ClientSerNo->DbValue = $row['ClientSerNo'];
		$this->ClientID->DbValue = $row['ClientID'];
		$this->ClientType->DbValue = $row['ClientType'];
		$this->IdentityType->DbValue = $row['IdentityType'];
		$this->PrivilegeCode->DbValue = $row['PrivilegeCode'];
		$this->ClientName->DbValue = $row['ClientName'];
		$this->Title->DbValue = $row['Title'];
		$this->Surname->DbValue = $row['Surname'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->Sex->DbValue = $row['Sex'];
		$this->MaritalStatus->DbValue = $row['MaritalStatus'];
		$this->DateOfBirth->DbValue = $row['DateOfBirth'];
		$this->PostalAddress->DbValue = $row['PostalAddress'];
		$this->PhysicalAddress->DbValue = $row['PhysicalAddress'];
		$this->TownOrVillage->DbValue = $row['TownOrVillage'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->Fax->DbValue = $row['Fax'];
		$this->_Email->DbValue = $row['Email'];
		$this->NextOfKin->DbValue = $row['NextOfKin'];
		$this->RelationshipCode->DbValue = $row['RelationshipCode'];
		$this->NextOfKinMobile->DbValue = $row['NextOfKinMobile'];
		$this->NextOfKinEmail->DbValue = $row['NextOfKinEmail'];
		$this->AdditionalInformation->DbValue = $row['AdditionalInformation'];
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
		return "`ClientSerNo` = @ClientSerNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ClientSerNo', $row) ? $row['ClientSerNo'] : NULL;
		else
			$val = $this->ClientSerNo->OldValue !== NULL ? $this->ClientSerNo->OldValue : $this->ClientSerNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ClientSerNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "clientlist.php";
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
		if ($pageName == "clientview.php")
			return $Language->phrase("View");
		elseif ($pageName == "clientedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "clientadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "clientlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("clientview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("clientview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "clientadd.php?" . $this->getUrlParm($parm);
		else
			$url = "clientadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("clientedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("clientedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("clientadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("clientadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("clientdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ClientSerNo:" . JsonEncode($this->ClientSerNo->CurrentValue, "number");
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
		if ($this->ClientSerNo->CurrentValue != NULL) {
			$url .= "ClientSerNo=" . urlencode($this->ClientSerNo->CurrentValue);
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
			if (Param("ClientSerNo") !== NULL)
				$arKeys[] = Param("ClientSerNo");
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
				$this->ClientSerNo->CurrentValue = $key;
			else
				$this->ClientSerNo->OldValue = $key;
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
		$this->ClientSerNo->setDbValue($rs->fields('ClientSerNo'));
		$this->ClientID->setDbValue($rs->fields('ClientID'));
		$this->ClientType->setDbValue($rs->fields('ClientType'));
		$this->IdentityType->setDbValue($rs->fields('IdentityType'));
		$this->PrivilegeCode->setDbValue($rs->fields('PrivilegeCode'));
		$this->ClientName->setDbValue($rs->fields('ClientName'));
		$this->Title->setDbValue($rs->fields('Title'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->MaritalStatus->setDbValue($rs->fields('MaritalStatus'));
		$this->DateOfBirth->setDbValue($rs->fields('DateOfBirth'));
		$this->PostalAddress->setDbValue($rs->fields('PostalAddress'));
		$this->PhysicalAddress->setDbValue($rs->fields('PhysicalAddress'));
		$this->TownOrVillage->setDbValue($rs->fields('TownOrVillage'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->Fax->setDbValue($rs->fields('Fax'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->NextOfKin->setDbValue($rs->fields('NextOfKin'));
		$this->RelationshipCode->setDbValue($rs->fields('RelationshipCode'));
		$this->NextOfKinMobile->setDbValue($rs->fields('NextOfKinMobile'));
		$this->NextOfKinEmail->setDbValue($rs->fields('NextOfKinEmail'));
		$this->AdditionalInformation->setDbValue($rs->fields('AdditionalInformation'));
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
		// ClientSerNo
		// ClientID
		// ClientType
		// IdentityType
		// PrivilegeCode
		// ClientName
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// MaritalStatus
		// DateOfBirth
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// NextOfKin
		// RelationshipCode
		// NextOfKinMobile
		// NextOfKinEmail
		// AdditionalInformation
		// LastUpdatedBy
		// LastUpdateDate
		// ClientSerNo

		$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
		$this->ClientID->ViewCustomAttributes = "";

		// ClientType
		$curVal = strval($this->ClientType->CurrentValue);
		if ($curVal != "") {
			$this->ClientType->ViewValue = $this->ClientType->lookupCacheOption($curVal);
			if ($this->ClientType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ClientType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ClientType->ViewValue = $this->ClientType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientType->ViewValue = $this->ClientType->CurrentValue;
				}
			}
		} else {
			$this->ClientType->ViewValue = NULL;
		}
		$this->ClientType->ViewCustomAttributes = "";

		// IdentityType
		$curVal = strval($this->IdentityType->CurrentValue);
		if ($curVal != "") {
			$this->IdentityType->ViewValue = $this->IdentityType->lookupCacheOption($curVal);
			if ($this->IdentityType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IDType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->IdentityType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->IdentityType->ViewValue = $this->IdentityType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->IdentityType->ViewValue = $this->IdentityType->CurrentValue;
				}
			}
		} else {
			$this->IdentityType->ViewValue = NULL;
		}
		$this->IdentityType->ViewCustomAttributes = "";

		// PrivilegeCode
		$this->PrivilegeCode->ViewValue = $this->PrivilegeCode->CurrentValue;
		$this->PrivilegeCode->ViewCustomAttributes = "";

		// ClientName
		$this->ClientName->ViewValue = $this->ClientName->CurrentValue;
		$this->ClientName->ViewCustomAttributes = "";

		// Title
		$curVal = strval($this->Title->CurrentValue);
		if ($curVal != "") {
			$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
			if ($this->Title->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Title`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Title->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Title->ViewValue = $this->Title->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Title->ViewValue = $this->Title->CurrentValue;
				}
			}
		} else {
			$this->Title->ViewValue = NULL;
		}
		$this->Title->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->ViewCustomAttributes = "";

		// Sex
		$curVal = strval($this->Sex->CurrentValue);
		if ($curVal != "") {
			$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
			if ($this->Sex->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Sex`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Sex->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Sex->ViewValue = $this->Sex->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Sex->ViewValue = $this->Sex->CurrentValue;
				}
			}
		} else {
			$this->Sex->ViewValue = NULL;
		}
		$this->Sex->ViewCustomAttributes = "";

		// MaritalStatus
		$curVal = strval($this->MaritalStatus->CurrentValue);
		if ($curVal != "") {
			$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
			if ($this->MaritalStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MaritalStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->MaritalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MaritalStatus->ViewValue = $this->MaritalStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MaritalStatus->ViewValue = $this->MaritalStatus->CurrentValue;
				}
			}
		} else {
			$this->MaritalStatus->ViewValue = NULL;
		}
		$this->MaritalStatus->ViewCustomAttributes = "";

		// DateOfBirth
		$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
		$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
		$this->DateOfBirth->ViewCustomAttributes = "";

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

		// NextOfKin
		$this->NextOfKin->ViewValue = $this->NextOfKin->CurrentValue;
		$this->NextOfKin->ViewCustomAttributes = "";

		// RelationshipCode
		$curVal = strval($this->RelationshipCode->CurrentValue);
		if ($curVal != "") {
			$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
			if ($this->RelationshipCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`RelationshipCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->RelationshipCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RelationshipCode->ViewValue = $this->RelationshipCode->CurrentValue;
				}
			}
		} else {
			$this->RelationshipCode->ViewValue = NULL;
		}
		$this->RelationshipCode->ViewCustomAttributes = "";

		// NextOfKinMobile
		$this->NextOfKinMobile->ViewValue = $this->NextOfKinMobile->CurrentValue;
		$this->NextOfKinMobile->ViewCustomAttributes = "";

		// NextOfKinEmail
		$this->NextOfKinEmail->ViewValue = $this->NextOfKinEmail->CurrentValue;
		$this->NextOfKinEmail->ViewCustomAttributes = "";

		// AdditionalInformation
		$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->ViewCustomAttributes = "";

		// LastUpdatedBy
		$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdatedBy->ViewCustomAttributes = "";

		// LastUpdateDate
		$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
		$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
		$this->LastUpdateDate->ViewCustomAttributes = "";

		// ClientSerNo
		$this->ClientSerNo->LinkCustomAttributes = "";
		$this->ClientSerNo->HrefValue = "";
		$this->ClientSerNo->TooltipValue = "";

		// ClientID
		$this->ClientID->LinkCustomAttributes = "";
		$this->ClientID->HrefValue = "";
		$this->ClientID->TooltipValue = "";

		// ClientType
		$this->ClientType->LinkCustomAttributes = "";
		$this->ClientType->HrefValue = "";
		$this->ClientType->TooltipValue = "";

		// IdentityType
		$this->IdentityType->LinkCustomAttributes = "";
		$this->IdentityType->HrefValue = "";
		$this->IdentityType->TooltipValue = "";

		// PrivilegeCode
		$this->PrivilegeCode->LinkCustomAttributes = "";
		$this->PrivilegeCode->HrefValue = "";
		$this->PrivilegeCode->TooltipValue = "";

		// ClientName
		$this->ClientName->LinkCustomAttributes = "";
		$this->ClientName->HrefValue = "";
		$this->ClientName->TooltipValue = "";

		// Title
		$this->Title->LinkCustomAttributes = "";
		$this->Title->HrefValue = "";
		$this->Title->TooltipValue = "";

		// Surname
		$this->Surname->LinkCustomAttributes = "";
		$this->Surname->HrefValue = "";
		$this->Surname->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// MiddleName
		$this->MiddleName->LinkCustomAttributes = "";
		$this->MiddleName->HrefValue = "";
		$this->MiddleName->TooltipValue = "";

		// Sex
		$this->Sex->LinkCustomAttributes = "";
		$this->Sex->HrefValue = "";
		$this->Sex->TooltipValue = "";

		// MaritalStatus
		$this->MaritalStatus->LinkCustomAttributes = "";
		$this->MaritalStatus->HrefValue = "";
		$this->MaritalStatus->TooltipValue = "";

		// DateOfBirth
		$this->DateOfBirth->LinkCustomAttributes = "";
		$this->DateOfBirth->HrefValue = "";
		$this->DateOfBirth->TooltipValue = "";

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

		// NextOfKin
		$this->NextOfKin->LinkCustomAttributes = "";
		$this->NextOfKin->HrefValue = "";
		$this->NextOfKin->TooltipValue = "";

		// RelationshipCode
		$this->RelationshipCode->LinkCustomAttributes = "";
		$this->RelationshipCode->HrefValue = "";
		$this->RelationshipCode->TooltipValue = "";

		// NextOfKinMobile
		$this->NextOfKinMobile->LinkCustomAttributes = "";
		$this->NextOfKinMobile->HrefValue = "";
		$this->NextOfKinMobile->TooltipValue = "";

		// NextOfKinEmail
		$this->NextOfKinEmail->LinkCustomAttributes = "";
		$this->NextOfKinEmail->HrefValue = "";
		$this->NextOfKinEmail->TooltipValue = "";

		// AdditionalInformation
		$this->AdditionalInformation->LinkCustomAttributes = "";
		$this->AdditionalInformation->HrefValue = "";
		$this->AdditionalInformation->TooltipValue = "";

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

		// ClientSerNo
		$this->ClientSerNo->EditAttrs["class"] = "form-control";
		$this->ClientSerNo->EditCustomAttributes = "";
		$this->ClientSerNo->EditValue = $this->ClientSerNo->CurrentValue;
		$this->ClientSerNo->ViewCustomAttributes = "";

		// ClientID
		$this->ClientID->EditAttrs["class"] = "form-control";
		$this->ClientID->EditCustomAttributes = "";
		if (!$this->ClientID->Raw)
			$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
		$this->ClientID->EditValue = $this->ClientID->CurrentValue;
		$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

		// ClientType
		$this->ClientType->EditAttrs["class"] = "form-control";
		$this->ClientType->EditCustomAttributes = "";

		// IdentityType
		$this->IdentityType->EditAttrs["class"] = "form-control";
		$this->IdentityType->EditCustomAttributes = "";

		// PrivilegeCode
		$this->PrivilegeCode->EditAttrs["class"] = "form-control";
		$this->PrivilegeCode->EditCustomAttributes = "";
		$this->PrivilegeCode->EditValue = $this->PrivilegeCode->CurrentValue;
		$this->PrivilegeCode->PlaceHolder = RemoveHtml($this->PrivilegeCode->caption());

		// ClientName
		$this->ClientName->EditAttrs["class"] = "form-control";
		$this->ClientName->EditCustomAttributes = "";
		if (!$this->ClientName->Raw)
			$this->ClientName->CurrentValue = HtmlDecode($this->ClientName->CurrentValue);
		$this->ClientName->EditValue = $this->ClientName->CurrentValue;
		$this->ClientName->PlaceHolder = RemoveHtml($this->ClientName->caption());

		// Title
		$this->Title->EditAttrs["class"] = "form-control";
		$this->Title->EditCustomAttributes = "";

		// Surname
		$this->Surname->EditAttrs["class"] = "form-control";
		$this->Surname->EditCustomAttributes = "";
		if (!$this->Surname->Raw)
			$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
		$this->Surname->EditValue = $this->Surname->CurrentValue;
		$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

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

		// Sex
		$this->Sex->EditAttrs["class"] = "form-control";
		$this->Sex->EditCustomAttributes = "";

		// MaritalStatus
		$this->MaritalStatus->EditAttrs["class"] = "form-control";
		$this->MaritalStatus->EditCustomAttributes = "";

		// DateOfBirth
		$this->DateOfBirth->EditAttrs["class"] = "form-control";
		$this->DateOfBirth->EditCustomAttributes = "";
		$this->DateOfBirth->EditValue = FormatDateTime($this->DateOfBirth->CurrentValue, 8);
		$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

		// PostalAddress
		$this->PostalAddress->EditAttrs["class"] = "form-control";
		$this->PostalAddress->EditCustomAttributes = "";
		$this->PostalAddress->EditValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

		// PhysicalAddress
		$this->PhysicalAddress->EditAttrs["class"] = "form-control";
		$this->PhysicalAddress->EditCustomAttributes = "";
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

		// NextOfKin
		$this->NextOfKin->EditAttrs["class"] = "form-control";
		$this->NextOfKin->EditCustomAttributes = "";
		if (!$this->NextOfKin->Raw)
			$this->NextOfKin->CurrentValue = HtmlDecode($this->NextOfKin->CurrentValue);
		$this->NextOfKin->EditValue = $this->NextOfKin->CurrentValue;
		$this->NextOfKin->PlaceHolder = RemoveHtml($this->NextOfKin->caption());

		// RelationshipCode
		$this->RelationshipCode->EditAttrs["class"] = "form-control";
		$this->RelationshipCode->EditCustomAttributes = "";

		// NextOfKinMobile
		$this->NextOfKinMobile->EditAttrs["class"] = "form-control";
		$this->NextOfKinMobile->EditCustomAttributes = "";
		if (!$this->NextOfKinMobile->Raw)
			$this->NextOfKinMobile->CurrentValue = HtmlDecode($this->NextOfKinMobile->CurrentValue);
		$this->NextOfKinMobile->EditValue = $this->NextOfKinMobile->CurrentValue;
		$this->NextOfKinMobile->PlaceHolder = RemoveHtml($this->NextOfKinMobile->caption());

		// NextOfKinEmail
		$this->NextOfKinEmail->EditAttrs["class"] = "form-control";
		$this->NextOfKinEmail->EditCustomAttributes = "";
		if (!$this->NextOfKinEmail->Raw)
			$this->NextOfKinEmail->CurrentValue = HtmlDecode($this->NextOfKinEmail->CurrentValue);
		$this->NextOfKinEmail->EditValue = $this->NextOfKinEmail->CurrentValue;
		$this->NextOfKinEmail->PlaceHolder = RemoveHtml($this->NextOfKinEmail->caption());

		// AdditionalInformation
		$this->AdditionalInformation->EditAttrs["class"] = "form-control";
		$this->AdditionalInformation->EditCustomAttributes = "";
		$this->AdditionalInformation->EditValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

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
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->ClientType);
					$doc->exportCaption($this->IdentityType);
					$doc->exportCaption($this->PrivilegeCode);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->NextOfKin);
					$doc->exportCaption($this->RelationshipCode);
					$doc->exportCaption($this->NextOfKinMobile);
					$doc->exportCaption($this->NextOfKinEmail);
					$doc->exportCaption($this->AdditionalInformation);
				} else {
					$doc->exportCaption($this->ClientSerNo);
					$doc->exportCaption($this->ClientID);
					$doc->exportCaption($this->ClientType);
					$doc->exportCaption($this->IdentityType);
					$doc->exportCaption($this->PrivilegeCode);
					$doc->exportCaption($this->ClientName);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->NextOfKin);
					$doc->exportCaption($this->RelationshipCode);
					$doc->exportCaption($this->NextOfKinMobile);
					$doc->exportCaption($this->NextOfKinEmail);
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
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->ClientType);
						$doc->exportField($this->IdentityType);
						$doc->exportField($this->PrivilegeCode);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Sex);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
						$doc->exportField($this->NextOfKin);
						$doc->exportField($this->RelationshipCode);
						$doc->exportField($this->NextOfKinMobile);
						$doc->exportField($this->NextOfKinEmail);
						$doc->exportField($this->AdditionalInformation);
					} else {
						$doc->exportField($this->ClientSerNo);
						$doc->exportField($this->ClientID);
						$doc->exportField($this->ClientType);
						$doc->exportField($this->IdentityType);
						$doc->exportField($this->PrivilegeCode);
						$doc->exportField($this->ClientName);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Sex);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
						$doc->exportField($this->NextOfKin);
						$doc->exportField($this->RelationshipCode);
						$doc->exportField($this->NextOfKinMobile);
						$doc->exportField($this->NextOfKinEmail);
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