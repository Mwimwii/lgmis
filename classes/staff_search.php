<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staff_search extends staff
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staff';

	// Page object name
	public $PageObjName = "staff_search";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
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
			if (!$Security->canSearch()) {
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
		$this->StaffPhoto->Visible = FALSE;
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
		$this->LastUserID->setVisibility();
		$this->LastUpdated->setVisibility();
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "stafflist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->EmployeeID); // EmployeeID
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->FormerFileNumber); // FormerFileNumber
		$this->buildSearchUrl($srchUrl, $this->NRC); // NRC
		$this->buildSearchUrl($srchUrl, $this->Title); // Title
		$this->buildSearchUrl($srchUrl, $this->Surname); // Surname
		$this->buildSearchUrl($srchUrl, $this->FirstName); // FirstName
		$this->buildSearchUrl($srchUrl, $this->MiddleName); // MiddleName
		$this->buildSearchUrl($srchUrl, $this->Sex); // Sex
		$this->buildSearchUrl($srchUrl, $this->MaritalStatus); // MaritalStatus
		$this->buildSearchUrl($srchUrl, $this->MaidenName); // MaidenName
		$this->buildSearchUrl($srchUrl, $this->DateOfBirth); // DateOfBirth
		$this->buildSearchUrl($srchUrl, $this->AcademicQualification); // AcademicQualification
		$this->buildSearchUrl($srchUrl, $this->ProfessionalQualification); // ProfessionalQualification
		$this->buildSearchUrl($srchUrl, $this->MedicalCondition); // MedicalCondition
		$this->buildSearchUrl($srchUrl, $this->OtherMedicalConditions); // OtherMedicalConditions
		$this->buildSearchUrl($srchUrl, $this->PhysicalChallenge); // PhysicalChallenge
		$this->buildSearchUrl($srchUrl, $this->PostalAddress); // PostalAddress
		$this->buildSearchUrl($srchUrl, $this->PhysicalAddress); // PhysicalAddress
		$this->buildSearchUrl($srchUrl, $this->TownOrVillage); // TownOrVillage
		$this->buildSearchUrl($srchUrl, $this->Telephone); // Telephone
		$this->buildSearchUrl($srchUrl, $this->Mobile); // Mobile
		$this->buildSearchUrl($srchUrl, $this->Fax); // Fax
		$this->buildSearchUrl($srchUrl, $this->_Email); // Email
		$this->buildSearchUrl($srchUrl, $this->NumberOfBiologicalChildren); // NumberOfBiologicalChildren
		$this->buildSearchUrl($srchUrl, $this->NumberOfDependants); // NumberOfDependants
		$this->buildSearchUrl($srchUrl, $this->NextOfKin); // NextOfKin
		$this->buildSearchUrl($srchUrl, $this->RelationshipCode); // RelationshipCode
		$this->buildSearchUrl($srchUrl, $this->NextOfKinMobile); // NextOfKinMobile
		$this->buildSearchUrl($srchUrl, $this->NextOfKinEmail); // NextOfKinEmail
		$this->buildSearchUrl($srchUrl, $this->SpouseName); // SpouseName
		$this->buildSearchUrl($srchUrl, $this->SpouseNRC); // SpouseNRC
		$this->buildSearchUrl($srchUrl, $this->SpouseMobile); // SpouseMobile
		$this->buildSearchUrl($srchUrl, $this->SpouseEmail); // SpouseEmail
		$this->buildSearchUrl($srchUrl, $this->SpouseResidentialAddress); // SpouseResidentialAddress
		$this->buildSearchUrl($srchUrl, $this->AdditionalInformation); // AdditionalInformation
		$this->buildSearchUrl($srchUrl, $this->LastUserID); // LastUserID
		$this->buildSearchUrl($srchUrl, $this->LastUpdated); // LastUpdated
		$this->buildSearchUrl($srchUrl, $this->BankAccountNo); // BankAccountNo
		$this->buildSearchUrl($srchUrl, $this->PaymentMethod); // PaymentMethod
		$this->buildSearchUrl($srchUrl, $this->BankBranchCode); // BankBranchCode
		$this->buildSearchUrl($srchUrl, $this->TaxNumber); // TaxNumber
		$this->buildSearchUrl($srchUrl, $this->PensionNumber); // PensionNumber
		$this->buildSearchUrl($srchUrl, $this->SocialSecurityNo); // SocialSecurityNo
		$this->buildSearchUrl($srchUrl, $this->ThirdParties); // ThirdParties
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->EmployeeID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->FormerFileNumber->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NRC->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Title->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Surname->AdvancedSearch->post())
			$got = TRUE;
		if ($this->FirstName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MiddleName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Sex->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MaritalStatus->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MaidenName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DateOfBirth->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AcademicQualification->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProfessionalQualification->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MedicalCondition->AdvancedSearch->post())
			$got = TRUE;
		if ($this->OtherMedicalConditions->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PhysicalChallenge->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PostalAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PhysicalAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TownOrVillage->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Telephone->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Mobile->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Fax->AdvancedSearch->post())
			$got = TRUE;
		if ($this->_Email->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NumberOfBiologicalChildren->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NumberOfDependants->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NextOfKin->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RelationshipCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NextOfKinMobile->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NextOfKinEmail->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SpouseName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SpouseNRC->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SpouseMobile->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SpouseEmail->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SpouseResidentialAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AdditionalInformation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastUserID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastUpdated->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BankAccountNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentMethod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BankBranchCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TaxNumber->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PensionNumber->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SocialSecurityNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ThirdParties->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->ThirdParties->AdvancedSearch->SearchValue))
			$this->ThirdParties->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ThirdParties->AdvancedSearch->SearchValue);
		if (is_array($this->ThirdParties->AdvancedSearch->SearchValue2))
			$this->ThirdParties->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ThirdParties->AdvancedSearch->SearchValue2);
		return $got;
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

			// LastUserID
			$this->LastUserID->ViewValue = $this->LastUserID->CurrentValue;
			$this->LastUserID->ViewCustomAttributes = "";

			// LastUpdated
			$this->LastUpdated->ViewValue = $this->LastUpdated->CurrentValue;
			$this->LastUpdated->ViewValue = FormatDateTime($this->LastUpdated->ViewValue, 0);
			$this->LastUpdated->ViewCustomAttributes = "";

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

			// LastUserID
			$this->LastUserID->LinkCustomAttributes = "";
			$this->LastUserID->HrefValue = "";
			$this->LastUserID->TooltipValue = "";

			// LastUpdated
			$this->LastUpdated->LinkCustomAttributes = "";
			$this->LastUpdated->HrefValue = "";
			$this->LastUpdated->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->AdvancedSearch->SearchValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// LACode
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				if ($this->LACode->AdvancedSearch->ViewValue == "")
					$this->LACode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->LACode->AdvancedSearch->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
				$this->FormerFileNumber->AdvancedSearch->SearchValue = HtmlDecode($this->FormerFileNumber->AdvancedSearch->SearchValue);
			$this->FormerFileNumber->EditValue = HtmlEncode($this->FormerFileNumber->AdvancedSearch->SearchValue);
			$this->FormerFileNumber->PlaceHolder = RemoveHtml($this->FormerFileNumber->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->AdvancedSearch->SearchValue = HtmlDecode($this->NRC->AdvancedSearch->SearchValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->AdvancedSearch->SearchValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			$curVal = trim(strval($this->Title->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Title->AdvancedSearch->ViewValue = $this->Title->lookupCacheOption($curVal);
			else
				$this->Title->AdvancedSearch->ViewValue = $this->Title->Lookup !== NULL && is_array($this->Title->Lookup->Options) ? $curVal : NULL;
			if ($this->Title->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Title->EditValue = array_values($this->Title->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Title`" . SearchString("=", $this->Title->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
				$this->Surname->AdvancedSearch->SearchValue = HtmlDecode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->AdvancedSearch->SearchValue = HtmlDecode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->AdvancedSearch->SearchValue = HtmlDecode($this->MiddleName->AdvancedSearch->SearchValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->AdvancedSearch->SearchValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// Sex
			$this->Sex->EditAttrs["class"] = "form-control";
			$this->Sex->EditCustomAttributes = "";
			$curVal = trim(strval($this->Sex->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Sex->AdvancedSearch->ViewValue = $this->Sex->lookupCacheOption($curVal);
			else
				$this->Sex->AdvancedSearch->ViewValue = $this->Sex->Lookup !== NULL && is_array($this->Sex->Lookup->Options) ? $curVal : NULL;
			if ($this->Sex->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Sex->EditValue = array_values($this->Sex->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Sex`" . SearchString("=", $this->Sex->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Sex->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Sex->EditValue = $arwrk;
			}

			// MaritalStatus
			$this->MaritalStatus->EditAttrs["class"] = "form-control";
			$this->MaritalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->MaritalStatus->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->MaritalStatus->AdvancedSearch->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
			else
				$this->MaritalStatus->AdvancedSearch->ViewValue = $this->MaritalStatus->Lookup !== NULL && is_array($this->MaritalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->MaritalStatus->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->MaritalStatus->EditValue = array_values($this->MaritalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $this->MaritalStatus->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
				$this->MaidenName->AdvancedSearch->SearchValue = HtmlDecode($this->MaidenName->AdvancedSearch->SearchValue);
			$this->MaidenName->EditValue = HtmlEncode($this->MaidenName->AdvancedSearch->SearchValue);
			$this->MaidenName->PlaceHolder = RemoveHtml($this->MaidenName->caption());

			// DateOfBirth
			$this->DateOfBirth->EditAttrs["class"] = "form-control";
			$this->DateOfBirth->EditCustomAttributes = "";
			$this->DateOfBirth->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfBirth->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

			// AcademicQualification
			$this->AcademicQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->AcademicQualification->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AcademicQualification->AdvancedSearch->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			else
				$this->AcademicQualification->AdvancedSearch->ViewValue = $this->AcademicQualification->Lookup !== NULL && is_array($this->AcademicQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->AcademicQualification->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AcademicQualification->EditValue = array_values($this->AcademicQualification->Lookup->Options);
				if ($this->AcademicQualification->AdvancedSearch->ViewValue == "")
					$this->AcademicQualification->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->AcademicQualification->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AcademicQualification->AdvancedSearch->ViewValue = $this->AcademicQualification->displayValue($arwrk);
				} else {
					$this->AcademicQualification->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AcademicQualification->EditValue = $arwrk;
			}

			// ProfessionalQualification
			$this->ProfessionalQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProfessionalQualification->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProfessionalQualification->AdvancedSearch->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			else
				$this->ProfessionalQualification->AdvancedSearch->ViewValue = $this->ProfessionalQualification->Lookup !== NULL && is_array($this->ProfessionalQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->ProfessionalQualification->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProfessionalQualification->EditValue = array_values($this->ProfessionalQualification->Lookup->Options);
				if ($this->ProfessionalQualification->AdvancedSearch->ViewValue == "")
					$this->ProfessionalQualification->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->ProfessionalQualification->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProfessionalQualification->AdvancedSearch->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
				} else {
					$this->ProfessionalQualification->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProfessionalQualification->EditValue = $arwrk;
			}

			// MedicalCondition
			$this->MedicalCondition->EditAttrs["class"] = "form-control";
			$this->MedicalCondition->EditCustomAttributes = "";
			$curVal = trim(strval($this->MedicalCondition->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->MedicalCondition->AdvancedSearch->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
			else
				$this->MedicalCondition->AdvancedSearch->ViewValue = $this->MedicalCondition->Lookup !== NULL && is_array($this->MedicalCondition->Lookup->Options) ? $curVal : NULL;
			if ($this->MedicalCondition->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->MedicalCondition->EditValue = array_values($this->MedicalCondition->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->MedicalCondition->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->OtherMedicalConditions->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->OtherMedicalConditions->AdvancedSearch->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
			else
				$this->OtherMedicalConditions->AdvancedSearch->ViewValue = $this->OtherMedicalConditions->Lookup !== NULL && is_array($this->OtherMedicalConditions->Lookup->Options) ? $curVal : NULL;
			if ($this->OtherMedicalConditions->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->OtherMedicalConditions->EditValue = array_values($this->OtherMedicalConditions->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->OtherMedicalConditions->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->PhysicalChallenge->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PhysicalChallenge->AdvancedSearch->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
			else
				$this->PhysicalChallenge->AdvancedSearch->ViewValue = $this->PhysicalChallenge->Lookup !== NULL && is_array($this->PhysicalChallenge->Lookup->Options) ? $curVal : NULL;
			if ($this->PhysicalChallenge->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PhysicalChallenge->EditValue = array_values($this->PhysicalChallenge->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $this->PhysicalChallenge->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
				$this->PostalAddress->AdvancedSearch->SearchValue = HtmlDecode($this->PostalAddress->AdvancedSearch->SearchValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->AdvancedSearch->SearchValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			if (!$this->PhysicalAddress->Raw)
				$this->PhysicalAddress->AdvancedSearch->SearchValue = HtmlDecode($this->PhysicalAddress->AdvancedSearch->SearchValue);
			$this->PhysicalAddress->EditValue = HtmlEncode($this->PhysicalAddress->AdvancedSearch->SearchValue);
			$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

			// TownOrVillage
			$this->TownOrVillage->EditAttrs["class"] = "form-control";
			$this->TownOrVillage->EditCustomAttributes = "";
			if (!$this->TownOrVillage->Raw)
				$this->TownOrVillage->AdvancedSearch->SearchValue = HtmlDecode($this->TownOrVillage->AdvancedSearch->SearchValue);
			$this->TownOrVillage->EditValue = HtmlEncode($this->TownOrVillage->AdvancedSearch->SearchValue);
			$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->AdvancedSearch->SearchValue = HtmlDecode($this->Telephone->AdvancedSearch->SearchValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->AdvancedSearch->SearchValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->AdvancedSearch->SearchValue = HtmlDecode($this->Mobile->AdvancedSearch->SearchValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->AdvancedSearch->SearchValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->AdvancedSearch->SearchValue = HtmlDecode($this->Fax->AdvancedSearch->SearchValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->AdvancedSearch->SearchValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->AdvancedSearch->SearchValue = HtmlDecode($this->_Email->AdvancedSearch->SearchValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->AdvancedSearch->SearchValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->EditAttrs["class"] = "form-control";
			$this->NumberOfBiologicalChildren->EditCustomAttributes = "";
			$this->NumberOfBiologicalChildren->EditValue = HtmlEncode($this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue);
			$this->NumberOfBiologicalChildren->PlaceHolder = RemoveHtml($this->NumberOfBiologicalChildren->caption());

			// NumberOfDependants
			$this->NumberOfDependants->EditAttrs["class"] = "form-control";
			$this->NumberOfDependants->EditCustomAttributes = "";
			$this->NumberOfDependants->EditValue = HtmlEncode($this->NumberOfDependants->AdvancedSearch->SearchValue);
			$this->NumberOfDependants->PlaceHolder = RemoveHtml($this->NumberOfDependants->caption());

			// NextOfKin
			$this->NextOfKin->EditAttrs["class"] = "form-control";
			$this->NextOfKin->EditCustomAttributes = "";
			if (!$this->NextOfKin->Raw)
				$this->NextOfKin->AdvancedSearch->SearchValue = HtmlDecode($this->NextOfKin->AdvancedSearch->SearchValue);
			$this->NextOfKin->EditValue = HtmlEncode($this->NextOfKin->AdvancedSearch->SearchValue);
			$this->NextOfKin->PlaceHolder = RemoveHtml($this->NextOfKin->caption());

			// RelationshipCode
			$this->RelationshipCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->RelationshipCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->RelationshipCode->AdvancedSearch->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
			else
				$this->RelationshipCode->AdvancedSearch->ViewValue = $this->RelationshipCode->Lookup !== NULL && is_array($this->RelationshipCode->Lookup->Options) ? $curVal : NULL;
			if ($this->RelationshipCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->RelationshipCode->EditValue = array_values($this->RelationshipCode->Lookup->Options);
				if ($this->RelationshipCode->AdvancedSearch->ViewValue == "")
					$this->RelationshipCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`RelationshipCode`" . SearchString("=", $this->RelationshipCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RelationshipCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->RelationshipCode->AdvancedSearch->ViewValue = $this->RelationshipCode->displayValue($arwrk);
				} else {
					$this->RelationshipCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
				$this->NextOfKinMobile->AdvancedSearch->SearchValue = HtmlDecode($this->NextOfKinMobile->AdvancedSearch->SearchValue);
			$this->NextOfKinMobile->EditValue = HtmlEncode($this->NextOfKinMobile->AdvancedSearch->SearchValue);
			$this->NextOfKinMobile->PlaceHolder = RemoveHtml($this->NextOfKinMobile->caption());

			// NextOfKinEmail
			$this->NextOfKinEmail->EditAttrs["class"] = "form-control";
			$this->NextOfKinEmail->EditCustomAttributes = "";
			if (!$this->NextOfKinEmail->Raw)
				$this->NextOfKinEmail->AdvancedSearch->SearchValue = HtmlDecode($this->NextOfKinEmail->AdvancedSearch->SearchValue);
			$this->NextOfKinEmail->EditValue = HtmlEncode($this->NextOfKinEmail->AdvancedSearch->SearchValue);
			$this->NextOfKinEmail->PlaceHolder = RemoveHtml($this->NextOfKinEmail->caption());

			// SpouseName
			$this->SpouseName->EditAttrs["class"] = "form-control";
			$this->SpouseName->EditCustomAttributes = "";
			if (!$this->SpouseName->Raw)
				$this->SpouseName->AdvancedSearch->SearchValue = HtmlDecode($this->SpouseName->AdvancedSearch->SearchValue);
			$this->SpouseName->EditValue = HtmlEncode($this->SpouseName->AdvancedSearch->SearchValue);
			$this->SpouseName->PlaceHolder = RemoveHtml($this->SpouseName->caption());

			// SpouseNRC
			$this->SpouseNRC->EditAttrs["class"] = "form-control";
			$this->SpouseNRC->EditCustomAttributes = "";
			if (!$this->SpouseNRC->Raw)
				$this->SpouseNRC->AdvancedSearch->SearchValue = HtmlDecode($this->SpouseNRC->AdvancedSearch->SearchValue);
			$this->SpouseNRC->EditValue = HtmlEncode($this->SpouseNRC->AdvancedSearch->SearchValue);
			$this->SpouseNRC->PlaceHolder = RemoveHtml($this->SpouseNRC->caption());

			// SpouseMobile
			$this->SpouseMobile->EditAttrs["class"] = "form-control";
			$this->SpouseMobile->EditCustomAttributes = "";
			if (!$this->SpouseMobile->Raw)
				$this->SpouseMobile->AdvancedSearch->SearchValue = HtmlDecode($this->SpouseMobile->AdvancedSearch->SearchValue);
			$this->SpouseMobile->EditValue = HtmlEncode($this->SpouseMobile->AdvancedSearch->SearchValue);
			$this->SpouseMobile->PlaceHolder = RemoveHtml($this->SpouseMobile->caption());

			// SpouseEmail
			$this->SpouseEmail->EditAttrs["class"] = "form-control";
			$this->SpouseEmail->EditCustomAttributes = "";
			if (!$this->SpouseEmail->Raw)
				$this->SpouseEmail->AdvancedSearch->SearchValue = HtmlDecode($this->SpouseEmail->AdvancedSearch->SearchValue);
			$this->SpouseEmail->EditValue = HtmlEncode($this->SpouseEmail->AdvancedSearch->SearchValue);
			$this->SpouseEmail->PlaceHolder = RemoveHtml($this->SpouseEmail->caption());

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->EditAttrs["class"] = "form-control";
			$this->SpouseResidentialAddress->EditCustomAttributes = "";
			if (!$this->SpouseResidentialAddress->Raw)
				$this->SpouseResidentialAddress->AdvancedSearch->SearchValue = HtmlDecode($this->SpouseResidentialAddress->AdvancedSearch->SearchValue);
			$this->SpouseResidentialAddress->EditValue = HtmlEncode($this->SpouseResidentialAddress->AdvancedSearch->SearchValue);
			$this->SpouseResidentialAddress->PlaceHolder = RemoveHtml($this->SpouseResidentialAddress->caption());

			// AdditionalInformation
			$this->AdditionalInformation->EditAttrs["class"] = "form-control";
			$this->AdditionalInformation->EditCustomAttributes = "";
			$this->AdditionalInformation->EditValue = HtmlEncode($this->AdditionalInformation->AdvancedSearch->SearchValue);
			$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

			// LastUserID
			$this->LastUserID->EditAttrs["class"] = "form-control";
			$this->LastUserID->EditCustomAttributes = "";
			if (!$this->LastUserID->Raw)
				$this->LastUserID->AdvancedSearch->SearchValue = HtmlDecode($this->LastUserID->AdvancedSearch->SearchValue);
			$this->LastUserID->EditValue = HtmlEncode($this->LastUserID->AdvancedSearch->SearchValue);
			$this->LastUserID->PlaceHolder = RemoveHtml($this->LastUserID->caption());

			// LastUpdated
			$this->LastUpdated->EditAttrs["class"] = "form-control";
			$this->LastUpdated->EditCustomAttributes = "";
			$this->LastUpdated->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LastUpdated->AdvancedSearch->SearchValue, 0), 8));
			$this->LastUpdated->PlaceHolder = RemoveHtml($this->LastUpdated->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->AdvancedSearch->SearchValue = HtmlDecode($this->BankAccountNo->AdvancedSearch->SearchValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->AdvancedSearch->SearchValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->BankBranchCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->BankBranchCode->AdvancedSearch->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			else
				$this->BankBranchCode->AdvancedSearch->ViewValue = $this->BankBranchCode->Lookup !== NULL && is_array($this->BankBranchCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BankBranchCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->BankBranchCode->EditValue = array_values($this->BankBranchCode->Lookup->Options);
				if ($this->BankBranchCode->AdvancedSearch->ViewValue == "")
					$this->BankBranchCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->BankBranchCode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BankBranchCode->AdvancedSearch->ViewValue = $this->BankBranchCode->displayValue($arwrk);
				} else {
					$this->BankBranchCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
				$this->TaxNumber->AdvancedSearch->SearchValue = HtmlDecode($this->TaxNumber->AdvancedSearch->SearchValue);
			$this->TaxNumber->EditValue = HtmlEncode($this->TaxNumber->AdvancedSearch->SearchValue);
			$this->TaxNumber->PlaceHolder = RemoveHtml($this->TaxNumber->caption());

			// PensionNumber
			$this->PensionNumber->EditAttrs["class"] = "form-control";
			$this->PensionNumber->EditCustomAttributes = "";
			if (!$this->PensionNumber->Raw)
				$this->PensionNumber->AdvancedSearch->SearchValue = HtmlDecode($this->PensionNumber->AdvancedSearch->SearchValue);
			$this->PensionNumber->EditValue = HtmlEncode($this->PensionNumber->AdvancedSearch->SearchValue);
			$this->PensionNumber->PlaceHolder = RemoveHtml($this->PensionNumber->caption());

			// SocialSecurityNo
			$this->SocialSecurityNo->EditAttrs["class"] = "form-control";
			$this->SocialSecurityNo->EditCustomAttributes = "";
			if (!$this->SocialSecurityNo->Raw)
				$this->SocialSecurityNo->AdvancedSearch->SearchValue = HtmlDecode($this->SocialSecurityNo->AdvancedSearch->SearchValue);
			$this->SocialSecurityNo->EditValue = HtmlEncode($this->SocialSecurityNo->AdvancedSearch->SearchValue);
			$this->SocialSecurityNo->PlaceHolder = RemoveHtml($this->SocialSecurityNo->caption());

			// ThirdParties
			$this->ThirdParties->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdParties->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ThirdParties->AdvancedSearch->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			else
				$this->ThirdParties->AdvancedSearch->ViewValue = $this->ThirdParties->Lookup !== NULL && is_array($this->ThirdParties->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdParties->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ThirdParties->EditValue = array_values($this->ThirdParties->Lookup->Options);
				if ($this->ThirdParties->AdvancedSearch->ViewValue == "")
					$this->ThirdParties->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
					$this->ThirdParties->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ThirdParties->AdvancedSearch->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ThirdParties->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdParties->EditValue = $arwrk;
			}
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->EmployeeID->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EmployeeID->errorMessage());
		}
		if (!CheckDate($this->DateOfBirth->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DateOfBirth->errorMessage());
		}
		if (!CheckInteger($this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->NumberOfBiologicalChildren->errorMessage());
		}
		if (!CheckInteger($this->NumberOfDependants->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->NumberOfDependants->errorMessage());
		}
		if (!CheckDate($this->LastUpdated->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LastUpdated->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->EmployeeID->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->FormerFileNumber->AdvancedSearch->load();
		$this->NRC->AdvancedSearch->load();
		$this->Title->AdvancedSearch->load();
		$this->Surname->AdvancedSearch->load();
		$this->FirstName->AdvancedSearch->load();
		$this->MiddleName->AdvancedSearch->load();
		$this->Sex->AdvancedSearch->load();
		$this->MaritalStatus->AdvancedSearch->load();
		$this->MaidenName->AdvancedSearch->load();
		$this->DateOfBirth->AdvancedSearch->load();
		$this->AcademicQualification->AdvancedSearch->load();
		$this->ProfessionalQualification->AdvancedSearch->load();
		$this->MedicalCondition->AdvancedSearch->load();
		$this->OtherMedicalConditions->AdvancedSearch->load();
		$this->PhysicalChallenge->AdvancedSearch->load();
		$this->PostalAddress->AdvancedSearch->load();
		$this->PhysicalAddress->AdvancedSearch->load();
		$this->TownOrVillage->AdvancedSearch->load();
		$this->Telephone->AdvancedSearch->load();
		$this->Mobile->AdvancedSearch->load();
		$this->Fax->AdvancedSearch->load();
		$this->_Email->AdvancedSearch->load();
		$this->NumberOfBiologicalChildren->AdvancedSearch->load();
		$this->NumberOfDependants->AdvancedSearch->load();
		$this->NextOfKin->AdvancedSearch->load();
		$this->RelationshipCode->AdvancedSearch->load();
		$this->NextOfKinMobile->AdvancedSearch->load();
		$this->NextOfKinEmail->AdvancedSearch->load();
		$this->SpouseName->AdvancedSearch->load();
		$this->SpouseNRC->AdvancedSearch->load();
		$this->SpouseMobile->AdvancedSearch->load();
		$this->SpouseEmail->AdvancedSearch->load();
		$this->SpouseResidentialAddress->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->LastUserID->AdvancedSearch->load();
		$this->LastUpdated->AdvancedSearch->load();
		$this->BankAccountNo->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->BankBranchCode->AdvancedSearch->load();
		$this->TaxNumber->AdvancedSearch->load();
		$this->PensionNumber->AdvancedSearch->load();
		$this->SocialSecurityNo->AdvancedSearch->load();
		$this->ThirdParties->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("stafflist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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