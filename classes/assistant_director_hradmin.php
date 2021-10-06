<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for assistant_director_hradmin
 */
class assistant_director_hradmin extends DbTable
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
	public $TownOrVillage;
	public $FirstName;
	public $MiddleName;
	public $Surname;
	public $Sex;
	public $DateOfBirth;
	public $DateOfCurrentAppointment;
	public $DateOfConfirmation;
	public $AcademicQualification;
	public $ProfessionalQualification;
	public $AdditionalInformation;
	public $LengthOfStay;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'assistant_director_hradmin';
		$this->TableName = 'assistant_director_hradmin';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`assistant_director_hradmin`";
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

		// TownOrVillage
		$this->TownOrVillage = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_TownOrVillage', 'TownOrVillage', '`TownOrVillage`', '`TownOrVillage`', 200, 255, -1, FALSE, '`TownOrVillage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TownOrVillage->Sortable = TRUE; // Allow sort
		$this->fields['TownOrVillage'] = &$this->TownOrVillage;

		// FirstName
		$this->FirstName = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Surname
		$this->Surname = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// Sex
		$this->Sex = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->fields['Sex'] = &$this->Sex;

		// DateOfBirth
		$this->DateOfBirth = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Nullable = FALSE; // NOT NULL field
		$this->DateOfBirth->Required = TRUE; // Required field
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_DateOfCurrentAppointment', 'DateOfCurrentAppointment', '`DateOfCurrentAppointment`', CastDateFieldForLike("`DateOfCurrentAppointment`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfCurrentAppointment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfCurrentAppointment->Nullable = FALSE; // NOT NULL field
		$this->DateOfCurrentAppointment->Required = TRUE; // Required field
		$this->DateOfCurrentAppointment->Sortable = TRUE; // Allow sort
		$this->DateOfCurrentAppointment->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfCurrentAppointment'] = &$this->DateOfCurrentAppointment;

		// DateOfConfirmation
		$this->DateOfConfirmation = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_DateOfConfirmation', 'DateOfConfirmation', '`DateOfConfirmation`', CastDateFieldForLike("`DateOfConfirmation`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfConfirmation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfConfirmation->Sortable = TRUE; // Allow sort
		$this->DateOfConfirmation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfConfirmation'] = &$this->DateOfConfirmation;

		// AcademicQualification
		$this->AcademicQualification = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_AcademicQualification', 'AcademicQualification', '`AcademicQualification`', '`AcademicQualification`', 200, 100, -1, FALSE, '`AcademicQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AcademicQualification->Sortable = TRUE; // Allow sort
		$this->fields['AcademicQualification'] = &$this->AcademicQualification;

		// ProfessionalQualification
		$this->ProfessionalQualification = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_ProfessionalQualification', 'ProfessionalQualification', '`ProfessionalQualification`', '`ProfessionalQualification`', 200, 255, -1, FALSE, '`ProfessionalQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProfessionalQualification->Sortable = TRUE; // Allow sort
		$this->fields['ProfessionalQualification'] = &$this->ProfessionalQualification;

		// AdditionalInformation
		$this->AdditionalInformation = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_AdditionalInformation', 'AdditionalInformation', '`AdditionalInformation`', '`AdditionalInformation`', 201, 16777215, -1, FALSE, '`AdditionalInformation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->AdditionalInformation->Sortable = TRUE; // Allow sort
		$this->fields['AdditionalInformation'] = &$this->AdditionalInformation;

		// LengthOfStay
		$this->LengthOfStay = new DbField('assistant_director_hradmin', 'assistant_director_hradmin', 'x_LengthOfStay', 'LengthOfStay', '`LengthOfStay`', '`LengthOfStay`', 200, 12, -1, FALSE, '`LengthOfStay`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LengthOfStay->Sortable = TRUE; // Allow sort
		$this->fields['LengthOfStay'] = &$this->LengthOfStay;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`assistant_director_hradmin`";
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
		$this->TownOrVillage->DbValue = $row['TownOrVillage'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->Surname->DbValue = $row['Surname'];
		$this->Sex->DbValue = $row['Sex'];
		$this->DateOfBirth->DbValue = $row['DateOfBirth'];
		$this->DateOfCurrentAppointment->DbValue = $row['DateOfCurrentAppointment'];
		$this->DateOfConfirmation->DbValue = $row['DateOfConfirmation'];
		$this->AcademicQualification->DbValue = $row['AcademicQualification'];
		$this->ProfessionalQualification->DbValue = $row['ProfessionalQualification'];
		$this->AdditionalInformation->DbValue = $row['AdditionalInformation'];
		$this->LengthOfStay->DbValue = $row['LengthOfStay'];
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
			return "assistant_director_hradminlist.php";
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
		if ($pageName == "assistant_director_hradminview.php")
			return $Language->phrase("View");
		elseif ($pageName == "assistant_director_hradminedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "assistant_director_hradminadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "assistant_director_hradminlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("assistant_director_hradminview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("assistant_director_hradminview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "assistant_director_hradminadd.php?" . $this->getUrlParm($parm);
		else
			$url = "assistant_director_hradminadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("assistant_director_hradminedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("assistant_director_hradminadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("assistant_director_hradmindelete.php", $this->getUrlParm());
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
		$this->TownOrVillage->setDbValue($rs->fields('TownOrVillage'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->DateOfBirth->setDbValue($rs->fields('DateOfBirth'));
		$this->DateOfCurrentAppointment->setDbValue($rs->fields('DateOfCurrentAppointment'));
		$this->DateOfConfirmation->setDbValue($rs->fields('DateOfConfirmation'));
		$this->AcademicQualification->setDbValue($rs->fields('AcademicQualification'));
		$this->ProfessionalQualification->setDbValue($rs->fields('ProfessionalQualification'));
		$this->AdditionalInformation->setDbValue($rs->fields('AdditionalInformation'));
		$this->LengthOfStay->setDbValue($rs->fields('LengthOfStay'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// TownOrVillage
		// FirstName
		// MiddleName
		// Surname
		// Sex
		// DateOfBirth
		// DateOfCurrentAppointment
		// DateOfConfirmation
		// AcademicQualification
		// ProfessionalQualification
		// AdditionalInformation
		// LengthOfStay
		// TownOrVillage

		$this->TownOrVillage->ViewValue = $this->TownOrVillage->CurrentValue;
		$this->TownOrVillage->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->ViewCustomAttributes = "";

		// Surname
		$this->Surname->ViewValue = $this->Surname->CurrentValue;
		$this->Surname->ViewCustomAttributes = "";

		// Sex
		$this->Sex->ViewValue = $this->Sex->CurrentValue;
		$this->Sex->ViewCustomAttributes = "";

		// DateOfBirth
		$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
		$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
		$this->DateOfBirth->ViewCustomAttributes = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
		$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
		$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

		// DateOfConfirmation
		$this->DateOfConfirmation->ViewValue = $this->DateOfConfirmation->CurrentValue;
		$this->DateOfConfirmation->ViewValue = FormatDateTime($this->DateOfConfirmation->ViewValue, 0);
		$this->DateOfConfirmation->ViewCustomAttributes = "";

		// AcademicQualification
		$this->AcademicQualification->ViewValue = $this->AcademicQualification->CurrentValue;
		$this->AcademicQualification->ViewCustomAttributes = "";

		// ProfessionalQualification
		$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->CurrentValue;
		$this->ProfessionalQualification->ViewCustomAttributes = "";

		// AdditionalInformation
		$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->ViewCustomAttributes = "";

		// LengthOfStay
		$this->LengthOfStay->ViewValue = $this->LengthOfStay->CurrentValue;
		$this->LengthOfStay->ViewCustomAttributes = "";

		// TownOrVillage
		$this->TownOrVillage->LinkCustomAttributes = "";
		$this->TownOrVillage->HrefValue = "";
		$this->TownOrVillage->TooltipValue = "";

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

		// Sex
		$this->Sex->LinkCustomAttributes = "";
		$this->Sex->HrefValue = "";
		$this->Sex->TooltipValue = "";

		// DateOfBirth
		$this->DateOfBirth->LinkCustomAttributes = "";
		$this->DateOfBirth->HrefValue = "";
		$this->DateOfBirth->TooltipValue = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
		$this->DateOfCurrentAppointment->HrefValue = "";
		$this->DateOfCurrentAppointment->TooltipValue = "";

		// DateOfConfirmation
		$this->DateOfConfirmation->LinkCustomAttributes = "";
		$this->DateOfConfirmation->HrefValue = "";
		$this->DateOfConfirmation->TooltipValue = "";

		// AcademicQualification
		$this->AcademicQualification->LinkCustomAttributes = "";
		$this->AcademicQualification->HrefValue = "";
		$this->AcademicQualification->TooltipValue = "";

		// ProfessionalQualification
		$this->ProfessionalQualification->LinkCustomAttributes = "";
		$this->ProfessionalQualification->HrefValue = "";
		$this->ProfessionalQualification->TooltipValue = "";

		// AdditionalInformation
		$this->AdditionalInformation->LinkCustomAttributes = "";
		$this->AdditionalInformation->HrefValue = "";
		$this->AdditionalInformation->TooltipValue = "";

		// LengthOfStay
		$this->LengthOfStay->LinkCustomAttributes = "";
		$this->LengthOfStay->HrefValue = "";
		$this->LengthOfStay->TooltipValue = "";

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

		// TownOrVillage
		$this->TownOrVillage->EditAttrs["class"] = "form-control";
		$this->TownOrVillage->EditCustomAttributes = "";
		if (!$this->TownOrVillage->Raw)
			$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
		$this->TownOrVillage->EditValue = $this->TownOrVillage->CurrentValue;
		$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

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

		// Sex
		$this->Sex->EditAttrs["class"] = "form-control";
		$this->Sex->EditCustomAttributes = "";
		if (!$this->Sex->Raw)
			$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
		$this->Sex->EditValue = $this->Sex->CurrentValue;
		$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

		// DateOfBirth
		$this->DateOfBirth->EditAttrs["class"] = "form-control";
		$this->DateOfBirth->EditCustomAttributes = "";
		$this->DateOfBirth->EditValue = FormatDateTime($this->DateOfBirth->CurrentValue, 8);
		$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
		$this->DateOfCurrentAppointment->EditCustomAttributes = "";
		$this->DateOfCurrentAppointment->EditValue = FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8);
		$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

		// DateOfConfirmation
		$this->DateOfConfirmation->EditAttrs["class"] = "form-control";
		$this->DateOfConfirmation->EditCustomAttributes = "";
		$this->DateOfConfirmation->EditValue = FormatDateTime($this->DateOfConfirmation->CurrentValue, 8);
		$this->DateOfConfirmation->PlaceHolder = RemoveHtml($this->DateOfConfirmation->caption());

		// AcademicQualification
		$this->AcademicQualification->EditAttrs["class"] = "form-control";
		$this->AcademicQualification->EditCustomAttributes = "";
		if (!$this->AcademicQualification->Raw)
			$this->AcademicQualification->CurrentValue = HtmlDecode($this->AcademicQualification->CurrentValue);
		$this->AcademicQualification->EditValue = $this->AcademicQualification->CurrentValue;
		$this->AcademicQualification->PlaceHolder = RemoveHtml($this->AcademicQualification->caption());

		// ProfessionalQualification
		$this->ProfessionalQualification->EditAttrs["class"] = "form-control";
		$this->ProfessionalQualification->EditCustomAttributes = "";
		if (!$this->ProfessionalQualification->Raw)
			$this->ProfessionalQualification->CurrentValue = HtmlDecode($this->ProfessionalQualification->CurrentValue);
		$this->ProfessionalQualification->EditValue = $this->ProfessionalQualification->CurrentValue;
		$this->ProfessionalQualification->PlaceHolder = RemoveHtml($this->ProfessionalQualification->caption());

		// AdditionalInformation
		$this->AdditionalInformation->EditAttrs["class"] = "form-control";
		$this->AdditionalInformation->EditCustomAttributes = "";
		$this->AdditionalInformation->EditValue = $this->AdditionalInformation->CurrentValue;
		$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

		// LengthOfStay
		$this->LengthOfStay->EditAttrs["class"] = "form-control";
		$this->LengthOfStay->EditCustomAttributes = "";
		if (!$this->LengthOfStay->Raw)
			$this->LengthOfStay->CurrentValue = HtmlDecode($this->LengthOfStay->CurrentValue);
		$this->LengthOfStay->EditValue = $this->LengthOfStay->CurrentValue;
		$this->LengthOfStay->PlaceHolder = RemoveHtml($this->LengthOfStay->caption());

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
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->DateOfConfirmation);
					$doc->exportCaption($this->AcademicQualification);
					$doc->exportCaption($this->ProfessionalQualification);
					$doc->exportCaption($this->AdditionalInformation);
					$doc->exportCaption($this->LengthOfStay);
				} else {
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->DateOfConfirmation);
					$doc->exportCaption($this->AcademicQualification);
					$doc->exportCaption($this->ProfessionalQualification);
					$doc->exportCaption($this->LengthOfStay);
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
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->Sex);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->DateOfConfirmation);
						$doc->exportField($this->AcademicQualification);
						$doc->exportField($this->ProfessionalQualification);
						$doc->exportField($this->AdditionalInformation);
						$doc->exportField($this->LengthOfStay);
					} else {
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->Surname);
						$doc->exportField($this->Sex);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->DateOfConfirmation);
						$doc->exportField($this->AcademicQualification);
						$doc->exportField($this->ProfessionalQualification);
						$doc->exportField($this->LengthOfStay);
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