# Cryptographic mechanism 
This application uses:
- Docker
- Docker compose
- Composer
- Laravel Lumen

## Install
- Clone the repository:
```bash
git clone https://github.com/gmllasacas/crypto_service.git 
```
- After that, move to the created folder:
```bash
cd crypto_service
```
- Setup the container:
```bash
docker compose up --build
```
- Copy the environment file:
```bash
cp .env.example .env
```
## Usage
There is one open endpoint available on the API:
- GET http://localhost:8000/api/process/{information}

Where information is just a string parameter, the endpoint returns a structure similar to:
```JSON
{
    "information":"information",
    "execution_time":"0.04887580871582 ms",
    "result":[
        {
            "70": "190392490709135"
        },
        ...
        {
            "99": "218922995834555169026"
        },
    ]
}
```
The response have the execution time in milliseconds and the results of every number.

## Explanation
The problem with using the original fibonacci function is that for each call the function has to re-calculate the results, this created a lot of redundancy.

### Time Complexity: O(2^n)
The original function recursively calls itself twice with n-1 and n-2 as the input parameters. As a result, the number of function calls grows exponentially with n.

### Space Complexity: O(n)
The original function uses a call stack to keep track of the recursive function calls. The maximum depth of the call stack is equal to n, which is the input parameter. The space complexity of the function scales linearly with the input size.

## Solution
One optimization for the time complexity of the function is to use memoization to avoid redundant function calls. Memoization involves storing the results of previous function calls in a cache-like mechanism, so that they can be reused instead of recalculated. This can significantly reduce the number of function calls and improve the performance of the function reducing the time complexity.

In this API, the memoization is implemented in the form of an array on the class:
```php
/**
 * @var Array $cache
 */
protected $cache = [
    0 => 0,
    1 => 1,
];
```
This improved the response time of the endpoint from several seconds or timeouts to milliseconds when calculating the result with high numbers.

### Time Complexity: O(n)
Since each recursive call computes the sum of the two previous numbers in the sequence, the number of recursive calls is proportional to n. The time complexity of the new fibonacci function is now O(n).

### Space Complexity: O(n)
The space complexity is still the same.

## Tests
- Run the tests executing the command inside the container:
```bash
vendor/bin/phpunit
```
- Run manual tests hitting the endpoint with the GET method:
```bash
http://localhost:8000/api/process/information_to_test
```