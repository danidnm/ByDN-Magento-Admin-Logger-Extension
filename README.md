# Admin Logger Extension

This administrator-focused extension introduces an admin logger, enabling Magento 2 administrators to stay informed about admin-initiated modifications in the backoffice

## Features

# Configuration

Access the configuration going to:

  Stores => Configuration => Utilities (by DN) => Admin Logger.

**Enable admin logger**. Enables or disables the admin logger. If disabled, no request will be logged.
**Clean log entries after (days)**. After this number of days, the logger entries will be automatically deleted to avoid excessive growth of the logger database table in big shops.
**Filters to apply**. In this section you can add some filters to the request logging. For example, it is highly recommended to filter Magento_Ui module requests, as they are always XHR requests and then, they don’t provide useful information in most of the cases.

# Where to see the data

To see the admin logger data, go to:

  Reports => Admin Log => See Logs

The you can see the following data foreach action performed in the Backoffice.

•	Username 
•	Executing module, controller and action names
•	Parameters in the request

Also you can filter the data by any of the previous parameters as it is usually done in any grid.

# Having problems

Contact me at soy at solodani.com