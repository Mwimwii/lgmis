<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class contract_add extends contract
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'contract';

	// Page object name
	public $PageObjName = "contract_add";

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

		// Table object (contract)
		if (!isset($GLOBALS["contract"]) || get_class($GLOBALS["contract"]) == PROJECT_NAMESPACE . "contract") {
			$GLOBALS["contract"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contract"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'contract');

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
		global $contract;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($contract);
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
					if ($pageName == "contractview.php")
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
			$key .= @$ar['ContractNo'];
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
	public $DetailPages; // Detail pages object

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
					$this->terminate(GetUrl("contractlist.php"));
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
		$this->ProjectCode->setVisibility();
		$this->ContractNo->setVisibility();
		$this->ContractName->setVisibility();
		$this->ContractType->setVisibility();
		$this->ContractSum->setVisibility();
		$this->RevisedContractSum->setVisibility();
		$this->ContractorRef->setVisibility();
		$this->SigningDate->setVisibility();
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEndDate->setVisibility();
		$this->Duration->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AdvancePaymentAmount->setVisibility();
		$this->AdvancePaymentdate->setVisibility();
		$this->ContractStatus->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

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
		$this->setupLookupOptions($this->ProjectCode);
		$this->setupLookupOptions($this->ContractType);
		$this->setupLookupOptions($this->ContractorRef);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->ContractStatus);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("contractlist.php");
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
			if (Get("ContractNo") !== NULL) {
				$this->ContractNo->setQueryStringValue(Get("ContractNo"));
				$this->setKey("ContractNo", $this->ContractNo->CurrentValue); // Set up key
			} else {
				$this->setKey("ContractNo", ""); // Clear key
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
					$this->terminate("contractlist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "contractlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "contractview.php")
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
		$this->ProjectCode->CurrentValue = NULL;
		$this->ProjectCode->OldValue = $this->ProjectCode->CurrentValue;
		$this->ContractNo->CurrentValue = NULL;
		$this->ContractNo->OldValue = $this->ContractNo->CurrentValue;
		$this->ContractName->CurrentValue = NULL;
		$this->ContractName->OldValue = $this->ContractName->CurrentValue;
		$this->ContractType->CurrentValue = NULL;
		$this->ContractType->OldValue = $this->ContractType->CurrentValue;
		$this->ContractSum->CurrentValue = NULL;
		$this->ContractSum->OldValue = $this->ContractSum->CurrentValue;
		$this->RevisedContractSum->CurrentValue = NULL;
		$this->RevisedContractSum->OldValue = $this->RevisedContractSum->CurrentValue;
		$this->ContractorRef->CurrentValue = NULL;
		$this->ContractorRef->OldValue = $this->ContractorRef->CurrentValue;
		$this->SigningDate->CurrentValue = NULL;
		$this->SigningDate->OldValue = $this->SigningDate->CurrentValue;
		$this->PlannedStartDate->CurrentValue = NULL;
		$this->PlannedStartDate->OldValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedEndDate->CurrentValue = NULL;
		$this->PlannedEndDate->OldValue = $this->PlannedEndDate->CurrentValue;
		$this->ActualStartDate->CurrentValue = NULL;
		$this->ActualStartDate->OldValue = $this->ActualStartDate->CurrentValue;
		$this->ActualEndDate->CurrentValue = NULL;
		$this->ActualEndDate->OldValue = $this->ActualEndDate->CurrentValue;
		$this->Duration->CurrentValue = NULL;
		$this->Duration->OldValue = $this->Duration->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->AdvancePaymentAmount->CurrentValue = NULL;
		$this->AdvancePaymentAmount->OldValue = $this->AdvancePaymentAmount->CurrentValue;
		$this->AdvancePaymentdate->CurrentValue = NULL;
		$this->AdvancePaymentdate->OldValue = $this->AdvancePaymentdate->CurrentValue;
		$this->ContractStatus->CurrentValue = NULL;
		$this->ContractStatus->OldValue = $this->ContractStatus->CurrentValue;
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

		// Check field name 'ProjectCode' first before field var 'x_ProjectCode'
		$val = $CurrentForm->hasValue("ProjectCode") ? $CurrentForm->getValue("ProjectCode") : $CurrentForm->getValue("x_ProjectCode");
		if (!$this->ProjectCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectCode->setFormValue($val);
		}

		// Check field name 'ContractNo' first before field var 'x_ContractNo'
		$val = $CurrentForm->hasValue("ContractNo") ? $CurrentForm->getValue("ContractNo") : $CurrentForm->getValue("x_ContractNo");
		if (!$this->ContractNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractNo->Visible = FALSE; // Disable update for API request
			else
				$this->ContractNo->setFormValue($val);
		}

		// Check field name 'ContractName' first before field var 'x_ContractName'
		$val = $CurrentForm->hasValue("ContractName") ? $CurrentForm->getValue("ContractName") : $CurrentForm->getValue("x_ContractName");
		if (!$this->ContractName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractName->Visible = FALSE; // Disable update for API request
			else
				$this->ContractName->setFormValue($val);
		}

		// Check field name 'ContractType' first before field var 'x_ContractType'
		$val = $CurrentForm->hasValue("ContractType") ? $CurrentForm->getValue("ContractType") : $CurrentForm->getValue("x_ContractType");
		if (!$this->ContractType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractType->Visible = FALSE; // Disable update for API request
			else
				$this->ContractType->setFormValue($val);
		}

		// Check field name 'ContractSum' first before field var 'x_ContractSum'
		$val = $CurrentForm->hasValue("ContractSum") ? $CurrentForm->getValue("ContractSum") : $CurrentForm->getValue("x_ContractSum");
		if (!$this->ContractSum->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractSum->Visible = FALSE; // Disable update for API request
			else
				$this->ContractSum->setFormValue($val);
		}

		// Check field name 'RevisedContractSum' first before field var 'x_RevisedContractSum'
		$val = $CurrentForm->hasValue("RevisedContractSum") ? $CurrentForm->getValue("RevisedContractSum") : $CurrentForm->getValue("x_RevisedContractSum");
		if (!$this->RevisedContractSum->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RevisedContractSum->Visible = FALSE; // Disable update for API request
			else
				$this->RevisedContractSum->setFormValue($val);
		}

		// Check field name 'ContractorRef' first before field var 'x_ContractorRef'
		$val = $CurrentForm->hasValue("ContractorRef") ? $CurrentForm->getValue("ContractorRef") : $CurrentForm->getValue("x_ContractorRef");
		if (!$this->ContractorRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractorRef->Visible = FALSE; // Disable update for API request
			else
				$this->ContractorRef->setFormValue($val);
		}

		// Check field name 'SigningDate' first before field var 'x_SigningDate'
		$val = $CurrentForm->hasValue("SigningDate") ? $CurrentForm->getValue("SigningDate") : $CurrentForm->getValue("x_SigningDate");
		if (!$this->SigningDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SigningDate->Visible = FALSE; // Disable update for API request
			else
				$this->SigningDate->setFormValue($val);
			$this->SigningDate->CurrentValue = UnFormatDateTime($this->SigningDate->CurrentValue, 0);
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

		// Check field name 'Duration' first before field var 'x_Duration'
		$val = $CurrentForm->hasValue("Duration") ? $CurrentForm->getValue("Duration") : $CurrentForm->getValue("x_Duration");
		if (!$this->Duration->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Duration->Visible = FALSE; // Disable update for API request
			else
				$this->Duration->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'AdvancePaymentAmount' first before field var 'x_AdvancePaymentAmount'
		$val = $CurrentForm->hasValue("AdvancePaymentAmount") ? $CurrentForm->getValue("AdvancePaymentAmount") : $CurrentForm->getValue("x_AdvancePaymentAmount");
		if (!$this->AdvancePaymentAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AdvancePaymentAmount->Visible = FALSE; // Disable update for API request
			else
				$this->AdvancePaymentAmount->setFormValue($val);
		}

		// Check field name 'AdvancePaymentdate' first before field var 'x_AdvancePaymentdate'
		$val = $CurrentForm->hasValue("AdvancePaymentdate") ? $CurrentForm->getValue("AdvancePaymentdate") : $CurrentForm->getValue("x_AdvancePaymentdate");
		if (!$this->AdvancePaymentdate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AdvancePaymentdate->Visible = FALSE; // Disable update for API request
			else
				$this->AdvancePaymentdate->setFormValue($val);
			$this->AdvancePaymentdate->CurrentValue = UnFormatDateTime($this->AdvancePaymentdate->CurrentValue, 0);
		}

		// Check field name 'ContractStatus' first before field var 'x_ContractStatus'
		$val = $CurrentForm->hasValue("ContractStatus") ? $CurrentForm->getValue("ContractStatus") : $CurrentForm->getValue("x_ContractStatus");
		if (!$this->ContractStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractStatus->Visible = FALSE; // Disable update for API request
			else
				$this->ContractStatus->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->ProjectCode->CurrentValue = $this->ProjectCode->FormValue;
		$this->ContractNo->CurrentValue = $this->ContractNo->FormValue;
		$this->ContractName->CurrentValue = $this->ContractName->FormValue;
		$this->ContractType->CurrentValue = $this->ContractType->FormValue;
		$this->ContractSum->CurrentValue = $this->ContractSum->FormValue;
		$this->RevisedContractSum->CurrentValue = $this->RevisedContractSum->FormValue;
		$this->ContractorRef->CurrentValue = $this->ContractorRef->FormValue;
		$this->SigningDate->CurrentValue = $this->SigningDate->FormValue;
		$this->SigningDate->CurrentValue = UnFormatDateTime($this->SigningDate->CurrentValue, 0);
		$this->PlannedStartDate->CurrentValue = $this->PlannedStartDate->FormValue;
		$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		$this->PlannedEndDate->CurrentValue = $this->PlannedEndDate->FormValue;
		$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
		$this->ActualStartDate->CurrentValue = $this->ActualStartDate->FormValue;
		$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		$this->ActualEndDate->CurrentValue = $this->ActualEndDate->FormValue;
		$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		$this->Duration->CurrentValue = $this->Duration->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AdvancePaymentAmount->CurrentValue = $this->AdvancePaymentAmount->FormValue;
		$this->AdvancePaymentdate->CurrentValue = $this->AdvancePaymentdate->FormValue;
		$this->AdvancePaymentdate->CurrentValue = UnFormatDateTime($this->AdvancePaymentdate->CurrentValue, 0);
		$this->ContractStatus->CurrentValue = $this->ContractStatus->FormValue;
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
		$this->ProjectCode->setDbValue($row['ProjectCode']);
		$this->ContractNo->setDbValue($row['ContractNo']);
		$this->ContractName->setDbValue($row['ContractName']);
		$this->ContractType->setDbValue($row['ContractType']);
		$this->ContractSum->setDbValue($row['ContractSum']);
		$this->RevisedContractSum->setDbValue($row['RevisedContractSum']);
		$this->ContractorRef->setDbValue($row['ContractorRef']);
		$this->SigningDate->setDbValue($row['SigningDate']);
		$this->PlannedStartDate->setDbValue($row['PlannedStartDate']);
		$this->PlannedEndDate->setDbValue($row['PlannedEndDate']);
		$this->ActualStartDate->setDbValue($row['ActualStartDate']);
		$this->ActualEndDate->setDbValue($row['ActualEndDate']);
		$this->Duration->setDbValue($row['Duration']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AdvancePaymentAmount->setDbValue($row['AdvancePaymentAmount']);
		$this->AdvancePaymentdate->setDbValue($row['AdvancePaymentdate']);
		$this->ContractStatus->setDbValue($row['ContractStatus']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ProjectCode'] = $this->ProjectCode->CurrentValue;
		$row['ContractNo'] = $this->ContractNo->CurrentValue;
		$row['ContractName'] = $this->ContractName->CurrentValue;
		$row['ContractType'] = $this->ContractType->CurrentValue;
		$row['ContractSum'] = $this->ContractSum->CurrentValue;
		$row['RevisedContractSum'] = $this->RevisedContractSum->CurrentValue;
		$row['ContractorRef'] = $this->ContractorRef->CurrentValue;
		$row['SigningDate'] = $this->SigningDate->CurrentValue;
		$row['PlannedStartDate'] = $this->PlannedStartDate->CurrentValue;
		$row['PlannedEndDate'] = $this->PlannedEndDate->CurrentValue;
		$row['ActualStartDate'] = $this->ActualStartDate->CurrentValue;
		$row['ActualEndDate'] = $this->ActualEndDate->CurrentValue;
		$row['Duration'] = $this->Duration->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AdvancePaymentAmount'] = $this->AdvancePaymentAmount->CurrentValue;
		$row['AdvancePaymentdate'] = $this->AdvancePaymentdate->CurrentValue;
		$row['ContractStatus'] = $this->ContractStatus->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ContractNo")) != "")
			$this->ContractNo->OldValue = $this->getKey("ContractNo"); // ContractNo
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

		if ($this->ContractSum->FormValue == $this->ContractSum->CurrentValue && is_numeric(ConvertToFloatString($this->ContractSum->CurrentValue)))
			$this->ContractSum->CurrentValue = ConvertToFloatString($this->ContractSum->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RevisedContractSum->FormValue == $this->RevisedContractSum->CurrentValue && is_numeric(ConvertToFloatString($this->RevisedContractSum->CurrentValue)))
			$this->RevisedContractSum->CurrentValue = ConvertToFloatString($this->RevisedContractSum->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Duration->FormValue == $this->Duration->CurrentValue && is_numeric(ConvertToFloatString($this->Duration->CurrentValue)))
			$this->Duration->CurrentValue = ConvertToFloatString($this->Duration->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AdvancePaymentAmount->FormValue == $this->AdvancePaymentAmount->CurrentValue && is_numeric(ConvertToFloatString($this->AdvancePaymentAmount->CurrentValue)))
			$this->AdvancePaymentAmount->CurrentValue = ConvertToFloatString($this->AdvancePaymentAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LACode
		// DepartmentCode
		// SectionCode
		// ProjectCode
		// ContractNo
		// ContractName
		// ContractType
		// ContractSum
		// RevisedContractSum
		// ContractorRef
		// SigningDate
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Duration
		// UnitOfMeasure
		// AdvancePaymentAmount
		// AdvancePaymentdate
		// ContractStatus

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
			$curVal = strval($this->ProjectCode->CurrentValue);
			if ($curVal != "") {
				$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
					}
				}
			} else {
				$this->ProjectCode->ViewValue = NULL;
			}
			$this->ProjectCode->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";

			// ContractName
			$this->ContractName->ViewValue = $this->ContractName->CurrentValue;
			$this->ContractName->ViewCustomAttributes = "";

			// ContractType
			$curVal = strval($this->ContractType->CurrentValue);
			if ($curVal != "") {
				$this->ContractType->ViewValue = $this->ContractType->lookupCacheOption($curVal);
				if ($this->ContractType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractType->ViewValue = $this->ContractType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
					}
				}
			} else {
				$this->ContractType->ViewValue = NULL;
			}
			$this->ContractType->ViewCustomAttributes = "";

			// ContractSum
			$this->ContractSum->ViewValue = $this->ContractSum->CurrentValue;
			$this->ContractSum->ViewValue = FormatNumber($this->ContractSum->ViewValue, 2, -2, -2, -2);
			$this->ContractSum->CellCssStyle .= "text-align: right;";
			$this->ContractSum->ViewCustomAttributes = "";

			// RevisedContractSum
			$this->RevisedContractSum->ViewValue = $this->RevisedContractSum->CurrentValue;
			$this->RevisedContractSum->ViewValue = FormatNumber($this->RevisedContractSum->ViewValue, 2, -2, -2, -2);
			$this->RevisedContractSum->CellCssStyle .= "text-align: right;";
			$this->RevisedContractSum->ViewCustomAttributes = "";

			// ContractorRef
			$curVal = strval($this->ContractorRef->CurrentValue);
			if ($curVal != "") {
				$this->ContractorRef->ViewValue = $this->ContractorRef->lookupCacheOption($curVal);
				if ($this->ContractorRef->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractorRef`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractorRef->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractorRef->ViewValue = $this->ContractorRef->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractorRef->ViewValue = $this->ContractorRef->CurrentValue;
					}
				}
			} else {
				$this->ContractorRef->ViewValue = NULL;
			}
			$this->ContractorRef->ViewCustomAttributes = "";

			// SigningDate
			$this->SigningDate->ViewValue = $this->SigningDate->CurrentValue;
			$this->SigningDate->ViewValue = FormatDateTime($this->SigningDate->ViewValue, 0);
			$this->SigningDate->ViewCustomAttributes = "";

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

			// Duration
			$this->Duration->ViewValue = $this->Duration->CurrentValue;
			$this->Duration->ViewValue = FormatNumber($this->Duration->ViewValue, 2, -2, -2, -2);
			$this->Duration->ViewCustomAttributes = "";

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

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->ViewValue = $this->AdvancePaymentAmount->CurrentValue;
			$this->AdvancePaymentAmount->ViewValue = FormatNumber($this->AdvancePaymentAmount->ViewValue, 2, -2, -2, -2);
			$this->AdvancePaymentAmount->CellCssStyle .= "text-align: right;";
			$this->AdvancePaymentAmount->ViewCustomAttributes = "";

			// AdvancePaymentdate
			$this->AdvancePaymentdate->ViewValue = $this->AdvancePaymentdate->CurrentValue;
			$this->AdvancePaymentdate->ViewValue = FormatDateTime($this->AdvancePaymentdate->ViewValue, 0);
			$this->AdvancePaymentdate->ViewCustomAttributes = "";

			// ContractStatus
			$curVal = strval($this->ContractStatus->CurrentValue);
			if ($curVal != "") {
				$this->ContractStatus->ViewValue = $this->ContractStatus->lookupCacheOption($curVal);
				if ($this->ContractStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractStatus->ViewValue = $this->ContractStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractStatus->ViewValue = $this->ContractStatus->CurrentValue;
					}
				}
			} else {
				$this->ContractStatus->ViewValue = NULL;
			}
			$this->ContractStatus->ViewCustomAttributes = "";

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

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";
			$this->ContractNo->TooltipValue = "";

			// ContractName
			$this->ContractName->LinkCustomAttributes = "";
			$this->ContractName->HrefValue = "";
			$this->ContractName->TooltipValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
			$this->ContractType->TooltipValue = "";

			// ContractSum
			$this->ContractSum->LinkCustomAttributes = "";
			$this->ContractSum->HrefValue = "";
			$this->ContractSum->TooltipValue = "";

			// RevisedContractSum
			$this->RevisedContractSum->LinkCustomAttributes = "";
			$this->RevisedContractSum->HrefValue = "";
			$this->RevisedContractSum->TooltipValue = "";

			// ContractorRef
			$this->ContractorRef->LinkCustomAttributes = "";
			$this->ContractorRef->HrefValue = "";
			$this->ContractorRef->TooltipValue = "";

			// SigningDate
			$this->SigningDate->LinkCustomAttributes = "";
			$this->SigningDate->HrefValue = "";
			$this->SigningDate->TooltipValue = "";

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

			// Duration
			$this->Duration->LinkCustomAttributes = "";
			$this->Duration->HrefValue = "";
			$this->Duration->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->LinkCustomAttributes = "";
			$this->AdvancePaymentAmount->HrefValue = "";
			$this->AdvancePaymentAmount->TooltipValue = "";

			// AdvancePaymentdate
			$this->AdvancePaymentdate->LinkCustomAttributes = "";
			$this->AdvancePaymentdate->HrefValue = "";
			$this->AdvancePaymentdate->TooltipValue = "";

			// ContractStatus
			$this->ContractStatus->LinkCustomAttributes = "";
			$this->ContractStatus->HrefValue = "";
			$this->ContractStatus->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LACode
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->CurrentValue));
			if ($curVal != "")
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				if ($this->LACode->ViewValue == "")
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
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
			$curVal = strval($this->ProjectCode->CurrentValue);
			if ($curVal != "") {
				$this->ProjectCode->EditValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProjectCode->EditValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
					}
				}
			} else {
				$this->ProjectCode->EditValue = NULL;
			}
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

			// ContractNo
			$this->ContractNo->EditAttrs["class"] = "form-control";
			$this->ContractNo->EditCustomAttributes = "";
			if (!$this->ContractNo->Raw)
				$this->ContractNo->CurrentValue = HtmlDecode($this->ContractNo->CurrentValue);
			$this->ContractNo->EditValue = HtmlEncode($this->ContractNo->CurrentValue);
			$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());

			// ContractName
			$this->ContractName->EditAttrs["class"] = "form-control";
			$this->ContractName->EditCustomAttributes = "";
			if (!$this->ContractName->Raw)
				$this->ContractName->CurrentValue = HtmlDecode($this->ContractName->CurrentValue);
			$this->ContractName->EditValue = HtmlEncode($this->ContractName->CurrentValue);
			$this->ContractName->PlaceHolder = RemoveHtml($this->ContractName->caption());

			// ContractType
			$this->ContractType->EditAttrs["class"] = "form-control";
			$this->ContractType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractType->CurrentValue));
			if ($curVal != "")
				$this->ContractType->ViewValue = $this->ContractType->lookupCacheOption($curVal);
			else
				$this->ContractType->ViewValue = $this->ContractType->Lookup !== NULL && is_array($this->ContractType->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractType->ViewValue !== NULL) { // Load from cache
				$this->ContractType->EditValue = array_values($this->ContractType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractType`" . SearchString("=", $this->ContractType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractType->EditValue = $arwrk;
			}

			// ContractSum
			$this->ContractSum->EditAttrs["class"] = "form-control";
			$this->ContractSum->EditCustomAttributes = "";
			$this->ContractSum->EditValue = HtmlEncode($this->ContractSum->CurrentValue);
			$this->ContractSum->PlaceHolder = RemoveHtml($this->ContractSum->caption());
			if (strval($this->ContractSum->EditValue) != "" && is_numeric($this->ContractSum->EditValue))
				$this->ContractSum->EditValue = FormatNumber($this->ContractSum->EditValue, -2, -2, -2, -2);
			

			// RevisedContractSum
			$this->RevisedContractSum->EditAttrs["class"] = "form-control";
			$this->RevisedContractSum->EditCustomAttributes = "";
			$this->RevisedContractSum->EditValue = HtmlEncode($this->RevisedContractSum->CurrentValue);
			$this->RevisedContractSum->PlaceHolder = RemoveHtml($this->RevisedContractSum->caption());
			if (strval($this->RevisedContractSum->EditValue) != "" && is_numeric($this->RevisedContractSum->EditValue))
				$this->RevisedContractSum->EditValue = FormatNumber($this->RevisedContractSum->EditValue, -2, -2, -2, -2);
			

			// ContractorRef
			$this->ContractorRef->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractorRef->CurrentValue));
			if ($curVal != "")
				$this->ContractorRef->ViewValue = $this->ContractorRef->lookupCacheOption($curVal);
			else
				$this->ContractorRef->ViewValue = $this->ContractorRef->Lookup !== NULL && is_array($this->ContractorRef->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractorRef->ViewValue !== NULL) { // Load from cache
				$this->ContractorRef->EditValue = array_values($this->ContractorRef->Lookup->Options);
				if ($this->ContractorRef->ViewValue == "")
					$this->ContractorRef->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractorRef`" . SearchString("=", $this->ContractorRef->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractorRef->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ContractorRef->ViewValue = $this->ContractorRef->displayValue($arwrk);
				} else {
					$this->ContractorRef->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractorRef->EditValue = $arwrk;
			}

			// SigningDate
			$this->SigningDate->EditAttrs["class"] = "form-control";
			$this->SigningDate->EditCustomAttributes = "";
			$this->SigningDate->EditValue = HtmlEncode(FormatDateTime($this->SigningDate->CurrentValue, 8));
			$this->SigningDate->PlaceHolder = RemoveHtml($this->SigningDate->caption());

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

			// Duration
			$this->Duration->EditAttrs["class"] = "form-control";
			$this->Duration->EditCustomAttributes = "";
			$this->Duration->EditValue = HtmlEncode($this->Duration->CurrentValue);
			$this->Duration->PlaceHolder = RemoveHtml($this->Duration->caption());
			if (strval($this->Duration->EditValue) != "" && is_numeric($this->Duration->EditValue))
				$this->Duration->EditValue = FormatNumber($this->Duration->EditValue, -2, -2, -2, -2);
			

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

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentAmount->EditCustomAttributes = "";
			$this->AdvancePaymentAmount->EditValue = HtmlEncode($this->AdvancePaymentAmount->CurrentValue);
			$this->AdvancePaymentAmount->PlaceHolder = RemoveHtml($this->AdvancePaymentAmount->caption());
			if (strval($this->AdvancePaymentAmount->EditValue) != "" && is_numeric($this->AdvancePaymentAmount->EditValue))
				$this->AdvancePaymentAmount->EditValue = FormatNumber($this->AdvancePaymentAmount->EditValue, -2, -2, -2, -2);
			

			// AdvancePaymentdate
			$this->AdvancePaymentdate->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentdate->EditCustomAttributes = "";
			$this->AdvancePaymentdate->EditValue = HtmlEncode(FormatDateTime($this->AdvancePaymentdate->CurrentValue, 8));
			$this->AdvancePaymentdate->PlaceHolder = RemoveHtml($this->AdvancePaymentdate->caption());

			// ContractStatus
			$this->ContractStatus->EditAttrs["class"] = "form-control";
			$this->ContractStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractStatus->CurrentValue));
			if ($curVal != "")
				$this->ContractStatus->ViewValue = $this->ContractStatus->lookupCacheOption($curVal);
			else
				$this->ContractStatus->ViewValue = $this->ContractStatus->Lookup !== NULL && is_array($this->ContractStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractStatus->ViewValue !== NULL) { // Load from cache
				$this->ContractStatus->EditValue = array_values($this->ContractStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractStatus`" . SearchString("=", $this->ContractStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractStatus->EditValue = $arwrk;
			}

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

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";

			// ContractName
			$this->ContractName->LinkCustomAttributes = "";
			$this->ContractName->HrefValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";

			// ContractSum
			$this->ContractSum->LinkCustomAttributes = "";
			$this->ContractSum->HrefValue = "";

			// RevisedContractSum
			$this->RevisedContractSum->LinkCustomAttributes = "";
			$this->RevisedContractSum->HrefValue = "";

			// ContractorRef
			$this->ContractorRef->LinkCustomAttributes = "";
			$this->ContractorRef->HrefValue = "";

			// SigningDate
			$this->SigningDate->LinkCustomAttributes = "";
			$this->SigningDate->HrefValue = "";

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

			// Duration
			$this->Duration->LinkCustomAttributes = "";
			$this->Duration->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->LinkCustomAttributes = "";
			$this->AdvancePaymentAmount->HrefValue = "";

			// AdvancePaymentdate
			$this->AdvancePaymentdate->LinkCustomAttributes = "";
			$this->AdvancePaymentdate->HrefValue = "";

			// ContractStatus
			$this->ContractStatus->LinkCustomAttributes = "";
			$this->ContractStatus->HrefValue = "";
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
		if ($this->ProjectCode->Required) {
			if (!$this->ProjectCode->IsDetailKey && $this->ProjectCode->FormValue != NULL && $this->ProjectCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectCode->caption(), $this->ProjectCode->RequiredErrorMessage));
			}
		}
		if ($this->ContractNo->Required) {
			if (!$this->ContractNo->IsDetailKey && $this->ContractNo->FormValue != NULL && $this->ContractNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractNo->caption(), $this->ContractNo->RequiredErrorMessage));
			}
		}
		if ($this->ContractName->Required) {
			if (!$this->ContractName->IsDetailKey && $this->ContractName->FormValue != NULL && $this->ContractName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractName->caption(), $this->ContractName->RequiredErrorMessage));
			}
		}
		if ($this->ContractType->Required) {
			if (!$this->ContractType->IsDetailKey && $this->ContractType->FormValue != NULL && $this->ContractType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractType->caption(), $this->ContractType->RequiredErrorMessage));
			}
		}
		if ($this->ContractSum->Required) {
			if (!$this->ContractSum->IsDetailKey && $this->ContractSum->FormValue != NULL && $this->ContractSum->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractSum->caption(), $this->ContractSum->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ContractSum->FormValue)) {
			AddMessage($FormError, $this->ContractSum->errorMessage());
		}
		if ($this->RevisedContractSum->Required) {
			if (!$this->RevisedContractSum->IsDetailKey && $this->RevisedContractSum->FormValue != NULL && $this->RevisedContractSum->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RevisedContractSum->caption(), $this->RevisedContractSum->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->RevisedContractSum->FormValue)) {
			AddMessage($FormError, $this->RevisedContractSum->errorMessage());
		}
		if ($this->ContractorRef->Required) {
			if (!$this->ContractorRef->IsDetailKey && $this->ContractorRef->FormValue != NULL && $this->ContractorRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractorRef->caption(), $this->ContractorRef->RequiredErrorMessage));
			}
		}
		if ($this->SigningDate->Required) {
			if (!$this->SigningDate->IsDetailKey && $this->SigningDate->FormValue != NULL && $this->SigningDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SigningDate->caption(), $this->SigningDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->SigningDate->FormValue)) {
			AddMessage($FormError, $this->SigningDate->errorMessage());
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
		if ($this->Duration->Required) {
			if (!$this->Duration->IsDetailKey && $this->Duration->FormValue != NULL && $this->Duration->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Duration->caption(), $this->Duration->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Duration->FormValue)) {
			AddMessage($FormError, $this->Duration->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AdvancePaymentAmount->Required) {
			if (!$this->AdvancePaymentAmount->IsDetailKey && $this->AdvancePaymentAmount->FormValue != NULL && $this->AdvancePaymentAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AdvancePaymentAmount->caption(), $this->AdvancePaymentAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AdvancePaymentAmount->FormValue)) {
			AddMessage($FormError, $this->AdvancePaymentAmount->errorMessage());
		}
		if ($this->AdvancePaymentdate->Required) {
			if (!$this->AdvancePaymentdate->IsDetailKey && $this->AdvancePaymentdate->FormValue != NULL && $this->AdvancePaymentdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AdvancePaymentdate->caption(), $this->AdvancePaymentdate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->AdvancePaymentdate->FormValue)) {
			AddMessage($FormError, $this->AdvancePaymentdate->errorMessage());
		}
		if ($this->ContractStatus->Required) {
			if (!$this->ContractStatus->IsDetailKey && $this->ContractStatus->FormValue != NULL && $this->ContractStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractStatus->caption(), $this->ContractStatus->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("contract_variation", $detailTblVar) && $GLOBALS["contract_variation"]->DetailAdd) {
			if (!isset($GLOBALS["contract_variation_grid"]))
				$GLOBALS["contract_variation_grid"] = new contract_variation_grid(); // Get detail page object
			$GLOBALS["contract_variation_grid"]->validateGridForm();
		}
		if (in_array("ipc_tracking", $detailTblVar) && $GLOBALS["ipc_tracking"]->DetailAdd) {
			if (!isset($GLOBALS["ipc_tracking_grid"]))
				$GLOBALS["ipc_tracking_grid"] = new ipc_tracking_grid(); // Get detail page object
			$GLOBALS["ipc_tracking_grid"]->validateGridForm();
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

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// ProjectCode
		$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, NULL, FALSE);

		// ContractNo
		$this->ContractNo->setDbValueDef($rsnew, $this->ContractNo->CurrentValue, "", FALSE);

		// ContractName
		$this->ContractName->setDbValueDef($rsnew, $this->ContractName->CurrentValue, "", FALSE);

		// ContractType
		$this->ContractType->setDbValueDef($rsnew, $this->ContractType->CurrentValue, NULL, FALSE);

		// ContractSum
		$this->ContractSum->setDbValueDef($rsnew, $this->ContractSum->CurrentValue, 0, FALSE);

		// RevisedContractSum
		$this->RevisedContractSum->setDbValueDef($rsnew, $this->RevisedContractSum->CurrentValue, 0, FALSE);

		// ContractorRef
		$this->ContractorRef->setDbValueDef($rsnew, $this->ContractorRef->CurrentValue, 0, FALSE);

		// SigningDate
		$this->SigningDate->setDbValueDef($rsnew, UnFormatDateTime($this->SigningDate->CurrentValue, 0), NULL, FALSE);

		// PlannedStartDate
		$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), FALSE);

		// PlannedEndDate
		$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), FALSE);

		// ActualStartDate
		$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, FALSE);

		// ActualEndDate
		$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, FALSE);

		// Duration
		$this->Duration->setDbValueDef($rsnew, $this->Duration->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// AdvancePaymentAmount
		$this->AdvancePaymentAmount->setDbValueDef($rsnew, $this->AdvancePaymentAmount->CurrentValue, NULL, FALSE);

		// AdvancePaymentdate
		$this->AdvancePaymentdate->setDbValueDef($rsnew, UnFormatDateTime($this->AdvancePaymentdate->CurrentValue, 0), NULL, FALSE);

		// ContractStatus
		$this->ContractStatus->setDbValueDef($rsnew, $this->ContractStatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ContractNo']) == "") {
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
			if (in_array("contract_variation", $detailTblVar) && $GLOBALS["contract_variation"]->DetailAdd) {
				$GLOBALS["contract_variation"]->ContractNo->setSessionValue($this->ContractNo->CurrentValue); // Set master key
				$GLOBALS["contract_variation"]->DepartmentCode->setSessionValue($this->DepartmentCode->CurrentValue); // Set master key
				$GLOBALS["contract_variation"]->LACode->setSessionValue($this->LACode->CurrentValue); // Set master key
				if (!isset($GLOBALS["contract_variation_grid"]))
					$GLOBALS["contract_variation_grid"] = new contract_variation_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "contract_variation"); // Load user level of detail table
				$addRow = $GLOBALS["contract_variation_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["contract_variation"]->ContractNo->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["contract_variation"]->DepartmentCode->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["contract_variation"]->LACode->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("ipc_tracking", $detailTblVar) && $GLOBALS["ipc_tracking"]->DetailAdd) {
				$GLOBALS["ipc_tracking"]->ContractNo->setSessionValue($this->ContractNo->CurrentValue); // Set master key
				if (!isset($GLOBALS["ipc_tracking_grid"]))
					$GLOBALS["ipc_tracking_grid"] = new ipc_tracking_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "ipc_tracking"); // Load user level of detail table
				$addRow = $GLOBALS["ipc_tracking_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["ipc_tracking"]->ContractNo->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("contract_variation", $detailTblVar)) {
				if (!isset($GLOBALS["contract_variation_grid"]))
					$GLOBALS["contract_variation_grid"] = new contract_variation_grid();
				if ($GLOBALS["contract_variation_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["contract_variation_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["contract_variation_grid"]->CurrentMode = "add";
					$GLOBALS["contract_variation_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["contract_variation_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["contract_variation_grid"]->setStartRecordNumber(1);
					$GLOBALS["contract_variation_grid"]->ContractNo->IsDetailKey = TRUE;
					$GLOBALS["contract_variation_grid"]->ContractNo->CurrentValue = $this->ContractNo->CurrentValue;
					$GLOBALS["contract_variation_grid"]->ContractNo->setSessionValue($GLOBALS["contract_variation_grid"]->ContractNo->CurrentValue);
					$GLOBALS["contract_variation_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["contract_variation_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["contract_variation_grid"]->DepartmentCode->setSessionValue($GLOBALS["contract_variation_grid"]->DepartmentCode->CurrentValue);
					$GLOBALS["contract_variation_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["contract_variation_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["contract_variation_grid"]->LACode->setSessionValue($GLOBALS["contract_variation_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("ipc_tracking", $detailTblVar)) {
				if (!isset($GLOBALS["ipc_tracking_grid"]))
					$GLOBALS["ipc_tracking_grid"] = new ipc_tracking_grid();
				if ($GLOBALS["ipc_tracking_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["ipc_tracking_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["ipc_tracking_grid"]->CurrentMode = "add";
					$GLOBALS["ipc_tracking_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["ipc_tracking_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ipc_tracking_grid"]->setStartRecordNumber(1);
					$GLOBALS["ipc_tracking_grid"]->ContractNo->IsDetailKey = TRUE;
					$GLOBALS["ipc_tracking_grid"]->ContractNo->CurrentValue = $this->ContractNo->CurrentValue;
					$GLOBALS["ipc_tracking_grid"]->ContractNo->setSessionValue($GLOBALS["ipc_tracking_grid"]->ContractNo->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("contractlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('contract_variation');
		$pages->add('ipc_tracking');
		$this->DetailPages = $pages;
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
				case "x_ProjectCode":
					break;
				case "x_ContractType":
					break;
				case "x_ContractorRef":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_ContractStatus":
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
						case "x_ProjectCode":
							break;
						case "x_ContractType":
							break;
						case "x_ContractorRef":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_ContractStatus":
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