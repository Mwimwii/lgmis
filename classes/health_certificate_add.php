<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class health_certificate_add extends health_certificate
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'health_certificate';

	// Page object name
	public $PageObjName = "health_certificate_add";

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

		// Table object (health_certificate)
		if (!isset($GLOBALS["health_certificate"]) || get_class($GLOBALS["health_certificate"]) == PROJECT_NAMESPACE . "health_certificate") {
			$GLOBALS["health_certificate"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["health_certificate"];
		}

		// Table object (licence_account)
		if (!isset($GLOBALS['licence_account']))
			$GLOBALS['licence_account'] = new licence_account();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'health_certificate');

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
		global $health_certificate;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($health_certificate);
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
					if ($pageName == "health_certificateview.php")
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
			$key .= @$ar['HealthCertificateNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['LicenceNo'];
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
			$this->HealthCertificateNo->Visible = FALSE;
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
					$this->terminate(GetUrl("health_certificatelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->HealthCertificateNo->Visible = FALSE;
		$this->LicenceNo->setVisibility();
		$this->BusinessNo->setVisibility();
		$this->InspectionReport->setVisibility();
		$this->InspectionDate->setVisibility();
		$this->InspectedBy->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->BalanceBF->setVisibility();
		$this->CurrentDemand->setVisibility();
		$this->VAT->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->PeriodType->setVisibility();
		$this->BillYear->setVisibility();
		$this->StartDate->setVisibility();
		$this->EndDate->setVisibility();
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
			$this->terminate("health_certificatelist.php");
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
			if (Get("HealthCertificateNo") !== NULL) {
				$this->HealthCertificateNo->setQueryStringValue(Get("HealthCertificateNo"));
				$this->setKey("HealthCertificateNo", $this->HealthCertificateNo->CurrentValue); // Set up key
			} else {
				$this->setKey("HealthCertificateNo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("LicenceNo") !== NULL) {
				$this->LicenceNo->setQueryStringValue(Get("LicenceNo"));
				$this->setKey("LicenceNo", $this->LicenceNo->CurrentValue); // Set up key
			} else {
				$this->setKey("LicenceNo", ""); // Clear key
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
					$this->terminate("health_certificatelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "health_certificatelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "health_certificateview.php")
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
		$this->HealthCertificateNo->CurrentValue = NULL;
		$this->HealthCertificateNo->OldValue = $this->HealthCertificateNo->CurrentValue;
		$this->LicenceNo->CurrentValue = NULL;
		$this->LicenceNo->OldValue = $this->LicenceNo->CurrentValue;
		$this->BusinessNo->CurrentValue = NULL;
		$this->BusinessNo->OldValue = $this->BusinessNo->CurrentValue;
		$this->InspectionReport->CurrentValue = NULL;
		$this->InspectionReport->OldValue = $this->InspectionReport->CurrentValue;
		$this->InspectionDate->CurrentValue = NULL;
		$this->InspectionDate->OldValue = $this->InspectionDate->CurrentValue;
		$this->InspectedBy->CurrentValue = NULL;
		$this->InspectedBy->OldValue = $this->InspectedBy->CurrentValue;
		$this->ChargeCode->CurrentValue = NULL;
		$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->BalanceBF->CurrentValue = 0;
		$this->CurrentDemand->CurrentValue = 0;
		$this->VAT->CurrentValue = 0;
		$this->AmountPaid->CurrentValue = 0;
		$this->BillPeriod->CurrentValue = 1;
		$this->PeriodType->CurrentValue = "1";
		$this->BillYear->CurrentValue = NULL;
		$this->BillYear->OldValue = $this->BillYear->CurrentValue;
		$this->StartDate->CurrentValue = NULL;
		$this->StartDate->OldValue = $this->StartDate->CurrentValue;
		$this->EndDate->CurrentValue = NULL;
		$this->EndDate->OldValue = $this->EndDate->CurrentValue;
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

		// Check field name 'LicenceNo' first before field var 'x_LicenceNo'
		$val = $CurrentForm->hasValue("LicenceNo") ? $CurrentForm->getValue("LicenceNo") : $CurrentForm->getValue("x_LicenceNo");
		if (!$this->LicenceNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LicenceNo->Visible = FALSE; // Disable update for API request
			else
				$this->LicenceNo->setFormValue($val);
		}

		// Check field name 'BusinessNo' first before field var 'x_BusinessNo'
		$val = $CurrentForm->hasValue("BusinessNo") ? $CurrentForm->getValue("BusinessNo") : $CurrentForm->getValue("x_BusinessNo");
		if (!$this->BusinessNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessNo->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessNo->setFormValue($val);
		}

		// Check field name 'InspectionReport' first before field var 'x_InspectionReport'
		$val = $CurrentForm->hasValue("InspectionReport") ? $CurrentForm->getValue("InspectionReport") : $CurrentForm->getValue("x_InspectionReport");
		if (!$this->InspectionReport->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->InspectionReport->Visible = FALSE; // Disable update for API request
			else
				$this->InspectionReport->setFormValue($val);
		}

		// Check field name 'InspectionDate' first before field var 'x_InspectionDate'
		$val = $CurrentForm->hasValue("InspectionDate") ? $CurrentForm->getValue("InspectionDate") : $CurrentForm->getValue("x_InspectionDate");
		if (!$this->InspectionDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->InspectionDate->Visible = FALSE; // Disable update for API request
			else
				$this->InspectionDate->setFormValue($val);
			$this->InspectionDate->CurrentValue = UnFormatDateTime($this->InspectionDate->CurrentValue, 0);
		}

		// Check field name 'InspectedBy' first before field var 'x_InspectedBy'
		$val = $CurrentForm->hasValue("InspectedBy") ? $CurrentForm->getValue("InspectedBy") : $CurrentForm->getValue("x_InspectedBy");
		if (!$this->InspectedBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->InspectedBy->Visible = FALSE; // Disable update for API request
			else
				$this->InspectedBy->setFormValue($val);
		}

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeCode->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'BalanceBF' first before field var 'x_BalanceBF'
		$val = $CurrentForm->hasValue("BalanceBF") ? $CurrentForm->getValue("BalanceBF") : $CurrentForm->getValue("x_BalanceBF");
		if (!$this->BalanceBF->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BalanceBF->Visible = FALSE; // Disable update for API request
			else
				$this->BalanceBF->setFormValue($val);
		}

		// Check field name 'CurrentDemand' first before field var 'x_CurrentDemand'
		$val = $CurrentForm->hasValue("CurrentDemand") ? $CurrentForm->getValue("CurrentDemand") : $CurrentForm->getValue("x_CurrentDemand");
		if (!$this->CurrentDemand->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentDemand->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentDemand->setFormValue($val);
		}

		// Check field name 'VAT' first before field var 'x_VAT'
		$val = $CurrentForm->hasValue("VAT") ? $CurrentForm->getValue("VAT") : $CurrentForm->getValue("x_VAT");
		if (!$this->VAT->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->VAT->Visible = FALSE; // Disable update for API request
			else
				$this->VAT->setFormValue($val);
		}

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}

		// Check field name 'BillPeriod' first before field var 'x_BillPeriod'
		$val = $CurrentForm->hasValue("BillPeriod") ? $CurrentForm->getValue("BillPeriod") : $CurrentForm->getValue("x_BillPeriod");
		if (!$this->BillPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->BillPeriod->setFormValue($val);
		}

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}

		// Check field name 'BillYear' first before field var 'x_BillYear'
		$val = $CurrentForm->hasValue("BillYear") ? $CurrentForm->getValue("BillYear") : $CurrentForm->getValue("x_BillYear");
		if (!$this->BillYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillYear->Visible = FALSE; // Disable update for API request
			else
				$this->BillYear->setFormValue($val);
		}

		// Check field name 'StartDate' first before field var 'x_StartDate'
		$val = $CurrentForm->hasValue("StartDate") ? $CurrentForm->getValue("StartDate") : $CurrentForm->getValue("x_StartDate");
		if (!$this->StartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StartDate->Visible = FALSE; // Disable update for API request
			else
				$this->StartDate->setFormValue($val);
			$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		}

		// Check field name 'EndDate' first before field var 'x_EndDate'
		$val = $CurrentForm->hasValue("EndDate") ? $CurrentForm->getValue("EndDate") : $CurrentForm->getValue("x_EndDate");
		if (!$this->EndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EndDate->Visible = FALSE; // Disable update for API request
			else
				$this->EndDate->setFormValue($val);
			$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
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

		// Check field name 'HealthCertificateNo' first before field var 'x_HealthCertificateNo'
		$val = $CurrentForm->hasValue("HealthCertificateNo") ? $CurrentForm->getValue("HealthCertificateNo") : $CurrentForm->getValue("x_HealthCertificateNo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LicenceNo->CurrentValue = $this->LicenceNo->FormValue;
		$this->BusinessNo->CurrentValue = $this->BusinessNo->FormValue;
		$this->InspectionReport->CurrentValue = $this->InspectionReport->FormValue;
		$this->InspectionDate->CurrentValue = $this->InspectionDate->FormValue;
		$this->InspectionDate->CurrentValue = UnFormatDateTime($this->InspectionDate->CurrentValue, 0);
		$this->InspectedBy->CurrentValue = $this->InspectedBy->FormValue;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->BalanceBF->CurrentValue = $this->BalanceBF->FormValue;
		$this->CurrentDemand->CurrentValue = $this->CurrentDemand->FormValue;
		$this->VAT->CurrentValue = $this->VAT->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->BillPeriod->CurrentValue = $this->BillPeriod->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->BillYear->CurrentValue = $this->BillYear->FormValue;
		$this->StartDate->CurrentValue = $this->StartDate->FormValue;
		$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		$this->EndDate->CurrentValue = $this->EndDate->FormValue;
		$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
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
		$this->HealthCertificateNo->setDbValue($row['HealthCertificateNo']);
		$this->LicenceNo->setDbValue($row['LicenceNo']);
		$this->BusinessNo->setDbValue($row['BusinessNo']);
		$this->InspectionReport->setDbValue($row['InspectionReport']);
		$this->InspectionDate->setDbValue($row['InspectionDate']);
		$this->InspectedBy->setDbValue($row['InspectedBy']);
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->BalanceBF->setDbValue($row['BalanceBF']);
		$this->CurrentDemand->setDbValue($row['CurrentDemand']);
		$this->VAT->setDbValue($row['VAT']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->BillPeriod->setDbValue($row['BillPeriod']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->BillYear->setDbValue($row['BillYear']);
		$this->StartDate->setDbValue($row['StartDate']);
		$this->EndDate->setDbValue($row['EndDate']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['HealthCertificateNo'] = $this->HealthCertificateNo->CurrentValue;
		$row['LicenceNo'] = $this->LicenceNo->CurrentValue;
		$row['BusinessNo'] = $this->BusinessNo->CurrentValue;
		$row['InspectionReport'] = $this->InspectionReport->CurrentValue;
		$row['InspectionDate'] = $this->InspectionDate->CurrentValue;
		$row['InspectedBy'] = $this->InspectedBy->CurrentValue;
		$row['ChargeCode'] = $this->ChargeCode->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['BalanceBF'] = $this->BalanceBF->CurrentValue;
		$row['CurrentDemand'] = $this->CurrentDemand->CurrentValue;
		$row['VAT'] = $this->VAT->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['BillPeriod'] = $this->BillPeriod->CurrentValue;
		$row['PeriodType'] = $this->PeriodType->CurrentValue;
		$row['BillYear'] = $this->BillYear->CurrentValue;
		$row['StartDate'] = $this->StartDate->CurrentValue;
		$row['EndDate'] = $this->EndDate->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("HealthCertificateNo")) != "")
			$this->HealthCertificateNo->OldValue = $this->getKey("HealthCertificateNo"); // HealthCertificateNo
		else
			$validKey = FALSE;
		if (strval($this->getKey("LicenceNo")) != "")
			$this->LicenceNo->OldValue = $this->getKey("LicenceNo"); // LicenceNo
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

		if ($this->BalanceBF->FormValue == $this->BalanceBF->CurrentValue && is_numeric(ConvertToFloatString($this->BalanceBF->CurrentValue)))
			$this->BalanceBF->CurrentValue = ConvertToFloatString($this->BalanceBF->CurrentValue);

		// Convert decimal values if posted back
		if ($this->CurrentDemand->FormValue == $this->CurrentDemand->CurrentValue && is_numeric(ConvertToFloatString($this->CurrentDemand->CurrentValue)))
			$this->CurrentDemand->CurrentValue = ConvertToFloatString($this->CurrentDemand->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VAT->FormValue == $this->VAT->CurrentValue && is_numeric(ConvertToFloatString($this->VAT->CurrentValue)))
			$this->VAT->CurrentValue = ConvertToFloatString($this->VAT->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// HealthCertificateNo
		// LicenceNo
		// BusinessNo
		// InspectionReport
		// InspectionDate
		// InspectedBy
		// ChargeCode
		// ChargeGroup
		// BalanceBF
		// CurrentDemand
		// VAT
		// AmountPaid
		// BillPeriod
		// PeriodType
		// BillYear
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// HealthCertificateNo
			$this->HealthCertificateNo->ViewValue = $this->HealthCertificateNo->CurrentValue;
			$this->HealthCertificateNo->ViewCustomAttributes = "";

			// LicenceNo
			$this->LicenceNo->ViewValue = $this->LicenceNo->CurrentValue;
			$this->LicenceNo->ViewValue = FormatNumber($this->LicenceNo->ViewValue, 0, -2, -2, -2);
			$this->LicenceNo->ViewCustomAttributes = "";

			// BusinessNo
			$this->BusinessNo->ViewValue = $this->BusinessNo->CurrentValue;
			$this->BusinessNo->ViewValue = FormatNumber($this->BusinessNo->ViewValue, 0, -2, -2, -2);
			$this->BusinessNo->ViewCustomAttributes = "";

			// InspectionReport
			$this->InspectionReport->ViewValue = $this->InspectionReport->CurrentValue;
			$this->InspectionReport->ViewCustomAttributes = "";

			// InspectionDate
			$this->InspectionDate->ViewValue = $this->InspectionDate->CurrentValue;
			$this->InspectionDate->ViewValue = FormatDateTime($this->InspectionDate->ViewValue, 0);
			$this->InspectionDate->ViewCustomAttributes = "";

			// InspectedBy
			$this->InspectedBy->ViewValue = $this->InspectedBy->CurrentValue;
			$this->InspectedBy->ViewCustomAttributes = "";

			// ChargeCode
			$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewValue = FormatNumber($this->ChargeCode->ViewValue, 0, -2, -2, -2);
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewValue = FormatNumber($this->ChargeGroup->ViewValue, 0, -2, -2, -2);
			$this->ChargeGroup->ViewCustomAttributes = "";

			// BalanceBF
			$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
			$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
			$this->BalanceBF->ViewCustomAttributes = "";

			// CurrentDemand
			$this->CurrentDemand->ViewValue = $this->CurrentDemand->CurrentValue;
			$this->CurrentDemand->ViewValue = FormatNumber($this->CurrentDemand->ViewValue, 2, -2, -2, -2);
			$this->CurrentDemand->ViewCustomAttributes = "";

			// VAT
			$this->VAT->ViewValue = $this->VAT->CurrentValue;
			$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
			$this->VAT->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
			$this->BillPeriod->ViewCustomAttributes = "";

			// PeriodType
			$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
			$this->PeriodType->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewValue = FormatNumber($this->BillYear->ViewValue, 0, -2, -2, -2);
			$this->BillYear->ViewCustomAttributes = "";

			// StartDate
			$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
			$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
			$this->StartDate->ViewCustomAttributes = "";

			// EndDate
			$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
			$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
			$this->EndDate->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// LicenceNo
			$this->LicenceNo->LinkCustomAttributes = "";
			$this->LicenceNo->HrefValue = "";
			$this->LicenceNo->TooltipValue = "";

			// BusinessNo
			$this->BusinessNo->LinkCustomAttributes = "";
			$this->BusinessNo->HrefValue = "";
			$this->BusinessNo->TooltipValue = "";

			// InspectionReport
			$this->InspectionReport->LinkCustomAttributes = "";
			$this->InspectionReport->HrefValue = "";
			$this->InspectionReport->TooltipValue = "";

			// InspectionDate
			$this->InspectionDate->LinkCustomAttributes = "";
			$this->InspectionDate->HrefValue = "";
			$this->InspectionDate->TooltipValue = "";

			// InspectedBy
			$this->InspectedBy->LinkCustomAttributes = "";
			$this->InspectedBy->HrefValue = "";
			$this->InspectedBy->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";
			$this->BalanceBF->TooltipValue = "";

			// CurrentDemand
			$this->CurrentDemand->LinkCustomAttributes = "";
			$this->CurrentDemand->HrefValue = "";
			$this->CurrentDemand->TooltipValue = "";

			// VAT
			$this->VAT->LinkCustomAttributes = "";
			$this->VAT->HrefValue = "";
			$this->VAT->TooltipValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";
			$this->StartDate->TooltipValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
			$this->EndDate->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LicenceNo
			$this->LicenceNo->EditAttrs["class"] = "form-control";
			$this->LicenceNo->EditCustomAttributes = "";
			if ($this->LicenceNo->getSessionValue() != "") {
				$this->LicenceNo->CurrentValue = $this->LicenceNo->getSessionValue();
				$this->LicenceNo->ViewValue = $this->LicenceNo->CurrentValue;
				$this->LicenceNo->ViewValue = FormatNumber($this->LicenceNo->ViewValue, 0, -2, -2, -2);
				$this->LicenceNo->ViewCustomAttributes = "";
			} else {
				$this->LicenceNo->EditValue = HtmlEncode($this->LicenceNo->CurrentValue);
				$this->LicenceNo->PlaceHolder = RemoveHtml($this->LicenceNo->caption());
			}

			// BusinessNo
			$this->BusinessNo->EditAttrs["class"] = "form-control";
			$this->BusinessNo->EditCustomAttributes = "";
			if ($this->BusinessNo->getSessionValue() != "") {
				$this->BusinessNo->CurrentValue = $this->BusinessNo->getSessionValue();
				$this->BusinessNo->ViewValue = $this->BusinessNo->CurrentValue;
				$this->BusinessNo->ViewValue = FormatNumber($this->BusinessNo->ViewValue, 0, -2, -2, -2);
				$this->BusinessNo->ViewCustomAttributes = "";
			} else {
				$this->BusinessNo->EditValue = HtmlEncode($this->BusinessNo->CurrentValue);
				$this->BusinessNo->PlaceHolder = RemoveHtml($this->BusinessNo->caption());
			}

			// InspectionReport
			$this->InspectionReport->EditAttrs["class"] = "form-control";
			$this->InspectionReport->EditCustomAttributes = "";
			$this->InspectionReport->EditValue = HtmlEncode($this->InspectionReport->CurrentValue);
			$this->InspectionReport->PlaceHolder = RemoveHtml($this->InspectionReport->caption());

			// InspectionDate
			$this->InspectionDate->EditAttrs["class"] = "form-control";
			$this->InspectionDate->EditCustomAttributes = "";
			$this->InspectionDate->EditValue = HtmlEncode(FormatDateTime($this->InspectionDate->CurrentValue, 8));
			$this->InspectionDate->PlaceHolder = RemoveHtml($this->InspectionDate->caption());

			// InspectedBy
			$this->InspectedBy->EditAttrs["class"] = "form-control";
			$this->InspectedBy->EditCustomAttributes = "";
			if (!$this->InspectedBy->Raw)
				$this->InspectedBy->CurrentValue = HtmlDecode($this->InspectedBy->CurrentValue);
			$this->InspectedBy->EditValue = HtmlEncode($this->InspectedBy->CurrentValue);
			$this->InspectedBy->PlaceHolder = RemoveHtml($this->InspectedBy->caption());

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->CurrentValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
			if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
				$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, -2, -2, -2);
			

			// CurrentDemand
			$this->CurrentDemand->EditAttrs["class"] = "form-control";
			$this->CurrentDemand->EditCustomAttributes = "";
			$this->CurrentDemand->EditValue = HtmlEncode($this->CurrentDemand->CurrentValue);
			$this->CurrentDemand->PlaceHolder = RemoveHtml($this->CurrentDemand->caption());
			if (strval($this->CurrentDemand->EditValue) != "" && is_numeric($this->CurrentDemand->EditValue))
				$this->CurrentDemand->EditValue = FormatNumber($this->CurrentDemand->EditValue, -2, -2, -2, -2);
			

			// VAT
			$this->VAT->EditAttrs["class"] = "form-control";
			$this->VAT->EditCustomAttributes = "";
			$this->VAT->EditValue = HtmlEncode($this->VAT->CurrentValue);
			$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());
			if (strval($this->VAT->EditValue) != "" && is_numeric($this->VAT->EditValue))
				$this->VAT->EditValue = FormatNumber($this->VAT->EditValue, -2, -2, -2, -2);
			

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
			

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			if ($this->BillPeriod->getSessionValue() != "") {
				$this->BillPeriod->CurrentValue = $this->BillPeriod->getSessionValue();
				$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
				$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
				$this->BillPeriod->ViewCustomAttributes = "";
			} else {
				$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
				$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());
			}

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			if ($this->PeriodType->getSessionValue() != "") {
				$this->PeriodType->CurrentValue = $this->PeriodType->getSessionValue();
				$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
				$this->PeriodType->ViewCustomAttributes = "";
			} else {
				if (!$this->PeriodType->Raw)
					$this->PeriodType->CurrentValue = HtmlDecode($this->PeriodType->CurrentValue);
				$this->PeriodType->EditValue = HtmlEncode($this->PeriodType->CurrentValue);
				$this->PeriodType->PlaceHolder = RemoveHtml($this->PeriodType->caption());
			}

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			if ($this->BillYear->getSessionValue() != "") {
				$this->BillYear->CurrentValue = $this->BillYear->getSessionValue();
				$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
				$this->BillYear->ViewValue = FormatNumber($this->BillYear->ViewValue, 0, -2, -2, -2);
				$this->BillYear->ViewCustomAttributes = "";
			} else {
				$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
				$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());
			}

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime($this->StartDate->CurrentValue, 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime($this->EndDate->CurrentValue, 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

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
			// LicenceNo

			$this->LicenceNo->LinkCustomAttributes = "";
			$this->LicenceNo->HrefValue = "";

			// BusinessNo
			$this->BusinessNo->LinkCustomAttributes = "";
			$this->BusinessNo->HrefValue = "";

			// InspectionReport
			$this->InspectionReport->LinkCustomAttributes = "";
			$this->InspectionReport->HrefValue = "";

			// InspectionDate
			$this->InspectionDate->LinkCustomAttributes = "";
			$this->InspectionDate->HrefValue = "";

			// InspectedBy
			$this->InspectedBy->LinkCustomAttributes = "";
			$this->InspectedBy->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";

			// CurrentDemand
			$this->CurrentDemand->LinkCustomAttributes = "";
			$this->CurrentDemand->HrefValue = "";

			// VAT
			$this->VAT->LinkCustomAttributes = "";
			$this->VAT->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";

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
		if ($this->LicenceNo->Required) {
			if (!$this->LicenceNo->IsDetailKey && $this->LicenceNo->FormValue != NULL && $this->LicenceNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LicenceNo->caption(), $this->LicenceNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->LicenceNo->FormValue)) {
			AddMessage($FormError, $this->LicenceNo->errorMessage());
		}
		if ($this->BusinessNo->Required) {
			if (!$this->BusinessNo->IsDetailKey && $this->BusinessNo->FormValue != NULL && $this->BusinessNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessNo->caption(), $this->BusinessNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BusinessNo->FormValue)) {
			AddMessage($FormError, $this->BusinessNo->errorMessage());
		}
		if ($this->InspectionReport->Required) {
			if (!$this->InspectionReport->IsDetailKey && $this->InspectionReport->FormValue != NULL && $this->InspectionReport->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InspectionReport->caption(), $this->InspectionReport->RequiredErrorMessage));
			}
		}
		if ($this->InspectionDate->Required) {
			if (!$this->InspectionDate->IsDetailKey && $this->InspectionDate->FormValue != NULL && $this->InspectionDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InspectionDate->caption(), $this->InspectionDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->InspectionDate->FormValue)) {
			AddMessage($FormError, $this->InspectionDate->errorMessage());
		}
		if ($this->InspectedBy->Required) {
			if (!$this->InspectedBy->IsDetailKey && $this->InspectedBy->FormValue != NULL && $this->InspectedBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InspectedBy->caption(), $this->InspectedBy->RequiredErrorMessage));
			}
		}
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeCode->FormValue)) {
			AddMessage($FormError, $this->ChargeCode->errorMessage());
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeGroup->FormValue)) {
			AddMessage($FormError, $this->ChargeGroup->errorMessage());
		}
		if ($this->BalanceBF->Required) {
			if (!$this->BalanceBF->IsDetailKey && $this->BalanceBF->FormValue != NULL && $this->BalanceBF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BalanceBF->caption(), $this->BalanceBF->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BalanceBF->FormValue)) {
			AddMessage($FormError, $this->BalanceBF->errorMessage());
		}
		if ($this->CurrentDemand->Required) {
			if (!$this->CurrentDemand->IsDetailKey && $this->CurrentDemand->FormValue != NULL && $this->CurrentDemand->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrentDemand->caption(), $this->CurrentDemand->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->CurrentDemand->FormValue)) {
			AddMessage($FormError, $this->CurrentDemand->errorMessage());
		}
		if ($this->VAT->Required) {
			if (!$this->VAT->IsDetailKey && $this->VAT->FormValue != NULL && $this->VAT->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VAT->caption(), $this->VAT->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->VAT->FormValue)) {
			AddMessage($FormError, $this->VAT->errorMessage());
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->BillPeriod->Required) {
			if (!$this->BillPeriod->IsDetailKey && $this->BillPeriod->FormValue != NULL && $this->BillPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillPeriod->caption(), $this->BillPeriod->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillPeriod->FormValue)) {
			AddMessage($FormError, $this->BillPeriod->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if ($this->BillYear->Required) {
			if (!$this->BillYear->IsDetailKey && $this->BillYear->FormValue != NULL && $this->BillYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillYear->caption(), $this->BillYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillYear->FormValue)) {
			AddMessage($FormError, $this->BillYear->errorMessage());
		}
		if ($this->StartDate->Required) {
			if (!$this->StartDate->IsDetailKey && $this->StartDate->FormValue != NULL && $this->StartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StartDate->caption(), $this->StartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->StartDate->FormValue)) {
			AddMessage($FormError, $this->StartDate->errorMessage());
		}
		if ($this->EndDate->Required) {
			if (!$this->EndDate->IsDetailKey && $this->EndDate->FormValue != NULL && $this->EndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EndDate->caption(), $this->EndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->EndDate->FormValue)) {
			AddMessage($FormError, $this->EndDate->errorMessage());
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

		// LicenceNo
		$this->LicenceNo->setDbValueDef($rsnew, $this->LicenceNo->CurrentValue, 0, FALSE);

		// BusinessNo
		$this->BusinessNo->setDbValueDef($rsnew, $this->BusinessNo->CurrentValue, 0, FALSE);

		// InspectionReport
		$this->InspectionReport->setDbValueDef($rsnew, $this->InspectionReport->CurrentValue, NULL, FALSE);

		// InspectionDate
		$this->InspectionDate->setDbValueDef($rsnew, UnFormatDateTime($this->InspectionDate->CurrentValue, 0), NULL, FALSE);

		// InspectedBy
		$this->InspectedBy->setDbValueDef($rsnew, $this->InspectedBy->CurrentValue, NULL, FALSE);

		// ChargeCode
		$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, FALSE);

		// BalanceBF
		$this->BalanceBF->setDbValueDef($rsnew, $this->BalanceBF->CurrentValue, NULL, strval($this->BalanceBF->CurrentValue) == "");

		// CurrentDemand
		$this->CurrentDemand->setDbValueDef($rsnew, $this->CurrentDemand->CurrentValue, NULL, strval($this->CurrentDemand->CurrentValue) == "");

		// VAT
		$this->VAT->setDbValueDef($rsnew, $this->VAT->CurrentValue, NULL, strval($this->VAT->CurrentValue) == "");

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, strval($this->AmountPaid->CurrentValue) == "");

		// BillPeriod
		$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, strval($this->BillPeriod->CurrentValue) == "");

		// PeriodType
		$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, strval($this->PeriodType->CurrentValue) == "");

		// BillYear
		$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, FALSE);

		// StartDate
		$this->StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->StartDate->CurrentValue, 0), NULL, FALSE);

		// EndDate
		$this->EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->EndDate->CurrentValue, 0), NULL, FALSE);

		// LastUpdatedBy
		$this->LastUpdatedBy->setDbValueDef($rsnew, $this->LastUpdatedBy->CurrentValue, NULL, FALSE);

		// LastUpdateDate
		$this->LastUpdateDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['LicenceNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
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
			if ($masterTblVar == "licence_account") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LicenceNo", Get("LicenceNo"))) !== NULL) {
					$GLOBALS["licence_account"]->LicenceNo->setQueryStringValue($parm);
					$this->LicenceNo->setQueryStringValue($GLOBALS["licence_account"]->LicenceNo->QueryStringValue);
					$this->LicenceNo->setSessionValue($this->LicenceNo->QueryStringValue);
					if (!is_numeric($GLOBALS["licence_account"]->LicenceNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_BusinessNo", Get("BusinessNo"))) !== NULL) {
					$GLOBALS["licence_account"]->BusinessNo->setQueryStringValue($parm);
					$this->BusinessNo->setQueryStringValue($GLOBALS["licence_account"]->BusinessNo->QueryStringValue);
					$this->BusinessNo->setSessionValue($this->BusinessNo->QueryStringValue);
					if (!is_numeric($GLOBALS["licence_account"]->BusinessNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_BillPeriod", Get("BillPeriod"))) !== NULL) {
					$GLOBALS["licence_account"]->BillPeriod->setQueryStringValue($parm);
					$this->BillPeriod->setQueryStringValue($GLOBALS["licence_account"]->BillPeriod->QueryStringValue);
					$this->BillPeriod->setSessionValue($this->BillPeriod->QueryStringValue);
					if (!is_numeric($GLOBALS["licence_account"]->BillPeriod->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_PeriodType", Get("PeriodType"))) !== NULL) {
					$GLOBALS["licence_account"]->PeriodType->setQueryStringValue($parm);
					$this->PeriodType->setQueryStringValue($GLOBALS["licence_account"]->PeriodType->QueryStringValue);
					$this->PeriodType->setSessionValue($this->PeriodType->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_BillYear", Get("BillYear"))) !== NULL) {
					$GLOBALS["licence_account"]->BillYear->setQueryStringValue($parm);
					$this->BillYear->setQueryStringValue($GLOBALS["licence_account"]->BillYear->QueryStringValue);
					$this->BillYear->setSessionValue($this->BillYear->QueryStringValue);
					if (!is_numeric($GLOBALS["licence_account"]->BillYear->QueryStringValue))
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
			if ($masterTblVar == "licence_account") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LicenceNo", Post("LicenceNo"))) !== NULL) {
					$GLOBALS["licence_account"]->LicenceNo->setFormValue($parm);
					$this->LicenceNo->setFormValue($GLOBALS["licence_account"]->LicenceNo->FormValue);
					$this->LicenceNo->setSessionValue($this->LicenceNo->FormValue);
					if (!is_numeric($GLOBALS["licence_account"]->LicenceNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_BusinessNo", Post("BusinessNo"))) !== NULL) {
					$GLOBALS["licence_account"]->BusinessNo->setFormValue($parm);
					$this->BusinessNo->setFormValue($GLOBALS["licence_account"]->BusinessNo->FormValue);
					$this->BusinessNo->setSessionValue($this->BusinessNo->FormValue);
					if (!is_numeric($GLOBALS["licence_account"]->BusinessNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_BillPeriod", Post("BillPeriod"))) !== NULL) {
					$GLOBALS["licence_account"]->BillPeriod->setFormValue($parm);
					$this->BillPeriod->setFormValue($GLOBALS["licence_account"]->BillPeriod->FormValue);
					$this->BillPeriod->setSessionValue($this->BillPeriod->FormValue);
					if (!is_numeric($GLOBALS["licence_account"]->BillPeriod->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_PeriodType", Post("PeriodType"))) !== NULL) {
					$GLOBALS["licence_account"]->PeriodType->setFormValue($parm);
					$this->PeriodType->setFormValue($GLOBALS["licence_account"]->PeriodType->FormValue);
					$this->PeriodType->setSessionValue($this->PeriodType->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_BillYear", Post("BillYear"))) !== NULL) {
					$GLOBALS["licence_account"]->BillYear->setFormValue($parm);
					$this->BillYear->setFormValue($GLOBALS["licence_account"]->BillYear->FormValue);
					$this->BillYear->setSessionValue($this->BillYear->FormValue);
					if (!is_numeric($GLOBALS["licence_account"]->BillYear->FormValue))
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
			if ($masterTblVar != "licence_account") {
				if ($this->LicenceNo->CurrentValue == "")
					$this->LicenceNo->setSessionValue("");
				if ($this->BusinessNo->CurrentValue == "")
					$this->BusinessNo->setSessionValue("");
				if ($this->BillPeriod->CurrentValue == "")
					$this->BillPeriod->setSessionValue("");
				if ($this->PeriodType->CurrentValue == "")
					$this->PeriodType->setSessionValue("");
				if ($this->BillYear->CurrentValue == "")
					$this->BillYear->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("health_certificatelist.php"), "", $this->TableVar, TRUE);
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