<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
use Aws\DynamoDb\DynamoDbClient;

return function ($event) {
	$client = DynamoDbClient::factory([
		'region'  => 'us-east-1',
		'version' => 'latest',
	]);

	try {
		$result = $client->getItem(array(
			'TableName' => 'breaking-news-table-dev',
			'Key'       => [
				'id'   => ['S' => $event['pathParameters']['id']]
			]
		));
	} catch (\ErrorException $e) {
		return json_encode([
			'statusCode' => 400,
			'body' => $e,
		]);
	}

    return json_encode([
		'statusCode' => 200,
		'id'        => $result['Item']['id']['S'],	
		'content'   => $result['Item']['content']['S'],	
		'updatedAt' => $result['Item']['updatedAt']['S'],	
	]);
};
