<?php

namespace App\MyClasses;

use Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;

class CryptoPrices
{
    
    public function productLoop($products){
        foreach ($products as $product)
        {
            if ($product->price_type == 'marketwise'){
                $usprice = round($this->getCryptoCurrencyInformation($product->currency->english)['price_usd'],2);
                $product->price = round($usprice*$product->price_currency->rate*((100+$product->profit)/100),2);
            }
        }
    }

    public function orderLoop($orders){
        foreach ($orders as $order)
        {
            if ($order->product->price_type == 'marketwise'){
                $usprice = round($this->getCryptoCurrencyInformation($order->product->currency->english)['price_usd'],2);
                $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100),2);
            }
        }
    }

    public function singleProduct($product){
        
            if ($product->price_type == 'marketwise'){
                $usprice = round($this->getCryptoCurrencyInformation($product->currency->english)['price_usd'],2);
                $product->price = round($usprice*$product->price_currency->rate*((100+$product->profit)/100),2);
            }
    }
    
    public function singleOrder($order){
       
            if ($order->product->price_type == 'marketwise'){
                $usprice = round($this->getCryptoCurrencyInformation($order->product->currency->english)['price_usd'],2);
                $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100),2);
            }
    }

    public function getCryptoCurrencyInformation($currencyId, $convertCurrency = "USD"){ 
        // Create a Custom Cached Guzzle Client
        $client = $this->getGuzzleFileCachedClient();

        // Define the Request URL of the API with the providen parameters
        $requestURL = "https://api.coinmarketcap.com/v1/ticker/$currencyId/?convert=$convertCurrency";

        // Execute the request
        $singleCurrencyRequest = $client->request('GET', $requestURL);
        
        // Obtain the body into an array format.
        $body = json_decode($singleCurrencyRequest->getBody() , true)[0];

        // If there were some error on the request, throw the exception
        if(array_key_exists("error" , $body)){
            throw $this->createNotFoundException(sprintf('Currency Information Request Error: $s', $body["error"]));
        }

        // Returns the array with information about the desired currency
        return $body;
    }

    private function getGuzzleFileCachedClient(){
        // Create a HandlerStack
        $stack = HandlerStack::create();

        // 10 minutes to keep the cache
        $TTL = 600;

        // Retrieve the cache folder path of your Laravel Project
        $cacheFolderPath = base_path() . "/bootstrap";
        
        // Instantiate the cache storage: a PSR-6 file system cache with 
        // a default lifetime of 10 minutes (60 seconds).
        $cache_storage = new Psr6CacheStorage(
            new FilesystemAdapter(
                // Create Folder GuzzleFileCache inside the providen cache folder path
                'GuzzleFileCache',
                $TTL, 
                $cacheFolderPath
            )
        );
        
        // Add Cache Method
        $stack->push(
            new CacheMiddleware(
                new GreedyCacheStrategy(
                    $cache_storage,
                    600 // the TTL in seconds
                )
            ), 
            'greedy-cache'
        );
        
        // Initialize the client with the handler option and return it
        return new Client(['handler' => $stack]);
    }
}
