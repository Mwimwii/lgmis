<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class performance_measure_add extends performance_measure
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'performance_measure';

	// Page object name
	public $PageObjName = "performance_measure_add";

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

		// Table object (performance_measure)
		if (!isset($GLOBALS["performance_measure"]) || get_class($GLOBALS["performance_measure"]) == PROJECT_NAMESPACE . "performance_measure") {
			$GLOBALS["performance_measure"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["performance_measure"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'performance_measure');

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
		global $performance_measure;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($performance_measure);
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
					if ($pageName == "performance_measureview.php")
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
					$this->terminate(GetUrl("performance_measurelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->PefromanceRef->setVisibility();
		$this->IndicatorCode->setVisibility();
		$this->Category->setVisibility();
		$this->TargetDesc->setVisibility();
		$this->Target->setVisibility();
		$this->ValueDesc->setVisibility();
		$this->Value->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Deviation->setVisibility();
		$this->Recommendation->setVisibility();
		$this->Remedies->setVisibility();
		$this->PMonth->setVisibility();
		$this->PYear->setVisibility();
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
		$this->setupLookupOptions($this->Category);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PMonth);
		$this->setupLookupOptions($this->PYear);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("performance_measurelist.php");
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
			$this->CopyRecord = FALSE;
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
					$this->terminate("performance_measurelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "performance_measurelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "performance_measureview.php")
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
		$this->PefromanceRef->CurrentValue = NULL;
		$this->PefromanceRef->OldValue = $this->PefromanceRef->CurrentValue;
		$this->IndicatorCode->CurrentValue = NULL;
		$this->IndicatorCode->OldValue = $this->IndicatorCode->CurrentValue;
		$this->Category->CurrentValue = NULL;
		$this->Category->OldValue = $this->Category->CurrentValue;
		$this->TargetDesc->CurrentValue = NULL;
		$this->TargetDesc->OldValue = $this->TargetDesc->CurrentValue;
		$this->Target->CurrentValue = NULL;
		$this->Target->OldValue = $this->Target->CurrentValue;
		$this->ValueDesc->CurrentValue = NULL;
		$this->ValueDesc->OldValue = $this->ValueDesc->CurrentValue;
		$this->Value->CurrentValue = NULL;
		$this->Value->OldValue = $this->Value->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->Deviation->CurrentValue = NULL;
		$this->Deviation->OldValue = $this->Deviation->CurrentValue;
		$this->Recommendation->CurrentValue = NULL;
		$this->Recommendation->OldValue = $this->Recommendation->CurrentValue;
		$this->Remedies->CurrentValue = NULL;
		$this->Remedies->OldValue = $this->Remedies->CurrentValue;
		$this->PMonth->CurrentValue = NULL;
		$this->PMonth->OldValue = $this->PMonth->CurrentValue;
		$this->PYear->CurrentValue = NULL;
		$this->PYear->OldValue = $this->PYear->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'PefromanceRef' first before field var 'x_PefromanceRef'
		$val = $CurrentForm->hasValue("PefromanceRef") ? $CurrentForm->getValue("PefromanceRef") : $CurrentForm->getValue("x_PefromanceRef");
		if (!$this->PefromanceRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PefromanceRef->Visible = FALSE; // Disable update for API request
			else
				$this->PefromanceRef->setFormValue($val);
		}

		// Check field name 'IndicatorCode' first before field var 'x_IndicatorCode'
		$val = $CurrentForm->hasValue("IndicatorCode") ? $CurrentForm->getValue("IndicatorCode") : $CurrentForm->getValue("x_IndicatorCode");
		if (!$this->IndicatorCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IndicatorCode->Visible = FALSE; // Disable update for API request
			else
				$this->IndicatorCode->setFormValue($val);
		}

		// Check field name 'Category' first before field var 'x_Category'
		$val = $CurrentForm->hasValue("Category") ? $CurrentForm->getValue("Category") : $CurrentForm->getValue("x_Category");
		if (!$this->Category->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Category->Visible = FALSE; // Disable update for API request
			else
				$this->Category->setFormValue($val);
		}

		// Check field name 'TargetDesc' first before field var 'x_TargetDesc'
		$val = $CurrentForm->hasValue("TargetDesc") ? $CurrentForm->getValue("TargetDesc") : $CurrentForm->getValue("x_TargetDesc");
		if (!$this->TargetDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TargetDesc->Visible = FALSE; // Disable update for API request
			else
				$this->TargetDesc->setFormValue($val);
		}

		// Check field name 'Target' first before field var 'x_Target'
		$val = $CurrentForm->hasValue("Target") ? $CurrentForm->getValue("Target") : $CurrentForm->getValue("x_Target");
		if (!$this->Target->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Target->Visible = FALSE; // Disable update for API request
			else
				$this->Target->setFormValue($val);
		}

		// Check field name 'ValueDesc' first before field var 'x_ValueDesc'
		$val = $CurrentForm->hasValue("ValueDesc") ? $CurrentForm->getValue("ValueDesc") : $CurrentForm->getValue("x_ValueDesc");
		if (!$this->ValueDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ValueDesc->Visible = FALSE; // Disable update for API request
			else
				$this->ValueDesc->setFormValue($val);
		}

		// Check field name 'Value' first before field var 'x_Value'
		$val = $CurrentForm->hasValue("Value") ? $CurrentForm->getValue("Value") : $CurrentForm->getValue("x_Value");
		if (!$this->Value->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Value->Visible = FALSE; // Disable update for API request
			else
				$this->Value->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'Deviation' first before field var 'x_Deviation'
		$val = $CurrentForm->hasValue("Deviation") ? $CurrentForm->getValue("Deviation") : $CurrentForm->getValue("x_Deviation");
		if (!$this->Deviation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Deviation->Visible = FALSE; // Disable update for API request
			else
				$this->Deviation->setFormValue($val);
		}

		// Check field name 'Recommendation' first before field var 'x_Recommendation'
		$val = $CurrentForm->hasValue("Recommendation") ? $CurrentForm->getValue("Recommendation") : $CurrentForm->getValue("x_Recommendation");
		if (!$this->Recommendation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Recommendation->Visible = FALSE; // Disable update for API request
			else
				$this->Recommendation->setFormValue($val);
		}

		// Check field name 'Remedies' first before field var 'x_Remedies'
		$val = $CurrentForm->hasValue("Remedies") ? $CurrentForm->getValue("Remedies") : $CurrentForm->getValue("x_Remedies");
		if (!$this->Remedies->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Remedies->Visible = FALSE; // Disable update for API request
			else
				$this->Remedies->setFormValue($val);
		}

		// Check field name 'PMonth' first before field var 'x_PMonth'
		$val = $CurrentForm->hasValue("PMonth") ? $CurrentForm->getValue("PMonth") : $CurrentForm->getValue("x_PMonth");
		if (!$this->PMonth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PMonth->Visible = FALSE; // Disable update for API request
			else
				$this->PMonth->setFormValue($val);
		}

		// Check field name 'PYear' first before field var 'x_PYear'
		$val = $CurrentForm->hasValue("PYear") ? $CurrentForm->getValue("PYear") : $CurrentForm->getValue("x_PYear");
		if (!$this->PYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PYear->Visible = FALSE; // Disable update for API request
			else
				$this->PYear->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PefromanceRef->CurrentValue = $this->PefromanceRef->FormValue;
		$this->IndicatorCode->CurrentValue = $this->IndicatorCode->FormValue;
		$this->Category->CurrentValue = $this->Category->FormValue;
		$this->TargetDesc->CurrentValue = $this->TargetDesc->FormValue;
		$this->Target->CurrentValue = $this->Target->FormValue;
		$this->ValueDesc->CurrentValue = $this->ValueDesc->FormValue;
		$this->Value->CurrentValue = $this->Value->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->Deviation->CurrentValue = $this->Deviation->FormValue;
		$this->Recommendation->CurrentValue = $this->Recommendation->FormValue;
		$this->Remedies->CurrentValue = $this->Remedies->FormValue;
		$this->PMonth->CurrentValue = $this->PMonth->FormValue;
		$this->PYear->CurrentValue = $this->PYear->FormValue;
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
		$this->PefromanceRef->setDbValue($row['PefromanceRef']);
		$this->IndicatorCode->setDbValue($row['IndicatorCode']);
		$this->Category->setDbValue($row['Category']);
		$this->TargetDesc->setDbValue($row['TargetDesc']);
		$this->Target->setDbValue($row['Target']);
		$this->ValueDesc->setDbValue($row['ValueDesc']);
		$this->Value->setDbValue($row['Value']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Deviation->setDbValue($row['Deviation']);
		$this->Recommendation->setDbValue($row['Recommendation']);
		$this->Remedies->setDbValue($row['Remedies']);
		$this->PMonth->setDbValue($row['PMonth']);
		$this->PYear->setDbValue($row['PYear']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['PefromanceRef'] = $this->PefromanceRef->CurrentValue;
		$row['IndicatorCode'] = $this->IndicatorCode->CurrentValue;
		$row['Category'] = $this->Category->CurrentValue;
		$row['TargetDesc'] = $this->TargetDesc->CurrentValue;
		$row['Target'] = $this->Target->CurrentValue;
		$row['ValueDesc'] = $this->ValueDesc->CurrentValue;
		$row['Value'] = $this->Value->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['Deviation'] = $this->Deviation->CurrentValue;
		$row['Recommendation'] = $this->Recommendation->CurrentValue;
		$row['Remedies'] = $this->Remedies->CurrentValue;
		$row['PMonth'] = $this->PMonth->CurrentValue;
		$row['PYear'] = $this->PYear->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{
		return FALSE;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Target->FormValue == $this->Target->CurrentValue && is_numeric(ConvertToFloatString($this->Target->CurrentValue)))
			$this->Target->CurrentValue = ConvertToFloatString($this->Target->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Value->FormValue == $this->Value->CurrentValue && is_numeric(ConvertToFloatString($this->Value->CurrentValue)))
			$this->Value->CurrentValue = ConvertToFloatString($this->Value->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// PefromanceRef
		// IndicatorCode
		// Category
		// TargetDesc
		// Target
		// ValueDesc
		// Value
		// UnitOfMeasure
		// Deviation
		// Recommendation
		// Remedies
		// PMonth
		// PYear

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PefromanceRef
			$this->PefromanceRef->ViewValue = $this->PefromanceRef->CurrentValue;
			$this->PefromanceRef->ViewCustomAttributes = "";

			// IndicatorCode
			$this->IndicatorCode->ViewValue = $this->IndicatorCode->CurrentValue;
			$this->IndicatorCode->ViewCustomAttributes = "";

			// Category
			$curVal = strval($this->Category->CurrentValue);
			if ($curVal != "") {
				$this->Category->ViewValue = $this->Category->lookupCacheOption($curVal);
				if ($this->Category->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CategoryCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Category->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Category->ViewValue = $this->Category->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Category->ViewValue = $this->Category->CurrentValue;
					}
				}
			} else {
				$this->Category->ViewValue = NULL;
			}
			$this->Category->ViewCustomAttributes = "";

			// TargetDesc
			$this->TargetDesc->ViewValue = $this->TargetDesc->CurrentValue;
			$this->TargetDesc->ViewCustomAttributes = "";

			// Target
			$this->Target->ViewValue = $this->Target->CurrentValue;
			$this->Target->ViewValue = FormatNumber($this->Target->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Target->ViewCustomAttributes = "";

			// ValueDesc
			$this->ValueDesc->ViewValue = $this->ValueDesc->CurrentValue;
			$this->ValueDesc->ViewCustomAttributes = "";

			// Value
			$this->Value->ViewValue = $this->Value->CurrentValue;
			$this->Value->ViewValue = FormatNumber($this->Value->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Value->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
					}
				}
			} else {
				$this->UnitOfMeasure->ViewValue = NULL;
			}
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// Deviation
			$this->Deviation->ViewValue = $this->Deviation->CurrentValue;
			$this->Deviation->ViewCustomAttributes = "";

			// Recommendation
			$this->Recommendation->ViewValue = $this->Recommendation->CurrentValue;
			$this->Recommendation->ViewCustomAttributes = "";

			// Remedies
			$this->Remedies->ViewValue = $this->Remedies->CurrentValue;
			$this->Remedies->ViewCustomAttributes = "";

			// PMonth
			$curVal = strval($this->PMonth->CurrentValue);
			if ($curVal != "") {
				$this->PMonth->ViewValue = $this->PMonth->lookupCacheOption($curVal);
				if ($this->PMonth->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MonthCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PMonth->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PMonth->ViewValue = $this->PMonth->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PMonth->ViewValue = $this->PMonth->CurrentValue;
					}
				}
			} else {
				$this->PMonth->ViewValue = NULL;
			}
			$this->PMonth->ViewCustomAttributes = "";

			// PYear
			$curVal = strval($this->PYear->CurrentValue);
			if ($curVal != "") {
				$this->PYear->ViewValue = $this->PYear->lookupCacheOption($curVal);
				if ($this->PYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PYear->ViewValue = $this->PYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PYear->ViewValue = $this->PYear->CurrentValue;
					}
				}
			} else {
				$this->PYear->ViewValue = NULL;
			}
			$this->PYear->ViewCustomAttributes = "";

			// PefromanceRef
			$this->PefromanceRef->LinkCustomAttributes = "";
			$this->PefromanceRef->HrefValue = "";
			$this->PefromanceRef->TooltipValue = "";

			// IndicatorCode
			$this->IndicatorCode->LinkCustomAttributes = "";
			$this->IndicatorCode->HrefValue = "";
			$this->IndicatorCode->TooltipValue = "";

			// Category
			$this->Category->LinkCustomAttributes = "";
			$this->Category->HrefValue = "";
			$this->Category->TooltipValue = "";

			// TargetDesc
			$this->TargetDesc->LinkCustomAttributes = "";
			$this->TargetDesc->HrefValue = "";
			$this->TargetDesc->TooltipValue = "";

			// Target
			$this->Target->LinkCustomAttributes = "";
			$this->Target->HrefValue = "";
			$this->Target->TooltipValue = "";

			// ValueDesc
			$this->ValueDesc->LinkCustomAttributes = "";
			$this->ValueDesc->HrefValue = "";
			$this->ValueDesc->TooltipValue = "";

			// Value
			$this->Value->LinkCustomAttributes = "";
			$this->Value->HrefValue = "";
			$this->Value->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Deviation
			$this->Deviation->LinkCustomAttributes = "";
			$this->Deviation->HrefValue = "";
			$this->Deviation->TooltipValue = "";

			// Recommendation
			$this->Recommendation->LinkCustomAttributes = "";
			$this->Recommendation->HrefValue = "";
			$this->Recommendation->TooltipValue = "";

			// Remedies
			$this->Remedies->LinkCustomAttributes = "";
			$this->Remedies->HrefValue = "";
			$this->Remedies->TooltipValue = "";

			// PMonth
			$this->PMonth->LinkCustomAttributes = "";
			$this->PMonth->HrefValue = "";
			$this->PMonth->TooltipValue = "";

			// PYear
			$this->PYear->LinkCustomAttributes = "";
			$this->PYear->HrefValue = "";
			$this->PYear->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// PefromanceRef
			$this->PefromanceRef->EditAttrs["class"] = "form-control";
			$this->PefromanceRef->EditCustomAttributes = "";
			$this->PefromanceRef->EditValue = HtmlEncode($this->PefromanceRef->CurrentValue);
			$this->PefromanceRef->PlaceHolder = RemoveHtml($this->PefromanceRef->caption());

			// IndicatorCode
			$this->IndicatorCode->EditAttrs["class"] = "form-control";
			$this->IndicatorCode->EditCustomAttributes = "";
			$this->IndicatorCode->EditValue = HtmlEncode($this->IndicatorCode->CurrentValue);
			$this->IndicatorCode->PlaceHolder = RemoveHtml($this->IndicatorCode->caption());

			// Category
			$this->Category->EditAttrs["class"] = "form-control";
			$this->Category->EditCustomAttributes = "";
			$curVal = trim(strval($this->Category->CurrentValue));
			if ($curVal != "")
				$this->Category->ViewValue = $this->Category->lookupCacheOption($curVal);
			else
				$this->Category->ViewValue = $this->Category->Lookup !== NULL && is_array($this->Category->Lookup->Options) ? $curVal : NULL;
			if ($this->Category->ViewValue !== NULL) { // Load from cache
				$this->Category->EditValue = array_values($this->Category->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CategoryCode`" . SearchString("=", $this->Category->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Category->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Category->EditValue = $arwrk;
			}

			// TargetDesc
			$this->TargetDesc->EditAttrs["class"] = "form-control";
			$this->TargetDesc->EditCustomAttributes = "";
			if (!$this->TargetDesc->Raw)
				$this->TargetDesc->CurrentValue = HtmlDecode($this->TargetDesc->CurrentValue);
			$this->TargetDesc->EditValue = HtmlEncode($this->TargetDesc->CurrentValue);
			$this->TargetDesc->PlaceHolder = RemoveHtml($this->TargetDesc->caption());

			// Target
			$this->Target->EditAttrs["class"] = "form-control";
			$this->Target->EditCustomAttributes = "";
			$this->Target->EditValue = HtmlEncode($this->Target->CurrentValue);
			$this->Target->PlaceHolder = RemoveHtml($this->Target->caption());
			if (strval($this->Target->EditValue) != "" && is_numeric($this->Target->EditValue))
				$this->Target->EditValue = FormatNumber($this->Target->EditValue, -2, -1, -2, 0);
			

			// ValueDesc
			$this->ValueDesc->EditAttrs["class"] = "form-control";
			$this->ValueDesc->EditCustomAttributes = "";
			if (!$this->ValueDesc->Raw)
				$this->ValueDesc->CurrentValue = HtmlDecode($this->ValueDesc->CurrentValue);
			$this->ValueDesc->EditValue = HtmlEncode($this->ValueDesc->CurrentValue);
			$this->ValueDesc->PlaceHolder = RemoveHtml($this->ValueDesc->caption());

			// Value
			$this->Value->EditAttrs["class"] = "form-control";
			$this->Value->EditCustomAttributes = "";
			$this->Value->EditValue = HtmlEncode($this->Value->CurrentValue);
			$this->Value->PlaceHolder = RemoveHtml($this->Value->caption());
			if (strval($this->Value->EditValue) != "" && is_numeric($this->Value->EditValue))
				$this->Value->EditValue = FormatNumber($this->Value->EditValue, -2, -1, -2, 0);
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// Deviation
			$this->Deviation->EditAttrs["class"] = "form-control";
			$this->Deviation->EditCustomAttributes = "";
			if (!$this->Deviation->Raw)
				$this->Deviation->CurrentValue = HtmlDecode($this->Deviation->CurrentValue);
			$this->Deviation->EditValue = HtmlEncode($this->Deviation->CurrentValue);
			$this->Deviation->PlaceHolder = RemoveHtml($this->Deviation->caption());

			// Recommendation
			$this->Recommendation->EditAttrs["class"] = "form-control";
			$this->Recommendation->EditCustomAttributes = "";
			$this->Recommendation->EditValue = HtmlEncode($this->Recommendation->CurrentValue);
			$this->Recommendation->PlaceHolder = RemoveHtml($this->Recommendation->caption());

			// Remedies
			$this->Remedies->EditAttrs["class"] = "form-control";
			$this->Remedies->EditCustomAttributes = "";
			$this->Remedies->EditValue = HtmlEncode($this->Remedies->CurrentValue);
			$this->Remedies->PlaceHolder = RemoveHtml($this->Remedies->caption());

			// PMonth
			$this->PMonth->EditAttrs["class"] = "form-control";
			$this->PMonth->EditCustomAttributes = "";
			$curVal = trim(strval($this->PMonth->CurrentValue));
			if ($curVal != "")
				$this->PMonth->ViewValue = $this->PMonth->lookupCacheOption($curVal);
			else
				$this->PMonth->ViewValue = $this->PMonth->Lookup !== NULL && is_array($this->PMonth->Lookup->Options) ? $curVal : NULL;
			if ($this->PMonth->ViewValue !== NULL) { // Load from cache
				$this->PMonth->EditValue = array_values($this->PMonth->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MonthCode`" . SearchString("=", $this->PMonth->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PMonth->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PMonth->EditValue = $arwrk;
			}

			// PYear
			$this->PYear->EditAttrs["class"] = "form-control";
			$this->PYear->EditCustomAttributes = "";
			$curVal = trim(strval($this->PYear->CurrentValue));
			if ($curVal != "")
				$this->PYear->ViewValue = $this->PYear->lookupCacheOption($curVal);
			else
				$this->PYear->ViewValue = $this->PYear->Lookup !== NULL && is_array($this->PYear->Lookup->Options) ? $curVal : NULL;
			if ($this->PYear->ViewValue !== NULL) { // Load from cache
				$this->PYear->EditValue = array_values($this->PYear->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Year`" . SearchString("=", $this->PYear->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PYear->EditValue = $arwrk;
			}

			// Add refer script
			// PefromanceRef

			$this->PefromanceRef->LinkCustomAttributes = "";
			$this->PefromanceRef->HrefValue = "";

			// IndicatorCode
			$this->IndicatorCode->LinkCustomAttributes = "";
			$this->IndicatorCode->HrefValue = "";

			// Category
			$this->Category->LinkCustomAttributes = "";
			$this->Category->HrefValue = "";

			// TargetDesc
			$this->TargetDesc->LinkCustomAttributes = "";
			$this->TargetDesc->HrefValue = "";

			// Target
			$this->Target->LinkCustomAttributes = "";
			$this->Target->HrefValue = "";

			// ValueDesc
			$this->ValueDesc->LinkCustomAttributes = "";
			$this->ValueDesc->HrefValue = "";

			// Value
			$this->Value->LinkCustomAttributes = "";
			$this->Value->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Deviation
			$this->Deviation->LinkCustomAttributes = "";
			$this->Deviation->HrefValue = "";

			// Recommendation
			$this->Recommendation->LinkCustomAttributes = "";
			$this->Recommendation->HrefValue = "";

			// Remedies
			$this->Remedies->LinkCustomAttributes = "";
			$this->Remedies->HrefValue = "";

			// PMonth
			$this->PMonth->LinkCustomAttributes = "";
			$this->PMonth->HrefValue = "";

			// PYear
			$this->PYear->LinkCustomAttributes = "";
			$this->PYear->HrefValue = "";
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
		if ($this->PefromanceRef->Required) {
			if (!$this->PefromanceRef->IsDetailKey && $this->PefromanceRef->FormValue != NULL && $this->PefromanceRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PefromanceRef->caption(), $this->PefromanceRef->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PefromanceRef->FormValue)) {
			AddMessage($FormError, $this->PefromanceRef->errorMessage());
		}
		if ($this->IndicatorCode->Required) {
			if (!$this->IndicatorCode->IsDetailKey && $this->IndicatorCode->FormValue != NULL && $this->IndicatorCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IndicatorCode->caption(), $this->IndicatorCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->IndicatorCode->FormValue)) {
			AddMessage($FormError, $this->IndicatorCode->errorMessage());
		}
		if ($this->Category->Required) {
			if (!$this->Category->IsDetailKey && $this->Category->FormValue != NULL && $this->Category->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Category->caption(), $this->Category->RequiredErrorMessage));
			}
		}
		if ($this->TargetDesc->Required) {
			if (!$this->TargetDesc->IsDetailKey && $this->TargetDesc->FormValue != NULL && $this->TargetDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TargetDesc->caption(), $this->TargetDesc->RequiredErrorMessage));
			}
		}
		if ($this->Target->Required) {
			if (!$this->Target->IsDetailKey && $this->Target->FormValue != NULL && $this->Target->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Target->caption(), $this->Target->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Target->FormValue)) {
			AddMessage($FormError, $this->Target->errorMessage());
		}
		if ($this->ValueDesc->Required) {
			if (!$this->ValueDesc->IsDetailKey && $this->ValueDesc->FormValue != NULL && $this->ValueDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ValueDesc->caption(), $this->ValueDesc->RequiredErrorMessage));
			}
		}
		if ($this->Value->Required) {
			if (!$this->Value->IsDetailKey && $this->Value->FormValue != NULL && $this->Value->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Value->caption(), $this->Value->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Value->FormValue)) {
			AddMessage($FormError, $this->Value->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->Deviation->Required) {
			if (!$this->Deviation->IsDetailKey && $this->Deviation->FormValue != NULL && $this->Deviation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Deviation->caption(), $this->Deviation->RequiredErrorMessage));
			}
		}
		if ($this->Recommendation->Required) {
			if (!$this->Recommendation->IsDetailKey && $this->Recommendation->FormValue != NULL && $this->Recommendation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Recommendation->caption(), $this->Recommendation->RequiredErrorMessage));
			}
		}
		if ($this->Remedies->Required) {
			if (!$this->Remedies->IsDetailKey && $this->Remedies->FormValue != NULL && $this->Remedies->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Remedies->caption(), $this->Remedies->RequiredErrorMessage));
			}
		}
		if ($this->PMonth->Required) {
			if (!$this->PMonth->IsDetailKey && $this->PMonth->FormValue != NULL && $this->PMonth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PMonth->caption(), $this->PMonth->RequiredErrorMessage));
			}
		}
		if ($this->PYear->Required) {
			if (!$this->PYear->IsDetailKey && $this->PYear->FormValue != NULL && $this->PYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PYear->caption(), $this->PYear->RequiredErrorMessage));
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

		// PefromanceRef
		$this->PefromanceRef->setDbValueDef($rsnew, $this->PefromanceRef->CurrentValue, 0, strval($this->PefromanceRef->CurrentValue) == "");

		// IndicatorCode
		$this->IndicatorCode->setDbValueDef($rsnew, $this->IndicatorCode->CurrentValue, 0, FALSE);

		// Category
		$this->Category->setDbValueDef($rsnew, $this->Category->CurrentValue, 0, FALSE);

		// TargetDesc
		$this->TargetDesc->setDbValueDef($rsnew, $this->TargetDesc->CurrentValue, NULL, FALSE);

		// Target
		$this->Target->setDbValueDef($rsnew, $this->Target->CurrentValue, NULL, FALSE);

		// ValueDesc
		$this->ValueDesc->setDbValueDef($rsnew, $this->ValueDesc->CurrentValue, NULL, FALSE);

		// Value
		$this->Value->setDbValueDef($rsnew, $this->Value->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// Deviation
		$this->Deviation->setDbValueDef($rsnew, $this->Deviation->CurrentValue, NULL, FALSE);

		// Recommendation
		$this->Recommendation->setDbValueDef($rsnew, $this->Recommendation->CurrentValue, NULL, FALSE);

		// Remedies
		$this->Remedies->setDbValueDef($rsnew, $this->Remedies->CurrentValue, NULL, FALSE);

		// PMonth
		$this->PMonth->setDbValueDef($rsnew, $this->PMonth->CurrentValue, 0, FALSE);

		// PYear
		$this->PYear->setDbValueDef($rsnew, $this->PYear->CurrentValue, 0, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("performance_measurelist.php"), "", $this->TableVar, TRUE);
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
				case "x_Category":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PMonth":
					break;
				case "x_PYear":
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
						case "x_Category":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PMonth":
							break;
						case "x_PYear":
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