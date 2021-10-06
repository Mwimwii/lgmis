<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class asset_add extends asset
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'asset';

	// Page object name
	public $PageObjName = "asset_add";

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

		// Table object (asset)
		if (!isset($GLOBALS["asset"]) || get_class($GLOBALS["asset"]) == PROJECT_NAMESPACE . "asset") {
			$GLOBALS["asset"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["asset"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'asset');

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
		global $asset;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($asset);
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
					if ($pageName == "assetview.php")
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
			$key .= @$ar['AssetCode'];
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
					$this->terminate(GetUrl("assetlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->AssetCode->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->AssetTypeCode->setVisibility();
		$this->Supplier->setVisibility();
		$this->PurchasePrice->setVisibility();
		$this->CurrencyCode->setVisibility();
		$this->ConditionCode->setVisibility();
		$this->DateOfPurchase->setVisibility();
		$this->AssetCapacity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AssetDescription->setVisibility();
		$this->DateOfLastRevaluation->setVisibility();
		$this->NewValue->setVisibility();
		$this->NameOfValuer->setVisibility();
		$this->BookValue->setVisibility();
		$this->LastDepreciationDate->setVisibility();
		$this->LastDepreciationAmount->setVisibility();
		$this->DepreciationRate->setVisibility();
		$this->CumulativeDepreciation->setVisibility();
		$this->AssetStatus->setVisibility();
		$this->LastUserID->Visible = FALSE;
		$this->LastUpdated->Visible = FALSE;
		$this->ScrapValue->setVisibility();
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
		$this->setupLookupOptions($this->AssetTypeCode);
		$this->setupLookupOptions($this->CurrencyCode);
		$this->setupLookupOptions($this->ConditionCode);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->AssetStatus);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("assetlist.php");
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
			if (Get("AssetCode") !== NULL) {
				$this->AssetCode->setQueryStringValue(Get("AssetCode"));
				$this->setKey("AssetCode", $this->AssetCode->CurrentValue); // Set up key
			} else {
				$this->setKey("AssetCode", ""); // Clear key
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
					$this->terminate("assetlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "assetlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "assetview.php")
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
		$this->AssetCode->CurrentValue = NULL;
		$this->AssetCode->OldValue = $this->AssetCode->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->AssetTypeCode->CurrentValue = NULL;
		$this->AssetTypeCode->OldValue = $this->AssetTypeCode->CurrentValue;
		$this->Supplier->CurrentValue = NULL;
		$this->Supplier->OldValue = $this->Supplier->CurrentValue;
		$this->PurchasePrice->CurrentValue = NULL;
		$this->PurchasePrice->OldValue = $this->PurchasePrice->CurrentValue;
		$this->CurrencyCode->CurrentValue = "ZMW";
		$this->ConditionCode->CurrentValue = NULL;
		$this->ConditionCode->OldValue = $this->ConditionCode->CurrentValue;
		$this->DateOfPurchase->CurrentValue = NULL;
		$this->DateOfPurchase->OldValue = $this->DateOfPurchase->CurrentValue;
		$this->AssetCapacity->CurrentValue = NULL;
		$this->AssetCapacity->OldValue = $this->AssetCapacity->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->AssetDescription->CurrentValue = NULL;
		$this->AssetDescription->OldValue = $this->AssetDescription->CurrentValue;
		$this->DateOfLastRevaluation->CurrentValue = NULL;
		$this->DateOfLastRevaluation->OldValue = $this->DateOfLastRevaluation->CurrentValue;
		$this->NewValue->CurrentValue = NULL;
		$this->NewValue->OldValue = $this->NewValue->CurrentValue;
		$this->NameOfValuer->CurrentValue = NULL;
		$this->NameOfValuer->OldValue = $this->NameOfValuer->CurrentValue;
		$this->BookValue->CurrentValue = NULL;
		$this->BookValue->OldValue = $this->BookValue->CurrentValue;
		$this->LastDepreciationDate->CurrentValue = NULL;
		$this->LastDepreciationDate->OldValue = $this->LastDepreciationDate->CurrentValue;
		$this->LastDepreciationAmount->CurrentValue = NULL;
		$this->LastDepreciationAmount->OldValue = $this->LastDepreciationAmount->CurrentValue;
		$this->DepreciationRate->CurrentValue = NULL;
		$this->DepreciationRate->OldValue = $this->DepreciationRate->CurrentValue;
		$this->CumulativeDepreciation->CurrentValue = NULL;
		$this->CumulativeDepreciation->OldValue = $this->CumulativeDepreciation->CurrentValue;
		$this->AssetStatus->CurrentValue = NULL;
		$this->AssetStatus->OldValue = $this->AssetStatus->CurrentValue;
		$this->LastUserID->CurrentValue = NULL;
		$this->LastUserID->OldValue = $this->LastUserID->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->ScrapValue->CurrentValue = NULL;
		$this->ScrapValue->OldValue = $this->ScrapValue->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'AssetCode' first before field var 'x_AssetCode'
		$val = $CurrentForm->hasValue("AssetCode") ? $CurrentForm->getValue("AssetCode") : $CurrentForm->getValue("x_AssetCode");
		if (!$this->AssetCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetCode->Visible = FALSE; // Disable update for API request
			else
				$this->AssetCode->setFormValue($val);
		}

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

		// Check field name 'AssetTypeCode' first before field var 'x_AssetTypeCode'
		$val = $CurrentForm->hasValue("AssetTypeCode") ? $CurrentForm->getValue("AssetTypeCode") : $CurrentForm->getValue("x_AssetTypeCode");
		if (!$this->AssetTypeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetTypeCode->Visible = FALSE; // Disable update for API request
			else
				$this->AssetTypeCode->setFormValue($val);
		}

		// Check field name 'Supplier' first before field var 'x_Supplier'
		$val = $CurrentForm->hasValue("Supplier") ? $CurrentForm->getValue("Supplier") : $CurrentForm->getValue("x_Supplier");
		if (!$this->Supplier->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Supplier->Visible = FALSE; // Disable update for API request
			else
				$this->Supplier->setFormValue($val);
		}

		// Check field name 'PurchasePrice' first before field var 'x_PurchasePrice'
		$val = $CurrentForm->hasValue("PurchasePrice") ? $CurrentForm->getValue("PurchasePrice") : $CurrentForm->getValue("x_PurchasePrice");
		if (!$this->PurchasePrice->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PurchasePrice->Visible = FALSE; // Disable update for API request
			else
				$this->PurchasePrice->setFormValue($val);
		}

		// Check field name 'CurrencyCode' first before field var 'x_CurrencyCode'
		$val = $CurrentForm->hasValue("CurrencyCode") ? $CurrentForm->getValue("CurrencyCode") : $CurrentForm->getValue("x_CurrencyCode");
		if (!$this->CurrencyCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrencyCode->Visible = FALSE; // Disable update for API request
			else
				$this->CurrencyCode->setFormValue($val);
		}

		// Check field name 'ConditionCode' first before field var 'x_ConditionCode'
		$val = $CurrentForm->hasValue("ConditionCode") ? $CurrentForm->getValue("ConditionCode") : $CurrentForm->getValue("x_ConditionCode");
		if (!$this->ConditionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ConditionCode->Visible = FALSE; // Disable update for API request
			else
				$this->ConditionCode->setFormValue($val);
		}

		// Check field name 'DateOfPurchase' first before field var 'x_DateOfPurchase'
		$val = $CurrentForm->hasValue("DateOfPurchase") ? $CurrentForm->getValue("DateOfPurchase") : $CurrentForm->getValue("x_DateOfPurchase");
		if (!$this->DateOfPurchase->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfPurchase->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfPurchase->setFormValue($val);
			$this->DateOfPurchase->CurrentValue = UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0);
		}

		// Check field name 'AssetCapacity' first before field var 'x_AssetCapacity'
		$val = $CurrentForm->hasValue("AssetCapacity") ? $CurrentForm->getValue("AssetCapacity") : $CurrentForm->getValue("x_AssetCapacity");
		if (!$this->AssetCapacity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetCapacity->Visible = FALSE; // Disable update for API request
			else
				$this->AssetCapacity->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'AssetDescription' first before field var 'x_AssetDescription'
		$val = $CurrentForm->hasValue("AssetDescription") ? $CurrentForm->getValue("AssetDescription") : $CurrentForm->getValue("x_AssetDescription");
		if (!$this->AssetDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetDescription->Visible = FALSE; // Disable update for API request
			else
				$this->AssetDescription->setFormValue($val);
		}

		// Check field name 'DateOfLastRevaluation' first before field var 'x_DateOfLastRevaluation'
		$val = $CurrentForm->hasValue("DateOfLastRevaluation") ? $CurrentForm->getValue("DateOfLastRevaluation") : $CurrentForm->getValue("x_DateOfLastRevaluation");
		if (!$this->DateOfLastRevaluation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfLastRevaluation->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfLastRevaluation->setFormValue($val);
			$this->DateOfLastRevaluation->CurrentValue = UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0);
		}

		// Check field name 'NewValue' first before field var 'x_NewValue'
		$val = $CurrentForm->hasValue("NewValue") ? $CurrentForm->getValue("NewValue") : $CurrentForm->getValue("x_NewValue");
		if (!$this->NewValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewValue->Visible = FALSE; // Disable update for API request
			else
				$this->NewValue->setFormValue($val);
		}

		// Check field name 'NameOfValuer' first before field var 'x_NameOfValuer'
		$val = $CurrentForm->hasValue("NameOfValuer") ? $CurrentForm->getValue("NameOfValuer") : $CurrentForm->getValue("x_NameOfValuer");
		if (!$this->NameOfValuer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NameOfValuer->Visible = FALSE; // Disable update for API request
			else
				$this->NameOfValuer->setFormValue($val);
		}

		// Check field name 'BookValue' first before field var 'x_BookValue'
		$val = $CurrentForm->hasValue("BookValue") ? $CurrentForm->getValue("BookValue") : $CurrentForm->getValue("x_BookValue");
		if (!$this->BookValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BookValue->Visible = FALSE; // Disable update for API request
			else
				$this->BookValue->setFormValue($val);
		}

		// Check field name 'LastDepreciationDate' first before field var 'x_LastDepreciationDate'
		$val = $CurrentForm->hasValue("LastDepreciationDate") ? $CurrentForm->getValue("LastDepreciationDate") : $CurrentForm->getValue("x_LastDepreciationDate");
		if (!$this->LastDepreciationDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastDepreciationDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastDepreciationDate->setFormValue($val);
			$this->LastDepreciationDate->CurrentValue = UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0);
		}

		// Check field name 'LastDepreciationAmount' first before field var 'x_LastDepreciationAmount'
		$val = $CurrentForm->hasValue("LastDepreciationAmount") ? $CurrentForm->getValue("LastDepreciationAmount") : $CurrentForm->getValue("x_LastDepreciationAmount");
		if (!$this->LastDepreciationAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastDepreciationAmount->Visible = FALSE; // Disable update for API request
			else
				$this->LastDepreciationAmount->setFormValue($val);
		}

		// Check field name 'DepreciationRate' first before field var 'x_DepreciationRate'
		$val = $CurrentForm->hasValue("DepreciationRate") ? $CurrentForm->getValue("DepreciationRate") : $CurrentForm->getValue("x_DepreciationRate");
		if (!$this->DepreciationRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepreciationRate->Visible = FALSE; // Disable update for API request
			else
				$this->DepreciationRate->setFormValue($val);
		}

		// Check field name 'CumulativeDepreciation' first before field var 'x_CumulativeDepreciation'
		$val = $CurrentForm->hasValue("CumulativeDepreciation") ? $CurrentForm->getValue("CumulativeDepreciation") : $CurrentForm->getValue("x_CumulativeDepreciation");
		if (!$this->CumulativeDepreciation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CumulativeDepreciation->Visible = FALSE; // Disable update for API request
			else
				$this->CumulativeDepreciation->setFormValue($val);
		}

		// Check field name 'AssetStatus' first before field var 'x_AssetStatus'
		$val = $CurrentForm->hasValue("AssetStatus") ? $CurrentForm->getValue("AssetStatus") : $CurrentForm->getValue("x_AssetStatus");
		if (!$this->AssetStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AssetStatus->setFormValue($val);
		}

		// Check field name 'ScrapValue' first before field var 'x_ScrapValue'
		$val = $CurrentForm->hasValue("ScrapValue") ? $CurrentForm->getValue("ScrapValue") : $CurrentForm->getValue("x_ScrapValue");
		if (!$this->ScrapValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ScrapValue->Visible = FALSE; // Disable update for API request
			else
				$this->ScrapValue->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->AssetCode->CurrentValue = $this->AssetCode->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->AssetTypeCode->CurrentValue = $this->AssetTypeCode->FormValue;
		$this->Supplier->CurrentValue = $this->Supplier->FormValue;
		$this->PurchasePrice->CurrentValue = $this->PurchasePrice->FormValue;
		$this->CurrencyCode->CurrentValue = $this->CurrencyCode->FormValue;
		$this->ConditionCode->CurrentValue = $this->ConditionCode->FormValue;
		$this->DateOfPurchase->CurrentValue = $this->DateOfPurchase->FormValue;
		$this->DateOfPurchase->CurrentValue = UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0);
		$this->AssetCapacity->CurrentValue = $this->AssetCapacity->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AssetDescription->CurrentValue = $this->AssetDescription->FormValue;
		$this->DateOfLastRevaluation->CurrentValue = $this->DateOfLastRevaluation->FormValue;
		$this->DateOfLastRevaluation->CurrentValue = UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0);
		$this->NewValue->CurrentValue = $this->NewValue->FormValue;
		$this->NameOfValuer->CurrentValue = $this->NameOfValuer->FormValue;
		$this->BookValue->CurrentValue = $this->BookValue->FormValue;
		$this->LastDepreciationDate->CurrentValue = $this->LastDepreciationDate->FormValue;
		$this->LastDepreciationDate->CurrentValue = UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0);
		$this->LastDepreciationAmount->CurrentValue = $this->LastDepreciationAmount->FormValue;
		$this->DepreciationRate->CurrentValue = $this->DepreciationRate->FormValue;
		$this->CumulativeDepreciation->CurrentValue = $this->CumulativeDepreciation->FormValue;
		$this->AssetStatus->CurrentValue = $this->AssetStatus->FormValue;
		$this->ScrapValue->CurrentValue = $this->ScrapValue->FormValue;
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
		$this->AssetCode->setDbValue($row['AssetCode']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->AssetTypeCode->setDbValue($row['AssetTypeCode']);
		$this->Supplier->setDbValue($row['Supplier']);
		$this->PurchasePrice->setDbValue($row['PurchasePrice']);
		$this->CurrencyCode->setDbValue($row['CurrencyCode']);
		$this->ConditionCode->setDbValue($row['ConditionCode']);
		$this->DateOfPurchase->setDbValue($row['DateOfPurchase']);
		$this->AssetCapacity->setDbValue($row['AssetCapacity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AssetDescription->setDbValue($row['AssetDescription']);
		$this->DateOfLastRevaluation->setDbValue($row['DateOfLastRevaluation']);
		$this->NewValue->setDbValue($row['NewValue']);
		$this->NameOfValuer->setDbValue($row['NameOfValuer']);
		$this->BookValue->setDbValue($row['BookValue']);
		$this->LastDepreciationDate->setDbValue($row['LastDepreciationDate']);
		$this->LastDepreciationAmount->setDbValue($row['LastDepreciationAmount']);
		$this->DepreciationRate->setDbValue($row['DepreciationRate']);
		$this->CumulativeDepreciation->setDbValue($row['CumulativeDepreciation']);
		$this->AssetStatus->setDbValue($row['AssetStatus']);
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->ScrapValue->setDbValue($row['ScrapValue']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['AssetCode'] = $this->AssetCode->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['AssetTypeCode'] = $this->AssetTypeCode->CurrentValue;
		$row['Supplier'] = $this->Supplier->CurrentValue;
		$row['PurchasePrice'] = $this->PurchasePrice->CurrentValue;
		$row['CurrencyCode'] = $this->CurrencyCode->CurrentValue;
		$row['ConditionCode'] = $this->ConditionCode->CurrentValue;
		$row['DateOfPurchase'] = $this->DateOfPurchase->CurrentValue;
		$row['AssetCapacity'] = $this->AssetCapacity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AssetDescription'] = $this->AssetDescription->CurrentValue;
		$row['DateOfLastRevaluation'] = $this->DateOfLastRevaluation->CurrentValue;
		$row['NewValue'] = $this->NewValue->CurrentValue;
		$row['NameOfValuer'] = $this->NameOfValuer->CurrentValue;
		$row['BookValue'] = $this->BookValue->CurrentValue;
		$row['LastDepreciationDate'] = $this->LastDepreciationDate->CurrentValue;
		$row['LastDepreciationAmount'] = $this->LastDepreciationAmount->CurrentValue;
		$row['DepreciationRate'] = $this->DepreciationRate->CurrentValue;
		$row['CumulativeDepreciation'] = $this->CumulativeDepreciation->CurrentValue;
		$row['AssetStatus'] = $this->AssetStatus->CurrentValue;
		$row['LastUserID'] = $this->LastUserID->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['ScrapValue'] = $this->ScrapValue->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("AssetCode")) != "")
			$this->AssetCode->OldValue = $this->getKey("AssetCode"); // AssetCode
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

		if ($this->PurchasePrice->FormValue == $this->PurchasePrice->CurrentValue && is_numeric(ConvertToFloatString($this->PurchasePrice->CurrentValue)))
			$this->PurchasePrice->CurrentValue = ConvertToFloatString($this->PurchasePrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AssetCapacity->FormValue == $this->AssetCapacity->CurrentValue && is_numeric(ConvertToFloatString($this->AssetCapacity->CurrentValue)))
			$this->AssetCapacity->CurrentValue = ConvertToFloatString($this->AssetCapacity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->NewValue->FormValue == $this->NewValue->CurrentValue && is_numeric(ConvertToFloatString($this->NewValue->CurrentValue)))
			$this->NewValue->CurrentValue = ConvertToFloatString($this->NewValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BookValue->FormValue == $this->BookValue->CurrentValue && is_numeric(ConvertToFloatString($this->BookValue->CurrentValue)))
			$this->BookValue->CurrentValue = ConvertToFloatString($this->BookValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LastDepreciationAmount->FormValue == $this->LastDepreciationAmount->CurrentValue && is_numeric(ConvertToFloatString($this->LastDepreciationAmount->CurrentValue)))
			$this->LastDepreciationAmount->CurrentValue = ConvertToFloatString($this->LastDepreciationAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DepreciationRate->FormValue == $this->DepreciationRate->CurrentValue && is_numeric(ConvertToFloatString($this->DepreciationRate->CurrentValue)))
			$this->DepreciationRate->CurrentValue = ConvertToFloatString($this->DepreciationRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->CumulativeDepreciation->FormValue == $this->CumulativeDepreciation->CurrentValue && is_numeric(ConvertToFloatString($this->CumulativeDepreciation->CurrentValue)))
			$this->CumulativeDepreciation->CurrentValue = ConvertToFloatString($this->CumulativeDepreciation->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ScrapValue->FormValue == $this->ScrapValue->CurrentValue && is_numeric(ConvertToFloatString($this->ScrapValue->CurrentValue)))
			$this->ScrapValue->CurrentValue = ConvertToFloatString($this->ScrapValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// AssetCode
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// AssetTypeCode
		// Supplier
		// PurchasePrice
		// CurrencyCode
		// ConditionCode
		// DateOfPurchase
		// AssetCapacity
		// UnitOfMeasure
		// AssetDescription
		// DateOfLastRevaluation
		// NewValue
		// NameOfValuer
		// BookValue
		// LastDepreciationDate
		// LastDepreciationAmount
		// DepreciationRate
		// CumulativeDepreciation
		// AssetStatus
		// LastUserID
		// LastUpdated
		// ScrapValue

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// AssetCode
			$this->AssetCode->ViewValue = $this->AssetCode->CurrentValue;
			$this->AssetCode->ViewCustomAttributes = "";

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

			// AssetTypeCode
			$curVal = strval($this->AssetTypeCode->CurrentValue);
			if ($curVal != "") {
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
				if ($this->AssetTypeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AssetTypeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->CurrentValue;
					}
				}
			} else {
				$this->AssetTypeCode->ViewValue = NULL;
			}
			$this->AssetTypeCode->ViewCustomAttributes = "";

			// Supplier
			$this->Supplier->ViewValue = $this->Supplier->CurrentValue;
			$this->Supplier->ViewCustomAttributes = "";

			// PurchasePrice
			$this->PurchasePrice->ViewValue = $this->PurchasePrice->CurrentValue;
			$this->PurchasePrice->ViewValue = FormatNumber($this->PurchasePrice->ViewValue, 2, -2, -2, -2);
			$this->PurchasePrice->CellCssStyle .= "text-align: right;";
			$this->PurchasePrice->ViewCustomAttributes = "";

			// CurrencyCode
			$curVal = strval($this->CurrencyCode->CurrentValue);
			if ($curVal != "") {
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
				if ($this->CurrencyCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CurrencyCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->CurrencyCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CurrencyCode->ViewValue = $this->CurrencyCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CurrencyCode->ViewValue = $this->CurrencyCode->CurrentValue;
					}
				}
			} else {
				$this->CurrencyCode->ViewValue = NULL;
			}
			$this->CurrencyCode->ViewCustomAttributes = "";

			// ConditionCode
			$curVal = strval($this->ConditionCode->CurrentValue);
			if ($curVal != "") {
				$this->ConditionCode->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
				if ($this->ConditionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ConditionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ConditionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ConditionCode->ViewValue = $this->ConditionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ConditionCode->ViewValue = $this->ConditionCode->CurrentValue;
					}
				}
			} else {
				$this->ConditionCode->ViewValue = NULL;
			}
			$this->ConditionCode->ViewCustomAttributes = "";

			// DateOfPurchase
			$this->DateOfPurchase->ViewValue = $this->DateOfPurchase->CurrentValue;
			$this->DateOfPurchase->ViewValue = FormatDateTime($this->DateOfPurchase->ViewValue, 0);
			$this->DateOfPurchase->ViewCustomAttributes = "";

			// AssetCapacity
			$this->AssetCapacity->ViewValue = $this->AssetCapacity->CurrentValue;
			$this->AssetCapacity->ViewValue = FormatNumber($this->AssetCapacity->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AssetCapacity->ViewCustomAttributes = "";

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

			// AssetDescription
			$this->AssetDescription->ViewValue = $this->AssetDescription->CurrentValue;
			$this->AssetDescription->ViewCustomAttributes = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->ViewValue = $this->DateOfLastRevaluation->CurrentValue;
			$this->DateOfLastRevaluation->ViewValue = FormatDateTime($this->DateOfLastRevaluation->ViewValue, 0);
			$this->DateOfLastRevaluation->ViewCustomAttributes = "";

			// NewValue
			$this->NewValue->ViewValue = $this->NewValue->CurrentValue;
			$this->NewValue->ViewValue = FormatNumber($this->NewValue->ViewValue, 2, -2, -2, -2);
			$this->NewValue->CellCssStyle .= "text-align: right;";
			$this->NewValue->ViewCustomAttributes = "";

			// NameOfValuer
			$this->NameOfValuer->ViewValue = $this->NameOfValuer->CurrentValue;
			$this->NameOfValuer->ViewCustomAttributes = "";

			// BookValue
			$this->BookValue->ViewValue = $this->BookValue->CurrentValue;
			$this->BookValue->ViewValue = FormatNumber($this->BookValue->ViewValue, 2, -2, -2, -2);
			$this->BookValue->CellCssStyle .= "text-align: right;";
			$this->BookValue->ViewCustomAttributes = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->ViewValue = $this->LastDepreciationDate->CurrentValue;
			$this->LastDepreciationDate->ViewValue = FormatDateTime($this->LastDepreciationDate->ViewValue, 0);
			$this->LastDepreciationDate->ViewCustomAttributes = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->ViewValue = $this->LastDepreciationAmount->CurrentValue;
			$this->LastDepreciationAmount->ViewValue = FormatNumber($this->LastDepreciationAmount->ViewValue, 2, -2, -2, -2);
			$this->LastDepreciationAmount->CellCssStyle .= "text-align: right;";
			$this->LastDepreciationAmount->ViewCustomAttributes = "";

			// DepreciationRate
			$this->DepreciationRate->ViewValue = $this->DepreciationRate->CurrentValue;
			$this->DepreciationRate->ViewValue = FormatPercent($this->DepreciationRate->ViewValue, 2, -2, -2, -2);
			$this->DepreciationRate->CellCssStyle .= "text-align: right;";
			$this->DepreciationRate->ViewCustomAttributes = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->ViewValue = $this->CumulativeDepreciation->CurrentValue;
			$this->CumulativeDepreciation->ViewValue = FormatNumber($this->CumulativeDepreciation->ViewValue, 2, -2, -2, -2);
			$this->CumulativeDepreciation->CellCssStyle .= "text-align: right;";
			$this->CumulativeDepreciation->ViewCustomAttributes = "";

			// AssetStatus
			$curVal = strval($this->AssetStatus->CurrentValue);
			if ($curVal != "") {
				$this->AssetStatus->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
				if ($this->AssetStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AssetStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AssetStatus->ViewValue = $this->AssetStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AssetStatus->ViewValue = $this->AssetStatus->CurrentValue;
					}
				}
			} else {
				$this->AssetStatus->ViewValue = NULL;
			}
			$this->AssetStatus->ViewCustomAttributes = "";

			// ScrapValue
			$this->ScrapValue->ViewValue = $this->ScrapValue->CurrentValue;
			$this->ScrapValue->ViewValue = FormatNumber($this->ScrapValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->ScrapValue->ViewCustomAttributes = "";

			// AssetCode
			$this->AssetCode->LinkCustomAttributes = "";
			$this->AssetCode->HrefValue = "";
			$this->AssetCode->TooltipValue = "";

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

			// AssetTypeCode
			$this->AssetTypeCode->LinkCustomAttributes = "";
			$this->AssetTypeCode->HrefValue = "";
			$this->AssetTypeCode->TooltipValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";
			$this->Supplier->TooltipValue = "";

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";
			$this->PurchasePrice->TooltipValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";
			$this->CurrencyCode->TooltipValue = "";

			// ConditionCode
			$this->ConditionCode->LinkCustomAttributes = "";
			$this->ConditionCode->HrefValue = "";
			$this->ConditionCode->TooltipValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";
			$this->DateOfPurchase->TooltipValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";
			$this->AssetCapacity->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";
			$this->AssetDescription->TooltipValue = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->LinkCustomAttributes = "";
			$this->DateOfLastRevaluation->HrefValue = "";
			$this->DateOfLastRevaluation->TooltipValue = "";

			// NewValue
			$this->NewValue->LinkCustomAttributes = "";
			$this->NewValue->HrefValue = "";
			$this->NewValue->TooltipValue = "";

			// NameOfValuer
			$this->NameOfValuer->LinkCustomAttributes = "";
			$this->NameOfValuer->HrefValue = "";
			$this->NameOfValuer->TooltipValue = "";

			// BookValue
			$this->BookValue->LinkCustomAttributes = "";
			$this->BookValue->HrefValue = "";
			$this->BookValue->TooltipValue = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->LinkCustomAttributes = "";
			$this->LastDepreciationDate->HrefValue = "";
			$this->LastDepreciationDate->TooltipValue = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->LinkCustomAttributes = "";
			$this->LastDepreciationAmount->HrefValue = "";
			$this->LastDepreciationAmount->TooltipValue = "";

			// DepreciationRate
			$this->DepreciationRate->LinkCustomAttributes = "";
			$this->DepreciationRate->HrefValue = "";
			$this->DepreciationRate->TooltipValue = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->LinkCustomAttributes = "";
			$this->CumulativeDepreciation->HrefValue = "";
			$this->CumulativeDepreciation->TooltipValue = "";

			// AssetStatus
			$this->AssetStatus->LinkCustomAttributes = "";
			$this->AssetStatus->HrefValue = "";
			$this->AssetStatus->TooltipValue = "";

			// ScrapValue
			$this->ScrapValue->LinkCustomAttributes = "";
			$this->ScrapValue->HrefValue = "";
			$this->ScrapValue->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// AssetCode
			$this->AssetCode->EditAttrs["class"] = "form-control";
			$this->AssetCode->EditCustomAttributes = "";
			if (!$this->AssetCode->Raw)
				$this->AssetCode->CurrentValue = HtmlDecode($this->AssetCode->CurrentValue);
			$this->AssetCode->EditValue = HtmlEncode($this->AssetCode->CurrentValue);
			$this->AssetCode->PlaceHolder = RemoveHtml($this->AssetCode->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
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
			} else {
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

			// AssetTypeCode
			$this->AssetTypeCode->EditAttrs["class"] = "form-control";
			$this->AssetTypeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetTypeCode->CurrentValue));
			if ($curVal != "")
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
			else
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->Lookup !== NULL && is_array($this->AssetTypeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetTypeCode->ViewValue !== NULL) { // Load from cache
				$this->AssetTypeCode->EditValue = array_values($this->AssetTypeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $this->AssetTypeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetTypeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetTypeCode->EditValue = $arwrk;
			}

			// Supplier
			$this->Supplier->EditAttrs["class"] = "form-control";
			$this->Supplier->EditCustomAttributes = "";
			if (!$this->Supplier->Raw)
				$this->Supplier->CurrentValue = HtmlDecode($this->Supplier->CurrentValue);
			$this->Supplier->EditValue = HtmlEncode($this->Supplier->CurrentValue);
			$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

			// PurchasePrice
			$this->PurchasePrice->EditAttrs["class"] = "form-control";
			$this->PurchasePrice->EditCustomAttributes = "";
			$this->PurchasePrice->EditValue = HtmlEncode($this->PurchasePrice->CurrentValue);
			$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());
			if (strval($this->PurchasePrice->EditValue) != "" && is_numeric($this->PurchasePrice->EditValue))
				$this->PurchasePrice->EditValue = FormatNumber($this->PurchasePrice->EditValue, -2, -2, -2, -2);
			

			// CurrencyCode
			$this->CurrencyCode->EditAttrs["class"] = "form-control";
			$this->CurrencyCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->CurrencyCode->CurrentValue));
			if ($curVal != "")
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
			else
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->Lookup !== NULL && is_array($this->CurrencyCode->Lookup->Options) ? $curVal : NULL;
			if ($this->CurrencyCode->ViewValue !== NULL) { // Load from cache
				$this->CurrencyCode->EditValue = array_values($this->CurrencyCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CurrencyCode`" . SearchString("=", $this->CurrencyCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->CurrencyCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CurrencyCode->EditValue = $arwrk;
			}

			// ConditionCode
			$this->ConditionCode->EditAttrs["class"] = "form-control";
			$this->ConditionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ConditionCode->CurrentValue));
			if ($curVal != "")
				$this->ConditionCode->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
			else
				$this->ConditionCode->ViewValue = $this->ConditionCode->Lookup !== NULL && is_array($this->ConditionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ConditionCode->ViewValue !== NULL) { // Load from cache
				$this->ConditionCode->EditValue = array_values($this->ConditionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ConditionCode`" . SearchString("=", $this->ConditionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ConditionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ConditionCode->EditValue = $arwrk;
			}

			// DateOfPurchase
			$this->DateOfPurchase->EditAttrs["class"] = "form-control";
			$this->DateOfPurchase->EditCustomAttributes = "";
			$this->DateOfPurchase->EditValue = HtmlEncode(FormatDateTime($this->DateOfPurchase->CurrentValue, 8));
			$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

			// AssetCapacity
			$this->AssetCapacity->EditAttrs["class"] = "form-control";
			$this->AssetCapacity->EditCustomAttributes = "";
			$this->AssetCapacity->EditValue = HtmlEncode($this->AssetCapacity->CurrentValue);
			$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());
			if (strval($this->AssetCapacity->EditValue) != "" && is_numeric($this->AssetCapacity->EditValue))
				$this->AssetCapacity->EditValue = FormatNumber($this->AssetCapacity->EditValue, -2, -1, -2, 0);
			

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

			// AssetDescription
			$this->AssetDescription->EditAttrs["class"] = "form-control";
			$this->AssetDescription->EditCustomAttributes = "";
			if (!$this->AssetDescription->Raw)
				$this->AssetDescription->CurrentValue = HtmlDecode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->EditValue = HtmlEncode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
			$this->DateOfLastRevaluation->EditCustomAttributes = "";
			$this->DateOfLastRevaluation->EditValue = HtmlEncode(FormatDateTime($this->DateOfLastRevaluation->CurrentValue, 8));
			$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

			// NewValue
			$this->NewValue->EditAttrs["class"] = "form-control";
			$this->NewValue->EditCustomAttributes = "";
			$this->NewValue->EditValue = HtmlEncode($this->NewValue->CurrentValue);
			$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());
			if (strval($this->NewValue->EditValue) != "" && is_numeric($this->NewValue->EditValue))
				$this->NewValue->EditValue = FormatNumber($this->NewValue->EditValue, -2, -2, -2, -2);
			

			// NameOfValuer
			$this->NameOfValuer->EditAttrs["class"] = "form-control";
			$this->NameOfValuer->EditCustomAttributes = "";
			if (!$this->NameOfValuer->Raw)
				$this->NameOfValuer->CurrentValue = HtmlDecode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->EditValue = HtmlEncode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

			// BookValue
			$this->BookValue->EditAttrs["class"] = "form-control";
			$this->BookValue->EditCustomAttributes = "";
			$this->BookValue->EditValue = HtmlEncode($this->BookValue->CurrentValue);
			$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());
			if (strval($this->BookValue->EditValue) != "" && is_numeric($this->BookValue->EditValue))
				$this->BookValue->EditValue = FormatNumber($this->BookValue->EditValue, -2, -2, -2, -2);
			

			// LastDepreciationDate
			$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
			$this->LastDepreciationDate->EditCustomAttributes = "";
			$this->LastDepreciationDate->EditValue = HtmlEncode(FormatDateTime($this->LastDepreciationDate->CurrentValue, 8));
			$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

			// LastDepreciationAmount
			$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
			$this->LastDepreciationAmount->EditCustomAttributes = "";
			$this->LastDepreciationAmount->EditValue = HtmlEncode($this->LastDepreciationAmount->CurrentValue);
			$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());
			if (strval($this->LastDepreciationAmount->EditValue) != "" && is_numeric($this->LastDepreciationAmount->EditValue))
				$this->LastDepreciationAmount->EditValue = FormatNumber($this->LastDepreciationAmount->EditValue, -2, -2, -2, -2);
			

			// DepreciationRate
			$this->DepreciationRate->EditAttrs["class"] = "form-control";
			$this->DepreciationRate->EditCustomAttributes = "";
			$this->DepreciationRate->EditValue = HtmlEncode($this->DepreciationRate->CurrentValue);
			$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());
			if (strval($this->DepreciationRate->EditValue) != "" && is_numeric($this->DepreciationRate->EditValue))
				$this->DepreciationRate->EditValue = FormatNumber($this->DepreciationRate->EditValue, -2, -1, -2, 0);
			

			// CumulativeDepreciation
			$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
			$this->CumulativeDepreciation->EditCustomAttributes = "";
			$this->CumulativeDepreciation->EditValue = HtmlEncode($this->CumulativeDepreciation->CurrentValue);
			$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());
			if (strval($this->CumulativeDepreciation->EditValue) != "" && is_numeric($this->CumulativeDepreciation->EditValue))
				$this->CumulativeDepreciation->EditValue = FormatNumber($this->CumulativeDepreciation->EditValue, -2, -2, -2, -2);
			

			// AssetStatus
			$this->AssetStatus->EditAttrs["class"] = "form-control";
			$this->AssetStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetStatus->CurrentValue));
			if ($curVal != "")
				$this->AssetStatus->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
			else
				$this->AssetStatus->ViewValue = $this->AssetStatus->Lookup !== NULL && is_array($this->AssetStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetStatus->ViewValue !== NULL) { // Load from cache
				$this->AssetStatus->EditValue = array_values($this->AssetStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $this->AssetStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetStatus->EditValue = $arwrk;
			}

			// ScrapValue
			$this->ScrapValue->EditAttrs["class"] = "form-control";
			$this->ScrapValue->EditCustomAttributes = "";
			$this->ScrapValue->EditValue = HtmlEncode($this->ScrapValue->CurrentValue);
			$this->ScrapValue->PlaceHolder = RemoveHtml($this->ScrapValue->caption());
			if (strval($this->ScrapValue->EditValue) != "" && is_numeric($this->ScrapValue->EditValue))
				$this->ScrapValue->EditValue = FormatNumber($this->ScrapValue->EditValue, -2, -1, -2, 0);
			

			// Add refer script
			// AssetCode

			$this->AssetCode->LinkCustomAttributes = "";
			$this->AssetCode->HrefValue = "";

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

			// AssetTypeCode
			$this->AssetTypeCode->LinkCustomAttributes = "";
			$this->AssetTypeCode->HrefValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";

			// ConditionCode
			$this->ConditionCode->LinkCustomAttributes = "";
			$this->ConditionCode->HrefValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->LinkCustomAttributes = "";
			$this->DateOfLastRevaluation->HrefValue = "";

			// NewValue
			$this->NewValue->LinkCustomAttributes = "";
			$this->NewValue->HrefValue = "";

			// NameOfValuer
			$this->NameOfValuer->LinkCustomAttributes = "";
			$this->NameOfValuer->HrefValue = "";

			// BookValue
			$this->BookValue->LinkCustomAttributes = "";
			$this->BookValue->HrefValue = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->LinkCustomAttributes = "";
			$this->LastDepreciationDate->HrefValue = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->LinkCustomAttributes = "";
			$this->LastDepreciationAmount->HrefValue = "";

			// DepreciationRate
			$this->DepreciationRate->LinkCustomAttributes = "";
			$this->DepreciationRate->HrefValue = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->LinkCustomAttributes = "";
			$this->CumulativeDepreciation->HrefValue = "";

			// AssetStatus
			$this->AssetStatus->LinkCustomAttributes = "";
			$this->AssetStatus->HrefValue = "";

			// ScrapValue
			$this->ScrapValue->LinkCustomAttributes = "";
			$this->ScrapValue->HrefValue = "";
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
		if ($this->AssetCode->Required) {
			if (!$this->AssetCode->IsDetailKey && $this->AssetCode->FormValue != NULL && $this->AssetCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetCode->caption(), $this->AssetCode->RequiredErrorMessage));
			}
		}
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
		if ($this->AssetTypeCode->Required) {
			if (!$this->AssetTypeCode->IsDetailKey && $this->AssetTypeCode->FormValue != NULL && $this->AssetTypeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetTypeCode->caption(), $this->AssetTypeCode->RequiredErrorMessage));
			}
		}
		if ($this->Supplier->Required) {
			if (!$this->Supplier->IsDetailKey && $this->Supplier->FormValue != NULL && $this->Supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Supplier->caption(), $this->Supplier->RequiredErrorMessage));
			}
		}
		if ($this->PurchasePrice->Required) {
			if (!$this->PurchasePrice->IsDetailKey && $this->PurchasePrice->FormValue != NULL && $this->PurchasePrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PurchasePrice->caption(), $this->PurchasePrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->PurchasePrice->FormValue)) {
			AddMessage($FormError, $this->PurchasePrice->errorMessage());
		}
		if ($this->CurrencyCode->Required) {
			if (!$this->CurrencyCode->IsDetailKey && $this->CurrencyCode->FormValue != NULL && $this->CurrencyCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrencyCode->caption(), $this->CurrencyCode->RequiredErrorMessage));
			}
		}
		if ($this->ConditionCode->Required) {
			if (!$this->ConditionCode->IsDetailKey && $this->ConditionCode->FormValue != NULL && $this->ConditionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ConditionCode->caption(), $this->ConditionCode->RequiredErrorMessage));
			}
		}
		if ($this->DateOfPurchase->Required) {
			if (!$this->DateOfPurchase->IsDetailKey && $this->DateOfPurchase->FormValue != NULL && $this->DateOfPurchase->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfPurchase->caption(), $this->DateOfPurchase->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfPurchase->FormValue)) {
			AddMessage($FormError, $this->DateOfPurchase->errorMessage());
		}
		if ($this->AssetCapacity->Required) {
			if (!$this->AssetCapacity->IsDetailKey && $this->AssetCapacity->FormValue != NULL && $this->AssetCapacity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetCapacity->caption(), $this->AssetCapacity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AssetCapacity->FormValue)) {
			AddMessage($FormError, $this->AssetCapacity->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AssetDescription->Required) {
			if (!$this->AssetDescription->IsDetailKey && $this->AssetDescription->FormValue != NULL && $this->AssetDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetDescription->caption(), $this->AssetDescription->RequiredErrorMessage));
			}
		}
		if ($this->DateOfLastRevaluation->Required) {
			if (!$this->DateOfLastRevaluation->IsDetailKey && $this->DateOfLastRevaluation->FormValue != NULL && $this->DateOfLastRevaluation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfLastRevaluation->caption(), $this->DateOfLastRevaluation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfLastRevaluation->FormValue)) {
			AddMessage($FormError, $this->DateOfLastRevaluation->errorMessage());
		}
		if ($this->NewValue->Required) {
			if (!$this->NewValue->IsDetailKey && $this->NewValue->FormValue != NULL && $this->NewValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewValue->caption(), $this->NewValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->NewValue->FormValue)) {
			AddMessage($FormError, $this->NewValue->errorMessage());
		}
		if ($this->NameOfValuer->Required) {
			if (!$this->NameOfValuer->IsDetailKey && $this->NameOfValuer->FormValue != NULL && $this->NameOfValuer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NameOfValuer->caption(), $this->NameOfValuer->RequiredErrorMessage));
			}
		}
		if ($this->BookValue->Required) {
			if (!$this->BookValue->IsDetailKey && $this->BookValue->FormValue != NULL && $this->BookValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BookValue->caption(), $this->BookValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BookValue->FormValue)) {
			AddMessage($FormError, $this->BookValue->errorMessage());
		}
		if ($this->LastDepreciationDate->Required) {
			if (!$this->LastDepreciationDate->IsDetailKey && $this->LastDepreciationDate->FormValue != NULL && $this->LastDepreciationDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastDepreciationDate->caption(), $this->LastDepreciationDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastDepreciationDate->FormValue)) {
			AddMessage($FormError, $this->LastDepreciationDate->errorMessage());
		}
		if ($this->LastDepreciationAmount->Required) {
			if (!$this->LastDepreciationAmount->IsDetailKey && $this->LastDepreciationAmount->FormValue != NULL && $this->LastDepreciationAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastDepreciationAmount->caption(), $this->LastDepreciationAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LastDepreciationAmount->FormValue)) {
			AddMessage($FormError, $this->LastDepreciationAmount->errorMessage());
		}
		if ($this->DepreciationRate->Required) {
			if (!$this->DepreciationRate->IsDetailKey && $this->DepreciationRate->FormValue != NULL && $this->DepreciationRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepreciationRate->caption(), $this->DepreciationRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DepreciationRate->FormValue)) {
			AddMessage($FormError, $this->DepreciationRate->errorMessage());
		}
		if ($this->CumulativeDepreciation->Required) {
			if (!$this->CumulativeDepreciation->IsDetailKey && $this->CumulativeDepreciation->FormValue != NULL && $this->CumulativeDepreciation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CumulativeDepreciation->caption(), $this->CumulativeDepreciation->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->CumulativeDepreciation->FormValue)) {
			AddMessage($FormError, $this->CumulativeDepreciation->errorMessage());
		}
		if ($this->AssetStatus->Required) {
			if (!$this->AssetStatus->IsDetailKey && $this->AssetStatus->FormValue != NULL && $this->AssetStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetStatus->caption(), $this->AssetStatus->RequiredErrorMessage));
			}
		}
		if ($this->ScrapValue->Required) {
			if (!$this->ScrapValue->IsDetailKey && $this->ScrapValue->FormValue != NULL && $this->ScrapValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ScrapValue->caption(), $this->ScrapValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ScrapValue->FormValue)) {
			AddMessage($FormError, $this->ScrapValue->errorMessage());
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

		// AssetCode
		$this->AssetCode->setDbValueDef($rsnew, $this->AssetCode->CurrentValue, "", FALSE);

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// AssetTypeCode
		$this->AssetTypeCode->setDbValueDef($rsnew, $this->AssetTypeCode->CurrentValue, NULL, FALSE);

		// Supplier
		$this->Supplier->setDbValueDef($rsnew, $this->Supplier->CurrentValue, NULL, FALSE);

		// PurchasePrice
		$this->PurchasePrice->setDbValueDef($rsnew, $this->PurchasePrice->CurrentValue, NULL, FALSE);

		// CurrencyCode
		$this->CurrencyCode->setDbValueDef($rsnew, $this->CurrencyCode->CurrentValue, NULL, strval($this->CurrencyCode->CurrentValue) == "");

		// ConditionCode
		$this->ConditionCode->setDbValueDef($rsnew, $this->ConditionCode->CurrentValue, NULL, FALSE);

		// DateOfPurchase
		$this->DateOfPurchase->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0), NULL, FALSE);

		// AssetCapacity
		$this->AssetCapacity->setDbValueDef($rsnew, $this->AssetCapacity->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// AssetDescription
		$this->AssetDescription->setDbValueDef($rsnew, $this->AssetDescription->CurrentValue, NULL, FALSE);

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0), NULL, FALSE);

		// NewValue
		$this->NewValue->setDbValueDef($rsnew, $this->NewValue->CurrentValue, NULL, FALSE);

		// NameOfValuer
		$this->NameOfValuer->setDbValueDef($rsnew, $this->NameOfValuer->CurrentValue, NULL, FALSE);

		// BookValue
		$this->BookValue->setDbValueDef($rsnew, $this->BookValue->CurrentValue, NULL, FALSE);

		// LastDepreciationDate
		$this->LastDepreciationDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0), NULL, FALSE);

		// LastDepreciationAmount
		$this->LastDepreciationAmount->setDbValueDef($rsnew, $this->LastDepreciationAmount->CurrentValue, NULL, FALSE);

		// DepreciationRate
		$this->DepreciationRate->setDbValueDef($rsnew, $this->DepreciationRate->CurrentValue, NULL, FALSE);

		// CumulativeDepreciation
		$this->CumulativeDepreciation->setDbValueDef($rsnew, $this->CumulativeDepreciation->CurrentValue, NULL, FALSE);

		// AssetStatus
		$this->AssetStatus->setDbValueDef($rsnew, $this->AssetStatus->CurrentValue, NULL, FALSE);

		// ScrapValue
		$this->ScrapValue->setDbValueDef($rsnew, $this->ScrapValue->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['AssetCode']) == "") {
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("assetlist.php"), "", $this->TableVar, TRUE);
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
				case "x_AssetTypeCode":
					break;
				case "x_CurrencyCode":
					break;
				case "x_ConditionCode":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_AssetStatus":
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
						case "x_AssetTypeCode":
							break;
						case "x_CurrencyCode":
							break;
						case "x_ConditionCode":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_AssetStatus":
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