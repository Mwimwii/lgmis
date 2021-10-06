<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class output_add extends output
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'output';

	// Page object name
	public $PageObjName = "output_add";

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

		// Table object (output)
		if (!isset($GLOBALS["output"]) || get_class($GLOBALS["output"]) == PROJECT_NAMESPACE . "output") {
			$GLOBALS["output"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["output"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (outcome)
		if (!isset($GLOBALS['outcome']))
			$GLOBALS['outcome'] = new outcome();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'output');

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
		global $output;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($output);
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
					if ($pageName == "outputview.php")
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
			$key .= @$ar['OutputCode'];
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
			$this->OutputCode->Visible = FALSE;
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
					$this->terminate(GetUrl("outputlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->OutcomeCode->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->OutputCode->Visible = FALSE;
		$this->OutputType->setVisibility();
		$this->OutputName->setVisibility();
		$this->DeliveryDate->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->OutputDescription->setVisibility();
		$this->OutputMeansOfVerification->setVisibility();
		$this->ResponsibleOfficer->setVisibility();
		$this->Clients->setVisibility();
		$this->Beneficiaries->setVisibility();
		$this->OutputStatus->setVisibility();
		$this->LockStatus->Visible = FALSE;
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
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->OutputType);
		$this->setupLookupOptions($this->OutputStatus);
		$this->setupLookupOptions($this->LockStatus);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("outputlist.php");
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
			if (Get("OutputCode") !== NULL) {
				$this->OutputCode->setQueryStringValue(Get("OutputCode"));
				$this->setKey("OutputCode", $this->OutputCode->CurrentValue); // Set up key
			} else {
				$this->setKey("OutputCode", ""); // Clear key
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
					$this->terminate("outputlist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "outputlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "outputview.php")
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
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->OutcomeCode->CurrentValue = NULL;
		$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->SubProgramCode->CurrentValue = NULL;
		$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->OutputType->CurrentValue = NULL;
		$this->OutputType->OldValue = $this->OutputType->CurrentValue;
		$this->OutputName->CurrentValue = NULL;
		$this->OutputName->OldValue = $this->OutputName->CurrentValue;
		$this->DeliveryDate->CurrentValue = NULL;
		$this->DeliveryDate->OldValue = $this->DeliveryDate->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->OutputDescription->CurrentValue = NULL;
		$this->OutputDescription->OldValue = $this->OutputDescription->CurrentValue;
		$this->OutputMeansOfVerification->CurrentValue = NULL;
		$this->OutputMeansOfVerification->OldValue = $this->OutputMeansOfVerification->CurrentValue;
		$this->ResponsibleOfficer->CurrentValue = NULL;
		$this->ResponsibleOfficer->OldValue = $this->ResponsibleOfficer->CurrentValue;
		$this->Clients->CurrentValue = NULL;
		$this->Clients->OldValue = $this->Clients->CurrentValue;
		$this->Beneficiaries->CurrentValue = NULL;
		$this->Beneficiaries->OldValue = $this->Beneficiaries->CurrentValue;
		$this->OutputStatus->CurrentValue = NULL;
		$this->OutputStatus->OldValue = $this->OutputStatus->CurrentValue;
		$this->LockStatus->CurrentValue = NULL;
		$this->LockStatus->OldValue = $this->LockStatus->CurrentValue;
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

		// Check field name 'OutcomeCode' first before field var 'x_OutcomeCode'
		$val = $CurrentForm->hasValue("OutcomeCode") ? $CurrentForm->getValue("OutcomeCode") : $CurrentForm->getValue("x_OutcomeCode");
		if (!$this->OutcomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeCode->setFormValue($val);
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

		// Check field name 'OutputType' first before field var 'x_OutputType'
		$val = $CurrentForm->hasValue("OutputType") ? $CurrentForm->getValue("OutputType") : $CurrentForm->getValue("x_OutputType");
		if (!$this->OutputType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputType->Visible = FALSE; // Disable update for API request
			else
				$this->OutputType->setFormValue($val);
		}

		// Check field name 'OutputName' first before field var 'x_OutputName'
		$val = $CurrentForm->hasValue("OutputName") ? $CurrentForm->getValue("OutputName") : $CurrentForm->getValue("x_OutputName");
		if (!$this->OutputName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputName->Visible = FALSE; // Disable update for API request
			else
				$this->OutputName->setFormValue($val);
		}

		// Check field name 'DeliveryDate' first before field var 'x_DeliveryDate'
		$val = $CurrentForm->hasValue("DeliveryDate") ? $CurrentForm->getValue("DeliveryDate") : $CurrentForm->getValue("x_DeliveryDate");
		if (!$this->DeliveryDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeliveryDate->Visible = FALSE; // Disable update for API request
			else
				$this->DeliveryDate->setFormValue($val);
			$this->DeliveryDate->CurrentValue = UnFormatDateTime($this->DeliveryDate->CurrentValue, 0);
		}

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}

		// Check field name 'OutputDescription' first before field var 'x_OutputDescription'
		$val = $CurrentForm->hasValue("OutputDescription") ? $CurrentForm->getValue("OutputDescription") : $CurrentForm->getValue("x_OutputDescription");
		if (!$this->OutputDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputDescription->Visible = FALSE; // Disable update for API request
			else
				$this->OutputDescription->setFormValue($val);
		}

		// Check field name 'OutputMeansOfVerification' first before field var 'x_OutputMeansOfVerification'
		$val = $CurrentForm->hasValue("OutputMeansOfVerification") ? $CurrentForm->getValue("OutputMeansOfVerification") : $CurrentForm->getValue("x_OutputMeansOfVerification");
		if (!$this->OutputMeansOfVerification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputMeansOfVerification->Visible = FALSE; // Disable update for API request
			else
				$this->OutputMeansOfVerification->setFormValue($val);
		}

		// Check field name 'ResponsibleOfficer' first before field var 'x_ResponsibleOfficer'
		$val = $CurrentForm->hasValue("ResponsibleOfficer") ? $CurrentForm->getValue("ResponsibleOfficer") : $CurrentForm->getValue("x_ResponsibleOfficer");
		if (!$this->ResponsibleOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ResponsibleOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->ResponsibleOfficer->setFormValue($val);
		}

		// Check field name 'Clients' first before field var 'x_Clients'
		$val = $CurrentForm->hasValue("Clients") ? $CurrentForm->getValue("Clients") : $CurrentForm->getValue("x_Clients");
		if (!$this->Clients->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Clients->Visible = FALSE; // Disable update for API request
			else
				$this->Clients->setFormValue($val);
		}

		// Check field name 'Beneficiaries' first before field var 'x_Beneficiaries'
		$val = $CurrentForm->hasValue("Beneficiaries") ? $CurrentForm->getValue("Beneficiaries") : $CurrentForm->getValue("x_Beneficiaries");
		if (!$this->Beneficiaries->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Beneficiaries->Visible = FALSE; // Disable update for API request
			else
				$this->Beneficiaries->setFormValue($val);
		}

		// Check field name 'OutputStatus' first before field var 'x_OutputStatus'
		$val = $CurrentForm->hasValue("OutputStatus") ? $CurrentForm->getValue("OutputStatus") : $CurrentForm->getValue("x_OutputStatus");
		if (!$this->OutputStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputStatus->Visible = FALSE; // Disable update for API request
			else
				$this->OutputStatus->setFormValue($val);
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

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		$this->OutputType->CurrentValue = $this->OutputType->FormValue;
		$this->OutputName->CurrentValue = $this->OutputName->FormValue;
		$this->DeliveryDate->CurrentValue = $this->DeliveryDate->FormValue;
		$this->DeliveryDate->CurrentValue = UnFormatDateTime($this->DeliveryDate->CurrentValue, 0);
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->OutputDescription->CurrentValue = $this->OutputDescription->FormValue;
		$this->OutputMeansOfVerification->CurrentValue = $this->OutputMeansOfVerification->FormValue;
		$this->ResponsibleOfficer->CurrentValue = $this->ResponsibleOfficer->FormValue;
		$this->Clients->CurrentValue = $this->Clients->FormValue;
		$this->Beneficiaries->CurrentValue = $this->Beneficiaries->FormValue;
		$this->OutputStatus->CurrentValue = $this->OutputStatus->FormValue;
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
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->OutputType->setDbValue($row['OutputType']);
		$this->OutputName->setDbValue($row['OutputName']);
		$this->DeliveryDate->setDbValue($row['DeliveryDate']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->OutputDescription->setDbValue($row['OutputDescription']);
		$this->OutputMeansOfVerification->setDbValue($row['OutputMeansOfVerification']);
		$this->ResponsibleOfficer->setDbValue($row['ResponsibleOfficer']);
		$this->Clients->setDbValue($row['Clients']);
		$this->Beneficiaries->setDbValue($row['Beneficiaries']);
		$this->OutputStatus->setDbValue($row['OutputStatus']);
		$this->LockStatus->setDbValue($row['LockStatus']);
		$this->TargetAmount->setDbValue($row['TargetAmount']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->PercentAchieved->setDbValue($row['PercentAchieved']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['OutcomeCode'] = $this->OutcomeCode->CurrentValue;
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['SubProgramCode'] = $this->SubProgramCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['OutputType'] = $this->OutputType->CurrentValue;
		$row['OutputName'] = $this->OutputName->CurrentValue;
		$row['DeliveryDate'] = $this->DeliveryDate->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['OutputDescription'] = $this->OutputDescription->CurrentValue;
		$row['OutputMeansOfVerification'] = $this->OutputMeansOfVerification->CurrentValue;
		$row['ResponsibleOfficer'] = $this->ResponsibleOfficer->CurrentValue;
		$row['Clients'] = $this->Clients->CurrentValue;
		$row['Beneficiaries'] = $this->Beneficiaries->CurrentValue;
		$row['OutputStatus'] = $this->OutputStatus->CurrentValue;
		$row['LockStatus'] = $this->LockStatus->CurrentValue;
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
		if (strval($this->getKey("OutputCode")) != "")
			$this->OutputCode->OldValue = $this->getKey("OutputCode"); // OutputCode
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
		// LACode
		// DepartmentCode
		// SectionCode
		// OutcomeCode
		// ProgramCode
		// SubProgramCode
		// OutputCode
		// OutputType
		// OutputName
		// DeliveryDate
		// FinancialYear
		// OutputDescription
		// OutputMeansOfVerification
		// ResponsibleOfficer
		// Clients
		// Beneficiaries
		// OutputStatus
		// LockStatus
		// TargetAmount
		// ActualAmount
		// PercentAchieved

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// OutputCode
			$arwrk = [];
			$arwrk[1] = $this->OutputName->CurrentValue;
			$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
			$this->OutputCode->ViewCustomAttributes = "";

			// OutputType
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

			// OutputName
			$this->OutputName->ViewValue = $this->OutputName->CurrentValue;
			$this->OutputName->ViewCustomAttributes = "";

			// DeliveryDate
			$this->DeliveryDate->ViewValue = $this->DeliveryDate->CurrentValue;
			$this->DeliveryDate->ViewValue = FormatDateTime($this->DeliveryDate->ViewValue, 0);
			$this->DeliveryDate->ViewCustomAttributes = "";

			// FinancialYear
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";

			// OutputDescription
			$this->OutputDescription->ViewValue = $this->OutputDescription->CurrentValue;
			$this->OutputDescription->ViewCustomAttributes = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->ViewValue = $this->OutputMeansOfVerification->CurrentValue;
			$this->OutputMeansOfVerification->ViewCustomAttributes = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->ViewValue = $this->ResponsibleOfficer->CurrentValue;
			$this->ResponsibleOfficer->ViewCustomAttributes = "";

			// Clients
			$this->Clients->ViewValue = $this->Clients->CurrentValue;
			$this->Clients->ViewCustomAttributes = "";

			// Beneficiaries
			$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
			$this->Beneficiaries->ViewCustomAttributes = "";

			// OutputStatus
			$curVal = strval($this->OutputStatus->CurrentValue);
			if ($curVal != "") {
				$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
				if ($this->OutputStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputStatus->ViewValue = $this->OutputStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputStatus->ViewValue = $this->OutputStatus->CurrentValue;
					}
				}
			} else {
				$this->OutputStatus->ViewValue = NULL;
			}
			$this->OutputStatus->ViewCustomAttributes = "";

			// LockStatus
			$curVal = strval($this->LockStatus->CurrentValue);
			if ($curVal != "") {
				$this->LockStatus->ViewValue = $this->LockStatus->lookupCacheOption($curVal);
				if ($this->LockStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->LockStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LockStatus->ViewValue = $this->LockStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LockStatus->ViewValue = $this->LockStatus->CurrentValue;
					}
				}
			} else {
				$this->LockStatus->ViewValue = NULL;
			}
			$this->LockStatus->ViewCustomAttributes = "";

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
			$this->PercentAchieved->ViewValue = FormatNumber($this->PercentAchieved->ViewValue, 2, -2, -2, -2);
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

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";
			$this->OutputType->TooltipValue = "";

			// OutputName
			$this->OutputName->LinkCustomAttributes = "";
			$this->OutputName->HrefValue = "";
			$this->OutputName->TooltipValue = "";

			// DeliveryDate
			$this->DeliveryDate->LinkCustomAttributes = "";
			$this->DeliveryDate->HrefValue = "";
			$this->DeliveryDate->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// OutputDescription
			$this->OutputDescription->LinkCustomAttributes = "";
			$this->OutputDescription->HrefValue = "";
			$this->OutputDescription->TooltipValue = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->LinkCustomAttributes = "";
			$this->OutputMeansOfVerification->HrefValue = "";
			$this->OutputMeansOfVerification->TooltipValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";
			$this->ResponsibleOfficer->TooltipValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";
			$this->Clients->TooltipValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";
			$this->Beneficiaries->TooltipValue = "";

			// OutputStatus
			$this->OutputStatus->LinkCustomAttributes = "";
			$this->OutputStatus->HrefValue = "";
			$this->OutputStatus->TooltipValue = "";

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
					if ($this->DepartmentCode->ViewValue == "")
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					} else {
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
				if ($this->SectionCode->ViewValue == "")
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
				} else {
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

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
			$this->SubProgramCode->EditCustomAttributes = "";
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

			// OutputType
			$this->OutputType->EditAttrs["class"] = "form-control";
			$this->OutputType->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputType->CurrentValue));
			if ($curVal != "")
				$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
			else
				$this->OutputType->ViewValue = $this->OutputType->Lookup !== NULL && is_array($this->OutputType->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputType->ViewValue !== NULL) { // Load from cache
				$this->OutputType->EditValue = array_values($this->OutputType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutputType`" . SearchString("=", $this->OutputType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OutputType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputType->EditValue = $arwrk;
			}

			// OutputName
			$this->OutputName->EditAttrs["class"] = "form-control";
			$this->OutputName->EditCustomAttributes = "";
			$this->OutputName->EditValue = HtmlEncode($this->OutputName->CurrentValue);
			$this->OutputName->PlaceHolder = RemoveHtml($this->OutputName->caption());

			// DeliveryDate
			$this->DeliveryDate->EditAttrs["class"] = "form-control";
			$this->DeliveryDate->EditCustomAttributes = "";
			$this->DeliveryDate->EditValue = HtmlEncode(FormatDateTime($this->DeliveryDate->CurrentValue, 8));
			$this->DeliveryDate->PlaceHolder = RemoveHtml($this->DeliveryDate->caption());

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
			$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

			// OutputDescription
			$this->OutputDescription->EditAttrs["class"] = "form-control";
			$this->OutputDescription->EditCustomAttributes = "";
			$this->OutputDescription->EditValue = HtmlEncode($this->OutputDescription->CurrentValue);
			$this->OutputDescription->PlaceHolder = RemoveHtml($this->OutputDescription->caption());

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->EditAttrs["class"] = "form-control";
			$this->OutputMeansOfVerification->EditCustomAttributes = "";
			$this->OutputMeansOfVerification->EditValue = HtmlEncode($this->OutputMeansOfVerification->CurrentValue);
			$this->OutputMeansOfVerification->PlaceHolder = RemoveHtml($this->OutputMeansOfVerification->caption());

			// ResponsibleOfficer
			$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
			$this->ResponsibleOfficer->EditCustomAttributes = "";
			if (!$this->ResponsibleOfficer->Raw)
				$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->EditValue = HtmlEncode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

			// Clients
			$this->Clients->EditAttrs["class"] = "form-control";
			$this->Clients->EditCustomAttributes = "";
			$this->Clients->EditValue = HtmlEncode($this->Clients->CurrentValue);
			$this->Clients->PlaceHolder = RemoveHtml($this->Clients->caption());

			// Beneficiaries
			$this->Beneficiaries->EditAttrs["class"] = "form-control";
			$this->Beneficiaries->EditCustomAttributes = "";
			$this->Beneficiaries->EditValue = HtmlEncode($this->Beneficiaries->CurrentValue);
			$this->Beneficiaries->PlaceHolder = RemoveHtml($this->Beneficiaries->caption());

			// OutputStatus
			$this->OutputStatus->EditAttrs["class"] = "form-control";
			$this->OutputStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputStatus->CurrentValue));
			if ($curVal != "")
				$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
			else
				$this->OutputStatus->ViewValue = $this->OutputStatus->Lookup !== NULL && is_array($this->OutputStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputStatus->ViewValue !== NULL) { // Load from cache
				$this->OutputStatus->EditValue = array_values($this->OutputStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->OutputStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutputStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputStatus->EditValue = $arwrk;
			}

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
				$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -2, -2, -2);
			

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

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";

			// OutputName
			$this->OutputName->LinkCustomAttributes = "";
			$this->OutputName->HrefValue = "";

			// DeliveryDate
			$this->DeliveryDate->LinkCustomAttributes = "";
			$this->DeliveryDate->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// OutputDescription
			$this->OutputDescription->LinkCustomAttributes = "";
			$this->OutputDescription->HrefValue = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->LinkCustomAttributes = "";
			$this->OutputMeansOfVerification->HrefValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// OutputStatus
			$this->OutputStatus->LinkCustomAttributes = "";
			$this->OutputStatus->HrefValue = "";

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
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
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
		if ($this->OutputType->Required) {
			if (!$this->OutputType->IsDetailKey && $this->OutputType->FormValue != NULL && $this->OutputType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputType->caption(), $this->OutputType->RequiredErrorMessage));
			}
		}
		if ($this->OutputName->Required) {
			if (!$this->OutputName->IsDetailKey && $this->OutputName->FormValue != NULL && $this->OutputName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputName->caption(), $this->OutputName->RequiredErrorMessage));
			}
		}
		if ($this->DeliveryDate->Required) {
			if (!$this->DeliveryDate->IsDetailKey && $this->DeliveryDate->FormValue != NULL && $this->DeliveryDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeliveryDate->caption(), $this->DeliveryDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DeliveryDate->FormValue)) {
			AddMessage($FormError, $this->DeliveryDate->errorMessage());
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FinancialYear->FormValue)) {
			AddMessage($FormError, $this->FinancialYear->errorMessage());
		}
		if ($this->OutputDescription->Required) {
			if (!$this->OutputDescription->IsDetailKey && $this->OutputDescription->FormValue != NULL && $this->OutputDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputDescription->caption(), $this->OutputDescription->RequiredErrorMessage));
			}
		}
		if ($this->OutputMeansOfVerification->Required) {
			if (!$this->OutputMeansOfVerification->IsDetailKey && $this->OutputMeansOfVerification->FormValue != NULL && $this->OutputMeansOfVerification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputMeansOfVerification->caption(), $this->OutputMeansOfVerification->RequiredErrorMessage));
			}
		}
		if ($this->ResponsibleOfficer->Required) {
			if (!$this->ResponsibleOfficer->IsDetailKey && $this->ResponsibleOfficer->FormValue != NULL && $this->ResponsibleOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResponsibleOfficer->caption(), $this->ResponsibleOfficer->RequiredErrorMessage));
			}
		}
		if ($this->Clients->Required) {
			if (!$this->Clients->IsDetailKey && $this->Clients->FormValue != NULL && $this->Clients->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Clients->caption(), $this->Clients->RequiredErrorMessage));
			}
		}
		if ($this->Beneficiaries->Required) {
			if (!$this->Beneficiaries->IsDetailKey && $this->Beneficiaries->FormValue != NULL && $this->Beneficiaries->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Beneficiaries->caption(), $this->Beneficiaries->RequiredErrorMessage));
			}
		}
		if ($this->OutputStatus->Required) {
			if (!$this->OutputStatus->IsDetailKey && $this->OutputStatus->FormValue != NULL && $this->OutputStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputStatus->caption(), $this->OutputStatus->RequiredErrorMessage));
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("_action", $detailTblVar) && $GLOBALS["_action"]->DetailAdd) {
			if (!isset($GLOBALS["_action_grid"]))
				$GLOBALS["_action_grid"] = new _action_grid(); // Get detail page object
			$GLOBALS["_action_grid"]->validateGridForm();
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

		// Check referential integrity for master table 'output'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_outcome();
		if (strval($this->OutcomeCode->CurrentValue) != "") {
			$masterFilter = str_replace("@OutcomeCode@", AdjustSql($this->OutcomeCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->LACode->CurrentValue) != "") {
			$masterFilter = str_replace("@LACode@", AdjustSql($this->LACode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->DepartmentCode->CurrentValue) != "") {
			$masterFilter = str_replace("@DepartmentCode@", AdjustSql($this->DepartmentCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["outcome"]))
				$GLOBALS["outcome"] = new outcome();
			$rsmaster = $GLOBALS["outcome"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "outcome", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

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

		// OutcomeCode
		$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, FALSE);

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, NULL, FALSE);

		// SubProgramCode
		$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, FALSE);

		// OutputType
		$this->OutputType->setDbValueDef($rsnew, $this->OutputType->CurrentValue, NULL, FALSE);

		// OutputName
		$this->OutputName->setDbValueDef($rsnew, $this->OutputName->CurrentValue, "", FALSE);

		// DeliveryDate
		$this->DeliveryDate->setDbValueDef($rsnew, UnFormatDateTime($this->DeliveryDate->CurrentValue, 0), NULL, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, NULL, FALSE);

		// OutputDescription
		$this->OutputDescription->setDbValueDef($rsnew, $this->OutputDescription->CurrentValue, NULL, FALSE);

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification->setDbValueDef($rsnew, $this->OutputMeansOfVerification->CurrentValue, NULL, FALSE);

		// ResponsibleOfficer
		$this->ResponsibleOfficer->setDbValueDef($rsnew, $this->ResponsibleOfficer->CurrentValue, NULL, FALSE);

		// Clients
		$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, NULL, FALSE);

		// Beneficiaries
		$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, NULL, FALSE);

		// OutputStatus
		$this->OutputStatus->setDbValueDef($rsnew, $this->OutputStatus->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("_action", $detailTblVar) && $GLOBALS["_action"]->DetailAdd) {
				$GLOBALS["_action"]->LACode->setSessionValue($this->LACode->CurrentValue); // Set master key
				$GLOBALS["_action"]->DepartmentCode->setSessionValue($this->DepartmentCode->CurrentValue); // Set master key
				$GLOBALS["_action"]->OucomeCode->setSessionValue($this->OutcomeCode->CurrentValue); // Set master key
				$GLOBALS["_action"]->ProgramCode->setSessionValue($this->ProgramCode->CurrentValue); // Set master key
				$GLOBALS["_action"]->OutputCode->setSessionValue($this->OutputCode->CurrentValue); // Set master key
				$GLOBALS["_action"]->FinancialYear->setSessionValue($this->FinancialYear->CurrentValue); // Set master key
				if (!isset($GLOBALS["_action_grid"]))
					$GLOBALS["_action_grid"] = new _action_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "action"); // Load user level of detail table
				$addRow = $GLOBALS["_action_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["_action"]->LACode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["_action"]->DepartmentCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["_action"]->OucomeCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["_action"]->ProgramCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["_action"]->OutputCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["_action"]->FinancialYear->setSessionValue(""); // Clear master key if insert failed
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
			if ($masterTblVar == "outcome") {
				$validMaster = TRUE;
				if (($parm = Get("fk_OutcomeCode", Get("OutcomeCode"))) !== NULL) {
					$GLOBALS["outcome"]->OutcomeCode->setQueryStringValue($parm);
					$this->OutcomeCode->setQueryStringValue($GLOBALS["outcome"]->OutcomeCode->QueryStringValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["outcome"]->OutcomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["outcome"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["outcome"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["outcome"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["outcome"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["outcome"]->DepartmentCode->QueryStringValue))
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
			if ($masterTblVar == "outcome") {
				$validMaster = TRUE;
				if (($parm = Post("fk_OutcomeCode", Post("OutcomeCode"))) !== NULL) {
					$GLOBALS["outcome"]->OutcomeCode->setFormValue($parm);
					$this->OutcomeCode->setFormValue($GLOBALS["outcome"]->OutcomeCode->FormValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->FormValue);
					if (!is_numeric($GLOBALS["outcome"]->OutcomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["outcome"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["outcome"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["outcome"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["outcome"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["outcome"]->DepartmentCode->FormValue))
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
			if ($masterTblVar != "outcome") {
				if ($this->OutcomeCode->CurrentValue == "")
					$this->OutcomeCode->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
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
			if (in_array("_action", $detailTblVar)) {
				if (!isset($GLOBALS["_action_grid"]))
					$GLOBALS["_action_grid"] = new _action_grid();
				if ($GLOBALS["_action_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["_action_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["_action_grid"]->CurrentMode = "add";
					$GLOBALS["_action_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["_action_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["_action_grid"]->setStartRecordNumber(1);
					$GLOBALS["_action_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["_action_grid"]->LACode->setSessionValue($GLOBALS["_action_grid"]->LACode->CurrentValue);
					$GLOBALS["_action_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["_action_grid"]->DepartmentCode->setSessionValue($GLOBALS["_action_grid"]->DepartmentCode->CurrentValue);
					$GLOBALS["_action_grid"]->OucomeCode->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->OucomeCode->CurrentValue = $this->OutcomeCode->CurrentValue;
					$GLOBALS["_action_grid"]->OucomeCode->setSessionValue($GLOBALS["_action_grid"]->OucomeCode->CurrentValue);
					$GLOBALS["_action_grid"]->ProgramCode->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->ProgramCode->CurrentValue = $this->ProgramCode->CurrentValue;
					$GLOBALS["_action_grid"]->ProgramCode->setSessionValue($GLOBALS["_action_grid"]->ProgramCode->CurrentValue);
					$GLOBALS["_action_grid"]->OutputCode->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->OutputCode->CurrentValue = $this->OutputCode->CurrentValue;
					$GLOBALS["_action_grid"]->OutputCode->setSessionValue($GLOBALS["_action_grid"]->OutputCode->CurrentValue);
					$GLOBALS["_action_grid"]->FinancialYear->IsDetailKey = TRUE;
					$GLOBALS["_action_grid"]->FinancialYear->CurrentValue = $this->FinancialYear->CurrentValue;
					$GLOBALS["_action_grid"]->FinancialYear->setSessionValue($GLOBALS["_action_grid"]->FinancialYear->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("outputlist.php"), "", $this->TableVar, TRUE);
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
				case "x_OutcomeCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
					break;
				case "x_OutputCode":
					break;
				case "x_OutputType":
					break;
				case "x_OutputStatus":
					break;
				case "x_LockStatus":
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
						case "x_OutcomeCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
							break;
						case "x_OutputCode":
							break;
						case "x_OutputType":
							break;
						case "x_OutputStatus":
							break;
						case "x_LockStatus":
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