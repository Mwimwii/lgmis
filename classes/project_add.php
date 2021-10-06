<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class project_add extends project
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'project';

	// Page object name
	public $PageObjName = "project_add";

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

		// Table object (project)
		if (!isset($GLOBALS["project"]) || get_class($GLOBALS["project"]) == PROJECT_NAMESPACE . "project") {
			$GLOBALS["project"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["project"];
		}

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'project');

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
		global $project;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($project);
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
					if ($pageName == "projectview.php")
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
			$key .= @$ar['ProjectCode'];
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
					$this->terminate(GetUrl("projectlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->ProjectCode->setVisibility();
		$this->ProjectName->setVisibility();
		$this->ProjectType->setVisibility();
		$this->ProjectSector->setVisibility();
		$this->Contractors->setVisibility();
		$this->Projectdescription->setVisibility();
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEndDate->setVisibility();
		$this->Budget->setVisibility();
		$this->ExpenditureTodate->setVisibility();
		$this->FundsReleased->setVisibility();
		$this->FundingSource->setVisibility();
		$this->ProjectDocs->setVisibility();
		$this->ProgressStatus->setVisibility();
		$this->OutstandingTasks->setVisibility();
		$this->LastUpdated->Visible = FALSE;
		$this->CommnentsOnStatus->setVisibility();
		$this->MoreDocs->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProjectType);
		$this->setupLookupOptions($this->ProjectSector);
		$this->setupLookupOptions($this->FundingSource);
		$this->setupLookupOptions($this->ProgressStatus);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("projectlist.php");
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
			if (Get("ProjectCode") !== NULL) {
				$this->ProjectCode->setQueryStringValue(Get("ProjectCode"));
				$this->setKey("ProjectCode", $this->ProjectCode->CurrentValue); // Set up key
			} else {
				$this->setKey("ProjectCode", ""); // Clear key
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
					$this->terminate("projectlist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "projectlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "projectview.php")
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
		$this->ProjectDocs->Upload->Index = $CurrentForm->Index;
		$this->ProjectDocs->Upload->uploadFile();
		$this->MoreDocs->Upload->Index = $CurrentForm->Index;
		$this->MoreDocs->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->ProjectCode->CurrentValue = NULL;
		$this->ProjectCode->OldValue = $this->ProjectCode->CurrentValue;
		$this->ProjectName->CurrentValue = NULL;
		$this->ProjectName->OldValue = $this->ProjectName->CurrentValue;
		$this->ProjectType->CurrentValue = 1;
		$this->ProjectSector->CurrentValue = NULL;
		$this->ProjectSector->OldValue = $this->ProjectSector->CurrentValue;
		$this->Contractors->CurrentValue = NULL;
		$this->Contractors->OldValue = $this->Contractors->CurrentValue;
		$this->Projectdescription->CurrentValue = NULL;
		$this->Projectdescription->OldValue = $this->Projectdescription->CurrentValue;
		$this->PlannedStartDate->CurrentValue = NULL;
		$this->PlannedStartDate->OldValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedEndDate->CurrentValue = NULL;
		$this->PlannedEndDate->OldValue = $this->PlannedEndDate->CurrentValue;
		$this->ActualStartDate->CurrentValue = NULL;
		$this->ActualStartDate->OldValue = $this->ActualStartDate->CurrentValue;
		$this->ActualEndDate->CurrentValue = NULL;
		$this->ActualEndDate->OldValue = $this->ActualEndDate->CurrentValue;
		$this->Budget->CurrentValue = NULL;
		$this->Budget->OldValue = $this->Budget->CurrentValue;
		$this->ExpenditureTodate->CurrentValue = NULL;
		$this->ExpenditureTodate->OldValue = $this->ExpenditureTodate->CurrentValue;
		$this->FundsReleased->CurrentValue = NULL;
		$this->FundsReleased->OldValue = $this->FundsReleased->CurrentValue;
		$this->FundingSource->CurrentValue = NULL;
		$this->FundingSource->OldValue = $this->FundingSource->CurrentValue;
		$this->ProjectDocs->Upload->DbValue = NULL;
		$this->ProjectDocs->OldValue = $this->ProjectDocs->Upload->DbValue;
		$this->ProgressStatus->CurrentValue = NULL;
		$this->ProgressStatus->OldValue = $this->ProgressStatus->CurrentValue;
		$this->OutstandingTasks->CurrentValue = NULL;
		$this->OutstandingTasks->OldValue = $this->OutstandingTasks->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->CommnentsOnStatus->CurrentValue = NULL;
		$this->CommnentsOnStatus->OldValue = $this->CommnentsOnStatus->CurrentValue;
		$this->MoreDocs->Upload->DbValue = NULL;
		$this->MoreDocs->OldValue = $this->MoreDocs->Upload->DbValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'DepartmentCode' first before field var 'x_DepartmentCode'
		$val = $CurrentForm->hasValue("DepartmentCode") ? $CurrentForm->getValue("DepartmentCode") : $CurrentForm->getValue("x_DepartmentCode");
		if (!$this->DepartmentCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentCode->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentCode->setFormValue($val);
		}

		// Check field name 'SectionCode' first before field var 'x_SectionCode'
		$val = $CurrentForm->hasValue("SectionCode") ? $CurrentForm->getValue("SectionCode") : $CurrentForm->getValue("x_SectionCode");
		if (!$this->SectionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SectionCode->Visible = FALSE; // Disable update for API request
			else
				$this->SectionCode->setFormValue($val);
		}

		// Check field name 'ProjectCode' first before field var 'x_ProjectCode'
		$val = $CurrentForm->hasValue("ProjectCode") ? $CurrentForm->getValue("ProjectCode") : $CurrentForm->getValue("x_ProjectCode");
		if (!$this->ProjectCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectCode->setFormValue($val);
		}

		// Check field name 'ProjectName' first before field var 'x_ProjectName'
		$val = $CurrentForm->hasValue("ProjectName") ? $CurrentForm->getValue("ProjectName") : $CurrentForm->getValue("x_ProjectName");
		if (!$this->ProjectName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectName->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectName->setFormValue($val);
		}

		// Check field name 'ProjectType' first before field var 'x_ProjectType'
		$val = $CurrentForm->hasValue("ProjectType") ? $CurrentForm->getValue("ProjectType") : $CurrentForm->getValue("x_ProjectType");
		if (!$this->ProjectType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectType->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectType->setFormValue($val);
		}

		// Check field name 'ProjectSector' first before field var 'x_ProjectSector'
		$val = $CurrentForm->hasValue("ProjectSector") ? $CurrentForm->getValue("ProjectSector") : $CurrentForm->getValue("x_ProjectSector");
		if (!$this->ProjectSector->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectSector->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectSector->setFormValue($val);
		}

		// Check field name 'Contractors' first before field var 'x_Contractors'
		$val = $CurrentForm->hasValue("Contractors") ? $CurrentForm->getValue("Contractors") : $CurrentForm->getValue("x_Contractors");
		if (!$this->Contractors->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Contractors->Visible = FALSE; // Disable update for API request
			else
				$this->Contractors->setFormValue($val);
		}

		// Check field name 'Projectdescription' first before field var 'x_Projectdescription'
		$val = $CurrentForm->hasValue("Projectdescription") ? $CurrentForm->getValue("Projectdescription") : $CurrentForm->getValue("x_Projectdescription");
		if (!$this->Projectdescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Projectdescription->Visible = FALSE; // Disable update for API request
			else
				$this->Projectdescription->setFormValue($val);
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
			$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
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

		// Check field name 'ActualEndDate' first before field var 'x_ActualEndDate'
		$val = $CurrentForm->hasValue("ActualEndDate") ? $CurrentForm->getValue("ActualEndDate") : $CurrentForm->getValue("x_ActualEndDate");
		if (!$this->ActualEndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualEndDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualEndDate->setFormValue($val);
			$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		}

		// Check field name 'Budget' first before field var 'x_Budget'
		$val = $CurrentForm->hasValue("Budget") ? $CurrentForm->getValue("Budget") : $CurrentForm->getValue("x_Budget");
		if (!$this->Budget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Budget->Visible = FALSE; // Disable update for API request
			else
				$this->Budget->setFormValue($val);
		}

		// Check field name 'ExpenditureTodate' first before field var 'x_ExpenditureTodate'
		$val = $CurrentForm->hasValue("ExpenditureTodate") ? $CurrentForm->getValue("ExpenditureTodate") : $CurrentForm->getValue("x_ExpenditureTodate");
		if (!$this->ExpenditureTodate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExpenditureTodate->Visible = FALSE; // Disable update for API request
			else
				$this->ExpenditureTodate->setFormValue($val);
		}

		// Check field name 'FundsReleased' first before field var 'x_FundsReleased'
		$val = $CurrentForm->hasValue("FundsReleased") ? $CurrentForm->getValue("FundsReleased") : $CurrentForm->getValue("x_FundsReleased");
		if (!$this->FundsReleased->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FundsReleased->Visible = FALSE; // Disable update for API request
			else
				$this->FundsReleased->setFormValue($val);
		}

		// Check field name 'FundingSource' first before field var 'x_FundingSource'
		$val = $CurrentForm->hasValue("FundingSource") ? $CurrentForm->getValue("FundingSource") : $CurrentForm->getValue("x_FundingSource");
		if (!$this->FundingSource->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FundingSource->Visible = FALSE; // Disable update for API request
			else
				$this->FundingSource->setFormValue($val);
		}

		// Check field name 'ProgressStatus' first before field var 'x_ProgressStatus'
		$val = $CurrentForm->hasValue("ProgressStatus") ? $CurrentForm->getValue("ProgressStatus") : $CurrentForm->getValue("x_ProgressStatus");
		if (!$this->ProgressStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgressStatus->Visible = FALSE; // Disable update for API request
			else
				$this->ProgressStatus->setFormValue($val);
		}

		// Check field name 'OutstandingTasks' first before field var 'x_OutstandingTasks'
		$val = $CurrentForm->hasValue("OutstandingTasks") ? $CurrentForm->getValue("OutstandingTasks") : $CurrentForm->getValue("x_OutstandingTasks");
		if (!$this->OutstandingTasks->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutstandingTasks->Visible = FALSE; // Disable update for API request
			else
				$this->OutstandingTasks->setFormValue($val);
		}

		// Check field name 'CommnentsOnStatus' first before field var 'x_CommnentsOnStatus'
		$val = $CurrentForm->hasValue("CommnentsOnStatus") ? $CurrentForm->getValue("CommnentsOnStatus") : $CurrentForm->getValue("x_CommnentsOnStatus");
		if (!$this->CommnentsOnStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CommnentsOnStatus->Visible = FALSE; // Disable update for API request
			else
				$this->CommnentsOnStatus->setFormValue($val);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->ProjectCode->CurrentValue = $this->ProjectCode->FormValue;
		$this->ProjectName->CurrentValue = $this->ProjectName->FormValue;
		$this->ProjectType->CurrentValue = $this->ProjectType->FormValue;
		$this->ProjectSector->CurrentValue = $this->ProjectSector->FormValue;
		$this->Contractors->CurrentValue = $this->Contractors->FormValue;
		$this->Projectdescription->CurrentValue = $this->Projectdescription->FormValue;
		$this->PlannedStartDate->CurrentValue = $this->PlannedStartDate->FormValue;
		$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		$this->PlannedEndDate->CurrentValue = $this->PlannedEndDate->FormValue;
		$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
		$this->ActualStartDate->CurrentValue = $this->ActualStartDate->FormValue;
		$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		$this->ActualEndDate->CurrentValue = $this->ActualEndDate->FormValue;
		$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		$this->Budget->CurrentValue = $this->Budget->FormValue;
		$this->ExpenditureTodate->CurrentValue = $this->ExpenditureTodate->FormValue;
		$this->FundsReleased->CurrentValue = $this->FundsReleased->FormValue;
		$this->FundingSource->CurrentValue = $this->FundingSource->FormValue;
		$this->ProgressStatus->CurrentValue = $this->ProgressStatus->FormValue;
		$this->OutstandingTasks->CurrentValue = $this->OutstandingTasks->FormValue;
		$this->CommnentsOnStatus->CurrentValue = $this->CommnentsOnStatus->FormValue;
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->ProjectCode->setDbValue($row['ProjectCode']);
		$this->ProjectName->setDbValue($row['ProjectName']);
		$this->ProjectType->setDbValue($row['ProjectType']);
		$this->ProjectSector->setDbValue($row['ProjectSector']);
		$this->Contractors->setDbValue($row['Contractors']);
		$this->Projectdescription->setDbValue($row['Projectdescription']);
		$this->PlannedStartDate->setDbValue($row['PlannedStartDate']);
		$this->PlannedEndDate->setDbValue($row['PlannedEndDate']);
		$this->ActualStartDate->setDbValue($row['ActualStartDate']);
		$this->ActualEndDate->setDbValue($row['ActualEndDate']);
		$this->Budget->setDbValue($row['Budget']);
		$this->ExpenditureTodate->setDbValue($row['ExpenditureTodate']);
		$this->FundsReleased->setDbValue($row['FundsReleased']);
		$this->FundingSource->setDbValue($row['FundingSource']);
		$this->ProjectDocs->Upload->DbValue = $row['ProjectDocs'];
		if (is_array($this->ProjectDocs->Upload->DbValue) || is_object($this->ProjectDocs->Upload->DbValue)) // Byte array
			$this->ProjectDocs->Upload->DbValue = BytesToString($this->ProjectDocs->Upload->DbValue);
		$this->ProgressStatus->setDbValue($row['ProgressStatus']);
		$this->OutstandingTasks->setDbValue($row['OutstandingTasks']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->CommnentsOnStatus->setDbValue($row['CommnentsOnStatus']);
		$this->MoreDocs->Upload->DbValue = $row['MoreDocs'];
		if (is_array($this->MoreDocs->Upload->DbValue) || is_object($this->MoreDocs->Upload->DbValue)) // Byte array
			$this->MoreDocs->Upload->DbValue = BytesToString($this->MoreDocs->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ProjectCode'] = $this->ProjectCode->CurrentValue;
		$row['ProjectName'] = $this->ProjectName->CurrentValue;
		$row['ProjectType'] = $this->ProjectType->CurrentValue;
		$row['ProjectSector'] = $this->ProjectSector->CurrentValue;
		$row['Contractors'] = $this->Contractors->CurrentValue;
		$row['Projectdescription'] = $this->Projectdescription->CurrentValue;
		$row['PlannedStartDate'] = $this->PlannedStartDate->CurrentValue;
		$row['PlannedEndDate'] = $this->PlannedEndDate->CurrentValue;
		$row['ActualStartDate'] = $this->ActualStartDate->CurrentValue;
		$row['ActualEndDate'] = $this->ActualEndDate->CurrentValue;
		$row['Budget'] = $this->Budget->CurrentValue;
		$row['ExpenditureTodate'] = $this->ExpenditureTodate->CurrentValue;
		$row['FundsReleased'] = $this->FundsReleased->CurrentValue;
		$row['FundingSource'] = $this->FundingSource->CurrentValue;
		$row['ProjectDocs'] = $this->ProjectDocs->Upload->DbValue;
		$row['ProgressStatus'] = $this->ProgressStatus->CurrentValue;
		$row['OutstandingTasks'] = $this->OutstandingTasks->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['CommnentsOnStatus'] = $this->CommnentsOnStatus->CurrentValue;
		$row['MoreDocs'] = $this->MoreDocs->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ProjectCode")) != "")
			$this->ProjectCode->OldValue = $this->getKey("ProjectCode"); // ProjectCode
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

		if ($this->Budget->FormValue == $this->Budget->CurrentValue && is_numeric(ConvertToFloatString($this->Budget->CurrentValue)))
			$this->Budget->CurrentValue = ConvertToFloatString($this->Budget->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ExpenditureTodate->FormValue == $this->ExpenditureTodate->CurrentValue && is_numeric(ConvertToFloatString($this->ExpenditureTodate->CurrentValue)))
			$this->ExpenditureTodate->CurrentValue = ConvertToFloatString($this->ExpenditureTodate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->FundsReleased->FormValue == $this->FundsReleased->CurrentValue && is_numeric(ConvertToFloatString($this->FundsReleased->CurrentValue)))
			$this->FundsReleased->CurrentValue = ConvertToFloatString($this->FundsReleased->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ProjectCode
		// ProjectName
		// ProjectType
		// ProjectSector
		// Contractors
		// Projectdescription
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Budget
		// ExpenditureTodate
		// FundsReleased
		// FundingSource
		// ProjectDocs
		// ProgressStatus
		// OutstandingTasks
		// LastUpdated
		// CommnentsOnStatus
		// MoreDocs

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ProvinceCode
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
					}
				}
			} else {
				$this->ProvinceCode->ViewValue = NULL;
			}
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
			$curVal = strval($this->LACode->CurrentValue);
			if ($curVal != "") {
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->ViewValue = $this->LACode->CurrentValue;
					}
				}
			} else {
				$this->LACode->ViewValue = NULL;
			}
			$this->LACode->ViewCustomAttributes = "";

			// DepartmentCode
			$curVal = strval($this->DepartmentCode->CurrentValue);
			if ($curVal != "") {
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
					}
				}
			} else {
				$this->DepartmentCode->ViewValue = NULL;
			}
			$this->DepartmentCode->ViewCustomAttributes = "";

			// SectionCode
			$curVal = strval($this->SectionCode->CurrentValue);
			if ($curVal != "") {
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
					}
				}
			} else {
				$this->SectionCode->ViewValue = NULL;
			}
			$this->SectionCode->ViewCustomAttributes = "";

			// ProjectCode
			$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
			$this->ProjectCode->ViewCustomAttributes = "";

			// ProjectName
			$this->ProjectName->ViewValue = $this->ProjectName->CurrentValue;
			$this->ProjectName->ViewCustomAttributes = "";

			// ProjectType
			$curVal = strval($this->ProjectType->CurrentValue);
			if ($curVal != "") {
				$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
				if ($this->ProjectType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProjectType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectType->ViewValue = $this->ProjectType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectType->ViewValue = $this->ProjectType->CurrentValue;
					}
				}
			} else {
				$this->ProjectType->ViewValue = NULL;
			}
			$this->ProjectType->ViewCustomAttributes = "";

			// ProjectSector
			$curVal = strval($this->ProjectSector->CurrentValue);
			if ($curVal != "") {
				$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
				if ($this->ProjectSector->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectSector`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProjectSector->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectSector->ViewValue = $this->ProjectSector->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectSector->ViewValue = $this->ProjectSector->CurrentValue;
					}
				}
			} else {
				$this->ProjectSector->ViewValue = NULL;
			}
			$this->ProjectSector->ViewCustomAttributes = "";

			// Contractors
			$this->Contractors->ViewValue = $this->Contractors->CurrentValue;
			$this->Contractors->ViewCustomAttributes = "";

			// Projectdescription
			$this->Projectdescription->ViewValue = $this->Projectdescription->CurrentValue;
			$this->Projectdescription->ViewCustomAttributes = "";

			// PlannedStartDate
			$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
			$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
			$this->PlannedStartDate->ViewCustomAttributes = "";

			// PlannedEndDate
			$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
			$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 0);
			$this->PlannedEndDate->ViewCustomAttributes = "";

			// ActualStartDate
			$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
			$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
			$this->ActualStartDate->ViewCustomAttributes = "";

			// ActualEndDate
			$this->ActualEndDate->ViewValue = $this->ActualEndDate->CurrentValue;
			$this->ActualEndDate->ViewValue = FormatDateTime($this->ActualEndDate->ViewValue, 0);
			$this->ActualEndDate->ViewCustomAttributes = "";

			// Budget
			$this->Budget->ViewValue = $this->Budget->CurrentValue;
			$this->Budget->ViewValue = FormatNumber($this->Budget->ViewValue, 2, -2, -2, -2);
			$this->Budget->CellCssStyle .= "text-align: right;";
			$this->Budget->ViewCustomAttributes = "";

			// ExpenditureTodate
			$this->ExpenditureTodate->ViewValue = $this->ExpenditureTodate->CurrentValue;
			$this->ExpenditureTodate->ViewValue = FormatNumber($this->ExpenditureTodate->ViewValue, 2, -2, -2, -2);
			$this->ExpenditureTodate->CellCssStyle .= "text-align: right;";
			$this->ExpenditureTodate->ViewCustomAttributes = "";

			// FundsReleased
			$this->FundsReleased->ViewValue = $this->FundsReleased->CurrentValue;
			$this->FundsReleased->ViewValue = FormatNumber($this->FundsReleased->ViewValue, 2, -2, -2, -2);
			$this->FundsReleased->CellCssStyle .= "text-align: right;";
			$this->FundsReleased->ViewCustomAttributes = "";

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

			// ProjectDocs
			if (!EmptyValue($this->ProjectDocs->Upload->DbValue)) {
				$this->ProjectDocs->ViewValue = $this->ProjectCode->CurrentValue;
				$this->ProjectDocs->IsBlobImage = IsImageFile(ContentExtension($this->ProjectDocs->Upload->DbValue));
			} else {
				$this->ProjectDocs->ViewValue = "";
			}
			$this->ProjectDocs->ViewCustomAttributes = "";

			// ProgressStatus
			$curVal = strval($this->ProgressStatus->CurrentValue);
			if ($curVal != "") {
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
				if ($this->ProgressStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgressStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgressStatus->ViewValue = $this->ProgressStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgressStatus->ViewValue = $this->ProgressStatus->CurrentValue;
					}
				}
			} else {
				$this->ProgressStatus->ViewValue = NULL;
			}
			$this->ProgressStatus->ViewCustomAttributes = "";

			// OutstandingTasks
			$this->OutstandingTasks->ViewValue = $this->OutstandingTasks->CurrentValue;
			$this->OutstandingTasks->ViewCustomAttributes = "";

			// CommnentsOnStatus
			$this->CommnentsOnStatus->ViewValue = $this->CommnentsOnStatus->CurrentValue;
			$this->CommnentsOnStatus->ViewCustomAttributes = "";

			// MoreDocs
			if (!EmptyValue($this->MoreDocs->Upload->DbValue)) {
				$this->MoreDocs->ViewValue = $this->ProjectCode->CurrentValue;
				$this->MoreDocs->IsBlobImage = IsImageFile(ContentExtension($this->MoreDocs->Upload->DbValue));
			} else {
				$this->MoreDocs->ViewValue = "";
			}
			$this->MoreDocs->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";
			$this->ProjectCode->TooltipValue = "";

			// ProjectName
			$this->ProjectName->LinkCustomAttributes = "";
			$this->ProjectName->HrefValue = "";
			$this->ProjectName->TooltipValue = "";

			// ProjectType
			$this->ProjectType->LinkCustomAttributes = "";
			$this->ProjectType->HrefValue = "";
			$this->ProjectType->TooltipValue = "";

			// ProjectSector
			$this->ProjectSector->LinkCustomAttributes = "";
			$this->ProjectSector->HrefValue = "";
			$this->ProjectSector->TooltipValue = "";

			// Contractors
			$this->Contractors->LinkCustomAttributes = "";
			$this->Contractors->HrefValue = "";
			$this->Contractors->TooltipValue = "";

			// Projectdescription
			$this->Projectdescription->LinkCustomAttributes = "";
			$this->Projectdescription->HrefValue = "";
			$this->Projectdescription->TooltipValue = "";

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

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";
			$this->ActualEndDate->TooltipValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";
			$this->Budget->TooltipValue = "";

			// ExpenditureTodate
			$this->ExpenditureTodate->LinkCustomAttributes = "";
			$this->ExpenditureTodate->HrefValue = "";
			$this->ExpenditureTodate->TooltipValue = "";

			// FundsReleased
			$this->FundsReleased->LinkCustomAttributes = "";
			$this->FundsReleased->HrefValue = "";
			$this->FundsReleased->TooltipValue = "";

			// FundingSource
			$this->FundingSource->LinkCustomAttributes = "";
			$this->FundingSource->HrefValue = "";
			$this->FundingSource->TooltipValue = "";

			// ProjectDocs
			$this->ProjectDocs->LinkCustomAttributes = "";
			if (!empty($this->ProjectDocs->Upload->DbValue)) {
				$this->ProjectDocs->HrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);
				$this->ProjectDocs->LinkAttrs["target"] = "";
				if ($this->ProjectDocs->IsBlobImage && empty($this->ProjectDocs->LinkAttrs["target"]))
					$this->ProjectDocs->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->ProjectDocs->HrefValue = FullUrl($this->ProjectDocs->HrefValue, "href");
			} else {
				$this->ProjectDocs->HrefValue = "";
			}
			$this->ProjectDocs->ExportHrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);
			$this->ProjectDocs->TooltipValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";
			$this->ProgressStatus->TooltipValue = "";

			// OutstandingTasks
			$this->OutstandingTasks->LinkCustomAttributes = "";
			$this->OutstandingTasks->HrefValue = "";
			$this->OutstandingTasks->TooltipValue = "";

			// CommnentsOnStatus
			$this->CommnentsOnStatus->LinkCustomAttributes = "";
			$this->CommnentsOnStatus->HrefValue = "";
			$this->CommnentsOnStatus->TooltipValue = "";

			// MoreDocs
			$this->MoreDocs->LinkCustomAttributes = "";
			if (!empty($this->MoreDocs->Upload->DbValue)) {
				$this->MoreDocs->HrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
				$this->MoreDocs->LinkAttrs["target"] = "";
				if ($this->MoreDocs->IsBlobImage && empty($this->MoreDocs->LinkAttrs["target"]))
					$this->MoreDocs->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->MoreDocs->HrefValue = FullUrl($this->MoreDocs->HrefValue, "href");
			} else {
				$this->MoreDocs->HrefValue = "";
			}
			$this->MoreDocs->ExportHrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
			$this->MoreDocs->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$curVal = strval($this->ProvinceCode->CurrentValue);
				if ($curVal != "") {
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
					if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
						}
					}
				} else {
					$this->ProvinceCode->ViewValue = NULL;
				}
				$this->ProvinceCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ProvinceCode->CurrentValue));
				if ($curVal != "")
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				else
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
					$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProvinceCode->EditValue = $arwrk;
				}
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->ViewValue = $this->LACode->CurrentValue;
						}
					}
				} else {
					$this->LACode->ViewValue = NULL;
				}
				$this->LACode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->CurrentValue));
			if ($curVal != "")
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DepartmentCode->EditValue = $arwrk;
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// ProjectCode
			$this->ProjectCode->EditAttrs["class"] = "form-control";
			$this->ProjectCode->EditCustomAttributes = "";
			if (!$this->ProjectCode->Raw)
				$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

			// ProjectName
			$this->ProjectName->EditAttrs["class"] = "form-control";
			$this->ProjectName->EditCustomAttributes = "";
			if (!$this->ProjectName->Raw)
				$this->ProjectName->CurrentValue = HtmlDecode($this->ProjectName->CurrentValue);
			$this->ProjectName->EditValue = HtmlEncode($this->ProjectName->CurrentValue);
			$this->ProjectName->PlaceHolder = RemoveHtml($this->ProjectName->caption());

			// ProjectType
			$this->ProjectType->EditAttrs["class"] = "form-control";
			$this->ProjectType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectType->CurrentValue));
			if ($curVal != "")
				$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
			else
				$this->ProjectType->ViewValue = $this->ProjectType->Lookup !== NULL && is_array($this->ProjectType->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectType->ViewValue !== NULL) { // Load from cache
				$this->ProjectType->EditValue = array_values($this->ProjectType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectType`" . SearchString("=", $this->ProjectType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectType->EditValue = $arwrk;
			}

			// ProjectSector
			$this->ProjectSector->EditAttrs["class"] = "form-control";
			$this->ProjectSector->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectSector->CurrentValue));
			if ($curVal != "")
				$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
			else
				$this->ProjectSector->ViewValue = $this->ProjectSector->Lookup !== NULL && is_array($this->ProjectSector->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectSector->ViewValue !== NULL) { // Load from cache
				$this->ProjectSector->EditValue = array_values($this->ProjectSector->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectSector`" . SearchString("=", $this->ProjectSector->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectSector->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectSector->EditValue = $arwrk;
			}

			// Contractors
			$this->Contractors->EditAttrs["class"] = "form-control";
			$this->Contractors->EditCustomAttributes = "";
			$this->Contractors->EditValue = HtmlEncode($this->Contractors->CurrentValue);
			$this->Contractors->PlaceHolder = RemoveHtml($this->Contractors->caption());

			// Projectdescription
			$this->Projectdescription->EditAttrs["class"] = "form-control";
			$this->Projectdescription->EditCustomAttributes = "";
			$this->Projectdescription->EditValue = HtmlEncode($this->Projectdescription->CurrentValue);
			$this->Projectdescription->PlaceHolder = RemoveHtml($this->Projectdescription->caption());

			// PlannedStartDate
			$this->PlannedStartDate->EditAttrs["class"] = "form-control";
			$this->PlannedStartDate->EditCustomAttributes = "";
			$this->PlannedStartDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedStartDate->CurrentValue, 8));
			$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

			// PlannedEndDate
			$this->PlannedEndDate->EditAttrs["class"] = "form-control";
			$this->PlannedEndDate->EditCustomAttributes = "";
			$this->PlannedEndDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedEndDate->CurrentValue, 8));
			$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

			// ActualStartDate
			$this->ActualStartDate->EditAttrs["class"] = "form-control";
			$this->ActualStartDate->EditCustomAttributes = "";
			$this->ActualStartDate->EditValue = HtmlEncode(FormatDateTime($this->ActualStartDate->CurrentValue, 8));
			$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

			// ActualEndDate
			$this->ActualEndDate->EditAttrs["class"] = "form-control";
			$this->ActualEndDate->EditCustomAttributes = "";
			$this->ActualEndDate->EditValue = HtmlEncode(FormatDateTime($this->ActualEndDate->CurrentValue, 8));
			$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

			// Budget
			$this->Budget->EditAttrs["class"] = "form-control";
			$this->Budget->EditCustomAttributes = "";
			$this->Budget->EditValue = HtmlEncode($this->Budget->CurrentValue);
			$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());
			if (strval($this->Budget->EditValue) != "" && is_numeric($this->Budget->EditValue))
				$this->Budget->EditValue = FormatNumber($this->Budget->EditValue, -2, -2, -2, -2);
			

			// ExpenditureTodate
			$this->ExpenditureTodate->EditAttrs["class"] = "form-control";
			$this->ExpenditureTodate->EditCustomAttributes = "";
			$this->ExpenditureTodate->EditValue = HtmlEncode($this->ExpenditureTodate->CurrentValue);
			$this->ExpenditureTodate->PlaceHolder = RemoveHtml($this->ExpenditureTodate->caption());
			if (strval($this->ExpenditureTodate->EditValue) != "" && is_numeric($this->ExpenditureTodate->EditValue))
				$this->ExpenditureTodate->EditValue = FormatNumber($this->ExpenditureTodate->EditValue, -2, -2, -2, -2);
			

			// FundsReleased
			$this->FundsReleased->EditAttrs["class"] = "form-control";
			$this->FundsReleased->EditCustomAttributes = "";
			$this->FundsReleased->EditValue = HtmlEncode($this->FundsReleased->CurrentValue);
			$this->FundsReleased->PlaceHolder = RemoveHtml($this->FundsReleased->caption());
			if (strval($this->FundsReleased->EditValue) != "" && is_numeric($this->FundsReleased->EditValue))
				$this->FundsReleased->EditValue = FormatNumber($this->FundsReleased->EditValue, -2, -2, -2, -2);
			

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

			// ProjectDocs
			$this->ProjectDocs->EditAttrs["class"] = "form-control";
			$this->ProjectDocs->EditCustomAttributes = "";
			if (!EmptyValue($this->ProjectDocs->Upload->DbValue)) {
				$this->ProjectDocs->EditValue = $this->ProjectCode->CurrentValue;
				$this->ProjectDocs->IsBlobImage = IsImageFile(ContentExtension($this->ProjectDocs->Upload->DbValue));
			} else {
				$this->ProjectDocs->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->ProjectDocs);

			// ProgressStatus
			$this->ProgressStatus->EditAttrs["class"] = "form-control";
			$this->ProgressStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProgressStatus->CurrentValue));
			if ($curVal != "")
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
			else
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->Lookup !== NULL && is_array($this->ProgressStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->ProgressStatus->ViewValue !== NULL) { // Load from cache
				$this->ProgressStatus->EditValue = array_values($this->ProgressStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectStatusCode`" . SearchString("=", $this->ProgressStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgressStatus->EditValue = $arwrk;
			}

			// OutstandingTasks
			$this->OutstandingTasks->EditAttrs["class"] = "form-control";
			$this->OutstandingTasks->EditCustomAttributes = "";
			$this->OutstandingTasks->EditValue = HtmlEncode($this->OutstandingTasks->CurrentValue);
			$this->OutstandingTasks->PlaceHolder = RemoveHtml($this->OutstandingTasks->caption());

			// CommnentsOnStatus
			$this->CommnentsOnStatus->EditAttrs["class"] = "form-control";
			$this->CommnentsOnStatus->EditCustomAttributes = "";
			$this->CommnentsOnStatus->EditValue = HtmlEncode($this->CommnentsOnStatus->CurrentValue);
			$this->CommnentsOnStatus->PlaceHolder = RemoveHtml($this->CommnentsOnStatus->caption());

			// MoreDocs
			$this->MoreDocs->EditAttrs["class"] = "form-control";
			$this->MoreDocs->EditCustomAttributes = "";
			if (!EmptyValue($this->MoreDocs->Upload->DbValue)) {
				$this->MoreDocs->EditValue = $this->ProjectCode->CurrentValue;
				$this->MoreDocs->IsBlobImage = IsImageFile(ContentExtension($this->MoreDocs->Upload->DbValue));
			} else {
				$this->MoreDocs->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->MoreDocs);

			// Add refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// ProjectName
			$this->ProjectName->LinkCustomAttributes = "";
			$this->ProjectName->HrefValue = "";

			// ProjectType
			$this->ProjectType->LinkCustomAttributes = "";
			$this->ProjectType->HrefValue = "";

			// ProjectSector
			$this->ProjectSector->LinkCustomAttributes = "";
			$this->ProjectSector->HrefValue = "";

			// Contractors
			$this->Contractors->LinkCustomAttributes = "";
			$this->Contractors->HrefValue = "";

			// Projectdescription
			$this->Projectdescription->LinkCustomAttributes = "";
			$this->Projectdescription->HrefValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";

			// ExpenditureTodate
			$this->ExpenditureTodate->LinkCustomAttributes = "";
			$this->ExpenditureTodate->HrefValue = "";

			// FundsReleased
			$this->FundsReleased->LinkCustomAttributes = "";
			$this->FundsReleased->HrefValue = "";

			// FundingSource
			$this->FundingSource->LinkCustomAttributes = "";
			$this->FundingSource->HrefValue = "";

			// ProjectDocs
			$this->ProjectDocs->LinkCustomAttributes = "";
			if (!empty($this->ProjectDocs->Upload->DbValue)) {
				$this->ProjectDocs->HrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);
				$this->ProjectDocs->LinkAttrs["target"] = "";
				if ($this->ProjectDocs->IsBlobImage && empty($this->ProjectDocs->LinkAttrs["target"]))
					$this->ProjectDocs->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->ProjectDocs->HrefValue = FullUrl($this->ProjectDocs->HrefValue, "href");
			} else {
				$this->ProjectDocs->HrefValue = "";
			}
			$this->ProjectDocs->ExportHrefValue = GetFileUploadUrl($this->ProjectDocs, $this->ProjectCode->CurrentValue);

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";

			// OutstandingTasks
			$this->OutstandingTasks->LinkCustomAttributes = "";
			$this->OutstandingTasks->HrefValue = "";

			// CommnentsOnStatus
			$this->CommnentsOnStatus->LinkCustomAttributes = "";
			$this->CommnentsOnStatus->HrefValue = "";

			// MoreDocs
			$this->MoreDocs->LinkCustomAttributes = "";
			if (!empty($this->MoreDocs->Upload->DbValue)) {
				$this->MoreDocs->HrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
				$this->MoreDocs->LinkAttrs["target"] = "";
				if ($this->MoreDocs->IsBlobImage && empty($this->MoreDocs->LinkAttrs["target"]))
					$this->MoreDocs->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->MoreDocs->HrefValue = FullUrl($this->MoreDocs->HrefValue, "href");
			} else {
				$this->MoreDocs->HrefValue = "";
			}
			$this->MoreDocs->ExportHrefValue = GetFileUploadUrl($this->MoreDocs, $this->ProjectCode->CurrentValue);
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
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if ($this->ProjectCode->Required) {
			if (!$this->ProjectCode->IsDetailKey && $this->ProjectCode->FormValue != NULL && $this->ProjectCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectCode->caption(), $this->ProjectCode->RequiredErrorMessage));
			}
		}
		if ($this->ProjectName->Required) {
			if (!$this->ProjectName->IsDetailKey && $this->ProjectName->FormValue != NULL && $this->ProjectName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectName->caption(), $this->ProjectName->RequiredErrorMessage));
			}
		}
		if ($this->ProjectType->Required) {
			if (!$this->ProjectType->IsDetailKey && $this->ProjectType->FormValue != NULL && $this->ProjectType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectType->caption(), $this->ProjectType->RequiredErrorMessage));
			}
		}
		if ($this->ProjectSector->Required) {
			if (!$this->ProjectSector->IsDetailKey && $this->ProjectSector->FormValue != NULL && $this->ProjectSector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectSector->caption(), $this->ProjectSector->RequiredErrorMessage));
			}
		}
		if ($this->Contractors->Required) {
			if (!$this->Contractors->IsDetailKey && $this->Contractors->FormValue != NULL && $this->Contractors->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Contractors->caption(), $this->Contractors->RequiredErrorMessage));
			}
		}
		if ($this->Projectdescription->Required) {
			if (!$this->Projectdescription->IsDetailKey && $this->Projectdescription->FormValue != NULL && $this->Projectdescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Projectdescription->caption(), $this->Projectdescription->RequiredErrorMessage));
			}
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
		if ($this->ActualEndDate->Required) {
			if (!$this->ActualEndDate->IsDetailKey && $this->ActualEndDate->FormValue != NULL && $this->ActualEndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualEndDate->caption(), $this->ActualEndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualEndDate->FormValue)) {
			AddMessage($FormError, $this->ActualEndDate->errorMessage());
		}
		if ($this->Budget->Required) {
			if (!$this->Budget->IsDetailKey && $this->Budget->FormValue != NULL && $this->Budget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Budget->caption(), $this->Budget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Budget->FormValue)) {
			AddMessage($FormError, $this->Budget->errorMessage());
		}
		if ($this->ExpenditureTodate->Required) {
			if (!$this->ExpenditureTodate->IsDetailKey && $this->ExpenditureTodate->FormValue != NULL && $this->ExpenditureTodate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExpenditureTodate->caption(), $this->ExpenditureTodate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ExpenditureTodate->FormValue)) {
			AddMessage($FormError, $this->ExpenditureTodate->errorMessage());
		}
		if ($this->FundsReleased->Required) {
			if (!$this->FundsReleased->IsDetailKey && $this->FundsReleased->FormValue != NULL && $this->FundsReleased->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FundsReleased->caption(), $this->FundsReleased->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->FundsReleased->FormValue)) {
			AddMessage($FormError, $this->FundsReleased->errorMessage());
		}
		if ($this->FundingSource->Required) {
			if (!$this->FundingSource->IsDetailKey && $this->FundingSource->FormValue != NULL && $this->FundingSource->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FundingSource->caption(), $this->FundingSource->RequiredErrorMessage));
			}
		}
		if ($this->ProjectDocs->Required) {
			if ($this->ProjectDocs->Upload->FileName == "" && !$this->ProjectDocs->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->ProjectDocs->caption(), $this->ProjectDocs->RequiredErrorMessage));
			}
		}
		if ($this->ProgressStatus->Required) {
			if (!$this->ProgressStatus->IsDetailKey && $this->ProgressStatus->FormValue != NULL && $this->ProgressStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgressStatus->caption(), $this->ProgressStatus->RequiredErrorMessage));
			}
		}
		if ($this->OutstandingTasks->Required) {
			if (!$this->OutstandingTasks->IsDetailKey && $this->OutstandingTasks->FormValue != NULL && $this->OutstandingTasks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutstandingTasks->caption(), $this->OutstandingTasks->RequiredErrorMessage));
			}
		}
		if ($this->CommnentsOnStatus->Required) {
			if (!$this->CommnentsOnStatus->IsDetailKey && $this->CommnentsOnStatus->FormValue != NULL && $this->CommnentsOnStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CommnentsOnStatus->caption(), $this->CommnentsOnStatus->RequiredErrorMessage));
			}
		}
		if ($this->MoreDocs->Required) {
			if ($this->MoreDocs->Upload->FileName == "" && !$this->MoreDocs->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->MoreDocs->caption(), $this->MoreDocs->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("activity", $detailTblVar) && $GLOBALS["activity"]->DetailAdd) {
			if (!isset($GLOBALS["activity_grid"]))
				$GLOBALS["activity_grid"] = new activity_grid(); // Get detail page object
			$GLOBALS["activity_grid"]->validateGridForm();
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

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// ProjectCode
		$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, "", FALSE);

		// ProjectName
		$this->ProjectName->setDbValueDef($rsnew, $this->ProjectName->CurrentValue, "", FALSE);

		// ProjectType
		$this->ProjectType->setDbValueDef($rsnew, $this->ProjectType->CurrentValue, 0, strval($this->ProjectType->CurrentValue) == "");

		// ProjectSector
		$this->ProjectSector->setDbValueDef($rsnew, $this->ProjectSector->CurrentValue, 0, FALSE);

		// Contractors
		$this->Contractors->setDbValueDef($rsnew, $this->Contractors->CurrentValue, NULL, FALSE);

		// Projectdescription
		$this->Projectdescription->setDbValueDef($rsnew, $this->Projectdescription->CurrentValue, NULL, FALSE);

		// PlannedStartDate
		$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), FALSE);

		// PlannedEndDate
		$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), FALSE);

		// ActualStartDate
		$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, FALSE);

		// ActualEndDate
		$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, FALSE);

		// Budget
		$this->Budget->setDbValueDef($rsnew, $this->Budget->CurrentValue, 0, FALSE);

		// ExpenditureTodate
		$this->ExpenditureTodate->setDbValueDef($rsnew, $this->ExpenditureTodate->CurrentValue, NULL, FALSE);

		// FundsReleased
		$this->FundsReleased->setDbValueDef($rsnew, $this->FundsReleased->CurrentValue, NULL, FALSE);

		// FundingSource
		$this->FundingSource->setDbValueDef($rsnew, $this->FundingSource->CurrentValue, NULL, FALSE);

		// ProjectDocs
		if ($this->ProjectDocs->Visible && !$this->ProjectDocs->Upload->KeepFile) {
			if ($this->ProjectDocs->Upload->Value == NULL) {
				$rsnew['ProjectDocs'] = NULL;
			} else {
				$rsnew['ProjectDocs'] = $this->ProjectDocs->Upload->Value;
			}
		}

		// ProgressStatus
		$this->ProgressStatus->setDbValueDef($rsnew, $this->ProgressStatus->CurrentValue, NULL, FALSE);

		// OutstandingTasks
		$this->OutstandingTasks->setDbValueDef($rsnew, $this->OutstandingTasks->CurrentValue, NULL, FALSE);

		// CommnentsOnStatus
		$this->CommnentsOnStatus->setDbValueDef($rsnew, $this->CommnentsOnStatus->CurrentValue, NULL, FALSE);

		// MoreDocs
		if ($this->MoreDocs->Visible && !$this->MoreDocs->Upload->KeepFile) {
			if ($this->MoreDocs->Upload->Value == NULL) {
				$rsnew['MoreDocs'] = NULL;
			} else {
				$rsnew['MoreDocs'] = $this->MoreDocs->Upload->Value;
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ProjectCode']) == "") {
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("activity", $detailTblVar) && $GLOBALS["activity"]->DetailAdd) {
				$GLOBALS["activity"]->ProvinceCode->setSessionValue($this->ProvinceCode->CurrentValue); // Set master key
				$GLOBALS["activity"]->LACode->setSessionValue($this->LACode->CurrentValue); // Set master key
				$GLOBALS["activity"]->DepartmentCode->setSessionValue($this->DepartmentCode->CurrentValue); // Set master key
				$GLOBALS["activity"]->SectionCode->setSessionValue($this->SectionCode->CurrentValue); // Set master key
				$GLOBALS["activity"]->ProjectCode->setSessionValue($this->ProjectCode->CurrentValue); // Set master key
				if (!isset($GLOBALS["activity_grid"]))
					$GLOBALS["activity_grid"] = new activity_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "activity"); // Load user level of detail table
				$addRow = $GLOBALS["activity_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["activity"]->ProvinceCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["activity"]->LACode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["activity"]->DepartmentCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["activity"]->SectionCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["activity"]->ProjectCode->setSessionValue(""); // Clear master key if insert failed
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

			// ProjectDocs
			CleanUploadTempPath($this->ProjectDocs, $this->ProjectDocs->Upload->Index);

			// MoreDocs
			CleanUploadTempPath($this->MoreDocs, $this->MoreDocs->Upload->Index);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["local_authority"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
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
			if ($masterTblVar != "local_authority") {
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
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
			if (in_array("activity", $detailTblVar)) {
				if (!isset($GLOBALS["activity_grid"]))
					$GLOBALS["activity_grid"] = new activity_grid();
				if ($GLOBALS["activity_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["activity_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["activity_grid"]->CurrentMode = "add";
					$GLOBALS["activity_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["activity_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["activity_grid"]->setStartRecordNumber(1);
					$GLOBALS["activity_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["activity_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["activity_grid"]->ProvinceCode->setSessionValue($GLOBALS["activity_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["activity_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["activity_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["activity_grid"]->LACode->setSessionValue($GLOBALS["activity_grid"]->LACode->CurrentValue);
					$GLOBALS["activity_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["activity_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["activity_grid"]->DepartmentCode->setSessionValue($GLOBALS["activity_grid"]->DepartmentCode->CurrentValue);
					$GLOBALS["activity_grid"]->SectionCode->IsDetailKey = TRUE;
					$GLOBALS["activity_grid"]->SectionCode->CurrentValue = $this->SectionCode->CurrentValue;
					$GLOBALS["activity_grid"]->SectionCode->setSessionValue($GLOBALS["activity_grid"]->SectionCode->CurrentValue);
					$GLOBALS["activity_grid"]->ProjectCode->IsDetailKey = TRUE;
					$GLOBALS["activity_grid"]->ProjectCode->CurrentValue = $this->ProjectCode->CurrentValue;
					$GLOBALS["activity_grid"]->ProjectCode->setSessionValue($GLOBALS["activity_grid"]->ProjectCode->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("projectlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProjectType":
					break;
				case "x_ProjectSector":
					break;
				case "x_FundingSource":
					break;
				case "x_ProgressStatus":
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
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProjectType":
							break;
						case "x_ProjectSector":
							break;
						case "x_FundingSource":
							break;
						case "x_ProgressStatus":
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