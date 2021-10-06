<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for musers
 */
class musers extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $UserCode;
	public $UserName;
	public $Password;
	public $ConfirmPwd;
	public $EmployeeID;
	public $FirstName;
	public $LastName;
	public $ProvinceCode;
	public $LACode;
	public $Level;
	public $Role;
	public $Clearance;
	public $OrganisationLevel;
	public $Active;
	public $_Email;
	public $Telephone;
	public $Mobile;
	public $Position;
	public $ReportsTo;
	public $Profile;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'musers';
		$this->TableName = 'musers';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`musers`";
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

		// UserCode
		$this->UserCode = new DbField('musers', 'musers', 'x_UserCode', 'UserCode', '`UserCode`', '`UserCode`', 3, 11, -1, FALSE, '`UserCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->UserCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->UserCode->IsForeignKey = TRUE; // Foreign key field
		$this->UserCode->Sortable = TRUE; // Allow sort
		$this->UserCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UserCode'] = &$this->UserCode;

		// UserName
		$this->UserName = new DbField('musers', 'musers', 'x_UserName', 'UserName', '`UserName`', '`UserName`', 200, 50, -1, FALSE, '`UserName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserName->IsPrimaryKey = TRUE; // Primary key field
		$this->UserName->Nullable = FALSE; // NOT NULL field
		$this->UserName->Required = TRUE; // Required field
		$this->UserName->Sortable = TRUE; // Allow sort
		$this->fields['UserName'] = &$this->UserName;

		// Password
		$this->Password = new DbField('musers', 'musers', 'x_Password', 'Password', '`Password`', '`Password`', 200, 50, -1, FALSE, '`Password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->Password->Nullable = FALSE; // NOT NULL field
		$this->Password->Required = TRUE; // Required field
		$this->Password->Sortable = TRUE; // Allow sort
		$this->fields['Password'] = &$this->Password;

		// ConfirmPwd
		$this->ConfirmPwd = new DbField('musers', 'musers', 'x_ConfirmPwd', 'ConfirmPwd', '`ConfirmPwd`', '`ConfirmPwd`', 200, 50, -1, FALSE, '`ConfirmPwd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->ConfirmPwd->Sortable = TRUE; // Allow sort
		$this->fields['ConfirmPwd'] = &$this->ConfirmPwd;

		// EmployeeID
		$this->EmployeeID = new DbField('musers', 'musers', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// FirstName
		$this->FirstName = new DbField('musers', 'musers', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 50, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// LastName
		$this->LastName = new DbField('musers', 'musers', 'x_LastName', 'LastName', '`LastName`', '`LastName`', 200, 50, -1, FALSE, '`LastName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastName->Nullable = FALSE; // NOT NULL field
		$this->LastName->Required = TRUE; // Required field
		$this->LastName->Sortable = TRUE; // Allow sort
		$this->fields['LastName'] = &$this->LastName;

		// ProvinceCode
		$this->ProvinceCode = new DbField('musers', 'musers', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 3, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('musers', 'musers', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], [], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// Level
		$this->Level = new DbField('musers', 'musers', 'x_Level', 'Level', '`Level`', '`Level`', 3, 11, -1, FALSE, '`Level`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Level->Nullable = FALSE; // NOT NULL field
		$this->Level->Required = TRUE; // Required field
		$this->Level->Sortable = TRUE; // Allow sort
		$this->Level->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Level->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Level->Lookup = new Lookup('Level', 'userlevels', FALSE, 'userlevelid', ["userlevelname","userlevelid","",""], [], [], [], [], [], [], '', '');
		$this->fields['Level'] = &$this->Level;

		// Role
		$this->Role = new DbField('musers', 'musers', 'x_Role', 'Role', '`Role`', '`Role`', 200, 15, -1, FALSE, '`Role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Role->Nullable = FALSE; // NOT NULL field
		$this->Role->Required = TRUE; // Required field
		$this->Role->Sortable = TRUE; // Allow sort
		$this->Role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Role->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Role->Lookup = new Lookup('Role', 'user_role', FALSE, 'Role', ["Role","RoleDescription","",""], [], [], [], [], [], [], '', '');
		$this->fields['Role'] = &$this->Role;

		// Clearance
		$this->Clearance = new DbField('musers', 'musers', 'x_Clearance', 'Clearance', '`Clearance`', '`Clearance`', 3, 11, -1, FALSE, '`Clearance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Clearance->Nullable = FALSE; // NOT NULL field
		$this->Clearance->Required = TRUE; // Required field
		$this->Clearance->Sortable = TRUE; // Allow sort
		$this->Clearance->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Clearance->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Clearance->Lookup = new Lookup('Clearance', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->Clearance->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Clearance'] = &$this->Clearance;

		// OrganisationLevel
		$this->OrganisationLevel = new DbField('musers', 'musers', 'x_OrganisationLevel', 'OrganisationLevel', '`OrganisationLevel`', '`OrganisationLevel`', 16, 3, -1, FALSE, '`OrganisationLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OrganisationLevel->Sortable = TRUE; // Allow sort
		$this->OrganisationLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OrganisationLevel'] = &$this->OrganisationLevel;

		// Active
		$this->Active = new DbField('musers', 'musers', 'x_Active', 'Active', '`Active`', '`Active`', 3, 11, -1, FALSE, '`Active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Active->Sortable = TRUE; // Allow sort
		$this->Active->Lookup = new Lookup('Active', 'yesno', FALSE, 'ChoiceCode', ["YesNo","","",""], [], [], [], [], [], [], '', '');
		$this->Active->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Active'] = &$this->Active;

		// Email
		$this->_Email = new DbField('musers', 'musers', 'x__Email', 'Email', '`Email`', '`Email`', 200, 50, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Telephone
		$this->Telephone = new DbField('musers', 'musers', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 50, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('musers', 'musers', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Position
		$this->Position = new DbField('musers', 'musers', 'x_Position', 'Position', '`Position`', '`Position`', 200, 255, -1, FALSE, '`Position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Position->Sortable = TRUE; // Allow sort
		$this->fields['Position'] = &$this->Position;

		// ReportsTo
		$this->ReportsTo = new DbField('musers', 'musers', 'x_ReportsTo', 'ReportsTo', '`ReportsTo`', '`ReportsTo`', 3, 11, -1, FALSE, '`ReportsTo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReportsTo->Sortable = TRUE; // Allow sort
		$this->ReportsTo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ReportsTo'] = &$this->ReportsTo;

		// Profile
		$this->Profile = new DbField('musers', 'musers', 'x_Profile', 'Profile', '`Profile`', '`Profile`', 201, 16777215, -1, FALSE, '`Profile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Profile->Sortable = TRUE; // Allow sort
		$this->fields['Profile'] = &$this->Profile;
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
		if ($this->getCurrentDetailTable() == "security_matrix") {
			$detailUrl = $GLOBALS["security_matrix"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_UserCode=" . urlencode($this->UserCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "muserslist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`musers`";
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
			$this->UserCode->setDbValue($conn->insert_ID());
			$rs['UserCode'] = $this->UserCode->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
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

		// Cascade Update detail table 'security_matrix'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['UserCode']) && $rsold['UserCode'] != $rs['UserCode'])) { // Update detail field 'UserCode'
			$cascadeUpdate = TRUE;
			$rscascade['UserCode'] = $rs['UserCode'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["security_matrix"]))
				$GLOBALS["security_matrix"] = new security_matrix();
			$rswrk = $GLOBALS["security_matrix"]->loadRs("`UserCode` = " . QuotedValue($rsold['UserCode'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'SecurityNumber';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["security_matrix"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["security_matrix"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["security_matrix"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'UserName';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('UserName', $rs))
				AddFilter($where, QuotedName('UserName', $this->Dbid) . '=' . QuotedValue($rs['UserName'], $this->UserName->DataType, $this->Dbid));
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

		// Cascade delete detail table 'security_matrix'
		if (!isset($GLOBALS["security_matrix"]))
			$GLOBALS["security_matrix"] = new security_matrix();
		$rscascade = $GLOBALS["security_matrix"]->loadRs("`UserCode` = " . QuotedValue($rs['UserCode'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["security_matrix"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["security_matrix"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["security_matrix"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->UserCode->DbValue = $row['UserCode'];
		$this->UserName->DbValue = $row['UserName'];
		$this->Password->DbValue = $row['Password'];
		$this->ConfirmPwd->DbValue = $row['ConfirmPwd'];
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->LastName->DbValue = $row['LastName'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->Level->DbValue = $row['Level'];
		$this->Role->DbValue = $row['Role'];
		$this->Clearance->DbValue = $row['Clearance'];
		$this->OrganisationLevel->DbValue = $row['OrganisationLevel'];
		$this->Active->DbValue = $row['Active'];
		$this->_Email->DbValue = $row['Email'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->Position->DbValue = $row['Position'];
		$this->ReportsTo->DbValue = $row['ReportsTo'];
		$this->Profile->DbValue = $row['Profile'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`UserName` = '@UserName@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('UserName', $row) ? $row['UserName'] : NULL;
		else
			$val = $this->UserName->OldValue !== NULL ? $this->UserName->OldValue : $this->UserName->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@UserName@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "muserslist.php";
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
		if ($pageName == "musersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "musersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "musersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "muserslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("musersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("musersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "musersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "musersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("musersedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("musersedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("musersadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("musersadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("musersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "UserName:" . JsonEncode($this->UserName->CurrentValue, "string");
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
		if ($this->UserName->CurrentValue != NULL) {
			$url .= "UserName=" . urlencode($this->UserName->CurrentValue);
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
			if (Param("UserName") !== NULL)
				$arKeys[] = Param("UserName");
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
				$this->UserName->CurrentValue = $key;
			else
				$this->UserName->OldValue = $key;
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
		$this->UserCode->setDbValue($rs->fields('UserCode'));
		$this->UserName->setDbValue($rs->fields('UserName'));
		$this->Password->setDbValue($rs->fields('Password'));
		$this->ConfirmPwd->setDbValue($rs->fields('ConfirmPwd'));
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->LastName->setDbValue($rs->fields('LastName'));
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->Level->setDbValue($rs->fields('Level'));
		$this->Role->setDbValue($rs->fields('Role'));
		$this->Clearance->setDbValue($rs->fields('Clearance'));
		$this->OrganisationLevel->setDbValue($rs->fields('OrganisationLevel'));
		$this->Active->setDbValue($rs->fields('Active'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->Position->setDbValue($rs->fields('Position'));
		$this->ReportsTo->setDbValue($rs->fields('ReportsTo'));
		$this->Profile->setDbValue($rs->fields('Profile'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// UserCode
		// UserName
		// Password
		// ConfirmPwd
		// EmployeeID
		// FirstName
		// LastName
		// ProvinceCode
		// LACode
		// Level
		// Role
		// Clearance
		// OrganisationLevel
		// Active
		// Email
		// Telephone
		// Mobile
		// Position
		// ReportsTo
		// Profile
		// UserCode

		$this->UserCode->ViewValue = $this->UserCode->CurrentValue;
		$this->UserCode->ViewCustomAttributes = "";

		// UserName
		$this->UserName->ViewValue = $this->UserName->CurrentValue;
		$this->UserName->ViewCustomAttributes = "";

		// Password
		$this->Password->ViewValue = $Language->phrase("PasswordMask");
		$this->Password->ViewCustomAttributes = "";

		// ConfirmPwd
		$this->ConfirmPwd->ViewValue = $Language->phrase("PasswordMask");
		$this->ConfirmPwd->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// LastName
		$this->LastName->ViewValue = $this->LastName->CurrentValue;
		$this->LastName->ViewCustomAttributes = "";

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

		// Level
		$curVal = strval($this->Level->CurrentValue);
		if ($curVal != "") {
			$this->Level->ViewValue = $this->Level->lookupCacheOption($curVal);
			if ($this->Level->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Level->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Level->ViewValue = $this->Level->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Level->ViewValue = $this->Level->CurrentValue;
				}
			}
		} else {
			$this->Level->ViewValue = NULL;
		}
		$this->Level->ViewCustomAttributes = "";

		// Role
		$curVal = strval($this->Role->CurrentValue);
		if ($curVal != "") {
			$this->Role->ViewValue = $this->Role->lookupCacheOption($curVal);
			if ($this->Role->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Role`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Role->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Role->ViewValue = $this->Role->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Role->ViewValue = $this->Role->CurrentValue;
				}
			}
		} else {
			$this->Role->ViewValue = NULL;
		}
		$this->Role->ViewCustomAttributes = "";

		// Clearance
		if ($Security->canAdmin()) { // System admin
			$curVal = strval($this->Clearance->CurrentValue);
			if ($curVal != "") {
				$this->Clearance->ViewValue = $this->Clearance->lookupCacheOption($curVal);
				if ($this->Clearance->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Clearance->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Clearance->ViewValue = $this->Clearance->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Clearance->ViewValue = $this->Clearance->CurrentValue;
					}
				}
			} else {
				$this->Clearance->ViewValue = NULL;
			}
		} else {
			$this->Clearance->ViewValue = $Language->phrase("PasswordMask");
		}
		$this->Clearance->ViewCustomAttributes = "";

		// OrganisationLevel
		$this->OrganisationLevel->ViewValue = $this->OrganisationLevel->CurrentValue;
		$this->OrganisationLevel->ViewCustomAttributes = "";

		// Active
		$curVal = strval($this->Active->CurrentValue);
		if ($curVal != "") {
			$this->Active->ViewValue = $this->Active->lookupCacheOption($curVal);
			if ($this->Active->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Active->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Active->ViewValue = $this->Active->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Active->ViewValue = $this->Active->CurrentValue;
				}
			}
		} else {
			$this->Active->ViewValue = NULL;
		}
		$this->Active->ViewCustomAttributes = "";

		// Email
		$this->_Email->ViewValue = $this->_Email->CurrentValue;
		$this->_Email->ViewCustomAttributes = "";

		// Telephone
		$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
		$this->Telephone->ViewCustomAttributes = "";

		// Mobile
		$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
		$this->Mobile->ViewCustomAttributes = "";

		// Position
		$this->Position->ViewValue = $this->Position->CurrentValue;
		$this->Position->ViewCustomAttributes = "";

		// ReportsTo
		$this->ReportsTo->ViewValue = $this->ReportsTo->CurrentValue;
		$this->ReportsTo->ViewCustomAttributes = "";

		// Profile
		$this->Profile->ViewValue = $this->Profile->CurrentValue;
		$this->Profile->ViewCustomAttributes = "";

		// UserCode
		$this->UserCode->LinkCustomAttributes = "";
		$this->UserCode->HrefValue = "";
		$this->UserCode->TooltipValue = "";

		// UserName
		$this->UserName->LinkCustomAttributes = "";
		$this->UserName->HrefValue = "";
		$this->UserName->TooltipValue = "";

		// Password
		$this->Password->LinkCustomAttributes = "";
		$this->Password->HrefValue = "";
		$this->Password->TooltipValue = "";

		// ConfirmPwd
		$this->ConfirmPwd->LinkCustomAttributes = "";
		$this->ConfirmPwd->HrefValue = "";
		$this->ConfirmPwd->TooltipValue = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// LastName
		$this->LastName->LinkCustomAttributes = "";
		$this->LastName->HrefValue = "";
		$this->LastName->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// Level
		$this->Level->LinkCustomAttributes = "";
		$this->Level->HrefValue = "";
		$this->Level->TooltipValue = "";

		// Role
		$this->Role->LinkCustomAttributes = "";
		$this->Role->HrefValue = "";
		$this->Role->TooltipValue = "";

		// Clearance
		$this->Clearance->LinkCustomAttributes = "";
		$this->Clearance->HrefValue = "";
		$this->Clearance->TooltipValue = "";

		// OrganisationLevel
		$this->OrganisationLevel->LinkCustomAttributes = "";
		$this->OrganisationLevel->HrefValue = "";
		$this->OrganisationLevel->TooltipValue = "";

		// Active
		$this->Active->LinkCustomAttributes = "";
		$this->Active->HrefValue = "";
		$this->Active->TooltipValue = "";

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

		// Position
		$this->Position->LinkCustomAttributes = "";
		$this->Position->HrefValue = "";
		$this->Position->TooltipValue = "";

		// ReportsTo
		$this->ReportsTo->LinkCustomAttributes = "";
		$this->ReportsTo->HrefValue = "";
		$this->ReportsTo->TooltipValue = "";

		// Profile
		$this->Profile->LinkCustomAttributes = "";
		$this->Profile->HrefValue = "";
		$this->Profile->TooltipValue = "";

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

		// UserCode
		$this->UserCode->EditAttrs["class"] = "form-control";
		$this->UserCode->EditCustomAttributes = "";
		$this->UserCode->EditValue = $this->UserCode->CurrentValue;
		$this->UserCode->PlaceHolder = RemoveHtml($this->UserCode->caption());

		// UserName
		$this->UserName->EditAttrs["class"] = "form-control";
		$this->UserName->EditCustomAttributes = "";
		if (!$this->UserName->Raw)
			$this->UserName->CurrentValue = HtmlDecode($this->UserName->CurrentValue);
		$this->UserName->EditValue = $this->UserName->CurrentValue;
		$this->UserName->PlaceHolder = RemoveHtml($this->UserName->caption());

		// Password
		$this->Password->EditAttrs["class"] = "form-control ew-password-strength";
		$this->Password->EditCustomAttributes = "";
		$this->Password->EditValue = $this->Password->CurrentValue;
		$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

		// ConfirmPwd
		$this->ConfirmPwd->EditAttrs["class"] = "form-control";
		$this->ConfirmPwd->EditCustomAttributes = "";
		$this->ConfirmPwd->EditValue = $this->ConfirmPwd->CurrentValue;
		$this->ConfirmPwd->PlaceHolder = RemoveHtml($this->ConfirmPwd->caption());

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

		// LastName
		$this->LastName->EditAttrs["class"] = "form-control";
		$this->LastName->EditCustomAttributes = "";
		if (!$this->LastName->Raw)
			$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
		$this->LastName->EditValue = $this->LastName->CurrentValue;
		$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";

		// Level
		$this->Level->EditAttrs["class"] = "form-control";
		$this->Level->EditCustomAttributes = "";

		// Role
		$this->Role->EditAttrs["class"] = "form-control";
		$this->Role->EditCustomAttributes = "";

		// Clearance
		$this->Clearance->EditAttrs["class"] = "form-control";
		$this->Clearance->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->Clearance->EditValue = $Language->phrase("PasswordMask");
		} else {
		}

		// OrganisationLevel
		$this->OrganisationLevel->EditAttrs["class"] = "form-control";
		$this->OrganisationLevel->EditCustomAttributes = "";
		$this->OrganisationLevel->EditValue = $this->OrganisationLevel->CurrentValue;
		$this->OrganisationLevel->PlaceHolder = RemoveHtml($this->OrganisationLevel->caption());

		// Active
		$this->Active->EditCustomAttributes = "";

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

		// Position
		$this->Position->EditAttrs["class"] = "form-control";
		$this->Position->EditCustomAttributes = "";
		if (!$this->Position->Raw)
			$this->Position->CurrentValue = HtmlDecode($this->Position->CurrentValue);
		$this->Position->EditValue = $this->Position->CurrentValue;
		$this->Position->PlaceHolder = RemoveHtml($this->Position->caption());

		// ReportsTo
		$this->ReportsTo->EditAttrs["class"] = "form-control";
		$this->ReportsTo->EditCustomAttributes = "";
		$this->ReportsTo->EditValue = $this->ReportsTo->CurrentValue;
		$this->ReportsTo->PlaceHolder = RemoveHtml($this->ReportsTo->caption());

		// Profile
		$this->Profile->EditAttrs["class"] = "form-control";
		$this->Profile->EditCustomAttributes = "";
		$this->Profile->EditValue = $this->Profile->CurrentValue;
		$this->Profile->PlaceHolder = RemoveHtml($this->Profile->caption());

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
					$doc->exportCaption($this->UserCode);
					$doc->exportCaption($this->UserName);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->Level);
					$doc->exportCaption($this->Role);
					$doc->exportCaption($this->Clearance);
					$doc->exportCaption($this->OrganisationLevel);
					$doc->exportCaption($this->Active);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Position);
					$doc->exportCaption($this->ReportsTo);
					$doc->exportCaption($this->Profile);
				} else {
					$doc->exportCaption($this->UserCode);
					$doc->exportCaption($this->UserName);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->Level);
					$doc->exportCaption($this->Role);
					$doc->exportCaption($this->Clearance);
					$doc->exportCaption($this->OrganisationLevel);
					$doc->exportCaption($this->Active);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Position);
					$doc->exportCaption($this->ReportsTo);
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
						$doc->exportField($this->UserCode);
						$doc->exportField($this->UserName);
						$doc->exportField($this->Password);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->LastName);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->Level);
						$doc->exportField($this->Role);
						$doc->exportField($this->Clearance);
						$doc->exportField($this->OrganisationLevel);
						$doc->exportField($this->Active);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Position);
						$doc->exportField($this->ReportsTo);
						$doc->exportField($this->Profile);
					} else {
						$doc->exportField($this->UserCode);
						$doc->exportField($this->UserName);
						$doc->exportField($this->Password);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->LastName);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->Level);
						$doc->exportField($this->Role);
						$doc->exportField($this->Clearance);
						$doc->exportField($this->OrganisationLevel);
						$doc->exportField($this->Active);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Position);
						$doc->exportField($this->ReportsTo);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'musers';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'musers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['UserName'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME"))
					$newvalue = $Language->phrase("PasswordMask");
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'musers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['UserName'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'musers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['UserName'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME"))
					$oldvalue = $Language->phrase("PasswordMask");
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$userid = CurrentUserID();
		if ($levelid <> -1) {
			$row = executeRow("select * from musers where username = '" . $username . "'");
			$prv = $row["ProvinceCode"];
			$la = $row["LACode"];
			}    
		$prov = executeRow("select count(security_matrix.ProvinceCode) as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if($levelid >= 0)  {
		AddFilter($filter,"`LACode`  =  '" . $la . "'");
		} 
		if(($levelid >= 0) ) {
		AddFilter($filter,"`UserCode`  in   (select UserCode
		from  musers  where  musers.level >= 0 and musers.level <> 100 )  ");
		} 
		if(($levelid >= 0) && ($prov["kountprov"] > 0)) {
		AddFilter($filter,"`UserCode`  in   (SELECT musers.UserCode 	FROM  musers
		WHERE ProvinceCode IN 
		(SELECT ProvinceCode FROM musers WHERE musers.username = '" . $username .  	"'))  ");
		}

		// only work on users in your province
		elseif ($levelid >= 0)  {AddFilter($filter,"`ProvinceCode`  
		in   (SELECT DISTINCT musers.`ProvinceCode`
		FROM   musers                            
		WHERE  musers.username = '" . $username .  
		"')  "); 
		}  
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

		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$row = executeRow("select * from musers where username = '" . $username . "'");
		$la = $row["LACode"];
		$lawrk = $rsnew["LACode"];
		$pv = $row["ProvinceCode"];
		$pvwrk = $rsnew["ProvinceCode"];
		if(($pv <> $pvwrk) && ($levelid > 0)) {
			$this->CancelMessage =  "You should only work in your province." ;
			 return FALSE;
		 }
		if(($la <> $lawrk) && ($levelid > 0)) {
			$this->CancelMessage =  "You should only work in your Local Authority." ;
			 return FALSE;
		 }
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

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$row = executeRow("select * from musers where username = '" . $username . "'");
		$la = $row["LACode"];
		$pv = $row["ProvinceCode"];
		if ($fld->Name == "Level" && CurrentUserLevel() == 100)
			 AddFilter($filter, "userlevelid not in ('100', '-1', '-2')");
		if ($fld->Name == "EmployeeID" && CurrentUserLevel() == 100)
			 AddFilter($filter, "ProvinceCode = '" . $pv . "'");
		if ($fld->Name == "EmployeeID" && CurrentUserLevel() == 100 && !empty($la))
			 AddFilter($filter, "LACode = '" . $la . "'");
		if ($fld->Name == "ProvinceCode" && CurrentUserLevel() == 100)
			 AddFilter($filter, "ProvinceCode = '" . $pv . "'");
		if ($fld->Name == "LACode" && CurrentUserLevel() == 100)
			 AddFilter($filter, "LACode = '" . $la . "'");
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