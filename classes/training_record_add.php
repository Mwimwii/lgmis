<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class training_record_add extends training_record
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'training_record';

	// Page object name
	public $PageObjName = "training_record_add";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (training_record)
		if (!isset($GLOBALS["training_record"]) || get_class($GLOBALS["training_record"]) == PROJECT_NAMESPACE . "training_record") {
			$GLOBALS["training_record"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["training_record"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'training_record');

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
		global $training_record;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($training_record);
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
					if ($pageName == "training_recordview.php")
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
			$key .= @$ar['EmployeeID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['TrainingIndex'];
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
					$this->terminate(GetUrl("training_recordlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->TrainingIndex->setVisibility();
		$this->FieldOfTraining->setVisibility();
		$this->TrainingType->setVisibility();
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEnddate->setVisibility();
		$this->QualificationLevelObtained->setVisibility();
		$this->AwardingInstitution->setVisibility();
		$this->Certificate->setVisibility();
		$this->FundingSource->setVisibility();
		$this->TrainingCost->setVisibility();
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
		$this->setupLookupOptions($this->FieldOfTraining);
		$this->setupLookupOptions($this->QualificationLevelObtained);
		$this->setupLookupOptions($this->FundingSource);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("training_recordlist.php");
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
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->setKey("EmployeeID", $this->EmployeeID->CurrentValue); // Set up key
			} else {
				$this->setKey("EmployeeID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("TrainingIndex") !== NULL) {
				$this->TrainingIndex->setQueryStringValue(Get("TrainingIndex"));
				$this->setKey("TrainingIndex", $this->TrainingIndex->CurrentValue); // Set up key
			} else {
				$this->setKey("TrainingIndex", ""); // Clear key
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
					$this->terminate("training_recordlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "training_recordlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "training_recordview.php")
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
		$this->Certificate->Upload->Index = $CurrentForm->Index;
		$this->Certificate->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->TrainingIndex->CurrentValue = NULL;
		$this->TrainingIndex->OldValue = $this->TrainingIndex->CurrentValue;
		$this->FieldOfTraining->CurrentValue = NULL;
		$this->FieldOfTraining->OldValue = $this->FieldOfTraining->CurrentValue;
		$this->TrainingType->CurrentValue = NULL;
		$this->TrainingType->OldValue = $this->TrainingType->CurrentValue;
		$this->PlannedStartDate->CurrentValue = NULL;
		$this->PlannedStartDate->OldValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedEndDate->CurrentValue = NULL;
		$this->PlannedEndDate->OldValue = $this->PlannedEndDate->CurrentValue;
		$this->ActualStartDate->CurrentValue = NULL;
		$this->ActualStartDate->OldValue = $this->ActualStartDate->CurrentValue;
		$this->ActualEnddate->CurrentValue = NULL;
		$this->ActualEnddate->OldValue = $this->ActualEnddate->CurrentValue;
		$this->QualificationLevelObtained->CurrentValue = NULL;
		$this->QualificationLevelObtained->OldValue = $this->QualificationLevelObtained->CurrentValue;
		$this->AwardingInstitution->CurrentValue = NULL;
		$this->AwardingInstitution->OldValue = $this->AwardingInstitution->CurrentValue;
		$this->Certificate->Upload->DbValue = NULL;
		$this->Certificate->OldValue = $this->Certificate->Upload->DbValue;
		$this->FundingSource->CurrentValue = NULL;
		$this->FundingSource->OldValue = $this->FundingSource->CurrentValue;
		$this->TrainingCost->CurrentValue = NULL;
		$this->TrainingCost->OldValue = $this->TrainingCost->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}

		// Check field name 'TrainingIndex' first before field var 'x_TrainingIndex'
		$val = $CurrentForm->hasValue("TrainingIndex") ? $CurrentForm->getValue("TrainingIndex") : $CurrentForm->getValue("x_TrainingIndex");
		if (!$this->TrainingIndex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TrainingIndex->Visible = FALSE; // Disable update for API request
			else
				$this->TrainingIndex->setFormValue($val);
		}

		// Check field name 'FieldOfTraining' first before field var 'x_FieldOfTraining'
		$val = $CurrentForm->hasValue("FieldOfTraining") ? $CurrentForm->getValue("FieldOfTraining") : $CurrentForm->getValue("x_FieldOfTraining");
		if (!$this->FieldOfTraining->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FieldOfTraining->Visible = FALSE; // Disable update for API request
			else
				$this->FieldOfTraining->setFormValue($val);
		}

		// Check field name 'TrainingType' first before field var 'x_TrainingType'
		$val = $CurrentForm->hasValue("TrainingType") ? $CurrentForm->getValue("TrainingType") : $CurrentForm->getValue("x_TrainingType");
		if (!$this->TrainingType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TrainingType->Visible = FALSE; // Disable update for API request
			else
				$this->TrainingType->setFormValue($val);
		}

		// Check field name 'PlannedStartDate' first before field var 'x_PlannedStartDate'
		$val = $CurrentForm->hasValue("PlannedStartDate") ? $CurrentForm->getValue("PlannedStartDate") : $CurrentForm->getValue("x_PlannedStartDate");
		if (!$this->PlannedStartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PlannedStartDate->Visible = FALSE; // Disable update for API request
			else
				$this->PlannedStartDate->setFormValue($val);
			$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		}

		// Check field name 'PlannedEndDate' first before field var 'x_PlannedEndDate'
		$val = $CurrentForm->hasValue("PlannedEndDate") ? $CurrentForm->getValue("PlannedEndDate") : $CurrentForm->getValue("x_PlannedEndDate");
		if (!$this->PlannedEndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PlannedEndDate->Visible = FALSE; // Disable update for API request
			else
				$this->PlannedEndDate->setFormValue($val);
			$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 2);
		}

		// Check field name 'ActualStartDate' first before field var 'x_ActualStartDate'
		$val = $CurrentForm->hasValue("ActualStartDate") ? $CurrentForm->getValue("ActualStartDate") : $CurrentForm->getValue("x_ActualStartDate");
		if (!$this->ActualStartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualStartDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualStartDate->setFormValue($val);
			$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		}

		// Check field name 'ActualEnddate' first before field var 'x_ActualEnddate'
		$val = $CurrentForm->hasValue("ActualEnddate") ? $CurrentForm->getValue("ActualEnddate") : $CurrentForm->getValue("x_ActualEnddate");
		if (!$this->ActualEnddate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualEnddate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualEnddate->setFormValue($val);
			$this->ActualEnddate->CurrentValue = UnFormatDateTime($this->ActualEnddate->CurrentValue, 0);
		}

		// Check field name 'QualificationLevelObtained' first before field var 'x_QualificationLevelObtained'
		$val = $CurrentForm->hasValue("QualificationLevelObtained") ? $CurrentForm->getValue("QualificationLevelObtained") : $CurrentForm->getValue("x_QualificationLevelObtained");
		if (!$this->QualificationLevelObtained->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->QualificationLevelObtained->Visible = FALSE; // Disable update for API request
			else
				$this->QualificationLevelObtained->setFormValue($val);
		}

		// Check field name 'AwardingInstitution' first before field var 'x_AwardingInstitution'
		$val = $CurrentForm->hasValue("AwardingInstitution") ? $CurrentForm->getValue("AwardingInstitution") : $CurrentForm->getValue("x_AwardingInstitution");
		if (!$this->AwardingInstitution->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AwardingInstitution->Visible = FALSE; // Disable update for API request
			else
				$this->AwardingInstitution->setFormValue($val);
		}

		// Check field name 'FundingSource' first before field var 'x_FundingSource'
		$val = $CurrentForm->hasValue("FundingSource") ? $CurrentForm->getValue("FundingSource") : $CurrentForm->getValue("x_FundingSource");
		if (!$this->FundingSource->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FundingSource->Visible = FALSE; // Disable update for API request
			else
				$this->FundingSource->setFormValue($val);
		}

		// Check field name 'TrainingCost' first before field var 'x_TrainingCost'
		$val = $CurrentForm->hasValue("TrainingCost") ? $CurrentForm->getValue("TrainingCost") : $CurrentForm->getValue("x_TrainingCost");
		if (!$this->TrainingCost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TrainingCost->Visible = FALSE; // Disable update for API request
			else
				$this->TrainingCost->setFormValue($val);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->TrainingIndex->CurrentValue = $this->TrainingIndex->FormValue;
		$this->FieldOfTraining->CurrentValue = $this->FieldOfTraining->FormValue;
		$this->TrainingType->CurrentValue = $this->TrainingType->FormValue;
		$this->PlannedStartDate->CurrentValue = $this->PlannedStartDate->FormValue;
		$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		$this->PlannedEndDate->CurrentValue = $this->PlannedEndDate->FormValue;
		$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 2);
		$this->ActualStartDate->CurrentValue = $this->ActualStartDate->FormValue;
		$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		$this->ActualEnddate->CurrentValue = $this->ActualEnddate->FormValue;
		$this->ActualEnddate->CurrentValue = UnFormatDateTime($this->ActualEnddate->CurrentValue, 0);
		$this->QualificationLevelObtained->CurrentValue = $this->QualificationLevelObtained->FormValue;
		$this->AwardingInstitution->CurrentValue = $this->AwardingInstitution->FormValue;
		$this->FundingSource->CurrentValue = $this->FundingSource->FormValue;
		$this->TrainingCost->CurrentValue = $this->TrainingCost->FormValue;
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
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->TrainingIndex->setDbValue($row['TrainingIndex']);
		$this->FieldOfTraining->setDbValue($row['FieldOfTraining']);
		$this->TrainingType->setDbValue($row['TrainingType']);
		$this->PlannedStartDate->setDbValue($row['PlannedStartDate']);
		$this->PlannedEndDate->setDbValue($row['PlannedEndDate']);
		$this->ActualStartDate->setDbValue($row['ActualStartDate']);
		$this->ActualEnddate->setDbValue($row['ActualEnddate']);
		$this->QualificationLevelObtained->setDbValue($row['QualificationLevelObtained']);
		$this->AwardingInstitution->setDbValue($row['AwardingInstitution']);
		$this->Certificate->Upload->DbValue = $row['Certificate'];
		if (is_array($this->Certificate->Upload->DbValue) || is_object($this->Certificate->Upload->DbValue)) // Byte array
			$this->Certificate->Upload->DbValue = BytesToString($this->Certificate->Upload->DbValue);
		$this->FundingSource->setDbValue($row['FundingSource']);
		$this->TrainingCost->setDbValue($row['TrainingCost']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['TrainingIndex'] = $this->TrainingIndex->CurrentValue;
		$row['FieldOfTraining'] = $this->FieldOfTraining->CurrentValue;
		$row['TrainingType'] = $this->TrainingType->CurrentValue;
		$row['PlannedStartDate'] = $this->PlannedStartDate->CurrentValue;
		$row['PlannedEndDate'] = $this->PlannedEndDate->CurrentValue;
		$row['ActualStartDate'] = $this->ActualStartDate->CurrentValue;
		$row['ActualEnddate'] = $this->ActualEnddate->CurrentValue;
		$row['QualificationLevelObtained'] = $this->QualificationLevelObtained->CurrentValue;
		$row['AwardingInstitution'] = $this->AwardingInstitution->CurrentValue;
		$row['Certificate'] = $this->Certificate->Upload->DbValue;
		$row['FundingSource'] = $this->FundingSource->CurrentValue;
		$row['TrainingCost'] = $this->TrainingCost->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("EmployeeID")) != "")
			$this->EmployeeID->OldValue = $this->getKey("EmployeeID"); // EmployeeID
		else
			$validKey = FALSE;
		if (strval($this->getKey("TrainingIndex")) != "")
			$this->TrainingIndex->OldValue = $this->getKey("TrainingIndex"); // TrainingIndex
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

		if ($this->TrainingCost->FormValue == $this->TrainingCost->CurrentValue && is_numeric(ConvertToFloatString($this->TrainingCost->CurrentValue)))
			$this->TrainingCost->CurrentValue = ConvertToFloatString($this->TrainingCost->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// TrainingIndex
		// FieldOfTraining
		// TrainingType
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEnddate
		// QualificationLevelObtained
		// AwardingInstitution
		// Certificate
		// FundingSource
		// TrainingCost

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// TrainingIndex
			$this->TrainingIndex->ViewValue = $this->TrainingIndex->CurrentValue;
			$this->TrainingIndex->ViewCustomAttributes = "";

			// FieldOfTraining
			$curVal = strval($this->FieldOfTraining->CurrentValue);
			if ($curVal != "") {
				$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->lookupCacheOption($curVal);
				if ($this->FieldOfTraining->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`QualificationCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FieldOfTraining->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->CurrentValue;
					}
				}
			} else {
				$this->FieldOfTraining->ViewValue = NULL;
			}
			$this->FieldOfTraining->ViewCustomAttributes = "";

			// TrainingType
			$this->TrainingType->ViewValue = $this->TrainingType->CurrentValue;
			$this->TrainingType->ViewCustomAttributes = "";

			// PlannedStartDate
			$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
			$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
			$this->PlannedStartDate->ViewCustomAttributes = "";

			// PlannedEndDate
			$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
			$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 2);
			$this->PlannedEndDate->ViewCustomAttributes = "";

			// ActualStartDate
			$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
			$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
			$this->ActualStartDate->ViewCustomAttributes = "";

			// ActualEnddate
			$this->ActualEnddate->ViewValue = $this->ActualEnddate->CurrentValue;
			$this->ActualEnddate->ViewValue = FormatDateTime($this->ActualEnddate->ViewValue, 0);
			$this->ActualEnddate->ViewCustomAttributes = "";

			// QualificationLevelObtained
			$curVal = strval($this->QualificationLevelObtained->CurrentValue);
			if ($curVal != "") {
				$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->lookupCacheOption($curVal);
				if ($this->QualificationLevelObtained->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->QualificationLevelObtained->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->CurrentValue;
					}
				}
			} else {
				$this->QualificationLevelObtained->ViewValue = NULL;
			}
			$this->QualificationLevelObtained->ViewCustomAttributes = "";

			// AwardingInstitution
			$this->AwardingInstitution->ViewValue = $this->AwardingInstitution->CurrentValue;
			$this->AwardingInstitution->ViewCustomAttributes = "";

			// Certificate
			if (!EmptyValue($this->Certificate->Upload->DbValue)) {
				$this->Certificate->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue;
				$this->Certificate->IsBlobImage = IsImageFile(ContentExtension($this->Certificate->Upload->DbValue));
			} else {
				$this->Certificate->ViewValue = "";
			}
			$this->Certificate->ViewCustomAttributes = "";

			// FundingSource
			$curVal = strval($this->FundingSource->CurrentValue);
			if ($curVal != "") {
				$this->FundingSource->ViewValue = $this->FundingSource->lookupCacheOption($curVal);
				if ($this->FundingSource->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`FundingSource`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->FundingSource->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FundingSource->ViewValue = $this->FundingSource->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FundingSource->ViewValue = $this->FundingSource->CurrentValue;
					}
				}
			} else {
				$this->FundingSource->ViewValue = NULL;
			}
			$this->FundingSource->ViewCustomAttributes = "";

			// TrainingCost
			$this->TrainingCost->ViewValue = $this->TrainingCost->CurrentValue;
			$this->TrainingCost->ViewValue = FormatCurrency($this->TrainingCost->ViewValue, 2, -2, -2, -2);
			$this->TrainingCost->CellCssStyle .= "text-align: right;";
			$this->TrainingCost->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// TrainingIndex
			$this->TrainingIndex->LinkCustomAttributes = "";
			$this->TrainingIndex->HrefValue = "";
			$this->TrainingIndex->TooltipValue = "";

			// FieldOfTraining
			$this->FieldOfTraining->LinkCustomAttributes = "";
			$this->FieldOfTraining->HrefValue = "";
			$this->FieldOfTraining->TooltipValue = "";

			// TrainingType
			$this->TrainingType->LinkCustomAttributes = "";
			$this->TrainingType->HrefValue = "";
			$this->TrainingType->TooltipValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";
			$this->PlannedStartDate->TooltipValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";
			$this->PlannedEndDate->TooltipValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";
			$this->ActualStartDate->TooltipValue = "";

			// ActualEnddate
			$this->ActualEnddate->LinkCustomAttributes = "";
			$this->ActualEnddate->HrefValue = "";
			$this->ActualEnddate->TooltipValue = "";

			// QualificationLevelObtained
			$this->QualificationLevelObtained->LinkCustomAttributes = "";
			$this->QualificationLevelObtained->HrefValue = "";
			$this->QualificationLevelObtained->TooltipValue = "";

			// AwardingInstitution
			$this->AwardingInstitution->LinkCustomAttributes = "";
			$this->AwardingInstitution->HrefValue = "";
			$this->AwardingInstitution->TooltipValue = "";

			// Certificate
			$this->Certificate->LinkCustomAttributes = "";
			if (!empty($this->Certificate->Upload->DbValue)) {
				$this->Certificate->HrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);
				$this->Certificate->LinkAttrs["target"] = "";
				if ($this->Certificate->IsBlobImage && empty($this->Certificate->LinkAttrs["target"]))
					$this->Certificate->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Certificate->HrefValue = FullUrl($this->Certificate->HrefValue, "href");
			} else {
				$this->Certificate->HrefValue = "";
			}
			$this->Certificate->ExportHrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);
			if (!$this->isExport()) {
				$this->Certificate->TooltipValue = $this->FieldOfTraining->ViewValue != "" ? $this->FieldOfTraining->ViewValue : $this->FieldOfTraining->CurrentValue;
				$this->Certificate->TooltipWidth = 30;
				if ($this->Certificate->HrefValue == "")
					$this->Certificate->HrefValue = "javascript:void(0);";
				$this->Certificate->LinkAttrs->appendClass("ew-tooltip-link");
				$this->Certificate->LinkAttrs["data-tooltip-id"] = "tt_training_record_x_Certificate";
				$this->Certificate->LinkAttrs["data-tooltip-width"] = $this->Certificate->TooltipWidth;
				$this->Certificate->LinkAttrs["data-placement"] = Config("CSS_FLIP") ? "left" : "right";
			}

			// FundingSource
			$this->FundingSource->LinkCustomAttributes = "";
			$this->FundingSource->HrefValue = "";
			$this->FundingSource->TooltipValue = "";

			// TrainingCost
			$this->TrainingCost->LinkCustomAttributes = "";
			$this->TrainingCost->HrefValue = "";
			$this->TrainingCost->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// TrainingIndex
			$this->TrainingIndex->EditAttrs["class"] = "form-control";
			$this->TrainingIndex->EditCustomAttributes = "";
			$this->TrainingIndex->EditValue = HtmlEncode($this->TrainingIndex->CurrentValue);
			$this->TrainingIndex->PlaceHolder = RemoveHtml($this->TrainingIndex->caption());

			// FieldOfTraining
			$this->FieldOfTraining->EditCustomAttributes = "";
			$curVal = trim(strval($this->FieldOfTraining->CurrentValue));
			if ($curVal != "")
				$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->lookupCacheOption($curVal);
			else
				$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->Lookup !== NULL && is_array($this->FieldOfTraining->Lookup->Options) ? $curVal : NULL;
			if ($this->FieldOfTraining->ViewValue !== NULL) { // Load from cache
				$this->FieldOfTraining->EditValue = array_values($this->FieldOfTraining->Lookup->Options);
				if ($this->FieldOfTraining->ViewValue == "")
					$this->FieldOfTraining->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`QualificationCode`" . SearchString("=", $this->FieldOfTraining->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->FieldOfTraining->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->displayValue($arwrk);
				} else {
					$this->FieldOfTraining->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FieldOfTraining->EditValue = $arwrk;
			}

			// TrainingType
			$this->TrainingType->EditAttrs["class"] = "form-control";
			$this->TrainingType->EditCustomAttributes = "";
			$this->TrainingType->EditValue = HtmlEncode($this->TrainingType->CurrentValue);
			$this->TrainingType->PlaceHolder = RemoveHtml($this->TrainingType->caption());

			// PlannedStartDate
			$this->PlannedStartDate->EditAttrs["class"] = "form-control";
			$this->PlannedStartDate->EditCustomAttributes = "";
			$this->PlannedStartDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedStartDate->CurrentValue, 8));
			$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

			// PlannedEndDate
			$this->PlannedEndDate->EditAttrs["class"] = "form-control";
			$this->PlannedEndDate->EditCustomAttributes = "";
			$this->PlannedEndDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedEndDate->CurrentValue, 2));
			$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

			// ActualStartDate
			$this->ActualStartDate->EditAttrs["class"] = "form-control";
			$this->ActualStartDate->EditCustomAttributes = "";
			$this->ActualStartDate->EditValue = HtmlEncode(FormatDateTime($this->ActualStartDate->CurrentValue, 8));
			$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

			// ActualEnddate
			$this->ActualEnddate->EditAttrs["class"] = "form-control";
			$this->ActualEnddate->EditCustomAttributes = "";
			$this->ActualEnddate->EditValue = HtmlEncode(FormatDateTime($this->ActualEnddate->CurrentValue, 8));
			$this->ActualEnddate->PlaceHolder = RemoveHtml($this->ActualEnddate->caption());

			// QualificationLevelObtained
			$this->QualificationLevelObtained->EditCustomAttributes = "";
			$curVal = trim(strval($this->QualificationLevelObtained->CurrentValue));
			if ($curVal != "")
				$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->lookupCacheOption($curVal);
			else
				$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->Lookup !== NULL && is_array($this->QualificationLevelObtained->Lookup->Options) ? $curVal : NULL;
			if ($this->QualificationLevelObtained->ViewValue !== NULL) { // Load from cache
				$this->QualificationLevelObtained->EditValue = array_values($this->QualificationLevelObtained->Lookup->Options);
				if ($this->QualificationLevelObtained->ViewValue == "")
					$this->QualificationLevelObtained->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->QualificationLevelObtained->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->QualificationLevelObtained->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->QualificationLevelObtained->ViewValue = $this->QualificationLevelObtained->displayValue($arwrk);
				} else {
					$this->QualificationLevelObtained->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->QualificationLevelObtained->EditValue = $arwrk;
			}

			// AwardingInstitution
			$this->AwardingInstitution->EditAttrs["class"] = "form-control";
			$this->AwardingInstitution->EditCustomAttributes = "";
			if (!$this->AwardingInstitution->Raw)
				$this->AwardingInstitution->CurrentValue = HtmlDecode($this->AwardingInstitution->CurrentValue);
			$this->AwardingInstitution->EditValue = HtmlEncode($this->AwardingInstitution->CurrentValue);
			$this->AwardingInstitution->PlaceHolder = RemoveHtml($this->AwardingInstitution->caption());

			// Certificate
			$this->Certificate->EditAttrs["class"] = "form-control";
			$this->Certificate->EditCustomAttributes = "";
			if (!EmptyValue($this->Certificate->Upload->DbValue)) {
				$this->Certificate->EditValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue;
				$this->Certificate->IsBlobImage = IsImageFile(ContentExtension($this->Certificate->Upload->DbValue));
			} else {
				$this->Certificate->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->Certificate);

			// FundingSource
			$this->FundingSource->EditAttrs["class"] = "form-control";
			$this->FundingSource->EditCustomAttributes = "";
			$curVal = trim(strval($this->FundingSource->CurrentValue));
			if ($curVal != "")
				$this->FundingSource->ViewValue = $this->FundingSource->lookupCacheOption($curVal);
			else
				$this->FundingSource->ViewValue = $this->FundingSource->Lookup !== NULL && is_array($this->FundingSource->Lookup->Options) ? $curVal : NULL;
			if ($this->FundingSource->ViewValue !== NULL) { // Load from cache
				$this->FundingSource->EditValue = array_values($this->FundingSource->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`FundingSource`" . SearchString("=", $this->FundingSource->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->FundingSource->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FundingSource->EditValue = $arwrk;
			}

			// TrainingCost
			$this->TrainingCost->EditAttrs["class"] = "form-control";
			$this->TrainingCost->EditCustomAttributes = "";
			$this->TrainingCost->EditValue = HtmlEncode($this->TrainingCost->CurrentValue);
			$this->TrainingCost->PlaceHolder = RemoveHtml($this->TrainingCost->caption());
			if (strval($this->TrainingCost->EditValue) != "" && is_numeric($this->TrainingCost->EditValue))
				$this->TrainingCost->EditValue = FormatNumber($this->TrainingCost->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// TrainingIndex
			$this->TrainingIndex->LinkCustomAttributes = "";
			$this->TrainingIndex->HrefValue = "";

			// FieldOfTraining
			$this->FieldOfTraining->LinkCustomAttributes = "";
			$this->FieldOfTraining->HrefValue = "";

			// TrainingType
			$this->TrainingType->LinkCustomAttributes = "";
			$this->TrainingType->HrefValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";

			// ActualEnddate
			$this->ActualEnddate->LinkCustomAttributes = "";
			$this->ActualEnddate->HrefValue = "";

			// QualificationLevelObtained
			$this->QualificationLevelObtained->LinkCustomAttributes = "";
			$this->QualificationLevelObtained->HrefValue = "";

			// AwardingInstitution
			$this->AwardingInstitution->LinkCustomAttributes = "";
			$this->AwardingInstitution->HrefValue = "";

			// Certificate
			$this->Certificate->LinkCustomAttributes = "";
			if (!empty($this->Certificate->Upload->DbValue)) {
				$this->Certificate->HrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);
				$this->Certificate->LinkAttrs["target"] = "";
				if ($this->Certificate->IsBlobImage && empty($this->Certificate->LinkAttrs["target"]))
					$this->Certificate->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Certificate->HrefValue = FullUrl($this->Certificate->HrefValue, "href");
			} else {
				$this->Certificate->HrefValue = "";
			}
			$this->Certificate->ExportHrefValue = GetFileUploadUrl($this->Certificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->TrainingIndex->CurrentValue);

			// FundingSource
			$this->FundingSource->LinkCustomAttributes = "";
			$this->FundingSource->HrefValue = "";

			// TrainingCost
			$this->TrainingCost->LinkCustomAttributes = "";
			$this->TrainingCost->HrefValue = "";
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
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->TrainingIndex->Required) {
			if (!$this->TrainingIndex->IsDetailKey && $this->TrainingIndex->FormValue != NULL && $this->TrainingIndex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TrainingIndex->caption(), $this->TrainingIndex->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TrainingIndex->FormValue)) {
			AddMessage($FormError, $this->TrainingIndex->errorMessage());
		}
		if ($this->FieldOfTraining->Required) {
			if (!$this->FieldOfTraining->IsDetailKey && $this->FieldOfTraining->FormValue != NULL && $this->FieldOfTraining->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FieldOfTraining->caption(), $this->FieldOfTraining->RequiredErrorMessage));
			}
		}
		if ($this->TrainingType->Required) {
			if (!$this->TrainingType->IsDetailKey && $this->TrainingType->FormValue != NULL && $this->TrainingType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TrainingType->caption(), $this->TrainingType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TrainingType->FormValue)) {
			AddMessage($FormError, $this->TrainingType->errorMessage());
		}
		if ($this->PlannedStartDate->Required) {
			if (!$this->PlannedStartDate->IsDetailKey && $this->PlannedStartDate->FormValue != NULL && $this->PlannedStartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PlannedStartDate->caption(), $this->PlannedStartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PlannedStartDate->FormValue)) {
			AddMessage($FormError, $this->PlannedStartDate->errorMessage());
		}
		if ($this->PlannedEndDate->Required) {
			if (!$this->PlannedEndDate->IsDetailKey && $this->PlannedEndDate->FormValue != NULL && $this->PlannedEndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PlannedEndDate->caption(), $this->PlannedEndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PlannedEndDate->FormValue)) {
			AddMessage($FormError, $this->PlannedEndDate->errorMessage());
		}
		if ($this->ActualStartDate->Required) {
			if (!$this->ActualStartDate->IsDetailKey && $this->ActualStartDate->FormValue != NULL && $this->ActualStartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualStartDate->caption(), $this->ActualStartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualStartDate->FormValue)) {
			AddMessage($FormError, $this->ActualStartDate->errorMessage());
		}
		if ($this->ActualEnddate->Required) {
			if (!$this->ActualEnddate->IsDetailKey && $this->ActualEnddate->FormValue != NULL && $this->ActualEnddate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualEnddate->caption(), $this->ActualEnddate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualEnddate->FormValue)) {
			AddMessage($FormError, $this->ActualEnddate->errorMessage());
		}
		if ($this->QualificationLevelObtained->Required) {
			if (!$this->QualificationLevelObtained->IsDetailKey && $this->QualificationLevelObtained->FormValue != NULL && $this->QualificationLevelObtained->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->QualificationLevelObtained->caption(), $this->QualificationLevelObtained->RequiredErrorMessage));
			}
		}
		if ($this->AwardingInstitution->Required) {
			if (!$this->AwardingInstitution->IsDetailKey && $this->AwardingInstitution->FormValue != NULL && $this->AwardingInstitution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AwardingInstitution->caption(), $this->AwardingInstitution->RequiredErrorMessage));
			}
		}
		if ($this->Certificate->Required) {
			if ($this->Certificate->Upload->FileName == "" && !$this->Certificate->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Certificate->caption(), $this->Certificate->RequiredErrorMessage));
			}
		}
		if ($this->FundingSource->Required) {
			if (!$this->FundingSource->IsDetailKey && $this->FundingSource->FormValue != NULL && $this->FundingSource->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FundingSource->caption(), $this->FundingSource->RequiredErrorMessage));
			}
		}
		if ($this->TrainingCost->Required) {
			if (!$this->TrainingCost->IsDetailKey && $this->TrainingCost->FormValue != NULL && $this->TrainingCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TrainingCost->caption(), $this->TrainingCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->TrainingCost->FormValue)) {
			AddMessage($FormError, $this->TrainingCost->errorMessage());
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

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// TrainingIndex
		$this->TrainingIndex->setDbValueDef($rsnew, $this->TrainingIndex->CurrentValue, 0, FALSE);

		// FieldOfTraining
		$this->FieldOfTraining->setDbValueDef($rsnew, $this->FieldOfTraining->CurrentValue, 0, FALSE);

		// TrainingType
		$this->TrainingType->setDbValueDef($rsnew, $this->TrainingType->CurrentValue, 0, FALSE);

		// PlannedStartDate
		$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), FALSE);

		// PlannedEndDate
		$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 2), CurrentDate(), FALSE);

		// ActualStartDate
		$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, FALSE);

		// ActualEnddate
		$this->ActualEnddate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEnddate->CurrentValue, 0), NULL, FALSE);

		// QualificationLevelObtained
		$this->QualificationLevelObtained->setDbValueDef($rsnew, $this->QualificationLevelObtained->CurrentValue, NULL, FALSE);

		// AwardingInstitution
		$this->AwardingInstitution->setDbValueDef($rsnew, $this->AwardingInstitution->CurrentValue, NULL, FALSE);

		// Certificate
		if ($this->Certificate->Visible && !$this->Certificate->Upload->KeepFile) {
			if ($this->Certificate->Upload->Value == NULL) {
				$rsnew['Certificate'] = NULL;
			} else {
				$rsnew['Certificate'] = $this->Certificate->Upload->Value;
			}
		}

		// FundingSource
		$this->FundingSource->setDbValueDef($rsnew, $this->FundingSource->CurrentValue, NULL, FALSE);

		// TrainingCost
		$this->TrainingCost->setDbValueDef($rsnew, $this->TrainingCost->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['EmployeeID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['TrainingIndex']) == "") {
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

			// Certificate
			CleanUploadTempPath($this->Certificate, $this->Certificate->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("training_recordlist.php"), "", $this->TableVar, TRUE);
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
				case "x_FieldOfTraining":
					break;
				case "x_QualificationLevelObtained":
					break;
				case "x_FundingSource":
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
						case "x_FieldOfTraining":
							break;
						case "x_QualificationLevelObtained":
							break;
						case "x_FundingSource":
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