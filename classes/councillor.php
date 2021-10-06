<?php namespace PHPMaker2020\lgmis20; ?>
<?php

/**
 * Table class for councillor
 */
class councillor extends DbTable
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
	public $LACode;
	public $FormerFileNumber;
	public $NRC;
	public $Sex;
	public $Title;
	public $Surname;
	public $FirstName;
	public $MiddleName;
	public $MaritalStatus;
	public $MaidenName;
	public $DateOfBirth;
	public $CouncillorPhoto;
	public $AcademicQualification;
	public $ProfessionalQualification;
	public $MedicalCondition;
	public $PhysicalChallenge;
	public $PostalAddress;
	public $PhysicalAddress;
	public $TownOrVillage;
	public $Telephone;
	public $Mobile;
	public $Fax;
	public $_Email;
	public $NumberOfBiologicalChildren;
	public $NumberOfDependants;
	public $NextOfKin;
	public $RelationshipCode;
	public $NextOfKinMobile;
	public $NextOfKinEmail;
	public $AdditionalInformation;
	public $LastUserID;
	public $LastUpdated;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'councillor';
		$this->TableName = 'councillor';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`councillor`";
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
		$this->EmployeeID = new DbField('councillor', 'councillor', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, 11, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->EmployeeID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->EmployeeID->IsPrimaryKey = TRUE; // Primary key field
		$this->EmployeeID->IsForeignKey = TRUE; // Foreign key field
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// LACode
		$this->LACode = new DbField('councillor', 'councillor', 'x_LACode', 'LACode', '`LACode`', '`LACode`', 200, 10, -1, FALSE, '`LACode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LACode->Sortable = TRUE; // Allow sort
		$this->LACode->Lookup = new Lookup('LACode', 'local_authority', FALSE, 'LACode', ["LAName","LACode","",""], [], [], [], [], [], [], '', '');
		$this->fields['LACode'] = &$this->LACode;

		// FormerFileNumber
		$this->FormerFileNumber = new DbField('councillor', 'councillor', 'x_FormerFileNumber', 'FormerFileNumber', '`FormerFileNumber`', '`FormerFileNumber`', 200, 13, -1, FALSE, '`FormerFileNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FormerFileNumber->Sortable = TRUE; // Allow sort
		$this->fields['FormerFileNumber'] = &$this->FormerFileNumber;

		// NRC
		$this->NRC = new DbField('councillor', 'councillor', 'x_NRC', 'NRC', '`NRC`', '`NRC`', 200, 13, -1, FALSE, '`NRC`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NRC->Nullable = FALSE; // NOT NULL field
		$this->NRC->Required = TRUE; // Required field
		$this->NRC->Sortable = TRUE; // Allow sort
		$this->fields['NRC'] = &$this->NRC;

		// Sex
		$this->Sex = new DbField('councillor', 'councillor', 'x_Sex', 'Sex', '`Sex`', '`Sex`', 200, 6, -1, FALSE, '`Sex`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Sex->Nullable = FALSE; // NOT NULL field
		$this->Sex->Required = TRUE; // Required field
		$this->Sex->Sortable = TRUE; // Allow sort
		$this->Sex->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Sex->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Sex->Lookup = new Lookup('Sex', 'sex', FALSE, 'Sex', ["Sex","","",""], [], ["x_Title"], [], [], [], [], '', '');
		$this->fields['Sex'] = &$this->Sex;

		// Title
		$this->Title = new DbField('councillor', 'councillor', 'x_Title', 'Title', '`Title`', '`Title`', 200, 12, -1, FALSE, '`Title`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Title->Sortable = TRUE; // Allow sort
		$this->Title->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Title->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Title->Lookup = new Lookup('Title', 'title_ref', FALSE, 'Title', ["Title","","",""], ["x_Sex"], [], ["Sex"], ["x_Sex"], [], [], '', '');
		$this->fields['Title'] = &$this->Title;

		// Surname
		$this->Surname = new DbField('councillor', 'councillor', 'x_Surname', 'Surname', '`Surname`', '`Surname`', 200, 100, -1, FALSE, '`Surname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Surname->Nullable = FALSE; // NOT NULL field
		$this->Surname->Required = TRUE; // Required field
		$this->Surname->Sortable = TRUE; // Allow sort
		$this->fields['Surname'] = &$this->Surname;

		// FirstName
		$this->FirstName = new DbField('councillor', 'councillor', 'x_FirstName', 'FirstName', '`FirstName`', '`FirstName`', 200, 100, -1, FALSE, '`FirstName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Nullable = FALSE; // NOT NULL field
		$this->FirstName->Required = TRUE; // Required field
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// MiddleName
		$this->MiddleName = new DbField('councillor', 'councillor', 'x_MiddleName', 'MiddleName', '`MiddleName`', '`MiddleName`', 200, 100, -1, FALSE, '`MiddleName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MiddleName->Sortable = TRUE; // Allow sort
		$this->fields['MiddleName'] = &$this->MiddleName;

		// MaritalStatus
		$this->MaritalStatus = new DbField('councillor', 'councillor', 'x_MaritalStatus', 'MaritalStatus', '`MaritalStatus`', '`MaritalStatus`', 16, 3, -1, FALSE, '`MaritalStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MaritalStatus->Nullable = FALSE; // NOT NULL field
		$this->MaritalStatus->Required = TRUE; // Required field
		$this->MaritalStatus->Sortable = TRUE; // Allow sort
		$this->MaritalStatus->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MaritalStatus->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MaritalStatus->Lookup = new Lookup('MaritalStatus', 'marital_status', FALSE, 'MaritalStatusCode', ["MaritalStatus","","",""], [], [], [], [], [], [], '', '');
		$this->MaritalStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MaritalStatus'] = &$this->MaritalStatus;

		// MaidenName
		$this->MaidenName = new DbField('councillor', 'councillor', 'x_MaidenName', 'MaidenName', '`MaidenName`', '`MaidenName`', 200, 100, -1, FALSE, '`MaidenName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MaidenName->Sortable = TRUE; // Allow sort
		$this->fields['MaidenName'] = &$this->MaidenName;

		// DateOfBirth
		$this->DateOfBirth = new DbField('councillor', 'councillor', 'x_DateOfBirth', 'DateOfBirth', '`DateOfBirth`', CastDateFieldForLike("`DateOfBirth`", 0, "DB"), 133, 10, 0, FALSE, '`DateOfBirth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateOfBirth->Nullable = FALSE; // NOT NULL field
		$this->DateOfBirth->Required = TRUE; // Required field
		$this->DateOfBirth->Sortable = TRUE; // Allow sort
		$this->DateOfBirth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateOfBirth'] = &$this->DateOfBirth;

		// CouncillorPhoto
		$this->CouncillorPhoto = new DbField('councillor', 'councillor', 'x_CouncillorPhoto', 'CouncillorPhoto', '`CouncillorPhoto`', '`CouncillorPhoto`', 205, 0, -1, TRUE, '`CouncillorPhoto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->CouncillorPhoto->Sortable = TRUE; // Allow sort
		$this->fields['CouncillorPhoto'] = &$this->CouncillorPhoto;

		// AcademicQualification
		$this->AcademicQualification = new DbField('councillor', 'councillor', 'x_AcademicQualification', 'AcademicQualification', '`AcademicQualification`', '`AcademicQualification`', 200, 100, -1, FALSE, '`AcademicQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AcademicQualification->Sortable = TRUE; // Allow sort
		$this->AcademicQualification->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AcademicQualification->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AcademicQualification->Lookup = new Lookup('AcademicQualification', 'qualificationds_academic', FALSE, 'AcademicQualifications', ["AcademicQualifications","","",""], [], [], [], [], [], [], '', '');
		$this->fields['AcademicQualification'] = &$this->AcademicQualification;

		// ProfessionalQualification
		$this->ProfessionalQualification = new DbField('councillor', 'councillor', 'x_ProfessionalQualification', 'ProfessionalQualification', '`ProfessionalQualification`', '`ProfessionalQualification`', 200, 255, -1, FALSE, '`ProfessionalQualification`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProfessionalQualification->Sortable = TRUE; // Allow sort
		$this->ProfessionalQualification->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProfessionalQualification->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProfessionalQualification->Lookup = new Lookup('ProfessionalQualification', 'qualifications_professional', FALSE, 'ProfessionalQualifications', ["ProfessionalQualifications","","",""], [], [], [], [], [], [], '', '');
		$this->fields['ProfessionalQualification'] = &$this->ProfessionalQualification;

		// MedicalCondition
		$this->MedicalCondition = new DbField('councillor', 'councillor', 'x_MedicalCondition', 'MedicalCondition', '`MedicalCondition`', '`MedicalCondition`', 200, 255, -1, FALSE, '`MedicalCondition`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MedicalCondition->Sortable = TRUE; // Allow sort
		$this->MedicalCondition->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MedicalCondition->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MedicalCondition->Lookup = new Lookup('MedicalCondition', 'medical_condition', FALSE, 'MedicalCondition', ["MedicalCondition","","",""], [], [], [], [], [], [], '', '');
		$this->fields['MedicalCondition'] = &$this->MedicalCondition;

		// PhysicalChallenge
		$this->PhysicalChallenge = new DbField('councillor', 'councillor', 'x_PhysicalChallenge', 'PhysicalChallenge', '`PhysicalChallenge`', '`PhysicalChallenge`', 17, 3, -1, FALSE, '`PhysicalChallenge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PhysicalChallenge->Sortable = TRUE; // Allow sort
		$this->PhysicalChallenge->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PhysicalChallenge'] = &$this->PhysicalChallenge;

		// PostalAddress
		$this->PostalAddress = new DbField('councillor', 'councillor', 'x_PostalAddress', 'PostalAddress', '`PostalAddress`', '`PostalAddress`', 200, 255, -1, FALSE, '`PostalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PostalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PostalAddress'] = &$this->PostalAddress;

		// PhysicalAddress
		$this->PhysicalAddress = new DbField('councillor', 'councillor', 'x_PhysicalAddress', 'PhysicalAddress', '`PhysicalAddress`', '`PhysicalAddress`', 200, 255, -1, FALSE, '`PhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PhysicalAddress->Sortable = TRUE; // Allow sort
		$this->fields['PhysicalAddress'] = &$this->PhysicalAddress;

		// TownOrVillage
		$this->TownOrVillage = new DbField('councillor', 'councillor', 'x_TownOrVillage', 'TownOrVillage', '`TownOrVillage`', '`TownOrVillage`', 200, 255, -1, FALSE, '`TownOrVillage`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TownOrVillage->Sortable = TRUE; // Allow sort
		$this->fields['TownOrVillage'] = &$this->TownOrVillage;

		// Telephone
		$this->Telephone = new DbField('councillor', 'councillor', 'x_Telephone', 'Telephone', '`Telephone`', '`Telephone`', 200, 255, -1, FALSE, '`Telephone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Telephone->Sortable = TRUE; // Allow sort
		$this->fields['Telephone'] = &$this->Telephone;

		// Mobile
		$this->Mobile = new DbField('councillor', 'councillor', 'x_Mobile', 'Mobile', '`Mobile`', '`Mobile`', 200, 255, -1, FALSE, '`Mobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Mobile->Sortable = TRUE; // Allow sort
		$this->fields['Mobile'] = &$this->Mobile;

		// Fax
		$this->Fax = new DbField('councillor', 'councillor', 'x_Fax', 'Fax', '`Fax`', '`Fax`', 200, 20, -1, FALSE, '`Fax`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fax->Sortable = TRUE; // Allow sort
		$this->fields['Fax'] = &$this->Fax;

		// Email
		$this->_Email = new DbField('councillor', 'councillor', 'x__Email', 'Email', '`Email`', '`Email`', 200, 255, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->_Email->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['Email'] = &$this->_Email;

		// NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren = new DbField('councillor', 'councillor', 'x_NumberOfBiologicalChildren', 'NumberOfBiologicalChildren', '`NumberOfBiologicalChildren`', '`NumberOfBiologicalChildren`', 16, 3, -1, FALSE, '`NumberOfBiologicalChildren`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NumberOfBiologicalChildren->Sortable = TRUE; // Allow sort
		$this->NumberOfBiologicalChildren->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['NumberOfBiologicalChildren'] = &$this->NumberOfBiologicalChildren;

		// NumberOfDependants
		$this->NumberOfDependants = new DbField('councillor', 'councillor', 'x_NumberOfDependants', 'NumberOfDependants', '`NumberOfDependants`', '`NumberOfDependants`', 16, 3, -1, FALSE, '`NumberOfDependants`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NumberOfDependants->Sortable = TRUE; // Allow sort
		$this->NumberOfDependants->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['NumberOfDependants'] = &$this->NumberOfDependants;

		// NextOfKin
		$this->NextOfKin = new DbField('councillor', 'councillor', 'x_NextOfKin', 'NextOfKin', '`NextOfKin`', '`NextOfKin`', 200, 255, -1, FALSE, '`NextOfKin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKin->Sortable = TRUE; // Allow sort
		$this->fields['NextOfKin'] = &$this->NextOfKin;

		// RelationshipCode
		$this->RelationshipCode = new DbField('councillor', 'councillor', 'x_RelationshipCode', 'RelationshipCode', '`RelationshipCode`', '`RelationshipCode`', 16, 3, -1, FALSE, '`RelationshipCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RelationshipCode->Sortable = TRUE; // Allow sort
		$this->RelationshipCode->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RelationshipCode->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RelationshipCode->Lookup = new Lookup('RelationshipCode', 'relationship', FALSE, 'RelationshipCode', ["Relationship","","",""], [], [], [], [], [], [], '', '');
		$this->RelationshipCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RelationshipCode'] = &$this->RelationshipCode;

		// NextOfKinMobile
		$this->NextOfKinMobile = new DbField('councillor', 'councillor', 'x_NextOfKinMobile', 'NextOfKinMobile', '`NextOfKinMobile`', '`NextOfKinMobile`', 200, 255, -1, FALSE, '`NextOfKinMobile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKinMobile->Sortable = TRUE; // Allow sort
		$this->fields['NextOfKinMobile'] = &$this->NextOfKinMobile;

		// NextOfKinEmail
		$this->NextOfKinEmail = new DbField('councillor', 'councillor', 'x_NextOfKinEmail', 'NextOfKinEmail', '`NextOfKinEmail`', '`NextOfKinEmail`', 200, 255, -1, FALSE, '`NextOfKinEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NextOfKinEmail->Sortable = TRUE; // Allow sort
		$this->NextOfKinEmail->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['NextOfKinEmail'] = &$this->NextOfKinEmail;

		// AdditionalInformation
		$this->AdditionalInformation = new DbField('councillor', 'councillor', 'x_AdditionalInformation', 'AdditionalInformation', '`AdditionalInformation`', '`AdditionalInformation`', 201, 16777215, -1, FALSE, '`AdditionalInformation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->AdditionalInformation->Sortable = TRUE; // Allow sort
		$this->fields['AdditionalInformation'] = &$this->AdditionalInformation;

		// LastUserID
		$this->LastUserID = new DbField('councillor', 'councillor', 'x_LastUserID', 'LastUserID', '`LastUserID`', '`LastUserID`', 200, 15, -1, FALSE, '`LastUserID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUserID->Sortable = TRUE; // Allow sort
		$this->fields['LastUserID'] = &$this->LastUserID;

		// LastUpdated
		$this->LastUpdated = new DbField('councillor', 'councillor', 'x_LastUpdated', 'LastUpdated', '`LastUpdated`', CastDateFieldForLike("`LastUpdated`", 0, "DB"), 135, 19, 0, FALSE, '`LastUpdated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastUpdated->Sortable = TRUE; // Allow sort
		$this->LastUpdated->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['LastUpdated'] = &$this->LastUpdated;
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
		if ($this->getCurrentDetailTable() == "councillorship") {
			$detailUrl = $GLOBALS["councillorship"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_EmployeeID=" . urlencode($this->EmployeeID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "councillorlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`councillor`";
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
			$this->EmployeeID->setDbValue($conn->insert_ID());
			$rs['EmployeeID'] = $this->EmployeeID->DbValue;
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
		$this->LACode->DbValue = $row['LACode'];
		$this->FormerFileNumber->DbValue = $row['FormerFileNumber'];
		$this->NRC->DbValue = $row['NRC'];
		$this->Sex->DbValue = $row['Sex'];
		$this->Title->DbValue = $row['Title'];
		$this->Surname->DbValue = $row['Surname'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->MiddleName->DbValue = $row['MiddleName'];
		$this->MaritalStatus->DbValue = $row['MaritalStatus'];
		$this->MaidenName->DbValue = $row['MaidenName'];
		$this->DateOfBirth->DbValue = $row['DateOfBirth'];
		$this->CouncillorPhoto->Upload->DbValue = $row['CouncillorPhoto'];
		$this->AcademicQualification->DbValue = $row['AcademicQualification'];
		$this->ProfessionalQualification->DbValue = $row['ProfessionalQualification'];
		$this->MedicalCondition->DbValue = $row['MedicalCondition'];
		$this->PhysicalChallenge->DbValue = $row['PhysicalChallenge'];
		$this->PostalAddress->DbValue = $row['PostalAddress'];
		$this->PhysicalAddress->DbValue = $row['PhysicalAddress'];
		$this->TownOrVillage->DbValue = $row['TownOrVillage'];
		$this->Telephone->DbValue = $row['Telephone'];
		$this->Mobile->DbValue = $row['Mobile'];
		$this->Fax->DbValue = $row['Fax'];
		$this->_Email->DbValue = $row['Email'];
		$this->NumberOfBiologicalChildren->DbValue = $row['NumberOfBiologicalChildren'];
		$this->NumberOfDependants->DbValue = $row['NumberOfDependants'];
		$this->NextOfKin->DbValue = $row['NextOfKin'];
		$this->RelationshipCode->DbValue = $row['RelationshipCode'];
		$this->NextOfKinMobile->DbValue = $row['NextOfKinMobile'];
		$this->NextOfKinEmail->DbValue = $row['NextOfKinEmail'];
		$this->AdditionalInformation->DbValue = $row['AdditionalInformation'];
		$this->LastUserID->DbValue = $row['LastUserID'];
		$this->LastUpdated->DbValue = $row['LastUpdated'];
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
			return "councillorlist.php";
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
		if ($pageName == "councillorview.php")
			return $Language->phrase("View");
		elseif ($pageName == "councilloredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "councilloradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "councillorlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("councillorview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councillorview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "councilloradd.php?" . $this->getUrlParm($parm);
		else
			$url = "councilloradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("councilloredit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councilloredit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("councilloradd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("councilloradd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("councillordelete.php", $this->getUrlParm());
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
		$this->FormerFileNumber->setDbValue($rs->fields('FormerFileNumber'));
		$this->NRC->setDbValue($rs->fields('NRC'));
		$this->Sex->setDbValue($rs->fields('Sex'));
		$this->Title->setDbValue($rs->fields('Title'));
		$this->Surname->setDbValue($rs->fields('Surname'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->MaritalStatus->setDbValue($rs->fields('MaritalStatus'));
		$this->MaidenName->setDbValue($rs->fields('MaidenName'));
		$this->DateOfBirth->setDbValue($rs->fields('DateOfBirth'));
		$this->CouncillorPhoto->Upload->DbValue = $rs->fields('CouncillorPhoto');
		$this->AcademicQualification->setDbValue($rs->fields('AcademicQualification'));
		$this->ProfessionalQualification->setDbValue($rs->fields('ProfessionalQualification'));
		$this->MedicalCondition->setDbValue($rs->fields('MedicalCondition'));
		$this->PhysicalChallenge->setDbValue($rs->fields('PhysicalChallenge'));
		$this->PostalAddress->setDbValue($rs->fields('PostalAddress'));
		$this->PhysicalAddress->setDbValue($rs->fields('PhysicalAddress'));
		$this->TownOrVillage->setDbValue($rs->fields('TownOrVillage'));
		$this->Telephone->setDbValue($rs->fields('Telephone'));
		$this->Mobile->setDbValue($rs->fields('Mobile'));
		$this->Fax->setDbValue($rs->fields('Fax'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->NumberOfBiologicalChildren->setDbValue($rs->fields('NumberOfBiologicalChildren'));
		$this->NumberOfDependants->setDbValue($rs->fields('NumberOfDependants'));
		$this->NextOfKin->setDbValue($rs->fields('NextOfKin'));
		$this->RelationshipCode->setDbValue($rs->fields('RelationshipCode'));
		$this->NextOfKinMobile->setDbValue($rs->fields('NextOfKinMobile'));
		$this->NextOfKinEmail->setDbValue($rs->fields('NextOfKinEmail'));
		$this->AdditionalInformation->setDbValue($rs->fields('AdditionalInformation'));
		$this->LastUserID->setDbValue($rs->fields('LastUserID'));
		$this->LastUpdated->setDbValue($rs->fields('LastUpdated'));
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
		// FormerFileNumber
		// NRC
		// Sex
		// Title
		// Surname
		// FirstName
		// MiddleName
		// MaritalStatus
		// MaidenName

		$this->MaidenName->CellCssStyle = "white-space: nowrap;";

		// DateOfBirth
		// CouncillorPhoto
		// AcademicQualification
		// ProfessionalQualification
		// MedicalCondition
		// PhysicalChallenge
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// NumberOfBiologicalChildren
		// NumberOfDependants
		// NextOfKin
		// RelationshipCode
		// NextOfKinMobile
		// NextOfKinEmail
		// AdditionalInformation
		// LastUserID

		$this->LastUserID->CellCssStyle = "white-space: nowrap;";

		// LastUpdated
		$this->LastUpdated->CellCssStyle = "white-space: nowrap;";

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

		// FormerFileNumber
		$this->FormerFileNumber->ViewValue = $this->FormerFileNumber->CurrentValue;
		$this->FormerFileNumber->ViewCustomAttributes = "";

		// NRC
		$this->NRC->ViewValue = $this->NRC->CurrentValue;
		$this->NRC->ViewCustomAttributes = "";

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

		// MaidenName
		$this->MaidenName->ViewValue = $this->MaidenName->CurrentValue;
		$this->MaidenName->ViewCustomAttributes = "";

		// DateOfBirth
		$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
		$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
		$this->DateOfBirth->ViewCustomAttributes = "";

		// CouncillorPhoto
		if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->ViewValue = $this->EmployeeID->CurrentValue;
			$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
		} else {
			$this->CouncillorPhoto->ViewValue = "";
		}
		$this->CouncillorPhoto->ViewCustomAttributes = "";

		// AcademicQualification
		$curVal = strval($this->AcademicQualification->CurrentValue);
		if ($curVal != "") {
			$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			if ($this->AcademicQualification->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`AcademicQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AcademicQualification->ViewValue = $this->AcademicQualification->CurrentValue;
				}
			}
		} else {
			$this->AcademicQualification->ViewValue = NULL;
		}
		$this->AcademicQualification->ViewCustomAttributes = "";

		// ProfessionalQualification
		$curVal = strval($this->ProfessionalQualification->CurrentValue);
		if ($curVal != "") {
			$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			if ($this->ProfessionalQualification->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->CurrentValue;
				}
			}
		} else {
			$this->ProfessionalQualification->ViewValue = NULL;
		}
		$this->ProfessionalQualification->ViewCustomAttributes = "";

		// MedicalCondition
		$curVal = strval($this->MedicalCondition->CurrentValue);
		if ($curVal != "") {
			$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
			if ($this->MedicalCondition->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->MedicalCondition->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MedicalCondition->ViewValue = $this->MedicalCondition->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MedicalCondition->ViewValue = $this->MedicalCondition->CurrentValue;
				}
			}
		} else {
			$this->MedicalCondition->ViewValue = NULL;
		}
		$this->MedicalCondition->ViewCustomAttributes = "";

		// PhysicalChallenge
		$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->CurrentValue;
		$this->PhysicalChallenge->ViewCustomAttributes = "";

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

		// NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren->ViewValue = $this->NumberOfBiologicalChildren->CurrentValue;
		$this->NumberOfBiologicalChildren->ViewValue = FormatNumber($this->NumberOfBiologicalChildren->ViewValue, 0, -2, -2, -2);
		$this->NumberOfBiologicalChildren->CellCssStyle .= "text-align: right;";
		$this->NumberOfBiologicalChildren->ViewCustomAttributes = "";

		// NumberOfDependants
		$this->NumberOfDependants->ViewValue = $this->NumberOfDependants->CurrentValue;
		$this->NumberOfDependants->ViewValue = FormatNumber($this->NumberOfDependants->ViewValue, 0, -2, -2, -2);
		$this->NumberOfDependants->CellCssStyle .= "text-align: right;";
		$this->NumberOfDependants->ViewCustomAttributes = "";

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

		// LastUserID
		$this->LastUserID->ViewValue = $this->LastUserID->CurrentValue;
		$this->LastUserID->ViewCustomAttributes = "";

		// LastUpdated
		$this->LastUpdated->ViewValue = $this->LastUpdated->CurrentValue;
		$this->LastUpdated->ViewValue = FormatDateTime($this->LastUpdated->ViewValue, 0);
		$this->LastUpdated->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// LACode
		$this->LACode->LinkCustomAttributes = "";
		$this->LACode->HrefValue = "";
		$this->LACode->TooltipValue = "";

		// FormerFileNumber
		$this->FormerFileNumber->LinkCustomAttributes = "";
		$this->FormerFileNumber->HrefValue = "";
		$this->FormerFileNumber->TooltipValue = "";

		// NRC
		$this->NRC->LinkCustomAttributes = "";
		$this->NRC->HrefValue = "";
		$this->NRC->TooltipValue = "";

		// Sex
		$this->Sex->LinkCustomAttributes = "";
		$this->Sex->HrefValue = "";
		$this->Sex->TooltipValue = "";

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

		// MaritalStatus
		$this->MaritalStatus->LinkCustomAttributes = "";
		$this->MaritalStatus->HrefValue = "";
		$this->MaritalStatus->TooltipValue = "";

		// MaidenName
		$this->MaidenName->LinkCustomAttributes = "";
		$this->MaidenName->HrefValue = "";
		$this->MaidenName->TooltipValue = "";

		// DateOfBirth
		$this->DateOfBirth->LinkCustomAttributes = "";
		$this->DateOfBirth->HrefValue = "";
		$this->DateOfBirth->TooltipValue = "";

		// CouncillorPhoto
		$this->CouncillorPhoto->LinkCustomAttributes = "";
		if (!empty($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->HrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue);
			$this->CouncillorPhoto->LinkAttrs["target"] = "";
			if ($this->CouncillorPhoto->IsBlobImage && empty($this->CouncillorPhoto->LinkAttrs["target"]))
				$this->CouncillorPhoto->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->CouncillorPhoto->HrefValue = FullUrl($this->CouncillorPhoto->HrefValue, "href");
		} else {
			$this->CouncillorPhoto->HrefValue = "";
		}
		$this->CouncillorPhoto->ExportHrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue);
		$this->CouncillorPhoto->TooltipValue = "";

		// AcademicQualification
		$this->AcademicQualification->LinkCustomAttributes = "";
		$this->AcademicQualification->HrefValue = "";
		$this->AcademicQualification->TooltipValue = "";

		// ProfessionalQualification
		$this->ProfessionalQualification->LinkCustomAttributes = "";
		$this->ProfessionalQualification->HrefValue = "";
		$this->ProfessionalQualification->TooltipValue = "";

		// MedicalCondition
		$this->MedicalCondition->LinkCustomAttributes = "";
		$this->MedicalCondition->HrefValue = "";
		$this->MedicalCondition->TooltipValue = "";

		// PhysicalChallenge
		$this->PhysicalChallenge->LinkCustomAttributes = "";
		$this->PhysicalChallenge->HrefValue = "";
		$this->PhysicalChallenge->TooltipValue = "";

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

		// NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
		$this->NumberOfBiologicalChildren->HrefValue = "";
		$this->NumberOfBiologicalChildren->TooltipValue = "";

		// NumberOfDependants
		$this->NumberOfDependants->LinkCustomAttributes = "";
		$this->NumberOfDependants->HrefValue = "";
		$this->NumberOfDependants->TooltipValue = "";

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

		// LastUserID
		$this->LastUserID->LinkCustomAttributes = "";
		$this->LastUserID->HrefValue = "";
		$this->LastUserID->TooltipValue = "";

		// LastUpdated
		$this->LastUpdated->LinkCustomAttributes = "";
		$this->LastUpdated->HrefValue = "";
		$this->LastUpdated->TooltipValue = "";

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

		// FormerFileNumber
		$this->FormerFileNumber->EditAttrs["class"] = "form-control";
		$this->FormerFileNumber->EditCustomAttributes = "";
		if (!$this->FormerFileNumber->Raw)
			$this->FormerFileNumber->CurrentValue = HtmlDecode($this->FormerFileNumber->CurrentValue);
		$this->FormerFileNumber->EditValue = $this->FormerFileNumber->CurrentValue;
		$this->FormerFileNumber->PlaceHolder = RemoveHtml($this->FormerFileNumber->caption());

		// NRC
		$this->NRC->EditAttrs["class"] = "form-control";
		$this->NRC->EditCustomAttributes = "";
		if (!$this->NRC->Raw)
			$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
		$this->NRC->EditValue = $this->NRC->CurrentValue;
		$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

		// Sex
		$this->Sex->EditAttrs["class"] = "form-control";
		$this->Sex->EditCustomAttributes = "";

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

		// MaritalStatus
		$this->MaritalStatus->EditAttrs["class"] = "form-control";
		$this->MaritalStatus->EditCustomAttributes = "";

		// MaidenName
		$this->MaidenName->EditAttrs["class"] = "form-control";
		$this->MaidenName->EditCustomAttributes = "";
		if (!$this->MaidenName->Raw)
			$this->MaidenName->CurrentValue = HtmlDecode($this->MaidenName->CurrentValue);
		$this->MaidenName->EditValue = $this->MaidenName->CurrentValue;
		$this->MaidenName->PlaceHolder = RemoveHtml($this->MaidenName->caption());

		// DateOfBirth
		$this->DateOfBirth->EditAttrs["class"] = "form-control";
		$this->DateOfBirth->EditCustomAttributes = "";
		$this->DateOfBirth->EditValue = FormatDateTime($this->DateOfBirth->CurrentValue, 8);
		$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

		// CouncillorPhoto
		$this->CouncillorPhoto->EditAttrs["class"] = "form-control";
		$this->CouncillorPhoto->EditCustomAttributes = "";
		if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
			$this->CouncillorPhoto->EditValue = $this->EmployeeID->CurrentValue;
			$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
		} else {
			$this->CouncillorPhoto->EditValue = "";
		}

		// AcademicQualification
		$this->AcademicQualification->EditAttrs["class"] = "form-control";
		$this->AcademicQualification->EditCustomAttributes = "";

		// ProfessionalQualification
		$this->ProfessionalQualification->EditAttrs["class"] = "form-control";
		$this->ProfessionalQualification->EditCustomAttributes = "";

		// MedicalCondition
		$this->MedicalCondition->EditAttrs["class"] = "form-control";
		$this->MedicalCondition->EditCustomAttributes = "";

		// PhysicalChallenge
		$this->PhysicalChallenge->EditAttrs["class"] = "form-control";
		$this->PhysicalChallenge->EditCustomAttributes = "";
		$this->PhysicalChallenge->EditValue = $this->PhysicalChallenge->CurrentValue;
		$this->PhysicalChallenge->PlaceHolder = RemoveHtml($this->PhysicalChallenge->caption());

		// PostalAddress
		$this->PostalAddress->EditAttrs["class"] = "form-control";
		$this->PostalAddress->EditCustomAttributes = "";
		if (!$this->PostalAddress->Raw)
			$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
		$this->PostalAddress->EditValue = $this->PostalAddress->CurrentValue;
		$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

		// PhysicalAddress
		$this->PhysicalAddress->EditAttrs["class"] = "form-control";
		$this->PhysicalAddress->EditCustomAttributes = "";
		if (!$this->PhysicalAddress->Raw)
			$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
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

		// NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren->EditAttrs["class"] = "form-control";
		$this->NumberOfBiologicalChildren->EditCustomAttributes = "";
		$this->NumberOfBiologicalChildren->EditValue = $this->NumberOfBiologicalChildren->CurrentValue;
		$this->NumberOfBiologicalChildren->PlaceHolder = RemoveHtml($this->NumberOfBiologicalChildren->caption());

		// NumberOfDependants
		$this->NumberOfDependants->EditAttrs["class"] = "form-control";
		$this->NumberOfDependants->EditCustomAttributes = "";
		$this->NumberOfDependants->EditValue = $this->NumberOfDependants->CurrentValue;
		$this->NumberOfDependants->PlaceHolder = RemoveHtml($this->NumberOfDependants->caption());

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

		// LastUserID
		$this->LastUserID->EditAttrs["class"] = "form-control";
		$this->LastUserID->EditCustomAttributes = "";
		if (!$this->LastUserID->Raw)
			$this->LastUserID->CurrentValue = HtmlDecode($this->LastUserID->CurrentValue);
		$this->LastUserID->EditValue = $this->LastUserID->CurrentValue;
		$this->LastUserID->PlaceHolder = RemoveHtml($this->LastUserID->caption());

		// LastUpdated
		$this->LastUpdated->EditAttrs["class"] = "form-control";
		$this->LastUpdated->EditCustomAttributes = "";
		$this->LastUpdated->EditValue = FormatDateTime($this->LastUpdated->CurrentValue, 8);
		$this->LastUpdated->PlaceHolder = RemoveHtml($this->LastUpdated->caption());

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
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->CouncillorPhoto);
					$doc->exportCaption($this->AcademicQualification);
					$doc->exportCaption($this->ProfessionalQualification);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
				} else {
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->LACode);
					$doc->exportCaption($this->NRC);
					$doc->exportCaption($this->Sex);
					$doc->exportCaption($this->Title);
					$doc->exportCaption($this->Surname);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->MiddleName);
					$doc->exportCaption($this->MaritalStatus);
					$doc->exportCaption($this->DateOfBirth);
					$doc->exportCaption($this->AcademicQualification);
					$doc->exportCaption($this->ProfessionalQualification);
					$doc->exportCaption($this->PostalAddress);
					$doc->exportCaption($this->TownOrVillage);
					$doc->exportCaption($this->Telephone);
					$doc->exportCaption($this->Mobile);
					$doc->exportCaption($this->Fax);
					$doc->exportCaption($this->_Email);
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
						$doc->exportField($this->Sex);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->CouncillorPhoto);
						$doc->exportField($this->AcademicQualification);
						$doc->exportField($this->ProfessionalQualification);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
					} else {
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->LACode);
						$doc->exportField($this->NRC);
						$doc->exportField($this->Sex);
						$doc->exportField($this->Title);
						$doc->exportField($this->Surname);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->MiddleName);
						$doc->exportField($this->MaritalStatus);
						$doc->exportField($this->DateOfBirth);
						$doc->exportField($this->AcademicQualification);
						$doc->exportField($this->ProfessionalQualification);
						$doc->exportField($this->PostalAddress);
						$doc->exportField($this->TownOrVillage);
						$doc->exportField($this->Telephone);
						$doc->exportField($this->Mobile);
						$doc->exportField($this->Fax);
						$doc->exportField($this->_Email);
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
		if ($fldparm == 'CouncillorPhoto') {
			$fldName = "CouncillorPhoto";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->EmployeeID->CurrentValue = $ar[0];
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
		$table = 'councillor';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'councillor';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];

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
		$table = 'councillor';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['EmployeeID'];

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
		$table = 'councillor';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['EmployeeID'];

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
		$dept = executeRow("select count(security_matrix.DepartmentCode)as kountdept 
		from security_matrix, musers
		where security_matrix.usercode = musers.usercode and security_matrix.DepartmentCode is not null  
		and musers.username = '" . $username .     "'  ");
		if ($levelid >= 0)  {AddFilter($filter,"LACode  
		in   ( " . $la . ")");
		}

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

		$nrc = $rsnew["NRC"];
		$nat = substr($nrc,10,1);
		$dis = substr($nrc,7,2);
		$rowclose = executeRow("select PlanClosingDate from current_ref") ;

		//Check of NRC district is valid
		$row = ExecuteRow("SELECT * FROM district WHERE NRCCode = '" .$dis ."'");

	/*	if (!strlen($nrc)==9) {
			// Return error is NRC length <> 9
			$this->CancelMessage =  "A valid NRC must be 9 characters long. " ;
			 return FALSE;     
		 } */
		if (empty($row["NRCCode"])) {
			// Return error if valid district not found
			$this->CancelMessage =  "Invalid NRC district. " ;
			 return FALSE;     
		 }  
		if (!($nat==1||$nat==2)) {
			// Return error if NRC does not end with 1 or 2
			$this->CancelMessage =  "A valid NRC must end with 1 or 2." ;
			 return FALSE;
		 }
		 //Check age of employee is not below 21
		 $dob= $rsnew["DateOfBirth"];
		 $years = round((time()-strtotime($dob))/(3600*24*365.25));
		 if ($years < 21) {
			$this->CancelMessage =  "Councillor is under 21 years. Please correct" ;
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
		$nrc = $rsnew["NRC"];
		$nat = substr($nrc,10,1);
		$dis = substr($nrc,7,2);
		$rowclose = executeRow("select PlanClosingDate from current_ref") ;
		//Check of NRC district is valid
		$row = ExecuteRow("SELECT * FROM district WHERE NRCCode = '" .$dis ."'");

	/*	if (!strlen($nrc)==9) {
			// Return error is NRC length <> 9
			$this->CancelMessage =  "A valid NRC must be 9 characters long. " ;
			 return FALSE;     
		 } */
		if (empty($row["NRCCode"])) {
			// Return error if valid district not found
			$this->CancelMessage =  "Invalid NRC district. " ;
			 return FALSE;     
		 }  
		if (!($nat==1||$nat==2)) {
			// Return error if NRC does not end with 1 or 2
			$this->CancelMessage =  "A valid NRC must end with 1 or 2." ;
			 return FALSE;
		 }
		 //Check age of employee is not below 21
		 $dob= $rsnew["DateOfBirth"];
		 $years = round((time()-strtotime($dob))/(3600*24*365.25));
		 if ($years < 21) {
			$this->CancelMessage =  "Councillor is under 21 years. Please correct" ;
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