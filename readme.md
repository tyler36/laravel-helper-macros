``# Laravel Helpers

## Installation
1.Install package through composer.

```
   composer require tyler36/laravel-helpers
```


2.Add package to `config/app.php`

```
    Tyler36\laravelHelpers\LaravelHelperServiceProvider::class,
```

 ---
## Helpers

### Validator
Inspired by [Validate (almost) anything in Laravel](https://murze.be/2015/11/validate-almost-anything-in-laravel/).
Uses Laravel Validator class to validate anything.

EG. Validate Date (expects FALSE):

```
    tyler36\laravelHelpers\Helper::validate('20150230', 'date');
```

EG. Validate Date (expects TRUE):

```
    tyler36\laravelHelpers\Helper::validate('20150230', 'date');
```


## Macros

### Collections
These macros extend **collection** functionality.

#### pipe
Inspired by [The pipe collection macro](https://murze.be/2016/05/getting-package-statistics-packagist-redux/).
Pass collection to a function.

```
$collect = collect([1, 2, 3])
    ->pipe(function ($data) {
        return $data->merge([4, 5, 6]);
    });
```

#### dd
Inspired by [Debugging collections](https://murze.be/2016/06/debugging-collections/).
Debug a collection by 'dump and die' the current state. Can be used mid-chain to break and dump.

```
collect($items)
  ->filter(function() {
     ...
   })
  ->dd()
```

#### ifEmpty
Run callback if collection is empty.

```
$items = collect([]);
$items->ifEmpty(function(){
    abort(500, 'No items');
});
```


#### ifAny
Run callback if collection has data ( >1 item).

```
$errors = collect(['Something went wrong']);
$errors->ifAny(function(){
    abort(500, 'There was at-least 1 problem');
});
```


#### mapToAssoc
Convert collection to associative array
```
$emailLookup = $employees->mapToAssoc(function ($employee) {
    return [$employee['email'], $employee['name']];    
});
```


### Response
These macros help to standardize **api json response** returns throughout the application.
Inspired by [Laravel Response Macros for APIs](https://blog.jadjoubran.io/2016/03/27/laravel-response-macros-api/)

#### Success
Returns payload ($data) with a [HTTP status code 200](https://httpstatuses.com/200)
```
response()->success($data);
```

EG.
```
response()->success(['earth' => 3, 'sun' => 'yellow'])
```
Returns **HTTP status 200** with the following:
```
{"errors":false,"data":{"earth":3,"sun":"yellow"}}
```


#### noContent
Returns empty content with a [HTTP status code 402](https://httpstatuses.com/204)
```
response()->noContent()
```


#### Error
Returns message ($message) content with an optional [HTTP status code](https://httpstatuses.com/) ($statusCode) [Default: [HTTP status code 400](https://httpstatuses.com/400)]
```
response()->error($message);
```

Eg.
```
response()->error('There was an error.');
```
Returns **HTTP status 400** with the following:
```
{"errors":true,"message":"There was an error."}
```

Eg.
```
response()->error('Not authorized!', 403);
```

Returns **HTTP status 403** with the following:
```
{"errors":true,"message":"Not authorized!"}
```
