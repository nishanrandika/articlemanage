# Article Manage

This laravel 5.2 application use to store articles with authors.

## Getting Started

Please follow the instructions.

### Prerequisites

Things you need to install the software and how to install them

```
Postman
Git GUI
SmartGit 17.0.5
Composer
SublimeText 3 - prefer
```
### Installing

Step by step to get a development done and running

create a new laravel 5.2 project
```
composer create-project --prefer-dist laravel/laravel articlemanage "5.2.*"
```
get composer update
```
composer update
```
setup url
```
php artisan serve
```
and you are done.
## API Details

Explain how to run this system. Use [Postman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en) to pass data & view.

### Author Create
Creating a new author
```
Method: POST
URL: /author
Params: {"name" : "author name"}
AuthorRequest: name - required
```
### Artical 
#### Create
Creating a new artical.
```
Method: POST
URL: /article
Params: {
  "title": "artical title",
  "author_id": author_id,
  "content": "Some content...",
  "url": "/article/1"
}
controller: ArticalController -> store() function
```
#### Update
Update artical.
```
Method: PUT
URL: /article/{artical_id}
Params: {
  "title": "Updated artical title",
  "author_id": updated_author_id,
  "content": "Updated some content...",
  "url": "/article/1"
}
controller: ArticalController -> update() function
```
#### Show
Get specific artical details.
```
Method: GET
URL: /article/{id}
Response: JSON result
controller: ArticalController -> show() function
```
#### Show All
Get all artical details.
```
Method: GET
URL: /article
Response: JSON result
controller: ArticalController -> index() function
```
#### Delete
Delete a specific artical.
```
Method: DELETE
URL: /article/{id}
controller: ArticalController -> destroy() function
```

## Built With

* [Laravel](https://laravel.com/docs/5.2/) - The php framework used
* [Apache](https://www.apache.org/) - Apache used
* [MySQL](https://www.mysql.com/) - MySQL DB

## Versioning

I use [SmartGit](http://www.syntevo.com/smartgit/) for versioning. For the versions available, see the [branch on this repository](https://github.com/nishanrandika/articlemanage/commits/master).

## Author

* **Nishan Randika** - [Profile](https://github.com/nishanrandika)

## License

MIT.
