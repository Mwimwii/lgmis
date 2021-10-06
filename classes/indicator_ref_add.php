<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class indicator_ref_add extends indicator_ref
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'indicator_ref';

	// Page object name
	public $PageObjName = "indicator_ref_add";

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

		// Table object (indicator_ref)
		if (!isset($GLOBALS["indicator_ref"]) || get_class($GLOBALS["indicator_ref"]) == PROJECT_NAMESPACE . "indicator_ref") {
			$GLOBALS["indicator_ref"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["indicator_ref"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'indicator_ref');

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
		global $indicator_ref;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($indicator_ref);
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
					if ($pageName == "indicator_refview.php")
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
					$this->terminate(GetUrl("indicator_reflist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->indicator_code->setVisibility();
		$this->indicator_name->setVisibility();
		$this->indicator_desc->setVisibility();
		$this->is_key->Visible = FALSE;
		$this->formula_ref->setVisibility();
		$this->direction->setVisibility();
		$this->target->setVisibility();
		$this->indicator_measure->setVisibility();
		$this->indicator_frequency->setVisibility();
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
		$this->setupLookupOptions($this->direction);
		$this->setupLookupOptions($this->indicator_measure);
		$this->setupLookupOptions($this->indicator_frequency);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("indicator_reflist.php");
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
					$this->terminate("indicator_reflist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "indicator_reflist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "indicator_refview.php")
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
		$this->indicator_code->CurrentValue = NULL;
		$this->indicator_code->OldValue = $this->indicator_code->CurrentValue;
		$this->indicator_name->CurrentValue = NULL;
		$this->indicator_name->OldValue = $this->indicator_name->CurrentValue;
		$this->indicator_desc->CurrentValue = NULL;
		$this->indicator_desc->OldValue = $this->indicator_desc->CurrentValue;
		$this->is_key->CurrentValue = NULL;
		$this->is_key->OldValue = $this->is_key->CurrentValue;
		$this->formula_ref->CurrentValue = NULL;
		$this->formula_ref->OldValue = $this->formula_ref->CurrentValue;
		$this->direction->CurrentValue = NULL;
		$this->direction->OldValue = $this->direction->CurrentValue;
		$this->target->CurrentValue = 0;
		$this->indicator_measure->CurrentValue = "percent";
		$this->indicator_frequency->CurrentValue = "month";
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'indicator_code' first before field var 'x_indicator_code'
		$val = $CurrentForm->hasValue("indicator_code") ? $CurrentForm->getValue("indicator_code") : $CurrentForm->getValue("x_indicator_code");
		if (!$this->indicator_code->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->indicator_code->Visible = FALSE; // Disable update for API request
			else
				$this->indicator_code->setFormValue($val);
		}

		// Check field name 'indicator_name' first before field var 'x_indicator_name'
		$val = $CurrentForm->hasValue("indicator_name") ? $CurrentForm->getValue("indicator_name") : $CurrentForm->getValue("x_indicator_name");
		if (!$this->indicator_name->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->indicator_name->Visible = FALSE; // Disable update for API request
			else
				$this->indicator_name->setFormValue($val);
		}

		// Check field name 'indicator_desc' first before field var 'x_indicator_desc'
		$val = $CurrentForm->hasValue("indicator_desc") ? $CurrentForm->getValue("indicator_desc") : $CurrentForm->getValue("x_indicator_desc");
		if (!$this->indicator_desc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->indicator_desc->Visible = FALSE; // Disable update for API request
			else
				$this->indicator_desc->setFormValue($val);
		}

		// Check field name 'formula_ref' first before field var 'x_formula_ref'
		$val = $CurrentForm->hasValue("formula_ref") ? $CurrentForm->getValue("formula_ref") : $CurrentForm->getValue("x_formula_ref");
		if (!$this->formula_ref->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->formula_ref->Visible = FALSE; // Disable update for API request
			else
				$this->formula_ref->setFormValue($val);
		}

		// Check field name 'direction' first before field var 'x_direction'
		$val = $CurrentForm->hasValue("direction") ? $CurrentForm->getValue("direction") : $CurrentForm->getValue("x_direction");
		if (!$this->direction->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->direction->Visible = FALSE; // Disable update for API request
			else
				$this->direction->setFormValue($val);
		}

		// Check field name 'target' first before field var 'x_target'
		$val = $CurrentForm->hasValue("target") ? $CurrentForm->getValue("target") : $CurrentForm->getValue("x_target");
		if (!$this->target->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->target->Visible = FALSE; // Disable update for API request
			else
				$this->target->setFormValue($val);
		}

		// Check field name 'indicator_measure' first before field var 'x_indicator_measure'
		$val = $CurrentForm->hasValue("indicator_measure") ? $CurrentForm->getValue("indicator_measure") : $CurrentForm->getValue("x_indicator_measure");
		if (!$this->indicator_measure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->indicator_measure->Visible = FALSE; // Disable update for API request
			else
				$this->indicator_measure->setFormValue($val);
		}

		// Check field name 'indicator_frequency' first before field var 'x_indicator_frequency'
		$val = $CurrentForm->hasValue("indicator_frequency") ? $CurrentForm->getValue("indicator_frequency") : $CurrentForm->getValue("x_indicator_frequency");
		if (!$this->indicator_frequency->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->indicator_frequency->Visible = FALSE; // Disable update for API request
			else
				$this->indicator_frequency->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->indicator_code->CurrentValue = $this->indicator_code->FormValue;
		$this->indicator_name->CurrentValue = $this->indicator_name->FormValue;
		$this->indicator_desc->CurrentValue = $this->indicator_desc->FormValue;
		$this->formula_ref->CurrentValue = $this->formula_ref->FormValue;
		$this->direction->CurrentValue = $this->direction->FormValue;
		$this->target->CurrentValue = $this->target->FormValue;
		$this->indicator_measure->CurrentValue = $this->indicator_measure->FormValue;
		$this->indicator_frequency->CurrentValue = $this->indicator_frequency->FormValue;
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
		$this->indicator_code->setDbValue($row['indicator_code']);
		$this->indicator_name->setDbValue($row['indicator_name']);
		$this->indicator_desc->setDbValue($row['indicator_desc']);
		$this->is_key->setDbValue($row['is_key']);
		$this->formula_ref->setDbValue($row['formula_ref']);
		$this->direction->setDbValue($row['direction']);
		$this->target->setDbValue($row['target']);
		$this->indicator_measure->setDbValue($row['indicator_measure']);
		$this->indicator_frequency->setDbValue($row['indicator_frequency']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['indicator_code'] = $this->indicator_code->CurrentValue;
		$row['indicator_name'] = $this->indicator_name->CurrentValue;
		$row['indicator_desc'] = $this->indicator_desc->CurrentValue;
		$row['is_key'] = $this->is_key->CurrentValue;
		$row['formula_ref'] = $this->formula_ref->CurrentValue;
		$row['direction'] = $this->direction->CurrentValue;
		$row['target'] = $this->target->CurrentValue;
		$row['indicator_measure'] = $this->indicator_measure->CurrentValue;
		$row['indicator_frequency'] = $this->indicator_frequency->CurrentValue;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// indicator_code
		// indicator_name
		// indicator_desc
		// is_key
		// formula_ref
		// direction
		// target
		// indicator_measure
		// indicator_frequency

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// indicator_code
			$this->indicator_code->ViewValue = $this->indicator_code->CurrentValue;
			$this->indicator_code->ViewCustomAttributes = "";

			// indicator_name
			$this->indicator_name->ViewValue = $this->indicator_name->CurrentValue;
			$this->indicator_name->ViewCustomAttributes = "";

			// indicator_desc
			$this->indicator_desc->ViewValue = $this->indicator_desc->CurrentValue;
			$this->indicator_desc->ViewCustomAttributes = "";

			// formula_ref
			$this->formula_ref->ViewValue = $this->formula_ref->CurrentValue;
			$this->formula_ref->ViewCustomAttributes = "";

			// direction
			$curVal = strval($this->direction->CurrentValue);
			if ($curVal != "") {
				$this->direction->ViewValue = $this->direction->lookupCacheOption($curVal);
				if ($this->direction->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`indicator_direction`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->direction->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->direction->ViewValue = $this->direction->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->direction->ViewValue = $this->direction->CurrentValue;
					}
				}
			} else {
				$this->direction->ViewValue = NULL;
			}
			$this->direction->ViewCustomAttributes = "";

			// target
			$this->target->ViewValue = $this->target->CurrentValue;
			$this->target->ViewCustomAttributes = "";

			// indicator_measure
			$curVal = strval($this->indicator_measure->CurrentValue);
			if ($curVal != "") {
				$this->indicator_measure->ViewValue = $this->indicator_measure->lookupCacheOption($curVal);
				if ($this->indicator_measure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Indicator_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->indicator_measure->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->indicator_measure->ViewValue = $this->indicator_measure->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->indicator_measure->ViewValue = $this->indicator_measure->CurrentValue;
					}
				}
			} else {
				$this->indicator_measure->ViewValue = NULL;
			}
			$this->indicator_measure->ViewCustomAttributes = "";

			// indicator_frequency
			$curVal = strval($this->indicator_frequency->CurrentValue);
			if ($curVal != "") {
				$this->indicator_frequency->ViewValue = $this->indicator_frequency->lookupCacheOption($curVal);
				if ($this->indicator_frequency->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`indicator_frequency`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->indicator_frequency->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->indicator_frequency->ViewValue = $this->indicator_frequency->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->indicator_frequency->ViewValue = $this->indicator_frequency->CurrentValue;
					}
				}
			} else {
				$this->indicator_frequency->ViewValue = NULL;
			}
			$this->indicator_frequency->ViewCustomAttributes = "";

			// indicator_code
			$this->indicator_code->LinkCustomAttributes = "";
			$this->indicator_code->HrefValue = "";
			$this->indicator_code->TooltipValue = "";

			// indicator_name
			$this->indicator_name->LinkCustomAttributes = "";
			$this->indicator_name->HrefValue = "";
			$this->indicator_name->TooltipValue = "";

			// indicator_desc
			$this->indicator_desc->LinkCustomAttributes = "";
			$this->indicator_desc->HrefValue = "";
			$this->indicator_desc->TooltipValue = "";

			// formula_ref
			$this->formula_ref->LinkCustomAttributes = "";
			$this->formula_ref->HrefValue = "";
			$this->formula_ref->TooltipValue = "";

			// direction
			$this->direction->LinkCustomAttributes = "";
			$this->direction->HrefValue = "";
			$this->direction->TooltipValue = "";

			// target
			$this->target->LinkCustomAttributes = "";
			$this->target->HrefValue = "";
			$this->target->TooltipValue = "";

			// indicator_measure
			$this->indicator_measure->LinkCustomAttributes = "";
			$this->indicator_measure->HrefValue = "";
			$this->indicator_measure->TooltipValue = "";

			// indicator_frequency
			$this->indicator_frequency->LinkCustomAttributes = "";
			$this->indicator_frequency->HrefValue = "";
			$this->indicator_frequency->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// indicator_code
			$this->indicator_code->EditAttrs["class"] = "form-control";
			$this->indicator_code->EditCustomAttributes = "";
			$this->indicator_code->EditValue = HtmlEncode($this->indicator_code->CurrentValue);
			$this->indicator_code->PlaceHolder = RemoveHtml($this->indicator_code->caption());

			// indicator_name
			$this->indicator_name->EditAttrs["class"] = "form-control";
			$this->indicator_name->EditCustomAttributes = "";
			if (!$this->indicator_name->Raw)
				$this->indicator_name->CurrentValue = HtmlDecode($this->indicator_name->CurrentValue);
			$this->indicator_name->EditValue = HtmlEncode($this->indicator_name->CurrentValue);
			$this->indicator_name->PlaceHolder = RemoveHtml($this->indicator_name->caption());

			// indicator_desc
			$this->indicator_desc->EditAttrs["class"] = "form-control";
			$this->indicator_desc->EditCustomAttributes = "";
			if (!$this->indicator_desc->Raw)
				$this->indicator_desc->CurrentValue = HtmlDecode($this->indicator_desc->CurrentValue);
			$this->indicator_desc->EditValue = HtmlEncode($this->indicator_desc->CurrentValue);
			$this->indicator_desc->PlaceHolder = RemoveHtml($this->indicator_desc->caption());

			// formula_ref
			$this->formula_ref->EditAttrs["class"] = "form-control";
			$this->formula_ref->EditCustomAttributes = "";
			if (!$this->formula_ref->Raw)
				$this->formula_ref->CurrentValue = HtmlDecode($this->formula_ref->CurrentValue);
			$this->formula_ref->EditValue = HtmlEncode($this->formula_ref->CurrentValue);
			$this->formula_ref->PlaceHolder = RemoveHtml($this->formula_ref->caption());

			// direction
			$this->direction->EditAttrs["class"] = "form-control";
			$this->direction->EditCustomAttributes = "";
			$curVal = trim(strval($this->direction->CurrentValue));
			if ($curVal != "")
				$this->direction->ViewValue = $this->direction->lookupCacheOption($curVal);
			else
				$this->direction->ViewValue = $this->direction->Lookup !== NULL && is_array($this->direction->Lookup->Options) ? $curVal : NULL;
			if ($this->direction->ViewValue !== NULL) { // Load from cache
				$this->direction->EditValue = array_values($this->direction->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`indicator_direction`" . SearchString("=", $this->direction->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->direction->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->direction->EditValue = $arwrk;
			}

			// target
			$this->target->EditAttrs["class"] = "form-control";
			$this->target->EditCustomAttributes = "";
			$this->target->EditValue = HtmlEncode($this->target->CurrentValue);
			$this->target->PlaceHolder = RemoveHtml($this->target->caption());

			// indicator_measure
			$this->indicator_measure->EditAttrs["class"] = "form-control";
			$this->indicator_measure->EditCustomAttributes = "";
			$curVal = trim(strval($this->indicator_measure->CurrentValue));
			if ($curVal != "")
				$this->indicator_measure->ViewValue = $this->indicator_measure->lookupCacheOption($curVal);
			else
				$this->indicator_measure->ViewValue = $this->indicator_measure->Lookup !== NULL && is_array($this->indicator_measure->Lookup->Options) ? $curVal : NULL;
			if ($this->indicator_measure->ViewValue !== NULL) { // Load from cache
				$this->indicator_measure->EditValue = array_values($this->indicator_measure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Indicator_measure`" . SearchString("=", $this->indicator_measure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->indicator_measure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->indicator_measure->EditValue = $arwrk;
			}

			// indicator_frequency
			$this->indicator_frequency->EditAttrs["class"] = "form-control";
			$this->indicator_frequency->EditCustomAttributes = "";
			$curVal = trim(strval($this->indicator_frequency->CurrentValue));
			if ($curVal != "")
				$this->indicator_frequency->ViewValue = $this->indicator_frequency->lookupCacheOption($curVal);
			else
				$this->indicator_frequency->ViewValue = $this->indicator_frequency->Lookup !== NULL && is_array($this->indicator_frequency->Lookup->Options) ? $curVal : NULL;
			if ($this->indicator_frequency->ViewValue !== NULL) { // Load from cache
				$this->indicator_frequency->EditValue = array_values($this->indicator_frequency->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`indicator_frequency`" . SearchString("=", $this->indicator_frequency->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->indicator_frequency->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->indicator_frequency->EditValue = $arwrk;
			}

			// Add refer script
			// indicator_code

			$this->indicator_code->LinkCustomAttributes = "";
			$this->indicator_code->HrefValue = "";

			// indicator_name
			$this->indicator_name->LinkCustomAttributes = "";
			$this->indicator_name->HrefValue = "";

			// indicator_desc
			$this->indicator_desc->LinkCustomAttributes = "";
			$this->indicator_desc->HrefValue = "";

			// formula_ref
			$this->formula_ref->LinkCustomAttributes = "";
			$this->formula_ref->HrefValue = "";

			// direction
			$this->direction->LinkCustomAttributes = "";
			$this->direction->HrefValue = "";

			// target
			$this->target->LinkCustomAttributes = "";
			$this->target->HrefValue = "";

			// indicator_measure
			$this->indicator_measure->LinkCustomAttributes = "";
			$this->indicator_measure->HrefValue = "";

			// indicator_frequency
			$this->indicator_frequency->LinkCustomAttributes = "";
			$this->indicator_frequency->HrefValue = "";
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
		if ($this->indicator_code->Required) {
			if (!$this->indicator_code->IsDetailKey && $this->indicator_code->FormValue != NULL && $this->indicator_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indicator_code->caption(), $this->indicator_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->indicator_code->FormValue)) {
			AddMessage($FormError, $this->indicator_code->errorMessage());
		}
		if ($this->indicator_name->Required) {
			if (!$this->indicator_name->IsDetailKey && $this->indicator_name->FormValue != NULL && $this->indicator_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indicator_name->caption(), $this->indicator_name->RequiredErrorMessage));
			}
		}
		if ($this->indicator_desc->Required) {
			if (!$this->indicator_desc->IsDetailKey && $this->indicator_desc->FormValue != NULL && $this->indicator_desc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indicator_desc->caption(), $this->indicator_desc->RequiredErrorMessage));
			}
		}
		if ($this->formula_ref->Required) {
			if (!$this->formula_ref->IsDetailKey && $this->formula_ref->FormValue != NULL && $this->formula_ref->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->formula_ref->caption(), $this->formula_ref->RequiredErrorMessage));
			}
		}
		if ($this->direction->Required) {
			if (!$this->direction->IsDetailKey && $this->direction->FormValue != NULL && $this->direction->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direction->caption(), $this->direction->RequiredErrorMessage));
			}
		}
		if ($this->target->Required) {
			if (!$this->target->IsDetailKey && $this->target->FormValue != NULL && $this->target->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->target->caption(), $this->target->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->target->FormValue)) {
			AddMessage($FormError, $this->target->errorMessage());
		}
		if ($this->indicator_measure->Required) {
			if (!$this->indicator_measure->IsDetailKey && $this->indicator_measure->FormValue != NULL && $this->indicator_measure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indicator_measure->caption(), $this->indicator_measure->RequiredErrorMessage));
			}
		}
		if ($this->indicator_frequency->Required) {
			if (!$this->indicator_frequency->IsDetailKey && $this->indicator_frequency->FormValue != NULL && $this->indicator_frequency->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indicator_frequency->caption(), $this->indicator_frequency->RequiredErrorMessage));
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

		// indicator_code
		$this->indicator_code->setDbValueDef($rsnew, $this->indicator_code->CurrentValue, 0, strval($this->indicator_code->CurrentValue) == "");

		// indicator_name
		$this->indicator_name->setDbValueDef($rsnew, $this->indicator_name->CurrentValue, NULL, FALSE);

		// indicator_desc
		$this->indicator_desc->setDbValueDef($rsnew, $this->indicator_desc->CurrentValue, NULL, FALSE);

		// formula_ref
		$this->formula_ref->setDbValueDef($rsnew, $this->formula_ref->CurrentValue, NULL, FALSE);

		// direction
		$this->direction->setDbValueDef($rsnew, $this->direction->CurrentValue, NULL, FALSE);

		// target
		$this->target->setDbValueDef($rsnew, $this->target->CurrentValue, NULL, strval($this->target->CurrentValue) == "");

		// indicator_measure
		$this->indicator_measure->setDbValueDef($rsnew, $this->indicator_measure->CurrentValue, NULL, strval($this->indicator_measure->CurrentValue) == "");

		// indicator_frequency
		$this->indicator_frequency->setDbValueDef($rsnew, $this->indicator_frequency->CurrentValue, NULL, strval($this->indicator_frequency->CurrentValue) == "");

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("indicator_reflist.php"), "", $this->TableVar, TRUE);
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
				case "x_direction":
					break;
				case "x_indicator_measure":
					break;
				case "x_indicator_frequency":
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
						case "x_direction":
							break;
						case "x_indicator_measure":
							break;
						case "x_indicator_frequency":
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