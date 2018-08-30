<?php
// These constants are defined by Yodlee and should not be modified.

$CATEGORY_US = array(
 	1	=> "Uncategorized",
 	2	=> "Automotive Expenses",
 	3	=> "Charitable Giving",
 	4	=> "Child/Dependent Expenses",
 	5	=> "Clothing/Shoes",
 	6	=> "Education",
 	7	=> "Entertainment",
 	8	=> "Gasoline/Fuel",
 	9	=> "Gifts",
 	10	=> "Groceries",
 	11	=> "Healthcare/Medical",
 	12	=> "Home Maintenance",
 	13	=> "Home Improvement",
 	14	=> "Insurance",
 	15	=> "Cable/Satellite Services",
 	16	=> "Online Services",
 	17	=> "Loans",
 	18	=> "Mortgages",
 	19	=> "Other Expenses",
 	20	=> "Personal Care",
 	21	=> "Rent",
 	22	=> "Restaurants/Dining",
 	23	=> "Travel",
 	24	=> "Service Charges/Fees",
 	26	=> "Credit Card Payments",
 	27	=> "Deposits",
 	28	=> "Transfers",
 	29	=> "Paychecks/Salary",
 	30	=> "Investment Income",
 	31	=> "Retirement Income",
 	32	=> "Other Income",
 	33	=> "Checks",
 	34	=> "Hobbies",
 	35	=> "Other Bills",
 	36	=> "Securities Trades",
 	37	=> "Taxes",
 	38	=> "Telephone Services",
 	39	=> "Utilities",
 	40	=> "Savings",
 	41	=> "Retirement Contributions",
 	42	=> "Pets/Pet Care",
 	43	=> "Electronics",
 	44	=> "General Merchandise",
 	45	=> "Office Supplies",
 	92	=> "Consulting",
 	94	=> "Sales",
 	96	=> "Interest",
 	98	=> "Services",
 	100	=> "Advertising",
 	102	=> "Business Miscellaneous",
 	104	=> "Postage and Shipping",
 	106	=> "Printing",
 	108	=> "Dues and Subscriptions",
 	110	=> "Office Maintenance",
 	112	=> "Wages Paid",
 	114	=> "Expense Reimbursement",
 	116	=> "ACH Transfers",
 	118	=> "Receipts",
 	120	=> "Discounts",
 	122	=> "Legal Fees",
 	124	=> "Accounting Fees",
 	126	=> "Credit Card Purchases"
);

$CATEGORY_IN = array(
	46	=> "Office ",
	47	=> "Uncategorized Supplies  ",
	48	=> "Automotive Expenses  ",
	49	=> "Charitable Giving  ",
	50	=> "Child/Dependent Expenses  ",
	51	=> "Clothing/Shoes  ",
	52	=> "Education  ",
	53	=> "Entertainment  ",
	54	=> "Gasoline/Fuel  ",
	55	=> "Gifts  ",
	56	=> "Groceries  ",
	57	=> "Healthcare/Medical  ",
	58	=> "Home Maintenance  ",
	59	=> "Home Improvement  ",
	60	=> "Insurance  ",
	61	=> "Cable/Satellite Services  ",
	62	=> "Online Services  ",
	63	=> "Loans  ",
	64	=> "Mortgages  ",
	65	=> "Other Expenses  ",
	66	=> "Personal Care  ",
	67	=> "Rent  ",
	68	=> "Restaurants/Dining  ",
	69	=> "Travel  ",
	70	=> "Service Charges/Fees  ",
	71	=> "ATM/Cash Withdrawals  ",
	72	=> "Credit Card Payments  ",
	73	=> "Deposits  ",
	74	=> "Transfers  ",
	75	=> "Salary  ",
	76	=> "Investment Income  ",
	77	=> "Retirement Income  ",
	78	=> "Other Income  ",
	79	=> "Checks  ",
	80	=> "Hobbies  ",
	81	=> "Other Bills  ",
	82	=> "Securities Trades  ",
	83	=> "Taxes  ",
	84	=> "Telephone Services  ",
	85	=> "Utilities  ",
	86	=> "Savings  ",
	87	=> "Retirement Contributions  ",
	88	=> "Pets/Pet Care  ",
	89	=> "Electronics  ",
	90	=> "General Merchandise  ",
	91	=> "Jewellery  ",
	93	=> "Consulting  ",
	95	=> "Sales  ",
	97	=> "Interest  ",
	99	=> "Services  ",
	101	=> "Advertising  ",
	103	=> "Business/Miscellaneous  ",
	105	=> "Postage and Shipping   ",
	107	=> "Printing  ",
	109	=> "Dues and Subscriptions  ",
	111	=> "Office Maintenance  ",
	113	=> "Wages Paid  ",
	115	=> "Expense Reimbursement  ",
	117	=> "ACH Transfers  ",
	119	=> "Receipts  ",
	121	=> "Discounts  ",
	123	=> "Legal Fees  ",
	125	=> "Accounting Fees  ",
	127	=> "Credit Card Purchases  "
);

