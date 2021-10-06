<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class property_valuation_roll_add extends property_valuation_roll
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'property_valuation_roll';

	// Page object name
	public $PageObjName = "property_valuation_roll_add";

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

		// Table object (property_valuation_roll)
		if (!isset($GLOBALS["property_valuation_roll"]) || get_class($GLOBALS["property_valuation_roll"]) == PROJECT_NAMESPACE . "property_valuation_roll") {
			$GLOBALS["property_valuation_roll"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["property_valuation_roll"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'property_valuation_roll');

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
		global $property_valuation_roll;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($property_valuation_roll);
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
					if ($pageName == "property_valuation_rollview.php")
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
			$key .= @$ar['ValuationNo'];
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
			$this->ValuationNo->Visible = FALSE;
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
					$this->terminate(GetUrl("property_valuation_rolllist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ValuationNo->Visible = FALSE;
		$this->PropertyNo->setVisibility();
		$this->StandNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->PropertyGroup->setVisibility();
		$this->PropertyType->setVisibility();
		$this->Location->setVisibility();
		$this->RollStatus->setVisibility();
		$this->UseCode->setVisibility();
		$this->AreaOfLand->setVisibility();
		$this->AreaCode->setVisibility();
		$this->SiteNumber->setVisibility();
		$this->RateableValue->setVisibility();
		$this->NewRateableValue->setVisibility();
		$this->ExemptCode->setVisibility();
		$this->Improvements->setVisibility();
		$this->NewImprovements->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->PropertyPhoto->setVisibility();
		$this->DateEvaluated->setVisibility();
		$this->Objections->setVisibility();
		$this->DateEntered->setVisibility();
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
			$this->terminate("property_valuation_rolllist.php");
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
			if (Get("ValuationNo") !== NULL) {
				$this->ValuationNo->setQueryStringValue(Get("ValuationNo"));
				$this->setKey("ValuationNo", $this->ValuationNo->CurrentValue); // Set up key
			} else {
				$this->setKey("ValuationNo", ""); // Clear key
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
					$this->terminate("property_valuation_rolllist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "property_valuation_rolllist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "property_valuation_rollview.php")
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
		$this->PropertyPhoto->Upload->Index = $CurrentForm->Index;
		$this->PropertyPhoto->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ValuationNo->CurrentValue = NULL;
		$this->ValuationNo->OldValue = $this->ValuationNo->CurrentValue;
		$this->PropertyNo->CurrentValue = NULL;
		$this->PropertyNo->OldValue = $this->PropertyNo->CurrentValue;
		$this->StandNo->CurrentValue = NULL;
		$this->StandNo->OldValue = $this->StandNo->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->PropertyGroup->CurrentValue = 1;
		$this->PropertyType->CurrentValue = 1;
		$this->Location->CurrentValue = NULL;
		$this->Location->OldValue = $this->Location->CurrentValue;
		$this->RollStatus->CurrentValue = 1;
		$this->UseCode->CurrentValue = 1;
		$this->AreaOfLand->CurrentValue = 0;
		$this->AreaCode->CurrentValue = NULL;
		$this->AreaCode->OldValue = $this->AreaCode->CurrentValue;
		$this->SiteNumber->CurrentValue = NULL;
		$this->SiteNumber->OldValue = $this->SiteNumber->CurrentValue;
		$this->RateableValue->CurrentValue = 0;
		$this->NewRateableValue->CurrentValue = 0;
		$this->ExemptCode->CurrentValue = 0;
		$this->Improvements->CurrentValue = NULL;
		$this->Improvements->OldValue = $this->Improvements->CurrentValue;
		$this->NewImprovements->CurrentValue = NULL;
		$this->NewImprovements->OldValue = $this->NewImprovements->CurrentValue;
		$this->Longitude->CurrentValue = NULL;
		$this->Longitude->OldValue = $this->Longitude->CurrentValue;
		$this->Latitude->CurrentValue = NULL;
		$this->Latitude->OldValue = $this->Latitude->CurrentValue;
		$this->PropertyPhoto->Upload->DbValue = NULL;
		$this->PropertyPhoto->OldValue = $this->PropertyPhoto->Upload->DbValue;
		$this->DateEvaluated->CurrentValue = NULL;
		$this->DateEvaluated->OldValue = $this->DateEvaluated->CurrentValue;
		$this->Objections->CurrentValue = NULL;
		$this->Objections->OldValue = $this->Objections->CurrentValue;
		$this->DateEntered->CurrentValue = NULL;
		$this->DateEntered->OldValue = $this->DateEntered->CurrentValue;
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

		// Check field name 'PropertyNo' first before field var 'x_PropertyNo'
		$val = $CurrentForm->hasValue("PropertyNo") ? $CurrentForm->getValue("PropertyNo") : $CurrentForm->getValue("x_PropertyNo");
		if (!$this->PropertyNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyNo->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyNo->setFormValue($val);
		}

		// Check field name 'StandNo' first before field var 'x_StandNo'
		$val = $CurrentForm->hasValue("StandNo") ? $CurrentForm->getValue("StandNo") : $CurrentForm->getValue("x_StandNo");
		if (!$this->StandNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StandNo->Visible = FALSE; // Disable update for API request
			else
				$this->StandNo->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'PropertyGroup' first before field var 'x_PropertyGroup'
		$val = $CurrentForm->hasValue("PropertyGroup") ? $CurrentForm->getValue("PropertyGroup") : $CurrentForm->getValue("x_PropertyGroup");
		if (!$this->PropertyGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyGroup->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyGroup->setFormValue($val);
		}

		// Check field name 'PropertyType' first before field var 'x_PropertyType'
		$val = $CurrentForm->hasValue("PropertyType") ? $CurrentForm->getValue("PropertyType") : $CurrentForm->getValue("x_PropertyType");
		if (!$this->PropertyType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyType->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyType->setFormValue($val);
		}

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}

		// Check field name 'RollStatus' first before field var 'x_RollStatus'
		$val = $CurrentForm->hasValue("RollStatus") ? $CurrentForm->getValue("RollStatus") : $CurrentForm->getValue("x_RollStatus");
		if (!$this->RollStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RollStatus->Visible = FALSE; // Disable update for API request
			else
				$this->RollStatus->setFormValue($val);
		}

		// Check field name 'UseCode' first before field var 'x_UseCode'
		$val = $CurrentForm->hasValue("UseCode") ? $CurrentForm->getValue("UseCode") : $CurrentForm->getValue("x_UseCode");
		if (!$this->UseCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UseCode->Visible = FALSE; // Disable update for API request
			else
				$this->UseCode->setFormValue($val);
		}

		// Check field name 'AreaOfLand' first before field var 'x_AreaOfLand'
		$val = $CurrentForm->hasValue("AreaOfLand") ? $CurrentForm->getValue("AreaOfLand") : $CurrentForm->getValue("x_AreaOfLand");
		if (!$this->AreaOfLand->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AreaOfLand->Visible = FALSE; // Disable update for API request
			else
				$this->AreaOfLand->setFormValue($val);
		}

		// Check field name 'AreaCode' first before field var 'x_AreaCode'
		$val = $CurrentForm->hasValue("AreaCode") ? $CurrentForm->getValue("AreaCode") : $CurrentForm->getValue("x_AreaCode");
		if (!$this->AreaCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AreaCode->Visible = FALSE; // Disable update for API request
			else
				$this->AreaCode->setFormValue($val);
		}

		// Check field name 'SiteNumber' first before field var 'x_SiteNumber'
		$val = $CurrentForm->hasValue("SiteNumber") ? $CurrentForm->getValue("SiteNumber") : $CurrentForm->getValue("x_SiteNumber");
		if (!$this->SiteNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SiteNumber->Visible = FALSE; // Disable update for API request
			else
				$this->SiteNumber->setFormValue($val);
		}

		// Check field name 'RateableValue' first before field var 'x_RateableValue'
		$val = $CurrentForm->hasValue("RateableValue") ? $CurrentForm->getValue("RateableValue") : $CurrentForm->getValue("x_RateableValue");
		if (!$this->RateableValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RateableValue->Visible = FALSE; // Disable update for API request
			else
				$this->RateableValue->setFormValue($val);
		}

		// Check field name 'NewRateableValue' first before field var 'x_NewRateableValue'
		$val = $CurrentForm->hasValue("NewRateableValue") ? $CurrentForm->getValue("NewRateableValue") : $CurrentForm->getValue("x_NewRateableValue");
		if (!$this->NewRateableValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewRateableValue->Visible = FALSE; // Disable update for API request
			else
				$this->NewRateableValue->setFormValue($val);
		}

		// Check field name 'ExemptCode' first before field var 'x_ExemptCode'
		$val = $CurrentForm->hasValue("ExemptCode") ? $CurrentForm->getValue("ExemptCode") : $CurrentForm->getValue("x_ExemptCode");
		if (!$this->ExemptCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExemptCode->Visible = FALSE; // Disable update for API request
			else
				$this->ExemptCode->setFormValue($val);
		}

		// Check field name 'Improvements' first before field var 'x_Improvements'
		$val = $CurrentForm->hasValue("Improvements") ? $CurrentForm->getValue("Improvements") : $CurrentForm->getValue("x_Improvements");
		if (!$this->Improvements->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Improvements->Visible = FALSE; // Disable update for API request
			else
				$this->Improvements->setFormValue($val);
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

		// Check field name 'DateEvaluated' first before field var 'x_DateEvaluated'
		$val = $CurrentForm->hasValue("DateEvaluated") ? $CurrentForm->getValue("DateEvaluated") : $CurrentForm->getValue("x_DateEvaluated");
		if (!$this->DateEvaluated->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateEvaluated->Visible = FALSE; // Disable update for API request
			else
				$this->DateEvaluated->setFormValue($val);
			$this->DateEvaluated->CurrentValue = UnFormatDateTime($this->DateEvaluated->CurrentValue, 0);
		}

		// Check field name 'Objections' first before field var 'x_Objections'
		$val = $CurrentForm->hasValue("Objections") ? $CurrentForm->getValue("Objections") : $CurrentForm->getValue("x_Objections");
		if (!$this->Objections->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Objections->Visible = FALSE; // Disable update for API request
			else
				$this->Objections->setFormValue($val);
		}

		// Check field name 'DateEntered' first before field var 'x_DateEntered'
		$val = $CurrentForm->hasValue("DateEntered") ? $CurrentForm->getValue("DateEntered") : $CurrentForm->getValue("x_DateEntered");
		if (!$this->DateEntered->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateEntered->Visible = FALSE; // Disable update for API request
			else
				$this->DateEntered->setFormValue($val);
			$this->DateEntered->CurrentValue = UnFormatDateTime($this->DateEntered->CurrentValue, 0);
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

		// Check field name 'ValuationNo' first before field var 'x_ValuationNo'
		$val = $CurrentForm->hasValue("ValuationNo") ? $CurrentForm->getValue("ValuationNo") : $CurrentForm->getValue("x_ValuationNo");
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PropertyNo->CurrentValue = $this->PropertyNo->FormValue;
		$this->StandNo->CurrentValue = $this->StandNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->PropertyGroup->CurrentValue = $this->PropertyGroup->FormValue;
		$this->PropertyType->CurrentValue = $this->PropertyType->FormValue;
		$this->Location->CurrentValue = $this->Location->FormValue;
		$this->RollStatus->CurrentValue = $this->RollStatus->FormValue;
		$this->UseCode->CurrentValue = $this->UseCode->FormValue;
		$this->AreaOfLand->CurrentValue = $this->AreaOfLand->FormValue;
		$this->AreaCode->CurrentValue = $this->AreaCode->FormValue;
		$this->SiteNumber->CurrentValue = $this->SiteNumber->FormValue;
		$this->RateableValue->CurrentValue = $this->RateableValue->FormValue;
		$this->NewRateableValue->CurrentValue = $this->NewRateableValue->FormValue;
		$this->ExemptCode->CurrentValue = $this->ExemptCode->FormValue;
		$this->Improvements->CurrentValue = $this->Improvements->FormValue;
		$this->NewImprovements->CurrentValue = $this->NewImprovements->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->DateEvaluated->CurrentValue = $this->DateEvaluated->FormValue;
		$this->DateEvaluated->CurrentValue = UnFormatDateTime($this->DateEvaluated->CurrentValue, 0);
		$this->Objections->CurrentValue = $this->Objections->FormValue;
		$this->DateEntered->CurrentValue = $this->DateEntered->FormValue;
		$this->DateEntered->CurrentValue = UnFormatDateTime($this->DateEntered->CurrentValue, 0);
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
		$this->ValuationNo->setDbValue($row['ValuationNo']);
		$this->PropertyNo->setDbValue($row['PropertyNo']);
		$this->StandNo->setDbValue($row['StandNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PropertyGroup->setDbValue($row['PropertyGroup']);
		$this->PropertyType->setDbValue($row['PropertyType']);
		$this->Location->setDbValue($row['Location']);
		$this->RollStatus->setDbValue($row['RollStatus']);
		$this->UseCode->setDbValue($row['UseCode']);
		$this->AreaOfLand->setDbValue($row['AreaOfLand']);
		$this->AreaCode->setDbValue($row['AreaCode']);
		$this->SiteNumber->setDbValue($row['SiteNumber']);
		$this->RateableValue->setDbValue($row['RateableValue']);
		$this->NewRateableValue->setDbValue($row['NewRateableValue']);
		$this->ExemptCode->setDbValue($row['ExemptCode']);
		$this->Improvements->setDbValue($row['Improvements']);
		$this->NewImprovements->setDbValue($row['NewImprovements']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->PropertyPhoto->Upload->DbValue = $row['PropertyPhoto'];
		if (is_array($this->PropertyPhoto->Upload->DbValue) || is_object($this->PropertyPhoto->Upload->DbValue)) // Byte array
			$this->PropertyPhoto->Upload->DbValue = BytesToString($this->PropertyPhoto->Upload->DbValue);
		$this->DateEvaluated->setDbValue($row['DateEvaluated']);
		$this->Objections->setDbValue($row['Objections']);
		$this->DateEntered->setDbValue($row['DateEntered']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ValuationNo'] = $this->ValuationNo->CurrentValue;
		$row['PropertyNo'] = $this->PropertyNo->CurrentValue;
		$row['StandNo'] = $this->StandNo->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['PropertyGroup'] = $this->PropertyGroup->CurrentValue;
		$row['PropertyType'] = $this->PropertyType->CurrentValue;
		$row['Location'] = $this->Location->CurrentValue;
		$row['RollStatus'] = $this->RollStatus->CurrentValue;
		$row['UseCode'] = $this->UseCode->CurrentValue;
		$row['AreaOfLand'] = $this->AreaOfLand->CurrentValue;
		$row['AreaCode'] = $this->AreaCode->CurrentValue;
		$row['SiteNumber'] = $this->SiteNumber->CurrentValue;
		$row['RateableValue'] = $this->RateableValue->CurrentValue;
		$row['NewRateableValue'] = $this->NewRateableValue->CurrentValue;
		$row['ExemptCode'] = $this->ExemptCode->CurrentValue;
		$row['Improvements'] = $this->Improvements->CurrentValue;
		$row['NewImprovements'] = $this->NewImprovements->CurrentValue;
		$row['Longitude'] = $this->Longitude->CurrentValue;
		$row['Latitude'] = $this->Latitude->CurrentValue;
		$row['PropertyPhoto'] = $this->PropertyPhoto->Upload->DbValue;
		$row['DateEvaluated'] = $this->DateEvaluated->CurrentValue;
		$row['Objections'] = $this->Objections->CurrentValue;
		$row['DateEntered'] = $this->DateEntered->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ValuationNo")) != "")
			$this->ValuationNo->OldValue = $this->getKey("ValuationNo"); // ValuationNo
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

		if ($this->AreaOfLand->FormValue == $this->AreaOfLand->CurrentValue && is_numeric(ConvertToFloatString($this->AreaOfLand->CurrentValue)))
			$this->AreaOfLand->CurrentValue = ConvertToFloatString($this->AreaOfLand->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RateableValue->FormValue == $this->RateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->RateableValue->CurrentValue)))
			$this->RateableValue->CurrentValue = ConvertToFloatString($this->RateableValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->NewRateableValue->FormValue == $this->NewRateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->NewRateableValue->CurrentValue)))
			$this->NewRateableValue->CurrentValue = ConvertToFloatString($this->NewRateableValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ValuationNo
		// PropertyNo
		// StandNo
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// RollStatus
		// UseCode
		// AreaOfLand
		// AreaCode
		// SiteNumber
		// RateableValue
		// NewRateableValue
		// ExemptCode
		// Improvements
		// NewImprovements
		// Longitude
		// Latitude
		// PropertyPhoto
		// DateEvaluated
		// Objections
		// DateEntered
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ValuationNo
			$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
			$this->ValuationNo->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
			$this->PropertyNo->ViewCustomAttributes = "";

			// StandNo
			$this->StandNo->ViewValue = $this->StandNo->CurrentValue;
			$this->StandNo->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// PropertyGroup
			$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
			$this->PropertyGroup->ViewCustomAttributes = "";

			// PropertyType
			$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
			$this->PropertyType->ViewCustomAttributes = "";

			// Location
			$this->Location->ViewValue = $this->Location->CurrentValue;
			$this->Location->ViewCustomAttributes = "";

			// RollStatus
			$this->RollStatus->ViewValue = $this->RollStatus->CurrentValue;
			$this->RollStatus->ViewCustomAttributes = "";

			// UseCode
			$this->UseCode->ViewValue = $this->UseCode->CurrentValue;
			$this->UseCode->ViewCustomAttributes = "";

			// AreaOfLand
			$this->AreaOfLand->ViewValue = $this->AreaOfLand->CurrentValue;
			$this->AreaOfLand->ViewValue = FormatNumber($this->AreaOfLand->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AreaOfLand->ViewCustomAttributes = "";

			// AreaCode
			$this->AreaCode->ViewValue = $this->AreaCode->CurrentValue;
			$this->AreaCode->ViewCustomAttributes = "";

			// SiteNumber
			$this->SiteNumber->ViewValue = $this->SiteNumber->CurrentValue;
			$this->SiteNumber->ViewCustomAttributes = "";

			// RateableValue
			$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
			$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->RateableValue->ViewCustomAttributes = "";

			// NewRateableValue
			$this->NewRateableValue->ViewValue = $this->NewRateableValue->CurrentValue;
			$this->NewRateableValue->ViewValue = FormatNumber($this->NewRateableValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->NewRateableValue->ViewCustomAttributes = "";

			// ExemptCode
			$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
			$this->ExemptCode->ViewCustomAttributes = "";

			// Improvements
			$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
			$this->Improvements->ViewCustomAttributes = "";

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

			// PropertyPhoto
			if (!EmptyValue($this->PropertyPhoto->Upload->DbValue)) {
				$this->PropertyPhoto->ViewValue = $this->ValuationNo->CurrentValue;
				$this->PropertyPhoto->IsBlobImage = IsImageFile(ContentExtension($this->PropertyPhoto->Upload->DbValue));
			} else {
				$this->PropertyPhoto->ViewValue = "";
			}
			$this->PropertyPhoto->ViewCustomAttributes = "";

			// DateEvaluated
			$this->DateEvaluated->ViewValue = $this->DateEvaluated->CurrentValue;
			$this->DateEvaluated->ViewValue = FormatDateTime($this->DateEvaluated->ViewValue, 0);
			$this->DateEvaluated->ViewCustomAttributes = "";

			// Objections
			$this->Objections->ViewValue = $this->Objections->CurrentValue;
			$this->Objections->ViewCustomAttributes = "";

			// DateEntered
			$this->DateEntered->ViewValue = $this->DateEntered->CurrentValue;
			$this->DateEntered->ViewValue = FormatDateTime($this->DateEntered->ViewValue, 0);
			$this->DateEntered->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";
			$this->PropertyNo->TooltipValue = "";

			// StandNo
			$this->StandNo->LinkCustomAttributes = "";
			$this->StandNo->HrefValue = "";
			$this->StandNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";
			$this->PropertyGroup->TooltipValue = "";

			// PropertyType
			$this->PropertyType->LinkCustomAttributes = "";
			$this->PropertyType->HrefValue = "";
			$this->PropertyType->TooltipValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";

			// RollStatus
			$this->RollStatus->LinkCustomAttributes = "";
			$this->RollStatus->HrefValue = "";
			$this->RollStatus->TooltipValue = "";

			// UseCode
			$this->UseCode->LinkCustomAttributes = "";
			$this->UseCode->HrefValue = "";
			$this->UseCode->TooltipValue = "";

			// AreaOfLand
			$this->AreaOfLand->LinkCustomAttributes = "";
			$this->AreaOfLand->HrefValue = "";
			$this->AreaOfLand->TooltipValue = "";

			// AreaCode
			$this->AreaCode->LinkCustomAttributes = "";
			$this->AreaCode->HrefValue = "";
			$this->AreaCode->TooltipValue = "";

			// SiteNumber
			$this->SiteNumber->LinkCustomAttributes = "";
			$this->SiteNumber->HrefValue = "";
			$this->SiteNumber->TooltipValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";
			$this->RateableValue->TooltipValue = "";

			// NewRateableValue
			$this->NewRateableValue->LinkCustomAttributes = "";
			$this->NewRateableValue->HrefValue = "";
			$this->NewRateableValue->TooltipValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";
			$this->ExemptCode->TooltipValue = "";

			// Improvements
			$this->Improvements->LinkCustomAttributes = "";
			$this->Improvements->HrefValue = "";
			$this->Improvements->TooltipValue = "";

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

			// PropertyPhoto
			$this->PropertyPhoto->LinkCustomAttributes = "";
			if (!empty($this->PropertyPhoto->Upload->DbValue)) {
				$this->PropertyPhoto->HrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);
				$this->PropertyPhoto->LinkAttrs["target"] = "";
				if ($this->PropertyPhoto->IsBlobImage && empty($this->PropertyPhoto->LinkAttrs["target"]))
					$this->PropertyPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->PropertyPhoto->HrefValue = FullUrl($this->PropertyPhoto->HrefValue, "href");
			} else {
				$this->PropertyPhoto->HrefValue = "";
			}
			$this->PropertyPhoto->ExportHrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);
			$this->PropertyPhoto->TooltipValue = "";

			// DateEvaluated
			$this->DateEvaluated->LinkCustomAttributes = "";
			$this->DateEvaluated->HrefValue = "";
			$this->DateEvaluated->TooltipValue = "";

			// Objections
			$this->Objections->LinkCustomAttributes = "";
			$this->Objections->HrefValue = "";
			$this->Objections->TooltipValue = "";

			// DateEntered
			$this->DateEntered->LinkCustomAttributes = "";
			$this->DateEntered->HrefValue = "";
			$this->DateEntered->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->CurrentValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

			// StandNo
			$this->StandNo->EditAttrs["class"] = "form-control";
			$this->StandNo->EditCustomAttributes = "";
			if (!$this->StandNo->Raw)
				$this->StandNo->CurrentValue = HtmlDecode($this->StandNo->CurrentValue);
			$this->StandNo->EditValue = HtmlEncode($this->StandNo->CurrentValue);
			$this->StandNo->PlaceHolder = RemoveHtml($this->StandNo->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PropertyGroup
			$this->PropertyGroup->EditAttrs["class"] = "form-control";
			$this->PropertyGroup->EditCustomAttributes = "";
			$this->PropertyGroup->EditValue = HtmlEncode($this->PropertyGroup->CurrentValue);
			$this->PropertyGroup->PlaceHolder = RemoveHtml($this->PropertyGroup->caption());

			// PropertyType
			$this->PropertyType->EditAttrs["class"] = "form-control";
			$this->PropertyType->EditCustomAttributes = "";
			$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->CurrentValue);
			$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

			// Location
			$this->Location->EditAttrs["class"] = "form-control";
			$this->Location->EditCustomAttributes = "";
			if (!$this->Location->Raw)
				$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
			$this->Location->EditValue = HtmlEncode($this->Location->CurrentValue);
			$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

			// RollStatus
			$this->RollStatus->EditAttrs["class"] = "form-control";
			$this->RollStatus->EditCustomAttributes = "";
			$this->RollStatus->EditValue = HtmlEncode($this->RollStatus->CurrentValue);
			$this->RollStatus->PlaceHolder = RemoveHtml($this->RollStatus->caption());

			// UseCode
			$this->UseCode->EditAttrs["class"] = "form-control";
			$this->UseCode->EditCustomAttributes = "";
			$this->UseCode->EditValue = HtmlEncode($this->UseCode->CurrentValue);
			$this->UseCode->PlaceHolder = RemoveHtml($this->UseCode->caption());

			// AreaOfLand
			$this->AreaOfLand->EditAttrs["class"] = "form-control";
			$this->AreaOfLand->EditCustomAttributes = "";
			$this->AreaOfLand->EditValue = HtmlEncode($this->AreaOfLand->CurrentValue);
			$this->AreaOfLand->PlaceHolder = RemoveHtml($this->AreaOfLand->caption());
			if (strval($this->AreaOfLand->EditValue) != "" && is_numeric($this->AreaOfLand->EditValue))
				$this->AreaOfLand->EditValue = FormatNumber($this->AreaOfLand->EditValue, -2, -1, -2, 0);
			

			// AreaCode
			$this->AreaCode->EditAttrs["class"] = "form-control";
			$this->AreaCode->EditCustomAttributes = "";
			if (!$this->AreaCode->Raw)
				$this->AreaCode->CurrentValue = HtmlDecode($this->AreaCode->CurrentValue);
			$this->AreaCode->EditValue = HtmlEncode($this->AreaCode->CurrentValue);
			$this->AreaCode->PlaceHolder = RemoveHtml($this->AreaCode->caption());

			// SiteNumber
			$this->SiteNumber->EditAttrs["class"] = "form-control";
			$this->SiteNumber->EditCustomAttributes = "";
			$this->SiteNumber->EditValue = HtmlEncode($this->SiteNumber->CurrentValue);
			$this->SiteNumber->PlaceHolder = RemoveHtml($this->SiteNumber->caption());

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->CurrentValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
			if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
				$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -1, -2, 0);
			

			// NewRateableValue
			$this->NewRateableValue->EditAttrs["class"] = "form-control";
			$this->NewRateableValue->EditCustomAttributes = "";
			$this->NewRateableValue->EditValue = HtmlEncode($this->NewRateableValue->CurrentValue);
			$this->NewRateableValue->PlaceHolder = RemoveHtml($this->NewRateableValue->caption());
			if (strval($this->NewRateableValue->EditValue) != "" && is_numeric($this->NewRateableValue->EditValue))
				$this->NewRateableValue->EditValue = FormatNumber($this->NewRateableValue->EditValue, -2, -1, -2, 0);
			

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// Improvements
			$this->Improvements->EditAttrs["class"] = "form-control";
			$this->Improvements->EditCustomAttributes = "";
			if (!$this->Improvements->Raw)
				$this->Improvements->CurrentValue = HtmlDecode($this->Improvements->CurrentValue);
			$this->Improvements->EditValue = HtmlEncode($this->Improvements->CurrentValue);
			$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

			// NewImprovements
			$this->NewImprovements->EditAttrs["class"] = "form-control";
			$this->NewImprovements->EditCustomAttributes = "";
			if (!$this->NewImprovements->Raw)
				$this->NewImprovements->CurrentValue = HtmlDecode($this->NewImprovements->CurrentValue);
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
			

			// PropertyPhoto
			$this->PropertyPhoto->EditAttrs["class"] = "form-control";
			$this->PropertyPhoto->EditCustomAttributes = "";
			if (!EmptyValue($this->PropertyPhoto->Upload->DbValue)) {
				$this->PropertyPhoto->EditValue = $this->ValuationNo->CurrentValue;
				$this->PropertyPhoto->IsBlobImage = IsImageFile(ContentExtension($this->PropertyPhoto->Upload->DbValue));
			} else {
				$this->PropertyPhoto->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->PropertyPhoto);

			// DateEvaluated
			$this->DateEvaluated->EditAttrs["class"] = "form-control";
			$this->DateEvaluated->EditCustomAttributes = "";
			$this->DateEvaluated->EditValue = HtmlEncode(FormatDateTime($this->DateEvaluated->CurrentValue, 8));
			$this->DateEvaluated->PlaceHolder = RemoveHtml($this->DateEvaluated->caption());

			// Objections
			$this->Objections->EditAttrs["class"] = "form-control";
			$this->Objections->EditCustomAttributes = "";
			$this->Objections->EditValue = HtmlEncode($this->Objections->CurrentValue);
			$this->Objections->PlaceHolder = RemoveHtml($this->Objections->caption());

			// DateEntered
			$this->DateEntered->EditAttrs["class"] = "form-control";
			$this->DateEntered->EditCustomAttributes = "";
			$this->DateEntered->EditValue = HtmlEncode(FormatDateTime($this->DateEntered->CurrentValue, 8));
			$this->DateEntered->PlaceHolder = RemoveHtml($this->DateEntered->caption());

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
			// PropertyNo

			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";

			// StandNo
			$this->StandNo->LinkCustomAttributes = "";
			$this->StandNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";

			// PropertyType
			$this->PropertyType->LinkCustomAttributes = "";
			$this->PropertyType->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// RollStatus
			$this->RollStatus->LinkCustomAttributes = "";
			$this->RollStatus->HrefValue = "";

			// UseCode
			$this->UseCode->LinkCustomAttributes = "";
			$this->UseCode->HrefValue = "";

			// AreaOfLand
			$this->AreaOfLand->LinkCustomAttributes = "";
			$this->AreaOfLand->HrefValue = "";

			// AreaCode
			$this->AreaCode->LinkCustomAttributes = "";
			$this->AreaCode->HrefValue = "";

			// SiteNumber
			$this->SiteNumber->LinkCustomAttributes = "";
			$this->SiteNumber->HrefValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";

			// NewRateableValue
			$this->NewRateableValue->LinkCustomAttributes = "";
			$this->NewRateableValue->HrefValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";

			// Improvements
			$this->Improvements->LinkCustomAttributes = "";
			$this->Improvements->HrefValue = "";

			// NewImprovements
			$this->NewImprovements->LinkCustomAttributes = "";
			$this->NewImprovements->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// PropertyPhoto
			$this->PropertyPhoto->LinkCustomAttributes = "";
			if (!empty($this->PropertyPhoto->Upload->DbValue)) {
				$this->PropertyPhoto->HrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);
				$this->PropertyPhoto->LinkAttrs["target"] = "";
				if ($this->PropertyPhoto->IsBlobImage && empty($this->PropertyPhoto->LinkAttrs["target"]))
					$this->PropertyPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->PropertyPhoto->HrefValue = FullUrl($this->PropertyPhoto->HrefValue, "href");
			} else {
				$this->PropertyPhoto->HrefValue = "";
			}
			$this->PropertyPhoto->ExportHrefValue = GetFileUploadUrl($this->PropertyPhoto, $this->ValuationNo->CurrentValue);

			// DateEvaluated
			$this->DateEvaluated->LinkCustomAttributes = "";
			$this->DateEvaluated->HrefValue = "";

			// Objections
			$this->Objections->LinkCustomAttributes = "";
			$this->Objections->HrefValue = "";

			// DateEntered
			$this->DateEntered->LinkCustomAttributes = "";
			$this->DateEntered->HrefValue = "";

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
		if ($this->PropertyNo->Required) {
			if (!$this->PropertyNo->IsDetailKey && $this->PropertyNo->FormValue != NULL && $this->PropertyNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyNo->caption(), $this->PropertyNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PropertyNo->FormValue)) {
			AddMessage($FormError, $this->PropertyNo->errorMessage());
		}
		if ($this->StandNo->Required) {
			if (!$this->StandNo->IsDetailKey && $this->StandNo->FormValue != NULL && $this->StandNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StandNo->caption(), $this->StandNo->RequiredErrorMessage));
			}
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->PropertyGroup->Required) {
			if (!$this->PropertyGroup->IsDetailKey && $this->PropertyGroup->FormValue != NULL && $this->PropertyGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyGroup->caption(), $this->PropertyGroup->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PropertyGroup->FormValue)) {
			AddMessage($FormError, $this->PropertyGroup->errorMessage());
		}
		if ($this->PropertyType->Required) {
			if (!$this->PropertyType->IsDetailKey && $this->PropertyType->FormValue != NULL && $this->PropertyType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyType->caption(), $this->PropertyType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PropertyType->FormValue)) {
			AddMessage($FormError, $this->PropertyType->errorMessage());
		}
		if ($this->Location->Required) {
			if (!$this->Location->IsDetailKey && $this->Location->FormValue != NULL && $this->Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Location->caption(), $this->Location->RequiredErrorMessage));
			}
		}
		if ($this->RollStatus->Required) {
			if (!$this->RollStatus->IsDetailKey && $this->RollStatus->FormValue != NULL && $this->RollStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RollStatus->caption(), $this->RollStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RollStatus->FormValue)) {
			AddMessage($FormError, $this->RollStatus->errorMessage());
		}
		if ($this->UseCode->Required) {
			if (!$this->UseCode->IsDetailKey && $this->UseCode->FormValue != NULL && $this->UseCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UseCode->caption(), $this->UseCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->UseCode->FormValue)) {
			AddMessage($FormError, $this->UseCode->errorMessage());
		}
		if ($this->AreaOfLand->Required) {
			if (!$this->AreaOfLand->IsDetailKey && $this->AreaOfLand->FormValue != NULL && $this->AreaOfLand->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AreaOfLand->caption(), $this->AreaOfLand->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AreaOfLand->FormValue)) {
			AddMessage($FormError, $this->AreaOfLand->errorMessage());
		}
		if ($this->AreaCode->Required) {
			if (!$this->AreaCode->IsDetailKey && $this->AreaCode->FormValue != NULL && $this->AreaCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AreaCode->caption(), $this->AreaCode->RequiredErrorMessage));
			}
		}
		if ($this->SiteNumber->Required) {
			if (!$this->SiteNumber->IsDetailKey && $this->SiteNumber->FormValue != NULL && $this->SiteNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SiteNumber->caption(), $this->SiteNumber->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SiteNumber->FormValue)) {
			AddMessage($FormError, $this->SiteNumber->errorMessage());
		}
		if ($this->RateableValue->Required) {
			if (!$this->RateableValue->IsDetailKey && $this->RateableValue->FormValue != NULL && $this->RateableValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RateableValue->caption(), $this->RateableValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->RateableValue->FormValue)) {
			AddMessage($FormError, $this->RateableValue->errorMessage());
		}
		if ($this->NewRateableValue->Required) {
			if (!$this->NewRateableValue->IsDetailKey && $this->NewRateableValue->FormValue != NULL && $this->NewRateableValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewRateableValue->caption(), $this->NewRateableValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->NewRateableValue->FormValue)) {
			AddMessage($FormError, $this->NewRateableValue->errorMessage());
		}
		if ($this->ExemptCode->Required) {
			if (!$this->ExemptCode->IsDetailKey && $this->ExemptCode->FormValue != NULL && $this->ExemptCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExemptCode->caption(), $this->ExemptCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ExemptCode->FormValue)) {
			AddMessage($FormError, $this->ExemptCode->errorMessage());
		}
		if ($this->Improvements->Required) {
			if (!$this->Improvements->IsDetailKey && $this->Improvements->FormValue != NULL && $this->Improvements->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Improvements->caption(), $this->Improvements->RequiredErrorMessage));
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
		if ($this->PropertyPhoto->Required) {
			if ($this->PropertyPhoto->Upload->FileName == "" && !$this->PropertyPhoto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->PropertyPhoto->caption(), $this->PropertyPhoto->RequiredErrorMessage));
			}
		}
		if ($this->DateEvaluated->Required) {
			if (!$this->DateEvaluated->IsDetailKey && $this->DateEvaluated->FormValue != NULL && $this->DateEvaluated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateEvaluated->caption(), $this->DateEvaluated->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateEvaluated->FormValue)) {
			AddMessage($FormError, $this->DateEvaluated->errorMessage());
		}
		if ($this->Objections->Required) {
			if (!$this->Objections->IsDetailKey && $this->Objections->FormValue != NULL && $this->Objections->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Objections->caption(), $this->Objections->RequiredErrorMessage));
			}
		}
		if ($this->DateEntered->Required) {
			if (!$this->DateEntered->IsDetailKey && $this->DateEntered->FormValue != NULL && $this->DateEntered->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateEntered->caption(), $this->DateEntered->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateEntered->FormValue)) {
			AddMessage($FormError, $this->DateEntered->errorMessage());
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

		// PropertyNo
		$this->PropertyNo->setDbValueDef($rsnew, $this->PropertyNo->CurrentValue, 0, FALSE);

		// StandNo
		$this->StandNo->setDbValueDef($rsnew, $this->StandNo->CurrentValue, NULL, FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// PropertyGroup
		$this->PropertyGroup->setDbValueDef($rsnew, $this->PropertyGroup->CurrentValue, NULL, strval($this->PropertyGroup->CurrentValue) == "");

		// PropertyType
		$this->PropertyType->setDbValueDef($rsnew, $this->PropertyType->CurrentValue, NULL, strval($this->PropertyType->CurrentValue) == "");

		// Location
		$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, NULL, FALSE);

		// RollStatus
		$this->RollStatus->setDbValueDef($rsnew, $this->RollStatus->CurrentValue, NULL, strval($this->RollStatus->CurrentValue) == "");

		// UseCode
		$this->UseCode->setDbValueDef($rsnew, $this->UseCode->CurrentValue, NULL, strval($this->UseCode->CurrentValue) == "");

		// AreaOfLand
		$this->AreaOfLand->setDbValueDef($rsnew, $this->AreaOfLand->CurrentValue, NULL, strval($this->AreaOfLand->CurrentValue) == "");

		// AreaCode
		$this->AreaCode->setDbValueDef($rsnew, $this->AreaCode->CurrentValue, NULL, FALSE);

		// SiteNumber
		$this->SiteNumber->setDbValueDef($rsnew, $this->SiteNumber->CurrentValue, NULL, FALSE);

		// RateableValue
		$this->RateableValue->setDbValueDef($rsnew, $this->RateableValue->CurrentValue, NULL, strval($this->RateableValue->CurrentValue) == "");

		// NewRateableValue
		$this->NewRateableValue->setDbValueDef($rsnew, $this->NewRateableValue->CurrentValue, NULL, strval($this->NewRateableValue->CurrentValue) == "");

		// ExemptCode
		$this->ExemptCode->setDbValueDef($rsnew, $this->ExemptCode->CurrentValue, NULL, strval($this->ExemptCode->CurrentValue) == "");

		// Improvements
		$this->Improvements->setDbValueDef($rsnew, $this->Improvements->CurrentValue, NULL, FALSE);

		// NewImprovements
		$this->NewImprovements->setDbValueDef($rsnew, $this->NewImprovements->CurrentValue, NULL, FALSE);

		// Longitude
		$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, FALSE);

		// Latitude
		$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, FALSE);

		// PropertyPhoto
		if ($this->PropertyPhoto->Visible && !$this->PropertyPhoto->Upload->KeepFile) {
			if ($this->PropertyPhoto->Upload->Value == NULL) {
				$rsnew['PropertyPhoto'] = NULL;
			} else {
				$rsnew['PropertyPhoto'] = $this->PropertyPhoto->Upload->Value;
			}
		}

		// DateEvaluated
		$this->DateEvaluated->setDbValueDef($rsnew, UnFormatDateTime($this->DateEvaluated->CurrentValue, 0), NULL, FALSE);

		// Objections
		$this->Objections->setDbValueDef($rsnew, $this->Objections->CurrentValue, NULL, FALSE);

		// DateEntered
		$this->DateEntered->setDbValueDef($rsnew, UnFormatDateTime($this->DateEntered->CurrentValue, 0), NULL, FALSE);

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

			// PropertyPhoto
			CleanUploadTempPath($this->PropertyPhoto, $this->PropertyPhoto->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("property_valuation_rolllist.php"), "", $this->TableVar, TRUE);
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