<?php


namespace App\Http\Controllers;
//      use GuzzleHttp\Psr7\Query;
//    $query = \GuzzleHttp\Psr7\Query::build($queryParams);

use Illuminate\Http\Request;
use Exception;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\AccountApi;
use SendinBlue\Client\Api\AttributesApi;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\Api\ListsApi;

class SendingBlueController extends Controller
{
   public function sendBlue(){

// Configure API key authorization: api-key
       $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
// Configure API key authorization: partner-key
       $config = Configuration::getDefaultConfiguration()->setApiKey('partner-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

       $apiInstance = new AccountApi(
       // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
       // This is optional, `GuzzleHttp\Client` will be used as default.
           new Client(),
           $config
       );
       $apiAttr = new AttributesApi(
           new Client(),
           $config
       );
       $apiContact = new ContactsApi(
           new Client(),
           $config
       );

       $apiList = new ListsApi(
           new Client(),
           $config
       );

       $attributeCategory = "normal"; // string | Category of the attribute
       $attributeName = "ContactNumber"; // string | Name of the attribute

       $listId = [4]; // int | Id of the list


       $dataFolder = ['name'=>'DavlatFolder'];
       $dataList = ['name'=>'DavlatList','folderId'=>3];
       $dataAttr = ["FIRSTNAME"=>"Dav","LASTNAME"=>"Ushurbakiev","CONTACTNUMBER"=>"+77477782877","SMS"=>"+77477782877"];
       $dataAttr1 = ['type'=>'text'];
       $dataCont = ['email'=>'ushurbakiev@itstep.kz','attributes'=>$dataAttr,'listIds'=>$listId];
       $dataConList = ['ids'=>$dataCont['listIds'],'emails'=>$dataCont['email']];

       $createFolder = new \SendinBlue\Client\Model\CreateUpdateFolder($dataFolder); // \SendinBlue\Client\Model\CreateUpdateFolder | Name of the folder
       $createList = new \SendinBlue\Client\Model\CreateList($dataList); // \SendinBlue\Client\Model\CreateList | Values to create a list
       $createAttribute = new \SendinBlue\Client\Model\CreateAttribute($dataAttr1); // \SendinBlue\Client\Model\CreateAttribute | Values to create an attribute
       $createContact = new \SendinBlue\Client\Model\CreateContact($dataCont); // \SendinBlue\Client\Model\CreateContact | Values to create a contact
       $contactEmails = new \SendinBlue\Client\Model\AddContactToList($dataConList); // \SendinBlue\Client\Model\AddContactToList | Emails addresses OR IDs of the contacts

       $identifier = "11"; // string | Email (urlencoded) OR ID of the contact
       $updateContact = new \SendinBlue\Client\Model\UpdateContact($dataCont); // \SendinBlue\Client\Model\UpdateContact | Values to update a contact



       try {
//           $resultAcc = $apiInstance->getAccount();
//           $resultGetAttr = $apiAttr->getAttributes();
//           $apiAttr->createAttribute($attributeCategory,$attributeName,$createAttribute);
//            $resultCont = $apiContact->createContact($createContact);
            $apiContact->updateContact($identifier,$updateContact);
//           $resultContList = $apiContact->addContactToList(4,$contactEmails);
//           $resultFolder = $apiContact->createFolder($createFolder);
//           $resultList = $apiList->createList($createList);
          echo "<br>" ; echo "Updated"; echo "</br>";
       } catch (Exception $e) {
           echo 'Exception when calling ContactsApi->createAttribute:', $e->getMessage(), PHP_EOL;
       }
   }
}
