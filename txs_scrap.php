<?php


error_reporting(-1);
ini_set("display_errors", 1);

// Turn off all error reporting
error_reporting(0);

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

// Report all PHP errors
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);




/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 */
function get_web_page($url)
{
    $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';


    $user_agent_arr = [
        'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/' . rand(8, 100) . '.0',
        'Mozilla Firefox: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0',
        'Google Chrome: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; SM-G996U Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 13_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.1 Safari/605.1.15'
    ];

    $user_agent = $user_agent_arr[rand(0, 10)];

    echo $user_agent . "\n";


    $options = array(

        CURLOPT_CUSTOMREQUEST  => "GET",        //set request type post or get
        CURLOPT_POST           => false,        //set to GET
        CURLOPT_USERAGENT      => $user_agent, //set user agent
        CURLOPT_COOKIEFILE     => "cookie.txt", //set cookie file
        CURLOPT_COOKIEJAR      => "cookie.txt", //set cookie jar
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo($ch);
    curl_close($ch);

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}



function contractScraper($dex_arr)
{
    if (!$dex_arr) return false;


    $contractArr = [];

    $dex_arr = array_splice($dex_arr, 0, 50);

    foreach ($dex_arr as $dexkey => $dexvalue) {

        $get_contract_url = "https://etherscan.io/tx/" . $dexvalue;

        $result = get_web_page($get_contract_url);

        if ($result['errno'] != 0) {
            print_r($result['errno']);
        }

        if ($result['http_code'] != 200) {
            print_r($result['http_code']);
        }

        $page = $result['content'];

        // create new DOMDocument
        $dom = $document = new \DOMDocument('1.0', 'UTF-8');

        // $doc = new DOMDocument();
        // $doc->loadHTMLFile("html5.html", LIBXML_NOERROR);

        // set error level
        $internalErrors = libxml_use_internal_errors(true);

        // libxml_use_internal_errors(false);

        // load HTML
        $document->loadHTML($page);

        // Restore error level
        libxml_use_internal_errors($internalErrors);

        @$document->loadHTML($page);


        $classname = 'text-break';
        $finder = new DomXPath($dom);
        $nodes = $finder->query('//*[@id="ContentPlaceHolder1_maintable"]/div[1]/div[7]/div[2]/div/a[1]');
        $tmp_dom = new DOMDocument();

        foreach ($nodes as $node) {
            if (strpos($node->textContent, '0x') !== false) {

                array_push($contractArr, $node->textContent);
            }
        }
    }

    return array_filter(array_values(array_unique($contractArr)), function ($value) {
        return !is_null($value) && $value !== '';
    });
}



function transactionLog($contract_arr)
{
    if (!$contract_arr) return false;


    $txArr = [];

    $contract_arr = array_splice($contract_arr, 0, 50);

    foreach ($contract_arr as $contractkey => $contractvalue) {

        $get_tx_url = "https://etherscan.io/txs?a=" . $contractvalue;

        $result = get_web_page($get_tx_url);

        if ($result['errno'] != 0) {
            print_r($result['errno']);
            print_r($get_tx_url);
        }

        if ($result['http_code'] != 200) {
            print_r($result['http_code']);
        }

        $page = $result['content'];

        // create new DOMDocument
        $dom = $document = new \DOMDocument('1.0', 'UTF-8');

        // set error level
        $internalErrors = libxml_use_internal_errors(true);

        // load HTML
        @$document->loadHTML($page);

        // Restore error level
        libxml_use_internal_errors($internalErrors);

        $classname = 'table table-hover table-align-middle mb-0';

        $finder = new DomXPath($dom);

        // $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

        $nodes = $finder->query('//*[@id="ContentPlaceHolder1_divTransactions"]/div[2]/table/tbody/tr/td[7]/div/a[1]');

        foreach ($nodes as $node) {

            if (strpos($node->getAttribute('data-bs-title'), 'Public Tag') !== false) {
                // print_r($node);                    
                $ex = explode('(', $node->getAttribute('data-bs-title'));
                $address = explode(')', $ex[1]);
                array_push($txArr, $address[0]);
            } else {
                // print_r($node);
                array_push($txArr, $node->getAttribute('data-bs-title'));
            }

            // array_push($txArr, $node->getAttribute('data-bs-title'));
        }
    }

    return array_filter(array_values(array_unique($txArr)), function ($value) {
        return !is_null($value) && $value !== '';
    });
}


function userValidAddress($get_all_user_addr_arr)
{

    if (!$get_all_user_addr_arr) return false;

    $range = 1000;

    $addressArr = [];

    $get_all_user_addr_arr = array_splice($get_all_user_addr_arr, 0, 1000);

    foreach ($get_all_user_addr_arr as $addresskey => $addressvalue) {

        $get_addr_url = "https://etherscan.io/address/" . $addressvalue;

        $result = get_web_page($get_addr_url);

        if ($result['errno'] != 0) {
            print_r($result['errno']);
            print_r($get_addr_url);
        }

        if ($result['http_code'] != 200) {
            print_r($result['http_code']);
        }

        $page = $result['content'];

        // create new DOMDocument
        $dom = $document = new \DOMDocument('1.0', 'UTF-8');

        // set error level
        $internalErrors = libxml_use_internal_errors(true);

        // load HTML
        @$document->loadHTML($page);

        // Restore error level
        libxml_use_internal_errors($internalErrors);

        $finder = new DomXPath($dom);

        $nodes = $finder->query('//*[@id="dropdownMenuBalance"]/text()');

        foreach ($nodes as $node) {

            // echo $node->textContent;
            $res = str_replace(array('\'', '"', '$', ' ',    ',', ';', '<', '>'), '', $node->textContent);

            if ($res > $range) {

                array_push($addressArr, $addressvalue);
            }
        }
    }

    return array_filter(array_values(array_unique($addressArr)), function ($valuesd) {
        return !is_null($valuesd) && $valuesd !== '';
    });
}


function index()
{

    $dex_url = 'https://etherscan.io/txs';

    //Read a web page and check for errors:
    $result = get_web_page($dex_url);

    if ($result['errno'] != 0) {
        print_r($result['errno']);
    }

    if ($result['http_code'] != 200) {
        print_r($result['http_code']);
    }

    $page = $result['content'];

    // create new DOMDocument
    $dom = $document = new \DOMDocument('1.0', 'UTF-8');

    // set error level
    $internalErrors = libxml_use_internal_errors(true);

    // load HTML
    $document->loadHTML($page);

    // Restore error level
    libxml_use_internal_errors($internalErrors);

    @$document->loadHTML($page);


    $DexArr = [];
    $classname = 'js-clipboard';
    $finder = new DomXPath($dom);
    // $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    $nodes = $finder->query('//*[@id="ContentPlaceHolder1_divTransactions"]/div[2]/table/tbody/tr/td[10]/div/a[2]');
    $tmp_dom = new DOMDocument();
    foreach ($nodes as $node) {        
        array_push($DexArr, $node->getAttribute('data-clipboard-text'));
    }

    $get_all_dex_hash_arr = array_unique($DexArr);

    if (!$get_all_dex_hash_arr) {
        return false;
    }

    echo '<pre>';
    echo "TXS address" . "\n";
    print_r($get_all_dex_hash_arr);

    // $getl_all_contract_arr = contractScraper($get_all_dex_hash_arr);

    // if (!$getl_all_contract_arr) {
    //     return false;
    // }


    // echo "contract Arr" . "\n";
    // print_r($getl_all_contract_arr);

    // $get_all_user_tx_log_arr = transactionLog($getl_all_contract_arr);

    // if (!$get_all_user_tx_log_arr) {
    //     return false;
    // }

    // echo "Tx Log" . "\n";
    // print_r($get_all_user_tx_log_arr);

    $user_valid_address_arr = userValidAddress($get_all_dex_hash_arr);

    echo "User Valid Address" . "\n";
    print_r($user_valid_address_arr);

    if (count($user_valid_address_arr) > 0) {

        return $final_data = array_map(function ($finalvalues) {
            return ['address' => $finalvalues];
        }, $user_valid_address_arr);
    } else {

        return false;
    }
}
function formats($arr)
{
}

function file_line_by_line($filename)
{
    if (!$filename) {
        return false;
    }

    // $path    = __DIR__ . '/php/etherscan/eth/' . $filename;
    $path    = __DIR__ . '/eth/' . $filename;

    $jsonString = file_get_contents($path);

    $jsonData = json_decode($jsonString, true);

    return $jsonData;
}


function get_last_file_name()
{
    // $path    = __DIR__ . '/php/etherscan/eth/';
    $path    = __DIR__ . '/eth/';

    $files = scandir($path);

    if ($files) {
        return (end($files) !== '..') ? end($files) : false;
    } else {
        return false;
    }
}

$starttime = microtime(true);

$new_file_record =  index();

// echo 'INDEX';
// print_r($new_file_record);

if ($new_file_record) {

    // echo 'LAST NAME' . 
    $get_last_file_name =  get_last_file_name();

    if ($get_last_file_name) {

        // echo ' LINE ';
        $old_file_line = file_line_by_line($get_last_file_name);

        echo "Old file line \n";
        print_r($old_file_line);

        $temp_file_line = array_merge($new_file_record, $old_file_line);

        if (!$temp_file_line) {
            return false;
        }

        if ($array_chunk) {
            foreach ($array_chunk as $chunkkey => $chunkvalue) {
                $time = time() . rand(1, 100);
                $time = 1;
                $title = 'block_txs_scrap_' . $time . '.json';
                // echo $path = __DIR__ . '/php/etherscan/eth/' . $title;
                echo $path = __DIR__ . '/eth/' . $title;
                file_put_contents($path, (json_encode($chunkvalue, JSON_PRETTY_PRINT)),FILE_APPEND | LOCK_EX); //generate json file 
                $time = 2;
                $title = 'block_txs_scrap_' . $time . '.json';
                $myfile = fopen($path, "a"); //or die("Unable to open file!");                
                fwrite($myfile, json_encode($chunkvalue, JSON_PRETTY_PRINT));                
                fclose($myfile);
            }

            echo 'File Created 1';
        }
    } else {

        $array_chunk = array_chunk($new_file_record, 50000000000);

        print_r($array_chunk);

        if ($array_chunk) {
            foreach ($array_chunk as $chunkkey => $chunkvalue) {
                $time = time() . rand(1, 100);
                $time = 1;
                $title = 'block_txs_scrap_' . $time . '.json';
                // echo $path = __DIR__ . '/php/etherscan/eth/' . $title;
                echo $path = __DIR__ . '/eth/' . $title;
                file_put_contents($path, (json_encode($chunkvalue, JSON_PRETTY_PRINT)), FILE_APPEND | LOCK_EX); //generate json file        
                $time = 2;
                $title = 'block_txs_scrap_' . $time . '.json';
                $myfile = fopen($path, "a"); //or die("Unable to open file!");                
                fwrite($myfile, json_encode($chunkvalue, JSON_PRETTY_PRINT));                
                fclose($myfile);
            }

            echo 'File Created 2';
        }
    }
}


$endtime = microtime(true);
$timediff = $endtime - $starttime;
$time = number_format((float)$timediff, 3, '.', '');
echo "Process Time: {$time} sec";
exit;