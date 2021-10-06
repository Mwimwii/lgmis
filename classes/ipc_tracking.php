<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for ipc_tracking
 */
class ipc_tracking extends DbTable
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
	public $IPCNo;
	public $ContractNo;
	public $ContractAuthorizedByAG;
	public $VATApplied;
	public $ArithmeticCheckDone;
	public $VariationsApproved;
	public $PerformanceBondValidUntil;
	public $AdvancePaymentBondValidUntil;
	public $RetentionDeductionClause;
	public $RetentionDeducted;
	public $LiquidatedDamagesDeducted;
	public $LiquidatedPenaltiesDeducted;
	public $AdvancedPaymentDeducted;
	public $CurrentProgressReportAttached;
	public $CurrentProgressReport;
	public $DateOfSiteInspection;
	public $TimeExtensionAuthorized;
	public $LabResultsChecked;
	public $LabResults;
	public $TerminationNoticeGiven;
	public $CopiesEmailedToMLG;
	public $ContractStillValid;
	public $DeskOfficer;
	public $DeskOfficerDate;
	public $SupervisingEngineer;
	public $EngineerDate;
	public $CouncilSecretary;
	public $CSDate;
	public $MLGComments;
	public $ContractType;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ipc_tracking';
		$this->TableName = 'ipc_tracking';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`ipc_tracking`";
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

		// IPCNo
		$this->IPCNo = new DbField('ipc_tracking', 'ipc_tracking', 'x_IPCNo', 'IPCNo', '`IPCNo`', '`IPCNo`', 3, 11, -1, FALSE, '`IPCNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->IPCNo->IsAutoIncrement = TRUE; // Autoincrement field
		$this->IPCNo->IsPrimaryKey = TRUE; // Primary key field
		$this->IPCNo->Sortable = TRUE; // Allow sort
		$this->IPCNo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IPCNo'] = &$this->IPCNo;

		// ContractNo
		$this->ContractNo = new DbField('ipc_tracking', 'ipc_tracking', 'x_ContractNo', 'ContractNo', '`ContractNo`', '`ContractNo`', 200, 25, -1, FALSE, '`ContractNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractNo->IsForeignKey = TRUE; // Foreign key field
		$this->ContractNo->Sortable = TRUE; // Allow sort
		$this->fields['ContractNo'] = &$this->ContractNo;

		// ContractAuthorizedByAG
		$this->ContractAuthorizedByAG = new DbField('ipc_tracking', 'ipc_tracking', 'x_ContractAuthorizedByAG', 'ContractAuthorizedByAG', '`ContractAuthorizedByAG`', '`ContractAuthorizedByAG`', 16, 1, -1, FALSE, '`ContractAuthorizedByAG`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ContractAuthorizedByAG->Sortable = TRUE; // Allow sort
		$this->ContractAuthorizedByAG->DataType = DATATYPE_BOOLEAN;
		$this->ContractAuthorizedByAG->Lookup = new Lookup('ContractAuthorizedByAG', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ContractAuthorizedByAG->OptionCount = 2;
		$this->ContractAuthorizedByAG->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['ContractAuthorizedByAG'] = &$this->ContractAuthorizedByAG;

		// VATApplied
		$this->VATApplied = new DbField('ipc_tracking', 'ipc_tracking', 'x_VATApplied', 'VATApplied', '`VATApplied`', '`VATApplied`', 16, 1, -1, FALSE, '`VATApplied`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->VATApplied->Sortable = TRUE; // Allow sort
		$this->VATApplied->DataType = DATATYPE_BOOLEAN;
		$this->VATApplied->Lookup = new Lookup('VATApplied', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->VATApplied->OptionCount = 2;
		$this->VATApplied->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['VATApplied'] = &$this->VATApplied;

		// ArithmeticCheckDone
		$this->ArithmeticCheckDone = new DbField('ipc_tracking', 'ipc_tracking', 'x_ArithmeticCheckDone', 'ArithmeticCheckDone', '`ArithmeticCheckDone`', '`ArithmeticCheckDone`', 16, 1, -1, FALSE, '`ArithmeticCheckDone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ArithmeticCheckDone->Sortable = TRUE; // Allow sort
		$this->ArithmeticCheckDone->DataType = DATATYPE_BOOLEAN;
		$this->ArithmeticCheckDone->Lookup = new Lookup('ArithmeticCheckDone', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ArithmeticCheckDone->OptionCount = 2;
		$this->ArithmeticCheckDone->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['ArithmeticCheckDone'] = &$this->ArithmeticCheckDone;

		// VariationsApproved
		$this->VariationsApproved = new DbField('ipc_tracking', 'ipc_tracking', 'x_VariationsApproved', 'VariationsApproved', '`VariationsApproved`', '`VariationsApproved`', 16, 1, -1, FALSE, '`VariationsApproved`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->VariationsApproved->Sortable = TRUE; // Allow sort
		$this->VariationsApproved->DataType = DATATYPE_BOOLEAN;
		$this->VariationsApproved->Lookup = new Lookup('VariationsApproved', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->VariationsApproved->OptionCount = 2;
		$this->VariationsApproved->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['VariationsApproved'] = &$this->VariationsApproved;

		// PerformanceBondValidUntil
		$this->PerformanceBondValidUntil = new DbField('ipc_tracking', 'ipc_tracking', 'x_PerformanceBondValidUntil', 'PerformanceBondValidUntil', '`PerformanceBondValidUntil`', CastDateFieldForLike("`PerformanceBondValidUntil`", 0, "DB"), 133, 10, 0, FALSE, '`PerformanceBondValidUntil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PerformanceBondValidUntil->Sortable = TRUE; // Allow sort
		$this->PerformanceBondValidUntil->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['PerformanceBondValidUntil'] = &$this->PerformanceBondValidUntil;

		// AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil = new DbField('ipc_tracking', 'ipc_tracking', 'x_AdvancePaymentBondValidUntil', 'AdvancePaymentBondValidUntil', '`AdvancePaymentBondValidUntil`', CastDateFieldForLike("`AdvancePaymentBondValidUntil`", 0, "DB"), 133, 10, 0, FALSE, '`AdvancePaymentBondValidUntil`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AdvancePaymentBondValidUntil->Sortable = TRUE; // Allow sort
		$this->AdvancePaymentBondValidUntil->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['AdvancePaymentBondValidUntil'] = &$this->AdvancePaymentBondValidUntil;

		// RetentionDeductionClause
		$this->RetentionDeductionClause = new DbField('ipc_tracking', 'ipc_tracking', 'x_RetentionDeductionClause', 'RetentionDeductionClause', '`RetentionDeductionClause`', '`RetentionDeductionClause`', 200, 255, -1, FALSE, '`RetentionDeductionClause`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RetentionDeductionClause->Sortable = TRUE; // Allow sort
		$this->fields['RetentionDeductionClause'] = &$this->RetentionDeductionClause;

		// RetentionDeducted
		$this->RetentionDeducted = new DbField('ipc_tracking', 'ipc_tracking', 'x_RetentionDeducted', 'RetentionDeducted', '`RetentionDeducted`', '`RetentionDeducted`', 16, 1, -1, FALSE, '`RetentionDeducted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->RetentionDeducted->Sortable = TRUE; // Allow sort
		$this->RetentionDeducted->DataType = DATATYPE_BOOLEAN;
		$this->RetentionDeducted->Lookup = new Lookup('RetentionDeducted', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->RetentionDeducted->OptionCount = 2;
		$this->RetentionDeducted->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['RetentionDeducted'] = &$this->RetentionDeducted;

		// LiquidatedDamagesDeducted
		$this->LiquidatedDamagesDeducted = new DbField('ipc_tracking', 'ipc_tracking', 'x_LiquidatedDamagesDeducted', 'LiquidatedDamagesDeducted', '`LiquidatedDamagesDeducted`', '`LiquidatedDamagesDeducted`', 16, 1, -1, FALSE, '`LiquidatedDamagesDeducted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->LiquidatedDamagesDeducted->Sortable = TRUE; // Allow sort
		$this->LiquidatedDamagesDeducted->DataType = DATATYPE_BOOLEAN;
		$this->LiquidatedDamagesDeducted->Lookup = new Lookup('LiquidatedDamagesDeducted', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LiquidatedDamagesDeducted->OptionCount = 2;
		$this->LiquidatedDamagesDeducted->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['LiquidatedDamagesDeducted'] = &$this->LiquidatedDamagesDeducted;

		// LiquidatedPenaltiesDeducted
		$this->LiquidatedPenaltiesDeducted = new DbField('ipc_tracking', 'ipc_tracking', 'x_LiquidatedPenaltiesDeducted', 'LiquidatedPenaltiesDeducted', '`LiquidatedPenaltiesDeducted`', '`LiquidatedPenaltiesDeducted`', 16, 1, -1, FALSE, '`LiquidatedPenaltiesDeducted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->LiquidatedPenaltiesDeducted->Sortable = TRUE; // Allow sort
		$this->LiquidatedPenaltiesDeducted->DataType = DATATYPE_BOOLEAN;
		$this->LiquidatedPenaltiesDeducted->Lookup = new Lookup('LiquidatedPenaltiesDeducted', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LiquidatedPenaltiesDeducted->OptionCount = 2;
		$this->LiquidatedPenaltiesDeducted->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['LiquidatedPenaltiesDeducted'] = &$this->LiquidatedPenaltiesDeducted;

		// AdvancedPaymentDeducted
		$this->AdvancedPaymentDeducted = new DbField('ipc_tracking', 'ipc_tracking', 'x_AdvancedPaymentDeducted', 'AdvancedPaymentDeducted', '`AdvancedPaymentDeducted`', '`AdvancedPaymentDeducted`', 16, 1, -1, FALSE, '`AdvancedPaymentDeducted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AdvancedPaymentDeducted->Sortable = TRUE; // Allow sort
		$this->AdvancedPaymentDeducted->DataType = DATATYPE_BOOLEAN;
		$this->AdvancedPaymentDeducted->Lookup = new Lookup('AdvancedPaymentDeducted', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AdvancedPaymentDeducted->OptionCount = 2;
		$this->AdvancedPaymentDeducted->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['AdvancedPaymentDeducted'] = &$this->AdvancedPaymentDeducted;

		// CurrentProgressReportAttached
		$this->CurrentProgressReportAttached = new DbField('ipc_tracking', 'ipc_tracking', 'x_CurrentProgressReportAttached', 'CurrentProgressReportAttached', '`CurrentProgressReportAttached`', '`CurrentProgressReportAttached`', 16, 1, -1, FALSE, '`CurrentProgressReportAttached`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->CurrentProgressReportAttached->Sortable = TRUE; // Allow sort
		$this->CurrentProgressReportAttached->DataType = DATATYPE_BOOLEAN;
		$this->CurrentProgressReportAttached->Lookup = new Lookup('CurrentProgressReportAttached', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->CurrentProgressReportAttached->OptionCount = 2;
		$this->CurrentProgressReportAttached->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['CurrentProgressReportAttached'] = &$this->CurrentProgressReportAttached;

		// CurrentProgressReport
		$this->CurrentProgressReport = new DbField('ipc_tracking', 'ipc_tracking', 'x_CurrentProgressReport', 'CurrentProgressReport', '`CurrentProgressReport`', '`CurrentProgressReport`', 205, 0, -1, TRUE, '`CurrentProgressReport`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->CurrentProgressReport->Sortable = TRUE; // Allow sort
		$this->fields['CurrentProgressReport'] = &$this->CurrentProgressReport;

		// DateOfSiteInspection
		$this->DateOfSiteInspection = new DbField('ipc_tracking', 'ipc_tracking', 'x_DateOfSiteInspection', 'DateOfSiteInspection', '`DateOfSiteInspection`', CastDateFieldForLike("`DateOfSiteInspection`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfSiteInspection`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfSiteInspection->Sortable = TRUE; // Allow sort
		$this->DateOfSiteInspection->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfSiteInspection'] = &$this->DateOfSiteInspection;

		// TimeExtensionAuthorized
		$this->TimeExtensionAuthorized = new DbField('ipc_tracking', 'ipc_tracking', 'x_TimeExtensionAuthorized', 'TimeExtensionAuthorized', '`TimeExtensionAuthorized`', '`TimeExtensionAuthorized`', 16, 1, -1, FALSE, '`TimeExtensionAuthorized`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->TimeExtensionAuthorized->Sortable = TRUE; // Allow sort
		$this->TimeExtensionAuthorized->DataType = DATATYPE_BOOLEAN;
		$this->TimeExtensionAuthorized->Lookup = new Lookup('TimeExtensionAuthorized', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->TimeExtensionAuthorized->OptionCount = 2;
		$this->TimeExtensionAuthorized->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['TimeExtensionAuthorized'] = &$this->TimeExtensionAuthorized;

		// LabResultsChecked
		$this->LabResultsChecked = new DbField('ipc_tracking', 'ipc_tracking', 'x_LabResultsChecked', 'LabResultsChecked', '`LabResultsChecked`', '`LabResultsChecked`', 16, 1, -1, FALSE, '`LabResultsChecked`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->LabResultsChecked->Sortable = TRUE; // Allow sort
		$this->LabResultsChecked->DataType = DATATYPE_BOOLEAN;
		$this->LabResultsChecked->Lookup = new Lookup('LabResultsChecked', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LabResultsChecked->OptionCount = 2;
		$this->LabResultsChecked->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['LabResultsChecked'] = &$this->LabResultsChecked;

		// LabResults
		$this->LabResults = new DbField('ipc_tracking', 'ipc_tracking', 'x_LabResults', 'LabResults', '`LabResults`', '`LabResults`', 205, 0, -1, TRUE, '`LabResults`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->LabResults->Sortable = TRUE; // Allow sort
		$this->fields['LabResults'] = &$this->LabResults;

		// TerminationNoticeGiven
		$this->TerminationNoticeGiven = new DbField('ipc_tracking', 'ipc_tracking', 'x_TerminationNoticeGiven', 'TerminationNoticeGiven', '`TerminationNoticeGiven`', '`TerminationNoticeGiven`', 16, 1, -1, FALSE, '`TerminationNoticeGiven`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->TerminationNoticeGiven->Sortable = TRUE; // Allow sort
		$this->TerminationNoticeGiven->DataType = DATATYPE_BOOLEAN;
		$this->TerminationNoticeGiven->Lookup = new Lookup('TerminationNoticeGiven', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->TerminationNoticeGiven->OptionCount = 2;
		$this->TerminationNoticeGiven->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['TerminationNoticeGiven'] = &$this->TerminationNoticeGiven;

		// CopiesEmailedToMLG
		$this->CopiesEmailedToMLG = new DbField('ipc_tracking', 'ipc_tracking', 'x_CopiesEmailedToMLG', 'CopiesEmailedToMLG', '`CopiesEmailedToMLG`', '`CopiesEmailedToMLG`', 16, 1, -1, FALSE, '`CopiesEmailedToMLG`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->CopiesEmailedToMLG->Sortable = TRUE; // Allow sort
		$this->CopiesEmailedToMLG->DataType = DATATYPE_BOOLEAN;
		$this->CopiesEmailedToMLG->Lookup = new Lookup('CopiesEmailedToMLG', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->CopiesEmailedToMLG->OptionCount = 2;
		$this->CopiesEmailedToMLG->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['CopiesEmailedToMLG'] = &$this->CopiesEmailedToMLG;

		// ContractStillValid
		$this->ContractStillValid = new DbField('ipc_tracking', 'ipc_tracking', 'x_ContractStillValid', 'ContractStillValid', '`ContractStillValid`', '`ContractStillValid`', 16, 1, -1, FALSE, '`ContractStillValid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ContractStillValid->Sortable = TRUE; // Allow sort
		$this->ContractStillValid->DataType = DATATYPE_BOOLEAN;
		$this->ContractStillValid->Lookup = new Lookup('ContractStillValid', 'ipc_tracking', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ContractStillValid->OptionCount = 2;
		$this->ContractStillValid->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['ContractStillValid'] = &$this->ContractStillValid;

		// DeskOfficer
		$this->DeskOfficer = new DbField('ipc_tracking', 'ipc_tracking', 'x_DeskOfficer', 'DeskOfficer', '`DeskOfficer`', '`DeskOfficer`', 200, 255, -1, FALSE, '`DeskOfficer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeskOfficer->Sortable = TRUE; // Allow sort
		$this->fields['DeskOfficer'] = &$this->DeskOfficer;

		// DeskOfficerDate
		$this->DeskOfficerDate = new DbField('ipc_tracking', 'ipc_tracking', 'x_DeskOfficerDate', 'DeskOfficerDate', '`DeskOfficerDate`', CastDateFieldForLike("`DeskOfficerDate`", 0, "DB"), 133, 10, 0, FALSE, '`DeskOfficerDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeskOfficerDate->Sortable = TRUE; // Allow sort
		$this->DeskOfficerDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DeskOfficerDate'] = &$this->DeskOfficerDate;

		// SupervisingEngineer
		$this->SupervisingEngineer = new DbField('ipc_tracking', 'ipc_tracking', 'x_SupervisingEngineer', 'SupervisingEngineer', '`SupervisingEngineer`', '`SupervisingEngineer`', 200, 255, -1, FALSE, '`SupervisingEngineer`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SupervisingEngineer->Sortable = TRUE; // Allow sort
		$this->fields['SupervisingEngineer'] = &$this->SupervisingEngineer;

		// EngineerDate
		$this->EngineerDate = new DbField('ipc_tracking', 'ipc_tracking', 'x_EngineerDate', 'EngineerDate', '`EngineerDate`', CastDateFieldForLike("`EngineerDate`", 0, "DB"), 133, 10, 0, FALSE, '`EngineerDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EngineerDate->Sortable = TRUE; // Allow sort
		$this->EngineerDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['EngineerDate'] = &$this->EngineerDate;

		// CouncilSecretary
		$this->CouncilSecretary = new DbField('ipc_tracking', 'ipc_tracking', 'x_CouncilSecretary', 'CouncilSecretary', '`CouncilSecretary`', '`CouncilSecretary`', 200, 255, -1, FALSE, '`CouncilSecretary`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CouncilSecretary->Sortable = TRUE; // Allow sort
		$this->fields['CouncilSecretary'] = &$this->CouncilSecretary;

		// CSDate
		$this->CSDate = new DbField('ipc_tracking', 'ipc_tracking', 'x_CSDate', 'CSDate', '`CSDate`', CastDateFieldForLike("`CSDate`", 0, "DB"), 133, 10, 0, FALSE, '`CSDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CSDate->Sortable = TRUE; // Allow sort
		$this->CSDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['CSDate'] = &$this->CSDate;

		// MLGComments
		$this->MLGComments = new DbField('ipc_tracking', 'ipc_tracking', 'x_MLGComments', 'MLGComments', '`MLGComments`', '`MLGComments`', 201, 65535, -1, FALSE, '`MLGComments`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->MLGComments->Sortable = TRUE; // Allow sort
		$this->fields['MLGComments'] = &$this->MLGComments;

		// ContractType
		$this->ContractType = new DbField('ipc_tracking', 'ipc_tracking', 'x_ContractType', 'ContractType', '`ContractType`', '`ContractType`', 16, 3, -1, FALSE, '`ContractType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContractType->Sortable = TRUE; // Allow sort
		$this->ContractType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ContractType'] = &$this->ContractType;
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
		if ($this->getCurrentMasterTable() == "contract") {
			if ($this->ContractNo->getSessionValue() != "")
				$masterFilter .= "`ContractNo`=" . QuotedValue($this->ContractNo->getSessionValue(), DATATYPE_STRING, "DB");
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
		if ($this->getCurrentMasterTable() == "contract") {
			if ($this->ContractNo->getSessionValue() != "")
				$detailFilter .= "`ContractNo`=" . QuotedValue($this->ContractNo->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_contract()
	{
		return "`ContractNo`='@ContractNo@'";
	}

	// Detail filter
	public function sqlDetailFilter_contract()
	{
		return "`ContractNo`='@ContractNo@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ipc_tracking`";
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
			$this->IPCNo->setDbValue($conn->insert_ID());
			$rs['IPCNo'] = $this->IPCNo->DbValue;
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
			if (array_key_exists('IPCNo', $rs))
				AddFilter($where, QuotedName('IPCNo', $this->Dbid) . '=' . QuotedValue($rs['IPCNo'], $this->IPCNo->DataType, $this->Dbid));
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
		$this->IPCNo->DbValue = $row['IPCNo'];
		$this->ContractNo->DbValue = $row['ContractNo'];
		$this->ContractAuthorizedByAG->DbValue = $row['ContractAuthorizedByAG'];
		$this->VATApplied->DbValue = $row['VATApplied'];
		$this->ArithmeticCheckDone->DbValue = $row['ArithmeticCheckDone'];
		$this->VariationsApproved->DbValue = $row['VariationsApproved'];
		$this->PerformanceBondValidUntil->DbValue = $row['PerformanceBondValidUntil'];
		$this->AdvancePaymentBondValidUntil->DbValue = $row['AdvancePaymentBondValidUntil'];
		$this->RetentionDeductionClause->DbValue = $row['RetentionDeductionClause'];
		$this->RetentionDeducted->DbValue = $row['RetentionDeducted'];
		$this->LiquidatedDamagesDeducted->DbValue = $row['LiquidatedDamagesDeducted'];
		$this->LiquidatedPenaltiesDeducted->DbValue = $row['LiquidatedPenaltiesDeducted'];
		$this->AdvancedPaymentDeducted->DbValue = $row['AdvancedPaymentDeducted'];
		$this->CurrentProgressReportAttached->DbValue = $row['CurrentProgressReportAttached'];
		$this->CurrentProgressReport->Upload->DbValue = $row['CurrentProgressReport'];
		$this->DateOfSiteInspection->DbValue = $row['DateOfSiteInspection'];
		$this->TimeExtensionAuthorized->DbValue = $row['TimeExtensionAuthorized'];
		$this->LabResultsChecked->DbValue = $row['LabResultsChecked'];
		$this->LabResults->Upload->DbValue = $row['LabResults'];
		$this->TerminationNoticeGiven->DbValue = $row['TerminationNoticeGiven'];
		$this->CopiesEmailedToMLG->DbValue = $row['CopiesEmailedToMLG'];
		$this->ContractStillValid->DbValue = $row['ContractStillValid'];
		$this->DeskOfficer->DbValue = $row['DeskOfficer'];
		$this->DeskOfficerDate->DbValue = $row['DeskOfficerDate'];
		$this->SupervisingEngineer->DbValue = $row['SupervisingEngineer'];
		$this->EngineerDate->DbValue = $row['EngineerDate'];
		$this->CouncilSecretary->DbValue = $row['CouncilSecretary'];
		$this->CSDate->DbValue = $row['CSDate'];
		$this->MLGComments->DbValue = $row['MLGComments'];
		$this->ContractType->DbValue = $row['ContractType'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`IPCNo` = @IPCNo@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('IPCNo', $row) ? $row['IPCNo'] : NULL;
		else
			$val = $this->IPCNo->OldValue !== NULL ? $this->IPCNo->OldValue : $this->IPCNo->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@IPCNo@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "ipc_trackinglist.php";
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
		if ($pageName == "ipc_trackingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ipc_trackingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ipc_trackingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ipc_trackinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ipc_trackingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ipc_trackingview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ipc_trackingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ipc_trackingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ipc_trackingedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("ipc_trackingadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("ipc_trackingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "contract" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ContractNo=" . urlencode($this->ContractNo->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "IPCNo:" . JsonEncode($this->IPCNo->CurrentValue, "number");
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
		if ($this->IPCNo->CurrentValue != NULL) {
			$url .= "IPCNo=" . urlencode($this->IPCNo->CurrentValue);
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
			if (Param("IPCNo") !== NULL)
				$arKeys[] = Param("IPCNo");
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
				$this->IPCNo->CurrentValue = $key;
			else
				$this->IPCNo->OldValue = $key;
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
		$this->IPCNo->setDbValue($rs->fields('IPCNo'));
		$this->ContractNo->setDbValue($rs->fields('ContractNo'));
		$this->ContractAuthorizedByAG->setDbValue($rs->fields('ContractAuthorizedByAG'));
		$this->VATApplied->setDbValue($rs->fields('VATApplied'));
		$this->ArithmeticCheckDone->setDbValue($rs->fields('ArithmeticCheckDone'));
		$this->VariationsApproved->setDbValue($rs->fields('VariationsApproved'));
		$this->PerformanceBondValidUntil->setDbValue($rs->fields('PerformanceBondValidUntil'));
		$this->AdvancePaymentBondValidUntil->setDbValue($rs->fields('AdvancePaymentBondValidUntil'));
		$this->RetentionDeductionClause->setDbValue($rs->fields('RetentionDeductionClause'));
		$this->RetentionDeducted->setDbValue($rs->fields('RetentionDeducted'));
		$this->LiquidatedDamagesDeducted->setDbValue($rs->fields('LiquidatedDamagesDeducted'));
		$this->LiquidatedPenaltiesDeducted->setDbValue($rs->fields('LiquidatedPenaltiesDeducted'));
		$this->AdvancedPaymentDeducted->setDbValue($rs->fields('AdvancedPaymentDeducted'));
		$this->CurrentProgressReportAttached->setDbValue($rs->fields('CurrentProgressReportAttached'));
		$this->CurrentProgressReport->Upload->DbValue = $rs->fields('CurrentProgressReport');
		$this->DateOfSiteInspection->setDbValue($rs->fields('DateOfSiteInspection'));
		$this->TimeExtensionAuthorized->setDbValue($rs->fields('TimeExtensionAuthorized'));
		$this->LabResultsChecked->setDbValue($rs->fields('LabResultsChecked'));
		$this->LabResults->Upload->DbValue = $rs->fields('LabResults');
		$this->TerminationNoticeGiven->setDbValue($rs->fields('TerminationNoticeGiven'));
		$this->CopiesEmailedToMLG->setDbValue($rs->fields('CopiesEmailedToMLG'));
		$this->ContractStillValid->setDbValue($rs->fields('ContractStillValid'));
		$this->DeskOfficer->setDbValue($rs->fields('DeskOfficer'));
		$this->DeskOfficerDate->setDbValue($rs->fields('DeskOfficerDate'));
		$this->SupervisingEngineer->setDbValue($rs->fields('SupervisingEngineer'));
		$this->EngineerDate->setDbValue($rs->fields('EngineerDate'));
		$this->CouncilSecretary->setDbValue($rs->fields('CouncilSecretary'));
		$this->CSDate->setDbValue($rs->fields('CSDate'));
		$this->MLGComments->setDbValue($rs->fields('MLGComments'));
		$this->ContractType->setDbValue($rs->fields('ContractType'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// IPCNo
		// ContractNo
		// ContractAuthorizedByAG
		// VATApplied
		// ArithmeticCheckDone
		// VariationsApproved
		// PerformanceBondValidUntil
		// AdvancePaymentBondValidUntil
		// RetentionDeductionClause
		// RetentionDeducted
		// LiquidatedDamagesDeducted
		// LiquidatedPenaltiesDeducted
		// AdvancedPaymentDeducted
		// CurrentProgressReportAttached
		// CurrentProgressReport
		// DateOfSiteInspection
		// TimeExtensionAuthorized
		// LabResultsChecked
		// LabResults
		// TerminationNoticeGiven
		// CopiesEmailedToMLG
		// ContractStillValid
		// DeskOfficer
		// DeskOfficerDate
		// SupervisingEngineer
		// EngineerDate
		// CouncilSecretary
		// CSDate
		// MLGComments
		// ContractType
		// IPCNo

		$this->IPCNo->ViewValue = $this->IPCNo->CurrentValue;
		$this->IPCNo->ViewCustomAttributes = "";

		// ContractNo
		$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
		$this->ContractNo->ViewCustomAttributes = "";

		// ContractAuthorizedByAG
		if (ConvertToBool($this->ContractAuthorizedByAG->CurrentValue)) {
			$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(1) != "" ? $this->ContractAuthorizedByAG->tagCaption(1) : "Yes";
		} else {
			$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(2) != "" ? $this->ContractAuthorizedByAG->tagCaption(2) : "No";
		}
		$this->ContractAuthorizedByAG->ViewCustomAttributes = "";

		// VATApplied
		if (ConvertToBool($this->VATApplied->CurrentValue)) {
			$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(1) != "" ? $this->VATApplied->tagCaption(1) : "Yes";
		} else {
			$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(2) != "" ? $this->VATApplied->tagCaption(2) : "No";
		}
		$this->VATApplied->ViewCustomAttributes = "";

		// ArithmeticCheckDone
		if (ConvertToBool($this->ArithmeticCheckDone->CurrentValue)) {
			$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(1) != "" ? $this->ArithmeticCheckDone->tagCaption(1) : "Yes";
		} else {
			$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(2) != "" ? $this->ArithmeticCheckDone->tagCaption(2) : "No";
		}
		$this->ArithmeticCheckDone->ViewCustomAttributes = "";

		// VariationsApproved
		if (ConvertToBool($this->VariationsApproved->CurrentValue)) {
			$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(1) != "" ? $this->VariationsApproved->tagCaption(1) : "Yes";
		} else {
			$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(2) != "" ? $this->VariationsApproved->tagCaption(2) : "No";
		}
		$this->VariationsApproved->ViewCustomAttributes = "";

		// PerformanceBondValidUntil
		$this->PerformanceBondValidUntil->ViewValue = $this->PerformanceBondValidUntil->CurrentValue;
		$this->PerformanceBondValidUntil->ViewValue = FormatDateTime($this->PerformanceBondValidUntil->ViewValue, 0);
		$this->PerformanceBondValidUntil->ViewCustomAttributes = "";

		// AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil->ViewValue = $this->AdvancePaymentBondValidUntil->CurrentValue;
		$this->AdvancePaymentBondValidUntil->ViewValue = FormatDateTime($this->AdvancePaymentBondValidUntil->ViewValue, 0);
		$this->AdvancePaymentBondValidUntil->ViewCustomAttributes = "";

		// RetentionDeductionClause
		$this->RetentionDeductionClause->ViewValue = $this->RetentionDeductionClause->CurrentValue;
		$this->RetentionDeductionClause->ViewCustomAttributes = "";

		// RetentionDeducted
		if (ConvertToBool($this->RetentionDeducted->CurrentValue)) {
			$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(1) != "" ? $this->RetentionDeducted->tagCaption(1) : "Yes";
		} else {
			$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(2) != "" ? $this->RetentionDeducted->tagCaption(2) : "No";
		}
		$this->RetentionDeducted->ViewCustomAttributes = "";

		// LiquidatedDamagesDeducted
		if (ConvertToBool($this->LiquidatedDamagesDeducted->CurrentValue)) {
			$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(1) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(1) : "Yes";
		} else {
			$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(2) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(2) : "No";
		}
		$this->LiquidatedDamagesDeducted->ViewCustomAttributes = "";

		// LiquidatedPenaltiesDeducted
		if (ConvertToBool($this->LiquidatedPenaltiesDeducted->CurrentValue)) {
			$this->LiquidatedPenaltiesDeducted->ViewValue = $this->LiquidatedPenaltiesDeducted->tagCaption(1) != "" ? $this->LiquidatedPenaltiesDeducted->tagCaption(1) : "Yes";
		} else {
			$this->LiquidatedPenaltiesDeducted->ViewValue = $this->LiquidatedPenaltiesDeducted->tagCaption(2) != "" ? $this->LiquidatedPenaltiesDeducted->tagCaption(2) : "No";
		}
		$this->LiquidatedPenaltiesDeducted->ViewCustomAttributes = "";

		// AdvancedPaymentDeducted
		if (ConvertToBool($this->AdvancedPaymentDeducted->CurrentValue)) {
			$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(1) != "" ? $this->AdvancedPaymentDeducted->tagCaption(1) : "Yes";
		} else {
			$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(2) != "" ? $this->AdvancedPaymentDeducted->tagCaption(2) : "No";
		}
		$this->AdvancedPaymentDeducted->ViewCustomAttributes = "";

		// CurrentProgressReportAttached
		if (ConvertToBool($this->CurrentProgressReportAttached->CurrentValue)) {
			$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(1) != "" ? $this->CurrentProgressReportAttached->tagCaption(1) : "Yes";
		} else {
			$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(2) != "" ? $this->CurrentProgressReportAttached->tagCaption(2) : "No";
		}
		$this->CurrentProgressReportAttached->ViewCustomAttributes = "";

		// CurrentProgressReport
		if (!EmptyValue($this->CurrentProgressReport->Upload->DbValue)) {
			$this->CurrentProgressReport->ViewValue = $this->IPCNo->CurrentValue;
			$this->CurrentProgressReport->IsBlobImage = IsImageFile(ContentExtension($this->CurrentProgressReport->Upload->DbValue));
		} else {
			$this->CurrentProgressReport->ViewValue = "";
		}
		$this->CurrentProgressReport->ViewCustomAttributes = "";

		// DateOfSiteInspection
		$this->DateOfSiteInspection->ViewValue = $this->DateOfSiteInspection->CurrentValue;
		$this->DateOfSiteInspection->ViewValue = FormatDateTime($this->DateOfSiteInspection->ViewValue, 0);
		$this->DateOfSiteInspection->ViewCustomAttributes = "";

		// TimeExtensionAuthorized
		if (ConvertToBool($this->TimeExtensionAuthorized->CurrentValue)) {
			$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(1) != "" ? $this->TimeExtensionAuthorized->tagCaption(1) : "Yes";
		} else {
			$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(2) != "" ? $this->TimeExtensionAuthorized->tagCaption(2) : "No";
		}
		$this->TimeExtensionAuthorized->ViewCustomAttributes = "";

		// LabResultsChecked
		if (ConvertToBool($this->LabResultsChecked->CurrentValue)) {
			$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(1) != "" ? $this->LabResultsChecked->tagCaption(1) : "Yes";
		} else {
			$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(2) != "" ? $this->LabResultsChecked->tagCaption(2) : "No";
		}
		$this->LabResultsChecked->ViewCustomAttributes = "";

		// LabResults
		if (!EmptyValue($this->LabResults->Upload->DbValue)) {
			$this->LabResults->ViewValue = $this->IPCNo->CurrentValue;
			$this->LabResults->IsBlobImage = IsImageFile(ContentExtension($this->LabResults->Upload->DbValue));
		} else {
			$this->LabResults->ViewValue = "";
		}
		$this->LabResults->ViewCustomAttributes = "";

		// TerminationNoticeGiven
		if (ConvertToBool($this->TerminationNoticeGiven->CurrentValue)) {
			$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(1) != "" ? $this->TerminationNoticeGiven->tagCaption(1) : "Yes";
		} else {
			$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(2) != "" ? $this->TerminationNoticeGiven->tagCaption(2) : "No";
		}
		$this->TerminationNoticeGiven->ViewCustomAttributes = "";

		// CopiesEmailedToMLG
		if (ConvertToBool($this->CopiesEmailedToMLG->CurrentValue)) {
			$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(1) != "" ? $this->CopiesEmailedToMLG->tagCaption(1) : "Yes";
		} else {
			$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(2) != "" ? $this->CopiesEmailedToMLG->tagCaption(2) : "No";
		}
		$this->CopiesEmailedToMLG->ViewCustomAttributes = "";

		// ContractStillValid
		if (ConvertToBool($this->ContractStillValid->CurrentValue)) {
			$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(1) != "" ? $this->ContractStillValid->tagCaption(1) : "Yes";
		} else {
			$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(2) != "" ? $this->ContractStillValid->tagCaption(2) : "No";
		}
		$this->ContractStillValid->ViewCustomAttributes = "";

		// DeskOfficer
		$this->DeskOfficer->ViewValue = $this->DeskOfficer->CurrentValue;
		$this->DeskOfficer->ViewCustomAttributes = "";

		// DeskOfficerDate
		$this->DeskOfficerDate->ViewValue = $this->DeskOfficerDate->CurrentValue;
		$this->DeskOfficerDate->ViewValue = FormatDateTime($this->DeskOfficerDate->ViewValue, 0);
		$this->DeskOfficerDate->ViewCustomAttributes = "";

		// SupervisingEngineer
		$this->SupervisingEngineer->ViewValue = $this->SupervisingEngineer->CurrentValue;
		$this->SupervisingEngineer->ViewCustomAttributes = "";

		// EngineerDate
		$this->EngineerDate->ViewValue = $this->EngineerDate->CurrentValue;
		$this->EngineerDate->ViewValue = FormatDateTime($this->EngineerDate->ViewValue, 0);
		$this->EngineerDate->ViewCustomAttributes = "";

		// CouncilSecretary
		$this->CouncilSecretary->ViewValue = $this->CouncilSecretary->CurrentValue;
		$this->CouncilSecretary->ViewCustomAttributes = "";

		// CSDate
		$this->CSDate->ViewValue = $this->CSDate->CurrentValue;
		$this->CSDate->ViewValue = FormatDateTime($this->CSDate->ViewValue, 0);
		$this->CSDate->ViewCustomAttributes = "";

		// MLGComments
		$this->MLGComments->ViewValue = $this->MLGComments->CurrentValue;
		$this->MLGComments->ViewCustomAttributes = "";

		// ContractType
		$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
		$this->ContractType->ViewValue = FormatNumber($this->ContractType->ViewValue, 0, -2, -2, -2);
		$this->ContractType->ViewCustomAttributes = "";

		// IPCNo
		$this->IPCNo->LinkCustomAttributes = "";
		$this->IPCNo->HrefValue = "";
		$this->IPCNo->TooltipValue = "";

		// ContractNo
		$this->ContractNo->LinkCustomAttributes = "";
		$this->ContractNo->HrefValue = "";
		$this->ContractNo->TooltipValue = "";

		// ContractAuthorizedByAG
		$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
		$this->ContractAuthorizedByAG->HrefValue = "";
		$this->ContractAuthorizedByAG->TooltipValue = "";

		// VATApplied
		$this->VATApplied->LinkCustomAttributes = "";
		$this->VATApplied->HrefValue = "";
		$this->VATApplied->TooltipValue = "";

		// ArithmeticCheckDone
		$this->ArithmeticCheckDone->LinkCustomAttributes = "";
		$this->ArithmeticCheckDone->HrefValue = "";
		$this->ArithmeticCheckDone->TooltipValue = "";

		// VariationsApproved
		$this->VariationsApproved->LinkCustomAttributes = "";
		$this->VariationsApproved->HrefValue = "";
		$this->VariationsApproved->TooltipValue = "";

		// PerformanceBondValidUntil
		$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
		$this->PerformanceBondValidUntil->HrefValue = "";
		$this->PerformanceBondValidUntil->TooltipValue = "";

		// AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
		$this->AdvancePaymentBondValidUntil->HrefValue = "";
		$this->AdvancePaymentBondValidUntil->TooltipValue = "";

		// RetentionDeductionClause
		$this->RetentionDeductionClause->LinkCustomAttributes = "";
		$this->RetentionDeductionClause->HrefValue = "";
		$this->RetentionDeductionClause->TooltipValue = "";

		// RetentionDeducted
		$this->RetentionDeducted->LinkCustomAttributes = "";
		$this->RetentionDeducted->HrefValue = "";
		$this->RetentionDeducted->TooltipValue = "";

		// LiquidatedDamagesDeducted
		$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
		$this->LiquidatedDamagesDeducted->HrefValue = "";
		$this->LiquidatedDamagesDeducted->TooltipValue = "";

		// LiquidatedPenaltiesDeducted
		$this->LiquidatedPenaltiesDeducted->LinkCustomAttributes = "";
		$this->LiquidatedPenaltiesDeducted->HrefValue = "";
		$this->LiquidatedPenaltiesDeducted->TooltipValue = "";

		// AdvancedPaymentDeducted
		$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
		$this->AdvancedPaymentDeducted->HrefValue = "";
		$this->AdvancedPaymentDeducted->TooltipValue = "";

		// CurrentProgressReportAttached
		$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
		$this->CurrentProgressReportAttached->HrefValue = "";
		$this->CurrentProgressReportAttached->TooltipValue = "";

		// CurrentProgressReport
		$this->CurrentProgressReport->LinkCustomAttributes = "";
		if (!empty($this->CurrentProgressReport->Upload->DbValue)) {
			$this->CurrentProgressReport->HrefValue = GetFileUploadUrl($this->CurrentProgressReport, $this->IPCNo->CurrentValue);
			$this->CurrentProgressReport->LinkAttrs["target"] = "";
			if ($this->CurrentProgressReport->IsBlobImage && empty($this->CurrentProgressReport->LinkAttrs["target"]))
				$this->CurrentProgressReport->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->CurrentProgressReport->HrefValue = FullUrl($this->CurrentProgressReport->HrefValue, "href");
		} else {
			$this->CurrentProgressReport->HrefValue = "";
		}
		$this->CurrentProgressReport->ExportHrefValue = GetFileUploadUrl($this->CurrentProgressReport, $this->IPCNo->CurrentValue);
		$this->CurrentProgressReport->TooltipValue = "";

		// DateOfSiteInspection
		$this->DateOfSiteInspection->LinkCustomAttributes = "";
		$this->DateOfSiteInspection->HrefValue = "";
		$this->DateOfSiteInspection->TooltipValue = "";

		// TimeExtensionAuthorized
		$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
		$this->TimeExtensionAuthorized->HrefValue = "";
		$this->TimeExtensionAuthorized->TooltipValue = "";

		// LabResultsChecked
		$this->LabResultsChecked->LinkCustomAttributes = "";
		$this->LabResultsChecked->HrefValue = "";
		$this->LabResultsChecked->TooltipValue = "";

		// LabResults
		$this->LabResults->LinkCustomAttributes = "";
		if (!empty($this->LabResults->Upload->DbValue)) {
			$this->LabResults->HrefValue = GetFileUploadUrl($this->LabResults, $this->IPCNo->CurrentValue);
			$this->LabResults->LinkAttrs["target"] = "";
			if ($this->LabResults->IsBlobImage && empty($this->LabResults->LinkAttrs["target"]))
				$this->LabResults->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->LabResults->HrefValue = FullUrl($this->LabResults->HrefValue, "href");
		} else {
			$this->LabResults->HrefValue = "";
		}
		$this->LabResults->ExportHrefValue = GetFileUploadUrl($this->LabResults, $this->IPCNo->CurrentValue);
		$this->LabResults->TooltipValue = "";

		// TerminationNoticeGiven
		$this->TerminationNoticeGiven->LinkCustomAttributes = "";
		$this->TerminationNoticeGiven->HrefValue = "";
		$this->TerminationNoticeGiven->TooltipValue = "";

		// CopiesEmailedToMLG
		$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
		$this->CopiesEmailedToMLG->HrefValue = "";
		$this->CopiesEmailedToMLG->TooltipValue = "";

		// ContractStillValid
		$this->ContractStillValid->LinkCustomAttributes = "";
		$this->ContractStillValid->HrefValue = "";
		$this->ContractStillValid->TooltipValue = "";

		// DeskOfficer
		$this->DeskOfficer->LinkCustomAttributes = "";
		$this->DeskOfficer->HrefValue = "";
		$this->DeskOfficer->TooltipValue = "";

		// DeskOfficerDate
		$this->DeskOfficerDate->LinkCustomAttributes = "";
		$this->DeskOfficerDate->HrefValue = "";
		$this->DeskOfficerDate->TooltipValue = "";

		// SupervisingEngineer
		$this->SupervisingEngineer->LinkCustomAttributes = "";
		$this->SupervisingEngineer->HrefValue = "";
		$this->SupervisingEngineer->TooltipValue = "";

		// EngineerDate
		$this->EngineerDate->LinkCustomAttributes = "";
		$this->EngineerDate->HrefValue = "";
		$this->EngineerDate->TooltipValue = "";

		// CouncilSecretary
		$this->CouncilSecretary->LinkCustomAttributes = "";
		$this->CouncilSecretary->HrefValue = "";
		$this->CouncilSecretary->TooltipValue = "";

		// CSDate
		$this->CSDate->LinkCustomAttributes = "";
		$this->CSDate->HrefValue = "";
		$this->CSDate->TooltipValue = "";

		// MLGComments
		$this->MLGComments->LinkCustomAttributes = "";
		$this->MLGComments->HrefValue = "";
		$this->MLGComments->TooltipValue = "";

		// ContractType
		$this->ContractType->LinkCustomAttributes = "";
		$this->ContractType->HrefValue = "";
		$this->ContractType->TooltipValue = "";

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

		// IPCNo
		$this->IPCNo->EditAttrs["class"] = "form-control";
		$this->IPCNo->EditCustomAttributes = "";
		$this->IPCNo->EditValue = $this->IPCNo->CurrentValue;
		$this->IPCNo->ViewCustomAttributes = "";

		// ContractNo
		$this->ContractNo->EditAttrs["class"] = "form-control";
		$this->ContractNo->EditCustomAttributes = "";
		if ($this->ContractNo->getSessionValue() != "") {
			$this->ContractNo->CurrentValue = $this->ContractNo->getSessionValue();
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";
		} else {
			if (!$this->ContractNo->Raw)
				$this->ContractNo->CurrentValue = HtmlDecode($this->ContractNo->CurrentValue);
			$this->ContractNo->EditValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());
		}

		// ContractAuthorizedByAG
		$this->ContractAuthorizedByAG->EditCustomAttributes = "";
		$this->ContractAuthorizedByAG->EditValue = $this->ContractAuthorizedByAG->options(FALSE);

		// VATApplied
		$this->VATApplied->EditCustomAttributes = "";
		$this->VATApplied->EditValue = $this->VATApplied->options(FALSE);

		// ArithmeticCheckDone
		$this->ArithmeticCheckDone->EditCustomAttributes = "";
		$this->ArithmeticCheckDone->EditValue = $this->ArithmeticCheckDone->options(FALSE);

		// VariationsApproved
		$this->VariationsApproved->EditCustomAttributes = "";
		$this->VariationsApproved->EditValue = $this->VariationsApproved->options(FALSE);

		// PerformanceBondValidUntil
		$this->PerformanceBondValidUntil->EditAttrs["class"] = "form-control";
		$this->PerformanceBondValidUntil->EditCustomAttributes = "";
		$this->PerformanceBondValidUntil->EditValue = FormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 8);
		$this->PerformanceBondValidUntil->PlaceHolder = RemoveHtml($this->PerformanceBondValidUntil->caption());

		// AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil->EditAttrs["class"] = "form-control";
		$this->AdvancePaymentBondValidUntil->EditCustomAttributes = "";
		$this->AdvancePaymentBondValidUntil->EditValue = FormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 8);
		$this->AdvancePaymentBondValidUntil->PlaceHolder = RemoveHtml($this->AdvancePaymentBondValidUntil->caption());

		// RetentionDeductionClause
		$this->RetentionDeductionClause->EditAttrs["class"] = "form-control";
		$this->RetentionDeductionClause->EditCustomAttributes = "";
		if (!$this->RetentionDeductionClause->Raw)
			$this->RetentionDeductionClause->CurrentValue = HtmlDecode($this->RetentionDeductionClause->CurrentValue);
		$this->RetentionDeductionClause->EditValue = $this->RetentionDeductionClause->CurrentValue;
		$this->RetentionDeductionClause->PlaceHolder = RemoveHtml($this->RetentionDeductionClause->caption());

		// RetentionDeducted
		$this->RetentionDeducted->EditCustomAttributes = "";
		$this->RetentionDeducted->EditValue = $this->RetentionDeducted->options(FALSE);

		// LiquidatedDamagesDeducted
		$this->LiquidatedDamagesDeducted->EditCustomAttributes = "";
		$this->LiquidatedDamagesDeducted->EditValue = $this->LiquidatedDamagesDeducted->options(FALSE);

		// LiquidatedPenaltiesDeducted
		$this->LiquidatedPenaltiesDeducted->EditCustomAttributes = "";
		$this->LiquidatedPenaltiesDeducted->EditValue = $this->LiquidatedPenaltiesDeducted->options(FALSE);

		// AdvancedPaymentDeducted
		$this->AdvancedPaymentDeducted->EditCustomAttributes = "";
		$this->AdvancedPaymentDeducted->EditValue = $this->AdvancedPaymentDeducted->options(FALSE);

		// CurrentProgressReportAttached
		$this->CurrentProgressReportAttached->EditCustomAttributes = "";
		$this->CurrentProgressReportAttached->EditValue = $this->CurrentProgressReportAttached->options(FALSE);

		// CurrentProgressReport
		$this->CurrentProgressReport->EditAttrs["class"] = "form-control";
		$this->CurrentProgressReport->EditCustomAttributes = "";
		if (!EmptyValue($this->CurrentProgressReport->Upload->DbValue)) {
			$this->CurrentProgressReport->EditValue = $this->IPCNo->CurrentValue;
			$this->CurrentProgressReport->IsBlobImage = IsImageFile(ContentExtension($this->CurrentProgressReport->Upload->DbValue));
		} else {
			$this->CurrentProgressReport->EditValue = "";
		}

		// DateOfSiteInspection
		$this->DateOfSiteInspection->EditAttrs["class"] = "form-control";
		$this->DateOfSiteInspection->EditCustomAttributes = "";
		$this->DateOfSiteInspection->EditValue = FormatDateTime($this->DateOfSiteInspection->CurrentValue, 8);
		$this->DateOfSiteInspection->PlaceHolder = RemoveHtml($this->DateOfSiteInspection->caption());

		// TimeExtensionAuthorized
		$this->TimeExtensionAuthorized->EditCustomAttributes = "";
		$this->TimeExtensionAuthorized->EditValue = $this->TimeExtensionAuthorized->options(FALSE);

		// LabResultsChecked
		$this->LabResultsChecked->EditCustomAttributes = "";
		$this->LabResultsChecked->EditValue = $this->LabResultsChecked->options(FALSE);

		// LabResults
		$this->LabResults->EditAttrs["class"] = "form-control";
		$this->LabResults->EditCustomAttributes = "";
		if (!EmptyValue($this->LabResults->Upload->DbValue)) {
			$this->LabResults->EditValue = $this->IPCNo->CurrentValue;
			$this->LabResults->IsBlobImage = IsImageFile(ContentExtension($this->LabResults->Upload->DbValue));
		} else {
			$this->LabResults->EditValue = "";
		}

		// TerminationNoticeGiven
		$this->TerminationNoticeGiven->EditCustomAttributes = "";
		$this->TerminationNoticeGiven->EditValue = $this->TerminationNoticeGiven->options(FALSE);

		// CopiesEmailedToMLG
		$this->CopiesEmailedToMLG->EditCustomAttributes = "";
		$this->CopiesEmailedToMLG->EditValue = $this->CopiesEmailedToMLG->options(FALSE);

		// ContractStillValid
		$this->ContractStillValid->EditCustomAttributes = "";
		$this->ContractStillValid->EditValue = $this->ContractStillValid->options(FALSE);

		// DeskOfficer
		$this->DeskOfficer->EditAttrs["class"] = "form-control";
		$this->DeskOfficer->EditCustomAttributes = "";
		if (!$this->DeskOfficer->Raw)
			$this->DeskOfficer->CurrentValue = HtmlDecode($this->DeskOfficer->CurrentValue);
		$this->DeskOfficer->EditValue = $this->DeskOfficer->CurrentValue;
		$this->DeskOfficer->PlaceHolder = RemoveHtml($this->DeskOfficer->caption());

		// DeskOfficerDate
		$this->DeskOfficerDate->EditAttrs["class"] = "form-control";
		$this->DeskOfficerDate->EditCustomAttributes = "";
		$this->DeskOfficerDate->EditValue = FormatDateTime($this->DeskOfficerDate->CurrentValue, 8);
		$this->DeskOfficerDate->PlaceHolder = RemoveHtml($this->DeskOfficerDate->caption());

		// SupervisingEngineer
		$this->SupervisingEngineer->EditAttrs["class"] = "form-control";
		$this->SupervisingEngineer->EditCustomAttributes = "";
		if (!$this->SupervisingEngineer->Raw)
			$this->SupervisingEngineer->CurrentValue = HtmlDecode($this->SupervisingEngineer->CurrentValue);
		$this->SupervisingEngineer->EditValue = $this->SupervisingEngineer->CurrentValue;
		$this->SupervisingEngineer->PlaceHolder = RemoveHtml($this->SupervisingEngineer->caption());

		// EngineerDate
		$this->EngineerDate->EditAttrs["class"] = "form-control";
		$this->EngineerDate->EditCustomAttributes = "";
		$this->EngineerDate->EditValue = FormatDateTime($this->EngineerDate->CurrentValue, 8);
		$this->EngineerDate->PlaceHolder = RemoveHtml($this->EngineerDate->caption());

		// CouncilSecretary
		$this->CouncilSecretary->EditAttrs["class"] = "form-control";
		$this->CouncilSecretary->EditCustomAttributes = "";
		if (!$this->CouncilSecretary->Raw)
			$this->CouncilSecretary->CurrentValue = HtmlDecode($this->CouncilSecretary->CurrentValue);
		$this->CouncilSecretary->EditValue = $this->CouncilSecretary->CurrentValue;
		$this->CouncilSecretary->PlaceHolder = RemoveHtml($this->CouncilSecretary->caption());

		// CSDate
		$this->CSDate->EditAttrs["class"] = "form-control";
		$this->CSDate->EditCustomAttributes = "";
		$this->CSDate->EditValue = FormatDateTime($this->CSDate->CurrentValue, 8);
		$this->CSDate->PlaceHolder = RemoveHtml($this->CSDate->caption());

		// MLGComments
		$this->MLGComments->EditAttrs["class"] = "form-control";
		$this->MLGComments->EditCustomAttributes = "";
		$this->MLGComments->EditValue = $this->MLGComments->CurrentValue;
		$this->MLGComments->PlaceHolder = RemoveHtml($this->MLGComments->caption());

		// ContractType
		$this->ContractType->EditAttrs["class"] = "form-control";
		$this->ContractType->EditCustomAttributes = "";
		$this->ContractType->EditValue = $this->ContractType->CurrentValue;
		$this->ContractType->PlaceHolder = RemoveHtml($this->ContractType->caption());

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
					$doc->exportCaption($this->IPCNo);
					$doc->exportCaption($this->ContractNo);
					$doc->exportCaption($this->ContractAuthorizedByAG);
					$doc->exportCaption($this->VATApplied);
					$doc->exportCaption($this->ArithmeticCheckDone);
					$doc->exportCaption($this->VariationsApproved);
					$doc->exportCaption($this->PerformanceBondValidUntil);
					$doc->exportCaption($this->AdvancePaymentBondValidUntil);
					$doc->exportCaption($this->RetentionDeductionClause);
					$doc->exportCaption($this->RetentionDeducted);
					$doc->exportCaption($this->LiquidatedDamagesDeducted);
					$doc->exportCaption($this->AdvancedPaymentDeducted);
					$doc->exportCaption($this->CurrentProgressReportAttached);
					$doc->exportCaption($this->CurrentProgressReport);
					$doc->exportCaption($this->DateOfSiteInspection);
					$doc->exportCaption($this->TimeExtensionAuthorized);
					$doc->exportCaption($this->LabResultsChecked);
					$doc->exportCaption($this->LabResults);
					$doc->exportCaption($this->TerminationNoticeGiven);
					$doc->exportCaption($this->CopiesEmailedToMLG);
					$doc->exportCaption($this->ContractStillValid);
					$doc->exportCaption($this->DeskOfficer);
					$doc->exportCaption($this->DeskOfficerDate);
					$doc->exportCaption($this->SupervisingEngineer);
					$doc->exportCaption($this->EngineerDate);
					$doc->exportCaption($this->CouncilSecretary);
					$doc->exportCaption($this->CSDate);
					$doc->exportCaption($this->MLGComments);
					$doc->exportCaption($this->ContractType);
				} else {
					$doc->exportCaption($this->IPCNo);
					$doc->exportCaption($this->ContractNo);
					$doc->exportCaption($this->ContractAuthorizedByAG);
					$doc->exportCaption($this->VATApplied);
					$doc->exportCaption($this->ArithmeticCheckDone);
					$doc->exportCaption($this->VariationsApproved);
					$doc->exportCaption($this->PerformanceBondValidUntil);
					$doc->exportCaption($this->AdvancePaymentBondValidUntil);
					$doc->exportCaption($this->RetentionDeductionClause);
					$doc->exportCaption($this->RetentionDeducted);
					$doc->exportCaption($this->LiquidatedDamagesDeducted);
					$doc->exportCaption($this->AdvancedPaymentDeducted);
					$doc->exportCaption($this->CurrentProgressReportAttached);
					$doc->exportCaption($this->DateOfSiteInspection);
					$doc->exportCaption($this->TimeExtensionAuthorized);
					$doc->exportCaption($this->LabResultsChecked);
					$doc->exportCaption($this->TerminationNoticeGiven);
					$doc->exportCaption($this->CopiesEmailedToMLG);
					$doc->exportCaption($this->ContractStillValid);
					$doc->exportCaption($this->DeskOfficer);
					$doc->exportCaption($this->DeskOfficerDate);
					$doc->exportCaption($this->SupervisingEngineer);
					$doc->exportCaption($this->EngineerDate);
					$doc->exportCaption($this->CouncilSecretary);
					$doc->exportCaption($this->CSDate);
					$doc->exportCaption($this->ContractType);
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
						$doc->exportField($this->IPCNo);
						$doc->exportField($this->ContractNo);
						$doc->exportField($this->ContractAuthorizedByAG);
						$doc->exportField($this->VATApplied);
						$doc->exportField($this->ArithmeticCheckDone);
						$doc->exportField($this->VariationsApproved);
						$doc->exportField($this->PerformanceBondValidUntil);
						$doc->exportField($this->AdvancePaymentBondValidUntil);
						$doc->exportField($this->RetentionDeductionClause);
						$doc->exportField($this->RetentionDeducted);
						$doc->exportField($this->LiquidatedDamagesDeducted);
						$doc->exportField($this->AdvancedPaymentDeducted);
						$doc->exportField($this->CurrentProgressReportAttached);
						$doc->exportField($this->CurrentProgressReport);
						$doc->exportField($this->DateOfSiteInspection);
						$doc->exportField($this->TimeExtensionAuthorized);
						$doc->exportField($this->LabResultsChecked);
						$doc->exportField($this->LabResults);
						$doc->exportField($this->TerminationNoticeGiven);
						$doc->exportField($this->CopiesEmailedToMLG);
						$doc->exportField($this->ContractStillValid);
						$doc->exportField($this->DeskOfficer);
						$doc->exportField($this->DeskOfficerDate);
						$doc->exportField($this->SupervisingEngineer);
						$doc->exportField($this->EngineerDate);
						$doc->exportField($this->CouncilSecretary);
						$doc->exportField($this->CSDate);
						$doc->exportField($this->MLGComments);
						$doc->exportField($this->ContractType);
					} else {
						$doc->exportField($this->IPCNo);
						$doc->exportField($this->ContractNo);
						$doc->exportField($this->ContractAuthorizedByAG);
						$doc->exportField($this->VATApplied);
						$doc->exportField($this->ArithmeticCheckDone);
						$doc->exportField($this->VariationsApproved);
						$doc->exportField($this->PerformanceBondValidUntil);
						$doc->exportField($this->AdvancePaymentBondValidUntil);
						$doc->exportField($this->RetentionDeductionClause);
						$doc->exportField($this->RetentionDeducted);
						$doc->exportField($this->LiquidatedDamagesDeducted);
						$doc->exportField($this->AdvancedPaymentDeducted);
						$doc->exportField($this->CurrentProgressReportAttached);
						$doc->exportField($this->DateOfSiteInspection);
						$doc->exportField($this->TimeExtensionAuthorized);
						$doc->exportField($this->LabResultsChecked);
						$doc->exportField($this->TerminationNoticeGiven);
						$doc->exportField($this->CopiesEmailedToMLG);
						$doc->exportField($this->ContractStillValid);
						$doc->exportField($this->DeskOfficer);
						$doc->exportField($this->DeskOfficerDate);
						$doc->exportField($this->SupervisingEngineer);
						$doc->exportField($this->EngineerDate);
						$doc->exportField($this->CouncilSecretary);
						$doc->exportField($this->CSDate);
						$doc->exportField($this->ContractType);
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
		if ($fldparm == 'CurrentProgressReport') {
			$fldName = "CurrentProgressReport";
		} elseif ($fldparm == 'LabResults') {
			$fldName = "LabResults";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->IPCNo->CurrentValue = $ar[0];
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