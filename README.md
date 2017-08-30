# Menu

This package allows you to easily build a hierarchical menu from PHP. It's inspired by 
[Crisp's blogpost](https://crisp.tweakblogs.net/blog/317/formatting-a-multi-level-menu-using-only-one-query.html) but 
further implemented.

## Installation

This package can be used in any PHP project or with any framework. The packages is tested in PHP 7.0.

You can install the package via composer:

``` bash
composer require vdhicts/menu-builder
```

## Usage

```php
use Vdhicts\MenuBuilder;
    
$item = new MenuBuilder\Item(1, 'Search engines');
$subItemGoogle = new MenuBuilder\Item(2, 'Google', 'http://www.google.com', 1);
$subItemBing = new MenuBuilder\Item(3, 'Bing', 'http://www.bing.com', 2);
    
$itemCollection = new MenuBuilder\ItemCollection();
$itemCollection->addItem($item)
    ->addItem($subItemGoogle)
    ->addItem($subItemBing);
    
$renderer = new MenuBuilder\Renderers\Navbar();
$menuBuilder = new MenuBuilder\Builder($itemCollection, $navbar);
$menuBuilder->generate();
```

### Database

When storing the data in a database, you should at least have an `id`, `parentId` and `name`. The id isn't limited to 
integers so a UUID or slug should work too.

## Tests

Full code coverage unit tests are available in the `tests` folder. Run via phpunit:

`vendor\bin\phpunit`

By default a coverage report will be generated in the `build/coverage` folder.

## Contribution

Any contribution is welcome, but it should be fully tested, meet the PSR-2 standard and please create one pull request 
per feature. In exchange you will be credited as contributor on this page.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