$ASSET_CLASS = array(

);

$HOLDING_TYPE = array(

);

$ACCOUNT_TYPE = array( 
	1	=> "Unknown",	
	2	=> "other",	
	3	=> "checking",	
	4	=> "savings",	
	5	=> "brokerageCash",	
	6	=> "brokerageMargin",	
	7	=> "moneyMarket",	
	8	=> "ira",	
	9	=> "401k",	
	10	=> "403b",	
	11	=> "trust",	
	12	=> "annuity",	
	13	=> "simple",	
	14	=> "custodial",
	15	=> "credit",
	16	=> "charge",
	18	=> "paymentOnlyService",
	19	=> "telephone",
	20	=> "Utility",
	21	=> "cable",
	22	=> "card",
	23	=> "insurance",
	24	=> "wireless",
	25	=> "CD",
	26	=> "brokerageCashOption",
	27	=> "brokerageMarginOption",
	30	=> "jttic",
	31	=> "jtwros",
	32	=> "communityProperty",
	33	=> "jointByEntirety",
	34	=> "conservatorship",
	35	=> "roth",
	36	=> "rothConversion",
	37	=> "rollover",
	38	=> "educational",
	39	=> "529Plan",
	40	=> "457DeferredCompensation",
	41	=> "401a",
	42	=> "psp",
	43	=> "mpp",
	44	=> "stockBasket",
	45	=> "livingTrust",
	46	=> "revocableTrust",
	47	=> "irrevocableTrust",
	48	=> "charitableRemainder",
	49	=> "charitableLead",
	50	=> "charitableGiftAccount",
	51	=> "sep",
	52	=> "utma",
	53	=> "ugma",
	54	=> "esopp",
	55	=> "administrator",
	56	=> "executor",
	57	=> "partnership",
	58	=> "soleProprietorship",
	59	=> "church",
	60	=> "investmentClub",
	61	=> "restrictedStockAward",
	62	=> "Tax",
	63	=> "Mortgage",
	64	=> "Installment",
	65	=> "Personal",
	66	=> "HomeEquityLineOfCredit",
	67	=> "LineOfCredit",
	68	=> "Auto",
	69	=> "Student",
	70	=> "prepaid",
	71	=> "storeCard",
	72	=> "ppf",
	73	=> "CMA",
	74	=> "employeeStockPurchasePlan",
	75	=> "performancePlan",
	76	=> "brokerageLinkAccount",
	77	=> "accountsPayable",
	78	=> "accountsReceivable",
	79	=> "association",
	80	=> "cash",
	81	=> "costOfGoodsSold"
);

$ACCOUNT_CLASSIFICATION = array(
	1	=> "Other",
	2	=> "Personal", 
	3	=> "Corporate", 
	4	=> "SmallBusiness",  
	5	=> "Trust",  
	6	=> "addOnCard",  
	7	=> "virtualCard"
);

// FLOW CONSTANTS
$MFA_TYPE = array(
	1	=> 'TOKEN_ID',
	2	=> 'IMAGE',
	3	=> 'MASTER_COOKIE',
	4	=> 'SECURITY_QUESTION',
	5	=> 'MULTI_LEVEL'
);

