<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for employment
 */
class employment extends DbTable
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
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $SubstantivePosition;
	public $DateOfCurrentAppointment;
	public $LastAppraisalDate;
	public $AppraisalStatus;
	public $DateOfExit;
	public $SalaryScale;
	public $EmploymentType;
	public $EmploymentStatus;
	public $ExitReason;
	public $RetirementType;
	public $EmployeeNumber;
	public $SalaryNotch;
	public $BasicMonthlySalary;
	public $ThirdParties;
	public $PayrollCode;
	public $DateOfConfirmation;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'employment';
		$this->TableName = 'employment';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`employment`";
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
		$this->EmployeeID = new DbField('employment', 'employment', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Nullable = FALSE; // NOT NULL field
		$this->EmployeeID->Required = TRUE; // Required field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// ProvinceCode
		$this->ProvinceCode = new DbField('employment', 'employment', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 4, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProvinceCode->IsForeignKey = TRUE; // Foreign key field
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProvinceCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProvinceCode->Lookup = new Lookup('ProvinceCode', 'province', FALSE, 'ProvinceCode', ["ProvinceName","","",""], [], ["x_LACode"], [], [], [], [], '', '');
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new DbField('employment', 'employment', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LACode->IsForeignKey = TRUE; // Foreign key field
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LACode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","","",""], ["x_ProvinceCode"], ["x_DepartmentCode"], ["ProvinceCode"], ["x_ProvinceCode"], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new DbField('employment', 'employment', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->DepartmentCode->IsForeignKey = TRUE; // Foreign key field
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->DepartmentCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->DepartmentCode->Lookup = new Lookup('DepartmentCode', 'department', FALSE, 'DepartmentCode', ["DepartmentName","","",""], ["x_LACode"], ["x_SectionCode"], ["LACode"], ["x_LACode"], [], [], '', '');
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new DbField('employment', 'employment', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SectionCode->IsForeignKey = TRUE; // Foreign key field
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SectionCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SectionCode->Lookup = new Lookup('SectionCode', 'dept_section', FALSE, 'SectionCode', ["SectionName","","",""], ["x_DepartmentCode"], ["x_SubstantivePosition"], ["DepartmentCode"], ["x_DepartmentCode"], [], [], '', '');
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SectionCode'] = &$this->SectionCode;

		// SubstantivePosition
		$this->SubstantivePosition = new DbField('employment', 'employment', 'x_SubstantivePosition', 'SubstantivePosition', '`SubstantivePosition`', '`SubstantivePosition`', 3, 11, -1, FALSE, '`SubstantivePosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SubstantivePosition->IsPrimaryKey = TRUE; // Primary key field
		$this->SubstantivePosition->IsForeignKey = TRUE; // Foreign key field
		$this->SubstantivePosition->Nullable = FALSE; // NOT NULL field
		$this->SubstantivePosition->Required = TRUE; // Required field
		$this->SubstantivePosition->Sortable = TRUE; // Allow sort
		$this->SubstantivePosition->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SubstantivePosition->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SubstantivePosition->Lookup = new Lookup('SubstantivePosition', 'position_ref', FALSE, 'PositionCode', ["PositionName","SalaryScale","",""], ["x_SectionCode"], [], ["SectionCode"], ["x_SectionCode"], ["SalaryScale"], ["x_SalaryScale"], '`PositionName` ASC', '');
		$this->SubstantivePosition->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubstantivePosition'] = &$this->SubstantivePosition;

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment = new DbField('employment', 'employment', 'x_DateOfCurrentAppointment', 'DateOfCurrentAppointment', '`DateOfCurrentAppointment`', CastDateFieldForLike("`DateOfCurrentAppointment`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfCurrentAppointment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfCurrentAppointment->Nullable = FALSE; // NOT NULL field
		$this->DateOfCurrentAppointment->Required = TRUE; // Required field
		$this->DateOfCurrentAppointment->Sortable = TRUE; // Allow sort
		$this->DateOfCurrentAppointment->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfCurrentAppointment'] = &$this->DateOfCurrentAppointment;

		// LastAppraisalDate
		$this->LastAppraisalDate = new DbField('employment', 'employment', 'x_LastAppraisalDate', 'LastAppraisalDate', '`LastAppraisalDate`', CastDateFieldForLike("`LastAppraisalDate`", 0, "DB"), 133, 10, 0, FALSE, '`LastAppraisalDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastAppraisalDate->Sortable = TRUE; // Allow sort
		$this->LastAppraisalDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastAppraisalDate'] = &$this->LastAppraisalDate;

		// AppraisalStatus
		$this->AppraisalStatus = new DbField('employment', 'employment', 'x_AppraisalStatus', 'AppraisalStatus', '`AppraisalStatus`', '`AppraisalStatus`', 16, 4, -1, FALSE, '`AppraisalStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AppraisalStatus->Sortable = TRUE; // Allow sort
		$this->AppraisalStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AppraisalStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AppraisalStatus->Lookup = new Lookup('AppraisalStatus', 'appraisal_status', FALSE, 'AppraisalStatus', ["AppraisalStatusDesc","","",""], [], [], [], [], [], [], '', '');
		$this->AppraisalStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AppraisalStatus'] = &$this->AppraisalStatus;

		// DateOfExit
		$this->DateOfExit = new DbField('employment', 'employment', 'x_DateOfExit', 'DateOfExit', '`DateOfExit`', CastDateFieldForLike("`DateOfExit`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfExit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfExit->Sortable = TRUE; // Allow sort
		$this->DateOfExit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfExit'] = &$this->DateOfExit;

		// SalaryScale
		$this->SalaryScale = new DbField('employment', 'employment', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 10, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->IsForeignKey = TRUE; // Foreign key field
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->SalaryScale->Lookup = new Lookup('SalaryScale', 'salary_scale', FALSE, 'SalaryScale', ["SalaryScale","","",""], [], ["x_SalaryNotch"], [], [], [], [], '', '');
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// EmploymentType
		$this->EmploymentType = new DbField('employment', 'employment', 'x_EmploymentType', 'EmploymentType', '`EmploymentType`', '`EmploymentType`', 16, 3, -1, FALSE, '`EmploymentType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->EmploymentType->Nullable = FALSE; // NOT NULL field
		$this->EmploymentType->Required = TRUE; // Required field
		$this->EmploymentType->Sortable = TRUE; // Allow sort
		$this->EmploymentType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->EmploymentType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->EmploymentType->Lookup = new Lookup('EmploymentType', 'employment_type', FALSE, 'EmploymentType', ["EmploymentTypeDesc","","",""], [], [], [], [], [], [], '', '');
		$this->EmploymentType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmploymentType'] = &$this->EmploymentType;

		// EmploymentStatus
		$this->EmploymentStatus = new DbField('employment', 'employment', 'x_EmploymentStatus', 'EmploymentStatus', '`EmploymentStatus`', '`EmploymentStatus`', 16, 3, -1, FALSE, '`EmploymentStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->EmploymentStatus->Nullable = FALSE; // NOT NULL field
		$this->EmploymentStatus->Required = TRUE; // Required field
		$this->EmploymentStatus->Sortable = TRUE; // Allow sort
		$this->EmploymentStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->EmploymentStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->EmploymentStatus->Lookup = new Lookup('EmploymentStatus', 'employment_status', FALSE, 'EmploymentStatus', ["EmploymentStatusDesc","","",""], [], ["x_ExitReason"], [], [], [], [], '', '');
		$this->EmploymentStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmploymentStatus'] = &$this->EmploymentStatus;

		// ExitReason
		$this->ExitReason = new DbField('employment', 'employment', 'x_ExitReason', 'ExitReason', '`ExitReason`', '`ExitReason`', 16, 3, -1, FALSE, '`ExitReason`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ExitReason->Sortable = TRUE; // Allow sort
		$this->ExitReason->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ExitReason->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ExitReason->Lookup = new Lookup('ExitReason', 'exit_reasons', FALSE, 'ExitCode', ["ExitReason","","",""], ["x_EmploymentStatus"], ["x_RetirementType"], ["EmploymentStatus"], ["x_EmploymentStatus"], [], [], '', '');
		$this->ExitReason->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ExitReason'] = &$this->ExitReason;

		// RetirementType
		$this->RetirementType = new DbField('employment', 'employment', 'x_RetirementType', 'RetirementType', '`RetirementType`', '`RetirementType`', 16, 4, -1, FALSE, '`RetirementType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RetirementType->Sortable = TRUE; // Allow sort
		$this->RetirementType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RetirementType->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RetirementType->Lookup = new Lookup('RetirementType', 'retirement_type', FALSE, 'RetirementCode', ["RetirementType","","",""], ["x_ExitReason"], [], ["ExitCode"], ["x_ExitCode"], [], [], '', '');
		$this->RetirementType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RetirementType'] = &$this->RetirementType;

		// EmployeeNumber
		$this->EmployeeNumber = new DbField('employment', 'employment', 'x_EmployeeNumber', 'EmployeeNumber', '`EmployeeNumber`', '`EmployeeNumber`', 200, 50, -1, FALSE, '`EmployeeNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeNumber->Sortable = TRUE; // Allow sort
		$this->fields['EmployeeNumber'] = &$this->EmployeeNumber;

		// SalaryNotch
		$this->SalaryNotch = new DbField('employment', 'employment', 'x_SalaryNotch', 'SalaryNotch', '`SalaryNotch`', '`SalaryNotch`', 5, 22, -1, FALSE, '`SalaryNotch`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SalaryNotch->Nullable = FALSE; // NOT NULL field
		$this->SalaryNotch->Required = TRUE; // Required field
		$this->SalaryNotch->Sortable = TRUE; // Allow sort
		$this->SalaryNotch->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SalaryNotch->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SalaryNotch->Lookup = new Lookup('SalaryNotch', 'salary_notch', FALSE, 'Notch', ["Notch","BasicMonthlySalary","",""], ["x_SalaryScale"], [], ["SalaryScale"], ["x_SalaryScale"], ["BasicMonthlySalary"], ["x_BasicMonthlySalary"], '', '');
		$this->SalaryNotch->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['SalaryNotch'] = &$this->SalaryNotch;

		// BasicMonthlySalary
		$this->BasicMonthlySalary = new DbField('employment', 'employment', 'x_BasicMonthlySalary', 'BasicMonthlySalary', '`BasicMonthlySalary`', '`BasicMonthlySalary`', 5, 22, -1, FALSE, '`BasicMonthlySalary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BasicMonthlySalary->Nullable = FALSE; // NOT NULL field
		$this->BasicMonthlySalary->Required = TRUE; // Required field
		$this->BasicMonthlySalary->Sortable = TRUE; // Allow sort
		$this->BasicMonthlySalary->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BasicMonthlySalary'] = &$this->BasicMonthlySalary;

		// ThirdParties
		$this->ThirdParties = new DbField('employment', 'employment', 'x_ThirdParties', 'ThirdParties', '`ThirdParties`', '`ThirdParties`', 200, 255, -1, FALSE, '`ThirdParties`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ThirdParties->Nullable = FALSE; // NOT NULL field
		$this->ThirdParties->Sortable = TRUE; // Allow sort
		$this->ThirdParties->Lookup = new Lookup('ThirdParties', 'third_party', FALSE, 'DeductionCode', ["ThirdPartyName","DeductionCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['ThirdParties'] = &$this->ThirdParties;

		// PayrollCode
		$this->PayrollCode = new DbField('employment', 'employment', 'x_PayrollCode', 'PayrollCode', '`PayrollCode`', '`PayrollCode`', 3, 11, -1, FALSE, '`PayrollCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PayrollCode->Nullable = FALSE; // NOT NULL field
		$this->PayrollCode->Required = TRUE; // Required field
		$this->PayrollCode->Sortable = TRUE; // Allow sort
		$this->PayrollCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PayrollCode'] = &$this->PayrollCode;

		// DateOfConfirmation
		$this->DateOfConfirmation = new DbField('employment', 'employment', 'x_DateOfConfirmation', 'DateOfConfirmation', '`DateOfConfirmation`', CastDateFieldForLike("`DateOfConfirmation`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfConfirmation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfConfirmation->Sortable = TRUE; // Allow sort
		$this->DateOfConfirmation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfConfirmation'] = &$this->DateOfConfirmation;
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
		if ($this->getCurrentMasterTable() == "position_ref") {
			if ($this->SubstantivePosition->getSessionValue() != "")
				$masterFilter .= "`PositionCode`=" . QuotedValue($this->SubstantivePosition->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SectionCode->getSessionValue() != "")
				$masterFilter .= " AND `SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$masterFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$masterFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->ProvinceCode->getSessionValue() != "")
				$masterFilter .= " AND `ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SalaryScale->getSessionValue() != "")
				$masterFilter .= " AND `SalaryScale`=" . QuotedValue($this->SalaryScale->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "staff") {
			if ($this->EmployeeID->getSessionValue() != "")
				$masterFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "position_ref") {
			if ($this->SubstantivePosition->getSessionValue() != "")
				$detailFilter .= "`SubstantivePosition`=" . QuotedValue($this->SubstantivePosition->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SectionCode->getSessionValue() != "")
				$detailFilter .= " AND `SectionCode`=" . QuotedValue($this->SectionCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->DepartmentCode->getSessionValue() != "")
				$detailFilter .= " AND `DepartmentCode`=" . QuotedValue($this->DepartmentCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->LACode->getSessionValue() != "")
				$detailFilter .= " AND `LACode`=" . QuotedValue($this->LACode->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->ProvinceCode->getSessionValue() != "")
				$detailFilter .= " AND `ProvinceCode`=" . QuotedValue($this->ProvinceCode->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->SalaryScale->getSessionValue() != "")
				$detailFilter .= " AND `SalaryScale`=" . QuotedValue($this->SalaryScale->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "staff") {
			if ($this->EmployeeID->getSessionValue() != "")
				$detailFilter .= "`EmployeeID`=" . QuotedValue($this->EmployeeID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_position_ref()
	{
		return "`PositionCode`=@PositionCode@ AND `SectionCode`=@SectionCode@ AND `DepartmentCode`=@DepartmentCode@ AND `LACode`='@LACode@' AND `ProvinceCode`=@ProvinceCode@ AND `SalaryScale`='@SalaryScale@'";
	}

	// Detail filter
	public function sqlDetailFilter_position_ref()
	{
		return "`SubstantivePosition`=@SubstantivePosition@ AND `SectionCode`=@SectionCode@ AND `DepartmentCode`=@DepartmentCode@ AND `LACode`='@LACode@' AND `ProvinceCode`=@ProvinceCode@ AND `SalaryScale`='@SalaryScale@'";
	}

	// Master filter
	public function sqlMasterFilter_staff()
	{
		return "`EmployeeID`=@EmployeeID@";
	}

	// Detail filter
	public function sqlDetailFilter_staff()
	{
		return "`EmployeeID`=@EmployeeID@";
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
		if ($this->getCurrentDetailTable() == "leave_record") {
			$detailUrl = $GLOBALS["leave_record"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "leave_taken") {
			$detailUrl = $GLOBALS["leave_taken"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "employee_obligation") {
			$detailUrl = $GLOBALS["employee_obligation"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "employee_income") {
			$detailUrl = $GLOBALS["employee_income"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "employmentlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`employment`";
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

		// Cascade Update detail table 'leave_record'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['EmployeeID']) && $rsold['EmployeeID'] != $rs['EmployeeID'])) { // Update detail field 'EmployeeID'
			$cascadeUpdate = TRUE;
			$rscascade['EmployeeID'] = $rs['EmployeeID'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["leave_record"]))
				$GLOBALS["leave_record"] = new leave_record();
			$rswrk = $GLOBALS["leave_record"]->loadRs("`EmployeeID` = " . QuotedValue($rsold['EmployeeID'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'EmployeeID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'LeaveTypeCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["leave_record"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["leave_record"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["leave_record"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'leave_taken'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['EmployeeID']) && $rsold['EmployeeID'] != $rs['EmployeeID'])) { // Update detail field 'EmployeeID'
			$cascadeUpdate = TRUE;
			$rscascade['EmployeeID'] = $rs['EmployeeID'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["leave_taken"]))
				$GLOBALS["leave_taken"] = new leave_taken();
			$rswrk = $GLOBALS["leave_taken"]->loadRs("`EmployeeID` = " . QuotedValue($rsold['EmployeeID'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'EmployeeID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'LeaveTypeCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'StartDate';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["leave_taken"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["leave_taken"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["leave_taken"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'employee_obligation'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['EmployeeID']) && $rsold['EmployeeID'] != $rs['EmployeeID'])) { // Update detail field 'EmployeeID'
			$cascadeUpdate = TRUE;
			$rscascade['EmployeeID'] = $rs['EmployeeID'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["employee_obligation"]))
				$GLOBALS["employee_obligation"] = new employee_obligation();
			$rswrk = $GLOBALS["employee_obligation"]->loadRs("`EmployeeID` = " . QuotedValue($rsold['EmployeeID'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'EmployeeID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'PayrollPeriod';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'ObligationCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["employee_obligation"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["employee_obligation"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["employee_obligation"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'employee_income'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['EmployeeID']) && $rsold['EmployeeID'] != $rs['EmployeeID'])) { // Update detail field 'EmployeeID'
			$cascadeUpdate = TRUE;
			$rscascade['EmployeeID'] = $rs['EmployeeID'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["employee_income"]))
				$GLOBALS["employee_income"] = new employee_income();
			$rswrk = $GLOBALS["employee_income"]->loadRs("`EmployeeID` = " . QuotedValue($rsold['EmployeeID'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'EmployeeID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'PayrollPeriod';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'IncomeCode';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["employee_income"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["employee_income"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["employee_income"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'EmployeeID';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'SubstantivePosition';
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
			if (array_key_exists('SubstantivePosition', $rs))
				AddFilter($where, QuotedName('SubstantivePosition', $this->Dbid) . '=' . QuotedValue($rs['SubstantivePosition'], $this->SubstantivePosition->DataType, $this->Dbid));
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

		// Cascade delete detail table 'leave_record'
		if (!isset($GLOBALS["leave_record"]))
			$GLOBALS["leave_record"] = new leave_record();
		$rscascade = $GLOBALS["leave_record"]->loadRs("`EmployeeID` = " . QuotedValue($rs['EmployeeID'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["leave_record"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["leave_record"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["leave_record"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'leave_taken'
		if (!isset($GLOBALS["leave_taken"]))
			$GLOBALS["leave_taken"] = new leave_taken();
		$rscascade = $GLOBALS["leave_taken"]->loadRs("`EmployeeID` = " . QuotedValue($rs['EmployeeID'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["leave_taken"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["leave_taken"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["leave_taken"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'employee_obligation'
		if (!isset($GLOBALS["employee_obligation"]))
			$GLOBALS["employee_obligation"] = new employee_obligation();
		$rscascade = $GLOBALS["employee_obligation"]->loadRs("`EmployeeID` = " . QuotedValue($rs['EmployeeID'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["employee_obligation"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["employee_obligation"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["employee_obligation"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'employee_income'
		if (!isset($GLOBALS["employee_income"]))
			$GLOBALS["employee_income"] = new employee_income();
		$rscascade = $GLOBALS["employee_income"]->loadRs("`EmployeeID` = " . QuotedValue($rs['EmployeeID'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["employee_income"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["employee_income"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["employee_income"]->Row_Deleted($dtlrow);
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
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->ProvinceCode->DbValue = $row['ProvinceCode'];
		$this->LACode->DbValue = $row['LACode'];
		$this->DepartmentCode->DbValue = $row['DepartmentCode'];
		$this->SectionCode->DbValue = $row['SectionCode'];
		$this->SubstantivePosition->DbValue = $row['SubstantivePosition'];
		$this->DateOfCurrentAppointment->DbValue = $row['DateOfCurrentAppointment'];
		$this->LastAppraisalDate->DbValue = $row['LastAppraisalDate'];
		$this->AppraisalStatus->DbValue = $row['AppraisalStatus'];
		$this->DateOfExit->DbValue = $row['DateOfExit'];
		$this->SalaryScale->DbValue = $row['SalaryScale'];
		$this->EmploymentType->DbValue = $row['EmploymentType'];
		$this->EmploymentStatus->DbValue = $row['EmploymentStatus'];
		$this->ExitReason->DbValue = $row['ExitReason'];
		$this->RetirementType->DbValue = $row['RetirementType'];
		$this->EmployeeNumber->DbValue = $row['EmployeeNumber'];
		$this->SalaryNotch->DbValue = $row['SalaryNotch'];
		$this->BasicMonthlySalary->DbValue = $row['BasicMonthlySalary'];
		$this->ThirdParties->DbValue = $row['ThirdParties'];
		$this->PayrollCode->DbValue = $row['PayrollCode'];
		$this->DateOfConfirmation->DbValue = $row['DateOfConfirmation'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`EmployeeID` = @EmployeeID@ AND `SubstantivePosition` = @SubstantivePosition@";
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
			$val = array_key_exists('SubstantivePosition', $row) ? $row['SubstantivePosition'] : NULL;
		else
			$val = $this->SubstantivePosition->OldValue !== NULL ? $this->SubstantivePosition->OldValue : $this->SubstantivePosition->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@SubstantivePosition@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "employmentlist.php";
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
		if ($pageName == "employmentview.php")
			return $Language->phrase("View");
		elseif ($pageName == "employmentedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "employmentadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "employmentlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("employmentview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("employmentview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "employmentadd.php?" . $this->getUrlParm($parm);
		else
			$url = "employmentadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("employmentedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("employmentedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("employmentadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("employmentadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("employmentdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "position_ref" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_PositionCode=" . urlencode($this->SubstantivePosition->CurrentValue);
			$url .= "&fk_SectionCode=" . urlencode($this->SectionCode->CurrentValue);
			$url .= "&fk_DepartmentCode=" . urlencode($this->DepartmentCode->CurrentValue);
			$url .= "&fk_LACode=" . urlencode($this->LACode->CurrentValue);
			$url .= "&fk_ProvinceCode=" . urlencode($this->ProvinceCode->CurrentValue);
			$url .= "&fk_SalaryScale=" . urlencode($this->SalaryScale->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "staff" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "EmployeeID:" . JsonEncode($this->EmployeeID->CurrentValue, "number");
		$json .= ",SubstantivePosition:" . JsonEncode($this->SubstantivePosition->CurrentValue, "number");
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
		if ($this->SubstantivePosition->CurrentValue != NULL) {
			$url .= "&SubstantivePosition=" . urlencode($this->SubstantivePosition->CurrentValue);
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
			if (Param("SubstantivePosition") !== NULL)
				$arKey[] = Param("SubstantivePosition");
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
				if (!is_numeric($key[1])) // SubstantivePosition
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
				$this->SubstantivePosition->CurrentValue = $key[1];
			else
				$this->SubstantivePosition->OldValue = $key[1];
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
		$this->ProvinceCode->setDbValue($rs->fields('ProvinceCode'));
		$this->LACode->setDbValue($rs->fields('LACode'));
		$this->DepartmentCode->setDbValue($rs->fields('DepartmentCode'));
		$this->SectionCode->setDbValue($rs->fields('SectionCode'));
		$this->SubstantivePosition->setDbValue($rs->fields('SubstantivePosition'));
		$this->DateOfCurrentAppointment->setDbValue($rs->fields('DateOfCurrentAppointment'));
		$this->LastAppraisalDate->setDbValue($rs->fields('LastAppraisalDate'));
		$this->AppraisalStatus->setDbValue($rs->fields('AppraisalStatus'));
		$this->DateOfExit->setDbValue($rs->fields('DateOfExit'));
		$this->SalaryScale->setDbValue($rs->fields('SalaryScale'));
		$this->EmploymentType->setDbValue($rs->fields('EmploymentType'));
		$this->EmploymentStatus->setDbValue($rs->fields('EmploymentStatus'));
		$this->ExitReason->setDbValue($rs->fields('ExitReason'));
		$this->RetirementType->setDbValue($rs->fields('RetirementType'));
		$this->EmployeeNumber->setDbValue($rs->fields('EmployeeNumber'));
		$this->SalaryNotch->setDbValue($rs->fields('SalaryNotch'));
		$this->BasicMonthlySalary->setDbValue($rs->fields('BasicMonthlySalary'));
		$this->ThirdParties->setDbValue($rs->fields('ThirdParties'));
		$this->PayrollCode->setDbValue($rs->fields('PayrollCode'));
		$this->DateOfConfirmation->setDbValue($rs->fields('DateOfConfirmation'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// EmployeeID
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// SubstantivePosition
		// DateOfCurrentAppointment
		// LastAppraisalDate
		// AppraisalStatus
		// DateOfExit
		// SalaryScale
		// EmploymentType
		// EmploymentStatus
		// ExitReason
		// RetirementType
		// EmployeeNumber
		// SalaryNotch
		// BasicMonthlySalary
		// ThirdParties
		// PayrollCode
		// DateOfConfirmation
		// EmployeeID

		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewCustomAttributes = "";

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

		// SubstantivePosition
		$curVal = strval($this->SubstantivePosition->CurrentValue);
		if ($curVal != "") {
			$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
			if ($this->SubstantivePosition->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SubstantivePosition->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
				}
			}
		} else {
			$this->SubstantivePosition->ViewValue = NULL;
		}
		$this->SubstantivePosition->ViewCustomAttributes = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
		$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
		$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

		// LastAppraisalDate
		$this->LastAppraisalDate->ViewValue = $this->LastAppraisalDate->CurrentValue;
		$this->LastAppraisalDate->ViewValue = FormatDateTime($this->LastAppraisalDate->ViewValue, 0);
		$this->LastAppraisalDate->ViewCustomAttributes = "";

		// AppraisalStatus
		$curVal = strval($this->AppraisalStatus->CurrentValue);
		if ($curVal != "") {
			$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
			if ($this->AppraisalStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AppraisalStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->AppraisalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->CurrentValue;
				}
			}
		} else {
			$this->AppraisalStatus->ViewValue = NULL;
		}
		$this->AppraisalStatus->ViewCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
		$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
		$this->DateOfExit->ViewCustomAttributes = "";

		// SalaryScale
		$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
		$curVal = strval($this->SalaryScale->CurrentValue);
		if ($curVal != "") {
			$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
			if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
				}
			}
		} else {
			$this->SalaryScale->ViewValue = NULL;
		}
		$this->SalaryScale->ViewCustomAttributes = "";

		// EmploymentType
		$curVal = strval($this->EmploymentType->CurrentValue);
		if ($curVal != "") {
			$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
			if ($this->EmploymentType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`EmploymentType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->EmploymentType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->EmploymentType->ViewValue = $this->EmploymentType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->EmploymentType->ViewValue = $this->EmploymentType->CurrentValue;
				}
			}
		} else {
			$this->EmploymentType->ViewValue = NULL;
		}
		$this->EmploymentType->ViewCustomAttributes = "";

		// EmploymentStatus
		$curVal = strval($this->EmploymentStatus->CurrentValue);
		if ($curVal != "") {
			$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
			if ($this->EmploymentStatus->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`EmploymentStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->EmploymentStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->CurrentValue;
				}
			}
		} else {
			$this->EmploymentStatus->ViewValue = NULL;
		}
		$this->EmploymentStatus->ViewCustomAttributes = "";

		// ExitReason
		$curVal = strval($this->ExitReason->CurrentValue);
		if ($curVal != "") {
			$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
			if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ExitCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ExitReason->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ExitReason->ViewValue = $this->ExitReason->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
				}
			}
		} else {
			$this->ExitReason->ViewValue = NULL;
		}
		$this->ExitReason->ViewCustomAttributes = "";

		// RetirementType
		$curVal = strval($this->RetirementType->CurrentValue);
		if ($curVal != "") {
			$this->RetirementType->ViewValue = $this->RetirementType->lookupCacheOption($curVal);
			if ($this->RetirementType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`RetirementCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->RetirementType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RetirementType->ViewValue = $this->RetirementType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RetirementType->ViewValue = $this->RetirementType->CurrentValue;
				}
			}
		} else {
			$this->RetirementType->ViewValue = NULL;
		}
		$this->RetirementType->ViewCustomAttributes = "";

		// EmployeeNumber
		$this->EmployeeNumber->ViewValue = $this->EmployeeNumber->CurrentValue;
		$this->EmployeeNumber->ViewCustomAttributes = "";

		// SalaryNotch
		$curVal = strval($this->SalaryNotch->CurrentValue);
		if ($curVal != "") {
			$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
			if ($this->SalaryNotch->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Notch`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->SalaryNotch->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2);
					$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SalaryNotch->ViewValue = $this->SalaryNotch->CurrentValue;
				}
			}
		} else {
			$this->SalaryNotch->ViewValue = NULL;
		}
		$this->SalaryNotch->ViewCustomAttributes = "";

		// BasicMonthlySalary
		$this->BasicMonthlySalary->ViewValue = $this->BasicMonthlySalary->CurrentValue;
		$this->BasicMonthlySalary->ViewValue = FormatNumber($this->BasicMonthlySalary->ViewValue, 2, -2, -2, -2);
		$this->BasicMonthlySalary->ViewCustomAttributes = "";

		// ThirdParties
		$curVal = strval($this->ThirdParties->CurrentValue);
		if ($curVal != "") {
			$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			if ($this->ThirdParties->ViewValue === NULL) { // Lookup from database
				$arwrk = explode(",", $curVal);
				$filterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($filterWrk != "")
						$filterWrk .= " OR ";
					$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ThirdParties->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ThirdParties->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->Close();
				} else {
					$this->ThirdParties->ViewValue = $this->ThirdParties->CurrentValue;
				}
			}
		} else {
			$this->ThirdParties->ViewValue = NULL;
		}
		$this->ThirdParties->ViewCustomAttributes = "";

		// PayrollCode
		$this->PayrollCode->ViewValue = $this->PayrollCode->CurrentValue;
		$this->PayrollCode->ViewValue = FormatNumber($this->PayrollCode->ViewValue, 0, -2, -2, -2);
		$this->PayrollCode->ViewCustomAttributes = "";

		// DateOfConfirmation
		$this->DateOfConfirmation->ViewValue = $this->DateOfConfirmation->CurrentValue;
		$this->DateOfConfirmation->ViewValue = FormatDateTime($this->DateOfConfirmation->ViewValue, 0);
		$this->DateOfConfirmation->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// ProvinceCode
		$this->ProvinceCode->LinkCustomAttributes = "";
		$this->ProvinceCode->HrefValue = "";
		$this->ProvinceCode->TooltipValue = "";

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

		// SubstantivePosition
		$this->SubstantivePosition->LinkCustomAttributes = "";
		$this->SubstantivePosition->HrefValue = "";
		$this->SubstantivePosition->TooltipValue = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
		$this->DateOfCurrentAppointment->HrefValue = "";
		$this->DateOfCurrentAppointment->TooltipValue = "";

		// LastAppraisalDate
		$this->LastAppraisalDate->LinkCustomAttributes = "";
		$this->LastAppraisalDate->HrefValue = "";
		$this->LastAppraisalDate->TooltipValue = "";

		// AppraisalStatus
		$this->AppraisalStatus->LinkCustomAttributes = "";
		$this->AppraisalStatus->HrefValue = "";
		$this->AppraisalStatus->TooltipValue = "";

		// DateOfExit
		$this->DateOfExit->LinkCustomAttributes = "";
		$this->DateOfExit->HrefValue = "";
		$this->DateOfExit->TooltipValue = "";

		// SalaryScale
		$this->SalaryScale->LinkCustomAttributes = "";
		$this->SalaryScale->HrefValue = "";
		$this->SalaryScale->TooltipValue = "";

		// EmploymentType
		$this->EmploymentType->LinkCustomAttributes = "";
		$this->EmploymentType->HrefValue = "";
		$this->EmploymentType->TooltipValue = "";

		// EmploymentStatus
		$this->EmploymentStatus->LinkCustomAttributes = "";
		$this->EmploymentStatus->HrefValue = "";
		$this->EmploymentStatus->TooltipValue = "";

		// ExitReason
		$this->ExitReason->LinkCustomAttributes = "";
		$this->ExitReason->HrefValue = "";
		$this->ExitReason->TooltipValue = "";

		// RetirementType
		$this->RetirementType->LinkCustomAttributes = "";
		$this->RetirementType->HrefValue = "";
		$this->RetirementType->TooltipValue = "";

		// EmployeeNumber
		$this->EmployeeNumber->LinkCustomAttributes = "";
		$this->EmployeeNumber->HrefValue = "";
		$this->EmployeeNumber->TooltipValue = "";

		// SalaryNotch
		$this->SalaryNotch->LinkCustomAttributes = "";
		$this->SalaryNotch->HrefValue = "";
		$this->SalaryNotch->TooltipValue = "";

		// BasicMonthlySalary
		$this->BasicMonthlySalary->LinkCustomAttributes = "";
		$this->BasicMonthlySalary->HrefValue = "";
		$this->BasicMonthlySalary->TooltipValue = "";

		// ThirdParties
		$this->ThirdParties->LinkCustomAttributes = "";
		$this->ThirdParties->HrefValue = "";
		$this->ThirdParties->TooltipValue = "";

		// PayrollCode
		$this->PayrollCode->LinkCustomAttributes = "";
		$this->PayrollCode->HrefValue = "";
		$this->PayrollCode->TooltipValue = "";

		// DateOfConfirmation
		$this->DateOfConfirmation->LinkCustomAttributes = "";
		$this->DateOfConfirmation->HrefValue = "";
		$this->DateOfConfirmation->TooltipValue = "";

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

		// ProvinceCode
		$this->ProvinceCode->EditAttrs["class"] = "form-control";
		$this->ProvinceCode->EditCustomAttributes = "";
		if ($this->ProvinceCode->getSessionValue() != "") {
			$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
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
		} else {
		}

		// LACode
		$this->LACode->EditAttrs["class"] = "form-control";
		$this->LACode->EditCustomAttributes = "";
		if ($this->LACode->getSessionValue() != "") {
			$this->LACode->CurrentValue = $this->LACode->getSessionValue();
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
		if ($this->SectionCode->getSessionValue() != "") {
			$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
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
		} else {
		}

		// SubstantivePosition
		$this->SubstantivePosition->EditAttrs["class"] = "form-control";
		$this->SubstantivePosition->EditCustomAttributes = "";

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
		$this->DateOfCurrentAppointment->EditCustomAttributes = "";
		$this->DateOfCurrentAppointment->EditValue = FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8);
		$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

		// LastAppraisalDate
		$this->LastAppraisalDate->EditAttrs["class"] = "form-control";
		$this->LastAppraisalDate->EditCustomAttributes = "";
		$this->LastAppraisalDate->EditValue = FormatDateTime($this->LastAppraisalDate->CurrentValue, 8);
		$this->LastAppraisalDate->PlaceHolder = RemoveHtml($this->LastAppraisalDate->caption());

		// AppraisalStatus
		$this->AppraisalStatus->EditAttrs["class"] = "form-control";
		$this->AppraisalStatus->EditCustomAttributes = "";

		// DateOfExit
		$this->DateOfExit->EditAttrs["class"] = "form-control";
		$this->DateOfExit->EditCustomAttributes = "";
		$this->DateOfExit->EditValue = FormatDateTime($this->DateOfExit->CurrentValue, 8);
		$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

		// SalaryScale
		$this->SalaryScale->EditAttrs["class"] = "form-control";
		$this->SalaryScale->EditCustomAttributes = "";
		if ($this->SalaryScale->getSessionValue() != "") {
			$this->SalaryScale->CurrentValue = $this->SalaryScale->getSessionValue();
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$curVal = strval($this->SalaryScale->CurrentValue);
			if ($curVal != "") {
				$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
				if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
					}
				}
			} else {
				$this->SalaryScale->ViewValue = NULL;
			}
			$this->SalaryScale->ViewCustomAttributes = "";
		} else {
			if (!$this->SalaryScale->Raw)
				$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->EditValue = $this->SalaryScale->CurrentValue;
			$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());
		}

		// EmploymentType
		$this->EmploymentType->EditAttrs["class"] = "form-control";
		$this->EmploymentType->EditCustomAttributes = "";

		// EmploymentStatus
		$this->EmploymentStatus->EditAttrs["class"] = "form-control";
		$this->EmploymentStatus->EditCustomAttributes = "";

		// ExitReason
		$this->ExitReason->EditAttrs["class"] = "form-control";
		$this->ExitReason->EditCustomAttributes = "";

		// RetirementType
		$this->RetirementType->EditAttrs["class"] = "form-control";
		$this->RetirementType->EditCustomAttributes = "";

		// EmployeeNumber
		$this->EmployeeNumber->EditAttrs["class"] = "form-control";
		$this->EmployeeNumber->EditCustomAttributes = "";
		if (!$this->EmployeeNumber->Raw)
			$this->EmployeeNumber->CurrentValue = HtmlDecode($this->EmployeeNumber->CurrentValue);
		$this->EmployeeNumber->EditValue = $this->EmployeeNumber->CurrentValue;
		$this->EmployeeNumber->PlaceHolder = RemoveHtml($this->EmployeeNumber->caption());

		// SalaryNotch
		$this->SalaryNotch->EditAttrs["class"] = "form-control";
		$this->SalaryNotch->EditCustomAttributes = "";

		// BasicMonthlySalary
		$this->BasicMonthlySalary->EditAttrs["class"] = "form-control";
		$this->BasicMonthlySalary->EditCustomAttributes = "";
		$this->BasicMonthlySalary->EditValue = $this->BasicMonthlySalary->CurrentValue;
		$this->BasicMonthlySalary->PlaceHolder = RemoveHtml($this->BasicMonthlySalary->caption());
		if (strval($this->BasicMonthlySalary->EditValue) != "" && is_numeric($this->BasicMonthlySalary->EditValue))
			$this->BasicMonthlySalary->EditValue = FormatNumber($this->BasicMonthlySalary->EditValue, -2, -2, -2, -2);
		

		// ThirdParties
		$this->ThirdParties->EditCustomAttributes = "";

		// PayrollCode
		$this->PayrollCode->EditAttrs["class"] = "form-control";
		$this->PayrollCode->EditCustomAttributes = "";
		$this->PayrollCode->EditValue = $this->PayrollCode->CurrentValue;
		$this->PayrollCode->PlaceHolder = RemoveHtml($this->PayrollCode->caption());

		// DateOfConfirmation
		$this->DateOfConfirmation->EditAttrs["class"] = "form-control";
		$this->DateOfConfirmation->EditCustomAttributes = "";
		$this->DateOfConfirmation->EditValue = FormatDateTime($this->DateOfConfirmation->CurrentValue, 8);
		$this->DateOfConfirmation->PlaceHolder = RemoveHtml($this->DateOfConfirmation->caption());

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
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->SubstantivePosition);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->LastAppraisalDate);
					$doc->exportCaption($this->AppraisalStatus);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->EmploymentType);
					$doc->exportCaption($this->EmploymentStatus);
					$doc->exportCaption($this->EmployeeNumber);
					$doc->exportCaption($this->SalaryNotch);
					$doc->exportCaption($this->BasicMonthlySalary);
					$doc->exportCaption($this->ThirdParties);
					$doc->exportCaption($this->PayrollCode);
					$doc->exportCaption($this->DateOfConfirmation);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->ProvinceCode);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->DepartmentCode);
					$doc->exportCaption($this->SectionCode);
					$doc->exportCaption($this->SubstantivePosition);
					$doc->exportCaption($this->DateOfCurrentAppointment);
					$doc->exportCaption($this->LastAppraisalDate);
					$doc->exportCaption($this->AppraisalStatus);
					$doc->exportCaption($this->DateOfExit);
					$doc->exportCaption($this->SalaryScale);
					$doc->exportCaption($this->EmploymentType);
					$doc->exportCaption($this->EmploymentStatus);
					$doc->exportCaption($this->ExitReason);
					$doc->exportCaption($this->RetirementType);
					$doc->exportCaption($this->EmployeeNumber);
					$doc->exportCaption($this->SalaryNotch);
					$doc->exportCaption($this->BasicMonthlySalary);
					$doc->exportCaption($this->ThirdParties);
					$doc->exportCaption($this->PayrollCode);
					$doc->exportCaption($this->DateOfConfirmation);
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
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->SubstantivePosition);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->LastAppraisalDate);
						$doc->exportField($this->AppraisalStatus);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->EmploymentType);
						$doc->exportField($this->EmploymentStatus);
						$doc->exportField($this->EmployeeNumber);
						$doc->exportField($this->SalaryNotch);
						$doc->exportField($this->BasicMonthlySalary);
						$doc->exportField($this->ThirdParties);
						$doc->exportField($this->PayrollCode);
						$doc->exportField($this->DateOfConfirmation);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->ProvinceCode);
						$doc->exportField($this->LACode);
						$doc->exportField($this->DepartmentCode);
						$doc->exportField($this->SectionCode);
						$doc->exportField($this->SubstantivePosition);
						$doc->exportField($this->DateOfCurrentAppointment);
						$doc->exportField($this->LastAppraisalDate);
						$doc->exportField($this->AppraisalStatus);
						$doc->exportField($this->DateOfExit);
						$doc->exportField($this->SalaryScale);
						$doc->exportField($this->EmploymentType);
						$doc->exportField($this->EmploymentStatus);
						$doc->exportField($this->ExitReason);
						$doc->exportField($this->RetirementType);
						$doc->exportField($this->EmployeeNumber);
						$doc->exportField($this->SalaryNotch);
						$doc->exportField($this->BasicMonthlySalary);
						$doc->exportField($this->ThirdParties);
						$doc->exportField($this->PayrollCode);
						$doc->exportField($this->DateOfConfirmation);
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
		$table = 'employment';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'employment';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['SubstantivePosition'];

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
		$table = 'employment';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['SubstantivePosition'];

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
		$table = 'employment';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['SubstantivePosition'];

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
		$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$userid = CurrentUserID();
		if ($levelid <> -1) {
			$row = executeRow("select * from musers where username = '" . $username . "'");
			$prv = $row["ProvinceCode"];
			$la = $row["LACode"];
			}

		//set filter for province
		$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
		AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT security_matrix.ProvinceCode
		from security_matrix, musers                            
		where security_matrix.usercode = musers.usercode 
		and musers.username = '" . $username .  
		"')  ");  }

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

		$empid = $rsnew["EmployeeID"];
		$curapp = $rsnew["DateOfCurrentAppointment"];
	 	$row = executeRow("select DATE_ADD(DateOfBirth,
		INTERVAL 60 YEAR) as ExitDate from staff where employeeID = '" . $empid . "'");
		$rsnew["DateOfExit"] = $row["ExitDate"];
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"

	/*	$emp = $rsnew["EmployeeID"];
		execute("insert into leave_record(EmployeeID,LeaveTypeCode)
		values( '" . $emp . "', " . 1 . "); */
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

	/*	$username = CurrentUserName(); 
		$levelid = CurrentUserLevel();
		$prov = executeRow("select count(security_matrix.ProvinceCode)as kountprov 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.ProvinceCode is not null  
		and musers.username = '" . $username .     "'  ");
		if ($fld->Name == "ProvinceCode") {
			if(($levelid <> -1) && ($prov["kountprov"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`ProvinceCode`  in   (select DISTINCT ProvinceCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set lookup filter for local authority
		$la = executeRow("select count(security_matrix.LACode)as kountla 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.LACode is not null  
		and musers.username = '" . $username .     "'  ");
		if ($fld->Name == "LACode") {
			if(($levelid <> -1) && ($la["kountla"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`LACode`  in   (select DISTINCT LACode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set filter for departments in LA	
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");
			if ($fld->FldName == "Department") {
			if(($levelid <> -1) && ($dept["kountdept"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`DepartmentCode`  in   (select DISTINCT DepartmentCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		}
		//set filter for sections
		$sect = executeRow("select count(security_matrix.SectionCode)as kountsect 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.SectionCode is not null  
		and musers.username = '" . $username .     "'  ");
			if ($fld->FldName == "SectionCode") {
			if(($levelid <> -1) && ($sect["kountsect"] > 0)) {				//levelid -1 is for admin
			AddFilter($filter,"`SectionCode`  in   (select DISTINCT SectionCode
			from security_matrix, musers                            
			where security_matrix.usercode = musers.usercode 
			and musers.username = '" . $username .  
			"')  ");
			}
		} */
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