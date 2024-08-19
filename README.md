# SilverStripe First Or
## Installation
`composer req kriscoidan/silverstripe-first`
## What it does
Adds the ablilty to create and or write if the database model does not exist.
## Examples
### firstOrNew
Finds the first matching record or creates (does not write to the database)
```
$filters = ['FirstName' => 'John', 'Surname' => 'Smith'];
$model = MyModel::get()
    ->filter($filters)
    ->firstOrNew($filters);
    
$model->AddressLineOne = 'Brewers Lane';
$model->write();
```
### firstOrCreate
Finds the first matching record or creates (writes to the database)
```
$filters = ['FirstName' => 'John', 'Surname' => 'Smith'];
$model = MyModel::get()
    ->filter($filters)
    ->firstOrCreate($filters);

return $model->renderWith('Template');
```
### updateOrNew
Updates the first matching record or creates (does not write to the database)
```
$filters = ['FirstName' => 'John', 'Surname' => 'Smith'];
$model = MyModel::get()
    ->filter($filters)
    ->updateOrNew(['FirstName' => 'John', 'Surname' => 'Guiness']);

if ($model->isChanged('Surname')) {
    $model->write();
}
```

### firstOr
Finds the first matching record or calls callback
```
$filters = ['FirstName' => 'John', 'Surname' => 'Smith'];
$model = MyModel::get()
    ->filter($filters)
    ->firstOr(fn() => MyModel::create($filters));
```