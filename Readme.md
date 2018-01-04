# legendary-garbanzo

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
    localhost:8000?q=hot&sortby=Name
    
## Test
    cd legendary-garbanzo
    ./vendor/bin/phpunit
## Note
    legendary-garbanzo is a generated repo name by github also better than SearchSortTest(Old Name)