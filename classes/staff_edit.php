<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staff_edit extends staff
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staff';

	// Page object name
	public $PageObjName = "staff_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (staff)
		if (!isset($GLOBALS["staff"]) || get_class($GLOBALS["staff"]) == PROJECT_NAMESPACE . "staff") {
			$GLOBALS["staff"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staff"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staff');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (musers)
		$UserTable = $UserTable ?: new musers();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $staff;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staff);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "staffview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['EmployeeID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->EmployeeID->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;
	public $DetailPages; // Detail pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("stafflist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->LACode->setVisibility();
		$this->FormerFileNumber->setVisibility();
		$this->NRC->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->Sex->setVisibility();
		$this->StaffPhoto->setVisibility();
		$this->MaritalStatus->setVisibility();
		$this->MaidenName->setVisibility();
		$this->DateOfBirth->setVisibility();
		$this->AcademicQualification->setVisibility();
		$this->ProfessionalQualification->setVisibility();
		$this->MedicalCondition->setVisibility();
		$this->OtherMedicalConditions->setVisibility();
		$this->PhysicalChallenge->setVisibility();
		$this->PostalAddress->setVisibility();
		$this->PhysicalAddress->setVisibility();
		$this->TownOrVillage->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->_Email->setVisibility();
		$this->NumberOfBiologicalChildren->setVisibility();
		$this->NumberOfDependants->setVisibility();
		$this->NextOfKin->setVisibility();
		$this->RelationshipCode->setVisibility();
		$this->NextOfKinMobile->setVisibility();
		$this->NextOfKinEmail->setVisibility();
		$this->SpouseName->setVisibility();
		$this->SpouseNRC->setVisibility();
		$this->SpouseMobile->setVisibility();
		$this->SpouseEmail->setVisibility();
		$this->SpouseResidentialAddress->setVisibility();
		$this->AdditionalInformation->setVisibility();
		$this->LastUserID->Visible = FALSE;
		$this->LastUpdated->Visible = FALSE;
		$this->BankAccountNo->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->TaxNumber->setVisibility();
		$this->PensionNumber->setVisibility();
		$this->SocialSecurityNo->setVisibility();
		$this->ThirdParties->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->Title);
		$this->setupLookupOptions($this->Sex);
		$this->setupLookupOptions($this->MaritalStatus);
		$this->setupLookupOptions($this->AcademicQualification);
		$this->setupLookupOptions($this->ProfessionalQualification);
		$this->setupLookupOptions($this->MedicalCondition);
		$this->setupLookupOptions($this->OtherMedicalConditions);
		$this->setupLookupOptions($this->PhysicalChallenge);
		$this->setupLookupOptions($this->RelationshipCode);
		$this->setupLookupOptions($this->PaymentMethod);
		$this->setupLookupOptions($this->BankBranchCode);
		$this->setupLookupOptions($this->ThirdParties);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("stafflist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Key(0));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} elseif (Post("EmployeeID") !== NULL) {
				$this->EmployeeID->setFormValue(Post("EmployeeID"));
				$this->EmployeeID->setOldValue($this->EmployeeID->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Route(2));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_EmployeeID")) {
					$this->EmployeeID->setFormValue($CurrentForm->getValue("x_EmployeeID"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("EmployeeID") !== NULL) {
					$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->EmployeeID->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->EmployeeID->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("stafflist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->EmployeeID->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->EmployeeID->CurrentValue, $rs->fields('EmployeeID'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("stafflist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "stafflist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->StaffPhoto->Upload->Index = $CurrentForm->Index;
		$this->StaffPhoto->Upload->uploadFile();
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey)
			$this->EmployeeID->setFormValue($val);

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'FormerFileNumber' first before field var 'x_FormerFileNumber'
		$val = $CurrentForm->hasValue("FormerFileNumber") ? $CurrentForm->getValue("FormerFileNumber") : $CurrentForm->getValue("x_FormerFileNumber");
		if (!$this->FormerFileNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FormerFileNumber->Visible = FALSE; // Disable update for API request
			else
				$this->FormerFileNumber->setFormValue($val);
		}

		// Check field name 'NRC' first before field var 'x_NRC'
		$val = $CurrentForm->hasValue("NRC") ? $CurrentForm->getValue("NRC") : $CurrentForm->getValue("x_NRC");
		if (!$this->NRC->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NRC->Visible = FALSE; // Disable update for API request
			else
				$this->NRC->setFormValue($val);
		}

		// Check field name 'Title' first before field var 'x_Title'
		$val = $CurrentForm->hasValue("Title") ? $CurrentForm->getValue("Title") : $CurrentForm->getValue("x_Title");
		if (!$this->Title->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Title->Visible = FALSE; // Disable update for API request
			else
				$this->Title->setFormValue($val);
		}

		// Check field name 'Surname' first before field var 'x_Surname'
		$val = $CurrentForm->hasValue("Surname") ? $CurrentForm->getValue("Surname") : $CurrentForm->getValue("x_Surname");
		if (!$this->Surname->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Surname->Visible = FALSE; // Disable update for API request
			else
				$this->Surname->setFormValue($val);
		}

		// Check field name 'FirstName' first before field var 'x_FirstName'
		$val = $CurrentForm->hasValue("FirstName") ? $CurrentForm->getValue("FirstName") : $CurrentForm->getValue("x_FirstName");
		if (!$this->FirstName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FirstName->Visible = FALSE; // Disable update for API request
			else
				$this->FirstName->setFormValue($val);
		}

		// Check field name 'MiddleName' first before field var 'x_MiddleName'
		$val = $CurrentForm->hasValue("MiddleName") ? $CurrentForm->getValue("MiddleName") : $CurrentForm->getValue("x_MiddleName");
		if (!$this->MiddleName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MiddleName->Visible = FALSE; // Disable update for API request
			else
				$this->MiddleName->setFormValue($val);
		}

		// Check field name 'Sex' first before field var 'x_Sex'
		$val = $CurrentForm->hasValue("Sex") ? $CurrentForm->getValue("Sex") : $CurrentForm->getValue("x_Sex");
		if (!$this->Sex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Sex->Visible = FALSE; // Disable update for API request
			else
				$this->Sex->setFormValue($val);
		}

		// Check field name 'MaritalStatus' first before field var 'x_MaritalStatus'
		$val = $CurrentForm->hasValue("MaritalStatus") ? $CurrentForm->getValue("MaritalStatus") : $CurrentForm->getValue("x_MaritalStatus");
		if (!$this->MaritalStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaritalStatus->Visible = FALSE; // Disable update for API request
			else
				$this->MaritalStatus->setFormValue($val);
		}

		// Check field name 'MaidenName' first before field var 'x_MaidenName'
		$val = $CurrentForm->hasValue("MaidenName") ? $CurrentForm->getValue("MaidenName") : $CurrentForm->getValue("x_MaidenName");
		if (!$this->MaidenName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaidenName->Visible = FALSE; // Disable update for API request
			else
				$this->MaidenName->setFormValue($val);
		}

		// Check field name 'DateOfBirth' first before field var 'x_DateOfBirth'
		$val = $CurrentForm->hasValue("DateOfBirth") ? $CurrentForm->getValue("DateOfBirth") : $CurrentForm->getValue("x_DateOfBirth");
		if (!$this->DateOfBirth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfBirth->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfBirth->setFormValue($val);
			$this->DateOfBirth->CurrentValue = UnFormatDateTime($this->DateOfBirth->CurrentValue, 0);
		}

		// Check field name 'AcademicQualification' first before field var 'x_AcademicQualification'
		$val = $CurrentForm->hasValue("AcademicQualification") ? $CurrentForm->getValue("AcademicQualification") : $CurrentForm->getValue("x_AcademicQualification");
		if (!$this->AcademicQualification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AcademicQualification->Visible = FALSE; // Disable update for API request
			else
				$this->AcademicQualification->setFormValue($val);
		}

		// Check field name 'ProfessionalQualification' first before field var 'x_ProfessionalQualification'
		$val = $CurrentForm->hasValue("ProfessionalQualification") ? $CurrentForm->getValue("ProfessionalQualification") : $CurrentForm->getValue("x_ProfessionalQualification");
		if (!$this->ProfessionalQualification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProfessionalQualification->Visible = FALSE; // Disable update for API request
			else
				$this->ProfessionalQualification->setFormValue($val);
		}

		// Check field name 'MedicalCondition' first before field var 'x_MedicalCondition'
		$val = $CurrentForm->hasValue("MedicalCondition") ? $CurrentForm->getValue("MedicalCondition") : $CurrentForm->getValue("x_MedicalCondition");
		if (!$this->MedicalCondition->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MedicalCondition->Visible = FALSE; // Disable update for API request
			else
				$this->MedicalCondition->setFormValue($val);
		}

		// Check field name 'OtherMedicalConditions' first before field var 'x_OtherMedicalConditions'
		$val = $CurrentForm->hasValue("OtherMedicalConditions") ? $CurrentForm->getValue("OtherMedicalConditions") : $CurrentForm->getValue("x_OtherMedicalConditions");
		if (!$this->OtherMedicalConditions->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OtherMedicalConditions->Visible = FALSE; // Disable update for API request
			else
				$this->OtherMedicalConditions->setFormValue($val);
		}

		// Check field name 'PhysicalChallenge' first before field var 'x_PhysicalChallenge'
		$val = $CurrentForm->hasValue("PhysicalChallenge") ? $CurrentForm->getValue("PhysicalChallenge") : $CurrentForm->getValue("x_PhysicalChallenge");
		if (!$this->PhysicalChallenge->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalChallenge->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalChallenge->setFormValue($val);
		}

		// Check field name 'PostalAddress' first before field var 'x_PostalAddress'
		$val = $CurrentForm->hasValue("PostalAddress") ? $CurrentForm->getValue("PostalAddress") : $CurrentForm->getValue("x_PostalAddress");
		if (!$this->PostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PostalAddress->setFormValue($val);
		}

		// Check field name 'PhysicalAddress' first before field var 'x_PhysicalAddress'
		$val = $CurrentForm->hasValue("PhysicalAddress") ? $CurrentForm->getValue("PhysicalAddress") : $CurrentForm->getValue("x_PhysicalAddress");
		if (!$this->PhysicalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalAddress->setFormValue($val);
		}

		// Check field name 'TownOrVillage' first before field var 'x_TownOrVillage'
		$val = $CurrentForm->hasValue("TownOrVillage") ? $CurrentForm->getValue("TownOrVillage") : $CurrentForm->getValue("x_TownOrVillage");
		if (!$this->TownOrVillage->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TownOrVillage->Visible = FALSE; // Disable update for API request
			else
				$this->TownOrVillage->setFormValue($val);
		}

		// Check field name 'Telephone' first before field var 'x_Telephone'
		$val = $CurrentForm->hasValue("Telephone") ? $CurrentForm->getValue("Telephone") : $CurrentForm->getValue("x_Telephone");
		if (!$this->Telephone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Telephone->Visible = FALSE; // Disable update for API request
			else
				$this->Telephone->setFormValue($val);
		}

		// Check field name 'Mobile' first before field var 'x_Mobile'
		$val = $CurrentForm->hasValue("Mobile") ? $CurrentForm->getValue("Mobile") : $CurrentForm->getValue("x_Mobile");
		if (!$this->Mobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mobile->Visible = FALSE; // Disable update for API request
			else
				$this->Mobile->setFormValue($val);
		}

		// Check field name 'Fax' first before field var 'x_Fax'
		$val = $CurrentForm->hasValue("Fax") ? $CurrentForm->getValue("Fax") : $CurrentForm->getValue("x_Fax");
		if (!$this->Fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fax->Visible = FALSE; // Disable update for API request
			else
				$this->Fax->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'NumberOfBiologicalChildren' first before field var 'x_NumberOfBiologicalChildren'
		$val = $CurrentForm->hasValue("NumberOfBiologicalChildren") ? $CurrentForm->getValue("NumberOfBiologicalChildren") : $CurrentForm->getValue("x_NumberOfBiologicalChildren");
		if (!$this->NumberOfBiologicalChildren->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NumberOfBiologicalChildren->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfBiologicalChildren->setFormValue($val);
		}

		// Check field name 'NumberOfDependants' first before field var 'x_NumberOfDependants'
		$val = $CurrentForm->hasValue("NumberOfDependants") ? $CurrentForm->getValue("NumberOfDependants") : $CurrentForm->getValue("x_NumberOfDependants");
		if (!$this->NumberOfDependants->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NumberOfDependants->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfDependants->setFormValue($val);
		}

		// Check field name 'NextOfKin' first before field var 'x_NextOfKin'
		$val = $CurrentForm->hasValue("NextOfKin") ? $CurrentForm->getValue("NextOfKin") : $CurrentForm->getValue("x_NextOfKin");
		if (!$this->NextOfKin->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKin->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKin->setFormValue($val);
		}

		// Check field name 'RelationshipCode' first before field var 'x_RelationshipCode'
		$val = $CurrentForm->hasValue("RelationshipCode") ? $CurrentForm->getValue("RelationshipCode") : $CurrentForm->getValue("x_RelationshipCode");
		if (!$this->RelationshipCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RelationshipCode->Visible = FALSE; // Disable update for API request
			else
				$this->RelationshipCode->setFormValue($val);
		}

		// Check field name 'NextOfKinMobile' first before field var 'x_NextOfKinMobile'
		$val = $CurrentForm->hasValue("NextOfKinMobile") ? $CurrentForm->getValue("NextOfKinMobile") : $CurrentForm->getValue("x_NextOfKinMobile");
		if (!$this->NextOfKinMobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKinMobile->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKinMobile->setFormValue($val);
		}

		// Check field name 'NextOfKinEmail' first before field var 'x_NextOfKinEmail'
		$val = $CurrentForm->hasValue("NextOfKinEmail") ? $CurrentForm->getValue("NextOfKinEmail") : $CurrentForm->getValue("x_NextOfKinEmail");
		if (!$this->NextOfKinEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKinEmail->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKinEmail->setFormValue($val);
		}

		// Check field name 'SpouseName' first before field var 'x_SpouseName'
		$val = $CurrentForm->hasValue("SpouseName") ? $CurrentForm->getValue("SpouseName") : $CurrentForm->getValue("x_SpouseName");
		if (!$this->SpouseName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseName->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseName->setFormValue($val);
		}

		// Check field name 'SpouseNRC' first before field var 'x_SpouseNRC'
		$val = $CurrentForm->hasValue("SpouseNRC") ? $CurrentForm->getValue("SpouseNRC") : $CurrentForm->getValue("x_SpouseNRC");
		if (!$this->SpouseNRC->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseNRC->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseNRC->setFormValue($val);
		}

		// Check field name 'SpouseMobile' first before field var 'x_SpouseMobile'
		$val = $CurrentForm->hasValue("SpouseMobile") ? $CurrentForm->getValue("SpouseMobile") : $CurrentForm->getValue("x_SpouseMobile");
		if (!$this->SpouseMobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseMobile->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseMobile->setFormValue($val);
		}

		// Check field name 'SpouseEmail' first before field var 'x_SpouseEmail'
		$val = $CurrentForm->hasValue("SpouseEmail") ? $CurrentForm->getValue("SpouseEmail") : $CurrentForm->getValue("x_SpouseEmail");
		if (!$this->SpouseEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseEmail->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseEmail->setFormValue($val);
		}

		// Check field name 'SpouseResidentialAddress' first before field var 'x_SpouseResidentialAddress'
		$val = $CurrentForm->hasValue("SpouseResidentialAddress") ? $CurrentForm->getValue("SpouseResidentialAddress") : $CurrentForm->getValue("x_SpouseResidentialAddress");
		if (!$this->SpouseResidentialAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseResidentialAddress->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseResidentialAddress->setFormValue($val);
		}

		// Check field name 'AdditionalInformation' first before field var 'x_AdditionalInformation'
		$val = $CurrentForm->hasValue("AdditionalInformation") ? $CurrentForm->getValue("AdditionalInformation") : $CurrentForm->getValue("x_AdditionalInformation");
		if (!$this->AdditionalInformation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AdditionalInformation->Visible = FALSE; // Disable update for API request
			else
				$this->AdditionalInformation->setFormValue($val);
		}

		// Check field name 'BankAccountNo' first before field var 'x_BankAccountNo'
		$val = $CurrentForm->hasValue("BankAccountNo") ? $CurrentForm->getValue("BankAccountNo") : $CurrentForm->getValue("x_BankAccountNo");
		if (!$this->BankAccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankAccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->BankAccountNo->setFormValue($val);
		}

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}

		// Check field name 'BankBranchCode' first before field var 'x_BankBranchCode'
		$val = $CurrentForm->hasValue("BankBranchCode") ? $CurrentForm->getValue("BankBranchCode") : $CurrentForm->getValue("x_BankBranchCode");
		if (!$this->BankBranchCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankBranchCode->Visible = FALSE; // Disable update for API request
			else
				$this->BankBranchCode->setFormValue($val);
		}

		// Check field name 'TaxNumber' first before field var 'x_TaxNumber'
		$val = $CurrentForm->hasValue("TaxNumber") ? $CurrentForm->getValue("TaxNumber") : $CurrentForm->getValue("x_TaxNumber");
		if (!$this->TaxNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TaxNumber->Visible = FALSE; // Disable update for API request
			else
				$this->TaxNumber->setFormValue($val);
		}

		// Check field name 'PensionNumber' first before field var 'x_PensionNumber'
		$val = $CurrentForm->hasValue("PensionNumber") ? $CurrentForm->getValue("PensionNumber") : $CurrentForm->getValue("x_PensionNumber");
		if (!$this->PensionNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PensionNumber->Visible = FALSE; // Disable update for API request
			else
				$this->PensionNumber->setFormValue($val);
		}

		// Check field name 'SocialSecurityNo' first before field var 'x_SocialSecurityNo'
		$val = $CurrentForm->hasValue("SocialSecurityNo") ? $CurrentForm->getValue("SocialSecurityNo") : $CurrentForm->getValue("x_SocialSecurityNo");
		if (!$this->SocialSecurityNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SocialSecurityNo->Visible = FALSE; // Disable update for API request
			else
				$this->SocialSecurityNo->setFormValue($val);
		}

		// Check field name 'ThirdParties' first before field var 'x_ThirdParties'
		$val = $CurrentForm->hasValue("ThirdParties") ? $CurrentForm->getValue("ThirdParties") : $CurrentForm->getValue("x_ThirdParties");
		if (!$this->ThirdParties->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ThirdParties->Visible = FALSE; // Disable update for API request
			else
				$this->ThirdParties->setFormValue($val);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->FormerFileNumber->CurrentValue = $this->FormerFileNumber->FormValue;
		$this->NRC->CurrentValue = $this->NRC->FormValue;
		$this->Title->CurrentValue = $this->Title->FormValue;
		$this->Surname->CurrentValue = $this->Surname->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->MiddleName->CurrentValue = $this->MiddleName->FormValue;
		$this->Sex->CurrentValue = $this->Sex->FormValue;
		$this->MaritalStatus->CurrentValue = $this->MaritalStatus->FormValue;
		$this->MaidenName->CurrentValue = $this->MaidenName->FormValue;
		$this->DateOfBirth->CurrentValue = $this->DateOfBirth->FormValue;
		$this->DateOfBirth->CurrentValue = UnFormatDateTime($this->DateOfBirth->CurrentValue, 0);
		$this->AcademicQualification->CurrentValue = $this->AcademicQualification->FormValue;
		$this->ProfessionalQualification->CurrentValue = $this->ProfessionalQualification->FormValue;
		$this->MedicalCondition->CurrentValue = $this->MedicalCondition->FormValue;
		$this->OtherMedicalConditions->CurrentValue = $this->OtherMedicalConditions->FormValue;
		$this->PhysicalChallenge->CurrentValue = $this->PhysicalChallenge->FormValue;
		$this->PostalAddress->CurrentValue = $this->PostalAddress->FormValue;
		$this->PhysicalAddress->CurrentValue = $this->PhysicalAddress->FormValue;
		$this->TownOrVillage->CurrentValue = $this->TownOrVillage->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Fax->CurrentValue = $this->Fax->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->NumberOfBiologicalChildren->CurrentValue = $this->NumberOfBiologicalChildren->FormValue;
		$this->NumberOfDependants->CurrentValue = $this->NumberOfDependants->FormValue;
		$this->NextOfKin->CurrentValue = $this->NextOfKin->FormValue;
		$this->RelationshipCode->CurrentValue = $this->RelationshipCode->FormValue;
		$this->NextOfKinMobile->CurrentValue = $this->NextOfKinMobile->FormValue;
		$this->NextOfKinEmail->CurrentValue = $this->NextOfKinEmail->FormValue;
		$this->SpouseName->CurrentValue = $this->SpouseName->FormValue;
		$this->SpouseNRC->CurrentValue = $this->SpouseNRC->FormValue;
		$this->SpouseMobile->CurrentValue = $this->SpouseMobile->FormValue;
		$this->SpouseEmail->CurrentValue = $this->SpouseEmail->FormValue;
		$this->SpouseResidentialAddress->CurrentValue = $this->SpouseResidentialAddress->FormValue;
		$this->AdditionalInformation->CurrentValue = $this->AdditionalInformation->FormValue;
		$this->BankAccountNo->CurrentValue = $this->BankAccountNo->FormValue;
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->BankBranchCode->CurrentValue = $this->BankBranchCode->FormValue;
		$this->TaxNumber->CurrentValue = $this->TaxNumber->FormValue;
		$this->PensionNumber->CurrentValue = $this->PensionNumber->FormValue;
		$this->SocialSecurityNo->CurrentValue = $this->SocialSecurityNo->FormValue;
		$this->ThirdParties->CurrentValue = $this->ThirdParties->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->LACode->setDbValue($row['LACode']);
		$this->FormerFileNumber->setDbValue($row['FormerFileNumber']);
		$this->NRC->setDbValue($row['NRC']);
		$this->Title->setDbValue($row['Title']);
		$this->Surname->setDbValue($row['Surname']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->Sex->setDbValue($row['Sex']);
		$this->StaffPhoto->Upload->DbValue = $row['StaffPhoto'];
		if (is_array($this->StaffPhoto->Upload->DbValue) || is_object($this->StaffPhoto->Upload->DbValue)) // Byte array
			$this->StaffPhoto->Upload->DbValue = BytesToString($this->StaffPhoto->Upload->DbValue);
		$this->MaritalStatus->setDbValue($row['MaritalStatus']);
		$this->MaidenName->setDbValue($row['MaidenName']);
		$this->DateOfBirth->setDbValue($row['DateOfBirth']);
		$this->AcademicQualification->setDbValue($row['AcademicQualification']);
		$this->ProfessionalQualification->setDbValue($row['ProfessionalQualification']);
		$this->MedicalCondition->setDbValue($row['MedicalCondition']);
		$this->OtherMedicalConditions->setDbValue($row['OtherMedicalConditions']);
		$this->PhysicalChallenge->setDbValue($row['PhysicalChallenge']);
		$this->PostalAddress->setDbValue($row['PostalAddress']);
		$this->PhysicalAddress->setDbValue($row['PhysicalAddress']);
		$this->TownOrVillage->setDbValue($row['TownOrVillage']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Fax->setDbValue($row['Fax']);
		$this->_Email->setDbValue($row['Email']);
		$this->NumberOfBiologicalChildren->setDbValue($row['NumberOfBiologicalChildren']);
		$this->NumberOfDependants->setDbValue($row['NumberOfDependants']);
		$this->NextOfKin->setDbValue($row['NextOfKin']);
		$this->RelationshipCode->setDbValue($row['RelationshipCode']);
		$this->NextOfKinMobile->setDbValue($row['NextOfKinMobile']);
		$this->NextOfKinEmail->setDbValue($row['NextOfKinEmail']);
		$this->SpouseName->setDbValue($row['SpouseName']);
		$this->SpouseNRC->setDbValue($row['SpouseNRC']);
		$this->SpouseMobile->setDbValue($row['SpouseMobile']);
		$this->SpouseEmail->setDbValue($row['SpouseEmail']);
		$this->SpouseResidentialAddress->setDbValue($row['SpouseResidentialAddress']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->BankAccountNo->setDbValue($row['BankAccountNo']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->BankBranchCode->setDbValue($row['BankBranchCode']);
		$this->TaxNumber->setDbValue($row['TaxNumber']);
		$this->PensionNumber->setDbValue($row['PensionNumber']);
		$this->SocialSecurityNo->setDbValue($row['SocialSecurityNo']);
		$this->ThirdParties->setDbValue($row['ThirdParties']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['LACode'] = NULL;
		$row['FormerFileNumber'] = NULL;
		$row['NRC'] = NULL;
		$row['Title'] = NULL;
		$row['Surname'] = NULL;
		$row['FirstName'] = NULL;
		$row['MiddleName'] = NULL;
		$row['Sex'] = NULL;
		$row['StaffPhoto'] = NULL;
		$row['MaritalStatus'] = NULL;
		$row['MaidenName'] = NULL;
		$row['DateOfBirth'] = NULL;
		$row['AcademicQualification'] = NULL;
		$row['ProfessionalQualification'] = NULL;
		$row['MedicalCondition'] = NULL;
		$row['OtherMedicalConditions'] = NULL;
		$row['PhysicalChallenge'] = NULL;
		$row['PostalAddress'] = NULL;
		$row['PhysicalAddress'] = NULL;
		$row['TownOrVillage'] = NULL;
		$row['Telephone'] = NULL;
		$row['Mobile'] = NULL;
		$row['Fax'] = NULL;
		$row['Email'] = NULL;
		$row['NumberOfBiologicalChildren'] = NULL;
		$row['NumberOfDependants'] = NULL;
		$row['NextOfKin'] = NULL;
		$row['RelationshipCode'] = NULL;
		$row['NextOfKinMobile'] = NULL;
		$row['NextOfKinEmail'] = NULL;
		$row['SpouseName'] = NULL;
		$row['SpouseNRC'] = NULL;
		$row['SpouseMobile'] = NULL;
		$row['SpouseEmail'] = NULL;
		$row['SpouseResidentialAddress'] = NULL;
		$row['AdditionalInformation'] = NULL;
		$row['LastUserID'] = NULL;
		$row['LastUpdated'] = NULL;
		$row['BankAccountNo'] = NULL;
		$row['PaymentMethod'] = NULL;
		$row['BankBranchCode'] = NULL;
		$row['TaxNumber'] = NULL;
		$row['PensionNumber'] = NULL;
		$row['SocialSecurityNo'] = NULL;
		$row['ThirdParties'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("EmployeeID")) != "")
			$this->EmployeeID->OldValue = $this->getKey("EmployeeID"); // EmployeeID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// LACode
		// FormerFileNumber
		// NRC
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// StaffPhoto
		// MaritalStatus
		// MaidenName
		// DateOfBirth
		// AcademicQualification
		// ProfessionalQualification
		// MedicalCondition
		// OtherMedicalConditions
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
		// SpouseName
		// SpouseNRC
		// SpouseMobile
		// SpouseEmail
		// SpouseResidentialAddress
		// AdditionalInformation
		// LastUserID
		// LastUpdated
		// BankAccountNo
		// PaymentMethod
		// BankBranchCode
		// TaxNumber
		// PensionNumber
		// SocialSecurityNo
		// ThirdParties

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// StaffPhoto
			if (!EmptyValue($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->ViewValue = $this->EmployeeID->CurrentValue;
				$this->StaffPhoto->IsBlobImage = IsImageFile(ContentExtension($this->StaffPhoto->Upload->DbValue));
			} else {
				$this->StaffPhoto->ViewValue = "";
			}
			$this->StaffPhoto->ViewCustomAttributes = "";

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

			// OtherMedicalConditions
			$curVal = strval($this->OtherMedicalConditions->CurrentValue);
			if ($curVal != "") {
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
				if ($this->OtherMedicalConditions->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->CurrentValue;
					}
				}
			} else {
				$this->OtherMedicalConditions->ViewValue = NULL;
			}
			$this->OtherMedicalConditions->ViewCustomAttributes = "";

			// PhysicalChallenge
			$curVal = strval($this->PhysicalChallenge->CurrentValue);
			if ($curVal != "") {
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
				if ($this->PhysicalChallenge->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->CurrentValue;
					}
				}
			} else {
				$this->PhysicalChallenge->ViewValue = NULL;
			}
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
			$this->NumberOfBiologicalChildren->ViewCustomAttributes = "";

			// NumberOfDependants
			$this->NumberOfDependants->ViewValue = $this->NumberOfDependants->CurrentValue;
			$this->NumberOfDependants->ViewValue = FormatNumber($this->NumberOfDependants->ViewValue, 0, -2, -2, -2);
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

			// SpouseName
			$this->SpouseName->ViewValue = $this->SpouseName->CurrentValue;
			$this->SpouseName->ViewCustomAttributes = "";

			// SpouseNRC
			$this->SpouseNRC->ViewValue = $this->SpouseNRC->CurrentValue;
			$this->SpouseNRC->ViewCustomAttributes = "";

			// SpouseMobile
			$this->SpouseMobile->ViewValue = $this->SpouseMobile->CurrentValue;
			$this->SpouseMobile->ViewCustomAttributes = "";

			// SpouseEmail
			$this->SpouseEmail->ViewValue = $this->SpouseEmail->CurrentValue;
			$this->SpouseEmail->ViewCustomAttributes = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->ViewValue = $this->SpouseResidentialAddress->CurrentValue;
			$this->SpouseResidentialAddress->ViewCustomAttributes = "";

			// AdditionalInformation
			$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
			$this->AdditionalInformation->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// PaymentMethod
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// BankBranchCode
			$curVal = strval($this->BankBranchCode->CurrentValue);
			if ($curVal != "") {
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
				if ($this->BankBranchCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->BankBranchCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
					}
				}
			} else {
				$this->BankBranchCode->ViewValue = NULL;
			}
			$this->BankBranchCode->ViewCustomAttributes = "";

			// TaxNumber
			$this->TaxNumber->ViewValue = $this->TaxNumber->CurrentValue;
			$this->TaxNumber->ViewCustomAttributes = "";

			// PensionNumber
			$this->PensionNumber->ViewValue = $this->PensionNumber->CurrentValue;
			$this->PensionNumber->ViewCustomAttributes = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->ViewValue = $this->SocialSecurityNo->CurrentValue;
			$this->SocialSecurityNo->ViewCustomAttributes = "";

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

			// StaffPhoto
			$this->StaffPhoto->LinkCustomAttributes = "";
			if (!empty($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->HrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);
				$this->StaffPhoto->LinkAttrs["target"] = "";
				if ($this->StaffPhoto->IsBlobImage && empty($this->StaffPhoto->LinkAttrs["target"]))
					$this->StaffPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->StaffPhoto->HrefValue = FullUrl($this->StaffPhoto->HrefValue, "href");
			} else {
				$this->StaffPhoto->HrefValue = "";
			}
			$this->StaffPhoto->ExportHrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);
			$this->StaffPhoto->TooltipValue = "";

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

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";
			$this->OtherMedicalConditions->TooltipValue = "";

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

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";
			$this->SpouseName->TooltipValue = "";

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";
			$this->SpouseNRC->TooltipValue = "";

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";
			$this->SpouseMobile->TooltipValue = "";

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";
			$this->SpouseEmail->TooltipValue = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";
			$this->SpouseResidentialAddress->TooltipValue = "";

			// AdditionalInformation
			$this->AdditionalInformation->LinkCustomAttributes = "";
			$this->AdditionalInformation->HrefValue = "";
			$this->AdditionalInformation->TooltipValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";
			$this->TaxNumber->TooltipValue = "";

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";
			$this->PensionNumber->TooltipValue = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";
			$this->SocialSecurityNo->TooltipValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
			$this->ThirdParties->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// LACode
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->CurrentValue));
			if ($curVal != "")
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				if ($this->LACode->ViewValue == "")
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// FormerFileNumber
			$this->FormerFileNumber->EditAttrs["class"] = "form-control";
			$this->FormerFileNumber->EditCustomAttributes = "";
			if (!$this->FormerFileNumber->Raw)
				$this->FormerFileNumber->CurrentValue = HtmlDecode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->EditValue = HtmlEncode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->PlaceHolder = RemoveHtml($this->FormerFileNumber->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			$curVal = trim(strval($this->Title->CurrentValue));
			if ($curVal != "")
				$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
			else
				$this->Title->ViewValue = $this->Title->Lookup !== NULL && is_array($this->Title->Lookup->Options) ? $curVal : NULL;
			if ($this->Title->ViewValue !== NULL) { // Load from cache
				$this->Title->EditValue = array_values($this->Title->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Title`" . SearchString("=", $this->Title->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Title->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Title->EditValue = $arwrk;
			}

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->CurrentValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->CurrentValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// Sex
			$this->Sex->EditAttrs["class"] = "form-control";
			$this->Sex->EditCustomAttributes = "";
			$curVal = trim(strval($this->Sex->CurrentValue));
			if ($curVal != "")
				$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
			else
				$this->Sex->ViewValue = $this->Sex->Lookup !== NULL && is_array($this->Sex->Lookup->Options) ? $curVal : NULL;
			if ($this->Sex->ViewValue !== NULL) { // Load from cache
				$this->Sex->EditValue = array_values($this->Sex->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Sex`" . SearchString("=", $this->Sex->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Sex->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Sex->EditValue = $arwrk;
			}

			// StaffPhoto
			$this->StaffPhoto->EditAttrs["class"] = "form-control";
			$this->StaffPhoto->EditCustomAttributes = "";
			if (!EmptyValue($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->EditValue = $this->EmployeeID->CurrentValue;
				$this->StaffPhoto->IsBlobImage = IsImageFile(ContentExtension($this->StaffPhoto->Upload->DbValue));
			} else {
				$this->StaffPhoto->EditValue = "";
			}
			if ($this->isShow())
				RenderUploadField($this->StaffPhoto);

			// MaritalStatus
			$this->MaritalStatus->EditAttrs["class"] = "form-control";
			$this->MaritalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->MaritalStatus->CurrentValue));
			if ($curVal != "")
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
			else
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->Lookup !== NULL && is_array($this->MaritalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->MaritalStatus->ViewValue !== NULL) { // Load from cache
				$this->MaritalStatus->EditValue = array_values($this->MaritalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $this->MaritalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MaritalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MaritalStatus->EditValue = $arwrk;
			}

			// MaidenName
			$this->MaidenName->EditAttrs["class"] = "form-control";
			$this->MaidenName->EditCustomAttributes = "";
			if (!$this->MaidenName->Raw)
				$this->MaidenName->CurrentValue = HtmlDecode($this->MaidenName->CurrentValue);
			$this->MaidenName->EditValue = HtmlEncode($this->MaidenName->CurrentValue);
			$this->MaidenName->PlaceHolder = RemoveHtml($this->MaidenName->caption());

			// DateOfBirth
			$this->DateOfBirth->EditAttrs["class"] = "form-control";
			$this->DateOfBirth->EditCustomAttributes = "";
			$this->DateOfBirth->EditValue = HtmlEncode(FormatDateTime($this->DateOfBirth->CurrentValue, 8));
			$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

			// AcademicQualification
			$this->AcademicQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->AcademicQualification->CurrentValue));
			if ($curVal != "")
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			else
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->Lookup !== NULL && is_array($this->AcademicQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->AcademicQualification->ViewValue !== NULL) { // Load from cache
				$this->AcademicQualification->EditValue = array_values($this->AcademicQualification->Lookup->Options);
				if ($this->AcademicQualification->ViewValue == "")
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->AcademicQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
				} else {
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AcademicQualification->EditValue = $arwrk;
			}

			// ProfessionalQualification
			$this->ProfessionalQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProfessionalQualification->CurrentValue));
			if ($curVal != "")
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			else
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->Lookup !== NULL && is_array($this->ProfessionalQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->ProfessionalQualification->ViewValue !== NULL) { // Load from cache
				$this->ProfessionalQualification->EditValue = array_values($this->ProfessionalQualification->Lookup->Options);
				if ($this->ProfessionalQualification->ViewValue == "")
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->ProfessionalQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
				} else {
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProfessionalQualification->EditValue = $arwrk;
			}

			// MedicalCondition
			$this->MedicalCondition->EditAttrs["class"] = "form-control";
			$this->MedicalCondition->EditCustomAttributes = "";
			$curVal = trim(strval($this->MedicalCondition->CurrentValue));
			if ($curVal != "")
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
			else
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->Lookup !== NULL && is_array($this->MedicalCondition->Lookup->Options) ? $curVal : NULL;
			if ($this->MedicalCondition->ViewValue !== NULL) { // Load from cache
				$this->MedicalCondition->EditValue = array_values($this->MedicalCondition->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->MedicalCondition->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->MedicalCondition->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MedicalCondition->EditValue = $arwrk;
			}

			// OtherMedicalConditions
			$this->OtherMedicalConditions->EditAttrs["class"] = "form-control";
			$this->OtherMedicalConditions->EditCustomAttributes = "";
			$curVal = trim(strval($this->OtherMedicalConditions->CurrentValue));
			if ($curVal != "")
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
			else
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->Lookup !== NULL && is_array($this->OtherMedicalConditions->Lookup->Options) ? $curVal : NULL;
			if ($this->OtherMedicalConditions->ViewValue !== NULL) { // Load from cache
				$this->OtherMedicalConditions->EditValue = array_values($this->OtherMedicalConditions->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->OtherMedicalConditions->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OtherMedicalConditions->EditValue = $arwrk;
			}

			// PhysicalChallenge
			$this->PhysicalChallenge->EditAttrs["class"] = "form-control";
			$this->PhysicalChallenge->EditCustomAttributes = "";
			$curVal = trim(strval($this->PhysicalChallenge->CurrentValue));
			if ($curVal != "")
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
			else
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->Lookup !== NULL && is_array($this->PhysicalChallenge->Lookup->Options) ? $curVal : NULL;
			if ($this->PhysicalChallenge->ViewValue !== NULL) { // Load from cache
				$this->PhysicalChallenge->EditValue = array_values($this->PhysicalChallenge->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $this->PhysicalChallenge->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PhysicalChallenge->EditValue = $arwrk;
			}

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			if (!$this->PostalAddress->Raw)
				$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			if (!$this->PhysicalAddress->Raw)
				$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->EditValue = HtmlEncode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

			// TownOrVillage
			$this->TownOrVillage->EditAttrs["class"] = "form-control";
			$this->TownOrVillage->EditCustomAttributes = "";
			if (!$this->TownOrVillage->Raw)
				$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->EditValue = HtmlEncode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->CurrentValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->EditAttrs["class"] = "form-control";
			$this->NumberOfBiologicalChildren->EditCustomAttributes = "";
			$this->NumberOfBiologicalChildren->EditValue = HtmlEncode($this->NumberOfBiologicalChildren->CurrentValue);
			$this->NumberOfBiologicalChildren->PlaceHolder = RemoveHtml($this->NumberOfBiologicalChildren->caption());

			// NumberOfDependants
			$this->NumberOfDependants->EditAttrs["class"] = "form-control";
			$this->NumberOfDependants->EditCustomAttributes = "";
			$this->NumberOfDependants->EditValue = HtmlEncode($this->NumberOfDependants->CurrentValue);
			$this->NumberOfDependants->PlaceHolder = RemoveHtml($this->NumberOfDependants->caption());

			// NextOfKin
			$this->NextOfKin->EditAttrs["class"] = "form-control";
			$this->NextOfKin->EditCustomAttributes = "";
			if (!$this->NextOfKin->Raw)
				$this->NextOfKin->CurrentValue = HtmlDecode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->EditValue = HtmlEncode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->PlaceHolder = RemoveHtml($this->NextOfKin->caption());

			// RelationshipCode
			$this->RelationshipCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->RelationshipCode->CurrentValue));
			if ($curVal != "")
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
			else
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->Lookup !== NULL && is_array($this->RelationshipCode->Lookup->Options) ? $curVal : NULL;
			if ($this->RelationshipCode->ViewValue !== NULL) { // Load from cache
				$this->RelationshipCode->EditValue = array_values($this->RelationshipCode->Lookup->Options);
				if ($this->RelationshipCode->ViewValue == "")
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`RelationshipCode`" . SearchString("=", $this->RelationshipCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RelationshipCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
				} else {
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RelationshipCode->EditValue = $arwrk;
			}

			// NextOfKinMobile
			$this->NextOfKinMobile->EditAttrs["class"] = "form-control";
			$this->NextOfKinMobile->EditCustomAttributes = "";
			if (!$this->NextOfKinMobile->Raw)
				$this->NextOfKinMobile->CurrentValue = HtmlDecode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->EditValue = HtmlEncode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->PlaceHolder = RemoveHtml($this->NextOfKinMobile->caption());

			// NextOfKinEmail
			$this->NextOfKinEmail->EditAttrs["class"] = "form-control";
			$this->NextOfKinEmail->EditCustomAttributes = "";
			if (!$this->NextOfKinEmail->Raw)
				$this->NextOfKinEmail->CurrentValue = HtmlDecode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->EditValue = HtmlEncode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->PlaceHolder = RemoveHtml($this->NextOfKinEmail->caption());

			// SpouseName
			$this->SpouseName->EditAttrs["class"] = "form-control";
			$this->SpouseName->EditCustomAttributes = "";
			if (!$this->SpouseName->Raw)
				$this->SpouseName->CurrentValue = HtmlDecode($this->SpouseName->CurrentValue);
			$this->SpouseName->EditValue = HtmlEncode($this->SpouseName->CurrentValue);
			$this->SpouseName->PlaceHolder = RemoveHtml($this->SpouseName->caption());

			// SpouseNRC
			$this->SpouseNRC->EditAttrs["class"] = "form-control";
			$this->SpouseNRC->EditCustomAttributes = "";
			if (!$this->SpouseNRC->Raw)
				$this->SpouseNRC->CurrentValue = HtmlDecode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->EditValue = HtmlEncode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->PlaceHolder = RemoveHtml($this->SpouseNRC->caption());

			// SpouseMobile
			$this->SpouseMobile->EditAttrs["class"] = "form-control";
			$this->SpouseMobile->EditCustomAttributes = "";
			if (!$this->SpouseMobile->Raw)
				$this->SpouseMobile->CurrentValue = HtmlDecode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->EditValue = HtmlEncode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->PlaceHolder = RemoveHtml($this->SpouseMobile->caption());

			// SpouseEmail
			$this->SpouseEmail->EditAttrs["class"] = "form-control";
			$this->SpouseEmail->EditCustomAttributes = "";
			if (!$this->SpouseEmail->Raw)
				$this->SpouseEmail->CurrentValue = HtmlDecode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->EditValue = HtmlEncode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->PlaceHolder = RemoveHtml($this->SpouseEmail->caption());

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->EditAttrs["class"] = "form-control";
			$this->SpouseResidentialAddress->EditCustomAttributes = "";
			if (!$this->SpouseResidentialAddress->Raw)
				$this->SpouseResidentialAddress->CurrentValue = HtmlDecode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->EditValue = HtmlEncode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->PlaceHolder = RemoveHtml($this->SpouseResidentialAddress->caption());

			// AdditionalInformation
			$this->AdditionalInformation->EditAttrs["class"] = "form-control";
			$this->AdditionalInformation->EditCustomAttributes = "";
			$this->AdditionalInformation->EditValue = HtmlEncode($this->AdditionalInformation->CurrentValue);
			$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->CurrentValue));
			if ($curVal != "")
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PaymentMethod->EditValue = $arwrk;
			}

			// BankBranchCode
			$this->BankBranchCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BankBranchCode->CurrentValue));
			if ($curVal != "")
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			else
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->Lookup !== NULL && is_array($this->BankBranchCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BankBranchCode->ViewValue !== NULL) { // Load from cache
				$this->BankBranchCode->EditValue = array_values($this->BankBranchCode->Lookup->Options);
				if ($this->BankBranchCode->ViewValue == "")
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->BankBranchCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
				} else {
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BankBranchCode->EditValue = $arwrk;
			}

			// TaxNumber
			$this->TaxNumber->EditAttrs["class"] = "form-control";
			$this->TaxNumber->EditCustomAttributes = "";
			if (!$this->TaxNumber->Raw)
				$this->TaxNumber->CurrentValue = HtmlDecode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->EditValue = HtmlEncode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->PlaceHolder = RemoveHtml($this->TaxNumber->caption());

			// PensionNumber
			$this->PensionNumber->EditAttrs["class"] = "form-control";
			$this->PensionNumber->EditCustomAttributes = "";
			if (!$this->PensionNumber->Raw)
				$this->PensionNumber->CurrentValue = HtmlDecode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->EditValue = HtmlEncode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->PlaceHolder = RemoveHtml($this->PensionNumber->caption());

			// SocialSecurityNo
			$this->SocialSecurityNo->EditAttrs["class"] = "form-control";
			$this->SocialSecurityNo->EditCustomAttributes = "";
			if (!$this->SocialSecurityNo->Raw)
				$this->SocialSecurityNo->CurrentValue = HtmlDecode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->EditValue = HtmlEncode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->PlaceHolder = RemoveHtml($this->SocialSecurityNo->caption());

			// ThirdParties
			$this->ThirdParties->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdParties->CurrentValue));
			if ($curVal != "")
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			else
				$this->ThirdParties->ViewValue = $this->ThirdParties->Lookup !== NULL && is_array($this->ThirdParties->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdParties->ViewValue !== NULL) { // Load from cache
				$this->ThirdParties->EditValue = array_values($this->ThirdParties->Lookup->Options);
				if ($this->ThirdParties->ViewValue == "")
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ThirdParties->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ThirdParties->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdParties->EditValue = $arwrk;
			}

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";

			// StaffPhoto
			$this->StaffPhoto->LinkCustomAttributes = "";
			if (!empty($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->HrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);
				$this->StaffPhoto->LinkAttrs["target"] = "";
				if ($this->StaffPhoto->IsBlobImage && empty($this->StaffPhoto->LinkAttrs["target"]))
					$this->StaffPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->StaffPhoto->HrefValue = FullUrl($this->StaffPhoto->HrefValue, "href");
			} else {
				$this->StaffPhoto->HrefValue = "";
			}
			$this->StaffPhoto->ExportHrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";

			// MaidenName
			$this->MaidenName->LinkCustomAttributes = "";
			$this->MaidenName->HrefValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
			$this->NumberOfBiologicalChildren->HrefValue = "";

			// NumberOfDependants
			$this->NumberOfDependants->LinkCustomAttributes = "";
			$this->NumberOfDependants->HrefValue = "";

			// NextOfKin
			$this->NextOfKin->LinkCustomAttributes = "";
			$this->NextOfKin->HrefValue = "";

			// RelationshipCode
			$this->RelationshipCode->LinkCustomAttributes = "";
			$this->RelationshipCode->HrefValue = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->LinkCustomAttributes = "";
			$this->NextOfKinMobile->HrefValue = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->LinkCustomAttributes = "";
			$this->NextOfKinEmail->HrefValue = "";

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";

			// AdditionalInformation
			$this->AdditionalInformation->LinkCustomAttributes = "";
			$this->AdditionalInformation->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->FormerFileNumber->Required) {
			if (!$this->FormerFileNumber->IsDetailKey && $this->FormerFileNumber->FormValue != NULL && $this->FormerFileNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FormerFileNumber->caption(), $this->FormerFileNumber->RequiredErrorMessage));
			}
		}
		if ($this->NRC->Required) {
			if (!$this->NRC->IsDetailKey && $this->NRC->FormValue != NULL && $this->NRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NRC->caption(), $this->NRC->RequiredErrorMessage));
			}
		}
		if ($this->Title->Required) {
			if (!$this->Title->IsDetailKey && $this->Title->FormValue != NULL && $this->Title->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Title->caption(), $this->Title->RequiredErrorMessage));
			}
		}
		if ($this->Surname->Required) {
			if (!$this->Surname->IsDetailKey && $this->Surname->FormValue != NULL && $this->Surname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Surname->caption(), $this->Surname->RequiredErrorMessage));
			}
		}
		if ($this->FirstName->Required) {
			if (!$this->FirstName->IsDetailKey && $this->FirstName->FormValue != NULL && $this->FirstName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirstName->caption(), $this->FirstName->RequiredErrorMessage));
			}
		}
		if ($this->MiddleName->Required) {
			if (!$this->MiddleName->IsDetailKey && $this->MiddleName->FormValue != NULL && $this->MiddleName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MiddleName->caption(), $this->MiddleName->RequiredErrorMessage));
			}
		}
		if ($this->Sex->Required) {
			if (!$this->Sex->IsDetailKey && $this->Sex->FormValue != NULL && $this->Sex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sex->caption(), $this->Sex->RequiredErrorMessage));
			}
		}
		if ($this->StaffPhoto->Required) {
			if ($this->StaffPhoto->Upload->FileName == "" && !$this->StaffPhoto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->StaffPhoto->caption(), $this->StaffPhoto->RequiredErrorMessage));
			}
		}
		if ($this->MaritalStatus->Required) {
			if (!$this->MaritalStatus->IsDetailKey && $this->MaritalStatus->FormValue != NULL && $this->MaritalStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaritalStatus->caption(), $this->MaritalStatus->RequiredErrorMessage));
			}
		}
		if ($this->MaidenName->Required) {
			if (!$this->MaidenName->IsDetailKey && $this->MaidenName->FormValue != NULL && $this->MaidenName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaidenName->caption(), $this->MaidenName->RequiredErrorMessage));
			}
		}
		if ($this->DateOfBirth->Required) {
			if (!$this->DateOfBirth->IsDetailKey && $this->DateOfBirth->FormValue != NULL && $this->DateOfBirth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfBirth->caption(), $this->DateOfBirth->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfBirth->FormValue)) {
			AddMessage($FormError, $this->DateOfBirth->errorMessage());
		}
		if ($this->AcademicQualification->Required) {
			if (!$this->AcademicQualification->IsDetailKey && $this->AcademicQualification->FormValue != NULL && $this->AcademicQualification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AcademicQualification->caption(), $this->AcademicQualification->RequiredErrorMessage));
			}
		}
		if ($this->ProfessionalQualification->Required) {
			if (!$this->ProfessionalQualification->IsDetailKey && $this->ProfessionalQualification->FormValue != NULL && $this->ProfessionalQualification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProfessionalQualification->caption(), $this->ProfessionalQualification->RequiredErrorMessage));
			}
		}
		if ($this->MedicalCondition->Required) {
			if (!$this->MedicalCondition->IsDetailKey && $this->MedicalCondition->FormValue != NULL && $this->MedicalCondition->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MedicalCondition->caption(), $this->MedicalCondition->RequiredErrorMessage));
			}
		}
		if ($this->OtherMedicalConditions->Required) {
			if (!$this->OtherMedicalConditions->IsDetailKey && $this->OtherMedicalConditions->FormValue != NULL && $this->OtherMedicalConditions->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OtherMedicalConditions->caption(), $this->OtherMedicalConditions->RequiredErrorMessage));
			}
		}
		if ($this->PhysicalChallenge->Required) {
			if (!$this->PhysicalChallenge->IsDetailKey && $this->PhysicalChallenge->FormValue != NULL && $this->PhysicalChallenge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalChallenge->caption(), $this->PhysicalChallenge->RequiredErrorMessage));
			}
		}
		if ($this->PostalAddress->Required) {
			if (!$this->PostalAddress->IsDetailKey && $this->PostalAddress->FormValue != NULL && $this->PostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalAddress->caption(), $this->PostalAddress->RequiredErrorMessage));
			}
		}
		if ($this->PhysicalAddress->Required) {
			if (!$this->PhysicalAddress->IsDetailKey && $this->PhysicalAddress->FormValue != NULL && $this->PhysicalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalAddress->caption(), $this->PhysicalAddress->RequiredErrorMessage));
			}
		}
		if ($this->TownOrVillage->Required) {
			if (!$this->TownOrVillage->IsDetailKey && $this->TownOrVillage->FormValue != NULL && $this->TownOrVillage->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TownOrVillage->caption(), $this->TownOrVillage->RequiredErrorMessage));
			}
		}
		if ($this->Telephone->Required) {
			if (!$this->Telephone->IsDetailKey && $this->Telephone->FormValue != NULL && $this->Telephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telephone->caption(), $this->Telephone->RequiredErrorMessage));
			}
		}
		if ($this->Mobile->Required) {
			if (!$this->Mobile->IsDetailKey && $this->Mobile->FormValue != NULL && $this->Mobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mobile->caption(), $this->Mobile->RequiredErrorMessage));
			}
		}
		if ($this->Fax->Required) {
			if (!$this->Fax->IsDetailKey && $this->Fax->FormValue != NULL && $this->Fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fax->caption(), $this->Fax->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->_Email->FormValue)) {
			AddMessage($FormError, $this->_Email->errorMessage());
		}
		if ($this->NumberOfBiologicalChildren->Required) {
			if (!$this->NumberOfBiologicalChildren->IsDetailKey && $this->NumberOfBiologicalChildren->FormValue != NULL && $this->NumberOfBiologicalChildren->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumberOfBiologicalChildren->caption(), $this->NumberOfBiologicalChildren->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NumberOfBiologicalChildren->FormValue)) {
			AddMessage($FormError, $this->NumberOfBiologicalChildren->errorMessage());
		}
		if ($this->NumberOfDependants->Required) {
			if (!$this->NumberOfDependants->IsDetailKey && $this->NumberOfDependants->FormValue != NULL && $this->NumberOfDependants->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumberOfDependants->caption(), $this->NumberOfDependants->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NumberOfDependants->FormValue)) {
			AddMessage($FormError, $this->NumberOfDependants->errorMessage());
		}
		if ($this->NextOfKin->Required) {
			if (!$this->NextOfKin->IsDetailKey && $this->NextOfKin->FormValue != NULL && $this->NextOfKin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKin->caption(), $this->NextOfKin->RequiredErrorMessage));
			}
		}
		if ($this->RelationshipCode->Required) {
			if (!$this->RelationshipCode->IsDetailKey && $this->RelationshipCode->FormValue != NULL && $this->RelationshipCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RelationshipCode->caption(), $this->RelationshipCode->RequiredErrorMessage));
			}
		}
		if ($this->NextOfKinMobile->Required) {
			if (!$this->NextOfKinMobile->IsDetailKey && $this->NextOfKinMobile->FormValue != NULL && $this->NextOfKinMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKinMobile->caption(), $this->NextOfKinMobile->RequiredErrorMessage));
			}
		}
		if ($this->NextOfKinEmail->Required) {
			if (!$this->NextOfKinEmail->IsDetailKey && $this->NextOfKinEmail->FormValue != NULL && $this->NextOfKinEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKinEmail->caption(), $this->NextOfKinEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->NextOfKinEmail->FormValue)) {
			AddMessage($FormError, $this->NextOfKinEmail->errorMessage());
		}
		if ($this->SpouseName->Required) {
			if (!$this->SpouseName->IsDetailKey && $this->SpouseName->FormValue != NULL && $this->SpouseName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseName->caption(), $this->SpouseName->RequiredErrorMessage));
			}
		}
		if ($this->SpouseNRC->Required) {
			if (!$this->SpouseNRC->IsDetailKey && $this->SpouseNRC->FormValue != NULL && $this->SpouseNRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseNRC->caption(), $this->SpouseNRC->RequiredErrorMessage));
			}
		}
		if ($this->SpouseMobile->Required) {
			if (!$this->SpouseMobile->IsDetailKey && $this->SpouseMobile->FormValue != NULL && $this->SpouseMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseMobile->caption(), $this->SpouseMobile->RequiredErrorMessage));
			}
		}
		if ($this->SpouseEmail->Required) {
			if (!$this->SpouseEmail->IsDetailKey && $this->SpouseEmail->FormValue != NULL && $this->SpouseEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseEmail->caption(), $this->SpouseEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->SpouseEmail->FormValue)) {
			AddMessage($FormError, $this->SpouseEmail->errorMessage());
		}
		if ($this->SpouseResidentialAddress->Required) {
			if (!$this->SpouseResidentialAddress->IsDetailKey && $this->SpouseResidentialAddress->FormValue != NULL && $this->SpouseResidentialAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseResidentialAddress->caption(), $this->SpouseResidentialAddress->RequiredErrorMessage));
			}
		}
		if ($this->AdditionalInformation->Required) {
			if (!$this->AdditionalInformation->IsDetailKey && $this->AdditionalInformation->FormValue != NULL && $this->AdditionalInformation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AdditionalInformation->caption(), $this->AdditionalInformation->RequiredErrorMessage));
			}
		}
		if ($this->BankAccountNo->Required) {
			if (!$this->BankAccountNo->IsDetailKey && $this->BankAccountNo->FormValue != NULL && $this->BankAccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankAccountNo->caption(), $this->BankAccountNo->RequiredErrorMessage));
			}
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->BankBranchCode->Required) {
			if (!$this->BankBranchCode->IsDetailKey && $this->BankBranchCode->FormValue != NULL && $this->BankBranchCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankBranchCode->caption(), $this->BankBranchCode->RequiredErrorMessage));
			}
		}
		if ($this->TaxNumber->Required) {
			if (!$this->TaxNumber->IsDetailKey && $this->TaxNumber->FormValue != NULL && $this->TaxNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaxNumber->caption(), $this->TaxNumber->RequiredErrorMessage));
			}
		}
		if ($this->PensionNumber->Required) {
			if (!$this->PensionNumber->IsDetailKey && $this->PensionNumber->FormValue != NULL && $this->PensionNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PensionNumber->caption(), $this->PensionNumber->RequiredErrorMessage));
			}
		}
		if ($this->SocialSecurityNo->Required) {
			if (!$this->SocialSecurityNo->IsDetailKey && $this->SocialSecurityNo->FormValue != NULL && $this->SocialSecurityNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SocialSecurityNo->caption(), $this->SocialSecurityNo->RequiredErrorMessage));
			}
		}
		if ($this->ThirdParties->Required) {
			if ($this->ThirdParties->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThirdParties->caption(), $this->ThirdParties->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("staffchildren", $detailTblVar) && $GLOBALS["staffchildren"]->DetailEdit) {
			if (!isset($GLOBALS["staffchildren_grid"]))
				$GLOBALS["staffchildren_grid"] = new staffchildren_grid(); // Get detail page object
			$GLOBALS["staffchildren_grid"]->validateGridForm();
		}
		if (in_array("staffdisciplinary_action", $detailTblVar) && $GLOBALS["staffdisciplinary_action"]->DetailEdit) {
			if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
				$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid(); // Get detail page object
			$GLOBALS["staffdisciplinary_action_grid"]->validateGridForm();
		}
		if (in_array("staffdisciplinary_appeal", $detailTblVar) && $GLOBALS["staffdisciplinary_appeal"]->DetailEdit) {
			if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
				$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid(); // Get detail page object
			$GLOBALS["staffdisciplinary_appeal_grid"]->validateGridForm();
		}
		if (in_array("staffdisciplinary_case", $detailTblVar) && $GLOBALS["staffdisciplinary_case"]->DetailEdit) {
			if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
				$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid(); // Get detail page object
			$GLOBALS["staffdisciplinary_case_grid"]->validateGridForm();
		}
		if (in_array("staffexperience", $detailTblVar) && $GLOBALS["staffexperience"]->DetailEdit) {
			if (!isset($GLOBALS["staffexperience_grid"]))
				$GLOBALS["staffexperience_grid"] = new staffexperience_grid(); // Get detail page object
			$GLOBALS["staffexperience_grid"]->validateGridForm();
		}
		if (in_array("staffprofbodies", $detailTblVar) && $GLOBALS["staffprofbodies"]->DetailEdit) {
			if (!isset($GLOBALS["staffprofbodies_grid"]))
				$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid(); // Get detail page object
			$GLOBALS["staffprofbodies_grid"]->validateGridForm();
		}
		if (in_array("staffqualifications_academic", $detailTblVar) && $GLOBALS["staffqualifications_academic"]->DetailEdit) {
			if (!isset($GLOBALS["staffqualifications_academic_grid"]))
				$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid(); // Get detail page object
			$GLOBALS["staffqualifications_academic_grid"]->validateGridForm();
		}
		if (in_array("staffqualifications_prof", $detailTblVar) && $GLOBALS["staffqualifications_prof"]->DetailEdit) {
			if (!isset($GLOBALS["staffqualifications_prof_grid"]))
				$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid(); // Get detail page object
			$GLOBALS["staffqualifications_prof_grid"]->validateGridForm();
		}
		if (in_array("employment", $detailTblVar) && $GLOBALS["employment"]->DetailEdit) {
			if (!isset($GLOBALS["employment_grid"]))
				$GLOBALS["employment_grid"] = new employment_grid(); // Get detail page object
			$GLOBALS["employment_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		if ($this->NRC->CurrentValue != "") { // Check field with unique index
			$filterChk = "(`NRC` = '" . AdjustSql($this->NRC->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = "";
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->NRC->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->NRC->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// FormerFileNumber
			$this->FormerFileNumber->setDbValueDef($rsnew, $this->FormerFileNumber->CurrentValue, NULL, $this->FormerFileNumber->ReadOnly);

			// NRC
			$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", $this->NRC->ReadOnly);

			// Title
			$this->Title->setDbValueDef($rsnew, $this->Title->CurrentValue, NULL, $this->Title->ReadOnly);

			// Surname
			$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", $this->Surname->ReadOnly);

			// FirstName
			$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", $this->FirstName->ReadOnly);

			// MiddleName
			$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, NULL, $this->MiddleName->ReadOnly);

			// Sex
			$this->Sex->setDbValueDef($rsnew, $this->Sex->CurrentValue, "", $this->Sex->ReadOnly);

			// StaffPhoto
			if ($this->StaffPhoto->Visible && !$this->StaffPhoto->ReadOnly && !$this->StaffPhoto->Upload->KeepFile) {
				if ($this->StaffPhoto->Upload->Value == NULL) {
					$rsnew['StaffPhoto'] = NULL;
				} else {
					$rsnew['StaffPhoto'] = $this->StaffPhoto->Upload->Value;
				}
			}

			// MaritalStatus
			$this->MaritalStatus->setDbValueDef($rsnew, $this->MaritalStatus->CurrentValue, 0, $this->MaritalStatus->ReadOnly);

			// MaidenName
			$this->MaidenName->setDbValueDef($rsnew, $this->MaidenName->CurrentValue, NULL, $this->MaidenName->ReadOnly);

			// DateOfBirth
			$this->DateOfBirth->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfBirth->CurrentValue, 0), CurrentDate(), $this->DateOfBirth->ReadOnly);

			// AcademicQualification
			$this->AcademicQualification->setDbValueDef($rsnew, $this->AcademicQualification->CurrentValue, NULL, $this->AcademicQualification->ReadOnly);

			// ProfessionalQualification
			$this->ProfessionalQualification->setDbValueDef($rsnew, $this->ProfessionalQualification->CurrentValue, NULL, $this->ProfessionalQualification->ReadOnly);

			// MedicalCondition
			$this->MedicalCondition->setDbValueDef($rsnew, $this->MedicalCondition->CurrentValue, NULL, $this->MedicalCondition->ReadOnly);

			// OtherMedicalConditions
			$this->OtherMedicalConditions->setDbValueDef($rsnew, $this->OtherMedicalConditions->CurrentValue, NULL, $this->OtherMedicalConditions->ReadOnly);

			// PhysicalChallenge
			$this->PhysicalChallenge->setDbValueDef($rsnew, $this->PhysicalChallenge->CurrentValue, NULL, $this->PhysicalChallenge->ReadOnly);

			// PostalAddress
			$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, $this->PostalAddress->ReadOnly);

			// PhysicalAddress
			$this->PhysicalAddress->setDbValueDef($rsnew, $this->PhysicalAddress->CurrentValue, NULL, $this->PhysicalAddress->ReadOnly);

			// TownOrVillage
			$this->TownOrVillage->setDbValueDef($rsnew, $this->TownOrVillage->CurrentValue, NULL, $this->TownOrVillage->ReadOnly);

			// Telephone
			$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, $this->Telephone->ReadOnly);

			// Mobile
			$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, $this->Mobile->ReadOnly);

			// Fax
			$this->Fax->setDbValueDef($rsnew, $this->Fax->CurrentValue, NULL, $this->Fax->ReadOnly);

			// Email
			$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, $this->_Email->ReadOnly);

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->setDbValueDef($rsnew, $this->NumberOfBiologicalChildren->CurrentValue, NULL, $this->NumberOfBiologicalChildren->ReadOnly);

			// NumberOfDependants
			$this->NumberOfDependants->setDbValueDef($rsnew, $this->NumberOfDependants->CurrentValue, NULL, $this->NumberOfDependants->ReadOnly);

			// NextOfKin
			$this->NextOfKin->setDbValueDef($rsnew, $this->NextOfKin->CurrentValue, NULL, $this->NextOfKin->ReadOnly);

			// RelationshipCode
			$this->RelationshipCode->setDbValueDef($rsnew, $this->RelationshipCode->CurrentValue, NULL, $this->RelationshipCode->ReadOnly);

			// NextOfKinMobile
			$this->NextOfKinMobile->setDbValueDef($rsnew, $this->NextOfKinMobile->CurrentValue, NULL, $this->NextOfKinMobile->ReadOnly);

			// NextOfKinEmail
			$this->NextOfKinEmail->setDbValueDef($rsnew, $this->NextOfKinEmail->CurrentValue, NULL, $this->NextOfKinEmail->ReadOnly);

			// SpouseName
			$this->SpouseName->setDbValueDef($rsnew, $this->SpouseName->CurrentValue, NULL, $this->SpouseName->ReadOnly);

			// SpouseNRC
			$this->SpouseNRC->setDbValueDef($rsnew, $this->SpouseNRC->CurrentValue, NULL, $this->SpouseNRC->ReadOnly);

			// SpouseMobile
			$this->SpouseMobile->setDbValueDef($rsnew, $this->SpouseMobile->CurrentValue, NULL, $this->SpouseMobile->ReadOnly);

			// SpouseEmail
			$this->SpouseEmail->setDbValueDef($rsnew, $this->SpouseEmail->CurrentValue, NULL, $this->SpouseEmail->ReadOnly);

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->setDbValueDef($rsnew, $this->SpouseResidentialAddress->CurrentValue, NULL, $this->SpouseResidentialAddress->ReadOnly);

			// AdditionalInformation
			$this->AdditionalInformation->setDbValueDef($rsnew, $this->AdditionalInformation->CurrentValue, NULL, $this->AdditionalInformation->ReadOnly);

			// BankAccountNo
			$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, $this->BankAccountNo->ReadOnly);

			// PaymentMethod
			$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, $this->PaymentMethod->ReadOnly);

			// BankBranchCode
			$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, $this->BankBranchCode->ReadOnly);

			// TaxNumber
			$this->TaxNumber->setDbValueDef($rsnew, $this->TaxNumber->CurrentValue, NULL, $this->TaxNumber->ReadOnly);

			// PensionNumber
			$this->PensionNumber->setDbValueDef($rsnew, $this->PensionNumber->CurrentValue, NULL, $this->PensionNumber->ReadOnly);

			// SocialSecurityNo
			$this->SocialSecurityNo->setDbValueDef($rsnew, $this->SocialSecurityNo->CurrentValue, NULL, $this->SocialSecurityNo->ReadOnly);

			// ThirdParties
			$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, NULL, $this->ThirdParties->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("staffchildren", $detailTblVar) && $GLOBALS["staffchildren"]->DetailEdit) {
						if (!isset($GLOBALS["staffchildren_grid"]))
							$GLOBALS["staffchildren_grid"] = new staffchildren_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffchildren"); // Load user level of detail table
						$editRow = $GLOBALS["staffchildren_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffdisciplinary_action", $detailTblVar) && $GLOBALS["staffdisciplinary_action"]->DetailEdit) {
						if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
							$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffdisciplinary_action"); // Load user level of detail table
						$editRow = $GLOBALS["staffdisciplinary_action_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffdisciplinary_appeal", $detailTblVar) && $GLOBALS["staffdisciplinary_appeal"]->DetailEdit) {
						if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
							$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffdisciplinary_appeal"); // Load user level of detail table
						$editRow = $GLOBALS["staffdisciplinary_appeal_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffdisciplinary_case", $detailTblVar) && $GLOBALS["staffdisciplinary_case"]->DetailEdit) {
						if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
							$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffdisciplinary_case"); // Load user level of detail table
						$editRow = $GLOBALS["staffdisciplinary_case_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffexperience", $detailTblVar) && $GLOBALS["staffexperience"]->DetailEdit) {
						if (!isset($GLOBALS["staffexperience_grid"]))
							$GLOBALS["staffexperience_grid"] = new staffexperience_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffexperience"); // Load user level of detail table
						$editRow = $GLOBALS["staffexperience_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffprofbodies", $detailTblVar) && $GLOBALS["staffprofbodies"]->DetailEdit) {
						if (!isset($GLOBALS["staffprofbodies_grid"]))
							$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffprofbodies"); // Load user level of detail table
						$editRow = $GLOBALS["staffprofbodies_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffqualifications_academic", $detailTblVar) && $GLOBALS["staffqualifications_academic"]->DetailEdit) {
						if (!isset($GLOBALS["staffqualifications_academic_grid"]))
							$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffqualifications_academic"); // Load user level of detail table
						$editRow = $GLOBALS["staffqualifications_academic_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffqualifications_prof", $detailTblVar) && $GLOBALS["staffqualifications_prof"]->DetailEdit) {
						if (!isset($GLOBALS["staffqualifications_prof_grid"]))
							$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffqualifications_prof"); // Load user level of detail table
						$editRow = $GLOBALS["staffqualifications_prof_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("employment", $detailTblVar) && $GLOBALS["employment"]->DetailEdit) {
						if (!isset($GLOBALS["employment_grid"]))
							$GLOBALS["employment_grid"] = new employment_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "employment"); // Load user level of detail table
						$editRow = $GLOBALS["employment_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {

			// StaffPhoto
			CleanUploadTempPath($this->StaffPhoto, $this->StaffPhoto->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("staffchildren", $detailTblVar)) {
				if (!isset($GLOBALS["staffchildren_grid"]))
					$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
				if ($GLOBALS["staffchildren_grid"]->DetailEdit) {
					$GLOBALS["staffchildren_grid"]->CurrentMode = "edit";
					$GLOBALS["staffchildren_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffchildren_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffchildren_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffchildren_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffchildren_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffchildren_grid"]->EmployeeID->setSessionValue($GLOBALS["staffchildren_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffdisciplinary_action", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
					$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
				if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit) {
					$GLOBALS["staffdisciplinary_action_grid"]->CurrentMode = "edit";
					$GLOBALS["staffdisciplinary_action_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_action_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_action_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_action_grid"]->CaseNo->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("staffdisciplinary_appeal", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
					$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
				if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit) {
					$GLOBALS["staffdisciplinary_appeal_grid"]->CurrentMode = "edit";
					$GLOBALS["staffdisciplinary_appeal_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_appeal_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_appeal_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->setSessionValue(""); // Clear session key
					$GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("staffdisciplinary_case", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
					$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
				if ($GLOBALS["staffdisciplinary_case_grid"]->DetailEdit) {
					$GLOBALS["staffdisciplinary_case_grid"]->CurrentMode = "edit";
					$GLOBALS["staffdisciplinary_case_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_case_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_case_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffexperience", $detailTblVar)) {
				if (!isset($GLOBALS["staffexperience_grid"]))
					$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
				if ($GLOBALS["staffexperience_grid"]->DetailEdit) {
					$GLOBALS["staffexperience_grid"]->CurrentMode = "edit";
					$GLOBALS["staffexperience_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffexperience_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffexperience_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffexperience_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffexperience_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffexperience_grid"]->EmployeeID->setSessionValue($GLOBALS["staffexperience_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffprofbodies", $detailTblVar)) {
				if (!isset($GLOBALS["staffprofbodies_grid"]))
					$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
				if ($GLOBALS["staffprofbodies_grid"]->DetailEdit) {
					$GLOBALS["staffprofbodies_grid"]->CurrentMode = "edit";
					$GLOBALS["staffprofbodies_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffprofbodies_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffprofbodies_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->setSessionValue($GLOBALS["staffprofbodies_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffqualifications_academic", $detailTblVar)) {
				if (!isset($GLOBALS["staffqualifications_academic_grid"]))
					$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
				if ($GLOBALS["staffqualifications_academic_grid"]->DetailEdit) {
					$GLOBALS["staffqualifications_academic_grid"]->CurrentMode = "edit";
					$GLOBALS["staffqualifications_academic_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffqualifications_academic_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffqualifications_academic_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->setSessionValue($GLOBALS["staffqualifications_academic_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffqualifications_prof", $detailTblVar)) {
				if (!isset($GLOBALS["staffqualifications_prof_grid"]))
					$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
				if ($GLOBALS["staffqualifications_prof_grid"]->DetailEdit) {
					$GLOBALS["staffqualifications_prof_grid"]->CurrentMode = "edit";
					$GLOBALS["staffqualifications_prof_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffqualifications_prof_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffqualifications_prof_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->setSessionValue($GLOBALS["staffqualifications_prof_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("employment", $detailTblVar)) {
				if (!isset($GLOBALS["employment_grid"]))
					$GLOBALS["employment_grid"] = new employment_grid();
				if ($GLOBALS["employment_grid"]->DetailEdit) {
					$GLOBALS["employment_grid"]->CurrentMode = "edit";
					$GLOBALS["employment_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["employment_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employment_grid"]->setStartRecordNumber(1);
					$GLOBALS["employment_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["employment_grid"]->EmployeeID->setSessionValue($GLOBALS["employment_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["employment_grid"]->SubstantivePosition->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->SectionCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->DepartmentCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->LACode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->ProvinceCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->SalaryScale->setSessionValue(""); // Clear session key
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("stafflist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('staffchildren');
		$pages->add('staffdisciplinary_action');
		$pages->add('staffdisciplinary_appeal');
		$pages->add('staffdisciplinary_case');
		$pages->add('staffexperience');
		$pages->add('staffprofbodies');
		$pages->add('staffqualifications_academic');
		$pages->add('staffqualifications_prof');
		$pages->add('employment');
		$this->DetailPages = $pages;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_LACode":
					break;
				case "x_Title":
					break;
				case "x_Sex":
					break;
				case "x_MaritalStatus":
					break;
				case "x_AcademicQualification":
					break;
				case "x_ProfessionalQualification":
					break;
				case "x_MedicalCondition":
					break;
				case "x_OtherMedicalConditions":
					break;
				case "x_PhysicalChallenge":
					break;
				case "x_RelationshipCode":
					break;
				case "x_PaymentMethod":
					break;
				case "x_BankBranchCode":
					break;
				case "x_ThirdParties":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_LACode":
							break;
						case "x_Title":
							break;
						case "x_Sex":
							break;
						case "x_MaritalStatus":
							break;
						case "x_AcademicQualification":
							break;
						case "x_ProfessionalQualification":
							break;
						case "x_MedicalCondition":
							break;
						case "x_OtherMedicalConditions":
							break;
						case "x_PhysicalChallenge":
							break;
						case "x_RelationshipCode":
							break;
						case "x_PaymentMethod":
							break;
						case "x_BankBranchCode":
							break;
						case "x_ThirdParties":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>