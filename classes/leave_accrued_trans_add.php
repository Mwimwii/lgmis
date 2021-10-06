<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class leave_accrued_trans_add extends leave_accrued_trans
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'leave_accrued_trans';

	// Page object name
	public $PageObjName = "leave_accrued_trans_add";

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

		// Table object (leave_accrued_trans)
		if (!isset($GLOBALS["leave_accrued_trans"]) || get_class($GLOBALS["leave_accrued_trans"]) == PROJECT_NAMESPACE . "leave_accrued_trans") {
			$GLOBALS["leave_accrued_trans"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["leave_accrued_trans"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'leave_accrued_trans');

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
		global $leave_accrued_trans;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($leave_accrued_trans);
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
					if ($pageName == "leave_accrued_transview.php")
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
					$this->terminate(GetUrl("leave_accrued_translist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Year->setVisibility();
		$this->RunMonth->setVisibility();
		$this->EmployeeID->setVisibility();
		$this->LeaveTypeCode->setVisibility();
		$this->LeaveAccrued->setVisibility();
		$this->LastAccrualDate->setVisibility();
		$this->LeaveLost->setVisibility();
		$this->LACode->setVisibility();
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
			$this->terminate("leave_accrued_translist.php");
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
					$this->terminate("leave_accrued_translist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "leave_accrued_translist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "leave_accrued_transview.php")
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
		$this->Year->CurrentValue = NULL;
		$this->Year->OldValue = $this->Year->CurrentValue;
		$this->RunMonth->CurrentValue = NULL;
		$this->RunMonth->OldValue = $this->RunMonth->CurrentValue;
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->LeaveTypeCode->CurrentValue = NULL;
		$this->LeaveTypeCode->OldValue = $this->LeaveTypeCode->CurrentValue;
		$this->LeaveAccrued->CurrentValue = NULL;
		$this->LeaveAccrued->OldValue = $this->LeaveAccrued->CurrentValue;
		$this->LastAccrualDate->CurrentValue = NULL;
		$this->LastAccrualDate->OldValue = $this->LastAccrualDate->CurrentValue;
		$this->LeaveLost->CurrentValue = NULL;
		$this->LeaveLost->OldValue = $this->LeaveLost->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Year' first before field var 'x_Year'
		$val = $CurrentForm->hasValue("Year") ? $CurrentForm->getValue("Year") : $CurrentForm->getValue("x_Year");
		if (!$this->Year->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Year->Visible = FALSE; // Disable update for API request
			else
				$this->Year->setFormValue($val);
		}

		// Check field name 'RunMonth' first before field var 'x_RunMonth'
		$val = $CurrentForm->hasValue("RunMonth") ? $CurrentForm->getValue("RunMonth") : $CurrentForm->getValue("x_RunMonth");
		if (!$this->RunMonth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RunMonth->Visible = FALSE; // Disable update for API request
			else
				$this->RunMonth->setFormValue($val);
		}

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}

		// Check field name 'LeaveTypeCode' first before field var 'x_LeaveTypeCode'
		$val = $CurrentForm->hasValue("LeaveTypeCode") ? $CurrentForm->getValue("LeaveTypeCode") : $CurrentForm->getValue("x_LeaveTypeCode");
		if (!$this->LeaveTypeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LeaveTypeCode->Visible = FALSE; // Disable update for API request
			else
				$this->LeaveTypeCode->setFormValue($val);
		}

		// Check field name 'LeaveAccrued' first before field var 'x_LeaveAccrued'
		$val = $CurrentForm->hasValue("LeaveAccrued") ? $CurrentForm->getValue("LeaveAccrued") : $CurrentForm->getValue("x_LeaveAccrued");
		if (!$this->LeaveAccrued->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LeaveAccrued->Visible = FALSE; // Disable update for API request
			else
				$this->LeaveAccrued->setFormValue($val);
		}

		// Check field name 'LastAccrualDate' first before field var 'x_LastAccrualDate'
		$val = $CurrentForm->hasValue("LastAccrualDate") ? $CurrentForm->getValue("LastAccrualDate") : $CurrentForm->getValue("x_LastAccrualDate");
		if (!$this->LastAccrualDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastAccrualDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastAccrualDate->setFormValue($val);
			$this->LastAccrualDate->CurrentValue = UnFormatDateTime($this->LastAccrualDate->CurrentValue, 0);
		}

		// Check field name 'LeaveLost' first before field var 'x_LeaveLost'
		$val = $CurrentForm->hasValue("LeaveLost") ? $CurrentForm->getValue("LeaveLost") : $CurrentForm->getValue("x_LeaveLost");
		if (!$this->LeaveLost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LeaveLost->Visible = FALSE; // Disable update for API request
			else
				$this->LeaveLost->setFormValue($val);
		}

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Year->CurrentValue = $this->Year->FormValue;
		$this->RunMonth->CurrentValue = $this->RunMonth->FormValue;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->LeaveTypeCode->CurrentValue = $this->LeaveTypeCode->FormValue;
		$this->LeaveAccrued->CurrentValue = $this->LeaveAccrued->FormValue;
		$this->LastAccrualDate->CurrentValue = $this->LastAccrualDate->FormValue;
		$this->LastAccrualDate->CurrentValue = UnFormatDateTime($this->LastAccrualDate->CurrentValue, 0);
		$this->LeaveLost->CurrentValue = $this->LeaveLost->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
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
		$this->Year->setDbValue($row['Year']);
		$this->RunMonth->setDbValue($row['RunMonth']);
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->LeaveTypeCode->setDbValue($row['LeaveTypeCode']);
		$this->LeaveAccrued->setDbValue($row['LeaveAccrued']);
		$this->LastAccrualDate->setDbValue($row['LastAccrualDate']);
		$this->LeaveLost->setDbValue($row['LeaveLost']);
		$this->LACode->setDbValue($row['LACode']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Year'] = $this->Year->CurrentValue;
		$row['RunMonth'] = $this->RunMonth->CurrentValue;
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['LeaveTypeCode'] = $this->LeaveTypeCode->CurrentValue;
		$row['LeaveAccrued'] = $this->LeaveAccrued->CurrentValue;
		$row['LastAccrualDate'] = $this->LastAccrualDate->CurrentValue;
		$row['LeaveLost'] = $this->LeaveLost->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
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

		if ($this->LeaveAccrued->FormValue == $this->LeaveAccrued->CurrentValue && is_numeric(ConvertToFloatString($this->LeaveAccrued->CurrentValue)))
			$this->LeaveAccrued->CurrentValue = ConvertToFloatString($this->LeaveAccrued->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LeaveLost->FormValue == $this->LeaveLost->CurrentValue && is_numeric(ConvertToFloatString($this->LeaveLost->CurrentValue)))
			$this->LeaveLost->CurrentValue = ConvertToFloatString($this->LeaveLost->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Year
		// RunMonth
		// EmployeeID
		// LeaveTypeCode
		// LeaveAccrued
		// LastAccrualDate
		// LeaveLost
		// LACode

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Year
			$this->Year->ViewValue = $this->Year->CurrentValue;
			$this->Year->ViewCustomAttributes = "";

			// RunMonth
			$this->RunMonth->ViewValue = $this->RunMonth->CurrentValue;
			$this->RunMonth->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// LeaveTypeCode
			$this->LeaveTypeCode->ViewValue = $this->LeaveTypeCode->CurrentValue;
			$this->LeaveTypeCode->ViewCustomAttributes = "";

			// LeaveAccrued
			$this->LeaveAccrued->ViewValue = $this->LeaveAccrued->CurrentValue;
			$this->LeaveAccrued->ViewValue = FormatNumber($this->LeaveAccrued->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->LeaveAccrued->ViewCustomAttributes = "";

			// LastAccrualDate
			$this->LastAccrualDate->ViewValue = $this->LastAccrualDate->CurrentValue;
			$this->LastAccrualDate->ViewValue = FormatDateTime($this->LastAccrualDate->ViewValue, 0);
			$this->LastAccrualDate->ViewCustomAttributes = "";

			// LeaveLost
			$this->LeaveLost->ViewValue = $this->LeaveLost->CurrentValue;
			$this->LeaveLost->ViewValue = FormatNumber($this->LeaveLost->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->LeaveLost->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// Year
			$this->Year->LinkCustomAttributes = "";
			$this->Year->HrefValue = "";
			$this->Year->TooltipValue = "";

			// RunMonth
			$this->RunMonth->LinkCustomAttributes = "";
			$this->RunMonth->HrefValue = "";
			$this->RunMonth->TooltipValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// LeaveTypeCode
			$this->LeaveTypeCode->LinkCustomAttributes = "";
			$this->LeaveTypeCode->HrefValue = "";
			$this->LeaveTypeCode->TooltipValue = "";

			// LeaveAccrued
			$this->LeaveAccrued->LinkCustomAttributes = "";
			$this->LeaveAccrued->HrefValue = "";
			$this->LeaveAccrued->TooltipValue = "";

			// LastAccrualDate
			$this->LastAccrualDate->LinkCustomAttributes = "";
			$this->LastAccrualDate->HrefValue = "";
			$this->LastAccrualDate->TooltipValue = "";

			// LeaveLost
			$this->LeaveLost->LinkCustomAttributes = "";
			$this->LeaveLost->HrefValue = "";
			$this->LeaveLost->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Year
			$this->Year->EditAttrs["class"] = "form-control";
			$this->Year->EditCustomAttributes = "";
			$this->Year->EditValue = HtmlEncode($this->Year->CurrentValue);
			$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

			// RunMonth
			$this->RunMonth->EditAttrs["class"] = "form-control";
			$this->RunMonth->EditCustomAttributes = "";
			$this->RunMonth->EditValue = HtmlEncode($this->RunMonth->CurrentValue);
			$this->RunMonth->PlaceHolder = RemoveHtml($this->RunMonth->caption());

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// LeaveTypeCode
			$this->LeaveTypeCode->EditAttrs["class"] = "form-control";
			$this->LeaveTypeCode->EditCustomAttributes = "";
			$this->LeaveTypeCode->EditValue = HtmlEncode($this->LeaveTypeCode->CurrentValue);
			$this->LeaveTypeCode->PlaceHolder = RemoveHtml($this->LeaveTypeCode->caption());

			// LeaveAccrued
			$this->LeaveAccrued->EditAttrs["class"] = "form-control";
			$this->LeaveAccrued->EditCustomAttributes = "";
			$this->LeaveAccrued->EditValue = HtmlEncode($this->LeaveAccrued->CurrentValue);
			$this->LeaveAccrued->PlaceHolder = RemoveHtml($this->LeaveAccrued->caption());
			if (strval($this->LeaveAccrued->EditValue) != "" && is_numeric($this->LeaveAccrued->EditValue))
				$this->LeaveAccrued->EditValue = FormatNumber($this->LeaveAccrued->EditValue, -2, -1, -2, 0);
			

			// LastAccrualDate
			$this->LastAccrualDate->EditAttrs["class"] = "form-control";
			$this->LastAccrualDate->EditCustomAttributes = "";
			$this->LastAccrualDate->EditValue = HtmlEncode(FormatDateTime($this->LastAccrualDate->CurrentValue, 8));
			$this->LastAccrualDate->PlaceHolder = RemoveHtml($this->LastAccrualDate->caption());

			// LeaveLost
			$this->LeaveLost->EditAttrs["class"] = "form-control";
			$this->LeaveLost->EditCustomAttributes = "";
			$this->LeaveLost->EditValue = HtmlEncode($this->LeaveLost->CurrentValue);
			$this->LeaveLost->PlaceHolder = RemoveHtml($this->LeaveLost->caption());
			if (strval($this->LeaveLost->EditValue) != "" && is_numeric($this->LeaveLost->EditValue))
				$this->LeaveLost->EditValue = FormatNumber($this->LeaveLost->EditValue, -2, -1, -2, 0);
			

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// Add refer script
			// Year

			$this->Year->LinkCustomAttributes = "";
			$this->Year->HrefValue = "";

			// RunMonth
			$this->RunMonth->LinkCustomAttributes = "";
			$this->RunMonth->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// LeaveTypeCode
			$this->LeaveTypeCode->LinkCustomAttributes = "";
			$this->LeaveTypeCode->HrefValue = "";

			// LeaveAccrued
			$this->LeaveAccrued->LinkCustomAttributes = "";
			$this->LeaveAccrued->HrefValue = "";

			// LastAccrualDate
			$this->LastAccrualDate->LinkCustomAttributes = "";
			$this->LastAccrualDate->HrefValue = "";

			// LeaveLost
			$this->LeaveLost->LinkCustomAttributes = "";
			$this->LeaveLost->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
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
		if ($this->Year->Required) {
			if (!$this->Year->IsDetailKey && $this->Year->FormValue != NULL && $this->Year->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Year->caption(), $this->Year->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Year->FormValue)) {
			AddMessage($FormError, $this->Year->errorMessage());
		}
		if ($this->RunMonth->Required) {
			if (!$this->RunMonth->IsDetailKey && $this->RunMonth->FormValue != NULL && $this->RunMonth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RunMonth->caption(), $this->RunMonth->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RunMonth->FormValue)) {
			AddMessage($FormError, $this->RunMonth->errorMessage());
		}
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->LeaveTypeCode->Required) {
			if (!$this->LeaveTypeCode->IsDetailKey && $this->LeaveTypeCode->FormValue != NULL && $this->LeaveTypeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeaveTypeCode->caption(), $this->LeaveTypeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->LeaveTypeCode->FormValue)) {
			AddMessage($FormError, $this->LeaveTypeCode->errorMessage());
		}
		if ($this->LeaveAccrued->Required) {
			if (!$this->LeaveAccrued->IsDetailKey && $this->LeaveAccrued->FormValue != NULL && $this->LeaveAccrued->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeaveAccrued->caption(), $this->LeaveAccrued->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LeaveAccrued->FormValue)) {
			AddMessage($FormError, $this->LeaveAccrued->errorMessage());
		}
		if ($this->LastAccrualDate->Required) {
			if (!$this->LastAccrualDate->IsDetailKey && $this->LastAccrualDate->FormValue != NULL && $this->LastAccrualDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastAccrualDate->caption(), $this->LastAccrualDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastAccrualDate->FormValue)) {
			AddMessage($FormError, $this->LastAccrualDate->errorMessage());
		}
		if ($this->LeaveLost->Required) {
			if (!$this->LeaveLost->IsDetailKey && $this->LeaveLost->FormValue != NULL && $this->LeaveLost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeaveLost->caption(), $this->LeaveLost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LeaveLost->FormValue)) {
			AddMessage($FormError, $this->LeaveLost->errorMessage());
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
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

		// Year
		$this->Year->setDbValueDef($rsnew, $this->Year->CurrentValue, 0, FALSE);

		// RunMonth
		$this->RunMonth->setDbValueDef($rsnew, $this->RunMonth->CurrentValue, 0, FALSE);

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// LeaveTypeCode
		$this->LeaveTypeCode->setDbValueDef($rsnew, $this->LeaveTypeCode->CurrentValue, 0, FALSE);

		// LeaveAccrued
		$this->LeaveAccrued->setDbValueDef($rsnew, $this->LeaveAccrued->CurrentValue, NULL, FALSE);

		// LastAccrualDate
		$this->LastAccrualDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastAccrualDate->CurrentValue, 0), NULL, FALSE);

		// LeaveLost
		$this->LeaveLost->setDbValueDef($rsnew, $this->LeaveLost->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("leave_accrued_translist.php"), "", $this->TableVar, TRUE);
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