<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class employment_trans_add extends employment_trans
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'employment_trans';

	// Page object name
	public $PageObjName = "employment_trans_add";

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

		// Table object (employment_trans)
		if (!isset($GLOBALS["employment_trans"]) || get_class($GLOBALS["employment_trans"]) == PROJECT_NAMESPACE . "employment_trans") {
			$GLOBALS["employment_trans"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["employment_trans"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'employment_trans');

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
		global $employment_trans;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($employment_trans);
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
					if ($pageName == "employment_transview.php")
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
					$this->terminate(GetUrl("employment_translist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->ToLACode->setVisibility();
		$this->ToDept->setVisibility();
		$this->ToSection->setVisibility();
		$this->ActingPosition->setVisibility();
		$this->DateOfTransaction->setVisibility();
		$this->TransactionType->setVisibility();
		$this->TransLetter->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->TransStatus->setVisibility();
		$this->TransReason->setVisibility();
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
			$this->terminate("employment_translist.php");
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
					$this->terminate("employment_translist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "employment_translist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "employment_transview.php")
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
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->ToLACode->CurrentValue = NULL;
		$this->ToLACode->OldValue = $this->ToLACode->CurrentValue;
		$this->ToDept->CurrentValue = NULL;
		$this->ToDept->OldValue = $this->ToDept->CurrentValue;
		$this->ToSection->CurrentValue = NULL;
		$this->ToSection->OldValue = $this->ToSection->CurrentValue;
		$this->ActingPosition->CurrentValue = NULL;
		$this->ActingPosition->OldValue = $this->ActingPosition->CurrentValue;
		$this->DateOfTransaction->CurrentValue = NULL;
		$this->DateOfTransaction->OldValue = $this->DateOfTransaction->CurrentValue;
		$this->TransactionType->CurrentValue = NULL;
		$this->TransactionType->OldValue = $this->TransactionType->CurrentValue;
		$this->TransLetter->CurrentValue = NULL;
		$this->TransLetter->OldValue = $this->TransLetter->CurrentValue;
		$this->SalaryScale->CurrentValue = NULL;
		$this->SalaryScale->OldValue = $this->SalaryScale->CurrentValue;
		$this->TransStatus->CurrentValue = NULL;
		$this->TransStatus->OldValue = $this->TransStatus->CurrentValue;
		$this->TransReason->CurrentValue = NULL;
		$this->TransReason->OldValue = $this->TransReason->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}

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

		// Check field name 'ToLACode' first before field var 'x_ToLACode'
		$val = $CurrentForm->hasValue("ToLACode") ? $CurrentForm->getValue("ToLACode") : $CurrentForm->getValue("x_ToLACode");
		if (!$this->ToLACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ToLACode->Visible = FALSE; // Disable update for API request
			else
				$this->ToLACode->setFormValue($val);
		}

		// Check field name 'ToDept' first before field var 'x_ToDept'
		$val = $CurrentForm->hasValue("ToDept") ? $CurrentForm->getValue("ToDept") : $CurrentForm->getValue("x_ToDept");
		if (!$this->ToDept->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ToDept->Visible = FALSE; // Disable update for API request
			else
				$this->ToDept->setFormValue($val);
		}

		// Check field name 'ToSection' first before field var 'x_ToSection'
		$val = $CurrentForm->hasValue("ToSection") ? $CurrentForm->getValue("ToSection") : $CurrentForm->getValue("x_ToSection");
		if (!$this->ToSection->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ToSection->Visible = FALSE; // Disable update for API request
			else
				$this->ToSection->setFormValue($val);
		}

		// Check field name 'ActingPosition' first before field var 'x_ActingPosition'
		$val = $CurrentForm->hasValue("ActingPosition") ? $CurrentForm->getValue("ActingPosition") : $CurrentForm->getValue("x_ActingPosition");
		if (!$this->ActingPosition->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActingPosition->Visible = FALSE; // Disable update for API request
			else
				$this->ActingPosition->setFormValue($val);
		}

		// Check field name 'DateOfTransaction' first before field var 'x_DateOfTransaction'
		$val = $CurrentForm->hasValue("DateOfTransaction") ? $CurrentForm->getValue("DateOfTransaction") : $CurrentForm->getValue("x_DateOfTransaction");
		if (!$this->DateOfTransaction->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfTransaction->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfTransaction->setFormValue($val);
			$this->DateOfTransaction->CurrentValue = UnFormatDateTime($this->DateOfTransaction->CurrentValue, 0);
		}

		// Check field name 'TransactionType' first before field var 'x_TransactionType'
		$val = $CurrentForm->hasValue("TransactionType") ? $CurrentForm->getValue("TransactionType") : $CurrentForm->getValue("x_TransactionType");
		if (!$this->TransactionType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TransactionType->Visible = FALSE; // Disable update for API request
			else
				$this->TransactionType->setFormValue($val);
		}

		// Check field name 'TransLetter' first before field var 'x_TransLetter'
		$val = $CurrentForm->hasValue("TransLetter") ? $CurrentForm->getValue("TransLetter") : $CurrentForm->getValue("x_TransLetter");
		if (!$this->TransLetter->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TransLetter->Visible = FALSE; // Disable update for API request
			else
				$this->TransLetter->setFormValue($val);
		}

		// Check field name 'SalaryScale' first before field var 'x_SalaryScale'
		$val = $CurrentForm->hasValue("SalaryScale") ? $CurrentForm->getValue("SalaryScale") : $CurrentForm->getValue("x_SalaryScale");
		if (!$this->SalaryScale->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryScale->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryScale->setFormValue($val);
		}

		// Check field name 'TransStatus' first before field var 'x_TransStatus'
		$val = $CurrentForm->hasValue("TransStatus") ? $CurrentForm->getValue("TransStatus") : $CurrentForm->getValue("x_TransStatus");
		if (!$this->TransStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TransStatus->Visible = FALSE; // Disable update for API request
			else
				$this->TransStatus->setFormValue($val);
		}

		// Check field name 'TransReason' first before field var 'x_TransReason'
		$val = $CurrentForm->hasValue("TransReason") ? $CurrentForm->getValue("TransReason") : $CurrentForm->getValue("x_TransReason");
		if (!$this->TransReason->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TransReason->Visible = FALSE; // Disable update for API request
			else
				$this->TransReason->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->ToLACode->CurrentValue = $this->ToLACode->FormValue;
		$this->ToDept->CurrentValue = $this->ToDept->FormValue;
		$this->ToSection->CurrentValue = $this->ToSection->FormValue;
		$this->ActingPosition->CurrentValue = $this->ActingPosition->FormValue;
		$this->DateOfTransaction->CurrentValue = $this->DateOfTransaction->FormValue;
		$this->DateOfTransaction->CurrentValue = UnFormatDateTime($this->DateOfTransaction->CurrentValue, 0);
		$this->TransactionType->CurrentValue = $this->TransactionType->FormValue;
		$this->TransLetter->CurrentValue = $this->TransLetter->FormValue;
		$this->SalaryScale->CurrentValue = $this->SalaryScale->FormValue;
		$this->TransStatus->CurrentValue = $this->TransStatus->FormValue;
		$this->TransReason->CurrentValue = $this->TransReason->FormValue;
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->ToLACode->setDbValue($row['ToLACode']);
		$this->ToDept->setDbValue($row['ToDept']);
		$this->ToSection->setDbValue($row['ToSection']);
		$this->ActingPosition->setDbValue($row['ActingPosition']);
		$this->DateOfTransaction->setDbValue($row['DateOfTransaction']);
		$this->TransactionType->setDbValue($row['TransactionType']);
		$this->TransLetter->setDbValue($row['TransLetter']);
		$this->SalaryScale->setDbValue($row['SalaryScale']);
		$this->TransStatus->setDbValue($row['TransStatus']);
		$this->TransReason->setDbValue($row['TransReason']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ToLACode'] = $this->ToLACode->CurrentValue;
		$row['ToDept'] = $this->ToDept->CurrentValue;
		$row['ToSection'] = $this->ToSection->CurrentValue;
		$row['ActingPosition'] = $this->ActingPosition->CurrentValue;
		$row['DateOfTransaction'] = $this->DateOfTransaction->CurrentValue;
		$row['TransactionType'] = $this->TransactionType->CurrentValue;
		$row['TransLetter'] = $this->TransLetter->CurrentValue;
		$row['SalaryScale'] = $this->SalaryScale->CurrentValue;
		$row['TransStatus'] = $this->TransStatus->CurrentValue;
		$row['TransReason'] = $this->TransReason->CurrentValue;
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
		// EmployeeID
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ToLACode
		// ToDept
		// ToSection
		// ActingPosition
		// DateOfTransaction
		// TransactionType
		// TransLetter
		// SalaryScale
		// TransStatus
		// TransReason

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// DepartmentCode
			$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
			$this->DepartmentCode->ViewCustomAttributes = "";

			// SectionCode
			$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
			$this->SectionCode->ViewCustomAttributes = "";

			// ToLACode
			$this->ToLACode->ViewValue = $this->ToLACode->CurrentValue;
			$this->ToLACode->ViewCustomAttributes = "";

			// ToDept
			$this->ToDept->ViewValue = $this->ToDept->CurrentValue;
			$this->ToDept->ViewCustomAttributes = "";

			// ToSection
			$this->ToSection->ViewValue = $this->ToSection->CurrentValue;
			$this->ToSection->ViewCustomAttributes = "";

			// ActingPosition
			$this->ActingPosition->ViewValue = $this->ActingPosition->CurrentValue;
			$this->ActingPosition->ViewCustomAttributes = "";

			// DateOfTransaction
			$this->DateOfTransaction->ViewValue = $this->DateOfTransaction->CurrentValue;
			$this->DateOfTransaction->ViewValue = FormatDateTime($this->DateOfTransaction->ViewValue, 0);
			$this->DateOfTransaction->ViewCustomAttributes = "";

			// TransactionType
			$this->TransactionType->ViewValue = $this->TransactionType->CurrentValue;
			$this->TransactionType->ViewCustomAttributes = "";

			// TransLetter
			$this->TransLetter->ViewValue = $this->TransLetter->CurrentValue;
			$this->TransLetter->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$this->SalaryScale->ViewCustomAttributes = "";

			// TransStatus
			$this->TransStatus->ViewValue = $this->TransStatus->CurrentValue;
			$this->TransStatus->ViewCustomAttributes = "";

			// TransReason
			$this->TransReason->ViewValue = $this->TransReason->CurrentValue;
			$this->TransReason->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

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

			// ToLACode
			$this->ToLACode->LinkCustomAttributes = "";
			$this->ToLACode->HrefValue = "";
			$this->ToLACode->TooltipValue = "";

			// ToDept
			$this->ToDept->LinkCustomAttributes = "";
			$this->ToDept->HrefValue = "";
			$this->ToDept->TooltipValue = "";

			// ToSection
			$this->ToSection->LinkCustomAttributes = "";
			$this->ToSection->HrefValue = "";
			$this->ToSection->TooltipValue = "";

			// ActingPosition
			$this->ActingPosition->LinkCustomAttributes = "";
			$this->ActingPosition->HrefValue = "";
			$this->ActingPosition->TooltipValue = "";

			// DateOfTransaction
			$this->DateOfTransaction->LinkCustomAttributes = "";
			$this->DateOfTransaction->HrefValue = "";
			$this->DateOfTransaction->TooltipValue = "";

			// TransactionType
			$this->TransactionType->LinkCustomAttributes = "";
			$this->TransactionType->HrefValue = "";
			$this->TransactionType->TooltipValue = "";

			// TransLetter
			$this->TransLetter->LinkCustomAttributes = "";
			$this->TransLetter->HrefValue = "";
			$this->TransLetter->TooltipValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";

			// TransStatus
			$this->TransStatus->LinkCustomAttributes = "";
			$this->TransStatus->HrefValue = "";
			$this->TransStatus->TooltipValue = "";

			// TransReason
			$this->TransReason->LinkCustomAttributes = "";
			$this->TransReason->HrefValue = "";
			$this->TransReason->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$this->DepartmentCode->EditValue = HtmlEncode($this->DepartmentCode->CurrentValue);
			$this->DepartmentCode->PlaceHolder = RemoveHtml($this->DepartmentCode->caption());

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$this->SectionCode->EditValue = HtmlEncode($this->SectionCode->CurrentValue);
			$this->SectionCode->PlaceHolder = RemoveHtml($this->SectionCode->caption());

			// ToLACode
			$this->ToLACode->EditAttrs["class"] = "form-control";
			$this->ToLACode->EditCustomAttributes = "";
			if (!$this->ToLACode->Raw)
				$this->ToLACode->CurrentValue = HtmlDecode($this->ToLACode->CurrentValue);
			$this->ToLACode->EditValue = HtmlEncode($this->ToLACode->CurrentValue);
			$this->ToLACode->PlaceHolder = RemoveHtml($this->ToLACode->caption());

			// ToDept
			$this->ToDept->EditAttrs["class"] = "form-control";
			$this->ToDept->EditCustomAttributes = "";
			$this->ToDept->EditValue = HtmlEncode($this->ToDept->CurrentValue);
			$this->ToDept->PlaceHolder = RemoveHtml($this->ToDept->caption());

			// ToSection
			$this->ToSection->EditAttrs["class"] = "form-control";
			$this->ToSection->EditCustomAttributes = "";
			$this->ToSection->EditValue = HtmlEncode($this->ToSection->CurrentValue);
			$this->ToSection->PlaceHolder = RemoveHtml($this->ToSection->caption());

			// ActingPosition
			$this->ActingPosition->EditAttrs["class"] = "form-control";
			$this->ActingPosition->EditCustomAttributes = "";
			$this->ActingPosition->EditValue = HtmlEncode($this->ActingPosition->CurrentValue);
			$this->ActingPosition->PlaceHolder = RemoveHtml($this->ActingPosition->caption());

			// DateOfTransaction
			$this->DateOfTransaction->EditAttrs["class"] = "form-control";
			$this->DateOfTransaction->EditCustomAttributes = "";
			$this->DateOfTransaction->EditValue = HtmlEncode(FormatDateTime($this->DateOfTransaction->CurrentValue, 8));
			$this->DateOfTransaction->PlaceHolder = RemoveHtml($this->DateOfTransaction->caption());

			// TransactionType
			$this->TransactionType->EditAttrs["class"] = "form-control";
			$this->TransactionType->EditCustomAttributes = "";
			$this->TransactionType->EditValue = HtmlEncode($this->TransactionType->CurrentValue);
			$this->TransactionType->PlaceHolder = RemoveHtml($this->TransactionType->caption());

			// TransLetter
			$this->TransLetter->EditAttrs["class"] = "form-control";
			$this->TransLetter->EditCustomAttributes = "";
			$this->TransLetter->EditValue = HtmlEncode($this->TransLetter->CurrentValue);
			$this->TransLetter->PlaceHolder = RemoveHtml($this->TransLetter->caption());

			// SalaryScale
			$this->SalaryScale->EditAttrs["class"] = "form-control";
			$this->SalaryScale->EditCustomAttributes = "";
			if (!$this->SalaryScale->Raw)
				$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->EditValue = HtmlEncode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());

			// TransStatus
			$this->TransStatus->EditAttrs["class"] = "form-control";
			$this->TransStatus->EditCustomAttributes = "";
			$this->TransStatus->EditValue = HtmlEncode($this->TransStatus->CurrentValue);
			$this->TransStatus->PlaceHolder = RemoveHtml($this->TransStatus->caption());

			// TransReason
			$this->TransReason->EditAttrs["class"] = "form-control";
			$this->TransReason->EditCustomAttributes = "";
			if (!$this->TransReason->Raw)
				$this->TransReason->CurrentValue = HtmlDecode($this->TransReason->CurrentValue);
			$this->TransReason->EditValue = HtmlEncode($this->TransReason->CurrentValue);
			$this->TransReason->PlaceHolder = RemoveHtml($this->TransReason->caption());

			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// ToLACode
			$this->ToLACode->LinkCustomAttributes = "";
			$this->ToLACode->HrefValue = "";

			// ToDept
			$this->ToDept->LinkCustomAttributes = "";
			$this->ToDept->HrefValue = "";

			// ToSection
			$this->ToSection->LinkCustomAttributes = "";
			$this->ToSection->HrefValue = "";

			// ActingPosition
			$this->ActingPosition->LinkCustomAttributes = "";
			$this->ActingPosition->HrefValue = "";

			// DateOfTransaction
			$this->DateOfTransaction->LinkCustomAttributes = "";
			$this->DateOfTransaction->HrefValue = "";

			// TransactionType
			$this->TransactionType->LinkCustomAttributes = "";
			$this->TransactionType->HrefValue = "";

			// TransLetter
			$this->TransLetter->LinkCustomAttributes = "";
			$this->TransLetter->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";

			// TransStatus
			$this->TransStatus->LinkCustomAttributes = "";
			$this->TransStatus->HrefValue = "";

			// TransReason
			$this->TransReason->LinkCustomAttributes = "";
			$this->TransReason->HrefValue = "";
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
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ProvinceCode->FormValue)) {
			AddMessage($FormError, $this->ProvinceCode->errorMessage());
		}
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
		if (!CheckInteger($this->DepartmentCode->FormValue)) {
			AddMessage($FormError, $this->DepartmentCode->errorMessage());
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SectionCode->FormValue)) {
			AddMessage($FormError, $this->SectionCode->errorMessage());
		}
		if ($this->ToLACode->Required) {
			if (!$this->ToLACode->IsDetailKey && $this->ToLACode->FormValue != NULL && $this->ToLACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ToLACode->caption(), $this->ToLACode->RequiredErrorMessage));
			}
		}
		if ($this->ToDept->Required) {
			if (!$this->ToDept->IsDetailKey && $this->ToDept->FormValue != NULL && $this->ToDept->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ToDept->caption(), $this->ToDept->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ToDept->FormValue)) {
			AddMessage($FormError, $this->ToDept->errorMessage());
		}
		if ($this->ToSection->Required) {
			if (!$this->ToSection->IsDetailKey && $this->ToSection->FormValue != NULL && $this->ToSection->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ToSection->caption(), $this->ToSection->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ToSection->FormValue)) {
			AddMessage($FormError, $this->ToSection->errorMessage());
		}
		if ($this->ActingPosition->Required) {
			if (!$this->ActingPosition->IsDetailKey && $this->ActingPosition->FormValue != NULL && $this->ActingPosition->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActingPosition->caption(), $this->ActingPosition->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ActingPosition->FormValue)) {
			AddMessage($FormError, $this->ActingPosition->errorMessage());
		}
		if ($this->DateOfTransaction->Required) {
			if (!$this->DateOfTransaction->IsDetailKey && $this->DateOfTransaction->FormValue != NULL && $this->DateOfTransaction->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfTransaction->caption(), $this->DateOfTransaction->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfTransaction->FormValue)) {
			AddMessage($FormError, $this->DateOfTransaction->errorMessage());
		}
		if ($this->TransactionType->Required) {
			if (!$this->TransactionType->IsDetailKey && $this->TransactionType->FormValue != NULL && $this->TransactionType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransactionType->caption(), $this->TransactionType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TransactionType->FormValue)) {
			AddMessage($FormError, $this->TransactionType->errorMessage());
		}
		if ($this->TransLetter->Required) {
			if (!$this->TransLetter->IsDetailKey && $this->TransLetter->FormValue != NULL && $this->TransLetter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransLetter->caption(), $this->TransLetter->RequiredErrorMessage));
			}
		}
		if ($this->SalaryScale->Required) {
			if (!$this->SalaryScale->IsDetailKey && $this->SalaryScale->FormValue != NULL && $this->SalaryScale->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryScale->caption(), $this->SalaryScale->RequiredErrorMessage));
			}
		}
		if ($this->TransStatus->Required) {
			if (!$this->TransStatus->IsDetailKey && $this->TransStatus->FormValue != NULL && $this->TransStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransStatus->caption(), $this->TransStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TransStatus->FormValue)) {
			AddMessage($FormError, $this->TransStatus->errorMessage());
		}
		if ($this->TransReason->Required) {
			if (!$this->TransReason->IsDetailKey && $this->TransReason->FormValue != NULL && $this->TransReason->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TransReason->caption(), $this->TransReason->RequiredErrorMessage));
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

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// ToLACode
		$this->ToLACode->setDbValueDef($rsnew, $this->ToLACode->CurrentValue, NULL, FALSE);

		// ToDept
		$this->ToDept->setDbValueDef($rsnew, $this->ToDept->CurrentValue, NULL, FALSE);

		// ToSection
		$this->ToSection->setDbValueDef($rsnew, $this->ToSection->CurrentValue, NULL, FALSE);

		// ActingPosition
		$this->ActingPosition->setDbValueDef($rsnew, $this->ActingPosition->CurrentValue, 0, FALSE);

		// DateOfTransaction
		$this->DateOfTransaction->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfTransaction->CurrentValue, 0), CurrentDate(), FALSE);

		// TransactionType
		$this->TransactionType->setDbValueDef($rsnew, $this->TransactionType->CurrentValue, 0, FALSE);

		// TransLetter
		$this->TransLetter->setDbValueDef($rsnew, $this->TransLetter->CurrentValue, NULL, FALSE);

		// SalaryScale
		$this->SalaryScale->setDbValueDef($rsnew, $this->SalaryScale->CurrentValue, "", FALSE);

		// TransStatus
		$this->TransStatus->setDbValueDef($rsnew, $this->TransStatus->CurrentValue, 0, FALSE);

		// TransReason
		$this->TransReason->setDbValueDef($rsnew, $this->TransReason->CurrentValue, "", FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("employment_translist.php"), "", $this->TableVar, TRUE);
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