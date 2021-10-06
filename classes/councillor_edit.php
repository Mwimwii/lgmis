<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class councillor_edit extends councillor
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'councillor';

	// Page object name
	public $PageObjName = "councillor_edit";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (councillor)
		if (!isset($GLOBALS["councillor"]) || get_class($GLOBALS["councillor"]) == PROJECT_NAMESPACE . "councillor") {
			$GLOBALS["councillor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["councillor"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'councillor');

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
		global $councillor;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($councillor);
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
					if ($pageName == "councillorview.php")
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
					$this->terminate(GetUrl("councillorlist.php"));
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
		$this->FormerFileNumber->Visible = FALSE;
		$this->NRC->setVisibility();
		$this->Sex->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->MaritalStatus->setVisibility();
		$this->MaidenName->Visible = FALSE;
		$this->DateOfBirth->setVisibility();
		$this->CouncillorPhoto->setVisibility();
		$this->AcademicQualification->setVisibility();
		$this->ProfessionalQualification->setVisibility();
		$this->MedicalCondition->Visible = FALSE;
		$this->PhysicalChallenge->Visible = FALSE;
		$this->PostalAddress->setVisibility();
		$this->PhysicalAddress->Visible = FALSE;
		$this->TownOrVillage->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->_Email->setVisibility();
		$this->NumberOfBiologicalChildren->Visible = FALSE;
		$this->NumberOfDependants->Visible = FALSE;
		$this->NextOfKin->Visible = FALSE;
		$this->RelationshipCode->Visible = FALSE;
		$this->NextOfKinMobile->Visible = FALSE;
		$this->NextOfKinEmail->Visible = FALSE;
		$this->AdditionalInformation->Visible = FALSE;
		$this->LastUserID->Visible = FALSE;
		$this->LastUpdated->Visible = FALSE;
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
		$this->setupLookupOptions($this->Sex);
		$this->setupLookupOptions($this->Title);
		$this->setupLookupOptions($this->MaritalStatus);
		$this->setupLookupOptions($this->AcademicQualification);
		$this->setupLookupOptions($this->ProfessionalQualification);
		$this->setupLookupOptions($this->MedicalCondition);
		$this->setupLookupOptions($this->RelationshipCode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("councillorlist.php");
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
				$this->terminate("councillorlist.php"); // Return to list page
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
					$this->terminate("councillorlist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "councillorlist.php")
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
		$this->CouncillorPhoto->Upload->Index = $CurrentForm->Index;
		$this->CouncillorPhoto->Upload->uploadFile();
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

		// Check field name 'NRC' first before field var 'x_NRC'
		$val = $CurrentForm->hasValue("NRC") ? $CurrentForm->getValue("NRC") : $CurrentForm->getValue("x_NRC");
		if (!$this->NRC->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NRC->Visible = FALSE; // Disable update for API request
			else
				$this->NRC->setFormValue($val);
		}

		// Check field name 'Sex' first before field var 'x_Sex'
		$val = $CurrentForm->hasValue("Sex") ? $CurrentForm->getValue("Sex") : $CurrentForm->getValue("x_Sex");
		if (!$this->Sex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Sex->Visible = FALSE; // Disable update for API request
			else
				$this->Sex->setFormValue($val);
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

		// Check field name 'MaritalStatus' first before field var 'x_MaritalStatus'
		$val = $CurrentForm->hasValue("MaritalStatus") ? $CurrentForm->getValue("MaritalStatus") : $CurrentForm->getValue("x_MaritalStatus");
		if (!$this->MaritalStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaritalStatus->Visible = FALSE; // Disable update for API request
			else
				$this->MaritalStatus->setFormValue($val);
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

		// Check field name 'PostalAddress' first before field var 'x_PostalAddress'
		$val = $CurrentForm->hasValue("PostalAddress") ? $CurrentForm->getValue("PostalAddress") : $CurrentForm->getValue("x_PostalAddress");
		if (!$this->PostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PostalAddress->setFormValue($val);
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
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->NRC->CurrentValue = $this->NRC->FormValue;
		$this->Sex->CurrentValue = $this->Sex->FormValue;
		$this->Title->CurrentValue = $this->Title->FormValue;
		$this->Surname->CurrentValue = $this->Surname->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->MiddleName->CurrentValue = $this->MiddleName->FormValue;
		$this->MaritalStatus->CurrentValue = $this->MaritalStatus->FormValue;
		$this->DateOfBirth->CurrentValue = $this->DateOfBirth->FormValue;
		$this->DateOfBirth->CurrentValue = UnFormatDateTime($this->DateOfBirth->CurrentValue, 0);
		$this->AcademicQualification->CurrentValue = $this->AcademicQualification->FormValue;
		$this->ProfessionalQualification->CurrentValue = $this->ProfessionalQualification->FormValue;
		$this->PostalAddress->CurrentValue = $this->PostalAddress->FormValue;
		$this->TownOrVillage->CurrentValue = $this->TownOrVillage->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Fax->CurrentValue = $this->Fax->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
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
		$this->Sex->setDbValue($row['Sex']);
		$this->Title->setDbValue($row['Title']);
		$this->Surname->setDbValue($row['Surname']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->MaritalStatus->setDbValue($row['MaritalStatus']);
		$this->MaidenName->setDbValue($row['MaidenName']);
		$this->DateOfBirth->setDbValue($row['DateOfBirth']);
		$this->CouncillorPhoto->Upload->DbValue = $row['CouncillorPhoto'];
		if (is_array($this->CouncillorPhoto->Upload->DbValue) || is_object($this->CouncillorPhoto->Upload->DbValue)) // Byte array
			$this->CouncillorPhoto->Upload->DbValue = BytesToString($this->CouncillorPhoto->Upload->DbValue);
		$this->AcademicQualification->setDbValue($row['AcademicQualification']);
		$this->ProfessionalQualification->setDbValue($row['ProfessionalQualification']);
		$this->MedicalCondition->setDbValue($row['MedicalCondition']);
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
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['LACode'] = NULL;
		$row['FormerFileNumber'] = NULL;
		$row['NRC'] = NULL;
		$row['Sex'] = NULL;
		$row['Title'] = NULL;
		$row['Surname'] = NULL;
		$row['FirstName'] = NULL;
		$row['MiddleName'] = NULL;
		$row['MaritalStatus'] = NULL;
		$row['MaidenName'] = NULL;
		$row['DateOfBirth'] = NULL;
		$row['CouncillorPhoto'] = NULL;
		$row['AcademicQualification'] = NULL;
		$row['ProfessionalQualification'] = NULL;
		$row['MedicalCondition'] = NULL;
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
		$row['AdditionalInformation'] = NULL;
		$row['LastUserID'] = NULL;
		$row['LastUpdated'] = NULL;
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
		// Sex
		// Title
		// Surname
		// FirstName
		// MiddleName
		// MaritalStatus
		// MaidenName
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
		// LastUpdated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// PostalAddress
			$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
			$this->PostalAddress->ViewCustomAttributes = "";

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

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

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

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";
			$this->PostalAddress->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
			$curVal = strval($this->LACode->CurrentValue);
			if ($curVal != "") {
				$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
					}
				}
			} else {
				$this->LACode->EditValue = NULL;
			}
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

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

			// DateOfBirth
			$this->DateOfBirth->EditAttrs["class"] = "form-control";
			$this->DateOfBirth->EditCustomAttributes = "";
			$this->DateOfBirth->EditValue = HtmlEncode(FormatDateTime($this->DateOfBirth->CurrentValue, 8));
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
			if ($this->isShow())
				RenderUploadField($this->CouncillorPhoto);

			// AcademicQualification
			$this->AcademicQualification->EditAttrs["class"] = "form-control";
			$this->AcademicQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->AcademicQualification->CurrentValue));
			if ($curVal != "")
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			else
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->Lookup !== NULL && is_array($this->AcademicQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->AcademicQualification->ViewValue !== NULL) { // Load from cache
				$this->AcademicQualification->EditValue = array_values($this->AcademicQualification->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->AcademicQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AcademicQualification->EditValue = $arwrk;
			}

			// ProfessionalQualification
			$this->ProfessionalQualification->EditAttrs["class"] = "form-control";
			$this->ProfessionalQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProfessionalQualification->CurrentValue));
			if ($curVal != "")
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			else
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->Lookup !== NULL && is_array($this->ProfessionalQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->ProfessionalQualification->ViewValue !== NULL) { // Load from cache
				$this->ProfessionalQualification->EditValue = array_values($this->ProfessionalQualification->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->ProfessionalQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProfessionalQualification->EditValue = $arwrk;
			}

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			if (!$this->PostalAddress->Raw)
				$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

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

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";

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

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";

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

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

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
		if ($this->NRC->Required) {
			if (!$this->NRC->IsDetailKey && $this->NRC->FormValue != NULL && $this->NRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NRC->caption(), $this->NRC->RequiredErrorMessage));
			}
		}
		if ($this->Sex->Required) {
			if (!$this->Sex->IsDetailKey && $this->Sex->FormValue != NULL && $this->Sex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sex->caption(), $this->Sex->RequiredErrorMessage));
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
		if ($this->MaritalStatus->Required) {
			if (!$this->MaritalStatus->IsDetailKey && $this->MaritalStatus->FormValue != NULL && $this->MaritalStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaritalStatus->caption(), $this->MaritalStatus->RequiredErrorMessage));
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
		if ($this->CouncillorPhoto->Required) {
			if ($this->CouncillorPhoto->Upload->FileName == "" && !$this->CouncillorPhoto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->CouncillorPhoto->caption(), $this->CouncillorPhoto->RequiredErrorMessage));
			}
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
		if ($this->PostalAddress->Required) {
			if (!$this->PostalAddress->IsDetailKey && $this->PostalAddress->FormValue != NULL && $this->PostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalAddress->caption(), $this->PostalAddress->RequiredErrorMessage));
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("councillorship", $detailTblVar) && $GLOBALS["councillorship"]->DetailEdit) {
			if (!isset($GLOBALS["councillorship_grid"]))
				$GLOBALS["councillorship_grid"] = new councillorship_grid(); // Get detail page object
			$GLOBALS["councillorship_grid"]->validateGridForm();
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

			// NRC
			$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", $this->NRC->ReadOnly);

			// Sex
			$this->Sex->setDbValueDef($rsnew, $this->Sex->CurrentValue, "", $this->Sex->ReadOnly);

			// Title
			$this->Title->setDbValueDef($rsnew, $this->Title->CurrentValue, NULL, $this->Title->ReadOnly);

			// Surname
			$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", $this->Surname->ReadOnly);

			// FirstName
			$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", $this->FirstName->ReadOnly);

			// MiddleName
			$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, NULL, $this->MiddleName->ReadOnly);

			// MaritalStatus
			$this->MaritalStatus->setDbValueDef($rsnew, $this->MaritalStatus->CurrentValue, 0, $this->MaritalStatus->ReadOnly);

			// DateOfBirth
			$this->DateOfBirth->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfBirth->CurrentValue, 0), CurrentDate(), $this->DateOfBirth->ReadOnly);

			// CouncillorPhoto
			if ($this->CouncillorPhoto->Visible && !$this->CouncillorPhoto->ReadOnly && !$this->CouncillorPhoto->Upload->KeepFile) {
				if ($this->CouncillorPhoto->Upload->Value == NULL) {
					$rsnew['CouncillorPhoto'] = NULL;
				} else {
					$rsnew['CouncillorPhoto'] = $this->CouncillorPhoto->Upload->Value;
				}
			}

			// AcademicQualification
			$this->AcademicQualification->setDbValueDef($rsnew, $this->AcademicQualification->CurrentValue, NULL, $this->AcademicQualification->ReadOnly);

			// ProfessionalQualification
			$this->ProfessionalQualification->setDbValueDef($rsnew, $this->ProfessionalQualification->CurrentValue, NULL, $this->ProfessionalQualification->ReadOnly);

			// PostalAddress
			$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, $this->PostalAddress->ReadOnly);

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
					if (in_array("councillorship", $detailTblVar) && $GLOBALS["councillorship"]->DetailEdit) {
						if (!isset($GLOBALS["councillorship_grid"]))
							$GLOBALS["councillorship_grid"] = new councillorship_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "councillorship"); // Load user level of detail table
						$editRow = $GLOBALS["councillorship_grid"]->gridUpdate();
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

			// CouncillorPhoto
			CleanUploadTempPath($this->CouncillorPhoto, $this->CouncillorPhoto->Upload->Index);
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
			if (in_array("councillorship", $detailTblVar)) {
				if (!isset($GLOBALS["councillorship_grid"]))
					$GLOBALS["councillorship_grid"] = new councillorship_grid();
				if ($GLOBALS["councillorship_grid"]->DetailEdit) {
					$GLOBALS["councillorship_grid"]->CurrentMode = "edit";
					$GLOBALS["councillorship_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["councillorship_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["councillorship_grid"]->setStartRecordNumber(1);
					$GLOBALS["councillorship_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["councillorship_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["councillorship_grid"]->EmployeeID->setSessionValue($GLOBALS["councillorship_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["councillorship_grid"]->LACode->setSessionValue(""); // Clear session key
					$GLOBALS["councillorship_grid"]->ProvinceCode->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("councillorlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_Sex":
					break;
				case "x_Title":
					break;
				case "x_MaritalStatus":
					break;
				case "x_AcademicQualification":
					break;
				case "x_ProfessionalQualification":
					break;
				case "x_MedicalCondition":
					break;
				case "x_RelationshipCode":
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
						case "x_Sex":
							break;
						case "x_Title":
							break;
						case "x_MaritalStatus":
							break;
						case "x_AcademicQualification":
							break;
						case "x_ProfessionalQualification":
							break;
						case "x_MedicalCondition":
							break;
						case "x_RelationshipCode":
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