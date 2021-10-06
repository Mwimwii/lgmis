<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class licence_account_edit extends licence_account
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'licence_account';

	// Page object name
	public $PageObjName = "licence_account_edit";

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

		// Table object (licence_account)
		if (!isset($GLOBALS["licence_account"]) || get_class($GLOBALS["licence_account"]) == PROJECT_NAMESPACE . "licence_account") {
			$GLOBALS["licence_account"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["licence_account"];
		}

		// Table object (business)
		if (!isset($GLOBALS['business']))
			$GLOBALS['business'] = new business();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'licence_account');

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
		global $licence_account;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($licence_account);
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
					if ($pageName == "licence_accountview.php")
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
			$key .= @$ar['LicenceNo'];
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
			$this->LicenceNo->Visible = FALSE;
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
					$this->terminate(GetUrl("licence_accountlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LicenceNo->setVisibility();
		$this->BusinessNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->BalanceBF->setVisibility();
		$this->CurrentDemand->setVisibility();
		$this->VAT->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->PeriodType->setVisibility();
		$this->BillYear->setVisibility();
		$this->StartDate->setVisibility();
		$this->EndDate->setVisibility();
		$this->LastUpdatedBy->setVisibility();
		$this->LastUpdateDate->setVisibility();
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
		// Check permission

		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("licence_accountlist.php");
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
			if (Get("LicenceNo") !== NULL) {
				$this->LicenceNo->setQueryStringValue(Get("LicenceNo"));
				$this->LicenceNo->setOldValue($this->LicenceNo->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->LicenceNo->setQueryStringValue(Key(0));
				$this->LicenceNo->setOldValue($this->LicenceNo->QueryStringValue);
			} elseif (Post("LicenceNo") !== NULL) {
				$this->LicenceNo->setFormValue(Post("LicenceNo"));
				$this->LicenceNo->setOldValue($this->LicenceNo->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->LicenceNo->setQueryStringValue(Route(2));
				$this->LicenceNo->setOldValue($this->LicenceNo->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_LicenceNo")) {
					$this->LicenceNo->setFormValue($CurrentForm->getValue("x_LicenceNo"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("LicenceNo") !== NULL) {
					$this->LicenceNo->setQueryStringValue(Get("LicenceNo"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->LicenceNo->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->LicenceNo->CurrentValue = NULL;
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
				$this->terminate("licence_accountlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->LicenceNo->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->LicenceNo->CurrentValue, $rs->fields('LicenceNo'))) {
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

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("licence_accountlist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "licence_accountlist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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

		// Check field name 'LicenceNo' first before field var 'x_LicenceNo'
		$val = $CurrentForm->hasValue("LicenceNo") ? $CurrentForm->getValue("LicenceNo") : $CurrentForm->getValue("x_LicenceNo");
		if (!$this->LicenceNo->IsDetailKey)
			$this->LicenceNo->setFormValue($val);

		// Check field name 'BusinessNo' first before field var 'x_BusinessNo'
		$val = $CurrentForm->hasValue("BusinessNo") ? $CurrentForm->getValue("BusinessNo") : $CurrentForm->getValue("x_BusinessNo");
		if (!$this->BusinessNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BusinessNo->Visible = FALSE; // Disable update for API request
			else
				$this->BusinessNo->setFormValue($val);
		}

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeCode->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'BalanceBF' first before field var 'x_BalanceBF'
		$val = $CurrentForm->hasValue("BalanceBF") ? $CurrentForm->getValue("BalanceBF") : $CurrentForm->getValue("x_BalanceBF");
		if (!$this->BalanceBF->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BalanceBF->Visible = FALSE; // Disable update for API request
			else
				$this->BalanceBF->setFormValue($val);
		}

		// Check field name 'CurrentDemand' first before field var 'x_CurrentDemand'
		$val = $CurrentForm->hasValue("CurrentDemand") ? $CurrentForm->getValue("CurrentDemand") : $CurrentForm->getValue("x_CurrentDemand");
		if (!$this->CurrentDemand->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentDemand->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentDemand->setFormValue($val);
		}

		// Check field name 'VAT' first before field var 'x_VAT'
		$val = $CurrentForm->hasValue("VAT") ? $CurrentForm->getValue("VAT") : $CurrentForm->getValue("x_VAT");
		if (!$this->VAT->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->VAT->Visible = FALSE; // Disable update for API request
			else
				$this->VAT->setFormValue($val);
		}

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}

		// Check field name 'BillPeriod' first before field var 'x_BillPeriod'
		$val = $CurrentForm->hasValue("BillPeriod") ? $CurrentForm->getValue("BillPeriod") : $CurrentForm->getValue("x_BillPeriod");
		if (!$this->BillPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->BillPeriod->setFormValue($val);
		}

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}

		// Check field name 'BillYear' first before field var 'x_BillYear'
		$val = $CurrentForm->hasValue("BillYear") ? $CurrentForm->getValue("BillYear") : $CurrentForm->getValue("x_BillYear");
		if (!$this->BillYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillYear->Visible = FALSE; // Disable update for API request
			else
				$this->BillYear->setFormValue($val);
		}

		// Check field name 'StartDate' first before field var 'x_StartDate'
		$val = $CurrentForm->hasValue("StartDate") ? $CurrentForm->getValue("StartDate") : $CurrentForm->getValue("x_StartDate");
		if (!$this->StartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StartDate->Visible = FALSE; // Disable update for API request
			else
				$this->StartDate->setFormValue($val);
			$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		}

		// Check field name 'EndDate' first before field var 'x_EndDate'
		$val = $CurrentForm->hasValue("EndDate") ? $CurrentForm->getValue("EndDate") : $CurrentForm->getValue("x_EndDate");
		if (!$this->EndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EndDate->Visible = FALSE; // Disable update for API request
			else
				$this->EndDate->setFormValue($val);
			$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LicenceNo->CurrentValue = $this->LicenceNo->FormValue;
		$this->BusinessNo->CurrentValue = $this->BusinessNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->BalanceBF->CurrentValue = $this->BalanceBF->FormValue;
		$this->CurrentDemand->CurrentValue = $this->CurrentDemand->FormValue;
		$this->VAT->CurrentValue = $this->VAT->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->BillPeriod->CurrentValue = $this->BillPeriod->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->BillYear->CurrentValue = $this->BillYear->FormValue;
		$this->StartDate->CurrentValue = $this->StartDate->FormValue;
		$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		$this->EndDate->CurrentValue = $this->EndDate->FormValue;
		$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
		$this->LastUpdatedBy->CurrentValue = $this->LastUpdatedBy->FormValue;
		$this->LastUpdateDate->CurrentValue = $this->LastUpdateDate->FormValue;
		$this->LastUpdateDate->CurrentValue = UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0);
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
		$this->LicenceNo->setDbValue($row['LicenceNo']);
		$this->BusinessNo->setDbValue($row['BusinessNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->BalanceBF->setDbValue($row['BalanceBF']);
		$this->CurrentDemand->setDbValue($row['CurrentDemand']);
		$this->VAT->setDbValue($row['VAT']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->BillPeriod->setDbValue($row['BillPeriod']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->BillYear->setDbValue($row['BillYear']);
		$this->StartDate->setDbValue($row['StartDate']);
		$this->EndDate->setDbValue($row['EndDate']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['LicenceNo'] = NULL;
		$row['BusinessNo'] = NULL;
		$row['ClientID'] = NULL;
		$row['ChargeCode'] = NULL;
		$row['ChargeGroup'] = NULL;
		$row['BalanceBF'] = NULL;
		$row['CurrentDemand'] = NULL;
		$row['VAT'] = NULL;
		$row['AmountPaid'] = NULL;
		$row['BillPeriod'] = NULL;
		$row['PeriodType'] = NULL;
		$row['BillYear'] = NULL;
		$row['StartDate'] = NULL;
		$row['EndDate'] = NULL;
		$row['LastUpdatedBy'] = NULL;
		$row['LastUpdateDate'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("LicenceNo")) != "")
			$this->LicenceNo->OldValue = $this->getKey("LicenceNo"); // LicenceNo
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

		if ($this->BalanceBF->FormValue == $this->BalanceBF->CurrentValue && is_numeric(ConvertToFloatString($this->BalanceBF->CurrentValue)))
			$this->BalanceBF->CurrentValue = ConvertToFloatString($this->BalanceBF->CurrentValue);

		// Convert decimal values if posted back
		if ($this->CurrentDemand->FormValue == $this->CurrentDemand->CurrentValue && is_numeric(ConvertToFloatString($this->CurrentDemand->CurrentValue)))
			$this->CurrentDemand->CurrentValue = ConvertToFloatString($this->CurrentDemand->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VAT->FormValue == $this->VAT->CurrentValue && is_numeric(ConvertToFloatString($this->VAT->CurrentValue)))
			$this->VAT->CurrentValue = ConvertToFloatString($this->VAT->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LicenceNo
		// BusinessNo
		// ClientID
		// ChargeCode
		// ChargeGroup
		// BalanceBF
		// CurrentDemand
		// VAT
		// AmountPaid
		// BillPeriod
		// PeriodType
		// BillYear
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LicenceNo
			$this->LicenceNo->ViewValue = $this->LicenceNo->CurrentValue;
			$this->LicenceNo->ViewCustomAttributes = "";

			// BusinessNo
			$this->BusinessNo->ViewValue = $this->BusinessNo->CurrentValue;
			$this->BusinessNo->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// ChargeCode
			$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// BalanceBF
			$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
			$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->BalanceBF->ViewCustomAttributes = "";

			// CurrentDemand
			$this->CurrentDemand->ViewValue = $this->CurrentDemand->CurrentValue;
			$this->CurrentDemand->ViewValue = FormatNumber($this->CurrentDemand->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->CurrentDemand->ViewCustomAttributes = "";

			// VAT
			$this->VAT->ViewValue = $this->VAT->CurrentValue;
			$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->VAT->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AmountPaid->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewCustomAttributes = "";

			// PeriodType
			$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
			$this->PeriodType->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";

			// StartDate
			$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
			$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
			$this->StartDate->ViewCustomAttributes = "";

			// EndDate
			$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
			$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
			$this->EndDate->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// LicenceNo
			$this->LicenceNo->LinkCustomAttributes = "";
			$this->LicenceNo->HrefValue = "";
			$this->LicenceNo->TooltipValue = "";

			// BusinessNo
			$this->BusinessNo->LinkCustomAttributes = "";
			$this->BusinessNo->HrefValue = "";
			$this->BusinessNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";
			$this->BalanceBF->TooltipValue = "";

			// CurrentDemand
			$this->CurrentDemand->LinkCustomAttributes = "";
			$this->CurrentDemand->HrefValue = "";
			$this->CurrentDemand->TooltipValue = "";

			// VAT
			$this->VAT->LinkCustomAttributes = "";
			$this->VAT->HrefValue = "";
			$this->VAT->TooltipValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";
			$this->StartDate->TooltipValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
			$this->EndDate->TooltipValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// LicenceNo
			$this->LicenceNo->EditAttrs["class"] = "form-control";
			$this->LicenceNo->EditCustomAttributes = "";
			$this->LicenceNo->EditValue = $this->LicenceNo->CurrentValue;
			$this->LicenceNo->ViewCustomAttributes = "";

			// BusinessNo
			$this->BusinessNo->EditAttrs["class"] = "form-control";
			$this->BusinessNo->EditCustomAttributes = "";
			if ($this->BusinessNo->getSessionValue() != "") {
				$this->BusinessNo->CurrentValue = $this->BusinessNo->getSessionValue();
				$this->BusinessNo->ViewValue = $this->BusinessNo->CurrentValue;
				$this->BusinessNo->ViewCustomAttributes = "";
			} else {
				$this->BusinessNo->EditValue = HtmlEncode($this->BusinessNo->CurrentValue);
				$this->BusinessNo->PlaceHolder = RemoveHtml($this->BusinessNo->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->CurrentValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
			if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
				$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, -1, -2, 0);
			

			// CurrentDemand
			$this->CurrentDemand->EditAttrs["class"] = "form-control";
			$this->CurrentDemand->EditCustomAttributes = "";
			$this->CurrentDemand->EditValue = HtmlEncode($this->CurrentDemand->CurrentValue);
			$this->CurrentDemand->PlaceHolder = RemoveHtml($this->CurrentDemand->caption());
			if (strval($this->CurrentDemand->EditValue) != "" && is_numeric($this->CurrentDemand->EditValue))
				$this->CurrentDemand->EditValue = FormatNumber($this->CurrentDemand->EditValue, -2, -1, -2, 0);
			

			// VAT
			$this->VAT->EditAttrs["class"] = "form-control";
			$this->VAT->EditCustomAttributes = "";
			$this->VAT->EditValue = HtmlEncode($this->VAT->CurrentValue);
			$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());
			if (strval($this->VAT->EditValue) != "" && is_numeric($this->VAT->EditValue))
				$this->VAT->EditValue = FormatNumber($this->VAT->EditValue, -2, -1, -2, 0);
			

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
			

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			if (!$this->PeriodType->Raw)
				$this->PeriodType->CurrentValue = HtmlDecode($this->PeriodType->CurrentValue);
			$this->PeriodType->EditValue = HtmlEncode($this->PeriodType->CurrentValue);
			$this->PeriodType->PlaceHolder = RemoveHtml($this->PeriodType->caption());

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
			$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime($this->StartDate->CurrentValue, 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime($this->EndDate->CurrentValue, 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

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

			// Edit refer script
			// LicenceNo

			$this->LicenceNo->LinkCustomAttributes = "";
			$this->LicenceNo->HrefValue = "";

			// BusinessNo
			$this->BusinessNo->LinkCustomAttributes = "";
			$this->BusinessNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";

			// CurrentDemand
			$this->CurrentDemand->LinkCustomAttributes = "";
			$this->CurrentDemand->HrefValue = "";

			// VAT
			$this->VAT->LinkCustomAttributes = "";
			$this->VAT->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
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
		if ($this->LicenceNo->Required) {
			if (!$this->LicenceNo->IsDetailKey && $this->LicenceNo->FormValue != NULL && $this->LicenceNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LicenceNo->caption(), $this->LicenceNo->RequiredErrorMessage));
			}
		}
		if ($this->BusinessNo->Required) {
			if (!$this->BusinessNo->IsDetailKey && $this->BusinessNo->FormValue != NULL && $this->BusinessNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BusinessNo->caption(), $this->BusinessNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BusinessNo->FormValue)) {
			AddMessage($FormError, $this->BusinessNo->errorMessage());
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeCode->FormValue)) {
			AddMessage($FormError, $this->ChargeCode->errorMessage());
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeGroup->FormValue)) {
			AddMessage($FormError, $this->ChargeGroup->errorMessage());
		}
		if ($this->BalanceBF->Required) {
			if (!$this->BalanceBF->IsDetailKey && $this->BalanceBF->FormValue != NULL && $this->BalanceBF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BalanceBF->caption(), $this->BalanceBF->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BalanceBF->FormValue)) {
			AddMessage($FormError, $this->BalanceBF->errorMessage());
		}
		if ($this->CurrentDemand->Required) {
			if (!$this->CurrentDemand->IsDetailKey && $this->CurrentDemand->FormValue != NULL && $this->CurrentDemand->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrentDemand->caption(), $this->CurrentDemand->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->CurrentDemand->FormValue)) {
			AddMessage($FormError, $this->CurrentDemand->errorMessage());
		}
		if ($this->VAT->Required) {
			if (!$this->VAT->IsDetailKey && $this->VAT->FormValue != NULL && $this->VAT->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VAT->caption(), $this->VAT->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->VAT->FormValue)) {
			AddMessage($FormError, $this->VAT->errorMessage());
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->BillPeriod->Required) {
			if (!$this->BillPeriod->IsDetailKey && $this->BillPeriod->FormValue != NULL && $this->BillPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillPeriod->caption(), $this->BillPeriod->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillPeriod->FormValue)) {
			AddMessage($FormError, $this->BillPeriod->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PeriodType->FormValue)) {
			AddMessage($FormError, $this->PeriodType->errorMessage());
		}
		if ($this->BillYear->Required) {
			if (!$this->BillYear->IsDetailKey && $this->BillYear->FormValue != NULL && $this->BillYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillYear->caption(), $this->BillYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillYear->FormValue)) {
			AddMessage($FormError, $this->BillYear->errorMessage());
		}
		if ($this->StartDate->Required) {
			if (!$this->StartDate->IsDetailKey && $this->StartDate->FormValue != NULL && $this->StartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StartDate->caption(), $this->StartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->StartDate->FormValue)) {
			AddMessage($FormError, $this->StartDate->errorMessage());
		}
		if ($this->EndDate->Required) {
			if (!$this->EndDate->IsDetailKey && $this->EndDate->FormValue != NULL && $this->EndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EndDate->caption(), $this->EndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->EndDate->FormValue)) {
			AddMessage($FormError, $this->EndDate->errorMessage());
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("health_certificate", $detailTblVar) && $GLOBALS["health_certificate"]->DetailEdit) {
			if (!isset($GLOBALS["health_certificate_grid"]))
				$GLOBALS["health_certificate_grid"] = new health_certificate_grid(); // Get detail page object
			$GLOBALS["health_certificate_grid"]->validateGridForm();
		}
		if (in_array("fire_certificate", $detailTblVar) && $GLOBALS["fire_certificate"]->DetailEdit) {
			if (!isset($GLOBALS["fire_certificate_grid"]))
				$GLOBALS["fire_certificate_grid"] = new fire_certificate_grid(); // Get detail page object
			$GLOBALS["fire_certificate_grid"]->validateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// BusinessNo
			$this->BusinessNo->setDbValueDef($rsnew, $this->BusinessNo->CurrentValue, 0, $this->BusinessNo->ReadOnly);

			// ClientID
			$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, $this->ClientID->ReadOnly);

			// ChargeCode
			$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, NULL, $this->ChargeCode->ReadOnly);

			// ChargeGroup
			$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, $this->ChargeGroup->ReadOnly);

			// BalanceBF
			$this->BalanceBF->setDbValueDef($rsnew, $this->BalanceBF->CurrentValue, NULL, $this->BalanceBF->ReadOnly);

			// CurrentDemand
			$this->CurrentDemand->setDbValueDef($rsnew, $this->CurrentDemand->CurrentValue, NULL, $this->CurrentDemand->ReadOnly);

			// VAT
			$this->VAT->setDbValueDef($rsnew, $this->VAT->CurrentValue, NULL, $this->VAT->ReadOnly);

			// AmountPaid
			$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, $this->AmountPaid->ReadOnly);

			// BillPeriod
			$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, $this->BillPeriod->ReadOnly);

			// PeriodType
			$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, $this->PeriodType->ReadOnly);

			// BillYear
			$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, $this->BillYear->ReadOnly);

			// StartDate
			$this->StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->StartDate->CurrentValue, 0), NULL, $this->StartDate->ReadOnly);

			// EndDate
			$this->EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->EndDate->CurrentValue, 0), NULL, $this->EndDate->ReadOnly);

			// LastUpdatedBy
			$this->LastUpdatedBy->setDbValueDef($rsnew, $this->LastUpdatedBy->CurrentValue, NULL, $this->LastUpdatedBy->ReadOnly);

			// LastUpdateDate
			$this->LastUpdateDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastUpdateDate->CurrentValue, 0), NULL, $this->LastUpdateDate->ReadOnly);

			// Check referential integrity for master table 'business'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_business();
			$keyValue = isset($rsnew['BusinessNo']) ? $rsnew['BusinessNo'] : $rsold['BusinessNo'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@BusinessID@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["business"]))
					$GLOBALS["business"] = new business();
				$rsmaster = $GLOBALS["business"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "business", $Language->phrase("RelatedRecordRequired"));
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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("health_certificate", $detailTblVar) && $GLOBALS["health_certificate"]->DetailEdit) {
						if (!isset($GLOBALS["health_certificate_grid"]))
							$GLOBALS["health_certificate_grid"] = new health_certificate_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "health_certificate"); // Load user level of detail table
						$editRow = $GLOBALS["health_certificate_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("fire_certificate", $detailTblVar) && $GLOBALS["fire_certificate"]->DetailEdit) {
						if (!isset($GLOBALS["fire_certificate_grid"]))
							$GLOBALS["fire_certificate_grid"] = new fire_certificate_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "fire_certificate"); // Load user level of detail table
						$editRow = $GLOBALS["fire_certificate_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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
			if ($masterTblVar == "business") {
				$validMaster = TRUE;
				if (($parm = Get("fk_BusinessID", Get("BusinessNo"))) !== NULL) {
					$GLOBALS["business"]->BusinessID->setQueryStringValue($parm);
					$this->BusinessNo->setQueryStringValue($GLOBALS["business"]->BusinessID->QueryStringValue);
					$this->BusinessNo->setSessionValue($this->BusinessNo->QueryStringValue);
					if (!is_numeric($GLOBALS["business"]->BusinessID->QueryStringValue))
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
			if ($masterTblVar == "business") {
				$validMaster = TRUE;
				if (($parm = Post("fk_BusinessID", Post("BusinessNo"))) !== NULL) {
					$GLOBALS["business"]->BusinessID->setFormValue($parm);
					$this->BusinessNo->setFormValue($GLOBALS["business"]->BusinessID->FormValue);
					$this->BusinessNo->setSessionValue($this->BusinessNo->FormValue);
					if (!is_numeric($GLOBALS["business"]->BusinessID->FormValue))
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
			if ($masterTblVar != "business") {
				if ($this->BusinessNo->CurrentValue == "")
					$this->BusinessNo->setSessionValue("");
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
			if (in_array("health_certificate", $detailTblVar)) {
				if (!isset($GLOBALS["health_certificate_grid"]))
					$GLOBALS["health_certificate_grid"] = new health_certificate_grid();
				if ($GLOBALS["health_certificate_grid"]->DetailEdit) {
					$GLOBALS["health_certificate_grid"]->CurrentMode = "edit";
					$GLOBALS["health_certificate_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["health_certificate_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["health_certificate_grid"]->setStartRecordNumber(1);
					$GLOBALS["health_certificate_grid"]->LicenceNo->IsDetailKey = TRUE;
					$GLOBALS["health_certificate_grid"]->LicenceNo->CurrentValue = $this->LicenceNo->CurrentValue;
					$GLOBALS["health_certificate_grid"]->LicenceNo->setSessionValue($GLOBALS["health_certificate_grid"]->LicenceNo->CurrentValue);
					$GLOBALS["health_certificate_grid"]->BusinessNo->IsDetailKey = TRUE;
					$GLOBALS["health_certificate_grid"]->BusinessNo->CurrentValue = $this->BusinessNo->CurrentValue;
					$GLOBALS["health_certificate_grid"]->BusinessNo->setSessionValue($GLOBALS["health_certificate_grid"]->BusinessNo->CurrentValue);
					$GLOBALS["health_certificate_grid"]->BillPeriod->IsDetailKey = TRUE;
					$GLOBALS["health_certificate_grid"]->BillPeriod->CurrentValue = $this->BillPeriod->CurrentValue;
					$GLOBALS["health_certificate_grid"]->BillPeriod->setSessionValue($GLOBALS["health_certificate_grid"]->BillPeriod->CurrentValue);
					$GLOBALS["health_certificate_grid"]->PeriodType->IsDetailKey = TRUE;
					$GLOBALS["health_certificate_grid"]->PeriodType->CurrentValue = $this->PeriodType->CurrentValue;
					$GLOBALS["health_certificate_grid"]->PeriodType->setSessionValue($GLOBALS["health_certificate_grid"]->PeriodType->CurrentValue);
					$GLOBALS["health_certificate_grid"]->BillYear->IsDetailKey = TRUE;
					$GLOBALS["health_certificate_grid"]->BillYear->CurrentValue = $this->BillYear->CurrentValue;
					$GLOBALS["health_certificate_grid"]->BillYear->setSessionValue($GLOBALS["health_certificate_grid"]->BillYear->CurrentValue);
				}
			}
			if (in_array("fire_certificate", $detailTblVar)) {
				if (!isset($GLOBALS["fire_certificate_grid"]))
					$GLOBALS["fire_certificate_grid"] = new fire_certificate_grid();
				if ($GLOBALS["fire_certificate_grid"]->DetailEdit) {
					$GLOBALS["fire_certificate_grid"]->CurrentMode = "edit";
					$GLOBALS["fire_certificate_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["fire_certificate_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["fire_certificate_grid"]->setStartRecordNumber(1);
					$GLOBALS["fire_certificate_grid"]->LicenceNo->IsDetailKey = TRUE;
					$GLOBALS["fire_certificate_grid"]->LicenceNo->CurrentValue = $this->LicenceNo->CurrentValue;
					$GLOBALS["fire_certificate_grid"]->LicenceNo->setSessionValue($GLOBALS["fire_certificate_grid"]->LicenceNo->CurrentValue);
					$GLOBALS["fire_certificate_grid"]->BusinessNo->IsDetailKey = TRUE;
					$GLOBALS["fire_certificate_grid"]->BusinessNo->CurrentValue = $this->BusinessNo->CurrentValue;
					$GLOBALS["fire_certificate_grid"]->BusinessNo->setSessionValue($GLOBALS["fire_certificate_grid"]->BusinessNo->CurrentValue);
					$GLOBALS["fire_certificate_grid"]->BillPeriod->IsDetailKey = TRUE;
					$GLOBALS["fire_certificate_grid"]->BillPeriod->CurrentValue = $this->BillPeriod->CurrentValue;
					$GLOBALS["fire_certificate_grid"]->BillPeriod->setSessionValue($GLOBALS["fire_certificate_grid"]->BillPeriod->CurrentValue);
					$GLOBALS["fire_certificate_grid"]->PeriodType->IsDetailKey = TRUE;
					$GLOBALS["fire_certificate_grid"]->PeriodType->CurrentValue = $this->PeriodType->CurrentValue;
					$GLOBALS["fire_certificate_grid"]->PeriodType->setSessionValue($GLOBALS["fire_certificate_grid"]->PeriodType->CurrentValue);
					$GLOBALS["fire_certificate_grid"]->BillYear->IsDetailKey = TRUE;
					$GLOBALS["fire_certificate_grid"]->BillYear->CurrentValue = $this->BillYear->CurrentValue;
					$GLOBALS["fire_certificate_grid"]->BillYear->setSessionValue($GLOBALS["fire_certificate_grid"]->BillYear->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("licence_accountlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('health_certificate');
		$pages->add('fire_certificate');
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