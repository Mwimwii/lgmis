<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class business_add extends business
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'business';

	// Page object name
	public $PageObjName = "business_add";

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

		// Table object (business)
		if (!isset($GLOBALS["business"]) || get_class($GLOBALS["business"]) == PROJECT_NAMESPACE . "business") {
			$GLOBALS["business"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["business"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'business');

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
		global $business;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($business);
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
					if ($pageName == "businessview.php")
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
			$key .= @$ar['BusinessID'];
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
			$this->BusinessID->Visible = FALSE;
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
					$this->terminate(GetUrl("businesslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->BusinessID->Visible = FALSE;
		$this->PACRANo->setVisibility();
		$this->TPIN->setVisibility();
		$this->BusinessName->setVisibility();
		$this->ClientID->setVisibility();
		$this->BusinessSector->setVisibility();
		$this->BusinessType->setVisibility();
		$this->Location->setVisibility();
		$this->Turnover->setVisibility();
		$this->Branches->setVisibility();
		$this->NewImprovements->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->DateOpened->setVisibility();
		$this->BusinessDesc->setVisibility();
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
		$this->setupLookupOptions($this->ClientID);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("businesslist.php");
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
			if (Get("BusinessID") !== NULL) {
				$this->BusinessID->setQueryStringValue(Get("BusinessID"));
				$this->setKey("BusinessID", $this->BusinessID->CurrentValue); // Set up key
			} else {
				$this->setKey("BusinessID", ""); // Clear key
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
					$this->terminate("businesslist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "businesslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "businessview.php")
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
		$this->BusinessID->CurrentValue = NULL;
		$this->BusinessID->OldValue = $this->BusinessID->CurrentValue;
		$this->PACRANo->CurrentValue = NULL;
		$this->PACRANo->OldValue = $this->PACRANo->CurrentValue;
		$this->TPIN->CurrentValue = NULL;
		$this->TPIN->OldValue = $this->TPIN->CurrentValue;
		$this->BusinessName->CurrentValue = NULL;
		$this->BusinessName->OldValue = $this->BusinessName->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->BusinessSector->CurrentValue = 1;
		$this->BusinessType->CurrentValue = 1;
		$this->Location->CurrentValue = NULL;
		$this->Location->OldValue = $this->Location->CurrentValue;
		$this->Turnover->CurrentValue = 0;
		$this->Branches->CurrentValue = NULL;
		$this->Branches->OldValue = $this->Branches->CurrentValue;
		$this->NewImprovements->CurrentValue = NULL;
		$this->NewImprovements->OldValue = $this->NewImprovements->CurrentValue;
		$this->Longitude->CurrentValue = NULL;
		$this->Longitude->OldValue = $this->Longitude->CurrentValue;
		$this->Latitude->CurrentValue = NULL;
		$this->Latitude->OldValue = $this->Latitude->CurrentValue;
		$this->DateOpened->CurrentValue = NULL;
		$this->DateOpened->OldValue = $this->DateOpened->CurrentValue;
		$this->BusinessDesc->CurrentValue = NULL;
		$this->BusinessDesc->OldValue = $this->BusinessDesc->CurrentValue;
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

		// Check field name 'PACRANo' first before field var 'x_PACRANo'
		$val = $CurrentForm->hasValue("PACRANo") ? $CurrentForm->getValue("PACRANo") : $CurrentForm->getValue("x_PACRANo");
		if (!$this->PACRANo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PACRANo->Visible = FALSE; // Disable update for API request
			else
				$this->PACRANo->setFormValue($val);
		}

		// Check field name 'TPIN' first before field var 'x_TPIN'
		$val = $CurrentForm->hasValue("TPIN") ? $CurrentForm->getValue("TPIN") : $CurrentForm->getValue("x_TPIN");
		if (!$this->TPIN->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TPIN->Visible = FALSE; // Disable update for API request
			else
				$this->TPIN->setFormValue($val);
		}

		// Check field name 'BusinessName' first before field var 'x_BusinessName'
		$val = $CurrentForm->hasValue("BusinessName") ? $CurrentForm->getValue("BusinessName") : $CurrentForm->getValue("x_BusinessName");
		if (!$this->BusinessName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessName->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessName->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'BusinessSector' first before field var 'x_BusinessSector'
		$val = $CurrentForm->hasValue("BusinessSector") ? $CurrentForm->getValue("BusinessSector") : $CurrentForm->getValue("x_BusinessSector");
		if (!$this->BusinessSector->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessSector->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessSector->setFormValue($val);
		}

		// Check field name 'BusinessType' first before field var 'x_BusinessType'
		$val = $CurrentForm->hasValue("BusinessType") ? $CurrentForm->getValue("BusinessType") : $CurrentForm->getValue("x_BusinessType");
		if (!$this->BusinessType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessType->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessType->setFormValue($val);
		}

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}

		// Check field name 'Turnover' first before field var 'x_Turnover'
		$val = $CurrentForm->hasValue("Turnover") ? $CurrentForm->getValue("Turnover") : $CurrentForm->getValue("x_Turnover");
		if (!$this->Turnover->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Turnover->Visible = FALSE; // Disable update for API request
			else
				$this->Turnover->setFormValue($val);
		}

		// Check field name 'Branches' first before field var 'x_Branches'
		$val = $CurrentForm->hasValue("Branches") ? $CurrentForm->getValue("Branches") : $CurrentForm->getValue("x_Branches");
		if (!$this->Branches->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Branches->Visible = FALSE; // Disable update for API request
			else
				$this->Branches->setFormValue($val);
		}

		// Check field name 'NewImprovements' first before field var 'x_NewImprovements'
		$val = $CurrentForm->hasValue("NewImprovements") ? $CurrentForm->getValue("NewImprovements") : $CurrentForm->getValue("x_NewImprovements");
		if (!$this->NewImprovements->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewImprovements->Visible = FALSE; // Disable update for API request
			else
				$this->NewImprovements->setFormValue($val);
		}

		// Check field name 'Longitude' first before field var 'x_Longitude'
		$val = $CurrentForm->hasValue("Longitude") ? $CurrentForm->getValue("Longitude") : $CurrentForm->getValue("x_Longitude");
		if (!$this->Longitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Longitude->Visible = FALSE; // Disable update for API request
			else
				$this->Longitude->setFormValue($val);
		}

		// Check field name 'Latitude' first before field var 'x_Latitude'
		$val = $CurrentForm->hasValue("Latitude") ? $CurrentForm->getValue("Latitude") : $CurrentForm->getValue("x_Latitude");
		if (!$this->Latitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Latitude->Visible = FALSE; // Disable update for API request
			else
				$this->Latitude->setFormValue($val);
		}

		// Check field name 'DateOpened' first before field var 'x_DateOpened'
		$val = $CurrentForm->hasValue("DateOpened") ? $CurrentForm->getValue("DateOpened") : $CurrentForm->getValue("x_DateOpened");
		if (!$this->DateOpened->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOpened->Visible = FALSE; // Disable update for API request
			else
				$this->DateOpened->setFormValue($val);
			$this->DateOpened->CurrentValue = UnFormatDateTime($this->DateOpened->CurrentValue, 0);
		}

		// Check field name 'BusinessDesc' first before field var 'x_BusinessDesc'
		$val = $CurrentForm->hasValue("BusinessDesc") ? $CurrentForm->getValue("BusinessDesc") : $CurrentForm->getValue("x_BusinessDesc");
		if (!$this->BusinessDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessDesc->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessDesc->setFormValue($val);
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

		// Check field name 'BusinessID' first before field var 'x_BusinessID'
		$val = $CurrentForm->hasValue("BusinessID") ? $CurrentForm->getValue("BusinessID") : $CurrentForm->getValue("x_BusinessID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PACRANo->CurrentValue = $this->PACRANo->FormValue;
		$this->TPIN->CurrentValue = $this->TPIN->FormValue;
		$this->BusinessName->CurrentValue = $this->BusinessName->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->BusinessSector->CurrentValue = $this->BusinessSector->FormValue;
		$this->BusinessType->CurrentValue = $this->BusinessType->FormValue;
		$this->Location->CurrentValue = $this->Location->FormValue;
		$this->Turnover->CurrentValue = $this->Turnover->FormValue;
		$this->Branches->CurrentValue = $this->Branches->FormValue;
		$this->NewImprovements->CurrentValue = $this->NewImprovements->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->DateOpened->CurrentValue = $this->DateOpened->FormValue;
		$this->DateOpened->CurrentValue = UnFormatDateTime($this->DateOpened->CurrentValue, 0);
		$this->BusinessDesc->CurrentValue = $this->BusinessDesc->FormValue;
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
		$this->BusinessID->setDbValue($row['BusinessID']);
		$this->PACRANo->setDbValue($row['PACRANo']);
		$this->TPIN->setDbValue($row['TPIN']);
		$this->BusinessName->setDbValue($row['BusinessName']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->BusinessSector->setDbValue($row['BusinessSector']);
		$this->BusinessType->setDbValue($row['BusinessType']);
		$this->Location->setDbValue($row['Location']);
		$this->Turnover->setDbValue($row['Turnover']);
		$this->Branches->setDbValue($row['Branches']);
		$this->NewImprovements->setDbValue($row['NewImprovements']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->DateOpened->setDbValue($row['DateOpened']);
		$this->BusinessDesc->setDbValue($row['BusinessDesc']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['BusinessID'] = $this->BusinessID->CurrentValue;
		$row['PACRANo'] = $this->PACRANo->CurrentValue;
		$row['TPIN'] = $this->TPIN->CurrentValue;
		$row['BusinessName'] = $this->BusinessName->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['BusinessSector'] = $this->BusinessSector->CurrentValue;
		$row['BusinessType'] = $this->BusinessType->CurrentValue;
		$row['Location'] = $this->Location->CurrentValue;
		$row['Turnover'] = $this->Turnover->CurrentValue;
		$row['Branches'] = $this->Branches->CurrentValue;
		$row['NewImprovements'] = $this->NewImprovements->CurrentValue;
		$row['Longitude'] = $this->Longitude->CurrentValue;
		$row['Latitude'] = $this->Latitude->CurrentValue;
		$row['DateOpened'] = $this->DateOpened->CurrentValue;
		$row['BusinessDesc'] = $this->BusinessDesc->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BusinessID")) != "")
			$this->BusinessID->OldValue = $this->getKey("BusinessID"); // BusinessID
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

		if ($this->Turnover->FormValue == $this->Turnover->CurrentValue && is_numeric(ConvertToFloatString($this->Turnover->CurrentValue)))
			$this->Turnover->CurrentValue = ConvertToFloatString($this->Turnover->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// BusinessID
		// PACRANo
		// TPIN
		// BusinessName
		// ClientID
		// BusinessSector
		// BusinessType
		// Location
		// Turnover
		// Branches
		// NewImprovements
		// Longitude
		// Latitude
		// DateOpened
		// BusinessDesc
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// BusinessID
			$this->BusinessID->ViewValue = $this->BusinessID->CurrentValue;
			$this->BusinessID->ViewCustomAttributes = "";

			// PACRANo
			$this->PACRANo->ViewValue = $this->PACRANo->CurrentValue;
			$this->PACRANo->ViewCustomAttributes = "";

			// TPIN
			$this->TPIN->ViewValue = $this->TPIN->CurrentValue;
			$this->TPIN->ViewCustomAttributes = "";

			// BusinessName
			$this->BusinessName->ViewValue = $this->BusinessName->CurrentValue;
			$this->BusinessName->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$curVal = strval($this->ClientID->CurrentValue);
			if ($curVal != "") {
				$this->ClientID->ViewValue = $this->ClientID->lookupCacheOption($curVal);
				if ($this->ClientID->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ClientID->ViewValue = $this->ClientID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
					}
				}
			} else {
				$this->ClientID->ViewValue = NULL;
			}
			$this->ClientID->ViewCustomAttributes = "";

			// BusinessSector
			$this->BusinessSector->ViewValue = $this->BusinessSector->CurrentValue;
			$this->BusinessSector->ViewCustomAttributes = "";

			// BusinessType
			$this->BusinessType->ViewValue = $this->BusinessType->CurrentValue;
			$this->BusinessType->ViewCustomAttributes = "";

			// Location
			$this->Location->ViewValue = $this->Location->CurrentValue;
			$this->Location->ViewCustomAttributes = "";

			// Turnover
			$this->Turnover->ViewValue = $this->Turnover->CurrentValue;
			$this->Turnover->ViewValue = FormatNumber($this->Turnover->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Turnover->ViewCustomAttributes = "";

			// Branches
			$this->Branches->ViewValue = $this->Branches->CurrentValue;
			$this->Branches->ViewCustomAttributes = "";

			// NewImprovements
			$this->NewImprovements->ViewValue = $this->NewImprovements->CurrentValue;
			$this->NewImprovements->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Longitude->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Latitude->ViewCustomAttributes = "";

			// DateOpened
			$this->DateOpened->ViewValue = $this->DateOpened->CurrentValue;
			$this->DateOpened->ViewValue = FormatDateTime($this->DateOpened->ViewValue, 0);
			$this->DateOpened->ViewCustomAttributes = "";

			// BusinessDesc
			$this->BusinessDesc->ViewValue = $this->BusinessDesc->CurrentValue;
			$this->BusinessDesc->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// PACRANo
			$this->PACRANo->LinkCustomAttributes = "";
			$this->PACRANo->HrefValue = "";
			$this->PACRANo->TooltipValue = "";

			// TPIN
			$this->TPIN->LinkCustomAttributes = "";
			$this->TPIN->HrefValue = "";
			$this->TPIN->TooltipValue = "";

			// BusinessName
			$this->BusinessName->LinkCustomAttributes = "";
			$this->BusinessName->HrefValue = "";
			$this->BusinessName->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// BusinessSector
			$this->BusinessSector->LinkCustomAttributes = "";
			$this->BusinessSector->HrefValue = "";
			$this->BusinessSector->TooltipValue = "";

			// BusinessType
			$this->BusinessType->LinkCustomAttributes = "";
			$this->BusinessType->HrefValue = "";
			$this->BusinessType->TooltipValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";

			// Turnover
			$this->Turnover->LinkCustomAttributes = "";
			$this->Turnover->HrefValue = "";
			$this->Turnover->TooltipValue = "";

			// Branches
			$this->Branches->LinkCustomAttributes = "";
			$this->Branches->HrefValue = "";
			$this->Branches->TooltipValue = "";

			// NewImprovements
			$this->NewImprovements->LinkCustomAttributes = "";
			$this->NewImprovements->HrefValue = "";
			$this->NewImprovements->TooltipValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";

			// DateOpened
			$this->DateOpened->LinkCustomAttributes = "";
			$this->DateOpened->HrefValue = "";
			$this->DateOpened->TooltipValue = "";

			// BusinessDesc
			$this->BusinessDesc->LinkCustomAttributes = "";
			$this->BusinessDesc->HrefValue = "";
			$this->BusinessDesc->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// PACRANo
			$this->PACRANo->EditAttrs["class"] = "form-control";
			$this->PACRANo->EditCustomAttributes = "";
			$this->PACRANo->EditValue = HtmlEncode($this->PACRANo->CurrentValue);
			$this->PACRANo->PlaceHolder = RemoveHtml($this->PACRANo->caption());

			// TPIN
			$this->TPIN->EditAttrs["class"] = "form-control";
			$this->TPIN->EditCustomAttributes = "";
			$this->TPIN->EditValue = HtmlEncode($this->TPIN->CurrentValue);
			$this->TPIN->PlaceHolder = RemoveHtml($this->TPIN->caption());

			// BusinessName
			$this->BusinessName->EditAttrs["class"] = "form-control";
			$this->BusinessName->EditCustomAttributes = "";
			if (!$this->BusinessName->Raw)
				$this->BusinessName->CurrentValue = HtmlDecode($this->BusinessName->CurrentValue);
			$this->BusinessName->EditValue = HtmlEncode($this->BusinessName->CurrentValue);
			$this->BusinessName->PlaceHolder = RemoveHtml($this->BusinessName->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$curVal = strval($this->ClientID->CurrentValue);
			if ($curVal != "") {
				$this->ClientID->EditValue = $this->ClientID->lookupCacheOption($curVal);
				if ($this->ClientID->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ClientID->EditValue = $this->ClientID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
					}
				}
			} else {
				$this->ClientID->EditValue = NULL;
			}
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// BusinessSector
			$this->BusinessSector->EditAttrs["class"] = "form-control";
			$this->BusinessSector->EditCustomAttributes = "";
			$this->BusinessSector->EditValue = HtmlEncode($this->BusinessSector->CurrentValue);
			$this->BusinessSector->PlaceHolder = RemoveHtml($this->BusinessSector->caption());

			// BusinessType
			$this->BusinessType->EditAttrs["class"] = "form-control";
			$this->BusinessType->EditCustomAttributes = "";
			$this->BusinessType->EditValue = HtmlEncode($this->BusinessType->CurrentValue);
			$this->BusinessType->PlaceHolder = RemoveHtml($this->BusinessType->caption());

			// Location
			$this->Location->EditAttrs["class"] = "form-control";
			$this->Location->EditCustomAttributes = "";
			if (!$this->Location->Raw)
				$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
			$this->Location->EditValue = HtmlEncode($this->Location->CurrentValue);
			$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

			// Turnover
			$this->Turnover->EditAttrs["class"] = "form-control";
			$this->Turnover->EditCustomAttributes = "";
			$this->Turnover->EditValue = HtmlEncode($this->Turnover->CurrentValue);
			$this->Turnover->PlaceHolder = RemoveHtml($this->Turnover->caption());
			if (strval($this->Turnover->EditValue) != "" && is_numeric($this->Turnover->EditValue))
				$this->Turnover->EditValue = FormatNumber($this->Turnover->EditValue, -2, -1, -2, 0);
			

			// Branches
			$this->Branches->EditAttrs["class"] = "form-control";
			$this->Branches->EditCustomAttributes = "";
			if (!$this->Branches->Raw)
				$this->Branches->CurrentValue = HtmlDecode($this->Branches->CurrentValue);
			$this->Branches->EditValue = HtmlEncode($this->Branches->CurrentValue);
			$this->Branches->PlaceHolder = RemoveHtml($this->Branches->caption());

			// NewImprovements
			$this->NewImprovements->EditAttrs["class"] = "form-control";
			$this->NewImprovements->EditCustomAttributes = "";
			$this->NewImprovements->EditValue = HtmlEncode($this->NewImprovements->CurrentValue);
			$this->NewImprovements->PlaceHolder = RemoveHtml($this->NewImprovements->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
			

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
			

			// DateOpened
			$this->DateOpened->EditAttrs["class"] = "form-control";
			$this->DateOpened->EditCustomAttributes = "";
			$this->DateOpened->EditValue = HtmlEncode(FormatDateTime($this->DateOpened->CurrentValue, 8));
			$this->DateOpened->PlaceHolder = RemoveHtml($this->DateOpened->caption());

			// BusinessDesc
			$this->BusinessDesc->EditAttrs["class"] = "form-control";
			$this->BusinessDesc->EditCustomAttributes = "";
			$this->BusinessDesc->EditValue = HtmlEncode($this->BusinessDesc->CurrentValue);
			$this->BusinessDesc->PlaceHolder = RemoveHtml($this->BusinessDesc->caption());

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
			// PACRANo

			$this->PACRANo->LinkCustomAttributes = "";
			$this->PACRANo->HrefValue = "";

			// TPIN
			$this->TPIN->LinkCustomAttributes = "";
			$this->TPIN->HrefValue = "";

			// BusinessName
			$this->BusinessName->LinkCustomAttributes = "";
			$this->BusinessName->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// BusinessSector
			$this->BusinessSector->LinkCustomAttributes = "";
			$this->BusinessSector->HrefValue = "";

			// BusinessType
			$this->BusinessType->LinkCustomAttributes = "";
			$this->BusinessType->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// Turnover
			$this->Turnover->LinkCustomAttributes = "";
			$this->Turnover->HrefValue = "";

			// Branches
			$this->Branches->LinkCustomAttributes = "";
			$this->Branches->HrefValue = "";

			// NewImprovements
			$this->NewImprovements->LinkCustomAttributes = "";
			$this->NewImprovements->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// DateOpened
			$this->DateOpened->LinkCustomAttributes = "";
			$this->DateOpened->HrefValue = "";

			// BusinessDesc
			$this->BusinessDesc->LinkCustomAttributes = "";
			$this->BusinessDesc->HrefValue = "";

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
		if ($this->PACRANo->Required) {
			if (!$this->PACRANo->IsDetailKey && $this->PACRANo->FormValue != NULL && $this->PACRANo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PACRANo->caption(), $this->PACRANo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PACRANo->FormValue)) {
			AddMessage($FormError, $this->PACRANo->errorMessage());
		}
		if ($this->TPIN->Required) {
			if (!$this->TPIN->IsDetailKey && $this->TPIN->FormValue != NULL && $this->TPIN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TPIN->caption(), $this->TPIN->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TPIN->FormValue)) {
			AddMessage($FormError, $this->TPIN->errorMessage());
		}
		if ($this->BusinessName->Required) {
			if (!$this->BusinessName->IsDetailKey && $this->BusinessName->FormValue != NULL && $this->BusinessName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessName->caption(), $this->BusinessName->RequiredErrorMessage));
			}
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->BusinessSector->Required) {
			if (!$this->BusinessSector->IsDetailKey && $this->BusinessSector->FormValue != NULL && $this->BusinessSector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessSector->caption(), $this->BusinessSector->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BusinessSector->FormValue)) {
			AddMessage($FormError, $this->BusinessSector->errorMessage());
		}
		if ($this->BusinessType->Required) {
			if (!$this->BusinessType->IsDetailKey && $this->BusinessType->FormValue != NULL && $this->BusinessType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessType->caption(), $this->BusinessType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BusinessType->FormValue)) {
			AddMessage($FormError, $this->BusinessType->errorMessage());
		}
		if ($this->Location->Required) {
			if (!$this->Location->IsDetailKey && $this->Location->FormValue != NULL && $this->Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Location->caption(), $this->Location->RequiredErrorMessage));
			}
		}
		if ($this->Turnover->Required) {
			if (!$this->Turnover->IsDetailKey && $this->Turnover->FormValue != NULL && $this->Turnover->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Turnover->caption(), $this->Turnover->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Turnover->FormValue)) {
			AddMessage($FormError, $this->Turnover->errorMessage());
		}
		if ($this->Branches->Required) {
			if (!$this->Branches->IsDetailKey && $this->Branches->FormValue != NULL && $this->Branches->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Branches->caption(), $this->Branches->RequiredErrorMessage));
			}
		}
		if ($this->NewImprovements->Required) {
			if (!$this->NewImprovements->IsDetailKey && $this->NewImprovements->FormValue != NULL && $this->NewImprovements->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewImprovements->caption(), $this->NewImprovements->RequiredErrorMessage));
			}
		}
		if ($this->Longitude->Required) {
			if (!$this->Longitude->IsDetailKey && $this->Longitude->FormValue != NULL && $this->Longitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Longitude->caption(), $this->Longitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Longitude->FormValue)) {
			AddMessage($FormError, $this->Longitude->errorMessage());
		}
		if ($this->Latitude->Required) {
			if (!$this->Latitude->IsDetailKey && $this->Latitude->FormValue != NULL && $this->Latitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Latitude->caption(), $this->Latitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Latitude->FormValue)) {
			AddMessage($FormError, $this->Latitude->errorMessage());
		}
		if ($this->DateOpened->Required) {
			if (!$this->DateOpened->IsDetailKey && $this->DateOpened->FormValue != NULL && $this->DateOpened->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOpened->caption(), $this->DateOpened->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOpened->FormValue)) {
			AddMessage($FormError, $this->DateOpened->errorMessage());
		}
		if ($this->BusinessDesc->Required) {
			if (!$this->BusinessDesc->IsDetailKey && $this->BusinessDesc->FormValue != NULL && $this->BusinessDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessDesc->caption(), $this->BusinessDesc->RequiredErrorMessage));
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("licence_account", $detailTblVar) && $GLOBALS["licence_account"]->DetailAdd) {
			if (!isset($GLOBALS["licence_account_grid"]))
				$GLOBALS["licence_account_grid"] = new licence_account_grid(); // Get detail page object
			$GLOBALS["licence_account_grid"]->validateGridForm();
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

		// PACRANo
		$this->PACRANo->setDbValueDef($rsnew, $this->PACRANo->CurrentValue, 0, FALSE);

		// TPIN
		$this->TPIN->setDbValueDef($rsnew, $this->TPIN->CurrentValue, NULL, FALSE);

		// BusinessName
		$this->BusinessName->setDbValueDef($rsnew, $this->BusinessName->CurrentValue, NULL, FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// BusinessSector
		$this->BusinessSector->setDbValueDef($rsnew, $this->BusinessSector->CurrentValue, NULL, strval($this->BusinessSector->CurrentValue) == "");

		// BusinessType
		$this->BusinessType->setDbValueDef($rsnew, $this->BusinessType->CurrentValue, NULL, strval($this->BusinessType->CurrentValue) == "");

		// Location
		$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, NULL, FALSE);

		// Turnover
		$this->Turnover->setDbValueDef($rsnew, $this->Turnover->CurrentValue, NULL, strval($this->Turnover->CurrentValue) == "");

		// Branches
		$this->Branches->setDbValueDef($rsnew, $this->Branches->CurrentValue, NULL, FALSE);

		// NewImprovements
		$this->NewImprovements->setDbValueDef($rsnew, $this->NewImprovements->CurrentValue, NULL, FALSE);

		// Longitude
		$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, FALSE);

		// Latitude
		$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, FALSE);

		// DateOpened
		$this->DateOpened->setDbValueDef($rsnew, UnFormatDateTime($this->DateOpened->CurrentValue, 0), NULL, FALSE);

		// BusinessDesc
		$this->BusinessDesc->setDbValueDef($rsnew, $this->BusinessDesc->CurrentValue, NULL, FALSE);

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
			if (in_array("licence_account", $detailTblVar) && $GLOBALS["licence_account"]->DetailAdd) {
				$GLOBALS["licence_account"]->BusinessNo->setSessionValue($this->BusinessID->CurrentValue); // Set master key
				if (!isset($GLOBALS["licence_account_grid"]))
					$GLOBALS["licence_account_grid"] = new licence_account_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "licence_account"); // Load user level of detail table
				$addRow = $GLOBALS["licence_account_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["licence_account"]->BusinessNo->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("licence_account", $detailTblVar)) {
				if (!isset($GLOBALS["licence_account_grid"]))
					$GLOBALS["licence_account_grid"] = new licence_account_grid();
				if ($GLOBALS["licence_account_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["licence_account_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["licence_account_grid"]->CurrentMode = "add";
					$GLOBALS["licence_account_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["licence_account_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["licence_account_grid"]->setStartRecordNumber(1);
					$GLOBALS["licence_account_grid"]->BusinessNo->IsDetailKey = TRUE;
					$GLOBALS["licence_account_grid"]->BusinessNo->CurrentValue = $this->BusinessID->CurrentValue;
					$GLOBALS["licence_account_grid"]->BusinessNo->setSessionValue($GLOBALS["licence_account_grid"]->BusinessNo->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("businesslist.php"), "", $this->TableVar, TRUE);
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
				case "x_ClientID":
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
						case "x_ClientID":
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