<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipt_header_reverse_add extends receipt_header_reverse
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipt_header_reverse';

	// Page object name
	public $PageObjName = "receipt_header_reverse_add";

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

		// Table object (receipt_header_reverse)
		if (!isset($GLOBALS["receipt_header_reverse"]) || get_class($GLOBALS["receipt_header_reverse"]) == PROJECT_NAMESPACE . "receipt_header_reverse") {
			$GLOBALS["receipt_header_reverse"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipt_header_reverse"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipt_header_reverse');

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
		global $receipt_header_reverse;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipt_header_reverse);
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
					if ($pageName == "receipt_header_reverseview.php")
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
			$key .= @$ar['ReversalRef'];
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
			$this->ReversalRef->Visible = FALSE;
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
					$this->terminate(GetUrl("receipt_header_reverselist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ReceiptNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->PaidBy->setVisibility();
		$this->ClientPostalAddress->setVisibility();
		$this->ClientPhysicalAddress->setVisibility();
		$this->ClientEmail->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->ReceiptPrefix->setVisibility();
		$this->AccountBased->setVisibility();
		$this->Cashier->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->TotalDue->setVisibility();
		$this->AmountTendered->setVisibility();
		$this->Change->setVisibility();
		$this->ClientMessage->setVisibility();
		$this->Reasons->setVisibility();
		$this->ReversalRef->Visible = FALSE;
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
		$this->setupLookupOptions($this->ReceiptNo);
		$this->setupLookupOptions($this->ClientSerNo);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("receipt_header_reverselist.php");
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
			if (Get("ReversalRef") !== NULL) {
				$this->ReversalRef->setQueryStringValue(Get("ReversalRef"));
				$this->setKey("ReversalRef", $this->ReversalRef->CurrentValue); // Set up key
			} else {
				$this->setKey("ReversalRef", ""); // Clear key
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
					$this->terminate("receipt_header_reverselist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "receipt_header_reverselist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "receipt_header_reverseview.php")
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
		$this->ReceiptNo->CurrentValue = 0;
		$this->ClientSerNo->CurrentValue = NULL;
		$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->PaidBy->CurrentValue = NULL;
		$this->PaidBy->OldValue = $this->PaidBy->CurrentValue;
		$this->ClientPostalAddress->CurrentValue = NULL;
		$this->ClientPostalAddress->OldValue = $this->ClientPostalAddress->CurrentValue;
		$this->ClientPhysicalAddress->CurrentValue = NULL;
		$this->ClientPhysicalAddress->OldValue = $this->ClientPhysicalAddress->CurrentValue;
		$this->ClientEmail->CurrentValue = NULL;
		$this->ClientEmail->OldValue = $this->ClientEmail->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->ReceiptPrefix->CurrentValue = NULL;
		$this->ReceiptPrefix->OldValue = $this->ReceiptPrefix->CurrentValue;
		$this->AccountBased->CurrentValue = NULL;
		$this->AccountBased->OldValue = $this->AccountBased->CurrentValue;
		$this->Cashier->CurrentValue = NULL;
		$this->Cashier->OldValue = $this->Cashier->CurrentValue;
		$this->ReceiptDate->CurrentValue = NULL;
		$this->ReceiptDate->OldValue = $this->ReceiptDate->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->TotalDue->CurrentValue = NULL;
		$this->TotalDue->OldValue = $this->TotalDue->CurrentValue;
		$this->AmountTendered->CurrentValue = 0;
		$this->Change->CurrentValue = 0;
		$this->ClientMessage->CurrentValue = NULL;
		$this->ClientMessage->OldValue = $this->ClientMessage->CurrentValue;
		$this->Reasons->CurrentValue = NULL;
		$this->Reasons->OldValue = $this->Reasons->CurrentValue;
		$this->ReversalRef->CurrentValue = NULL;
		$this->ReversalRef->OldValue = $this->ReversalRef->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ReceiptNo' first before field var 'x_ReceiptNo'
		$val = $CurrentForm->hasValue("ReceiptNo") ? $CurrentForm->getValue("ReceiptNo") : $CurrentForm->getValue("x_ReceiptNo");
		if (!$this->ReceiptNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptNo->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptNo->setFormValue($val);
		}

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'PaidBy' first before field var 'x_PaidBy'
		$val = $CurrentForm->hasValue("PaidBy") ? $CurrentForm->getValue("PaidBy") : $CurrentForm->getValue("x_PaidBy");
		if (!$this->PaidBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaidBy->Visible = FALSE; // Disable update for API request
			else
				$this->PaidBy->setFormValue($val);
		}

		// Check field name 'ClientPostalAddress' first before field var 'x_ClientPostalAddress'
		$val = $CurrentForm->hasValue("ClientPostalAddress") ? $CurrentForm->getValue("ClientPostalAddress") : $CurrentForm->getValue("x_ClientPostalAddress");
		if (!$this->ClientPostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientPostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->ClientPostalAddress->setFormValue($val);
		}

		// Check field name 'ClientPhysicalAddress' first before field var 'x_ClientPhysicalAddress'
		$val = $CurrentForm->hasValue("ClientPhysicalAddress") ? $CurrentForm->getValue("ClientPhysicalAddress") : $CurrentForm->getValue("x_ClientPhysicalAddress");
		if (!$this->ClientPhysicalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientPhysicalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->ClientPhysicalAddress->setFormValue($val);
		}

		// Check field name 'ClientEmail' first before field var 'x_ClientEmail'
		$val = $CurrentForm->hasValue("ClientEmail") ? $CurrentForm->getValue("ClientEmail") : $CurrentForm->getValue("x_ClientEmail");
		if (!$this->ClientEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientEmail->Visible = FALSE; // Disable update for API request
			else
				$this->ClientEmail->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'ReceiptPrefix' first before field var 'x_ReceiptPrefix'
		$val = $CurrentForm->hasValue("ReceiptPrefix") ? $CurrentForm->getValue("ReceiptPrefix") : $CurrentForm->getValue("x_ReceiptPrefix");
		if (!$this->ReceiptPrefix->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptPrefix->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptPrefix->setFormValue($val);
		}

		// Check field name 'AccountBased' first before field var 'x_AccountBased'
		$val = $CurrentForm->hasValue("AccountBased") ? $CurrentForm->getValue("AccountBased") : $CurrentForm->getValue("x_AccountBased");
		if (!$this->AccountBased->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountBased->Visible = FALSE; // Disable update for API request
			else
				$this->AccountBased->setFormValue($val);
		}

		// Check field name 'Cashier' first before field var 'x_Cashier'
		$val = $CurrentForm->hasValue("Cashier") ? $CurrentForm->getValue("Cashier") : $CurrentForm->getValue("x_Cashier");
		if (!$this->Cashier->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Cashier->Visible = FALSE; // Disable update for API request
			else
				$this->Cashier->setFormValue($val);
		}

		// Check field name 'ReceiptDate' first before field var 'x_ReceiptDate'
		$val = $CurrentForm->hasValue("ReceiptDate") ? $CurrentForm->getValue("ReceiptDate") : $CurrentForm->getValue("x_ReceiptDate");
		if (!$this->ReceiptDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptDate->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptDate->setFormValue($val);
			$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 0);
		}

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}

		// Check field name 'TotalDue' first before field var 'x_TotalDue'
		$val = $CurrentForm->hasValue("TotalDue") ? $CurrentForm->getValue("TotalDue") : $CurrentForm->getValue("x_TotalDue");
		if (!$this->TotalDue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TotalDue->Visible = FALSE; // Disable update for API request
			else
				$this->TotalDue->setFormValue($val);
		}

		// Check field name 'AmountTendered' first before field var 'x_AmountTendered'
		$val = $CurrentForm->hasValue("AmountTendered") ? $CurrentForm->getValue("AmountTendered") : $CurrentForm->getValue("x_AmountTendered");
		if (!$this->AmountTendered->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountTendered->Visible = FALSE; // Disable update for API request
			else
				$this->AmountTendered->setFormValue($val);
		}

		// Check field name 'Change' first before field var 'x_Change'
		$val = $CurrentForm->hasValue("Change") ? $CurrentForm->getValue("Change") : $CurrentForm->getValue("x_Change");
		if (!$this->Change->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Change->Visible = FALSE; // Disable update for API request
			else
				$this->Change->setFormValue($val);
		}

		// Check field name 'ClientMessage' first before field var 'x_ClientMessage'
		$val = $CurrentForm->hasValue("ClientMessage") ? $CurrentForm->getValue("ClientMessage") : $CurrentForm->getValue("x_ClientMessage");
		if (!$this->ClientMessage->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientMessage->Visible = FALSE; // Disable update for API request
			else
				$this->ClientMessage->setFormValue($val);
		}

		// Check field name 'Reasons' first before field var 'x_Reasons'
		$val = $CurrentForm->hasValue("Reasons") ? $CurrentForm->getValue("Reasons") : $CurrentForm->getValue("x_Reasons");
		if (!$this->Reasons->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Reasons->Visible = FALSE; // Disable update for API request
			else
				$this->Reasons->setFormValue($val);
		}

		// Check field name 'ReversalRef' first before field var 'x_ReversalRef'
		$val = $CurrentForm->hasValue("ReversalRef") ? $CurrentForm->getValue("ReversalRef") : $CurrentForm->getValue("x_ReversalRef");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ReceiptNo->CurrentValue = $this->ReceiptNo->FormValue;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->PaidBy->CurrentValue = $this->PaidBy->FormValue;
		$this->ClientPostalAddress->CurrentValue = $this->ClientPostalAddress->FormValue;
		$this->ClientPhysicalAddress->CurrentValue = $this->ClientPhysicalAddress->FormValue;
		$this->ClientEmail->CurrentValue = $this->ClientEmail->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->ReceiptPrefix->CurrentValue = $this->ReceiptPrefix->FormValue;
		$this->AccountBased->CurrentValue = $this->AccountBased->FormValue;
		$this->Cashier->CurrentValue = $this->Cashier->FormValue;
		$this->ReceiptDate->CurrentValue = $this->ReceiptDate->FormValue;
		$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 0);
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->TotalDue->CurrentValue = $this->TotalDue->FormValue;
		$this->AmountTendered->CurrentValue = $this->AmountTendered->FormValue;
		$this->Change->CurrentValue = $this->Change->FormValue;
		$this->ClientMessage->CurrentValue = $this->ClientMessage->FormValue;
		$this->Reasons->CurrentValue = $this->Reasons->FormValue;
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
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PaidBy->setDbValue($row['PaidBy']);
		$this->ClientPostalAddress->setDbValue($row['ClientPostalAddress']);
		$this->ClientPhysicalAddress->setDbValue($row['ClientPhysicalAddress']);
		$this->ClientEmail->setDbValue($row['ClientEmail']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->ReceiptPrefix->setDbValue($row['ReceiptPrefix']);
		$this->AccountBased->setDbValue($row['AccountBased']);
		$this->Cashier->setDbValue($row['Cashier']);
		$this->ReceiptDate->setDbValue($row['ReceiptDate']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->TotalDue->setDbValue($row['TotalDue']);
		$this->AmountTendered->setDbValue($row['AmountTendered']);
		$this->Change->setDbValue($row['Change']);
		$this->ClientMessage->setDbValue($row['ClientMessage']);
		$this->Reasons->setDbValue($row['Reasons']);
		$this->ReversalRef->setDbValue($row['ReversalRef']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ReceiptNo'] = $this->ReceiptNo->CurrentValue;
		$row['ClientSerNo'] = $this->ClientSerNo->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['PaidBy'] = $this->PaidBy->CurrentValue;
		$row['ClientPostalAddress'] = $this->ClientPostalAddress->CurrentValue;
		$row['ClientPhysicalAddress'] = $this->ClientPhysicalAddress->CurrentValue;
		$row['ClientEmail'] = $this->ClientEmail->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['ReceiptPrefix'] = $this->ReceiptPrefix->CurrentValue;
		$row['AccountBased'] = $this->AccountBased->CurrentValue;
		$row['Cashier'] = $this->Cashier->CurrentValue;
		$row['ReceiptDate'] = $this->ReceiptDate->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['TotalDue'] = $this->TotalDue->CurrentValue;
		$row['AmountTendered'] = $this->AmountTendered->CurrentValue;
		$row['Change'] = $this->Change->CurrentValue;
		$row['ClientMessage'] = $this->ClientMessage->CurrentValue;
		$row['Reasons'] = $this->Reasons->CurrentValue;
		$row['ReversalRef'] = $this->ReversalRef->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ReversalRef")) != "")
			$this->ReversalRef->OldValue = $this->getKey("ReversalRef"); // ReversalRef
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

		if ($this->TotalDue->FormValue == $this->TotalDue->CurrentValue && is_numeric(ConvertToFloatString($this->TotalDue->CurrentValue)))
			$this->TotalDue->CurrentValue = ConvertToFloatString($this->TotalDue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountTendered->FormValue == $this->AmountTendered->CurrentValue && is_numeric(ConvertToFloatString($this->AmountTendered->CurrentValue)))
			$this->AmountTendered->CurrentValue = ConvertToFloatString($this->AmountTendered->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Change->FormValue == $this->Change->CurrentValue && is_numeric(ConvertToFloatString($this->Change->CurrentValue)))
			$this->Change->CurrentValue = ConvertToFloatString($this->Change->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ReceiptNo
		// ClientSerNo
		// ClientID
		// PaidBy
		// ClientPostalAddress
		// ClientPhysicalAddress
		// ClientEmail
		// ChargeGroup
		// ReceiptPrefix
		// AccountBased
		// Cashier
		// ReceiptDate
		// PaymentMethod
		// TotalDue
		// AmountTendered
		// Change
		// ClientMessage
		// Reasons
		// ReversalRef

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$curVal = strval($this->ReceiptNo->CurrentValue);
			if ($curVal != "") {
				$this->ReceiptNo->ViewValue = $this->ReceiptNo->lookupCacheOption($curVal);
				if ($this->ReceiptNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ReceiptNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReceiptNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 7);
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReceiptNo->ViewValue = $this->ReceiptNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
					}
				}
			} else {
				$this->ReceiptNo->ViewValue = NULL;
			}
			$this->ReceiptNo->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
					}
				}
			} else {
				$this->ClientSerNo->ViewValue = NULL;
			}
			$this->ClientSerNo->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// PaidBy
			$this->PaidBy->ViewValue = $this->PaidBy->CurrentValue;
			$this->PaidBy->ViewCustomAttributes = "";

			// ClientPostalAddress
			$this->ClientPostalAddress->ViewValue = $this->ClientPostalAddress->CurrentValue;
			$this->ClientPostalAddress->ViewCustomAttributes = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->ViewValue = $this->ClientPhysicalAddress->CurrentValue;
			$this->ClientPhysicalAddress->ViewCustomAttributes = "";

			// ClientEmail
			$this->ClientEmail->ViewValue = $this->ClientEmail->CurrentValue;
			$this->ClientEmail->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->ViewValue = $this->ReceiptPrefix->CurrentValue;
			$this->ReceiptPrefix->ViewCustomAttributes = "";

			// AccountBased
			if (ConvertToBool($this->AccountBased->CurrentValue)) {
				$this->AccountBased->ViewValue = $this->AccountBased->tagCaption(1) != "" ? $this->AccountBased->tagCaption(1) : "Yes";
			} else {
				$this->AccountBased->ViewValue = $this->AccountBased->tagCaption(2) != "" ? $this->AccountBased->tagCaption(2) : "No";
			}
			$this->AccountBased->ViewCustomAttributes = "";

			// Cashier
			$this->Cashier->ViewValue = $this->Cashier->CurrentValue;
			$this->Cashier->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 0);
			$this->ReceiptDate->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$this->PaymentMethod->ViewCustomAttributes = "";

			// TotalDue
			$this->TotalDue->ViewValue = $this->TotalDue->CurrentValue;
			$this->TotalDue->ViewValue = FormatNumber($this->TotalDue->ViewValue, 2, -2, -2, -2);
			$this->TotalDue->ViewCustomAttributes = "";

			// AmountTendered
			$this->AmountTendered->ViewValue = $this->AmountTendered->CurrentValue;
			$this->AmountTendered->ViewValue = FormatNumber($this->AmountTendered->ViewValue, 2, -2, -2, -2);
			$this->AmountTendered->ViewCustomAttributes = "";

			// Change
			$this->Change->ViewValue = $this->Change->CurrentValue;
			$this->Change->ViewValue = FormatNumber($this->Change->ViewValue, 2, -2, -2, -2);
			$this->Change->ViewCustomAttributes = "";

			// ClientMessage
			$this->ClientMessage->ViewValue = $this->ClientMessage->CurrentValue;
			$this->ClientMessage->ViewCustomAttributes = "";

			// Reasons
			$this->Reasons->ViewValue = $this->Reasons->CurrentValue;
			$this->Reasons->ViewCustomAttributes = "";

			// ReversalRef
			$this->ReversalRef->ViewValue = $this->ReversalRef->CurrentValue;
			$this->ReversalRef->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// PaidBy
			$this->PaidBy->LinkCustomAttributes = "";
			$this->PaidBy->HrefValue = "";
			$this->PaidBy->TooltipValue = "";

			// ClientPostalAddress
			$this->ClientPostalAddress->LinkCustomAttributes = "";
			$this->ClientPostalAddress->HrefValue = "";
			$this->ClientPostalAddress->TooltipValue = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->LinkCustomAttributes = "";
			$this->ClientPhysicalAddress->HrefValue = "";
			$this->ClientPhysicalAddress->TooltipValue = "";

			// ClientEmail
			$this->ClientEmail->LinkCustomAttributes = "";
			$this->ClientEmail->HrefValue = "";
			$this->ClientEmail->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->LinkCustomAttributes = "";
			$this->ReceiptPrefix->HrefValue = "";
			$this->ReceiptPrefix->TooltipValue = "";

			// AccountBased
			$this->AccountBased->LinkCustomAttributes = "";
			$this->AccountBased->HrefValue = "";
			$this->AccountBased->TooltipValue = "";

			// Cashier
			$this->Cashier->LinkCustomAttributes = "";
			$this->Cashier->HrefValue = "";
			$this->Cashier->TooltipValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// TotalDue
			$this->TotalDue->LinkCustomAttributes = "";
			$this->TotalDue->HrefValue = "";
			$this->TotalDue->TooltipValue = "";

			// AmountTendered
			$this->AmountTendered->LinkCustomAttributes = "";
			$this->AmountTendered->HrefValue = "";
			$this->AmountTendered->TooltipValue = "";

			// Change
			$this->Change->LinkCustomAttributes = "";
			$this->Change->HrefValue = "";
			$this->Change->TooltipValue = "";

			// ClientMessage
			$this->ClientMessage->LinkCustomAttributes = "";
			$this->ClientMessage->HrefValue = "";
			$this->ClientMessage->TooltipValue = "";

			// Reasons
			$this->Reasons->LinkCustomAttributes = "";
			$this->Reasons->HrefValue = "";
			$this->Reasons->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
			$curVal = strval($this->ReceiptNo->CurrentValue);
			if ($curVal != "") {
				$this->ReceiptNo->EditValue = $this->ReceiptNo->lookupCacheOption($curVal);
				if ($this->ReceiptNo->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ReceiptNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReceiptNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode(FormatDateTime($rswrk->fields('df2'), 7));
						$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
						$this->ReceiptNo->EditValue = $this->ReceiptNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
					}
				}
			} else {
				$this->ReceiptNo->EditValue = NULL;
			}
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->EditValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ClientSerNo->EditValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
					}
				}
			} else {
				$this->ClientSerNo->EditValue = NULL;
			}
			$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PaidBy
			$this->PaidBy->EditAttrs["class"] = "form-control";
			$this->PaidBy->EditCustomAttributes = "";
			if (!$this->PaidBy->Raw)
				$this->PaidBy->CurrentValue = HtmlDecode($this->PaidBy->CurrentValue);
			$this->PaidBy->EditValue = HtmlEncode($this->PaidBy->CurrentValue);
			$this->PaidBy->PlaceHolder = RemoveHtml($this->PaidBy->caption());

			// ClientPostalAddress
			$this->ClientPostalAddress->EditAttrs["class"] = "form-control";
			$this->ClientPostalAddress->EditCustomAttributes = "";
			if (!$this->ClientPostalAddress->Raw)
				$this->ClientPostalAddress->CurrentValue = HtmlDecode($this->ClientPostalAddress->CurrentValue);
			$this->ClientPostalAddress->EditValue = HtmlEncode($this->ClientPostalAddress->CurrentValue);
			$this->ClientPostalAddress->PlaceHolder = RemoveHtml($this->ClientPostalAddress->caption());

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->EditAttrs["class"] = "form-control";
			$this->ClientPhysicalAddress->EditCustomAttributes = "";
			if (!$this->ClientPhysicalAddress->Raw)
				$this->ClientPhysicalAddress->CurrentValue = HtmlDecode($this->ClientPhysicalAddress->CurrentValue);
			$this->ClientPhysicalAddress->EditValue = HtmlEncode($this->ClientPhysicalAddress->CurrentValue);
			$this->ClientPhysicalAddress->PlaceHolder = RemoveHtml($this->ClientPhysicalAddress->caption());

			// ClientEmail
			$this->ClientEmail->EditAttrs["class"] = "form-control";
			$this->ClientEmail->EditCustomAttributes = "";
			if (!$this->ClientEmail->Raw)
				$this->ClientEmail->CurrentValue = HtmlDecode($this->ClientEmail->CurrentValue);
			$this->ClientEmail->EditValue = HtmlEncode($this->ClientEmail->CurrentValue);
			$this->ClientEmail->PlaceHolder = RemoveHtml($this->ClientEmail->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// ReceiptPrefix
			$this->ReceiptPrefix->EditAttrs["class"] = "form-control";
			$this->ReceiptPrefix->EditCustomAttributes = "";
			if (!$this->ReceiptPrefix->Raw)
				$this->ReceiptPrefix->CurrentValue = HtmlDecode($this->ReceiptPrefix->CurrentValue);
			$this->ReceiptPrefix->EditValue = HtmlEncode($this->ReceiptPrefix->CurrentValue);
			$this->ReceiptPrefix->PlaceHolder = RemoveHtml($this->ReceiptPrefix->caption());

			// AccountBased
			$this->AccountBased->EditCustomAttributes = "";
			$this->AccountBased->EditValue = $this->AccountBased->options(FALSE);

			// Cashier
			$this->Cashier->EditAttrs["class"] = "form-control";
			$this->Cashier->EditCustomAttributes = "";
			if (!$this->Cashier->Raw)
				$this->Cashier->CurrentValue = HtmlDecode($this->Cashier->CurrentValue);
			$this->Cashier->EditValue = HtmlEncode($this->Cashier->CurrentValue);
			$this->Cashier->PlaceHolder = RemoveHtml($this->Cashier->caption());

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime($this->ReceiptDate->CurrentValue, 8));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// TotalDue
			$this->TotalDue->EditAttrs["class"] = "form-control";
			$this->TotalDue->EditCustomAttributes = "";
			$this->TotalDue->EditValue = HtmlEncode($this->TotalDue->CurrentValue);
			$this->TotalDue->PlaceHolder = RemoveHtml($this->TotalDue->caption());
			if (strval($this->TotalDue->EditValue) != "" && is_numeric($this->TotalDue->EditValue))
				$this->TotalDue->EditValue = FormatNumber($this->TotalDue->EditValue, -2, -2, -2, -2);
			

			// AmountTendered
			$this->AmountTendered->EditAttrs["class"] = "form-control";
			$this->AmountTendered->EditCustomAttributes = "";
			$this->AmountTendered->EditValue = HtmlEncode($this->AmountTendered->CurrentValue);
			$this->AmountTendered->PlaceHolder = RemoveHtml($this->AmountTendered->caption());
			if (strval($this->AmountTendered->EditValue) != "" && is_numeric($this->AmountTendered->EditValue))
				$this->AmountTendered->EditValue = FormatNumber($this->AmountTendered->EditValue, -2, -2, -2, -2);
			

			// Change
			$this->Change->EditAttrs["class"] = "form-control";
			$this->Change->EditCustomAttributes = "";
			$this->Change->EditValue = HtmlEncode($this->Change->CurrentValue);
			$this->Change->PlaceHolder = RemoveHtml($this->Change->caption());
			if (strval($this->Change->EditValue) != "" && is_numeric($this->Change->EditValue))
				$this->Change->EditValue = FormatNumber($this->Change->EditValue, -2, -2, -2, -2);
			

			// ClientMessage
			$this->ClientMessage->EditAttrs["class"] = "form-control";
			$this->ClientMessage->EditCustomAttributes = "";
			if (!$this->ClientMessage->Raw)
				$this->ClientMessage->CurrentValue = HtmlDecode($this->ClientMessage->CurrentValue);
			$this->ClientMessage->EditValue = HtmlEncode($this->ClientMessage->CurrentValue);
			$this->ClientMessage->PlaceHolder = RemoveHtml($this->ClientMessage->caption());

			// Reasons
			$this->Reasons->EditAttrs["class"] = "form-control";
			$this->Reasons->EditCustomAttributes = "";
			$this->Reasons->EditValue = HtmlEncode($this->Reasons->CurrentValue);
			$this->Reasons->PlaceHolder = RemoveHtml($this->Reasons->caption());

			// Add refer script
			// ReceiptNo

			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// PaidBy
			$this->PaidBy->LinkCustomAttributes = "";
			$this->PaidBy->HrefValue = "";

			// ClientPostalAddress
			$this->ClientPostalAddress->LinkCustomAttributes = "";
			$this->ClientPostalAddress->HrefValue = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->LinkCustomAttributes = "";
			$this->ClientPhysicalAddress->HrefValue = "";

			// ClientEmail
			$this->ClientEmail->LinkCustomAttributes = "";
			$this->ClientEmail->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->LinkCustomAttributes = "";
			$this->ReceiptPrefix->HrefValue = "";

			// AccountBased
			$this->AccountBased->LinkCustomAttributes = "";
			$this->AccountBased->HrefValue = "";

			// Cashier
			$this->Cashier->LinkCustomAttributes = "";
			$this->Cashier->HrefValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// TotalDue
			$this->TotalDue->LinkCustomAttributes = "";
			$this->TotalDue->HrefValue = "";

			// AmountTendered
			$this->AmountTendered->LinkCustomAttributes = "";
			$this->AmountTendered->HrefValue = "";

			// Change
			$this->Change->LinkCustomAttributes = "";
			$this->Change->HrefValue = "";

			// ClientMessage
			$this->ClientMessage->LinkCustomAttributes = "";
			$this->ClientMessage->HrefValue = "";

			// Reasons
			$this->Reasons->LinkCustomAttributes = "";
			$this->Reasons->HrefValue = "";
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
		if ($this->ReceiptNo->Required) {
			if (!$this->ReceiptNo->IsDetailKey && $this->ReceiptNo->FormValue != NULL && $this->ReceiptNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptNo->caption(), $this->ReceiptNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ReceiptNo->FormValue)) {
			AddMessage($FormError, $this->ReceiptNo->errorMessage());
		}
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClientSerNo->FormValue)) {
			AddMessage($FormError, $this->ClientSerNo->errorMessage());
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->PaidBy->Required) {
			if (!$this->PaidBy->IsDetailKey && $this->PaidBy->FormValue != NULL && $this->PaidBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaidBy->caption(), $this->PaidBy->RequiredErrorMessage));
			}
		}
		if ($this->ClientPostalAddress->Required) {
			if (!$this->ClientPostalAddress->IsDetailKey && $this->ClientPostalAddress->FormValue != NULL && $this->ClientPostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientPostalAddress->caption(), $this->ClientPostalAddress->RequiredErrorMessage));
			}
		}
		if ($this->ClientPhysicalAddress->Required) {
			if (!$this->ClientPhysicalAddress->IsDetailKey && $this->ClientPhysicalAddress->FormValue != NULL && $this->ClientPhysicalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientPhysicalAddress->caption(), $this->ClientPhysicalAddress->RequiredErrorMessage));
			}
		}
		if ($this->ClientEmail->Required) {
			if (!$this->ClientEmail->IsDetailKey && $this->ClientEmail->FormValue != NULL && $this->ClientEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientEmail->caption(), $this->ClientEmail->RequiredErrorMessage));
			}
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if ($this->ReceiptPrefix->Required) {
			if (!$this->ReceiptPrefix->IsDetailKey && $this->ReceiptPrefix->FormValue != NULL && $this->ReceiptPrefix->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptPrefix->caption(), $this->ReceiptPrefix->RequiredErrorMessage));
			}
		}
		if ($this->AccountBased->Required) {
			if ($this->AccountBased->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountBased->caption(), $this->AccountBased->RequiredErrorMessage));
			}
		}
		if ($this->Cashier->Required) {
			if (!$this->Cashier->IsDetailKey && $this->Cashier->FormValue != NULL && $this->Cashier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cashier->caption(), $this->Cashier->RequiredErrorMessage));
			}
		}
		if ($this->ReceiptDate->Required) {
			if (!$this->ReceiptDate->IsDetailKey && $this->ReceiptDate->FormValue != NULL && $this->ReceiptDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptDate->caption(), $this->ReceiptDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ReceiptDate->FormValue)) {
			AddMessage($FormError, $this->ReceiptDate->errorMessage());
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->TotalDue->Required) {
			if (!$this->TotalDue->IsDetailKey && $this->TotalDue->FormValue != NULL && $this->TotalDue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TotalDue->caption(), $this->TotalDue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->TotalDue->FormValue)) {
			AddMessage($FormError, $this->TotalDue->errorMessage());
		}
		if ($this->AmountTendered->Required) {
			if (!$this->AmountTendered->IsDetailKey && $this->AmountTendered->FormValue != NULL && $this->AmountTendered->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountTendered->caption(), $this->AmountTendered->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountTendered->FormValue)) {
			AddMessage($FormError, $this->AmountTendered->errorMessage());
		}
		if ($this->Change->Required) {
			if (!$this->Change->IsDetailKey && $this->Change->FormValue != NULL && $this->Change->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Change->caption(), $this->Change->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Change->FormValue)) {
			AddMessage($FormError, $this->Change->errorMessage());
		}
		if ($this->ClientMessage->Required) {
			if (!$this->ClientMessage->IsDetailKey && $this->ClientMessage->FormValue != NULL && $this->ClientMessage->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientMessage->caption(), $this->ClientMessage->RequiredErrorMessage));
			}
		}
		if ($this->Reasons->Required) {
			if (!$this->Reasons->IsDetailKey && $this->Reasons->FormValue != NULL && $this->Reasons->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Reasons->caption(), $this->Reasons->RequiredErrorMessage));
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

		// ReceiptNo
		$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, 0, strval($this->ReceiptNo->CurrentValue) == "");

		// ClientSerNo
		$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// PaidBy
		$this->PaidBy->setDbValueDef($rsnew, $this->PaidBy->CurrentValue, NULL, FALSE);

		// ClientPostalAddress
		$this->ClientPostalAddress->setDbValueDef($rsnew, $this->ClientPostalAddress->CurrentValue, NULL, FALSE);

		// ClientPhysicalAddress
		$this->ClientPhysicalAddress->setDbValueDef($rsnew, $this->ClientPhysicalAddress->CurrentValue, NULL, FALSE);

		// ClientEmail
		$this->ClientEmail->setDbValueDef($rsnew, $this->ClientEmail->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, "", FALSE);

		// ReceiptPrefix
		$this->ReceiptPrefix->setDbValueDef($rsnew, $this->ReceiptPrefix->CurrentValue, "", FALSE);

		// AccountBased
		$tmpBool = $this->AccountBased->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->AccountBased->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// Cashier
		$this->Cashier->setDbValueDef($rsnew, $this->Cashier->CurrentValue, "", FALSE);

		// ReceiptDate
		$this->ReceiptDate->setDbValueDef($rsnew, UnFormatDateTime($this->ReceiptDate->CurrentValue, 0), NULL, FALSE);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, "", FALSE);

		// TotalDue
		$this->TotalDue->setDbValueDef($rsnew, $this->TotalDue->CurrentValue, NULL, FALSE);

		// AmountTendered
		$this->AmountTendered->setDbValueDef($rsnew, $this->AmountTendered->CurrentValue, NULL, strval($this->AmountTendered->CurrentValue) == "");

		// Change
		$this->Change->setDbValueDef($rsnew, $this->Change->CurrentValue, NULL, strval($this->Change->CurrentValue) == "");

		// ClientMessage
		$this->ClientMessage->setDbValueDef($rsnew, $this->ClientMessage->CurrentValue, NULL, FALSE);

		// Reasons
		$this->Reasons->setDbValueDef($rsnew, $this->Reasons->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("receipt_header_reverselist.php"), "", $this->TableVar, TRUE);
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
				case "x_ReceiptNo":
					break;
				case "x_ClientSerNo":
					break;
				case "x_AccountBased":
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
						case "x_ReceiptNo":
							$row[2] = FormatDateTime($row[2], 7);
							$row['df2'] = $row[2];
							break;
						case "x_ClientSerNo":
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