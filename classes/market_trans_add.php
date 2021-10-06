<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class market_trans_add extends market_trans
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'market_trans';

	// Page object name
	public $PageObjName = "market_trans_add";

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

		// Table object (market_trans)
		if (!isset($GLOBALS["market_trans"]) || get_class($GLOBALS["market_trans"]) == PROJECT_NAMESPACE . "market_trans") {
			$GLOBALS["market_trans"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["market_trans"];
		}

		// Table object (market_property)
		if (!isset($GLOBALS['market_property']))
			$GLOBALS['market_property'] = new market_property();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'market_trans');

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
		global $market_trans;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($market_trans);
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
					if ($pageName == "market_transview.php")
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
			$key .= @$ar['TransNo'];
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
			$this->TransNo->Visible = FALSE;
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
					$this->terminate(GetUrl("market_translist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->TransNo->Visible = FALSE;
		$this->MarketItemNo->setVisibility();
		$this->DateHired->setVisibility();
		$this->MartketeerName->setVisibility();
		$this->MartketeerID->setVisibility();
		$this->AmountDue->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->ReceiptNo->setVisibility();
		$this->LastUpdatedBy->setVisibility();
		$this->LastUpdateDate->setVisibility();
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
			$this->terminate("market_translist.php");
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
			if (Get("TransNo") !== NULL) {
				$this->TransNo->setQueryStringValue(Get("TransNo"));
				$this->setKey("TransNo", $this->TransNo->CurrentValue); // Set up key
			} else {
				$this->setKey("TransNo", ""); // Clear key
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
					$this->terminate("market_translist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "market_translist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "market_transview.php")
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
		$this->TransNo->CurrentValue = NULL;
		$this->TransNo->OldValue = $this->TransNo->CurrentValue;
		$this->MarketItemNo->CurrentValue = NULL;
		$this->MarketItemNo->OldValue = $this->MarketItemNo->CurrentValue;
		$this->DateHired->CurrentValue = NULL;
		$this->DateHired->OldValue = $this->DateHired->CurrentValue;
		$this->MartketeerName->CurrentValue = NULL;
		$this->MartketeerName->OldValue = $this->MartketeerName->CurrentValue;
		$this->MartketeerID->CurrentValue = NULL;
		$this->MartketeerID->OldValue = $this->MartketeerID->CurrentValue;
		$this->AmountDue->CurrentValue = NULL;
		$this->AmountDue->OldValue = $this->AmountDue->CurrentValue;
		$this->AmountPaid->CurrentValue = NULL;
		$this->AmountPaid->OldValue = $this->AmountPaid->CurrentValue;
		$this->ReceiptNo->CurrentValue = NULL;
		$this->ReceiptNo->OldValue = $this->ReceiptNo->CurrentValue;
		$this->LastUpdatedBy->CurrentValue = NULL;
		$this->LastUpdatedBy->OldValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdateDate->CurrentValue = NULL;
		$this->LastUpdateDate->OldValue = $this->LastUpdateDate->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'MarketItemNo' first before field var 'x_MarketItemNo'
		$val = $CurrentForm->hasValue("MarketItemNo") ? $CurrentForm->getValue("MarketItemNo") : $CurrentForm->getValue("x_MarketItemNo");
		if (!$this->MarketItemNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MarketItemNo->Visible = FALSE; // Disable update for API request
			else
				$this->MarketItemNo->setFormValue($val);
		}

		// Check field name 'DateHired' first before field var 'x_DateHired'
		$val = $CurrentForm->hasValue("DateHired") ? $CurrentForm->getValue("DateHired") : $CurrentForm->getValue("x_DateHired");
		if (!$this->DateHired->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateHired->Visible = FALSE; // Disable update for API request
			else
				$this->DateHired->setFormValue($val);
			$this->DateHired->CurrentValue = UnFormatDateTime($this->DateHired->CurrentValue, 0);
		}

		// Check field name 'MartketeerName' first before field var 'x_MartketeerName'
		$val = $CurrentForm->hasValue("MartketeerName") ? $CurrentForm->getValue("MartketeerName") : $CurrentForm->getValue("x_MartketeerName");
		if (!$this->MartketeerName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MartketeerName->Visible = FALSE; // Disable update for API request
			else
				$this->MartketeerName->setFormValue($val);
		}

		// Check field name 'MartketeerID' first before field var 'x_MartketeerID'
		$val = $CurrentForm->hasValue("MartketeerID") ? $CurrentForm->getValue("MartketeerID") : $CurrentForm->getValue("x_MartketeerID");
		if (!$this->MartketeerID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MartketeerID->Visible = FALSE; // Disable update for API request
			else
				$this->MartketeerID->setFormValue($val);
		}

		// Check field name 'AmountDue' first before field var 'x_AmountDue'
		$val = $CurrentForm->hasValue("AmountDue") ? $CurrentForm->getValue("AmountDue") : $CurrentForm->getValue("x_AmountDue");
		if (!$this->AmountDue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountDue->Visible = FALSE; // Disable update for API request
			else
				$this->AmountDue->setFormValue($val);
		}

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}

		// Check field name 'ReceiptNo' first before field var 'x_ReceiptNo'
		$val = $CurrentForm->hasValue("ReceiptNo") ? $CurrentForm->getValue("ReceiptNo") : $CurrentForm->getValue("x_ReceiptNo");
		if (!$this->ReceiptNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptNo->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptNo->setFormValue($val);
		}

		// Check field name 'LastUpdatedBy' first before field var 'x_LastUpdatedBy'
		$val = $CurrentForm->hasValue("LastUpdatedBy") ? $CurrentForm->getValue("LastUpdatedBy") : $CurrentForm->getValue("x_LastUpdatedBy");
		if (!$this->LastUpdatedBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastUpdatedBy->Visible = FALSE; // Disable update for API request
			else
				$this->LastUpdatedBy->setFormValue($val);
		}

		// Check field name 'LastUpdateDate' first before field var 'x_LastUpdateDate'
		$val = $CurrentForm->hasValue("LastUpdateDate") ? $CurrentForm->getValue("LastUpdateDate") : $CurrentForm->getValue("x_LastUpdateDate");
		if (!$this->LastUpdateDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastUpdateDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastUpdateDate->setFormValue($val);
			$this->LastUpdateDate->CurrentValue = UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0);
		}

		// Check field name 'TransNo' first before field var 'x_TransNo'
		$val = $CurrentForm->hasValue("TransNo") ? $CurrentForm->getValue("TransNo") : $CurrentForm->getValue("x_TransNo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->MarketItemNo->CurrentValue = $this->MarketItemNo->FormValue;
		$this->DateHired->CurrentValue = $this->DateHired->FormValue;
		$this->DateHired->CurrentValue = UnFormatDateTime($this->DateHired->CurrentValue, 0);
		$this->MartketeerName->CurrentValue = $this->MartketeerName->FormValue;
		$this->MartketeerID->CurrentValue = $this->MartketeerID->FormValue;
		$this->AmountDue->CurrentValue = $this->AmountDue->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->ReceiptNo->CurrentValue = $this->ReceiptNo->FormValue;
		$this->LastUpdatedBy->CurrentValue = $this->LastUpdatedBy->FormValue;
		$this->LastUpdateDate->CurrentValue = $this->LastUpdateDate->FormValue;
		$this->LastUpdateDate->CurrentValue = UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0);
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
		$this->TransNo->setDbValue($row['TransNo']);
		$this->MarketItemNo->setDbValue($row['MarketItemNo']);
		$this->DateHired->setDbValue($row['DateHired']);
		$this->MartketeerName->setDbValue($row['MartketeerName']);
		$this->MartketeerID->setDbValue($row['MartketeerID']);
		$this->AmountDue->setDbValue($row['AmountDue']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['TransNo'] = $this->TransNo->CurrentValue;
		$row['MarketItemNo'] = $this->MarketItemNo->CurrentValue;
		$row['DateHired'] = $this->DateHired->CurrentValue;
		$row['MartketeerName'] = $this->MartketeerName->CurrentValue;
		$row['MartketeerID'] = $this->MartketeerID->CurrentValue;
		$row['AmountDue'] = $this->AmountDue->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['ReceiptNo'] = $this->ReceiptNo->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("TransNo")) != "")
			$this->TransNo->OldValue = $this->getKey("TransNo"); // TransNo
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

		if ($this->AmountDue->FormValue == $this->AmountDue->CurrentValue && is_numeric(ConvertToFloatString($this->AmountDue->CurrentValue)))
			$this->AmountDue->CurrentValue = ConvertToFloatString($this->AmountDue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// TransNo
		// MarketItemNo
		// DateHired
		// MartketeerName
		// MartketeerID
		// AmountDue
		// AmountPaid
		// ReceiptNo
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// TransNo
			$this->TransNo->ViewValue = $this->TransNo->CurrentValue;
			$this->TransNo->ViewCustomAttributes = "";

			// MarketItemNo
			$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
			$this->MarketItemNo->ViewCustomAttributes = "";

			// DateHired
			$this->DateHired->ViewValue = $this->DateHired->CurrentValue;
			$this->DateHired->ViewValue = FormatDateTime($this->DateHired->ViewValue, 0);
			$this->DateHired->ViewCustomAttributes = "";

			// MartketeerName
			$this->MartketeerName->ViewValue = $this->MartketeerName->CurrentValue;
			$this->MartketeerName->ViewCustomAttributes = "";

			// MartketeerID
			$this->MartketeerID->ViewValue = $this->MartketeerID->CurrentValue;
			$this->MartketeerID->ViewCustomAttributes = "";

			// AmountDue
			$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
			$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AmountDue->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AmountPaid->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$this->ReceiptNo->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// MarketItemNo
			$this->MarketItemNo->LinkCustomAttributes = "";
			$this->MarketItemNo->HrefValue = "";
			$this->MarketItemNo->TooltipValue = "";

			// DateHired
			$this->DateHired->LinkCustomAttributes = "";
			$this->DateHired->HrefValue = "";
			$this->DateHired->TooltipValue = "";

			// MartketeerName
			$this->MartketeerName->LinkCustomAttributes = "";
			$this->MartketeerName->HrefValue = "";
			$this->MartketeerName->TooltipValue = "";

			// MartketeerID
			$this->MartketeerID->LinkCustomAttributes = "";
			$this->MartketeerID->HrefValue = "";
			$this->MartketeerID->TooltipValue = "";

			// AmountDue
			$this->AmountDue->LinkCustomAttributes = "";
			$this->AmountDue->HrefValue = "";
			$this->AmountDue->TooltipValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// MarketItemNo
			$this->MarketItemNo->EditAttrs["class"] = "form-control";
			$this->MarketItemNo->EditCustomAttributes = "";
			if ($this->MarketItemNo->getSessionValue() != "") {
				$this->MarketItemNo->CurrentValue = $this->MarketItemNo->getSessionValue();
				$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
				$this->MarketItemNo->ViewCustomAttributes = "";
			} else {
				$this->MarketItemNo->EditValue = HtmlEncode($this->MarketItemNo->CurrentValue);
				$this->MarketItemNo->PlaceHolder = RemoveHtml($this->MarketItemNo->caption());
			}

			// DateHired
			$this->DateHired->EditAttrs["class"] = "form-control";
			$this->DateHired->EditCustomAttributes = "";
			$this->DateHired->EditValue = HtmlEncode(FormatDateTime($this->DateHired->CurrentValue, 8));
			$this->DateHired->PlaceHolder = RemoveHtml($this->DateHired->caption());

			// MartketeerName
			$this->MartketeerName->EditAttrs["class"] = "form-control";
			$this->MartketeerName->EditCustomAttributes = "";
			if (!$this->MartketeerName->Raw)
				$this->MartketeerName->CurrentValue = HtmlDecode($this->MartketeerName->CurrentValue);
			$this->MartketeerName->EditValue = HtmlEncode($this->MartketeerName->CurrentValue);
			$this->MartketeerName->PlaceHolder = RemoveHtml($this->MartketeerName->caption());

			// MartketeerID
			$this->MartketeerID->EditAttrs["class"] = "form-control";
			$this->MartketeerID->EditCustomAttributes = "";
			if (!$this->MartketeerID->Raw)
				$this->MartketeerID->CurrentValue = HtmlDecode($this->MartketeerID->CurrentValue);
			$this->MartketeerID->EditValue = HtmlEncode($this->MartketeerID->CurrentValue);
			$this->MartketeerID->PlaceHolder = RemoveHtml($this->MartketeerID->caption());

			// AmountDue
			$this->AmountDue->EditAttrs["class"] = "form-control";
			$this->AmountDue->EditCustomAttributes = "";
			$this->AmountDue->EditValue = HtmlEncode($this->AmountDue->CurrentValue);
			$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());
			if (strval($this->AmountDue->EditValue) != "" && is_numeric($this->AmountDue->EditValue))
				$this->AmountDue->EditValue = FormatNumber($this->AmountDue->EditValue, -2, -1, -2, 0);
			

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
			

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			if (!$this->ReceiptNo->Raw)
				$this->ReceiptNo->CurrentValue = HtmlDecode($this->ReceiptNo->CurrentValue);
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

			// LastUpdatedBy
			$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
			$this->LastUpdatedBy->EditCustomAttributes = "";
			if (!$this->LastUpdatedBy->Raw)
				$this->LastUpdatedBy->CurrentValue = HtmlDecode($this->LastUpdatedBy->CurrentValue);
			$this->LastUpdatedBy->EditValue = HtmlEncode($this->LastUpdatedBy->CurrentValue);
			$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

			// LastUpdateDate
			$this->LastUpdateDate->EditAttrs["class"] = "form-control";
			$this->LastUpdateDate->EditCustomAttributes = "";
			$this->LastUpdateDate->EditValue = HtmlEncode(FormatDateTime($this->LastUpdateDate->CurrentValue, 8));
			$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

			// Add refer script
			// MarketItemNo

			$this->MarketItemNo->LinkCustomAttributes = "";
			$this->MarketItemNo->HrefValue = "";

			// DateHired
			$this->DateHired->LinkCustomAttributes = "";
			$this->DateHired->HrefValue = "";

			// MartketeerName
			$this->MartketeerName->LinkCustomAttributes = "";
			$this->MartketeerName->HrefValue = "";

			// MartketeerID
			$this->MartketeerID->LinkCustomAttributes = "";
			$this->MartketeerID->HrefValue = "";

			// AmountDue
			$this->AmountDue->LinkCustomAttributes = "";
			$this->AmountDue->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
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
		if ($this->MarketItemNo->Required) {
			if (!$this->MarketItemNo->IsDetailKey && $this->MarketItemNo->FormValue != NULL && $this->MarketItemNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MarketItemNo->caption(), $this->MarketItemNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->MarketItemNo->FormValue)) {
			AddMessage($FormError, $this->MarketItemNo->errorMessage());
		}
		if ($this->DateHired->Required) {
			if (!$this->DateHired->IsDetailKey && $this->DateHired->FormValue != NULL && $this->DateHired->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateHired->caption(), $this->DateHired->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateHired->FormValue)) {
			AddMessage($FormError, $this->DateHired->errorMessage());
		}
		if ($this->MartketeerName->Required) {
			if (!$this->MartketeerName->IsDetailKey && $this->MartketeerName->FormValue != NULL && $this->MartketeerName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MartketeerName->caption(), $this->MartketeerName->RequiredErrorMessage));
			}
		}
		if ($this->MartketeerID->Required) {
			if (!$this->MartketeerID->IsDetailKey && $this->MartketeerID->FormValue != NULL && $this->MartketeerID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MartketeerID->caption(), $this->MartketeerID->RequiredErrorMessage));
			}
		}
		if ($this->AmountDue->Required) {
			if (!$this->AmountDue->IsDetailKey && $this->AmountDue->FormValue != NULL && $this->AmountDue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountDue->caption(), $this->AmountDue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountDue->FormValue)) {
			AddMessage($FormError, $this->AmountDue->errorMessage());
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->ReceiptNo->Required) {
			if (!$this->ReceiptNo->IsDetailKey && $this->ReceiptNo->FormValue != NULL && $this->ReceiptNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptNo->caption(), $this->ReceiptNo->RequiredErrorMessage));
			}
		}
		if ($this->LastUpdatedBy->Required) {
			if (!$this->LastUpdatedBy->IsDetailKey && $this->LastUpdatedBy->FormValue != NULL && $this->LastUpdatedBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastUpdatedBy->caption(), $this->LastUpdatedBy->RequiredErrorMessage));
			}
		}
		if ($this->LastUpdateDate->Required) {
			if (!$this->LastUpdateDate->IsDetailKey && $this->LastUpdateDate->FormValue != NULL && $this->LastUpdateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastUpdateDate->caption(), $this->LastUpdateDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastUpdateDate->FormValue)) {
			AddMessage($FormError, $this->LastUpdateDate->errorMessage());
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

		// MarketItemNo
		$this->MarketItemNo->setDbValueDef($rsnew, $this->MarketItemNo->CurrentValue, 0, FALSE);

		// DateHired
		$this->DateHired->setDbValueDef($rsnew, UnFormatDateTime($this->DateHired->CurrentValue, 0), NULL, FALSE);

		// MartketeerName
		$this->MartketeerName->setDbValueDef($rsnew, $this->MartketeerName->CurrentValue, "", FALSE);

		// MartketeerID
		$this->MartketeerID->setDbValueDef($rsnew, $this->MartketeerID->CurrentValue, NULL, FALSE);

		// AmountDue
		$this->AmountDue->setDbValueDef($rsnew, $this->AmountDue->CurrentValue, NULL, FALSE);

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, FALSE);

		// ReceiptNo
		$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, NULL, FALSE);

		// LastUpdatedBy
		$this->LastUpdatedBy->setDbValueDef($rsnew, $this->LastUpdatedBy->CurrentValue, NULL, FALSE);

		// LastUpdateDate
		$this->LastUpdateDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0), NULL, FALSE);

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
			if ($masterTblVar == "market_property") {
				$validMaster = TRUE;
				if (($parm = Get("fk_MarketItemNo", Get("MarketItemNo"))) !== NULL) {
					$GLOBALS["market_property"]->MarketItemNo->setQueryStringValue($parm);
					$this->MarketItemNo->setQueryStringValue($GLOBALS["market_property"]->MarketItemNo->QueryStringValue);
					$this->MarketItemNo->setSessionValue($this->MarketItemNo->QueryStringValue);
					if (!is_numeric($GLOBALS["market_property"]->MarketItemNo->QueryStringValue))
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
			if ($masterTblVar == "market_property") {
				$validMaster = TRUE;
				if (($parm = Post("fk_MarketItemNo", Post("MarketItemNo"))) !== NULL) {
					$GLOBALS["market_property"]->MarketItemNo->setFormValue($parm);
					$this->MarketItemNo->setFormValue($GLOBALS["market_property"]->MarketItemNo->FormValue);
					$this->MarketItemNo->setSessionValue($this->MarketItemNo->FormValue);
					if (!is_numeric($GLOBALS["market_property"]->MarketItemNo->FormValue))
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
			if ($masterTblVar != "market_property") {
				if ($this->MarketItemNo->CurrentValue == "")
					$this->MarketItemNo->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("market_translist.php"), "", $this->TableVar, TRUE);
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