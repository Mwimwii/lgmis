<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class standard_rate_add extends standard_rate
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'standard_rate';

	// Page object name
	public $PageObjName = "standard_rate_add";

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

		// Table object (standard_rate)
		if (!isset($GLOBALS["standard_rate"]) || get_class($GLOBALS["standard_rate"]) == PROJECT_NAMESPACE . "standard_rate") {
			$GLOBALS["standard_rate"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["standard_rate"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'standard_rate');

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
		global $standard_rate;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($standard_rate);
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
					if ($pageName == "standard_rateview.php")
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
					$this->terminate(GetUrl("standard_ratelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->account_id->setVisibility();
		$this->moimp_code->setVisibility();
		$this->account_code->setVisibility();
		$this->period_code->setVisibility();
		$this->level_code->setVisibility();
		$this->destination_code->setVisibility();
		$this->amount->setVisibility();
		$this->currency_Code->setVisibility();
		$this->last_user->setVisibility();
		$this->last_update->setVisibility();
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
		// Check permission

		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("standard_ratelist.php");
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
			$this->CopyRecord = FALSE;
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

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
					$this->terminate("standard_ratelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "standard_ratelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "standard_rateview.php")
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
		$this->account_id->CurrentValue = NULL;
		$this->account_id->OldValue = $this->account_id->CurrentValue;
		$this->moimp_code->CurrentValue = 0;
		$this->account_code->CurrentValue = NULL;
		$this->account_code->OldValue = $this->account_code->CurrentValue;
		$this->period_code->CurrentValue = 0;
		$this->level_code->CurrentValue = 1;
		$this->destination_code->CurrentValue = 1;
		$this->amount->CurrentValue = 0;
		$this->currency_Code->CurrentValue = "USD";
		$this->last_user->CurrentValue = NULL;
		$this->last_user->OldValue = $this->last_user->CurrentValue;
		$this->last_update->CurrentValue = NULL;
		$this->last_update->OldValue = $this->last_update->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'account_id' first before field var 'x_account_id'
		$val = $CurrentForm->hasValue("account_id") ? $CurrentForm->getValue("account_id") : $CurrentForm->getValue("x_account_id");
		if (!$this->account_id->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->account_id->Visible = FALSE; // Disable update for API request
			else
				$this->account_id->setFormValue($val);
		}

		// Check field name 'moimp_code' first before field var 'x_moimp_code'
		$val = $CurrentForm->hasValue("moimp_code") ? $CurrentForm->getValue("moimp_code") : $CurrentForm->getValue("x_moimp_code");
		if (!$this->moimp_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->moimp_code->Visible = FALSE; // Disable update for API request
			else
				$this->moimp_code->setFormValue($val);
		}

		// Check field name 'account_code' first before field var 'x_account_code'
		$val = $CurrentForm->hasValue("account_code") ? $CurrentForm->getValue("account_code") : $CurrentForm->getValue("x_account_code");
		if (!$this->account_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->account_code->Visible = FALSE; // Disable update for API request
			else
				$this->account_code->setFormValue($val);
		}

		// Check field name 'period_code' first before field var 'x_period_code'
		$val = $CurrentForm->hasValue("period_code") ? $CurrentForm->getValue("period_code") : $CurrentForm->getValue("x_period_code");
		if (!$this->period_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->period_code->Visible = FALSE; // Disable update for API request
			else
				$this->period_code->setFormValue($val);
		}

		// Check field name 'level_code' first before field var 'x_level_code'
		$val = $CurrentForm->hasValue("level_code") ? $CurrentForm->getValue("level_code") : $CurrentForm->getValue("x_level_code");
		if (!$this->level_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->level_code->Visible = FALSE; // Disable update for API request
			else
				$this->level_code->setFormValue($val);
		}

		// Check field name 'destination_code' first before field var 'x_destination_code'
		$val = $CurrentForm->hasValue("destination_code") ? $CurrentForm->getValue("destination_code") : $CurrentForm->getValue("x_destination_code");
		if (!$this->destination_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->destination_code->Visible = FALSE; // Disable update for API request
			else
				$this->destination_code->setFormValue($val);
		}

		// Check field name 'amount' first before field var 'x_amount'
		$val = $CurrentForm->hasValue("amount") ? $CurrentForm->getValue("amount") : $CurrentForm->getValue("x_amount");
		if (!$this->amount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->amount->Visible = FALSE; // Disable update for API request
			else
				$this->amount->setFormValue($val);
		}

		// Check field name 'currency_Code' first before field var 'x_currency_Code'
		$val = $CurrentForm->hasValue("currency_Code") ? $CurrentForm->getValue("currency_Code") : $CurrentForm->getValue("x_currency_Code");
		if (!$this->currency_Code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->currency_Code->Visible = FALSE; // Disable update for API request
			else
				$this->currency_Code->setFormValue($val);
		}

		// Check field name 'last_user' first before field var 'x_last_user'
		$val = $CurrentForm->hasValue("last_user") ? $CurrentForm->getValue("last_user") : $CurrentForm->getValue("x_last_user");
		if (!$this->last_user->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->last_user->Visible = FALSE; // Disable update for API request
			else
				$this->last_user->setFormValue($val);
		}

		// Check field name 'last_update' first before field var 'x_last_update'
		$val = $CurrentForm->hasValue("last_update") ? $CurrentForm->getValue("last_update") : $CurrentForm->getValue("x_last_update");
		if (!$this->last_update->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->last_update->Visible = FALSE; // Disable update for API request
			else
				$this->last_update->setFormValue($val);
			$this->last_update->CurrentValue = UnFormatDateTime($this->last_update->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->account_id->CurrentValue = $this->account_id->FormValue;
		$this->moimp_code->CurrentValue = $this->moimp_code->FormValue;
		$this->account_code->CurrentValue = $this->account_code->FormValue;
		$this->period_code->CurrentValue = $this->period_code->FormValue;
		$this->level_code->CurrentValue = $this->level_code->FormValue;
		$this->destination_code->CurrentValue = $this->destination_code->FormValue;
		$this->amount->CurrentValue = $this->amount->FormValue;
		$this->currency_Code->CurrentValue = $this->currency_Code->FormValue;
		$this->last_user->CurrentValue = $this->last_user->FormValue;
		$this->last_update->CurrentValue = $this->last_update->FormValue;
		$this->last_update->CurrentValue = UnFormatDateTime($this->last_update->CurrentValue, 0);
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
		$this->account_id->setDbValue($row['account_id']);
		$this->moimp_code->setDbValue($row['moimp_code']);
		$this->account_code->setDbValue($row['account_code']);
		$this->period_code->setDbValue($row['period_code']);
		$this->level_code->setDbValue($row['level_code']);
		$this->destination_code->setDbValue($row['destination_code']);
		$this->amount->setDbValue($row['amount']);
		$this->currency_Code->setDbValue($row['currency_Code']);
		$this->last_user->setDbValue($row['last_user']);
		$this->last_update->setDbValue($row['last_update']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['account_id'] = $this->account_id->CurrentValue;
		$row['moimp_code'] = $this->moimp_code->CurrentValue;
		$row['account_code'] = $this->account_code->CurrentValue;
		$row['period_code'] = $this->period_code->CurrentValue;
		$row['level_code'] = $this->level_code->CurrentValue;
		$row['destination_code'] = $this->destination_code->CurrentValue;
		$row['amount'] = $this->amount->CurrentValue;
		$row['currency_Code'] = $this->currency_Code->CurrentValue;
		$row['last_user'] = $this->last_user->CurrentValue;
		$row['last_update'] = $this->last_update->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{
		return FALSE;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->amount->FormValue == $this->amount->CurrentValue && is_numeric(ConvertToFloatString($this->amount->CurrentValue)))
			$this->amount->CurrentValue = ConvertToFloatString($this->amount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// account_id
		// moimp_code
		// account_code
		// period_code
		// level_code
		// destination_code
		// amount
		// currency_Code
		// last_user
		// last_update

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// account_id
			$this->account_id->ViewValue = $this->account_id->CurrentValue;
			$this->account_id->ViewCustomAttributes = "";

			// moimp_code
			$this->moimp_code->ViewValue = $this->moimp_code->CurrentValue;
			$this->moimp_code->ViewCustomAttributes = "";

			// account_code
			$this->account_code->ViewValue = $this->account_code->CurrentValue;
			$this->account_code->ViewCustomAttributes = "";

			// period_code
			$this->period_code->ViewValue = $this->period_code->CurrentValue;
			$this->period_code->ViewCustomAttributes = "";

			// level_code
			$this->level_code->ViewValue = $this->level_code->CurrentValue;
			$this->level_code->ViewCustomAttributes = "";

			// destination_code
			$this->destination_code->ViewValue = $this->destination_code->CurrentValue;
			$this->destination_code->ViewCustomAttributes = "";

			// amount
			$this->amount->ViewValue = $this->amount->CurrentValue;
			$this->amount->ViewValue = FormatNumber($this->amount->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->amount->ViewCustomAttributes = "";

			// currency_Code
			$this->currency_Code->ViewValue = $this->currency_Code->CurrentValue;
			$this->currency_Code->ViewCustomAttributes = "";

			// last_user
			$this->last_user->ViewValue = $this->last_user->CurrentValue;
			$this->last_user->ViewCustomAttributes = "";

			// last_update
			$this->last_update->ViewValue = $this->last_update->CurrentValue;
			$this->last_update->ViewValue = FormatDateTime($this->last_update->ViewValue, 0);
			$this->last_update->ViewCustomAttributes = "";

			// account_id
			$this->account_id->LinkCustomAttributes = "";
			$this->account_id->HrefValue = "";
			$this->account_id->TooltipValue = "";

			// moimp_code
			$this->moimp_code->LinkCustomAttributes = "";
			$this->moimp_code->HrefValue = "";
			$this->moimp_code->TooltipValue = "";

			// account_code
			$this->account_code->LinkCustomAttributes = "";
			$this->account_code->HrefValue = "";
			$this->account_code->TooltipValue = "";

			// period_code
			$this->period_code->LinkCustomAttributes = "";
			$this->period_code->HrefValue = "";
			$this->period_code->TooltipValue = "";

			// level_code
			$this->level_code->LinkCustomAttributes = "";
			$this->level_code->HrefValue = "";
			$this->level_code->TooltipValue = "";

			// destination_code
			$this->destination_code->LinkCustomAttributes = "";
			$this->destination_code->HrefValue = "";
			$this->destination_code->TooltipValue = "";

			// amount
			$this->amount->LinkCustomAttributes = "";
			$this->amount->HrefValue = "";
			$this->amount->TooltipValue = "";

			// currency_Code
			$this->currency_Code->LinkCustomAttributes = "";
			$this->currency_Code->HrefValue = "";
			$this->currency_Code->TooltipValue = "";

			// last_user
			$this->last_user->LinkCustomAttributes = "";
			$this->last_user->HrefValue = "";
			$this->last_user->TooltipValue = "";

			// last_update
			$this->last_update->LinkCustomAttributes = "";
			$this->last_update->HrefValue = "";
			$this->last_update->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// account_id
			$this->account_id->EditAttrs["class"] = "form-control";
			$this->account_id->EditCustomAttributes = "";
			$this->account_id->EditValue = HtmlEncode($this->account_id->CurrentValue);
			$this->account_id->PlaceHolder = RemoveHtml($this->account_id->caption());

			// moimp_code
			$this->moimp_code->EditAttrs["class"] = "form-control";
			$this->moimp_code->EditCustomAttributes = "";
			$this->moimp_code->EditValue = HtmlEncode($this->moimp_code->CurrentValue);
			$this->moimp_code->PlaceHolder = RemoveHtml($this->moimp_code->caption());

			// account_code
			$this->account_code->EditAttrs["class"] = "form-control";
			$this->account_code->EditCustomAttributes = "";
			if (!$this->account_code->Raw)
				$this->account_code->CurrentValue = HtmlDecode($this->account_code->CurrentValue);
			$this->account_code->EditValue = HtmlEncode($this->account_code->CurrentValue);
			$this->account_code->PlaceHolder = RemoveHtml($this->account_code->caption());

			// period_code
			$this->period_code->EditAttrs["class"] = "form-control";
			$this->period_code->EditCustomAttributes = "";
			$this->period_code->EditValue = HtmlEncode($this->period_code->CurrentValue);
			$this->period_code->PlaceHolder = RemoveHtml($this->period_code->caption());

			// level_code
			$this->level_code->EditAttrs["class"] = "form-control";
			$this->level_code->EditCustomAttributes = "";
			$this->level_code->EditValue = HtmlEncode($this->level_code->CurrentValue);
			$this->level_code->PlaceHolder = RemoveHtml($this->level_code->caption());

			// destination_code
			$this->destination_code->EditAttrs["class"] = "form-control";
			$this->destination_code->EditCustomAttributes = "";
			$this->destination_code->EditValue = HtmlEncode($this->destination_code->CurrentValue);
			$this->destination_code->PlaceHolder = RemoveHtml($this->destination_code->caption());

			// amount
			$this->amount->EditAttrs["class"] = "form-control";
			$this->amount->EditCustomAttributes = "";
			$this->amount->EditValue = HtmlEncode($this->amount->CurrentValue);
			$this->amount->PlaceHolder = RemoveHtml($this->amount->caption());
			if (strval($this->amount->EditValue) != "" && is_numeric($this->amount->EditValue))
				$this->amount->EditValue = FormatNumber($this->amount->EditValue, -2, -1, -2, 0);
			

			// currency_Code
			$this->currency_Code->EditAttrs["class"] = "form-control";
			$this->currency_Code->EditCustomAttributes = "";
			if (!$this->currency_Code->Raw)
				$this->currency_Code->CurrentValue = HtmlDecode($this->currency_Code->CurrentValue);
			$this->currency_Code->EditValue = HtmlEncode($this->currency_Code->CurrentValue);
			$this->currency_Code->PlaceHolder = RemoveHtml($this->currency_Code->caption());

			// last_user
			$this->last_user->EditAttrs["class"] = "form-control";
			$this->last_user->EditCustomAttributes = "";
			if (!$this->last_user->Raw)
				$this->last_user->CurrentValue = HtmlDecode($this->last_user->CurrentValue);
			$this->last_user->EditValue = HtmlEncode($this->last_user->CurrentValue);
			$this->last_user->PlaceHolder = RemoveHtml($this->last_user->caption());

			// last_update
			$this->last_update->EditAttrs["class"] = "form-control";
			$this->last_update->EditCustomAttributes = "";
			$this->last_update->EditValue = HtmlEncode(FormatDateTime($this->last_update->CurrentValue, 8));
			$this->last_update->PlaceHolder = RemoveHtml($this->last_update->caption());

			// Add refer script
			// account_id

			$this->account_id->LinkCustomAttributes = "";
			$this->account_id->HrefValue = "";

			// moimp_code
			$this->moimp_code->LinkCustomAttributes = "";
			$this->moimp_code->HrefValue = "";

			// account_code
			$this->account_code->LinkCustomAttributes = "";
			$this->account_code->HrefValue = "";

			// period_code
			$this->period_code->LinkCustomAttributes = "";
			$this->period_code->HrefValue = "";

			// level_code
			$this->level_code->LinkCustomAttributes = "";
			$this->level_code->HrefValue = "";

			// destination_code
			$this->destination_code->LinkCustomAttributes = "";
			$this->destination_code->HrefValue = "";

			// amount
			$this->amount->LinkCustomAttributes = "";
			$this->amount->HrefValue = "";

			// currency_Code
			$this->currency_Code->LinkCustomAttributes = "";
			$this->currency_Code->HrefValue = "";

			// last_user
			$this->last_user->LinkCustomAttributes = "";
			$this->last_user->HrefValue = "";

			// last_update
			$this->last_update->LinkCustomAttributes = "";
			$this->last_update->HrefValue = "";
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
		if ($this->account_id->Required) {
			if (!$this->account_id->IsDetailKey && $this->account_id->FormValue != NULL && $this->account_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->account_id->caption(), $this->account_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->account_id->FormValue)) {
			AddMessage($FormError, $this->account_id->errorMessage());
		}
		if ($this->moimp_code->Required) {
			if (!$this->moimp_code->IsDetailKey && $this->moimp_code->FormValue != NULL && $this->moimp_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->moimp_code->caption(), $this->moimp_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->moimp_code->FormValue)) {
			AddMessage($FormError, $this->moimp_code->errorMessage());
		}
		if ($this->account_code->Required) {
			if (!$this->account_code->IsDetailKey && $this->account_code->FormValue != NULL && $this->account_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->account_code->caption(), $this->account_code->RequiredErrorMessage));
			}
		}
		if ($this->period_code->Required) {
			if (!$this->period_code->IsDetailKey && $this->period_code->FormValue != NULL && $this->period_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->period_code->caption(), $this->period_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->period_code->FormValue)) {
			AddMessage($FormError, $this->period_code->errorMessage());
		}
		if ($this->level_code->Required) {
			if (!$this->level_code->IsDetailKey && $this->level_code->FormValue != NULL && $this->level_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->level_code->caption(), $this->level_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->level_code->FormValue)) {
			AddMessage($FormError, $this->level_code->errorMessage());
		}
		if ($this->destination_code->Required) {
			if (!$this->destination_code->IsDetailKey && $this->destination_code->FormValue != NULL && $this->destination_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->destination_code->caption(), $this->destination_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->destination_code->FormValue)) {
			AddMessage($FormError, $this->destination_code->errorMessage());
		}
		if ($this->amount->Required) {
			if (!$this->amount->IsDetailKey && $this->amount->FormValue != NULL && $this->amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->amount->caption(), $this->amount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->amount->FormValue)) {
			AddMessage($FormError, $this->amount->errorMessage());
		}
		if ($this->currency_Code->Required) {
			if (!$this->currency_Code->IsDetailKey && $this->currency_Code->FormValue != NULL && $this->currency_Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->currency_Code->caption(), $this->currency_Code->RequiredErrorMessage));
			}
		}
		if ($this->last_user->Required) {
			if (!$this->last_user->IsDetailKey && $this->last_user->FormValue != NULL && $this->last_user->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->last_user->caption(), $this->last_user->RequiredErrorMessage));
			}
		}
		if ($this->last_update->Required) {
			if (!$this->last_update->IsDetailKey && $this->last_update->FormValue != NULL && $this->last_update->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->last_update->caption(), $this->last_update->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->last_update->FormValue)) {
			AddMessage($FormError, $this->last_update->errorMessage());
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

		// account_id
		$this->account_id->setDbValueDef($rsnew, $this->account_id->CurrentValue, 0, FALSE);

		// moimp_code
		$this->moimp_code->setDbValueDef($rsnew, $this->moimp_code->CurrentValue, 0, strval($this->moimp_code->CurrentValue) == "");

		// account_code
		$this->account_code->setDbValueDef($rsnew, $this->account_code->CurrentValue, "", FALSE);

		// period_code
		$this->period_code->setDbValueDef($rsnew, $this->period_code->CurrentValue, 0, strval($this->period_code->CurrentValue) == "");

		// level_code
		$this->level_code->setDbValueDef($rsnew, $this->level_code->CurrentValue, 0, strval($this->level_code->CurrentValue) == "");

		// destination_code
		$this->destination_code->setDbValueDef($rsnew, $this->destination_code->CurrentValue, 0, strval($this->destination_code->CurrentValue) == "");

		// amount
		$this->amount->setDbValueDef($rsnew, $this->amount->CurrentValue, NULL, strval($this->amount->CurrentValue) == "");

		// currency_Code
		$this->currency_Code->setDbValueDef($rsnew, $this->currency_Code->CurrentValue, NULL, strval($this->currency_Code->CurrentValue) == "");

		// last_user
		$this->last_user->setDbValueDef($rsnew, $this->last_user->CurrentValue, NULL, FALSE);

		// last_update
		$this->last_update->setDbValueDef($rsnew, UnFormatDateTime($this->last_update->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("standard_ratelist.php"), "", $this->TableVar, TRUE);
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