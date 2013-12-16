ScientiaMobile WURFL Cloud Client for PHP
This software is the Copyright of ScientiaMobile, Inc.
Please refer to the LICENSE.txt file distributed with the software 
for licensing information.


* About
========================================
The WURFL Cloud Service by ScientiaMobile, Inc., is a cloud-based
mobile device detection service that can quickly and accurately
detect over 500 capabilities of visiting devices.  It can differentiate
between portable mobile devices, desktop devices, SmartTVs and any 
other types of devices that have a web browser.

This is the PHP Client for accessing the WURFL Cloud Service, and
it requires a free or paid WURFL Cloud account from ScientiaMobile:
http://www.scientiamobile.com/cloud 

* Installation
========================================
Step 1: Signup for WURFL Cloud
----------------------------------------
First, you must go to ScientiaMobile.com and signup for a free or paid
WURFL Cloud account (see above).  When you've finished creating your
account, and have selected the WURFL Capabilities that you would like
to use, you must copy your API Key, as it will be needed in the Client.

Step 2: Copy Files
----------------------------------------
If you're reading this, you've probably already extracted the Cloud
Client files.  You should put them somewhere on your server that is
accessible from your web application.

Step 3: Test the WURFL Cloud Client
----------------------------------------
From your web browser, you should go to the WURFL Cloud Client's
examples/ folder.  You will see the Compatibility Test Script,
which will verify that your configuration is compatible with
the WURFL Cloud Client.  
You should test your API Key from this page by pasting it in the
input box, then clicking "Test API Key".  If successful, you will
see "Your server is able to access WURFL Cloud and your API Key was 
accepted."  If there was a problem, the error message will be 
displayed instead.  Please note that it may take a few minutes from
the time that you signup for your WURFL Cloud API Key to become active.

Step 4: Integration
----------------------------------------
You should review the included examples (example.php, MyWurfl.php,
show_capabilities.php) to get a feel for the Client API, and how
best to use it in your application.

Here's a quick example of how to get up and running quickly:

<?php 
// Include the WURFL Cloud Client 
// You'll need to edit this path 
require_once '../Client/Client.php'; 
// Create a configuration object  
$config = new WurflCloud_Client_Config();  
// Set your WURFL Cloud API Key  
$config->api_key = 'xxxxxx:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';   
// Create the WURFL Cloud Client  
$client = new WurflCloud_Client_Client($config);  
// Detect your device  
$client->detectDevice();  
// Use the capabilities  
if ($client->getDeviceCapability('is_wireless_device')) {  
    echo "This is a mobile device";  
} else {  
    echo "This is a desktop device";  
} 
?>