$SITE_REFRESH_STATUS = array(
	0	=> 'REFRESH_NEVER_INITIATED',
	1	=> 'REFRESH_TRIGGERED',
	2	=> 'LOGIN_SUCCESS',
	3	=> 'LOGIN_FAILURE',
	4	=> 'PARTIAL_COMPLETE',
	5	=> 'REFRESH_COMPLETED',
	6	=> 'REFRESH_TIMED_OUT',
	7	=> 'REFRESH_CANCELLED',
	8	=> 'REFRESH_COMPLETED_WITH_UNCERTAIN_ACCOUNT',
	9	=> 'REFRESH_ALREADY_IN_PROGRESS',
	10	=> 'SITE_CANNOT_BE_REFRESHED',
	11	=> 'REFRESHED_TOO_RECENTLY',
	12	=> 'REFRESH_COMPLETED_ACCOUNTS_ALREADY_AGGREGATED'
);

$ERR_CODES = array(
	0	=> "Your account has been successfully added.",
	801	=> "Request In Progress: Please wait while we update your account.",
	802	=> "Updating Account (802): We are in the process of updating your account with revised credentials",
	409	=> "Problem Updating Account(409): We could not update your account because the end site is experiencing technical difficulties.",
	411	=> "Site No Longer Available (411):The <SITE_NAME> site no longer provides online services to its customers.  Please delete this account.",
	412	=> "Problem Updating Account(412): We could not update your account because the site is experiencing technical difficulties.",
	415	=> "Problem Updating Account(415): We could not update your account because the <SITE_NAME> is experiencing technical difficulties.",
	416	=> "Multiple User Logins(416): We attempted to update your account, but another session was already established at the same time.  If you are currently logged on to this account directly, please log off and try after some time",
	418	=> "Problem Updating Account(418): We could not update your account because the <SITE_NAME> site is experiencing technical difficulties. Please try later.",
	423	=> " No Account Found (423): We were unable to detect an account. Please verify that you account information is available at this time and If the problem persists, please contact customer support at <SITE_NAME> for further assistance.",
	424	=> "Site Down for Maintenance(424):We were unable to update your account as the <SITE_NAME> site is temporarily down for maintenance. We apologize for the inconvenience.  This problem is typically resolved in a few hours. Please try later.",
	425	=> "Problem Updating Account(425): We could not update your account because the <SITE_NAME> site is experiencing technical difficulties. Please try later.",
	426	=> "Problem Updating Account(426): We could not update your account for technical reasons. This type of error is usually resolved in a few days. We apologize for the inconvenience.",
	505	=> "Site Not Supported (505): We currently does not support the security system used by this site. We apologize for any inconvenience. Check back periodically if this situation has changed. We suggest you to delete this site.",
	510	=> "Property Record Not Found (510):The <SITE_NAME> site is unable to find any property information for your address. Please verify if the property address you have provided is correct. We suggest you to delete this site. ",
	511	=> "Home Value Not Found (511): The <SITE_NAME> site is unable to provide home value for your property. We suggest you to delete this site. ",
	402	=> "Credential Re-Verification Required (402): We could not update your account because your username and/or password were reported to be incorrect.  Please re-verify your username and password.  ",
	405	=> "Update Request Canceled(405):Your account was not updated because you canceled the request.",
	406	=> " Problem Updating Account (406): We could not update your account because the <SITE_NAME> site requires you to perform some additional action. Please visit the site or contact its customer support to resolve this issue. Once done, please update your account credentials in case they are changed else try again.",
	407	=> "Account Locked (407): We could not update your account because it appears your <SITE_NAME>  account has been locked. This usually results from too many unsuccessful login attempts in a short period of time. Please visit the site or contact its customer support to resolve this issue.  Once done, please update your account credentials in case they are changed.",
	414	=> "Requested Account Type Not Found (414): We could not find your requested account at the <Account Name> site. You may have selected a similar site under a different category by accident in which case you should select the correct site.",
	417	=> "Account Type Not Supported(417):The type of account we found is not currently supported.  Please remove this site and add as a  manual account.",
	420	=> "Credential Re-Verification Required (420):The <SITE_NAME> site has merged with another. Please re-verify your credentials at the site and update the same.",
	421	=> "Invalid Language Setting (421): The language setting for your <SITE_NAME> account is not English. Please visit the site and change the language setting to English.",
	422	=> "Account Reported Closed (422): We were unable to update your account information for <SITE_NAME> because it appears one or more of your related accounts have been closed.  Please deactivate or delete the relevant account and try again. ",
	427	=> "Re-verification Required (427): We could not update your account due to the <SITE_NAME> site requiring you to view a new promotion. Please log in to the site and click through to your account overview page to update the account.  We apologize for the inconvenience.",
	428	=> "Re-verification Required (428): We could not update your account due to the <SITE_NAME> site requiring you to accept a new Terms & Conditions. Please log in to the site and read and accept the T&C.",
	429	=> "Re-Verification Required (429): We could not update your account due to the <SITE_NAME> site requiring you to verify your personal information. Please log in to the site and update the fields required.",
	430	=> "Site No Longer Supported (430):This site is no longer supported for data updates. Please deactivate or delete your account. We apologize for the inconvenience.",
	433	=> "Registration Requires Attention (433): Auto registration is not complete at <SITE_NAME> site. Please complete your registration at the end site. Once completed, please complete adding this account.",
	434	=> "Registration Requires Attention (434): Your Auto-Registration could not be completed and requires further input from you.  Please re-verify your registration information to complete the process.",
	435	=> "Registration Requires Attention (435): Your Auto-Registration could not be completed and requires further input from you.  Please re-verify your registration information to complete the process.",
	436	=> "Account Already Registered (436):Your Auto-Registration could not be completed because the site reports that your account is already registered.  Please log in to the <SITE_NAME> to confirm and then complete the site addition process with the correct login information.",

	506	=> "New Login Information Required(506):We're sorry, to log in to this site, you need to provide additional information. Please update your account and try again.",
	518	=> "Authentication Information Unavailable (518):Your account was not updated as the required additional authentication information was unavailable. Please try now.",

	519	=> "Authentication Information Required (519): Your account was not updated as your authentication information like security question and answer was unavailable or incomplete. Please update your account settings.",

	520	=> "Authentication Information Incorrect (520):We're sorry, <site> indicates that the additional authentication information you provided is incorrect. Please try updating your account again.",

	521	=> "Additional Authentication Enrollment Required (521) : Please enroll in the new security authentication system, <Account Name> has introduced. Ensure your account settings in <Cobrand> are updated with this information.",

	522	=> "Request Timed Out (522) :Your request has timed out as the required security information was unavailable or was not provided within the expected time. Please try again.",

	523	=> "Authentication Information Incorrect (523):We're sorry, the authentication information you  provided is incorrect. Please try again.",

	524	=> "Authentication Information Expired (524):We're sorry, the authentication information you provided has expired. Please try again.",

	526	=> "Credential Re-Verification Required (526): We could not update your account because your username/password or additional security credentials are incorrect. Please try again.",

	401	=> "Problem Updating Account(401):We're sorry, your request timed out. Please try again.",
	403	=> "Problem Updating Account(403):We're sorry, there was a technical problem updating your account. This kind of error is usually resolved in a few days. Please try again later.",
	404	=> "Problem Updating Account(404):We're sorry, there was a technical problem updating your account. Please try again later.",
	408	=> "Account Not Found(408): We're sorry, we couldn't find any accounts for you at the <SITE_NAME> site. Please log in at the  <SITE_NAME>  site and confirm that your account is set up, then try again.",
	413	=> "Problem Updating Account(413):We're sorry, we couldn't update your account at <SITE_NAME> site because of a technical issue. This type of problem is usually resolved in a few days. Please try again later.",
	419	=> "Problem Updating Account(419):We're sorry, we couldn't update your account because of unexpected variations at the <SITE_NAME> site. This kind of problem is usually resolved in a few days. Please try again later.",
	507	=> "Problem Updating Account(507):We're sorry, Yodlee has just started providing data updates for this site, and it may take a few days to be successful as we get started. Please try again later.",
	508	=> "Request Timed Out (508): We are sorry, your request timed out due to technical reasons. Please try again.",
	509	=> "Site Device Information Expired(509): We're sorry, we can't update your account because your token is no longer valid at the <SITE_NAME> site. Please update your information and try again, or contact <SITE_NAME>'s customer support.",
	517	=> "Problem Updating Account (517) :We'resorry, there was a technical problem updating your account. Please try again.",
	525	=> "Problem Updating Account (525): We could not update your account for technical reasons. This type of error is usually resolved in a few days. We apologize for the inconvenience. Please try again later."
);