# php implementation of LetFunc
+ [Landing page about project - LetFunc.com](https://www.letfunc.com)
    + [php.LetFunc.com](https://php.letfunc.com)
        + [letfunc.github.io/php/](https://letfunc.github.io/php/)
    
## How to start
https://github.com/letfunc/php-example.git

download function by CURL

    curl https://letfunc.github.io/php/let_func.php --output let_func.php

create php file: index.php

### require file
    include 'let_func.php';

### Class: Sync / Async
    $code = new LetFunc("https://letjson.github.io/php/letjson.php", "letJson", "https://letjson.github.io/js/letjson.json");

#### Class / Sync
    $value = $code->exec();
    var_dump($value);

#### Class / Async
    $value = $code->each(function ($value) {
        var_dump($value);
    });


### Function Async
    let_func("https://letjson.github.io/php/let_json.php", "let_json", "https://letjson.github.io/js/letjson.json", function ($value) {
        var_dump($value);
    });

