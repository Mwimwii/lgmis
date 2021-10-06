<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class third_party_add extends third_party
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'third_party';

	// Page object name
	public $PageObjName = "third_party_add";

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

		// Table object (third_party)
		if (!isset($GLOBALS["third_party"]) || get_class($GLOBALS["third_party"]) == PROJECT_NAMESPACE . "third_party") {
			$GLOBALS["third_party"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["third_party"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'third_party');

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
		global $third_party;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($third_party);
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
					if ($pageName == "third_partyview.php")
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
			$key .= @$ar['DeductionCode'];
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
					$this->terminate(GetUrl("third_partylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ThirdPartyName->setVisibility();
		$this->DateOfEngagement->setVisibility();
		$this->DeductionCode->setVisibility();
		$this->DeductionRate->setVisibility();
		$this->DeductionAmount->setVisibility();
		$this->DeductionLimit->setVisibility();
		$this->EmployerContribution->setVisibility();
		$this->DeductionDescription->setVisibility();
		$this->PostalAddress->setVisibility();
		$this->PhysicalAddress->setVisibility();
		$this->TownOrVillage->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->_Email->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->BankAccountNo->setVisibility();
		$this->PaymentMethod->setVisibility();
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
		$this->setupLookupOptions($this->DeductionCode);
		$this->setupLookupOptions($this->BankBranchCode);
		$this->setupLookupOptions($this->PaymentMethod);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("third_partylist.php");
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
			if (Get("DeductionCode") !== NULL) {
				$this->DeductionCode->setQueryStringValue(Get("DeductionCode"));
				$this->setKey("DeductionCode", $this->DeductionCode->CurrentValue); // Set up key
			} else {
				$this->setKey("DeductionCode", ""); // Clear key
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
					$this->terminate("third_partylist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "third_partylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "third_partyview.php")
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
		$this->ThirdPartyName->CurrentValue = NULL;
		$this->ThirdPartyName->OldValue = $this->ThirdPartyName->CurrentValue;
		$this->DateOfEngagement->CurrentValue = NULL;
		$this->DateOfEngagement->OldValue = $this->DateOfEngagement->CurrentValue;
		$this->DeductionCode->CurrentValue = NULL;
		$this->DeductionCode->OldValue = $this->DeductionCode->CurrentValue;
		$this->DeductionRate->CurrentValue = NULL;
		$this->DeductionRate->OldValue = $this->DeductionRate->CurrentValue;
		$this->DeductionAmount->CurrentValue = NULL;
		$this->DeductionAmount->OldValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionLimit->CurrentValue = NULL;
		$this->DeductionLimit->OldValue = $this->DeductionLimit->CurrentValue;
		$this->EmployerContribution->CurrentValue = NULL;
		$this->EmployerContribution->OldValue = $this->EmployerContribution->CurrentValue;
		$this->DeductionDescription->CurrentValue = NULL;
		$this->DeductionDescription->OldValue = $this->DeductionDescription->CurrentValue;
		$this->PostalAddress->CurrentValue = NULL;
		$this->PostalAddress->OldValue = $this->PostalAddress->CurrentValue;
		$this->PhysicalAddress->CurrentValue = NULL;
		$this->PhysicalAddress->OldValue = $this->PhysicalAddress->CurrentValue;
		$this->TownOrVillage->CurrentValue = NULL;
		$this->TownOrVillage->OldValue = $this->TownOrVillage->CurrentValue;
		$this->Telephone->CurrentValue = NULL;
		$this->Telephone->OldValue = $this->Telephone->CurrentValue;
		$this->Mobile->CurrentValue = NULL;
		$this->Mobile->OldValue = $this->Mobile->CurrentValue;
		$this->Fax->CurrentValue = NULL;
		$this->Fax->OldValue = $this->Fax->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->BankBranchCode->CurrentValue = NULL;
		$this->BankBranchCode->OldValue = $this->BankBranchCode->CurrentValue;
		$this->BankAccountNo->CurrentValue = NULL;
		$this->BankAccountNo->OldValue = $this->BankAccountNo->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ThirdPartyName' first before field var 'x_ThirdPartyName'
		$val = $CurrentForm->hasValue("ThirdPartyName") ? $CurrentForm->getValue("ThirdPartyName") : $CurrentForm->getValue("x_ThirdPartyName");
		if (!$this->ThirdPartyName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ThirdPartyName->Visible = FALSE; // Disable update for API request
			else
				$this->ThirdPartyName->setFormValue($val);
		}

		// Check field name 'DateOfEngagement' first before field var 'x_DateOfEngagement'
		$val = $CurrentForm->hasValue("DateOfEngagement") ? $CurrentForm->getValue("DateOfEngagement") : $CurrentForm->getValue("x_DateOfEngagement");
		if (!$this->DateOfEngagement->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfEngagement->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfEngagement->setFormValue($val);
			$this->DateOfEngagement->CurrentValue = UnFormatDateTime($this->DateOfEngagement->CurrentValue, 0);
		}

		// Check field name 'DeductionCode' first before field var 'x_DeductionCode'
		$val = $CurrentForm->hasValue("DeductionCode") ? $CurrentForm->getValue("DeductionCode") : $CurrentForm->getValue("x_DeductionCode");
		if (!$this->DeductionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionCode->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionCode->setFormValue($val);
		}

		// Check field name 'DeductionRate' first before field var 'x_DeductionRate'
		$val = $CurrentForm->hasValue("DeductionRate") ? $CurrentForm->getValue("DeductionRate") : $CurrentForm->getValue("x_DeductionRate");
		if (!$this->DeductionRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionRate->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionRate->setFormValue($val);
		}

		// Check field name 'DeductionAmount' first before field var 'x_DeductionAmount'
		$val = $CurrentForm->hasValue("DeductionAmount") ? $CurrentForm->getValue("DeductionAmount") : $CurrentForm->getValue("x_DeductionAmount");
		if (!$this->DeductionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionAmount->setFormValue($val);
		}

		// Check field name 'DeductionLimit' first before field var 'x_DeductionLimit'
		$val = $CurrentForm->hasValue("DeductionLimit") ? $CurrentForm->getValue("DeductionLimit") : $CurrentForm->getValue("x_DeductionLimit");
		if (!$this->DeductionLimit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionLimit->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionLimit->setFormValue($val);
		}

		// Check field name 'EmployerContribution' first before field var 'x_EmployerContribution'
		$val = $CurrentForm->hasValue("EmployerContribution") ? $CurrentForm->getValue("EmployerContribution") : $CurrentForm->getValue("x_EmployerContribution");
		if (!$this->EmployerContribution->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployerContribution->Visible = FALSE; // Disable update for API request
			else
				$this->EmployerContribution->setFormValue($val);
		}

		// Check field name 'DeductionDescription' first before field var 'x_DeductionDescription'
		$val = $CurrentForm->hasValue("DeductionDescription") ? $CurrentForm->getValue("DeductionDescription") : $CurrentForm->getValue("x_DeductionDescription");
		if (!$this->DeductionDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionDescription->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionDescription->setFormValue($val);
		}

		// Check field name 'PostalAddress' first before field var 'x_PostalAddress'
		$val = $CurrentForm->hasValue("PostalAddress") ? $CurrentForm->getValue("PostalAddress") : $CurrentForm->getValue("x_PostalAddress");
		if (!$this->PostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PostalAddress->setFormValue($val);
		}

		// Check field name 'PhysicalAddress' first before field var 'x_PhysicalAddress'
		$val = $CurrentForm->hasValue("PhysicalAddress") ? $CurrentForm->getValue("PhysicalAddress") : $CurrentForm->getValue("x_PhysicalAddress");
		if (!$this->PhysicalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalAddress->setFormValue($val);
		}

		// Check field name 'TownOrVillage' first before field var 'x_TownOrVillage'
		$val = $CurrentForm->hasValue("TownOrVillage") ? $CurrentForm->getValue("TownOrVillage") : $CurrentForm->getValue("x_TownOrVillage");
		if (!$this->TownOrVillage->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TownOrVillage->Visible = FALSE; // Disable update for API request
			else
				$this->TownOrVillage->setFormValue($val);
		}

		// Check field name 'Telephone' first before field var 'x_Telephone'
		$val = $CurrentForm->hasValue("Telephone") ? $CurrentForm->getValue("Telephone") : $CurrentForm->getValue("x_Telephone");
		if (!$this->Telephone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Telephone->Visible = FALSE; // Disable update for API request
			else
				$this->Telephone->setFormValue($val);
		}

		// Check field name 'Mobile' first before field var 'x_Mobile'
		$val = $CurrentForm->hasValue("Mobile") ? $CurrentForm->getValue("Mobile") : $CurrentForm->getValue("x_Mobile");
		if (!$this->Mobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mobile->Visible = FALSE; // Disable update for API request
			else
				$this->Mobile->setFormValue($val);
		}

		// Check field name 'Fax' first before field var 'x_Fax'
		$val = $CurrentForm->hasValue("Fax") ? $CurrentForm->getValue("Fax") : $CurrentForm->getValue("x_Fax");
		if (!$this->Fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fax->Visible = FALSE; // Disable update for API request
			else
				$this->Fax->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'BankBranchCode' first before field var 'x_BankBranchCode'
		$val = $CurrentForm->hasValue("BankBranchCode") ? $CurrentForm->getValue("BankBranchCode") : $CurrentForm->getValue("x_BankBranchCode");
		if (!$this->BankBranchCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankBranchCode->Visible = FALSE; // Disable update for API request
			else
				$this->BankBranchCode->setFormValue($val);
		}

		// Check field name 'BankAccountNo' first before field var 'x_BankAccountNo'
		$val = $CurrentForm->hasValue("BankAccountNo") ? $CurrentForm->getValue("BankAccountNo") : $CurrentForm->getValue("x_BankAccountNo");
		if (!$this->BankAccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankAccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->BankAccountNo->setFormValue($val);
		}

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ThirdPartyName->CurrentValue = $this->ThirdPartyName->FormValue;
		$this->DateOfEngagement->CurrentValue = $this->DateOfEngagement->FormValue;
		$this->DateOfEngagement->CurrentValue = UnFormatDateTime($this->DateOfEngagement->CurrentValue, 0);
		$this->DeductionCode->CurrentValue = $this->DeductionCode->FormValue;
		$this->DeductionRate->CurrentValue = $this->DeductionRate->FormValue;
		$this->DeductionAmount->CurrentValue = $this->DeductionAmount->FormValue;
		$this->DeductionLimit->CurrentValue = $this->DeductionLimit->FormValue;
		$this->EmployerContribution->CurrentValue = $this->EmployerContribution->FormValue;
		$this->DeductionDescription->CurrentValue = $this->DeductionDescription->FormValue;
		$this->PostalAddress->CurrentValue = $this->PostalAddress->FormValue;
		$this->PhysicalAddress->CurrentValue = $this->PhysicalAddress->FormValue;
		$this->TownOrVillage->CurrentValue = $this->TownOrVillage->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Fax->CurrentValue = $this->Fax->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->BankBranchCode->CurrentValue = $this->BankBranchCode->FormValue;
		$this->BankAccountNo->CurrentValue = $this->BankAccountNo->FormValue;
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
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
		$this->ThirdPartyName->setDbValue($row['ThirdPartyName']);
		$this->DateOfEngagement->setDbValue($row['DateOfEngagement']);
		$this->DeductionCode->setDbValue($row['DeductionCode']);
		$this->DeductionRate->setDbValue($row['DeductionRate']);
		$this->DeductionAmount->setDbValue($row['DeductionAmount']);
		$this->DeductionLimit->setDbValue($row['DeductionLimit']);
		$this->EmployerContribution->setDbValue($row['EmployerContribution']);
		$this->DeductionDescription->setDbValue($row['DeductionDescription']);
		$this->PostalAddress->setDbValue($row['PostalAddress']);
		$this->PhysicalAddress->setDbValue($row['PhysicalAddress']);
		$this->TownOrVillage->setDbValue($row['TownOrVillage']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Fax->setDbValue($row['Fax']);
		$this->_Email->setDbValue($row['Email']);
		$this->BankBranchCode->setDbValue($row['BankBranchCode']);
		$this->BankAccountNo->setDbValue($row['BankAccountNo']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ThirdPartyName'] = $this->ThirdPartyName->CurrentValue;
		$row['DateOfEngagement'] = $this->DateOfEngagement->CurrentValue;
		$row['DeductionCode'] = $this->DeductionCode->CurrentValue;
		$row['DeductionRate'] = $this->DeductionRate->CurrentValue;
		$row['DeductionAmount'] = $this->DeductionAmount->CurrentValue;
		$row['DeductionLimit'] = $this->DeductionLimit->CurrentValue;
		$row['EmployerContribution'] = $this->EmployerContribution->CurrentValue;
		$row['DeductionDescription'] = $this->DeductionDescription->CurrentValue;
		$row['PostalAddress'] = $this->PostalAddress->CurrentValue;
		$row['PhysicalAddress'] = $this->PhysicalAddress->CurrentValue;
		$row['TownOrVillage'] = $this->TownOrVillage->CurrentValue;
		$row['Telephone'] = $this->Telephone->CurrentValue;
		$row['Mobile'] = $this->Mobile->CurrentValue;
		$row['Fax'] = $this->Fax->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['BankBranchCode'] = $this->BankBranchCode->CurrentValue;
		$row['BankAccountNo'] = $this->BankAccountNo->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("DeductionCode")) != "")
			$this->DeductionCode->OldValue = $this->getKey("DeductionCode"); // DeductionCode
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

		if ($this->DeductionRate->FormValue == $this->DeductionRate->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionRate->CurrentValue)))
			$this->DeductionRate->CurrentValue = ConvertToFloatString($this->DeductionRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DeductionAmount->FormValue == $this->DeductionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionAmount->CurrentValue)))
			$this->DeductionAmount->CurrentValue = ConvertToFloatString($this->DeductionAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DeductionLimit->FormValue == $this->DeductionLimit->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionLimit->CurrentValue)))
			$this->DeductionLimit->CurrentValue = ConvertToFloatString($this->DeductionLimit->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EmployerContribution->FormValue == $this->EmployerContribution->CurrentValue && is_numeric(ConvertToFloatString($this->EmployerContribution->CurrentValue)))
			$this->EmployerContribution->CurrentValue = ConvertToFloatString($this->EmployerContribution->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ThirdPartyName
		// DateOfEngagement
		// DeductionCode
		// DeductionRate
		// DeductionAmount
		// DeductionLimit
		// EmployerContribution
		// DeductionDescription
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// BankBranchCode
		// BankAccountNo
		// PaymentMethod

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ThirdPartyName
			$this->ThirdPartyName->ViewValue = $this->ThirdPartyName->CurrentValue;
			$this->ThirdPartyName->ViewCustomAttributes = "";

			// DateOfEngagement
			$this->DateOfEngagement->ViewValue = $this->DateOfEngagement->CurrentValue;
			$this->DateOfEngagement->ViewValue = FormatDateTime($this->DateOfEngagement->ViewValue, 0);
			$this->DateOfEngagement->ViewCustomAttributes = "";

			// DeductionCode
			$curVal = strval($this->DeductionCode->CurrentValue);
			if ($curVal != "") {
				$this->DeductionCode->ViewValue = $this->DeductionCode->lookupCacheOption($curVal);
				if ($this->DeductionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DeductionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DeductionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DeductionCode->ViewValue = $this->DeductionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
					}
				}
			} else {
				$this->DeductionCode->ViewValue = NULL;
			}
			$this->DeductionCode->ViewCustomAttributes = "";

			// DeductionRate
			$this->DeductionRate->ViewValue = $this->DeductionRate->CurrentValue;
			$this->DeductionRate->ViewValue = FormatNumber($this->DeductionRate->ViewValue, 2, -2, -2, -2);
			$this->DeductionRate->ViewCustomAttributes = "";

			// DeductionAmount
			$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
			$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
			$this->DeductionAmount->ViewCustomAttributes = "";

			// DeductionLimit
			$this->DeductionLimit->ViewValue = $this->DeductionLimit->CurrentValue;
			$this->DeductionLimit->ViewValue = FormatNumber($this->DeductionLimit->ViewValue, 2, -2, -2, -2);
			$this->DeductionLimit->ViewCustomAttributes = "";

			// EmployerContribution
			$this->EmployerContribution->ViewValue = $this->EmployerContribution->CurrentValue;
			$this->EmployerContribution->ViewValue = FormatNumber($this->EmployerContribution->ViewValue, 2, -2, -2, -2);
			$this->EmployerContribution->ViewCustomAttributes = "";

			// DeductionDescription
			$this->DeductionDescription->ViewValue = $this->DeductionDescription->CurrentValue;
			$this->DeductionDescription->ViewCustomAttributes = "";

			// PostalAddress
			$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
			$this->PostalAddress->ViewCustomAttributes = "";

			// PhysicalAddress
			$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->CurrentValue;
			$this->PhysicalAddress->ViewCustomAttributes = "";

			// TownOrVillage
			$this->TownOrVillage->ViewValue = $this->TownOrVillage->CurrentValue;
			$this->TownOrVillage->ViewCustomAttributes = "";

			// Telephone
			$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
			$this->Telephone->ViewCustomAttributes = "";

			// Mobile
			$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
			$this->Mobile->ViewCustomAttributes = "";

			// Fax
			$this->Fax->ViewValue = $this->Fax->CurrentValue;
			$this->Fax->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// BankBranchCode
			$curVal = strval($this->BankBranchCode->CurrentValue);
			if ($curVal != "") {
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
				if ($this->BankBranchCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->BankBranchCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
					}
				}
			} else {
				$this->BankBranchCode->ViewValue = NULL;
			}
			$this->BankBranchCode->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// ThirdPartyName
			$this->ThirdPartyName->LinkCustomAttributes = "";
			$this->ThirdPartyName->HrefValue = "";
			$this->ThirdPartyName->TooltipValue = "";

			// DateOfEngagement
			$this->DateOfEngagement->LinkCustomAttributes = "";
			$this->DateOfEngagement->HrefValue = "";
			$this->DateOfEngagement->TooltipValue = "";

			// DeductionCode
			$this->DeductionCode->LinkCustomAttributes = "";
			$this->DeductionCode->HrefValue = "";
			$this->DeductionCode->TooltipValue = "";

			// DeductionRate
			$this->DeductionRate->LinkCustomAttributes = "";
			$this->DeductionRate->HrefValue = "";
			$this->DeductionRate->TooltipValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";
			$this->DeductionAmount->TooltipValue = "";

			// DeductionLimit
			$this->DeductionLimit->LinkCustomAttributes = "";
			$this->DeductionLimit->HrefValue = "";
			$this->DeductionLimit->TooltipValue = "";

			// EmployerContribution
			$this->EmployerContribution->LinkCustomAttributes = "";
			$this->EmployerContribution->HrefValue = "";
			$this->EmployerContribution->TooltipValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";
			$this->DeductionDescription->TooltipValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";
			$this->PostalAddress->TooltipValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";
			$this->PhysicalAddress->TooltipValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";
			$this->TownOrVillage->TooltipValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";
			$this->Telephone->TooltipValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";
			$this->Mobile->TooltipValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";
			$this->Fax->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ThirdPartyName
			$this->ThirdPartyName->EditAttrs["class"] = "form-control";
			$this->ThirdPartyName->EditCustomAttributes = "";
			if (!$this->ThirdPartyName->Raw)
				$this->ThirdPartyName->CurrentValue = HtmlDecode($this->ThirdPartyName->CurrentValue);
			$this->ThirdPartyName->EditValue = HtmlEncode($this->ThirdPartyName->CurrentValue);
			$this->ThirdPartyName->PlaceHolder = RemoveHtml($this->ThirdPartyName->caption());

			// DateOfEngagement
			$this->DateOfEngagement->EditAttrs["class"] = "form-control";
			$this->DateOfEngagement->EditCustomAttributes = "";
			$this->DateOfEngagement->EditValue = HtmlEncode(FormatDateTime($this->DateOfEngagement->CurrentValue, 8));
			$this->DateOfEngagement->PlaceHolder = RemoveHtml($this->DateOfEngagement->caption());

			// DeductionCode
			$this->DeductionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DeductionCode->CurrentValue));
			if ($curVal != "")
				$this->DeductionCode->ViewValue = $this->DeductionCode->lookupCacheOption($curVal);
			else
				$this->DeductionCode->ViewValue = $this->DeductionCode->Lookup !== NULL && is_array($this->DeductionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DeductionCode->ViewValue !== NULL) { // Load from cache
				$this->DeductionCode->EditValue = array_values($this->DeductionCode->Lookup->Options);
				if ($this->DeductionCode->ViewValue == "")
					$this->DeductionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DeductionCode`" . SearchString("=", $this->DeductionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DeductionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->DeductionCode->ViewValue = $this->DeductionCode->displayValue($arwrk);
				} else {
					$this->DeductionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DeductionCode->EditValue = $arwrk;
			}

			// DeductionRate
			$this->DeductionRate->EditAttrs["class"] = "form-control";
			$this->DeductionRate->EditCustomAttributes = "";
			$this->DeductionRate->EditValue = HtmlEncode($this->DeductionRate->CurrentValue);
			$this->DeductionRate->PlaceHolder = RemoveHtml($this->DeductionRate->caption());
			if (strval($this->DeductionRate->EditValue) != "" && is_numeric($this->DeductionRate->EditValue))
				$this->DeductionRate->EditValue = FormatNumber($this->DeductionRate->EditValue, -2, -2, -2, -2);
			

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue))
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
			

			// DeductionLimit
			$this->DeductionLimit->EditAttrs["class"] = "form-control";
			$this->DeductionLimit->EditCustomAttributes = "";
			$this->DeductionLimit->EditValue = HtmlEncode($this->DeductionLimit->CurrentValue);
			$this->DeductionLimit->PlaceHolder = RemoveHtml($this->DeductionLimit->caption());
			if (strval($this->DeductionLimit->EditValue) != "" && is_numeric($this->DeductionLimit->EditValue))
				$this->DeductionLimit->EditValue = FormatNumber($this->DeductionLimit->EditValue, -2, -2, -2, -2);
			

			// EmployerContribution
			$this->EmployerContribution->EditAttrs["class"] = "form-control";
			$this->EmployerContribution->EditCustomAttributes = "";
			$this->EmployerContribution->EditValue = HtmlEncode($this->EmployerContribution->CurrentValue);
			$this->EmployerContribution->PlaceHolder = RemoveHtml($this->EmployerContribution->caption());
			if (strval($this->EmployerContribution->EditValue) != "" && is_numeric($this->EmployerContribution->EditValue))
				$this->EmployerContribution->EditValue = FormatNumber($this->EmployerContribution->EditValue, -2, -2, -2, -2);
			

			// DeductionDescription
			$this->DeductionDescription->EditAttrs["class"] = "form-control";
			$this->DeductionDescription->EditCustomAttributes = "";
			if (!$this->DeductionDescription->Raw)
				$this->DeductionDescription->CurrentValue = HtmlDecode($this->DeductionDescription->CurrentValue);
			$this->DeductionDescription->EditValue = HtmlEncode($this->DeductionDescription->CurrentValue);
			$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			if (!$this->PostalAddress->Raw)
				$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			if (!$this->PhysicalAddress->Raw)
				$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->EditValue = HtmlEncode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

			// TownOrVillage
			$this->TownOrVillage->EditAttrs["class"] = "form-control";
			$this->TownOrVillage->EditCustomAttributes = "";
			if (!$this->TownOrVillage->Raw)
				$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->EditValue = HtmlEncode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->CurrentValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// BankBranchCode
			$this->BankBranchCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BankBranchCode->CurrentValue));
			if ($curVal != "")
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			else
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->Lookup !== NULL && is_array($this->BankBranchCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BankBranchCode->ViewValue !== NULL) { // Load from cache
				$this->BankBranchCode->EditValue = array_values($this->BankBranchCode->Lookup->Options);
				if ($this->BankBranchCode->ViewValue == "")
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->BankBranchCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
				} else {
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BankBranchCode->EditValue = $arwrk;
			}

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->EditValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PaymentMethod->EditValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
					}
				}
			} else {
				$this->PaymentMethod->EditValue = NULL;
			}
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// Add refer script
			// ThirdPartyName

			$this->ThirdPartyName->LinkCustomAttributes = "";
			$this->ThirdPartyName->HrefValue = "";

			// DateOfEngagement
			$this->DateOfEngagement->LinkCustomAttributes = "";
			$this->DateOfEngagement->HrefValue = "";

			// DeductionCode
			$this->DeductionCode->LinkCustomAttributes = "";
			$this->DeductionCode->HrefValue = "";

			// DeductionRate
			$this->DeductionRate->LinkCustomAttributes = "";
			$this->DeductionRate->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// DeductionLimit
			$this->DeductionLimit->LinkCustomAttributes = "";
			$this->DeductionLimit->HrefValue = "";

			// EmployerContribution
			$this->EmployerContribution->LinkCustomAttributes = "";
			$this->EmployerContribution->HrefValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
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
		if ($this->ThirdPartyName->Required) {
			if (!$this->ThirdPartyName->IsDetailKey && $this->ThirdPartyName->FormValue != NULL && $this->ThirdPartyName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThirdPartyName->caption(), $this->ThirdPartyName->RequiredErrorMessage));
			}
		}
		if ($this->DateOfEngagement->Required) {
			if (!$this->DateOfEngagement->IsDetailKey && $this->DateOfEngagement->FormValue != NULL && $this->DateOfEngagement->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfEngagement->caption(), $this->DateOfEngagement->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfEngagement->FormValue)) {
			AddMessage($FormError, $this->DateOfEngagement->errorMessage());
		}
		if ($this->DeductionCode->Required) {
			if (!$this->DeductionCode->IsDetailKey && $this->DeductionCode->FormValue != NULL && $this->DeductionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionCode->caption(), $this->DeductionCode->RequiredErrorMessage));
			}
		}
		if ($this->DeductionRate->Required) {
			if (!$this->DeductionRate->IsDetailKey && $this->DeductionRate->FormValue != NULL && $this->DeductionRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionRate->caption(), $this->DeductionRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionRate->FormValue)) {
			AddMessage($FormError, $this->DeductionRate->errorMessage());
		}
		if ($this->DeductionAmount->Required) {
			if (!$this->DeductionAmount->IsDetailKey && $this->DeductionAmount->FormValue != NULL && $this->DeductionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionAmount->caption(), $this->DeductionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionAmount->FormValue)) {
			AddMessage($FormError, $this->DeductionAmount->errorMessage());
		}
		if ($this->DeductionLimit->Required) {
			if (!$this->DeductionLimit->IsDetailKey && $this->DeductionLimit->FormValue != NULL && $this->DeductionLimit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionLimit->caption(), $this->DeductionLimit->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionLimit->FormValue)) {
			AddMessage($FormError, $this->DeductionLimit->errorMessage());
		}
		if ($this->EmployerContribution->Required) {
			if (!$this->EmployerContribution->IsDetailKey && $this->EmployerContribution->FormValue != NULL && $this->EmployerContribution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployerContribution->caption(), $this->EmployerContribution->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EmployerContribution->FormValue)) {
			AddMessage($FormError, $this->EmployerContribution->errorMessage());
		}
		if ($this->DeductionDescription->Required) {
			if (!$this->DeductionDescription->IsDetailKey && $this->DeductionDescription->FormValue != NULL && $this->DeductionDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionDescription->caption(), $this->DeductionDescription->RequiredErrorMessage));
			}
		}
		if ($this->PostalAddress->Required) {
			if (!$this->PostalAddress->IsDetailKey && $this->PostalAddress->FormValue != NULL && $this->PostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalAddress->caption(), $this->PostalAddress->RequiredErrorMessage));
			}
		}
		if ($this->PhysicalAddress->Required) {
			if (!$this->PhysicalAddress->IsDetailKey && $this->PhysicalAddress->FormValue != NULL && $this->PhysicalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalAddress->caption(), $this->PhysicalAddress->RequiredErrorMessage));
			}
		}
		if ($this->TownOrVillage->Required) {
			if (!$this->TownOrVillage->IsDetailKey && $this->TownOrVillage->FormValue != NULL && $this->TownOrVillage->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TownOrVillage->caption(), $this->TownOrVillage->RequiredErrorMessage));
			}
		}
		if ($this->Telephone->Required) {
			if (!$this->Telephone->IsDetailKey && $this->Telephone->FormValue != NULL && $this->Telephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telephone->caption(), $this->Telephone->RequiredErrorMessage));
			}
		}
		if ($this->Mobile->Required) {
			if (!$this->Mobile->IsDetailKey && $this->Mobile->FormValue != NULL && $this->Mobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mobile->caption(), $this->Mobile->RequiredErrorMessage));
			}
		}
		if ($this->Fax->Required) {
			if (!$this->Fax->IsDetailKey && $this->Fax->FormValue != NULL && $this->Fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fax->caption(), $this->Fax->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->BankBranchCode->Required) {
			if (!$this->BankBranchCode->IsDetailKey && $this->BankBranchCode->FormValue != NULL && $this->BankBranchCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankBranchCode->caption(), $this->BankBranchCode->RequiredErrorMessage));
			}
		}
		if ($this->BankAccountNo->Required) {
			if (!$this->BankAccountNo->IsDetailKey && $this->BankAccountNo->FormValue != NULL && $this->BankAccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankAccountNo->caption(), $this->BankAccountNo->RequiredErrorMessage));
			}
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
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

		// ThirdPartyName
		$this->ThirdPartyName->setDbValueDef($rsnew, $this->ThirdPartyName->CurrentValue, "", FALSE);

		// DateOfEngagement
		$this->DateOfEngagement->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfEngagement->CurrentValue, 0), CurrentDate(), FALSE);

		// DeductionCode
		$this->DeductionCode->setDbValueDef($rsnew, $this->DeductionCode->CurrentValue, 0, FALSE);

		// DeductionRate
		$this->DeductionRate->setDbValueDef($rsnew, $this->DeductionRate->CurrentValue, NULL, FALSE);

		// DeductionAmount
		$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, NULL, FALSE);

		// DeductionLimit
		$this->DeductionLimit->setDbValueDef($rsnew, $this->DeductionLimit->CurrentValue, NULL, FALSE);

		// EmployerContribution
		$this->EmployerContribution->setDbValueDef($rsnew, $this->EmployerContribution->CurrentValue, NULL, FALSE);

		// DeductionDescription
		$this->DeductionDescription->setDbValueDef($rsnew, $this->DeductionDescription->CurrentValue, NULL, FALSE);

		// PostalAddress
		$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, FALSE);

		// PhysicalAddress
		$this->PhysicalAddress->setDbValueDef($rsnew, $this->PhysicalAddress->CurrentValue, NULL, FALSE);

		// TownOrVillage
		$this->TownOrVillage->setDbValueDef($rsnew, $this->TownOrVillage->CurrentValue, NULL, FALSE);

		// Telephone
		$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, FALSE);

		// Mobile
		$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, FALSE);

		// Fax
		$this->Fax->setDbValueDef($rsnew, $this->Fax->CurrentValue, NULL, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, FALSE);

		// BankBranchCode
		$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, FALSE);

		// BankAccountNo
		$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, FALSE);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['DeductionCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("third_partylist.php"), "", $this->TableVar, TRUE);
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
				case "x_DeductionCode":
					break;
				case "x_BankBranchCode":
					break;
				case "x_PaymentMethod":
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
						case "x_DeductionCode":
							break;
						case "x_BankBranchCode":
							break;
						case "x_PaymentMethod":
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