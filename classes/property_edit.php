<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class property_edit extends property
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'property';

	// Page object name
	public $PageObjName = "property_edit";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("propertylist.php");
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
			if (Get("ValuationNo") !== NULL) {
				$this->ValuationNo->setQueryStringValue(Get("ValuationNo"));
				$this->ValuationNo->setOldValue($this->ValuationNo->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ValuationNo->setQueryStringValue(Key(0));
				$this->ValuationNo->setOldValue($this->ValuationNo->QueryStringValue);
			} elseif (Post("ValuationNo") !== NULL) {
				$this->ValuationNo->setFormValue(Post("ValuationNo"));
				$this->ValuationNo->setOldValue($this->ValuationNo->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ValuationNo->setQueryStringValue(Route(2));
				$this->ValuationNo->setOldValue($this->ValuationNo->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_ValuationNo")) {
					$this->ValuationNo->setFormValue($CurrentForm->getValue("x_ValuationNo"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ValuationNo") !== NULL) {
					$this->ValuationNo->setQueryStringValue(Get("ValuationNo"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ValuationNo->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ValuationNo->CurrentValue = NULL;
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
				$this->terminate("propertylist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->ValuationNo->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->ValuationNo->CurrentValue, $rs->fields('ValuationNo'))) {
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
					$this->terminate("propertylist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "propertylist.php")
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

		// Check field name 'PropertyNo' first before field var 'x_PropertyNo'
		$val = $CurrentForm->hasValue("PropertyNo") ? $CurrentForm->getValue("PropertyNo") : $CurrentForm->getValue("x_PropertyNo");
		if (!$this->PropertyNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyNo->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyNo->setFormValue($val);
		}

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'PropertyGroup' first before field var 'x_PropertyGroup'
		$val = $CurrentForm->hasValue("PropertyGroup") ? $CurrentForm->getValue("PropertyGroup") : $CurrentForm->getValue("x_PropertyGroup");
		if (!$this->PropertyGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyGroup->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyGroup->setFormValue($val);
		}

		// Check field name 'PropertyType' first before field var 'x_PropertyType'
		$val = $CurrentForm->hasValue("PropertyType") ? $CurrentForm->getValue("PropertyType") : $CurrentForm->getValue("x_PropertyType");
		if (!$this->PropertyType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyType->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyType->setFormValue($val);
		}

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}

		// Check field name 'PropertyStatus' first before field var 'x_PropertyStatus'
		$val = $CurrentForm->hasValue("PropertyStatus") ? $CurrentForm->getValue("PropertyStatus") : $CurrentForm->getValue("x_PropertyStatus");
		if (!$this->PropertyStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyStatus->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyStatus->setFormValue($val);
		}

		// Check field name 'PropertyUse' first before field var 'x_PropertyUse'
		$val = $CurrentForm->hasValue("PropertyUse") ? $CurrentForm->getValue("PropertyUse") : $CurrentForm->getValue("x_PropertyUse");
		if (!$this->PropertyUse->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyUse->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyUse->setFormValue($val);
		}

		// Check field name 'LandExtentInHA' first before field var 'x_LandExtentInHA'
		$val = $CurrentForm->hasValue("LandExtentInHA") ? $CurrentForm->getValue("LandExtentInHA") : $CurrentForm->getValue("x_LandExtentInHA");
		if (!$this->LandExtentInHA->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LandExtentInHA->Visible = FALSE; // Disable update for API request
			else
				$this->LandExtentInHA->setFormValue($val);
		}

		// Check field name 'RateableValue' first before field var 'x_RateableValue'
		$val = $CurrentForm->hasValue("RateableValue") ? $CurrentForm->getValue("RateableValue") : $CurrentForm->getValue("x_RateableValue");
		if (!$this->RateableValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RateableValue->Visible = FALSE; // Disable update for API request
			else
				$this->RateableValue->setFormValue($val);
		}

		// Check field name 'SupplementaryValue' first before field var 'x_SupplementaryValue'
		$val = $CurrentForm->hasValue("SupplementaryValue") ? $CurrentForm->getValue("SupplementaryValue") : $CurrentForm->getValue("x_SupplementaryValue");
		if (!$this->SupplementaryValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SupplementaryValue->Visible = FALSE; // Disable update for API request
			else
				$this->SupplementaryValue->setFormValue($val);
		}

		// Check field name 'ExemptCode' first before field var 'x_ExemptCode'
		$val = $CurrentForm->hasValue("ExemptCode") ? $CurrentForm->getValue("ExemptCode") : $CurrentForm->getValue("x_ExemptCode");
		if (!$this->ExemptCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExemptCode->Visible = FALSE; // Disable update for API request
			else
				$this->ExemptCode->setFormValue($val);
		}

		// Check field name 'Improvements' first before field var 'x_Improvements'
		$val = $CurrentForm->hasValue("Improvements") ? $CurrentForm->getValue("Improvements") : $CurrentForm->getValue("x_Improvements");
		if (!$this->Improvements->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Improvements->Visible = FALSE; // Disable update for API request
			else
				$this->Improvements->setFormValue($val);
		}

		// Check field name 'StreetAddress' first before field var 'x_StreetAddress'
		$val = $CurrentForm->hasValue("StreetAddress") ? $CurrentForm->getValue("StreetAddress") : $CurrentForm->getValue("x_StreetAddress");
		if (!$this->StreetAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StreetAddress->Visible = FALSE; // Disable update for API request
			else
				$this->StreetAddress->setFormValue($val);
		}

		// Check field name 'Longitude' first before field var 'x_Longitude'
		$val = $CurrentForm->hasValue("Longitude") ? $CurrentForm->getValue("Longitude") : $CurrentForm->getValue("x_Longitude");
		if (!$this->Longitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Longitude->Visible = FALSE; // Disable update for API request
			else
				$this->Longitude->setFormValue($val);
		}

		// Check field name 'Latitude' first before field var 'x_Latitude'
		$val = $CurrentForm->hasValue("Latitude") ? $CurrentForm->getValue("Latitude") : $CurrentForm->getValue("x_Latitude");
		if (!$this->Latitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Latitude->Visible = FALSE; // Disable update for API request
			else
				$this->Latitude->setFormValue($val);
		}

		// Check field name 'Incumberance' first before field var 'x_Incumberance'
		$val = $CurrentForm->hasValue("Incumberance") ? $CurrentForm->getValue("Incumberance") : $CurrentForm->getValue("x_Incumberance");
		if (!$this->Incumberance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Incumberance->Visible = FALSE; // Disable update for API request
			else
				$this->Incumberance->setFormValue($val);
		}

		// Check field name 'SubDivisionOf' first before field var 'x_SubDivisionOf'
		$val = $CurrentForm->hasValue("SubDivisionOf") ? $CurrentForm->getValue("SubDivisionOf") : $CurrentForm->getValue("x_SubDivisionOf");
		if (!$this->SubDivisionOf->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SubDivisionOf->Visible = FALSE; // Disable update for API request
			else
				$this->SubDivisionOf->setFormValue($val);
		}

		// Check field name 'LastUpdatedBy' first before field var 'x_LastUpdatedBy'
		$val = $CurrentForm->hasValue("LastUpdatedBy") ? $CurrentForm->getValue("LastUpdatedBy") : $CurrentForm->getValue("x_LastUpdatedBy");
		if (!$this->LastUpdatedBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastUpdatedBy->Visible = FALSE; // Disable update for API request
			else
				$this->LastUpdatedBy->setFormValue($val);
		}

		// Check field name 'LastUpdateDate' first before field var 'x_LastUpdateDate'
		$val = $CurrentForm->hasValue("LastUpdateDate") ? $CurrentForm->getValue("LastUpdateDate") : $CurrentForm->getValue("x_LastUpdateDate");
		if (!$this->LastUpdateDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastUpdateDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastUpdateDate->setFormValue($val);
			$this->LastUpdateDate->CurrentValue = UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0);
		}

		// Check field name 'ValuationNo' first before field var 'x_ValuationNo'
		$val = $CurrentForm->hasValue("ValuationNo") ? $CurrentForm->getValue("ValuationNo") : $CurrentForm->getValue("x_ValuationNo");
		if (!$this->ValuationNo->IsDetailKey)
			$this->ValuationNo->setFormValue($val);

		// Check field name 'LandValue' first before field var 'x_LandValue'
		$val = $CurrentForm->hasValue("LandValue") ? $CurrentForm->getValue("LandValue") : $CurrentForm->getValue("x_LandValue");
		if (!$this->LandValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LandValue->Visible = FALSE; // Disable update for API request
			else
				$this->LandValue->setFormValue($val);
		}

		// Check field name 'ImprovementsValue' first before field var 'x_ImprovementsValue'
		$val = $CurrentForm->hasValue("ImprovementsValue") ? $CurrentForm->getValue("ImprovementsValue") : $CurrentForm->getValue("x_ImprovementsValue");
		if (!$this->ImprovementsValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ImprovementsValue->Visible = FALSE; // Disable update for API request
			else
				$this->ImprovementsValue->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PropertyNo->CurrentValue = $this->PropertyNo->FormValue;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->PropertyGroup->CurrentValue = $this->PropertyGroup->FormValue;
		$this->PropertyType->CurrentValue = $this->PropertyType->FormValue;
		$this->Location->CurrentValue = $this->Location->FormValue;
		$this->PropertyStatus->CurrentValue = $this->PropertyStatus->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
		$this->LandExtentInHA->CurrentValue = $this->LandExtentInHA->FormValue;
		$this->RateableValue->CurrentValue = $this->RateableValue->FormValue;
		$this->SupplementaryValue->CurrentValue = $this->SupplementaryValue->FormValue;
		$this->ExemptCode->CurrentValue = $this->ExemptCode->FormValue;
		$this->Improvements->CurrentValue = $this->Improvements->FormValue;
		$this->StreetAddress->CurrentValue = $this->StreetAddress->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->Incumberance->CurrentValue = $this->Incumberance->FormValue;
		$this->SubDivisionOf->CurrentValue = $this->SubDivisionOf->FormValue;
		$this->LastUpdatedBy->CurrentValue = $this->LastUpdatedBy->FormValue;
		$this->LastUpdateDate->CurrentValue = $this->LastUpdateDate->FormValue;
		$this->LastUpdateDate->CurrentValue = UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0);
		$this->ValuationNo->CurrentValue = $this->ValuationNo->FormValue;
		$this->LandValue->CurrentValue = $this->LandValue->FormValue;
		$this->ImprovementsValue->CurrentValue = $this->ImprovementsValue->FormValue;
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
		$this->PropertyNo->setDbValue($row['PropertyNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PropertyGroup->setDbValue($row['PropertyGroup']);
		$this->PropertyType->setDbValue($row['PropertyType']);
		$this->Location->setDbValue($row['Location']);
		$this->PropertyStatus->setDbValue($row['PropertyStatus']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
		$this->LandExtentInHA->setDbValue($row['LandExtentInHA']);
		$this->RateableValue->setDbValue($row['RateableValue']);
		$this->SupplementaryValue->setDbValue($row['SupplementaryValue']);
		$this->ExemptCode->setDbValue($row['ExemptCode']);
		$this->Improvements->setDbValue($row['Improvements']);
		$this->StreetAddress->setDbValue($row['StreetAddress']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->Incumberance->setDbValue($row['Incumberance']);
		$this->SubDivisionOf->setDbValue($row['SubDivisionOf']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
		$this->ValuationNo->setDbValue($row['ValuationNo']);
		$this->LandValue->setDbValue($row['LandValue']);
		$this->ImprovementsValue->setDbValue($row['ImprovementsValue']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['PropertyNo'] = NULL;
		$row['ClientSerNo'] = NULL;
		$row['ClientID'] = NULL;
		$row['PropertyGroup'] = NULL;
		$row['PropertyType'] = NULL;
		$row['Location'] = NULL;
		$row['PropertyStatus'] = NULL;
		$row['PropertyUse'] = NULL;
		$row['LandExtentInHA'] = NULL;
		$row['RateableValue'] = NULL;
		$row['SupplementaryValue'] = NULL;
		$row['ExemptCode'] = NULL;
		$row['Improvements'] = NULL;
		$row['StreetAddress'] = NULL;
		$row['Longitude'] = NULL;
		$row['Latitude'] = NULL;
		$row['Incumberance'] = NULL;
		$row['SubDivisionOf'] = NULL;
		$row['LastUpdatedBy'] = NULL;
		$row['LastUpdateDate'] = NULL;
		$row['ValuationNo'] = NULL;
		$row['LandValue'] = NULL;
		$row['ImprovementsValue'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ValuationNo")) != "")
			$this->ValuationNo->OldValue = $this->getKey("ValuationNo"); // ValuationNo
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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			if (!$this->PropertyNo->Raw)
				$this->PropertyNo->CurrentValue = HtmlDecode($this->PropertyNo->CurrentValue);
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->CurrentValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
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
			} else {
				$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
				$curVal = strval($this->ClientSerNo->CurrentValue);
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
							$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
						}
					}
				} else {
					$this->ClientSerNo->EditValue = NULL;
				}
				$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$curVal = strval($this->ClientID->CurrentValue);
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
						$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
					}
				}
			} else {
				$this->ClientID->EditValue = NULL;
			}
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PropertyGroup
			$this->PropertyGroup->EditAttrs["class"] = "form-control";
			$this->PropertyGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyGroup->CurrentValue));
			if ($curVal != "")
				$this->PropertyGroup->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
			else
				$this->PropertyGroup->ViewValue = $this->PropertyGroup->Lookup !== NULL && is_array($this->PropertyGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyGroup->ViewValue !== NULL) { // Load from cache
				$this->PropertyGroup->EditValue = array_values($this->PropertyGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyGroup`" . SearchString("=", $this->PropertyGroup->CurrentValue, DATATYPE_NUMBER, "");
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
			$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->CurrentValue);
			$curVal = strval($this->PropertyType->CurrentValue);
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
						$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->CurrentValue);
					}
				}
			} else {
				$this->PropertyType->EditValue = NULL;
			}
			$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

			// Location
			$this->Location->EditCustomAttributes = "";
			$curVal = trim(strval($this->Location->CurrentValue));
			if ($curVal != "")
				$this->Location->ViewValue = $this->Location->lookupCacheOption($curVal);
			else
				$this->Location->ViewValue = $this->Location->Lookup !== NULL && is_array($this->Location->Lookup->Options) ? $curVal : NULL;
			if ($this->Location->ViewValue !== NULL) { // Load from cache
				$this->Location->EditValue = array_values($this->Location->Lookup->Options);
				if ($this->Location->ViewValue == "")
					$this->Location->ViewValue = $Language->phrase("PleaseSelect");
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
					$this->Location->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Location->ViewValue->add($this->Location->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->Location->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Location->EditValue = $arwrk;
			}

			// PropertyStatus
			$this->PropertyStatus->EditAttrs["class"] = "form-control";
			$this->PropertyStatus->EditCustomAttributes = "";
			$this->PropertyStatus->EditValue = HtmlEncode($this->PropertyStatus->CurrentValue);
			$this->PropertyStatus->PlaceHolder = RemoveHtml($this->PropertyStatus->caption());

			// PropertyUse
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->CurrentValue));
			if ($curVal != "")
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
				if ($this->PropertyUse->ViewValue == "")
					$this->PropertyUse->ViewValue = $Language->phrase("PleaseSelect");
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
					$this->PropertyUse->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyUse->ViewValue->add($this->PropertyUse->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->PropertyUse->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// LandExtentInHA
			$this->LandExtentInHA->EditAttrs["class"] = "form-control";
			$this->LandExtentInHA->EditCustomAttributes = "";
			$this->LandExtentInHA->EditValue = HtmlEncode($this->LandExtentInHA->CurrentValue);
			$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());
			if (strval($this->LandExtentInHA->EditValue) != "" && is_numeric($this->LandExtentInHA->EditValue))
				$this->LandExtentInHA->EditValue = FormatNumber($this->LandExtentInHA->EditValue, -2, -2, -2, -2);
			

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->CurrentValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
			if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue))
				$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -2, -2, -2);
			

			// SupplementaryValue
			$this->SupplementaryValue->EditAttrs["class"] = "form-control";
			$this->SupplementaryValue->EditCustomAttributes = "";
			$this->SupplementaryValue->EditValue = HtmlEncode($this->SupplementaryValue->CurrentValue);
			$this->SupplementaryValue->PlaceHolder = RemoveHtml($this->SupplementaryValue->caption());
			if (strval($this->SupplementaryValue->EditValue) != "" && is_numeric($this->SupplementaryValue->EditValue))
				$this->SupplementaryValue->EditValue = FormatNumber($this->SupplementaryValue->EditValue, -2, -2, -2, -2);
			

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			if (!$this->ExemptCode->Raw)
				$this->ExemptCode->CurrentValue = HtmlDecode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// Improvements
			$this->Improvements->EditAttrs["class"] = "form-control";
			$this->Improvements->EditCustomAttributes = "";
			$this->Improvements->EditValue = HtmlEncode($this->Improvements->CurrentValue);
			$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue))
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
			

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue))
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
			

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->CurrentValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// SubDivisionOf
			$this->SubDivisionOf->EditAttrs["class"] = "form-control";
			$this->SubDivisionOf->EditCustomAttributes = "";
			$this->SubDivisionOf->EditValue = HtmlEncode($this->SubDivisionOf->CurrentValue);
			$this->SubDivisionOf->PlaceHolder = RemoveHtml($this->SubDivisionOf->caption());

			// LastUpdatedBy
			$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
			$this->LastUpdatedBy->EditCustomAttributes = "";
			if (!$this->LastUpdatedBy->Raw)
				$this->LastUpdatedBy->CurrentValue = HtmlDecode($this->LastUpdatedBy->CurrentValue);
			$this->LastUpdatedBy->EditValue = HtmlEncode($this->LastUpdatedBy->CurrentValue);
			$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

			// LastUpdateDate
			$this->LastUpdateDate->EditAttrs["class"] = "form-control";
			$this->LastUpdateDate->EditCustomAttributes = "";
			$this->LastUpdateDate->EditValue = HtmlEncode(FormatDateTime($this->LastUpdateDate->CurrentValue, 8));
			$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

			// ValuationNo
			$this->ValuationNo->EditAttrs["class"] = "form-control";
			$this->ValuationNo->EditCustomAttributes = "";
			$this->ValuationNo->EditValue = $this->ValuationNo->CurrentValue;
			$this->ValuationNo->ViewCustomAttributes = "";

			// LandValue
			$this->LandValue->EditAttrs["class"] = "form-control";
			$this->LandValue->EditCustomAttributes = "";
			$this->LandValue->EditValue = HtmlEncode($this->LandValue->CurrentValue);
			$this->LandValue->PlaceHolder = RemoveHtml($this->LandValue->caption());
			if (strval($this->LandValue->EditValue) != "" && is_numeric($this->LandValue->EditValue))
				$this->LandValue->EditValue = FormatNumber($this->LandValue->EditValue, -2, -2, -2, -2);
			

			// ImprovementsValue
			$this->ImprovementsValue->EditAttrs["class"] = "form-control";
			$this->ImprovementsValue->EditCustomAttributes = "";
			$this->ImprovementsValue->EditValue = HtmlEncode($this->ImprovementsValue->CurrentValue);
			$this->ImprovementsValue->PlaceHolder = RemoveHtml($this->ImprovementsValue->caption());
			if (strval($this->ImprovementsValue->EditValue) != "" && is_numeric($this->ImprovementsValue->EditValue))
				$this->ImprovementsValue->EditValue = FormatNumber($this->ImprovementsValue->EditValue, -2, -2, -2, -2);
			

			// Edit refer script
			// PropertyNo

			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";

			// PropertyType
			$this->PropertyType->LinkCustomAttributes = "";
			$this->PropertyType->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// PropertyStatus
			$this->PropertyStatus->LinkCustomAttributes = "";
			$this->PropertyStatus->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";

			// LandExtentInHA
			$this->LandExtentInHA->LinkCustomAttributes = "";
			$this->LandExtentInHA->HrefValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";

			// SupplementaryValue
			$this->SupplementaryValue->LinkCustomAttributes = "";
			$this->SupplementaryValue->HrefValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";

			// Improvements
			$this->Improvements->LinkCustomAttributes = "";
			$this->Improvements->HrefValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";

			// SubDivisionOf
			$this->SubDivisionOf->LinkCustomAttributes = "";
			$this->SubDivisionOf->HrefValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";

			// ValuationNo
			$this->ValuationNo->LinkCustomAttributes = "";
			$this->ValuationNo->HrefValue = "";

			// LandValue
			$this->LandValue->LinkCustomAttributes = "";
			$this->LandValue->HrefValue = "";

			// ImprovementsValue
			$this->ImprovementsValue->LinkCustomAttributes = "";
			$this->ImprovementsValue->HrefValue = "";
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
		if ($this->PropertyNo->Required) {
			if (!$this->PropertyNo->IsDetailKey && $this->PropertyNo->FormValue != NULL && $this->PropertyNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyNo->caption(), $this->PropertyNo->RequiredErrorMessage));
			}
		}
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClientSerNo->FormValue)) {
			AddMessage($FormError, $this->ClientSerNo->errorMessage());
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->PropertyGroup->Required) {
			if (!$this->PropertyGroup->IsDetailKey && $this->PropertyGroup->FormValue != NULL && $this->PropertyGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyGroup->caption(), $this->PropertyGroup->RequiredErrorMessage));
			}
		}
		if ($this->PropertyType->Required) {
			if (!$this->PropertyType->IsDetailKey && $this->PropertyType->FormValue != NULL && $this->PropertyType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyType->caption(), $this->PropertyType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PropertyType->FormValue)) {
			AddMessage($FormError, $this->PropertyType->errorMessage());
		}
		if ($this->Location->Required) {
			if ($this->Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Location->caption(), $this->Location->RequiredErrorMessage));
			}
		}
		if ($this->PropertyStatus->Required) {
			if (!$this->PropertyStatus->IsDetailKey && $this->PropertyStatus->FormValue != NULL && $this->PropertyStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyStatus->caption(), $this->PropertyStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PropertyStatus->FormValue)) {
			AddMessage($FormError, $this->PropertyStatus->errorMessage());
		}
		if ($this->PropertyUse->Required) {
			if ($this->PropertyUse->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyUse->caption(), $this->PropertyUse->RequiredErrorMessage));
			}
		}
		if ($this->LandExtentInHA->Required) {
			if (!$this->LandExtentInHA->IsDetailKey && $this->LandExtentInHA->FormValue != NULL && $this->LandExtentInHA->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LandExtentInHA->caption(), $this->LandExtentInHA->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LandExtentInHA->FormValue)) {
			AddMessage($FormError, $this->LandExtentInHA->errorMessage());
		}
		if ($this->RateableValue->Required) {
			if (!$this->RateableValue->IsDetailKey && $this->RateableValue->FormValue != NULL && $this->RateableValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RateableValue->caption(), $this->RateableValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->RateableValue->FormValue)) {
			AddMessage($FormError, $this->RateableValue->errorMessage());
		}
		if ($this->SupplementaryValue->Required) {
			if (!$this->SupplementaryValue->IsDetailKey && $this->SupplementaryValue->FormValue != NULL && $this->SupplementaryValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SupplementaryValue->caption(), $this->SupplementaryValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->SupplementaryValue->FormValue)) {
			AddMessage($FormError, $this->SupplementaryValue->errorMessage());
		}
		if ($this->ExemptCode->Required) {
			if (!$this->ExemptCode->IsDetailKey && $this->ExemptCode->FormValue != NULL && $this->ExemptCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExemptCode->caption(), $this->ExemptCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ExemptCode->FormValue)) {
			AddMessage($FormError, $this->ExemptCode->errorMessage());
		}
		if ($this->Improvements->Required) {
			if (!$this->Improvements->IsDetailKey && $this->Improvements->FormValue != NULL && $this->Improvements->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Improvements->caption(), $this->Improvements->RequiredErrorMessage));
			}
		}
		if ($this->StreetAddress->Required) {
			if (!$this->StreetAddress->IsDetailKey && $this->StreetAddress->FormValue != NULL && $this->StreetAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StreetAddress->caption(), $this->StreetAddress->RequiredErrorMessage));
			}
		}
		if ($this->Longitude->Required) {
			if (!$this->Longitude->IsDetailKey && $this->Longitude->FormValue != NULL && $this->Longitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Longitude->caption(), $this->Longitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Longitude->FormValue)) {
			AddMessage($FormError, $this->Longitude->errorMessage());
		}
		if ($this->Latitude->Required) {
			if (!$this->Latitude->IsDetailKey && $this->Latitude->FormValue != NULL && $this->Latitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Latitude->caption(), $this->Latitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Latitude->FormValue)) {
			AddMessage($FormError, $this->Latitude->errorMessage());
		}
		if ($this->Incumberance->Required) {
			if (!$this->Incumberance->IsDetailKey && $this->Incumberance->FormValue != NULL && $this->Incumberance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Incumberance->caption(), $this->Incumberance->RequiredErrorMessage));
			}
		}
		if ($this->SubDivisionOf->Required) {
			if (!$this->SubDivisionOf->IsDetailKey && $this->SubDivisionOf->FormValue != NULL && $this->SubDivisionOf->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubDivisionOf->caption(), $this->SubDivisionOf->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->SubDivisionOf->FormValue)) {
			AddMessage($FormError, $this->SubDivisionOf->errorMessage());
		}
		if ($this->LastUpdatedBy->Required) {
			if (!$this->LastUpdatedBy->IsDetailKey && $this->LastUpdatedBy->FormValue != NULL && $this->LastUpdatedBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastUpdatedBy->caption(), $this->LastUpdatedBy->RequiredErrorMessage));
			}
		}
		if ($this->LastUpdateDate->Required) {
			if (!$this->LastUpdateDate->IsDetailKey && $this->LastUpdateDate->FormValue != NULL && $this->LastUpdateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastUpdateDate->caption(), $this->LastUpdateDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastUpdateDate->FormValue)) {
			AddMessage($FormError, $this->LastUpdateDate->errorMessage());
		}
		if ($this->ValuationNo->Required) {
			if (!$this->ValuationNo->IsDetailKey && $this->ValuationNo->FormValue != NULL && $this->ValuationNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ValuationNo->caption(), $this->ValuationNo->RequiredErrorMessage));
			}
		}
		if ($this->LandValue->Required) {
			if (!$this->LandValue->IsDetailKey && $this->LandValue->FormValue != NULL && $this->LandValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LandValue->caption(), $this->LandValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LandValue->FormValue)) {
			AddMessage($FormError, $this->LandValue->errorMessage());
		}
		if ($this->ImprovementsValue->Required) {
			if (!$this->ImprovementsValue->IsDetailKey && $this->ImprovementsValue->FormValue != NULL && $this->ImprovementsValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ImprovementsValue->caption(), $this->ImprovementsValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ImprovementsValue->FormValue)) {
			AddMessage($FormError, $this->ImprovementsValue->errorMessage());
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
		if ($this->PropertyNo->CurrentValue != "") { // Check field with unique index
			$filterChk = "(`PropertyNo` = '" . AdjustSql($this->PropertyNo->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = "";
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->PropertyNo->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->PropertyNo->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
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

			// PropertyNo
			$this->PropertyNo->setDbValueDef($rsnew, $this->PropertyNo->CurrentValue, "", $this->PropertyNo->ReadOnly);

			// ClientSerNo
			$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, $this->ClientSerNo->ReadOnly);

			// ClientID
			$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, $this->ClientID->ReadOnly);

			// PropertyGroup
			$this->PropertyGroup->setDbValueDef($rsnew, $this->PropertyGroup->CurrentValue, NULL, $this->PropertyGroup->ReadOnly);

			// PropertyType
			$this->PropertyType->setDbValueDef($rsnew, $this->PropertyType->CurrentValue, NULL, $this->PropertyType->ReadOnly);

			// Location
			$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, "", $this->Location->ReadOnly);

			// PropertyStatus
			$this->PropertyStatus->setDbValueDef($rsnew, $this->PropertyStatus->CurrentValue, NULL, $this->PropertyStatus->ReadOnly);

			// PropertyUse
			$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, "", $this->PropertyUse->ReadOnly);

			// LandExtentInHA
			$this->LandExtentInHA->setDbValueDef($rsnew, $this->LandExtentInHA->CurrentValue, NULL, $this->LandExtentInHA->ReadOnly);

			// RateableValue
			$this->RateableValue->setDbValueDef($rsnew, $this->RateableValue->CurrentValue, NULL, $this->RateableValue->ReadOnly);

			// SupplementaryValue
			$this->SupplementaryValue->setDbValueDef($rsnew, $this->SupplementaryValue->CurrentValue, NULL, $this->SupplementaryValue->ReadOnly);

			// ExemptCode
			$this->ExemptCode->setDbValueDef($rsnew, $this->ExemptCode->CurrentValue, NULL, $this->ExemptCode->ReadOnly);

			// Improvements
			$this->Improvements->setDbValueDef($rsnew, $this->Improvements->CurrentValue, "", $this->Improvements->ReadOnly);

			// StreetAddress
			$this->StreetAddress->setDbValueDef($rsnew, $this->StreetAddress->CurrentValue, NULL, $this->StreetAddress->ReadOnly);

			// Longitude
			$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, $this->Longitude->ReadOnly);

			// Latitude
			$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, $this->Latitude->ReadOnly);

			// Incumberance
			$this->Incumberance->setDbValueDef($rsnew, $this->Incumberance->CurrentValue, NULL, $this->Incumberance->ReadOnly);

			// SubDivisionOf
			$this->SubDivisionOf->setDbValueDef($rsnew, $this->SubDivisionOf->CurrentValue, NULL, $this->SubDivisionOf->ReadOnly);

			// LastUpdatedBy
			$this->LastUpdatedBy->setDbValueDef($rsnew, $this->LastUpdatedBy->CurrentValue, NULL, $this->LastUpdatedBy->ReadOnly);

			// LastUpdateDate
			$this->LastUpdateDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0), NULL, $this->LastUpdateDate->ReadOnly);

			// LandValue
			$this->LandValue->setDbValueDef($rsnew, $this->LandValue->CurrentValue, NULL, $this->LandValue->ReadOnly);

			// ImprovementsValue
			$this->ImprovementsValue->setDbValueDef($rsnew, $this->ImprovementsValue->CurrentValue, NULL, $this->ImprovementsValue->ReadOnly);

			// Check referential integrity for master table 'client'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_client();
			$keyValue = isset($rsnew['ClientSerNo']) ? $rsnew['ClientSerNo'] : $rsold['ClientSerNo'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@ClientSerNo@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["client"]))
					$GLOBALS["client"] = new client();
				$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ClientSerNo", Get("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setQueryStringValue($parm);
					$this->ClientSerNo->setQueryStringValue($GLOBALS["client"]->ClientSerNo->QueryStringValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->QueryStringValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->QueryStringValue))
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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ClientSerNo", Post("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setFormValue($parm);
					$this->ClientSerNo->setFormValue($GLOBALS["client"]->ClientSerNo->FormValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->FormValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->FormValue))
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
			if ($masterTblVar != "client") {
				if ($this->ClientSerNo->CurrentValue == "")
					$this->ClientSerNo->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("propertylist.php"), "", $this->TableVar, TRUE);
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