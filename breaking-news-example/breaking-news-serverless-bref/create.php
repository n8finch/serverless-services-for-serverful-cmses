<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

return function ($event) {
	$client = DynamoDbClient::factory([
		'region'  => 'us-east-1',
		'version' => 'latest',
	]);

	$body      = json_decode($event['body']);
	$timestamp = time();
	$timestamp = $timestamp * 1000;

	$item = [
		'id'        => ['S' => $body->eventId],
		'content'   => ['S' => $body->content],
		'updatedAt' => ['S' => "$timestamp"],
	];

	try {
		$result = $client->putItem([
			'TableName' => 'breaking-news-table-dev',
			'Item' => $item,
		]);
	} catch (\ErrorException $e) {
		return json_encode([
			'statusCode' => 400,
			'body' => $e	
		]);
	}

    return json_encode([
		'statusCode' => 200,
      	'body' => $item	
	]);
};
