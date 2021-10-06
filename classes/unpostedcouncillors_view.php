<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for unpostedcouncillors_view
 */
class unpostedcouncillors_view extends DbTable
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
	public $LACode;
	public $NRC;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $Sex;
	public $MaritalStatus;
	public $DateOfBirth;
	public $Telephone;
	public $Mobile;
	public $_Email;
	public $CouncilServed;
	public $PoliticalParty;
	public $Occupation;
	public $PositionInCouncil;
	public $Committee;
	public $CommitteeRole;
	public $CouncilTerm;
	public $DateOfExit;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'unpostedcouncillors_view';
		$this->TableName = 'unpostedcouncillors_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`unpostedcouncillors_view`";
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
		$this->EmployeeID = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->EmployeeID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// LACode
		$this->LACode = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","LACode","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// NRC
		$this->NRC = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->fields['NRC'] = &$this->NRC;

		// Title
		$this->Title = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Sex
		$this->Sex = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->fields['Sex'] = &$this->Sex;

		// MaritalStatus
		$this->MaritalStatus = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_MaritalStatus', 'MaritalStatus', '`MaritalStatus`', '`MaritalStatus`', 16, 3, -1, FALSE, '`MaritalStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MaritalStatus->Nullable = FALSE; // NOT NULL field
		$this->MaritalStatus->Required = TRUE; // Required field
		$this->MaritalStatus->Sortable = TRUE; // Allow sort
		$this->MaritalStatus->Lookup = new Lookup('MaritalStatus', 'marital_status', FALSE, 'MaritalStatusCode', ["MaritalStatus","","",""], [], [], [], [], [], [], '', '');
		$this->MaritalStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MaritalStatus'] = &$this->MaritalStatus;

		// DateOfBirth
		$this->DateOfBirth = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Nullable = FALSE; // NOT NULL field
		$this->DateOfBirth->Required = TRUE; // Required field
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// Telephone
		$this->Telephone = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 255, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Email
		$this->_Email = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x__Email', 'Email', '`Email`', '`Email`', 200, 255, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// CouncilServed
		$this->CouncilServed = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_CouncilServed', 'CouncilServed', '`CouncilServed`', '`CouncilServed`', 200, 10, -1, FALSE, '`CouncilServed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CouncilServed->Sortable = TRUE; // Allow sort
		$this->CouncilServed->Lookup = new Lookup('CouncilServed', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['CouncilServed'] = &$this->CouncilServed;

		// PoliticalParty
		$this->PoliticalParty = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_PoliticalParty', 'PoliticalParty', '`PoliticalParty`', '`PoliticalParty`', 200, 15, -1, FALSE, '`PoliticalParty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PoliticalParty->Sortable = TRUE; // Allow sort
		$this->fields['PoliticalParty'] = &$this->PoliticalParty;

		// Occupation
		$this->Occupation = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Occupation', 'Occupation', '`Occupation`', '`Occupation`', 16, 3, -1, FALSE, '`Occupation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Occupation->Sortable = TRUE; // Allow sort
		$this->Occupation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Occupation'] = &$this->Occupation;

		// PositionInCouncil
		$this->PositionInCouncil = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_PositionInCouncil', 'PositionInCouncil', '`PositionInCouncil`', '`PositionInCouncil`', 3, 11, -1, FALSE, '`PositionInCouncil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PositionInCouncil->Sortable = TRUE; // Allow sort
		$this->PositionInCouncil->Lookup = new Lookup('PositionInCouncil', 'position_councillor', FALSE, 'PositionCode', ["PositionName","","",""], [], [], [], [], [], [], '', '');
		$this->PositionInCouncil->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PositionInCouncil'] = &$this->PositionInCouncil;

		// Committee
		$this->Committee = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_Committee', 'Committee', '`Committee`', '`Committee`', 16, 3, -1, FALSE, '`Committee`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Committee->Sortable = TRUE; // Allow sort
		$this->Committee->Lookup = new Lookup('Committee', 'committee', FALSE, 'CommitteCode', ["CommitteeName","","",""], [], [], [], [], [], [], '', '');
		$this->Committee->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Committee'] = &$this->Committee;

		// CommitteeRole
		$this->CommitteeRole = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_CommitteeRole', 'CommitteeRole', '`CommitteeRole`', '`CommitteeRole`', 3, 11, -1, FALSE, '`CommitteeRole`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CommitteeRole->Sortable = TRUE; // Allow sort
		$this->CommitteeRole->Lookup = new Lookup('CommitteeRole', 'committee_role', FALSE, 'CommitteeRole', ["CommitteeRoleDesc","","",""], [], [], [], [], [], [], '', '');
		$this->CommitteeRole->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CommitteeRole'] = &$this->CommitteeRole;

		// CouncilTerm
		$this->CouncilTerm = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_CouncilTerm', 'CouncilTerm', '`CouncilTerm`', '`CouncilTerm`', 18, 4, -1, FALSE, '`CouncilTerm`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CouncilTerm->Sortable = TRUE; // Allow sort
		$this->CouncilTerm->Lookup = new Lookup('CouncilTerm', 'termcouncil_term', FALSE, 'TermStartYear', ["TermStartYear","TermYears","",""], [], [], [], [], [], [], '', '');
		$this->CouncilTerm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CouncilTerm'] = &$this->CouncilTerm;

		// DateOfExit
		$this->DateOfExit = new DbField('unpostedcouncillors_view', 'unpostedcouncillors_view', 'x_DateOfExit', 'DateOfExit', '`DateOfExit`', CastDateFieldForLike("`DateOfExit`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfExit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfExit->Sortable = TRUE; // Allow sort
		$this->DateOfExit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfExit'] = &$this->DateOfExit;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`unpostedcouncillors_view`";
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
		$this->TableFilter = "`CouncilServed` is null";
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
			$this->EmployeeID->setDbValue($conn->insert_ID());
			$rs['EmployeeID'] = $this->EmployeeID->DbValue;
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
			if (array_key_exists('EmployeeID', $rs))
				AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
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
		$this->LACode->DbValue = $row['LACode'];
		$this->NRC->DbValue = $row['NRC'];
		$this->Title->DbValue = $row['Title'];
		$this->Surname->DbValue = $row['Surname'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->Sex->DbValue = $row['Sex'];
		$this->MaritalStatus->DbValue = $row['MaritalStatus'];
		$this->DateOfBirth->DbValue = $row['DateOfBirth'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->_Email->DbValue = $row['Email'];
		$this->CouncilServed->DbValue = $row['CouncilServed'];
		$this->PoliticalParty->DbValue = $row['PoliticalParty'];
		$this->Occupation->DbValue = $row['Occupation'];
		$this->PositionInCouncil->DbValue = $row['PositionInCouncil'];
		$this->Committee->DbValue = $row['Committee'];
		$this->CommitteeRole->DbValue = $row['CommitteeRole'];
		$this->CouncilTerm->DbValue = $row['CouncilTerm'];
		$this->DateOfExit->DbValue = $row['DateOfExit'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('EmployeeID', $row) ? $row['EmployeeID'] : NULL;
		else
			$val = $this->EmployeeID->OldValue !== NULL ? $this->EmployeeID->OldValue : $this->EmployeeID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@EmployeeID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "unpostedcouncillors_viewlist.php";
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
		if ($pageName == "unpostedcouncillors_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "unpostedcouncillors_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "unpostedcouncillors_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "unpostedcouncillors_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("unpostedcouncillors_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("unpostedcouncillors_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "unpostedcouncillors_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "unpostedcouncillors_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("unpostedcouncillors_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("unpostedcouncillors_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("unpostedcouncillors_viewdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
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
		if ($this->EmployeeID->CurrentValue != NULL) {
			$url .= "EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
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
			if (Param("EmployeeID") !== NULL)
				$arKeys[] = Param("EmployeeID");
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
				$this->EmployeeID->CurrentValue = $key;
			else
				$this->EmployeeID->OldValue = $key;
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
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->NRC->setDbValue($rs->fields('NRC'));
		$this->Title->setDbValue($rs->fields('Title'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->MaritalStatus->setDbValue($rs->fields('MaritalStatus'));
		$this->DateOfBirth->setDbValue($rs->fields('DateOfBirth'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->CouncilServed->setDbValue($rs->fields('CouncilServed'));
		$this->PoliticalParty->setDbValue($rs->fields('PoliticalParty'));
		$this->Occupation->setDbValue($rs->fields('Occupation'));
		$this->PositionInCouncil->setDbValue($rs->fields('PositionInCouncil'));
		$this->Committee->setDbValue($rs->fields('Committee'));
		$this->CommitteeRole->setDbValue($rs->fields('CommitteeRole'));
		$this->CouncilTerm->setDbValue($rs->fields('CouncilTerm'));
		$this->DateOfExit->setDbValue($rs->fields('DateOfExit'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// LACode
		// NRC
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// MaritalStatus
		// DateOfBirth
		// Telephone
		// Mobile
		// Email
		// CouncilServed
		// PoliticalParty
		// Occupation
		// PositionInCouncil
		// Committee
		// CommitteeRole
		// CouncilTerm
		// DateOfExit
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// LACode
		$this->LACode->ViewValue = $this->LACode->CurrentValue;
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// NRC
		$this->NRC->ViewValue = $this->NRC->CurrentValue;
		$this->NRC->ViewCustomAttributes = "";

		// Title
		$this->Title->ViewValue = $this->Title->CurrentValue;
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
		$this->Sex->ViewValue = $this->Sex->CurrentValue;
		$this->Sex->ViewCustomAttributes = "";

		// MaritalStatus
		$this->MaritalStatus->ViewValue = $this->MaritalStatus->CurrentValue;
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

		// Telephone
		$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
		$this->Telephone->ViewCustomAttributes = "";

		// Mobile
		$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
		$this->Mobile->ViewCustomAttributes = "";

		// Email
		$this->_Email->ViewValue = $this->_Email->CurrentValue;
		$this->_Email->ViewCustomAttributes = "";

		// CouncilServed
		$this->CouncilServed->ViewValue = $this->CouncilServed->CurrentValue;
		$curVal = strval($this->CouncilServed->CurrentValue);
		if ($curVal != "") {
			$this->CouncilServed->ViewValue = $this->CouncilServed->lookupCacheOption($curVal);
			if ($this->CouncilServed->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->CouncilServed->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CouncilServed->ViewValue = $this->CouncilServed->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncilServed->ViewValue = $this->CouncilServed->CurrentValue;
				}
			}
		} else {
			$this->CouncilServed->ViewValue = NULL;
		}
		$this->CouncilServed->ViewCustomAttributes = "";

		// PoliticalParty
		$this->PoliticalParty->ViewValue = $this->PoliticalParty->CurrentValue;
		$this->PoliticalParty->ViewCustomAttributes = "";

		// Occupation
		$this->Occupation->ViewValue = $this->Occupation->CurrentValue;
		$this->Occupation->ViewCustomAttributes = "";

		// PositionInCouncil
		$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
		$curVal = strval($this->PositionInCouncil->CurrentValue);
		if ($curVal != "") {
			$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
			if ($this->PositionInCouncil->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->PositionInCouncil->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
				}
			}
		} else {
			$this->PositionInCouncil->ViewValue = NULL;
		}
		$this->PositionInCouncil->ViewCustomAttributes = "";

		// Committee
		$this->Committee->ViewValue = $this->Committee->CurrentValue;
		$curVal = strval($this->Committee->CurrentValue);
		if ($curVal != "") {
			$this->Committee->ViewValue = $this->Committee->lookupCacheOption($curVal);
			if ($this->Committee->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CommitteCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Committee->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Committee->ViewValue = $this->Committee->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Committee->ViewValue = $this->Committee->CurrentValue;
				}
			}
		} else {
			$this->Committee->ViewValue = NULL;
		}
		$this->Committee->ViewCustomAttributes = "";

		// CommitteeRole
		$this->CommitteeRole->ViewValue = $this->CommitteeRole->CurrentValue;
		$curVal = strval($this->CommitteeRole->CurrentValue);
		if ($curVal != "") {
			$this->CommitteeRole->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
			if ($this->CommitteeRole->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`CommitteeRole`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CommitteeRole->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CommitteeRole->ViewValue = $this->CommitteeRole->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CommitteeRole->ViewValue = $this->CommitteeRole->CurrentValue;
				}
			}
		} else {
			$this->CommitteeRole->ViewValue = NULL;
		}
		$this->CommitteeRole->ViewCustomAttributes = "";

		// CouncilTerm
		$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
		$curVal = strval($this->CouncilTerm->CurrentValue);
		if ($curVal != "") {
			$this->CouncilTerm->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
			if ($this->CouncilTerm->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`TermStartYear`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->CouncilTerm->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), Config("DEFAULT_DECIMAL_PRECISION"));
					$this->CouncilTerm->ViewValue = $this->CouncilTerm->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
				}
			}
		} else {
			$this->CouncilTerm->ViewValue = NULL;
		}
		$this->CouncilTerm->ViewCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
		$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
		$this->DateOfExit->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// NRC
		$this->NRC->LinkCustomAttributes = "";
		$this->NRC->HrefValue = "";
		$this->NRC->TooltipValue = "";

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

		// Telephone
		$this->Telephone->LinkCustomAttributes = "";
		$this->Telephone->HrefValue = "";
		$this->Telephone->TooltipValue = "";

		// Mobile
		$this->Mobile->LinkCustomAttributes = "";
		$this->Mobile->HrefValue = "";
		$this->Mobile->TooltipValue = "";

		// Email
		$this->_Email->LinkCustomAttributes = "";
		$this->_Email->HrefValue = "";
		$this->_Email->TooltipValue = "";

		// CouncilServed
		$this->CouncilServed->LinkCustomAttributes = "";
		$this->CouncilServed->HrefValue = "";
		$this->CouncilServed->TooltipValue = "";

		// PoliticalParty
		$this->PoliticalParty->LinkCustomAttributes = "";
		$this->PoliticalParty->HrefValue = "";
		$this->PoliticalParty->TooltipValue = "";

		// Occupation
		$this->Occupation->LinkCustomAttributes = "";
		$this->Occupation->HrefValue = "";
		$this->Occupation->TooltipValue = "";

		// PositionInCouncil
		$this->PositionInCouncil->LinkCustomAttributes = "";
		$this->PositionInCouncil->HrefValue = "";
		$this->PositionInCouncil->TooltipValue = "";

		// Committee
		$this->Committee->LinkCustomAttributes = "";
		$this->Committee->HrefValue = "";
		$this->Committee->TooltipValue = "";

		// CommitteeRole
		$this->CommitteeRole->LinkCustomAttributes = "";
		$this->CommitteeRole->HrefValue = "";
		$this->CommitteeRole->TooltipValue = "";

		// CouncilTerm
		$this->CouncilTerm->LinkCustomAttributes = "";
		$this->CouncilTerm->HrefValue = "";
		$this->CouncilTerm->TooltipValue = "";

		// DateOfExit
		$this->DateOfExit->LinkCustomAttributes = "";
		$this->DateOfExit->HrefValue = "";
		$this->DateOfExit->TooltipValue = "";

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
		$this->EmployeeID->ViewCustomAttributes = "";

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if (!$this->LACode->Raw)
			$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
		$this->LACode->EditValue = $this->LACode->CurrentValue;
		$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

		// NRC
		$this->NRC->EditAttrs["class"] = "form-control";
		$this->NRC->EditCustomAttributes = "";
		if (!$this->NRC->Raw)
			$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
		$this->NRC->EditValue = $this->NRC->CurrentValue;
		$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

		// Title
		$this->Title->EditAttrs["class"] = "form-control";
		$this->Title->EditCustomAttributes = "";
		if (!$this->Title->Raw)
			$this->Title->CurrentValue = HtmlDecode($this->Title->CurrentValue);
		$this->Title->EditValue = $this->Title->CurrentValue;
		$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

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
		if (!$this->Sex->Raw)
			$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
		$this->Sex->EditValue = $this->Sex->CurrentValue;
		$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

		// MaritalStatus
		$this->MaritalStatus->EditAttrs["class"] = "form-control";
		$this->MaritalStatus->EditCustomAttributes = "";
		$this->MaritalStatus->EditValue = $this->MaritalStatus->CurrentValue;
		$this->MaritalStatus->PlaceHolder = RemoveHtml($this->MaritalStatus->caption());

		// DateOfBirth
		$this->DateOfBirth->EditAttrs["class"] = "form-control";
		$this->DateOfBirth->EditCustomAttributes = "";
		$this->DateOfBirth->EditValue = FormatDateTime($this->DateOfBirth->CurrentValue, 8);
		$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

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

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

		// CouncilServed
		$this->CouncilServed->EditAttrs["class"] = "form-control";
		$this->CouncilServed->EditCustomAttributes = "";
		if (!$this->CouncilServed->Raw)
			$this->CouncilServed->CurrentValue = HtmlDecode($this->CouncilServed->CurrentValue);
		$this->CouncilServed->EditValue = $this->CouncilServed->CurrentValue;
		$this->CouncilServed->PlaceHolder = RemoveHtml($this->CouncilServed->caption());

		// PoliticalParty
		$this->PoliticalParty->EditAttrs["class"] = "form-control";
		$this->PoliticalParty->EditCustomAttributes = "";
		if (!$this->PoliticalParty->Raw)
			$this->PoliticalParty->CurrentValue = HtmlDecode($this->PoliticalParty->CurrentValue);
		$this->PoliticalParty->EditValue = $this->PoliticalParty->CurrentValue;
		$this->PoliticalParty->PlaceHolder = RemoveHtml($this->PoliticalParty->caption());

		// Occupation
		$this->Occupation->EditAttrs["class"] = "form-control";
		$this->Occupation->EditCustomAttributes = "";
		$this->Occupation->EditValue = $this->Occupation->CurrentValue;
		$this->Occupation->PlaceHolder = RemoveHtml($this->Occupation->caption());

		// PositionInCouncil
		$this->PositionInCouncil->EditAttrs["class"] = "form-control";
		$this->PositionInCouncil->EditCustomAttributes = "";
		$this->PositionInCouncil->EditValue = $this->PositionInCouncil->CurrentValue;
		$this->PositionInCouncil->PlaceHolder = RemoveHtml($this->PositionInCouncil->caption());

		// Committee
		$this->Committee->EditAttrs["class"] = "form-control";
		$this->Committee->EditCustomAttributes = "";
		$this->Committee->EditValue = $this->Committee->CurrentValue;
		$this->Committee->PlaceHolder = RemoveHtml($this->Committee->caption());

		// CommitteeRole
		$this->CommitteeRole->EditAttrs["class"] = "form-control";
		$this->CommitteeRole->EditCustomAttributes = "";
		$this->CommitteeRole->EditValue = $this->CommitteeRole->CurrentValue;
		$this->CommitteeRole->PlaceHolder = RemoveHtml($this->CommitteeRole->caption());

		// CouncilTerm
		$this->CouncilTerm->EditAttrs["class"] = "form-control";
		$this->CouncilTerm->EditCustomAttributes = "";
		$this->CouncilTerm->EditValue = $this->CouncilTerm->CurrentValue;
		$this->CouncilTerm->PlaceHolder = RemoveHtml($this->CouncilTerm->caption());

		// DateOfExit
		$this->DateOfExit->EditAttrs["class"] = "form-control";
		$this->DateOfExit->EditCustomAttributes = "";
		$this->DateOfExit->EditValue = FormatDateTime($this->DateOfExit->CurrentValue, 8);
		$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

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
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->CouncilServed);
					$doc->exportCaption($this->PoliticalParty);
					$doc->exportCaption($this->Occupation);
					$doc->exportCaption($this->PositionInCouncil);
					$doc->exportCaption($this->Committee);
					$doc->exportCaption($this->CommitteeRole);
					$doc->exportCaption($this->CouncilTerm);
					$doc->exportCaption($this->DateOfExit);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->CouncilServed);
					$doc->exportCaption($this->PoliticalParty);
					$doc->exportCaption($this->Occupation);
					$doc->exportCaption($this->PositionInCouncil);
					$doc->exportCaption($this->Committee);
					$doc->exportCaption($this->CommitteeRole);
					$doc->exportCaption($this->CouncilTerm);
					$doc->exportCaption($this->DateOfExit);
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
						$doc->exportField($this->LACode);
						$doc->exportField($this->NRC);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Sex);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->_Email);
						$doc->exportField($this->CouncilServed);
						$doc->exportField($this->PoliticalParty);
						$doc->exportField($this->Occupation);
						$doc->exportField($this->PositionInCouncil);
						$doc->exportField($this->Committee);
						$doc->exportField($this->CommitteeRole);
						$doc->exportField($this->CouncilTerm);
						$doc->exportField($this->DateOfExit);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->LACode);
						$doc->exportField($this->NRC);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Sex);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->_Email);
						$doc->exportField($this->CouncilServed);
						$doc->exportField($this->PoliticalParty);
						$doc->exportField($this->Occupation);
						$doc->exportField($this->PositionInCouncil);
						$doc->exportField($this->Committee);
						$doc->exportField($this->CommitteeRole);
						$doc->exportField($this->CouncilTerm);
						$doc->exportField($this->DateOfExit);
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