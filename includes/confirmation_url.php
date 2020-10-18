
<?php
        
        header("Content-Type: application/json");

        $response = '{
				"ResultCode": 0, 
				"ResultDesc": "Confirmation Received Successfully"
		}';

        // Response from M-PESA Stream
		$mpesaResponse = file_get_contents('php://input');
		
		// log the response
        $logFile = "M_PESAConfirmationResponse.txt";
        // write to file
        $log = fopen($logFile, "a");

        fwrite($log, $mpesaResponse);
        fclose($log);

        echo $response;
        $jsonMpesaResponse = json_decode($mpesaResponse, true); // We will then use this to save to database

    // $transaction = array(
    //         ':TransactionType'      => $jsonMpesaResponse['TransactionType'],
    //         ':Trans_ID'              => $jsonMpesaResponse['TransID'],
    //         ':Trans_Time'            => $jsonMpesaResponse['TransTime'],
    //         ':Trans_Amount'          => $jsonMpesaResponse['TransAmount'],
    //         ':Business_ShortCode'    => $jsonMpesaResponse['BusinessShortCode'],
    //         ':Bill_RefNumber'        => $jsonMpesaResponse['BillRefNumber'],
    //         ':Invoice_Number'        => $jsonMpesaResponse['InvoiceNumber'],
    //         ':Org_Account_Balance'    => $jsonMpesaResponse['OrgAccountBalance'],
    //         ':ThirdParty_TransID'    => $jsonMpesaResponse['ThirdPartyTransID'],
    //         ':MSISDN'               => $jsonMpesaResponse['MSISDN'],
    //         ':FirstName'            => $jsonMpesaResponse['FirstName'],
    //         ':MiddleName'           => $jsonMpesaResponse['MiddleName'],
    //         ':LastName'             => $jsonMpesaResponse['LastName']
    // );

    //get the database connection
    
    try {
		require 'init.php';
        $sql = "INSERT INTO mobile_payments (Transaction_Type, Trans_ID, Trans_Time, Trans_Amount, Business_ShortCode,
		 Bill_RefNumber, Invoice_Number, Org_Account_Balance, ThirdParty_TransID, MSISDN, FirstName, MiddleName,LastName)
	 	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $userOBJ = new USER();
        $stmt = $userOBJ->conn()->prepare($sql);
        $stmt->execute([
			$jsonMpesaResponse['TransactionType'],
			$jsonMpesaResponse['TransID'],
			$jsonMpesaResponse['TransTime'],
			$jsonMpesaResponse['TransAmount'],
			$jsonMpesaResponse['BusinessShortCode'],
			$jsonMpesaResponse['BillRefNumber'],
			$jsonMpesaResponse['InvoiceNumber'],
			$jsonMpesaResponse['OrgAccountBalance'],
			$jsonMpesaResponse['ThirdPartyTransID'],
			$jsonMpesaResponse['MSISDN'],
			$jsonMpesaResponse['FirstName'],
			$jsonMpesaResponse['MiddleName'],
			$jsonMpesaResponse['LastName']
		]);

		$Transaction = fopen('Transaction.txt', 'a');
		fwrite($Transaction, $jsonMpesaResponse['TransID']);
		fclose($Transaction);
		


    } catch (Exception $e) {
        echo "this thing is not working";
        # 1.1.2b Log the error to a file. Optionally, you can set it to send a text message or an email notification during production.
		$errLog = fopen('error.txt', 'a');
		fwrite($errLog, $e->getMessage());
		fclose($errLog);

		# 1.1.2o Optional. Log the failed transaction. Remember, it has only failed to save to your database but M-PESA Transaction itself was successful. 
		$logFailedTransaction = fopen('failedTransaction.txt', 'a');
		fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
		fclose($logFailedTransaction);
    }
    
        
?>
