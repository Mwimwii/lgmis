<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class output_indicator_add extends output_indicator
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'output_indicator';

	// Page object name
	public $PageObjName = "output_indicator_add";

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

		// Table object (output_indicator)
		if (!isset($GLOBALS["output_indicator"]) || get_class($GLOBALS["output_indicator"]) == PROJECT_NAMESPACE . "output_indicator") {
			$GLOBALS["output_indicator"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["output_indicator"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'output_indicator');

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
		global $output_indicator;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($output_indicator);
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
					if ($pageName == "output_indicatorview.php")
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
			$key .= @$ar['IndicatorNo'];
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
			$this->IndicatorNo->Visible = FALSE;
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
					$this->terminate(GetUrl("output_indicatorlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->IndicatorNo->Visible = FALSE;
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->OutcomeCode->setVisibility();
		$this->OutputType->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->OutputIndicatorName->setVisibility();
		$this->TargetAmount->setVisibility();
		$this->ActualAmount->setVisibility();
		$this->PercentAchieved->setVisibility();
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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputType);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("output_indicatorlist.php");
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
			if (Get("IndicatorNo") !== NULL) {
				$this->IndicatorNo->setQueryStringValue(Get("IndicatorNo"));
				$this->setKey("IndicatorNo", $this->IndicatorNo->CurrentValue); // Set up key
			} else {
				$this->setKey("IndicatorNo", ""); // Clear key
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
					$this->terminate("output_indicatorlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "output_indicatorlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "output_indicatorview.php")
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
		$this->IndicatorNo->CurrentValue = NULL;
		$this->IndicatorNo->OldValue = $this->IndicatorNo->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->OutputCode->CurrentValue = 0;
		$this->OutcomeCode->CurrentValue = NULL;
		$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
		$this->OutputType->CurrentValue = NULL;
		$this->OutputType->OldValue = $this->OutputType->CurrentValue;
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->SubProgramCode->CurrentValue = NULL;
		$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->OutputIndicatorName->CurrentValue = NULL;
		$this->OutputIndicatorName->OldValue = $this->OutputIndicatorName->CurrentValue;
		$this->TargetAmount->CurrentValue = NULL;
		$this->TargetAmount->OldValue = $this->TargetAmount->CurrentValue;
		$this->ActualAmount->CurrentValue = NULL;
		$this->ActualAmount->OldValue = $this->ActualAmount->CurrentValue;
		$this->PercentAchieved->CurrentValue = NULL;
		$this->PercentAchieved->OldValue = $this->PercentAchieved->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
		if (!$this->OutputCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutputCode->setFormValue($val);
		}

		// Check field name 'OutcomeCode' first before field var 'x_OutcomeCode'
		$val = $CurrentForm->hasValue("OutcomeCode") ? $CurrentForm->getValue("OutcomeCode") : $CurrentForm->getValue("x_OutcomeCode");
		if (!$this->OutcomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeCode->setFormValue($val);
		}

		// Check field name 'OutputType' first before field var 'x_OutputType'
		$val = $CurrentForm->hasValue("OutputType") ? $CurrentForm->getValue("OutputType") : $CurrentForm->getValue("x_OutputType");
		if (!$this->OutputType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputType->Visible = FALSE; // Disable update for API request
			else
				$this->OutputType->setFormValue($val);
		}

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

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}

		// Check field name 'OutputIndicatorName' first before field var 'x_OutputIndicatorName'
		$val = $CurrentForm->hasValue("OutputIndicatorName") ? $CurrentForm->getValue("OutputIndicatorName") : $CurrentForm->getValue("x_OutputIndicatorName");
		if (!$this->OutputIndicatorName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputIndicatorName->Visible = FALSE; // Disable update for API request
			else
				$this->OutputIndicatorName->setFormValue($val);
		}

		// Check field name 'TargetAmount' first before field var 'x_TargetAmount'
		$val = $CurrentForm->hasValue("TargetAmount") ? $CurrentForm->getValue("TargetAmount") : $CurrentForm->getValue("x_TargetAmount");
		if (!$this->TargetAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TargetAmount->Visible = FALSE; // Disable update for API request
			else
				$this->TargetAmount->setFormValue($val);
		}

		// Check field name 'ActualAmount' first before field var 'x_ActualAmount'
		$val = $CurrentForm->hasValue("ActualAmount") ? $CurrentForm->getValue("ActualAmount") : $CurrentForm->getValue("x_ActualAmount");
		if (!$this->ActualAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualAmount->Visible = FALSE; // Disable update for API request
			else
				$this->ActualAmount->setFormValue($val);
		}

		// Check field name 'PercentAchieved' first before field var 'x_PercentAchieved'
		$val = $CurrentForm->hasValue("PercentAchieved") ? $CurrentForm->getValue("PercentAchieved") : $CurrentForm->getValue("x_PercentAchieved");
		if (!$this->PercentAchieved->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PercentAchieved->Visible = FALSE; // Disable update for API request
			else
				$this->PercentAchieved->setFormValue($val);
		}

		// Check field name 'IndicatorNo' first before field var 'x_IndicatorNo'
		$val = $CurrentForm->hasValue("IndicatorNo") ? $CurrentForm->getValue("IndicatorNo") : $CurrentForm->getValue("x_IndicatorNo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->OutputType->CurrentValue = $this->OutputType->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->OutputIndicatorName->CurrentValue = $this->OutputIndicatorName->FormValue;
		$this->TargetAmount->CurrentValue = $this->TargetAmount->FormValue;
		$this->ActualAmount->CurrentValue = $this->ActualAmount->FormValue;
		$this->PercentAchieved->CurrentValue = $this->PercentAchieved->FormValue;
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
		$this->IndicatorNo->setDbValue($row['IndicatorNo']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutputType->setDbValue($row['OutputType']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->OutputIndicatorName->setDbValue($row['OutputIndicatorName']);
		$this->TargetAmount->setDbValue($row['TargetAmount']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->PercentAchieved->setDbValue($row['PercentAchieved']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['IndicatorNo'] = $this->IndicatorNo->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['OutcomeCode'] = $this->OutcomeCode->CurrentValue;
		$row['OutputType'] = $this->OutputType->CurrentValue;
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['SubProgramCode'] = $this->SubProgramCode->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['OutputIndicatorName'] = $this->OutputIndicatorName->CurrentValue;
		$row['TargetAmount'] = $this->TargetAmount->CurrentValue;
		$row['ActualAmount'] = $this->ActualAmount->CurrentValue;
		$row['PercentAchieved'] = $this->PercentAchieved->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("IndicatorNo")) != "")
			$this->IndicatorNo->OldValue = $this->getKey("IndicatorNo"); // IndicatorNo
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

		if ($this->TargetAmount->FormValue == $this->TargetAmount->CurrentValue && is_numeric(ConvertToFloatString($this->TargetAmount->CurrentValue)))
			$this->TargetAmount->CurrentValue = ConvertToFloatString($this->TargetAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ActualAmount->FormValue == $this->ActualAmount->CurrentValue && is_numeric(ConvertToFloatString($this->ActualAmount->CurrentValue)))
			$this->ActualAmount->CurrentValue = ConvertToFloatString($this->ActualAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->PercentAchieved->FormValue == $this->PercentAchieved->CurrentValue && is_numeric(ConvertToFloatString($this->PercentAchieved->CurrentValue)))
			$this->PercentAchieved->CurrentValue = ConvertToFloatString($this->PercentAchieved->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// IndicatorNo
		// LACode
		// DepartmentCode
		// SectionCode
		// OutputCode
		// OutcomeCode
		// OutputType
		// ProgramCode
		// SubProgramCode
		// FinancialYear
		// OutputIndicatorName
		// TargetAmount
		// ActualAmount
		// PercentAchieved

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IndicatorNo
			$this->IndicatorNo->ViewValue = $this->IndicatorNo->CurrentValue;
			$this->IndicatorNo->ViewCustomAttributes = "";

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
			$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
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
			$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
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

			// OutputCode
			$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
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

			// OutcomeCode
			$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
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

			// OutputType
			$this->OutputType->ViewValue = $this->OutputType->CurrentValue;
			$curVal = strval($this->OutputType->CurrentValue);
			if ($curVal != "") {
				$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
				if ($this->OutputType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OutputType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputType->ViewValue = $this->OutputType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputType->ViewValue = $this->OutputType->CurrentValue;
					}
				}
			} else {
				$this->OutputType->ViewValue = NULL;
			}
			$this->OutputType->ViewCustomAttributes = "";

			// ProgramCode
			$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
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
			$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
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

			// FinancialYear
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";

			// OutputIndicatorName
			$this->OutputIndicatorName->ViewValue = $this->OutputIndicatorName->CurrentValue;
			$this->OutputIndicatorName->ViewCustomAttributes = "";

			// TargetAmount
			$this->TargetAmount->ViewValue = $this->TargetAmount->CurrentValue;
			$this->TargetAmount->ViewValue = FormatNumber($this->TargetAmount->ViewValue, 2, -2, -2, -2);
			$this->TargetAmount->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->ViewCustomAttributes = "";

			// PercentAchieved
			$this->PercentAchieved->ViewValue = $this->PercentAchieved->CurrentValue;
			$this->PercentAchieved->ViewValue = FormatPercent($this->PercentAchieved->ViewValue, 2, -2, -2, -2);
			$this->PercentAchieved->ViewCustomAttributes = "";

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

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";
			$this->OutputType->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// OutputIndicatorName
			$this->OutputIndicatorName->LinkCustomAttributes = "";
			$this->OutputIndicatorName->HrefValue = "";
			$this->OutputIndicatorName->TooltipValue = "";

			// TargetAmount
			$this->TargetAmount->LinkCustomAttributes = "";
			$this->TargetAmount->HrefValue = "";
			$this->TargetAmount->TooltipValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";
			$this->ActualAmount->TooltipValue = "";

			// PercentAchieved
			$this->PercentAchieved->LinkCustomAttributes = "";
			$this->PercentAchieved->HrefValue = "";
			$this->PercentAchieved->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
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

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$this->DepartmentCode->EditValue = HtmlEncode($this->DepartmentCode->CurrentValue);
			$curVal = strval($this->DepartmentCode->CurrentValue);
			if ($curVal != "") {
				$this->DepartmentCode->EditValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->EditValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->EditValue = HtmlEncode($this->DepartmentCode->CurrentValue);
					}
				}
			} else {
				$this->DepartmentCode->EditValue = NULL;
			}
			$this->DepartmentCode->PlaceHolder = RemoveHtml($this->DepartmentCode->caption());

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$this->SectionCode->EditValue = HtmlEncode($this->SectionCode->CurrentValue);
			$curVal = strval($this->SectionCode->CurrentValue);
			if ($curVal != "") {
				$this->SectionCode->EditValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->SectionCode->EditValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->EditValue = HtmlEncode($this->SectionCode->CurrentValue);
					}
				}
			} else {
				$this->SectionCode->EditValue = NULL;
			}
			$this->SectionCode->PlaceHolder = RemoveHtml($this->SectionCode->caption());

			// OutputCode
			$this->OutputCode->EditAttrs["class"] = "form-control";
			$this->OutputCode->EditCustomAttributes = "";
			$this->OutputCode->EditValue = HtmlEncode($this->OutputCode->CurrentValue);
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->EditValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutputCode->EditValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->EditValue = HtmlEncode($this->OutputCode->CurrentValue);
					}
				}
			} else {
				$this->OutputCode->EditValue = NULL;
			}
			$this->OutputCode->PlaceHolder = RemoveHtml($this->OutputCode->caption());

			// OutcomeCode
			$this->OutcomeCode->EditAttrs["class"] = "form-control";
			$this->OutcomeCode->EditCustomAttributes = "";
			$this->OutcomeCode->EditValue = HtmlEncode($this->OutcomeCode->CurrentValue);
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->EditValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutcomeCode->EditValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->EditValue = HtmlEncode($this->OutcomeCode->CurrentValue);
					}
				}
			} else {
				$this->OutcomeCode->EditValue = NULL;
			}
			$this->OutcomeCode->PlaceHolder = RemoveHtml($this->OutcomeCode->caption());

			// OutputType
			$this->OutputType->EditAttrs["class"] = "form-control";
			$this->OutputType->EditCustomAttributes = "";
			if (!$this->OutputType->Raw)
				$this->OutputType->CurrentValue = HtmlDecode($this->OutputType->CurrentValue);
			$this->OutputType->EditValue = HtmlEncode($this->OutputType->CurrentValue);
			$curVal = strval($this->OutputType->CurrentValue);
			if ($curVal != "") {
				$this->OutputType->EditValue = $this->OutputType->lookupCacheOption($curVal);
				if ($this->OutputType->EditValue === NULL) { // Lookup from database
					$filterWrk = "`OutputType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OutputType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutputType->EditValue = $this->OutputType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputType->EditValue = HtmlEncode($this->OutputType->CurrentValue);
					}
				}
			} else {
				$this->OutputType->EditValue = NULL;
			}
			$this->OutputType->PlaceHolder = RemoveHtml($this->OutputType->caption());

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
			$this->ProgramCode->EditCustomAttributes = "";
			$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->EditValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->EditValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
					}
				}
			} else {
				$this->ProgramCode->EditValue = NULL;
			}
			$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());

			// SubProgramCode
			$this->SubProgramCode->EditAttrs["class"] = "form-control";
			$this->SubProgramCode->EditCustomAttributes = "";
			$this->SubProgramCode->EditValue = HtmlEncode($this->SubProgramCode->CurrentValue);
			$curVal = strval($this->SubProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->SubProgramCode->EditValue = $this->SubProgramCode->lookupCacheOption($curVal);
				if ($this->SubProgramCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->SubProgramCode->EditValue = $this->SubProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubProgramCode->EditValue = HtmlEncode($this->SubProgramCode->CurrentValue);
					}
				}
			} else {
				$this->SubProgramCode->EditValue = NULL;
			}
			$this->SubProgramCode->PlaceHolder = RemoveHtml($this->SubProgramCode->caption());

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
			$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

			// OutputIndicatorName
			$this->OutputIndicatorName->EditAttrs["class"] = "form-control";
			$this->OutputIndicatorName->EditCustomAttributes = "";
			$this->OutputIndicatorName->EditValue = HtmlEncode($this->OutputIndicatorName->CurrentValue);
			$this->OutputIndicatorName->PlaceHolder = RemoveHtml($this->OutputIndicatorName->caption());

			// TargetAmount
			$this->TargetAmount->EditAttrs["class"] = "form-control";
			$this->TargetAmount->EditCustomAttributes = "";
			$this->TargetAmount->EditValue = HtmlEncode($this->TargetAmount->CurrentValue);
			$this->TargetAmount->PlaceHolder = RemoveHtml($this->TargetAmount->caption());
			if (strval($this->TargetAmount->EditValue) != "" && is_numeric($this->TargetAmount->EditValue))
				$this->TargetAmount->EditValue = FormatNumber($this->TargetAmount->EditValue, -2, -2, -2, -2);
			

			// ActualAmount
			$this->ActualAmount->EditAttrs["class"] = "form-control";
			$this->ActualAmount->EditCustomAttributes = "";
			$this->ActualAmount->EditValue = HtmlEncode($this->ActualAmount->CurrentValue);
			$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
			if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue))
				$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
			

			// PercentAchieved
			$this->PercentAchieved->EditAttrs["class"] = "form-control";
			$this->PercentAchieved->EditCustomAttributes = "";
			$this->PercentAchieved->EditValue = HtmlEncode($this->PercentAchieved->CurrentValue);
			$this->PercentAchieved->PlaceHolder = RemoveHtml($this->PercentAchieved->caption());
			if (strval($this->PercentAchieved->EditValue) != "" && is_numeric($this->PercentAchieved->EditValue))
				$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -1, -2, 0);
			

			// Add refer script
			// LACode

			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// OutputIndicatorName
			$this->OutputIndicatorName->LinkCustomAttributes = "";
			$this->OutputIndicatorName->HrefValue = "";

			// TargetAmount
			$this->TargetAmount->LinkCustomAttributes = "";
			$this->TargetAmount->HrefValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";

			// PercentAchieved
			$this->PercentAchieved->LinkCustomAttributes = "";
			$this->PercentAchieved->HrefValue = "";
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
		if (!CheckInteger($this->DepartmentCode->FormValue)) {
			AddMessage($FormError, $this->DepartmentCode->errorMessage());
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SectionCode->FormValue)) {
			AddMessage($FormError, $this->SectionCode->errorMessage());
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OutputCode->FormValue)) {
			AddMessage($FormError, $this->OutputCode->errorMessage());
		}
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OutcomeCode->FormValue)) {
			AddMessage($FormError, $this->OutcomeCode->errorMessage());
		}
		if ($this->OutputType->Required) {
			if (!$this->OutputType->IsDetailKey && $this->OutputType->FormValue != NULL && $this->OutputType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputType->caption(), $this->OutputType->RequiredErrorMessage));
			}
		}
		if ($this->ProgramCode->Required) {
			if (!$this->ProgramCode->IsDetailKey && $this->ProgramCode->FormValue != NULL && $this->ProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgramCode->caption(), $this->ProgramCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ProgramCode->FormValue)) {
			AddMessage($FormError, $this->ProgramCode->errorMessage());
		}
		if ($this->SubProgramCode->Required) {
			if (!$this->SubProgramCode->IsDetailKey && $this->SubProgramCode->FormValue != NULL && $this->SubProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubProgramCode->caption(), $this->SubProgramCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SubProgramCode->FormValue)) {
			AddMessage($FormError, $this->SubProgramCode->errorMessage());
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FinancialYear->FormValue)) {
			AddMessage($FormError, $this->FinancialYear->errorMessage());
		}
		if ($this->OutputIndicatorName->Required) {
			if (!$this->OutputIndicatorName->IsDetailKey && $this->OutputIndicatorName->FormValue != NULL && $this->OutputIndicatorName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputIndicatorName->caption(), $this->OutputIndicatorName->RequiredErrorMessage));
			}
		}
		if ($this->TargetAmount->Required) {
			if (!$this->TargetAmount->IsDetailKey && $this->TargetAmount->FormValue != NULL && $this->TargetAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TargetAmount->caption(), $this->TargetAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->TargetAmount->FormValue)) {
			AddMessage($FormError, $this->TargetAmount->errorMessage());
		}
		if ($this->ActualAmount->Required) {
			if (!$this->ActualAmount->IsDetailKey && $this->ActualAmount->FormValue != NULL && $this->ActualAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualAmount->caption(), $this->ActualAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ActualAmount->FormValue)) {
			AddMessage($FormError, $this->ActualAmount->errorMessage());
		}
		if ($this->PercentAchieved->Required) {
			if (!$this->PercentAchieved->IsDetailKey && $this->PercentAchieved->FormValue != NULL && $this->PercentAchieved->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PercentAchieved->caption(), $this->PercentAchieved->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->PercentAchieved->FormValue)) {
			AddMessage($FormError, $this->PercentAchieved->errorMessage());
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

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// OutputCode
		$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, strval($this->OutputCode->CurrentValue) == "");

		// OutcomeCode
		$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, FALSE);

		// OutputType
		$this->OutputType->setDbValueDef($rsnew, $this->OutputType->CurrentValue, NULL, FALSE);

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, NULL, FALSE);

		// SubProgramCode
		$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, NULL, FALSE);

		// OutputIndicatorName
		$this->OutputIndicatorName->setDbValueDef($rsnew, $this->OutputIndicatorName->CurrentValue, NULL, FALSE);

		// TargetAmount
		$this->TargetAmount->setDbValueDef($rsnew, $this->TargetAmount->CurrentValue, NULL, FALSE);

		// ActualAmount
		$this->ActualAmount->setDbValueDef($rsnew, $this->ActualAmount->CurrentValue, NULL, FALSE);

		// PercentAchieved
		$this->PercentAchieved->setDbValueDef($rsnew, $this->PercentAchieved->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("output_indicatorlist.php"), "", $this->TableVar, TRUE);
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
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_OutputCode":
					break;
				case "x_OutcomeCode":
					break;
				case "x_OutputType":
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
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_OutputCode":
							break;
						case "x_OutcomeCode":
							break;
						case "x_OutputType":
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