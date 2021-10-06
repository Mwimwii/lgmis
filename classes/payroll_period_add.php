<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class payroll_period_add extends payroll_period
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'payroll_period';

	// Page object name
	public $PageObjName = "payroll_period_add";

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

		// Table object (payroll_period)
		if (!isset($GLOBALS["payroll_period"]) || get_class($GLOBALS["payroll_period"]) == PROJECT_NAMESPACE . "payroll_period") {
			$GLOBALS["payroll_period"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["payroll_period"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'payroll_period');

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
		global $payroll_period;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($payroll_period);
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
					if ($pageName == "payroll_periodview.php")
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
			$key .= @$ar['PeriodCode'];
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
			$this->PeriodCode->Visible = FALSE;
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
					$this->terminate(GetUrl("payroll_periodlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->PeriodCode->Visible = FALSE;
		$this->FiscalYear->setVisibility();
		$this->RunMonth->setVisibility();
		$this->RunDescription->setVisibility();
		$this->CurrentPeriod->setVisibility();
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
		$this->setupLookupOptions($this->FiscalYear);
		$this->setupLookupOptions($this->RunMonth);
		$this->setupLookupOptions($this->CurrentPeriod);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("payroll_periodlist.php");
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
			if (Get("PeriodCode") !== NULL) {
				$this->PeriodCode->setQueryStringValue(Get("PeriodCode"));
				$this->setKey("PeriodCode", $this->PeriodCode->CurrentValue); // Set up key
			} else {
				$this->setKey("PeriodCode", ""); // Clear key
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
					$this->terminate("payroll_periodlist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "payroll_periodlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "payroll_periodview.php")
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
		$this->PeriodCode->CurrentValue = NULL;
		$this->PeriodCode->OldValue = $this->PeriodCode->CurrentValue;
		$this->FiscalYear->CurrentValue = NULL;
		$this->FiscalYear->OldValue = $this->FiscalYear->CurrentValue;
		$this->RunMonth->CurrentValue = NULL;
		$this->RunMonth->OldValue = $this->RunMonth->CurrentValue;
		$this->RunDescription->CurrentValue = NULL;
		$this->RunDescription->OldValue = $this->RunDescription->CurrentValue;
		$this->CurrentPeriod->CurrentValue = NULL;
		$this->CurrentPeriod->OldValue = $this->CurrentPeriod->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'FiscalYear' first before field var 'x_FiscalYear'
		$val = $CurrentForm->hasValue("FiscalYear") ? $CurrentForm->getValue("FiscalYear") : $CurrentForm->getValue("x_FiscalYear");
		if (!$this->FiscalYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FiscalYear->Visible = FALSE; // Disable update for API request
			else
				$this->FiscalYear->setFormValue($val);
		}

		// Check field name 'RunMonth' first before field var 'x_RunMonth'
		$val = $CurrentForm->hasValue("RunMonth") ? $CurrentForm->getValue("RunMonth") : $CurrentForm->getValue("x_RunMonth");
		if (!$this->RunMonth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RunMonth->Visible = FALSE; // Disable update for API request
			else
				$this->RunMonth->setFormValue($val);
		}

		// Check field name 'RunDescription' first before field var 'x_RunDescription'
		$val = $CurrentForm->hasValue("RunDescription") ? $CurrentForm->getValue("RunDescription") : $CurrentForm->getValue("x_RunDescription");
		if (!$this->RunDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RunDescription->Visible = FALSE; // Disable update for API request
			else
				$this->RunDescription->setFormValue($val);
		}

		// Check field name 'CurrentPeriod' first before field var 'x_CurrentPeriod'
		$val = $CurrentForm->hasValue("CurrentPeriod") ? $CurrentForm->getValue("CurrentPeriod") : $CurrentForm->getValue("x_CurrentPeriod");
		if (!$this->CurrentPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentPeriod->setFormValue($val);
		}

		// Check field name 'PeriodCode' first before field var 'x_PeriodCode'
		$val = $CurrentForm->hasValue("PeriodCode") ? $CurrentForm->getValue("PeriodCode") : $CurrentForm->getValue("x_PeriodCode");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->FiscalYear->CurrentValue = $this->FiscalYear->FormValue;
		$this->RunMonth->CurrentValue = $this->RunMonth->FormValue;
		$this->RunDescription->CurrentValue = $this->RunDescription->FormValue;
		$this->CurrentPeriod->CurrentValue = $this->CurrentPeriod->FormValue;
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
		$this->PeriodCode->setDbValue($row['PeriodCode']);
		$this->FiscalYear->setDbValue($row['FiscalYear']);
		$this->RunMonth->setDbValue($row['RunMonth']);
		$this->RunDescription->setDbValue($row['RunDescription']);
		$this->CurrentPeriod->setDbValue($row['CurrentPeriod']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['PeriodCode'] = $this->PeriodCode->CurrentValue;
		$row['FiscalYear'] = $this->FiscalYear->CurrentValue;
		$row['RunMonth'] = $this->RunMonth->CurrentValue;
		$row['RunDescription'] = $this->RunDescription->CurrentValue;
		$row['CurrentPeriod'] = $this->CurrentPeriod->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("PeriodCode")) != "")
			$this->PeriodCode->OldValue = $this->getKey("PeriodCode"); // PeriodCode
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
		// PeriodCode
		// FiscalYear
		// RunMonth
		// RunDescription
		// CurrentPeriod

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PeriodCode
			$this->PeriodCode->ViewValue = $this->PeriodCode->CurrentValue;
			$this->PeriodCode->ViewValue = FormatNumber($this->PeriodCode->ViewValue, 0, -2, -2, -2);
			$this->PeriodCode->ViewCustomAttributes = "";

			// FiscalYear
			$this->FiscalYear->ViewValue = $this->FiscalYear->CurrentValue;
			$curVal = strval($this->FiscalYear->CurrentValue);
			if ($curVal != "") {
				$this->FiscalYear->ViewValue = $this->FiscalYear->lookupCacheOption($curVal);
				if ($this->FiscalYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FiscalYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FiscalYear->ViewValue = $this->FiscalYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FiscalYear->ViewValue = $this->FiscalYear->CurrentValue;
					}
				}
			} else {
				$this->FiscalYear->ViewValue = NULL;
			}
			$this->FiscalYear->ViewCustomAttributes = "";

			// RunMonth
			$curVal = strval($this->RunMonth->CurrentValue);
			if ($curVal != "") {
				$this->RunMonth->ViewValue = $this->RunMonth->lookupCacheOption($curVal);
				if ($this->RunMonth->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MonthCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RunMonth->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RunMonth->ViewValue = $this->RunMonth->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RunMonth->ViewValue = $this->RunMonth->CurrentValue;
					}
				}
			} else {
				$this->RunMonth->ViewValue = NULL;
			}
			$this->RunMonth->ViewCustomAttributes = "";

			// RunDescription
			$this->RunDescription->ViewValue = $this->RunDescription->CurrentValue;
			$this->RunDescription->ViewCustomAttributes = "";

			// CurrentPeriod
			$curVal = strval($this->CurrentPeriod->CurrentValue);
			if ($curVal != "") {
				$this->CurrentPeriod->ViewValue = $this->CurrentPeriod->lookupCacheOption($curVal);
				if ($this->CurrentPeriod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CurrentPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CurrentPeriod->ViewValue = $this->CurrentPeriod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CurrentPeriod->ViewValue = $this->CurrentPeriod->CurrentValue;
					}
				}
			} else {
				$this->CurrentPeriod->ViewValue = NULL;
			}
			$this->CurrentPeriod->ViewCustomAttributes = "";

			// FiscalYear
			$this->FiscalYear->LinkCustomAttributes = "";
			$this->FiscalYear->HrefValue = "";
			$this->FiscalYear->TooltipValue = "";

			// RunMonth
			$this->RunMonth->LinkCustomAttributes = "";
			$this->RunMonth->HrefValue = "";
			$this->RunMonth->TooltipValue = "";

			// RunDescription
			$this->RunDescription->LinkCustomAttributes = "";
			$this->RunDescription->HrefValue = "";
			$this->RunDescription->TooltipValue = "";

			// CurrentPeriod
			$this->CurrentPeriod->LinkCustomAttributes = "";
			$this->CurrentPeriod->HrefValue = "";
			$this->CurrentPeriod->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// FiscalYear
			$this->FiscalYear->EditAttrs["class"] = "form-control";
			$this->FiscalYear->EditCustomAttributes = "";
			$this->FiscalYear->EditValue = HtmlEncode($this->FiscalYear->CurrentValue);
			$curVal = strval($this->FiscalYear->CurrentValue);
			if ($curVal != "") {
				$this->FiscalYear->EditValue = $this->FiscalYear->lookupCacheOption($curVal);
				if ($this->FiscalYear->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FiscalYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->FiscalYear->EditValue = $this->FiscalYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FiscalYear->EditValue = HtmlEncode($this->FiscalYear->CurrentValue);
					}
				}
			} else {
				$this->FiscalYear->EditValue = NULL;
			}
			$this->FiscalYear->PlaceHolder = RemoveHtml($this->FiscalYear->caption());

			// RunMonth
			$this->RunMonth->EditAttrs["class"] = "form-control";
			$this->RunMonth->EditCustomAttributes = "";
			$curVal = trim(strval($this->RunMonth->CurrentValue));
			if ($curVal != "")
				$this->RunMonth->ViewValue = $this->RunMonth->lookupCacheOption($curVal);
			else
				$this->RunMonth->ViewValue = $this->RunMonth->Lookup !== NULL && is_array($this->RunMonth->Lookup->Options) ? $curVal : NULL;
			if ($this->RunMonth->ViewValue !== NULL) { // Load from cache
				$this->RunMonth->EditValue = array_values($this->RunMonth->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MonthCode`" . SearchString("=", $this->RunMonth->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RunMonth->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RunMonth->EditValue = $arwrk;
			}

			// RunDescription
			$this->RunDescription->EditAttrs["class"] = "form-control";
			$this->RunDescription->EditCustomAttributes = "";
			$this->RunDescription->EditValue = HtmlEncode($this->RunDescription->CurrentValue);
			$this->RunDescription->PlaceHolder = RemoveHtml($this->RunDescription->caption());

			// CurrentPeriod
			$this->CurrentPeriod->EditCustomAttributes = "";
			$curVal = trim(strval($this->CurrentPeriod->CurrentValue));
			if ($curVal != "")
				$this->CurrentPeriod->ViewValue = $this->CurrentPeriod->lookupCacheOption($curVal);
			else
				$this->CurrentPeriod->ViewValue = $this->CurrentPeriod->Lookup !== NULL && is_array($this->CurrentPeriod->Lookup->Options) ? $curVal : NULL;
			if ($this->CurrentPeriod->ViewValue !== NULL) { // Load from cache
				$this->CurrentPeriod->EditValue = array_values($this->CurrentPeriod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->CurrentPeriod->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CurrentPeriod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CurrentPeriod->EditValue = $arwrk;
			}

			// Add refer script
			// FiscalYear

			$this->FiscalYear->LinkCustomAttributes = "";
			$this->FiscalYear->HrefValue = "";

			// RunMonth
			$this->RunMonth->LinkCustomAttributes = "";
			$this->RunMonth->HrefValue = "";

			// RunDescription
			$this->RunDescription->LinkCustomAttributes = "";
			$this->RunDescription->HrefValue = "";

			// CurrentPeriod
			$this->CurrentPeriod->LinkCustomAttributes = "";
			$this->CurrentPeriod->HrefValue = "";
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
		if ($this->FiscalYear->Required) {
			if (!$this->FiscalYear->IsDetailKey && $this->FiscalYear->FormValue != NULL && $this->FiscalYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FiscalYear->caption(), $this->FiscalYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FiscalYear->FormValue)) {
			AddMessage($FormError, $this->FiscalYear->errorMessage());
		}
		if ($this->RunMonth->Required) {
			if (!$this->RunMonth->IsDetailKey && $this->RunMonth->FormValue != NULL && $this->RunMonth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RunMonth->caption(), $this->RunMonth->RequiredErrorMessage));
			}
		}
		if ($this->RunDescription->Required) {
			if (!$this->RunDescription->IsDetailKey && $this->RunDescription->FormValue != NULL && $this->RunDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RunDescription->caption(), $this->RunDescription->RequiredErrorMessage));
			}
		}
		if ($this->CurrentPeriod->Required) {
			if ($this->CurrentPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrentPeriod->caption(), $this->CurrentPeriod->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("employee_employer_schedule_view", $detailTblVar) && $GLOBALS["employee_employer_schedule_view"]->DetailAdd) {
			if (!isset($GLOBALS["employee_employer_schedule_view_grid"]))
				$GLOBALS["employee_employer_schedule_view_grid"] = new employee_employer_schedule_view_grid(); // Get detail page object
			$GLOBALS["employee_employer_schedule_view_grid"]->validateGridForm();
		}
		if (in_array("obligation_schedule_view", $detailTblVar) && $GLOBALS["obligation_schedule_view"]->DetailAdd) {
			if (!isset($GLOBALS["obligation_schedule_view_grid"]))
				$GLOBALS["obligation_schedule_view_grid"] = new obligation_schedule_view_grid(); // Get detail page object
			$GLOBALS["obligation_schedule_view_grid"]->validateGridForm();
		}
		if (in_array("deduction_schedule_view", $detailTblVar) && $GLOBALS["deduction_schedule_view"]->DetailAdd) {
			if (!isset($GLOBALS["deduction_schedule_view_grid"]))
				$GLOBALS["deduction_schedule_view_grid"] = new deduction_schedule_view_grid(); // Get detail page object
			$GLOBALS["deduction_schedule_view_grid"]->validateGridForm();
		}
		if (in_array("income_schedule_view", $detailTblVar) && $GLOBALS["income_schedule_view"]->DetailAdd) {
			if (!isset($GLOBALS["income_schedule_view_grid"]))
				$GLOBALS["income_schedule_view_grid"] = new income_schedule_view_grid(); // Get detail page object
			$GLOBALS["income_schedule_view_grid"]->validateGridForm();
		}
		if (in_array("monthly_run", $detailTblVar) && $GLOBALS["monthly_run"]->DetailAdd) {
			if (!isset($GLOBALS["monthly_run_grid"]))
				$GLOBALS["monthly_run_grid"] = new monthly_run_grid(); // Get detail page object
			$GLOBALS["monthly_run_grid"]->validateGridForm();
		}
		if (in_array("payroll_summary_view", $detailTblVar) && $GLOBALS["payroll_summary_view"]->DetailAdd) {
			if (!isset($GLOBALS["payroll_summary_view_grid"]))
				$GLOBALS["payroll_summary_view_grid"] = new payroll_summary_view_grid(); // Get detail page object
			$GLOBALS["payroll_summary_view_grid"]->validateGridForm();
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

		// FiscalYear
		$this->FiscalYear->setDbValueDef($rsnew, $this->FiscalYear->CurrentValue, 0, FALSE);

		// RunMonth
		$this->RunMonth->setDbValueDef($rsnew, $this->RunMonth->CurrentValue, 0, FALSE);

		// RunDescription
		$this->RunDescription->setDbValueDef($rsnew, $this->RunDescription->CurrentValue, NULL, FALSE);

		// CurrentPeriod
		$this->CurrentPeriod->setDbValueDef($rsnew, $this->CurrentPeriod->CurrentValue, NULL, FALSE);

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
			if (in_array("employee_employer_schedule_view", $detailTblVar) && $GLOBALS["employee_employer_schedule_view"]->DetailAdd) {
				$GLOBALS["employee_employer_schedule_view"]->PeriodCode->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["employee_employer_schedule_view_grid"]))
					$GLOBALS["employee_employer_schedule_view_grid"] = new employee_employer_schedule_view_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "employee_employer_schedule_view"); // Load user level of detail table
				$addRow = $GLOBALS["employee_employer_schedule_view_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["employee_employer_schedule_view"]->PeriodCode->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("obligation_schedule_view", $detailTblVar) && $GLOBALS["obligation_schedule_view"]->DetailAdd) {
				$GLOBALS["obligation_schedule_view"]->PeriodCode->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["obligation_schedule_view_grid"]))
					$GLOBALS["obligation_schedule_view_grid"] = new obligation_schedule_view_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "obligation_schedule_view"); // Load user level of detail table
				$addRow = $GLOBALS["obligation_schedule_view_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["obligation_schedule_view"]->PeriodCode->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("deduction_schedule_view", $detailTblVar) && $GLOBALS["deduction_schedule_view"]->DetailAdd) {
				$GLOBALS["deduction_schedule_view"]->PeriodCode->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["deduction_schedule_view_grid"]))
					$GLOBALS["deduction_schedule_view_grid"] = new deduction_schedule_view_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "deduction_schedule_view"); // Load user level of detail table
				$addRow = $GLOBALS["deduction_schedule_view_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["deduction_schedule_view"]->PeriodCode->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("income_schedule_view", $detailTblVar) && $GLOBALS["income_schedule_view"]->DetailAdd) {
				$GLOBALS["income_schedule_view"]->PeriodCode->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["income_schedule_view_grid"]))
					$GLOBALS["income_schedule_view_grid"] = new income_schedule_view_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "income_schedule_view"); // Load user level of detail table
				$addRow = $GLOBALS["income_schedule_view_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["income_schedule_view"]->PeriodCode->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("monthly_run", $detailTblVar) && $GLOBALS["monthly_run"]->DetailAdd) {
				$GLOBALS["monthly_run"]->PeriodCode->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				$GLOBALS["monthly_run"]->Year->setSessionValue($this->FiscalYear->CurrentValue); // Set master key
				$GLOBALS["monthly_run"]->RunMonth->setSessionValue($this->RunMonth->CurrentValue); // Set master key
				if (!isset($GLOBALS["monthly_run_grid"]))
					$GLOBALS["monthly_run_grid"] = new monthly_run_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "monthly_run"); // Load user level of detail table
				$addRow = $GLOBALS["monthly_run_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["monthly_run"]->PeriodCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["monthly_run"]->Year->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["monthly_run"]->RunMonth->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("payroll_summary_view", $detailTblVar) && $GLOBALS["payroll_summary_view"]->DetailAdd) {
				$GLOBALS["payroll_summary_view"]->PayrollPeriod->setSessionValue($this->PeriodCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["payroll_summary_view_grid"]))
					$GLOBALS["payroll_summary_view_grid"] = new payroll_summary_view_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "payroll_summary_view"); // Load user level of detail table
				$addRow = $GLOBALS["payroll_summary_view_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["payroll_summary_view"]->PayrollPeriod->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("employee_employer_schedule_view", $detailTblVar)) {
				if (!isset($GLOBALS["employee_employer_schedule_view_grid"]))
					$GLOBALS["employee_employer_schedule_view_grid"] = new employee_employer_schedule_view_grid();
				if ($GLOBALS["employee_employer_schedule_view_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["employee_employer_schedule_view_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["employee_employer_schedule_view_grid"]->CurrentMode = "add";
					$GLOBALS["employee_employer_schedule_view_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["employee_employer_schedule_view_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employee_employer_schedule_view_grid"]->setStartRecordNumber(1);
					$GLOBALS["employee_employer_schedule_view_grid"]->PeriodCode->IsDetailKey = TRUE;
					$GLOBALS["employee_employer_schedule_view_grid"]->PeriodCode->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["employee_employer_schedule_view_grid"]->PeriodCode->setSessionValue($GLOBALS["employee_employer_schedule_view_grid"]->PeriodCode->CurrentValue);
				}
			}
			if (in_array("obligation_schedule_view", $detailTblVar)) {
				if (!isset($GLOBALS["obligation_schedule_view_grid"]))
					$GLOBALS["obligation_schedule_view_grid"] = new obligation_schedule_view_grid();
				if ($GLOBALS["obligation_schedule_view_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["obligation_schedule_view_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["obligation_schedule_view_grid"]->CurrentMode = "add";
					$GLOBALS["obligation_schedule_view_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["obligation_schedule_view_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["obligation_schedule_view_grid"]->setStartRecordNumber(1);
					$GLOBALS["obligation_schedule_view_grid"]->PeriodCode->IsDetailKey = TRUE;
					$GLOBALS["obligation_schedule_view_grid"]->PeriodCode->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["obligation_schedule_view_grid"]->PeriodCode->setSessionValue($GLOBALS["obligation_schedule_view_grid"]->PeriodCode->CurrentValue);
				}
			}
			if (in_array("deduction_schedule_view", $detailTblVar)) {
				if (!isset($GLOBALS["deduction_schedule_view_grid"]))
					$GLOBALS["deduction_schedule_view_grid"] = new deduction_schedule_view_grid();
				if ($GLOBALS["deduction_schedule_view_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["deduction_schedule_view_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["deduction_schedule_view_grid"]->CurrentMode = "add";
					$GLOBALS["deduction_schedule_view_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["deduction_schedule_view_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["deduction_schedule_view_grid"]->setStartRecordNumber(1);
					$GLOBALS["deduction_schedule_view_grid"]->PeriodCode->IsDetailKey = TRUE;
					$GLOBALS["deduction_schedule_view_grid"]->PeriodCode->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["deduction_schedule_view_grid"]->PeriodCode->setSessionValue($GLOBALS["deduction_schedule_view_grid"]->PeriodCode->CurrentValue);
				}
			}
			if (in_array("income_schedule_view", $detailTblVar)) {
				if (!isset($GLOBALS["income_schedule_view_grid"]))
					$GLOBALS["income_schedule_view_grid"] = new income_schedule_view_grid();
				if ($GLOBALS["income_schedule_view_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["income_schedule_view_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["income_schedule_view_grid"]->CurrentMode = "add";
					$GLOBALS["income_schedule_view_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["income_schedule_view_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["income_schedule_view_grid"]->setStartRecordNumber(1);
					$GLOBALS["income_schedule_view_grid"]->PeriodCode->IsDetailKey = TRUE;
					$GLOBALS["income_schedule_view_grid"]->PeriodCode->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["income_schedule_view_grid"]->PeriodCode->setSessionValue($GLOBALS["income_schedule_view_grid"]->PeriodCode->CurrentValue);
				}
			}
			if (in_array("monthly_run", $detailTblVar)) {
				if (!isset($GLOBALS["monthly_run_grid"]))
					$GLOBALS["monthly_run_grid"] = new monthly_run_grid();
				if ($GLOBALS["monthly_run_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["monthly_run_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["monthly_run_grid"]->CurrentMode = "add";
					$GLOBALS["monthly_run_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["monthly_run_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["monthly_run_grid"]->setStartRecordNumber(1);
					$GLOBALS["monthly_run_grid"]->PeriodCode->IsDetailKey = TRUE;
					$GLOBALS["monthly_run_grid"]->PeriodCode->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["monthly_run_grid"]->PeriodCode->setSessionValue($GLOBALS["monthly_run_grid"]->PeriodCode->CurrentValue);
					$GLOBALS["monthly_run_grid"]->Year->IsDetailKey = TRUE;
					$GLOBALS["monthly_run_grid"]->Year->CurrentValue = $this->FiscalYear->CurrentValue;
					$GLOBALS["monthly_run_grid"]->Year->setSessionValue($GLOBALS["monthly_run_grid"]->Year->CurrentValue);
					$GLOBALS["monthly_run_grid"]->RunMonth->IsDetailKey = TRUE;
					$GLOBALS["monthly_run_grid"]->RunMonth->CurrentValue = $this->RunMonth->CurrentValue;
					$GLOBALS["monthly_run_grid"]->RunMonth->setSessionValue($GLOBALS["monthly_run_grid"]->RunMonth->CurrentValue);
					$GLOBALS["monthly_run_grid"]->LACode->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("payroll_summary_view", $detailTblVar)) {
				if (!isset($GLOBALS["payroll_summary_view_grid"]))
					$GLOBALS["payroll_summary_view_grid"] = new payroll_summary_view_grid();
				if ($GLOBALS["payroll_summary_view_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["payroll_summary_view_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["payroll_summary_view_grid"]->CurrentMode = "add";
					$GLOBALS["payroll_summary_view_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["payroll_summary_view_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["payroll_summary_view_grid"]->setStartRecordNumber(1);
					$GLOBALS["payroll_summary_view_grid"]->PayrollPeriod->IsDetailKey = TRUE;
					$GLOBALS["payroll_summary_view_grid"]->PayrollPeriod->CurrentValue = $this->PeriodCode->CurrentValue;
					$GLOBALS["payroll_summary_view_grid"]->PayrollPeriod->setSessionValue($GLOBALS["payroll_summary_view_grid"]->PayrollPeriod->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("payroll_periodlist.php"), "", $this->TableVar, TRUE);
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
				case "x_FiscalYear":
					break;
				case "x_RunMonth":
					break;
				case "x_CurrentPeriod":
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
						case "x_FiscalYear":
							break;
						case "x_RunMonth":
							break;
						case "x_CurrentPeriod":
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