<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for detailed_action
 */
class detailed_action extends DbTable
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
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $ProgramCode;
	public $SubProgramCode;
	public $OutcomeCode;
	public $OutputCode;
	public $ActionCode;
	public $FinancialYear;
	public $DetailedActionCode;
	public $DetailedActionName;
	public $DetailedActionLocation;
	public $PlannedStartDate;
	public $PlannedEndDate;
	public $ActualStartDate;
	public $ActualEndDate;
	public $Ward;
	public $ExpectedResult;
	public $Comments;
	public $ProgressStatus;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailed_action';
		$this->TableName = 'detailed_action';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailed_action`";
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

		// LACode
		$this->LACode = new DbField('detailed_action', 'detailed_action', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_DepartmentCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('detailed_action', 'detailed_action', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Nullable = FALSE; // NOT NULL field
		$this->DepartmentCode->Required = TRUE; // Required field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('detailed_action', 'detailed_action', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->Nullable = FALSE; // NOT NULL field
		$this->SectionCode->Required = TRUE; // Required field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// ProgramCode
		$this->ProgramCode = new DbField('detailed_action', 'detailed_action', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProgramCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProgramCode->Nullable = FALSE; // NOT NULL field
		$this->ProgramCode->Required = TRUE; // Required field
		$this->ProgramCode->Sortable = TRUE; // Allow sort
		$this->ProgramCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProgramCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProgramCode->Lookup = new Lookup('ProgramCode', 'la_program', FALSE, 'ProgramCode', ["ProgramName","","",""], [], ["x_SubProgramCode"], [], [], [], [], '', '');
		$this->ProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProgramCode'] = &$this->ProgramCode;

		// SubProgramCode
		$this->SubProgramCode = new DbField('detailed_action', 'detailed_action', 'x_SubProgramCode', 'SubProgramCode', '`SubProgramCode`', '`SubProgramCode`', 3, 11, -1, FALSE, '`SubProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SubProgramCode->IsForeignKey = TRUE; // Foreign key field
		$this->SubProgramCode->Sortable = TRUE; // Allow sort
		$this->SubProgramCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SubProgramCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SubProgramCode->Lookup = new Lookup('SubProgramCode', 'la_sub_program', FALSE, 'SubProgramCode', ["SubProgramName","","",""], ["x_ProgramCode"], [], ["ProgramCode"], ["x_ProgramCode"], [], [], '', '');
		$this->SubProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubProgramCode'] = &$this->SubProgramCode;

		// OutcomeCode
		$this->OutcomeCode = new DbField('detailed_action', 'detailed_action', 'x_OutcomeCode', 'OutcomeCode', '`OutcomeCode`', '`OutcomeCode`', 3, 11, -1, FALSE, '`OutcomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutcomeCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutcomeCode->Nullable = FALSE; // NOT NULL field
		$this->OutcomeCode->Required = TRUE; // Required field
		$this->OutcomeCode->Sortable = TRUE; // Allow sort
		$this->OutcomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutcomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutcomeCode->Lookup = new Lookup('OutcomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], [], ["x_OutputCode"], [], [], [], [], '', '');
		$this->OutcomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutcomeCode'] = &$this->OutcomeCode;

		// OutputCode
		$this->OutputCode = new DbField('detailed_action', 'detailed_action', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutputCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutputCode->Nullable = FALSE; // NOT NULL field
		$this->OutputCode->Required = TRUE; // Required field
		$this->OutputCode->Sortable = TRUE; // Allow sort
		$this->OutputCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutputCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutputCode->Lookup = new Lookup('OutputCode', 'output', FALSE, 'OutputCode', ["OutputName","","",""], ["x_OutcomeCode"], ["x_ActionCode"], ["OutcomeCode"], ["x_OutcomeCode"], [], [], '', '');
		$this->OutputCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutputCode'] = &$this->OutputCode;

		// ActionCode
		$this->ActionCode = new DbField('detailed_action', 'detailed_action', 'x_ActionCode', 'ActionCode', '`ActionCode`', '`ActionCode`', 3, 11, -1, FALSE, '`ActionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ActionCode->IsForeignKey = TRUE; // Foreign key field
		$this->ActionCode->Nullable = FALSE; // NOT NULL field
		$this->ActionCode->Required = TRUE; // Required field
		$this->ActionCode->Sortable = TRUE; // Allow sort
		$this->ActionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ActionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ActionCode->Lookup = new Lookup('ActionCode', '_action', FALSE, 'ActionCode', ["ActionName","","",""], ["x_OutputCode"], [], ["OutputCode"], ["x_OutputCode"], [], [], '', '');
		$this->ActionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ActionCode'] = &$this->ActionCode;

		// FinancialYear
		$this->FinancialYear = new DbField('detailed_action', 'detailed_action', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinancialYear->IsForeignKey = TRUE; // Foreign key field
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// DetailedActionCode
		$this->DetailedActionCode = new DbField('detailed_action', 'detailed_action', 'x_DetailedActionCode', 'DetailedActionCode', '`DetailedActionCode`', '`DetailedActionCode`', 3, 11, -1, FALSE, '`DetailedActionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->DetailedActionCode->IsAutoIncrement = TRUE; // Autoincrement field
		$this->DetailedActionCode->IsPrimaryKey = TRUE; // Primary key field
		$this->DetailedActionCode->IsForeignKey = TRUE; // Foreign key field
		$this->DetailedActionCode->Sortable = TRUE; // Allow sort
		$this->DetailedActionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DetailedActionCode'] = &$this->DetailedActionCode;

		// DetailedActionName
		$this->DetailedActionName = new DbField('detailed_action', 'detailed_action', 'x_DetailedActionName', 'DetailedActionName', '`DetailedActionName`', '`DetailedActionName`', 200, 255, -1, FALSE, '`DetailedActionName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DetailedActionName->Nullable = FALSE; // NOT NULL field
		$this->DetailedActionName->Required = TRUE; // Required field
		$this->DetailedActionName->Sortable = TRUE; // Allow sort
		$this->fields['DetailedActionName'] = &$this->DetailedActionName;

		// DetailedActionLocation
		$this->DetailedActionLocation = new DbField('detailed_action', 'detailed_action', 'x_DetailedActionLocation', 'DetailedActionLocation', '`DetailedActionLocation`', '`DetailedActionLocation`', 200, 255, -1, FALSE, '`DetailedActionLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DetailedActionLocation->Sortable = TRUE; // Allow sort
		$this->fields['DetailedActionLocation'] = &$this->DetailedActionLocation;

		// PlannedStartDate
		$this->PlannedStartDate = new DbField('detailed_action', 'detailed_action', 'x_PlannedStartDate', 'PlannedStartDate', '`PlannedStartDate`', CastDateFieldForLike("`PlannedStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedStartDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedStartDate->Required = TRUE; // Required field
		$this->PlannedStartDate->Sortable = TRUE; // Allow sort
		$this->PlannedStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedStartDate'] = &$this->PlannedStartDate;

		// PlannedEndDate
		$this->PlannedEndDate = new DbField('detailed_action', 'detailed_action', 'x_PlannedEndDate', 'PlannedEndDate', '`PlannedEndDate`', CastDateFieldForLike("`PlannedEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`PlannedEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PlannedEndDate->Nullable = FALSE; // NOT NULL field
		$this->PlannedEndDate->Required = TRUE; // Required field
		$this->PlannedEndDate->Sortable = TRUE; // Allow sort
		$this->PlannedEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PlannedEndDate'] = &$this->PlannedEndDate;

		// ActualStartDate
		$this->ActualStartDate = new DbField('detailed_action', 'detailed_action', 'x_ActualStartDate', 'ActualStartDate', '`ActualStartDate`', CastDateFieldForLike("`ActualStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualStartDate->Sortable = TRUE; // Allow sort
		$this->ActualStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualStartDate'] = &$this->ActualStartDate;

		// ActualEndDate
		$this->ActualEndDate = new DbField('detailed_action', 'detailed_action', 'x_ActualEndDate', 'ActualEndDate', '`ActualEndDate`', CastDateFieldForLike("`ActualEndDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualEndDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualEndDate->Sortable = TRUE; // Allow sort
		$this->ActualEndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ActualEndDate'] = &$this->ActualEndDate;

		// Ward
		$this->Ward = new DbField('detailed_action', 'detailed_action', 'x_Ward', 'Ward', '`Ward`', '`Ward`', 200, 20, -1, FALSE, '`Ward`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Ward->Sortable = TRUE; // Allow sort
		$this->fields['Ward'] = &$this->Ward;

		// ExpectedResult
		$this->ExpectedResult = new DbField('detailed_action', 'detailed_action', 'x_ExpectedResult', 'ExpectedResult', '`ExpectedResult`', '`ExpectedResult`', 200, 255, -1, FALSE, '`ExpectedResult`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ExpectedResult->Nullable = FALSE; // NOT NULL field
		$this->ExpectedResult->Required = TRUE; // Required field
		$this->ExpectedResult->Sortable = TRUE; // Allow sort
		$this->fields['ExpectedResult'] = &$this->ExpectedResult;

		// Comments
		$this->Comments = new DbField('detailed_action', 'detailed_action', 'x_Comments', 'Comments', '`Comments`', '`Comments`', 200, 255, -1, FALSE, '`Comments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Comments->Sortable = TRUE; // Allow sort
		$this->fields['Comments'] = &$this->Comments;

		// ProgressStatus
		$this->ProgressStatus = new DbField('detailed_action', 'detailed_action', 'x_ProgressStatus', 'ProgressStatus', '`ProgressStatus`', '`ProgressStatus`', 3, 11, -1, FALSE, '`ProgressStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProgressStatus->Sortable = TRUE; // Allow sort
		$this->ProgressStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProgressStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProgressStatus->Lookup = new Lookup('ProgressStatus', 'progress_status', FALSE, 'ProgressCode', ["ProgressDescription","","",""], [], [], [], [], [], [], '', '');
		$this->ProgressStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProgressStatus'] = &$this->ProgressStatus;
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
		if ($this->getCurrentMasterTable() == "_action") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$masterFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$masterFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutcomeCode->getSessionValue() != "")
				$masterFilter .= " AND `OucomeCode`=" . QuotedValue($this->OutcomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutputCode->getSessionValue() != "")
				$masterFilter .= " AND `OutputCode`=" . QuotedValue($this->OutputCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ActionCode->getSessionValue() != "")
				$masterFilter .= " AND `ActionCode`=" . QuotedValue($this->ActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$masterFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "_action") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$detailFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$detailFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutcomeCode->getSessionValue() != "")
				$detailFilter .= " AND `OutcomeCode`=" . QuotedValue($this->OutcomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutputCode->getSessionValue() != "")
				$detailFilter .= " AND `OutputCode`=" . QuotedValue($this->OutputCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ActionCode->getSessionValue() != "")
				$detailFilter .= " AND `ActionCode`=" . QuotedValue($this->ActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$detailFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter__action()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `ProgramCode`=@ProgramCode@ AND `OucomeCode`=@OucomeCode@ AND `OutputCode`=@OutputCode@ AND `ActionCode`=@ActionCode@ AND `FinancialYear`=@FinancialYear@";
	}

	// Detail filter
	public function sqlDetailFilter__action()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `ProgramCode`=@ProgramCode@ AND `OutcomeCode`=@OutcomeCode@ AND `OutputCode`=@OutputCode@ AND `ActionCode`=@ActionCode@ AND `FinancialYear`=@FinancialYear@";
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
		if ($this->getCurrentDetailTable() == "budget") {
			$detailUrl = $GLOBALS["budget"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$detailUrl .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$detailUrl .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
			$detailUrl .= "&fk_ActionCode=" . urlencode($this->ActionCode->CurrentValue);
			$detailUrl .= "&fk_OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$detailUrl .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$detailUrl .= "&fk_DetailedActionCode=" . urlencode($this->DetailedActionCode->CurrentValue);
			$detailUrl .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$detailUrl .= "&fk_SubProgramCode=" . urlencode($this->SubProgramCode->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "detailed_actionlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailed_action`";
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
			$this->DetailedActionCode->setDbValue($conn->insert_ID());
			$rs['DetailedActionCode'] = $this->DetailedActionCode->DbValue;
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
			if (array_key_exists('DetailedActionCode', $rs))
				AddFilter($where, QuotedName('DetailedActionCode', $this->Dbid) . '=' . QuotedValue($rs['DetailedActionCode'], $this->DetailedActionCode->DataType, $this->Dbid));
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
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->ProgramCode->DbValue = $row['ProgramCode'];
		$this->SubProgramCode->DbValue = $row['SubProgramCode'];
		$this->OutcomeCode->DbValue = $row['OutcomeCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->ActionCode->DbValue = $row['ActionCode'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->DetailedActionCode->DbValue = $row['DetailedActionCode'];
		$this->DetailedActionName->DbValue = $row['DetailedActionName'];
		$this->DetailedActionLocation->DbValue = $row['DetailedActionLocation'];
		$this->PlannedStartDate->DbValue = $row['PlannedStartDate'];
		$this->PlannedEndDate->DbValue = $row['PlannedEndDate'];
		$this->ActualStartDate->DbValue = $row['ActualStartDate'];
		$this->ActualEndDate->DbValue = $row['ActualEndDate'];
		$this->Ward->DbValue = $row['Ward'];
		$this->ExpectedResult->DbValue = $row['ExpectedResult'];
		$this->Comments->DbValue = $row['Comments'];
		$this->ProgressStatus->DbValue = $row['ProgressStatus'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`DetailedActionCode` = @DetailedActionCode@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('DetailedActionCode', $row) ? $row['DetailedActionCode'] : NULL;
		else
			$val = $this->DetailedActionCode->OldValue !== NULL ? $this->DetailedActionCode->OldValue : $this->DetailedActionCode->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@DetailedActionCode@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "detailed_actionlist.php";
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
		if ($pageName == "detailed_actionview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailed_actionedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailed_actionadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailed_actionlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailed_actionview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailed_actionview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailed_actionadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailed_actionadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailed_actionedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailed_actionedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("detailed_actionadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailed_actionadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("detailed_actiondelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "_action" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$url .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$url .= "&fk_OucomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$url .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$url .= "&fk_ActionCode=" . urlencode($this->ActionCode->CurrentValue);
			$url .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "DetailedActionCode:" . JsonEncode($this->DetailedActionCode->CurrentValue, "number");
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
		if ($this->DetailedActionCode->CurrentValue != NULL) {
			$url .= "DetailedActionCode=" . urlencode($this->DetailedActionCode->CurrentValue);
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
			if (Param("DetailedActionCode") !== NULL)
				$arKeys[] = Param("DetailedActionCode");
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
				$this->DetailedActionCode->CurrentValue = $key;
			else
				$this->DetailedActionCode->OldValue = $key;
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
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->ProgramCode->setDbValue($rs->fields('ProgramCode'));
		$this->SubProgramCode->setDbValue($rs->fields('SubProgramCode'));
		$this->OutcomeCode->setDbValue($rs->fields('OutcomeCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->ActionCode->setDbValue($rs->fields('ActionCode'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->DetailedActionCode->setDbValue($rs->fields('DetailedActionCode'));
		$this->DetailedActionName->setDbValue($rs->fields('DetailedActionName'));
		$this->DetailedActionLocation->setDbValue($rs->fields('DetailedActionLocation'));
		$this->PlannedStartDate->setDbValue($rs->fields('PlannedStartDate'));
		$this->PlannedEndDate->setDbValue($rs->fields('PlannedEndDate'));
		$this->ActualStartDate->setDbValue($rs->fields('ActualStartDate'));
		$this->ActualEndDate->setDbValue($rs->fields('ActualEndDate'));
		$this->Ward->setDbValue($rs->fields('Ward'));
		$this->ExpectedResult->setDbValue($rs->fields('ExpectedResult'));
		$this->Comments->setDbValue($rs->fields('Comments'));
		$this->ProgressStatus->setDbValue($rs->fields('ProgressStatus'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LACode
		// DepartmentCode
		// SectionCode
		// ProgramCode
		// SubProgramCode
		// OutcomeCode
		// OutputCode
		// ActionCode
		// FinancialYear
		// DetailedActionCode
		// DetailedActionName
		// DetailedActionLocation
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Ward
		// ExpectedResult
		// Comments
		// ProgressStatus
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

		// SectionCode
		$curVal = strval($this->SectionCode->CurrentValue);
		if ($curVal != "") {
			$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			if ($this->SectionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
				}
			}
		} else {
			$this->SectionCode->ViewValue = NULL;
		}
		$this->SectionCode->ViewCustomAttributes = "";

		// ProgramCode
		$curVal = strval($this->ProgramCode->CurrentValue);
		if ($curVal != "") {
			$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
			if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
				}
			}
		} else {
			$this->ProgramCode->ViewValue = NULL;
		}
		$this->ProgramCode->ViewCustomAttributes = "";

		// SubProgramCode
		$curVal = strval($this->SubProgramCode->CurrentValue);
		if ($curVal != "") {
			$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
			if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
				}
			}
		} else {
			$this->SubProgramCode->ViewValue = NULL;
		}
		$this->SubProgramCode->ViewCustomAttributes = "";

		// OutcomeCode
		$curVal = strval($this->OutcomeCode->CurrentValue);
		if ($curVal != "") {
			$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
			if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
				}
			}
		} else {
			$this->OutcomeCode->ViewValue = NULL;
		}
		$this->OutcomeCode->ViewCustomAttributes = "";

		// OutputCode
		$curVal = strval($this->OutputCode->CurrentValue);
		if ($curVal != "") {
			$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
			if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
				}
			}
		} else {
			$this->OutputCode->ViewValue = NULL;
		}
		$this->OutputCode->ViewCustomAttributes = "";

		// ActionCode
		$curVal = strval($this->ActionCode->CurrentValue);
		if ($curVal != "") {
			$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
			if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
				}
			}
		} else {
			$this->ActionCode->ViewValue = NULL;
		}
		$this->ActionCode->ViewCustomAttributes = "";

		// FinancialYear
		$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
		$this->FinancialYear->ViewCustomAttributes = "";

		// DetailedActionCode
		$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
		$this->DetailedActionCode->ViewCustomAttributes = "";

		// DetailedActionName
		$this->DetailedActionName->ViewValue = $this->DetailedActionName->CurrentValue;
		$this->DetailedActionName->ViewCustomAttributes = "";

		// DetailedActionLocation
		$this->DetailedActionLocation->ViewValue = $this->DetailedActionLocation->CurrentValue;
		$this->DetailedActionLocation->ViewCustomAttributes = "";

		// PlannedStartDate
		$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
		$this->PlannedStartDate->ViewCustomAttributes = "";

		// PlannedEndDate
		$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
		$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 0);
		$this->PlannedEndDate->ViewCustomAttributes = "";

		// ActualStartDate
		$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
		$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
		$this->ActualStartDate->ViewCustomAttributes = "";

		// ActualEndDate
		$this->ActualEndDate->ViewValue = $this->ActualEndDate->CurrentValue;
		$this->ActualEndDate->ViewValue = FormatDateTime($this->ActualEndDate->ViewValue, 0);
		$this->ActualEndDate->ViewCustomAttributes = "";

		// Ward
		$this->Ward->ViewValue = $this->Ward->CurrentValue;
		$this->Ward->ViewCustomAttributes = "";

		// ExpectedResult
		$this->ExpectedResult->ViewValue = $this->ExpectedResult->CurrentValue;
		$this->ExpectedResult->ViewCustomAttributes = "";

		// Comments
		$this->Comments->ViewValue = $this->Comments->CurrentValue;
		$this->Comments->ViewCustomAttributes = "";

		// ProgressStatus
		$curVal = strval($this->ProgressStatus->CurrentValue);
		if ($curVal != "") {
			$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
			if ($this->ProgressStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProgressStatus->ViewValue = $this->ProgressStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProgressStatus->ViewValue = $this->ProgressStatus->CurrentValue;
				}
			}
		} else {
			$this->ProgressStatus->ViewValue = NULL;
		}
		$this->ProgressStatus->ViewCustomAttributes = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// DepartmentCode
		$this->DepartmentCode->LinkCustomAttributes = "";
		$this->DepartmentCode->HrefValue = "";
		$this->DepartmentCode->TooltipValue = "";

		// SectionCode
		$this->SectionCode->LinkCustomAttributes = "";
		$this->SectionCode->HrefValue = "";
		$this->SectionCode->TooltipValue = "";

		// ProgramCode
		$this->ProgramCode->LinkCustomAttributes = "";
		$this->ProgramCode->HrefValue = "";
		$this->ProgramCode->TooltipValue = "";

		// SubProgramCode
		$this->SubProgramCode->LinkCustomAttributes = "";
		$this->SubProgramCode->HrefValue = "";
		$this->SubProgramCode->TooltipValue = "";

		// OutcomeCode
		$this->OutcomeCode->LinkCustomAttributes = "";
		$this->OutcomeCode->HrefValue = "";
		$this->OutcomeCode->TooltipValue = "";

		// OutputCode
		$this->OutputCode->LinkCustomAttributes = "";
		$this->OutputCode->HrefValue = "";
		$this->OutputCode->TooltipValue = "";

		// ActionCode
		$this->ActionCode->LinkCustomAttributes = "";
		$this->ActionCode->HrefValue = "";
		$this->ActionCode->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// DetailedActionCode
		$this->DetailedActionCode->LinkCustomAttributes = "";
		$this->DetailedActionCode->HrefValue = "";
		$this->DetailedActionCode->TooltipValue = "";

		// DetailedActionName
		$this->DetailedActionName->LinkCustomAttributes = "";
		$this->DetailedActionName->HrefValue = "";
		$this->DetailedActionName->TooltipValue = "";

		// DetailedActionLocation
		$this->DetailedActionLocation->LinkCustomAttributes = "";
		$this->DetailedActionLocation->HrefValue = "";
		$this->DetailedActionLocation->TooltipValue = "";

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

		// ActualEndDate
		$this->ActualEndDate->LinkCustomAttributes = "";
		$this->ActualEndDate->HrefValue = "";
		$this->ActualEndDate->TooltipValue = "";

		// Ward
		$this->Ward->LinkCustomAttributes = "";
		$this->Ward->HrefValue = "";
		$this->Ward->TooltipValue = "";

		// ExpectedResult
		$this->ExpectedResult->LinkCustomAttributes = "";
		$this->ExpectedResult->HrefValue = "";
		$this->ExpectedResult->TooltipValue = "";

		// Comments
		$this->Comments->LinkCustomAttributes = "";
		$this->Comments->HrefValue = "";
		$this->Comments->TooltipValue = "";

		// ProgressStatus
		$this->ProgressStatus->LinkCustomAttributes = "";
		$this->ProgressStatus->HrefValue = "";
		$this->ProgressStatus->TooltipValue = "";

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

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if ($this->LACode->getSessionValue() != "") {
			$this->LACode->CurrentValue = $this->LACode->getSessionValue();
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
		} else {
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = $this->LACode->CurrentValue;
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
		}

		// DepartmentCode
		$this->DepartmentCode->EditAttrs["class"] = "form-control";
		$this->DepartmentCode->EditCustomAttributes = "";
		if ($this->DepartmentCode->getSessionValue() != "") {
			$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
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
		} else {
		}

		// SectionCode
		$this->SectionCode->EditAttrs["class"] = "form-control";
		$this->SectionCode->EditCustomAttributes = "";

		// ProgramCode
		$this->ProgramCode->EditAttrs["class"] = "form-control";
		$this->ProgramCode->EditCustomAttributes = "";
		if ($this->ProgramCode->getSessionValue() != "") {
			$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";
		} else {
		}

		// SubProgramCode
		$this->SubProgramCode->EditAttrs["class"] = "form-control";
		$this->SubProgramCode->EditCustomAttributes = "";

		// OutcomeCode
		$this->OutcomeCode->EditAttrs["class"] = "form-control";
		$this->OutcomeCode->EditCustomAttributes = "";
		if ($this->OutcomeCode->getSessionValue() != "") {
			$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
					}
				}
			} else {
				$this->OutcomeCode->ViewValue = NULL;
			}
			$this->OutcomeCode->ViewCustomAttributes = "";
		} else {
		}

		// OutputCode
		$this->OutputCode->EditAttrs["class"] = "form-control";
		$this->OutputCode->EditCustomAttributes = "";
		if ($this->OutputCode->getSessionValue() != "") {
			$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
					}
				}
			} else {
				$this->OutputCode->ViewValue = NULL;
			}
			$this->OutputCode->ViewCustomAttributes = "";
		} else {
		}

		// ActionCode
		$this->ActionCode->EditAttrs["class"] = "form-control";
		$this->ActionCode->EditCustomAttributes = "";
		if ($this->ActionCode->getSessionValue() != "") {
			$this->ActionCode->CurrentValue = $this->ActionCode->getSessionValue();
			$curVal = strval($this->ActionCode->CurrentValue);
			if ($curVal != "") {
				$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
					}
				}
			} else {
				$this->ActionCode->ViewValue = NULL;
			}
			$this->ActionCode->ViewCustomAttributes = "";
		} else {
		}

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		if ($this->FinancialYear->getSessionValue() != "") {
			$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";
		} else {
			$this->FinancialYear->EditValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());
		}

		// DetailedActionCode
		$this->DetailedActionCode->EditAttrs["class"] = "form-control";
		$this->DetailedActionCode->EditCustomAttributes = "";
		$this->DetailedActionCode->EditValue = $this->DetailedActionCode->CurrentValue;
		$this->DetailedActionCode->ViewCustomAttributes = "";

		// DetailedActionName
		$this->DetailedActionName->EditAttrs["class"] = "form-control";
		$this->DetailedActionName->EditCustomAttributes = "";
		if (!$this->DetailedActionName->Raw)
			$this->DetailedActionName->CurrentValue = HtmlDecode($this->DetailedActionName->CurrentValue);
		$this->DetailedActionName->EditValue = $this->DetailedActionName->CurrentValue;
		$this->DetailedActionName->PlaceHolder = RemoveHtml($this->DetailedActionName->caption());

		// DetailedActionLocation
		$this->DetailedActionLocation->EditAttrs["class"] = "form-control";
		$this->DetailedActionLocation->EditCustomAttributes = "";
		if (!$this->DetailedActionLocation->Raw)
			$this->DetailedActionLocation->CurrentValue = HtmlDecode($this->DetailedActionLocation->CurrentValue);
		$this->DetailedActionLocation->EditValue = $this->DetailedActionLocation->CurrentValue;
		$this->DetailedActionLocation->PlaceHolder = RemoveHtml($this->DetailedActionLocation->caption());

		// PlannedStartDate
		$this->PlannedStartDate->EditAttrs["class"] = "form-control";
		$this->PlannedStartDate->EditCustomAttributes = "";
		$this->PlannedStartDate->EditValue = FormatDateTime($this->PlannedStartDate->CurrentValue, 8);
		$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

		// PlannedEndDate
		$this->PlannedEndDate->EditAttrs["class"] = "form-control";
		$this->PlannedEndDate->EditCustomAttributes = "";
		$this->PlannedEndDate->EditValue = FormatDateTime($this->PlannedEndDate->CurrentValue, 8);
		$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

		// ActualStartDate
		$this->ActualStartDate->EditAttrs["class"] = "form-control";
		$this->ActualStartDate->EditCustomAttributes = "";
		$this->ActualStartDate->EditValue = FormatDateTime($this->ActualStartDate->CurrentValue, 8);
		$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

		// ActualEndDate
		$this->ActualEndDate->EditAttrs["class"] = "form-control";
		$this->ActualEndDate->EditCustomAttributes = "";
		$this->ActualEndDate->EditValue = FormatDateTime($this->ActualEndDate->CurrentValue, 8);
		$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

		// Ward
		$this->Ward->EditAttrs["class"] = "form-control";
		$this->Ward->EditCustomAttributes = "";
		if (!$this->Ward->Raw)
			$this->Ward->CurrentValue = HtmlDecode($this->Ward->CurrentValue);
		$this->Ward->EditValue = $this->Ward->CurrentValue;
		$this->Ward->PlaceHolder = RemoveHtml($this->Ward->caption());

		// ExpectedResult
		$this->ExpectedResult->EditAttrs["class"] = "form-control";
		$this->ExpectedResult->EditCustomAttributes = "";
		$this->ExpectedResult->EditValue = $this->ExpectedResult->CurrentValue;
		$this->ExpectedResult->PlaceHolder = RemoveHtml($this->ExpectedResult->caption());

		// Comments
		$this->Comments->EditAttrs["class"] = "form-control";
		$this->Comments->EditCustomAttributes = "";
		$this->Comments->EditValue = $this->Comments->CurrentValue;
		$this->Comments->PlaceHolder = RemoveHtml($this->Comments->caption());

		// ProgressStatus
		$this->ProgressStatus->EditAttrs["class"] = "form-control";
		$this->ProgressStatus->EditCustomAttributes = "";

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
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->DetailedActionCode);
					$doc->exportCaption($this->DetailedActionName);
					$doc->exportCaption($this->DetailedActionLocation);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Ward);
					$doc->exportCaption($this->ExpectedResult);
					$doc->exportCaption($this->Comments);
					$doc->exportCaption($this->ProgressStatus);
				} else {
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->DetailedActionCode);
					$doc->exportCaption($this->DetailedActionName);
					$doc->exportCaption($this->DetailedActionLocation);
					$doc->exportCaption($this->PlannedStartDate);
					$doc->exportCaption($this->PlannedEndDate);
					$doc->exportCaption($this->ActualStartDate);
					$doc->exportCaption($this->ActualEndDate);
					$doc->exportCaption($this->Ward);
					$doc->exportCaption($this->ExpectedResult);
					$doc->exportCaption($this->Comments);
					$doc->exportCaption($this->ProgressStatus);
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
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->DetailedActionCode);
						$doc->exportField($this->DetailedActionName);
						$doc->exportField($this->DetailedActionLocation);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Ward);
						$doc->exportField($this->ExpectedResult);
						$doc->exportField($this->Comments);
						$doc->exportField($this->ProgressStatus);
					} else {
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->DetailedActionCode);
						$doc->exportField($this->DetailedActionName);
						$doc->exportField($this->DetailedActionLocation);
						$doc->exportField($this->PlannedStartDate);
						$doc->exportField($this->PlannedEndDate);
						$doc->exportField($this->ActualStartDate);
						$doc->exportField($this->ActualEndDate);
						$doc->exportField($this->Ward);
						$doc->exportField($this->ExpectedResult);
						$doc->exportField($this->Comments);
						$doc->exportField($this->ProgressStatus);
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
		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$userid = CurrentUserID();
		if ($levelid <> -1) {
			$row = executeRow("select * from musers where username = '" . $username . "'");
			$prv = $row["ProvinceCode"];
			$la = $row["LACode"];
			}

		//$sec = $row["SectionCode"];
		//die(strval($prv));
	//	if(isset($prv)) {				//levelid -1 is for admin
	//	AddFilter($filter,"`ProvinceCode`  in   ( '" . $prv .  	"')  ");  }

		if(isset($la)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   ( '" . $la .  	"')  ");  }

		//if(isset($hf)) {				//levelid -1 is for admin
		//AddFilter($filter,"`FacilityUID`  in   ( '" . $hf .  	"')  ");  }  
		//set filter for province

	/*	$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");  */

	/*	if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT security_matrix.ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  } */
		//set filter for local authority
		$la = executeRow("select count(security_matrix.LACode)as kountla 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.LACode is not null  
		and musers.username = '" . $username .     "'  ");
		if(($levelid <> -1) && ($la["kountla"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`LACode`  in   (select DISTINCT security_matrix.LACode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
		//set filter for departments in LA	
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid <> -1) && ($dept["kountdept"] > 0)) {
		AddFilter($filter,"`DepartmentCode`  in   (select DISTINCT security_matrix.DepartmentCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
		//set filter for sections
		$sect = executeRow("select count(security_matrix.SectionCode)as kountsect 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.SectionCode is not null  
		and musers.username = '" . $username .     "'  ");                                         
		if(($levelid <> -1) && ($sect["kountsect"] > 0)) {
		AddFilter($filter,"`SectionCode`  in   (select DISTINCT security_matrix.SectionCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }
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