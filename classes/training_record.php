<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for training_record
 */
class training_record extends DbTable
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
	public $EmployeeID;
	public $TrainingIndex;
	public $FieldOfTraining;
	public $TrainingType;
	public $PlannedStartDate;
	public $PlannedEndDate;
	public $ActualStartDate;
	public $ActualEnddate;
	public $QualificationLevelObtained;
	public $AwardingInstitution;
	public $Certificate;
	public $FundingSource;
	public $TrainingCost;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'training_record';
		$this->TableName = 'training_record';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`training_record`";
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
		$this->EmployeeID = new DbField('training_record', 'training_record', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// TrainingIndex
		$this->TrainingIndex = new DbField('training_record', 'training_record', 'x_TrainingIndex', 'TrainingIndex', '`TrainingIndex`', '`TrainingIndex`', 3, 11, -1, FALSE, '`TrainingIndex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TrainingIndex->IsPrimaryKey = TRUE; // Primary key field
		$this->TrainingIndex->Nullable = FALSE; // NOT NULL field
		$this->TrainingIndex->Required = TRUE; // Required field
		$this->TrainingIndex->Sortable = TRUE; // Allow sort
		$this->TrainingIndex->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TrainingIndex'] = &$this->TrainingIndex;

		// FieldOfTraining
		$this->FieldOfTraining = new DbField('training_record', 'training_record', 'x_FieldOfTraining', 'FieldOfTraining', '`FieldOfTraining`', '`FieldOfTraining`', 16, 4, -1, FALSE, '`FieldOfTraining`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FieldOfTraining->Nullable = FALSE; // NOT NULL field
		$this->FieldOfTraining->Required = TRUE; // Required field
		$this->FieldOfTraining->Sortable = TRUE; // Allow sort
		$this->FieldOfTraining->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FieldOfTraining->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FieldOfTraining->Lookup = new Lookup('FieldOfTraining', 'qualification', FALSE, 'QualificationCode', ["QualificationName","","",""], [], [], [], [], [], [], '', '');
		$this->FieldOfTraining->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FieldOfTraining'] = &$this->FieldOfTraining;

		// TrainingType
		$this->TrainingType = new DbField('training_record', 'training_record', 'x_TrainingType', 'TrainingType', '`TrainingType`', '`TrainingType`', 16, 3, -1, FALSE, '`TrainingType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TrainingType->Nullable = FALSE; // NOT NULL field
		$this->TrainingType->Required = TRUE; // Required field
		$this->TrainingType->Sortable = TRUE; // Allow sort
		$this->TrainingType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TrainingType'] = &$this->TrainingType;

		// PlannedStartDate
		$this->PlannedStartDate = new DbField('training_record', 'training_record', 'x_PlannedStartDate', 'PlannedStartDate', '`PlannedStartDate`', CastDateFieldForLike("`PlannedStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedStartDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedStartDate->Required = TRUE; // Required field
		$this->PlannedStartDate->Sortable = TRUE; // Allow sort
		$this->PlannedStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedStartDate'] = &$this->PlannedStartDate;

		// PlannedEndDate
		$this->PlannedEndDate = new DbField('training_record', 'training_record', 'x_PlannedEndDate', 'PlannedEndDate', '`PlannedEndDate`', CastDateFieldForLike("`PlannedEndDate`", 2, "DB"), 133, 10, 2, FALSE, '`PlannedEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedEndDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedEndDate->Required = TRUE; // Required field
		$this->PlannedEndDate->Sortable = TRUE; // Allow sort
		$this->PlannedEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedEndDate'] = &$this->PlannedEndDate;

		// ActualStartDate
		$this->ActualStartDate = new DbField('training_record', 'training_record', 'x_ActualStartDate', 'ActualStartDate', '`ActualStartDate`', CastDateFieldForLike("`ActualStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualStartDate->Sortable = TRUE; // Allow sort
		$this->ActualStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualStartDate'] = &$this->ActualStartDate;

		// ActualEnddate
		$this->ActualEnddate = new DbField('training_record', 'training_record', 'x_ActualEnddate', 'ActualEnddate', '`ActualEnddate`', CastDateFieldForLike("`ActualEnddate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualEnddate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualEnddate->Sortable = TRUE; // Allow sort
		$this->ActualEnddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualEnddate'] = &$this->ActualEnddate;

		// QualificationLevelObtained
		$this->QualificationLevelObtained = new DbField('training_record', 'training_record', 'x_QualificationLevelObtained', 'QualificationLevelObtained', '`QualificationLevelObtained`', '`QualificationLevelObtained`', 200, 40, -1, FALSE, '`QualificationLevelObtained`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->QualificationLevelObtained->Sortable = TRUE; // Allow sort
		$this->QualificationLevelObtained->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->QualificationLevelObtained->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->QualificationLevelObtained->Lookup = new Lookup('QualificationLevelObtained', 'qualifications_professional', FALSE, 'ProfessionalQualifications', ["ProfessionalQualifications","","",""], [], [], [], [], [], [], '', '');
		$this->fields['QualificationLevelObtained'] = &$this->QualificationLevelObtained;

		// AwardingInstitution
		$this->AwardingInstitution = new DbField('training_record', 'training_record', 'x_AwardingInstitution', 'AwardingInstitution', '`AwardingInstitution`', '`AwardingInstitution`', 200, 255, -1, FALSE, '`AwardingInstitution`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AwardingInstitution->Sortable = TRUE; // Allow sort
		$this->fields['AwardingInstitution'] = &$this->AwardingInstitution;

		// Certificate
		$this->Certificate = new DbField('training_record', 'training_record', 'x_Certificate', 'Certificate', '`Certificate`', '`Certificate`', 205, 0, -1, TRUE, '`Certificate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->Certificate->Sortable = TRUE; // Allow sort
		$this->fields['Certificate'] = &$this->Certificate;

		// FundingSource
		$this->FundingSource = new DbField('training_record', 'training_record', 'x_FundingSource', 'FundingSource', '`FundingSource`', '`FundingSource`', 200, 50, -1, FALSE, '`FundingSource`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FundingSource->Sortable = TRUE; // Allow sort
		$this->FundingSource->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FundingSource->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FundingSource->Lookup = new Lookup('FundingSource', 'funding_source_training', FALSE, 'FundingSource', ["FundingSource","","",""], [], [], [], [], [], [], '', '');
		$this->FundingSource->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FundingSource'] = &$this->FundingSource;

		// TrainingCost
		$this->TrainingCost = new DbField('training_record', 'training_record', 'x_TrainingCost', 'TrainingCost', '`TrainingCost`', '`TrainingCost`', 5, 22, -1, FALSE, '`TrainingCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TrainingCost->Sortable = TRUE; // Allow sort
		$this->TrainingCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TrainingCost'] = &$this->TrainingCost;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`training_record`";
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'EmployeeID';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'TrainingIndex';
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
			if (array_key_exists('EmployeeID', $rs))
				AddFilter($where, QuotedName('EmployeeID', $this->Dbid) . '=' . QuotedValue($rs['EmployeeID'], $this->EmployeeID->DataType, $this->Dbid));
			if (array_key_exists('TrainingIndex', $rs))
				AddFilter($where, QuotedName('TrainingIndex', $this->Dbid) . '=' . QuotedValue($rs['TrainingIndex'], $this->TrainingIndex->DataType, $this->Dbid));
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->TrainingIndex->DbValue = $row['TrainingIndex'];
		$this->FieldOfTraining->DbValue = $row['FieldOfTraining'];
		$this->TrainingType->DbValue = $row['TrainingType'];
		$this->PlannedStartDate->DbValue = $row['PlannedStartDate'];
		$this->PlannedEndDate->DbValue = $row['PlannedEndDate'];
		$this->ActualStartDate->DbValue = $row['ActualStartDate'];
		$this->ActualEnddate->DbValue = $row['ActualEnddate'];
		$this->QualificationLevelObtained->DbValue = $row['QualificationLevelObtained'];
		$this->AwardingInstitution->DbValue = $row['AwardingInstitution'];
		$this->Certificate->Upload->DbValue = $row['Certificate'];
		$this->FundingSource->DbValue = $row['FundingSource'];
		$this->TrainingCost->DbValue = $row['TrainingCost'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `TrainingIndex` = @TrainingIndex@";
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
		if (is_array($row))
			$val = array_key_exists('TrainingIndex', $row) ? $row['TrainingIndex'] : NULL;
		else
			$val = $this->TrainingIndex->OldValue !== NULL ? $this->TrainingIndex->OldValue : $this->TrainingIndex->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@TrainingIndex@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "training_recordlist.php";
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
		if ($pageName == "training_recordview.php")
			return $Language->phrase("View");
		elseif ($pageName == "training_recordedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "training_recordadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "training_recordlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("training_recordview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("training_recordview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "training_recordadd.php?" . $this->getUrlParm($parm);
		else
			$url = "training_recordadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("training_recordedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("training_recordadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("training_recorddelete.php", $this->getUrlParm());
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
		$json .= ",TrainingIndex:" . JsonEncode($this->TrainingIndex->CurrentValue, "number");
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
		if ($this->TrainingIndex->CurrentValue != NULL) {
			$url .= "&TrainingIndex=" . urlencode($this->TrainingIndex->CurrentValue);
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
			if (Param("EmployeeID") !== NULL)
				$arKey[] = Param("EmployeeID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("TrainingIndex") !== NULL)
				$arKey[] = Param("TrainingIndex");
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
				if (!is_numeric($key[0])) // EmployeeID
					continue;
				if (!is_numeric($key[1])) // TrainingIndex
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
				$this->EmployeeID->CurrentValue = $key[0];
			else
				$this->EmployeeID->OldValue = $key[0];
			if ($setCurrent)
				$this->TrainingIndex->CurrentValue = $key[1];
			else
				$this->TrainingIndex->OldValue = $key[1];
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
		$this->TrainingIndex->setDbValue($rs->fields('TrainingIndex'));
		$this->FieldOfTraining->setDbValue($rs->fields('FieldOfTraining'));
		$this->TrainingType->setDbValue($rs->fields('TrainingType'));
		$this->PlannedStartDate->setDbValue($rs->fields('PlannedStartDate'));
		$this->PlannedEndDate->setDbValue($rs->fields('PlannedEndDate'));
		$this->ActualStartDate->setDbValue($rs->fields('ActualStartDate'));
		$this->ActualEnddate->setDbValue($rs->fields('ActualEnddate'));
		$this->QualificationLevelObtained->setDbValue($rs->fields('QualificationLevelObtained'));
		$this->AwardingInstitution->setDbValue($rs->fields('AwardingInstitution'));
		$this->Certificate->Upload->DbValue = $rs->fields('Certificate');
		$this->FundingSource->setDbValue($rs->fields('FundingSource'));
		$this->TrainingCost->setDbValue($rs->fields('TrainingCost'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// TrainingIndex
		// FieldOfTraining
		// TrainingType
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEnddate
		// QualificationLevelObtained
		// AwardingInstitution
		// Certificate
		// FundingSource
		// TrainingCost
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

		// TrainingIndex
		$this->TrainingIndex->ViewValue = $this->TrainingIndex->CurrentValue;
		$this->TrainingIndex->ViewCustomAttributes = "";

		// FieldOfTraining
		$curVal = strval($this->FieldOfTraining->CurrentValue);
		if ($curVal != "") {
			$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->lookupCacheOption($curVal);
			if ($this->FieldOfTraining->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`QualificationCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->FieldOfTraining->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->CurrentValue;
				}
			}
		} else {
			$this->FieldOfTraining->ViewValue = NULL;
		}
		$this->FieldOfTraining->ViewCustomAttributes = "";

		// TrainingType
		$this->TrainingType->ViewValue = $this->TrainingType->CurrentValue;
		$this->TrainingType->ViewCustomAttributes = "";

		// PlannedStartDate
		$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
		$this->PlannedStartDate->ViewCustomAttributes = "";

		// PlannedEndDate
		$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
		$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 2);
		$this->PlannedEndDate->ViewCustomAttributes = "";

		// ActualStartDate
		$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
		$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
		$this->ActualStartDate->ViewCustomAttributes = "";

		// ActualEnddate
		$this->ActualEnddate->ViewValue = $this->ActualEnddate->CurrentValue;
		$this->ActualEnddate->ViewValue = FormatDateTime($this->ActualEnddate->ViewValue, 0);
		$this->ActualEnddate->ViewCustomAttributes = "";

		// QualificationLevelObtained
		$curVal = strval($this->QualificationLevelObtained->CurrentValue);
		if ($curVal != "") {
			$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->lookupCacheOption($curVal);
			if ($this->QualificationLevelObtained->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->QualificationLevelObtained->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->CurrentValue;
				}
			}
		} else {
			$this->QualificationLevelObtained->ViewValue = NULL;
		}
		$this->QualificationLevelObtained->ViewCustomAttributes = "";

		// AwardingInstitution
		$this->AwardingInstitution->ViewValue = $this->AwardingInstitution->CurrentValue;
		$this->AwardingInstitution->ViewCustomAttributes = "";

		// Certificate
		if (!EmptyValue($this->Certificate->Upload->DbValue)) {
			$this->Certificate->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue;
			$this->Certificate->IsBlobImage = IsImageFile(ContentExtension($this->Certificate->Upload->DbValue));
		} else {
			$this->Certificate->ViewValue = "";
		}
		$this->Certificate->ViewCustomAttributes = "";

		// FundingSource
		$curVal = strval($this->FundingSource->CurrentValue);
		if ($curVal != "") {
			$this->FundingSource->ViewValue = $this->FundingSource->lookupCacheOption($curVal);
			if ($this->FundingSource->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`FundingSource`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->FundingSource->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FundingSource->ViewValue = $this->FundingSource->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FundingSource->ViewValue = $this->FundingSource->CurrentValue;
				}
			}
		} else {
			$this->FundingSource->ViewValue = NULL;
		}
		$this->FundingSource->ViewCustomAttributes = "";

		// TrainingCost
		$this->TrainingCost->ViewValue = $this->TrainingCost->CurrentValue;
		$this->TrainingCost->ViewValue = FormatCurrency($this->TrainingCost->ViewValue, 2, -2, -2, -2);
		$this->TrainingCost->CellCssStyle .= "text-align: right;";
		$this->TrainingCost->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// TrainingIndex
		$this->TrainingIndex->LinkCustomAttributes = "";
		$this->TrainingIndex->HrefValue = "";
		$this->TrainingIndex->TooltipValue = "";

		// FieldOfTraining
		$this->FieldOfTraining->LinkCustomAttributes = "";
		$this->FieldOfTraining->HrefValue = "";
		$this->FieldOfTraining->TooltipValue = "";

		// TrainingType
		$this->TrainingType->LinkCustomAttributes = "";
		$this->TrainingType->HrefValue = "";
		$this->TrainingType->TooltipValue = "";

		// PlannedStartDate
		$this->PlannedStartDate->LinkCustomAttributes = "";
		$this->PlannedStartDate->HrefValue = "";
		$this->PlannedStartDate->TooltipValue = "";

		// PlannedEndDate
		$this->PlannedEndDate->LinkCustomAttributes = "";
		$this->PlannedEndDate->HrefValue = "";
		$this->PlannedEndDate->TooltipValue = "";

		// ActualStartDate
		$this->ActualStartDate->LinkCustomAttributes = "";
		$this->ActualStartDate->HrefValue = "";
		$this->ActualStartDate->TooltipValue = "";

		// ActualEnddate
		$this->ActualEnddate->LinkCustomAttributes = "";
		$this->ActualEnddate->HrefValue = "";
		$this->ActualEnddate->TooltipValue = "";

		// QualificationLevelObtained
		$this->QualificationLevelObtained->LinkCustomAttributes = "";
		$this->QualificationLevelObtained->HrefValue = "";
		$this->QualificationLevelObtained->TooltipValue = "";

		// AwardingInstitution
		$this->AwardingInstitution->LinkCustomAttributes = "";
		$this->AwardingInstitution->HrefValue = "";
		$this->AwardingInstitution->TooltipValue = "";

		// Certificate
		$this->Certificate->LinkCustomAttributes = "";
		if (!empty($this->Certificate->Upload->DbValue)) {
			$this->Certificate->HrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);
			$this->Certificate->LinkAttrs["target"] = "";
			if ($this->Certificate->IsBlobImage && empty($this->Certificate->LinkAttrs["target"]))
				$this->Certificate->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->Certificate->HrefValue = FullUrl($this->Certificate->HrefValue, "href");
		} else {
			$this->Certificate->HrefValue = "";
		}
		$this->Certificate->ExportHrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);
		if (!$this->isExport()) {
			$this->Certificate->TooltipValue = $this->FieldOfTraining->ViewValue != "" ? $this->FieldOfTraining->ViewValue : $this->FieldOfTraining->CurrentValue;
			$this->Certificate->TooltipWidth = 30;
			if ($this->Certificate->HrefValue == "")
				$this->Certificate->HrefValue = "javascript:void(0);";
			$this->Certificate->LinkAttrs->appendClass("ew-tooltip-link");
			$this->Certificate->LinkAttrs["data-tooltip-id"] = "tt_training_record_x" . (($this->RowType != ROWTYPE_MASTER) ? @$this->RowCount : "") . "_Certificate";
			$this->Certificate->LinkAttrs["data-tooltip-width"] = $this->Certificate->TooltipWidth;
			$this->Certificate->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
		}

		// FundingSource
		$this->FundingSource->LinkCustomAttributes = "";
		$this->FundingSource->HrefValue = "";
		$this->FundingSource->TooltipValue = "";

		// TrainingCost
		$this->TrainingCost->LinkCustomAttributes = "";
		$this->TrainingCost->HrefValue = "";
		$this->TrainingCost->TooltipValue = "";

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

		// TrainingIndex
		$this->TrainingIndex->EditAttrs["class"] = "form-control";
		$this->TrainingIndex->EditCustomAttributes = "";
		$this->TrainingIndex->EditValue = $this->TrainingIndex->CurrentValue;
		$this->TrainingIndex->PlaceHolder = RemoveHtml($this->TrainingIndex->caption());

		// FieldOfTraining
		$this->FieldOfTraining->EditAttrs["class"] = "form-control";
		$this->FieldOfTraining->EditCustomAttributes = "";

		// TrainingType
		$this->TrainingType->EditAttrs["class"] = "form-control";
		$this->TrainingType->EditCustomAttributes = "";
		$this->TrainingType->EditValue = $this->TrainingType->CurrentValue;
		$this->TrainingType->PlaceHolder = RemoveHtml($this->TrainingType->caption());

		// PlannedStartDate
		$this->PlannedStartDate->EditAttrs["class"] = "form-control";
		$this->PlannedStartDate->EditCustomAttributes = "";
		$this->PlannedStartDate->EditValue = FormatDateTime($this->PlannedStartDate->CurrentValue, 8);
		$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

		// PlannedEndDate
		$this->PlannedEndDate->EditAttrs["class"] = "form-control";
		$this->PlannedEndDate->EditCustomAttributes = "";
		$this->PlannedEndDate->EditValue = FormatDateTime($this->PlannedEndDate->CurrentValue, 2);
		$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

		// ActualStartDate
		$this->ActualStartDate->EditAttrs["class"] = "form-control";
		$this->ActualStartDate->EditCustomAttributes = "";
		$this->ActualStartDate->EditValue = FormatDateTime($this->ActualStartDate->CurrentValue, 8);
		$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

		// ActualEnddate
		$this->ActualEnddate->EditAttrs["class"] = "form-control";
		$this->ActualEnddate->EditCustomAttributes = "";
		$this->ActualEnddate->EditValue = FormatDateTime($this->ActualEnddate->CurrentValue, 8);
		$this->ActualEnddate->PlaceHolder = RemoveHtml($this->ActualEnddate->caption());

		// QualificationLevelObtained
		$this->QualificationLevelObtained->EditAttrs["class"] = "form-control";
		$this->QualificationLevelObtained->EditCustomAttributes = "";

		// AwardingInstitution
		$this->AwardingInstitution->EditAttrs["class"] = "form-control";
		$this->AwardingInstitution->EditCustomAttributes = "";
		if (!$this->AwardingInstitution->Raw)
			$this->AwardingInstitution->CurrentValue = HtmlDecode($this->AwardingInstitution->CurrentValue);
		$this->AwardingInstitution->EditValue = $this->AwardingInstitution->CurrentValue;
		$this->AwardingInstitution->PlaceHolder = RemoveHtml($this->AwardingInstitution->caption());

		// Certificate
		$this->Certificate->EditAttrs["class"] = "form-control";
		$this->Certificate->EditCustomAttributes = "";
		if (!EmptyValue($this->Certificate->Upload->DbValue)) {
			$this->Certificate->EditValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue;
			$this->Certificate->IsBlobImage = IsImageFile(ContentExtension($this->Certificate->Upload->DbValue));
		} else {
			$this->Certificate->EditValue = "";
		}

		// FundingSource
		$this->FundingSource->EditAttrs["class"] = "form-control";
		$this->FundingSource->EditCustomAttributes = "";

		// TrainingCost
		$this->TrainingCost->EditAttrs["class"] = "form-control";
		$this->TrainingCost->EditCustomAttributes = "";
		$this->TrainingCost->EditValue = $this->TrainingCost->CurrentValue;
		$this->TrainingCost->PlaceHolder = RemoveHtml($this->TrainingCost->caption());
		if (strval($this->TrainingCost->EditValue) != "" && is_numeric($this->TrainingCost->EditValue))
			$this->TrainingCost->EditValue = FormatNumber($this->TrainingCost->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->TrainingIndex);
					$doc->exportCaption($this->FieldOfTraining);
					$doc->exportCaption($this->TrainingType);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEnddate);
					$doc->exportCaption($this->QualificationLevelObtained);
					$doc->exportCaption($this->AwardingInstitution);
					$doc->exportCaption($this->Certificate);
					$doc->exportCaption($this->FundingSource);
					$doc->exportCaption($this->TrainingCost);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->TrainingIndex);
					$doc->exportCaption($this->FieldOfTraining);
					$doc->exportCaption($this->TrainingType);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEnddate);
					$doc->exportCaption($this->QualificationLevelObtained);
					$doc->exportCaption($this->AwardingInstitution);
					$doc->exportCaption($this->FundingSource);
					$doc->exportCaption($this->TrainingCost);
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
						$doc->exportField($this->TrainingIndex);
						$doc->exportField($this->FieldOfTraining);
						$doc->exportField($this->TrainingType);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEnddate);
						$doc->exportField($this->QualificationLevelObtained);
						$doc->exportField($this->AwardingInstitution);
						$doc->exportField($this->Certificate);
						$doc->exportField($this->FundingSource);
						$doc->exportField($this->TrainingCost);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->TrainingIndex);
						$doc->exportField($this->FieldOfTraining);
						$doc->exportField($this->TrainingType);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEnddate);
						$doc->exportField($this->QualificationLevelObtained);
						$doc->exportField($this->AwardingInstitution);
						$doc->exportField($this->FundingSource);
						$doc->exportField($this->TrainingCost);
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
		if ($fldparm == 'Certificate') {
			$fldName = "Certificate";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 2) {
			$this->EmployeeID->CurrentValue = $ar[0];
			$this->TrainingIndex->CurrentValue = $ar[1];
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'training_record';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'training_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['TrainingIndex'];

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
		$table = 'training_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['TrainingIndex'];

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
		$table = 'training_record';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['TrainingIndex'];

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
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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

		$pstart = $rsnew["PlannedStartDate"];  
		$pend = $rsnew["PlannedEndDate"];
		if ($pend < $pstart) {

			// Return error 
			$this->CancelMessage =  "Planned start date should not be later than planned end date " ;
			 return FALSE;     
		 }
		$astart = $rsnew["ActualStartDate"];  
		$aend = $rsnew["ActualEnddate"];  //beware of the spelling strtotime(

		//die($pend);
		if ($aend < $astart) {

			// Return error 
			$this->CancelMessage =  "Actual start date should not be later than actual end date " ;
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

		$pstart = strtotime($rsnew["PlannedStartDate"]);  
		$pend = strtotime($rsnew["PlannedEndDate"]);

		//echo($pend);
		//echo($pstart);
		//sleep(50);

		if ($pstart === NULL) {
		    $pstart = strtotime($rsold["PlannedStartDate"]);
		    }
		if ($pend === NULL) {
		    $pend = strtotime($rsold["PlannedEndDate"]);
		    }
		if ($pend < $pstart) {

			// Return error if start date date later that end date
			$this->CancelMessage =  "Planned start date should not be later than planned end date " ;
			 return FALSE;     
		 }
		$astart = strtotime($rsnew["ActualStartDate"]);  
		$aend = strtotime($rsnew["ActualEnddate"]);
		if ($astart === NULL) {
		    $astart = strtotime($rsold["ActualStartDate"]);
		    }
		if ($aend === NULL) {
		    $aend = strtotime($rsold["ActualEnddate"]);
		    }
		if ($aend < $astart) {

			// Return error if start date date later that end date
			$this->CancelMessage =  "Actual start date should not be later than actual end date " ;
			 return FALSE;     
		 } 
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