<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class budget_edit extends budget
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'budget';

	// Page object name
	public $PageObjName = "budget_edit";

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

		// Table object (budget)
		if (!isset($GLOBALS["budget"]) || get_class($GLOBALS["budget"]) == PROJECT_NAMESPACE . "budget") {
			$GLOBALS["budget"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["budget"];
		}

		// Table object (detailed_action)
		if (!isset($GLOBALS['detailed_action']))
			$GLOBALS['detailed_action'] = new detailed_action();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'budget');

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
		global $budget;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($budget);
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
					if ($pageName == "budgetview.php")
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
			$key .= @$ar['BudgetLine'];
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
			$this->BudgetLine->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("budgetlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OutcomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ActionCode->setVisibility();
		$this->DetailedActionCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->AccountCode->setVisibility();
		$this->ItemCode->Visible = FALSE;
		$this->MeansOfImplementation->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Quantity->setVisibility();
		$this->PeriodType->setVisibility();
		$this->PeriodLength->setVisibility();
		$this->Frequency->setVisibility();
		$this->UnitCost->setVisibility();
		$this->BudgetEstimate->setVisibility();
		$this->ActualAmount->setVisibility();
		$this->Status->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->BudgetLine->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->ApprovedBudget->setVisibility();
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
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ActionCode);
		$this->setupLookupOptions($this->DetailedActionCode);
		$this->setupLookupOptions($this->FinancialYear);
		$this->setupLookupOptions($this->AccountCode);
		$this->setupLookupOptions($this->MeansOfImplementation);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->Status);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("budgetlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("BudgetLine") !== NULL) {
				$this->BudgetLine->setQueryStringValue(Get("BudgetLine"));
				$this->BudgetLine->setOldValue($this->BudgetLine->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->BudgetLine->setQueryStringValue(Key(0));
				$this->BudgetLine->setOldValue($this->BudgetLine->QueryStringValue);
			} elseif (Post("BudgetLine") !== NULL) {
				$this->BudgetLine->setFormValue(Post("BudgetLine"));
				$this->BudgetLine->setOldValue($this->BudgetLine->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->BudgetLine->setQueryStringValue(Route(2));
				$this->BudgetLine->setOldValue($this->BudgetLine->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_BudgetLine")) {
					$this->BudgetLine->setFormValue($CurrentForm->getValue("x_BudgetLine"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("BudgetLine") !== NULL) {
					$this->BudgetLine->setQueryStringValue(Get("BudgetLine"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->BudgetLine->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->BudgetLine->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("budgetlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->BudgetLine->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->BudgetLine->CurrentValue, $rs->fields('BudgetLine'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("budgetlist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "budgetlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'OutcomeCode' first before field var 'x_OutcomeCode'
		$val = $CurrentForm->hasValue("OutcomeCode") ? $CurrentForm->getValue("OutcomeCode") : $CurrentForm->getValue("x_OutcomeCode");
		if (!$this->OutcomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeCode->setFormValue($val);
		}

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
		if (!$this->OutputCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutputCode->setFormValue($val);
		}

		// Check field name 'ActionCode' first before field var 'x_ActionCode'
		$val = $CurrentForm->hasValue("ActionCode") ? $CurrentForm->getValue("ActionCode") : $CurrentForm->getValue("x_ActionCode");
		if (!$this->ActionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionCode->Visible = FALSE; // Disable update for API request
			else
				$this->ActionCode->setFormValue($val);
		}

		// Check field name 'DetailedActionCode' first before field var 'x_DetailedActionCode'
		$val = $CurrentForm->hasValue("DetailedActionCode") ? $CurrentForm->getValue("DetailedActionCode") : $CurrentForm->getValue("x_DetailedActionCode");
		if (!$this->DetailedActionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DetailedActionCode->Visible = FALSE; // Disable update for API request
			else
				$this->DetailedActionCode->setFormValue($val);
		}

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}

		// Check field name 'AccountCode' first before field var 'x_AccountCode'
		$val = $CurrentForm->hasValue("AccountCode") ? $CurrentForm->getValue("AccountCode") : $CurrentForm->getValue("x_AccountCode");
		if (!$this->AccountCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountCode->Visible = FALSE; // Disable update for API request
			else
				$this->AccountCode->setFormValue($val);
		}

		// Check field name 'MeansOfImplementation' first before field var 'x_MeansOfImplementation'
		$val = $CurrentForm->hasValue("MeansOfImplementation") ? $CurrentForm->getValue("MeansOfImplementation") : $CurrentForm->getValue("x_MeansOfImplementation");
		if (!$this->MeansOfImplementation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MeansOfImplementation->Visible = FALSE; // Disable update for API request
			else
				$this->MeansOfImplementation->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'Quantity' first before field var 'x_Quantity'
		$val = $CurrentForm->hasValue("Quantity") ? $CurrentForm->getValue("Quantity") : $CurrentForm->getValue("x_Quantity");
		if (!$this->Quantity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Quantity->Visible = FALSE; // Disable update for API request
			else
				$this->Quantity->setFormValue($val);
		}

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}

		// Check field name 'PeriodLength' first before field var 'x_PeriodLength'
		$val = $CurrentForm->hasValue("PeriodLength") ? $CurrentForm->getValue("PeriodLength") : $CurrentForm->getValue("x_PeriodLength");
		if (!$this->PeriodLength->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodLength->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodLength->setFormValue($val);
		}

		// Check field name 'Frequency' first before field var 'x_Frequency'
		$val = $CurrentForm->hasValue("Frequency") ? $CurrentForm->getValue("Frequency") : $CurrentForm->getValue("x_Frequency");
		if (!$this->Frequency->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Frequency->Visible = FALSE; // Disable update for API request
			else
				$this->Frequency->setFormValue($val);
		}

		// Check field name 'UnitCost' first before field var 'x_UnitCost'
		$val = $CurrentForm->hasValue("UnitCost") ? $CurrentForm->getValue("UnitCost") : $CurrentForm->getValue("x_UnitCost");
		if (!$this->UnitCost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitCost->Visible = FALSE; // Disable update for API request
			else
				$this->UnitCost->setFormValue($val);
		}

		// Check field name 'BudgetEstimate' first before field var 'x_BudgetEstimate'
		$val = $CurrentForm->hasValue("BudgetEstimate") ? $CurrentForm->getValue("BudgetEstimate") : $CurrentForm->getValue("x_BudgetEstimate");
		if (!$this->BudgetEstimate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BudgetEstimate->Visible = FALSE; // Disable update for API request
			else
				$this->BudgetEstimate->setFormValue($val);
		}

		// Check field name 'ActualAmount' first before field var 'x_ActualAmount'
		$val = $CurrentForm->hasValue("ActualAmount") ? $CurrentForm->getValue("ActualAmount") : $CurrentForm->getValue("x_ActualAmount");
		if (!$this->ActualAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualAmount->Visible = FALSE; // Disable update for API request
			else
				$this->ActualAmount->setFormValue($val);
		}

		// Check field name 'Status' first before field var 'x_Status'
		$val = $CurrentForm->hasValue("Status") ? $CurrentForm->getValue("Status") : $CurrentForm->getValue("x_Status");
		if (!$this->Status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Status->Visible = FALSE; // Disable update for API request
			else
				$this->Status->setFormValue($val);
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

		// Check field name 'BudgetLine' first before field var 'x_BudgetLine'
		$val = $CurrentForm->hasValue("BudgetLine") ? $CurrentForm->getValue("BudgetLine") : $CurrentForm->getValue("x_BudgetLine");
		if (!$this->BudgetLine->IsDetailKey)
			$this->BudgetLine->setFormValue($val);

		// Check field name 'ProgramCode' first before field var 'x_ProgramCode'
		$val = $CurrentForm->hasValue("ProgramCode") ? $CurrentForm->getValue("ProgramCode") : $CurrentForm->getValue("x_ProgramCode");
		if (!$this->ProgramCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgramCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProgramCode->setFormValue($val);
		}

		// Check field name 'SubProgramCode' first before field var 'x_SubProgramCode'
		$val = $CurrentForm->hasValue("SubProgramCode") ? $CurrentForm->getValue("SubProgramCode") : $CurrentForm->getValue("x_SubProgramCode");
		if (!$this->SubProgramCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SubProgramCode->Visible = FALSE; // Disable update for API request
			else
				$this->SubProgramCode->setFormValue($val);
		}

		// Check field name 'ApprovedBudget' first before field var 'x_ApprovedBudget'
		$val = $CurrentForm->hasValue("ApprovedBudget") ? $CurrentForm->getValue("ApprovedBudget") : $CurrentForm->getValue("x_ApprovedBudget");
		if (!$this->ApprovedBudget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ApprovedBudget->Visible = FALSE; // Disable update for API request
			else
				$this->ApprovedBudget->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->ActionCode->CurrentValue = $this->ActionCode->FormValue;
		$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->AccountCode->CurrentValue = $this->AccountCode->FormValue;
		$this->MeansOfImplementation->CurrentValue = $this->MeansOfImplementation->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->Quantity->CurrentValue = $this->Quantity->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->PeriodLength->CurrentValue = $this->PeriodLength->FormValue;
		$this->Frequency->CurrentValue = $this->Frequency->FormValue;
		$this->UnitCost->CurrentValue = $this->UnitCost->FormValue;
		$this->BudgetEstimate->CurrentValue = $this->BudgetEstimate->FormValue;
		$this->ActualAmount->CurrentValue = $this->ActualAmount->FormValue;
		$this->Status->CurrentValue = $this->Status->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->BudgetLine->CurrentValue = $this->BudgetLine->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		$this->ApprovedBudget->CurrentValue = $this->ApprovedBudget->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ActionCode->setDbValue($row['ActionCode']);
		$this->DetailedActionCode->setDbValue($row['DetailedActionCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->AccountCode->setDbValue($row['AccountCode']);
		$this->ItemCode->setDbValue($row['ItemCode']);
		$this->MeansOfImplementation->setDbValue($row['MeansOfImplementation']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->PeriodLength->setDbValue($row['PeriodLength']);
		$this->Frequency->setDbValue($row['Frequency']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->BudgetEstimate->setDbValue($row['BudgetEstimate']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->Status->setDbValue($row['Status']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->BudgetLine->setDbValue($row['BudgetLine']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->ApprovedBudget->setDbValue($row['ApprovedBudget']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['OutcomeCode'] = NULL;
		$row['OutputCode'] = NULL;
		$row['ActionCode'] = NULL;
		$row['DetailedActionCode'] = NULL;
		$row['FinancialYear'] = NULL;
		$row['AccountCode'] = NULL;
		$row['ItemCode'] = NULL;
		$row['MeansOfImplementation'] = NULL;
		$row['UnitOfMeasure'] = NULL;
		$row['Quantity'] = NULL;
		$row['PeriodType'] = NULL;
		$row['PeriodLength'] = NULL;
		$row['Frequency'] = NULL;
		$row['UnitCost'] = NULL;
		$row['BudgetEstimate'] = NULL;
		$row['ActualAmount'] = NULL;
		$row['Status'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['SectionCode'] = NULL;
		$row['BudgetLine'] = NULL;
		$row['ProgramCode'] = NULL;
		$row['SubProgramCode'] = NULL;
		$row['ApprovedBudget'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BudgetLine")) != "")
			$this->BudgetLine->OldValue = $this->getKey("BudgetLine"); // BudgetLine
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

		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->PeriodLength->FormValue == $this->PeriodLength->CurrentValue && is_numeric(ConvertToFloatString($this->PeriodLength->CurrentValue)))
			$this->PeriodLength->CurrentValue = ConvertToFloatString($this->PeriodLength->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BudgetEstimate->FormValue == $this->BudgetEstimate->CurrentValue && is_numeric(ConvertToFloatString($this->BudgetEstimate->CurrentValue)))
			$this->BudgetEstimate->CurrentValue = ConvertToFloatString($this->BudgetEstimate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ActualAmount->FormValue == $this->ActualAmount->CurrentValue && is_numeric(ConvertToFloatString($this->ActualAmount->CurrentValue)))
			$this->ActualAmount->CurrentValue = ConvertToFloatString($this->ActualAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ApprovedBudget->FormValue == $this->ApprovedBudget->CurrentValue && is_numeric(ConvertToFloatString($this->ApprovedBudget->CurrentValue)))
			$this->ApprovedBudget->CurrentValue = ConvertToFloatString($this->ApprovedBudget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// OutcomeCode
		// OutputCode
		// ActionCode
		// DetailedActionCode
		// FinancialYear
		// AccountCode
		// ItemCode
		// MeansOfImplementation
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// BudgetEstimate
		// ActualAmount
		// Status
		// LACode
		// DepartmentCode
		// SectionCode
		// BudgetLine
		// ProgramCode
		// SubProgramCode
		// ApprovedBudget

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OutcomeCode
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
					}
				}
			} else {
				$this->OutcomeCode->ViewValue = NULL;
			}
			$this->OutcomeCode->ViewCustomAttributes = "";

			// OutputCode
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
					}
				}
			} else {
				$this->OutputCode->ViewValue = NULL;
			}
			$this->OutputCode->ViewCustomAttributes = "";

			// ActionCode
			$curVal = strval($this->ActionCode->CurrentValue);
			if ($curVal != "") {
				$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
					}
				}
			} else {
				$this->ActionCode->ViewValue = NULL;
			}
			$this->ActionCode->ViewCustomAttributes = "";

			// DetailedActionCode
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$curVal = strval($this->DetailedActionCode->CurrentValue);
			if ($curVal != "") {
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
					}
				}
			} else {
				$this->DetailedActionCode->ViewValue = NULL;
			}
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// FinancialYear
			$curVal = strval($this->FinancialYear->CurrentValue);
			if ($curVal != "") {
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
					}
				}
			} else {
				$this->FinancialYear->ViewValue = NULL;
			}
			$this->FinancialYear->ViewCustomAttributes = "";

			// AccountCode
			$curVal = strval($this->AccountCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
				if ($this->AccountCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
					}
				}
			} else {
				$this->AccountCode->ViewValue = NULL;
			}
			$this->AccountCode->ViewCustomAttributes = "";

			// MeansOfImplementation
			$curVal = strval($this->MeansOfImplementation->CurrentValue);
			if ($curVal != "") {
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
				if ($this->MeansOfImplementation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`moimp_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->CurrentValue;
					}
				}
			} else {
				$this->MeansOfImplementation->ViewValue = NULL;
			}
			$this->MeansOfImplementation->ViewCustomAttributes = "";

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

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 4, -2, -2, -2);
			$this->Quantity->CellCssStyle .= "text-align: right;";
			$this->Quantity->ViewCustomAttributes = "";

			// PeriodType
			$curVal = strval($this->PeriodType->CurrentValue);
			if ($curVal != "") {
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
				if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
					}
				}
			} else {
				$this->PeriodType->ViewValue = NULL;
			}
			$this->PeriodType->ViewCustomAttributes = "";

			// PeriodLength
			$this->PeriodLength->ViewValue = $this->PeriodLength->CurrentValue;
			$this->PeriodLength->ViewValue = FormatNumber($this->PeriodLength->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->PeriodLength->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->CellCssStyle .= "text-align: right;";
			$this->UnitCost->ViewCustomAttributes = "";

			// BudgetEstimate
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";

			// Status
			$this->Status->ViewValue = $this->Status->CurrentValue;
			$curVal = strval($this->Status->CurrentValue);
			if ($curVal != "") {
				$this->Status->ViewValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Status->ViewValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->ViewValue = $this->Status->CurrentValue;
					}
				}
			} else {
				$this->Status->ViewValue = NULL;
			}
			$this->Status->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
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

			// BudgetLine
			$this->BudgetLine->ViewValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";

			// SubProgramCode
			$curVal = strval($this->SubProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
				if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
					}
				}
			} else {
				$this->SubProgramCode->ViewValue = NULL;
			}
			$this->SubProgramCode->ViewCustomAttributes = "";

			// ApprovedBudget
			$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
			$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
			$this->ApprovedBudget->ViewCustomAttributes = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";
			$this->ActionCode->TooltipValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";
			$this->DetailedActionCode->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";
			$this->AccountCode->TooltipValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";
			$this->MeansOfImplementation->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// PeriodLength
			$this->PeriodLength->LinkCustomAttributes = "";
			$this->PeriodLength->HrefValue = "";
			$this->PeriodLength->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";
			$this->BudgetEstimate->TooltipValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";
			$this->ActualAmount->TooltipValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
			$this->Status->TooltipValue = "";

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

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";
			$this->BudgetLine->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
			$this->ApprovedBudget->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// OutcomeCode
			$this->OutcomeCode->EditCustomAttributes = "";
			if ($this->OutcomeCode->getSessionValue() != "") {
				$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
				$curVal = strval($this->OutcomeCode->CurrentValue);
				if ($curVal != "") {
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
					if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
						}
					}
				} else {
					$this->OutcomeCode->ViewValue = NULL;
				}
				$this->OutcomeCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutcomeCode->CurrentValue));
				if ($curVal != "")
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				else
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->Lookup !== NULL && is_array($this->OutcomeCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutcomeCode->ViewValue !== NULL) { // Load from cache
					$this->OutcomeCode->EditValue = array_values($this->OutcomeCode->Lookup->Options);
					if ($this->OutcomeCode->ViewValue == "")
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutcomeCode`" . SearchString("=", $this->OutcomeCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
					} else {
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutcomeCode->EditValue = $arwrk;
				}
			}

			// OutputCode
			$this->OutputCode->EditCustomAttributes = "";
			if ($this->OutputCode->getSessionValue() != "") {
				$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
				$curVal = strval($this->OutputCode->CurrentValue);
				if ($curVal != "") {
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
					if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
						}
					}
				} else {
					$this->OutputCode->ViewValue = NULL;
				}
				$this->OutputCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutputCode->CurrentValue));
				if ($curVal != "")
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				else
					$this->OutputCode->ViewValue = $this->OutputCode->Lookup !== NULL && is_array($this->OutputCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutputCode->ViewValue !== NULL) { // Load from cache
					$this->OutputCode->EditValue = array_values($this->OutputCode->Lookup->Options);
					if ($this->OutputCode->ViewValue == "")
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutputCode`" . SearchString("=", $this->OutputCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutputCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
					} else {
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutputCode->EditValue = $arwrk;
				}
			}

			// ActionCode
			$this->ActionCode->EditAttrs["class"] = "form-control";
			$this->ActionCode->EditCustomAttributes = "";
			if ($this->ActionCode->getSessionValue() != "") {
				$this->ActionCode->CurrentValue = $this->ActionCode->getSessionValue();
				$curVal = strval($this->ActionCode->CurrentValue);
				if ($curVal != "") {
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
					if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
						}
					}
				} else {
					$this->ActionCode->ViewValue = NULL;
				}
				$this->ActionCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ActionCode->CurrentValue));
				if ($curVal != "")
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				else
					$this->ActionCode->ViewValue = $this->ActionCode->Lookup !== NULL && is_array($this->ActionCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ActionCode->ViewValue !== NULL) { // Load from cache
					$this->ActionCode->EditValue = array_values($this->ActionCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ActionCode->EditValue = $arwrk;
				}
			}

			// DetailedActionCode
			$this->DetailedActionCode->EditAttrs["class"] = "form-control";
			$this->DetailedActionCode->EditCustomAttributes = "";
			if ($this->DetailedActionCode->getSessionValue() != "") {
				$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->getSessionValue();
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
						}
					}
				} else {
					$this->DetailedActionCode->ViewValue = NULL;
				}
				$this->DetailedActionCode->ViewCustomAttributes = "";
			} else {
				$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->EditValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->DetailedActionCode->EditValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
						}
					}
				} else {
					$this->DetailedActionCode->EditValue = NULL;
				}
				$this->DetailedActionCode->PlaceHolder = RemoveHtml($this->DetailedActionCode->caption());
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$curVal = strval($this->FinancialYear->CurrentValue);
				if ($curVal != "") {
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
					if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
						}
					}
				} else {
					$this->FinancialYear->ViewValue = NULL;
				}
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->FinancialYear->CurrentValue));
				if ($curVal != "")
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				else
					$this->FinancialYear->ViewValue = $this->FinancialYear->Lookup !== NULL && is_array($this->FinancialYear->Lookup->Options) ? $curVal : NULL;
				if ($this->FinancialYear->ViewValue !== NULL) { // Load from cache
					$this->FinancialYear->EditValue = array_values($this->FinancialYear->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`Year`" . SearchString("=", $this->FinancialYear->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->FinancialYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->FinancialYear->EditValue = $arwrk;
				}
			}

			// AccountCode
			$this->AccountCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountCode->CurrentValue));
			if ($curVal != "")
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
			else
				$this->AccountCode->ViewValue = $this->AccountCode->Lookup !== NULL && is_array($this->AccountCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountCode->ViewValue !== NULL) { // Load from cache
				$this->AccountCode->EditValue = array_values($this->AccountCode->Lookup->Options);
				if ($this->AccountCode->ViewValue == "")
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
				} else {
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountCode->EditValue = $arwrk;
			}

			// MeansOfImplementation
			$this->MeansOfImplementation->EditCustomAttributes = "";
			$curVal = trim(strval($this->MeansOfImplementation->CurrentValue));
			if ($curVal != "")
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
			else
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->Lookup !== NULL && is_array($this->MeansOfImplementation->Lookup->Options) ? $curVal : NULL;
			if ($this->MeansOfImplementation->ViewValue !== NULL) { // Load from cache
				$this->MeansOfImplementation->EditValue = array_values($this->MeansOfImplementation->Lookup->Options);
				if ($this->MeansOfImplementation->ViewValue == "")
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`moimp_code`" . SearchString("=", $this->MeansOfImplementation->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
				} else {
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MeansOfImplementation->EditValue = $arwrk;
			}

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

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->CurrentValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
			if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue))
				$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
			

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->CurrentValue));
			if ($curVal != "")
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// PeriodLength
			$this->PeriodLength->EditAttrs["class"] = "form-control";
			$this->PeriodLength->EditCustomAttributes = "";
			$this->PeriodLength->EditValue = HtmlEncode($this->PeriodLength->CurrentValue);
			$this->PeriodLength->PlaceHolder = RemoveHtml($this->PeriodLength->caption());
			if (strval($this->PeriodLength->EditValue) != "" && is_numeric($this->PeriodLength->EditValue))
				$this->PeriodLength->EditValue = FormatNumber($this->PeriodLength->EditValue, -2, -1, -2, 0);
			

			// Frequency
			$this->Frequency->EditAttrs["class"] = "form-control";
			$this->Frequency->EditCustomAttributes = "";
			$this->Frequency->EditValue = HtmlEncode($this->Frequency->CurrentValue);
			$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
			if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue))
				$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
			

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->CurrentValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
			if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue))
				$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
			

			// BudgetEstimate
			$this->BudgetEstimate->EditAttrs["class"] = "form-control";
			$this->BudgetEstimate->EditCustomAttributes = "";
			$this->BudgetEstimate->EditValue = HtmlEncode($this->BudgetEstimate->CurrentValue);
			$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
			if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue))
				$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
			

			// ActualAmount
			$this->ActualAmount->EditAttrs["class"] = "form-control";
			$this->ActualAmount->EditCustomAttributes = "";
			$this->ActualAmount->EditValue = HtmlEncode($this->ActualAmount->CurrentValue);
			$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
			if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
				$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
			

			// Status
			$this->Status->EditAttrs["class"] = "form-control";
			$this->Status->EditCustomAttributes = "";
			if (!$this->Status->Raw)
				$this->Status->CurrentValue = HtmlDecode($this->Status->CurrentValue);
			$this->Status->EditValue = HtmlEncode($this->Status->CurrentValue);
			$curVal = strval($this->Status->CurrentValue);
			if ($curVal != "") {
				$this->Status->EditValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Status->EditValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->EditValue = HtmlEncode($this->Status->CurrentValue);
					}
				}
			} else {
				$this->Status->EditValue = NULL;
			}
			$this->Status->PlaceHolder = RemoveHtml($this->Status->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->ViewValue = $this->LACode->CurrentValue;
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
				if (!$this->LACode->Raw)
					$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
				$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
						}
					}
				} else {
					$this->LACode->EditValue = NULL;
				}
				$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			if ($this->DepartmentCode->getSessionValue() != "") {
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
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
			} else {
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

			// BudgetLine
			$this->BudgetLine->EditAttrs["class"] = "form-control";
			$this->BudgetLine->EditCustomAttributes = "";
			$this->BudgetLine->EditValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
			$this->ProgramCode->EditCustomAttributes = "";
			if ($this->ProgramCode->getSessionValue() != "") {
				$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
				$curVal = strval($this->ProgramCode->CurrentValue);
				if ($curVal != "") {
					$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
					if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
						}
					}
				} else {
					$this->ProgramCode->ViewValue = NULL;
				}
				$this->ProgramCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ProgramCode->CurrentValue));
				if ($curVal != "")
					$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				else
					$this->ProgramCode->ViewValue = $this->ProgramCode->Lookup !== NULL && is_array($this->ProgramCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProgramCode->ViewValue !== NULL) { // Load from cache
					$this->ProgramCode->EditValue = array_values($this->ProgramCode->Lookup->Options);
					if ($this->ProgramCode->ViewValue == "")
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
					} else {
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProgramCode->EditValue = $arwrk;
				}
			}

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			if ($this->SubProgramCode->getSessionValue() != "") {
				$this->SubProgramCode->CurrentValue = $this->SubProgramCode->getSessionValue();
				$curVal = strval($this->SubProgramCode->CurrentValue);
				if ($curVal != "") {
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
					if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
						}
					}
				} else {
					$this->SubProgramCode->ViewValue = NULL;
				}
				$this->SubProgramCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->SubProgramCode->CurrentValue));
				if ($curVal != "")
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
				else
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->Lookup !== NULL && is_array($this->SubProgramCode->Lookup->Options) ? $curVal : NULL;
				if ($this->SubProgramCode->ViewValue !== NULL) { // Load from cache
					$this->SubProgramCode->EditValue = array_values($this->SubProgramCode->Lookup->Options);
					if ($this->SubProgramCode->ViewValue == "")
						$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`SubProgramCode`" . SearchString("=", $this->SubProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
					} else {
						$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->SubProgramCode->EditValue = $arwrk;
				}
			}

			// ApprovedBudget
			$this->ApprovedBudget->EditAttrs["class"] = "form-control";
			$this->ApprovedBudget->EditCustomAttributes = "";
			$this->ApprovedBudget->EditValue = HtmlEncode($this->ApprovedBudget->CurrentValue);
			$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
			if (strval($this->ApprovedBudget->EditValue) != "" && is_numeric($this->ApprovedBudget->EditValue))
				$this->ApprovedBudget->EditValue = FormatNumber($this->ApprovedBudget->EditValue, -2, -2, -2, -2);
			

			// Edit refer script
			// OutcomeCode

			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// PeriodLength
			$this->PeriodLength->LinkCustomAttributes = "";
			$this->PeriodLength->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
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
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
			}
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if ($this->ActionCode->Required) {
			if (!$this->ActionCode->IsDetailKey && $this->ActionCode->FormValue != NULL && $this->ActionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionCode->caption(), $this->ActionCode->RequiredErrorMessage));
			}
		}
		if ($this->DetailedActionCode->Required) {
			if (!$this->DetailedActionCode->IsDetailKey && $this->DetailedActionCode->FormValue != NULL && $this->DetailedActionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DetailedActionCode->caption(), $this->DetailedActionCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->DetailedActionCode->FormValue)) {
			AddMessage($FormError, $this->DetailedActionCode->errorMessage());
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if ($this->AccountCode->Required) {
			if (!$this->AccountCode->IsDetailKey && $this->AccountCode->FormValue != NULL && $this->AccountCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountCode->caption(), $this->AccountCode->RequiredErrorMessage));
			}
		}
		if ($this->MeansOfImplementation->Required) {
			if (!$this->MeansOfImplementation->IsDetailKey && $this->MeansOfImplementation->FormValue != NULL && $this->MeansOfImplementation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MeansOfImplementation->caption(), $this->MeansOfImplementation->RequiredErrorMessage));
			}
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->Quantity->Required) {
			if (!$this->Quantity->IsDetailKey && $this->Quantity->FormValue != NULL && $this->Quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Quantity->caption(), $this->Quantity->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Quantity->FormValue)) {
			AddMessage($FormError, $this->Quantity->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if ($this->PeriodLength->Required) {
			if (!$this->PeriodLength->IsDetailKey && $this->PeriodLength->FormValue != NULL && $this->PeriodLength->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodLength->caption(), $this->PeriodLength->RequiredErrorMessage));
			}
		}
		if ($this->Frequency->Required) {
			if (!$this->Frequency->IsDetailKey && $this->Frequency->FormValue != NULL && $this->Frequency->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Frequency->caption(), $this->Frequency->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Frequency->FormValue)) {
			AddMessage($FormError, $this->Frequency->errorMessage());
		}
		if ($this->UnitCost->Required) {
			if (!$this->UnitCost->IsDetailKey && $this->UnitCost->FormValue != NULL && $this->UnitCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitCost->caption(), $this->UnitCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitCost->FormValue)) {
			AddMessage($FormError, $this->UnitCost->errorMessage());
		}
		if ($this->BudgetEstimate->Required) {
			if (!$this->BudgetEstimate->IsDetailKey && $this->BudgetEstimate->FormValue != NULL && $this->BudgetEstimate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BudgetEstimate->caption(), $this->BudgetEstimate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BudgetEstimate->FormValue)) {
			AddMessage($FormError, $this->BudgetEstimate->errorMessage());
		}
		if ($this->ActualAmount->Required) {
			if (!$this->ActualAmount->IsDetailKey && $this->ActualAmount->FormValue != NULL && $this->ActualAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualAmount->caption(), $this->ActualAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ActualAmount->FormValue)) {
			AddMessage($FormError, $this->ActualAmount->errorMessage());
		}
		if ($this->Status->Required) {
			if (!$this->Status->IsDetailKey && $this->Status->FormValue != NULL && $this->Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Status->caption(), $this->Status->RequiredErrorMessage));
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
		if ($this->BudgetLine->Required) {
			if (!$this->BudgetLine->IsDetailKey && $this->BudgetLine->FormValue != NULL && $this->BudgetLine->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BudgetLine->caption(), $this->BudgetLine->RequiredErrorMessage));
			}
		}
		if ($this->ProgramCode->Required) {
			if (!$this->ProgramCode->IsDetailKey && $this->ProgramCode->FormValue != NULL && $this->ProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgramCode->caption(), $this->ProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->SubProgramCode->Required) {
			if (!$this->SubProgramCode->IsDetailKey && $this->SubProgramCode->FormValue != NULL && $this->SubProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubProgramCode->caption(), $this->SubProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->ApprovedBudget->Required) {
			if (!$this->ApprovedBudget->IsDetailKey && $this->ApprovedBudget->FormValue != NULL && $this->ApprovedBudget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ApprovedBudget->caption(), $this->ApprovedBudget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ApprovedBudget->FormValue)) {
			AddMessage($FormError, $this->ApprovedBudget->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// OutcomeCode
			$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, $this->OutcomeCode->ReadOnly);

			// OutputCode
			$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, $this->OutputCode->ReadOnly);

			// ActionCode
			$this->ActionCode->setDbValueDef($rsnew, $this->ActionCode->CurrentValue, 0, $this->ActionCode->ReadOnly);

			// DetailedActionCode
			$this->DetailedActionCode->setDbValueDef($rsnew, $this->DetailedActionCode->CurrentValue, 0, $this->DetailedActionCode->ReadOnly);

			// FinancialYear
			$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, $this->FinancialYear->ReadOnly);

			// AccountCode
			$this->AccountCode->setDbValueDef($rsnew, $this->AccountCode->CurrentValue, "", $this->AccountCode->ReadOnly);

			// MeansOfImplementation
			$this->MeansOfImplementation->setDbValueDef($rsnew, $this->MeansOfImplementation->CurrentValue, NULL, $this->MeansOfImplementation->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// Quantity
			$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, 0, $this->Quantity->ReadOnly);

			// PeriodType
			$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, $this->PeriodType->ReadOnly);

			// PeriodLength
			$this->PeriodLength->setDbValueDef($rsnew, $this->PeriodLength->CurrentValue, NULL, $this->PeriodLength->ReadOnly);

			// Frequency
			$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, 0, $this->Frequency->ReadOnly);

			// UnitCost
			$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, 0, $this->UnitCost->ReadOnly);

			// BudgetEstimate
			$this->BudgetEstimate->setDbValueDef($rsnew, $this->BudgetEstimate->CurrentValue, 0, $this->BudgetEstimate->ReadOnly);

			// ActualAmount
			$this->ActualAmount->setDbValueDef($rsnew, $this->ActualAmount->CurrentValue, NULL, $this->ActualAmount->ReadOnly);

			// Status
			$this->Status->setDbValueDef($rsnew, $this->Status->CurrentValue, NULL, $this->Status->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// ProgramCode
			$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, $this->ProgramCode->ReadOnly);

			// SubProgramCode
			$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, 0, $this->SubProgramCode->ReadOnly);

			// ApprovedBudget
			$this->ApprovedBudget->setDbValueDef($rsnew, $this->ApprovedBudget->CurrentValue, 0, $this->ApprovedBudget->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["detailed_action"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_FinancialYear", Get("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setQueryStringValue($parm);
					$this->FinancialYear->setQueryStringValue($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ActionCode", Get("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setQueryStringValue($parm);
					$this->ActionCode->setQueryStringValue($GLOBALS["detailed_action"]->ActionCode->QueryStringValue);
					$this->ActionCode->setSessionValue($this->ActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutcomeCode", Get("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setQueryStringValue($parm);
					$this->OutcomeCode->setQueryStringValue($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutputCode", Get("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setQueryStringValue($parm);
					$this->OutputCode->setQueryStringValue($GLOBALS["detailed_action"]->OutputCode->QueryStringValue);
					$this->OutputCode->setSessionValue($this->OutputCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DetailedActionCode", Get("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setQueryStringValue($parm);
					$this->DetailedActionCode->setQueryStringValue($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProgramCode", Get("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setQueryStringValue($parm);
					$this->ProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SubProgramCode", Get("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setQueryStringValue($parm);
					$this->SubProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue))
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
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["detailed_action"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["detailed_action"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_FinancialYear", Post("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setFormValue($parm);
					$this->FinancialYear->setFormValue($GLOBALS["detailed_action"]->FinancialYear->FormValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ActionCode", Post("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setFormValue($parm);
					$this->ActionCode->setFormValue($GLOBALS["detailed_action"]->ActionCode->FormValue);
					$this->ActionCode->setSessionValue($this->ActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutcomeCode", Post("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setFormValue($parm);
					$this->OutcomeCode->setFormValue($GLOBALS["detailed_action"]->OutcomeCode->FormValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutputCode", Post("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setFormValue($parm);
					$this->OutputCode->setFormValue($GLOBALS["detailed_action"]->OutputCode->FormValue);
					$this->OutputCode->setSessionValue($this->OutputCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DetailedActionCode", Post("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setFormValue($parm);
					$this->DetailedActionCode->setFormValue($GLOBALS["detailed_action"]->DetailedActionCode->FormValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProgramCode", Post("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setFormValue($parm);
					$this->ProgramCode->setFormValue($GLOBALS["detailed_action"]->ProgramCode->FormValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SubProgramCode", Post("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setFormValue($parm);
					$this->SubProgramCode->setFormValue($GLOBALS["detailed_action"]->SubProgramCode->FormValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "detailed_action") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->FinancialYear->CurrentValue == "")
					$this->FinancialYear->setSessionValue("");
				if ($this->ActionCode->CurrentValue == "")
					$this->ActionCode->setSessionValue("");
				if ($this->OutcomeCode->CurrentValue == "")
					$this->OutcomeCode->setSessionValue("");
				if ($this->OutputCode->CurrentValue == "")
					$this->OutputCode->setSessionValue("");
				if ($this->DetailedActionCode->CurrentValue == "")
					$this->DetailedActionCode->setSessionValue("");
				if ($this->ProgramCode->CurrentValue == "")
					$this->ProgramCode->setSessionValue("");
				if ($this->SubProgramCode->CurrentValue == "")
					$this->SubProgramCode->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("budgetlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_OutcomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ActionCode":
					break;
				case "x_DetailedActionCode":
					break;
				case "x_FinancialYear":
					break;
				case "x_AccountCode":
					break;
				case "x_MeansOfImplementation":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_Status":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
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
						case "x_OutcomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ActionCode":
							break;
						case "x_DetailedActionCode":
							break;
						case "x_FinancialYear":
							break;
						case "x_AccountCode":
							break;
						case "x_MeansOfImplementation":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_Status":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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