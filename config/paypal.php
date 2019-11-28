<?php
return array(
    // set your paypal credential
    'client_id' => 'AUz6JPQ8XtsE3hhh0gXSgbchzaRjQ8oL-KAd19aH_SJQc63uqtTToX5Kl6SQ1THQlzpZg1wn243TYtD1',
    'secret' => 'ED0VbT0JILNoa4gPIuS5UqlMFksHObc7-DVBowDPmLuW-ckLXzk4dzoP1LjFQr-X5YMDBBxIzw9eG_f9',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);