<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class board_zone_add extends board_zone
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'board_zone';

	// Page object name
	public $PageObjName = "board_zone_add";

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

		// Table object (board_zone)
		if (!isset($GLOBALS["board_zone"]) || get_class($GLOBALS["board_zone"]) == PROJECT_NAMESPACE . "board_zone") {
			$GLOBALS["board_zone"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["board_zone"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'board_zone');

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
		global $board_zone;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($board_zone);
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
					if ($pageName == "board_zoneview.php")
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
			$key .= @$ar['BoardZone'];
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
			$this->BoardZone->Visible = FALSE;
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
					$this->terminate(GetUrl("board_zonelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->BoardZone->Visible = FALSE;
		$this->BoardZoneDesc->setVisibility();
		$this->IndividualCharge->setVisibility();
		$this->AgentCharge->setVisibility();
		$this->PeriodType->setVisibility();
		$this->BoardType->setVisibility();
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
		$this->setupLookupOptions($this->PeriodType);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("board_zonelist.php");
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
			if (Get("BoardZone") !== NULL) {
				$this->BoardZone->setQueryStringValue(Get("BoardZone"));
				$this->setKey("BoardZone", $this->BoardZone->CurrentValue); // Set up key
			} else {
				$this->setKey("BoardZone", ""); // Clear key
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
					$this->terminate("board_zonelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "board_zonelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "board_zoneview.php")
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
		$this->BoardZone->CurrentValue = NULL;
		$this->BoardZone->OldValue = $this->BoardZone->CurrentValue;
		$this->BoardZoneDesc->CurrentValue = NULL;
		$this->BoardZoneDesc->OldValue = $this->BoardZoneDesc->CurrentValue;
		$this->IndividualCharge->CurrentValue = NULL;
		$this->IndividualCharge->OldValue = $this->IndividualCharge->CurrentValue;
		$this->AgentCharge->CurrentValue = NULL;
		$this->AgentCharge->OldValue = $this->AgentCharge->CurrentValue;
		$this->PeriodType->CurrentValue = NULL;
		$this->PeriodType->OldValue = $this->PeriodType->CurrentValue;
		$this->BoardType->CurrentValue = NULL;
		$this->BoardType->OldValue = $this->BoardType->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'BoardZoneDesc' first before field var 'x_BoardZoneDesc'
		$val = $CurrentForm->hasValue("BoardZoneDesc") ? $CurrentForm->getValue("BoardZoneDesc") : $CurrentForm->getValue("x_BoardZoneDesc");
		if (!$this->BoardZoneDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardZoneDesc->Visible = FALSE; // Disable update for API request
			else
				$this->BoardZoneDesc->setFormValue($val);
		}

		// Check field name 'IndividualCharge' first before field var 'x_IndividualCharge'
		$val = $CurrentForm->hasValue("IndividualCharge") ? $CurrentForm->getValue("IndividualCharge") : $CurrentForm->getValue("x_IndividualCharge");
		if (!$this->IndividualCharge->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IndividualCharge->Visible = FALSE; // Disable update for API request
			else
				$this->IndividualCharge->setFormValue($val);
		}

		// Check field name 'AgentCharge' first before field var 'x_AgentCharge'
		$val = $CurrentForm->hasValue("AgentCharge") ? $CurrentForm->getValue("AgentCharge") : $CurrentForm->getValue("x_AgentCharge");
		if (!$this->AgentCharge->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AgentCharge->Visible = FALSE; // Disable update for API request
			else
				$this->AgentCharge->setFormValue($val);
		}

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}

		// Check field name 'BoardType' first before field var 'x_BoardType'
		$val = $CurrentForm->hasValue("BoardType") ? $CurrentForm->getValue("BoardType") : $CurrentForm->getValue("x_BoardType");
		if (!$this->BoardType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardType->Visible = FALSE; // Disable update for API request
			else
				$this->BoardType->setFormValue($val);
		}

		// Check field name 'BoardZone' first before field var 'x_BoardZone'
		$val = $CurrentForm->hasValue("BoardZone") ? $CurrentForm->getValue("BoardZone") : $CurrentForm->getValue("x_BoardZone");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->BoardZoneDesc->CurrentValue = $this->BoardZoneDesc->FormValue;
		$this->IndividualCharge->CurrentValue = $this->IndividualCharge->FormValue;
		$this->AgentCharge->CurrentValue = $this->AgentCharge->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->BoardType->CurrentValue = $this->BoardType->FormValue;
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
		$this->BoardZone->setDbValue($row['BoardZone']);
		$this->BoardZoneDesc->setDbValue($row['BoardZoneDesc']);
		$this->IndividualCharge->setDbValue($row['IndividualCharge']);
		$this->AgentCharge->setDbValue($row['AgentCharge']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->BoardType->setDbValue($row['BoardType']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['BoardZone'] = $this->BoardZone->CurrentValue;
		$row['BoardZoneDesc'] = $this->BoardZoneDesc->CurrentValue;
		$row['IndividualCharge'] = $this->IndividualCharge->CurrentValue;
		$row['AgentCharge'] = $this->AgentCharge->CurrentValue;
		$row['PeriodType'] = $this->PeriodType->CurrentValue;
		$row['BoardType'] = $this->BoardType->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BoardZone")) != "")
			$this->BoardZone->OldValue = $this->getKey("BoardZone"); // BoardZone
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

		if ($this->IndividualCharge->FormValue == $this->IndividualCharge->CurrentValue && is_numeric(ConvertToFloatString($this->IndividualCharge->CurrentValue)))
			$this->IndividualCharge->CurrentValue = ConvertToFloatString($this->IndividualCharge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AgentCharge->FormValue == $this->AgentCharge->CurrentValue && is_numeric(ConvertToFloatString($this->AgentCharge->CurrentValue)))
			$this->AgentCharge->CurrentValue = ConvertToFloatString($this->AgentCharge->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// BoardZone
		// BoardZoneDesc
		// IndividualCharge
		// AgentCharge
		// PeriodType
		// BoardType

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// BoardZone
			$this->BoardZone->ViewValue = $this->BoardZone->CurrentValue;
			$this->BoardZone->ViewCustomAttributes = "";

			// BoardZoneDesc
			$this->BoardZoneDesc->ViewValue = $this->BoardZoneDesc->CurrentValue;
			$this->BoardZoneDesc->ViewCustomAttributes = "";

			// IndividualCharge
			$this->IndividualCharge->ViewValue = $this->IndividualCharge->CurrentValue;
			$this->IndividualCharge->ViewValue = FormatNumber($this->IndividualCharge->ViewValue, 2, -2, -2, -2);
			$this->IndividualCharge->CellCssStyle .= "text-align: right;";
			$this->IndividualCharge->ViewCustomAttributes = "";

			// AgentCharge
			$this->AgentCharge->ViewValue = $this->AgentCharge->CurrentValue;
			$this->AgentCharge->ViewValue = FormatNumber($this->AgentCharge->ViewValue, 2, -2, -2, -2);
			$this->AgentCharge->CellCssStyle .= "text-align: right;";
			$this->AgentCharge->ViewCustomAttributes = "";

			// PeriodType
			$curVal = strval($this->PeriodType->CurrentValue);
			if ($curVal != "") {
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
				if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
					}
				}
			} else {
				$this->PeriodType->ViewValue = NULL;
			}
			$this->PeriodType->ViewCustomAttributes = "";

			// BoardType
			$this->BoardType->ViewValue = $this->BoardType->CurrentValue;
			$this->BoardType->ViewCustomAttributes = "";

			// BoardZoneDesc
			$this->BoardZoneDesc->LinkCustomAttributes = "";
			$this->BoardZoneDesc->HrefValue = "";
			$this->BoardZoneDesc->TooltipValue = "";

			// IndividualCharge
			$this->IndividualCharge->LinkCustomAttributes = "";
			$this->IndividualCharge->HrefValue = "";
			$this->IndividualCharge->TooltipValue = "";

			// AgentCharge
			$this->AgentCharge->LinkCustomAttributes = "";
			$this->AgentCharge->HrefValue = "";
			$this->AgentCharge->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";
			$this->BoardType->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// BoardZoneDesc
			$this->BoardZoneDesc->EditAttrs["class"] = "form-control";
			$this->BoardZoneDesc->EditCustomAttributes = "";
			if (!$this->BoardZoneDesc->Raw)
				$this->BoardZoneDesc->CurrentValue = HtmlDecode($this->BoardZoneDesc->CurrentValue);
			$this->BoardZoneDesc->EditValue = HtmlEncode($this->BoardZoneDesc->CurrentValue);
			$this->BoardZoneDesc->PlaceHolder = RemoveHtml($this->BoardZoneDesc->caption());

			// IndividualCharge
			$this->IndividualCharge->EditAttrs["class"] = "form-control";
			$this->IndividualCharge->EditCustomAttributes = "";
			$this->IndividualCharge->EditValue = HtmlEncode($this->IndividualCharge->CurrentValue);
			$this->IndividualCharge->PlaceHolder = RemoveHtml($this->IndividualCharge->caption());
			if (strval($this->IndividualCharge->EditValue) != "" && is_numeric($this->IndividualCharge->EditValue))
				$this->IndividualCharge->EditValue = FormatNumber($this->IndividualCharge->EditValue, -2, -2, -2, -2);
			

			// AgentCharge
			$this->AgentCharge->EditAttrs["class"] = "form-control";
			$this->AgentCharge->EditCustomAttributes = "";
			$this->AgentCharge->EditValue = HtmlEncode($this->AgentCharge->CurrentValue);
			$this->AgentCharge->PlaceHolder = RemoveHtml($this->AgentCharge->caption());
			if (strval($this->AgentCharge->EditValue) != "" && is_numeric($this->AgentCharge->EditValue))
				$this->AgentCharge->EditValue = FormatNumber($this->AgentCharge->EditValue, -2, -2, -2, -2);
			

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->CurrentValue));
			if ($curVal != "")
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// BoardType
			$this->BoardType->EditAttrs["class"] = "form-control";
			$this->BoardType->EditCustomAttributes = "";
			$this->BoardType->EditValue = HtmlEncode($this->BoardType->CurrentValue);
			$this->BoardType->PlaceHolder = RemoveHtml($this->BoardType->caption());

			// Add refer script
			// BoardZoneDesc

			$this->BoardZoneDesc->LinkCustomAttributes = "";
			$this->BoardZoneDesc->HrefValue = "";

			// IndividualCharge
			$this->IndividualCharge->LinkCustomAttributes = "";
			$this->IndividualCharge->HrefValue = "";

			// AgentCharge
			$this->AgentCharge->LinkCustomAttributes = "";
			$this->AgentCharge->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";
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
		if ($this->BoardZoneDesc->Required) {
			if (!$this->BoardZoneDesc->IsDetailKey && $this->BoardZoneDesc->FormValue != NULL && $this->BoardZoneDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardZoneDesc->caption(), $this->BoardZoneDesc->RequiredErrorMessage));
			}
		}
		if ($this->IndividualCharge->Required) {
			if (!$this->IndividualCharge->IsDetailKey && $this->IndividualCharge->FormValue != NULL && $this->IndividualCharge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IndividualCharge->caption(), $this->IndividualCharge->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->IndividualCharge->FormValue)) {
			AddMessage($FormError, $this->IndividualCharge->errorMessage());
		}
		if ($this->AgentCharge->Required) {
			if (!$this->AgentCharge->IsDetailKey && $this->AgentCharge->FormValue != NULL && $this->AgentCharge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AgentCharge->caption(), $this->AgentCharge->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AgentCharge->FormValue)) {
			AddMessage($FormError, $this->AgentCharge->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if ($this->BoardType->Required) {
			if (!$this->BoardType->IsDetailKey && $this->BoardType->FormValue != NULL && $this->BoardType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardType->caption(), $this->BoardType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BoardType->FormValue)) {
			AddMessage($FormError, $this->BoardType->errorMessage());
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

		// BoardZoneDesc
		$this->BoardZoneDesc->setDbValueDef($rsnew, $this->BoardZoneDesc->CurrentValue, "", FALSE);

		// IndividualCharge
		$this->IndividualCharge->setDbValueDef($rsnew, $this->IndividualCharge->CurrentValue, NULL, FALSE);

		// AgentCharge
		$this->AgentCharge->setDbValueDef($rsnew, $this->AgentCharge->CurrentValue, NULL, FALSE);

		// PeriodType
		$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, FALSE);

		// BoardType
		$this->BoardType->setDbValueDef($rsnew, $this->BoardType->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("board_zonelist.php"), "", $this->TableVar, TRUE);
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
				case "x_PeriodType":
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
						case "x_PeriodType":
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