<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ticketmessage_add extends ticketmessage
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ticketmessage';

	// Page object name
	public $PageObjName = "ticketmessage_add";

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

		// Table object (ticketmessage)
		if (!isset($GLOBALS["ticketmessage"]) || get_class($GLOBALS["ticketmessage"]) == PROJECT_NAMESPACE . "ticketmessage") {
			$GLOBALS["ticketmessage"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticketmessage"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (ticket)
		if (!isset($GLOBALS['ticket']))
			$GLOBALS['ticket'] = new ticket();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticketmessage');

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
		global $ticketmessage;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ticketmessage);
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
					if ($pageName == "ticketmessageview.php")
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
			$key .= @$ar['MessageNumber'];
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
			$this->MessageNumber->Visible = FALSE;
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
					$this->terminate(GetUrl("ticketmessagelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->TicketNumber->setVisibility();
		$this->MessageNumber->Visible = FALSE;
		$this->MessageBy->setVisibility();
		$this->Subject->setVisibility();
		$this->Message->setVisibility();
		$this->MessageDate->setVisibility();
		$this->Attachment->setVisibility();
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
			$this->terminate("ticketmessagelist.php");
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
			if (Get("MessageNumber") !== NULL) {
				$this->MessageNumber->setQueryStringValue(Get("MessageNumber"));
				$this->setKey("MessageNumber", $this->MessageNumber->CurrentValue); // Set up key
			} else {
				$this->setKey("MessageNumber", ""); // Clear key
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
					$this->terminate("ticketmessagelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "ticketmessagelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "ticketmessageview.php")
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
		$this->Attachment->Upload->Index = $CurrentForm->Index;
		$this->Attachment->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->TicketNumber->CurrentValue = NULL;
		$this->TicketNumber->OldValue = $this->TicketNumber->CurrentValue;
		$this->MessageNumber->CurrentValue = NULL;
		$this->MessageNumber->OldValue = $this->MessageNumber->CurrentValue;
		$this->MessageBy->CurrentValue = NULL;
		$this->MessageBy->OldValue = $this->MessageBy->CurrentValue;
		$this->Subject->CurrentValue = NULL;
		$this->Subject->OldValue = $this->Subject->CurrentValue;
		$this->Message->CurrentValue = NULL;
		$this->Message->OldValue = $this->Message->CurrentValue;
		$this->MessageDate->CurrentValue = NULL;
		$this->MessageDate->OldValue = $this->MessageDate->CurrentValue;
		$this->Attachment->Upload->DbValue = NULL;
		$this->Attachment->OldValue = $this->Attachment->Upload->DbValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'TicketNumber' first before field var 'x_TicketNumber'
		$val = $CurrentForm->hasValue("TicketNumber") ? $CurrentForm->getValue("TicketNumber") : $CurrentForm->getValue("x_TicketNumber");
		if (!$this->TicketNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketNumber->Visible = FALSE; // Disable update for API request
			else
				$this->TicketNumber->setFormValue($val);
		}

		// Check field name 'MessageBy' first before field var 'x_MessageBy'
		$val = $CurrentForm->hasValue("MessageBy") ? $CurrentForm->getValue("MessageBy") : $CurrentForm->getValue("x_MessageBy");
		if (!$this->MessageBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MessageBy->Visible = FALSE; // Disable update for API request
			else
				$this->MessageBy->setFormValue($val);
		}

		// Check field name 'Subject' first before field var 'x_Subject'
		$val = $CurrentForm->hasValue("Subject") ? $CurrentForm->getValue("Subject") : $CurrentForm->getValue("x_Subject");
		if (!$this->Subject->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Subject->Visible = FALSE; // Disable update for API request
			else
				$this->Subject->setFormValue($val);
		}

		// Check field name 'Message' first before field var 'x_Message'
		$val = $CurrentForm->hasValue("Message") ? $CurrentForm->getValue("Message") : $CurrentForm->getValue("x_Message");
		if (!$this->Message->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Message->Visible = FALSE; // Disable update for API request
			else
				$this->Message->setFormValue($val);
		}

		// Check field name 'MessageDate' first before field var 'x_MessageDate'
		$val = $CurrentForm->hasValue("MessageDate") ? $CurrentForm->getValue("MessageDate") : $CurrentForm->getValue("x_MessageDate");
		if (!$this->MessageDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MessageDate->Visible = FALSE; // Disable update for API request
			else
				$this->MessageDate->setFormValue($val);
			$this->MessageDate->CurrentValue = UnFormatDateTime($this->MessageDate->CurrentValue, 0);
		}

		// Check field name 'MessageNumber' first before field var 'x_MessageNumber'
		$val = $CurrentForm->hasValue("MessageNumber") ? $CurrentForm->getValue("MessageNumber") : $CurrentForm->getValue("x_MessageNumber");
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->TicketNumber->CurrentValue = $this->TicketNumber->FormValue;
		$this->MessageBy->CurrentValue = $this->MessageBy->FormValue;
		$this->Subject->CurrentValue = $this->Subject->FormValue;
		$this->Message->CurrentValue = $this->Message->FormValue;
		$this->MessageDate->CurrentValue = $this->MessageDate->FormValue;
		$this->MessageDate->CurrentValue = UnFormatDateTime($this->MessageDate->CurrentValue, 0);
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
		$this->TicketNumber->setDbValue($row['TicketNumber']);
		$this->MessageNumber->setDbValue($row['MessageNumber']);
		$this->MessageBy->setDbValue($row['MessageBy']);
		$this->Subject->setDbValue($row['Subject']);
		$this->Message->setDbValue($row['Message']);
		$this->MessageDate->setDbValue($row['MessageDate']);
		$this->Attachment->Upload->DbValue = $row['Attachment'];
		if (is_array($this->Attachment->Upload->DbValue) || is_object($this->Attachment->Upload->DbValue)) // Byte array
			$this->Attachment->Upload->DbValue = BytesToString($this->Attachment->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['TicketNumber'] = $this->TicketNumber->CurrentValue;
		$row['MessageNumber'] = $this->MessageNumber->CurrentValue;
		$row['MessageBy'] = $this->MessageBy->CurrentValue;
		$row['Subject'] = $this->Subject->CurrentValue;
		$row['Message'] = $this->Message->CurrentValue;
		$row['MessageDate'] = $this->MessageDate->CurrentValue;
		$row['Attachment'] = $this->Attachment->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("MessageNumber")) != "")
			$this->MessageNumber->OldValue = $this->getKey("MessageNumber"); // MessageNumber
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
		// TicketNumber
		// MessageNumber
		// MessageBy
		// Subject
		// Message
		// MessageDate
		// Attachment

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// TicketNumber
			$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// MessageNumber
			$this->MessageNumber->ViewValue = $this->MessageNumber->CurrentValue;
			$this->MessageNumber->ViewCustomAttributes = "";

			// MessageBy
			$this->MessageBy->ViewValue = $this->MessageBy->CurrentValue;
			$this->MessageBy->ViewCustomAttributes = "";

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// Message
			$this->Message->ViewValue = $this->Message->CurrentValue;
			$this->Message->ViewCustomAttributes = "";

			// MessageDate
			$this->MessageDate->ViewValue = $this->MessageDate->CurrentValue;
			$this->MessageDate->ViewValue = FormatDateTime($this->MessageDate->ViewValue, 0);
			$this->MessageDate->ViewCustomAttributes = "";

			// Attachment
			if (!EmptyValue($this->Attachment->Upload->DbValue)) {
				$this->Attachment->ViewValue = $this->MessageNumber->CurrentValue;
				$this->Attachment->IsBlobImage = IsImageFile(ContentExtension($this->Attachment->Upload->DbValue));
			} else {
				$this->Attachment->ViewValue = "";
			}
			$this->Attachment->ViewCustomAttributes = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";
			$this->TicketNumber->TooltipValue = "";

			// MessageBy
			$this->MessageBy->LinkCustomAttributes = "";
			$this->MessageBy->HrefValue = "";
			$this->MessageBy->TooltipValue = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";

			// Message
			$this->Message->LinkCustomAttributes = "";
			$this->Message->HrefValue = "";
			$this->Message->TooltipValue = "";

			// MessageDate
			$this->MessageDate->LinkCustomAttributes = "";
			$this->MessageDate->HrefValue = "";
			$this->MessageDate->TooltipValue = "";

			// Attachment
			$this->Attachment->LinkCustomAttributes = "";
			if (!empty($this->Attachment->Upload->DbValue)) {
				$this->Attachment->HrefValue = GetFileUploadUrl($this->Attachment, $this->MessageNumber->CurrentValue);
				$this->Attachment->LinkAttrs["target"] = "";
				if ($this->Attachment->IsBlobImage && empty($this->Attachment->LinkAttrs["target"]))
					$this->Attachment->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Attachment->HrefValue = FullUrl($this->Attachment->HrefValue, "href");
			} else {
				$this->Attachment->HrefValue = "";
			}
			$this->Attachment->ExportHrefValue = GetFileUploadUrl($this->Attachment, $this->MessageNumber->CurrentValue);
			$this->Attachment->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// TicketNumber
			$this->TicketNumber->EditAttrs["class"] = "form-control";
			$this->TicketNumber->EditCustomAttributes = "";
			if ($this->TicketNumber->getSessionValue() != "") {
				$this->TicketNumber->CurrentValue = $this->TicketNumber->getSessionValue();
				$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
				$this->TicketNumber->ViewCustomAttributes = "";
			} else {
				$this->TicketNumber->EditValue = HtmlEncode($this->TicketNumber->CurrentValue);
				$this->TicketNumber->PlaceHolder = RemoveHtml($this->TicketNumber->caption());
			}

			// MessageBy
			$this->MessageBy->EditAttrs["class"] = "form-control";
			$this->MessageBy->EditCustomAttributes = "";
			$this->MessageBy->EditValue = HtmlEncode($this->MessageBy->CurrentValue);
			$this->MessageBy->PlaceHolder = RemoveHtml($this->MessageBy->caption());

			// Subject
			$this->Subject->EditAttrs["class"] = "form-control";
			$this->Subject->EditCustomAttributes = "";
			if (!$this->Subject->Raw)
				$this->Subject->CurrentValue = HtmlDecode($this->Subject->CurrentValue);
			$this->Subject->EditValue = HtmlEncode($this->Subject->CurrentValue);
			$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

			// Message
			$this->Message->EditAttrs["class"] = "form-control";
			$this->Message->EditCustomAttributes = "";
			if (!$this->Message->Raw)
				$this->Message->CurrentValue = HtmlDecode($this->Message->CurrentValue);
			$this->Message->EditValue = HtmlEncode($this->Message->CurrentValue);
			$this->Message->PlaceHolder = RemoveHtml($this->Message->caption());

			// MessageDate
			$this->MessageDate->EditAttrs["class"] = "form-control";
			$this->MessageDate->EditCustomAttributes = "";
			$this->MessageDate->EditValue = HtmlEncode(FormatDateTime($this->MessageDate->CurrentValue, 8));
			$this->MessageDate->PlaceHolder = RemoveHtml($this->MessageDate->caption());

			// Attachment
			$this->Attachment->EditAttrs["class"] = "form-control";
			$this->Attachment->EditCustomAttributes = "";
			if (!EmptyValue($this->Attachment->Upload->DbValue)) {
				$this->Attachment->EditValue = $this->MessageNumber->CurrentValue;
				$this->Attachment->IsBlobImage = IsImageFile(ContentExtension($this->Attachment->Upload->DbValue));
			} else {
				$this->Attachment->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->Attachment);

			// Add refer script
			// TicketNumber

			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";

			// MessageBy
			$this->MessageBy->LinkCustomAttributes = "";
			$this->MessageBy->HrefValue = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";

			// Message
			$this->Message->LinkCustomAttributes = "";
			$this->Message->HrefValue = "";

			// MessageDate
			$this->MessageDate->LinkCustomAttributes = "";
			$this->MessageDate->HrefValue = "";

			// Attachment
			$this->Attachment->LinkCustomAttributes = "";
			if (!empty($this->Attachment->Upload->DbValue)) {
				$this->Attachment->HrefValue = GetFileUploadUrl($this->Attachment, $this->MessageNumber->CurrentValue);
				$this->Attachment->LinkAttrs["target"] = "";
				if ($this->Attachment->IsBlobImage && empty($this->Attachment->LinkAttrs["target"]))
					$this->Attachment->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Attachment->HrefValue = FullUrl($this->Attachment->HrefValue, "href");
			} else {
				$this->Attachment->HrefValue = "";
			}
			$this->Attachment->ExportHrefValue = GetFileUploadUrl($this->Attachment, $this->MessageNumber->CurrentValue);
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
		if ($this->TicketNumber->Required) {
			if (!$this->TicketNumber->IsDetailKey && $this->TicketNumber->FormValue != NULL && $this->TicketNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketNumber->caption(), $this->TicketNumber->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TicketNumber->FormValue)) {
			AddMessage($FormError, $this->TicketNumber->errorMessage());
		}
		if ($this->MessageBy->Required) {
			if (!$this->MessageBy->IsDetailKey && $this->MessageBy->FormValue != NULL && $this->MessageBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MessageBy->caption(), $this->MessageBy->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->MessageBy->FormValue)) {
			AddMessage($FormError, $this->MessageBy->errorMessage());
		}
		if ($this->Subject->Required) {
			if (!$this->Subject->IsDetailKey && $this->Subject->FormValue != NULL && $this->Subject->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Subject->caption(), $this->Subject->RequiredErrorMessage));
			}
		}
		if ($this->Message->Required) {
			if (!$this->Message->IsDetailKey && $this->Message->FormValue != NULL && $this->Message->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Message->caption(), $this->Message->RequiredErrorMessage));
			}
		}
		if ($this->MessageDate->Required) {
			if (!$this->MessageDate->IsDetailKey && $this->MessageDate->FormValue != NULL && $this->MessageDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MessageDate->caption(), $this->MessageDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->MessageDate->FormValue)) {
			AddMessage($FormError, $this->MessageDate->errorMessage());
		}
		if ($this->Attachment->Required) {
			if ($this->Attachment->Upload->FileName == "" && !$this->Attachment->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Attachment->caption(), $this->Attachment->RequiredErrorMessage));
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

		// TicketNumber
		$this->TicketNumber->setDbValueDef($rsnew, $this->TicketNumber->CurrentValue, NULL, FALSE);

		// MessageBy
		$this->MessageBy->setDbValueDef($rsnew, $this->MessageBy->CurrentValue, NULL, FALSE);

		// Subject
		$this->Subject->setDbValueDef($rsnew, $this->Subject->CurrentValue, NULL, FALSE);

		// Message
		$this->Message->setDbValueDef($rsnew, $this->Message->CurrentValue, NULL, FALSE);

		// MessageDate
		$this->MessageDate->setDbValueDef($rsnew, UnFormatDateTime($this->MessageDate->CurrentValue, 0), NULL, FALSE);

		// Attachment
		if ($this->Attachment->Visible && !$this->Attachment->Upload->KeepFile) {
			if ($this->Attachment->Upload->Value == NULL) {
				$rsnew['Attachment'] = NULL;
			} else {
				$rsnew['Attachment'] = $this->Attachment->Upload->Value;
			}
		}

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

			// Attachment
			CleanUploadTempPath($this->Attachment, $this->Attachment->Upload->Index);
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
			if ($masterTblVar == "ticket") {
				$validMaster = TRUE;
				if (($parm = Get("fk_TicketNumber", Get("TicketNumber"))) !== NULL) {
					$GLOBALS["ticket"]->TicketNumber->setQueryStringValue($parm);
					$this->TicketNumber->setQueryStringValue($GLOBALS["ticket"]->TicketNumber->QueryStringValue);
					$this->TicketNumber->setSessionValue($this->TicketNumber->QueryStringValue);
					if (!is_numeric($GLOBALS["ticket"]->TicketNumber->QueryStringValue))
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
			if ($masterTblVar == "ticket") {
				$validMaster = TRUE;
				if (($parm = Post("fk_TicketNumber", Post("TicketNumber"))) !== NULL) {
					$GLOBALS["ticket"]->TicketNumber->setFormValue($parm);
					$this->TicketNumber->setFormValue($GLOBALS["ticket"]->TicketNumber->FormValue);
					$this->TicketNumber->setSessionValue($this->TicketNumber->FormValue);
					if (!is_numeric($GLOBALS["ticket"]->TicketNumber->FormValue))
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
			if ($masterTblVar != "ticket") {
				if ($this->TicketNumber->CurrentValue == "")
					$this->TicketNumber->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ticketmessagelist.php"), "", $this->TableVar, TRUE);
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