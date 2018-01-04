# legendary-garbanzo

[![Maintainability](https://api.codeclimate.com/v1/badges/924aec34704f03cb2d54/maintainability)](https://codeclimate.com/github/Xloka/legendary-garbanzo/maintainability)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Xloka/legendary-garbanzo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Xloka/legendary-garbanzo/?branch=master)

[![Build Status](https://travis-ci.org/Xloka/legendary-garbanzo.svg?branch=master)](https://travis-ci.org/Xloka/legendary-garbanzo)

## installation 
    
    git clone 
    cd legendary-garbanzo
    composer update --dev
    php -S localhost:8000 -t public

## Search
    localhost:8000/hotels?q={searchQuery|City|PriceRange|DateRange}
## Sort
    localhost:8000/hotels?sortby={Name,Price | Name | Price}

##SortSearch
    localhost:8000/hotels?q=hot&sortby=Name
    localhost:8000/hotels?q=$100:$200&sortby=Price
## Test
    cd legendary-garbanzo
    ./vendor/bin/phpunit
## Note
    legendary-garbanzo is a generated repo name by github also better than SearchSortTest(Old Name)