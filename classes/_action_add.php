<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class _action_add extends _action
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'action';

	// Page object name
	public $PageObjName = "_action_add";

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

		// Table object (_action)
		if (!isset($GLOBALS["_action"]) || get_class($GLOBALS["_action"]) == PROJECT_NAMESPACE . "_action") {
			$GLOBALS["_action"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["_action"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (output)
		if (!isset($GLOBALS['output']))
			$GLOBALS['output'] = new output();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'action');

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
		global $_action;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($_action);
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
					if ($pageName == "_actionview.php")
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
			$key .= @$ar['ActionCode'] . Config("COMPOSITE_KEY_SEPARATOR");
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
			$this->ActionCode->Visible = FALSE;
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
					$this->terminate(GetUrl("_actionlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ProgramCode->setVisibility();
		$this->OucomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ProjectCode->setVisibility();
		$this->ActionCode->Visible = FALSE;
		$this->ActionName->setVisibility();
		$this->ActionType->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->MTEFBudget->Visible = FALSE;
		$this->SupplementaryBudget->Visible = FALSE;
		$this->ExpectedAnnualAchievement->setVisibility();
		$this->ActionLocation->setVisibility();
		$this->Latitude->setVisibility();
		$this->Longitude->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
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
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->OucomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ProjectCode);
		$this->setupLookupOptions($this->ActionType);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("_actionlist.php");
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
			if (Get("ActionCode") !== NULL) {
				$this->ActionCode->setQueryStringValue(Get("ActionCode"));
				$this->setKey("ActionCode", $this->ActionCode->CurrentValue); // Set up key
			} else {
				$this->setKey("ActionCode", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("_actionlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "_actionlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "_actionview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->OucomeCode->CurrentValue = NULL;
		$this->OucomeCode->OldValue = $this->OucomeCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->ProjectCode->CurrentValue = NULL;
		$this->ProjectCode->OldValue = $this->ProjectCode->CurrentValue;
		$this->ActionCode->CurrentValue = NULL;
		$this->ActionCode->OldValue = $this->ActionCode->CurrentValue;
		$this->ActionName->CurrentValue = NULL;
		$this->ActionName->OldValue = $this->ActionName->CurrentValue;
		$this->ActionType->CurrentValue = NULL;
		$this->ActionType->OldValue = $this->ActionType->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->MTEFBudget->CurrentValue = 0;
		$this->SupplementaryBudget->CurrentValue = 0;
		$this->ExpectedAnnualAchievement->CurrentValue = NULL;
		$this->ExpectedAnnualAchievement->OldValue = $this->ExpectedAnnualAchievement->CurrentValue;
		$this->ActionLocation->CurrentValue = NULL;
		$this->ActionLocation->OldValue = $this->ActionLocation->CurrentValue;
		$this->Latitude->CurrentValue = NULL;
		$this->Latitude->OldValue = $this->Latitude->CurrentValue;
		$this->Longitude->CurrentValue = NULL;
		$this->Longitude->OldValue = $this->Longitude->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ProgramCode' first before field var 'x_ProgramCode'
		$val = $CurrentForm->hasValue("ProgramCode") ? $CurrentForm->getValue("ProgramCode") : $CurrentForm->getValue("x_ProgramCode");
		if (!$this->ProgramCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgramCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProgramCode->setFormValue($val);
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

		// Check field name 'ActionName' first before field var 'x_ActionName'
		$val = $CurrentForm->hasValue("ActionName") ? $CurrentForm->getValue("ActionName") : $CurrentForm->getValue("x_ActionName");
		if (!$this->ActionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionName->Visible = FALSE; // Disable update for API request
			else
				$this->ActionName->setFormValue($val);
		}

		// Check field name 'ActionType' first before field var 'x_ActionType'
		$val = $CurrentForm->hasValue("ActionType") ? $CurrentForm->getValue("ActionType") : $CurrentForm->getValue("x_ActionType");
		if (!$this->ActionType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionType->Visible = FALSE; // Disable update for API request
			else
				$this->ActionType->setFormValue($val);
		}

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}

		// Check field name 'ExpectedAnnualAchievement' first before field var 'x_ExpectedAnnualAchievement'
		$val = $CurrentForm->hasValue("ExpectedAnnualAchievement") ? $CurrentForm->getValue("ExpectedAnnualAchievement") : $CurrentForm->getValue("x_ExpectedAnnualAchievement");
		if (!$this->ExpectedAnnualAchievement->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExpectedAnnualAchievement->Visible = FALSE; // Disable update for API request
			else
				$this->ExpectedAnnualAchievement->setFormValue($val);
		}

		// Check field name 'ActionLocation' first before field var 'x_ActionLocation'
		$val = $CurrentForm->hasValue("ActionLocation") ? $CurrentForm->getValue("ActionLocation") : $CurrentForm->getValue("x_ActionLocation");
		if (!$this->ActionLocation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionLocation->Visible = FALSE; // Disable update for API request
			else
				$this->ActionLocation->setFormValue($val);
		}

		// Check field name 'Latitude' first before field var 'x_Latitude'
		$val = $CurrentForm->hasValue("Latitude") ? $CurrentForm->getValue("Latitude") : $CurrentForm->getValue("x_Latitude");
		if (!$this->Latitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Latitude->Visible = FALSE; // Disable update for API request
			else
				$this->Latitude->setFormValue($val);
		}

		// Check field name 'Longitude' first before field var 'x_Longitude'
		$val = $CurrentForm->hasValue("Longitude") ? $CurrentForm->getValue("Longitude") : $CurrentForm->getValue("x_Longitude");
		if (!$this->Longitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Longitude->Visible = FALSE; // Disable update for API request
			else
				$this->Longitude->setFormValue($val);
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

		// Check field name 'ActionCode' first before field var 'x_ActionCode'
		$val = $CurrentForm->hasValue("ActionCode") ? $CurrentForm->getValue("ActionCode") : $CurrentForm->getValue("x_ActionCode");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->OucomeCode->CurrentValue = $this->OucomeCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->ProjectCode->CurrentValue = $this->ProjectCode->FormValue;
		$this->ActionName->CurrentValue = $this->ActionName->FormValue;
		$this->ActionType->CurrentValue = $this->ActionType->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->ExpectedAnnualAchievement->CurrentValue = $this->ExpectedAnnualAchievement->FormValue;
		$this->ActionLocation->CurrentValue = $this->ActionLocation->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
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
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->OucomeCode->setDbValue($row['OucomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ProjectCode->setDbValue($row['ProjectCode']);
		$this->ActionCode->setDbValue($row['ActionCode']);
		$this->ActionName->setDbValue($row['ActionName']);
		$this->ActionType->setDbValue($row['ActionType']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->MTEFBudget->setDbValue($row['MTEFBudget']);
		$this->SupplementaryBudget->setDbValue($row['SupplementaryBudget']);
		$this->ExpectedAnnualAchievement->setDbValue($row['ExpectedAnnualAchievement']);
		$this->ActionLocation->setDbValue($row['ActionLocation']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['OucomeCode'] = $this->OucomeCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['ProjectCode'] = $this->ProjectCode->CurrentValue;
		$row['ActionCode'] = $this->ActionCode->CurrentValue;
		$row['ActionName'] = $this->ActionName->CurrentValue;
		$row['ActionType'] = $this->ActionType->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['MTEFBudget'] = $this->MTEFBudget->CurrentValue;
		$row['SupplementaryBudget'] = $this->SupplementaryBudget->CurrentValue;
		$row['ExpectedAnnualAchievement'] = $this->ExpectedAnnualAchievement->CurrentValue;
		$row['ActionLocation'] = $this->ActionLocation->CurrentValue;
		$row['Latitude'] = $this->Latitude->CurrentValue;
		$row['Longitude'] = $this->Longitude->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ActionCode")) != "")
			$this->ActionCode->OldValue = $this->getKey("ActionCode"); // ActionCode
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

		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ProgramCode
		// OucomeCode
		// OutputCode
		// ProjectCode
		// ActionCode
		// ActionName
		// ActionType
		// FinancialYear
		// MTEFBudget
		// SupplementaryBudget
		// ExpectedAnnualAchievement
		// ActionLocation
		// Latitude
		// Longitude
		// LACode
		// DepartmentCode
		// SectionCode

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ProgramCode
			$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";

			// OucomeCode
			$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
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
			$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
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

			// ActionCode
			$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
			$this->ActionCode->ViewCustomAttributes = "";

			// ActionName
			$this->ActionName->ViewValue = $this->ActionName->CurrentValue;
			$this->ActionName->ViewCustomAttributes = "";

			// ActionType
			$curVal = strval($this->ActionType->CurrentValue);
			if ($curVal != "") {
				$this->ActionType->ViewValue = $this->ActionType->lookupCacheOption($curVal);
				if ($this->ActionType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ActionType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionType->ViewValue = $this->ActionType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionType->ViewValue = $this->ActionType->CurrentValue;
					}
				}
			} else {
				$this->ActionType->ViewValue = NULL;
			}
			$this->ActionType->ViewCustomAttributes = "";

			// FinancialYear
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";

			// MTEFBudget
			$this->MTEFBudget->ViewValue = $this->MTEFBudget->CurrentValue;
			$this->MTEFBudget->ViewValue = FormatNumber($this->MTEFBudget->ViewValue, 2, -2, -2, -2);
			$this->MTEFBudget->ViewCustomAttributes = "";

			// SupplementaryBudget
			$this->SupplementaryBudget->ViewValue = $this->SupplementaryBudget->CurrentValue;
			$this->SupplementaryBudget->ViewValue = FormatNumber($this->SupplementaryBudget->ViewValue, 2, -2, -2, -2);
			$this->SupplementaryBudget->ViewCustomAttributes = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->ViewValue = $this->ExpectedAnnualAchievement->CurrentValue;
			$this->ExpectedAnnualAchievement->ViewCustomAttributes = "";

			// ActionLocation
			$this->ActionLocation->ViewValue = $this->ActionLocation->CurrentValue;
			$this->ActionLocation->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, 2, -2, -2, -2);
			$this->Latitude->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, 2, -2, -2, -2);
			$this->Longitude->ViewCustomAttributes = "";

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

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

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

			// ActionName
			$this->ActionName->LinkCustomAttributes = "";
			$this->ActionName->HrefValue = "";
			$this->ActionName->TooltipValue = "";

			// ActionType
			$this->ActionType->LinkCustomAttributes = "";
			$this->ActionType->HrefValue = "";
			$this->ActionType->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->LinkCustomAttributes = "";
			$this->ExpectedAnnualAchievement->HrefValue = "";
			$this->ExpectedAnnualAchievement->TooltipValue = "";

			// ActionLocation
			$this->ActionLocation->LinkCustomAttributes = "";
			$this->ActionLocation->HrefValue = "";
			$this->ActionLocation->TooltipValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
			$this->ProgramCode->EditCustomAttributes = "";
			if ($this->ProgramCode->getSessionValue() != "") {
				$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
				$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
				$curVal = strval($this->ProgramCode->CurrentValue);
				if ($curVal != "") {
					$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
					if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
						}
					}
				} else {
					$this->ProgramCode->ViewValue = NULL;
				}
				$this->ProgramCode->ViewCustomAttributes = "";
			} else {
				$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
				$curVal = strval($this->ProgramCode->CurrentValue);
				if ($curVal != "") {
					$this->ProgramCode->EditValue = $this->ProgramCode->lookupCacheOption($curVal);
					if ($this->ProgramCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->ProgramCode->EditValue = $this->ProgramCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
						}
					}
				} else {
					$this->ProgramCode->EditValue = NULL;
				}
				$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());
			}

			// OucomeCode
			$this->OucomeCode->EditAttrs["class"] = "form-control";
			$this->OucomeCode->EditCustomAttributes = "";
			if ($this->OucomeCode->getSessionValue() != "") {
				$this->OucomeCode->CurrentValue = $this->OucomeCode->getSessionValue();
				$this->OucomeCode->ViewValue = $this->OucomeCode->CurrentValue;
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
			} else {
				$this->OucomeCode->EditValue = HtmlEncode($this->OucomeCode->CurrentValue);
				$curVal = strval($this->OucomeCode->CurrentValue);
				if ($curVal != "") {
					$this->OucomeCode->EditValue = $this->OucomeCode->lookupCacheOption($curVal);
					if ($this->OucomeCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OucomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->OucomeCode->EditValue = $this->OucomeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OucomeCode->EditValue = HtmlEncode($this->OucomeCode->CurrentValue);
						}
					}
				} else {
					$this->OucomeCode->EditValue = NULL;
				}
				$this->OucomeCode->PlaceHolder = RemoveHtml($this->OucomeCode->caption());
			}

			// OutputCode
			$this->OutputCode->EditAttrs["class"] = "form-control";
			$this->OutputCode->EditCustomAttributes = "";
			if ($this->OutputCode->getSessionValue() != "") {
				$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
				$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
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
			} else {
				$this->OutputCode->EditValue = HtmlEncode($this->OutputCode->CurrentValue);
				$curVal = strval($this->OutputCode->CurrentValue);
				if ($curVal != "") {
					$this->OutputCode->EditValue = $this->OutputCode->lookupCacheOption($curVal);
					if ($this->OutputCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->OutputCode->EditValue = $this->OutputCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutputCode->EditValue = HtmlEncode($this->OutputCode->CurrentValue);
						}
					}
				} else {
					$this->OutputCode->EditValue = NULL;
				}
				$this->OutputCode->PlaceHolder = RemoveHtml($this->OutputCode->caption());
			}

			// ProjectCode
			$this->ProjectCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectCode->CurrentValue));
			if ($curVal != "")
				$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
			else
				$this->ProjectCode->ViewValue = $this->ProjectCode->Lookup !== NULL && is_array($this->ProjectCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectCode->ViewValue !== NULL) { // Load from cache
				$this->ProjectCode->EditValue = array_values($this->ProjectCode->Lookup->Options);
				if ($this->ProjectCode->ViewValue == "")
					$this->ProjectCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectCode`" . SearchString("=", $this->ProjectCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProjectCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
				} else {
					$this->ProjectCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectCode->EditValue = $arwrk;
			}

			// ActionName
			$this->ActionName->EditAttrs["class"] = "form-control";
			$this->ActionName->EditCustomAttributes = "";
			if (!$this->ActionName->Raw)
				$this->ActionName->CurrentValue = HtmlDecode($this->ActionName->CurrentValue);
			$this->ActionName->EditValue = HtmlEncode($this->ActionName->CurrentValue);
			$this->ActionName->PlaceHolder = RemoveHtml($this->ActionName->caption());

			// ActionType
			$this->ActionType->EditAttrs["class"] = "form-control";
			$this->ActionType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ActionType->CurrentValue));
			if ($curVal != "")
				$this->ActionType->ViewValue = $this->ActionType->lookupCacheOption($curVal);
			else
				$this->ActionType->ViewValue = $this->ActionType->Lookup !== NULL && is_array($this->ActionType->Lookup->Options) ? $curVal : NULL;
			if ($this->ActionType->ViewValue !== NULL) { // Load from cache
				$this->ActionType->EditValue = array_values($this->ActionType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ActionType`" . SearchString("=", $this->ActionType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ActionType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ActionType->EditValue = $arwrk;
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
				$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());
			}

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->EditAttrs["class"] = "form-control";
			$this->ExpectedAnnualAchievement->EditCustomAttributes = "";
			if (!$this->ExpectedAnnualAchievement->Raw)
				$this->ExpectedAnnualAchievement->CurrentValue = HtmlDecode($this->ExpectedAnnualAchievement->CurrentValue);
			$this->ExpectedAnnualAchievement->EditValue = HtmlEncode($this->ExpectedAnnualAchievement->CurrentValue);
			$this->ExpectedAnnualAchievement->PlaceHolder = RemoveHtml($this->ExpectedAnnualAchievement->caption());

			// ActionLocation
			$this->ActionLocation->EditAttrs["class"] = "form-control";
			$this->ActionLocation->EditCustomAttributes = "";
			if (!$this->ActionLocation->Raw)
				$this->ActionLocation->CurrentValue = HtmlDecode($this->ActionLocation->CurrentValue);
			$this->ActionLocation->EditValue = HtmlEncode($this->ActionLocation->CurrentValue);
			$this->ActionLocation->PlaceHolder = RemoveHtml($this->ActionLocation->caption());

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -2, -2, -2);
			

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -2, -2, -2);
			

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
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// Add refer script
			// ProgramCode

			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// OucomeCode
			$this->OucomeCode->LinkCustomAttributes = "";
			$this->OucomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// ActionName
			$this->ActionName->LinkCustomAttributes = "";
			$this->ActionName->HrefValue = "";

			// ActionType
			$this->ActionType->LinkCustomAttributes = "";
			$this->ActionType->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// ExpectedAnnualAchievement
			$this->ExpectedAnnualAchievement->LinkCustomAttributes = "";
			$this->ExpectedAnnualAchievement->HrefValue = "";

			// ActionLocation
			$this->ActionLocation->LinkCustomAttributes = "";
			$this->ActionLocation->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
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
		if ($this->ProgramCode->Required) {
			if (!$this->ProgramCode->IsDetailKey && $this->ProgramCode->FormValue != NULL && $this->ProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgramCode->caption(), $this->ProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->OucomeCode->Required) {
			if (!$this->OucomeCode->IsDetailKey && $this->OucomeCode->FormValue != NULL && $this->OucomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OucomeCode->caption(), $this->OucomeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OucomeCode->FormValue)) {
			AddMessage($FormError, $this->OucomeCode->errorMessage());
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OutputCode->FormValue)) {
			AddMessage($FormError, $this->OutputCode->errorMessage());
		}
		if ($this->ProjectCode->Required) {
			if (!$this->ProjectCode->IsDetailKey && $this->ProjectCode->FormValue != NULL && $this->ProjectCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectCode->caption(), $this->ProjectCode->RequiredErrorMessage));
			}
		}
		if ($this->ActionName->Required) {
			if (!$this->ActionName->IsDetailKey && $this->ActionName->FormValue != NULL && $this->ActionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionName->caption(), $this->ActionName->RequiredErrorMessage));
			}
		}
		if ($this->ActionType->Required) {
			if (!$this->ActionType->IsDetailKey && $this->ActionType->FormValue != NULL && $this->ActionType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionType->caption(), $this->ActionType->RequiredErrorMessage));
			}
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FinancialYear->FormValue)) {
			AddMessage($FormError, $this->FinancialYear->errorMessage());
		}
		if ($this->ExpectedAnnualAchievement->Required) {
			if (!$this->ExpectedAnnualAchievement->IsDetailKey && $this->ExpectedAnnualAchievement->FormValue != NULL && $this->ExpectedAnnualAchievement->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExpectedAnnualAchievement->caption(), $this->ExpectedAnnualAchievement->RequiredErrorMessage));
			}
		}
		if ($this->ActionLocation->Required) {
			if (!$this->ActionLocation->IsDetailKey && $this->ActionLocation->FormValue != NULL && $this->ActionLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionLocation->caption(), $this->ActionLocation->RequiredErrorMessage));
			}
		}
		if ($this->Latitude->Required) {
			if (!$this->Latitude->IsDetailKey && $this->Latitude->FormValue != NULL && $this->Latitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Latitude->caption(), $this->Latitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Latitude->FormValue)) {
			AddMessage($FormError, $this->Latitude->errorMessage());
		}
		if ($this->Longitude->Required) {
			if (!$this->Longitude->IsDetailKey && $this->Longitude->FormValue != NULL && $this->Longitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Longitude->caption(), $this->Longitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Longitude->FormValue)) {
			AddMessage($FormError, $this->Longitude->errorMessage());
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
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("detailed_action", $detailTblVar) && $GLOBALS["detailed_action"]->DetailAdd) {
			if (!isset($GLOBALS["detailed_action_grid"]))
				$GLOBALS["detailed_action_grid"] = new detailed_action_grid(); // Get detail page object
			$GLOBALS["detailed_action_grid"]->validateGridForm();
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

		// Check referential integrity for master table 'action'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_output();
		if (strval($this->LACode->CurrentValue) != "") {
			$masterFilter = str_replace("@LACode@", AdjustSql($this->LACode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->DepartmentCode->CurrentValue) != "") {
			$masterFilter = str_replace("@DepartmentCode@", AdjustSql($this->DepartmentCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->OucomeCode->CurrentValue) != "") {
			$masterFilter = str_replace("@OutcomeCode@", AdjustSql($this->OucomeCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ProgramCode->CurrentValue) != "") {
			$masterFilter = str_replace("@ProgramCode@", AdjustSql($this->ProgramCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->OutputCode->CurrentValue) != "") {
			$masterFilter = str_replace("@OutputCode@", AdjustSql($this->OutputCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->FinancialYear->CurrentValue) != "") {
			$masterFilter = str_replace("@FinancialYear@", AdjustSql($this->FinancialYear->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["output"]))
				$GLOBALS["output"] = new output();
			$rsmaster = $GLOBALS["output"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "output", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, FALSE);

		// OucomeCode
		$this->OucomeCode->setDbValueDef($rsnew, $this->OucomeCode->CurrentValue, 0, FALSE);

		// OutputCode
		$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, FALSE);

		// ProjectCode
		$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, NULL, FALSE);

		// ActionName
		$this->ActionName->setDbValueDef($rsnew, $this->ActionName->CurrentValue, "", FALSE);

		// ActionType
		$this->ActionType->setDbValueDef($rsnew, $this->ActionType->CurrentValue, "", FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, FALSE);

		// ExpectedAnnualAchievement
		$this->ExpectedAnnualAchievement->setDbValueDef($rsnew, $this->ExpectedAnnualAchievement->CurrentValue, NULL, FALSE);

		// ActionLocation
		$this->ActionLocation->setDbValueDef($rsnew, $this->ActionLocation->CurrentValue, NULL, FALSE);

		// Latitude
		$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, FALSE);

		// Longitude
		$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, 0, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("detailed_action", $detailTblVar) && $GLOBALS["detailed_action"]->DetailAdd) {
				$GLOBALS["detailed_action"]->LACode->setSessionValue($this->LACode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->DepartmentCode->setSessionValue($this->DepartmentCode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->ProgramCode->setSessionValue($this->ProgramCode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->OutcomeCode->setSessionValue($this->OucomeCode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->OutputCode->setSessionValue($this->OutputCode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->ActionCode->setSessionValue($this->ActionCode->CurrentValue); // Set master key
				$GLOBALS["detailed_action"]->FinancialYear->setSessionValue($this->FinancialYear->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailed_action_grid"]))
					$GLOBALS["detailed_action_grid"] = new detailed_action_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailed_action"); // Load user level of detail table
				$addRow = $GLOBALS["detailed_action_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailed_action"]->LACode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->DepartmentCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->ProgramCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->OutcomeCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->OutputCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->ActionCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["detailed_action"]->FinancialYear->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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
			if ($masterTblVar == "output") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["output"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["output"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["output"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["output"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["output"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutcomeCode", Get("OucomeCode"))) !== NULL) {
					$GLOBALS["output"]->OutcomeCode->setQueryStringValue($parm);
					$this->OucomeCode->setQueryStringValue($GLOBALS["output"]->OutcomeCode->QueryStringValue);
					$this->OucomeCode->setSessionValue($this->OucomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["output"]->OutcomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProgramCode", Get("ProgramCode"))) !== NULL) {
					$GLOBALS["output"]->ProgramCode->setQueryStringValue($parm);
					$this->ProgramCode->setQueryStringValue($GLOBALS["output"]->ProgramCode->QueryStringValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["output"]->ProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutputCode", Get("OutputCode"))) !== NULL) {
					$GLOBALS["output"]->OutputCode->setQueryStringValue($parm);
					$this->OutputCode->setQueryStringValue($GLOBALS["output"]->OutputCode->QueryStringValue);
					$this->OutputCode->setSessionValue($this->OutputCode->QueryStringValue);
					if (!is_numeric($GLOBALS["output"]->OutputCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_FinancialYear", Get("FinancialYear"))) !== NULL) {
					$GLOBALS["output"]->FinancialYear->setQueryStringValue($parm);
					$this->FinancialYear->setQueryStringValue($GLOBALS["output"]->FinancialYear->QueryStringValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->QueryStringValue);
					if (!is_numeric($GLOBALS["output"]->FinancialYear->QueryStringValue))
						$validMaster = FALSE;
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
			if ($masterTblVar == "output") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["output"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["output"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["output"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["output"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["output"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutcomeCode", Post("OucomeCode"))) !== NULL) {
					$GLOBALS["output"]->OutcomeCode->setFormValue($parm);
					$this->OucomeCode->setFormValue($GLOBALS["output"]->OutcomeCode->FormValue);
					$this->OucomeCode->setSessionValue($this->OucomeCode->FormValue);
					if (!is_numeric($GLOBALS["output"]->OutcomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProgramCode", Post("ProgramCode"))) !== NULL) {
					$GLOBALS["output"]->ProgramCode->setFormValue($parm);
					$this->ProgramCode->setFormValue($GLOBALS["output"]->ProgramCode->FormValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->FormValue);
					if (!is_numeric($GLOBALS["output"]->ProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutputCode", Post("OutputCode"))) !== NULL) {
					$GLOBALS["output"]->OutputCode->setFormValue($parm);
					$this->OutputCode->setFormValue($GLOBALS["output"]->OutputCode->FormValue);
					$this->OutputCode->setSessionValue($this->OutputCode->FormValue);
					if (!is_numeric($GLOBALS["output"]->OutputCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_FinancialYear", Post("FinancialYear"))) !== NULL) {
					$GLOBALS["output"]->FinancialYear->setFormValue($parm);
					$this->FinancialYear->setFormValue($GLOBALS["output"]->FinancialYear->FormValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->FormValue);
					if (!is_numeric($GLOBALS["output"]->FinancialYear->FormValue))
						$validMaster = FALSE;
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
			if ($masterTblVar != "output") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->OucomeCode->CurrentValue == "")
					$this->OucomeCode->setSessionValue("");
				if ($this->ProgramCode->CurrentValue == "")
					$this->ProgramCode->setSessionValue("");
				if ($this->OutputCode->CurrentValue == "")
					$this->OutputCode->setSessionValue("");
				if ($this->FinancialYear->CurrentValue == "")
					$this->FinancialYear->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
			if (in_array("detailed_action", $detailTblVar)) {
				if (!isset($GLOBALS["detailed_action_grid"]))
					$GLOBALS["detailed_action_grid"] = new detailed_action_grid();
				if ($GLOBALS["detailed_action_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailed_action_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailed_action_grid"]->CurrentMode = "add";
					$GLOBALS["detailed_action_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["detailed_action_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailed_action_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailed_action_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->LACode->setSessionValue($GLOBALS["detailed_action_grid"]->LACode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->DepartmentCode->setSessionValue($GLOBALS["detailed_action_grid"]->DepartmentCode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->ProgramCode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->ProgramCode->CurrentValue = $this->ProgramCode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->ProgramCode->setSessionValue($GLOBALS["detailed_action_grid"]->ProgramCode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->OutcomeCode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->OutcomeCode->CurrentValue = $this->OucomeCode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->OutcomeCode->setSessionValue($GLOBALS["detailed_action_grid"]->OutcomeCode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->OutputCode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->OutputCode->CurrentValue = $this->OutputCode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->OutputCode->setSessionValue($GLOBALS["detailed_action_grid"]->OutputCode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->ActionCode->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->ActionCode->CurrentValue = $this->ActionCode->CurrentValue;
					$GLOBALS["detailed_action_grid"]->ActionCode->setSessionValue($GLOBALS["detailed_action_grid"]->ActionCode->CurrentValue);
					$GLOBALS["detailed_action_grid"]->FinancialYear->IsDetailKey = TRUE;
					$GLOBALS["detailed_action_grid"]->FinancialYear->CurrentValue = $this->FinancialYear->CurrentValue;
					$GLOBALS["detailed_action_grid"]->FinancialYear->setSessionValue($GLOBALS["detailed_action_grid"]->FinancialYear->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_actionlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ProgramCode":
					break;
				case "x_OucomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ProjectCode":
					break;
				case "x_ActionType":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
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
						case "x_ProgramCode":
							break;
						case "x_OucomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ProjectCode":
							break;
						case "x_ActionType":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
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