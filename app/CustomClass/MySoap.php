<?php
namespace App\CustomClass;

use SoapClient;
use SoapHeader;
use SoapVar;
use Illuminate\Support\Facades\DB;
use App\Setting;

class MySoap   {

    function __construct() {
        $this->bookmarkListId = Setting::where('setting', 'listid')->get()[0]->value;
        $this->okey = Setting::where('setting', 'okey')->get()[0]->value;
        $this->client = new SoapClient('https://database.globalgap.org/globalgapaxis/services/Globalgap?wsdl', [
            'stream_context' => stream_context_create([
                'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]]),
            'login' => 'SP473600',
            'password' => 'GRST2015!',
            'trace' => TRUE,
            'exceptions' => 0,
            'soap_version' => SOAP_1_2,
            'encoding' => 'UTF-8'
        ]);
    }

    function test() {
        return $this->bookmarkListId;
    }

    function getBookmarkLists() {
        $xml = '<request xsi:type="xsd:string"><![CDATA[
            <ns2:getBookmarkListsRequest xmlns:ns2="http://www.globalgap.org/">
            </ns2:getBookmarkListsRequest>
            ]]></request>';
        
        $params = new SoapVar($xml, XSD_ANYXML);
        
        $response = $this->client->doRequest('getBookmarkLists','2.1', $params);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }

    function bookmarkListInsert() {
        $xml = '<request xsi:type="xsd:string"><![CDATA[
                    <ns2:bookmarkListInsertRequest xmlns:ns2="http://www.globalgap.org/">
                        <bookmarkListData>
                            <listName>Johanns Testliste</listName>
                            <listDescription>Johanns Testliste</listDescription>
                            <editorOkey>'.$this->okey.'</editorOkey>
                            <followerOkey>'.$this->okey.'</followerOkey>
                        </bookmarkListData>
                    </ns2:bookmarkListInsertRequest>
                    ]]>
                </request>';
        
        $params = new SoapVar($xml, XSD_ANYXML);
        
        $response = $this->client->doRequest('bookmarkListInsert','2.1', $params);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }

    function bookmarkItemInsert($ggn) {
        $xml = '<request xsi:type="xsd:string"><![CDATA[
                    <ns2:bookmarkItemInsertRequest xmlns:ns2="http://www.globalgap.org/">
                        <bookmarkItemData>
                            <ggn>'.$ggn.'</ggn>
                        </bookmarkItemData>
                        <bookmarkListIdList>
                            <bookmarkId>'.$this->bookmarkListId.'</bookmarkId>
                        </bookmarkListIdList> 
                    </ns2:bookmarkItemInsertRequest>
                ]]></request>';
        
        $params = new SoapVar($xml, XSD_ANYXML);
        
        $response = $this->client->doRequest('bookmarkItemInsert','2.1', $params);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }

    function getBookmark() {
        $xml = '<request xsi:type="xsd:string"><![CDATA[
                    <ns2:getBookmarkRequest xmlns:ns2="http://www.globalgap.org/">
                        <bookmarkListIdList>
                            <bookmarkId>'.$this->bookmarkListId.'</bookmarkId>
                        </bookmarkListIdList> 
                    </ns2:getBookmarkRequest>
                ]]></request>';
        
        $params = new SoapVar($xml, XSD_ANYXML);
        
        $response = $this->client->doRequest('getBookmark','2.4', $params);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }

    function bookmarkItemDelete($id) {
        $xml = '<request xsi:type="xsd:string"><![CDATA[
                    <ns2:bookmarkItemDeleteRequest xmlns:ns2="http://www.globalgap.org/">
                        <bookmarkItemId>'.$id.'</bookmarkItemId> 
                    </ns2:bookmarkItemDeleteRequest>
                ]]></request>';
        
        $params = new SoapVar($xml, XSD_ANYXML);
        
        $response = $this->client->doRequest('bookmarkItemDelete','2.1', $params);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}

?>