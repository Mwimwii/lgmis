<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class property_search extends property
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'property';

	// Page object name
	public $PageObjName = "property_search";

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

		// Table object (property)
		if (!isset($GLOBALS["property"]) || get_class($GLOBALS["property"]) == PROJECT_NAMESPACE . "property") {
			$GLOBALS["property"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["property"];
		}

		// Table object (client)
		if (!isset($GLOBALS['client']))
			$GLOBALS['client'] = new client();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'property');

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
		global $property;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($property);
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
					if ($pageName == "propertyview.php")
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
			$key .= @$ar['ValuationNo'];
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
			$this->ValuationNo->Visible = FALSE;
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
					$this->terminate(GetUrl("propertylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->PropertyNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->PropertyGroup->setVisibility();
		$this->PropertyType->setVisibility();
		$this->Location->setVisibility();
		$this->PropertyStatus->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->LandExtentInHA->setVisibility();
		$this->RateableValue->setVisibility();
		$this->SupplementaryValue->setVisibility();
		$this->ExemptCode->setVisibility();
		$this->Improvements->setVisibility();
		$this->StreetAddress->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->Incumberance->setVisibility();
		$this->SubDivisionOf->setVisibility();
		$this->LastUpdatedBy->setVisibility();
		$this->LastUpdateDate->setVisibility();
		$this->ValuationNo->setVisibility();
		$this->LandValue->setVisibility();
		$this->ImprovementsValue->setVisibility();
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
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->ClientID);
		$this->setupLookupOptions($this->PropertyGroup);
		$this->setupLookupOptions($this->PropertyType);
		$this->setupLookupOptions($this->Location);
		$this->setupLookupOptions($this->PropertyUse);

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
					$srchStr = "propertylist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->PropertyNo); // PropertyNo
		$this->buildSearchUrl($srchUrl, $this->ClientSerNo); // ClientSerNo
		$this->buildSearchUrl($srchUrl, $this->ClientID); // ClientID
		$this->buildSearchUrl($srchUrl, $this->PropertyGroup); // PropertyGroup
		$this->buildSearchUrl($srchUrl, $this->PropertyType); // PropertyType
		$this->buildSearchUrl($srchUrl, $this->Location); // Location
		$this->buildSearchUrl($srchUrl, $this->PropertyStatus); // PropertyStatus
		$this->buildSearchUrl($srchUrl, $this->PropertyUse); // PropertyUse
		$this->buildSearchUrl($srchUrl, $this->LandExtentInHA); // LandExtentInHA
		$this->buildSearchUrl($srchUrl, $this->RateableValue); // RateableValue
		$this->buildSearchUrl($srchUrl, $this->SupplementaryValue); // SupplementaryValue
		$this->buildSearchUrl($srchUrl, $this->ExemptCode); // ExemptCode
		$this->buildSearchUrl($srchUrl, $this->Improvements); // Improvements
		$this->buildSearchUrl($srchUrl, $this->StreetAddress); // StreetAddress
		$this->buildSearchUrl($srchUrl, $this->Longitude); // Longitude
		$this->buildSearchUrl($srchUrl, $this->Latitude); // Latitude
		$this->buildSearchUrl($srchUrl, $this->Incumberance); // Incumberance
		$this->buildSearchUrl($srchUrl, $this->SubDivisionOf); // SubDivisionOf
		$this->buildSearchUrl($srchUrl, $this->LastUpdatedBy); // LastUpdatedBy
		$this->buildSearchUrl($srchUrl, $this->LastUpdateDate); // LastUpdateDate
		$this->buildSearchUrl($srchUrl, $this->ValuationNo); // ValuationNo
		$this->buildSearchUrl($srchUrl, $this->LandValue); // LandValue
		$this->buildSearchUrl($srchUrl, $this->ImprovementsValue); // ImprovementsValue
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
		if ($this->PropertyNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientSerNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PropertyGroup->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PropertyType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Location->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->Location->AdvancedSearch->SearchValue))
			$this->Location->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue);
		if (is_array($this->Location->AdvancedSearch->SearchValue2))
			$this->Location->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue2);
		if ($this->PropertyStatus->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PropertyUse->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue))
			$this->PropertyUse->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue);
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue2))
			$this->PropertyUse->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue2);
		if ($this->LandExtentInHA->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RateableValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SupplementaryValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ExemptCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Improvements->AdvancedSearch->post())
			$got = TRUE;
		if ($this->StreetAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Longitude->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Latitude->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Incumberance->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SubDivisionOf->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastUpdatedBy->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LastUpdateDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ValuationNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LandValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ImprovementsValue->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->LandExtentInHA->FormValue == $this->LandExtentInHA->CurrentValue && is_numeric(ConvertToFloatString($this->LandExtentInHA->CurrentValue)))
			$this->LandExtentInHA->CurrentValue = ConvertToFloatString($this->LandExtentInHA->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RateableValue->FormValue == $this->RateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->RateableValue->CurrentValue)))
			$this->RateableValue->CurrentValue = ConvertToFloatString($this->RateableValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SupplementaryValue->FormValue == $this->SupplementaryValue->CurrentValue && is_numeric(ConvertToFloatString($this->SupplementaryValue->CurrentValue)))
			$this->SupplementaryValue->CurrentValue = ConvertToFloatString($this->SupplementaryValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LandValue->FormValue == $this->LandValue->CurrentValue && is_numeric(ConvertToFloatString($this->LandValue->CurrentValue)))
			$this->LandValue->CurrentValue = ConvertToFloatString($this->LandValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ImprovementsValue->FormValue == $this->ImprovementsValue->CurrentValue && is_numeric(ConvertToFloatString($this->ImprovementsValue->CurrentValue)))
			$this->ImprovementsValue->CurrentValue = ConvertToFloatString($this->ImprovementsValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// PropertyNo
		// ClientSerNo
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// PropertyStatus
		// PropertyUse
		// LandExtentInHA
		// RateableValue
		// SupplementaryValue
		// ExemptCode
		// Improvements
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// SubDivisionOf
		// LastUpdatedBy
		// LastUpdateDate
		// ValuationNo
		// LandValue
		// ImprovementsValue

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PropertyNo
			$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
			$this->PropertyNo->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
					}
				}
			} else {
				$this->ClientSerNo->ViewValue = NULL;
			}
			$this->ClientSerNo->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$curVal = strval($this->ClientID->CurrentValue);
			if ($curVal != "") {
				$this->ClientID->ViewValue = $this->ClientID->lookupCacheOption($curVal);
				if ($this->ClientID->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientID`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ClientID->ViewValue = $this->ClientID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
					}
				}
			} else {
				$this->ClientID->ViewValue = NULL;
			}
			$this->ClientID->ViewCustomAttributes = "";

			// PropertyGroup
			$curVal = strval($this->PropertyGroup->CurrentValue);
			if ($curVal != "") {
				$this->PropertyGroup->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
				if ($this->PropertyGroup->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyGroup`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
					}
				}
			} else {
				$this->PropertyGroup->ViewValue = NULL;
			}
			$this->PropertyGroup->ViewCustomAttributes = "";

			// PropertyType
			$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
			$curVal = strval($this->PropertyType->CurrentValue);
			if ($curVal != "") {
				$this->PropertyType->ViewValue = $this->PropertyType->lookupCacheOption($curVal);
				if ($this->PropertyType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyType->ViewValue = $this->PropertyType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
					}
				}
			} else {
				$this->PropertyType->ViewValue = NULL;
			}
			$this->PropertyType->ViewCustomAttributes = "";

			// Location
			$curVal = strval($this->Location->CurrentValue);
			if ($curVal != "") {
				$this->Location->ViewValue = $this->Location->lookupCacheOption($curVal);
				if ($this->Location->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Location->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Location->ViewValue->add($this->Location->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Location->ViewValue = $this->Location->CurrentValue;
					}
				}
			} else {
				$this->Location->ViewValue = NULL;
			}
			$this->Location->ViewCustomAttributes = "";

			// PropertyStatus
			$this->PropertyStatus->ViewValue = $this->PropertyStatus->CurrentValue;
			$this->PropertyStatus->ViewCustomAttributes = "";

			// PropertyUse
			$curVal = strval($this->PropertyUse->CurrentValue);
			if ($curVal != "") {
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
				if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->PropertyUse->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->PropertyUse->ViewValue->add($this->PropertyUse->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
					}
				}
			} else {
				$this->PropertyUse->ViewValue = NULL;
			}
			$this->PropertyUse->ViewCustomAttributes = "";

			// LandExtentInHA
			$this->LandExtentInHA->ViewValue = $this->LandExtentInHA->CurrentValue;
			$this->LandExtentInHA->ViewValue = FormatNumber($this->LandExtentInHA->ViewValue, 4, -2, -2, -2);
			$this->LandExtentInHA->CellCssStyle .= "text-align: right;";
			$this->LandExtentInHA->ViewCustomAttributes = "";

			// RateableValue
			$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
			$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
			$this->RateableValue->CellCssStyle .= "text-align: right;";
			$this->RateableValue->ViewCustomAttributes = "";

			// SupplementaryValue
			$this->SupplementaryValue->ViewValue = $this->SupplementaryValue->CurrentValue;
			$this->SupplementaryValue->ViewValue = FormatNumber($this->SupplementaryValue->ViewValue, 2, -2, -2, -2);
			$this->SupplementaryValue->CellCssStyle .= "text-align: right;";
			$this->SupplementaryValue->ViewCustomAttributes = "";

			// ExemptCode
			$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
			$this->ExemptCode->ViewCustomAttributes = "";

			// Improvements
			$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
			$this->Improvements->ViewCustomAttributes = "";

			// StreetAddress
			$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
			$this->StreetAddress->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Longitude->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Latitude->ViewCustomAttributes = "";

			// Incumberance
			$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
			$this->Incumberance->ViewCustomAttributes = "";

			// SubDivisionOf
			$this->SubDivisionOf->ViewValue = $this->SubDivisionOf->CurrentValue;
			$this->SubDivisionOf->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// ValuationNo
			$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
			$this->ValuationNo->ViewCustomAttributes = "";

			// LandValue
			$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
			$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
			$this->LandValue->ViewCustomAttributes = "";

			// ImprovementsValue
			$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
			$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, 2, -2, -2, -2);
			$this->ImprovementsValue->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";
			$this->PropertyNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";
			$this->PropertyGroup->TooltipValue = "";

			// PropertyType
			$this->PropertyType->LinkCustomAttributes = "";
			$this->PropertyType->HrefValue = "";
			$this->PropertyType->TooltipValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";

			// PropertyStatus
			$this->PropertyStatus->LinkCustomAttributes = "";
			$this->PropertyStatus->HrefValue = "";
			$this->PropertyStatus->TooltipValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";

			// LandExtentInHA
			$this->LandExtentInHA->LinkCustomAttributes = "";
			$this->LandExtentInHA->HrefValue = "";
			$this->LandExtentInHA->TooltipValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";
			$this->RateableValue->TooltipValue = "";

			// SupplementaryValue
			$this->SupplementaryValue->LinkCustomAttributes = "";
			$this->SupplementaryValue->HrefValue = "";
			$this->SupplementaryValue->TooltipValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";
			$this->ExemptCode->TooltipValue = "";

			// Improvements
			$this->Improvements->LinkCustomAttributes = "";
			$this->Improvements->HrefValue = "";
			$this->Improvements->TooltipValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";
			$this->StreetAddress->TooltipValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";
			$this->Incumberance->TooltipValue = "";

			// SubDivisionOf
			$this->SubDivisionOf->LinkCustomAttributes = "";
			$this->SubDivisionOf->HrefValue = "";
			$this->SubDivisionOf->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";

			// ValuationNo
			$this->ValuationNo->LinkCustomAttributes = "";
			$this->ValuationNo->HrefValue = "";
			$this->ValuationNo->TooltipValue = "";

			// LandValue
			$this->LandValue->LinkCustomAttributes = "";
			$this->LandValue->HrefValue = "";
			$this->LandValue->TooltipValue = "";

			// ImprovementsValue
			$this->ImprovementsValue->LinkCustomAttributes = "";
			$this->ImprovementsValue->HrefValue = "";
			$this->ImprovementsValue->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			if (!$this->PropertyNo->Raw)
				$this->PropertyNo->AdvancedSearch->SearchValue = HtmlDecode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->AdvancedSearch->SearchValue);
			$curVal = strval($this->ClientSerNo->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ClientSerNo->EditValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ClientSerNo->EditValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ClientSerNo->EditValue = NULL;
			}
			$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->AdvancedSearch->SearchValue = HtmlDecode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->AdvancedSearch->SearchValue);
			$curVal = strval($this->ClientID->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ClientID->EditValue = $this->ClientID->lookupCacheOption($curVal);
				if ($this->ClientID->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ClientID`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ClientID->EditValue = $this->ClientID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientID->EditValue = HtmlEncode($this->ClientID->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ClientID->EditValue = NULL;
			}
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PropertyGroup
			$this->PropertyGroup->EditAttrs["class"] = "form-control";
			$this->PropertyGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyGroup->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PropertyGroup->AdvancedSearch->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
			else
				$this->PropertyGroup->AdvancedSearch->ViewValue = $this->PropertyGroup->Lookup !== NULL && is_array($this->PropertyGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyGroup->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PropertyGroup->EditValue = array_values($this->PropertyGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyGroup`" . SearchString("=", $this->PropertyGroup->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PropertyGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyGroup->EditValue = $arwrk;
			}

			// PropertyType
			$this->PropertyType->EditAttrs["class"] = "form-control";
			$this->PropertyType->EditCustomAttributes = "";
			$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->AdvancedSearch->SearchValue);
			$curVal = strval($this->PropertyType->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->PropertyType->EditValue = $this->PropertyType->lookupCacheOption($curVal);
				if ($this->PropertyType->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyType->EditValue = $this->PropertyType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->PropertyType->EditValue = NULL;
			}
			$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

			// Location
			$this->Location->EditCustomAttributes = "";
			$curVal = trim(strval($this->Location->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Location->AdvancedSearch->ViewValue = $this->Location->lookupCacheOption($curVal);
			else
				$this->Location->AdvancedSearch->ViewValue = $this->Location->Lookup !== NULL && is_array($this->Location->Lookup->Options) ? $curVal : NULL;
			if ($this->Location->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Location->EditValue = array_values($this->Location->Lookup->Options);
				if ($this->Location->AdvancedSearch->ViewValue == "")
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->Location->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Location->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Location->AdvancedSearch->ViewValue->add($this->Location->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Location->EditValue = $arwrk;
			}

			// PropertyStatus
			$this->PropertyStatus->EditAttrs["class"] = "form-control";
			$this->PropertyStatus->EditCustomAttributes = "";
			$this->PropertyStatus->EditValue = HtmlEncode($this->PropertyStatus->AdvancedSearch->SearchValue);
			$this->PropertyStatus->PlaceHolder = RemoveHtml($this->PropertyStatus->caption());

			// PropertyUse
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
				if ($this->PropertyUse->AdvancedSearch->ViewValue == "")
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->PropertyUse->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyUse->AdvancedSearch->ViewValue->add($this->PropertyUse->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// LandExtentInHA
			$this->LandExtentInHA->EditAttrs["class"] = "form-control";
			$this->LandExtentInHA->EditCustomAttributes = "";
			$this->LandExtentInHA->EditValue = HtmlEncode($this->LandExtentInHA->AdvancedSearch->SearchValue);
			$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->AdvancedSearch->SearchValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue2 = HtmlEncode($this->RateableValue->AdvancedSearch->SearchValue2);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());

			// SupplementaryValue
			$this->SupplementaryValue->EditAttrs["class"] = "form-control";
			$this->SupplementaryValue->EditCustomAttributes = "";
			$this->SupplementaryValue->EditValue = HtmlEncode($this->SupplementaryValue->AdvancedSearch->SearchValue);
			$this->SupplementaryValue->PlaceHolder = RemoveHtml($this->SupplementaryValue->caption());

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			if (!$this->ExemptCode->Raw)
				$this->ExemptCode->AdvancedSearch->SearchValue = HtmlDecode($this->ExemptCode->AdvancedSearch->SearchValue);
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->AdvancedSearch->SearchValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// Improvements
			$this->Improvements->EditAttrs["class"] = "form-control";
			$this->Improvements->EditCustomAttributes = "";
			$this->Improvements->EditValue = HtmlEncode($this->Improvements->AdvancedSearch->SearchValue);
			$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->AdvancedSearch->SearchValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->AdvancedSearch->SearchValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->AdvancedSearch->SearchValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->AdvancedSearch->SearchValue = HtmlDecode($this->Incumberance->AdvancedSearch->SearchValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->AdvancedSearch->SearchValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// SubDivisionOf
			$this->SubDivisionOf->EditAttrs["class"] = "form-control";
			$this->SubDivisionOf->EditCustomAttributes = "";
			$this->SubDivisionOf->EditValue = HtmlEncode($this->SubDivisionOf->AdvancedSearch->SearchValue);
			$this->SubDivisionOf->PlaceHolder = RemoveHtml($this->SubDivisionOf->caption());

			// LastUpdatedBy
			$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
			$this->LastUpdatedBy->EditCustomAttributes = "";
			if (!$this->LastUpdatedBy->Raw)
				$this->LastUpdatedBy->AdvancedSearch->SearchValue = HtmlDecode($this->LastUpdatedBy->AdvancedSearch->SearchValue);
			$this->LastUpdatedBy->EditValue = HtmlEncode($this->LastUpdatedBy->AdvancedSearch->SearchValue);
			$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

			// LastUpdateDate
			$this->LastUpdateDate->EditAttrs["class"] = "form-control";
			$this->LastUpdateDate->EditCustomAttributes = "";
			$this->LastUpdateDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LastUpdateDate->AdvancedSearch->SearchValue, 0), 8));
			$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

			// ValuationNo
			$this->ValuationNo->EditAttrs["class"] = "form-control";
			$this->ValuationNo->EditCustomAttributes = "";
			$this->ValuationNo->EditValue = HtmlEncode($this->ValuationNo->AdvancedSearch->SearchValue);
			$this->ValuationNo->PlaceHolder = RemoveHtml($this->ValuationNo->caption());

			// LandValue
			$this->LandValue->EditAttrs["class"] = "form-control";
			$this->LandValue->EditCustomAttributes = "";
			$this->LandValue->EditValue = HtmlEncode($this->LandValue->AdvancedSearch->SearchValue);
			$this->LandValue->PlaceHolder = RemoveHtml($this->LandValue->caption());

			// ImprovementsValue
			$this->ImprovementsValue->EditAttrs["class"] = "form-control";
			$this->ImprovementsValue->EditCustomAttributes = "";
			$this->ImprovementsValue->EditValue = HtmlEncode($this->ImprovementsValue->AdvancedSearch->SearchValue);
			$this->ImprovementsValue->PlaceHolder = RemoveHtml($this->ImprovementsValue->caption());
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
		if (!CheckInteger($this->ClientSerNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ClientSerNo->errorMessage());
		}
		if (!CheckInteger($this->PropertyType->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PropertyType->errorMessage());
		}
		if (!CheckInteger($this->PropertyStatus->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PropertyStatus->errorMessage());
		}
		if (!CheckNumber($this->LandExtentInHA->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LandExtentInHA->errorMessage());
		}
		if (!CheckNumber($this->RateableValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->RateableValue->errorMessage());
		}
		if (!CheckNumber($this->RateableValue->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->RateableValue->errorMessage());
		}
		if (!CheckNumber($this->SupplementaryValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->SupplementaryValue->errorMessage());
		}
		if (!CheckInteger($this->ExemptCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ExemptCode->errorMessage());
		}
		if (!CheckNumber($this->Longitude->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Longitude->errorMessage());
		}
		if (!CheckNumber($this->Latitude->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Latitude->errorMessage());
		}
		if (!CheckInteger($this->SubDivisionOf->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->SubDivisionOf->errorMessage());
		}
		if (!CheckDate($this->LastUpdateDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LastUpdateDate->errorMessage());
		}
		if (!CheckInteger($this->ValuationNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ValuationNo->errorMessage());
		}
		if (!CheckNumber($this->LandValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LandValue->errorMessage());
		}
		if (!CheckNumber($this->ImprovementsValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ImprovementsValue->errorMessage());
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
		$this->PropertyNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PropertyGroup->AdvancedSearch->load();
		$this->PropertyType->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->PropertyStatus->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->LandExtentInHA->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->SupplementaryValue->AdvancedSearch->load();
		$this->ExemptCode->AdvancedSearch->load();
		$this->Improvements->AdvancedSearch->load();
		$this->StreetAddress->AdvancedSearch->load();
		$this->Longitude->AdvancedSearch->load();
		$this->Latitude->AdvancedSearch->load();
		$this->Incumberance->AdvancedSearch->load();
		$this->SubDivisionOf->AdvancedSearch->load();
		$this->LastUpdatedBy->AdvancedSearch->load();
		$this->LastUpdateDate->AdvancedSearch->load();
		$this->ValuationNo->AdvancedSearch->load();
		$this->LandValue->AdvancedSearch->load();
		$this->ImprovementsValue->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("propertylist.php"), "", $this->TableVar, TRUE);
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
				case "x_ClientSerNo":
					break;
				case "x_ClientID":
					break;
				case "x_PropertyGroup":
					break;
				case "x_PropertyType":
					break;
				case "x_Location":
					break;
				case "x_PropertyUse":
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
						case "x_ClientSerNo":
							break;
						case "x_ClientID":
							break;
						case "x_PropertyGroup":
							break;
						case "x_PropertyType":
							break;
						case "x_Location":
							break;
						case "x_PropertyUse":
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