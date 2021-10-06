<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for budget
 */
class budget extends DbTable
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
	public $OutcomeCode;
	public $OutputCode;
	public $ActionCode;
	public $DetailedActionCode;
	public $FinancialYear;
	public $AccountCode;
	public $ItemCode;
	public $MeansOfImplementation;
	public $UnitOfMeasure;
	public $Quantity;
	public $PeriodType;
	public $PeriodLength;
	public $Frequency;
	public $UnitCost;
	public $BudgetEstimate;
	public $ActualAmount;
	public $Status;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $BudgetLine;
	public $ProgramCode;
	public $SubProgramCode;
	public $ApprovedBudget;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'budget';
		$this->TableName = 'budget';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`budget`";
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

		// OutcomeCode
		$this->OutcomeCode = new DbField('budget', 'budget', 'x_OutcomeCode', 'OutcomeCode', '`OutcomeCode`', '`OutcomeCode`', 3, 11, -1, FALSE, '`OutcomeCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->OutcomeCode->IsForeignKey = TRUE; // Foreign key field
		$this->OutcomeCode->Nullable = FALSE; // NOT NULL field
		$this->OutcomeCode->Required = TRUE; // Required field
		$this->OutcomeCode->Sortable = TRUE; // Allow sort
		$this->OutcomeCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->OutcomeCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->OutcomeCode->Lookup = new Lookup('OutcomeCode', 'outcome', FALSE, 'OutcomeCode', ["OutcomeName","","",""], ["x_LACode"], ["x_OutputCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->OutcomeCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OutcomeCode'] = &$this->OutcomeCode;

		// OutputCode
		$this->OutputCode = new DbField('budget', 'budget', 'x_OutputCode', 'OutputCode', '`OutputCode`', '`OutputCode`', 3, 11, -1, FALSE, '`OutputCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->ActionCode = new DbField('budget', 'budget', 'x_ActionCode', 'ActionCode', '`ActionCode`', '`ActionCode`', 3, 11, -1, FALSE, '`ActionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ActionCode->IsForeignKey = TRUE; // Foreign key field
		$this->ActionCode->Nullable = FALSE; // NOT NULL field
		$this->ActionCode->Required = TRUE; // Required field
		$this->ActionCode->Sortable = TRUE; // Allow sort
		$this->ActionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ActionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ActionCode->Lookup = new Lookup('ActionCode', '_action', FALSE, 'ActionCode', ["ActionName","","",""], ["x_OutputCode"], ["x_DetailedActionCode"], ["OutputCode"], ["x_OutputCode"], [], [], '', '');
		$this->ActionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ActionCode'] = &$this->ActionCode;

		// DetailedActionCode
		$this->DetailedActionCode = new DbField('budget', 'budget', 'x_DetailedActionCode', 'DetailedActionCode', '`DetailedActionCode`', '`DetailedActionCode`', 3, 11, -1, FALSE, '`DetailedActionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DetailedActionCode->IsForeignKey = TRUE; // Foreign key field
		$this->DetailedActionCode->Nullable = FALSE; // NOT NULL field
		$this->DetailedActionCode->Required = TRUE; // Required field
		$this->DetailedActionCode->Sortable = TRUE; // Allow sort
		$this->DetailedActionCode->Lookup = new Lookup('DetailedActionCode', 'detailed_action', FALSE, 'DetailedActionCode', ["DetailedActionName","","",""], ["x_ActionCode"], [], ["ActionCode"], ["x_ActionCode"], [], [], '', '');
		$this->DetailedActionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DetailedActionCode'] = &$this->DetailedActionCode;

		// FinancialYear
		$this->FinancialYear = new DbField('budget', 'budget', 'x_FinancialYear', 'FinancialYear', '`FinancialYear`', '`FinancialYear`', 18, 4, -1, FALSE, '`FinancialYear`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FinancialYear->IsForeignKey = TRUE; // Foreign key field
		$this->FinancialYear->Nullable = FALSE; // NOT NULL field
		$this->FinancialYear->Required = TRUE; // Required field
		$this->FinancialYear->Sortable = TRUE; // Allow sort
		$this->FinancialYear->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FinancialYear->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FinancialYear->Lookup = new Lookup('FinancialYear', 'years', FALSE, 'Year', ["Year","","",""], [], [], [], [], [], [], '', '');
		$this->FinancialYear->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinancialYear'] = &$this->FinancialYear;

		// AccountCode
		$this->AccountCode = new DbField('budget', 'budget', 'x_AccountCode', 'AccountCode', '`AccountCode`', '`AccountCode`', 200, 25, -1, FALSE, '`AccountCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AccountCode->Nullable = FALSE; // NOT NULL field
		$this->AccountCode->Required = TRUE; // Required field
		$this->AccountCode->Sortable = TRUE; // Allow sort
		$this->AccountCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AccountCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AccountCode->Lookup = new Lookup('AccountCode', '_account_ref_master', FALSE, 'AccountCode', ["AccountName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['AccountCode'] = &$this->AccountCode;

		// ItemCode
		$this->ItemCode = new DbField('budget', 'budget', 'x_ItemCode', 'ItemCode', '`ItemCode`', '`ItemCode`', 200, 50, -1, FALSE, '`ItemCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ItemCode->Sortable = FALSE; // Allow sort
		$this->fields['ItemCode'] = &$this->ItemCode;

		// MeansOfImplementation
		$this->MeansOfImplementation = new DbField('budget', 'budget', 'x_MeansOfImplementation', 'MeansOfImplementation', '`MeansOfImplementation`', '`MeansOfImplementation`', 3, 11, -1, FALSE, '`MeansOfImplementation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MeansOfImplementation->Sortable = TRUE; // Allow sort
		$this->MeansOfImplementation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MeansOfImplementation->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MeansOfImplementation->Lookup = new Lookup('MeansOfImplementation', 'meansofimplement', FALSE, 'moimp_code', ["moimp_desc","","",""], [], [], [], [], [], [], '', '');
		$this->MeansOfImplementation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MeansOfImplementation'] = &$this->MeansOfImplementation;

		// UnitOfMeasure
		$this->UnitOfMeasure = new DbField('budget', 'budget', 'x_UnitOfMeasure', 'UnitOfMeasure', '`UnitOfMeasure`', '`UnitOfMeasure`', 200, 10, -1, FALSE, '`UnitOfMeasure`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UnitOfMeasure->Sortable = TRUE; // Allow sort
		$this->UnitOfMeasure->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UnitOfMeasure->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->UnitOfMeasure->Lookup = new Lookup('UnitOfMeasure', 'unit_of_measure', FALSE, 'Unit_of_measure', ["Unit_of_measure","","",""], [], [], [], [], [], [], '', '');
		$this->fields['UnitOfMeasure'] = &$this->UnitOfMeasure;

		// Quantity
		$this->Quantity = new DbField('budget', 'budget', 'x_Quantity', 'Quantity', '`Quantity`', '`Quantity`', 5, 22, -1, FALSE, '`Quantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Quantity->Nullable = FALSE; // NOT NULL field
		$this->Quantity->Required = TRUE; // Required field
		$this->Quantity->Sortable = TRUE; // Allow sort
		$this->Quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Quantity'] = &$this->Quantity;

		// PeriodType
		$this->PeriodType = new DbField('budget', 'budget', 'x_PeriodType', 'PeriodType', '`PeriodType`', '`PeriodType`', 200, 1, -1, FALSE, '`PeriodType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PeriodType->Sortable = TRUE; // Allow sort
		$this->PeriodType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PeriodType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PeriodType->Lookup = new Lookup('PeriodType', 'period_type', FALSE, 'Period_Type', ["PeriodTypeName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['PeriodType'] = &$this->PeriodType;

		// PeriodLength
		$this->PeriodLength = new DbField('budget', 'budget', 'x_PeriodLength', 'PeriodLength', '`PeriodLength`', '`PeriodLength`', 5, 22, -1, FALSE, '`PeriodLength`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PeriodLength->Sortable = TRUE; // Allow sort
		$this->fields['PeriodLength'] = &$this->PeriodLength;

		// Frequency
		$this->Frequency = new DbField('budget', 'budget', 'x_Frequency', 'Frequency', '`Frequency`', '`Frequency`', 5, 22, -1, FALSE, '`Frequency`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Frequency->Nullable = FALSE; // NOT NULL field
		$this->Frequency->Sortable = TRUE; // Allow sort
		$this->Frequency->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Frequency'] = &$this->Frequency;

		// UnitCost
		$this->UnitCost = new DbField('budget', 'budget', 'x_UnitCost', 'UnitCost', '`UnitCost`', '`UnitCost`', 5, 22, -1, FALSE, '`UnitCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UnitCost->Nullable = FALSE; // NOT NULL field
		$this->UnitCost->Required = TRUE; // Required field
		$this->UnitCost->Sortable = TRUE; // Allow sort
		$this->UnitCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['UnitCost'] = &$this->UnitCost;

		// BudgetEstimate
		$this->BudgetEstimate = new DbField('budget', 'budget', 'x_BudgetEstimate', 'BudgetEstimate', '`BudgetEstimate`', '`BudgetEstimate`', 5, 22, -1, FALSE, '`BudgetEstimate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BudgetEstimate->Nullable = FALSE; // NOT NULL field
		$this->BudgetEstimate->Sortable = TRUE; // Allow sort
		$this->BudgetEstimate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BudgetEstimate'] = &$this->BudgetEstimate;

		// ActualAmount
		$this->ActualAmount = new DbField('budget', 'budget', 'x_ActualAmount', 'ActualAmount', '`ActualAmount`', '`ActualAmount`', 5, 22, -1, FALSE, '`ActualAmount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualAmount->Sortable = TRUE; // Allow sort
		$this->ActualAmount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ActualAmount'] = &$this->ActualAmount;

		// Status
		$this->Status = new DbField('budget', 'budget', 'x_Status', 'Status', '`Status`', '`Status`', 200, 6, -1, FALSE, '`Status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Status->Sortable = TRUE; // Allow sort
		$this->Status->Lookup = new Lookup('Status', 'progress_status', FALSE, 'ProgressCode', ["ProgressDescription","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Status'] = &$this->Status;

		// LACode
		$this->LACode = new DbField('budget', 'budget', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Nullable = FALSE; // NOT NULL field
		$this->LACode->Required = TRUE; // Required field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], [], ["x_OutcomeCode","x_DepartmentCode"], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('budget', 'budget', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->SectionCode = new DbField('budget', 'budget', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], [], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// BudgetLine
		$this->BudgetLine = new DbField('budget', 'budget', 'x_BudgetLine', 'BudgetLine', '`BudgetLine`', '`BudgetLine`', 3, 11, -1, FALSE, '`BudgetLine`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->BudgetLine->IsAutoIncrement = TRUE; // Autoincrement field
		$this->BudgetLine->IsPrimaryKey = TRUE; // Primary key field
		$this->BudgetLine->Sortable = TRUE; // Allow sort
		$this->BudgetLine->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BudgetLine'] = &$this->BudgetLine;

		// ProgramCode
		$this->ProgramCode = new DbField('budget', 'budget', 'x_ProgramCode', 'ProgramCode', '`ProgramCode`', '`ProgramCode`', 3, 11, -1, FALSE, '`ProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->SubProgramCode = new DbField('budget', 'budget', 'x_SubProgramCode', 'SubProgramCode', '`SubProgramCode`', '`SubProgramCode`', 3, 11, -1, FALSE, '`SubProgramCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SubProgramCode->IsForeignKey = TRUE; // Foreign key field
		$this->SubProgramCode->Nullable = FALSE; // NOT NULL field
		$this->SubProgramCode->Required = TRUE; // Required field
		$this->SubProgramCode->Sortable = TRUE; // Allow sort
		$this->SubProgramCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SubProgramCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SubProgramCode->Lookup = new Lookup('SubProgramCode', 'la_sub_program', FALSE, 'SubProgramCode', ["SubProgramName","","",""], ["x_ProgramCode"], [], ["ProgramCode"], ["x_ProgramCode"], [], [], '', '');
		$this->SubProgramCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubProgramCode'] = &$this->SubProgramCode;

		// ApprovedBudget
		$this->ApprovedBudget = new DbField('budget', 'budget', 'x_ApprovedBudget', 'ApprovedBudget', '`ApprovedBudget`', '`ApprovedBudget`', 5, 22, -1, FALSE, '`ApprovedBudget`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ApprovedBudget->Nullable = FALSE; // NOT NULL field
		$this->ApprovedBudget->Sortable = TRUE; // Allow sort
		$this->ApprovedBudget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ApprovedBudget'] = &$this->ApprovedBudget;
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
		if ($this->getCurrentMasterTable() == "detailed_action") {
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$masterFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$masterFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ActionCode->getSessionValue() != "")
				$masterFilter .= " AND `ActionCode`=" . QuotedValue($this->ActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutcomeCode->getSessionValue() != "")
				$masterFilter .= " AND `OutcomeCode`=" . QuotedValue($this->OutcomeCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->OutputCode->getSessionValue() != "")
				$masterFilter .= " AND `OutputCode`=" . QuotedValue($this->OutputCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->DetailedActionCode->getSessionValue() != "")
				$masterFilter .= " AND `DetailedActionCode`=" . QuotedValue($this->DetailedActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$masterFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SubProgramCode->getSessionValue() != "")
				$masterFilter .= " AND `SubProgramCode`=" . QuotedValue($this->SubProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "detailed_action") {
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= "`LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$detailFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->FinancialYear->getSessionValue() != "")
				$detailFilter .= " AND `FinancialYear`=" . QuotedValue($this->FinancialYear->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ActionCode->getSessionValue() != "")
				$detailFilter .= " AND `ActionCode`=" . QuotedValue($this->ActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
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
			if ($this->DetailedActionCode->getSessionValue() != "")
				$detailFilter .= " AND `DetailedActionCode`=" . QuotedValue($this->DetailedActionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->ProgramCode->getSessionValue() != "")
				$detailFilter .= " AND `ProgramCode`=" . QuotedValue($this->ProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SubProgramCode->getSessionValue() != "")
				$detailFilter .= " AND `SubProgramCode`=" . QuotedValue($this->SubProgramCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_detailed_action()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `FinancialYear`=@FinancialYear@ AND `ActionCode`=@ActionCode@ AND `OutcomeCode`=@OutcomeCode@ AND `OutputCode`=@OutputCode@ AND `DetailedActionCode`=@DetailedActionCode@ AND `ProgramCode`=@ProgramCode@ AND `SubProgramCode`=@SubProgramCode@";
	}

	// Detail filter
	public function sqlDetailFilter_detailed_action()
	{
		return "`LACode`='@LACode@' AND `DepartmentCode`=@DepartmentCode@ AND `FinancialYear`=@FinancialYear@ AND `ActionCode`=@ActionCode@ AND `OutcomeCode`=@OutcomeCode@ AND `OutputCode`=@OutputCode@ AND `DetailedActionCode`=@DetailedActionCode@ AND `ProgramCode`=@ProgramCode@ AND `SubProgramCode`=@SubProgramCode@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`budget`";
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
			$this->BudgetLine->setDbValue($conn->insert_ID());
			$rs['BudgetLine'] = $this->BudgetLine->DbValue;
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
			if (array_key_exists('BudgetLine', $rs))
				AddFilter($where, QuotedName('BudgetLine', $this->Dbid) . '=' . QuotedValue($rs['BudgetLine'], $this->BudgetLine->DataType, $this->Dbid));
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
		$this->OutcomeCode->DbValue = $row['OutcomeCode'];
		$this->OutputCode->DbValue = $row['OutputCode'];
		$this->ActionCode->DbValue = $row['ActionCode'];
		$this->DetailedActionCode->DbValue = $row['DetailedActionCode'];
		$this->FinancialYear->DbValue = $row['FinancialYear'];
		$this->AccountCode->DbValue = $row['AccountCode'];
		$this->ItemCode->DbValue = $row['ItemCode'];
		$this->MeansOfImplementation->DbValue = $row['MeansOfImplementation'];
		$this->UnitOfMeasure->DbValue = $row['UnitOfMeasure'];
		$this->Quantity->DbValue = $row['Quantity'];
		$this->PeriodType->DbValue = $row['PeriodType'];
		$this->PeriodLength->DbValue = $row['PeriodLength'];
		$this->Frequency->DbValue = $row['Frequency'];
		$this->UnitCost->DbValue = $row['UnitCost'];
		$this->BudgetEstimate->DbValue = $row['BudgetEstimate'];
		$this->ActualAmount->DbValue = $row['ActualAmount'];
		$this->Status->DbValue = $row['Status'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->BudgetLine->DbValue = $row['BudgetLine'];
		$this->ProgramCode->DbValue = $row['ProgramCode'];
		$this->SubProgramCode->DbValue = $row['SubProgramCode'];
		$this->ApprovedBudget->DbValue = $row['ApprovedBudget'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`BudgetLine` = @BudgetLine@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('BudgetLine', $row) ? $row['BudgetLine'] : NULL;
		else
			$val = $this->BudgetLine->OldValue !== NULL ? $this->BudgetLine->OldValue : $this->BudgetLine->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@BudgetLine@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "budgetlist.php";
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
		if ($pageName == "budgetview.php")
			return $Language->phrase("View");
		elseif ($pageName == "budgetedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "budgetadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "budgetlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("budgetview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("budgetview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "budgetadd.php?" . $this->getUrlParm($parm);
		else
			$url = "budgetadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("budgetedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("budgetadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("budgetdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "detailed_action" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$url .= "&fk_FinancialYear=" . urlencode($this->FinancialYear->CurrentValue);
			$url .= "&fk_ActionCode=" . urlencode($this->ActionCode->CurrentValue);
			$url .= "&fk_OutcomeCode=" . urlencode($this->OutcomeCode->CurrentValue);
			$url .= "&fk_OutputCode=" . urlencode($this->OutputCode->CurrentValue);
			$url .= "&fk_DetailedActionCode=" . urlencode($this->DetailedActionCode->CurrentValue);
			$url .= "&fk_ProgramCode=" . urlencode($this->ProgramCode->CurrentValue);
			$url .= "&fk_SubProgramCode=" . urlencode($this->SubProgramCode->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "BudgetLine:" . JsonEncode($this->BudgetLine->CurrentValue, "number");
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
		if ($this->BudgetLine->CurrentValue != NULL) {
			$url .= "BudgetLine=" . urlencode($this->BudgetLine->CurrentValue);
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
			if (Param("BudgetLine") !== NULL)
				$arKeys[] = Param("BudgetLine");
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
				$this->BudgetLine->CurrentValue = $key;
			else
				$this->BudgetLine->OldValue = $key;
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
		$this->OutcomeCode->setDbValue($rs->fields('OutcomeCode'));
		$this->OutputCode->setDbValue($rs->fields('OutputCode'));
		$this->ActionCode->setDbValue($rs->fields('ActionCode'));
		$this->DetailedActionCode->setDbValue($rs->fields('DetailedActionCode'));
		$this->FinancialYear->setDbValue($rs->fields('FinancialYear'));
		$this->AccountCode->setDbValue($rs->fields('AccountCode'));
		$this->ItemCode->setDbValue($rs->fields('ItemCode'));
		$this->MeansOfImplementation->setDbValue($rs->fields('MeansOfImplementation'));
		$this->UnitOfMeasure->setDbValue($rs->fields('UnitOfMeasure'));
		$this->Quantity->setDbValue($rs->fields('Quantity'));
		$this->PeriodType->setDbValue($rs->fields('PeriodType'));
		$this->PeriodLength->setDbValue($rs->fields('PeriodLength'));
		$this->Frequency->setDbValue($rs->fields('Frequency'));
		$this->UnitCost->setDbValue($rs->fields('UnitCost'));
		$this->BudgetEstimate->setDbValue($rs->fields('BudgetEstimate'));
		$this->ActualAmount->setDbValue($rs->fields('ActualAmount'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->BudgetLine->setDbValue($rs->fields('BudgetLine'));
		$this->ProgramCode->setDbValue($rs->fields('ProgramCode'));
		$this->SubProgramCode->setDbValue($rs->fields('SubProgramCode'));
		$this->ApprovedBudget->setDbValue($rs->fields('ApprovedBudget'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// OutcomeCode
		// OutputCode
		// ActionCode
		// DetailedActionCode
		// FinancialYear
		// AccountCode
		// ItemCode
		// MeansOfImplementation
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// BudgetEstimate
		// ActualAmount
		// Status
		// LACode
		// DepartmentCode
		// SectionCode
		// BudgetLine
		// ProgramCode
		// SubProgramCode
		// ApprovedBudget
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

		// DetailedActionCode
		$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
		$curVal = strval($this->DetailedActionCode->CurrentValue);
		if ($curVal != "") {
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
			if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
				}
			}
		} else {
			$this->DetailedActionCode->ViewValue = NULL;
		}
		$this->DetailedActionCode->ViewCustomAttributes = "";

		// FinancialYear
		$curVal = strval($this->FinancialYear->CurrentValue);
		if ($curVal != "") {
			$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
			if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
				}
			}
		} else {
			$this->FinancialYear->ViewValue = NULL;
		}
		$this->FinancialYear->ViewCustomAttributes = "";

		// AccountCode
		$curVal = strval($this->AccountCode->CurrentValue);
		if ($curVal != "") {
			$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
			if ($this->AccountCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->AccountCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
				}
			}
		} else {
			$this->AccountCode->ViewValue = NULL;
		}
		$this->AccountCode->ViewCustomAttributes = "";

		// ItemCode
		$this->ItemCode->ViewValue = $this->ItemCode->CurrentValue;
		$this->ItemCode->ViewCustomAttributes = "";

		// MeansOfImplementation
		$curVal = strval($this->MeansOfImplementation->CurrentValue);
		if ($curVal != "") {
			$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
			if ($this->MeansOfImplementation->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`moimp_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->CurrentValue;
				}
			}
		} else {
			$this->MeansOfImplementation->ViewValue = NULL;
		}
		$this->MeansOfImplementation->ViewCustomAttributes = "";

		// UnitOfMeasure
		$curVal = strval($this->UnitOfMeasure->CurrentValue);
		if ($curVal != "") {
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
				}
			}
		} else {
			$this->UnitOfMeasure->ViewValue = NULL;
		}
		$this->UnitOfMeasure->ViewCustomAttributes = "";

		// Quantity
		$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
		$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 4, -2, -2, -2);
		$this->Quantity->CellCssStyle .= "text-align: right;";
		$this->Quantity->ViewCustomAttributes = "";

		// PeriodType
		$curVal = strval($this->PeriodType->CurrentValue);
		if ($curVal != "") {
			$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
				}
			}
		} else {
			$this->PeriodType->ViewValue = NULL;
		}
		$this->PeriodType->ViewCustomAttributes = "";

		// PeriodLength
		$this->PeriodLength->ViewValue = $this->PeriodLength->CurrentValue;
		$this->PeriodLength->ViewValue = FormatNumber($this->PeriodLength->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->PeriodLength->ViewCustomAttributes = "";

		// Frequency
		$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
		$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->Frequency->ViewCustomAttributes = "";

		// UnitCost
		$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
		$this->UnitCost->CellCssStyle .= "text-align: right;";
		$this->UnitCost->ViewCustomAttributes = "";

		// BudgetEstimate
		$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
		$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
		$this->BudgetEstimate->ViewCustomAttributes = "";

		// ActualAmount
		$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
		$this->ActualAmount->CellCssStyle .= "text-align: right;";
		$this->ActualAmount->ViewCustomAttributes = "";

		// Status
		$this->Status->ViewValue = $this->Status->CurrentValue;
		$curVal = strval($this->Status->CurrentValue);
		if ($curVal != "") {
			$this->Status->ViewValue = $this->Status->lookupCacheOption($curVal);
			if ($this->Status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Status->ViewValue = $this->Status->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Status->ViewValue = $this->Status->CurrentValue;
				}
			}
		} else {
			$this->Status->ViewValue = NULL;
		}
		$this->Status->ViewCustomAttributes = "";

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

		// BudgetLine
		$this->BudgetLine->ViewValue = $this->BudgetLine->CurrentValue;
		$this->BudgetLine->ViewCustomAttributes = "";

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

		// ApprovedBudget
		$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
		$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
		$this->ApprovedBudget->ViewCustomAttributes = "";

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

		// DetailedActionCode
		$this->DetailedActionCode->LinkCustomAttributes = "";
		$this->DetailedActionCode->HrefValue = "";
		$this->DetailedActionCode->TooltipValue = "";

		// FinancialYear
		$this->FinancialYear->LinkCustomAttributes = "";
		$this->FinancialYear->HrefValue = "";
		$this->FinancialYear->TooltipValue = "";

		// AccountCode
		$this->AccountCode->LinkCustomAttributes = "";
		$this->AccountCode->HrefValue = "";
		$this->AccountCode->TooltipValue = "";

		// ItemCode
		$this->ItemCode->LinkCustomAttributes = "";
		$this->ItemCode->HrefValue = "";
		$this->ItemCode->TooltipValue = "";

		// MeansOfImplementation
		$this->MeansOfImplementation->LinkCustomAttributes = "";
		$this->MeansOfImplementation->HrefValue = "";
		$this->MeansOfImplementation->TooltipValue = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->LinkCustomAttributes = "";
		$this->UnitOfMeasure->HrefValue = "";
		$this->UnitOfMeasure->TooltipValue = "";

		// Quantity
		$this->Quantity->LinkCustomAttributes = "";
		$this->Quantity->HrefValue = "";
		$this->Quantity->TooltipValue = "";

		// PeriodType
		$this->PeriodType->LinkCustomAttributes = "";
		$this->PeriodType->HrefValue = "";
		$this->PeriodType->TooltipValue = "";

		// PeriodLength
		$this->PeriodLength->LinkCustomAttributes = "";
		$this->PeriodLength->HrefValue = "";
		$this->PeriodLength->TooltipValue = "";

		// Frequency
		$this->Frequency->LinkCustomAttributes = "";
		$this->Frequency->HrefValue = "";
		$this->Frequency->TooltipValue = "";

		// UnitCost
		$this->UnitCost->LinkCustomAttributes = "";
		$this->UnitCost->HrefValue = "";
		$this->UnitCost->TooltipValue = "";

		// BudgetEstimate
		$this->BudgetEstimate->LinkCustomAttributes = "";
		$this->BudgetEstimate->HrefValue = "";
		$this->BudgetEstimate->TooltipValue = "";

		// ActualAmount
		$this->ActualAmount->LinkCustomAttributes = "";
		$this->ActualAmount->HrefValue = "";
		$this->ActualAmount->TooltipValue = "";

		// Status
		$this->Status->LinkCustomAttributes = "";
		$this->Status->HrefValue = "";
		$this->Status->TooltipValue = "";

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

		// BudgetLine
		$this->BudgetLine->LinkCustomAttributes = "";
		$this->BudgetLine->HrefValue = "";
		$this->BudgetLine->TooltipValue = "";

		// ProgramCode
		$this->ProgramCode->LinkCustomAttributes = "";
		$this->ProgramCode->HrefValue = "";
		$this->ProgramCode->TooltipValue = "";

		// SubProgramCode
		$this->SubProgramCode->LinkCustomAttributes = "";
		$this->SubProgramCode->HrefValue = "";
		$this->SubProgramCode->TooltipValue = "";

		// ApprovedBudget
		$this->ApprovedBudget->LinkCustomAttributes = "";
		$this->ApprovedBudget->HrefValue = "";
		$this->ApprovedBudget->TooltipValue = "";

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

		// DetailedActionCode
		$this->DetailedActionCode->EditAttrs["class"] = "form-control";
		$this->DetailedActionCode->EditCustomAttributes = "";
		if ($this->DetailedActionCode->getSessionValue() != "") {
			$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->getSessionValue();
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$curVal = strval($this->DetailedActionCode->CurrentValue);
			if ($curVal != "") {
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
					}
				}
			} else {
				$this->DetailedActionCode->ViewValue = NULL;
			}
			$this->DetailedActionCode->ViewCustomAttributes = "";
		} else {
			$this->DetailedActionCode->EditValue = $this->DetailedActionCode->CurrentValue;
			$this->DetailedActionCode->PlaceHolder = RemoveHtml($this->DetailedActionCode->caption());
		}

		// FinancialYear
		$this->FinancialYear->EditAttrs["class"] = "form-control";
		$this->FinancialYear->EditCustomAttributes = "";
		if ($this->FinancialYear->getSessionValue() != "") {
			$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
			$curVal = strval($this->FinancialYear->CurrentValue);
			if ($curVal != "") {
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
					}
				}
			} else {
				$this->FinancialYear->ViewValue = NULL;
			}
			$this->FinancialYear->ViewCustomAttributes = "";
		} else {
		}

		// AccountCode
		$this->AccountCode->EditAttrs["class"] = "form-control";
		$this->AccountCode->EditCustomAttributes = "";

		// ItemCode
		$this->ItemCode->EditAttrs["class"] = "form-control";
		$this->ItemCode->EditCustomAttributes = "";
		if (!$this->ItemCode->Raw)
			$this->ItemCode->CurrentValue = HtmlDecode($this->ItemCode->CurrentValue);
		$this->ItemCode->EditValue = $this->ItemCode->CurrentValue;
		$this->ItemCode->PlaceHolder = RemoveHtml($this->ItemCode->caption());

		// MeansOfImplementation
		$this->MeansOfImplementation->EditAttrs["class"] = "form-control";
		$this->MeansOfImplementation->EditCustomAttributes = "";

		// UnitOfMeasure
		$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
		$this->UnitOfMeasure->EditCustomAttributes = "";

		// Quantity
		$this->Quantity->EditAttrs["class"] = "form-control";
		$this->Quantity->EditCustomAttributes = "";
		$this->Quantity->EditValue = $this->Quantity->CurrentValue;
		$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
		if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue))
			$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
		

		// PeriodType
		$this->PeriodType->EditAttrs["class"] = "form-control";
		$this->PeriodType->EditCustomAttributes = "";

		// PeriodLength
		$this->PeriodLength->EditAttrs["class"] = "form-control";
		$this->PeriodLength->EditCustomAttributes = "";
		$this->PeriodLength->EditValue = $this->PeriodLength->CurrentValue;
		$this->PeriodLength->PlaceHolder = RemoveHtml($this->PeriodLength->caption());
		if (strval($this->PeriodLength->EditValue) != "" && is_numeric($this->PeriodLength->EditValue))
			$this->PeriodLength->EditValue = FormatNumber($this->PeriodLength->EditValue, -2, -1, -2, 0);
		

		// Frequency
		$this->Frequency->EditAttrs["class"] = "form-control";
		$this->Frequency->EditCustomAttributes = "";
		$this->Frequency->EditValue = $this->Frequency->CurrentValue;
		$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
		if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue))
			$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
		

		// UnitCost
		$this->UnitCost->EditAttrs["class"] = "form-control";
		$this->UnitCost->EditCustomAttributes = "";
		$this->UnitCost->EditValue = $this->UnitCost->CurrentValue;
		$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
		if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue))
			$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
		

		// BudgetEstimate
		$this->BudgetEstimate->EditAttrs["class"] = "form-control";
		$this->BudgetEstimate->EditCustomAttributes = "";
		$this->BudgetEstimate->EditValue = $this->BudgetEstimate->CurrentValue;
		$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
		if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue))
			$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
		

		// ActualAmount
		$this->ActualAmount->EditAttrs["class"] = "form-control";
		$this->ActualAmount->EditCustomAttributes = "";
		$this->ActualAmount->EditValue = $this->ActualAmount->CurrentValue;
		$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
		if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
			$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
		

		// Status
		$this->Status->EditAttrs["class"] = "form-control";
		$this->Status->EditCustomAttributes = "";
		if (!$this->Status->Raw)
			$this->Status->CurrentValue = HtmlDecode($this->Status->CurrentValue);
		$this->Status->EditValue = $this->Status->CurrentValue;
		$this->Status->PlaceHolder = RemoveHtml($this->Status->caption());

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

		// BudgetLine
		$this->BudgetLine->EditAttrs["class"] = "form-control";
		$this->BudgetLine->EditCustomAttributes = "";
		$this->BudgetLine->EditValue = $this->BudgetLine->CurrentValue;
		$this->BudgetLine->ViewCustomAttributes = "";

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
		if ($this->SubProgramCode->getSessionValue() != "") {
			$this->SubProgramCode->CurrentValue = $this->SubProgramCode->getSessionValue();
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
		} else {
		}

		// ApprovedBudget
		$this->ApprovedBudget->EditAttrs["class"] = "form-control";
		$this->ApprovedBudget->EditCustomAttributes = "";
		$this->ApprovedBudget->EditValue = $this->ApprovedBudget->CurrentValue;
		$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
		if (strval($this->ApprovedBudget->EditValue) != "" && is_numeric($this->ApprovedBudget->EditValue))
			$this->ApprovedBudget->EditValue = FormatNumber($this->ApprovedBudget->EditValue, -2, -2, -2, -2);
		

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->BudgetEstimate->CurrentValue))
				$this->BudgetEstimate->Total += $this->BudgetEstimate->CurrentValue; // Accumulate total
			if (is_numeric($this->ActualAmount->CurrentValue))
				$this->ActualAmount->Total += $this->ActualAmount->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->BudgetEstimate->CurrentValue = $this->BudgetEstimate->Total;
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = ""; // Clear href value
			$this->ActualAmount->CurrentValue = $this->ActualAmount->Total;
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";
			$this->ActualAmount->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->DetailedActionCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->MeansOfImplementation);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->UnitCost);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->Status);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->BudgetLine);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->ApprovedBudget);
				} else {
					$doc->exportCaption($this->OutcomeCode);
					$doc->exportCaption($this->OutputCode);
					$doc->exportCaption($this->ActionCode);
					$doc->exportCaption($this->DetailedActionCode);
					$doc->exportCaption($this->FinancialYear);
					$doc->exportCaption($this->AccountCode);
					$doc->exportCaption($this->MeansOfImplementation);
					$doc->exportCaption($this->UnitOfMeasure);
					$doc->exportCaption($this->Quantity);
					$doc->exportCaption($this->Frequency);
					$doc->exportCaption($this->UnitCost);
					$doc->exportCaption($this->BudgetEstimate);
					$doc->exportCaption($this->ActualAmount);
					$doc->exportCaption($this->Status);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->BudgetLine);
					$doc->exportCaption($this->ProgramCode);
					$doc->exportCaption($this->SubProgramCode);
					$doc->exportCaption($this->ApprovedBudget);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->DetailedActionCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->MeansOfImplementation);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->UnitCost);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->Status);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->BudgetLine);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->ApprovedBudget);
					} else {
						$doc->exportField($this->OutcomeCode);
						$doc->exportField($this->OutputCode);
						$doc->exportField($this->ActionCode);
						$doc->exportField($this->DetailedActionCode);
						$doc->exportField($this->FinancialYear);
						$doc->exportField($this->AccountCode);
						$doc->exportField($this->MeansOfImplementation);
						$doc->exportField($this->UnitOfMeasure);
						$doc->exportField($this->Quantity);
						$doc->exportField($this->Frequency);
						$doc->exportField($this->UnitCost);
						$doc->exportField($this->BudgetEstimate);
						$doc->exportField($this->ActualAmount);
						$doc->exportField($this->Status);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->BudgetLine);
						$doc->exportField($this->ProgramCode);
						$doc->exportField($this->SubProgramCode);
						$doc->exportField($this->ApprovedBudget);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->OutcomeCode, '');
				$doc->exportAggregate($this->OutputCode, '');
				$doc->exportAggregate($this->ActionCode, '');
				$doc->exportAggregate($this->DetailedActionCode, '');
				$doc->exportAggregate($this->FinancialYear, '');
				$doc->exportAggregate($this->AccountCode, '');
				$doc->exportAggregate($this->MeansOfImplementation, '');
				$doc->exportAggregate($this->UnitOfMeasure, '');
				$doc->exportAggregate($this->Quantity, '');
				$doc->exportAggregate($this->Frequency, '');
				$doc->exportAggregate($this->UnitCost, '');
				$doc->exportAggregate($this->BudgetEstimate, 'TOTAL');
				$doc->exportAggregate($this->ActualAmount, 'TOTAL');
				$doc->exportAggregate($this->Status, '');
				$doc->exportAggregate($this->LACode, '');
				$doc->exportAggregate($this->DepartmentCode, '');
				$doc->exportAggregate($this->SectionCode, '');
				$doc->exportAggregate($this->BudgetLine, '');
				$doc->exportAggregate($this->ProgramCode, '');
				$doc->exportAggregate($this->SubProgramCode, '');
				$doc->exportAggregate($this->ApprovedBudget, '');
				$doc->endExportRow();
			}
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
		$rsnew["BudgetEstimate"] = $rsnew["Quantity"]*$rsnew["Frequency"]*$rsnew["UnitCost"]*$rsnew["PeriodLength"];
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
		$rsnew["BudgetEstimate"] = $rsnew["Quantity"]*$rsnew["Frequency"]*$rsnew["UnitCost"]*$rsnew["PeriodLength"];
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