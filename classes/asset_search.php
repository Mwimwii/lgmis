<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class asset_search extends asset
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'asset';

	// Page object name
	public $PageObjName = "asset_search";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
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
			if (!$Security->canSearch()) {
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "assetlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->AssetCode); // AssetCode
		$this->buildSearchUrl($srchUrl, $this->ProvinceCode); // ProvinceCode
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->DepartmentCode); // DepartmentCode
		$this->buildSearchUrl($srchUrl, $this->SectionCode); // SectionCode
		$this->buildSearchUrl($srchUrl, $this->AssetTypeCode); // AssetTypeCode
		$this->buildSearchUrl($srchUrl, $this->Supplier); // Supplier
		$this->buildSearchUrl($srchUrl, $this->PurchasePrice); // PurchasePrice
		$this->buildSearchUrl($srchUrl, $this->CurrencyCode); // CurrencyCode
		$this->buildSearchUrl($srchUrl, $this->ConditionCode); // ConditionCode
		$this->buildSearchUrl($srchUrl, $this->DateOfPurchase); // DateOfPurchase
		$this->buildSearchUrl($srchUrl, $this->AssetCapacity); // AssetCapacity
		$this->buildSearchUrl($srchUrl, $this->UnitOfMeasure); // UnitOfMeasure
		$this->buildSearchUrl($srchUrl, $this->AssetDescription); // AssetDescription
		$this->buildSearchUrl($srchUrl, $this->DateOfLastRevaluation); // DateOfLastRevaluation
		$this->buildSearchUrl($srchUrl, $this->NewValue); // NewValue
		$this->buildSearchUrl($srchUrl, $this->NameOfValuer); // NameOfValuer
		$this->buildSearchUrl($srchUrl, $this->BookValue); // BookValue
		$this->buildSearchUrl($srchUrl, $this->LastDepreciationDate); // LastDepreciationDate
		$this->buildSearchUrl($srchUrl, $this->LastDepreciationAmount); // LastDepreciationAmount
		$this->buildSearchUrl($srchUrl, $this->DepreciationRate); // DepreciationRate
		$this->buildSearchUrl($srchUrl, $this->CumulativeDepreciation); // CumulativeDepreciation
		$this->buildSearchUrl($srchUrl, $this->AssetStatus); // AssetStatus
		$this->buildSearchUrl($srchUrl, $this->ScrapValue); // ScrapValue
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->AssetCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProvinceCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DepartmentCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SectionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AssetTypeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Supplier->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PurchasePrice->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CurrencyCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ConditionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DateOfPurchase->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AssetCapacity->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AssetDescription->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DateOfLastRevaluation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NewValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->NameOfValuer->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BookValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastDepreciationDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastDepreciationAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DepreciationRate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CumulativeDepreciation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AssetStatus->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ScrapValue->AdvancedSearch->post())
			$got = TRUE;
		return $got;
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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// AssetCode
			$this->AssetCode->EditAttrs["class"] = "form-control";
			$this->AssetCode->EditCustomAttributes = "";
			if (!$this->AssetCode->Raw)
				$this->AssetCode->AdvancedSearch->SearchValue = HtmlDecode($this->AssetCode->AdvancedSearch->SearchValue);
			$this->AssetCode->EditValue = HtmlEncode($this->AssetCode->AdvancedSearch->SearchValue);
			$this->AssetCode->PlaceHolder = RemoveHtml($this->AssetCode->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->ProvinceCode->AdvancedSearch->SearchValue);
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
						$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ProvinceCode->EditValue = NULL;
			}
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->SectionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->AssetTypeCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AssetTypeCode->AdvancedSearch->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
			else
				$this->AssetTypeCode->AdvancedSearch->ViewValue = $this->AssetTypeCode->Lookup !== NULL && is_array($this->AssetTypeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetTypeCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AssetTypeCode->EditValue = array_values($this->AssetTypeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $this->AssetTypeCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
				$this->Supplier->AdvancedSearch->SearchValue = HtmlDecode($this->Supplier->AdvancedSearch->SearchValue);
			$this->Supplier->EditValue = HtmlEncode($this->Supplier->AdvancedSearch->SearchValue);
			$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

			// PurchasePrice
			$this->PurchasePrice->EditAttrs["class"] = "form-control";
			$this->PurchasePrice->EditCustomAttributes = "";
			$this->PurchasePrice->EditValue = HtmlEncode($this->PurchasePrice->AdvancedSearch->SearchValue);
			$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());

			// CurrencyCode
			$this->CurrencyCode->EditAttrs["class"] = "form-control";
			$this->CurrencyCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->CurrencyCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->CurrencyCode->AdvancedSearch->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
			else
				$this->CurrencyCode->AdvancedSearch->ViewValue = $this->CurrencyCode->Lookup !== NULL && is_array($this->CurrencyCode->Lookup->Options) ? $curVal : NULL;
			if ($this->CurrencyCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->CurrencyCode->EditValue = array_values($this->CurrencyCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CurrencyCode`" . SearchString("=", $this->CurrencyCode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->ConditionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ConditionCode->AdvancedSearch->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
			else
				$this->ConditionCode->AdvancedSearch->ViewValue = $this->ConditionCode->Lookup !== NULL && is_array($this->ConditionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ConditionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ConditionCode->EditValue = array_values($this->ConditionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ConditionCode`" . SearchString("=", $this->ConditionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$this->DateOfPurchase->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfPurchase->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

			// AssetCapacity
			$this->AssetCapacity->EditAttrs["class"] = "form-control";
			$this->AssetCapacity->EditCustomAttributes = "";
			$this->AssetCapacity->EditValue = HtmlEncode($this->AssetCapacity->AdvancedSearch->SearchValue);
			$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->UnitOfMeasure->AdvancedSearch->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->AdvancedSearch->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
				$this->AssetDescription->AdvancedSearch->SearchValue = HtmlDecode($this->AssetDescription->AdvancedSearch->SearchValue);
			$this->AssetDescription->EditValue = HtmlEncode($this->AssetDescription->AdvancedSearch->SearchValue);
			$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
			$this->DateOfLastRevaluation->EditCustomAttributes = "";
			$this->DateOfLastRevaluation->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfLastRevaluation->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

			// NewValue
			$this->NewValue->EditAttrs["class"] = "form-control";
			$this->NewValue->EditCustomAttributes = "";
			$this->NewValue->EditValue = HtmlEncode($this->NewValue->AdvancedSearch->SearchValue);
			$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());

			// NameOfValuer
			$this->NameOfValuer->EditAttrs["class"] = "form-control";
			$this->NameOfValuer->EditCustomAttributes = "";
			if (!$this->NameOfValuer->Raw)
				$this->NameOfValuer->AdvancedSearch->SearchValue = HtmlDecode($this->NameOfValuer->AdvancedSearch->SearchValue);
			$this->NameOfValuer->EditValue = HtmlEncode($this->NameOfValuer->AdvancedSearch->SearchValue);
			$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

			// BookValue
			$this->BookValue->EditAttrs["class"] = "form-control";
			$this->BookValue->EditCustomAttributes = "";
			$this->BookValue->EditValue = HtmlEncode($this->BookValue->AdvancedSearch->SearchValue);
			$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());

			// LastDepreciationDate
			$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
			$this->LastDepreciationDate->EditCustomAttributes = "";
			$this->LastDepreciationDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LastDepreciationDate->AdvancedSearch->SearchValue, 0), 8));
			$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

			// LastDepreciationAmount
			$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
			$this->LastDepreciationAmount->EditCustomAttributes = "";
			$this->LastDepreciationAmount->EditValue = HtmlEncode($this->LastDepreciationAmount->AdvancedSearch->SearchValue);
			$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());

			// DepreciationRate
			$this->DepreciationRate->EditAttrs["class"] = "form-control";
			$this->DepreciationRate->EditCustomAttributes = "";
			$this->DepreciationRate->EditValue = HtmlEncode($this->DepreciationRate->AdvancedSearch->SearchValue);
			$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());

			// CumulativeDepreciation
			$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
			$this->CumulativeDepreciation->EditCustomAttributes = "";
			$this->CumulativeDepreciation->EditValue = HtmlEncode($this->CumulativeDepreciation->AdvancedSearch->SearchValue);
			$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());

			// AssetStatus
			$this->AssetStatus->EditAttrs["class"] = "form-control";
			$this->AssetStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetStatus->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AssetStatus->AdvancedSearch->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
			else
				$this->AssetStatus->AdvancedSearch->ViewValue = $this->AssetStatus->Lookup !== NULL && is_array($this->AssetStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetStatus->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AssetStatus->EditValue = array_values($this->AssetStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $this->AssetStatus->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$this->ScrapValue->EditValue = HtmlEncode($this->ScrapValue->AdvancedSearch->SearchValue);
			$this->ScrapValue->PlaceHolder = RemoveHtml($this->ScrapValue->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->ProvinceCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ProvinceCode->errorMessage());
		}
		if (!CheckNumber($this->PurchasePrice->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PurchasePrice->errorMessage());
		}
		if (!CheckDate($this->DateOfPurchase->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DateOfPurchase->errorMessage());
		}
		if (!CheckNumber($this->AssetCapacity->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AssetCapacity->errorMessage());
		}
		if (!CheckDate($this->DateOfLastRevaluation->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DateOfLastRevaluation->errorMessage());
		}
		if (!CheckNumber($this->NewValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->NewValue->errorMessage());
		}
		if (!CheckNumber($this->BookValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BookValue->errorMessage());
		}
		if (!CheckDate($this->LastDepreciationDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LastDepreciationDate->errorMessage());
		}
		if (!CheckNumber($this->LastDepreciationAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LastDepreciationAmount->errorMessage());
		}
		if (!CheckNumber($this->DepreciationRate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DepreciationRate->errorMessage());
		}
		if (!CheckNumber($this->CumulativeDepreciation->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->CumulativeDepreciation->errorMessage());
		}
		if (!CheckNumber($this->ScrapValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ScrapValue->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->AssetCode->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->AssetTypeCode->AdvancedSearch->load();
		$this->Supplier->AdvancedSearch->load();
		$this->PurchasePrice->AdvancedSearch->load();
		$this->CurrencyCode->AdvancedSearch->load();
		$this->ConditionCode->AdvancedSearch->load();
		$this->DateOfPurchase->AdvancedSearch->load();
		$this->AssetCapacity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AssetDescription->AdvancedSearch->load();
		$this->DateOfLastRevaluation->AdvancedSearch->load();
		$this->NewValue->AdvancedSearch->load();
		$this->NameOfValuer->AdvancedSearch->load();
		$this->BookValue->AdvancedSearch->load();
		$this->LastDepreciationDate->AdvancedSearch->load();
		$this->LastDepreciationAmount->AdvancedSearch->load();
		$this->DepreciationRate->AdvancedSearch->load();
		$this->CumulativeDepreciation->AdvancedSearch->load();
		$this->AssetStatus->AdvancedSearch->load();
		$this->ScrapValue->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("assetlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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