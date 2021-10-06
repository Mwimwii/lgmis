<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class contractor_add extends contractor
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'contractor';

	// Page object name
	public $PageObjName = "contractor_add";

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

		// Table object (contractor)
		if (!isset($GLOBALS["contractor"]) || get_class($GLOBALS["contractor"]) == PROJECT_NAMESPACE . "contractor") {
			$GLOBALS["contractor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contractor"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'contractor');

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
		global $contractor;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($contractor);
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
					if ($pageName == "contractorview.php")
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
			$key .= @$ar['ContractorRef'];
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
			$this->ContractorRef->Visible = FALSE;
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
					$this->terminate(GetUrl("contractorlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ContractorRef->Visible = FALSE;
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->ContractorName->setVisibility();
		$this->TradingName->setVisibility();
		$this->ZambianContrator->setVisibility();
		$this->ContractorType->setVisibility();
		$this->BusinessType->setVisibility();
		$this->BusinessSector->setVisibility();
		$this->BusinessDesc->setVisibility();
		$this->PostalAddress->setVisibility();
		$this->Town->setVisibility();
		$this->PhysicaAddress->setVisibility();
		$this->_Email->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->Country->setVisibility();
		$this->ContactPerson->setVisibility();
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
		$this->setupLookupOptions($this->ContractorType);
		$this->setupLookupOptions($this->BusinessType);
		$this->setupLookupOptions($this->BusinessSector);
		$this->setupLookupOptions($this->Country);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("contractorlist.php");
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
			if (Get("ContractorRef") !== NULL) {
				$this->ContractorRef->setQueryStringValue(Get("ContractorRef"));
				$this->setKey("ContractorRef", $this->ContractorRef->CurrentValue); // Set up key
			} else {
				$this->setKey("ContractorRef", ""); // Clear key
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
					$this->terminate("contractorlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "contractorlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "contractorview.php")
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
		$this->ContractorRef->CurrentValue = NULL;
		$this->ContractorRef->OldValue = $this->ContractorRef->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->ContractorName->CurrentValue = NULL;
		$this->ContractorName->OldValue = $this->ContractorName->CurrentValue;
		$this->TradingName->CurrentValue = NULL;
		$this->TradingName->OldValue = $this->TradingName->CurrentValue;
		$this->ZambianContrator->CurrentValue = NULL;
		$this->ZambianContrator->OldValue = $this->ZambianContrator->CurrentValue;
		$this->ContractorType->CurrentValue = NULL;
		$this->ContractorType->OldValue = $this->ContractorType->CurrentValue;
		$this->BusinessType->CurrentValue = NULL;
		$this->BusinessType->OldValue = $this->BusinessType->CurrentValue;
		$this->BusinessSector->CurrentValue = NULL;
		$this->BusinessSector->OldValue = $this->BusinessSector->CurrentValue;
		$this->BusinessDesc->CurrentValue = NULL;
		$this->BusinessDesc->OldValue = $this->BusinessDesc->CurrentValue;
		$this->PostalAddress->CurrentValue = NULL;
		$this->PostalAddress->OldValue = $this->PostalAddress->CurrentValue;
		$this->Town->CurrentValue = NULL;
		$this->Town->OldValue = $this->Town->CurrentValue;
		$this->PhysicaAddress->CurrentValue = NULL;
		$this->PhysicaAddress->OldValue = $this->PhysicaAddress->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Telephone->CurrentValue = NULL;
		$this->Telephone->OldValue = $this->Telephone->CurrentValue;
		$this->Mobile->CurrentValue = NULL;
		$this->Mobile->OldValue = $this->Mobile->CurrentValue;
		$this->Fax->CurrentValue = NULL;
		$this->Fax->OldValue = $this->Fax->CurrentValue;
		$this->Country->CurrentValue = "Zambia";
		$this->ContactPerson->CurrentValue = NULL;
		$this->ContactPerson->OldValue = $this->ContactPerson->CurrentValue;
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

		// Check field name 'ContractorName' first before field var 'x_ContractorName'
		$val = $CurrentForm->hasValue("ContractorName") ? $CurrentForm->getValue("ContractorName") : $CurrentForm->getValue("x_ContractorName");
		if (!$this->ContractorName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractorName->Visible = FALSE; // Disable update for API request
			else
				$this->ContractorName->setFormValue($val);
		}

		// Check field name 'TradingName' first before field var 'x_TradingName'
		$val = $CurrentForm->hasValue("TradingName") ? $CurrentForm->getValue("TradingName") : $CurrentForm->getValue("x_TradingName");
		if (!$this->TradingName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TradingName->Visible = FALSE; // Disable update for API request
			else
				$this->TradingName->setFormValue($val);
		}

		// Check field name 'ZambianContrator' first before field var 'x_ZambianContrator'
		$val = $CurrentForm->hasValue("ZambianContrator") ? $CurrentForm->getValue("ZambianContrator") : $CurrentForm->getValue("x_ZambianContrator");
		if (!$this->ZambianContrator->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ZambianContrator->Visible = FALSE; // Disable update for API request
			else
				$this->ZambianContrator->setFormValue($val);
		}

		// Check field name 'ContractorType' first before field var 'x_ContractorType'
		$val = $CurrentForm->hasValue("ContractorType") ? $CurrentForm->getValue("ContractorType") : $CurrentForm->getValue("x_ContractorType");
		if (!$this->ContractorType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractorType->Visible = FALSE; // Disable update for API request
			else
				$this->ContractorType->setFormValue($val);
		}

		// Check field name 'BusinessType' first before field var 'x_BusinessType'
		$val = $CurrentForm->hasValue("BusinessType") ? $CurrentForm->getValue("BusinessType") : $CurrentForm->getValue("x_BusinessType");
		if (!$this->BusinessType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessType->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessType->setFormValue($val);
		}

		// Check field name 'BusinessSector' first before field var 'x_BusinessSector'
		$val = $CurrentForm->hasValue("BusinessSector") ? $CurrentForm->getValue("BusinessSector") : $CurrentForm->getValue("x_BusinessSector");
		if (!$this->BusinessSector->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessSector->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessSector->setFormValue($val);
		}

		// Check field name 'BusinessDesc' first before field var 'x_BusinessDesc'
		$val = $CurrentForm->hasValue("BusinessDesc") ? $CurrentForm->getValue("BusinessDesc") : $CurrentForm->getValue("x_BusinessDesc");
		if (!$this->BusinessDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessDesc->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessDesc->setFormValue($val);
		}

		// Check field name 'PostalAddress' first before field var 'x_PostalAddress'
		$val = $CurrentForm->hasValue("PostalAddress") ? $CurrentForm->getValue("PostalAddress") : $CurrentForm->getValue("x_PostalAddress");
		if (!$this->PostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PostalAddress->setFormValue($val);
		}

		// Check field name 'Town' first before field var 'x_Town'
		$val = $CurrentForm->hasValue("Town") ? $CurrentForm->getValue("Town") : $CurrentForm->getValue("x_Town");
		if (!$this->Town->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Town->Visible = FALSE; // Disable update for API request
			else
				$this->Town->setFormValue($val);
		}

		// Check field name 'PhysicaAddress' first before field var 'x_PhysicaAddress'
		$val = $CurrentForm->hasValue("PhysicaAddress") ? $CurrentForm->getValue("PhysicaAddress") : $CurrentForm->getValue("x_PhysicaAddress");
		if (!$this->PhysicaAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicaAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicaAddress->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Telephone' first before field var 'x_Telephone'
		$val = $CurrentForm->hasValue("Telephone") ? $CurrentForm->getValue("Telephone") : $CurrentForm->getValue("x_Telephone");
		if (!$this->Telephone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Telephone->Visible = FALSE; // Disable update for API request
			else
				$this->Telephone->setFormValue($val);
		}

		// Check field name 'Mobile' first before field var 'x_Mobile'
		$val = $CurrentForm->hasValue("Mobile") ? $CurrentForm->getValue("Mobile") : $CurrentForm->getValue("x_Mobile");
		if (!$this->Mobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mobile->Visible = FALSE; // Disable update for API request
			else
				$this->Mobile->setFormValue($val);
		}

		// Check field name 'Fax' first before field var 'x_Fax'
		$val = $CurrentForm->hasValue("Fax") ? $CurrentForm->getValue("Fax") : $CurrentForm->getValue("x_Fax");
		if (!$this->Fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fax->Visible = FALSE; // Disable update for API request
			else
				$this->Fax->setFormValue($val);
		}

		// Check field name 'Country' first before field var 'x_Country'
		$val = $CurrentForm->hasValue("Country") ? $CurrentForm->getValue("Country") : $CurrentForm->getValue("x_Country");
		if (!$this->Country->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Country->Visible = FALSE; // Disable update for API request
			else
				$this->Country->setFormValue($val);
		}

		// Check field name 'ContactPerson' first before field var 'x_ContactPerson'
		$val = $CurrentForm->hasValue("ContactPerson") ? $CurrentForm->getValue("ContactPerson") : $CurrentForm->getValue("x_ContactPerson");
		if (!$this->ContactPerson->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContactPerson->Visible = FALSE; // Disable update for API request
			else
				$this->ContactPerson->setFormValue($val);
		}

		// Check field name 'ContractorRef' first before field var 'x_ContractorRef'
		$val = $CurrentForm->hasValue("ContractorRef") ? $CurrentForm->getValue("ContractorRef") : $CurrentForm->getValue("x_ContractorRef");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->ContractorName->CurrentValue = $this->ContractorName->FormValue;
		$this->TradingName->CurrentValue = $this->TradingName->FormValue;
		$this->ZambianContrator->CurrentValue = $this->ZambianContrator->FormValue;
		$this->ContractorType->CurrentValue = $this->ContractorType->FormValue;
		$this->BusinessType->CurrentValue = $this->BusinessType->FormValue;
		$this->BusinessSector->CurrentValue = $this->BusinessSector->FormValue;
		$this->BusinessDesc->CurrentValue = $this->BusinessDesc->FormValue;
		$this->PostalAddress->CurrentValue = $this->PostalAddress->FormValue;
		$this->Town->CurrentValue = $this->Town->FormValue;
		$this->PhysicaAddress->CurrentValue = $this->PhysicaAddress->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Fax->CurrentValue = $this->Fax->FormValue;
		$this->Country->CurrentValue = $this->Country->FormValue;
		$this->ContactPerson->CurrentValue = $this->ContactPerson->FormValue;
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
		$this->ContractorRef->setDbValue($row['ContractorRef']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->ContractorName->setDbValue($row['ContractorName']);
		$this->TradingName->setDbValue($row['TradingName']);
		$this->ZambianContrator->setDbValue($row['ZambianContrator']);
		$this->ContractorType->setDbValue($row['ContractorType']);
		$this->BusinessType->setDbValue($row['BusinessType']);
		$this->BusinessSector->setDbValue($row['BusinessSector']);
		$this->BusinessDesc->setDbValue($row['BusinessDesc']);
		$this->PostalAddress->setDbValue($row['PostalAddress']);
		$this->Town->setDbValue($row['Town']);
		$this->PhysicaAddress->setDbValue($row['PhysicaAddress']);
		$this->_Email->setDbValue($row['Email']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Fax->setDbValue($row['Fax']);
		$this->Country->setDbValue($row['Country']);
		$this->ContactPerson->setDbValue($row['ContactPerson']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ContractorRef'] = $this->ContractorRef->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['ContractorName'] = $this->ContractorName->CurrentValue;
		$row['TradingName'] = $this->TradingName->CurrentValue;
		$row['ZambianContrator'] = $this->ZambianContrator->CurrentValue;
		$row['ContractorType'] = $this->ContractorType->CurrentValue;
		$row['BusinessType'] = $this->BusinessType->CurrentValue;
		$row['BusinessSector'] = $this->BusinessSector->CurrentValue;
		$row['BusinessDesc'] = $this->BusinessDesc->CurrentValue;
		$row['PostalAddress'] = $this->PostalAddress->CurrentValue;
		$row['Town'] = $this->Town->CurrentValue;
		$row['PhysicaAddress'] = $this->PhysicaAddress->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['Telephone'] = $this->Telephone->CurrentValue;
		$row['Mobile'] = $this->Mobile->CurrentValue;
		$row['Fax'] = $this->Fax->CurrentValue;
		$row['Country'] = $this->Country->CurrentValue;
		$row['ContactPerson'] = $this->ContactPerson->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ContractorRef")) != "")
			$this->ContractorRef->OldValue = $this->getKey("ContractorRef"); // ContractorRef
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
		// ContractorRef
		// ProvinceCode
		// LACode
		// ContractorName
		// TradingName
		// ZambianContrator
		// ContractorType
		// BusinessType
		// BusinessSector
		// BusinessDesc
		// PostalAddress
		// Town
		// PhysicaAddress
		// Email
		// Telephone
		// Mobile
		// Fax
		// Country
		// ContactPerson

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ContractorRef
			$this->ContractorRef->ViewValue = $this->ContractorRef->CurrentValue;
			$this->ContractorRef->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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

			// ContractorName
			$this->ContractorName->ViewValue = $this->ContractorName->CurrentValue;
			$this->ContractorName->ViewCustomAttributes = "";

			// TradingName
			$this->TradingName->ViewValue = $this->TradingName->CurrentValue;
			$this->TradingName->ViewCustomAttributes = "";

			// ZambianContrator
			if (ConvertToBool($this->ZambianContrator->CurrentValue)) {
				$this->ZambianContrator->ViewValue = $this->ZambianContrator->tagCaption(1) != "" ? $this->ZambianContrator->tagCaption(1) : "Yes";
			} else {
				$this->ZambianContrator->ViewValue = $this->ZambianContrator->tagCaption(2) != "" ? $this->ZambianContrator->tagCaption(2) : "No";
			}
			$this->ZambianContrator->ViewCustomAttributes = "";

			// ContractorType
			$curVal = strval($this->ContractorType->CurrentValue);
			if ($curVal != "") {
				$this->ContractorType->ViewValue = $this->ContractorType->lookupCacheOption($curVal);
				if ($this->ContractorType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractorTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractorType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractorType->ViewValue = $this->ContractorType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractorType->ViewValue = $this->ContractorType->CurrentValue;
					}
				}
			} else {
				$this->ContractorType->ViewValue = NULL;
			}
			$this->ContractorType->ViewCustomAttributes = "";

			// BusinessType
			$curVal = strval($this->BusinessType->CurrentValue);
			if ($curVal != "") {
				$this->BusinessType->ViewValue = $this->BusinessType->lookupCacheOption($curVal);
				if ($this->BusinessType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`business_type_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BusinessType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BusinessType->ViewValue = $this->BusinessType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BusinessType->ViewValue = $this->BusinessType->CurrentValue;
					}
				}
			} else {
				$this->BusinessType->ViewValue = NULL;
			}
			$this->BusinessType->ViewCustomAttributes = "";

			// BusinessSector
			$curVal = strval($this->BusinessSector->CurrentValue);
			if ($curVal != "") {
				$this->BusinessSector->ViewValue = $this->BusinessSector->lookupCacheOption($curVal);
				if ($this->BusinessSector->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`business_sector_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BusinessSector->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BusinessSector->ViewValue = $this->BusinessSector->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BusinessSector->ViewValue = $this->BusinessSector->CurrentValue;
					}
				}
			} else {
				$this->BusinessSector->ViewValue = NULL;
			}
			$this->BusinessSector->ViewCustomAttributes = "";

			// BusinessDesc
			$this->BusinessDesc->ViewValue = $this->BusinessDesc->CurrentValue;
			$this->BusinessDesc->ViewCustomAttributes = "";

			// PostalAddress
			$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
			$this->PostalAddress->ViewCustomAttributes = "";

			// Town
			$this->Town->ViewValue = $this->Town->CurrentValue;
			$this->Town->ViewCustomAttributes = "";

			// PhysicaAddress
			$this->PhysicaAddress->ViewValue = $this->PhysicaAddress->CurrentValue;
			$this->PhysicaAddress->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Telephone
			$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
			$this->Telephone->ViewCustomAttributes = "";

			// Mobile
			$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
			$this->Mobile->ViewCustomAttributes = "";

			// Fax
			$this->Fax->ViewValue = $this->Fax->CurrentValue;
			$this->Fax->ViewCustomAttributes = "";

			// Country
			$this->Country->ViewValue = $this->Country->CurrentValue;
			$curVal = strval($this->Country->CurrentValue);
			if ($curVal != "") {
				$this->Country->ViewValue = $this->Country->lookupCacheOption($curVal);
				if ($this->Country->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CountryName`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Country->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Country->ViewValue = $this->Country->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Country->ViewValue = $this->Country->CurrentValue;
					}
				}
			} else {
				$this->Country->ViewValue = NULL;
			}
			$this->Country->ViewCustomAttributes = "";

			// ContactPerson
			$this->ContactPerson->ViewValue = $this->ContactPerson->CurrentValue;
			$this->ContactPerson->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// ContractorName
			$this->ContractorName->LinkCustomAttributes = "";
			$this->ContractorName->HrefValue = "";
			$this->ContractorName->TooltipValue = "";

			// TradingName
			$this->TradingName->LinkCustomAttributes = "";
			$this->TradingName->HrefValue = "";
			$this->TradingName->TooltipValue = "";

			// ZambianContrator
			$this->ZambianContrator->LinkCustomAttributes = "";
			$this->ZambianContrator->HrefValue = "";
			$this->ZambianContrator->TooltipValue = "";

			// ContractorType
			$this->ContractorType->LinkCustomAttributes = "";
			$this->ContractorType->HrefValue = "";
			$this->ContractorType->TooltipValue = "";

			// BusinessType
			$this->BusinessType->LinkCustomAttributes = "";
			$this->BusinessType->HrefValue = "";
			$this->BusinessType->TooltipValue = "";

			// BusinessSector
			$this->BusinessSector->LinkCustomAttributes = "";
			$this->BusinessSector->HrefValue = "";
			$this->BusinessSector->TooltipValue = "";

			// BusinessDesc
			$this->BusinessDesc->LinkCustomAttributes = "";
			$this->BusinessDesc->HrefValue = "";
			$this->BusinessDesc->TooltipValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";
			$this->PostalAddress->TooltipValue = "";

			// Town
			$this->Town->LinkCustomAttributes = "";
			$this->Town->HrefValue = "";
			$this->Town->TooltipValue = "";

			// PhysicaAddress
			$this->PhysicaAddress->LinkCustomAttributes = "";
			$this->PhysicaAddress->HrefValue = "";
			$this->PhysicaAddress->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";
			$this->Telephone->TooltipValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";
			$this->Mobile->TooltipValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";
			$this->Fax->TooltipValue = "";

			// Country
			$this->Country->LinkCustomAttributes = "";
			$this->Country->HrefValue = "";
			$this->Country->TooltipValue = "";

			// ContactPerson
			$this->ContactPerson->LinkCustomAttributes = "";
			$this->ContactPerson->HrefValue = "";
			$this->ContactPerson->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->EditValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProvinceCode->EditValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
					}
				}
			} else {
				$this->ProvinceCode->EditValue = NULL;
			}
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

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

			// ContractorName
			$this->ContractorName->EditAttrs["class"] = "form-control";
			$this->ContractorName->EditCustomAttributes = "";
			if (!$this->ContractorName->Raw)
				$this->ContractorName->CurrentValue = HtmlDecode($this->ContractorName->CurrentValue);
			$this->ContractorName->EditValue = HtmlEncode($this->ContractorName->CurrentValue);
			$this->ContractorName->PlaceHolder = RemoveHtml($this->ContractorName->caption());

			// TradingName
			$this->TradingName->EditAttrs["class"] = "form-control";
			$this->TradingName->EditCustomAttributes = "";
			if (!$this->TradingName->Raw)
				$this->TradingName->CurrentValue = HtmlDecode($this->TradingName->CurrentValue);
			$this->TradingName->EditValue = HtmlEncode($this->TradingName->CurrentValue);
			$this->TradingName->PlaceHolder = RemoveHtml($this->TradingName->caption());

			// ZambianContrator
			$this->ZambianContrator->EditCustomAttributes = "";
			$this->ZambianContrator->EditValue = $this->ZambianContrator->options(FALSE);

			// ContractorType
			$this->ContractorType->EditAttrs["class"] = "form-control";
			$this->ContractorType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractorType->CurrentValue));
			if ($curVal != "")
				$this->ContractorType->ViewValue = $this->ContractorType->lookupCacheOption($curVal);
			else
				$this->ContractorType->ViewValue = $this->ContractorType->Lookup !== NULL && is_array($this->ContractorType->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractorType->ViewValue !== NULL) { // Load from cache
				$this->ContractorType->EditValue = array_values($this->ContractorType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractorTypeCode`" . SearchString("=", $this->ContractorType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractorType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractorType->EditValue = $arwrk;
			}

			// BusinessType
			$this->BusinessType->EditAttrs["class"] = "form-control";
			$this->BusinessType->EditCustomAttributes = "";
			$curVal = trim(strval($this->BusinessType->CurrentValue));
			if ($curVal != "")
				$this->BusinessType->ViewValue = $this->BusinessType->lookupCacheOption($curVal);
			else
				$this->BusinessType->ViewValue = $this->BusinessType->Lookup !== NULL && is_array($this->BusinessType->Lookup->Options) ? $curVal : NULL;
			if ($this->BusinessType->ViewValue !== NULL) { // Load from cache
				$this->BusinessType->EditValue = array_values($this->BusinessType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`business_type_code`" . SearchString("=", $this->BusinessType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BusinessType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BusinessType->EditValue = $arwrk;
			}

			// BusinessSector
			$this->BusinessSector->EditAttrs["class"] = "form-control";
			$this->BusinessSector->EditCustomAttributes = "";
			$curVal = trim(strval($this->BusinessSector->CurrentValue));
			if ($curVal != "")
				$this->BusinessSector->ViewValue = $this->BusinessSector->lookupCacheOption($curVal);
			else
				$this->BusinessSector->ViewValue = $this->BusinessSector->Lookup !== NULL && is_array($this->BusinessSector->Lookup->Options) ? $curVal : NULL;
			if ($this->BusinessSector->ViewValue !== NULL) { // Load from cache
				$this->BusinessSector->EditValue = array_values($this->BusinessSector->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`business_sector_code`" . SearchString("=", $this->BusinessSector->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BusinessSector->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BusinessSector->EditValue = $arwrk;
			}

			// BusinessDesc
			$this->BusinessDesc->EditAttrs["class"] = "form-control";
			$this->BusinessDesc->EditCustomAttributes = "";
			$this->BusinessDesc->EditValue = HtmlEncode($this->BusinessDesc->CurrentValue);
			$this->BusinessDesc->PlaceHolder = RemoveHtml($this->BusinessDesc->caption());

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// Town
			$this->Town->EditAttrs["class"] = "form-control";
			$this->Town->EditCustomAttributes = "";
			if (!$this->Town->Raw)
				$this->Town->CurrentValue = HtmlDecode($this->Town->CurrentValue);
			$this->Town->EditValue = HtmlEncode($this->Town->CurrentValue);
			$this->Town->PlaceHolder = RemoveHtml($this->Town->caption());

			// PhysicaAddress
			$this->PhysicaAddress->EditAttrs["class"] = "form-control";
			$this->PhysicaAddress->EditCustomAttributes = "";
			$this->PhysicaAddress->EditValue = HtmlEncode($this->PhysicaAddress->CurrentValue);
			$this->PhysicaAddress->PlaceHolder = RemoveHtml($this->PhysicaAddress->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->CurrentValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Country
			$this->Country->EditAttrs["class"] = "form-control";
			$this->Country->EditCustomAttributes = "";
			if (!$this->Country->Raw)
				$this->Country->CurrentValue = HtmlDecode($this->Country->CurrentValue);
			$this->Country->EditValue = HtmlEncode($this->Country->CurrentValue);
			$curVal = strval($this->Country->CurrentValue);
			if ($curVal != "") {
				$this->Country->EditValue = $this->Country->lookupCacheOption($curVal);
				if ($this->Country->EditValue === NULL) { // Lookup from database
					$filterWrk = "`CountryName`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Country->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Country->EditValue = $this->Country->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Country->EditValue = HtmlEncode($this->Country->CurrentValue);
					}
				}
			} else {
				$this->Country->EditValue = NULL;
			}
			$this->Country->PlaceHolder = RemoveHtml($this->Country->caption());

			// ContactPerson
			$this->ContactPerson->EditAttrs["class"] = "form-control";
			$this->ContactPerson->EditCustomAttributes = "";
			if (!$this->ContactPerson->Raw)
				$this->ContactPerson->CurrentValue = HtmlDecode($this->ContactPerson->CurrentValue);
			$this->ContactPerson->EditValue = HtmlEncode($this->ContactPerson->CurrentValue);
			$this->ContactPerson->PlaceHolder = RemoveHtml($this->ContactPerson->caption());

			// Add refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// ContractorName
			$this->ContractorName->LinkCustomAttributes = "";
			$this->ContractorName->HrefValue = "";

			// TradingName
			$this->TradingName->LinkCustomAttributes = "";
			$this->TradingName->HrefValue = "";

			// ZambianContrator
			$this->ZambianContrator->LinkCustomAttributes = "";
			$this->ZambianContrator->HrefValue = "";

			// ContractorType
			$this->ContractorType->LinkCustomAttributes = "";
			$this->ContractorType->HrefValue = "";

			// BusinessType
			$this->BusinessType->LinkCustomAttributes = "";
			$this->BusinessType->HrefValue = "";

			// BusinessSector
			$this->BusinessSector->LinkCustomAttributes = "";
			$this->BusinessSector->HrefValue = "";

			// BusinessDesc
			$this->BusinessDesc->LinkCustomAttributes = "";
			$this->BusinessDesc->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

			// Town
			$this->Town->LinkCustomAttributes = "";
			$this->Town->HrefValue = "";

			// PhysicaAddress
			$this->PhysicaAddress->LinkCustomAttributes = "";
			$this->PhysicaAddress->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";

			// Country
			$this->Country->LinkCustomAttributes = "";
			$this->Country->HrefValue = "";

			// ContactPerson
			$this->ContactPerson->LinkCustomAttributes = "";
			$this->ContactPerson->HrefValue = "";
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
		if (!CheckInteger($this->ProvinceCode->FormValue)) {
			AddMessage($FormError, $this->ProvinceCode->errorMessage());
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->ContractorName->Required) {
			if (!$this->ContractorName->IsDetailKey && $this->ContractorName->FormValue != NULL && $this->ContractorName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractorName->caption(), $this->ContractorName->RequiredErrorMessage));
			}
		}
		if ($this->TradingName->Required) {
			if (!$this->TradingName->IsDetailKey && $this->TradingName->FormValue != NULL && $this->TradingName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TradingName->caption(), $this->TradingName->RequiredErrorMessage));
			}
		}
		if ($this->ZambianContrator->Required) {
			if ($this->ZambianContrator->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ZambianContrator->caption(), $this->ZambianContrator->RequiredErrorMessage));
			}
		}
		if ($this->ContractorType->Required) {
			if (!$this->ContractorType->IsDetailKey && $this->ContractorType->FormValue != NULL && $this->ContractorType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractorType->caption(), $this->ContractorType->RequiredErrorMessage));
			}
		}
		if ($this->BusinessType->Required) {
			if (!$this->BusinessType->IsDetailKey && $this->BusinessType->FormValue != NULL && $this->BusinessType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessType->caption(), $this->BusinessType->RequiredErrorMessage));
			}
		}
		if ($this->BusinessSector->Required) {
			if (!$this->BusinessSector->IsDetailKey && $this->BusinessSector->FormValue != NULL && $this->BusinessSector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessSector->caption(), $this->BusinessSector->RequiredErrorMessage));
			}
		}
		if ($this->BusinessDesc->Required) {
			if (!$this->BusinessDesc->IsDetailKey && $this->BusinessDesc->FormValue != NULL && $this->BusinessDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessDesc->caption(), $this->BusinessDesc->RequiredErrorMessage));
			}
		}
		if ($this->PostalAddress->Required) {
			if (!$this->PostalAddress->IsDetailKey && $this->PostalAddress->FormValue != NULL && $this->PostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalAddress->caption(), $this->PostalAddress->RequiredErrorMessage));
			}
		}
		if ($this->Town->Required) {
			if (!$this->Town->IsDetailKey && $this->Town->FormValue != NULL && $this->Town->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Town->caption(), $this->Town->RequiredErrorMessage));
			}
		}
		if ($this->PhysicaAddress->Required) {
			if (!$this->PhysicaAddress->IsDetailKey && $this->PhysicaAddress->FormValue != NULL && $this->PhysicaAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicaAddress->caption(), $this->PhysicaAddress->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Telephone->Required) {
			if (!$this->Telephone->IsDetailKey && $this->Telephone->FormValue != NULL && $this->Telephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telephone->caption(), $this->Telephone->RequiredErrorMessage));
			}
		}
		if ($this->Mobile->Required) {
			if (!$this->Mobile->IsDetailKey && $this->Mobile->FormValue != NULL && $this->Mobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mobile->caption(), $this->Mobile->RequiredErrorMessage));
			}
		}
		if ($this->Fax->Required) {
			if (!$this->Fax->IsDetailKey && $this->Fax->FormValue != NULL && $this->Fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fax->caption(), $this->Fax->RequiredErrorMessage));
			}
		}
		if ($this->Country->Required) {
			if (!$this->Country->IsDetailKey && $this->Country->FormValue != NULL && $this->Country->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Country->caption(), $this->Country->RequiredErrorMessage));
			}
		}
		if ($this->ContactPerson->Required) {
			if (!$this->ContactPerson->IsDetailKey && $this->ContactPerson->FormValue != NULL && $this->ContactPerson->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContactPerson->caption(), $this->ContactPerson->RequiredErrorMessage));
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

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// ContractorName
		$this->ContractorName->setDbValueDef($rsnew, $this->ContractorName->CurrentValue, "", FALSE);

		// TradingName
		$this->TradingName->setDbValueDef($rsnew, $this->TradingName->CurrentValue, NULL, FALSE);

		// ZambianContrator
		$tmpBool = $this->ZambianContrator->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ZambianContrator->setDbValueDef($rsnew, $tmpBool, 0, FALSE);

		// ContractorType
		$this->ContractorType->setDbValueDef($rsnew, $this->ContractorType->CurrentValue, 0, FALSE);

		// BusinessType
		$this->BusinessType->setDbValueDef($rsnew, $this->BusinessType->CurrentValue, 0, FALSE);

		// BusinessSector
		$this->BusinessSector->setDbValueDef($rsnew, $this->BusinessSector->CurrentValue, 0, FALSE);

		// BusinessDesc
		$this->BusinessDesc->setDbValueDef($rsnew, $this->BusinessDesc->CurrentValue, NULL, FALSE);

		// PostalAddress
		$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, FALSE);

		// Town
		$this->Town->setDbValueDef($rsnew, $this->Town->CurrentValue, NULL, FALSE);

		// PhysicaAddress
		$this->PhysicaAddress->setDbValueDef($rsnew, $this->PhysicaAddress->CurrentValue, NULL, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, FALSE);

		// Telephone
		$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, FALSE);

		// Mobile
		$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, FALSE);

		// Fax
		$this->Fax->setDbValueDef($rsnew, $this->Fax->CurrentValue, NULL, FALSE);

		// Country
		$this->Country->setDbValueDef($rsnew, $this->Country->CurrentValue, NULL, strval($this->Country->CurrentValue) == "");

		// ContactPerson
		$this->ContactPerson->setDbValueDef($rsnew, $this->ContactPerson->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("contractorlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ZambianContrator":
					break;
				case "x_ContractorType":
					break;
				case "x_BusinessType":
					break;
				case "x_BusinessSector":
					break;
				case "x_Country":
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
						case "x_ContractorType":
							break;
						case "x_BusinessType":
							break;
						case "x_BusinessSector":
							break;
						case "x_Country":
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