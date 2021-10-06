<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for Training Report
 */
class Training_Report extends ReportTable
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
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;

	// Fields
	public $FormerFileNumber;
	public $NRC;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $Sex;
	public $MaritalStatus;
	public $DateOfBirth;
	public $AcademicQualification;
	public $ProfessionalQualification;
	public $MedicalCondition;
	public $OtherMedicalConditions;
	public $PhysicalChallenge;
	public $ProvinceCode;
	public $LACode;
	public $DepartmentCode;
	public $SectionCode;
	public $SubstantivePosition;
	public $DateOfCurrentAppointment;
	public $YearsOfService;
	public $DateOfExit;
	public $SalaryScale;
	public $EmploymentType;
	public $EmploymentStatus;
	public $CouncilType;
	public $FundingSource;
	public $TrainingCost;
	public $ActualStartDate;
	public $TrainingType;
	public $FieldOfTraining;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Training_Report';
		$this->TableName = 'Training Report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`training_view`";
		$this->ReportSourceTable = 'training_view'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// FormerFileNumber
		$this->FormerFileNumber = new ReportField('Training_Report', 'Training Report', 'x_FormerFileNumber', 'FormerFileNumber', '`FormerFileNumber`', '`FormerFileNumber`', 200, 13, -1, FALSE, '`FormerFileNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FormerFileNumber->Sortable = TRUE; // Allow sort
		$this->FormerFileNumber->SourceTableVar = 'training_view';
		$this->fields['FormerFileNumber'] = &$this->FormerFileNumber;

		// NRC
		$this->NRC = new ReportField('Training_Report', 'Training Report', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->NRC->SourceTableVar = 'training_view';
		$this->fields['NRC'] = &$this->NRC;

		// Title
		$this->Title = new ReportField('Training_Report', 'Training Report', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->Title->SourceTableVar = 'training_view';
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new ReportField('Training_Report', 'Training Report', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->Surname->SourceTableVar = 'training_view';
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new ReportField('Training_Report', 'Training Report', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->FirstName->SourceTableVar = 'training_view';
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new ReportField('Training_Report', 'Training Report', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->MiddleName->SourceTableVar = 'training_view';
		$this->fields['MiddleName'] = &$this->MiddleName;

		// Sex
		$this->Sex = new ReportField('Training_Report', 'Training Report', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->Sex->SourceTableVar = 'training_view';
		$this->fields['Sex'] = &$this->Sex;

		// MaritalStatus
		$this->MaritalStatus = new ReportField('Training_Report', 'Training Report', 'x_MaritalStatus', 'MaritalStatus', '`MaritalStatus`', '`MaritalStatus`', 16, 3, -1, FALSE, '`MaritalStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MaritalStatus->Nullable = FALSE; // NOT NULL field
		$this->MaritalStatus->Required = TRUE; // Required field
		$this->MaritalStatus->Sortable = TRUE; // Allow sort
		$this->MaritalStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->MaritalStatus->SourceTableVar = 'training_view';
		$this->fields['MaritalStatus'] = &$this->MaritalStatus;

		// DateOfBirth
		$this->DateOfBirth = new ReportField('Training_Report', 'Training Report', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Nullable = FALSE; // NOT NULL field
		$this->DateOfBirth->Required = TRUE; // Required field
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->DateOfBirth->SourceTableVar = 'training_view';
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// AcademicQualification
		$this->AcademicQualification = new ReportField('Training_Report', 'Training Report', 'x_AcademicQualification', 'AcademicQualification', '`AcademicQualification`', '`AcademicQualification`', 200, 100, -1, FALSE, '`AcademicQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AcademicQualification->Sortable = TRUE; // Allow sort
		$this->AcademicQualification->SourceTableVar = 'training_view';
		$this->fields['AcademicQualification'] = &$this->AcademicQualification;

		// ProfessionalQualification
		$this->ProfessionalQualification = new ReportField('Training_Report', 'Training Report', 'x_ProfessionalQualification', 'ProfessionalQualification', '`ProfessionalQualification`', '`ProfessionalQualification`', 200, 255, -1, FALSE, '`ProfessionalQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProfessionalQualification->Sortable = TRUE; // Allow sort
		$this->ProfessionalQualification->SourceTableVar = 'training_view';
		$this->fields['ProfessionalQualification'] = &$this->ProfessionalQualification;

		// MedicalCondition
		$this->MedicalCondition = new ReportField('Training_Report', 'Training Report', 'x_MedicalCondition', 'MedicalCondition', '`MedicalCondition`', '`MedicalCondition`', 200, 255, -1, FALSE, '`MedicalCondition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MedicalCondition->Sortable = TRUE; // Allow sort
		$this->MedicalCondition->SourceTableVar = 'training_view';
		$this->fields['MedicalCondition'] = &$this->MedicalCondition;

		// OtherMedicalConditions
		$this->OtherMedicalConditions = new ReportField('Training_Report', 'Training Report', 'x_OtherMedicalConditions', 'OtherMedicalConditions', '`OtherMedicalConditions`', '`OtherMedicalConditions`', 200, 255, -1, FALSE, '`OtherMedicalConditions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OtherMedicalConditions->Sortable = TRUE; // Allow sort
		$this->OtherMedicalConditions->SourceTableVar = 'training_view';
		$this->fields['OtherMedicalConditions'] = &$this->OtherMedicalConditions;

		// PhysicalChallenge
		$this->PhysicalChallenge = new ReportField('Training_Report', 'Training Report', 'x_PhysicalChallenge', 'PhysicalChallenge', '`PhysicalChallenge`', '`PhysicalChallenge`', 200, 255, -1, FALSE, '`PhysicalChallenge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PhysicalChallenge->Sortable = TRUE; // Allow sort
		$this->PhysicalChallenge->SourceTableVar = 'training_view';
		$this->fields['PhysicalChallenge'] = &$this->PhysicalChallenge;

		// ProvinceCode
		$this->ProvinceCode = new ReportField('Training_Report', 'Training Report', 'x_ProvinceCode', 'ProvinceCode', '`ProvinceCode`', '`ProvinceCode`', 16, 4, -1, FALSE, '`ProvinceCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ProvinceCode->Sortable = TRUE; // Allow sort
		$this->ProvinceCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->ProvinceCode->SourceTableVar = 'training_view';
		$this->fields['ProvinceCode'] = &$this->ProvinceCode;

		// LACode
		$this->LACode = new ReportField('Training_Report', 'Training Report', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->SourceTableVar = 'training_view';
		$this->fields['LACode'] = &$this->LACode;

		// DepartmentCode
		$this->DepartmentCode = new ReportField('Training_Report', 'Training Report', 'x_DepartmentCode', 'DepartmentCode', '`DepartmentCode`', '`DepartmentCode`', 3, 11, -1, FALSE, '`DepartmentCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentCode->Sortable = TRUE; // Allow sort
		$this->DepartmentCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->DepartmentCode->SourceTableVar = 'training_view';
		$this->fields['DepartmentCode'] = &$this->DepartmentCode;

		// SectionCode
		$this->SectionCode = new ReportField('Training_Report', 'Training Report', 'x_SectionCode', 'SectionCode', '`SectionCode`', '`SectionCode`', 3, 11, -1, FALSE, '`SectionCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SectionCode->Sortable = TRUE; // Allow sort
		$this->SectionCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->SectionCode->SourceTableVar = 'training_view';
		$this->fields['SectionCode'] = &$this->SectionCode;

		// SubstantivePosition
		$this->SubstantivePosition = new ReportField('Training_Report', 'Training Report', 'x_SubstantivePosition', 'SubstantivePosition', '`SubstantivePosition`', '`SubstantivePosition`', 3, 11, -1, FALSE, '`SubstantivePosition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SubstantivePosition->IsPrimaryKey = TRUE; // Primary key field
		$this->SubstantivePosition->Nullable = FALSE; // NOT NULL field
		$this->SubstantivePosition->Required = TRUE; // Required field
		$this->SubstantivePosition->Sortable = TRUE; // Allow sort
		$this->SubstantivePosition->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->SubstantivePosition->SourceTableVar = 'training_view';
		$this->fields['SubstantivePosition'] = &$this->SubstantivePosition;

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment = new ReportField('Training_Report', 'Training Report', 'x_DateOfCurrentAppointment', 'DateOfCurrentAppointment', '`DateOfCurrentAppointment`', CastDateFieldForLike("`DateOfCurrentAppointment`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfCurrentAppointment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfCurrentAppointment->Nullable = FALSE; // NOT NULL field
		$this->DateOfCurrentAppointment->Required = TRUE; // Required field
		$this->DateOfCurrentAppointment->Sortable = TRUE; // Allow sort
		$this->DateOfCurrentAppointment->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->DateOfCurrentAppointment->SourceTableVar = 'training_view';
		$this->fields['DateOfCurrentAppointment'] = &$this->DateOfCurrentAppointment;

		// YearsOfService
		$this->YearsOfService = new ReportField('Training_Report', 'Training Report', 'x_YearsOfService', 'YearsOfService', '`YearsOfService`', '`YearsOfService`', 20, 21, -1, FALSE, '`YearsOfService`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->YearsOfService->Sortable = TRUE; // Allow sort
		$this->YearsOfService->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->YearsOfService->SourceTableVar = 'training_view';
		$this->fields['YearsOfService'] = &$this->YearsOfService;

		// DateOfExit
		$this->DateOfExit = new ReportField('Training_Report', 'Training Report', 'x_DateOfExit', 'DateOfExit', '`DateOfExit`', CastDateFieldForLike("`DateOfExit`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfExit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfExit->Sortable = TRUE; // Allow sort
		$this->DateOfExit->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->DateOfExit->SourceTableVar = 'training_view';
		$this->fields['DateOfExit'] = &$this->DateOfExit;

		// SalaryScale
		$this->SalaryScale = new ReportField('Training_Report', 'Training Report', 'x_SalaryScale', 'SalaryScale', '`SalaryScale`', '`SalaryScale`', 200, 10, -1, FALSE, '`SalaryScale`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SalaryScale->Nullable = FALSE; // NOT NULL field
		$this->SalaryScale->Required = TRUE; // Required field
		$this->SalaryScale->Sortable = TRUE; // Allow sort
		$this->SalaryScale->SourceTableVar = 'training_view';
		$this->fields['SalaryScale'] = &$this->SalaryScale;

		// EmploymentType
		$this->EmploymentType = new ReportField('Training_Report', 'Training Report', 'x_EmploymentType', 'EmploymentType', '`EmploymentType`', '`EmploymentType`', 16, 3, -1, FALSE, '`EmploymentType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmploymentType->Nullable = FALSE; // NOT NULL field
		$this->EmploymentType->Required = TRUE; // Required field
		$this->EmploymentType->Sortable = TRUE; // Allow sort
		$this->EmploymentType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->EmploymentType->SourceTableVar = 'training_view';
		$this->fields['EmploymentType'] = &$this->EmploymentType;

		// EmploymentStatus
		$this->EmploymentStatus = new ReportField('Training_Report', 'Training Report', 'x_EmploymentStatus', 'EmploymentStatus', '`EmploymentStatus`', '`EmploymentStatus`', 16, 3, -1, FALSE, '`EmploymentStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmploymentStatus->Nullable = FALSE; // NOT NULL field
		$this->EmploymentStatus->Required = TRUE; // Required field
		$this->EmploymentStatus->Sortable = TRUE; // Allow sort
		$this->EmploymentStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->EmploymentStatus->SourceTableVar = 'training_view';
		$this->fields['EmploymentStatus'] = &$this->EmploymentStatus;

		// CouncilType
		$this->CouncilType = new ReportField('Training_Report', 'Training Report', 'x_CouncilType', 'CouncilType', '`CouncilType`', '`CouncilType`', 16, 3, -1, FALSE, '`CouncilType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CouncilType->Sortable = TRUE; // Allow sort
		$this->CouncilType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->CouncilType->SourceTableVar = 'training_view';
		$this->fields['CouncilType'] = &$this->CouncilType;

		// FundingSource
		$this->FundingSource = new ReportField('Training_Report', 'Training Report', 'x_FundingSource', 'FundingSource', '`FundingSource`', '`FundingSource`', 200, 50, -1, FALSE, '`FundingSource`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FundingSource->Sortable = TRUE; // Allow sort
		$this->FundingSource->SourceTableVar = 'training_view';
		$this->fields['FundingSource'] = &$this->FundingSource;

		// TrainingCost
		$this->TrainingCost = new ReportField('Training_Report', 'Training Report', 'x_TrainingCost', 'TrainingCost', '`TrainingCost`', '`TrainingCost`', 5, 22, -1, FALSE, '`TrainingCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TrainingCost->Sortable = TRUE; // Allow sort
		$this->TrainingCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->TrainingCost->SourceTableVar = 'training_view';
		$this->fields['TrainingCost'] = &$this->TrainingCost;

		// ActualStartDate
		$this->ActualStartDate = new ReportField('Training_Report', 'Training Report', 'x_ActualStartDate', 'ActualStartDate', '`ActualStartDate`', CastDateFieldForLike("`ActualStartDate`", 0, "DB"), 133, 10, 0, FALSE, '`ActualStartDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualStartDate->Sortable = TRUE; // Allow sort
		$this->ActualStartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->ActualStartDate->SourceTableVar = 'training_view';
		$this->fields['ActualStartDate'] = &$this->ActualStartDate;

		// TrainingType
		$this->TrainingType = new ReportField('Training_Report', 'Training Report', 'x_TrainingType', 'TrainingType', '`TrainingType`', '`TrainingType`', 16, 3, -1, FALSE, '`TrainingType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TrainingType->Nullable = FALSE; // NOT NULL field
		$this->TrainingType->Required = TRUE; // Required field
		$this->TrainingType->Sortable = TRUE; // Allow sort
		$this->TrainingType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->TrainingType->SourceTableVar = 'training_view';
		$this->fields['TrainingType'] = &$this->TrainingType;

		// FieldOfTraining
		$this->FieldOfTraining = new ReportField('Training_Report', 'Training Report', 'x_FieldOfTraining', 'FieldOfTraining', '`FieldOfTraining`', '`FieldOfTraining`', 16, 4, -1, FALSE, '`FieldOfTraining`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FieldOfTraining->Nullable = FALSE; // NOT NULL field
		$this->FieldOfTraining->Required = TRUE; // Required field
		$this->FieldOfTraining->Sortable = TRUE; // Allow sort
		$this->FieldOfTraining->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->FieldOfTraining->SourceTableVar = 'training_view';
		$this->fields['FieldOfTraining'] = &$this->FieldOfTraining;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
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
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix != "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix != "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount != "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Render for lookup
	public function renderLookup()
	{
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`training_view`";
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		return "SELECT " . $select . " FROM " . $this->getSqlFrom();
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

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`SubstantivePosition` = @SubstantivePosition@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "";
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
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "SubstantivePosition:" . JsonEncode($this->SubstantivePosition->CurrentValue, "number");
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
		if ($this->SubstantivePosition->CurrentValue != NULL) {
			$url .= "SubstantivePosition=" . urlencode($this->SubstantivePosition->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
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
			if (Param("SubstantivePosition") !== NULL)
				$arKeys[] = Param("SubstantivePosition");
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
				$this->SubstantivePosition->CurrentValue = $key;
			else
				$this->SubstantivePosition->OldValue = $key;
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

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
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