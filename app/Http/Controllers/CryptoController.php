<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CryptoController extends Controller
{
    /**
     * @var int $start
     */
    public $start = 0;

    /**
     * @var int $end
     */
    public $end = 0;

    /**
     * @var Array $cache
     */
    protected $cache = [
        0 => 0,
        1 => 1,
    ];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->start = microtime(true);
    }

    /**
     * Execute the process function
     *
     * @param string $information
     *
     * @return JsonResponse
     */
    public function process(string $information) : JsonResponse
    {
        //Simple validation
        if (empty($information)) {
            return response()->json(['error' => 'A parameter is required'], 400);
        }

        $results = [];
        $limit = strlen($information);
        
        //Simple logic to use the fibonacci function with high numbers and iterations
        for ($iteration = 0; $iteration < $limit; $iteration++) {
            //Use the function with high numbers
            $number = rand(70, 100);
            $results[] = [
                $number => $this->fibonacci($number)
            ];
        }

        $this->end = (microtime(true) - $this->start) * 1000;

        return response()->json([
            'information' => $information,
            'execution_time' => $this->end . ' ms',
            'results' => $results
        ]);
    }

    /**
     * @param int $n
     *
     * @return string
     */
    public function fibonacci(int $n) : string
    {
        if (!isset($this->cache[$n])) {
            $this->cache[$n] = bcadd($this->fibonacci($n - 1), $this->fibonacci($n - 2));
        }

        return $this->cache[$n];
    }
}
