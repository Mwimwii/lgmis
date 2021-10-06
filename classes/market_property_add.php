<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class market_property_add extends market_property
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'market_property';

	// Page object name
	public $PageObjName = "market_property_add";

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

		// Table object (market_property)
		if (!isset($GLOBALS["market_property"]) || get_class($GLOBALS["market_property"]) == PROJECT_NAMESPACE . "market_property") {
			$GLOBALS["market_property"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["market_property"];
		}

		// Table object (market)
		if (!isset($GLOBALS['market']))
			$GLOBALS['market'] = new market();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'market_property');

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
		global $market_property;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($market_property);
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
					if ($pageName == "market_propertyview.php")
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
			$key .= @$ar['MarketItemNo'];
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
			$this->MarketItemNo->Visible = FALSE;
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
					$this->terminate(GetUrl("market_propertylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->MarketItemNo->Visible = FALSE;
		$this->MarketNo->setVisibility();
		$this->ItemName->setVisibility();
		$this->ItemRef->setVisibility();
		$this->ItemLength->setVisibility();
		$this->ItemWidth->setVisibility();
		$this->DefaultFees->setVisibility();
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
		$this->setupLookupOptions($this->MarketNo);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("market_propertylist.php");
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
			if (Get("MarketItemNo") !== NULL) {
				$this->MarketItemNo->setQueryStringValue(Get("MarketItemNo"));
				$this->setKey("MarketItemNo", $this->MarketItemNo->CurrentValue); // Set up key
			} else {
				$this->setKey("MarketItemNo", ""); // Clear key
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
					$this->terminate("market_propertylist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "market_propertylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "market_propertyview.php")
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
		$this->MarketItemNo->CurrentValue = NULL;
		$this->MarketItemNo->OldValue = $this->MarketItemNo->CurrentValue;
		$this->MarketNo->CurrentValue = NULL;
		$this->MarketNo->OldValue = $this->MarketNo->CurrentValue;
		$this->ItemName->CurrentValue = NULL;
		$this->ItemName->OldValue = $this->ItemName->CurrentValue;
		$this->ItemRef->CurrentValue = NULL;
		$this->ItemRef->OldValue = $this->ItemRef->CurrentValue;
		$this->ItemLength->CurrentValue = NULL;
		$this->ItemLength->OldValue = $this->ItemLength->CurrentValue;
		$this->ItemWidth->CurrentValue = NULL;
		$this->ItemWidth->OldValue = $this->ItemWidth->CurrentValue;
		$this->DefaultFees->CurrentValue = NULL;
		$this->DefaultFees->OldValue = $this->DefaultFees->CurrentValue;
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

		// Check field name 'MarketNo' first before field var 'x_MarketNo'
		$val = $CurrentForm->hasValue("MarketNo") ? $CurrentForm->getValue("MarketNo") : $CurrentForm->getValue("x_MarketNo");
		if (!$this->MarketNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MarketNo->Visible = FALSE; // Disable update for API request
			else
				$this->MarketNo->setFormValue($val);
		}

		// Check field name 'ItemName' first before field var 'x_ItemName'
		$val = $CurrentForm->hasValue("ItemName") ? $CurrentForm->getValue("ItemName") : $CurrentForm->getValue("x_ItemName");
		if (!$this->ItemName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemName->Visible = FALSE; // Disable update for API request
			else
				$this->ItemName->setFormValue($val);
		}

		// Check field name 'ItemRef' first before field var 'x_ItemRef'
		$val = $CurrentForm->hasValue("ItemRef") ? $CurrentForm->getValue("ItemRef") : $CurrentForm->getValue("x_ItemRef");
		if (!$this->ItemRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemRef->Visible = FALSE; // Disable update for API request
			else
				$this->ItemRef->setFormValue($val);
		}

		// Check field name 'ItemLength' first before field var 'x_ItemLength'
		$val = $CurrentForm->hasValue("ItemLength") ? $CurrentForm->getValue("ItemLength") : $CurrentForm->getValue("x_ItemLength");
		if (!$this->ItemLength->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemLength->Visible = FALSE; // Disable update for API request
			else
				$this->ItemLength->setFormValue($val);
		}

		// Check field name 'ItemWidth' first before field var 'x_ItemWidth'
		$val = $CurrentForm->hasValue("ItemWidth") ? $CurrentForm->getValue("ItemWidth") : $CurrentForm->getValue("x_ItemWidth");
		if (!$this->ItemWidth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemWidth->Visible = FALSE; // Disable update for API request
			else
				$this->ItemWidth->setFormValue($val);
		}

		// Check field name 'DefaultFees' first before field var 'x_DefaultFees'
		$val = $CurrentForm->hasValue("DefaultFees") ? $CurrentForm->getValue("DefaultFees") : $CurrentForm->getValue("x_DefaultFees");
		if (!$this->DefaultFees->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DefaultFees->Visible = FALSE; // Disable update for API request
			else
				$this->DefaultFees->setFormValue($val);
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

		// Check field name 'MarketItemNo' first before field var 'x_MarketItemNo'
		$val = $CurrentForm->hasValue("MarketItemNo") ? $CurrentForm->getValue("MarketItemNo") : $CurrentForm->getValue("x_MarketItemNo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->MarketNo->CurrentValue = $this->MarketNo->FormValue;
		$this->ItemName->CurrentValue = $this->ItemName->FormValue;
		$this->ItemRef->CurrentValue = $this->ItemRef->FormValue;
		$this->ItemLength->CurrentValue = $this->ItemLength->FormValue;
		$this->ItemWidth->CurrentValue = $this->ItemWidth->FormValue;
		$this->DefaultFees->CurrentValue = $this->DefaultFees->FormValue;
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
		$this->MarketItemNo->setDbValue($row['MarketItemNo']);
		$this->MarketNo->setDbValue($row['MarketNo']);
		$this->ItemName->setDbValue($row['ItemName']);
		$this->ItemRef->setDbValue($row['ItemRef']);
		$this->ItemLength->setDbValue($row['ItemLength']);
		$this->ItemWidth->setDbValue($row['ItemWidth']);
		$this->DefaultFees->setDbValue($row['DefaultFees']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['MarketItemNo'] = $this->MarketItemNo->CurrentValue;
		$row['MarketNo'] = $this->MarketNo->CurrentValue;
		$row['ItemName'] = $this->ItemName->CurrentValue;
		$row['ItemRef'] = $this->ItemRef->CurrentValue;
		$row['ItemLength'] = $this->ItemLength->CurrentValue;
		$row['ItemWidth'] = $this->ItemWidth->CurrentValue;
		$row['DefaultFees'] = $this->DefaultFees->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("MarketItemNo")) != "")
			$this->MarketItemNo->OldValue = $this->getKey("MarketItemNo"); // MarketItemNo
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

		if ($this->ItemLength->FormValue == $this->ItemLength->CurrentValue && is_numeric(ConvertToFloatString($this->ItemLength->CurrentValue)))
			$this->ItemLength->CurrentValue = ConvertToFloatString($this->ItemLength->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ItemWidth->FormValue == $this->ItemWidth->CurrentValue && is_numeric(ConvertToFloatString($this->ItemWidth->CurrentValue)))
			$this->ItemWidth->CurrentValue = ConvertToFloatString($this->ItemWidth->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DefaultFees->FormValue == $this->DefaultFees->CurrentValue && is_numeric(ConvertToFloatString($this->DefaultFees->CurrentValue)))
			$this->DefaultFees->CurrentValue = ConvertToFloatString($this->DefaultFees->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// MarketItemNo
		// MarketNo
		// ItemName
		// ItemRef
		// ItemLength
		// ItemWidth
		// DefaultFees
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// MarketItemNo
			$this->MarketItemNo->ViewValue = $this->MarketItemNo->CurrentValue;
			$this->MarketItemNo->ViewCustomAttributes = "";

			// MarketNo
			$curVal = strval($this->MarketNo->CurrentValue);
			if ($curVal != "") {
				$this->MarketNo->ViewValue = $this->MarketNo->lookupCacheOption($curVal);
				if ($this->MarketNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MarketNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MarketNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MarketNo->ViewValue = $this->MarketNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MarketNo->ViewValue = $this->MarketNo->CurrentValue;
					}
				}
			} else {
				$this->MarketNo->ViewValue = NULL;
			}
			$this->MarketNo->ViewCustomAttributes = "";

			// ItemName
			$this->ItemName->ViewValue = $this->ItemName->CurrentValue;
			$this->ItemName->ViewCustomAttributes = "";

			// ItemRef
			$this->ItemRef->ViewValue = $this->ItemRef->CurrentValue;
			$this->ItemRef->ViewCustomAttributes = "";

			// ItemLength
			$this->ItemLength->ViewValue = $this->ItemLength->CurrentValue;
			$this->ItemLength->ViewValue = FormatNumber($this->ItemLength->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->ItemLength->ViewCustomAttributes = "";

			// ItemWidth
			$this->ItemWidth->ViewValue = $this->ItemWidth->CurrentValue;
			$this->ItemWidth->ViewValue = FormatNumber($this->ItemWidth->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->ItemWidth->ViewCustomAttributes = "";

			// DefaultFees
			$this->DefaultFees->ViewValue = $this->DefaultFees->CurrentValue;
			$this->DefaultFees->ViewValue = FormatNumber($this->DefaultFees->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->DefaultFees->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// MarketNo
			$this->MarketNo->LinkCustomAttributes = "";
			$this->MarketNo->HrefValue = "";
			$this->MarketNo->TooltipValue = "";

			// ItemName
			$this->ItemName->LinkCustomAttributes = "";
			$this->ItemName->HrefValue = "";
			$this->ItemName->TooltipValue = "";

			// ItemRef
			$this->ItemRef->LinkCustomAttributes = "";
			$this->ItemRef->HrefValue = "";
			$this->ItemRef->TooltipValue = "";

			// ItemLength
			$this->ItemLength->LinkCustomAttributes = "";
			$this->ItemLength->HrefValue = "";
			$this->ItemLength->TooltipValue = "";

			// ItemWidth
			$this->ItemWidth->LinkCustomAttributes = "";
			$this->ItemWidth->HrefValue = "";
			$this->ItemWidth->TooltipValue = "";

			// DefaultFees
			$this->DefaultFees->LinkCustomAttributes = "";
			$this->DefaultFees->HrefValue = "";
			$this->DefaultFees->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// MarketNo
			$this->MarketNo->EditAttrs["class"] = "form-control";
			$this->MarketNo->EditCustomAttributes = "";
			if ($this->MarketNo->getSessionValue() != "") {
				$this->MarketNo->CurrentValue = $this->MarketNo->getSessionValue();
				$curVal = strval($this->MarketNo->CurrentValue);
				if ($curVal != "") {
					$this->MarketNo->ViewValue = $this->MarketNo->lookupCacheOption($curVal);
					if ($this->MarketNo->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`MarketNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->MarketNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->MarketNo->ViewValue = $this->MarketNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->MarketNo->ViewValue = $this->MarketNo->CurrentValue;
						}
					}
				} else {
					$this->MarketNo->ViewValue = NULL;
				}
				$this->MarketNo->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->MarketNo->CurrentValue));
				if ($curVal != "")
					$this->MarketNo->ViewValue = $this->MarketNo->lookupCacheOption($curVal);
				else
					$this->MarketNo->ViewValue = $this->MarketNo->Lookup !== NULL && is_array($this->MarketNo->Lookup->Options) ? $curVal : NULL;
				if ($this->MarketNo->ViewValue !== NULL) { // Load from cache
					$this->MarketNo->EditValue = array_values($this->MarketNo->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`MarketNo`" . SearchString("=", $this->MarketNo->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->MarketNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->MarketNo->EditValue = $arwrk;
				}
			}

			// ItemName
			$this->ItemName->EditAttrs["class"] = "form-control";
			$this->ItemName->EditCustomAttributes = "";
			if (!$this->ItemName->Raw)
				$this->ItemName->CurrentValue = HtmlDecode($this->ItemName->CurrentValue);
			$this->ItemName->EditValue = HtmlEncode($this->ItemName->CurrentValue);
			$this->ItemName->PlaceHolder = RemoveHtml($this->ItemName->caption());

			// ItemRef
			$this->ItemRef->EditAttrs["class"] = "form-control";
			$this->ItemRef->EditCustomAttributes = "";
			if (!$this->ItemRef->Raw)
				$this->ItemRef->CurrentValue = HtmlDecode($this->ItemRef->CurrentValue);
			$this->ItemRef->EditValue = HtmlEncode($this->ItemRef->CurrentValue);
			$this->ItemRef->PlaceHolder = RemoveHtml($this->ItemRef->caption());

			// ItemLength
			$this->ItemLength->EditAttrs["class"] = "form-control";
			$this->ItemLength->EditCustomAttributes = "";
			$this->ItemLength->EditValue = HtmlEncode($this->ItemLength->CurrentValue);
			$this->ItemLength->PlaceHolder = RemoveHtml($this->ItemLength->caption());
			if (strval($this->ItemLength->EditValue) != "" && is_numeric($this->ItemLength->EditValue))
				$this->ItemLength->EditValue = FormatNumber($this->ItemLength->EditValue, -2, -1, -2, 0);
			

			// ItemWidth
			$this->ItemWidth->EditAttrs["class"] = "form-control";
			$this->ItemWidth->EditCustomAttributes = "";
			$this->ItemWidth->EditValue = HtmlEncode($this->ItemWidth->CurrentValue);
			$this->ItemWidth->PlaceHolder = RemoveHtml($this->ItemWidth->caption());
			if (strval($this->ItemWidth->EditValue) != "" && is_numeric($this->ItemWidth->EditValue))
				$this->ItemWidth->EditValue = FormatNumber($this->ItemWidth->EditValue, -2, -1, -2, 0);
			

			// DefaultFees
			$this->DefaultFees->EditAttrs["class"] = "form-control";
			$this->DefaultFees->EditCustomAttributes = "";
			$this->DefaultFees->EditValue = HtmlEncode($this->DefaultFees->CurrentValue);
			$this->DefaultFees->PlaceHolder = RemoveHtml($this->DefaultFees->caption());
			if (strval($this->DefaultFees->EditValue) != "" && is_numeric($this->DefaultFees->EditValue))
				$this->DefaultFees->EditValue = FormatNumber($this->DefaultFees->EditValue, -2, -1, -2, 0);
			

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
			// MarketNo

			$this->MarketNo->LinkCustomAttributes = "";
			$this->MarketNo->HrefValue = "";

			// ItemName
			$this->ItemName->LinkCustomAttributes = "";
			$this->ItemName->HrefValue = "";

			// ItemRef
			$this->ItemRef->LinkCustomAttributes = "";
			$this->ItemRef->HrefValue = "";

			// ItemLength
			$this->ItemLength->LinkCustomAttributes = "";
			$this->ItemLength->HrefValue = "";

			// ItemWidth
			$this->ItemWidth->LinkCustomAttributes = "";
			$this->ItemWidth->HrefValue = "";

			// DefaultFees
			$this->DefaultFees->LinkCustomAttributes = "";
			$this->DefaultFees->HrefValue = "";

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
		if ($this->MarketNo->Required) {
			if (!$this->MarketNo->IsDetailKey && $this->MarketNo->FormValue != NULL && $this->MarketNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MarketNo->caption(), $this->MarketNo->RequiredErrorMessage));
			}
		}
		if ($this->ItemName->Required) {
			if (!$this->ItemName->IsDetailKey && $this->ItemName->FormValue != NULL && $this->ItemName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemName->caption(), $this->ItemName->RequiredErrorMessage));
			}
		}
		if ($this->ItemRef->Required) {
			if (!$this->ItemRef->IsDetailKey && $this->ItemRef->FormValue != NULL && $this->ItemRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemRef->caption(), $this->ItemRef->RequiredErrorMessage));
			}
		}
		if ($this->ItemLength->Required) {
			if (!$this->ItemLength->IsDetailKey && $this->ItemLength->FormValue != NULL && $this->ItemLength->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemLength->caption(), $this->ItemLength->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ItemLength->FormValue)) {
			AddMessage($FormError, $this->ItemLength->errorMessage());
		}
		if ($this->ItemWidth->Required) {
			if (!$this->ItemWidth->IsDetailKey && $this->ItemWidth->FormValue != NULL && $this->ItemWidth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemWidth->caption(), $this->ItemWidth->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ItemWidth->FormValue)) {
			AddMessage($FormError, $this->ItemWidth->errorMessage());
		}
		if ($this->DefaultFees->Required) {
			if (!$this->DefaultFees->IsDetailKey && $this->DefaultFees->FormValue != NULL && $this->DefaultFees->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DefaultFees->caption(), $this->DefaultFees->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DefaultFees->FormValue)) {
			AddMessage($FormError, $this->DefaultFees->errorMessage());
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("market_trans", $detailTblVar) && $GLOBALS["market_trans"]->DetailAdd) {
			if (!isset($GLOBALS["market_trans_grid"]))
				$GLOBALS["market_trans_grid"] = new market_trans_grid(); // Get detail page object
			$GLOBALS["market_trans_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// MarketNo
		$this->MarketNo->setDbValueDef($rsnew, $this->MarketNo->CurrentValue, 0, FALSE);

		// ItemName
		$this->ItemName->setDbValueDef($rsnew, $this->ItemName->CurrentValue, "", FALSE);

		// ItemRef
		$this->ItemRef->setDbValueDef($rsnew, $this->ItemRef->CurrentValue, NULL, FALSE);

		// ItemLength
		$this->ItemLength->setDbValueDef($rsnew, $this->ItemLength->CurrentValue, NULL, FALSE);

		// ItemWidth
		$this->ItemWidth->setDbValueDef($rsnew, $this->ItemWidth->CurrentValue, NULL, FALSE);

		// DefaultFees
		$this->DefaultFees->setDbValueDef($rsnew, $this->DefaultFees->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("market_trans", $detailTblVar) && $GLOBALS["market_trans"]->DetailAdd) {
				$GLOBALS["market_trans"]->MarketItemNo->setSessionValue($this->MarketItemNo->CurrentValue); // Set master key
				if (!isset($GLOBALS["market_trans_grid"]))
					$GLOBALS["market_trans_grid"] = new market_trans_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "market_trans"); // Load user level of detail table
				$addRow = $GLOBALS["market_trans_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["market_trans"]->MarketItemNo->setSessionValue(""); // Clear master key if insert failed
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
			if ($masterTblVar == "market") {
				$validMaster = TRUE;
				if (($parm = Get("fk_MarketNo", Get("MarketNo"))) !== NULL) {
					$GLOBALS["market"]->MarketNo->setQueryStringValue($parm);
					$this->MarketNo->setQueryStringValue($GLOBALS["market"]->MarketNo->QueryStringValue);
					$this->MarketNo->setSessionValue($this->MarketNo->QueryStringValue);
					if (!is_numeric($GLOBALS["market"]->MarketNo->QueryStringValue))
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
			if ($masterTblVar == "market") {
				$validMaster = TRUE;
				if (($parm = Post("fk_MarketNo", Post("MarketNo"))) !== NULL) {
					$GLOBALS["market"]->MarketNo->setFormValue($parm);
					$this->MarketNo->setFormValue($GLOBALS["market"]->MarketNo->FormValue);
					$this->MarketNo->setSessionValue($this->MarketNo->FormValue);
					if (!is_numeric($GLOBALS["market"]->MarketNo->FormValue))
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
			if ($masterTblVar != "market") {
				if ($this->MarketNo->CurrentValue == "")
					$this->MarketNo->setSessionValue("");
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
			if (in_array("market_trans", $detailTblVar)) {
				if (!isset($GLOBALS["market_trans_grid"]))
					$GLOBALS["market_trans_grid"] = new market_trans_grid();
				if ($GLOBALS["market_trans_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["market_trans_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["market_trans_grid"]->CurrentMode = "add";
					$GLOBALS["market_trans_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["market_trans_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["market_trans_grid"]->setStartRecordNumber(1);
					$GLOBALS["market_trans_grid"]->MarketItemNo->IsDetailKey = TRUE;
					$GLOBALS["market_trans_grid"]->MarketItemNo->CurrentValue = $this->MarketItemNo->CurrentValue;
					$GLOBALS["market_trans_grid"]->MarketItemNo->setSessionValue($GLOBALS["market_trans_grid"]->MarketItemNo->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("market_propertylist.php"), "", $this->TableVar, TRUE);
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
				case "x_MarketNo":
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
						case "x_MarketNo":
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