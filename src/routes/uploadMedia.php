<?php

$app->post('/api/Gifs/uploadMedia', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','file']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'apiKey','file'=>'file'];
    $optionalParams = ['title'=>'title','tags'=>'tags','nsfw'=>'nsfw','attribution_site'=>'attribution_site','attribution_user'=>'attribution_user','attribution_url'=>'attribution_url'];
    $bodyParams = [
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    

    $client = $this->httpClient;
    $query_str = "https://api.gifs.com/media/upload";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = ["Gifs-API-Key"=>"{$data['apiKey']}"];
    $requestParams['multipart'] = [
        [
            'name'     => 'file',
            'contents' => fopen($data['file'], 'r'),
        ]
    ];

    if(!empty($data['title'])){
        $requestParams['multipart'][] = [
            'name' => 'title',
            'contents' => $data['title']
        ];
    }

    if(!empty($data['tags'])){
        $requestParams['multipart'][] = [
            'name' => 'tags',
            'contents' => implode(",",$data['tags'])
        ];
    }

    if(isset($data['nsfw'])){
        $requestParams['multipart'][] = [
            'name' => 'nsfw',
            'contents' => $data['nsfw']
        ];
    }

    if(!empty($data['attribution_site'])){
        $requestParams['multipart'][] = [
            'name' => 'attribution_site',
            'contents' => $data['attribution_site']
        ];
    }

    if(!empty($data['attribution_user'])){
        $requestParams['multipart'][] = [
            'name' => 'attribution_user',
            'contents' => $data['attribution_user']
        ];
    }

    if(!empty($data['attribution_url'])){
        $requestParams['multipart'][] = [
            'name' => 'attribution_url',
            'contents' => $data['attribution_url']
        ];
    }

    try {
        $resp = $client->post($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();


        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});