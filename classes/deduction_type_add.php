<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class deduction_type_add extends deduction_type
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'deduction_type';

	// Page object name
	public $PageObjName = "deduction_type_add";

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

		// Table object (deduction_type)
		if (!isset($GLOBALS["deduction_type"]) || get_class($GLOBALS["deduction_type"]) == PROJECT_NAMESPACE . "deduction_type") {
			$GLOBALS["deduction_type"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["deduction_type"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'deduction_type');

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
		global $deduction_type;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($deduction_type);
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
					if ($pageName == "deduction_typeview.php")
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->DeductionCode->Visible = FALSE;
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
					$this->terminate(GetUrl("deduction_typelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->DeductionCode->Visible = FALSE;
		$this->DeductionName->setVisibility();
		$this->DeductionDescription->setVisibility();
		$this->Division->setVisibility();
		$this->DeductionAmount->setVisibility();
		$this->DeductionBasicRate->setVisibility();
		$this->RemittedTo->setVisibility();
		$this->AccountNo->setVisibility();
		$this->BaseIncomeCode->setVisibility();
		$this->BaseDeductionCode->setVisibility();
		$this->TaxExempt->setVisibility();
		$this->JobCode->setVisibility();
		$this->MinimumAmount->setVisibility();
		$this->MaximumAmount->setVisibility();
		$this->EmployerContributionRate->setVisibility();
		$this->EmployerContributionAmount->setVisibility();
		$this->Application->setVisibility();
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
		$this->setupLookupOptions($this->Division);
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->BaseDeductionCode);
		$this->setupLookupOptions($this->TaxExempt);
		$this->setupLookupOptions($this->JobCode);
		$this->setupLookupOptions($this->Application);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("deduction_typelist.php");
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
					$this->terminate("deduction_typelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "deduction_typelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "deduction_typeview.php")
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
		$this->DeductionCode->CurrentValue = NULL;
		$this->DeductionCode->OldValue = $this->DeductionCode->CurrentValue;
		$this->DeductionName->CurrentValue = NULL;
		$this->DeductionName->OldValue = $this->DeductionName->CurrentValue;
		$this->DeductionDescription->CurrentValue = NULL;
		$this->DeductionDescription->OldValue = $this->DeductionDescription->CurrentValue;
		$this->Division->CurrentValue = NULL;
		$this->Division->OldValue = $this->Division->CurrentValue;
		$this->DeductionAmount->CurrentValue = 0;
		$this->DeductionBasicRate->CurrentValue = 0;
		$this->RemittedTo->CurrentValue = NULL;
		$this->RemittedTo->OldValue = $this->RemittedTo->CurrentValue;
		$this->AccountNo->CurrentValue = NULL;
		$this->AccountNo->OldValue = $this->AccountNo->CurrentValue;
		$this->BaseIncomeCode->CurrentValue = NULL;
		$this->BaseIncomeCode->OldValue = $this->BaseIncomeCode->CurrentValue;
		$this->BaseDeductionCode->CurrentValue = NULL;
		$this->BaseDeductionCode->OldValue = $this->BaseDeductionCode->CurrentValue;
		$this->TaxExempt->CurrentValue = NULL;
		$this->TaxExempt->OldValue = $this->TaxExempt->CurrentValue;
		$this->JobCode->CurrentValue = NULL;
		$this->JobCode->OldValue = $this->JobCode->CurrentValue;
		$this->MinimumAmount->CurrentValue = NULL;
		$this->MinimumAmount->OldValue = $this->MinimumAmount->CurrentValue;
		$this->MaximumAmount->CurrentValue = NULL;
		$this->MaximumAmount->OldValue = $this->MaximumAmount->CurrentValue;
		$this->EmployerContributionRate->CurrentValue = NULL;
		$this->EmployerContributionRate->OldValue = $this->EmployerContributionRate->CurrentValue;
		$this->EmployerContributionAmount->CurrentValue = NULL;
		$this->EmployerContributionAmount->OldValue = $this->EmployerContributionAmount->CurrentValue;
		$this->Application->CurrentValue = NULL;
		$this->Application->OldValue = $this->Application->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'DeductionName' first before field var 'x_DeductionName'
		$val = $CurrentForm->hasValue("DeductionName") ? $CurrentForm->getValue("DeductionName") : $CurrentForm->getValue("x_DeductionName");
		if (!$this->DeductionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionName->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionName->setFormValue($val);
		}

		// Check field name 'DeductionDescription' first before field var 'x_DeductionDescription'
		$val = $CurrentForm->hasValue("DeductionDescription") ? $CurrentForm->getValue("DeductionDescription") : $CurrentForm->getValue("x_DeductionDescription");
		if (!$this->DeductionDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionDescription->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionDescription->setFormValue($val);
		}

		// Check field name 'Division' first before field var 'x_Division'
		$val = $CurrentForm->hasValue("Division") ? $CurrentForm->getValue("Division") : $CurrentForm->getValue("x_Division");
		if (!$this->Division->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Division->Visible = FALSE; // Disable update for API request
			else
				$this->Division->setFormValue($val);
		}

		// Check field name 'DeductionAmount' first before field var 'x_DeductionAmount'
		$val = $CurrentForm->hasValue("DeductionAmount") ? $CurrentForm->getValue("DeductionAmount") : $CurrentForm->getValue("x_DeductionAmount");
		if (!$this->DeductionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionAmount->setFormValue($val);
		}

		// Check field name 'DeductionBasicRate' first before field var 'x_DeductionBasicRate'
		$val = $CurrentForm->hasValue("DeductionBasicRate") ? $CurrentForm->getValue("DeductionBasicRate") : $CurrentForm->getValue("x_DeductionBasicRate");
		if (!$this->DeductionBasicRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionBasicRate->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionBasicRate->setFormValue($val);
		}

		// Check field name 'RemittedTo' first before field var 'x_RemittedTo'
		$val = $CurrentForm->hasValue("RemittedTo") ? $CurrentForm->getValue("RemittedTo") : $CurrentForm->getValue("x_RemittedTo");
		if (!$this->RemittedTo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RemittedTo->Visible = FALSE; // Disable update for API request
			else
				$this->RemittedTo->setFormValue($val);
		}

		// Check field name 'AccountNo' first before field var 'x_AccountNo'
		$val = $CurrentForm->hasValue("AccountNo") ? $CurrentForm->getValue("AccountNo") : $CurrentForm->getValue("x_AccountNo");
		if (!$this->AccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->AccountNo->setFormValue($val);
		}

		// Check field name 'BaseIncomeCode' first before field var 'x_BaseIncomeCode'
		$val = $CurrentForm->hasValue("BaseIncomeCode") ? $CurrentForm->getValue("BaseIncomeCode") : $CurrentForm->getValue("x_BaseIncomeCode");
		if (!$this->BaseIncomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BaseIncomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->BaseIncomeCode->setFormValue($val);
		}

		// Check field name 'BaseDeductionCode' first before field var 'x_BaseDeductionCode'
		$val = $CurrentForm->hasValue("BaseDeductionCode") ? $CurrentForm->getValue("BaseDeductionCode") : $CurrentForm->getValue("x_BaseDeductionCode");
		if (!$this->BaseDeductionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BaseDeductionCode->Visible = FALSE; // Disable update for API request
			else
				$this->BaseDeductionCode->setFormValue($val);
		}

		// Check field name 'TaxExempt' first before field var 'x_TaxExempt'
		$val = $CurrentForm->hasValue("TaxExempt") ? $CurrentForm->getValue("TaxExempt") : $CurrentForm->getValue("x_TaxExempt");
		if (!$this->TaxExempt->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TaxExempt->Visible = FALSE; // Disable update for API request
			else
				$this->TaxExempt->setFormValue($val);
		}

		// Check field name 'JobCode' first before field var 'x_JobCode'
		$val = $CurrentForm->hasValue("JobCode") ? $CurrentForm->getValue("JobCode") : $CurrentForm->getValue("x_JobCode");
		if (!$this->JobCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobCode->Visible = FALSE; // Disable update for API request
			else
				$this->JobCode->setFormValue($val);
		}

		// Check field name 'MinimumAmount' first before field var 'x_MinimumAmount'
		$val = $CurrentForm->hasValue("MinimumAmount") ? $CurrentForm->getValue("MinimumAmount") : $CurrentForm->getValue("x_MinimumAmount");
		if (!$this->MinimumAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MinimumAmount->Visible = FALSE; // Disable update for API request
			else
				$this->MinimumAmount->setFormValue($val);
		}

		// Check field name 'MaximumAmount' first before field var 'x_MaximumAmount'
		$val = $CurrentForm->hasValue("MaximumAmount") ? $CurrentForm->getValue("MaximumAmount") : $CurrentForm->getValue("x_MaximumAmount");
		if (!$this->MaximumAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaximumAmount->Visible = FALSE; // Disable update for API request
			else
				$this->MaximumAmount->setFormValue($val);
		}

		// Check field name 'EmployerContributionRate' first before field var 'x_EmployerContributionRate'
		$val = $CurrentForm->hasValue("EmployerContributionRate") ? $CurrentForm->getValue("EmployerContributionRate") : $CurrentForm->getValue("x_EmployerContributionRate");
		if (!$this->EmployerContributionRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployerContributionRate->Visible = FALSE; // Disable update for API request
			else
				$this->EmployerContributionRate->setFormValue($val);
		}

		// Check field name 'EmployerContributionAmount' first before field var 'x_EmployerContributionAmount'
		$val = $CurrentForm->hasValue("EmployerContributionAmount") ? $CurrentForm->getValue("EmployerContributionAmount") : $CurrentForm->getValue("x_EmployerContributionAmount");
		if (!$this->EmployerContributionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployerContributionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->EmployerContributionAmount->setFormValue($val);
		}

		// Check field name 'Application' first before field var 'x_Application'
		$val = $CurrentForm->hasValue("Application") ? $CurrentForm->getValue("Application") : $CurrentForm->getValue("x_Application");
		if (!$this->Application->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Application->Visible = FALSE; // Disable update for API request
			else
				$this->Application->setFormValue($val);
		}

		// Check field name 'DeductionCode' first before field var 'x_DeductionCode'
		$val = $CurrentForm->hasValue("DeductionCode") ? $CurrentForm->getValue("DeductionCode") : $CurrentForm->getValue("x_DeductionCode");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->DeductionName->CurrentValue = $this->DeductionName->FormValue;
		$this->DeductionDescription->CurrentValue = $this->DeductionDescription->FormValue;
		$this->Division->CurrentValue = $this->Division->FormValue;
		$this->DeductionAmount->CurrentValue = $this->DeductionAmount->FormValue;
		$this->DeductionBasicRate->CurrentValue = $this->DeductionBasicRate->FormValue;
		$this->RemittedTo->CurrentValue = $this->RemittedTo->FormValue;
		$this->AccountNo->CurrentValue = $this->AccountNo->FormValue;
		$this->BaseIncomeCode->CurrentValue = $this->BaseIncomeCode->FormValue;
		$this->BaseDeductionCode->CurrentValue = $this->BaseDeductionCode->FormValue;
		$this->TaxExempt->CurrentValue = $this->TaxExempt->FormValue;
		$this->JobCode->CurrentValue = $this->JobCode->FormValue;
		$this->MinimumAmount->CurrentValue = $this->MinimumAmount->FormValue;
		$this->MaximumAmount->CurrentValue = $this->MaximumAmount->FormValue;
		$this->EmployerContributionRate->CurrentValue = $this->EmployerContributionRate->FormValue;
		$this->EmployerContributionAmount->CurrentValue = $this->EmployerContributionAmount->FormValue;
		$this->Application->CurrentValue = $this->Application->FormValue;
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
		$this->DeductionCode->setDbValue($row['DeductionCode']);
		$this->DeductionName->setDbValue($row['DeductionName']);
		$this->DeductionDescription->setDbValue($row['DeductionDescription']);
		$this->Division->setDbValue($row['Division']);
		$this->DeductionAmount->setDbValue($row['DeductionAmount']);
		$this->DeductionBasicRate->setDbValue($row['DeductionBasicRate']);
		$this->RemittedTo->setDbValue($row['RemittedTo']);
		$this->AccountNo->setDbValue($row['AccountNo']);
		$this->BaseIncomeCode->setDbValue($row['BaseIncomeCode']);
		$this->BaseDeductionCode->setDbValue($row['BaseDeductionCode']);
		$this->TaxExempt->setDbValue($row['TaxExempt']);
		$this->JobCode->setDbValue($row['JobCode']);
		$this->MinimumAmount->setDbValue($row['MinimumAmount']);
		$this->MaximumAmount->setDbValue($row['MaximumAmount']);
		$this->EmployerContributionRate->setDbValue($row['EmployerContributionRate']);
		$this->EmployerContributionAmount->setDbValue($row['EmployerContributionAmount']);
		$this->Application->setDbValue($row['Application']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['DeductionCode'] = $this->DeductionCode->CurrentValue;
		$row['DeductionName'] = $this->DeductionName->CurrentValue;
		$row['DeductionDescription'] = $this->DeductionDescription->CurrentValue;
		$row['Division'] = $this->Division->CurrentValue;
		$row['DeductionAmount'] = $this->DeductionAmount->CurrentValue;
		$row['DeductionBasicRate'] = $this->DeductionBasicRate->CurrentValue;
		$row['RemittedTo'] = $this->RemittedTo->CurrentValue;
		$row['AccountNo'] = $this->AccountNo->CurrentValue;
		$row['BaseIncomeCode'] = $this->BaseIncomeCode->CurrentValue;
		$row['BaseDeductionCode'] = $this->BaseDeductionCode->CurrentValue;
		$row['TaxExempt'] = $this->TaxExempt->CurrentValue;
		$row['JobCode'] = $this->JobCode->CurrentValue;
		$row['MinimumAmount'] = $this->MinimumAmount->CurrentValue;
		$row['MaximumAmount'] = $this->MaximumAmount->CurrentValue;
		$row['EmployerContributionRate'] = $this->EmployerContributionRate->CurrentValue;
		$row['EmployerContributionAmount'] = $this->EmployerContributionAmount->CurrentValue;
		$row['Application'] = $this->Application->CurrentValue;
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

		if ($this->DeductionAmount->FormValue == $this->DeductionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionAmount->CurrentValue)))
			$this->DeductionAmount->CurrentValue = ConvertToFloatString($this->DeductionAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DeductionBasicRate->FormValue == $this->DeductionBasicRate->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionBasicRate->CurrentValue)))
			$this->DeductionBasicRate->CurrentValue = ConvertToFloatString($this->DeductionBasicRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->MinimumAmount->FormValue == $this->MinimumAmount->CurrentValue && is_numeric(ConvertToFloatString($this->MinimumAmount->CurrentValue)))
			$this->MinimumAmount->CurrentValue = ConvertToFloatString($this->MinimumAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->MaximumAmount->FormValue == $this->MaximumAmount->CurrentValue && is_numeric(ConvertToFloatString($this->MaximumAmount->CurrentValue)))
			$this->MaximumAmount->CurrentValue = ConvertToFloatString($this->MaximumAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EmployerContributionRate->FormValue == $this->EmployerContributionRate->CurrentValue && is_numeric(ConvertToFloatString($this->EmployerContributionRate->CurrentValue)))
			$this->EmployerContributionRate->CurrentValue = ConvertToFloatString($this->EmployerContributionRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EmployerContributionAmount->FormValue == $this->EmployerContributionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->EmployerContributionAmount->CurrentValue)))
			$this->EmployerContributionAmount->CurrentValue = ConvertToFloatString($this->EmployerContributionAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// DeductionCode
		// DeductionName
		// DeductionDescription
		// Division
		// DeductionAmount
		// DeductionBasicRate
		// RemittedTo
		// AccountNo
		// BaseIncomeCode
		// BaseDeductionCode
		// TaxExempt
		// JobCode
		// MinimumAmount
		// MaximumAmount
		// EmployerContributionRate
		// EmployerContributionAmount
		// Application

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// DeductionCode
			$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
			$this->DeductionCode->ViewCustomAttributes = "";

			// DeductionName
			$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
			$this->DeductionName->ViewCustomAttributes = "";

			// DeductionDescription
			$this->DeductionDescription->ViewValue = $this->DeductionDescription->CurrentValue;
			$this->DeductionDescription->ViewCustomAttributes = "";

			// Division
			$curVal = strval($this->Division->CurrentValue);
			if ($curVal != "") {
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
				if ($this->Division->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->Division->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Division->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Division->ViewValue->add($this->Division->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Division->ViewValue = $this->Division->CurrentValue;
					}
				}
			} else {
				$this->Division->ViewValue = NULL;
			}
			$this->Division->ViewCustomAttributes = "";

			// DeductionAmount
			$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
			$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
			$this->DeductionAmount->ViewCustomAttributes = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->ViewValue = $this->DeductionBasicRate->CurrentValue;
			$this->DeductionBasicRate->ViewValue = FormatNumber($this->DeductionBasicRate->ViewValue, 2, -2, -2, -2);
			$this->DeductionBasicRate->ViewCustomAttributes = "";

			// RemittedTo
			$this->RemittedTo->ViewValue = $this->RemittedTo->CurrentValue;
			$this->RemittedTo->ViewCustomAttributes = "";

			// AccountNo
			$curVal = strval($this->AccountNo->CurrentValue);
			if ($curVal != "") {
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
				if ($this->AccountNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
					}
				}
			} else {
				$this->AccountNo->ViewValue = NULL;
			}
			$this->AccountNo->ViewCustomAttributes = "";

			// BaseIncomeCode
			$curVal = strval($this->BaseIncomeCode->CurrentValue);
			if ($curVal != "") {
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
				if ($this->BaseIncomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->CurrentValue;
					}
				}
			} else {
				$this->BaseIncomeCode->ViewValue = NULL;
			}
			$this->BaseIncomeCode->ViewCustomAttributes = "";

			// BaseDeductionCode
			$curVal = strval($this->BaseDeductionCode->CurrentValue);
			if ($curVal != "") {
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
				if ($this->BaseDeductionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DeductionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->CurrentValue;
					}
				}
			} else {
				$this->BaseDeductionCode->ViewValue = NULL;
			}
			$this->BaseDeductionCode->ViewCustomAttributes = "";

			// TaxExempt
			$curVal = strval($this->TaxExempt->CurrentValue);
			if ($curVal != "") {
				$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
				if ($this->TaxExempt->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TaxExempt->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TaxExempt->ViewValue = $this->TaxExempt->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TaxExempt->ViewValue = $this->TaxExempt->CurrentValue;
					}
				}
			} else {
				$this->TaxExempt->ViewValue = NULL;
			}
			$this->TaxExempt->ViewCustomAttributes = "";

			// JobCode
			$curVal = strval($this->JobCode->CurrentValue);
			if ($curVal != "") {
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
				if ($this->JobCode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobCode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
					}
				}
			} else {
				$this->JobCode->ViewValue = NULL;
			}
			$this->JobCode->ViewCustomAttributes = "";

			// MinimumAmount
			$this->MinimumAmount->ViewValue = $this->MinimumAmount->CurrentValue;
			$this->MinimumAmount->ViewValue = FormatNumber($this->MinimumAmount->ViewValue, 2, -2, -2, -2);
			$this->MinimumAmount->ViewCustomAttributes = "";

			// MaximumAmount
			$this->MaximumAmount->ViewValue = $this->MaximumAmount->CurrentValue;
			$this->MaximumAmount->ViewValue = FormatNumber($this->MaximumAmount->ViewValue, 2, -2, -2, -2);
			$this->MaximumAmount->ViewCustomAttributes = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->ViewValue = $this->EmployerContributionRate->CurrentValue;
			$this->EmployerContributionRate->ViewValue = FormatNumber($this->EmployerContributionRate->ViewValue, 2, -2, -2, -2);
			$this->EmployerContributionRate->ViewCustomAttributes = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->ViewValue = $this->EmployerContributionAmount->CurrentValue;
			$this->EmployerContributionAmount->ViewValue = FormatNumber($this->EmployerContributionAmount->ViewValue, 2, -2, -2, -2);
			$this->EmployerContributionAmount->ViewCustomAttributes = "";

			// Application
			$curVal = strval($this->Application->CurrentValue);
			if ($curVal != "") {
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
				if ($this->Application->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Application->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Application->ViewValue = $this->Application->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Application->ViewValue = $this->Application->CurrentValue;
					}
				}
			} else {
				$this->Application->ViewValue = NULL;
			}
			$this->Application->ViewCustomAttributes = "";

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";
			$this->DeductionName->TooltipValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";
			$this->DeductionDescription->TooltipValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";
			$this->DeductionAmount->TooltipValue = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->LinkCustomAttributes = "";
			$this->DeductionBasicRate->HrefValue = "";
			$this->DeductionBasicRate->TooltipValue = "";

			// RemittedTo
			$this->RemittedTo->LinkCustomAttributes = "";
			$this->RemittedTo->HrefValue = "";
			$this->RemittedTo->TooltipValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";
			$this->AccountNo->TooltipValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";
			$this->BaseIncomeCode->TooltipValue = "";

			// BaseDeductionCode
			$this->BaseDeductionCode->LinkCustomAttributes = "";
			$this->BaseDeductionCode->HrefValue = "";
			$this->BaseDeductionCode->TooltipValue = "";

			// TaxExempt
			$this->TaxExempt->LinkCustomAttributes = "";
			$this->TaxExempt->HrefValue = "";
			$this->TaxExempt->TooltipValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";
			$this->JobCode->TooltipValue = "";

			// MinimumAmount
			$this->MinimumAmount->LinkCustomAttributes = "";
			$this->MinimumAmount->HrefValue = "";
			$this->MinimumAmount->TooltipValue = "";

			// MaximumAmount
			$this->MaximumAmount->LinkCustomAttributes = "";
			$this->MaximumAmount->HrefValue = "";
			$this->MaximumAmount->TooltipValue = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->LinkCustomAttributes = "";
			$this->EmployerContributionRate->HrefValue = "";
			$this->EmployerContributionRate->TooltipValue = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->LinkCustomAttributes = "";
			$this->EmployerContributionAmount->HrefValue = "";
			$this->EmployerContributionAmount->TooltipValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
			$this->Application->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// DeductionName
			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->CurrentValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionDescription
			$this->DeductionDescription->EditAttrs["class"] = "form-control";
			$this->DeductionDescription->EditCustomAttributes = "";
			$this->DeductionDescription->EditValue = HtmlEncode($this->DeductionDescription->CurrentValue);
			$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

			// Division
			$this->Division->EditCustomAttributes = "";
			$curVal = trim(strval($this->Division->CurrentValue));
			if ($curVal != "")
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			else
				$this->Division->ViewValue = $this->Division->Lookup !== NULL && is_array($this->Division->Lookup->Options) ? $curVal : NULL;
			if ($this->Division->ViewValue !== NULL) { // Load from cache
				$this->Division->EditValue = array_values($this->Division->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->Division->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Division->EditValue = $arwrk;
			}

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue))
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
			

			// DeductionBasicRate
			$this->DeductionBasicRate->EditAttrs["class"] = "form-control";
			$this->DeductionBasicRate->EditCustomAttributes = "";
			$this->DeductionBasicRate->EditValue = HtmlEncode($this->DeductionBasicRate->CurrentValue);
			$this->DeductionBasicRate->PlaceHolder = RemoveHtml($this->DeductionBasicRate->caption());
			if (strval($this->DeductionBasicRate->EditValue) != "" && is_numeric($this->DeductionBasicRate->EditValue))
				$this->DeductionBasicRate->EditValue = FormatNumber($this->DeductionBasicRate->EditValue, -2, -2, -2, -2);
			

			// RemittedTo
			$this->RemittedTo->EditAttrs["class"] = "form-control";
			$this->RemittedTo->EditCustomAttributes = "";
			if (!$this->RemittedTo->Raw)
				$this->RemittedTo->CurrentValue = HtmlDecode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->EditValue = HtmlEncode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->PlaceHolder = RemoveHtml($this->RemittedTo->caption());

			// AccountNo
			$this->AccountNo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountNo->CurrentValue));
			if ($curVal != "")
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			else
				$this->AccountNo->ViewValue = $this->AccountNo->Lookup !== NULL && is_array($this->AccountNo->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountNo->ViewValue !== NULL) { // Load from cache
				$this->AccountNo->EditValue = array_values($this->AccountNo->Lookup->Options);
				if ($this->AccountNo->ViewValue == "")
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountNo->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
				} else {
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountNo->EditValue = $arwrk;
			}

			// BaseIncomeCode
			$this->BaseIncomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseIncomeCode->CurrentValue));
			if ($curVal != "")
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			else
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->Lookup !== NULL && is_array($this->BaseIncomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseIncomeCode->ViewValue !== NULL) { // Load from cache
				$this->BaseIncomeCode->EditValue = array_values($this->BaseIncomeCode->Lookup->Options);
				if ($this->BaseIncomeCode->ViewValue == "")
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IncomeCode`" . SearchString("=", $this->BaseIncomeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
				} else {
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseIncomeCode->EditValue = $arwrk;
			}

			// BaseDeductionCode
			$this->BaseDeductionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseDeductionCode->CurrentValue));
			if ($curVal != "")
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
			else
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->Lookup !== NULL && is_array($this->BaseDeductionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseDeductionCode->ViewValue !== NULL) { // Load from cache
				$this->BaseDeductionCode->EditValue = array_values($this->BaseDeductionCode->Lookup->Options);
				if ($this->BaseDeductionCode->ViewValue == "")
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DeductionCode`" . SearchString("=", $this->BaseDeductionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
				} else {
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseDeductionCode->EditValue = $arwrk;
			}

			// TaxExempt
			$this->TaxExempt->EditAttrs["class"] = "form-control";
			$this->TaxExempt->EditCustomAttributes = "";
			$curVal = trim(strval($this->TaxExempt->CurrentValue));
			if ($curVal != "")
				$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
			else
				$this->TaxExempt->ViewValue = $this->TaxExempt->Lookup !== NULL && is_array($this->TaxExempt->Lookup->Options) ? $curVal : NULL;
			if ($this->TaxExempt->ViewValue !== NULL) { // Load from cache
				$this->TaxExempt->EditValue = array_values($this->TaxExempt->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->TaxExempt->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TaxExempt->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TaxExempt->EditValue = $arwrk;
			}

			// JobCode
			$this->JobCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobCode->CurrentValue));
			if ($curVal != "")
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			else
				$this->JobCode->ViewValue = $this->JobCode->Lookup !== NULL && is_array($this->JobCode->Lookup->Options) ? $curVal : NULL;
			if ($this->JobCode->ViewValue !== NULL) { // Load from cache
				$this->JobCode->EditValue = array_values($this->JobCode->Lookup->Options);
				if ($this->JobCode->ViewValue == "")
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobCode->EditValue = $arwrk;
			}

			// MinimumAmount
			$this->MinimumAmount->EditAttrs["class"] = "form-control";
			$this->MinimumAmount->EditCustomAttributes = "";
			$this->MinimumAmount->EditValue = HtmlEncode($this->MinimumAmount->CurrentValue);
			$this->MinimumAmount->PlaceHolder = RemoveHtml($this->MinimumAmount->caption());
			if (strval($this->MinimumAmount->EditValue) != "" && is_numeric($this->MinimumAmount->EditValue))
				$this->MinimumAmount->EditValue = FormatNumber($this->MinimumAmount->EditValue, -2, -2, -2, -2);
			

			// MaximumAmount
			$this->MaximumAmount->EditAttrs["class"] = "form-control";
			$this->MaximumAmount->EditCustomAttributes = "";
			$this->MaximumAmount->EditValue = HtmlEncode($this->MaximumAmount->CurrentValue);
			$this->MaximumAmount->PlaceHolder = RemoveHtml($this->MaximumAmount->caption());
			if (strval($this->MaximumAmount->EditValue) != "" && is_numeric($this->MaximumAmount->EditValue))
				$this->MaximumAmount->EditValue = FormatNumber($this->MaximumAmount->EditValue, -2, -2, -2, -2);
			

			// EmployerContributionRate
			$this->EmployerContributionRate->EditAttrs["class"] = "form-control";
			$this->EmployerContributionRate->EditCustomAttributes = "";
			$this->EmployerContributionRate->EditValue = HtmlEncode($this->EmployerContributionRate->CurrentValue);
			$this->EmployerContributionRate->PlaceHolder = RemoveHtml($this->EmployerContributionRate->caption());
			if (strval($this->EmployerContributionRate->EditValue) != "" && is_numeric($this->EmployerContributionRate->EditValue))
				$this->EmployerContributionRate->EditValue = FormatNumber($this->EmployerContributionRate->EditValue, -2, -2, -2, -2);
			

			// EmployerContributionAmount
			$this->EmployerContributionAmount->EditAttrs["class"] = "form-control";
			$this->EmployerContributionAmount->EditCustomAttributes = "";
			$this->EmployerContributionAmount->EditValue = HtmlEncode($this->EmployerContributionAmount->CurrentValue);
			$this->EmployerContributionAmount->PlaceHolder = RemoveHtml($this->EmployerContributionAmount->caption());
			if (strval($this->EmployerContributionAmount->EditValue) != "" && is_numeric($this->EmployerContributionAmount->EditValue))
				$this->EmployerContributionAmount->EditValue = FormatNumber($this->EmployerContributionAmount->EditValue, -2, -2, -2, -2);
			

			// Application
			$this->Application->EditAttrs["class"] = "form-control";
			$this->Application->EditCustomAttributes = "";
			$curVal = trim(strval($this->Application->CurrentValue));
			if ($curVal != "")
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			else
				$this->Application->ViewValue = $this->Application->Lookup !== NULL && is_array($this->Application->Lookup->Options) ? $curVal : NULL;
			if ($this->Application->ViewValue !== NULL) { // Load from cache
				$this->Application->EditValue = array_values($this->Application->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Application->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Application->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Application->EditValue = $arwrk;
			}

			// Add refer script
			// DeductionName

			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->LinkCustomAttributes = "";
			$this->DeductionBasicRate->HrefValue = "";

			// RemittedTo
			$this->RemittedTo->LinkCustomAttributes = "";
			$this->RemittedTo->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// BaseDeductionCode
			$this->BaseDeductionCode->LinkCustomAttributes = "";
			$this->BaseDeductionCode->HrefValue = "";

			// TaxExempt
			$this->TaxExempt->LinkCustomAttributes = "";
			$this->TaxExempt->HrefValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";

			// MinimumAmount
			$this->MinimumAmount->LinkCustomAttributes = "";
			$this->MinimumAmount->HrefValue = "";

			// MaximumAmount
			$this->MaximumAmount->LinkCustomAttributes = "";
			$this->MaximumAmount->HrefValue = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->LinkCustomAttributes = "";
			$this->EmployerContributionRate->HrefValue = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->LinkCustomAttributes = "";
			$this->EmployerContributionAmount->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
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
		if ($this->DeductionName->Required) {
			if (!$this->DeductionName->IsDetailKey && $this->DeductionName->FormValue != NULL && $this->DeductionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionName->caption(), $this->DeductionName->RequiredErrorMessage));
			}
		}
		if ($this->DeductionDescription->Required) {
			if (!$this->DeductionDescription->IsDetailKey && $this->DeductionDescription->FormValue != NULL && $this->DeductionDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionDescription->caption(), $this->DeductionDescription->RequiredErrorMessage));
			}
		}
		if ($this->Division->Required) {
			if ($this->Division->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Division->caption(), $this->Division->RequiredErrorMessage));
			}
		}
		if ($this->DeductionAmount->Required) {
			if (!$this->DeductionAmount->IsDetailKey && $this->DeductionAmount->FormValue != NULL && $this->DeductionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionAmount->caption(), $this->DeductionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionAmount->FormValue)) {
			AddMessage($FormError, $this->DeductionAmount->errorMessage());
		}
		if ($this->DeductionBasicRate->Required) {
			if (!$this->DeductionBasicRate->IsDetailKey && $this->DeductionBasicRate->FormValue != NULL && $this->DeductionBasicRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionBasicRate->caption(), $this->DeductionBasicRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionBasicRate->FormValue)) {
			AddMessage($FormError, $this->DeductionBasicRate->errorMessage());
		}
		if ($this->RemittedTo->Required) {
			if (!$this->RemittedTo->IsDetailKey && $this->RemittedTo->FormValue != NULL && $this->RemittedTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RemittedTo->caption(), $this->RemittedTo->RequiredErrorMessage));
			}
		}
		if ($this->AccountNo->Required) {
			if (!$this->AccountNo->IsDetailKey && $this->AccountNo->FormValue != NULL && $this->AccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountNo->caption(), $this->AccountNo->RequiredErrorMessage));
			}
		}
		if ($this->BaseIncomeCode->Required) {
			if (!$this->BaseIncomeCode->IsDetailKey && $this->BaseIncomeCode->FormValue != NULL && $this->BaseIncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseIncomeCode->caption(), $this->BaseIncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->BaseDeductionCode->Required) {
			if (!$this->BaseDeductionCode->IsDetailKey && $this->BaseDeductionCode->FormValue != NULL && $this->BaseDeductionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseDeductionCode->caption(), $this->BaseDeductionCode->RequiredErrorMessage));
			}
		}
		if ($this->TaxExempt->Required) {
			if (!$this->TaxExempt->IsDetailKey && $this->TaxExempt->FormValue != NULL && $this->TaxExempt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaxExempt->caption(), $this->TaxExempt->RequiredErrorMessage));
			}
		}
		if ($this->JobCode->Required) {
			if ($this->JobCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobCode->caption(), $this->JobCode->RequiredErrorMessage));
			}
		}
		if ($this->MinimumAmount->Required) {
			if (!$this->MinimumAmount->IsDetailKey && $this->MinimumAmount->FormValue != NULL && $this->MinimumAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MinimumAmount->caption(), $this->MinimumAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MinimumAmount->FormValue)) {
			AddMessage($FormError, $this->MinimumAmount->errorMessage());
		}
		if ($this->MaximumAmount->Required) {
			if (!$this->MaximumAmount->IsDetailKey && $this->MaximumAmount->FormValue != NULL && $this->MaximumAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaximumAmount->caption(), $this->MaximumAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MaximumAmount->FormValue)) {
			AddMessage($FormError, $this->MaximumAmount->errorMessage());
		}
		if ($this->EmployerContributionRate->Required) {
			if (!$this->EmployerContributionRate->IsDetailKey && $this->EmployerContributionRate->FormValue != NULL && $this->EmployerContributionRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployerContributionRate->caption(), $this->EmployerContributionRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EmployerContributionRate->FormValue)) {
			AddMessage($FormError, $this->EmployerContributionRate->errorMessage());
		}
		if ($this->EmployerContributionAmount->Required) {
			if (!$this->EmployerContributionAmount->IsDetailKey && $this->EmployerContributionAmount->FormValue != NULL && $this->EmployerContributionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployerContributionAmount->caption(), $this->EmployerContributionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EmployerContributionAmount->FormValue)) {
			AddMessage($FormError, $this->EmployerContributionAmount->errorMessage());
		}
		if ($this->Application->Required) {
			if (!$this->Application->IsDetailKey && $this->Application->FormValue != NULL && $this->Application->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Application->caption(), $this->Application->RequiredErrorMessage));
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

		// DeductionName
		$this->DeductionName->setDbValueDef($rsnew, $this->DeductionName->CurrentValue, "", FALSE);

		// DeductionDescription
		$this->DeductionDescription->setDbValueDef($rsnew, $this->DeductionDescription->CurrentValue, NULL, FALSE);

		// Division
		$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, FALSE);

		// DeductionAmount
		$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, NULL, strval($this->DeductionAmount->CurrentValue) == "");

		// DeductionBasicRate
		$this->DeductionBasicRate->setDbValueDef($rsnew, $this->DeductionBasicRate->CurrentValue, NULL, strval($this->DeductionBasicRate->CurrentValue) == "");

		// RemittedTo
		$this->RemittedTo->setDbValueDef($rsnew, $this->RemittedTo->CurrentValue, NULL, FALSE);

		// AccountNo
		$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, FALSE);

		// BaseIncomeCode
		$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, FALSE);

		// BaseDeductionCode
		$this->BaseDeductionCode->setDbValueDef($rsnew, $this->BaseDeductionCode->CurrentValue, NULL, FALSE);

		// TaxExempt
		$this->TaxExempt->setDbValueDef($rsnew, $this->TaxExempt->CurrentValue, NULL, strval($this->TaxExempt->CurrentValue) == "");

		// JobCode
		$this->JobCode->setDbValueDef($rsnew, $this->JobCode->CurrentValue, NULL, FALSE);

		// MinimumAmount
		$this->MinimumAmount->setDbValueDef($rsnew, $this->MinimumAmount->CurrentValue, NULL, FALSE);

		// MaximumAmount
		$this->MaximumAmount->setDbValueDef($rsnew, $this->MaximumAmount->CurrentValue, NULL, FALSE);

		// EmployerContributionRate
		$this->EmployerContributionRate->setDbValueDef($rsnew, $this->EmployerContributionRate->CurrentValue, NULL, FALSE);

		// EmployerContributionAmount
		$this->EmployerContributionAmount->setDbValueDef($rsnew, $this->EmployerContributionAmount->CurrentValue, NULL, FALSE);

		// Application
		$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("deduction_typelist.php"), "", $this->TableVar, TRUE);
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
				case "x_Division":
					break;
				case "x_AccountNo":
					break;
				case "x_BaseIncomeCode":
					break;
				case "x_BaseDeductionCode":
					break;
				case "x_TaxExempt":
					break;
				case "x_JobCode":
					break;
				case "x_Application":
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
						case "x_Division":
							break;
						case "x_AccountNo":
							break;
						case "x_BaseIncomeCode":
							break;
						case "x_BaseDeductionCode":
							break;
						case "x_TaxExempt":
							break;
						case "x_JobCode":
							break;
						case "x_Application":
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