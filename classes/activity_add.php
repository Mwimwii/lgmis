<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class activity_add extends activity
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'activity';

	// Page object name
	public $PageObjName = "activity_add";

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

		// Table object (activity)
		if (!isset($GLOBALS["activity"]) || get_class($GLOBALS["activity"]) == PROJECT_NAMESPACE . "activity") {
			$GLOBALS["activity"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["activity"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (project)
		if (!isset($GLOBALS['project']))
			$GLOBALS['project'] = new project();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'activity');

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
		global $activity;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($activity);
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
					if ($pageName == "activityview.php")
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
			$key .= @$ar['ActivityCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['FinancialYear'];
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
			$this->ActivityCode->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("activitylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ProvinceCode->Visible = FALSE;
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->ProgrammeCode->setVisibility();
		$this->OucomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ProjectCode->setVisibility();
		$this->ActivityCode->Visible = FALSE;
		$this->FinancialYear->setVisibility();
		$this->ActivityName->setVisibility();
		$this->MTEFBudget->setVisibility();
		$this->SupplementaryBudget->setVisibility();
		$this->ExpectedAnnualAchievement->setVisibility();
		$this->ActivityLocation->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgrammeCode);
		$this->setupLookupOptions($this->OucomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ProjectCode);
		$this->setupLookupOptions($this->FinancialYear);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("activitylist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ActivityCode") !== NULL) {
				$this->ActivityCode->setQueryStringValue(Get("ActivityCode"));
				$this->setKey("ActivityCode", $this->ActivityCode->CurrentValue); // Set up key
			} else {
				$this->setKey("ActivityCode", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("FinancialYear") !== NULL) {
				$this->FinancialYear->setQueryStringValue(Get("FinancialYear"));
				$this->setKey("FinancialYear", $this->FinancialYear->CurrentValue); // Set up key
			} else {
				$this->setKey("FinancialYear", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("activitylist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "activitylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "activityview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->ProgrammeCode->CurrentValue = NULL;
		$this->ProgrammeCode->OldValue = $this->ProgrammeCode->CurrentValue;
		$this->OucomeCode->CurrentValue = NULL;
		$this->OucomeCode->OldValue = $this->OucomeCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->ProjectCode->CurrentValue = NULL;
		$this->ProjectCode->OldValue = $this->ProjectCode->CurrentValue;
		$this->ActivityCode->CurrentValue = NULL;
		$this->ActivityCode->OldValue = $this->ActivityCode->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->ActivityName->CurrentValue = NULL;
		$this->ActivityName->OldValue = $this->ActivityName->CurrentValue;
		$this->MTEFBudget->CurrentValue = 0;
		$this->SupplementaryBudget->CurrentValue = 0;
		$this->ExpectedAnnualAchievement->CurrentValue = NULL;
		$this->ExpectedAnnualAchievement->OldValue = $this->ExpectedAnnualAchievement->CurrentValue;
		$this->ActivityLocation->CurrentValue = NULL;
		$this->ActivityLocation->OldValue = $this->ActivityLocation->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'DepartmentCode' first before field var 'x_DepartmentCode'
		$val = $CurrentForm->hasValue("DepartmentCode") ? $CurrentForm->getValue("DepartmentCode") : $CurrentForm->getValue("x_DepartmentCode");
		if (!$this->DepartmentCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentCode->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentCode->setFormValue($val);
		}

		// Check field name 'SectionCode' first before field var 'x_SectionCode'
		$val = $CurrentForm->hasValue("SectionCode") ? $CurrentForm->getValue("SectionCode") : $CurrentForm->getValue("x_SectionCode");
		if (!$this->SectionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SectionCode->Visible = FALSE; // Disable update for API request
			else
				$this->SectionCode->setFormValue($val);
		}

		// Check field name 'ProgrammeCode' first before field var 'x_ProgrammeCode'
		$val = $CurrentForm->hasValue("ProgrammeCode") ? $CurrentForm->getValue("ProgrammeCode") : $CurrentForm->getValue("x_ProgrammeCode");
		if (!$this->ProgrammeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgrammeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProgrammeCode->setFormValue($val);
		}

		// Check field name 'OucomeCode' first before field var 'x_OucomeCode'
		$val = $CurrentForm->hasValue("OucomeCode") ? $CurrentForm->getValue("OucomeCode") : $CurrentForm->getValue("x_OucomeCode");
		if (!$this->OucomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OucomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->OucomeCode->setFormValue($val);
		}

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
		if (!$this->OutputCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutputCode->setFormValue($val);
		}

		// Check field name 'ProjectCode' first before field var 'x_ProjectCode'
		$val = $CurrentForm->hasValue("ProjectCode") ? $CurrentForm->getValue("ProjectCode") : $CurrentForm->getValue("x_ProjectCode");
		if (!$this->ProjectCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectCode->setFormValue($val);
		}

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}

		// Check field name 'ActivityName' first before field var 'x_ActivityName'
		$val = $CurrentForm->hasValue("ActivityName") ? $CurrentForm->getValue("ActivityName") : $CurrentForm->getValue("x_ActivityName");
		if (!$this->ActivityName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActivityName->Visible = FALSE; // Disable update for API request
			else
				$this->ActivityName->setFormValue($val);
		}

		// Check field name 'MTEFBudget' first before field var 'x_MTEFBudget'
		$val = $CurrentForm->hasValue("MTEFBudget") ? $CurrentForm->getValue("MTEFBudget") : $CurrentForm->getValue("x_MTEFBudget");
		if (!$this->MTEFBudget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MTEFBudget->Visible = FALSE; // Disable update for API request
			else
				$this->MTEFBudget->setFormValue($val);
		}

		// Check field name 'SupplementaryBudget' first before field var 'x_SupplementaryBudget'
		$val = $CurrentForm->hasValue("SupplementaryBudget") ? $CurrentForm->getValue("SupplementaryBudget") : $CurrentForm->getValue("x_SupplementaryBudget");
		if (!$this->SupplementaryBudget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SupplementaryBudget->Visible = FALSE; // Disable update for API request
			else
				$this->SupplementaryBudget->setFormValue($val);
		}

		// Check field name 'ExpectedAnnualAchievement' first before field var 'x_ExpectedAnnualAchievement'
		$val = $CurrentForm->hasValue("ExpectedAnnualAchievement") ? $CurrentForm->getValue("ExpectedAnnualAchievement") : $CurrentForm->getValue("x_ExpectedAnnualAchievement");
		if (!$this->ExpectedAnnualAchievement->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExpectedAnnualAchievement->Visible = FALSE; // Disable update for API request
			else
				$this->ExpectedAnnualAchievement->setFormValue($val);
		}

		// Check field name 'ActivityLocation' first before field var 'x_ActivityLocation'
		$val = $CurrentForm->hasValue("ActivityLocation") ? $CurrentForm->getValue("ActivityLocation") : $CurrentForm->getValue("x_ActivityLocation");
		if (!$this->ActivityLocation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActivityLocation->Visible = FALSE; // Disable update for API request
			else
				$this->ActivityLocation->setFormValue($val);
		}

		// Check field name 'ActivityCode' first before field var 'x_ActivityCode'
		$val = $CurrentForm->hasValue("ActivityCode") ? $CurrentForm->getValue("ActivityCode") : $CurrentForm->getValue("x_ActivityCode");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->ProgrammeCode->CurrentValue = $this->ProgrammeCode->FormValue;
		$this->OucomeCode->CurrentValue = $this->OucomeCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->ProjectCode->CurrentValue = $this->ProjectCode->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->ActivityName->CurrentValue = $this->ActivityName->FormValue;
		$this->MTEFBudget->CurrentValue = $this->MTEFBudget->FormValue;
		$this->SupplementaryBudget->CurrentValue = $this->SupplementaryBudget->FormValue;
		$this->ExpectedAnnualAchievement->CurrentValue = $this->ExpectedAnnualAchievement->FormValue;
		$this->ActivityLocation->CurrentValue = $this->ActivityLocation->FormValue;
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->ProgrammeCode->setDbValue($row['ProgrammeCode']);
		$this->OucomeCode->setDbValue($row['OucomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ProjectCode->setDbValue($row['ProjectCode']);
		$this->ActivityCode->setDbValue($row['ActivityCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->ActivityName->setDbValue($row['ActivityName']);
		$this->MTEFBudget->setDbValue($row['MTEFBudget']);
		$this->SupplementaryBudget->setDbValue($row['SupplementaryBudget']);
		$this->ExpectedAnnualAchievement->setDbValue($row['ExpectedAnnualAchievement']);
		$this->ActivityLocation->setDbValue($row['ActivityLocation']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ProgrammeCode'] = $this->ProgrammeCode->CurrentValue;
		$row['OucomeCode'] = $this->OucomeCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['ProjectCode'] = $this->ProjectCode->CurrentValue;
		$row['ActivityCode'] = $this->ActivityCode->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['ActivityName'] = $this->ActivityName->CurrentValue;
		$row['MTEFBudget'] = $this->MTEFBudget->CurrentValue;
		$row['SupplementaryBudget'] = $this->SupplementaryBudget->CurrentValue;
		$row['ExpectedAnnualAchievement'] = $this->ExpectedAnnualAchievement->CurrentValue;
		$row['ActivityLocation'] = $this->ActivityLocation->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ActivityCode")) != "")
			$this->ActivityCode->OldValue = $this->getKey("ActivityCode"); // ActivityCode
		else
			$validKey = FALSE;
		if (strval($this->getKey("FinancialYear")) != "")
			$this->FinancialYear->OldValue = $this->getKey("FinancialYear"); // FinancialYear
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
		// Convert decimal values if posted back

		if ($this->MTEFBudget->FormValue == $this->MTEFBudget->CurrentValue && is_numeric(ConvertToFloatString($this->MTEFBudget->CurrentValue)))
			$this->MTEFBudget->CurrentValue = ConvertToFloatString($this->MTEFBudget->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SupplementaryBudget->FormValue == $this->SupplementaryBudget->CurrentValue && is_numeric(ConvertToFloatString($this->SupplementaryBudget->CurrentValue)))
			$this->SupplementaryBudget->CurrentValue = ConvertToFloatString($this->SupplementaryBudget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ProgrammeCode
		// OucomeCode
		// OutputCode
		// ProjectCode
		// ActivityCode
		// FinancialYear
		// ActivityName
		// MTEFBudget
		// SupplementaryBudget
		// ExpectedAnnualAchievement
		// ActivityLocation

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// ProgrammeCode
			$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->CurrentValue;
			$curVal = strval($this->ProgrammeCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->lookupCacheOption($curVal);
				if ($this->ProgrammeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgRefCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProgrammeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgrammeCode->ViewValue = $this->ProgrammeCode->CurrentValue;
					}
				}
			} else {
				$this->ProgrammeCode->ViewValue = NULL;
			}
			$this->ProgrammeCode->ViewCustomAttributes = "";

			// OucomeCode
			$curVal = strval($this->OucomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OucomeCode->ViewValue = $this->OucomeCode->lookupCacheOption($curVal);
				if ($this->OucomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OucomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OucomeCode->ViewValue = $this->OucomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
					}
				}
			} else {
				$this->OucomeCode->ViewValue = NULL;
			}
			$this->OucomeCode->ViewCustomAttributes = "";

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

			// ProjectCode
			$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
			$curVal = strval($this->ProjectCode->CurrentValue);
			if ($curVal != "") {
				$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
					}
				}
			} else {
				$this->ProjectCode->ViewValue = NULL;
			}
			$this->ProjectCode->ViewCustomAttributes = "";

			// ActivityCode
			$this->ActivityCode->ViewValue = $this->ActivityCode->CurrentValue;
			$this->ActivityCode->ViewCustomAttributes = "";

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

			// ActivityName
			$this->ActivityName->ViewValue = $this->ActivityName->CurrentValue;
			$this->ActivityName->ViewCustomAttributes = "";

			// MTEFBudget
			$this->MTEFBudget->ViewValue = $this->MTEFBudget->CurrentValue;
			$this->MTEFBudget->ViewValue = FormatNumber($this->MTEFBudget->ViewValue, 2, -2, -2, -2);
			$this->MTEFBudget->CellCssStyle .= "text-align: right;";
			$this->MTEFBudget->ViewCustomAttributes = "";

			// SupplementaryBudget
			$this->SupplementaryBudget->ViewValue = $this->SupplementaryBudget->CurrentValue;
			$this->SupplementaryBudget->ViewValue = FormatNumber($this->SupplementaryBudget->ViewValue, 2, -2, -2, -2);
			$this->SupplementaryBudget->CellCssStyle .= "text-align: right;";
			$this->SupplementaryBudget->ViewCustomAttributes = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->ViewValue = $this->ExpectedAnnualAchievement->CurrentValue;
			$this->ExpectedAnnualAchievement->ViewCustomAttributes = "";

			// ActivityLocation
			$this->ActivityLocation->ViewValue = $this->ActivityLocation->CurrentValue;
			$this->ActivityLocation->ViewCustomAttributes = "";

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

			// ProgrammeCode
			$this->ProgrammeCode->LinkCustomAttributes = "";
			$this->ProgrammeCode->HrefValue = "";
			$this->ProgrammeCode->TooltipValue = "";

			// OucomeCode
			$this->OucomeCode->LinkCustomAttributes = "";
			$this->OucomeCode->HrefValue = "";
			$this->OucomeCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";
			$this->ProjectCode->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// ActivityName
			$this->ActivityName->LinkCustomAttributes = "";
			$this->ActivityName->HrefValue = "";
			$this->ActivityName->TooltipValue = "";

			// MTEFBudget
			$this->MTEFBudget->LinkCustomAttributes = "";
			$this->MTEFBudget->HrefValue = "";
			$this->MTEFBudget->TooltipValue = "";

			// SupplementaryBudget
			$this->SupplementaryBudget->LinkCustomAttributes = "";
			$this->SupplementaryBudget->HrefValue = "";
			$this->SupplementaryBudget->TooltipValue = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->LinkCustomAttributes = "";
			$this->ExpectedAnnualAchievement->HrefValue = "";
			$this->ExpectedAnnualAchievement->TooltipValue = "";

			// ActivityLocation
			$this->ActivityLocation->LinkCustomAttributes = "";
			$this->ActivityLocation->HrefValue = "";
			$this->ActivityLocation->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LACode
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
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					} else {
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// DepartmentCode
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
				$curVal = trim(strval($this->DepartmentCode->CurrentValue));
				if ($curVal != "")
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				else
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
				if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
					$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
					if ($this->DepartmentCode->ViewValue == "")
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					} else {
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
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
				$curVal = trim(strval($this->SectionCode->CurrentValue));
				if ($curVal != "")
					$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
				else
					$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
				if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
					$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
					if ($this->SectionCode->ViewValue == "")
						$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
					} else {
						$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->SectionCode->EditValue = $arwrk;
				}
			}

			// ProgrammeCode
			$this->ProgrammeCode->EditAttrs["class"] = "form-control";
			$this->ProgrammeCode->EditCustomAttributes = "";
			if (!$this->ProgrammeCode->Raw)
				$this->ProgrammeCode->CurrentValue = HtmlDecode($this->ProgrammeCode->CurrentValue);
			$this->ProgrammeCode->EditValue = HtmlEncode($this->ProgrammeCode->CurrentValue);
			$curVal = strval($this->ProgrammeCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgrammeCode->EditValue = $this->ProgrammeCode->lookupCacheOption($curVal);
				if ($this->ProgrammeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgRefCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProgrammeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgrammeCode->EditValue = $this->ProgrammeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgrammeCode->EditValue = HtmlEncode($this->ProgrammeCode->CurrentValue);
					}
				}
			} else {
				$this->ProgrammeCode->EditValue = NULL;
			}
			$this->ProgrammeCode->PlaceHolder = RemoveHtml($this->ProgrammeCode->caption());

			// OucomeCode
			$this->OucomeCode->EditAttrs["class"] = "form-control";
			$this->OucomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OucomeCode->CurrentValue));
			if ($curVal != "")
				$this->OucomeCode->ViewValue = $this->OucomeCode->lookupCacheOption($curVal);
			else
				$this->OucomeCode->ViewValue = $this->OucomeCode->Lookup !== NULL && is_array($this->OucomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OucomeCode->ViewValue !== NULL) { // Load from cache
				$this->OucomeCode->EditValue = array_values($this->OucomeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutcomeCode`" . SearchString("=", $this->OucomeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OucomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OucomeCode->EditValue = $arwrk;
			}

			// OutputCode
			$this->OutputCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputCode->CurrentValue));
			if ($curVal != "")
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
			else
				$this->OutputCode->ViewValue = $this->OutputCode->Lookup !== NULL && is_array($this->OutputCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputCode->ViewValue !== NULL) { // Load from cache
				$this->OutputCode->EditValue = array_values($this->OutputCode->Lookup->Options);
				if ($this->OutputCode->ViewValue == "")
					$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutputCode`" . SearchString("=", $this->OutputCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutputCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
				} else {
					$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputCode->EditValue = $arwrk;
			}

			// ProjectCode
			$this->ProjectCode->EditAttrs["class"] = "form-control";
			$this->ProjectCode->EditCustomAttributes = "";
			if ($this->ProjectCode->getSessionValue() != "") {
				$this->ProjectCode->CurrentValue = $this->ProjectCode->getSessionValue();
				$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
				$curVal = strval($this->ProjectCode->CurrentValue);
				if ($curVal != "") {
					$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
					if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
						}
					}
				} else {
					$this->ProjectCode->ViewValue = NULL;
				}
				$this->ProjectCode->ViewCustomAttributes = "";
			} else {
				if (!$this->ProjectCode->Raw)
					$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
				$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
				$curVal = strval($this->ProjectCode->CurrentValue);
				if ($curVal != "") {
					$this->ProjectCode->EditValue = $this->ProjectCode->lookupCacheOption($curVal);
					if ($this->ProjectCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->ProjectCode->EditValue = $this->ProjectCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
						}
					}
				} else {
					$this->ProjectCode->EditValue = NULL;
				}
				$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$curVal = trim(strval($this->FinancialYear->CurrentValue));
			if ($curVal != "")
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
			else
				$this->FinancialYear->ViewValue = $this->FinancialYear->Lookup !== NULL && is_array($this->FinancialYear->Lookup->Options) ? $curVal : NULL;
			if ($this->FinancialYear->ViewValue !== NULL) { // Load from cache
				$this->FinancialYear->EditValue = array_values($this->FinancialYear->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Year`" . SearchString("=", $this->FinancialYear->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->FinancialYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FinancialYear->EditValue = $arwrk;
			}

			// ActivityName
			$this->ActivityName->EditAttrs["class"] = "form-control";
			$this->ActivityName->EditCustomAttributes = "";
			$this->ActivityName->EditValue = HtmlEncode($this->ActivityName->CurrentValue);
			$this->ActivityName->PlaceHolder = RemoveHtml($this->ActivityName->caption());

			// MTEFBudget
			$this->MTEFBudget->EditAttrs["class"] = "form-control";
			$this->MTEFBudget->EditCustomAttributes = "";
			$this->MTEFBudget->EditValue = HtmlEncode($this->MTEFBudget->CurrentValue);
			$this->MTEFBudget->PlaceHolder = RemoveHtml($this->MTEFBudget->caption());
			if (strval($this->MTEFBudget->EditValue) != "" && is_numeric($this->MTEFBudget->EditValue))
				$this->MTEFBudget->EditValue = FormatNumber($this->MTEFBudget->EditValue, -2, -2, -2, -2);
			

			// SupplementaryBudget
			$this->SupplementaryBudget->EditAttrs["class"] = "form-control";
			$this->SupplementaryBudget->EditCustomAttributes = "";
			$this->SupplementaryBudget->EditValue = HtmlEncode($this->SupplementaryBudget->CurrentValue);
			$this->SupplementaryBudget->PlaceHolder = RemoveHtml($this->SupplementaryBudget->caption());
			if (strval($this->SupplementaryBudget->EditValue) != "" && is_numeric($this->SupplementaryBudget->EditValue))
				$this->SupplementaryBudget->EditValue = FormatNumber($this->SupplementaryBudget->EditValue, -2, -2, -2, -2);
			

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->EditAttrs["class"] = "form-control";
			$this->ExpectedAnnualAchievement->EditCustomAttributes = "";
			if (!$this->ExpectedAnnualAchievement->Raw)
				$this->ExpectedAnnualAchievement->CurrentValue = HtmlDecode($this->ExpectedAnnualAchievement->CurrentValue);
			$this->ExpectedAnnualAchievement->EditValue = HtmlEncode($this->ExpectedAnnualAchievement->CurrentValue);
			$this->ExpectedAnnualAchievement->PlaceHolder = RemoveHtml($this->ExpectedAnnualAchievement->caption());

			// ActivityLocation
			$this->ActivityLocation->EditAttrs["class"] = "form-control";
			$this->ActivityLocation->EditCustomAttributes = "";
			if (!$this->ActivityLocation->Raw)
				$this->ActivityLocation->CurrentValue = HtmlDecode($this->ActivityLocation->CurrentValue);
			$this->ActivityLocation->EditValue = HtmlEncode($this->ActivityLocation->CurrentValue);
			$this->ActivityLocation->PlaceHolder = RemoveHtml($this->ActivityLocation->caption());

			// Add refer script
			// LACode

			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// ProgrammeCode
			$this->ProgrammeCode->LinkCustomAttributes = "";
			$this->ProgrammeCode->HrefValue = "";

			// OucomeCode
			$this->OucomeCode->LinkCustomAttributes = "";
			$this->OucomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// ActivityName
			$this->ActivityName->LinkCustomAttributes = "";
			$this->ActivityName->HrefValue = "";

			// MTEFBudget
			$this->MTEFBudget->LinkCustomAttributes = "";
			$this->MTEFBudget->HrefValue = "";

			// SupplementaryBudget
			$this->SupplementaryBudget->LinkCustomAttributes = "";
			$this->SupplementaryBudget->HrefValue = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->LinkCustomAttributes = "";
			$this->ExpectedAnnualAchievement->HrefValue = "";

			// ActivityLocation
			$this->ActivityLocation->LinkCustomAttributes = "";
			$this->ActivityLocation->HrefValue = "";
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
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if ($this->ProgrammeCode->Required) {
			if (!$this->ProgrammeCode->IsDetailKey && $this->ProgrammeCode->FormValue != NULL && $this->ProgrammeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgrammeCode->caption(), $this->ProgrammeCode->RequiredErrorMessage));
			}
		}
		if ($this->OucomeCode->Required) {
			if (!$this->OucomeCode->IsDetailKey && $this->OucomeCode->FormValue != NULL && $this->OucomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OucomeCode->caption(), $this->OucomeCode->RequiredErrorMessage));
			}
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if ($this->ProjectCode->Required) {
			if (!$this->ProjectCode->IsDetailKey && $this->ProjectCode->FormValue != NULL && $this->ProjectCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectCode->caption(), $this->ProjectCode->RequiredErrorMessage));
			}
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if ($this->ActivityName->Required) {
			if (!$this->ActivityName->IsDetailKey && $this->ActivityName->FormValue != NULL && $this->ActivityName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActivityName->caption(), $this->ActivityName->RequiredErrorMessage));
			}
		}
		if ($this->MTEFBudget->Required) {
			if (!$this->MTEFBudget->IsDetailKey && $this->MTEFBudget->FormValue != NULL && $this->MTEFBudget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MTEFBudget->caption(), $this->MTEFBudget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MTEFBudget->FormValue)) {
			AddMessage($FormError, $this->MTEFBudget->errorMessage());
		}
		if ($this->SupplementaryBudget->Required) {
			if (!$this->SupplementaryBudget->IsDetailKey && $this->SupplementaryBudget->FormValue != NULL && $this->SupplementaryBudget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SupplementaryBudget->caption(), $this->SupplementaryBudget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->SupplementaryBudget->FormValue)) {
			AddMessage($FormError, $this->SupplementaryBudget->errorMessage());
		}
		if ($this->ExpectedAnnualAchievement->Required) {
			if (!$this->ExpectedAnnualAchievement->IsDetailKey && $this->ExpectedAnnualAchievement->FormValue != NULL && $this->ExpectedAnnualAchievement->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExpectedAnnualAchievement->caption(), $this->ExpectedAnnualAchievement->RequiredErrorMessage));
			}
		}
		if ($this->ActivityLocation->Required) {
			if (!$this->ActivityLocation->IsDetailKey && $this->ActivityLocation->FormValue != NULL && $this->ActivityLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActivityLocation->caption(), $this->ActivityLocation->RequiredErrorMessage));
			}
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, 0, FALSE);

		// ProgrammeCode
		$this->ProgrammeCode->setDbValueDef($rsnew, $this->ProgrammeCode->CurrentValue, "", FALSE);

		// OucomeCode
		$this->OucomeCode->setDbValueDef($rsnew, $this->OucomeCode->CurrentValue, 0, FALSE);

		// OutputCode
		$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, FALSE);

		// ProjectCode
		$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, NULL, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, FALSE);

		// ActivityName
		$this->ActivityName->setDbValueDef($rsnew, $this->ActivityName->CurrentValue, "", FALSE);

		// MTEFBudget
		$this->MTEFBudget->setDbValueDef($rsnew, $this->MTEFBudget->CurrentValue, NULL, strval($this->MTEFBudget->CurrentValue) == "");

		// SupplementaryBudget
		$this->SupplementaryBudget->setDbValueDef($rsnew, $this->SupplementaryBudget->CurrentValue, NULL, strval($this->SupplementaryBudget->CurrentValue) == "");

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->setDbValueDef($rsnew, $this->ExpectedAnnualAchievement->CurrentValue, NULL, FALSE);

		// ActivityLocation
		$this->ActivityLocation->setDbValueDef($rsnew, $this->ActivityLocation->CurrentValue, NULL, FALSE);

		// ProvinceCode
		if ($this->ProvinceCode->getSessionValue() != "") {
			$rsnew['ProvinceCode'] = $this->ProvinceCode->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['FinancialYear']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "project") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["project"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["project"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["project"]->ProvinceCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["project"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["project"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["project"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["project"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["project"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SectionCode", Get("SectionCode"))) !== NULL) {
					$GLOBALS["project"]->SectionCode->setQueryStringValue($parm);
					$this->SectionCode->setQueryStringValue($GLOBALS["project"]->SectionCode->QueryStringValue);
					$this->SectionCode->setSessionValue($this->SectionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["project"]->SectionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProjectCode", Get("ProjectCode"))) !== NULL) {
					$GLOBALS["project"]->ProjectCode->setQueryStringValue($parm);
					$this->ProjectCode->setQueryStringValue($GLOBALS["project"]->ProjectCode->QueryStringValue);
					$this->ProjectCode->setSessionValue($this->ProjectCode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "project") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["project"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["project"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["project"]->ProvinceCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["project"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["project"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["project"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["project"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["project"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SectionCode", Post("SectionCode"))) !== NULL) {
					$GLOBALS["project"]->SectionCode->setFormValue($parm);
					$this->SectionCode->setFormValue($GLOBALS["project"]->SectionCode->FormValue);
					$this->SectionCode->setSessionValue($this->SectionCode->FormValue);
					if (!is_numeric($GLOBALS["project"]->SectionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProjectCode", Post("ProjectCode"))) !== NULL) {
					$GLOBALS["project"]->ProjectCode->setFormValue($parm);
					$this->ProjectCode->setFormValue($GLOBALS["project"]->ProjectCode->FormValue);
					$this->ProjectCode->setSessionValue($this->ProjectCode->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "project") {
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->SectionCode->CurrentValue == "")
					$this->SectionCode->setSessionValue("");
				if ($this->ProjectCode->CurrentValue == "")
					$this->ProjectCode->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("activitylist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProgrammeCode":
					break;
				case "x_OucomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ProjectCode":
					break;
				case "x_FinancialYear":
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
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProgrammeCode":
							break;
						case "x_OucomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ProjectCode":
							break;
						case "x_FinancialYear":
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