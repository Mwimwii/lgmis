<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ticket_edit extends ticket
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ticket';

	// Page object name
	public $PageObjName = "ticket_edit";

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

		// Table object (ticket)
		if (!isset($GLOBALS["ticket"]) || get_class($GLOBALS["ticket"]) == PROJECT_NAMESPACE . "ticket") {
			$GLOBALS["ticket"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticket"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticket');

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
		global $ticket;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ticket);
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
					if ($pageName == "ticketview.php")
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
			$key .= @$ar['TicketNumber'];
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
			$this->TicketNumber->Visible = FALSE;
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
					$this->terminate(GetUrl("ticketlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Subject->setVisibility();
		$this->TicketReportDate->setVisibility();
		$this->IncidentDate->setVisibility();
		$this->IncidentTime->setVisibility();
		$this->TicketDescription->setVisibility();
		$this->TicketCategory->setVisibility();
		$this->TicketType->setVisibility();
		$this->ReportedBy->setVisibility();
		$this->TicketStatus->setVisibility();
		$this->TicketNumber->setVisibility();
		$this->ReporterEmail->setVisibility();
		$this->ReporterMobile->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->DeptSection->setVisibility();
		$this->TicketLevel->setVisibility();
		$this->AllocatedTo->setVisibility();
		$this->EscalatedTo->setVisibility();
		$this->TicketSolution->setVisibility();
		$this->Evidence->setVisibility();
		$this->SeverityLevel->setVisibility();
		$this->Days->setVisibility();
		$this->DataLastUpdated->setVisibility();
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
		$this->setupLookupOptions($this->TicketCategory);
		$this->setupLookupOptions($this->TicketType);
		$this->setupLookupOptions($this->ReportedBy);
		$this->setupLookupOptions($this->TicketStatus);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->AllocatedTo);
		$this->setupLookupOptions($this->EscalatedTo);
		$this->setupLookupOptions($this->SeverityLevel);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ticketlist.php");
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
			if (Get("TicketNumber") !== NULL) {
				$this->TicketNumber->setQueryStringValue(Get("TicketNumber"));
				$this->TicketNumber->setOldValue($this->TicketNumber->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->TicketNumber->setQueryStringValue(Key(0));
				$this->TicketNumber->setOldValue($this->TicketNumber->QueryStringValue);
			} elseif (Post("TicketNumber") !== NULL) {
				$this->TicketNumber->setFormValue(Post("TicketNumber"));
				$this->TicketNumber->setOldValue($this->TicketNumber->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->TicketNumber->setQueryStringValue(Route(2));
				$this->TicketNumber->setOldValue($this->TicketNumber->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_TicketNumber")) {
					$this->TicketNumber->setFormValue($CurrentForm->getValue("x_TicketNumber"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("TicketNumber") !== NULL) {
					$this->TicketNumber->setQueryStringValue(Get("TicketNumber"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->TicketNumber->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->TicketNumber->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("ticketlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->TicketNumber->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->TicketNumber->CurrentValue, $rs->fields('TicketNumber'))) {
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
					$this->terminate("ticketlist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "ticketlist.php")
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
		$this->Evidence->Upload->Index = $CurrentForm->Index;
		$this->Evidence->Upload->uploadFile();
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Subject' first before field var 'x_Subject'
		$val = $CurrentForm->hasValue("Subject") ? $CurrentForm->getValue("Subject") : $CurrentForm->getValue("x_Subject");
		if (!$this->Subject->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Subject->Visible = FALSE; // Disable update for API request
			else
				$this->Subject->setFormValue($val);
		}

		// Check field name 'TicketReportDate' first before field var 'x_TicketReportDate'
		$val = $CurrentForm->hasValue("TicketReportDate") ? $CurrentForm->getValue("TicketReportDate") : $CurrentForm->getValue("x_TicketReportDate");
		if (!$this->TicketReportDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketReportDate->Visible = FALSE; // Disable update for API request
			else
				$this->TicketReportDate->setFormValue($val);
			$this->TicketReportDate->CurrentValue = UnFormatDateTime($this->TicketReportDate->CurrentValue, 0);
		}

		// Check field name 'IncidentDate' first before field var 'x_IncidentDate'
		$val = $CurrentForm->hasValue("IncidentDate") ? $CurrentForm->getValue("IncidentDate") : $CurrentForm->getValue("x_IncidentDate");
		if (!$this->IncidentDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncidentDate->Visible = FALSE; // Disable update for API request
			else
				$this->IncidentDate->setFormValue($val);
			$this->IncidentDate->CurrentValue = UnFormatDateTime($this->IncidentDate->CurrentValue, 0);
		}

		// Check field name 'IncidentTime' first before field var 'x_IncidentTime'
		$val = $CurrentForm->hasValue("IncidentTime") ? $CurrentForm->getValue("IncidentTime") : $CurrentForm->getValue("x_IncidentTime");
		if (!$this->IncidentTime->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncidentTime->Visible = FALSE; // Disable update for API request
			else
				$this->IncidentTime->setFormValue($val);
			$this->IncidentTime->CurrentValue = UnFormatDateTime($this->IncidentTime->CurrentValue, 4);
		}

		// Check field name 'TicketDescription' first before field var 'x_TicketDescription'
		$val = $CurrentForm->hasValue("TicketDescription") ? $CurrentForm->getValue("TicketDescription") : $CurrentForm->getValue("x_TicketDescription");
		if (!$this->TicketDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketDescription->Visible = FALSE; // Disable update for API request
			else
				$this->TicketDescription->setFormValue($val);
		}

		// Check field name 'TicketCategory' first before field var 'x_TicketCategory'
		$val = $CurrentForm->hasValue("TicketCategory") ? $CurrentForm->getValue("TicketCategory") : $CurrentForm->getValue("x_TicketCategory");
		if (!$this->TicketCategory->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketCategory->Visible = FALSE; // Disable update for API request
			else
				$this->TicketCategory->setFormValue($val);
		}

		// Check field name 'TicketType' first before field var 'x_TicketType'
		$val = $CurrentForm->hasValue("TicketType") ? $CurrentForm->getValue("TicketType") : $CurrentForm->getValue("x_TicketType");
		if (!$this->TicketType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketType->Visible = FALSE; // Disable update for API request
			else
				$this->TicketType->setFormValue($val);
		}

		// Check field name 'ReportedBy' first before field var 'x_ReportedBy'
		$val = $CurrentForm->hasValue("ReportedBy") ? $CurrentForm->getValue("ReportedBy") : $CurrentForm->getValue("x_ReportedBy");
		if (!$this->ReportedBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReportedBy->Visible = FALSE; // Disable update for API request
			else
				$this->ReportedBy->setFormValue($val);
		}

		// Check field name 'TicketStatus' first before field var 'x_TicketStatus'
		$val = $CurrentForm->hasValue("TicketStatus") ? $CurrentForm->getValue("TicketStatus") : $CurrentForm->getValue("x_TicketStatus");
		if (!$this->TicketStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketStatus->Visible = FALSE; // Disable update for API request
			else
				$this->TicketStatus->setFormValue($val);
		}

		// Check field name 'TicketNumber' first before field var 'x_TicketNumber'
		$val = $CurrentForm->hasValue("TicketNumber") ? $CurrentForm->getValue("TicketNumber") : $CurrentForm->getValue("x_TicketNumber");
		if (!$this->TicketNumber->IsDetailKey)
			$this->TicketNumber->setFormValue($val);

		// Check field name 'ReporterEmail' first before field var 'x_ReporterEmail'
		$val = $CurrentForm->hasValue("ReporterEmail") ? $CurrentForm->getValue("ReporterEmail") : $CurrentForm->getValue("x_ReporterEmail");
		if (!$this->ReporterEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReporterEmail->Visible = FALSE; // Disable update for API request
			else
				$this->ReporterEmail->setFormValue($val);
		}

		// Check field name 'ReporterMobile' first before field var 'x_ReporterMobile'
		$val = $CurrentForm->hasValue("ReporterMobile") ? $CurrentForm->getValue("ReporterMobile") : $CurrentForm->getValue("x_ReporterMobile");
		if (!$this->ReporterMobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReporterMobile->Visible = FALSE; // Disable update for API request
			else
				$this->ReporterMobile->setFormValue($val);
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

		// Check field name 'DeptSection' first before field var 'x_DeptSection'
		$val = $CurrentForm->hasValue("DeptSection") ? $CurrentForm->getValue("DeptSection") : $CurrentForm->getValue("x_DeptSection");
		if (!$this->DeptSection->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeptSection->Visible = FALSE; // Disable update for API request
			else
				$this->DeptSection->setFormValue($val);
		}

		// Check field name 'TicketLevel' first before field var 'x_TicketLevel'
		$val = $CurrentForm->hasValue("TicketLevel") ? $CurrentForm->getValue("TicketLevel") : $CurrentForm->getValue("x_TicketLevel");
		if (!$this->TicketLevel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketLevel->Visible = FALSE; // Disable update for API request
			else
				$this->TicketLevel->setFormValue($val);
		}

		// Check field name 'AllocatedTo' first before field var 'x_AllocatedTo'
		$val = $CurrentForm->hasValue("AllocatedTo") ? $CurrentForm->getValue("AllocatedTo") : $CurrentForm->getValue("x_AllocatedTo");
		if (!$this->AllocatedTo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AllocatedTo->Visible = FALSE; // Disable update for API request
			else
				$this->AllocatedTo->setFormValue($val);
		}

		// Check field name 'EscalatedTo' first before field var 'x_EscalatedTo'
		$val = $CurrentForm->hasValue("EscalatedTo") ? $CurrentForm->getValue("EscalatedTo") : $CurrentForm->getValue("x_EscalatedTo");
		if (!$this->EscalatedTo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EscalatedTo->Visible = FALSE; // Disable update for API request
			else
				$this->EscalatedTo->setFormValue($val);
		}

		// Check field name 'TicketSolution' first before field var 'x_TicketSolution'
		$val = $CurrentForm->hasValue("TicketSolution") ? $CurrentForm->getValue("TicketSolution") : $CurrentForm->getValue("x_TicketSolution");
		if (!$this->TicketSolution->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TicketSolution->Visible = FALSE; // Disable update for API request
			else
				$this->TicketSolution->setFormValue($val);
		}

		// Check field name 'SeverityLevel' first before field var 'x_SeverityLevel'
		$val = $CurrentForm->hasValue("SeverityLevel") ? $CurrentForm->getValue("SeverityLevel") : $CurrentForm->getValue("x_SeverityLevel");
		if (!$this->SeverityLevel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SeverityLevel->Visible = FALSE; // Disable update for API request
			else
				$this->SeverityLevel->setFormValue($val);
		}

		// Check field name 'Days' first before field var 'x_Days'
		$val = $CurrentForm->hasValue("Days") ? $CurrentForm->getValue("Days") : $CurrentForm->getValue("x_Days");
		if (!$this->Days->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Days->Visible = FALSE; // Disable update for API request
			else
				$this->Days->setFormValue($val);
		}

		// Check field name 'DataLastUpdated' first before field var 'x_DataLastUpdated'
		$val = $CurrentForm->hasValue("DataLastUpdated") ? $CurrentForm->getValue("DataLastUpdated") : $CurrentForm->getValue("x_DataLastUpdated");
		if (!$this->DataLastUpdated->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DataLastUpdated->Visible = FALSE; // Disable update for API request
			else
				$this->DataLastUpdated->setFormValue($val);
			$this->DataLastUpdated->CurrentValue = UnFormatDateTime($this->DataLastUpdated->CurrentValue, 0);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Subject->CurrentValue = $this->Subject->FormValue;
		$this->TicketReportDate->CurrentValue = $this->TicketReportDate->FormValue;
		$this->TicketReportDate->CurrentValue = UnFormatDateTime($this->TicketReportDate->CurrentValue, 0);
		$this->IncidentDate->CurrentValue = $this->IncidentDate->FormValue;
		$this->IncidentDate->CurrentValue = UnFormatDateTime($this->IncidentDate->CurrentValue, 0);
		$this->IncidentTime->CurrentValue = $this->IncidentTime->FormValue;
		$this->IncidentTime->CurrentValue = UnFormatDateTime($this->IncidentTime->CurrentValue, 4);
		$this->TicketDescription->CurrentValue = $this->TicketDescription->FormValue;
		$this->TicketCategory->CurrentValue = $this->TicketCategory->FormValue;
		$this->TicketType->CurrentValue = $this->TicketType->FormValue;
		$this->ReportedBy->CurrentValue = $this->ReportedBy->FormValue;
		$this->TicketStatus->CurrentValue = $this->TicketStatus->FormValue;
		$this->TicketNumber->CurrentValue = $this->TicketNumber->FormValue;
		$this->ReporterEmail->CurrentValue = $this->ReporterEmail->FormValue;
		$this->ReporterMobile->CurrentValue = $this->ReporterMobile->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->DeptSection->CurrentValue = $this->DeptSection->FormValue;
		$this->TicketLevel->CurrentValue = $this->TicketLevel->FormValue;
		$this->AllocatedTo->CurrentValue = $this->AllocatedTo->FormValue;
		$this->EscalatedTo->CurrentValue = $this->EscalatedTo->FormValue;
		$this->TicketSolution->CurrentValue = $this->TicketSolution->FormValue;
		$this->SeverityLevel->CurrentValue = $this->SeverityLevel->FormValue;
		$this->Days->CurrentValue = $this->Days->FormValue;
		$this->DataLastUpdated->CurrentValue = $this->DataLastUpdated->FormValue;
		$this->DataLastUpdated->CurrentValue = UnFormatDateTime($this->DataLastUpdated->CurrentValue, 0);
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
		$this->Subject->setDbValue($row['Subject']);
		$this->TicketReportDate->setDbValue($row['TicketReportDate']);
		$this->IncidentDate->setDbValue($row['IncidentDate']);
		$this->IncidentTime->setDbValue($row['IncidentTime']);
		$this->TicketDescription->setDbValue($row['TicketDescription']);
		$this->TicketCategory->setDbValue($row['TicketCategory']);
		$this->TicketType->setDbValue($row['TicketType']);
		$this->ReportedBy->setDbValue($row['ReportedBy']);
		$this->TicketStatus->setDbValue($row['TicketStatus']);
		$this->TicketNumber->setDbValue($row['TicketNumber']);
		$this->ReporterEmail->setDbValue($row['ReporterEmail']);
		$this->ReporterMobile->setDbValue($row['ReporterMobile']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->DeptSection->setDbValue($row['DeptSection']);
		$this->TicketLevel->setDbValue($row['TicketLevel']);
		$this->AllocatedTo->setDbValue($row['AllocatedTo']);
		$this->EscalatedTo->setDbValue($row['EscalatedTo']);
		$this->TicketSolution->setDbValue($row['TicketSolution']);
		$this->Evidence->Upload->DbValue = $row['Evidence'];
		if (is_array($this->Evidence->Upload->DbValue) || is_object($this->Evidence->Upload->DbValue)) // Byte array
			$this->Evidence->Upload->DbValue = BytesToString($this->Evidence->Upload->DbValue);
		$this->SeverityLevel->setDbValue($row['SeverityLevel']);
		$this->Days->setDbValue($row['Days']);
		$this->DataLastUpdated->setDbValue($row['DataLastUpdated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['Subject'] = NULL;
		$row['TicketReportDate'] = NULL;
		$row['IncidentDate'] = NULL;
		$row['IncidentTime'] = NULL;
		$row['TicketDescription'] = NULL;
		$row['TicketCategory'] = NULL;
		$row['TicketType'] = NULL;
		$row['ReportedBy'] = NULL;
		$row['TicketStatus'] = NULL;
		$row['TicketNumber'] = NULL;
		$row['ReporterEmail'] = NULL;
		$row['ReporterMobile'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['DeptSection'] = NULL;
		$row['TicketLevel'] = NULL;
		$row['AllocatedTo'] = NULL;
		$row['EscalatedTo'] = NULL;
		$row['TicketSolution'] = NULL;
		$row['Evidence'] = NULL;
		$row['SeverityLevel'] = NULL;
		$row['Days'] = NULL;
		$row['DataLastUpdated'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("TicketNumber")) != "")
			$this->TicketNumber->OldValue = $this->getKey("TicketNumber"); // TicketNumber
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

		if ($this->Days->FormValue == $this->Days->CurrentValue && is_numeric(ConvertToFloatString($this->Days->CurrentValue)))
			$this->Days->CurrentValue = ConvertToFloatString($this->Days->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Subject
		// TicketReportDate
		// IncidentDate
		// IncidentTime
		// TicketDescription
		// TicketCategory
		// TicketType
		// ReportedBy
		// TicketStatus
		// TicketNumber
		// ReporterEmail
		// ReporterMobile
		// ProvinceCode
		// LACode
		// DepartmentCode
		// DeptSection
		// TicketLevel
		// AllocatedTo
		// EscalatedTo
		// TicketSolution
		// Evidence
		// SeverityLevel
		// Days
		// DataLastUpdated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// TicketReportDate
			$this->TicketReportDate->ViewValue = $this->TicketReportDate->CurrentValue;
			$this->TicketReportDate->ViewValue = FormatDateTime($this->TicketReportDate->ViewValue, 0);
			$this->TicketReportDate->ViewCustomAttributes = "";

			// IncidentDate
			$this->IncidentDate->ViewValue = $this->IncidentDate->CurrentValue;
			$this->IncidentDate->ViewValue = FormatDateTime($this->IncidentDate->ViewValue, 0);
			$this->IncidentDate->ViewCustomAttributes = "";

			// IncidentTime
			$this->IncidentTime->ViewValue = $this->IncidentTime->CurrentValue;
			$this->IncidentTime->ViewValue = FormatDateTime($this->IncidentTime->ViewValue, 4);
			$this->IncidentTime->ViewCustomAttributes = "";

			// TicketDescription
			$this->TicketDescription->ViewValue = $this->TicketDescription->CurrentValue;
			$this->TicketDescription->ViewCustomAttributes = "";

			// TicketCategory
			$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
			$curVal = strval($this->TicketCategory->CurrentValue);
			if ($curVal != "") {
				$this->TicketCategory->ViewValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketCategory->ViewValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
					}
				}
			} else {
				$this->TicketCategory->ViewValue = NULL;
			}
			$this->TicketCategory->ViewCustomAttributes = "";

			// TicketType
			$curVal = strval($this->TicketType->CurrentValue);
			if ($curVal != "") {
				$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
				if ($this->TicketType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketType->ViewValue = $this->TicketType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketType->ViewValue = $this->TicketType->CurrentValue;
					}
				}
			} else {
				$this->TicketType->ViewValue = NULL;
			}
			$this->TicketType->ViewCustomAttributes = "";

			// ReportedBy
			$curVal = strval($this->ReportedBy->CurrentValue);
			if ($curVal != "") {
				$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
				if ($this->ReportedBy->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UserCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReportedBy->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReportedBy->ViewValue = $this->ReportedBy->CurrentValue;
					}
				}
			} else {
				$this->ReportedBy->ViewValue = NULL;
			}
			$this->ReportedBy->ViewCustomAttributes = "";

			// TicketStatus
			$curVal = strval($this->TicketStatus->CurrentValue);
			if ($curVal != "") {
				$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
				if ($this->TicketStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketStatus->ViewValue = $this->TicketStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketStatus->ViewValue = $this->TicketStatus->CurrentValue;
					}
				}
			} else {
				$this->TicketStatus->ViewValue = NULL;
			}
			$this->TicketStatus->ViewCustomAttributes = "";

			// TicketNumber
			$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// ReporterEmail
			$this->ReporterEmail->ViewValue = $this->ReporterEmail->CurrentValue;
			$this->ReporterEmail->ViewCustomAttributes = "";

			// ReporterMobile
			$this->ReporterMobile->ViewValue = $this->ReporterMobile->CurrentValue;
			$this->ReporterMobile->ViewCustomAttributes = "";

			// ProvinceCode
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

			// DeptSection
			$this->DeptSection->ViewCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->ViewValue = $this->TicketLevel->CurrentValue;
			$this->TicketLevel->ViewCustomAttributes = "";

			// AllocatedTo
			$curVal = strval($this->AllocatedTo->CurrentValue);
			if ($curVal != "") {
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
				if ($this->AllocatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AllocatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->CurrentValue;
					}
				}
			} else {
				$this->AllocatedTo->ViewValue = NULL;
			}
			$this->AllocatedTo->ViewCustomAttributes = "";

			// EscalatedTo
			$curVal = strval($this->EscalatedTo->CurrentValue);
			if ($curVal != "") {
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
				if ($this->EscalatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EscalatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->CurrentValue;
					}
				}
			} else {
				$this->EscalatedTo->ViewValue = NULL;
			}
			$this->EscalatedTo->ViewCustomAttributes = "";

			// TicketSolution
			$this->TicketSolution->ViewValue = $this->TicketSolution->CurrentValue;
			$this->TicketSolution->ViewCustomAttributes = "";

			// Evidence
			if (!EmptyValue($this->Evidence->Upload->DbValue)) {
				$this->Evidence->ViewValue = $this->TicketNumber->CurrentValue;
				$this->Evidence->IsBlobImage = IsImageFile(ContentExtension($this->Evidence->Upload->DbValue));
			} else {
				$this->Evidence->ViewValue = "";
			}
			$this->Evidence->ViewCustomAttributes = "";

			// SeverityLevel
			$curVal = strval($this->SeverityLevel->CurrentValue);
			if ($curVal != "") {
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
				if ($this->SeverityLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SeverityLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->CurrentValue;
					}
				}
			} else {
				$this->SeverityLevel->ViewValue = NULL;
			}
			$this->SeverityLevel->ViewCustomAttributes = "";

			// Days
			$this->Days->ViewValue = $this->Days->CurrentValue;
			$this->Days->ViewValue = FormatNumber($this->Days->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Days->ViewCustomAttributes = "";

			// DataLastUpdated
			$this->DataLastUpdated->ViewValue = $this->DataLastUpdated->CurrentValue;
			$this->DataLastUpdated->ViewValue = FormatDateTime($this->DataLastUpdated->ViewValue, 0);
			$this->DataLastUpdated->ViewCustomAttributes = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";

			// TicketReportDate
			$this->TicketReportDate->LinkCustomAttributes = "";
			$this->TicketReportDate->HrefValue = "";
			$this->TicketReportDate->TooltipValue = "";

			// IncidentDate
			$this->IncidentDate->LinkCustomAttributes = "";
			$this->IncidentDate->HrefValue = "";
			$this->IncidentDate->TooltipValue = "";

			// IncidentTime
			$this->IncidentTime->LinkCustomAttributes = "";
			$this->IncidentTime->HrefValue = "";
			$this->IncidentTime->TooltipValue = "";

			// TicketDescription
			$this->TicketDescription->LinkCustomAttributes = "";
			$this->TicketDescription->HrefValue = "";
			$this->TicketDescription->TooltipValue = "";

			// TicketCategory
			$this->TicketCategory->LinkCustomAttributes = "";
			$this->TicketCategory->HrefValue = "";
			$this->TicketCategory->TooltipValue = "";

			// TicketType
			$this->TicketType->LinkCustomAttributes = "";
			$this->TicketType->HrefValue = "";
			$this->TicketType->TooltipValue = "";

			// ReportedBy
			$this->ReportedBy->LinkCustomAttributes = "";
			$this->ReportedBy->HrefValue = "";
			$this->ReportedBy->TooltipValue = "";

			// TicketStatus
			$this->TicketStatus->LinkCustomAttributes = "";
			$this->TicketStatus->HrefValue = "";
			$this->TicketStatus->TooltipValue = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";
			$this->TicketNumber->TooltipValue = "";

			// ReporterEmail
			$this->ReporterEmail->LinkCustomAttributes = "";
			$this->ReporterEmail->HrefValue = "";
			$this->ReporterEmail->TooltipValue = "";

			// ReporterMobile
			$this->ReporterMobile->LinkCustomAttributes = "";
			$this->ReporterMobile->HrefValue = "";
			$this->ReporterMobile->TooltipValue = "";

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

			// DeptSection
			$this->DeptSection->LinkCustomAttributes = "";
			$this->DeptSection->HrefValue = "";
			$this->DeptSection->TooltipValue = "";

			// TicketLevel
			$this->TicketLevel->LinkCustomAttributes = "";
			$this->TicketLevel->HrefValue = "";
			$this->TicketLevel->TooltipValue = "";

			// AllocatedTo
			$this->AllocatedTo->LinkCustomAttributes = "";
			$this->AllocatedTo->HrefValue = "";
			$this->AllocatedTo->TooltipValue = "";

			// EscalatedTo
			$this->EscalatedTo->LinkCustomAttributes = "";
			$this->EscalatedTo->HrefValue = "";
			$this->EscalatedTo->TooltipValue = "";

			// TicketSolution
			$this->TicketSolution->LinkCustomAttributes = "";
			$this->TicketSolution->HrefValue = "";
			$this->TicketSolution->TooltipValue = "";

			// Evidence
			$this->Evidence->LinkCustomAttributes = "";
			if (!empty($this->Evidence->Upload->DbValue)) {
				$this->Evidence->HrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);
				$this->Evidence->LinkAttrs["target"] = "";
				if ($this->Evidence->IsBlobImage && empty($this->Evidence->LinkAttrs["target"]))
					$this->Evidence->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Evidence->HrefValue = FullUrl($this->Evidence->HrefValue, "href");
			} else {
				$this->Evidence->HrefValue = "";
			}
			$this->Evidence->ExportHrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);
			$this->Evidence->TooltipValue = "";

			// SeverityLevel
			$this->SeverityLevel->LinkCustomAttributes = "";
			$this->SeverityLevel->HrefValue = "";
			$this->SeverityLevel->TooltipValue = "";

			// Days
			$this->Days->LinkCustomAttributes = "";
			$this->Days->HrefValue = "";
			$this->Days->TooltipValue = "";

			// DataLastUpdated
			$this->DataLastUpdated->LinkCustomAttributes = "";
			$this->DataLastUpdated->HrefValue = "";
			$this->DataLastUpdated->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Subject
			$this->Subject->EditAttrs["class"] = "form-control";
			$this->Subject->EditCustomAttributes = "";
			if (!$this->Subject->Raw)
				$this->Subject->CurrentValue = HtmlDecode($this->Subject->CurrentValue);
			$this->Subject->EditValue = HtmlEncode($this->Subject->CurrentValue);
			$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

			// TicketReportDate
			$this->TicketReportDate->EditAttrs["class"] = "form-control";
			$this->TicketReportDate->EditCustomAttributes = "";
			$this->TicketReportDate->EditValue = HtmlEncode(FormatDateTime($this->TicketReportDate->CurrentValue, 8));
			$this->TicketReportDate->PlaceHolder = RemoveHtml($this->TicketReportDate->caption());

			// IncidentDate
			$this->IncidentDate->EditAttrs["class"] = "form-control";
			$this->IncidentDate->EditCustomAttributes = "";
			$this->IncidentDate->EditValue = HtmlEncode(FormatDateTime($this->IncidentDate->CurrentValue, 8));
			$this->IncidentDate->PlaceHolder = RemoveHtml($this->IncidentDate->caption());

			// IncidentTime
			$this->IncidentTime->EditAttrs["class"] = "form-control";
			$this->IncidentTime->EditCustomAttributes = "";
			$this->IncidentTime->EditValue = HtmlEncode($this->IncidentTime->CurrentValue);
			$this->IncidentTime->PlaceHolder = RemoveHtml($this->IncidentTime->caption());

			// TicketDescription
			$this->TicketDescription->EditAttrs["class"] = "form-control";
			$this->TicketDescription->EditCustomAttributes = "";
			$this->TicketDescription->EditValue = HtmlEncode($this->TicketDescription->CurrentValue);
			$this->TicketDescription->PlaceHolder = RemoveHtml($this->TicketDescription->caption());

			// TicketCategory
			$this->TicketCategory->EditAttrs["class"] = "form-control";
			$this->TicketCategory->EditCustomAttributes = "";
			$this->TicketCategory->EditValue = HtmlEncode($this->TicketCategory->CurrentValue);
			$curVal = strval($this->TicketCategory->CurrentValue);
			if ($curVal != "") {
				$this->TicketCategory->EditValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->EditValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->TicketCategory->EditValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->EditValue = HtmlEncode($this->TicketCategory->CurrentValue);
					}
				}
			} else {
				$this->TicketCategory->EditValue = NULL;
			}
			$this->TicketCategory->PlaceHolder = RemoveHtml($this->TicketCategory->caption());

			// TicketType
			$this->TicketType->EditAttrs["class"] = "form-control";
			$this->TicketType->EditCustomAttributes = "";
			$curVal = trim(strval($this->TicketType->CurrentValue));
			if ($curVal != "")
				$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
			else
				$this->TicketType->ViewValue = $this->TicketType->Lookup !== NULL && is_array($this->TicketType->Lookup->Options) ? $curVal : NULL;
			if ($this->TicketType->ViewValue !== NULL) { // Load from cache
				$this->TicketType->EditValue = array_values($this->TicketType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`TicketType`" . SearchString("=", $this->TicketType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TicketType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TicketType->EditValue = $arwrk;
			}

			// ReportedBy
			$this->ReportedBy->EditCustomAttributes = "";
			$curVal = trim(strval($this->ReportedBy->CurrentValue));
			if ($curVal != "")
				$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
			else
				$this->ReportedBy->ViewValue = $this->ReportedBy->Lookup !== NULL && is_array($this->ReportedBy->Lookup->Options) ? $curVal : NULL;
			if ($this->ReportedBy->ViewValue !== NULL) { // Load from cache
				$this->ReportedBy->EditValue = array_values($this->ReportedBy->Lookup->Options);
				if ($this->ReportedBy->ViewValue == "")
					$this->ReportedBy->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`UserCode`" . SearchString("=", $this->ReportedBy->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ReportedBy->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
					$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
				} else {
					$this->ReportedBy->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ReportedBy->EditValue = $arwrk;
			}

			// TicketStatus
			$this->TicketStatus->EditAttrs["class"] = "form-control";
			$this->TicketStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->TicketStatus->CurrentValue));
			if ($curVal != "")
				$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
			else
				$this->TicketStatus->ViewValue = $this->TicketStatus->Lookup !== NULL && is_array($this->TicketStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->TicketStatus->ViewValue !== NULL) { // Load from cache
				$this->TicketStatus->EditValue = array_values($this->TicketStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`StatusCode`" . SearchString("=", $this->TicketStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TicketStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TicketStatus->EditValue = $arwrk;
			}

			// TicketNumber
			$this->TicketNumber->EditAttrs["class"] = "form-control";
			$this->TicketNumber->EditCustomAttributes = "";
			$this->TicketNumber->EditValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// ReporterEmail
			$this->ReporterEmail->EditAttrs["class"] = "form-control";
			$this->ReporterEmail->EditCustomAttributes = "";
			if (!$this->ReporterEmail->Raw)
				$this->ReporterEmail->CurrentValue = HtmlDecode($this->ReporterEmail->CurrentValue);
			$this->ReporterEmail->EditValue = HtmlEncode($this->ReporterEmail->CurrentValue);
			$this->ReporterEmail->PlaceHolder = RemoveHtml($this->ReporterEmail->caption());

			// ReporterMobile
			$this->ReporterMobile->EditAttrs["class"] = "form-control";
			$this->ReporterMobile->EditCustomAttributes = "";
			if (!$this->ReporterMobile->Raw)
				$this->ReporterMobile->CurrentValue = HtmlDecode($this->ReporterMobile->CurrentValue);
			$this->ReporterMobile->EditValue = HtmlEncode($this->ReporterMobile->CurrentValue);
			$this->ReporterMobile->PlaceHolder = RemoveHtml($this->ReporterMobile->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProvinceCode->CurrentValue));
			if ($curVal != "")
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			else
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
				$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProvinceCode->EditValue = $arwrk;
			}

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

			// DeptSection
			$this->DeptSection->EditAttrs["class"] = "form-control";
			$this->DeptSection->EditCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->EditAttrs["class"] = "form-control";
			$this->TicketLevel->EditCustomAttributes = "";
			$this->TicketLevel->EditValue = HtmlEncode($this->TicketLevel->CurrentValue);
			$this->TicketLevel->PlaceHolder = RemoveHtml($this->TicketLevel->caption());

			// AllocatedTo
			$this->AllocatedTo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AllocatedTo->CurrentValue));
			if ($curVal != "")
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
			else
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->Lookup !== NULL && is_array($this->AllocatedTo->Lookup->Options) ? $curVal : NULL;
			if ($this->AllocatedTo->ViewValue !== NULL) { // Load from cache
				$this->AllocatedTo->EditValue = array_values($this->AllocatedTo->Lookup->Options);
				if ($this->AllocatedTo->ViewValue == "")
					$this->AllocatedTo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $this->AllocatedTo->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AllocatedTo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
				} else {
					$this->AllocatedTo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AllocatedTo->EditValue = $arwrk;
			}

			// EscalatedTo
			$this->EscalatedTo->EditCustomAttributes = "";
			$curVal = trim(strval($this->EscalatedTo->CurrentValue));
			if ($curVal != "")
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
			else
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->Lookup !== NULL && is_array($this->EscalatedTo->Lookup->Options) ? $curVal : NULL;
			if ($this->EscalatedTo->ViewValue !== NULL) { // Load from cache
				$this->EscalatedTo->EditValue = array_values($this->EscalatedTo->Lookup->Options);
				if ($this->EscalatedTo->ViewValue == "")
					$this->EscalatedTo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $this->EscalatedTo->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EscalatedTo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
				} else {
					$this->EscalatedTo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EscalatedTo->EditValue = $arwrk;
			}

			// TicketSolution
			$this->TicketSolution->EditAttrs["class"] = "form-control";
			$this->TicketSolution->EditCustomAttributes = "";
			$this->TicketSolution->EditValue = HtmlEncode($this->TicketSolution->CurrentValue);
			$this->TicketSolution->PlaceHolder = RemoveHtml($this->TicketSolution->caption());

			// Evidence
			$this->Evidence->EditAttrs["class"] = "form-control";
			$this->Evidence->EditCustomAttributes = "";
			if (!EmptyValue($this->Evidence->Upload->DbValue)) {
				$this->Evidence->EditValue = $this->TicketNumber->CurrentValue;
				$this->Evidence->IsBlobImage = IsImageFile(ContentExtension($this->Evidence->Upload->DbValue));
			} else {
				$this->Evidence->EditValue = "";
			}
			if ($this->isShow())
				RenderUploadField($this->Evidence);

			// SeverityLevel
			$this->SeverityLevel->EditAttrs["class"] = "form-control";
			$this->SeverityLevel->EditCustomAttributes = "";
			$curVal = trim(strval($this->SeverityLevel->CurrentValue));
			if ($curVal != "")
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
			else
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->Lookup !== NULL && is_array($this->SeverityLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->SeverityLevel->ViewValue !== NULL) { // Load from cache
				$this->SeverityLevel->EditValue = array_values($this->SeverityLevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $this->SeverityLevel->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SeverityLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SeverityLevel->EditValue = $arwrk;
			}

			// Days
			$this->Days->EditAttrs["class"] = "form-control";
			$this->Days->EditCustomAttributes = "";
			$this->Days->EditValue = HtmlEncode($this->Days->CurrentValue);
			$this->Days->PlaceHolder = RemoveHtml($this->Days->caption());
			if (strval($this->Days->EditValue) != "" && is_numeric($this->Days->EditValue))
				$this->Days->EditValue = FormatNumber($this->Days->EditValue, -2, -1, -2, 0);
			

			// DataLastUpdated
			$this->DataLastUpdated->EditAttrs["class"] = "form-control";
			$this->DataLastUpdated->EditCustomAttributes = "";
			$this->DataLastUpdated->EditValue = HtmlEncode(FormatDateTime($this->DataLastUpdated->CurrentValue, 8));
			$this->DataLastUpdated->PlaceHolder = RemoveHtml($this->DataLastUpdated->caption());

			// Edit refer script
			// Subject

			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";

			// TicketReportDate
			$this->TicketReportDate->LinkCustomAttributes = "";
			$this->TicketReportDate->HrefValue = "";

			// IncidentDate
			$this->IncidentDate->LinkCustomAttributes = "";
			$this->IncidentDate->HrefValue = "";

			// IncidentTime
			$this->IncidentTime->LinkCustomAttributes = "";
			$this->IncidentTime->HrefValue = "";

			// TicketDescription
			$this->TicketDescription->LinkCustomAttributes = "";
			$this->TicketDescription->HrefValue = "";

			// TicketCategory
			$this->TicketCategory->LinkCustomAttributes = "";
			$this->TicketCategory->HrefValue = "";

			// TicketType
			$this->TicketType->LinkCustomAttributes = "";
			$this->TicketType->HrefValue = "";

			// ReportedBy
			$this->ReportedBy->LinkCustomAttributes = "";
			$this->ReportedBy->HrefValue = "";

			// TicketStatus
			$this->TicketStatus->LinkCustomAttributes = "";
			$this->TicketStatus->HrefValue = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";

			// ReporterEmail
			$this->ReporterEmail->LinkCustomAttributes = "";
			$this->ReporterEmail->HrefValue = "";

			// ReporterMobile
			$this->ReporterMobile->LinkCustomAttributes = "";
			$this->ReporterMobile->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// DeptSection
			$this->DeptSection->LinkCustomAttributes = "";
			$this->DeptSection->HrefValue = "";

			// TicketLevel
			$this->TicketLevel->LinkCustomAttributes = "";
			$this->TicketLevel->HrefValue = "";

			// AllocatedTo
			$this->AllocatedTo->LinkCustomAttributes = "";
			$this->AllocatedTo->HrefValue = "";

			// EscalatedTo
			$this->EscalatedTo->LinkCustomAttributes = "";
			$this->EscalatedTo->HrefValue = "";

			// TicketSolution
			$this->TicketSolution->LinkCustomAttributes = "";
			$this->TicketSolution->HrefValue = "";

			// Evidence
			$this->Evidence->LinkCustomAttributes = "";
			if (!empty($this->Evidence->Upload->DbValue)) {
				$this->Evidence->HrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);
				$this->Evidence->LinkAttrs["target"] = "";
				if ($this->Evidence->IsBlobImage && empty($this->Evidence->LinkAttrs["target"]))
					$this->Evidence->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->Evidence->HrefValue = FullUrl($this->Evidence->HrefValue, "href");
			} else {
				$this->Evidence->HrefValue = "";
			}
			$this->Evidence->ExportHrefValue = GetFileUploadUrl($this->Evidence, $this->TicketNumber->CurrentValue);

			// SeverityLevel
			$this->SeverityLevel->LinkCustomAttributes = "";
			$this->SeverityLevel->HrefValue = "";

			// Days
			$this->Days->LinkCustomAttributes = "";
			$this->Days->HrefValue = "";

			// DataLastUpdated
			$this->DataLastUpdated->LinkCustomAttributes = "";
			$this->DataLastUpdated->HrefValue = "";
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
		if ($this->Subject->Required) {
			if (!$this->Subject->IsDetailKey && $this->Subject->FormValue != NULL && $this->Subject->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Subject->caption(), $this->Subject->RequiredErrorMessage));
			}
		}
		if ($this->TicketReportDate->Required) {
			if (!$this->TicketReportDate->IsDetailKey && $this->TicketReportDate->FormValue != NULL && $this->TicketReportDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketReportDate->caption(), $this->TicketReportDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->TicketReportDate->FormValue)) {
			AddMessage($FormError, $this->TicketReportDate->errorMessage());
		}
		if ($this->IncidentDate->Required) {
			if (!$this->IncidentDate->IsDetailKey && $this->IncidentDate->FormValue != NULL && $this->IncidentDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncidentDate->caption(), $this->IncidentDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->IncidentDate->FormValue)) {
			AddMessage($FormError, $this->IncidentDate->errorMessage());
		}
		if ($this->IncidentTime->Required) {
			if (!$this->IncidentTime->IsDetailKey && $this->IncidentTime->FormValue != NULL && $this->IncidentTime->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncidentTime->caption(), $this->IncidentTime->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->IncidentTime->FormValue)) {
			AddMessage($FormError, $this->IncidentTime->errorMessage());
		}
		if ($this->TicketDescription->Required) {
			if (!$this->TicketDescription->IsDetailKey && $this->TicketDescription->FormValue != NULL && $this->TicketDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketDescription->caption(), $this->TicketDescription->RequiredErrorMessage));
			}
		}
		if ($this->TicketCategory->Required) {
			if (!$this->TicketCategory->IsDetailKey && $this->TicketCategory->FormValue != NULL && $this->TicketCategory->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketCategory->caption(), $this->TicketCategory->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TicketCategory->FormValue)) {
			AddMessage($FormError, $this->TicketCategory->errorMessage());
		}
		if ($this->TicketType->Required) {
			if (!$this->TicketType->IsDetailKey && $this->TicketType->FormValue != NULL && $this->TicketType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketType->caption(), $this->TicketType->RequiredErrorMessage));
			}
		}
		if ($this->ReportedBy->Required) {
			if (!$this->ReportedBy->IsDetailKey && $this->ReportedBy->FormValue != NULL && $this->ReportedBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReportedBy->caption(), $this->ReportedBy->RequiredErrorMessage));
			}
		}
		if ($this->TicketStatus->Required) {
			if (!$this->TicketStatus->IsDetailKey && $this->TicketStatus->FormValue != NULL && $this->TicketStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketStatus->caption(), $this->TicketStatus->RequiredErrorMessage));
			}
		}
		if ($this->TicketNumber->Required) {
			if (!$this->TicketNumber->IsDetailKey && $this->TicketNumber->FormValue != NULL && $this->TicketNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketNumber->caption(), $this->TicketNumber->RequiredErrorMessage));
			}
		}
		if ($this->ReporterEmail->Required) {
			if (!$this->ReporterEmail->IsDetailKey && $this->ReporterEmail->FormValue != NULL && $this->ReporterEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReporterEmail->caption(), $this->ReporterEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->ReporterEmail->FormValue)) {
			AddMessage($FormError, $this->ReporterEmail->errorMessage());
		}
		if ($this->ReporterMobile->Required) {
			if (!$this->ReporterMobile->IsDetailKey && $this->ReporterMobile->FormValue != NULL && $this->ReporterMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReporterMobile->caption(), $this->ReporterMobile->RequiredErrorMessage));
			}
		}
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
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
		if ($this->DeptSection->Required) {
			if (!$this->DeptSection->IsDetailKey && $this->DeptSection->FormValue != NULL && $this->DeptSection->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeptSection->caption(), $this->DeptSection->RequiredErrorMessage));
			}
		}
		if ($this->TicketLevel->Required) {
			if (!$this->TicketLevel->IsDetailKey && $this->TicketLevel->FormValue != NULL && $this->TicketLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketLevel->caption(), $this->TicketLevel->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TicketLevel->FormValue)) {
			AddMessage($FormError, $this->TicketLevel->errorMessage());
		}
		if ($this->AllocatedTo->Required) {
			if (!$this->AllocatedTo->IsDetailKey && $this->AllocatedTo->FormValue != NULL && $this->AllocatedTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AllocatedTo->caption(), $this->AllocatedTo->RequiredErrorMessage));
			}
		}
		if ($this->EscalatedTo->Required) {
			if (!$this->EscalatedTo->IsDetailKey && $this->EscalatedTo->FormValue != NULL && $this->EscalatedTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EscalatedTo->caption(), $this->EscalatedTo->RequiredErrorMessage));
			}
		}
		if ($this->TicketSolution->Required) {
			if (!$this->TicketSolution->IsDetailKey && $this->TicketSolution->FormValue != NULL && $this->TicketSolution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TicketSolution->caption(), $this->TicketSolution->RequiredErrorMessage));
			}
		}
		if ($this->Evidence->Required) {
			if ($this->Evidence->Upload->FileName == "" && !$this->Evidence->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Evidence->caption(), $this->Evidence->RequiredErrorMessage));
			}
		}
		if ($this->SeverityLevel->Required) {
			if (!$this->SeverityLevel->IsDetailKey && $this->SeverityLevel->FormValue != NULL && $this->SeverityLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SeverityLevel->caption(), $this->SeverityLevel->RequiredErrorMessage));
			}
		}
		if ($this->Days->Required) {
			if (!$this->Days->IsDetailKey && $this->Days->FormValue != NULL && $this->Days->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Days->caption(), $this->Days->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Days->FormValue)) {
			AddMessage($FormError, $this->Days->errorMessage());
		}
		if ($this->DataLastUpdated->Required) {
			if (!$this->DataLastUpdated->IsDetailKey && $this->DataLastUpdated->FormValue != NULL && $this->DataLastUpdated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DataLastUpdated->caption(), $this->DataLastUpdated->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DataLastUpdated->FormValue)) {
			AddMessage($FormError, $this->DataLastUpdated->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("ticketmessage", $detailTblVar) && $GLOBALS["ticketmessage"]->DetailEdit) {
			if (!isset($GLOBALS["ticketmessage_grid"]))
				$GLOBALS["ticketmessage_grid"] = new ticketmessage_grid(); // Get detail page object
			$GLOBALS["ticketmessage_grid"]->validateGridForm();
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

			// Subject
			$this->Subject->setDbValueDef($rsnew, $this->Subject->CurrentValue, "", $this->Subject->ReadOnly);

			// TicketReportDate
			$this->TicketReportDate->setDbValueDef($rsnew, UnFormatDateTime($this->TicketReportDate->CurrentValue, 0), NULL, $this->TicketReportDate->ReadOnly);

			// IncidentDate
			$this->IncidentDate->setDbValueDef($rsnew, UnFormatDateTime($this->IncidentDate->CurrentValue, 0), NULL, $this->IncidentDate->ReadOnly);

			// IncidentTime
			$this->IncidentTime->setDbValueDef($rsnew, $this->IncidentTime->CurrentValue, CurrentTime(), $this->IncidentTime->ReadOnly);

			// TicketDescription
			$this->TicketDescription->setDbValueDef($rsnew, $this->TicketDescription->CurrentValue, NULL, $this->TicketDescription->ReadOnly);

			// TicketCategory
			$this->TicketCategory->setDbValueDef($rsnew, $this->TicketCategory->CurrentValue, 0, $this->TicketCategory->ReadOnly);

			// TicketType
			$this->TicketType->setDbValueDef($rsnew, $this->TicketType->CurrentValue, 0, $this->TicketType->ReadOnly);

			// ReportedBy
			$this->ReportedBy->setDbValueDef($rsnew, $this->ReportedBy->CurrentValue, 0, $this->ReportedBy->ReadOnly);

			// TicketStatus
			$this->TicketStatus->setDbValueDef($rsnew, $this->TicketStatus->CurrentValue, NULL, $this->TicketStatus->ReadOnly);

			// ReporterEmail
			$this->ReporterEmail->setDbValueDef($rsnew, $this->ReporterEmail->CurrentValue, NULL, $this->ReporterEmail->ReadOnly);

			// ReporterMobile
			$this->ReporterMobile->setDbValueDef($rsnew, $this->ReporterMobile->CurrentValue, NULL, $this->ReporterMobile->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// DeptSection
			$this->DeptSection->setDbValueDef($rsnew, $this->DeptSection->CurrentValue, NULL, $this->DeptSection->ReadOnly);

			// TicketLevel
			$this->TicketLevel->setDbValueDef($rsnew, $this->TicketLevel->CurrentValue, NULL, $this->TicketLevel->ReadOnly);

			// AllocatedTo
			$this->AllocatedTo->setDbValueDef($rsnew, $this->AllocatedTo->CurrentValue, NULL, $this->AllocatedTo->ReadOnly);

			// EscalatedTo
			$this->EscalatedTo->setDbValueDef($rsnew, $this->EscalatedTo->CurrentValue, NULL, $this->EscalatedTo->ReadOnly);

			// TicketSolution
			$this->TicketSolution->setDbValueDef($rsnew, $this->TicketSolution->CurrentValue, NULL, $this->TicketSolution->ReadOnly);

			// Evidence
			if ($this->Evidence->Visible && !$this->Evidence->ReadOnly && !$this->Evidence->Upload->KeepFile) {
				if ($this->Evidence->Upload->Value == NULL) {
					$rsnew['Evidence'] = NULL;
				} else {
					$rsnew['Evidence'] = $this->Evidence->Upload->Value;
				}
			}

			// SeverityLevel
			$this->SeverityLevel->setDbValueDef($rsnew, $this->SeverityLevel->CurrentValue, NULL, $this->SeverityLevel->ReadOnly);

			// Days
			$this->Days->setDbValueDef($rsnew, $this->Days->CurrentValue, NULL, $this->Days->ReadOnly);

			// DataLastUpdated
			$this->DataLastUpdated->setDbValueDef($rsnew, UnFormatDateTime($this->DataLastUpdated->CurrentValue, 0), NULL, $this->DataLastUpdated->ReadOnly);

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
					if (in_array("ticketmessage", $detailTblVar) && $GLOBALS["ticketmessage"]->DetailEdit) {
						if (!isset($GLOBALS["ticketmessage_grid"]))
							$GLOBALS["ticketmessage_grid"] = new ticketmessage_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "ticketmessage"); // Load user level of detail table
						$editRow = $GLOBALS["ticketmessage_grid"]->gridUpdate();
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

			// Evidence
			CleanUploadTempPath($this->Evidence, $this->Evidence->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
			if (in_array("ticketmessage", $detailTblVar)) {
				if (!isset($GLOBALS["ticketmessage_grid"]))
					$GLOBALS["ticketmessage_grid"] = new ticketmessage_grid();
				if ($GLOBALS["ticketmessage_grid"]->DetailEdit) {
					$GLOBALS["ticketmessage_grid"]->CurrentMode = "edit";
					$GLOBALS["ticketmessage_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["ticketmessage_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ticketmessage_grid"]->setStartRecordNumber(1);
					$GLOBALS["ticketmessage_grid"]->TicketNumber->IsDetailKey = TRUE;
					$GLOBALS["ticketmessage_grid"]->TicketNumber->CurrentValue = $this->TicketNumber->CurrentValue;
					$GLOBALS["ticketmessage_grid"]->TicketNumber->setSessionValue($GLOBALS["ticketmessage_grid"]->TicketNumber->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ticketlist.php"), "", $this->TableVar, TRUE);
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
				case "x_TicketCategory":
					break;
				case "x_TicketType":
					break;
				case "x_ReportedBy":
					break;
				case "x_TicketStatus":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_AllocatedTo":
					break;
				case "x_EscalatedTo":
					break;
				case "x_SeverityLevel":
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
						case "x_TicketCategory":
							break;
						case "x_TicketType":
							break;
						case "x_ReportedBy":
							break;
						case "x_TicketStatus":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_AllocatedTo":
							break;
						case "x_EscalatedTo":
							break;
						case "x_SeverityLevel":
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